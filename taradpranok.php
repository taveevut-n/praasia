<?php include "global.php";
$q = "UPDATE `counter` SET `counter` = `counter`+1 WHERE `id` ='1' ";
$db->query($q);
?>
<?php set_page($s_page, $e_page = 282); //นำส่วนนี้ิไว้ด้านบน ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
		<head>
				<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
				<title>ศูนย์รวมพระเครื่องออนไลน์</title>
				<META name=description content="ศนย์พระเครื่อง เปิดร้านพระออนไลน์" >
				<meta name="keywords" content="ศูนย์พระเครื่องภาคใต้, ศูนย์พระเครื่องภาคเหนือ, ศูนย์พระเครื่องกรุงเทพ, ศูนย์พระเครื่องอีสาน"/>
				<link rel="icon" href="/favicon.ico" type="image/x-icon" />
				<?php include "index.css";?>
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
														<td style="background:url(images/bg.jpg) repeat-y; padding-left:5px">
																<table width="100%" cellpadding="0" cellspacing="0" border="0">
																		<tr>
																				<td valign="top" style="padding-left:20px">
																						<table width="95%" border="0" cellspacing="0" cellpadding="0">
																								<tr>
																										<td height="500" valign="top" bgcolor="#311407">
																												<table width="100%" border="0" align="center" cellpadding="0" cellspacing="3" bordercolor="#FFFFFF">
																														<tr class="bh">
																																<td width="32%" height="25" align="center" bgcolor="#4d1403" class="style11" style="color:#FC0" >ภาพ</td>
																																<td height="25" align="center" bgcolor="#4d1403" class="style11" style="color:#FC0" >รายละเอียด</td>
																														</tr>
																														<?php
$q = "SELECT * FROM `taradpranok` WHERE 1 ORDER BY banner_id DESC";
$db->query($q);
static $v = 1;
while ($db->next_record()) {
    ?>
																														<tr bgcolor="<?=($v % 2 == 0) ? "#F8F8F8" : "#FFFFFF"?>">
																																<td height="110" align="left" bgcolor="#3c1204" style="padding-left:10px" ><a href="<?=$db->f(banner_url)?>" target="_blank"><img src="/img/banner/<?=$db->f(banner_img)?>" width="274" height="100" /></a></td>
																																<td width="68%" align="left" bgcolor="#3c1204" style="color:#FC0"><?=$db->f(banner_detail)?></td>
																														</tr>
																														<?php $v++;}?>
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
								<td>
									<?php include 'footer.php';?>
								</td>
						</tr>
				</table>
		</body>
</html>
