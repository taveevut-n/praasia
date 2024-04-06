<?php
	include("global.php");
	if( $_SESSION['adminshop_id'] == '' || !isset($_SESSION['adminshop_id']) ) {  
		redi4("index.php");
	}
	set_page($s_page,$e_page = 20);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

	<title>
		ระบบจัดการเว็บไซต์  : จัดการสินค้า
	</title>

	<link rel="shortcut icon" href="favicon.ico" />
	<link rel="favicon" href="favicon.ico" />
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

	<!--jquery ui Local-->
	<link rel="stylesheet" href="func/jquery-ui-1.10.3/themes/base/jquery-ui.css" />
	<script src="func/jquery-ui-1.10.3/jquery-1.9.1.js"></script>
	<script src="func/jquery-ui-1.10.3/ui/jquery-ui.js"></script>

	<!--Iswallows CKEditor-->
	<script src="http://iswallows.com/func/ckeditor/ckeditor.js"></script>

	<style type="text/css">
		html, body {
			margin:0px;
			padding:0px;
			width:100%;
			height:100%;
		}
		body {
			background-color:#000000;
		}
		body,td,th {
			font-family: Arial, Helvetica, sans-serif;
			font-size: 12px;
			color: #FFF;
		}
		a:link {
			text-decoration: none;
		}
		a:visited {
			text-decoration: none;
		}
		a:hover {
			text-decoration: none;
		}
		a:active {
			text-decoration: none;
		}
		table{
			border-collapse:collapse;
		}
	</style>

	<script type="text/javascript">
		function MM_swapImgRestore() { //v3.0
			var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
		}
		function MM_preloadImages() { //v3.0
			var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
			var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
			if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
		}
		function MM_findObj(n, d) { //v4.01
			var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
			d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
			if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
			for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
			if(!x && d.getElementById) x=d.getElementById(n); return x;
		}
		function MM_swapImage() { //v3.0
			var i,j=0,x,a=MM_swapImage.arguments; document.MM_sr=new Array; for(i=0;i<(a.length-2);i+=3)
			if ((x=MM_findObj(a[i]))!=null){document.MM_sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];}
		}
	</script>

</head>
<body onLoad="MM_preloadImages('images/images/menu-backend2_02.jpg','images/images/menu-backend2_04.jpg','images/images/menu-backend2_05.jpg','images/images/menu-backend2_06.jpg','images/images/menu-backend2_07.jpg','images/images/menu-backend2_08.jpg')">
<table width="1000px" align="center" border="0" cellpadding="0" cellspacing="0">
	<tr>
		<td>
			<img src="images/defualt.jpg" width="1000" height="271">
		</td>
    </tr>
	<tr>
		<td height="180px" style="background:#ff0000 url(images/backend.jpg) no-repeat">
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td><img src="images/images/menubackend_01.jpg" width="103" height="180"></td>
					<td><a href="shop_index.php?shop=<?=$_SESSION['adminshop_id']?>" target="_blank" onMouseOver="MM_swapImage('Image8','','images/images/menu-backend2_02.jpg',1)" onMouseOut="MM_swapImgRestore()"><img src="images/images/menubackend_02.jpg" name="Image8" width="122" height="180" border="0"></a></td>
					<td><a href="backend.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image9','','images/images/menu-backend2_03.jpg',0)"><img src="images/images/menubackend_03.jpg" name="Image9" width="102" height="180" border="0"></a></td>
					<td><a href="banner_slide.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image10','','images/images/menu-backend2_04.jpg',1)"><img src="images/images/menubackend_04.jpg" name="Image10" width="108" height="180" border="0"></a></td>
					<td><a href="backend_banner.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image11','','images/images/menu-backend2_05.jpg',1)"><img src="images/images/menubackend_05.jpg" name="Image11" width="129" height="180" border="0"></a></td>
					<td><a href="backend_profile.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image12','','images/images/menu-backend2_06.jpg',1)"><img src="images/images/menubackend_06.jpg" name="Image12" width="103" height="180" border="0"></a></td>
					<td><a href="backend_passwod.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image13','','images/images/menu-backend2_07.jpg',1)"><img src="images/images/menubackend_07.jpg" name="Image13" width="136" height="180" border="0"></a></td>
					<td><a href="logout.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image14','','images/images/menu-backend2_08.jpg',1)"><img src="images/images/menubackend_08.jpg" name="Image14" width="92" height="180" border="0"></a></td>
					<td><img src="images/images/menubackend_09.jpg" width="105" height="180"></td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td style="height:1px;">
			<?php
				include("backend_menutop.php");
			?>
		</td>
	</tr>
	<tr>
		<td style="padding:10px; background-color:#4f3b2a;">
			<form method="post">
			<table width="600" border="1" cellpadding="0" cellspacing="0" align="center">
				<tr style="height:30px;">
					<td style="padding-left:20px; font-size:14px; background-color:#db4b00;">
						ส่งข้อความ / 送信息
					</td>
				</tr>
				<tr>
					<td style="background-color:#7f6500;">
						<style type="text/css">
							.tb_chat{
								border-collapse: collapse;
							}
							.tb_chat td{
								padding: 0px 4px 0px 0px;
							}
						</style>
						<form method="post">
						<input name="do_what" value="message_add" type="hidden"/>
						<table width="100%" border="0" cellpadding="0" cellspacing="0" class="tb_chat">
							<tr style="height:40px;">
								<td style="padding-left:20px; padding-top:10px; width:1px; text-align:right; vertical-align:top; white-space:nowrap;">
									ชื่อผู้รับ / 收件人
								</td>
								<td style="padding-left:10px; padding-right:10px; padding-top:10px; width:1px; vertical-align:top;">
									:
								</td>
								<td style="padding-top:5px; vertical-align:top;" colspan="3">
									<?php
										$do_what = $_POST["do_what"];
										if($do_what == "message_add"){
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
												echo '<meta http-equiv="refresh" content="0;url=backend_pm.php"/>';
											}
										}
									?>
									<style>
										.dropdown_td {
											padding-left:10px;
											padding-right:10px;
											padding-top:5px;
											padding-bottom:5px;
											white-space:nowrap;
											color:#444444;
											background-color:#ffffff;
											border:1px solid #e1e1e1;
											cursor:pointer;
										}
										.dropdown_td:hover {
											background-color:#f5f5f5;
										}
										.member {
											float:left;
											margin:5px;
											white-space:nowrap;
											background-color:#70d0ec;
											-webkit-border-radius:5px;
											-moz-border-radius:5px;
											border-radius:5px;
											-webkit-box-shadow: inset rgba(0,0,0,0.5) 0px 0px 5px;
											-moz-box-shadow: inset rgba(0,0,0,0.5) 0px 0px 5px;
											box-shadow: inset rgba(0,0,0,0.5) 0px 0px 5px;
										}
										.member .member_name {
											padding:5px;
											padding-left:10px;
											padding-right:0px;
											color:#444444;
											cursor:default;
										}
										.member .member_remove {
											padding:5px;
											padding-left:10px;
											padding-right:10px;
											color:#444444;
											cursor:pointer;
										}
										.member .member_remove:hover {
											color:#ff0000;
										}
									</style>
									<script>
										function dropdown_remove(x_this){
											x_this.parent().parent().parent().parent().remove();
										}
										function dropdown_search(x_this){
											var v = x_this.val();
											if(v != ""){
												$.ajax({
													type: "POST",
													url: "backend_query.php",
													data: { do_what:"pm_member_search", v:v },
													cache: false,
													success: function(result){
														$(".dropdown_container").html(result);
													}
												});
											}else{
												$(".dropdown_container").html("");
											}
										}
										function dropdown_select(x_this){
											var id = x_this.attr("attr_id");
											var name = $.trim(x_this.html());
											$(".receiver_container").append("<div class='member'><input name='member[]' value='"+id+"' type='hidden'/><table border='0' cellpadding='0' cellspacing='0'><tr><td class='member_name'>"+name+"</td><td class='member_remove' onclick='dropdown_remove($(this))'>x</td></tr></table></div>");
											$(".dropdown_container").html("");
										}
									</script>
									<table border="0" cellpadding="0" cellspacing="0">
										<tr>
											<td>
												<?
													 if($_GET['v']){
														?>
													 		<input style="width:597px;" type="text" value="<?=urldecode($_GET["v"])?>" readonly />
													 	<?
													 }else{
													 	?>
													 		<input onkeyup="dropdown_search($(this));" style="width:597px;" type="text"/>
													 	<?
													 }
													?>
												<div class="dropdown_outer" style="position:relative; z-index:2;">
													<?
													 if($_GET['v']){
													 	$v = urldecode($_GET["v"]);
														$member = new nDB();
														$member->query("select * from member where name = '$v'");
														$n_member = $member->num_rows();
														$member->next_record();
														if($n_member > 0){
														?>
													 		<input name='member[]' value='<?=$member->f('id')?>' type='hidden'/>
													 	<?
														}
													 }else{
													 	?>
													 		<div class="dropdown_container" style="position:absolute;"></div>
													 	<?
													 }
													?>
												</div>
											</td>
										</tr>
										<tr>
											<td>
												<div class="receiver_container" style="position:relative;">

												</div>
											</td>
										</tr>
									</table>
								</td>
							</tr>
							<tr style="height:30px;">
								<td style="padding-left:20px; width:1px; text-align:right; vertical-align:top; white-space:nowrap;">
									ข้อความ / 信息
								</td>
								<td style="padding-left:10px; vertical-align:top; padding-right:10px; width:1px;">
									:
								</td>
								<td colspan="3">
									<div style="width:600px; position:relative; z-index:1;">
										<textarea id="message" name="message"></textarea>
									</div>
									<script>
										CKEDITOR.replace("message");
									</script>
								</td>
							</tr>
							<tr style="height:30px;">
								<td style="padding-left:20px; width:1px; text-align:right; white-space:nowrap;">
									แปลภาษา / 翻译
								</td>
								<td style="padding-left:10px; padding-right:10px; width:1px;">
									:
								</td>
								<td>
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
											var current_value = CKEDITOR.instances["message"].getData();
											CKEDITOR.instances["message"].setData( current_value+" "+v );
											$(".translated_container").html("");
											$(".translate_textbox").val("");
										}
										function translate_text(x_this){
											var v = $.trim(x_this.val());
											$.ajax({
												type: "POST",
												url: "shop_chatbox_query.php",
												data: { do_what:"translate", v:v },
												cache: false,
												success: function(result){
													$(".translated_container").html(result);
												}
											});
										}
									</script>
									<input class="textbox_flat translate_textbox" style="width:221px;" onkeyup="translate_text($(this));" type="text"/>
									<div style="position:relative; left:0px; top:0px;">
										<div class="translated_container"></div>
									</div>
								</td>
								<td align="right">
									<input class="shoppm_text shoppm_translateleave_textbox" placeholder="ใส่คำที่ฝากแปล" type="text"/>
								</td>
								<td style="width:1px;padding-right: 7px;">
									<input class="shoppmleave_submit" onclick="shoppm_translate_leave();" value="ฝากแปลภาษา / 存录为了帮我翻译" type="button"/>
								</td>
							</tr>
							<tr style="height:40px;">
								<td style="padding-left:20px; width:1px; white-space:nowrap;">
									
								</td>
								<td style="padding-left:10px; padding-right:10px; width:1px;">
									
								</td>
								<td align="center" colspan="3">
									<input value="ยืนยันการส่งข้อความ / 发送" type="submit"/>
								</td>
							</tr>
						</table>
						</form>
					</td>
				</tr>
			</table>
			</form>
		</td>
	</tr>
	<tr>
		<td>
			<?php include('footer.php');?>
		</td>
	</tr>
</table>
</body>
<script type="text/javascript">
	function shoppm_translate_leave(){
		var v = $.trim($(".shoppm_translateleave_textbox").val());
		if( $.trim(v) != "" ){
			$.ajax({
				type: "POST",
				url: "shop_query.php",
				data: { do_what:"shoppm_translate_leave", v:v },
				cache: false,
				success: function(result){
					$(".shoppm_translateleave_textbox").val("");
					alert(result);
				}
			});
		}else{
			alert("กรุณากรอกข้อความก่อนทำการฝากแปล");
		}
	}
</script>
</html>
