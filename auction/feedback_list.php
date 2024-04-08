<?php
	include('../global.php');

	include('head.php');
	include('config/function.php');
	// echo date("Y-m-d H:i:s");
	?>
	<style type="text/css">
		.tb_listfeedbsck{
			border-collapse: collapse;
			border: 1px #ccc solid
		}
		.tb_listfeedbsck td{
			padding: 3px 5px;
		}
		.text_title_feed{
			font-size: 13px;
			font-weight: bold;
		}
		.text_desc_feed{
			font-size: 13px;
		}
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
							<span class="text_yellpw"><b>Feedback ถึงคุณ <?=$_GET['name']?></b></span>
						</td>
					</tr>
					<tr>
						<td colspan="2" align="center" style="height:100%;">
							<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
								<?php
									$Sql = "SELECT * FROM `auc_feedback` WHERE feed_to = ".$_GET['id']." ";
									$Query = mysql_query($Sql);
									while ($Arr = mysql_fetch_array($Query)) {
										$r_member = mysql_fetch_array(mysql_query("SELECT * FROM `auc_member` WHERE m_id = ".$Arr['m_id']." "));
										?>
								<tr>
									<td>
										<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="tb_listfeedbsck">
											<tr>
												<td style="background: #DC9F9F;box-shadow: 0px 5px 13px 0.5px rgb(179, 72, 72) inset;">
													<table width="100%" border="0" cellpadding="0" align="center" cellspacing="0">
														<tr>
															<td width="50%" align="left">
																<span class="text_title_feed">
																	<?=$r_member['m_name']?>
																</span>
															</td>
															<td width="50%" align="right">
																<span class="text_title_feed">
																	<?=date("d/m/Y H:i:s",strtotime($Arr['feed_created']))?>
																</span>
															</td>
														</tr>
													</table>
												</td>
											</tr>
											<tr>
												<td style="background: #FBFBFB;">
													<table width="100%" border="0" cellpadding="0" align="center" cellspacing="0">
														<tr>
															<td width="1px" align="left">
																<?php
																	$arr_feedicon = array(
																		"1" => "feed_icon1.png",
																		"2" => "feed_icon2.png",
																		"3" => "feed_icon3.png"
																	);
																?>
																<img src="images/<?=$arr_feedicon[$Arr['feed_type']]?>" border="0">
															</td>
															<td align="left">
																<div class="text_desc_feed">
																	<?=$Arr['feed_text']?>
																</div>
															</td>
														</tr>
													</table>
												</td>
											</tr>
										</table>
									</td>
								</tr>
								<tr>
									<td height="10px"></td>
								</tr>
										<?
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