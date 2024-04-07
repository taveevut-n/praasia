<?php 
	include("global.php"); 
	include("global_counter.php");
	?>
<?php
	if ($_GET['product_id']) {
		$_SESSION['product_id']=$_GET['product_id']; 
		$product_id = $_SESSION['product_id'];
	}
	$q="UPDATE `product` SET `view_num` = `view_num`+1 WHERE `product_id` ='".$_SESSION['product_id']."' ";
	$db->query($q);
	$q="SELECT * FROM `product` WHERE product_id ='".$_SESSION['product_id']."' ";
	$dbproduct= new nDB(); 
	$dbproduct->query($q);
	$dbproduct->next_record();
	$checktime = strtotime($dbproduct->f(created));
	$nowtime = time();
	$showcontact = ($nowtime-$checktime);

	$num_rows = $dbproduct->num_rows();
	$q="SELECT * FROM `member` WHERE id= '".$dbproduct->f(shop_id)."' ";
	$dbshop= new nDB();  
	$dbshop->query($q);
	$dbshop->next_record();
	$timestamp = strtotime($dbshop->f(shop_date));
	$timestampexpire = $dbshop->f(date_expire);
	$timestampextend = $dbshop->f(date_extend);    
	$arrival = strtotime($dbshop->f(shop_date));
	$_SESSION['shop_id'] = $dbshop->f(id);
	?>
    <? if ($showcontact > 7200) {
	$show = 'show';
	}
	?>
    <? if ($showcontact < 7200) {
	$show = 'close';
	}
	?>    
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
		<title><?=$dbproduct->f(name)?>ร้าน<?=$dbshop->f(shopname)?>:: ศูนย์พระเครื่องพระเอเซีย 亚洲佛牌网站</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta name="keywords" content="<?=$dbproduct->f(name)?><?=$dbproduct->f(product_keyword)?>">
		<link rel="shortcut icon" href="favicon.ico" />
		<link rel="favicon" href="favicon.ico" />

		<!-- Facebook Shared Data -->
		<meta property="og:type" name="og:type" content="website" />
		<meta property="og:image" name="og:image" content="http://<?php echo $_SERVER['SERVER_NAME'];?>/resize/w200/img/amulet/<?php echo $dbproduct->f(pic1);?>"/>
		<meta property="og:image" content="http://<?php echo $_SERVER['SERVER_NAME'];?>/resize/w200/img/amulet/<?php echo $dbproduct->f(pic1);?>" />
		<meta name="og:title" content="<?php echo $dbproduct->f(name)?>" />
		<meta name="og:description" content="<?php echo $dbproduct->f(name)?>" />
		<meta name="og:site_name" property="og:site_name" content="http://<?php echo $_SERVER['SERVER_NAME'];?>/shop_product.php?product_id=<?php echo $dbproduct->f(product_id)?>" />
		<meta name="og:url" content="http://<?php echo $_SERVER['SERVER_NAME'];?>/shop_product.php?product_id=<?php echo $dbproduct->f(product_id)?>"/>
		<div id="fb-root"></div>
		<script>(function(d, s, id) {
		  var js, fjs = d.getElementsByTagName(s)[0];
		  if (d.getElementById(id)) return;
		  js = d.createElement(s); js.id = id;
		  js.src = "//connect.facebook.net/th_TH/sdk.js#xfbml=1&appId=1426881710946031&version=v2.3";
		  fjs.parentNode.insertBefore(js, fjs);
		}(document, 'script', 'facebook-jssdk'));</script>
		<!-- End Shared Data -->

		<link rel="stylesheet" type="text/css" href="css/style_top.css">
		<style type="text/css">
			body {
				background-color: #000;
				/*background-image: url(images/bg.jpg);*/
				background-position: top center;
				background-repeat: no-repeat;
			}
			body, td, th {
				font-family: Arial, Helvetica, sans-serif;
				font-size: 12px;
			}
			a:link {
				text-decoration: none;
			}
			a:visited {
				text-decoration: none;
				color: #000;
			}
			a:hover {
				text-decoration: none;
			}
			a:active {
				text-decoration: none;
				color: #000;
			}
			.btn-send {
				background-color: #FFFFFF;
				width: 100%;
				color: #000;
				border: 1px solid #FC0;
				margin-bottom: 3px;
			}
			.btn-send:hover {
				background-color: #090;
				width: 100%;
				color: #FFF;
				border: 1px solid #FC0;
				margin-bottom: 3px;
			}
		</style>
		
		<!--jquery ui Local-->
		<link rel="stylesheet" href="func/jquery-ui-1.10.3/themes/base/jquery-ui.css" />
		<script src="func/jquery-ui-1.10.3/jquery-1.9.1.js"></script>
		<script src="func/jquery-ui-1.10.3/ui/jquery-ui.js"></script>
		<script src="func/jquery-ui-1.10.3/jquery.transit.min.js"></script>
		<!--CKEditor-->
		<script src="chatbox_editor/ckeditor/ckeditor.js"></script>
		<!--Iswallows Loading-->
		<!-- <script src="http://iswallows.com/func/loading/loading.js"></script> -->

    <script src="Scripts/swfobject.js" type="text/javascript"></script>
	</head>
	<body bgcolor="#FFFFFF" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">

	<?php
		// Backlist
		if($dbshop->f(backlist) == "1"){
			?>
			<div id='swl_loading' style='background-color:#e1e1e1;position:fixed; z-index:100000; left:0px; top:0px; width:100%; height:100%;opacity: 0.7;'></div>
			<div  style='position:fixed; z-index:100000; left:0px; top:0px; width:100%; height:100%;'>
				<table width='100%' height='100%' border='0' cellpadding='0' cellspacing='0'>
					<tr>
						<td style='text-align:center; vertical-align:middle;'>
							<div style="
							    margin: 0 auto;
							    background: #D42D2D;
							    padding: 15px 30px;
							    font-size: 16px;
							    color: #fff;
							    display: inline-block;
							    border: 2px #6E1515 solid;
							">
								ร้านค้านี้ระงับการซื้อขายชั่วคราว
							</div>
						</td>
					</tr>
				</table>
			</div>
			<?php
		}
	?>
	
		<!-- Save for Web Slices (???????.jpg) -->
		<table width="1000" border="0" align="center" cellpadding="0" cellspacing="0" id="Table_01">
			<tr>
			<td>
				<table width="1000" border="0" cellpadding="0" cellspacing="0">
					<?php $chk=substr($dbshop->f(head1),-3); ?>
					<?php if($chk=="jpg" || $chk=="gif" or $chk=="png"){ ?>
					<tr>
						<td colspan="7" align="left" valign="top" height="255"><img src="img/head/<?=$dbshop->f(head1)?>" width="1000" height="350"></td>
					</tr>
					<?php } ?>
					<?php if($chk=="swf"){ 
						?>
					<tr>
						<td colspan="8" align="left" valign="top">
						<object id="FlashID" classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" width="1000" height="255">
							<param name="movie" value="img/head/<?=$dbshop->f(head1)?>" />
							<param name="quality" value="high" />
							<param name="wmode" value="opaque" />
							<param name="swfversion" value="8.0.35.0" />
							<!-- This param tag prompts users with Flash Player 6.0 r65 and higher to download the latest version of Flash Player. Delete it if you don't want users to see the prompt. -->
							<param name="expressinstall" value="../Scripts/expressInstall.swf" />
							<!-- Next object tag is for non-IE browsers. So hide it from IE using IECC. --> 
							<!--[if !IE]>-->
							<object type="application/x-shockwave-flash" data="img/head/<?=$dbshop->f(head1)?>" width="1000" height="255">
								<!--<![endif]-->
								<param name="quality" value="high" />
								<param name="wmode" value="opaque" />
								<param name="swfversion" value="8.0.35.0" />
								<param name="expressinstall" value="../Scripts/expressInstall.swf" />
								<!-- The browser displays the following alternative content for users with Flash Player 6.0 and older. -->
								<div>
									<h4>Content on this page requires a newer version of Adobe Flash Player.</h4>
									<p><a href="http://www.adobe.com/go/getflashplayer"><img src="http://www.adobe.com/images/shared/download_buttons/get_flash_player.gif" alt="Get Adobe Flash player" width="112" height="33" /></a></p>
								</div>
								<!--[if !IE]>-->
							</object>
							<!--<![endif]-->
						</object>
						</td>
					</tr>
					<?php } ?>
				</table>
			</td>
			</tr>
			<tr>
			<td height="45" style="background:url(images/menu.jpg) no-repeat">
				<table width="995" border="0" align="center" cellpadding="0" cellspacing="0">
					<tr>
						<td width="232" align="left"><a href="index.php"><span style="color:#000; font-weight:bold">หน้าแรกพระเอเซีย / 首页亚洲网</span></a></td>
						<td width="224" align="center"><a href="shop_index.php?shop=<?=$dbshop->f(id)?>"><span style="color:#000; font-weight:bold">เข้าสู่ร้านค้า/进入商店</span></a></td>
						<td width="158" align="center"><a href="show_product.php?shop=<?=$dbshop->f(id)?>"><span style="color:#000; font-weight:bold">สินค้าในร้าน / 本店产品</span></a></td>
						<td width="381" align="right">
						<table width="380" border="0" cellspacing="0" cellpadding="3">
							<form action="show_search.php" method="post" name="search" target="_parent" id="search">
								<tr>
									<td width="194" align="right"><span style="color:#000; font-weight:bold">ค้นหาพระเครื่อง / 搜索聖物:</span></td>
									<td width="105" align="center"><input name="q" id="q" size="13" /></td>
									<td width="63" align="center"><input name="search" type="submit" id="search" value="search" /></td>
								</tr>
							</form>
						</table>
						</td>
					</tr>
				</table>
			</td>
			</tr>
			<tr>
				<td style="background: url(images/bt-menu.jpg);height: 40px;text-align: right;padding-right: 10px;">
					<div class="fb-share-button" data-href="http://<?php echo $_SERVER['SERVER_NAME'];?>/shop_product.php?product_id=<?php echo $dbproduct->f(product_id)?>" data-layout="button_count"></div>
				</td>
			</tr>
			<?php if ($dbproduct->f(active)=='2') { ?>
				<tr>
			<td>
				<table width="100%" border="0" cellspacing="0" cellpadding="0">
					<tr>
						<td height="30" align="center"><span style="font-size:18; color:#FFF; font-weight:bold; padding:5px">
						<?=$dbproduct->f(name)?>
						</span>
						</td>
					</tr>
					<tr>
						<td style="padding-top:7px">
						<table width="100%" border="0" align="center" cellpadding="10" cellspacing="0">
							<tr>
								<td style=" text-align:center; color:#FFF; font-size:14px;border: 1px #fff solid;"><?=$dbproduct->f(detail)?></td>
							</tr>
						</table>
						</td>
					</tr>
					<tr>
						<td>&nbsp;</td>
					</tr>
					<tr>
						<td align="center" style="border: 1px #fff solid;">
						<table width="100%" border="0" cellspacing="0" cellpadding="5">
							<!-- <tr>
								<td align="center"><img src="<?=($dbproduct->f(pic1)!="")?"/resize/w900/img/amulet/".$dbproduct->f(pic1):"images/clear.gif"?>" alt="<?=$dbproduct->f(name)?>" /></td>
							</tr>
							<tr>
								<td align="center"><img src="<?=($dbproduct->f(pic2)!="")?"/resize/w900/img/amulet/".$dbproduct->f(pic2):"images/clear.gif"?>" alt="<?=$dbproduct->f(name)?>" /></td>
							</tr>
							<tr>
								<td align="center"><img src="<?=($dbproduct->f(pic3)!="")?"/resize/w900/img/amulet/".$dbproduct->f(pic3):"images/clear.gif"?>" alt="<?=$dbproduct->f(name)?>" /></td>
							</tr>
							<tr>
								<td align="center"><img src="<?=($dbproduct->f(pic4)!="")?"/resize/w900/img/amulet/".$dbproduct->f(pic4):"images/clear.gif"?>" alt="<?=$dbproduct->f(name)?>" /></td>
							</tr> -->

							<tr>
								<td align="center"><img src="<?=($dbproduct->f(pic1)!="")?"/img/amulet/".$dbproduct->f(pic1):"images/clear.gif"?>" alt="<?=$dbproduct->f(name)?>" style="max-width: 900px;" /></td>
							</tr>
							<tr>
								<td align="center"><img src="<?=($dbproduct->f(pic2)!="")?"/img/amulet/".$dbproduct->f(pic2):"images/clear.gif"?>" alt="<?=$dbproduct->f(name)?>" style="max-width: 900px;" /></td>
							</tr>
							<tr>
								<td align="center"><img src="<?=($dbproduct->f(pic3)!="")?"/img/amulet/".$dbproduct->f(pic3):"images/clear.gif"?>" alt="<?=$dbproduct->f(name)?>" style="max-width: 900px;" /></td>
							</tr>
							<tr>
								<td align="center"><img src="<?=($dbproduct->f(pic4)!="")?"/img/amulet/".$dbproduct->f(pic4):"images/clear.gif"?>" alt="<?=$dbproduct->f(name)?>" style="max-width: 900px;" /></td>
							</tr>
						</table>
						</td>
					</tr>
					<tr>
						<td>&nbsp;</td>
					</tr>
					<tr>
						<td>
						<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
							<tr>
								<td height="30" colspan="2" bgcolor="#3d2000"><span style="color:#FFF; font-size:16px">รายละเอียดพระเครื่อง /产品详容</span></td>
							</tr>							
							<tr>
								<td height="30" colspan="2" bgcolor="#3d2000" align="center" style="line-height: 25px;">

									<span style="color:#FFF; font-size:14px">
										ผู้ช่วยสื่อสาร การซื้อขายระหว่างประเทศ / 通信助理国际贸易<br/>
										
                                        (Line ID : <span style="color:green;">tee99999999</span> | WeChat ID : <span style="color:green;">Tee899999</span>)  <br/><br/>
									</span>

									<span style="color:#FFF; font-size:14px">
									พูดเขียนภาษาต่างประเทศไม่เป็นไม่เป็นไร เราเป็นสื่อให้ แค่คุณก๊อปปี๊ [Link สีแดง / 连接] ข้างล่างนี้ส่งมาที่ ผู้ช่วยสื่อสาร การซื้อขายระหว่างประเทศ <br/>
									(Line ID : <span style="color:green;">tee99999999</span> | WeChat ID : <span style="color:green;">Tee899999</span>) เราจะสื่อสารให้ครับ<br/><br/>

									想购请圣物但不会泰语没问题， 只要您把以下红色的 [Link / 连接] 复制， 送到 通信助理国际贸易 :<br/>
									(Line ID : <span style="color:green;">tee99999999</span> | WeChat ID : <span style="color:green;">Tee899999</span>) 里， 加为好友 一定会帮得了您
									</span>

								</td>
							</tr>
							<?php if($dbproduct->f(warning)==1) { ?>
							<tr>
								<td height="60" colspan="2" bgcolor="#FFCC00">
									<table width="100%" border="0" cellspacing="0" cellpadding="0">
									<tr>
										<td width="5%" align="center"><img src="images/wait.png" width="24" height="24"></td>
										<td width="95%">สินค้าชิ้นนี้วัดใจ กรุณาตรวจสอบพระเครื่องชิ้นนี้ให้แน่ชัดก่อนทำการซื้อ</td>
									</tr>
									</table>
								</td>
							</tr>
							<?php }?>
							<?php
								$conn = mysql_connect("localhost","prathai_new","twe31219#");
								mysql_select_db("prathai_new",$conn);
								mysql_query("SET NAMES UTF8");
								mysql_query("SET character_set_results=utf8");
								mysql_query("SET character_set_client=utf8");
								mysql_query("SET character_set_connection=utf8");
								?>
							<?php
								$r = mysql_fetch_array(mysql_query("select * from member m left join member_package p on m.package_id = p.package_id where m.id = '".$dbshop->f(id)."'"));
								$n = mysql_num_rows(mysql_query("select * from product where shop_id = '".$dbshop->f(id)."'"));
								?>
							<tr>
								<td width="23%" height="25" align="right" bgcolor="#FFFFCC"><span style="color:#000; font-weight:bold">Copy Link / 复制连接 :</span></td>
								<td width="59%" bgcolor="#FFFFCC"><span style="color:red; font-weight:bold">http://www.praasia.com/shop_product.php?product_id=<?=$dbproduct->f(product_id)?>
									</span>
								</td>
							</tr>
							<tr>
								<td width="23%" height="25" align="right" bgcolor="#FFFFCC"><span style="color:#000; font-weight:bold">ID สินค้า / ID 商品 :</span></td>
								<td width="59%" bgcolor="#FFFFCC">
                                
									<span style="color:red; font-weight:bold">
										<?=$dbproduct->f(product_id)?>
									</span>
									&nbsp;| <strong>Line ID :</strong><span style="color:green;"> <?=$dbshop->f(lineid)?></span>&nbsp;| <strong>WeChat ID : </strong><span style="color:blue;"> <?=$dbshop->f(wechat)?></span>

                                </td>
							</tr>
							<tr>
								<td width="23%" height="25" align="right" bgcolor="#FFFFCC"><span style="color:#000; font-weight:bold">ชื่อพระเครื่อง / 产品名 :</span></td>
								<td width="59%" bgcolor="#FFFFCC"><span style="color:#03F; font-weight:bold; font-size:14px">
									<?=$dbproduct->f(name)?>
									</span>
								</td>
							</tr>
							<tr>
								<td colspan="2" bgcolor="#FFFFCC">
									<?
									$detailcn1 = $dbproduct->f(detailcn1);
									$detailcn2 = $dbproduct->f(detailcn2);
									$detailcn3 = $dbproduct->f(detailcn3);
									$detailcn4 = $dbproduct->f(detailcn4);
									$detailcn5 = $dbproduct->f(detailcn5);
									$detailcn6 = $dbproduct->f(detailcn6);
									$detailcn7 = $dbproduct->f(detailcn7);
									$detailcn8 = $dbproduct->f(detailcn8);
									$detailcn9 = $dbproduct->f(detailcn9);
									$detailcn10 = $dbproduct->f(detailcn10);
									$detailcn11 = $dbproduct->f(detailcn11);
									$detailcn12 = $dbproduct->f(detailcn12);
									?>
									<table width="100%" border="0" cellspacing="0" cellpadding="3">
									<? if($detailcn1 != '') { ?>
									<tr>
										<td width="220" align="right"> ชื่อพระ【名稱】: </td>
										<td width="560"><?=$detailcn1 ?></td>
									</tr>
									<? } ?>
									<? if($detailcn2 != '0' && $detailcn2 != '') { ?>
									<tr>
										<td width="220" align="right">มวลสาร【材料】:</td>
										<td><?
											$q="SELECT * FROM `catalog_cn` WHERE catalog_id= '$detailcn2' ";
											$dbmix= new nDB();  
											$dbmix->query($q);
											$dbmix->next_record();
											?>
											<?=$dbmix->f(catalog_name_cn)?>
										</td>
									</tr>
									<? } ?>
									<? if ($detailcn4 !='0') { ?>
									<tr>
										<td width="220" align="right"> เลียมกรอบ【外殼】:</td>
										<td><?
											$q="SELECT * FROM `catalog_cn` WHERE catalog_id= '$detailcn4' ";
											$dbmix= new nDB();  
											$dbmix->query($q);
											$dbmix->next_record();
											?>
											<?=$dbmix->f(catalog_name_cn)?>
										</td>
									</tr>
									<? } ?>
									<? if ($detailcn5 != '0' && $detailcn5 !='') { ?>
									<tr>
										<td width="220" align="right">รุ่น 【几帮】:</td>
										<td><?
											$q="SELECT * FROM `catalog_cn` WHERE catalog_id= '$detailcn5' ";
											$dbmix= new nDB();  
											$dbmix->query($q);
											$dbmix->next_record();
											?>
											<?=$dbmix->f(catalog_name_cn)?>
										</td>
									</tr>
									<? } ?>
									<? if ($detailcn6 != '0' && $detailcn6 != '') { ?>
									<tr>
										<td width="220" align="right">พิมพ์ 【模版】:</td>
										<td><?
											$q="SELECT * FROM `catalog_cn` WHERE catalog_id= '$detailcn6' ";
											$dbmix= new nDB();  
											$dbmix->query($q);
											$dbmix->next_record();
											?>
											<?=$dbmix->f(catalog_name_cn)?>
										</td>
									</tr>
									<? } ?>
									<? if ($detailcn7 != '0') { ?>
									<tr>
										<td width="220" align="right">สภาพ 【狀態】:</td>
										<td><?
											$q="SELECT * FROM `catalog_cn` WHERE catalog_id= '$detailcn7' ";
											$dbmix= new nDB();  
											$dbmix->query($q);
											$dbmix->next_record();
											?>
											<?=$dbmix->f(catalog_name_cn)?>
										</td>
									</tr>
									<? } ?>
									<? if ($detailcn8 !='') { ?>
									<tr>
										<td width="220" align="right">ขนาด【尺寸】:</td>
										<td><?=$detailcn8 ?></td>
									</tr>
									<? } ?>
									<? if ($detailcn9 !='') { ?>
									<tr>
										<td width="220" align="right"> วัด【佛寺】:</td>
										<td><?=$detailcn9 ?></td>
									</tr>
									<? } ?>
									<? if ($detailcn10 !='') { ?>
									<tr>
										<td width="220" align="right">พระเกจิ【高僧】:</td>
										<td><?=$detailcn10 ?></td>
									</tr>
									<? } ?>
									<? if ($detailcn11 !='0') { ?>
									<tr>
										<td width="220" align="right">ปี พ.ศ.【年期】:</td>
										<td><?
											$q="SELECT * FROM `catalog_cn` WHERE catalog_id= '".$detailcn11 ."' ";
											$dbmix= new nDB();  
											$dbmix->query($q);
											$dbmix->next_record();
											?>
											<?=$dbmix->f(catalog_name_cn)?>
										</td>
									</tr>
									<? } ?>
									<? if ($detailcn12 !='') { ?>
									<tr>
										<td width="220" align="right">พุทธคุณ【功效】:</td>
										<td><?php
											$db_cn12 = new nDB();
											$detailcn12_array = explode("|",$detailcn12 );
											foreach($detailcn12_array as $k => $v){
											$db_cn12->query("SELECT * FROM `catalog_cn` WHERE catalog_id = '".$v."'");
											$db_cn12->next_record();
											if($db_cn12->f(catalog_name_cn) != ""){
											echo $db_cn12->f(catalog_name_cn)."<br/>";
											}
											}
											?></td>
									</tr>
									<? } ?>
									</table>
								</td>
							</tr>
							<tr>
								<td height="25" align="right" bgcolor="#FFFFFF"><span style="color:#000; font-weight:bold">ราคา / 价格 :</span></td>
								<td bgcolor="#FFFFFF">

								<?
											$q="SELECT * FROM `setting_center` WHERE id= '1' ";
											$setting_center= new nDB();  
											$setting_center->query($q);
											$setting_center->next_record();
											?>

                                <? if ($dbproduct->f(status)==5) { ?>
                                		ราคาไม่โชว์เพราะสินค้าขายแล้ว 
                                
                                 <? } ?> 
                                 
                                <? if ($dbproduct->f(status)==1) { ?>
                                		ราคาไม่โชว์เพราะสินค้าไม่ได้ให้เข่า                                
                                 <? } ?>  
                                 
                                 <? if ($dbproduct->f(status)==2) { ?>
										<? if ($setting_center->f(price)=='1') { ?>
                                            <span style="color:red; font-weight:bold">
                                        <?=$dbproduct->f(price)?> Baht</span>
                                        <? } else { ?>
                                            <span style="color:red; font-weight:bold">สำหรับสมาชิกเท่านั้น</span>
                                        <? } ?>                                  
                                 <? } ?>                                  
								</td>
							</tr>
							<tr>
								<td height="25" align="right" bgcolor="#FFFFCC"><span style="color:#000; font-weight:bold">สถานะ / 状况 :</span></td>
								<td bgcolor="#FFFFCC"><span style="color:#000; font-weight:bold; font-size: 8px">
									<? if ($dbproduct->f(status)==1) { ?>
									<span style="color:#09F">พระโชว์ / 展示</span>
									<? } ?>
									<? if ($dbproduct->f(status)==2) { ?>
									<span style="color:#090">ให้เช่า / 出售</span>
									<? } ?>
									<? if ($dbproduct->f(status)==3) { ?>
									<span style="color:#FC0">เปิดจอง / 预定</span>
									<? } ?>
									<? if ($dbproduct->f(status)==4) { ?>
									<span style="color:#F90">จองแล้ว / 已定</span>
									<? } ?>
									<? if ($dbproduct->f(status)==5) { ?>
									<span style="color:#F00">ขายแล้ว / 已出售</span>
									<? } ?>
									</span>
								</td>
							</tr>
							<tr>
								<td height="25" align="right" bgcolor="#FFFFFF"><span style="color:#000; font-weight:bold"> ชื่อร้าน / 店鋪名稱 :</span></td>
								<td bgcolor="#FFFFFF"><a href="shop_index.php?shop=<?=$dbshop->f(id)?>"><span style="color:#900; font-weight:bold; font-size:16px">
									<?=$dbshop->f(shopname)?>
									</span></a>
								</td>
							</tr>
							<tr>
								<td height="25" align="right" bgcolor="#FFFFCC"><span style="color:#000; font-weight:bold">เบอร์โทรติดต่อ / 電話 :</span></td>
								<td bgcolor="#FFFFCC">
                                <? if ($_SESSION['member_id']) { ?>
                                
									<span style="color:#000; font-weight:bold"><?=$dbshop->f(mobile)?> <?=$dbshop->f(tel)?> </span>
                                
                                <? } else { ?>
								
                                	<? if ($dbproduct->f(showtype)=='0') { ?>
                                		<span style="color:#000; font-weight:bold">
                                	<? if ($show == 'show') { ?> <?=$dbshop->f(mobile)?> <? } else {?>  <? } ?>
										&nbsp;&nbsp;
                                    <? if ($show == 'show') { ?> <?=$dbshop->f(tel)?> <? } else {?> สามารถเห็นได้หลังจากลงไปแล้ว 2 ชั่วโมง เพื่อให้สมาชิกได้รับสิทธิก่อน <? } ?>
										</span>
                                    <? } else { ?>
                                    	<span style="color:red; font-weight:bold">สำหรับสมาชิกเท่านั้น</span>
                                    <? } ?>
                                                                    
								<? } ?>    
								</td>
							</tr>
							<tr>
								<td height="25" align="right" bgcolor="#FFFFCC"><span style="color:#000; font-weight:bold">ที่อยู่ / 地址:</span></td>
								<td bgcolor="#FFFFCC"><span style="color:#000; font-weight:bold">
									<?=$dbshop->f(address)?>
									</span>
								</td>
							</tr>
							<tr>
								<td height="25" align="right" bgcolor="#FFFFCC"><span style="color:#000; font-weight:bold">จำนวนผู้เช้าชม / 游客:</span></td>
								<td bgcolor="#FFFFCC"><span style="color:#000; font-weight:bold">
									<?=$dbproduct->f(view_num)?>
									คน
									(วันที่ลงประกาศ / 发布日期
									<?=date("d-m-Y",$dbproduct->f(date_add))?> <?=date("H:i:s",$checktime+25200)?> 
									)</span>
								</td>
							</tr>
							<tr>
								<td height="25" align="right" bgcolor="#FFFFCC"><span style="color:#000; font-weight:bold">วันที่เปิดร้านค้า / 开店日期:</span></td>
								<td bgcolor="#FFFFCC"><span style="color:#F00; font-weight:bold">
									<? echo date("d F Y",$timestamp);?>
									</span>
								</td>
							</tr>
							<tr>
								<td height="25" align="right" bgcolor="#FFFFCC"><span style="color:#000; font-weight:bold">ต่ออายุวันที่ล่าสุด / 最后次会员续期申请日期:</span></td>
								<td bgcolor="#FFFFCC"><span style="color:#0033F7; font-weight:bold">
									<?=date("d F Y",$timestampextend)?>
									</span>
								</td>
							</tr>
							<tr>
								<td height="25" align="right" bgcolor="#FFFFCC">
									<span style="color:#000; font-weight:bold">วันสิ้นสุด / 结束日期:</span>
								</td>
								<td bgcolor="#FFFFCC">
									<span style="color:#000; font-weight:bold"><?=date("d F Y",$timestampexpire)?></span>
									<span style="color:#000; font-weight:bold"> (เหลืออีก / 剩下
									<?
									$datanow = strtotime(date("Y-m-d"));
									// $newtimestap = strtotime(date("d F Y",$timestamp));
									$result = ($timestampexpire-$datanow)/86400;
									if($result>0){
										echo '<span style="color:red; font-weight:bold">'.number_format($result,0,".",",").'</span>';
									}else{
										echo "หมดอายุการใช้งาน 商店到期";
									}
									?>
									วัน / 天)</span>
								</td>
							</tr>
							<tr>
								<td height="25" align="right" bgcolor="#FFFFCC"><span style="color:#060; font-weight:bold">วิธีการชำระเงิน / 如何付款 :</span></td>
								<td align="left" bgcolor="#FFFFCC">
									<table width="100%" border="0" align="left" cellpadding="3" cellspacing="0" style="font-weight:bold">
									<tr class="detail-text">
										<td width="139" height="30" align="right"><span style="color:#00CC00">ชื่อบัญชี / 帐户名称:</span></td>
										<td><?=$dbshop->f(bankacc1)?></td>
									</tr>
									<tr>
										<td align="right" class="detail-text"><span style="color:#00CC00">ธนาคาร / 银行名称 :</span></td>
										<td width="386"><?=$dbshop->f(bankname1)?></td>
									</tr>
									<tr>
										<td align="right" class="detail-text"><span style="color:#00CC00">สาขา /分行 :</span></td>
										<td width="386"><span class="detail-text">
											<?=$dbshop->f(bankbranch1)?>
											</span>
										</td>
									</tr>
									<tr>
										<td align="right" class="detail-text"><span style="color:#00CC00">เลขที่บัญชี / 帐户号码:</span></td>
										<td><span style="color:#F00">
											<?=$dbshop->f(bankid1)?>
											</span>
										</td>
									</tr>
									<tr>
										<td align="right" class="detail-text"><span style="color:#00CC00">ประเภทบัญชี / 帐户类型:</span></td>
										<td class="detail-text"><? if ($dbshop->f(banktype1) == 1) { echo ออมทรัพย์ ; } else { echo กระแสรายวัน ; } ?></td>
									</tr>
									<tr>
										<td align="right" class="detail-text"><span style="color:#00CC00">อื่น ๆ / 其他 :</span></td>
										<td class="detail-text"><span style="color:#F00">
											<?=$dbshop->f(bankinfo)?>
											</span>
										</td>
									</tr>
									</table>
								</td>
							</tr>
							<? if($dbshop->f(paypal)!='') { ?>
							<tr>
								<td colspan="2" align="right" bgcolor="#FFFFCC">
									<form action="checkout.php" method="post" target="_blank">
									<table width="100%" border="0" cellspacing="0" cellpadding="3">
										<tr>
											<td align="right"><strong>ราคาพระเครื่อง / 聖物价格 :</strong></td>
											<td><input name="amount" type="text" id="amount" size="15">
												<strong>THB</strong>
											</td>
										</tr>
										<tr>
											<td width="32%" align="right"><strong>ค่าส่งสินค้า / 聖物运费:</strong></td>
											<td width="68%">
												<select name="shipping">
												<?php  
													$q1="SELECT * FROM `shipping` WHERE 1 ORDER BY amount";
													$db5=new nDB();
													$db5->query($q1);
													static $v=1;
													while($db5->next_record()){
													?>
												<option value="<?=$db5->f(amount)?>">
													<?=$db5->f(name)?>
													<?=$db5->f(amount)?>
													บาท 
												</option>
												<? } ?>
												</select>
												<strong>THB</strong>
											</td>
										</tr>
										<tr>
											<td align="right"><strong>ค่าธรรมเนียม ​Paypal / 服务费:</strong></td>
											<td><strong>5% </strong></td>
										</tr>
										<tr>
											<td align="right"><strong>ชำระสินค้านี้ผ่าน Paypal / 付款:</strong></td>
											<td><input type="hidden" name="cmd" value="_xclick">
												<input type="hidden" value="<?=$dbshop->f(paypal)?>" name="business">
												<input type="hidden" name="item_name" value="ID:<?=$dbproduct->f(product_id)?>">
												<input type="hidden" name="currency_code" value="THB">
												<? if($_SESSION['adminshop_id']=='' || $_SESSION['member_id']=='') { ?>
												สำหรับสมาชิกเท่านั้น / 只仅用于会员而己
												<? } else { ?>
												<input type="image" src="http://www.praasia.com/images/paypal.png" name="submit" alt="Make payments with PayPal - it's fast, free and secure!">
												<? } ?>
											</td>
										</tr>
									</table>
									</form>
								</td>
							</tr>
							<? } else { ?>
							<tr>
								<td align="right" bgcolor="#FFFFCC"><strong>ชำระสินค้านี้ผ่าน Paypal / 付款:</strong></td>
								<td bgcolor="#FFFFCC" style="color:#F00; font-weight:bold">ร้านนี้ยังไม่เปิดระบบ Paypal
									/ 本没有注册paypal (<a style="color:#F00" href="https://www.paypal.com/th/cgi-bin/webscr?cmd=_flow&SESSION=RZQ3zpmVuncW5NCKci-56L55WdWYJv88ZK50ZiE7-0jcbU98_xN_jsQVr8C&dispatch=5885d80a13c0db1f8e263663d3faee8db315373d882600b51a5edf961ea39639">สมัคร <img src="images/paypal-s.jpg" width="60" height="17"> 注册</a>)
								</td>
							</tr>
							<? } ?>
							<tr>
								<td bgcolor="#FFFFCC" colspan="2">
									<table width="100%" align="center">
									<tr>
										<td width="456" >
											<table border="1" align="center" cellpadding="0" cellspacing="0" style="border-collapse:collapse;">
												<tr>
												<td style="height:25px; text-align:center; white-space:nowrap;"> ความเชื่อถือร้านค้านี้/ 本店的信用与服务态度分数: </td>
												</tr>
												<tr>
												<td style="height:25px; text-align:center;">
													<a href="detail_rank.php" target="parent">
														<table width="100%" border="0" cellpadding="0" cellspacing="0">
															<tr>
															<td align="center">
																<? if ($dbshop->f(score)<=10 ) { ?>
																<img src="images/gif/heart.gif" width="20" height="16" />
																<? } ?>
																<? if ($dbshop->f(score)>10 AND $dbshop->f(score)<=40) { ?>
																<img src="images/gif/heart.gif" width="20" height="16" /> 
																<img src="images/gif/heart.gif" width="20" height="16" />
																<? } ?>
																<? if ($dbshop->f(score)>40 AND $dbshop->f(score)<=90) { ?>
																<img src="images/gif/heart.gif" width="20" height="16" /> 
																<img src="images/gif/heart.gif" width="20" height="16" /> 
																<img src="images/gif/heart.gif" width="20" height="16" />
																<? } ?> 
																<? if ($dbshop->f(score)>90 AND $dbshop->f(score)<=150) { ?>
																<img src="images/gif/heart.gif" width="20" height="16" /> 
																<img src="images/gif/heart.gif" width="20" height="16" /> 
																<img src="images/gif/heart.gif" width="20" height="16" /> 
																<img src="images/gif/heart.gif" width="20" height="16" />
																<? } ?> 
																<? if ($dbshop->f(score)>150 AND $dbshop->f(score)<=250) { ?>
																<img src="images/gif/heart.gif" width="20" height="16" /> 
																<img src="images/gif/heart.gif" width="20" height="16" /> 
																<img src="images/gif/heart.gif" width="20" height="16" /> 
																<img src="images/gif/heart.gif" width="20" height="16" /> 
																<img src="images/gif/heart.gif" width="20" height="16" />
																<? } ?>
																<? if ($dbshop->f(score)>250 AND $dbshop->f(score)<=500) { ?>
																<img src="images/gif/dimon.gif" width="20" height="16" />
																<? } ?>          
																<? if ($dbshop->f(score)>500 AND $dbshop->f(score)<=1000) { ?>
																<img src="images/gif/dimon.gif" width="20" height="16" /> 
																<img src="images/gif/dimon.gif" width="20" height="16" />
																<? } ?>   
																<? if ($dbshop->f(score)>1000 AND $dbshop->f(score)<=2000) { ?>
																<img src="images/gif/dimon.gif" width="20" height="16" /> 
																<img src="images/gif/dimon.gif" width="20" height="16" /> 
																<img src="images/gif/dimon.gif" width="20" height="16" />
																<? } ?> 
																<? if ($dbshop->f(score)>2000 AND $dbshop->f(score)<=5000) { ?>
																<img src="images/gif/dimon.gif" width="20" height="16" /> 
																<img src="images/gif/dimon.gif" width="20" height="16" /> 
																<img src="images/gif/dimon.gif" width="20" height="16" /> 
																<img src="images/gif/dimon.gif" width="20" height="16" />
																<? } ?>
																<? if ($dbshop->f(score)>5000 AND $dbshop->f(score)<=10000) { ?>
																<img src="images/gif/dimon.gif" width="20" height="16" /> 
																<img src="images/gif/dimon.gif" width="20" height="16" /> 
																<img src="images/gif/dimon.gif" width="20" height="16" /> 
																<img src="images/gif/dimon.gif" width="20" height="16" /> 
																<img src="images/gif/dimon.gif" width="20" height="16" />
																<? } ?>
																<? if ($dbshop->f(score)>10000 AND $dbshop->f(score)<=20000) { ?>
																<img src="images/rank-redcrown.gif" width="20" height="16" />
																<? } ?>
																<? if ($dbshop->f(score)>20000 AND $dbshop->f(score)<=50000) { ?>
																<img src="images/rank-redcrown.gif" width="20" height="16" /> 
																<img src="images/rank-redcrown.gif" width="20" height="16" />
																<? } ?>
																<? if ($dbshop->f(score)>50000 AND $dbshop->f(score)<=100000) { ?>
																<img src="images/rank-redcrown.gif" width="20" height="16" /> 
																<img src="images/rank-redcrown.gif" width="20" height="16" /> 
																<img src="images/rank-redcrown.gif" width="20" height="16" />
																<? } ?> 
																<? if ($dbshop->f(score)>100000 AND $dbshop->f(score)<=200000) { ?>
																<img src="images/rank-redcrown.gif" width="20" height="16" /> 
																<img src="images/rank-redcrown.gif" width="20" height="16" /> 
																<img src="images/rank-redcrown.gif" width="20" height="16" /> 
																<img src="images/rank-redcrown.gif" width="20" height="16" />
																<? } ?> 
																<? if ($dbshop->f(score)>200000 AND $dbshop->f(score)<=500000) { ?>
																<img src="images/rank-redcrown.gif" width="20" height="16" /> 
																<img src="images/rank-redcrown.gif" width="20" height="16" /> 
																<img src="images/rank-redcrown.gif" width="20" height="16" /> 
																<img src="images/rank-redcrown.gif" width="20" height="16" /> 
																<img src="images/rank-redcrown.gif" width="20" height="16" />
																<? } ?>
																<? if ($dbshop->f(score)>500000 AND $dbshop->f(score)<=1000000) { ?>
																<img src="images/gif/crown.gif" width="20" height="16" />
																<? } ?>          
																<? if ($dbshop->f(score)>1000000 AND $dbshop->f(score)<=2000000) { ?>
																<img src="images/gif/crown.gif" width="20" height="16" /> 
																<img src="images/gif/crown.gif" width="20" height="16" />
																<? } ?>   
																<? if ($dbshop->f(score)>2000000 AND $dbshop->f(score)<=5000000) { ?>
																<img src="images/gif/crown.gif" width="20" height="16" /> 
																<img src="images/gif/crown.gif" width="20" height="16" /> 
																<img src="images/gif/crown.gif" width="20" height="16" />
																<? } ?> 
																<? if ($dbshop->f(score)>5000000 AND $dbshop->f(score)<=10000000) { ?>
																<img src="images/gif/crown.gif" width="20" height="16" />
																<img src="images/gif/crown.gif" width="20" height="16" /> 
																<img src="images/gif/crown.gif" width="20" height="16" /> 
																<img src="images/gif/crown.gif" width="20" height="16" />
																<? } ?>
																<? if ($dbshop->f(score)>10000000) { ?>
																<img src="images/gif/crown.gif" width="20" height="16" /> 
																<img src="images/gif/crown.gif" width="20" height="16" /> 
																<img src="images/gif/crown.gif" width="20" height="16" /> 
																<img src="images/gif/crown.gif" width="20" height="16" /> 
																<img src="images/gif/crown.gif" width="20" height="16" />
																<? } ?>                      
															</td>
															</tr>
														</table>
													</a>
												</td>
												</tr>
												<tr>
												<td style="height:25px; text-align:center; white-space:nowrap;"> คะแนนรวม / 总分数 <span style="color:#090;"> <?=$dbshop->f(score)?> </span> | Comment <span style="color:#ff0000;"><a href="show_warnproduct.php?shop=<?=$dbshop->f(id)?>" style="color:#ff0000;"><?php echo ($dbshop->f(commentscore) <= 0)?'0':$dbshop->f(commentscore);?></a></span></td>
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
			<?php } else { ?>
				<tr>
					<td align="center" style="color:#ffcc00;font-size:18px;">
						ร้านค้านี้หมดอายุลงแล้ว
					</td>
				</tr>	
			<?php } ?>
					<tr>
						<td>&nbsp;</td>
					</tr>
					<tr>
						<td>
						<table align="center" width="100%">
							<tr>
								<td valign="top">
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
									.shoppm_container {
										position:relative;
										width:100%;
										-webkit-box-shadow: rgba(0,0,0,0.5) 0px 0px 5px;
										-moz-box-shadow: rgba(0,0,0,0.5) 0px 0px 5px;
										box-shadow: rgba(0,0,0,0.5) 0px 0px 5px;
									}
									.shoppm_title {
										height:25px;
										text-align:center;
										text-shadow: -1px -1px #444444;
										color:#f5f5f5;
										background-color:#671f10;
										-webkit-box-shadow: inset rgba(0,0,0,0.1) 0px -5px 10px;
										-moz-box-shadow: inset rgba(0,0,0,0.1) 0px -5px 10px;
										box-shadow: inset rgba(0,0,0,0.1) 0px -5px 10px;
									}
									.shoppm_textarea {
										padding:5px;
										margin:0px;
										width:100%;
										height:125px;
										border:0px solid #ffffff;
										resize:none;
										outline:none;
										box-sizing:border-box;
										-webkit-box-sizing:border-box;
										-moz-box-sizing:border-box;
									}
									.shoppm_text {
										padding:5px;
										margin:0px;
										width:100%;
										height:24px;
										border:0px solid #ffffff;
										outline:none;
										box-sizing:border-box;
										-webkit-box-sizing:border-box;
										-moz-box-sizing:border-box;
									}
									.shoppmleave_submit {
										margin:0px;
										padding:5px;
										padding-left:10px;
										padding-right:10px;
										text-align:center;
										text-shadow: -1px -1px #444444;
										white-space:nowrap;
										font-family:Tahoma;
										font-size:12px;
										font-weight:bold;
										color:#ffffff;
										background-color:#0098ce;
										border:0px solid #e1e1e1;
										-webkit-box-shadow: inset rgba(0,0,0,0.1) 0px -5px 10px;
										-moz-box-shadow: inset rgba(0,0,0,0.1) 0px -5px 10px;
										box-shadow: inset rgba(0,0,0,0.1) 0px -5px 10px;
										outline:none;
										cursor:pointer;
										transition:all 0.3s ease 0s;
									}
									.shoppmleave_submit:hover {
										background-color:#00a8db;
									}
									.shoppm_submit {
										padding:5px;
										margin:0px;
										width:100%;
										height:30px;
										text-shadow: 1px 1px #ffffff;
										font-weight:bold;
										color:#444444;
										background-color:#f5f5f5;
										border:0px solid #ffffff;
										outline:none;
										cursor:pointer;
										-webkit-box-shadow: inset rgba(0,0,0,0.1) 0px -5px 10px;
										-moz-box-shadow: inset rgba(0,0,0,0.1) 0px -5px 10px;
										box-shadow: inset rgba(0,0,0,0.1) 0px -5px 10px;
										box-sizing:border-box;
										-webkit-box-sizing:border-box;
										-moz-box-sizing:border-box;
										transition:all 0.3s ease 0s;
									}
									.shoppm_submit:hover {
										text-shadow: -1px -1px #444444;
										color:#f5f5f5;
										background-color:#008800;
									}
									.shoppmregis_submit {
										padding:5px;
										margin:0px;
										width:100%;
										height:30px;
										text-shadow: -1px -1px #444444;
										font-weight:bold;
										color:#f5f5f5;
										background-color:#008800;
										border:0px solid #ffffff;
										outline:none;
										cursor:pointer;
										-webkit-box-shadow: inset rgba(0,0,0,0.1) 0px -5px 10px;
										-moz-box-shadow: inset rgba(0,0,0,0.1) 0px -5px 10px;
										box-shadow: inset rgba(0,0,0,0.1) 0px -5px 10px;
										box-sizing:border-box;
										-webkit-box-sizing:border-box;
										-moz-box-sizing:border-box;
										transition:all 0.3s ease 0s;
									}
									.shoppmregis_submit:hover {
										background-color:#00aa00;
									}
									</style>
									<script>
									function shoppm_signin(){
										var username = $.trim($(".shoppm_username").val());
										var password = $.trim($(".shoppm_password").val());
										if( username != "" && password != "" ){
											loading_show("black","");
											$.ajax({
												type: "POST",
												url: "shop_query.php",
												data: { do_what:"shoppm_signin", username:username, password:password, member:"<?=$_SESSION['shop_id']?>" },
												cache: false,
												success: function(result){
													loading_hide();
													result = $.trim(result);
													if(result == "1"){
														window.location.href = "shop_product.php?product_id=<?=$_GET['product_id']?>";
													}else{
														alert("ชื่อผู้ใช้หรือรหัสผ่านไม่ถูกต้อง");
													}
												}
											});
										}else{
											alert("กรุณากรอกชื่อผู้ใช้และรหัสผ่าน");
										}
									}
									function shoppm_message_add(){
										var message = $.trim($(".shoppm_textarea").val());
										if( $.trim(message) != "" ){
											loading_show("black","");
											$.ajax({
												type: "POST",
												url: "shop_query.php",
												data: { do_what:"message_add", member:"<?=$dbshop->f(id)?>", message:message ,pro_id:<?=$_GET['product_id']?>},
												cache: false,
												success: function(result){
													$(".shoppm_textarea").val("");
													loading_hide();
												}
											});
										}else{
											alert("กรุณากรอกข้อความก่อนส่งข้อความ / 请输入信信后才能发送");
										}
									}
									
									function shoppm_translated_select(v){
										var current_value = $(".shoppm_textarea").val();
										$(".shoppm_textarea").val( current_value+" "+v );
										$(".shoppm_translated_container").html("");
										$(".shoppm_translate_text").val("");
									}
									
									function shoppm_translate_text(x_this){
										var v = $.trim(x_this.val());
										$.ajax({
											type: "POST",
											url: "shop_query.php",
											data: { do_what:"translate", v:v },
											cache: false,
											success: function(result){
												$(".shoppm_translated_container").html(result);
											}
										});
									}
									function shoppm_translate_leave(){
										var v = $.trim($(".shoppm_translateleave_textbox").val());
										if( $.trim(v) != "" ){
											$.ajax({
												type: "POST",
												url: "shop_query.php",
												data: { do_what:"shoppm_translate_leave", v:v },
												cache: false,
												success: function(result){
													$(".shoppm_translateleave_textbox").val("");
													alert(result);
												}
											});
										}else{
											alert("กรุณากรอกข้อความก่อนทำการฝากแปล");
										}
									}
									</script>
									<?php
									if($_SESSION["member_id"] == ""){
									?>
									<div class="shoppm_container">
									<table style="width:100%; border:1px solid #e1e1e1; border-collapse:collapse;" width="100%" border="0" cellpadding="0" cellspacing="0">
										<tr>
											<td colspan="2" class="shoppm_title"> ระบบส่งข้อความ 2 ภาษา
												/
												送消息2种语言翻译系统 
											</td>
										</tr>
										<tr>
											<td colspan="2"><textarea class="shoppm_textarea" style="height:70px;" onClick="javascrip:alert('สำหรับสมาชิกเท่านั้น / 您还未注册-登录');return false"></textarea></td>
										</tr>
										<tr>
											<td colspan="2" style="border-top:1px solid #e1e1e1;"><input class="shoppm_text" placeholder="ใส่คำที่ต้องการแปล /输入单词进行翻译" onClick="javascrip:alert('สำหรับสมาชิกเท่านั้น / 您还未注册-登录');return false" type="text"/></td>
										</tr>
										<tr style="border-top:1px solid #e1e1e1;">
											<td><input class="shoppm_text" placeholder="ใส่คำที่ฝากแปล" onClick="javascrip:alert(สำหรับสมาชิกเท่านั้น / 您还未注册-登录');return false" type="text"/></td>
											<td style="width:1px;"><input class="shoppmleave_submit" value="ฝากแปลภาษา / 存录为了帮我翻译" type="submit"/></td>
										</tr>
										<tr>
											<td colspan="2" style="border-top:1px solid #e1e1e1;"><input class="shoppm_submit" value="ส่งข้อความ / 发送" type="submit"/></td>
										</tr>
										<tr>
											<td colspan="2" style="border-top:1px solid #e1e1e1;">
												<table width="100%" border="0" cellpadding="0" cellspacing="0">
												<tr>
													<td style="border-right:1px solid #e1e1e1;"><input class="shoppm_text shoppm_username" placeholder="username" type="text"/></td>
													<td><input class="shoppm_text shoppm_password" placeholder="password" type="password"/></td>
													<td style="width:1px;"><input class="shoppmleave_submit" onClick="shoppm_signin()" value="เข้าสู่ระบบ / 登录" type="submit"/></td>
												</tr>
												</table>
											</td>
										</tr>
										<tr>
											<td colspan="2" style="border-top:1px solid #e1e1e1;"><a href="register_mem.php" target="_self">
												<input class="shoppmregis_submit" value="สมัครสมาชิกทั่วไป / 免费注册" type="button"/>
												</a>
											</td>
										</tr>
									</table>
									</div>
									<?php
									}else{
									?>
									<div class="shoppm_container">
									<table style="width:100%; border:1px solid #e1e1e1; border-collapse:collapse;" width="100%" border="0" cellpadding="0" cellspacing="0">
										<tr>
											<td colspan="2" class="shoppm_title"> ระบบส่งข้อความ 2 ภาษา
												/
												送消息2种语言翻译系统 
											</td>
										</tr>
										<tr>
											<td colspan="2"><textarea class="shoppm_textarea"></textarea></td>
										</tr>
										<tr>
											<td colspan="2" style="border-top:1px solid #e1e1e1;">
												<input class="shoppm_text shoppm_translate_text" onKeyUp="shoppm_translate_text($(this))" placeholder="ใส่คำที่ต้องการแปล /输入单词进行翻译" type="text"/>
												<div style="position:relative; left:0px; top:0px;">
												<div class="shoppm_translated_container" style="position:absolute; left:0px; top:0px;"></div>
												</div>
											</td>
										</tr>
										<tr style="border-top:1px solid #e1e1e1;">
											<td><input class="shoppm_text shoppm_translateleave_textbox" placeholder="ใส่คำที่ฝากแปล" type="text"/></td>
											<td style="width:1px;"><input class="shoppmleave_submit" onClick="shoppm_translate_leave();" value="ฝากแปลภาษา / 存录为了帮我翻译" type="submit"/></td>
										</tr>
										<tr>
											<td colspan="2" style="border-top:1px solid #e1e1e1;"><input class="shoppm_submit" onClick="shoppm_message_add();" value="ส่งข้อความ / 发送" type="button"/></td>
										</tr>
									</table>
									</div>
									<?php
									}
									?>
								</td>
							</tr>
						</table>
						</td>
					</tr>
					<tr>
						<td></td>
					</tr>
					<tr>
						<td></td>
					</tr>
				</table>
			</td>
			</tr>
			<tr>
			<td height="5"></td>
			</tr>
			<tr>
			<td>
				<table width="100%" cellpadding="3" cellspacing="0" border="0">
					<tr>
						<td height="30" bgcolor="#3d2000" style="text-align:center;"><span style="color:#FF0">โหวต / 评论 :
						<?=$dbproduct->f(name)?>
						)</span>
						</td>
					</tr>
					<tr>
						<td bgcolor="#111111">
						<table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
							<tr>
								<td height="25" align="center"><span style="color:#FC0; font-size:14px">รายงานผลโหวตพระนี้ / 投票系統佛牌真-假区</span></td>
							</tr>
							<tr>
								<td align="center" style="padding:5px"><span style="color:#FFF"> ระบบโหวตนี้จะแสดงผลโหวตและเหตุผลที่โหวตเท่านั้น สำหรับข้อมูลผู้โหวตทางทีมงานได้มีการบันทึกไว้ เพื่อป้องกันผู้ที่มาช่วยดูพระให้ หากมีการโหวตว่าเก๊จนพระเครื่องนี้<br>
									มีคะแนนไม่ถึง 0% ระบบจะทำการลบสินค้านี้ทันที แต่หากผู้ที่โหวตมั่ว ๆ จะมีการตรวจสอบและหากมีเจตนาที่ไม่ดีจะมีการดำเนินการระงับหรือยกเลิกการเป็นสมาชิกทันที</span>
								</td>
							</tr>
							<tr>
								<td align="center" style="padding:5px"><span style="color:#FC0; line-height:20px"> 投票系統佛牌真-假只能展示投票的报告结果和理由 总台中心团队员将会把所有关于员会投票的报告结果和理由记录 为了保护别人知道是哪位会员来帮测看牌和投票<br>
									如果本尊佛牌被投票假牌度的分数低于 0% 系统将会自动删除掉本尊佛牌 如果是会员乱投票 将被调查,如是故意, 将快被暂时冻洁或是被取消会员权 如果还确定您的佛</span>
								</td>
							</tr>
							<?
								if ($_POST['submit']) {
									if( isset($_POST["vote1"]) ){ 
										$vote_total += $_POST["vote1"]; 
									}
									if( isset($_POST["vote2"]) ){ 
										$vote_total += $_POST["vote2"]; 
									}
									if( isset($_POST["vote3"]) ){ 
										$vote_total += $_POST["vote3"]; 
									}
									if( isset($_POST["vote4"]) ){ 
										$vote_total += $_POST["vote4"]; 
									}
									if( isset($_POST["vote5"]) ){ 
										$vote_total += $_POST["vote5"]; 
									}
									if( isset($_POST["vote6"]) ){ 
										$vote_total += $_POST["vote6"]; 
									}
									if( isset($_POST["vote7"]) ){ 
										$vote_total += $_POST["vote7"]; 
									}
									if( isset($_POST["vote8"]) ){ 
										$vote_total += $_POST["vote8"]; 
									}
									if( isset($_POST["vote9"]) ){ 
										$vote_total += $_POST["vote9"]; 
									}
									if( isset($_POST["vote10"]) ){ 
										$vote_total += $_POST["vote10"]; 
									} 
									if( isset($_POST["vote11"]) ){ 
										$vote_total += $_POST["vote11"]; 
									}
									if( isset($_POST["vote12"]) ){ 
										$vote_total += $_POST["vote12"]; 
									}
									if( isset($_POST["vote13"]) ){ 
										$vote_total += $_POST["vote13"]; 
									} 
									if( isset($_POST["vote14"]) ){ 
										$vote_total += $_POST["vote14"]; 
									}

									if( trim($_POST['comment']) != "" ){
										$vote_total += 10;
									}
									
									$db->query("
													update product 
													set 	score = (score - '".$vote_total."'),
															count_comment =  count_comment+1
													where product_id = '".$dbproduct->f(product_id)."'
												");
									
									$q="
										INSERT INTO `comment` 
														( 
															`comment_id` , 
															`comment_by` , 
															`comment_product` , 
															`comment_point` , 
															`comment_detail` , 
															`comment_date`, 
															`vote1`, 
															`vote2`, 
															`vote3`, 
															`vote4`, 
															`vote5`, 
															`vote6`, 
															`vote7`, 
															`vote8`, 
															`vote9`, 
															`vote10`, 
															`vote11`, 
															`vote12`, 
															`vote13`, 
															`vote14`
														) VALUES (
															'', 
															'".$_SESSION['adminshop_id']."', 
															'".$dbproduct->f(product_id)."', 
															'".$_POST['point']."', 
															'".$_POST['comment']."', 
															'".time()."', 
															'".$_POST['vote1']."', 
															'".$_POST['vote2']."', 
															'".$_POST['vote3']."', 
															'".$_POST['vote4']."', 
															'".$_POST['vote5']."', 
															'".$_POST['vote6']."', 
															'".$_POST['vote7']."', 
															'".$_POST['vote8']."', 
															'".$_POST['vote9']."', 
															'".$_POST['vote10']."', 
															'".$_POST['vote11']."', 
															'".$_POST['vote12']."', 
															'".$_POST['vote13']."', 
															'".$_POST['vote14']."' 
														)
										";
									$db->query($q);

									$INS_ID=mysql_insert_id();  
									$q="SELECT * FROM `comment` WHERE `comment_product` = '".$dbproduct->f(product_id)."' ";
									$comment= new nDB();
									$comment->query($q);
									$comment->next_record();
									$num_rows = $comment->num_rows();
									$point = $_POST['point'] ;
									$score = $dbproduct->f(score) ;
									$votescore = ($point + $score)/$num_rows ;

									$q="
											UPDATE `member` 
											SET `commentscore` = `commentscore`+10
											WHERE `id` ='".$dbshop->f(id)."' 
										";
									$db->query($q);

									al('ได้ส่งผลคะแนนโหวต เรียบร้อยแล้ว / 分数投票结果已被展发');
									redi4('shop_product.php?product_id='.$dbproduct->f(product_id));
								}

								?>
							<?
								$q="SELECT * FROM `comment` WHERE `comment_product` = '".$_SESSION['product_id']."' ";
								$comment= new nDB();
								$comment->query($q);
								$comment->next_record();
								$num_rows = $comment->num_rows(); 
								?>
							<? if  (($num_rows)==0 ) { ?>
							<tr>
								<td height="50" align="center" style="color:#FC0">
									<table width="900" border="0" align="center" cellpadding="0" cellspacing="0">
									<tr>
										<td height="25" bgcolor="#555555">
											<table width="100%" cellpadding="3" cellspacing="0" border="0">
												<tr>
												<td height="20" align="right" bgcolor="#00CC00" > 100 คะแนน / 分数</td>
												</tr>
											</table>
										</td>
									</tr>
									<tr>
										<td height="25">
											<table width="100%" border="0" cellspacing="0" cellpadding="0">
												<tr>
												<td width="30%"><span style="color:#ff0000">พระเก๊ / /假牌</span></td>
												<td width="40%" align="center"><span style="color:#ffCC00">ไม่แน่ใจ / 不确定</span></td>
												<td width="30%" align="right"><span style="color:#00CC00">พระแท้ / 真牌</span></td>
												</tr>
											</table>
										</td>
									</tr>
									</table>
								</td>
							</tr>
							<? } else { ?>
							<tr>
								<td>
									<table width="900" border="0" align="center" cellpadding="0" cellspacing="0">
									<tr>
										<td height="25" bgcolor="#555555">
											<?php
												if ($dbproduct->f(score)>79) {
												if ($dbproduct->f(score)>100) {
													$dbscore = 100;
												}else{
													$dbscore = $dbproduct->f(score);
												}
												$dbscoreprocess = $dbproduct->f(score);
												$colorscore ="#00ff00";
												}elseif ($dbproduct->f(score)>29) {
												$dbscore = $dbproduct->f(score);
												$dbscoreprocess = $dbproduct->f(score);
												$colorscore ="#F7E81D";      
												}else{
												$dbscore = $dbproduct->f(score);
												$dbscoreprocess = $dbproduct->f(score);
												$colorscore = "red";     
												}
												?>
											<table width="<?=$dbproduct->f(score)?>%" cellpadding="3" cellspacing="0" border="0">
												<tr>
												<td height="20" align="right" bgcolor="<?=$colorscore?>" ><?=$dbscore;?>
													คะแนน / 分数
												</td>
												</tr>
											</table>
										</td>
									</tr>
									<tr>
										<td height="25">
											<table width="100%" border="0" cellspacing="0" cellpadding="0">
												<tr>
												<td width="30%"><span style="color:#ff0000">พระเก๊ / 假牌</span></td>
												<td width="40%" align="center"><span style="color:#ffCC00">ไม่แน่ใจ / 不确定</span></td>
												<td width="30%" align="right"><span style="color:#00CC00">พระแท้ / 正牌</span></td>
												</tr>
											</table>
										</td>
									</tr>
									</table>
								</td>
							</tr>
							<? } ?>
							<tr>
								<td height="30" align="center"><span style="color:#ffffff"> หากท่านคิดว่าพระเครื่องของท่านเป็นพระแท้แน่นอน ควรทำการแนบใบการันตีพระจากศูนย์ต่าง ๆ เพื่อเพิ่มความน่าเชื่อถือ<br>
									如果还确定您的佛牌是正牌，<u></u>必需把各地的认正佛牌中心出的认正佛牌书传来,以增加可靠性 </span>
								</td>
							</tr>
							<? if ($dbproduct->f(score) > 0) { ?>
							<tr>
								<td height="30" align="center">
									<table width="100%" border="0" cellspacing="0" cellpadding="3">
									<?php if($_SESSION['adminshop_id']=='' || !isset($_SESSION['adminshop_id'])) {  ?>
									<tr>
										<td>
											<form action="chk_votelogin.php" method="post" name="REG" target="p_wb" id="REG">
												<table width="900" border="0" align="center" cellpadding="3" cellspacing="0">
												<tr>
													<td height="29"  align="center" style="background:url(images/bh-login.png) no-repeat center; padding-left:30px"><span style="color:#391700; font-size:14px; font-weight:bold">เข้าสู่ระบบ / 登录</span></td>
												</tr>
												<tr>
													<td width="71%" bgcolor="#603506"><span class="detail-text" style="color:#fc0;">username / 帐号 :</span>
														<input name="username" type="text" class="input" id="username" style="width:160px" />
														<span class="detail-text" style="color:#fc0;">password / 密码 :</span>
														<input name="password" type="password" class="input" id="password" style="width:160px" />
														<input name="Login" type="submit" id="Login" value="เข้าสู่ระบบ / 登录" />
														<a href="forget_password.php"><span style="color:#FC0">ลืมรหัสผ่าน / 忘记密码</span></a>&nbsp;
													</td>
												</tr>
												<iframe src="" name="p_wb" width="0px" height="0px" frameborder="0" id="p_wb"></iframe>
												</table>
											</form>
										</td>
									</tr>
									<? } else { ?>
									<tr>
										<td align="center">
											<table width="100%" border="0" cellspacing="0" cellpadding="0">
												<tr>
												<td>
													<form action="" method="post" target="vote_frm">
														<table width="600" border="0" align="center" cellpadding="3" cellspacing="0">
															<tr>
															<td height="30" colspan="2" align="center" bgcolor="#603506" style="color:#FC0">ให้คะแนนพระเครื่องนี้ / 评论给这尊牌的分数</td>
															</tr>
															<!--<tr>
															<td width="25" align="center" bgcolor="#78440b"><input name="point" type="radio" value="100" checked="CHECKED"></td>
															<td width="563" bgcolor="#78440b" style="color:#0C0">แท้ (100 คะแนน)</td>
															</tr>
															<tr>
															<td align="center" bgcolor="#78440b"><input name="point" type="radio" value="50"></td>
															<td bgcolor="#78440b" style="color:#ffCC00" >ไม่แน่ใจ (50 คะแนน)</td>
															</tr>-->
															<tr>
															<td align="center" bgcolor="#78440b">
																<!--<input name="point" type="radio" value="0">-->
															</td>
															<td bgcolor="#78440b"  style="color:#00FF14;text-align:center;"> หากท่านเห็นว่าสินค้านี้ไม่น่าจะแท้ กรุณาเลือกเหตุผลด้านล่าง <br/>如您看了上面那尊牌有点不真，请您选择以下的理由给这尊牌做签定或评论一下</td>
															</tr>
															<tr>
															<td colspan="2" align="center" bgcolor="#78440b" style="color:#FC0">
																<table width="95%" border="0" cellspacing="0" cellpadding="0" style="color:#FFF">
																	<tr>
																		<td width="5%" align="center"><input name="vote1" type="checkbox" value="2"></td>
																		<td width="95%">จากภาพพระเบลอ / 相片里佛牌模糊<span style="color:#FC0"> (-2 คะแนน / 分数)</span></td>
																	</tr>
																	<tr>
																		<td align="center"><input  name="vote2" type="checkbox" value="15"></td>
																		<td>จากภาพพระเบลอมาก / 相片里佛牌很模糊<span style="color:#FC0"> (-15 คะแนน / 分数)</span></td>
																	</tr>
																	<tr>
																		<td align="center"><input name="vote3" type="checkbox" value="10"></td>
																		<td>จากภาพพิมพ์ตื้นไป / 相片里模表面很浅<span style="color:#FC0"> (-10 คะแนน分数 / )</span></td>
																	</tr>
																	<tr>
																		<td align="center"><input name="vote4" type="checkbox" value="15"></td>
																		<td>จากภาพผิดพิมพ์ / 相片里佛牌模不对<span style="color:#FC0"> (-15 คะแนน / 分数 )</span></td>
																	</tr>
																	<tr>
																		<td align="center"><input name="vote5" type="checkbox" value="10"></td>
																		<td>จากภาพผิดเนื้อ / 相片里佛牌料质不对<span style="color:#FC0"> (-10 คะแนน / 分数)</span></td>
																	</tr>
																	<tr>
																		<td align="center"><input name="vote6" type="checkbox" value="5"></td>
																		<td>จากภาพผิวรมใหม่ / 相片里佛牌是新皮<span style="color:#FC0"> (-5 คะแนน / 分数)</span></td>
																	</tr>
																	<tr>
																		<td align="center"><input name="vote7" type="checkbox" value="15"></td>
																		<td>จากภาพพระบวม / 相片里佛牌肿胀<span style="color:#FC0"> (-15 คะแนน / 分数)</span></td>
																	</tr>
																	<tr>
																		<td align="center"><input name="vote8" type="checkbox" value="15"></td>
																		<td>จากภาพพระดูยาก / 相片里佛牌辨认真假难<span style="color:#FC0"> (-15 คะแนน / 分数)</span></td>
																	</tr>
																	<tr>
																		<td align="center"><input name="vote9" type="checkbox" value="10"></td>
																		<td>จากภาพทีความคมชัดน้อย / 相片里的尖锐度很少<span style="color:#FC0"> (-10 คะแนน / 分数)</span></td>
																	</tr>
																	<tr>
																		<td align="center"><input name="vote10" type="checkbox" value="30"></td>
																		<td>จากภาพปลอมแปลงใบรับรอง / 假冒的验正书<span style="color:#FC0"> (-30 คะแนน / 分数)</span></td>
																	</tr>
																	<tr>
																		<td align="center"><input name="vote11" type="checkbox" value="15"></td>
																		<td>จากภาพประวัติไม่ชัดเจน / 来历不明显<span style="color:#FC0"> (-15 คะแนน / 分数)</span></td>
																	</tr>
																	<tr>
																		<td align="center"><input name="vote12" type="checkbox" value="20"></td>
																		<td>เนื้อดูใหม่ไป / 佛牌表面皮看得很新<span style="color:#FC0"> (-20 คะแนน / 分数)</span></td>
																	</tr>
																	<tr>
																		<td align="center"><input name="vote13" type="checkbox" value="20"></td>
																		<td>เนื้อไม่ถึงยุค / 佛牌后旧性达不到当时年代<span style="color:#FC0"> (-20 คะแนน / 分数)</span></td>
																	</tr>
																	<tr>
																		<td align="center"><input name="vote14" type="checkbox" value="0"></td>
																		<td>ลงผิดหมวดสินค้า / 本尊牌不合格在本区展示<span style="color:#FC0"> (ให้ย้ายภายใน 3 วัน ก่อนที่จะโดนลบสินค้า จาก admin/ 敬请转到合适佛牌区3天 不然被册除 For Admin)</span></td>
																	</tr>
																</table>
															</td>
															</tr>
															<tr>
															<td colspan="2" align="center" bgcolor="#78440b"><span style="color:#FC0"> เหตุผลอื่น ๆ 
																/
																其它理由 </span>
															</td>
															</tr>
															<tr>
															<td colspan="2" align="center" bgcolor="#78440b"><textarea name="comment" cols="60" rows="5" id="comment" style="overflow:hidden"></textarea></td>
															</tr>
															<tr>
															<td colspan="2" align="center" bgcolor="#78440b"><input name="submit" type="submit" id="submit" value="ตกลง / 确定"></td>
															</tr>
															<iframe src="" name="vote_frm" width="1px" height="0px" frameborder="0" id="vote_frm"></iframe>
															<script>
															CKEDITOR.replace( 'comment', {
																	toolbar:  [
																	]
															});           
															</script>
														</table>
													</form>
												</td>
												</tr>
											</table>
										</td>
									</tr>
									<? } ?>
									</table>
								</td>
							</tr>
							<? } else { ?>
							<tr>
								<td style="color:#F00; font-size:18px" align="center" height="50px">รายการนี้ปิดการให้คะแนนแล้ว / 这个项目以被冻结</td>
							</tr>
							<? } ?>
						</table>
						</td>
					</tr>
				</table>
			</td>
			</tr>
			<tr>
			<td style="padding-bottom:20px;">
				<style>
					.commentresult_table td {
					font-size:14px;
					color:#ffcc00;
					}
				</style>
				<table style="width:100%; border:3px solid #78440b;" border="0" cellspacing="0" cellpadding="0">
					<tr>
						<td style="padding-left:15px; height:35px; text-align:center; font-size:16px; color:#ffffff; background-color:#3d2000;"> ความคิดเห็นของการให้คะแนน / 投票分数的意见 </td>
					</tr>
					<?php
						$q = "SELECT * FROM `comment` WHERE `comment_product` = '".$dbproduct->f(product_id)."' ORDER BY comment_id DESC ";
						$showment = new nDB();
						$showment->query($q);
						while($showment->next_record()){
						?>
					<tr>
						<td>
						<table class="commentresult_table" style="width:100%;" border="0" cellpadding="0" cellspacing="0">
							<tr style="background-color:#78440b;">
								<td style="padding-left:20px; width:1px; height:35px; text-align:right; white-space:nowrap;"> เหตุผลที่เลือก / 选的意见 </td>
								<td style="padding-left:10px; padding-right:10px; width:1px;"> : </td>
								<td><?php
									if($showment->f(vote1) != 0){
									?>
									จากภาพพระเบลอ / 相片里佛牌模糊
									<?php
									}
									if($showment->f(vote2) != 0){
									?>
									จากภาพพระเบลอมาก / 相片里佛牌很模糊
									<?php
									}
									if ($showment->f(vote3) != 0){
									?>
									จากภาพพิมพ์ตื้นไป / 相片里模表面很浅
									<?php
									}
									if($showment->f(vote4)){
									?>
									จากภาพผิดพิมพ์ / 相片里佛牌模不对
									<?php
									}
									if($showment->f(vote5) != 0){
									?>
									จากภาพผิดเนื้อ / 相片里佛牌料质不对
									<?php
									}
									if($showment->f(vote6) != 0 ){
									?>
									จากภาพผิวรมใหม่ / 相片里佛牌是新皮
									<?php
									}
									if($showment->f(vote7) != 0){
									?>
									จากภาพพระบวม / 相片里佛牌肿胀
									<?php
									}
									if($showment->f(vote8) != 0){
									?>
									จากภาพพระดูยาก / 相片里佛牌辨认真假难
									<?php
									}
									if($showment->f(vote9) != 0){
									?>
									จากภาพมีความคมชัดน้อย / 相片里的尖锐度很少
									<?php
									}
									if($showment->f(vote10) != 0){
									?>
									จากภาพปลอมแปลงใบรับรอง / 假冒的验正书
									<?php
									}
									if($showment->f(vote11) != 0){
									?>
									จากภาพประวัติไม่ชัดเจน / 来历不明显
									<?php
									}
									if($showment->f(vote12) != 0){
									?>
									เนื้อดูใหม่ไป / 佛牌表面皮看得很新
									<?php
									}
									if($showment->f(vote13) != 0){
									?>
									เนื้อไม่ถึงยุค / 佛牌后旧性达不到当时年代
									<?php
									}
									if($showment->f(vote14) != 0){
									?>
									ลงผิดหมวดสินค้า / 本尊牌不合格在本区展示
									<?php
									}
									?>
								</td>
							</tr>
							<?php
								if ($showment->f(comment_detail) != '') {
								?>
							<tr style="background-color:#6e3d07;">
								<td style="padding-left:20px; width:1px; height:35px; text-align:right; white-space:nowrap;"> เหตุผลเพิ่มเติม </td>
								<td style="padding-left:10px; padding-right:10px; width:1px;"> : </td>
								<td><?=$showment->f(comment_detail)?></td>
							</tr>
							<?php
								}
								?>
							<tr style="background-color:#78440b;">
								<td style="padding-left:20px; width:1px; height:35px; text-align:right; white-space:nowrap;"> เลขที่แสดงความคิดเห็น / 评论意见编号 </td>
								<td style="padding-left:10px; padding-right:10px; width:1px;"> : </td>
								<td><?=$showment->f(comment_id)?></td>
							</tr>
							<tr style="background-color:#6e3d07;">
								<td style="padding-left:20px; width:1px; height:35px; text-align:right; white-space:nowrap;"> วันที่ </td>
								<td style="padding-left:10px; padding-right:10px; width:1px;"> : </td>
								<td><?=date("d F Y",$showment->f(comment_date))?></td>
							</tr>
						</table>
						</td>
					</tr>
					<?php
						}
						?>
				</table>
			</td>
			</tr>
			<tr>
			<td>
				<table width="100%" border="0" cellspacing="0" cellpadding="0">
					<tr>
						<td height="25" bgcolor="#3d2000" style="padding:5px; text-align:center;"><a href="shop_index.php?shop=<?=$dbshop->f(id)?>"><span style="color:#FFF; font-size:16px">สินค้าอื่น ๆ ในร้าน
						<?=$dbshop->f(shopname)?>
						</span></a> <a href="shop_index.php?shop=<?=$dbshop->f(id)?>"><span style="color:#FFF; font-size:16px"> / 店的其它产品</span></a>
						</td>
					</tr>
					<tr>
						<td>
						<?php
							$q="SELECT * FROM `product` WHERE shop_id='".$dbshop->f(id)."' and NOT active = '0' ";
							$p_r=1;
							$db->query($q);              
							$total=$db->num_rows();              
							$q.=" ORDER BY order_num DESC LIMIT 0,30";
							$db->query($q);
							while($db->next_record()){
									// select check comment
									$q="SELECT * FROM `comment` WHERE `comment_product` = '".$db->f(product_id)."' ";
									$comment= new nDB();
									$comment->query($q);
									$comment->next_record();
									$num_rows = $comment->num_rows(); 
							?>
						<table width="100" border="0" align="center" cellpadding="0" cellspacing="0" style="float:left; margin:5px">
							<tr>
								<td align="center">
									<table width="100%" border="0" cellspacing="0" cellpadding="0">
									<tr>
										<!-- <td bgcolor="#000000"><a href="shop_product.php?product_id=<?=$db->f(product_id)?>" target="_blank"><img src="<?=($db->f(pic1)!="")?'/resize/w152-h150/img/amulet/'.$db->f(pic1):"images/clear.gif"?>" alt="" width="152" height="150" border="0" /></a></td> -->
										<td bgcolor="#000000"><a href="shop_product.php?product_id=<?=$db->f(product_id)?>" target="_blank"><img src="<?=($db->f(pic1)!="")?'/img/amulet/'.$db->f(pic1):"images/clear.gif"?>" alt="" width="152" height="150" border="0" /></a></td>
									</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td height="60" valign="top" bgcolor="#666666">
									<table width="95%" border="0" align="center" cellpadding="3" cellspacing="0">
									<tr>
										<td>
											<div style="position:relative;">
												<div class="pravote_container" style="display:none;position:absolute; left:-200px; top:-250px;">
												<table style="width:400px; height:170px; color:#ffcc02; background-color:#311407; border:1px solid #ffcc02; border-collapse:collapse;" border="0" cellpadding="0" cellspacing="0">
													<tr>
														<td style="height:35px; text-align:center; font-weight:bold;"> คะแนนความน่าเชื่อถือสินค้านี้ </td>
													</tr>
													<tr>
														<td style="height:1px; text-align:center;">
															<?php
															if ($db->f(score)>79) {
																if ($db->f(score)>100) {
																	$dbscore = 100;
																}else{
																	$dbscore = $db->f(score);
																}
															$dbscoreprocess = $db->f(score);
															$colorprogress ="#00ff00";
															}elseif ($db->f(score)>29) {
																$dbscore = $db->f(score);
																$dbscoreprocess = $db->f(score);
																$colorprogress ="#F7E81D";      
															}else{
																	if($db->f(score)<0){
																		$dbscore = 0;
																		$dbscoreprocess = 0;
																	}else{
																		$dbscore = $db->f(score);
																		$dbscoreprocess = $db->f(score);
																	}
															$colorprogress = "red";     
															}
															
																// check comment
																if($num_rows==0){
																	?>
															<div class="pra_progressbar_container" style="width:100%;">
															<table style="position:absolute; width:350px; height:27px;" border="0" cellpadding="0" cellspacing="0">
																<tr>
																	<td style="text-align:center; vertical-align:middle; color:#000000;">100 คะแนน / 分数</td>
																</tr>
															</table>
															<div class="pra_progressbar" style="width:100%; height: 26px;background-color:#00ff00;">&nbsp;</div>
															</div>
															<?
															}else{
																?>
															<div class="pra_progressbar_container" style="width:100%;">
															<table style="position:absolute; width:350px; height:27px;" border="0" cellpadding="0" cellspacing="0">
																<tr>
																	<td style="text-align:center; vertical-align:middle; color:#000000;"><?=$dbscore?> คะแนน / 分数</td>
																</tr>
															</table>
															<div class="pra_progressbar" style="width:<?=$dbscoreprocess?>%; height: 26px;background-color:<?=$colorprogress?>;">&nbsp;</div>
															</div>
															<?
															}
															?>
														</td>
													</tr>
													<tr>
														<td style="padding-top:5px; vertical-align:top;">
															<?php
															if($num_rows==0){
																?>
															<div class="box_vote"> สินค้าชิ้นนี้ได้รับรองจากคณะกรรมการเว็บพระเอเชียเรียบร้อยแล้ว ให้คะแนนเต็ม100% <br/><br/>本尊产品已被亚洲佛牌团队佛牌鉴定部给为满分100% </div>
															<?
															}else{
																if ($db->f(score)>=100) {
																	?>
															<div class="box_vote"> สินค้าชิ้นนี้ได้รับรองจากคณะกรรมการเว็บพระเอเชียเรียบร้อยแล้ว ให้คะแนนเต็ม100% <br/><br/>本尊产品已被亚洲佛牌团队佛牌鉴定部给为满分100% </div>
															<?
															}else{
																?>
															<div class="box_vote"> กรุณาตรวดสอบให้แน่ชัดก่อนทำการชื้อขายสิ้นค้าชิ้นนี้ <br/><br/>请各位小心或明确好这尊圣物是否真假后才进行交易 </div>
															<?
															}
															}
															?>
														</td>
													</tr>
												</table>
												</div>
											</div>
											<?php
												// checkcommet befor show
												if($num_rows==0){
												?>
											<img onMouseOver="$(this).parent().find('div:eq(1)').show();" onMouseOut="$(this).parent().find('div:eq(1)').hide();" src="images/light-green.png" border="0" />
											<?
												}else{
												if ($db->f(score)>79) {
													if ($db->f(score)>=100) {
														?>
											<img onMouseOver="$(this).parent().find('div:eq(1)').show();" onMouseOut="$(this).parent().find('div:eq(1)').hide();" src="images/light-green.png" border="0" />
											<?
												}else{
												?>
											<img onMouseOver="$(this).parent().find('div:eq(1)').show();" onMouseOut="$(this).parent().find('div:eq(1)').hide();" src="images/flash-green.gif" border="0" />
											<?
												}
												}elseif ($db->f(score)>29) {
												?>
											<img onMouseOver="$(this).parent().find('div:eq(1)').show();" onMouseOut="$(this).parent().find('div:eq(1)').hide();" src="images/flash-yellow.gif" border="0" />
											<?
												}else{
												?>
											<img onMouseOver="$(this).parent().find('div:eq(1)').show();" onMouseOut="$(this).parent().find('div:eq(1)').hide();" src="images/flash-red.gif" border="0" />
											<?
												}
												}
												?>
											&nbsp; 
											<span style="color:#0CF; font-weight:bold">ID :<?=$db->f(product_id)?></span>
										</td>
									</tr>
									<tr>
										<td height="25">
											<div style="width:145px; height:67px; overflow:hidden;">
												<div style="width:165px; overflow-y:scroll; overflow-x:hidden; height:67px ;">
												<table width="145" cellpadding="1" cellspacing="0">
													<tr>
														<td colspan="2"><a href="shop_product.php?product_id=<?=$db->f(product_id)?>"  title="<?=$db->f(name)?>" > <span style="color:#FFF">
															<?=$db->f(name)?>
															</span> </a>
														</td>
													</tr>
													<? if($detailcn1 != '') { ?>
													<tr>
														<td width="30" style="color:#FFF" valign="top"> 名稱: </td>
														<td width="115" style="color:#FFF" valign="top"><?=$db->f(detailcn1)?></td>
													</tr>
													<? } ?>
													<? if($detailcn5 !='0') { ?>
													<tr>
														<td style="color:#FFF" valign="top"> 几帮: </td>
														<td style="color:#FFF" valign="top"><?php
															$q="SELECT * FROM `catalog_cn` WHERE catalog_id= '$detailcn5' ";
															$dbmix= new nDB(); 
															$dbmix->query($q);
															$dbmix->next_record();
															?>
															<?=$dbmix->f(catalog_name_cn)?>
														</td>
													</tr>
													<? } ?>
													<? if($db->f(detailcn10)!='') { ?>
													<tr>
														<td style="color:#FFF" valign="top"> 高僧: </td>
														<td style="color:#FFF" valign="top"><?=$db->f(detailcn10)?></td>
													</tr>
													<? } ?>
													<? if($detailcn6 != '0') { ?>
													<tr>
														<td style="color:#FFF" valign="top"> 模版: </td>
														<td style="color:#FFF" valign="top"><?php
															$q="SELECT * FROM `catalog_cn` WHERE catalog_id= '$detailcn6' ";
															$dbmix= new nDB(); 
															$dbmix->query($q);
															$dbmix->next_record();
															?>
															<?=$dbmix->f(catalog_name_cn)?>
														</td>
													</tr>
													<? } ?>
													<? if($db->f(detailcn11)!='0') { ?>
													<tr>
														<td style="color:#FFF" valign="top"> 年期: </td>
														<td style="color:#FFF" valign="top"><?php
															$q="SELECT * FROM `catalog_cn` WHERE catalog_id= '".$db->f(detailcn11)."' ";
															$dbmix= new nDB(); 
															$dbmix->query($q);
															$dbmix->next_record();
															?>
															<?=$dbmix->f(catalog_name_cn)?>
														</td>
													</tr>
													<? } ?>
													<? if($db->f(detailcn9)!='') { ?>
													<tr>
														<td style="color:#FFF" valign="top"> 佛寺: </td>
														<td style="color:#FFF" valign="top"><?=$db->f(detailcn9)?></td>
													</tr>
													<? } ?>
												</table>
												</div>
											</div>
										</td>
									</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td height="25" align="center" bgcolor="#333333">
									<table width="100%" cellpadding="0" cellspacing="0">
									<tr>
										<td width="63%" align="center"><span style="color:#FFF;  font-size: 9px">
											<? if ($db->f(status)==1) { ?>
											<span style="color:#09F">พระโชว์ / 展示</span>
											<? } ?>
											<? if ($db->f(status)==2) { ?>
											<span style="color:#090">ให้เช่า / 出售</span>
											<? } ?>
											<? if ($db->f(status)==3) { ?>
											<span style="color:#FF0">เปิดจอง / 预定</span>
											<? } ?>
											<? if ($db->f(status)==4) { ?>
											<span style="color:#FC0">จองแล้ว / 已定</span>
											<? } ?>
											<? if ($db->f(status)==5) { ?>
											<span style="color:#F00">ขายแล้ว / 已出售</span>
											<? } ?>
											</span>
										</td>
										<td width="37%">
											<table width="100%" border="0" cellspacing="0" cellpadding="3">
												<tr>
												<td width="20"><img src="images/view-icon.png" width="20" height="11" /></td>
												<td><span style="color:#FFF">
													<?=$db->f(view_num)?>
													</span>
												</td>
												</tr>
											</table>
										</td>
									</tr>
									</table>
								</td>
							</tr>
						</table>
						<?php } ?>
						</td>
					</tr>
					<tr>
						<td height="30" align="right" style="padding-right:20px"><a href="shop_index.php?shop=<?=$dbshop->f(id)?>"><span style="color:#FC0"> เข้าสู่ร้าน
						<?=$dbshop->f(shopname)?>
						/ 进入商店 </span></a>
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
				<!-- <script type="text/javascript" src="http://hits.truehits.in.th/data/t0031244.js"></script>
				<noscript>
					<a target="_blank" href="http://truehits.net/stat.php?id=t0031244"><img src="http://hits.truehits.in.th/noscript.php?id=t0031244" alt="Thailand Web Stat" border="0" width="14" height="17" /></a>
					<a target="_blank" href="http://truehits.net/">Truehits.net</a>
				</noscript> -->
				<!-- END WEBSTAT CODE -->    
			</td>
			</tr>
		</table>
		<!-- End Save for Web Slices --><script type="text/javascript">
			swfobject.registerObject("FlashID", "9.0.0", "expressInstall.swf");
		</script>
	</body>
</html>
