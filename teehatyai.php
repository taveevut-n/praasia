<? include('global.php');?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>ตี๋หาดใหญ่ ให้เช่าพระเครื่อง หลวงปู่ทวด วัดช้างให้ อ.ทิม อ.เจิม ซ่อมพระ</title>
		<style type="text/css">
			body {
				margin-left: 0px;
				margin-top: 0px;
				margin-right: 0px;
				margin-bottom: 0px;
				background-color: #000;
				background-image: url(images/bg.jpg);
				background-attachment: fixed;
				background-position: top center;
			}
			a:link {
				text-decoration: none;
			}
			a:visited {
				text-decoration: none;
			}
			a:hover {
				text-decoration: none;
			}
			a:active {
				text-decoration: none;
			}
		</style>
	</head>
	<body>
		<table width="1000" border="0" cellspacing="0" cellpadding="0" align="center">
			<tr>
				<td colspan="2"><img src="images/defualt.jpg" width="1000" height="271" /></td>
			</tr>
			<tr>
				<td colspan="2"><img src="images/pramenu.jpg" width="1000" height="48" border="0" usemap="#Map" /></td>
			</tr>
			<tr>
			<td width="225" valign="top" bgcolor="#FFFFFF">
				<table width="100%" border="0" cellspacing="0" cellpadding="0">
					<tr>
						<td style="padding-top:5px">
						<table width="100%" cellpadding="0" cellspacing="0" border="0">
							<?php
								$q="SELECT * FROM `pra_banner` WHERE 1 ORDER BY banner_id  ";
								$db->query($q);
								while($db->next_record()){
								?>
							<?
								if($db->f(banner_url)==''){
											$url="detail_prabanner.php?banner_id=".$db->f(banner_id);
											$tar=$db->f(banner_target);
											if($tar=='1'){
															$target="_Blank";
											}else{
															$target="_parent";
											}
								}else{
											$url=$db->f(banner_url);
								}
								?>
							<tr>
								<td align="center" style="padding:2px"><a href="<?=$url?>" target="_blank"><img src="resize/w180/pra/img/banner/<?=$db->f(banner_img)?>" width="180" /></a></td>
							</tr>
							<? } ?>
						</table>
						</td>
					</tr>
					<tr>
						<td>
						<table width="100%" border="0" cellspacing="0" cellpadding="0">
							<tr>
								<td><img src="images/bh-cat.jpg" width="225" height="49" /></td>
							</tr>
							<?php
								$q="SELECT * FROM `pra_catalog` WHERE id_top_catalog=0 ORDER BY id_sub_catalog";
								$db->query($q);
								while($db->next_record()){
								?>
							<tr>
								<td>
									<table width="100%" border="0" cellspacing="0" cellpadding="0">
									<?php if($db->f(show_sub)==0){ ?>
									<tr>
										<td style="background:url(images/bg-cat.jpg) no-repeat #000; padding-left:35px" height="35"><a href="show_pra.php?cat=<?=$db->f(id_sub_catalog)?>"><span style="color:#FFF; font-size:14px">
											<?=$db->f(name_catalog)?>
											</span></a>
										</td>
									</tr>
									<? } ?>
									<?php if($db->f(show_sub)==1){ ?>
									<tr>
										<td>
											<table width="100%" border="0" cellspacing="0" cellpadding="3">
												<tr>
												<td height="30" style="background:url(images/bg-cat2.jpg) #000 no-repeat; padding-left:35px"><span style="color:#FFF; font-size:14px">
													<?=$db->f(name_catalog)?>
													</span>
												</td>
												</tr>
												<?php  
												$q1="SELECT * FROM `pra_catalog` WHERE id_top_catalog=".$db->f(id_sub_catalog)." ";
												$db5=new nDB();
												$db5->query($q1);
												if($db5->num_rows()!=0){
												while($db5->next_record()){
												?>
												<tr>
												<td height="25" style="background:url(images/bg-cat3.jpg) #bbb no-repeat; padding-left:30px"><a href="show_pra.php?cat=<?=$db5->f(id_sub_catalog)?>"><span style="font-size:12px; color:#000">
													<?=$db5->f(name_catalog)?>
													</span></a>
												</td>
												</tr>
												<?php }} ?>
											</table>
										</td>
									</tr>
									<?php } ?>
									</table>
								</td>
							</tr>
							<?php } ?>
						</table>
						</td>
					</tr>
					<tr>
						<td>
						<table width="100%" border="0" cellspacing="0" cellpadding="0">
							<tr>
								<td><img src="images/bh-cat2.jpg" width="225" height="49" /></td>
							</tr>
							<?php
								$q="SELECT * FROM `pra_catalog2` WHERE id_top_catalog=0 ORDER BY id_sub_catalog";
								$db->query($q);
								while($db->next_record()){
								?>
							<tr>
								<td>
									<table width="100%" border="0" cellspacing="0" cellpadding="0">
									<?php if($db->f(show_sub)==0){ ?>
									<tr>
										<td style="background:url(images/bg-cat.jpg) no-repeat #000000; padding-left:35px" height="35"><a href="show_pra2.php?cat=<?=$db->f(id_sub_catalog)?>"><span style="color:#FFF; font-size:14px">
											<?=$db->f(name_catalog)?>
											</span></a>
										</td>
									</tr>
									<? } ?>
									<?php if($db->f(show_sub)==1){ ?>
									<tr>
										<td>
											<table width="100%" border="0" cellspacing="0" cellpadding="3">
												<tr>
												<td height="30" style="background:url(images/bg-cat2.jpg) #000 no-repeat; padding-left:35px"><span style="color:#FFF; font-size:14px">
													<?=$db->f(name_catalog)?>
													</span>
												</td>
												</tr>
												<?php  
												$q1="SELECT * FROM `pra_catalog2` WHERE id_top_catalog=".$db->f(id_sub_catalog)." ";
												$db5=new nDB();
												$db5->query($q1);
												if($db5->num_rows()!=0){
												while($db5->next_record()){
												?>
												<tr>
												<td height="25" style="background:url(images/bg-cat3.jpg) #bbb no-repeat; padding-left:30px"><a href="show_pra2.php?cat=<?=$db5->f(id_sub_catalog)?>"><span style="font-size:12px; color:#000">
													<?=$db5->f(name_catalog)?>
													</span></a>
												</td>
												</tr>
												<?php }} ?>
											</table>
										</td>
									</tr>
									<?php } ?>
									</table>
								</td>
							</tr>
							<?php } ?>
						</table>
						</td>
					</tr>
					<tr>
						<td>
						<table width="100%" cellpadding="0" cellspacing="0">
							<tr>
								<td style="padding:3px" bgcolor="#CCCCCC"><span style="font-size:14px; font-weight:bold">บอทมาเยือนล่าสุด</span></td>
							</tr>
							<tr>
								<td style="padding:3px" bgcolor="#CCCCCC"><span style="color:#000">
									<? include('bot.php'); ?>
									</span>
								</td>
							</tr>
							<tr>
								<td style="padding:3px" bgcolor="#CCCCCC">&nbsp;</td>
							</tr>
						</table>
						</td>
					</tr>
				</table>
			</td>
			<td width="775" valign="top" bgcolor="#000000">
				<table width="100%" border="0" cellspacing="0" cellpadding="0">
					<tr>
						<td>
						<table width="100%" border="0" cellspacing="0" cellpadding="0">
							<?php
								$q="SELECT * FROM `pra_catalog` WHERE show_sub=0 AND status=1 ORDER BY id_sub_catalog";
								$dbcat=new nDB();
								$dbcat->query($q);
								while($dbcat->next_record()){
								?>
							<tr>
								<td width="775" height="36" style="background:url(images/bh-catindex.jpg) no-repeat; padding-left:35px"><span style="font-size:14px; color:#FFF">
									<?=$dbcat->f(name_catalog)?>
									</span>
								</td>
							</tr>
							<tr>
								<td>
									<table width="760" border="0" align="center" cellpadding="0" cellspacing="3">
									<tr>
										<td height="166" valign="top" bgcolor="#FFFFFF">
											<?php
												$q="SELECT * FROM `pra_product` WHERE  name_catalog='".$dbcat->f(id_sub_catalog)."'  ";
												$db->query($q);							
												$total=$db->num_rows();							
												$q.=" ORDER BY id_product DESC LIMIT 0,5";
												$db->query($q);
												while($db->next_record()){ ?>
											<table width="138" border="0" align="center" cellpadding="3" cellspacing="0" style="float:left; margin:1px">
												<tr>
												<td align="center"><a href="detail_pra.php?id_product=<?=$db->f(id_product)?>" target="_parent" style="text-decoration:none"><img src="<?=($db->f(pic1)!="")?'resize/w97-h97-c1:1/upimg/product/'.$db->f(pic1):"images/clear.gif"?>" alt="" width="97" height="97" border="3" /></a></td>
												</tr>
												<tr>
												<td align="left">
													<div style="overflow:hidden; width:138px; white-space:nowrap"> <a href="detail_pra.php?id_product=<?=$db->f(id_product)?>" target="_parent" style="text-decoration:none" title="<?=$db->f(name_product)?>"> <span style="color:#000; font-size:11px">
														<?=$db->f(name_product)?>
														</span> </a> 
													</div>
												</td>
												</tr>
												<tr>
												<td align="left"><span style="color:#F00; font-size:11px"> ราคา / 价格
													<?=$db->f(price)?>
													฿</span>
												</td>
												</tr>
												<tr>
												<td align="left"><?php if($db->f(status)==rent){ ?>
													ให้เช่า / 出售
													<?php }?>
													<?php if($db->f(status)==sold){ ?>
													ขายแล้ว / 已出售
													<?php }?>
													<?php if($db->f(status)==show){ ?>
													โชว์ / 展示
													<?php }?>
													<?php if($db->f(status)==reservation){ ?>
													เปิดจอง / 定牌
													<?php }?>
												</td>
												</tr>
												<tr>
												<td>เข้าชม / 遊客 :
													<?=$db->f(view_num)?>
													คน
												</td>
												</tr>
											</table>
											<?php } ?>
										</td>
									</tr>
									<tr>
										<td height="25" colspan="5" align="right"  bgcolor="#242424" style="padding-right:15px"><a href="show_pra.php?cat=<?=$dbcat->f(id_sub_catalog)?>"><span style="color: #FFF; font-size:14px">NEXT / 下一页 &gt;&gt; </span></a></td>
									</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td height="5px"></td>
							</tr>
							<?php } ?>
						</table>
						</td>
					</tr>
					<tr>
						<td>
						<table width="100%" border="0" cellspacing="0" cellpadding="0">
							<?php
								$q="SELECT * FROM `pra_catalog2` WHERE show_sub=0 AND status=1 ORDER BY id_sub_catalog";
								$dbcat=new nDB();
								$dbcat->query($q);
								while($dbcat->next_record()){
								?>
							<tr>
								<td width="775" height="36" style="background:url(images/bh-catindex.jpg) no-repeat; padding-left:35px"><span style="font-size:14px; color:#FFF">
									<?=$dbcat->f(name_catalog)?>
									</span>
								</td>
							</tr>
							<tr>
								<td>
									<table width="760" border="0" align="center" cellpadding="0" cellspacing="3">
									<tr>
										<td height="166" valign="top" bgcolor="#FFFFFF">
											<?php
												$q="SELECT * FROM `pra_product2` WHERE  name_catalog='".$dbcat->f(id_sub_catalog)."'  ";
												$p_r=1;
												$db->query($q);							
												$total=$db->num_rows();							
												$q.=" ORDER BY id_product DESC LIMIT 0,5";
												$db->query($q);
												while($db->next_record()){
												?>
											<table width="135" border="0" align="center" cellpadding="3" cellspacing="0" style="float:left; margin:1px">
												<tr>
												<td align="center"><a href="detail_pra2.php?id_product=<?=$db->f(id_product)?>" target="_parent" style="text-decoration:none"><img src="<?=($db->f(pic1)!="")?'resize/w97-h97-c1:1/upimg/product/'.$db->f(pic1):"images/clear.gif"?>" alt="" width="97" height="97" border="3" /></a></td>
												</tr>
												<tr>
												<td align="left">
													<div style="overflow:hidden; width:135px; white-space:nowrap"> <a href="detail_pra2.php?id_product=<?=$db->f(id_product)?>" target="_parent" style="text-decoration:none" title="<?=$db->f(name_product)?>"> <span style="color:#000; font-size:11px">
														<?=$db->f(name_product)?>
														</span> </a> 
													</div>
												</td>
												</tr>
												<tr>
												<td align="left"><span style="color:#F00; font-size:11px"> ราคา / 价格
													<?=$db->f(price)?>
													฿</span>
												</td>
												</tr>
												<tr>
												<td align="left"><?php if($db->f(status)==rent){ ?>
													ให้เช่า / 出售
													<?php }?>
													<?php if($db->f(status)==sold){ ?>
													ขายแล้ว / 已出售
													<?php }?>
													<?php if($db->f(status)==show){ ?>
													โชว์ / 展示
													<?php }?>
													<?php if($db->f(status)==reservation){ ?>
													เปิดจอง / 定牌
													<?php }?>
												</td>
												</tr>
												<tr>
												<td>เข้าชม / 遊客 :
													<?=$db->f(view_num)?>
													คน
												</td>
												</tr>
											</table>
											<?php } ?>
										</td>
									</tr>
									<tr>
										<td height="25" colspan="5" align="right"  bgcolor="#242424" style="padding-right:15px"><a href="show_pra2.php?cat=<?=$dbcat->f(id_sub_catalog)?>"><span style="color: #FFF; font-size:14px">NEXT / 下一页 &gt;&gt; </span></a></td>
									</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td height="5px"></td>
							</tr>
							<?php } ?>
						</table>
						</td>
					</tr>
				</table>
				</td>
			</tr>
			<tr>
				<td colspan="2">
					<?php include('footer.php');?>
				</td>
			</tr>
		</table>
		<map name="Map" id="Map">
			<area shape="rect" coords="864,8,993,42" href="contact.php" />
			<area shape="rect" coords="685,8,850,44" href="payment.php" />
			<area shape="rect" coords="522,10,675,43" href="order.php" />
			<area shape="rect" coords="372,8,511,42" href="about.php" />
			<area shape="rect" coords="272,11,364,43" href="teehatyai.php" />
			<area shape="rect" coords="4,6,265,42" href="http://www.praasia.com" />
		</map>
	</body>
</html>
