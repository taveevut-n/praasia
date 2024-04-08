<?
	include('../../global.php');
	$do_what = $_POST['do_what'];
	if($do_what == "selectCatg"){
		mysql_query("UPDATE auc_catalog_all SET catalog_show = ".$_POST[_val]." WHERE catalog_id='".$_POST[_id]."' ");
	}

?>