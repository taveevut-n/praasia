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
	<!--jquery ui Local-->
	<link rel="stylesheet" href="../func/jquery-ui-1.10.3/themes/base/jquery-ui.css" />
	<script src="../func/jquery-ui-1.10.3/jquery-1.9.1.js"></script>
	<script src="../func/jquery-ui-1.10.3/ui/jquery-ui.js"></script>
	<script src="../func/jquery-ui-1.10.3/jquery.transit.min.js"></script>
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
<p>&nbsp;</p>
<table width="1000" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td><img src="/admin/images/head.jpg" width="1098" height="288" /></td>
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
				
				$q = "SELECT * FROM `member`where username = '".$_POST['certdoc_username']."' ";
				$db->query($q);
				$db->next_record();		
				
				$certdoc_dateems1 = $_POST["certdoc_dateems1"];
				$dateems1 = date("Y-m-d H:i:s", strtotime($certdoc_dateems1));	
				
				$certdoc_dateems = $_POST["certdoc_dateems"];
				$dateems = date("Y-m-d H:i:s", strtotime($certdoc_dateems));							
			
				$q="INSERT INTO `certificate_doc` ( `certdoc_id` , `certdoc_code`  , `certdoc_name` , `certdoc_username` , `certdoc_address` , `certdoc_tel` , `certdoc_type`, `certdoc_ems1`, `certdoc_dateems1`, `certdoc_ems`, `certdoc_dateems`, `certdoc_update`) 	
				VALUES (	'' , '".$certdoc_code."', '".$db->f(name)."' , '".$_POST['certdoc_username']."' , '".$db->f(address)."' , '".$db->f('tel')."' , '".$_POST['certdoc_type']."' , '".$_POST['certdoc_ems1']."', '".$dateems1."' , '".$_POST['certdoc_ems']."' , '".$dateems."' , '".date("Y-m-d")."' );";
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
			
				if ($_POST['certdoc_username']) {
				  $q = "SELECT * FROM `member`where username = '".$_POST['certdoc_username']."' ";
				  $db->query($q);
				  $db->next_record();	 					
					
				}
				$certdoc_dateems1 = $_POST["certdoc_dateems1"];
				$dateems1 = date("Y-m-d H:i:s", strtotime($certdoc_dateems1));	
				
				$certdoc_dateems = $_POST["certdoc_dateems"];
				$dateems = date("Y-m-d H:i:s", strtotime($certdoc_dateems));					
				$q="UPDATE `certificate_doc` SET `certdoc_name` = '".$db->f(name)."' ,
				`certdoc_username` = '".$_POST['certdoc_username']."' ,
				`certdoc_address` = '".$db->f(address)."' ,
				`certdoc_tel` = '".$db->f(tel)."'  ,
				`certdoc_type` = '".$_POST['certdoc_type']."' ,
				`certdoc_ems1` = '".$_POST['certdoc_ems1']."' ,
				`certdoc_dateems1` = '".$dateems1."' ,	
				`certdoc_ems` = '".$_POST['certdoc_ems']."',	
				`certdoc_dateems` = '".$dateems."' ,				
				`certdoc_update` = '".date("Y-m-d")."' WHERE `certdoc_id` =".$_POST['h_data_id']." ";
				$db->query($q);
					for($mf=1;$mf<=4;$mf++){
						$upf[$mf] = uppic($_FILES['file'.$mf],$mf,"../img/certificate_doc/",$_POST['h_pic'.$mf]); // Same folder
						if($upf[$mf]!=''){
							$q = "UPDATE `certificate_doc` SET `pic$mf` = '".$upf[$mf]."' WHERE `certdoc_id` =".$_POST['h_data_id']." ";
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
				   <table width="100%" border="0" align="center" cellpadding="0" cellspacing="3" bordercolor="#FFFFFF" style="font-size:12px">
                          <tr>
                          	<td colspan="10" style="margin-top:10px" align="right">
                            <form method="post" action="search_certificate_systems.php">
                            <table width="100%">
                            	<tr>
                                	<td align="right">
                            			<input type="text" name="search" placeholder="ค้นหารายการพระจาก ID และ ชื่อพระ" style="width:300px" /><input type="submit" name="submit_search" value="ค้นหา" />
                            		</td>
                                 </tr>
                            </table>
                            </form>
                            </td>
                          </tr>
                          <tr class="bh">
                          	<td width="11%" height="25" align="center" bgcolor="#4d1403" class="style11" >รูป</td>
                            <td width="9%" height="25" align="center" bgcolor="#4d1403" class="style11" >No.</td>
                            <td width="11%" height="25" align="center" bgcolor="#4d1403" class="style11" >username<br />ชื่อ</td>
                            <td width="19%" height="25" align="center" bgcolor="#4d1403" class="style11" >ที่อยู่</td>
                            <td width="12%" height="25" align="center" bgcolor="#4d1403" class="style11" >โทร.</td>
                            <td width="13%" height="25" align="center" bgcolor="#4d1403" class="style11" >สถานะการส่ง</td>                            
                            <td height="25" align="center" bgcolor="#4d1403" class="style11" >เพิ่มพระ</td>
                            <td height="25" align="center" bgcolor="#4d1403" class="style11" >Edit</td>
                            <td height="25" align="center" bgcolor="#4d1403" class="style11" >ลบ</td>
                            <td height="25" align="center" bgcolor="#4d1403" class="style11" >พิมพ์</td>
                          </tr>
						  <?php
						  	if ($_POST['search']) {
								$_SESSION['search_cert'] = $_POST['search'];
							}
						  	$q="SELECT * FROM `certificate_doc` WHERE certdoc_id IN (SELECT certdoc_id  FROM `cert` WHERE `cert_code` LIKE '%".$_SESSION['search_cert']."%' OR `cert_amulet` LIKE '%".$_SESSION['search_cert']."%') ORDER BY certdoc_id DESC";
							$db->query($q);
							static $v=1;
							while($db->next_record()){
								
						  	$q="SELECT * FROM `cert` WHERE certdoc_id = '".$db->f(certdoc_id)."' ORDER BY cert_id DESC";
							$amulet= new nDB();
							$amulet->query($q);
							$amulet->next_record();	
							$num_rows = $amulet->num_rows();								
								
							$q="SELECT * FROM `member` WHERE username = '".$db->f(certdoc_username)."' ";
							$member=new nDB();
							$member->query($q);
							$member->next_record();
						  ?>
                          <?
							$date_receive = strtotime($db->f(certdoc_dateems1));
							$date_send = strtotime($db->f(certdoc_dateems));							  
						  ?>
                          <tr bgcolor="<?=($v%2==0)?"#3c1204":"#3c1204"?>">
                          	<td align="center" bgcolor="#3c1204"><a href="../img/certificate_doc/<?=$db->f(pic1)?>" target="_blank"><img src="../slir/w100-h100/img/certificate_doc/<?=$db->f(pic1)?>" width="60" height="86" /></a><br /></td>
                            <td height="110" align="center" bgcolor="#3c1204"style="color:#FC0;"><?=$db->f(certdoc_code)?><br /> <?=$num_rows?> ชิ้น</td>
                            <td align="center" style="color:#FC0;" bgcolor="#3c1204"><a href="../shop_index.php?shop=<?=$member->f(id)?>" style="color:#FC0" target="_blank"><?=$db->f(certdoc_username)?></a><br />(<?=$db->f(certdoc_name)?>)</td>
                            <td align="center" bgcolor="#3c1204" style="color:#FC0; font-size:12px"><?=$db->f(certdoc_address)?></td>
                            <td align="center" bgcolor="#3c1204" style="color:#FC0; ">
                            <?=$db->f(certdoc_tel)?>                                                        
                            </td>
                            <td align="center" bgcolor="#3c1204" style="color:#FC0;">
							<? if ($db->f(certdoc_status)=='0') { ?>
                            <a href="?certdoc_id=<?=$db->f(certdoc_id)?>&status=1"><span style="color:#F90; font-size:12px">ได้รับแล้ว <br /> EMS : <?=$db->f(certdoc_ems1)?> <br /> (<?=date("d/m/Y",$date_receive)?>)</span></a>
                            <? } ?>
							<? if ($db->f(certdoc_status)=='1') { ?>
                            <a href="?certdoc_id=<?=$db->f(certdoc_id)?>&amp;status=2"><span style="color:#0C0; font-size:12px">กำลังตรวจสอบ</span></a>
                            <? } ?>
							<? if ($db->f(certdoc_status)=='2') { ?>
                            <a href="?certdoc_id=<?=$db->f(certdoc_id)?>&amp;status='0'"><span style="color:#F00; font-size:12px">ส่งคืนแล้ว <br /> EMS : <?=$db->f(certdoc_ems)?> <br /> (<?=date("d/m/Y",$date_send)?>)</span></a>
                            <? } ?>							
                            </td>
                            <td width="10%" align="center" bgcolor="#3c1204"><a href="certdoc_amulet.php?certdoc_id=<?=$db->f(certdoc_id)?>"  style="color:#F90; font-size:12px">++ เพิ่มพระ ++</a></td>
                            <td width="4%" align="center" bgcolor="#3c1204"><a href="?e_data_id=<?=$db->f(certdoc_id)?>" ><img src="../images/edit.gif" alt="แก้ไข" width="19" height="23" border="0" /></a></td>
                            <td width="3%" align="center" bgcolor="#3c1204"><a href="?d_data_id=<?=$db->f(certdoc_id)?>" onClick="return confirm('คุณแน่ใจที่จะลบหรือไม่ ?')" ><img src="../images/del.gif" alt="แก้ไข" width="19" height="23" border="0" /></a></td>
                            <td width="8%" align="center" bgcolor="#3c1204"><a class='ajax' href="print_certdoc.php?certdoc_id=<?=$db->f(certdoc_id)?>" style="color:#FFF" >พิมพ์</a></td>
                            
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