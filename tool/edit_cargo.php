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
	if($_POST['submit']){
		$q="update `product` set name='".$_POST['shopname']."' , detail = '".$_POST['detail']."' WHERE `product_id` =".$_GET['edit_id']." ";
		$db->query($q);
		//redi2("product.php?s_page=".$_GET['s_page']);				
		echo "<script>window.location.href='stores_cargo.php?shopname=".$_GET['shopname']."&s_page=".$_GET['s_page']."';</script>";
	}
?>	
<script src="../ieditor/ckeditor.js"></script>  
<table width="1000" border="0" align="center" cellpadding="0" cellspacing="0">
	<tr>
		<td>
			<img src="/admin/images/head.jpg" width="1098" height="288" />
		</td>
	</tr>
	<tr>
		<td bgcolor="#311407">
			<table width="100%" border="0" cellspacing="3" cellpadding="0">
				<tr>
					<td width="250" valign="top" >
						<? include('sidemenu.php') ?>
					</td>
					<td valign="top" bgcolor="#3f1d0e">
						<form action="" method="post">
							<table width="95%" border="0" align="center" cellpadding="3" cellspacing="1">
								<?php
										$q="SELECT * FROM `product` WHERE shop_id= '".$_GET['shopname']."' and product_id = '".$_GET['edit_id']."' ";
										$db->query($q);							
										$db->next_record();		
									 ?>		
								<tr class="bh">
									<td height="25" colspan="2" bgcolor="#4a1701" id="detail-text" style="color: #FC0">
										รายละเอียดสินค้า
									</td>
								</tr>                   
								<tr>
									<td align="right" bgcolor="#311308" class="sidemenu" id="detail-text">
										<span id="za_mo2">
											ชื่อสินค้า :
										</span>
									</td>
									<td bgcolor="#311308" class="sidemenu">
										<input name="shopname" type="text" class="box_form" id="shopname" value="<?=$db->f(name)?>" /> 
									</td>
								</tr>          
								<tr>
									<td align="right" bgcolor="#311308" class="sidemenu" id="detail-text">
										รายละเอียดสินค้า :
									</td>
									<td bgcolor="#311308">
										<textarea name="detail" cols="60" rows="5" id="detail"><?=$db->f(detail)?></textarea>
									</td>
								</tr>
									<script>
									CKEDITOR.replace( 'detail', {
										toolbar:  [
										]
									});						
							</script>
								<tr>
									<td bgcolor="#311308" id="detail-text">&nbsp;
										
									</td>
									<td bgcolor="#311308">
										<input name="submit" type="submit" id="submit" value="แก้ไข" />
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