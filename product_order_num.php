<?php
	include("global.php");

	$q_shop = mysql_query("select * from product group by shop_id order by shop_id asc");
	while($shop = mysql_fetch_array($q_shop)){
		$l = 0;
		$q_product = mysql_query("select * from product where shop_id = '".$shop["shop_id"]."' order by order_num asc");
		while($product = mysql_fetch_array($q_product)){
			$l++;
			echo $shop["shop_id"]." ".$product["order_num"]." ".$l."<br/>";
			mysql_query("update product set order_num = '$l' where product_id = '".$product["product_id"]."'");
		}
	}
?>
