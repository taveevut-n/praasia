<?php
		include("../global.php");

    $postdata = file_get_contents("php://input");
    $request = json_decode($postdata);
    $message = $request->msg;
    $user_one = $request->user_one;
		$user_two = $request->user_two;
    $cp_id = $request->cp_id;

		$rs = mysql_fetch_array(mysql_query("select * from regid where member_id = '$user_two'"));
		$regit = $rs['regid'];

		$rs_m = mysql_fetch_array(mysql_query("select * from member where id = '$user_one'"));
		$name = $rs_m['name'];

		if (isset($regit) && isset($message)) {
			// echo $regID;
			include("pusher.php");

			$apiKey = "AIzaSyCQI81A2PX3r18-x3G4z_cG1z9jrGlNm1g";
			$pusher = new Pusher($apiKey);

			$regId = array($regit);
			$msg = array(
			    'message'   => $message,
			    'title'     => $name,
					'user_two'  => $user_one
			);
			$pusher->notify($regId, $msg);

			$sql_chat = "INSERT INTO conversation_reply (`cr_id`, `cp_id_fk`, `user_id_fk`, `reply`, `status`, `datetime`) VALUES
	    	(NULL, '$cp_id', '$user_one', '$message', 'disagree', NOW())";
	    $q_chat = mysql_query($sql_chat);
		}
?>
