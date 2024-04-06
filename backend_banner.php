<?php include("global.php"); ?>
<?php if($_SESSION['adminshop_id']=='' || !isset($_SESSION['adminshop_id'])) {  
	redi4("index.php");
	} ?>
<?php set_page($s_page,$e_page=20); //นำส่วนนี้ิไว้ด้านบน ?>
<html>
	<head>
		<title>ระบบจัดการเว็บไซต์ : ปรับแต่งป้ายร้าน</title>
		<link rel="shortcut icon" href="favicon.ico" />
		<link rel="favicon" href="favicon.ico" />
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<style type="text/css">
			body {
				background-color: #000;
			}
			body,td,th {
				font-family: Arial, Helvetica, sans-serif;
				font-size: 12px;
				color: #000;
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
			function MM_swapImgRestore() { //v3.0
				var i, x, a = document.MM_sr;
				for (i = 0; a && i < a.length && (x = a[i]) && x.oSrc; i++) x.src = x.oSrc;
			}

			function MM_preloadImages() { //v3.0
				var d = document;
				if (d.images) {
					if (!d.MM_p) d.MM_p = new Array();
					var i, j = d.MM_p.length,
						a = MM_preloadImages.arguments;
					for (i = 0; i < a.length; i++)
					if (a[i].indexOf("#") != 0) {
						d.MM_p[j] = new Image;
						d.MM_p[j++].src = a[i];
					}
				}
			}

			function MM_findObj(n, d) { //v4.01
				var p, i, x;
				if (!d) d = document;
				if ((p = n.indexOf("?")) > 0 && parent.frames.length) {
					d = parent.frames[n.substring(p + 1)].document;
					n = n.substring(0, p);
				}
				if (!(x = d[n]) && d.all) x = d.all[n];
				for (i = 0; !x && i < d.forms.length; i++) x = d.forms[i][n];
				for (i = 0; !x && d.layers && i < d.layers.length; i++) x = MM_findObj(n, d.layers[i].document);
				if (!x && d.getElementById) x = d.getElementById(n);
				return x;
			}

			function MM_swapImage() { //v3.0
				var i, j = 0,
					x, a = MM_swapImage.arguments;
				document.MM_sr = new Array;
				for (i = 0; i < (a.length - 2); i += 3)
				if ((x = MM_findObj(a[i])) != null) {
					document.MM_sr[j++] = x;
					if (!x.oSrc) x.oSrc = x.src;
					x.src = a[i + 2];
				}
			}
		</script>
	</head>
	<body bgcolor="#FFFFFF" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" onLoad="MM_preloadImages('images/images/menu-backend2_02.jpg','images/images/menu-backend2_04.jpg','images/images/menu-backend2_05.jpg','images/images/menu-backend2_06.jpg','images/images/menu-backend2_07.jpg','images/images/menu-backend2_08.jpg')">
		<?php
			if($_POST['submit']){
				$q="SELECT * FROM `member` WHERE id='".$_SESSION['adminshop_id']."' ";
				$dbbanner= new nDB();
				$dbbanner->query($q);
				$dbbanner->next_record();
				
			if ($dbbanner->f(head2)=='') {
					$q="UPDATE `member` SET `score` = `score`+30 WHERE `id` =".$_POST['h_member_id']." ";
					$db->query($q);
			}
			if ($dbbanner->f(head1)=='defualt.jpg') {
					$q="UPDATE `member` SET `score` = `score`+30 WHERE `id` =".$_POST['h_member_id']." ";
					$db->query($q);
			}	
				
			for($mf=1;$mf<=2;$mf++){
				$upf[$mf]=uppic($_FILES['file'.$mf],$mf,"img/head/",$_POST['h_pic'.$mf]); // Same folder
				if($upf[$mf]!=''){
					$q="UPDATE `member` SET `head$mf` = '".$upf[$mf]."' WHERE `id` =".$_POST['h_member_id']." ";
					$db->query($q);
				}	
			}			
			al('Complete');
			redi2();
			}
			?>
		<!-- Save for Web Slices (???????.jpg) -->
		<table width="1000" border="0" align="center" cellpadding="0" cellspacing="0" id="Table_01">
			<tr>
			<td height="25" bgcolor="#311308">&nbsp;</td>
			</tr>
			<tr>
			<td><img src="images/defualt.jpg" width="1000" height="271"></td>
			</tr>
			<tr>
			<td width="1000" height="180" style="background:url(images/backend.jpg) no-repeat">
				<table width="100%" border="0" cellspacing="0" cellpadding="0">
					<tr>
						<td><img src="images/images/menubackend_01.jpg" width="103" height="180"></td>
						<td><a href="shop_index.php?shop=<?=$_SESSION['adminshop_id']?>" target="_blank" onMouseOver="MM_swapImage('Image8','','images/images/menu-backend2_02.jpg',1)" onMouseOut="MM_swapImgRestore()"><img src="images/images/menubackend_02.jpg" name="Image8" width="130" height="180" border="0"></a></td>
						<td><a href="backend.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image9','','images/images/menu-backend2_03.jpg',0)"><img src="images/images/menubackend_03.jpg" name="Image9" width="94" height="180" border="0"></a></td>
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
			<?php 
			$q="SELECT * FROM `member` WHERE id='".$_SESSION['adminshop_id']."' ";
			$db5= new nDB();
			$db5->query($q);
			$db5->next_record();
			?>
			<tr>
			<td valign="top" style="padding:5px; background:url(images/backend-bgbanner.jpg) no-repeat">
				<form action="" method="post" enctype="multipart/form-data" name="form1" id="form1">
					<table width="100%" border="0" cellspacing="0" cellpadding="3">
						<tr>
						<td width="33%" height="44" align="right" style="padding-right:15px; padding-top:20px; font-weight:bold">ภาพป้ายร้านค้า / 选择商店招牌图片:</td>
						<td width="67%" valign="bottom" style="padding-top:3px"><input name="file1" type="file" id="file1">
							<span style="font-weight:bold">กว้าง 宽度1000 x 350 pixels</span>
						</td>
						</tr>
						<tr>
						<td width="33%" height="44" align="right" style="padding-right:15px; padding-top:20px; font-weight:bold">&nbsp;</td>
						<td width="67%" valign="top" style="padding-top:3px">
							<table width="100%" border="0" cellpadding="3" cellspacing="0">
								<tr>
									<td colspan="7" align="left" valign="top"><img src="<?=($db5->f(head1)!="")?'img/head/'.$db5->f(head1):"images/defualt.jpg"?>" width="250" height="70"></td>
								</tr>
							</table>
						</td>
						</tr>
						<tr>
						<td width="33%" height="55" align="right" style="padding-right:15px; padding-top:25px; font-weight:bold">เลือกภาพ Logo ร้านค้า / 选商店LOGO图片:</td>
						<td width="67%" valign="bottom" style="padding-top:3px"><input name="file2" type="file" id="file2">
							<span style="font-weight:bold">กว้าง 宽度180 x 180 pixels</span>
						</td>
						</tr>
						<tr>
						<td width="33%" height="44" align="right" style="padding-right:15px; padding-top:20px; font-weight:bold">&nbsp;</td>
						<td width="67%" valign="top" style="padding-top:3px">
							<table width="100%" border="0" cellpadding="3" cellspacing="0">
								<tr>
									<td colspan="7" align="left" valign="top"><img src="<?=($db5->f(head2)!="")?'img/head/'.$db5->f(head2):"images/logodefualt.jpg"?>" width="70" height="70"></td>
								</tr>
							</table>
						</td>
						</tr>
						<tr>
						<td height="40" colspan="2" align="center" valign="bottom"><input name="submit" type="submit" id="submit" value="บันทึกข้อมูล / 记录信息" />
							<input name="h_member_id" type="hidden" id="h_member_id" value="<?=$db5->f(id)?>" />
							<input name="h_pic" type="hidden" id="h_pic" value="<?=$db5->f(head)?>" />
						</td>
						</tr>
					</table>
				</form>
			</td>
			</tr>
			<tr>
			<td>&nbsp;</td>
			</tr>
			<tr>
				<td>
					<?php include('footer.php');?>
				</td>
			</tr>
		</table>
		<!-- End Save for Web Slices -->
	</body>
</html>
