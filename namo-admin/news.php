<?php include("../global.php"); ?>

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
		    <td valign="top">
<?php
	if($_GET['d_news_id']){
		@unlink("../img/news/".$_GET['pic']);
		$q="DELETE FROM `news` WHERE `news_id` =".$_GET['d_news_id']." ";
		$db->query($q);
	}
?>

<?php
if($_POST['Submit']){
	if($_POST['h_news_id']){
		$q="UPDATE `news` SET `news_topic` = '".$_POST['news_topic']."',
`news_detail` = '".$_POST['news_detail']."' WHERE `news_id` =".$_POST['h_news_id']." ";
		$db->query($q);
		if($_FILES['file']['name']!=''){
			@unlink("../img/news/".$_POST['h_pic']);
			upimg($_FILES['file'],"../img/news/");			
			$q="UPDATE `news` SET `news_img` = '".$file_up."' WHERE `news_id` =".$_POST['h_news_id']."  ";			
			$db->query($q);		
		}		
		al('Edit News Complete');
		redi2();
	} //end	 if($_POST['h_id']){
	else{
		upimg($_FILES['file'],"../img/news/");
		$q="INSERT INTO `news` ( `news_id` , `news_topic` , `news_detail`) 
VALUES (
'', '".$_POST['news_topic']."', '".$_POST['news_detail']."'
);";
		$db->query($q);
		al('Add News Complete');
		redi2();
	}
}	
?>
<?php if($_GET['e_news_id']){ 

	$q="SELECT * FROM `news` WHERE news_id=".$_GET['e_news_id']." ";
	$db5= new nDB();
	$db5->query($q);
	$db5->next_record();
 } ?>		
                  
            <form action="" method="post" enctype="multipart/form-data" name="form1" id="form1">
                    <br />
                    <table width="95%" border="0" align="center" cellpadding="0" cellspacing="1" >
                      <tr>
                        <td height="25" colspan="2" align="center" bgcolor="#4d1403" class="style11" >消息</td>
                      </tr>
                      <tr>
                        <td colspan="2" align="center" bgcolor="#3c1204"><span class="style11">Topic</span><br />
                            <input name="news_topic" type="text"  id="news_topic" size="50" value="<?=($_GET['e_news_id'])?$db5->f(news_topic):""?>" /></td>
                      </tr>
                      <tr>
                        <td colspan="2" align="center" bgcolor="#3c1204"><span class="style11"><br />
                          Detail</span><br />
                          <textarea name="news_detail" cols="50" rows="7" id="news_detail"><?=($_GET['e_news_id'])?$db5->f(news_detail):""?>
                          </textarea></td>
                      </tr>
                      <tr>
                        <td height="35" colspan="2" align="center" bgcolor="#3c1204">
						<input name="Submit" type="submit" class="button_add"  value="<?=($_GET['e_news_id'])?"Edit":"Add"?>" />
                            <input name="h_news_id" type="hidden" id="h_news_id" value="<?=($_GET['e_news_id'])?$db5->f(news_id):""?>" /></td>
                      </tr>
                      <tr>
                        <td width="47%" bgcolor="#3c1204">&nbsp;</td>
                        <td width="53%" bgcolor="#3c1204">&nbsp;</td>
                      </tr>
                    </table>
              </form><br>
<table width="95%" border="0" align="center" cellpadding="0" cellspacing="1">
              <tr>
                <td height="25" align="center" bgcolor="#4d1403" >消息</td>
                <td align="center" bgcolor="#4d1403" >編輯</td>
                <td align="center" bgcolor="#4d1403" >刪除</td>
              </tr>
			  <?php
			  	$q="SELECT * FROM `news` WHERE 1";
				$db->query($q);
				while($db->next_record()){
			   ?>
              <tr>
                <td height="25" bgcolor="#3c1204"  style="padding-left:3px"><?=$db->f(news_topic)?></td>
                <td width="8%" align="center" bgcolor="#3c1204" ><a href="?e_news_id=<?=$db->f(news_id)?>"><img src="../images/edit.gif" alt="แก้ไข" width="19" height="23" border="0" /></a></td>
                <td width="8%" align="center" bgcolor="#3c1204" ><a href="?d_news_id=<?=$db->f(news_id)?>" onClick="return confirm('ยืนยันการลบข้อมูล')"><img src="../images/del.gif" alt="ลบ" width="19" height="23" border="0" /></a></td>
              </tr>
			  <?php } ?>
            </table>
            </td>
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