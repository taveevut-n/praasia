<?php
	ob_start();

	include('../global.php');
	if($_SESSION['adminid']=='' || !isset($_SESSION['adminid'])) {  
		header("Location:login.php");
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<title>ระบบจัดการเว็บไซต์</title>
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
		<!--Innova Editor-->
		<script type="text/javASCript" src="/admin/innovaeditor/scripts/innovaeditor.js"></script>
		<style type="text/css">
			html,body{
				font-size: 13px;
				font-family: Tahoma, Geneva, sans-serif;
			}
			body {
				background-color: #000;
				margin: 0;
			}
			.bh{
				color:#FC0;
				height:30px;
			}
			.sidemenu{
				color:#FFF;
				height:25px;
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
			.sl_catago_a{
				color: #fff;
				display: inline-block;
				margin: 0 10px;
			}
			input[type="text"]{
				height: 16px;
			}
			select{
				height: 24px;
			}
			button{
				font-size: 12px;
			}
			.translate_filter {
				padding-left:10px;
				padding-right:10px;
				width:1px;
				white-space:nowrap;
				cursor:pointer;
				transition: all 0.2s ease 0s;
			}
			.translate_filter:hover {
				background-color:#a55e00;
			}
			.translate_button {
			    background-color: #FCA909;
			    border-bottom: 1px solid #C46104;
			    border-left: 1px solid #C46104;
			    border-radius: 0 0 5px 5px;
			    border-top: 1px solid #C46104;
			    color: #FFFFFF;
			    cursor: pointer;
			    font-family: Tahoma;
			    height: 35px;
			    padding: 5px;
			    width: 200px;
			    z-index: 1;
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
							<td width="250" valign="top" ><?php include('sidemenu.php') ?></td>
							<td valign="top" bgcolor="#3f1d0e">
								<table width="100%" border="0" cellspacing="0" cellpadding="3">
									<tr>
										<td width="720" valign="top" bgcolor="#592D03">
											<?php
												$do_what = $_POST['do_what'];

												if($do_what == "add_category"){

													$count = mysql_result(mysql_query("SELECT COUNT(*)+1 FROM `twe_category` WHERE main_id = ".$_POST['category_main']."  "), 0);

													$q="INSERT INTO `twe_category`( `catalog_id` ,`main_id`,`catalog_name`,`catalog_name_cn`,order_num) VALUES ( '', '".$_POST['category_main']."', '".$_POST['catalog_name']."','".$_POST['name_catalog_cn']."','$count')";
													$db->query($q);

													header("Location:twe_pra_category.php");
												}

												if($do_what == "edit_category"){

													$q="UPDATE `twe_category` SET `catalog_name` = '".$_POST['catalog_name']."', 
																												`catalog_name_cn` = '".$_POST['name_catalog_cn']."', 
																												`main_id` = '".$_POST['category_main']."' 
																										WHERE `catalog_id` = ".$_POST['h_sub_id']." ";
													$db->query($q);

													header("Location:twe_pra_category.php");
												}

												if($_GET['d_sub_id']){	
													
													$resultmain = mysql_result(mysql_query("SELECT main_id FROM twe_category WHERE `catalog_id` = ".$_GET['d_sub_id']." "), 0);
													
													$q="DELETE FROM `twe_category` WHERE `catalog_id` = ".$_GET['d_sub_id']." ";
													$db->query($q);

													$l = 1;
													$q_main = mysql_query("SELECT * FROM twe_category WHERE main_id = '$resultmain' ORDER BY order_num ASC");
													while($result = mysql_fetch_array($q_main)){
														mysql_query("UPDATE twe_category SET order_num = '$l' WHERE catalog_id = '".$result['catalog_id']."'");
														$l++;
													}	

													header("Location:twe_pra_category.php");
												}

												if($_GET['e_sub_id']){
													$q="SELECT * FROM `twe_category` WHERE catalog_id=".$_GET['e_sub_id']." ";
													$db5 = new nDB();
													$db5->query($q);
													$db5->next_record();
												}
												?>
											<script language="javASCript">

												function Reg_FromValidation(){
													var x_category_main = $("select[name=category_main]");
													var x_catalog_name = $("input[name=catalog_name]");
												
													if( x_category_main.val() == 0 ){
														alert('กรุณาเลือกกลุ่ม !!');
														return false;
													}
													else if( (x_catalog_name.val() == "" )){
														alert('กรุณากรอกรุ่นพระเครื่อง !!');
														return false;
													}
													else{
														return true;
													}
												}
											</script>
											<form method="post" action="" onSubmit="return Reg_FromValidation();">
												<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" >
													<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
													<tr>
														<td height="25" colspan="2" align="center" >
															<table width="100%" border="0" align="center" cellpadding="0" cellspacing="1" class="tb-regicourse">
																<tr>
																	<td align="right">
																		<script language="javASCript">
																			function selec(){
																				var ab=document.getElementById('se');
																				location.href=ab.value;
																			}
																		</script>
																		<span style="color:#ffffff;">เลือกรายการจัดการ :</span> 
																		<select name="select" onchange="selec();" id="se" style="height: 21px;">
																			<option value="">--------กรุณาเลือกรายการ--------</option>
																			<option value="twe_category_main.php">จัดการหมวดหมู่ใหญ่</option>
																			<option value="twe_pra_category.php">จัดการหมวดหมู่ย่อย</option>	
																			<option value="twe_category_newgroup.php">สร้างชื่อใหม่</option>												
																		</select>
																	</td>
																</tr>
																<tr>
																	<td>&nbsp;</td>
																</tr>
															</table>
														</td>
													</tr>
													<tr>
														<td align="center" colspan="2">
															<div style="display:none;">
																<table border="0" cellpadding="0" cellspacing="0">
																	<tr>
																		<td>&nbsp;
																			
																		</td>
																		<td style="color:#FC0;">
																			<?php include('admin_translate_bo.php'); ?>
																		</td>
																	</tr>
																</table>
															</div>
															<span style="cursor:pointer;" onClick="translate_slide($(this));" isopen="0">
																<span class="translate_button" style="color:#F00" >
																	คลิกสู่ระบบแปลภาษา/点击进入翻译系统... ▼
																</span>
																<span style="	display:none; color:#090" class="translate_button">
																	คลิกเพื่อปิดระบบแปลภาษา/点击收回翻译系统... ▲
																</span>
															</span>
															<script>
																function translate_slide(x_this){
																	var isopen = x_this.attr("isopen");
																	if(isopen == "1"){
																		x_this.attr("isopen","0");
																		x_this.find("span:eq(0)").show();
																		x_this.find("span:eq(1)").hide();
																		x_this.prev().slideUp();
																	}else{
																		x_this.attr("isopen","1");
																		x_this.find("span:eq(0)").hide();
																		x_this.find("span:eq(1)").show();
																		x_this.prev().slideDown();
																	}
																}
															</script>
															<div style="margin-bottom:10px;">&nbsp;</div>
														</td>
													</tr>
													<tr>
														<td height="25" colspan="2" align="center" bgcolor="#4d1403" class="style11" >
															<span class="sidemenu">
																<h3>เพิ่ม แก้ไขหมวดสินค้า</h3> 
															</span>
														</td>
													</tr>
													<tr>
														<td width="27%" align="right" bgcolor="#3c1204" class="style11" style="padding-right:3px"><span class="sidemenu">เลือกกลุ่ม :</span></td>
														<td width="73%" bgcolor="#3c1204">
															<span class="sidemenu">
																<select name="category_main">
																	<option value="0">--เลือกกลุ่ม--</option>
																	<?php
																		$qmain = mysql_query("SELECT * FROM `twe_category_main` ORDER BY order_num ASC");
																		while ( $rmain = mysql_fetch_array($qmain)) {
																			?>
																		<option value="<?=$rmain['main_id']?>" <?php if($_GET['e_sub_id']){if($db5->f(main_id) == $rmain['main_id']){echo "selected";}}?> ><?=$rmain['main_name']?> / <?=$rmain['main_name_cn']?></option>
																			<?php
																		}
																	?>
																</select>
															</span>
														</td>
													</tr>
													<tr>
														<td width="27%" align="right" bgcolor="#3c1204" class="style11" style="padding-right:3px"><span class="sidemenu">รุ่นพระเครื่อง :</span></td>
														<td width="73%" bgcolor="#3c1204"><span class="sidemenu">
															<input name="catalog_name" type="text"  id="catalog_name" value="<?=($_GET['e_sub_id'])?$db5->f(catalog_name):""?>" size="45" />
															</span>
														</td>
													</tr>
													<tr>
														<td width="27%" align="right" bgcolor="#3c1204" class="style11" style="padding-right:3px"><span class="sidemenu">รุ่นพระเครื่องภาษาจีน :</span></td>
														<td width="73%" bgcolor="#3c1204">
															<span class="sidemenu">
																<input name="name_catalog_cn" type="text"  id="name_catalog_cn" value="<?=($_GET['e_sub_id'])?$db5->f(catalog_name_cn):""?>" size="45" />
															</span>
														</td>
													</tr>
													<tr>
														<td bgcolor="#3c1204">&nbsp;</td>
														<td bgcolor="#3c1204">
															<button type="submit" class="button_add"><?=($_GET['e_sub_id'])?"แก้ไขหมวดสินค้า":"เพิ่มหมวดสินค้า"?></button>
															<input name="do_what" type="hidden" value="<?=($_GET['e_sub_id'])?'edit_category':'add_category'?>" />
															<?php
																if($_GET['e_sub_id']){
															?>
															<input name="h_sub_id" type="hidden" id="h_sub_id" value="<?=$db5->f(catalog_id)?>" />
															<input name="h_name_catalog" type="hidden" id="h_name_catalog" value="<?=$db5->f(catalog_name)?>"/>
															<?php
																}
															?>
														</td>
													</tr>
												</table>
												<iframe src="" name="main_frm" width="1px" height="0px" frameborder="0" id="main_frm"></iframe>
											</form>
											<br/>
											<table width="100%" border="0" align="center" cellpadding="0" cellspacing="1">
												<tr>
													<td height="25" colspan="4" align="right" bgcolor="#4d1403">
														<table border="0" width="100%" cellpadding="0" cellspacing="1">
															<tr>
																<td align="left">
																	
																</td>
																<td align="right">
																	<span class="sidemenu">
																		<button type="button" onclick="add_group();">เพิ่มไปยังกลุ่ม</button>
																		<select name="group_val" onchange="get_valonGroup(this.value);" style="min-width:200px;height: 21px;">
																			<option value="0">---เลือกกลุ่ม---</option>
																			<?php
																				$qcat = mysql_query("select * from twe_category_main order by order_num asc");
																				while ( $r = mysql_fetch_array($qcat)) {
																					?><option value="<?php echo $r['main_id'];?>" <?php if($r['main_id'] == $_GET['g']){echo "selected";}?>><?php echo $r['main_name'];?> / <?php echo $r['main_name_cn'];?></option><?php
																				}
																			?>
																		</select>
																	</span>
																	<script type="text/javascript">
																		function add_group(){
																			var group_val = $("select[name=group_val]");
																			if($("input[name='group[]']").is(':checked')){
																				if(group_val.val() != 0){
																					var arr = [];
																					$("input[name='group[]']:checked").each(function(index,item){
																						arr[index] = item.value;
																					});

																					$.ajax({
																						url: "catalog_query.php",
																						type: "POST",
																						data: {do_what:"update_group",v: arr,group_val:group_val.val()},
																						cache: false,
																						processData: true,
																						success: function (result) {
																							location.reload();
																						}
																					});
																				}
																				else{
																					alert('กรุณาเลือกกลุ่มที่ท่านต้องการ !!');
																				}
																			}else{
																				alert('กรุณาเลือกหมวดหมู่ที่ท่านต้องการจัดกลุ่ม !!');
																			}
																		}

																		function get_valonGroup(val){
																			window.location.href='?g='+val;
																		}
																	</script>
																</td>
															</tr>
														</table>
													</td>
												</tr>
												<tr height="25" class="sidemenu" bgcolor="#4d1403">
													<td align="center" class="style11">ชื่อหมวดสินค้า</td>
													<td align="center" class="style11">เลือก</td>
													<td align="center" class="style11">แก้ไข</td>
													<td align="center" class="style11">ลบ</td>
												</tr>
												<?php
													$q1 = mysql_query("SELECT * FROM twe_category_main ORDER BY order_num ASC");
													while ( $db1 = mysql_fetch_array($q1)) {
														?>
												<tr height="25" bgcolor="#1c0801">
													<td style="padding-left:3px">
														<span style="color:#FC0;">
														<?=$db1['main_name']?> / <?=$db1['main_name_cn']?>
														</span>
													</td>
													<td align="center"></td>
													<td align="center" style="padding:0px 5px"></td>
													<td align="center" style="padding:0px 5px"></td>
												</tr>
														<?php
														$l=0;
														$q2=mysql_query("SELECT * FROM `twe_category` WHERE main_id = ".$db1['main_id']." ORDER BY order_num ASC ");
														while($db2=mysql_fetch_array($q2)){
															$l++;
															?>
												<tr height="25px" bgcolor="<?=($l%2 == 0)?'#1c0801':'#3D251D';?>">
													<td style="padding-left:3px">
														<span style="color:#fff;">
														&nbsp;&nbsp;<?=$l;?> . <?=$db2['catalog_name']?> / <?=$db2['catalog_name_cn']?>
														</span>
													</td>
													<td align="center">
														<?php
															// if($_GET['g']){
															// 	$filter_num = mysql_num_rows(mysql_query("select * from twe_category_main where catalog_id like '%".$db2['catalog_id']."%' and group_id = '".$_GET['g']."' "));
															// 	if($filter_num > 0){
															// 		$text_checked = 'checked';
															// 	}
															// 	else{
															// 		$text_checked = '';
															// 	}
															// }
														?>
														<input type="checkbox" name="group[]" value="<?=$db2['catalog_id']?>">
													</td>
													<td align="center" style="padding:0px 5px"><span class="sidemenu"><a href="?e_sub_id=<?=$db2['catalog_id']?>" ><img src="images/edit.gif" alt="แก้ไข" width="16" height="18" border="0" /></a></span></td>
													<td align="center" style="padding:0px 5px"><span class="sidemenu"><a href="?d_sub_id=<?=$db2['catalog_id']?>"  onclick="return confirm('ยืนยันการลบข้อมูล')"><img src="images/del.gif" alt="ลบ" width="16" height="18" border="0" /></a></span></td>
												</tr>
															<?php
														}
													}
													?>
											</table>
										</td>
									</tr>
								</table>
							</td>
						</tr>
					</table>
					<div style="height:50px;"></div>
				</td>
			</tr>
		</table>
	</body>
</html>