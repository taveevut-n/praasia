<?php 
include("global.php"); 
include("global_counter.php");
?>
<?php set_page($s_page,$e_page=222); //นำส่วนนี้ิไว้ด้านบน ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>ศูนย์รวมพระเครื่องออนไลน์</title>
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
	<style type="text/css">
		a.link-search{
			word-break: break-word;
			line-height: 17px;
			height: 90px;
			font-size: 12px;
			font-family: helvetica,thonburi,tahoma;
			color: #CEC8C8;
			padding: 3px;
			background: #262017;
			display: block;
			text-align: left;
		}
		.review{
			background: #FFFFFF;
			height: 20px;
			font-size: 11px;
			line-height: 20px;
		}
		.review span{
			color: #DB3401;
			font-weight: bold;
		}
	</style>
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
							<table width="1000" border="0" cellspacing="0" cellpadding="0">
								<tr>
									<td bgcolor="#311407">
										<table width="100%" border="1" cellspacing="0" cellpadding="5" bordercolor="#FF0000" style="border-collapse:">
											<tr>
												<td width="45%" valign="top">
													<table width="400" border="0" cellspacing="0" cellpadding="3">
														
														<td align="center">
															<form  method="get" id="form2">
																<table width="100%" cellpadding="0" cellspacing="0">
																	<tr>
																		<td  style="color:#FC0; font-size:12px;width: 52%!important;">
																			ค้นหาตามรูป / 图片搜索圣物 <span style="border-bottom:1px solid #220b00">
																			</span>
																		</td>
																		<td style="width: 48%!important;" >
																			<input name="keyword" type="text" id="keyword" size="19" placeholder="พิมพ์ชื่อพระ " value="<?php if(isset($_GET['keyword'])){ echo $_GET['keyword']; } ?>" style="height:40px; width:170px" />
																		</td>
																		<td width="66">
																			<input type="submit" id="search" value="Search"  style="height:40px" />
																		</td>
																	</tr>
																</table>
															</form>
														</td>
													</tr>
												</table>
											</td>
											<td width="55%">
												<table width="100%" border="0" cellspacing="0" cellpadding="3">
													<tr>
														<td height="40" align="center"><span style="color:#F00; font-weight:bold; font-size:18px">ค้นหาร้านค้าตามตัวอักษร / 
														搜索商店按字母順序排列 </span>
													</td>
												</tr>
												<tr>
													<td>
														<table width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#009900" style="border-collapse:">
															<tr>
																<td height="20" align="center"><a href="?keyword=ก"><span style="color:#FC0">ก</span></a></td>
																<td align="center"><a href="?keyword=ข"><span style="color:#FC0">ข</span></a></td>
																<td align="center"><a href="?keyword=ค"><span style="color:#FC0">ค</span></a></td>
																<td align="center"><a href="?keyword=ฆ"><span style="color:#FC0">ฆ</span></a></td>
																<td align="center"><a href="?keyword=ง"><span style="color:#FC0">ง</span></a></td>
																<td align="center"><a href="?keyword=จ"><span style="color:#FC0">จ</span></a></td>
																<td align="center"><a href="?keyword=ช" style="color:#FC0">ฉ</a></td>
																<td align="center"><a href="?keyword=ช" style="color:#FC0">ช</a></td>
																<td align="center"><a href="?keyword=ซ" style="color:#FC0">ซ</a></td>
																<td align="center"><a href="?keyword=ฌ" style="color:#FC0">ฌ</a></td>
																<td align="center"><a href="?keyword=ญ" style="color:#FC0">ญ</a></td>
																<td align="center"><a href="?keyword=ฎ" style="color:#FC0">ฎ</a></td>
																<td align="center"><a href="?keyword=ฏ" style="color:#FC0">ฏ</a></td>
																<td align="center"><a href="?keyword=ฐ" style="color:#FC0">ฐ</a></td>
																<td align="center"><a href="?keyword=ฑ" style="color:#FC0">ฑ</a></td>
																<td align="center"><a href="?keyword=ฒ" style="color:#FC0">ฒ</a></td>
																<td align="center"><a href="?keyword=ณ" style="color:#FC0">ณ</a></td>
																<td align="center"><a href="?keyword=ด" style="color:#FC0">ด</a></td>
																<td align="center"><a href="?keyword=ต" style="color:#FC0">ต</a></td>
																<td align="center"><a href="?keyword=ถ" style="color:#FC0">ถ</a></td>
																<td align="center"><a href="?keyword=ท" style="color:#FC0">ท</a></td>
															</tr>
															<tr>
																<td align="center"><a href="?keyword=ธ" style="color:#FC0">ธ</a></td>
																<td height="20" align="center"><a href="?keyword=น" style="color:#FC0">น</a></td>
																<td align="center"><a href="?keyword=บ" style="color:#FC0">บ</a></td>
																<td align="center"><a href="?keyword=ป" style="color:#FC0">ป</a></td>
																<td align="center"><a href="?keyword=ผ" style="color:#FC0">ผ</a></td>
																<td align="center"><a href="?keyword=ฝ" style="color:#FC0">ฝ</a></td>
																<td align="center"><a href="?keyword=พ" style="color:#FC0">พ</a></td>
																<td align="center"><a href="?keyword=ฟ" style="color:#FC0">ฟ</a></td>
																<td align="center"><a href="?keyword=ภ" style="color:#FC0">ภ</a></td>
																<td align="center"><a href="?keyword=ม" style="color:#FC0">ม</a></td>
																<td align="center"><a href="?keyword=ย" style="color:#FC0">ย</a></td>
																<td align="center"><a href="?keyword=ร" style="color:#FC0">ร</a></td>
																<td align="center"><a href="?keyword=ล" style="color:#FC0">ล</a></td>
																<td align="center"><a href="?keyword=ว" style="color:#FC0">ว</a></td>
																<td align="center"><a href="?keyword=ศ" style="color:#FC0">ศ</a></td>
																<td align="center"><a href="?keyword=ษ" style="color:#FC0">ษ</a></td>
																<td align="center"><a href="?keyword=ส" style="color:#FC0">ส</a></td>
																<td align="center"><a href="?keyword=ห" style="color:#FC0">ห</a></td>
																<td align="center"><a href="?keyword=ฬ" style="color:#FC0">ฬ</a></td>
																<td align="center"><a href="?keyword=อ" style="color:#FC0">อ</a></td>
																<td align="center"><a href="?keyword=ฮ" style="color:#FC0">ฮ</a></td>
															</tr>
															<tr>
																<td height="20" align="center"><a href="?keyword=A" style="color:#FC0">A</a><a href="?keyword=ฏ"></a></td>
																<td align="center"><a href="?keyword=B" style="color:#FC0">B</a><a href="?keyword=ฐ"></a></td>
																<td align="center"><a href="?keyword=C" style="color:#FC0">C</a><a href="?keyword=ฑ"></a></td>
																<td align="center"><a href="?keyword=D" style="color:#FC0">D</a><a href="?keyword=ฒ"></a></td>
																<td align="center"><a href="?keyword=E" style="color:#FC0">E</a><a href="?keyword=ณ"></a></td>
																<td align="center"><a href="?keyword=F" style="color:#FC0">F</a><a href="?keyword=ด"></a></td>
																<td align="center"><a href="?keyword=G" style="color:#FC0">G</a></td>
																<td align="center"><a href="?keyword=H" style="color:#FC0">H</a></td>
																<td align="center"><a href="?keyword=I" style="color:#FC0">I</a></td>
																<td align="center"><a href="?keyword=J" style="color:#FC0">J</a></td>
																<td align="center"><a href="?keyword=K" style="color:#FC0">K</a></td>
																<td align="center"><a href="?keyword=L" style="color:#FC0">L</a></td>
																<td align="center"><a href="?keyword=M" style="color:#FC0">M</a></td>
																<td align="center"><a href="?keyword=N" style="color:#FC0">N</a></td>
																<td align="center"><a href="?keyword=O" style="color:#FC0">O</a></td>
																<td align="center"><a href="?keyword=P" style="color:#FC0">P</a></td>
																<td align="center"><a href="?keyword=Q" style="color:#FC0">Q</a></td>
																<td align="center"><a href="?keyword=R" style="color:#FC0">R</a></td>
																<td align="center"><a href="?keyword=S" style="color:#FC0">S</a></td>
																<td align="center"><a href="?keyword=T" style="color:#FC0">T</a></td>
																<td align="center"><a href="?keyword=U" style="color:#FC0">U</a></td>
															</tr>
															<tr>
																<td height="20" align="center"><a href="?keyword=V" style="color:#FC0">V</a><a href="?keyword=ต"></a></td>
																<td align="center"><a href="?keyword=W" style="color:#FC0">W</a><a href="?keyword=ถ"></a></td>
																<td align="center"><a href="?keyword=X" style="color:#FC0">X</a><a href="?keyword=ท"></a></td>
																<td align="center"><a href="?keyword=Y" style="color:#FC0">Y</a><a href="?keyword=ธ"></a></td>
																<td align="center"><a href="?keyword=Z" style="color:#FC0">Z</a><a href="?keyword=น"></a></td>
																<td align="center"></td>
																<td align="center">&nbsp;</td>
																<td align="center">&nbsp;</td>
																<td align="center">&nbsp;</td>
																<td align="center">&nbsp;</td>
																<td align="center">&nbsp;</td>
																<td align="center">&nbsp;</td>
																<td align="center">&nbsp;</td>
																<td align="center">&nbsp;</td>
																<td align="center">&nbsp;</td>
																<td align="center">&nbsp;</td>
																<td align="center">&nbsp;</td>
																<td align="center">&nbsp;</td>
																<td align="center">&nbsp;</td>
																<td align="center">&nbsp;</td>
																<td align="center">&nbsp;</td>
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
					</table>
				</td>
			</tr>
			<tr>
				<td style="background:url(images/bg.jpg) repeat-y;">
					<table width="100%" cellpadding="0" cellspacing="0" border="0">
						<tr>
							<td style="padding-left:5px;padding-right:5px">
								<?php

								if (isset($_GET['keyword'])) {
									$q="SELECT * FROM `product_key` WHERE proky_keyword like  '%".$_GET['keyword']."%' ";
								}else{
									$q="SELECT * FROM `product_key`  ";
								}

								$p_r=1;
								$db->query($q);             
								$total=$db->num_rows();             
								$q.=" ORDER BY proky_id DESC LIMIT $s_page,$e_page";
								$db->query($q);
								while($db->next_record()){
									?>              
									<table width="130" height="250" style="float:left; margin:5px;" border="0" cellpadding="0" cellspacing="0">
										<tr>
											<td align="center">
												<table width="100%" border="0" cellspacing="0" cellpadding="0">
													<tr>
														<td align="center" bgcolor="#000000" style="padding: 7px;">
															<a href="search_img.php?shopimg=<?=urlencode($db->f(proky_keyword))?>&amp;v=<?=$db->f(proky_id)?>&amp;at=img">
																<img src="<?=($db->f(proky_file90)!="")?"product_key/resize90/".$db->f(proky_file90):"../images/clear.gif"?>" width="90" height="90"  border="0" />
															</a>
														</td>
													</tr>
													<tr>
														<td align="center" bgcolor="#000000" valign="top" height="40">
															<a class="link-search" href="search_product.php?q=<?=urlencode($db->f(proky_keyword))?>&amp;v=<?=$db->f(proky_id)?>&amp;at=img">
																<?=$db->f(proky_name)?>
															</a>
														</td>
													</tr>
													<tr>
														<td align="center">
															<div class="review">
																จำนวนผู้เข้าชม <span><?=$db->f(proky_count)?></span>
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
				<td height="40"></td>
			</tr>
			<tr>
				<td height="30" align="center" bgcolor="#000000" ><?php  sh_page($total,$s_page,$e_page,$chk_page,Previous,Next,"#999999","#FFCC00"); // นำไปวางในตำแหน่งที่ต้องการแสดง ?>;</td>
			</tr>
		</table>
	</td>
</tr>
<tr>
	<td align="center">
		<?php include('footer.php');?>
	</td>
</tr>
</table>
</body>
</html>
