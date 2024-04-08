<?php
	include('head.php');

	$do_what = $_POST['do_what'];
	if( $do_what == "insert_to_db"){
		if($_POST['datestep']=='1.5'){
			$dateval = date("Y-m-d H:i:s",time()+(60*(60+30)*24*1));
		}else{
			$dateval = date("Y-m-d H:i:s",time()+(60*60*24*$_POST['datestep'])); // Plus Date 5 day
		}
		$sql_auction =	"insert into `auc_regist` 
					(
						`reg_id`, 
						`reg_memname`, 
						`reg_actmessage`, 
						`reg_address`, 
						`reg_country`, 
						`reg_telephone`, 
						`reg_email`, 
						`reg_wattuname`,
						`reg_catalogid`,
						`reg_wattudetail`, 
						`reg_pricestart`, 
						`reg_priceend`, 
						`reg_pricestep`,
						`reg_dateregist`,
						`reg_dateexpire`,
						`reg_pricemessage`, 
						`reg_chkcondition1`,
						`reg_chkcondition2`,
						`reg_chkcondition3`,
						`reg_chkcondition4`,
						`reg_condition1`, 
						`reg_condition2`,
						`reg_condition3`,
						`reg_condition4`,
						`reg_othercondition`,
						`reg_onlinedetail`,
						`reg_accountname`,
						`reg_bankname`,
						`reg_noaccount`,
						`reg_subaccount`,
						`reg_created`,
						`reg_updated`,
						`reg_memid`
					) values (
						NULL, 
						'".$_POST['txt_action']."', 
						'".$_POST['rdo_comment']."', 
						'".$_POST['txt_address']."', 
						'".$_POST['txt_country']."', 
						'".$_POST['txt_telephone']."', 
						'".$_POST['txt_email']."', 
						'".$_POST['txt_watumongkhol']."',
						'".$_POST['catalog']."', 
						'".$_POST['wattu_detail']."', 
						'".$_POST['txt_openprice']."', 
						'".$_POST['txt_closeprice']."', 
						'".$_POST['price_step']."',
						'".date("Y-m-d H:i:s")."', 
						'".$dateval."',
						'".$_POST['txt_message']."', 
						'".$_POST['chk_condition']."', 
						'".$_POST['chk_condition2']."', 
						'".$_POST['chk_condition3']."', 
						'".$_POST['chk_condition4']."', 
						'".$_POST['txt_condition']."', 
						'".$_POST['txt_condition2']."', 
						'".$_POST['txt_condition3']."', 
						'".$_POST['txt_condition4']."', 
						'".$_POST['txt_othercondition']."', 
						'".$_POST['txt_monyonline']."', 
						'".$_POST['txt_account_name']."', 
						'".$_POST['txt_bankname']."',
						'".$_POST['txt_accountno']."',
						'".$_POST['txt_subaccount']."',
						'".date("Y-m-d H:i:s")."', 
						'".date("Y-m-d H:i:s")."',
						'".$_SESSION['aucuser_id']."'
					)
				";
		$q_auction = mysql_query($sql_auction);
		if($q_auction){
			$result = mysql_fetch_array(mysql_query("select * from auc_regist order by reg_id desc limit 1"));
			$reg_id = $result['reg_id'];
			for($i=0;$i<count($_FILES["file"]["name"]);$i++){
				$filepart = $_FILES["file"]["tmp_name"][$i];
				$filename = $_FILES["file"]["name"][$i];
				if(trim($_FILES["file"]["name"][$i] != "")){
					$fileextension = end(explode(".",$filename));
					$filename = time().$i.$fileextension;
					copy($filepart,"fileupload/".$filename);
					
					mysql_query("update auc_regist set reg_file$i = '$filename' where reg_id ='".$reg_id."'");
				}
			}
			echo "<script>alert('".$language['text_savedata_complete']."');</script>";
			echo"<meta http-equiv='refresh' content='0;url=list_data.php'>";
		}
	}
	?>
<body>
	<div id="wrapper">
		<?php
			include('header.php');
			?>
		<div id="container">
			<div class="box_content">
				<style type="text/css">
					.showdata{
						border-collapse: collapse;
					}
					.showdata td{
						padding: 2px 6px 0 2px;
					}
					.tableaucregist tr td{
						border: 1px solid #814A00;
					}
					.tablebordernone tr td{
						border: 0px;
					}
					.tablecondition tr td{
							border-bottom: 1px solid #F89A1B;
					}
					.text_head{
						margin-left: 4px;
						line-height: 24px;
					}
				</style>
				<form action="" method="post" name="frmauc_regist" id="frmauc_regist" enctype="multipart/form-data" name="auctionform" style="margin: 0;">
					<table width="1000" border="0" align="center" cellpadding="0" cellspacing="0" class="showdata tableaucregist">
						<tr>
							<td height="33" colspan="2" align="center" bgcolor="#603C18"><font color="#FFFFFF">
								<strong><?=$language['text_welcomto_aucregist'];?></strong></font>
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
							<td width="752" valign="top" bgcolor="#FDCB84"><input type="text" name="txt_action" id="txt_action" value="พระหาดใหญ่"/></td>
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
											<input type="radio" name="rdo_comment" id="rdo_comment" value="1" />
											<?=$language['text_regist_getmailauction'];?></label>
										</td>
									</tr>
									<tr>
										<td><label>
											<input name="rdo_comment" type="radio" id="rdo_comment2" value="0" checked="checked" />
											<?=$language['text_regist_nongetmailauction'];?></label>
										</td>
									</tr>
								</table>
							</td>
						</tr>
						<tr>
							<td align="right" valign="top" bgcolor="#FEE19D"><?=$language['text_regist_address'];?></td>
							<td valign="top" bgcolor="#FDCB84"><input type="text" name="txt_address" id="txt_address" /></td>
						</tr>
						<tr>
							<td align="right" valign="top" bgcolor="#FEE19D"><?=$language['text_regist_country'];?></td>
							<td valign="top" bgcolor="#FDCB84"><input type="text" name="txt_country" id="txt_country" /></td>
						</tr>
						<tr>
							<td align="right" valign="top" bgcolor="#FEE19D"><?=$language['text_regist_phone'];?></td>
							<td valign="top" bgcolor="#FDCB84"><input type="text" name="txt_telephone" id="txt_telephone" /></td>
						</tr>
						<tr>
							<td align="right" valign="top" bgcolor="#FEE19D"><?=$language['text_regist_email'];?></td>
							<td valign="top" bgcolor="#FDCB84"><input type="text" name="txt_email" id="txt_email" /></td>
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
										$q="SELECT * FROM `catalog_all` WHERE top_id = 0 ORDER BY catalog_id";
										$db->query($q);
										while($db->next_record()){
										  ?>
									<optgroup label="<?=$db->f(catalog_name)?> / <?=$db->f(catalog_name_cn)?>">
										<?php
											$q1="SELECT * FROM `catalog_all` WHERE top_id = '".$db->f(catalog_id)."' ORDER BY catalog_id";
											$db5=new nDB();
											$db5->query($q1);
											if($db5->num_rows()!=0){
											  while($db5->next_record()){
												?>
										<option value="<?=$db5->f(catalog_id)?>"><?=$db5->f(catalog_name)?></option>
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
							<td align="right" valign="top" bgcolor="#FEE19D"><?=$language['text_regist_objmongol'];?></td>
							<td valign="top" bgcolor="#FDCB84"><input type="text" name="txt_watumongkhol" id="txt_watumongkhol" /></td>
						</tr>
						<tr>
							<td align="right" valign="top" bgcolor="#FEE19D"><?=$language['text_regist_onprice'];?></td>
							<td valign="top" bgcolor="#FDCB84"><input type="text" name="txt_openprice" id="txt_openprice" /></td>
						</tr>
						<tr>
							<td align="right" valign="top" bgcolor="#FEE19D"><?=$language['text_regist_offprice'];?></td>
							<td valign="top" bgcolor="#FDCB84"><input type="text" name="txt_closeprice" id="txt_closeprice" /></td>
						</tr>
						<tr>
							<td align="right" valign="top" bgcolor="#FEE19D"><?=$language['text_regist_pricestep'];?></td>
							<td valign="top" bgcolor="#FDCB84"><input type="text" name="price_step" id="price_step" /></td>
						</tr>
						<tr>
							<td align="right" valign="top" bgcolor="#FEE19D"><?=$language['text_regist_daystep'];?></td>
							<td valign="top" bgcolor="#FDCB84">
								<select name="datestep">
									<option value="1.5">1.5</option>
									<option value="2">2</option>
									<option value="3">3</option>
									<option value="4">4</option>
									<option value="5">5</option>
									<option value="6">6</option>
									<option value="7">7</option>
									<option value="8">8</option>
									<option value="9">9</option>
									<option value="10">10</option>
								</select>
								วัน 
							</td>
						</tr>
						<tr>
							<td align="right" valign="top" bgcolor="#FEE19D"><?=$language['text_regist_detail'];?></td>
							<td valign="top" bgcolor="#FDCB84"><textarea name="wattu_detail" id="wattu_detail" cols="45" rows="5"></textarea></td>
						</tr>
						<tr>
							<td align="right" valign="top" bgcolor="#FEE19D"><?=$language['text_regist_getmsg'];?></td>
							<td valign="top" bgcolor="#FDCB84"><input type="text" name="txt_message" id="txt_message" /></td>
						</tr>
						<tr>
							<td align="right" valign="top" bgcolor="#FEE19D"><?=$language['text_regist_finan'];?></td>
							<td valign="top" bgcolor="#FDCB84">
								<table width="100%" border="0" cellpadding="0" cellspacing="0" class="tablebordernone tablecondition">
									<tr>
										<td width="750">
											<label>
												<input name="chk_condition" type="checkbox" id="chk_condition" value="1" />
												<?=$language['satisfaction_guaranteed_within'];?>
											</label>
											<input type="text" name="txt_condition" id="txt_condition" style="width:30px"/>
											<?=$language['text_day'];?>
										</td>
									</tr>
									<tr>
										<td style="line-height: 32px;">
											<label>
												<input type="checkbox" name="chk_condition2" id="chk_condition2" value="1" />
												<?=$language['satisfaction_guaranteed_within_originpra'];?>
											</label>
											<input type="text" name="txt_condition2" id="txt_condition2" style="width:30px"/>
											<?=$language['satisfaction_guaranteed_within_originpra'];?>
											<?=$language['text_day'];?> <?=$language['from_the_date_you_receive'];?>
											<br>
											&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$language['If_the_refund_amount_is_less_spurious_percent'];?> 
										</td>
									</tr>
									<tr>
										<td style="line-height: 32px;">
											<label>
												<input name="chk_condition3" type="checkbox" id="chk_condition3" value="1" />
												<?=$language['the_original_warranty_period'];?>
											</label>
											<input type="text" name="txt_condition3" id="txt_condition3" style="width:30px"/>
											<?=$language['text_day'];?> <?=$language['from_the_date_you_receive'];?>
											<br>
											&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$language['text_regist_kaehcondition'];?> <?=$language['text_lak'];?>
											</label>
											<input type="text" name="txt_condition4" id="txt_condition4" style="width:30px" />
											<?=$language['text_regist_persen'];?>
										</td>
									</tr>
									<tr>
										<td>
											<label>
												<input name="chk_condition4" type="checkbox" id="chk_condition4" value="1" />
												<?=$language['text_regist_pricenowmarket'];?>
											</label>
										</td>
									</tr>
								</table>
							</td>
						</tr>
						<tr>
							<td align="right" valign="top" bgcolor="#FEE19D"><?=$language['text_regist_finanother'];?></td>
							<td valign="top" bgcolor="#FDCB84"><input type="text" name="txt_othercondition" id="txt_othercondition" /></td>
						</tr>
						<tr>
							<td align="right" valign="top" bgcolor="#FEE19D"><?=$language['text_regist_onmoney'];?></td>
							<td valign="top" bgcolor="#FDCB84"><input type="text" name="txt_monyonline" id="txt_monyonline" />
								<?=$language['text_regist_onmoney_moneyday'];?>
							</td>
						</tr>
						<tr bgcolor="#FEE19D">
							<td colspan="2" valign="top" bgcolor="#A75D2C">
								<div class="text_head">
									<strong><?=$language['text_regist_payment'];?></strong>
								</div>
							</td>
						</tr>
						<tr>
							<td align="right" valign="top" bgcolor="#FEE19D"><?=$language['text_regist_account'];?></td>
							<td valign="top" bgcolor="#FDCB84"><input type="text" name="txt_account_name" id="txt_account_name" /></td>
						</tr>
						<tr>
							<td align="right" valign="top" bgcolor="#FEE19D"><?=$language['text_regist_bank'];?></td>
							<td valign="top" bgcolor="#FDCB84"><input type="text" name="txt_bankname" id="txt_bankname" /></td>
						</tr>
						<tr>
							<td align="right" valign="top" bgcolor="#FEE19D"><?=$language['text_regist_noaccount'];?></td>
							<td valign="top" bgcolor="#FDCB84"><input type="text" name="txt_accountno" id="txt_accountno" /></td>
						</tr>
						<tr>
							<td align="right" valign="top" bgcolor="#FEE19D"><?=$language['text_regist_bankoffset'];?></td>
							<td valign="top" bgcolor="#FDCB84"><input type="text" name="txt_subaccount" id="txt_subaccount" /></td>
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
										<td><input type="file" name="file[]" /></td>
									</tr>
									<tr>
										<td><input type="file" name="file[]" /></td>
									</tr>
									<tr>
										<td><input type="file" name="file[]" /></td>
									</tr>
								</table>
							</td>
						</tr>
						<tr>
							<td colspan="2" align="center" valign="top" bgcolor="#FBE88A">
								<p>
									<label>
									<input type="radio" name="rdo_accept" id="rdo_accept1" value="1" onClick="chaccept(this.value)"/>
									<?=$language['text_regist_accept'];?></label>
									<label>
									<input type="radio" name="rdo_accept" id="rdo_accept2" value="2" onClick="chaccept(this.value)" checked="checked"/>
									<?=$language['text_regist_nonaccept'];?></label>
								</p>
								<input type="hidden" name="do_what" value="insert_to_db">
								<input type="submit" name="btnSubmit" id="btnSubmit" value="ตกลง" />
								<input type="reset" name="btnreset" id="btnreset" value="ยกเลิก" />
								<p>&nbsp;</p>
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
</body>
</html>