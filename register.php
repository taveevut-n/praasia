<?php 
include("global.php"); 
include("global_counter.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>ศูนย์รวมพระเครื่องออนไลน์</title>
	<META name=description content="ศนย์พระเครื่อง เปิดร้านพระออนไลน์" >
	<meta name="keywords" content="ศูนย์พระเครื่องภาคใต้, ศูนย์พระเครื่องภาคเหนือ, ศูนย์พระเครื่องกรุงเทพ, ศูนย์พระเครื่องอีสาน"/>
	<?php include("index.css"); ?>
	<!--jquery ui Local-->
	<link rel="stylesheet" href="func/jquery-ui-1.10.3/themes/base/jquery-ui.css" />
	<style type="text/css">
		.detail-text {	color:#FFF;}
	</style>
	<script src="func/jquery-ui-1.10.3/jquery-1.9.1.js"></script>
	<script src="func/jquery-ui-1.10.3/ui/jquery-ui.js"></script>
	<script src="func/jquery-ui-1.10.3/jquery.transit.min.js"></script>
	<script>
		$(document).ready(function(){
			$(".right_button").hide();
			$(".right_panel").hide();
		});
	</script>
</head>
<script language="JavaScript">
	var HttPRequest = false;
	function CallPOSTRequest(url,parameters) {
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
	CallPOSTRequest('ajax2.php',poststr);

}

</script>
<body>
	<script src="ieditor/ckeditor.js"></script>  
	<table width="1000" border="0" align="center" cellpadding="0" cellspacing="0">
		<tr>
			<td><? include('head.php') ?></td>
		</tr>
		<tr>
			<td height="643" valign="top" style="background:#1b0800">
				<table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
					<tr>
						<td style="padding:3px; padding-top:5px">
							<script language="JavaScript" type="text/javascript">
								function reg_fo(){
									with(document.REG){
										if($(".file1").val() == ''){
											alert('กรุณาเลือกไฟล์สำเนา book bank / 请传上复制帳簿资料(手机照也可以)');
											file1.focus();
											return false;
										}	
										if($(".file2").val() == ''){
											alert('กรุณาเลือกไฟล์สำเนาบัตรประชาชน / 请传上复制身份证资料(手机照也可以)');
											file2.focus();
											return false;
										}


										<? if (!isset($_SESSION['member_id'])=='') { ?>
											if(amuletuser.value==''){
												alert('กรุณากรอกข้อมูลให้ครบถ้วน / 必需把资料填完整');
												amuletuser.focus();
												return false;
											}
											if(amuletpass.value==''){
												alert('กรุณากรอกข้อมูลให้ครบถ้วน / 必需把资料填完整');
												amuletpass.focus();
												return false;
											}
											if( (amuletpass_confirm.value == '') || (amuletpass_confirm.value != amuletpass.value) ){
												alert('กรุณากรอกรหัสยืนยันให้ถูกต้อง / 必需把资料填完整');
												amuletpass_confirm.focus();
												return false;
											}
										<?php } ?>


										if(email.value==''){
											alert('กรุณากรอกข้อมูลให้ครบถ้วน / 必需把资料填完整');
											email.focus();
											return false;
										}
										if( (email2.value == '') || (email2.value != email.value) ){
											alert('กรุณากรอกรหัสยืนยันให้ถูกต้อง / 必需把资料填完整');
											email.focus();
											return false;
										}						
										if(name.value==''){
											alert('กรุณากรอกข้อมูลให้ครบถ้วน / 必需把资料填完整');
											name.focus();
											return false;
										}
										if(mobile.value==''){
											alert('กรุณากรอกข้อมูลให้ครบถ้วน / 必需把资料填完整');
											mobile.focus();
											return false;
										}
										// if(amphur.value==''){
										// 	alert('กรุณากรอกข้อมูลให้ครบถ้วน / 必需把资料填完整');
										// 	amphur.focus();
										// 	return false;
										// }
										// if(province.value==''){
										// 	alert('กรุณากรอกข้อมูลให้ครบถ้วน / 必需把资料填完整');
										// 	province.focus();
										// 	return false;
										// }
										// if(postcode.value==''){
										// 	alert('กรุณากรอกข้อมูลให้ครบถ้วน / 必需把资料填完整');
										// 	postcode.focus();
										// 	return false;
										// }

									}
								}
								function confirm_password(x_this){
									var v_this = x_this.val();
									var v_password = $("#amuletpass").val();
									if(v_password == v_this){
										alert("ยืนยันรหัสผ่านถูกต้อง / 硧定密码正确");
									}
								}
								function confirm_email(x_this){
									var v_this = x_this.val();
									var v_email = $("#email").val();
									if(v_email == v_this){
										alert("ยืนยันอีเมลล์ถูกต้อง / 请把资料填正确");
									}
								}
							</script>	
							<?php 
							if (isset($_SESSION['member_id'])) {
								$q="SELECT * FROM member WHERE id=".$_SESSION['member_id']." ";
								$db5= new nDB();
								$db5->query($q);
								$db5->next_record();
							}
							?>					    
							<form action="sent_regit.php" method="post" name="REG" id="REG" onsubmit="return reg_fo()" enctype="multipart/form-data" target="reg_frm">
								<iframe src="" name="reg_frm" width="1px" height="0px" frameborder="0" id="reg_frm"></iframe>
								<table width="95%" border="0" align="center" cellpadding="5" cellspacing="1">
									<tr>
										<td height="25" colspan="2" align="left" bgcolor="#4a1701" class="bh" style="color: #FC0">เลือกแพคเกจ / Select Package</td>
									</tr>
									<tr>
										<td width="28%" align="right" bgcolor="#311308" class="detail-text" id="detail-text"> Select Package / <br/>เลือกแพคเกจร้านค้า / <br/>产品支付表</td>
										<td width="77%" bgcolor="#311308">
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
																<input name="package" type="radio" value="A182" />
															</div>
														</td>
														<td bgcolor="#EFEFEF">
															<div align="right">
																750
																<input name="package" type="radio" value="A365" />
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
																<input name="package" type="radio" value="B182" />
															</div>
														</td>
														<td bgcolor="#F8F8F8">
															<div align="right">
																1,000
																<input name="package" type="radio" value="B365" />
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
																<input name="package" type="radio" value="C182" />
															</div>
														</td>
														<td bgcolor="#EFEFEF">
															<div align="right">
																1,500
																<input name="package" type="radio" value="C365" />
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
																<input name="package" type="radio" value="D182"  />
															</div>
														</td>
														<td bgcolor="#F8F8F8">
															<div align="right">
																2,000
																<input name="package" type="radio" value="D365"  />
															</div>
														</td>
													</tr>
													<tr bgcolor="#CCCCFF">
														<td bgcolor="#EFEFEF">
															<div align="right">Package E/ 500</div>
														</td>
														<td bgcolor="#EFEFEF">
															<div align="right">1,500
																<input name="package" type="radio" value="E182"  />
															</div>
														</td>
														<td bgcolor="#EFEFEF">
															<div align="right">2,500
																<input name="package" type="radio" value="E365"  />
															</div>
														</td>
													</tr>
													<tr bgcolor="#CCCCCC">
														<td bgcolor="#F8F8F8">
															<div align="right">Package F / 600</div>
														</td>
														<td bgcolor="#F8F8F8">
															<div align="right">1,750
																<input name="package" type="radio" value="F182"  />
															</div>
														</td>
														<td bgcolor="#F8F8F8">
															<div align="right">3,000
																<input name="package" type="radio" value="F365"  />
															</div>
														</td>
													</tr>
													<tr bgcolor="#CCCCFF">
														<td bgcolor="#EFEFEF">
															<div align="right">Package G / 700</div>
														</td>
														<td bgcolor="#EFEFEF">
															<div align="right">2,000
																<input name="package" type="radio" value="G182"  />
															</div>
														</td>
														<td bgcolor="#EFEFEF">
															<div align="right">3,500
																<input name="package" type="radio" value="G365"  />
															</div>
														</td>
													</tr>
													<tr bgcolor="#CCCCCC">
														<td bgcolor="#F8F8F8">
															<div align="right">Package H / 800</div>
														</td>
														<td bgcolor="#F8F8F8">
															<div align="right">2,500
																<input name="package" type="radio" value="H182"  />
															</div>
														</td>
														<td bgcolor="#F8F8F8">
															<div align="right">4,000
																<input name="package" type="radio" value="H365"  />
															</div>
														</td>
													</tr>
													<tr bgcolor="#CCCCFF">
														<td bgcolor="#EFEFEF">
															<div align="right">Package I / 900</div>
														</td>
														<td bgcolor="#EFEFEF">
															<div align="right">3,000
																<input name="package" type="radio" value="I182"  />
															</div>
														</td>
														<td bgcolor="#EFEFEF">
															<div align="right">4,500
																<input name="package" type="radio" value="I365"  />
															</div>
														</td>
													</tr>
													<tr bgcolor="#CCCCCC">
														<td bgcolor="#F8F8F8">
															<div align="right">Package J / 1000</div>
														</td>
														<td bgcolor="#F8F8F8">
															<div align="right">3,500
																<input name="package" type="radio" value="J182"  />
															</div>
														</td>
														<td bgcolor="#F8F8F8">
															<div align="right">5,000
																<input name="package" type="radio" value="J365"  />
															</div>
														</td>
													</tr>
												</tbody>
											</table>
										</td>
									</tr>

									<?php if (!isset($_SESSION['member_id'])) {?>
										<tr>
											<td width="23%" align="right" bgcolor="#311308" class="detail-text" id="detail-text">帐号 / ชื่อผู้ใช้ (Username):</td>
											<td width="77%" bgcolor="#311308"><input name="amuletuser" type="text" id="amuletuser" value="<?=(isset($_SESSION['member_id']))?$db5->f(amuletuser):""?>" autocomplete="off" /></td>
										</tr>
										<tr>
											<td align="right" bgcolor="#311308" class="detail-text" id="detail-text">密码 / รหัสผ่าน (password) :</td>
											<td bgcolor="#311308"><input name="amuletpass" type="password" value="<?=(isset($_SESSION['member_id']))?$db5->f(amuletpass):""?>" id="amuletpass" autocomplete="off"  /></td>
										</tr>
										<tr>
											<td align="right" bgcolor="#311308" class="detail-text" id="detail-text">确定密码 / ยืนยันรหัสผ่าน (confirm password) :</td>
											<td bgcolor="#311308"><input onkeyup="confirm_password($(this))" value="<?=(isset($_SESSION['member_id']))?$db5->f(amuletpass_confirm):""?>" name="amuletpass_confirm" type="password" id="amuletpass_confirm" autocomplete="off"  /></td>
										</tr>

									<?php } ?>

									<tr>
										<td colspan="2" align="center" bgcolor="#1b0800"><span style="color:#FC0">เว็บนี้มีผู้ใช้งานเป็นชาวต่างชาติจำนวนมาก จะดีมากหากคุณกรอกข้อมูลของคุณเป็นภาษาอังกฤษ</span></td>
									</tr>
									<tr>
										<td height="25" colspan="2" bgcolor="#4a1701" id="detail-text" style="color: #FC0"> 個人資料 / ประวัติเจ้าของร้าน </td>
									</tr>
									<tr>
										<td align="right" bgcolor="#311308" class="detail-text" id="detail-text">店主名稱 / ชื่อเจ้าของร้าน :</td>
										<td bgcolor="#311308"><input name="name" <?php if (isset($_SESSION['member_id'])) { echo 'disabled'; } ?> type="text" id="name" value="<?=(isset($_SESSION['member_id']))?$db5->f(name):""?>" /></td>
									</tr>
									<tr>
										<td align="right" bgcolor="#311308" class="detail-text" id="detail-text">電子郵件 / อีเมลล์  :</td>
										<td bgcolor="#311308"><input name="email"  <?php if (isset($_SESSION['member_id'])) { echo 'disabled'; } ?> type="text" id="email" value="<?=(isset($_SESSION['member_id']))?$db5->f(email):""?>" /></td>
									</tr>
									<tr>
										<td align="right" bgcolor="#311308" class="detail-text" id="detail-text5">再确定電子郵件 / ยืนยันอีเมลล์  :</td>
										<td bgcolor="#311308"><input name="email2"  <?php if (isset($_SESSION['member_id'])) { echo 'disabled'; } ?> type="text" id="email2" onkeyup="confirm_email($(this))" value="<?=(isset($_SESSION['member_id']))?$db5->f(email):""?>" /></td>
									</tr>
									<tr>
										<td align="right" bgcolor="#311308" class="detail-text" id="detail-text">電話 / โทรศัพท์บ้าน :</td>
										<td bgcolor="#311308"><input name="tel" type="text" id="tel" value="<?=(isset($_SESSION['member_id']))?$db5->f(tel):""?>"/>
											&nbsp; <span class="detail-text"><span style="color:red">** 如有家电话 / ถ้ามี</span></span>
										</td>
									</tr>
									<tr>
										<td align="right" bgcolor="#311308" class="detail-text" id="detail-text">手提 / โทรศัพท์มือถือ :</td>
										<td bgcolor="#311308"><input name="mobile" <?php if (isset($_SESSION['member_id'])) { echo 'disabled'; } ?>  type="text" id="mobile" value="<?=(isset($_SESSION['member_id']))?$db5->f(mobile):""?>"/>
											&nbsp; <span style="color:red">** 必需填写 / จำเป็นต้องมี</span>
										</td>
									</tr>
									<tr>
										<td align="right" bgcolor="#311308" class="detail-text" id="detail-text2">地址 / ที่อยู่ :</td>
										<td bgcolor="#311308">
											<textarea id="address" name="address"  <?php if (isset($_SESSION['member_id'])) { echo 'disabled'; } ?>  style="margin:0px; padding:0px; height:100px;"><?=(isset($_SESSION['member_id']))?$db5->f(address):""?></textarea>
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
										<td bgcolor="#311308">
											<select name="country"  <?php if (isset($_SESSION['member_id'])) { echo 'disabled'; } ?>  id="country">
												<option value="0">-- Select Country--</option>
												<option value="Thailand"  <? if (isset($_SESSION['member_id'])) { if ($db5->f(country)=='Thailand') { echo 'selected="selected"' ;  }  } ?> >Thailand</option>
												<option value="Malaysia" <? if (isset($_SESSION['member_id'])) { if ($db5->f(country)=='Malaysia') { echo 'selected="selected"' ;  }  } ?>>Malaysia</option>
												<option value="Singapore" <? if (isset($_SESSION['member_id'])) { if ($db5->f(country)=='Singapore') { echo 'selected="selected"' ;  }  } ?>>Singapore</option>
												<option value="China" <? if (isset($_SESSION['member_id'])) { if ($db5->f(country)=='China') { echo 'selected="selected"' ;  }  } ?>>China</option>
												<option value="Hongkong" <? if (isset($_SESSION['member_id'])) { if ($db5->f(country)=='Honhkong') { echo 'selected="selected"' ;  }  } ?>>Hongkong</option>
												<option value="Taiwan" <? if (isset($_SESSION['member_id'])) { if ($db5->f(country)=='Taiwan') { echo 'selected="selected"' ;  }  } ?>>Taiwan</option>
												<option value="Indonesia" <? if (isset($_SESSION['member_id'])) { if ($db5->f(country)=='Indonesia') { echo 'selected="selected"' ;  }  } ?>>Indonesia</option>
											</select>
											<span class="detail-text"><span style="color:red">** 必需填写 / จำเป็นต้องมี</span></span>
										</td>
									</tr>
									<tr>
										<td align="right" bgcolor="#311308" class="detail-text" id="detail-text3">邮政编码 / รหัสไปรษณีย์ :</td>
										<td bgcolor="#311308"><span class="detail-text">
											<input name="postcode" type="text" id="postcode"/>
											&nbsp; <span style="color:red">** 必需填写 / จำเป็นต้องมี</span></span>
										</td>
									</tr>
									<tr>
										<td colspan="2" align="center" bgcolor="#1b0800" class="detail-text" id="detail-text4"><span style="color:#FC0">如以上的镇表用了，海外的商店可以在这里填写帐户 / เว็บนี้มีผู้ใช้งานเป็นชาวต่างชาติจำนวนมาก จะดีมากหากคุณกรอกข้อมูลของคุณเป็นภาษาอังกฤษ</span></td>
									</tr>
									<tr>
										<td colspan="2" bgcolor="#4a1701"><span style="color: #FC0">商店详情 / รายละเอียดร้านค้า</span></td>
									</tr>
									<tr>
										<td align="right" bgcolor="#311308" class="detail-text" id="detail-text"><span id="za_mo2"> 店鋪名稱 / ชื่อร้านค้า :</span></td>
										<td bgcolor="#311308"><input name="shopname" type="text" class="box_form" id="shopname" />
											<span style="color:#FC0">*</span> <input name="Check" type="button" id="Check" value="ตรวจสอบ / 查看" OnClick="JavaScript:SubmitContent();">
										</td>
									</tr>
									<tr>
										<td align="right" bgcolor="#311308" class="detail-text" id="detail-text">查商店名的结果 / ผลการตรวจชื่อร้านค้า :</td>
										<td bgcolor="#311308"><span id="myspan"></span></td>
									</tr>
									<tr>
										<td align="right" bgcolor="#311308" class="detail-text">商店详情 / รายละเอียดร้านค้า :</td>
										<td align="left" valign="top" bgcolor="#311308" style="height:25px;"><textarea name="welcome" cols="60" rows="5" id="welcome" style="overflow:hidden" placeholder="ตัวอย่างรายละเอียดร้านค้ารับเช่า ให้เช่า พระเครื่อง วัตถุมงคล เหรียญคณาจารย์ยอดนิยมทั่วไป โดยเฉพาะหลวงพ่อจิต วัดควนจง บริการท่านด้วยความซื่อสัตย์ และจริงใจ กับทุกเสียงทุกสายที่โทรเข้ามา บริหารงานโดยคุณ......"></textarea></td>
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
									</tr>
									<tr>
										<td align="right" bgcolor="#311308" class="detail-text">如何保证产品 / การรับประกัน :</td>
										<td align="left" valign="top" bgcolor="#311308" style="height:25px;">
											<style type="text/css">
												.textcondition{
													height: 37px;
													text-align: center;
													width: 94px;
												}
												.table_condition{
													border-collapse: collapse;
												}
												.table_condition td{
													border: 1px rgb(80, 35, 29) solid;
												}
											</style>
											<table width="550" border="1" cellpadding="3" cellspacing="0" class="table_condition">
												<tr>
													<td width="20" rowspan="2"><input type="checkbox" value="1" name="warranty2"/></td>
													<td width="206"><span class="detail-text">รับประกันพระแท้ภายในระยะเวลา </span></td>
													<td colspan="2" rowspan="2" align="center"><span class="detail-text">
														<input name="warranty-detail1" type="text" id="warranty-detail1" class="textcondition" placeholder="เช่น / 如  365"/>
													วัน / 天</span>
												</td>
												<td width="149"><span class="detail-text"> นับแต่ลูกค้าได้รับพระไป</span></td>
											</tr>
											<tr>
												<td><span class="detail-text">保证真产品的期间内</span></td>
												<td><span class="detail-text">算当天开始领到产品</span></td>
											</tr>
											<tr>
												<td rowspan="4"><input type="checkbox" value="1" name="warranty3"/></td>
												<td><span class="detail-text">รับประกันความพอใจในระยะเวลา</span></td>
												<td colspan="2" rowspan="2" align="center"><span class="detail-text">
													<input name="warranty-detail2" type="text" id="warranty-detail2" class="textcondition" placeholder="เช่น / 如  15" />
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
												<input name="warranty-detail3" type="text" id="warranty-detail3" class="textcondition" placeholder="เช่น / 如  20"/>
											</span><span class="detail-text"> %</span>
										</td>
									</tr>
									<tr>
										<td colspan="2"><span class="detail-text">(意思是如领到后不满意) 但如超定期扣数目</span></td>
									</tr>
									<tr>
										<td rowspan="2"><input type="checkbox" value="1" name="warranty4" ></td>
										<td colspan="3"><span class="detail-text">พระต้องอยู่ในสภาพเดิม ไม่ชำรุดหักบิ่น เสียสภาพ ล้างผิว</span></td>
										<td>&nbsp;</td>
									</tr>
									<tr>
										<td colspan="3"><span class="detail-text">产品要保持原样 不残破 断 洗皮</span></td>
										<td>&nbsp;</td>
									</tr>
									<tr>
										<td rowspan="2"><input type="checkbox" value="1" name="warranty5"/></td>
										<td colspan="3"><span class="detail-text">ยินดีรับซื้อคืนในราคาตลาดขณะนั้น</span></td>
										<td>&nbsp;</td>
									</tr>
									<tr>
										<td colspan="3"><span class="detail-text">卖家满意买回当时产品的买卖价钱</span></td>
										<td>&nbsp;</td>
									</tr>
									<tr>
										<td rowspan="2"><input type="checkbox" value="1" name="warranty6"/></td>
										<td colspan="3"><span class="detail-text">นำมาแลกเปลี่ยน กับองค์ใหม่ได้ หากท่านต้องการซื้อพระองค์อื่นโดยหัก</span></td>
										<td rowspan="2"><span class="detail-text">
											<input name="warranty-detail4" type="text" id="warranty-detail4" class="textcondition" placeholder="เช่น / 如  20"/>
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
						<td align="right" bgcolor="#311308" class="detail-text">รับประกันเพิ่มเติม / 增加其它的保证方法 :</td>
						<td align="left" valign="top" bgcolor="#311308" style="height:25px;"><textarea name="warranty" cols="60"></textarea></td>
					</tr>
					<tr>
						<td align="right" bgcolor="#311308" class="detail-text">如何付款 / วิธีการชำระเงิน :</td>
						<td align="left" valign="top" bgcolor="#311308" style="height:25px;">
							<table width="593" border="0" align="left" cellpadding="3" cellspacing="0">
								<tr class="detail-text">
									<td width="170" height="30" align="right" class="detail-text">帐户名称 / ชื่อบัญชี :</td>
									<td colspan="3"><input name="bankacc1" type="text" id="bankacc1" style="width:200px" size="200" /></td>
								</tr>
								<tr>
									<td align="right" class="detail-text">银行 / ธนาคาร :</td>
									<td width="214"><input name="bankname1" type="text" id="bankname1" style="width:200px" /></td>
									<td width="35" align="right" class="detail-text">&nbsp;</td>
									<td width="202">&nbsp;</td>
								</tr>
								<tr>
									<td align="right" class="detail-text">分行 / สาขา :</td>
									<td><input name="bankbranch1" type="text" id="bankbranch1" style="width:200px" /></td>
									<td align="right" class="detail-text">&nbsp;</td>
									<td>&nbsp;</td>
								</tr>
								<tr>
									<td align="right" class="detail-text">帐户号码 / เลขที่บัญชี :</td>
									<td><input name="bankid1" type="text" id="bankid1" style="width:200px" /></td>
									<td>&nbsp;</td>
									<td>&nbsp;</td>
								</tr>
								<tr>
									<td align="right" class="detail-text">帐户分类 / ประเภทบัญชี :</td>
									<td colspan="3" class="detail-text"><input name="banktype1" type="radio"  value="1"/>
										节约 / ออมทรัพย์
										<input type="radio" name="banktype1" value="2"/>
										经常帐 /กระแสรายวัน
									</td>
								</tr>
								<tr>
									<td align="right" class="detail-text">其它帐户 / อื่น ๆ :</td>
									<td colspan="3" class="detail-text"><textarea name="bankinfo" id="bankinfo" style="width:420px; height:100px"></textarea></td>
								</tr>
							</table>
						</td>
					</tr>
					<tr>
						<td align="right" bgcolor="#311308" class="detail-text">Line ID :</td>
						<td align="left" valign="top" bgcolor="#311308" style="height:25px;">
							<input type="text" name="lineid">
						</td>
					</tr>
					<tr>
						<td align="right" bgcolor="#311308" class="detail-text">WeChat ID :</td>
						<td align="left" valign="top" bgcolor="#311308" style="height:25px;">
							<input type="text" name="wechat">
						</td>
					</tr>
					<tr>
						<td align="right" bgcolor="#311308" class="detail-text">传上复制的首页银行帐薄  / สำเนาหน้า book bank :</td>
						<td align="left" valign="top" bgcolor="#311308" style="height:25px;"><span style="color:#FC0">
							<input class="file1" name="file1" type="file" id="file1" />
						</span><span style="color:#FC0">必需与身份证的名字相同 </span><span style="color:#FF0000;font-weight:bold;font-size:10px;">/ ให้ตรงกับสำเนาบัตรประชาชน</span>
					</td>
				</tr>
				<tr>
					<td align="right" bgcolor="#311308" class="detail-text">传上复制的身份证卡 <br />
						/ สำเนาบัตรประชาชน :
					</td>
					<td align="left" valign="top" bgcolor="#311308" style="height:25px;"><span style="color:#FC0">
						<input class="file2" name="file2" type="file" id="file2" />
					</span><span style="color:#FF0000;font-weight:bold;font-size:10px;">*</span>
				</td>
			</tr>
			<tr>
				<td align="right" bgcolor="#311308" class="detail-text">帐号/บัญชี Paypal :</td>
				<td align="left" valign="top" bgcolor="#311308" style="height:25px;"><input name="paypal" type="text" id="paypal" style="width:200px" />
					&nbsp; <span style="color:red">** 如有注册 / ถ้ามี</span>
				</td>
			</tr>
			<tr>
				<td align="right" bgcolor="#311308" class="detail-text">คำถาม</td>
				<td align="left" valign="middle" bgcolor="#311308" style="height:25px;">
					<img id="inum1" title="<?=$_SESSION['ses_inum1']=rand(0,9)?>" src="images/digit/<?=$_SESSION['ses_inum1']?>.gif" />
					<img src="images/digit/plus.gif" /> 
					<img id="inum2" title="<?=$_SESSION['ses_inum2']=rand(0,9)?>" src="images/digit/<?=$_SESSION['ses_inum2']?>.gif" />               
					<img src="images/digit/equal.gif" />
					<input name="inum3" type="text" id="inum3"  title="board_require" style="margin:0px;padding:0px;height:25px;border:1px #CCCCCC outset;background-color:#F5F5F5;color:#FF9900;font-size:20px;font-weight:bold;text-align:center;width:30px;" size="3" maxlength="2" />
					<span style="color:#FC0">* 必需要填 </span><span style="color:#FF0000;font-weight:bold;font-size:10px;"> / จำเป็นต้องกรอก</span>    
				</td>
			</tr>
			<tr>
				<td bgcolor="#311308" id="detail-text">&nbsp;
				</td>
				<td bgcolor="#311308">
					<input name="Submit" type="submit" id="Submit" value="ลงทะเบียนเปิดร้าน /登计商店" />
				</td>
			</tr>
		</table>
	</form>
</td>
</tr>
</table>
</td>
</tr>
<tr>
	<td>&nbsp;</td>
</tr>
<tr>
	<td>&nbsp;</td>
</tr>
<tr>
	<td>
		<? include("footer.php");?> 
	</td>
</tr>
</table>
</body>
</html>
