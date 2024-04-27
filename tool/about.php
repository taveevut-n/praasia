<?php include("global.php"); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>คลินิคตี๋ซ่อมพระ บริการซ่อมพระ พระเครื่อง</title>
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
    <td><img src="images/defualt.jpg" width="1000" height="271" /></td>
  </tr>
  <tr>
    <td><img src="images/pramenu.jpg" width="1000" height="48" border="0" usemap="#Map" /></td>
  </tr>
  <tr>
    <td bgcolor="#292929" style="padding:5px">
	<?php 
	 $q="SELECT * FROM `pra_about` WHERE 1";
	 $db->query($q);
	 $db->next_record();
	 $db->p(detail);
	 ?>
    </td>
  </tr>
     <tr>
      	<td><img src="images/footer.jpg" width="1000" height="131" /></td>
      </tr>        
</table>

<map name="Map" id="Map"><area shape="rect" coords="789,8,962,40" href="contact.php" /><area shape="rect" coords="587,9,760,41" href="payment.php" /><area shape="rect" coords="386,9,559,41" href="order.php" /><area shape="rect" coords="196,9,369,41" href="about.php" />
  <area shape="rect" coords="16,9,189,41" href="index.php" />
</map>
</body>
</html>