<?php
	include('../global.php');

	include('head.php');
	include('config/function.php');
	// echo date("Y-m-d H:i:s");
	?>
	<style type="text/css">
		.feedinput{
			border-collapse: collapse;
			color:#fff;
		}
		.feedinput td{
			padding-bottom: 10px;
		}
		.feedinputtitle{
			font-size: 13px;
			font-weight: bold;
			white-space: nowrap;
		}
		.feeddottitle{
			font-size: 13px;
			font-weight: bold;
			padding-left: 10px;
			padding-right: 10px;
			width: 1px;
		}
		textarea{
			resize:none;
		}
	</style>
<body>
	<div id="wrapper">
		<?php
			include('header.php');
			?>
		<div id="container">
			<div class="box_content">
				<table width="1000px" border="0" align="center" cellpadding="0" cellspacing="0" class="table">
					<tr>
						<td colspan="2" bgcolor="#4A1701" class="head_contain" style="padding-left: 11px;text-align:left;">
							<span class="text_yellpw"><b>Feedback</b></span>
						</td>
					</tr>
					<tr>
						<td colspan="2" align="center" style="height:100%;">
							<form id="form1" name="form1" method="post" action="global_query.php" onsubmit="return FormCheck();">
								<table width="455" border="0" align="center" cellpadding="3" class="feedinput">
									<tr>
										<td height="20px"></td>
									</tr>
									<tr>
										<td width="50" align="right" valign="top">
											<span class="feedinputtitle">
												ผู้เขียน
											</span>
										</td>
										<td align="center" valign="top" class="feeddottitle">
												:
										</td>
										<td width="405" valign="top">
											<?php
												$dbmember = mysql_fetch_array(mysql_query("SELECT * FROM auc_member WHERE m_id = '".$_SESSION['aucuser_id']."' "));
											?>
											<input type="text" name="txt_sender" id="txt_sender" value="<?=$dbmember['m_username']?>" readonly/>
										</td>
									</tr>
									<tr>
										<td align="right" valign="top">
											<span class="feedinputtitle">
												ผู้ถูกเขียนถึง
											</span>
										</td>
										<td align="center" valign="top" class="feeddottitle">
												:
										</td>
										<td valign="top">
											<?php
												$dbauction = mysql_fetch_array(mysql_query("SELECT * FROM auc_regist ac INNER JOIN auc_member am ON ac.reg_memid = am.m_id WHERE reg_id = '".$_GET['reg_id']."' "));
											?>
											<input type="text" value="<?=$dbauction['m_username']?>" readonly />
											<input type="hidden" name="txt_to" id="txt_to" value="<?=$dbauction['m_id']?>"/>
										</td>
									</tr>
									<tr>
										<td align="right" valign="top">
											<span class="feedinputtitle">
												อ้างถึงการประมูลเลขที่
											</span>
										</td>
										<td align="center" valign="top" class="feeddottitle">
												:
										</td>
										<td valign="top">
											#<?=$_GET['reg_id']?>
											<input type="hidden" name="reg_id" id="reg_id" value="<?=$_GET['reg_id']?>"/>
										</td>
									</tr>
									<tr>
										<td align="right" valign="top">
											<span class="feedinputtitle">
												ชื่อพระเครื่อง
											</span>
										</td>
										<td align="center" valign="top" class="feeddottitle">
												:
										</td>
										<td valign="top">
											<?=$dbauction['reg_wattuname']?>
										</td>
									</tr>
									<tr>
										<td align="right" valign="top">
											<span class="feedinputtitle">
												ประเภท
											</span>
										</td>
										<td align="center" valign="top" class="feeddottitle">
												:
										</td>
										<td valign="top">
											<table border="0" cellpadding="0" align="left" cellspacing="0">
												<tr>
													<td>
														<label>
															<input type="radio" name="feedtype" id="feedtypeo" value="1" />
															คำชม&nbsp;
														</label>
													</td>
													<td width="1">
														<img src="images/feed_icon1.png" border="0">
													</td>
													<td>
														<label>
															<input type="radio" name="feedtype" id="feedtype2" value="2" />
															เฉยๆ&nbsp; 
														</label>
													</td>
													<td width="1">
														<img src="images/feed_icon2.png" border="0">
													</td>
													<td>
														<label>
															<input type="radio" name="feedtype" id="feedtype3" value="3" />
															ตำติ&nbsp;
														</label>
													</td>
													<td width="1">
														<img src="images/feed_icon3.png" border="0">
													</td>
												</tr>
											</table>
										</td>
									</tr>
									<tr>
										<td align="right" valign="top">
											<span class="feedinputtitle">
												ความคิดเห็น
											</span>
										</td>
										<td align="center" valign="top" class="feeddottitle">
												:
										</td>
										<td valign="top">
											<textarea name="txt_feeddetail" id="txt_feeddetail" cols="45" rows="5"></textarea>
										</td>
									</tr>
									<tr>
										<td align="right" valign="top">&nbsp;</td>
										<td align="center" valign="top">&nbsp;</td>
										<td valign="top">&nbsp;</td>
									</tr>
									<tr>
										<td align="right" valign="top">&nbsp;</td>
										<td align="center" valign="top">&nbsp;</td>
										<td valign="top">
											<input type="hidden" name="do_what" value="feed_insert"/>
											<input type="submit" name="button" id="button" value="ตกลง" />
											<input type="reset" name="button2" id="button2" value="ยกเลิก" />
										</td>
									</tr>
									<tr>
										<td height="20px"></td>
									</tr>
								</table>
								<iframe src="" name="reg_frm" width="1px" height="0px" frameborder="0" id="reg_frm"></iframe> 
							</form>
						</td>
					</tr>
				</table>
			</div>
		</div>
		<?php
			include('footer.php');
			?>
	</div>
	<script type="text/javascript">
		function	FormCheck(){
			var _feeddetail = $("textarea[name=txt_feeddetail]");
			var _feedtype = $("input[name=feedtype]:checked");

			if(_feeddetail.val() == ""){
				alert("กรุณากรอกข้อมูลให้ครบถ้วยด้วยครับ");
				return false;
			}
			else if(_feedtype.length == 0){
				alert("กรุณากรอกข้อมูลให้ครบถ้วยด้วยครับ");
				return false;
			}
			else{
				return true;
			}
		}
	</script>
</body>
</html>