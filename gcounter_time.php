<?php
	$q="select * from chk_counter where chk_ip='".getenv('REMOTE_ADDR')."' order by chk_date desc";
	$db->query($q);
	$db->next_record();
	if($db->num_rows()==0){
		$q="INSERT INTO `chk_counter` ( `chk_id` , `chk_ip` , `chk_date` ) 
VALUES (
'', '".getenv('REMOTE_ADDR')."', '".time()."'
);";
		//echo $q;
		$db->query($q);
		$q="UPDATE `counter` SET `counter` =`counter`+1 WHERE `id` =1";
		$db->query($q);
	}else{
	//	echo time()-$rs['chk_date'];
		if(time()-$db->f(chk_date)>=86400){
			$q="delete from chk_counter where chk_date < '".$db->f(chk_date)."' ";
			$db->query($q);
			$q="INSERT INTO `chk_counter` ( `chk_id` , `chk_ip` , `chk_date` ) 
	VALUES (
	'', '".getenv('REMOTE_ADDR')."', '".time()."'
	);";
			$db->query($q);
			$q="UPDATE `counter` SET `counter` =`counter`+1 WHERE `id` =1";
			$db->query($q);
		}
	}

?>
<?php
	$q="SELECT * FROM `counter` WHERE 1";
	$db->query($q);
	$db->next_record();
echo 	$counter=$db->f(counter);
	$c_len=7;
	$count=str_pad($counter, $c_len, "0", STR_PAD_LEFT);  
//	echo $count;
	for ($i=0;$i<strlen($count);$i++) {
		$digit=substr("$count",$i,1);
		$src =  $digit . ".gif" ;
/*		echo "<img src=counter/images/".$src." align=absmiddle>";*/
	}
?>
