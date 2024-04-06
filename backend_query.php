<?php
	include("global.php");
?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<?php
	$do_what = $_POST["do_what"];

	/*if($do_what == "leave_name"){
		$name_text = $_POST["name_text"];
		$n_name = mysql_num_rows(mysql_query("select * from pra_translate_name where name_text = '$name_text'"));
		if($n_name == 0){
			mysql_query("insert into pra_translate_name( name_id, name_text, leave_date ) values( '', '$name_text', '".date("Y-m-d H:i:s")."' )");
		}
	}*/

	if($do_what == "translate_name"){
		$v = trim($_POST["v"]);
		if($v != ""){
			$qlike_thai = mysql_query("select * from pra_translate_name where name_text like '%$v%' group by name_translated limit 5");
			$nlike_thai = mysql_num_rows($qlike_thai);
			if($nlike_thai > 0){
				$q_thai = mysql_query("select * from pra_translate_name where name_text = '$v'");
				$n_thai = mysql_num_rows($q_thai);
				if($n_thai > 0){
?>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
	<?php
		while($thai = mysql_fetch_array($q_thai)){
	?>
	<tr>
		<td class="translated_td" onclick="name_select($(this));">
			<?=$thai["name_translated"]?>
		</td>
	</tr>
	<?php
		}
	?>
</table>
<?php
				}else{
?>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
	<?php
		while($like_thai = mysql_fetch_array($qlike_thai)){
	?>
	<tr>
		<td class="translated_td" onclick="name_select($(this));">
			<?=$like_thai["name_translated"]?>
		</td>
	</tr>
	<?php
		}
	?>
</table>
<?php
				}
			}else{
				$qlike_china = mysql_query("select * from pra_translate_name where name_translated like '%$v%' group by name_text limit 5");
				$nlike_china = mysql_num_rows($qlike_china);
				if($nlike_china > 0){
					$q_china = mysql_query("select * from pra_translate_name where name_translated = '$v'");
					$n_china = mysql_num_rows($q_china);
					if($n_china > 0){
?>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
	<?php
		while($china = mysql_fetch_array($q_china)){
	?>
	<tr>
		<td class="translated_td" onclick="name_select($(this));">
			<?=$china["name_text"]?>
		</td>
	</tr>
	<?php
		}
	?>
</table>
<?php
					}else{
?>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
	<?php
		while($like_china = mysql_fetch_array($qlike_china)){
	?>
	<tr>
		<td class="translated_td" onclick="name_select($(this));">
			<?=$like_china["name_text"]?>
		</td>
	</tr>
	<?php
		}
	?>
</table>
<?php
					}
				}
			}
		}
	}

	if($do_what == "pm_member_search"){
		$v = trim($_POST["v"]);
		$member = new nDB();
		$member->query("select * from member where name like '%$v%' limit 5");
		$n_member = $member->num_rows();
		if($n_member > 0){
?>
<table border="0" cellpadding="0" cellspacing="0">
	<?php
		while($member->next_record()){
	?>
	<tr>
		<td class="dropdown_td" onclick="dropdown_select($(this));" attr_id="<?=$member->f('id')?>">
			<?=$member->f("name")?>
		</td>
	</tr>
	<?php
		}
	?>
</table>
<?php
		}
	}

	if($do_what == "namepra_search"){
		$v = str_replace(" ","",trim($_POST["v"]));
		$member = new nDB();
		$member->query("select * from catalog_cn where Replace(catalog_name, ' ', '') like '%$v%' and top_id = '1' order by Replace(catalog_name, ' ', '') like '$v%' desc, Replace(catalog_name, ' ', '') != '$v' desc limit 5");

		$n_member = $member->num_rows();
		if($n_member > 0){
?>
<table border="0" cellpadding="0" cellspacing="0">
	<?php
		while($member->next_record()){
	?>
	<tr>
		<td style="padding:5px; background-color:#f5f5f5; border-bottom:1px solid #e1e1e1; cursor:pointer;color: #29A60E;" onclick="namepra_select('<?=$member->f("catalog_name_cn")?>');">
			<?=$member->f("catalog_name")?>
		</td>
	</tr>
	<?php
		}
	?>
</table>
<?php
		}
	}

	if($do_what == "mass_search"){
		$v = str_replace(" ","",trim($_POST["v"]));
		$member = new nDB();
		$member->query("select * from catalog_cn where Replace(catalog_name, ' ', '') like '%$v%' and top_id in (1,2,5,6,9,10) limit 5");
		$n_member = $member->num_rows();
		if($n_member > 0){
?>
<table border="0" cellpadding="0" cellspacing="0">
	<?php
		while($member->next_record()){
	?>
	<tr>
		<td style="padding:5px; background-color:#f5f5f5; border-bottom:1px solid #e1e1e1; cursor:pointer;color: #29A60E;" onclick="mass_select('<?=$member->f("catalog_name_cn")?>','<?=$member->f("catalog_id")?>');">
			<?=$member->f("catalog_name")?>
		</td>
	</tr>
	<?php
		}
	?>
</table>
<?php
		}
	}

	if($do_what == "roon_search"){
		$v = str_replace(" ","",trim($_POST["v"]));
		$member = new nDB();
		$member->query("select * from catalog_cn where Replace(catalog_name, ' ', '') like '%$v%' and top_id in (1,2,5,6,9,10) limit 5");
		$n_member = $member->num_rows();
		if($n_member > 0){
?>
<table border="0" cellpadding="0" cellspacing="0">
	<?php
		while($member->next_record()){
	?>
	<tr>
		<td style="padding:5px; background-color:#f5f5f5; border-bottom:1px solid #e1e1e1; cursor:pointer;color: #29A60E;" onclick="roon_select('<?=$member->f("catalog_name_cn")?>','<?=$member->f("catalog_id")?>');">
			<?=$member->f("catalog_name")?>
		</td>
	</tr>
	<?php
		}
	?>
</table>
<?php
		}
	}

	if($do_what == "pim_search"){
		$v = str_replace(" ","",trim($_POST["v"]));
		$member = new nDB();
		$member->query("select * from catalog_cn where Replace(catalog_name, ' ', '') like '%$v%' and top_id in (1,2,5,6,9,10) limit 5");
		$n_member = $member->num_rows();
		if($n_member > 0){
?>
<table border="0" cellpadding="0" cellspacing="0">
	<?php
		while($member->next_record()){
	?>
	<tr>
		<td style="padding:5px; background-color:#f5f5f5; border-bottom:1px solid #e1e1e1; cursor:pointer;color: #29A60E;" onclick="pim_select('<?=$member->f("catalog_name_cn")?>','<?=$member->f("catalog_id")?>');">
			<?=$member->f("catalog_name")?>
		</td>
	</tr>
	<?php
		}
	?>
</table>
<?php
		}
	}

	if($do_what == "wat_search"){
		$v = str_replace(" ","",trim($_POST["v"]));
		$member = new nDB();
		$member->query("select * from catalog_cn where Replace(catalog_name, ' ', '') like '%$v%' and top_id in (1,2,5,6,9,10) limit 5");
		$n_member = $member->num_rows();
		if($n_member > 0){
?>
<table border="0" cellpadding="0" cellspacing="0">
	<?php
		while($member->next_record()){
	?>
	<tr>
		<td style="padding:5px; background-color:#f5f5f5; border-bottom:1px solid #e1e1e1; cursor:pointer;color: #29A60E;" onclick="wat_select('<?=$member->f("catalog_name_cn")?>');">
			<?=$member->f("catalog_name")?>
		</td>
	</tr>
	<?php
		}
	?>
</table>
<?php
		}
	}

	if($do_what == "geji_search"){
		$v = str_replace(" ","",trim($_POST["v"]));
		$member = new nDB();
		$member->query("select * from catalog_cn where Replace(catalog_name, ' ', '') like '%$v%' and top_id in (1,2,5,6,9,10) limit 5");
		$n_member = $member->num_rows();
		if($n_member > 0){
?>
<table border="0" cellpadding="0" cellspacing="0">
	<?php
		while($member->next_record()){
	?>
	<tr>
		<td style="padding:5px; background-color:#f5f5f5; border-bottom:1px solid #e1e1e1; cursor:pointer;color: #29A60E;" onclick="geji_select('<?=$member->f("catalog_name_cn")?>');">
			<?=$member->f("catalog_name")?>
		</td>
	</tr>
	<?php
		}
	?>
</table>
<?php
		}
	}
	if($do_what == "catalog_name"){
		$v = trim($_POST["v"]);
		$member = new nDB();
		$member->query("select * from catalog_all where catalog_name like '%$v%' and top_id = '1' limit 5");
		$n_member = $member->num_rows();
		if($n_member > 0){
?>
<table border="0" cellpadding="0" cellspacing="0">
	<?php
		while($member->next_record()){
	?>
	<tr>
		<td style="padding:5px; background-color:#f5f5f5; border-bottom:1px solid #e1e1e1; cursor:pointer;color: #29A60E;" onclick="namecatalog_select('<?=$member->f("catalog_name")?>/<?=$member->f("catalog_name_cn")?>');">
			<?=$member->f("catalog_name")?>/<?=$member->f("catalog_name_cn")?>
		</td>
	</tr>
	<?php
		}
	?>
</table>
<?php
		}
	}

?>
