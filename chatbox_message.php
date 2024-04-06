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
