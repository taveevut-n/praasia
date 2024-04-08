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
<?php  
$jquery_ui_v="1.8.5";  
$theme=array(  
    "0"=>"base",  
    "1"=>"black-tie",  
    "2"=>"blitzer",  
    "3"=>"cupertino",  
    "4"=>"dark-hive",  
    "5"=>"dot-luv",  
    "6"=>"eggplant",  
    "7"=>"excite-bike",  
    "8"=>"flick",  
    "9"=>"hot-sneaks",  
    "10"=>"humanity",  
    "11"=>"le-frog",  
    "12"=>"mint-choc",  
    "13"=>"overcast",  
    "14"=>"pepper-grinder",  
    "15"=>"redmond",  
    "16"=>"smoothness",  
    "17"=>"south-street",  
    "18"=>"start",  
    "19"=>"sunny",  
    "20"=>"swanky-purse",  
    "21"=>"trontastic",  
    "22"=>"ui-darkness",  
    "23"=>"ui-lightness",  
    "24"=>"vader"  
);  
$jquery_ui_theme=$theme[14];  
?>  
<link type="text/css" rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/<?=$jquery_ui_v?>/themes/<?=$jquery_ui_theme?>/jquery-ui.css" />  
<style type="text/css">    
.ui-datepicker{    
/*    width:150px;  */  
    font-family:tahoma;    
    font-size:11px;    
    text-align:center;    
}    
</style>  
</head>
<body bgcolor="#FFFFFF" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<!-- Save for Web Slices (???????.jpg) -->
				  <?php
	if($_POST['submit']){
		if($_POST['h_member_id']){		
			$q="UPDATE `member` SET `package` = '".$_POST['package']."',
			`username` = '".$_POST['username']."',
			`password` = '". md5(base64_encode(md5(md5($_POST['password']))))."',
			`name` = '".$_POST['name']."',
			`mobile` = '".$_POST['mobile']."',
			`email` = '".$_POST['email']."',
			`address` = '".$_POST['address']."',
			`expdate` = '".$_POST['expdate']."',			
			`description` = '".$_POST['description']."',
			`warranty` = '".$_POST['warranty']."' WHERE `id` ='".$_POST['h_member_id']."'  ";			
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
		    <td align="center" valign="top"><form method="post" id="form1">
                          <?php if($_GET['e_member_id']){ 

	$q="SELECT * FROM `member` WHERE id=".$_GET['e_member_id']." ";
	$db5= new nDB();
	$db5->query($q);
	$db5->next_record();
 } ?>
        <table width="98%" border="0" cellspacing="1" cellpadding="3">
		  <tr>
		    <td height="25" colspan="2" bgcolor="#551902">&nbsp;</td>
	      </tr>
		  <tr>
		    <td width="19%" height="25" align="right" bgcolor="#311308">Edit Package :</td>
		    <td width="81%" bgcolor="#311308"><select name="package" id="package">
		      <option value="1" selected>S Package (Limit 20 Pieces) 1000฿</option>
		      <option value="2">M Package (Limit 50 Pieces) 2500฿</option>
		      <option value="3">L Package (Unlimit) 3000฿</option>
		    </select></td>
	      </tr>
		  <tr>
		    <td height="25" align="right" bgcolor="#311308">Start Date :</td>
		    <td bgcolor="#311308"><?=date("d/m/Y",$db5->f(start))?></td>
	      </tr>
		  <tr>
		    <td height="25" align="right" bgcolor="#311308">Expire Date :</td>
		    <td bgcolor="#311308"><input name="expdate" type="text" id="expdate" value="<?=$db5->f(expdate)?>"></td>
	      </tr>                    
		  <tr>
		    <td height="25" colspan="2" align="right" bgcolor="#000000">&nbsp;</td>
	      </tr>
		  <tr>
		    <td height="25" colspan="2" bgcolor="#551902">個人資料 / Profile Owner Shop</td>
	      </tr>
		  <tr>
		    <td height="25" align="right" bgcolor="#311308">Username :</td>
		    <td bgcolor="#311308"><input name="username" type="text" id="username" size="40" value="<?=($_GET['e_member_id'])?$db5->f(username):""?>"></td>
	      </tr>
		  <tr>
		    <td height="25" align="right" bgcolor="#311308">Password :</td>
		    <td bgcolor="#311308"><input name="password" type="text" id="password"></td>
	      </tr>
		  <tr>
		    <td height="25" align="right" bgcolor="#311308">店主名稱 /  Name :</td>
		    <td bgcolor="#311308"><input name="name" type="text" id="name" size="40" value="<?=($_GET['e_member_id'])?$db5->f(name):""?>"></td>
	      </tr>
		  <tr>
		    <td height="25" align="right" bgcolor="#311308">電話 / Mobile :</td>
		    <td bgcolor="#311308"><input name="mobile" type="text" id="mobile" value="<?=($_GET['e_member_id'])?$db5->f(mobile):""?>"></td>
	      </tr>
		  <tr>
		    <td height="25" align="right" bgcolor="#311308">電子郵件 / E-mail :</td>
		    <td bgcolor="#311308"><input name="email" type="text" id="email" size="30" value="<?=($_GET['e_member_id'])?$db5->f(email):""?>"></td>
	      </tr>
		  <tr>
		    <td height="25" align="right" bgcolor="#311308">地址 / Address :</td>
		    <td bgcolor="#311308"><textarea name="address" cols="50" rows="5" id="address"><?=($_GET['e_member_id'])?$db5->f(address):""?></textarea></td>
	      </tr>
		  <tr>
		    <td height="25" colspan="2" align="right" bgcolor="#000000">&nbsp;</td>
	      </tr>
		  <tr>
		    <td height="25" colspan="2" bgcolor="#551902">Detail Shop</td>
	      </tr>
		  <tr>
		    <td height="25" align="right" bgcolor="#311308">店鋪名稱 / Name Shop :</td>
		    <td bgcolor="#311308"><?=($_GET['e_member_id'])?$db5->f(nameshop):""?></td>
	      </tr>
		  <tr>
		    <td height="25" align="right" bgcolor="#311308">Description :</td>
		    <td bgcolor="#311308"><textarea name="description" cols="50" rows="5" id="description"><?=($_GET['e_member_id'])?$db5->f(description):""?></textarea></td>
	      </tr>
		  <tr>
		    <td height="25" align="right" bgcolor="#311308">保證人資料 / Guarantee Information :</td>
		    <td bgcolor="#311308"><input name="warranty" type="text" id="warranty" value="<?=($_GET['e_member_id'])?$db5->f(warranty):""?>"></td>
	      </tr>
		  <tr>
		    <td height="25" colspan="2">&nbsp;</td>
	      </tr>                   
		  <tr>
		    <td height="25" colspan="2" align="center" bgcolor="#000000"><input name="submit" type="submit" id="Submit" value="Edit Profile Member">
                                                                    <?php if($_GET['e_member_id']){ ?>
                            <input name="h_member_id" type="hidden" id="h_member_id" value="<?=$db5->f(id)?>" />                
                            <?php } ?>
            </td>
	      </tr>
	    </table>
        </form></td>
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
<script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>  
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.5/jquery-ui.min.js"></script>  
<script type="text/javascript">
$(function(){
	$("#expdate").datepicker({  
        dateFormat: 'dd-mm-yy'
	});
});
</script>
</body>
</html>