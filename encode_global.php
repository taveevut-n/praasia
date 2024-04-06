<?php
session_start();
if(eregi("^C",$_SERVER['SCRIPT_FILENAME'])){

	$global_vars = array(
		
	"DB_HOST"		=>	"localhost",
	"DB_NAME"		=>	"prathai_new",
	"DB_USER"		=>	"prathai_new",
	"DB_PWD"		=>	"twe31219#",

	
	"ENDPOINT"		=>	""
	
	);


}else{
// /hsphere/local/home/academic/amerifob.com/

	$global_vars = array(
		
	"DB_HOST"		=>	"localhost",
	"DB_NAME"		=>	"prathai_new",
	"DB_USER"		=>	"prathai_new",
	"DB_PWD"		=>	"twe31219#",

	
	"ENDPOINT"		=>	""
	
	);
}
	include("inc/config.php");
	include_once("func/zabi_func.php"); 		
	include_once("func/zabi_page.php"); 		
	include_once("func/zabi_board.php");	
	$host="localhost";
	$user="prathai_new";
	$pass="twe31219#";
	$db=@mysql_connect($host,$user,$pass);
	mysql_select_db("prathai_new");
	mysql_query("SET NAMES UTF8");
	mysql_query("SET character_set_results=utf8");
	mysql_query("SET character_set_client=utf8");
	mysql_query("SET character_set_connection=utf8");	
	
	$db= new nDB();

	$conn = mysql_connect("localhost","prathai_new","twe31219#");
	mysql_select_db("prathai_new",$conn);
	mysql_query("SET NAMES UTF8");
	mysql_query("SET character_set_results=utf8");
	mysql_query("SET character_set_client=utf8");
	mysql_query("SET character_set_connection=utf8");



	// $q = mysql_query("select * from member where date_expire < '".strtotime(date("Y-m-d"))."' and type = '0'");
	// while($r = mysql_fetch_array($q)){
	// 	mysql_query("update product set active = '0' where shop_id = '".$r["id"]."'");
	// }
	// mysql_query("update member set active = '1' where date_expire < '".strtotime(date("Y-m-d"))."' and type = '0'");

	if ($_SESSION['adminshop_id']){
		if (!file_exists('file/'.$_SESSION['adminshop_id'])) {
		mkdir('file/'.$_SESSION['adminshop_id'], 0777 );
		chown('file/'.$_SESSION['adminshop_id'], 'prathai');
		}
	}


	function check_user_agent( $type = NULL ) {
		$user_agent = strtolower ( $_SERVER['HTTP_USER_AGENT'] );
		if ( $type == 'bot' ) {
			if ( preg_match ( "/googlebot|adsbot|yahooseeker|yahoobot|msnbot|watchmouse|pingdom\.com|feedfetcher-google/", $user_agent ) ) {
				return true;
			}
		} else if ( $type == 'browser' ) {
			if ( preg_match ( "/mozilla\/|opera\//", $user_agent ) ) {
				return true;
			}
		} else if ( $type == 'mobile' ) {
			if ( preg_match ( "/phone|iphone|itouch|ipod|symbian|android|htc_|htc-|palmos|blackberry|opera mini|iemobile|windows ce|nokia|fennec|hiptop|kindle|mot |mot-|webos\/|samsung|sonyericsson|^sie-|nintendo/", $user_agent ) ) {
				return true;
			} else if ( preg_match ( "/mobile|pda;|avantgo|eudoraweb|minimo|netfront|brew|teleca|lg;|lge |wap;| wap /", $user_agent ) ) {
				return true;
			}
		}
		return false;
	}
	$ismobile = check_user_agent('mobile');

	if($_COOKIE["member_id"] != ""){
		$_SESSION["member_id"] = $_COOKIE["member_id"];
	}
	if($_COOKIE["adminshop_id"] != ""){
		$_SESSION["adminshop_id"] = $_COOKIE["adminshop_id"];
	}
	if($_COOKIE["nameshop"] != ""){
		$_SESSION["nameshop"] = $_COOKIE["nameshop"];
	}

?>
