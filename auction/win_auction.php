<?php
	include('../global.php');
	$dbreg = mysql_fetch_array(mysql_query("SELECT * FROM auc_regist ar LEFT JOIN auc_member am ON ar.reg_winid = am.m_id WHERE ar.reg_id = '".$_GET['regid']."'"));
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta content=All name=ROBOTS>
</head>

<body>
	<table width="500"  align="left"  border="1" cellpadding="6" cellspacing="0" style="border-collapse: collapse;border: 1px solid #ddd;">
		<tr>
			<td style="white-space: nowrap;font-family: 'verdana';text-align: center;background:#36822D;color: #FFF;">
				ระบบประมูลเว็บพระเอเซียปิดประมูล
			</td>
		</tr>
		<tr>
			<td style="white-space: nowrap;font-family: 'verdana';">
				ผู้ชนะประมูลได้ชนะประมูลรายการ <span style="color: #FF8703;"><?php echo $dbreg['reg_wattuname']?></span>
			</td>
		</tr>
		<tr>
			<td style="white-space: nowrap;font-family: 'verdana';">
				ผู้ชนะประมูล <span style="color: #FF8703;"><?php echo $dbreg['m_name'].' '.$dbreg['m_surname'].'&nbsp;('.$dbreg['m_username'].')';?></span>
			</td>
		</tr>
		<tr>
			<td style="white-space: nowrap;font-family: 'verdana';">
				คลิกเพื่อติดต่ดผู้ชนะประมูล <a href="http://praasia.com/auction2/win_contact.php?regid=<?php echo $dbreg['m_id']?>" target="_blank">http://praasia.com/auction2/win_contact.php?regid=<?php echo $dbreg['m_id']?></a>
			</td>
		</tr>
	</table>
</body>
</html>