<?php
/**
 * ชุดคำสั่งสร้างเว็บด้วยภาษา PHP5+.
 * 
 * @author Rewat Boonsit
 * @package FormsObject
 * @version FKTClass 0.7
 */
class Radio extends FormObject {
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
	public $disabled;
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
	public $isCheck;
	
	/**
	 * คอนสตรัคเตอร์
	 *
	 * @param string $id
	 * @param string $name
	 * @param string $value
	 */
	
	/**
	 * constructor
	 */
	function __construct($id = '', $name = '', $value = '') {
		parent::__construct ( "Radio", $id, $name );
		$this->tabIndex = ( int ) 0;
		$this->class = ( string ) '';
		$this->labelControl = ( string ) '';
		$this->value = ( string ) $value;
		$this->disabled = ( boolean ) false;
		$this->align = ( string ) '';
		$this->isCheck = ( boolean ) false;
	}
	
	public function render() {
		$tags = "<input ";
		$tags .= ' type = "radio" ';
		
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
			$tags .= '>';
			$tags .= $this->labelControl . '</label>';
		}
		
		return $tags;
	}

}

?>
