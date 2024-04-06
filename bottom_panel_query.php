<?php
	include("global.php");

	$do_what = $_POST["do_what"];

if($do_what == "translate_text"){

		$v = trim($_POST["v"]);
		if($v != ""){
			$qlike_thai = mysql_query("select * from pra_translate where translate_text like '%$v%' group by translated_text limit 5");
			$nlike_thai = mysql_num_rows($qlike_thai);
			if($nlike_thai > 0){
				$q_thai = mysql_query("select * from pra_translate where translate_text = '$v'");
				$n_thai = mysql_num_rows($q_thai);
				if($n_thai > 0){
?>
<table border="0" cellpadding="0" cellspacing="0">
	<?php
		while($thai = mysql_fetch_array($q_thai)){
	?>
	<tr>
		<td style="color:#060; border-bottom:1px dashed #cccccc;">
			<?=$thai["translated_text"]?>
		</td>
	</tr>
	<?php
		}
	?>
</table>
<?php
				}else{
?>
<table border="0" cellpadding="0" cellspacing="0">
	<?php
		while($like_thai = mysql_fetch_array($qlike_thai)){
	?>
	<tr>
		<td style="border-bottom:1px dashed #cccccc;">
			<?=$like_thai["translated_text"]?>
		</td>
	</tr>
	<?php
		}
	?>
</table>
<?php
				}
			}else{
				$qlike_china = mysql_query("select * from pra_translate where translated_text like '%$v%' group by translate_text limit 5");
				$nlike_china = mysql_num_rows($qlike_china);
				if($nlike_china > 0){
					$q_china = mysql_query("select * from pra_translate where translated_text = '$v'");
					$n_china = mysql_num_rows($q_china);
					if($n_china > 0){
?>
<table border="0" cellpadding="0" cellspacing="0">
	<?php
		while($china = mysql_fetch_array($q_china)){
	?>
	<tr>
		<td style="color:#060; font-weight:bold; border-bottom:1px dashed #cccccc;">
			<?=$china["translate_text"]?>
		</td>
	</tr>
	<?php
		}
	?>
</table>
<?php
					}else{
?>
<table border="0" cellpadding="0" cellspacing="0">
	<?php
		while($like_china = mysql_fetch_array($qlike_china)){
	?>
	<tr>
		<td style="border-bottom:1px dashed #cccccc;">
			<?=$like_china["translate_text"]?>
		</td>
	</tr>
	<?php
		}
	?>
</table>
<?php
					}
				}
			}
		}

		if($v != ""){
			$qlike_thai = mysql_query("select * from pra_translate_name where name_text like '%$v%' group by name_translated limit 5");
			$nlike_thai = mysql_num_rows($qlike_thai);
			if($nlike_thai > 0){
				$q_thai = mysql_query("select * from pra_translate_name where name_text = '$v'");
				$n_thai = mysql_num_rows($q_thai);
				if($n_thai > 0){
?>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
	<?php
		while($thai = mysql_fetch_array($q_thai)){
	?>
	<tr>
		<td style="color:#060; border-bottom:1px dashed #cccccc;">
			<?=$thai["name_translated"]?>
		</td>
	</tr>
	<?php
		}
	?>
</table>
<?php
				}else{
?>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
	<?php
		while($like_thai = mysql_fetch_array($qlike_thai)){
	?>
	<tr>
		<td style="border-bottom:1px dashed #cccccc;">
			<?=$like_thai["name_translated"]?>
		</td>
	</tr>
	<?php
		}
	?>
</table>
<?php
				}
			}else{
				$qlike_china = mysql_query("select * from pra_translate_name where name_translated like '%$v%' group by name_text limit 5");
				$nlike_china = mysql_num_rows($qlike_china);
				if($nlike_china > 0){
					$q_china = mysql_query("select * from pra_translate_name where name_translated = '$v'");
					$n_china = mysql_num_rows($q_china);
					if($n_china > 0){
?>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
	<?php
		while($china = mysql_fetch_array($q_china)){
	?>
	<tr>
		<td style="color:#060; border-bottom:1px dashed #cccccc;">
			<?=$china["name_text"]?>
		</td>
	</tr>
	<?php
		}
	?>
</table>
<?php
					}else{
?>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
	<?php
		while($like_china = mysql_fetch_array($qlike_china)){
	?>
	<tr>
		<td style="border-bottom:1px dashed #cccccc;">
			<?=$like_china["name_text"]?>
		</td>
	</tr>
	<?php
		}
	?>
</table>
<?php
					}
				}
			}
		}

	}

	if($do_what == "translate_leave"){
		$v = $_POST["v"];
		$n = mysql_num_rows(mysql_query("select * from pra_translate where translate_text = '$v' or translated_text = '$v'"));
		if($n > 0){
			echo "<font color='blue'>ข้อความนี้ได้ถูกฝากแปลแล้ว กรุณารอคำแปลภายใน 24 ชั่วโมงถึงจะใช้ได้ / 本词句已被翻译 等待管理员24小时内会给你翻译</font>";
		}else{
			mysql_query("insert into pra_translate( translate_id, translate_text, translated_text, leave_date ) values( '', '$v', '', '".date("Y-m-d H:i:s")."' )");
			echo "<font color='green'>ฝากแปลช้อความเรียบร้อยแล้ว / 信息已被发送</font>";
		}
	}

?>
