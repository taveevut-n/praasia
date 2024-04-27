<? include('../global.php')?>
<?php if($_SESSION['adminid']=='' || !isset($_SESSION['adminid'])) {  
		redi4("login.php");
		} ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
		<head>
			<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
			<title>ระบบจัดการเว็บไซต์</title>
			<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
			<script src="ieditor/ckeditor.js"></script>  
			<script src="ckfinder/ckfinder.js"></script>  
			<!--Innova Editor-->
			<script type="text/javascript" src="/admin/innovaeditor/scripts/innovaeditor.js"></script>
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
														if($_POST['h_banner_id']==''){
																upimg2($_FILES['file'],"../pra/img/banner/");   
																$q="INSERT INTO `pra_banner` ( `banner_id` , `banner_url` , `banner_detail`, `banner_detail2` , `banner_img` , `banner_pos` )   VALUES (  '', '".$_POST['banner_url']."' , '".$_POST['banner_detail']."', '".$_POST['banner_detail2']."' , '".$file_up2."' , '".$_POST['pos']."' );";
																$db->query($q);
														al('Add Complete');
														redi2();
														}else{
																$q="UPDATE `pra_banner` SET `banner_url` = '".$_POST['banner_url']."' ,
																`banner_detail` = '".$_POST['banner_detail']."',
																`banner_detail2` = '".$_POST['banner_detail2']."',        
																`banner_pos` = '".$_POST['pos']."' WHERE `banner_id` =".$_POST['h_banner_id']." ";
																$db->query($q);
																if($_FILES['file']['name']!=''){
																	@unlink("../img/banner/".$_POST['h_pic']);
																	upimg2($_FILES['file'],"../pra/img/banner/");   
																	$q="UPDATE `pra_banner` SET `banner_img` = '".$file_up2."' WHERE `banner_id` =".$_POST['h_banner_id']." ";
																	$db->query($q);
																}
														al('Edit Complete');
														redi2();             
														}     
														}
														?>
												<?php
														if($_GET['d_banner_id']){
														@unlink("../pra/img/banner/".$_GET['d_pic']);
														$q="DELETE FROM `pra_banner` WHERE `banner_id` =".$_GET['d_banner_id']." ";
														$db->query($q);       
														}
														?>
												<?php
														if($_GET['e_banner_id']){
														$q="SELECT * FROM pra_banner WHERE banner_id=".$_GET['e_banner_id']." ";
														$db5=new nDB();
														$db5->query($q);
														$db5->next_record();
														}
														?>
												<form action="" method="post" enctype="multipart/form-data" name="form1" id="form1">
														<table width="95%" border="0" align="center" cellpadding="0" cellspacing="2" class="box_from3_2">
															<tr>
																	<td height="25" colspan="2" align="center" bgcolor="#4d1403" class="bh">Banner</td>
															</tr>
															<tr>
																	<td width="14%" align="right" bgcolor="#3c1204" class="sidemenu"  style="padding-right:3px">URL</td>
																	<td width="86%" bgcolor="#3c1204"><input name="banner_url" type="text" class="box_from3" id="banner_url" value="<?=($_GET['e_banner_id'])?$db5->f(banner_url):""?>" size="45" /></td>
															</tr>
															<tr>
																	<td align="right" bgcolor="#3c1204" class="sidemenu"  style="padding-right:3px">Detail</td>
																	<td bgcolor="#3c1204">
																		<textarea id="banner_detail" name="banner_detail"><?=($_GET['e_banner_id'])?$db5->f(banner_detail):"&nbsp;"?></textarea>
																		<script>
																			CKEDITOR.replace( 'banner_detail', {
																				filebrowserBrowseUrl : 'ckfinder/ckfinder.html',
																				filebrowserImageBrowseUrl : 'ckfinder/ckfinder.html?type=Images',
																				filebrowserFlashBrowseUrl : 'ckfinder/ckfinder.html?type=Flash',
																				filebrowserFlashUploadUrl : 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash'
																			});
																		</script>                  
																	</td>
															</tr>
															<tr>
																	<td align="right" bgcolor="#3c1204" class="sidemenu"  style="padding-right:3px">Detail</td>
																	<td bgcolor="#3c1204">
																		<textarea id="banner_detail2" name="banner_detail2"><?=($_GET['e_banner_id'])?$db5->f(banner_detail2):"&nbsp;"?></textarea>
																		<script>
																			CKEDITOR.replace( 'banner_detail2', {
																				filebrowserBrowseUrl : 'ckfinder/ckfinder.html',
																				filebrowserImageBrowseUrl : 'ckfinder/ckfinder.html?type=Images',
																				filebrowserFlashBrowseUrl : 'ckfinder/ckfinder.html?type=Flash',
																				filebrowserFlashUploadUrl : 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash'
																			});
																		</script>                      
																	</td>
															</tr>
															<tr>
																	<td align="right" valign="top" bgcolor="#3c1204" class="sidemenu" >Banner Pic</td>
																	<td align="center" valign="top" bgcolor="#3c1204" class="sidemenu" >           <?php if($_GET['e_banner_id']){ ?>
																		<img src="../jewelry/upimg/banner/<?=$db5->f(banner_img)?>" width="274" height="100" />
																		<br />            
																		<?php } ?>
																		รูปภาพ 
																		<input name="file" type="file"  />
																	</td>
															</tr>
															<tr>
																	<td bgcolor="#3c1204">&nbsp;</td>
																	<td bgcolor="#3c1204"><input name="Submit" type="submit" class="button_add" value="<?=($_GET['e_banner_id'])?"แก้ไขข้อมูล":"เพิ่มข้อมูล"?>" />
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
														<tr class="bh">
															<td height="25" align="center" bgcolor="#4d1403" class="style11" >Banner</td>
															<td height="25" align="center" bgcolor="#4d1403" class="style11" >&nbsp;</td>
															<td height="25" align="center" bgcolor="#4d1403" class="style11" >Edit</td>
															<td height="25" align="center" bgcolor="#4d1403" class="style11" >Delete</td>
														</tr>
														<?php 
															$q="SELECT * FROM `pra_banner` WHERE 1 ORDER BY banner_id DESC";
															$db->query($q);
															static $v=1;
															while($db->next_record()){
															?>
														<tr bgcolor="<?=($v%2==0)?"#3c1204":"#2f0d02"?>">
															<td height="110" align="left" bgcolor="#3c1204" style="padding-left:10px" ><img src="../slir/w140/pra/img/banner/<?=$db->f(banner_img)?>" width="140"/></td>
															<td align="center" bgcolor="#3c1204" class="sidemenu" >&nbsp;</td>
															<td width="8%" align="center" bgcolor="#3c1204"><a href="?e_banner_id=<?=$db->f(banner_id)?>" ><img src="../images/edit.gif" alt="แก้ไข" width="19" height="23" border="0" /></a></td>
															<td width="8%" align="center" bgcolor="#3c1204" ><a href="?d_banner_id=<?=$db->f(banner_id)?>" onClick="return confirm('Confirm Delete?')" ><img src="../images/del.gif" alt="ลบ" width="19" height="23" border="0" /></a></td>
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