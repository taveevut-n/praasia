<?php

	include("../global.php");

	$postdata = file_get_contents("php://input");
    $request = json_decode($postdata);
    $user = $request->user;
    $pass = $request->pass;

	$q = "SELECT * FROM member WHERE username='".trim($user)."' AND password='".trim( md5(base64_encode(md5(md5($pass)))))."' AND active= '2' ";
	$db->query($q);
	if($db->num_rows()>0){

		$db->next_record();

		$data = array(
			'id' => $db->f(id),
			'success' => true
		);
		
		echo json_encode($data);
	}else{
		echo json_encode(array('msg' => 'รหัสผ่านไม่ถูกต้อง / 密码不正确'));
	}
		
?>