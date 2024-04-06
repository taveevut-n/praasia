<?php 
	include_once("global.php"); 

	$jsonreturn = array(
		'result' => true
	);

	$objSQl = mysql_query("SELECT * FROM member WHERE id = '".$_POST['adminshop_id']."'");
	$result = mysql_fetch_array($objSQl);
	// if($result['address']==''){
	// 	$jsonreturn['result'] = false;
	// 	}elseif ($result['postcode']=='') {
	// 		$jsonreturn['result'] = false;
	// 	}elseif ($result['bankname1']=='') {
	// 		$jsonreturn['result'] = false;
	// 	}elseif ($result['bankbranch1']=='') {
	// 		$jsonreturn['result'] = false;
	// 	}elseif ($result['bankacc1']=='') {
	// 		$jsonreturn['result'] = false;
	// 	}elseif ($result['file1']=='') {
	// 		$jsonreturn['result'] = false;
	// 	}elseif ($result['file2']=='') {
	// 		$jsonreturn['result'] = false;
	// 	}elseif ($result['head1']=='defualt.jpg') {
	// 		$jsonreturn['result'] = false;
	// 	}elseif ($result['head2']=='defualt.jpg') {
	// 		$jsonreturn['result'] = false;
	// 	}
	if($result['head1']==''){
		$jsonreturn['result'] = false;
 	}elseif ($result['head2']=='') {
 		$jsonreturn['result'] = false;
 	}

	echo json_encode($jsonreturn);
?>
