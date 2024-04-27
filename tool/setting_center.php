<? include('../global.php')?>
<?php if($_SESSION['adminid']=='' || !isset($_SESSION['adminid'])) {  
        redi4("login.php");
} ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>ระบบจัดการเว็บไซต์</title>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
	<!--Innova Editor-->
	<script type="text/javascript" src="/admin/innovaeditor/scripts/innovaeditor.js"></script>
<style type="text/css">
body {
	background-color: #000;
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;	
}
.bh{
	color:#FC0;
	font-size:14px;
	height:30px;
}
.sidemenu{
	color:#FFF;
	font-size:12px;
	height:25px;
	text-decoration:none;
}
.sidemenu:hover{
	text-decoration:none;
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

<body>
<table width="1000" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td><img src="/admin/images/head.jpg" width="1098" height="288" /></td>
  </tr>
  <tr>
    <td bgcolor="#311407"><table width="100%" border="0" cellspacing="3" cellpadding="0">
      <tr>
        <td width="250" valign="top" ><? include('sidemenu.php') ?></td>
        <td valign="top" bgcolor="#3f1d0e">
<table width="100%" border="0" cellspacing="0" cellpadding="3">
                                  <tr>
<td width="720" valign="top" bgcolor="#592D03">
				<script language="javascript">
					function selec(){
						var ab=document.getElementById('se');
						location.href=ab.value;
					}
				</script>
							<?php
	if($_POST['submit']){
		$q="update `setting_center` set price='".$_POST['price_setting']."' WHERE `id` ='1' ";
		$db->query($q);
		redi4('setting_center.php?e_sub_id='.$_GET['e_sub_id']);				
	}
?>	
<?php
	if($_GET['e_sub_id']){
		$q="SELECT * FROM `setting_center` WHERE id=".$_GET['e_sub_id']." ";
		$db5 = new nDB();
		$db5->query($q);
		$db5->next_record();
	}
?> <br />
				  <form name="form1" method="post" action="">
                  <table width="96%" border="0" align="center" cellpadding="0" cellspacing="1" >
                    <tr>
                      <td height="25" colspan="2" align="center" bgcolor="#4d1403" class="style11" ><span class="sidemenu">ตั้งค่าศูนย์พระเครื่อง</span></td>
                    </tr>
                    <tr>
                      <td width="27%" bgcolor="#3c1204">&nbsp;</td>
                      <td width="73%" bgcolor="#3c1204">&nbsp;</td>
                    </tr>
                    <tr>
                      <td align="right" bgcolor="#3c1204" class="style11" style="padding-right:3px"><span class="sidemenu">เปิด-ปิดราคา</span></td>
                      <td bgcolor="#3c1204" style="color:#fff">
                      	<input value="1" type="radio" name="price_setting" <?php if ($db5->f(price)=='1') { echo 'checked'; } ?> > เปิด
                      	<input value="0" type="radio" name="price_setting" <?php if ($db5->f(price)=='0') { echo 'checked'; } ?> > ปิด                  	
                      </td>
                    </tr>
                                        
                    <tr>
                      <td bgcolor="#3c1204">&nbsp;</td>
                      <td bgcolor="#3c1204"><input name="submit" type="submit" class="button_add"  value="<?=($_GET['e_sub_id'])?"แก้ไข":"แก้ไข"?>" />
                      </td>
                    </tr>
                  </table>
				  </form>
                </td>
                                  </tr>
                                </table>        
        </td>
      </tr>
    </table></td>
  </tr>
</table>
</body>
</html>