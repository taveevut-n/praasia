<?php
	include('../global.php');
?>
<?php if($_SESSION['adminid']=='' || !isset($_SESSION['adminid'])) {  
	redi4("login.php");
} ?>
<?php //set_page($s_page,$e_page=20); //นำส่วนนี้ิไว้ด้านบน ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<title>ระบบจัดการเว็บไซต์</title>
		<style type="text/css">
			html,body{
				font-size: 13px;
				font-family: Tahoma, Geneva, sans-serif;
			}
			body {
				background-color: #000;
				margin: 0;
			}
			.bh{
				color:#FC0;
				height:30px;
			}
			.sidemenu{
				color:#FFF;
				font-size:12px;
				height:25px;
				text-decoration:none;
			}
			.sidemenu:hover{
				text-decoration:none;
			}
			a:link {
				text-decoration: none;
			}
			a:visited {
				text-decoration: none;
			}
			a:hover {
				text-decoration: none;
			}
			a:active {
				text-decoration: none;
			}
			input[type="text"]{
				height: 16px;
			}
			button{
				font-size: 12px;
			}
			/*pagination*/
			#data-pagination {
				overflow: hidden;
				margin: 40px 0;
				color: #FFFFFF;
			}
			#data-pagination>a {
				display: inline-block;
		    background-color: #A8A5A3;
		    font-size: 12px;
		    line-height: 25px;
		    text-decoration: none;
		    color: #2D2C2D;
		    font-weight: 700;
		    padding: 0 8px;
		    border-radius: 1px;
			}
			#data-pagination>a.navidisabled {
				background-color: #C4C7C4;
				color: #3A3535;
				opacity: 0.3;
			}
			#data-pagination>a.navi-seleted{
				background-color: #474544;
				color: #FFF;
			}
			#data-pagination>a.navi-dot{
				background-color: transparent;
			  color: #FFFFFF;
			  border: 0;
			  outline: 0;
			}
			.box-qty-form{
				display: inline-block;
			  position: relative;
			  top: 11px;
			  left: 30px;
			}
			.box-qty-form b{
				  margin-right: 5px;
			}
			.box-qty{
				padding: 0;
		    margin: 0;
		    position: relative;
		    display: block;
		    background-color: #B24D1F;
		    width: 98px;
		    border: 1px solid #B24D1F;
		    overflow: hidden;
			}
			.box-qty>input{
				margin:0;
				padding: 0;
				text-align: center;
				width: 50px;
				border:0;
				outline: 0;
				height: 28px;
				display: inline-block;
				background-color: #FFFFFF;
			}
			.box-qty>button{
				border:0;
				outline: 0;
				background-color: transparent;
				color: #ffffff;
			}
		</style>
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
	</head>
	<body>
		<?php
			if($_GET['d_product_id']){
				@unlink("img/amulet/".$_GET['pic1']);
				@unlink("img/amulet/".$_GET['pic2']);		
				@unlink("img/amulet/".$_GET['pic3']);		
				@unlink("img/amulet/".$_GET['pic4']);						
				$q="DELETE FROM `product` WHERE `product_id` = ".$_GET['d_product_id']." ";
				$db->query($q);		
			}
			?>
		<?php
			if($_GET['hot_id']){
				$q="update `product` set hot='".$_GET['status']."' WHERE `product_id` =".$_GET['hot_id']." ";
				$db->query($q);
				//redi2("product.php?s_page=".$_GET['s_page']);				
				echo "<script>window.location.href='product.php?s_page=".$_GET['s_page']."';</script>";
			}
			?>	
		<?php
			if($_GET['certificate_id']){
				$q="update `product` set certificate='".$_GET['status']."' , `certificatedate` = '".date("Y-m-d H:i:s")."' WHERE `product_id` =".$_GET['certificate_id']." ";
				$db->query($q);
				//redi2("product.php?s_page=".$_GET['s_page']);		
				echo "<script>window.location.href='product.php?s_page=".$_GET['s_page']."';</script>";
			}
			?>	
		<?php
			if($_GET['recommend_id']){
				$q="update `product` set recommend='".$_GET['status']."' , `hotdate` = '".date("Y-m-d H:i:s")."' WHERE `product_id` =".$_GET['recommend_id']." ";
				$db->query($q);
				//redi2("product.php?s_page=".$_GET['s_page']);		
				echo "<script>window.location.href='product.php?s_page=".$_GET['s_page']."';</script>";
			}
			?>	
		<table width="1000" border="0" align="center" cellpadding="0" cellspacing="0">
			<tr>
			<td><img src="/admin/images/head.jpg" width="1098" height="288" /></td>
			</tr>
			<tr>
			<td bgcolor="#311407">
				<table width="100%" border="0" cellspacing="3" cellpadding="0">
					<tr>
						<td width="250" valign="top" ><? include('sidemenu.php') ?></td>
						<td valign="top" bgcolor="#3f1d0e">
						<form action="" method="get">
							<table width="95%" align="center" cellpadding="3" cellspacing="0">
								<tr>
                                	<td align="right">
																		<script language="javASCript">
																			function selec(){
																				var ab=document.getElementById('se');
																				location.href=ab.value;
																			}
																		</script>
																		<span style="color:#ffffff;">เลือกรายการจัดการ :</span> 
																		<select name="select" onchange="selec();" id="se" style="height: 21px;">
																		  <option value="">--------กรุณาเลือกรายการ--------</option>
																			<option value="catalog_cert.php">หมวดหม่พระที่ออกบัตร</option>
                                                                            <option value="datacertificate.php">เพิ่มข้อมูลพระที่ออกบัตร</option>
                                                                            <option value="content_group.php">ย้ายหมวดหมู่</option>
																			<option value="checkcertificate.php">ข้อมูลพระที่ออกบัตร เพิ่มที่ปรึกษา</option>	
                                                                            <option value="admin_checklist_certificate.php">ดูรายการทั้งหมด</option>											
																	  </select>                                      
                                    </td>
                              </tr>
                              <tr>
									<td align="center" bgcolor="#692908">
										<span class="sidemenu">ค้นหา 
											<?php
											if(isset($_GET["page"])){
												echo '<input name="page" type="hidden"value="'.$_GET['page'].'" />';
											}
											?>
											<input name="q" type="text" id="q" size="60" value="<?php echo $_GET['q'];?>" /> 
											<input type="submit" value="ค้นหา" /></span>
										</td>
								</tr>
							</table>
						</form>
						<style type="text/css">
							.box-checkbox{
								display: block;
								position: absolute;
								top:0;
								left: 0;
							}
							.clear-both{
								clear: both;
							}
						</style>
						<div class="clear-both"></div>
						<table width="95%" align="center" cellpadding="3" cellspacing="0">
							<tr>
								<td align="right" height="30"></td>
							</tr>
							<tr>
								<td align="right">
									<span class="sidemenu">
										<button type="button" onclick="product_group();">ย้ายไปยังหมวดหมู่</button>
										<select name="catalog_val" onchange="$(this).parent().submit();" style="min-width:200px;height: 21px;">
											<option value="0">---เลือกหมวดหมู่---</option>
											<?php
												$qgroup = mysql_query("select * from catalog_cert where top_id = '0' order by catalog_id asc");
												while ( $r = mysql_fetch_array($qgroup)) {
													?>
													<optgroup label="<?php echo $r['catalog_name'];?> / <?php echo $r['catalog_name_cn'];?>">
													<?php
													$qcat_sub = mysql_query("select * from catalog_cert where top_id = ".$r['catalog_id']." order by catalog_id");
													while ( $r_sub = mysql_fetch_array($qcat_sub)) {
														?>
													<option value="<?php echo $r_sub['catalog_id'];?>"><?php echo $r_sub['catalog_name'];?></option>
														<?php
													}
												}
											?>
										</select>
									</span>
									<script type="text/javascript">
										function product_group(){
											var catalog_val = $("select[name=catalog_val]");
											if($("input[name='item[]']").is(':checked')){
												if(catalog_val.val() != 0){
													var arr = [];
													$("input[name='item[]']:checked").each(function(index,item){
														arr[index] = item.value;
													});
													// console.log(arr,catalog_val.val())
													$.ajax({
														url: "content_query.php",
														type: "POST",
														data: {do_what:"product_group",v: arr,catalog_val:catalog_val.val()},
														cache: false,
														processData: true,
														success: function (result) {
															location.reload();
														}
													});
												}
												else{
													alert('กรุณาเลือกหมวดหมู่ที่ท่านต้องการ !!');
												}
											}else{
												alert('กรุณาเลือกสินค้าที่ท่านต้องการจัดกลุ่ม !!');
											}
										}
									</script>
								</td>
							</tr>
							<tr>
								<td align="right" height="10"></td>
							</tr>
						</table>
						<div class="clear-both"></div>
						<style type="text/css">
							.box-tag{
								background: #875931;
								display: block; 
								float: left;
								margin: 3px 4px;
								padding: 2px 8px 4px;
								border-radius: 8px;
								position: relative;
							}
							.box-tag>a{
								background: #875931;
								display: inline-block;
								color: #fff;
								border-left: 1px solid #ddd;
								position: relative;
								margin-left: 4px;
								padding: 0px 2px 0 5px;
							}
						</style>
						<script type="text/javascript">
							function del_datacert(x_obj,x_cat,x_datacert){
								x_obj.parent().remove();
								$.ajax({
									url: "catalog_query.php",
									type: "POST",
									data: {do_what:"del_datacert",x_cat:x_cat,x_datacert:x_datacert},
									cache: false,
									processData: true,
									success: function (result) {
										// location.reload();
									}
								});
							}
						</script>
						<?php

							function create_links($prev_page,$page,$num_pages,$prev_url,$next_url){
								if(isset($_GET['q']) &&  ($_GET['q'] != NULL)){
									$url_q = "&amp;q=".$_GET['q'];
								}

								echo '<div id="data-pagination">';
								if($prev_page){
									?>
									<a href="<?php echo $prev_url.$url_q;?>">&#10092; ย้อนกลับ</a>
									<?php
								}else{ 
									?>
									<a class="navidisabled">&#10092; ย้อนกลับ</a>
									<?php
								}

								for($l=1; $l<=$num_pages; $l++){
									$page1 = $page-2;
									$page2 = $page+2;
									if($l != $page && $l >= $page1 && $l <= $page2){
										?>
										<a href="?page=<?php echo $l.$url_q;?>"><?php echo $l;?></a>
										<?php
									}elseif($l==$page){
										?>
										<a class="navi-seleted"><?php echo $l;?></a>
										<?php
									}
								}

								if($page!=$num_pages){
									?>
									<a class="navi-dot">...</a>
									<a href="<?php echo $next_url.$url_q;?>">หน้าถัดไป &#10093;</a>
									<?php
								}else{ 
									?>
									<a class="navidisabled">หน้าถัดไป &#10093;</a>
									<?php
								}

								?>
								<form method="get" class="box-qty-form">
									<table border="0" align="center" cellpadding="0" cellspacing="0">
										<tr>
											<td>
												<b>ไปที่หน้า</b>
											</td>
											<td>
												<div class="box-qty">
													<input type="text" name="page" value="<?php echo $page;?>">
													<?php
													if(isset($_GET["q"])){
														echo '<input name="q" type="hidden"value="'.$_GET['q'].'" />';
													}
													?>
													<button type="submit">ตกลง</button>
												</div>
											</td>
										</tr>
									</table>
								</form>
							<?php
								echo '</div>';
							} 

						?>
						<table width="95%" border="0" align="center" cellpadding="3" cellspacing="1">
							<tr class="bh">
								<td height="25" align="center" bgcolor="#692908">No.</td>
								<td align="center" bgcolor="#692908">รูปภาพ</td>
								<td align="center" bgcolor="#692908">ชื่อ</td>
								<td align="center" bgcolor="#692908">กลุ่ม</td>
							</tr>
							<?php

								

								// create_links($prev_page,$page,$num_pages,$prev_url,$next_url){

								if($_GET['q']){
									$name = "and datacert_amulet like '%".$_GET['q']."%' ";
								}
								$q="SELECT * FROM `datacert` WHERE 1 ";
								$db->query($q);
								$db->next_record();
								$shop_id = $db->f(id);			   
								$q="SELECT * FROM `datacert` WHERE 1 $name";
								$db->query($q);		
								$num_rows = $db->num_rows();		

								// pagination
								$per_page = 20;
								$page = (isset($_GET['page']))?$_GET['page']:1;
								$prev_page = $page-1;
								$next_page = $page+1;

								$page_Start = (($per_page*$page)-$per_page);
								if($num_rows<=$per_page){
									$num_pages =1;
								}else if(($num_rows % $per_page)==0){
									$num_pages =($num_rows/$per_page) ;
								}else{
									$num_pages =($num_rows/$per_page)+1;
									$num_pages = (int)$num_pages;
								}

								$prev_url = "?page=".$prev_page;
								$next_url = "?page=".$next_page;

								$q.=" ORDER BY datacert_id DESC LIMIT $page_Start,$per_page ";
								$db->query($q);

								

								static $v=1; 
								while($db->next_record()){
								?>		
							<tr bgcolor="<?=($v%2==1)?"#311407":"#4f3b2a"?>" class="sidemenu">
								<td width="1" height="25" align="center">
									<?=$db->f(product_id)?>
								</td>
								<td align="center" width="1" style="position:relative;">
									<div class="box-checkbox">
										<input type="checkbox" name="item[]" value="<?=$db->f(datacert_id)?>">
									</div>
										<img src="../slir/w125-h125/img/datacertificate/<?=$db->f(datacert_pic)?>" width="125" height="125" />
								</td>
								<td align="left" width="150"><?=$db->f(datacert_amulet)?></td>
								<td align="center">
									<?php
									$qCat = mysql_query("select * from catalog_cert where catalog_id in (".$db->f(group_category_id).") ");
									while ($rCat = mysql_fetch_array($qCat)) {
										?>
									<div class="box-tag">
										<?=$rCat['catalog_name'];?>
										<a href="javascript:void(0);" onclick="del_datacert($(this),<?php echo $rCat['catalog_id'];?>,<?=$db->f(datacert_id)?>);">x</a>
									</div>
										<?php
									}
									?>
								</td>
							</tr>
							<?php $v++; } ?>
							<tr>
								<td height="30" colspan="4" align="center"> 
									<?php  create_links($prev_page,$page,$num_pages,$prev_url,$next_url);//sh_page($total,$s_page,$e_page,$chk_page,Previous,Next,"#FFCC00","#F8F8F8"); // นำไปวางในตำแหน่งที่ต้องการแสดง ?>
								</td>
							</tr>
						</table>
						</td>
					</tr>
				</table>
			</td>
			</tr>
		</table>
	</body>
</html>