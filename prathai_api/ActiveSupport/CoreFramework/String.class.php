<?php
/**
 * Class String
 *
 * @author Boonsit
 * @filesource CoreFramewrok/String.class.php
 */
class String extends Charactor {

	private $m_string;

	/**
	 * Constructor of class.
	 */
	public function __construct($s = "") {
		parent::__construct ( $s );
	}

	/**
	 * Magic method.
	 *
	 * @return string
	 */
	public function __toString() {
		return $this->getChar ();
	}

	/**
	 * return length of string
	 *
	 * @return number
	 */
	public function length() {
		return strlen ( $this->getChar () );
	}

	/**
	 * Retun sub string form source in object.
	 *
	 * @param Integer $start_position
	 * @param Integer $length
	 * @return string
	 */
	public static function subString($s, $start_position, $length = null) {
		return substr ( $s, $start_position, $length );
	}

	/**
	 * Padding Charactor to String.
	 */
	public function padString($s, $pad = '', $toLength = null) {
		if (strtolower ( $pad ) == 'left') {
			$strPad = 0;
		} elseif (strtolower ( $pad ) == 'both') {
			$strPad = 2;
		} elseif (strtolower ( $pad ) == 'right') {
			$strPad = 1;
		} else {
			$strPad = 1;
		}

		return str_pad ( $this->getChar (), $toLength, $s, $strPad );
	}

	/**
	 * ตัดแบ่งข้อความและส่งคืนค่ากลับมาเป็น array
	 *
	 * @param string $s
	 *
	 * อักษรตัดแบ่งข้อความ เช่น ',' , ':', '|'
	 * @example $obj->split(); หรือ $obj->split(',');
	 */
	public function split($s = ',') {
		return explode ( $s, $this->getChar () );
	}

	public function conv_utf8_tis620() {

		return iconv ( "UTF-8", "TIS-620", $this->getChar () );
	}

	public function conv_tis620_utf8() {
		return iconv ( "TIS-620", "UTF-8", $this->getChar () );
	}

	public function base64encode() {
		return base64_encode ( $this->getChar () );

	}

	public function base64decode() {
		return base64_decode ( $this->getChar () );
	}

	public function md5() {
		return md5 ( $this->getChar () );
	}

	/**
	 * return true or false for comparition
	 *
	 * @param string $s
	 * @param boolean $strict_type
	 *        	= false
	 * @return boolean
	 */
	public function compare($s, $strict_type = false) {
		$_b = false;
		if ($strict_type === true) {
			if ($this->s === $s) {
				$_b = true;
			}
		} else {
			if ($this->s == $s) {
				$_b = true;
			}
		}

		return $_b;
	}
        
        

	/**
	 * check empty value
	 *
	 * @return boolean
	 */
	public function isEmpty() {
		$_b = false;
		if ($this->getChar () == null || $this->getChar () == "") {
			$_b = true;
		}
		return $_b;
	}

	/**
	 * Return true or false.
	 * Check string value are pattern number or real number
	 *
	 * @return boolean
	 */
	public function isNumeric() {
		return (is_numeric ( $this->getChar () ) || is_real ( $this->getChar () )) ? true : false;
	}

	/**
	 * Parsed HTML entity
	 *
	 * @return void
	 */
	public function htmlentities() {
		$this->setChar ( htmlentities ( $this->getChar () ) );
	}

	/**
	 * Replace string at point
	 *
	 * @param string $pattern
	 * @param string $value_replace
	 * @param number $limit
	 *
	 * @return void
	 */
	public function removeCharAt($pattern, $value_replace, $limit = null) {
		$s = "";
		if ($limit != null) {
			$s = str_replace ( $pattern, $value_replace, $this->getChar (), $limit );
		} else {
			$s = str_replace ( $pattern, $value_replace, $this->getChar () );
		}
		return $s;
	}

}
?>