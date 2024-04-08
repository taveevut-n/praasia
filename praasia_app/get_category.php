<?php
	include("../global.php");

	$do_what = $_GET["param"];

	if ($do_what == "1") {
		$sql = "SELECT product_id, name, pic1 FROM product where certificate = '2' ORDER BY product_id DESC LIMIT 300";
		$q=mysql_query($sql);
	    $items = array();
	    while ($row = mysql_fetch_array($q)) {
	    	$ext = strtolower(array_pop(explode('.',$row["pic1"])));
	    	if( $ext == "jpg" || $ext == "jpeg" || $ext == "png" || $ext == "gif" ){
	    		$row['pic1'] = "http://".$_SERVER['SERVER_NAME']."/resize/w120-h120-c120:120/img/amulet/".$row['pic1'];
	    	}else{
	    		$row['pic1'] = "http://".$_SERVER['SERVER_NAME']."/img/amulet/default.png";
	    	}
	    	array_push($items, $row);
	    }
	    echo json_encode($items);
	}

	if ($do_what == "2") {
		$sql = "SELECT product_id, name, pic1 FROM product where recommend = '1' ORDER BY product_id DESC LIMIT 300";
		$q=mysql_query($sql);
	    $items = array();
	    while ($row = mysql_fetch_array($q)) {
	    	$ext = strtolower(array_pop(explode('.',$row["pic1"])));
	    	if( $ext == "jpg" || $ext == "jpeg" || $ext == "png" || $ext == "gif" ){
	    		$row['pic1'] = "http://".$_SERVER['SERVER_NAME']."/resize/w120-h120-c120:120/img/amulet/".$row['pic1'];
	    	}else{
	    		$row['pic1'] = "http://".$_SERVER['SERVER_NAME']."/img/amulet/default.png";
	    	}
	    	array_push($items, $row);
	    }
	    echo json_encode($items);
	}

	if ($do_what == "3") {
		$sql = "SELECT product_id, name, pic1 FROM product where prarelease = '1' ORDER BY product_id DESC LIMIT 300";
		$q=mysql_query($sql);
	    $items = array();
	    while ($row = mysql_fetch_array($q)) {
	    	$ext = strtolower(array_pop(explode('.',$row["pic1"])));
	    	if( $ext == "jpg" || $ext == "jpeg" || $ext == "png" || $ext == "gif" ){
	    		$row['pic1'] = "http://".$_SERVER['SERVER_NAME']."/resize/w120-h120-c120:120/img/amulet/".$row['pic1'];
	    	}else{
	    		$row['pic1'] = "http://".$_SERVER['SERVER_NAME']."/img/amulet/default.png";
	    	}
	    	array_push($items, $row);
	    }
	    echo json_encode($items);
	}

	if ($do_what == "4") {
		$sql = "SELECT product_id, name, pic1 FROM product where prarelease = '2' ORDER BY product_id DESC LIMIT 300";
		$q=mysql_query($sql);
	    $items = array();
	    while ($row = mysql_fetch_array($q)) {
	    	$ext = strtolower(array_pop(explode('.',$row["pic1"])));
	    	if( $ext == "jpg" || $ext == "jpeg" || $ext == "png" || $ext == "gif" ){
	    		$row['pic1'] = "http://".$_SERVER['SERVER_NAME']."/resize/w120-h120-c120:120/img/amulet/".$row['pic1'];
	    	}else{
	    		$row['pic1'] = "http://".$_SERVER['SERVER_NAME']."/img/amulet/default.png";
	    	}
	    	array_push($items, $row);
	    }
	    echo json_encode($items);
	}

	if ($do_what == "5") {
		$sql = "SELECT product_id, name, pic1 FROM product where watprice = '1' ORDER BY product_id DESC LIMIT 300";
		$q=mysql_query($sql);
	    $items = array();
	    while ($row = mysql_fetch_array($q)) {
	    	$ext = strtolower(array_pop(explode('.',$row["pic1"])));
	    	if( $ext == "jpg" || $ext == "jpeg" || $ext == "png" || $ext == "gif" ){
	    		$row['pic1'] = "http://".$_SERVER['SERVER_NAME']."/resize/w120-h120-c120:120/img/amulet/".$row['pic1'];
	    	}else{
	    		$row['pic1'] = "http://".$_SERVER['SERVER_NAME']."/img/amulet/default.png";
	    	}
	    	array_push($items, $row);
	    }
	    echo json_encode($items);
	}

	if ($do_what == "6") {
		$sql = "SELECT product_id, name, pic1 FROM product where other = '1' ORDER BY product_id DESC LIMIT 300";
		$q=mysql_query($sql);
	    $items = array();
	    while ($row = mysql_fetch_array($q)) {
	    	$ext = strtolower(array_pop(explode('.',$row["pic1"])));
	    	if( $ext == "jpg" || $ext == "jpeg" || $ext == "png" || $ext == "gif" ){
	    		$row['pic1'] = "http://".$_SERVER['SERVER_NAME']."/resize/w120-h120-c120:120/img/amulet/".$row['pic1'];
	    	}else{
	    		$row['pic1'] = "http://".$_SERVER['SERVER_NAME']."/img/amulet/default.png";
	    	}
	    	array_push($items, $row);
	    }
	    echo json_encode($items);
	}
	
?>