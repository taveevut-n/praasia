<?php
/**
 * ชุดคำสั่งสร้างเว็บด้วยภาษา PHP5+.
 * 
 * @author Rewat Boonsit
 * @package FormsObject
 * @version FKTClass 0.7
 */
class Textfield extends FormObject {
	
	/**
	 * ประเภทของวัตถุ input ค่าปริยาย คือ text
	 *
	 * @var string
	 */
	public $type;
	/**
	 * จำนวนตัวอักษรที่รับในวัตถุนี้ได้
	 *
	 * @var string
	 */
	public $maxLength;
	/**
	 * ขนาดตัวอักษรในวัตถุ
	 *
	 * @var integer
	 */
	public $size;
	/**
	 * ความกว้างของวัตถุ
	 *
	 * @var integer
	 */
	public $width;
	/**
	 * ลำดับของการกดแท็บของวัตถุ
	 *
	 * @var integer
	 */
	public $tabIndex;
	/**
	 * ความสูงของวัตถุ
	 *
	 * @var integer
	 */
	public $height;
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
	 * เหตุการณ์เมื่อเปลี่ยนค่าในวัตถุ
	 *
	 * @var string
	 */
	public $onChange;
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
	/**
	 * กำหนดให้สามารถปล่อยเป็นค่าว่างได้
	 *
	 * @var boolean
	 */
	public $allowNull;
	/**
	 * กำหนดให้จัดเรียงค่าเป็นแบบ ชิดซ้าย ขวา หรือ กลาง (LEFT RIGHT CENTER)
	 *
	 * @var string
	 */
	public $align;
	/**
	 * ภาษาอังกฤษตัวเล็กอย่างเดียว
	 *
	 * @var boolean
	 */
	public $isLowerCase;
	/**
	 * ภาษาอังกฤษตัวใหญ่อย่างเดียว
	 *
	 * @var boolean
	 */
	public $isUpperCase;
	/**
	 * ข้อความเมื่อเป็นค่าว่าง
	 *
	 * @var string
	 */
	public $error_isnull_message;
	
	/**
	 * ข้อความเมื่อเป็นค่าที่ระบุไม่ถูกต้อง
	 *
	 * @var string
	 */
	public $error_invalid_message;
	
	/**
	 * การตรวจสอบความถูกต้อง
	 *
	 * @var Validator
	 */
	private $a_valid_type;
	
	/**
	 * คอนสตรัคเตอร์
	 *
	 * @param string $id
	 * @param string $name
	 * @param string $value
	 * @param string $type
	 */
	function __construct($id = '', $name = '', $value = '', $type = 'text') {
		parent::__construct ( "Textfield", $id, $name );
		$this->type = ( string ) $type;
		$this->maxLength = ( int ) 255;
		$this->size = ( int ) 0;
		$this->width = ( int ) 0;
		$this->height = ( int ) 0;
		$this->tabIndex = ( int ) 0;
		$this->readOnly = ( bool ) false;
		$this->class = ( string ) '';
		$this->color = ( string ) '';
		$this->bgColor = ( string ) '';
		$this->fontFamily = ( string ) '';
		$this->border = ( int ) 0;
		$this->value = ( string ) $value;
		$this->disabled = ( boolean ) false;
		$this->onSelect = ( string ) '';
		$this->onChange = ( string ) '';
		$this->align = ( string ) '';
		$this->isBold = ( boolean ) false;
		$this->isUnderLine = ( boolean ) false;
		$this->allowNull = ( int ) false;
		$this->error_isnull_message = ( string ) "ไม่สามารถเป็นค่าว่างได้";
		$this->error_invalid_message = ( string ) "ข้อมูลที่ระบุไม่ถูกต้อง";
		$this->isLowerCase = ( boolean ) false;
		$this->isUpperCase = ( boolean ) false;
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
		
		$tags .= "<input ";
		
		if (trim ( $this->type ) == 'password' || trim ( $this->type ) == 'text') {
			$tags .= ' type="' . $this->type . '" ';
		}
		
		if (trim ( $this->getId () ) != "") {
			$tags .= ' id="' . $this->getId () . '"';
		}
		
		if (trim ( $this->getName () ) != "") {
			$tags .= ' name="' . $this->getName () . '" ';
		}
		
		if ($this->width !== 0 || $this->size !== 0) {
			if ($this->width !== 0) {
				$tags .= ' size="' . $this->width . '" ';
			} else if ($this->size !== 0) {
				$tags .= ' size="' . $this->size . '" ';
			}
		}
		
		if ($this->maxLength !== 0) {
			$tags .= ' maxlength="' . $this->maxLength . '" ';
		}
		
		if ($this->tabIndex !== 0) {
			$tags .= ' tabindex="' . $this->tabIndex . '" ';
		}
		
		if (trim ( $this->value ) != '') {
			$tags .= ' value = "' . $this->value . '" ';
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
			
			if ($this->isUnderLine != "") {
				$style .= ' text-decoration:underline;';
			}
			
			if ($this->isBold === true) {
				$style .= ' font-weight:bold;';
			}
			
			if ($this->border !== 0) {
				$style .= 'border : ' . $this->border . 'px;';
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
		
		if (trim ( $this->onKeyUp ) != '') {
			$tags .= 'onkeyup = "' . $this->onKeyUp . '" ';
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
		
		if (trim ( $this->onChange ) != '' || $this->isLowerCase === true || $this->isUpperCase === true) {
			$Change = 'onchange = "';
			if ($this->isLowerCase === true) {
				$Change .= 'this.value=this.value.toLowerCase(); ';
			}
			if ($this->isUpperCase === true) {
				$Change .= 'this.value=this.value.toUpperCase(); ';
			}
			if (trim ( $this->onChange ) != '') {
				$Change .= 'onchange = "' . $this->onChange . '" ';
			}
			$Change .= '"';
			$tags .= $Change;
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
		
		$tags .= '/>';
		return $tags;
	}
}

?>
