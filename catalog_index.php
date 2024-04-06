<table width="1000" border="0" cellspacing="0" cellpadding="0" style="margin-top:5px">
	<tr>
		<td>
			<? include('listshop.php') ?>                    
		</td>
	</tr>
	<tr>
		<td>
			<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
				<tr>
					<td height="56" align="center" style="background:#FC3 url(images/tab.jpg) no-repeat; border-top:3px solid #960; font-size:16px">
						<span style="font-size: 16px; color: #a80804; font-weight:bold">หมวดหมู่ใหญ่ / 佛牌分类区</span>
					</td>
				</tr>
				<tr>
					<td valign="top" style="background:#311407;">
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
						<div style="height: 370px;overflow-y: scroll;">
							<table width="100%" cellpadding="3" cellspacing="0">
								<?php
								$q = mysql_query("select * from twe_category_main  WHERE active = 2 order by order_num asc");
								while ( $main = mysql_fetch_array($q)) {
									?>
									<tr>
										<td>
											<a><h3 style="color: #E5CB15;padding-left: 10px;"><?php echo $main['main_name'];?> / <?php echo $main['main_name_cn'];?></h3></a>
											<?php
											$qcat = mysql_query("select * from twe_category where main_id = ".$main['main_id']." AND active = 2 order by order_num asc");
											while ( $category = mysql_fetch_array($qcat)) {
												?>
												<table cellpadding="3" cellspacing="0" class="table-catdisplay">
													<tr>
														<td width="1" style="color: #fff;font-size: 20px;padding-left: 20px;">•</td>
														<td>
															<a class="text-linkmain" href="product_group_all.php">
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
						</div>
					</td>
				</tr>
			</table>        
		</td>
	</tr>
	<tr>	
		<td>	
			<?php
			include("index_certificate.php");
			?>
		</td>
	</tr>
	<tr>
		<td>
			<!-- พระเครื่องก่อนปี 2530/佛历2530年前的佛牌区 -->
			<? include('oldpra.php'); ?>
		</td>
	</tr>
	<tr>
		<td>
			<!-- พระเครื่องหลังปี 2530/佛历2530年后的佛牌区 -->
			<? include('newpra.php'); ?>	
		</td>
	</tr>
	<tr>
		<td>

			<!-- เปิดจองพระใหม่ + พระใหม่ราคาวัด / 预定新牌+庙价牌区 -->
			<? include('watpra.php'); ?>	
		</td>
	</tr>
	<tr>
		<td>
			<!-- สินค้ามีใบรับรองหรือรางวัล / 比赛牌或有验证卡的佛牌区 -->
			<? include('recommendpra.php'); ?>
		</td>
	</tr>
	<tr>
		<td>
			<!-- สินค้าเบ็ดเตล็ด 杂项区 -->
			<? include('otherpra.php'); ?>	
		</td>
	</tr>
	<tr>
		<td>
			<table width="1000" border="0" cellpadding="3" cellspacing="0">
				<tr>
					<td height="56" align="center" style="background:#FC3 url(images/tab.jpg) no-repeat; border-top:3px solid #960; font-size:16px"><span style="font-size: 16px; color: #a80804; font-weight:bold">ลำดับคะแนนความเชื่อถือร้านค้า /店铺的信用分数排序</span></td>
				</tr>
				<tr>
					<td>
						<?php   
						$q="SELECT * FROM `member` WHERE active = 2 ";
						$dbshop= new nDB();
						$p_r=1;
						$dbshop->query($q);							
						$total=$dbshop->num_rows();							
						$q.=" ORDER BY score DESC LIMIT 0,24";
						$dbshop->query($q);
						while($dbshop->next_record()){
							?>
							<?php 
							$q="SELECT * FROM `product` WHERE shop_id = '".$dbshop->f(id)."' ";
							$p_r=1;
							$db->query($q);						
							$producttotal=$db->num_rows();	
							?>
							<table width="120" border="0" align="center" cellpadding="0" cellspacing="0" style="float:left; margin:2px">
								<tr>
									<td align="center">
										<table width="90%" border="0" cellspacing="0" cellpadding="0">
											<tr>
												<td bgcolor="#000000"><a href="shop_index.php?shop=<?=$dbshop->f(id)?>">
												<!-- <img src="<?=($dbshop->f(head2)!="")?'/resize/w120-h120/img/head/'.$dbshop->f(head2):"images/logodefualt.jpg"?>" alt="" width="118" height="120" border="0" /></a> -->
												<img src="<?=($dbshop->f(head2)!="")?'/img/head/'.$dbshop->f(head2):"images/logodefualt.jpg"?>" alt="" width="118" height="120" border="0" /></a>
											</td>
											</tr>
										</table>
									</td>
								</tr>
								<tr>
									<td valign="top" bgcolor="#666666">
										<table width="100%" border="0" cellspacing="0" cellpadding="3">
											<tr>
												<td height="20" align="center">
													<a href="shop_product.php?product_id=<?=$db->f(product_id)?>">
														<div  style="width:105px; overflow:hidden; white-space:nowrap; font-size:10px" >
															<span style="color:#FFF"><?=$dbshop->f(shopname)?></span>
														</div>
													</a>
												</td>
											</tr>
											<tr>
												<td height="20" align="center">
													<a href="detail_rank.php" target="parent">
														<table width="100%" border="0" cellpadding="0" cellspacing="0">
															<tr>
																<td align="center">
																	<? if ($dbshop->f(score)<=10 ) { ?>
																		<img src="images/rank-heart.png" width="20" height="16" />
																	<? } ?>
																	<? if ($dbshop->f(score)>10 AND $dbshop->f(score)<=40) { ?>
																		<img src="images/rank-heart.png" width="20" height="16" /> <img src="images/rank-heart.png" width="20" height="16" />
																	<? } ?>
																	<? if ($dbshop->f(score)>40 AND $dbshop->f(score)<=90) { ?>
																		<img src="images/rank-heart.png" width="20" height="16" /> <img src="images/rank-heart.png" width="20" height="16" /> <img src="images/rank-heart.png" width="20" height="16" />
																	<? } ?> 
																	<? if ($dbshop->f(score)>90 AND $dbshop->f(score)<=150) { ?>
																		<img src="images/rank-heart.png" width="20" height="16" /> <img src="images/rank-heart.png" width="20" height="16" /> <img src="images/rank-heart.png" width="20" height="16" /> <img src="images/rank-heart.png" width="20" height="16" />
																	<? } ?> 
																	<? if ($dbshop->f(score)>150 AND $dbshop->f(score)<=250) { ?>
																		<img src="images/rank-heart.png" width="20" height="16" /> <img src="images/rank-heart.png" width="20" height="16" /> <img src="images/rank-heart.png" width="20" height="16" /> <img src="images/rank-heart.png" width="20" height="16" /> <img src="images/rank-heart.png" width="20" height="16" />
																	<? } ?>
																	<? if ($dbshop->f(score)>250 AND $dbshop->f(score)<=500) { ?>
																		<img src="images/rank-diamond.png" width="20" height="16" />
																	<? } ?>          
																	<? if ($dbshop->f(score)>500 AND $dbshop->f(score)<=1000) { ?>
																		<img src="images/rank-diamond.png" width="20" height="16" /> <img src="images/rank-diamond.png" width="20" height="16" />
																	<? } ?>   
																	<? if ($dbshop->f(score)>1000 AND $dbshop->f(score)<=2000) { ?>
																		<img src="images/rank-diamond.png" width="20" height="16" /> <img src="images/rank-diamond.png" width="20" height="16" /> <img src="images/rank-diamond.png" width="20" height="16" />
																	<? } ?> 
																	<? if ($dbshop->f(score)>2000 AND $dbshop->f(score)<=5000) { ?>
																		<img src="images/rank-diamond.png" width="20" height="16" /> <img src="images/rank-diamond.png" width="20" height="16" /> <img src="images/rank-diamond.png" width="20" height="16" /> <img src="images/rank-diamond.png" width="20" height="16" />
																	<? } ?>
																	<? if ($dbshop->f(score)>5000 AND $dbshop->f(score)<=10000) { ?>
																		<img src="images/rank-diamond.png" width="20" height="16" /> <img src="images/rank-diamond.png" width="20" height="16" /> <img src="images/rank-diamond.png" width="20" height="16" /> <img src="images/rank-diamond.png" width="20" height="16" /> <img src="images/rank-diamond.png" width="20" height="16" />
																	<? } ?>
																	<? if ($dbshop->f(score)>10000 AND $dbshop->f(score)<=20000) { ?>
																		<img src="images/rank-redcrown.gif" width="20" height="16" />
																	<? } ?>
																	<? if ($dbshop->f(score)>20000 AND $dbshop->f(score)<=50000) { ?>
																		<img src="images/rank-redcrown.gif" width="20" height="16" /> <img src="images/rank-redcrown.gif" width="20" height="16" />
																	<? } ?>
																	<? if ($dbshop->f(score)>50000 AND $dbshop->f(score)<=100000) { ?>
																		<img src="images/rank-redcrown.gif" width="20" height="16" /> <img src="images/rank-redcrown.gif" width="20" height="16" /> <img src="images/rank-redcrown.gif" width="20" height="16" />
																	<? } ?> 
																	<? if ($dbshop->f(score)>100000 AND $dbshop->f(score)<=200000) { ?>
																		<img src="images/rank-redcrown.gif" width="20" height="16" /> <img src="images/rank-redcrown.gif" width="20" height="16" /> <img src="images/rank-redcrown.gif" width="20" height="16" /> <img src="images/rank-redcrown.gif" width="20" height="16" />
																	<? } ?> 
																	<? if ($dbshop->f(score)>200000 AND $dbshop->f(score)<=500000) { ?>
																		<img src="images/rank-redcrown.gif" width="20" height="16" /> <img src="images/rank-redcrown.gif" width="20" height="16" /> <img src="images/rank-redcrown.gif" width="20" height="16" /> <img src="images/rank-redcrown.gif" width="20" height="16" /> <img src="images/rank-redcrown.gif" width="20" height="16" />
																	<? } ?>
																	<? if ($dbshop->f(score)>500000 AND $dbshop->f(score)<=1000000) { ?>
																		<img src="images/gif/crown.gif" width="20" height="16" />
																	<? } ?>          
																	<? if ($dbshop->f(score)>1000000 AND $dbshop->f(score)<=2000000) { ?>
																		<img src="images/gif/crown.gif" width="20" height="16" /> <img src="images/gif/crown.gif" width="20" height="16" />
																	<? } ?>   
																	<? if ($dbshop->f(score)>2000000 AND $dbshop->f(score)<=5000000) { ?>
																		<img src="images/gif/crown.gif" width="20" height="16" /> <img src="images/gif/crown.gif" width="20" height="16" /> <img src="images/gif/crown.gif" width="20" height="16" />
																	<? } ?> 
																	<? if ($dbshop->f(score)>5000000 AND $dbshop->f(score)<=10000000) { ?>
																		<img src="images/gif/crown.gif" width="20" height="16" /> <img src="images/gif/crown.gif" width="20" height="16" /> <img src="images/gif/crown.gif" width="20" height="16" /> <img src="images/gif/crown.gif" width="20" height="16" />
																	<? } ?>
																	<? if ($dbshop->f(score)>10000000) { ?>
																		<img src="images/gif/crown.gif" width="20" height="16" /> <img src="images/gif/crown.gif" width="20" height="16" /> <img src="images/gif/crown.gif" width="20" height="16" /> <img src="images/gif/crown.gif" width="20" height="16" /> <img src="images/gif/crown.gif" width="20" height="16" />
																	<? } ?>                      
																</td>
															</tr>
														</table>
													</a>
												</td>
											</tr>
											<tr>
												<td style="height:25px; text-align:center; white-space:nowrap;color: #FFF;"> คะแนนรวม / 总分数 
													<span style="color:#FFDF03;"> <br/><?=number_format($dbshop->f(score))?> </span> 
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
					<td>&nbsp;
					</td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td width="754" align="center" valign="top">
			<table width="1000" border="0" cellpadding="3" cellspacing="0">
				<tr>
					<td height="56" align="center" style="background:#FC3 url(images/tab.jpg) no-repeat; border-top:3px solid #960; font-size:16px"><span style="font-size: 16px; color: #a80804; font-weight:bold">ร้านค้า update ล่าสุด/最新更新铺</span></td>
				</tr>
				<tr>
					<td>
						<?php   
						$q="SELECT * FROM `member` WHERE active = 2 ";
						$dbshop= new nDB();
						$p_r=1;
						$dbshop->query($q);							
						$total=$dbshop->num_rows();							
						$q.=" ORDER BY date_update DESC LIMIT 0,24";
						$dbshop->query($q);
						while($dbshop->next_record()){
							?>
							<?php 
							$q="SELECT * FROM `product` WHERE shop_id = '".$dbshop->f(id)."' ";
							$p_r=1;
							$db->query($q);						
							$producttotal=$db->num_rows();	
							?>
							<table width="100" border="0" align="center" cellpadding="0" cellspacing="0" style="float:left; margin:2px">
								<tr>
									<td align="center">
										<table width="90%" border="0" cellspacing="0" cellpadding="0">
											<tr>
												<!-- <td bgcolor="#000000"><a href="shop_index.php?shop=<?=$dbshop->f(id)?>"><img src="<?=($dbshop->f(head2)!="")?'/resize/w120-h120/img/head/'.$dbshop->f(head2):"images/logodefualt.jpg"?>" alt="" width="120" height="120" border="0" /></a></td> -->
												<td bgcolor="#000000"><a href="shop_index.php?shop=<?=$dbshop->f(id)?>"><img src="<?=($dbshop->f(head2)!="")?'/img/head/'.$dbshop->f(head2):"images/logodefualt.jpg"?>" alt="" width="120" height="120" border="0" /></a></td>
											</tr>
										</table>
									</td>
								</tr>
								<tr>
									<td valign="top" bgcolor="#666666">
										<table width="100%" border="0" cellspacing="0" cellpadding="3">
											<tr>
												<td height="20" align="center">
													<a href="shop_product.php?product_id=<?=$db->f(product_id)?>">
														<div  style="width:105px; overflow:hidden; white-space:nowrap; font-size:10px" >
															<span style="color:#FFF"><?=$dbshop->f(shopname)?></span>
														</div>
													</a>
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
					<td>&nbsp;
					</td>
				</tr>
			</table>
		</td>
	</tr>
</table>
