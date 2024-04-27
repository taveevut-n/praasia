<? include('../global.php')?>
<?php if($_SESSION['adminid']=='' || !isset($_SESSION['adminid'])) {  
        redi4("login.php");
} ?>
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
    <td bgcolor="#311407"><table width="100%" border="0" cellspacing="3" cellpadding="0">
      <tr>
        <td width="250" valign="top" ><? include('sidemenu.php') ?></td>
        <td valign="top" bgcolor="#3f1d0e">				
<?php 
	if($_POST['Submit']){
		if($_POST['h_data_id']==''){
				upimg2($_FILES['file'],"../img/certificate/");	
				$q="INSERT INTO `cert` ( `cert_id` , `cert_amulet` , `cert_skin` , `cert_year` , `cert_province` , `cert_detail` , `cert_owner` , `cert_result` , `cert_pic`) 	
				VALUES (	'', '".$_POST['cert_amulet']."' , '".$_POST['cert_skin']."' , '".$_POST['cert_year']."' , '".$_POST['cert_province']."' , '".$_POST['cert_detail']."' , '".$_POST['cert_owner']."' , '".$_POST['cert_result']."' , '".$file_up2."');";
				$db->query($q);
		al('Add Complete');
		redi2();
		}else{
				if ($_POST['cert_result']=='yes') {
				$q="SELECT * FROM cert where cert_result = 'yes' order by cert_id desc ";
				$recent=new nDB();
				$recent->query($q);
				$recent->next_record();	
				$lastcert = $recent->f(cert_code)+1;	
				$datecert = date("Ymd");
				$code = $datecert.'-'.$lastcert;				
				}
				$q="UPDATE `cert` SET `cert_amulet` = '".$_POST['cert_amulet']."' ,
				`cert_code` = '".$code."' ,
				`cert_skin` = '".$_POST['cert_skin']."' ,
				`cert_year` = '".$_POST['cert_year']."' ,
				`cert_province` = '".$_POST['cert_province']."' ,
				`cert_detail` = '".$_POST['cert_detail']."' ,
				`cert_owner` = '".$_POST['cert_owner']."' ,
				`cert_amulet` = '".$_POST['cert_amulet']."' ,
				`cert_result` = '".$_POST['cert_result']."' WHERE `cert_id` =".$_POST['h_data_id']." ";
				$db->query($q);
				if($_FILES['file']['name']!=''){
					@unlink("../img/certificate/".$_POST['h_pic']);
					upimg2($_FILES['file'],"../img/certificate/");		
					$q="UPDATE `cert` SET `cert_pic` = '".$file_up2."' WHERE `cert_id` =".$_POST['h_data_id']." ";
					$db->query($q);
				}
	al('Edit Complete');
	redi2();							
		}			
	}
?>
<?php
	if($_GET['d_data_id']){
		@unlink("../img/certificate/".$_GET['d_pic']);
		$q="DELETE FROM `cert` WHERE `cert_id` =".$_GET['d_data_id']." ";
		$db->query($q);				
	}
?>
    <table width="700" border="0" align="center" cellpadding="0" cellspacing="3" bordercolor="#FFFFFF">
    					  <tr>
                          	<td align="right" colspan="3">
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
                          <tr class="bh">
                            <td width="20%" height="25" align="center" bgcolor="#4d1403" class="style11" >รูปภาพ</td>
                            <td width="23%" height="25" align="center" bgcolor="#4d1403" class="style11" >ขื่อพระ</td>
                            <td width="26%" height="25" align="center" bgcolor="#4d1403" class="style11" >รายละเอียด</td>
                            <td width="31%" height="25" align="center" bgcolor="#4d1403" class="style11" ><a href="add_referee.php?amulet_id=<?=$db->f(datacert_id)?>" style="color:#FC0" >เพิ่มที่ปรึกษา</a></td>
                          </tr>
						  <?php 
						  	$q="SELECT * FROM `datacert` WHERE 1 ORDER BY datacert_id DESC";
							$db->query($q);
							static $v=1;
							while($db->next_record()){
								
						  	$q="SELECT * FROM `member` WHERE id = '".$db->f(mem_id)."' ";
							$dbmember=new nDB();
							$dbmember->query($q);
							$dbmember->next_record();
							if ($db->f(mem_id)=='0') {
								$by = 'admin' ;
							} else {
							$by = $dbmember->f(username);
							}
						  ?>
                          <tr bgcolor="<?=($v%2==0)?"#3c1204":"#3c1204"?>">
                            <td height="110" align="center" bgcolor="#3c1204"><a href="view_content_certificate.php?certificate_id=<?=$db->f(datacert_id)?>" target="_blank"><img src="../slir/w100-h100/img/datacertificate/<?=$db->f(datacert_pic)?>" width="60" height="86" /></a></td>
                            <td align="center" style="color:#FC0; font-size:12px" bgcolor="#3c1204"><?=$db->f(datacert_amulet)?></td>
                            <td align="center" bgcolor="#3c1204"><a href="view_datacert.php?id=<?=$db->f(datacert_id)?>"  style="color:#FC0; font-size:12px">อ่านรายละเอียด</a></td>
                            <td align="center" bgcolor="#3c1204"><a href="add_referee.php?amulet_id=<?=$db->f(datacert_id)?>" style="color:#FC0" >++เพิ่มที่ปรึกษา++</a></td>
                     </tr>
						  <?php $v++; } ?>
      </table>
</td>      
        </tr>
    </table></td>
  </tr>
</table>
</body>
</html>