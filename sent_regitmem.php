<?php include("global.php"); ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php

if ($_POST['submit'] and ($_SESSION['ses_inum1'] + $_SESSION['ses_inum2'] == $_POST['inum3']))
{
	
	$q = "SELECT * FROM member WHERE username ='" . $_POST['amuletuser'] . "' OR email = '".$_POST['email']."' OR name = '".$_POST['name']."' ";
	$db->query($q);
	$numrow_username = $db->num_rows();
	if ($numrow_username > 0)
	{
		echo "<script language=\"javascript\">alert('Name , Email นี้นี้มีคนใช้แล้ว / 这个 Name, Email 已被用')</script>";
		exit;
	}
	else
	{  
		if ($_POST['type']=='2') {
			$date_expire =date('Y-m-d',strtotime('+1 year'));
		} else {
			$date_expire =date('Y-m-d',strtotime('+99 year'));
		}
		$q = "INSERT INTO `member` 
					( 
						`id` , 
						`type` , 
						`username` , 
						`password`, 
						`name`, 
						`address`, 
						`email`  , 
						`mobile` , 
						`country`, 
						`contact`, 
						`active`,
						`member_expire`
					) VALUES (
						'', 
						'".$_POST['type']."', 
						'" . $_POST['amuletuser'] . "', 
						'" . md5(base64_encode(md5(md5($_POST['amuletpass'])))) . "', 
						'" . $_POST['name'] . "',
						'" . $_POST['address'] . "', 
						'" . $_POST['email'] . "', 
						'" . $_POST['mobile'] . "', 
						'" . $_POST['country'] . "', 
						'" . $_POST['typecontact'].'/'.$_POST['contact'] . "', 
						'1',
						'".$date_expire."'
					)";
		$db->query($q);
		for($mf=1;$mf<=4;$mf++){
			$upf[$mf] = uppic($_FILES['file'.$mf],$mf,"img_profile/",$_POST['h_pic'.$mf]); // Same folder
			if($upf[$mf]!=''){
				$q = "SELECT * FROM `member`ORDER BY id DESC";
				$db->query($q);
				$db->next_record();	 
				$mem_id=$db->f(id);
				$q = "UPDATE `member` SET `pic$mf` = '".$upf[$mf]."' WHERE `id` =".$mem_id." ";
				$db->query($q);
			}
		}	
		al('ลงทะเบียนเรียบร้อยแล้ว/注册成功');
		redi4('index.php');
	}
}
else
{
	al('กรุณากรอกข้อมูลให้ถูกต้อง');
}
?>
