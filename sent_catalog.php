<? include('global.php'); ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
            	  <?php
	if($_POST['submit']){

		$useful_array = $_POST['useful'];

		foreach($useful_array as $k => $v){
			$useful = $useful."|".$v;
		}

		if($_POST['other']=='') {	
			if ($_POST['release']=='0') {
				al('คุณยังไม่ได้เลือกพระเก่า-ใหม่ / 您还没选择 老牌-新牌');
				exit();
			}
		}
		if($_POST['watprice']=='') {	
			if ($_POST['release']=='0') {
				al('คุณยังไม่ได้เลือกพระเก่า-ใหม่ / 您还没选择 老牌-新牌');
				exit();
			}
		}		
			if ($_POST['name']=='') {
				al('กรุณากรอกชื่อสินค้า / 您还没选择 老牌-新牌');
				exit();
			}		
		if ($_SESSION['adminshop_id']) {
		if($_POST['h_product_id']){
		$q="UPDATE `product` SET 
`catalogpra_id` = '".$_POST['catalogpra']."',	
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
`price` = '".$_POST['price']."',
`detailcn1` = '".$_POST['namepra']."',
`detailcn2` = '".$_POST['mix']."' ,
`detailcn4` = '".$_POST['frame']."' ,
`detailcn5` = '".$_POST['roon']."',
`detailcn6` = '".$_POST['pim']."',
`detailcn7` = '".$_POST['condition']."',
`detailcn8` = '".$_POST['size']."',
`detailcn9` = '".$_POST['wat']."',
`detailcn10` = '".$_POST['geji']."',
`detailcn11` = '".$_POST['year']."',
`detailcn12` = '".$useful."' WHERE `product_id` =".$_POST['h_product_id']." ";

		$db->query($q);
				for($mf=1;$mf<=5;$mf++){
				 $upf[$mf]=uppic($_FILES['file'.$mf],$mf,"img/amulet/",$_POST['h_pic'.$mf]); // Same folder
					 if($upf[$mf]!=''){
				 $q="UPDATE `product` SET `pic$mf` = '".$upf[$mf]."' WHERE `product_id` =".$_POST['h_product_id']." ";
						 $db->query($q);
					 }	
				}			
		al('Eidt data Complete');
		redi4("backend.php?s_page=".$_POST['s_page']."");
		}else{
//				 $date_now = date("Y-m-d H:i:s");
//				 $q_date = mysql_query("select * from member where id = '".$_SESSION['adminshop_id']."' ");
//				 while($s_date = mysql_fetch_array($q_date)){	
//					  if($s_date['shop_date'] == '0000-00-00 00:00:00'){
//							$adddate = date("Y-m-d H:i:s",strtotime("+1 day",strtotime($date_now)));
//							mysql_query("update `member` set `shop_date` = '$adddate' where id = '".$_SESSION['adminshop_id']."'  ");
//					  }
				 }

				$q_count = mysql_query("select * from member where id = '".$_SESSION['adminshop_id']."' ");
				 while($s_count = mysql_fetch_array($q_count)){	
					$shop_date = $s_count['shop_date'];
					$shop_date_piece = $s_count['shop_date_piece'];
				 }
				if($shop_date > $date_now){
							if(( $shop_date_piece >= 0) && ( $shop_date_piece < 6))  {
								$shop_date_piece_add = $shop_date_piece + 1;
										 mysql_query("update `member` set shop_date_piece = '$shop_date_piece_add' where id = '".$_SESSION['adminshop_id']."'  ");					
							}
				}
				if($shop_date < $date_now){
							$adddate1 = date("Y-m-d H:i:s",strtotime("+1 day",strtotime($date_now)));
	//						mysql_query("update `member` set `shop_date` = '$adddate1' , `shop_date_piece` = '0' where id = '".$_SESSION['adminshop_id']."'  ");

				$q_count2 = mysql_query("select * from member where id = '".$_SESSION['adminshop_id']."' ");
						 while($s_count2 = mysql_fetch_array($q_count1)){	
							$shop_date2 = $s_count['shop_date'];
							$shop_date_piece2 = $s_count2['shop_date_piece'];
					}
						if(( $shop_date_piece2 >= 0) && ( $shop_date_piece2 < 6))  {
								$shop_date_piece2_add = $shop_date_piece2 + 1;
										 mysql_query("update `member` set shop_date_piece = '$shop_date_piece2_add' where id = '".$_SESSION['adminshop_id']."'  ");	
							}
				}
					$q_count1 = mysql_query("select * from member where id = '".$_SESSION['adminshop_id']."' ");
						 while($s_count1 = mysql_fetch_array($q_count1)){	
							$shop_date_piece1 = $s_count1['shop_date_piece'];
					}

	if(( $shop_date_piece1 < 6 ) && ($shop_date_piece1 >= 0 )){
					$n_order = mysql_num_rows(mysql_query("select * from product where shop_id = '".$_SESSION['adminshop_id']."'"));
					$q="INSERT INTO `product` ( `product_id` , `shop_id` , `catalogpra_id` , `catalog_id` , `name` , `price` , `status`  , `prarelease`  , `detail`, `active` , `warning` , `certificate` , `other`, `watprice` , `tag` , `pic1` , `pic2`, `pic3` , `pic4` , `view_num` , `date_add` , `score`, order_num, `detailcn1`, `detailcn2`, `detailcn4`, `detailcn5`, `detailcn6`, `detailcn7`, `detailcn8`, `detailcn9`, `detailcn10`, `detailcn11`, `detailcn12`) 
					VALUES (
					'', '".$_SESSION['adminshop_id']."', '".$_POST['catalogpra']."', '".$_POST['catalog']."', '".$_POST['name']."', '".$_POST['price']."', '".$_POST['status']."', '".$_POST['release']."', '".$_POST['detail']."', '2', '".$_POST['warning']."', '".$_POST['certificate']."', '".$_POST['other']."', '".$_POST['watprice']."', '".$_POST['tag']."', '' , '' , '' , '' , '0' , '".time()."' , '100' , '".($n_order+1)."' , '".$_POST['namepra']."', '".$_POST['mix']."', '".$_POST['frame']."', '".$_POST['roon']."', '".$_POST['pim']."', '".$_POST['condition']."', '".$_POST['size']."', '".$_POST['wat']."', '".$_POST['geji']."', '".$_POST['year']."', '".$useful."');";
					$db->query($q);
							for($mf=1;$mf<=4;$mf++){
							 $upf[$mf]=uppic($_FILES['file'.$mf],$mf,"img/amulet/",$_POST['h_pic'.$mf]); // Same folder
								 if($upf[$mf]!=''){
							$q="SELECT * FROM `product`ORDER BY product_id DESC";
							$db->query($q);
							$db->next_record();	 
							$product_id=$db->f(product_id);
							 $q="UPDATE `product` SET `pic$mf` = '".$upf[$mf]."' WHERE `product_id` =".$product_id." ";
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
			$n_name = mysql_num_rows(mysql_query("select * from pra_translate_name where name_text = '$name_text'"));
			if($n_name == 0){
				$product_last = mysql_fetch_array(mysql_query("select * from product order by product_id desc limit 1"));
				mysql_query("insert into pra_translate_name( name_id, name_text, name_translated, leave_date, product_id ) values( '', '$name_text', '$name_text', '".date("Y-m-d H:i:s")."', '".$product_last["product_id"]."' )");
			}
		}



					al('Add Product Complete');
					redi4('backend_add.php');	
				}else{
					al('คุณได้ลงสินค้าครบจำนวน 5 รายการโปรดลงใหม่ในวันเวลา '.$shop_date.' นี้อีกครั้ง / ลงสินค้าห้ามเกิน5ชิ้น/上传产品一天不能超过5尊');
					redi2();	
				}
					}
		} else { 
		al('Please Login Again');
		redi4('index.php');
		}
	}
					  ?>
