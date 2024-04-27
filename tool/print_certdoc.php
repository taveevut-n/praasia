<?php 
	include('../global.php');

	$certdoc_id = $_GET['certdoc_id'];
	$q="SELECT * FROM `certificate_doc` WHERE certdoc_id = '$certdoc_id' ";
	$db->query($q);
	static $v=1;
	$db->next_record();
	$timestamp = strtotime($db->f(certdoc_update));
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
		<head>
			<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
			<title>สำนักงานการันตีพระเว็บพระเอเซีย #<?=$db->f(certdoc_code);?></title>
			<!--Jquery print-->
			<script src="../func/jquery-ui-1.10.3/jquery-1.9.1.js"></script>
			<script type="text/javascript" src="../func/jquery.print.js"></script>
			<link rel="stylesheet" href="font-awesome/css/font-awesome.min.css">
			<style type="text/css">
				body{
					font-family: tahoma;
					font-size: 13px;
				}

				@media print{
					.break-page{
						page-break-after:always;
						float: none;
						margin: 0 auto;
						margin-top: 15px;
					}
					.break-page:last-child{
						display: none;
					}
					#print_btn{
						display:none;
					}
					.print-container{
						display: block;
					}
				}
				.table-headreport{
					border-collapse: collapse;
				}
				.table-headreport td{
					font-size: 14px;
					height: 20px;
					padding: 3px 5px;
				}
				.table-datalist{
					border-collapse: collapse;
				}
				.table-datalist td{
					padding: 3px 5px;
					height: 25px;
					line-height: 20px;
					border: 1px solid #909090;
				}
				.table-datalist td.title{
					font-size: 14px;
					font-weight: bold;
					white-space: nowrap;
					height: 25px;
					text-align: center;
				}
				.nowrap{
					white-space: nowrap;
				}
				.print-container{
					display: none;
					position: relative;
					/*overflow: hidden;
					height: 1px;*/
				}
				.page-content{
					position: relative;
					height: 700px;
					min-height: 700px;
					max-height: 700px;
					overflow: hidden;
				}
				.page-footer{
					display: block; 
	        position: absolute; 
	        bottom: 0;
	        width: 100%;
				}
			</style>
		</head>
		<body>
			<div class="main-container">
				<table width="1000" border="0" align="center" cellpadding="5" cellspacing="0">
					<tr>
						<td height="51" align="right">
							<button type="button" id="print_btn" onClick="$('.print-container').print();"> <i class="fa fa-print fa-lg"></i> Print</button>
						</td>
					</tr>
					<tr>
						<td valign="top">
								<table width="100%" border="0" cellspacing="0" cellpadding="0">
									<tr>
										<td height="60">
											<table width="100%" border="0" cellspacing="0" cellpadding="0">
													<tr>
														<td width="72%" valign="top" style="font-size:20px; font-weight:bold">
															สำนักงานการันตีพระเว็บพระเอเซีย
														</td>
														<td width="28%">
															<table width="100%" border="0" cellspacing="0" cellpadding="0">
																<tr>
																	<td align="center" style="font-size:18px; font-weight:bold">
																		เลขที่อ้างอิง : <?=$db->f(certdoc_code);?>
																	</td>
																</tr>
																<tr>
																	<td align="center" style="font-size:16px; font-weight:bold">
																		วันที่ : <?=date("d/m/Y",$timestamp)?>
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
											<table width="100%" border="0" cellspacing="0" cellpadding="0" class="table-headreport">
												<tr>
													<td width="13%" align="right"><strong>เรียนคุณ</strong></td>
													<td><?=$db->f(certdoc_name)?></td>
												</tr>
												<tr>
													<td align="right"><strong>เรื่อง</strong></td>
													<td>แจ้งผลการตรวจสอบพระเครื่อง</td>
												</tr>
												<tr>
													<td align="right">&nbsp;</td>
													<td>สำนักงานเว็บพระเอเชีย ขอแจ้งผลการตรวจสอบพระเครื่องที่ท่านส่งตรวจสอบดังรายละเอียด ดังต่อไปนี้</td>
												</tr>
											</table>
										</td>
									</tr>
								</table>

								<br/>

								<table width="95%" align="center" border="0" cellspacing="0" cellpadding="0" bordercolor="#000000" class="table-datalist">
									<tr>
										<td class="title">ลำดับ</td>
										<td class="title">รายการพระเครื่อง</td>
										<td class="title">ผลตรวจสอบ</td>
										<td class="title">หมายเลข ID</td>
										<td class="title" width="220px">หมายเหตุ</td>
									</tr>
									<?php
									$lrmain = 1;
									$cert_main = mysql_query("SELECT * FROM cert WHERE certdoc_id = '$certdoc_id' ORDER BY cert_id DESC");
									while ($result = mysql_fetch_array($cert_main)) {
										?>
									<tr>
										<td align="center" width="1">
											<?php echo $lrmain;?>
										</td>
										<td>
											<?php echo $result['cert_amulet'].$result['cert_skin'].$result['cert_year'].$result['cert_detail'];?>
										</td>
										<td align="center" align="center" width="1" class="nowrap">
											<?php
												$cert_result = array(
													'0' => "กำลังตรวจสอบ",
													'yes' => "แท้",
													'no' => "เก๊",
													'reject' => "ไม่ออกผล"
												);

												echo $cert_result[$result['cert_result']];
											?>      
										</td>
										<td align="center" width="1">
											<?php echo $result['cert_code'];?>
										</td>
										<td>
											<?php echo $result['cert_remark'];?>
										</td>
									</tr>
										<?php
										$lrmain++;
									}

									?>
								</table>

								<br/>

								<table width="100%" border="0" cellspacing="0" cellpadding="5">
									<tr>
										<td height="25" align="center" style="border-bottom:2px solid #000;">
											** หมายเหตุ เอกสารนี้ใช้สำหรับสมาชิกที่ระบุชื่อข้างต้นกับทางสำนักงานเว็บไซต์พระเอเซียเท่านั้น ห้ามนำไปใช้อ้างอิงกับบุคคลที่ 3
										</td>
									</tr>
									<tr>
										<td align="center">
											15/3 ถนนผดุงภักดี ตำบลหาดใหญ่ อำเภอหาดใหญ่ จังหวัดสงขลา 90110 โทรศัพท์ 074-262615, 083-1754074 WEBSITE : WWW.PRAASIA.COM
										</td>
									</tr>
								</table>
						</td>
					</tr>
				</table>
			</div>

			<!-- Print container-->
			<div class="print-container">

					<table width="1000" border="0" align="center" cellpadding="5" cellspacing="0">
						<tr>
							<td valign="top">
								<?php
									
									$lr = 1;
									$count = mysql_result(mysql_query("SELECT count(*) FROM cert WHERE certdoc_id = '$certdoc_id' "), 0);
									$count_lopp = ceil(($count/8));
									for ($i = 0; $i < $count_lopp ; $i++) { 
										?>
								<div class="page-content">
									<table width="100%" border="0" cellspacing="0" cellpadding="0">
										<tr>
											<td height="100">
												<table width="100%" border="0" cellspacing="0" cellpadding="0">
														<tr>
															<td width="72%" valign="top" style="font-size:16px; font-weight:bold">
																สำนักงานการันตีพระเว็บพระเอเซีย
															</td>
															<td width="28%">
																<table width="100%" border="0" cellspacing="0" cellpadding="0">
																	<tr>
																		<td align="center" style="font-size:16px; font-weight:bold">
																			เลขที่อ้างอิง : <?=$db->f(certdoc_code);?>
																		</td>
																	</tr>
																	<tr>
																		<td align="center" style="font-size:16px; font-weight:bold">
																			วันที่ : <?=date("d/m/Y",$timestamp)?>
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
												<table width="100%" border="0" cellspacing="0" cellpadding="0" class="table-headreport">
													<tr>
														<td width="13%" align="right"><strong>เรียนคุณ</strong></td>
														<td><?=$db->f(certdoc_name)?></td>
													</tr>
													<tr>
														<td align="right"><strong>เรื่อง</strong></td>
														<td>แจ้งผลการตรวจสอบพระเครื่อง</td>
													</tr>
													<tr>
														<td align="right">&nbsp;</td>
														<td>สำนักงานเว็บพระเอเชีย ขอแจ้งผลการตรวจสอบพระเครื่องที่ท่านส่งตรวจสอบดังรายละเอียด ดังต่อไปนี้</td>
													</tr>
												</table>
											</td>
										</tr>
									</table>

									<br/>

									<table width="95%" align="center" border="0" cellspacing="0" cellpadding="0" bordercolor="#000000" class="table-datalist">
										<tr>
											<td class="title">ลำดับ</td>
											<td class="title">รายการพระเครื่อง</td>
											<td class="title">ผลตรวจสอบ</td>
											<td class="title">หมายเลข ID</td>
											<td class="title" width="220px">หมายเหตุ</td>
										</tr>
										<?php

										$limit_start = ($i*8);
										$cert = mysql_query("SELECT * FROM cert WHERE certdoc_id = '$certdoc_id' ORDER BY cert_id DESC  LIMIT $limit_start,8 ");
										while ($result = mysql_fetch_array($cert)) {
											?>
										<tr>
											<td align="center" width="1">
												<?php echo $lr;?>
											</td>
											<td>
												<?php echo $result['cert_amulet'].$result['cert_skin'].$result['cert_year'].$result['cert_detail'];?>
											</td>
											<td align="center" align="center" width="1" class="nowrap">
												<?php
													$cert_result = array(
														'0' => "กำลังตรวจสอบ",
														'yes' => "แท้",
														'no' => "เก๊",
														'reject' => "ไม่ออกผล"
													);

													echo $cert_result[$result['cert_result']];
												?>      
											</td>
											<td align="center" width="1">
												<?php echo $result['cert_code'];?>
											</td>
											<td>
												<?php echo $result['cert_remark'];?>
											</td>
										</tr>
											<?php
											$lr++;
										}

										?>
									</table>

									<br/>

									<div class="page-footer">
										<table width="100%" border="0" cellspacing="0" cellpadding="5">
											<tr>
												<td height="25" align="center" style="border-bottom:2px solid #000;">
													** หมายเหตุ เอกสารนี้ใช้สำหรับสมาชิกที่ระบุชื่อข้างต้นกับทางสำนักงานเว็บไซต์พระเอเซียเท่านั้น ห้ามนำไปใช้อ้างอิงกับบุคคลที่ 3
												</td>
											</tr>
											<tr>
												<td align="center">
													15/3 ถนนผดุงภักดี ตำบลหาดใหญ่ อำเภอหาดใหญ่ จังหวัดสงขลา 90110 โทรศัพท์ 074-262615, 083-1754074 WEBSITE : WWW.PRAASIA.COM
												</td>
											</tr>
										</table>
									</div>
								</div>

									<div class="break-page"></div>

										<?php
									}
								?>
							</td>
						</tr>
					</table>
			</div>

		</body>
</html>