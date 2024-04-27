<? include('../global.php')?>
<?php if($_SESSION['adminid']=='' || !isset($_SESSION['adminid'])) {  
	redi4("login.php");
	} ?>
<?php set_page($s_page,$e_page=20); //นำส่วนนี้ิไว้ด้านบน ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<title>ระบบจัดการเว็บไซต์</title>
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
		<script src="/ieditor/ckeditor.js"></script>
		<script src="/ckfinder/ckfinder.js"></script> 
		<style type="text/css">
			body {
				background-color: #000;
				margin-left: 0px;
				margin-top: 0px;
				margin-right: 0px;
				margin-bottom: 0px;
				font-family: helvetica,thonburi,tahomaว
			}
			.bh{
				color:#FC0;
				font-size:12px;
				height:30px;
			}
			.sidemenu{
				color:#FFF;
				font-size:12px;
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
			.box_keyword {
				display: block;
			}
			.new_keyword {
				background: #CD0D05;
				position: relative;
				padding: 4px 1px 5px 8px;
				/*float: left;*/
				margin-right: 5px;
				margin-bottom: 5px;
				color: #fff;
				border-radius: 6px;
			}
			.btnclose {
				background: transparent;
				margin-left: 10px;
				padding: 3px 7px 5px;
				font-weight: bold;
				border-left: 1px solid #F23830;
				position: absolute;
			  right: 0;
			  top: 1px;
			}
			.btnclose:hover {
				cursor: pointer;
				box-shadow: inset 0 3px 5px rgba(0,0,0,.125);
			}
			.table-prakey{
				border-collapse: collapse;
			}
			.table-prakey td{
				padding: 2px 3px;
			}
		</style>
	</head>
	<body>
		<?php
			if($_GET['d_product_id']){
				mysql_query("DELETE FROM product_key WHERE proky_id = '".$_GET['d_product_id']."' ");
				header("location:product_key.php?s_page=".$_GET['s_page']);
			}	
			?>
		<?php
			if($_GET['hot_id']){
				        
			}
			?>  
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
											<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0" class="table-prakey">
												<tr>
													<td>
														<script language="javascript">
															function selec(){
																var ab=document.getElementById('se');
																location.href=ab.value;
															}
														</script>
														<?php
															$do_what = $_POST["do_what"];

															if($do_what == "edit"){
																	$pushkeyword = array();
																	foreach ($_POST['keyword_text'] as $key => $value) {
																		array_push($pushkeyword, $value);
																	}
																	$result_keyword = implode(",", $pushkeyword);
																	$q="UPDATE `product_key` 
																		SET 	`proky_keyword` = '$result_keyword' ,
																					`proky_name`  = '".$_POST['proky_name']."' 
																		WHERE `proky_id` =".$_POST['h_product_id']." ";
																	$db->query($q);

																	if(trim($_FILES["file"]["tmp_name"]) != "")
																	{
																		$filepart = $_FILES["file"]["tmp_name"];
																		$filename = $_FILES["file"]["name"];
																		$ext = explode(".", $filename);
																		$filename = rand(1,99999).time().'.' .end($ext);
																		$new_images = "Thumbnails_".$filename;

																		// call function upload
																		upload_origin($filepart,"../product_key/",$filename);
																		upload_resize($filepart,"../product_key/resize90/",$new_images,90);

																		$q="UPDATE `product_key` SET `proky_file` = '$filename',proky_file90 = '$new_images' WHERE `proky_id` =".$_POST['h_product_id']." ";
																		$db->query($q);
																	}     
																	al('แก้ไขข้อมูลเรียบร้อยแล้ว');
																
																	echo "<script language=\"javascript\">window.location='product_key.php?s_page=".$_GET['s_page']."'</script>";	
																}

																if($do_what == "add"){
																	$pushkeyword = array();
																	foreach ($_POST['keyword_text'] as $key => $value) {
																		array_push($pushkeyword, $value);
																	}
																	$result_keyword = implode(",", $pushkeyword);
																		$q="INSERT INTO `product_key` 
																				( 
																					`proky_id` ,
																					`proky_name`, 
																					`proky_keyword`
																				) VALUES (
																					'',
																					'".$_POST['proky_name']."',
																					'".$result_keyword."'
																				)";
																		$db->query($q);
																		$ins_id = mysql_insert_id();

																		$filepart = $_FILES["file"]["tmp_name"];
																		$filename = $_FILES["file"]["name"];
																		$ext = explode(".", $filename);
																		$filename = rand(1,99999).time().'.' .end($ext);
																		$new_images = "Thumbnails_".$filename;

																		// call function upload
																		upload_origin($filepart,"../product_key/",$filename);
																		upload_resize($filepart,"../product_key/resize90/",$new_images,90);

																		$q="UPDATE `product_key` SET `proky_file` = '$filename',proky_file90 = '$new_images' WHERE `proky_id` = ".$ins_id." ";
																		$db->query($q);

																	al('เพิ่มข้อมูลเรียบร้อยแล้ว');
																	redi2();  
																}
															?>
														<?php
															if($_GET['d_product_id']){
															 	
															}
															?>
														<?php
															if($_GET['e_product_id']){
																$q="SELECT * FROM `product_key` WHERE proky_id=".$_GET['e_product_id']." ";
																$db5=new nDB();
																$db5->query($q);
																$db5->next_record();
															}
															?>
														<form action="" method="post" enctype="multipart/form-data" name="form1" id="form1">
															<table width="95%" border="1" align="center" cellpadding="3" cellspacing="0" style="border:1px #8C3F17 solid" >
																<tr>
																	<td width="28%" bgcolor="#3c1204">&nbsp;</td>
																	<td width="72%" bgcolor="#3c1204">&nbsp;</td>
																</tr>
																<tr>
																	<td align="right" bgcolor="#3c1204" class="style11"   style="padding-right:3px; border-bottom:#592D03 1px solid">
																		<span class="sidemenu">รูปภาพ</spam>
																	</td>
																	<td align="left" valign="bottom" bgcolor="#3c1204" class="style11"  style="padding-right:3px; border-bottom:#592D03 1px solid">
																		<?php
																			if($_GET["e_product_id"] != ""){
																				echo '<img src="../product_key/resize90/'.$db5->f(proky_file90).'" border="0" /></br>';
																			}
																		?>
																		<input name="file" type="file" id="file" />
																		<span class="sidemenu"> Width less than 700 pixel </span>
																	</td>
																</tr>
																<tr>
																	<td align="right" bgcolor="#3c1204" class="style11"  style="padding-right:3px"><span class="sidemenu">ชื่อพระ</span></td>
																	<td align="left" valign="top" bgcolor="#3c1204">
																		<input type="text" name="proky_name" value="<?=($_GET['e_product_id'])?$db5->f(proky_name): ''?>">
																	</td>
																</tr>
																<tr>
																	<td align="right" bgcolor="#3c1204" class="style11"  style="padding-right:3px"><span class="sidemenu">คำที่ใช้ในการค้นหา</span></td>
																	<td align="left" valign="top" bgcolor="#3c1204">
																		<div id="box_keyword">
																			<? 
																			if($_GET['e_product_id']){
																				if($db5->f(proky_keyword) <> ""){
																					$explode_word = explode(",",$db5->f(proky_keyword));
																					foreach ($explode_word as $key => $value) {
																						?>
																					<div class="new_keyword">
																						<input type="hidden" name="keyword_text[]" value="<?=$value;?>"/>
																						<?=$value;?>
																						<span class="btnclose" onclick="tag_product_key($(this),'<?php echo $value?>',<?php echo $_GET['e_product_id']?>)">x</span>
																					</div>
																						<?
																					}
																				}
																			}	
																			?>
																		</div>
																		<input name="keyword" type="text" id="keyword" size="60"  onkeyUp="get_keyword(this.value);" style="height: 18px;width: 190px;margin-right: 4px;" placeholder="ป้อน keyword ให้กับสินค้าของท่าน">
																		<script type="text/javascript">
																			function get_keyword(x_value){
																				var keyword = new Array();
																				if(x_value.indexOf(',') > -1 ){
																					var v_array = x_value.split(',');
																					$.each(v_array,function(index,val){
																						var x_val = $.trim(val);
																						if(x_val.trim()){
																							var texthtml = '<div class="new_keyword"><input type="hidden" name="keyword_text[]" value="'+x_val+'"/>'+x_val+'<span class="btnclose" onclick="$(this).parent().remove()">&#215;</span></div>';
																							$("#box_keyword").append(texthtml);
																							$("#keyword").val('').focus();
																						}
																					});
																				}
																			}
																			function tag_product_key(x_obj,x_val,x_id){
																				x_obj.parent().remove();
																				var tag_item = [];
																				$.each($("input[name='keyword_text[]']"), function (index, val) {
																					tag_item.push(val.value);
																				});
																				$.ajax({
																					url: "../backend_notif_delete.php",
																					type: "POST",
																					dataType: "JSON",
																					data: {do_what:"tag_product_key",val:x_val,id:x_id,item:tag_item},
																					cache: false,
																					processData: true,
																					success: function (result) {
																						console.log(result)
																					}
																				});
																			}
																		</script>
																	</td>
																</tr>
																<tr>
																	<td bgcolor="#3c1204">&nbsp;</td>
																	<td bgcolor="#3c1204">
																		<input type="hidden" name="do_what" value="<?=($_GET['e_product_id'])?"edit":"add"?>">
																		<input type="submit" name="Submit" class="button_add" value="<?=($_GET['e_product_id'])?"แก้ไข":"เพิ่ม"?>" />
																		<input type="hidden" name="h_product_id" id="h_product_id" value="<?=$_GET["e_product_id"]?>" />
																	</td>
																</tr>
															</table>
														</form>
														<br />
														<br />
														<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
															<tr class="sidemenu">
																<td height="35" align="center" bgcolor="#4d1403" class="style11" >รูปภาพ</td>
																<td align="center" bgcolor="#4d1403" class="style11" >ชื่อพระ</td>
																<td align="center" bgcolor="#4d1403" class="style11" >คำที่ใช้ในการค้นหา</td>
																<td align="center" bgcolor="#4d1403" class="style11" colspan="2">จัดการ</td>
															</tr>
															<?php
																$q="SELECT * FROM `product_key` WHERE 1 ";
																$db->query($q);             
																$total=$db->num_rows();             
																$q.=" ORDER BY proky_id DESC LIMIT $s_page,$e_page ";
																$db->query($q);
																static $v=1; 
																while($db->next_record()){
																?>    
															<tr>
																<td width="1" height="100" align="center" bgcolor="#3c1204" >
																	<img src="<?=($db->f(proky_file90)!="")?"../product_key/resize90/".$db->f(proky_file90):"../images/clear.gif"?>" width="90" height="90"  border="0" />
																</td>
																<td width="200" bgcolor="#3c1204" >
																	<span style="color:#FFFFFF; font-size:12px">
																	<?=$db->f(proky_name)?>
																	</span>
																</td>
																<td bgcolor="#3c1204" >
																	<span style="color:#FFFFFF; font-size:12px">
																	<?=$db->f(proky_keyword)?>
																	</span>
																</td>
																<td width="1" align="center" bgcolor="#3c1204" style="padding-right: 10px;">
																	<a href="?s_page=<?=$_GET['s_page']?>&amp;e_product_id=<?=$db->f(proky_id)?>" >
																		<img src="images/edit.gif" alt="แก้ไข" width="19" height="23" border="0" />
																	</a>
																</td>
																<td width="1" align="center" bgcolor="#3c1204" style="padding-right: 10px;">
																	<a href="?s_page=<?=$_GET['s_page']?>&amp;d_product_id=<?=$db->f(proky_id)?>" onClick="return confirm('ยืนยันการลบข้อมูล')">
																		<img src="images/del.gif" alt="ลบ" width="19" height="23" border="0" />
																	</a>
																</td>
															</tr>
															<?php $v++; ?>
															<?php } ?>     
															<tr>
																<td height="30" colspan="6" align="center"> <?php  sh_page($total,$s_page,$e_page,$chk_page,Previous,Next,"#333333","#F8F8F8"); // นำไปวางในตำแหน่งที่ต้องการแสดง ?></td>
															</tr>
														</table>
														<p>&nbsp;</p>
														</form>
													</td>
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
		</table>
	</body>
</html>