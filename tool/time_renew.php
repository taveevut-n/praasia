<? 
	include('../global.php');
	$x_value = $_POST['x_value'];
	$x_id = $_POST['x_id'];
	$x_packcode = $_POST['packcode'];
	$date_expire = $_POST['date_expire'];

	$jsonreturn  = array(
		'result' => false 
	);

	$gettime = mysql_fetch_array(mysql_query("select * from member_package where package_code = '$x_packcode'"));
	$newdate = $date_expire+(86400*$gettime['package_duration']);

	$query = mysql_query("update member set date_expire = '$newdate' , package_id = '".$gettime['package_id']."' where id = '$x_id' ");
	if($query){
		$rspayid = mysql_fetch_array(mysql_query("select * from member where id = '$x_id' "));
		$getpay_id = mysql_fetch_array(mysql_query("select * from member_pay where shop_id = '".$rspayid['shop_id']."' order by payment_id desc"));

		mysql_query("update member_pay set pay_manage = '1' where payment_id = '".$getpay_id['payment_id']."'");
		$jsonreturn['result']=true;
	}

	echo json_encode($jsonreturn);
?>