<div class="box_content" id="containerregist" style="background: #fff;padding: 10px 0;">
	<form action="member_regist_form_process.php" method="post" name="frmmem_regist" id="frmmem_regist" target="reg_frm" style="margin: 0;">
		<iframe src="" name="reg_frm" width="1px" height="0px" frameborder="0" id="reg_frm"></iframe> 
		<table border="1" align="center" cellpadding="0" cellspacing="0" class="regist-tb">
			<tr>
			  <td colspan="2" bgcolor="#4A1701" class="head_contain" style="padding-left: 11px;text-align:left;">
			  		<span class="text_yellpw" class="col-title" ><strong><?=$language['text_newregist'];?></strong></span>
			  </td>
			</tr>
			<tr>
			  <td colspan="2" align="center">&nbsp;</td>
			</tr>
			<tr>
			  <td colspan="2" align="center"><span style="color:red">* กรุณากรอกข้อมูลตามความเป็นจริงให้ครบถ้วน</span></td>
			</tr>
			<tr>
				<td align="right" class="col-title" ><strong><?=$language['username'];?> : </strong></td>
				<td><input type="text" name="username" id="username"></td>
			</tr>
			<tr>
				<td align="right" class="col-title" ><strong><?=$language['password'];?> : </strong></td>
				<td><input type="password" name="password" id="password"></td>
			</tr>
			<tr>
				<td align="right" class="col-title" ><strong><?=$language['confirmpass'];?> : </strong></td>
				<td><input type="password" name="confirmpass" id="confirmpass"></td>
			</tr>
			<tr>
				<td colspan="2" align="center">&nbsp;</td>
			</tr>
			<tr>
				<td align="right" class="col-title" ><strong><?=$language['fisrtname'];?> : </strong></td>
				<td><input type="text" name="firstname" id="firstname"></td>
			</tr>
			<tr>
				<td align="right" class="col-title" ><strong><?=$language['lastname'];?> : </strong></td>
				<td><input type="text" name="lastname" id="lastname"></td>
			</tr>
			<tr>
				<td align="right" class="col-title" ><strong><?=$language['sex'];?> : </strong></td>
				<td><label>
					<input type="radio" name="sex" id="sex1" value="1">
					ชาย 
					</label>
					<label>
					<input type="radio" name="sex" id="sex2" value="2">
					หญิง</label>
				</td>
			</tr>
			<tr>
				<td align="right" class="col-title" ><strong><?=$language['birthday'];?> : </strong></td>
				<td>
					<input type="text" name="birtday" id="birtday">
				</td>
			</tr>
			<tr>
				<td align="right" class="col-title" ><strong><?=$language['idcard'];?> : </strong></td>
				<td><input type="text" name="posenalid" id="posenalid"></td>
			</tr>
			<tr>
				<td align="right" class="col-title" ><strong><?=$language['address'];?> : </strong></td>
				<td>
					<textarea rows="4" cols="30" name="address" id="address">

					</textarea>
				</td>
			</tr>
			<tr>
				<td align="right" class="col-title" ><strong>ประเทศ : </strong></td>
				<td>
					<select name="country" id="country">
						 <option value="Thailand" selected="selected">Thailand</option>
						 <option value="Malaysia">Malaysia</option>
						 <option value="Singapore">Singapore</option>
						 <option value="China">China</option>
						 <option value="Hongkong">Hongkong</option>
						 <option value="Taiwan">Taiwan</option>
						 <option value="Indonesia">Indonesia</option>
					</select>
				</td>
			</tr>
			<tr>
				<td align="right" class="col-title" ><strong><?=$language['accountname'];?> : </strong></td>
				<td><input type="text" name="accountname" id="accountname"></td>
			</tr>
			<tr>
				<td align="right" class="col-title" ><strong><?=$language['bankname'];?> : </strong></td>
				<td><input type="text" name="bankname" id="bankname"></td>
			</tr>
			<tr>
				<td align="right" class="col-title" ><strong><?=$language['subbank'];?> : </strong></td>
				<td><input type="text" name="subbank" id="subbank"></td>
			</tr>
			<tr>
				<td align="right" class="col-title" ><strong><?=$language['noaccount'];?> : </strong></td>
				<td><input type="text" name="noaccount" id="noaccount"></td>
			</tr>
			<tr>
				<td align="right" class="col-title" ><strong><?=$language['accountype'];?> : </strong></td>
				<td>
					<input type="radio" name="account_type" id="account_type1" value="1">
					ออมทรัพย์ 
					<input type="radio" name="account_type" id="account_type2" value="2">
					กระแสรายวัน
				</td>
			</tr>
			<tr>
				<td align="right" class="col-title" ><strong><?=$language['phone'];?> : </strong></td>
				<td><input type="text" name="phone" id="phone"></td>
			</tr>
			<tr>
				<td align="right" class="col-title" ><strong><?=$language['email'];?>: </strong></td>
				<td><input type="text" name="emial" id="emial"></td>
			</tr>
			<tr>
				<td align="right" class="col-title" ><strong><?=$language['website'];?> : </strong></td>
				<td><input type="text" name="website" id="website"></td>
			</tr>
			<tr>
				<td align="right" class="col-title" ><strong><?=$language['education'];?> : </strong></td>
				<td>
					<select name="education">
						<option selected="" value="0">-- เลือกรายการ --
						</option>
						<option value="1">ประถมศึกษา
						</option>
						<option value="2">มัธยมศึกษาตอนต้น
						</option>
						<option value="3">มัธยมศึกษาตอนปลาย
						</option>
						<option value="4">อนุปริญญา
						</option>
						<option value="5">ปริญญาตรี
						</option>
						<option value="6">ปริญญาโท
						</option>
						<option value="7">ปริญญาเอก
						</option>
						<option value="9">อื่น ๆ
						</option>
					</select>
				</td>
			</tr>
			<tr>
				<td align="right" class="col-title" ><strong><?=$language['occupation'];?> :</strong></td>
				<td>
					<select name="occupation">
						<option selected="" value="0">-- เลือกรายการ --
						</option>
						<option value="1">ค้าขาย/การตลาด
						</option>
						<option value="2">บัญชี/การเงิน/อสังหาริมทรัพย์
						</option>
						<option value="3">วิชาชีพ (แพทย์,เภสัชกร,ทนาย,วิศวกร,ฯลฯ)
						</option>
						<option value="4">คอมพิวเตอร์ (ฮาร์ดแวร์/ซอฟต์แวร์/เน็ตเวิร์ก)
						</option>
						<option value="5">ธุรกิจด้านอินเทอร์เน็ต/ผู้ให้บริการอินเทอร์เน็ต
						</option>
						<option value="6">ธุรกิจท่องเที่ยว/เดินทาง (รถ เรือ เครื่องบิน ฯลฯ)
						</option>
						<option value="7">บริการ/รับจ้างทั่วไป/ธุรกิจส่วนตัว
						</option>
						<option value="8">ครู/อาจารย์/ผู้ฝึกอบรม
						</option>
						<option value="9">รับราชการ/ตำรวจ/ทหาร
						</option>
						<option value="10">สื่อสาร/ไปรษณีย์/โทรศัพท์/ดาวเทียม
						</option>
						<option value="11">ผู้บริหารระดับสูง
						</option>
						<option value="12">ผู้จัดการทั่วไป
						</option>
						<option value="13">บริการลูกค้า/ซัพพอร์ต
						</option>
						<option value="14">บันเทิง
						</option>
						<option value="15">มีเดีย/สิ่งพิมพ์
						</option>
						<option value="16">ร้านอาหาร/โรงแรม
						</option>
						<option value="17">อุตสาหกรรม/การผลิต/เครื่องจักร
						</option>
						<option value="18">นักเรียน/นักศึกษา
						</option>
						<option value="19">อยู่ในระหว่างหางาน
						</option>
						<option value="20">เกษียณงานแล้ว
						</option>
						<option value="21">ไม่ได้ทำงาน
						</option>
						<option value="99">อื่น ๆ
						</option>
					</select>
				</td>
			</tr>
			<tr>
				<?php
					// function ranDomStr($lenght){
					// 	$str2ran = 'abcdefghijklmnopqrstuvwxyz0123456789';
					// 	$str_result ="";
					// 	while (strlen($str_result)<$lenght) {
					// 		$str_result .=substr($str2ran,(rand()%strlen($str2ran)),1);
					// 	}
					// 	return ($str_result);
					// }

					// $ren_str = ranDomStr(6);
				?>
				<!-- <td align="right" class="col-title" ><strong><?=$language['quation'];?> : </strong></td>
				<td>
					<img src="config/captchar/pic_text.php?str=<?= $ren_str?>">
				</td> -->
				<td align="right" class="col-title"><strong>คำถาม :</strong></td>
				<td align="left">
					<table border="0" cellpadding="0" cellspacing="0">
						<tr>
							<?php
								$random1 = $_SESSION['ses_inum1']=rand(0,9);
								$random2 = $_SESSION['ses_inum2']=rand(0,9);
							?>
							<td>
								<input type="hidden" name="ses_inum1" id="random1" value="<?=$random1;?>">
								<img title="<?=$random1;?>" src="../images/digit/<?=$random1;?>.gif"/>
							</td>
							<td>
								<img src="../images/digit/plus.gif"/> 
							</td>
							<td>
								<input type="hidden" name="ses_inum2" id="random2" value="<?=$random2;?>">
								<img title="<?=$random2;?>" src="../images/digit/<?=$random2;?>.gif"/>
							</td>
							<td>
								<img src="../images/digit/equal.gif"/>
							</td>
							<td>
								<input class="contact_text" name="postnum_answer" style="width:40px;height: 19px;" type="text"/>
							</td>
						</tr>
					</table>
				</td>
			</tr>
			<!-- <tr>
				<td>&nbsp;</td>
				<td>
					<input type="hidden" name="code_hid" value="<?= $ren_str?>">
					<input type="text" name="code_input">
				</td>
			</tr> -->
			<tr>
				<td colspan="2" align="center">&nbsp;</td>
			</tr>
			<tr>
				<td align="right">&nbsp;</td>
				<td>
					<input type="hidden" name="do_what" value="insert_to_db">
					<input type="submit" name="btnSubmit" id="btnSubmit" value="ตกลง">
					<input type="submit" name="btnReset" id="btnReset" value="ยกเลิก">
				</td>
			</tr>
		</table>
	</form>
</div>