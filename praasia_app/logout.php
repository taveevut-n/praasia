<?
	$do_what = $_GET['do_what'];

	if ($do_what == 'logout') {
		echo json_encode(array('success' => true));
	}
?>