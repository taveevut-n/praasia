<?php include("global.php"); ?>
<?php set_page($s_page,$e_page=282); //นำส่วนนี้ิไว้ด้านบน ?>
<? if ($_GET['member']) {
	$_SESSION['register_id'] = $_GET['member'];
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>ศูนย์รวมพระเครื่องออนไลน์</title>
		<META name=description content="ศนย์พระเครื่อง เปิดร้านพระออนไลน์" >
		<meta name="keywords" content="ศูนย์พระเครื่องภาคใต้, ศูนย์พระเครื่องภาคเหนือ, ศูนย์พระเครื่องกรุงเทพ, ศูนย์พระเครื่องอีสาน"/>
		<link rel="icon" href="/favicon.ico" type="image/x-icon" />
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
								<table width="100%" cellpadding="0" cellspacing="0" border="0">
									<tr>
										<td style="padding-left:5px;padding-right:5px">
											<table width="100%" border="0" cellspacing="0" cellpadding="0">
												<tr>
													<!-- <td width="262" valign="top">
														left_search
													</td> -->
													<td height="500" valign="top" bgcolor="#311407">
														<table width="100%" border="0" cellspacing="0" cellpadding="10">
															<tr>
																<td align="center"><span style="font-size:14px; font-weight:bold; color:#FC0">กติกาการใช้งานเว็บไซต์ / 公告与条例 / Policy</span></td>
															</tr>
															<?php 
																$q="SELECT * FROM `policy` WHERE 1 ";
																$dbnews= new nDB();
																$dbnews->query($q);
																$dbnews->next_record();
																 ?>
															<tr>
																<td><?=$dbnews->f(detail)?></td>
															</tr>
															<tr>
																<td align="center"><label style="cursor: pointer;"><input id="rdo_accept" name="rdo_accept" type="radio" value="acceptregister" onClick="checkaccept();" />
																	<span style="color:#FC0">ยอมรับเงื่อนไข / 接受</span></label>
																	&nbsp;<label style="cursor: pointer;"><input id="rdo_reject" name="rdo_accept" type="radio" value="rejectregister" onClick="checkaccept();" checked="checked" />
																	<span style="color:#FC0"> ไม่ยอมรับเงื่อนไข / 不接受</span></label>
																</td>
															</tr>
															<tr>
																<td align="center">
                                                                	<input type="hidden" value="<?=$_SESSION['register_id']?>" name="register_id" />
                                                                    <? if ($_SESSION['register_id']) { ?>
                                                                    	<input type="submit" id="agree" name="agree" value="ยืนยันการสมัครสมาชิก / 确定" disabled="disabled" onClick="window.location='register.php?register_id=<?=$_SESSION['register_id']?>'" style="cursor:pointer;"/>
                                                                    <? } else { ?>
																		<input type="submit" id="agree" name="agree" value="ยืนยันการสมัครสมาชิก / 确定" disabled="disabled" onClick="window.location='register.php'" style="cursor:pointer;"/>
																	<? } ?>
																	<script type="text/javascript">
																		function swapcondition(value)
																		{
																			document.getElementById("rdo_reject").checked=true;
																			document.getElementById("agree").disabled=true;
																			document.getElementById("condition_member").style.display="none";
																			document.getElementById("condition_website").style.display="block";
																			document.getElementById("agree").value="สมัครสมาชิกพร้อมสมัครเปิดเว็บไซต์";
																		}
																		function checkaccept()
																		{
																			if(document.getElementById("rdo_accept").checked==true){
																				document.getElementById("agree").disabled=false;
																			}else{
																				document.getElementById("agree").disabled=true;
																			}
																		}
																	</script>
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
					</table>
				</td>
			</tr>
			<tr>
				<td>
					<? include('footer.php');?>
				</td>
			</tr>
			<tr>
				<td>
					<!--BEGIN WEB STAT CODE-->
					<script type="text/javascript" src="http://hits.truehits.in.th/data/t0031244.js"></script>
					<noscript>
						<a target="_blank" href="http://truehits.net/stat.php?id=t0031244"><img src="http://hits.truehits.in.th/noscript.php?id=t0031244" alt="Thailand Web Stat" border="0" width="14" height="17" /></a>
						<a target="_blank" href="http://truehits.net/">Truehits.net</a>
					</noscript>
					<!-- END WEBSTAT CODE -->    
				</td>
			</tr>
		</table>
	</body>
</html>
