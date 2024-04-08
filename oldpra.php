<?php
	include_once("global.php");

	if($_POST["page_num"] == ""){
		$page_num = "1";
	}else{
		$page_num = $_POST["page_num"];
	}
	if($page_num == "0"){
		$page_num = "1";
	}
	if($_POST["page_total"] != ""){
		if($page_num > $_POST["page_total"]){
			$page_num = $_POST["page_total"];
		}
	}
?>
<div class="praold_container">
	<table width="1000px" border="0" cellspacing="0" cellpadding="0">	
		<tr>
			<td height="56" align="center" style="background:#FC3 url(images/tab.jpg) no-repeat; border-top:3px solid #960; font-size:16px">
				<table width="100%" border="0" cellpadding="0" cellspacing="0">
					<tr>
						<td style="padding-left:20px; width:40px; white-space:nowrap;">&nbsp;
							
						</td>
						<td style="text-align:center;color:#7b3110; font-weight:bold">
							พระเครื่องก่อนปี 2530/佛历2530年前的佛牌区
						</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
		    <td>
				<table width="100%" align="center" cellpadding="0" cellspacing="0">
					<tr>
						<td style="padding-left:7px">
							<?php
								$q = "SELECT *,product.pic1 as productimg , product.view_num as viewproduct  ,product.name as productname FROM `product` LEFT JOIN member ON ( member.id = product.shop_id ) WHERE prarelease = '1' AND product.active = '2' AND product.warning = '0' AND product.recommend = 0 AND NOT product.certificate = 2 AND member.active = '2'";
								// $q = "SELECT * FROM `product` WHERE prarelease = '1' AND active = '2' AND warning = '0' AND recommend = 0 AND NOT certificate = 2 ";
								
								$p_r = 1;
								$db->query($q);
								$total = $db->num_rows();
								$q .= " ORDER BY product_id DESC";
								if($_POST["page_min"] == ""){
									$q .= " LIMIT 0,36";
								}else{
									$q .= " LIMIT ".$_POST["page_min"].",".$_POST["page_max"];
								}
								$db->query($q);
								while($db->next_record()){
									// select check comment
				                    $q="SELECT * FROM `comment` WHERE `comment_product` = '".$db->f(product_id)."' ";
				                    $comment= new nDB();
				                    $comment->query($q);
				                    $comment->next_record();
				                    $num_rows = $comment->num_rows();
							?>	            
							<table width="148" style="float:left; margin:5px; width:148px;" border="0" cellpadding="0" cellspacing="0">
					<tr>
						<td align="center">
							<table width="100%" border="0" cellspacing="0" cellpadding="0">
								<tr>
									<td bgcolor="#000000">
										<a href="shop_product.php?product_id=<?=$db->f(product_id)?>">
											<!-- <img src="<?=($db->f(productimg)!="")?'/slir/w155-h150/img/amulet/'.$db->f(productimg):"images/clear.gif"?>" alt="" width="155" height="150" border="0" /> -->
											<img src="<?=($db->f(productimg)!="")?'/img/amulet/'.$db->f(productimg):"images/clear.gif"?>" alt="" width="155" height="150" border="0" />
										</a>
									</td>
								</tr>
							</table>
						</td>
					</tr>
					<tr>
						<td height="60" valign="top" bgcolor="#666666">
							<table width="95%" border="0" align="center" cellpadding="3" cellspacing="0">
								<tr>
									<td>
										<div style="position:relative;">
											<div class="pravote_container" style="display:none; position:absolute; left:-200px; top:-250px;">
												<table style="width:400px; height:170px; color:#ffcc02; background-color:#311407; border:1px solid #ffcc02; border-collapse:collapse;" border="0" cellpadding="0" cellspacing="0">
													<tr>
														<td style="height:35px; text-align:center; font-weight:bold;">
															คะแนนความน่าเชื่อถือสินค้านี้
														</td>
													</tr>
													<tr>
														<td style="height:1px; text-align:center;">
															<?php
								                              	if ($db->f(score)>79) {
								                              		if ($db->f(score)>100) {
								                              			$dbscore = 100;
								                              		}else{
								                              			$dbscore = $db->f(score);
								                              		}
																	$dbscoreprocess = $db->f(score);
																	$colorprogress ="#00ff00";
																}elseif ($db->f(score)>29) {
																	$dbscore = $db->f(score);
																	$dbscoreprocess = $db->f(score);
																	$colorprogress ="#F7E81D";			
																}else{
								                                  if($db->f(score)<0){
								                                    $dbscore = 0;
								                                    $dbscoreprocess = 0;
								                                  }else{
								                                    $dbscore = $db->f(score);
								                                    $dbscoreprocess = $db->f(score);
								                                  }
																	$colorprogress = "red";			
																}

								                                // check comment
								                                if($num_rows==0){
								                                  ?>
								                                    <div class="pra_progressbar_container" style="width:100%;">
								                                      <table style="position:absolute; width:350px; height:27px;" border="0" cellpadding="0" cellspacing="0">
								                                        <tr>
								                                          <td style="text-align:center; vertical-align:middle; color:#000000;">100 คะแนน / 分数</td>
								                                        </tr>
								                                      </table>
								                                      <div class="pra_progressbar" style="width:100%; height: 26px;background-color:#00ff00;">&nbsp;</div>
								                                    </div>
								                                  <?
								                                }else{
								                                  ?>
								                                    <div class="pra_progressbar_container" style="width:100%;">
								                                      <table style="position:absolute; width:350px; height:27px;" border="0" cellpadding="0" cellspacing="0">
								                                        <tr>
								                                          <td style="text-align:center; vertical-align:middle; color:#000000;"><?=$dbscore?> คะแนน / 分数</td>
								                                        </tr>
								                                      </table>
								                                      <div class="pra_progressbar" style="width:<?=$dbscoreprocess?>%; height: 26px;background-color:<?=$colorprogress?>;">&nbsp;</div>
								                                    </div>
								                                  <?
								                                }
															?>
														</td>
													</tr>
													<tr>
														<td style="padding-top:5px; vertical-align:top;">
															<?php
							                                  if($num_rows==0){
							                                    ?>
							                                      <div class="box_vote"> สินค้าชิ้นนี้ได้รับรองจากคณะกรรมการเว็บพระเอเชียเรียบร้อยแล้ว ให้คะแนนเต็ม100% <br/><br/>本尊产品已被亚洲佛牌团队佛牌鉴定部给为满分100% </div>
							                                    <?
							                                  }else{
							                                    if ($db->f(score)>=100) {
							                                      ?>
							                                        <div class="box_vote"> สินค้าชิ้นนี้ได้รับรองจากคณะกรรมการเว็บพระเอเชียเรียบร้อยแล้ว ให้คะแนนเต็ม100% <br/><br/>本尊产品已被亚洲佛牌团队佛牌鉴定部给为满分100% </div>
							                                      <?
							                                    }else{
							                                      ?>
							                                        <div class="box_vote"> กรุณาตรวดสอบให้แน่ชัดก่อนทำการชื้อขายสิ้นค้าชิ้นนี้ <br/><br/>请各位小心或明确好这尊圣物是否真假后才进行交易 </div>
							                                      <?
							                                    }
							                                  }
													        ?>
														</td>
													</tr>
												</table>
											</div>
										</div>
										<?php
				                          // checkcommet befor show
				                          if($num_rows==0){
				                            ?>
				                              <img onMouseOver="$(this).parent().find('div:eq(1)').show();" onMouseOut="$(this).parent().find('div:eq(1)').hide();" src="images/light-green.png" border="0" />
				                            <?
				                          }else{
				                            if ($db->f(score)>79) {
				                              if ($db->f(score)>=100) {
				                                ?>
				                                  <img onMouseOver="$(this).parent().find('div:eq(1)').show();" onMouseOut="$(this).parent().find('div:eq(1)').hide();" src="images/light-green.png" border="0" />
				                                <?
				                              }else{
				                                ?>
				                                  <img onMouseOver="$(this).parent().find('div:eq(1)').show();" onMouseOut="$(this).parent().find('div:eq(1)').hide();" src="images/flash-green.gif" border="0" />
				                                <?
				                              }
				                            }elseif ($db->f(score)>29) {
				                              ?>
				                                <img onMouseOver="$(this).parent().find('div:eq(1)').show();" onMouseOut="$(this).parent().find('div:eq(1)').hide();" src="images/flash-yellow.gif" border="0" />
				                              <?
				                            }else{
				                              ?>
				                                <img onMouseOver="$(this).parent().find('div:eq(1)').show();" onMouseOut="$(this).parent().find('div:eq(1)').hide();" src="images/flash-red.gif" border="0" />
				                              <?
				                            }
				                          }
				          				?>
										&nbsp;
										<span style="color:#0CF; font-weight:bold">
											ID : <?=$db->f(product_id)?>
										</span>
									</td>
								</tr>
								<tr>
									<td height="25">
<div style="width:145px; height:67px; overflow:hidden;">
	<div style="width:165px; overflow-y:scroll; overflow-x:hidden; height:67px ;">
		<table width="145" cellpadding="1" cellspacing="0">
			<tr>
				<td colspan="2">
					<a href="shop_product.php?product_id=<?=$db->f(product_id)?>"  title="<?=$db->f(productname)?>" >
						<span style="color:#FFF">
							<?=$db->f(productname)?>
						</span>
					</a>
				</td>
			</tr>
			<? if($db->f(detailcn1)!='') { ?>
			<tr>
				<td width="30" style="color:#FFF" valign="top">
					名稱:
				</td>
				<td width="115" style="color:#FFF" valign="top">
					<?=$db->f(detailcn1)?>
				</td>
			</tr>
			<? } ?>
			<? if($db->f(detailcn5)!='0') { ?>
			<tr>
				<td style="color:#FFF" valign="top">
					几帮:
				</td>
				<td style="color:#FFF" valign="top">
					<?php
						$q="SELECT * FROM `catalog_cn` WHERE catalog_id= '".$db->f(detailcn5)."' ";
						$dbmix= new nDB();	
						$dbmix->query($q);
						$dbmix->next_record();
					?>
					<?=$dbmix->f(catalog_name_cn)?>
				</td>
			</tr>
			<? } ?>
			<? if($db->f(detailcn10)!='') { ?>
			<tr>
				<td style="color:#FFF" valign="top">
					高僧:
				</td>
				<td style="color:#FFF" valign="top">
					<?=$db->f(detailcn10)?>
				</td>
			</tr>
			<? } ?>
			<? if($db->f(detailcn6)!='0') { ?>
			<tr>
				<td style="color:#FFF" valign="top">
					模版:
				</td>
				<td style="color:#FFF" valign="top">
					<?php
						$q="SELECT * FROM `catalog_cn` WHERE catalog_id= '".$db->f(detailcn6)."' ";
						$dbmix= new nDB();	
						$dbmix->query($q);
						$dbmix->next_record();
					?>
					<?=$dbmix->f(catalog_name_cn)?>                                          
				</td>
			</tr>
			<? } ?>
			<? if($db->f(detailcn11)!='0') { ?>
			<tr>
				<td style="color:#FFF" valign="top">
					年期:
				</td>
				<td style="color:#FFF" valign="top">
					<?php
						$q="SELECT * FROM `catalog_cn` WHERE catalog_id= '".$db->f(detailcn11)."' ";
						$dbmix= new nDB();	
						$dbmix->query($q);
						$dbmix->next_record();
					?>
					<?=$dbmix->f(catalog_name_cn)?>
				</td>
			</tr>
			<? } ?>
			<? if($db->f(detailcn9)!='') { ?>
			<tr>
				<td style="color:#FFF" valign="top">
					佛寺:
				</td>
				<td style="color:#FFF" valign="top">
					<?=$db->f(detailcn9)?>
				</td>
			</tr>
			<? } ?>
		</table>
	</div>
</div>
		</td>
	</tr>
	<tr>
		<td height="25" align="center" bgcolor="#333333">
			<table width="100%" cellpadding="0" cellspacing="0">
				<tr >
					<td width="100%"style="text-align: left;">
						<span style="color:#FFF">
							<?php
								if($db->f(status) == 1){
							?>
							<span style="color:#09F">
								พระโชว์ / 展示
							</span>
							<?php
								}
								if($db->f(status) == 2){
							?>
							<span style="color:#090">
								ให้เช่า / 出售
							</span>
							<?php
								}
								if($db->f(status) == 3){
							?>
							<span style="color:#FF0">
								เปิดจอง / 预定
							</span>
							<?php
								}
								if($db->f(status) == 4){
							?>
							<span style="color:#FC0">
								จองแล้ว / 已定
							</span>
							<?php
								}
								if($db->f(status) == 5){
							?>
							<span style="color:#F00">
								ขายแล้ว / 已出售
							</span>
							<?php
								}
							?>
						</span>
					</td>
				</tr>
				<tr>
					
					<td width="100%">
						<table width="100%" border="0" cellspacing="0" cellpadding="3">
							<tr>
								<td style="text-align: right;">
									<img src="images/view-icon.png" width="20" height="11" />

									<span style="color:#FFF">
										<?=$db->f(viewproduct)?>
									</span>
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
<?php } ?> 
</td></tr>
<tr>
	<td height="30" align="right" bgcolor="#0a0400" style="padding-right:10px; color:#ffffff; border-bottom:1px solid #FC0;">
		<table align="right" border="0" cellpadding="0" cellspacing="0">
			<tr>
				<?php
					if($_POST["page_min"] > 0){
						$page_min = $_POST["page_min"] - 36;
					}else{
						$page_min = 0;
					}
					$page_max = 36;
					if($_POST["page_min"] > 0){
				?>
				<td page_num="<?=$page_num - 1?>" page_total="" onclick="page_select($(this),$('.praold_container'),'oldpra.php','<?=$page_min?>','<?=$page_max?>');" style="white-space:nowrap; cursor:pointer;">
					previous
				</td>
				<?php
					}
				?>
				<td style="white-space:nowrap;">
					<?php
						$l = 0;
						$page_total = ceil($total / 36);
						if($page_total < 5){
							while($l < $page_total){
								$l++;
								$page_min = ($l * 36) - 36;
								$page_max = 36;
					?>
					<table style="float:left; margin-left:10px; height:20px; cursor:pointer;" border="0" cellpadding="0" cellspacing="0">
						<tr>
							<td page_num="<?=$l?>" page_total="" onclick="page_select($(this),$('.praold_container'),'oldpra.php','<?=$page_min?>','<?=$page_max?>');" style="text-align:center; <?php if($l == $page_num){ echo "color:#e00000;"; }else{ echo "color:#ffffff;"; } ?> ">
								<?=$l?>
							</td>
						</tr>
					</table>
					<?php
							}
						}else if($page_num <= 5){
							while($l < 5){
								$l++;
								$page_min = ($l * 36) - 36;
								$page_max = 36;
					?>
					<table style="float:left; margin-left:10px; height:20px; cursor:pointer;" border="0" cellpadding="0" cellspacing="0">
						<tr>
							<td page_num="<?=$l?>" page_total="" onclick="page_select($(this),$('.praold_container'),'oldpra.php','<?=$page_min?>','<?=$page_max?>');" style="text-align:center; <?php if($l == $page_num){ echo "color:#e00000;"; }else{ echo "color:#ffffff;"; } ?> ">
								<?=$l?>
							</td>
						</tr>
					</table>
					<?php
							}
							$l = $page_total;
							$page_min = ($l * 36) - 36;
							$page_max = 36;
					?>
					<table style="float:left; margin-left:10px; height:20px;" border="0" cellpadding="0" cellspacing="0">
						<tr>
							<td>
								...
							</td>
						</tr>
					</table>
					<table style="float:left; margin-left:10px; height:20px; cursor:pointer;" border="0" cellpadding="0" cellspacing="0">
						<tr>
							<td page_num="<?=$l?>" page_total="" onclick="page_select($(this),$('.praold_container'),'oldpra.php','<?=$page_min?>','<?=$page_max?>');" style="text-align:center; <?php if($l == $page_num){ echo "color:#e00000;"; }else{ echo "color:#ffffff;"; } ?> ">
								<?=$l?>
							</td>
						</tr>
					</table>
					<?php
						}else if($page_num < $page_total){
							while($l < 5){
								$l++;
								$page_min = ($l * 36) - 36;
								$page_max = 36;
					?>
					<table style="float:left; margin-left:10px; height:20px; cursor:pointer;" border="0" cellpadding="0" cellspacing="0">
						<tr>
							<td page_num="<?=$l?>" page_total="" onclick="page_select($(this),$('.praold_container'),'oldpra.php','<?=$page_min?>','<?=$page_max?>');" style="text-align:center; <?php if($l == $page_num){ echo "color:#e00000;"; }else{ echo "color:#ffffff;"; } ?> ">
								<?=$l?>
							</td>
						</tr>
					</table>
					<?php
							}
					?>
					<table style="float:left; margin-left:10px; height:20px;" border="0" cellpadding="0" cellspacing="0">
						<tr>
							<td>
								...
							</td>
						</tr>
					</table>
					<?php
							$l = $page_num - 3;
							while($l < ($page_num + 2)){
								$l++;
								$page_min = ($l * 36) - 36;
								$page_max = 36;
								if( ($l > 5) && ($l < $page_total) ){
					?>
					<table style="float:left; margin-left:10px; height:20px; cursor:pointer;" border="0" cellpadding="0" cellspacing="0">
						<tr>
							<td page_num="<?=$l?>" page_total="" onclick="page_select($(this),$('.praold_container'),'oldpra.php','<?=$page_min?>','<?=$page_max?>');" style="text-align:center; <?php if($l == $page_num){ echo "color:#e00000;"; }else{ echo "color:#ffffff;"; } ?> ">
								<?=$l?>
							</td>
						</tr>
					</table>
					<?php
								}
							}
							$l = $page_total;
							$page_min = ($l * 36) - 36;
							$page_max = 36;
					?>
					<table style="float:left; margin-left:10px; height:20px;" border="0" cellpadding="0" cellspacing="0">
						<tr>
							<td>
								...
							</td>
						</tr>
					</table>
					<table style="float:left; margin-left:10px; height:20px; cursor:pointer;" border="0" cellpadding="0" cellspacing="0">
						<tr>
							<td page_num="<?=$l?>" page_total="" onclick="page_select($(this),$('.praold_container'),'oldpra.php','<?=$page_min?>','<?=$page_max?>');" style="text-align:center; <?php if($l == $page_num){ echo "color:#e00000;"; }else{ echo "color:#ffffff;"; } ?> ">
								<?=$l?>
							</td>
						</tr>
					</table>
					<?php
						}else{
							while($l < 5){
								$l++;
								$page_min = ($l * 36) - 36;
								$page_max = 36;
					?>
					<table style="float:left; margin-left:10px; height:20px; cursor:pointer;" border="0" cellpadding="0" cellspacing="0">
						<tr>
							<td page_num="<?=$l?>" page_total="" onclick="page_select($(this),$('.praold_container'),'oldpra.php','<?=$page_min?>','<?=$page_max?>');" style="text-align:center; <?php if($l == $page_num){ echo "color:#e00000;"; }else{ echo "color:#ffffff;"; } ?> ">
								<?=$l?>
							</td>
						</tr>
					</table>
					<?php
							}
							$l = $page_total;
							$page_min = ($l * 36) - 36;
							$page_max = 36;
					?>
					<table style="float:left; margin-left:10px; height:20px;" border="0" cellpadding="0" cellspacing="0">
						<tr>
							<td>
								...
							</td>
						</tr>
					</table>
					<table style="float:left; margin-left:10px; height:20px; cursor:pointer;" border="0" cellpadding="0" cellspacing="0">
						<tr>
							<td page_num="<?=$l?>" page_total="" onclick="page_select($(this),$('.praold_container'),'oldpra.php','<?=$page_min?>','<?=$page_max?>');" style="text-align:center; <?php if($l == $page_num){ echo "color:#e00000;"; }else{ echo "color:#ffffff;"; } ?> ">
								<?=$l?>
							</td>
						</tr>
					</table>
					<?php
						}
					?>
				</td>
				<?php
					$page_min = $_POST["page_min"] + 36;
					if($page_min > $total){
						$page_min = $_POST["page_min"];
					}
					if($page_num < $page_total){
				?>
				<td page_num="<?=$page_num + 1?>" page_total="<?=$page_total?>" onclick="page_select($(this),$('.praold_container'),'oldpra.php','<?=$page_min?>','<?=$page_max?>');" style="padding-left:10px; white-space:nowrap; cursor:pointer;">
					next
				</td>
				<?php
					}
				?>
			</tr>
		</table>
	</td>
</tr>
</table>
</td>
</tr>
</table>
</div>
