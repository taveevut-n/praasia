<?php
	include('../global.php');
	$do_what = $_POST['do_what'];
	if( $do_what == "insert_corde"){
		if($_POST['text_code'] != ""){
			$qcoupon = mysql_query("select * from auc_coupon where cp_code = '".$_POST['text_code']."' ");
			$ncoupon = mysql_num_rows($qcoupon);
			if($ncoupon <= 0){
				echo "<script language=\"javascript\">alert('ไม่พบรหัสคูปองนี้ในระบบ')</script>";
				echo "<script language=\"javascript\">top.location='coupon_regist.php'</script>";
			}else{
				$rcoupon = mysql_fetch_array($qcoupon);
				$rpackage = mysql_fetch_array(mysql_query("select * from auc_couponpackage where cp_pid = '".$rcoupon['cp_fkpackage']."' "));
				if($rcoupon['cp_user'] != ""){
					echo "<script language=\"javascript\">alert('รหัสคูปองนี้ ถูกใช้งานแล้ว')</script>";
					echo "<script language=\"javascript\">top.location='coupon_regist.php'</script>";
				}else{
					$sql_coupon =	"update auc_coupon 
										set  cp_user = '".$_SESSION['aucuser_id']."'
										where cp_id = '".$rcoupon['cp_id']."' 
									";
					$q_coupon = mysql_query($sql_coupon);

					$amount = $rpackage['cp_pamout'];
					$sql_member =	"update auc_member 
										set  m_countproduct = m_countproduct + '$amount' 
										where m_id = '".$_SESSION['aucuser_id']."' 
									";
					$q_member = mysql_query($sql_member);
					echo "<script language=\"javascript\">top.location='profile.php'</script>";
				}
			}
		}else{
			echo "<script language=\"javascript\">alert('กรุณากรอกข้อมูลให้ครบถ้วนด้วยครับ')</script>";
			echo "<script language=\"javascript\">top.location='coupon_regist.php'</script>";
		}
	}
?>