<style>
	.right_button2 {
		color:#FFF;
		position:fixed;
		right:0px;
		top:120px;
		width:35px;
		height:200px;
		font-family:Tahoma;
		background:url(images/righttab.jpg) no-repeat;
		background-color:#fca909;
		cursor:pointer;
		z-index:1001;
		-webkit-border-radius: 5px 0px 0px 5px;
		-moz-border-radius: 5px 0px 0px 5px;
		border-radius: 5px 0px 0px 5px;
		border-left:1px solid #c46104;
		border-top:1px solid #c46104;
		border-bottom:1px solid #c46104;
	}	
	.right_button {
		position:fixed;
		right:0px;
		top:120px;
		width:35px;
		height:200px;
		font-family:Tahoma;
		background:url(images/righttab.jpg) no-repeat;
		background-color:#fca909;
		cursor:pointer;
		z-index:1001;
		-webkit-border-radius: 5px 0px 0px 5px;
		-moz-border-radius: 5px 0px 0px 5px;
		border-radius: 5px 0px 0px 5px;
		border-left:1px solid #c46104;
		border-top:1px solid #c46104;
		border-bottom:1px solid #c46104;
	}
	.right_button td {
		text-align:center;
		font-size:14px;
		color:#ffffff;
		text-shadow: 0px 0px white,-1px -1px #c46104;
	}
	.right_panel {
		position:fixed;
		right:-600px;
		top:50px;
		width:600px;
		height:355px;
		background:url(images/bg-shoprecommend.png) top no-repeat #FFF;
		overflow:hidden;
		-webkit-box-shadow:10px 0px 10px 0px rgba(0, 0, 0, 0.5);
		box-shadow:10px 0px 10px 0px rgba(0, 0, 0, 0.5);
		-webkit-border-radius:10px 0px 0px 10px;
		border-radius:10px 0px 0px 10px;
		z-index:1001;
	}
	.textbox_translate {
		margin:0px;
		padding:0px;
		width:100%;
		height:23px;
		text-align:left;
		font-size:14px;
		color:#444444;
		background-color:transparent;
		border:0px solid transparent;
		outline:none;
		-webkit-box-shadow: inset rgba(0,0,0,0.5) 0px 0px 1px;
		-moz-box-shadow: inset rgba(0,0,0,0.5) 0px 0px 1px;
		box-shadow: inset rgba(0,0,0,0.5) 0px 0px 1px;
		transition: all 0.2s ease 0s;
	}
	.textbox_translate:focus {
		color:#e00000;
		-webkit-box-shadow: inset rgba(0,0,0,0.5) 1px 1px 6px;
		-moz-box-shadow: inset rgba(0,0,0,0.5) 1px 1px 6px;
		box-shadow: inset rgba(0,0,0,0.5) 1px 1px 6px;
	}
	.textbox_translate:hover {
		color:#e00000;
	}
	.translated_outer {
		position:relative;
		height:170px;
		background-color:#f5f5f5;
		-webkit-box-shadow: inset rgba(0,0,0,0.5) 0px 0px 1px;
		-moz-box-shadow: inset rgba(0,0,0,0.5) 0px 0px 1px;
		box-shadow: inset rgba(0,0,0,0.5) 0px 0px 1px;
		overflow-y:scroll; 
	}
	.translated_container_index {
		padding:10px;
		vertical-align:top;
	}
</style>

<script>
	function rightpanel_translate_text(x_this){
		var v = x_this.val();
		$.ajax({
			type: "POST",
			url: "right_panel_query.php",
			data: { do_what:"translate_text", v:v },
			cache: false,
			success: function(result){
				$(".translated_container_index").html(result);
			}
		});
	}
	function translate_leave(v){
		if( $.trim(v) != "" ){
			$(".translateleave_info").html("กำลังส่ง...");
			$.ajax({
				type: "POST",
				url: "right_panel_query.php",
				data: { do_what:"translate_leave", v:v },
				cache: false,
				success: function(result){
					$(".translateleave_info").html(result);
					$(".translateleave_text").val('');
				}
			});
		}else{
			$(".translateleave_info").html("กรุณากรอกข้อความก่อนทำการฝากแปล");
		}
	}
	$(document).ready(function(){
		$(".right_button").click(function(){
			var attr_opened = $(this).attr("attr_opened");
			if(attr_opened == "0"){
				$(this).attr("attr_opened","1");
				$(this).transition({ x:"-600px" }, 600);
				$(".right_panel").transition({ x:"-600px" }, 600);
				/*$(this).animate({ "right":"+=600px" }, "slow");
				$(".right_panel").animate({ "width":"600px" }, "slow");*/
			}else{
				$(this).attr("attr_opened","0");
				$(this).transition({ x:"0px" }, 600);
				$(".right_panel").transition({ x:"0px" }, 600);
				/*$(this).animate({ "right":"0px" }, "slow");
				$(".right_panel").animate({ "width":"0px" }, "slow");*/
			}
		});
	});
	/*var scroll_timeout = setTimeout(function() {
		
	}, 1000);
	$(window).scroll(function() {
		clearTimeout(scroll_timeout);
		scroll_timeout = setTimeout(function() {
			var v_scroll = $(this).scrollTop();
			if(v_scroll > 150){
				$(".right_button").animate({ "top":(v_scroll + 120)+"px" }, "fast");
				$(".right_panel").animate({ "top":(v_scroll + 50)+"px" }, "fast");
			}else{
				$(".right_button").animate({ "top":"220px" }, "fast");
				$(".right_panel").animate({ "top":"150px" }, "fast");
			}
		}, 100);
	});*/
</script>
<table style="width:780px; height:350px; " border="0" cellpadding="0" cellspacing="0">
	<tr>
		<td style="vertical-align:top; font-size:14px; color:#444444;">
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td style="padding:10px; padding-top:7px; padding-bottom:7px; font-size:16px; font-weight:bold; text-shadow:1px 1px #ffffff; background-color:#f5f5f5; border-bottom:1px solid #e1e1e1;">
						แปลภาษา
						ไทย - จีน
						/翻译 中-泰
					</td>
				</tr>
				<tr>
					<td style="padding-bottom:10px; background-color:#ffffff;">
						<table width="100%" border="0" cellspacing="0" cellpadding="0">
							<tr style="height:30px;">
								<td style="padding-left:10px;">
									ใส่คำที่ต้องการแปล
									/输入单词进行翻译
								</td>
								<td style="padding-left:10px;">
									ผลลัพธ์คำแปล
									/翻译结果
								</td>
							</tr>
							<tr>
								<td style="padding-left:10px; width:1px; vertical-align:top;">
									<textarea class="textbox_translate" onKeyUp="rightpanel_translate_text($(this));" style="padding:10px; width:350px; height:150px;"></textarea>
								</td>
								<td style="padding-left:10px; padding-right:10px; vertical-align:top;">
									<div class="translated_outer">
										<table style="width:100%;" border="0" cellpadding="0" cellspacing="0">
											<tr>
												<td class="translated_container_index">&nbsp;
													
												</td>
											</tr>
										</table>
									</div>
								</td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td style="padding:10px; padding-top:7px; padding-bottom:7px; font-size:16px; font-weight:bold; text-shadow: 1px 1px #ffffff; background-color:#f5f5f5; border-top:1px solid #e1e1e1; border-bottom:1px solid #e1e1e1;">
						ฝากแปลภาษาที่เกี่ยวกับวงการพระเครื่อง
						<br />
						/输入关于佛牌交易方面的用词进行帮我翻译和存录
					</td>
				</tr>
				<tr>
					<td style="padding-top:7px; padding-bottom:7px; background-color:#ffffff;">
						<table width="100%" border="0" cellspacing="0" cellpadding="0">
							<tr style="height:30px;">
								<td style="padding-left:10px; padding-right:10px;">
									<input class="textbox_translate translateleave_text" style="padding-left:10px; padding-right:10px;"/>
								</td>
								<td style="padding-left:15px; padding-right:10px; width:1px;">
									<input onClick="translate_leave($('.translateleave_text').val());" style="margin:0px;" value="ฝากแปล / 存录为了帮我翻译" type="button"/>
								</td>
							</tr>
							<tr>
								<td class="translateleave_info" colspan="2" style="padding-left:20px; padding-right:10px; padding-top:3px; font-size:15px; color:#ff0000;text-align:center;">
									กรุณากรอกข้อความที่ต้องการฝากแปล
									/请输入佛牌交易方面的常用语给系统帮忙翻译
								</td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
		</td>
	</tr>
    <tr>
    	<td height="5"></td>
    </tr>
</table>
