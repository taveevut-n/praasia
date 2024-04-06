<?php
	include("global.php");

	$translate_text = $_POST["translate_text"];

	if($translate_text != ""){
		mysql_query("insert into pra_translate( translate_id, translate_text, translated_text ) values('', '$translate_text', '')");
		echo "
			<script>
				window.parent.translate_sandcomplete('".$translate_text."');
			</script>
		";
	}
?>
