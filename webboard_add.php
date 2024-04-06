<?php include("global.php"); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>คลินิคตี๋ซ่อมพระ บริการซ่อมพระ พระเครื่อง</title>
<style type="text/css">
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
	background-color: #000;
	background-image: url(images/bg.jpg);
	background-attachment:fixed;
	background-position:top center;
}
</style>
<script src="Scripts/swfobject_modified.js" type="text/javascript"></script>
</head>

<body>
<table width="1000" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td><object id="FlashID" classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" width="1000" height="358">
      <param name="movie" value="images/tee.swf" />
      <param name="quality" value="high" />
      <param name="wmode" value="opaque" />
      <param name="swfversion" value="8.0.35.0" />
      <!-- This param tag prompts users with Flash Player 6.0 r65 and higher to download the latest version of Flash Player. Delete it if you don’t want users to see the prompt. -->
      <param name="expressinstall" value="Scripts/expressInstall.swf" />
      <!-- Next object tag is for non-IE browsers. So hide it from IE using IECC. -->
      <!--[if !IE]>-->
      <object type="application/x-shockwave-flash" data="images/tee.swf" width="1000" height="358">
        <!--<![endif]-->
        <param name="quality" value="high" />
        <param name="wmode" value="opaque" />
        <param name="swfversion" value="8.0.35.0" />
        <param name="expressinstall" value="Scripts/expressInstall.swf" />
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
    <td><img src="images/menu.jpg" width="1000" height="48" border="0" usemap="#Map" /></td>
  </tr>
  <tr>
<td align="left" valign="top" bgcolor="#000000"><form action="post.php" method="post" enctype="multipart/form-data" target="p_wb" name="form1"  id="form1" onsubmit="return chk_postboard();">
      <br />

        <table width="98%" border="0" align="center" cellpadding="0" cellspacing="5" class="hd_topic2" id="sh_post" style="border:2px outset;" bgcolor="#EFEFEF">
            <tr>
              <td colspan="2" align="right" style="color:#FF0000;font-weight:bold;"><input type="button" name="button2" id="button2" value="กลับไปหน้าเว็บบอร์ด" onclick="window.location='webboard.php'" style="cursor:pointer;" /></td>
              </tr>              
          <tr>
            <td align="right">หัวข้อ</td>
            <td width="784" ><input name="title_que" type="text" title="board_require" size="50" onchange="chk_sign()" />
            <span style="color:#FF0000;font-weight:bold;font-size:10px;">* จำเป็นต้องกรอก</span>            </td>
          </tr>
          <tr>
            <td align="right">ชื่อ</td>
            <td><input name="name" type="text"  title="board_require" value="<?=$_SESSION['user_zab']?>" size="35" onchange="chk_sign()" />
            <span style="color:#FF0000;font-weight:bold;font-size:10px;">* จำเป็นต้องกรอก</span>            </td>
          </tr>
          <tr>
            <td align="right">อีเมลล์</td>
            <td><input  name="board_email" type="text"   size="35" onchange="chk_sign()" />                      </td>
          </tr>
          <tr>
            <td colspan="2" align="center" valign="top">รายละเอียด</td>
            </tr>
          <tr>
            <td colspan="2" align="center" valign="top">
			<?php
				// Include CKEditor class.
				include_once "ckeditor/ckeditor.php";
				// The initial value to be displayed in the editor.
				// Create class instance.
				$CKEditor = new CKEditor();
				
				$CKEditor->config['width'] = 650;
				$CKEditor->config['height'] = 200;
				$CKEditor->config['skin'] = "v2";
				$CKEditor->basePath = 'ckeditor/';
				// Create textarea element and attach CKEditor to it.
				$CKEditor->editor("board_message","");
			?> 
<span style="color:#FF0000;font-weight:bold;font-size:10px;float:left;margin-left:50px;">* จำเป็นต้องกรอก</span>          </td>
            </tr>
            <tr>
              <td align="right">คำถาม</td>
              <td valign="top" style="height:25px;">
              <img id="inum1" title="<?=$_SESSION['ses_inum1']=rand(0,9)?>" src="images/digit/<?=$_SESSION['ses_inum1']?>.gif" />
 <img src="images/digit/plus.gif" /> 
<img id="inum2" title="<?=$_SESSION['ses_inum2']=rand(0,9)?>" src="images/digit/<?=$_SESSION['ses_inum2']?>.gif" />               
 <img src="images/digit/equal.gif" />
	<input name="inum3" type="text" id="inum3"  title="board_require" style="margin:0px;padding:0px;height:25px;border:1px #CCCCCC outset;background-color:#F5F5F5;color:#FF9900;font-size:20px;font-weight:bold;text-align:center;width:30px;" size="3" maxlength="2" />
   <span style="color:#FF0000;font-weight:bold;font-size:10px;">* จำเป็นต้องกรอก</span>    </td>
            </tr>    
            <tr>
            <td width="177" align="right">&nbsp;</td>
            <td valign="middle">
			<input name="Submit" type="submit"  value="ตั้งกระทู้ใหม่"  style="cursor:pointer;"  />
              <input name="Reset" type="reset" id="button" value="ล้างข้อความ" style="cursor:pointer;" /></td>
          </tr>

          </table>
      </form></td>
  </tr><iframe src="" name="p_wb" width="1px" height="0px" frameborder="0" id="p_wb"></iframe>
  <tr>
    <td bgcolor="#000000">&nbsp;</td>
  </tr>
</table>

<map name="Map" id="Map"><area shape="rect" coords="789,8,962,40" href="contactus.php" /><area shape="rect" coords="587,9,760,41" href="payment.php" /><area shape="rect" coords="386,9,559,41" href="order.php" /><area shape="rect" coords="196,9,369,41" href="about.php" />
  <area shape="rect" coords="16,9,189,41" href="index.php" />
</map>
<script type="text/javascript">
swfobject.registerObject("FlashID");
</script>
</body>
</html>
