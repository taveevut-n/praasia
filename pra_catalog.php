<? include('../global.php')?>
<?php if($_SESSION['adminid']=='' || !isset($_SESSION['adminid'])) {  
        redi4("login.php");
} ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>ระบบจัดการเว็บไซต์</title>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
	<!--Innova Editor-->
	<script type="text/javascript" src="/admin/innovaeditor/scripts/innovaeditor.js"></script>
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
<table width="100%" border="0" cellspacing="0" cellpadding="3">
                                  <tr>
<td width="720" valign="top" bgcolor="#592D03">
				<script language="javascript">
					function selec(){
						var ab=document.getElementById('se');
						location.href=ab.value;
					}
				</script>
							<?php
	if($_GET['sub_id']){
		$q="update `pra_catalog` set show_sub='".$_GET['status']."' WHERE `id_sub_catalog` =".$_GET['sub_id']." ";
		$db->query($q);
		redi2();				
	}
?>	
							<?php
	if($_GET['status_id']){
		$q="update `pra_catalog` set status='".$_GET['status']."' WHERE `id_sub_catalog` =".$_GET['status_id']." ";
		$db->query($q);
		redi2();				
	}
?>	
				<?php
	if($_POST['Submit']){
		if($_POST['h_sub_id']){
		$q="UPDATE `pra_catalog` SET `id_top_catalog` = '".$_POST['id_sub_catalog']."',
`status` = '".$_POST['status']."',		
`detail_catalog` = '".$_POST['detail_catalog']."',
`name_catalog` = '".$_POST['name_catalog']."' WHERE `id_sub_catalog` =".$_POST['h_sub_id']." ";
		$db->query($q);
		$q="UPDATE `pra_product` SET `name_catalog` = '".$_POST['name_catalog']."' WHERE name_catalog='".$_POST['h_name_catalog']."' ";
		$db->query($q);		
				if($_FILES['file']['name']!=''){
					@unlink("../upimg/cat/".$_POST['h_pic']);
					upimg2($_FILES['file'],"../upimg/cat/");		
					$q="UPDATE `pra_catalog` SET `img_cat` = '".$file_up2."' WHERE `id_sub_catalog` =".$_POST['h_sub_id']." ";
					$db->query($q);
				}		
		al('แก้ไขข้อมูลเรียบร้อยแล้ว');
		redi2();
		}else{
		upimg2($_FILES['file'],"../upimg/banner/");					
		$q="INSERT INTO `pra_catalog` ( `id_sub_catalog` , `id_top_catalog` , `name_catalog`, `detail_catalog`, `img_catalog`, `status` ) 
VALUES (
'', '".$_POST['id_sub_catalog']."', '".$_POST['name_catalog']."', '".$_POST['detail_catalog']."', '".$file_up2."', '".$_POST['status']."'
);";
		$db->query($q);
		al('เพิ่มข้อมูลเรียบร้อยแล้ว');
		redi2();
		}
	}

?>
<?php
	if($_GET['d_sub_id']){
		@unlink("../upimg/cat/".$_GET['d_pic']);		
		$q="DELETE FROM `pra_catalog` WHERE `id_sub_catalog` = ".$_GET['d_sub_id']." ";
		$db->query($q);
	}
?>
<?php
	if($_GET['e_sub_id']){
		$q="SELECT * FROM `pra_catalog` WHERE id_sub_catalog=".$_GET['e_sub_id']." ";
		$db5 = new nDB();
		$db5->query($q);
		$db5->next_record();
	}
?>
				<script language="javascript">
	function dr(){
		var mdr=document.form1.id_sub_catalog;
		if(mdr.value==000){
			alert('กรุณาเลือกหมวดหลัก');
			mdr.value=0;
		}
	}
</script><br />
				  <form name="form1" method="post" action="">
                  <table width="96%" border="0" align="center" cellpadding="0" cellspacing="1" >
                    <tr>
                      <td height="25" colspan="2" align="center" bgcolor="#4d1403" class="style11" ><span class="sidemenu">เพิ่ม แก้ไขหมวดสินค้า</span></td>
                    </tr>
                    <tr>
                      <td width="27%" bgcolor="#3c1204">&nbsp;</td>
                      <td width="73%" bgcolor="#3c1204">&nbsp;</td>
                    </tr>
                    <tr>
                      <td align="right" bgcolor="#3c1204" class="style11" style="padding-right:3px"><span class="sidemenu">ประเภทหมวด</span></td>
                      <td bgcolor="#3c1204"><span class="sidemenu">
                        <select name="id_sub_catalog" id="id_sub_catalog" onChange="dr()"  style="width:400px" >
                          <option value="0">หมวดหลัก</option>
                          <option value="--">--------------</option>
                          <?php
					$q="SELECT * FROM `pra_catalog` WHERE id_top_catalog=0 ORDER BY id_sub_catalog";
					$db->query($q);
					while($db->next_record()){
					?>
						<option  value="<?=$db->f(id_sub_catalog)?>"
                        <? if ($_GET['e_sub_id']) { 
							if ($db5->f(id_top_catalog)==$db->f(id_sub_catalog)) {
								echo 'selected="selected"';
							}
						}
						?>
                        >
                        <?=$db->f(name_catalog)?>
                        </option>
						<?php } ?>
                        </select>
                        
                      </span></td>
                    </tr>
                    <tr>
                      <td align="right" bgcolor="#3c1204" class="style11" style="padding-right:3px"><span class="sidemenu">ชื่อหมวด</span></td>
                      <td bgcolor="#3c1204"><span class="sidemenu">
                        <input name="name_catalog" type="text"  id="name_catalog" value="<?=($_GET['e_sub_id'])?$db5->f(name_catalog):""?>" size="45" />
                      </span></td>
                    </tr>
                    <tr>
                      <td align="right" bgcolor="#3c1204" class="style11" style="padding-right:3px"><span class="sidemenu">แสดงหน้าแรก</span></td>
                      <td bgcolor="#3c1204"><span class="sidemenu">
                        <input name="status" type="checkbox" id="status" value="1" />
                      </span></td>
                    </tr>					
                    <tr>
                      <td colspan="2" align="center" bgcolor="#3c1204" class="style11" style="padding-right:3px"><span class="sidemenu">รายละเอียด<br />
                          <textarea id="detail_catalog" name="detail_catalog"><?=($_GET['e_sub_id'])?$db5->f(detail_catalog):"&nbsp;"?></textarea>
						  <script type="text/javascript">
                                            var oEdit2 = new InnovaEditor("oEdit2");
                                            oEdit2.width = 650;
                                            oEdit2.height = 400;
										/*Enable Custom File Browser */
										oEdit2.fileBrowser = "/admin/innovaeditor/assetmanager/asset.php";											
                                            oEdit2.groups = [
                                                ["group1", "", ["FontName", "FontSize", "Superscript", "ForeColor", "BackColor", "FontDialog", "BRK", "Bold", "Italic", "Underline", "Strikethrough", "TextDialog", "Styles"]],
                                                ["group2", "", ["JustifyLeft", "JustifyCenter", "JustifyRight", "BRK", "Bullets", "Numbering", "Indent", "Outdent"]],
                                                ["group3", "", ["TableDialog", "Emoticons", "FlashDialog", "BRK", "LinkDialog", "ImageDialog", "YoutubeDialog"]],
                                                ["group4", "", ["InternalLink", "CharsDialog", "Line", "BRK", "CustomObject", "CustomTag", "MyCustomButton"]],
                                                ["group5", "", ["SearchDialog", "SourceDialog", "BRK", "Undo", "Redo", "FullScreen"]]
                                            ];
                                            oEdit2.REPLACE("detail_catalog");
                            </script>						  
                      </span></td>
                    </tr>
                    <tr>	
                    	<td align="right" bgcolor="#3c1204"><span class="sidemenu">รูปภาพ :</span></td>
                        <td bgcolor="#3c1204"><span class="sidemenu">
                          <input name="file" type="file" id="file" />
                        </span></td>
                    </tr>
                                        
                    <tr>
                      <td bgcolor="#3c1204">&nbsp;</td>
                      <td bgcolor="#3c1204"><input name="Submit" type="submit" class="button_add"  value="<?=($_GET['e_sub_id'])?"แก้ไขหมวดสินค้า":"เพิ่มหมวดสินค้า"?>" />
                          <?php if($_GET['e_sub_id']){ ?>
                          <input name="h_sub_id" type="hidden" id="h_sub_id" value="<?=$db5->f(id_sub_catalog)?>" />
                          <input name="h_name_catalog" type="hidden" id="h_name_catalog" value="<?=$db5->f(name_catalog)?>" />					
             		      <input name="h_pic" type="hidden" id="h_pic" value="<?=$db5->f(img_catalog)?>">                          	  
                        <?php } ?>                      </td>
                    </tr>
                  </table>
				  </form>
				  <br />
				  <table width="96%" border="0" align="center" cellpadding="0" cellspacing="1">
                    <tr class="sidemenu">
                      <td height="25" align="center" bgcolor="#4d1403" class="style11" >ชื่อหมวดสินค้า</td>
                      <td align="center" bgcolor="#4d1403" class="style11" >แก้ไข</td>
                      <td align="center" bgcolor="#4d1403" class="style11" >ลบ</td>
                    </tr>
                    <?php
  $q="SELECT * FROM `pra_catalog` WHERE id_top_catalog=0 ORDER BY id_sub_catalog";
  $db->query($q);
  while($db->next_record()){
  ?>
                    <tr>
                      <td bgcolor="#1c0801"   style="padding-left:3px"><span style="color:#FC0; font-size:12px">
                        <?=$db->f(name_catalog)?> 
                      </span></td>
                      <td width="8%" align="center" bgcolor="#1c0801"><span class="sidemenu"><a href="?e_sub_id=<?=$db->f(id_sub_catalog)?>" ><img src="images/edit.gif" alt="แก้ไข" width="19" height="23" border="0" /></a></span></td>
                      <td width="8%" align="center" bgcolor="#1c0801" ><span class="sidemenu"><a href="?d_sub_id=<?=$db->f(id_sub_catalog)?>"  onclick="return confirm('ยืนยันการลบข้อมูล')"><img src="images/del.gif" alt="ลบ" width="19" height="23" border="0" /></a></span></td>
                    </tr>
                    <?php  

		$q1="SELECT * FROM `pra_catalog` WHERE id_top_catalog=".$db->f(id_sub_catalog)." ";
		$db5=new nDB();
		$db5->query($q1);
		static $v=1;
		if($db5->num_rows()!=0){
			
		while($db5->next_record()){
?>
                    <tr  bgcolor="<?=($v%2==1)?"#3c1204":"#2f0d02"?>">
                      <td ><span class="sidemenu">
                        --- <?=$db5->f(name_catalog)?>
                      </span></td>
                      <td width="8%" align="center" ><span class="sidemenu"><a href="?e_sub_id=<?=$db5->f(id_sub_catalog)?>" ><img src="images/edit.gif" alt="แก้ไข" width="19" height="23" border="0" /></a></span></td>
                      <td width="8%" align="center" ><span class="sidemenu"><a href="?d_sub_id=<?=$db5->f(id_sub_catalog)?>"  onclick="return confirm('ยืนยันการลบข้อมูล')"><img src="images/del.gif" alt="ลบ" width="19" height="23" border="0" /></a></span></td>
                    </tr>
                    <?php $v++; ?>
                    <?php } } }  ?>
                  </table>
                </td>
                                  </tr>
                                </table>        
        </td>
      </tr>
    </table></td>
  </tr>
</table>
</body>
</html>
