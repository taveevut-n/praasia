<?php
	include('../global.php');

	include('head.php');
	include('config/function.php');

	$do_what = $_POST['do_what'];
	if( $do_what == "put_price"){
		$sqlu_auc_reply = "insert into `auc_reply` 
									(	`rep_id`, 
										`rep_priceoffer`,
										`rep_created` ,
										`rep_memid`, 
										`rep_aucid`
									) values (
										NULL, 
										'".$_POST['txtauction']."',
										'".date("Y-m-d H:i:s")."',
										'".$_SESSION['aucuser_id']."', 
										'".$_GET['id']."'
									)
								";
		$qu_auc_reply = mysql_query($sqlu_auc_reply);
		if($qu_auc_reply){
			mysql_query("update auc_regist set reg_reply = reg_reply+1 where reg_id = '".$_GET['id']."'");
			header("location:view.php?id=".$_GET['id']);
		}
	}
	
	$sql_auction = "select * from auc_regist art 
							inner join auc_member m on art.reg_memid = m.m_id
						where  art.reg_id='".$_GET['id']."'";
	$r_auction = mysql_fetch_array(mysql_query($sql_auction));

	## view update
	if($r_auction['reg_memid'] != $_SESSION['aucuser_id']){
		mysql_query("update auc_regist set reg_view = reg_view+1 where reg_id = '".$_GET['id']."'");
	} 

	$r_aucreply_now = mysql_fetch_array(mysql_query("select * from auc_reply where rep_aucid = '".$_GET['id']."' order by rep_id desc"));
	?>
<body>
	<div id="wrapper">
		<?php
			include('header.php');
			?>
		<div id="container">
			<div class="box_content">
					<table width="1000px" border="0" align="center" cellpadding="0" cellspacing="0" class="condition_tb_textjustify">
						<tr>
							<td bgcolor="#4A1701" class="head_contain" style="padding-left: 11px;text-align:left;">
								<?php
									$strcatalog="select * from catalog_all c 
											inner join auc_regist ac  on c.catalog_id=ac.reg_catalogid
										where  c.catalog_id =  '".$_GET['id']."'";
									$r_catalog = mysql_fetch_array(mysql_query($strcatalog));
								?>
								<span class="text_yellpw"><b><?=$language['text_auction_bord'];?></b> <?=$r_catalog['catalog_name'];?></span>
							</td>
						</tr>
						<tr bgcolor="#A65D2C">
							<td bgcolor="#A65D2C" class="texthead" align="center" style="color:#fff;">
								<b>ชื่อพระ : <?=$r_auction['reg_wattuname']?></b>
							</td>
						</tr>
						<tr bgcolor="#231F20" align="center">
							<td bgcolor="#231F20">
								<?
									if($r_auction['reg_file0'] <> ""){
									?>
										<p><img src="fileupload/<?=$r_auction['reg_file0']?>" width="900"/></p>
									<?
									}
									if($r_auction['reg_file1'] <> ""){
									?>
										<p><img src="fileupload/<?=$r_auction['reg_file1']?>" width="900"/></p>
									<?
									}
									if($r_auction['reg_file2'] <> ""){
									?>
										<p><img src="fileupload/<?=$r_auction['reg_file2']?>" width="900"/></p>
									<?
									}
								?>
							</td>
						</tr>
						<?php
							$rauction = mysql_fetch_array(mysql_query("select * from auc_regist where reg_id = '".$_GET['id']."' "));
							if($rauction['reg_memid'] == $_SESSION['aucuser_id']){
								?>
						<tr>
							<td bgcolor="#A65D2C">
								</br>
								<form id="form1" name="form1" method="post" action="view_query.php" enctype="multipart/form-data" target="reg_frm">
									<iframe src="" name="reg_frm" width="1px" height="0px" frameborder="0" id="reg_frm"></iframe>
									<table border="0" align="center" cellpadding="0" cellspacing="0" class="tb_data">
										<?
										$qexpend = mysql_query("select * from auc_axpend where exp_aucid = '".$_GET['id']."' ");
										$numexpend = mysql_num_rows($qexpend);
										$count_result = (3-$numexpend);
										for ($i=1; $i <= $count_result; $i++) { 
											?>
										<tr>
											<td width="90px" align="right" valign="top" bgcolor="#FEE09B">ภาพที่ <?=$i?></td>
											<td valign="top" bgcolor="#FDCB84">
												<input type="file" name="fileImg[]">
											</td>
										</tr>
											<?
										}
										if($count_result > 0){
										?>
										<tr>
											<td valign="top" bgcolor="#FEE09B" align="center" colspan="2">
												<input type="hidden" name="do_what" value="perfile">
												<input type="hidden"  name="auction_id" value="<?=$_GET['id']?>">
												<input type="submit" name="btnUpload" value="ตกลง">
												<input type="reset" name="btnUpload" value="ยกเลิก">
											</td>
										</tr>
										<?
										}
										?>
									</table>
								</form>
							</td>
						</tr>
								<?
							}
						?>
						<tr>
							<td bgcolor="#231F20" align="center" style="padding:0px 0 17px 0px">
								<style type="text/css">
									.tb_vode{
										background: transparent;
										border-radius: 8px;
									}
									.tb_vode td{
										color: #eee
									}
								</style>
								<?
								// $rcomment = mysql_fetch_array(mysql_query("select * from auc_comment where "));
								?>
								<table width="400" border="0" cellpadding="0" cellspacing="0" class="tb_vode">
									<tr>
										<td colspan="2" align="center">
											<b>รายงานผลโหวต</b>
										</td>
									</tr>
									<tr>
										<td width="180" align="right">
											จากรูปพระแท้
										</td>
										<td align="right">
											0%
										</td>
									</tr>
									<tr>
										<td align="right">
											จากรูปพระแท้แต่ข้อมูลไม่ถูกต้อง
										</td>
										<td align="right">
											0%
										</td>
									</tr>
									<tr>
										<td align="right">
											จากรูปพระเก๊
										</td>
										<td align="right">
											0%
										</td>
									</tr>
									<tr>
										<td align="right">
											พระดูยากจากรูป
										</td>
										<td align="right">
											0%
										</td>
									</tr>
								</table>
							</td>
						</tr>
						<tr>
							<td bgcolor="#A65D2C">
								<style type="text/css">
									.tb_data{
										border-collapse: collapse;
									}
									.tb_data td{
										border: 1px rgb(204, 106, 52) solid;
										padding-left: 4px;
										padding-right: 6px;
									}
								</style>
							  <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="tb_data">
									<tr>
										<td width="314" align="right" valign="top" bgcolor="#FEE09B">ชื่อพระที่ต้องการส่งเข้าประมูล</td>
										<td width="646" valign="top" bgcolor="#FDCB84"><?=$r_auction['reg_wattuname']?></td>
									</tr>
									<tr>
										<td align="right" valign="top" bgcolor="#FEE09B">อธิบายเพิ่มเติม</td>
										<td valign="top" bgcolor="#FDCB84"><?=$r_auction['reg_wattudetail']?></td>
									</tr>
									<tr>
										<td align="right" valign="top" bgcolor="#FEE09B">เงื่อนไขการรับประกัน</td>
										<td valign="top" bgcolor="#FDCB84">
										<?php
											if($r_auction['reg_chkcondition1']==1){
												echo "*** รับประกันความพอใจ ภายในระยะเวลา ".$r_auction['reg_condition1']." วัน<br/>";
											}
											if($r_auction['reg_chkcondition2']==1){
												echo "*** รับประกันพระแท้ภายในระยะเวลา ".$r_auction['reg_condition2']." วัน นับตั้งแต่วันที่ท่านได้รับพระ หากเก๊ยินดีคืนเงินจำนวนไม่หักเปอร์เซ็นต์<br/>";
											}
											if($r_auction['reg_chkcondition3']==1){
												echo "*** รับประกันพระแท้ภายในระยะเวลา ".$r_auction['reg_condition3']." วัน นับตั้งแต่วันที่ท่านได้รับพระ หากเก๊หรือมีปัญหาภายหลังหรือเกินกำหนดเวลารับประกัน หัก ".$r_auction['reg_condition4']." เปอร์เซ็น<br/>";
											}
											if($r_auction['reg_chkcondition4']==1){
												echo "*** รับซื้อคืนในราคาตลาดขณะนั้น<br/>";
											}
										?>
										</td>
									</tr>
									<tr>
										<td align="right" valign="top" bgcolor="#FEE09B">เงื่อนไขการรับประกัน เพิ่มเติม</td>
										<td valign="top" bgcolor="#FDCB84"><?=$r_auction['reg_othercondition']?></td>
									</tr>
									<tr>
										<td align="right" valign="top" bgcolor="#FEE09B">ราคาเปิดประมูล</td>
										<td valign="top" bgcolor="#FDCB84"><?=number_format($r_auction['reg_pricestart'])?></td>
									</tr>
									<tr>
										<td align="right" valign="top" bgcolor="#FEE09B">ราคาสูงสุดขณะนี้</td>
										<td valign="top" bgcolor="#FDCB84">
											<?
											echo number_format($r_aucreply_now['rep_priceoffer']);
											if($r_auction['reg_priceend'] > $r_aucreply_now['rep_priceoffer']){
												?>
											(ยังไม่ถึงราคาขั้นต่ำ)
												<?
											}else{
												?>
											(ถึงราคาขั้นต่ำแล้ว)
												<?
											}
											?>
										</td>
									</tr>
									<tr>
										<td align="right" valign="top" bgcolor="#FEE09B">ราคาต้องเพิ่มขึ้นขั้นต่ำ</td>
										<td valign="top" bgcolor="#FDCB84"><?=number_format($r_auction['reg_pricestep'])?></td>
									</tr>
									<tr>
										<td align="right" valign="top" bgcolor="#FEE09B">เวลาเปิดประมูล</td>
										<td valign="top" bgcolor="#FDCB84">
											<?
										$date_1=strtotime($r_auction['reg_dateregist']); 
										echo thai_date($date_1);
											?>
										</td>
									</tr>
									<tr>
										<td align="right" valign="top" bgcolor="#FEE09B">เวลาปิดประมูล</td>
										<td valign="top" bgcolor="#FDCB84">
											<?
										$date_2=strtotime($r_auction['reg_dateexpire']); 
										echo thai_date($date_2);

										$age_life = ($date_2-time());
										if($age_life > 0){
											echo ' <b>(เหลือเวลา '.intval((date("d",$age_life))).' วัน '.date("H",$age_life).' ชม. '.date("i",$age_life).' นาที)</b>';
										}else{
											echo ' <b>(!!! ปิดประมูลแล้ว !!!)<b>';
										}
											?>
										</td>
									</tr>
                                    <tr>
                                    	<td height="5"></td>
                                    </tr>
                                    <tr>
                                    <td colspan="2">
									<?php
                                        if ($_GET['id']) {
                                            $_SESSION['product_id']=$_GET['id']; 
                                            $product_id = $_SESSION['product_id'];
                                        }
                                        $q="SELECT * FROM `auc_regist` WHERE reg_id ='".$_SESSION['product_id']."' ";
                                        $dbproduct= new nDB(); 
                                        $dbproduct->query($q);
                                        $dbproduct->next_record();
                                        $num_rows = $dbproduct->num_rows();
                                        $q="SELECT * FROM `auc_member` WHERE m_id= '".$dbproduct->f(reg_memid)."' ";
                                        $dbshop= new nDB();  
                                        $dbshop->query($q);
                                        $dbshop->next_record();
                                        $timestamp = strtotime($dbshop->f(reg_create));
                                        $timestampexpire = $dbshop->f(date_expire);
                                        $timestampextend = $dbshop->f(reg_update);    
                                        $arrival = strtotime($dbshop->f(reg_create));
                                        $_SESSION['shop_id'] = $dbshop->f(id);
										$productscore = $dbproduct->f(score);
                                        ?>                                    
                                      </td>
                                    </tr>
                                    	
								<tr>
										<td align="right" valign="top" bgcolor="#FEE09B">ผู้ตั้งประมูล</td>
										<td valign="top" bgcolor="#FDCB84"><?=$r_auction['m_name'].' '.$r_auction['m_surname']?></td>
									</tr>
								</table>
							</td>
						</tr>
						<tr bgcolor="#231F20" align="center">
							<style type="text/css">
								.tableexpenother{
									border-collapse: collapse;
								}
								.tableexpenother td{
									color: #eee;
									font-weight: bold
								}
							</style>
							<td bgcolor="#231F20">
								<?php
									$i = 0;
									$qexpend = mysql_query("select * from auc_axpend where exp_aucid = '".$_GET['id']."' ");
									while ($rexpen = mysql_fetch_array($qexpend)) {
										$l++;
										?>
									<table width="100%" border="1" cellpadding="0" align="center" cellspacing="0" class="tableexpenother">
										<tr>
											<td>
												<table width="100%" border="0" cellpadding="0" align="center" cellspacing="0">
													<tr style="background: rgb(187, 164, 45);">
														<td align="left">ข้อมูลเพิ่มเติม <?=$l?></td>
														<td align="right">
															<? 
															$date_3=strtotime($rexpen['exp_created']); 
															echo thai_date($date_3);
															?>
														</td>
													</tr>
												</table>
											</td>
										</tr>
										<tr>
											<td align="center">
												<p><img src="fileupload/<?=$rexpen['exp_file']?>" width="900"/></p>
											</td>
										</tr>
									</table>
										<?
									}
								?>
							</td>
						</tr>
						<tr>
							<td bgcolor="#111111">
<table width="100%" cellpadding="3" cellspacing="0" border="0">
                                                        <tr>
                                                            <td height="30" bgcolor="#3d2000" style="text-align:center;"><span style="color:#FF0">โหวต / 评论 :
                                                            <?=$dbproduct->f(reg_wattuname)?>
                                                            )</span>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td bgcolor="#111111">
                                                            <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
                                                                <tr>
                                                                    <td height="25" align="center"><span style="color:#FC0; font-size:14px">รายงานผลโหวตพระนี้ / 投票系統佛牌真-假区</span></td>
                                                                </tr>
                                                                <tr>
                                                                    <td align="center" style="padding:5px"><span style="color:#FFF"> ระบบโหวตนี้จะแสดงผลโหวตและเหตุผลที่โหวตเท่านั้น สำหรับข้อมูลผู้โหวตทางทีมงานได้มีการบันทึกไว้ เพื่อป้องกันผู้ที่มาช่วยดูพระให้ หากมีการโหวตว่าเก๊จนพระเครื่องนี้<br>
                                                                        มีคะแนนไม่ถึง 0% ระบบจะทำการลบสินค้านี้ทันที แต่หากผู้ที่โหวตมั่ว ๆ จะมีการตรวจสอบและหากมีเจตนาที่ไม่ดีจะมีการดำเนินการระงับหรือยกเลิกการเป็นสมาชิกทันที</span>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td align="center" style="padding:5px"><span style="color:#FC0; line-height:20px"> 投票系統佛牌真-假只能展示投票的报告结果和理由 总台中心团队员将会把所有关于员会投票的报告结果和理由记录 为了保护别人知道是哪位会员来帮测看牌和投票<br>
                                                                        如果本尊佛牌被投票假牌度的分数低于 0% 系统将会自动删除掉本尊佛牌 如果是会员乱投票 将被调查,如是故意, 将快被暂时冻洁或是被取消会员权 如果还确定您的佛</span>
                                                                    </td>
                                                                </tr>
                                                                <?
                                                                    if ($_POST['submit']) {
                                                                        if( isset($_POST["vote1"]) ){ 
                                                                            $vote_total += $_POST["vote1"]; 
                                                                        }
                                                                        if( isset($_POST["vote2"]) ){ 
                                                                            $vote_total += $_POST["vote2"]; 
                                                                        }
                                                                        if( isset($_POST["vote3"]) ){ 
                                                                            $vote_total += $_POST["vote3"]; 
                                                                        }
                                                                        if( isset($_POST["vote4"]) ){ 
                                                                            $vote_total += $_POST["vote4"]; 
                                                                        }
                                                                        if( isset($_POST["vote5"]) ){ 
                                                                            $vote_total += $_POST["vote5"]; 
                                                                        }
                                                                        if( isset($_POST["vote6"]) ){ 
                                                                            $vote_total += $_POST["vote6"]; 
                                                                        }
                                                                        if( isset($_POST["vote7"]) ){ 
                                                                            $vote_total += $_POST["vote7"]; 
                                                                        }
                                                                        if( isset($_POST["vote8"]) ){ 
                                                                            $vote_total += $_POST["vote8"]; 
                                                                        }
                                                                        if( isset($_POST["vote9"]) ){ 
                                                                            $vote_total += $_POST["vote9"]; 
                                                                        }
                                                                        if( isset($_POST["vote10"]) ){ 
                                                                            $vote_total += $_POST["vote10"]; 
                                                                        } 
                                                                        if( isset($_POST["vote11"]) ){ 
                                                                            $vote_total += $_POST["vote11"]; 
                                                                        }
                                                                        if( isset($_POST["vote12"]) ){ 
                                                                            $vote_total += $_POST["vote12"]; 
                                                                        }
                                                                        if( isset($_POST["vote13"]) ){ 
                                                                            $vote_total += $_POST["vote13"]; 
                                                                        } 
                                                                        if( isset($_POST["vote14"]) ){ 
                                                                            $vote_total += $_POST["vote14"]; 
                                                                        }
                                    
                                                                        if( trim($_POST['comment']) != "" ){
                                                                            $vote_total += 10;
                                                                        }
                                                                        
                                                                        $db->query("
                                                                                        update auc_regist 
                                                                                        set 	score = (score - '".$vote_total."'),
                                                                                                count_comment =  count_comment+1
                                                                                        where reg_id = '".$dbproduct->f(reg_id)."'
                                                                                    ");
                                                                        
                                                                        $q="
                                                                            INSERT INTO `comment_auc` 
                                                                                            ( 
                                                                                                `comment_id` , 
                                                                                                `comment_by` , 
                                                                                                `comment_product` , 
                                                                                                `comment_point` , 
                                                                                                `comment_detail` , 
                                                                                                `comment_date`, 
                                                                                                `vote1`, 
                                                                                                `vote2`, 
                                                                                                `vote3`, 
                                                                                                `vote4`, 
                                                                                                `vote5`, 
                                                                                                `vote6`, 
                                                                                                `vote7`, 
                                                                                                `vote8`, 
                                                                                                `vote9`, 
                                                                                                `vote10`, 
                                                                                                `vote11`, 
                                                                                                `vote12`, 
                                                                                                `vote13`, 
                                                                                                `vote14`
                                                                                            ) VALUES (
                                                                                                '', 
                                                                                                '".$_SESSION['adminshop_id']."', 
                                                                                                '".$dbproduct->f(reg_id)."', 
                                                                                                '".$_POST['point']."', 
                                                                                                '".$_POST['comment']."', 
                                                                                                '".time()."', 
                                                                                                '".$_POST['vote1']."', 
                                                                                                '".$_POST['vote2']."', 
                                                                                                '".$_POST['vote3']."', 
                                                                                                '".$_POST['vote4']."', 
                                                                                                '".$_POST['vote5']."', 
                                                                                                '".$_POST['vote6']."', 
                                                                                                '".$_POST['vote7']."', 
                                                                                                '".$_POST['vote8']."', 
                                                                                                '".$_POST['vote9']."', 
                                                                                                '".$_POST['vote10']."', 
                                                                                                '".$_POST['vote11']."', 
                                                                                                '".$_POST['vote12']."', 
                                                                                                '".$_POST['vote13']."', 
                                                                                                '".$_POST['vote14']."' 
                                                                                            )
                                                                            ";
                                                                        $db->query($q);
                                    
                                                                        $INS_ID=mysql_insert_id();  
                                                                        $q="SELECT * FROM `comment_auc` WHERE `comment_product` = '".$dbproduct->f(reg_id)."' ";
                                                                        $comment= new nDB();
                                                                        $comment->query($q);
                                                                        $comment->next_record();
                                                                        $num_rows = $comment->num_rows();
                                                                        $point = $_POST['point'] ;
                                                                        $score = $dbproduct->f(score) ;
                                                                        $votescore = ($point + $score)/$num_rows ;
                                    
                                                                        $q="
                                                                                UPDATE `auc_member` 
                                                                                SET `commentscore` = `commentscore`+10
                                                                                WHERE `m_id` ='".$dbshop->f(id)."' 
                                                                            ";
                                                                        $db->query($q);
                                    
                                                                        al('ได้ส่งผลคะแนนโหวต เรียบร้อยแล้ว / 分数投票结果已被展发');
                                                                        redi4('view.php?id='.$dbproduct->f(reg_id));
                                                                    }
                                    
                                                                    ?>
                                                                <?
                                                                    $q="SELECT * FROM `comment_auc` WHERE `comment_product` = '".$_SESSION['product_id']."' ";
                                                                    $comment= new nDB();
                                                                    $comment->query($q);
                                                                    $comment->next_record();
                                                                    $num_rows = $comment->num_rows(); 
                                                                    ?>
                                                                <? if  (($num_rows)==0 ) { ?>
                                                                <tr>
                                                                    <td height="50" align="center" style="color:#FC0">
                                                                        <table width="900" border="0" align="center" cellpadding="0" cellspacing="0">
                                                                        <tr>
                                                                            <td height="25" bgcolor="#555555">
                                                                                <table width="100%" cellpadding="3" cellspacing="0" border="0">
                                                                                    <tr>
                                                                                    <td height="20" align="right" bgcolor="#00CC00" > bb z 100 คะแนน / 分数</td>
                                                                                    </tr>
                                                                                </table>
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td height="25">
                                                                                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                                                    <tr>
                                                                                    <td width="30%"><span style="color:#ff0000">พระเก๊ / /假牌</span></td>
                                                                                    <td width="40%" align="center"><span style="color:#ffCC00">ไม่แน่ใจ / 不确定</span></td>
                                                                                    <td width="30%" align="right"><span style="color:#00CC00">พระแท้ / 真牌</span></td>
                                                                                    </tr>
                                                                                </table>
                                                                            </td>
                                                                        </tr>
                                                                        </table>
                                                                    </td>
                                                                </tr>
                                                                <? } else { ?>
                                                                <tr>
                                                                    <td>
                                                                        <table width="900" border="0" align="center" cellpadding="0" cellspacing="0">
                                                                        <tr>
                                                                            <td height="25" bgcolor="#555555">
                                                                                <?php
                                                                                    if ($dbproduct->f(score)>79) {
																						if ($dbproduct->f(score)>100) {
																							$dbscore = 100;
																						  }else{
																							$dbscore = $dbproduct->f(score);
																						  }
																						$dbscoreprocess = $dbproduct->f(score);
																						$colorscore ="#00ff00";
                                                                                    }elseif ($dbproduct->f(score)>29) {
                                                                                    $dbscore = $dbproduct->f(score);
                                                                                    $dbscoreprocess = $dbproduct->f(score);
                                                                                    $colorscore ="#F7E81D";      
                                                                                    }else{
                                                                                    $dbscore = $dbproduct->f(score);
                                                                                    $dbscoreprocess = $dbproduct->f(score);
                                                                                    $colorscore = "red";     
                                                                                    }
                                                                                    ?>
                                                                                <table width="<?=$dbproduct->f(score)?>%" cellpadding="3" cellspacing="0" border="0">
                                                                                    <tr>
                                                                                    <td height="20" align="right" bgcolor="<?=$colorscore?>" ><?=$dbproduct->f(score)?>
                                                                                        คะแนน / 分数
                                                                                    </td>
                                                                                    </tr>
                                                                                </table>
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td height="25">
                                                                                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                                                    <tr>
                                                                                    <td width="30%"><span style="color:#ff0000">พระเก๊ / 假牌</span></td>
                                                                                    <td width="40%" align="center"><span style="color:#ffCC00">ไม่แน่ใจ / 不确定</span></td>
                                                                                    <td width="30%" align="right"><span style="color:#00CC00">พระแท้ / 正牌</span></td>
                                                                                    </tr>
                                                                                </table>
                                                                            </td>
                                                                        </tr>
                                                                        </table>
                                                                    </td>
                                                                </tr>
                                                                <? } ?>
                                                                <tr>
                                                                    <td height="30" align="center"><span style="color:#ffffff"> หากท่านคิดว่าพระเครื่องของท่านเป็นพระแท้แน่นอน ควรทำการแนบใบการันตีพระจากศูนย์ต่าง ๆ เพื่อเพิ่มความน่าเชื่อถือ<br>
                                                                        如果还确定您的佛牌是正牌，<u></u>必需把各地的认正佛牌中心出的认正佛牌书传来,以增加可靠性 </span>
                                                                    </td>
                                                                </tr>
                                                                <? if ($dbproduct->f(score) > 0) { ?>
                                                                <tr>
                                                                    <td height="30" align="center">
                                                                        <table width="100%" border="0" cellspacing="0" cellpadding="3">
                                                                        <?php if($_SESSION['adminshop_id']=='' || !isset($_SESSION['adminshop_id'])) {  ?>
                                                                        <tr>
                                                                            <td>
                                                                                <form action="chk_votelogin.php" method="post" name="REG" target="blank" id="REG">
                                                                                    <table width="900" border="0" align="center" cellpadding="3" cellspacing="0">
                                                                                    <tr>
                                                                                        <td height="29"  align="center" style="background:url(images/bh-login.png) no-repeat center; padding-left:30px"><span style="color:#391700; font-size:14px; font-weight:bold">เข้าสู่ระบบ / 登录</span></td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td width="71%" bgcolor="#603506"><span class="detail-text" style="color:#fc0;">username / 帐号 :</span>
                                                                                            <input name="username" type="text" class="input" id="username" style="width:160px" />
                                                                                            <span class="detail-text" style="color:#fc0;">password / 密码 :</span>
                                                                                            <input name="password" type="password" class="input" id="password" style="width:160px" />
                                                                                            <input name="Login" type="submit" id="Login" value="เข้าสู่ระบบ / 登录" />
                                                                                            <a href="forget_password.php"><span style="color:#FC0">ลืมรหัสผ่าน / 忘记密码</span></a>&nbsp;
                                                                                        </td>
                                                                                    </tr>
                                                                                    <iframe src="" name="p_wb" width="0px" height="0px" frameborder="0" id="p_wb"></iframe>
                                                                                    </table>
                                                                                </form>
                                                                            </td>
                                                                        </tr>
                                                                        <? } else { ?>
                                                                        <tr>
                                                                            <td align="center">
                                                                                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                                                    <tr>
                                                                                    <td>
                                                                                        <form action="" method="post" target="vote_frm">
                                                                                            <table width="600" border="0" align="center" cellpadding="3" cellspacing="0">
                                                                                                <tr>
                                                                                                <td height="30" colspan="2" align="center" bgcolor="#603506" style="color:#FC0">ให้คะแนนพระเครื่องนี้ / 评论给这尊牌的分数</td>
                                                                                                </tr>
                                                                                                <!--<tr>
                                                                                                <td width="25" align="center" bgcolor="#78440b"><input name="point" type="radio" value="100" checked="CHECKED"></td>
                                                                                                <td width="563" bgcolor="#78440b" style="color:#0C0">แท้ (100 คะแนน)</td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                <td align="center" bgcolor="#78440b"><input name="point" type="radio" value="50"></td>
                                                                                                <td bgcolor="#78440b" style="color:#ffCC00" >ไม่แน่ใจ (50 คะแนน)</td>
                                                                                                </tr>-->
                                                                                                <tr>
                                                                                                <td align="center" bgcolor="#78440b">
                                                                                                    <!--<input name="point" type="radio" value="0">-->
                                                                                                </td>
                                                                                                <td bgcolor="#78440b"  style="color:#00FF14;text-align:center;"> หากท่านเห็นว่าสินค้านี้ไม่น่าจะแท้ กรุณาเลือกเหตุผลด้านล่าง <br/>如您看了上面那尊牌有点不真，请您选择以下的理由给这尊牌做签定或评论一下</td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                <td colspan="2" align="center" bgcolor="#78440b" style="color:#FC0">
                                                                                                    <table width="95%" border="0" cellspacing="0" cellpadding="0" style="color:#FFF">
                                                                                                        <tr>
                                                                                                            <td width="5%" align="center"><input name="vote1" type="checkbox" value="2"></td>
                                                                                                            <td width="95%" style="color:#FFF">จากภาพพระเบลอ / 相片里佛牌模糊<span style="color:#FC0"> (-2 คะแนน / 分数)</span></td>
                                                                                                        </tr>
                                                                                                        <tr>
                                                                                                            <td align="center"><input  name="vote2" type="checkbox" value="15"></td>
                                                                                                            <td style="color:#FFF">จากภาพพระเบลอมาก / 相片里佛牌很模糊<span style="color:#FC0"> (-15 คะแนน / 分数)</span></td>
                                                                                                        </tr>
                                                                                                        <tr>
                                                                                                            <td align="center"><input name="vote3" type="checkbox" value="10"></td>
                                                                                                            <td style="color:#FFF">จากภาพพิมพ์ตื้นไป / 相片里模表面很浅<span style="color:#FC0"> (-10 คะแนน分数 / )</span></td>
                                                                                                        </tr>
                                                                                                        <tr>
                                                                                                            <td align="center"><input name="vote4" type="checkbox" value="15"></td>
                                                                                                            <td style="color:#FFF">จากภาพผิดพิมพ์ / 相片里佛牌模不对<span style="color:#FC0"> (-15 คะแนน / 分数 )</span></td>
                                                                                                        </tr>
                                                                                                        <tr>
                                                                                                            <td align="center"><input name="vote5" type="checkbox" value="10"></td>
                                                                                                            <td style="color:#FFF">จากภาพผิดเนื้อ / 相片里佛牌料质不对<span style="color:#FC0"> (-10 คะแนน / 分数)</span></td>
                                                                                                        </tr>
                                                                                                        <tr>
                                                                                                            <td align="center"><input name="vote6" type="checkbox" value="5"></td>
                                                                                                            <td style="color:#FFF">จากภาพผิวรมใหม่ / 相片里佛牌是新皮<span style="color:#FC0"> (-5 คะแนน / 分数)</span></td>
                                                                                                        </tr>
                                                                                                        <tr>
                                                                                                            <td align="center"><input name="vote7" type="checkbox" value="15"></td>
                                                                                                            <td style="color:#FFF">จากภาพพระบวม / 相片里佛牌肿胀<span style="color:#FC0"> (-15 คะแนน / 分数)</span></td>
                                                                                                        </tr>
                                                                                                        <tr>
                                                                                                            <td align="center"><input name="vote8" type="checkbox" value="15"></td>
                                                                                                            <td style="color:#FFF">จากภาพพระดูยาก / 相片里佛牌辨认真假难<span style="color:#FC0"> (-15 คะแนน / 分数)</span></td>
                                                                                                        </tr>
                                                                                                        <tr>
                                                                                                            <td align="center"><input name="vote9" type="checkbox" value="10"></td>
                                                                                                            <td style="color:#FFF">จากภาพทีความคมชัดน้อย / 相片里的尖锐度很少<span style="color:#FC0"> (-10 คะแนน / 分数)</span></td>
                                                                                                        </tr>
                                                                                                        <tr>
                                                                                                            <td align="center"><input name="vote10" type="checkbox" value="30"></td>
                                                                                                            <td style="color:#FFF">จากภาพปลอมแปลงใบรับรอง / 假冒的验正书<span style="color:#FC0"> (-30 คะแนน / 分数)</span></td>
                                                                                                        </tr>
                                                                                                        <tr>
                                                                                                            <td align="center"><input name="vote11" type="checkbox" value="15"></td>
                                                                                                            <td style="color:#FFF">จากภาพประวัติไม่ชัดเจน / 来历不明显<span style="color:#FC0"> (-15 คะแนน / 分数)</span></td>
                                                                                                        </tr>
                                                                                                        <tr>
                                                                                                            <td align="center"><input name="vote12" type="checkbox" value="20"></td>
                                                                                                            <td style="color:#FFF">เนื้อดูใหม่ไป / 佛牌表面皮看得很新<span style="color:#FC0"> (-20 คะแนน / 分数)</span></td>
                                                                                                        </tr>
                                                                                                        <tr>
                                                                                                            <td align="center"><input name="vote13" type="checkbox" value="20"></td>
                                                                                                            <td style="color:#FFF">เนื้อไม่ถึงยุค / 佛牌后旧性达不到当时年代<span style="color:#FC0"> (-20 คะแนน / 分数)</span></td>
                                                                                                        </tr>
                                                                                                        <tr>
                                                                                                            <td align="center"><input name="vote14" type="checkbox" value="0"></td>
                                                                                                            <td style="color:#FFF">ลงผิดหมวดสินค้า / 本尊牌不合格在本区展示<span style="color:#FC0"> (ให้ย้ายภายใน 3 วัน ก่อนที่จะโดนลบสินค้า จาก admin/ 敬请转到合适佛牌区3天 不然被册除 For Admin)</span></td>
                                                                                                        </tr>
                                                                                                    </table>
                                                                                                </td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                <td colspan="2" align="center" bgcolor="#78440b"><span style="color:#FC0"> เหตุผลอื่น ๆ 
                                                                                                    /
                                                                                                    其它理由 </span>
                                                                                                </td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                <td colspan="2" align="center" bgcolor="#78440b"><textarea name="comment" cols="60" rows="5" id="comment" style="overflow:hidden"></textarea></td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                <td colspan="2" align="center" bgcolor="#78440b"><input name="submit" type="submit" id="submit" value="ตกลง / 确定"></td>
                                                                                                </tr>
                                                                                                <iframe src="" name="vote_frm" width="1px" height="0px" frameborder="0" id="vote_frm"></iframe>
                                                                                                <script>
                                                                                                CKEDITOR.replace( 'comment', {
                                                                                                        toolbar:  [
                                                                                                        ]
                                                                                                });           
                                                                                                </script>
                                                                                            </table>
                                                                                        </form>
                                                                                    </td>
                                                                                    </tr>
                                                                                </table>
                                                                            </td>
                                                                        </tr>
                                                                        <? } ?>
                                                                        </table>
                                                                    </td>
                                                                </tr>
                                                                <? } else { ?>
                                                                <tr>
                                                                    <td style="color:#F00; font-size:18px" align="center" height="50px">รายการนี้ปิดการให้คะแนนแล้ว / 这个项目以被冻结</td>
                                                                </tr>
                                                                <? } ?>
                                                            </table>
                                                            </td>
                                                        </tr>
                                                    </table>                            
                            </td>
					  </tr>
                      <tr>
                      	<td bgcolor="#111111">
					<?php
						$q = "SELECT * FROM `comment_auc` WHERE `comment_product` = '".$dbproduct->f(reg_id)."' ORDER BY comment_id DESC ";
						$showment = new nDB();
						$showment->query($q);
						while($showment->next_record()){
						?>                        
                        <table class="commentresult_table" style="width:100%; color:#000" border="0" cellpadding="0" cellspacing="0">
							<tr style="background-color:#78440b;">
								<td style="padding-left:20px; width:1px; height:35px; text-align:right; white-space:nowrap; color:#000"> เหตุผลที่เลือก / 选的意见 </td>
								<td style="padding-left:10px; padding-right:10px; width:1px;"> : </td>
								<td style="color:#000"><?php
									if($showment->f(vote1) != 0){
									?>
									จากภาพพระเบลอ / 相片里佛牌模糊
									<?php
									}
									if($showment->f(vote2) != 0){
									?>
									จากภาพพระเบลอมาก / 相片里佛牌很模糊
									<?php
									}
									if ($showment->f(vote3) != 0){
									?>
									จากภาพพิมพ์ตื้นไป / 相片里模表面很浅
									<?php
									}
									if($showment->f(vote4)){
									?>
									จากภาพผิดพิมพ์ / 相片里佛牌模不对
									<?php
									}
									if($showment->f(vote5) != 0){
									?>
									จากภาพผิดเนื้อ / 相片里佛牌料质不对
									<?php
									}
									if($showment->f(vote6) != 0 ){
									?>
									จากภาพผิวรมใหม่ / 相片里佛牌是新皮
									<?php
									}
									if($showment->f(vote7) != 0){
									?>
									จากภาพพระบวม / 相片里佛牌肿胀
									<?php
									}
									if($showment->f(vote8) != 0){
									?>
									จากภาพพระดูยาก / 相片里佛牌辨认真假难
									<?php
									}
									if($showment->f(vote9) != 0){
									?>
									จากภาพมีความคมชัดน้อย / 相片里的尖锐度很少
									<?php
									}
									if($showment->f(vote10) != 0){
									?>
									จากภาพปลอมแปลงใบรับรอง / 假冒的验正书
									<?php
									}
									if($showment->f(vote11) != 0){
									?>
									จากภาพประวัติไม่ชัดเจน / 来历不明显
									<?php
									}
									if($showment->f(vote12) != 0){
									?>
									เนื้อดูใหม่ไป / 佛牌表面皮看得很新
									<?php
									}
									if($showment->f(vote13) != 0){
									?>
									เนื้อไม่ถึงยุค / 佛牌后旧性达不到当时年代
									<?php
									}
									if($showment->f(vote14) != 0){
									?>
									ลงผิดหมวดสินค้า / 本尊牌不合格在本区展示
									<?php
									}
									?>
								</td>
							</tr>
							<?php
								if ($showment->f(comment_detail) != '') {
								?>
							<tr style="background-color:#6e3d07;">
								<td style="padding-left:20px; width:1px; height:35px; text-align:right; white-space:nowrap; color:#000"> เหตุผลเพิ่มเติม </td>
								<td style="padding-left:10px; padding-right:10px; width:1px;"> : </td>
								<td><?=$showment->f(comment_detail)?></td>
							</tr>
							<?php
								}
								?>
							<tr style="background-color:#78440b;">
								<td style="padding-left:20px; width:1px; height:35px; text-align:right; white-space:nowrap; color:#000"> เลขที่แสดงความคิดเห็น / 评论意见编号 </td>
								<td style="padding-left:10px; padding-right:10px; width:1px;"> : </td>
								<td style="color:#000"><?=$showment->f(comment_id)?></td>
							</tr>
							<tr style="background-color:#6e3d07;">
								<td style="padding-left:20px; width:1px; height:35px; text-align:right; white-space:nowrap; color:#000"> วันที่ </td>
								<td style="padding-left:10px; padding-right:10px; width:1px;"> : </td>
								<td style="color:#000"><?=date("d F Y",$showment->f(comment_date))?></td>
							</tr>
						</table>
                        <? } ?>
                        </td>
                      </tr>
						<tr>
							<td align="center">
								<?
								if(!isset($_SESSION['aucuser_id'])){
									?>
									เฉพาะสมาชิกเท่านั้น กรุณาเข้าสู่ระบบก่อน [<a href="login.php">คลิกเพื่อเข้าสู่ระบบ</a>]
									<?
								}else{
									$date_compare = strtotime($r_auction['reg_dateexpire']);
									$age_life = $date_compare - time();
									if($age_life > 0){
										?>
								<script type="text/javascript">
									function send_auction(){
										var v_auction = $("#txtauction");
										var v_offer = $("#txtoffer");

										if(v_auction.val() == ""){
											alert('กรุณากรอกข้อมูลราคาที่ท่านเสนอเข้าประมูลด้วยครับ');
											v_auction.focus();
											return false;
										}
										else if(parseInt(v_auction.val()) < parseInt(v_offer.val()) ){
											alert('ราคาที่เสนอน้อยกว่าราคาที่เสนอก่อนหน้านี้แล้วครับ');
											v_auction.focus();
											return false;
										}else{
											return true;
										}
									}

									function increase(){
										var result=0 , txtauction = parseInt($('#txtauction').val()) ,txtoffer = parseInt($('#txtoffer').val()) ,txtincrease = parseInt($('#txtincrease').val());
										if(isNaN(txtauction)){
											var txtauction = 0;
											var result = parseInt(txtauction+txtoffer);
										}else{
											var result = parseInt(txtauction+txtincrease);
										}
										
										$("#txtauction").val(result);
									}

									function decrease(){
										var result=0 , txtauction = parseInt($('#txtauction').val()) ,txtoffer = parseInt($('#txtoffer').val()) ,txtincrease = parseInt($('#txtincrease').val());
										if(isNaN(txtauction)){
											var result = '';
										}else{
											if(txtauction <= txtoffer){
												result = parseInt(txtoffer);
											}else{
												var result = parseInt(txtauction-txtincrease);
											}
										}
										
										$("#txtauction").val(result);
									}
									
								</script>
								<form name="frmauction" method="post" onSubmit="return send_auction();">
									<table width="700" border="0" align="center">
										<tr bgcolor="#FEE09B">
											<td align="center" bgcolor="#FECB83">
												<table width="600" border="0" cellpadding="0" cellspacing="0" class="tb_data">
													<tr>
														<td colspan="2" align="center">
														<?
															$r_auction_member = mysql_fetch_array(mysql_query("select * from auc_member where m_id = '".$_SESSION['aucuser_id']."'"));
														?>
															<b>ยินดีต้อนรับคุณ</b> <?=$r_auction_member['m_name'].' '.$r_auction_member['m_surname'];?> <b>เข้าสู่ระบบประมูล</b>
														</td>
													</tr>
													<tr>
														<td width="243" align="right" bgcolor="#FEE09B">
															ขณะนี้ราคาประมูลสูงสุดอยู่ที่
														</td>
														<td width="357">
															<?=number_format($r_aucreply_now['rep_priceoffer']);?>
														</td>
													</tr>
													<tr>
														<td bgcolor="#FEE09B" align="right">
															ราคาประมูลต้องเพิ่มขึ้นอย่างน้อย</td>
														<td>
															<?=number_format($r_auction['reg_pricestep']);?>
														</td>
													</tr>
													<tr>
														<td bgcolor="#FEE09B" align="right">
															ราคาประมูลที่จะสามารถเสนอได้ขั้นต่ำ
														</td>
														<td>
															<?=number_format(($r_aucreply_now['rep_priceoffer']+$r_auction['reg_pricestep']));?>
														</td>
													</tr>
													<tr>
														<td bgcolor="#FEE09B" align="right">
															ราคาที่ท่านเสนอเข้าประมูล
														</td>
														<td>
															<style type="text/css">
																.Imgcrease{
																	position: relative;
																	top: 5px;
																	left: 15px;
																}
																.Imgcrease:hover{
																	cursor: pointer;
																}
															</style>
															<input type="text" name="txtauction" id="txtauction" /> บาท
															<input type="hidden" name="txtincrease" id="txtincrease" value="<?=$r_auction['reg_pricestep']?>"/>
															<input type="hidden" name="txtoffer" id="txtoffer" value="<?=$r_aucreply_now['rep_priceoffer']+$r_auction['reg_pricestep']?>">
															<img src="images/increase.png" border="0" class="Imgcrease" onClick="return increase()" title="เพิ่มอัติโนมัติ">
															<img src="images/decrease.png" border="0" class="Imgcrease" onClick="return decrease()" title="ลดอัติโนมัติ">
														</td>
													</tr>
												</table>
											</td>
										</tr>
										<tr bgcolor="#FECB83">
											<td align="center">
												<input type="hidden" name="do_what" value="put_price">
												<input type="submit" value="ตกลง"/> 
												<input type="reset"  value="ยกเลิก"/>
											</td>
										</tr>
									</table>
								</form>
										<?
									}else{
										?>
									<table width="700" border="0" align="center">
										<tr bgcolor="#FEE09B">
											<td align="center" bgcolor="#FECB83" style="padding: 14px;">
												<table width="600" border="0" cellpadding="0" cellspacing="0" class="tb_data">
													<tr>
														<td colspan="2" align="center">
														<?
															$r_auction_member = mysql_fetch_array(mysql_query("select * from auc_member where m_id = '".$_SESSION['aucuser_id']."'"));
														?>
															<b>ยินดีต้อนรับคุณ</b> <?=$r_auction_member['m_name'].' '.$r_auction_member['m_surname'];?> <b>เข้าสู่ระบบประมูล</b>
														</td>
													</tr>
													<tr>
														<td width="243" align="right" bgcolor="#FEE09B">
															ขณะนี้ราคาประมูลสูงสุดอยู่ที่
														</td>
														<td width="357">
															<?=number_format($r_aucreply_now['rep_priceoffer']);?>
														</td>
													</tr>
													<tr>
														<td bgcolor="#FEE09B" align="right">
															ราคาประมูลต้องเพิ่มขึ้นอย่างน้อย</td>
														<td>
															<?=number_format($r_auction['reg_pricestep']);?>
														</td>
													</tr>
													<tr>
														<td bgcolor="#FEE09B" align="center" colspan="2">
															<b>(!!! ปิดประมูลแล้ว !!!)</b>
														</td>
													</tr>
													<tr>
														<td bgcolor="#FEE09B" align="center" colspan="2">
															<script type="text/javascript">
															function auction_mailtoyou(creator,creator_email)
																{
																  amailtoyou = window.open ("mailtoyou.php?creator1="+creator +"&creator1_email="+creator_email,"MailToYou","toolbar=0,height=390,width=600,resizable=no,scrollbars=no");
																  amailtoyou.focus();
																}
															</script>
															<?
															$qwin = mysql_query("select * from auc_reply where rep_aucid = '".$_GET['id']."' order by rep_id desc");
															$rwin = mysql_fetch_array($qwin);
															if($rwin['rep_memid'] <> $_SESSION['aucuser_id']){
																$r_member = mysql_fetch_array(mysql_query("select * from auc_member where m_id = '".$rwin['rep_memid']."' "));
																?>
																<span>
																	<b>ผู้ชนะประมูล</b>
																	<a href="javascript:auction_mailtoyou('<?=$r_member['m_username']?>','<?=$r_member['m_email']?>')" title="ส่งเมล์">
																	<?=$r_member['m_username']?>
																</a>
																</span>
																<?
															}else{
																?>
															<p>
																<b>ยินดีด้วย คุณคือผู้ชนะการประมูล กรุณาโอนเงินไปที่ :</b>
															</p>
															<style type="text/css">
																.tb_datawin{
																	border-collapse: collapse;
																}
																.tb_datawin td{
																	border: 1px rgb(255, 171, 124) solid;
																	padding-left: 4px;
																	padding-right: 6px;
																	line-height: 20px;
																	background: rgb(252, 247, 247);
																}
															</style>
															<table width="500px" border="0" cellpadding="0" align="center" cellspacing="0" class="tb_datawin">
																<tr>
																	<td width="160px" align="right">
																		<b>ชื่อบัญชี</b>
																	</td>
																	<td><?= $r_auction['reg_accountname']?></td>
																</tr>
																<tr>
																	<td align="right">
																		<b>หมายเลขบัญชี</b>  
																	</td>
																	<td><?= $r_auction['reg_noaccount']?></td>
																</tr>
																<tr>
																	<td align="right">
																		<b>ธนาคาร</b>
																	</td>
																	<td><?= $r_auction['reg_bankname']?></td>
																</tr>
																<tr>
																	<td align="right">
																		<b>สาขา</b>
																	</td>
																	<td><?= $r_auction['reg_subaccount']?></td>
																</tr>
																<tr>
																	<td align="right">
																		<b>ประเภทบัญชี</b>
																	</td>
																	<td><?= $r_auction['reg_banktype']?></td>
																</tr>
																<tr>
																	<td align="right">
																		<b>เบอร์โทรศัพท์</b>
																	</td>
																	<td><?= $r_auction['reg_telephone']?></td>
																</tr>
																<tr>
																	<td align="right">
																		<b>E-mail</b>
																	</td>
																	<td><?= $r_auction['reg_email']?></td>
																</tr>
															</table>
															<p>&nbsp;</p>
																<?
															}
															?>
														</td>
													</tr>
												</table>
											</td>
										</tr>
										<tr bgcolor="#FECB83">
											
										</tr>
									</table>
										<?
									}
								}
								?>
							</td>
						</tr>
						<?
						if(isset($_SESSION['aucuser_id'])){
						?>
						<tr>
							<td>
								<table width="700" border="0" align="center">
									<tr bgcolor="#FEE09B">
										<td align="center" bgcolor="#FECB83" style="padding: 14px;">
											<table width="600" border="0" cellpadding="0" cellspacing="0" class="tb_data">
												<tr>
													<td colspan="2" align="center" style="
													    background: rgb(202, 100, 32);
													    color: #eee;
													">
														<b>ประวัติการเสนอราคา</b>
													</td>
												</tr>
												<tr>
													<td colspan="2" align="center"  style="padding: 0;">
														<style type="text/css">
															.table_listinfo{
																border-collapse: collapse;
															}
															.table_listinfo td{
																border: 1px rgb(238, 216, 204) solid;
															}
														</style>
														<table width="100%" border="0" cellpadding="0" align="center" cellspacing="0" class="table_listinfo">
															<tr style="background:rgb(246, 169, 85);text-align:center;">
																<td><b>ผู้เสนอราคา</b></td>
																<td><b>ราคา</b></td>
																<td width="275px"><b>เวลา</b></td>
															</tr>
															<?
															$strauconly = "select * from auc_reply where rep_aucid = '".$_GET['id']."' ";
															$qauconly = mysql_query($strauconly);
															while ($rauconly = mysql_fetch_array($qauconly)) {
																$rmemeber = mysql_fetch_array(mysql_query("select * from auc_member where m_id = '".$rauconly['rep_memid']."' "));
																?>
															<tr>
																<td>
																	<?=$rmemeber['m_username']?>
																</td>
																<td align="right">
																	<?=number_format($rauconly['rep_priceoffer'])?>
																</td>
																<td>
																	<?
																	$date_4=strtotime($rauconly['rep_created']); 
																	echo thai_date($date_4);
																	?>
																</td>
															</tr>
																<?
															}
															?>
														</table>
													</td>
												</tr>
											</table>
										</td>
									</tr>
								</table>
							</td>
						</tr>
							<?
						}
						?>
					</table>
			</div>
		</div>
		<?php
			include('footer.php');
			?>
	</div>
</body>
</html>