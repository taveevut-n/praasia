<?php
	include('../global.php');

	if($_SESSION['adminid']=='' || !isset($_SESSION['adminid'])) {  
		redi4("login.php");
	} 
?>
<?php set_page($s_page,$e_page=20); //นำส่วนนี้ิไว้ด้านบน ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<title>ระบบจัดการเว็บไซต์</title>
		<style type="text/css">
			*{
				font-size: 12px;
			}
			body {
				font-family: Tahoma, Geneva, sans-serif;
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
			input[type="text"]{
				height: 16px;
			}
		</style>

		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
		       
	</head>
	<body>
<script>
	var page_container = "";
	function page_select(x_this,page_object,page_file,page_min,page_max){
		page_container = page_object;
		$("html, body").animate({ "scrollTop":page_container.offset().top+"px" }, 0);
		$.ajax({
			type: "POST",
			url: page_file,
			data: { page_min:page_min, page_max:page_max, page_num:$.trim(x_this.attr("page_num")), page_total:$.trim(x_this.attr("page_total")) },
			cache: false,
			success: function(result){
				page_container.html(result);
			}
		});
	}
</script>    
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
			// if($_GET['hot_id']){
			// 	$q="update `product` set hot='".$_GET['status']."' WHERE `product_id` =".$_GET['hot_id']." ";
			// 	$db->query($q);
			// 	//redi2("product.php?s_page=".$_GET['s_page']);				
			// 	echo "<script>window.location.href='product.php?s_page=".$_GET['s_page']."';</script>";
			// }
			?>	
		<?php
			// if($_GET['certificate_id']){
			// 	$q="update `product` set certificate='".$_GET['status']."' , `certificatedate` = '".date("Y-m-d H:i:s")."' WHERE `product_id` =".$_GET['certificate_id']." ";
			// 	$db->query($q);
			// 	//redi2("product.php?s_page=".$_GET['s_page']);		
			// 	echo "<script>window.location.href='product.php?s_page=".$_GET['s_page']."';</script>";
			// }
			?>	
		<?php
			// if($_GET['recommend_id']){
			// 	$q="update `product` set recommend='".$_GET['status']."' , `hotdate` = '".date("Y-m-d H:i:s")."' WHERE `product_id` =".$_GET['recommend_id']." ";
			// 	$db->query($q);
			// 	//redi2("product.php?s_page=".$_GET['s_page']);		
			// 	echo "<script>window.location.href='product.php?s_page=".$_GET['s_page']."';</script>";
			// }
			?>	
		<?php
			// if($_GET['show_id']){
			// 	$q="update `product` set showtype='".$_GET['show']."' WHERE `product_id` =".$_GET['show_id']." ";
			// 	$db->query($q);
			// 	//redi2("product.php?s_page=".$_GET['s_page']);		
			// 	echo "<script>window.location.href='product.php?s_page=".$_GET['s_page']."';</script>";
			// }
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
						<td>

                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td valign="top" bgcolor="#3f1d0e">
                                <form action="search_product.php" method="post">
                                    <table width="95%" align="center" cellpadding="3" cellspacing="0">
                                        <tr>
                                            <td align="center" bgcolor="#692908"><span class="sidemenu">ค้นหา <input name="q" type="text" id="q" size="60" /> <input name="ค้นหา" type="submit" id="ค้นหา" value="ค้นหา" /></span></td>
                                        </tr>
                                    </table>
                                </form>
                                <p>&nbsp;</p>						
                                <? include('list_certificate.php');?></td>
                                </tr>
                                </table>
                                
                            </tr>
                        </table>
			</td>
			</tr>
		</table>
	</body>
</html>