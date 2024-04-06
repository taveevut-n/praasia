<?php include("global.php"); 
	include("global_counter.php");
	
	if ($_GET['id']) {
		$_SESSION['cert_id'] = $_GET['id'];
	}

$q="SELECT * FROM `cert` WHERE cert_id = '".$_SESSION['cert_id']."' ";
$certficate=new nDB();
$certficate->query($q);
$certficate->next_record();
	?>
<?php set_page($s_page,$e_page=84); //นำส่วนนี้ิไว้ด้านบน ?>
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
	</head>
	<body>
		<table width="1000" border="0" align="center" cellpadding="0" cellspacing="0">
			<tr>
			<td>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  	<tr>
    	<td height="60" align="center"  style="font-size:56px; color:#F90">
        ID : <?=$certficate->f(cert_code)?>
        </td>
    </tr>
    <tr>
    <td align="center" height="50"  valign="top"  style="font-size:36px; color:#FFF">
	<?=$certficate->f(cert_amulet)?><?=$certficate->f(cert_skin)?><?=$certficate->f(cert_year)?><?=$certficate->f(cert_detail)?>
    </td>
    </tr>
    <tr>
    	<td align="center" style="padding:5px">
        	<img src="img/certificate/<?=$certficate->f(pic1)?>" />
        </td>
    </tr>
    <tr>
    	<td align="center" style="padding:5px">
        	<img src="img/certificate/<?=$certficate->f(pic2)?>" />
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
