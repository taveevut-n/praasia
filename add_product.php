<?php include("global.php"); ?>

<?php set_page($s_page,$e_page=15); //นำส่วนนี้ิไว้ด้านบน ?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"><html xmlns="http://www.w3.org/1999/xhtml"

      xmlns:og="http://opengraphprotocol.org/schema/"

      xmlns:fb="http://www.facebook.com/2008/fbml"><!-- InstanceBegin template="/Templates/detail_temp.dwt.php" codeOutsideHTMLIsLocked="false" -->

<head>

<?php

  $q="SELECT * FROM `setting`";

  $db->query($q);

  $db->next_record();

    $meta_des=$db->f(web_descript);

    $meta_keyword=$db->f(web_keyword);

    $meta_title=$db->f(web_title);

    $webname=$_SERVER['SERVER_NAME'];

    $pagename=$_SERVER['PHP_SELF'];

?>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

<META http-equiv=Content-Type content="text/html; charset=utf-8">

<?php include("head_title.php"); ?>

<!-- InstanceBeginEditable name="head" -->

<title></title>

<!-- InstanceEndEditable -->

<?php

  $q="SELECT * FROM `bg_co` WHERE 1";

  $db->query($q);

  if($db->num_rows()>0){

    $db->next_record();

    $bgg_color=$db->f(name_co);

    $_SESSION['block_color']=$db->f(name_co2);

  }

?>  

</head>

<body >

<?php include("head_menu.php"); ?>
<div style="background: url(images/bg_contact.jpg) no-repeat !important;">
<div id="wrapper" style="background-color: #FFFFFF ">

<table width="<?=$dblang->f(df_lang)?>" border="0" align="center"  cellpadding="0" cellspacing="0">

  <tr>

    <td valign="top">



<table width="<?=$dblang->f(df_lang)?>" height="100%" border="0" align="center" cellpadding="0" cellspacing="0">

  <tbody>

    <tr>

      <td height="100%"><table width="<?=$dblang->f(df_lang)?>" border="0" cellspacing="0" cellpadding="0">

                      <?php 

  $q="SELECT * FROM `mod_content` WHERE  1 ";

  $db66=new nDB();

  $db66->query($q);

  $db66->next_record();

?>               

        <tr>

          <td valign="top" height="<?=$db66->f(height)?>" ><table width="100%" border="0" cellspacing="0" cellpadding="0">

            <tr>

<?php 

$q="SELECT * FROM `layout` WHERE active=1";

$db11=new nDB();

$db11->query($q);

$db11->next_record();

if($db11->f(id_layout)==1 || $db11->f(id_layout)==2 ){

?>    

              <td width="162" align="left" valign="top"  bgcolor="<?=$_SESSION['block_color']?>" >

        

<table width="100" border="0" align="right" cellpadding="0" cellspacing="0">

<?php 

  $q="SELECT * FROM `module` WHERE id_po=1 AND show_mod='1' AND active_mod=1 ORDER BY order_mod ";

  $db10=new nDB();

  $db10->query($q);

  while($db10->next_record()){

    $im=$db10->f(file_mod);

    include($im);

  }

?>                                                                                    

                    </table>        </td>

<?php } ?>

<?php if($db11->f(id_layout)==4 && basename($_SERVER['PHP_SELF'])=="index.php"){ ?>

              <td width="162" align="left" valign="top"  bgcolor="<?=$_SESSION['block_color']?>" >

        

<table width="100" border="0" align="right" cellpadding="0" cellspacing="0">

<?php 

  $q="SELECT * FROM `module` WHERE id_po=1 AND show_mod='1' AND active_mod=1 ORDER BY order_mod ";

  $db10=new nDB();

  $db10->query($q);

  while($db10->next_record()){

    $im=$db10->f(file_mod);

    include($im);

  }

?>                                                                                    

                    </table>        </td>

<?php } ?>    

<?php if($db11->f(id_layout)==6 && basename($_SERVER['PHP_SELF'])!="index.php"){ ?>

              <td width="162" align="left" valign="top"  bgcolor="<?=$_SESSION['block_color']?>" >

        

<table width="100" border="0" cellpadding="0" cellspacing="0">

<?php 

  $q="SELECT * FROM `module` WHERE id_po=1 AND show_mod='1' AND active_mod=1 ORDER BY order_mod ";

  $db10=new nDB();

  $db10->query($q);

  while($db10->next_record()){

    $im=$db10->f(file_mod);

    include($im);

  }

?>                                                                                    

                    </table>        </td>

<?php } ?>                            

<?php 

$q="SELECT * FROM `layout` WHERE active=1";

$db789=new nDB();

$db789->query($q);

$db789->next_record();

?>    

              <td align="left" valign="top" bgcolor="<?=$bgg_color?>">

        <table width="100%" border="0" cellspacing="0" cellpadding="0">

   <tr>

                  <td valign="top"><!-- InstanceBeginEditable name="bodey_detail" -->

               

                  <table width="100%" cellpadding="0" cellspacing="0" height="<?=$db66->f(height)?>">

                  <tr>

                  <td align="<?=$db66->f(align)?>"   valign="top" style="background:url(img/mod/<?=$db66->f(pic2)?>); padding-left:<?=$db66->f(padleft)?>px; padding-top:<?=$db66->f(padtop)?>px; padding-right:<?=$db66->f(padright)?>px; padding-bottom:<?=$db66->f(padbottom)?>px" >

                  

                  <table width="<?=$db66->f(width_mod)?>" border="0" cellspacing="0" cellpadding="0">

               <tr>

                  <td>

<div class="divbar">                  



                  <table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">

                    <tr>

                      <td><table width="100%" border="0" cellspacing="0" cellpadding="0">

                          <tr>

                            <td width="74%">&nbsp;</td>

                            </tr>


                          <tr>

                            <td>

<script language="JavaScript" type="text/javascript">

  function reg_fo(){

    with(document.REG){

      if(username.value==''){

        alert('กรุณากรอกข้อมูลให้ครบถ้วน');

        username.focus();

        return false;

      }

      if(password.value==''){

        alert('กรุณากรอกข้อมูลให้ครบถ้วน');

        password.focus();

        return false;

      }

      if(name.value==''){

        alert('กรุณากรอกข้อมูลให้ครบถ้วน');

        name.focus();

        return false;

      }

      if(address.value==''){

        alert('กรุณากรอกข้อมูลให้ครบถ้วน');

        address.focus();

        return false;

      }

      if(shopname.value==''){

        alert('กรุณากรอกข้อมูลให้ครบถ้วน');

        city.focus();

        return false;

      }

      if(telephone.value==''){

        alert('กรุณากรอกเบอร์โทรศัพท์');

        telephone.focus();

        return false;

      }                                             

    }

  }

</script>               
<style type="text/css">
  label {
    font-size: 12px;
    font-weight: bold;
  }
</style>





<?php

  if($_POST['edit_id']){


                    $filepart = $_FILES["file1"]["tmp_name"];
                $filename = $_FILES["file1"]["name"];
                if(trim($_FILES["file1"]["tmp_name"]) != ""){
                    $fileextension = end(explode(".",$filename));
                    $filename1 = time()."1.".$fileextension;
                    copy($filepart,"img/upload/".$filename1);
                }else{
                    $filename1 = $_POST['hidfile1'];
                }
                
            
                $filepart = $_FILES["file2"]["tmp_name"];
                $filename = $_FILES["file2"]["name"];
                if(trim($_FILES["file2"]["tmp_name"]) != ""){
                    $fileextension = end(explode(".",$filename));
                    $filename2 = time()."2.".$fileextension;
                    copy($filepart,"img/upload/".$filename2);
                }else{
                    $filename2 = $_POST['hidfile2'];
                }

    $q="UPDATE `member` SET `shopname` = '".$_POST['shopname']."',

`shopurl` = '".$_POST['news_s_detail']."',

`name` = '".$_POST['name']."',

`address` = '".$_POST['address']."',

`tel` = '".$_POST['telephone']."',

`cover_img` = '".$filename1."',

`profile_img` = '".$filename2."',

`email` = '".$_POST['email']."',

`acc_name` = '".$_POST['acc_name']."',

`acc_no` = '".$_POST['acc_no']."',

`acc_type` = '".$_POST['acc_type']."',

`acc_bank` = '".$_POST['acc_bank']."',

`acc_branch` = '".$_POST['acc_branch']."' WHERE `member_id` =".$_POST['edit_id']." ";

      $db->query($q);

      al('แก้ไขข้อมูลเรียบร้อย');

      redi4('shop.php?id='.$_POST['edit_id']);

}

 if($_GET["id"]) {
  $q = mysql_query("SELECT * FROM member WHERE member_id = '".$_GET["id"]."' ");
  $r = mysql_fetch_array($q);
  
}
?>

                              <form action="" method="post" name="REG" target="reg_frm" id="REG" onsubmit="return reg_fo()" enctype="multipart/form-data">
                                <div class="row">
                                  <div class="col">
                                  <div class="form-group">
                                    <label >ชื่อซุ้ม</label>
                                    <input type="text" class="form-control" name="shopname" placeholder="ชื่อซุ้ม" value="<?=($_GET['id'])?$r["shopname"]:""?>" required="">
                                    <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
                                  </div>
                                  </div>
                                  <div class="col">
                                    <div class="form-group">
                                      <label for="exampleInputPassword1">เว็บไซต์ของซุ้ม</label>
                                      <input type="text" class="form-control" name="shopurl" value="<?=($_GET['id'])?$r["shopurl"]:""?>" placeholder="เว็บไซต์ของซุ้ม">
                                    </div>
                                  </div>
                                </div>
                                <div class="row">
                                  <div class="col">
                                    <div class="form-group">
                                      <label >บริหารงานโดย</label>
                                      <input type="text" class="form-control" name="name" value="<?=($_GET['id'])?$r["name"]:""?>" placeholder="บริหารงานโดย" required="">
                                      <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
                                    </div>
                                  </div>
                                  <div class="col">
                                    <div class="form-group">
                                      <label for="exampleInputPassword1">ที่ตั้งซุ้ม</label>
                                      <input type="text" class="form-control" name="address" value="<?=($_GET['id'])?$r["address"]:""?>" placeholder="ที่ตั้งซุ้ม" required="">
                                    </div>
                                  </div>
                                </div>
                                <div class="row">
                                  <div class="col">  
                                    <div class="form-group">
                                      <label >เบอร์โทรศัพท์</label>
                                      <input type="text" class="form-control" name="telephone" value="<?=($_GET['id'])?$r["tel"]:""?>" placeholder="เบอร์โทรศัพท์" required="">
                                      <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
                                    </div>
                                  </div>
                                  <div class="col">
                                    <div class="form-group">
                                      <label for="exampleInputPassword1">E-mail Address</label>
                                      <input type="text" class="form-control" name="email" value="<?=($_GET['id'])?$r["email"]:""?>" placeholder="E-mail">
                                    </div>
                                  </div>
                                </div>
                                <div style="border-bottom: 1px solid #af191a; font-weight: bold; margin-bottom: 5px;  font-size: 14px; font-style: italic;">
                                  รายละเอียดการชำระเงิน
                                </div>
                                <div class="form-group">
                                  <label >ชื่อบัญชี</label>
                                  <input type="text" class="form-control" name="acc_name" value="<?=($_GET['id'])?$r["acc_name"]:""?>" placeholder="ชื่อบัญชี">
                                  <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
                                </div>
                                <div class="form-group">
                                  <label for="exampleInputPassword1">เลขที่บัญชี</label>
                                  <input type="text" class="form-control" name="acc_no" value="<?=($_GET['id'])?$r["acc_no"]:""?>" placeholder="เลขที่บัญชี">
                                </div>
                                <div class="form-group">
                                  <label >ประเภทบัญชี</label>
                                  <select class="form-control" name="acc_type">
                                    <option>
                                      ออมทรัพย์
                                    </option>
                                    <option>
                                      กระแสรายวัน
                                    </option>
                                  </select>
                                </div>
                                <div class="row">
                                  <div class="col">
                                    <div class="form-group">
                                      <label>ธนาคาร</label>
                                      <input type="text" class="form-control" name="acc_bank" value="<?=($_GET['id'])?$r["acc_bank"]:""?>" placeholder="ธนาคาร">
                                    </div> 
                                  </div>
                                  <div class="col">
                                    <div class="form-group">
                                      <label>สาขา</label>
                                      <input type="text" class="form-control" name="acc_branch" value="<?=($_GET['id'])?$r["acc_branch"]:""?>" placeholder="สาขา">
                                    </div> 
                                  </div>
                                </div>  
                                <div class="form-group">
                                  <label >ภาพแบนเนอร์ใหญ่ : </label>
                                  <input type="file" name="file1">
                                  <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
                                </div>
                                <div class="form-group">
                                  <label>ภาพแบนเนอร์เล็ก : </label>
                                  <input type="file"  name="file2">
                                </div>
                                <input type="hidden" name="edit_id" value="<?php echo $r["member_id"];?>">           
                                <input type="submit" class="btn btn-primary" name="Submit" value="บันทึกข้อมูล">
                                
                              </form>
                              <iframe src="" name="reg_frm" width="1px" height="0px" frameborder="0" id="reg_frm"></iframe> 
                              </td>

                            </tr>



                      </table></td>

                    </tr>

                    <tr>

                      <td align="right"><br /></td>

                    </tr>

                    <tr>

                      <td>&nbsp;</td>

                    </tr>

                  </table>

                  

                </div>  </td>

                  </tr>

                  </table></td></tr></table>

                  <!-- InstanceEndEditable --></td>

                  </tr>

              </table></td>  

                         

<?php 

$q="SELECT * FROM `layout` WHERE active=1";

$db22=new nDB();

$db22->query($q);

$db22->next_record();

if($db22->f(id_layout)==3){

?>    

              <td width="162" align="left" valign="top"  bgcolor="<?=$_SESSION['block_color']?>" >

        

<table width="100" border="0" align="right" cellpadding="0" cellspacing="0">

<?php 

  $q="SELECT * FROM `module` WHERE id_po=3 AND show_mod='1' AND active_mod=1 ORDER BY order_mod ";

  $db33=new nDB();

  $db33->query($q);

  while($db33->next_record()){

    $im2=$db33->f(file_mod);

    include($im2);

  }

?>                                                                                    

                    </table>        </td>

<?php } ?>

<?php if($db22->f(id_layout)==2 && basename($_SERVER['PHP_SELF'])=="index.php"){ ?>

              <td width="162" align="left" valign="top"  bgcolor="<?=$_SESSION['block_color']?>" >

        

<table width="100" border="0" align="right" cellpadding="0" cellspacing="0">

<?php 

  $q="SELECT * FROM `module` WHERE id_po=3 AND show_mod='1' AND active_mod=1 ORDER BY order_mod ";

  $db33=new nDB();

  $db33->query($q);

  while($db33->next_record()){

    $im2=$db33->f(file_mod);

    include($im2);

  }

?>                                                                                    

                    </table>        </td>

<?php } ?>        

            </tr>

          </table></td>

        </tr>

      </table></td>

    </tr>

  </tbody>

</table></td>

  </tr>

</table>

</div>
</div>
<div>

  <?php include("footer.php"); ?>

</div>

<script type="text/javascript">

swfobject.registerObject("FlashID");

</script>

</body>

<!-- InstanceEnd --></html>
