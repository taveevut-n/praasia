<?php
	include("../global.php");

    $product_id = $_GET['product_id'];

	$sql = "SELECT p.name, m.shopname, p.price, p.status FROM product AS p, member AS m WHERE p.shop_id = m.shop_id AND p.product_id = '$product_id' ";
    $q=mysql_query($sql);

    $items = array();
    while ($row = mysql_fetch_object($q)) {
    	array_push($items, $row);
    }

    echo json_encode($items);
	
?>
