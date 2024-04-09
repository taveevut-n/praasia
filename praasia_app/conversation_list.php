<?php
	include("../global.php");

    $sql = "SELECT c.c_id, m.shopname, m.id, m.head1 FROM conversation AS c, member AS m
        WHERE CASE
        WHEN c.user_one = '".$_GET['m_id']."'
        THEN c.user_two = m.id
        WHEN c.user_two = '".$_GET['m_id']."'
        THEN c.user_one = m.id
	      END
        AND (c.user_one = '".$_GET['m_id']."' OR c.user_two = '".$_GET['m_id']."')";
    $q = mysql_query($sql);

    $items = array();
    while ($row = mysql_fetch_array($q)) {
        $ext = strtolower(array_pop(explode('.',$row["head1"])));
        if( $ext == "jpg" || $ext == "jpeg" || $ext == "png" || $ext == "gif" ){
            $row['head1'] = "http://".$_SERVER['SERVER_NAME']."/slir/w120-h120-c120:120/img/head/".$row['head1'];
        }else{
            $row['head1'] = "http://".$_SERVER['SERVER_NAME']."/img/head/default.png";
        }
        array_push($items, $row);
    }
    $data['result'] = $items;
    
	echo json_encode($data);
?>