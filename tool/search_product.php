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
		//redi2("product.php?s_page=".$_GET['s_page']);				
		echo "<script>window.location.href='product.php?s_page=".$_GET['s_page']."';</script>";
	}
?>	
			<?php
	if($_GET['certificate_id']){
		$q="update `product` set certificate='".$_GET['status']."' , `certificatedate` = '".date("Y-m-d H:i:s")."' WHERE `product_id` =".$_GET['certificate_id']." ";
		$db->query($q);
		//redi2("product.php?s_page=".$_GET['s_page']);		
		echo "<script>window.location.href='product.php?s_page=".$_GET['s_page']."';</script>";
	}
?>	
			<?php
	if($_GET['recommend_id']){
		$q="update `product` set recommend='".$_GET['status']."' , `hotdate` = '".date("Y-m-d H:i:s")."' WHERE `product_id` =".$_GET['recommend_id']." ";
		$db->query($q);
		//redi2("product.php?s_page=".$_GET['s_page']);				
		echo "<script>window.location.href='product.php?s_page=".$_GET['s_page']."';</script>";
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
        <form action="search_product.php" method="post">
        <table width="95%" align="center" cellpadding="3" cellspacing="0">
        	<tr>
            	<td width="36%" align="right" bgcolor="#692908"><span style="color:#FC0; font-size:12px">ค้นหา</span></td>
            	<td width="54%" bgcolor="#692908"><input name="q" type="text" id="q" size="60" /></td>
            	<td width="10%" bgcolor="#692908"><input name="ค้นหา" type="submit" id="ค้นหา" value="ค้นหา" /></td>
            </tr>
        </table>
        </form>
        <br />
        <table width="95%" border="0" align="center" cellpadding="3" cellspacing="1">
          <tr class="bh">
		    <td width="55" height="25" align="center" bgcolor="#692908">No.</td>
		    <td width="129" align="center" bgcolor="#692908">รูปภาพ</td>
		    <td width="204" align="center" bgcolor="#692908">ชื่อ</td>
		    <td width="74" align="center" bgcolor="#692908">ราคา</td>
		    <td width="70" align="center" bgcolor="#692908">สถานะ</td>
		    <td width="77" align="center" bgcolor="#692908">ลงวันที่</td>
		    <td width="70" align="center" bgcolor="#692908">สินค้าติดใบรับรอง</td>
		    <td width="79" align="center" bgcolor="#692908">สินค้าแนะนำ</td>
		    <td width="60" align="center" bgcolor="#692908">ลบ</td>
	      </tr>
               <?php
	$q="SELECT * FROM `member` WHERE id='".$_SESSION['shop_id']."' ";
	$db->query($q);
	$db->next_record();
	$shop_id = $db->f(id);			   
   $q="SELECT * FROM `product` WHERE product_id like '%".$_POST['q']."%' ";
  $db->query($q);							
  $total=$db->num_rows();							
  $q.=" ORDER BY product_id DESC LIMIT $s_page,$e_page ";
  $db->query($q);
  static $v=1; 
   while($db->next_record()){
   ?>		
		  <tr bgcolor="<?=($v%2==1)?"#311407":"#4f3b2a"?>" class="sidemenu">
		    <td height="25" align="center">
	        <?=$db->f(product_id)?></td>
		    <td align="center">
            <a href="http://www.praasia.com/shop_product.php?product_id=<?=$db->f(product_id)?>" target="_blank">
            <img src="/slir/w125-h125-c1:1/img/amulet/<?=$db->f(pic1)?>" width="125" height="125" border="0" />
            </a>
            </td>
		    <td align="left"><?=$db->f(name)?></td>
		    <td align="center"><?=$db->f(price)?></td>
		    <td align="center" class="sidemenu">
			<? if ($db->f(status)=='1') { ?>
            พระโชว์
            <? } ?>
			<? if ($db->f(status)=='2') { ?>
            ให้เช่า
            <? } ?>
			<? if ($db->f(status)=='3') { ?>
            จอง
            <? } ?>
			<? if ($db->f(status)=='4') { ?>
            ขายแล้ว
            <? } ?>                                    
            </td>
		    <td align="center"><?=date("d-m-Y",$db->f(date_add))?></td>
		    <td align="center">
			<? if($db->f(certificate)=='0'){?>
                            <a href="?certificate_id=<?=$db->f(product_id)?>&status=2&s_page=<?=$_GET["s_page"]?>" ><img src="../images/wait.png" alt="No Hot" width="24" height="24" border="0"></a>
                                <? }else{?>
								<a href="?certificate_id=<?=$db->f(product_id)?>&status=0&s_page=<?=$_GET["s_page"]?>" >
                              <img src="../images/ok.png" alt="Hot" width="24" height="24" border="0"></a>
            <? }?>			
            </td>
		    <td align="center">
			<? if($db->f(recommend)=='0'){?>
                            <a href="?recommend_id=<?=$db->f(product_id)?>&status=1&s_page=<?=$_GET["s_page"]?>" ><img src="../images/wait.png" alt="No Hot" width="24" height="24" border="0"></a>
                                <? }else{?>
								<a href="?recommend_id=<?=$db->f(product_id)?>&status=0&s_page=<?=$_GET["s_page"]?>" >
                              <img src="../images/ok.png" alt="Hot" width="24" height="24" border="0"></a>
            <? }?>
            </td>
		    <td align="center"><a href="?d_product_id=<?=$db->f(product_id)?>&s_page=<?=$_GET["s_page"]?>"  onClick="return confirm('คุณแน่ใจที่จะลบสินค้าหรือไม่ ?')"><img src="images/del.gif" width="19" height="23" border="0"></a></td>
	      </tr><?php $v++; } ?>
		  <tr>
                      <td height="30" colspan="9" align="center"> <?php  sh_page($total,$s_page,$e_page,$chk_page,Previous,Next,"#FFCC00","#F8F8F8"); // นำไปวางในตำแหน่งที่ต้องการแสดง ?></td>
	      </tr>
          
      </table></td>
      </tr>
    </table></td>
  </tr>
</table>
</body>
</html>