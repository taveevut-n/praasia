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
<script src="Scripts/swfobject.js" type="text/javascript"></script>
</head>

<body>
<table width="1000" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td><object id="FlashID" classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" width="1000" height="358">
      <param name="movie" value="images/tee.swf" />
      <param name="quality" value="high" />
      <param name="wmode" value="opaque" />
      <param name="swfversion" value="8.0.35.0" />
      <!-- This param tag prompts users with Flash Player 6.0 r65 and higher to download the latest version of Flash Player. Delete it if you don’t want users to see the prompt. -->
      <param name="expressinstall" value="Scripts/expressInstall.swf" />
      <!-- Next object tag is for non-IE browsers. So hide it from IE using IECC. -->
      <!--[if !IE]>-->
      <object type="application/x-shockwave-flash" data="images/tee.swf" width="1000" height="358">
        <!--<![endif]-->
        <param name="quality" value="high" />
        <param name="wmode" value="opaque" />
        <param name="swfversion" value="8.0.35.0" />
        <param name="expressinstall" value="Scripts/expressInstall.swf" />
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
    <td><img src="images/menu.jpg" width="1000" height="48" border="0" usemap="#Map" /></td>
  </tr>
                        <?php  
		$q1="SELECT * FROM `catalog2` WHERE id_sub_catalog='".$_GET['cat']."' ";
		$db5=new nDB();
		$db5->query($q1);
		$db5->next_record()
?>
  <tr>
    <td style="padding:5px"><?=$db5->f(detail_catalog)?></td>
  </tr>
  <tr>
    <td bgcolor="#000000"><table width="914" border="0" align="center" cellpadding="0" cellspacing="0">
          <tr>
		  <td height="37" colspan="7" style="background:url(images/search.jpg); padding-right:10px">
		  <form action="show_search.php" method="post" name="search" target="_parent" id="search">
		  <table width="400" border="0" align="right" cellpadding="3" cellspacing="0">
            <tr>
              <td width="208"><input name="q" type="text" id="q" size="40" onclick="this.value=''" /></td>
              <td width="142" align="left"><input name="imageField" type="submit" value="ค้นหา / 搜索" /></td>
            </tr>
          </table></form></td>
		  </tr>
		  <tr>
            <td><img src="images/tb1.jpg" width="42" height="37" /></td>
            <td><img src="images/tb2.jpg" width="86" height="37" /></td>
            <td><img src="images/tb3.jpg" width="171" height="37" /></td>
            <td><img src="images/tb4.jpg" width="76" height="37" /></td>
            <td><img src="images/tb5.jpg" width="346" height="37" /></td>
            <td><img src="images/tb6.jpg" width="107" height="37" /></td>
            <td><img src="images/tb7.jpg" width="86" height="37" /></td>
          </tr>
<?php
	$_SESSION['name_catalog']=$_GET['cat'];
 if($_GET['name_catalog']){ 
	$_SESSION['name_catalog']=$_GET['cat'];
	} 
   $q="SELECT * FROM `product2` WHERE  name_catalog='".$_SESSION['name_catalog']."' ORDER BY id_product DESC";
   $db->query($q);
   static $v=1;
   while($db->next_record()){
   ?>	
          <tr>
            <td colspan="7"><table width="100%" cellspacing="0" cellpadding="0" background="<?=($v%2==1)?"images/bg-board1.jpg":"images/bg-board2.jpg"?>" style=" border-bottom:solid 1px #FFF ;border-collapse:collapse">
          <tr>
            <td width="41" height="90" align="center"><span style="color:#FFFFFF; font-size:14px"><?=$db->f(id_product)?></span></td>
            <td width="88" valign="top" style="padding-left:7px; padding-top:4px"><a  href="detail_product2.php?id_product=<?=$db->f(id_product)?>" target="_parent" style="text-decoration:none"><img src="<?=($db->f(pic1)!="")?'slir/w77-h77-c1:1/upimg/product/'.$db->f(pic1):"images/clear.gif"?>" alt="" width="77" height="77" border="0" /></a></td>
            <td width="170" style="padding-left:3px"><a  href="detail_product2.php?id_product=<?=$db->f(id_product)?>" target="_parent" style="text-decoration:none"><span style="color:#FFF22D; font-size:13px"><?=$db->f(name_product)?></span></a></td>
            <td width="78" style="padding-left:5px"><span style="color:#FFFFFF; font-size:14px"><?=$db->f(price)?></span></td>
            <td width="348" style="padding-left:5px"><span style="color:#FFFFFF; font-size:14px; text-decoration:none"><?=$db->f(s_detail)?></span></td>
            <td width="103" align="center">
            <span style="color:#FFF22D; font-size:12px">Visitor
            <?=$db->f(view_num)?></span></td>
            <td width="86" style="padding-left:3px" align="center"><?php if($db->f(stay)==1){ ?>
                          <img src="images/status/stay.png" width="71" height="43" border="0" />
						<?php } ?>
						<?php if($db->f(show)==1){ ?>  
						  <img src="images/status/show.png" width="71" height="43" border="0" />
						  <?php }?>
						  <?php if($db->f(book)==1){ ?>
						  <img src="images/status/book.png" width="71" height="43" border="0" />
						  <?php } ?>
						  <?php if($db->f(sold)==1){ ?>
						  <img src="images/status/sold.png" width="71" height="43" border="0" />
						  <?php } ?>						  </td>
              </tr>
            </table></td>
          </tr><?php $v++; } ?>		  
        </table></td>
  </tr>
  <tr>
    <td bgcolor="#000000">&nbsp;</td>
  </tr>
     <tr>
      	<td><img src="images/footer.jpg" width="1000" height="131" /></td>
      </tr>        
</table>

<map name="Map" id="Map"><area shape="rect" coords="789,8,962,40" href="contact.php" /><area shape="rect" coords="587,9,760,41" href="payment.php" /><area shape="rect" coords="386,9,559,41" href="order.php" /><area shape="rect" coords="196,9,369,41" href="about.php" />
  <area shape="rect" coords="16,9,189,41" href="index.php" />
</map>
<script type="text/javascript">
swfobject.registerObject("FlashID", "9.0.0", "expressInstall.swf");
</script>
</body>
</html>
