<? include('../global.php');?>
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
			html,body{
				font-size: 13px;
				font-family: Tahoma, Geneva, sans-serif;
			}
			body {
				background-color: #000;
				margin: 0;
			}
			.bh{
				color:#FC0;
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
				$rDel = mysql_fetch_array(mysql_query("DELETE FROM `product` WHERE `product_id` = ".$_GET['d_product_id']." "));
				@unlink("img/amulet/".$rDel['pic1']);
				@unlink("img/amulet/".$rDel['pic2']);		
				@unlink("img/amulet/".$rDel['pic3']);		
				@unlink("img/amulet/".$rDel['pic4']);							
				$q="DELETE FROM `product` WHERE `product_id` = ".$_GET['d_product_id']." ";
				$db->query($q);		
			}
			?>
		<?php
			if($_GET['hot_id']){
				$q="update `product` set hot='".$_GET['status']."' WHERE `product_id` =".$_GET['hot_id']." ";
				$db->query($q);
				//redi2("product.php?s_page=".$_GET['s_page']);				
				echo "<script>window.location.href='product.php?s_page=".$_GET['s_page']."';</script>";
			}
			?>	
		<?php
			if($_GET['certificate_id']){
				$q="update `product` set certificate='".$_GET['status']."' , `certificatedate` = '".date("Y-m-d H:i:s")."' WHERE `product_id` =".$_GET['certificate_id']." ";
				$db->query($q);
				//redi2("product.php?s_page=".$_GET['s_page']);		
				echo "<script>window.location.href='product.php?s_page=".$_GET['s_page']."';</script>";
			}
			?>	
		<?php
			if($_GET['recommend_id']){
				$q="update `product` set recommend='".$_GET['status']."' , `hotdate` = '".date("Y-m-d H:i:s")."' WHERE `product_id` =".$_GET['recommend_id']." ";
				$db->query($q);
				//redi2("product.php?s_page=".$_GET['s_page']);		
				echo "<script>window.location.href='product.php?s_page=".$_GET['s_page']."';</script>";
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
						<form action="search_product.php" method="post">
							<table width="95%" align="center" cellpadding="3" cellspacing="0">
								<tr>
									<td width="36%" align="right" bgcolor="#692908"><span style="color:#FC0; font-size:12px">ค้นหา</span></td>
									<td width="54%" bgcolor="#692908"><input name="q" type="text" id="q" size="60" /></td>
									<td width="10%" bgcolor="#692908"><input name="ค้นหา" type="submit" id="ค้นหา" value="ค้นหา" /></td>
								</tr>
							</table>
						</form>
						<h4 style="padding: 5px 20px; color: rgb(255, 255, 255); margin: 0px;">สินค้าที่แจ้งลบ</h4>
						<table width="95%" border="0" align="center" cellpadding="3" cellspacing="1">
							<tr class="bh">
								<td width="55" height="25" align="center" bgcolor="#692908">No.</td>
								<td width="129" align="center" bgcolor="#692908">รูปภาพ</td>
								<td width="204" align="center" bgcolor="#692908">ชื่อ</td>
								<td width="77" align="center" bgcolor="#692908">แจ้งเมื่อ</td>
								<td width="60" align="center" bgcolor="#692908">ลบ</td>
							</tr>
							<?php
								$q="SELECT * FROM `member` WHERE id='".$_SESSION['shop_id']."' ";
								$db->query($q);
								$db->next_record();
								$shop_id = $db->f(id);			   
								$q="SELECT * FROM `product` WHERE notification_del = 1 ";
								$db->query($q);							
								$total=$db->num_rows();							
								$q.=" ORDER BY product_id DESC LIMIT $s_page,$e_page ";
								$db->query($q);
								static $v=1; 
								while($db->next_record()){
								?>		
							<tr bgcolor="<?=($v%2==1)?"#311407":"#4f3b2a"?>" class="sidemenu">
								<td height="25" align="center">
									<?=$db->f(product_id)?>
								</td>
								<td align="center">
									<a href="http://www.praasia.com/shop_product.php?product_id=<?=$db->f(product_id)?>" target="_blank">
									<img src="/slir/w125-h125-c1:1/img/amulet/<?=$db->f(pic1)?>" width="125" height="125" />
									</a>
								</td>
								<td align="left"><?=$db->f(name)?></td>
								<td align="center"><?=date("d/m/Y",strtotime($db->f(notification_created)))?></td>
								<td align="center"><a href="?d_product_id=<?=$db->f(product_id)?>&s_page=<?=$_GET["s_page"]?>"  onClick="return confirm('คุณแน่ใจที่จะลบสินค้าหรือไม่ ?')"><img src="images/del.gif" width="19" height="23" border="0"></a></td>
							</tr>
							<?php $v++; } ?>
							<tr>
								<td height="30" colspan="9" align="center"> <?php  sh_page($total,$s_page,$e_page,$chk_page,Previous,Next,"#FFCC00","#F8F8F8"); // นำไปวางในตำแหน่งที่ต้องการแสดง ?></td>
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