<? include('../global.php');
	set_page($s_page,$e_page = 40);
?>
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
				   <table width="700" border="0" align="center" cellpadding="0" cellspacing="3" bordercolor="#FFFFFF">
                          <tr>
                          	<td height="35" colspan="5" align="center" style="color:#FC0; font-size:18px">
                            	หมวดพระหลัก
                            </td>
                     </tr>
                     <tr>
                          	<td colspan="5">
                            <form method="post">
                            	<input type="text" name="q" placeholder="ค้นหาฐานข้อมูลพระเครื่อง" style="width:250px"/><input type="submit" value="ค้นหา" />
                            </form>    
                            </td>
                          </tr>
                          <tr>
                          	<td height="30" colspan="5" align="right">
                            	<input type="button" name="button2" id="button2" value="เพิ่มข้อมูลหมวดหลัก" onclick="window.location='add_venderamulet_category.php'" style="cursor:pointer;" />
                            </td>
                     </tr>
                     <tr class="bh">
                            <td width="13%" height="25" align="center" bgcolor="#4d1403" class="style11" >รูปภาพ</td>
                            <td width="55%" height="25" align="center" bgcolor="#4d1403" class="style11" >ขื่อพระ</td>
                            <td height="25" align="center" bgcolor="#4d1403" class="style11" >Edit</td>
                            <td height="25" align="center" bgcolor="#4d1403" class="style11" >ลบ</td>
                          </tr>
						  <?php 
						  if ($_POST['q']=='') {
						  	$q="SELECT * FROM `findamulet` WHERE top_id = 0 ORDER BY amulet_id DESC ";
						  } else {
							$q="SELECT * FROM `findamulet` WHERE name like '%".$_POST['q']."%' and top_id = 0 ORDER BY amulet_id DESC";
						  }
							$db->query($q);
							$total=$db->num_rows();
							$q.="LIMIT $s_page,$e_page  ";
							static $v=1;
							while($db->next_record()){
						  ?>
                          <tr bgcolor="<?=($v%2==0)?"#3c1204":"#3c1204"?>">
                            <td height="110" align="center" bgcolor="#3c1204"><a href="venderamulet.php?category_id=<?=$db->f(amulet_id)?>"><img src="../slir/w100-h100/img/findamulet/<?=$db->f(pic)?>" width="60" height="86" /></a></td>
                            <td align="left" style="color:#FC0; font-size:12px" bgcolor="#3c1204"><a href="venderamulet.php?category_id=<?=$db->f(amulet_id)?>" style="color:#FC0"><?=$db->f(name)?></a></td>
                            <td width="9%" align="center" bgcolor="#3c1204"><a href="add_venderamulet.php?e_data_id=<?=$db->f(amulet_id)?>" ><img src="../images/edit.gif" alt="แก้ไข" width="19" height="23" border="0" /></a></td>
                            <td width="10%" align="center" bgcolor="#3c1204"><a href="?d_data_id=<?=$db->f(amulet_id)?>" style="color:#FFF" onClick="return confirm('คุณต้องการลบข้อมูลใช่หรือไม่ ?')"><img src="../images/del.gif" alt="แก้ไข" width="19" height="23" border="0" /></a></td>
                     </tr>
						  <?php $v++; } ?>
                          <tr>
                          	<td colspan="4" align="center">
                            	<?php  sh_page($total,$s_page,$e_page,$chk_page,Previous,Next,"#333333","#F8F8F8");?>
                            </td>
                          </tr>
      </table>                  
                  </td>
      </tr>
    </table></td>
  </tr>
</table>
</body>
</html>