<? include('../global.php') ?>
<? if ($_SESSION['userstore_id']=='') {
	redi4('../index.php');
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>ระบบจัดการร้านค้า praasia</title>
<style type="text/css">
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
	background-color: #000;
	font-size:14px;
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
</style>
</head>

<body><table width="1000" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td><img src="images/head.jpg" width="1000" height="318" /></td>
  </tr>
  <tr>
    <td height="49" align="center" style="background:url(../images/menu.jpg) no-repeat"><span style="color:#000">หน้าแรก</span> |<span style="color:#000"> ตั้งค่าร้านค้า</span> | <span style="color:#000">สินค้า</span> | <span style="color:#000">ติดต่อเรา</span> | &nbsp;&nbsp;&nbsp;&nbsp; <span style="color:#000">กลับไปดูหน้าร้านค้า</span> </td>
  </tr>
  <tr>
    <td height="56" align="center" style="background:url(images/bh-title.jpg) no-repeat"><span style="color:#FFF">ประกาศข่าวร้านค้า</span></td>
  </tr>
				  <?php
	if($_POST['submit']){
		if($_SESSION['user_id']){		
			$q="UPDATE `member` SET `detail` = '".$_POST['detail']."' WHERE `id` ='".$_SESSION['user_id']."'  ";			
			$db->query($q);				
		al('Complete');
		redi4("set_index.php");		
		}
		}
?>  
  <tr>
    <td>
 			<form action="" method="post" enctype="multipart/form-data" name="form1" id="form1">      
            <table width="100%" border="0" cellspacing="0" cellpadding="3">
      	<?php if($_SESSION['user_id']){ 
            $q="SELECT * FROM `member` WHERE id='".$_SESSION['user_id']."' ";
            $db5= new nDB();
            $db5->query($q);
            $db5->next_record();
            } ?>
      <tr>
        <td style="background:url(images/bg-detail.jpg) no-repeat" height="157">
	  
        <table width="70%" border="0" align="center" cellpadding="3" cellspacing="0">
          <tr>
          	<td align="center">ข้อความต้อนรับ / ประกาศ</td>
          </tr>
          <tr>
            <td align="center"><textarea name="detail" cols="70" rows="5" id="detail"><?=$db5->f(detail)?></textarea></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td height="60" align="center"><input name="submit" type="image" id="submit" src="images/button_save.jpg" /></td>
      </tr>
    </table>
    </form>
    </td>
  </tr>

</table>
</body>
</html>
