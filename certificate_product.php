<?php include("global.php"); ?>
<?php set_page($s_page,$e_page=282); //นำส่วนนี้ิไว้ด้านบน ?>
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
			  <table width="100%" cellpadding="0" cellspacing="0" border="0">
              	<tr>
                	<td width="250" valign="top">
                    	<table width="100%" cellpadding="0" cellspacing="0">
                        <tr>
                        	<td>
                            <table width="100%" cellpadding="0" cellspacing="0" border="0">
                                    	<tr>
                                        	<td align="center" style="background:url(images/bh-newshop.png) no-repeat ; padding-top:4px"><span style="color:#391700; font-size:14px; font-weight:bold">ค้นหาพระเครื่อง / 搜索商品</span></td>
                                      </tr>
                                    	<tr>
                                        	<td align="right">
                                            <table width="234" border="0" cellspacing="0" cellpadding="0">
                                        <tr>
                                          <td height="200" style="background:url(images/bg-stats.png) repeat-y; padding-top:3px" valign="top" >
                                          <form class="search_product_form" action="search_product.php" method="post" name="form5">
                                          <table width="100%" border="0" cellspacing="0" cellpadding="3" style="color:#FC0">

<?php
	$conn = mysql_connect("localhost","prathai_new","twe31219#");
	mysql_select_db("prathai_new",$conn);
	mysql_query("SET NAMES UTF8");
	mysql_query("SET character_set_results=utf8");
	mysql_query("SET character_set_client=utf8");
	mysql_query("SET character_set_connection=utf8");
?>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script>
	function select_geo(x_this){
		var v_this = x_this.val();
		$(".province_select option:eq(0)").prop("selected","selected");
		$(".catalog_select option:eq(0)").prop("selected","selected");
		$(".province_select").find(".province_option").remove();
		$(".province_select").append( $(".province_option_container").find(".province_"+v_this).clone(true) );
	}
	function select_province(x_this){
		var v_this = x_this.val();
		$(".catalog_select option:eq(0)").prop("selected","selected");
		$(".catalog_select").find(".catalog_option").remove();
		$(".catalog_select").append( $(".catalog_option_container").find(".catalog_"+v_this).clone(true) );
	}
</script>
<tr>
	<td colspan="2" align="right">
	  <select onchange="select_geo($(this))" name="geo" style="width:200px">
	    <option value="0">
	      เลือกภาค / 选部
	      </option>
	    <?php
				$q = mysql_query("select * from geo order by geo_id asc");
				while($r = mysql_fetch_array($q)){
			?>
	    <option value="<?=$r["geo_id"]?>">
	      <?=$r["geo_name"]?>
	      </option>
	    <?php
				}
			?>
	    </select>	  </td>
	</tr>
<tr>
	<td colspan="2" align="right">
	  <div class="province_option_container" style="display:none;">
	    <?php
				$q = mysql_query("select * from province order by province_id asc");
				while($r = mysql_fetch_array($q)){
			?>
	    <option class="province_option province_<?=$r["geo_id"]?>" value="<?=$r["province_id"]?>">
	      <?=$r["province_name"]?>
	      </option>
	    <?php
				}
			?>
	    </div>
	  <select onchange="select_province($(this))" class="province_select" name="province" style="width:200px">
	    <option value="0">
	      เลือกจังหวัด / 选府
	      </option>
	    </select>	  </td>
	</tr>
<tr>
	<td colspan="2" align="right">
	  <div class="catalog_option_container" style="display:none;">
	    <?
                  $q="SELECT * FROM catalog order by catalog_id asc";
                  $dbcatalog= new nDB();	
                  $dbcatalog->query($q);
                  while($dbcatalog->next_record()) {
            ?>
	    <option class="catalog_option catalog_<?=$dbcatalog->f(province_id)?>" value="<?=$dbcatalog->f(catalog_id)?>">
	      <?=$dbcatalog->f(catalog_name)?>
	      </option>
	    <?php
				}
			?>
	    </div>
	  <select class="catalog_select" onchange="$('.search_product_form').submit();" name="catalog" style="width:200px;">
	    <option value="0">
	      เลือกรุ่นพระเครื่อง / 选佛牌分类
	      </option>
	    </select>	  </td>
	</tr>
											<tr>
                                            	<td colspan="2" align="right" style="padding-right:3px"><input type="text" name="q" style="width:210px" placeholder="พิมพ์ชื่อสินค้าหรือ ID สินค้า.." /></td>
                                            </tr>
                                            <tr>
                                              <td width="41%">&nbsp;</td>
                                              <td width="59%"><input name="searchpra" type="submit" id="searchpra" value="Search" /></td>
                                            </tr>
                                            <tr>
                                              <td height="20" colspan="2" style="padding-left:15px"><a href="catalog_all.php" target="_blank"><span style="color:#FC0">ค้นหาตามหมวดพระเครื่องทั้งหมด</span></a></td>
                                            </tr>
                                            <tr>
                                              <td height="25" colspan="2" style="padding-left:15px"><table width="100%" border="0" cellspacing="0" cellpadding="3">
                                                <tr>
                                                  <td width="20"><img src="images/wait.png" width="20" height="20" /></td>
                                                  <td width="184"><a href="warn_product.php" target="_blank"><span style="color:#FC0">สินค้าวัดใจ</span></a></td>
                                                </tr>
                                                <tr>
                                                  <td><img src="images/ok.png" width="20" height="20" /></td>
                                                  <td><a href="recommend_product.php" target="_blank"><span style="color:#FC0">สินค้าแนะนำ</span></a></td>
                                                </tr>
                                              </table></td>
                                            </tr>
                                          </table>
                                          </form>
                                          </td>
                                      </tr>
                                        <tr>
                                          <td><img src="images/bt-stats.png" width="234" height="25" /></td>
                                      </tr>
                                    </table>
                                          </td>
                                        </tr>
                                    </table>
                            </td>
                        </tr>
                        							<?php
                            $q="SELECT * FROM `catalog_all` WHERE top_id = 0 ORDER BY catalog_id";
							static $v=1;
                            $db->query($q);
                            while($db->next_record()){
                            ?>
                            <tr>
                            	<td>
                            	<table width="100%" border="0" cellspacing="0" cellpadding="0">
                                    <tr>
                                      <td width="260" height="37" align="left" valign="top" style="background:url(images/bh-newshop.png) no-repeat ; padding-top:4px"><span style="color:#391700; font-size:14px; font-weight:bold; padding-left:25px">หมวด <?=$v?> : <?=$db->f(catalog_name)?></span></td>
                                  </tr>
                                    <tr>
                                      <td align="right" valign="top" style="padding-right:2px"><table width="234" border="0" cellspacing="0" cellpadding="0">
                                        <tr>
                                          <td style="background:url(images/bg-stats.png) repeat-y;" valign="top">
                                              <table width="95%" border="0" align="center" cellpadding="3" cellspacing="0">
											  <?php  
                                              
                                              $q1="SELECT * FROM `catalog_all` WHERE top_id = '".$db->f(catalog_id)."' ORDER BY catalog_id  ";
                                              $db5=new nDB();
                                              $db5->query($q1);
                                              $t=1;
                                              if($db5->num_rows()!=0){
                                              
                                              while($db5->next_record()){
                                              ?>
                                                <tr>
                                                  <td height="20" style="border-bottom:1px solid #220b00"><a href="search_product.php?pra=<?=$db5->f(catalog_id)?>"><span style="color:#FC0"><?=$t?>. <?=$db5->f(catalog_name)?></a></td>
                                                </tr>
											  <?php $t++; ?>
                                              <?php } } ?>
                                              </table>                            
                                          </td>
                                      </tr>
                                        <tr>
                                          <td><img src="images/bt-stats.png" width="234" height="25" /></td>
                                      </tr>
                                    </table></td>
                                  </tr>
                                </table>
                            	</td>
                            </tr>
                            <?php } ?>
                        </table>
                    </td>
                    <td valign="top" style="padding-left:20px">
			  <?php
			  $q="SELECT * FROM `product` WHERE active = '2' AND certificate = '2'  ";
              $p_r=1;
              $db->query($q);							
              $total=$db->num_rows();							
              $q.=" ORDER BY certificatedate DESC LIMIT $s_page,$e_page";
              $db->query($q);
              while($db->next_record()){
              ?>	            
            <table width="145" border="0" align="center" cellpadding="0" cellspacing="0" style="float:left; margin:10px">
                  <tr>
                    <td align="center">
                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td bgcolor="#000000"><a href="shop_product.php?product_id=<?=$db->f(product_id)?>"><img src="<?=($db->f(pic1)!="")?'/resize/w152-h150/img/amulet/'.$db->f(pic1):"images/clear.gif"?>" alt="" width="152" height="150" border="0" /></a></td>
                        </tr>
                    </table></td>
                  </tr>
                  <tr>
                    <td height="60" valign="top" bgcolor="#666666"><table width="95%" border="0" align="center" cellpadding="3" cellspacing="0">
                      <tr>
                        <td><span style="color:#FFF; font-weight:bold">ID : <?=$db->f(product_id)?></span></td>
                      </tr>                        
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
              </table>
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
