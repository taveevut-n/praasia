<?
header("Content-Type:text/json;charset=UTF-8");

$conn = mysql_connect("localhost","prathai_new","twe31219#");
	mysql_select_db("prathai_new",$conn);
	mysql_query("SET NAMES UTF8");
	mysql_query("SET character_set_results=utf8");
	mysql_query("SET character_set_client=utf8");
	mysql_query("SET character_set_connection=utf8");

$_a = array();
$_a['status'] = "fail";
$_a['message'] = "login fail";
$_a['member_id']="";
			    $_a['adminshop_id']="";
			    $_a['nameshop']="";



	
		$q = "SELECT * FROM member WHERE username='".trim($_REQUEST['u'])."' AND password='".trim( md5(base64_encode(md5(md5($_REQUEST['p'])))))."' AND active= '2' ";
$resource = mysql_query($q,$conn);

echo mysql_num_rows($resource)."xxx";

		if(mysql_num_rows($resource)>0){
            $_datas = mysql_fetch_assoc($resource);
            $_a['status'] = "success";
            $_a['message'] = "login success";       
            $_a['member_id']=$_datas['id'];
			$_a['adminshop_id']=$_datas['id'];
			$_a['nameshop']=$_datas['name'];
		}
echo json_encode($_a);
?>