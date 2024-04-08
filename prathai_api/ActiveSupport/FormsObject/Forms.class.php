<?php
/**
 * ชุดคำสั่งสร้างเว็บด้วยภาษา PHP5+.
 *
 * @author Rewat Boonsit
 * @package FormsObject
 * @version FKTClass 0.7
 */
class Forms extends FormObject {

	static public $FORMS_POST_METHOD = "post";

	static public $FORMS_GET_METHOD = "get";

	static public $FORMS_ENCTYPE_URL_ENCODE = 'application/x-www-form-urlencoded';

	/**
	 * สมาชิกในฟอร์ม
	 *
	 * @var array
	 */
	private $member;

	/**
	 * ประเภท Object Forms
	 *
	 * @var string
	 */
	private $objectType;

	/**
	 * ไฟล์ที่ต้องการส่งข้อมูลให้ประมวลผล
	 *
	 * @var string
	 */
	public $action;

	/**
	 * วิธีการนำไปประมวลผล GET,POST
	 *
	 * @var string
	 */
	public $method;

	/**
	 * วิธีการเข้ารหัสข้อมูลที่นำไปประมวลผล
	 *
	 * @var string
	 */
	public $enctype;

	/**
	 * หน้าเว็บเพจที่ต้องการให้เกิดกิจกรรม
	 *
	 * @var string
	 */
	public $target;

	/**
	 * เมื่อส่งข้อมูล
	 *
	 * @var string
	 */
	public $onSubmit;

	/**
	 * เมื่อเคลียร์ข้อมูล
	 *
	 * @var string
	 */
	public $onReset;
	/**
	 * ความกว้างคอลัมน์ป้ายวัตถุฟอร์ม
	 *
	 * @var integer
	 */
	public $widthLabelColumn;
	/**
	 * ความกว้างคอลัมน์วัตถุฟอร์ฒ
	 *
	 * @var integer
	 */
	public $widthControlColumn;
	/**
	 * ความกว้างคอลัมน์ข้อความ
	 *
	 * @var integer
	 */
	public $widthMessageColumn;

	/**
	 * คอนสตรัคเตอร์
	 *
	 * @param string $id
	 * @param string $name
	 * @param string $action
	 * @param string $method
	 * @param string $enctype
	 */
	function __construct($id = '', $name = '', $action = '#', $method = 'post', $enctype = 'application/x-www-form-urlencoded') {
		parent::__construct ( $id, $name );
		$this->objectType = ( string ) 'Forms';
		$this->action = ( string ) $action;
		$this->method = ( string ) $method;
		$this->enctype = ( string ) $enctype;
		$this->target = ( string ) '';
		$this->onSubmit = ( string ) '';
		$this->onReset = ( string ) '';
		$this->member = ( array ) array ();
		$this->widthLabelColumn = ( integer ) 0;
		$this->widthControlColumn = ( integer ) 0;
		$this->widthMessageColumn = ( integer ) 0;
	}

	public function add(FormObject &$formObject) {
		if ($formObject->getAdded () != true) {
			$this->member [] = $formObject;
			$formObject->setAdded ( true );
		}
	}

	/**
	 * ประกอบคำสั่ง HTML หรือ XHTML
	 *
	 * @return String
	 */
	public function render() {
		$tags = "<form ";

		if (trim ( $this->action ) != '') {
			$tags .= 'action = "' . $this->action . '" ';
		}

		if (trim ( $this->method ) != '') {
			$tags .= 'method = "' . $this->method . '" ';
		}

		if (trim ( $this->enctype ) != '') {
			$tags .= 'enctype = "' . $this->enctype . '" ';
		}

		if (trim ( $this->target ) != '') {
			$tags .= 'target = "' . $this->target . '" ';
		}

		if (trim ( $this->onSubmit ) != '') {
			$tags .= 'onsubmit = "' . $this->onSubmit . '" ';
		}

		if (trim ( $this->onReset ) != '') {
			$tags .= 'onreset = "' . $this->onReset . '" ';
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
			$tags .= 'onmousemove = "' . $this->onMouseMove . '" ';
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

		$_add = ($this->getId()!="") ? 'id="'.$this->getId().'" ' :"";
		$_add += ($this->getName()!="") ? 'name="'.$this->getName().'" ' :"";

		$tags .= ">";
		$tags .= "\r\n";
		$tags .= '<table '. $_add .' border="0" cellpadding="2" cellspacing="1">';
		$tags .= '<tbody>';
		for($Running = 0; $Running < count ( $this->member ); $Running ++) {
			if (($this->member [$Running]->getType () != "Submit") && ($this->member [$Running]->getType () != "Reset")) {
				$tags .= '<tr>';
				$tags .= '<td width="' . $this->widthLabelColumn . '">';

				if ($this->member [$Running]->getType () != "Button" || $this->member [$Running]->getType () != "Checkbox" || $this->member [$Running]->getType () != "Radio") {
					$tags .= $this->member [$Running]->label;
				}

				$tags .= '</td>';
				$tags .= '<td width="' . $this->widthControlColumn . '">';
				$tags .= $this->member [$Running]->render ();
				$tags .= '</td>';
				$tags .= '<td width="' . $this->widthMessageColumn . '"><div id="' . $this->member [$Running]->getName () . '_msg">';
				$tags .= '&nbsp;';
				$tags .= '</div></td>';
				$tags .= '</tr>';
				if (count ( $this->member ) + 1 != $Running) {
					$tags .= "\r\n";
				}
			}
		}
		$tags .= '</tbody>';
		$tags .= '<tfoot>';

		$tags .= '<tr>';
		$tags .= '<td colspan="3" align="center"> ';
		for($Running = 0; $Running < count ( $this->member ); $Running ++) {
			if ($this->member [$Running]->getType () == "Submit" || $this->member [$Running]->getType () == "Reset") {
				$tags .= $this->member [$Running]->render ()." ";
				if (count ( $this->member ) + 1 != $Running) {
					$tags .= "\r\n";
				}
			}
		}
		$tags .= '</td>';
		$tags .= '</tr>';

		$tags .= '</tfoot>';
		$tags .= '</table>';
		$tags .= "</form>";
		return $tags;
	}
}
?>
