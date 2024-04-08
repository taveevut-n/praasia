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
                                                	<a href="../img/vender_pic/<?=$db->f(pic1)?>" target="_blank"><img src="<?=($db->f(pic1)!="")?'/slir/h60/img/vender_pic/'.$db->f(pic1):"../images/clear.gif"?>" /></a>
                                                </td>
                                            	<td>
                                                	<a href="../img/vender_pic/<?=$db->f(pic2)?>" target="_blank"><img src="<?=($db->f(pic2)!="")?'/slir/h60/img/vender_pic/'.$db->f(pic2):"../images/clear.gif"?>" /></a>
                                                </td>
                                            	<td>
                                                	<a href="../img/vender_pic/<?=$db->f(pic3)?>" target="_blank"><img src="<?=($db->f(pic3)!="")?'/slir/h60/img/vender_pic/'.$db->f(pic3):"../images/clear.gif"?>" /></a>
                                                </td>
                                            	<td>
                                                	<a href="../img/vender_pic/<?=$db->f(pic4)?>" target="_blank"><img src="<?=($db->f(pic4)!="")?'/slir/h60/img/vender_pic/'.$db->f(pic4):"../images/clear.gif"?>" /></a>
                                                </td>
                                            	<td>
                                                	<a href="../img/vender_pic/<?=$db->f(pic5)?>" target="_blank"><img src="<?=($db->f(pic5)!="")?'/slir/h60/img/vender_pic/'.$db->f(pic5):"../images/clear.gif"?>" /></a>
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
