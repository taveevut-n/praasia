<?php include("global.php"); ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
	if($_POST['Login']){	
		
		$q = "SELECT * FROM member WHERE username='".trim($_POST['username'])."' AND password='".trim( md5(base64_encode(md5(md5($_POST['password'])))))."'";
		$db->query($q);
		$db->next_record();
		
		
		if($db->num_rows()>0){
			
									if ($db->f(active)==2) {
									
										$nowdate = strtotime(date("Y-m_d"));
										$shopdate = strtotime($db->f(shop_date));
										$expiredate = strtotime($db->f(member_expire));
										if ($nowdate > $expiredate) {
											al('สมาชิกของคุณหมดอายุแล้ว กรุณาติดต่อเจ้าหน้าที่ / 您的会员资格已过期请与我们联系');
											redi4('notice_payment.php');
										}
										
										$_SESSION['member_id']=$db->f(id);
										$_SESSION['adminshop_id']=$db->f(id);
										$_SESSION['shopname']=$db->f(shopname);
										
										$cookie_expire = time()+(10*365*24*60*60);
										if($_POST["remember"] == "on"){
											setcookie("member_id", $_SESSION["member_id"], $cookie_expire, "/");
											setcookie("adminshop_id", $_SESSION["adminshop_id"], $cookie_expire, "/");
											setcookie("nameshop", $_SESSION["nameshop"], $cookie_expire, "/");
										}else{
											setcookie("member_id", "", "/");
											setcookie("adminshop_id", "", "/");
											setcookie("nameshop", "", "/");
										}
										
										if($_POST['click_login'] == "login_index"){
											if($db->f(type) == "0"){
												// redi4('http://www.praasia.com'.$_POST['current_url']);
												redi4('http://www.praasia.com/backend.php');
											}else{
												redi4('http://www.praasia.com/member_profile.php?member_id='.$_SESSION['member_id'].'');
											}
										}
										
										if ($db->f(type)== "0") {
											redi4('/backend.php');
										}else{
											redi4('http://www.praasia.com/member_profile.php?member_id='.$_SESSION['member_id'].'');
										}
										
									}else{
										al('สมาชิกนี้ยังไม่ได้รับอนุมัติ กรุณาติดต่อเจ้าหน้าที่ / 成员还没被批准 请联系我门团队');
										redi2();
									}
										
		}else{
			al('รหัสผ่านไม่ถูกต้อง / 密码不正确');
			redi4('http://www.praasia.com'.$_POST['current_url']);
		}
	}else{
		redi4('http://www.praasia.com'.$_POST['current_url']);
	}
?>