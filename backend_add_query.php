<?php
	include("global.php");

	$do_what = $_POST["do_what"];

	if($do_what == "get_CategoryData"){
		
		$items = array();
		$q = mysql_query("SELECT *,catalog_name".$_POST['lang']." AS catalog_name  FROM twe_category WHERE main_id = ".$_POST['val']." AND active = 2 ORDER BY order_num ");
		while ( $result = mysql_fetch_object($q)) {
			array_push($items, $result);
		}

		$result["rows"] = $items;
		
		echo json_encode($result);
	}

	if($do_what == "pra_categorytousually"){

		$lang = ($_POST['lang'] == "")?'นำออก':'拆除';
		$arrJsonreturn = array('lang' => NULL,'data' => NULL);
		$arr = array();

		$result = mysql_fetch_array(mysql_query("SELECT *,catalog_name".$_POST['lang']." AS catalog_name FROM twe_category WHERE catalog_id = '".$_POST['v']."' "));

		$arrJsonreturn['lang'] = $lang;
		$arrJsonreturn['data'] = $result;

		echo json_encode($arrJsonreturn);

		// category_usually
		$r = mysql_fetch_array(mysql_query("SELECT * FROM twe_category_usually WHERE member_id = '".$_SESSION['member_id']."' "));
		$result_exp = explode(",", $r['catalog_id']);
		foreach ($result_exp as $key => $value) {
			array_push($arr, $value);
		}
		array_push($arr, $catalog_id);

		$arr_result = array_values(array_filter($arr)); // remove null value
		$result_imp = implode(",", array_unique($arr_result));

		$num_rec =mysql_num_rows(mysql_query("SELECT * FROM twe_category_usually WHERE member_id = '".$_SESSION['member_id']."' "));
		if($num_rec == 0){
			mysql_query("INSERT INTO twe_category_usually (catalog_id,member_id) VALUES ('$result_imp','".$_SESSION['member_id']."')");
		}else{
			mysql_query("UPDATE twe_category_usually SET catalog_id = '$result_imp' WHERE member_id = '".$_SESSION['member_id']."' ");
		}
	}

	if($do_what == "add_usually"){

		$main_val = trim($_POST['main_val']);
		$newCatname_val = trim($_POST['newCatname_val']);
		$newCatMeasure_val = trim($_POST['newCatMeasure_val']);
		$newCatPorvince_val = trim($_POST['newCatPorvince_val']);

		$lang = ($_POST['lang'] == "")?'นำออก':'拆除';
		$arrJsonreturn = array('lang' => NULL,'data' => NULL,'result' => false);
		$arr = array();

		$checkcatduplicate = mysql_fetch_array(mysql_query("SELECT * FROM `twe_category` WHERE catalog_name LIKE '%".$newCatname_val.' '.$newCatMeasure_val."%' "));
		if(empty($checkcatduplicate)){

			$count = mysql_result(mysql_query("SELECT COUNT(*)+1 FROM `twe_category` WHERE main_id = $main_val  "), 0);
			mysql_query("INSERT INTO twe_category (main_id,catalog_name,order_num) VALUES ('$main_val','".$newCatname_val.' '.$newCatMeasure_val.' '.$newCatPorvince_val."','$count')");
		
			$catalog_id = mysql_insert_id();

			$result = mysql_fetch_array(mysql_query("SELECT *,catalog_name".$_POST['lang']." AS catalog_name FROM twe_category WHERE catalog_id = $catalog_id "));
			$arrJsonreturn['lang'] = $lang;
			$arrJsonreturn['data'] = $result;
			$arrJsonreturn['result'] = true;
		}

		echo json_encode($arrJsonreturn);

		// category_usually
		$r = mysql_fetch_array(mysql_query("SELECT * FROM twe_category_usually WHERE member_id = '".$_SESSION['member_id']."' "));
		$result_exp = explode(",", $r['catalog_id']);
		foreach ($result_exp as $key => $value) {
			array_push($arr, $value);
		}
		array_push($arr, $catalog_id);

		$arr_result = array_values(array_filter($arr)); // remove null value
		$result_imp = implode(",", array_unique($arr_result));

		$num_rec =mysql_num_rows(mysql_query("SELECT * FROM twe_category_usually WHERE member_id = '".$_SESSION['member_id']."' "));
		if($num_rec == 0){
			mysql_query("INSERT INTO twe_category_usually (catalog_id,member_id) VALUES ('$result_imp','".$_SESSION['member_id']."')");
		}else{
			mysql_query("UPDATE twe_category_usually SET catalog_id = '$result_imp' WHERE member_id = '".$_SESSION['member_id']."' ");
		}
	}

	if($do_what == "del_usually"){
		$r = mysql_fetch_array(mysql_query("SELECT * FROM twe_category_usually WHERE main_id = '".$_POST['main_val']."' AND member_id = '".$_SESSION['member_id']."' "));

		$array = explode(",", $r['catalog_id']);

		if (($key = array_search($_POST['x_id'], $array)) !== false) {
			unSET($array[$key]);

			$result_imp = implode(",", array_unique($array));
			mysql_query("UPDATE twe_category_usually SET catalog_id = '$result_imp' WHERE main_id = '".$_POST['main_val']."' AND member_id = '".$_SESSION['member_id']."' ");
		}
	}
?>
