<?php
	include_once('../global.php');
	 if($_GET["page_num"] == ""){
			 $page_num = "1";
	 }else{
			 $page_num = $_GET["page_num"];
	 }
	 if($page_num == "0"){
			 $page_num = "1";
	 }
	 if($_GET["page_total"] != ""){
			 if($page_num > $_GET["page_total"]){
					 $page_num = $_GET["page_total"];
			 }
	 }
	?>
<?php
	$do_what = $_GET['do_what'];

	if($do_what == "certificate_id"){
		$q="update `product` set certificate='".$_GET['status']."' , `certificatedate` = '".date("Y-m-d H:i:s")."' WHERE `product_id` =".$_GET['id']." ";
		$db->query($q);
	}
	?>	
<?php
	if($do_what == "recommend_id"){
		$q="update `product` set recommend='".$_GET['status']."' , `hotdate` = '".date("Y-m-d H:i:s")."' WHERE `product_id` =".$_GET['id']." ";
		$db->query($q);
	}
	?>	
<?php
	if($do_what == "show_id"){
		$q="update `product` set showtype='".$_GET['status']."' WHERE `product_id` =".$_GET['id']." ";
		$db->query($q);
	}

	if($do_what == "certificate_id"){
		$q="update `product` set certificate='2' WHERE `product_id` =".$_GET['certificate_id']." ";
		$db->query($q);
	}
	?>
<script>

	function update_status (a,b,do_text) {
		var x_this = $('#redirec_pagechange');

		$.ajax({
			type: "GET",
			url: "list_certificate.php",
			data: { 
				do_what : do_text,
				id : a,
				status : b,
				page_min:$.trim(x_this.attr("page_min")), 
				page_max:$.trim(x_this.attr("page_max")), 
				page_num:$.trim(x_this.attr("page_num")), 
				page_total:$.trim(x_this.attr("page_total")) 
			},
			cache: false,
			success: function(result){
				redirec_pagechange();
			}
		});
	}
	
	function redirec_pagechange(){
		var x_this = $('#redirec_pagechange');
		var page_min = $.trim(x_this.attr("page_min"));
		var	page_max = $.trim(x_this.attr("page_max"));
	
		page_select(x_this,$('.praold_container'),'list_certificate.php',page_min,page_max);
	}
	
	var page_container = "";
	function page_select(x_this,page_object,page_file,page_min,page_max){
		page_container = page_object;
		
		// $("html, body").animate({ "scrollTop":page_container.offset().top+"px" }, 0);
		$("html, body").animate({ "scrollTop":0 }, 0);
	
		$.ajax({
			type: "GET",
			url: page_file,
			data: { 
				page_min:page_min, 
				page_max:page_max, 
				page_num:$.trim(x_this.attr("page_num")), 
				page_total:$.trim(x_this.attr("page_total")) 
			},
			cache: false,
			success: function(result){
				page_container.html(result);
			}
		 });
	}

	function delProduct(x_id){
		if(confirm('คุณแน่ใจที่จะลบสินค้าหรือไม่ ?')){
			var x_this = $('#redirec_pagechange');

			$.ajax({
				type: "GET",
				url: "list_certificate.php",
				data: { 
					do_what : "delProduct",
					id : x_id,
					page_min:$.trim(x_this.attr("page_min")), 
					page_max:$.trim(x_this.attr("page_max")), 
					page_num:$.trim(x_this.attr("page_num")), 
					page_total:$.trim(x_this.attr("page_total")) 
				},
				cache: false,
				success: function(result){
					redirec_pagechange();
				}
			});
		}
	}
</script>                    
<div class="praold_container">
	<table width="95%" border="0" align="center" cellpadding="3" cellspacing="1">
		<tr class="bh">
			<td width="90" height="25" align="center" bgcolor="#692908">No.</td>
			<td width="206" align="center" bgcolor="#692908">รูปภาพ</td>
			<td width="323" align="center" bgcolor="#692908">ชื่อ</td>
			<td width="118" align="center" bgcolor="#692908">ราคา</td>
			<td width="307" align="center" bgcolor="#692908">สถานะ</td>
			<td width="167" align="center" bgcolor="#692908">ลงวันที่</td>
			<td width="155" align="center" bgcolor="#692908">สินค้าติดใบรับรอง</td>
		</tr>
		<?php
			$q = "SELECT * FROM `product` WHERE certificate = 1 or certificate = 2 ";
			$p_r = 1;
			$db->query($q);
			$total = $db->num_rows();
			$q .= " ORDER BY product_id DESC";
			if($_GET["page_min"] == ""){
					$q .= " LIMIT 0,24";
			}else{
					$q .= " LIMIT ".$_GET["page_min"].",".$_GET["page_max"];
			}
			$db->query($q);
			while($db->next_record()){
			?>		
		<tr bgcolor="<?=($v%2==1)?"#311407":"#4f3b2a"?>" class="sidemenu">
			<td height="25" align="center">
				<?=$db->f(product_id)?>
			</td>
			<td align="center" width="206" style="position:relative;">
				<a href="http://www.praasia.com/shop_product.php?product_id=<?=$db->f(product_id)?>" target="_blank">
				<img src="/slir/w125-h125-c1:1/img/amulet/<?=$db->f(pic1)?>" width="125" height="125" />
				</a>
			</td>
			<td align="left"><?=$db->f(name)?></td>
			<td align="center"><?=$db->f(price)?></td>
			<td align="center" class="sidemenu">
				<? if ($db->f(status)=='1') { ?>
				พระโชว์
				<? } ?>
				<? if ($db->f(status)=='2') { ?>
				ให้เช่า
				<? } ?>
				<? if ($db->f(status)=='3') { ?>
				เปิดจอง
				<? } ?>
				<? if ($db->f(status)=='4') { ?>
				จองแล้ว
				<? } ?>
				<? if ($db->f(status)=='5') { ?>
				<span style="color:#ff0000;">ขายแล้ว</span>
				<? } ?>                                    
			</td>
			<td align="center" style="white-space: nowrap;"><?=date("d-m-Y",$db->f(date_add))?></td>
			<td align="center">
				<? if($db->f(certificate)=='1'){?>
				<a href="javascript:void(0);" onclick="update_status(<?=$db->f(product_id)?>,2,'certificate_id');"><img src="../images/wait.png" alt="No Hot" width="24" height="24" border="0"></a>
				<? }else if($db->f(certificate)=='2'){?>
				<a href="javascript:void(0);" onclick="update_status(<?=$db->f(product_id)?>,1,'certificate_id');">
				<img src="../images/ok.png" alt="Hot" width="24" height="24" border="0"></a>
				<? }?>			
			</td>
		</tr>
		<?php $v++; } ?>
		<tr>
			<td height="30" colspan="9" align="center">
				<table align="right" border="0" cellpadding="0" cellspacing="0">
					<tr>
						<?php
							if($_GET["page_min"] > 0){
								$page_min = $_GET["page_min"] - 100;
							}else{
								$page_min = 0;
							}
							$page_max = 100;
							if($_GET["page_min"] > 0){
							?>
						<td page_num="<?=$page_num - 1?>" page_total="" onclick="page_select($(this),$('.praold_container'),'list_certificate.php','<?=$page_min?>','<?=$page_max?>');" style="white-space:nowrap; cursor:pointer;">
							previous
						</td>
						<?php
							}
							?>
						<td style="white-space:nowrap;">
							<?php
								$l = 0;
								$page_total = ceil($total / 100);
								if($page_total < 5){
									while($l < $page_total){
										$l++;
										$page_min = ($l * 100) - 100;
										$page_max = 100;
								?>
							<table style="float:left; margin-left:10px; height:20px; cursor:pointer;" border="0" cellpadding="0" cellspacing="0">
								<tr>
									<td page_num="<?=$l?>" page_total="" onclick="page_select($(this),$('.praold_container'),'list_certificate.php','<?=$page_min?>','<?=$page_max?>');" style="text-align:center; <?php if($l == $page_num){ echo "color:#e00000;"; }else{ echo "color:#ffffff;"; } ?> ">
										<?=$l?>
									</td>
								</tr>
							</table>
							<?php
								}
								}else if($page_num <= 5){
								while($l < 5){
									$l++;
									$page_min = ($l * 100) - 100;
									$page_max = 100;
								?>
							<table style="float:left; margin-left:10px; height:20px; cursor:pointer;" border="0" cellpadding="0" cellspacing="0">
								<tr>
									<td page_num="<?=$l?>" page_total="" onclick="page_select($(this),$('.praold_container'),'list_certificate.php','<?=$page_min?>','<?=$page_max?>');" style="text-align:center; <?php if($l == $page_num){ echo "color:#e00000;"; }else{ echo "color:#ffffff;"; } ?> ">
										<?=$l?>
									</td>
								</tr>
							</table>
							<?php
								}
								$l = $page_total;
								$page_min = ($l * 100) - 100;
								$page_max = 100;
								?>
							<table style="float:left; margin-left:10px; height:20px;" border="0" cellpadding="0" cellspacing="0">
								<tr>
									<td>
										...
									</td>
								</tr>
							</table>
							<table style="float:left; margin-left:10px; height:20px; cursor:pointer;" border="0" cellpadding="0" cellspacing="0">
								<tr>
									<td page_num="<?=$l?>" page_total="" onclick="page_select($(this),$('.praold_container'),'list_certificate.php','<?=$page_min?>','<?=$page_max?>');" style="text-align:center; <?php if($l == $page_num){ echo "color:#e00000;"; }else{ echo "color:#ffffff;"; } ?> ">
										<?=$l?>
									</td>
								</tr>
							</table>
							<?php
								}else if($page_num < $page_total){
									while($l < 5){
										$l++;
										$page_min = ($l * 100) - 100;
										$page_max = 100;
								?>
							<table style="float:left; margin-left:10px; height:20px; cursor:pointer;" border="0" cellpadding="0" cellspacing="0">
								<tr>
									<td page_num="<?=$l?>" page_total="" onclick="page_select($(this),$('.praold_container'),'list_certificate.php','<?=$page_min?>','<?=$page_max?>');" style="text-align:center; <?php if($l == $page_num){ echo "color:#e00000;"; }else{ echo "color:#ffffff;"; } ?> ">
										<?=$l?>
									</td>
								</tr>
							</table>
							<?php
								}
								?>
							<table style="float:left; margin-left:10px; height:20px;" border="0" cellpadding="0" cellspacing="0">
								<tr>
									<td>
										...
									</td>
								</tr>
							</table>
							<?php
								$l = $page_num - 3;
								while($l < ($page_num + 2)){
									$l++;
									$page_min = ($l * 100) - 100;
									$page_max = 100;
									if( ($l > 5) && ($l < $page_total) ){
								?>
							<table style="float:left; margin-left:10px; height:20px; cursor:pointer;" border="0" cellpadding="0" cellspacing="0">
								<tr>
									<td page_num="<?=$l?>" page_total="" onclick="page_select($(this),$('.praold_container'),'list_certificate.php','<?=$page_min?>','<?=$page_max?>');" style="text-align:center; <?php if($l == $page_num){ echo "color:#e00000;"; }else{ echo "color:#ffffff;"; } ?> ">
										<?=$l?>
									</td>
								</tr>
							</table>
							<?php
								}
								}
								$l = $page_total;
								$page_min = ($l * 100) - 100;
								$page_max = 100;
								?>
							<table style="float:left; margin-left:10px; height:20px;" border="0" cellpadding="0" cellspacing="0">
								<tr>
									<td>
										...
									</td>
								</tr>
							</table>
							<table style="float:left; margin-left:10px; height:20px; cursor:pointer;" border="0" cellpadding="0" cellspacing="0">
								<tr>
									<td page_num="<?=$l?>" page_total="" onclick="page_select($(this),$('.praold_container'),'list_certificate.php','<?=$page_min?>','<?=$page_max?>');" style="text-align:center; <?php if($l == $page_num){ echo "color:#e00000;"; }else{ echo "color:#ffffff;"; } ?> ">
										<?=$l?>
									</td>
								</tr>
							</table>
							<?php
								}else{
									while($l < 5){
										$l++;
										$page_min = ($l * 100) - 100;
										$page_max = 100;
								?>
							<table style="float:left; margin-left:10px; height:20px; cursor:pointer;" border="0" cellpadding="0" cellspacing="0">
								<tr>
									<td page_num="<?=$l?>" page_total="" onclick="page_select($(this),$('.praold_container'),'list_certificate.php','<?=$page_min?>','<?=$page_max?>');" style="text-align:center; <?php if($l == $page_num){ echo "color:#e00000;"; }else{ echo "color:#ffffff;"; } ?> ">
										<?=$l?>
									</td>
								</tr>
							</table>
							<?php
								}
								$l = $page_total;
								$page_min = ($l * 100) - 100;
								$page_max = 100;
								?>
							<table style="float:left; margin-left:10px; height:20px;" border="0" cellpadding="0" cellspacing="0">
								<tr>
									<td>
										...
									</td>
								</tr>
							</table>
							<table style="float:left; margin-left:10px; height:20px; cursor:pointer;" border="0" cellpadding="0" cellspacing="0">
								<tr>
									<td page_num="<?=$l?>" page_total="" onclick="page_select($(this),$('.praold_container'),'list_certificate.php','<?=$page_min?>','<?=$page_max?>');" style="text-align:center; <?php if($l == $page_num){ echo "color:#e00000;"; }else{ echo "color:#ffffff;"; } ?> ">
										<?=$l?>
									</td>
								</tr>
							</table>
							<?php
								}
								?>
						</td>
						<?php
							$page_min = $_GET["page_min"] + 100;
							if($page_min > $total){
								$page_min = $_GET["page_min"];
							}
							if($page_num < $page_total){
							?>
						<td page_num="<?=$page_num + 1?>" page_total="<?=$page_total?>" onclick="page_select($(this),$('.praold_container'),'list_certificate.php','<?=$page_min?>','<?=$page_max?>');" style="padding-left:10px; white-space:nowrap; cursor:pointer;">
							next
						</td>
						<?php
							}
							?>
					</tr>
				</table>
				<div id="redirec_pagechange" page_total="<?php echo (isset($_GET['page_total']))?$_GET['page_total']:'';?>" page_num="<?php echo (isset($_GET['page_num']))?$_GET['page_num']:'';?>" page_min="<?php echo (isset($_GET['page_min']))?$_GET['page_min']:'';?>" page_max="<?php echo (isset($_GET['page_max']))?$_GET['page_max']:'';?>" >&nbsp;</div>
			</td>
		</tr>
	</table>
</div>