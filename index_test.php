<?php
	include("global.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

	<title>
		พระหาดใหญ่ ศูนย์รวมพระเครื่องเอเซียตะวันออกเฉียงใต้ 合艾佛牌网
	</title>

	<!--jquery ui Local-->
	<link rel="stylesheet" href="func/jquery-ui-1.10.3/themes/base/jquery-ui.css" />
	<script src="func/jquery-ui-1.10.3/jquery-1.9.1.js"></script>
	<script src="func/jquery-ui-1.10.3/ui/jquery-ui.js"></script>
	<script src="func/jquery-ui-1.10.3/jquery.transit.min.js"></script>

	<!--CKEditor-->
	<script src="chatbox_editor/ckeditor/ckeditor.js"></script>

	<!--Iswallows Loading-->
	<!-- <script src="http://iswallows.com/func/loading/loading.js"></script> -->

	<!--Iswallows touchTouch-->
	<link rel="stylesheet" href="http://iswallows.com/func/touch/assets/touchTouch/touchTouch.css" />
	<script src="http://iswallows.com/func/touch/assets/touchTouch/touchTouch.jquery.js"></script>

	<style>
		html, body {
			margin:0px;
			padding:0px;
			width:100%;
			height:100%;
		}
		body {
			background-color:#000000;
		}
	</style>

</head>
<body>
	<table width="980px" align="center" border="0" cellpadding="0" cellspacing="0">
		<tr>
			<td>
				&nbsp;
			</td>
		</tr>
		<tr>
			<td>
				<?php
					include("chatbox_message.php");
				?>
			</td>
		</tr>
	</table>
</body>
</html>
