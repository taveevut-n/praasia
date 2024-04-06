<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
	include('global.php');
	$orderid = $_POST['orderid'];
	$q="SELECT * FROM member_payment WHERE no_regist ='$orderid'";
	$db->query($q);
	$db->next_record();
	if($db->num_rows() > 0){
		if($db->f(payment_manage) == 1){
			echo "<script language=\"javascript\">alert('ระบบได้รับแจ้งข้อมูลแล้วครับ รออีกไม่นาน ทีมงานจะรีบดำเนินการอนุมัติให้แล้วเสร็จครับ 该系统已被通知，等待团队审批 。');window.location='notice_payment.php';</script>";	
			exit;
		}else if($db->f(payment_manage) == 2){
			echo "<script language=\"javascript\">alert('เจ้าหน้าที่ทำการอนุมัติแล้วครับ');window.location='notice_payment.php';</script>";	
			exit;
		}else{
			$query = mysql_query("update member_payment set payment_manage = '1' , bank = '".$_POST['bank']."' where no_regist = '$orderid' ");
			if($query){
				if($db->query($q)){
					$filepart = $_FILES["file1"]["tmp_name"];
					$filename = $_FILES["file1"]["name"];
					if(trim($_FILES["file1"]["tmp_name"]) != ""){
						$fileextension = end(explode(".",$filename));
						$filename1 = time()."1.".$fileextension;
						copy($filepart,"payment_file/".$filename1);
					}else{
						$filename1 = '';
					}

					$q="UPDATE member_payment SET pic = '$filename1' WHERE no_regist ='$orderid'";
					$db->query($q);
					$INS_ID=mysql_insert_id();

					include("func/mimemail.inc.php");
					$htmlEmail=file_get_contents("http://www.praasia.com/get_payment.php?id=".$INS_ID);
					$mail = new MIMEMAIL("HTML"); 
					$mail->senderName ='praasia'; 
					$mail->senderMail = 'praasia@gmail.com'; 
					$mail->subject ="แจ้งการชำระเงินจากเว็บไซต์ www.praasia.com‏"; 
					$mail->body = $htmlEmail;   
					$mail->attachment[0] = "payment_file/".$filename1;
					$mail->create();  
					$mail->send('info@praasia.com');
					al('ระบบได้รับแจ้งข้อมูลแล้วครับ รออีกไม่นาน ทีมงานจะรีบดำเนินการอนุมัติให้แล้วเสร็จครับ 该系统已被通知，等待团队审批 。');
					redi4('backend.php');

				}
			}  
		}
	}else {
		echo "<script language=\"javascript\">alert('ไม่พบเลขที่ใบชำระ');window.location='notice_payment.php';</script>";	
		exit;
	}
?>
