<?php
include('../global.php');
include('config/function.php');
include('config/mimemail.inc.php');

$subject = $_POST['subject'];
$messages = $_POST['message'];
$headers = "MIME-Version: 1.0\r\n";
$headers .= "Content-type: text/html; charset=utf-8\r\n";
$headers .= "From: Auction praasia ".$_POST['email_sender'].";  \r\n";

if(mail($_POST['email_recip'], $subject, $messages, $headers)){
	echo "<script language=\"javascript\">top.window.close()</script>";
}
?>