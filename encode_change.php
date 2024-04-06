<?php
	include("encode_global.php");
	set_page($s_page,$e_page = 20);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>
		ระบบจัดการเว็บไซต์  : จัดการสินค้า
	</title>
	<link rel="shortcut icon" href="favicon.ico" />
	<link rel="favicon" href="favicon.ico" />
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<body>
	<?php
		$do_what = $_POST["do_what"];
		if($do_what == "praasia_encode"){
			foreach($_POST["id_product"] as $k => $v){
				$q = "
					update pra_product2 set 
						name_product = '".$_POST["name_product"][$k]."',
						s_detail = '".$_POST["s_detail"][$k]."',
						detail_product = '".$_POST["detail_product"][$k]."'
					where id_product = '$v'
				";
				mysql_query($q);
			}
		}
	?>
	<form method="post">
	<input name="do_what" value="praasia_encode" type="hidden"/>
	<input value="submit" type="submit"/>
	<br/>
	<?php
		$db->query("SELECT * FROM pra_product2 WHERE 1 ORDER BY id_product ");
		echo $db->num_rows();
		while($db->next_record()){
	?>
	<input name="id_product[]" value="<?=$db->f(id_product)?>" type="text"/>
    <textarea name="name_product[]"><?=$db->f(name_product)?></textarea>
    <textarea name="s_detail[]"><?=$db->f(s_detail)?></textarea>
    <textarea name="detail_product[]"><?=$db->f(detail_product)?></textarea>
	<br/>
	<?php
		}
	?>
	</form>
</body>
</html>
