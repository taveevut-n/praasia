<?php include("global.php"); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
</head>

<body>
<?php
if($_POST['Submit'] and ($_SESSION['ses_inum1']+$_SESSION['ses_inum2']==$_POST['inum3'])){
$new=time()+86400; // 1 date
	$q="INSERT INTO `webboard_que` ( `id_que` , `title_que` , `catID` , `detail_que` , `name_que` , `ip_que` , `date_que` , `read_que` , `reply_que` , `email_que` , `vote_que` , `cat_que` , `img1`, `img2`, `img3`) 
VALUES (
'', '".$_POST['title_que']."', '".$_POST['new_catID']."','".$_POST['board_message']."', '".$_POST['name']."', '".$_SERVER['REMOTE_ADDR']."', '".time()."', '0', '0', '".$_POST['board_email']."', '0','".$new."' , '' , '' , '');";
	$db->query($q);
	for($mf=1;$mf<=3;$mf++){
		$upf[$mf] = uppic($_FILES['file'.$mf],$mf,"img/webboard/",$_POST['h_pic'.$mf]); // Same folder
		if($upf[$mf]!=''){
			$q = "SELECT * FROM `webboard_que`ORDER BY id_que DESC";
			$db->query($q);
			$db->next_record();	 
			$id_que=$db->f(id_que);
			$q = "UPDATE `webboard_que` SET `img$mf` = '".$upf[$mf]."' WHERE `id_que` =".$id_que." ";
			$db->query($q);
			al('เพิ่มภาพ');
		}
	}
	
	redi4('webboard.php');
}else{
	al('กรุณากรอกข้อมูลให้ถูกต้อง');
//	redi4('webboard.php');
}
?>
</body>
</html>
