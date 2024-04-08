<?php
	if($_SESSION['adminid']==''){
	al('Please Login!');
	redi4('../logout.php');
	}

?>