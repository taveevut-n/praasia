<?php
/**
 * ชุดคำสั่งสร้างเว็บด้วยภาษา PHP5+.
 * 
 * @author Rewat Boonsit
 * @package FormsObject
 * @abstract FormsObject
 * @version FKTClass 0.7
 */
abstract class FormObject {
	/**
	 * ไอดีของวัตถุ
	 *
	 * @var string
	 */
	private $id;
	/**
	 * ชื่อของวัตถุ
	 *
	 * @var string
	 */
	private $name;
	/**
	 * รูปแบบการแสดงผลบนจอภาพ
	 *
	 * @var string
	 */
	private $style;
	/**
	 * เพิ่มเข้าไปในคอมโพเน็นอื่นแล้ว
	 *
	 * @var boolean
	 */
	private $b_added;
	/**
	 * มีโหนดลูกข้างใน
	 *
	 * @var boolean
	 */
	private $b_hv_child;
	/**
	 * รายการโหนดลูก เป็นอาเรย์
	 *
	 * @var array
	 */
	private $child;
	/**
	 * กำหนดคลาสของ css ให้กับวัตถุ
	 *
	 * @var string
	 */
	public $class;
	/**
	 * กำหนดเหตุการณ์ตอนคลิกเมาส์ซ้าย ให้กับวัตถุ 
	 *
	 * @var string
	 */
	public $onClick;
	/**
	 * กำหนดเหตุการณ์ตอนปล่อยปุ่มคีย์บอร์ดใดๆ ให้กับวัตถุ
	 *
	 * @var string
	 */
	public $onKeyUp;
	/**
	 * กำหนดเหตุการณ์ตอนกดปุ่มและปล่อยคีย์บอร์ดใดๆ ให้กับวัตถุ
	 *
	 * @var string
	 */
	public $onKeyPress;
	/**
	 * กำหนดเหตุการณ์ตอนกดปุ่มคีย์บอร์ดใดๆ ให้กับวัตถุ
	 *
	 * @var string
	 */
	public $onKeyDown;
	/**
	 * กำหนดเหตุการณ์ตอนดับเบิลคลิกเมาส์ ให้กับวัตถุ
	 *
	 * @var string
	 */
	public $onDblClick;
	/**
	 * กำหนดเหตุการณ์ตอนออกจากโฟกัส ให้กับวัตถุ
	 *
	 * @var string
	 */
	public $onBlur;
	/**
	 * กำหนดเหตุการณ์ตอนโฟกัส ให้กับวัตถุ
	 *
	 * @var string
	 */
	public $onFocus;
	/**
	 * กำหนดเหตุการณ์ตอนเคลื่อนเมาส์ ให้กับวัตถุ 
	 *
	 * @var string
	 */
	public $onMouseMove;
	/**
	 *  กำหนดเหตุการณ์ตอนเมาส์อยู่เหนือวัตถุ ให้กับวัตถุ 
	 *
	 * @var string
	 */
	public $onMouseOver;
	/**
	 * กำหนดเหตุการณ์ตอนเมาส์ออกจากวัตถุ ให้กับวัตถุ 
	 *
	 * @var string
	 */
	public $onMouseOut;
	/**
	 * กำหนดเหตุการณ์ตอนคลิกเมาส์ลง ให้กับวัตถุ 
	 *
	 * @var string
	 */
	public $onMouseDown;
	/**
	 * กำหนดเหตุการณ์ตอนปล่อยเมาส์ขึ้น ให้กับวัตถุ
	 *
	 * @var string
	 */
	public $onMouseUp;
	
	/**
	 * ประเภท Object Forms
	 * 
	 * @var string
	 */
	private $objectType;
	
	/**
	 * คอนสตรัคเตอร์
	 *
	 * @param string $object_type
	 * @param string $id
	 * @param string $name
	 */
	public function __construct($object_type, $id = '', $name = '') {
		$this->setId ( $id );
		$this->setName ( $name );
		$this->objectType = ( string ) $object_type;
		$this->style = ( string ) '';
		$this->added = ( boolean ) false;
		$this->hv_child = ( boolean ) false;
		$this->child = ( array ) array ();
		$this->class = ( string ) '';
		$this->onClick = ( string ) '';
		$this->onDblClick = ( string ) '';
		$this->onKeyUp = ( string ) '';
		$this->onKeyDown = ( string ) '';
		$this->onKeyPress = ( string ) '';
		$this->onBlur = ( string ) '';
		$this->onFocus = ( string ) '';
		$this->onMouseMove = ( string ) '';
		$this->onMouseOver = ( string ) '';
		$this->onMouseOut = ( string ) '';
		$this->onMouseUp = ( string ) '';
		$this->onMouseDown = ( string ) '';
	
	}
	
	/**
	 * กำหนดค่าไอดีให้กับวัตถุ
	 *
	 * @param string $id
	 */
	public function setId($id) {
		$this->id = ( string ) $id;
	}
	/**
	 * กำหนดค่าชื่อให้กับวัตถุ
	 *
	 * @param string $name
	 */
	public function setName($name) {
		$this->name = ( string ) $name;
	}
	
	/**
	 * กำหนดค่ารูปแบบให้กับวัตถุด้วยคำสั่ง CSS
	 *
	 * @param string $style
	 */
	public function setStyle($style) {
		$this->style = ( string ) $style;
	}
	
	/**
	 * คืนค่าชื่อ
	 *
	 * @return string
	 */
	public function getName() {
		return $this->name;
	}
	/**
	 * กำหนดค่าเพิ่มวัตถุให้กับคอมโพเน็นอื่นแล้ว
	 *
	 * @param boolean $b_add
	 */
	protected function setAdded($b_add) {
		$this->added = ( boolean ) $b_add;
	}
	/**
	 * คืนค่าการเ้พิ่มวัตถุเข้าคอมโพเน็นอื่น
	 *
	 * @return boolean
	 */
	public function getAdded() {
		return $this->added;
	}
	/**
	 * คืนค่าไอดีของวัตถุ
	 *
	 * @return string
	 */
	public function getId() {
		return $this->id;
	}
	/**
	 * คืนค่ารูปแบบ
	 *
	 * @return string
	 */
	public function getStyle() {
		return $this->style;
	}
	/**
	 * คืนค่าประเภทวัตถุฟอร์ม
	 *
	 * @return string
	 */
	public function getType() {
		return $this->objectType;
	}
   /**
    * กำหนดค่าประเภทวัตถุฟอร์ม
    *
    * @param string $type
    */
    public function setType($type = null) {
        $this->objectType = (string) $type;
    }
	
	/**
	 * สร้างคำสั่ง HTML จากวัตถุ
	 *
	 */
	abstract public function render();
	/**
	 * แสดงคำสั่ง HTML ออกทางจอภาพ
	 *
	 */
	public function show() {
		print $this->render ();
	}
	/**
	 * แสดงคำสั่ง HTML ออกทางจอภาพ
	 *
	 * @return string
	 */
	public function __toString() {
		return $this->render ();
	}
}
?>
