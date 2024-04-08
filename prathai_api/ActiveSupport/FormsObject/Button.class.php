<?php
/**
 * ชุดคำสั่งสร้างเว็บด้วยภาษา PHP5+.
 * 
 * @author Rewat Boonsit
 * @package FormsObject
 * @version FKTClass 0.7
 */
class Button extends FormObject {
	
	/**
	 * กำหนดขนาดความกว้างของปุ่ม
	 *
	 * @var integer
	 */
	public $width;
	/**
	 * กำหนดขนาดความสูงของปุ่ม
	 *
	 * @var integer
	 */
	public $height;
	
	/**
	 * สีของอักษรในวัตถุ
	 *
	 * @var string
	 */
	public $color;
	/**
	 * สีพื้นหลังของปุ่ม
	 *
	 * @var string
	 */
	public $bgColor;
	/**
	 * เลขเรียงลำดับของวัตถุ
	 *
	 * @var integer
	 */
	public $tabIndex;
	/**
	 * กำหนดให้ใช้งานไม่ได้
	 *
	 * @var boolean
	 */
	public $disabled;
	/**
	 * กำหนดรูปแบบของแบบอักษรที่แสดงบนตัวปุ่ม
	 *
	 * @var string
	 */
	public $fontFamily;
	/**
	 * ค่าข้อความแสดงบนปุ่ม
	 *
	 * @var string
	 */
	public $value;
	/**
	 * ประเภทของวัตถุ
	 *
	 * @var string
	 */
	public $type;
	/**
	 * กำหนดให้เป็นตัวหนา
	 *
	 * @var boolean
	 */
	public $isBold;
	/**
	 * กำหนดให้มีขีดเส้นใต้ข้อความ
	 *
	 * @var string
	 */
	public $isUnderLine;
	/**
	 * กำหนดการจัดตำแหน่งของข้อความบนปุ่ม (left right center)
	 *
	 * @var string
	 */
	public $align;
	
	/**
	 * คอนสตรัคเตอร์
	 *
	 * @param string $id
	 * @param string $name
	 * @param string $type
	 * @param string $value
	 */
	
	function __construct($id = '', $name = '', $value = 'button', $type = 'Button') {
		parent::__construct ( $type, $id, $name );
		$this->width = ( int ) 0;
		$this->height = ( int ) 0;
		$this->tabIndex = ( int ) 0;
		$this->color = ( string ) '';
		$this->bgColor = ( string ) '';
		$this->disabled = ( boolean ) false;
		$this->fontFamily = ( string ) '';
		$this->border = ( int ) 0;
		$this->value = ( string ) $value;
		$this->type = ( string ) $type;
		$this->align = ( string ) '';
		$this->isBold = ( boolean ) false;
		$this->isUnderLine = ( boolean ) false;
	}
	
	
	/**
	 * คืนค่าคำสั่ง HTML กลับมาให้
	 *
	 * @return string
	 */
	public function render() {
		$tags = "<input ";
		$this->type = strtolower($this->getType());
		$tags .= ' type = "' . $this->type . '" ';
		
		if (trim ( $this->getId () ) != "") {
			$tags .= ' id="' . $this->getId () . '"';
		}
		
		if (trim ( $this->getName () ) != "") {
			$tags .= ' name="' . $this->getName () . '" ';
		}
		
		if ($this->width !== 0) {
			$tags .= ' size="' . $this->width . '" ';
		}
		
		if (trim ( $this->value ) != '') {
			$tags .= ' value = "' . $this->value . '" ';
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
			
			if ($this->isUnderLine !== false) {
				$style .= ' text-decoration:underline;';
			}
			
			if ($this->isBold === true) {
				$style .= ' font-weight:bold;';
			}
			
			if ($this->border !== 0) {
				$style .= 'border : ' . $this->border . 'px';
			}
			
			if ($this->getStyle () != "") {
				$style .= $this->getStyle ();
			}
			
			$style .= '"';
			$tags .= $style;
		}
		
		if ($this->disabled !== false) {
			$tags .= ' disabled = "true"';
		}
		
		if (trim ( $this->onClick ) != '') {
			$tags .= ' onclick = "' . $this->onClick . '" ';
		}
		
		if (trim ( $this->onDblClick ) != '') {
			$tags .= ' ondblclick = "' . $this->onDblClick . '" ';
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