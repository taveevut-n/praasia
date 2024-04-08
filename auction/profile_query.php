<?
	include('../global.php');
	
	$member_id = $_SESSION['aucuser_id'];

	$do_what = $_POST['do_what'];

	if($do_what == "delauction"){
		$query = mysql_query("delete from auc_regist where reg_id='".$_POST['v']."'");
		if($query){
			$query = mysql_query("delete from auc_reply where rep_aucid='".$_POST['v']."'");
			if($query){	
				echo 1;
			}
		}
	}

	if($do_what == "repost"){
		$jsonreturn = array('result' => false ,'data' => null);

		if($_POST['data']=='1.5'){
		  $dateval = date("Y-m-d H:i:s",time()+(60*(60+30)*24*1));
		}else{
		  $dateval = date("Y-m-d H:i:s",time()+(60*60*24*$_POST['data'])); // Plus Date 5 day
		}

		$query = mysql_query("UPDATE `auc_regist` SET `reg_dateexpire` = '".$dateval."' WHERE `reg_id` ='".$_POST['id']."';");
		if($query){
			mysql_query("DELETE FROM auc_reply WHERE rep_aucid='".$_POST['id']."'");

			$jsonreturn['result']=true;
			$jsonreturn['data']=$dateval;
		}

		echo json_encode($jsonreturn);
	}
?>