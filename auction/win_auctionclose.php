<?php
	include('../global.php');
	$dbreg = mysql_fetch_array(mysql_query("SELECT * FROM auc_regist WHERE reg_id = '".$_GET['regid']."'"));
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
			<td style="white-space: nowrap;font-family: 'verdana';text-align: center;background: #FF8703;color: #FFF;">
				ระบบประมูลเว็บพระเอเซียปิดประมูลจากระบบ
			</td>
		</tr>
		<tr>
			<td style="white-space: nowrap;font-family: 'verdana';">
				ระบบได้ปิดประมูลรายการ <span style="color: #FF8703;"><?php echo $dbreg['reg_wattuname']?></span>
			</td>
		</tr>
		<tr>
			<td style="white-space: nowrap;font-family: 'verdana';">
				คลิกเพื่อตั้งประมูลใหม่ <a href="http://praasia.com/auction2/auction_regist.php?e=<?php echo $dbreg['reg_id']?>&repost=1" target="_blank">http://praasia.com/auction2/auction_regist.php?e=<?php echo $dbreg['reg_id']?>&repost=1</a>
			</td>
		</tr>
	</table>
</body>
</html>