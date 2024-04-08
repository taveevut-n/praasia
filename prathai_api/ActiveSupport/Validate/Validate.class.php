<?php
class Valid {
	
	private $a_error;
	
	private $s_error_title;
	
	/**
	 * Constructor
	 */
	function __construct() {
		$this->a_error = null;
		$this->s_error_title = " :: ERROR";
	}
	
	public function setErrorTitle($s_title) {
		$this->s_error_title = $s_title;
	}
	
	public function setErrorMessage($s_lable_name, $s_message) {
		$this->a_error [] = array ("s_error_label_name" => $s_lable_name, "s_error_message" => $s_message );
	}
	
	public function render($s_style = "html") {
		$s_tag = "";
		if (count ( $this->a_error ) != 0) {
			if ($s_style == "html") {
				$s_tag = "<table border=\"1\" cellpadding=\"4\" cellspecing=\"0\">";
				$s_tag .= "<tr  bgcolor=\"red\">";
				$s_tag .= "<td class=\"error_title\"><font color=\"#FFFFFF\"><b>$this->s_error_title</b></font></td>";
				$s_tag .= "</tr >";
				$s_tag .= "<tr><td class=\"error_message\"><ul>";
				for($i_loop = 0; $i_loop < count ( $this->a_error ); $i_loop ++) {
					$s_tag .= "<li><font color=\"red\">" . $this->a_error [$i_loop] ['s_error_label_name'] . " : " . $this->a_error [$i_loop] ['s_error_message'] . "</font></li>";
				}
				$s_tag .= "</li></td></tr>";
				$s_tag .= "</table>";
			} else if ($s_style == "json") {
				$s_tag = "{";
				$s_tag .= "valid-status : false,";
				$s_tag .= "valid-object : {";
				for($i_loop = 0; $i_loop < count ( $this->a_error ); $i_loop ++) {
					if (count ( $this->a_error ) != ($i_loop + 1)) {
						$s_tag .= $this->a_error [$i_loop] ['s_error_label_name'] . " : " . $this->a_error [$i_loop] ['s_error_message'] . ",";
					} else {
						$s_tag .= $this->a_error [$i_loop] ['s_error_label_name'] . " : " . $this->a_error [$i_loop] ['s_error_message'];
					}
				}
				$s_tag .= "}";
				$s_tag .= "}";
			}
		}
		return $s_tag;
	}
	
	public function show($s_style = "html") {
		print self::render ( $s_style );
	}
	
	public function validIP($s_text) {
		$b_ = false;
		if (strlen ( $s_text ) < 16) {
			$s_pattern = '/([0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}){1}/';
			$b_ = preg_match ( $s_pattern, $s_text );
		}
		return $b_;
	}
	
	public function validNumber($s_text) {
		return is_numeric ( trim ( $s_text ) );
	}
	
	public function validInteger($s_text) {
		return is_integer ( $s_text );
	}
	
	public function validFloat($s_text) {
		return is_float ( $s_text );
	}
	
	public function validEmail($s_text) {
		$s_pattern = '/^([.0-9a-z_-]+)@(([0-9a-z-]+\.)+[0-9a-z]{2,4})$/i';
		return preg_match ( $s_pattern, trim ( $s_text ) );
	}
	
	public function validENCharactor($s_text) {
		$s_pattern = '/([a-zA-Z])+/';
		return preg_match ( $s_pattern, trim ( $s_text ) );
	}
	
	public function validLessLength($s_text, $i_length = 0) {
		$b_ = false;
		if (strlen ( trim ( $s_text ) ) < $i_length) {
			$b_ = true;
		}
		return $b_;
	}
	
	public function validMoreLength($s_text, $i_length = 0) {
		$b_ = false;
		if (strlen ( trim ( $s_text ) ) > $i_length) {
			$b_ = true;
		}
		return $b_;
	}
	
	public function validConfirmPassword($s_pass, $s_re_pass) {
		$b_ = false;
		if ($s_pass === $s_re_pass) {
			$b_ = true;
		}
		return $b_;
	}
	
	public function validCompare($x_text, $x_re_text, $b_strict = false) {
		$b_ = false;
		if ($b_strict === true) {
			if ($x_text === $x_re_text) {
				$b_ = true;
			}
		} else {
			if ($x_text == $x_re_text) {
				$b_ = true;
			}
		}
		return $b_;
	}
	
	public function validCharactor($s_text) {
		$s_pattern = '/([a-zA-Z])+/';
		return preg_match ( $s_pattern, trim ( $s_text ) );
	}
	
	public function validIsBlank($s_text) {
		$b_ = false;
		if (trim ( $s_text ) != "") {
			$b_ = true;
		} else {
			$b_ = false;
		}
		return $b_;
	}
}
?>