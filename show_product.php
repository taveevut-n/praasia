<?php include("global.php"); 
		include("global_counter.php");
		?>
<?php
		if ($_GET['shop']) {
			$_SESSION['shop']=$_GET['shop']; 
		}
		$shop = $_SESSION['shop'];

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
<?php set_page($s_page,$e_page=222); //นำส่วนนี้ิไว้ด้านบน ?>		
<html>
		<script language="javascript" type="text/javascript" src="swfobject.js" ></script>
		<head>
			<title>สินค้าในร้าน <?=$dbshop->f(shopname)?> :: ศูนย์พระเครื่องพระเอเซีย 亚洲佛牌网站</title>
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
			<!--jquery ui Local-->
			<link rel="stylesheet" href="func/jquery-ui-1.10.3/themes/base/jquery-ui.css" />
			<script src="func/jquery-ui-1.10.3/jquery-1.9.1.js"></script>
			<script src="func/jquery-ui-1.10.3/ui/jquery-ui.js"></script>
			<script src="func/jquery-ui-1.10.3/jquery.transit.min.js"></script>
		</head>
		<body bgcolor="#FFFFFF" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">

	<?php
		// Backlist
		if($dbshop->f(backlist) == "1"){
			?>
			<div id='swl_loading' style='background-color:#e1e1e1;position:fixed; z-index:100000; left:0px; top:0px; width:100%; height:100%;opacity: 0.7;'></div>
			<div  style='position:fixed; z-index:100000; left:0px; top:0px; width:100%; height:100%;'>
				<table width='100%' height='100%' border='0' cellpadding='0' cellspacing='0'>
					<tr>
						<td style='text-align:center; vertical-align:middle;'>
							<div style="
							    margin: 0 auto;
							    background: #D42D2D;
							    padding: 15px 30px;
							    font-size: 16px;
							    color: #fff;
							    display: inline-block;
							    border: 2px #6E1515 solid;
							">
								ร้านค้านี้ระงับการซื้อขายชั่วคราว
							</div>
						</td>
					</tr>
				</table>
			</div>
			<?php
		}
	?>			
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
											<td width="232" align="left"><a href="index.php"><span style="color:#000; font-weight:bold">หน้าแรกพระเอเซีย / 首页亚洲网</span></a></td>
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
						<td><img src="images/bt-menu.jpg" width="1000" height="55"></td>
					</tr>
					<tr>
						<td bgcolor="#2e1207" style="padding:10px; padding-left:12px">
								<table width="100%" border="0" cellspacing="0" cellpadding="0">
									<tr>
											<td>
												<?php
														$q="SELECT * FROM `product` WHERE shop_id='".$dbshop->f(id)."' and NOT active = '0' ";
														$p_r=1;
														$db->query($q);              
														$total=$db->num_rows();              
														$q.=" ORDER BY order_num DESC LIMIT $s_page,$e_page ";
														$db->query($q);
														while($db->next_record()){
																	// select check comment
																	$q="SELECT * FROM `comment` WHERE `comment_product` = '".$db->f(product_id)."' ";
																	$comment= new nDB();
																	$comment->query($q);
																	$comment->next_record();
																	$num_rows = $comment->num_rows(); 
														?>
												<table width="100" border="0" align="center" cellpadding="0" cellspacing="0" style="float:left; margin:5px">
														<tr>
															<td align="center">
																	<table width="100%" border="0" cellspacing="0" cellpadding="0">
																		<tr>
																				<td bgcolor="#000000"><a href="shop_product.php?product_id=<?=$db->f(product_id)?>"><img src="<?=($db->f(pic1)!="")?'/slir/w152-h150/img/amulet/'.$db->f(pic1):"images/clear.gif"?>" alt="" width="152" height="150" border="0" /></a></td>
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
																							<div class="pravote_container" style="display:none;position:absolute; left:-200px; top:-250px;">
																								<table style="width:400px; height:170px; color:#ffcc02; background-color:#311407; border:1px solid #ffcc02; border-collapse:collapse;" border="0" cellpadding="0" cellspacing="0">
																										<tr>
																											<td style="height:35px; text-align:center; font-weight:bold;"> คะแนนความน่าเชื่อถือสินค้านี้ </td>
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
																																if($db->f(score)<0){
																																	$dbscore = 0;
																																	$dbscoreprocess = 0;
																																}else{
																																	$dbscore = $db->f(score);
																																	$dbscoreprocess = $db->f(score);
																																}
																														$colorprogress = "red";     
																														}
																														
																															// check comment
																															if($num_rows==0){
																																?>
																													<div class="pra_progressbar_container" style="width:100%;">
																														<table style="position:absolute; width:350px; height:27px;" border="0" cellpadding="0" cellspacing="0">
																																<tr>
																																	<td style="text-align:center; vertical-align:middle; color:#000000;">100 คะแนน / 分数</td>
																																</tr>
																														</table>
																														<div class="pra_progressbar" style="width:100%; height: 26px;background-color:#00ff00;">&nbsp;</div>
																													</div>
																													<?
																														}else{
																															?>
																													<div class="pra_progressbar_container" style="width:100%;">
																														<table style="position:absolute; width:350px; height:27px;" border="0" cellpadding="0" cellspacing="0">
																																<tr>
																																	<td style="text-align:center; vertical-align:middle; color:#000000;"><?=$dbscore?> คะแนน / 分数</td>
																																</tr>
																														</table>
																														<div class="pra_progressbar" style="width:<?=$dbscoreprocess?>%; height: 26px;background-color:<?=$colorprogress?>;">&nbsp;</div>
																													</div>
																													<?
																														}
																														?>
																											</td>
																										</tr>
																										<tr>
																											<td style="padding-top:5px; vertical-align:top;">
																													<?php
																														if($num_rows==0){
																															?>
																													<div class="box_vote"> สินค้าชิ้นนี้ได้รับรองจากคณะกรรมการเว็บพระเอเชียเรียบร้อยแล้ว ให้คะแนนเต็ม100% <br/><br/>本尊产品已被亚洲佛牌团队佛牌鉴定部给为满分100% </div>
																													<?
																														}else{
																															if ($db->f(score)>=100) {
																																?>
																													<div class="box_vote"> สินค้าชิ้นนี้ได้รับรองจากคณะกรรมการเว็บพระเอเชียเรียบร้อยแล้ว ให้คะแนนเต็ม100% <br/><br/>本尊产品已被亚洲佛牌团队佛牌鉴定部给为满分100% </div>
																													<?
																														}else{
																															?>
																													<div class="box_vote"> กรุณาตรวดสอบให้แน่ชัดก่อนทำการชื้อขายสิ้นค้าชิ้นนี้ <br/><br/>请各位小心或明确好这尊圣物是否真假后才进行交易 </div>
																													<?
																														}
																														}
																														?>
																											</td>
																										</tr>
																								</table>
																							</div>
																					</div>
																					<?php
																							// checkcommet befor show
																							if($num_rows==0){
																								?>
																					<img onMouseOver="$(this).parent().find('div:eq(1)').show();" onMouseOut="$(this).parent().find('div:eq(1)').hide();" src="images/light-green.png" border="0" />
																					<?
																							}else{
																								if ($db->f(score)>79) {
																									if ($db->f(score)>=100) {
																										?>
																					<img onMouseOver="$(this).parent().find('div:eq(1)').show();" onMouseOut="$(this).parent().find('div:eq(1)').hide();" src="images/light-green.png" border="0" />
																					<?
																							}else{
																								?>
																					<img onMouseOver="$(this).parent().find('div:eq(1)').show();" onMouseOut="$(this).parent().find('div:eq(1)').hide();" src="images/flash-green.gif" border="0" />
																					<?
																							}
																							}elseif ($db->f(score)>29) {
																							?>
																					<img onMouseOver="$(this).parent().find('div:eq(1)').show();" onMouseOut="$(this).parent().find('div:eq(1)').hide();" src="images/flash-yellow.gif" border="0" />
																					<?
																							}else{
																								?>
																					<img onMouseOver="$(this).parent().find('div:eq(1)').show();" onMouseOut="$(this).parent().find('div:eq(1)').hide();" src="images/flash-red.gif" border="0" />
																					<?
																							}
																							}
																							?>
																					&nbsp; 
																					<span style="color:#0CF; font-weight:bold">ID :<?=$db->f(product_id)?></span>
																				</td>
																		</tr>
																		<tr>
																				<td height="25">
																					<div style="width:145px; height:67px; overflow:hidden;">
																							<div style="width:165px; overflow-y:scroll; overflow-x:hidden; height:67px ;">
																								<table width="145" cellpadding="1" cellspacing="0">
																										<tr>
																											<td colspan="2"><a href="shop_product.php?product_id=<?=$db->f(product_id)?>"  title="<?=$db->f(name)?>" > <span style="color:#FFF">
																													<?=$db->f(name)?>
																													</span> </a>
																											</td>
																										</tr>
																										<? if($db->f(detailcn1)!='') { ?>
																										<tr>
																											<td width="30" style="color:#FFF" valign="top"> 名稱: </td>
																											<td width="115" style="color:#FFF" valign="top"><?=$db->f(detailcn1)?></td>
																										</tr>
																										<? } ?>
																										<? if($db->f(detailcn5)!='0') { ?>
																										<tr>
																											<td style="color:#FFF" valign="top"> 几帮: </td>
																											<td style="color:#FFF" valign="top"><?php
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
																											<td style="color:#FFF" valign="top"> 高僧: </td>
																											<td style="color:#FFF" valign="top"><?=$db->f(detailcn10)?></td>
																										</tr>
																										<? } ?>
																										<? if($db->f(detailcn6)!='0') { ?>
																										<tr>
																											<td style="color:#FFF" valign="top"> 模版: </td>
																											<td style="color:#FFF" valign="top"><?php
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
																											<td style="color:#FFF" valign="top"> 年期: </td>
																											<td style="color:#FFF" valign="top"><?php
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
																											<td style="color:#FFF" valign="top"> 佛寺: </td>
																											<td style="color:#FFF" valign="top"><?=$db->f(detailcn9)?></td>
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
														<tr>
															<td height="25" align="center" bgcolor="#333333">
																	<table width="100%" cellpadding="0" cellspacing="0">
																		<tr>
																				<td width="63%" align="center"><span style="color:#FFF;  font-size: 9px">
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
																				<td width="37%">
																					<table width="100%" border="0" cellspacing="0" cellpadding="3">
																							<tr>
																								<td width="20"><img src="images/view-icon.png" width="20" height="11" /></td>
																								<td><span style="color:#FFF">
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
												<?php } ?>
											</td>
									</tr>
									<tr>
											<td height="30" align="center" bgcolor="#000000" ><!-- <?php  sh_page($total,$s_page,$e_page,$chk_page,Previous,Next,"#999999","#FFCC00"); // นำไปวางในตำแหน่งที่ต้องการแสดง ?>; -->
												<?php  sh_page($total,$s_page,$e_page,$chk_page,Previous,Next,"#F00","#FFFFFF"); // นำไปวางในตำแหน่งที่ต้องการแสดง ?>

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
