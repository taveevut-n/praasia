<?php
	include("global.php");
	$do_what = $_POST["do_what"];
	if($do_what == "file_upload"){
		if(isset($_POST["post_id"]) && $_POST["post_id"] != ""){
			$ProjectID = $_POST["post_id"];
		}else{
			$ProjectID = mysql_result(mysql_query("SELECT `AUTO_INCREMENT` FROM  INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = 'prathai_new' AND   TABLE_NAME   = 'content_certificate'"),0);
		}

		$filepart = $_FILES["ProjectSlide"]["tmp_name"];
		$filename = $_FILES["ProjectSlide"]["name"];
		$file_index = $_POST["file_index"];
		$fileextension = end(explode(".",$filename));

		$filename = $ProjectID."_".$file_index."_".time().".".$fileextension;
		
		move_uploaded_file($filepart,"img/referee_collect/".$filename);
		mysql_query("INSERT INTO collection (collection_id,collection_img,collection_order,content_id) VALUES (NULL,'$filename','$file_index','$ProjectID') ");
	}

	if($do_what == "upload_remove"){
		$filename = $_POST["pic_name"];
		unlink("img/referee_collect/".$filename);
		mysql_query("DELETE FROM collection WHERE collection_img = '".$filename."' ");
	}

	if($do_what == "sort_order"){
	

		foreach ($_POST["order"] as $key => $value) {
			mysql_query("UPDATE collection SET collection_order = '".$key."' WHERE collection_id = ".$value." ");
		}
	}

?>