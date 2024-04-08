<style type="text/css">
	.table_package td{
		padding-left: 8px;
		padding-right: 8px;
	}
</style>
<table cellspacing="2" cellpadding="0" width="95%" border="0" align="center" class="table_package">
	<tbody>
		<tr bgcolor="#999999">
			<td align="center">
					<strong>package
						(บาท)</strong>
			</td>
			<td align="center">
					<strong>บัตรค่าธรรมเนียมการตั้งประมูล
						(บาท)</strong>
			</td>
			<td align="center"><strong>จำนวนที่สามารถตั้งประมูลได้
					(รายการ )</strong>
			</td>
			<td align="center"><strong>อายุการใช้งาน
					(วัน)</strong>
			</td>
		</tr>
		<?php
			$strpackage = mysql_query("select * from auc_couponpackage order by cp_pid asc");
			$l = 0;
			while ($rpackage = mysql_fetch_array($strpackage)) {
				$l++;
				if($l % 2 == 0){
					$text_color = '#99CCCC'; 
				}else{
					$text_color = '#99CCFF'; 
				}
				?>
		<tr bgcolor="<?=$text_color;?>">
			<td height="19" align="center">
				<b><?=$rpackage['cp_pname']?></b>
			</td>
			<td align="right">
				<?=$rpackage['cp_pprice']?>
			</td>
			<td align="right">
				<?=$rpackage['cp_pamout']?>
			</td>
			<td align="right">
				<?=$rpackage['cp_plifetime']?>
			</td>
		</tr>
				<?
			}
		?>
	</tbody>
</table>