<?
	include('../global.php');

	$list = $_POST['list'];

	$output = array();
	$list = parse_str($list,$output);
	foreach ($output['item'] as $key => $value) {
		mysql_query("UPDATE banner SET order_num = '".($key+1)."' WHERE banner_id = '$value'  ");
	}
?>