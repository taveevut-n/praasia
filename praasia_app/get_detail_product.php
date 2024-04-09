<?php
	include("../global.php");

    $prod_id = $_GET['product_id'];

	$sql = "SELECT p.*, m.shopname, m.id FROM product AS p, member AS m WHERE p.shop_id = m.id AND p.product_id = '$prod_id' ";
    $q=mysql_query($sql);
    if ($q) {
        $rs = mysql_fetch_array($q);
        if($rs['pic1'] != ''){
            $pic1 = "http://".$_SERVER['SERVER_NAME']."/slir/w500-h500-c500:500/img/amulet/".$rs['pic1'];
        }else{
            $pic1 = "default.png";
        }
        if($rs['pic2'] != ''){
            $pic2 = "http://".$_SERVER['SERVER_NAME']."/slir/w500-h500-c500:500/img/amulet/".$rs['pic2'];
        }else{
            $pic2 = "default.png";
        }
        if($rs['pic3'] != ''){
            $pic3 = "http://".$_SERVER['SERVER_NAME']."/slir/w500-h500-c500:500/img/amulet/".$rs['pic3'];
        }else{
            $pic3 = "default.png";
        }
        if($rs['pic4'] != ''){
            $pic4 = "http://".$_SERVER['SERVER_NAME']."/slir/w500-h500-c500:500/img/amulet/".$rs['pic4'];
        }else{
            $pic4 = "default.png";
        }
        $items = array(
            "id"=>$rs['id'],
            "product_id"=>$rs['product_id'],
            "name"=>$rs['name'],
            "shopname"=>$rs['shopname'],
            "price"=>$rs['price'],
            "status"=>$rs['status'],
            "pic1"=>$pic1,
            "pic2"=>$pic2,
            "pic3"=>$pic3,
            "pic4"=>$pic4
        );
    }
    
    echo json_encode($items);
?>