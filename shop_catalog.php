<?php include("global.php");
	include("global_counter.php");
	 ?>
<?php
	if ($_GET['cat_id']) {
	$_SESSION['catalog_id']=$_GET['cat_id'];
	$catalog = $_SESSION['catalog_id'];
	$shop = $_SESSION['shop'];
	}
	//$q="SELECT * FROM `member` WHERE id= '$shop' ";
	$q="SELECT * FROM `member` WHERE id= '".$_SESSION['shop_id']."' ";
	$dbshop= new nDB();	
	$dbshop->query($q);
	$dbshop->next_record();
	$q="SELECT * FROM `product` WHERE shop_id ='".$_SESSION['shop']."' ";
	$dbproduct= new nDB();	
	$dbproduct->query($q);
	$dbproduct->next_record();
	$num_rows = $dbproduct->num_rows();	
	?>  
<html>
	<script language="javascript" type="text/javascript" src="swfobject.js" ></script>
	<head>
		<title>สินค้าในร้าน <?=$dbshop->f(shopname)?> :: ศูนย์พระเครื่องเมืองไทย  合艾佛牌网</title>
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
		<script src="Scripts/swfobject.js" type="text/javascript"></script>
	</head>
	<body bgcolor="#FFFFFF" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
		<!-- Save for Web Slices (???????.jpg) -->
		<table width="1000" border="0" align="center" cellpadding="0" cellspacing="0" id="Table_01">
			<tr>
				<td>
					<table width="1000" border="0" cellpadding="0" cellspacing="0">
						<?php $chk=substr($dbshop->f(head1),-3); ?>							
						<?php if($chk=="jpg" || $chk=="gif" or $chk=="png"){ ?>
						<tr>
							<td colspan="7" align="left" valign="top" height="255"><img src="img/head/<?=$dbshop->f(head1)?>" width="1000" height="350"></td>
						</tr>
						<?php } ?>
						<?php if($chk=="swf"){ 
							?>
						<tr>
							<td colspan="8" align="left" valign="top">
								<object id="FlashID" classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" width="1000" height="255">
									<param name="movie" value="img/head/<?=$dbshop->f(head1)?>" />
									<param name="quality" value="high" />
									<param name="wmode" value="opaque" />
									<param name="swfversion" value="8.0.35.0" />
									<!-- This param tag prompts users with Flash Player 6.0 r65 and higher to download the latest version of Flash Player. Delete it if you don't want users to see the prompt. -->
									<param name="expressinstall" value="../Scripts/expressInstall.swf" />
									<!-- Next object tag is for non-IE browsers. So hide it from IE using IECC. -->
									<!--[if !IE]>-->
									<object type="application/x-shockwave-flash" data="img/head/<?=$dbshop->f(head1)?>" width="1000" height="350">
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
								</object>
							</td>
						</tr>
						<?php } ?>				  
					</table>
				</td>
			</tr>
			<tr>
				<td height="45" style="background:url(images/menu.jpg) no-repeat">
					<table width="995" border="0" align="center" cellpadding="0" cellspacing="0">
						<tr>
							<td width="232" align="left"><a href="index.php"><span style="color:#000; font-weight:bold">หน้าแรกพระเอเซีย / 首页合艾网</span></a></td>
							<td width="224" align="center"><a href="shop_index.php?shop=<?=$dbshop->f(id)?>"><span style="color:#000; font-weight:bold">เข้าสู่ร้านค้า/进入商店</span></a></td>
							<td width="158" align="center"><a href="show_product.php?shop=<?=$dbshop->f(id)?>"><span style="color:#000; font-weight:bold">สินค้าในร้าน / 本店产品</span></a></td>
							<td width="381" align="right">
								<table width="380" border="0" cellspacing="0" cellpadding="3">
									<form action="show_search.php" method="post" name="search" target="_parent" id="search">
										<tr>
											<td width="194" align="right"><span style="color:#000; font-weight:bold">ค้นหาพระเครื่อง / 搜索:</span></td>
											<td width="105" align="center"><input name="q" id="q" size="13" /></td>
											<td width="63" align="center"><input name="search" type="submit" id="search" value="search" /></td>
										</tr>
									</form>
								</table>
							</td>
						</tr>
					</table>
				</td>
			</tr>
			<tr>
				<td height="40" align="center" bgcolor="#000000" style="color:#FC0; font-size:16px">
					<?php
						$q="SELECT * FROM `catalog_shop` WHERE catalog_id='".$_SESSION['catalog_id']."' ";
						$db->query($q);
						$db->next_record();
						?>
					<?=$db->f(catalog_name)?>
				</td>
			</tr>
			<tr>
				<td bgcolor="#2e1207" style="padding:10px; padding-left:12px">
					<table width="100%" border="0" cellspacing="0" cellpadding="0">
						<tr>
							<td>
								<?php
									$q="SELECT * FROM `product` WHERE catalog_id='".$_SESSION['catalog_id']."' and NOT active = '0' ";
									$p_r=1;
									$db->query($q);							
									$total=$db->num_rows();							
									$q.=" ORDER BY product_id DESC ";
									$db->query($q);
									while($db->next_record()){
									?>
								<table width="148" style="float:left; margin:5px; width:152px;" border="0" cellpadding="0" cellspacing="0">
									<tr>
										<td align="center">
											<table width="100%" border="0" cellspacing="0" cellpadding="0">
												<tr>
													<td bgcolor="#000000">
														<a href="shop_product.php?product_id=<?=$db->f(product_id)?>" target="_blank">
														<img src="<?=($db->f(pic1)!="")?'/resize/w155-h150/img/amulet/'.$db->f(pic1):"images/clear.gif"?>" alt="" width="152" height="147" border="0" />
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
																<table style="width:400px; height:250px; color:#ffcc02; background-color:#311407; border:1px solid #ffcc02; border-collapse:collapse;" border="0" cellpadding="0" cellspacing="0">
																	<tr>
																		<td style="height:35px; text-align:center; font-weight:bold;">
																			คะแนนความน่าเชื่อถือสินค้านี้
																		</td>
																	</tr>
																	<tr>
																		<td style="height:1px; text-align:center;">
																			<?php
																				if($db->f(score) < 0){
																					$dbscore = 0;
																				}else{
																					$dbscore = $db->f(score);
																				}
																				?>
																			<div class="pra_progressbar_container">
																				<table style="position:absolute; width:350px; height:27px;" border="0" cellpadding="0" cellspacing="0">
																					<tr>
																						<td style="text-align:center; vertical-align:middle; color:#000000;">
																							<?=$dbscore?>
																							คะแนน / 分数
																						</td>
																					</tr>
																				</table>
																				<div class="pra_progressbar" style="width:<?=$dbscore?>%;"></div>
																			</div>
																		</td>
																	</tr>
																	<tr>
																		<td style="padding-top:5px; vertical-align:top;">
																			<table border="0" cellpadding="0" cellspacing="0">
																				<tr>
																					<td style="width:90px; height:35px; text-align:right; vertical-align:top;">
																						เหตุผลที่เลือก
																						<br/>
																						选的意见
																					</td>
																					<td style="width:20px; text-align:center; vertical-align:top;">
																						:
																					</td>
																					<td style="padding-right:5px; vertical-align:top;">
																						<?php
																							$showment = new nDB();
																							$showment->query("SELECT * FROM `comment` WHERE `comment_product` = '".$db->f(product_id)."' ORDER BY comment_id DESC ");
																							$showment->next_record();
																							if ($showment->f(vote1) != 0) {
																							?>
																						จากภาพพระเบลอ / 相片里佛牌模糊
																						,
																						<?php
																							}
																							if ($showment->f(vote2) != 0) {
																							?>
																						จากภาพพระเบลอมาก / 相片里佛牌很模糊
																						,
																						<?php
																							}
																							if ($showment->f(vote3) != 0) {
																							?>
																						จากภาพพิมพ์ตื้นไป / 相片里模表面很浅
																						,
																						<?php
																							}
																							if ($showment->f(vote4)) {
																							?>
																						จากภาพผิดพิมพ์ / 相片里佛牌模不对
																						,
																						<?php
																							}
																							if ($showment->f(vote5) != 0) {
																							?>
																						จากภาพผิดเนื้อ / 相片里佛牌料质不对
																						,
																						<?php
																							}
																							if ($showment->f(vote6) !=0) {
																							?>
																						จากภาพผิวรมใหม่ / 相片里佛牌是新皮
																						,
																						<?php
																							}
																							if ($showment->f(vote7) != 0) {
																							?>
																						จากภาพพระบวม / 相片里佛牌肿胀
																						,
																						<?php
																							}
																							if ($showment->f(vote8) != 0) {
																							?>
																						จากภาพพระดูยาก / 相片里佛牌辨认真假难
																						,
																						<?php
																							}
																							if ($showment->f(vote9) != 0) {
																							?>
																						จากภาพทีความคมชัดน้อย / 相片里的尖锐度很少
																						,
																						<?php
																							}
																							if ($showment->f(vote10) != 0) {
																							?>
																						จากภาพปลอมแปลงใบรับรอง / 假冒的验正书
																						,
																						<?php
																							}
																							if ($showment->f(vote11) != 0) {
																							?>
																						จากภาพประวัติไม่ชัดเจน / 来历不明显
																						<?php
																							}
																							?>
																					</td>
																				</tr>
																				<tr>
																					<td style="height:35px; text-align:right; vertical-align:top;">
																						เหตุผลเพิ่มเติม
																					</td>
																					<td style="width:20px; text-align:center; vertical-align:top;">
																						:
																					</td>
																					<td style="padding-right:5px; vertical-align:top;">
																						<?=$showment->f(comment_detail)?>
																					</td>
																				</tr>
																				<tr>
																					<td style="height:35px; text-align:right; vertical-align:top;">
																						วันที่
																					</td>
																					<td style="width:20px; text-align:center; vertical-align:top;">
																						:
																					</td>
																					<td style="padding-right:5px; vertical-align:top;">
																						<?=date("d F Y",$showment->f(comment_date))?>
																					</td>
																				</tr>
																			</table>
																		</td>
																	</tr>
																</table>
															</div>
														</div>
														<?php
															if ($db->f(score) == "100") {
															?>
														<img onMouseOver="$(this).parent().find('div:eq(1)').show();" onMouseOut="$(this).parent().find('div:eq(1)').hide();" src="images/light-green.png" border="0" />
														<?php
															} else {
																if ($db->f(score) < 31) {
															?>
														<img onMouseOver="$(this).parent().find('div:eq(1)').show();" onMouseOut="$(this).parent().find('div:eq(1)').hide();" src="images/flash-red.gif" border="0" />
														<?php
															}
															if ($db->f(score) > 30 and $db->f(score) < 70) {
															?>
														<img onMouseOver="$(this).parent().find('div:eq(1)').show();" onMouseOut="$(this).parent().find('div:eq(1)').hide();" src="images/flash-yellow.gif" border="0" />
														<?php
															}
															if ($db->f(score) > 70) {
															?>
														<img onMouseOver="$(this).parent().find('div:eq(1)').show();" onMouseOut="$(this).parent().find('div:eq(1)').hide();" src="images/flash-green.gif" border="0" />
														<?php
															}
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
																			<a href="shop_product.php?product_id=<?=$db->f(product_id)?>" target="_blank"  title="<?=$db->f(name)?>" >
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
																			<?php
																				$db_cn1= new nDB();	
																				$db_cn1->query("SELECT * FROM `catalog_cn` WHERE catalog_name = '".$db->f(detailcn1)."'");
																				$db_cn1->next_record();
																				?>
																			<?=$db_cn1->f(catalog_name_cn)?>
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
																			<?php
																				$db_cn10 = new nDB();
																				$db_cn10->query("SELECT * FROM `catalog_cn` WHERE catalog_name = '".$db->f(detailcn10)."'");
																				$db_cn10->next_record();
																				?>
																			<?=$db_cn10->f(catalog_name_cn)?>
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
																			<?php
																				$db_cn9 = new nDB();
																				$db_cn9->query("SELECT * FROM `catalog_cn` WHERE catalog_name = '".$db->f(detailcn9)."'");
																				$db_cn9->next_record();
																				?>
																			<?=$db_cn9->f(catalog_name_cn)?>
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
				</td>
			</tr>
			<tr>
				<td>
					<?php include('footer.php');?>
				</td>
			</tr>
		</table>
		<!-- End Save for Web Slices --><script type="text/javascript">
			swfobject.registerObject("FlashID", "9.0.0", "expressInstall.swf");
		</script>
	</body>
</html>
