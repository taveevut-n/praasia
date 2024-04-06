<?php
	include("global.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

	<META HTTP-EQUIV="Refresh" CONTENT="5">

	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>

	<title>
		Untitled Document
	</title>

	<style type="text/css">
		html, body {
			margin:0px;
			padding:0px;
			width:100%;
			height:100%;
		}
		body{
			font-size:12px;
			background-color:#f5f5f5;
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
<table width="100%" border="0" cellpadding="0" cellspacing="0">
	<tr>
		<td style="padding:5px; padding-left:10px; padding-right:10px;">
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
				<?php
					$q = "SELECT * FROM `prachat` WHERE 1 ORDER BY prachat_id DESC LIMIT 0,100 ";
					$dbchat = new nDB();	
					$dbchat->query($q);
					while($dbchat->next_record()) {
						$q = "SELECT * FROM `member` WHERE id = '".$dbchat->f(member_id)."' ";
						$memchat = new nDB();
						$memchat->query($q);
						$memchat->next_record();
						if( substr($dbchat->f(prachat_txt),0,4) == "<img" ){
							$chat_height = "44px";
						}else{
							$chat_height = "25px";
						}
				?>
				<tr>
					<td height="<?=$chat_height?>" style="padding:0px; vertical-align:bottom;">
						<table width="100%" border="0" cellpadding="0" cellspacing="0">
							<tr>
								<td style="padding-top:10px; width:1px; vertical-align:top; white-space:nowrap;">
									<?php
										if($memchat->f(shop_id) == 0){
									?>
									<span>
										<?=$memchat->f(name)?>
									</span>
									<?php
										}else{
									?>
									<a href="/shop_index.php?shop=<?=$memchat->f(id)?>" style="color:#FC0">
										<?=$memchat->f(shopname)?>
									</a>
									<?php
										}
									?>
								</td>
								<td style="padding-top:10px; padding-left:5px; padding-right:5px; width:1px; vertical-align:top;">
									:
								</td>
								<td style="padding-top:10px; vertical-align:top; color:#000000;">
									<?=$dbchat->f(prachat_txt)?>
								</td>
							</tr>
						</table>
					</td>
				</tr>
				<?php
					}
				?>
			</table>
		</td>
	</tr>
</table>
</body>
</html>
