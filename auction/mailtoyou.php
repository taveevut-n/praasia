<? include('../global.php');?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title></title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<style type="text/css">
			body{
				font-size: 13px;
			}
		</style>
	</head>
	<body bgcolor="#FDCB84">
		<form name="sendmail" id="sendmail" method="post" action="mailtoyou_process.php" target="sendmail">
			<iframe src="" name="sendmail" width="1px" height="0px" frameborder="0" id="sendmail"></iframe> 
			<table width="100%" height="100%" border="3" align="center" cellpadding="0" cellspacing="0" bordercolor="#CCCCCC">
				<tr>
					<td width="100%" align="center" bgcolor="#4A1701" style="font-size: 14px;color: #eee;height: 100px;">
							<b>กรุณากรอกข้อความที่ท่านต้องการส่ง</b>
					</td>
				</tr>
				<tr>
					<td align="center" valign="middle">
						<table width="100%" height="100%" border="0" align="center" bgcolor="#FFCC66">
							<tr>
								<td width="20%" align="right" valign="middle">&nbsp;</td>
								<td width="80%" valign="middle">
									&nbsp;
								</td>
							</tr>
							<tr>
								<td width="20%" align="right" valign="middle">
									<b>ส่งข้อความถึง :</b>
								</td>
								<td width="80%" valign="middle">
									<input name="subject" type="text" value="<?=$_GET['creator1']?>" readonly disabled>
								</td>
							</tr>
							<tr>
								<td valign="middle" align="right">
									<b>เรื่อง :</b>
								</td>
								<td valign="middle"><input name="subject" type="text">
								</td>
							</tr>
							<tr>
								<td height="107" valign="top" align="right">
									<b>ข้อความ :</b>
								</td>
								<td valign="top">
									<textarea name="message" cols="50" rows="5"></textarea>
								</td>
							</tr>
							<tr>
								<td valign="middle" align="right">
									<b>ส่งโดย :</b>
								</td>
								<td align="left" valign="middle">
									<?
									$rmember = mysql_fetch_array(mysql_query("select * from auc_member where m_id = '".$_SESSION['aucuser_id']."' "));
									echo $rmember['m_username'].' &lt;&lt;'.$rmember['m_email'].'&gt;&gt;';
									?>
								</td>
							</tr>
							<tr>
								<td valign="middle">
									&nbsp;
								</td>
								<td align="left" valign="middle">
									&nbsp;
								</td>
							</tr>
							<tr>
								<td valign="middle">
									&nbsp;
								</td>
								<td align="left" valign="middle">
									<input name=Submit type=Submit value="ส่ง Mail" >
									<input type="hidden" name="username" value="<?=$rmember['m_username']?>">
									<input type="hidden" name="email_sender" value="<?=$rmember['m_email']?>">
									<input type="hidden" name="email_recip" value="<?=$_GET['creator1_email']?>">
									<input name=button type=button value="ปิด" onclick="window.close()">  
								</td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
		</form>
	</body>
</html>