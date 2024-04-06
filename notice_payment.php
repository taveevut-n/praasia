<?php
	include("global.php");
	include("global_counter.php");
	?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>亚洲佛牌网站 ศูนย์รวมพระเครื่องออนไลน์พระเอเซียดอทคอม</title>
		<META name=description content="ศนย์พระเครื่อง เปิดร้านพระออนไลน์" >
		<meta name="keywords" content="ศูนย์พระเครื่องภาคใต้, ศูนย์พระเครื่องภาคเหนือ, ศูนย์พระเครื่องกรุงเทพ, ศูนย์พระเครื่องอีสาน"/>
		<link rel="icon" href="/favicon.ico" type="image/x-icon" />
		<link rel="stylesheet" type="text/css" href="css/style_top.css">
		<?php include("index.css"); ?>
		<!--jquery ui Local-->
		<link rel="stylesheet" href="func/jquery-ui-1.10.3/themes/base/jquery-ui.css" />
		<script src="func/jquery-ui-1.10.3/jquery-1.9.1.js"></script>
		<script src="func/jquery-ui-1.10.3/ui/jquery-ui.js"></script>
		<script src="func/jquery-ui-1.10.3/jquery.transit.min.js"></script>
		<!--CKEditor-->
		<script src="chatbox_editor/ckeditor/ckeditor.js"></script>
		<!--Iswallows Loading-->
	<!-- 	<script src="http://iswallows.com/func/loading/loading.js"></script> -->
		<!-- Lightbox -->
		<link rel="stylesheet" href="colorbox.css"/>
		<script src="jquery.colorbox.js"></script>
		<script>
			$(document).ready(function(){
			
				$(".group1").colorbox({rel:'group1'});
				$(".group2").colorbox({rel:'group2', transition:"fade"});
				$(".group3").colorbox({rel:'group3', transition:"none", width:"75%", height:"75%"});
				$(".group4").colorbox({rel:'group4', slideshow:true});
				$(".ajax").colorbox();
				$(".youtube").colorbox({iframe:true, innerWidth:640, innerHeight:390});
				$(".vimeo").colorbox({iframe:true, innerWidth:500, innerHeight:409});
				$(".iframe").colorbox({iframe:true, width:"650", height:"500", scrolling:"false"});
				$(".inline").colorbox({inline:true, width:"50%"});
				$(".callbacks").colorbox({
					onOpen:function(){ /*alert('onOpen: colorbox is about to open');*/ },
					onLoad:function(){ /*alert('onLoad: colorbox has started to load the targeted content');*/ },
					onComplete:function(){ /*alert('onComplete: colorbox has displayed the loaded content');*/ },
					onCleanup:function(){ /*alert('onCleanup: colorbox has begun the close process');*/ },
					onClosed:function(){ /*alert('onClosed: colorbox has completely closed');*/ }
				});
			
				$('.non-retina').colorbox({rel:'group5', transition:'none'})
				$('.retina').colorbox({rel:'group5', transition:'none', retinaImage:true, retinaUrl:true});
			
				$("#click").click(function(){ 
					$('#click').css({"background-color":"#f00", "color":"#fff", "cursor":"inherit"}).text("Open this window again and this message will still be here.");
					return false;
				});
			
			});
			
		</script>
		<script language="JavaScript">
			function MM_reloadPage(init)
			{ //reloads the window if Nav4 resized
				if (init == true) with(navigator)
				{
					if ((appName == "Netscape") && (parseInt(appVersion) == 4))
					{
						document.MM_pgW = innerWidth;
						document.MM_pgH = innerHeight;
						onresize = MM_reloadPage;
					}
				}
				else if (innerWidth != document.MM_pgW || innerHeight != document.MM_pgH) location.reload();
			}
			MM_reloadPage(true);

			function MM_timelinePlay(tmLnName, myID)
			{ //v1.2
				//Copyright 1997 Macromedia, Inc. All rights reserved.
				var i, j, tmLn, props, keyFrm, sprite, numKeyFr, firstKeyFr, propNum, theObj, firstTime = false;
				if (document.MM_Time == null) MM_initTimelines(); //if *very* 1st time
				tmLn = document.MM_Time[tmLnName];
				if (myID == null)
				{
					myID = ++tmLn.ID;
					firstTime = true;
				} //if new call, incr ID
				if (myID == tmLn.ID)
				{ //if Im newest
					setTimeout('MM_timelinePlay("' + tmLnName + '",' + myID + ')', tmLn.delay);
					fNew = ++tmLn.curFrame;
					for (i = 0; i < tmLn.length; i++)
					{
						sprite = tmLn[i];
						if (sprite.charAt(0) == 's')
						{
							if (sprite.obj)
							{
								numKeyFr = sprite.keyFrames.length;
								firstKeyFr = sprite.keyFrames[0];
								if (fNew >= firstKeyFr && fNew <= sprite.keyFrames[numKeyFr - 1])
								{ //in range
									keyFrm = 1;
									for (j = 0; j < sprite.values.length; j++)
									{
										props = sprite.values[j];
										if (numKeyFr != props.length)
										{
											if (props.prop2 == null) sprite.obj[props.prop] = props[fNew - firstKeyFr];
											else sprite.obj[props.prop2][props.prop] = props[fNew - firstKeyFr];
										}
										else
										{
											while (keyFrm < numKeyFr && fNew >= sprite.keyFrames[keyFrm]) keyFrm++;
											if (firstTime || fNew == sprite.keyFrames[keyFrm - 1])
											{
												if (props.prop2 == null) sprite.obj[props.prop] = props[keyFrm - 1];
												else sprite.obj[props.prop2][props.prop] = props[keyFrm - 1];
											}
										}
									}
								}
							}
						}
						else if (sprite.charAt(0) == 'b' && fNew == sprite.frame) eval(sprite.value);
						if (fNew > tmLn.lastFrame) tmLn.ID = 0;
					}
				}
			}

			function MM_displayStatusMsg(msgStr)
			{ //v1.0
				status = msgStr;
				document.MM_returnValue = true;
			}
		</script>
		<script language=JavaScript type=text/JavaScript>
			function setHomePage(homepage,la_url_es) {
			 var agt=navigator.userAgent.toLowerCase();
			 var is_major = parseInt(navigator.appVersion);
			 var is_minor = parseFloat(navigator.appVersion);
			 var is_nav = ((agt.indexOf('mozilla')!=-1) && (agt.indexOf('spoofer')==-1)
			 && (agt.indexOf('compatible') == -1) && (agt.indexOf('opera')==-1)
			 && (agt.indexOf('webtv')==-1) && (agt.indexOf('hotjava')==-1));
			 var is_ie = ((agt.indexOf("msie") != -1) && (agt.indexOf("opera") == -1));
			 var is_ie3 = (is_ie && (is_major< 4));
			 var is_ie4 = (is_ie && (is_major == 4) && (agt.indexOf("msie 5")==-1) );
			 var is_ie4 = (is_ie && (is_major == 4) && (agt.indexOf("msie 5")==-1) && (agt.indexOf("msie 6")==-1));
			 var is_ie5up = (is_ie && !is_ie3 && !is_ie4);
			 var is_win = ( (agt.indexOf("win")!=-1) || (agt.indexOf("16bit")!=-1) );
			
			 if (is_win && is_ie5up) {
					oHomePage.style.behavior='url(#default#homepage)';
					oHomePage.setHomePage(homepage);
				}
			}
			
			function MM_openBrWindow(theURL,winName,features) { //v2.0
			 window.open(theURL,winName,features);
			}
		</script>
	</head>
	<body style="margin: 0 0 40px 0;">
		<table width="1000" border="0" align="center" cellpadding="0" cellspacing="0">
			<tr>
				<td>
					<img src="images/headpraasia.gif" width="1000" height="262" />
				</td>
			</tr>
			<tr>
				<td><? include('head.php') ?></td>
			</tr>
			<tr>
				<td bgcolor="#CCCCCC" style="height: 100%;">
					<?php
						if($_GET['howtopay']=="true"){
							require('howtopayment/howtopay.htm');
						}else{
							?>
								<table width="1000" border="0" align="center" cellpadding="0" cellspacing="0">
									<tr>
										<td>
											<table width="700" border="0" align="center" cellpadding="3" cellspacing="1">
												<tr>
													<td height="30" colspan="5" align="center" bgcolor="#FFCC00" style="font-size:16px; font-weight:bold">การชำระเงิน / 如何付款 <a href="?howtopay=true" target="_blank">คลิกดูวิธี / 点击看如何汇款</a></td>
												</tr>
												<tr>
													<td width="158" height="30" align="center" bgcolor="#DDDDDD"><strong>ธนาคาร <br />
														银行名称</strong>
													</td>
													<td width="154" align="center" bgcolor="#DDDDDD"><strong>สาขา <br />
														分行</strong>
													</td>
													<td width="118" align="center" bgcolor="#DDDDDD"><strong>ประเภทบัญชี <br />
														帐户类型</strong>
													</td>
													<td width="112" align="center" bgcolor="#DDDDDD"><strong>เลขที่บัญชี <br />
														帐户号码</strong>
													</td>
													<td width="122" align="center" bgcolor="#DDDDDD"><strong>ชื่อบัญชี <br />
														帐户名称</strong>
													</td>
												</tr>
												<tr>
													<td height="25" bgcolor="#EFEFEF"><img src="images/kbank.jpg" width="20" height="20" /> ธนาคารกสิกรไทย</td>
													<td bgcolor="#EFEFEF">สาขาโรบินสัน หาดใหญ่</td>
													<td bgcolor="#EFEFEF">ออมทรัพย์</td>
													<td bgcolor="#EFEFEF">992-211282-4</td>
													<td bgcolor="#EFEFEF">สำนักงานเว็บพระเอเซีย</td>
												</tr>
												<tr>
													<td height="25" bgcolor="#EFEFEF"> <img src="images/kbank.jpg" alt="" width="20" height="20" /> Kasikorn Bank</td>
													<td bgcolor="#EFEFEF">Robinson Hatyai Branch</td>
													<td bgcolor="#EFEFEF">Saving</td>
													<td bgcolor="#EFEFEF">992-211282-4</td>
													<td bgcolor="#EFEFEF">Office WebPraAsia</td>
												</tr>
												<tr>
													<td height="25" bgcolor="#f8f8f8"><img src="images/bbank.jpg" width="20" height="20" /> ธนาคารกรุงไทย</td>
													<td bgcolor="#f8f8f8">หาดใหญ่</td>
													<td bgcolor="#f8f8f8">ออมทรัพย์</td>
													<td bgcolor="#f8f8f8">902-059221-1</td>
													<td bgcolor="#f8f8f8">สำนักงานเว็บพระเอเซีย</td>
												</tr>
												<tr>
													<td height="25" bgcolor="#f8f8f8"><img src="images/bbank.jpg" alt="" width="20" height="20" /> Krungthai Bank</td>
													<td bgcolor="#f8f8f8">Hatyai</td>
													<td bgcolor="#f8f8f8">Saving</td>
													<td bgcolor="#f8f8f8">902-059221-1</td>
													<td bgcolor="#f8f8f8">Office WebPraAsia</td>
												</tr>
												<tr>
													<td height="25" bgcolor="#EFEFEF"><img src="images/scb.jpg" width="20" height="20" /> ธนาคารไทยพาณิชย์</td>
													<td bgcolor="#EFEFEF">สาขาหาดใหญ่</td>
													<td bgcolor="#EFEFEF">ออมทรัพย์</td>
													<td bgcolor="#EFEFEF">509-292513-5</td>
													<td bgcolor="#EFEFEF">สำนักงานเว็บพระเอเซีย</td>
												</tr>
												<tr>
													<td height="25" bgcolor="#EFEFEF"><img src="images/scb.jpg" alt="" width="20" height="20" /> Siam Commercial Bank</td>
													<td bgcolor="#EFEFEF">Hatyai Branch</td>
													<td bgcolor="#EFEFEF">Saving</td>
													<td bgcolor="#EFEFEF">509-292513-5</td>
													<td bgcolor="#EFEFEF">Office WebPraAsia</td>
												</tr>
												<tr>
													<td height="25" bgcolor="#EFEFEF">中国 : 农业银行美兰分行</td>
													<td bgcolor="#EFEFEF">中国/จีน</td>
													<td bgcolor="#EFEFEF">Saving</td>
													<td bgcolor="#EFEFEF">6228480158093888077 </td>
													<td bgcolor="#EFEFEF">林声富</td>
												</tr>
												<tr>
													<td height="25" bgcolor="#EFEFEF">Maybank</td>
													<td bgcolor="#EFEFEF">马来西亚/มาเลเซีย</td>
													<td bgcolor="#EFEFEF">Saving</td>
													<td bgcolor="#EFEFEF">114543060445</td>
													<td bgcolor="#EFEFEF">Ting Ping Chiew</td>
												</tr>
												<tr>
													<td height="25" bgcolor="#EFEFEF">大众银行</td>
													<td bgcolor="#EFEFEF">马来西亚/มาเลเซีย</td>
													<td bgcolor="#EFEFEF">Saving</td>
													<td bgcolor="#EFEFEF">4622764912</td>
													<td bgcolor="#EFEFEF">Choo  Siaw  Ling </td>
												</tr> 
												<tr>
													<td height="25" bgcolor="#EFEFEF">DBS bank</td>
													<td bgcolor="#EFEFEF">星加坡/สิงคโปร์</td>
													<td bgcolor="#EFEFEF">Saving</td>
													<td bgcolor="#EFEFEF">011-0-033449</td>
													<td bgcolor="#EFEFEF">Andy Ng</td>
												</tr>
                                                <tr>
													<td height="25" bgcolor="#EFEFEF">第一銀行</td>
													<td bgcolor="#EFEFEF">麻豆分行/ไต้หวัน</td>
													<td bgcolor="#EFEFEF">Saving</td>
													<td bgcolor="#EFEFEF">007 62268076001</td>
													<td bgcolor="#EFEFEF">黃茂哲</td>                                                    
                                                </tr>                                                                                                                                                                                              
												<tr>
													<td height="30" colspan="5" align="center">
														<form method="post" action="https://www.paypal.com/cgi-bin/webscr">
															Paypal Payment :
															<input type="hidden" name="cmd" value="_xclick">
															<input type="hidden" name="business" value="meilihair@msn.com">
															<input type="hidden" name="item_name" value="">
															<input type="hidden" name="item_number" value="">
															<input type="hidden" name="shipping" value="">
															<input type="hidden" name="shipping2" value="">
															<input type="hidden" name="handling" value="">
															<input type="hidden" name="currency_code" value="">
															<input type="hidden" name="return" value="http://www.praasia.com/index.php">
															<input type="hidden" name="undefined_quantity" value="1">
															<input type="hidden" name="lc" value="TH">
															<input type="image" src="http://www.paypalobjects.com/en_US/i/btn/x-click-but23.gif" border="0" name="submit" width="68" height="23" alt="ชำระเงินด้วย PayPal - รวดเร็ว ฟรี และปลอดภัย">
														</form>
													</td>
												</tr>
											</table>
										</td>
									</tr>
								</table>
								<?php
									if($_SESSION['adminshop_id'] != '' || isset($_SESSION['adminshop_id'])) {  
								?>	
								<form id="notice_payment" action="send_noticepayment.php" method="post" enctype="multipart/form-data">
									<table width="700" align="center" cellpadding="3" cellspacing="0" style="font-size:12px">
										<tr>
											<td height="30" colspan="2" align="center" bgcolor="#FFCC00" style="font-size:14px; font-weight:bold">แจ้งชำระเงิน /  通知付款</td>
										</tr>
										<tr>
											<td width="205" align="right"> เลขที่ใบชำระ / 注册单编号	 :</td>
											<td width="481"><input name="orderid" type="text" id="orderid" value="<?=$_GET['order'];?>"/></td>
										</tr>
										<tr>
											<td align="right">ธนาคารที่โอน / 如何汇款 :</td>
											<td>
												<select name="bank" id="bank">
													<option value="1" selected="selected">ธนาคารกสิกรไทย (Kasikorn Bank) </option>
													<option value="2">ธนาคารกรุงไทย (Krungthai Bank) </option>
													<option value="3">ธนาคารไทยพาณิชย์ (Siam Commercial Bank) </option>
													<option value="4">Paypal </option>
													<option value="5">ชำระที่ศูยน์ / 在网站服务中心支付</option>
													<option value="6">อื่นๆ / 其它</option>
												</select>
											</td>
										</tr>
										<tr>
											<td align="right">หลักฐานการชำระเงิน / 汇款件单 :</td>
											<td><input name="file1" type="file" id="file1" /></td>
										</tr>
										<tr>
											<td>&nbsp;</td>
											<td><input name="Submit" type="submit" id="Submit" value="แจ้งการชำระเงิน / 通知付款" /></td>
										</tr>
									</table>
								</form>
								<?
									}else{
										?>
									<table width="700" align="center" cellpadding="3" cellspacing="0" style="font-size:12px">
										<tr>
											<td height="30" align="center">
												<h3 style="line-height: 25px;">
													หากต้องการแจ้งชำระเงิน ผ่านหน้าเว็บ โปรดทำการ<a href="index.php"> เข้าสู่ระบบ </a>ก่อนครับ<br/>
													通知付款必需登录系统后才能通知(在 ระบบจัดการร้านค้า / 商店系统编辑区里面)
												</h3>
											</td>
										</tr>
									</table>
										<?
									}
								?>
							<?
						}
					?>
					
				</td>
			</tr>
		</table>
		</td>
		</tr>
		</table>
		<table width="1000" align="center" border="0" cellpadding="0" cellspacing="0">
			<tr>
				<td>
					<?php include('footer.php');?>
				</td>
			</tr>
		</table>
		<div style="bottom:0px; width:100%; background:#663a08 url(images/bg_login.jpg) no-repeat center;">
			<?php
				if( $_SESSION['adminshop_id'] == '' || !isset($_SESSION['adminshop_id']) ){
				?>
			<form action="chk_login.php" method="post" name="REG" target="_self" id="REG">
				<table width="1000px" height="40px" align="center" border="0" cellspacing="0" cellpadding="0">
					<tr>
						<td width="225">
							<input type="text" name="username" class="buddy_txt" placeholder="username" style="width:200px" />
						</td>
						<td width="212">
							<input type="password" name="password" class="buddy_txt" placeholder="password" style="width:200px" />
						</td>
						<td width="231" style="white-space:nowrap;">
							<input name="remember" id="remember" type="checkbox"/>
							<label for="remember" style="color:#fc0;">
							จำการเข้าสู่ระบบ / 记住密码
							</label>
						</td>
						<td width="332">
							<input name="Login" type="submit" id="Login" value="เข้าสู่ระบบ / 登录" /> 
							<input name="submit2" type="submit" id="submit2" value="ลืมรหัสผ่าน / 忘记密码" />
						</td>
					</tr>
				</table>
			</form>
			<?php
				}else{
					$q="SELECT * FROM `member` WHERE id = '".$_SESSION['adminshop_id']."' ";
					$dbshop= new nDB();
					$dbshop->query($q);
					$dbshop->next_record();
				?>
			<table width="1000px" height="40px" style="color:#fc0;" align="center" border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td>
						ยินดีต้อนรับคุณ /欢迎光临 : <?=$dbshop->f(name)?>
					</td>
					<td>
						<a href="backend.php" style="color:#fc0; font-size:14px;">
						ระบบจัดการร้านค้า / 商店系统编辑区
						</a>
					</td>
					<td style="white-space:nowrap;">
						<a href="shop_index.php?shop=<?=$dbshop->f(id)?>" style="color:#fc0; font-size:14px;">เข้าสู่หน้าร้านค้า / 进入首页商店</a>
					</td>
					<td>
						<a href="logout.php" style="color:#fc0">ออกจากระบบ / 退出系统</a>
					</td>
				</tr>
			</table>
			<?php
				}
				?>
		</div>
	</body>
	<script>		
		$( "#notice_payment" ).submit(function( event ) {
			if ( $( "#orderid" ).val() == "" ) {
				alert('กรุณากรอกข้อมูลให้ครบถ้วน / 必需把资料填完整');
				$( "#orderid" ).focus();
				return false;
			}else if ( $( "#file1" ).val() == "" ) {
				alert('กรุณากรอกข้อมูลให้ครบถ้วน / 必需把资料填完整');
				$( "#file1" ).focus();
				return false;
			}else{
				return true;
			}
		});
	</script>
</html>
