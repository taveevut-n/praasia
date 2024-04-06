<? include('../global.php');?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title></title>
</head>

<body>
						  <?php 
						  	$q="SELECT * FROM `certificate_doc` WHERE certdoc_id = '".$_GET['certdoc_id']."' ";
							$db->query($q);
							static $v=1;
							$db->next_record();
							?>
<table width="1000" border="0" align="center" cellpadding="5" cellspacing="0">
  <tr>
    <td height="100"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="71%">&nbsp;</td>
        <td width="29%"><table width="100%" border="0" cellspacing="0" cellpadding="3">
          <tr>
            <td>เลขที่อ้างอิง : <?=$db->f(certdoc_code)?></td>
          </tr>
          <tr>
            <td>วันที่ : <?=$db->f(certdoc_update)?></td>
          </tr>
        </table></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="5">
      <tr>
        <td width="13%" align="right"><strong>เรียนคุณ</strong></td>
        <td width="87%"><?=$db->f(certdoc_name)?></td>
      </tr>
      <tr>
        <td align="right"><strong>เรื่อง</strong></td>
        <td> แจ้งผลการตรวจสอบพระเครื่อง</td>
      </tr>
      <tr>
        <td align="right">&nbsp;</td>
        <td>สำนังานเว็บพระเอเชีย ขอแจ้งผลการตรวจสอบพระเครื่องที่ท่านส่งตรวจสอบดังรายละเอียด ดังต่อไปนี้</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td><table width="100%" border="1" cellspacing="0" cellpadding="3" bordercolor="#000000" style="border-collapse:collapse">
      <tr style="font-size:18px; font-weight:bold">
        <td width="7%" height="30" align="center">ลำดับ</td>
        <td width="37%" align="center">รายการพระเครื่อง</td>
        <td width="19%" align="center">ผลตรวจสอบ</td>
        <td width="19%" align="center">หมายเลข ID</td>
        <td width="18%">หมายเหตุ</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
</table>
</body>
</html>
