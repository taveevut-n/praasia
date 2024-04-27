<? include('../global.php');?>
<?php if($_SESSION['adminid']=='' || !isset($_SESSION['adminid'])) {  
	redi4("login.php");
	} ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<title>ระบบจัดการเว็บไซต์</title>
		<style type="text/css">
			body {
				font-family: helvetica,thonburi,tahoma;
				font-size: 13px;
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
			a{
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
							<td width="250" valign="top">
								<? include('sidemenu.php') ?>
							</td>
							<td valign="top" bgcolor="#3f1d0e">
								<form action="search_index.php" method="post" id="form2">
									<table style="color:#ffcc00;" border="0" align="center" cellpadding="0" cellspacing="0">
										<tr>
											<td style="padding-left:10px; width:1px; white-space:nowrap;">
												ค้นหาร้าน
											</td>
											<td style="padding-left:10px; padding-right:10px; width:1px;">
												:
											</td>
											<td style="width:1px;">
												<input name="q" type="text" id="q" style="width:250px" />
											</td>
											<td style="width:1px;">
												<select name="country">
													<option value="All" selected="selected">All</option>
													<option value="Thailand">Thailand</option>
													<option value="Malaysia">Malaysia</option>
													<option value="Singapore">Singapore</option>
													<option value="China">China</option>
													<option value="Hongkong">Hongkong</option>
													<option value="Taiwan">Taiwan</option>
													<option value="Indonesia">Indonesia</option>
												</select>
											</td>
											<td style="width:1px;">
												<input name="submit" type="submit" id="submit" value="ค้นหา" />
											</td>
										</tr>
									</table>
									<table width="95%" border="0" align="center" cellpadding="3" cellspacing="0">
										<tr>
											<td align="center" class="bh"><a href="search_index.php?name=ก"><span style="color:#FC0">ก</span></a></td>
											<td align="center" class="bh"><a href="search_index.php?name=ข"><span style="color:#FC0">ข</span></a></td>
											<td align="center" class="bh"><a href="search_index.php?name=ฃ"><span style="color:#FC0">ฃ</span></a></td>
											<td align="center" class="bh"><a href="search_index.php?name=ค"><span style="color:#FC0">ค</span></a></td>
											<td align="center" class="bh"><a href="search_index.php?name=ฆ"><span style="color:#FC0">ฆ</span></a></td>
											<td align="center" class="bh"><a href="search_index.php?name=ง"><span style="color:#FC0">ง</span></a></td>
											<td align="center" class="bh"><a href="search_index.php?name=จ"><span style="color:#FC0">จ</span></a></td>
											<td align="center" class="bh"><a href="search_index.php?name=ฉ"><span style="color:#FC0">ฉ</span></a></td>
											<td align="center" class="bh"><a href="search_index.php?name=ช"><span style="color:#FC0">ช</span></a></td>
											<td align="center" class="bh"><a href="search_index.php?name=ซ"><span style="color:#FC0">ซ</span></a></td>
											<td align="center" class="bh"><a href="search_index.php?name=ฌ"><span style="color:#FC0">ฌ</span></a></td>
											<td align="center" class="bh"><a href="search_index.php?name=ญ"><span style="color:#FC0">ญ</span></a></td>
											<td align="center" class="bh"><a href="search_index.php?name=ฎ"><span style="color:#FC0">ฎ</span></a></td>
											<td align="center" class="bh"><a href="search_index.php?name=ฏ"><span style="color:#FC0">ฏ</span></a></td>
											<td align="center" class="bh"><a href="search_index.php?name=ฐ"><span style="color:#FC0">ฐ</span></a></td>
											<td align="center" class="bh"><a href="search_index.php?name=ฑ"><span style="color:#FC0">ฑ</span></a></td>
											<td align="center" class="bh"><a href="search_index.php?name=ฒ"><span style="color:#FC0">ฒ</span></a></td>
											<td align="center" class="bh"><a href="search_index.php?name=ณ"><span style="color:#FC0">ณ</span></a></td>
											<td align="center" class="bh"><a href="search_index.php?name=ด"><span style="color:#FC0">ด</span></a></td>
											<td align="center" class="bh"><a href="search_index.php?name=ต"><span style="color:#FC0">ต</span></a></td>
											<td align="center" class="bh"><a href="search_index.php?name=ถ"><span style="color:#FC0">ถ</span></a></td>
											<td align="center" class="bh"><a href="search_index.php?name=ท"><span style="color:#FC0">ท</span></a></td>
											<td align="center" class="bh"><a href="search_index.php?name=ธ"><span style="color:#FC0">ธ</span></a></td>
											<td align="center" class="bh"><a href="search_index.php?name=น"><span style="color:#FC0">น</span></a></td>
											<td align="center" class="bh"><a href="search_index.php?name=บ"><span style="color:#FC0">บ</span></a></td>
											<td align="center" class="bh"><a href="search_index.php?name=ป"><span style="color:#FC0">ป</span></a></td>
										</tr>
										<tr>
											<td align="center" class="bh"><a href="search_index.php?name=ผ"><span style="color:#FC0">ผ</span></a></td>
											<td align="center" class="bh"><a href="search_index.php?name=ฝ"><span style="color:#FC0">ฝ</span></a></td>
											<td align="center" class="bh"><a href="search_index.php?name=พ"><span style="color:#FC0">พ</span></a></td>
											<td align="center" class="bh"><a href="search_index.php?name=ฟ"><span style="color:#FC0">ฟ</span></a></td>
											<td align="center" class="bh"><a href="search_index.php?name=ภ"><span style="color:#FC0">ภ</span></a></td>
											<td align="center" class="bh"><a href="search_index.php?name=ม"><span style="color:#FC0">ม</span></a></td>
											<td align="center" class="bh"><a href="search_index.php?name=ย"><span style="color:#FC0">ย</span></a></td>
											<td align="center" class="bh"><a href="search_index.php?name=ร"><span style="color:#FC0">ร</span></a></td>
											<td align="center" class="bh"><a href="search_index.php?name=ล"><span style="color:#FC0">ล</span></a></td>
											<td align="center" class="bh"><a href="search_index.php?name=ว"><span style="color:#FC0">ว</span></a></td>
											<td align="center" class="bh"><a href="search_index.php?name=ศ"><span style="color:#FC0">ศ</span></a></td>
											<td align="center" class="bh"><a href="search_index.php?name=ษ"><span style="color:#FC0">ษ</span></a></td>
											<td align="center" class="bh"><a href="search_index.php?name=ส"><span style="color:#FC0">ส</span></a></td>
											<td align="center" class="bh"><a href="search_index.php?name=ห"><span style="color:#FC0">ห</span></a></td>
											<td align="center" class="bh"><a href="search_index.php?name=ฬ"><span style="color:#FC0">ฬ</span></a></td>
											<td align="center" class="bh"><a href="search_index.php?name=อ"><span style="color:#FC0">อ</span></a></td>
											<td align="center" class="bh"><a href="search_index.php?name=ฮ"><span style="color:#FC0">ฮ</span></a></td>
											<td align="center" class="bh">&nbsp;</td>
											<td align="center" class="bh">&nbsp;</td>
											<td align="center" class="bh">&nbsp;</td>
											<td align="center">&nbsp;</td>
											<td align="center">&nbsp;</td>
											<td align="center">&nbsp;</td>
											<td align="center">&nbsp;</td>
											<td align="center">&nbsp;</td>
											<td align="center">&nbsp;</td>
										</tr>
										<tr class="bh">
											<td align="center"><a href="search_index.php?name=A"><span style="color:#FC0">A</span></a></td>
											<td align="center"><a href="search_index.php?name=B"><span style="color:#FC0">B</span></a></td>
											<td align="center"><a href="search_index.php?name=C"><span style="color:#FC0">C</span></a></td>
											<td align="center"><a href="search_index.php?name=D"><span style="color:#FC0">D</span></a></td>
											<td align="center"><a href="search_index.php?name=E"><span style="color:#FC0">E</span></a></td>
											<td align="center"><a href="search_index.php?name=F"><span style="color:#FC0">F</span></a></td>
											<td align="center"><a href="search_index.php?name=G"><span style="color:#FC0">G</span></a></td>
											<td align="center"><a href="search_index.php?name=H"><span style="color:#FC0">H</span></a></td>
											<td align="center"><a href="search_index.php?name=I"><span style="color:#FC0">I</span></a></td>
											<td align="center"><a href="search_index.php?name=J"><span style="color:#FC0">J</span></a></td>
											<td align="center"><a href="search_index.php?name=K"><span style="color:#FC0">K</span></a></td>
											<td align="center"><a href="search_index.php?name=L"><span style="color:#FC0">L</span></a></td>
											<td align="center"><a href="search_index.php?name=M"><span style="color:#FC0">M</span></a></td>
											<td align="center"><a href="search_index.php?name=N"><span style="color:#FC0">N</span></a></td>
											<td align="center"><a href="search_index.php?name=O"><span style="color:#FC0">O</span></a></td>
											<td align="center"><a href="search_index.php?name=P"><span style="color:#FC0">P</span></a></td>
											<td align="center"><a href="search_index.php?name=Q"><span style="color:#FC0">Q</span></a></td>
											<td align="center"><a href="search_index.php?name=R"><span style="color:#FC0">R</span></a></td>
											<td align="center"><a href="search_index.php?name=S"><span style="color:#FC0">S</span></a></td>
											<td align="center"><a href="search_index.php?name=T"><span style="color:#FC0">T</span></a></td>
											<td align="center"><a href="search_index.php?name=U"><span style="color:#FC0">U</span></a></td>
											<td align="center"><a href="search_index.php?name=V"><span style="color:#FC0">V</span></a></td>
											<td align="center"><a href="search_index.php?name=W"><span style="color:#FC0">W</span></a></td>
											<td align="center"><a href="search_index.php?name=X"><span style="color:#FC0">X</span></a></td>
											<td align="center"><a href="search_index.php?name=Y"><span style="color:#FC0">Y</span></a></td>
											<td align="center"><a href="search_index.php?name=Z"><span style="color:#FC0">Z</span></a></td>
										</tr>
									</table>
								</form>
								<br />
								<table width="95%" border="1" align="center" cellpadding="3" cellspacing="0" bordercolor="#2a1100" style="border-collapse:collapse">
									<tr class="bh">
										<td width="23%" height="30" align="center" bgcolor="#5f2206">ชื่อเจ้าของ</td>
										<td width="23%" height="30" align="center" bgcolor="#5f2206">username</td>
										<td width="17%" align="center" bgcolor="#5f2206">เบอร์โทรศัพท์</td>
										<!--<td width="15%" align="center" bgcolor="#5f2206">จำนวนผู้เข้าชม</td>-->
										<td width="10%" align="center" bgcolor="#5f2206">E-mail</td>	
    									<td width="10%" align="center" bgcolor="#5f2206">สถานะ</td>
                                        <td width="10%" align="center" bgcolor="#5f2206">ข้อมูลชำระเงิน</td>                                        
                                        <td width="10%" align="center" bgcolor="#5f2206">บัตร</td>
										<td bgcolor="#5f2206">แก้ไข</td>
										<td bgcolor="#5f2206">ลบ</td>
									</tr>
									<?php
										if($_GET["fileno_id"]){
											$q = "update `member` set file_check = '".$_GET['status']."' WHERE `id` = '".$_GET['fileno_id']."' ";
											$db->query($q);
										}
										if($_GET['no_id']){
											$q = "update `member` set active='".$_GET['status']."' WHERE `id` = '".$_GET['no_id']."' ";
											$db->query($q);
											$q = "update `product` set active='".$_GET['status']."' WHERE `shop_id` = '".$_GET['no_id']."' ";
											$db->query($q);
											$r = mysql_fetch_array(mysql_query("select * from member where id = '".$_GET["no_id"]."'"));
											if( ($r["package_id"] == "0") || ($r["date_expire"] == "") ){
												$n = mysql_num_rows(mysql_query("select * from member where id < '".$_GET["no_id"]."' and active = '2'"));
												if($n <= 30){
													mysql_query("update member set package_id = '1' where id = '".$_GET["no_id"]."'");
												}else if($n <= 70){
													mysql_query("update member set package_id = '2' where id = '".$_GET["no_id"]."'");
												}else if($n <= 130){
													mysql_query("update member set package_id = '3' where id = '".$_GET["no_id"]."'");
												}else if($n <= 330){
													mysql_query("update member set package_id = '4' where id = '".$_GET["no_id"]."'");
												}
												$q = mysql_query("select * from member m left join member_package p on m.package_id = p.package_id where m.active = '2' and m.id = '".$_GET['no_id']."'");
												while($r = mysql_fetch_array($q)){
													$member_id = $r["id"];
													$package_duration = $r["package_duration"];
													mysql_query("update member set date_expire = '".(strtotime(date("Y-m-d")) + ($package_duration*86400) )."' where id = '$member_id'");
												}
											}
											$q = "SELECT * FROM `member` WHERE id = '".$_GET["no_id"]."' ";
											$noid= new nDB();
											$noid->query($q);
											$noid->next_record();
											if ($_GET['status']==2 AND $noid->f(shop_id)==0) {
												$q = "SELECT * FROM `member` WHERE active ='2' ORDER BY shop_id DESC LIMIT 0,1 ";
												$rowid= new nDB();
												$rowid->query($q);
												$rowid->next_record();
												$shop_id = $rowid->f(shop_id);
												$q = "update `member` set shop_id = '".$shop_id."'+1 WHERE `id` = '".$_GET['no_id']."' ";
												$db->query($q);
											}
											redi2();
										}
										
										if($_GET['hot_id']){
											$q = "update `member` set hot='".$_GET['hot']."' WHERE `id` =".$_GET['hot_id']." ";
											$db->query($q);
											redi2();
										}
										// if($_GET['d_shop_id']){
										// 	$q = "DELETE FROM `member` WHERE `id` =".$_GET['d_shop_id']." ";
										// 	$db->query($q);
										// 	$q = "DELETE FROM `product` WHERE `shop_id` =".$_GET['d_shop_id']." ";
										// 	$db->query($q);		
										// }
										$q = "SELECT * FROM `member` WHERE type = 2 or  type = 3 ORDER BY id DESC";
										$db->query($q);
										static $v = 1;
										while($db->next_record()){
										?>
									<tr class="sidemenu" bgcolor="<?=($v%2==0)?"#3c1204":"#2f0d02"?>">
										<td height="25" align="center"><a href="/member_profile.php?member_id=<?=$db->f(id)?>" target="_blank" style="color:#FC0"><?=$db->f(name)?></a></td>
										<td align="center"><?=$db->f(username)?></td>
										<td align="center">
											<?=$db->f(mobile)?>		
										</td>
										<td align="center"><?=$db->f(email)?></td>
										<td align="center">
											<?php
												if($db->f(active)=='0'){
												?>
											<a href="?no_id=<?=$db->f(id)?>&status=1" >
											<img src="../images/stop.png" alt="Disable" width="24" height="24" border="0">
											</a>
											<?php
												}
												if($db->f(active)=='1'){
												?>
											<a href="?no_id=<?=$db->f(id)?>&status=2" >
											<img src="../images/wait.png" alt="Pause" width="24" height="24" border="0">
											</a>
											<?php
												}
												if($db->f(active)=='2'){
												?>
											<a href="?no_id=<?=$db->f(id)?>&status=0" >
											<img src="../images/play.png" alt="Enable" width="24" height="24" border="0">
											</a>
											<?php
												}
												?>
										</td>
                                        <td align="center"><a href="../member_file/<?=$db->f(file3)?>"><img src="../images/list.png" /></a></td>
                                        <td align="center"><a href="../img_profile/<?=$db->f(pic2)?>" target="_blank"><img src="../images/edit.gif" width="19" height="23" border="0" /></a></td>
										<td align="center"><a href="edit_member.php?shop_id=<?=$db->f(id)?>"><img src="../images/edit.gif" width="19" height="23" border-"0" /></a></td>
										<td align="center"><a href="?d_shop_id=<?=$db->f(id)?>" onClick="return confirm('คุณต้องการลบร้านค้านี้จริงหรือไม่ ?')"><img src="../images/del.gif" width="19" height="23" border="0" /></a></td>
									</tr>
									<?php $v++; } ?>
								</table>
							</td>
						</tr>
					</table>
				</td>
			</tr>
		</table>
	</body>
</html>