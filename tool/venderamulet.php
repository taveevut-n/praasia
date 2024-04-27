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
	if($_GET['d_data_id']){
		@unlink("../img/findamulet/".$_GET['d_pic']);
		$q="DELETE FROM `findamulet` WHERE `amulet_id` =".$_GET['d_data_id']." ";
		$db->query($q);				
	}
?>

				   <br />
                   <?
						  if ($_GET['category_id']) { 
						  	$_SESSION['category_id'] = $_GET['category_id'];
						  }				   
							$q="SELECT * FROM `findamulet` WHERE amulet_id = '".$_SESSION['category_id']."' ";
							$db->query($q);
							$db->next_record();					  
				   ?>
				   <table width="700" border="0" align="center" cellpadding="0" cellspacing="3" bordercolor="#FFFFFF">
                          <tr>
                          	<td colspan="8" align="center" style="color:#FC0; font-size:14px">
                            	<?=$db->f(name)?>
                            </td>
                          </tr>
                          <tr>
                          	<td colspan="8">
                            <form method="post">
                            	<input type="text" name="q" placeholder="ค้นหาฐานข้อมูลพระเครื่อง" style="width:250px"/><input type="submit" value="ค้นหา" />
                            </form>    
                            </td>
                          </tr>
                          <tr>
                          	<td height="30" colspan="8" align="right">
                            	<input type="button" name="button2" id="button2" value="เพิ่มข้อมูลหมวดย่อย" onclick="window.location='add_venderamulet.php?category_id=<?=$_SESSION['category_id']?>'" style="cursor:pointer;" />
                            </td>
                     </tr>
                     <tr class="bh">
                            <td width="10%" height="25" align="center" bgcolor="#4d1403" class="style11" >รหัส</td>
                            <td width="10%" height="25" align="center" bgcolor="#4d1403" class="style11" >รูปภาพ</td>
                            <td width="30%" height="25" align="center" bgcolor="#4d1403" class="style11" >ขื่อพระ</td>
                            <td width="20%" height="25" align="center" bgcolor="#4d1403" class="style11" >รายละเอียด</td>
                            <td width="13%" height="25" align="center" bgcolor="#4d1403" class="style11" >ซื้อขายแล้ว</td>
                            <td width="9%" height="25" align="center" bgcolor="#4d1403" class="style11" >ดูลิงค์รวม</td>                            
                            <td height="25" align="center" bgcolor="#4d1403" class="style11" >Edit</td>
                            <td height="25" align="center" bgcolor="#4d1403" class="style11" >ลบ</td>
                          </tr>
						  <?php 
						  
						  
						  if ($_POST['q']=='') {
						  	$q="SELECT * FROM `findamulet` WHERE top_id = '".$_SESSION['category_id']."' ORDER BY amulet_id DESC";
						  } else {
							$q="SELECT * FROM `findamulet` WHERE top_id = '".$_SESSION['category_id']."' and name like '%".$_POST['q']."%' or amulet_id like '%".$_POST['q']."%' ORDER BY amulet_id DESC";
						  }
							$db->query($q);
							static $v=1;
							while($db->next_record()){
						  ?>
                          <tr bgcolor="<?=($v%2==0)?"#3c1204":"#3c1204"?>">
                            <td height="110" align="center" bgcolor="#3c1204" style="color:#FC0"><?=$db->f(amulet_id)?></td>
                            <td height="110" align="center" bgcolor="#3c1204"><img src="../slir/w100-h100/img/findamulet/<?=$db->f(pic)?>" width="60" height="86" /></td>
                            <td align="center" style="color:#FC0; font-size:12px" bgcolor="#3c1204"><?=$db->f(name)?></td>
                            <td align="center" bgcolor="#3c1204"><a href="view_vender.php?id=<?=$db->f(amulet_id)?>"  style="color:#FC0; font-size:12px">ข้อมูลผู้จัดหา</a></td>
							<td align="center" bgcolor="#3c1204"><a href="view_vender_ok.php?id=<?=$db->f(amulet_id)?>"><img src="images/view.gif" width="19" height="23" border="0" /></a></td>                            
							<td align="center" bgcolor="#3c1204"><a href="link_vender.php?id=<?=$db->f(amulet_id)?>"><img src="images/view.gif" width="19" height="23" border="0" /></a></td>                            
                            <td width="7%" align="center" bgcolor="#3c1204"><a href="add_venderamulet.php?e_data_id=<?=$db->f(amulet_id)?>" ><img src="../images/edit.gif" alt="แก้ไข" width="19" height="23" border="0" /></a></td>
                            <td width="11%" align="center" bgcolor="#3c1204"><a href="?d_data_id=<?=$db->f(amulet_id)?>" style="color:#FFF" onClick="return confirm('คุณต้องการลบข้อมูลใช่หรือไม่ ?')"><img src="../images/del.gif" alt="แก้ไข" width="19" height="23" border="0" /></a></td>
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