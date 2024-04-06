<?php include("global.php"); ?>
<?php
 	if ($_GET['shop']) {
	$_SESSION['shop']=$_GET['shop'];	
	$shop = $_SESSION['shop'];
	}
	$q="SELECT * FROM `member` WHERE id= '$shop' ";
	$dbshop= new nDB();	
	$dbshop->query($q);
	$dbshop->next_record();
	$q="SELECT * FROM `product` WHERE shop_id ='".$dbshop->f(id)."' ";
	$dbproduct= new nDB();	
	$dbproduct->query($q);
	$dbproduct->next_record();
	$num_rows = $dbproduct->num_rows();	
?>  
<html>
<script language="javascript" type="text/javascript" src="swfobject.js" ></script>
<head>
<title><?=$dbproduct->f(name)?> ร้าน <?=$dbshop->f(shopname)?> :: ศูนย์พระเครื่องเมืองไทย</title>
<link rel="shortcut icon" href="favicon.ico" />
<link rel="favicon" href="favicon.ico" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<style type="text/css">
body {
	background-color: #000;
	background-image: url(images/bg.jpg);
	background-position:top center;
	background-repeat:no-repeat;	
}
body,td,th {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 12px;
}
a:link {
	text-decoration: none;
}
a:visited {
	text-decoration: none;
	color: #000;
}
a:hover {
	text-decoration: none;
}
a:active {
	text-decoration: none;
	color: #000;
}
</style>
<script src="Scripts/swfobject_modified.js" type="text/javascript"></script>
</head>
<body bgcolor="#FFFFFF" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<!-- Save for Web Slices (???????.jpg) -->
<table width="1000" border="0" align="center" cellpadding="0" cellspacing="0" id="Table_01">
	<tr>
    <td><table width="1000" border="0" cellpadding="0" cellspacing="0">
							<?php $chk=substr($dbshop->f(head),-3); ?>							
							<?php if($chk=="jpg" || $chk=="gif" or $chk=="png"){ ?><tr>
			  <td colspan="7" align="left" valign="top" height="255"><img src="img/head/<?=$dbshop->f(head)?>" width="1000" height="350"></td>
              </tr>
			  				<?php } ?>
							<?php if($chk=="swf"){ 
							?>
                            <tr>
                            <td colspan="8" align="left" valign="top">
  <object id="FlashID" classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" width="1000" height="255">
    <param name="movie" value="img/head/<?=$dbshop->f(head)?>" />
    <param name="quality" value="high" />
    <param name="wmode" value="opaque" />
    <param name="swfversion" value="8.0.35.0" />
    <!-- This param tag prompts users with Flash Player 6.0 r65 and higher to download the latest version of Flash Player. Delete it if you don't want users to see the prompt. -->
    <param name="expressinstall" value="../Scripts/expressInstall.swf" />
    <!-- Next object tag is for non-IE browsers. So hide it from IE using IECC. -->
    <!--[if !IE]>-->
    <object type="application/x-shockwave-flash" data="img/head/<?=$dbshop->f(head)?>" width="1000" height="255">
      <!--<![endif]-->
      <param name="quality" value="high" />
      <param name="wmode" value="opaque" />
      <param name="swfversion" value="8.0.35.0" />
      <param name="expressinstall" value="../Scripts/expressInstall.swf" />
      <!-- The browser displays the following alternative content for users with Flash Player 6.0 and older. -->
      <div>
        <h4>Content on this page requires a newer version of Adobe Flash Player.</h4>
        <p><a href="http://www.adobe.com/go/getflashplayer"><img src="http://www.adobe.com/images/shared/download_buttons/get_flash_player.gif" alt="Get Adobe Flash player" width="112" height="33" /></a></p>
      </div>
      <!--[if !IE]>-->
    </object>
    <!--<![endif]-->
  </object> </td></tr>																
			  				<?php } ?>				  
          </table></td>
    </tr>
	<tr>
		<td height="45" style="background:url(images/menu.jpg) no-repeat"><table width="995" border="0" align="center" cellpadding="0" cellspacing="0">
		  <tr>
		    <td width="178" align="left"><a href="index.php"><span style="color:#000; font-weight:bold">หน้าแรกพระหาดใหญ่ / 首页合艾网</span></a></td>
		    <td width="203" align="center"><a href="shop_index.php?shop=<?=$dbshop->f(id)?>"><span style="color:#000; font-weight:bold">หน้าแรกร้าน 首页
		      <?=$dbshop->f(shopname)?>
		      店</span></a></td>
		    <td width="129" align="center"><a href="show_product.php?shop=<?=$_SESSION['shop_id']?>"><span style="color:#000; font-weight:bold">สินค้าในร้าน / 本店品</span></a></td>
		    <td width="133" height="25" align="center"><a href="shop_contact.php?shop=<?=$_SESSION['shop_id']?>"><span style="color:#000; font-weight:bold">ติดต่อเรา / 联系我们</span></a></td>
		    <td width="352" align="right"><table width="350" border="0" cellspacing="0" cellpadding="3">
		      <form action="show_search.php" method="post" name="search" target="_parent" id="search">
		        <tr>
		          <td width="127" align="right"><span style="color:#000; font-weight:bold">ค้นหาพระเครื่อง / 搜索:</span></td>
		          <td width="117" align="center"><input name="q" id="q" size="16"></td>
		          <td width="88" align="center"><input name="search" type="submit" id="search" value="ค้นหา / 搜索"></td>
	            </tr>
	          </form>
		      </table></td>
	      </tr>
	    </table></td>
	</tr>
	<tr>
		<td><img src="images/bt-menu.jpg" width="1000" height="55"></td>
	</tr>
	<tr>
    	<td bgcolor="#2e1207" style="padding:10px"><span style="color:#FFF"><?=$dbshop->f(warranty)?></span></td>
    </tr>                 
	<tr>
	  <td><img src="images/footer.jpg" width="1000" height="136"></td>
  </tr>
</table>
<!-- End Save for Web Slices --><script type="text/javascript">
swfobject.registerObject("FlashID");
</script>
</body>
</html>
