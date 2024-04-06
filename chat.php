<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td height="30" align="center" bgcolor="#996600" style="color:#ffcc00;">
			ระบบแชท / ฝากแปลภาษาไทย / จีน (กำลังทดสอบระบบ)中泰文论坛/存录进行翻译系统(正在测试系统)
		</td>
	</tr>
	<tr>
		<td style="height:300px; background-color:#f5f5f5; border:1px solid #6b4700;">
			<iframe class="chatbox_iframe" src="chatbox.php" style="width:100%; height:300px; overflow-y:scroll" allowtransparency="true" frameborder="0" scrolling="yes"></iframe>
		</td>
	</tr>
	<tr>
		<td style="padding-top:3px;">
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
				<?php
					if($_SESSION["adminshop_id"] or $_SESSION['member_id']){
				?>
				<tr>
					<td bgcolor="#220b00">
						<table width="100%" border="0" cellpadding="0" cellspacing="0">
							<tr>
								<td style="padding-right:5px; width:1px; vertical-align:top;">
									<div onmouseover="$(this).css('overflow','');" onmouseout="$(this).css('overflow','hidden');" style="position:relative; overflow:hidden; width:50px; height:46px;">
										<div style="position:absolute; left:0px; bottom:0px; background-color:#f5f5f5; -webkit-box-shadow: rgba(0,0,0,0.5) 0px 0px 7px; -moz-box-shadow: rgba(0,0,0,0.5) 0px 0px 7px; box-shadow: rgba(0,0,0,0.5) 0px 0px 7px;">
											<table border="0" cellpadding="0" cellspacing="0">
												<tr>
													<td style="padding:5px; width:1px; text-align:center;">
														<form action="postchat.php" target="frm_chatbox" method="post">
														<input name="chattext" value='<img src=\"img/emoticon/1.png\" width=\"40px\" border=\"0\"/>' type="hidden"/>
														<input name="send" value="send" type="hidden"/>
														</form>
														<img onclick="$(this).prev().submit();$('.chatbox_iframe').attr('src', $('.chatbox_iframe').attr('src'));" src="img/emoticon/1.png" style="cursor:pointer;" width="40px" border="0"/>
													</td>
													<td style="padding:5px; width:1px; text-align:center;">
														<form action="postchat.php" target="frm_chatbox" method="post">
														<input name="chattext" value='<img src=\"img/emoticon/2.png\" width=\"40px\" border=\"0\"/>' type="hidden"/>
														<input name="send" value="send" type="hidden"/>
														</form>
														<img onclick="$(this).prev().submit();$('.chatbox_iframe').attr('src', $('.chatbox_iframe').attr('src'));" src="img/emoticon/2.png" style="cursor:pointer;" width="40px" border="0"/>
													</td>
													<td style="padding:5px; width:1px; text-align:center;">
														<form action="postchat.php" target="frm_chatbox" method="post">
														<input name="chattext" value='<img src=\"img/emoticon/3.png\" width=\"40px\" border=\"0\"/>' type="hidden"/>
														<input name="send" value="send" type="hidden"/>
														</form>
														<img onclick="$(this).prev().submit();$('.chatbox_iframe').attr('src', $('.chatbox_iframe').attr('src'));" src="img/emoticon/3.png" style="cursor:pointer;" width="40px" border="0"/>
													</td>
												</tr>
												<tr>
													<td style="padding:5px; width:1px; text-align:center;">
														<form action="postchat.php" target="frm_chatbox" method="post">
														<input name="chattext" value='<img src=\"img/emoticon/4.png\" width=\"40px\" border=\"0\"/>' type="hidden"/>
														<input name="send" value="send" type="hidden"/>
														</form>
														<img onclick="$(this).prev().submit();$('.chatbox_iframe').attr('src', $('.chatbox_iframe').attr('src'));" src="img/emoticon/4.png" style="cursor:pointer;" width="40px" border="0"/>
													</td>
													<td style="padding:5px; width:1px; text-align:center;">
														<form action="postchat.php" target="frm_chatbox" method="post">
														<input name="chattext" value='<img src=\"img/emoticon/5.png\" width=\"40px\" border=\"0\"/>' type="hidden"/>
														<input name="send" value="send" type="hidden"/>
														</form>
														<img onclick="$(this).prev().submit();$('.chatbox_iframe').attr('src', $('.chatbox_iframe').attr('src'));" src="img/emoticon/5.png" style="cursor:pointer;" width="40px" border="0"/>
													</td>
													<td style="padding:5px; width:1px; text-align:center;">
														<form action="postchat.php" target="frm_chatbox" method="post">
														<input name="chattext" value='<img src=\"img/emoticon/6.png\" width=\"40px\" border=\"0\"/>' type="hidden"/>
														<input name="send" value="send" type="hidden"/>
														</form>
														<img onclick="$(this).prev().submit();$('.chatbox_iframe').attr('src', $('.chatbox_iframe').attr('src'));" src="img/emoticon/6.png" style="cursor:pointer;" width="40px" border="0"/>
													</td>
												</tr>
												<tr>
													<td style="padding:5px; width:1px; text-align:center;">
														<form action="postchat.php" target="frm_chatbox" method="post">
														<input name="chattext" value='<img src=\"img/emoticon/7.png\" width=\"40px\" border=\"0\"/>' type="hidden"/>
														<input name="send" value="send" type="hidden"/>
														</form>
														<img onclick="$(this).prev().submit();$('.chatbox_iframe').attr('src', $('.chatbox_iframe').attr('src'));" src="img/emoticon/7.png" style="cursor:pointer;" width="40px" border="0"/>
													</td>
													<td style="padding:5px; width:1px; text-align:center;">
														<form action="postchat.php" target="frm_chatbox" method="post">
														<input name="chattext" value='<img src=\"img/emoticon/8.png\" width=\"40px\" border=\"0\"/>' type="hidden"/>
														<input name="send" value="send" type="hidden"/>
														</form>
														<img onclick="$(this).prev().submit();$('.chatbox_iframe').attr('src', $('.chatbox_iframe').attr('src'));" src="img/emoticon/8.png" style="cursor:pointer;" width="40px" border="0"/>
													</td>
													<td style="padding:5px; width:1px; text-align:center;">
														<form action="postchat.php" target="frm_chatbox" method="post">
														<input name="chattext" value='<img src=\"img/emoticon/9.png\" width=\"40px\" border=\"0\"/>' type="hidden"/>
														<input name="send" value="send" type="hidden"/>
														</form>
														<img onclick="$(this).prev().submit();$('.chatbox_iframe').attr('src', $('.chatbox_iframe').attr('src'));" src="img/emoticon/9.png" style="cursor:pointer;" width="40px" border="0"/>
													</td>
												</tr>
												<tr>
													<td style="padding:5px; width:1px; text-align:center;">
														<form action="postchat.php" target="frm_chatbox" method="post">
														<input name="chattext" value='<img src=\"img/emoticon/line_01.png\" width=\"40px\" border=\"0\"/>' type="hidden"/>
														<input name="send" value="send" type="hidden"/>
														</form>
														<img onclick="$(this).prev().submit();$('.chatbox_iframe').attr('src', $('.chatbox_iframe').attr('src'));" src="img/emoticon/line_01.png" style="cursor:pointer;" width="40px" height="40px" border="0"/>
													</td>
													<td style="padding:5px; width:1px; text-align:center;">
														<form action="postchat.php" target="frm_chatbox" method="post">
														<input name="chattext" value='<img src=\"img/emoticon/11.png\" width=\"40px\" border=\"0\"/>' type="hidden"/>
														<input name="send" value="send" type="hidden"/>
														</form>
														<img onclick="$(this).prev().submit();$('.chatbox_iframe').attr('src', $('.chatbox_iframe').attr('src'));" src="img/emoticon/11.png" style="cursor:pointer;" width="40px" border="0"/>
													</td>
													<td style="padding:5px; width:1px; text-align:center;">
														<form action="postchat.php" target="frm_chatbox" method="post">
														<input name="chattext" value='<img src=\"img/emoticon/12.png\" width=\"40px\" border=\"0\"/>' type="hidden"/>
														<input name="send" value="send" type="hidden"/>
														</form>
														<img onclick="$(this).prev().submit();$('.chatbox_iframe').attr('src', $('.chatbox_iframe').attr('src'));" src="img/emoticon/12.png" style="cursor:pointer;" width="40px" border="0"/>
													</td>
												</tr>
											</table>
										</div>
									</div>
								</td>
								<td style="padding-right:5px; width:1px; vertical-align:top;">
									<div style="position:relative;">
										<table style="width:50px; height:46px; background-color:#ffffff;" border="0" cellpadding="0" cellspacing="0">
											<tr>
												<td style="text-align:center;">
													<img src="images/plus_40.png" border="0"/>
												</td>
											</tr>
										</table>
										<div style="position:absolute; opacity:0; left:0px; top:10px; width:50px; height:46px; overflow:hidden;">
											<form action="postchat.php" target="frm_chatbox" method="post" enctype="multipart/form-data">
											<input onchange="$(this).parent().submit();loading_show('white','');" name="chat_file" type="file"/>
											<input name="send" value="send" type="hidden"/>
											</form>
										</div>
									</div>
								</td>
								<td style="padding-right:5px; width:1px; vertical-align:top;">
									<style>
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
											left:0px;
											top:0px;
										}
									</style>
									<script>
										function translated_select(v){
											$(".chat_textarea").val( $(".chat_textarea").val()+" "+v );
										}
										function pra_translate(x_this){
											var v = $.trim(x_this.val());
											$.ajax({
												type: "POST",
												url: "translating_query.php",
												data: { v:v },
												cache: false,
												success: function(result){
													$(".translated_container").html(result);
												}
											});
										}
									</script>
									<table height="46px" align="right" border="0" cellpadding="0" cellspacing="0" width="100">
										<tr>
											<td style="text-align:center; color:#ffcc00;">
												แปลภาษา
												/
												翻译
											</td>
										</tr>
										<tr>
											<td style="padding-top:2px; height:1px; text-align:right;">
												<input onkeyup="pra_translate($(this));" style="margin:0px; width:150px; text-align:center;" type="text"/>
												<div style="position:relative;">
													<div class="translated_container">
													</div>
												</div>
											</td>
										</tr>
									</table>
								</td>
								<td style="vertical-align:top;">
									<iframe name="frm_chatbox" width="1px" height="0px" frameborder="0" id="frm_chatbox"></iframe>
									<form action="postchat.php" target="frm_chatbox" method="post">
									<textarea class="chat_textarea" style="width:100%; height:40px;" name="chattext"></textarea>
								</td>
								<td style="padding-left:10px; width:1px; vertical-align:top;">
									<input style="margin:0px; height:46px;" name="send" type="submit" id="send" value="ส่งข้อความ / 发送" >
									</form>
								</td>
							</tr>
						</table>
					</td>
				</tr>
				<?php
					}else{
				?>
				<tr>
					<td bgcolor="#220b00">
						<form action="chat_login.php" method="post" name="REG" target="p_wb" id="REG">
						<table width="85%" border="0" align="center" cellpadding="0" cellspacing="0">
							<tr>
								<td width="54%">
									<input name="username" type="text" id="username" placeholder="username"> <input name="password" type="password" id="password" placeholder="password"> <input name="Login" type="submit" id="loginchat" value="เข้าสู่ระบบแชท/登录"><a href="register_mem.php" style="color:#F00; text-decoration:underline; font-weight:bold">
										สมัครสมาชิกทั่วไป/免费注册
									</a>
								</td>
							</tr>
                            <tr>
                            	<td>
                                <span style="color:#FC0">
										สามารถใช้ username & password ของร้านได้/有直接用您所注册商店的username & password
									</span>
                                </td>
                            </tr>
						</table>
						</form>
					</td>
				</tr>
				<?php
					}
				?>
			</table>
		</td>
	</tr>
</table>
