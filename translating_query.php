<?php
	include("global.php");
	$v = $_POST["v"];
	if($v != ""){
?>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
	<?php
		$q_translate = mysql_query("select * from pra_translate where translate_text like '%".$v."%'");
		while($translate = mysql_fetch_array($q_translate)){
	?>
	<tr>
		<td class="translated_td" onclick="translated_select('<?=$translate["translated_text"]?>');">
			<?=$translate["translated_text"]?>
		</td>
	</tr>
	<?php
		}
	?>
	<?php
		$q_translate = mysql_query("select * from pra_translate_name where name_text like '%".$v."%'");
		while($translate = mysql_fetch_array($q_translate)){
	?>
	<tr>
		<td class="translated_td" onclick="translated_select('<?=$translate["name_translated"]?>');">
			<?=$translate["name_translated"]?>
		</td>
	</tr>
	<?php
		}
	?>
</table>
<?php
	}
?>
