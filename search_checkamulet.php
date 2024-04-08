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
								<? include('listcheckamulet.php'); ?>
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
															if ($_GET['q']){
															 $q="SELECT * FROM `check_amulet` WHERE amulet_name like '%".$_GET['q']."%' ";
															}
															if ($_GET['name']){
															 $q="SELECT * FROM `check_amulet` WHERE amulet_name like  '%".$_GET['name']."%' order by amulet_id DESC limit 100 ";
															 }
															if (($_GET['q']=='') and ($_GET['name']=='')) {
															 $q="SELECT * FROM `check_amulet` WHERE amulet_name = '' ";	
															}
															 $db= new nDB();
															 $p_r=1;
															 $db->query($q); 
															 $total=$db->num_rows();
															 while($db->next_record()){
														?>  
                                                             <? if ($total > 0) { ?>
																<table width="145" style="float:left; margin:5px; width:145px;" border="0" cellpadding="0" cellspacing="0">
                                                                  <tr>
                                                                          <td align="center">
                                                                                  <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                                                          <tr>
                                                                                                  <td bgcolor="#000000">
                                                                                                          <a href="shop_product.php?product_id=<?=$db->f(product_id)?>">
                                                                                                          <img src="<?=($db->f(amulet_pic)!="")?'/slir/w152-h150/img/checkamulet/'.$db->f(amulet_pic):"images/clear.gif"?>" alt="" width="152" height="150" border="0" />
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
                                                        	<? }?>
                                                            <? if ($total == 0) { ?>
                                                        	<table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                              <tr>
                                                                <td align="center" style="color:#FC0">ไม่พบรายการที่ค้นหา</td>
                                                              </tr>
                                                            </table>
                                                       		 <? } ?>        
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
