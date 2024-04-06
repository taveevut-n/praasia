<?php
	// include('global.php');
	$qage = mysql_query("select * from member");
	while ($qrs = mysql_fetch_array($qage)) {
		$date_expire = $qrs['date_expire'];
		$age_left = strtotime(date("Y-m-d",$date_expire)) - strtotime(date("Y-m-d"));

		if( ($age_left > 0 ) && ($age_left <= 2592000) ){ //30 day
			$_SESSION['age_left'] = '50 day';
		}else if( $age_left <= 0 ){
			unset($_SESSION["age_left"]);
			$memid = $qrs['id'];

			$mempay_id = 1000+$memid;
			$crnoregist = date("Y").substr($mempay_id,1);

			$rspacket = mysql_fetch_array(mysql_query("select * from member_package where package_code = '".$qrs['package_id']."'"));
		    $package_id = $rspacket['package_id'];

			// echo "insert into member_payment (mem_id,no_regist,payment_packege,created,updated,payment_manage) values ('".$memid."','".$crnoregist."','$package_id','".date("Y-m-d")."','".date("Y-m-d")."','0'";
			mysql_query("insert into member_payment (mem_id,no_regist,payment_packege,created,updated,payment_manage) values ('".$memid."','".$crnoregist."','$package_id','".date("Y-m-d")."','".date("Y-m-d")."','0')");
		}
	}
?>
