<?php include("../global.php"); ?>
<?php include("ckpass.php"); ?>
<html>
<head>
<title>Namoputtaya.com :: Amulet Center in Asia</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<style type="text/css">
body {
	background-color: #000;
}
body,td,th {
	font-size: 12px;
	font-family: Arial, Helvetica, sans-serif;
	color: #FFF;
}
a:link {
	text-decoration: none;
	color: #FFF;
}
a:visited {
	text-decoration: none;
	color: #FFF;
}
a:hover {
	text-decoration: none;
	color: #FFF;
}
a:active {
	text-decoration: none;
	color: #FFF;
}
</style>
<script src="Scripts/swfobject_modified.js" type="text/javascript"></script>
</head>
<body bgcolor="#FFFFFF" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<!-- Save for Web Slices (???????.jpg) -->
				  <?php
	if($_POST['submit']){
		if($_POST['h_staff_id']){		
			$q="UPDATE `namostaff` SET `username` = '".$_POST['username']."',
			`password` = '". md5(base64_encode(md5(md5($_POST['password']))))."' WHERE `id` ='".$_POST['h_staff_id']."'  ";			
			$db->query($q);				
		al('Complete');
		redi4("main.php");		
		}
		}
?>
<table width="1000" border="0" align="center" cellpadding="0" cellspacing="0" id="Table_01">
	<tr>
    <td height="25" bgcolor="#311308">&nbsp;</td>
    </tr>
	<tr>
    <td><object id="FlashID" classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" width="1000" height="331">
      <param name="movie" value="../namoputtaya.swf">
      <param name="quality" value="high">
      <param name="wmode" value="opaque">
      <param name="swfversion" value="8.0.35.0">
      <!-- This param tag prompts users with Flash Player 6.0 r65 and higher to download the latest version of Flash Player. Delete it if you don’t want users to see the prompt. -->
      <param name="expressinstall" value="Scripts/expressInstall.swf">
      <!-- Next object tag is for non-IE browsers. So hide it from IE using IECC. -->
      <!--[if !IE]>-->
      <object type="application/x-shockwave-flash" data="../namoputtaya.swf" width="1000" height="331">
        <!--<![endif]-->
        <param name="quality" value="high">
        <param name="wmode" value="opaque">
        <param name="swfversion" value="8.0.35.0">
        <param name="expressinstall" value="Scripts/expressInstall.swf">
        <!-- The browser displays the following alternative content for users with Flash Player 6.0 and older. -->
        <div>
          <h4>Content on this page requires a newer version of Adobe Flash Player.</h4>
          <p><a href="http://www.adobe.com/go/getflashplayer"><img src="http://www.adobe.com/images/shared/download_buttons/get_flash_player.gif" alt="Get Adobe Flash player" width="112" height="33" /></a></p>
        </div>
        <!--[if !IE]>-->
      </object>
      <!--<![endif]-->
    </object></td>
    </tr>
<tr>
		<td height="45" style="background:url(../images/menu.jpg) no-repeat"><table width="570" border="0" align="center" cellpadding="0" cellspacing="0">
		  <tr>
		    <td width="60" align="center"><a href="index.php"><span style="color:#000; font-weight:bold">首頁</span></a></td>
		    <td width="70" align="center"><a href="shop.php"><span style="color:#000; font-weight:bold">网店</span></a></td>
		    <td width="95" height="25" align="center"><a href="http://www.namoputtaya.com/board/forum.php" target="_new"><span style="color:#000; font-weight:bold">进入论坛</span></a></td>
            <td width="2"><img src="../images/line-search.jpg" width="2" height="30"></td>
		    <td width="315" align="center">
            <table width="100%" border="0" cellspacing="0" cellpadding="3">
                        <form action="show_search.php" method="post" name="search" target="_parent" id="search">
		      <tr>
		        <td width="47%" align="right"><span style="color:#000; font-weight:bold">搜索佛牌圣物:</span></td>
		        <td width="34%" align="center"><input name="q" id="q" size="18"></td>
		        <td width="19%" align="center"><input name="search" type="submit" id="search" value="Search"></td>
	          </tr></form>
	        </table>
            
            </td>
	      </tr>
	    </table></td>
  </tr>
<tr>
		<td height="296" align="center" valign="top" style="padding:5px"><table width="980" border="0" cellspacing="0" cellpadding="3">
		  <tr>
		    <td width="200" valign="top"><table width="100%" border="0" align="center" cellpadding="3" cellspacing="0">
		      <tr>
		        <td height="25" align="center" bgcolor="#4d1403">Main Menu</td>
	          </tr>
		      <tr>
		        <td bgcolor="#4d1403"><table width="100%" border="0" cellspacing="1" cellpadding="3">
		          <tr>
		            <td height="25" bgcolor="#3c1204"><a href="main.php">- Member</a></td>
		            </tr>
				                              <?php
					if($_SESSION['adminid']==1){ 
					?>                    
		          <tr>
		            <td height="25" bgcolor="#3c1204"><a href="staff.php?id=2">- Staff</a></td>
		            </tr>
                    <?php } ?>
		          <tr>
		            <td height="25" bgcolor="#3c1204"><a href="about.php">- About us</a></td>
		            </tr>
		          <tr>
		            <td height="25" bgcolor="#3c1204"><a href="banner.php">- Banner</a></td>
		            </tr>                    
		          <tr>
		            <td height="25" bgcolor="#3c1204"><a href="news.php">- 消息 / News</a></td>
		            </tr>
		          <tr>
		            <td height="25" bgcolor="#3c1204"><a href="../logout.php">- 退出 / Logout</a></td>
		            </tr>
	            </table></td>
	          </tr>
	        </table></td>
		    <td valign="top"><table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
                  <tr>
                    <td>
				
<?php 
	if($_POST['Submit']){
		if($_POST['h_banner_id']==''){
				upimg2($_FILES['file'],"../img/banner/");		
				$q="INSERT INTO `banner` ( `banner_id` , `banner_url` , `banner_detail` , `banner_img` ) 	VALUES (	'', '".$_POST['banner_url']."' , '".$_POST['banner_detail']."' , '".$file_up2."');";
				$db->query($q);
		al('Add Complete');
		redi2();
		}else{
				$q="UPDATE `banner` SET `banner_url` = '".$_POST['banner_url']."' ,
				`banner_detail` = '".$_POST['banner_detail']."' WHERE `banner_id` =".$_POST['h_banner_id']." ";
				$db->query($q);
				if($_FILES['file']['name']!=''){
					@unlink("../img/banner/".$_POST['h_pic']);
					upimg2($_FILES['file'],"../img/banner/");		
					$q="UPDATE `banner` SET `banner_img` = '".$file_up2."' WHERE `banner_id` =".$_POST['h_banner_id']." ";
					$db->query($q);
				}
	al('Edit Complete');
	redi2();							
		}			
	}
?>
<?php
	if($_GET['d_banner_id']){
		@unlink("../upimg/banner/".$_GET['d_pic']);
		$q="DELETE FROM `banner` WHERE `banner_id` =".$_GET['d_banner_id']." ";
		$db->query($q);				
	}
?>
                  <?php
	if($_GET['e_banner_id']){
		$q="SELECT * FROM banner WHERE banner_id=".$_GET['e_banner_id']." ";
		$db5=new nDB();
		$db5->query($q);
		$db5->next_record();
	}
?>
<form action="" method="post" enctype="multipart/form-data" name="form1" id="form1">
                    <table width="100%" border="0" align="center" cellpadding="0" cellspacing="2" class="box_from3_2">
                            <tr>
                              <td height="25" colspan="2" align="center" bgcolor="#4d1403" class="best8">Banner</td>
                      </tr>
							 <tr>
                              <td width="14%" align="right" bgcolor="#3c1204"  style="padding-right:3px">URL</td>
                              <td width="86%" bgcolor="#3c1204"><input name="banner_url" type="text" class="box_from3" id="banner_url" value="<?=($_GET['e_banner_id'])?$db5->f(banner_url):""?>" size="45" /></td>
                      </tr>                          
							 <tr>
                              <td align="right" bgcolor="#3c1204"  style="padding-right:3px">Detail</td>
                              <td bgcolor="#3c1204"><? 
include_once ('editor_files/config.php');
include_once ('editor_files/editor_class.php');
if($_GET['e_banner_id']){
	$love=$db5->f(banner_detail);
}else{
	$love="";
}

txt_rich("banner_detail",$love,"save",600,400);  
?></td>
                      </tr>
                      <tr>
                        <td align="right" valign="top" bgcolor="#3c1204" class="style11" >Banner Pic</td>
                        <td align="center" valign="top" bgcolor="#3c1204" class="style11" >						<?php if($_GET['e_banner_id']){ ?>
						<img src="../img/banner/<?=$db5->f(banner_img)?>" width="274" height="100" />
						<br />						
						<?php } ?>
						รูปภาพ 
                          <input name="file" type="file"  /></td>
                      </tr>                            
                            <tr>
                              <td bgcolor="#3c1204">&nbsp;</td>
                              <td bgcolor="#3c1204"><input name="Submit" type="submit" class="button_add" value="<?=($_GET['e_banner_id'])?"แก้ไขข้อมูล":"เพิ่มข้อมูล"?>" />
                                  <?php if($_GET['e_banner_id']){ ?>
                                  <input name="h_banner_id" type="hidden" id="h_banner_id" value="<?=$db5->f(banner_id)?>" />
               					  <input name="h_pic" type="hidden" id="h_pic" value="<?=$db5->f(banner_img)?>">								  
                              <?php } ?>                              </td>
                      </tr>
                    </table>
                  </form>
				  
				   <table width="700" border="0" align="center" cellpadding="0" cellspacing="3" bordercolor="#FFFFFF">
                          <tr>
                            <td height="25" align="center" bgcolor="#4d1403" class="style11" >Banner</td>
                            <td height="25" align="center" bgcolor="#4d1403" class="style11" >Edit</td>
                            <td height="25" align="center" bgcolor="#4d1403" class="style11" >Delete</td>
                          </tr>
						  <?php 
						  	$q="SELECT * FROM `banner` WHERE 1 ORDER BY banner_id DESC";
							$db->query($q);
							static $v=1;
							while($db->next_record()){
						  ?>
                          <tr bgcolor="<?=($v%2==0)?"#F8F8F8":"#FFFFFF"?>">
                            <td height="110" align="left" bgcolor="#3c1204" style="padding-left:10px" ><img src="../slir/w274-h100-c4:1/img/banner/<?=$db->f(banner_img)?>" width="274" height="100" /></td>
                            <td width="8%" align="center" bgcolor="#3c1204"><a href="?e_banner_id=<?=$db->f(banner_id)?>" ><img src="../images/edit.gif" alt="แก้ไข" width="19" height="23" border="0" /></a></td>
                            <td width="8%" align="center" bgcolor="#3c1204" ><a href="?d_banner_id=<?=$db->f(banner_id)?>" onClick="return confirm('Confirm Delete?')" ><img src="../images/del.gif" alt="ลบ" width="19" height="23" border="0" /></a></td>
                     </tr>
						  <?php $v++; } ?>
      </table>

            
                </td>
                  </tr>
                </table></td>
	      </tr>
    </table></td>
	</tr>
	<tr>
	  <td><img src="../images/footer.jpg" width="1000" height="46"></td>
  </tr>
</table>
<!-- End Save for Web Slices --><script type="text/javascript">
swfobject.registerObject("FlashID");
</script>
</body>
</html>