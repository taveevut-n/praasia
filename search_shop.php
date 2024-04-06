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
							<td style="background:url(images/bg.jpg) repeat-y;">
								<table width="100%" cellpadding="0" cellspacing="0">
									<tr>
										<!-- <td width="262" valign="top">
											left_search
										</td> -->
										<td style="padding-left:5px;padding-right:5px">
											<table cellpadding="0" cellspacing="0" width="100%">
												<tr>
													<td>
														<?php
															if (isset($_GET['shop'])) {
															 $q="SELECT * FROM `member` WHERE shopname like '%".$_GET['shop']."%' AND active = 2 ";
															}
															$dbshop= new nDB();
															$p_r=1;
																	 $dbshop->query($q);                            
																	 $total=$dbshop->num_rows();                            
																	 $q.=" ORDER BY id DESC LIMIT 0,100";
																	 $dbshop->query($q);
																	 while($dbshop->next_record()){
																	 ?>             
														<?php 
															$q="SELECT * FROM `product` WHERE shop_id = '".$dbshop->f(id)."' ";
																	 $p_r=1;
																	 $db->query($q);                        
																	 $producttotal=$db->num_rows(); 
															?>
														<table width="168" border="0" align="center" cellpadding="0" cellspacing="0" style="float:left; margin:5px">
															<tr>
																<td align="center">
																	<table width="90%" border="0" cellspacing="0" cellpadding="0">
																		<tr>
																			<td bgcolor="#000000"><a href="shop_index.php?shop=<?=$dbshop->f(id)?>"><img src="<?=($dbshop->f(head2)!="")?'/resize/w169-h160/img/head/'.$dbshop->f(head2):"images/logodefualt.jpg"?>" alt="" width="169" height="160" border="0" /></a></td>
																		</tr>
																	</table>
																</td>
															</tr>
															<tr>
																<td valign="top" bgcolor="#666666">
																	<table width="100%" border="0" cellspacing="0" cellpadding="3">
																		<tr>
																			<td height="20">
																				<a href="shop_product.php?product_id=<?=$db->f(product_id)?>">
																					<div  style="width:160px; overflow:hidden; white-space:nowrap;" >
																						<span style="color:#FFF">ร้าน<?=$dbshop->f(shopname)?></span>
																					</div>
																				</a>
																			</td>
																		</tr>
																		<tr>
																			<td height="20" align="left"><span style="color:#FFF">ผู้เข้าชม : <?=$dbshop->f(view_num)?> คน</span></td>
																		</tr>
																	</table>
																</td>
															</tr>
															<tr>
																<td height="25" align="center" bgcolor="#333333"><span style="color:#FFF">จำนวนสินค้า <?=$producttotal?> ชิ้น</span></td>
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
