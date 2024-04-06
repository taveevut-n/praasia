<? 
include('../global.php');
include("../func/phpqrcode/qrlib.php");
if ($_GET['cert_id']) {
	$_SESSION['cert_id'] = $_GET['cert_id'];
}

$q="SELECT * FROM `cert` WHERE cert_id = '".$_SESSION['cert_id']."' ";
$certficate=new nDB();
$certficate->query($q);
$certficate->next_record();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" style="height:100%">
<head>
	<!--jquery ui Local-->
	<link rel="stylesheet" href="../func/jquery-ui-1.10.3/themes/base/jquery-ui.css" />
	<script src="../func/jquery-ui-1.10.3/jquery-1.9.1.js"></script>
	<script src="../func/jquery-ui-1.10.3/ui/jquery-ui.js"></script>
	<script src="../func/jquery-ui-1.10.3/jquery.transit.min.js"></script>

	<link rel="stylesheet" href="font-awesome/css/font-awesome.min.css">

	<!--Jquery print-->
	<script type="text/javascript" src="http://iswallows.com/func/jquery.print.js"></script>
</head>
<body>
              <?php
				QRcode::png($certficate->f(cert_amulet).",".$certficate->f(cert_skin).",".$certficate->f(cert_year).",".$certficate->f(cert_detail)."view" , "../certificate_qr/".$certficate->f(cert_id).".png", "L", 16, 2);
			   ?>
<div class="print_container">
<table width="960" border="0" cellspacing="0" cellpadding="3">
  <tr>
    <td align="center">
    <table width="328" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td height="197" valign="top">
    <div style="position:absolute; z-index:1">
    <table width="328" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td><img src="images/cert_print-s.jpg" width="328" height="197" /></td>
      </tr>
    </table>
    </div>
    <div style="position:absolute; z-index:10">
    <table width="328" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="63%" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td height="95">&nbsp;</td>
            </tr>
          <tr>
            <td>
            <table width="100%" border="0" cellspacing="0" cellpadding="1">
              <tr>
                <td align="center" style="font-size:11px; font-weight:bold"><?=$certficate->f(cert_amulet)?></td>
              </tr>
              <tr>
                <td align="center" style="font-size:11px; font-weight:bold"><?=$certficate->f(cert_skin)?></td>
              </tr>
              <tr>
                <td align="center" style="font-size:11px; font-weight:bold"><?=$certficate->f(cert_year)?></td>
              </tr>
              <tr>
                <td align="center"  style="font-size:11px; font-weight:bold">(<?=$certficate->f(cert_detail)?>)</td>
              </tr>
              <tr>
                <td align="center" height="12">&nbsp;</td>
              </tr>
              <tr>
                <td align="center"  style="font-size:11px; font-weight:bold"><?=$certficate->f(cert_owner)?>/เจ้าของพระ</td>
              </tr>
            </table></td>
            </tr>
        </table></td>
        <td width="37%" valign="top">
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td height="12"></td>
              </tr>
              <tr>
                <td><img src="../resize/w107-h152/img/certificate/<?=$certficate->f(cert_pic)?>" /></td>
              </tr>
              <tr>
              	<td height="5"></td>
              </tr>
              <tr>
                <td style="font-size:3px;" align="center"><?=$certficate->f(cert_code)?></td>
              </tr>
              <tr>
                <td style="font-size:3px;" align="center">วันที่ออกบัตร <?=date("d/m/Y")?></td>
              </tr>                            
            </table>        
        </td>
      </tr>
    </table>
    <div>
    </td>
    </tr>
</table></td>
  </tr>
  <tr>
    <td align="center">
    <table width="328" border="0" cellspacing="0" cellpadding="0" align="center">
      <tr>
        <td height="197" valign="top">
          <div style="position:absolute; z-index:1">
          	<table>
            	<tr>
                	<td>
                    	<img src="images/cert_printback-s.jpg" />
                    </td>
                </tr>
            </table>
          </div>
          <div style="position:absolute; z-index:10">
          <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="16" height="67">&nbsp;</td>
              <td width="317">&nbsp;</td>
            </tr>
            <tr>
              <td height="144">&nbsp;</td>
              <td valign="top">
              <img src="../certificate_qr/<?=$certficate->f(cert_id)?>.png" border="0" width="92" height="92">
			  </td>
            </tr>
          </table>        
          </div>
        </td>
      </tr>
    </table>
    </td>
  </tr>
  <tr>
    <td align="center"><input type="button" id="print_btn" onClick="$('.print_container').print();" value="Print"></td>
  </tr>
</table>
</div>
</body>
</html>
