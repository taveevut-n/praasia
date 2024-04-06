<?php include("global.php"); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
</head>

<body>
<?php
if($_POST['Submit'] and isset($_SESSION['ses_inum1'])  and isset($_SESSION['ses_inum2'])   and ($_SESSION['ses_inum1']+$_SESSION['ses_inum2']==$_POST['inum3'])){
$update=time()+86400;
	upimg($_FILES['file'],"upimg/");
	if($_FILES['file']['name']==""){
		$file_up="";
	}
	$q="INSERT INTO `webboard_ans` ( `id_ans` , `id_que` , `detail_ans` , `name_ans` , `ip_ans` , `date_ans` , `email_ans` , `img_ans` , `del_ans` ) 
VALUES (
'', '".$_POST['h_que_id']."', '".$_POST['board_message']."', '".$_POST['name']."', '".$_SERVER['REMOTE_ADDR']."', '".time()."', '".$_POST['board_email']."', '".$file_up."', '0'
);";
	$db->query($q);
	$q="UPDATE `webboard_que` SET `reply_que` = `reply_que`+1,`vote_que` = '".$update."' WHERE `id_que` =".$_POST['h_que_id']." ";
	$db->query($q);
	unset($_SESSION['ses_inum1']);
	unset($_SESSION['ses_inum2']);
	al('ตอบกระทู้เรียบร้อยแล้ว');
	redi4('webboard2.php?id_que='.$_POST['h_que_id']);
}else{
	al('กรุณากรอกข้อมูลให้ถูกต้อง');
}
?>
</body>
</html>
