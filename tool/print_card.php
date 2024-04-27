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
	<script type="text/javascript" src="../func/jquery.print.js"></script>
</head>
<body>
              <?php
				QRcode::png($certficate->f(cert_amulet).",".$certficate->f(cert_skin).",".$certficate->f(cert_year).",".$certficate->f(cert_detail)." :: ดูเพิ่มเติม www.praasia.com/certificate_scan.php?id=".$certficate->f(cert_id) , "../certificate_qr/".$certficate->f(cert_id).".png", "L", 16, 2);
			   ?>
<div class="print_container">
<table width="960" border="0" cellspacing="0" cellpadding="3">
  <tr>
    <td align="center">
	    <table width="328" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="63%" valign="top">
              <td valign="top">
              <img src="../certificate_qr/<?=$certficate->f(cert_id)?>.png" border="0" width="400" height="400">
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