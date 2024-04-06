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
															<? include('listshop.php'); ?>
														</td>
												</tr>
                                                <tr>
                                                	<td height="50" bgcolor="#FFCC00" align="center">
                                                    <form method="post" action="search_list_certificate.php">
                                                    	<table width="100%" border="0" cellspacing="0" cellpadding="3">
                                                          <tr>
                                                            <td align="center">
                                                            ค้นหาพระเครื่องที่ออกบัตร : <input type="text" value="" name="q" style="width:60%" /> <input name="submit" type="submit" id="submit" value="Search" />
                                                            </td>
                                                          </tr>
                                                        </table>
                                                        </form>
                                                    </td>
                                                </tr>
												<tr>
														<td style="background:url(images/bg.jpg) repeat-y;">
																<table width="100%" cellpadding="0" cellspacing="0" border="0">
																		<tr>
																			<td height="56" align="center" style="background:#FC3 url(images/tab.jpg) no-repeat; border-top:3px solid #960; font-size:16px">
																				<span style="font-size: 16px; color: #a80804; font-weight:bold">หมวดหมู่ใหญ่หรือตามภาค / 泰国部级佛牌分类区</span>
																			</td>
																		</tr>
																		<tr>
																			<td style="padding-left:5px;padding-right:5px;background:#000;padding-bottom: 100px;">
																				<style type="text/css">
																					a.text-linkmain,a.text-linkmain:visited,a.text-linkmain:link{
																						color: #fff;
																						text-decoration: underline;
																						font-size: 12px;
																					}
																					.table-catdisplay{
																						float: left;
																						width: 50%;
																					}
																				</style>
																				<table width="100%" cellpadding="3" cellspacing="0">
																					<?php
																					$q = mysql_query("select * from catalog_cert where top_id = 0 order by catalog_id asc");
																					while ( $main = mysql_fetch_array($q)) {
																						?>
																					<tr>
																						<td>
																							<a><h3 style="color: #E5CB15;"><?php echo $main['catalog_name'];?> / <?php echo $main['catalog_name_cn'];?></h3></a>
																							<?php
																							$qcat = mysql_query("select * from catalog_cert where top_id = ".$main['catalog_id']." order by catalog_id asc");
																							while ( $category = mysql_fetch_array($qcat)) {
																								?>
																								<table cellpadding="3" cellspacing="0" class="table-catdisplay">
																									<tr>
																										<td width="1" style="color: #fff;font-size: 20px;padding-left: 20px;">•</td>
																										<td>
																											<a class="text-linkmain" href="list_certificate.php?c=<?php echo $category['catalog_id'];?>&g=<?php echo $main['catalog_id'];?>">
																												<?php echo $category['catalog_name'];?></br><?php echo $category['catalog_name_cn'];?>
																											</a>
																										</td>
																									</tr>
																								</table>
																								<?php 
																							}
																							?>
																						</td>
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
								<td align="center">
										<?php include('footer.php');?>
								</td>
						</tr>
				</table>
		</body>
</html>
