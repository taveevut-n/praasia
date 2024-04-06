<?php 
	include("global.php");
	// $id = 561;
	// echo $sql="update member set bankname1 = 'กสิกรไทย' , bankbranch1 ='พุทธมณฑลสาย4' ,bankacc1 = 'สุรเกียรติ  เลาหไพบูลย์' where id ='$id' ";
	// $query= new nDB();
	// $query->query($sql);

	// $query = mysql_query("select * from member order by id desc");
	// while ($rs = mysql_fetch_array($query )) {

	// 	$dnow = date("Y-m-d");
	// 	$mempay_id = 1000+$rs['id'];
	// 	$crnoregist = date("Y").substr($mempay_id,1);
	// 	echo $sql="insert into member_payment (mem_id,no_regist,bank,created,updated,payment_manage) values('".$rs['id']."','$crnoregist','1','$dnow','$dnow','2')";
	// 	mysql_query($sql);		
	// 	// $query= new nDB();
	// 	// $query->query($sql);
	// 	echo "<br/>";
	// }

	// $q = mysql_query("select * from member order by id asc");
	// while ($rs = mysql_fetch_array($q)) {
	// 	$id = $rs['id'];
	// 	$package_id = $rs['package_id'];
	// 	$qp = mysql_fetch_array(mysql_query("select * from member_package where package_id = '$package_id' "));
	// 	$package_amount = $qp['package_amount'];
	// 	mysql_query("update member set pack_amountformem = '$package_amount' where id = '$id' ");
	// 	echo "update member set pack_amountformem = '$package_amount' where id = '$id' ";
	// 	echo "<br/>";
	// }

	// $q = mysql_query("select * from member order by id asc");
	// while ($rs = mysql_fetch_array($q)) {
	// 	$id = $rs['id'];
	// 	$package_id = $rs['package_id'];
	// 	mysql_query("update member_payment set payment_packege = '$package_id' where mem_id = '$id' ");
	// 	echo "update member_payment set payment_packege = '$package_id' where mem_id = '$id' ";
	// 	echo "<br/>";
	// }
ob_start();
?>
