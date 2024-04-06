<?php include("global.php"); ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
if($_POST['submit']){
	
	$q="SELECT * FROM member WHERE username='".trim($_POST['username'])."' AND email='".trim($_POST['email'])."' AND active= '2' ";
	$db->query($q);	
		if($db->num_rows()>0){
			$db->next_record();	
			$INS_ID = $db->f(id);
			  include("func/mimemail.inc.php");
			  $htmlEmail=file_get_contents("http://www.praasia.com/get_reset_password.php?id=".$INS_ID);
			  $mail = new MIMEMAIL("HTML"); 
			  $mail->senderName ='praasia'; 
			  $mail->senderMail = 'praasia@gmail.com'; 
			  $mail->subject ="praasia Member - ตั้งค่ารหัสผ่านใหม่ www.praasia.com‏"; 
			  $mail->body = $htmlEmail;   
			  $mail->create();  
			  $mail->send(trim($_POST['email']));
			  al('กรุณาตรวจอีเมลล์ของคุณ เพื่อทำการตั้งค่ารหัสผ่านใหม่');
			  redi4('index.php');
		  }	 else {
	al('ไม่พบ Username ที่คุณต้องการเปลี่ยนรหัส กรุณาตรวจสอบ Username อีกครั้ง');
	redi2();
		  }
}
?></head>

<body>
</body>
</html>
