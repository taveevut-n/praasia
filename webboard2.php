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
	font-size: 12px;
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
<td bgcolor="#000000">
<div class="divbar">                  

<style type="text/css">
a#goReg{
	color:#336666;
	font-size:14px;
	font-weight:bold;
}
div.iTopicQUE{
	border:1px dotted #CCCCCC;
	background-color:#EAEAEA;
	margin:5px;
	padding:10px;
}
div.iTopicQUE_R{
	border:1px dotted #CCCCCC;
	background-color:#F8F8F8;	
	padding:5px;
	margin-top:3px;
}
span.iTopicQUE_T{
	font-size:15px;
}
div.iTopicQUE_R a{
	color:#0099CC;
}
</style>
        <?php
if($_GET['id_que']){
	$_SESSION['id_que']=$_GET['id_que'];
	}
	$q="UPDATE `webboard_que` SET `read_que` = `read_que`+1 WHERE `id_que` =".$_SESSION['id_que']." ";
	$db->query($q);
	$q="SELECT * FROM `webboard_que` WHERE id_que=".$_GET['id_que']." ";
	$db->query($q);
	$db->next_record();			  
	$topic_que_show=str_replace("\"","",$db->f(title_que));	
$db2=new nDB();
$q2="SELECT webboard_catType FROM webboard_cat WHERE 1 AND webboard_catID='".$db->f(catID)."'  AND webboard_catShow=1 ";
$db2->query($q2);
$db2->next_record();
$total_memberIS=$db2->f(webboard_catType);

    ?>
<script type="text/javascript" src="js/jquery-1.4.1.min.js"></script>
<script type="text/javascript">
$(function(){
	function permiss_func(obj,fileName){
		var fty=new Array(".gif",".jpg",".jpeg",".png"); // ประเภทไฟล์ที่อนุญาตให้อัพโหลด   
		var permiss=0; // เงื่อนไขไฟล์อนุญาต		
		permiss_file=fileName;
		permiss_file=permiss_file.toLowerCase();    
		if(permiss_file !=""){
			for(i=0;i<fty.length;i++){ // วน Loop ตรวจสอบไฟล์ที่อนุญาต   
				if(permiss_file.lastIndexOf(fty[i])>=0){  // เงื่อนไขไฟล์ที่อนุญาต   
					permiss=1;
					break;
				}else{
					continue;
				}
			}  	
		}
		if(permiss==0){
			var newObj='<input type="file" name="fileUpload[]" />';
			alert("อัพโหลดได้เฉพาะไฟล์ gif jpg jpeg png");  
			obj.after(newObj).remove();   
			return false;   
		}
	}
	$("input:file").live('change',function(){
		permiss_func($(this),$(this).val());
	});	
});
</script>   
  <script type="text/javascript">
	function isValidEmail(str) {
	var filter=/^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i
	return (filter.test(str))?true:false
	}  
  function chk_postboard(){
  		var okPass=1;
  		$("input[title=board_require]").each(function(){
			var idEq=$("input[title=board_require]").index(this);
			if($("input[title=board_require]").eq(idEq).val()==""){
				okPass=0;
				alert("กรุณากรอกข้อมูลที่จำเป็นให้ครบถ้วน");
				$("input[title=board_require]").eq(idEq).focus();
				return false;
			}else{
				if($("input[title=board_require]").eq(idEq).attr("name")=="board_email"){
					if(isValidEmail($("input[name=board_email]").val())==false){
						okPass=0;
						alert("กรุณากรอกรูปบบอีเมลล์ให้ถูกต้อง");
						$("input[name=board_email]").val("").focus();		
						return false;	
					}				
				}			
			}
		});
		if(okPass==0){
			return false;
		}
  }
  </script>    
                  <table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
                    <tr>
                      <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td>&nbsp;</td>
                          </tr>
                          <tr>
                            <td>
<div id="nDetailContentDiv">
<div id="nContentDetail">
<div class="nShowContent">

<div class="contentDiv">
<h1 style="font-size:18px;"> <?=$db->f(title_que)?></h1>

<div class="lastPostDiv">
  <?php
  	function get_picuser($name){
		$dbuser=new nDB();
		$quser="select * from member where username='".$name."' ";
		$dbuser->query($quser);
		$dbuser->next_record();
		return $dbuser->f(pic1);
	}
  ?>
<div class="iTopicQUE">
<span class="iTopicQUE_T" ><strong><?=$db->f(title_que)?></strong></span>
<div class="iTopicQUE_R">
<?=$db->f(detail_que)?>
</div>
<div class="iTopicQUE_R">
  <img src="images/person.jpg" width="49" height="49" align="absmiddle" />
		 <strong><span>โดย:&nbsp;<?=$db->f(name_que)?></span></strong> 
		  <a href="mailto:<?=$db->f(email_que)?>"><span><?=$db->f(email_que)?></span></a>
		  <strong><span>IP: </span></strong><span><?=hide_ip($db->f(ip_que))?></span>
		<strong><span>วันที่:</span></strong><span> <?=date("d-m-Y",$db->f(date_que))?>	</span>	 
		<strong><span>เวลา:</span></strong> <span><?=date("H:i:s",$db->f(date_que))?></span></div>
</div>

<br />

<div class="iTopicQUE">
<span class="iTopicQUE_T"><strong>ตอบกระทู้</strong></span>

<form action="reply.php" method="post" enctype="multipart/form-data" target="reply_frame" name="form1"  id="form1"  style="display:inline;">
        <table id="sh_post" width="100%" border="0" cellpadding="0" cellspacing="5" class="hd_topic2" style="border:2px outset;">
            <tr>
              <td colspan="2" align="right" style="color:#FF0000;font-weight:bold;"><input type="button" name="button2" id="button2" value="กลับไปหน้าเว็บบอร์ด" onclick="window.location='webboard.php'" style="cursor:pointer;" /></td>
              </tr>              
          <tr>
            <td align="right">ชื่อ</td>
            <td><input name="name" type="text"  title="board_require" value="<?=$_SESSION['user_zab']?>" size="35" />
            <span style="color:#FF0000;font-weight:bold;font-size:10px;">* จำเป็นต้องกรอก</span>            </td>
          </tr>
          <tr>
            <td align="right">อีเมลล์</td>
            <td><input  name="board_email" type="text"   size="35" />                      </td>
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
				
				$CKEditor->config['width'] = 600;
				$CKEditor->config['height'] = 200;
				$CKEditor->config['skin'] = "office2003";
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
            <td width="65" align="right">&nbsp;</td>
            <td valign="middle">
			<input name="Submit" type="submit"  value="ตอบกระทู้"  style="cursor:pointer;"  />
              <input name="Reset" type="reset" id="button" value="ล้างข้อความ" style="cursor:pointer;" />
              <input name="h_que_id" type="hidden" id="h_que_id" value="<?=$_GET['id_que']?>" /></td>
          </tr>
          </table>
      </form>
</div>	  



<br />
 <?php
	$q="SELECT MIN(id_ans) AS id2 FROM `webboard_ans` WHERE id_que=".$_GET['id_que']."";
	$db->query($q);
	$db->next_record();	
	$min=$db->f(id2);	
	$q="SELECT * FROM `webboard_ans` WHERE id_que=".$_GET['id_que']." ORDER BY id_ans DESC ";
	  $db->query($q);							
	  $total=$db->num_rows();							
	  $q.=" LIMIT 0,100";
	  $db->query($q);

	$w=$total;	
//	static $w;
	while($db->next_record()){

 ?>
 <div class="iTopicQUE">
<span class="iTopicQUE_T2">&nbsp;<strong>ความคิดเห็นที่ <?=($db->f(id_ans)-$min)+1?></strong></span>

<div class="iTopicQUE_R">
<?php
if($db->f(img_ans)!=""){
?>
<div style="margin:auto;text-align:center;margin:5px;">
<a href="upimg/<?=$db->f(img_ans)?>" target="_blank" title="คลิกเพื่อดูรูปใหญ่"><img src="upimg/<?=$db->f(img_ans)?>" style="width:300px;border:1px solid #E6E6E6;background-color:#F5F5F5;padding:3px;" border="0" /></a>
</div>
<?php } ?>
<?=$db->f(detail_ans)?>
</div>
<div class="iTopicQUE_R">
  <img src="images/person.jpg" width="49" height="49" align="absmiddle" />
		 <strong><span>โดย:&nbsp;<?=$db->f(name_ans)?></span></strong> 
		  <a href="mailto:<?=$db->f(email_ans)?>"><span><?=$db->f(email_ans)?></span></a>
		  <strong><span>IP: </span></strong><span><?=hide_ip($db->f(ip_ans))?></span>
		<strong><span>วันที่:</span></strong><span> <?=date("d-m-Y",$db->f(date_ans))?>	</span>	 
		<strong><span>เวลา:</span></strong> <span><?=date("H:i:s",$db->f(date_ans))?></span></div>
</div>
  
<?php $w--; } ?>

<br />
<br />
<br />
<br />



</div>
</div><!-- end contentDiv-->

</div>
</div>
</div>
  <iframe src="" name="reply_frame" width="1px" height="0px" frameborder="0"></iframe>
							
                            </td>
                          </tr>
                        
                      </table></td>
                    </tr>
                    <tr>
                      <td align="right"><br />
                          <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
                            <tr>
                              <td align="right">&nbsp;</td>
                            </tr>
                        </table></td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                    </tr>
                  </table>
                  
                </div>  </td>
  </tr>
  <tr>
    <td bgcolor="#000000">&nbsp;</td>
  </tr>
  <tr>
    <td bgcolor="#000000">&nbsp;</td>
  </tr>
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
