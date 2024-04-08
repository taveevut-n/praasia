<?php
/**
 * ชุดคำสั่งสร้างเว็บด้วยภาษา PHP5+.
 *
 * @author Rewat Boonsit
 * @package FormsObject
 * @version FKTClass 0.7
 */
class SelectBox extends FormObject {
	/**
	 * รายการสำหรับ select box
	 *
	 * @var array
	 */
	private $options;
	/**
	 * กำหนดเป็นวัตถุจัมเมนู
	 *
	 * @var boolean
	 */
	public $isJumpmenu;

	/**
	 * ความสูงของ
	 *
	 * @var integer
	 */
	public $size;

	/**
	 * ความกว้าง
	 *
	 * @var integer
	 */
	public $width;

	/**
	 * รายการที่เลือก
	 *
	 * @var integer
	 */
	public $selected;

	/**
	 * ลำำดับการกดปุ่มแท็บ
	 *
	 * @var intger
	 */
	public $tabIndex;

	/**
	 * สีตัวอักษร
	 *
	 * @var string
	 */
	public $color;

	/**
	 * สีพื้นหลัง
	 *
	 * @var string
	 */
	public $bgColor;

	/**
	 * แบบอักษร
	 *
	 * @var string
	 */
	public $fontFamily;

	/**
	 * ขนาดเส้นขอบ
	 *
	 * @var integer
	 */
	public $border;

	/**
	 * ป้ายวัตถุฟอร์ม
	 *
	 * @var string
	 */
	public $label;

	/**
	 * ไม่ใช้งาน
	 *
	 * @var boolean
	 */
	public $disabled;

	/**
	 * เลือกได้หลายรายการ
	 *
	 * @var boolean
	 */
	public $isMulltiSelect;

	/**
	 * เหตุการเมื่อเลือกรายการใน select box
	 *
	 * @var string
	 */
	public $onChange;

	/**
	 * การจัดวางข้อความในรายการ
	 *
	 * @var string
	 */
	public $align;

	/**
	 * ใช้อักษรตัวหนา
	 *
	 * @var boolean
	 */
	public $isBold;

	/**
	 * ขีดเส้นใต้ตัวอักษร
	 *
	 * @var boolean
	 */
	public $isUnderLine;

	/**
	 * ประเภท Object Forms
	 *
	 * @var string
	 */
	private $objectType;

	/**
	 * คอนสตรัคเตอร์
	 *
	 * @param string $id
	 * @param string $name
	 * @param Option $o_options
	 */
	function __construct($id = '', $name = '', Option $o_options = null) {
		parent::__construct ( "Selectbox", $id, $name );
		$this->options = ( array ) $o_options;
		$this->isJumpmenu = ( boolean ) false;
		$this->width = ( int ) 0;
		$this->size = ( int ) 0;
		$this->color = ( string ) '';
		$this->bgColor = ( string ) '';
		$this->fontFamily = ( string ) '';
		$this->class = ( string ) '';
		$this->border = ( int ) 0;
		$this->isMmultiSelect = ( boolean ) false;
		$this->disabled = ( boolean ) false;
		$this->tabIndex = ( int ) 0;
		$this->onChange = ( string ) '';
		$this->align = ( string ) '';
		$this->isBold = ( boolean ) false;
		$this->isUnderLine = ( boolean ) false;
	}
	/**
	 * เพิ่มรายการสำหรับ Selectbox
	 *
	 * @param Option $o_option
	 */
	public function addOption(Option &$o_option) {
		if ($o_option->getAdded () == false) {
			$this->options [] = $o_option->getItems ();
			$o_option->setAdded ( true );
		}
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

		$tags .= "<select ";

		if (trim ( $this->getId () ) !== "") {
			$tags .= ' id="' . $this->getId () . '"';
		}

		if (trim ( $this->getName () ) !== "") {
			$tags .= ' name="' . $this->getName () . '" ';
		}

		if ($this->tabIndex !== 0) {
			$tags .= ' tabindex="' . $this->tabIndex . '" ';
		}

		if ($this->size !== 0) {
			$tags .= ' size="' . $this->size . '" ';
		}

		if ($this->isMulltiSelect === true) {
			$tags .= ' multiple="true"';
		}

		if ($this->getStyle () !== '' || $this->bgColor !== '' || $this->color !== '' || $this->isBold === true || $this->isUnderLine === true) {
			$style = "style=\"";
			if ($this->bgColor !== "") {
				$style .= ' background-color:' . $this->bgColor . ';';
			}

			if ($this->color !== "") {
				$style .= ' color:' . $this->color . ';';
			}

			if ($this->align !== "") {
				$style .= ' text-align:' . $this->align . ';';
			}

			if ($this->color !== "") {
				$style .= ' text-decoration:underline;';
			}

			if ($this->border !== "") {
				$style .= 'border : ' . $this->border . 'px';
			}

			if ($this->isBold !== "") {
				$style .= ' font-weight:bold;';
			}

			if ($this->getStyle () !== "") {
				$style .= $this->getStyle ();
			}

			$style .= '"';
			$tags .= $style;
		}

		if (trim ( $this->disabled ) === true) {
			$tags .= ' disabled = "true" ';
		}

		if (trim ( $this->onClick ) !== '') {
			$tags .= 'onclick = "' . $this->onClick . '" ';
		}

		if (trim ( $this->onDblClick ) !== '') {
			$tags .= 'ondblclick = "' . $this->onDblClick . '" ';
		}

		if (trim ( $this->onKeyDown ) !== '') {
			$tags .= 'onkeydown = "' . $this->onKeyDown . '" ';
		}

		if (trim ( $this->onKeyPress ) !== '') {
			$tags .= 'onkeypress = "' . $this->onKeyPress . '" ';
		}

		if (trim ( $this->onBlur ) !== '') {
			$tags .= 'onblur = "' . $this->onBlur . '" ';
		}

		if (trim ( $this->onFocus ) !== '') {
			$tags .= 'onfocus = "' . $this->onFocus . '" ';
		}

		if (trim ( $this->onChange ) !== '' || $this->isJumpmenu === true) {
			$onchange_tags = ' onchange = "';
			if (trim ( $this->onChange ) !== '') {
				$onchange_tags .= $this->onChange;
			}

			if ($this->isJumpmenu === true) {
				$onchange_tags .= " jumpmenu(this); ";

			}
			$onchange_tags .= '" ';
			$tags .= $onchange_tags;
		}

		if (trim ( $this->onMouseMove ) !== '') {
			$tags .= 'onMouseMove = "' . $this->onMouseMove . '" ';
		}

		if (trim ( $this->onMouseOut ) !== '') {
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
		if ($this->options != null || count ( $this->options ) > 0) {
			foreach ( $this->options as $loop ) {
				if (is_array ( $loop )) {
					foreach ( $loop as $loop2 ) {
						$tags .= ( string ) '<option value="' . $loop2 [1] . '" ';
						if ($loop2 [2] === true) {
							$tags .= ( string ) 'selected="true"';
						}
						$tags .= '>' . $loop2 [0] . '</option>' . "\r\n";
					}
				} else {
					$tags .= ( string ) '<option value="' . $loop [1] . '" ';
					if ($loop [2] === true) {
						$tags .= ( string ) 'selected="true"';
					}
					$tags .= '>' . $loop [0] . '</option>' . "\r\n";
				}
			}
		}
		$tags .= '</select>';
		return $tags;
	}
	/**
	 * คืนค่าคำสั่ง Javascript กลับมาให้ในกรณีที่มีการใช้งาน Jump menu.
	 *
	 * @return string
	 */
	function preDefineWithScriptBlock() {
		$header = "
		<script language=\"javascript\" type=\"text/javascript\">
        function jumpmenu(o_slc){
            try{
                window.location = o_slc.options[o_slc.selectedIndex].value;
            }catch(e){
                alert(e.message);
            }
        }
        </script>\r\n";
		return $header;
	}

	function preDefineWhitOutScriptBlock() {
		$header = "
        function jumpmenu(o_slc){
            try{
                window.location = o_slc.options[o_slc.selectedIndex].value;
            }catch(e){
                alert(e.message);
            }
        }";
		return $header;
	}
}

class Option extends SelectBox {
	/**
	 * Array List items
	 * @var array
	 */
	private $items;

	/**
	 * Tyhpe
	 * @var string
	 */
	private $objectType;

	/**
	 * Status flag object is add to parent.
	 * @var boolean
	 */
	private $added;

	public function __construct($text = '', $value = '', $isSelect = false) {
		$this->added = ( boolean ) false;
		$this->objectType = ( string ) 'Option';
		if ($text != '' || $value != '' || $isSelect != false) {
			$this->items [] = ( array ) array (
					$text,
					$value,
					$isSelect
			);
		}
	}
	/**
	 * สร้างรายการ Option ใหม่
	 *
	 * @param string $text
	 * @param string $value
	 * @param boolean $isSelect
	 */
	public function createOption($text = '', $value = '', $isSelect = false) {
		$this->items [] = ( array ) array (
				$text,
				$value,
				$isSelect
		);
	}
	/**
	 * คืนค่ารายการที่สร้างไปแล้วหรือกำหนดไว้
	 *
	 * @return array
	 */
	public function getItems() {
		return $this->items;
	}

	/**
	 * คืนค่าสถานะการเพิ่มรายการเข้าไปในวัตถุอื่นๆ
	 *
	 * @return boolean
	 */
	public function getAdded() {
		return $this->added;
	}

	/**
	 * กำหนดค่าการเพิ่มเข้าไปในวัตถุอื่นๆ
	 *
	 * @param boolean $add
	 */
	public function setAdded($add) {
		$this->added = ( boolean ) $add;
	}

	/**
	 * คืนค่า HTML tag ค่าเพิ่มเติม WITH_LABEL
	 *
	 * @param string $option
	 * @return string
	 */
	public function render($option = null) {
		$tags = ( string ) '';
		if ($this->items != null && count ( $this->items ) > 0) {
			foreach ( $this->items as $loop ) {
				$tags .= ( string ) '<option value="' . $loop [1] . '" ';
				if ($loop [2] === true) {
					$tags .= ( string ) 'selected="true"';
				}
				$tags .= '>' . $loop [0] . '</option>' . "\r\n";
			}
		}

		return $tags;
	}
}

?>