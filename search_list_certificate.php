<?php include("global.php"); 
		include("global_counter.php");
		
		if ($_POST['q']) {
			$_SESSION['search_q'] = $_POST['q'];
		}
		
		
		?>
<?php set_page($s_page,$e_page=120); //นำส่วนนี้ิไว้ด้านบน ?>
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
                                                            ค้นหาพระเครื่องที่ออกบัตร : <input type="text" value="<?=$_SESSION['search_q']?>" name="q" style="width:60%" /> <input name="submit" type="submit" id="submit" value="Search" />
                                                            </td>
                                                          </tr>
                                                        </table>
                                                        </form>
                                                    </td>
                                                </tr>                                                
												<tr>
														<td style="/*background:url(images/bg.jpg) repeat-y;*/">
																<table width="100%" cellpadding="0" cellspacing="0" border="0">
																		<tr>
																			<td width="305px" valign="top" style="border: 1px #fff solid;">
																					<style type="text/css">
																						.box-product{
																							float:left; 
																							margin:5px 9px 0;
																						}
																						a.text-linkgroup,a.text-linkgroup:visited,a.text-linkgroup:link{
																							color: #fff;
																							text-decoration: underline;
																							font-size: 12px;
																						}
																					</style>
																					<table width="100%" cellpadding="3" cellspacing="0">
																							<?php
																							$q = mysql_query("select * from catalog_cert where top_id = '0' order by catalog_id asc");
																							while ( $main = mysql_fetch_array($q)) {
																								?>
																							<tr>
																								<td colspan="2"><a><h3 style="color: #E5CB15;"><?php echo $main['catalog_name'];?></br><?php echo $group['catalog_name_cn'];?></h3></a></td>
																							</tr>
																								<?php
																								$qcat = mysql_query("select * from catalog_cert where top_id = ".$main['catalog_id']." order by catalog_id asc");
																								while ( $category = mysql_fetch_array($qcat)) {
																									?>
																							<tr>
																								<td width="1" style="color: #fff;font-size: 20px;padding-left: 20px;">•</td>
																								<td>
																									<a class="text-linkgroup" href="?c=<?php echo $category['catalog_id'];?>&g=<?php echo $main['top_id'];?>">
																										<?php echo $category['catalog_name'];?></br><?php echo $category['catalog_name_cn'];?>
																									</a>
																								</td>
																							</tr>
																									<?php 
																								}
																							}
																							?>
																					</table>
																				</td>
																				<td valign="top" align="left" style="padding-left:5px;padding-right:5px">
																						<?php 
																							$rcat = mysql_fetch_array(mysql_query("select * from catalog_cert where catalog_id = '".$_GET['c']."' "));
																							$rmain = mysql_fetch_array(mysql_query("select * from catalog_cert where top_id = '".$_GET['g']."' "));
																						?>
																						<div style="clear:both;height:30px;"></div>
																						<?php
																								$q="SELECT * FROM `datacert` WHERE datacert_amulet like '%".$_SESSION['search_q']."%' ";
																								$p_r=1;
																								$db->query($q);             
																								$total=$db->num_rows();             
																								$q.=" ORDER BY datacert_id ";
																								$db->query($q);
																								while($db->next_record()){
																								?>              
																						<table width="145" class="box-product" border="0" cellpadding="0" cellspacing="0">
																								<tr>
																										<td align="center">
																												<table width="100%" border="0" cellspacing="0" cellpadding="0">
																														<tr>
																																<td bgcolor="#000000">
																																		
																																		<img src="<?=($db->f(datacert_pic)!="")?'/resize/w152-h150/img/datacertificate/'.$db->f(datacert_pic):"images/clear.gif"?>" alt="" width="152" height="150" border="0" />
																																	
																																</td>
																														</tr>
																												</table>
																										</td>
																								</tr>
																								<tr>
																										<td height="60" valign="top" bgcolor="#666666">
                                                                                                        <div style="width:145px; overflow:hidden; word-break:break-all; height:65px ;">
																									    <?=$db->f(datacert_amulet)?>
                                                                                                        </div>
                                                                                                        </td>
																								</tr>
																						</table>
																						<?php } ?> 
																				</td>
																		</tr>
																		<tr>
																			<td>&nbsp;</td>
																			<td height="30" align="center" bgcolor="#000000" ><?php  sh_page($total,$s_page,$e_page,$chk_page,Previous,Next,"#999999","#FFCC00"); // นำไปวางในตำแหน่งที่ต้องการแสดง ?>;</td>
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
