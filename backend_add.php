<?php
	include("global.php");
	if( $_SESSION["adminshop_id"] == "" || !isset($_SESSION["adminshop_id"]) ){  
		redi4("index.php");
	}
	set_page($s_page,$e_page=20);

	// language
	if($_GET["lang"] != ""){
		$_SESSION["current_language"] = $_GET["lang"];
	}
	if($_SESSION["current_language"] == ""){
		$_SESSION["current_language"] = "th";
	}
	$language = array();
	$q_language = mysql_query("SELECT content_name, ".$_SESSION["current_language"]." FROM twe_language");
	while($r_language = mysql_fetch_array($q_language)){
		$language[$r_language[0]] = $r_language[1];
	}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>ระบบจัดการเว็บไซต์ : เพิ่มรายการพระเครื่อง</title>
	<link rel="shortcut icon" href="favicon.ico" />
	<link rel="favicon" href="favicon.ico" />
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<?php include("index.css"); ?>
	<!--jquery ui Local-->
	<link rel="stylesheet" href="func/jquery-ui-1.10.3/themes/base/jquery-ui.css"/>
	<script src="func/jquery-ui-1.10.3/jquery-1.9.1.js"></script>
	<script src="func/jquery-ui-1.10.3/ui/jquery-ui.js"></script>
	<script src="func/jquery-ui-1.10.3/jquery.transit.min.js"></script>
	<!--Iswallows Loading-->
	<!-- <script src="https://www.thaiwebeasy.com/iswallows/func/loading/loading.js"></script> -->
	<link rel="stylesheet" type="text/css" href="backend_add_style.min.css">
	<script type="text/javascript" src="backend_add_javascript.min.js"></script>

	<script src="ieditor/ckeditor.js"></script>  
	<script src="ckfinder/ckfinder.js"></script>  
	<style type="text/css">
		.btn-addcategory{
				display: inline;
				padding: 6px 12px 6px;
				font-size: 12px;
				font-weight: 700;
				line-height: 1;
				color: #1F1A19;
				text-align: center;
				white-space: nowrap;
				vertical-align: baseline;
				border-radius: 2px;
				background-color: #FFA906;
		}
	</style>
</head>
<body bgcolor="#FFFFFF" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
	<table width="1000" border="0" align="center" cellpadding="0" cellspacing="0" id="Table_01">
		<tr>
			<td>
				<img src="images/defualt.jpg" width="1000" height="271">
			</td>
		</tr>
		<tr>
			<td width="1000" height="180" style="background:url(images/backend.jpg) no-repeat">
				<table width="100%" border="0" cellspacing="0" cellpadding="0">
					<tr>
						<td><img src="images/images/menubackend_01.jpg" width="103" height="180"></td>
						<td><a href="shop_index.php?shop=<?=$_SESSION['adminshop_id']?>" target="_blank"><img src="images/images/menubackend_02.jpg" name="Image8" width="130" height="180" border="0"></a></td>
						<td><a href="backend.php"><img src="images/images/menubackend_03.jpg" name="Image9" width="94" height="180" border="0"></a></td>
						<td><a href="banner_slide.php"><img src="images/images/menubackend_04.jpg" name="Image10" width="108" height="180" border="0"></a></td>
						<td><a href="backend_banner.php"><img src="images/images/menubackend_05.jpg" name="Image11" width="129" height="180" border="0"></a></td>
						<td><a href="backend_profile.php"><img src="images/images/menubackend_06.jpg" name="Image12" width="103" height="180" border="0"></a></td>
						<td><a href="backend_passwod.php"><img src="images/images/menubackend_07.jpg" name="Image13" width="136" height="180" border="0"></a></td>
						<td><a href="logout.php" ><img src="images/images/menubackend_08.jpg" name="Image14" width="92" height="180" border="0"></a></td>
						<td><img src="images/images/menubackend_09.jpg" width="105" height="180"></td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td align="center" height="30" style="padding:5px">
				<span style="color:#FC0; font-size:14px; text-align:center">ขอความกรุณาสมาชิกทุกท่าน อย่านำคำแปลภาษาพระเครื่องไปใช้ในเว็บไซต์อื่น แต่ท่านก็ยังสามารถนำไปใช้ในการสื่อสารทางอื่นได้เพื่อช่วยให้ท่านปิดการขายได้<br>
				ทางเว็บไซต์ praasia.com ขอสงวนสิทธิ์คำแปล หากฝ่าฝืนจะทำการปิดร้านของท่านถาวร</span>
			</td>
		</tr>
		<?php if($_GET['e_product_id']){ 
			$q="SELECT * FROM product WHERE product_id=".$_GET['e_product_id']." ";
			$db5= new nDB();
			$db5->query($q);
			$db5->next_record();
			} ?>
		<tr>
			<td height="826" style="padding:5px; background-color:#311308 ">
				<table width="100%" border="0" cellspacing="0" cellpadding="0">
					<tr>
						<td width="19%" style="border-right:1px solid #000;vertical-align: top;">
							<table width="100%" border="0" cellspacing="0" cellpadding="0">
								<tr>
									<td>
										<table width="100%" border="0" cellspacing="0" cellpadding="3">
											<tr>
												<td>
													<a href="http://www.youtube.com/watch?v=XmICm38hfQA">
														<table width="158" border="0" align="center" cellpadding="0" cellspacing="0">
															<tr>
																<td height="90" align="center" bgcolor="#FFF">
																	<span style="color:#000; font-weight:bold"><img src="images/YouTube-plate.png" width="100" height="46"><br>
																		แนะนำการลงสินค้า 
																		<br>
																		如何增加产品
																	</span>
																	<br />
																	<span style="color:#F00; font-weight:bold; font-size:14px">
																		www.praasia.com
																	</span>
																</td>
															</tr>
														</table>
													</a>
												</td>
											</tr>
											<tr>
												<td>
													<table width="150" height="187" align="center" cellpadding="0" cellspacing="0">
														<tr>
															<td align="center" style="background:url(images/post.jpg) no-repeat">
																<form name="frmPage" action="http://track.thailandpost.co.th/trackinternet/Result.aspx" method="post" target="_blank" onSubmit="return check()">
																	<table border="0" cellpadding="0" cellspacing="0" style="margin-top:95px">
																		<tr>
																			<td >
																				<input id="IDItemID" size="14" name="ItemID" class="INPUT" style="width:140">
																			</td>
																		</tr>
																		<tr>
																			<td align="center" >
																				<input value="default.asp" name="PageName" type="hidden">
																				<input value="Search" name="Submit"  type="submit">
																			</td>
																		</tr>
																		<tr>
																			<td height="30"   >
																				<a href="http://track.thailandpost.co.th/" target="_blank">
																				รายละเอียดเพิ่มเติม</a>            
																			</td>
																		</tr>
																	</table>
																</form>
															</td>
														</tr>
													</table>
												</td>
											</tr>
											<tr>
												<td align="center">
													<a href="policy.php">
														<table width="158" border="0" cellspacing="0" cellpadding="0">
															<tr>
																<td height="90" align="center" bgcolor="#CC0000"><span style="color:#FFF; font-weight:bold">กติกาการใช้งานเว็บไซต์</span><br />
																	<span style="color:#FC0; font-weight:bold; font-size:14px">www.praasia.com
																	</span>
																</td>
															</tr>
														</table>
													</a>
												</td>
											</tr>
											<tr>
												<td align="center"><img src="images/callcenter.jpg"/></td>
											</tr>
											<tr>
												<td align="center">
													<a href="http://translate.google.com" target="_blank">
														<table width="150">
															<tr>
																<td align="center" bgcolor="#FFFFFF">
																	<img src="images/Google-Translate-Logo.jpg" width="110" height="110" border="0" />
																</td>
															</tr>
														</table>
													</a>
												</td>
											</tr>
											<tr>
												<td align="center">
													<a href="http://www.paypal.com" style="color:#000" target="_blank">
														<table width="150">
															<tr>
																<td align="center" bgcolor="#FFFFFF">
																	วิธีการสมัคร<br />
																	如何注册                          <br /><img src="images/paypal-logo.png" width="100" height="53" border="0" />
																</td>
															</tr>
														</table>
													</a>
												</td>
											</tr>
											<tr>
												<td align="center">
													<a href="http://www.youtube.com/watch?v=ItioGaG_7XE" target="_blank">
														<table width="150" border="0" cellspacing="0" cellpadding="3">
															<tr>
																<td align="center" bgcolor="#FFFFFF" style="color:#000">วีธีการใช้งาน<br />
																	如何使用 <br />
																	<img src="images/paypal-s.jpg" width="150" height="42" border="0"/>
																</td>
															</tr>
														</table>
													</a>
												</td>
											</tr>
											<tr>
												<td align="center">
													<table width="150" border="0" cellspacing="0" cellpadding="3">
														<tr>
															<td align="center" bgcolor="#FFFFFF" style="font-size:12px">CALL CENTER PAYPAL<br />
																PayPal 服务中心<br />
																+6565905502<br />
																074-262615
															</td>
														</tr>
													</table>
												</td>
											</tr>
										</table>
									</td>
								</tr>
								<tr>
									<td>&nbsp;</td>
								</tr>
								<tr>
									<td>&nbsp;</td>
								</tr>
							</table>
						</td>
						<td width="81%">
							<form id="form_backend_add" action="sent_post.php" method="post" enctype="multipart/form-data" onsubmit="return FormValidation();" target="frm_post">
								<table width="100%" border="0" cellspacing="0" cellpadding="3" style="color:#FC0;">
									<tr>
										<td height="50" colspan="2" align="right" style="color:#fff;">
											<a href="?lang=th" class="btn-lang"><img src="images/lang_th.png">Thai</a>
											|
											<a href="?lang=cn" class="btn-lang"><img src="images/lang_jp.png">China</a>
										</td>
									</tr>
									<tr>
										<td height="50" colspan="2" align="center" style="color:#fff;">
											<h3><?php echo $language['Consultants_User'];?></h3>
											(Line ID : <span style="color:green;">tee99999999</span> | WeChat ID : <span style="color:green;">Tee899999</span>)
										</td>
									</tr>
									<tr>
										<td height="50" colspan="2" align="center">
											<div style="display:none;">
												<table border="0" cellpadding="0" cellspacing="0">
													<tr>
														<td>&nbsp;
														</td>
														<td style="color:#FC0;">
															<? include('translate_bo.php'); ?>
														</td>
													</tr>
												</table>
											</div>
											<span style="cursor:pointer;" onClick="translate_slide($(this));" isopen="0">
												<span class="translate_button" style="color:#F00" >คลิกสู่ระบบแปลภาษา/点击进入翻译系统... ▼</span>
												<span style="	display:none; color:#090" class="translate_button">คลิกเพื่อปิดระบบแปลภาษา/点击收回翻译系统... ▲</span>
											</span>
										</td>
									</tr>
									<tr>
										<td  style="border-bottom:1px solid #FC0; color:#FC0" height="8" colspan="2">
											วิธีการใช้แปลภาษาบนมือถือ<br> 1.ให้พิมพ์คำที่ต้องแปล    แล้วก็อปปี้วาง<br>
											2.หากไม่ใช้วิธีเขียน ก็อปปี้คำที่ต้องการ แล้ววางในช่องแปลภาษา ให้กด Inter หนึ่งครั้ง ผลลัพธ์คำแปลจะปรากฎขึ้นมา
											จากนั้นให้ก็อปปี้คำแปลวางที่ต้องการใช้งาน<br>
											3.หากผลลัพธ์การแปลไม่ปรากฎคำ กรุณานำคำแปลมาใส่ในช่องฝาก จากนั้นคำที่ฝากแปลจะใช้งานได้ภายใน24ชั่วโมง
										</td>
									</tr>
									<tr>
										<td align="right"><span style="color:#F00;padding-right:15px; ">
											<span style="color:#FC0"><?php echo $language['Text_PraCatname'];?> :</span> 
										</td>
										<td>
											<table cellpadding="0" cellspacing="0">
												<tr>
													<td>
														<select name="catalog" id="catalog" style="width:300px;">
															<option value="0">
																---เลือกหมวดหมู่สำหรับร้านค้าตนเอง / 选本店的产品分类
---
															</option>
															<?php 
																$q="SELECT * FROM catalog_shop WHERE shop_id = '".$_SESSION['adminshop_id']."' ";
																$dbcatalog= new nDB();
																$dbcatalog->query($q);
																while ($dbcatalog->next_record()) {
																 ?>
															<option value="<?=$dbcatalog->f(catalog_id)?>"
																<?php
																	if($_GET['e_product_id']){
																			if($dbcatalog->f(catalog_id)==$db5->f(catalog_id)){
																			echo 'selected="selected"';
																		}
																	}
																	?>><?=$dbcatalog->f(catalog_name)?></option>
															<? } ?>
														</select>
													</td>
													<td>
														<a class="btnaddcatalog" href="backend_catalog.php">
															<?php echo $language['Text_PraaddCatalog'];?>
														</a>
													</td>
												</tr>
											</table>
										</td>
									</tr>
									<tr>
										<td width="22%" align="right" style="color:#F00;padding-right:15px; ">
											<span style="color:#FC0">
											<?php echo $language['Text_Namepra'];?> :
											</span>
										</td>
										<td width="78%" valign="bottom" style="padding-top:3px">
											<table width="100%" border="0" cellpadding="0" cellspacing="0">
												<tr>
													<td>
														<input onKeyUp="translate_name($(this));" class="name_text" name="name" autocomplete="off" style="width:100%;" type="text" id="name" value="<?=($_GET['e_product_id'])?$db5->f(name):""?>" placeholder="ชาวต่างชาตินิยมอ่านชื่อพระ/วัด (ภาษาไทย/อังกฤษ/จีน) ">
														<div style="position:relative;">
															<div class="translate_container" style="position:absolute; width:100%; background-color:#ffffff;"></div>
														</div>
													</td>
													<td style="padding-left:10px; width:1px; color:#ffffff; white-space:nowrap;">
														<table width="157" cellpadding="0" cellspacing="0" >
															<tr>
																<td><input id="translate_checkbox" name="translate_checkbox" value="leave_name" type="checkbox"/></td>
																<td align="center">
																	<div class="btntick">
																		<?php echo $language['Text_Pratranslations'];?>
																	</div>
																</td>
															</tr>
														</table>
													</td>
												</tr>
											</table>
										</td>
									</tr>
									<tr>
										<td align="right" style="color:#FC0;padding-right:15px;">
											<?php echo $language['Text_Keyword'];?> :
										</td>
										<td>
											<div id="box_keyword">
												<?php
												if($_GET['e_product_id']){
													if($db5->f(product_keyword) <> ""){
														$explode_word = explode(",",$db5->f(product_keyword));
														foreach ($explode_word as $key => $value) {
															?>
														<div class="new_keyword">
															<input type="hidden" name="keyword_text[]" value="<?=$value;?>"/>
															<?=$value;?>
															<span class="btnclose" onclick="tag_delete($(this),'<?php echo $value?>',<?php echo $_GET['e_product_id']?>)">x</span>
														</div>
															<?
														}
													}
												}	
												?>
											</div>
											<input name="keyword" type="text" id="keyword" size="60"  onkeyUp="get_keyword(this.value);" style="height: 18px;width: 190px;margin-right: 4px;" placeholder="ป้อน keyword ให้กับสินค้าของท่าน">
										</td>
									</tr>
									<tr>
										<td colspan="2">&nbsp;</td>
									</tr>
									<tr>
										<td height="25" align="right" style="color:#FC0;padding-right:15px;">
											<?php echo $language['Text_TagSearch'];?> :
										</td>
										<td><input name="tag" type="text" id="tag" size="60"  value="<?=($_GET['e_product_id'])?$db5->f(tag):""?>" placeholder="คำศัพท์เกี่ยวกับพรเครื่องนี้ให้ Google ค้นหาเราได้ง่ายขึ้น เช่น หลวงพ่อถวต พิมพ์เป็นหล่วงปู่ถวตก็อได้" style="width: 616px;"></td>
									</tr>
									<tr>
										<td colspan="2" height="30"></td>
									</tr>
									<tr>
										<td colspan="2" style="border:1px solid #fff;padding-top:10px;">
											<table width="100%" border="0">
												<tr>
													<td height="25" align="right" style="color:#FC0;padding-right:15px;width: 147px;">
														<?php echo $language['Text_CatRegion'];?> :
													</td>
													<td>
														<?php
														if($_GET["lang"] == "cn"){
															$lang_Rigion = '_cn';
														}else{
															$lang_Rigion = '';
														}
														?>
														<select name="main_id" onchange="get_CategoryData(this.value,'<?php echo $lang_Rigion;?>')" style="width: 445px;">
															 <option value="0">--<?php echo $language['Text_SelectCatRegion'];?>--</option>
															<?php
																$qmain = mysql_query("SELECT * FROM twe_category_main WHERE active = 2 order by order_num asc");
																while ( $rmain = mysql_fetch_array($qmain)) {
																	?>
															<option value="<?=$rmain['main_id']?>" <?php if($_GET['e_product_id']){if($rmain['main_id'] == $db5->f(main_id)){echo "selected";}}?>><?=$rmain['main_name'.$lang_Rigion]?></option>
																	<?php
																}
															?>
														</select>
													</td>
												</tr>
												<tr>
													<td height="25" align="right" style="color:#FC0;padding-right:15px;">
														<?php echo $language['Text_CatRegionSub'];?> :
													<td>

														<select name="pra_category_id" style="width: 445px;" onchange="pra_categorytousually(this.value,'<?php echo $lang_Rigion;?>');">
                                                        
															<option value="0">--<?php echo $language['Text_SelectCatRegionSub'];?>--</option>
															<?php
															if($_GET['e_product_id']){
																$qcategory_e = mysql_query("SELECT * FROM twe_category WHERE main_id = ".$db5->f(main_id)." ORDER BY catalog_id DESC  ");
																while ( $rcategory_e = mysql_fetch_array($qcategory_e)) {
																	?>         
															<option value="<?php echo $rcategory_e['catalog_id'];?>" <?php if($_GET['e_product_id']){if($rcategory_e['catalog_id']==$db5->f(main_id)){echo 'selected="selected"';}}?>><?php echo $rcategory_e['catalog_name'.$lang_Rigion];?></option>
																	<?php
																}
															}
															?>
														</select>
														<!-- <a href="javascript:void(0);" onclick="add_category($(this));" class="btn-addcategory"><?php echo $language['Text_Add'];?></a> -->
														<!-- <span style="display:none;">
															<input name="category_name" type="text" id="category_name">
															<input type="button" value="<?php echo $language['Text_OK'];?>" onclick="add_usually();">
															<input type="button" value="<?php echo $language['Text_Cancel'];?>" onclick="$(this).parent().hide();">
														</span> -->
														<div style="
																display:none;
																padding: 8px 0 0;
																overflow: hidden;
														">
															<table border="0" align="left" cellpadding="0" cellspacing="0">
																<tr>
																	<td><input name="newCatname" type="text" id="newCatname" placeholder="<?php echo ($_SESSION["current_language"] == "th")?'ชื่อหมวด':'佛牌名';?>"></td>
																	<td><input name="newCatMeasure" type="text" id="newCatMeasure" placeholder="<?php echo ($_SESSION["current_language"] == "th")?'ชื่อวัด':'寺名';?>"></td>
																	<?php if($_SESSION["current_language"] == "th"){?>
																	<td>

																		<select name="newCatPorvince">
																			<?php
																			$provinceQ = mysql_query("SELECT * FROM `province` ORDER BY province_name ASC");
																			while ( $provinceResult = mysql_fetch_array($provinceQ)) {?>
																				<option value="<?php echo array_shift(array_values(explode("/",$provinceResult['province_name'])));?>"><?php echo array_shift(array_values(explode("/",$provinceResult['province_name'])));?></option>
																			<?php }?>
																		</select>

																	</td>
																	<?php }?>
																	<td>
																		<input type="button" value="<?php echo $language['Text_OK'];?>" onclick="add_usually('<?php echo $lang_Rigion;?>');">
																	</td>
																	<td>
																		<input type="button" value="<?php echo $language['Text_Cancel'];?>" onclick="$(this).parent().parent().parent().parent().parent().hide();">
																	</td>
																</tr>
															</table>
														</div>

													</td>
												</tr>
												<tr>
													<td height="25" align="right" style="color:#FC0;padding-right:15px;"><?php echo $language['Text_SubCatRegular'];?>:</span></td>
													<td>

														<div class="box-usually">
															<ul>
																<?php
																
																	$result_usually = mysql_fetch_array(mysql_query("SELECT * FROM twe_category_usually WHERE member_id = '".$_SESSION['member_id']."'  "));
																	$qcategory = mysql_query("SELECT * FROM twe_category WHERE catalog_id IN (".$result_usually['catalog_id'].")  ORDER BY catalog_id DESC ");
																	while ( $rcategory_e = mysql_fetch_array($qcategory)) {

																		$text_checked = '';

																		if(isset($_GET['e_product_id'])){

																			$catalog_id = $rcategory_e['catalog_id'];
																			$group_category_id = explode(",", $db5->f(group_category_id));

																			if (in_array($catalog_id, $group_category_id)) {
																				$text_checked = 'checked="checked"';
																			}
																		}

																		?>
																<li>
																	<input  type="checkbox" name="usually[]" value="<?=$rcategory_e['catalog_id']?>" 
																		<?php echo $text_checked;?>><?=$rcategory_e['catalog_name'.$lang_Rigion]?>
																	<a href="javascript:void(0);" onclick="del_usually(<?=$rcategory_e['catalog_id']?>,$(this));">
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
										<td colspan="2" height="30"></td>
									</tr>
									<tr>
										<td colspan="2" height="25" align="center">
											<span style="color:#FC0;line-height: 22px;">
											กรุณาใส่ภาษาอังกฤษเป็นภาษาทับศัพท์ในหมวดสินค้าด้วยครับ ตัวอย่าง หลวงพ่อ/Lp วัด/wat รุ่น 1..2..3/roon 1..2..3 พ.ศ./B.E. ที่เหลืออื่นท่านสามารถใช้แปลกับgoogle หรือระบบฝากแปลภาษาโดยตรงกับpraasiaก็ได้เช่นกันครับ
											</span>
										</td>
									</tr>
									<tr>
										<td colspan="2" align="center" style="color:#FC0;padding-right:15px;"><span style="color:#FC0;padding-right:15px; padding-top:20px;font-size: 14px;">รายละเอียดพระเครื่อง <span style="color:#F00"> / 产品详容 :</span></span></td>
									</tr>
									<tr>
										<td height="142" colspan="2" align="center" style="color:#FC0;padding-right:15px; padding-top:20px">
											<textarea name="detail" rows="5" id="detail" style="height:100px; overflow:hidden; width:450px"><?=($_GET['e_product_id'])?$db5->f(detail):""?></textarea>		      
										</td>
									</tr>
									<script>
										CKEDITOR.replace( 'detail', {
											filebrowserBrowseUrl : 'ckfinder/ckfinder.html',
											filebrowserImageBrowseUrl : 'ckfinder/ckfinder.html?type=Images',
											filebrowserFlashBrowseUrl : 'ckfinder/ckfinder.html?type=Flash',
											filebrowserFlashUploadUrl : 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash'
										});
									</script>
									<tr>
										<td colspan="2" style="color:#FC0" class="autocomplete_cls">
											<table width="100%" border="0" cellspacing="0" cellpadding="3" style="color:#FC0; border:1px solid #f5f5f5;">
												<tr>
													<td colspan="2" class="autocomplete_cls" style="padding:10px; text-align:center; font-size:16px; color:#ff0000; border-bottom:1px solid #f5f5f5;" >
														เขียนได้เฉพาะคำ เช่น ชื่อพระเขียนได้เฉพาะ หลวงพ่ออะไร หรือ อาจารย์อะไร ทุกคำลงได้เฉพาะภาษาจีนหรือภาษาอังกฤษเท่านั้น หากช่องใหนไม่มีข้อมูลให้ยกเว้นได้
														<span style="color:#fc0;">
														/ 如哪个项目没有资料，可以免填
														</span>
													</td>
												</tr>
												<tr>
													<td width="36%" align="right" style="color:#FC0"><?php echo $language['Text_Praname3'];?> :</td>
													<td width="64%">
														<input name="namepra" value="<?=($_GET['e_product_id'])?$db5->f(detailcn1):''?>" onKeyUp="namepra_search($(this).val());" type="text" id="namepra" style="width:200px;" placeholder="ค้นหาชื่อพระจีนหรืออังกฤษ">
														<div style="position:relative;">
															<div class="namepra_container" style="position:absolute;"></div>
														</div>
														<span style="color:#008800;">
														หากคำใหนไม่มีสามารถแปลได้ที่กูเกิ้ลแปลภาษาหรือระบบแปลภาษาด้านล่าง
														</span>
													</td>
												</tr>
												<tr>
													<td align="right" style="color:#FC0"><?php echo $language['Text_Praname_x2'];?> :</td>
													<td style="color:#FC0">
														<?php
														if($_GET['e_product_id']){
															$result_mass = mysql_fetch_array(mysql_query("SELECT * FROM catalog_cn WHERE catalog_id = '".$db5->f(detailcn2)."' "));	
														}
														?>
														<input name="mass" type="hidden" value="<?=$result_mass['catalog_name_cn']?>"/>
														<input name="mass_name" value="<?=($_GET['e_product_id'])?$result_mass['catalog_name']:''?>" onKeyUp="mass_search($(this).val());" type="text" style="width:200px;" placeholder="ค้นหาชื่อมวลสาร">
														<div style="position:relative;">
															<div class="mass_container" style="position:absolute;"></div>
														</div>
													</td>
												</tr>
												<tr>
													<td align="right" style="color:#FC0"><?php echo $language['Text_Praframe'];?> :</td>
													<td style="color:#FC0">
														<select name="frame" id="frame">
															<option value="0">
																---ไม่แสดง---
															</option>
															<?php 
																$q="SELECT * FROM catalog_cn WHERE top_id= '4' ";
																$dbmix= new nDB();
																$dbmix->query($q);
																while ($dbmix->next_record()) {
																 ?>
															<option value="<?=$dbmix->f(catalog_id)?>"
																<?php if($_GET['e_product_id']){if($dbmix->f(catalog_id)==$db5->f(detailcn4)){echo 'selected="selected"';}}?> >
																<?=$dbmix->f(catalog_name)?>
															</option>
															<? } ?>
														</select>
													</td>
												</tr>
												<tr>
													<td align="right" style="color:#FC0"><?php echo $language['Text_Praroom'];?> :</td>
													<td style="color:#FC0">
														<?php
														if($_GET['e_product_id']){
															$result_room = mysql_fetch_array(mysql_query("SELECT * FROM catalog_cn WHERE catalog_id = '".$db5->f(detailcn5)."' "));	
														}
														?>
														<input name="roon" type="hidden" value="<?=$result_room['catalog_id']?>"/>
														<input name="roon_name" value="<?=($_GET['e_product_id'])?$result_room['catalog_name_cn']:''?>" onKeyUp="roon_search($(this).val());" type="text" style="width:200px;" placeholder="ค้นหาชื่อรุ่น">
														<div style="position:relative;">
															<div class="roon_container" style="position:absolute;"></div>
														</div>
													</td>
												</tr>
												<tr>
													<td align="right" style="color:#FC0"><?php echo $language['Text_Prapim'];?> :</td>
													<td style="color:#FC0">
														<?php
														if($_GET['e_product_id']){
															$result_pim = mysql_fetch_array(mysql_query("SELECT * FROM catalog_cn WHERE catalog_id = '".$db5->f(detailcn6)."' "));	
														}
														?>
														<input name="pim" type="hidden" value="<?=$result_pim['catalog_id']?>"/>
														<input name="pim_name" value="<?=($_GET['e_product_id'])?$result_pim['catalog_name']:''?>" onKeyUp="pim_search($(this).val());" type="text" style="width:200px;" placeholder="ค้นหาชื่อพิมพ์">
														<div style="position:relative;">
															<div class="pim_container" style="position:absolute;"></div>
														</div>
													</td>
												</tr>
												<tr>
													<td align="right" style="color:#FC0"><?php echo $language['Text_PraCondition'];?> :</td>
													<td style="color:#FC0">
														<select name="condition" id="condition">
															<option value="0">
																---ไม่แสดง---
															</option>
															<?php 
																$q="SELECT * FROM catalog_cn WHERE top_id= '7' ";
																$dbmix= new nDB();
																$dbmix->query($q);
																while ($dbmix->next_record()) {
																 ?>
															<option value="<?=$dbmix->f(catalog_id)?>"
																<?php if($_GET['e_product_id']){ if($dbmix->f(catalog_id)==$db5->f(detailcn7)){echo 'selected="selected"'; } }?>>
																<?=$dbmix->f(catalog_name)?>
															</option>
															<? } ?>
														</select>
													</td>
												</tr>
												<tr>
													<td align="right" style="color:#FC0"><?php echo $language['Text_Prasize'];?> :</td>
													<td style="color:#FC0">
														<select name="size" id="size">
															<option value="">
																---ไม่แสดง---
															</option>
															<?php 
																$q="SELECT * FROM catalog_cn WHERE top_id= '8' ";
																$dbmix= new nDB();
																$dbmix->query($q);
																while ($dbmix->next_record()) {
																 ?>
															<option value="<?=$dbmix->f(catalog_name_cn)?>" <?php if($_GET['e_product_id']){if($dbmix->f(catalog_name)==$db5->f(detailcn8)){echo 'selected="selected"';}}?>>
																<?=$dbmix->f(catalog_name)?>
															</option>
															<? } ?>
														</select>
													</td>
												</tr>
												<tr>
													<td align="right" style="color:#FC0"><?php echo $language['Text_Prawat'];?> :</td>
													<td style="color:#FC0">
														<input name="wat" value="<?=($_GET['e_product_id'])?$db5->f(detailcn9):''?>" onKeyUp="wat_search($(this).val());" type="text" id="wat" style="width:200px;" placeholder="ค้นหาชื่อวัดจีนหรืออังกฤษ">
														<div style="position:relative;">
															<div class="wat_container" style="position:absolute;"></div>
														</div>
													</td>
												</tr>
												<tr>
													<td align="right" style="color:#FC0"><?php echo $language['Text_Prageji'];?> :</td>
													<td style="color:#FC0">
														<input name="geji" value="<?=($_GET['e_product_id'])?$db5->f(detailcn10):''?>" onKeyUp="geji_search($(this).val());" type="text" id="geji" style="width:200px;" placeholder="ค้นหาชื่อพระเกจิจีนหรืออังกฤษ">
														<div style="position:relative;">
															<div class="geji_container" style="position:absolute;"></div>
														</div>
													</td>
												</tr>
												<tr>
													<td align="right" style="color:#FC0"><?php echo $language['Text_Prayear'];?> :</td>
													<td style="color:#FC0">
														<select name="year" id="year">
															<option value="0">
																---ไม่แสดง---
															</option>
															<?php
																$q = "SELECT * FROM catalog_cn WHERE top_id = '11' ";
																$db_ps= new nDB();
																$db_ps->query($q);
																while ($db_ps->next_record()) {
																?>
															<option value="<?=$db_ps->f(catalog_id)?>"
																<?php
																	if($_GET['e_product_id']){
																		if($db_ps->f(catalog_id)==$db5->f(detailcn11)){
																			echo 'selected="selected"';
																		}
																	}
																	?>
																>
																<?=$db_ps->f(catalog_name)?>
															</option>
															<? } ?>
														</select>
													</td>
												</tr>
												<tr>
													<td align="right" style="color:#FC0"><?php echo $language['Text_Prauserfull'];?> :</td>
													<td style="color:#FC0;">
														<table border="0" cellpadding="0" cellspacing="0">
															<?php
																if($_GET['e_product_id']){
																	$detailcn12_array = explode("|",$db5->f(detailcn12));
																}
																
																$q = "SELECT * FROM catalog_cn WHERE top_id = '12' limit 0,3";
																$dbmix= new nDB();
																$dbmix->query($q);
																while ($dbmix->next_record()){
																?>
															<tr>
																<td>
																	<input name="useful[]" <?php if($_GET["e_product_id"]){ if( in_array($dbmix->f("catalog_id"), $detailcn12_array) ){ echo "checked='checked'"; } } ?> id="useful_<?=$dbmix->f(catalog_id)?>" value="<?=$dbmix->f(catalog_id)?>" type="checkbox"/>
																</td>
																<td style="color:#FC0;">
																	<label for="useful_<?=$dbmix->f(catalog_id)?>">
																	<?=$dbmix->f(catalog_name)?>
																	</label>
																</td>
															</tr>
															<?php
																}
																?>
														</table>
														<div style="display:none;">
															<table border="0" cellpadding="0" cellspacing="0">
																<?php 
																	$q = "SELECT * FROM catalog_cn WHERE top_id = '12' limit 3,100";
																	$dbmix= new nDB();
																	$dbmix->query($q);
																	while ($dbmix->next_record()){
																	?>
																<tr>
																	<td>
																		<input name="useful[]" <?php if($_GET["e_product_id"]){ if( in_array($dbmix->f("catalog_id"), $detailcn12_array) ){ echo "checked='checked'"; } } ?> id="useful_<?=$dbmix->f(catalog_id)?>" value="<?=$dbmix->f(catalog_id)?>" type="checkbox"/>
																	</td>
																	<td style="color:#FC0;">
																		<label for="useful_<?=$dbmix->f(catalog_id)?>">
																		<?=$dbmix->f(catalog_name)?>
																		</label>
																	</td>
																</tr>
																<?php
																	}
																	?>
															</table>
														</div>
														<span style="cursor:pointer;" onClick="cn_slide($(this));" isopen="0">
															<span style="color:#ff0000;">พุทธคุณเพิ่มเติม / 更多... ▼</span>
															<span style="color:#00ff00; display:none;">พุทธคุณเพิ่มเติม / 更多... ▲</span>
														</span>
													</td>
												</tr>
											</table>
										</td>
									</tr>
									<tr>
										<td colspan="2" height="49" align="center" style="color:#FC0; white-space:nowrap;">
											<?php echo $language['Text_Praprice'];?> :
											<input style="width:300px;" name="price" type="text" id="price" value="<?=($_GET['e_product_id'])?$db5->f(price):""?>">
											&nbsp;&nbsp;
											<?php echo $language['Text_Prastatus'];?> :
											<select name="status" id="status" style="width:300px;">
												<option value="1" <?php if ($_GET['e_product_id']) { if ($db5->f(status)==1) {echo 'selected="selected"';}}?>>พระโชว์ / 展示</option>
												<option value="2" <?php if ($_GET['e_product_id']) { if ($db5->f(status)==2) {echo 'selected="selected"';}}?>>ให้เช่า / 出售</option>
												<option value="3" <?php if ($_GET['e_product_id']) { if ($db5->f(status)==3) {echo 'selected="selected"';}}?>>เปิดจอง / 预定</option>
												<option value="4" <?php if ($_GET['e_product_id']) { if ($db5->f(status)==4) {echo 'selected="selected"';}}?> >จองแล้ว / 已定</option>
												<option value="5" <?php if ($_GET['e_product_id']) { if ($db5->f(status)==5) {echo 'selected="selected"';}}?>>ขายแล้ว / 已出售</option>
											</select>
										</td>
									</tr>
									<tr style="display:none;">
										<td height="20" colspan="2" align="center" style="padding-top:18px"> 
											<span style="color:#FC0"> เพิ่มช่องทางการโชว์สินค้าในหมวดสินค้าของท่าน </span><span style="color:#F00"> / 再增加佛牌的展示区</span>
										</td>
									</tr>
									<tr>
										<td height="166" colspan="2" class="autocomplete_cls">
											<table width="100%" border="1" bordercolor="#9f968d" cellspacing="0" cellpadding="3">
												<tr style="display:none;">
													<td width="33%" height="35" align="right" style="color:#FC0;padding-right:15px;">
														หมวดหมู่สินค้า <span style="color:#F00">/ 产品名类型 :</span>
													</td>
													<td width="67%">
														<select name="catalogpra" id="catalogpra" style="width:200px">
															<option value="0">
																-- เลือกหมวดหมู่สินค้า/ 选产品名类型 --
															</option>
															<?php
																$q="SELECT * FROM catalog_all WHERE top_id =0 ORDER BY catalog_id ";
																$db->query($q);
																while($db->next_record()){
																?>
															<option value="<?=$db->f(catalog_id)?>">
																<span style="font-weight:bold"><?=$db->f(catalog_name)?></span>
															</option>
															<?php
																$q1="SELECT * FROM catalog_all WHERE top_id=".$db->f(catalog_id)." ";
																$db7=new nDB();
																$db7->query($q1);
																if($db7->num_rows()!=0){
																while($db7->next_record()){
																?>
															<option value="<?=$db7->f(catalog_id)?>" <?php if ($_GET['e_product_id']) { if ($db7->f(catalog_id)==$db->f(catalog_id)) {echo 'selected="selected"';}}?>>---
																<?=$db7->f(catalog_name)?>
															</option>
															<?php } } } ?>
														</select>
													</td>
												</tr>
												<?php
													$conn = mysql_connect("localhost","prathai_new","twe31219#");
													mysql_select_db("prathai_new",$conn);
													mysql_query("SET NAMES UTF8");
													mysql_query("SET character_set_results=utf8");
													mysql_query("SET character_set_client=utf8");
													mysql_query("SET character_set_connection=utf8");
													?>
												<script>
													function select_geo(x_this){
														var v_this = x_this.val();
														$(".province_select option:eq(0)").prop("selected","selected");
														$(".catalog_select option:eq(0)").prop("selected","selected");
														$(".province_select").find(".province_option").remove();
														$(".province_select").append( $(".province_option_container").find(".province_"+v_this).clone(true) );
													}
													function select_province(x_this){
														var v_this = x_this.val();
														$(".catalog_select option:eq(0)").prop("selected","selected");
														$(".catalog_select").find(".catalog_option").remove();
														$(".catalog_select").append( $(".catalog_option_container").find(".catalog_"+v_this).clone(true) );
													}
												</script>
												<tr>
													<td height="35" align="right" style="color:#FC0;">
														<?php echo $language['Text_PraType'];?> :
													</td>
													<td style="color:#FC0;">
														<select name="release" id="release">
															<option value="0" selected="selected">--เลือกประเภทพระเครื่อง/选择佛牌年代类型--</option>
															<option value="1" <?php if($_GET['e_product_id']){if( "1" == $db5->f(prarelease) ){echo 'selected="selected"';}}?>>พระเก่า / 老牌</option>
															<option value="2" <?php if($_GET['e_product_id']){ if( "2" == $db5->f(prarelease) ){echo 'selected="selected"';}}?>>พระใหม่ / 新牌</option>
														</select>
														<br>
														<span style="color:#0C0">พระเก่า </span>คือ พระเครื่องก่อนปี 2530 <span style="color:#F00">/ 佛历2530年前的佛牌区是</span><span style="color:#0C0"> 老牌</span>
														<br>
														<span style="color:#0C0">พระใหม่ </span>คือ พระเครื่องหลังปี 2530<span style="color:#F00"> / 佛历2530年后的佛牌区是 </span><span style="color:#0C0">新牌</span>
													</td>
												</tr>
												<tr>
													<td height="35" align="right" style="color:#FC0;">
														<?php echo $language['Text_Pracertificate'];?> :
													</td>
													<td>
														<?php
															$check_condition_1 = "";
															if($_GET['e_product_id']){
																if($db5->f(certificate) == 1){
																	$check_condition_1 = "checked";
																}
															}
														?>
														<input name="certificate" type="checkbox" id="certificate" value="1" <?=$check_condition_1;?>>
														<label for="certificate">
															<span style="color:#FC0">
																<?php echo $language['Text_PracertificateCheck'];?>
															</span>
														</label>
													</td>
												</tr>
												<tr>
													<td height="33" align="right" 	style="color:#FC0">
														<?php echo $language['Text_Pranewbook'];?> :
													</td>
													<td>
														<?php
															$check_condition_2 = "";
															if($_GET['e_product_id']){
																if($db5->f(watprice) == 1){
																	$check_condition_2 = "checked";
																}
															}
														?>
														<input name="watprice" type="checkbox" id="watprice" value="1" <?=$check_condition_2;?>> 
														<label for="watprice">
														<span style="color:#FC0"> 
															<?php echo $language['Text_PraattachRates'];?>
														</label>
													</td>
												</tr>
												<tr>
													<td height="33" align="right" style="color:#FC0">
														<?php echo $language['Text_Pramiscellaneous'];?> :
													</td>
													<td>
														<?php
															$check_condition_3 = "";
															if($_GET['e_product_id']){
																if($db5->f(other) == 1){
																	$check_condition_3 = "checked";
																}
															}
														?>
														<input name="other" type="checkbox" id="other" value="1" <?=$check_condition_3;?>> 
														<label for="other">
															<span style="color:#FC0">
																<?php echo $language['Text_PraConditoinas'];?>
															</span>
														</label>
													</td>
												</tr>
												<tr>
													<td height="33" align="right" style="color:#FC0">
														สินค้าสำหรับสมาชิก :
													</td>
													<td>
														<?php
															$showtype = "";
															if($_GET['e_product_id']){
																if($db5->f(showtype) == 1){
																	$showtype = "checked";
																}
															}
														?>
														<input name="showtype" type="checkbox" id="other" value="1" <?=$showtype;?>> 
														<label for="showtype">
														</label>
													</td>
												</tr>                                                
											</table>
										</td>
									</tr>
									<tr>
										<td height="33" colspan="2" align="center">
											<span style="color:#FC0;font-weight:bold">ขนาดภาพที่เหมาะสมกว้างไม่เกิน 900 pixels และขนาดของภาพไม่ควรใหญ่เกิน 200 kb 图片宽度 900 pixels 不超过200kb</span>
											<br>
											<span style="color:#FC0;font-weight:bold">ไฟล์ที่รองรับ .jpg | .png | .gif เท่านั้น กรุณาตรวจสอบชื่อไฟล์ไม่ให้มีตัวอักษรพิเศษ เช่น . * / # + </span>
										</td>
									</tr>
									<tr>
										<td colspan="2">
											<table width="100%" border="1" bordercolor="#9f968d" cellpadding="0" cellspacing="0">
												<tr>
													<td height="35" align="right" style="color:#FC0;padding-right:15px;">
														<?php echo $language['Text_Prapic1'];?> :
													</td>
													<td style="color:#FC0;"><input name="file1" type="file" id="file1">
														<?php if($_GET['e_product_id']){ ?>						
														<img src="<?=($db5->f(pic1)!="")?"/slir/w20-h20/img/amulet/".$db5->f(pic1):"/images/clear.gif"?>" width="20" height="18"  border="0" /> 
														<? } ?>
														<span style="color:#090">
															<?php echo $language['Text_PrapicRequired'];?>
														</span> 
													</td>
												</tr>
												<tr>
													<td height="32" align="right" style="color:#FC0;padding-right:15px;">
													 <?php echo $language['Text_Prapic2'];?> :
													</td>
													<td style="color:#FC0;"><input name="file2" type="file" id="file2">
														<?php if($_GET['e_product_id']){ ?>						
														<img src="<?=($db5->f(pic2)!="")?"/slir/w20-h20/img/amulet/".$db5->f(pic2):"/images/clear.gif"?>" width="20" height="18"  border="0" /> 
														<? } ?> 
													</td>
												</tr>
												<tr>
													<td height="34" align="right" style="color:#FC0;padding-right:15px;">
														<?php echo $language['Text_Prapic3'];?> :
													</td>
													<td style="color:#FC0;"><input name="file3" type="file" id="file3">
														<?php if($_GET['e_product_id']){ ?>						
														<img src="<?=($db5->f(pic3)!="")?"/slir/w20-h20/img/amulet/".$db5->f(pic3):"/images/clear.gif"?>" width="20" height="18"  border="0" /> 
														<? } ?> 
													</td>
												</tr>
												<tr>
													<td height="35" align="right" style="color:#FC0;padding-right:15px; font-weight:bold">
														<?php echo $language['Text_Prapic4'];?> :
													</td>
													<td style="color:#FC0;"><input name="file4" type="file" id="file4">
														<?php if($_GET['e_product_id']){ ?>						
														<img src="<?=($db5->f(pic4)!="")?"/slir/w20-h20/img/amulet/".$db5->f(pic4):"/images/clear.gif"?>" width="20" height="18"  border="0" /> 
														<? } ?> 
													</td>
												</tr>
											</table>
										</td>
									</tr>
									<tr>
										<td height="33" colspan="2" align="center">
											<input name="do_what" type="hidden" id="do_what" value="<?php echo ($_GET['e_product_id'])?'edit':'insert';?>" />
											<input name="submit" type="submit" id="submit" value="<?php echo ($_GET['e_product_id'])?$language['Text_PraSubmitEdit']:$language['Text_PraSubmit'];?>" /> 
											<?php if($_GET['s_page']){ ?>
											<input type="hidden" name="s_page" value="<?=$_GET['s_page']?>">
											<?php } ?>
											<?php if($_GET['e_product_id']){ ?>
											<input name="h_product_id" type="hidden" id="h_product_id" value="<?=$db5->f(product_id)?>" />
											<input name="h_pic1" type="hidden" id="h_pic1" value="<?=$db5->f(pic1)?>">
											<input name="h_pic2" type="hidden" id="h_pic2" value="<?=$db5->f(pic2)?>">
											<input name="h_pic3" type="hidden" id="h_pic3" value="<?=$db5->f(pic3)?>">
											<input name="h_pic4" type="hidden" id="h_pic4" value="<?=$db5->f(pic4)?>">                  
											<?php } ?>
										</td>
									</tr>
								</table>
							</form>
							<iframe src="" name="frm_post" width="1px" height="0px" frameborder="0" id="frm_post"></iframe>
						</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td height="40" align="center" bgcolor="#333333">
				<?php include('footer.php');?>
			</td>
		</tr>
	</table>
</body>
</html>
