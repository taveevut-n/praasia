<?php include("global.php"); 
		include("global_counter.php");
		?>
<?php set_page($s_page,$e_page=120); //นำส่วนนี้ิไว้ด้านบน ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
		<head>
				<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
				<title>ศูนย์รวมพระเครื่องออนไลน์</title>
				<META name=description content="ศนย์พระเครื่อง เปิดร้านพระออนไลน์" >
				<meta name="keywords" content="ศูนย์พระเครื่องภาคใต้, ศูนย์พระเครื่องภาคเหนือ, ศูนย์พระเครื่องกรุงเทพ, ศูนย์พระเครื่องอีสาน"/>
				<link rel="icon" href="/favicon.ico" type="image/x-icon" />
				<link rel="stylesheet" type="text/css" href="css/style_top.css">
				<?php include("index.css"); ?>
				<!--jquery ui Local-->
				<link rel="stylesheet" href="func/jquery-ui-1.10.3/themes/base/jquery-ui.css" />
				<script src="func/jquery-ui-1.10.3/jquery-1.9.1.js"></script>
				<script src="func/jquery-ui-1.10.3/ui/jquery-ui.js"></script>
				<script src="func/jquery-ui-1.10.3/jquery.transit.min.js"></script>
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
														<td style="background:url(images/bg.jpg) repeat-y;">
															<? include('listshop.php'); ?>
														</td>
												</tr>
												<tr>
														<td style="/*background:url(images/bg.jpg) repeat-y;*/">
																<table width="100%" cellpadding="0" cellspacing="0" border="0">
																		<tr>
																			<td width="305px" valign="top" style="border: 1px #fff solid;">
																					<style type="text/css">
																						.box-product{
																							float:left; 
																							margin:5px 9px 0;
																						}
																						a.text-linkgroup,a.text-linkgroup:visited,a.text-linkgroup:link{
																							color: #fff;
																							text-decoration: underline;
																							font-size: 12px;
																						}
																					</style>
																					<table width="100%" cellpadding="3" cellspacing="0">
																							<?php
																							$q = mysql_query("select * from twe_category_main WHERE active = 2 order by order_num asc");
																							while ( $main = mysql_fetch_array($q)) {
																								?>
																							<tr>
																								<td colspan="2"><a><h3 style="color: #E5CB15;"><?php echo $main['main_name'];?> / <?php echo $main['main_name_cn'];?></h3></a></td>
																							</tr>
																								<?php
																								$qcat = mysql_query("select * from twe_category where main_id = ".$main['main_id']." AND active = 2 order by order_num asc");
																								while ( $category = mysql_fetch_array($qcat)) {
																									?>
																							<tr>
																								<td width="1" style="color: #fff;font-size: 20px;padding-left: 20px;">•</td>
																								<td>
																									<a class="text-linkgroup" href="?c=<?php echo $category['catalog_id'];?>&g=<?php echo $main['main_id'];?>">
																										<?php echo $category['catalog_name'];?></br><?php echo $category['catalog_name_cn'];?>
																									</a>
																								</td>
																							</tr>
																									<?php 
																								}
																							}
																							?>
																					</table>
																				</td>
																				<td valign="top" align="left" style="padding-left:5px;padding-right:5px">
																						<?php 
																							$rcat = mysql_fetch_array(mysql_query("select * from twe_category where catalog_id = '".$_GET['c']."' "));
																							$rmain = mysql_fetch_array(mysql_query("select * from twe_category_main where main_id = '".$_GET['g']."' "));
																						?>
																						<h3 style="color:#E5CB15;text-align:center;font-size: 16px;"><?php echo $rmain['main_name'];?> / <?php echo $rmain['main_name_cn'];?></h3>
																						<h3 style="color:#fff;text-align:center;"><?php echo $rcat['catalog_name'];?> / <?php echo $rcat['catalog_name_cn'];?></h3>
																						<div style="clear:both;height:30px;"></div>
																						<?php
																								$q="SELECT * FROM `product` WHERE group_category_id like '%".$_GET['c']."%' AND NOT active = '0' ";
																								$p_r=1;
																								$db->query($q);             
																								$total=$db->num_rows();             
																								$q.=" ORDER BY CASE WHEN status = 2 THEN 0
																																		WHEN status = 3 THEN 1
																																		WHEN status = 1 THEN 2
																																		WHEN status = 4 THEN 3
																																		WHEN status = 5 THEN 4 END ASC,created DESC LIMIT $s_page,$e_page";
																								$db->query($q);
																								while($db->next_record()){
																								?>              
																						<table width="145" class="box-product" border="0" cellpadding="0" cellspacing="0">
																								<tr>
																										<td align="center">
																												<table width="100%" border="0" cellspacing="0" cellpadding="0">
																														<tr>
																																<td bgcolor="#000000">
																																		<a href="shop_product.php?product_id=<?=$db->f(product_id)?>">
																																		<img src="<?=($db->f(pic1)!="")?'/slir/w152-h150/img/amulet/'.$db->f(pic1):"images/clear.gif"?>" alt="" width="152" height="150" border="0" />
																																		</a>
																																</td>
																														</tr>
																												</table>
																										</td>
																								</tr>
																								<tr>
																										<td height="60" valign="top" bgcolor="#666666">
																												<table width="95%" border="0" align="center" cellpadding="3" cellspacing="0">
																														<tr>
																																<td>
																																		<div style="position:relative;">
																																				<div class="pravote_container" style="display:none; position:absolute; left:-200px; top:-250px;">
																																						<table style="width:400px; height:170px; color:#ffcc02; background-color:#311407; border:1px solid #ffcc02; border-collapse:collapse;" border="0" cellpadding="0" cellspacing="0">
																																								<tr>
																																										<td style="height:35px; text-align:center; font-weight:bold;">
																																												คะแนนความน่าเชื่อถือสินค้านี้
																																										</td>
																																								</tr>
																																								<tr>
																																										<td style="height:1px; text-align:center;">
																																												<?php
																																														if ($db->f(score)>79) {
																																															if ($db->f(score)>100) {
																																																$dbscore = 100;
																																															}else{
																																																$dbscore = $db->f(score);
																																															}
																																															$dbscoreprocess = $db->f(score);
																																															$colorprogress ="#00ff00";
																																														}elseif ($db->f(score)>29) {
																																															$dbscore = $db->f(score);
																																															$dbscoreprocess = $db->f(score);
																																															$colorprogress ="#F7E81D";      
																																														}else{
																																															$dbscore = $db->f(score);
																																															$dbscoreprocess = $db->f(score);
																																															$colorprogress = "red";     
																																														}
																																														?>
																																												<div class="pra_progressbar_container" style="width:100%;">
																																														<table style="position:absolute; width:350px; height:27px;" border="0" cellpadding="0" cellspacing="0">
																																																<tr>
																																																		<td style="text-align:center; vertical-align:middle; color:#000000;"><?=$dbscore?>
																																																				คะแนน / 分数
																																																		</td>
																																																</tr>
																																														</table>
																																														<div class="pra_progressbar" style="height:27px; width:<?=$dbscoreprocess?>%;background-color:<?=$colorprogress?>;">&nbsp;</div>
																																												</div>
																																										</td>
																																								</tr>
																																								<tr>
																																										<td style="padding-top:5px; vertical-align:top;">
																																												<?
																																														if ($db->f(score)>=100) {
																																																								?>
																																												<div class="box_vote"> สินค้าชิ้นนี้ได้รับรองจากคณะกรรมการเว็บพระเอเชียเรียบร้อยแล้ว ให้คะแนนเต็ม100% <br/>
																																														<br/>
																																														本尊产品已被亚洲佛牌团队佛牌鉴定部给为满分100% 
																																												</div>
																																												<?
																																														}else{
																																															?>
																																												<div class="box_vote"> กรุณาตรวดสอบให้แน่ชัดก่อนทำการชื้อขายสิ้นค้าชิ้นนี้ <br/>
																																														<br/>
																																														请各位小心或明确好这尊圣物是否真假后才进行交易 
																																												</div>
																																												<?
																																														}
																																														?>
																																										</td>
																																								</tr>
																																						</table>
																																				</div>
																																		</div>
																																		<?php
																																				if ($db->f(score)>79) {
																																					if ($db->f(score)>=100) {
																																						?>
																																		<img onmouseover="$(this).parent().find('div:eq(1)').show();" onmouseout="$(this).parent().find('div:eq(1)').hide();" src="images/light-green.png" border="0" />
																																		<?
																																				}else{
																																					?>
																																		<img onmouseover="$(this).parent().find('div:eq(1)').show();" onmouseout="$(this).parent().find('div:eq(1)').hide();" src="images/flash-green.gif" border="0" />
																																		<?
																																				}
																																				}elseif ($db->f(score)>29) {
																																				?>
																																		<img onmouseover="$(this).parent().find('div:eq(1)').show();" onmouseout="$(this).parent().find('div:eq(1)').hide();" src="images/flash-yellow.gif" border="0" />
																																		<?
																																				}else{
																																					?>
																																		<img onmouseover="$(this).parent().find('div:eq(1)').show();" onmouseout="$(this).parent().find('div:eq(1)').hide();" src="images/flash-red.gif" border="0" />
																																		<?
																																				}
																																				?>
																																		&nbsp;
																																		<span style="color:#0CF; font-weight:bold">
																																		ID : <?=$db->f(product_id)?>
																																		</span>
																																</td>
																														</tr>
																														<tr>
																																<td height="25">
																																		<div style="width:145px; height:67px; overflow:hidden;">
																																				<div style="width:165px; overflow-y:scroll; overflow-x:hidden; height:67px ;">
																																						<table width="145" cellpadding="1" cellspacing="0">
																																								<tr>
																																										<td colspan="2">
																																												<a href="shop_product.php?product_id=<?=$db->f(product_id)?>"  title="<?=$db->f(name)?>" >
																																												<span style="color:#FFF">
																																												<?=$db->f(name)?>
																																												</span>
																																												</a>
																																										</td>
																																								</tr>
																																								<? if($db->f(detailcn1)!='') { ?>
																																								<tr>
																																										<td width="30" style="color:#FFF" valign="top">
																																												名稱:
																																										</td>
																																										<td width="115" style="color:#FFF" valign="top">
																																												<?=$db->f(detailcn1)?>
																																										</td>
																																								</tr>
																																								<? } ?>
																																								<? if($db->f(detailcn5)!='0') { ?>
																																								<tr>
																																										<td style="color:#FFF" valign="top">
																																												几帮:
																																										</td>
																																										<td style="color:#FFF" valign="top">
																																												<?php
																																														$q="SELECT * FROM `catalog_cn` WHERE catalog_id= '".$db->f(detailcn5)."' ";
																																														$dbmix= new nDB();  
																																														$dbmix->query($q);
																																														$dbmix->next_record();
																																														?>
																																												<?=$dbmix->f(catalog_name_cn)?>
																																										</td>
																																								</tr>
																																								<? } ?>
																																								<? if($db->f(detailcn10)!='') { ?>
																																								<tr>
																																										<td style="color:#FFF" valign="top">
																																												高僧:
																																										</td>
																																										<td style="color:#FFF" valign="top">
																																												<?=$db->f(detailcn10)?>
																																										</td>
																																								</tr>
																																								<? } ?>
																																								<? if($db->f(detailcn6)!='0') { ?>
																																								<tr>
																																										<td style="color:#FFF" valign="top">
																																												模版:
																																										</td>
																																										<td style="color:#FFF" valign="top">
																																												<?php
																																														$q="SELECT * FROM `catalog_cn` WHERE catalog_id= '".$db->f(detailcn6)."' ";
																																														$dbmix= new nDB();  
																																														$dbmix->query($q);
																																														$dbmix->next_record();
																																														?>
																																												<?=$dbmix->f(catalog_name_cn)?>                                          
																																										</td>
																																								</tr>
																																								<? } ?>
																																								<? if($db->f(detailcn11)!='0') { ?>
																																								<tr>
																																										<td style="color:#FFF" valign="top">
																																												年期:
																																										</td>
																																										<td style="color:#FFF" valign="top">
																																												<?php
																																														$q="SELECT * FROM `catalog_cn` WHERE catalog_id= '".$db->f(detailcn11)."' ";
																																														$dbmix= new nDB();  
																																														$dbmix->query($q);
																																														$dbmix->next_record();
																																														?>
																																												<?=$dbmix->f(catalog_name_cn)?>
																																										</td>
																																								</tr>
																																								<? } ?>
																																								<? if($db->f(detailcn9)!='') { ?>
																																								<tr>
																																										<td style="color:#FFF" valign="top">
																																												佛寺:
																																										</td>
																																										<td style="color:#FFF" valign="top">
																																												<?=$db->f(detailcn9)?>
																																										</td>
																																								</tr>
																																								<? } ?>
																																						</table>
																																				</div>
																																		</div>
																																</td>
																														</tr>
																														<tr>
																																<td height="25" align="center" bgcolor="#333333">
																																		<table width="100%" cellpadding="0" cellspacing="0">
																																				<tr>
																																						<td width="63%" align="center" style="font-size:9px">
																																								<span style="color:#FFF">
																																								<?php
																																										if($db->f(status) == 1){
																																										?>
																																								<span style="color:#09F">
																																								พระโชว์ / 展示
																																								</span>
																																								<?php
																																										}
																																										if($db->f(status) == 2){
																																										?>
																																								<span style="color:#090">
																																								ให้เช่า / 出售
																																								</span>
																																								<?php
																																										}
																																										if($db->f(status) == 3){
																																										?>
																																								<span style="color:#FF0">
																																								เปิดจอง / 预定
																																								</span>
																																								<?php
																																										}
																																										if($db->f(status) == 4){
																																										?>
																																								<span style="color:#FC0">
																																								จองแล้ว / 已定
																																								</span>
																																								<?php
																																										}
																																										if($db->f(status) == 5){
																																										?>
																																								<span style="color:#F00">
																																								ขายแล้ว / 已出售
																																								</span>
																																								<?php
																																										}
																																										?>
																																								</span>
																																						</td>
																																						<td width="37%">
																																								<table width="100%" border="0" cellspacing="0" cellpadding="3">
																																										<tr>
																																												<td width="20">
																																														<img src="images/view-icon.png" width="20" height="11" />
																																												</td>
																																												<td>
																																														<span style="color:#FFF">
																																														<?=$db->f(view_num)?>
																																														</span>
																																												</td>
																																										</tr>
																																								</table>
																																						</td>
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
																			<td>&nbsp;</td>
																			<td height="30" align="center" bgcolor="#000000" ><?php  sh_page($total,$s_page,$e_page,$chk_page,Previous,Next,"#999999","#FFCC00"); // นำไปวางในตำแหน่งที่ต้องการแสดง ?>;</td>
																		</tr>
																</table>
														</td>
												</tr>
										</table>
								</td>
						</tr>
						<tr>
								<td align="center">
										<?php include('footer.php');?>
								</td>
						</tr>
				</table>
		</body>
</html>
