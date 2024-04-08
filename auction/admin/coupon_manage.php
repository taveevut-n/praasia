<?php
	include('head.php');
	include('../config/function.php');

	if($_GET['d']){
		mysql_query("delete from auc_coupon where cp_id = '".$_GET['d']."' ");
		header("location:coupon_manage.php");
	}
?>
<body>
	<div id="wrapper">
		<?php
			include('header.php');
			?>
		<div id="container">
			<div class="box_content">
				<table width="1000px" border="0" align="center" cellpadding="0" cellspacing="0" class="condition-tdtext">
					<tr>
						<td width="200px" valign="top" style="background: rgb(82, 36, 15);">
							<? include('left_menu.php');?>
						</td>
						<td width="800px" valign="top" height="100%">
							<table width="100%" border="0" cellpadding="0" cellspacing="0">
								<tr>
									<td class="title">
										<span class="text_title">
											อัตราบัตรค่าธรรมเนียมการตั้งประมูลพระเครื่อง
										</span>
									</td>
								</tr>
								<tr>
									<td style="background: rgb(240, 238, 238);">
										<? include('../package_coupon.php');?>
									</td>
								</tr>
								<tr>
									<td class="title">
										<span class="text_title">
											ส้รางคูปอง
										</span>
									</td>
								</tr>
								<tr>
									<td style="text-align: justify;">
										<form id="form1" name="form1" method="post" action="coupon_manage_query.php" enctype="multipart/form-data" target="reg_frm" style="margin: 0;">
											<iframe src="" name="reg_frm" width="1px" height="0px" frameborder="0" id="reg_frm"></iframe>
											<table width="100%" border="0" cellpadding="0" align="center" cellspacing="0" class="tb_listdata">
												<tr>
													<td align="right"><b>แพ็กเกจ</b></td>
													<td>
														<select name="package" id="package">
															<?
															$strpackage = mysql_query("select * from auc_couponpackage order by cp_pid asc");
															while ($rpackage = mysql_fetch_array($strpackage)) {
															?>
															<option value="<?=$rpackage['cp_pid']?>"><?=$rpackage['cp_pname']?></option>
															<?
															}
															?>
														</select>
													</td>
												</tr>
												<tr>
													<td align="right"><b>จำนวน</b></td>
													<td>
														<input type="text" name="coupon_amunt" id="coupon_amunt" size="5" />
														<b>ใบ</b>
													</td>
												</tr>
												<tr>
													<td align="right"><b>ผู้ซื้อ</b></td>
													<td><input type="text" name="buyer" id="buyer" /></td>
												</tr>
												<tr>
													<td align="right">&nbsp;</td>
													<td>
														<input type="hidden" name="do_what" value="coupon_insert">
														<input type="submit" name="button" id="button" value="ตกลง" />
														<input type="reset" name="button2" id="button2" value="ยกเลิก" /></td>
												</tr>
											</table>
										</form>
									</td>
								</tr>
								<tr>
									<td class="title">
										<span class="text_title">
											รายการคูปองทั้งหมด
										</span>
									</td>
								</tr>
								<tr>
									<td>
										<table width="100%" border="0" cellpadding="0" align="center" cellspacing="0" class="tb_listdata">
											<tr align="center">
											  <td colspan="7" align="right">
											  	<input type="text" name="textfield3" id="textfield3" />
												<select name="select2" id="select2">
													<option>package</option>
												</select>
											</td>
											  <td width="56"><input type="submit" name="button3" id="button3" value="ค้นหา" /></td>
											</tr>
											<tr align="center">
											  <td class="title_table">รหัสคูปอง</td>
											  <td class="title_table">แพ็กเกจ</td>
											  <td class="title_table">ผู้ซื้อ</td>
											  <td class="title_table">ผู้ใช้</td>
											  <td class="title_table">วันที่สร้าง</td>
											  <td class="title_table">วันที่ใช้</td>
											  <td class="title_table">สถานะ</td>
											  <td class="title_table">ลบ</td>
											</tr>
											<?
											$sqlcoupon = mysql_query("select * from auc_coupon cp inner join auc_member am on cp.cp_buyers = am.m_id order by cp_id desc");
											while ($rcoupon = mysql_fetch_array($sqlcoupon)) {
												?>
											<tr>
											  <td align="center"><?=$rcoupon['cp_code']?></td>
											  <td align="center">
											  	<?
											  	$rpackage = mysql_fetch_array(mysql_query("select * from auc_couponpackage where cp_pid = '".$rcoupon['cp_fkpackage']."' "));
												echo $rpackage['cp_pname'];
												?>
											  </td>
											  <td><?=$rcoupon['m_name'].' '.$rcoupon['m_surname']?></td>
											  <td>
											  	<?
											  	$sqlcoupon_use = mysql_fetch_array(mysql_query("select * from auc_member where m_id = '".$rcoupon['cp_user']."' "));
											  	echo $sqlcoupon_use['m_name'].' '.$sqlcoupon_use['m_surname']
											  	?>
											  </td>
											  <td align="center">
											  	<?
											  	$date_2=strtotime($rcoupon['cp_datecreated']); 
												echo thai_date_shot($date_2);
											  	?>
											  </td>
											  <td align="center">
											  	<?
											  	$date_3=strtotime($rcoupon['cp_dateuse']); 
											  	if($date_3 != '-62170008124'){// null
													echo thai_date_shot($date_3);
											  	}
											  	?>
											  </td>
											  <td align="center"><?=$rcoupon['cp_status']?></td>
											  <td align="center">
											  	<a onclick="return confirm('กรุณายืนยันการลบอีกครั้ง !!!')" href="coupon_manage.php?d=<?=$rcoupon['cp_id']?>">
											  		<img src="images/del.png" border="0">
											  	</a>
											  </td>
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
			</div>
		</div>
		<?php
			include('footer.php');
		?>
	</div>
</body>
</html>