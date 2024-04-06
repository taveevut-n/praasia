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
</head>

<body>
<table width="1000" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td><? include('head.php') ?></td>
  </tr>
	<tr>
		<td>
		<table width="100%" border="0" cellspacing="0" cellpadding="0">	
          <tr>
		    <td style="background:url(images/bg.jpg) repeat-y; padding-left:5px">
			  <table width="100%" cellpadding="0" cellspacing="0" border="0">
              	<tr>
                    <td valign="top" style="padding-left:20px"><table width="95%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td height="500" valign="top" bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="10">
                          <tr>
                            <td align="center"><span style="font-size: 14px; color: #C00">วิธีการส่งสินค้า</span></td>
                          </tr>
                          <?php 
									$q="SELECT * FROM `export` WHERE 1 ";
									$dbnews= new nDB();
									$dbnews->query($q);
									$dbnews->next_record();
								  ?>
                          <tr>
                            <td><?=$dbnews->f(detail)?></td>
                          </tr>
                        </table></td>
                      </tr>
                    </table>
                    </td>
                </tr>
              </table>
            </td>
	      </tr>               
	    </table>
        </td>
	</tr>
	<tr>
	  <td><img src="images/footer.jpg" width="1000" height="136" /></td>
  </tr>   
    <tr>
  	<td>
                                <!--BEGIN WEB STAT CODE-->
<script type="text/javascript" src="http://hits.truehits.in.th/data/t0031244.js"></script>
<noscript>
<a target="_blank" href="http://truehits.net/stat.php?id=t0031244"><img src="http://hits.truehits.in.th/noscript.php?id=t0031244" alt="Thailand Web Stat" border="0" width="14" height="17" /></a>
<a target="_blank" href="http://truehits.net/">Truehits.net</a>
</noscript>
<!-- END WEBSTAT CODE -->    
    </td>
  </tr>  
</table>
</body>
</html>
