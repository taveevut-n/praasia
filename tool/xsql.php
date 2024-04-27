<?php
	include("global.php");

	echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />';

	date_default_timezone_set("Asia/Bangkok");
	ini_set('max_execution_time',60); // 60 seconds for max execution time

	// // Unlink image not equal value in database post_id -----------------------------------------------------------------

	// $l = 1;

	// // $resutlt = mysql_query("SELECT * FROM `product` WHERE shop_id NOT IN (SELECT id FROM `member`)");
	// // while ($r = mysql_fetch_array($resutlt)) {
	// // 	echo $l++.' - '.$r['product_id'].'/'.$r['shop_id'].'<br/>';

	// // 	unlink("img/amulet/".$r['pic1']);
	// // 	unlink("img/amulet/".$r['pic2']);
	// // 	unlink("img/amulet/".$r['pic3']);
	// // 	unlink("img/amulet/".$r['pic4']);
	// // }
	// // echo "Y";


	// // Unlink image not equal value in database -------------------------------------------------------------------------

	// $arrOrigin = array("default.png"); //"default.png"
	// $arrImage = array();

	// $resutlt = mysql_query("SELECT * FROM `product` ");
	// while ($r = mysql_fetch_array($resutlt)) {
	// 	array_push($arrOrigin,$r['pic1']);
	// 	array_push($arrOrigin,$r['pic2']);
	// 	array_push($arrOrigin,$r['pic3']);
	// 	array_push($arrOrigin,$r['pic4']);
	// }

	// $arrOriginResult = array_unique(array_values(array_filter($arrOrigin))); // remove null value
	// // foreach ($arrOriginResult as $key => $value) {
	// // 	echo $l++.' - '.$value.'<br/>';
	// // }

	// foreach(glob('./img/amulet/*.*') as $filename){
	// 	array_push($arrImage, end(explode("/", $filename)) ); 
	// 	// echo $l++.' - '.end(explode("/", $filename)).'<br/>'; 
	// }

	// $arrImageResult = array_values(array_filter($arrImage)); // remove null value
	// foreach (array_unique($arrImageResult) as $key => $value) {

	// 	if (!in_array("$value", $arrOrigin)) {
	// 		echo $l++.' - '.$value.'<br/>';
	// 		@unlink("img/amulet/".$value);
	// 	}

	// }




	$resutlt = mysql_query("SELECT * FROM `twe_category_main` ");
	while ($r = mysql_fetch_array($resutlt)) {
		echo $r['main_id'].'</br>';
		$l = 1;
		$twe_category = mysql_query("SELECT * FROM `twe_category` WHERE main_id = ".$r['main_id']." ");
		while ($rtwe_category = mysql_fetch_array($twe_category)) {
			mysql_query("UPDATE `twe_category` SET order_num = $l WHERE catalog_id = ".$rtwe_category['catalog_id']." ");
			echo '--'.$rtwe_category['catalog_name'].'->'.$l.'</br>';
			$l++;
		}

	}
