<?php
	include("global.php");
	include("imagefunction.php");

	function time_passed($time){
	    $time = time() - $time;
	    if($time < 1){
	    	$time = 1;
	    }
	    $tokens = array (
	        31536000 => 'year',
	        2592000 => 'month',
	        604800 => 'week',
	        86400 => 'day',
	        3600 => 'hour',
	        60 => 'minute',
	        1 => 'second'
	    );
	    foreach ($tokens as $unit => $text) {
	        if ($time < $unit) continue;
	        $numberOfUnits = floor($time / $unit);
	        return $numberOfUnits.' '.$text.(($numberOfUnits>1)?'s':'');
	    }
	}

	function highlight($content, $search){
		if(is_array($search)){
			foreach ( $search as $word ){
				$content = str_ireplace($word, '<span class="highlight_word">'.$word.'</span>', $content);
			}
		} else {
			$content = str_ireplace($search, '<span class="highlight_word">'.$search.'</span>', $content);        
		}
		return $content;
	}

	$do_what = $_POST["do_what"];

	if($do_what == "chatbox_signin"){
		$chatbox_remember = trim($_POST["chatbox_remember"]);
		$username = trim($_POST["username"]);
		$password = trim($_POST["password"]);
		$q_member = mysql_query("select * from member where username = '$username' and password = '".trim( md5(base64_encode(md5(md5($password)))))."'");
		$n_member = mysql_num_rows($q_member);
		if($n_member > 0){

			$member = mysql_fetch_array($q_member);
			$_SESSION["member_id"] = $member["id"];
			$_SESSION["adminshop_id"] = $member["id"];
			$_SESSION["nameshop"] = $member["name"];

			$cookie_expire = time()+(10*365*24*60*60);
			if($chatbox_remember == "on"){
				setcookie("member_id", $_SESSION["member_id"], $cookie_expire, "/");
				setcookie("adminshop_id", $_SESSION["adminshop_id"], $cookie_expire, "/");
				setcookie("nameshop", $_SESSION["nameshop"], $cookie_expire, "/");
			}else{
				setcookie("member_id", "", "/");
				setcookie("adminshop_id", "", "/");
				setcookie("nameshop", "", "/");
			}

			redi4("http://www.praasia.com/chatweb.php");

		}else{
			echo "<script>alert('รหัสผ่านไม่ถูกต้อง / 密码不正确');</script>";
		}
	}

	if($do_what == "chatbox_message"){
		$message = trim($_POST["message"]);
		if($message != ""){
			mysql_query("insert into chatbox_message( message_id, message_text, message_date, member_id ) values( '', '$message', '".date("Y-m-d H:i:s")."', '".$_SESSION["member_id"]."' )");
		}
	}

	if($do_what == "chatbox_message_delete"){
		$message_id = trim($_POST["message_id"]);
		mysql_query("delete from chatbox_message where message_id = '$message_id'");
	}

	if($do_what == "chatbox_emoticon"){
		$emoticon = trim($_POST["emoticon"]);
		mysql_query("insert into chatbox_message( message_id, message_text, message_date, member_id ) values( '', '<img src=\"chatbox_emoticon/$emoticon\" height=\"40px\"/>', '".date("Y-m-d H:i:s")."', '".$_SESSION["member_id"]."' )");
	}

	if($do_what == "chatbox_file"){
		$filepart = $_FILES["chatbox_file"]["tmp_name"];
		$filename = $_FILES["chatbox_file"]["name"];
		if($filepart != ""){
			$fileextension = end(explode(".",$filename));
			$filename = time().".".$fileextension;
			copy($filepart,"chatbox_image/".$filename);
			mysql_query("insert into chatbox_message( message_id, message_text, message_date, member_id ) values( '', '<img class=\"chatbox_image\" onclick=\"chatbox_image(\'chatbox_image/resized_$filename\');\" src=\"".thumbnail("chatbox_image/",$filename,150,150)."\" height=\"150px\"/>', '".date("Y-m-d H:i:s")."', '".$_SESSION["member_id"]."' )");
			imageresize_max("chatbox_image/", $filename, 700);
		}
		echo "<script>window.parent.loading_hide();</script>";
		echo "<script>window.parent.chatbox_refresh();</script>";
	}

	if($do_what == "chatbox_refresh"){
		$n_message = mysql_num_rows(mysql_query("select * from chatbox_message"));
		$q_message = mysql_query("select * from chatbox_message ms left join member m on ms.member_id = m.id order by ms.message_date asc");
?>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
	<?php
		while($message = mysql_fetch_array($q_message)){
			if( $message["head2"] != "" ){
				$head2 = "img/head/".$message["head2"];
			}else{
				$head2 = "img/head/default_avatar.jpg";
			}
	?>
	<tr class="chatbox_message_tr" onmouseover="$(this).find('.chatbox_message_delete').show();" onmouseout="$(this).find('.chatbox_message_delete').hide();">
		<td style="padding-left:5px; padding-top:5px; width:1px; text-align:right; vertical-align:top; white-space:nowrap; color:#ff8f6c;">
			<?php
				if($message["type"] == "0"){
			?>
			<a href="shop_index.php?shop=<?=$message["id"]?>" target="_blank" style="color:#ff8f6c;">
				<img src="<?=$head2?>" height="30px" align="top"/>
				<?=$message["name"]?>
			</a>
			<?php
				}else{
			?>
			<a href="member_profile.php?member_id=<?=$message["id"]?>" target="_blank" style="color:#ff8f6c;">
				<img src="<?=$head2?>" height="30px" align="top"/>
				<?=$message["name"]?>
			</a>
			<?php
				}
			?>
		</td>
		<td style="padding-left:10px; padding-right:10px; padding-top:5px; width:1px; vertical-align:top;">
			:
		</td>
		<td style="padding-right:10px; padding-top:5px; padding-bottom:5px; vertical-align:top;">
			<?=$message["message_text"]?>
		</td>
		<td style="padding-right:10px; padding-top:5px; width:1px; vertical-align:top; text-align:right; font-size:11px; color:#666666; white-space:nowrap;">
			<?php
				if( ($_SESSION["member_id"] == $message["id"]) || ($_SESSION["member_id"] == "465") ){
			?>
			<span class="chatbox_message_delete" onclick="chatbox_message_delete(<?=$message["message_id"]?>);$(this).parent().parent().remove();" style="display:none; cursor:pointer;">
				ลบ
			</span>
			<?php
				}
			?>
		</td>
		<td style="padding-right:5px; padding-top:5px; width:1px; vertical-align:top; text-align:right; font-size:11px; color:#666666; white-space:nowrap;">
			<?=time_passed(strtotime($message["message_date"]))?>
		</td>
	</tr>
	<?php
		}
	?>
</table>
<?php
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
		<td class="translated_td" onclick="translated_select('<?=$thai["translated_text"]?>');">
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
		<td class="translated_td" onclick="translated_select('<?=$like_thai["translated_text"]?>');">
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
		<td class="translated_td" onclick="translated_select('<?=$china["translate_text"]?>');">
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
		<td class="translated_td" onclick="translated_select('<?=$like_china["translate_text"]?>');">
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
		<td class="translated_td" onclick="translated_select('<?=$thai["name_translated"]?>');">
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
		<td class="translated_td" onclick="translated_select('<?=$like_thai["name_translated"]?>');">
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
		<td class="translated_td" onclick="translated_select('<?=$china["name_text"]?>');">
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
		<td class="translated_td" onclick="translated_select('<?=$like_china["name_text"]?>');">
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

	if($do_what == "chatbox_translate_leave"){
		$v = $_POST["v"];
		$n = mysql_num_rows(mysql_query("select * from pra_translate where translate_text = '$v' or translated_text = '$v'"));
		if($n > 0){
			echo "ข้อความนี้ได้ถูกฝากแปลแล้ว กรุณารอคำแปลภายใน 24 ชั่วโมงถึงจะใช้ได้ / 本词句已被翻译 等待管理员24小时内会给你翻译";
		}else{
			mysql_query("insert into pra_translate( translate_id, translate_text, translated_text, leave_date ) values( '', '$v', '', '".date("Y-m-d H:i:s")."' )");
			echo "ฝากแปลช้อความเรียบร้อยแล้ว / 信息已被发送";
		}
	}

?>
