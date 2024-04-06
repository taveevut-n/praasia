<?php
	#Cread by taveevut nakomah
	#Created 2015

  	function Insert($tb_name,$data){
		$x_clm = array();
		$x_val = array();

		foreach ($data as $key => $value) {
			array_push($x_clm,$key);
			array_push($x_val,$value);
		}

		return mysql_query("INSERT INTO $tb_name (".implode(', ', $x_clm).") VALUES ('".implode('\', \'', $x_val)."')");
	}

	function Update($tb_name,$data){
		$x_clm = array();
		$x_val = array();

		foreach ($data[0] as $key => $value) {
			array_push($x_val,$key."='".$value."'");
		}

		foreach ($data[1] as $key => $value) {
			array_push($x_clm,$key."='".$value."'");
		}

		return mysql_query("UPDATE $tb_name SET ".implode(', ', $x_clm)." WHERE ".implode(', ', $x_val));
	}


	// public function session_member($tb_name,$data,$session_member)
	// {
	// 	$x_clm = array();
	// 	$x_val = array();

	// 	foreach ($data[0] as $key => $value) {
	// 		array_push($x_val,$key."='".$value."'");
	// 	}

	// 	foreach ($data[1] as $key => $value) {
	// 		array_push($x_clm,$key."='".$value."'");
	// 	}

	// 	return mysql_query("UPDATE $tb_name SET ".implode(', ', $x_clm)."  WHERE  id = '".$session_member."' ");
	// }



	function Delete($tb_name,$data){
		$x_val = array();
		
		foreach ($data as $key => $value) {
			array_push($x_val,$key."='".$value."'");
		}

		return mysql_query("DELETE FROM $tb_name WHERE ".implode(', ', $x_val));
	}
?>
