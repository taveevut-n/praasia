<? include('../global.php');?>
<?php if($_SESSION['adminid']=='' || !isset($_SESSION['adminid'])) {  
	redi4("retime.php");
} ?>
<?php
	if ($_GET["del"]) {
		$q = "DELETE FROM `member_payment` WHERE pay_id = '".$_GET["del"]."' ";
		mysql_query($q);
		redi4("http://www.praasia.com/tool/listmempay.php");
	}
?>
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
											<table border="0"class="tblshowdata">
												<tr align="center">
													<td>วันที่</td>
													<td>หลักฐานการชำระเงิน</td>
													<td>ลบ</td>
												</tr>
												<?
													if ($_GET['mem_id']) {
														$_SESSION['mem_id'] = $_GET['mem_id'];
													}
													$mem_id = $_SESSION['mem_id'];
													$q2 = "SELECT * FROM member_payment mp left join member m on mp.mem_id = m.id WHERE mp.mem_id = '$mem_id' order by mp.pay_id desc";
													$rspremise= new nDB();
													$rspremise->query($q2);
													while ($rspremise->next_record()) {
														?>
															<tr>
																<td><?=$rspremise->f(created)?></td>
																<td align="center">
																	<a href="mempay_viewpack.php?pay_id=<?=$rspremise->f(pay_id)?>">
																		<img src="../images/view.png" alt="Pause" width="24" height="24" border="0">
																	</a>
																</td>
																<td align="center"> <a href="?del=<?=$rspremise->f(pay_id)?>">ลบ</a> </td>
															</tr>
														<?
													}
												?>
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