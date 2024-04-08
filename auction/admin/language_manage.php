<?php
	include('head.php');

	$do_what = $_POST['do_what'];
	if( $do_what == "update_to_db"){
		$sqlu_lang = "update auc_language set ".$_POST['field_name']." = '".$_POST['text_lang']."' where content_id = '".$_POST['content_id']."' ";
		mysql_query($sqlu_lang);
	}
	if( $do_what == "condition_insert"){
		$sqlu_lang = "update auc_language set ".$_POST['field_name']." = '".$_POST['text_lang']."' where content_id = '".$_POST['content_id']."' ";
		mysql_query($sqlu_lang);
	}
?>
<body>
	<div id="wrapper">
		<?php
			include('header.php');
			?>
		<div id="container">
			<div class="box_content">
				<script type="text/javascript">
					$(document).ready(function(){

						$(".tab_select").click(function(){
							var x_index = $(".tab_select").index(this);
							$(".tab_select").removeClass("active");
							$(".tab_select:eq("+x_index+")").addClass("active");

							$(".tab_contenttext").hide();
							$(".tab_contenttext:eq("+x_index+")").show();
						});
						<?php
							if($_POST['do_what'] == "condition_insert"){
								$text_click = 1;
							}else{
								$text_click = 0;
							}
						?>
						$(".tab_select:eq(<?=$text_click?>)").trigger("click");
					});
				</script>
				<table width="1000px" border="0" align="center" cellpadding="0" cellspacing="0" class="condition-tdtext">
					<tr>
						<td width="200px" valign="top" style="background: rgb(82, 36, 15);">
							<? include('left_menu.php');?>
						</td>
						<td width="800px" valign="top" height="100%" style="background: rgb(82, 36, 15);">
							<div class="tab_container">
								<div class="tab_toptext">
									<table border="0" cellpadding="0" cellspacing="0" class="tb_toptext">
										<tr>
											<td class="tab_select">รายการภาษา</td>
											<td class="tab_select">เงื่อนไขการสมัครสมาชิก</td>
										</tr>
									</table>
								</div>
								<div class="tab_content">
									<div class="tab_contenttext">
										<table width="100%" border="0" cellpadding="0" align="center" cellspacing="0">
											<tr>
												<td>
													<div class="box_content_index">
														<table width="100%" border="0" cellpadding="0" cellspacing="0">
															<tr>
																<td class="title">
																	<span class="text_title">
																		ค้นหาภาษา
																	</span>
																</td>
															</tr>
															<tr>
																<td style="text-align: justify;">
																	<form method="GET" style="margin: 0;">
																		<table width="100%" border="0" cellpadding="0" cellspacing="0" class="tb_listdata">
																			<tr align="center">
																				<td style="width: 10%;">
																					<strong>ภาษาไทย</strong>
																					<input type="text" name="keyword" value="<?=$_GET['keyword']?>">
																					<input type="submit" value="search">
																				</td>
																			</tr>
																		</table>
																	</form>
																</td>
															</tr>
														</table>
													</div>
													<div class="box_content_index">
														<table width="100%" border="0" cellpadding="0" cellspacing="0">
															<tr>
																<td class="title">
																	<span class="text_title">
																		รายการภาษาทั้งหมด
																	</span>
																</td>
															</tr>
															<tr>
																<td style="text-align: justify;">
																	<table width="100%" border="0" cellpadding="0" cellspacing="0" class="tb_listdata">
																		<tr align="center">
																			<td style="width: 1%;"><strong>No</strong></td>
																			<td style="width: 30%;"><strong>Thai</strong></td>
																			<td style="width: 30%;"><strong>Chaina</strong></td>
																			<td style="width: 30%;"><strong>English</strong></td>
																		</tr>
																		<?
																		if($_GET['keyword']){
																			$sql_language = "select * from auc_language where with_use = 'general' and th like '%".$_GET['keyword']."%' ";
																		}else{
																			$sql_language = "select * from auc_language where with_use = 'general' ";
																		}
																		$q_language = mysql_query($sql_language);
																		$v = 0;
																		while ($r_language = mysql_fetch_array($q_language)) {
																			$v++;
																		?>
																		<tr>
																			<td>
																				<?=$v;?>
																			</td>
																			<td>
																				<?=$r_language['th'];?>
																			</td>
																			<td>
																				<form method="POST">
																					<input type="text" name="text_lang" value="<?=$r_language['ch'];?>">
																					<input type="hidden" name="do_what" value="update_to_db">
																					<input type="hidden" name="content_id" value="<?=$r_language['content_id']?>">
																					<input type="hidden" name="field_name" value="ch">
																					<input type="submit" value="ตกลง" class="btn btn_Default">
																				</form>
																			</td>
																			<td>
																				<form method="POST">
																					<input type="text" name="text_lang" value="<?=$r_language['eng'];?>">
																					<input type="hidden" name="do_what" value="update_to_db">
																					<input type="hidden" name="content_id" value="<?=$r_language['content_id']?>">
																					<input type="hidden" name="field_name" value="eng">
																					<input type="submit" value="ตกลง" class="btn btn_Default">
																				</form>
																			</td>
																		</tr>
																		<?
																		}
																		?>
																	</table>
																</td>
															</tr>
														</table>
													</div>
												</td>
											</tr>
										</table>
									</div>
									<div class="tab_contenttext">
										<script type="text/javascript">
											$(document).ready(function(){
												$('.text_lang').ckeditor();
											});
										</script>
										<?
										$str_regist_condition = "select * from auc_language where with_use = 'register'";
										$r_regist_condition = mysql_fetch_array(mysql_query($str_regist_condition));
										?>
										<table width="100%" border="0" cellpadding="0" align="center" cellspacing="0">
											<tr>
												<td>
													<h4>Thai</h4>
												</td>
											</tr>
											<form id="form1" name="form1" method="post" action="" enctype="multipart/form-data">
											<tr>
												<td>
													<textarea name="text_lang" class="text_lang">
														<?=$r_regist_condition['th']?>
													</textarea>
												</td>
											</tr>
											<tr>
												<td align="center">
													<input type="hidden" name="field_name" value="th">
													<input type="hidden" name="content_id" value="<?=$r_regist_condition['content_id']?>">
													<input type="hidden" name="do_what" value="condition_insert">
													<input type="submit" name="btnsubmit" value="ตกลง" class="btn btn_Default">
												</td>
											</tr>
											</form>
											<form id="form1" name="form1" method="post" action="" enctype="multipart/form-data">
											<tr>
												<td>
													<h4>Chaina</h1>
												</td>
											</tr>
											<tr>
												<td>
													<textarea name="text_lang" class="text_lang">
														<?=$r_regist_condition['ch']?>
													</textarea>
												</td>
											</tr>
											<tr>
												<td align="center">
													<input type="hidden" name="field_name" value="ch">
													<input type="hidden" name="content_id" value="<?=$r_regist_condition['content_id']?>">
													<input type="hidden" name="do_what" value="condition_insert">
													<input type="submit" name="btnsubmit" value="ตกลง" class="btn btn_Default">
												</td>
											</tr>
										</table>
										</form>
									</div>
								</div>
							</div>
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