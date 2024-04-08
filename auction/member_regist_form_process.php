<?php
	include('../global.php');
	$do_what = $_POST['do_what'];
	if( $do_what == "insert_to_db"){
		if(($_POST['ses_inum1']+$_POST['ses_inum2']) == $_POST['postnum_answer']){
			$sql = "insert into auc_member( m_username , m_password , m_name , m_surname , m_sex , m_dfb , m_idcard , m_address , m_country, m_account , m_bank , m_bankoffset , m_bankno , m_banktype , m_tel , m_email , m_site , m_education , m_job, m_created, m_updated) values ( '".$_POST['username']."', '".$_POST['password']."', '".$_POST['firstname']."', '".$_POST['lastname']."', '".$_POST['sax']."', '".$_POST['birtday']."', '".$_POST['posenalid']."', '".$_POST['address']."', '".$_POST['m_country']."', '".$_POST['accountname']."', '".$_POST['bankname']."', '".$_POST['subbank']."', '".$_POST['noaccount']."', '".$_POST['account_type']."', '".$_POST['phone']."', '".$_POST['emial']."', '".$_POST['website']."', '".$_POST['education']."', '".$_POST['occupation']."', '".date("Y-m-d H:i:s")."', '".date("Y-m-d H:i:s")."' )";
			$q = mysql_query($sql) or die(mysql_error());
			if($q){
				echo "<script>alert('".$language['text_savedata_complete']."');</script>";
				echo "<script language=\"javascript\">top.location='index.php'</script>";
			}
		}
		else
		{
			echo "<script>alert('ท่านตอบคำถามไม่ถูกต้อง กรุณาลองใหม่อีกครั้ง');</script>";
			echo "<script language=\"javascript\">window.history.back();</script>";
		}
	}
?>