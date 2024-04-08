<?php include("global.php"); 
	include("global_counter.php");
	?>
<?php set_page($s_page,$e_page=84); //นำส่วนนี้ิไว้ด้านบน ?>
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
								<td width="731" valign="top">
									<table cellpadding="0" cellspacing="0" width="100%">
									<tr>
										<td>
											<?php
												$dbshop= new nDB();
														$q="SELECT * FROM `member` WHERE active = '2' AND type= '0' ";
												$p_r=1;
														$dbshop->query($q);                           
														$total=$dbshop->num_rows();                           
														$q.=" ORDER BY id DESC  LIMIT $s_page,$e_page";
														$dbshop->query($q);
														while($dbshop->next_record()){
														?>                
											<?php 
												$q="SELECT * FROM `product` WHERE shop_id = '".$dbshop->f(id)."' ";
														$p_r=1;
														$db->query($q);       
												$producttotal=$db->num_rows();     
												?>
											<table width="145" border="0" align="center" cellpadding="0" cellspacing="0" style="float:left; margin:5px; width:145px;">
												<tr>
												<td align="center">
													<table width="90%" border="0" cellspacing="0" cellpadding="0">
														<tr>
															<td bgcolor="#000000">
																<a href="shop_index.php?shop=<?=$dbshop->f(id)?>">
																	<img class="Img_shop" src="<?=($dbshop->f(head2)!="")?'/slir/w169-h160/img/head/'.$dbshop->f(head2):"images/logodefualt.jpg"?>" alt="" width="153" height="150" border="0" />
																</a></td>
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
																<div  style="width:142px;overflow:hidden; white-space:nowrap;text-align: center;" >
																	<span style="color:#FFF"><?=$dbshop->f(shopname)?></span>
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
		</table>
	</body>
</html>
