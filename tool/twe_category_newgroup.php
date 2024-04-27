<?php
	ob_start();
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
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
		<!--Innova Editor-->
		<script type="text/javascript" src="/admin/innovaeditor/scripts/innovaeditor.js"></script>
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
			a{
				text-decoration: none;
			}
			.style11{
				white-space: nowrap;
			}
			.sl_catago_a{
				color: #fff;
				display: inline-block;
				margin: 0 10px;
			}
			button{
				font-size: 12px;
			}
		</style>
		<script type="text/javascript">
			$(document).ready(function(){

				var move_id = [];

				$("input[name=select_group]").click(function(){

					var dataVal = $(this).val();

					if($(this).is(":checked")){
						move_id.push(dataVal);
					}else{
						move_id = $.grep(move_id, function(value) {
							return value != dataVal;
						});
					}

					// console.log(move_id.toString())
					$("input[name=move_id]").val(move_id.toString());

				});

			});
		</script>
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
							<td width="250" valign="top" ><? include('sidemenu.php') ?></td>
							<td valign="top" bgcolor="#3f1d0e">
								<table width="100%" border="0" cellspacing="0" cellpadding="3">
									<tr>
										<td width="720" valign="top" bgcolor="#592D03">
											<?php
												$do_what = $_POST['do_what'];
												if($do_what == "add_main"){

													mysql_query("INSERT INTO `twe_category`( `catalog_id` ,`main_id`,`catalog_name`,`catalog_name_cn`) 
																					VALUES ( '', '".$_POST['category_main']."', '".$_POST['catalog_name']."','".$_POST['name_catalog_cn']."')");

													$inserted_id = mysql_insert_id();

													$arrFilter = array();
													$arrFilterUsually = array();

													$move_id = explode(",", $_POST['move_id']);
													foreach ($move_id as $key => $value) {
														array_push($arrFilter, "OR group_category_id LIKE  '%$value%'");
														array_push($arrFilterUsually, "OR catalog_id LIKE  '%$value%'");
													}

													$dataFilter = ltrim (implode("", array_unique($arrFilter)),'OR');
													$dataFilterUsually = ltrim (implode("", array_unique($arrFilterUsually)),'OR');

													$move = mysql_query("SELECT * FROM `product` WHERE 1 AND $dataFilter ");
													while ( $r = mysql_fetch_array($move) ) {
														$group_category_id = explode(",", $r['group_category_id']);
														$arrNewGroup = array($inserted_id);
														foreach ($group_category_id as $key => $value) {
															if (!in_array($value, $move_id)){
																array_push($arrNewGroup, $value);
															}
														}

														$removeNull = array_values(array_filter($arrNewGroup)); // remove null value
														$resultNewGroup = implode(",", array_unique($removeNull));

														mysql_query("UPDATE `product` SET group_category_id = '".$resultNewGroup."' WHERE product_id = ".$r['product_id']." ");
													}

													mysql_query("DELETE FROM `twe_category` WHERE catalog_id IN (".$_POST['move_id'].") ");


													// twe_category_usually
													$usually = mysql_query("SELECT * FROM `twe_category_usually` WHERE 1 AND $dataFilterUsually ");
													while ( $rUsually = mysql_fetch_array($usually) ) {
														$catalog_id = explode(",", $r['catalog_id']);
														$arrNewCatalog = array($inserted_id);
														foreach ($catalog_id as $key => $value) {
															if (!in_array($value, $move_id)){
																array_push($arrNewCatalog, $value);
															}
														}
														$removeNullUsually = array_values(array_filter($arrNewCatalog)); // remove null value
														$resultNewUsually = implode(",", array_unique($removeNullUsually));

														mysql_query("UPDATE `twe_category_usually` SET catalog_id = '".$resultNewUsually."' WHERE usually_id = ".$rUsually['usually_id']." ");
														
													}

													header("Location:twe_category_newgroup.php");
												}

												
												?>
											<script language="javASCript">

												function Reg_FromValidation(){
													var x_catalog_name = $("input[name=catalog_name]");
												
													if( (x_catalog_name.val() == "" )){
														alert('กรุณากรอกชื่อใหม่ภาษาไทย !!');
														return false;
													}
													else{
														return true;
													}
												}
											</script>
											<form method="post" action="" onSubmit="return Reg_FromValidation();"> <!-- target="reg_frm"  -->
												<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" >
													<tr>
														<td height="25" align="center"  colspan="2" >
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
																			<option value="twe_category_main.php">จัดการกลุ่ม</option>
																			<option value="twe_pra_category.php">จัดการหมวดหมู่</option>
																			<option value="twe_category_newgroup.php">สร้างชื่อใหม่</option>												
																	  </select>
																	</td>
																</tr>
																<tr>
																	<td colspan="2">&nbsp;</td>
																</tr>
															</table>
														</td>
													</tr>
													<tr>
														<td height="25" colspan="2" align="center" bgcolor="#4d1403" class="style11" >
															<span class="sidemenu">ตั้งหมวดหมู่ชื่อใหม่</span>
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
														<td width="27%" align="right" bgcolor="#3c1204" class="style11" style="padding-right:3px"><span class="sidemenu">ชื่อใหม่ภาษาไทย :</span></td>
														<td width="73%" bgcolor="#3c1204"><span class="sidemenu">
															<input name="catalog_name" type="text"  id="catalog_name" style="width: 80%;" />
															</span>
														</td>
													</tr>
													<tr>
														<td width="27%" align="right" bgcolor="#3c1204" class="style11" style="padding-right:3px"><span class="sidemenu">ชื่อใหม่ภาษาจีน :</span></td>
														<td width="73%" bgcolor="#3c1204">
															<span class="sidemenu">
																<input name="name_catalog_cn" type="text"  id="name_catalog_cn" style="width: 80%;" />
															</span>
														</td>
													</tr>
													<tr>
														<td bgcolor="#3c1204">&nbsp;</td>
														<td width="73%" bgcolor="#3c1204" align="left">
															<span class="sidemenu">
																<input type="hidden" name="move_id" value="" />
																<button type="submit" class="button_add">ตกลง</button>
																<input name="do_what" type="hidden" value="add_main" />
															</span>
														</td>
													</tr>
												</table>
												<iframe src="" name="reg_frm" width="1px" height="0px" frameborder="0" id="reg_frm"></iframe> 
											</form>
											<table width="100%" border="0" align="center" cellpadding="0" cellspacing="1">
												<tr class="sidemenu">
													<td align="center" bgcolor="#4d1403" class="style11" height="25">ลำดับ</td>
													<td align="center" bgcolor="#4d1403" class="style11" height="25">รายการ</td>
													<td align="center" bgcolor="#4d1403" class="style11">เลือก</td>
												</tr>
												<?php
													$q="SELECT * FROM `twe_category_main` ORDER BY order_num ASC";
													$db->query($q);
													while($db->next_record()){
													?>
												<tr height="20" bgcolor="#1c0801">
													<td width="1px" align="center" style="border-right:1px dashed #975000;">
														<table border="0" cellpadding="0" cellspacing="0" align="center">
															<tr>
																<td height="1px" width="1px" align="center">
																	<form method="post">
																		<input name="do_what" value="order_down" type="hidden"/>
																		<input name="main_id" value="<?=$db->f(main_id)?>" type="hidden"/>
																		<input name="order_num" value="<?=$db->f(order_num)?>" type="hidden"/>
																		<img onClick="$(this).parent().submit();" style="cursor:pointer;" src="images/arrow_up.png" border="0"/>
																	</form>
																	</a>
																</td>
															</tr>
															<tr>
																<td align="center">
																	<form method="post">
																		<input name="do_what" value="order_num" type="hidden"/>
																		<input name="main_id" value="<?=$db->f(main_id)?>" type="hidden"/>
																		<input name="current_order_num" value="<?=$db->f(order_num)?>" type="hidden"/>
																		<input class="flat_textbox" name="order_num" onchange="$(this).parent().submit();" value="<?=$db->f(order_num)?>" style="width:25px; text-align:center;" type="text"/>
																	</form>
																</td>
															</tr>
															<tr>
																<td height="1px" width="1px" align="center">
																	<form method="post">
																		<input name="do_what" value="order_up" type="hidden"/>
																		<input name="main_id" value="<?=$db->f(main_id)?>" type="hidden"/>
																		<input name="order_num" value="<?=$db->f(order_num)?>" type="hidden"/>
																		<img onClick="$(this).parent().submit();" style="cursor:pointer;" src="images/arrow_down.png" border="0"/>
																	</form>
																</td>
															</tr>
														</table>
													</td>
													<td style="padding:0 3px;">
														<span style="color:#FC0;">
															<?=$db->f(main_name)?> / <?=$db->f(main_name_cn)?>
														</span>
													</td>
													<td></td>
												</tr>
												<?php
													$l = 0;
													$q2=mysql_query("SELECT * FROM `twe_category` WHERE main_id = ".$db->f(main_id)." ORDER BY catalog_id DESC");
													while($db2=mysql_fetch_array($q2)){
														$l++;
														?>
												<tr height="20" bgcolor="<?php echo ($l%2==0)?'#321207':'#1c0801';?>">
													<td>&nbsp;</td>
													<td style="padding:0 3px;">
														<span style="color:#C3B063;">
														<?php echo $l;?>. <?=$db2['catalog_name']?> / <?=$db2['catalog_name_cn']?>
														</span>
													</td>
													<td align="center" width="1" style="padding:0px 5px">
														<input type="checkbox" name="select_group" value="<?=$db2['catalog_id']?>">
													</td>
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