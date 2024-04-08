<?php
	include('../global.php');
	
	if(!isset($_SESSION['aucuser_id'])){
		header("location:index.php");
	}
	
	include('head.php');

	$member_id = $_SESSION['aucuser_id'];

	$do_what = $_POST['do_what'];
	if( $do_what == "update_to_db"){
		$sql_member = "update auc_member set m_name = '".$_POST['firstname']."', m_surname = '".$_POST['lastname']."', m_address = '".$_POST['address']."', m_country = '".$_POST['country']."', m_account = '".$_POST['accountname']."', m_bank = '".$_POST['bankname']."', m_bankoffset = '".$_POST['subbank']."', m_bankno = '".$_POST['noaccount']."', m_banktype = '".$_POST['account_type']."', m_tel = '".$_POST['phone']."', m_email = '".$_POST['emial']."', m_updated = '".date("Y-m-d H:i:s")."' where m_id = '".$_GET['u']."' ";
		$q_member = mysql_query($sql_member);
		if($q_member){
			echo "<script>alert('".$language['text_editdata_complete']."');</script>";
			echo"<meta http-equiv='refresh' content='0;url=profile.php'>";
		}
	}

	if( $do_what == "avatar_change"){
		$filepart = $_FILES["avatar"]["tmp_name"];
		$rename = "Thumbnails_".$_FILES["avatar"]["name"];

		upload_resize($filepart,"avatar/",$rename,90);

		$sql_member = "update auc_member set avatar = '$new_images' where m_id = '".$_SESSION['aucuser_id']."' ";
		$q_member = mysql_query($sql_member);
	}

	if($_GET['u']){
		$r_member = mysql_fetch_array(mysql_query("select * from auc_member where m_id = '".$_GET['u']."' "));
	}
	$r_member = mysql_fetch_array(mysql_query("select * from auc_member where m_id = '$member_id' "));

	function strAppenPer($string,$qty){
		$text = $string;
		if(strlen($text) < $qty){
			$new_text = $string;
		}else{
			$new_text = mb_substr($text, 0,$qty,'utf-8').'...';
		}
		return $new_text;
	}
	?>
<body>
	<div id="wrapper">
		<?php
			include('header.php');
			?>
		<div id="container">
			<div class="box_content">
				<form action="" method="post" name="frmmem_update" id="frmmem_update"  enctype="multipart/form-data" style="margin: 0;">
					<table width="1000px" border="0" align="center" cellpadding="0" cellspacing="0" class="condition_tb_textjustify">
						<tr>
							<td colspan="2" style="background: url('images/bgprofile.png');">
								<table width="100%" border="0" cellpadding="0" cellspacing="0">
									<tr>
										<td colspan="2" style="background: url('images/top_tab.png');height: 40px;text-align:center;">
											<span class="text_title">
												<?=$language['text_member_detail'];?>
											</span>
										</td>
									</tr>
									<tr>
										<td colspan="2">
											<table width="100%" border="0" cellpadding="0" cellspacing="0">
												<tr>
													<td style="width:50%;height:300px;" valign="top">
														<table width="100%" border="0" cellpadding="0" cellspacing="0" class="tb_text">
															<tr>
																<td>&nbsp;</td>
																<td>&nbsp;</td>
															</tr>
															<tr>
																<td valign="top" rowspan="5" style="width:1px;height:1px;">
																	<div style="position:relative;" onmouseover="$(this).find('div:eq(1)').show();" onmouseout="$(this).find('div:eq(1)').hide();">
																		<div>
																			<img src="avatar/<?=($r_member["avatar"]=="")?'default.png':$r_member["avatar"]?>" width="90px" height="90px" onmouseover='$(".zoom_profile").show("slow");'  onmouseout='$(".zoom_profile").hide();' />
																		</div>
																		<div style="display:none; position:absolute; left:0px; top:64px; width:88px; background-color:#ffffff; border:1px solid #e1e1e1;">
																			<div style="display:none;">
																				<!-- <form method="post" enctype="multipart/form-data"> -->
																				<input name="do_what" value="avatar_change" type="hidden"/>
																				<input class="avatar_change" name="avatar" onchange='$("#frmmem_update").submit()' accept="image/*" type="file"/>
																				<!-- </form> -->
																			</div>
																			<table width="100%" border="0" cellpadding="0" cellspacing="0">
																				<tr>
																					<td onclick="$('.avatar_change').trigger('click');" style="text-align:center; font-size:12px; font-weight:normal; color:#444444; cursor:pointer;white-space: nowrap;padding: 0;">
																						เปลี่ยนรูปภาพ
																					</td>
																				</tr>
																			</table>
																		</div>
																	</div>
																</td>
																<td><strong><?=$language['text_member_id'];?></strong> : <?=$r_member['m_id'];?></td>
															</tr>
															<tr>
																<td><strong><?=$language['text_member_username'];?></strong> : <?=$r_member['m_username'];?></td>
															</tr>
															<tr>
																<td><strong><?=$language['text_member_namepra'];?></strong> : <?=$r_member['m_name'];?></td>
															</tr>
															<tr>
																<td><strong><?=$language['text_member_email'];?></strong> : <?=($_GET['u'])?'<input type="text" id="emial" name="emial" value="'.$r_member['m_email'].'">':$r_member['m_email'];?></td>
															</tr>
															<tr>
																<td><strong><?=$language['text_member_tel'];?></strong> : <?=($_GET['u'])?'<input type="text" id="phone" name="phone" value="'.$r_member['m_tel'].'">':$r_member['m_tel'];?></td>
															</tr>
															<tr>
																<td>&nbsp;</td>
																<td>&nbsp;</td>
															</tr>
															<tr>
																<td colspan="2"><strong><?=$language['text_member_created'];?></strong> : <?=date("d/m/Y",strtotime($r_member['m_created']));?></td>
															</tr>
															<tr>
																<td colspan="2"><strong><?=$language['text_member_exp'];?></strong> : <?=date("d/m/Y",strtotime($r_member['m_created'])+31536000);?></td>
															</tr>
															<tr>
																<td>&nbsp;</td>
																<td>&nbsp;</td>
															</tr>
															<tr>
																<td colspan="2">
																	<?
																		if($_GET['u']){
																		?>
																			<input type="hidden" name="do_what" value="update_to_db">
																			<input type="submit" value="ตกลง">
																		<?
																		}else{
																		?>
																		<a href="?u=<?=$r_member['m_id'];?>">
																			<strong><?=$language['link_edit_profile'];?></strong>
																		</a>
																		<?
																		}
																	?>
																</td>
															</tr>
														</table>
													</td>
													<td style="width:50%;border-left:2px #873300 solid;" valign="top">
														<table width="100%" border="0" cellpadding="0" cellspacing="0" class="tb_text">
															<tr>
																<td>
																	<strong><?=$language['text_member_name'].'-'.$language['lastname'];?></strong> : <?=($_GET['u'])?'<input type="text" id="firstname" name="firstname" value="'.$r_member['m_name'].'">&nbsp;<input type="text" id="lastname" name="lastname" value="'.$r_member['m_surname'].'">':$r_member['m_name'].' '.$r_member['m_surname'];?>
																</td>
															</tr>
															<tr>
																<td>
																	<strong><?=$language['text_member_address'];?></strong> : <?=($_GET['u'])?'<textarea rows="4" cols="30" name="address" id="address">'.$r_member['m_address'].'</textarea>':$r_member['m_address'];?>
																</td>
															</tr>
															<tr>
																<td>
																	<strong><?=$language['text_member_country'];?></strong> : 
																	<?php
																	if($_GET['u']){
																		?>
																	<select name="country" id="country">
																		 <option value="Thailand" <? if($r_member['m_country'] == "Thailand"){echo "selected";}?> >Thailand</option>
																		 <option value="Malaysia" <? if($r_member['m_country'] == "Malaysia"){echo "selected";}?> >Malaysia</option>
																		 <option value="Singapore" <? if($r_member['m_country'] == "Singapore"){echo "selected";}?> >Singapore</option>
																		 <option value="China" <? if($r_member['m_country'] == "China"){echo "selected";}?> >China</option>
																		 <option value="Hongkong" <? if($r_member['m_country'] == "Hongkong"){echo "selected";}?> >Hongkong</option>
																		 <option value="Taiwan" <? if($r_member['m_country'] == "Taiwan"){echo "selected";}?> >Taiwan</option>
																		 <option value="Indonesia" <? if($r_member['m_country'] == "Indonesia"){echo "selected";}?> >Indonesia</option>
																	</select>
																		<?
																	}else{
																		echo $r_member['m_country'];
																	}
																	?>
																</td>
															</tr>
															<tr>
																<td style="background:url(images/bg_bankdetail.png) no-repeat,#4B2003;">
																	<strong><?=$language['text_member_bankdetail'];?></strong>
																</td>
															</tr>
															<tr>
																<td>
																	<strong><?=$language['text_member_bank'];?></strong> : <?=($_GET['u'])?'<input type="text" id="bankname" name="bankname" value="'.$r_member['m_bank'].'">':$r_member['m_bank'];?>
																</td>
															</tr>
															<tr>
																<td>
																	<strong><?=$language['text_member_bankoffset'];?></strong> : <?=($_GET['u'])?'<input type="text" id="subbank" name="subbank" value="'.$r_member['m_bankoffset'].'">':$r_member['m_bankoffset'];?>
																</td>
															</tr>
															<tr>
																<td>
																	<strong><?=$language['text_member_accountname'];?></strong> : <?=($_GET['u'])?'<input type="text" id="accountname" name="accountname" value="'.$r_member['m_account'].'">':$r_member['m_account'];?>
																</td>
															</tr>
															<tr>
																<td>
																	<strong><?=$language['text_member_noaccount'];?></strong> : <?=($_GET['u'])?'<input type="text" id="noaccount" name="noaccount" value="'.$r_member['m_bankno'].'">':$r_member['m_bankno'];?>
																</td>
															</tr>
															<tr>
																<td>
																	<strong><?=$language['text_member_accounttype'];?></strong> 
																	: 
																	<?
																		$type_bank = array(
																			"1" => "ออมทรัพย์",
																			"2" => "กระแสรายวัน"
																		);
																		if($_GET['u']){
																		?>
																			<input type="radio" value="1" id="account_type1" name="account_type" <? if($r_member['m_banktype']==1){echo "checked";}?>/> ออมทรัพย์ 
																			<input type="radio" value="2" id="account_type1" name="account_type" <? if($r_member['m_banktype']==2){echo "checked";}?>/> กระแสรายวัน
																		<?
																		}else{
																			echo $type_bank[$r_member['m_banktype']];
																		}
																	?>
																</td>
															</tr>
														</table>
													</td>
												</tr>
											</table>
										</td>
									</tr>
									<tr>
										<td colspan="2" align="center" style="background: url('images/bottom_tab.png');height: 28px;">
											<!-- text content -->
										</td>
									</tr>
									<tr>
										<td colspan="2" style="background: url('images/bottom_tab_bottom.png')no-repeat;height: 16px;">
											&nbsp;
										</td>
									</tr>
								</table>
							</td>
						</tr>
						<tr>
							<td colspan="2" style="background: url('images/bgprofile.png');">
								<table width="100%" border="0" cellpadding="0" cellspacing="0">
									<tr>
										<td colspan="2" style="background: url('images/top_tab.png');height: 40px;text-align:center">
											<span class="text_title">
												<?=$language['text_listpostauc_price'];?>
											</span>
										</td>
									</tr>
									<tr>
										<td colspan="2">
											<?php
												if(isset($_GET['win'])){
													$stristpost= "select * from auc_reply ar inner join auc_regist at ON ar.rep_aucid = at.reg_id where at.reg_winid = '".$_SESSION['aucuser_id']."' group by ar.rep_aucid";
												}else{
													$stristpost= "select * from auc_reply ar inner join auc_regist at ON ar.rep_aucid = at.reg_id where ar.rep_memid = '".$_SESSION['aucuser_id']."' group by ar.rep_aucid";
												}
												$qistpost = mysql_query($stristpost);
											?>
											<table width="951" border="0" align="center" cellpadding="0" cellspacing="0">
												<tr>
													<td colspan="2" align="center"><font color="#FFFFFF"><?=$language['title_listpostauc_price'];?> <?= mysql_num_rows($qistpost);?> <?=$language['text_list'];?></font></td>
												</tr>
												<tr>
													<td colspan="2">
													<?php
														while ($result_listpost = mysql_fetch_array($qistpost)) {
															?>
														<table width="100" border="0" cellpadding="0" align="center" cellspacing="0" class="table_boxdata">
															<tr>
																<td colspan="2" style="background: rgb(105, 105, 105);">
																	<a target="_blank" href="view.php?id=<?=$result_listpost['reg_id']?>">
																		<img src="fileupload/<?=$result_listpost['reg_file0']?>" width="130" height="130" style="margin: 10px;">
																	</a>
																</td>
															</tr>
															<tr>
																<td colspan="2" align="center" style="color:#F4B124;">
																	<?=strAppenPer($result_listpost['reg_wattuname'],20)?>
																</td>
															</tr>
														</table>
															<?
														} 
													?>
													</td>
												</tr>
											</table>
										</td>
									</tr>
									<tr>
										<td colspan="2" style="background: url('images/bottom_tab.png');height: 28px;">
											<table border="0" cellpadding="0" align="center" cellspacing="0">
												<tr>
													<td>
														<label style="color: rgb(223, 188, 78);font-weight: bold;">
															<input type="radio" name="selectmyauc" id="selectmyauc" onclick="window.location.href='profile.php'" <?=isset($_GET['win'])?'':'checked'?> >
															ทั้งหมด
														</label>
													</td>
													<td>
														<label style="color: rgb(223, 188, 78);font-weight: bold;">
															<input type="radio" name="selectmyauc" id="selectmyauc2" onclick="window.location.href='profile.php?win'" <?=isset($_GET['win'])?'checked':''?>>
															เฉพราะที่ท่านชนะประมูล
														</label>
													</td>
												</tr>
											</table>
										</td>
									</tr>
									<tr>
										<td colspan="2" style="background: url('images/bottom_tab_bottom.png')no-repeat;height: 16px;">
											&nbsp;
										</td>
									</tr>
								</table>
							</td>
						</tr>
						<tr>
							<td colspan="2" style="background: url('images/bgprofile.png');">
								<table width="100%" border="0" cellpadding="0" cellspacing="0">
									<tr>
										<td colspan="2" style="background: url('images/top_tab.png');height: 40px;text-align:center;">
											<span class="text_title">
												<?=$language['text_listaucpra'];?>
											</span>
										</td>
									</tr>
									<tr>
										<td colspan="2">
											<?php
												$straucpra= mysql_query("select * from auc_regist where reg_memid ='".$_SESSION['aucuser_id']."' order by reg_id desc");
											?>
											<table width="951" border="0" align="center" cellpadding="0" cellspacing="0">
												<tr>
													<td colspan="2" align="center"><font color="#FFFFFF"><?=$language['text_listaucpra_member'];?> <?= mysql_num_rows($straucpra);?> <?=$language['text_list'];?></font></td>
												</tr>
												<tr>
													<td colspan="2">
													<?php
														while ($result_aucpra = mysql_fetch_array($straucpra)) {
															?>
														<table width="100" border="0" cellpadding="0" align="center" cellspacing="0" class="table_boxdata">
															<tr>
																<td colspan="2" style="background: rgb(105, 105, 105);">
																	<a target="_blank" href="view.php?id=<?=$result_aucpra['reg_id']?>">
																		<img src="fileupload/<?=$result_aucpra['reg_file0']?>" width="130" height="130" style="margin: 10px;">
																	</a>
																</td>
															</tr>
															<tr>
																<td colspan="2" align="center" style="color:#F4B124;">
																	<a title="<?=$result_aucpra['reg_wattuname']?>" target="_blank" href="view.php?id=<?=$result_aucpra['reg_id']?>">
																		<?=strAppenPer($result_aucpra['reg_wattuname'],20)?>
																	</a>
																</td>
															</tr>
															<tr align="center" style="color:white">
																<td style="padding: 6px;">
																	<a class="link_control" href="auction_regist.php?e=<?=$result_aucpra['reg_id']?>">
																		<img src="images/Modify.png" border="0" width="14">
																	</a>
																	<a class="link_control" href="javascript:void(0)" onclick="deleteauction(<?=$result_aucpra['reg_id']?>)">
																		<img src="images/delete_xx.png" border="0" width="17">
																	</a>
																</td>
																<td>	
																	<a href="auction_regist.php?e=<?=$result_aucpra['reg_id']?>&repost=1" style="text-decoration: none;color: rgb(138, 130, 98);">Repost</a>
																</td>
															</tr>
														</table>
															<?
														} 
													?>
													</td>
												</tr>
											</table>
										</td>
									</tr>
									<tr>
										<td colspan="2" style="background: url('images/bottom_tab.png');height: 28px;">
											&nbsp;
										</td>
									</tr>
									<tr>
										<td colspan="2" style="background: url('images/bottom_tab_bottom.png')no-repeat;height: 16px;">
											&nbsp;
										</td>
									</tr>
								</table>
							</td>
						</tr>
						<tr>
							<td colspan="2" style="background: url('images/bgprofile.png');">
								<table width="100%" border="0" cellpadding="0" cellspacing="0">
									<tr>
										<td colspan="2" style="background: url('images/top_tab.png');height: 40px;text-align:center;">
											<span class="text_title">
												<?=$language['text_post_memberpra'];?>
											</span>
										</td>
									</tr>
									<tr>
										<td colspan="2">
											<!-- &nbsp;dfd -->
										</td>
									</tr>
									<tr>
										<td colspan="2" style="background: url('images/bottom_tab.png');height: 28px;">
											&nbsp;
										</td>
									</tr>
									<tr>
										<td colspan="2" style="background: url('images/bottom_tab_bottom.png')no-repeat;height: 16px;">
											&nbsp;
										</td>
									</tr>
								</table>
							</td>
						</tr>
					</table>
				</form>
			</div>
		</div>
		<?php
			include('footer.php');
			?>
	</div>

	<script type="text/javascript">
		function deleteauction (v){
			if(confirm('กรุณายืนยันการลบอีกครั้ง !!!  ')){
				$.ajax({
					url:'profile_query.php',
					type :'POST',
					data :{do_what : "delauction" ,v : v },
					success : function(result){
						if(result == 1){
							location.reload();
						}
					}
				});
			}else{
				return false;
			}
		}

		function Repost(x_id){
			$('input[name="hidrepost"]').val(x_id);
			$(".dialog").fadeIn();
			$(".bg_dialog").fadeIn();
			$('html, body').animate({scrollTop:0}, 'slow');
		}

		function Repost_Send(){
			$.ajax({
				 url:'profile_query.php',
				 type:'POST',
				 dataType:'JSON',
				 data:{do_what:"repost",id:$('input[name="hidrepost"]').val(),data:$('select[name="datestep"]').val()},
				 success : function(res){
					$('#showdate').text(res.data);
					$('input[type="button"]').hide();
					setTimeout(function () {
						location.reload();
					},4000);
				 }
			}); 
		}
	</script>
</body>
</html>