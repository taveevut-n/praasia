<? include('../global.php')?>
<?php if($_SESSION['adminid']=='' || !isset($_SESSION['adminid'])) {  
        redi4("login.php");
	
		} 

		if($_GET['content_id']) {
			$_SESSION['content_id'] = $_GET['content_id'];
		}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>ระบบจัดการเว็บไซต์</title>
        <link rel="stylesheet" href="colorbox.css" />
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
		<script src="jquery.colorbox.js"></script>
		<script>
			$(document).ready(function(){
				//Examples of how to assign the Colorbox event to elements
				$(".group1").colorbox({rel:'group1'});
				$(".group2").colorbox({rel:'group2', transition:"fade"});
				$(".group3").colorbox({rel:'group3', transition:"none", width:"75%", height:"75%"});
				$(".group4").colorbox({rel:'group4', slideshow:true});
				$(".ajax").colorbox();
				$(".youtube").colorbox({iframe:true, innerWidth:640, innerHeight:390});
				$(".vimeo").colorbox({iframe:true, innerWidth:500, innerHeight:409});
				$(".iframe").colorbox({iframe:true, width:"80%", height:"80%"});
				$(".inline").colorbox({inline:true, width:"50%"});
				$(".callbacks").colorbox({
					onOpen:function(){ alert('onOpen: colorbox is about to open'); },
					onLoad:function(){ alert('onLoad: colorbox has started to load the targeted content'); },
					onComplete:function(){ alert('onComplete: colorbox has displayed the loaded content'); },
					onCleanup:function(){ alert('onCleanup: colorbox has begun the close process'); },
					onClosed:function(){ alert('onClosed: colorbox has completely closed'); }
				});

				$('.non-retina').colorbox({rel:'group5', transition:'none'})
				$('.retina').colorbox({rel:'group5', transition:'none', retinaImage:true, retinaUrl:true});
				
				//Example of preserving a JavaScript event for inline calls.
				$("#click").click(function(){ 
					$('#click').css({"background-color":"#f00", "color":"#fff", "cursor":"inherit"}).text("Open this window again and this message will still be here.");
					return false;
				});
			});
		</script>
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
                          	<td align="right">
																		<script language="javASCript">
																			function selec(){
																				var ab=document.getElementById('se');
																				location.href=ab.value;
																			}
																		</script>
																		<span style="color:#ffffff;">เลือกรายการจัดการ :</span> 
																		<select name="select" onchange="selec();" id="se" style="height: 21px;">
																		  <option value="">--------กรุณาเลือกรายการ--------</option>
																			<option value="catalog_cert.php">หมวดหม่พระที่ออกบัตร</option>
                                                                            <option value="datacertificate.php">เพิ่มข้อมูลพระที่ออกบัตร</option>
                                                                            <option value="content_group.php">ย้ายหมวดหมู่</option>
																			<option value="checkcertificate.php">ข้อมูลพระที่ออกบัตร เพิ่มที่ปรึกษา</option>	
                                                                            <option value="admin_checklist_certificate.php">ดูรายการทั้งหมด</option>											
																	  </select>  
                            </td>
                          </tr>  
  <tr>
    <td bgcolor="#311407">
<table width="100%" cellpadding="0" cellspacing="0" border="0">
																		<tr>
																			<td height="56" align="center" style="background:#FC3 url(images/tab.jpg) no-repeat; border-top:3px solid #960; font-size:16px">
																				<span style="font-size: 16px; color: #a80804; font-weight:bold">หมวดหมู่ใหญ่หรือตามภาค / 泰国部级佛牌分类区</span>
																			</td>
																		</tr>
																		<tr>
																			<td style="padding-left:5px;padding-right:5px;background:#311407;padding-bottom: 100px;">
																				<style type="text/css">
																					a.text-linkmain,a.text-linkmain:visited,a.text-linkmain:link{
																						color: #fff;
																						text-decoration: underline;
																						font-size: 12px;
																					}
																					.table-catdisplay{
																						float: left;
																						width: 50%;
																					}
																				</style>
																				<table width="100%" cellpadding="3" cellspacing="0">
																					<?php
																					$q = mysql_query("select * from catalog_cert where top_id = 0 order by catalog_id asc");
																					while ( $main = mysql_fetch_array($q)) {
																						?>
																					<tr>
																						<td>
																							<a><h3 style="color: #E5CB15;"><?php echo $main['catalog_name'];?> / <?php echo $main['catalog_name_cn'];?></h3></a>
																							<?php
																							$qcat = mysql_query("select * from catalog_cert where top_id = ".$main['catalog_id']." order by catalog_id asc");
																							while ( $category = mysql_fetch_array($qcat)) {
																								?>
																								<table cellpadding="3" cellspacing="0" class="table-catdisplay">
																									<tr>
																										<td width="1" style="color: #fff;font-size: 20px;padding-left: 20px;">•</td>
																										<td>
																											<a class="text-linkmain" href="admin_list_certificate.php?c=<?php echo $category['catalog_id'];?>&g=<?php echo $main['catalog_id'];?>">
																												<?php echo $category['catalog_name'];?></br><?php echo $category['catalog_name_cn'];?>
																											</a>
																										</td>
																									</tr>
																								</table>
																								<?php 
																							}
																							?>
																						</td>
																					</tr>
																						<?php
																					}
																					?>
																				</table>	
																			</td>
																		</tr>
																</table>	    
    </td>
  </tr>
</table>
</body>
</html>