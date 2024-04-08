<?php
	include("../global.php");

	$m_id = $_GET['m_id'];

	$q = mysql_query("SELECT * FROM member WHERE id = '$m_id' ");
	$rs = mysql_fetch_array($q);
	if ($rs['type'] == 2) {
		if ($rs['img_profile'] != "") {
			$img_profile = "http://www.praasia.com/img_profile/_thumbnail/".$rs['img_profile'];
		}else{
			$img_profile = "http://www.praasia.com/img_profile/_thumbnail/logodefault_general.jpg";
		}
	}else{
		if ($rs['head2'] != "") {
			$img_profile = "http://www.praasia.com/img/head/".$rs['head2'];
		}else{
			$img_profile = "http://www.praasia.com/images/logodefualt.jpg";
		}
	}

	$contactexplode = explode("/", $rs['contact']);
	if($contactexplode[0]=="line"){
		$contact = "Line ID : ".$contactexplode[1];
	}
	else if($contactexplode[0]=="wechat"){
		$contact = "Wechat ID : ".$contactexplode[1];
	}
	
	$items = array(
		'id' => $rs['id'],
		'name' => $rs['name'],
		'country' => $rs['country'],
		'mobile' => $rs['mobile'],
		'email' => $rs['email'],
		'contact' => $contact,
		'img_profile' => $img_profile
	);

	echo json_encode($items);

?>