<style type="text/css">
	.tb_helpdata{
		border-collapse: collapse;
		background: rgb(238, 238, 238);
	}
	.tb_helpdata td p{
		color: rgb(15, 145, 30);
		font-size: 15px;
	}
	.title{
		color: rgb(243, 245, 243);
		background: rgb(8, 78, 14);
		font-size: 16px;
		font-weight: bold;
		line-height: 32px;
	}
</style>
<table width="100%" border="1" cellpadding="0" cellspacing="0" align="center" class="tb_helpdata">
	<tr>
		<td align="center" class="title">
			<?=$dbnews->f(topic)?>
		</td>
	</tr>
	<tr>
		<td>
			<?=$dbnews->f(detail)?>
		</td>
	</tr>
</table>
