<?php
	$do_what = $_POST["dowhat"];

	if ($do_what == "del_image") {
		$file_name = $_POST["file_name"];
		unlink("img/content_certificate/".$file_name."");
		echo "img/content_certificate/".$file_name;
	}
?>
