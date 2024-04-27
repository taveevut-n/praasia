<?php
	include('../global.php');
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<table width="100%">
		<tr>
			<td align="center" valign="middle">
				<img src="../img/<?=$_GET["f"]?>/<?=$_GET["pic"]?>">
			</td>
		</tr>
		<tr>
			<td height="30"></td>
		</tr>
		<tr>
			<td align="center">
				<h2><?=$_GET["name"]?></h2>
			</td>
		</tr>
	</table>
</body>
</html>