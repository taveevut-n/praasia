<?php
	include('../global.php');
	
	include('head.php');
?>
<body>
	<div id="wrapper">
		<?php
			include('header.php');
			?>
		<div id="container">
			<div class="box_content">
				<style type="text/css">
					.box_content_module{
						display: block;
						background: url("images/bg_text_content.png");
						height: 890px;
					}
					.box_content_index{
						display: block;
					}
					.title{
						background: #341e10;
						height: 32px;
						border-bottom: 2px #573a24 solid;
						border-top: 2px #573a24 solid;
					}
					.text_title{
						font-size: 14px;
						font-weight: bold;
						color: #eee;
						margin-left: 9px;
						letter-spacing: 0.5px;
					}
				</style>
				<table width="1000px" border="0" align="center" cellpadding="0" cellspacing="0" class="condition_tb_textjustify">
					<tr>
						<td width="210px" valign="top" style="padding-left:0px;padding-right:0px;background: #000;">
							<?php include("left_banner.php");?>
						</td>
						<td valign="top" height="100%">
							<div class="box_content_module">
								<div class="box_content_index">
									<table width="100%" border="0" cellpadding="0" cellspacing="0">
										<tr>
											<td class="title">
												<span class="text_title">
													ยินดีต้อนรับ
												</span>
											</td>
										</tr>
										<tr>
											<td style="text-align: justify;height: 70px;">
												&nbsp;
											</td>
										</tr>
									</table>
								</div>
								<div class="box_content_index">
									<table width="100%" border="0" cellpadding="0" cellspacing="0">
										<tr>
											<td class="title">
												<span class="text_title">
													กระทู้เด่น
												</span>
											</td>
										</tr>
										<tr>
											<td style="text-align: justify;height: 150px;">
												&nbsp;
											</td>
										</tr>
									</table>
								</div>
								<div class="box_content_index">
									<table width="100%" border="0" cellpadding="0" cellspacing="0">
										<tr>
											<td class="title">
												<span class="text_title">
													ประชาสัมพันธุ์
												</span>
											</td>
										</tr>
										<tr>
											<td style="text-align: justify;height: 150px;">
												&nbsp;
											</td>
										</tr>
									</table>
								</div>
								<div class="box_content_index">
									<table width="100%" border="0" cellpadding="0" cellspacing="0">
										<tr>
											<td class="title">
												<span class="text_title">
													พระยอดนิยม กทม
												</span>
											</td>
										</tr>
										<tr>
											<td style="text-align: justify;height: 150px;">
												&nbsp;
											</td>
										</tr>
									</table>
								</div>
								<div class="box_content_index">
									<table width="100%" border="0" cellpadding="0" cellspacing="0">
										<tr>
											<td class="title">
												<span class="text_title">
													หมวดพระเกจิอาจารย์ภาคกลาง
												</span>
											</td>
										</tr>
										<tr>
											<td style="text-align: justify;height: 150px;">
												&nbsp;
											</td>
										</tr>
									</table>
								</div>
							</div>
						</td>
						<td width="210px" valign="top" style="padding-right:0px;padding-left:0px;background: #000;">
							&nbsp;
						</td>
					</tr>
				</table>
			</div>
		</div>
		<?php
			include('footer.php');
			?>
	</div>
</body>
</html>