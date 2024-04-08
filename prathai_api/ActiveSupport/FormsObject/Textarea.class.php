<?php
/**
 * ชุดคำสั่งสร้างเว็บด้วยภาษา PHP5+.
 * 
 * @author Rewat Boonsit
 * @package FormsObject
 * @version FKTClass 0.7
 */
class Textarea extends FormObject {
	/**
	 * จำนวนตัวอักษรที่รับในวัตถุนี้ได้
	 *
	 * @var string
	 */
	public $maxLength;
	/**
	 * จำนวนความสูงตามแถวของวัตถุ
	 *
	 * @var string
	 */
	public $rows;
	/**
	 * จำนวนความกว้างตามคอลัมน์ของวัตถุ
	 *
	 * @var string
	 */
	public $cols;
	/**
	 * ลำดับของการกดแท็บของวัตถุ
	 *
	 * @var integer
	 */
	public $tabIndex;
	/**
	 * กำหนดให้อ่า่นอย่างเดียว
	 *
	 * @var boolean
	 */
	public $readOnly;
	/**
	 * ค่าสีตัวอักษร เช่น #FFCCFF หรือ gray
	 *
	 * @var string
	 */
	public $color;
	/**
	 * สีพื้นหลังของวัตถุ #FFCCFF หรือ gray
	 *
	 * @var string
	 */
	public $bgColor;
	/**
	 * แบบอักษร เช่น MS Dialog
	 *
	 * @var string
	 */
	public $fontFamily;
	/**
	 * ขนาดเส้นขอบของวัตถุ
	 *
	 * @var integer
	 */
	public $border;
	/**
	 * ป้ายข้อความวัตถุ
	 *
	 * @var string
	 */
	public $label;
	/**
	 * ค่าของตัววัตถุ
	 *
	 * @var string
	 */
	public $value;
	/**
	 * การตัดคำ
	 *
	 * @var string
	 */
	public $warp;
	/**
	 * กำหนดไม่ใช้งาน
	 *
	 * @var boolean
	 */
	public $disabled;
	/**
	 * เหตุการณ์เมื่อเลือกค่าในวัตถุ
	 *
	 * @var string
	 */
	public $onSelect;
	/**
	 * กำหนดให้เป็นตัวหนา
	 *
	 * @var string
	 */
	public $onChange;
	/**
	 * กำหนดให้จัดเรียงค่าเป็นแบบ ชิดซ้าย ขวา หรือ กลาง (LEFT RIGHT CENTER)
	 *
	 * @var string
	 */
	public $align;
	/**
	 * กำหนดให้เป็นตัวหนา
	 *
	 * @var string
	 */
	public $isBold;
	/**
	 * กำหนดให้ขีดเส้นใต้
	 *
	 * @var string
	 */
	public $isUnderLine;
	public $allowNull;
	
	/**
	 * constructor
	 */
	function __construct($id = '', $name = '', $value = '') {
		parent::__construct ( "Textarea", $id, $name );
		$this->maxLength = ( int ) 0;
		$this->width = ( int ) 0;
		$this->height = ( int ) 0;
		$this->readOnly = ( bool ) false;
		$this->color = ( string ) '';
		$this->bgColor = ( string ) '';
		$this->fontFamily = ( string ) '';
		$this->class = ( string ) '';
		$this->border = ( int ) 0;
		$this->value = ( string ) $value;
		$this->warp = ( string ) '';
		$this->disabled = ( boolean ) false;
		$this->tabIndex = ( int ) 0;
		$this->onSelect = ( string ) '';
		$this->onChange = ( string ) '';
		$this->align = ( string ) '';
		$this->isBold = ( boolean ) false;
		$this->isUnderLine = ( boolean ) false;
		$this->allowNull = ( int ) false;
	}
	
	/**
	 * คืนค่า HTML tag ค่าเพิ่มเติม WITH_LABEL
	 *
	 * @param string $option
	 * @return string
	 */
	public function render($option = null) {
		$tags = ( string ) '';
		if ($option == "WITH_LABEL") {
			if (trim ( $this->label ) != "") {
				$tags = '<label for="' . $this->getName () . '" >' . $this->label . '</label>';
			}
		}
		
		$tags .= "<textarea ";
		
		if (trim ( $this->getId () ) != "") {
			$tags .= ' id="' . $this->getId () . '"';
		}
		
		if (trim ( $this->getName () ) != "") {
			$tags .= ' name="' . $this->getName () . '" ';
		}
		
		if (trim ( $this->rows ) > 0) {
			$tags .= ' rows="' . $this->rows . '" ';
		}
		
		if (trim ( $this->cols ) > 0) {
			$tags .= ' cols="' . $this->cols . '" ';
		}
		
		if (trim ( $this->warp ) > 0) {
			$tags .= ' warp="' . $this->warp . '" ';
		}
		
		if ($this->tabIndex !== 0) {
			$tags .= ' tabindex="' . $this->tabIndex . '" ';
		}
		
		if ($this->getStyle () != '' || $this->bgColor != '' || $this->color != '' || $this->isBold === true || $this->isUnderLine === true) {
			$style = "style=\"";
			if ($this->bgColor != "") {
				$style .= ' background-color:' . $this->bgColor . ';';
			}
			
			if ($this->color != "") {
				$style .= ' color:' . $this->color . ';';
			}
			
			if ($this->align != "") {
				$style .= ' text-align:' . $this->align . ';';
			}
			
			if ($this->color != "") {
				$style .= ' text-decoration:underline;';
			}
			
			if ($this->border !== 0) {
				$style .= 'border : ' . $this->border . 'px';
			}
			
			if ($this->isBold === true) {
				$style .= ' font-weight:bold;';
			}
			
			if ($this->getStyle () != "") {
				$style .= $this->getStyle ();
			}
			
			$style .= '"';
			$tags .= $style;
		}
		if ($this->readOnly === true) {
			$tags .= ' readonly = true ';
		}
		
		if ($this->disabled !== false) {
			$tags .= ' disabled = true';
		}
		
		if (trim ( $this->onClick ) != '') {
			$tags .= 'onclick = "' . $this->onClick . '" ';
		}
		
		if (trim ( $this->onDblClick ) != '') {
			$tags .= 'ondblclick = "' . $this->onDblClick . '" ';
		}
		
		if (trim ( $this->onKeyDown ) != '') {
			$tags .= 'onkeydown = "' . $this->onKeyDown . '" ';
		}
		
		if (trim ( $this->onKeyPress ) != '') {
			$tags .= 'onkeypress = "' . $this->onKeyPress . '" ';
		}
		
		if (trim ( $this->onBlur ) != '') {
			$tags .= 'onblur = "' . $this->onBlur . '" ';
		}
		
		if (trim ( $this->onFocus ) != '') {
			$tags .= 'onfocus = "' . $this->onFocus . '" ';
		}
		
		if (trim ( $this->onSelect ) != '') {
			$tags .= 'onselect = "' . $this->onSelect . '" ';
		}
		
		if (trim ( $this->onChange ) != '') {
			$tags .= 'onchange = "' . $this->onChange . '" ';
		}
		
		if (trim ( $this->onMouseMove ) != '') {
			$tags .= 'onMouseMove = "' . $this->onMouseMove . '" ';
		}
		
		if (trim ( $this->onMouseOut ) != '') {
			$tags .= 'onmouseout = "' . $this->onMouseOut . '" ';
		}
		
		if (trim ( $this->onMouseOver ) != '') {
			$tags .= 'onmouseover = "' . $this->onMouseOver . '" ';
		}
		
		if (trim ( $this->onMouseUp ) != '') {
			$tags .= 'onmouseup = "' . $this->onMouseUp . '" ';
		}
		
		if (trim ( $this->onMouseDown ) != '') {
			$tags .= 'onmousedown = "' . $this->onMouseDown . '" ';
		}
		
		$tags .= '>';
		if (trim ( $this->value ) != '') {
			$tags .= $this->value;
		}
		
		$tags .= '</textarea>';
		return $tags;
	}
}
?>