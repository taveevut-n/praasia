<?php
	include("global.php");
		if ($_GET['id']){
			$_SESSION['adminshop_id'] = $_GET['id'];
		}
		
		if( $_SESSION["adminshop_id"] == "" || !isset($_SESSION["adminshop_id"]) ) {  
		redi4("index.php");
	}
	?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>
			ระบบจัดการเว็บไซต์  : จัดการสินค้า
		</title>
		<link rel="shortcut icon" href="favicon.ico" />
		<link rel="favicon" href="favicon.ico" />
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<!--jquery ui Local-->
		<link rel="stylesheet" href="func/jquery-ui-1.10.3/themes/base/jquery-ui.css" />
		<script src="func/jquery-ui-1.10.3/jquery-1.9.1.js"></script>
		<script src="func/jquery-ui-1.10.3/ui/jquery-ui.js"></script>
        <script src="ieditor/ckeditor.js"></script> 
		<style type="text/css">
			html, body {
				margin:0px;
				padding:0px;
				width:100%;
				height:100%;
			}
			body {
				background-color:#000000;
			}
			body,td,th {
				font-family: Arial, Helvetica, sans-serif;
				font-size: 12px;
				color: #FFF;
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
			table{
				border-collapse:collapse;
			}
			.flat_textbox {
				padding-left:0px;
				padding-right:0px;
				height:17px;
				font-family:Tahoma;
				font-size:12px;
				color:#444444;
				background-color:#ffffff;
				-webkit-box-sizing: border-box;
				-moz-box-sizing: border-box;
				box-sizing: border-box;
				border:0px solid transparent;
				outline:none;
			}
		</style>
		<script type="text/javascript">
			function MM_swapImgRestore() { //v3.0
				var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
			}
			function MM_preloadImages() { //v3.0
				var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
				var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
				if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
			}
			function MM_findObj(n, d) { //v4.01
				var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
				d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
				if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
				for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
				if(!x && d.getElementById) x=d.getElementById(n); return x;
			}
			function MM_swapImage() { //v3.0
				var i,j=0,x,a=MM_swapImage.arguments; document.MM_sr=new Array; for(i=0;i<(a.length-2);i+=3)
				if ((x=MM_findObj(a[i]))!=null){document.MM_sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];}
			}
		</script>
	</head>
	<body onLoad="MM_preloadImages('images/images/menu-backend2_02.jpg','images/images/menu-backend2_04.jpg','images/images/menu-backend2_05.jpg','images/images/menu-backend2_06.jpg','images/images/menu-backend2_07.jpg','images/images/menu-backend2_08.jpg')">
		<?php
	if($_GET['d_data_id']){
		$q="DELETE FROM `content_certificate` WHERE `content_id` =".$_GET['d_data_id']." ";
		$db->query($q);				
	}
?>
		<?php 
            if($_POST['Submit']){
                if($_POST['h_data_id']==''){		
                    
                        $q="INSERT INTO `content_certificate` ( `content_id` ,  `mem_id` , `name` , `detail`) 	
                        VALUES (	'', '".$_SESSION['adminshop_id']."', '".$_POST['name']."' , '".$_POST['detail']."' );";
                        $db->query($q);
                            for($mf=1;$mf<=9;$mf++){
                                $upf[$mf] = uppic($_FILES['file'.$mf],$mf,"../img/content_certificate/",$_POST['h_pic'.$mf]); // Same folder
                                if($upf[$mf]!=''){
                                    $q = "SELECT * FROM `content_certificate`ORDER BY content_id DESC";
                                    $db->query($q);
                                    $db->next_record();	 
                                    $content_id=$db->f(content_id);
                                    $q = "UPDATE `content_certificate` SET `pic$mf` = '".$upf[$mf]."' WHERE `content_id` =".$content_id." ";
                                    $db->query($q);
                                }
                            }	
  
                al('Add Complete');
                redi2();
                }else{
                    
                        $q="UPDATE `content_certificate` SET `name` = '".$_POST['name']."' ,
                        `detail` = '".$_POST['detail']."'  WHERE `content_id` =".$_POST['h_data_id']." ";
                        $db->query($q);
                            for($mf=1;$mf<=9;$mf++){
                                $upf[$mf] = uppic($_FILES['file'.$mf],$mf,"../img/content_certificate/",$_POST['h_pic'.$mf]); // Same folder
                                if($upf[$mf]!=''){
                                    $q = "SELECT * FROM `content_certificate`ORDER BY content_id DESC";
                                    $db->query($q);
                                    $db->next_record();	 
                                    $content_id=$db->f(content_id);
                                    $q = "UPDATE `content_certificate` SET `pic$mf` = '".$upf[$mf]."' WHERE `content_id` =".$content_id." ";
                                    $db->query($q);
                                }
                            }
            al('Edit Complete');
            redi2();							
                }			
            }
        ?>
		<table width="1000px" align="center" border="0" cellpadding="0" cellspacing="0">     
            <tr>
				<td>
					<img src="images/defualt.jpg" width="1000" height="271">
				</td>
			</tr>
			<tr>
				<td height="180px" valign="top"  bgcolor="#311407"><table width="1000" border="0" cellspacing="0" cellpadding="0">
				  <tr>
				    <td width="200" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="3">
				      <tr>
				        <td height="25" bgcolor="#3c1204"><a href="referee_content.php"><span style="color:#FFF">- รายการทังหมด / 总共项目</span></a></td>
			          </tr>
				      <tr>
				        <td height="25" bgcolor="#6c2c16"><a href="referee_confirm.php"><span style="color:#FFF">- อนุมัติแล้ว / 己审批</span></a></td>
			          </tr>
				      <tr>
				        <td height="25" bgcolor="#3c1204"><a href="referee_cancel.php"><span style="color:#FFF">- ไม่ผ่านการอนุมัติ</span></a></td>
			          </tr>
				      <tr>
				        <td height="25" bgcolor="#6c2c16"><a href="content_referee.php"><span style="color:#FFF">- เพิ่มข้อมูล</span></a></td>
			          </tr>
				      <tr>
				        <td height="25" bgcolor="#3c1204">&nbsp;</td>
			          </tr>
			        </table></td>
				    <td width="800" valign="top" style="padding:5px">
<table width="98%" border="0" align="center" cellpadding="0" cellspacing="3" bordercolor="#FFFFFF">
                          <tr class="bh">
                            <td width="18%" height="25" align="center" bgcolor="#4d1403" class="style11" >รูปภาพ</td>
                            <td width="29%" height="25" align="center" bgcolor="#4d1403" class="style11" >ขื่อพระ</td>
                            <td width="30%" height="25" align="center" bgcolor="#4d1403" class="style11" >ผลการตรวจ</td>
                            <td height="25" align="center" bgcolor="#4d1403" class="style11" >แก้ไข</td>
                            <td height="25" align="center" bgcolor="#4d1403" class="style11" >ลบ</td>
                          </tr>
						  <?php 
						  	$q="SELECT * FROM `content_certificate` WHERE mem_id = '".$_SESSION['adminshop_id']."' ORDER BY content_id DESC";
							$db->query($q);
							static $v=1;
							while($db->next_record()){

							$pic_pre = mysql_result(mysql_query("SELECT collection_img FROM collection WHERE content_id = '".$db->f(content_id)."' ORDER BY collection_order ASC LIMIT 1 "), 0);

						  ?>
                          <tr bgcolor="<?=($v%2==0)?"#3c1204":"#3c1204"?>">
                            <td height="110" align="center" bgcolor="#3c1204"><img src="../slir/w100-h100/img/referee_collect/<?=$pic_pre?>" width="60" height="86" /></td>
                            <td align="center" style="color:#FC0; font-size:12px" bgcolor="#3c1204"><?=$db->f(name)?></td>
                            <td align="center" bgcolor="#3c1204" style="color:#FC0; font-size:12px">
							<? if ($db->f(status)=='0') { ?>
                            <span style="color:#F90; font-size:12px">กำลังตรวจสอบ</span>
                            <? } ?>
							<? if ($db->f(status)=='1') { ?>
                            <span style="color:#0C0; font-size:12px">ผ่าน</span>
                            <? } ?>
							<? if ($db->f(status)=='2') { ?>
                            <span style="color:#F00; font-size:12px">ไม่ผ่าน</span>  
                            <? } ?>                                                                                 
                            </td>
                            <td width="12%" align="center" bgcolor="#3c1204"><a href="content_referee.php?e_data_id=<?=$db->f(content_id)?>" ><img src="../images/edit.gif" alt="แก้ไข" width="19" height="23" border="0" /></a></td>
                            <td width="11%" align="center" bgcolor="#3c1204"><a href="?d_data_id=<?=$db->f(content_id)?>" onclick='return confirm("ยืนยันการลบใช่หรือไม่");' ><img src="../images/del.gif" alt="แก้ไข" width="19" height="23" border="0" /></a></td>
                     </tr>
						  <?php $v++; } ?>
      </table>                    
                    
                    </td>
			      </tr>
				  </table>
					
				</td>
			</tr>
			<tr>
				<td height="40" align="center" bgcolor="#333333">
					<?php include('footer.php');?>
				</td>
			</tr>
		</table>
		<!-- End Save for Web Slices -->
	</body>
</html>
