<?php include("global.php"); ?>
<?php
if($_GET['id_product'])
{
$_SESSION['id_product']=$_GET['id_product'];
  if($_SESSION['id_product'])
  {
  $q="UPDATE `pra_product2` SET `view_num` = `view_num`+1 WHERE `id_product` =".$_SESSION['id_product']." ";
  $db->query($q);
  $q="SELECT * FROM `pra_product2` WHERE id_product=".$_SESSION['id_product']." ";
  $db->query($q);
  $db->next_record();
  }
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?=$db->f(name_product)?> พระหาดใหญ่ ศูนย์พระเครื่องเมืองไทย อาจารย์ทิม หลวงปู่ทวด วัดช้างให้ จตุคาม</title>
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
</head>

<body>

<map name="Map" id="Map"><area shape="rect" coords="789,8,962,40" href="contact.php" /><area shape="rect" coords="587,9,760,41" href="payment.php" /><area shape="rect" coords="386,9,559,41" href="order.php" /><area shape="rect" coords="196,9,369,41" href="about.php" />
  <area shape="rect" coords="16,9,189,41" href="index.php" />
</map>
<table width="1000" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td><img src="images/defualt.jpg" width="1000" height="271" /></td>
  </tr>
  <tr>
    <td><img src="images/pramenu.jpg" width="1000" height="48" border="0" usemap="#Map" /></td>
  </tr>
<tr>
<td bgcolor="#000000"><table width="98%" border="0" cellspacing="0" cellpadding="0">
        <tr>				  
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
              <td align="center"><img src="<?=($db->f(pic1)!="")?'slir/w800/upimg/product/'.$db->f(pic1):"images/clear.gif"?>"  border="0" /></td>
            </tr>
            <tr>
              <td align="center"><img src="<?=($db->f(pic2)!="")?'slir/w800/upimg/product/'.$db->f(pic2):"images/clear.gif"?>"  border="0" /></td>
            </tr>
            <tr>
              <td align="center"><img src="<?=($db->f(pic3)!="")?'slir/w800/upimg/product/'.$db->f(pic3):"images/clear.gif"?>"  border="0" /></td>
            </tr>
            <tr>
              <td align="center"><img src="<?=($db->f(pic4)!="")?'slir/w800/upimg/product/'.$db->f(pic4):"images/clear.gif"?>"  border="0" /></td>
            </tr>
            <tr>
              <td align="center"><img src="<?=($db->f(pic5)!="")?'slir/w800/upimg/product/'.$db->f(pic5):"images/clear.gif"?>"  border="0" /></td>
            </tr>
          </table>
		  </td>
        </tr>
        <tr>
          <td style="padding-top:5px"><table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
            <tr>
              <td height="25" bgcolor="#996600"><span style="color:#FFF; padding-left:5px">ดูสินค้าอื่นในหมวดนี้ / 看这区别的产品</span></td>
            </tr>
            <tr>
              <td><table width="813" border="0" align="center" cellpadding="0" cellspacing="3">
                                        	
                        <tr>
                          <td width="149" height="166" valign="top" >
						  <?php
                          $q="SELECT * FROM `pra_product2` WHERE  name_catalog='".$db->f(name_catalog)."'   ";
                          $db->query($q);							
                          $total=$db->num_rows();							
                          $q.=" ORDER BY RAND() LIMIT 0,10";
                          $db->query($q);
                          while($db->next_record()){
                          ?>	                          
                          <table width="149" border="0" align="center" cellpadding="3" cellspacing="0" style="float:left; margin:3px">
                            <tr>
                              <td align="center" bgcolor="#FFFFFF"><a href="detail_pra2.php?id_product=<?=$db->f(id_product)?>" target="_parent" style="text-decoration:none"><img src="<?=($db->f(pic1)!="")?'slir/w97-h97-c1:1/upimg/product/'.$db->f(pic1):"images/clear.gif"?>" alt="" width="97" height="97" border="0" /></a></td>
                            </tr>
                            <tr>
                              <td align="left" bgcolor="#FFFFFF">
                              <div style="width:149px; white-space:nowrap; overflow:hidden">
                              <a href="detail_pra2.php?id_product=<?=$db->f(id_product)?>" target="_parent" style="text-decoration:none" title="<?=$db->f(name_product)?>">
                              <span style="color:#000; font-size:11px"><?=$db->f(name_product)?></span>
                              </a>
                              </div>
                              </td>
                            </tr>
                            <tr>
                              <td align="left" bgcolor="#FFFFFF"><span style="color:#F00; font-size:11px">ราคา
                                <?=$db->f(price)?> บาท</span></td>
                            </tr>       
                            <tr>
                              <td align="left" bgcolor="#FFFFFF">
							  <?php if($db->f(sale)==1){ ?>ให้เช่า / 出售<?php }?>
                          	 <?php if($db->f(sold)==1){ ?> ขายแล้ว / 已出售<?php }?>
							  <?php if($db->f(show)==1){ ?> โชว์ / 展示<?php }?>
							  <?php if($db->f(reservation)==1){ ?> จอง / 保留<?php }?>                                                    </td>
                            </tr>                           
                            <tr>
                            	<td bgcolor="#FFFFFF">เข้าชม / 遊客 : <?=$db->f(view_num)?> คน</td>
                            </tr>                                                 
                          </table>
						  <?php } ?>
                          </td>
                        </tr>
                         <tr>
                          <td height="25" colspan="5" align="right"  bgcolor="#242424" style="padding-right:15px"><a href="show_product.php?cat=<?=$db->f(name_catalog)?>"><span style="color:#FFF">NEXT / 下一页 &gt;&gt;</span></a></td>
                      </tr>    
                </table></td>
            </tr>
          </table></td>
        </tr> 
      </table></td>
</tr>
  <tr>
    <td><img src="images/footer.jpg" width="1000" height="131" /></td>
  </tr>
</table>
</body>
</html>
