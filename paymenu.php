<?php include("global.php"); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>��ԹԤ��������� ��ԡ�ë������ �������ͧ</title>
<style type="text/css">
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
	background-color: #000;
	background-image: url(images/bg.jpg);
	background-attachment:fixed;
	background-position:top center;
}
</style>
</head>

<body>
<table width="1000" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td><img src="images/head.jpg" width="1000" height="358" /></td>
  </tr>
  <tr>
    <td><img src="images/menu.jpg" width="1000" height="48" border="0" usemap="#Map" /></td>
  </tr>
  <tr>
    <td><?php 
						   $q="SELECT * FROM `payment` WHERE 1";
						   $db->query($q);
						   $db->next_record();
						   $db->p(detail_about);
						   ?></span></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
</table>

<map name="Map" id="Map"><area shape="rect" coords="789,8,962,40" href="contactus.php" /><area shape="rect" coords="587,9,760,41" href="paymenu.tphp" /><area shape="rect" coords="386,9,559,41" href="order.php" /><area shape="rect" coords="196,9,369,41" href="about.php" />
  <area shape="rect" coords="16,9,189,41" href="index.php" />
</map>
</body>
</html>
