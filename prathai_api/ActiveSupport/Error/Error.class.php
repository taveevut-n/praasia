<?php

class Error {
	
	private $a_error;
	
	/**
	 * 
	 */
	function __construct() {
		$this->a_error = array ();
	
	}
	
	public function setError(Validate $o_) {
	
	}
	
	public function render() {
		$s_tag = "<table border=\"1\" cellpadding=\"4\" cellspecing=\"0\">";
		$s_tag .= "<tr>";
		$s_tag .= "<td class=\"error_title\">::$this->s_error_title</td>";
		$s_tag .= "</tr>";
		$s_tag .= "<tr>";
		$s_tag .= "<td> </td>";
		$s_tag .= "</tr>";
		$s_tag .= "</table>";
	}
	
	public function show() {
		self::render ();
	}
}

?>