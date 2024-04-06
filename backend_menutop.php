<style>
	.menutop_table {
		width:100%;
		height:30px;
		background-color:#692908;
	}
	.menutop {
		width:1px;
	}
	.menutop table {
		width:100%;
		height:30px;
	}
	.menutop td {
		padding-left:20px;
		padding-right:20px;
		width:1px;
		white-space:nowrap;
		cursor:pointer;
	}
	.menutop td:hover {
		color:#ffcc00;
		background-color:#311407;
	}
	.menutop td:active {
		color:#ffcc00;
		background-color:#333333;
	}
</style>
<table class="menutop_table" style="" border="0" cellpadding="0" cellspacing="0">
	<tr>
		<td class="menutop">
			<a href="backend_pm_create.php" target="_self">
				<table border="0" cellpadding="0" cellspacing="0">
					<tr>
						<td>
							สร้างข้อความใหม่
							/
							编缉信息
						</td>
					</tr>
				</table>
			</a>
		</td>
		<td class="menutop">
			<a href="backend_pm.php" target="_self">
				<table border="0" cellpadding="0" cellspacing="0">
					<tr>
						<td>
							ข้อความขาเข้า / 收件箱
							(<?=mysql_num_rows(mysql_query("select * from twe_message where receiver_id = '".$_SESSION["adminshop_id"]."' and message_status = '0'"))?>)
						</td>
					</tr>
				</table>
			</a>
		</td>
		<td class="menutop">
			<a href="backend_pm_sent.php" target="_self">
				<table border="0" cellpadding="0" cellspacing="0">
					<tr>
						<td>
							ข้อความที่ส่งแล้ว / 已发送
							(<?=mysql_num_rows(mysql_query("select * from twe_message where sender_id = '".$_SESSION["adminshop_id"]."'"))?>)
						</td>
					</tr>
				</table>
			</a>
		</td>
		<td>&nbsp;
			
		</td>
	</tr>
</table>
