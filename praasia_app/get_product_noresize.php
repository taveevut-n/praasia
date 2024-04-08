<?php
	include("../global.php");
    include("function_image.php");

    $prod_id = $_GET['product_id'];

	$sql = "SELECT p.*, m.shopname, m.id FROM product AS p, member AS m WHERE p.shop_id = m.id AND p.product_id = '$prod_id' ";
    $q=mysql_query($sql);
    if ($q) {
        $rs = mysql_fetch_array($q);
        $items = array(
            "pic1"=>$rs['pic1'],
            "pic2"=>$rs['pic2'],
            "pic3"=>$rs['pic3'],
            "pic4"=>$rs['pic4']
        );
    }
    
    echo json_encode($items);
?>