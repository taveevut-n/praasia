<?php 
include("global.php");
include("core_function.php");
?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
if($_POST['Submit'] and ($_SESSION['ses_inum1']+$_SESSION['ses_inum2']==$_POST['inum3'])){

	$score = array(0);

	if($_POST['welcome'] <> ""){
		array_push($score,30);
	}
	if($_POST['warranty2'] == 1 ){
		array_push($score,30);
	}
	if($_POST['warranty2'] == 1 ){
		array_push($score ,30);
	}
	if($_POST['warranty3'] == 1 ){
		array_push($score ,30);
	}
	if($_POST['warranty4'] == 1 ){
		array_push($score ,30);
	}
	if($_POST['warranty5'] == 1 ){
		array_push($score ,30);
	}
	if($_POST['warranty6'] == 1 ){
		array_push($score ,30);
	}




	if (isset($_SESSION['member_id'])) {
		

		$filepart = $_FILES["file1"]["tmp_name"];
		$filename = $_FILES["file1"]["name"];
		if(trim($_FILES["file1"]["tmp_name"]) != ""){
			$fileextension = end(explode(".",$filename));
			$filename1 = time()."1.".$fileextension;
			copy($filepart,"member_file/".$filename1);
		}else{
			$filename1 = '';
		}


		$filepart = $_FILES["file2"]["tmp_name"];
		$filename = $_FILES["file2"]["name"];
		if(trim($_FILES["file2"]["tmp_name"]) != ""){
			$fileextension = end(explode(".",$filename));
			$filename2 = time()."2.".$fileextension;
			copy($filepart,"member_file/".$filename2);
		}else{
			$filename2 = '';
		}

		$rspacket = mysql_fetch_array(mysql_query("select * from member_package where package_code = '".$_POST['package']."'"));
		$package_id = $rspacket['package_id'];
		$package_duration = $rspacket["package_duration"];
		$package_amount = $rspacket["package_amount"];

		$rs = mysql_query("UPDATE member SET
			package_id = '".$package_id."', 
			pack_amountformem = '".$package_amount."',
			amphur 	= '', 
			active 	= '2', 
			backlist = '0', 
			score 	= '".array_sum($score)."', 
			province = '', 
			country = '".$_POST['country']."', 
			postcode = '".$_POST['postcode']."', 
			welcome = '".$_POST['welcome']."', 
			warranty2 = '".$_POST['warranty2']."', 
			warranty3 = '".$_POST['warranty3']."', 
			warranty4 = '".$_POST['warranty4']."', 
			warranty5 = '".$_POST['warranty5']."', 
			warranty6 = '".$_POST['warranty6']."', 
			warrantydetail1 = '".$_POST['warrantydetail1']."', 
			warrantydetail2 = '".$_POST['warrantydetail2']."', 
			warrantydetail3 = '".$_POST['warrantydetail3']."', 
			warrantydetail4 = '".$_POST['warrantydetail4']."', 
			shopname = '".$_POST['shopname']."', 
			shop_date = '".date("Y-m-d")."',  
			file1 = '".$_POST['file1']."',  
			file2 = '".$_POST['file2']."',  
			paypal = '".$_POST['paypal']."',  
			warranty = '".$_POST['warranty']."',  
			bankacc1 = '".$_POST['bankacc1']."',  
			bankname1 = '".$_POST['bankname1']."',  
			bankbranch1 = '".$_POST['bankbranch1']."',  
			bankid1 = '".$_POST['bankid1']."',  
			bankinfo = '".$_POST['bankinfo']."',  
			banktype1 = '".$_POST['banktype1']."',  
			lineid = '".$_POST['lineid']."',  
			wechat = '".$_POST['wechat']."' 
			WHERE id = '".$_SESSION['member_id']."'  
			");

		if($rs){
			$_SESSION['shopname']=$_POST['shopname'];
			echo "<script>alert('ลงทะเบียนร้านเรียบร้อยแล้ว / 登計成功')</script>";
		}else{
			echo "<script>alert('เกิดข้อผิดพลาดในการบันทึกข้อมูล กรุณาตรวจสอบใหม่ิีกครั้ง')</script>";
		}
		echo "<script language=\"javascript\">top.location='index.php'</script>";


	}else{

		$numrow_mail = mysql_num_rows(mysql_query("select * from member where email = '".$_POST['email']."'"));

		$numrow_username = mysql_num_rows(mysql_query("select * from member where username = '".$_POST['amuletuser']."' AND `type` = '0' "));

		if($numrow_mail > 0){

			echo "<script language=\"javascript\">alert('E-mail นี้นี้มีคนใช้แล้ว! / 这个 E-mail 已被用')</script>";	
			exit;

		}else{

			$filepart = $_FILES["file1"]["tmp_name"];
			$filename = $_FILES["file1"]["name"];
			if(trim($_FILES["file1"]["tmp_name"]) != ""){
				$fileextension = end(explode(".",$filename));
				$filename1 = time()."1.".$fileextension;
				copy($filepart,"member_file/".$filename1);
			}else{
				$filename1 = '';
			}


			$filepart = $_FILES["file2"]["tmp_name"];
			$filename = $_FILES["file2"]["name"];
			if(trim($_FILES["file2"]["tmp_name"]) != ""){
				$fileextension = end(explode(".",$filename));
				$filename2 = time()."2.".$fileextension;
				copy($filepart,"member_file/".$filename2);
			}else{
				$filename2 = '';
			}

			$rspacket = mysql_fetch_array(mysql_query("select * from member_package where package_code = '".$_POST['package']."'"));
			$package_id = $rspacket['package_id'];
			$package_duration = $rspacket["package_duration"];
			$package_amount = $rspacket["package_amount"];

			$data = array(
				'username' => $_POST['amuletuser'],
				'password' => md5(base64_encode(md5(md5($_POST['amuletpass'])))),
				'package_id' => $package_id,
				'pack_amountformem' => $package_amount,
				'email' => $_POST['email'],
				'name' => $_POST['name'],
				'tel' => $_POST['tel'],
				'mobile' => $_POST['mobile'],
				'address' => $_POST['address'],
				'amphur' => '',
				'active' => 2,
				'backlist' => 0,
				'score' => array_sum($score),
				'province' => '',
				'country' => $_POST['country'],
				'postcode' => $_POST['postcode'],
				'welcome' => $_POST['welcome'],
				'warranty2' => $_POST['warranty2'],
				'warranty3' => $_POST['warranty3'],
				'warranty4' => $_POST['warranty4'],
				'warranty5' => $_POST['warranty5'],
				'warranty6' => $_POST['warranty6'],
				'warrantydetail1' => $_POST['warranty-detail1'],
				'warrantydetail2' => $_POST['warranty-detail2'],
				'warrantydetail3' => $_POST['warranty-detail3'],
				'warrantydetail4' => $_POST['warranty-detail4'],
				'shopname' => $_POST['shopname'],
				'shop_date' => date("Y-m-d"),
				'file1' => $filename1,
				'file2' => $filename2,
				'paypal' => $_POST['paypal'],
				'warranty' => $_POST['warranty'],
				'bankacc1' => $_POST['bankacc1'],
				'bankname1' => $_POST['bankname1'],
				'bankbranch1' => $_POST['bankbranch1'],
				'bankid1' => $_POST['bankid1'],
				'bankinfo' => $_POST['bankinfo'],
				'banktype1' => $_POST['banktype1'],
				'lineid' => $_POST['lineid'],
				'wechat' => $_POST['wechat']
			);


			$rs = Insert("member",$data);
			if($rs){
				echo "<script>alert('ลงทะเบียนเรียบร้อยแล้ว / 登計成功')</script>";
			}else{
				echo "<script>alert('เกิดข้อผิดพลาดในการบันทึกข้อมูล กรุณาตรวจสอบใหม่ิีกครั้ง')</script>";
			}
			echo "<script language=\"javascript\">top.location='index.php'</script>";
		}
	}

}else{
	al('กรุณากรอกข้อมูลให้ถูกต้อง');
}
?>
</head>

<body>
</body>
</html>
