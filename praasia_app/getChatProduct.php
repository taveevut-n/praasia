<?php
	include("../global.php");

    $items = array();

	$sql = "SELECT product_id, name, price, pic1 FROM product WHERE product_id = '".$_GET['product_id']."' ORDER BY product_id DESC";
	$q = mysql_query($sql);
    if($q){
        $rs = mysql_fetch_array($q);
        if($rs['pic1'] != ''){
            $pic1 = "http://".$_SERVER['SERVER_NAME']."/slir/w500-h500-c500:500/img/amulet/".$rs['pic1'];
        }else{
            $pic1 = "http://".$_SERVER['SERVER_NAME']."/slir/w500-h500-c500:500/img/amulet/default.png";
        }
    }
    $items = array(
        "product_id"=>$rs['product_id'],
        "name"=>$rs['name'],
        "price"=>$rs['price'],
        "pic1"=>$pic1,
    );

    echo json_encode($items);
?>