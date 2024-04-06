<?php
session_start();
// if(eregi("^C",$_SERVER['SCRIPT_FILENAME'])){

// 	$global_vars = array(
		
// 	"DB_HOST"		=>	"localhost",
// 	"DB_NAME"		=>	"prathai_new",
// 	"DB_USER"		=>	"prathai_new",
// 	"DB_PWD"		=>	"twe31219#",

	
// 	"ENDPOINT"		=>	""
	
// 	);


// }else{
// // /hsphere/local/home/academic/amerifob.com/

// 	$global_vars = array(
		
// 	"DB_HOST"		=>	"localhost",
// 	"DB_NAME"		=>	"prathai_new",
// 	"DB_USER"		=>	"prathai_new",
// 	"DB_PWD"		=>	"twe31219#",

	
// 	"ENDPOINT"		=>	""
	
// 	);
// }

	$global_vars = array(
		"DB_HOST"		=>	"localhost",
		"DB_NAME"		=>	"prathai_new",
		"DB_USER"		=>	"prathai_new",
		"DB_PWD"		=>	"twe31219#",
		"ENDPOINT"		=>	""
	);

//จะให้โพสต์แล้วเป็นภาษาไทยลบ connect ชุดนี้ เปิดชุดที่ comment
/*include("inc/config.php");
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
mysql_query("SET character_set_connection=utf8");*/

include 'inc/config.php';

$host = "localhost";
$user = "prathai_new";
$pass = "twe31219#";
$db = @mysql_pconnect($host, $user, $pass);
mysql_select_db("prathai_new");
mysql_query("SET NAMES UTF8");
mysql_query("SET character_set_results=utf8");
mysql_query("SET character_set_client=utf8");
mysql_query("SET character_set_connection=utf8");
$db = new nDB();
@include_once "language.php";
@include_once "func/zabi_func.php";
@include_once "func/zabi_page.php";

if (isset($_GET)) {
    foreach ($_GET as $key => $value) {
        $_GET[$key] = mysql_real_escape_string($value);
    }
}

// $db= new nDB();

// $conn = mysql_connect("localhost","prathai_new","twe31219#");
// mysql_select_db("prathai_new",$conn);
// mysql_query("SET NAMES UTF8");
// mysql_query("SET character_set_results=utf8");
// mysql_query("SET character_set_client=utf8");
// mysql_query("SET character_set_connection=utf8");

if ($_SESSION['adminshop_id']) {
    if (!file_exists('file/' . $_SESSION['adminshop_id'])) {
        mkdir('file/' . $_SESSION['adminshop_id'], 0777);
        chown('file/' . $_SESSION['adminshop_id'], 'prathai');
    }
}

function check_user_agent($type = null)
{
    $user_agent = strtolower($_SERVER['HTTP_USER_AGENT']);
    if ($type == 'bot') {
        if (preg_match("/googlebot|adsbot|yahooseeker|yahoobot|msnbot|watchmouse|pingdom\.com|feedfetcher-google/", $user_agent)) {
            return true;
        }
    } else if ($type == 'browser') {
        if (preg_match("/mozilla\/|opera\//", $user_agent)) {
            return true;
        }
    } else if ($type == 'mobile') {
        if (preg_match("/phone|iphone|itouch|ipod|symbian|android|htc_|htc-|palmos|blackberry|opera mini|iemobile|windows ce|nokia|fennec|hiptop|kindle|mot |mot-|webos\/|samsung|sonyericsson|^sie-|nintendo/", $user_agent)) {
            return true;
        } else if (preg_match("/mobile|pda;|avantgo|eudoraweb|minimo|netfront|brew|teleca|lg;|lge |wap;| wap /", $user_agent)) {
            return true;
        }
    }
    return false;
}
$ismobile = check_user_agent('mobile');

if ($_COOKIE["member_id"] != "") {
    $_SESSION["member_id"] = $_COOKIE["member_id"];
}
if ($_COOKIE["adminshop_id"] != "") {
    $_SESSION["adminshop_id"] = $_COOKIE["adminshop_id"];
}
if ($_COOKIE["nameshop"] != "") {
    $_SESSION["nameshop"] = $_COOKIE["nameshop"];
}

// language
if ($_GET["lang"] != "") {
    $_SESSION["current_language"] = $_GET["lang"];
}
if ($_SESSION["current_language"] == "") {
    $_SESSION["current_language"] = "th";
}
$language = array();
$q_language = mysql_query("select content_name, " . $_SESSION["current_language"] . " from auc_language order by content_id");
while ($r_language = mysql_fetch_array($q_language)) {
    $language[$r_language[0]] = $r_language[1];
}

function upload_origin($filepart, $path, $rename)
{
    copy($filepart, $path . $rename);
}
function upload_resize($filepart, $path, $rename, $w_resize)
{
    $width = $w_resize;
    $size = GetimageSize($filepart);
    $height = round($width * $size[1] / $size[0]);
    $images_orig = ImageCreateFromJPEG($filepart);
    $photoX = ImagesX($images_orig);
    $photoY = ImagesY($images_orig);
    $images_fin = ImageCreateTrueColor($width, $height);
    ImageCopyResampled($images_fin, $images_orig, 0, 0, 0, 0, $width + 1, $height + 1, $photoX, $photoY);
    ImageJPEG($images_fin, $path . $rename);
    ImageDestroy($images_orig);
    ImageDestroy($images_fin);
}
