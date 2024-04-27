<?php include("../global.php"); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
<?php
if(isset($_POST['pro_catalog']) || $_POST['pro_catalog']!=0 || $_POST['pro_catalog']!=""){
	$_SESSION['pro_catalog']=$_POST['pro_catalog'];
	redi4('jewelry_product.php');
}else{
	unset($_SESSION['pro_catalog']);
	redi4('jewelry_product.php');	
}
?>
</head>

<body>
</body>
</html>
