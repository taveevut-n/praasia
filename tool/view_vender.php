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
    <td><img src="/admin/images/head.jpg" width="1098" height="288" /></td>
  </tr>
  <tr>
    <td bgcolor="#311407"><table width="100%" border="0" cellspacing="3" cellpadding="0">
      <tr>
        <td width="250" valign="top" ><? include('sidemenu.php') ?></td>
        <td valign="top" bgcolor="#3f1d0e">		
		<?php
			if($_GET['buy_id']){
				$q="update `vender_amulet` set type='".$_GET['buy_id']."' WHERE `vender_id` =".$_GET['vender_id']." ";
				$db->query($q);
				//redi2("product.php?s_page=".$_GET['s_page']);				
				echo "<script>window.location.href='view_vender.php';</script>";
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
					`detail` = '".$_POST['detail']."'  WHERE `vender_id` =".$_POST['h_data_id']." ";
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
<form action="" method="post" enctype="multipart/form-data" name="form1" id="form1" target="frm">
                    <table width="95%" border="0" align="center" cellpadding="0" cellspacing="2" class="box_from3_2">
                            <tr>
                              <td height="25" colspan="2" align="center" bgcolor="#4d1403" class="bh">เพิ่มผู้จัดหาพระเครื่อง</td>
                      </tr>
							 <tr>
                              <td width="20%" height="31" align="right" bgcolor="#3c1204" class="sidemenu"  style="padding-right:3px">ชื่อผู้ติดต่อ</td>
                              <td width="80%" bgcolor="#3c1204"><input name="name" type="text" class="box_from3" id="name" value="<?=($_GET['e_data_id'])?$db5->f(name):""?>" size="80" /></td>
                      </tr>
							 <tr>
                              <td width="20%" height="31" align="right" bgcolor="#3c1204" class="sidemenu"  style="padding-right:3px">เบอร์โทรศัพท์</td>
                              <td width="80%" bgcolor="#3c1204"><input name="tel" type="text" class="box_from3" id="tel" value="<?=($_GET['e_data_id'])?$db5->f(tel):""?>" size="80" /></td>
                              </tr>
							 <tr>
                              <td width="20%" height="31" align="right" bgcolor="#3c1204" class="sidemenu"  style="padding-right:3px">Line</td>
                              <td width="80%" bgcolor="#3c1204"><input name="line" type="text" class="box_from3" id="line" value="<?=($_GET['e_data_id'])?$db5->f(line):""?>" size="80" /></td>
                              </tr>
							 <tr>
                              <td width="20%" height="31" align="right" bgcolor="#3c1204" class="sidemenu"  style="padding-right:3px">Wechat</td>
                              <td width="80%" bgcolor="#3c1204"><input name="wechat" type="text" class="box_from3" id="wechat" value="<?=($_GET['e_data_id'])?$db5->f(wechat):""?>" size="80" /></td>
                      </tr> 
							 <tr>
                              <td width="20%" height="31" align="right" bgcolor="#3c1204" class="sidemenu"  style="padding-right:3px">Link 1</td>
                              <td width="80%" bgcolor="#3c1204"><input name="link1" type="text" class="box_from3" id="link1" value="<?=($_GET['e_data_id'])?$db5->f(link1):""?>" size="80" /></td>
                      </tr>
							 <tr>
                              <td width="20%" height="31" align="right" bgcolor="#3c1204" class="sidemenu"  style="padding-right:3px">Link 2</td>
                              <td width="80%" bgcolor="#3c1204"><input name="link2" type="text" class="box_from3" id="link2" value="<?=($_GET['e_data_id'])?$db5->f(link2):""?>" size="80" /></td>
                      </tr>   
							 <tr>
                              <td width="20%" height="31" align="right" bgcolor="#3c1204" class="sidemenu"  style="padding-right:3px">ราคา</td>
                              <td width="80%" bgcolor="#3c1204"><input name="price" type="text" class="box_from3" id="price" value="<?=($_GET['e_data_id'])?$db5->f(price):""?>" size="20" /></td>
                      </tr>
							 <tr>
                              <td width="20%" height="31" align="right" bgcolor="#3c1204" class="sidemenu"  style="padding-right:3px">สถานะ</td>
                              <td width="80%" bgcolor="#3c1204"><input name="status" type="text" class="box_from3" id="status" value="<?=($_GET['e_data_id'])?$db5->f(status):""?>" size="40" /></td>
                      </tr>                                                                                  
							 <tr>
                              <td width="20%" height="31" align="right" bgcolor="#3c1204" class="sidemenu"  style="padding-right:3px">บันทึกข้อความ</td>
                              <td width="80%" bgcolor="#3c1204"><textarea name="detail" class="box_from3" id="detail" style="height:100px; width:400px"><?=($_GET['e_data_id'])?$db5->f(detail):""?>
                              </textarea></td>
                      </tr>          
							 <tr>
                              <td width="20%" height="31" align="right" bgcolor="#3c1204" class="sidemenu"  style="padding-right:3px">Pic1</td>
                              <td width="80%" bgcolor="#3c1204"><input name="pic1" type="file" class="box_from3" id="pic1" value="" /></td>
                              </tr> 
							 <tr>
                              <td width="20%" height="31" align="right" bgcolor="#3c1204" class="sidemenu"  style="padding-right:3px">Pic2</td>
                              <td width="80%" bgcolor="#3c1204"><input name="pic2" type="file" class="box_from3" id="pic2" value="" /></td>
                              </tr>                                                             
							 <tr>
                              <td width="20%" height="31" align="right" bgcolor="#3c1204" class="sidemenu"  style="padding-right:3px">Pic3</td>
                              <td width="80%" bgcolor="#3c1204"><input name="pic3" type="file" class="box_from3" id="pic3" value="" /></td>
                              </tr> 
							 <tr>
                              <td width="20%" height="31" align="right" bgcolor="#3c1204" class="sidemenu"  style="padding-right:3px">Pic4</td>
                              <td width="80%" bgcolor="#3c1204"><input name="pic4" type="file" class="box_from3" id="pic4" value="" /></td>
                              </tr> 
							 <tr>
                              <td width="20%" height="31" align="right" bgcolor="#3c1204" class="sidemenu"  style="padding-right:3px">Pic5</td>
                              <td width="80%" bgcolor="#3c1204"><input name="pic5" type="file" class="box_from3" id="pic5" value="" /></td>
                              </tr>                                                                                                                                                                                                                          
                            <tr>
                              <td bgcolor="#3c1204">&nbsp;</td>
                              <td bgcolor="#3c1204"><input name="Submit" type="submit" class="button_add" value="<?=($_GET['e_data_id'])?"แก้ไขข้อมูล":"เพิ่มข้อมูลผู้จัดหาพระเครื่อง"?>" />
                                  <?php if($_GET['e_data_id']){ ?>
                                  <input name="h_data_id" type="hidden" id="h_data_id" value="<?=$db5->f(vender_id)?>" />
                                  <input name="h_pic1" type="hidden" id="h_pic1" value="<?=$db5->f(pic1)?>">
                                  <input name="h_pic2" type="hidden" id="h_pic2" value="<?=$db5->f(pic2)?>">
                                  <input name="h_pic3" type="hidden" id="h_pic3" value="<?=$db5->f(pic3)?>">
                                  <input name="h_pic4" type="hidden" id="h_pic4" value="<?=$db5->f(pic4)?>"> 
                                  <input name="h_pic4" type="hidden" id="h_pic4" value="<?=$db5->f(pic5)?>">                                     								  
                              <?php } ?>                              </td>
                      </tr>
                    </table>
                  </form>
				<iframe name="frm" width="1" height="1" frameborder="0"></iframe>			
                <br />
				<script language="javascript">
					function selec(){
						var ab=document.getElementById('se');
						location.href=ab.value;
					}
				</script>                
				   <table width="700" border="0" align="center" cellpadding="0" cellspacing="3" bordercolor="#FFFFFF">
                   		<tr>
                        	<td align="right" colspan="7">
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
                            <td height="25" align="center" bgcolor="#000000" class="style11" colspan="7" > ผู้จัดหาพระเครื่อง:<?=$dbamulet->f(name)?></td>
                     </tr> 
                          <tr class="bh">
                          	<td width="6%" bgcolor="#4d1403">รหัส</td>
                            <td width="50%" height="25" align="center" bgcolor="#4d1403" class="style11" >ข้อมูลผู้จัดหา</td>
                            <td height="25" align="center" bgcolor="#4d1403" class="style11" >แก้ไข</td>
                            <td height="25" align="center" bgcolor="#4d1403" class="style11" >ลบ</td>
                            <td height="25" align="center" bgcolor="#4d1403" class="style11" >ประเภท</td>
                            <td align="center" bgcolor="#4d1403" class="style11" >ดู</td>
                            <td align="center" bgcolor="#4d1403" class="style11" >ประวัติการโทร</td>
                          </tr>
						  <?php 
							if ($_GET['search_type']) {
								$_SESSION['search_type'] = $_GET['search_type'];
							}
							
							if ($_SESSION['search_type']=='2' || $_SESSION['search_type']=='') {
								$q="SELECT * FROM `vender_amulet` WHERE amulet_id = '".$_SESSION['amulet_id']."' ORDER BY type DESC";
							} else {		
								$q="SELECT * FROM `vender_amulet` WHERE amulet_id = '".$_SESSION['amulet_id']."' and type = '".$_SESSION['search_type']."' ORDER BY type DESC";
							}
							$db->query($q);
							static $v=1;
							while($db->next_record()){
						  ?>
                          <tr bgcolor="<?=($v%2==0)?"#3c1204":"#3c1204"?>" >
                          	<td align="center" bgcolor="#3c1204" style="color:#FC0"><?=$db->f(vender_id)?></td>
                            <td height="30" align="center" bgcolor="#3c1204" style="color:#FC0; font-size:12px; border-bottom:1px solid #FC0">
                                <table width=400" border="0" cellspacing="0" cellpadding="3">
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
                            
                            <td width="6%" align="center" bgcolor="#3c1204" style="border-bottom:1px solid #FC0"><a href="?e_data_id=<?=$db->f(vender_id)?>" ><img src="../images/edit.gif" alt="แก้ไข" width="19" height="23" border="0" /></a></td>
                            <td width="3%" align="center" bgcolor="#3c1204" style="border-bottom:1px solid #FC0"><a href="?d_data_id=<?=$db->f(vender_id)?>" onClick="return confirm('คุณแน่ใจที่จะลบหรือไม่ ?')"><img src="../images/del.gif" alt="แก้ไข" width="19" height="23" border="0" /></a></td>
                            <td width="17%" align="center" bgcolor="#3c1204" style="border-bottom:1px solid #FC0"><? if ($db->f(type)=='0') { ?><a href="?buy_id=1&vender_id=<?=$db->f(vender_id)?>" style="color:#F00">ยังไม่ซื้อขาย</a> <? } else {?><a href="?buy_id='0'&vender_id=<?=$db->f(vender_id)?>" style="color:#060">ซื้อขายแล้ว</a><? } ?></td>
                            <td width="3%" align="center" bgcolor="#3c1204" style="border-bottom:1px solid #FC0"><a href="detail_vender.php?id=<?=$db->f(vender_id)?>"><img src="../images/view-icon.png" /></a></td>
                            <td width="15%" align="center" bgcolor="#3c1204" style="border-bottom:1px solid #FC0"><a href="work_vender.php?id=<?=$db->f(vender_id)?>" class="iframe"><img src="../images/task.png" /></a></td>
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