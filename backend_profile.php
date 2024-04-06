<?php 
	include("global.php");
	if($_SESSION['adminshop_id']=='' || !isset($_SESSION['adminshop_id'])) {  
		redi4("index.php");
	} 
	set_page($s_page,$e_page=20); //นำส่วนนี้ิไว้ด้านบน 
	include("core_function.php");
?>
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
				<script type="text/javascript">
						function MM_swapImgRestore() { //v3.0
							var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
						}
						function MM_preloadImages() { //v3.0
							var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
								var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
								if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
						}
						
						function MM_findObj(n, d) { //v4.01
							var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
								d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
							if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
							for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
							if(!x && d.getElementById) x=d.getElementById(n); return x;
						}
						
						function MM_swapImage() { //v3.0
							var i,j=0,x,a=MM_swapImage.arguments; document.MM_sr=new Array; for(i=0;i<(a.length-2);i+=3)
								if ((x=MM_findObj(a[i]))!=null){document.MM_sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];}
						}
				</script>
				<script language="JavaScript">
						var HttPRequest = false;

						function CallPOSTRequest(url, parameters) {
								HttPRequest = false;
								if (window.XMLHttpRequest) { // Mozilla, Safari,...
									HttPRequest = new XMLHttpRequest();
									if (HttPRequest.overrideMimeType) {
										HttPRequest.overrideMimeType('text/html');
									}
								} else if (window.ActiveXObject) { // IE
									try {
										HttPRequest = new ActiveXObject("Msxml2.XMLHTTP");
									} catch (e) {
										try {
												HttPRequest = new ActiveXObject("Microsoft.XMLHTTP");
										} catch (e) {}
									}
								}
								if (!HttPRequest) {
									alert('Cannot create XMLHTTP instance');
									return false;
								}
								HttPRequest.onreadystatechange = alertContener;
								HttPRequest.open('POST', url, true);
								HttPRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
								HttPRequest.setRequestHeader("Content-length", parameters.length);
								HttPRequest.setRequestHeader("Connection", "close");
								HttPRequest.send(parameters);
						}

						function alertContener() {
								if (HttPRequest.readyState == 4) {
									if (HttPRequest.status == 200) {
										result = HttPRequest.responseText;
										document.getElementById('myspan').innerHTML = result;
									} else {
										//alert('There was a problem with the request.');
										result = HttPRequest.responseText;
										document.getElementById('myspan').innerHTML = result;
									}
								}
						}

						function SubmitContent(value) {
								document.getElementById('myspan').style.visibility = 'hidden';
								document.getElementById('myspan').style.visibility = 'visible';
								var poststr = "shopname=" + encodeURI(document.getElementById('shopname').value);
								CallPOSTRequest('ajax2.php', poststr);
						}
						
				</script>
		</head>
		<body bgcolor="#FFFFFF" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" onLoad="MM_preloadImages('images/images/menu-backend2_02.jpg','images/images/menu-backend2_04.jpg','images/images/menu-backend2_05.jpg','images/images/menu-backend2_06.jpg','images/images/menu-backend2_07.jpg','images/images/menu-backend2_08.jpg')">
				<?php
						if($_POST['Submit']){
							$q="SELECT * FROM member WHERE id='".$_SESSION['adminshop_id']."' ";
							$upscore= new nDB();
							$upscore->query($q);
							$upscore->next_record();    
							if ($upscore->f(welcome)=='') {
									$q="UPDATE member SET score = score+20 WHERE id = '".$_SESSION['adminshop_id']."' ";
									$db->query($q);
							} 
						
								$filepart = $_FILES["file1"]["tmp_name"];
								$filename = $_FILES["file1"]["name"];
								if(trim($_FILES["file1"]["tmp_name"]) != ""){
										$fileextension = end(explode(".",$filename));
										$filename1 = time()."1.".$fileextension;
										copy($filepart,"member_file/".$filename1);
								}else{
										$filename1 = $_POST['hidfile1'];
								}
								
						
								$filepart = $_FILES["file2"]["tmp_name"];
								$filename = $_FILES["file2"]["name"];
								if(trim($_FILES["file2"]["tmp_name"]) != ""){
										$fileextension = end(explode(".",$filename));
										$filename2 = time()."2.".$fileextension;
										copy($filepart,"member_file/".$filename2);
								}else{
										$filename2 = $_POST['hidfile2'];
								}

							$data = array(
								array(
									'id' => $_SESSION['adminshop_id']
								),
								array(
									'email' => $_POST['email'],
									'name' => $_POST['name'],
									'tel' => $_POST['tel'],
									'mobile' => $_POST['mobile'],
									'address' => $_POST['address'],
									'amphur' => '',
									'province' => '',
									'country' => $_POST['country'],
									'postcode' => $_POST['postcode'],
									'welcome' => $_POST['welcome'],
									'warranty2' => $_POST['warranty2'],
									'warranty3' => $_POST['warranty3'],
									'warranty4' => $_POST['warranty4'],
									'warranty5' => $_POST['warranty5'],
									'warranty6' => $_POST['warranty6'],
									'warrantydetail1' => $_POST['warranty-detail1'],
									'warrantydetail2' => $_POST['warranty-detail2'],
									'warrantydetail3' => $_POST['warranty-detail3'],
									'warrantydetail4' => $_POST['warranty-detail4'],
									'shopname' => $_POST['shopname'],
									'file1' => $filename1,
									'file2' => $filename2,
									'paypal' => $_POST['paypal'],
									'warranty' => $_POST['warranty'],
									'bankacc1' => $_POST['bankacc1'],
									'bankname1' => $_POST['bankname1'],
									'bankbranch1' => $_POST['bankbranch1'],
									'bankid1' => $_POST['bankid1'],
									'bankinfo' => $_POST['bankinfo'],
									'banktype1' => $_POST['banktype1'],
									'lineid' => $_POST['lineid'],
									'wechat' => $_POST['wechat']
								)
							);

							$rs = Update("member",$data);
							if($rs){
									echo "<script>alert('แก้ไขข้อมูลเรียบร้อยแล้ว / 登計成功')</script>";
								}else{
									echo "<script>alert('เกิดข้อผิดพลาดในการแก้ไขข้อมูล กรุณาตรวจสอบใหม่ิีกครั้ง')</script>";
								}

								header("location:index.php");
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
																<td height="25" colspan="2" bgcolor="#4a1701" id="detail-text" style="color: #FC0">Package Now / แพคเกจที่เลือกไว้ / 所选择的产品支付表</td>
														</tr>
														<tr>
																<td width="28%" align="right" bgcolor="#311308" class="detail-text" id="detail-text"> Package Now / แพคเกจที่เลือกไว้ / <br/>所选择的产品支付表</td>
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
																								<input name="package" disabled type="radio" value="A182" <? if($package_code=="A182"){echo "checked";}?>/>
																							</div>
																					</td>
																					<td bgcolor="#EFEFEF">
																							<div align="right">
																								750
																								<input name="package" disabled type="radio" value="A365" <? if($package_code=="A365"){echo "checked";}?>/>
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
																								<input name="package" disabled type="radio" value="B182" <? if($package_code=="B182"){echo "checked";}?>/>
																							</div>
																					</td>
																					<td bgcolor="#F8F8F8">
																							<div align="right">
																								1,000
																								<input name="package" disabled type="radio" value="B365" <? if($package_code=="B365"){echo "checked";}?> />
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
																								<input name="package" disabled type="radio" value="C182" <? if($package_code=="C182"){echo "checked";}?> />
																							</div>
																					</td>
																					<td bgcolor="#EFEFEF">
																							<div align="right">
																								1,500
																								<input name="package" disabled type="radio" value="C365" <? if($package_code=="C365"){echo "checked";}?> />
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
																								<input name="package" disabled type="radio" value="D182"  <? if($package_code=="D182"){echo "checked";}?>/>
																							</div>
																					</td>
																					<td bgcolor="#F8F8F8">
																							<div align="right">
																								2,000
																								<input name="package" disabled type="radio" value="D365"  <? if($package_code=="D365"){echo "checked";}?>/>
																							</div>
																					</td>
																				</tr>
																				<tr bgcolor="#CCCCFF">
																					<td bgcolor="#EFEFEF">
																							<div align="right">Package E/ 500</div>
																					</td>
																					<td bgcolor="#EFEFEF">
																							<div align="right">1,500
																								<input name="package" disabled type="radio" value="E182"  <? if($package_code=="E182"){echo "checked";}?>/>
																							</div>
																					</td>
																					<td bgcolor="#EFEFEF">
																							<div align="right">2,500
																								<input name="package" disabled type="radio" value="E365"  <? if($package_code=="E365"){echo "checked";}?>/>
																							</div>
																					</td>
																				</tr>
																				<tr bgcolor="#CCCCCC">
																					<td bgcolor="#F8F8F8">
																							<div align="right">Package F / 600</div>
																					</td>
																					<td bgcolor="#F8F8F8">
																							<div align="right">1,750
																								<input name="package" disabled type="radio" value="F182"  <? if($package_code=="F182"){echo "checked";}?>/>
																							</div>
																					</td>
																					<td bgcolor="#F8F8F8">
																							<div align="right">3,000
																								<input name="package" disabled type="radio" value="F365"  <? if($package_code=="F365"){echo "checked";}?>/>
																							</div>
																					</td>
																				</tr>
																				<tr bgcolor="#CCCCFF">
																					<td bgcolor="#EFEFEF">
																							<div align="right">Package G / 700</div>
																					</td>
																					<td bgcolor="#EFEFEF">
																							<div align="right">2,000
																								<input name="package" disabled type="radio" value="G182"  <? if($package_code=="G182"){echo "checked";}?>/>
																							</div>
																					</td>
																					<td bgcolor="#EFEFEF">
																							<div align="right">3,500
																								<input name="package" disabled type="radio" value="G365"  <? if($package_code=="G365"){echo "checked";}?>/>
																							</div>
																					</td>
																				</tr>
																				<tr bgcolor="#CCCCCC">
																					<td bgcolor="#F8F8F8">
																							<div align="right">Package H / 800</div>
																					</td>
																					<td bgcolor="#F8F8F8">
																							<div align="right">2,500
																								<input name="package" disabled type="radio" value="H182"  <? if($package_code=="H182"){echo "checked";}?>/>
																							</div>
																					</td>
																					<td bgcolor="#F8F8F8">
																							<div align="right">4,000
																								<input name="package" disabled type="radio" value="H365"  <? if($package_code=="H365"){echo "checked";}?>/>
																							</div>
																					</td>
																				</tr>
																				<tr bgcolor="#CCCCFF">
																					<td bgcolor="#EFEFEF">
																							<div align="right">Package I / 900</div>
																					</td>
																					<td bgcolor="#EFEFEF">
																							<div align="right">3,000
																								<input name="package" disabled type="radio" value="I182" <? if($package_code=="I182"){echo "checked";}?> />
																							</div>
																					</td>
																					<td bgcolor="#EFEFEF">
																							<div align="right">4,500
																								<input name="package" disabled type="radio" value="I365" <? if($package_code=="I365"){echo "checked";}?> />
																							</div>
																					</td>
																				</tr>
																				<tr bgcolor="#CCCCCC">
																					<td bgcolor="#F8F8F8">
																							<div align="right">Package J / 1000</div>
																					</td>
																					<td bgcolor="#F8F8F8">
																							<div align="right">3,500
																								<input name="package" disabled type="radio" value="J182" <? if($package_code=="J182"){echo "checked";}?> />
																							</div>
																					</td>
																					<td bgcolor="#F8F8F8">
																							<div align="right">5,000
																								<input name="package" disabled type="radio" value="J365" <? if($package_code=="J365"){echo "checked";}?> />
																							</div>
																					</td>
																				</tr>
																			</tbody>
																	</table>
																</td>
															</tr>
														<tr>
																<td height="25" colspan="2" bgcolor="#4a1701" id="detail-text" style="color: #FC0">ประวัติเจ้าของร้าน / 個人資料</td>
														</tr>
														<tr>
																<td width="23%" align="right" bgcolor="#311308" class="detail-text" id="detail-text">店主名稱 / ชื่อเจ้าของร้าน :</td>
																<td width="77%" bgcolor="#311308" class="detail-text"><input name="name" type="text" id="name" value="<?=$db5->f(name)?>"></td>
														</tr>
														<tr>
																<td align="right" bgcolor="#311308" class="detail-text" id="detail-text">電子郵件 / อีเมลล์ :</td>
																<td bgcolor="#311308" class="detail-text"><input name="email" type="text" id="email" value="<?=$db5->f(email)?>"></td>
														</tr>
														<tr>
																<td align="right" bgcolor="#311308" class="detail-text" id="detail-text">電話 / โทรศัพท์บ้าน :</td>
																<td bgcolor="#311308" class="detail-text"><input name="tel" type="text" id="tel" value="<?=$db5->f(tel)?>"> <span style="color:red">** 如有家电话 / ถ้ามี</span></td>
														</tr>
														<tr>
																<td align="right" bgcolor="#311308" class="detail-text" id="detail-text">手提 / โทรศัพท์มือถือ :</td>
																<td bgcolor="#311308" class="detail-text"><input name="mobile" type="text" id="mobile" value="<?=$db5->f(mobile)?>"> <span style="color:red">** 必需填写 / จำเป็นต้องมี</span></td>
														</tr>
														<tr>
																<td align="right" bgcolor="#311308" class="detail-text" id="detail-text">地址 / ที่อยู่ :</td>
																<td bgcolor="#311308" class="detail-text">
																		<textarea id="address" name="address" style="margin:0px; padding:0px; height:100px;"><?=$db5->f(address)?></textarea>
																		<br/> <span style="color:red">*** 地址必需填写完整 / กรุณากรอกที่อยู่ให้ครบถ้วนตั้งแต่บ้านเลขที่-จังหวัด</span>
																		<script>
																				var address_editor = CKEDITOR.replace("address",{
																					height: 100,
																					removePlugins: "toolbar,elementspath,resize",
																					enterMode : CKEDITOR.ENTER_BR
																				});
																		</script>
																</td>
														</tr>
														<tr>
																<td align="right" bgcolor="#311308" class="detail-text" id="detail-text">国家 / ประเทศ :</td>
																<td bgcolor="#311308" class="detail-text"><input name="country" type="text" id="country" value="<?=$db5->f(country)?>"> <span style="color:red">** 必需填写 / จำเป็นต้องมี</span></td>
														</tr>
														<tr>
																<td align="right" bgcolor="#311308" class="detail-text" id="detail-text">邮政编码 / รหัสไปรษณีย์ :</td>
																<td bgcolor="#311308" class="detail-text"><input name="postcode" type="text" id="postcode" value="<?=$db5->f(postcode)?>"> <span style="color:red">** 必需填写 / จำเป็นต้องมี</span></td>
														</tr>
														<tr>
																<td colspan="2" align="center" bgcolor="#1b0800" style="color:#FC0"><span style="color:#FC0">如以上的镇表用了，海外的商店可以在这里填写帐户 / เว็บนี้มีผู้ใช้งานเป็นชาวต่างชาติจำนวนมาก จะดีมากหากคุณกรอกข้อมูลของคุณเป็นภาษาอังกฤษ</span></td>
														</tr>
														<tr>
																<td height="25" colspan="2" bgcolor="#4a1701" id="detail-text" style="color: #FC0">商店详情 / รายละเอียดร้านค้า</td>
														</tr>
														<tr>
																<td align="right" bgcolor="#311308" class="detail-text" id="detail-text">
																		<span id="za_mo2">
																		店鋪名稱 / ชื่อร้านค้า :
																		</span>
																</td>
																<td bgcolor="#311308" class="sidemenu">
																		<input name="shopname" type="text" class="box_form" id="shopname" value="<?=$db5->f(shopname)?>" /> <input name="Check" type="button" id="Check" value="ตรวจสอบ / 查看" OnClick="JavaScript:SubmitContent();">
																</td>
														</tr>
														<tr>
																<td align="right" bgcolor="#311308" class="detail-text" id="detail-text">查商店名的结果 / ผลการตรวจชื่อร้านค้า :</td>
																<td bgcolor="#311308"><span id="myspan"></span></td>
														</tr>
														<tr>
																<td align="right" bgcolor="#311308" class="detail-text" id="detail-text">商店详情 / รายละเอียดร้านค้า :</td>
																<td bgcolor="#311308"><textarea name="welcome" cols="60" rows="5" id="welcome" style="overflow:hidden" placeholder="ตัวอย่างรายละเอียดร้านค้ารับเช่า ให้เช่า พระเครื่อง วัตถุมงคล เหรียญคณาจารย์ยอดนิยมทั่วไป โดยเฉพาะหลวงพ่อจิต วัดควนจง บริการท่านด้วยความซื่อสัตย์ และจริงใจ กับทุกเสียงทุกสายที่โทรเข้ามา บริหารงานโดยคุณ......"><?=$db5->f(welcome)?>
																		</textarea>
																</td>
														</tr>
														<script>
																CKEDITOR.replace( 'address', {
																	toolbar:  [
																	]
																});
																CKEDITOR.replace( 'welcome', {
																	toolbar:  [
																	]
																});               
														</script>
														<tr>
																<td align="right" bgcolor="#311308" class="detail-text" id="detail-text"> 如何保证产品 / การรับประกัน :</td>
																<td bgcolor="#311308">
																		<style type="text/css">
																				.textcondition{
																				height: 37px;
																				text-align: center;
																				width: 94px;
																				}
																		</style>
																		<table width="550" border="1" cellpadding="3" cellspacing="0" style="border-collapse: collapse;border-spacing: 0">
																				<tr>
																						<td width="20" rowspan="2"><input type="checkbox" value="1" name="warranty2" <? if ($db5->f(warranty2) ==1) { echo checked ;  } ?>  /></td>
																						<td width="206"><span class="detail-text">รับประกันพระแท้ภายในระยะเวลา </span></td>
																						<td colspan="2" rowspan="2" align="center"><span class="detail-text">
																								<input name="warranty-detail1" type="text" id="warranty-detail1" class="textcondition" value="<?=$db5->f(warrantydetail1)?>" placeholder="เช่น / 如  365"/>
																								วัน / 天</span>
																						</td>
																						<td width="149"><span class="detail-text"> นับแต่ลูกค้าได้รับพระไป</span></td>
																				</tr>
																				<tr>
																						<td><span class="detail-text">保证真产品的期间内</span></td>
																						<td><span class="detail-text">算当天开始领到产品</span></td>
																				</tr>
																				<tr>
																						<td rowspan="4"><input type="checkbox" value="1" name="warranty3"  <? if ($db5->f(warranty3) ==1) { echo checked ;  } ?>/></td>
																						<td><span class="detail-text">รับประกันความพอใจในระยะเวลา</span></td>
																						<td colspan="2" rowspan="2" align="center"><span class="detail-text">
																								<input name="warranty-detail2" type="text" id="warranty-detail2" class="textcondition" value="<?=$db5->f(warrantydetail2)?>" placeholder="เช่น / 如  15" />
																								วัน / 天</span>
																						</td>
																						<td><span class="detail-text">ไม่หักเปอร์เซ็นต์</span></td>
																				</tr>
																				<tr>
																						<td><span class="detail-text">保证满意的定期时间</span></td>
																						<td><span class="detail-text">不扣百分之</span></td>
																				</tr>
																				<tr>
																						<td colspan="2"><span class="detail-text">(เมื่อได้รับพระแล้วไม่ถูกใจ) แต่หากเกินจำนวนวันหัก</span></td>
																						<td colspan="2" rowspan="2"><span class="detail-text">
																								<input name="warranty-detail3" type="text" id="warranty-detail3" class="textcondition" value="<?=$db5->f(warrantydetail3)?>" placeholder="เช่น / 如  20"/>
																								</span><span class="detail-text"> %</span>
																						</td>
																				</tr>
																				<tr>
																						<td colspan="2"><span class="detail-text">(意思是如领到后不满意) 但如超定期扣数目</span></td>
																				</tr>
																				<tr>
																						<td rowspan="2"><input type="checkbox" value="1" name="warranty4" <? if ($db5->f(warranty4) ==1) { echo checked ;  } ?> /></td>
																						<td colspan="3"><span class="detail-text">พระต้องอยู่ในสภาพเดิม ไม่ชำรุดหักบิ่น เสียสภาพ ล้างผิว</span></td>
																						<td>&nbsp;</td>
																				</tr>
																				<tr>
																						<td colspan="3"><span class="detail-text">产品要保持原样 不残破 断 洗皮</span></td>
																						<td>&nbsp;</td>
																				</tr>
																				<tr>
																						<td rowspan="2"><input type="checkbox" value="1" name="warranty5" <? if ($db5->f(warranty5) ==1) { echo checked ;  } ?> /></td>
																						<td colspan="3"><span class="detail-text">ยินดีรับซื้อคืนในราคาตลาดขณะนั้น</span></td>
																						<td>&nbsp;</td>
																				</tr>
																				<tr>
																						<td colspan="3"><span class="detail-text">卖家满意买回当时产品的买卖价钱</span></td>
																						<td>&nbsp;</td>
																				</tr>
																				<tr>
																						<td rowspan="2"><input type="checkbox" value="1" name="warranty6" <? if ($db5->f(warranty6) ==1) { echo checked ;  } ?> /></td>
																						<td colspan="3"><span class="detail-text">นำมาแลกเปลี่ยน กับองค์ใหม่ได้ หากท่านต้องการซื้อพระองค์อื่นโดยหัก</span></td>
																						<td rowspan="2"><span class="detail-text">
																								<input name="warranty-detail4" type="text" id="warranty-detail4" class="textcondition" value="<?=$db5->f(warrantydetail4)?>" placeholder="เช่น / 如  20"/>
																								%</span>
																						</td>
																				</tr>
																				<tr>
																						<td colspan="3"><span class="detail-text">产品交换，可以换新的产品，如买家需要换别的产品，将要扣百分之 </span></td>
																				</tr>
																				<tr>
																						<td colspan="5" align="center" style="color:#F00">เลือกการรับประกันอย่างน้อย 1 ข้อ / <span style="color:#FC0">必需选以上的保证产品项目最少一条</span></td>
																				</tr>
																		</table>
																</td>
														</tr>
														<tr>
																<td align="right" bgcolor="#311308" class="detail-text">รับประกันเพิ่มเติม :<br>
																		/ 增加其它的保证方法
																</td>
																<td bgcolor="#311308"><textarea name="warranty" cols="60"><?=$db5->f(warranty)?>
																		</textarea>
																</td>
														</tr>
														<tr>
																<td align="right" bgcolor="#311308" class="detail-text" id="detail-text">如何付款 / วิธีการชำระเงิน :</td>
																<td bgcolor="#311308">
																		<table width="593" border="0" align="center" cellpadding="3" cellspacing="0">
																				<tr class="detail-text">
																						<td width="170" height="30" align="right" class="detail-text">帐户名称 / ชื่อบัญชี :</td>
																						<td colspan="3"><input name="bankacc1" type="text" id="bankacc1" style="width:200px" size="200" value="<?=$db5->f(bankacc1)?>" /></td>
																				</tr>
																				<tr>
																						<td align="right" class="detail-text">银行 / ธนาคาร :</td>
																						<td width="214"><input name="bankname1" type="text" id="bankname1" style="width:200px" value="<?=$db5->f(bankname1)?>" /></td>
																						<td width="35" align="right" class="detail-text">&nbsp;</td>
																						<td width="202">&nbsp;</td>
																				</tr>
																				<tr>
																						<td align="right" class="detail-text">分行 / สาขา :</td>
																						<td><input name="bankbranch1" type="text" id="bankbranch1" style="width:200px" value="<?=$db5->f(bankbranch1)?>" /></td>
																						<td align="right" class="detail-text">&nbsp;</td>
																						<td>&nbsp;</td>
																				</tr>
																				<tr>
																						<td align="right" class="detail-text">帐户号码 / เลขที่บัญชี :</td>
																						<td><input name="bankid1" type="text" id="bankid1" style="width:200px" value="<?=$db5->f(bankid1)?>" /></td>
																						<td>&nbsp;</td>
																						<td>&nbsp;</td>
																				</tr>
																				<tr>
																						<td align="right" class="detail-text">帐户分类 / ประเภทบัญชี :</td>
																						<td colspan="3" class="detail-text"><input name="banktype1" type="radio"  value="1" <? if ($db5->f(banktype1) ==1) { echo checked ;  } ?>/>
																								节约 / 
																								ออมทรัพย์
																								<input type="radio" name="banktype1" value="2" <? if ($db5->f(banktype1) ==2) { echo checked ;  } ?>  />
																								经常帐 /                    กระแสรายวัน
																						</td>
																				</tr>
																				<tr>
																						<td align="right" class="detail-text">其它帐户 / อื่น ๆ</td>
																						<td colspan="3" class="detail-text"><textarea name="bankinfo" id="bankinfo" style="width:420px; height:100px"><?=$db5->f(bankinfo)?>
																								</textarea>
																						</td>
																				</tr>
																		</table>
																</td>
														</tr>
														<tr>
														  <td align="right" bgcolor="#311308" class="detail-text">Line ID :</td>
														  <td align="left" valign="top" bgcolor="#311308" style="height:25px;">
														  		<input type="text" name="lineid" value="<?=$db5->f(lineid)?>">
														  </td>
													 </tr>
													 <tr>
														  <td align="right" bgcolor="#311308" class="detail-text">WeChat ID :</td>
														  <td align="left" valign="top" bgcolor="#311308" style="height:25px;">
														  		<input type="text" name="wechat" value="<?=$db5->f(wechat)?>">
														  </td>
													 </tr>
														<tr>
																<td align="right" bgcolor="#311308" class="detail-text" id="detail-text"> 传上复制的首页银行帐薄  / สำเนาหน้า book bank :</td>
																<td bgcolor="#311308"><span style="color:#FC0">
																		<input class="file1" name="file1" type="file" id="file1" />
																		<input type="hidden" name="hidfile1" value="<?=$db5->f(file1)?>">
																		</span> <span style="color:#FC0">必需与身份证的名字相同 </span><span style="color:#FF0000;font-weight:bold;font-size:10px;">/ ให้ตรงกับสำเนาบัตรประชาชน</span>
																</td>
														</tr>
														<tr>
																<td align="right" bgcolor="#311308" class="detail-text" id="detail-text"> 传上复制的身份证卡 <br />
																		/ สำเนาบัตรประชาชน :
																</td>
																<td bgcolor="#311308"><span style="color:#FC0">
																		<input class="file2" name="file2" type="file" id="file2" />
																		<input type="hidden" name="hidfile2" value="<?=$db5->f(file2)?>">
																		</span> <span style="color:#FF0000;font-weight:bold;font-size:10px;">*</span>
																</td>
														</tr>
														<tr>
																<td align="right" bgcolor="#311308" class="detail-text">帐号/บัญชี Paypal :</td>
																<td bgcolor="#311308"><input name="paypal" type="text" id="paypal" style="width:200px" value="<?=$db5->f(paypal)?>" /> <span style="color:red">** 如有注册 / ถ้ามี</span></td>
														</tr>
														<tr>
																<td bgcolor="#311308" id="detail-text">&nbsp;</td>
																<td bgcolor="#311308"><input name="Submit" type="submit" id="Submit" value="แก้ไขข้อมูล / 增改信息" /></td>
														</tr>
														<iframe src="" name="reg_frm" width="1px" height="0px" frameborder="0" id="reg_frm"></iframe>
												</table>
										</form>
								</td>
						</tr>
						<tr>
								<td>
									<?php include('footer.php');?>
								</td>
						</tr>
				</table>
				<!-- End Save for Web Slices -->
		</body>
		<script type="text/javascript">
				$(function(){
					$('form[name="form1"]').submit(function () {
							if($('#mobile').val()==""){
								alert('กรุณากรอกข้อมูลข้อมูลให้ครบ');
								$('#mobile').focus();
								return false;
							}else if($('#country').val()==""){
								alert('กรุณากรอกข้อมูลข้อมูลให้ครบ');
								$('#country').focus();
								return false;
							}else if($('#postcode').val()==""){
								alert('กรุณากรอกข้อมูลข้อมูลให้ครบ');
								$('#postcode').focus();
								return false;
							}else{
								return true;
							}
					});
				});
		</script>
</html>
