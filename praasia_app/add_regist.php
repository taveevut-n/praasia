<?php
	include("../global.php");

	$postdata = file_get_contents("php://input");
    $request = json_decode($postdata);
    $m_id = $request->m_id;
    $uid = $request->uid;
    $regid = $request->regid;
    $datetime = $request->datetime;

	if(isset($m_id) && $m_id != "" && isset($regid) && $regid != ""){
		$id_reg = @mysql_result(@mysql_query("SELECT id FROM regid WHERE member_id = '$m_id'"),0,0);
		if($id_reg>0){
			@mysql_query("UPDATE regid SET regid='$regid', datetime='$datetime' WHERE member_id = '$m_id' ");
			echo 2;
		}else{
			@mysql_query("INSERT INTO regid(id,member_id,regid,uid,datetime)VALUES(NULL,'$m_id','$regid','$uid','$datetime')");
			echo 1;
		}
	}else{
		echo 0;	
	}
?>