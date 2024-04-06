<?php include("global.php"); ?>
<?php if($_SESSION['adminshop_id']=='' || !isset($_SESSION['adminshop_id'])) {  
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
						$do_what = $_POST['do_what'];
						if( $do_what == "update_package"){
								$q="SELECT * FROM member WHERE id = '".$_SESSION['adminshop_id']."' ";
								$upscore= new nDB();
								$upscore->query($q);
								$upscore->next_record();    
								if ($upscore->f(welcome)=='') {
										$q="UPDATE member SET score = score+20 WHERE id = '".$_SESSION['adminshop_id']."' ";
										$db->query($q);
								} 
								$rspacket = mysql_fetch_array(mysql_query("select * from member_package where package_code = '".$_POST['package']."'"));
								$package_id = $rspacket['package_id'];
								$package_duration = $rspacket["package_duration"];
								$package_amount = $rspacket["package_amount"];

								$sql_member = "update member
																set package_id = '$package_id',
																pack_amountformem = '$package_amount'
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
						<?php  
								$q="SELECT * FROM member WHERE id='".$_SESSION['adminshop_id']."' ";
								$db5= new nDB();
								$db5->query($q);
								$db5->next_record();
								 ?>
						<tr>
								<td style="padding:5px">
										<form action="" method="post" enctype="multipart/form-data" name="form1" id="form1">
												<table width="80%" border="0" align="center" cellpadding="5" cellspacing="1">
														<tr>
																<td height="25" colspan="2" bgcolor="#4a1701" id="detail-text" style="color: #FC0" align="center">กรุณาตรวจสอบแพ็กเกจให้ถูกต้อง ก่อนที่จะทำแจ้งการชำระเงิน / 请您先查看Select Package(产品支付表)选择是否确，再次通知付款</td>
														</tr>
														<tr>
															  <td width="28%" align="center" bgcolor="#311308" valign="top" class="detail-text" id="detail-text"> Select Package / เลือกแพคเกจร้านค้า / <br/>产品支付表</td>
															  <td width="77%" bgcolor="#311308">
																	<?
																		$rspacket = mysql_fetch_array(mysql_query("select * from member_package where package_id = '".$db5->f(package_id)."'"));
																		$package_code = $rspacket['package_code'];
																	?>
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
														<tr>
																<td bgcolor="#311308" id="detail-text">
																		&nbsp;
																</td>
																<td bgcolor="#311308" align="right">
																	<input type="hidden" name="do_what" value="update_package">
																	<input name="submit" type="submit" id="Submit" value="แก้ไขข้อมูล / 增改信息" />
																</td>
														</tr>
														<iframe src="" name="reg_frm" width="1px" height="0px" frameborder="0" id="reg_frm"></iframe>
												</table>
										</form>
								</td>
						</tr>
						<tr>
								<td>
									<? include('footer.php');?>
								</td>
						</tr>
				</table>
		</body>
</html>
