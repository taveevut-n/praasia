<?php
	include('../global.php');

	include('head.php');
	include('config/function.php');
	// echo date("Y-m-d H:i:s");
	?>
	<style type="text/css">
		
	</style>
<body>
	<div id="wrapper">
		<?php
			include('header.php');
			?>
		<div id="container">
			<div class="box_content">
				<table width="1000px" border="0" align="center" cellpadding="0" cellspacing="0" class="table">
					<tr>
						<td colspan="2" bgcolor="#4A1701" class="head_contain" style="padding-left: 11px;text-align:left;">
							<span class="text_yellpw"><b>รายการประมูลที่ยังไม่ได้ Feedback</b></span>
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
										<span class="headtable">Feedback</span>
									</td>
								</tr>
								<?
								function strAppenPer($string,$qty){
									$text = $string;
									if(strlen($text) < $qty){
										$new_text = $string;
									}else{
										$new_text = mb_substr($text, 0,$qty,'utf-8').'...';
									}
									return $new_text;
								}
								## Feedback auc_id
								$arr_aucID = array();
								$SqlFeed = "SELECT * FROM `auc_feedback`WHERE m_id = ".$_SESSION['aucuser_id']." ";
								$QueryFeed = mysql_query($SqlFeed);
								while ($Arr = mysql_fetch_array($QueryFeed)) {
									array_push($arr_aucID ,$Arr['reg_id']);
								}
								$v = implode(",", $arr_aucID) ;

								if(count($arr_aucID)!=0){
									$q = "AND ar.reg_id NOT IN ($v)";
								}


								$sql_auction = "SELECT * FROM auc_regist ar
													LEFT JOIN auc_member am ON ar.reg_memid  = am.m_id 
													WHERE ar.reg_id IN (".$_SESSION['arr_aucID'].") $q  
													GROUP BY ar.reg_id 
													ORDER BY ar.reg_id DESC";
								$q_auction = mysql_query($sql_auction );
								$l = 1;
								while ($r_auction = mysql_fetch_array($q_auction)) {
									if($l % 2 == 0){
										$change_color = 'style="background:rgb(233, 215, 198);"';
									}else{
										$change_color = 'style="background:#eee;"';
									}
								?>
								<tr <?=$change_color;?> >
									<td align="center" width="1">
										<?=$l;?>
									</td>
									<td align="center">
										<a id="imagebox" href="fileupload/<?=$r_auction['reg_file1']?>" title="<?=$r_auction['reg_file1']?>">
											<img src="fileupload/<?=$r_auction['reg_file1']?>" height="42" width="42" alt="<?=$r_auction['reg_file1']?>"/>
										</a>
									</td>
									<td align="left">
										<table width="100%" border="0" cellpadding="0" align="center" cellspacing="0">
											<tr>
												<td width="1">
													<?php
														$date_compare = strtotime($r_auction['reg_dateexpire']);
														$age_life = $date_compare - time();

														if($age_life < 0){
															// echo "[ปิดประมูลแล้ว] ";
															echo '<img src="images/icon_auction/icon/close.gif" align="absmiddle" border="0" width="32">';

															$rwin = mysql_fetch_array(mysql_query("SELECT * FROM auc_reply WHERE rep_aucid = '".$r_auction['reg_id']."' ORDER BY rep_id DESC"));
															mysql_query("update auc_regist set reg_winid = '".$rwin['rep_memid']."' WHERE reg_id = '".$r_auction['reg_id']."' ");

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
															echo '<img src="images/icon_auction/icon/ending1.gif" align="absmiddle" border="0" width="32">';
														}
														
														?>
												</td>
												<td>
													<a href="view.php?id=<?=$r_auction['reg_id']?>" target="_blank" title="<?=$r_auction['reg_wattuname']?>">
														<?= strAppenPer($r_auction['reg_wattuname'],30);?>
													</a>
												</td>
											</tr>
										</table>
									</td>
									<td align="left">
										<?=$r_auction['m_username']?>
									</td>
									<?php
										$strreplynow  = "SELECT * FROM auc_reply ac
																			INNER JOIN auc_member am ON ac.rep_memid = am.m_id
																		WHERE ac.rep_aucid='".$r_auction['reg_id']."' 
																		ORDER BY ac.rep_id DESC";
										$queryreplynow = mysql_query($strreplynow);
										$resultreplynow = mysql_fetch_array($queryreplynow);
									?>
									<td align="right">
										<?= number_format($resultreplynow['rep_priceoffer'])?>
									</td>
									<td align="center" width="1">
										<?=$resultreplynow['m_username'];?>
									</td>
									<td align="center" width="1">
										<?php
										if($age_life < 0){
											$r_aucreply_now = mysql_fetch_array(mysql_query("SELECT * FROM auc_reply WHERE rep_aucid = '".$r_auction['reg_id']."' ORDER BY rep_id DESC"));
											$r_member = mysql_fetch_array(mysql_query("SELECT * FROM auc_member WHERE m_id = '".$r_aucreply_now['rep_memid']."' "));
											echo $r_member['m_username'].'<br/>';
											echo number_format($r_aucreply_now['rep_priceoffer']);
										}
										?>
									</td>
									<td align="center" width="1">
										<span style="font-size: 12px;white-space: nowrap;">
											<?=date("d/m/y H:i:s",strtotime($r_auction['reg_dateexpire']));?>
										</span>
									</td>
									<td align="center" width="1">
										<a href="feedback.php?reg_id=<?=$r_auction['reg_id']?>">Feedbak</a>
									</td>
								</tr>
								<?
								$l++;
								}
								?>
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