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
    <td><img src="/admin/images/head.jpg" width="1098" height="288" /></td>
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
		$db->query($q);
		$q="UPDATE `shipping` SET `name` = '".$_POST['name']."' , `amount` = '".$_POST['amount']."' WHERE shipping_id='".$_POST['h_sub_id']."' ";
		$db->query($q);			
		al('แก้ไขข้อมูลเรียบร้อยแล้ว');
		redi2();
		}else{				
		$q="INSERT INTO `shipping` ( `shipping_id` ,`name` , `amount`) 
VALUES (
'', '".$_POST['name']."', '".$_POST['amount']."'
);";
		$db->query($q);
		al('เพิ่มข้อมูลเรียบร้อยแล้ว');
		redi4('shipping.php');
		}
	}
?>
<?php
	if($_GET['d_sub_id']){	
		$q="DELETE FROM `shipping` WHERE `shipping_id` = ".$_GET['d_sub_id']." ";
		$db->query($q);
	}
?>
<?php
	if($_GET['e_sub_id']){
		$q="SELECT * FROM `shipping` WHERE shipping_id=".$_GET['e_sub_id']." ";
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
                  <?php
					  $conn = mysql_connect("localhost","prathai_new","twe31219#");
					  mysql_select_db("prathai_new",$conn);
					  mysql_query("SET NAMES UTF8");
					  mysql_query("SET character_set_results=utf8");
					  mysql_query("SET character_set_client=utf8");
					  mysql_query("SET character_set_connection=utf8");
				  ?>
				  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
				  <script>
					  function select_geo(x_this){
						  var v_this = x_this.val();
						  $(".province_select option:eq(0)").prop("selected","selected");
						  $(".catalog_select option:eq(0)").prop("selected","selected");
						  $(".province_select").find(".province_option").remove();
						  $(".province_select").append( $(".province_option_container").find(".province_"+v_this).clone(true) );
					  }
					  function select_province(x_this){
						  var v_this = x_this.val();
						  $(".catalog_select option:eq(0)").prop("selected","selected");
						  $(".catalog_select").find(".catalog_option").remove();
						  $(".catalog_select").append( $(".catalog_option_container").find(".catalog_"+v_this).clone(true) );
					  }
				  </script>
                    <tr>
                      <td height="25" colspan="2" align="center" bgcolor="#4d1403" class="style11" ><span class="sidemenu">เพิ่ม แก้ไขวิธีการส่งสินค้า</span></td>
                    </tr>
                    <tr>
                      <td width="27%" align="right" bgcolor="#3c1204" class="style11" style="padding-right:3px"><span class="sidemenu">วิธีการส่งสินค้า :</span></td>
                      <td width="73%" bgcolor="#3c1204"><span class="sidemenu">
                        <input name="name" type="text"  id="name" value="<?=($_GET['e_sub_id'])?$db5->f(name):""?>" size="45" />
                        </span></td>
                    </tr>
                    <tr>
                      <td width="27%" align="right" bgcolor="#3c1204" class="style11" style="padding-right:3px"><span class="sidemenu">จำนวนเงิน :</span></td>
                      <td width="73%" bgcolor="#3c1204"><span class="sidemenu">
                        <input name="amount" type="text"  id="amount" value="<?=($_GET['e_sub_id'])?$db5->f(amount):""?>" size="15" />
                        บาท</span></td>
                    </tr>                                        
                    <tr>
                      <td bgcolor="#3c1204">&nbsp;</td>
                      <td bgcolor="#3c1204"><input name="Submit" type="submit" class="button_add"  value="<?=($_GET['e_sub_id'])?"แก้ไขหมวดข้อมูล":"เพิ่มหมวดข้อมูล"?>" />
                        <?php if($_GET['e_sub_id']){ ?>
                        <input name="h_name" type="hidden" id="h_name" value="<?=$db5->f(name)?>" />
                        <input name="h_amount" type="hidden" id="h_amount" value="<?=$db5->f(amount)?>" />					                        	  
                        <?php } ?>                      </td>
                    </tr>
                  </table>
				  </form>
				  <br />
				  <table width="96%" border="0" align="center" cellpadding="3" cellspacing="1">
                    <tr class="sidemenu">
                      <td height="25" align="center" bgcolor="#4d1403" class="style11" >วิธีการส่งสินค้า</td>
                      <td align="center" bgcolor="#4d1403" class="style11" >แก้ไข</td>
                      <td align="center" bgcolor="#4d1403" class="style11" >ลบ</td>
                    </tr>
                    <?php  

		$q1="SELECT * FROM `shipping` WHERE 1 ORDER BY amount ";
		$db5=new nDB();
		$db5->query($q1);
		static $v=1;
		while($db5->next_record()){
?>
                    <tr  bgcolor="<?=($v%2==1)?"#3c1204":"#2f0d02"?>">
                      <td style="color:#FFF" ><?=$db5->f(name)?> <?=$db5->f(amount)?> บาท</td>
                      <td width="8%" align="center" ><span class="sidemenu"><a href="?e_sub_id=<?=$db5->f(shipping_id)?>" ><img src="images/edit.gif" alt="แก้ไข" width="19" height="23" border="0" /></a></span></td>
                      <td width="8%" align="center" ><span class="sidemenu"><a href="?d_sub_id=<?=$db5->f(shipping_id)?>"  onclick="return confirm('ยืนยันการลบข้อมูล')"><img src="images/del.gif" alt="ลบ" width="19" height="23" border="0" /></a></span></td>
                    </tr>
                    <?php $v++; ?>
                    <?php }    ?>
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