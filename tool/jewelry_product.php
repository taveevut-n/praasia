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
		<script src="/ieditor/ckeditor.js"></script>
		<script src="/ckfinder/ckfinder.js"></script> 
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
		</style>
	</head>
	<body>
		<?php
			if($_GET['d_product_id']){
				@unlink("img/amulet/".$_GET['pic1']);
				@unlink("img/amulet/".$_GET['pic2']);   
				@unlink("img/amulet/".$_GET['pic3']);   
				@unlink("img/amulet/".$_GET['pic4']);           
				$q="DELETE FROM `product` WHERE `product_id` = ".$_GET['d_product_id']." ";
				$db->query($q);   
			}
			?>
		<?php
			if($_GET['hot_id']){
				$q="update `jew_product` set status='".$_GET['status']."' WHERE `id` =".$_GET['hot_id']." ";
				$db->query($q);
				redi2();        
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
											<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
												<tr>
													<td>
														<script language="javascript">
															function selec(){
																var ab=document.getElementById('se');
																location.href=ab.value;
															}
														</script>
														<?php
															if($_POST['Submit']){
																if($_POST['h_product_id']){
																$pushkeyword = array();
																	foreach ($_POST['keyword_text'] as $key => $value) {
																		array_push($pushkeyword, $value);
																	}
																	$result_keyword = implode(",", $pushkeyword);
																	$q="UPDATE `jew_product` 
																		SET 	`catalog` = '".$_POST['catalog']."',
																				`tag` = '".$_POST['tag']."',
																				`name` = '".$_POST['name']."',
																				`detail` = '".$_POST['detail']."',
																				`status` = '".$_POST['status']."',
																				`price` = '".$_POST['price']."' ,
																				`keyword` = '$result_keyword'
																		WHERE `id` =".$_POST['h_product_id']." ";
																$db->query($q);
																		for($mf=1;$mf<=5;$mf++){
																		 $upf[$mf]=uppic($_FILES['file'.$mf],$mf,"../jewelry/upimg/product/",$_POST['h_pic'.$mf]); // Same folder
																			 if($upf[$mf]!=''){
																		 $q="UPDATE `jew_product` SET `pic$mf` = '".$upf[$mf]."' WHERE `id` =".$_POST['h_product_id']." ";
																				 $db->query($q);
																			 }  
																		}     
																al('แก้ไขข้อมูลเรียบร้อยแล้ว');
																
																echo "<script language=\"javascript\">window.location='jewelry_product.php?s_page=".$_GET['s_page']."'</script>";	
																}else{
																$pushkeyword = array();
																	foreach ($_POST['keyword_text'] as $key => $value) {
																		array_push($pushkeyword, $value);
																	}
																	$result_keyword = implode(",", $pushkeyword);
																		$q="INSERT INTO `jew_product` 
																				( 
																					`id` , 
																					`catalog` , 
																					`tag` , 
																					`name` ,
																					`detail` , 
																					`price` , 
																					`pic1` , 
																					`pic2`, 
																					`pic3` , 
																					`pic4`, 
																					`pic5`,
																					`status`,
																					`view_num`,
																					`keyword`
																				) VALUES (
																					'', '".$_POST['catalog']."', 
																					'".$_POST['tag']."', 
																					'".$_POST['name']."', 
																					'".$_POST['detail']."', 
																					'".$_POST['price']."', 
																					'' , 
																					'' , 
																					'' , 
																					'' , 
																					'' , 
																					'".$_POST['status']."',
																					'0',
																					'".$result_keyword."'
																				)";
																		$db->query($q);
																		for($mf=1;$mf<=5;$mf++){
																		 $upf[$mf]=uppic($_FILES['file'.$mf],$mf,"../jewelry/upimg/product/",$_POST['h_pic'.$mf]); // Same folder
																			 if($upf[$mf]!=''){
																			$q="SELECT * FROM `jew_product`ORDER BY id DESC";
																			$db->query($q);
																			$db->next_record();  
																			$id_product=$db->f(id);
																			 $q="UPDATE `jew_product` SET `pic$mf` = '".$upf[$mf]."' WHERE `id` =".$id_product." ";
																			 $db->query($q);
																		}        
																	}
																al('เพิ่มข้อมูลเรียบร้อยแล้ว');
																redi2();    
																}
															}
															?>
														<?php
															if($_GET['d_product_id']){
																@unlink("../upimg/product/".$_GET['pic1']);
																@unlink("../upimg/product/".$_GET['pic2']);   
																@unlink("../upimg/product/".$_GET['pic3']);   
																@unlink("../upimg/product/".$_GET['pic4']);   
																@unlink("../upimg/product/".$_GET['pic5']);               
																$q="DELETE FROM `jew_product` WHERE `id` = ".$_GET['d_product_id']." ";
																$db->query($q);   
															}
															?>
														<?php
															if($_GET['e_product_id']){
																$q="SELECT * FROM `jew_product` WHERE id=".$_GET['e_product_id']." ";
																$db5=new nDB();
																$db5->query($q);
																$db5->next_record();
															}
															?>
														<form action="" method="post" enctype="multipart/form-data" name="form1" id="form1">
															<br />
															<table width="95%" border="0" align="center" cellpadding="3" cellspacing="0" style="border:1px #8C3F17 solid" >
																<tr>
																	<td height="25" colspan="2" align="right" bgcolor="#4d1403" ><span class="sidemenu">All field are required.</span></td>
																</tr>
																<tr>
																	<td width="28%" bgcolor="#3c1204">&nbsp;</td>
																	<td width="72%" bgcolor="#3c1204">&nbsp;</td>
																</tr>
																<tr>
																	<td align="right" bgcolor="#3c1204"  style="padding-right:3px"><span class="sidemenu">หมวดหมู่สินค้า / 产品类型</span></td>
																	<td align="left" valign="top" bgcolor="#3c1204">
																		<span class="sidemenu">
																			<select name="catalog" id="catalog">
																				<option value="0" selected="selected">---เลือกหมวดหมู่---</option>
																				<option value="1"
																					<?
																						if ($_GET['e_product_id']) {
																							if ($db5->f(catalog)=='1') { 
																							echo 'selected="selected"';
																							}
																						}
																						?>
																					>แหวนเพชร 1 - 10 กะรัต</option>
																				<option value="2"
																					<?
																						if ($_GET['e_product_id']) {
																							if ($db5->f(catalog)=='2') { 
																							echo 'selected="selected"';
																							}
																						}
																						?>                            
																					>แหวน</option>
																				<option value="3">กำไล - สร้อยข้อมือ</option>
																				<option value="4">จี้เข็มกลัด</option>
																				<option value="5">กรอบทอง งานทอง ราคาขายส่ง ผลิตจากโรงงาน</option>
																				<option value="6">อื่น ๆ</option>
																			</select>
																		</span>
																	</td>
																</tr>
																<tr>
																	<td align="right" bgcolor="#3c1204" class="style11"  style="padding-right:3px"><span class="sidemenu">Tag ป้ายกำกับ </span></td>
																	<td align="left" valign="top" bgcolor="#3c1204"><span class="sidemenu">
																		<input name="tag" type="text"  id="tag" value="<?=($_GET['e_product_id'])?$db5->f(tag):""?>" size="50" />
																		</span>
																	</td>
																</tr>
																<tr>
																	<td align="right" bgcolor="#3c1204" class="style11"  style="padding-right:3px"><span class="sidemenu">ชื่อสินค้า / 产品名</span></td>
																	<td align="left" valign="top" bgcolor="#3c1204"><span class="sidemenu">
																		<input name="name" type="text"  id="name" value="<?=($_GET['e_product_id'])?$db5->f(name):""?>" size="50" />
																		</span>
																	</td>
																</tr>
																<style type="text/css">
																	.box_keyword{
																		display: block;
																	}
																	.new_keyword{
																		background: rgb(211, 200, 200);
																		position: relative;
																		padding: 4px 1px 4px 8px;
																		float: left;
																		margin-right: 5px;
																		margin-bottom: 5px;
																	}
																	.btnclose{
																		background: rgb(107, 107, 121);
																		margin-left: 8px;
																		padding: 3px 7px;
																		font-size: 14px;
																		font-weight: bold;
																		color: rgb(255, 182, 182);
																	}
																	.btnclose:hover{
																		cursor: pointer;
																	}
																	.btnclose:hover{
																		cursor: pointer;
																		box-shadow: inset 0 3px 5px rgba(0,0,0,.125);
																	}
																</style>
																<tr>
																	<td align="right" bgcolor="#3c1204" class="style11"  style="padding-right:3px"><span class="sidemenu">Keyword / 关键词 </span></td>
																	<td align="left" valign="top" bgcolor="#3c1204">
																		<div id="box_keyword">
																			<? 
																			if($_GET['e_product_id']){
																				if($db5->f(keyword) <> ""){
																					$explode_word = explode(",",$db5->f(keyword));
																					foreach ($explode_word as $key => $value) {
																						?>
																					<div class="new_keyword">
																						<input type="hidden" name="keyword_text[]" value="<?=$value;?>"/>
																						<?=$value;?>
																						<span class="btnclose" onclick="$(this).parent().remove()">x</span>
																					</div>
																						<?
																					}
																				}
																			}	
																			?>
																		</div>
																		<input name="keyword" type="text" id="keyword" size="60"  onkeyUp="get_keyword(this.value);" style="height: 18px;width: 114px;margin-right: 4px;" placeholder="ป้อน keyword ให้กับสินค้าของท่าน">
																		<script type="text/javascript">
																			function get_keyword(x_value){
																				var keyword = new Array();
																				if(x_value.indexOf(',') > -1 ){
																					var v_array = x_value.split(',');
																					$.each(v_array,function(index,val){
																						var x_val = $.trim(val);
																						if(x_val.trim()){
																							var texthtml = '<div class="new_keyword"><input type="hidden" name="keyword_text[]" value="'+x_val+'"/>'+x_val+'<span class="btnclose" onclick="$(this).parent().remove()">x</span></div>';
																							$("#box_keyword").append(texthtml);
																							$("#keyword").val('').focus();
																						}
																					});
																				}
																			}
																		</script>
																	</td>
																</tr>
																<tr>
																	<td align="right" bgcolor="#3c1204" class="style11"  style="padding-right:3px"><span class="sidemenu">ราคา / 价格</span></td>
																	<td align="left" valign="top" bgcolor="#3c1204"><span class="sidemenu">
																		<input name="price" type="text"  id="price" value="<?=($_GET['e_product_id'])?$db5->f(price):""?>" size="10" />
																		</span>
																	</td>
																</tr>
																<tr>
																	<td align="right" bgcolor="#3c1204" class="style11"  style="padding-right:3px"><span class="sidemenu">สินค้าแนะนำ</span></td>
																	<td align="left" valign="top" bgcolor="#3c1204">
																		<span class="sidemenu">
																		<input name="status" type="checkbox" id="status" value="1" 
																			<?php
																				if($_GET['e_product_id']){
																				if($db5->f(status)==1){
																				echo 'checked="checked"';
																				}
																				}
																				?>
																			/>                        
																		</span>
																	</td>
																</tr>
																<tr>
																	<td height="25" colspan="2" align="center" bgcolor="#3c1204" class="style11"><span class="sidemenu">ข้อความอย่างย่อ แสดงหน้ารายการพระ </span></td>
																</tr>
																<tr>
																	<td height="25" colspan="2" align="center" bgcolor="#3c1204" class="style11"><span class="sidemenu">Message Detail </span></td>
																</tr>
																<tr>
																	<td colspan="2" align="center" bgcolor="#3c1204" class="style11">
																		<span class="sidemenu">
																			<textarea id="detail" name="detail"><?=($_GET['e_product_id'])?$db5->f(detail):"&nbsp;"?></textarea>
																			<script>
																				CKEDITOR.replace('detail',
																				{
																					filebrowserBrowseUrl : 'ckfinder/ckfinder.html',
																					filebrowserImageBrowseUrl : 'ckfinder/ckfinder.html?type=Images',
																					filebrowserFlashBrowseUrl : 'ckfinder/ckfinder.html?type=Flash',
																					filebrowserUploadUrl : 
																						 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files&currentFolder=/userfile/',
																					filebrowserImageUploadUrl : 
																						 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images&currentFolder=/userfile/',
																					filebrowserFlashUploadUrl : 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash'
																				});
																			</script>                                   
																		</span>
																	</td>
																</tr>
																<tr>
																	<td align="right" bgcolor="#3c1204" class="style11"  style="padding-right:3px; border-bottom:#592D03 1px solid">
																		<span class="sidemenu">
																		<?php if($_GET['e_product_id']){ ?>           
																		<img src="<?=($db5->f(pic1)!="")?"../jewelry/upimg/product/".$db5->f(pic1):"../images/clear.gif"?>" width="60" height="67"  border="0" /> Picture 1 </span>
																	</td>
																	<?php } ?>
																	<td align="left" valign="bottom" bgcolor="#3c1204" class="style11"   style="padding-right:3px; border-bottom:#592D03 1px solid">
																		<span class="sidemenu">
																		<input name="file1" type="file" id="file1" />
																		Width less than 700 pixel</span>
																	</td>
																</tr>
																<tr>
																	<td align="right" bgcolor="#3c1204" class="style11"    style="padding-right:3px; border-bottom:#592D03 1px solid">
																		<span class="sidemenu">
																		<?php if($_GET['e_product_id']){ ?>           
																		<img src="<?=($db5->f(pic2)!="")?"../jewelry/upimg/product/".$db5->f(pic2):"../images/clear.gif"?>" width="60" height="60"  border="0" /> Picture 2 </span>
																	</td>
																	<?php } ?>
																	<td align="left" valign="bottom" bgcolor="#3c1204" class="style11"  style="padding-right:3px; border-bottom:#592D03 1px solid">
																		<span class="sidemenu">
																		<input name="file2" type="file" id="file2" />
																		Width less than 700 pixel</span>
																	</td>
																</tr>
																<tr>
																	<td align="right" bgcolor="#3c1204" class="style11"  style="padding-right:3px; border-bottom:#592D03 1px solid">
																		<span class="sidemenu">
																		<?php if($_GET['e_product_id']){ ?>           
																		<img src="<?=($db5->f(pic3)!="")?"../jewelry/upimg/product/".$db5->f(pic3):"../images/clear.gif"?>" width="60" height="60"  border="0" /> Picture 3 </span>
																	</td>
																	<?php } ?>
																	<td align="left" valign="bottom" bgcolor="#3c1204" class="style11"  style="padding-right:3px; border-bottom:#592D03 1px solid">
																		<span class="sidemenu">
																		<input name="file3" type="file" id="file3" />
																		Width less than 700 pixel</span>
																	</td>
																</tr>
																<tr>
																	<td align="right" bgcolor="#3c1204" class="style11"  style="padding-right:3px; border-bottom:#592D03 1px solid">
																		<span class="sidemenu">
																		<?php if($_GET['e_product_id']){ ?>           
																		<img src="<?=($db5->f(pic4)!="")?"../jewelry/upimg/product/".$db5->f(pic4):"../images/clear.gif"?>" width="60" height="60"  border="0" /> Picture 4 </span>
																	</td>
																	<?php } ?>
																	<td align="left" valign="bottom" bgcolor="#3c1204" class="style11"  style="padding-right:3px; border-bottom:#592D03 1px solid">
																		<span class="sidemenu">
																		<input name="file4" type="file" id="file4" />
																		Width less than 700 pixel</span>
																	</td>
																</tr>
																<tr>
																	<td align="right" bgcolor="#3c1204" class="style11"   style="padding-right:3px; border-bottom:#592D03 1px solid">
																		<span class="sidemenu">
																		<?php if($_GET['e_product_id']){ ?>           
																		<img src="<?=($db5->f(pic5)!="")?"../jewelry/upimg/product/".$db5->f(pic5):"../images/clear.gif"?>" width="60" height="60"  border="0" /> Picture 5 </span>
																	</td>
																	<?php } ?>
																	<td align="left" valign="bottom" bgcolor="#3c1204" class="style11"  style="padding-right:3px; border-bottom:#592D03 1px solid">
																		<span class="sidemenu">
																		<input name="file5" type="file" id="file5" />
																		Width less than 700 pixel </span>
																	</td>
																</tr>
																<tr>
																	<td bgcolor="#3c1204">&nbsp;</td>
																	<td bgcolor="#3c1204"><input name="Submit" type="submit" class="button_add" value="<?=($_GET['e_product_id'])?"Edit":"Add"?>" />
																		<?php if($_GET['e_product_id']){ ?>
																		<input name="h_product_id" type="hidden" id="h_product_id" value="<?=$db5->f(id)?>" />
																		<input name="h_pic1" type="hidden" id="h_pic1" value="<?=$db5->f(pic1)?>">
																		<input name="h_pic2" type="hidden" id="h_pic2" value="<?=$db5->f(pic2)?>">
																		<input name="h_pic2" type="hidden" id="h_pic2" value="<?=$db5->f(pic3)?>">
																		<input name="h_pic2" type="hidden" id="h_pic2" value="<?=$db5->f(pic4)?>">
																		<input name="h_pic2" type="hidden" id="h_pic2" value="<?=$db5->f(pic5)?>">                                                      
																		<?php } ?>                        
																	</td>
																</tr>
															</table>
														</form>
														<br />
														<br />
														<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
															<tr>
																<td height="25" colspan="6" align="center" bgcolor="#4d1403" class="sidemenu">
																	<form action="pro_set.php" method="post" name="sho" target="pro_frm" id="sho">
																		<div align="right">
																			<span id="za_mo1">ค้นหาสินค้าตามหมวดหมู่</span>
																			<select name="pro_catalog" id="pro_catalog">
																				<option value="0">---เลือกหมวดหมู่---</option>
																				<option value="1">แหวนเพชร 1 - 10 กะรัต</option>
																				<option value="2">แหวน</option>
																				<option value="3">กำไล</option>
																				<option value="4">สร้อยข้อมือ</option>
																				<option value="5">จี้/เข็มกลัด</option>
																				<option value="6">กรอบทอง งานทอง</option>
																				<option value="7">อื่น ๆ</option>
																			</select>
																			<input name="search" type="submit" class="bt_zabi" value="Go" />
																		</div>
																	</form>
																	<iframe src="" name="pro_frm" width="1px;" height="0px;" frameborder="0" id="pro_frm"></iframe>       
																</td>
															</tr>
															<tr class="sidemenu">
																<td width="23%" height="35" align="center" bgcolor="#4d1403" class="style11" >Picture</td>
																<td width="38%" align="center" bgcolor="#4d1403" class="style11" >Name</td>
																<td align="center" bgcolor="#4d1403" class="style11">Price</td>
																<td align="center" bgcolor="#4d1403" class="style11">Hot</td>
																<td align="center" bgcolor="#4d1403" class="style11">Edit</td>
																<td align="center" bgcolor="#4d1403" class="style11">Delete</td>
															</tr>
															<?php
																$q="SELECT * FROM `jew_product` WHERE 1 ";
																$p_r=1;
																if($_SESSION['pro_catalog']){
																		$q.=" AND  catalog='".$_SESSION['pro_catalog']."' ";
																}
																if($_POST['q'] or $_SESSION['search_product']){ //มีการค้นหา
																		if($_SESSION['search_product']){
																$_POST['q']=$_SESSION['search_product'];
																}
																		$q.=" AND  name like '%".$_POST['q']."%' or catalog like '%".$_POST['q']."%' ";
																}
																
																$db->query($q);             
																$total=$db->num_rows();             
																$q.=" ORDER BY id DESC LIMIT $s_page,$e_page ";
																$db->query($q);
																static $v=1; 
																while($db->next_record()){
																?>    
															<tr>
																<td height="100" align="center" bgcolor="#3c1204" ><img src="<?=($db->f(pic1)!="")?"../slir/w90-h90-c1:1/jewelry/upimg/product/".$db->f(pic1):"../images/clear.gif"?>" width="90" height="90"  border="0" /></td>
																<td bgcolor="#3c1204" >
																	<a target="_blank" href="http://www.meilijewelry.com/detail_product.php?id=<?=$db->f(id)?>">
																		<span style="color:#FFFFFF; font-size:12px">
																		<?=$db->f(name)?>
																		</span>
																	</a>
																</td>
																<td width="11%" align="right" bgcolor="#3c1204" style="padding-right:3px;"><span style="color:#FFFFFF; font-size:12px"><?=g_number($db->f(price))?></span></td>
																<td align="center" bgcolor="#3c1204">
																	<? if($db->f(status)=='0'){?>
																	<a href="?status=1&amp;hot_id=<?=$db->f(id)?>" ><img src="../images/wait.png" alt="No Hot" width="24" height="24" border="0"></a>
																	<? }?>
																	<?php if($db->f(status)=='1') { ?>
																	<a href="?status=0&amp;hot_id=<?=$db->f(id)?>" >
																	<img src="../images/ok.png" alt="Hot" width="24" height="24" border="0"></a>
																	<? }?>                        
																</td>
																<td width="7%" align="center" bgcolor="#3c1204"><a href="jewelry_product.php?s_page=<?=$_GET['s_page']?>&amp;e_product_id=<?=$db->f(id)?>" ><img src="images/edit.gif" alt="แก้ไข" width="19" height="23" border="0" /></a></td>
																<td width="10%" align="center" bgcolor="#3c1204" ><a href="jewelry_product.php?s_page=<?=$_GET['s_page']?>&amp;d_product_id=<?=$db->f(id)?>&amp;pic=<?=$db->f(pic1)?>&amp;pic=<?=$db->f(pic2)?>&amp;pic=<?=$db->f(pic3)?>&amp;pic=<?=$db->f(pic4)?>&amp;pic=<?=$db->f(pic5)?>" onClick="return confirm('ยืนยันการลบข้อมูล')"><img src="images/del.gif" alt="ลบ" width="19" height="23" border="0" /></a></td>
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