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
<? if ($_GET['id']) {
	$_SESSION['amulet_id'] = $_GET['id'];
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
			if($_GET['buy_id']){
				$q="update `vender_amulet` set type='".$_GET['buy_id']."' WHERE `vender_id` =".$_GET['vender_id']." ";
				$db->query($q);
				//redi2("product.php?s_page=".$_GET['s_page']);				
				echo "<script>window.location.href='view_vender.php';</script>";
			}
			?>	        		
<?php 
	if($_POST['Submit']){
		
		if($_POST['h_data_id']==''){		
			
				$q="INSERT INTO `vender_link` ( `link_id` ,  `amulet_id` , `link`) 	
				VALUES ('', '".$_SESSION['amulet_id']."', '".$_POST['link']."');";
				$db->query($q);
		al('Add Complete');
		redi4('link_vender.php');
		}else{
				$q="UPDATE `vender_link` SET  
					`link` = '".$_POST['link']."' WHERE `link_id` =".$_POST['h_data_id']." ";
					$db->query($q);
		al('Edit Complete');
		redi4('link_vender.php');									
		}			
	}
?>
<?php
	if($_GET['d_data_id']){
		$q="DELETE FROM `vender_link` WHERE link_id =".$_GET['d_data_id']." ";
		$db->query($q);				
	}
?>
                  <?php
	if($_GET['e_data_id']){
		$q="SELECT * FROM `vender_link` WHERE link_id =".$_GET['e_data_id']." ";
		$db5=new nDB();
		$db5->query($q);
		$db5->next_record();
	}
?>
							<?
							$q="SELECT * FROM `findamulet` WHERE amulet_id = '".$_SESSION['amulet_id']."' ";
							$dbamulet=new nDB();
							$dbamulet->query($q);
							$dbamulet->next_record();
							?>    
<form action="" method="post" enctype="multipart/form-data" name="form1" id="form1" target="frm">
                    <table width="95%" border="0" align="center" cellpadding="0" cellspacing="2" class="box_from3_2">
                            <tr>
                              <td height="25" colspan="2" align="center" bgcolor="#4d1403" class="bh">เพิ่ม Link สำหรับหาข้อมูลพระ : <?=$dbamulet->f(name)?></td>
                      </tr> 
							 <tr>
                              <td width="20%" height="31" align="right" bgcolor="#3c1204" class="sidemenu"  style="padding-right:3px">Link</td>
                              <td width="80%" bgcolor="#3c1204"><input name="link" type="text" class="box_from3" id="link" value="<?=($_GET['e_data_id'])?$db5->f(link):""?>" size="80" /></td>
                      </tr>                                                                                                                                                                                                                          
                            <tr>
                              <td bgcolor="#3c1204">&nbsp;</td>
                              <td bgcolor="#3c1204"><input name="Submit" type="submit" class="button_add" value="<?=($_GET['e_data_id'])?"แก้ไขข้อมูล":"เพิ่มข้อมูล"?>" />
                                  <?php if($_GET['e_data_id']){ ?>
                                  <input name="h_data_id" type="hidden" id="h_data_id" value="<?=$db5->f(link_id)?>" />                                 								  
                              <?php } ?>                              </td>
                      </tr>
                    </table>
                  </form>
				<iframe name="frm" width="1" height="1" frameborder="0"></iframe>			
                <br />
				<script language="javascript">
					function selec(){
						var ab=document.getElementById('se');
						location.href=ab.value;
					}
				</script>                
				   <table width="700" border="0" align="center" cellpadding="0" cellspacing="3" bordercolor="#FFFFFF">
                   		<tr>
                        	<td align="right" colspan="6">
                            	<select name="search_type"  onChange="selec();" id="se">
                                	<option value="?search_type=2">เลือกการค้นหา</option>
                                    <option value="?search_type=2">เลือกทั้งหมด</option>
                                    <option value="?search_type='0'">ยังไม่ซื้อขาย</option>
                                    <option value="?search_type=1">ซื้อขายแล้ว</option>
                                </select>
                            </td>
                        </tr>
                   
							<?
							$q="SELECT * FROM `findamulet` WHERE amulet_id = '".$_SESSION['amulet_id']."' ";
							$dbamulet=new nDB();
							$dbamulet->query($q);
							$dbamulet->next_record();
							?>                   
                         <tr class="bh">
                            <td height="25" align="center" bgcolor="#000000" class="style11" colspan="3" > Link จัดหาพระเครื่อง:<?=$dbamulet->f(name)?></td>
                     </tr> 
                          <tr class="bh">
                            <td width="80%" height="25" align="center" bgcolor="#4d1403" class="style11" >Link</td>
                            <td height="25" align="center" bgcolor="#4d1403" class="style11" >แก้ไข</td>
                            <td height="25" align="center" bgcolor="#4d1403" class="style11" >ลบ</td>
                          </tr>
						  <?php 	
							$q="SELECT * FROM `vender_link` WHERE amulet_id = '".$_SESSION['amulet_id']."' order by link_id ";
							$db->query($q);
							static $v=1;
							while($db->next_record()){
						  ?>
                          <tr bgcolor="<?=($v%2==0)?"#3c1204":"#3c1204"?>" >
                            <td height="30" align="center" bgcolor="#3c1204" style="color:#FC0; font-size:12px; border-bottom:1px solid #FC0">
                                <table width="100%" border="0" cellspacing="0" cellpadding="3">
                                  <tr>
                                  	<td width="8%" align="center"><?=$v?></td>
                                    <td width="92%" colspan="2"><a href="<?=$db->f(link)?>" style="color:#FC0" target="_blank"><?=$db->f(link)?></a></td>
                                  </tr>
                                </table>
                            </td>
                            
                            <td width="11%" align="center" bgcolor="#3c1204" style="border-bottom:1px solid #FC0"><a href="?e_data_id=<?=$db->f(link_id)?>" ><img src="../images/edit.gif" alt="แก้ไข" width="19" height="23" border="0" /></a></td>
                            <td width="9%" align="center" bgcolor="#3c1204" style="border-bottom:1px solid #FC0"><a href="?d_data_id=<?=$db->f(link_id)?>" onClick="return confirm('คุณแน่ใจที่จะลบหรือไม่ ?')"><img src="../images/del.gif" alt="แก้ไข" width="19" height="23" border="0" /></a></td>
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