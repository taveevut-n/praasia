<?php
/**
 *
 * @author Boonsit
 * @abstract
 * @filesource CoreFramewrok/Charactor.class.php
 */
abstract class Charactor extends AObjects {
	private $c = null;

	function __construct($c = null) {
		$this->c = $c;
	}

	function setChar($c) {
		$this->c = $c;
	}

	function getChar() {
		return ($this->c != null || $this->c != '') ? $this->c : '';
	}

	function __toString() {
		return $this->getChar();
	}
}
?>