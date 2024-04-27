<?php
	include('../global.php');
	if($_SESSION['adminid']=='' || !isset($_SESSION['adminid'])) {  
		redi4("login.php");
	} 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<title>ระบบจัดการเว็บไซต์</title>
		<style type="text/css">
			body {
				background-color: #000;
				margin-left: 0px;
				margin-top: 0px;
				margin-right: 0px;
				margin-bottom: 0px;	
			}
			.bh{
				color:#FC0;
				font-size:14px;
				height:30px;
			}
			.sidemenu{
				color:#FFF;
				font-size:12px;
				height:25px;
				border-bottom:1px solid #000;
				text-decoration:none;
			}
			.sidemenu:hover{
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
			.pay_texttitle{
				font-size: 13px;
				font-weight: bold;
				white-space: nowrap;
			}
		</style>
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
								<? include('sidemenu.php') ?>
							</td>
							<td valign="top" bgcolor="#3f1d0e">
								<table width="99%" border="1" align="right" cellpadding="3" cellspacing="0" bordercolor="#2a1100" style="border-collapse:collapse">
									<tr class="bh">
										<td width="1px" height="30" align="center" bgcolor="#5f2206">
											<span class="pay_texttitle">
												รหัสสมาชิก
											</span>
										</td>
										<td width="100px" height="30" align="center" bgcolor="#5f2206">
											<span class="pay_texttitle">
												ชื่อร้าน
											</span>
										</td>
										<td width="80px" align="center" bgcolor="#5f2206">
											<span class="pay_texttitle">
												หลักฐานทั้งหมด
											</span>
										</td>
										<td width="1px" align="center" bgcolor="#5f2206">
											<span class="pay_texttitle">
												คงเหลือ
											</span>
										</td>
										<td width="80px" align="center" bgcolor="#5f2206">
											<span class="pay_texttitle">
												กำหนดแพ็กเกจ
											</span>
										</td>
										<td width="1px" align="center" bgcolor="#5f2206">
											<span class="pay_texttitle">
												ต่ออายุ
											</span>
										</td>
										<td width="1px" align="center" bgcolor="#5f2206">
											<span class="pay_texttitle">
												สถานะ
											</span>
										</td>
									</tr>
									<?php
										$do_what = $_POST['do_what'];
										if($do_what=="packplus"){
											$hidmem_id = $_POST['hidmem_id'];
											$countpack = $_POST['packplus'];
											mysql_query("UPDATE member SET pack_amountformem = '$countpack' WHERE id = '$hidmem_id' ");
										}

										if($_GET['no_regist']){
											$rspacket = mysql_fetch_array(mysql_query("SELECT * FROM member_package WHERE package_id = '".$_GET["package_id"]."'"));
											$package_duration = $rspacket["package_duration"];

											mysql_query("UPDATE member SET date_extend = '".time()."', date_expire = '".(strtotime(date("Y-m-d")) + ($package_duration*86400) )."' WHERE id = '".$_GET["mem_id"]."'");

											mysql_query("UPDATE member_payment SET payment_manage = '2' WHERE no_regist = '".$_GET["no_regist"]."'");

											$count_order = mysql_num_rows(mysql_query("SELECT * FROM member_payment WHERE mem_id = '".$_GET["mem_id"]."' "));
											if($count_order > 1){
												mysql_query("UPDATE member SET score = (score + 10000) WHERE id = '".$_GET["mem_id"]."'");
											}

											$q = "SELECT * FROM member WHERE id = '".$_GET["mem_id"]."' ";
											$noid= new nDB();
											$noid->query($q);
											$noid->next_record();

											if ($noid->f(shop_id)==0) {
												$q = "SELECT * FROM member WHERE active ='2' ORDER BY shop_id DESC LIMIT 0,1 ";
												$rowid= new nDB();
												$rowid->query($q);
												$rowid->next_record();
												$shop_id = $rowid->f(shop_id);
												$q = "UPDATE member SET shop_id = '".$shop_id."'+1 WHERE id = '".$_GET["mem_id"]."' ";
												$db->query($q);
											}

											redi2();
										}

										if($_GET['no_id']){
											$status = $_GET['status'];
											$no_id = $_GET['no_id'];

											$q = "UPDATE member SET active = '$status' WHERE id = '$no_id' ";
											$db->query($q);
											$q = "UPDATE product SET active='$status' WHERE shop_id = '$no_id' ";
											$db->query($q);
											
											redi2();
										}
										
										$q = "SELECT * FROM member m 
													inner join member_payment mp on m.id = mp.mem_id 
													WHERE type='0' and id !='1' group by mp.mem_id order by id desc ";
										$db->query($q);
										static $v = 1;
										while($db->next_record()){
											$age_left = strtotime(date("Y-m-d",$db->f(date_expire))) - strtotime(date("Y-m-d"));
										?>
										<tr class="sidemenu" bgcolor="<?=($v%2==0)?"#3c1204":"#2f0d02"?>">
											<td align="center">
												<?=$db->f(id)?>
											</td>
											<td align="center">
												<a style="color:#ffffff;" href="http://www.praasia.com/shop_index.php?shop=<?=$db->f(id)?>" target="_blank">
												<?=$db->f(shopname)?>
												</a>
											</td>
											<td align="center">
												<a target="_blank" href="listmempay.php?mem_id=<?=$db->f(id)?>">
													<img src="../images/list.png" alt="Pause" width="24" height="24" border="0">
												</a>
												<?
													$q2 = "SELECT * FROM member_payment WHERE mem_id = '".$db->f(id)."' order by pay_id desc limit 1";
													$rspremise= new nDB();
													$rspremise->query($q2);
													$rspremise->next_record();
													if($rspremise->f(payment_manage)==1){
														?>
															<a target="_blank" href="mempay_viewpack.php?pay_id=<?=$rspremise->f(pay_id)?>"> | มีการแจ้ง</a>
														<?
													}
												?>
											</td>
											<td align="right">
													<?
														$numproduct = mysql_num_rows(mysql_query("select *from product WHERE shop_id = '".$db->f(id)."' "));
														echo number_format($numproduct).' / '.number_format($db->f(pack_amountformem));
													?>
													&nbsp;&nbsp;
											</td>
											<td align="center">
												<form method="post">
													<input type="hidden" name="do_what" value="packplus">
													<input type="hidden" name="hidmem_id" value="<?=$db->f(id);?>">
													<input type="text" name="packplus" style="width:45px;">
													<input type="submit" name="btnsubmit">
												</form>
											</td>
											<td align="center">
												<?php
												if($db->f(active)!='1' && $db->f(active)!='0'){
													$queyrmp = mysql_query("SELECT * FROM member_payment WHERE mem_id = '".$db->f(id)."' order by pay_id desc limit 1 ");
													$rsmp = mysql_fetch_array($queyrmp);
													$cn = mysql_num_rows($queyrmp);
													if($cn>0){
														$payment_manage = $rsmp['payment_manage'];
														if($payment_manage==0){
															?>
																<img src="../images/stop.png" alt="Disable" width="24" height="24" border="0">
															<?
														}else if($payment_manage==1){
															?>
																<a href="?no_regist=<?=$rsmp['no_regist'];?>&amp;mem_id=<?=$rsmp['mem_id'];?>&amp;package_id=<?=$rsmp['payment_packege'];?>" >
																	<img src="../images/wait.png" alt="Disable" width="24" height="24" border="0">
																</a>
															<?
														}else if($payment_manage==2){
															?>
																<img src="../images/play.png" alt="Disable" width="24" height="24" border="0">
															<?
														}
													}else{
														?>
															<img src="../images/play.png" alt="Enable" width="24" height="24" border="0">
														<?
													}
												}else{
													?>
														<img src="../images/stop.png" alt="Disable" width="24" height="24" border="0">
													<?
												}
												?>
											</td>
											<td align="center">
												<?php
													if($db->f(active)=='0'){
												?>
												<a href="?no_id=<?=$db->f(id)?>&status=1" >
													<img src="../images/stop.png" alt="Disable" width="24" height="24" border="0">
												</a>
												<?php
													}
													if($db->f(active)=='1'){
												?>
												<a href="?no_id=<?=$db->f(id)?>&status=2" >
													<img src="../images/wait.png" alt="Pause" width="24" height="24" border="0">
												</a>
												<?php
													}
													if($db->f(active)=='2'){
												?>
												<a href="?no_id=<?=$db->f(id)?>&status=0" >
													<img src="../images/play.png" alt="Enable" width="24" height="24" border="0">
												</a>
												<?php
													}
												?>
											</td>
										</tr>
									<?php $v++; } ?>
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