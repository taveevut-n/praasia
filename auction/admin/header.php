<div id="header">
	<div class="panal_language">
		<table border="0" cellpadding="3" cellspacing="3">
			<tr>
				<?php
					if($_SESSION['admin_id'] != ""){
						?>
				<td>
					<a href="logout.php"><?=$language['link_member_logout'];?></a>
				</td>
				<td>
					|
				<td>
						<?
					}
				?>
				<td><?=$language['btn_language'];?> : </td>
				<td><img src="images/th.png" onclick="window.location.href='?lang=th';" style="cursor: pointer;"></td>
				<td><img src="images/jp.png" onclick="window.location.href='?lang=ch';" style="cursor: pointer;"></td>
			</tr>
		</table>
	</div>
	<table width="100%" border="0" cellpadding="0" cellspacing="0" align="center">
		<tr>
			<td>
				<img src="../images/banner_other_pro.gif" border="0">
			</td>
		</tr>
	</table>
</div>