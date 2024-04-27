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
<?php
						  	if ($_POST['search']) {
								$_SESSION['search_cert'] = $_POST['search'];
							}
?>
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
	if($_GET['d_data_id']){
		@unlink("../img/certificate/".$_GET['d_pic']);
		$q="DELETE FROM `cert` WHERE `cert_id` =".$_GET['d_data_id']." ";
		$db->query($q);				
	}
?>
                  <?php
	if($_GET['e_data_id']){
		$q="SELECT * FROM cert WHERE cert_id=".$_GET['e_data_id']." ";
		$db5=new nDB();
		$db5->query($q);
		$db5->next_record();
	}
?>				   <br />
				   <table width="700" border="0" align="center" cellpadding="0" cellspacing="3" bordercolor="#FFFFFF">
                          <tr class="bh">
                            <td width="12%" height="25" align="center" bgcolor="#4d1403" class="style11" >รูปภาพ</td>
                            <td width="23%" height="25" align="center" bgcolor="#4d1403" class="style11" >ขื่อพระ</td>
                            <td width="13%" height="25" align="center" bgcolor="#4d1403" class="style11" >เจ้าของ</td>
                            <td width="24%" height="25" align="center" bgcolor="#4d1403" class="style11" >ผลการตรวจ</td>
                            <td width="15%" height="25" align="center" bgcolor="#4d1403" class="style11" >สถานะการส่ง</td>                            
                            <td height="25" align="center" bgcolor="#4d1403" class="style11" >แก้ไข</td>
                            <td height="25" align="center" bgcolor="#4d1403" class="style11" >ลบ</td>
                            <td height="25" align="center" bgcolor="#4d1403" class="style11" >QR Code</td>
                          </tr>
						  <?php 
						  	$q="SELECT * FROM `cert` WHERE cert_amulet LIKE '%".$_SESSION['search_cert']."%' ORDER BY cert_id DESC";
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
                            <td height="110" align="center" bgcolor="#3c1204"><a href="../certificate.php?cert_code=<?=$db->f(cert_code)?>" target="_blank"><img src="../slir/w100-h100/img/certificate/<?=$db->f(pic1)?>" width="60" height="86" /></a></td>
                            <td align="center" style="color:#FC0; font-size:12px" bgcolor="#3c1204"><?=$db->f(cert_amulet)?>
                            <br />(<?=$db->f(cert_code)?>)</td>
                            <td align="center" bgcolor="#3c1204" style="color:#FC0; font-size:12px"><?=$db->f(cert_owner)?><br></td>
                            <td align="center" bgcolor="#3c1204" style="color:#FC0; font-size:12px">
							<? if ($db->f(cert_result)=='0') { ?>
                            <span style="color:#F90; font-size:12px">กำลังตรวจสอบ</span>
                            <? } ?>
							<? if ($db->f(cert_result)=='yes') { ?>
                            <span style="color:#0C0; font-size:12px">ผ่าน</span>
                            <? } ?>
							<? if ($db->f(cert_result)=='no') { ?>
                            <span style="color:#F00; font-size:12px">ไม่ผ่าน</span>
                            <? } ?>
							<? if ($db->f(cert_result)=='reject') { ?>
                            <span style="color:#09F; font-size:12px">ไม่ออกผล</span>
                            <? } ?>                                                                                    
                            </td>
                            <td align="center" bgcolor="#3c1204" style="color:#FC0; font-size:12px"><?=$db->f(cert_delivery)?></td>
                            <td width="6%" align="center" bgcolor="#3c1204"><a href="?e_data_id=<?=$db->f(cert_id)?>" ><img src="../images/edit.gif" alt="แก้ไข" width="19" height="23" border="0" /></a></td>
                            <td width="6%" align="center" bgcolor="#3c1204"><a href="?d_data_id=<?=$db->f(cert_id)?>"  onClick="return confirm('คุณแน่ใจที่จะลบหรือไม่ ?')"><img src="../images/del.gif" alt="แก้ไข" width="19" height="23" border="0" /></a></td>
                            <td width="7%" align="center" bgcolor="#3c1204"><a class='ajax' href="print_card.php?cert_id=<?=$db->f(cert_id)?>" style="color:#FFF" >เปิด</a></td>
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