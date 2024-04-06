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
		<!--jquery ui Local-->
		<link rel="stylesheet" href="func/jquery-ui-1.10.3/themes/base/jquery-ui.css" />
		<script src="func/jquery-ui-1.10.3/jquery-1.9.1.js"></script>
		<script src="func/jquery-ui-1.10.3/ui/jquery-ui.js"></script>
		<!--Iswallows CKEditor-->
		<script src="http://iswallows.com/func/ckeditor/ckeditor.js"></script>
		<style type="text/css">
			.dropdown_td {
				padding-left:10px;
				padding-right:10px;
				padding-top:5px;
				padding-bottom:5px;
				white-space:nowrap;
				color:#444444;
				background-color:#ffffff;
				border:1px solid #e1e1e1;
				cursor:pointer;
			}
			.dropdown_td:hover {
				background-color:#f5f5f5;
			}
			.member {
				float:left;
				margin:5px;
				white-space:nowrap;
				background-color:#70d0ec;
				-webkit-border-radius:5px;
				-moz-border-radius:5px;
				border-radius:5px;
				-webkit-box-shadow: inset rgba(0,0,0,0.5) 0px 0px 5px;
				-moz-box-shadow: inset rgba(0,0,0,0.5) 0px 0px 5px;
				box-shadow: inset rgba(0,0,0,0.5) 0px 0px 5px;
			}
			.member .member_name {
				padding:5px;
				padding-left:10px;
				padding-right:0px;
				color:#444444;
				cursor:default;
			}
			.member .member_remove {
				padding:5px;
				padding-left:10px;
				padding-right:10px;
				color:#444444;
				cursor:pointer;
			}
			.member .member_remove:hover {
				color:#ff0000;
			}
			.pm_table {
				border-collapse:collapse;
			}
			.pm_tr {
				background-color:#eee;
				cursor:pointer;
			}
			.pm_tr:hover {
				background-color:#3c2d20;
			}
			.tb_chat{
				border-collapse: collapse;
			}
			.tb_chat td{
				padding: 0px 4px 0px 0px;
			}
		</style>
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
				function dropdown_remove(x_this){
					x_this.parent().parent().parent().parent().remove();
				}
				function dropdown_search(x_this){
					var v = x_this.val();
					if(v != ""){
						$.ajax({
							type: "POST",
							url: "backend_query.php",
							data: { do_what:"pm_member_search", v:v },
							cache: false,
							success: function(result){
								$(".dropdown_container").html(result);
							}
						});
					}else{
						$(".dropdown_container").html("");
					}
				}
				function dropdown_select(x_this){
					var id = x_this.attr("attr_id");
					var name = $.trim(x_this.html());
					$(".receiver_container").append("<div class='member'><input name='member[]' value='"+id+"' type='hidden'/><table border='0' cellpadding='0' cellspacing='0'><tr><td class='member_name'>"+name+"</td><td class='member_remove' onclick='dropdown_remove($(this))'>x</td></tr></table></div>");
					$(".dropdown_container").html("");
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
								<? include('listshop.php'); ?>
							</td>
						</tr>
						<tr>
							<td style="background:url(images/bg.jpg) repeat-y;">
								<table width="100%" cellpadding="0" cellspacing="0" border="0">
									<tr>
										<!-- <td width="262" valign="top">
											left_search
										</td> -->
										<td style="padding-left:5px;padding-right:5px">
														<?php
															$db_member = new nDB();
															$db_member->query("select * from member where id = '".$_GET['member_id']."'");
															$db_member->next_record();
															?>                                        
											<table width="100%" border="0" cellspacing="0" cellpadding="0">
                                            
                                 <tr>
                                    	<td height="50" align="center" bgcolor="#FFCC00" style="font-size:18px">
                                        <a href="check_certificate_doc.php?username=<?=$db_member->f(username)?>" target="_blank"><span style="color:#930; font-size:18px">ตรวจสอบการออกบัตรรับรองของคุณ / 检查自己的鉴定项目资料</span></a>
                                        </td>
                                  </tr>
                                  <? if ($_GET['member_id']== $_SESSION['member_id']) { ?>
                                  <tr>
                                  	<td height="50" align="center" style="font-size:18px; background-color:#060">
                                    	<a href="regis_policy.php?member=<?=$_GET['member_id']?>" target="_blank" style="color:#000">ฉันต้องการเปิดร้านค้า / 我要开店</a>
                                    </td>
                                  </tr>
                                  <tr>
                                  	<td height="50" align="center" style="font-size:18px; background-color:#F60">
                                    	<a href="call.php" target="_blank" style="color:#000">แจ้งชำระเงินสมาชิกทั่วไป หรือ VIP และ แก้ไขข้อมูล Profine ,ข้อมูลส่วนตัว <br /> 通知普通会员 VIP 会员付款或修改 Profine, 个人资料</a>
                                    </td>
                                  </tr>
                                  <tr>
                                  	<td height="50" align="center" style="font-size:18px; background-color:#09F; color:#000">
                                    	<a href="content_referee.php?id=<?=$_GET['member_id']?>" target="_blank" style="color:#000">เพิ่มรายสายตรงจากคณะกรรมการ/增加我专业佛牌鉴定项目</a>
                                    </td>
                                  </tr>                              
                                  <? } ?>
												<tr>
													<td height="30" align="center" bgcolor="#996600"style="font-weight:bold;font-size:13px;">
														ข้อมูลสมาชิก / 会员资料
													</td>
												</tr>
												<tr>
													<td valign="top" bgcolor="#311407">

														<table width="100%" border="0" cellspacing="0" cellpadding="0" style="color:#FC0;">
															<tr>
																<td height="25" align="right">
																	头像图片 / รูปประจำตัว : 
																</td>
																<td>
																	<img src="<?=($db_member->f(pic1)!="")?'img_profile/'.$db_member->f(pic1):"images/logodefault_general.jpg"?>" height="150px"/>
																</td>
															</tr>
															<tr>
																<td height="25" align="right">
																	店主名稱 / ชื่อ : 
																</td>
																<td>
																	<?=$db_member->f("name")?>
																</td>
															</tr>
															<tr>
																<td height="25" align="right">
																	地址 / ที่อยู่ : 
																</td>
																<td>
																	<?=$db_member->f("address")?>
																</td>
															</tr>
															<tr>
																<td height="25" align="right">
																	国家 / ประเทศ : 
																</td>
																<td>
																	<?=$db_member->f("country")?>
																</td>
															</tr>                                                            
															<tr>
																<td height="25" align="right">
																	手提 / โทรศัพท์มือถือ : 
																</td>
																<td>
																	<?=$db_member->f("mobile")?>
																</td>
															</tr>

															<tr>
																<td height="25" align="right">
																	E-mail : 
																</td>
																<td>
																	<?=$db_member->f("email")?>
																</td>
															</tr>
															<tr>
																<td height="25" align="right" style="border-bottom:2px solid #ffcc00;">
																	Contact us : 
																</td>
																<td style="border-bottom:2px solid #ffcc00;">
																	<?
																	$contactexplode = explode("/", $db_member->f("contact"));
																	if($contactexplode[0]=="line"){
																		echo "Line ID : ".$contactexplode[1];
																	}
																	else if($contactexplode[0]=="wechat"){
																		echo "Wechat ID : ".$contactexplode[1];
																	}
																	?>
																</td>
															</tr>
															<tr>
																<td height="25" align="right">
																	หมดอายุ : 
																</td>
																<td>
                                                                	<? if ($db_member->f(type)=='2') { ?>
                                                                    <? $member_expire = strtotime($db_member->f(member_expire))?> 
																	<?=date("d/m/Y",$member_expire)?>
                                                                    <? } else {?>
                                                                    ไม่มีวันหมดอายุ
                                                                    <? } ?>
																</td>
															</tr>        
														</table>
													</td>
												</tr>
												<tr>
													<td align="center" bgcolor="#FFCC00">&nbsp;
														
													</td>
												</tr>
												<?php
													if( ($_GET["member_id"] == $_SESSION["member_id"])){
													?>
												<tr>
													<td height="30" align="center" bgcolor="#FFCC00">
														<table width="100%" align="center" border="0" cellpadding="0" cellspacing="0">
															<tr>
																<td style="height:1px;">
																	<?php
																		include("backend_menutop_general.php");
																		?>
																</td>
															</tr>
															<tr>
																<td style="padding:1px; background-color:#eee">
																	<?
																		if($_GET['inbox'] == 1){
																			?>
																	<table width="100%" border="0" cellpadding="0" cellspacing="0">
																		<tr style="height:30px;">
																			<td style="padding-left:20px; padding-right:20px; width:1px; white-space:nowrap;">
																				จาก
																				/ 来自
																			</td>
																			<td style="padding-left:20px; padding-right:20px;">
																				ข้อความ
																				/ 信息
																			</td>
																			<td style="padding-left:20px; padding-right:20px; width:1px; white-space:nowrap;">
																				วันที่ได้รับ
																				/ 收件期间
																			</td>
																			<td style="padding-left:20px; padding-right:20px; width:1px; white-space:nowrap;text-align:cener;">
																				ตอบ
																				/ 回信息
																			</td>
																		</tr>
																		<?php
																			$str_message = "select * from twe_message msg 
																									left join member m on msg.sender_id = m.id 
																									where receiver_id = '".$_SESSION["member_id"]."' 
																									order by msg.message_id desc";
																			$q_message = mysql_query($str_message);
																			$index = 0;
																			while($message = mysql_fetch_array($q_message)){
																				if($message['type'] == 0){
													                			$text_link = 'onclick="window.location.href=\'shop_index.php?shop='.$message["sender_id"].'\'"';
																				}else if($message['type'] == 2){
													                			$text_link = 'onclick="window.location.href=\'member_profile.php?member_id='.$message["sender_id"].'\'"';
																				}
																			?>
																		<tr class="pm_tr" style="height:30px;">
																			<td style="padding-left:20px; padding-right:20px; white-space:nowrap;border-bottom: 1px rgb(214, 187, 187) dashed;" <?=$text_link;?>>
																				<?=$message["name"]?>
																			</td>
																			<td style="padding-left:20px; padding-right:20px;border-bottom: 1px rgb(214, 187, 187) dashed;" x_index="<?=$index?>" onclick="view_detail($(this));">
																				<?=substr($message["message"], 0, 100)?>
																			</td>
																			<td style="padding-left:20px; padding-right:20px; white-space:nowrap;border-bottom: 1px rgb(214, 187, 187) dashed;">
																				<?=date("d-m-Y", strtotime($message["create_date"]))?>
																			</td>
																			<td style="padding-left:20px; padding-right:20px; white-space:nowrap;text-align: center;border-bottom: 1px rgb(214, 187, 187) dashed;">
																				<a href="javascript:void(0);" onclick="window.location.href='member_profile.php?member_id=<?=$_GET['member_id']?>&v=<?=urlencode($message["name"])?>'"><img src="images/email_reply.png" border="0"></a>
																			</td>
																		</tr>
																		<tr class="pmdetail_tr" style="height:30px; display:none;">
																			<td>&nbsp;
																			</td>
																			<td colspan="2" style="padding-left:20px; padding-right:20px;">
																				<?=$message["message"]?>
																			</td>
																		</tr>
																		<?php
																			$index++;
																			}
																			?>
																	</table>
																	<?
																		}else if($_GET['send'] == 1){
																			?>
																	<table width="100%" border="0" cellpadding="0" cellspacing="0">
																		<tr style="height:30px;">
																			<td style="padding-left:20px; padding-right:20px; width:1px; white-space:nowrap;">
																				จาก
																				/ 来自
																			</td>
																			<td style="padding-left:20px; padding-right:20px;">
																				ข้อความ
																				/ 信息
																			</td>
																			<td style="padding-left:20px; padding-right:20px; width:1px; white-space:nowrap;">
																				วันที่ได้รับ
																				/ 收件期间
																			</td>
																		</tr>
																		<?php
																			$q_message = mysql_query("select * from twe_message msg left join member m on msg.sender_id = m.id where sender_id = '".$_SESSION["member_id"]."' order by msg.message_id desc");
																			while($message = mysql_fetch_array($q_message)){
																			?>
																		<tr class="pm_tr" onclick="$('.pmdetail_tr').hide();$(this).next().show();" style="height:30px;">
																			<td style="padding-left:20px; padding-right:20px; white-space:nowrap;">
																				<?=$message["shopname"]?>
																			</td>
																			<td style="padding-left:20px; padding-right:20px;">
																				<?=substr($message["message"], 0, 100)?>
																			</td>
																			<td style="padding-left:20px; padding-right:20px; white-space:nowrap;">
																				<?=date("d-m-Y", strtotime($message["create_date"]))?>
																			</td>
																		</tr>
																		<tr class="pmdetail_tr" style="height:30px; display:none;">
																			<td>&nbsp;
																			</td>
																			<td colspan="2" style="padding-left:20px; padding-right:20px;">
																				<?=$message["message"]?>
																			</td>
																		</tr>
																		<?php
																			}
																			?>
																	</table>
																	<?
																		}else{
																			?>
																		<table width="100%" border="0" cellpadding="0" cellspacing="0" align="center">
																			<tr style="height:30px;">
																				<td style="padding-left:20px; font-size:14px; background-color:#db4b00;">
																					ส่งข้อความ / 送信息
																				</td>
																			</tr>
																			<tr>
																				<td style="background-color:#7f6500;">
																					<form method="post" action="member_profile_query.php" target="message_add_frm">
																						<iframe src="" name="message_add_frm" width="1px" height="0px" frameborder="0" id="message_add_frm"></iframe> 
																						<input name="do_what" value="message_add" type="hidden"/>
																						<input name="member_id" value="<?=$_GET['member_id']?>" type="hidden"/>
																						<table width="100%" border="0" cellpadding="0" cellspacing="0" class="tb_chat">
																							<tr style="height:40px;">
																								<td style="padding-left:20px; padding-top:10px; width:1px; text-align:right; vertical-align:top; white-space:nowrap;">
																								<b>ชื่อผู้รับ / 收件人</b></td>
																								<td style="padding-left:10px; padding-right:10px; padding-top:10px; width:1px; vertical-align:top;"> : </td>
																								<td style="padding-top:5px; vertical-align:top;" colspan="3">
																									<table border="0" cellpadding="0" cellspacing="0">
																										<tr>
																											<td>
																												<?
																													if($_GET['v']){
																												?>
																											<input style="width:569px;" type="text" value="<?=urldecode($_GET["v"])?>" readonly />
																												<?
																												}else{
																													?>
																											<input style="width:569px;" type="text" onkeyup="dropdown_search($(this));" />
																													<?
																												}
																												?>
																											<div class="dropdown_outer" style="position:relative; z-index:2;">
																												<?
																												if($_GET['v']){
																													$v = urldecode($_GET["v"]);
																													$member = new nDB();
																													$member->query("select * from member where name = '$v'");
																													$n_member = $member->num_rows();
																													$member->next_record();
																													if($n_member > 0){
																													?>
																												<input name='member[]' value='<?=$member->f('id')?>' type='hidden'/>
																													<?
																													}
																												}else{
																														?>
																												<div class="dropdown_container" style="position:absolute;"></div>
																												<?
																												}
																												?>
																											</div>
																											</td>
																										</tr>
																										<tr>
																											<td>
																												<div class="receiver_container" style="position:relative;"> </div>
																											</td>
																										</tr>
																									</table>
																								</td>
																							</tr>
																							<?
																							if($_GET['v']){
																								?>
																							<tr style="height:30px;">
																								<td style="padding-left:20px; width:1px; text-align:right; vertical-align:middle; white-space:nowrap;"><b>จากประเทศ / 国家</b></td>
																								<td style="padding-left:10px; vertical-align:middle; padding-right:10px; width:1px;"> : </td>
																								<td><?=$member->f('country')?></td>
																							</tr>
																							<?
																								}
																								?>
																							<tr style="height:30px;">
																								<td style="padding-left:20px; width:1px; text-align:right; vertical-align:top; white-space:nowrap;"><b>ข้อความ / 信息</b></td>
																								<td style="padding-left:10px; vertical-align:top; padding-right:10px; width:1px;"> : </td>
																								<td colspan="3">
																									<div style="width:575px; position:relative; z-index:1;">
																										<textarea id="message" name="message"></textarea>
																									</div>
																									<script>
																										CKEDITOR.replace("message");
																									</script>
																								</td>
																							</tr>
																							<tr style="height:30px;">
																								<td style="padding-left:20px; width:1px; text-align:right; white-space:nowrap;"><b>แปลภาษา / 翻译</b></td>
																								<td style="padding-left:10px; padding-right:10px; width:1px;"> : </td>
																								<td>
																									<style>
																										.translated_td {
																											padding-left:10px;
																											padding-right:10px;
																											height:30px;
																											color:#ffcc00;
																											background-color:#444444;
																											white-space:nowrap;
																											cursor:pointer;
																										}
																										.translated_td:hover {
																											background-color:#555555;
																										}
																										.translated_container {
																											position:absolute;
																											left:0px;
																											top:0px;
																										}
																									</style>
																									<script>
																										function translated_select(v){
																											var current_value = CKEDITOR.instances["message"].getData();
																											CKEDITOR.instances["message"].setData( current_value+" "+v );
																											$(".translated_container").html("");
																											$(".translate_textbox").val("");
																										}
																										function translate_text(x_this){
																											var v = $.trim(x_this.val());
																											$.ajax({
																												type: "POST",
																												url: "shop_chatbox_query.php",
																												data: { do_what:"translate", v:v },
																												cache: false,
																												success: function(result){
																													$(".translated_container").html(result);
																												}
																											});
																										}
																									</script>
																									<input class="textbox_flat translate_textbox" style="width:221px;" onkeyup="translate_text($(this));" type="text"/>
																									<div style="position:relative; left:0px; top:0px;">
																										<div class="translated_container"></div>
																									</div>
																								</td>
																								<td align="right"><input class="shoppm_text shoppm_translateleave_textbox" placeholder="ใส่คำที่ฝากแปล" type="text"/></td>
																								<td style="width:1px;padding-right: 7px;"><input class="shoppmleave_submit" onclick="shoppm_translate_leave();" value="ฝากแปลภาษา / 存录为了帮我翻译" type="button"/></td>
																							</tr>
																							<tr style="height:40px;">
																								<td style="padding-left:20px; width:1px; white-space:nowrap;"></td>
																								<td style="padding-left:10px; padding-right:10px; width:1px;"></td>
																								<td align="center" colspan="3"><input value="ยืนยันการส่งข้อความ / 发送" type="submit"/></td>
																							</tr>
																						</table>
																					</form>
																				</td>
																			</tr>
																		</table>
																			<?
																		}
																		?>
																</td>
															</tr>
															<tr>
																<td>
																	<? include('chatbox_message.php'); ?>
																</td>
															</tr>
														</table>
													</td>
												</tr>
												<?
													}
													?>
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
			<tr>
				<td align="center">
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
	<script type="text/javascript">
		function view_detail(x_this){
			var index = x_this.attr("x_index");
			$(".pmdetail_tr").hide();
			$(".pm_tr:eq("+index+")").next().show();
		}
	</script>
</html>
