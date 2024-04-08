<?php
	include('head.php');
	if(isset($_SESSION['admin_id'])){
		header("location:language_manage.php");
	}

	$do_what = $_POST['do_what'];
	if($do_what == "login"){
		if( $_POST['username'] == "teeadmin" && $_POST['password'] == "teehatyai99#"){
			$_SESSION['admin_id'] = $_POST['username'];
			header("location:language_manage.php");
		}else{
			echo "<script>alert('ไม่สามารถเข้าสู่ระบบเข้า กรุณาตรวจสอบ username และ password ใหม่อีกครั้ง');</script>";
			echo"<meta http-equiv='refresh' content='1;url=index.php'>";
		}
	}
?>
<body>
	<div id="wrapper">
		<?php
			include('header.php');
			?>
		<div id="container">
			<div class="box_content">
				<table width="1000px" border="0" align="center" cellpadding="5" cellspacing="0">
					<tr>
						<td width="250px" valign="top">
							&nbsp;
						</td>
						<td width="500px" valign="middle" height="300">
							<form method="post">
								<table width="100%" border="0" cellpadding="5" cellspacing="0">
									<tr>
										<td class="index-title" align="right">
											Username
										</td>
										<td class="index-title" align="center">:</td>
										<td class="index-title">
											<input type="text" name="username">
										</td>
									</tr>
									<tr>
										<td class="index-title" align="right">
											Password
										</td>
										<td class="index-title" align="center">:</td>
										<td class="index-title">
											<input type="password" name="password">
										</td>
									</tr>
									<tr>
										<td class="index-title">
											&nbsp;
										</td>
										<td class="index-title">&nbsp;</td>
										<td class="index-title">
											<input type="hidden" name="do_what" value="login">
											<input type="submit" value="Login Now">
											<input type="reset" value="Reset">
										</td>
									</tr>
								</table>
							</form>
						</td>
						<td width="250px" valign="top">
								&nbsp;
						</td>
					</tr>
				</table>
			</div>
		</div>
		<?php
			include('footer.php');
			?>
	</div>
</body>
</html>