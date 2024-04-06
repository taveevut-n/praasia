<?php include("global.php"); ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
	if($_GET['id'] and $_GET['active'] == 'MQ=='){
		$q = "SELECT * FROM `member` WHERE active ='2' ORDER BY shop_id DESC LIMIT 0,1 ";
		$rowid= new nDB();
		$rowid->query($q);
		$rowid->next_record();
		$shop_id = $rowid->f(shop_id);
		$q = "update `member` set shop_id = '".$shop_id."'+1 WHERE `id` = '".$_GET['id']."' ";
		$db->query($q);	
		$q="UPDATE `member` SET `active` = '2' WHERE `id` =".$_GET['id']." ";
		$db->query($q);

		$n = mysql_num_rows(mysql_query("select * from member where id < '".$_GET["id"]."' and active = '2'"));
		if($n <= 30){
			mysql_query("update member set package_id = '1' where id = '".$_GET["id"]."'");
		}else if($n <= 70){
			mysql_query("update member set package_id = '2' where id = '".$_GET["id"]."'");
		}else if($n <= 130){
			mysql_query("update member set package_id = '3' where id = '".$_GET["id"]."'");
		}else if($n <= 330){
			mysql_query("update member set package_id = '4' where id = '".$_GET["id"]."'");
		}
		$q = mysql_query("select * from member m left join member_package p on m.package_id = p.package_id where m.active = '2' and m.id = '".$_GET['id']."'");
		while($r = mysql_fetch_array($q)){
			$member_id = $r["id"];
			$package_duration = $r["package_duration"];
			mysql_query("update member set date_expire = '".(strtotime(date("Y-m-d")) + ($package_duration*86400) )."' where id = '$member_id'");
		}

		al('คุณได้ยืนยันตัวตนเรียบร้อยแล้ว ขอต้อนรับสู่ www.praasia.com, 您以确定了本人的 E-mail,欢迎您在praasia注册成功');
		redi4('index.php');
	}
?>
</head>

<body>
</body>
</html>
