<form id="form1" name="form1" method="post" action="login_position_process.php" enctype="multipart/form-data" target="reg_login">
	<table border="0" cellpadding="0" align="center" cellspacing="0">
		<tr>
			<td><?=$language['username'];?></td>
		</tr>
		<tr>
			<td><input type="text" name="username" id="username"></td>
		</tr>
		<tr>
			<td><?=$language['password'];?></td>
		</tr>
		<tr>
			<td><input type="password" name="password" id="password"></td>
		</tr>
		<tr align="center">
			<td>
				<input type="hidden" name="do_what" value="login_position">
				<input type="submit" name="btnSubmit" id="btnSubmit" value="ตกลง">
				<input type="submit" name="btnReset" id="btnReset" value="ยกเลิก">
			</td>
		</tr>
	</table>
	<iframe src="" name="reg_login" width="1px" height="0px" frameborder="0" id="reg_login"></iframe> 
</form>