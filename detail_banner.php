<?php include("global.php"); 
	include("global_counter.php");
	?>
<?php
	if($_POST['Login'])
	{
		$q="SELECT * FROM member WHERE username='".trim($_POST['username'])."' AND password='".trim($_POST['password'])."' AND active= '1' ";
		$db->query($q);	
			if($db->num_rows()>0){
			$db->next_record();
			$_SESSION['shop_id']=$db->f(id);	
			$_SESSION['nameshop']=$db->f(name);		
			echo '<meta http-equiv="refresh" content="0;URL=http://www.praasia.com/backend.php" />';
			exit;
			}else{
			al('รหัสผ่านไม่ถูกต้อง');
			echo '<meta http-equiv="refresh" content="0;URL=http://www.pramuangthai.com/index.php" />';
			exit;
			}
	}
	?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>ศูนย์รวมพระเครื่องออนไลน์</title>
		<META name=description content="ศนย์พระเครื่อง เปิดร้านพระออนไลน์" >
		<meta name="keywords" content="ศูนย์พระเครื่องภาคใต้, ศูนย์พระเครื่องภาคเหนือ, ศูนย์พระเครื่องกรุงเทพ, ศูนย์พระเครื่องอีสาน"/>
		<link rel="icon" href="/favicon.ico" type="image/x-icon" />
		<?php include("index.css"); ?>
	</head>
	<body>
		<table width="1000" border="0" align="center" cellpadding="0" cellspacing="0">
			<tr>
				<td><? include('head.php') ?></td>
			</tr>
			<?php
				$q="SELECT * FROM `banner` WHERE banner_id='".$_GET['banner_id']."' ";
				$db->query($q);
				$db->next_record();
				?>
			<tr>
				<td align="center" bgcolor="#F8F8F8" style="padding-top:10px;padding-left:5px;padding-right:5px">
					<?=$db->f(banner_detail)?>
				</td>
			</tr>
			<tr>
				<td>
					<? include('footer.php');?>
				</td>
			</tr>
		</table>
	</body>
</html>
