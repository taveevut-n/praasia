<? include('global.php'); ?>
<?
$q="SELECT * FROM `member` WHERE shop_date = 0000-00-00  ";
$check= new nDB();
$check->query($q);
$total=$check->num_rows();  
while($check->next_record()){
			$q = "update `member` set shop_date = '".date("Y-m-d",$check->f(date_add))."' WHERE `id` = '".$check->f(id)."' ";
			$db->query($q);
}
al('Complete');
?>
