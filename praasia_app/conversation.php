<?php
	include("../global.php");

    $postdata = file_get_contents("php://input");
    $request = json_decode($postdata);
    $user_one = $request->user_one;
    $user_two = $request->user_two;
    $product_id = $request->product_id;

    if($user_one != $user_two){
        $sql = "select * from conversation where (user_one = '$user_one' and user_two = '$user_two') or (user_one = '$user_two' and user_two = '$user_one')";
        $q = mysql_query($sql);
        if (mysql_num_rows($q) == 0) {
            mysql_query("INSERT INTO conversation (`c_id`, `user_one`, `user_two`) VALUES (NULL, '$user_one', '$user_two')");
            mysql_query("INSERT INTO conversation_product (`cp_id`, `cp_product`, `c_id`) VALUES (NULL, '$product_id', '".mysql_insert_id()."')");
            echo mysql_insert_id();
        }else{
            $result = mysql_fetch_array($q);
            $q_product = mysql_query("SELECT * FROM conversation_product WHERE cp_product = '$product_id' AND c_id = '".$result['c_id']."'");
            if(mysql_num_rows($q_product) == 0){
                mysql_query("INSERT INTO conversation_product (`cp_id`, `cp_product`, `c_id`) VALUES (NULL, '$product_id', '".$result['c_id']."')");
                echo mysql_insert_id();
            }else{
                $rs_product = mysql_fetch_array($q_product);
                echo $rs_product['cp_id'];
            }
        }
    }
?>
