<?php
	include('../global.php');

	$do_what = $_POST['do_what'];
	if( $do_what == "login"){
		$q_member = mysql_query("SELECT * FROM auc_member WHERE m_username = '".$_POST['username']."' and m_password = '".$_POST['password']."'");
		$count_member = mysql_num_rows($q_member);
		$r_member = mysql_fetch_array($q_member);
		if($count_member > 0){
			$_SESSION['aucuser_id'] = $r_member['m_id'];
		}else{
			echo "<script>alert('".$language['text_login_fail']."');</script>";
		}
		
		echo "<script language=\"javascript\">top.location='index.php'</script>";
	}

	if( $do_what == "feed_insert"){
		$result = mysql_query("INSERT INTO auc_feedback (feed_text,feed_type,feed_to,reg_id,m_id) VALUES ('".$_POST['txt_feeddetail']."','".$_POST['feedtype']."','".$_POST['txt_to']."','".$_POST['reg_id']."','".$_SESSION['aucuser_id']."')");
		if($result){
			echo "<script language=\"javascript\">alert('ระบบทำการบันทึกข้อมูลเรียบร้อย')</script>";
			echo "<script language=\"javascript\">top.location='feedback_list_data.php'</script>";
		}
	}
?>