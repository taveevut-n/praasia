<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>ยืนยันการชำระเงิน / 確認付款</title>
</head>

<body>
<table width="560" height="180" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="560" height="180" valign="top" style="background:url(images/preload.gif); border:1px solid #CCC">
    <form action="https://www.paypal.com/cgi-bin/webscr" method="post">
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td height="78" align="center"><img src="images/logo-paypal.jpg" width="200" height="69" /></td>
      </tr>
      <tr>
        <td height="29" align="center">&nbsp;</td>
      </tr>
      <tr>
        <td height="30" align="center">
        <?
		$fee = ($_POST['amount']+$_POST['shipping'])*1.05 ;
		?>
        <input type="hidden" name="cmd" value="_xclick">
        <input type="hidden" value="<?=$_POST['business']?>" name="business">
        <input type="hidden" name="item_name" value="<?=$_POST['item_name']?>">
        <input type="hidden" name="currency_code" value="THB">
        <input type="hidden" name="amount" value="<?=$fee?>">
        <input name="submit" type="submit" id="submit" value="ยืนยันการชำระเงิน / 確認付款" />
        </td>
      </tr>
    </table>
    </form>
    </td>
  </tr>
</table>
</body>
</html>
