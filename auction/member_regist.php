<?php
	include('../global.php');
	
	include('head.php');
	?>
<body>
	<div id="wrapper">
		<?php
			include('header.php');
			?>
		<div id="container">
			<?
			if($_POST['accept'] != 1){
			?>
			<div>
				<table width="800" border="1" align="center" cellpadding="1" cellspacing="1" class="regist-tb none-border">
					<tr>
						<td>
							&nbsp;
						</td> 
					</tr>
					<tr>
						<td style="font-size: 14px;color:#AFAFAF;text-align: justify;">
							<?=$language['regist_conditon'];?>
						</td>
					</tr>
					<tr align="center">
						<td>
							<form method="post" action="">
							<table border="0" cellpadding="0" align="center" cellspacing="0">
								<tr>
									<td>
										<input type="hidden" name="accept" value="1">
										<input type="submit" value="<?=$language['accept'];?>">
									</td>
									<td>
										<input type="button" value="<?=$language['noaccept'];?>">
									</td>
								</tr>
							</table>
							</form>
						</td> 
					</tr>
					<tr>
						<td>
							&nbsp;
						</td> 
					</tr>
					<tr>
						<td>
							&nbsp;
						</td> 
					</tr>
				</table>
			</div>
			<?
			}else if($_POST['accept'] == 1){
				?>
			<div class="box_content" id="containerregist">
				<? include('member_regist_form.php');?>
			</div>
				<?
			}
			?>
		</div>
		<?php
			include('footer.php');
			?>
	</div>
</body>
</html>