<?php

class CharFormat extends String {
	private $s_format = null;
	private $strString = null;
	
	public function __construct($s = null, Objects $o = null) {
		$this->s_format = $s;
	}
	
	private function selectPatternObject(Objects $o) {
		$sPattern = null;
		if (is_a ( $o, "Integer" )) {
			$sPattern = "integer";
		} elseif (is_a ( $o, "String" )) {
			$sPattern = "string";
		} elseif (is_a ( $o, "DateTime" )) {
			$sPattern = "datetime";
		}	
	}
	
	public function __toString() {
		return new String($this->s_format);
	}
}
?>