<? include('../global.php')?>
<?php if($_SESSION['adminid']=='' || !isset($_SESSION['adminid'])) {  
        redi4("login.php");
	
		} 

		if($_GET['content_id']) {
			$_SESSION['content_id'] = $_GET['content_id'];
		}
?>
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
    <td><img src="/admin/images/head.jpg" width="1098" height="288" /></td>
  </tr>
  <tr>
    <td bgcolor="#311407"><table width="100%" border="0" cellspacing="3" cellpadding="0">
      <tr>
        <td width="250" valign="top" ><? include('sidemenu.php') ?></td>
        <td valign="top" bgcolor="#3f1d0e">				
<?php 
	if($_POST['Submit']){
				foreach ($_POST["datacert"] as $key => $value) {
					$datacert_catalog .= $value.",";
				}
				// $datacert_catalog = substr($datacert_catalog, 0,(strlen($datacert_catalog)-1));

				$q="UPDATE `content_certificate` SET `amulet_id` = '".",".$datacert_catalog."'  WHERE `content_id` =".$_SESSION['content_id']." ";
				$db->query($q);
				// al('Edit Complete');
				// redi4('check_contentreferee.php');									
				}
?>

					<form action="" method="post" enctype="multipart/form-data" name="form1" id="form1">
                    <table width="95%" border="0" align="center" cellpadding="0" cellspacing="2" class="box_from3_2">
                            <tr>
                              <td height="25" colspan="2" align="center" bgcolor="#4d1403" class="bh">กรอกข้อมูลเอกสารการรับข้อมูลออกบัตร</td>
                      </tr>
							<!--  <tr>
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
                              	<option value="0" >
                                	<?=$topcatalog->f(catalog_name)?>
                                </option>
                                	   <?
											$q="SELECT * FROM catalog_cert WHERE top_id = '".$topcatalog->f(catalog_id)."' order by catalog_id ";
											$catalog=new nDB();
											$catalog->query($q);
											while ($catalog->next_record()) {	
										?>
										<option value="0"  >
											---- <?=$catalog->f(catalog_name)?>
										</option>
												<?
													$q="SELECT * FROM datacert WHERE datacert_catalog = '".$catalog->f(catalog_id)."' order by datacert_id ";
													$datacert=new nDB();
													$datacert->query($q);
													while ($datacert->next_record()) {	
												?>
												<option value="<?=$datacert->f(datacert_id)?>" >
													<span style="font-weight:bold">******** <?=$datacert->f(datacert_amulet)?></span>
												</option>
												
												<? } ?>
                                        
										<? } ?>
                                <? } ?>
                              </select>
                              </td>
                              </tr> -->
					  <?php 
						  	$q="SELECT * FROM `content_certificate` WHERE content_id = '".$_SESSION['content_id']."'";
							$db->query($q);
							$db->next_record();
						  ?>                              
                             <tr>
                             	<td align="right" bgcolor="#3c1204" style="color:#FFF">ชื่อพระที่เลือก</td>
                                <td bgcolor="#3c1204" style="color:#FC0"><?=$db->f(name)?>
                                </td>
                             </tr>    
                             <tr>
                             	<td bgcolor="#4d1403">
                             		
                             	</td>
                             	<td bgcolor="#4d1403">
                             		 <?
                             		 	$arr = explode(",", $db->f(amulet_id));
                             		 	$c = 0;
										$q="SELECT * FROM datacert  order by datacert_id ";
										$topcatalog=new nDB();
										$topcatalog->query($q);
										while ($topcatalog->next_record()) {	
										if(array_search($topcatalog->f(datacert_id), $arr)  != ""){
											$checked = "checked";
										}else{
											$checked = "";
										}
									?>
	                              	<label style="color:#fff;font-size:13px;"><input type="checkbox" name="datacert[]" <?=$checked?> value="<?=$topcatalog->f(datacert_id)?>"> <?=$topcatalog->f(datacert_amulet)?><br/></label>
                                	<? 
                                		$c += 1;
                                	} ?>
                             	</td>
                             </tr>                                                             
                            <tr>
                              <td bgcolor="#3c1204">&nbsp;</td>
                              <td bgcolor="#3c1204"><input name="Submit" type="submit" class="button_add" value="<?=($_GET['content_id'])?"บันทึกการเปลี่ยนแปลง":"เพิ่มข้อมูล"?>" />                            </td>
                      </tr>
                    </table>
                  </form>
					<iframe name="frm" width="1" height="1" frameborder="0"></iframe>
				                     
                  </td>
      </tr>
    </table></td>
  </tr>
</table>
</body>
</html>