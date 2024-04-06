<?php include("global.php"); ?>
<?php set_page($s_page,$e_page=100); //นำส่วนนี้ิไว้ด้านบน ?>
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
		        <td height="40" align="center" bgcolor="#451502"><span style="color:#FFF">กรุณากรอก Username และ E-mail ที่ใช้สมัคร ระบบจะส่งการตั้งค่ารหัสผ่านใหม่ให้กับคุณ<br />
	            系统请把您注册会员所用的password和E-mail填好，系统将会把新密码传给您		        </span></td>
	          </tr>
		      <tr>
		        <td>
                <form action="reset_password.php" method="post" id="form1" target="p_wb">
                <table width="100%" border="0" cellspacing="0" cellpadding="3">
		          <tr>
		            <td width="28%" align="right" bgcolor="#451502"><span style="color:#FFF">Username :</span></td>
		            <td width="72%" bgcolor="#451502"><input name="username" type="text" id="username"></td>
		            </tr>
		          <tr>
		            <td align="right" bgcolor="#451502"><span style="color:#FFF">E-mail</span></td>
		            <td bgcolor="#451502"><input name="email" type="text" id="email"></td>
		            </tr>
		          <tr>
		            <td bgcolor="#451502">&nbsp;</td>
		            <td bgcolor="#451502"><input name="submit" type="submit" id="submit" value="ยืนยันการตั้งค่ารหัสผ่านใหม่ / 确定新设置的密码"></td>
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
