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
body,td,th {
	font-size: 12px;
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
<script src="Scripts/swfobject_modified.js" type="text/javascript"></script>
</head>

<body>

<map name="Map" id="Map"><area shape="rect" coords="789,8,962,40" href="contact.php" /><area shape="rect" coords="587,9,760,41" href="payment.php" /><area shape="rect" coords="386,9,559,41" href="order.php" /><area shape="rect" coords="196,9,369,41" href="about.php" />
  <area shape="rect" coords="16,9,189,41" href="index.php" />
</map>
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
<tr>
<td bgcolor="#000000"><table width="98%" border="0" cellspacing="0" cellpadding="0">
        <tr>				  <?php
		if($_GET['id_product']){

	$_SESSION['id_product']=$_GET['id_product'];
				  if($_SESSION['id_product']){
				  	$q="UPDATE `product` SET `view_num` = `view_num`+1 WHERE `id_product` =".$_SESSION['id_product']." ";
					$db->query($q);
				  	$q="SELECT * FROM `product` WHERE id_product=".$_SESSION['id_product']." ";
					$db->query($q);
					$db->next_record();
				  }
				  ?>
          <td>

		  <table width="98%" border="0" align="center" cellpadding="5" cellspacing="0">
            <tr>
              <td><table width="95%" border="0" align="center" cellpadding="3" cellspacing="0">
                <tr>
                  <td height="35" align="center" bgcolor="#996600"><span style="color:#FFFF00; font-size:16px; font-weight:bold"><?=$db->f(name_product)?></span></td>
                </tr>
                <tr>
                  <td><span style="color:#FF0"><?=$db->f(detail_product)?></span></td>
                </tr>
              </table></td>
            </tr>
            <tr>
              <td align="center"><img src="<?=($db->f(pic1)!="")?'resize/w800/upimg/product/'.$db->f(pic1):"images/clear.gif"?>"  border="0" /></td>
            </tr>
            <tr>
              <td align="center"><img src="<?=($db->f(pic2)!="")?'resize/w800/upimg/product/'.$db->f(pic2):"images/clear.gif"?>"  border="0" /></td>
            </tr>
            <tr>
              <td align="center"><img src="<?=($db->f(pic3)!="")?'resize/w800/upimg/product/'.$db->f(pic3):"images/clear.gif"?>"  border="0" /></td>
            </tr>
            <tr>
              <td align="center"><img src="<?=($db->f(pic4)!="")?'resize/w800/upimg/product/'.$db->f(pic4):"images/clear.gif"?>"  border="0" /></td>
            </tr>
            <tr>
              <td align="center"><img src="<?=($db->f(pic5)!="")?'resize/w800/upimg/product/'.$db->f(pic5):"images/clear.gif"?>"  border="0" /></td>
            </tr>
          </table>
		  </td><?php }?>
        </tr>
        <tr>
          <td style="padding-top:5px"><table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
            <tr>
              <td height="25" bgcolor="#996600"><span style="color:#FFF; padding-left:5px">ดูสินค้าอื่นในหมวดนี้ / 看这区别的产品</span></td>
            </tr>
            <tr>
              <td><table width="760" border="0" align="center" cellpadding="0" cellspacing="3">
                                        <?php
   $q="SELECT * FROM `product` WHERE  name_catalog='".$db->f(name_catalog)."'  ";
   $p_r=1;
  $db->query($q);							
  $total=$db->num_rows();							
  $q.=" ORDER BY id_product DESC";
  $db->query($q);
   while($db->next_record()){
   ?>		<?php if($p_r%5==1){ ?>
                        <tr>
                          <td width="149" height="166" valign="top" bgcolor="#FFFFFF"><table width="95%" border="0" align="center" cellpadding="3" cellspacing="0">
                            <tr>
                              <td align="center"><a href="detail_product.php?id_product=<?=$db->f(id_product)?>" target="_parent" style="text-decoration:none"><img src="<?=($db->f(pic1)!="")?'resize/w97-h97-c1:1/upimg/product/'.$db->f(pic1):"images/clear.gif"?>" alt="" width="97" height="97" border="0" /></a></td>
                            </tr>
                            <tr>
                              <td align="left"><span style="color:#000; font-size:11px"><?=$db->f(name_product)?></span></td>
                            </tr>
                            <tr>
                              <td align="left"><span style="color:#F00; font-size:11px">ราคา
                                <?=$db->f(price)?> บาท</span></td>
                            </tr>       
                            <tr>
                              <td align="left">
							  <?php if($db->f(sale)==1){ ?>ให้เช่า / 出售<?php }?>
                          	 <?php if($db->f(sold)==1){ ?> ขายแล้ว / 已出售<?php }?>
							  <?php if($db->f(show)==1){ ?> โชว์ / 展示<?php }?>
							  <?php if($db->f(reservation)==1){ ?> จอง / 保留<?php }?>                                                    </td>
                            </tr>                           
                            <tr>
                            	<td>เข้าชม / 遊客 : <?=$db->f(view_num)?> คน</td>
                            </tr>                                                 
                          </table></td><?php } ?>
                          <?php if($p_r%5==2){ ?>
                          <td width="147" valign="top" bgcolor="#FFFFFF"><table width="95%" border="0" align="center" cellpadding="3" cellspacing="0">
                            <tr>
                              <td align="center"><a href="detail_product.php?id_product=<?=$db->f(id_product)?>" target="_parent" style="text-decoration:none"><img src="<?=($db->f(pic1)!="")?'resize/w97-h97-c1:1/upimg/product/'.$db->f(pic1):"images/clear.gif"?>" alt="" width="97" height="97" border="0" /></a></td>
                            </tr>
                            <tr>
                              <td align="left"><span style="color:#000; font-size:11px">
                                <?=$db->f(name_product)?>
                              </span></td>
                            </tr>
                            <tr>
                              <td align="left"><span style="color:#F00; font-size:11px">
                                ราคา <?=$db->f(price)?> บาท
                              </span></td>
                            </tr>
                            <tr>
                              <td align="left">
							  <?php if($db->f(sale)==1){ ?>ให้เช่า / 出售<?php }?>
                          	 <?php if($db->f(sold)==1){ ?> ขายแล้ว / 已出售<?php }?>
							  <?php if($db->f(show)==1){ ?> โชว์ / 展示<?php }?>
							  <?php if($db->f(reservation)==1){ ?> จอง / 保留<?php }?>                                                    </td>
                            </tr>                           
                            <tr>
                            	<td>เข้าชม / 遊客 : <?=$db->f(view_num)?> คน</td>
                            </tr>                            
                          </table>
                          </td>
                          <?php } ?>
                          <?php if($p_r%5==3){ ?>
                          <td width="148" valign="top" bgcolor="#FFFFFF"><table width="95%" border="0" align="center" cellpadding="3" cellspacing="0">
                            <tr>
                              <td align="center"><a href="detail_product.php?id_product=<?=$db->f(id_product)?>" target="_parent" style="text-decoration:none"><img src="<?=($db->f(pic1)!="")?'resize/w97-h97-c1:1/upimg/product/'.$db->f(pic1):"images/clear.gif"?>" alt="" width="97" height="97" border="0" /></a></td>
                            </tr>
                            <tr>
                              <td align="left"><span style="color:#000; font-size:11px">
                                <?=$db->f(name_product)?>
                              </span></td>
                            </tr>
                            <tr>
                              <td align="left"><span style="color:#F00; font-size:11px">
                              ราคา <?=$db->f(price)?> บาท
                              </span></td>
                            </tr>
                            <tr>
                              <td align="left">
							  <?php if($db->f(sale)==1){ ?>ให้เช่า / 出售<?php }?>
                          	 <?php if($db->f(sold)==1){ ?> ขายแล้ว / 已出售<?php }?>
							  <?php if($db->f(show)==1){ ?> โชว์ / 展示<?php }?>
							  <?php if($db->f(reservation)==1){ ?> จอง / 保留<?php }?>                                                    </td>
                            </tr>                           
                            <tr>
                            	<td>เข้าชม / 遊客 : <?=$db->f(view_num)?> คน</td>
                            </tr>                            
                          </table></td>
                          <?php } ?>
                          <?php if($p_r%5==4){ ?>
                          <td width="148" valign="top" bgcolor="#FFFFFF"><table width="95%" border="0" align="center" cellpadding="3" cellspacing="0">
                            <tr>
                              <td align="center"><a href="detail_product.php?id_product=<?=$db->f(id_product)?>" target="_parent" style="text-decoration:none"><img src="<?=($db->f(pic1)!="")?'resize/w97-h97-c1:1/upimg/product/'.$db->f(pic1):"images/clear.gif"?>" alt="" width="97" height="97" border="0" /></a></td>

                            </tr>
                            <tr>
                              <td align="left"><span style="color:#000; font-size:11px">
                                <?=$db->f(name_product)?>
                              </span></td>
                            </tr>
                            <tr>
                              <td align="left"><span style="color:#F00; font-size:11px">
                                ราคา <?=$db->f(price)?> บาท
                              </span></td>
                            </tr>
                            <tr>
                              <td align="left">
							  <?php if($db->f(sale)==1){ ?>ให้เช่า / 出售<?php }?>
                          	 <?php if($db->f(sold)==1){ ?> ขายแล้ว / 已出售<?php }?>
							  <?php if($db->f(show)==1){ ?> โชว์ / 展示<?php }?>
							  <?php if($db->f(reservation)==1){ ?> จอง / 保留<?php }?>                                                    </td>
                            </tr>                           
                            <tr>
                            	<td>เข้าชม / 遊客 : <?=$db->f(view_num)?> คน</td>
                            </tr>                            
                          </table></td>
                          <?php } ?>
                          <?php if($p_r%5==0){ ?>
                          <td width="150" valign="top" bgcolor="#FFFFFF"><table width="95%" border="0" align="center" cellpadding="3" cellspacing="0">
                            <tr>
                              <td align="center"><a href="detail_product.php?id_product=<?=$db->f(id_product)?>" target="_parent" style="text-decoration:none"><img src="<?=($db->f(pic1)!="")?'resize/w97-h97-c1:1/upimg/product/'.$db->f(pic1):"images/clear.gif"?>" alt="" width="97" height="97" border="0" /></a></td>
                            </tr>
                            <tr>
                              <td align="left"><span style="color:#000; font-size:11px">
                                <?=$db->f(name_product)?>
                              </span></td>
                            </tr>
                            <tr>
                              <td align="left"><span style="color:#F00; font-size:11px">
                               ราคา <?=$db->f(price)?> บาท
                              </span></td>
                            </tr>
                            <tr>
                              <td align="left">
							  <?php if($db->f(sale)==1){ ?>ให้เช่า / 出售<?php }?>
                          	 <?php if($db->f(sold)==1){ ?> ขายแล้ว / 已出售<?php }?>
							  <?php if($db->f(show)==1){ ?> โชว์ / 展示<?php }?>
							  <?php if($db->f(reservation)==1){ ?> จอง / 保留<?php }?>                                                    </td>
                            </tr>                           
                            <tr>
                            	<td>เข้าชม / 遊客 : <?=$db->f(view_num)?> คน</td>
                            </tr>                            
                          </table></td>
                        </tr>

                        <?php } ?>
                          <?php $p_r++; } ?>                        <tr>
                          <td height="25" colspan="5" align="right"  bgcolor="#242424" style="padding-right:15px"><a href="show_product.php?cat=<?=$db->f(name_catalog)?>"><span style="color:#FFF">NEXT / 下一页 &gt;&gt;</span></a></td>
                      </tr>    
                </table></td>
            </tr>
          </table></td>
        </tr> 
      </table></td>
</tr>
<tr>
	<td><table width="98%" border="0" align="center" cellpadding="3" cellspacing="0">
                                                    <?php
   $q="SELECT * FROM `bannerproduct` WHERE 1 LIMIT 0,4 ";
	$p_r=1;
	$db->query($q);
   while($db->next_record()){
   ?>	
   							  		<?
		if($db->f(banner_url)==''){
			$url="detail_bannerslide.php?banner_id=".$db->f(banner_id);
			$tar=$db->f(banner_target);
			if($tar=='1'){
				$target="_Blank";
			}else{
				$target="_parent";
			}
		}else{
			$url=$db->f(banner_url);
		}
		?>		<?php if($p_r%2==1){ ?>
	  <tr>
        <td align="center"><a href="<?=$db->f(id_product)?>"><img src="<?=($db->f(banner_img)!="")?'/upimg/banner/'.$db->f(banner_img):"images/clear.gif"?>" width="450" height="120" border="0" /></a></td>
        <?php } ?>
		<?php if($p_r%2==0){ ?>
        <td align="center"><a href="<?=$db->f(id_product)?>"><img src="<?=($db->f(banner_img)!="")?'/upimg/banner/'.$db->f(banner_img):"images/clear.gif"?>" width="450" height="120" border="0" /></a></a></td>
      </tr>
<?php } ?>
                          <?php $p_r++; } ?>	  
    </table></td>
</tr>
  <tr>
    <td><img src="images/footer.jpg" width="1000" height="131" /></td>
  </tr>
</table>
<script type="text/javascript">
swfobject.registerObject("FlashID");
</script>
</body>
</html>
