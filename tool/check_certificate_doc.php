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
		<script src="http://iswallows.com/func/loading/loading.js"></script>
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
					<a href="logout.php" style="color:#fc0">ออกจากระบบ / 退出系统</a>
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
						$bannerfestival->query($q);
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
            <? if ($_GET['username']) { 
				$_SESSION['certdoc_username'] = $_GET['username'];
			}
			?>
                                    <tr>
                                    	<td height="50" align="center" bgcolor="#FFCC00" style="font-size:18px">
                                        <span style="color:#930; font-size:18px">รายการการออกบัตรรับรองของ <?=$_SESSION['certdoc_username']?></span></a>
                                        </td>
                                  </tr> 
          <tr>
            	<td bgcolor="#D4B684">
                    <table width="100%" border="1" cellspacing="0" cellpadding="3" bordercolor="#3d2602" style="border-collapse:collapse;color:#FFF">
                      <tr>
                        <td width="17%" height="30" align="center" bgcolor="#3d2602">รูปภาพ</td>
                        <td width="18%" height="30" align="center" bgcolor="#3d2602">เลขที่เอกสาร</td>
                        <td width="15%" align="center" bgcolor="#3d2602">จำนวนรายการพระ</td>
                        <td width="21%" align="center" bgcolor="#3d2602">วันที่ Update ข้อมูลล่าสุด</td>
                        <td width="13%" align="center" bgcolor="#3d2602">สถานะ</td>
                        <td width="16%" align="center" bgcolor="#3d2602">ดูรายการพระในเอกสาร</td>
                      </tr>
						  <?php 
						  	$q="SELECT * FROM `certificate_doc` WHERE certdoc_username = '".$_SESSION['certdoc_username']."' ORDER BY certdoc_id DESC";
							$db->query($q);
							static $v=1;
							while($db->next_record()){
							$timestamp = strtotime($db->f(certdoc_update));
								
						  	$q="SELECT * FROM `cert` WHERE certdoc_id = '".$db->f(certdoc_id)."' ORDER BY cert_id DESC";
							$amulet= new nDB();
							$amulet->query($q);
							$amulet->next_record();	
							$num_rows = $amulet->num_rows();
														
						  ?>                      
                      <tr style="color:#3d2602">
                        <td align="center"><a href="/img/certificate_doc/<?=$db->f(pic1)?>" target="_blank"><img src="../slir/w100-h100/img/certificate_doc/<?=$db->f(pic1)?>" width="60" height="86" border="0" /></a></td>
                        <td align="center"><?=$db->f(certdoc_code)?></td>
                        <td align="center"><?=$num_rows?></td>
                        <td align="center"><?=date("d/m/Y",$timestamp)?></td>
                        <td align="center">
							<? if ($db->f(certdoc_status)=='0') { ?>
                            ได้รับแล้ว
                            <? } ?>
							<? if ($db->f(certdoc_status)=='1') { ?>
                            กำลังตรวจสอบ
                            <? } ?>
							<? if ($db->f(certdoc_status)=='2') { ?>
                            ส่งคืนแล้ว
                            <? } ?>	                        
                        </td>
                        <td align="center"><a href="view_certificate.php?id=<?=$db->f(certdoc_id)?>" target="_blank"><img src="images/view-icon.png" width="20" height="11" border="0" /></a></td>
                      </tr>
                      	<? } ?>
                    </table>
            </td>
            </tr>
			<tr>
				<td height="40" align="center" bgcolor="#333333">
					<?php include('footer.php');?>
				</td>
			</tr>
		</table>
	</body>
</html>