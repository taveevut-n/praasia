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
<? if ($_GET['certdoc_id']) {
	$_SESSION['certdoc_id'] = $_GET['certdoc_id'];
}
?>
<table width="1000" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td><img src="/admin/images/head.jpg" width="1000" height="318" /></td>
  </tr>
  <tr>
    <td bgcolor="#311407"><table width="100%" border="0" cellspacing="3" cellpadding="0">
      <tr>
        <td width="250" valign="top" ><? include('sidemenu.php') ?></td>
        <td valign="top" bgcolor="#3f1d0e">				
<?php 
	if($_POST['Submit']){
		if($_POST['h_data_id']==''){		
			
				$q="INSERT INTO `cert` ( `cert_id` ,  `certdoc_id` , `cert_amulet` , `cert_skin` , `cert_year` , `cert_province` , `cert_detail` , `cert_owner` , `cert_result`, `cert_remark`) 	
				VALUES (	'', '".$_SESSION['certdoc_id']."', '".$_POST['cert_amulet']."' , '".$_POST['cert_skin']."' , '".$_POST['cert_year']."' , '".$_POST['cert_province']."' , '".$_POST['cert_detail']."' , '".$_POST['cert_owner']."' , '".$_POST['cert_result']."' , '".$_POST['cert_remark']."' );";
				$db->query($q);
					for($mf=1;$mf<=4;$mf++){
						$upf[$mf] = uppic($_FILES['file'.$mf],$mf,"../img/certificate/",$_POST['h_pic'.$mf]); // Same folder
						if($upf[$mf]!=''){
							$q = "SELECT * FROM `cert`ORDER BY cert_id DESC";
							$db->query($q);
							$db->next_record();	 
							$cert_id=$db->f(cert_id);
							$q = "UPDATE `cert` SET `pic$mf` = '".$upf[$mf]."' WHERE `cert_id` =".$cert_id." ";
							$db->query($q);
						}
					}	

				if ($_POST['cert_result']=='yes') {
				$q="SELECT * FROM cert where 1 order by cert_id desc limit 1 ";
				$lastcert=new nDB();
				$lastcert->query($q);
				$lastcert->next_record();

				$q="SELECT * FROM cert where 1 order by cert_no desc limit 1 ";
				$lastcode=new nDB();
				$lastcode->query($q);
				$lastcode->next_record();
				$lastcode = $lastcode->f(cert_no)+1;
				$q="UPDATE `cert` SET `cert_no` = '".$lastcode."' WHERE `cert_id` =".$lastcert->f(cert_id)." ";
				$db->query($q);
					
				$convert_cert = sprintf("%02d",$lastcode);
				$datecert = date("dmY");
				$code = $convert_cert.$datecert;
				$q="UPDATE `cert` SET `cert_code` = '".$code."' WHERE `cert_id` =".$lastcert->f(cert_id)." ";
				$db->query($q);
				}									
				
		al('Add Complete');
		redi2();
		}else{
			
			if ($_POST['past_result']!='yes') {
			
				if ($_POST['cert_result']=='yes') {
				$q="SELECT * FROM cert where 1 order by cert_no desc limit 1 ";
				$last=new nDB();
				$last->query($q);
				$last->next_record();
				$last = $last->f(cert_no)+1;
				$q="UPDATE `cert` SET `cert_no` = '".$last."' WHERE `cert_id` =".$_POST['h_data_id']." ";
				$db->query($q);
					
				$convert_cert = sprintf("%02d",$last);
				$datecert = date("dmY");
				$code = $convert_cert.$datecert;
				$q="UPDATE `cert` SET `cert_code` = '".$code."' WHERE `cert_id` =".$_POST['h_data_id']." ";
				$db->query($q);
				}
				
			}
				$q="UPDATE `cert` SET `cert_amulet` = '".$_POST['cert_amulet']."' ,
				
				`cert_skin` = '".$_POST['cert_skin']."' ,
				`cert_year` = '".$_POST['cert_year']."' ,
				`cert_province` = '".$_POST['cert_province']."' ,
				`cert_detail` = '".$_POST['cert_detail']."' ,
				`cert_owner` = '".$_POST['cert_owner']."' ,
				`cert_remark` = '".$_POST['cert_remark']."' ,
				`cert_amulet` = '".$_POST['cert_amulet']."' ,
				`cert_result` = '".$_POST['cert_result']."' WHERE `cert_id` =".$_POST['h_data_id']." ";
				$db->query($q);
					for($mf=1;$mf<=4;$mf++){
						$upf[$mf] = uppic($_FILES['file'.$mf],$mf,"../img/certificate/",$_POST['h_pic'.$mf]); // Same folder
						if($upf[$mf]!=''){
							$q = "SELECT * FROM `cert`ORDER BY cert_id DESC";
							$db->query($q);
							$db->next_record();	 
							$cert_id=$db->f(cert_id);
							$q = "UPDATE `cert` SET `pic$mf` = '".$upf[$mf]."' WHERE `cert_id` =".$cert_id." ";
							$db->query($q);
						}
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


				   <br />
<table width="98%" border="0" align="center" cellpadding="0" cellspacing="3" bordercolor="#FFFFFF">
                          <tr class="bh">
                            <td width="18%" height="25" align="center" bgcolor="#4d1403" class="style11" >รูปภาพ</td>
                            <td width="29%" height="25" align="center" bgcolor="#4d1403" class="style11" >ขื่อพระ</td>
                            <td width="30%" height="25" align="center" bgcolor="#4d1403" class="style11" >ผลการตรวจ</td>
                            <td height="25" align="center" bgcolor="#4d1403" class="style11" >แก้ไข</td>
                            <td height="25" align="center" bgcolor="#4d1403" class="style11" >ลบ</td>
                          </tr>
						  <?php 
						  	$q="SELECT * FROM `content_certificate` WHERE mem_id = '".$_SESSION['adminshop_id']."' ORDER BY content_id DESC";
							$db->query($q);
							static $v=1;
							while($db->next_record()){
						  ?>
                          <tr bgcolor="<?=($v%2==0)?"#3c1204":"#3c1204"?>">
                            <td height="110" align="center" bgcolor="#3c1204"><img src="../slir/w100-h100/img/content_certificate/<?=$db->f(pic2)?>" width="60" height="86" /></td>
                            <td align="center" style="color:#FC0; font-size:12px" bgcolor="#3c1204"><?=$db->f(name)?></td>
                            <td align="center" bgcolor="#3c1204" style="color:#FC0; font-size:12px">
							<? if ($db->f(status)=='0') { ?>
                            <span style="color:#F90; font-size:12px">กำลังตรวจสอบ</span>
                            <? } ?>
							<? if ($db->f(status)=='1') { ?>
                            <span style="color:#0C0; font-size:12px">ผ่าน</span>
                            <? } ?>
							<? if ($db->f(status)=='2') { ?>
                            <span style="color:#F00; font-size:12px">ไม่ผ่าน</span>  
                            <? } ?>                                                                                 
                            </td>
                            <td width="12%" align="center" bgcolor="#3c1204"><a href="content_referee.php?e_data_id=<?=$db->f(content_id)?>" ><img src="../images/edit.gif" alt="แก้ไข" width="19" height="23" border="0" /></a></td>
                            <td width="11%" align="center" bgcolor="#3c1204"><a href="?d_data_id=<?=$db->f(content_id)?>" ><img src="../images/del.gif" alt="แก้ไข" width="19" height="23" border="0" /></a></td>
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
