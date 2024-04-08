<?php
	include('../global.php');

	if(!isset($_SESSION['aucuser_id'])){
		header("location:index.php");
	}
	
	include('head.php');

	$do_what = $_POST['do_what'];
	if( $do_what == "insert_to_db"){
		if($_POST['datestep']=='1.5'){
			$dateval = date("Y-m-d H:i:s",time()+(60*(60+30)*24*1));
		}else{
			$dateval = date("Y-m-d H:i:s",time()+(60*60*24*$_POST['datestep'])); // Plus Date 5 day
		}
		$sql_auction =	"INSERT INTO `auc_regist`( `reg_id`, `reg_memname`, `reg_actmessage`, `reg_address`, `reg_country`, `reg_telephone`, `reg_email`, `reg_wattuname`, `reg_catalogid`, `reg_wattudetail`, `reg_pricestart`, `reg_priceend`, `reg_pricestep`, `reg_day`, `reg_dateregist`, `reg_dateexpire`, `reg_pricemessage`, `reg_chkcondition1`, `reg_chkcondition2`, `reg_chkcondition3`, `reg_chkcondition4`, `reg_condition1`, `reg_condition2`, `reg_condition3`, `reg_condition4`, `reg_othercondition`, `reg_onlinedetail`, `reg_accountname`, `reg_bankname`, `reg_noaccount`, `reg_subaccount`, `reg_banktype`, `reg_created`, `reg_updated`, `reg_memid`,`rec_order`) VALUES ( NULL, '".$_POST['txt_action']."', '".$_POST['rdo_comment']."', '".$_POST['txt_address']."', '".$_POST['txt_country']."', '".$_POST['txt_telephone']."', '".$_POST['txt_email']."', '".$_POST['txt_watumongkhol']."', '".$_POST['catalog']."', '".$_POST['wattu_detail']."', '".$_POST['txt_openprice']."', '".$_POST['txt_closeprice']."', '".$_POST['price_step']."', '".$_POST['datestep']."', '".date("Y-m-d H:i:s")."', '".$dateval."', '".$_POST['txt_message']."', '".$_POST['chk_condition']."', '".$_POST['chk_condition2']."', '".$_POST['chk_condition3']."', '".$_POST['chk_condition4']."', '".$_POST['txt_condition']."', '".$_POST['txt_condition2']."', '".$_POST['txt_condition3']."', '".$_POST['txt_condition4']."', '".$_POST['txt_othercondition']."', '".$_POST['txt_monyonline']."', '".$_POST['txt_account_name']."', '".$_POST['txt_bankname']."', '".$_POST['txt_accountno']."', '".$_POST['txt_subaccount']."', '".$_POST['txt_banktype']."', '".date("Y-m-d H:i:s")."', '".date("Y-m-d H:i:s")."', '".$_SESSION['aucuser_id']."','".time()."' )";
		$q_auction = mysql_query($sql_auction);
		if($q_auction){
			$result = mysql_fetch_array(mysql_query("SELECT * FROM auc_regist ORDER BY reg_id DESC LIMIT 1"));
			$reg_id = $result['reg_id'];
			for($i=0;$i<count($_FILES["file"]["name"]);$i++){
				$filepart = $_FILES["file"]["tmp_name"][$i];
				$filename = $_FILES["file"]["name"][$i];
				if(trim($_FILES["file"]["name"][$i] != "")){
					$fileextension = end(explode(".",$filename));
					$filename = time().$i.$fileextension;

					upload_origin($filepart,"fileupload/",$filename);// required upload function in global.php file
					
					mysql_query("update auc_regist set reg_file$i = '$filename' WHERE reg_id ='".$reg_id."'");
				}
			}
			echo "<script>alert('".$language['text_savedata_complete']."');</script>";
			echo"<meta http-equiv='refresh' content='0;url=list_data.php'>";
		}
	}

	if( $do_what == "edit_to_db"){
		if($_POST['repost'] == 1){
			
			mysql_query("DELETE FROM auc_reply WHERE rep_aucid = '".$_GET['e']."' ");

			$sqlRepost = ",`rec_order` = '".time()."'";
		}
		if($_POST['datestep']=='1.5'){
			$dateval = date("Y-m-d H:i:s",time()+(60*(60+30)*24*1));
		}else{
			$dateval = date("Y-m-d H:i:s",time()+(60*60*24*$_POST['datestep'])); // Plus Date 5 day
		}
		$sql_auction =	"update `auc_regist` set `reg_memname` = '".$_POST['txt_action']."', `reg_actmessage` = '".$_POST['rdo_comment']."', `reg_address` = '".$_POST['txt_address']."', `reg_country` = '".$_POST['txt_country']."', `reg_telephone` = '".$_POST['txt_telephone']."', `reg_email` = '".$_POST['txt_email']."', `reg_wattuname` = '".$_POST['txt_watumongkhol']."', `reg_catalogid` = '".$_POST['catalog']."', `reg_wattudetail` = '".$_POST['wattu_detail']."', `reg_pricestart` = '".$_POST['txt_openprice']."', `reg_priceend` = '".$_POST['txt_closeprice']."', `reg_pricestep` = '".$_POST['price_step']."', `reg_day` = '".$_POST['datestep']."', `reg_dateregist` = '".date("Y-m-d H:i:s")."', `reg_dateexpire` = '".$dateval."', `reg_pricemessage` = '".$_POST['txt_message']."', `reg_chkcondition1` = '".$_POST['chk_condition']."', `reg_chkcondition2` = '".$_POST['chk_condition2']."', `reg_chkcondition3` = '".$_POST['chk_condition3']."', `reg_chkcondition4` = '".$_POST['chk_condition4']."', `reg_condition1` = '".$_POST['txt_condition']."', `reg_condition2` = '".$_POST['txt_condition2']."', `reg_condition3` = '".$_POST['txt_condition3']."', `reg_condition4` = '".$_POST['txt_condition4']."', `reg_othercondition` = '".$_POST['txt_othercondition']."', `reg_onlinedetail` = '".$_POST['txt_monyonline']."', `reg_accountname` = '".$_POST['txt_account_name']."', `reg_bankname` = '".$_POST['txt_bankname']."', `reg_noaccount` = '".$_POST['txt_accountno']."', `reg_subaccount` = '".$_POST['txt_subaccount']."', `reg_banktype` = '".$_POST['txt_banktype']."', `reg_updated` = '".date("Y-m-d H:i:s")."', `reg_memid` = '".$_SESSION['aucuser_id']."' $sqlRepost WHERE `reg_id` = '".$_GET['e']."' ";
		$q_auction = mysql_query($sql_auction);
		if($q_auction){
			$reg_id = $_GET['e'];
			for($i=0;$i<count($_FILES["file"]["name"]);$i++){
				$filepart = $_FILES["file"]["tmp_name"][$i];
				$filename = $_FILES["file"]["name"][$i];
				if(trim($_FILES["file"]["name"][$i] != "")){
					$fileextension = end(explode(".",$filename));
					$filename = time().$i.$fileextension;

					upload_origin($filepart,"fileupload/",$filename);// required upload function in global.php file
					
					mysql_query("update auc_regist set reg_file$i = '$filename' WHERE reg_id ='".$reg_id."'");
				}
			}
			echo "<script>alert('".$language['text_editdata_complete']."');</script>";
			echo"<meta http-equiv='refresh' content='0;url=auction_regist.php?e=".$_GET['e']."'>";
		}
	}

	if($_GET['e']){
		$reauction = mysql_fetch_array(mysql_query("SELECT * FROM auc_regist WHERE reg_id = '".$_GET['e']."' "));
	}
	?>
<body>
	<div id="wrapper">
		<?php
			include('header.php');
			?>
		<div id="container">
			<?
			$rtrmember = mysql_fetch_array(mysql_query("SELECT * FROM auc_member WHERE m_id = '".$_SESSION['aucuser_id']."' ")); 
			$nacution = mysql_num_rows(mysql_query("SELECT * FROM auc_regist WHERE reg_memid = '".$_SESSION['aucuser_id']."' "));
			if($nacution >= $rtrmember['m_countproduct']){
				?>
			<div class="box_content">
				<table width="100%" border="0" cellpadding="0" align="center" cellspacing="0">
					<tr>
						<td align="center">
							<h3>ไม่สามารถตั้งประมูลได้ เนื่องจากจำนวนสินค้าที่ตั้งประมูลครบจำนวนชิ้นตามแพเกจที่เลือก</h3>
							<h4>ซื้อแพกเกจพิ่มเติมได้ที่</h4>
						</td>
					</tr>
				</table>
			</div>
				<?
			}else{
			?>
			<div class="box_content">
				<form action="" method="post" name="frmauc_regist" id="frmauc_regist" enctype="multipart/form-data" name="auctionform" style="margin: 0;" onsubmit="return frmSubmit();">
					<table width="1000" border="0" align="center" cellpadding="0" cellspacing="0" class="tableaucregist">
						<tr>
							<td height="33" colspan="2" align="center" bgcolor="#603C18"><font color="#FFFFFF">
								<strong><?=$language['text_welcomto_aucregist'];?></strong></font>
							</td>
						</tr>
						<tr>
							<td height="33" colspan="2" align="center" bgcolor="#603C18">
								<style type="text/css">
									#translate{display: none;}
									#translate table,#translate table td{border:0px;}
									#panal_transalte{cursor: pointer;background: none repeat scroll 0 0 #ddd;  border-radius: 2px;cursor: pointer;padding: 5px;}
								</style>
								<script>
									function translate_slide(x_this){
										var isopen = x_this.attr("isopen");
										if(isopen == "1"){
											x_this.attr("isopen","0");
											x_this.find("span:eq(0)").show();
											x_this.find("span:eq(1)").hide();
											x_this.prev().slideUp();
										}else{
											x_this.attr("isopen","1");
											x_this.find("span:eq(0)").hide();
											x_this.find("span:eq(1)").show();
											x_this.prev().slideDown();
										}
									}
								</script>
								<div id="translate">
									<table border="0" cellpadding="0" cellspacing="0">
										<tr>
											<td>&nbsp;
											</td>
											<td style="color:#FC0;">
												<?php include('translate_bo.php'); ?>
											</td>
										</tr>
									</table>
								</div>
								<span id="panal_transalte"onClick="translate_slide($(this));" isopen="0">
									<span class="translate_button" style="color:#F00" >
										คลิกสู่ระบบแปลภาษา/点击进入翻译系统... ▼
									</span>
									<span style="display:none; color:#090" class="translate_button">
										คลิกเพื่อปิดระบบแปลภาษา/点击收回翻译系统... ▲
									</span>
								</span>
							</td>
						</tr>
						<tr>
							<td colspan="2" valign="top" bgcolor="#A75D2C">
								<div class="text_head">
									<strong><?=$language['text_dataauction_regist'];?></strong>
								</div>
							</td>
						</tr>
						<tr>
							<td width="232" align="right" valign="top" bgcolor="#FEE19D"><?=$language['text_name_regist'];?></td>
							<td width="752" valign="top" bgcolor="#FDCB84"><?=$rtrmember['m_username']?></td>
						</tr>
						<tr>
							<td align="right" valign="top" bgcolor="#FEE19D"><?=$language['text_registsendmail'];?></td>
							<td valign="top" bgcolor="#FDCB84">
								<table width="457"  class="tablebordernone">
									<tr>
										<td><?=$language['text_regist_getmail'];?></td>
									</tr>
									<tr>
										<td width="447"><label>
											<input type="radio" name="rdo_comment" id="rdo_comment" value="1" <? if($reauction['reg_actmessage'] == 1){echo "checked";} ?>/>
											<?=$language['text_regist_getmailauction'];?></label>
										</td>
									</tr>
									<tr>
										<td><label>
											<input name="rdo_comment" type="radio" id="rdo_comment2" value="0" <? if($reauction['reg_actmessage'] == 0){echo "checked";}?>/>
											<?=$language['text_regist_nongetmailauction'];?></label>
										</td>
									</tr>
								</table>
							</td>
						</tr>
						<tr>
							<td align="right" valign="top" bgcolor="#FEE19D"><?=$language['text_regist_address'];?></td>
							<td valign="top" bgcolor="#FDCB84"><?=$rtrmember['m_address'];?></td>
						</tr>
						<tr>
							<td align="right" valign="top" bgcolor="#FEE19D"><?=$language['text_regist_country'];?></td>
							<td valign="top" bgcolor="#FDCB84"><?=$rtrmember['m_country'];?></td>
						</tr>
						<tr>
							<td align="right" valign="top" bgcolor="#FEE19D"><?=$language['text_regist_phone'];?></td>
							<td valign="top" bgcolor="#FDCB84"><?=$rtrmember['m_tel'];?></td>
						</tr>
						<tr>
							<td align="right" valign="top" bgcolor="#FEE19D"><?=$language['text_regist_email'];?></td>
							<td valign="top" bgcolor="#FDCB84"><?=$rtrmember['m_email'];?></td>
						</tr>
						<tr bgcolor="#FEE19D">
							<td colspan="2" valign="top" bgcolor="#A75D2C">
								<div class="text_head">
									<strong><?=$language['text_regist_dateproduct'];?></strong>
								</div>
							</td>
						</tr>
						<tr>
							<td align="right" valign="top" bgcolor="#FEE19D"><?=$language['text_regist_catalogories'];?> </td>
							<td valign="top" bgcolor="#FDCB84">
								<select name="catalog" id="txtKeyword">
									<option value="0">---เลือกหมวดหมู่---</option>
									<?php 
										$q="SELECT * FROM `auc_catalog_all` WHERE top_id = 0 ORDER BY catalog_id";
										$db->query($q);
										while($db->next_record()){
										  ?>
									<optgroup label="<?=$db->f(catalog_name)?> / <?=$db->f(catalog_name_cn)?>">
										<option value="<?=$db->f(catalog_id)?>" <? if($reauction['reg_catalogid'] == $db->f(catalog_id)){echo "selected";} ?> ><?php echo substr((100+$db->f(catalog_id)),1);?> - <?=$db->f(catalog_name)?></option>
										<?php
											$q1="SELECT * FROM `auc_catalog_all` WHERE top_id = '".$db->f(catalog_id)."' AND catalog_show = 1 ORDER BY catalog_id";
											$db5=new nDB();
											$db5->query($q1);
											if($db5->num_rows()!=0){
											  while($db5->next_record()){
												?>
										<option value="<?=$db5->f(catalog_id)?>" <? if($reauction['reg_catalogid'] == $db5->f(catalog_id)){echo "selected";} ?> ><?php echo substr((100+$db5->f(catalog_id)),1);?> - <?=$db5->f(catalog_name)?></option>
										<?
											}
											}
											?>
									</optgroup>
									<?
										}
										?>
								</select>
							</td>
						</tr>
                        <tr>
                        	<td>
                            <?=$language['Text_SubCatRegular'];?>
                            </td>
                            <td>
                            &nbsp;
                            </td>
                        </tr>
                        <tr>
                            <td valign="top" bgcolor="#FEE19D" colspan="2" style="border:0px; padding:0px">
									<table width="100%" border="0" cellpadding="0" cellspacing="0">
												<tr>
													<td width="232" align="right" valign="top" bgcolor="#FEE19D">
                                                    <?=$language['Text_SubCatRegular'];?>
                                                    </td>
													<td>

														<div class="box-usually">
															<ul>
																<?php
																
																	$result_usually = mysql_fetch_array(mysql_query("SELECT * FROM auction_category_usually WHERE member_id = '".$_SESSION['aucuser_id']."'  "));
																	$qcategory = mysql_query("SELECT * FROM auction_category WHERE catalog_id IN (".$result_usually['catalog_id'].")  ORDER BY catalog_id DESC ");
																	while ( $rcategory_e = mysql_fetch_array($qcategory)) {

																		$text_checked = '';

																		if(isset($_GET['e_product_id'])){

																			$catalog_id = $rcategory_e['catalog_id'];
																			$group_category_id = explode(",", $db5->f(group_category_id));

																			if (in_array($catalog_id, $group_category_id)) {
																				$text_checked = 'checked';
																			}
																		}

																		?>
																<li>
																	<input type="checkbox" name="usually[]" value="<?=$rcategory_e['catalog_id']?>" 
																		<?php echo $text_checked;?>><?=$rcategory_e['catalog_name'.$lang_Rigion]?>
																	<a href="javascript:void(0);" onClick="del_usually(<?=$rcategory_e['catalog_id']?>,$(this));">
																		<?php echo ($lang_Rigion == "")?'นำออก':'拆除';?> 
																	</a>
																</li>
																		<?php
																	}
																?>
															</ul>
														</div>

													</td>
												</tr>
											</table>                            
                            </td>
                        </tr>
						<tr>
							<td align="right" valign="top" bgcolor="#FEE19D"><?=$language['text_regist_objmongol'];?></td>
							<td valign="top" bgcolor="#FDCB84"><input type="text" name="txt_watumongkhol" id="txt_watumongkhol" value="<?=$_GET['e']?$reauction['reg_wattuname']:'';?>"/></td>
						</tr>
						<tr>
							<td align="right" valign="top" bgcolor="#FEE19D"><?=$language['text_regist_onprice'];?></td>
							<td valign="top" bgcolor="#FDCB84"><input type="text" name="txt_openprice" id="txt_openprice" value="<?=$_GET['e']?$reauction['reg_pricestart']:'';?>"/></td>
						</tr>
						<tr>
							<td align="right" valign="top" bgcolor="#FEE19D"><?=$language['text_regist_offprice'];?></td>
							<td valign="top" bgcolor="#FDCB84"><input type="text" name="txt_closeprice" id="txt_closeprice" value="<?=$_GET['e']?$reauction['reg_priceend']:'';?>"/></td>
						</tr>
						<tr>
							<td align="right" valign="top" bgcolor="#FEE19D"><?=$language['text_regist_pricestep'];?></td>
							<td valign="top" bgcolor="#FDCB84"><input type="text" name="price_step" id="price_step" value="<?=$_GET['e']?$reauction['reg_pricestep']:'';?>"/></td>
						</tr>
						<tr>
							<td align="right" valign="top" bgcolor="#FEE19D"><?=$language['text_regist_daystep'];?></td>
							<td valign="top" bgcolor="#FDCB84"> 
								<select name="datestep">
									<option value="1.5" <? if($reauction['reg_day'] == '1.5'){echo "selected";} ?>>1.5</option>
									<option value="2" <? if($reauction['reg_day'] == '2'){echo "selected";} ?>>2</option>
									<option value="3" <? if($reauction['reg_day'] == '3'){echo "selected";} ?>>3</option>
									<option value="4" <? if($reauction['reg_day'] == '4'){echo "selected";} ?>>4</option>
									<option value="5" <? if($reauction['reg_day'] == '5'){echo "selected";} ?>>5</option>
									<option value="6" <? if($reauction['reg_day'] == '6'){echo "selected";} ?>>6</option>
									<option value="7" <? if($reauction['reg_day'] == '7'){echo "selected";} ?>>7</option>
									<option value="8" <? if($reauction['reg_day'] == '8'){echo "selected";} ?>>8</option>
									<option value="9" <? if($reauction['reg_day'] == '9'){echo "selected";} ?>>9</option>
									<option value="10" <? if($reauction['reg_day'] == '10'){echo "selected";} ?>>10</option>
								</select>
								วัน 
							</td>
						</tr>
						<tr>
							<td align="right" valign="top" bgcolor="#FEE19D"><?=$language['text_regist_detail'];?></td>
							<td valign="top" bgcolor="#FDCB84"><textarea name="wattu_detail" id="wattu_detail" cols="45" rows="5"><?=$_GET['e']?$reauction['reg_wattudetail']:'';?></textarea></td>
						</tr>
						<tr>
							<td align="right" valign="top" bgcolor="#FEE19D"><?=$language['text_regist_getmsg'];?></td>
							<td valign="top" bgcolor="#FDCB84"><input type="text" name="txt_message" id="txt_message" value="<?=$_GET['e']?$reauction['reg_pricemessage']:'';?>"/></td>
						</tr>
						<tr>
							<td align="right" valign="top" bgcolor="#FEE19D"><?=$language['text_regist_finan'];?></td>
							<td valign="top" bgcolor="#FDCB84">
								<?php
									$dbcondition = mysql_fetch_array(mysql_query("SELECT * FROM auc_regist WHERE reg_memid = '".$_SESSION['aucuser_id']."' ORDER BY reg_id DESC LIMIT 1"));
								?>
								<table width="100%" border="0" cellpadding="0" cellspacing="0" class="tablebordernone tablecondition">
									<tr>
										<td width="750">
											<label>
												<input name="chk_condition" type="checkbox" id="chk_condition" value="1" <?php if($_GET['e']){if($reauction['reg_chkcondition1'] == 1){echo "checked";}}else{if($dbcondition['reg_chkcondition1'] == 1){echo "checked";}}?>/>
												<?=$language['satisfaction_guaranteed_within'];?>
											</label>
											<input type="text" name="txt_condition" id="txt_condition" style="width:30px" value="<?=$_GET['e']?$reauction['reg_condition1']:$dbcondition['reg_condition1'];?>"/>
											<?=$language['text_day'];?>
										</td>
									</tr>
									<tr>
										<td style="line-height: 32px;">
											<label>
												<input type="checkbox" name="chk_condition2" id="chk_condition2" value="1" <?php if($_GET['e']){if($reauction['reg_chkcondition2'] == 1){echo "checked";}}else{if($dbcondition['reg_chkcondition2'] == 1){echo "checked";}}?>/>
												<?=$language['satisfaction_guaranteed_within_originpra'];?>
											</label>
											<input type="text" name="txt_condition2" id="txt_condition2" style="width:30px" value="<?=$_GET['e']?$reauction['reg_condition2']:$dbcondition['reg_condition2'];?>"/>
											<?=$language['satisfaction_guaranteed_within_originpra'];?>
											<?=$language['text_day'];?> <?=$language['from_the_date_you_receive'];?>
											<br>
											&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$language['If_the_refund_amount_is_less_spurious_percent'];?> 
										</td>
									</tr>
									<tr>
										<td style="line-height: 32px;">
											<label>
												<input name="chk_condition3" type="checkbox" id="chk_condition3" value="1" <?php if($_GET['e']){if($reauction['reg_chkcondition3'] == 1){echo "checked";}}else{if($dbcondition['reg_chkcondition3'] == 1){echo "checked";}}?>/>
												<?=$language['the_original_warranty_period'];?>
											</label>
											<input type="text" name="txt_condition3" id="txt_condition3" style="width:30px" value="<?=$_GET['e']?$reauction['reg_condition3']:$dbcondition['reg_condition3'];?>"/>
											<?=$language['text_day'];?> <?=$language['from_the_date_you_receive'];?>
											<br>
											&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$language['text_regist_kaehcondition'];?> <?=$language['text_lak'];?>
											</label>
											<input type="text" name="txt_condition4" id="txt_condition4" style="width:30px" value="<?=$_GET['e']?$reauction['reg_condition4']:$dbcondition['reg_condition4'];?>"/>
											<?=$language['text_regist_persen'];?>
										</td>
									</tr>
									<tr>
										<td>
											<label>
												<input name="chk_condition4" type="checkbox" id="chk_condition4" value="1" <?php if($_GET['e']){if($reauction['reg_chkcondition4'] == 1){echo "checked";}}else{if($dbcondition['reg_chkcondition4'] == 1){echo "checked";}}?> />
												<?=$language['text_regist_pricenowmarket'];?>
											</label>
										</td>
									</tr>
								</table>
							</td>
						</tr>
						<tr>
							<td align="right" valign="top" bgcolor="#FEE19D"><?=$language['text_regist_finanother'];?></td>
							<td valign="top" bgcolor="#FDCB84"><input type="text" name="txt_othercondition" id="txt_othercondition" value="<?=$_GET['e']?$reauction['reg_othercondition']:$dbcondition['reg_othercondition'];?>" /></td>
						</tr>
						<tr>
							<td align="right" valign="top" bgcolor="#FEE19D"><?=$language['text_regist_onmoney'];?></td>
							<td valign="top" bgcolor="#FDCB84">
								<input type="text" name="txt_monyonline" id="txt_monyonline" value="<?=$_GET['e']?$reauction['reg_onlinedetail']:$dbcondition['reg_onlinedetail'];?>"/>
								<?=$language['text_regist_onmoney_moneyday'];?>
							</td>
						</tr>
						<tr bgcolor="#FEE19D">
							<td colspan="2" valign="top" bgcolor="#A75D2C">
								<div class="text_head">
									<strong><?=$language['text_regist_payment'];?></strong>
									<?php
									$dbpayment = mysql_fetch_array(mysql_query("SELECT * FROM auc_member WHERE m_id = '".$_SESSION['aucuser_id']."'"));
									?>
								</div>
							</td>
						</tr>
						<tr>
							<td align="right" valign="top" bgcolor="#FEE19D"><?=$language['text_regist_account'];?></td>
							<td valign="top" bgcolor="#FDCB84"><input type="text" name="txt_account_name" id="txt_account_name" value="<?=$_GET['e']?$reauction['reg_accountname']:$dbpayment['m_account'];?>"/></td>
						</tr>
						<tr>
							<td align="right" valign="top" bgcolor="#FEE19D"><?=$language['text_regist_bank'];?></td>
							<td valign="top" bgcolor="#FDCB84"><input type="text" name="txt_bankname" id="txt_bankname" value="<?=$_GET['e']?$reauction['reg_bankname']:$dbpayment['m_bank'];?>"/></td>
						</tr>
						<tr>
							<td align="right" valign="top" bgcolor="#FEE19D"><?=$language['text_regist_noaccount'];?></td>
							<td valign="top" bgcolor="#FDCB84"><input type="text" name="txt_accountno" id="txt_accountno" value="<?=$_GET['e']?$reauction['reg_noaccount']:$dbpayment['m_bankno'];?>" /></td>
						</tr>
						<tr>
							<td align="right" valign="top" bgcolor="#FEE19D"><?=$language['text_regist_bankoffset'];?></td>
							<td valign="top" bgcolor="#FDCB84"><input type="text" name="txt_subaccount" id="txt_subaccount" value="<?=$_GET['e']?$reauction['reg_subaccount']:$dbpayment['m_bankoffset'];?>"/></td>
						</tr>
						<tr>
							<td align="right" valign="top" bgcolor="#FEE19D"><?=$language['text_regist_banktype'];?></td>
							<td valign="top" bgcolor="#FDCB84">
								<input type="radio" value="1" id="account_type1" name="txt_banktype" <?php if($_GET['e']){if($reauction['reg_banktype'] == 1){echo "checked";}}else{if($dbpayment['m_banktype'] == 1){echo "checked";}}?> /> ออมทรัพย์ 
								<input type="radio" value="2" id="account_type1" name="txt_banktype" <?php if($_GET['e']){if($reauction['reg_banktype'] == 1){echo "checked";}}else{if($dbpayment['m_banktype'] == 1){echo "checked";}}?> /> กระแสรายวัน
							</td>
						</tr>
						<tr bgcolor="#FEE19D">
							<td colspan="2" valign="top" bgcolor="#A75D2C">
								<div class="text_head">
									<strong><?=$language['text_regist_detailimage'];?></strong>
								</div>
							</td>
						</tr>
						<tr>
							<td align="right" valign="top" bgcolor="#FEE19D"><?=$language['text_regist_attachment'];?></td>
							<td valign="top" bgcolor="#FDCB84">
								<table width="200" border="0" class="tablebordernone">
									<tr>
										<td>
											<input type="file" name="file[]" />
											<input type="hidden" name="file_hid[]" value="<?=$_GET['e']?$reauction['reg_file0']:'';?>">
										</td>
									</tr>
									<tr>
										<td>
											<input type="file" name="file[]" />
											<input type="hidden" name="file_hid[]" value="<?=$_GET['e']?$reauction['reg_file1']:'';?>">
										</td>
									</tr>
									<tr>
										<td>
											<input type="file" name="file[]" />
											<input type="hidden" name="file_hid[]" value="<?=$_GET['e']?$reauction['reg_file2']:'';?>">
										</td>
									</tr>
								</table>
							</td>
						</tr>
						<tr>
							<td colspan="2" align="center" valign="top" bgcolor="#FBE88A">
								<?
								if(!isset($_GET['e'])){
									?>
								<p>
									<label>
									<input type="radio" name="rdo_accept" id="rdo_accept1" value="1" onclick='$("input[name=btnSubmit]").prop("disabled", false);' />
									<?=$language['text_regist_accept'];?></label>
									<label>
									<input type="radio" name="rdo_accept" id="rdo_accept2" value="2" onclick='$("input[name=btnSubmit]").prop("disabled", true);' checked="checked"/>
									<?=$language['text_regist_nonaccept'];?></label>
								</p>
									<?
								}
								?>
								<input type="hidden" name="do_what" value="<?=$_GET['e']?'edit_to_db':'insert_to_db';?>">
								<input type="hidden" name="repost" value="<?=$_GET['repost']?>">
								<input type="submit" name="btnSubmit" id="btnSubmit" value="ตกลง" <?=$_GET['e']?'':'disabled';?>/>
								<input type="reset" name="btnreset" id="btnreset" value="ยกเลิก" />
								<p>&nbsp;</p>
							</td>
						</tr>
					</table>
				</form>
			</div>
				<?
			}
			?>
		</div>
		<?php
			include('footer.php');
			?>
	</div>
	<script type="text/javascript">
		function frmSubmit(){	
			var isFormValid = true;

			$('#frmauc_regist input[type="text"],#frmauc_regist select').each(function(){
				if($(this).is("input")){
					if ($.trim($(this).val()).length == 0){
						$(this).parent().prev().css({color:"red"});
						isFormValid = false;
					}
					else{
						$(this).parent().prev().css({color:"black"});
					}
				}
				if($(this).is("select")){
					if ($.trim($(this).val()) == ""){
						$(this).parent().prev().css({color:"red"});
						isFormValid = false;
					}
					else{
						$(this).parent().prev().css({color:"black"});
					}
				} 
			});

			if (!isFormValid) alert(" กรุณากรอกข้อมูลให้ครบถ้วนด้วยครับ !!");
			return isFormValid;
		}
	</script>
</body>
</html>