<?php include("global.php"); ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
if($_POST['Login'])
{
	$q="SELECT * FROM member WHERE username='".trim($_POST['username'])."' AND password='".trim( md5(base64_encode(md5(md5($_POST['password'])))))."'  ";
	$db->query($q);	
		if($db->num_rows()>0){
		$db->next_record();
		if ($db->f(shop_id=='0')) {
		$_SESSION['member_id'] = $db->f(id);
		} else {
		$_SESSION['adminshop_id']=$db->f(id);	
		$_SESSION['nameshop']=$db->f(name);				
		}
		redi4('http://www.praasia.com/index.php');	
		}else{
		al('รหัสผ่านไม่ถูกต้อง');
		redi4('http://www.praasia.com/index.php');
		exit;
		}
}
?>