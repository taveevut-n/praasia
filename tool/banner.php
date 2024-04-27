<? 
	include('../global.php');
	date_default_timezone_set('Asia/Bangkok');

	// check data expired
	$queryagelife = mysql_query("select * from banner order by order_num asc");
	while ($resultagelife = mysql_fetch_array($queryagelife)) {
		if($resultagelife['banner_day'] != "infinity"){
			$age_life = strtotime($resultagelife['banner_expired'])-time();
			if($age_life <= 0){
				mysql_query("update banner set banner_active = 'noshow' where banner_id = '".$resultagelife['banner_id']."' ");
			}
		}
	}
?>
<?php if($_SESSION['adminid']=='' || !isset($_SESSION['adminid'])) {  
	redi4("login.php");
} ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<title>ระบบจัดการเว็บไซต์</title>
		<!--jquery ui Local-->
		<link rel="stylesheet" href="func/jquery-ui-1.10.3/themes/base/jquery-ui.css" />
		<script src="../func/jquery-ui-1.10.3/jquery-1.9.1.js"></script>
		<script src="../func/jquery-ui-1.10.3/ui/jquery-ui.js"></script>
		<script src="../func/jquery-ui-1.10.3/jquery.transit.min.js"></script>
		<!-- ck editor -->
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
				font-size:14px;
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
		<script type="text/javascript">
			$(document).ready(function(){
				$("#sortMe").sortable({
					update : function(even,ui){
						var postData = $(this).sortable('serialize');
						// console.log(postData)
						$.post('banner_order.php',{list:postData},function(result){
							console.log(result)
						},'json');
					}
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
						<?php 
							if($_POST['Submit']){
								if($_POST['h_banner_id']==''){
									$few_days = trim($_POST['few_days']);
									$age_life = (86400*$few_days);
									$date_expired = date("Y-m-d H:i:s",time()+$age_life);

									$selecttypeage = $_POST['selecttypeage'];
									if($selecttypeage == 1){
										$banner_day = "infinity";
										$date_expired = "";
									}else if($selecttypeage == 2){
										$banner_day = $few_days;
										$date_expired = $date_expired;
									}

									$order_num = mysql_num_rows(mysql_query("select * from banner"));
									upimg2($_FILES['file'],"../img/banner/");		
									$q="INSERT INTO `banner` 
											( 
												`banner_id` , 
												`banner_url` , 
												`banner_detail` , 
												`banner_img` ,
												`banner_day` ,
												`banner_created` ,
												`banner_expired` ,
												`banner_active` ,
												`banner_pos` ,
												`order_num`
											) 	VALUES (	
												'', 
												'".$_POST['banner_url']."' , 
												'".$_POST['banner_detail']."' , 
												'".$file_up2."' ,
												'$banner_day' ,
												'".date("Y-m-d H:i:s")."' ,
												'$date_expired' ,
												'show', 
												'".$_POST['pos']."',
												'".($order_num+1)."' 
											)";
									$db->query($q);
									al('Add Complete');
									redi2();
								}else{
									$few_days = trim($_POST['few_days']);
									$age_life = (86400*$few_days);
									$date_expired = date("Y-m-d H:i:s",time()+$age_life);

									$selecttypeage = $_POST['selecttypeage'];
									if($selecttypeage == 1){
										$banner_day = "infinity";
										$date_expired = "";
									}else if($selecttypeage == 2){
										$banner_day = $few_days;
										$date_expired = $date_expired;
									}

									$q="UPDATE `banner` 
										SET `banner_url` = '".$_POST['banner_url']."' ,
											`banner_detail` = '".$_POST['banner_detail']."',
											`banner_day` = '$banner_day' ,
											`banner_created` = '".date("Y-m-d H:i:s")."' ,
											`banner_expired` = '$date_expired' ,
											`banner_active` = 'show',
											`banner_pos` = '".$_POST['pos']."' 
										WHERE `banner_id` =".$_POST['h_banner_id']." ";
									$db->query($q);
									if($_FILES['file']['name']!=''){
										@unlink("../img/banner/".$_POST['h_pic']);
										upimg2($_FILES['file'],"../img/banner/");		
										$q="UPDATE `banner` SET `banner_img` = '".$file_up2."' WHERE `banner_id` =".$_POST['h_banner_id']." ";
										$db->query($q);
									}
									al('Edit Complete');
									redi2();							
								}			
							}
							?>
						<?php
							if($_GET['d_banner_id']){
								@unlink("../upimg/banner/".$_GET['d_pic']);
								$q="DELETE FROM `banner` WHERE `banner_id` =".$_GET['d_banner_id']." ";
								$db->query($q);

								// re order
								$l = 0;
								$q_banner = mysql_query("select * from banner order by order_num asc");
								while($banner = mysql_fetch_array($q_banner)){
									$l++;
									mysql_query("update banner set order_num = '$l' where banner_id = '".$banner["banner_id"]."'");
								}		
							}
							?>
						<?
							if($_GET['active_id']){
								$q = "update `banner` set banner_active='".$_GET['status']."' WHERE `banner_id` =".$_GET['active_id']." ";
								$db->query($q);
								redi2();
							}
						?>                            
						<?php
							if($_GET['e_banner_id']){
								$q="SELECT * FROM banner WHERE banner_id=".$_GET['e_banner_id']." ";
								$db5=new nDB();
								$db5->query($q);
								$db5->next_record();
							}
							?>
						<?php
							$do_what = $_POST["do_what"];
							if($do_what == "order_num"){
								$banner_id = $_POST["banner_id"];
								$banner_id = $_POST["banner_id"];
								$current_order_num = $_POST["current_order_num"];
								$order_num = $_POST["order_num"];
								if($order_num != 0){//echo "asd".$order_num." ".$current_order_num." ";
									if( $order_num > $current_order_num ){
										$r_order_num_max = mysql_fetch_array(mysql_query("select max(order_num) as order_num_max from banner"));
										$r_order_num_max["order_num_max"];
										if( $order_num > $r_order_num_max["order_num_max"] ){
											$order_num = $r_order_num_max["order_num_max"];
										}
										mysql_query("update banner set order_num = ( order_num - 1 ) where order_num >= '$current_order_num' and order_num <= '$order_num'");
										mysql_query("update banner set order_num = '$order_num' where banner_id = '$banner_id'");
									}else if( $order_num < $current_order_num ){
										mysql_query("update banner set order_num = ( order_num + 1 ) where order_num <= '$current_order_num' and order_num >= '$order_num'");
										mysql_query("update banner set order_num = '$order_num' where banner_id = '$banner_id'");
									}
								}
							}

							if($do_what == "order_up"){
								$banner_id = $_POST["banner_id"];
								$order_num = $_POST["order_num"];
								$prev_order = mysql_fetch_array(mysql_query("select * from banner where order_num = '".($order_num+1)."'"));
								$order_n = mysql_num_rows(mysql_query("select * from banner"));
								if($order_num < $order_n){
									mysql_query("update banner set order_num =  '$order_num' where banner_id = '".$prev_order["banner_id"]."'");
									mysql_query("update banner set order_num = '".($order_num+1)."' where banner_id = '$banner_id'");
								}
							}

							if($do_what == "order_down"){
								$banner_id = $_POST["banner_id"];
								$order_num = $_POST["order_num"];
								$next_order = mysql_fetch_array(mysql_query("select * from banner where order_num = '".($order_num-1)."'"));
								if($order_num > 0){
									mysql_query("update banner set order_num =  '$order_num' where banner_id = '".$next_order["banner_id"]."'");
									mysql_query("update banner set order_num = '".($order_num-1)."' where banner_id = '$banner_id'");
								}
							}
						?>
						<style type="text/css">
							.table{border-collapse: collapse;}
							.table td{line-height: 31px;}
						</style>
						<form action="" method="post" enctype="multipart/form-data" name="form1" id="form1">
							<table width="95%" border="0" align="center" cellpadding="0" cellspacing="2" class="table box_from3_2">
								<tr>
									<td height="25" colspan="3" align="center" bgcolor="#4d1403" class="bh"><b>Banner</b></td>
								</tr>
								<tr>
									<td width="14%" align="right" bgcolor="#3c1204" class="sidemenu">ที่อยู่ (URL)</td>
									<td style="padding-right:3px;padding-left:3px" bgcolor="#3c1204" class="sidemenu"><b>:</b></td>
									<td width="86%" bgcolor="#3c1204">
										<input name="banner_url" type="text" class="box_from3" id="banner_url" value="<?=($_GET['e_banner_id'])?$db5->f(banner_url):""?>" size="45" /></td>
								</tr>
								<tr>
									<td align="right" bgcolor="#3c1204" class="sidemenu">ตำแหน่ง</td>
									<td style="padding-right:3px;padding-left:3px" bgcolor="#3c1204" class="sidemenu"><b>:</b></td>
									<td bgcolor="#3c1204">
									<select name="pos" id="pos">
										<option value="A" 
											<? if($_GET['e_banner_id']) {
												if($db5->f(banner_pos)=='A') {
												echo 'selected="selected"';
												}
												}
												?>
											>แบนเนอร์ร้านค้า</option>
										<option value="B" 
											<? if($_GET['e_banner_id']) {
												if($db5->f(banner_pos)=='B') {
												echo 'selected="selected"';
												}
												}
												?>                                   
											>แบนเนอร์เล็กหน้าแรก</option>
										<option value="C"
											<? if($_GET['e_banner_id']) {
												if($db5->f(banner_pos)=='C') {
												echo 'selected="selected"';
												}
												}
												?>                                     
											>แบนเนอร์กลางหน้าแรก</option>
										<option value="D"
											<? if($_GET['e_banner_id']) {
												if($db5->f(banner_pos)=='D') {
												echo 'selected="selected"';
												}
												}
												?>                                     
											>แบนเนอร์เทศกาล</option>
									</select>
									</td>
								</tr>
								<tr>
									<td align="right" bgcolor="#3c1204" class="sidemenu">รายละเอียด</td>
									<td style="padding-right:3px;padding-left:3px" bgcolor="#3c1204" class="sidemenu"><b>:</b></td>
									<td bgcolor="#3c1204" style="padding-left: 2px;">
									<textarea id="banner_detail" name="banner_detail"><?=($_GET['e_banner_id'])?$db5->f(banner_detail):"&nbsp;"?></textarea>
									<script>
										CKEDITOR.replace('banner_detail',
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
									</td>
								</tr>
								<tr>
									<td align="right" bgcolor="#3c1204" class="sidemenu" >รูปภาพแบนเนอร์</td>
									<td style="padding-right:3px;padding-left:3px" bgcolor="#3c1204" class="sidemenu"><b>:</b></td>
									<td align="left" valign="top" bgcolor="#3c1204" class="sidemenu" ><?php if($_GET['e_banner_id']){ ?>
									<img src="../img/banner/<?=$db5->f(banner_img)?>" width="274" height="100" />
									<br />						
									<?php } ?>
									<input name="file" type="file"  />
									</td>
								</tr>
								<tr>
									<td align="right" bgcolor="#3c1204" class="sidemenu" >เลือก</td>
									<td style="padding-right:3px;padding-left:3px" bgcolor="#3c1204" class="sidemenu"><b>:</b></td>
									<td align="left" valign="top" bgcolor="#3c1204" class="sidemenu" >
										<?php
											if($_GET['e_banner_id']){
												if($db5->f(banner_day) == "infinity"){
													$rdiocheck1 = "checked";
													$few_display = "display:none";
													$few_value = "";
												}else{
													$rdiocheck2 = "checked";
													$few_display = "";
													$few_value = $db5->f(banner_day);
												}
											}else{
												$rdiocheck1 = "checked";
												$few_display = "display:none";
												$few_value = "";
											}
										?>
										<label>
											<input type="radio" name="selecttypeage" value="1" onclick="$('#few_days').hide().val('');" <?=$rdiocheck1;?>>
											อยู่ตลอด
										</label>
										<label>
											<input type="radio" name="selecttypeage" value="2" onclick="$('#few_days').show().val('');" <?=$rdiocheck2;?>>
											ระบุเวลา
										</label>
										<input type="text" id="few_days" name="few_days" style="width: 33px;<?=$few_display?>;" value="<?=$few_value;?>">
									</td>
								</tr>
								<tr>
									<td bgcolor="#3c1204" colspan="2">&nbsp;</td>
									<td bgcolor="#3c1204">
										<input name="Submit" type="submit" class="button_add" value="<?=($_GET['e_banner_id'])?"แก้ไขข้อมูล":"เพิ่มข้อมูล"?>" />
									<?php if($_GET['e_banner_id']){ ?>
									<input name="h_banner_id" type="hidden" id="h_banner_id" value="<?=$db5->f(banner_id)?>" />
									<input name="h_pic" type="hidden" id="h_pic" value="<?=$db5->f(banner_img)?>">								  
									<?php } ?>                              
									</td>
								</tr>
							</table>
						</form>
						<br />
						<table width="700" border="0" align="center" cellpadding="0" cellspacing="3" bordercolor="#FFFFFF">
							<tbody>
								<tr class="bh">
									<td height="25" align="center" bgcolor="#4d1403">Sort</td>
									<td height="25" align="center" bgcolor="#4d1403">Banner</td>
									<td height="25" align="center" bgcolor="#4d1403">Position</td>
									<td height="25" align="center" bgcolor="#4d1403">Date Expired</td>
									<td height="25" align="center" bgcolor="#4d1403">Status</td>
									<td height="25" align="center" bgcolor="#4d1403">Edit</td>
									<td height="25" align="center" bgcolor="#4d1403">Delete</td>
								</tr>
							</tbody>
							<tbody id="sortMe">
							<?php 
								$q="SELECT * FROM `banner` ORDER BY order_num ASC";
								$db->query($q);
								static $v=1;
								while($db->next_record()){
								?>
								<tr id="item_<?=$db->f(banner_id)?>" bgcolor="<?=($v%2==0)?"#F8F8F8":"#FFFFFF"?>">
									<td height="25" align="center" bgcolor="#4d1403">
										<table border="0" cellpadding="0" cellspacing="0" align="center">
											<tr>
												<td height="1px" width="1px">
													<form method="post">
														<input name="do_what" value="order_down" type="hidden"/>
														<input name="banner_id" value="<?=$db->f(banner_id)?>" type="hidden"/>
														<input name="order_num" value="<?=$db->f(order_num)?>" type="hidden"/>
														<img onClick="$(this).parent().submit();" style="cursor:pointer;" src="images/arrow_up.png" border="0"/>
													</form>
													</a>
												</td>
											</tr>
											<tr>
												<td style="text-align:center;">
													<form method="post">
														<input name="do_what" value="order_num" type="hidden"/>
														<input name="banner_id" value="<?=$db->f(banner_id)?>" type="hidden"/>
														<input name="current_order_num" value="<?=$db->f(order_num)?>" type="hidden"/>
														<input class="flat_textbox" name="order_num" onchange="$(this).parent().submit();" value="<?=$db->f(order_num)?>" style="width:25px; text-align:center;" type="text"/>
													</form>
												</td>
											</tr>
											<tr>
												<td height="1px" width="1px">
													<form method="post">
														<input name="do_what" value="order_up" type="hidden"/>
														<input name="banner_id" value="<?=$db->f(banner_id)?>" type="hidden"/>
														<input name="order_num" value="<?=$db->f(order_num)?>" type="hidden"/>
														<img onClick="$(this).parent().submit();" style="cursor:pointer;" src="images/arrow_down.png" border="0"/>
													</form>
												</td>
											</tr>
										</table>
									</td>
									<td height="110" align="left" bgcolor="#3c1204" style="width:1px;padding-left:5px;padding-right:5px" >
										<img src="../slir/w274-h100-c4:1/img/banner/<?=$db->f(banner_img)?>" width="230" height="100" />
									</td>
									<td align="center" bgcolor="#3c1204" class="sidemenu" ><?=$db->f(banner_pos)?></td>
									<td align="center" bgcolor="#3c1204" class="sidemenu" >
										<?php
											$banner = $db->f(banner_day);
										 	if($banner == "infinity"){
										 		?>
										 		<span style="color:#DDC33A;">
										 			<b>Infinity</b>
										 		</span>
										 		<?
										 	}else{
										 		echo date("d-m-Y",strtotime($db->f(banner_expired)));
										 	}
										?>
									</td>
									<td align="center" bgcolor="#3c1204" class="sidemenu" >
										<?php
										 	$banner = $db->f(banner_day);
										 	if($banner == "infinity"){
										 		?>
										 		<img src="images/ok_active.png" border="0">
										 		<?
										 	}else{
										 		$optionage_life = $db->f(banner_active);
										 		if($optionage_life == "show"){
										 			?>
                                                    <a href="?active_id=<?=$db->f(banner_id)?>&status=noshow" >
										 		<img src="images/ok_active.png" border="0">
                                                </a>
										 			<?
										 		}else{
										 			?>
                                                    <a href="?active_id=<?=$db->f(banner_id)?>&status=show" >
										 		<img src="images/stop_active.png" border="0">
                                                </a>
										 			<?
										 		}
										 	}
										?>
									</td>
									<td width="8%" align="center" bgcolor="#3c1204"><a href="?e_banner_id=<?=$db->f(banner_id)?>" ><img src="../images/edit.gif" alt="แก้ไข" width="19" height="23" border="0" /></a></td>
									<td width="8%" align="center" bgcolor="#3c1204" ><a href="?d_banner_id=<?=$db->f(banner_id)?>" onClick="return confirm('Confirm Delete?')" ><img src="../images/del.gif" alt="ลบ" width="19" height="23" border="0" /></a></td>
								</tr>
							<?php $v++; } ?>
							</tbody>
						</table>
						</td>
					</tr>
				</table>
			</td>
			</tr>
		</table>
	</body>
</html>