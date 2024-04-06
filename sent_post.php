<?php
	include('global.php');

	echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />';

	$do_what = $_POST['do_what'];

	$useful_array = $_POST['useful'];
	foreach($useful_array as $k => $v){
		$useful = $useful."|".$v;
	}

	$pushkeyword = array();
	foreach ($_POST['keyword_text'] as $key => $value) {
		array_push($pushkeyword, $value);
	}
	$result_keyword = implode(",", $pushkeyword);	

	if($do_what == "insert"){
		$q_count = mysql_query("SELECT * FROM member WHERE id = '".$_SESSION['adminshop_id']."'");
		while($s_count = mysql_fetch_array($q_count)){	
			$shop_date = $s_count['shop_date'];
			$shop_date_piece = $s_count['shop_date_piece'];
		}
		if($shop_date > $date_now){
			if(( $shop_date_piece >= 0) && ( $shop_date_piece < 11))  {
				$shop_date_piece_add = $shop_date_piece + 1;
				mysql_query("UPDATE `member` SET shop_date_piece = '$shop_date_piece_add' WHERE id = '".$_SESSION['adminshop_id']."'");					
			}
		}

		if($shop_date < $date_now){
			$adddate1 = date("Y-m-d H:i:s",strtotime("+1 day",strtotime($date_now)));
			mysql_query("UPDATE `member` SET `shop_date_piece` = '0' WHERE id = '".$_SESSION['adminshop_id']."'");
			$q_count2 = mysql_query("SELECT * FROM member WHERE id = '".$_SESSION['adminshop_id']."'");
			while($s_count2 = mysql_fetch_array($q_count1)){
				$shop_date2 = $s_count['shop_date'];
				$shop_date_piece2 = $s_count2['shop_date_piece'];
			}
			if(( $shop_date_piece2 >= 0) && ( $shop_date_piece2 < 11))  {
				$shop_date_piece2_add = $shop_date_piece2 + 1;
				mysql_query("UPDATE `member` SET shop_date_piece = '$shop_date_piece2_add' WHERE id = '".$_SESSION['adminshop_id']."'");	
			}
		}

		$q_count1 = mysql_query("SELECT * FROM `product` WHERE shop_id = '".$_SESSION['adminshop_id']."' AND DATE_FORMAT(created,'%Y-%m-%d') = '".date("Y-m-d")."' ");
		$num_count1 = mysql_num_rows($q_count1);

		if ($num_count1 > 10 ) {
			al('คุณได้ลงสินค้าครบจำนวน 10 รายการ โปรดลงใหม่ในวันเวลารุ่งขึ้นอีกครั้ง / ลงสินค้าห้ามเกิน 10 ชิ้น/上传产品一天不能超过尊');
			redi2();
		}else if($_POST['price'] == 0 || $_POST['price'] == ''){
			al('กรุณาลงราคาให้อยู่ในความเหมาะสม หากลงราคา จะสะดวกในการตัดสินใจของลูกค้าและการซื้อ-ขายระหว่างประเทศง่ายขึ้น 请把圣物适后的价格填好 这样会方便国外顾客的交易');
			redi2();
		}else{
			$q="SELECT * FROM `product` WHERE shop_id ='".$_SESSION['adminshop_id']."' order by order_num DESC ";
			$dbproduct= new nDB();	
			$dbproduct->query($q);
			$dbproduct->next_record();
			$n_order = $dbproduct->f(order_num);
			$q = "INSERT INTO `product` 
					( 
						`product_id`, 
						`shop_id`, 
						`catalogpra_id`, 
						`catalog_id`, 
						`name`, 
						`price`, 
						`status`, 
						`prarelease`, 
						`detail`, 
						`active`, 
						`warning`, 
						`certificate`, 
						`other`, 
						`watprice`, 
						`tag`, 
						`pic1`, 
						`pic2`, 
						`pic3`, 
						`pic4`, 
						`view_num`, 
						`date_add`, 
						`created`, 
						`score`, 
						`order_num`, 
						`detailcn1`, 
						`detailcn2`, 
						`detailcn4`, 
						`detailcn5`, 
						`detailcn6`, 
						`detailcn7`, 
						`detailcn8`, 
						`detailcn9`, 
						`detailcn10`, 
						`detailcn11`, 
						`detailcn12`, 
						`main_id`
					) 
					VALUES 
					( 
						'', 
						'".$_SESSION['adminshop_id']."', 
						'".$_POST['catalogpra']."', 
						'".$_POST['catalog']."', 
						'".$_POST['name']."', 
						'".$_POST['price']."', 
						'".$_POST['status']."', 
						'".$_POST['release']."', 
						'".$_POST['detail']."', 
						'2', 
						'".$_POST['warning']."', 
						'".$_POST['certificate']."', 
						'".$_POST['other']."', 
						'".$_POST['watprice']."', 
						'".$_POST['tag']."', 
						'', 
						'', 
						'', 
						'', 
						'0', 
						'".time()."', 
						'".date("Y-m-d H:i:s")."', 
						'100', 
						'".($n_order+1)."', 
						'".$_POST['namepra']."', 
						'".$_POST['mix']."', 
						'".$_POST['frame']."', 
						'".$_POST['roon']."', 
						'".$_POST['pim']."', 
						'".$_POST['condition']."', 
						'".$_POST['size']."', 
						'".$_POST['wat']."', 
						'".$_POST['geji']."', 
						'".$_POST['year']."', 
						'".$useful."', 
						'".$_POST['main_id']."' 
					)";
			$db->query($q);
			$inserted_id = mysql_insert_id();

			$pushkeyword = array();
			$arr_db = array();
			$arr_usually = array();

			foreach ($_POST['keyword_text'] as $key => $value) {
				array_push($pushkeyword, $value);
			}
			$result_keyword = implode(",", $pushkeyword);	
			
			if($_POST['usually']){
				foreach ($_POST['usually'] as $key => $value) {
					array_push($arr_db, $value);
					array_push($arr_usually, $value);
				}
			}

			array_push($arr_db, $_POST['pra_category_id']);
			array_push($arr_usually, $_POST['pra_category_id']);		

			$r = mysql_fetch_array(mysql_query("SELECT * FROM product WHERE product_id = '$inserted_id' "));
			$exp_catdb = explode(",", $r['group_category_id']);
			foreach ($exp_catdb as $key => $value) {
				array_push($arr_db, $value);
			}	
			
			$arr_db_result = array_values(array_filter($arr_db)); // remove null value
			$result_imp = implode(",", array_unique($arr_db_result));

			mysql_query("UPDATE product SET product_keyword = '$result_keyword' , group_category_id = '$result_imp' WHERE product_id = '$inserted_id' ");

			$r_usually = mysql_fetch_array(mysql_query("SELECT * FROM twe_category_usually WHERE member_id = '".$_SESSION['member_id']."' "));
			if(empty($r_usually)){
				mysql_query("INSERT INTO twe_category_usually (catalog_id,member_id) VALUES ('$result_imp','".$_SESSION['member_id']."') ");
			}else{
				$exp_usually = explode(",", $r_usually['catalog_id']);
				foreach ($exp_usually as $key => $value) {
					array_push($arr_usually, $value);
				}

				$arr_db_usually = array_values(array_filter($arr_usually)); // remove null value
				$result_imp_usually = implode(",", array_unique($arr_db_usually));

				mysql_query("UPDATE twe_category_usually SET catalog_id = '$result_imp_usually' WHERE member_id = '".$_SESSION['member_id']."' ");
			}

			$q="UPDATE `member` SET `date_update` = '".time()."' WHERE id = '".$_SESSION['adminshop_id']."' ";		
			$db->query($q);	
			// ขายแล้ว
			if($_POST['status']=='5') {
				$q="UPDATE `member` SET `score` = `score`+20 WHERE id = '".$_SESSION['adminshop_id']."' ";		
				$db->query($q);	
			}else {
				$q="UPDATE `member` SET `score` = `score`+10 WHERE id = '".$_SESSION['adminshop_id']."' ";		
				$db->query($q);		
			}

			if ($_POST['certificate']=='1') {
				$q="UPDATE `member` SET `score` = `score`+100 WHERE id = '".$_SESSION['adminshop_id']."' ";		
				$db->query($q);						
			}

			for($mf=1;$mf<=4;$mf++){
				$upf[$mf] = uppic($_FILES['file'.$mf],$mf,"img/amulet/",$_POST['h_pic'.$mf]); // Same folder
				if($upf[$mf]!=''){
					$q = "SELECT * FROM `product`ORDER BY product_id DESC";
					$db->query($q);
					$db->next_record();	 
					$product_id=$db->f(product_id);
					$q = "UPDATE `product` SET `pic$mf` = '".$upf[$mf]."' WHERE `product_id` =".$product_id." ";
					$db->query($q);
				}
			}

			if($_POST["translate_checkbox"] == "leave_name"){
				$conn = mysql_connect("localhost","prathai_new","twe31219#");
				mysql_select_db("prathai_new",$conn);
				mysql_query("SET NAMES UTF8");
				mysql_query("SET character_set_results=utf8");
				mysql_query("SET character_set_client=utf8");
				mysql_query("SET character_set_connection=utf8");
				$name_text = $_POST["name"];
				$n_name = mysql_num_rows(mysql_query("SELECT * FROM pra_translate_name WHERE name_text = '$name_text'"));
				if($n_name == 0){
					$product_last = mysql_fetch_array(mysql_query("SELECT * FROM product order by product_id desc limit 1"));
					mysql_query("INSERT INTO pra_translate_name( name_id, name_text, name_translated, leave_date, product_id ) VALUES( '', '$name_text', '$name_text', '".date("Y-m-d H:i:s")."', '".$product_last["product_id"]."' )");
				}
			}

			// al('บันทึกข้อมูลเรียบร้อย / 信息已被记录');
			redi4('backend.php');	
		}
		
	}

	if($do_what == "edit"){
		$q="UPDATE `product` 
				SET `catalogpra_id` = '".$_POST['catalogpra']."',	
						`catalog_id` = '".$_POST['catalog']."',		
						`name` = '".$_POST['name']."',
						`price` = '".$_POST['price']."',
						`status` = '".$_POST['status']."',
						`prarelease` = '".$_POST['release']."',
						`warning` = '".$_POST['warning']."',
						`certificate` = '".$_POST['certificate']."',
						`watprice` = '".$_POST['watprice']."',
						`other` = '".$_POST['other']."',
						`detail` = '".$_POST['detail']."',
						`tag` = '".$_POST['tag']."',
						`price` = '".$_POST['price']."',
						`detailcn1` = '".$_POST['namepra']."',
						`detailcn2` = '".$_POST['mass']."' ,
						`detailcn4` = '".$_POST['frame']."' ,
						`detailcn5` = '".$_POST['roon']."',
						`detailcn6` = '".$_POST['pim']."',
						`detailcn7` = '".$_POST['condition']."',
						`detailcn8` = '".$_POST['size']."',
						`detailcn9` = '".$_POST['wat']."',
						`detailcn10` = '".$_POST['geji']."',
						`detailcn11` = '".$_POST['year']."',
						`detailcn12` = '".$useful."',
						`main_id` = '".$_POST['main_id']."',
						`product_keyword` = '".$result_keyword."' 
				WHERE `product_id` =".$_POST['h_product_id']." ";
		$db->query($q);
		for($mf=1;$mf<=5;$mf++){
			$upf[$mf]=uppic($_FILES['file'.$mf],$mf,"img/amulet/",$_POST['h_pic'.$mf]); // Same folder
			if($upf[$mf]!=''){
				$q="UPDATE `product` SET `pic$mf` = '".$upf[$mf]."' WHERE `product_id` =".$_POST['h_product_id']." ";
				$db->query($q);
			}
		}

		$q="SELECT * FROM product WHERE product_id = ".$_POST['h_product_id']." ";
		$checkstatus= new nDB();
		$checkstatus->query($q);
		$checkstatus->next_record();
		if ($checkstatus->f(check_status)=='0') {
			if ($_POST['status']=='5') {
				$q="UPDATE `product` SET `check_status` = '1' WHERE `product_id` =".$_POST['h_product_id']." ";
				$db->query($q);
				$q="UPDATE `member` SET `score` = `score`+50 WHERE id = '".$_SESSION['adminshop_id']."' ";		
				$db->query($q);				  									
			}
		}

		if($_POST["translate_checkbox"] == "leave_name"){
			$conn = mysql_connect("localhost","prathai_new","twe31219#");
			mysql_select_db("prathai_new",$conn);
			mysql_query("SET NAMES UTF8");
			mysql_query("SET character_set_results=utf8");
			mysql_query("SET character_set_client=utf8");
			mysql_query("SET character_set_connection=utf8");
			$name_text = $_POST["name"];
			$n_name = mysql_num_rows(mysql_query("SELECT * FROM pra_translate_name WHERE name_text = '$name_text'"));
			if($n_name == 0){
				mysql_query("INSERT INTO pra_translate_name( name_id, name_text, name_translated, leave_date, product_id ) VALUES( '', '$name_text', '$name_text', '".date("Y-m-d H:i:s")."', '".$_POST['h_product_id']."' )");
			}
		}

		// start group category on product
		$arr_db = array();
		$arr_usually = array();
		$idlast_product = $_POST['h_product_id'];

		if($_POST['usually']){
			foreach ($_POST['usually'] as $key => $value) {
				array_push($arr_db, $value);
				array_push($arr_usually, $value);
			}
		}

		array_push($arr_db, $_POST['pra_category_id']);
		array_push($arr_usually, $_POST['pra_category_id']);

		$arr_db_result = array_values(array_filter($arr_db)); // remove null value
		$result_imp = implode(",", array_unique($arr_db_result));

		mysql_query("UPDATE product SET group_category_id = '$result_imp' WHERE product_id = '$idlast_product' ");

		// twe_category_usually
		$r_usually = mysql_fetch_array(mysql_query("SELECT * FROM twe_category_usually WHERE member_id = '".$_SESSION['member_id']."' "));
		if(empty($r_usually)){
			mysql_query("INSERT INTO twe_category_usually (catalog_id,member_id) VALUES ('$result_imp','".$_SESSION['member_id']."') ");
		}
		else{
			$exp_usually = explode(",", $r_usually['catalog_id']);
			foreach ($exp_usually as $key => $value) {
				array_push($arr_usually, $value);
			}

			$arr_db_usually = array_values(array_filter($arr_usually)); // remove null value
			$result_imp_usually = implode(",", array_unique($arr_db_usually));

			mysql_query("UPDATE twe_category_usually SET catalog_id = '$result_imp_usually' WHERE member_id = '".$_SESSION['member_id']."' ");
		}

		// al('แก้ไขข้อมูลเรียบร้อยแล้วครับ / 信息已被增改');
		redi4("backend.php?s_page=".$_POST['s_page']."");
	}
?>
