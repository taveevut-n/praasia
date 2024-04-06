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
