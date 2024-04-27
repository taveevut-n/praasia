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
				upimg2($_FILES['file'],"../img/datacertificate/");	
				$q="INSERT INTO `datacert` ( `datacert_id` , `datacert_catalog` , `datacert_amulet` , `datacert_detail`, `datacert_pic`) 	
				VALUES (	'', '".$_POST['datacert_catalog']."' , '".$_POST['datacert_amulet']."' , '".$_POST['datacert_detail']."' , '".$file_up2."');";
				$db->query($q);
		al('Add Complete');
		redi2();
		}else{
				$q="UPDATE `datacert` SET `datacert_amulet` = '".$_POST['datacert_amulet']."' ,
				`datacert_catalog` = '".$_POST['datacert_catalog']."' ,
				`datacert_detail` = '".$_POST['datacert_detail']."' WHERE `datacert_id` =".$_POST['h_data_id']." ";
				$db->query($q);
				if($_FILES['file']['name']!=''){
					@unlink("../img/datacertificate/".$_POST['h_pic']);
					upimg2($_FILES['file'],"../img/datacertificate/");		
					$q="UPDATE `datacert` SET `datacert_pic` = '".$file_up2."' WHERE `datacert_id` =".$_POST['h_data_id']." ";
					$db->query($q);
				}
	al('Edit Complete');
	redi2();							
		}			
	}
?>
<?php
	if($_GET['d_data_id']){
		@unlink("../img/datacertificate/".$_GET['d_pic']);
		$q="DELETE FROM `datacert` WHERE `datacert_id` =".$_GET['d_data_id']." ";
		$db->query($q);				
	}
?>
                  <?php
	if($_GET['e_data_id']){
		$q="SELECT * FROM datacert WHERE datacert_id=".$_GET['e_data_id']." ";
		$db5=new nDB();
		$db5->query($q);
		$db5->next_record();
	}
?>
<form action="" method="post" enctype="multipart/form-data" name="form1" id="form1">
                    <table width="95%" border="0" align="center" cellpadding="0" cellspacing="2" class="box_from3_2">
    					  <tr>
                          	<td align="right" colspan="2">
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
                              <td height="25" colspan="2" align="center" bgcolor="#4d1403" class="bh">จัดการข้อมูลพระที่รับรอง</td>
                      </tr>
							 <tr>
                              <td width="24%" align="right" bgcolor="#3c1204" class="sidemenu"  style="padding-right:3px">ชื่อพระ</td>
                              <td width="86%" bgcolor="#3c1204"><input name="datacert_amulet" type="text" class="box_from3" id="datacert_amulet" value="<?=($_GET['e_data_id'])?$db5->f(datacert_amulet):""?>" size="45" /></td>
                              </tr>  
							 <tr>
                              <td colspan="2" align="center" bgcolor="#3c1204" class="sidemenu"  style="padding-right:3px"><span class="sidemenu" style="padding-right:3px">รายละเอียด</span><br />                                
                               <textarea id="datacert_detail" name="datacert_detail"><?=($_GET['e_data_id'])?$db5->f(datacert_detail):"&nbsp;"?></textarea></td>
                              </tr>   
				<script>
					CKEDITOR.replace('datacert_detail',{
						filebrowserBrowseUrl : 'ckfinder/ckfinder.html',
						filebrowserImageBrowseUrl : 'ckfinder/ckfinder.html?type=Images',
						filebrowserFlashBrowseUrl : 'ckfinder/ckfinder.html?type=Flash',
						filebrowserUploadUrl : 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files&currentFolder=/userfile/',
						filebrowserImageUploadUrl : 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images&currentFolder=/userfile/',
						filebrowserFlashUploadUrl : 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash'
					});
				</script>                                                                                       
                      <tr>
                        <td align="right" valign="top" bgcolor="#3c1204" class="sidemenu" >รูปตัวอย่าง</td>
                        <td align="left" valign="top" bgcolor="#3c1204" class="sidemenu" >						
						<?php if($_GET['e_data_id']){ ?>
						<img src="../img/datacertificate/<?=$db5->f(datacert_pic)?>" width="60" height="86" />
						<br />						
						<?php } ?>
						รูปภาพ 
                          <input name="file" type="file"  /> 
                          กว้าง 169 x 241 pixel</td>
                      </tr>                            
                            <tr>
                              <td bgcolor="#3c1204">&nbsp;</td>
                              <td bgcolor="#3c1204"><input name="Submit" type="submit" class="button_add" value="<?=($_GET['e_data_id'])?"แก้ไขข้อมูล":"เพิ่มข้อมูล"?>" />
                                  <?php if($_GET['e_data_id']){ ?>
                                  <input name="h_data_id" type="hidden" id="h_data_id" value="<?=$db5->f(datacert_id)?>" />
               					  <input name="h_pic" type="hidden" id="h_pic" value="<?=$db5->f(datacert_pic)?>">								  
                              <?php } ?>                              </td>
                      </tr>
                    </table>
                  </form>

				   <br />
				   <table width="700" border="0" align="center" cellpadding="0" cellspacing="3" bordercolor="#FFFFFF">
                          <tr class="bh">
                            <td width="12%" height="25" align="center" bgcolor="#4d1403" class="style11" >รูปภาพ</td>
                            <td width="23%" height="25" align="center" bgcolor="#4d1403" class="style11" >ขื่อพระ</td>
                            <td width="13%" height="25" align="center" bgcolor="#4d1403" class="style11" >รายละเอียด</td>
                            <td height="25" align="center" bgcolor="#4d1403" class="style11" >Edit</td>
                            <td height="25" align="center" bgcolor="#4d1403" class="style11" >ลบ</td>
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
                            <td height="110" align="center" bgcolor="#3c1204"><img src="../slir/w100-h100/img/datacertificate/<?=$db->f(datacert_pic)?>" width="60" height="86" /></td>
                            <td align="center" style="color:#FC0; font-size:12px" bgcolor="#3c1204"><?=$db->f(datacert_amulet)?></td>
                            <td align="center" bgcolor="#3c1204"><a href="view_datacert.php?id=<?=$db->f(datacert_id)?>"  style="color:#FC0; font-size:12px">อ่านรายละเอียด</a></td>
                            <td width="6%" align="center" bgcolor="#3c1204"><a href="?e_data_id=<?=$db->f(datacert_id)?>" ><img src="../images/edit.gif" alt="แก้ไข" width="19" height="23" border="0" /></a></td>
                            <td width="7%" align="center" bgcolor="#3c1204"><a href="?d_data_id=<?=$db->f(datacert_id)?>" style="color:#FFF" ><img src="../images/del.gif" alt="แก้ไข" width="19" height="23" border="0" /></a></td>
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