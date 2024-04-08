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

													$count = mysql_result(mysql_query("SELECT COUNT(*)+1 FROM `auction_category_main` "), 0);

													$q="INSERT INTO auction_category_main (main_name,main_name_cn,order_num) VALUES ('".$_POST['name_main']."','".$_POST['main_name_cn']."','$count')";
													$db->query($q);
													
													header("Location:auction_category_main.php");
												}

												if($do_what == "edit_main"){
													$q="update auction_category_main set main_name = '".$_POST['name_main']."',main_name_cn = '".$_POST['main_name_cn']."' where main_id = '".$_GET['e_main_id']."' ";
													$db->query($q);

													header("Location:auction_category_main.php");
												}

												if($_GET['e_main_id']){
													$rmain = mysql_fetch_array(mysql_query("SELECT * FROM auction_category_main where main_id = '".$_GET['e_main_id']."' "));
												}

												if($_GET['d_main_id']){	

													$q="DELETE FROM `auction_category_main` WHERE `main_id` = ".$_GET['d_main_id']." ";
													$db->query($q);
													$q="DELETE FROM `auction_category` WHERE `main_id` = ".$_GET['d_main_id']." ";
													$db->query($q);

													$l = 0;
													$q_main = mysql_query("SELECT * FROM auction_category_main ORDER BY order_num ASC");
													while($main = mysql_fetch_array($q_main)){
														$l++;
														mysql_query("update auction_category_main set order_num = '$l' where main_id = '".$_GET['d_main_id']."'");
													}		

													header("Location:auction_category_main.php");
												}
												
												?>

												<?php

												$do_what = $_POST["do_what"];
												if($do_what == "order_num"){

													$main_id = $_POST["main_id"];
													$current_order_num = $_POST["current_order_num"];
													$order_num = $_POST["order_num"];

													if($order_num != 0){//echo "asd".$order_num." ".$current_order_num." ";
														if( $order_num > $current_order_num ){
															$r_order_num_max = mysql_fetch_array(mysql_query("select max(order_num) as order_num_max from auction_category_main"));
															$r_order_num_max["order_num_max"];
															if( $order_num > $r_order_num_max["order_num_max"] ){
																$order_num = $r_order_num_max["order_num_max"];
															}
															mysql_query("update auction_category_main set order_num = ( order_num - 1 ) where order_num >= '$current_order_num' and order_num <= '$order_num'");
															mysql_query("update auction_category_main set order_num = '$order_num' where main_id = '$main_id'");
														}else if( $order_num < $current_order_num ){
															mysql_query("update auction_category_main set order_num = ( order_num + 1 ) where order_num <= '$current_order_num' and order_num >= '$order_num'");
															mysql_query("update auction_category_main set order_num = '$order_num' where main_id = '$main_id'");
														}
													}

													header("Location:auction_category_main.php");
												}

												if($do_what == "order_down"){

													$main_id = $_POST["main_id"];
													$order_num = $_POST["order_num"];

													$next_order = mysql_fetch_array(mysql_query("SELECT * FROM auction_category_main where order_num = '".($order_num-1)."'"));
													if(!empty($next_order)){
														mysql_query("update auction_category_main set order_num =  '$order_num' where main_id = '".$next_order["main_id"]."'");
														mysql_query("update auction_category_main set order_num = '".($order_num-1)."' where main_id = '$main_id'");
													}

													header("Location:auction_category_main.php");
												}

												if($do_what == "order_up"){

													$main_id = $_POST["main_id"];
													$order_num = $_POST["order_num"];

													$prev_order = mysql_fetch_array(mysql_query("SELECT * FROM auction_category_main where order_num = '".($order_num+1)."'"));
													if(!empty($prev_order)){
														mysql_query("update auction_category_main set order_num =  '$order_num' where main_id = '".$prev_order["main_id"]."'");
														mysql_query("update auction_category_main set order_num = '".($order_num+1)."' where main_id = '$main_id'");
													}

													header("Location:auction_category_main.php");
												}

												// Catalog Sort
												if($do_what == "catalogorder_num" ){

													$main_id = $_POST["main_id"];
													$catalog_id = $_POST["catalog_id"];
													$current_order_num = $_POST["current_order_num"];
													$order_num = $_POST["order_num"];

													if($order_num != 0){//echo "asd".$order_num." ".$current_order_num." ";
														if( $order_num > $current_order_num ){
															$r_order_num_max = mysql_fetch_array(mysql_query("SELECT MAX( order_num ) AS order_num_max FROM auction_category WHERE main_id = '$main_id' "));
															$r_order_num_max["order_num_max"];
															if( $order_num > $r_order_num_max["order_num_max"] ){
																$order_num = $r_order_num_max["order_num_max"];
															}

															mysql_query("UPDATE auction_category SET order_num = ( order_num - 1 ) WHERE main_id = '$main_id' AND order_num >= '$current_order_num' and order_num <= '$order_num'");
															mysql_query("UPDATE auction_category SET order_num = '$order_num' WHERE catalog_id = '$catalog_id'");

														}else if( $order_num < $current_order_num ){
															mysql_query("UPDATE auction_category SET order_num = ( order_num + 1 ) WHERE main_id = '$main_id' AND order_num <= '$current_order_num' and order_num >= '$order_num' ");
															mysql_query("UPDATE auction_category SET order_num = '$order_num' WHERE catalog_id = '$catalog_id'");
														}
													}

													header("Location:auction_category_main.php");

												}

												if($do_what == "catalogorder_down"){

													$main_id = $_POST["main_id"];
													$catalog_id = $_POST["catalog_id"];
													$order_num = $_POST["order_num"];

													$next_order = mysql_fetch_array(mysql_query("SELECT * FROM auction_category WHERE order_num = '".($order_num-1)."' AND main_id = '$main_id' "));
													if(!empty($next_order)){
														mysql_query("UPDATE auction_category SET order_num =  '$order_num' WHERE catalog_id = '".$next_order["catalog_id"]."'");
														mysql_query("UPDATE auction_category SET order_num = '".($order_num-1)."' WHERE catalog_id = '$catalog_id' ");
													}

													header("Location:auction_category_main.php");
												}

												if($do_what == "catalogorder_up"){

													$main_id = $_POST["main_id"];
													$catalog_id = $_POST["catalog_id"];
													$order_num = $_POST["order_num"];

													$prev_order = mysql_fetch_array(mysql_query("SELECT * FROM auction_category WHERE order_num = '".($order_num+1)."' AND main_id = '$main_id'  "));
													if(!empty($prev_order)){
														mysql_query("UPDATE auction_category SET order_num =  '$order_num' WHERE catalog_id = '".$prev_order["catalog_id"]."'");
														mysql_query("UPDATE auction_category SET order_num = '".($order_num+1)."' WHERE catalog_id = '$catalog_id'");
													}

													header("Location:auction_category_main.php");
												}

											?>
											<script language="javASCript">

												function Reg_FromValidation(){
													var x_name_main = $("input[name=name_main]");
												
													if( (x_name_main.val() == "" )){
														alert('กรุณากรอกชื่อกลุ่ม !!');
														return false;
													}
													else{
														return true;
													}
												}
											</script>
											<form method="post" action="" target="reg_frm" onSubmit="return Reg_FromValidation();">
												<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" >
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
																		<select name="select" onChange="selec();" id="se" style="height: 21px;">
																		  <option value="">--------กรุณาเลือกรายการ--------</option>
																			<option value="auction_category_main.php">จัดการกลุ่ม</option>
																			<option value="auction_pra_category.php">จัดการหมวดหมู่</option>
																			<option value="auction_category_newgroup.php">สร้างชื่อใหม่</option>												
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
														<td height="25" colspan="2" align="center" bgcolor="#4d1403" class="style11" >
															<span class="sidemenu">เพิ่ม แก้ไขกลุ่ม</span>
														</td>
													</tr>
													<tr>
														<td width="27%" align="right" bgcolor="#3c1204" class="style11" style="padding-right:3px">
															<span class="sidemenu">ชื่อกลุ่ม :</span>
														</td>
														<td width="73%" bgcolor="#3c1204">
															<span class="sidemenu">
																<input name="name_main" type="text"  id="name_main" value="<?=($_GET['e_main_id'])?$rmain['main_name']:""?>" size="45"/>
															</span>
														</td>
													</tr>
													<tr>
														<td width="27%" align="right" bgcolor="#3c1204" class="style11" style="padding-right:3px">
															<span class="sidemenu">ชื่อกลุ่มภาษาจีน :</span>
														</td>
														<td width="73%" bgcolor="#3c1204">
															<span class="sidemenu">
																<input name="main_name_cn" type="text"  id="main_name_cn" value="<?=($_GET['e_main_id'])?$rmain['main_name_cn']:""?>" size="45"/>
															</span>
														</td>
													</tr>
													<tr>
														<td width="27%" align="right" bgcolor="#3c1204" class="style11" style="padding-right:3px">
															
														</td>
														<td width="73%" bgcolor="#3c1204" align="left">
															<span class="sidemenu">
																<button type="submit" class="button_add"><?=($_GET['e_main_id'])?"แก้ไขกลุ่ม":"เพิ่มกลุ่ม"?></button>
																<input name="do_what" type="hidden" value="<?=($_GET['e_main_id'])?"edit_main":"add_main"?>" />
															</span>
														</td>
													</tr>
												</table>
												<iframe src="" name="reg_frm" width="1px" height="0px" frameborder="0" id="reg_frm"></iframe> 
											</form>
											<table width="100%" border="0" align="center" cellpadding="0" cellspacing="1">
												<tr class="sidemenu">
													<td align="center" bgcolor="#4d1403" class="sidemenu" height="25" style="color:#FC0">ลำดับ</td>
													<td align="center" bgcolor="#4d1403" class="sidemenu" height="25" style="color:#FC0">ชื่อกลุ่ม</td>
													<td align="center" bgcolor="#4d1403" class="sidemenu" style="color:#FC0">แก้ไข</td>
													<td align="center" bgcolor="#4d1403" class="sidemenu" style="color:#FC0">ลบ</td>
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
													<td align="center" width="1" style="padding:0px 5px"><span class="sidemenu"><a href="?e_main_id=<?=$db->f(main_id)?>" ><img src="images/edit.gif" alt="แก้ไข" width="16" height="18" border="0" /></a></span></td>
													<td align="center" width="1" style="padding:0px 5px"><span class="sidemenu"><a href="?d_main_id=<?=$db->f(main_id)?>"  onclick="return confirm('ยืนยันการลบข้อมูล')"><img src="images/del.gif" alt="ลบ" width="16" height="18" border="0" /></a></span></td>
												</tr>
												<?php
													$l = 0;
													$q2=mysql_query("SELECT * FROM `auction_category` WHERE main_id = ".$db->f(main_id)." ORDER BY order_num ASC");
													while($db2=mysql_fetch_array($q2)){
														$l++;
														?>
												<tr height="20" bgcolor="#1c0801">
													<td>&nbsp;</td>
													<td style="padding:0 3px;">

														<table border="0" align="left" cellpadding="0"  cellspacing="0">
															<tr>
																<td>
																	<table border="0" cellpadding="0" cellspacing="0" align="center">
																		<tr>
																			<td height="1px" width="1px" align="center">
																				<form method="post">
																					<input name="do_what" value="catalogorder_down" type="hidden"/>
																					<input name="main_id" value="<?=$db->f(main_id)?>" type="hidden"/>
																					<input name="catalog_id" value="<?php echo $db2['catalog_id'];?>" type="hidden"/>
																					<input name="order_num" value="<?php echo $db2['order_num'];?>" type="hidden"/>
																					<img onClick="$(this).parent().submit();" style="cursor:pointer;" src="images/arrow_up.png" border="0"/>
																				</form>
																				</a>
																			</td>
																		</tr>
																		<tr>
																			<td align="center">
																				<form method="post">
																					<input name="do_what" value="catalogorder_num" type="hidden"/>
																					<input name="main_id" value="<?=$db->f(main_id)?>" type="hidden"/>
																					<input name="catalog_id" value="<?php echo $db2['catalog_id'];?>" type="hidden"/>
																					<input name="current_order_num" value="<?php echo $db2['order_num'];?>" type="hidden"/>
																					<input class="flat_textbox" name="order_num" onChange="$(this).parent().submit();" value="<?php echo $db2['order_num'];?>" style="width:25px; text-align:center;" type="text"/>
																				</form>
																			</td>
																		</tr>
																		<tr>
																			<td height="1px" width="1px" align="center">
																				<form method="post">
																					<input name="do_what" value="catalogorder_up" type="hidden"/>
																					<input name="main_id" value="<?=$db->f(main_id)?>" type="hidden"/>
																					<input name="catalog_id" value="<?php echo $db2['catalog_id'];?>" type="hidden"/>
																					<input name="order_num" value="<?php echo $db2['order_num'];?>" type="hidden"/>
																					<img onClick="$(this).parent().submit();" style="cursor:pointer;" src="images/arrow_down.png" border="0"/>
																				</form>
																			</td>
																		</tr>
																	</table>
																</td>
																<td>
																	<span style="color:#C3B063;padding-left: 10px;">
																		<?=$db2['catalog_name']?> / <?=$db2['catalog_name_cn']?>
																	</span>
																</td>
															</tr>
														</table>
														
													</td>
													<td align="center"></td>
													<td align="center"></td>
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