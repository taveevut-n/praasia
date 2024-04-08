<?php include("global.php"); ?>
<?php set_page($s_page,$e_page=102); //นำส่วนนี้ิไว้ด้านบน ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>ศูนย์รวมพระเครื่องออนไลน์</title>
<META name=description content="ศนย์พระเครื่อง เปิดร้านพระออนไลน์" >
<meta name="keywords" content="ศูนย์พระเครื่องภาคใต้, ศูนย์พระเครื่องภาคเหนือ, ศูนย์พระเครื่องกรุงเทพ, ศูนย์พระเครื่องอีสาน"/>
<link rel="icon" href="/favicon.ico" type="image/x-icon" />
<?php include("index.css"); ?>
</head>

<body>
<table width="1000" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td><? include('head.php') ?></td>
  </tr>
	<tr>
		<td>
		<table width="100%" border="0" cellspacing="0" cellpadding="0">	
          <tr>
		    <td style="background:url(images/bg.jpg) repeat-y; padding-left:5px">
			  <?php
              $q="SELECT * FROM `product` WHERE recommend = '1'  ";
              $p_r=1;
              $db->query($q);							
              $total=$db->num_rows();							
              $q.=" ORDER BY product_id DESC LIMIT $s_page,$e_page";
              $db->query($q);
              while($db->next_record()){
              ?>	            
            <table width="145" border="0" align="center" cellpadding="0" cellspacing="0" style="float:left; margin:5px">
                  <tr>
                    <td align="center">
                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td bgcolor="#000000"><a href="shop_product.php?product_id=<?=$db->f(product_id)?>"><img src="<?=($db->f(pic1)!="")?'/slir/w152-h150/img/amulet/'.$db->f(pic1):"images/clear.gif"?>" alt="" width="152" height="150" border="0" /></a></td>
                        </tr>
                    </table></td>
                  </tr>
                  <tr>
                    <td height="60" valign="top" bgcolor="#666666"><table width="95%" border="0" align="center" cellpadding="3" cellspacing="0">
                      <tr>
                        <td height="25">
                            <div style="width:145px; overflow:hidden; word-break:break-all; height:65px ;">
                                <a href="shop_product.php?product_id=<?=$db->f(product_id)?>"  title="<?=$db->f(name)?>" ><span style="color:#FFF"><?=$db->f(name)?></span></a>
                            </div>
                        </td>
                        </tr>
                    </table></td>
                  </tr>
                  <tr>
                    <td height="25" align="center" bgcolor="#333333">
                    <table width="100%" cellpadding="0" cellspacing="0">
                    	<tr>
                        	<td width="63%" align="center">
                              <span style="color:#FFF">
							  <? if ($db->f(status)==1) { ?>
                              <span style="color:#09F">พระโชว์ / 展示</span>
                              <? } ?>
                              <? if ($db->f(status)==2) { ?>
                              <span style="color:#090">ให้เช่า / 出售</span>
                              <? } ?>
                              <? if ($db->f(status)==3) { ?>
                              <span style="color:#FF0">เปิดจอง / 预定</span>
                              <? } ?>
                              <? if ($db->f(status)==4) { ?>
                              <span style="color:#FC0">จองแล้ว / 已定</span>
                              <? } ?>
                              <? if ($db->f(status)==5) { ?>
                              <span style="color:#F00">ขายแล้ว / 已出售</span>
                              <? } ?>                                               
                              </span>
                            </td>
                            <td width="37%"><table width="100%" border="0" cellspacing="0" cellpadding="3">
                              <tr>
                                <td width="20"><img src="images/view-icon.png" width="20" height="11" /></td>
                                <td><span style="color:#FFF"><?=$db->f(view_num)?></span></td>
                              </tr>
                            </table>
                            
                            </td>
                        </tr>
                    </table>
                     </td>
                  </tr>
                </table>
            <?php } ?> 
            </td>
	      </tr>
          <tr>
            <td height="30" align="center" bgcolor="#000000" ><?php  sh_page($total,$s_page,$e_page,$chk_page,Previous,Next,"#999999","#FFCC00"); // นำไปวางในตำแหน่งที่ต้องการแสดง ?>;</td>
          </tr>                  
	    </table>
        </td>
	</tr>
	<tr>
	  <td><img src="images/footer.jpg" width="1000" height="136" /></td>
  </tr>   
</table>
</body>
</html>
