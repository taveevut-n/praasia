<?php
	session_start();
	if( ($_SESSION['adminshop_id'] == '') || (!isset($_SESSION['adminshop_id']) )) {  
		echo "0";
	}
?>