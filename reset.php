<?php include("global.php"); ?>
<?php
if($_GET['id'] and $_GET['active']!='ODg='){
		redi4('index.php');
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>ศูนย์รวมพระเครื่องออนไลน์</title>
<META name=description content="ศนย์พระเครื่อง เปิดร้านพระออนไลน์" >
<meta name="keywords" content="ศูนย์พระเครื่องภาคใต้, ศูนย์พระเครื่องภาคเหนือ, ศูนย์พระเครื่องกรุงเทพ, ศูนย์พระเครื่องอีสาน"/>
<link rel="icon" href="/favicon.ico" type="image/x-icon" />
<?php include("index.css"); ?>
</head>

<body>
<?php
if($_POST['reset']){
		$q="UPDATE `member` SET `password` ='". md5(base64_encode(md5(md5($_POST['amuletpass']))))."' WHERE `id` =".$_GET['id']." ";
	$db->query($q);
	al('คุณได้เปลี่ยนรหัสผ่านใหม่เรียบร้อยแล้ว');
	redi4('index.php');
}
?>
<table width="1000" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td><? include('head.php') ?></td>
  </tr>
	<tr>
		<td>
		<table width="100%" border="0" cellspacing="0" cellpadding="0">	
          <tr>
		    <td style="background:url(images/bg.jpg) repeat-y; padding-left:5px">
			  <table width="60%" border="0" align="center" cellpadding="0" cellspacing="0">
		      <tr>
		        <td height="25" align="center" bgcolor="#451502"><span class="detail-text">กรอกรหัสผ่านใหม่ของคุณ</span></td>
	          </tr>
		      <tr>
		        <td>
                <form  method="post" id="form1" target="p_wb">
                <table width="100%" border="0" cellspacing="0" cellpadding="3">
		          <tr>
		            <td align="right" bgcolor="#451502"><span style="color:#FFF">รหัสผ่าน</span></td>
		            <td bgcolor="#451502"><input name="amuletpass" type="text" id="amuletpass"></td>
		            </tr>
		          <tr>
		            <td bgcolor="#451502">&nbsp;</td>
		            <td bgcolor="#451502"><input name="reset" type="submit" id="reset" value="ยืนยันรหัสผ่านใหม่"></td>
		            </tr>
                    <iframe src="" name="p_wb" width="0px" height="0px" frameborder="0" id="p_wb"></iframe>
	            </table>
                </form>
                </td>
	          </tr>
		      </table>
            </td>
	      </tr>
          <tr>
            <td height="30" align="center" bgcolor="#000000" ><?php  sh_page($total,$s_page,$e_page,$chk_page,Previous,Next,"#999999","#FFCC00"); // นำไปวางในตำแหน่งที่ต้องการแสดง ?>;</td>
          </tr>                  
	    </table>
        </td>
	</tr>
	<tr>
	  <td><img src="images/footer.jpg" width="1000" height="136" /></td>
  </tr>   
</table>
</body>
</html>
