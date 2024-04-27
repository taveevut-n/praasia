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
	<table width="755" border="0" cellspacing="0" cellpadding="3">
		<tr>
			<td height="30" align="center" bgcolor="#996600" style="background:url(images/tab-s.jpg) no-repeat">
				<table width="100%" border="0" cellpadding="0" cellspacing="0">
					<tr>
						<td width="63" style="padding-left:20px; width:40px; white-space:nowrap;">&nbsp;
							
						</td>
						<td width="583" style="text-align:center; font-size:14px; color:#a80804;">
							สินค้ามีใบรับรองหรือรางวัล / 比赛牌或有验证卡的佛牌区
						</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td colspan="3">
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
					$q = "SELECT * FROM `product` WHERE active = '2' AND certificate = '2' AND score > '80'";
					$p_r = 1;
					$db->query($q);
					$total = $db->num_rows();
					$q .= " ORDER BY certificatedate DESC";
					if($_POST["page_min"] == ""){
						$q .= " LIMIT 0,40";
					}else{
						$q .= " LIMIT ".$_POST["page_min"].",".$_POST["page_max"];
					}
					$db->query($q);
					while($db->next_record()){
				?>	            
				<table width="133" style="float:left; margin:5px; width:133px;" border="0" cellpadding="0" cellspacing="0">
					<tr>
						<td align="center">
							<table width="100%" border="0" cellspacing="0" cellpadding="0">
								<tr>
									<td bgcolor="#000000">
										<a href="shop_product.php?product_id=<?=$db->f(product_id)?>">
											<img src="<?=($db->f(pic1)!="")?'/slir/w139-h150/img/amulet/'.$db->f(pic1):"images/clear.gif"?>" alt="" width="139" height="150" border="0" />
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
												<table style="width:400px; height:250px; color:#ffcc02; background-color:#311407; border:1px solid #ffcc02; border-collapse:collapse;" border="0" cellpadding="0" cellspacing="0">
													<tr>
														<td style="height:35px; text-align:center; font-weight:bold;">
															คะแนนความน่าเชื่อถือสินค้านี้
														</td>
													</tr>
													<tr>
														<td style="height:1px; text-align:center;">
															<?php
																if($db->f(score) < 0){
																	$dbscore = 0;
																}else{
																	$dbscore = $db->f(score);
																}
															?>
															<div class="pra_progressbar_container">
																<table style="position:absolute; width:350px; height:27px;" border="0" cellpadding="0" cellspacing="0">
																	<tr>
																		<td style="text-align:center; vertical-align:middle; color:#000000;">
																			<?=$dbscore?>
																			คะแนน / 分数
																		</td>
																	</tr>
																</table>
																<div class="pra_progressbar" style="width:<?=$dbscore?>%;"></div>
															</div>
														</td>
													</tr>
													<tr>
														<td style="padding-top:5px; vertical-align:top;">
															<table border="0" cellpadding="0" cellspacing="0">
																<tr>
																	<td style="width:90px; height:35px; text-align:right; vertical-align:top;">
																		เหตุผลที่เลือก
																		<br/>
																		选的意见
																	</td>
																	<td style="width:20px; text-align:center; vertical-align:top;">
																		:
																	</td>
																	<td style="padding-right:5px; vertical-align:top;">
																		<?php
																			$showment = new nDB();
																			$showment->query("SELECT * FROM `comment` WHERE `comment_product` = '".$db->f(product_id)."' ORDER BY comment_id DESC ");
																			$showment->next_record();
																			if ($showment->f(vote1) != 0) {
																		?>
																		จากภาพพระเบลอ / 相片里佛牌模糊
																		,
																		<?php
																			}
																			if ($showment->f(vote2) != 0) {
																		?>
																		จากภาพพระเบลอมาก / 相片里佛牌很模糊
																		,
																		<?php
																			}
																			if ($showment->f(vote3) != 0) {
																		?>
																		จากภาพพิมพ์ตื้นไป / 相片里模表面很浅
																		,
																		<?php
																			}
																			if ($showment->f(vote4)) {
																		?>
																		จากภาพผิดพิมพ์ / 相片里佛牌模不对
																		,
																		<?php
																			}
																			if ($showment->f(vote5) != 0) {
																		?>
																		จากภาพผิดเนื้อ / 相片里佛牌料质不对
																		,
																		<?php
																			}
																			if ($showment->f(vote6) !=0) {
																		?>
																		จากภาพผิวรมใหม่ / 相片里佛牌是新皮
																		,
																		<?php
																			}
																			if ($showment->f(vote7) != 0) {
																		?>
																		จากภาพพระบวม / 相片里佛牌肿胀
																		,
																		<?php
																			}
																			if ($showment->f(vote8) != 0) {
																		?>
																		จากภาพพระดูยาก / 相片里佛牌辨认真假难
																		,
																		<?php
																			}
																			if ($showment->f(vote9) != 0) {
																		?>
																		จากภาพทีความคมชัดน้อย / 相片里的尖锐度很少
																		,
																		<?php
																			}
																			if ($showment->f(vote10) != 0) {
																		?>
																		จากภาพปลอมแปลงใบรับรอง / 假冒的验正书
																		,
																		<?php
																			}
																			if ($showment->f(vote11) != 0) {
																		?>
																		จากภาพประวัติไม่ชัดเจน / 来历不明显
																		<?php
																			}
																		?>
																	</td>
																</tr>
																<tr>
																	<td style="height:35px; text-align:right; vertical-align:top;">
																		เหตุผลเพิ่มเติม
																	</td>
																	<td style="width:20px; text-align:center; vertical-align:top;">
																		:
																	</td>
																	<td style="padding-right:5px; vertical-align:top;">
																		<?=$showment->f(comment_detail)?>
																	</td>
																</tr>
																<tr>
																	<td style="height:35px; text-align:right; vertical-align:top;">
																		วันที่
																	</td>
																	<td style="width:20px; text-align:center; vertical-align:top;">
																		:
																	</td>
																	<td style="padding-right:5px; vertical-align:top;">
																		<?=date("d F Y",$showment->f(comment_date))?>
																	</td>
																</tr>
															</table>
														</td>
													</tr>
												</table>
											</div>
										</div>
										<?php
											if ($db->f(score) == "100") {
										?>
										<img onmouseover="$(this).parent().find('div:eq(1)').show();" onmouseout="$(this).parent().find('div:eq(1)').hide();" src="images/light-green.png" border="0" />
										<?php
											} else {
												if ($db->f(score) < 31) {
										?>
										<img onmouseover="$(this).parent().find('div:eq(1)').show();" onmouseout="$(this).parent().find('div:eq(1)').hide();" src="images/flash-red.gif" border="0" />
										<?php
												}
												if ($db->f(score) > 30 and $db->f(score) < 70) {
										?>
										<img onmouseover="$(this).parent().find('div:eq(1)').show();" onmouseout="$(this).parent().find('div:eq(1)').hide();" src="images/flash-yellow.gif" border="0" />
										<?php
												}
												if ($db->f(score) > 70) {
										?>
										<img onmouseover="$(this).parent().find('div:eq(1)').show();" onmouseout="$(this).parent().find('div:eq(1)').hide();" src="images/flash-green.gif" border="0" />
										<?php
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
										<div style="width:133px; height:67px; overflow:hidden;">
											<div style="width:153px; height:65px; overflow-y:scroll; overflow-x:hidden;">
												<table width="129">
													<tr>
														<td>
															<a href="shop_product.php?product_id=<?=$db->f(product_id)?>"  title="<?=$db->f(name)?>" >
																<span style="color:#FFF">
																	<?=$db->f(name)?>
																</span>
															</a>
														</td>
													</tr>
												</table>
											</div>
										</div>
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
								$page_min = $_POST["page_min"] - 40;
							}else{
								$page_min = 0;
							}
							$page_max = 40;
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
								$page_total = ceil($total / 40);
								if($page_total < 5){
									while($l < $page_total){
										$l++;
										$page_min = ($l * 40) - 40;
										$page_max = 40;
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
										$page_min = ($l * 40) - 40;
										$page_max = 40;
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
									$page_min = ($l * 40) - 40;
									$page_max = 40;
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
										$page_min = ($l * 40) - 40;
										$page_max = 40;
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
										$page_min = ($l * 40) - 40;
										$page_max = 40;
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
									$page_min = ($l * 40) - 40;
									$page_max = 40;
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
										$page_min = ($l * 40) - 40;
										$page_max = 40;
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
									$page_min = ($l * 40) - 40;
									$page_max = 40;
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
							$page_min = $_POST["page_min"] + 40;
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