<?php include("../global.php"); ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
if($_POST['Login'])
{
	$q="SELECT * FROM auc_member WHERE m_username='".trim($_POST['username'])."' AND m_password='".trim($_POST['password'])."' ";
	$db->query($q);	
		if($db->num_rows()>0){
		$db->next_record();
		$_SESSION['adminshop_id']=$db->f(m_id);	
		$_SESSION['nameshop']=$db->f(m_name);	
		redi4('http://www.praasia.com/auction2/view.php?id='.$_SESSION['product_id']);	
		}else{
		al('รหัสผ่านไม่ถูกต้อง / 密码不正确');
		redi4('http://www.praasia.com/auction2/index.php');
		exit;
		}
}
?>