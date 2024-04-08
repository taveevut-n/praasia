<?php include("../global.php");

	$postdata = file_get_contents("php://input");
    $request = json_decode($postdata);
	$username = $request->username;
	$password = $request->password;
	$name = $request->name;
	$country = $request->country;
	$tel = $request->tel;
	$email = $request->email;
	$typecontact = $request->typecontact;
	$type = $request->type;

	// echo $username.'='.$password.'='.$name.'='.$country.'='.$tel.'='.$email.'='.$typecontact.'='.$type;

	$q = "SELECT * FROM member WHERE username = '$username'";
	$db->query($q);
	$numrow_username = $db->num_rows();
	if ($numrow_username > 0)
	{
		echo "Username นี้นี้มีคนใช้แล้ว / 这个 Username 已被用";
	}
	else
	{  
		$q = "INSERT INTO `member` 
					( 
						`id`, 
						`type`, 
						`username`, 
						`password`, 
						`name`, 
						`email`, 
						`mobile`, 
						`country`, 
						`contact`, 
						`active`
					) VALUES (
						'', 
						'2', 
						'$username', 
						'".md5(base64_encode(md5(md5($password))))."', 
						'$name', 
						'$email', 
						'$tel', 
						'$country', 
						'$typecontact/$type', 
						'2'
					)";
		$db->query($q);
		echo "ลงทะเบียนเรียบร้อยแล้ว / 注册成功";
	}

?>
