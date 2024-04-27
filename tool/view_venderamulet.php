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
<? if ($_GET['amulet_id']) {
	$_SESSION['amulet_id'] = $_GET['amulet_id'];
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
	if($_POST['Submit']){
		if ($_POST['username']) {
		$q = "SELECT * FROM `member`where username = '".$_POST['username']."'  ";
		$db->query($q);
		$db->next_record();	 	
		$numrow_username = $db->num_rows();
			if ($numrow_username == '0') {
				al('Username นี้ไม่มีในระบบ');
				exit;
			}		
		}
		
		
		if($_POST['h_data_id']==''){		
			
				$q="INSERT INTO `referee` ( `referee_id` ,  `amulet_id` , `username`, `name`, `tel`, `remark`, `url`) 	
				VALUES (	'', '".$_SESSION['amulet_id']."', '".$_POST['username']."', '".$_POST['name']."', '".$_POST['tel']."', '".$_POST['remark']."', '".$_POST['url']."');";
				$db->query($q);					
					for($mf=1;$mf<=5;$mf++){
							$upf[$mf] = uppic($_FILES['pic'.$mf],$mf,"../img/referee_pic/",$_POST['h_pic'.$mf]); // Same folder
							if($upf[$mf]!=''){
								$q = "SELECT * FROM `referee`ORDER BY referee_id DESC";
								$db->query($q);
								$db->next_record();	 
								$mem_id=$db->f(referee_id);
								$q = "UPDATE `referee` SET `pic$mf` = '".$upf[$mf]."' WHERE `referee_id` =".$mem_id." ";
								$db->query($q);
							}
					}
		al('Add Complete');
		redi4('add_referee.php');
		}else{
				$q="UPDATE `referee` SET `username` = '".$_POST['username']."' ,
					`name` = '".$_POST['name']."' ,
					`tel` = '".$_POST['tel']."' ,
					`remark` = '".$_POST['remark']."',
					`url` = '".$_POST['url']."'  WHERE `referee_id` =".$_POST['h_data_id']." ";
					$db->query($q);
						for($mf=1;$mf<=5;$mf++){
							$upf[$mf] = uppic($_FILES['pic'.$mf],$mf,"../img/referee_pic/",$_POST['h_pic'.$mf]); // Same folder
							if($upf[$mf]!=''){
								$q = "UPDATE `referee` SET `pic$mf` = '".$upf[$mf]."' WHERE `referee_id` =".$_POST['h_data_id']." ";
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
		$q="DELETE FROM `referee` WHERE `referee_id` =".$_GET['d_data_id']." ";
		$db->query($q);				
	}
?>
                  <?php
	if($_GET['e_data_id']){
		$q="SELECT * FROM referee WHERE referee_id=".$_GET['e_data_id']." ";
		$db5=new nDB();
		$db5->query($q);
		$db5->next_record();
	}
?>
<form action="" method="post" enctype="multipart/form-data" name="form1" id="form1" target="frm">
                    <table width="95%" border="0" align="center" cellpadding="0" cellspacing="2" class="box_from3_2">
                            <tr>
                              <td height="25" colspan="2" align="center" bgcolor="#4d1403" class="bh">เพิ่มผู้จัดหาพระเครื่อง</td>
                      </tr>
							 <tr>
                              <td width="20%" height="31" align="right" bgcolor="#3c1204" class="sidemenu"  style="padding-right:3px">ชื่อผู้ติดต่อ</td>
                              <td width="80%" bgcolor="#3c1204"><input name="name" type="text" class="box_from3" id="name" value="<?=($_GET['e_data_id'])?$db5->f(name):""?>" size="80" /></td>
                      </tr>
							 <tr>
                              <td width="20%" height="31" align="right" bgcolor="#3c1204" class="sidemenu"  style="padding-right:3px">เบอร์โทรศัพท์</td>
                              <td width="80%" bgcolor="#3c1204"><input name="tel" type="text" class="box_from3" id="username" value="<?=($_GET['e_data_id'])?$db5->f(tel):""?>" size="80" /></td>
                              </tr>
							 <tr>
                              <td width="20%" height="31" align="right" bgcolor="#3c1204" class="sidemenu"  style="padding-right:3px">Line</td>
                              <td width="80%" bgcolor="#3c1204"><input name="line" type="text" class="box_from3" id="line" value="<?=($_GET['e_data_id'])?$db5->f(line):""?>" size="80" /></td>
                              </tr>
							 <tr>
                              <td width="20%" height="31" align="right" bgcolor="#3c1204" class="sidemenu"  style="padding-right:3px">Wechat</td>
                              <td width="80%" bgcolor="#3c1204"><input name="wechat" type="text" class="box_from3" id="wechat" value="<?=($_GET['e_data_id'])?$db5->f(wechat):""?>" size="80" /></td>
                      </tr> 
							 <tr>
                              <td width="20%" height="31" align="right" bgcolor="#3c1204" class="sidemenu"  style="padding-right:3px">Link 1</td>
                              <td width="80%" bgcolor="#3c1204"><input name="link1" type="text" class="box_from3" id="link1" value="<?=($_GET['e_data_id'])?$db5->f(link1):""?>" size="80" /></td>
                      </tr>
							 <tr>
                              <td width="20%" height="31" align="right" bgcolor="#3c1204" class="sidemenu"  style="padding-right:3px">Link 2</td>
                              <td width="80%" bgcolor="#3c1204"><input name="link2" type="text" class="box_from3" id="link2" value="<?=($_GET['e_data_id'])?$db5->f(link2):""?>" size="80" /></td>
                      </tr>                                                            
							 <tr>
                              <td width="20%" height="31" align="right" bgcolor="#3c1204" class="sidemenu"  style="padding-right:3px">บันทึกข้อความ</td>
                              <td width="80%" bgcolor="#3c1204"><textarea name="detail" class="box_from3" id="detail" style="height:100px; width:400px"><?=($_GET['e_data_id'])?$db5->f(detail):""?>
                              </textarea></td>
                      </tr>          
							 <tr>
                              <td width="20%" height="31" align="right" bgcolor="#3c1204" class="sidemenu"  style="padding-right:3px">Pic1</td>
                              <td width="80%" bgcolor="#3c1204"><input name="pic1" type="file" class="box_from3" id="pic1" value="" /></td>
                              </tr> 
							 <tr>
                              <td width="20%" height="31" align="right" bgcolor="#3c1204" class="sidemenu"  style="padding-right:3px">Pic2</td>
                              <td width="80%" bgcolor="#3c1204"><input name="pic2" type="file" class="box_from3" id="pic2" value="" /></td>
                              </tr>                                                             
							 <tr>
                              <td width="20%" height="31" align="right" bgcolor="#3c1204" class="sidemenu"  style="padding-right:3px">Pic3</td>
                              <td width="80%" bgcolor="#3c1204"><input name="pic3" type="file" class="box_from3" id="pic3" value="" /></td>
                              </tr> 
							 <tr>
                              <td width="20%" height="31" align="right" bgcolor="#3c1204" class="sidemenu"  style="padding-right:3px">Pic4</td>
                              <td width="80%" bgcolor="#3c1204"><input name="pic4" type="file" class="box_from3" id="pic4" value="" /></td>
                              </tr> 
							 <tr>
                              <td width="20%" height="31" align="right" bgcolor="#3c1204" class="sidemenu"  style="padding-right:3px">Pic5</td>
                              <td width="80%" bgcolor="#3c1204"><input name="pic5" type="file" class="box_from3" id="pic5" value="" /></td>
                              </tr>                                                                                                                                                                                                                          
                            <tr>
                              <td bgcolor="#3c1204">&nbsp;</td>
                              <td bgcolor="#3c1204"><input name="Submit" type="submit" class="button_add" value="<?=($_GET['e_data_id'])?"แก้ไขข้อมูล":"เพิ่มข้อมูล"?>" />
                                  <?php if($_GET['e_data_id']){ ?>
                                  <input name="h_data_id" type="hidden" id="h_data_id" value="<?=$db5->f(referee_id)?>" />
                                  <input name="h_pic1" type="hidden" id="h_pic1" value="<?=$db5->f(pic1)?>">
                                  <input name="h_pic2" type="hidden" id="h_pic2" value="<?=$db5->f(pic2)?>">
                                  <input name="h_pic3" type="hidden" id="h_pic3" value="<?=$db5->f(pic3)?>">
                                  <input name="h_pic4" type="hidden" id="h_pic4" value="<?=$db5->f(pic4)?>"> 
                                  <input name="h_pic4" type="hidden" id="h_pic4" value="<?=$db5->f(pic5)?>">                                     								  
                              <?php } ?>                              </td>
                      </tr>
                    </table>
                  </form>
				<iframe name="frm" width="1" height="1" frameborder="0"></iframe>				   <br />
				   <table width="700" border="0" align="center" cellpadding="0" cellspacing="3" bordercolor="#FFFFFF">
							<?
						  	$q="SELECT * FROM `findamulet` WHERE amulet_id = '".$_SESSION['amulet_id']."' ";
							$dbamulet=new nDB();
							$dbamulet->query($q);
							$dbamulet->next_record();
							?>                   
                         <tr class="bh">
                            <td height="25" align="center" bgcolor="#000000" class="style11" colspan="5" > ที่ปรึกษาการตรวจสอบพระ <?=$dbamulet->f(name)?></td>
                     </tr> 
                          <tr class="bh">
                            <td width="15%" bgcolor="#4d1403">&nbsp;</td>
                            <td width="68%" height="25" align="center" bgcolor="#4d1403" class="style11" >Username</td>
                            <td height="25" align="center" bgcolor="#4d1403" class="style11" >แก้ไข</td>
                            <td height="25" align="center" bgcolor="#4d1403" class="style11" >ลบ</td>
                            <td align="center" bgcolor="#4d1403" class="style11" >ดู</td>
                          </tr>
						  <?php 
						  	$q="SELECT * FROM `vender_amulet` WHERE amulet_id = '".$_SESSION['amulet_id']."' ORDER BY vender_id DESC";
							$db->query($q);
							static $v=1;
							while($db->next_record()){
						  ?>
                          <tr bgcolor="<?=($v%2==0)?"#3c1204":"#3c1204"?>">
                          	<td bgcolor="<?=($v%2==0)?"#3c1204":"#3c1204"?>">&nbsp;</td>
                            <td height="30" align="center" bgcolor="#3c1204" style="color:#FC0; font-size:12px">
							
                            <? if ($dbmember->f(username)=='') { ?>
                            <?=$db->f(name)?><br />Tel.<?=$db->f(tel)?>
                            <? } else {?>
                            <?=$dbmember->f(username)?>
                            <? } ?>
                            </td>
                            
                            <td width="9%" align="center" bgcolor="#3c1204"><a href="?e_data_id=<?=$db->f(referee_id)?>" ><img src="../images/del.gif" alt="แก้ไข" width="19" height="23" border="0" /></a></td>
                            <td width="8%" align="center" bgcolor="#3c1204"><a href="?d_data_id=<?=$db->f(referee_id)?>" ><img src="../images/del.gif" alt="แก้ไข" width="19" height="23" border="0" /></a></td>
                            <td width="8%" align="center" bgcolor="#3c1204"><a href="view_referee.php?id=<?=$db->f(referee_id)?>"><img src="../images/view-icon.png" /></a></td>
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