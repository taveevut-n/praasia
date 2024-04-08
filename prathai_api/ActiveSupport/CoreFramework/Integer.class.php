<?php
/**
 * Class Integer
 * 
 * @author Boonsit
 * @filesource CoreFramewrok/Integer.class.php
 */
class Integer extends AObjects {
	
	private $intC = null;
	
	function __construct($c = 0) {
		if ($this->isNumeric ( $c )) {
			$this->intC = $c;
		} else {
			throw new Exception ( 'Pls, Entry Numeric Charactor.' );
		}
	}
	
	/**
	 *
	 * @deprecated
	 *
	 */
	public function isNumeric() {
		return (is_numeric ( $this->intC ) || is_real ( $this->intC )) ? true : false;
	}
	
	private function setChar($c) {
		$this->intC = $c;
	}
	
	private function getChar() {
		return $this->intC;
	}
	
	public function __toString() {
		return $this->intC;
	}
}
?>