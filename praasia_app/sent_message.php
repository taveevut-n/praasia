<?php
	$regID = $_POST['regId'];
	$message = $_POST['push'];
	$title = $_POST['title'];
	if (isset($regID) && isset($message)) {
		include("pusher.php");

		$apiKey = "AIzaSyC8ymscflkpVb4b5ePoyyBKTt4-IX4bcaY";
		$pusher = new Pusher($apiKey);

		$regId = array($regID);
		$msg = array(
		    'message'   => $message,
		    'title'     => $title
		);

		$result = $pusher->notify($regId, $msg);

		echo $result;
	}
?>