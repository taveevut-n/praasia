<?php
	include("global.php");

	$recipient = mysql_fetch_array(mysql_query("select * from member where md5(id) =  '".$_GET['recipient']."' "));
	$sender = mysql_fetch_array(mysql_query("select * from member where md5(id) =  '".$_GET['sender']."' "));
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
		<td style="padding:10px; background-color:#4f3b2a;">
			<form method="post">
			<table width="100%" border="1" cellpadding="0" cellspacing="0">
				<tr style="height:30px;">
					<td style="padding-left:20px; font-size:14px; background-color:#db4b00;">
						ส่งข้อความ / 送信息
					</td>
				</tr>
				<tr>
					<td style="background-color:#7f6500;">
						<form method="post">
						<input name="do_what" value="message_add" type="hidden"/>
						<table width="100%" border="0" cellpadding="0" cellspacing="0">
							<tr style="height:40px;">
								<td style="padding-left:20px; padding-top:10px; width:1px; text-align:right; vertical-align:top; white-space:nowrap;">
									ชื่อผู้รับ / 收件人
								</td>
								<td style="padding-left:10px; padding-right:10px; padding-top:10px; width:1px; vertical-align:top;">
									:
								</td>
								<td style="padding-top:5px; vertical-align:top;">
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
													mysql_query("insert into twe_message( message, create_date, sender_id, receiver_id ) values( '$message', '".date("Y-m-d H:i:s")."', '".$recipient['id']."', '$v' )");
													$email_sander_name = $_SERVER["SERVER_NAME"];
													$email_sander_email = $sender["email"];
													$email_sander_bcc = "";
													$email_subject = "Message from ". $sender["name"];
													$email_attachment = "";
													$email_html = "
														$message
														<br/>
														เมื่อ ".date("Y-m-d H:i:s")."
														<p>กรุณาตรวจสอบให้แน่ชัดก่อนว่า ผู้ส่งจากประเทศไหน ใช้ภาษาอะไร(ไทย-จีน)ในการสื่อสารบ้าง ก่อนที่จะทำการส่ง mail กลับ / 请查清收件人来自哪个国家，应该用什么语言(中-泰文)来回复收件人</p>
														<p>กรุณาคลิกลิงค์ด้านล่างนี้เพื่ตอบกลับ / 请点击下面的连结(Link)回复收件人</p>
														<p><a href=\"http://praasia.com/backend_pm_replymail.php?sender=".md5($recipient['id'])."&recipient=".md5($sender["id"])."\">http://praasia.com/backend_pm_replymail.php?sender=".md5($recipient['id'])."&recipient=".md5($sender["id"])."</p>
													";
													$email_addressee = $sender["email"];
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
													 if($_GET['recipient']){
														?>
													 		<input style="width:597px;" type="text" value="<?=$sender['name'];?>" readonly />
													 	<?
													 }else{
													 	?>
													 		<input onkeyup="dropdown_search($(this));" style="width:597px;" type="text"/>
													 	<?
													 }
													?>
												<div class="dropdown_outer" style="position:relative; z-index:2;">
													<?
													 if($_GET['recipient']){
														?>
													 		<input name='member[]' value='<?=$sender['id']?>' type='hidden'/>
													 	<?
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
								<td style="padding-left:20px; width:1px; text-align:right; vertical-align:middle; white-space:nowrap;">
									จากประเทศ / 国家
								</td>
								<td style="padding-left:10px; vertical-align:middle; padding-right:10px; width:1px;">
									:
								</td>
								<td>
									<?=$sender['country'];?>
								</td>
							</tr>
							<?
							if(isset($_GET['pro_id'])){
							?>
							<tr style="height:30px;">
								<td style="padding-left:20px; width:1px; text-align:right; vertical-align:middle; white-space:nowrap;">
									สินค้าที่เกี่ยวข้อง / 询问有关的产品，请点击以下的连结
								</td>
								<td style="padding-left:10px; vertical-align:middle; padding-right:10px; width:1px;">
									:
								</td>
								<td>
									<a href="http://www.praasia.com/shop_product.php?product_id=<?=$_GET['pro_id']?>">http://www.praasia.com/shop_product.php?product_id=<?=$_GET['pro_id']?></a>
								</td>
							</tr>
							<?
							}
							?>
							<tr style="height:30px;">
								<td style="padding-left:20px; width:1px; text-align:right; vertical-align:middle; white-space:nowrap;">
									Contact us
								</td>
								<td style="padding-left:10px; vertical-align:middle; padding-right:10px; width:1px;">
									:
								</td>
								<td>
									<?
									$contactexplode = explode("/", $sender['contact']);
									if($contactexplode[0]=="line"){
										echo "Line ID : ".$contactexplode[1];
									}
									else if($contactexplode[0]=="wechat"){
										echo "Wechat ID : ".$contactexplode[1];
									}
									?>
								</td>
							</tr>
							<tr style="height:30px;">
								<td style="padding-left:20px; width:1px; text-align:right; vertical-align:top; white-space:nowrap;">
									ข้อความ / 信息
								</td>
								<td style="padding-left:10px; vertical-align:top; padding-right:10px; width:1px;">
									:
								</td>
								<td>
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
									<input class="textbox_flat translate_textbox" style="width:150px;" onkeyup="translate_text($(this));" type="text"/>
									<div style="position:relative; left:0px; top:0px;"><div class="translated_container"></div></div>
								</td>
							</tr>
							<tr style="height:40px;">
								<td style="padding-left:20px; width:1px; white-space:nowrap;">
									
								</td>
								<td style="padding-left:10px; padding-right:10px; width:1px;">
									
								</td>
								<td>
									<input value="ยืนยันการส่งข้อความ / 发送" type="submit"/>
								</td>
							</tr>
							<tr style="height:40px;">
								<td colspan="3" style="padding-left:20px; width:1px; white-space:nowrap;text-align:center;">
									<span style="color:rgb(241, 241, 40);font-size: 15px;line-height: 25px;">หากเป็นชาวต่างชาติ กรุณากรอกภาษาไทยลงในช่องแปลภาษาเพื่อทำการแปลเป็นภาษาจีนให้เรียบร้อยก่อนค่อยทำการส่ง </br> 如收件人是泰国人，请先把中文单词输入翻译系统进行翻译成泰文，这样双方才能明的您们所发出的信息</span>
								</td>
							</tr>
						</table>
						</form>
					</td>
				</tr>
				<tr>
					<td align="center" height="45" ><h3><strong>แอดเป็นเพื่อนเพื่อแปลภาษาระหว่าง ผู้ซื้อ-ผู้ขาย-ผู้แปล ในด้านการซื้อขายพระเครื่อง 加为好友后才能进行 买家-卖家-翻译家三家一起交易</strong></h3></td>
				</tr>
				<tr>
					<td coslspan="2">
						<table border="0" cellpadding="18" align="center" cellspacing="0">
							<tr>
								<td align="center"><strong>LINE ID</strong><br />
								  <br />
ID : pok88888<br />
<br />								  
<img alt="" src="http://www.praasia.com/file//images/42255.jpg" style="width:167px"></td>
								<td align="center">&nbsp;</td>
								<td align="center"><strong>微信号 Wechat ID</strong><br />
								  <br />
ID : pok0831854074<br />
<br />								  
<img alt="" src="http://www.praasia.com/file//images/42254.jpg" style="width:167px" /></td>
							</tr>
							<tr>
								<td height="34" align="center">&nbsp;</td>
								<td align="center">&nbsp;</td>
								<td align="center">&nbsp;</td>
							</tr>
						</table>
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
<!-- End Save for Web Slices -->
</body>
</html>
