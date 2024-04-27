<? include('../global.php');?>
<?php if($_SESSION['adminid']=='' || !isset($_SESSION['adminid'])) {  
	redi4("retime.php");
} ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<title>ระบบจัดการเว็บไซต์</title>
		<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
		<style type="text/css">
			body {
				background-color: #000;
				margin-left: 0px;
				margin-top: 0px;
				margin-right: 0px;
				margin-bottom: 0px;
			}
			.bh {
				color:#FC0;
				font-size:14px;
				height:30px;
			}
			.sidemenu {
				color:#FFF;
				font-size:12px;
				height:25px;
				border-bottom:1px solid #000;
				text-decoration:none;
			}
			.sidemenu:hover {
				text-decoration:none;
			}
			a:link {
				text-decoration: none;
			}
			a:visited {
				text-decoration: none;
			}
			a:hover {
				text-decoration: none;
			}
			a:active {
				text-decoration: none;
			}

		</style>
		<script type="text/javascript" src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
	</head>
	<body>
		<table width="1000" border="0" align="center" cellpadding="0" cellspacing="0">
			<tr>
				<td><img src="/admin/images/head.jpg" width="1098" height="288" /></td>
			</tr>
			<tr>
				<td bgcolor="#311407">
					<table width="100%" border="0" cellspacing="3" cellpadding="0">
						<tr>
							<td width="250" valign="top">
								<? 
									include('sidemenu.php') 
								?>
							</td>
							<td valign="top" bgcolor="#3f1d0e">
								<table align="center">
									<tr>
										<td>&nbsp;</td>
									</tr>
									<tr>
										<td align="center">
											<style type="text/css">
												.tblshowdata td{
													border: 1 yellow px;
													background: #ddd0d0;
													padding: 5px 5px;
													font-size: 13px;
													font-weight: bold;
												}
											</style>
											<?php
												$pay_id = $_GET['pay_id'];
												$q2 = "SELECT * FROM member_payment mp left join member m on mp.mem_id = m.id WHERE mp.pay_id = '$pay_id' order by mp.pay_id desc limit 1";
												$rspremise= new nDB();
												$rspremise->query($q2);
												$rspremise->next_record();
											?>
											<table border="0" class="tblshowdata" align="center">
												<tr>
													<td width="253" align="right">Package / 项单分类 :</td>
													<td width="326">
														<?
														$sqlrs = "select * from member_package where package_id = '".$rspremise->f(payment_packege)."' ";
														mysql_query("SET NAMES utf8");
														$rspackage = mysql_fetch_array(mysql_query($sqlrs));
														echo $rspackage[package_name];
														?>
													</td>
												</tr>
												<tr>
													<td width="253" align="right">ชื่อร้านค้า / 店鋪名稱 :</td>
													<td width="326"><?=$rspremise->f(shopname);?></td>
												</tr>
												<tr>
													<td align="right">ชื่อเจ้าของร้าน / 店主名稱 :</td>
													<td><?=$rspremise->f(name);?></td>
												</tr>
												<tr>
													<td align="right">เบอร์โทรศัพท์ / 联系号码 :</td>
													<td><?=$rspremise->f(tel);?></td>
												</tr>
												<tr>
													<td align="right">ธนาคารที่โอน / 如何汇款 :</td>
													<td>
														<?
														$bankarray = array(
															'1' => 'ธนาคารกสิกรไทย (Kasikorn Bank) ',
															'2' => 'ธนาคารกรุงไทย (Krungthai Bank)',
															'3' => 'ธนาคารไทยพาณิชย์ (Siam Commercial Bank)',
															'4' => 'Paypal',
															'5' => 'ชำระที่ศูยน์ / 在网站服务中心支付',
															'6' => 'อื่นๆ / 其它'
														);
														
														echo $bankarray[$rspremise->f(bank)];?>
													</td>
												</tr>
												<tr>
													<td align="right">จำนวนเงิน / 总额 :</td>
													<td>
														<?
														$rspk = mysql_fetch_array(mysql_query("select * from member_package where package_id = '".$rspremise->f(payment_packege)."' "));
														echo number_format($rspk['package_price'],2);
														?>
													</td>
												</tr>
												<tr>
													<td align="right">วันที่ / 日期 :</td>
													<td><?=$rspremise->f(created);?></td>
												</tr>
												<tr>
													<td align="right">หลักฐานการชำระเงิน / 汇款件单 :</td>
													<td>&nbsp;</td>
												</tr>
												<tr>
													<td colspan="2" align="center"><img width="570" src="../payment_file/<?=$rspremise->f(pic);?>"></td>
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
			<tr>
				<td>
					<? include('footer.php');?>
				</td>
			</tr>
		</table>
	</body>
</html>