<?php include("global.php"); 
		$q = "UPDATE `counter` SET `counter` = `counter`+1 WHERE `id` ='1' ";
		$db->query($q);
		?>
<?php set_page($s_page,$e_page=282); //นำส่วนนี้ิไว้ด้านบน ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
		<head>
				<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
				<title>ศูนย์รวมพระเครื่องออนไลน์</title>
				<META name=description content="ศนย์พระเครื่อง เปิดร้านพระออนไลน์" >
				<meta name="keywords" content="ศูนย์พระเครื่องภาคใต้, ศูนย์พระเครื่องภาคเหนือ, ศูนย์พระเครื่องกรุงเทพ, ศูนย์พระเครื่องอีสาน"/>
				<link rel="icon" href="/favicon.ico" type="image/x-icon" />
				<?php include("index.css"); ?>
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
																<table width="100%" cellpadding="0" cellspacing="0" border="0">
																		<tr>
																				<td valign="top" bgcolor="#000000">
																						<table width="762" border="0" align="center" cellpadding="0" cellspacing="0">
																													<?php 
																																$q="SELECT * FROM `contact` WHERE 1 ";
																																$dbnews= new nDB();
																																$dbnews->query($q);
																																$dbnews->next_record();
																																 ?>                                                                                        
																							<tr>
																										<td valign="top" colspan="2" bgcolor="#000000" align="center"><?=$dbnews->f(detail)?></td>
																								</tr>
																								<tr>
																										<td valign="top" colspan="2" bgcolor="#000000" align="center"><img src="images/paper_condition.jpg" width="600"/></td>
																								</tr>
																								<tr>
																										<td valign="top" bgcolor="#000000"><img src="images/images/contact_01.jpg" width="381" height="292" /></td>
																										<td valign="top" bgcolor="#000000"><img src="images/images/contact_02.jpg" width="381" height="292" /></td>
																								</tr>
																								<tr>
																										<td valign="top" bgcolor="#000000"><img src="images/images/contact_03.jpg" width="381" height="261" /></td>
																										<td valign="top" bgcolor="#000000"><img src="images/images/contact_04.jpg" width="381" height="261" /></td>
																								</tr>
																								<tr>
																										<td valign="top" bgcolor="#000000"><img src="images/images/contact_05.jpg" width="381" height="260" /></td>
																										<td valign="top" bgcolor="#000000"><img src="images/images/contact_06.jpg" width="381" height="260" /></td>
																								</tr>
																								<tr>
																										<td valign="top" bgcolor="#000000"><img src="images/images/contact_07.jpg" width="381" height="166" /></td>
																										<td valign="top" bgcolor="#000000"><img src="images/images/contact_08.jpg" width="381" height="166" /></td>
																								</tr>
																								<tr>
																										<td valign="top" bgcolor="#000000"><img src="images/images/contact_09.jpg" width="381" height="301" /></td>
																										<td valign="top" bgcolor="#000000"><img src="images/images/contact_10.jpg" width="381" height="301" /></td>
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
										<?php include('footer.php');?>   
								</td>
						</tr>
				</table>
		</body>
</html>
