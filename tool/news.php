<?php
	include("../global.php");
	if($_SESSION['adminid']=='' || !isset($_SESSION['adminid'])) {  
		redi4("login.php");
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

	<title>
		ระบบจัดการเว็บไซต์
	</title>
	
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

	<link rel="stylesheet" href="../func/jquery-ui-1.10.3/themes/base/jquery-ui.css" />
	<script src="../func/jquery-ui-1.10.3/jquery-1.9.1.js"></script>
	<script src="../func/jquery-ui-1.10.3/ui/jquery-ui.js"></script>

	<script src="/ieditor/ckeditor.js"></script>
	<script src="/ckfinder/ckfinder.js"></script>

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
<td width="250" valign="top" >
	<?php include('sidemenu.php') ?>
</td>
<td valign="top" bgcolor="#3f1d0e" style="padding-top:20px;">				
	<?php
		if($_POST['Submit']){
			$q = "UPDATE `news` SET 
			`detail` = '".$_POST['detail']."' WHERE `id` =".$_POST['e_front_id']." ";
			$db->query($q);
			redi4('news.php?e_front_id='.$_GET['e_front_id']);							
		}
		if($_GET['e_front_id']){
			$q = "SELECT * FROM news WHERE id=".$_GET['e_front_id']." ";
			$db5 = new nDB();
			$db5->query($q);
			$db5->next_record();
		}
	?>
	<form action="" method="post" enctype="multipart/form-data" name="form1" id="form1">
	<table width="95%" border="0" align="center" cellpadding="0" cellspacing="2" class="box_from3_2">
		<tr>
			<td height="25" align="center" bgcolor="#4d1403" class="bh">
				รายละเอียด
				ข่าวสารประชาสัมพันธ์
			</td>
		</tr>
		<tr>
			<td bgcolor="#3c1204" style="color:#ffffff;">
				<div style="width:677px;">
					<textarea id="detail" name="detail"><?=($_GET['e_front_id'])?$db5->f(detail):"&nbsp;"?></textarea>
				</div>
				<script>
					CKEDITOR.replace('detail',{
						filebrowserBrowseUrl : 'ckfinder/ckfinder.html',
						filebrowserImageBrowseUrl : 'ckfinder/ckfinder.html?type=Images',
						filebrowserFlashBrowseUrl : 'ckfinder/ckfinder.html?type=Flash',
						filebrowserUploadUrl : 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files&currentFolder=/userfile/',
						filebrowserImageUploadUrl : 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images&currentFolder=/userfile/',
						filebrowserFlashUploadUrl : 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash'
					});
				</script>
			</td>
		</tr>
		<tr>
			<td bgcolor="#3c1204">
				<input name="Submit" type="submit" class="button_add" value="<?=($_GET['e_front_id'])?"แก้ไขข้อมูล":"เพิ่มข้อมูล"?>" />
				<?php
					if($_GET['e_front_id']){
				?>
				<input name="e_front_id" type="hidden" id="e_front_id" value="<?=$db5->f(id)?>"/>							  
				<?php
					}
				?>
			</td>
		</tr>
	</table>
	</form>
</td>
</tr>
</table>
</td>
</tr>
</table>
</body>
</html>