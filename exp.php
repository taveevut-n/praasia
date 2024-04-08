<?php include("global.php"); 
include("global_counter.php");
?>
<?php set_page($s_page,$e_page=80); //นำส่วนนี้ิไว้ด้านบน ?>
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
						<td style="background:url(images/bg.jpg) repeat-y; ">
							<table width="100%" cellpadding="0" cellspacing="0">
								<tr>
									<td width="1000" valign="top">
										<table cellpadding="0" cellspacing="0" width="100%">
											<tr>
												<td height="30" align="center" bgcolor="#4d1403" style="color:#FC0">ประสบการณ์พระเครื่อง</td>
											</tr>
											<tr>
												<td>
													<?php
													$dbgeji= new nDB();
													$q="SELECT * FROM `exp` WHERE 1 AND pic1 IS NOT NULL";
													$p_r=1;
													$dbgeji->query($q);              
													$total=$dbgeji->num_rows();              
													// $q.=" ORDER BY exp_id DESC  LIMIT $s_page,$e_page";
													$dbgeji->query($q);
													while($dbgeji->next_record()){
														if ($dbgeji->f(pic1) ==''  ) {
															continue;
														}
														if (file_exists('img/exp/'.$dbgeji->f(pic1))) {
														} else {
															continue;
														}
														?>
														<table width="150" border="0" align="center" cellpadding="0" cellspacing="0" style="float:left; margin:5px">
															<tr>
																<td align="center">
																	<table width="90%" border="0" cellspacing="0" cellpadding="0">
																		<tr>
																			<td bgcolor="#000000"><a href="detail_exp.php?exp_id=<?=$dbgeji->f(exp_id)?>">
																				
																				<!-- <img src="<?=($dbgeji->f(pic1)!="")?'/slir/w150-h150/img/exp/'.$dbgeji->f(pic1):"images/logodefualt.jpg"?>" alt="" width="150" height="150" border="0" /></a></td> -->
																				<img src="<?=($dbgeji->f(pic1)!="")?'/img/exp/'.$dbgeji->f(pic1):"images/logodefualt.jpg"?>" alt="" width="150" height="150" border="0" /></a></td>
																			</tr>
																			<tr>
																				<td height="30" align="center" bgcolor="#000000" style="color:#FFF; font-size:12px">
																					<div style="width:149px; height:80px; overflow:hidden;">
																						<div style="width:169px; overflow-y:scroll; overflow-x:hidden; height:80px ;">
																							<?=$dbgeji->f(topic)?>

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
												<tr>
													<td height="30" align="center" ><?php  sh_page($total,$s_page,$e_page,$chk_page,Previous,Next,"#999999","#FFCC00"); // นำไปวางในตำแหน่งที่ต้องการแสดง ?>;</td>
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
