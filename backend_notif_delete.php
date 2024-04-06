<?php
	include("global.php");
	
	$do_what = $_POST['do_what'];
	if($do_what == "delete")
	{
		mysql_query("update product set notification_del = 1 ,notification_created = NOW() where product_id = '".$_POST['id']."' ");
	}

	if($do_what == "no_delete")
	{
		mysql_query("update product set notification_del = 0 ,notification_created = '0000-00-00 00:00:00' where product_id = '".$_POST['id']."' ");
	}

	if($do_what == "tag_delete")
	{
		$pushkeyword = array();
		foreach ($_POST['item'] as $key => $value) {
			array_push($pushkeyword, $value);
		}
		$result_keyword = implode(",", $pushkeyword);
		mysql_query("update product set product_keyword = '$result_keyword' where product_id = '".$_POST['id']."' ");
	}

	if($do_what == "tag_product_key")
	{
		$pushkeyword = array();
		foreach ($_POST['item'] as $key => $value) {
			array_push($pushkeyword, $value);
		}
		$result_keyword = implode(",", $pushkeyword);
		mysql_query("update product_key set proky_keyword = '$result_keyword' where proky_id = '".$_POST['id']."' ");
	}
?>
