<?php
/**
 * ชุดคำสั่งสร้างเว็บด้วยภาษา PHP5+.
 * 
 * @author Rewat Boonsit
 * @package FormsObject
 * @version FKTClass 0.7
 */
class Checkbox extends FormObject {
	/**
	 * ป้ายข้อความของวัตถุ
	 *
	 * @var string
	 */
	public $label;
	/**
	 * ป้ายข้อความหลังวัตถุ
	 *
	 * @var string
	 */
	public $labelControl;
	/**
	 * ลำดับการกดแท็บ
	 *
	 * @var integer
	 */
	public $tabIndex;
	/**
	 * ค่าของวัตถุ
	 *
	 * @var string
	 */
	public $value;
	/**
	 * กำหนดไม่ใช้งาน
	 *
	 * @var boolean
	 */
	public $isDisabled;
	/**
	 * ตำแหน่งการวางตัวอักษร
	 *
	 * @var string
	 */
	public $align;
	/**
	 * กำหนดให้เลือกวัตถุ
	 *
	 * @var boolean
	 */
	public $isClick;
	
	/**
	 * คอนสตรัคเตอร์
	 *
	 * @param string $id        	
	 * @param string $name        	
	 * @param string $value        	
	 * @param boolean $checked        	
	 * @param boolean $disable        	
	 * @param string $jsOnClick
	 * @param string $label        	
	 */
	function __construct($id = '', $name = '', $value = '', $checked = false, $disable = false, $jsOnClick = null,$label=null) {
		parent::__construct ( "Checkbox", $id, $name );
		$this->labelControl = ( string ) '';
		$this->tabIndex = ( int ) 0;
		$this->value = ( string ) $value;
		$this->isDisabled = ( boolean ) $disable;
		$this->onClick = ( string ) $jsOnClick;
		$this->align = ( string ) '';
		$this->isCheck = ( boolean ) $checked;
		$this->labelControl = (string) $label;
	
	}
	
	public function render() {
		$tags = "<input ";
		$tags .= ' type = "checkbox" ';
		
		if (trim ( $this->getId () ) != "") {
			$tags .= ' id="' . $this->getId () . '"';
		}
		
		if (trim ( $this->getName () ) != "") {
			$tags .= ' name="' . $this->getName () . '" ';
		}
		
		if (trim ( $this->value ) != '') {
			$tags .= ' value = "' . $this->value . '" ';
		}
		
		if ($this->tabIndex !== 0) {
			$tags .= ' tabindex="' . $this->tabIndex . '" ';
		}
		
		if ($this->isDisabled !== false) {
			$tags .= ' disabled = true';
		}
		
		if ($this->isCheck !== false) {
			$tags .= ' checked = "checked"';
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
		
		if (trim ( $this->labelControl ) != "") {
			$tags .= '<label for="' . $this->getName () . '" ';
			
			if ($this->getStyle () != '' || $this->align != '') {
				$style = " style=\"";
				
				if ($this->align != "") {
					$style .= ' text-align:' . $this->align . ';';
				}
				
				if ($this->getStyle () != "") {
					$style .= $this->getStyle ();
				}
				
				$style .= '"';
				$tags .= $style;
			}
			$tags .= '>' . $this->labelControl . '</label>';
		}
		
		return $tags;
	}
}
?>
