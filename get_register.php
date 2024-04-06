<?php include("global.php"); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" 
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>รายละเอียดการสั่งซื้อ</title>
<style type="text/css">
<!--
body,td,th {
	font-family: Arial;
	font-size: 14px;
	color: #000000;
}
.style1 {
	color: #000000;
	font-size: 15px;
	font-weight: bold;
}
.bt_me2{
	border-style:outset;
	background-color:#0066CC;
	color:#FFFFFF;
	border-color:#0066CC;
	font-weight:bold;
	font-size:12px;
}
a:link {
	text-decoration: none;
}
a:visited {
	text-decoration: none;
}
a:hover {
	text-decoration: none;
}
a:active {
	text-decoration: none;
}
-->
</style></head>

<body><br />

<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td align="center"><?php
		$q="SELECT * FROM `member` WHERE  id= '".$_GET['id']."' ";
//		echo $q;
		$db->query($q);
		$db->next_record();
?></td>
  </tr>
</table>
<table width="95%" border="0" align="center" cellpadding="3" cellspacing="0">
  <tr>
    <td height="30"><span style="font-weight:bold">เรียน ท่านสมาชิก praasia</span></td>
  </tr>
  <tr>
    <td height="25">ท่านได้สมัครเป็นสมาชิก praasia กรุณาคลิกที่ลิ้งค์ด้านล่างนี้ เพื่อยืนยันการสมัครสมาชิกโดยสมบูรณ์ </td>
  </tr>
  <tr>
    <td height="35"><a href="http://www.praasia.com/activate.php?id=<?=$_GET['id']?>&&active=<?=base64_encode('1') ?>"><span style="color:#F00; font-weight:bold; text-decoration:none">คลิกยืนยันตัวตน</span></a></td>
  </tr>
  <tr>
    <td height="25">กรุณายืนยันการสมัครสมาชิกภายใน 7 วัน เนื่องจากระบบจะตรวจสอบและลบข้อมูลการสมัครของท่านหากไม่ทำการยืนยันการสมัครตามที่กำหนด</td>
  </tr>
  <tr>
    <td height="25">หากท่านไม่ได้เป็นผู้สมัครหรือไมมีเจตนาในการสมัครสมาชิกนี้ ท่านสามารถลบอีเมล์นี้ได้อย่างปลอดภัย<br /></td>
  </tr>
  <tr>
    <td height="25">ขอแสดงความนับถือ</td>
  </tr>
  <tr>
    <td height="25">แผนกบริการลูกค้า praasia</td>
  </tr>
  <tr>
    <td height="25">&nbsp;</td>
  </tr>
  <tr>
    <td height="25"><div><span style="font-weight:bold">各位合艾佛牌网店的会员请注意:</span></div>
    <div></div></td>
  </tr>
  <tr>
    <td height="25">你在合艾佛牌网店里注册填表好了以后</td>
  </tr>
  <tr>
    <td height="35"><a href="http://www.praasia.com/activate.php?id=<?=$_GET['id']?>&&active=<?=base64_encode('1') ?>"><span style="color:#F00; font-weight:bold">请按住这里红色的Link,确定本人的 E-mail</span></a></td>
  </tr>
  <tr>
    <td height="25">在七天内确定才有效。如果您不在合艾佛牌网店里注册新会员，您可以把 E-mail 册除掉。谢谢各位</td>
  </tr>
  <tr>
    <td height="25">&nbsp;</td>
  </tr>
  <tr>
    <td height="25">&nbsp;</td>
  </tr>
  <tr>
    <td height="25">来自 praasia.com</td>
  </tr>    
</table>


<br />
</body>
</html>
