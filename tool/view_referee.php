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
	if($_GET['id']){
		$q="SELECT * FROM referee WHERE referee_id=".$_GET['id']." ";
		$db5=new nDB();
		$db5->query($q);
		$db5->next_record();
	}
?>
    <table width="100%" border="0" cellspacing="0" cellpadding="5" style="color:#FC0">
      <tr>
        <td colspan="2" align="center">ดูข้อมูล</td>
        </tr>
      <tr>
        <td width="25%" align="right">ชื่อ :</td>
        <td width="75%"><?=$db5->f(name)?></td>
      </tr>
      <tr>
        <td align="right">เบอร์โทรศัพท์ :</td>
        <td><?=$db5->f(tel)?></td>
      </tr>
      <tr>
        <td align="right">URL :</td>
        <td><a href="<?=$db5->f(url)?>" target="_blank" style="color:#FC0"><?=$db5->f(url)?></a></td>
      </tr>
      <tr>
        <td align="right">บันทึกข้อความ :</td>
        <td><?=$db5->f(remark)?></td>
      </tr>
      <? if ($db5->f(pic1)!='') { ?>
      <tr>
        <td align="right">รูปภาพ 1 :</td>
        <td><img src="../img/referee_pic/<?=$db5->f(pic1)?>" /></td>
      </tr>
      <? } ?>
      <? if ($db5->f(pic2)!='') { ?>
      <tr>
        <td align="right">รูปภาพ 2 :</td>
        <td><img src="../img/referee_pic/<?=$db5->f(pic2)?>" /></td>
      </tr>
      <? } ?>
      <? if ($db5->f(pic3)!='') { ?>
      <tr>
        <td align="right">รูปภาพ 3 :</td>
        <td><img src="../img/referee_pic/<?=$db5->f(pic3)?>" /></td>
      </tr>
      <? } ?>
      <? if ($db5->f(pic4)!='') { ?>
      <tr>
        <td align="right">รูปภาพ 4 :</td>
        <td><img src="../img/referee_pic/<?=$db5->f(pic4)?>" /></td>
      </tr>
      <? } ?>
      <? if ($db5->f(pic5)!='') { ?>
      <tr>
        <td align="right">รูปภาพ 5 :</td>
        <td><img src="../img/referee_pic/<?=$db5->f(pic5)?>" /></td>
      </tr>
      <? } ?>
    </table>
                  </td>
      </tr>
    </table></td>
  </tr>
</table>
</body>
</html>