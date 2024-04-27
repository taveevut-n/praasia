<?php
	include('../global.php');
	if($_SESSION['adminid']=='' || !isset($_SESSION['adminid'])) {  
		redi4("login.php");
	}

	$do_what = $_POST["do_what"];
	if($do_what == "member_extend"){
		$member_id = $_POST["member_id"];
		$package_select = $_POST["package_select"];
		$r = mysql_fetch_array(mysql_query("select * from member_package where package_id = '$package_select'"));
		$date_expire = strtotime("+".$r["package_duration"]." day", strtotime(date("Y-m-d")));
		mysql_query("update member set date_expire = '$date_expire', date_extend = '".strtotime(date("Y-m-d"))."', package_id = '$package_select' where id = '$member_id'");
		$q = "update `product` set active='2' WHERE `shop_id` = '".$member_id."' ";
		$q = "update `member` set pack_amountformem ='".$r["package_amount"]."' WHERE `id` = '".$member_id."' ";
		$db->query($q);
	}
	else if($do_what == "member_score"){
		echo $q="UPDATE `member` SET `score` = `score`".$_POST['calculate']." ".$_POST['point']." WHERE id = '".$_GET['shop_id']."' "; ;		
		$db->query($q);	
		$q = "INSERT INTO `history_point` ( `history_id` , `event` , `point` , `cause`, `shop_id`) VALUES ('', '".$_POST['calculate']."', '".$_POST['point']."', '".$_POST['cause']."', '".$_GET['shop_id']."');";
		$db->query($q);		
	}
	
	
	?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<title>ระบบจัดการเว็บไซต์</title>
		<style type="text/css">
			body {
				background-color: #000;
				margin-left: 0px;
				margin-top: 0px;
				margin-right: 0px;
				font-size:12px;
				margin-bottom: 0px;	
			}
			.bh{
				color:#FC0;
				font-size:14px;
				height:30px;
			}
			.sidemenu{
				color:#FFF;
				font-size:12px;
				height:25px;
				border-bottom:1px solid #000;
				text-decoration:none;
			}
			.sidemenu:hover{
				text-decoration:none;
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
	<body>
		<script src="../ieditor/ckeditor.js"></script>  
		<table width="1000" border="0" align="center" cellpadding="0" cellspacing="0">
			<tr>
			<td><img src="/admin/images/head.jpg" width="1098" height="288" /></td>
			</tr>
			<tr>
			<td bgcolor="#311407">
				<table width="100%" border="0" cellspacing="3" cellpadding="0">
					<tr>
						<td width="250" valign="top"><? include('sidemenu.php') ?></td>
						<td valign="top" bgcolor="#3f1d0e">
						<?
							if($_POST['submit']) {
							if($_POST['amuletpass']) {
								$filepart = $_FILES["file1"]["tmp_name"];
								$filename = $_FILES["file1"]["name"];
								if(trim($_FILES["file1"]["tmp_name"]) != ""){
									$fileextension = end(explode(".",$filename));
									$filename1 = time()."1.".$fileextension;
									copy($filepart,"../member_file/".$filename1);
								}else{
									$filename1 = $_POST['hidfile1'];
								}
							
								$filepart = $_FILES["file2"]["tmp_name"];
								$filename = $_FILES["file2"]["name"];
								if(trim($_FILES["file2"]["tmp_name"]) != ""){
									$fileextension = end(explode(".",$filename));
									$filename2 = time()."2.".$fileextension;
									copy($filepart,"../member_file/".$filename2);
								}else{
										$filename2 = $_POST['hidfile2'];
								}
								
								$filepart = $_FILES["file3"]["tmp_name"];
								$filename = $_FILES["file3"]["name"];
								if(trim($_FILES["file3"]["tmp_name"]) != ""){
									$fileextension = end(explode(".",$filename));
									$filename3 = time()."3.".$fileextension;
									copy($filepart,"../member_file/".$filename3);
								}else{
										$filename3 = $_POST['hidfile3'];
								}								
									
								$q="UPDATE `member` 
									SET 	`username` = '".$_POST['amuletuser']."' ,
											`password` = '". md5(base64_encode(md5(md5($_POST['amuletpass']))))."',
											`name` = '".$_POST['name']."',
											`email` = '".$_POST['email']."',
											`tel` = '".$_POST['tel']."',
											`mobile` = '".$_POST['mobile']."',
											`address` = '".$_POST['address']."',
											`shopname` = '".$_POST['shopname']."',
											`amphur` = '',
											`province` = '',
											`postcode` = '".$_POST['postcode']."',
											`country` = '".$_POST['country']."',
											`welcome` = '".$_POST['welcome']."',
											`file1` = '$filename1',
											`file2` = '$filename2',
											`file3` = '$filename3',
											`warranty2` = '".$_POST['warranty2']."',
											`warranty3` = '".$_POST['warranty3']."',
											`warranty4` = '".$_POST['warranty4']."',
											`warranty5` = '".$_POST['warranty5']."',
											`warranty6` = '".$_POST['warranty6']."',
											`warrantydetail1` = '".$_POST['warranty-detail1']."',
											`warrantydetail2` = '".$_POST['warranty-detail2']."',
											`warrantydetail3` = '".$_POST['warranty-detail3']."',
											`warrantydetail4` = '".$_POST['warranty-detail4']."',
											`paypal` = '".$_POST['paypal']."',	
											`warranty` = '".$_POST['warranty']."',		
											`bankacc1` = '".$_POST['bankacc1']."',
											`bankname1` = '".$_POST['bankname1']."',
											`bankbranch1` = '".$_POST['bankbranch1']."',
											`bankid1` = '".$_POST['bankid1']."',
											`bankinfo` = '".$_POST['bankinfo']."',
											`banktype1` = '".$_POST['banktype1']."' 
									WHERE `id` ='".$_POST['e_shop_id']."' ";
								$db->query($q);
								al('แก้ไขข้อมูลเรียบร้อยแล้ว / 信息已增改');
								redi4('index.php');
							} else {
								$filepart = $_FILES["file1"]["tmp_name"];
								$filename = $_FILES["file1"]["name"];
								if(trim($_FILES["file1"]["tmp_name"]) != ""){
									$fileextension = end(explode(".",$filename));
									$filename1 = time()."1.".$fileextension;
									copy($filepart,"../member_file/".$filename1);
								}else{
									$filename1 = $_POST['hidfile1'];
								}
							
								$filepart = $_FILES["file2"]["tmp_name"];
								$filename = $_FILES["file2"]["name"];
								if(trim($_FILES["file2"]["tmp_name"]) != ""){
									$fileextension = end(explode(".",$filename));
									$filename2 = time()."2.".$fileextension;
									copy($filepart,"../member_file/".$filename2);
								}else{
										$filename2 = $_POST['hidfile2'];
								}
								
								$filepart = $_FILES["file3"]["tmp_name"];
								$filename = $_FILES["file3"]["name"];
								if(trim($_FILES["file3"]["tmp_name"]) != ""){
									$fileextension = end(explode(".",$filename));
									$filename3 = time()."3.".$fileextension;
									copy($filepart,"../member_file/".$filename3);
								}else{
										$filename3 = $_POST['hidfile3'];
								}								
								
		if ($_POST['type']=='3') {
			$date_expire =date('Y-m-d',strtotime('+99 year'));
		}
								
								$q="UPDATE `member` 
									SET 	`username` = '".$_POST['amuletuser']."' ,
											`name` = '".$_POST['name']."',
											`type` = '".$_POST['type']."',
											`email` = '".$_POST['email']."',
											`tel` = '".$_POST['tel']."',
											`mobile` = '".$_POST['mobile']."',
											`address` = '".$_POST['address']."',
											`shopname` = '".$_POST['shopname']."',
											`amphur` = '',
											`province` = '',
											`postcode` = '".$_POST['postcode']."',
											`country` = '".$_POST['country']."',
											`welcome` = '".$_POST['welcome']."',
											`file1` = '$filename1',
											`file2` = '$filename2',
											`file3` = '$filename3',
											`warranty2` = '".$_POST['warranty2']."',
											`warranty3` = '".$_POST['warranty3']."',
											`warranty4` = '".$_POST['warranty4']."',
											`warranty5` = '".$_POST['warranty5']."',
											`warranty6` = '".$_POST['warranty6']."',
											`warrantydetail1` = '".$_POST['warranty-detail1']."',
											`warrantydetail2` = '".$_POST['warranty-detail2']."',
											`warrantydetail3` = '".$_POST['warranty-detail3']."',
											`warrantydetail4` = '".$_POST['warranty-detail4']."',
											`paypal` = '".$_POST['paypal']."',	
											`warranty` = '".$_POST['warranty']."',		
											`bankacc1` = '".$_POST['bankacc1']."',
											`bankname1` = '".$_POST['bankname1']."',
											`bankbranch1` = '".$_POST['bankbranch1']."',
											`bankid1` = '".$_POST['bankid1']."',
											`bankinfo` = '".$_POST['bankinfo']."',
											`banktype1` = '".$_POST['banktype1']."' ,
											`member_expire` = '".$date_expire."' 
									WHERE `id` ='".$_POST['e_shop_id']."' ";
								$db->query($q);
								al('แก้ไขข้อมูลเรียบร้อยแล้ว / 信息已增改');
								redi4('index.php');
							}
							}
							?>
						<?php
							if($_GET['shop_id']){
								$q="SELECT * FROM member WHERE id=".$_GET['shop_id']." ";
								$db5=new nDB();
								$db5->query($q);
								$db5->next_record();
							}
							?>
						<form action="" method="post" enctype="multipart/form-data" name="form1" id="form1">
							<table width="100%" border="0" align="center" cellpadding="5" cellspacing="1">
								<tr>
									<td width="32%" height="25" colspan="2" align="left" bgcolor="#4a1701" class="bh" style="color: #FC0">ประเภทสมาชิก</td>
								</tr>
								<tr>
									<td width="32%" align="right" bgcolor="#311308" class="sidemenu" id="detail-text">ประเภทสมาชิก:</td>
									<td width="68%" bgcolor="#311308">
                                    	<select name="type">
                                        	<option value="0" <? if ($db5->f(type)=='0') { echo 'selected="selected"' ;  } ?>>
                                            ร้านค้า
                                            </option>
                                        	<option value="2" <? if ($db5->f(type)=='2') { echo 'selected="selected"' ;  } ?>>
                                            สมาชิกรทั่วไปรายปี
                                            </option>
                                        	<option value="3" <? if ($db5->f(type)=='3') { echo 'selected="selected"' ;  } ?>>
                                            สมาชิก VIP
                                            </option>                                                                                        
                                        </select>
                                    </td>
								</tr>
								<tr>
									<td width="32%" height="25" colspan="2" align="left" bgcolor="#4a1701" class="bh" style="color: #FC0">ชื่อผู้ใช้</td>
								</tr>
								<tr>
									<td width="32%" align="right" bgcolor="#311308" class="sidemenu" id="detail-text">帐号 / ชื่อผู้ใช้ (Username):</td>
									<td width="68%" bgcolor="#311308"><input name="amuletuser" type="text" id="amuletuser" autocomplete="off" value="<?=$db5->f(username)?>" /></td>
								</tr>
								<tr>
									<td align="right" bgcolor="#311308" class="sidemenu" id="detail-text">密码 / รหัสผ่าน (password) :</td>
									<td bgcolor="#311308"><input name="amuletpass" type="password" id="amuletpass" autocomplete="off"  /> <span class="sidemenu">ไม่สามารถดูได้ แก้ไขได้</span></td>
								</tr>
								<tr>
									<td colspan="2" bgcolor="#1b0800">&nbsp;</td>
								</tr>
								<tr>
									<td height="25" colspan="2" bgcolor="#4a1701" id="detail-text" style="color: #FC0">ประวัติเจ้าของร้าน / 個人資料</td>
								</tr>
								<tr>
									<td align="right" bgcolor="#311308" class="sidemenu" id="detail-text">店主名稱 / ชื่อเจ้าของร้าน :</td>
									<td bgcolor="#311308"><input name="name" type="text" id="name" value="<?=$db5->f(name)?>" /></td>
								</tr>
								<tr>
									<td align="right" bgcolor="#311308" class="sidemenu" id="detail-text"><span class="detail-text">電子郵件 / อีเมลล์  :</span></td>
									<td bgcolor="#311308"><input name="email" type="text" id="email" value="<?=$db5->f(email)?>" /></td>
								</tr>
								<tr>
									<td align="right" bgcolor="#311308" class="sidemenu" id="detail-text">電話 / โทรศัพท์บ้าน :</td>
									<td bgcolor="#311308"><input name="tel" type="text" id="tel" value="<?=$db5->f(tel)?>" />
									&nbsp; <span class="detail-text"><span style="color:red">** 如有家电话 / ถ้ามี</span></span>
									</td>
								</tr>
								<tr>
									<td align="right" bgcolor="#311308" class="sidemenu" id="detail-text">手提 / โทรศัพท์มือถือ :</td>
									<td bgcolor="#311308"><input name="mobile" type="text" id="tel" value="<?=$db5->f(mobile)?>" />
									&nbsp; <span style="color:red">** 必需填写 / จำเป็นต้องมี</span>
									</td>
								</tr>
								<tr>
									<td align="right" bgcolor="#311308" class="sidemenu" id="detail-text">地址 / ที่อยู่ :</td>
									<td bgcolor="#311308"><textarea name="address" cols="50" id="address"><?=$db5->f(address)?></textarea><br/><span style="color:red">*** 地址必需填写完整 / กรุณากรอกที่อยู่ให้ครบถ้วนตั้งแต่บ้านเลขที่-จังหวัด</span></td>
								</tr>
								<script>	
									var address_editor = CKEDITOR.replace("address",{
													height: 100,
													removePlugins: "toolbar,elementspath,resize",
													enterMode : CKEDITOR.ENTER_BR
												});				
								</script>
								<tr>
									<td align="right" bgcolor="#311308" class="detail-text" id="detail-text">国家 / ประเทศ :</td>
									<td bgcolor="#311308">
									<select name="country" id="country">
										<option value="Thailand" <? if($db5->f(country)=='Thailand'){echo 'selected="select"';}?>>Thailand</option>
										<option value="Malaysia" <? if($db5->f(country)=='Malaysia'){echo 'selected="select"';}?>>Malaysia</option>
										<option value="Singapore" <? if($db5->f(country)=='Singapore'){echo 'selected="select"';}?>>Singapore</option>
										<option value="China" <? if($db5->f(country)=='China'){echo 'selected="select"';}?>>China</option>
										<option value="Hongkong" <? if($db5->f(country)=='Hongkong'){echo 'selected="select"';}?>>Hongkong</option>
										<option value="Taiwan" <? if($db5->f(country)=='Taiwan'){echo 'selected="select"';}?>>Taiwan</option>
										<option value="Indonesia" <? if($db5->f(country)=='Indonesia'){echo 'selected="select"';}?>>Indonesia</option>
									</select>
									<span class="detail-text"><span style="color:red">** 必需填写 / จำเป็นต้องมี</span></span>
									</td>
								</tr>
								<tr>
									<td align="right" bgcolor="#311308" class="sidemenu" id="detail-text">邮政编码 / รหัสไปรษณีย์  :</td>
									<td bgcolor="#311308"><input name="postcode" type="text" id="address" value="<?=$db5->f(postcode)?>" /></td>
								</tr>
								<tr>
									<td align="right" bgcolor="#311308" class="sidemenu" id="detail-text">Line ID  :</td>
									<td bgcolor="#311308"><input name="postcode" type="text" id="address" value="<?=$db5->f(lineid)?>" /></td>
								</tr>
								<tr>
									<td align="right" bgcolor="#311308" class="sidemenu" id="detail-text">Wechat  :</td>
									<td bgcolor="#311308"><input name="postcode" type="text" id="address" value="<?=$db5->f(wechat)?>" /></td>
								</tr>                                                                
								<tr>
									<td colspan="2" align="center" valign="middle" bgcolor="#1b0800" class="sidemenu" id="detail-text3"><span class="detail-text"><span style="color:#FC0">如以上的镇表用了，海外的商店可以在这里填写帐户 / เว็บนี้มีผู้ใช้งานเป็นชาวต่างชาติจำนวนมาก จะดีมากหากคุณกรอกข้อมูลของคุณเป็นภาษาอังกฤษ</span></span></td>
								</tr>
								<tr>
									<td colspan="2" bgcolor="#4a1701" class="sidemenu" id="detail-text4"><span style="color: #FC0">商店详情 / รายละเอียดร้านค้า</span></td>
								</tr>
								<tr>
									<td align="right" bgcolor="#311308" class="sidemenu" id="detail-text">
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
									<td align="right" bgcolor="#311308" class="sidemenu" id="detail-text5"><span class="detail-text">商店详情 / รายละเอียดร้านค้า :</span></td>
									<td bgcolor="#311308"><textarea name="welcome" cols="60" rows="5" id="welcome" style="overflow:hidden" placeholder="ตัวอย่างรายละเอียดร้านค้ารับเช่า ให้เช่า พระเครื่อง วัตถุมงคล เหรียญคณาจารย์ยอดนิยมทั่วไป โดยเฉพาะหลวงพ่อจิต วัดควนจง บริการท่านด้วยความซื่อสัตย์ และจริงใจ กับทุกเสียงทุกสายที่โทรเข้ามา บริหารงานโดยคุณ......"><?=$db5->f(welcome)?></textarea></td>
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
									<td align="right" bgcolor="#311308" class="sidemenu" id="detail-text2"><span class="detail-text">如何保证产品 / การรับประกัน :</span></td>
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
									<td align="right" bgcolor="#311308" class="sidemenu" id="detail-text6"><span class="detail-text">รับประกันเพิ่มเติม :<br />
									/ 增加其它的保证方法</span>
									</td>
									<td bgcolor="#311308"><textarea name="warranty" cols="60"><?=$db5->f(warranty)?>
									</textarea>
									</td>
								</tr>
								<tr>
									<td align="right" bgcolor="#311308" class="sidemenu" id="detail-text7"><span class="detail-text">如何付款 / วิธีการชำระเงิน :</span></td>
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
									<td align="right" bgcolor="#311308" class="sidemenu" id="detail-text"><span class="detail-text">传上复制的首页银行帐薄  / สำเนาหน้า book bank :</span></td>
									<td bgcolor="#311308"><input class="file1" name="file1" type="file" id="file1" />
									<input type="hidden" name="hidfile1" value="<?=$db5->f(file1)?>">
									</span> <span style="color:#FC0">必需与身份证的名字相同 </span><span style="color:#FF0000;font-weight:bold;font-size:10px;">/ ให้ตรงกับสำเนาบัตรประชาชน</span>
									</td>
								</tr>
								<tr>
									<td align="right" bgcolor="#311308" class="sidemenu" id="detail-text">สำเนาบัตรประชาชน:</td>
									<td bgcolor="#311308"><input class="file2" name="file2" type="file" id="file2" />
									<input type="hidden" name="hidfile2" value="<?=$db5->f(file2)?>">
									</span> <span style="color:#FF0000;font-weight:bold;font-size:10px;">*</span>
									</td>
								</tr>
								<tr>
									<td align="right" bgcolor="#311308" class="sidemenu" id="detail-text">หลักฐานชำระเงิน:</td>
									<td bgcolor="#311308"><input class="file3" name="file3" type="file" id="file3" />
									<input type="hidden" name="hidfile3" value="<?=$db5->f(file3)?>">
									</span> <span style="color:#FF0000;font-weight:bold;font-size:10px;">*</span>
									</td>
								</tr>                                
								<tr>
									<td align="right" bgcolor="#311308" class="sidemenu" id="detail-text10"><span class="detail-text">帐号/บัญชี Paypal :</span></td>
									<td bgcolor="#311308"><input name="paypal" type="text" id="paypal" style="width:200px" value="<?=$db5->f(paypal)?>" /> <span style="color:red">** 如有注册 / ถ้ามี</span></td>
								</tr>
								<tr>
									<td bgcolor="#311308" id="detail-text">&nbsp;
									</td>
									<td bgcolor="#311308">
									<input name="submit" type="submit" id="submit" value="แก้ไข" /><input type="hidden" name="e_shop_id" value="<?=$db5->f(id)?>" />
									</td>
								</tr>
							</table>
						</form>
						<iframe src="" name="reg_frm" width="1px" height="0px" frameborder="0" id="reg_frm"></iframe>
						<form method="post">
							<table width="95%" border="0" align="center" cellpadding="5" cellspacing="1">
								<tr>
									<td height="25" colspan="2" bgcolor="#4a1701" id="detail-text" style="color: #FC0">
									ต่ออายุร้านค้า
									</td>
								</tr>
								<tr>
									<td align="right" bgcolor="#311308" class="sidemenu" id="detail-text">
									<input name="do_what" value="member_extend" type="hidden"/>
									<input name="member_id" value="<?=$db5->f(id)?>" type="hidden"/>
									<span id="za_mo2">
									เลือก package :
									</span>
									</td>
									<td bgcolor="#311308" class="sidemenu">
									<select name="package_select" class="package_select" onchange="package_change($(this));">
										<?php
											$conn = mysql_connect("localhost","prathai_new","twe31219#");
											mysql_select_db("prathai_new",$conn);
											mysql_query("SET NAMES UTF8");
											mysql_query("SET character_set_results=utf8");
											mysql_query("SET character_set_client=utf8");
											mysql_query("SET character_set_connection=utf8");
											$q = mysql_query("select * from member_package order by package_id asc ");
											while($r = mysql_fetch_array($q)){
											?>
										<option value="<?=$r["package_id"]?>" attr_duration="<?=$r["package_duration"]?>">
											<?=$r["package_name"]?>
										</option>
										<?php
											}
											?>
									</select>
									<input name="date_duration" type="hidden"/>
									</td>
								</tr>
								<tr>
									<td bgcolor="#311308" id="detail-text">&nbsp;
									</td>
									<td bgcolor="#311308">
									<input type="submit" value="ต่ออายุ" />
									</td>
								</tr>
							</table>
						</form>
						<br/>
						<form method="post">
							<table width="95%" border="0" align="center" cellpadding="5" cellspacing="1">
								<tr>
									<td height="25" colspan="2" bgcolor="#4a1701" id="detail-text" style="color: #FC0">
									ให้คะแนน
									</td>
								</tr>
								<tr>
									<td width="12%" align="right" bgcolor="#311308" class="sidemenu" id="detail-text">
										<input name="do_what" value="member_score" type="hidden"/>
										<input name="member_id" value="<?=$db5->f(id)?>" type="hidden"/>
										<span id="za_mo2">
											เพิ่มคะแนน :
										</span>
									</td>
									<td width="88%" align="left" bgcolor="#311308" class="sidemenu">
										<?=$db5->f(score)?> <input type="hidden" value="<?=$db5->f(score)?>" name="score" /><select name="calculate"><option value="+">เพิ่ม</option><option value="-">ลบ</option></select> <input type="texst" name="point" value="">คะแนน  เพราะ<input type="text" name="cause" value="">
										<input type="submit" value="ตกลง" />
									</td>
								</tr>
							</table>
						</form>
						<br />
                        <table width="95%" border="0" align="center" cellpadding="5" cellspacing="1">
								<tr>
									<td height="25" colspan="3" bgcolor="#4a1701" id="detail-text" style="color: #FC0">
									ประวัติการให้คะแนน
									</td>
								</tr>
								<tr>
									<td width="10%" align="center" bgcolor="#311308" class="sidemenu" id="detail-text">
										+ / -
									</td>
									<td width="42%" align="left" bgcolor="#311308" class="sidemenu">
										คะแนน
									</td>
									<td width="48%" align="left" bgcolor="#311308" class="sidemenu">
										สาเหตุ
									</td>
								</tr>
								<?	$q = "SELECT * FROM `history_point` WHERE shop_id = ".$_GET['shop_id']."  ORDER BY history_id DESC";
                                    $db->query($q);
                                    static $v = 1;
                                    while($db->next_record()){
                                ?>                                
								<tr>
								  <td align="center" bgcolor="#311308" class="sidemenu" id="detail-text8"><?=$db->f(event)?></td>
								  <td align="left" bgcolor="#311308" class="sidemenu"><?=$db->f(point)?></td>
								  <td align="left" bgcolor="#311308" class="sidemenu"><?=$db->f(cause)?></td>
                                </tr>
								<? } ?>
							</table>
						</td>
					</tr>
                    <tr>
                    	<td>
                        	
                        </td>
                    </tr>
				</table>
			</td>
			</tr>
		</table>
	</body>
	<script type="text/javascript">
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
			CallPOSTRequest('../ajax2.php', poststr);
		
		}
	</script>
</html>