<?php
	include("global.php");
	
	if($_POST["send"]){
	if ($_SESSION['adminshop_id']) {
		$mempost = $_SESSION['adminshop_id'] ;
	}
	if ($_SESSION['member_id']) {
		$mempost = $_SESSION['member_id'] ;
	}	
	
		$chattext = $_POST["chattext"];

		$filepart = $_FILES["chat_file"]["tmp_name"];
		$filename = $_FILES["chat_file"]["name"];
		if($filepart != ""){
			$fileextension = end(explode(".",$filename));
			$filename = time().".".$fileextension;
			copy($filepart,"img/chat/".$filename);
			$chattext = "<img src=\'img/chat/".$filename."\' height=\'100px\' border=\'0\'/>";
		}

		$q = "
			INSERT INTO `prachat` ( 
				`prachat_id` , 
				`member_id` , 
				`prachat_txt` , 
				`chat_date`
			)VALUES(
				'', 
				'".$mempost."', 
				'".$chattext."', 
				'".date("Y-m-d H:i:s")."' 
			);
		";
		$db->query($q);

	}
?>
<script>
	window.parent.$("textarea[name=chattext]").val("");
	window.parent.loading_hide();
	window.parent.$(".chatbox_iframe").attr("src", $(".chatbox_iframe").attr("src"));
</script>
