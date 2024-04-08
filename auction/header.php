<div id="header">
	<?php 
		$url_expl = explode("/",$_SERVER['PHP_SELF']);
		if($url_expl[2] == "index.php"){
			$banner_display = 'block';
			$banner_in_display = 'none';
			$banner_in_height = '503px';
		}else{
			$banner_display = 'none';
			$banner_in_display = 'block';
			$banner_in_height = '282px';
		}
	?>
	<table width="100%" height="<?=$banner_in_height?>" border="0" cellpadding="0" cellspacing="0" align="center">
		<tr>
			<td style="position:relative;">
				<div class="head_stack_top">
					<div class="panal_language">
						<table width="100%" border="0" cellpadding="0" cellspacing="0" align="center">
							<tr>
								<td align="left" width="40%" height="30px">
									<table width="100%" border="0" cellpadding="6" cellspacing="0" align="center">
										<tr>
											<td align="left">
												<?
												if(isset($_SESSION['aucuser_id'])) {
												$rtrmember = mysql_fetch_array(mysql_query("SELECT * FROM auc_member WHERE m_id = '".$_SESSION['aucuser_id']."' ")); 
												$nacution = mysql_num_rows(mysql_query("SELECT * FROM auc_regist WHERE reg_memid = '".$_SESSION['aucuser_id']."' "));
												?>
												<table border="0" cellpadding="0" cellspacing="0">
													<tr>
														<td>
															&nbsp;
														</td>
														<td>
															<?=$language['text_product_count'];?> :
														</td>
														<td>
															<?=$nacution?> / <?=$rtrmember['m_countproduct'];?>
														</td>
													</tr>
												</table>
												<?
												}
												?>
											</td>
											<td align="left">
												<table border="0" cellpadding="0" cellspacing="0">
													<tr>
														<?
														if(isset($_SESSION['aucuser_id'])) {
														?>
															<td><a href="catagories.php"><?=$language['link_list_dataauction'];?></a></td>
															<td><a href="auction_regist.php"><?=$language['link_auctin_regist'];?></a></td>
															<td><a href="coupon_regist.php"><?=$language['text_couporn'];?></a></td>
														<?
														}
														?>
													</tr>
												</table>
											</td>
										</tr>
									</table>
								</td>
								<td align="left" width="20%">
									&nbsp;
								</td>
								<td align="right" width="40%">
									<table width="100%" border="0" cellpadding="0" cellspacing="0" align="center">
										<tr>
											<td align="left">
												&nbsp;
											</td>
											<td align="right">
												<table border="0" cellpadding="0" cellspacing="0">
													<tr>
														<td><a href="index.php"><?=$language['link_member_home'];?></a></td>
															<?
															if(isset($_SESSION['aucuser_id'])) {
															?>
														<td><a href="profile.php"><?=$language['link_member_profile'];?></a></td>
														<td>|<td>
														<td><a href="logout.php"><?=$language['link_member_logout'];?></a></td>
															<?
															}
															?>
														<td>|<td>
														<td align="right"><?=$language['btn_language'];?> : </td>
														<td align="right"><img src="images/th.png" onclick="window.location.href='?lang=th';" style="cursor: pointer;"></td>
														<td align="right"><img src="images/jp.png" onclick="window.location.href='?lang=ch';" style="cursor: pointer;"></td>
													</tr>
												</table>
											</td>
										</tr>
									</table>
								</td>
							</tr>
						</table>
					</div>
				</div>
				<div class="head_stack1" style="display: <?=$banner_display?>;">
					<table width="100%" height="100%" border="0" cellpadding="0" align="center" cellspacing="0">
						<tr>
							<td valign="bottom">
								<table border="0" cellpadding="0" align="center" cellspacing="0">
									<tr>
										<td height="86px" align="center">
											<img src="images/title_banner.png" border="0">
										</td>
										<td width="10px">&nbsp;</td>
										<td  align="center">
											<img src="images/title_banner.png" border="0">
										</td>
										<td width="10px">&nbsp;</td>
										<td  align="center">
											<img src="images/title_banner.png" border="0">
										</td>
										<td width="10px">&nbsp;</td>
										<td  align="center">
											<img src="images/title_banner.png" border="0">
										</td>
										<td width="10px">&nbsp;</td>
										<td  align="center">
											<img src="images/title_banner.png" border="0">
										</td>
									</tr>
								</table>
							</td>
						</tr>
					</table>
				</div>
				<div class="head_stack_in" style="display: <?=$banner_in_display?>;">
					&nbsp;
				</div>
				<div class="head_stack2" style="display: <?=$banner_display?>;">
					&nbsp;
				</div>
				<div class="head_stack4" style="display: <?=$banner_display?>;">
					&nbsp;
				</div>
				<div class="head_stack3" style="display: <?=$banner_display?>;">
					<?php
						if (isset($_SESSION['aucuser_id'])) {
							?>
						<table width="100%" border="0" cellpadding="6" align="center" cellspacing="0">
							<?php
							$current_user = mysql_fetch_array(mysql_query("SELECT * FROM auc_member WHERE m_id = '".$_SESSION['aucuser_id']."' "));
							?>
							<tr>
								<td>
									<table width="100%" border="0" cellpadding="0" cellspacing="0" class="tb_text">
										<tr>
											<td height="90px">&nbsp;</td>
											<td>&nbsp;</td>
										</tr>
										<tr>
											<td valign="top" rowspan="5" style="width:1px;height:1px;">
												<img src="avatar/<?=($current_user["avatar"]=="")?'default.png':$current_user["avatar"]?>" width="90px" height="90px" />
											</td>
											<td><strong><?=$language['text_member_id'];?></strong> : <?=$current_user['m_id'];?></td>
										</tr>
										<tr>
											<td><strong><?=$language['text_member_username'];?></strong> : <?=$current_user['m_username'];?></td>
										</tr>
										<tr>
											<td><strong><?=$language['text_member_namepra'];?></strong> : <?=$current_user['m_name'];?></td>
										</tr>
										<tr>
											<td><strong><?=$language['text_member_email'];?></strong> : <?=($_GET['u'])?'<input type="text" id="emial" name="emial" value="'.$current_user['m_email'].'">':$current_user['m_email'];?></td>
										</tr>
										<tr>
											<td><strong><?=$language['text_member_tel'];?></strong> : <?=($_GET['u'])?'<input type="text" id="phone" name="phone" value="'.$current_user['m_tel'].'">':$current_user['m_tel'];?></td>
										</tr>
										<tr>
											<td>&nbsp;</td>
											<td>&nbsp;</td>
										</tr>
										 <tr>
											<td colspan="2">
											<style type="text/css">
												.text_feedback{
													font-size: 13px;
													font-weight: bold;
												}
												.text_feedback a{
													color: #D1A229;
												}
											</style>
												<?php
													$arr_aucID = array();
													$Sql = "SELECT * FROM `auc_reply` ac LEFT JOIN auc_member m ON ac.rep_memid = m.m_id WHERE ac.rep_memid = ".$_SESSION['aucuser_id']." GROUP BY ac.rep_aucid";
													$Query = mysql_query($Sql);
													while ($Arr = mysql_fetch_array($Query)) {
														array_push($arr_aucID ,$Arr['rep_aucid']);
													}
													$_SESSION['arr_aucID'] = implode(",", $arr_aucID) ;

													$SqlFeed = "SELECT * FROM `auc_feedback`WHERE reg_id IN (".$_SESSION['arr_aucID'].") AND m_id = ".$_SESSION['aucuser_id']." ";
													$QueryFeed = mysql_query($SqlFeed);
												?>
												<strong><?=$language['text_member_created'];?></strong> : <?=date("d/m/Y",strtotime($current_user['m_created']));?> 
												<span class="text_feedback">
												 (<a href="feedback_list_data.php">ท่านมี <?=number_format(count($arr_aucID) - mysql_num_rows($QueryFeed));?> รายการที่ยังไม่ได้ feedback</a>)
												</span>
											</td>
										</tr>
										<!--<tr>
											<td colspan="2"><strong><?=$language['text_member_exp'];?></strong> : <?=$current_user['m_created'];?></td>
										</tr> -->
										<tr>
											<td>&nbsp;</td>
											<td>&nbsp;</td>
										</tr>
									</table>
								</td>
							</tr>
						</table>
							<?
						}else{
							?>
					<form action="global_query.php" method="post" name="frmmem_login" id="frmmem_login">
						<iframe src="" name="reg_frm" width="1px" height="0px" frameborder="0" id="reg_frm"></iframe> 
						<table width="100%" border="0" cellpadding="6" align="center" cellspacing="0">
							<tr>
								<td colspan="4" height="60px">
									&nbsp;
								</td>
							</tr>
							<tr>
								<td width="143px" align="right"><b><span class="head_stack3_text_title">Username</span></b></td>
								<td width="1" style="padding-left: 5px;padding-right: 5px;"><b><span class="head_stack3_text_title">:</span></b></td>
								<td width="1">
									<input type="text" name="username" class="head_stack3_input">
								</td>
								<td>
									&nbsp;
								</td>
							</tr>
							<tr>
								<td align="right"><b><span class="head_stack3_text_title">Password</span></b></td>
								<td style="padding-left: 5px;padding-right: 5px;"><b><span class="head_stack3_text_title">:</span></b></td>
								<td>
									<input type="password" name="password" class="head_stack3_input">
								</td>
								<td style="padding-left: 20px;padding-right: 5px;padding-top: 16px;">
									<input type="hidden" name="do_what" value="login">
									<input type="submit" name="btnSubmit" id="btnSubmit" value="submit" style="display:none;">
									<span style="font-size: 14px;font-weight: bold;color: #cfe100;cursor: pointer;" onclick="$(this).prev().trigger('click')">Login</span>
								</td>
							</tr>
							<tr>
								<td colspan="4">
									<ul class="head_stack3_text_li">
										<li><a href="member_regist.php">สมัครสมาชิก</a></li>
										<li><a href="#">ต่ออายุสมาชิก</a></li>
										<li><a href="#">ให้หน้าประมูลพระเครืองเป็นหน้าแรก</a></li>
										<li><a href="#">ลืมรหัสผ่าน</a></li>
									</ul>
								</td>
							</tr>
						</table>
					</form>
							<?
						}
					?>
				</div>
			</td>
		</tr>
	</table>
</div>