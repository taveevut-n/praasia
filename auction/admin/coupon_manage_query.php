<?
	include('../../global.php');
	function generateRandomString($length = 10) {
	    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	    $randomString = '';
	    for ($i = 0; $i < $length; $i++) {
	        $randomString .= $characters[rand(0, strlen($characters) - 1)];
	    }
	    return $randomString;
	}

	$do_what = $_POST['do_what'];
	if($do_what == "coupon_insert"){
		$quser = mysql_query("select * from auc_member where m_username = '".$_POST['buyer']."' ");
		$ruser = mysql_fetch_array($quser);
		$id_user = $ruser['m_id'];
		$numuser = mysql_num_rows($quser);
		if($numuser > 0){
			for ($i=0; $i < $_POST['coupon_amunt']; $i++) { 
				$strSelect = mysql_query("select * from auc_coupon");
				$count = mysql_num_rows($strSelect);
				if($con==0){
					$code_gn = generateRandomString();
				}else{
					$i=1;
					while ($i <= $count) {
						$randomstr = generateRandomString();
						$objQuery = mysql_query("select * from auc_coupon where cp_code ='".$randomstr."'");
						$countcondition = mysql_num_rows($objQuery);
						if($countcondition > 0){
							$i++;
						}else{
							$code_gn = generateRandomString();
							break;
						}
					}
				}
				$strcoupon = "insert into auc_coupon 
										(
											cp_code,
											cp_fkpackage,
											cp_buyers,
											cp_datecreated,
											cp_status
										) values (
											'$code_gn',
											'".$_POST['package']."',
											'$id_user',
											'".date("Y-m-d H:i:s")."',
											'notwork'
										)";
				mysql_query($strcoupon);
			}
			echo "<script>alert('ระบบทำการบันทึกข้อมูลได้สำเร็จ');</script>";
		}else{
			echo "<script>alert('ไม่พบรหัสผู้ชื่อซื้อ');</script>";
		}
		echo "<script language=\"javascript\">top.location='coupon_manage.php'</script>";
	}

?>