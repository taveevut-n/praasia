<?php
	include('../global.php');
	
	include('head.php');
	?>
<body>
	<div id="wrapper">
		<?php
			include('header.php');
			?>
		<div id="container">
			<div class="box_content">
				<style type="text/css">
					.showdata{
						border-collapse: collapse;
					}
					.showdata td{
						padding: 2px 6px 0 2px;
					}
					/*.tableaucregist tr td{
						border: 1px solid #814A00;
					}*/
					.tablebordernone tr td{
						border: 0px;
					}
					.tablecondition tr td{
							border-bottom: 1px solid #F89A1B;
					}
					.text_head{
						margin-left: 4px;
						line-height: 24px;
					}
					.tabel_coupon{
						background: rgb(216, 139, 67);
						padding: 13px;
						margin: 28px;
						border-radius: 7px;
						border-collapse: collapse;
					}
					.tabel_coupon td{
						background: transparent;
						border: 0;
						padding: 5px 8px;
					}
				</style>
				<form action="coupon_regist_process.php" method="post" name="frmauc_regist" id="frmauc_regist" enctype="multipart/form-data" target="reg_frm" style="margin: 0;">
					<iframe src="" name="reg_frm" width="1px" height="0px" frameborder="0" id="reg_frm"></iframe> 
					<table width="1000" border="0" align="center" cellpadding="0" cellspacing="0" class="showdata tableaucregist">
						<tr>
							<td height="33" colspan="2" align="center" bgcolor="#603C18"><font color="#FFFFFF">
								<strong><?=$language['text_couporn_welcom'];?></strong></font>
							</td>
						</tr>
						<tr>
							<td colspan="2" align="center" valign="top" bgcolor="#FBE88A">
								<table border="0" cellpadding="0" align="center" cellspacing="0" class="tabel_coupon">
									<tr>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
									</tr>
									<tr>
										<td><b><?=$language['text_couporn_code'];?></b></td>
										<td><input type="text" name="text_code"></td>
									</tr>
									<tr>
										<td>&nbsp;</td>
										<td align="center">
											<input type="hidden" name="do_what" value="insert_corde">
											<input type="submit" name="btnsubmit" value="ตกลง">
											<input type="reset" name="btnsubmit" value="ยกเลิก">
										</td>
									</tr>
								</table>
							</td>
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