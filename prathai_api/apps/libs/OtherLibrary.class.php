<?php
class OtherLibrary {
	static public function dmy2ymd($d, $s = "/") {
		$_v = "";
		if ($d != "") {
			$_split = explode($s, $d);
			$_y = $_split[2];
			$_m = $_split[1];
			$_d = $_split[0];
			if ($_y != "") {
				if ($_m != "") {
					if ($_d != "") {
						$_v = $_y . "-" . $_m . "-" . $_d;
					}
				}
			}
		}

		return $_v;
	}

	static public function ymd2dmy($d, $s = "/") {
		$_v = "";
		if ($d != "") {
			$_split = explode($s, $d);
			$_d = $_split[2];
			$_m = $_split[1];
			$_y = $_split[0];
			if ($_d != "") {
				if ($_m != "") {
					if ($_y != "") {
						$_v = $_d . "/" . $_m . "/" . $_y;
					}
				}
			}
		}
		
		return $_v;
	}
	
	
}

?>