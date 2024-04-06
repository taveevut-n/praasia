<?php
	include("global.php"); 
	include("global_counter.php");
	$sql = "select * from member m inner join member_payment mp on m.id = mp.mem_id where mp.no_regist='".$_GET['order']."'";
	$db->query($sql);
	$db->num_rows();
	$db->next_record();

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

	<title>
		Member Payment
	</title>

	<style>

		@page {
			margin:20px 25px 10px 25px;
		}

		@media print {
			table tr td {
				font-family:"Serif";
				font-size:12px;
			}
		}

		html, body {
			margin:0px;
			padding:0px;
			width:100%;
			height:100%;
		}

		body {
			vertical-align:top;
			font-family:"Serif";
			font-size:12px;
			color:#444444;
			/*background-color:#444444;*/
			overflow-y:scroll;
		}

		a { font-family:"Serif"; font-size:12px; color:#444444; }
		a:link { text-decoration:none; color:#444444; }
		a:hover { text-decoration:none; color:#ff0000; }
		a:active { text-decoration:none; color:#444444; }
		a:visited { text-decoration:none; color:#444444; }

		table {
			border-collapse:collapse;
		}
		.print_container {
			margin:0px auto;
			width:800px;
			background-color:#f5f5f5;
			border:1px dashed #444444;
		}

		.report_container {
			margin:0px auto;
			width:800px;
			background-color:#ffffff;
			border:0px solid #ff0000;
		}

		.detail_topic {
			width:1px;
			height:20px;
			vertical-align:bottom;
			white-space:nowrap;
		}
		.detail_text {
			height:20px;
			text-align:left;
			padding: 0 0 0 13px;
			vertical-align:bottom;
			border-bottom:1px dotted #444444;
		}

		.box_container {
			position:relative;
			padding:5px;
			padding-top:20px;
			padding-bottom:10px;
			border-top:1px solid #444444;
			overflow:hidden;
		}
		.box_title {
			position:absolute;
			left:0px;
			top:0px;
			padding-left:5px;
			padding-right:5px;
			padding-bottom:3px;
			border-right:1px solid #444444;
			border-bottom:1px solid #444444;
		}
		.orderid{
			color: red;
			font-weight: bold;
		}
	</style>
	<script type="text/javascript" src="http://praasia.com/func/jquery-1.11.1.min.js"></script>
	<script type="text/javascript" src="http://praasia.com/func/jquery.print.js"></script>
	<script type="text/javascript">
		function report_print(){
			$(".report_container").print();
		}
	</script>
</head>
<body>
<div class="print_container">
	<table width="100%" border="0" cellpadding="0" cellspacing="0">
		<tr>
			<td>
				&nbsp;
			</td>
			<td>
				&nbsp;
			</td>
			<td style="width:1px;">
				<a href="javascript:void(0)" onclick="report_print();">
					<img src="http://praasia.com/images/print.jpg"/>
				</a>
			</td>
			<td style="padding-left:3px; padding-right:3px; width:1px; white-space:nowrap;">
				<a href="javascript:void(0)" onclick="report_print()">
					PRINT THIS MEMBER PAYMENT
				</a>
			</td>
		</tr>
	</table>
</div>
<div class="report_container">
	<table width="100%" border="0" cellpadding="0" cellspacing="0">
		<tr>
			<td style="padding-top:5px; padding-bottom:5px; text-align:center;">
				<img src="http://www.praasia.com/images/logoreport.png" height="75px"/>
			</td>
		</tr>
		<tr>
			<td>
				<table style="border:1px solid #444444;" align="center" border="0" cellpadding="0" cellspacing="0">
					<tr>
						<td style="padding:3px; padding-left:7px; padding-right:7px;">
							MEMBER PAYMENT
						</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td style="padding-bottom:10px;">
				<table width="100%" border="0" cellpadding="0" cellspacing="0">
					<tr>
						<td style="width:49%; vertical-align:top;">
							<table width="100%" border="0" cellpadding="0" cellspacing="0">
								<tr>
									<td class="detail_topic">
										注册单编号 / เลขที่ใบชำระ
									</td>
									<td class="detail_text orderid">
										<?	
											echo $db->f(no_regist);
										?>
									</td>
								</tr>
							</table>
							<table width="100%" border="0" cellpadding="0" cellspacing="0">
								<tr>
									<td class="detail_topic">店主名稱 / ชื่อเจ้าของร้าน</td>
									<td class="detail_text">
										<?=$db->f(name);?>
									</td>
								</tr>
							</table>
							<table width="100%" border="0" cellpadding="0" cellspacing="0">
								<tr>
									<td class="detail_topic">
										地址 / ที่อยู่
									</td>
									<td class="detail_text">
										<?=$db->f(address);?>
									</td>
								</tr>
							</table>
							<table width="100%" border="0" cellpadding="0" cellspacing="0">
								<tr>
									<td class="detail_topic">電子郵件 / อีเมลล์</td>
									<td class="detail_text">
										<?=$db->f(email);?>
									</td>
								</tr>
							</table>
							<table width="100%" border="0" cellpadding="0" cellspacing="0">
								<tr>
									<td class="detail_topic">邮政编码 / รหัสไปรษณีย์</td>
									<td class="detail_text">
										<?=$db->f(postcode);?>
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
				<table style="border-left:1px solid #444444; border-right:1px solid #444444; border-bottom:1px solid #444444;" width="100%" border="0" cellpadding="0" cellspacing="0">
					<tr>
					  <td style="width:49%; vertical-align:top; border-right:1px solid #444444;">
					    <div class="box_container">
							<div class="box_title">选择的项目 / แพคเกจที่เลือก</div>
						    <table width="100%" border="0" cellpadding="0" cellspacing="0">
								<tr>
									<td class="detail_topic" style="vertical-align:top">
										项目 / แพคเกจ
									</td>
									<td class="detail_text" style="text-align:justify">
										<?
											$sql = "select * from member_package where package_id = '".$db->f(package_id)."' ";
											mysql_query("SET NAMES 'utf8'");
											$query = mysql_query($sql);
											$rspackage = mysql_fetch_array($query);

											echo $rspackage["package_name"];
										?>
									</td>
								</tr>
								<tr>
									<td>
										&nbsp;
									</td>
									<td>
										&nbsp;
									</td>
								</tr>
								<tr>
									<td colspan="2">
										&nbsp;
									</td>
								</tr>
							</table>
					    </div>
					</td>
					  <td style="width:49%; vertical-align:top;">
						<div class="box_container">
							<div class="box_title">商店详情 / รายละเอียดร้านค้า</div>
							<table width="100%" border="0" cellpadding="0" cellspacing="0">
								<tr>
									<td>
										<table width="100%" border="0" cellpadding="0" cellspacing="0">
											<tr>
												<td class="detail_topic">
													店鋪名稱 / ชื่อร้านค้า
												</td>
												<td class="detail_text">
													<?=$db->f(shopname)?>
												</td>
											</tr>
										</table>
									</td>
								</tr>
								<tr>
									<td>
										<table width="100%" border="0" cellpadding="0" cellspacing="0">
											<tr>
												<td class="detail_topic">
													店主名商店详情 / รายละเอียดร้านค้า
												</td>
												<td class="detail_text">
													<?=$db->f(welcome)?>
												</td>
											</tr>
										</table>
									</td>
								</tr>
								<tr>
									<td>
										<table width="100%" border="0" cellpadding="0" cellspacing="0">
											<tr>
												<td class="detail_topic">
													如何付款 / วิธีการชำระเงิน
												</td>
												<td class="detail_text">
													<?
														$paymentstep = array(
															'1' => '节约 / ออมทรัพย์' , 
															'2' => '经常帐 /กระแสรายวัน'
														);
														echo $paymentstep[$db->f(banktype1)];
													?>
												</td>
											</tr>
										</table>
									</td>
								</tr>
							</table>
						</div>
						</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td>
				<table style="border-left:1px solid #444444; border-right:1px solid #444444; border-bottom:1px solid #444444;" width="100%" border="0" cellpadding="0" cellspacing="0">
					<tr>
					  <td style="width:49%; vertical-align:top; border-right:1px solid #444444;">
					    <div class="box_container">
							<div class="box_title">如何保证产品 / การรับประกัน</div>
								<table width="100%" border="0" cellpadding="0" cellspacing="0">
									<tr>
										<td>
											<table width="100%" border="0" cellpadding="0" cellspacing="0">
												<?
										    		if($db->f(warranty2)!=0){
										    			?>
										    				<tr>
																<td class="detail_topic">
																	1.
																</td>
																<td class="detail_text">
																	รับประกันพระแท้ภายในระยะเวลา <?= $db->f(warrantydetail1)?> วัน นับแต่ลูกค้าได้รับพระไป
																</td>
															</tr>
										    			<?
										    		}
										    		if($db->f(warranty3)!=0){
										    			?>
										    				<tr>
																<td class="detail_topic">
																	2.
																</td>
																<td class="detail_text">
																	รับประกันความพอใจในระยะเวลา <?= $db->f(warrantydetail2)?> วัน ไม่หักเปอร์เซ็นต์
																</td>
															</tr>
															<tr>
																<td>
																	&nbsp;
																</td>
																<td class="detail_text">
																	(เมื่อได้รับพระแล้วไม่ถูกใจ) แต่หากเกินจำนวนวันหัก <?= $db->f(warrantydetail3)?> เปอร์เซ็นต์
																</td>
															</tr>
										    			<?
										    		}
										    		if($db->f(warranty4)!=0){
										    			?>
										    				<tr>
																<td class="detail_topic">
																	3.
																</td>
																<td class="detail_text">
																	พระต้องอยู่ในสภาพเดิม ไม่ชำรุดหักบิ่น เสียสภาพ ล้างผิว
																</td>
															</tr>
										    			<?
										    		}

										    		if($db->f(warranty5)!=0){
										    			?>
										    				<tr>
																<td class="detail_topic">
																	4.
																</td>
																<td class="detail_text">
																	ยินดีรับซื้อคืนในราคาตลาดขณะนั้น
																</td>
															</tr>
										    			<?
										    		}

										    		if($db->f(warranty6)!=0){
										    			?>
										    				<tr>
																<td class="detail_topic">
																	5.
																</td>
																<td class="detail_text">
																	นำมาแลกเปลี่ยน กับองค์ใหม่ได้ หากท่านต้องการซื้อพระองค์อื่นโดยหัก <?=$db->f(warrantydetail4)?>
																</td>
															</tr>
															<tr>
																<td class="detail_topic">
																	&nbsp;
																</td>
																<td class="detail_text">
																	เปอร์เซ็นต์
																</td>
															</tr>
										    			<?
										    		}
										    	?>
											</table>
										</td>
									</tr>
								</table>
					    </div>
					</td>
					  <td style="width:49%; vertical-align:top;">
						<div class="box_container">
							<div class="box_title">如何付款 / จำนวนเงินที่ต้องชำระชำระ</div>
							<table width="100%" border="0" cellpadding="0" cellspacing="0">
								<tr>
									<td>
										<table width="100%" border="0" cellpadding="0" cellspacing="0">
											<tr>
												<td class="detail_topic">
													总计 / จำนวนเงิน
												</td>
												<td class="detail_text">
													<?
														echo number_format($rspackage["package_price"]).' บาท';
													?>
												</td>
											</tr>
										</table>
									</td>
								</tr>
							</table>
						</div>
						</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td>
				<table width="100%" border="0" cellpadding="0" cellspacing="0">
					<tr>
						<td class="detail_topic">
							注备 / หมายเหตุ
						</td>
						<td class="detail_text">
							&nbsp;
						</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td>
				<table width="100%" border="0" cellpadding="0" cellspacing="0">
					<tr>
						<td class="detail_topic">
							使用已到期 / หมดอายุการใช้งาน
						</td>
						<td class="detail_text">
							<?
								$rsdateexpire = mysql_fetch_array(mysql_query("select * from member where id = '".$db->f(mem_id)."'"));
								
								echo date("d F Y",$rsdateexpire['date_expire']);
							?>
						</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td>
				<style type="text/css">
					.howtono{
						line-height: 30px;
					}
					.titleno{
						border-bottom:1px rgb(229, 211, 211) solid;
						font-size: 13px;
						font-weight: bold;
					}
				</style>
				<div class="titleno">
					วิธีการแจ้งชำระเงิน / 如何通知付款
				</div>

				<ul class="howtono">
					<li>
						คลิก <strong>ปุ่มแจ้งชำระ จะแสดงหน้าต่างดังนี้</strong> / 点击 通知付款后，就会展示网页如下
						
					</li>
					<li>
						<strong>ทำการกรอกข้อมูลให้ครบถ้วน / 把资料填完整</strong>
						<ul class="howtono">
							<li>นำ <strong>เลขที่ใบชำระ</strong> กรอกลงในช่อง เลขที่ใบชำระ / 把注册单编号填在注册单编号格里</li>
							<li>เลือกธนาคารที่ท่านได้ทำการโอนเงิน / 选择汇款银行名</li>
							<li>แนบหลักฐานการชำระเงิน / 上传汇款单证件</li>
						</ul>
					</li>
				</ul>
			</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td align="center">
				<style type="text/css">
					.btnnotica{
						border: 2px rgb(201, 201, 201) solid;
						padding: 8px 20px;
						width: 146px;
						background: rgb(192, 115, 32);
						color: rgb(255, 255, 255);
						border-radius: 11px;
						font-size: 13px;
					}
					.btnnotica:hover{
						cursor: pointer;
						background: rgb(156, 90, 19);
					}
					.btnnotica a{
						color: rgb(255, 255, 255);
						font-size: 26px;
						font-family: monospace;
					}
				</style>
				<div class="btnnotica" onclick="window.location.href='notice_payment.php?order=<?=$_GET['order'];?>'">
					<a>Next >></a>
				</div>
			</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
		</tr>
	</table>
</div>
</body>
</html>
