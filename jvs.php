<?php
	$q="SELECT * FROM `bg_co` WHERE 1";
	$db->query($q);
	$db->next_record();
?>	
<?php
$yo_sty=$db->f(face_color);
$bg_web=$db->f(name_bgweb);

//$_SESSION['my_ced']=$yo_sty;
//unset($_SESSION['my_ced']);
if(!isset($_SESSION['my_ced']) || $_SESSION['my_ced']==""){ 
//	al('dd');
	@setcookie("mysheet",$yo_sty,-2);
//	unset($_COOKIE['mysheet']);
	$_COOKIE['mysheet']=$yo_sty;
	$_SESSION['my_ced']=$yo_sty;
}
?>
<?php
if(!isset($_COOKIE['mysheet']) || $_COOKIE['mysheet']==""){
	$_COOKIE['mysheet']=$yo_sty;
}
if($_COOKIE['mysheet']!=$yo_sty){
	$_SESSION['my_ced']=$yo_sty;
}
?>


<script language="javascript" src="js/styleswitch.js"></script>
<?php
	$q="SELECT * FROM `theme` WHERE theme_active=1";
	$db->query($q);
	if($db->num_rows()>0){ 
?>
	<?php include("theme.php"); ?>
	<?php }else{ ?>
	<link href="css/<?=$yo_sty?>.css" rel="stylesheet" type="text/css" />
	<?php } ?>
	
<?php 
	//���͡ Block �ç bottom
	$q="SELECT * FROM `bottom`  WHERE status=1";
	$db87pui=new nDB();
	$db87pui->query($q);
	$num_block=$db87pui->num_rows();
	$db87pui->next_record();
	if($num_block>0){
	$_SESSION['ses_bottom']=$db87pui->f(name);
	}else{
	unset($_SESSION['ses_bottom']);
	}
?>
<? //��ҹ����Դ/�Դ webboard 
						$q="SELECT * FROM `webboard_status`";
						$db->query($q);
						$db->next_record();
						$_SESSION['open_board']=$db->f(name_status);
				
				?>
				<? //��ҹ����ʴ� �����
					$q="SELECT * FROM `webboard_display`";
						$db->query($q);
						$db->next_record();
						$_SESSION['open_email']=$db->f(name_display);
				
				?>

<? 
 $q="SELECT * FROM `webboard_page`";
$db->query($q);
$db->next_record();
$page555=$db->f(num_page);
?>				
<?php
	$q="SELECT * FROM `setting` WHERE 1";
	$db->query($q);
	$db->next_record();
	$site=substr($db->f(web_name),7);
?>
<?php
$q="SELECT * FROM `lang` WHERE 1";
$db->query($q);
while($db->next_record()){
define($db->f(st_lang),$db->f(df_lang));
}
$to_address=_Contact_Mail;	
?>
<?php
	//���͡ Block �ç���
	$q="SELECT * FROM `block`  WHERE status=1";
	$db87pui=new nDB();
	$db87pui->query($q);
	$num_block=$db87pui->num_rows();
	$db87pui->next_record();
	if($num_block>0){
	$_SESSION['ses_block']=$db87pui->f(name);
	}else{
	unset($_SESSION['ses_block']);
	}
?>	

<?php
	$show_raka=1;
?>
<?php
	$q="SELECT * FROM `bg_img` WHERE status_img=1";
	$db->query($q);
	if($db->num_rows()>0){
		$db->next_record();
		$bgg_img=$db->f(name_img);
		$repeat_img=$db->f(repeat_img);
		$fix_img=$db->f(fix_img);
		$iSetBG="style=\"background:url(img/logo/".$bgg_img.");
		background-color: $bg_web;
	background-repeat: no-repeat;
	background-attachment: .$fix_img;
	background-position: top center; \"";
	}
?>	
<?php
	$q="SELECT * FROM `block`  WHERE status=1";
	$db8=new nDB();
	$db8->query($q);
	$db8->next_record();	
?>
<?php
	$q="SELECT * FROM `bottom`  WHERE status=1";
	$db8899=new nDB();
	$db8899->query($q);
	$db8899->next_record();	
?>
<? include('right_panel.php'); ?>
