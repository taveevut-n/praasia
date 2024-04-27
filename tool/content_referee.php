<?php
	include("../global.php");
	if( $_SESSION["adminshop_id"] == "" || !isset($_SESSION["adminshop_id"]) ) {  
		redi4("index.php");
	}
	
	set_page($s_page,$e_page = 20);

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
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>
			ระบบจัดการเว็บไซต์  : จัดการสินค้า
		</title>
		<link rel="shortcut icon" href="../favicon.ico" />
		<link rel="favicon" href="../favicon.ico" />
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<!--jquery ui Local-->
		<link rel="stylesheet" href="../func/jquery-ui-1.10.3/themes/base/jquery-ui.css" />
		<script src="../func/jquery-ui-1.10.3/jquery-1.9.1.js"></script>
		<script src="../func/jquery-ui-1.10.3/ui/jquery-ui.js"></script>
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
			.flat_textbox {
				padding-left:0px;
				padding-right:0px;
				height:17px;
				font-family:Tahoma;
				font-size:12px;
				color:#444444;
				background-color:#ffffff;
				-webkit-box-sizing: border-box;
				-moz-box-sizing: border-box;
				box-sizing: border-box;
				border:0px solid transparent;
				outline:none;
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
	<body onLoad="MM_preloadImages('../images/images/menu-backend2_02.jpg','../images/images/menu-backend2_04.jpg','../images/images/menu-backend2_05.jpg','../images/images/menu-backend2_06.jpg','../images/images/menu-backend2_07.jpg','../images/images/menu-backend2_08.jpg')">
		<?php
			if($_GET['hot_id']){
				$q = "update `product` set hot = '".$_GET['status']."' , hotdate =  '".time()."' WHERE `product_id` =".$_GET['hot_id']." ";
				$db->query($q);
				echo "<script>window.location.href='backend.php?s_page=".$_GET['s_page']."';</script>";			
			}
			?>
		<table width="1000px" align="center" border="0" cellpadding="0" cellspacing="0">
			<tr>
				<td>
					<img src="../images/defualt.jpg" width="1000" height="271">
				</td>
			</tr>
			<tr>
				<td height="180px" bgcolor="#333333">&nbsp;
					
				</td>
			</tr>
			<tr>
				<td style="height:1px;">
					<?php
						include("../backend_menutop.php");
						?>
				</td>
			</tr>
			<tr>
				<td bgcolor="#c67210">&nbsp;</td>
			</tr>
			<tr>
				<td style="background-color:#4f3b2a;">&nbsp;</td>
			</tr>
			<tr>
				<td height="40" align="center" bgcolor="#333333">
					<?php include('../footer.php');?>
				</td>
			</tr>
		</table>
		<!-- End Save for Web Slices -->
	</body>
	<script type="text/javascript">
		function checkbeforadd(memid){
			$.ajax({
				url :'chcheckadd.php',
				type : 'POST',
				dataType : 'JSON',
				data :{
					adminshop_id : memid
				},
				success : function(res){
					if(res.result){
						window.location.href = "backend_add.php";
					}else{
						alert('กรุณาเข้าไปใส่ ป้ายร้านค้า Logo ให้เรียบร้อยก่อนที่จะทำการลงสินค้า \r\n ### 请先到商店的招牌 Logo(Shop Nameplate) ### \r\n ### 里面把招牌和Logo图片传上来以后才能增加产品 谢谢 !!! ###');
						window.location.href ="backend_banner.php";
					}
				}
			});
		}
	</script>
</html>