<?php
	include('../global.php');

	include('head.php');
	include('config/function.php');
	// echo date("Y-m-d H:i:s");
	?>
<body>
	<div id="wrapper">
		<?php
			include('header.php');
			?>
		<div id="container">
			<div class="box_content">
				<table width="1000px" border="0" align="center" cellpadding="0" cellspacing="0" class="table">
					<tr>
						<td colspan="2" bgcolor="#4A1701" class="head_contain" style="padding-left: 11px;text-align:left;">
							<span class="text_yellpw"><b>รายการหมวดหมู่</b></span>
						</td>
					</tr>
					<tr>
						<td colspan="2" align="center" style="height:100%;">
							<table width="100%" border="0" cellpadding="0" cellspacing="0" class="table condition_tb_textjustify">
								<tr style="background: rgb(163, 162, 162);">
									<td align="center">
										<span class="headtable">ชื่อหมวดหมู่</span>
									</td>
									<td align="center">
										<span class="headtable">เข้าชม</span>
									</td> 
								</tr>
								<?php 

								$sql = "SELECT * FROM `auc_catalog_all` WHERE top_id = 0 ORDER BY catalog_id";
								$query = mysql_query($sql);
								$l = 1;
								while ($dbcatalog = mysql_fetch_array($query)) {
									if($l % 2 == 0){
										$change_color = 'style="background:#E9D7C6;"';
									}else{
										$change_color = 'style="background:#eee;"';
									}
								?>
								<tr <?=$change_color;?> >
									<td align="left" class="cat-title-lst">
										<?php echo substr((100+$dbcatalog['catalog_id']),1);?> - <a class="link_cat" href="list_data.php?id_cat=<?php echo $dbcatalog['catalog_id'];?>"><?php echo $dbcatalog['catalog_name'];?></a>
									</td>
									<td align="center" width="1">
										<?= $dbauction['reg_view']?>
									</td>
								</tr>
								<?php
									$subcat = "SELECT * FROM `auc_catalog_all` WHERE top_id = '".$dbcatalog['catalog_id']."' AND catalog_show = 1 ORDER BY catalog_id";
									$qsubcat = mysql_query($subcat);
									while ($dbcatalogsubcat = mysql_fetch_array($qsubcat)) {
										?>
								<tr>
									<td align="left">
										&nbsp;&nbsp;&nbsp;<a class="link_cat" target="_blank" href="list_data.php?id_cat=<?php echo $dbcatalogsubcat['catalog_id'];?>"><?php echo substr((100+$dbcatalogsubcat['catalog_id']),1).' - '.$dbcatalogsubcat['catalog_name'];?></a>
									</td>
									<td align="center" width="1">
										<span class="review"><?php echo $dbcatalogsubcat['review'];?></span>
									</td>
								</tr>
										<?php
									}
								?>
								<?php
								$l++;
								}
								?>
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
</body>
</html>