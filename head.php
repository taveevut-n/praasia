<?php
include("index.css");
?>
<style type="text/css">
	.tb_headmenu{

	}
	.tb_headmenu td{
		padding: 2px 0px
	}
</style>
<table width="1000" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<!-- <td height="651" valign="bottom" style="background:url(images/bg_head.jpg)"> -->
			<td valign="bottom" style="background-color: #280000;">
				<table width="100%" border="0" cellspacing="0" cellpadding="0" class="tb_headmenu">
					<tr>
						<td align="left" width="1px"><a href="index.php" target="_blank"><img src="images/h_menu01.png"/></a></td>
						<td align="right" width="1px"><a href="chatweb.php" target="_blank"><img src="images/h_menu02.png"/></a></td>
					</tr>

					<?php 
					if (empty($_SESSION['shopname']) AND $_SESSION['shopname'] == '') {
						?>
						<tr>
							<td align="left" width="1px"><a href="regis_policy.php" target="_blank"><img src="images/h_menu03.png"/></a></td>
							<td align="right" width="1px"><a href="notice_payment.php" target="_blank"><img src="images/payment.jpg" width="467" height="37"/></a></td>
						</tr>
					<?php } ?>
					<?php 
					if (!isset($_SESSION['member_id'])) {?>
					<tr>
						<td align="left" width="1px"><a href="regis_gmember_policy.php" target="_blank"><img src="images/menu_member.jpg"/></a></td>
						<td align="right" width="1px"><a href="renew_age.php" target="_blank"><img src="images/h_menu08.png"/></a></td>
					</tr>
					<?php } ?>
					<tr>
						<td align="left" width="1px"><a href="register_referee_policy.php" target="_blank"><img src="images/app_referee.jpg" width="460" height="66"/></a></td>
						<td align="right" width="1px"><a href="all_cert.php" target="_blank"><img src="images/check_certificate.jpg"/></a></td>
					</tr>                
					<tr>
						<td align="left" width="1px"><a href="all_product.php" target="_blank"><img src="images/h_menu09.png"/></a></td>
						<td align="right" width="1px"><a href="call.php" target="_blank"><img src="images/h_menu10.png"/></a></td>
					</tr>
					<tr>
						<td align="left" width="1px"><a href="geji.php" target="_blank"><img src="images/h_menu11.png"/></a></td>
						<td align="right" width="1px"><a href="exp.php" target="_blank"><img src="images/h_menu12.png"/></a></td>
					</tr>
					<tr>
						<td align="left" width="1px"><a href="taradpranok.php" target="_blank"><img src="images/h_menu13.png"/></a></td>
						<td align="right" width="1px"><a href="advertise.php" target="_blank"><img src="images/h_menu14.png"/></a></td>
					</tr>
					<tr>
						<td align="left" width="1px"><a href="export.php" target="_blank"><img src="images/h_menu15.png"/></a></td>
						<td align="right" width="1px"><a href="help.php" target="_blank"><img src="images/h_menu16.png"/></a></td>
					</tr>
					<tr>
						<td align="left" width="1px"><a href="fee.php" target="_blank"><img src="images/menu_fee.jpg"/></a></td>
						<td align="right" width="1px"><a href="certificate_document_praasia.pdf" target="_blank"><img src="images/menu_download.jpg"/></a></td>
					</tr>                
				</table>
			</td>
		</tr>
		<tr>
			<td style="background:url(images/bg_head_bottom.png) no-repeat">&nbsp;

			</td>
		</tr>
	</table>
	<!-- Piwik -->

	<!-- End Piwik Code -->
