<?php
	$counter = mysql_fetch_array(mysql_query("select * from counter order by id desc limit 1"));
	if( strtotime($counter["counter_date"]) < strtotime(date("Y-m-d")) ){
		mysql_query("insert into counter( id, counter, counter_date ) values( '', '1', '".date("Y-m-d")."' )");
	}else{
		mysql_query("update counter set counter = ( counter + 1 ) where id = '".$counter["id"]."'");
	}
?>
