<?php
	include("global.php");
	if( $_SESSION['adminshop_id'] == '' || !isset($_SESSION['adminshop_id']) ) {  
		redi4("index.php");
	}
	set_page($s_page,$e_page = 20);
	mysql_query("update twe_message set message_status = '1' where receiver_id = '".$_SESSION["adminshop_id"]."' and message_status = '0'");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

	<title>
		ระบบจัดการเว็บไซต์  : จัดการสินค้า
	</title>

	<link rel="shortcut icon" href="favicon.ico" />
	<link rel="favicon" href="favicon.ico" />
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

	<!--jquery ui Local-->
	<link rel="stylesheet" href="func/jquery-ui-1.10.3/themes/base/jquery-ui.css" />
	<script src="func/jquery-ui-1.10.3/jquery-1.9.1.js"></script>
	<script src="func/jquery-ui-1.10.3/ui/jquery-ui.js"></script>

	<style type="text/css">
		html, body {
			margin:0px;
			padding:0px;
			width:100%;
			height:100%;
		}
		body {
			background-color:#000000;
		}
		body,td,th {
			font-family: Arial, Helvetica, sans-serif;
			font-size: 12px;
			color: #FFF;
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
		table{
			border-collapse:collapse;
		}
		.pm_table {
			border-collapse:collapse;
		}
		.pm_tr {
			background-color:#5c4531;
			cursor:pointer;
		}
		.pm_tr:hover {
			background-color:#3c2d20;
		}
	</style>

	<script type="text/javascript">
		function MM_swapImgRestore() { //v3.0
			var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
		}
		function MM_preloadImages() { //v3.0
			var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
			var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
			if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
		}
		function MM_findObj(n, d) { //v4.01
			var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
			d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
			if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
			for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
			if(!x && d.getElementById) x=d.getElementById(n); return x;
		}
		function MM_swapImage() { //v3.0
			var i,j=0,x,a=MM_swapImage.arguments; document.MM_sr=new Array; for(i=0;i<(a.length-2);i+=3)
			if ((x=MM_findObj(a[i]))!=null){document.MM_sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];}
		}
	</script>

</head>
<body onLoad="MM_preloadImages('images/images/menu-backend2_02.jpg','images/images/menu-backend2_04.jpg','images/images/menu-backend2_05.jpg','images/images/menu-backend2_06.jpg','images/images/menu-backend2_07.jpg','images/images/menu-backend2_08.jpg')">
<?php
	if($_GET['d_product_id']){
		@unlink("img/amulet/".$_GET['pic1']);
		@unlink("img/amulet/".$_GET['pic2']);
		@unlink("img/amulet/".$_GET['pic3']);
		@unlink("img/amulet/".$_GET['pic4']);
		$q = "DELETE FROM `product` WHERE `product_id` = ".$_GET['d_product_id']." ";
		$db->query($q);
		redi4('backend.php');
	}
	if($_GET['hot_id']){
		$q = "update `product` set hot='".$_GET['status']."' WHERE `product_id` =".$_GET['hot_id']." ";
		$db->query($q);
		redi2();
	}
?>
<table width="1000px" align="center" border="0" cellpadding="0" cellspacing="0">
	<tr>
		<td>
			<img src="images/defualt.jpg" width="1000" height="271">
		</td>
	</tr>
	<tr>
		<td height="180px" style="background:#ff0000 url(images/backend.jpg) no-repeat">
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td><img src="images/images/menubackend_01.jpg" width="103" height="180"></td>
					<td><a href="shop_index.php?shop=<?=$_SESSION['adminshop_id']?>" target="_blank" onMouseOver="MM_swapImage('Image8','','images/images/menu-backend2_02.jpg',1)" onMouseOut="MM_swapImgRestore()"><img src="images/images/menubackend_02.jpg" name="Image8" width="122" height="180" border="0"></a></td>
					<td><a href="backend.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image9','','images/images/menu-backend2_03.jpg',0)"><img src="images/images/menubackend_03.jpg" name="Image9" width="102" height="180" border="0"></a></td>
					<td><a href="banner_slide.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image10','','images/images/menu-backend2_04.jpg',1)"><img src="images/images/menubackend_04.jpg" name="Image10" width="108" height="180" border="0"></a></td>
					<td><a href="backend_banner.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image11','','images/images/menu-backend2_05.jpg',1)"><img src="images/images/menubackend_05.jpg" name="Image11" width="129" height="180" border="0"></a></td>
					<td><a href="backend_profile.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image12','','images/images/menu-backend2_06.jpg',1)"><img src="images/images/menubackend_06.jpg" name="Image12" width="103" height="180" border="0"></a></td>
					<td><a href="backend_passwod.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image13','','images/images/menu-backend2_07.jpg',1)"><img src="images/images/menubackend_07.jpg" name="Image13" width="136" height="180" border="0"></a></td>
					<td><a href="logout.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image14','','images/images/menu-backend2_08.jpg',1)"><img src="images/images/menubackend_08.jpg" name="Image14" width="92" height="180" border="0"></a></td>
					<td><img src="images/images/menubackend_09.jpg" width="105" height="180"></td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td style="height:1px;">
			<?php
				include("backend_menutop.php");
			?>
		</td>
	</tr>
	<tr>
		<td style="background-color:#4f3b2a;">
			<table width="100%" border="0" cellpadding="0" cellspacing="0">
				<tr style="height:30px;">
					<td style="padding-left:20px; padding-right:20px; width:1px; white-space:nowrap;">
						จาก
					/ 来自</td>
					<td style="padding-left:20px; padding-right:20px;">
						ข้อความ
					/ 信息</td>
					<td style="padding-left:20px; padding-right:20px; width:1px; white-space:nowrap;">
						วันที่ได้รับ
					/ 收件期间</td>
					<td style="padding-left:20px; padding-right:20px; width:1px; white-space:nowrap;text-align:cener;">
						ตอบ
					/ 回信息</td>
				</tr>
				<?php
					$q_message = mysql_query("select * from twe_message msg 
												left join member m on msg.sender_id = m.id 
												where receiver_id = '".$_SESSION["adminshop_id"]."' 
												order by msg.message_id desc");
					$index = 0;
					while($message = mysql_fetch_array($q_message)){
						$r_member = mysql_fetch_array(mysql_query("select * from member where id = '".$message["sender_id"]."' "));
						if($r_member['type'] == 0){
							$text_link = 'onclick="window.location.href=\'shop_index.php?shop='.$message["sender_id"].'\'"';
						}else if($r_member['type'] == 2){
							$text_link = 'onclick="window.location.href=\'member_profile.php?member_id='.$message["sender_id"].'\'"';
						}
				?>
				<tr class="pm_tr" style="height:30px;">
					<td style="padding-left:20px; padding-right:20px; white-space:nowrap;" <?=$text_link;?> >
						<?=$message["name"]?>
					</td>
					<td style="padding-left:20px; padding-right:20px;" x_index="<?=$index?>" onclick="view_detail($(this));">
						<?=substr($message["message"], 0, 100)?>
					</td>
					<td style="padding-left:20px; padding-right:20px; white-space:nowrap;">
						<?=date("d-m-Y", strtotime($message["create_date"]))?>
					</td>
					<td style="padding-left:20px; padding-right:20px; white-space:nowrap;text-align: center;">
						<a href="javascript:void(0);" onclick="window.location.href='backend_pm_create.php?v=<?=urlencode($message["name"])?>'"><img src="images/email_reply.png" border="0"></a>
					</td>
				</tr>
				<tr class="pmdetail_tr" style="height:30px; display:none;">
					<td>&nbsp;
						
					</td>
					<td colspan="2" style="padding-left:20px; padding-right:20px;">
						<?=$message["message"]?>
					</td>
				</tr>
				<?php
					$index++;
					}
				?>
			</table>
		</td>
	</tr>
	<tr>
		<td>
			<?php include('footer.php');?>
		</td>
	</tr>
</table>
<script type="text/javascript">
	function view_detail(x_this){
		var index = x_this.attr("x_index");
		$(".pmdetail_tr").hide();
		$(".pm_tr:eq("+index+")").next().show();
	}
</script>
</body>
</html>
