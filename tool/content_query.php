<?php
	include('../global.php');

	$do_what = $_POST['do_what'];

	if($do_what == "update_group"){
		$x_category_id = $_POST['v'];
		$x_group_id = $_POST['group_val'];

		foreach ($x_category_id as $key => $value) {
			mysql_query("update catalog_cert set top_id = '$x_group_id' where catalog_id = '$value'");
		}
	}

	if($do_what == "product_group"){

		foreach ($_POST['v'] as $key => $v) {

			$r = mysql_fetch_array(mysql_query("select * from datacert where datacert_id = '".$v."' "));
			$arr = explode(",", $r['group_category_id']);

			array_push($arr, $_POST['catalog_val']);

			$emp_null = array_values(array_filter($arr));
			$result_imp = implode(",", array_unique($emp_null));

			mysql_query("update datacert set group_category_id = '$result_imp' where datacert_id = '".$v."' ");
		}
	}

	if($do_what == "del_cat"){
		$arr_db = array();

		$r = mysql_fetch_array(mysql_query("select * from datacert where datacert_id = '".$_POST['idproduct']."' "));
		$exp_catdb = explode(",", $r['group_category_id']);
		foreach ($exp_catdb as $key => $value) {
			array_push($arr_db, $value);
		}

		if (($key = array_search($_POST['idcat'], $arr_db)) !== false) {
			unset($arr_db[$key]);

			$arr_db_result = array_values(array_filter($arr_db)); // remove null value
			$result_imp = implode(",", array_unique($arr_db_result));
			mysql_query("update datacert set group_category_id = '$result_imp' where datacert_id = '".$_POST['idproduct']."' ");
		}
	}
?>