<?php
	include('../global.php');
	
	include('head.php');

	$do_what = $_POST['do_what'];
	if( $do_what == "login"){
		$q_member = mysql_query("select * from auc_member where m_username = '".$_POST['username']."' and m_password = '".$_POST['password']."'");
		$count_member = mysql_num_rows($q_member);
		$r_member = mysql_fetch_array($q_member);
		if($count_member > 0){
			$_SESSION['aucuser_id'] = $r_member['m_id'];
			header("location:profile.php");
		}else{
			echo "<script>alert('".$language['text_login_fail']."');</script>";
			echo"<meta http-equiv='refresh' content='0;url=index.php'>";
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
				<form action="" method="post" name="frmmem_login" id="frmmem_login" style="margin: 0;">
					<table width="1000px" border="0" align="center" cellpadding="0" cellspacing="0" class="condition_tb_textjustify">
						<tr>
							<td colspan="2" bgcolor="#4A1701" class="head_contain" style="padding-left: 11px;text-align:left;">
									<span class="text_yellpw"><strong><?=$language['text_login'];?></strong></span>
							</td>
						</tr>
						<tr>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
						</tr>
						<tr>
							<td width="400px" align="right"><strong><?=$language['username'];?> : </strong></td>
							<td width="500px"><input type="text" name="username" id="username"></td>
						</tr>
						<tr>
							<td align="right"><strong><?=$language['password'];?> : </strong></td>
							<td><input type="password" name="password" id="password"></td>
						</tr>
						<tr>
							<td align="right">&nbsp;</td>
							<td>
								<input type="hidden" name="do_what" value="login">
								<input type="submit" name="btnSubmit" id="btnSubmit" value="ตกลง">
								<input type="submit" name="btnReset" id="btnReset" value="ยกเลิก">
							</td>
						</tr>
						<tr>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
						</tr>
					</table>
				</form>
			</div>
		</div>
		<?php
			include('footer.php');
			?>
	</div>
</body>
</html>