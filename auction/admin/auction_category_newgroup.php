<?php
	include('head.php');

	$do_what = $_POST['do_what'];
	if( $do_what == "update_to_db"){
		$sqlu_lang = "update auc_language set ".$_POST['field_name']." = '".$_POST['text_lang']."' where content_id = '".$_POST['content_id']."' ";
		mysql_query($sqlu_lang);
	}
	if( $do_what == "condition_insert"){
		$sqlu_lang = "update auc_language set ".$_POST['field_name']." = '".$_POST['text_lang']."' where content_id = '".$_POST['content_id']."' ";
		mysql_query($sqlu_lang);
	}
?>
<body>
<style>
	.sidemenu{
		color:#FC0;
	}
</style>
	<div id="wrapper">
		<?php
			include('header.php');
			?>
		<div id="container">
			<div class="box_content">
				<script type="text/javascript">
					$(document).ready(function(){

						$(".tab_select").click(function(){
							var x_index = $(".tab_select").index(this);
							$(".tab_select").removeClass("active");
							$(".tab_select:eq("+x_index+")").addClass("active");

							$(".tab_contenttext").hide();
							$(".tab_contenttext:eq("+x_index+")").show();
						});
						<?php
							if($_POST['do_what'] == "condition_insert"){
								$text_click = 1;
							}else{
								$text_click = 0;
							}
						?>
						$(".tab_select:eq(<?=$text_click?>)").trigger("click");
					});
				</script>
				<table width="1000px" border="0" align="center" cellpadding="0" cellspacing="0" class="condition-tdtext">
					<tr>
						<td width="200px" valign="top" style="background: rgb(82, 36, 15);">
							<? include('left_menu.php');?>
						</td>
<td width="800" valign="top" bgcolor="#592D03">
											<?php
												$do_what = $_POST['do_what'];
												if($do_what == "add_main"){

													mysql_query("INSERT INTO `auction_category`( `catalog_id` ,`main_id`,`catalog_name`,`catalog_name_cn`) 
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

													mysql_query("DELETE FROM `auction_category` WHERE catalog_id IN (".$_POST['move_id'].") ");


													// auction_category_usually
													$usually = mysql_query("SELECT * FROM `auction_category_usually` WHERE 1 AND $dataFilterUsually ");
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

														mysql_query("UPDATE `auction_category_usually` SET catalog_id = '".$resultNewUsually."' WHERE usually_id = ".$rUsually['usually_id']." ");
														
													}

													header("Location:auction_category_newgroup.php");
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
																		<select name="select" onChange="selec();" id="se" style="height: 21px;">
																		  <option value="">--------กรุณาเลือกรายการ--------</option>
																			<option value="auction_category_main.php">จัดการกลุ่ม</option>
																			<option value="auction_pra_category.php">จัดการหมวดหมู่</option>
																			<option value="auction_category_newgroup.php">สร้างชื่อใหม่</option>												
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
																		$qmain = mysql_query("SELECT * FROM `auction_category_main` ORDER BY order_num ASC");
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
													<td align="center" bgcolor="#4d1403" class="sidemenu" height="25" style="color:#FC0">ลำดับ</td>
													<td align="center" bgcolor="#4d1403" class="sidemenu" height="25" style="color:#FC0">รายการ</td>
													<td align="center" bgcolor="#4d1403" class="sidemenu" style="color:#FC0">เลือก</td>
												</tr>
												<?php
													$q="SELECT * FROM `auction_category_main` ORDER BY order_num ASC";
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
																		<input class="flat_textbox" name="order_num" onChange="$(this).parent().submit();" value="<?=$db->f(order_num)?>" style="width:25px; text-align:center;" type="text"/>
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
													$q2=mysql_query("SELECT * FROM `auction_category` WHERE main_id = ".$db->f(main_id)." ORDER BY catalog_id DESC");
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
			</div>
		</div>
		<?php
			include('footer.php');
		?>
	</div>
</body>
</html>