<?php
	include("../global.php");

    $sql = "SELECT * FROM conversation_product, product WHERE 
    	conversation_product.cp_product = product.product_id AND 
    	conversation_product.c_id = '".$_GET['c_id']."' ";
    $q = mysql_query($sql);

    $items = array();
    while ($row = mysql_fetch_array($q)) {
        $ext = strtolower(array_pop(explode('.',$row["pic1"])));
        if( $ext == "jpg" || $ext == "jpeg" || $ext == "png" || $ext == "gif" ){
            $row['pic1'] = "http://".$_SERVER['SERVER_NAME']."/slir/w120-h120-c120:120/img/amulet/".$row['pic1'];
        }else{
            $row['pic1'] = "http://".$_SERVER['SERVER_NAME']."/img/amulet/default.png";
        }
        array_push($items, $row);
    }
    $data['result'] = $items;
    
	echo json_encode($data);
?>