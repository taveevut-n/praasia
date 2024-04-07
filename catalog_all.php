<?php
	include("global.php");
	set_page($s_page,$e_page=100);
 	if ($_GET['shop']) {
		$_SESSION['shop_id']=$_GET['shop'];
		$shop_id = $_SESSION['shop_id'];
	}
	$q="UPDATE `member` SET `view_num` = `view_num`+1 WHERE `id` ='".$_SESSION['shop_id']."' ";
	$db->query($q);
	$q="SELECT * FROM `member` WHERE id='".$_SESSION['shop_id']."' ";
	$dbshop = new nDB();	
	$dbshop->query($q);
	$dbshop->next_record();
	$arrival = $dbshop->f(date_add);
	$q="SELECT * FROM `product` WHERE shop_id ='".$_SESSION['shop_id']."' ";
	$dbproduct= new nDB();	
	$dbproduct->query($q);
	$dbproduct->next_record();
	$num_rows = $dbproduct->num_rows();
?>  
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script language="javascript" type="text/javascript" src="swfobject.js" ></script>
<head>

	<title>
		ร้าน
		<?=$dbshop->f(shopname)?>
		| ศูนย์รวพระเครื่องเมืองไทย  合艾佛牌网
	</title>

	<link rel="shortcut icon" href="favicon.ico" />
	<link rel="favicon" href="favicon.ico" />

	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

	<!-- load jQuery -->
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.js"></script>

	<!-- load Galleria -->
	<script src="galleria/galleria-1.2.9.min.js"></script>

	<?php include("index.css"); ?>

	<style type="text/css">

		body {
			background-color: #000;
			background-image: url(images/bg.jpg);
			background-position:top center;
			background-repeat:no-repeat;	
		}
		body,td,th {
			font-family: Arial, Helvetica, sans-serif;
			font-size: 12px;
		}
		a:link {
			text-decoration: none;
		}
		a:visited {
			text-decoration: none;
			color: #000;
		}
		a:hover {
			text-decoration: none;
		}
		a:active {
			text-decoration: none;
			color: #000;
		}

		/* Demo styles */
		html,body{;margin:0;}
		body{border-top:4px solid #000;}
		.content{color:#777;font:12px/1.4 "helvetica neue",arial,sans-serif;width:450px; background-color:#000}
		h1{font-size:12px;font-weight:normal;color:#ddd;margin:0;}
		a {color:#22BCB9;text-decoration:none;}
		.cred{font-size:11px;}

		/* This rule is read by Galleria to define the gallery height: */
		#galleria{height:355px}

		html, body {
			margin:0px;
			padding:0px;
			width:100%;
			height:100%;
			border:0px solid #000000;
		}

	</style>

	<script src="Scripts/swfobject.js" type="text/javascript"></script>

</head>

<body>

<!-- Save for Web Slices (???????.jpg) -->
<table width="1000" height="100%" border="0" align="center" cellpadding="0" cellspacing="0">
	<tr>
		<td height="1px">
			<?php include("head.php"); ?>
		</td>
	</tr>
	<tr>
		<td style="vertical-align:top; background-color:#0a0400 ">

			<?php
				$conn = mysql_connect("localhost","prathai_new","twe31219#");
				mysql_select_db("prathai_new",$conn);
				mysql_query("SET NAMES UTF8");
				mysql_query("SET character_set_results=utf8");
				mysql_query("SET character_set_client=utf8");
				mysql_query("SET character_set_connection=utf8");
			?>

			<style>
				hr {
					border:0;
					height:1px;
					background:#b65b15;
				}
				.geo_tab {
					margin-left:15px;
					width:150px;
					height:50px;
					background-color:#b65b15;
					-webkit-border-radius: 20px 20px 0px 0px;
					border-radius: 20px 20px 0px 0px;
					cursor:pointer;
					float:left;
				}
				.geo_tab:hover {
					background-color:#df711d;
				}
			</style>

			<script>
				function geo_button(x_this){
					var geo_id = x_this.attr("attr_geo_id");console.log(geo_id);
					$(".province").hide();
					$(".province_"+geo_id).fadeIn(200);
				}
				$(document).ready(function(){

					$(".geo_tab").click(function(){
						$(".geo_tab").css("background-color","");
						$(this).css("background-color","#df711d");
					});

					$(".province_1").show();
					
				});
			</script>

			<table width="100%" border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td>
						<?php
							$q = mysql_query("select * from geo order by geo_id asc");
							while($r = mysql_fetch_array($q)){
						?>
						<table class="geo_tab" onclick="geo_button($(this))" attr_geo_id="<?=$r["geo_id"]?>" border="0" cellpadding="0" cellspacing="0">
							<tr>
								<td style="text-align:center; vertical-align:middle; font-size:14px;">
									<?=$r["geo_name"]?>
								</td>
							</tr>
						</table>
						<?php
							}
						?>
					</td>
				</tr>
				<tr>
					<td style="padding:20px;">
						<?php
							$q_geo = mysql_query("select * from geo order by geo_id asc");
							while($r_geo = mysql_fetch_array($q_geo)){
								$conn = mysql_connect("localhost","prathai_new","twe31219#");
								mysql_select_db("prathai_new",$conn);
								mysql_query("SET NAMES UTF8");
								mysql_query("SET character_set_results=utf8");
								mysql_query("SET character_set_client=utf8");
								mysql_query("SET character_set_connection=utf8");
						?>
						<div class="province province_<?=$r_geo["geo_id"]?>" style="display:none;">
							<?php
								$q_province = mysql_query("select * from province where geo_id = '".$r_geo["geo_id"]."' order by province_id asc");
								while($r_province = mysql_fetch_array($q_province)){
							?>
							<table style="width:100%; height:50px;" border="0" cellpadding="0" cellspacing="0">
								<tr>
									<td style="padding-left:10px; vertical-align:middle; font-size:16px; color:#fc0;">
										<?=$r_province["province_name"]?>
									</td>
								</tr>
								<tr>
									<td style="padding-top:10px; padding-bottom:10px; text-align:center; vertical-align:middle;">
										<?php
											$db_catalog = new nDB();
											$db_catalog->query("select * from catalog where province_id = '".$r_province["province_id"]."' order by catalog_id asc");
											while($db_catalog->next_record()){
										?>
										<table style="margin-left:20px; margin-top:5px; width:220px; height:20px; float:left;" border="0" cellpadding="0" cellspacing="0">
											<tr>
												<td style="text-align:left; color:#ffffff;">
													<form action="search_product.php" method="post">
													<input name="geo" value="<?=$r_geo["geo_id"]?>" type="hidden"/>
													<input name="province" value="<?=$r_province["province_id"]?>" type="hidden"/>
													<input name="catalog" value="<?=$db_catalog->f(catalog_id)?>" type="hidden"/>
													<span onclick="$(this).parent().submit();" style="cursor:pointer;">
														-
														&nbsp;
														<?=$db_catalog->f(catalog_name)?>
													</span>
													</form>
												</td>
											</tr>
										</table>
										<?php
											}
										?>
									</td>
								</tr>
							</table>
							<hr/>
							<?php
								}
							?>
						</div>
						<?php
							}
						?>
					</td>
				</tr>
			</table>

		</td>
	</tr>
	<tr>
		<td height="1px">
			<img src="images/footer.jpg" width="1000px" height="136px">
		</td>
	</tr>
</table>
<!-- End Save for Web Slices -->

<script type="text/javascript">
	swfobject.registerObject("FlashID", "9.0.0", "expressInstall.swf");
</script>

</body>
</html>
