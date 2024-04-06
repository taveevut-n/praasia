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
      position: relative;
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
      /*.btn_add{
        position: absolute;
        right: 50px;
      }*/
      .btn_del{
        position: absolute;
        right: 50px;
      }
      .addPic{
      	float:left;margin:8px;border:1px dashed #fff;
      	margin-top: 5px;
      	padding-top: 5px;
      	padding-bottom: 5px;
      	transition: all 0.15s ease-in-out;
      	cursor: pointer;
      }
      
      .addPic:hover{
      	background-color: #e5e5e5;
      }
    </style>
    <!-- Multiupload -->
	  <link rel="stylesheet" type="text/css" href="js/multiupload.css" />
	  <script type="text/javascript" src="js/multiupload.js"></script>
	  <script type="text/javascript">
	      var callback_func = function post_posted(){
	        window.location.reload(true);
	      }
	      function image_submit(id){
          $("#submit").fadeOut(300);
	        return upload_submit($(".multiupload_container"),"wk-query.php?type=project",''+id+'',callback_func,'update_offer');
	      }
	</script>
    
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
      if($_POST['submit']){
          if($_POST['h_data_id']==''){    
                  foreach ($_POST["name1"] as $key => $value) {
                    $upf = array();
                    $mf = $key+1;
                    $name1 .= $value."|&";
                    if($_FILES["file1"]["name"][$key] != ""){
                      $upf[$mf] = uppic2($_FILES['file1'],"1".$mf,"img/content_certificate/",str_replace("|&", "", $_POST['h_file1'][$key]),$key);
                      $pic1 .= $upf[$mf]."|&";
                    }else{
                      $pic1 .= $_POST["h_file1"][$key];
                    }
                  }

                  foreach ($_POST["name2"] as $key => $value) {
                    $upf = array();
                    $mf = $key+1;
                    $name2 .= $value."|&";
                    if($_FILES["file2"]["name"][$key] != ""){
                        $upf[$mf] = uppic2($_FILES['file2'],"2".$mf,"img/content_certificate/",str_replace("|&", "", $_POST['h_file2'][$key]),$key);
                        $pic2 .= $upf[$mf]."|&";
                    }else{
                        $pic2 .= $_POST["h_file2"][$key];
                    }
                  }

                  foreach ($_POST["name3"] as $key => $value) {
                    $upf = array();
                    $mf = $key+1;
                    $name3 .= $value."|&";
                    if($_FILES["file3"]["name"][$key] != ""){
                        $upf[$mf] = uppic2($_FILES['file3'],"3".$mf,"img/content_certificate/",str_replace("|&", "", $_POST['h_file3'][$key]),$key);
                        $pic3 .= $upf[$mf]."|&";
                    }else{
                        $pic3 .= $_POST["h_file3"][$key];
                    }
                  }

                  foreach ($_POST["name4"] as $key => $value) {
                    $upf = array();
                    $mf = $key+1;
                    $name4 .= $value."|&";
                    if($_FILES["file4"]["name"][$key] != ""){
                        $upf[$mf] = uppic2($_FILES['file4'],"4".$mf,"img/content_certificate/",str_replace("|&", "", $_POST['h_file4'][$key]),$key);
                        $pic4 .= $upf[$mf]."|&";
                    }else{
                        $pic4 .= $_POST["h_file4"][$key];
                    }
                  }

                  foreach ($_POST["name5"] as $key => $value) {
                    $upf = array();
                    $mf = $key+1;
                    $name5 .= $value."|&";
                    if($_FILES["file5"]["name"][$key] != ""){
                        $upf[$mf] = uppic2($_FILES['file5'],"5".$mf,"img/content_certificate/",str_replace("|&", "", $_POST['h_file5'][$key]),$key);
                        $pic5 .= $upf[$mf]."|&";
                    }else{
                        $pic5 .= $_POST["h_file5"][$key];
                    }
                  }

                  foreach ($_POST["name6"] as $key => $value) {
                    $upf = array();
                    $mf = $key+1;
                    $name6 .= $value."|&";
                    if($_FILES["file6"]["name"][$key] != ""){
                        $upf[$mf] = uppic2($_FILES['file6'],"6".$mf,"img/content_certificate/",str_replace("|&", "", $_POST['h_file6'][$key]),$key);
                        $pic6 .= $upf[$mf]."|&";
                    }else{
                        $pic6 .= $_POST["h_file6"][$key];
                    }
                  }

                  foreach ($_POST["name7"] as $key => $value) {
                    $upf = array();
                    $mf = $key+1;
                    $name7 .= $value."|&";
                    if($_FILES["file7"]["name"][$key] != ""){
                        $upf[$mf] = uppic2($_FILES['file7'],"7".$mf,"img/content_certificate/",str_replace("|&", "", $_POST['h_file7'][$key]),$key);
                        $pic7 .= $upf[$mf]."|&";
                    }else{
                        $pic7 .= $_POST["h_file7"][$key];
                    }
                  }

                  foreach ($_POST["name8"] as $key => $value) {
                    $upf = array();
                    $mf = $key+1;
                    $name8 .= $value."|&";
                    if($_FILES["file8"]["name"][$key] != ""){
                        $upf[$mf] = uppic2($_FILES['file8'],"8".$mf,"img/content_certificate/",str_replace("|&", "", $_POST['h_file8'][$key]),$key);
                        $pic8 .= $upf[$mf]."|&";
                    }else{
                        $pic8 .= $_POST["h_file8"][$key];
                    }
                  }


                  $q="INSERT INTO `content_certificate` ( `content_id` ,  `mem_id` , `name` , `detail` , `pic1` , `pic2` , `pic3` , `pic4` , `pic5` , `pic6` , `pic7` , `pic8` , `name1` , `name2` , `name3` , `name4` , `name5` , `name6` , `name7` , `name8` )   
                  VALUES (  '', '".$_SESSION['adminshop_id']."', '".$_POST['name']."' , '".$_POST['detail']."' , '".$pic1."' , '".$pic2."' , '".$pic3."' , '".$pic4."' , '".$pic5."' , '".$pic6."' , '".$pic7."' , '".$pic8."' , '".$name1."' , '".$name2."' , '".$name3."' , '".$name4."' , '".$name5."' , '".$name6."' , '".$name7."' , '".$name8."' );";
                  $db->query($q);
                      // for($mf=1;$mf<=9;$mf++){
                      //     $upf[$mf] = uppic($_FILES['file'.$mf],$mf,"img/content_certificate/",$_POST['h_pic'.$mf]); // Same folder
                      //     if($upf[$mf]!=''){
                      //         $q = "SELECT * FROM `content_certificate`ORDER BY content_id DESC";
                      //         $db->query($q);
                      //         $db->next_record();  
                      //         $content_id=$db->f(content_id);
                      //         $q = "UPDATE `content_certificate` SET `pic$mf` = '".$upf[$mf]."' WHERE `content_id` =".$content_id." ";
                      //         $db->query($q);
                      //     }
                      // } 
      
          al('Add Complete');
          redi4('referee_content.php'); 
          }else{
                  foreach ($_POST["name1"] as $key => $value) {
                    $upf = array();
                    $mf = $key+1;
                    $name1 .= $value."|&";
                    if($_FILES["file1"]["name"][$key] != ""){
                      $upf[$mf] = uppic2($_FILES['file1'],"1".$mf,"img/content_certificate/",str_replace("|&", "", $_POST['h_file1'][$key]),$key);
                      $pic1 .= $upf[$mf]."|&";
                    }else{
                      $pic1 .= $_POST["h_file1"][$key];
                    }
                  }

                  foreach ($_POST["name2"] as $key => $value) {
                    $upf = array();
                    $mf = $key+1;
                    $name2 .= $value."|&";
                    if($_FILES["file2"]["name"][$key] != ""){
                        $upf[$mf] = uppic2($_FILES['file2'],"2".$mf,"img/content_certificate/",str_replace("|&", "", $_POST['h_file2'][$key]),$key);
                        $pic2 .= $upf[$mf]."|&";
                    }else{
                        $pic2 .= $_POST["h_file2"][$key];
                    }
                  }

                  foreach ($_POST["name3"] as $key => $value) {
                    $upf = array();
                    $mf = $key+1;
                    $name3 .= $value."|&";
                    if($_FILES["file3"]["name"][$key] != ""){
                        $upf[$mf] = uppic2($_FILES['file3'],"3".$mf,"img/content_certificate/",str_replace("|&", "", $_POST['h_file3'][$key]),$key);
                        $pic3 .= $upf[$mf]."|&";
                    }else{
                        $pic3 .= $_POST["h_file3"][$key];
                    }
                  }

                  foreach ($_POST["name4"] as $key => $value) {
                    $upf = array();
                    $mf = $key+1;
                    $name4 .= $value."|&";
                    if($_FILES["file4"]["name"][$key] != ""){
                        $upf[$mf] = uppic2($_FILES['file4'],"4".$mf,"img/content_certificate/",str_replace("|&", "", $_POST['h_file4'][$key]),$key);
                        $pic4 .= $upf[$mf]."|&";
                    }else{
                        $pic4 .= $_POST["h_file4"][$key];
                    }
                  }

                  foreach ($_POST["name5"] as $key => $value) {
                    $upf = array();
                    $mf = $key+1;
                    $name5 .= $value."|&";
                    if($_FILES["file5"]["name"][$key] != ""){
                        $upf[$mf] = uppic2($_FILES['file5'],"5".$mf,"img/content_certificate/",str_replace("|&", "", $_POST['h_file5'][$key]),$key);
                        $pic5 .= $upf[$mf]."|&";
                    }else{
                        $pic5 .= $_POST["h_file5"][$key];
                    }
                  }

                  foreach ($_POST["name6"] as $key => $value) {
                    $upf = array();
                    $mf = $key+1;
                    $name6 .= $value."|&";
                    if($_FILES["file6"]["name"][$key] != ""){
                        $upf[$mf] = uppic2($_FILES['file6'],"6".$mf,"img/content_certificate/",str_replace("|&", "", $_POST['h_file6'][$key]),$key);
                        $pic6 .= $upf[$mf]."|&";
                    }else{
                        $pic6 .= $_POST["h_file6"][$key];
                    }
                  }

                  foreach ($_POST["name7"] as $key => $value) {
                    $upf = array();
                    $mf = $key+1;
                    $name7 .= $value."|&";
                    if($_FILES["file7"]["name"][$key] != ""){
                        $upf[$mf] = uppic2($_FILES['file7'],"7".$mf,"img/content_certificate/",str_replace("|&", "", $_POST['h_file7'][$key]),$key);
                        $pic7 .= $upf[$mf]."|&";
                    }else{
                        $pic7 .= $_POST["h_file7"][$key];
                    }
                  }

                  foreach ($_POST["name8"] as $key => $value) {
                    $upf = array();
                    $mf = $key+1;
                    $name8 .= $value."|&";
                    if($_FILES["file8"]["name"][$key] != ""){
                        $upf[$mf] = uppic2($_FILES['file8'],"8".$mf,"img/content_certificate/",str_replace("|&", "", $_POST['h_file8'][$key]),$key);
                        $pic8 .= $upf[$mf]."|&";
                    }else{
                        $pic8 .= $_POST["h_file8"][$key];
                    }
                  }

                  $q="UPDATE `content_certificate` SET `name` = '".$_POST['name']."' ,
                  `detail` = '".$_POST['detail']."' , name1 = '".$name1."' , pic1 = '".$pic1."' , name2 = '".$name2."' , pic2 = '".$pic2."'  , name3 = '".$name3."' , pic3 = '".$pic3."' , name4 = '".$name4."' , pic4 = '".$pic4."' , name5 = '".$name5."' , pic5 = '".$pic5."' , name6 = '".$name6."' , pic6 = '".$pic6."' , name7 = '".$name7."' , pic7 = '".$pic7."' , name8 = '".$name8."' , pic8 = '".$pic8."'  WHERE `content_id` =".$_POST['h_data_id']." ";
                  $db->query($q);
                      // for($mf=1;$mf<=9;$mf++){
                      //     $upf[$mf] = uppic($_FILES['file'.$mf],$mf,"img/content_certificate/",$_POST['h_pic'.$mf]); // Same folder
                      //     if($upf[$mf]!=''){
                      //         $q = "UPDATE `content_certificate` SET `pic$mf` = '".$upf[$mf]."' WHERE `content_id` =".$_POST['h_data_id']." ";
                      //         $db->query($q);
                      //     }
                      // }
      // al('Edit Complete');
      // redi4('referee_content.php');             
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
        <td height="180px" valign="top"  bgcolor="#311407">
          <table width="1000" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="200" valign="top">
                <table width="100%" border="0" cellspacing="0" cellpadding="3">
                  <tr>
                    <td height="25" bgcolor="#3c1204"><a href="referee_content.php"><span style="color:#FFF">- รายการทังหมด / 总共项目</span></a></td>
                  </tr>
                  <tr>
                    <td height="25" bgcolor="#6c2c16"><a href="referee_confirm.php"><span style="color:#FFF">- อนุมัติแล้ว / 己审批</span></a></td>
                  </tr>
                  <tr>
                    <td height="25" bgcolor="#3c1204"><a href="referee_cancel.php"><span style="color:#FFF"> - ไม่ผ่านการอนุมัติ/还没被审批</span></a></td>
                  </tr>
                  <tr>
                    <td height="25" bgcolor="#6c2c16"><a href="content_referee.php"><span style="color:#FFF">- เพิ่มข้อมูล/增加信息</span></a></td>
                  </tr>
                  <tr>
                    <td height="25" bgcolor="#3c1204">&nbsp;</td>
                  </tr>
                </table>
              </td>
              <td width="800" valign="top" style="padding:5px">
                <?php
                  if($_GET['e_data_id']){
                    $q="SELECT * FROM content_certificate WHERE content_id=".$_GET['e_data_id']." ";
                    $db5=new nDB();
                    $db5->query($q);
                    $db5->next_record();
                  }
                  ?>                    
                <form action="" method="post" enctype="multipart/form-data">
                  <table width="100%" border="0" cellspacing="0" cellpadding="3">
                    <tr>
                      <td height="30" colspan="2" align="center" style="color:#FC0">เพิ่มรายสายตรงจากคณะกรรมการ / 增加我专业佛牌鉴定项目</td>
                    </tr>
                    <tr>
                      <td width="39%" align="right">ชื่อพระ/佛牌名称 :</td>
                      <td width="61%"><input name="name" type="text" id="name" style="width:90%" value="<?=($_GET['e_data_id'])?$db5->f(name):""?>" /></td>
                    </tr>
                    <tr>
                      <td colspan="2" align="center">รายละเอียด/祥细内容 :</td>
                    </tr>
                    <tr>
                      <td colspan="2" align="center"><textarea name="detail" rows="5" id="detail" style="height:100px; overflow:hidden; width:450px"><?=($_GET['e_data_id'])?$db5->f(detail):""?></textarea></td>
                    </tr>
                    <script>
                      CKEDITOR.replace( 'detail');
                    </script>                      
                    <tr>
                      <td align="right">รูปภาพพระเครื่องสะสมของฉัน//我的专业佛牌图片</td>
                      <td>
                                       <div class="multiupload_container" style="float:left;">
                                       			<?php
                                                  if(isset($_GET["e_data_id"])){
                                                  $c_pic = 0;
                                                  $q_pic = mysql_query("SELECT * FROM collection WHERE content_id = '".$_GET["e_data_id"]."' ORDER BY collection_order ASC ");
                                                  $n_pic = mysql_num_rows($q_pic);
                                                    if($n_pic > 0){
                                                      while ($pic = mysql_fetch_array($q_pic)) {
                                                        $c_pic = $c_pic + 1;
                                                    ?>
                                                        <div class="upload_container_2" id="<?=$pic['collection_id']?>">
                                                         		<img class="thumbnail_2" src="img/referee_collect/<?=$pic['collection_img']?>">
                                                          		<div class="upload_remove" onclick="upload_remove($('.multiupload_container'),<?=$c_pic?>,1,'<?=$pic['collection_img']?>',$(this));">x</div>
                                                       </div>
                                                    <?php
                                                       }
                                                    }
                                                  }
                                                  ?>
                                                  
                                       </div>

                                       <div class="addPic" onclick="$('#ProjectSlide').click();">
                                            <img src="Icon/add_Icon.png" width="60px" height="45px">
                                       </div>

						<div style="float:left;width:100%;">
                                      <input id="ProjectSlide" form="frm2" name="ProjectSlide" onchange="upload_select($(this),$('.multiupload_container'),'');" multiple accept="image/*" type="file"/>
							
						</div>
                        </td>
                    </tr>
                    <tr>
                      <td height="30" colspan="2" align="center" bgcolor="#000000">ตัวอย่างพระแท้ที่ดูง่าย / 例如比较容易看真的佛牌图</td>
                    </tr>
                    <tr>
                      <td align="right" bgcolor="#3e1b0c">
                        รูปด้านหน้า / 前面图片
                        <input type="button" value="+ เพิ่ม" class="btn_add" onclick="add_file($(this));">
                      </td>
                      <td bgcolor="#3e1b0c">
                        <?php
                            $limit = 0;
                            $file_arr = array();
                            $filename_arr = array();
                            $sizefile = 0;
                            if (isset($_GET["e_data_id"])) {
                              $file_arr = explode("|&", $db5->f(name1));
                              $filename_arr = explode("|&", $db5->f(pic1));
                            }
                            $sizefile = sizeof($file_arr);
                            if($sizefile > 1){$limit = sizeof($file_arr)-1;}else{$limit=1;}
                            for($i=0;$i<$limit;$i++){
                                ?>
                              <table width="100%" border="0" cellspacing="0" cellpadding="0" style="margin-top:5px;">
                                <tr>
                                  <td style="padding-bottom:5px"><input name="name1[]" type="text" id="name2" autocomplete = "off" style="width:90%" value="<?=($_GET['e_data_id'])?$file_arr[$i]:""?>" /></td>
                                </tr>
                                <tr>
                                  <td>
                                    <?php
                                      if ($filename_arr[$i] != "") {
                                    ?>
                                        <img height="75px" src="img/content_certificate/<?=$filename_arr[$i]?>">
                                    <?php
                                      }
                                    ?>
                                  </td>
                                </tr>
                                <tr>
                                  <td>
                                      <input name="file1[]" type="file"/>
                                      <input name="h_file1[]" type="hidden" value="<?=$filename_arr[$i]."|&"?>" />
                                      <input type="button" value="ลบ" class="btn_del" onclick="del_file($(this),'<?=$filename_arr[$i]?>','h_pic1');">
                                  </td>
                                </tr>
                              </table>
                        <?php
                            }
                        ?> 
                      </td>
                    </tr>
                    <tr>
                      <td align="right">
                      รูปด้านหลัง / 后面图片 <input type="button" value="+ เพิ่ม" class="btn_add" onclick="add_file($(this));">
                      </td>
                      <td>
                        <?php
                            $limit = 0;
                            $file_arr = array();
                            $filename_arr = array();
                            $sizefile = 0;
                            if (isset($_GET["e_data_id"])) {
                              $file_arr = explode("|&", $db5->f(name2));
                              $filename_arr = explode("|&", $db5->f(pic2));
                            }
                            $sizefile = sizeof($file_arr);
                            if($sizefile > 1){$limit = sizeof($file_arr)-1;}else{$limit=1;}
                                for($i=0;$i<$limit;$i++){
                              ?>
                            <table width="100%" border="0" cellspacing="0" cellpadding="0" style="margin-top:5px;">
                              <tr>
                                <td style="padding-bottom:5px"><input name="name2[]" type="text" id="name2" autocomplete = "off" style="width:90%" value="<?=($_GET['e_data_id'])?$file_arr[$i]:""?>" /></td>
                              </tr>
                              <tr>
                                  <td>
                                    <?php
                                      if ($filename_arr[$i] != "") {
                                    ?>
                                        <img height="75px" src="img/content_certificate/<?=$filename_arr[$i]?>">
                                    <?php
                                      }
                                    ?>
                                  </td>
                                </tr>
                              <tr>
                                <td>
                                  <input name="file2[]" type="file"/>
                                   <input name="h_file2[]" type="hidden" value="<?=$filename_arr[$i]."|&"?>" />
                                   <input type="button" value="ลบ" class="btn_del" onclick="del_file($(this),'<?=$filename_arr[$i]?>','h_pic2');">
                                </td>
                              </tr>
                            </table>
                        <?php
                           }
                        ?>
                      </td>
                    </tr>
                    <tr>
                      <td align="right"  bgcolor="#3e1b0c">
                      รูปขอบข้าง / 旁边图片 <input type="button" value="+ เพิ่ม" class="btn_add" onclick="add_file($(this));">
                      </td>
                      <td  bgcolor="#3e1b0c">
                        <?php
                            $limit = 0;
                            $file_arr = array();
                            $filename_arr = array();
                            $sizefile = 0;
                            if (isset($_GET["e_data_id"])) {
                              $file_arr = explode("|&", $db5->f(name3));
                              $filename_arr = explode("|&", $db5->f(pic3));
                            }
                            $sizefile = sizeof($file_arr);
                            if($sizefile > 1){$limit = sizeof($file_arr)-1;}else{$limit=1;}
                                for($i=0;$i<$limit;$i++){
                              ?>
                            <table width="100%" border="0" cellspacing="0" cellpadding="0" style="margin-top:5px;">
                              <tr>
                                <td style="padding-bottom:5px"><input name="name3[]" type="text" id="name2" autocomplete = "off" style="width:90%" value="<?=($_GET['e_data_id'])?$file_arr[$i]:""?>" /></td>
                              </tr>
                              <tr>
                                  <td>
                                    <?php
                                      if ($filename_arr[$i] != "") {
                                    ?>
                                        <img height="75px" src="img/content_certificate/<?=$filename_arr[$i]?>">
                                    <?php
                                      }
                                    ?>
                                  </td>
                                </tr>
                              <tr>
                                <td>
                                  <input name="file3[]" type="file"/>
                                   <input name="h_file3[]" type="hidden" value="<?=$filename_arr[$i]."|&"?>" />
                                   <input type="button" value="ลบ" class="btn_del" onclick="del_file($(this),'<?=$filename_arr[$i]?>','h_pic3');">
                                </td>
                              </tr>
                            </table>
                        <?php
                           }
                        ?>
                      </td>
                    </tr>
                    <tr>
                      <td align="right">
                      อื่น ๆ / 其它 <input type="button" value="+ เพิ่ม" class="btn_add" onclick="add_file($(this));">
                      </td>
                      <td>
                        <?php
                            $limit = 0;
                            $file_arr = array();
                            $filename_arr = array();
                            $sizefile = 0;
                            if (isset($_GET["e_data_id"])) {
                              $file_arr = explode("|&", $db5->f(name4));
                              $filename_arr = explode("|&", $db5->f(pic4));
                            }
                            $sizefile = sizeof($file_arr);
                            if($sizefile > 1){$limit = sizeof($file_arr)-1;}else{$limit=1;}
                                for($i=0;$i<$limit;$i++){
                              ?>
                            <table width="100%" border="0" cellspacing="0" cellpadding="0" style="margin-top:5px;">
                              <tr>
                                <td style="padding-bottom:5px"><input name="name4[]" type="text" id="name2" autocomplete = "off" style="width:90%" value="<?=($_GET['e_data_id'])?$file_arr[$i]:""?>" /></td>
                              </tr>
                              <tr>
                                  <td>
                                    <?php
                                      if ($filename_arr[$i] != "") {
                                    ?>
                                        <img height="75px" src="img/content_certificate/<?=$filename_arr[$i]?>">
                                    <?php
                                      }
                                    ?>
                                  </td>
                                </tr>
                              <tr>
                                <td>
                                  <input name="file4[]" type="file"/>
                                   <input name="h_file4[]" type="hidden" value="<?=$filename_arr[$i]."|&"?>" />
                                   <input type="button" value="ลบ" class="btn_del" onclick="del_file($(this),'<?=$filename_arr[$i]?>','h_pic4');">
                                </td>
                              </tr>
                            </table>
                        <?php
                           }
                        ?>
                      </td>
                    </tr>
                    <tr>
                      <td height="30" colspan="2" align="center" bgcolor="#000000">ตัวอย่างพระเก๊ที่ดูง่าย / 例如假牌图片</td>
                    </tr>
                    <tr>
                      <td align="right" bgcolor="#3e1b0c">
                      รูปด้านหน้า / 前面图片 <input type="button" value="+ เพิ่ม" class="btn_add" onclick="add_file($(this));">
                      </td>
                      <td bgcolor="#3e1b0c">
                        <?php
                            $limit = 0;
                            $file_arr = array();
                            $filename_arr = array();
                            $sizefile = 0;
                            if (isset($_GET["e_data_id"])) {
                              $file_arr = explode("|&", $db5->f(name5));
                              $filename_arr = explode("|&", $db5->f(pic5));
                            }
                            $sizefile = sizeof($file_arr);
                            if($sizefile > 1){$limit = sizeof($file_arr)-1;}else{$limit=1;}
                                for($i=0;$i<$limit;$i++){
                              ?>
                            <table width="100%" border="0" cellspacing="0" cellpadding="0" style="margin-top:5px;">
                              <tr>
                                <td style="padding-bottom:5px"><input name="name5[]" type="text" id="name2" autocomplete = "off" style="width:90%" value="<?=($_GET['e_data_id'])?$file_arr[$i]:""?>" /></td>
                              </tr>
                              <tr>
                                  <td>
                                    <?php
                                      if ($filename_arr[$i] != "") {
                                    ?>
                                        <img height="75px" src="img/content_certificate/<?=$filename_arr[$i]?>">
                                    <?php
                                      }
                                    ?>
                                  </td>
                                </tr>
                              <tr>
                                <td>
                                  <input name="file5[]" type="file"/>
                                   <input name="h_file5[]" type="hidden" value="<?=$filename_arr[$i]."|&"?>" />
                                   <input type="button" value="ลบ" class="btn_del" onclick="del_file($(this),'<?=$filename_arr[$i]?>','h_pic5');">
                                </td>
                              </tr>
                            </table>
                        <?php
                           }
                        ?>
                      </td>
                    </tr>
                    <tr>
                      <td align="right">
                      รูปด้านหลัง / 后面图片 <input type="button" value="+ เพิ่ม" class="btn_add" onclick="add_file($(this));">
                      </td>
                      <td>
                        <?php
                            $limit = 0;
                            $file_arr = array();
                            $filename_arr = array();
                            $sizefile = 0;
                            if (isset($_GET["e_data_id"])) {
                              $file_arr = explode("|&", $db5->f(name6));
                              $filename_arr = explode("|&", $db5->f(pic6));
                            }
                            $sizefile = sizeof($file_arr);
                            if($sizefile > 1){$limit = sizeof($file_arr)-1;}else{$limit=1;}
                                for($i=0;$i<$limit;$i++){
                              ?>
                            <table width="100%" border="0" cellspacing="0" cellpadding="0" style="margin-top:5px;">
                              <tr>
                                <td style="padding-bottom:5px"><input name="name6[]" type="text" id="name2" autocomplete = "off" style="width:90%" value="<?=($_GET['e_data_id'])?$file_arr[$i]:""?>" /></td>
                              </tr>
                              <tr>
                                  <td>
                                    <?php
                                      if ($filename_arr[$i] != "") {
                                    ?>
                                        <img height="75px" src="img/content_certificate/<?=$filename_arr[$i]?>">
                                    <?php
                                      }
                                    ?>
                                  </td>
                                </tr>
                              <tr>
                                <td>
                                  <input name="file6[]" type="file"/>
                                   <input name="h_file6[]" type="hidden" value="<?=$filename_arr[$i]."|&"?>" />
                                   <input type="button" value="ลบ" class="btn_del" onclick="del_file($(this),'<?=$filename_arr[$i]?>','h_pic6');">
                                </td>
                              </tr>
                            </table>
                        <?php
                           }
                        ?>
                      </td>
                    </tr>
                    <tr>
                      <td align="right" bgcolor="#3e1b0c">
                      รูปขอบข้าง / 旁边图片 <input type="button" value="+ เพิ่ม" class="btn_add" onclick="add_file($(this));">
                      </td>
                      <td bgcolor="#3e1b0c">
                        <?php
                            $limit = 0;
                            $file_arr = array();
                            $filename_arr = array();
                            $sizefile = 0;
                            if (isset($_GET["e_data_id"])) {
                              $file_arr = explode("|&", $db5->f(name7));
                              $filename_arr = explode("|&", $db5->f(pic7));
                            }
                            $sizefile = sizeof($file_arr);
                            if($sizefile > 1){$limit = sizeof($file_arr)-1;}else{$limit=1;}
                                for($i=0;$i<$limit;$i++){
                              ?>
                            <table width="100%" border="0" cellspacing="0" cellpadding="0" style="margin-top:5px;">
                              <tr>
                                <td style="padding-bottom:5px"><input name="name7[]" type="text" id="name2" autocomplete = "off" style="width:90%" value="<?=($_GET['e_data_id'])?$file_arr[$i]:""?>" /></td>
                              </tr>
                              <tr>
                                  <td>
                                    <?php
                                      if ($filename_arr[$i] != "") {
                                    ?>
                                        <img height="75px" src="img/content_certificate/<?=$filename_arr[$i]?>">
                                    <?php
                                      }
                                    ?>
                                  </td>
                                </tr>
                              <tr>
                                <td>
                                  <input name="file7[]" type="file"/>
                                   <input name="h_file7[]" type="hidden" value="<?=$filename_arr[$i]."|&"?>" />
                                   <input type="button" value="ลบ" class="btn_del" onclick="del_file($(this),'<?=$filename_arr[$i]?>','h_pic7');">
                                </td>
                              </tr>
                            </table>
                        <?php
                           }
                        ?>
                      </td>
                    </tr>
                    <tr>
                      <td align="right">
                      อื่น ๆ / 其它 <input type="button" value="+ เพิ่ม" class="btn_add" onclick="add_file($(this));">
                      </td>
                      <td>
                        <?php
                            $limit = 0;
                            $file_arr = array();
                            $filename_arr = array();
                            $sizefile = 0;
                            if (isset($_GET["e_data_id"])) {
                              $file_arr = explode("|&", $db5->f(name8));
                              $filename_arr = explode("|&", $db5->f(pic8));
                            }
                            $sizefile = sizeof($file_arr);
                            if($sizefile > 1){$limit = sizeof($file_arr)-1;}else{$limit=1;}
                                for($i=0;$i<$limit;$i++){
                              ?>
                            <table width="100%" border="0" cellspacing="0" cellpadding="0" style="margin-top:5px;">
                              <tr>
                                <td style="padding-bottom:5px"><input name="name8[]" type="text" id="name2" autocomplete = "off" style="width:90%" value="<?=($_GET['e_data_id'])?$file_arr[$i]:""?>" /></td>
                              </tr>
                              <tr>
                                  <td>
                                    <?php
                                      if ($filename_arr[$i] != "") {
                                    ?>
                                        <img height="75px" src="img/content_certificate/<?=$filename_arr[$i]?>">
                                    <?php
                                      }
                                    ?>
                                  </td>
                                </tr>
                              <tr>
                              <tr>
                                <td>
                                <style type="text/css">
                                </style>
                                  <input name="file8[]" type="file"/>
                                   <input name="h_file8[]" type="hidden" value="<?=$filename_arr[$i]."|&"?>" />
                                   <input type="button" value="ลบ" class="btn_del" onclick="del_file($(this),'<?=$filename_arr[$i]?>','h_pic8');">
                                </td>
                              </tr>
                            </table>
                        <?php
                           }
                        ?>
                      </td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td><input type="button" class="btn btn-default button_add" id="submit" onclick="image_submit('<?=$_GET["e_data_id"]?>');" value="Submit">
                      	<input type="hidden" value="<?=$_SESSION['adminshop_id']?>" name="post_id" />
                        <?php if($_GET['e_data_id']){ ?>
                        <input name="h_data_id" type="hidden" id="h_data_id" value="<?=$db5->f(content_id)?>" />
                        <input name="h_pic1" type="hidden" id="h_pic1" value="<?=$db5->f(pic1)?>">
                        <input name="h_pic2" type="hidden" id="h_pic2" value="<?=$db5->f(pic2)?>">
                        <input name="h_pic3" type="hidden" id="h_pic3" value="<?=$db5->f(pic3)?>">
                        <input name="h_pic4" type="hidden" id="h_pic4" value="<?=$db5->f(pic4)?>"> 
                        <input name="h_pic5" type="hidden" id="h_pic5" value="<?=$db5->f(pic5)?>">
                        <input name="h_pic6" type="hidden" id="h_pic6" value="<?=$db5->f(pic6)?>">
                        <input name="h_pic7" type="hidden" id="h_pic7" value="<?=$db5->f(pic7)?>">
                        <input name="h_pic8" type="hidden" id="h_pic8" value="<?=$db5->f(pic8)?>"> 
                        <input name="h_pic9" type="hidden" id="h_pic9" value="<?=$db5->f(pic9)?>">                                                                                                          
                        <?php } ?>        
                      </td>
                    </tr>
                  </table>
                                       <input type="submit" name="submit"  id="submit_project" style="display:none;">
                                </form>
                                <form method="POST" id="frm2">
                                  
                                </form>
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
  <script type="text/javascript">
      function del_file(x,file_name,el){
         if (confirm("ยืนยันการลบใช่หรือไม่ ? ")) {
            x.parent().parent().parent().parent().remove();
            $.ajax({
              url: 'del_image.php',
              type: 'POST',
              data: {dowhat: 'del_image',file_name: file_name},
              cache:false,
            })
         };
      }

      function add_file(x){
        var nx = x.parent().parent().find("td:eq(1)").find("input[type='text']").length;
        x.parent().parent().find("td:eq(1)").append(x.parent().parent().find("td:eq(1)").find("table:eq("+(nx-1)+")").clone());
        x.parent().parent().find("td:eq(1)").find("img:eq("+(nx)+")").remove();
        x.parent().parent().find("td:eq(1)").find("input[type='text']:eq("+(nx)+")").val("");
      }
  </script>
    <!-- Menu Toggle Script -->
    <script>
    $(".multiupload_container").sortable({
    	 update : function(event, ui) {
		        var order = $(this).sortable("toArray");

		    	$.ajax({
		       		url: 'wk-query.php',
		       		type: 'POST',
		       		data: { do_what:"sort_order", order:order },
		       	})
		       	.done(function(e) {
		       		console.log(e);
		       	})

		    }
    });
    $( "#multiupload_container" ).disableSelection();
    $(".menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });
    </script>  
  </body>
</html>
