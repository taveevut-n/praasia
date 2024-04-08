<?php
class Utility {
	static public function goToURL($s) {
		if ($s != null or $s != "")
			header ( "location:{$s}" );
		else
			throw new Exception ( "URL is not be empty." );
			
		
	}
}
?>