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
$mon_r=array("","Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec");
?>
			<?php
	if($_GET['no_id']){
		$q="update `member` set status='".$_GET['status']."' WHERE `id` =".$_GET['no_id']." ";
		$db->query($q);
		redi2();				
	}
?>	
			<?php
	if($_GET['hot_id']){
		$q="update `member` set hot='".$_GET['status']."' WHERE `id` =".$_GET['hot_id']." ";
		$db->query($q);
		redi2();				
	}
?>	
<?php
	if($_GET['d_member_id']){					
		$q="DELETE FROM `member` WHERE `id` = ".$_GET['d_member_id']." ";
		$db->query($q);
		$nameshop=$db->f(nameshop);	
		$q="DELETE FROM `product` WHERE `product_id` = '$nameshop' ";
		$db->query($q);			
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
		    <td align="center" valign="top"><table width="100%" border="0" cellspacing="1" cellpadding="3">
		  <tr>
          	<td colspan="9" align="right">
            <form name="form1" method="post" action="">
            <table width="300" border="0" cellspacing="0" cellpadding="0">
          	  <tr>
          	    <td width="242" align="right">Search Exp. Date
          	      <select name="mon" class="box_from3" id="mon">
                          <option value="">All Month</option>
                          <?php for($i=1;$i<=12;$i++){ ?>					  
                          <option value="<?=sprintf("%02d",$i)?>"
						<?php
							if($_POST['mon']==sprintf("%02d",$i)){
								echo 'selected="selected"';
							}
						?>
						><?=$mon_r[$i]?></option>
                          <?php } ?>
                        </select></td>
          	    <td width="46"><input name="Submit" type="submit" value="Go"></td>
          	    </tr>
        	  </table>
              </form>
              </td>
          </tr>
          <tr>
		    <td width="105" height="25" align="center" bgcolor="#4d1403">店主名稱</td>
		    <td width="159" align="center" bgcolor="#4d1403">店鋪名稱</td>
		    <td width="60" align="center" bgcolor="#4d1403">Date</td>
		    <td width="72" align="center" bgcolor="#4d1403">Exp. Date</td>            
		    <td width="82" align="center" bgcolor="#4d1403">狀況</td>
		    <td width="76" align="center" bgcolor="#4d1403"><strong> </strong>推荐商店</td>
		    <td width="47" align="center" bgcolor="#4d1403">銀行帳戶資料</td>            
		    <td width="49" align="center" bgcolor="#4d1403">編輯</td>            
		    <td width="54" align="center" bgcolor="#4d1403">刪除</td>
	      </tr>
          <?php
							$q="SELECT * FROM member WHERE 1 ";
							if($_POST['mon']!=''){
								$q.=" AND substr(expdate, 4, 2) ='".$_POST['mon']."' ";
							}
							$_SESSION['q_r']=$q;
							$db->query($q);
							$q.="ORDER BY id DESC";
							$db->query($q);							
							while($db->next_record()){
?>          
		  <tr>
		    <td height="25" align="left" bgcolor="#2a0a00"><a href="javascript:" class="mfont_3" onClick="window.open('view_member.php?member=<?=$db->f(id)?>','_blank','width=600,height=365,top=100,left=200,scrollbars=yes')"><?=$db->f(name)?></a></td>
		    <td height="25" align="left" bgcolor="#2a0a00"><?=$db->f(nameshop)?></td>
		    <td height="25" align="center" bgcolor="#2a0a00"><?=date("d/m/Y",$db->f(start))?></td>
		    <td width="72" align="center" bgcolor="#2a0a00"><?=$db->f(expdate)?></td>            
		    <td height="25" align="center" bgcolor="#2a0a00"><? if($db->f(status)=='0'){?>
                            <a href="?no_id=<?=$db->f(id)?>&status=1" ><img src="../images/stop.png" alt="Disable" width="24" height="24" border="0"></a>
								<? }?>
                                <? if($db->f(status)=='1'){?>
                                <a href="?no_id=<?=$db->f(id)?>&status=2" ><img src="../images/wait.png" alt="Pause" width="24" height="24" border="0"></a>
                              	<? }?>
                                <? if($db->f(status)=='2'){?>
                                <a href="?no_id=<?=$db->f(id)?>&status=0" ><img src="../images/play.png" alt="Enable" width="24" height="24" border="0"></a>
                              	<? }?>                                
            </td>
		    <td align="center" bgcolor="#2a0a00"><? if($db->f(hot)=='0'){?>
                            <a href="?hot_id=<?=$db->f(id)?>&status=1" ><img src="../images/wait.png" alt="No Hot" width="24" height="24" border="0"></a>
                                <? }else{?>
								<a href="?hot_id=<?=$db->f(id)?>&status=0" >
                              <img src="../images/ok.png" alt="Hot" width="16" height="16" border="0"></a>
            <? }?></td>
		    <td align="center" bgcolor="#2a0a00"><a href="bankinfo.php?e_member_id=<?=$db->f(id)?>"  ><img src="../images/edit.gif" width="19" height="23" border="0"></a></td>
		    <td align="center" bgcolor="#2a0a00">				                              <?php
					if($_SESSION['adminid']==1){ 
					?>   <a href="edit_member.php?e_member_id=<?=$db->f(id)?>"  ><img src="../images/edit.gif" width="19" height="23" border="0"></a><?php } ?></td>
		    <td align="center" bgcolor="#2a0a00">				                              <?php
					if($_SESSION['adminid']==1){ 
					?>   <a href="?d_member_id=<?=$db->f(id)?>"  onClick="return confirm('Confirm Delete Data')"><img src="../images/del.gif" width="19" height="23" border="0"></a><?php } ?></td>
	      </tr>
          <?php } ?>
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