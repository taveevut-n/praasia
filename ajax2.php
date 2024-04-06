<?
	//************ MySQL Check *************//
	mysql_connect("localhost","prathai_new","twe31219#");
	mysql_select_db("prathai_new");
	$strSQL = "SELECT * FROM member WHERE shopname= '".trim($_POST["shopname"])."' ";
	$objQuery = mysql_query($strSQL);
	$intRows = mysql_num_rows($objQuery);
	$color1='#ff0000';
	$color2='#00802a';
	  if($intRows>0)
	  {
		echo "<font color='red'>".$_POST["shopname"]." ชื่อนี้ไม่สามารถใช้ได้ กรุณาลองใหม่อีกครั้ง / 这个商店名已经被用</font>";
		$check='yes';
	  }else{
		echo "<font color='green'>".$_POST["shopname"]." ชื่อนี้สามารถใช้งานได้ / 这个商店名能用</font>";
		$check='no';
	  }
?>
