<?php include("global.php");
include("global_counter.php");
?>
<?php set_page($s_page,$e_page=80); //นำส่วนนี้ิไว้ด้านบน ?>
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
						<td style="background:url(images/bg.jpg) repeat-y;">
							<? include('listshop.php'); ?>
						</td>
					</tr>
					<tr>
						<td style="background:url(images/bg.jpg) repeat-y;">
							<table width="100%" cellpadding="0" cellspacing="0">
								<tr>
										<!-- <td width="262" valign="top">
											left_search
										</td> -->
										<td style="padding-left:5px;padding-right:5px">
											<table cellpadding="0" cellspacing="0" width="100%">
												<tr>
													<td style="background-color: white;">
														<?php
														if (isset($_GET['v'])) {

															$list_key ='SELECT * FROM `product_key` WHERE proky_id ="'.$_GET['v'].'" ORDER BY `product_key`.`proky_id` ASC';
															$dblist_key=new nDB();
															$dblist_key->query($list_key);
															$dblist_key->next_record();
															$exps = explode(",",$dblist_key->f('proky_keyword'));
															?>

															<table   width="100%">
																<tr>
																	<td style="width: 100%;">
																		<center>
																			<img style="width: 150px;height: auto;" src="<?=($dblist_key->f(proky_file90)!="")?"../product_key/resize90/".$dblist_key->f(proky_file90):"../images/clear.gif"?>">
																			<br>
																			<h2><?=$dblist_key->f(proky_name)?></h2>
																			<h2>คีย์ที่ค้นหา :  <?=$dblist_key->f('proky_keyword')?></h2>
																		</center>
																	</td>
																</tr>
																<tr >
																	<td style="text-align: left;" >

																		<?php 
																		$sql = array();
																		foreach($exps as $word){
																				$sql[] = "product.name LIKE '%".$word."%'";
																		}

																		$dblist="SELECT *,product.pic1 as productimg FROM `product` LEFT JOIN member ON ( member.id = product.shop_id ) WHERE ( product.active = 2 AND member.active = '2' ) AND ( ".implode(" OR ", $sql) .")";

																		$dbListpro = new nDB();
																		$dbListpro->query($dblist);
																		while($dbListpro->next_record()){
																			?>
																			<table width="145" style="float:left; margin:5px; width:145px;" border="0" cellpadding="0" cellspacing="0">
																				<tr>
																					<td align="center">
																						<table width="100%" border="0" cellspacing="0" cellpadding="0">
																							<tr>
																								<td bgcolor="#000000"><a href="shop_product.php?product_id=<?=$dbListpro->f(product_id)?>"><img src="<?=($dbListpro->f(productimg)!="")?'/resize/w152-h150/img/amulet/'.$dbListpro->f(productimg):"images/clear.gif"?>" alt="" width="152" height="150" border="0" /></a></td>
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
																										<div class="pravote_container" style="display:none;position: absolute; left: -5px; top: -211px;">
																											<table style="width:400px; height:170px; color:#ffcc02; background-color:#311407; border:1px solid #ffcc02; border-collapse:collapse;" border="0" cellpadding="0" cellspacing="0">
																												<tr>
																													<td style="height:35px; text-align:center; font-weight:bold;">
																														คะแนนความน่าเชื่อถือสินค้านี้
																													</td>
																												</tr>
																												<tr>
																													<td style="height:1px; text-align:center;">
																														<?php
																														if ($dbListpro->f(score)>79) {
																															if ($dbListpro->f(score)>100) {
																																$dbListproscore = 100;
																															}else{
																																$dbListproscore = $dbListpro->f(score);
																															}
																															$dbListproscoreprocess = $dbListpro->f(score);
																															$colorprogress ="#00ff00";
																														}elseif ($dbListpro->f(score)>29) {
																															$dbListproscore = $dbListpro->f(score);
																															$dbListproscoreprocess = $dbListpro->f(score);
																															$colorprogress ="#F7E81D";			
																														}else{
																															$dbListproscore = $dbListpro->f(score);
																															$dbListproscoreprocess = $dbListpro->f(score);
																															$colorprogress = "red";			
																														}
																														?>
																														<div class="pra_progressbar_container" style="width:100%;">
																															<table style="position:absolute; width:350px; height:27px;" border="0" cellpadding="0" cellspacing="0">
																																<tr>
																																	<td style="text-align:center; vertical-align:middle; color:#000000;"><?=$dbListproscore?>
																																	คะแนน / 分数
																																</td>
																															</tr>
																														</table>
																														<div class="pra_progressbar" style="width:<?=$dbListproscoreprocess?>%;height:27px; background-color:<?=$colorprogress?>;">&nbsp;</div>
																													</div>
																												</td>
																											</tr>
																											<tr>
																												<td style="padding-top:5px; vertical-align:top;">
																													<?
																													if ($dbListpro->f(score)>=100) {
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
																								if ($dbListpro->f(score)>79) {
																									if ($dbListpro->f(score)>=100) {
																										?>
																										<img onmouseover="$(this).parent().find('div:eq(1)').show();" onmouseout="$(this).parent().find('div:eq(1)').hide();" src="images/light-green.png" border="0" />
																										<?
																									}else{
																										?>
																										<img onmouseover="$(this).parent().find('div:eq(1)').show();" onmouseout="$(this).parent().find('div:eq(1)').hide();" src="images/flash-green.gif" border="0" />
																										<?
																									}
																								}elseif ($dbListpro->f(score)>29) {
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
																									ID : <?=$dbListpro->f(product_id)?>
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
																													<a href="shop_product.php?product_id=<?=$dbListpro->f(product_id)?>"  title="<?=$dbListpro->f(name)?>" >
																														<span style="color:#FFF">
																															<?=$dbListpro->f(name)?>
																														</span>
																													</a>
																												</td>
																											</tr>
																											<? if($dbListpro->f(detailcn1)!='') { ?>
																												<tr>
																													<td width="30" style="color:#FFF" valign="top">
																														名稱:
																													</td>
																													<td width="115" style="color:#FFF" valign="top">
																														<?=$dbListpro->f(detailcn1)?>
																													</td>
																												</tr>
																											<? } ?>
																											<? if($dbListpro->f(detailcn5)!='0') { ?>
																												<tr>
																													<td style="color:#FFF" valign="top">
																														几帮:
																													</td>
																													<td style="color:#FFF" valign="top">
																														<?php
																														$q="SELECT * FROM `catalog_cn` WHERE catalog_id= '".$dbListpro->f(detailcn5)."' ";
																														$dbListpromix= new nDB();	
																														$dbListpromix->query($q);
																														$dbListpromix->next_record();
																														?>
																														<?=$dbListpromix->f(catalog_name_cn)?>
																													</td>
																												</tr>
																											<? } ?>
																											<? if($dbListpro->f(detailcn10)!='') { ?>
																												<tr>
																													<td style="color:#FFF" valign="top">
																														高僧:
																													</td>
																													<td style="color:#FFF" valign="top">
																														<?=$dbListpro->f(detailcn10)?>
																													</td>
																												</tr>
																											<? } ?>
																											<? if($dbListpro->f(detailcn6)!='0') { ?>
																												<tr>
																													<td style="color:#FFF" valign="top">
																														模版:
																													</td>
																													<td style="color:#FFF" valign="top">
																														<?php
																														$q="SELECT * FROM `catalog_cn` WHERE catalog_id= '".$dbListpro->f(detailcn6)."' ";
																														$dbListpromix= new nDB();	
																														$dbListpromix->query($q);
																														$dbListpromix->next_record();
																														?>
																														<?=$dbListpromix->f(catalog_name_cn)?>                                          
																													</td>
																												</tr>
																											<? } ?>
																											<? if($dbListpro->f(detailcn11)!='0') { ?>
																												<tr>
																													<td style="color:#FFF" valign="top">
																														年期:
																													</td>
																													<td style="color:#FFF" valign="top">
																														<?php
																														$q="SELECT * FROM `catalog_cn` WHERE catalog_id= '".$dbListpro->f(detailcn11)."' ";
																														$dbListpromix= new nDB();	
																														$dbListpromix->query($q);
																														$dbListpromix->next_record();
																														?>
																														<?=$dbListpromix->f(catalog_name_cn)?>
																													</td>
																												</tr>
																											<? } ?>
																											<? if($dbListpro->f(detailcn9)!='') { ?>
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
																					</table>
																				</td>
																			</tr>
																		</table>
																	<?php } ?>

																</td>
															</tr>
														</table>

													<?php }
													?>
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
		<tr>
			<td>
				<? include('footer.php');?>
			</td>
		</tr>
		<tr>
			<td>
				<!--BEGIN WEB STAT CODE-->
				<script type="text/javascript" src="http://hits.truehits.in.th/data/t0031244.js"></script>
				<noscript>
					<a target="_blank" href="http://truehits.net/stat.php?id=t0031244"><img src="http://hits.truehits.in.th/noscript.php?id=t0031244" alt="Thailand Web Stat" border="0" width="14" height="17" /></a>
					<a target="_blank" href="http://truehits.net/">Truehits.net</a>
				</noscript>
				<!-- END WEBSTAT CODE -->    
			</td>
		</tr>
	</table>
</body>
</html>
