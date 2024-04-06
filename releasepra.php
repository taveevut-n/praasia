<table width="1000" border="0" cellspacing="0" cellpadding="0">	
                          <tr>
                	<td height="30" align="center" style="background-color:#FC3; border-top:3px solid #960; font-size:16px">
					รายการสินค้ามาใหม่ /
					新来产品
					</td>
              </tr>
          <tr>
		    <td>
            	<table width="100%" align="center" cellpadding="0" cellspacing="0">
                <tr>
                <td style="padding-left:7px">
				  <?php
                  $q="SELECT * FROM `product` WHERE active = '2' AND score > '80' AND warning = '0' ";
                  $p_r=1;
                  $db->query($q);							
                  $total=$db->num_rows();							
                  $q.=" ORDER BY product_id DESC LIMIT 0,60";
                  $db->query($q);
                  while($db->next_record()){
                  ?>	            
                <table width="148" border="0" align="center" cellpadding="0" cellspacing="0" style="float:left; margin:5px">
                  <tr>
                    <td align="center">
                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td bgcolor="#000000"><a href="shop_product.php?product_id=<?=$db->f(product_id)?>"><img src="<?=($db->f(pic1)!="")?'/resize/w155-h150/img/amulet/'.$db->f(pic1):"images/clear.gif"?>" alt="" width="155" height="150" border="0" /></a></td>
                        </tr>
                    </table></td>
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
			<span style="color:#FFF; font-weight:bold">
				ID : <?=$db->f(product_id)?>
			</span>
		</td>
	</tr>
	<tr>
		<td height="25">
			<div style="width:133px; overflow:hidden; word-break:break-all; height:65px ;">
				<a href="shop_product.php?product_id=<?=$db->f(product_id)?>"  title="<?=$db->f(name)?>" >
					<span style="color:#FFF">
						<?=$db->f(name)?>
					</span>
				</a>
			</div>
		</td>
	</tr>
</table>
</td>
                  </tr>
                  <tr>
                    <td height="25" align="center" bgcolor="#333333">
                    <table width="100%" cellpadding="0" cellspacing="0">
                    	<tr>
                        	<td width="63%" align="center">
                              <span style="color:#FFF">
				<? if ($db->f(status)==1) { ?>
                <span style="color:#09F">พระโชว์ / 展示</span>
                <? } ?>
				<? if ($db->f(status)==2) { ?>
                <span style="color:#090">ให้เช่า / 出售</span>
                <? } ?>
				<? if ($db->f(status)==3) { ?>
                <span style="color:#FF0">เปิดจอง / 预定</span>
                <? } ?>
				<? if ($db->f(status)==4) { ?>
                <span style="color:#FC0">จองแล้ว / 已定</span>
                <? } ?>
				<? if ($db->f(status)==5) { ?>
                <span style="color:#F00">ขายแล้ว / 已出售</span>
                <? } ?>                               
                              </span>
                            </td>
                            <td width="37%"><table width="100%" border="0" cellspacing="0" cellpadding="3">
                              <tr>
                                <td width="20"><img src="images/view-icon.png" width="20" height="11" /></td>
                                <td><span style="color:#FFF"><?=$db->f(view_num)?></span></td>
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
                  <td height="30" align="right" bgcolor="#0a0400" style="padding-right:10px; border-bottom:1px solid #FC0"><a href="all_product.php?s_page=1" target="_blank"><span style="color:#FC0">ดูสินค้าทั้งหมด / 总共商品</span></a></td>
                </tr>
            	</table>                
            </td>
	      </tr>             
               
	    </table>
