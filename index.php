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

	<!-- Facebook Shared Data -->

	<meta property="og:type" name="og:type" content="website" />

	<meta property="og:image" name="og:image" content="http://www.praasia.com/images/logo4face.png"/>

	<meta name="og:title" content="ศูนย์รวมพระเครื่องออนไลน์ พระเอเซียดอทคอม" />

	<meta name="og:description" content="亚洲佛牌网站 เว็บไซต์พระเครื่อง 2 ภาษาไทย-จีน" />

	<meta name="og:site_name" property="og:site_name" content="http://<?php echo $_SERVER['SERVER_NAME'];?>/index.php" />

	<meta name="og:url" content="http://<?php echo $_SERVER['SERVER_NAME'];?>/index.php"/>

	<div id="fb-root"></div>

	<script>(function(d, s, id) {

		var js, fjs = d.getElementsByTagName(s)[0];

		if (d.getElementById(id)) return;

		js = d.createElement(s); js.id = id;

		js.src = "//connect.facebook.net/th_TH/sdk.js#xfbml=1&appId=1426881710946031&version=v2.3";

		fjs.parentNode.insertBefore(js, fjs);

	}(document, 'script', 'facebook-jssdk'));</script>

	<!-- End Shared Data -->        

	<?php include("index.css"); ?>

	<!--jquery ui Local-->

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.10.0/themes/base/jquery-ui.min.css" integrity="sha512-mPnhAODPbMSDp488VzQCtGZD1PwY/uFNY56g6OwNMI3g4NposdbUHzKFC1BNml14Ai+XwHgoJSBAnt5a9RyJtA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.9.1/jquery.min.js" integrity="sha512-jGR1T3dQerLCSm/IGEGbndPwzszJBlKQ5Br9vuB0Pw2iyxOy+7AK+lJcCC8eaXyz/9du+bkCy4HXxByhxkHf+w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>     

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.10.0/jquery-ui.min.js" integrity="sha512-JXlkNyRSyOiD0Xs74MfO2rVQhB96EfRrdJQdp5ry48Tye3QqZVxs+M+hZU1s5PJ7YvOmxvF4jwfEaGxfNe6mPw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

	<!-- <script src="func/jquery-ui-1.10.3/jquery.transit.min.js"></script> -->

	<!--CKEditor-->

	<script src="chatbox_editor/ckeditor/ckeditor.js"></script>		<!-- Lightbox -->

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery.colorbox/1.4.31/example1/colorbox.min.css" integrity="sha512-qDmL8zJf49wqgbTQEr0nsThYpyQkjc+ulm2zAjRXd/MCoUBuvd19fP2ugx7dnxtvMOzSJ1weNdSE+jbSnA4eWw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.colorbox/1.4.31/jquery.colorbox-min.js" integrity="sha512-vIQFGcvtyG7utDhKtdtJB8gZLnFdQramGsSaRNQ7yNWAnvRYAks5H2IQgvXzR8xzaSeqdcss6ZrzebbHdLECLQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
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

		<!--

			<!--

			function MM_reloadPage(init) {  //reloads the window if Nav4 resized

				if (init==true) with (navigator) {if ((appName=="Netscape")&&(parseInt(appVersion)==4)) {

					document.MM_pgW=innerWidth; document.MM_pgH=innerHeight; onresize=MM_reloadPage; }}

					else if (innerWidth!=document.MM_pgW || innerHeight!=document.MM_pgH) location.reload();

				}

				MM_reloadPage(true);

			// -->

			

			function MM_timelinePlay(tmLnName, myID) { //v1.2

				//Copyright 1997 Macromedia, Inc. All rights reserved.

				var i, j, tmLn, props, keyFrm, sprite, numKeyFr, firstKeyFr, propNum, theObj, firstTime = false;

				if (document.MM_Time == null) MM_initTimelines(); //if *very* 1st time

				tmLn = document.MM_Time[tmLnName];

				if (myID == null) {

					myID = ++tmLn.ID;

					firstTime = true;

				} //if new call, incr ID

				if (myID == tmLn.ID) { //if Im newest

					setTimeout('MM_timelinePlay("' + tmLnName + '",' + myID + ')', tmLn.delay);

					fNew = ++tmLn.curFrame;

					for (i = 0; i < tmLn.length; i++) {

						sprite = tmLn[i];

						if (sprite.charAt(0) == 's') {

							if (sprite.obj) {

								numKeyFr = sprite.keyFrames.length;

								firstKeyFr = sprite.keyFrames[0];

									if (fNew >= firstKeyFr && fNew <= sprite.keyFrames[numKeyFr - 1]) { //in range

										keyFrm = 1;

										for (j = 0; j < sprite.values.length; j++) {

											props = sprite.values[j];

											if (numKeyFr != props.length) {

												if (props.prop2 == null) sprite.obj[props.prop] = props[fNew - firstKeyFr];

												else sprite.obj[props.prop2][props.prop] = props[fNew - firstKeyFr];

											} else {

												while (keyFrm < numKeyFr && fNew >= sprite.keyFrames[keyFrm]) keyFrm++;

												if (firstTime || fNew == sprite.keyFrames[keyFrm - 1]) {

													if (props.prop2 == null) sprite.obj[props.prop] = props[keyFrm - 1];

													else sprite.obj[props.prop2][props.prop] = props[keyFrm - 1];

												}

											}

										}

									}

								}

							} else if (sprite.charAt(0) == 'b' && fNew == sprite.frame) eval(sprite.value);

							if (fNew > tmLn.lastFrame) tmLn.ID = 0;

						}

					}

				}



			function MM_displayStatusMsg(msgStr) { //v1.0

				status=msgStr;

				document.MM_returnValue = true;

			}

			//-->

		</script>

		<SCRIPT language=JavaScript type=text/JavaScript>

			<!--

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



				function

			MM_openBrWindow(theURL,winName,features) { //v2.0

				window.open(theURL,winName,features);

			}

			//-->

			

		</SCRIPT>

	</head>

	<body>

		<div style="position:fixed; z-index:2; bottom:0px; width:100%; background:#663a08 url(images/bg_login.jpg) no-repeat center;">

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

								<input type="hidden" name="current_url" value="<?php echo $_SERVER['REQUEST_URI'];?>">

								<input type="hidden" name="click_login" value="login_index">

								<input name="Login" type="submit" id="Login" value="เข้าสู่ระบบ / 登录" /> 

								<input name="submit2" type="submit" id="submit2" value="ลืมรหัสผ่าน / 忘记密码" />

							</td>

						</tr>

					</table>

					<iframe src="" name="_self" width="1px" height="0px" frameborder="0" id="_self"></iframe> 

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

							<input type="hidden" name="current_url" value="<?php echo $_SERVER['REQUEST_URI'];?>">

							<a href="logout.php?url=<?php echo $_SERVER['REQUEST_URI'];?>" style="color:#fc0">ออกจากระบบ / 退出系统</a>

						</td>

					</tr>

				</table>

				<?php

			}

			?>

		</div>

		<table width="1000" border="0" align="center" cellpadding="0" cellspacing="0">

			

			<?php 

			$q="SELECT * FROM `banner` WHERE banner_pos = 'D' and banner_active = 'show' LIMIT 1 ";

			$bannerfestival= new nDB();

			echo	$bannerfestival->query($q);

			$bannerfestival->next_record();

			$total=$bannerfestival->num_rows();

			?>        

			<? if ($total > 0) { ?>    

				<tr>

					<td>

						<img src="img/banner/<?=$bannerfestival->f(banner_img)?>" width="1000"/>



					</td>

				</tr>

			<? } ?>

			<tr>

				<td>

					<img src="images/headpraasia.gif" width="1000" height="262" />

				</td>

			</tr>

			<tr>

				<td><? include('head.php') ?></td>

			</tr>

			<tr>

				<td height="397" valign="top" style="background:url(images/bgwelcome.jpg) no-repeat">

					<div style="color:#FFF; overflow-y:auto; overflow-x:hidden; height:270px; width:825px; margin-left:85px; margin-top:25px">

						<table width="820" border="0" align="center" cellpadding="5" cellspacing="0">

							<?php 

							$q="SELECT * FROM `news` WHERE 1 ";

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

			<tr>

				<td>

					<img src="images/index_banner_auction.gif" width="1000"/>

				</td>

			</tr>

			<tr>

				<td>

					<table width="1000" cellpadding="0" cellspacing="0">

						<tr>

							<td width="181">

								<table cellpadding="0" cellspacing="0" width="100%">

									<tr>

										<td>&nbsp;

										</td>

									</tr>

								</table>

							</td>

							<td>&nbsp;</td>

							<td>&nbsp;</td>

							<td></td>

						</tr>

					</table>

				</td>

			</tr>

			<tr>

				<td height="643" valign="top">

					<table cellpadding="0" cellspacing="0">



						<tr>

							<td>

								<? include('infoweb.php'); ?>

							</td>

						</tr>

						<tr>

							<td>

								<? include('catalog_index.php'); ?>

							</td>

						</tr>

						<tr>

							<td>

							</td>

						</tr>

					</table>

				</td>

			</tr>

			<tr>

			</tr>

			<!--Jewelry Content-->

			<!--  <tr>

			<td valign="top" style="background:url(images/bg-jewelry.png) no-repeat;" height="320">

			<table width="100%" border="0" cellspacing="0" cellpadding="0" style="margin-top:52px">

				<tr>

				<td align="center"><a href="http://www.meilijewelry.com/index.php"><img src="jewelry/images/banner-jewelry2.gif" width="970" height="242" border="0" /></a></td>

				</tr>

			</table>

			</td>

		</tr>-->

		<!--END Jewelry -->

		<tr>

			<td bgcolor="#FFFFFF">&nbsp;



			</td>

		</tr>

		<tr>

			<td height="50" colspan="2" align="center" bgcolor="#FFFFFF">

				<style type="text/css">

					.translate_button {

						color:#FFF;

						padding:5px;

						width:200px;

						height:35px;

						font-family:Tahoma;

						background-color:#fca909;

						cursor:pointer;

						z-index:1;

						-webkit-border-radius: 0px 0px 5px 5px;

						-moz-border-radius: 0px 0px 5px 5px;

						border-radius: 0px 0px 5px 5px;

						border-left:1px solid #c46104;

						border-top:1px solid #c46104;

						border-bottom:1px solid #c46104;

					}

				</style>

				<?

				if( $_SESSION["adminshop_id"] <> "" || isset($_SESSION["adminshop_id"]) ){  

					?>

					<div style="display:none;">

						<table border="0" cellpadding="0" cellspacing="0">

							<tr>

								<td>&nbsp;

								</td>

								<td style="color:#FC0;">

									<? include('bottom_panel.php'); ?>

								</td>

							</tr>

						</table>

					</div>

					<?

					$text_condition = 'onclick="translate_slide($(this));"';

				}else{

					$text_condition = "onclick=\"alert('สำหรับสมาชิกเท่านั้น / 限会员而已，必需先注册才能使用')\"";

				}

				?>

				<span style="cursor:pointer;" <?=$text_condition;?> isopen="0">

					<span class="translate_button" style="color:#F00" >

						คลิกสู่ระบบแปลภาษา/点击进入翻译系统... ▼

					</span>

					<span style="	display:none; color:#090" class="translate_button">

						คลิกเพื่อปิดระบบแปลภาษา/点击收回翻译系统... ▲

					</span>

				</span>

				<script>

					function translate_slide(x_this){

						var isopen = x_this.attr("isopen");

						if(isopen == "1"){

							x_this.attr("isopen","0");

							x_this.find("span:eq(0)").show();

							x_this.find("span:eq(1)").hide();

							x_this.prev().slideUp();

						}else{

							x_this.attr("isopen","1");

							x_this.find("span:eq(0)").hide();

							x_this.find("span:eq(1)").show();

							x_this.prev().slideDown();

						}

					}

				</script>

			</td>

		</tr>

		<tr>

			<td height="8" colspan="2" bgcolor="#FFFFFF" style="padding-left: 115px;padding-bottom: 20px; line-height: 20px;">

				<strong>วิธีการใช้แปลภาษาบนมือถือ</strong><br>

				1.ให้พิมพ์คำที่ต้องแปลแล้วก็อปปี้วาง<br>

				2.หากไม่ใช้วิธีเขียน ก็อปปี้คำที่ต้องการ แล้ววางในช่องแปลภาษา ให้กด Inter หนึ่งครั้ง ผลลัพธ์คำแปลจะปรากฎขึ้นมา จากนั้นให้ก็อปปี้คำแปลวางที่ต้องการใช้งาน<br>

				3.หากผลลัพธ์การแปลไม่ปรากฎคำ กรุณานำคำแปลมาใส่ในช่องฝาก จากนั้นคำที่ฝากแปลจะใช้งานได้ภายใน24ชั่วโมง

			</td>

		</tr>

		<tr>

			<td height="40" align="center" bgcolor="#333333">

				<?php include('footer.php');?>

			</td>

		</tr>

	</table>

	<table width="1000" height="40" align="center" border="0" cellpadding="0" cellspacing="0">

		<tr>

			<td align="center" valign="top" style="background:url(images/tab.jpg);">&nbsp;</td>

		</tr>

	</table>

</body>

</html>