<?php

$q="SELECT * FROM `online` WHERE ip_remote='".$_SERVER['HTTP_COOKIE']."' ";
$db->query($q);
$qq=$db->num_rows($q);
//echo $qq;
if($qq==0){
	$n_time=time()+60;
	$q="INSERT INTO `online` ( `id_online` , `ip_remote`, `time_set` ) 
VALUES (
'', '".$_SERVER['HTTP_COOKIE']."', '".$n_time."'
); ";
	$db->query($q);

}


$q="SELECT * FROM `online` WHERE 1";
$qr1=$db->query($q);
$num_user=$db->num_rows($q);
echo $num_user;

$q="DELETE FROM `online` WHERE `time_set` < '".time()."' ";
$db->query($q);

?>
