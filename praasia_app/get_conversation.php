<?php
	include("../global.php");

	$sql = "SELECT * FROM conversation_reply AS cr, member AS m WHERE
		cr.user_id_fk = m.id AND
		cr.cp_id_fk = '".$_GET['cp_id']."'
		ORDER BY cr.cr_id ASC";
	$q=mysql_query($sql);
    $items = array();
    while ($row = mysql_fetch_object($q)) {
    	array_push($items, $row);
    }
    echo json_encode($items);
?>
