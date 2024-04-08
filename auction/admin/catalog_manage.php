<?php
	include('head.php');
	include('../config/function.php');
?>
<body>
	<div id="wrapper">
		<?php
			include('header.php');
			?>
		<div id="container">
			<div class="box_content">
				<table width="1000px" border="0" align="center" cellpadding="0" cellspacing="0" class="catalogn_table">
					<tr>
						<td width="200px" valign="top" style="background: rgb(82, 36, 15);">
							<? include('left_menu.php');?>
						</td>
						<td width="800px" valign="top" height="100%" style="background: rgb(82, 36, 15);">
							<table width="100%" border="0" cellpadding="0" cellspacing="0">
								<tr>
									<td class="title">
										<span class="text_title">
											หมวดสินค้าทั่วไป
										</span>
									</td>
								</tr>
								<tr>
									<td>
										<table width="100%" border="0" cellpadding="0" align="center" cellspacing="0" class="tb_listdata">
											<tr align="center">
											  <td colspan="3"></td>
											</tr>
											<tr align="center">
											  <td class="title_table">ชื่อหมวดสินค้า</td>
											  <td class="title_table">แสดง</td>
											  <td class="title_table">แก้ไข</td>
											  <td class="title_table">ลบ</td>
											</tr>
											<?
											$sqlTopCal = mysql_query("SELECT * FROM `auc_catalog_all` WHERE top_id = 0 ORDER BY catalog_id");
											while ($rTopCal = mysql_fetch_array($sqlTopCal)) {
												?>
											<tr>
											  <td bgcolor="#1c0801" style="padding-left:3px"><span style="color:#AB0D0D; font-size:12px">
												<?=$rTopCal[catalog_name]?> / <?=$rTopCal[catalog_name_cn]?>
											  </span></td>
											  <td bgcolor="#1c0801"  width="1" align="center" >

											  </td>
											  <td width="1" align="center" bgcolor="#1c0801"><span class="sidemenu"><a href="?e_sub_id=<?=$rTopCal[catalog_id]?>" ><img src="http://praasia.com/admin/images/edit.gif" alt="แก้ไข" width="19" height="23" border="0" /></a></span></td>
											  <td width="1" align="center" bgcolor="#1c0801" ><span class="sidemenu"><a href="?d_sub_id=<?=$rTopCal[catalog_id]?>"  onclick="return confirm('ยืนยันการลบข้อมูล')"><img src="http://praasia.com/admin/images/del.gif" alt="ลบ" width="19" height="23" border="0" /></a></span></td>
											</tr>
											<?php
												$q1="SELECT * FROM `auc_catalog_all` WHERE top_id = '".$rTopCal[catalog_id]."' ORDER BY catalog_id  ";
												$db5=mysql_query($q1);
												static $v=1;
												if(mysql_num_rows($db5)!=0){
													while($rsub = mysql_fetch_array($db5)){
														?>
													<tr  bgcolor="<?=($v%2==1)?"#3c1204":"#2f0d02"?>">
								                      <td ><span class="sidemenu">
								                       	<?=$rsub[catalog_id].' - '.$rsub[catalog_name]?> / <?=$rsub[catalog_name_cn]?>
								                      </span></td>
								                      <td width="1" align="center">
								                      		<?php
								                      			if($rsub[catalog_show] == 1){
								                      				$text_val = "0";
								                      				$text_control = "hide";
								                      				$text_checked = "checked";
								                      			}else{
								                      				$text_val = "1";
								                      				$text_control = "show";
								                      				$text_checked = "";
								                      			}
								                      		?>
														  	<input type="checkbox" <?=$text_checked?> onclick="selectCatg('<?=$text_val?>',<?=$rsub[catalog_id]?>)">
													  </td>
								                      <td width="1" align="center" ><span class="sidemenu"><a href="?e_sub_id=<?=$rsub[catalog_id]?>" ><img src="http://praasia.com/admin/images/edit.gif" alt="แก้ไข" width="19" height="23" border="0" /></a></span></td>
								                      <td width="1" align="center" ><span class="sidemenu"><a href="?d_sub_id=<?=$rsub[catalog_id]?>"  onclick="return confirm('ยืนยันการลบข้อมูล')"><img src="http://praasia.com/admin/images/del.gif" alt="ลบ" width="19" height="23" border="0" /></a></span></td>
								                    </tr>
														<?
													}
								                } 
											}
											?>
										  </table>
									</td>
								</tr>
							</table>
						</td>
					</tr>
				</table>
			</div>
		</div>
		<?php
			include('footer.php');
		?>
	</div>
	<script type="text/javascript">
		function selectCatg(_val,_id){
			$.ajax({
				url: 'index_query.php',
				type: 'POST',
				data: {do_what:"selectCatg",_val:_val,_id:_id},
				success: function (result) {
					console.log(result)
				}
			});
		}
	</script>
</body>
</html>