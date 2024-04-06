<?php
	$conn = mysql_connect("localhost","prathai_new","twe31219#");
	mysql_select_db("prathai_new",$conn);
	mysql_query("SET NAMES UTF8");
	mysql_query("SET character_set_results=utf8");
	mysql_query("SET character_set_client=utf8");
	mysql_query("SET character_set_connection=utf8");

	$q_member = mysql_query("select * from member order by id asc");
	while($member = mysql_fetch_array($q_member)){
		$l = 0;
		$q_product = mysql_query("select * from product where shop_id = '".$member["id"]."' order by product_id asc");
		while($product = mysql_fetch_array($q_product)){
			$l++;
			mysql_query("update product set order_num = '$l' where product_id = '".$product["product_id"]."'");
		}
	}
?>
