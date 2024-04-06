<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?
if (strstr($_SERVER['HTTP_USER_AGENT'], 'Yandex')){ $bot='Yandex';}
else if (strstr($_SERVER['HTTP_USER_AGENT'], 'Googlebot')){$bot='Google';}
else if (strstr($_SERVER['HTTP_USER_AGENT'], 'Mediapartners-Google')){$bot='Mediapartners-Google (Adsense)';}
else if (strstr($_SERVER['HTTP_USER_AGENT'], 'Slurp')){$bot='Hot Bot search';}
else if (strstr($_SERVER['HTTP_USER_AGENT'], 'WebCrawler')){$bot='WebCrawler search';}
else if (strstr($_SERVER['HTTP_USER_AGENT'], 'ZyBorg')){$bot='Wisenut search';}
else if (strstr($_SERVER['HTTP_USER_AGENT'], 'scooter')){$bot='AltaVista';}  
else if (strstr($_SERVER['HTTP_USER_AGENT'], 'StackRambler')){$bot='Rambler';}  
else if (strstr($_SERVER['HTTP_USER_AGENT'], 'Aport')){$bot='Aport';}  
else if (strstr($_SERVER['HTTP_USER_AGENT'], 'lycos')){$bot='Lycos';}  
else if (strstr($_SERVER['HTTP_USER_AGENT'], 'WebAlta')){$bot='WebAlta';}
else if (strstr($_SERVER['HTTP_USER_AGENT'], 'yahoo')){$bot='Yahoo';}
else if (strstr($_SERVER['HTTP_USER_AGENT'], 'msnbot')){$bot='msnbot/1.0';}
else if (strstr($_SERVER['HTTP_USER_AGENT'], 'ia_archiver')){$bot='Alexa search engine';}
else if (strstr($_SERVER['HTTP_USER_AGENT'], 'FAST')){$bot='AllTheWeb';}
 
if($bot !=""){
	$tdiff = 3600 * 7; // à»ÅÕèÂ¹¨Ò¡ 0 à»ç¹ 7 ¶éÒ Server ¹Í¡ (GMT) ËÃ×Íà¾ÔèÁÅ´ä´éµÒÁáµè Time Zone ÍÂÙè·Õèä´ (GMT -12 ¶Ö§ GMT +13)
	$file = "bots.txt";
	$day = date("d/m/Y",time() + $tdiff);
	$time = date("H:i:s",time() + $tdiff);
	$ip = $_SERVER['REMOTE_ADDR'];
	$fh = fopen($file, "w");
	fwrite($fh, "$day|$time|$bot|$ip");
	fclose($fh);
}

$month[1] = "มกราคม";
$month[2] = "กุมภาพันธ์";
$month[3] = "มีนาคม";
$month[4] = "เมษายน";
$month[5] = "พฤษภาคม";
$month[6] = "มิถุนายน";
$month[7] = "กรกฎาคม";
$month[8] = "สิงหาคม";
$month[9] = "กันยายน";
$month[10] = "ตุลาคม";
$month[11] = "พฤศจิกายน";
$month[12] = "ธันวาคม";

$file = "bots.txt";
if(file_exists($file)) {
	$fh = fopen($file, 'r+');
	$s = filesize($file);
	if($s == 0) {
		$out = "<strong>ไม่พบการเข้าชมของบอท</strong>";
	}else{
		$contents = fread($fh, $s);
		fclose($fh);
		
		$info = explode("|",$contents);
		$day = explode("/",$info[0]);
		$m = number_format($day[1]);
		$tm = explode(":",$info[1]);
		$agent = $info[2];
		$ip = $info[3];

		$out = "<strong>ชื่อบอท ".$agent ." ($ip) </br>";
		
		if(date('d',time()) == $day[0]){
			$out .= " วันนี้";
		}else{
			$out .=" วัน ".$day[0]." ".$month[$m]." ". ($day[2]+543);
		}
		$out .= " เวลา ". $tm[0]. ".".$tm[1]." น.</strong>";
		
	}
	echo $out;
}
?>
