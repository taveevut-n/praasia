<?php include("global.php"); 
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
															<? include('listcheckamulet.php'); ?>
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
																								$q="SELECT * FROM `check_amulet` WHERE 1 ORDER BY amulet_id DESC";
																								$db->query($q);
																								while($db->next_record()){
																								?>              
																						<table width="145" style="float:left; margin:5px; width:145px;" border="0" cellpadding="0" cellspacing="0">
																								<tr>
																										<td align="center">
																												<table width="100%" border="0" cellspacing="0" cellpadding="0">
																														<tr>
																																<td bgcolor="#000000">
																																		<a href="shop_product.php?product_id=<?=$db->f(product_id)?>">
																																		<img src="<?=($db->f(amulet_pic)!="")?'/resize/w152-h150/img/checkamulet/'.$db->f(amulet_pic):"images/clear.gif"?>" alt="" width="152" height="150" border="0" />
																																		</a>
																																</td>
																														</tr>
																												</table>
																										</td>
																								</tr>
																								<tr>
																										<td height="60" valign="top" bgcolor="#666666" style="padding:5px; color:#FC0">
																												<?=$db->f(amulet_name)?>
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
