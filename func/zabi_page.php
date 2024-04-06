<?php
	function sh_page($total,$s_page,$e_page,$chk_page,$f_txt,$e_txt,$p_color,$p2_color){
	?>
<style type="text/css">
	.pagination{
		padding: 5px;
	}
	.pagination ul{
		margin: 0;
		padding: 3px;
		text-align: center; /*Set to "right" to right align pagination interface*/
		font-size: 12px;
	}
	.pagination li{
		list-style-type: none;
		display: inline;
		padding-bottom: 1px;
	}
	.pagination a, .pagination a:visited{
		padding: 5px;
		border: 0px solid #666666;
		text-decoration: none; 
		color: #FFFFFF;
		/*padding: 0 5px;
		border: 0px solid #CC6633;
		text-decoration: none; 
		color: #CC6633;*/
	}
	.pagination a:hover, .pagination a:active{
		padding: 5px;
		border: 0px solid #666666;
		color: #000;  
		background-color: <?=$p2_color?>;
		/*border: 0px solid #CC6633;
		color: #CC6633;
		background-color: #FFFFFF;*/
	}
	.pagination li.currentpage{
		font-weight: bold;
		padding: 5px;
		border: 0px solid navy;
		background-color: <?=$p_color?>;       
		/*border: 0px solid #000000;
		background-color: #CC9966; */
		color: #FFF;
	}
	.pagination li.disablepage{
		padding: 0 5px;
		border: 0px solid #929292;
		color: #929292;
	}
	.pagination li.nextpage{
		font-weight: bold;
	}
	* html .pagination li.currentpage, * html .pagination li.disablepage{ /*IE 6 and below. Adjust non linked LIs slightly to account for bugs*/
		margin-right: 5px;
		padding-right: 0;
	}
</style>
<?php
	if (strpos($_SERVER['REQUEST_URI'], "?") == true) {
		$x_seach_v = $_GET['seach_v'];
		$x_q = $_GET['q'];
		$x_c = $_GET['c'];
		$x_g = $_GET['g'];

		if($x_seach_v != NULL){
			$url_seach_v = "&amp;seach_v=$x_seach_v";
		}

		if($x_q != NULL){
			$url_q = "&amp;q=$x_q";
		}

		if($x_c != NULL){
			$url_c = "&amp;c=$x_c";
		}

		if($x_g != NULL){
			$url_g = "&amp;g=$x_g";
		}

		$url_perpage = $url_seach_v.$url_q.$url_c.$url_g;
	}

	if(basename($_SERVER['PHP_SELF']) == "product_group.php"){ // page link on admin/product_group.php url
		if (strpos($_SERVER['REQUEST_URI'], "?") == true) {
			$url_perpage = "&q=".$_GET['q']."&c=".$_GET['c']."&g=".$_GET['g'];
		}
	}
	?>
<div class="pagination" >
	<ul>
		<?php if($chk_page==0){ ?>
		<li class="disablepage">&lt; <?=$f_txt?></li>
		<?php }else{ ?>
		<li class="nextpage"><a href="<?=$_SERVER['PHP_SELF']?>?s_page=<?=$chk_page-1?><?php echo $url_perpage;?>">&lt; <?=$f_txt?></a></li>
		<?php } ?>
		<?php for($s=0;$s<ceil($total/$e_page);$s++){ ?>
		<?php	if($chk_page==$s){ ?>
		<li class="currentpage"><?=$s+1?></li>
		<?php }else{ ?>
		<li><a href="<?=$_SERVER['PHP_SELF']?>?s_page=<?=$s?><?php echo $url_perpage;?>"><?=$s+1?></a></li>
		<?php } ?>
		<?php } ?>
		<?php if($chk_page==floor($total/$e_page)){ ?>
		<li class="disablepage"><?=$e_txt?> &gt;</li>
		<?php }elseif($total==$e_page){ ?>
		<li class="disablepage"><?=$e_txt?> &gt;</li>
		<?php }elseif($total-$s_page==$e_page){ ?>
		<li class="disablepage"><?=$e_txt?> &gt;</li>
		<?php }else{ ?>
		<li class="nextpage"><a href="<?=$_SERVER['PHP_SELF']?>?s_page=<?=$chk_page+1?><?php echo $url_perpage;?>"><?=$e_txt?> &gt;</a></li>
		<?php } ?>
	</ul>
</div>
<?php } ?>
<?php
	function set_page($s_page,$e_page){
			global $s_page,$chk_page;
		foreach($_GET as $key=>$value){
			$$key=$value;
		}
		if(!isset($e_page)){
			$e_page=3;
		}
		if(!isset($s_page)){
			$s_page=0;
		}else{
			$chk_page=$s_page;
			$s_page=$s_page*$e_page;
		}
	}
	?>
