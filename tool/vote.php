<? include('../global.php')?>
<?php if($_SESSION['adminid']=='' || !isset($_SESSION['adminid'])) {  
	redi4("login.php");
	} ?>
<?php set_page($s_page,$e_page=20); //นำส่วนนี้ิไว้ด้านบน ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<title>ระบบจัดการเว็บไซต์</title>
		<style type="text/css">
			body {
			background-color: #000;
			margin-left: 0px;
			margin-top: 0px;
			margin-right: 0px;
			margin-bottom: 0px;	
			}
			.bh{
			color:#FC0;
			font-size:14px;
			height:30px;
			}
			.sidemenu{
			color:#FFF;
			font-size:12px;
			height:25px;
			border-bottom:1px solid #000;
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
		</style>
	</head>
	<body>
		<table width="1000" border="0" align="center" cellpadding="0" cellspacing="0">
			<tr>
			<td><img src="/admin/images/head.jpg" width="1098" height="288" /></td>
			</tr>
			<tr>
			<td bgcolor="#311407">
				<table width="100%" border="0" cellspacing="3" cellpadding="0">
					<tr>
						<td width="250" valign="top"><? include('sidemenu.php') ?></td>
						<td valign="top" bgcolor="#3f1d0e" style="padding-top:3px">
						<table width="98%" border="1" align="center" cellpadding="3" cellspacing="0" bordercolor="#1f0b02" style="border-collapse:collapse">
							<tr class="bh">
								<td width="12%" height="30" align="center" bgcolor="#5f2206">รูป
								</td>
								<td width="26%" height="30" align="center" bgcolor="#5f2206">โดย</td>
								<td width="54%" height="30" align="center" bgcolor="#5f2206">เหตุผล</td>
								<td width="8%" height="30" align="center" bgcolor="#5f2206">ลบ</td>
							</tr>
							<?php
								if($_GET['d_comment_id']){					
									$q="DELETE FROM `comment` WHERE `comment_product` = ".$_GET['d_comment_id']." ";
									$db->query($q);

									$q="SELECT * FROM `product` WHERE `product_id` = '".$_GET['d_comment_id']."' ";
									$checkproduct= new nDB();
									$checkproduct->query($q);
									$checkproduct->next_record();

									$q="UPDATE `member` SET `commentscore` = `commentscore`-10 WHERE id = '".$checkproduct->f('shop_id')."' ";		
									$db->query($q);	

									if($checkproduct->f('count_comment') > 0){
										$r_countcomment = ($checkproduct->f('count_comment')*10);

										$q="UPDATE `member` 
											SET `commentscore` = (`commentscore` - $r_countcomment )
											WHERE id = '".$_SESSION['adminshop_id']."' ";	
										$db->query($q);	
									}				
								}
								
								if($_GET["do"] == "vote_delete"){
									$comment_id = $_GET["comment_id"];
									$vote = $_GET["vote"];
									$product_id = $_GET["product_id"];
									$value = $_GET["value"];
									if($vote == "comment_detail"){
										$db->query("update comment set $vote = '' where comment_id = '$comment_id'");
									}else{
										$db->query("update comment set $vote = '0' where comment_id = '$comment_id'");
									}
									$db->query("update product set score = (score + $value) where product_id = '$product_id'");
								}
								
								$q = "SELECT * FROM `comment` WHERE 1";
								$db->query($q);
								$total = $db->num_rows();
								$q .= " ORDER BY comment_id DESC LIMIT $s_page,$e_page ";
								$db->query($q);
								static $v = 1;
								while($db->next_record()){
									$q = "SELECT * FROM `product` WHERE product_id = '".$db->f('comment_product')."'";
									$product = new nDB();
									$product->query($q);
									$product->next_record();
									
									$q = "SELECT * FROM `member` WHERE id = '".$db->f('comment_by')."' ";
									$by = new nDB();
									$by->query($q);
									$by->next_record();
								?>
							<tr bgcolor="<?=($v%2==1)?"#311407":"#3c190a"?>">
								<td align="center">
									<a href="http://www.praasia.com/shop_product.php?product_id=<?=$product->f(product_id)?>" target="_blank">
									<img src="/slir/w80-h80-c1:1/img/amulet/<?=$product->f(pic1)?>" width="80" height="80" border="0" />
									</a>
								</td>
								<td valign="top" style="color:#FC0; font-size:12px">
									<?=$by->f(name)?>
								</td>
								<td valign="top" style="color:#FC0; font-size:12px">
									<table width="100%" border="0" cellspacing="0" cellpadding="3">
									<? if ($db->f(vote1)!=0) { ?>
									<tr>
										<td>
											จากภาพพระเบลอ
											<a href="?do=vote_delete&comment_id=<?=$db->f(comment_id)?>&vote=vote1&product_id=<?=$product->f(product_id)?>&value=2">ลบ</a>
										</td>
									</tr>
									<? } ?>
									<? if ($db->f(vote2)!=0) { ?>
									<tr>
										<td>
											จากภาพพระเบลอมาก
											<a href="?do=vote_delete&comment_id=<?=$db->f(comment_id)?>&vote=vote2&product_id=<?=$product->f(product_id)?>&value=15">ลบ</a>
										</td>
									</tr>
									<? } ?>
									<? if ($db->f(vote3)!=0) { ?>
									<tr>
										<td>
											จากภาพพิมพ์ตื้นไป
											<a href="?do=vote_delete&comment_id=<?=$db->f(comment_id)?>&vote=vote3&product_id=<?=$product->f(product_id)?>&value=10">ลบ</a>
										</td>
									</tr>
									<? } ?>
									<? if ($db->f(vote4)!=0) { ?>
									<tr>
										<td>
											จากภาพผิดพิมพ์
											<a href="?do=vote_delete&comment_id=<?=$db->f(comment_id)?>&vote=vote4&product_id=<?=$product->f(product_id)?>&value=15">ลบ</a>
										</td>
									</tr>
									<? } ?>
									<? if ($db->f(vote5)!=0) { ?>
									<tr>
										<td>
											จากภาพผิดเนื้อ
											<a href="?do=vote_delete&comment_id=<?=$db->f(comment_id)?>&vote=vote5&product_id=<?=$product->f(product_id)?>&value=10">ลบ</a>
										</td>
									</tr>
									<? } ?>
									<? if ($db->f(vote6)!=0) { ?>
									<tr>
										<td>
											จากภาพผิวรมใหม่
											<a href="?do=vote_delete&comment_id=<?=$db->f(comment_id)?>&vote=vote6&product_id=<?=$product->f(product_id)?>&value=5">ลบ</a>
										</td>
									</tr>
									<? } ?>
									<? if ($db->f(vote7)!=0) { ?>
									<tr>
										<td>
											จากภาพพระบวม
											<a href="?do=vote_delete&comment_id=<?=$db->f(comment_id)?>&vote=vote7&product_id=<?=$product->f(product_id)?>&value=15">ลบ</a>
										</td>
									</tr>
									<? } ?>
									<? if ($db->f(vote8)!=0) { ?>
									<tr>
										<td>
											จากภาพพระดูยาก
											<a href="?do=vote_delete&comment_id=<?=$db->f(comment_id)?>&vote=vote8&product_id=<?=$product->f(product_id)?>&value=15">ลบ</a>
										</td>
									</tr>
									<? } ?>
									<? if ($db->f(vote9)!=0) { ?>
									<tr>
										<td>
											จากภาพทีความคมชัดน้อย
											<a href="?do=vote_delete&comment_id=<?=$db->f(comment_id)?>&vote=vote9&product_id=<?=$product->f(product_id)?>&value=10">ลบ</a>
										</td>
									</tr>
									<? } ?>
									<? if ($db->f(vote10)!=0) { ?>
									<tr>
										<td>
											จากภาพปลอมแปลงใบรับรอง
											<a href="?do=vote_delete&comment_id=<?=$db->f(comment_id)?>&vote=vote10&product_id=<?=$product->f(product_id)?>&value=30">ลบ</a>
										</td>
									</tr>
									<? } ?>
									<? if ($db->f(vote11)!=0) { ?>
									<tr>
										<td>
											จากภาพประวัติไม่ชัดเจน
											<a href="?do=vote_delete&comment_id=<?=$db->f(comment_id)?>&vote=vote11&product_id=<?=$product->f(product_id)?>&value=15">ลบ</a>
										</td>
									</tr>
									<? } ?>  
									<? if ($db->f(vote12)!=0) { ?>
									<tr>
										<td>
											เนื้อดูใหม่ไป
											<a href="?do=vote_delete&comment_id=<?=$db->f(comment_id)?>&vote=vote12&product_id=<?=$product->f(product_id)?>&value=20">ลบ</a>
										</td>
									</tr>
									<? } ?>  
									<? if ($db->f(vote13)!=0) { ?>
									<tr>
										<td>
											เนื้อไม่ถึงยุค
											<a href="?do=vote_delete&comment_id=<?=$db->f(comment_id)?>&vote=vote13&product_id=<?=$product->f(product_id)?>&value=20">ลบ</a>
										</td>
									</tr>
									<? } ?>  
									<? if ($db->f(vote14)!=0) { ?>
									<tr>
										<td>
											ลงผิดหมวดสินค้า
											<a href="?do=vote_delete&comment_id=<?=$db->f(comment_id)?>&vote=vote14&product_id=<?=$product->f(product_id)?>&value=0">ลบ</a>
										</td>
									</tr>
									<? } ?>
									<? if ($db->f(comment_detail)!="") { ?>
									<tr>
										<td>
											<?=$db->f(comment_detail)?>
											<a href="?do=vote_delete&comment_id=<?=$db->f(comment_id)?>&vote=comment_detail&product_id=<?=$product->f(product_id)?>&value=10">ลบ</a>
										</td>
									</tr>
									<? } ?>
									</table>
								</td>
								<td align="center" valign="top"><a href="?d_comment_id=<?=$db->f(comment_product)?>&s_page=<?=$_GET["s_page"]?>"  onClick="return confirm('คุณแน่ใจที่จะลบสินค้าหรือไม่ ?')"><img src="images/del.gif" width="19" height="23" border="0"></a></td>
							</tr>
							<?php $v++; } ?>
							<tr>
								<td height="30" colspan="4" align="center">
									<?php  sh_page($total,$s_page,$e_page,$chk_page,Previous,Next,"#333333","#F8F8F8");?>
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