<?php include("../global.php"); ?>
<html>
<head>
<title>praasia</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<style type="text/css">
body {
	background-color: #000;
}
body,td,th {
	font-size: 12px;
	font-family: Arial, Helvetica, sans-serif;
	color: #FFF;
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
<body bgcolor="#FFFFFF" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<!-- Save for Web Slices (???????.jpg) -->
<?php
if ($_POST['Login']) {
	if($_POST['username']=='phraasia18/11' AND $_POST['password']=='65749POKs23' ){	
				$_SESSION['adminid']='1';
				echo "<script language=\"javascript\">window.open('index.php','_parent')</script>";							
			}else{
				al('รหัสไม่ถูกต้อง');	
				echo "<script language=\"javascript\">window.open('index.php','_parent')</script>";
			}
}
?>
<table width="1000" border="0" align="center" cellpadding="0" cellspacing="0" id="Table_01">
	<tr>
    <td height="25" bgcolor="#311308">&nbsp;</td>
    </tr>
	<tr>
    <td><img src="../images/defualt.jpg" width="1000" height="271"></td>
    </tr>
<tr>
		<td align="center" valign="top" style="padding:5px; padding-top:15px; background:url(../images/manage/bg-login.jpg)">
        <form name="form1" method="post" action="">
        <table width="30%" border="0" cellspacing="0" cellpadding="3">
		  <tr>
		    <td colspan="2" align="center"><img src="../images/bh-login.png" width="323" height="29"></td>
	      </tr>
		  <tr>
		    <td height="30" align="right"> Admin Login :</td>
		    <td><input name="username" type="text" id="username"></td>
	      </tr>
		  <tr>
		    <td height="30" align="right">Password :</td>
		    <td><input name="password" type="password" id="password"></td>
	      </tr>
		  <tr>
		    <td>&nbsp;</td>
		    <td height="30"><input name="Login" type="submit" id="Login" value="Login"></td>
	      </tr>
		  </table>
          </form>
        </td>
	</tr>
	<tr>
	  <td>
	  	<? include('footer.php');?>
	  </td>
  </tr>
</table>
<!-- End Save for Web Slices -->
</body>
</html>