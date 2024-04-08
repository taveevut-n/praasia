<?php
	@session_start();

	$_SESSION['aucuser_id'] = "";
	
	if(isset($_SESSION)){
		@session_unset();
		@session_destroy();
	}

?>

<meta http-equiv="refresh" content="0;url=index.php"/>