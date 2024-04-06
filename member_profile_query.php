<?
	include("global.php");
?>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?
	$do_what = $_POST["do_what"];
	if($do_what == "message_add"){
		$member_id = $_POST['member_id'];
		$member = $_POST["member"];
		$message = $_POST["message"];
		if($member == ""){
			echo "<script>alert('กรุณาเลือกผู้รับ');</script>";
		}else if($message == ""){
			echo "<script>alert('กรุณาใส่ข้อความ');</script>";
		}else{
			include("func/mimemail.inc.php");
			foreach($member as $k => $v){
				mysql_query("insert into twe_message( message, create_date, sender_id, receiver_id ) values( '$message', '".date("Y-m-d H:i:s")."', '".$_SESSION['adminshop_id']."', '$v' )");
				$sander_member = mysql_fetch_array(mysql_query("select * from member where id = '".$_SESSION['adminshop_id']."'"));
				$recive_member = mysql_fetch_array(mysql_query("select * from member where id = '$v'"));
				$email_sander_name = $_SERVER["SERVER_NAME"];
				$email_sander_email = $sander_member["email"];
				$email_sander_bcc = "";
				$email_subject = "Message from ". $sander_member["name"];
				$email_attachment = "";
				$email_html = "
					$message
					<br/>
					เมื่อ ".date("Y-m-d H:i:s")."
					<p>กรุณาตรวจสอบให้แน่ชัดก่อนว่า ผู้ส่งจากประเทศไหน ใช้ภาษาอะไร(ไทย-จีน)ในการสื่อสารบ้าง ก่อนที่จะทำการส่ง mail กลับ / 请查清收件人来自哪个国家，应该用什么语言(中-泰文)来回复收件人</p>
					<p>กรุณาคลิกลิงค์ด้านล่างนี้เพื่ตอบกลับ / 请点击下面的连结(Link)回复收件人</p>
					<p><a href=\"http://praasia.com/backend_pm_replymail.php?sender=".md5($_SESSION['adminshop_id'])."&recipient=".md5($recive_member["id"])."\">http://praasia.com/backend_pm_replymail.php?sender=".md5($_SESSION['adminshop_id'])."&recipient=".md5($recive_member["id"])."</p>
				";
				$email_addressee = $recive_member["email"];
				$email = new MIMEMAIL("HTML");
				$email->senderName = $email_sander_name;
				$email->senderMail = $email_sander_email;
				$email->bcc = $email_sander_bcc;
				$email->subject = $email_subject;
				$email->attachment[] = $email_attachment;
				$email->body = $email_html;
				$email->create();
				$email->send($email_addressee);
			}
			echo "<script language=\"javascript\">top.location='member_profile.php?member_id=$member_id&send=1'</script>";
		}
	}
?>
