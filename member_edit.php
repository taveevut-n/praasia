<?php
	include("global.php");
	set_page($s_page,$e_page=282);
	?>
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
			function reg_fo(){
			with(document.REG){
									if($(".file1").val() == ''){
											alert('กรุณาเลือกไฟล์สำเนา book bank / 请传上复制帳簿资料(手机照也可以)');
											file1.focus();
											return false;
									}	
									/*if($(".file2").val() == ''){
											alert('กรุณาเลือกไฟล์สำเนาบัตรประชาชน / 请传上复制身份证资料(手机照也可以)');
											file2.focus();
											return false;
									}*/
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
							}
					}
			function confirm_password(x_this){
			var v_this = x_this.val();
			var v_password = $("#amuletpass").val();
			if(v_password == v_this){
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
						<td style="background:url(images/bg.jpg) repeat-y; padding-left:5px">
						<table width="100%" cellpadding="0" cellspacing="0" border="0">
							<tr>
								<td width="250" valign="top">
									<table width="100%" cellpadding="0" cellspacing="0">
									<tr>
										<td>
											<table width="100%" cellpadding="0" cellspacing="0" border="0">
												<tr>
												<td align="center" style="background:url(images/bh-newshop.png) no-repeat ; padding-top:4px"><span style="color:#391700; font-size:14px; font-weight:bold">ค้นหาพระเครื่อง / 搜索商品</span></td>
												</tr>
												<tr>
												<td align="right">
													<table width="234" border="0" cellspacing="0" cellpadding="0">
														<tr>
															<td height="200" style="background:url(images/bg-stats.png) repeat-y; padding-top:3px" valign="top" >
															<form class="search_product_form" action="search_product.php" method="post" name="form5">
																<table width="100%" border="0" cellspacing="0" cellpadding="3" style="color:#FC0">
																	<?php
																		$conn = mysql_connect("localhost","prathai_new","twe31219#");
																		mysql_select_db("prathai_new",$conn);
																		mysql_query("SET NAMES UTF8");
																		mysql_query("SET character_set_results=utf8");
																		mysql_query("SET character_set_client=utf8");
																		mysql_query("SET character_set_connection=utf8");
																		?>
																	<script>
																		function select_geo(x_this){
																		var v_this = x_this.val();
																		$(".province_select option:eq(0)").prop("selected","selected");
																		$(".catalog_select option:eq(0)").prop("selected","selected");
																		$(".province_select").find(".province_option").remove();
																		$(".province_select").append( $(".province_option_container").find(".province_"+v_this).clone(true) );
																		}
																		function select_province(x_this){
																		var v_this = x_this.val();
																		$(".catalog_select option:eq(0)").prop("selected","selected");
																		$(".catalog_select").find(".catalog_option").remove();
																		$(".catalog_select").append( $(".catalog_option_container").find(".catalog_"+v_this).clone(true) );
																		}
																	</script>
																	<tr>
																		<td colspan="2" align="right">
																		<select onchange="select_geo($(this))" name="geo" style="width:200px">
																			<option value="0">
																				เลือกภาค / 选部
																			</option>
																			<?php
																				$q = mysql_query("select * from geo order by geo_id asc");
																				while($r = mysql_fetch_array($q)){
																				?>
																			<option value="<?=$r["geo_id"]?>">
																				<?=$r["geo_name"]?>
																			</option>
																			<?php
																				}
																				?>
																		</select>
																		</td>
																	</tr>
																	<tr>
																		<td colspan="2" align="right">
																		<div class="province_option_container" style="display:none;">
																			<?php
																				$q = mysql_query("select * from province order by province_id asc");
																				while($r = mysql_fetch_array($q)){
																				?>
																			<option class="province_option province_<?=$r["geo_id"]?>" value="<?=$r["province_id"]?>">
																				<?=$r["province_name"]?>
																			</option>
																			<?php
																				}
																				?>
																		</div>
																		<select onchange="select_province($(this))" class="province_select" name="province" style="width:200px">
																			<option value="0">
																				เลือกจังหวัด / 选府
																			</option>
																		</select>
																		</td>
																	</tr>
																	<tr>
																		<td colspan="2" align="right">
																		<div class="catalog_option_container" style="display:none;">
																			<?
																				$q="SELECT * FROM catalog order by catalog_id asc";
																				$dbcatalog= new nDB();	
																				$dbcatalog->query($q);
																				while($dbcatalog->next_record()) {
																				?>
																			<option class="catalog_option catalog_<?=$dbcatalog->f(province_id)?>" value="<?=$dbcatalog->f(catalog_id)?>">
																				<?=$dbcatalog->f(catalog_name)?>
																			</option>
																			<?php
																				}
																				?>
																		</div>
																		<select class="catalog_select" onchange="$('.search_product_form').submit();" name="catalog" style="width:200px;">
																			<option value="0">
																				เลือกรุ่นพระเครื่อง / 选佛牌分类
																			</option>
																		</select>
																		</td>
																	</tr>
																	<tr>
																		<td colspan="2" align="right" style="padding-right:3px"><input type="text" name="q" style="width:210px" placeholder="พิมพ์ชื่อสินค้าหรือ ID สินค้า.." /></td>
																	</tr>
																	<tr>
																		<td width="41%">&nbsp;</td>
																		<td width="59%"><input name="searchpra" type="submit" id="searchpra" value="Search" /></td>
																	</tr>
																	<tr>
																		<td height="20" colspan="2" style="padding-left:15px"><a href="catalog_all.php" target="_blank"><span style="color:#FC0">ค้นหาตามหมวดพระเครื่องทั้งหมด</span></a></td>
																	</tr>
																	<tr>
																		<td height="25" colspan="2" style="padding-left:15px">
																		<table width="100%" border="0" cellspacing="0" cellpadding="3">
																			<tr>
																				<td width="20"><img src="images/wait.png" width="20" height="20" /></td>
																				<td width="184"><a href="warn_product.php" target="_blank"><span style="color:#FC0">สินค้าวัดใจ</span></a></td>
																			</tr>
																			<tr>
																				<td><img src="images/ok.png" width="20" height="20" /></td>
																				<td><a href="recommend_product.php" target="_blank"><span style="color:#FC0">สินค้าแนะนำ</span></a></td>
																			</tr>
																		</table>
																		</td>
																	</tr>
																</table>
															</form>
															</td>
														</tr>
														<tr>
															<td><img src="images/bt-stats.png" width="234" height="25" /></td>
														</tr>
													</table>
												</td>
												</tr>
											</table>
										</td>
									</tr>
									<?php
										$q="SELECT * FROM `catalog_all` WHERE top_id = 0 ORDER BY catalog_id";
										static $v=1;
										$db->query($q);
										while($db->next_record()){
										?>
									<tr>
										<td>
											<table width="100%" border="0" cellspacing="0" cellpadding="0">
												<tr>
												<td width="260" height="37" align="left" valign="top" style="background:url(images/bh-newshop.png) no-repeat ; padding-top:4px"><span style="color:#391700; font-size:14px; font-weight:bold; padding-left:25px">หมวด <?=$v?> : <?=$db->f(catalog_name)?></span></td>
												</tr>
												<tr>
												<td align="right" valign="top" style="padding-right:2px">
													<table width="234" border="0" cellspacing="0" cellpadding="0">
														<tr>
															<td style="background:url(images/bg-stats.png) repeat-y;" valign="top">
															<table width="95%" border="0" align="center" cellpadding="3" cellspacing="0">
																<?php  
																	$q1="SELECT * FROM `catalog_all` WHERE top_id = '".$db->f(catalog_id)."' ORDER BY catalog_id  ";
																	$db5=new nDB();
																	$db5->query($q1);
																	$t=1;
																	if($db5->num_rows()!=0){
																	
																	while($db5->next_record()){
																	?>
																<tr>
																	<td height="20" style="border-bottom:1px solid #220b00"><a href="search_product.php?pra=<?=$db5->f(catalog_id)?>"><span style="color:#FC0"><?=$t?>. <?=$db5->f(catalog_name)?></a></td>
																</tr>
																<?php $t++; ?>
																<?php } } ?>
															</table>
															</td>
														</tr>
														<tr>
															<td><img src="images/bt-stats.png" width="234" height="25" /></td>
														</tr>
													</table>
												</td>
												</tr>
											</table>
										</td>
									</tr>
									<?php } ?>
									</table>
								</td>
								<td valign="top" style="padding-left:20px">
									<table width="95%" border="0" cellspacing="0" cellpadding="0">
									<tr>
										<td height="30" align="center" bgcolor="#FFCC00">
											ข้อมูลสมาชิก / 会员资料
										</td>
									</tr>
									<tr>
										<td height="500" valign="top" bgcolor="#311407">
											<?php
												$do_what = $_POST["do_what"];
												
												if($do_what == "member_edit_submit"){
												
													$member_id = $_POST["member_id"];
													$name = $_POST["name"];
													$country = $_POST["country"];
													$mobile = $_POST["mobile"];
													$email = $_POST["email"];
													$contact = $_POST['typecontact'].'/'.$_POST['contact'];
													$db->query("update member 
																		set name = '$name', 
																				country = '$country', 
																				mobile = '$mobile', 
																				email = '$email', 
																				contact = '$contact' 
																		where id = '$member_id'");
													$db->query($q);
													for($mf=1;$mf<=4;$mf++){
														$upf[$mf] = uppic($_FILES['file'.$mf],$mf,"img_profile/",$_POST['h_pic'.$mf]); // Same folder
														if($upf[$mf]!=''){
															$q = "UPDATE `member` SET `pic$mf` = '".$upf[$mf]."' WHERE `id` =".$member_id." ";
															$db->query($q);
														}
													}												
												}
												
												$db_member = new nDB();
												$db_member->query("select * from member where id = '".$_POST["member_id"]."'");
												$db_member->next_record();
												
												?>
											<form action="member_edit.php" method="post" target="_self" enctype="multipart/form-data">
												<input name="do_what" value="member_edit_submit" type="hidden"/>
												<input name="member_id" value="<?=$_POST['member_id']?>" type="hidden"/>
												<input name="h_pic" value="<?=$db_member->f('img_profile')?>" type="hidden"/>
												<table width="100%" border="0" cellspacing="0" cellpadding="0" style="color:#FC0;">
												<tr>
													<td height="25" align="right">
														头像图片 / รูปประจำตัว : 
													</td>
													<td>
														<input name="file1" type="file">
														<input type="hidden" name="h_pic" value="<?=$db_member->f("pic1")?>" />
														<span style="font-weight:bold">กว้าง 宽度180 x 180 pixels</span>
													</td>
												</tr>
												<tr>
                                                    <td height="25" align="right">&nbsp;
                                                    </td>
                                                    <td>
                                                        <img src="img_profile/<?=$db_member->f('pic1')?>" height="150px"/>
                                                    </td>                                                
                                                </tr>                                                
												<tr>
													<td height="25" align="right">
														传上复制的身份证卡 / สำเนาบัตรประชาชน: : 
													</td>
													<td>
														<input class="file2" name="file2" type="file" id="file2" />
														<input type="hidden" name="h_pic" value="<?=$db_member->f("pic2")?>" />
														<span style="font-weight:bold">กว้าง 宽度180 x 180 pixels</span>
													</td>
												</tr>                                                
												<td height="25" align="right">&nbsp;
												</td>
												<td>
													<img src="img_profile/<?=$db_member->f('pic2')?>" height="150px"/>
												</td>
												</tr>
												<tr>
													<td height="25" align="right">
														店主名稱 / ชื่อ : 
													</td>
													<td>
														<input name="name" value="<?=$db_member->f("name")?>" type="text"/>
													</td>
												</tr>
												<tr>
													<td height="25" align="right">
														地址 / ที่อยู่ : 
													</td>
													<td>
														<select name="country">
															<option value="0">--Select Country--</option>
															<option value="thai" <?php if( $db_member->f("country") == "thai" ){ echo "selected='selected'"; } ?> >Thailand</option>
															<option value="malay" <?php if( $db_member->f("country") == "malay" ){ echo "selected='selected'"; } ?>>Malaysia</option>
															<option value="singapore" <?php if( $db_member->f("country") == "singapore" ){ echo "selected='selected'"; } ?>>Singaport</option>
															<option value="indonesia" <?php if( $db_member->f("country") == "indonesia" ){ echo "selected='selected'"; } ?>>Indonesia</option>
															<option value="china" <?php if( $db_member->f("country") == "china" ){ echo "selected='selected'"; } ?>>China</option>
															<option value="taiwan" <?php if( $db_member->f("country") == "taiwan" ){ echo "selected='selected'"; } ?>>Taiwan</option>
															<option value="hongkong" <?php if( $db_member->f("country") == "hongkong" ){ echo "selected='selected'"; } ?>>Hongkong</option>
														</select>
													</td>
												</tr>
												<tr>
													<td height="25" align="right">
														手提 / โทรศัพท์มือถือ : 
													</td>
													<td>
														<input name="mobile" value="<?=$db_member->f("mobile")?>" type="text"/>
													</td>
												</tr>
												<tr>
													<td height="25" align="right">
														E-mail : 
													</td>
													<td>
														<input name="email" value="<?=$db_member->f("email")?>" type="text"/>
													</td>
												</tr>
												<tr>
													 <td height="25" align="right">Type :</td>
													 <td>
													 	<?
													 	$contactexplode = explode("/", $db_member->f("contact"));
													 	?>
													 	<select name="typecontact">
													 		<option value="line" <? if($contactexplode[0]=="line"){echo "selected";}?> >Line ID</option>
													 		<option value="wechat" <? if($contactexplode[0]=="wechat"){echo "selected";}?> >Wechat ID</option>
													 	</select>
													 </td>
												</tr>
												<tr>
													<td height="25" align="right" style="border-bottom:2px solid #ffcc00;">
														Contact us : 
													</td>
													<td style="border-bottom:2px solid #ffcc00;">
														<input name="contact" value="<?=$contactexplode[1]?>" type="text"/>
													</td>
												</tr>
												<tr>
													<td height="25" align="right">&nbsp;
													</td>
													<td>
														<input type="submit" value="แก้ไขข้อมูล / 增改信息" />
													</td>
												</tr>
												</table>
											</form>
										</td>
									</tr>
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
			<td>
				<? include('footer.php');?>
			</td>
			</tr>
		</table>
	</body>
</html>
