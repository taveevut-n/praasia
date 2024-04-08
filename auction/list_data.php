<?php
	include('../global.php');

	if($_GET['id_cat'] == ""){
		header("location:catagories.php");
		exit();
	}else{
		mysql_query("update auc_catalog_all set review = review+1 where catalog_id = '".$_GET['id_cat']."' ");
	}

	include('head.php');
	include('config/function.php');
	// echo date("Y-m-d H:i:s");
	?>
<body>
	<div id="wrapper">
		<?php
			include('header.php');
			?>
		<div id="container">
			<div class="box_content">
				<table width="1000px" border="0" align="center" cellpadding="0" cellspacing="0" class="table">
					<tr>
						<td>&nbsp;</td>
					</tr>
					<tr>
						<td>
							<table bordercolor="#0000FF" border="0" align="center">
								<tbody>
									<tr>
										<td>
											<table width="100%" border="0" cellpadding="0" align="center" cellspacing="0">
												<tr>
													<td width="1"><img src="images/icon_auction/idcard1.gif" border="0" width="46"> </td>
													<td><span class="text_title_head">มีบัตรรับรองพระเครื่องของสถาบันการันตีพระ</span></td>
												</tr>
											</table>
										</td>
										<td>
											<table width="100%" border="0" cellpadding="0" align="center" cellspacing="0">
												<tr>
													<td width="1"><img src="images/icon_auction/icon/ending.gif" border="0" width="46"> </td>
													<td><span class="text_title_head">ปิดประมูลใน 24 ชม.</span></td>
												</tr>
											</table>
										</td>
										<td>
											<table width="100%" border="0" cellpadding="0" align="center" cellspacing="0">
												<tr>
													<td width="1"><img src="images/icon_auction/icon/ending2.gif" border="0" width="46"> </td>
													<td><span class="text_title_head">ปิดประมูลใน 4 ชม.</span></td>
												</tr>
											</table>
										</td>
										<td>
											<table width="100%" border="0" cellpadding="0" align="center" cellspacing="0">
												<tr>
													<td width="1"><img src="images/icon_auction/icon/ending3.gif" border="0" width="46"> </td>
													<td><span class="text_title_head">ปิดประมูลใน 1 ชม.</span></td>
												</tr>
											</table>
										</td>
									</tr>
									<tr>
										<td>
											<table width="100%" border="0" cellpadding="0" align="center" cellspacing="0">
												<tr>
													<td width="1"><img src="images/icon_auction/icon/publiash.gif" border="0" width="46"> </td>
													<td><span class="text_title_head">มีใบประกาศหรือใบรับรองพระเครื่องจากสถาบันฯ อื่นๆ</span></td>
												</tr>
											</table>
										</td>
										<td height="27">
											<table width="100%" border="0" cellpadding="0" align="center" cellspacing="0">
												<tr>
													<td width="1"><img src="images/icon_auction/icon/close.gif" border="0" width="46"> </td>
													<td><span class="text_title_head">ปิดประมูลแล้ว</span></td>
												</tr>
											</table>
										</td>
										<td>
											<table width="100%" border="0" cellpadding="0" align="center" cellspacing="0">
												<tr>
													<td width="1"><img src="images/icon_auction/icon/hot.gif" border="0" width="46"> </td>
													<td><span class="text_title_head">มีคนประมูลเยอะ</span></td>
												</tr>
											</table>
										</td>
										<td valign="bottom">
											<table width="100%" border="0" cellpadding="0" align="center" cellspacing="0">
												<tr>
													<td width="1" style="white-space: nowrap;"><font color="#FF0000"><b>สีแดงเข้ม</b></font> </td>
													<td><span class="text_title_head">ถึงราคาขั้นต่ำแล้ว</span></td>
												</tr>
											</table>
										</td>
									</tr>
								</tbody>
							</table>
						</td>
					</tr>
					<tr>
						<td>&nbsp;</td>
					</tr>
				</table>
			</div>
			<div class="box_content">
				<table width="1000px" border="0" align="center" cellpadding="0" cellspacing="0" class="table">
					<tr>
						<td colspan="2" bgcolor="#4A1701" class="head_contain" style="padding-left: 11px;text-align:left;">
							<form action="search_data.php" name="form1" method="post">
                            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                              <tr>
                                <td><span class="text_yellpw"><b><?=$language['link_list_dataauction'];?></b></span></td>
                                <td align="right"><input name="id_cat" type="hidden" value="<?=$_GET['id_cat']?>"><input type="text" name="q" placeholder="ค้นหารายการประมูลในห้องนี้" style="width:200px"><input type="submit" name="search" value="ค้นหา"></td>
                              </tr>
                            </table>
                            </form>
						</td>
					</tr>
					<tr>
						<td colspan="2" align="center" style="height:100%;">
							<table width="100%" border="0" cellpadding="0" cellspacing="0" class="table condition_tb_textjustify">
								<tr style="background: rgb(163, 162, 162);">
									<td align="center">
										<span class="headtable"><?=$language['text_no'];?></span>
									</td>
									<td align="center">
										<span class="headtable"><?=$language['txt_img'];?></span>
									</td> 
									<td align="center">
										<span class="headtable"><?=$language['txt_pranme'];?></span>
									</td>
									<td align="center">
										<span class="headtable"><?=$language['txt_auccreater'];?></span>
									</td> 
									<td align="center">
										<span class="headtable"><?=$language['txt_pricenow'];?></span>
									</td> 
									<td align="center">
										<span class="headtable"><?=$language['txt_maxprice'];?></span>
									</td>
									<td align="center">
										<span class="headtable"><?=$language['txt_closeauction'];?></span>
									</td>
									<td align="center">
										<span class="headtable"><?=$language['txt_timelcloseauc'];?></span>
									</td>
									<td align="center">
										<span class="headtable"><?=$language['txt_viewauclist'];?></span>
									</td>
								</tr>
								<?php 
								function strAppenPer($string,$qty){
									$text = $string;
									if(strlen($text) < $qty){
										$new_text = $string;
									}else{
										$new_text = mb_substr($text, 0,$qty,'utf-8').'...';
									}
									return $new_text;
								}

								$sql_auction = "SELECT * FROM auc_regist ar LEFT JOIN auc_member am ON ar.reg_memid  = am.m_id WHERE ar.reg_catalogid = '".$_GET['id_cat']."' GROUP BY ar.reg_id  ORDER BY ar.rec_sort ASC , ar.rec_order DESC";
								$q_auction = mysql_query($sql_auction );
								
								if(mysql_num_rows($q_auction) == 0)
								{
									?>
								<tr>
									<td align="center" style="height: 80px; font-family: &quot;verdana&quot;; font-size: 16px; color: #fff;" colspan="9">--- ไม่พบรายการในหมวดหมู่ ที่ท่านต้องการ ---</td>
								</tr>
									<?php
								}
								else
								{
									$l = 1;
								while ($dbauction = mysql_fetch_array($q_auction)) {
									if($l % 2 == 0){
										$change_color = 'style="background:#E9D7C6;"';
									}else{
										$change_color = 'style="background:#eee;"';
									}

									/* Price Now Begin */
									$queryreplynow  = mysql_query("SELECT * FROM auc_reply ac INNER JOIN auc_member am on ac.rep_memid = am.m_id WHERE ac.rep_aucid='".$dbauction['reg_id']."' ORDER BY ac.rep_id DESC");
									$resultreplynow = mysql_fetch_array($queryreplynow);
								?>
								<tr <?=$change_color;?> >
									<td align="center" width="1">
										<?=$l;?>
									</td>
									<td align="center">
										<a id="imagebox" href="fileupload/<?=$dbauction['reg_file1']?>" title="<?=$dbauction['reg_file1']?>">
											<img src="fileupload/<?=$dbauction['reg_file1']?>" height="42" width="42" alt="<?=$dbauction['reg_file1']?>"/>
										</a>
									</td>
									<td align="left">
										<table width="100%" border="0" cellpadding="0" align="center" cellspacing="0">
											<tr>
												<td width="1" style="white-space: nowrap;">
													<?php
														$l_price = $resultreplynow['rep_priceoffer']; // Latest Price
														$c_price = $dbauction['reg_priceend'];// Compare Price
														if($l_price >= $c_price){
															mysql_query("UPDATE auc_regist SET reg_dateexpire = '".date("Y-m-d H:i:s",time()+86400)."' WHERE reg_id = '".$dbauction['reg_id']."' ");
														}

														$date_compare = strtotime($dbauction['reg_dateexpire']);
														$age_life = $date_compare - time();

														if($age_life < 0){
															// echo "[ปิดประมูลแล้ว] ";
															echo '<img src="images/icon_auction/icon/close.gif" align="absmiddle" border="0" width="32">';

															$rwin = mysql_fetch_array(mysql_query("SELECT * FROM auc_reply where rep_aucid = '".$dbauction['reg_id']."' ORDER BY rep_id desc"));
															mysql_query("update auc_regist set reg_winid = '".$rwin['rep_memid']."' where reg_id = '".$dbauction['reg_id']."' ");

														}else if($age_life > 0 && $age_life <= 300){
															echo "[เหลือเวลาอีก 5 นาที] ";
														}else if($age_life > 0 && $age_life <= 3600){
															// echo "[เหลือเวลาอีก 1 ชม.] ";
															echo '<img src="images/icon_auction/icon/ending3.gif" align="absmiddle" border="0" width="32">';
														}else if($age_life > 0 && $age_life <= 10800){
															// echo "[เหลือเวลาอีก 3 ชม.] ";
															echo '<img src="images/icon_auction/icon/ending2.gif" align="absmiddle" border="0" width="32">';
														}else if($age_life > 0 && $age_life <= 82800){
															echo "[เหลือเวลาอีก 23 ชม.] ";
														}else if($age_life > 0 && $age_life <= 86400){
															// echo "[เหลือเวลาอีก 24 ชม.] ";
															echo '<img src="images/icon_auction/icon/ending.gif" align="absmiddle" border="0" width="32">';
														}
														
														?>
												</td>
												<td>
													<a href="view.php?id=<?=$dbauction['reg_id']?>" target="_blank" title="<?=$dbauction['reg_wattuname']?>">
														<?= strAppenPer($dbauction['reg_wattuname'],30);?>
													</a>
												</td>
											</tr>
										</table>
									</td>
									<td align="left">
										<?=$dbauction['m_username']?>
									</td>
									<td align="right">
										<?= number_format($resultreplynow['rep_priceoffer'])?>
									</td>
									<td align="center" width="1">
                                    <a href="profile_member.php?mem_id=<?=$dbauction['m_id']?>"><?=$resultreplynow['m_username']?></a>
										<?php
											$nreply = mysql_num_rows(mysql_query("SELECT * FROM `auc_feedback` WHERE feed_to =  ".$resultreplynow['m_id']." "));
											if($nreply != 0)
											{ ?>
												
										<a title="ดู Feedback คำชม" href="feedback_list.php?name=<?=$resultreplynow['m_username']?>&amp;id=<?=$resultreplynow['m_id']?>">
											(<?php echo number_format($nreply);?>)
										</a>
										<a href="list_eachdata.php?each_id=<?php echo $resultreplynow['m_id'];?>&amp;each_name=<?php echo $resultreplynow['m_username'];?>">
											<img src="images/augtion.gif" border="0" width="20" title="ดูรายการทั้งหมดของผู้ตั้งประมูล" align="absmiddle">
										</a>
												<?php
											}
										?>
									</td>
									<td align="center" width="1">
										<?php
										if($age_life < 0){
											$r_aucreply_now = mysql_fetch_array(mysql_query("SELECT * FROM auc_reply where rep_aucid = '".$dbauction['reg_id']."' ORDER BY rep_id desc"));
											$dbmember = mysql_fetch_array(mysql_query("SELECT * FROM auc_member where m_id = '".$r_aucreply_now['rep_memid']."' "));
											
											if($dbmember['m_username'] == ""){
												echo 'ปิดจากระบบ';
												if($dbauction['reg_winsendmail'] == 0){
													$mail_array = array($dbauction['reg_email']);
													$subject = "ท่านเป็นผู้ชนะการประมูลสินค้า ".strAppenPer($dbauction['reg_wattuname'],30);
													$messages = file_get_contents("http://".$_SERVER["SERVER_NAME"]."/auction2/win_auctionclose.php");
													$headers = "MIME-Version: 1.0\r\n";
													$headers .= "Content-type: text/html; charset=utf-8\r\n";
													$headers .= "From: praasia.com info@praasia.com \r\n";

													mail("taveevut@gmail.com", $subject, $messages, $headers);
													// foreach ($mail_array as $index => $value) {
													// 	if(!empty($value)){
													// 		mail($value, $subject, $messages, $headers);
													// 	}
													// }
													mysql_query("UPDATE auc_regist SET reg_winsendmail = 1 , rec_sort = 1 WHERE reg_id = '".$dbauction['reg_id']."'  ");
												}
											}else{
												echo $dbmember['m_username'].'<br/>';
												echo number_format($r_aucreply_now['rep_priceoffer']);

												if($dbauction['reg_winsendmail'] == 0){
													$mail_array = array($dbauction['reg_email'],"info@praasia.com");
													$subject = "ท่านเป็นผู้ชนะการประมูลสินค้า ".strAppenPer($dbauction['reg_wattuname'],30);
													$messages = file_get_contents("http://".$_SERVER["SERVER_NAME"]."/auction2/win_auction.php?regid=".$dbauction['reg_id']);
													$headers = "MIME-Version: 1.0\r\n";
													$headers .= "Content-type: text/html; charset=utf-8\r\n";
													$headers .= "From: praasia.com info@praasia.com \r\n";

													mail("taveevut@gmail.com", $subject, $messages, $headers);
													// foreach ($mail_array as $index => $value) {
													// 	if(!empty($value)){
													// 		mail($value, $subject, $messages, $headers);
													// 	}
													// }
													mysql_query("UPDATE auc_regist SET reg_winsendmail = 1 , rec_sort = 1 WHERE reg_id = '".$dbauction['reg_id']."'  ");
												}
											}
										}
										?>
									</td>
									<td align="center" width="1">
										<span style="font-size: 12px;white-space: nowrap;">
											<?=date("d/m/y H:i:s",strtotime($dbauction['reg_dateexpire']));?>
										</span>
									</td>
									<td align="center" width="1">
										<?= $dbauction['reg_view']?>
									</td>
								</tr>
								<?
								$l++;
								}
								?>
                                <? } ?>
							</table>
						</td>
					</tr>
				</table>
			</div>
		</div>
		<?php
			include('footer.php');
			?>
	</div>
</body>
</html>