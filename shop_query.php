<?php
	include("global.php");
	// include("imagefunction.php");

	$do_what = $_POST["do_what"];

	if($do_what == "message_add"){
		$text_proid = $_POST['pro_id'];
		$member = $_POST["member"];
		$message = $_POST["message"];

		if($text_proid != ""){
			$text_proid = '&pro_id='.$text_proid;
		}else{
			$text_proid = '';
		}
		mysql_query("insert into twe_message( message, create_date, sender_id, receiver_id ) values( '$message', '".date("Y-m-d H:i:s")."', '".$_SESSION['adminshop_id']."', '$member' )");
		include("func/mimemail.inc.php");
		$sander_member = mysql_fetch_array(mysql_query("select * from member where id = '".$_SESSION['adminshop_id']."'"));
		$recive_member = mysql_fetch_array(mysql_query("select * from member where id = '$member'"));
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
			<p><a href=\"http://praasia.com/backend_pm_replymail.php?sender=".md5($_SESSION['adminshop_id'])."&recipient=".md5($recive_member["id"]).$text_proid."\">http://praasia.com/backend_pm_replymail.php?sender=".md5($_SESSION['adminshop_id'])."&recipient=".md5($recive_member["id"]).$text_proid."</p>
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

	if($do_what == "shoppm_signin"){
		$username = $_POST["username"];
		$password = $_POST["password"];
		$member = $_POST["member"];
		$q = mysql_query("select * from member where username = '$username' and password = '".trim(md5(base64_encode(md5(md5($_POST["password"])))))."' and active = '2'");
		$n = mysql_num_rows($q);
		if($n > 0){
			$r = mysql_fetch_array($q);
			$_SESSION["member_id"] = $r["id"];
			$_SESSION["adminshop_id"] = $r["id"];
			$_SESSION["nameshop"] = $r["name"];
			echo "1";
		}else{
			echo "0";
		}
	}

	if($do_what == "shoppm_translate_leave"){
		$v = $_POST["v"];
		$n = mysql_num_rows(mysql_query("select * from pra_translate where translate_text = '$v' or translated_text = '$v'"));
		if($n > 0){
			echo "ข้อความนี้ได้ถูกฝากแปลแล้ว กรุณารอคำแปลภายใน 24 ชั่วโมงถึงจะใช้ได้ / 本词句已被翻译 等待管理员24小时内会给你翻译";
		}else{
			mysql_query("insert into pra_translate( translate_id, translate_text, translated_text, leave_date ) values( '', '$v', '', '".date("Y-m-d H:i:s")."' )");
			echo "ฝากแปลช้อความเรียบร้อยแล้ว / 信息已被发送";
		}
	}

	if($do_what == "translate"){
		$v = $_POST["v"];
		if($v != ""){
			$qlike_thai = mysql_query("select * from pra_translate where translate_text like '%$v%' group by translated_text limit 5");
			$nlike_thai = mysql_num_rows($qlike_thai);
			if($nlike_thai > 0){
				$q_thai = mysql_query("select * from pra_translate where translate_text = '$v'");
				$n_thai = mysql_num_rows($q_thai);
				if($n_thai > 0){
?>
<table border="0" cellpadding="0" cellspacing="0">
	<?php
		while($thai = mysql_fetch_array($q_thai)){
	?>
	<tr>
		<td class="translated_td" onclick="shoppm_translated_select('<?=$thai["translated_text"]?>');">
			<?=$thai["translated_text"]?>
		</td>
	</tr>
	<?php
		}
	?>
</table>
<?php
				}else{
?>
<table border="0" cellpadding="0" cellspacing="0">
	<?php
		while($like_thai = mysql_fetch_array($qlike_thai)){
	?>
	<tr>
		<td class="translated_td" onclick="shoppm_translated_select('<?=$like_thai["translated_text"]?>');">
			<?=$like_thai["translated_text"]?>
		</td>
	</tr>
	<?php
		}
	?>
</table>
<?php
				}
			}else{
				$qlike_china = mysql_query("select * from pra_translate where translated_text like '%$v%' group by translate_text limit 5");
				$nlike_china = mysql_num_rows($qlike_china);
				if($nlike_china > 0){
					$q_china = mysql_query("select * from pra_translate where translated_text = '$v'");
					$n_china = mysql_num_rows($q_china);
					if($n_china > 0){
?>
<table border="0" cellpadding="0" cellspacing="0">
	<?php
		while($china = mysql_fetch_array($q_china)){
	?>
	<tr>
		<td class="translated_td" onclick="shoppm_translated_select('<?=$china["translate_text"]?>');">
			<?=$china["translate_text"]?>
		</td>
	</tr>
	<?php
		}
	?>
</table>
<?php
					}else{
?>
<table border="0" cellpadding="0" cellspacing="0">
	<?php
		while($like_china = mysql_fetch_array($qlike_china)){
	?>
	<tr>
		<td class="translated_td" onclick="shoppm_translated_select('<?=$like_china["translate_text"]?>');">
			<?=$like_china["translate_text"]?>
		</td>
	</tr>
	<?php
		}
	?>
</table>
<?php
					}
				}
			}
		}

		if($v != ""){
			$qlike_thai = mysql_query("select * from pra_translate_name where name_text like '%$v%' group by name_translated limit 5");
			$nlike_thai = mysql_num_rows($qlike_thai);
			if($nlike_thai > 0){
				$q_thai = mysql_query("select * from pra_translate_name where name_text = '$v'");
				$n_thai = mysql_num_rows($q_thai);
				if($n_thai > 0){
?>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
	<?php
		while($thai = mysql_fetch_array($q_thai)){
	?>
	<tr>
		<td class="translated_td" onclick="shoppm_translated_select('<?=$thai["name_translated"]?>');">
			<?=$thai["name_translated"]?>
		</td>
	</tr>
	<?php
		}
	?>
</table>
<?php
				}else{
?>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
	<?php
		while($like_thai = mysql_fetch_array($qlike_thai)){
	?>
	<tr>
		<td class="translated_td" onclick="shoppm_translated_select('<?=$like_thai["name_translated"]?>');">
			<?=$like_thai["name_translated"]?>
		</td>
	</tr>
	<?php
		}
	?>
</table>
<?php
				}
			}else{
				$qlike_china = mysql_query("select * from pra_translate_name where name_translated like '%$v%' group by name_text limit 5");
				$nlike_china = mysql_num_rows($qlike_china);
				if($nlike_china > 0){
					$q_china = mysql_query("select * from pra_translate_name where name_translated = '$v'");
					$n_china = mysql_num_rows($q_china);
					if($n_china > 0){
?>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
	<?php
		while($china = mysql_fetch_array($q_china)){
	?>
	<tr>
		<td class="translated_td" onclick="shoppm_translated_select('<?=$china["name_text"]?>');">
			<?=$china["name_text"]?>
		</td>
	</tr>
	<?php
		}
	?>
</table>
<?php
					}else{
?>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
	<?php
		while($like_china = mysql_fetch_array($qlike_china)){
	?>
	<tr>
		<td class="translated_td" onclick="shoppm_translated_select('<?=$like_china["name_text"]?>');">
			<?=$like_china["name_text"]?>
		</td>
	</tr>
	<?php
		}
	?>
</table>
<?php
					}
				}
			}
		}
	}

?>
