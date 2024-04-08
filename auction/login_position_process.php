<?
	include('../global.php');

	$do_what = $_POST['do_what'];
	if($do_what == "login_position"){
		$q_member = mysql_query("select * from auc_member where m_username = '".$_POST['username']."' and m_password = '".$_POST['password']."'");
		$count_member = mysql_num_rows($q_member);
		$r_member = mysql_fetch_array($q_member);
		if($count_member > 0){
			$_SESSION['aucuser_id'] = $r_member['m_id'];
			echo "<script language=\"javascript\">top.location='list_data.php'</script>";
		}else{
			echo "<script>alert('".$language['text_login_fail']."');</script>";
			echo "<script language=\"javascript\">top.location='index.php'</script>";
		}
		
	}
?>