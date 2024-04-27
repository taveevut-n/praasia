<?php include("../global.php"); ?>
<?php include("ck_pass.php"); ?>
<? $_GET['head']="ระบบจัดการเว็บไซต์&nbsp;&nbsp;   >> จัดการข่าวประชาสัมพันธ์ ";?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/main_temp.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>ADMINISTRATOR PANEL V.2</title>
<!-- InstanceEndEditable -->
<link type="text/css" href="zabi_css.css" rel="stylesheet" />
<script language="javascript">
	function my_me(obj){
		var me=document.getElementById(obj);
		if(me.style.display=='block'){
			me.style.display='none';		
		}else{
			me.style.display='block';
		}
	}
</script>
<script language="javascript">
function con_out(){
		if(confirm('ยืนยันการออกจากระบบ?')==true){
			window.open('out.php','_parent');
		}else{
			return false;
		}
	}
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
</script>
<!-- InstanceBeginEditable name="head" --><!-- InstanceEndEditable -->
<style type="text/css">
<!--
.style1 {color: #FFFFFF}
body {
	background-color: #E6E3E3;
}
-->
</style></head>

<body onload="MM_preloadImages('images/menu/home2.jpg','images/menu/manual2.jpg','images/menu/preview2.jpg','images/menu/feedback2.jpg','images/menu/logout2.jpg')">
<table width="983" border="0" align="center" cellpadding="0" cellspacing="0">
 <tr>
 <td width="983"><img src="http://www.thaiwebeasy.com/images/ads-twe.jpg" width="984" height="37" /></td>
 </tr>
  <tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="216" bgcolor="D6DFF7"><img src="images/menu/menu-l.jpg" width="216" height="43" /></td>
        <td width="132"><a href="main.php" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image33','','images/menu/home2.jpg',1)"><img src="images/menu/home.jpg" name="Image33" width="132" height="43" border="0" id="Image33" /></a></td>
        <td width="150"><a href="http://www.thaiwebeasy.com/help" target="_blank" onmouseover="MM_swapImage('Image34','','images/menu/manual2.jpg',1)" onmouseout="MM_swapImgRestore()"><img src="images/menu/manual.jpg" name="Image34" width="150" height="43" border="0" id="Image34" /></a></td>
        <td width="159"><a href="../" target="_blank" onmouseover="MM_swapImage('Image35','','images/menu/preview2.jpg',1)" onmouseout="MM_swapImgRestore()"><img src="images/menu/preview.jpg" name="Image35" width="159" height="43" border="0" id="Image35" /></a></td>
        <td width="317"><a href="http://www.thaiwebeasy.com/livechat/chat.php" target="_blank" onmouseover="MM_swapImage('Image36','','images/menu/feedback2.jpg',1)" onmouseout="MM_swapImgRestore()"><img src="images/menu/feedback.jpg" name="Image36" width="178" height="43" border="0" id="Image36" /></a></td>
        <td width="10"><a href="#" onClick="con_out()" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image37','','images/menu/logout2.jpg',1)"><img src="images/menu/logout.jpg" name="Image37" width="149" height="43" border="0" id="Image37" /></a></td>
        </tr>
        <tr>
        <td colspan="6" bgcolor="#6E89DD" height="8"></td>
        </tr>
    </table></td>
  </tr>
  <tr>
    <td align="left" valign="top"><table width="984" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="197" height="833" align="left" valign="top" bgcolor="D6DFF7" style="background:url(images/bg-l.jpg) top center #62AAD0 repeat-x"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td><img src="images/main.jpg" width="191" height="54" /></td>
          </tr>
          <tr>
            <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td style="background:url(images/hd-blog.png) no-repeat; padding-left:8px; color:#F5821F; font-weight:bold" height="32"><img src="images/Control_Panel.png" width="20" height="20" />ตั้งค่าทั่วไป</td>
              </tr>
              <tr>
                <td style="background:url(images/bg-blog.png) repeat-y; padding-left:5px"><table width="186" border="0" cellspacing="0" cellpadding="3">
                  <tr>
                    <td height="20" bgcolor="#ACDAF1"><a href="setting.php"><span style="color:#1A4A74">- ตั้งค่ารูปแบบเว็บไซต์</span></a></td>
                  </tr>
                  <tr>
                    <td height="20"><span style="color:#AAAAAA">- ตั้งค่ารูปแบบธีมเว็บไซต์</span></td>
                  </tr>
                  <tr>
                    <td height="20" bgcolor="#ACDAF1"><a href="settingmeta.php"><span style="color:#1A4A74">- ตั้งค่าคำอธิบายเว็บไซต์  (meta)</span></a></td>
                  </tr>
                  <tr>
                    <td height="20"> <a href="admin_intro.php"><span style="color:#1A4A74">-จัดการหน้าต้อนรับ (intro)</span></a></td>
                  </tr>
                  <tr>
                    <td height="20" bgcolor="#ACDAF1"><a href="admin_std.php"><span style="color:#1A4A74">- ตั้งค่าคำสำคัญ</span></a></td>
                  </tr>
                </table></td>
              </tr>
              <tr>
                <td><img src="images/bt-blog.png" width="198" height="19" /></td>
              </tr>
            </table></td>
          </tr>
          <tr>
            <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td style="background:url(images/hd-blog.png) no-repeat; padding-left:8px; color:#F5821F; font-weight:bold" height="32"><img src="images/Display1.png" width="20" height="20" />จัดการรูปแบบ</td>
              </tr>
              <tr>
                <td style="background:url(images/bg-blog.png) repeat-y; padding-left:5px"><table width="186" border="0" cellspacing="0" cellpadding="3">
                  <tr>
                    <td height="20"><a href="admin_mod.php"><span style="color:#1A4A74">- จัดวางรูปแบบหน้าแรก</span></a></td>
                  </tr>
                  <tr>
                    <td height="20" bgcolor="#ACDAF1"><a href="modify_contentpage.php?e_dmod_id=1"><span style="color:#1A4A74">- จัดวางรูปแบบหน้าใน</span></a></td>
                  </tr>
                  <tr>
                    <td height="20"><a href="admin_footer.php"> <span style="color:#1A4A74">-จัดการข้อมูลด้านล่าง (footer)</span></a></td>
                  </tr>
                </table></td>
              </tr>
              <tr>
                <td><img src="images/bt-blog.png" width="198" height="19" /></td>
              </tr>
            </table></td>
          </tr>
          <tr>
            <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td style="background:url(images/hd-blog.png) no-repeat; padding-left:8px; color:#F5821F; font-weight:bold" height="32"><img src="images/RefreshCL.png" width="20" height="20" />จัดการเมนู</td>
              </tr>
              <tr>
                <td style="background:url(images/bg-blog.png) repeat-y; padding-left:5px"><table width="186" border="0" cellspacing="0" cellpadding="3">
                  <tr>
                    <td height="20"><a href="admin_content_menu.php"><span style="color:#1A4A74">- จัดการเมนูหลักด้านบน                                                                                               </span></a></td>
                  </tr>
                  <tr>
                    <td height="20" bgcolor="#ACDAF1"><a href="admin_sidemenu.php"><span style="color:#1A4A74">- จัดการเมนูหลักด้านข้าง</span></a></td>
                  </tr>
                </table></td>
              </tr>
              <tr>
                <td><img src="images/bt-blog.png" width="198" height="19" /></td>
              </tr>
            </table></td>
          </tr>
          <tr>
            <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td style="background:url(images/hd-blog.png) no-repeat; padding-left:8px; color:#F5821F; font-weight:bold" height="32"><img src="images/Display2.png" width="20" height="20" />จัดการบทความ</td>
              </tr>
              <tr>
                <td style="background:url(images/bg-blog.png) repeat-y; padding-left:5px"><table width="186" border="0" cellspacing="0" cellpadding="3">
                  <tr>
                    <td height="20"><a href="admin_cat_article.php"><span style="color:#1A4A74">- เพิ่ม ลบ แก้ไข หมวดหมู่บทความ</span></a></td>
                  </tr>
                  <tr>
                    <td height="20" bgcolor="#ACDAF1"><a href="admin_article.php"><span style="color:#1A4A74">- เพิ่ม ลบ แก้ไข บทความ</span></a></td>
                  </tr>
                </table></td>
              </tr>
              <tr>
                <td><img src="images/bt-blog.png" width="198" height="19" /></td>
              </tr>
            </table></td>
          </tr>
<tr>
            <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td style="background:url(images/hd-blog.png) no-repeat; padding-left:8px; color:#F5821F; font-weight:bold" height="32"><img src="images/Security_Reader2.png" width="20" height="20" />จัดการผู้ใช้</td>
              </tr>
              <tr>
                <td style="background:url(images/bg-blog.png) repeat-y; padding-left:5px"><table width="186" border="0" cellspacing="0" cellpadding="3">
                  <tr>
                    <td height="20"><a href="admin_setting.php"><span style="color:#1A4A74">- จัดการรายชื่อผู้ใช้</span></a></td>
                  </tr>
                  <tr>
                    <td height="20" bgcolor="#ACDAF1"><a href="admin_system.php"><span style="color:#1A4A74">- กำหนดสิทธิ์ผู้ดูแลระบบ</span></a></td>
                  </tr>
                  <tr>
                    <td height="20"><a href="admin_chkpage.php"><span style="color:#1A4A74">- กำหนดสิทธิการเข้าหน้าเว็บ</span></a></td>
                  </tr>                  
                </table></td>
              </tr>
              <tr>
                <td><img src="images/bt-blog.png" width="198" height="19" /></td>
              </tr>
            </table></td>
          </tr>          
          <tr>
            <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td style="background:url(images/hd-blog.png) no-repeat; padding-left:8px; color:#F5821F; font-weight:bold" height="32"><img src="images/Games1.png" width="20" height="20" />จัดการเนื้อหา</td>
              </tr>
              <tr>
                <td style="background:url(images/bg-blog.png) repeat-y; padding-left:5px"><table width="186" border="0" cellspacing="0" cellpadding="3">
                  <tr>
                    <td height="20"><a href="admin_front.php"><span style="color:#1A4A74">- ระบบข้อความต้อนรับ</span></a></td>
                  </tr>
                  <tr>
                    <td height="20" bgcolor="#ACDAF1"> <a href="admin_news.php"><span style="color:#1A4A74">- ระบบข่าวประชาสัมพันธ์</span></a></td>
                  </tr>          
                  <tr>
                    <td height="20" > <a href="admin_service.php"><span style="color:#1A4A74">- ระบบข่าวประชาสัมพันธ์ 2</span></a></td>
                  </tr>                                                     
                  <tr>
                    <td height="20"> <a href="admin_catalog.php"><span style="color:#1A4A74">- ระบบร้านค้า</span></a></td>
                  </tr>
                  <tr>
                    <td height="20" bgcolor="#ACDAF1"><a href="gallery.php"><span style="color:#1A4A74">- ระบบอัลบั้มรูป</span></a></td>
                  </tr>
                  <tr>
                    <td height="20"><a href="admin_webboard.php"><span style="color:#1A4A74">- ระบบเว็บบอร์ด</span></a></td>
                  </tr>              
                  <tr>
                    <td height="20" bgcolor="#ACDAF1"><a href="admin_poll.php"><span style="color:#1A4A74">- ระบบแบบสำรวจ</span></a></td>
                  </tr>              
                  <tr>
                    <td height="20"><a href="member.php"><span style="color:#1A4A74">- ระบบสมาชิก</span></a></td>
                  </tr>              
                  <tr>
                    <td height="20" bgcolor="#ACDAF1"><a href="admin_banner.php"><span style="color:#1A4A74">- ระบบแบนเนอร์</span></a></td>
                  </tr>              
                  <tr>
                    <td height="20"><a href="admin_contact.php"><span style="color:#1A4A74">- ระบบติดต่อเรา</span></a></td>
                  </tr>     

                  <tr>
                    <td height="20" bgcolor="#ACDAF1"><a href="admin_weblink.php"><span style="color:#1A4A74">- ระบบเว็บลิงค์</span></a></td>
                  </tr>   
                  <tr>
                    <td height="20" ><a href="admin_download_type.php"><span style="color:#1A4A74">- ระบบดาวน์โหลด</span></a></td>
                  </tr> 
                  <tr>
                    <td height="20" bgcolor="#ACDAF1"><a href="admin_calendar_clock.php"><span style="color:#1A4A74">- ระบบแทรกโค้ดอิสระด้านข้าง</span></a></td>
                  </tr>
                  <tr>
                    <td height="20"><a href="admin_content.php"><span style="color:#1A4A74">- ระบบสร้างหน้าเพจใหม่</span></a></td>
                  </tr>                  
                  <tr>
                    <td height="20" bgcolor="#ACDAF1"><a href="admin_faq.php"><span style="color:#1A4A74">- ระบบคำถามที่ถามบ่อย (FAQ)</span></a></td>
                  </tr>                                                                                                                                                                                                       
                </table></td>
              </tr>
              <tr>
                <td><img src="images/bt-blog.png" width="198" height="19" /></td>
              </tr>
            </table></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td>&nbsp;</td>
          </tr>
        </table></td>
        <td width="788" align="left" valign="top"><table width="780" height="833" border="0" align="right" cellpadding="0" cellspacing="0">
          <tr>
            <td height="833" align="left" valign="top" bgcolor="#E2E8F6"><table width="780" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td><table width="780" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td width="610"><img src="images/home_08.gif" width="38" height="43" align="absmiddle" /><?=$_GET['head'];?> </td>
                      <td width="170">ไอพีของคุณ: <?=$_SERVER['REMOTE_ADDR']?></td>
                    </tr> 
                  </table></td>
              </tr>
              <tr>
                <td height="180" align="left" bgcolor="#FFFFFF"><img src="images/amateur-steps.jpg" width="778" height="165" /></td>
              </tr>
              
              <tr>
                <td height="640" valign="top" bgcolor="#FFFFFF"><!-- InstanceBeginEditable name="my_body" -->
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
	<!--Innova Editor-->
	<script type="text/javascript" src="/manage/editor_files/innovaeditor/scripts/innovaeditor.js"></script>

<script type="text/javascript">
    function chk(){   
		var fty=new Array(".gif",".jpg",".jpeg",".png"); // ประเภทไฟล์ที่อนุญาตให้อัพโหลด   
        var a=document.form1.file.value; //กำหนดค่าของไฟล์ใหกับตัวแปร a   
		var permiss=0; // เงื่อนไขไฟล์อนุญาต
		a=a.toLowerCase();    
		if(a !=""){
			for(i=0;i<fty.length;i++){ // วน Loop ตรวจสอบไฟล์ที่อนุญาต   
				if(a.lastIndexOf(fty[i])>=0){  // เงื่อนไขไฟล์ที่อนุญาต   
					permiss=1;
					break;
				}else{
					continue;
				}
			}  
			if(permiss==0){ 
				alert("อัพโหลดได้เฉพาะไฟล์ gif jpg jpeg png");     
				return false;   			
			} 		
		}        
    }   
</script>                              
				<table width="750" border="0" align="center" cellspacing="3" style="border:1px #B4DAFD solid">
                    <tr>
                      <td bgcolor="A6CBED" style="padding-left:5px">จัดการข่าวประชาสัมพันธ์</td>
                    </tr>
                    <tr>
                      <td bgcolor="F1F7FC" style="padding-left:5px">&#3612;&#3641;&#3657;&#3604;&#3641;&#3649;&#3621;&#3619;&#3632;&#3610;&#3610;&#3626;&#3634;&#3617;&#3634;&#3619;&#3606;&#3607;&#3635;&#3585;&#3634;&#3619;&#3648;&#3614;&#3636;&#3656;&#3617;และแก้ไข ข่าวประชาสัมพันธ์ได้</td>
                    </tr>
                  </table>
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
`news_s_detail` = '".$_POST['news_s_detail']."',
`news_f_detail` = '".$_POST['news_f_detail']."',
`news_date` = '".time()."',
`flag` = '".$_POST['flag']."' WHERE `news_id` =".$_POST['h_news_id']." ";
		$db->query($q);
		if($_FILES['file']['name']!=''){
			@unlink("../img/news/".$_POST['h_pic']);
			upimg($_FILES['file'],"../img/news/");			
			$q="UPDATE `news` SET `news_img` = '".$file_up."' WHERE `news_id` =".$_POST['h_news_id']."  ";			
			$db->query($q);		
		}		
		al('แก้ไขข่าวเรียบร้อยแล้ว');
		redi2();
	} //end	 if($_POST['h_id']){
	else{
		upimg($_FILES['file'],"../img/news/");
		$q="INSERT INTO `news` ( `news_id` , `news_topic` , `news_s_detail` , `news_f_detail` , `news_img` , `news_date`  ) 
VALUES (
'', '".$_POST['news_topic']."', '".$_POST['news_s_detail']."', '".$_POST['news_f_detail']."', '".$file_up."', '".time()."'
);";
		$db->query($q);
		al('เพิ่มข่าวสารเรียบร้อยแล้ว');
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
                  
                  <br />
                  <form action="" method="post" enctype="multipart/form-data" name="form1" id="form1" onsubmit="return chk();">
                    <br />
                    <table width="95%" border="0" align="center" cellpadding="0" cellspacing="0" >
                      <tr>
                        <td colspan="2" align="center" bgcolor="#A6CBED" >เพิ่มข่าวประชาสัมพันธ์</td>
                      </tr>
                      <tr>
                        <td colspan="2" align="center" bgcolor="#F1F7FC">หัวข้อ<br />
                            <input name="news_topic" type="text"  id="news_topic" size="50" value="<?=($_GET['e_news_id'])?$db5->f(news_topic):""?>" /></td>
                      </tr>
                      <tr>
                        <td colspan="2" align="center" bgcolor="#F1F7FC">รายละเอียดอย่างย่อ<br />

                            <textarea id="editor1" name="news_s_detail"><?php if($_GET['e_news_id'] != ""){ echo $db5->f(news_s_detail);}?></textarea>
                            <script type="text/javascript">
                                            var oEdit1 = new InnovaEditor("oEdit1");
                                            oEdit1.width = 650;
                                            oEdit1.height = 200;
										/*Enable Custom File Browser */
										oEdit1.fileBrowser = "/manage/editor_files/innovaeditor/assetmanager/asset.php";												
                                            oEdit1.groups = [
                                                ["group1", "", ["FontName", "FontSize", "Superscript", "ForeColor", "BackColor", "FontDialog", "BRK", "Bold", "Italic", "Underline", "Strikethrough", "TextDialog", "Styles", "RemoveFormat"]],
                                                ["group2", "", ["JustifyLeft", "JustifyCenter", "JustifyRight", "Paragraph", "BRK", "Bullets", "Numbering", "Indent", "Outdent"]],
                                                ["group3", "", ["TableDialog", "Emoticons", "FlashDialog", "BRK", "LinkDialog", "ImageDialog", "YoutubeDialog"]],
                                                ["group4", "", ["InternalLink", "CharsDialog", "Line", "BRK", "CustomObject", "CustomTag", "MyCustomButton"]],
                                                ["group5", "", ["SearchDialog", "SourceDialog", "BRK", "Undo", "Redo", "FullScreen"]]
                                            ];
                                            oEdit1.REPLACE("editor1");
                            </script>
                         </td>
                      </tr>
                      <tr>
                        <td colspan="2" align="center" bgcolor="#F1F7FC">รายละเอียดทั้งหมด<br />
                           <textarea id="editor2" name="news_f_detail"><?php if($_GET['e_news_id'] != ""){ echo $db5->f(news_f_detail);}?></textarea>
							<script type="text/javascript">
                                            var oEdit2 = new InnovaEditor("oEdit2");
                                            oEdit2.width = 650;
                                            oEdit2.height = 400;
										/*Enable Custom File Browser */
										oEdit2.fileBrowser = "/manage/editor_files/innovaeditor/assetmanager/asset.php";											
                                            oEdit2.groups = [
                                                ["group1", "", ["FontName", "FontSize", "Superscript", "ForeColor", "BackColor", "FontDialog", "BRK", "Bold", "Italic", "Underline", "Strikethrough", "TextDialog", "Styles", "RemoveFormat"]],
                                                ["group2", "", ["JustifyLeft", "JustifyCenter", "JustifyRight", "Paragraph", "BRK", "Bullets", "Numbering", "Indent", "Outdent"]],
                                                ["group3", "", ["TableDialog", "Emoticons", "FlashDialog", "BRK", "LinkDialog", "ImageDialog", "YoutubeDialog"]],
                                                ["group4", "", ["InternalLink", "CharsDialog", "Line", "BRK", "CustomObject", "CustomTag", "MyCustomButton"]],
                                                ["group5", "", ["SearchDialog", "SourceDialog", "BRK", "Undo", "Redo", "FullScreen"]]
                                            ];
                                            oEdit2.REPLACE("editor2");
                            </script>
                        </td>
                      </tr>
                      <tr>
                        <td colspan="2" align="center" bgcolor="#F1F7FC">รูปภาพ
                          <input name="file" type="file"  />
                            <strong>ขนาดกว้าง x สูง</strong> 76 x 62 pixels </td>
                      </tr>
                      <tr>
                        <td height="35" colspan="2" align="center" bgcolor="#F1F7FC">
						<input name="Submit" type="submit" class="button_add"  value="<?=($_GET['e_news_id'])?"แก้ไขข่าว":"เพิ่มข่าว"?>" />
                            <input name="h_news_id" type="hidden" id="h_news_id" value="<?=($_GET['e_news_id'])?$db5->f(news_id):""?>" />
                            <input name="h_pic" type="hidden" id="h_pic" value="<?=($_GET['e_news_id'])?$db5->f(news_img):""?>" /></td>
                      </tr>
                      <tr>
                        <td width="47%">&nbsp;</td>
                        <td width="53%">&nbsp;</td>
                      </tr>
                    </table>
                  </form>
                  <br>
	<table width="95%" border="0" align="center" cellpadding="0" cellspacing="3">
              <tr>
                <td align="center" bgcolor="#A6CBED" >หัวข้อข่าว</td>
                <td align="center" bgcolor="#A6CBED" >วันที่</td>
                <td align="center" bgcolor="#A6CBED" >แก้ไข</td>
                <td align="center" bgcolor="#A6CBED" >ลบ</td>
              </tr>
			  <?php
			  	$q="SELECT * FROM `news` WHERE 1";
				$db->query($q);
				static $v=1;
				while($db->next_record()){
			   ?>
              <tr bgcolor="<?=($v%2==1)?"#F1F7FC":"#D8ECFC"?>">
                <td  style="padding-left:3px"><?=$db->f(news_topic)?></td>
                <td   style="padding-left:3px"><?=date("d-m-Y",$db->f(news_date))?></td>
                <td width="8%" align="center" ><a href="?e_news_id=<?=$db->f(news_id)?>"><img src="images/edit.gif" alt="แก้ไข" width="19" height="23" border="0" /></a></td>
                <td width="8%" align="center" ><a href="?d_news_id=<?=$db->f(news_id)?>&pic=<?=$db->f(news_img)?>" onClick="return confirm('ยืนยันการลบข้อมูล')"><img src="images/del.gif" alt="ลบ" width="19" height="23" border="0" /></a></td>
              </tr>
			  <?php $v++; } ?>
            </table>
			<br>

                <!-- InstanceEndEditable --></td></tr>
            </table></td>
          </tr>
        </table>
          <p>&nbsp;</p>
          <p>&nbsp;</p></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td height="40" bgcolor="#053663">&nbsp;</td>
  </tr>
</table>
</body>
<!-- InstanceEnd --></html>
