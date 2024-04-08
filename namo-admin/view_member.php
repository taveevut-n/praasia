<?php include("../global.php"); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<style type="text/css">
body,td,th {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 12px;
	color: #FFF;
}
a:link {
	color: #FFF;
}
body {
	background-color: #000;
}
</style>
</head>

<body>
<?php
	if($_GET['member']){
		$_SESSION['member']=$_GET['member'];
	}
	$q="SELECT * FROM `member` WHERE id='".$_SESSION['member']."' ";
	$db->query($q);
	$db->next_record();
?>
<table width="95%" border="0" align="center" cellpadding="3" cellspacing="0">
  <tr>
    <td height="30" colspan="2" align="center" bgcolor="#4d1403"><span style="color:#FFF">Detail Member</span></td>
  </tr>
  <tr>
    <td width="25%" height="25" align="right" bgcolor="#2a0a00">Package :</td>
    <td width="75%" bgcolor="#2a0a00"><?php
					if($db->f(package)==1){ 
					?>S Package (Limit 30 Pieces) 1000฿<?php } ?>
                    <?php
					if($db->f(package)==2){ 
					?>M Package (Limit 100 Pieces) 2500฿<?php } ?>
                    <?php
					if($db->f(package)==3){ 
					?>L Package (Unlimit) 3000฿<?php } ?></td>
  </tr>
  <tr>
    <td height="25" align="right" bgcolor="#2a0a00">店主名稱 / Name :</td>
    <td bgcolor="#2a0a00"><?=$db->f(name)?></td>
  </tr>
  <tr>
    <td height="25" align="right" bgcolor="#2a0a00">地址 / Address :</td>
    <td bgcolor="#2a0a00"><?=$db->f(address)?></td>
  </tr>
  <tr>
    <td height="25" align="right" bgcolor="#2a0a00">電話 / Tel :</td>
    <td bgcolor="#2a0a00"><?=$db->f(mobile)?></td>
  </tr>
  <tr>
    <td height="25" align="right" bgcolor="#2a0a00">電子郵件 / E-mail :</td>
    <td bgcolor="#2a0a00"><?=$db->f(email)?></td>
  </tr>
  <tr>
    <td height="25" align="right" bgcolor="#2a0a00">保證人資料 / Guarantee Information :</td>
    <td bgcolor="#2a0a00"><?=$db->f(warranty)?></td>
  </tr>
  <tr>
    <td height="25" align="right" bgcolor="#2a0a00">銀行帳戶資料 / Bank Information :</td>
    <td bgcolor="#2a0a00"><?=$db->f(bank)?></td>
  </tr>  
</table>
</body>
</html>