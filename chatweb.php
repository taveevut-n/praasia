<?php include("global.php"); 
   $q = "UPDATE `counter` SET `counter` = `counter`+1 WHERE `id` ='1' ";
   $db->query($q);
   ?>
<?php set_page($s_page,$e_page=282); //นำส่วนนี้ิไว้ด้านบน ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
   <head>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
      <title>ศูนย์รวมพระเครื่องออนไลน์</title>
      <META name=description content="ศนย์พระเครื่อง เปิดร้านพระออนไลน์" >
      <meta name="keywords" content="ศูนย์พระเครื่องภาคใต้, ศูนย์พระเครื่องภาคเหนือ, ศูนย์พระเครื่องกรุงเทพ, ศูนย์พระเครื่องอีสาน"/>
      <link rel="icon" href="/favicon.ico" type="image/x-icon" />
      <?php include("index.css"); ?>
      <!--jquery ui Local-->
      <link rel="stylesheet" href="func/jquery-ui-1.10.3/themes/base/jquery-ui.css" />
      <script src="func/jquery-ui-1.10.3/jquery-1.9.1.js"></script>
      <script src="func/jquery-ui-1.10.3/ui/jquery-ui.js"></script>
      <script src="func/jquery-ui-1.10.3/jquery.transit.min.js"></script>
      <!--CKEditor-->
      <script src="chatbox_editor/ckeditor/ckeditor.js"></script>
      <!--Iswallows Loading-->
    <!--   <script src="http://iswallows.com/func/loading/loading.js"></script> -->
      <!-- Lightbox -->
      <link rel="stylesheet" href="colorbox.css"/>
      <script src="jquery.colorbox.js"></script>
      <!-- load Galleria -->
      <script src="galleria/galleria-1.2.9.min.js"></script>
   </head>
   <body>
      <table width="1000" border="0" align="center" cellpadding="0" cellspacing="0">
         <tr>
            <td><? include('head.php') ?></td>
         </tr>
         <tr>
            <td>
               <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <!--Chatbox  -->
                  <tr>
                     <td>
                        <? include('chatbox_message.php'); ?>
                     </td>
                  </tr>
                  <!--End chat -->              
               </table>
            </td>
         </tr>
         <tr>
            <td align="center">
               <?php include('footer.php');?>
            </td>
         </tr>
      </table>
   </body>
</html>
