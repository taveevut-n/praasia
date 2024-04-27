<? include('../global.php');?>
<?php if($_SESSION['adminid']=='' || !isset($_SESSION['adminid'])) {  
	redi4("retime.php");
} ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<title>ระบบจัดการเว็บไซต์</title>
		<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
		<style type="text/css">
			body {
				background-color: #000;
				margin-left: 0px;
				margin-top: 0px;
				margin-right: 0px;
				margin-bottom: 0px;
			}
			.bh {
				color:#FC0;
				font-size:14px;
				height:30px;
			}
			.sidemenu {
				color:#FFF;
				font-size:12px;
				height:25px;
				border-bottom:1px solid #000;
				text-decoration:none;
			}
			.sidemenu:hover {
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
		<script type="text/javascript" src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
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
								<? 
									include('sidemenu.php') 
								?>
							</td>
							<td valign="top" bgcolor="#3f1d0e">
								<style type="text/css">
									.btnview{
										display: inline-block;
										margin-bottom: 0;
										font-weight: normal;
										text-align: center;
										vertical-align: middle;
										cursor: pointer;
										background-image: none;
										border: 1px solid transparent;
										white-space: nowrap;
										padding: 1px 8px;
										font-size: 14px;
										line-height: 1.42857143;
										border-radius: 2px;
										-webkit-user-select: none;
										-moz-user-select: none;
										-ms-user-select: none;
										user-select: none;
										background: rgb(240, 231, 231);
										opacity: 0.8;
									}
									.btnview:hover{
										opacity: 1;
									}
									.box_retime{
										background-color: transparent;
										position: relative;
										top: 0;
										left: 0;
										margin: 0;
										padding: 0;
										display: none;
									}
									.retime{
										background-color:transparent;
										width: auto;
										height: auto;
										position: relative;
									}
									.panal_retime{
										background-color: transparent;
									}
									.retime .close{
										border: 1px rgb(194, 173, 173) solid;
										text-decoration: none;
										padding: 1px 6px;
										font-size: 13px;
										font-family: "Arial Black", Gadget, sans-serif;
										background-color: rgb(250, 229, 229);
										color: rgb(226, 66, 66);
										cursor: pointer;
									}
									.text_time{
										padding-right: 20px;
									}
								</style>
								<table width="95%" border="1" align="center" cellpadding="3" cellspacing="0" bordercolor="#2a1100" style="border-collapse:collapse">
									<tr class="bh" align="center">
										<td width="23%" height="30" bgcolor="#5f2206">ชื่อร้าน</td>
										<td width="10%" bgcolor="#5f2206">หลักฐาน</td>
										<td width="10%" bgcolor="#5f2206">สถานะ</td>
										<td width="7%" bgcolor="#5f2206">ต่ออายุ</td>
										<td width="1%" bgcolor="#5f2206">ลบ</td>
									</tr>
									<?php
										$q = "SELECT * FROM member WHERE type = '0' AND NOT id= '1' ORDER BY id DESC limit 5";
										$db= new nDB();
										$db->query($q);
										static $v = 1;
										$index =0;
										while($db->next_record()){
										?>
											<tr class="sidemenu" bgcolor="<?=($v%2==0)?"#3c1204":"#2f0d02"?>">
												<td height="25" align="center"><?=$db->f(shop_id)?> - <?=$db->f(shopname)?></td>
												<td align="center">
													<?php
														$q2 = "SELECT * FROM member_pay WHERE shop_id = '".$db->f(shop_id)."' ";
														$rspremise= new nDB();
														$rspremise->query($q2);
														$rspremise->next_record();
														if($rspremise->f(pic1)!=""){
															echo '<a class="btnview" target="_blank" href="../payment_file/'.$rspremise->f(pic1).'"><i class="fa fa-search"></i></a>';
														}else{
															echo "";
														}
													?>
												</td>
												<td align="center">
													<?php
														$q2 = "SELECT * FROM member_pay WHERE shop_id = '".$db->f(shop_id)."' ";
														$rspremise= new nDB();
														$rspremise->query($q2);
														$rspremise->next_record();
														if($rspremise->f(pic1)!=""){
															echo '<a class="btnview" target="_blank" href="../payment_file/'.$rspremise->f(pic1).'"><i class="fa fa-search"></i></a>';
														}else{
															echo "";
														}
													?>
												</td>
												<td align="center">
													<div class="box_retime">
														<div class="retime">
															<div class="panal_retime">
																<table align="center" border="0" cellpadding="0" cellspacing="0">
																	<tr>
																		<td align="right"><input type="text" class="text_time" name="username"></td>
																		<td align="left"><span class="close" index="<?=$index;?>" onclick="settimeclose($(this))">x</span></td>
																	</tr>
																</table>
															</div>
														</div>
													</div>
													<a class="btnview settime" href="javascript:void(0)" index="<?=$index;?>" onclick="settime($(this))"><i class="fa fa-clock-o"></i></a>
												</td>
												<td align="center">
													<a class="btnview" href="javascript:void(0)" onclick="if(confirm('ยืนยันการลบอีกครั้ง')){window.location.href = '?d_shop_id=<?=$rspremise->f(payment_id);?>'}else{return false;}"><i class="fa fa-trash-o"></i></a>
												</td>
											</tr>
										<?php 
										$v++;
										$index ++;
									} ?>
								</table>
							</td>
						</tr>
					</table>
				</td>
			</tr>
		</table>
	</body>
	<script type="text/javascript">
		function settime(x_this){
			var x_index = x_this.attr("index");
			$(".settime:eq("+x_index+")").fadeOut(500);
			$(".box_retime:eq("+x_index+")").fadeIn(500);
		}

		function settimeclose(x_this){
			var x_index = x_this.attr("index");
			$(".box_retime:eq("+x_index+")").fadeOut(500);
			$(".settime:eq("+x_index+")").fadeIn(500);
		}
	</script>
</html>