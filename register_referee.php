<?php include("global.php"); 
	 include("global_counter.php");
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
			<?php include("index.css"); ?>
			<script language="JavaScript" type="text/javascript">
				function reg_fo()
				{
					 with(document.REG)
					 {
						  if (imgprofile.value == '')
						  {
								alert('กรุณากรอกข้อมูลให้ครบถ้วน / 必需把资料填完整');
								imgprofile.focus();
								return false;
						  }
						  if (mobile.value == '')
						  {
								alert('กรุณากรอกข้อมูลให้ครบถ้วน / 必需把资料填完整');
								mobile.focus();
								return false;
						  }
						  if (type.value == '')
						  {
								alert('กรุณากรอกข้อมูลให้ครบถ้วน / 必需把资料填完整');
								type.focus();
								return false;
						  }
						  if (email.value == '')
						  {
								alert('กรุณากรอกข้อมูลให้ครบถ้วน / 必需把资料填完整');
								email.focus();
								return false;
						  }
						  if (amuletuser.value == '')
						  {
								alert('กรุณากรอกข้อมูลให้ครบถ้วน / 必需把资料填完整');
								amuletuser.focus();
								return false;
						  }
						  if (amuletpass.value == '')
						  {
								alert('กรุณากรอกข้อมูลให้ครบถ้วน / 必需把资料填完整');
								amuletpass.focus();
								return false;
						  }
						  if ((amuletpass_confirm.value == '') || (amuletpass_confirm.value != amuletpass.value))
						  {
								alert('กรุณากรอกรหัสยืนยันให้ถูกต้อง / 必需把资料填完整');
								amuletpass_confirm.focus();
								return false;
						  }
					 }
				}

				function confirm_password(x_this)
				{
					 var v_this = x_this.val();
					 var v_password = $("#amuletpass").val();
					 if (v_password == v_this)
					 {
						  alert("ยืนยันรหัสผ่านถูกต้อง/确定密码正确");
					 }
				}     
			</script> 
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
												<table width="100%" cellpadding="0" cellspacing="0" border="0">
													 <tr>
															<!-- <td width="262" valign="top">
																left_search
															</td> -->
															<td style="padding-left:5px;padding-right:5px">
																 <table width="100%" border="0" cellspacing="0" cellpadding="0">
																		<tr>
																			 <td height="30" align="center" bgcolor="#FFCC00">
																					สมัครคณะกรรมการตรวจสอบพระเครื่อง
																			 </td>
																		</tr>
																		<tr>
																			 <td height="500" valign="top" bgcolor="#311407">
																					<form action="sent_regitmem.php" method="post" name="REG" id="REG" onsubmit="return reg_fo()" target="reg_frm" enctype="multipart/form-data">
																						 <table width="100%" border="0" cellspacing="0" cellpadding="3" style="color:#FC0">

																				                  <input type="hidden" name="type" value="3"/></td>
																								<tr>
																									 <td width="255" height="25" align="right">头像图片 / รูปโปรไฟล์ (Image profile):</td>
																									 <td width="333"><input name="file1" type="file" id="file1" /></td>
																								</tr>
																								<tr>
																									 <td width="255" height="25" align="right">传上复制的身份证卡 / สำเนาบัตรประชาชน:</td>
																									 <td width="333"><input class="file2" name="file2" type="file" id="file2" /></td>
																								</tr>                                                                                                
																								<tr>
																									 <td width="255" height="25" align="right">帐号 / ชื่อผู้ใช้ (Username):</td>
																									 <td width="333"><input name="amuletuser" type="text" id="amuletuser" /></td>
																								</tr>
																								<tr>
																									 <td height="25" align="right">密码 / รหัสผ่าน (password) :</td>
																									 <td><input name="amuletpass" type="password" id="amuletpass" /></td>
																								</tr>
																								<tr>
																									 <td height="25" align="right">确定密码 / ยืนยันรหัสผ่าน (confirm password) :</td>
																									 <td><input onkeyup="confirm_password($(this))" name="amuletpass_confirm" type="password" id="amuletpass_confirm" autocomplete="off"  /></td>
																								</tr>
																								<tr>
																									 <td height="25" align="right">店主名稱 / ชื่อ  :</td>
																									 <td><input name="name" type="text" id="name" /></td>
																								</tr>
																								<tr>
																									 <td height="25" align="right">地址 / ที่อยู่ :</td>
																									 <td>
                                                                                                      <textarea id="address" name="address" style="margin:0px; padding:0px; height:100px;"></textarea>
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
																									 <td height="25" align="right">国家 / ประเทศ :</td>
																									 <td>
																											<select name="country">
																												 <option value="0">--Select Country--</option>
																												 <option value="thai">Thailand</option>
																												 <option value="malay">Malaysia</option>
																												 <option value="singapore">Singaport</option>
																												 <option value="indonesia">Indonesia</option>
																												 <option value="china">China</option>
																												 <option value="taiwan">Taiwan</option>
																												 <option value="hongkong">Hongkong</option>
																											</select>
																									 </td>
																								</tr>
																								<tr>
																									 <td height="25" align="right">手提 / โทรศัพท์มือถือ :</td>
																									 <td><input name="mobile" type="text" id="mobile" style="width:200px" /></td>
																								</tr>
																								<tr>
																									 <td height="25" align="right">E-mail :</td>
																									 <td><input name="email" type="text" id="email" style="width:200px" placeholder="E-mail" /></td>
																								</tr>
																								<tr>
																									 <td height="25" align="right">Type :</td>
																									 <td>
																									 	<select name="typecontact">
																									 		<option value="line">Line ID</option>
																									 		<option value="wechat">Wechat ID</option>
																									 	</select>
																									 </td>
																								</tr>
																								<tr>
																									 <td height="25" align="right">Contact us :</td>
																									 <td><input name="contact" type="text" id="contact" style="width:200px" placeholder="Wechat ID / Line ID" /></td>
																								</tr>
																								<tr>
																									 <td align="right" bgcolor="#311308" >
																											คำถาม
																									 </td>
																									 <td align="left" valign="top" bgcolor="#311308" style="height:25px;">
																										<table border="0" cellpadding="0" align="left" cellspacing="0">
																											<tr>
																												<td>
																													<img id="inum1" title="<?=$_SESSION['ses_inum1']=rand(0,9)?>" src="images/digit/<?=$_SESSION['ses_inum1']?>.gif" />
																													<img src="images/digit/plus.gif" /> 
																													<img id="inum2" title="<?=$_SESSION['ses_inum2']=rand(0,9)?>" src="images/digit/<?=$_SESSION['ses_inum2']?>.gif" />               
																													<img src="images/digit/equal.gif" />
																												</td>
																												<td>
																													<input name="inum3" type="text" id="inum3"  title="board_require" style="margin:0px;padding:0px;height:20px;border:1px #CCCCCC outset;background-color:#F5F5F5;color:#FF9900;font-size:20px;font-weight:bold;text-align:center;width:30px;" size="3" maxlength="2" />
																													<span style="color:#FC0">* 必需要填 </span><span style="color:#FF0000;font-weight:bold;font-size:10px;"> / จำเป็นต้องกรอก</span>   
																												</td>
																											</tr>
																										</table>
																									 </td>
																								</tr>
																								<tr>
																									 <td height="25" align="right">&nbsp;</td>
																									 <td><input name="submit" type="submit" id="submit" value="Register" /></td>
																								</tr>
																						 </table>
																					</form>
																			 </td>
																		</tr>
																		<iframe src="" name="reg_frm" width="1px" height="0px" frameborder="0" id="reg_frm"></iframe> 
																 </table>
															</td>
													 </tr>
												</table>
										 </td>
									</tr>
							 </table>
						</td>
				 </tr>
                 <tr>
                 	<td height="30" bgcolor="#FFCC00" style="color:#000; line-height:20px" align="center">
                    	แจ้งลบ USER เดิม ติดต่อ ฝ่ายเทคนิค 074-262615
                    ID LINE : nongxxx , ID WECHAT : xxxjam<br />通知删除原来帐号 联系 +6674262615 ID LINE : feoy_feoy 微信号 Wechat :fei0850805804</td>
                 </tr>
				 <tr>
						<td>
							<? include('footer.php');?>
						</td>
				 </tr>
				 <tr>
						<td>
							 <!--BEGIN WEB STAT CODE-->
							 <script type="text/javascript" src="http://hits.truehits.in.th/data/t0031244.js"></script>
							 <noscript>
									<a target="_blank" href="http://truehits.net/stat.php?id=t0031244"><img src="http://hits.truehits.in.th/noscript.php?id=t0031244" alt="Thailand Web Stat" border="0" width="14" height="17" /></a>
									<a target="_blank" href="http://truehits.net/">Truehits.net</a>
							 </noscript>
							 <!-- END WEBSTAT CODE -->    
						</td>
				 </tr>
			</table>
	 </body>
</html>
