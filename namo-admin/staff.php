<?php include("../global.php"); ?>

<html>
<head>
<title>Namoputtaya.com :: Amulet Center in Asia</title>
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
	color: #FFF;
}
a:visited {
	text-decoration: none;
	color: #FFF;
}
a:hover {
	text-decoration: none;
	color: #FFF;
}
a:active {
	text-decoration: none;
	color: #FFF;
}
</style>
<script src="Scripts/swfobject_modified.js" type="text/javascript"></script>
</head>
<body bgcolor="#FFFFFF" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<!-- Save for Web Slices (???????.jpg) -->
				  <?php
	if($_POST['submit']){
		if($_POST['h_staff_id']){		
			$q="UPDATE `namostaff` SET `username` = '".$_POST['username']."',
			`password` = '". md5(base64_encode(md5(md5($_POST['password']))))."' WHERE `id` ='".$_POST['h_staff_id']."'  ";			
			$db->query($q);				
		al('Complete');
		redi4("main.php");		
		}
		}
?>
<table width="1000" border="0" align="center" cellpadding="0" cellspacing="0" id="Table_01">
	<tr>
    <td height="25" bgcolor="#311308">&nbsp;</td>
    </tr>
	<tr>
    <td><object id="FlashID" classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" width="1000" height="331">
      <param name="movie" value="../namoputtaya.swf">
      <param name="quality" value="high">
      <param name="wmode" value="opaque">
      <param name="swfversion" value="8.0.35.0">
      <!-- This param tag prompts users with Flash Player 6.0 r65 and higher to download the latest version of Flash Player. Delete it if you don’t want users to see the prompt. -->
      <param name="expressinstall" value="Scripts/expressInstall.swf">
      <!-- Next object tag is for non-IE browsers. So hide it from IE using IECC. -->
      <!--[if !IE]>-->
      <object type="application/x-shockwave-flash" data="../namoputtaya.swf" width="1000" height="331">
        <!--<![endif]-->
        <param name="quality" value="high">
        <param name="wmode" value="opaque">
        <param name="swfversion" value="8.0.35.0">
        <param name="expressinstall" value="Scripts/expressInstall.swf">
        <!-- The browser displays the following alternative content for users with Flash Player 6.0 and older. -->
        <div>
          <h4>Content on this page requires a newer version of Adobe Flash Player.</h4>
          <p><a href="http://www.adobe.com/go/getflashplayer"><img src="http://www.adobe.com/images/shared/download_buttons/get_flash_player.gif" alt="Get Adobe Flash player" width="112" height="33" /></a></p>
        </div>
        <!--[if !IE]>-->
      </object>
      <!--<![endif]-->
    </object></td>
    </tr>
<tr>
		<td height="45" style="background:url(../images/menu.jpg) no-repeat"><table width="570" border="0" align="center" cellpadding="0" cellspacing="0">
		  <tr>
		    <td width="60" align="center"><a href="index.php"><span style="color:#000; font-weight:bold">首頁</span></a></td>
		    <td width="70" align="center"><a href="shop.php"><span style="color:#000; font-weight:bold">网店</span></a></td>
		    <td width="95" height="25" align="center"><a href="http://www.namoputtaya.com/board/forum.php" target="_new"><span style="color:#000; font-weight:bold">进入论坛</span></a></td>
            <td width="2"><img src="../images/line-search.jpg" width="2" height="30"></td>
		    <td width="315" align="center">
            <table width="100%" border="0" cellspacing="0" cellpadding="3">
                        <form action="show_search.php" method="post" name="search" target="_parent" id="search">
		      <tr>
		        <td width="47%" align="right"><span style="color:#000; font-weight:bold">搜索佛牌圣物:</span></td>
		        <td width="34%" align="center"><input name="q" id="q" size="18"></td>
		        <td width="19%" align="center"><input name="search" type="submit" id="search" value="Search"></td>
	          </tr></form>
	        </table>
            
            </td>
	      </tr>
	    </table></td>
  </tr>
<tr>
		<td height="296" align="center" valign="top" style="padding:5px"><table width="980" border="0" cellspacing="0" cellpadding="3">
		  <tr>
		    <td width="200" valign="top"><table width="100%" border="0" align="center" cellpadding="3" cellspacing="0">
		      <tr>
		        <td height="25" align="center" bgcolor="#4d1403">Main Menu</td>
	          </tr>
		      <tr>
		        <td bgcolor="#4d1403"><table width="100%" border="0" cellspacing="1" cellpadding="3">
		          <tr>
		            <td height="25" bgcolor="#3c1204"><a href="main.php">- Member</a></td>
		            </tr>
				                              <?php
					if($_SESSION['adminid']==1){ 
					?>                    
		          <tr>
		            <td height="25" bgcolor="#3c1204"><a href="staff.php?id=2">- Staff</a></td>
		            </tr>
                    <?php } ?>
		          <tr>
		            <td height="25" bgcolor="#3c1204"><a href="about.php">- About us</a></td>
		            </tr>
		          <tr>
		            <td height="25" bgcolor="#3c1204"><a href="banner.php">- Banner</a></td>
		            </tr>                    
		          <tr>
		            <td height="25" bgcolor="#3c1204"><a href="news.php">- 消息 / News</a></td>
		            </tr>
		          <tr>
		            <td height="25" bgcolor="#3c1204"><a href="../logout.php">- 退出 / Logout</a></td>
		            </tr>
	            </table></td>
	          </tr>
	        </table></td>
		    <td align="center" valign="top">
                                      <?php if($_GET['id']){ 

	$q="SELECT * FROM `namostaff` WHERE id=".$_GET['id']." ";
	$db5= new nDB();
	$db5->query($q);
	$db5->next_record();
 } ?>
            <form method="post" id="form1">
            <table width="80%" border="0" cellspacing="0" cellpadding="3">
		      <tr>
		        <td height="25" colspan="2" align="center" bgcolor="#4d1403">Manage Staff</td>
	          </tr>
		      <tr>
		        <td width="30%" height="25" align="right" bgcolor="#3c1204">帐号 / Username : </td>
		        <td width="70%" bgcolor="#3c1204"><input name="username" type="text" id="username" size="20" value="<?=($_GET['id'])?$db5->f(username):""?>"></td>
	          </tr>
		      <tr>
		        <td height="25" align="right" bgcolor="#3c1204">密码 / Password : </td>
		        <td bgcolor="#3c1204"><input name="password" type="password" id="password" size="21"></td>
	          </tr>
		      <tr>
		        <td height="25" bgcolor="#3c1204">&nbsp;</td>
		        <td bgcolor="#3c1204"><input name="submit" type="submit" id="Login" value="Change Username &amp; Password">
				<?php if($_GET['id']){ ?>
                            <input name="h_staff_id" type="hidden" id="h_staff_id" value="<?=$db5->f(id)?>" />                
                            <?php } ?></td>
	          </tr>
	        </table>
            </form>
            </td>
	      </tr>
	    </table></td>
	</tr>
	<tr>
	  <td><img src="../images/footer.jpg" width="1000" height="46"></td>
  </tr>
</table>
<!-- End Save for Web Slices --><script type="text/javascript">
swfobject.registerObject("FlashID");
</script>
</body>
</html>