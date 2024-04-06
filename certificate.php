<?php include("global.php"); 
	include("global_counter.php");
	
	if ($_POST['cert_code']) {
		$_SESSION['cert_code'] = $_POST['cert_code'];
	}

	if ($_GET['cert_code']) {
		$_SESSION['cert_code'] = $_GET['cert_code'];
	}	

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
			<td><? include('head.php') ?></td>
			</tr>
			<tr>
			<td>
				<table width="100%" border="0" cellspacing="0" cellpadding="0">
					<tr>
							<td style="background:url(images/bg.jpg) repeat-y;">
								<? include('listshop.php'); ?>
							</td>
					</tr>
                    <tr>
                    	<td height="50" bgcolor="#FFCC00" align="center">
                        <form method="post" action="search_certificate.php">
                        	<table width="100%" border="0" cellspacing="0" cellpadding="3">
                              <tr>
                                <td align="center">
                                ค้นหาพระเครื่องที่ออกบัตร / 搜索出卡的项目
 : <input type="text" value="<?=$_SESSION['search_q']?>" name="q" style="width:60%" /> <input name="submit" type="submit" id="submit" value="Search" />
                                </td>
                              </tr>
                            </table>
                            </form>
                        </td>
                    </tr>					
					<tr>
						<td style="background:#000">
						<table width="100%" cellpadding="0" cellspacing="0">

							<tr>
								<!-- <td width="262" valign="top">
									left_search
								</td> -->
								<td width="731" align="center" valign="top">
                                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <?
$q="SELECT * FROM `cert` WHERE cert_code = '".$_SESSION['cert_code']."' ";
$certficate=new nDB();
$certficate->query($q);
$certficate->next_record();
$chk_cert = $certficate->num_rows();
								if ($chk_cert > 0) {	
								?>
                                	<tr>
                                    	<td>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  	<tr>
    	<td height="60" align="center"  style="font-size:24px; color:#FFF">
        ID : <?=$_SESSION['cert_code']?>
        </td>
    </tr>
    <tr>
    <td align="center" height="50"  valign="top"  style="font-size:18px; color:#FFF">
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
                                    <? } else { ?>
                                    <tr>
                                    	<td style="color:#F00; font-size:14px" align="center">
                                        	ไม่พบบัตรรับรองที่คุณค้นหา
                                        </td>
                                    </tr>
                                    <? } ?>                               
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
				<td>
					<? include('footer.php');?>
				</td>
			</tr>
		</table>
	</body>
</html>
