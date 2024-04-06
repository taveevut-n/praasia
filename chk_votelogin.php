<?php include("global.php"); ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
if($_POST['Login'])
{
	$q="SELECT * FROM member WHERE username='".trim($_POST['username'])."' AND password='".trim( md5(base64_encode(md5(md5($_POST['password'])))))."' AND active= '2' ";
	$db->query($q);	
		if($db->num_rows()>0){
		$db->next_record();
		$_SESSION['adminshop_id']=$db->f(id);	
		$_SESSION['nameshop']=$db->f(name);	
		redi4('http://www.praasia.com/shop_product.php?product_id='.$_SESSION['product_id']);	
		}else{
		al('รหัสผ่านไม่ถูกต้อง / 密码不正确');
		redi4('http://www.praasia.com/index.php');
		exit;
		}
}
?>