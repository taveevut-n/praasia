<? include('../global.php');
	if($_SESSION['adminid']=='' || !isset($_SESSION['adminid'])) {  
		  redi4("login.php");
	} 
	?>
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
							<td width="250" valign="top" ><? include('sidemenu.php') ?></td>
							<td valign="top" bgcolor="#3f1d0e">
								<?php 
									if($_POST['Submit']){
										if($_POST['h_geji_id']==''){
												upimg2($_FILES['file'],"../img/geji/");		
												$q="INSERT INTO `help` 
														( 
															`geji_id` , 
															`topic` , 
															`detail` 
														) 	VALUES (	
															'', 
															'".$_POST['topic']."' , 
															'".$_POST['detail']."'
														);";
												$db->query($q);
												al('Add Complete');
												redi2();
										}else{
												$q="UPDATE `help` SET `topic` = '".$_POST['topic']."' ,
												`detail` = '".$_POST['detail']."' WHERE `geji_id` =".$_POST['h_geji_id']." ";
												$db->query($q);
												al('Edit Complete');
												redi2();							
										}			
									}
									?>
								<?php
									if($_GET['d_geji_id']){
										@unlink("../img/geji/".$_GET['d_pic']);
										$q="DELETE FROM `help` WHERE `geji_id` =".$_GET['d_geji_id']." ";
										$db->query($q);				
									}
									?>
								<?php
									if($_GET['e_geji_id']){
										$q="SELECT * FROM help WHERE geji_id=".$_GET['e_geji_id']." ";
										$db5=new nDB();
										$db5->query($q);
										$db5->next_record();
									}
									?>
								<form action="" method="post" enctype="multipart/form-data" name="form1" id="form1">
									<table width="95%" border="0" align="center" cellpadding="0" cellspacing="2" class="box_from3_2">
										<tr>
											<td height="25" colspan="2" align="center" bgcolor="#4d1403" class="bh">ช่วยเหลือ</td>
										</tr>
										<tr>
											<td width="14%" align="right" bgcolor="#3c1204" class="sidemenu"  style="padding-right:3px">ชื่อหัวข้อ</td>
											<td width="86%" bgcolor="#3c1204"><input name="topic" type="text" class="box_from3" id="topic" value="<?=($_GET['e_geji_id'])?$db5->f(topic):""?>" size="45" /></td>
										</tr>
										<tr>
											<td align="right" bgcolor="#3c1204" class="sidemenu"  style="padding-right:3px">รายละเอียด</td>
											<td bgcolor="#3c1204">
												<textarea id="detail" name="detail"><?=($_GET['e_geji_id'])?$db5->f(detail):"&nbsp;"?></textarea>
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
											</td>
										</tr>
										<tr>
											<td bgcolor="#3c1204">&nbsp;</td>
											<td bgcolor="#3c1204"><input name="Submit" type="submit" class="button_add" value="<?=($_GET['e_geji_id'])?"แก้ไขข้อมูล":"เพิ่มข้อมูล"?>" />
												<?php if($_GET['e_geji_id']){ ?>
												<input name="h_geji_id" type="hidden" id="h_geji_id" value="<?=$db5->f(geji_id)?>" />
												<input name="h_pic" type="hidden" id="h_pic" value="<?=$db5->f(pic1)?>">								  
												<?php } ?>                              
											</td>
										</tr>
									</table>
								</form>
								<br />
								<table width="700" border="0" align="center" cellpadding="0" cellspacing="3" bordercolor="#FFFFFF">
									<tr class="bh">
										<td width="50%" height="25" align="center" bgcolor="#4d1403" class="style11" >ชื่อหัวข้อ</td>
										<td height="25" align="center" bgcolor="#4d1403" class="style11" >Edit</td>
										<td height="25" align="center" bgcolor="#4d1403" class="style11" >Delete</td>
									</tr>
									<?php 
										$q="SELECT * FROM `help` WHERE 1 ORDER BY geji_id DESC";
										$db->query($q);
										static $v=1;
										while($db->next_record()){
										?>
									<tr bgcolor="<?=($v%2==0)?"#3c1204":"#3c1204"?>">
										<td height="30" align="left" bgcolor="#3c1204"   style="color:#FC0"><?=$db->f(topic)?></td>
										<td width="7%" align="center" bgcolor="#3c1204"><a href="?e_geji_id=<?=$db->f(geji_id)?>" ><img src="../images/edit.gif" alt="แก้ไข" width="19" height="23" border="0" /></a></td>
										<td width="7%" align="center" bgcolor="#3c1204"><a href="?d_geji_id=<?=$db->f(geji_id)?>" onClick="return confirm('Confirm Delete?')" ><img src="../images/del.gif" alt="ลบ" width="19" height="23" border="0" /></a></td>
									</tr>
									<?php $v++; } ?>
								</table>
							</td>
						</tr>
					</table>
				</td>
			</tr>
		</table>
	</body>
</html>