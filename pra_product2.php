<? include('../global.php')?>
<?php if($_SESSION['adminid']=='' || !isset($_SESSION['adminid'])) {  
        redi4("login.php");
} ?>
<?php set_page($s_page,$e_page=20); //นำส่วนนี้ิไว้ด้านบน ?>
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
	font-size:12px;
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
<?php
	if($_GET['d_product_id']){
		@unlink("img/amulet/".$_GET['pic1']);
		@unlink("img/amulet/".$_GET['pic2']);		
		@unlink("img/amulet/".$_GET['pic3']);		
		@unlink("img/amulet/".$_GET['pic4']);						
		$q="DELETE FROM `product` WHERE `product_id` = ".$_GET['d_product_id']." ";
		$db->query($q);		
	}
?>
			<?php
	if($_GET['hot_id']){
		$q="update `jew_product` set status='".$_GET['status']."' WHERE `id` =".$_GET['hot_id']." ";
		$db->query($q);
		redi2();				
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
<table width="100%" border="0" cellspacing="0" cellpadding="3">
                                  <tr>
<td width="720" valign="top" bgcolor="#592D03"><table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
                  <tr>
                    <td>
				<script language="javascript">
					function selec(){
						var ab=document.getElementById('se');
						location.href=ab.value;
					}
				</script>
						  <?php
	if($_POST['Submit']){
		if($_POST['h_product_id']){
		$q="UPDATE `pra_product2` SET `name_catalog` = '".$_POST['name_catalog']."',
`tag_product` = '".$_POST['tag_product']."',
`code_product` = '".$_POST['code_product']."',
`name_product` = '".$_POST['name_product']."',
`detail_product` = '".$_POST['detail_product']."',
`status` = '".$_POST['status']."',
`price` = '".$_POST['price']."' WHERE `id_product` =".$_POST['h_product_id']." ";
		$db->query($q);
				for($mf=1;$mf<=5;$mf++){
				 $upf[$mf]=uppic($_FILES['file'.$mf],$mf,"../upimg/product/",$_POST['h_pic'.$mf]); // Same folder
					 if($upf[$mf]!=''){
				 $q="UPDATE `pra_product2` SET `pic$mf` = '".$upf[$mf]."' WHERE `id_product` =".$_POST['h_product_id']." ";
						 $db->query($q);
					 }	
				}			
		al('แก้ไขข้อมูลเรียบร้อยแล้ว');
		redi2();
		}else{
		$q="INSERT INTO `pra_product2` ( `id_product` , `name_catalog` , `code_product` , `tag_product`  , `name_product` , `detail_product` , `price` , `pic1` , `pic2`, `pic3` , `pic4`, `pic5`, `status`, `view_num`) 
VALUES (
'', '".$_POST['name_catalog']."', '".$_POST['code_product']."', '".$_POST['tag_product']."', '".$_POST['name_product']."', '".$_POST['detail_product']."', '".$_POST['price']."', '' , '' , '' , '' , '' , '".$_POST['status']."','0');";
		$db->query($q);
				for($mf=1;$mf<=5;$mf++){
				 $upf[$mf]=uppic($_FILES['file'.$mf],$mf,"../upimg/product/",$_POST['h_pic'.$mf]); // Same folder
					 if($upf[$mf]!=''){
				$q="SELECT * FROM `pra_product2`ORDER BY id_product DESC";
				$db->query($q);
				$db->next_record();	 
				$id_product=$db->f(id_product);
				 $q="UPDATE `pra_product2` SET `pic$mf` = '".$upf[$mf]."' WHERE `id_product` =".$id_product." ";
						 $db->query($q);
					 }				
			}
		al('เพิ่มข้อมูลเรียบร้อยแล้ว');
		redi2();		
		}
	}
?>
<?php
	if($_GET['d_product_id']){
		@unlink("../upimg/product/".$_GET['pic1']);
		@unlink("../upimg/product/".$_GET['pic2']);		
		@unlink("../upimg/product/".$_GET['pic3']);		
		@unlink("../upimg/product/".$_GET['pic4']);		
		@unlink("../upimg/product/".$_GET['pic5']);								
		$q="DELETE FROM `pra_product2` WHERE `id_product` = ".$_GET['d_product_id']." ";
		$db->query($q);		
	}
?>
<?php
	if($_GET['e_product_id']){
		$q="SELECT * FROM `pra_product2` WHERE id_product=".$_GET['e_product_id']." ";
		$db5=new nDB();
		$db5->query($q);
		$db5->next_record();
	}
?>
                  <form action="" method="post" enctype="multipart/form-data" name="form1" id="form1">
                    <br />
                    <table width="95%" border="0" align="center" cellpadding="3" cellspacing="0" style="border:1px #8C3F17 solid" >
                      <tr>
                        <td height="25" colspan="2" align="right" bgcolor="#4d1403" ><span class="sidemenu">All field are required.</span></td>
                      </tr>
                      <tr>
                        <td width="23%" bgcolor="#3c1204">&nbsp;</td>
                        <td width="77%" bgcolor="#3c1204">&nbsp;</td>
                      </tr>
                      <tr>
                        <td align="right" bgcolor="#3c1204"  style="padding-right:3px"><span class="sidemenu">หมวดหมู่สินค้า / 产品类型</span></td>
                        <td align="left" valign="top" bgcolor="#3c1204">
                          <span class="sidemenu">
                          <select name="name_catalog"  id="name_catalog" style="width:400px" >
                            <option value="" selected="selected">--Select Catalog--</option>
                            <?php
					  $q="SELECT * FROM `pra_catalog2` WHERE id_top_catalog=0 ORDER BY id_sub_catalog ";
					  $db->query($q);
					  while($db->next_record()){
					  ?>
                            <option value="<?=$db->f(id_sub_catalog)?>"
					  <?php
					  if($_GET['e_product_id']){
					  		if($db5->f(name_catalog)==$db->f(id_sub_catalog)){
								echo 'selected="selected"';
							}
					  }
					  ?>
					  >
                              <?=$db->f(name_catalog)?>
                              </option>
                            <?php
							$q1="SELECT * FROM `pra_catalog2` WHERE id_top_catalog=".$db->f(id_sub_catalog)." ";
							$db7=new nDB();
							$db7->query($q1);
							if($db7->num_rows()!=0){
							while($db7->next_record()){
					?>
                            <option value="<?=$db7->f(id_sub_catalog)?>"
					<?php
					if($_GET['e_product_id']){
						if($db7->f(id_sub_catalog)==$db5->f(name_catalog)){
							echo 'selected="selected"';
						}
					}
					?>
					>---
                              <?=$db7->f(name_catalog)?>
                              </option>
                            <?php } } } ?>
                          </select>
                          </span></td>
                      </tr>
                      <tr>
                        <td align="right" bgcolor="#3c1204" class="style11"  style="padding-right:3px"><span class="sidemenu">รหัสสินค้า / 产品代码</span></td>
                        <td align="left" valign="top" bgcolor="#3c1204"><span class="sidemenu">
                          <input name="code_product" type="text"  id="code_product" value="<?=($_GET['e_product_id'])?$db5->f(code_product):""?>" size="50" />
                        </span></td>
                      </tr>
                      <tr>
                        <td align="right" bgcolor="#3c1204" class="style11"  style="padding-right:3px"><span class="sidemenu">Tag Keywords</span></td>
                        <td align="left" valign="top" bgcolor="#3c1204"><span class="sidemenu">
                          <input name="tag_product" type="text"  id="tag_product" value="<?=($_GET['e_product_id'])?$db5->f(tag_product):""?>" size="50" />
                        </span></td>
                      </tr>
                      <tr>
                        <td align="right" bgcolor="#3c1204" class="style11"  style="padding-right:3px"><span class="sidemenu">ชื่อสินค้า / 产品名</span></td>
                        <td align="left" valign="top" bgcolor="#3c1204"><span class="sidemenu">
                          <input name="name_product" type="text"  id="name_product" value="<?=($_GET['e_product_id'])?$db5->f(name_product):""?>" size="50" />
                        </span></td>
                      </tr>
                      <tr>
                        <td align="right" bgcolor="#3c1204" class="style11"  style="padding-right:3px"><span class="sidemenu">ราคา / 价格</span></td>
                        <td align="left" valign="top" bgcolor="#3c1204"><span class="sidemenu">
                          <input name="price" type="text"  id="price" value="<?=($_GET['e_product_id'])?$db5->f(price):""?>" size="10" />
                        </span></td>
                      </tr>             
                      <tr>
                      <td align="right" bgcolor="#3c1204"><span class="sidemenu">สถานะ / </span></td>
                      <td bgcolor="#3c1204"><span class="sidemenu">
                        <select name="status" id="status">
                          <option value="rent">ให้เช่า / 出售</option>
                          <option value="sold">ขายแล้ว / 已出售</option>
                          <option value="show">โชว์ / 展示</option>
                          <option value="reservation">เปิดจอง / 定牌</option>
                        </select>
                      </span></td>
                      </tr>
                      <tr>
                        <td height="25" colspan="2" align="center" bgcolor="#3c1204" class="style11"><span class="sidemenu">ข้อความอย่างย่อ แสดงหน้ารายการพระ </span></td>
                      </tr>
                      <tr>
                        <td height="25" colspan="2" align="center" bgcolor="#3c1204" class="style11"><span class="sidemenu">Message Detail </span></td>
                      </tr>
                      <tr>
                        <td colspan="2" align="center" bgcolor="#3c1204" class="style11">	                            <span class="sidemenu">
                          <textarea id="detail_product" name="detail_product"><?=($_GET['e_product_id'])?$db5->f(detail_product):"&nbsp;"?></textarea>
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
                                            oEdit2.REPLACE("detail_product");
                            </script>	                            
                          </span></td>
                      </tr>
                      <tr>
                        <td align="right" bgcolor="#3c1204" class="style11"  style="padding-right:3px; border-bottom:#592D03 1px solid">
						  <span class="sidemenu">
						  <?php if($_GET['e_product_id']){ ?>						
						  <img src="<?=($db5->f(pic1)!="")?"../upimg/product/".$db5->f(pic1):"../images/clear.gif"?>" width="60" height="67"  border="0" /> Picture 1 </span></td>
						<?php } ?>
                        <td align="left" valign="bottom" bgcolor="#3c1204" class="style11"   style="padding-right:3px; border-bottom:#592D03 1px solid">
                          <span class="sidemenu">
                          <input name="file1" type="file" id="file1" />
                          Width less than 700 pixel Maximum size 200 kb</span></td>
                      </tr>
                      <tr>
                        <td align="right" bgcolor="#3c1204" class="style11"    style="padding-right:3px; border-bottom:#592D03 1px solid">
						  <span class="sidemenu">
						  <?php if($_GET['e_product_id']){ ?>						
						  <img src="<?=($db5->f(pic2)!="")?"../upimg/product/".$db5->f(pic2):"../images/clear.gif"?>" width="60" height="60"  border="0" /> Picture 2 </span></td>
						<?php } ?>
                        <td align="left" valign="bottom" bgcolor="#3c1204" class="style11"  style="padding-right:3px; border-bottom:#592D03 1px solid">
                          <span class="sidemenu">
                          <input name="file2" type="file" id="file2" />
                          Width less than 700 pixel Maximum size 200 kb</span></td>
                      </tr>
                      <tr>
                        <td align="right" bgcolor="#3c1204" class="style11"  style="padding-right:3px; border-bottom:#592D03 1px solid">
						  <span class="sidemenu">
						  <?php if($_GET['e_product_id']){ ?>						
						  <img src="<?=($db5->f(pic3)!="")?"../upimg/product/".$db5->f(pic3):"../images/clear.gif"?>" width="60" height="60"  border="0" /> Picture 3 </span></td>
						<?php } ?>
                        <td align="left" valign="bottom" bgcolor="#3c1204" class="style11"  style="padding-right:3px; border-bottom:#592D03 1px solid">
                          <span class="sidemenu">
                          <input name="file3" type="file" id="file3" />
                          Width less than 700 pixel Maximum size 200 kb</span></td>
                      </tr>
                      <tr>
                        <td align="right" bgcolor="#3c1204" class="style11"  style="padding-right:3px; border-bottom:#592D03 1px solid">
						  <span class="sidemenu">
						  <?php if($_GET['e_product_id']){ ?>						
						  <img src="<?=($db5->f(pic4)!="")?"../upimg/product/".$db5->f(pic4):"../images/clear.gif"?>" width="60" height="60"  border="0" /> Picture 4 </span></td>
						<?php } ?>
                        <td align="left" valign="bottom" bgcolor="#3c1204" class="style11"  style="padding-right:3px; border-bottom:#592D03 1px solid">
                          <span class="sidemenu">
                          <input name="file4" type="file" id="file4" />
                          Width less than 700 pixel Maximum size 200 kb</span></td>
                      </tr>
                      <tr>
                        <td align="right" bgcolor="#3c1204" class="style11"   style="padding-right:3px; border-bottom:#592D03 1px solid">
						  <span class="sidemenu">
						  <?php if($_GET['e_product_id']){ ?>						
						  <img src="<?=($db5->f(pic5)!="")?"../upimg/product/".$db5->f(pic5):"../images/clear.gif"?>" width="60" height="60"  border="0" /> Picture 5 </span></td>
						<?php } ?>
                        <td align="left" valign="bottom" bgcolor="#3c1204" class="style11"  style="padding-right:3px; border-bottom:#592D03 1px solid">
                          <span class="sidemenu">
                        <input name="file5" type="file" id="file5" />
                        Width less than 700 pixel Maximum size 200 kb </span></td>
                      </tr>		             					  		  					  					  					  
                      <tr>
                      <td bgcolor="#3c1204">&nbsp;</td>
                      <td bgcolor="#3c1204">&nbsp;</td>
                      </tr>
                      <tr>
                      
                        <td bgcolor="#3c1204">&nbsp;</td>
                        <td bgcolor="#3c1204"><span class="sidemenu">
                          <input name="Submit" type="submit" class="button_add" value="<?=($_GET['e_product_id'])?"Edit":"Add"?>" />
                            <?php if($_GET['e_product_id']){ ?>
                            <input name="h_product_id" type="hidden" id="h_product_id" value="<?=$db5->f(id_product)?>" />
                  <input name="h_pic1" type="hidden" id="h_pic1" value="<?=$db5->f(pic1)?>">
				  <input name="h_pic2" type="hidden" id="h_pic2" value="<?=$db5->f(pic2)?>">
                            <?php } ?>                        
                        </span></td>
                      </tr>
                    </table></form>
                    <br />
                    <br />
                    <table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
<tr>
                            <td height="25" colspan="6" align="center" bgcolor="#4d1403" class="best8">					        					        <form action="pro_set.php" method="post" name="sho" target="pro_frm" id="sho">
					          <div align="right"><span class="sidemenu" id="za_mo1">ค้นหาสินค้าตามหมวดหมู่</span>
					              <span class="sidemenu">
                                          <select name="pro_catalog" class="box_from3" id="pro_catalog">
                                            <option value="0" selected="selected">แสดงสินค้าทั้งหมด</option>
                                            <option value="">--------------</option>							  
                                            <?php
					$q="SELECT * FROM `pra_catalog2` WHERE id_top_catalog=0 ORDER BY id_sub_catalog";
					$db->query($q);
					while($db->next_record()){
					?>
                                            <option value="<?=$db->f(name_catalog)?>"
					<?php
					if($_SESSION['pro_catalog']){
						if($db->f(name_catalog)==$_SESSION['pro_catalog']){
								echo 'selected="selected"';
						}
					}
					?>
					>
                                            <?=$db->f(name_catalog)?>
                                            </option>		
                                            
                                            <?

							$q1="SELECT * FROM `pra_catalog2` WHERE id_top_catalog=".$db->f(id_sub_catalog)." ";
							$db5=new nDB();
							$db5->query($q1);
							if($db5->num_rows()!=0){
							while($db5->next_record()){
					?>				
                                            <option value="<?=$db5->f(name_catalog)?>"
					<?php
					if($_SESSION['pro_catalog']){
						if($db5->f(name_catalog)==$_SESSION['pro_catalog']){
								echo 'selected="selected"';
						}
					}
					?>					
					>--- 
                                            <?=$db5->f(name_catalog)?>
                                            </option>			
                                            <?php  } } }  ?>	
                                          </select>
                                          <input name="Submit" type="submit" class="bt_zabi" value="Go" />
				                </span></div>
					        </form>		
							  <span class="sidemenu">
							  <iframe src="" name="pro_frm" width="1px;" height="0px;" frameborder="0" id="pro_frm"></iframe>	  		
                            </span></td>
                            </tr>
                      <tr>
                        <td width="23%" height="35" align="center" bgcolor="#4d1403" class="style11" ><span class="sidemenu">Picture</span></td>
                        <td width="38%" align="center" bgcolor="#4d1403" class="style11" ><span class="sidemenu">Name</span></td>
                        <td align="center" bgcolor="#4d1403" class="style11"><span class="sidemenu">Price</span></td>
                        <td align="center" bgcolor="#4d1403" class="style11"><span class="sidemenu">Edit</span></td>
                        <td align="center" bgcolor="#4d1403" class="style11"><span class="sidemenu">Delete</span></td>
                      </tr>
     <?php
   $q="SELECT * FROM `pra_product2` WHERE 1 ";
   $p_r=1;
   if($_SESSION['pro_catalog']){
   		$q.=" AND  name_catalog='".$_SESSION['pro_catalog']."' ";
   }
  if($_POST['q'] or $_SESSION['search_product']){ //มีการค้นหา
   		if($_SESSION['search_product']){
			$_POST['q']=$_SESSION['search_product'];
		}
   		$q.=" AND  code_product like  '%".$_POST['q']."%' or name_product like '%".$_POST['q']."%' or name_catalog like '%".$_POST['q']."%' ";
   }

  $db->query($q);							
  $total=$db->num_rows();							
  $q.=" ORDER BY id_product DESC LIMIT $s_page,$e_page ";
  $db->query($q);
  static $v=1; 
   while($db->next_record()){
   ?>		
                      <tr class="sidemenu"  bgcolor="<?=($v%2==1)?"#3c1204":"#2f0d02"?>">
                        <td height="100" align="center"><img src="<?=($db->f(pic1)!="")?"../resize/w90-h90-c1:1/upimg/product/".$db->f(pic1):"../images/clear.gif"?>" width="90" height="90"  border="0" /></td>
                        <td><span style="color:#FFFFFF; font-size:12px"><?=$db->f(name_product)?></span></td>
                        <td width="11%" align="right" style="padding-right:3px;"><span style="color:#FFFFFF; font-size:12px"><?=g_number($db->f(price))?></span></td>
                        <td width="7%" align="center"><a href="?e_product_id=<?=$db->f(id_product)?>" ><img src="images/edit.gif" alt="แก้ไข" width="19" height="23" border="0" /></a></td>
                        <td width="10%" align="center"><a href="?d_product_id=<?=$db->f(id_product)?>&amp;pic=<?=$db->f(pic)?>" onClick="return confirm('ยืนยันการลบข้อมูล')"><img src="images/del.gif" alt="ลบ" width="19" height="23" border="0" /></a></td>
                      </tr><?php $v++; ?>
                      <?php } ?>     
                      <tr>
                      <td height="30" colspan="6" align="center"> <?php  sh_page($total,$s_page,$e_page,$chk_page,Previous,Next,"#ffffff","#FFFFFF"); // นำไปวางในตำแหน่งที่ต้องการแสดง ?></td>
                      </tr>           
                    </table>
                    <p>&nbsp;</p>
                  </form>
                </td>
                  </tr>
                </table></td>
                                  </tr>
                                </table>        
        </td>
      </tr>
    </table></td>
  </tr>
</table>
</body>
</html>
