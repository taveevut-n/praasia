<? include('../global.php');
  if($_SESSION['adminid']=='' || !isset($_SESSION['adminid'])) {  
         redi4("login.php");
  	
  } 
  set_page($s_page,$e_page = 200);

  if ($_GET["v"]) {
      $_SESSION["cn"] = $_GET["v"] ;
  }
  ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>ระบบจัดการเว็บไซต์</title>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
    <!--Innova Editor-->
    <script type="text/javascript" src="/admin/innovaeditor/scripts/innovaeditor.js"></script>
    <style type="text/css">
      html,body{
      font-size: 13px;
      font-family: Tahoma, Geneva, sans-serif;
      }
      body {
      background-color: #000;
      margin: 0;
      }
      .bh{
      color:#FC0;
      height:30px;
      }
      .sidemenu{
      color:#FFF;
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
      .translate_button {
      background-color: #FCA909;
      border-bottom: 1px solid #C46104;
      border-left: 1px solid #C46104;
      border-radius: 0 0 5px 5px;
      border-top: 1px solid #C46104;
      color: #FFFFFF;
      cursor: pointer;
      font-family: Tahoma;
      height: 35px;
      padding: 5px;
      width: 200px;
      z-index: 1;
      }
    </style>
  </head>
  <body>
    <table width="1000" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td><img src="/admin/images/head.jpg" width="1098" height="288" /></td>
      </tr>
      <tr>
        <td bgcolor="#311407">
          <table width="100%" border="0" cellspacing="3" cellpadding="0">
            <tr>
              <td width="250" valign="top" ><? include('sidemenu.php') ?></td>
              <td valign="top" bgcolor="#3f1d0e">
                <table width="100%" border="0" cellspacing="0" cellpadding="3">
                  <tr>
                    <td bgcolor="#592D03">
                      <form method="post" name="form1" id="form1">
                        <table width="96%" border="0" align="center" cellpadding="3" cellspacing="0">
                          <tr>
                            <td align="right" bgcolor="#4d1403" style="color:#FFF">ค้นหา :
                              <input name="q" type="text" id="q" /><input name="search" type="submit" id="search" value="ค้นหา" />
                            </td>
                          </tr>
                        </table>
                      </form>
                    </td>
                  </tr>
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
                        	$q="UPDATE `catalog_cn` SET 
                        `catalog_name` = '".$_POST['name_catalog2']."',
                        `catalog_name_cn` = '".$_POST['name_catalog_cn']."',
                        `top_id` = '".$_POST['top_catalog']."' WHERE `catalog_id` =".$_POST['h_sub_id']." ";
                        	$db->query($q);	
                        	al('แก้ไขข้อมูลเรียบร้อยแล้ว');
                        	redi2();
                        	}else{				
                        	$q="INSERT INTO `catalog_cn` ( `catalog_id` ,`top_id`,`catalog_name`,`catalog_name_cn`) 
                        VALUES (
                        '', '".$_POST['top_catalog']."', '".$_POST['name_catalog2']."',  '".$_POST['name_catalog_cn']."'
                        );";
                        	$db->query($q);
                        	al('เพิ่มข้อมูลเรียบร้อยแล้ว');
                        	redi2();
                        	}
                        }
                        ?>
                      <?php
                        if($_GET['d_sub_id']){	
                        	$q="DELETE FROM `catalog_cn` WHERE `catalog_id` = ".$_GET['d_sub_id']." ";
                        	$db->query($q);
                        }
                        ?>
                      <?php
                        if($_POST['q']){
                        	$q="SELECT * FROM `catalog_cn` WHERE catalog_id = '".$_POST['q']."' or catalog_name = '".$_POST['q']."' or catalog_name_cn = '".$_POST['q']."' ";
                        	$db5 = new nDB();
                        	$db5->query($q);
                        	$db5->next_record();
                        }
                        if($_GET['e_sub_id']){
                        	$q="SELECT * FROM `catalog_cn` WHERE catalog_id=".$_GET['e_sub_id']." ";
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
                            <td colspan="2" style="padding-left:10px; height:30px; color:#ffcc00; background-color:#8e5100;">
                              แปลภาษา
                            </td>
                          </tr>
                          <tr>
                            <td colspan="2" style="color:#ffffff; background-color:#6c2c16;line-height: 50px;" align="center">
                              <div style="display:none;">
                                <table border="0" cellpadding="0" cellspacing="0">
                                  <tr>
                                    <td>&nbsp;
                                    </td>
                                    <td style="color:#FC0;">
                                      <? include('admin_translate_bo.php'); ?>
                                    </td>
                                  </tr>
                                </table>
                              </div>
                              <span style="cursor:pointer;" onClick="translate_slide($(this));" isopen="0">
                              <span class="translate_button" style="color:#F00" >
                              คลิกสู่ระบบแปลภาษา/点击进入翻译系统... ▼
                              </span>
                              <span style="	display:none; color:#090" class="translate_button">
                              คลิกเพื่อปิดระบบแปลภาษา/点击收回翻译系统... ▲
                              </span>
                              </span>
                              <script>
                                function translate_slide(x_this){
                                	var isopen = x_this.attr("isopen");
                                	if(isopen == "1"){
                                		x_this.attr("isopen","0");
                                		x_this.find("span:eq(0)").show();
                                		x_this.find("span:eq(1)").hide();
                                		x_this.prev().slideUp();
                                	}else{
                                		x_this.attr("isopen","1");
                                		x_this.find("span:eq(0)").hide();
                                		x_this.find("span:eq(1)").show();
                                		x_this.prev().slideDown();
                                	}
                                }
                              </script>
                            </td>
                          </tr>
                          <tr>
                            <td  style="border-bottom:1px solid #FC0; color: #E0D9BA;font-size: 14px;line-height: 26px;" height="8" colspan="2">
                              วิธีการใช้แปลภาษาบนมือถือ<br> 1.ให้พิมพ์คำที่ต้องแปล    แล้วก็อปปี้วาง<br>
                              2.หากไม่ใช้วิธีเขียน ก็อปปี้คำที่ต้องการ แล้ววางในช่องแปลภาษา ให้กด Inter หนึ่งครั้ง ผลลัพธ์คำแปลจะปรากฎขึ้นมา
                              จากนั้นให้ก็อปปี้คำแปลวางที่ต้องการใช้งาน<br>
                              3.หากผลลัพธ์การแปลไม่ปรากฎคำ กรุณานำคำแปลมาใส่ในช่องฝาก จากนั้นคำที่ฝากแปลจะใช้งานได้ภายใน24ชั่วโมง
                            </td>
                          </tr>
                          <tr>
                            <td height="25" colspan="2" align="center" bgcolor="#4d1403" class="style11" ><span class="sidemenu">เพิ่ม แก้ไขหมวดสินค้า</span></td>
                          </tr>
                          <tr>
                            <td width="27%" align="right" bgcolor="#3c1204" class="style11" style="padding-right:3px"><span class="sidemenu">หมวดหลัก :</span></td>
                            <td width="73%" bgcolor="#3c1204">
                              <span class="sidemenu">
                                <select name="top_catalog" id="top_catalog">
                                  <option value="0">--เลือกเป็นหมวดหลัก--</option>
                                  <?
                                    $q="SELECT * FROM `catalog_cn` WHERE top_id = 0 ORDER BY catalog_id  ";
                                    $db_top=new nDB();
                                    $db_top->query($q);
                                    while($db_top->next_record()){
                                    ?>
                                  <option value="<?=$db_top->f(catalog_id)?>"
                                    <? if ($_POST['q']) { 
                                      if ($db5->f(top_id)==$db_top->f(catalog_id)) {
                                      	echo 'selected="selected"';
                                      }
                                      }
                                      ?>
                                    <? if ($_GET['e_sub_id']) { 
                                      if ($db5->f(top_id)==$db_top->f(catalog_id)) {
                                      	echo 'selected="selected"';
                                      }
                                      }
                                      ?>
                                    ><?=$db_top->f(catalog_name)?></option>
                                  <? } ?>
                                </select>
                              </span>
                            </td>
                          </tr>
                          <tr>
                            <td width="27%" align="right" bgcolor="#3c1204" class="style11" style="padding-right:3px"><span class="sidemenu">รุ่นพระเครื่อง :</span></td>
                            <td width="73%" bgcolor="#3c1204"><span class="sidemenu">
                              <? if($_POST['q']) { ?>
                              <input name="name_catalog2" type="text"  id="name_catalog2" value="<?=($_POST['q'])?$db5->f(catalog_name):""?>" size="45" />
                              <? } else { ?>
                              <input name="name_catalog2" type="text"  id="name_catalog2" value="<?=($_GET['e_sub_id'])?$db5->f(catalog_name):""?>" size="45" />
                              <? } ?>
                              </span>
                            </td>
                          </tr>
                          <tr>
                            <td width="27%" align="right" bgcolor="#3c1204" class="style11" style="padding-right:3px"><span class="sidemenu">รุ่นพระเครื่องภาษาจีน :</span></td>
                            <td width="73%" bgcolor="#3c1204"><span class="sidemenu">
                              <? if($_POST['q']) { ?>
                              <input name="name_catalog_cn" type="text"  id="name_catalog_cn" value="<?=($_POST['q'])?$db5->f(catalog_name_cn):""?>" size="45" />
                              <? } else { ?>
                              <input name="name_catalog_cn" type="text"  id="name_catalog_cn" value="<?=($_GET['e_sub_id'])?$db5->f(catalog_name_cn):""?>" size="45" />
                              <? } ?>
                              </span>
                            </td>
                          </tr>
                          <tr>
                            <td bgcolor="#3c1204">&nbsp;</td>
                            <td bgcolor="#3c1204"><input name="Submit" type="submit" class="button_add"  value="<?=($_GET['e_sub_id'])?"แก้ไขหมวดสินค้า":"เพิ่มหมวดสินค้า"?>" />
                              <?php if($_GET['e_sub_id']){ ?>
                              <input name="h_sub_id" type="hidden" id="h_sub_id" value="<?=$db5->f(catalog_id)?>" />
                              <input name="h_name_catalog" type="hidden" id="h_name_catalog" value="<?=$db5->f(catalog_name)?>" />					                        	  
                              <?php } ?>                      
                            </td>
                          </tr>
                        </table>
                      </form>
                      <br />
                      <form method="get" id="form2" name="form2">
                        <table width="96%" border="0" align="center" cellpadding="0" cellspacing="1">
                          <tr>
                            <td height="30" colspan="3" align="right">
                              เลือกหมวด
                              <select name="v"  id="v" onchange="document.form2.submit();">
                                <option value="">เลือกหมวดสินค้า</option>
                                <?php
                                  $q="SELECT * FROM `catalog_cn` WHERE top_id =0 ORDER BY catalog_id ";
                                  $db->query($q);
                                  while($db->next_record()){
                                  ?>
                                <option value="<?=$db->f(catalog_id)?>" <?php if($db->f(catalog_id)==$_GET['v']){echo "selected";}?> >
                                  <?=$db->f(catalog_name)?>
                                </option>
                                <? } ?>
                              </select>
                            </td>
                          </tr>
                          <tr class="sidemenu">
                            <td height="25" align="center" bgcolor="#4d1403" class="style11" >ชื่อหมวดสินค้า</td>
                            <td align="center" bgcolor="#4d1403" class="style11" >แก้ไข</td>
                            <td align="center" bgcolor="#4d1403" class="style11" >ลบ</td>
                          </tr>
                          <?php

                            $q="SELECT * FROM `catalog_cn` WHERE catalog_id ='".$_SESSION['cn']."' AND top_id = 0 ORDER BY catalog_id";
                            $db->query($q);
                            while($db->next_record()){
                            ?>
                          <tr>
                            <td height="40" bgcolor="#1c0801"   style="padding-left:3px">
                              <span style="color:#FC0; font-size:12px">
                              <?=$db->f(catalog_name)?> / <?=$db->f(catalog_name_cn)?>
                              </span>
                            </td>
                            <td width="8%" align="center" bgcolor="#1c0801"><span class="sidemenu"><a href="?e_sub_id=<?=$db->f(catalog_id)?>" ><img src="images/edit.gif" alt="แก้ไข" width="19" height="23" border="0" /></a></span></td>
                            <td width="8%" align="center" bgcolor="#1c0801" ><span class="sidemenu"><a href="?d_sub_id=<?=$db->f(catalog_id)?>"  onclick="return confirm('ยืนยันการลบหมวดหมู่  <?=$db->f(catalog_name)?> / <?=$db->f(catalog_name_cn)?> ใช่หรือไม่')"><img src="images/del.gif" alt="ลบ" width="19" height="23" border="0" /></a></span></td>
                          </tr>
                          <?php  
                            $q1="SELECT * FROM `catalog_cn` WHERE top_id = '".$db->f(catalog_id)."' and catalog_name like '%".$_POST["q"]."%' ";
                            $db5=new nDB();
                            $db5->query($q1);
                            $total=$db5->num_rows();
                            $q1.=" ORDER BY catalog_id DESC LIMIT $s_page,$e_page ";
                            $db5->query($q1);
                            static $v=1;
                            if($db5->num_rows()!=0){
                            	
                            while($db5->next_record()){
                            ?>
                          <tr  bgcolor="<?=($v%2==1)?"#3c1204":"#2f0d02"?>">
                            <td height="30" ><span class="sidemenu">
                              --- <?=$db5->f(catalog_id)?>. <?=$db5->f(catalog_name)?> / <?=$db5->f(catalog_name_cn)?>
                              </span>
                            </td>
                            <td width="8%" align="center" ><span class="sidemenu"><a href="?e_sub_id=<?=$db5->f(catalog_id)?>" ><img src="images/edit.gif" alt="แก้ไข" width="19" height="23" border="0" /></a></span></td>
                            <td width="8%" align="center" ><span class="sidemenu"><a href="?d_sub_id=<?=$db5->f(catalog_id)?>"  onclick="return confirm('ยืนยันการลบหมวดสินค้า <?=$db5->f(catalog_id)?>. <?=$db5->f(catalog_name)?> / <?=$db5->f(catalog_name_cn)?> ใช่หรือไม่')"><img src="images/del.gif" alt="ลบ" width="19" height="23" border="0" /></a></span></td>
                          </tr>
                          <?php $v++; ?>
                          <?php } } }   ?>
                          <tr>
                            <td height="30" colspan="3" align="center">
                              <?php  sh_page($total,$s_page,$e_page,$chk_page,Previous,Next,"#333333","#F8F8F8");?>
                            </td>
                          </tr>
                        </table>
                      </form>
                    </td>
                  </tr>
                </table>
              </td>
            </tr>
          </table>
        </td>
      </tr>
      <tr>
        <td>
          <? include('footer.php');?>
        </td>
      </tr>
    </table>
  </body>
</html>