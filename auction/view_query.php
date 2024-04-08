<?
	include('../global.php');
	
	$member_id = $_SESSION['aucuser_id'];
	$do_what = $_POST['do_what'];

	if($do_what == "perfile"){
		for ($i=0; $i < count($_FILES['fileImg']["name"]); $i++) { 
			$filepart = $_FILES["fileImg"]["tmp_name"][$i];
			$filename = $_FILES["fileImg"]["name"][$i];
			if(trim($_FILES["fileImg"]["name"][$i] != "")){
				list($txt, $ext) = explode(".", $filename);
				$filename = time().substr(str_replace(" ", "_", $txt), 5).".".$ext;
				copy($filepart,"fileupload/".$filename);
				$str = "insert into auc_axpend 
						(
							exp_file,
							exp_created,
							exp_aucid
						) values (
							'".$filename."',
							'".date("Y-m-d H:i:s")."',
							'".$_POST['auction_id']."'
						)";
				mysql_query($str);
			}
		}
		
		echo "<script language=\"javascript\">top.location='view.php?id=".$_POST['auction_id']."'</script>";	
	}
?>