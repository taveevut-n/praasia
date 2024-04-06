<?php include("global.php"); ?>
<?php set_page($s_page,$e_page=15); //นำส่วนนี้ิไว้ด้านบน ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"><html xmlns="http://www.w3.org/1999/xhtml"
      xmlns:og="http://opengraphprotocol.org/schema/"
      xmlns:fb="http://www.facebook.com/2008/fbml"><!-- InstanceBegin template="/Templates/detail_temp.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<?php
	$q="SELECT * FROM `setting`";
	$db->query($q);
	$db->next_record();
		$meta_des=$db->f(web_descript);
		$meta_keyword=$db->f(web_keyword);
		$meta_title=$db->f(web_title);
		$webname=$_SERVER['SERVER_NAME'];
		$pagename=$_SERVER['PHP_SELF'];
?> 
<title><?=l?> ::: <?=$meta_title?> ::: [Engine by ThaiWebEasy.com]</title>
<META http-equiv=Content-Type content="text/html; charset=utf-8">
<meta property="og:title" content="<?=ํ?><?=$meta_title?>"/>
<meta property="og:image" content="http://<?=$webname?>/img/product/<?=$meta_pic?>"/>
<meta property="og:url" content="http://<?=$webname?><?=$pagename?>?id_product=<?=$id_product?>"/>
<meta property="og:site_name" content="<?=ํ?><?=$meta_title?>"/>
<meta property="og:description" content="<?=$meta_des?>"/>
<META content=All name=ROBOTS>
<META content="<?=$meta_des?>" name=description>
<META content="<?=$meta_keyword?>" name=keywords />
<?php
include("jvs.php");
?>
<?php
include("css.php");
?>
<!-- InstanceBeginEditable name="head" -->
<title></title>
<!-- InstanceEndEditable -->
<?php
	$q="SELECT * FROM `bg_co` WHERE 1";
	$db->query($q);
	if($db->num_rows()>0){
		$db->next_record();
		$bgg_color=$db->f(name_co);
		$_SESSION['block_color']=$db->f(name_co2);
	}
?>	
<script language="javascript" src="js/valid.js"></script>
<script type="text/javascript" src="js/FlashObject.js"></script>
<script src="Scripts/swfobject_modified.js" type="text/javascript"></script>
</head>
<body <?=$iSetBG?>>
<div id="wrapper">
<table width="1000" border="0" align="center"  cellpadding="0" cellspacing="0">
  <tr>
    <td valign="top">

<table width="1000" height="100%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tbody>
<?php
function g_menu($db,$s_id){
	$q="SELECT * FROM `menu` WHERE id_menu=".$s_id." ";
	$db->query($q);
	$db->next_record();
	$db->p(name_menu);
}
?>
    <tr>
      <td height="100%"><table width="1000" border="0" cellspacing="0" cellpadding="0">
		
        <tr>
          <td align="left" valign="top">
<table width="100%" cellpadding="0" cellspacing="0">
                
                <?php
$db333301=new nDB();
$q="SELECT * FROM `bg_co` WHERE 1";
$db333301->query($q);
$db333301->next_record();
$sh_mooo=$db333301->f(sho_topm);
$sh_areao=$db333301->f(sho_aream); ?>

<?php if($sh_areao==0){ ?>
                <tr>
				<td><table width="100%" border="0" cellspacing="0" cellpadding="0">
				  <?php if($sh_mooo==4){ ?>
                  <tr>
				    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>

<?php 
$q="SELECT * FROM `menu` WHERE 1 ORDER BY menu_order LIMIT 0,7";
$db->query($q);
$vj=1;
while($db->next_record()){
?>		  		
		<?
		
		if($db->f(menu_url)==''){
			$url="menu_detail.php?menu_id=".$db->f(id_menu);
			$tar=$db->f(target_menu);
			if($tar=='2'){
				$target="_blank";
			}else{
				$target="_parent";
			}
		}else{
			$url=$db->f(menu_url);
		}
		?>	  
<?php if($vj%7==1){ ?>				
              <td width="145" height="26" align="center" valign="middle"  ><a href="<?=$url?>" target="<?=$target?>"><img src="<?=($db->f(pic1)!="")?"img/menu/".$db->f(pic1):"img/menu/defualt.jpg"?>"  onmouseover="this.src='<?=($db->f(pic2)!="")?"img/menu/".$db->f(pic2):"img/menu/defualt.jpg"?>'" onmouseout="this.src='<?=($db->f(pic1)!="")?"img/menu/".$db->f(pic1):"img/menu/defualt.jpg"?>'"  border="0" alt="<?=$db->f(name_menu)?>" /></a></td>
<?php } ?>			  			  
<?php if($vj%7==2){ ?>				  
              <td width="145" height="26" align="center" valign="middle"  ><a href="<?=$url?>" target="<?=$target?>"><img src="<?=($db->f(pic1)!="")?"img/menu/".$db->f(pic1):"img/menu/defualt.jpg"?>"  onmouseover="this.src='<?=($db->f(pic2)!="")?"img/menu/".$db->f(pic2):"img/menu/defualt.jpg"?>'" onmouseout="this.src='<?=($db->f(pic1)!="")?"img/menu/".$db->f(pic1):"img/menu/defualt.jpg"?>'"  border="0" alt="<?=$db->f(name_menu)?>" /></a></td>
<?php } ?>			  			  
<?php if($vj%7==3){ ?>						  
              <td width="145" height="26" align="center" valign="middle"  ><a href="<?=$url?>" target="<?=$target?>"><img src="<?=($db->f(pic1)!="")?"img/menu/".$db->f(pic1):"img/menu/defualt.jpg"?>"  onmouseover="this.src='<?=($db->f(pic2)!="")?"img/menu/".$db->f(pic2):"img/menu/defualt.jpg"?>'" onmouseout="this.src='<?=($db->f(pic1)!="")?"img/menu/".$db->f(pic1):"img/menu/defualt.jpg"?>'"  border="0" alt="<?=$db->f(name_menu)?>" /></a></td>
<?php } ?>			  			  
<?php if($vj%7==4){ ?>						  
              <td width="145" height="26" align="center" valign="middle"  ><a href="<?=$url?>" target="<?=$target?>"><img src="<?=($db->f(pic1)!="")?"img/menu/".$db->f(pic1):"img/menu/defualt.jpg"?>"  onmouseover="this.src='<?=($db->f(pic2)!="")?"img/menu/".$db->f(pic2):"img/menu/defualt.jpg"?>'" onmouseout="this.src='<?=($db->f(pic1)!="")?"img/menu/".$db->f(pic1):"img/menu/defualt.jpg"?>'"  border="0" alt="<?=$db->f(name_menu)?>" /></a></td>
<?php } ?>			  			  
<?php if($vj%7==5){ ?>			  
              <td width="145" height="26" align="center" valign="middle"  ><a href="<?=$url?>" target="<?=$target?>"><img src="<?=($db->f(pic1)!="")?"img/menu/".$db->f(pic1):"img/menu/defualt.jpg"?>"  onmouseover="this.src='<?=($db->f(pic2)!="")?"img/menu/".$db->f(pic2):"img/menu/defualt.jpg"?>'" onmouseout="this.src='<?=($db->f(pic1)!="")?"img/menu/".$db->f(pic1):"img/menu/defualt.jpg"?>'"  border="0" alt="<?=$db->f(name_menu)?>" /></a></td>
<?php } ?>			  
<?php if($vj%7==6){ ?>			  
              <td width="145" height="26" align="center" valign="middle"  ><a href="<?=$url?>" target="<?=$target?>"><img src="<?=($db->f(pic1)!="")?"img/menu/".$db->f(pic1):"img/menu/defualt.jpg"?>"  onmouseover="this.src='<?=($db->f(pic2)!="")?"img/menu/".$db->f(pic2):"img/menu/defualt.jpg"?>'" onmouseout="this.src='<?=($db->f(pic1)!="")?"img/menu/".$db->f(pic1):"img/menu/defualt.jpg"?>'"  border="0" alt="<?=$db->f(name_menu)?>" /></a></td>
<?php } ?>	
<?php if($vj%7==0){ ?>			  
              <td width="145" height="26" align="center" valign="middle"  ><a href="<?=$url?>" target="<?=$target?>"><img src="<?=($db->f(pic1)!="")?"img/menu/".$db->f(pic1):"img/menu/defualt.jpg"?>"  onmouseover="this.src='<?=($db->f(pic2)!="")?"img/menu/".$db->f(pic2):"img/menu/defualt.jpg"?>'" onmouseout="this.src='<?=($db->f(pic1)!="")?"img/menu/".$db->f(pic1):"img/menu/defualt.jpg"?>'"  border="0" alt="<?=$db->f(name_menu)?>" /></a></td>
<?php } ?>					  
<?php $vj++; } ?>					  			
</tr>
<tr>

<?php 
$q="SELECT * FROM `menu` WHERE 1 ORDER BY menu_order LIMIT 7,7";
$db->query($q);
$vj=1;
while($db->next_record()){
?>		  		
		<?
		
		if($db->f(menu_url)==''){
			$url="menu_detail.php?menu_id=".$db->f(id_menu);
			$tar=$db->f(target_menu);
			if($tar=='2'){
				$target="_blank";
			}else{
				$target="_parent";
			}
		}else{
			$url=$db->f(menu_url);
		}
		?>	  
<?php if($vj%7==1){ ?>				
              <td width="145" height="26" align="center" valign="middle"  ><a href="<?=$url?>" target="<?=$target?>"><img src="<?=($db->f(pic1)!="")?"img/menu/".$db->f(pic1):"img/menu/defualt.jpg"?>"  onmouseover="this.src='<?=($db->f(pic2)!="")?"img/menu/".$db->f(pic2):"img/menu/defualt.jpg"?>'" onmouseout="this.src='<?=($db->f(pic1)!="")?"img/menu/".$db->f(pic1):"img/menu/defualt.jpg"?>'"  border="0" alt="<?=$db->f(name_menu)?>" /></a></td>
<?php } ?>			  			  
<?php if($vj%7==2){ ?>				  
              <td width="145" height="26" align="center" valign="middle"  ><a href="<?=$url?>" target="<?=$target?>"><img src="<?=($db->f(pic1)!="")?"img/menu/".$db->f(pic1):"img/menu/defualt.jpg"?>"  onmouseover="this.src='<?=($db->f(pic2)!="")?"img/menu/".$db->f(pic2):"img/menu/defualt.jpg"?>'" onmouseout="this.src='<?=($db->f(pic1)!="")?"img/menu/".$db->f(pic1):"img/menu/defualt.jpg"?>'"  border="0" alt="<?=$db->f(name_menu)?>" /></a></td>
<?php } ?>			  			  
<?php if($vj%7==3){ ?>						  
              <td width="145" height="26" align="center" valign="middle"  ><a href="<?=$url?>" target="<?=$target?>"><img src="<?=($db->f(pic1)!="")?"img/menu/".$db->f(pic1):"img/menu/defualt.jpg"?>"  onmouseover="this.src='<?=($db->f(pic2)!="")?"img/menu/".$db->f(pic2):"img/menu/defualt.jpg"?>'" onmouseout="this.src='<?=($db->f(pic1)!="")?"img/menu/".$db->f(pic1):"img/menu/defualt.jpg"?>'"  border="0" alt="<?=$db->f(name_menu)?>" /></a></td>
<?php } ?>			  			  
<?php if($vj%7==4){ ?>						  
              <td width="145" height="26" align="center" valign="middle"  ><a href="<?=$url?>" target="<?=$target?>"><img src="<?=($db->f(pic1)!="")?"img/menu/".$db->f(pic1):"img/menu/defualt.jpg"?>"  onmouseover="this.src='<?=($db->f(pic2)!="")?"img/menu/".$db->f(pic2):"img/menu/defualt.jpg"?>'" onmouseout="this.src='<?=($db->f(pic1)!="")?"img/menu/".$db->f(pic1):"img/menu/defualt.jpg"?>'"  border="0" alt="<?=$db->f(name_menu)?>" /></a></td>
<?php } ?>			  			  
<?php if($vj%7==5){ ?>			  
              <td width="145" height="26" align="center" valign="middle"  ><a href="<?=$url?>" target="<?=$target?>"><img src="<?=($db->f(pic1)!="")?"img/menu/".$db->f(pic1):"img/menu/defualt.jpg"?>"  onmouseover="this.src='<?=($db->f(pic2)!="")?"img/menu/".$db->f(pic2):"img/menu/defualt.jpg"?>'" onmouseout="this.src='<?=($db->f(pic1)!="")?"img/menu/".$db->f(pic1):"img/menu/defualt.jpg"?>'"  border="0" alt="<?=$db->f(name_menu)?>" /></a></td>
<?php } ?>			  
<?php if($vj%7==6){ ?>			  
              <td width="145" height="26" align="center" valign="middle"  ><a href="<?=$url?>" target="<?=$target?>"><img src="<?=($db->f(pic1)!="")?"img/menu/".$db->f(pic1):"img/menu/defualt.jpg"?>"  onmouseover="this.src='<?=($db->f(pic2)!="")?"img/menu/".$db->f(pic2):"img/menu/defualt.jpg"?>'" onmouseout="this.src='<?=($db->f(pic1)!="")?"img/menu/".$db->f(pic1):"img/menu/defualt.jpg"?>'"  border="0" alt="<?=$db->f(name_menu)?>" /></a></td>
<?php } ?>	
<?php if($vj%7==0){ ?>			  
              <td width="145" height="26" align="center" valign="middle"  ><a href="<?=$url?>" target="<?=$target?>"><img src="<?=($db->f(pic1)!="")?"img/menu/".$db->f(pic1):"img/menu/defualt.jpg"?>"  onmouseover="this.src='<?=($db->f(pic2)!="")?"img/menu/".$db->f(pic2):"img/menu/defualt.jpg"?>'" onmouseout="this.src='<?=($db->f(pic1)!="")?"img/menu/".$db->f(pic1):"img/menu/defualt.jpg"?>'"  border="0" alt="<?=$db->f(name_menu)?>" /></a></td>
<?php } ?>					  
<?php $vj++; } ?>					  			
</tr>
				      </table></td>
				    </tr>
                   <?php } ?> 
				  <?php  if($sh_mooo==1 || $sh_mooo==3 ){ ?>
                  <tr>
				    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
				      <tr>
				       <?php 
$q="SELECT * FROM `menu` WHERE 1 ORDER BY menu_order LIMIT 0,7";
$db->query($q);
$vj=1;
while($db->next_record()){
?>		  			 
		<?
		
		if($db->f(menu_url)==''){
			$url="menu_detail.php?menu_id=".$db->f(id_menu);
			$tar=$db->f(target_menu);
			if($tar=='2'){
				$target="_blank";
			}else{
				$target="_parent";
			}
		}else{
			$url=$db->f(menu_url);
		}
		?> 
<?php if($vj%7==1){ ?>				
              <td width="145" height="36" align="center" id="<?=(basename($_SERVER['PHP_SELF'])==$db->f(url_menu))?"top_menu3":"top_menu4"?>" style="padding-right:5px"><a href="<?=$url?>" target="<?=$target?>"><?=$db->f(name_menu)?></a></td>
<?php } ?>			  			  
<?php if($vj%7==2){ ?>				  
              <td width="145" height="26" align="center" id="<?=(basename($_SERVER['PHP_SELF'])==$db->f(url_menu))?"top_menu3":"top_menu4"?>"style="padding-right:5px"><a href="<?=$url?>" target="<?=$target?>"> <?=$db->f(name_menu)?></a></td>
<?php } ?>			  			  
<?php if($vj%7==3){ ?>						  
              <td width="145" height="26" align="center" id="<?=(basename($_SERVER['PHP_SELF'])==$db->f(url_menu))?"top_menu3":"top_menu4"?>"style="padding-right:5px"><a href="<?=$url?>" target="<?=$target?>"><?=$db->f(name_menu)?></a></td>
<?php } ?>			  			  
<?php if($vj%7==4){ ?>						  
              <td width="145" height="26" align="center" id="<?=(basename($_SERVER['PHP_SELF'])==$db->f(url_menu))?"top_menu3":"top_menu4"?>"style="padding-right:5px"><a href="<?=$url?>" target="<?=$target?>"><?=$db->f(name_menu)?></a></td>
<?php } ?>			  			  
<?php if($vj%7==5){ ?>			  
              <td width="145" height="26" align="center" id="<?=(basename($_SERVER['PHP_SELF'])==$db->f(url_menu))?"top_menu3":"top_menu4"?>"style="padding-right:5px"><a href="<?=$url?>" target="<?=$target?>"><?=$db->f(name_menu)?></a></td>
<?php } ?>			  
<?php if($vj%7==6){ ?>			  
              <td width="145" height="26" align="center" id="<?=(basename($_SERVER['PHP_SELF'])==$db->f(url_menu))?"top_menu3":"top_menu4"?>"style="padding-right:5px"><a href="<?=$url?>" target="<?=$target?>"><?=$db->f(name_menu)?></a></td>
<?php } ?>	
<?php if($vj%7==0){ ?>			  
              <td width="145" height="26" align="center" id="<?=(basename($_SERVER['PHP_SELF'])==$db->f(url_menu))?"top_menu3":"top_menu4"?>"style="padding-right:5px"><a href="<?=$url?>" target="<?=$target?>"><?=$db->f(name_menu)?></a></td>
<?php } ?>					  
<?php $vj++; } ?>					 
				        </tr>
				      </table></td>
				    </tr>
                   <?php } ?> 
				  <?php  if($sh_mooo==2 || $sh_mooo==3 ){ ?>	
                  <tr>
				    <td id="top_menu2" height="33"><table width="100%" border="0" cellspacing="0" cellpadding="0">
				      <tr>
<?php 
$q="SELECT * FROM `menu` WHERE 1 ";
$db9999=new nDB();
$db9999->query($q);
$tototo=$db9999->num_rows();
?>
				        <?php 
$q="SELECT * FROM `menu` WHERE 1 ORDER BY menu_order LIMIT 7,7";
$db->query($q);
$vj=1;
while($db->next_record()){
?>		  			 
		<?
		
		if($db->f(menu_url)==''){
			$url="menu_detail.php?menu_id=".$db->f(id_menu);
			$tar=$db->f(target_menu);
			if($tar=='2'){
				$target="_blank";
			}else{
				$target="_parent";
			}
		}else{
			$url=$db->f(menu_url);
		}
		?> 
<?php if($vj2%7==1){ ?>						
                  <td  width="150" height="36" align="center" style="padding-top:8px;">
				  <a href="<?=$url?>" target="<?=$target?>"><?=$db->f(name_menu)?></a>				   </td>
				  <?php if($tototo<7){ ?>		
				  <?php } ?>  
<?php } ?>			  			  
<?php if($vj2%7==2){ ?>						  
                  <td width="150" align="center" style="padding-top:8px;"><a href="<?=$url?>" target="<?=$target?>"><?=$db->f(name_menu)?></a></td>
				  <?php if($tototo<8){ ?>		
				  <?php } ?>  				  
<?php } ?>			  			  
<?php if($vj2%7==3){ ?>						  
                  <td width="150" align="center" style="padding-top:8px;"><a href="<?=$url?>" target="<?=$target?>"><?=$db->f(name_menu)?></a></td>
				  <?php if($tototo<9){ ?>		
				  <?php } ?>  						  
<?php } ?>			  			  
<?php if($vj2%7==4){ ?>						  
                  <td width="150" align="center" style="padding-top:8px;"><a href="<?=$url?>" target="<?=$target?>"><?=$db->f(name_menu)?></a></td>
				  <?php if($tototo<10){ ?>		
				  <?php } ?>  						  
<?php } ?>			  			  
<?php if($vj2%7==5){ ?>						  
                  <td width="150" align="center" style="padding-top:8px;"><a href="<?=$url?>" target="<?=$target?>"><?=$db->f(name_menu)?></a></td>
				  <?php if($tototo<11){ ?>		
				  <?php } ?>  		
<?php } ?>			  			  
<?php if($vj2%7==6){ ?>							  
                  <td width="150" align="center" style="padding-top:8px;"><a href="<?=$url?>" target="<?=$target?>"> <?=$db->f(name_menu)?></a></td>
<?php } ?>	
<?php if($vj2%7==0){ ?>							  
                  <td width="150" align="center" style="padding-top:8px;"><a href="<?=$url?>" target="<?=$target?>"> <?=$db->f(name_menu)?></a></td>
<?php } ?>			  
<?php $vj2++; } ?>				  		 
				        </tr>
				      </table></td>
				    </tr>
                   <?php } ?>                    
					
				  </table></td>
				</tr>
<?php } ?>                
<tr>
<td>
<table width="1000" border="0" cellpadding="0" cellspacing="0">
<?php 
$q="SELECT * FROM `setting` WHERE 1 ";
$db88=new nDB();
$db88->query($q);
$db88->next_record();
?>
<?php
	$q="SELECT * FROM `logo` WHERE status_logo=1 ORDER BY RAND()";
	$db->query($q);
	$db->next_record();
?>
       <tr>
              
							<?php $chk=substr($db->f(name_logo),-3); ?>							
							<?php if($chk=="jpg" || $chk=="gif" or $chk=="png"){ ?>
			  <td colspan="7" align="left" valign="top" height="<?=$db88->f(height_logo)?>" style="background:url(<?=$db->f(name_logo)?>)"></td>
			  				<?php } ?>
							<?php if($chk=="swf"){ 
							$path=$db->f(name_logo);
							?><td colspan="8" align="left" valign="top">
  <object id="FlashID" classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" width="1000" height="<?=$db88->f(height_logo)?>">
    <param name="movie" value="<?=$path?>" />
    <param name="quality" value="high" />
    <param name="wmode" value="opaque" />
    <param name="swfversion" value="8.0.35.0" />
    <!-- This param tag prompts users with Flash Player 6.0 r65 and higher to download the latest version of Flash Player. Delete it if you don’t want users to see the prompt. -->
    <param name="expressinstall" value="Scripts/expressInstall.swf" />
    <!-- Next object tag is for non-IE browsers. So hide it from IE using IECC. -->
    <!--[if !IE]>-->
    <object type="application/x-shockwave-flash" data="<?=$path?>" width="1000" height="<?=$db88->f(height_logo)?>">
      <!--<![endif]-->
      <param name="quality" value="high" />
      <param name="wmode" value="opaque" />
      <param name="swfversion" value="8.0.35.0" />
      <param name="expressinstall" value="Scripts/expressInstall.swf" />
      <!-- The browser displays the following alternative content for users with Flash Player 6.0 and older. -->
      <div>
        <h4>Content on this page requires a newer version of Adobe Flash Player.</h4>
        <p><a href="http://www.adobe.com/go/getflashplayer"><img src="http://www.adobe.com/images/shared/download_buttons/get_flash_player.gif" alt="Get Adobe Flash player" width="112" height="33" /></a></p>
      </div>
      <!--[if !IE]>-->
    </object>
    <!--<![endif]-->
  </object> </td>																
			  				<?php } ?>				  
              </tr>	
          </table>	</td></tr>                        
<?php if($sh_areao==1){ ?>
<tr>
				<td><table width="100%" border="0" cellspacing="0" cellpadding="0">
				  <?php if($sh_mooo==4){ ?>
                  <tr>
				    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>

<?php 
$q="SELECT * FROM `menu` WHERE 1 ORDER BY menu_order LIMIT 0,7";
$db->query($q);
$vj=1;
while($db->next_record()){
?>		  		
		<?
		
		if($db->f(menu_url)==''){
			$url="menu_detail.php?menu_id=".$db->f(id_menu);
			$tar=$db->f(target_menu);
			if($tar=='2'){
				$target="_blank";
			}else{
				$target="_parent";
			}
		}else{
			$url=$db->f(menu_url);
		}
		?>	  
<?php if($vj%7==1){ ?>				
              <td width="145" height="26" align="center" valign="middle"  ><a href="<?=$url?>" target="<?=$target?>"><img src="<?=($db->f(pic1)!="")?"img/menu/".$db->f(pic1):"img/menu/defualt.jpg"?>"  onmouseover="this.src='<?=($db->f(pic2)!="")?"img/menu/".$db->f(pic2):"img/menu/defualt.jpg"?>'" onmouseout="this.src='<?=($db->f(pic1)!="")?"img/menu/".$db->f(pic1):"img/menu/defualt.jpg"?>'"  border="0" alt="<?=$db->f(name_menu)?>" /></a></td>
<?php } ?>			  			  
<?php if($vj%7==2){ ?>				  
              <td width="145" height="26" align="center" valign="middle"  ><a href="<?=$url?>" target="<?=$target?>"><img src="<?=($db->f(pic1)!="")?"img/menu/".$db->f(pic1):"img/menu/defualt.jpg"?>"  onmouseover="this.src='<?=($db->f(pic2)!="")?"img/menu/".$db->f(pic2):"img/menu/defualt.jpg"?>'" onmouseout="this.src='<?=($db->f(pic1)!="")?"img/menu/".$db->f(pic1):"img/menu/defualt.jpg"?>'"  border="0" alt="<?=$db->f(name_menu)?>" /></a></td>
<?php } ?>			  			  
<?php if($vj%7==3){ ?>						  
              <td width="145" height="26" align="center" valign="middle"  ><a href="<?=$url?>" target="<?=$target?>"><img src="<?=($db->f(pic1)!="")?"img/menu/".$db->f(pic1):"img/menu/defualt.jpg"?>"  onmouseover="this.src='<?=($db->f(pic2)!="")?"img/menu/".$db->f(pic2):"img/menu/defualt.jpg"?>'" onmouseout="this.src='<?=($db->f(pic1)!="")?"img/menu/".$db->f(pic1):"img/menu/defualt.jpg"?>'"  border="0" alt="<?=$db->f(name_menu)?>" /></a></td>
<?php } ?>			  			  
<?php if($vj%7==4){ ?>						  
              <td width="145" height="26" align="center" valign="middle"  ><a href="<?=$url?>" target="<?=$target?>"><img src="<?=($db->f(pic1)!="")?"img/menu/".$db->f(pic1):"img/menu/defualt.jpg"?>"  onmouseover="this.src='<?=($db->f(pic2)!="")?"img/menu/".$db->f(pic2):"img/menu/defualt.jpg"?>'" onmouseout="this.src='<?=($db->f(pic1)!="")?"img/menu/".$db->f(pic1):"img/menu/defualt.jpg"?>'"  border="0" alt="<?=$db->f(name_menu)?>" /></a></td>
<?php } ?>			  			  
<?php if($vj%7==5){ ?>			  
              <td width="145" height="26" align="center" valign="middle"  ><a href="<?=$url?>" target="<?=$target?>"><img src="<?=($db->f(pic1)!="")?"img/menu/".$db->f(pic1):"img/menu/defualt.jpg"?>"  onmouseover="this.src='<?=($db->f(pic2)!="")?"img/menu/".$db->f(pic2):"img/menu/defualt.jpg"?>'" onmouseout="this.src='<?=($db->f(pic1)!="")?"img/menu/".$db->f(pic1):"img/menu/defualt.jpg"?>'"  border="0" alt="<?=$db->f(name_menu)?>" /></a></td>
<?php } ?>			  
<?php if($vj%7==6){ ?>			  
              <td width="145" height="26" align="center" valign="middle"  ><a href="<?=$url?>" target="<?=$target?>"><img src="<?=($db->f(pic1)!="")?"img/menu/".$db->f(pic1):"img/menu/defualt.jpg"?>"  onmouseover="this.src='<?=($db->f(pic2)!="")?"img/menu/".$db->f(pic2):"img/menu/defualt.jpg"?>'" onmouseout="this.src='<?=($db->f(pic1)!="")?"img/menu/".$db->f(pic1):"img/menu/defualt.jpg"?>'"  border="0" alt="<?=$db->f(name_menu)?>" /></a></td>
<?php } ?>	
<?php if($vj%7==0){ ?>			  
              <td width="145" height="26" align="center" valign="middle"  ><a href="<?=$url?>" target="<?=$target?>"><img src="<?=($db->f(pic1)!="")?"img/menu/".$db->f(pic1):"img/menu/defualt.jpg"?>"  onmouseover="this.src='<?=($db->f(pic2)!="")?"img/menu/".$db->f(pic2):"img/menu/defualt.jpg"?>'" onmouseout="this.src='<?=($db->f(pic1)!="")?"img/menu/".$db->f(pic1):"img/menu/defualt.jpg"?>'"  border="0" alt="<?=$db->f(name_menu)?>" /></a></td>
<?php } ?>					  
<?php $vj++; } ?>					  			
</tr>
<tr>

<?php 
$q="SELECT * FROM `menu` WHERE 1 ORDER BY menu_order LIMIT 7,7";
$db->query($q);
$vj=1;
while($db->next_record()){
?>		  		
		<?
		
		if($db->f(menu_url)==''){
			$url="menu_detail.php?menu_id=".$db->f(id_menu);
			$tar=$db->f(target_menu);
			if($tar=='2'){
				$target="_blank";
			}else{
				$target="_parent";
			}
		}else{
			$url=$db->f(menu_url);
		}
		?>	  
<?php if($vj%7==1){ ?>				
              <td width="145" height="26" align="center" valign="middle"  ><a href="<?=$url?>" target="<?=$target?>"><img src="<?=($db->f(pic1)!="")?"img/menu/".$db->f(pic1):"img/menu/defualt.jpg"?>"  onmouseover="this.src='<?=($db->f(pic2)!="")?"img/menu/".$db->f(pic2):"img/menu/defualt.jpg"?>'" onmouseout="this.src='<?=($db->f(pic1)!="")?"img/menu/".$db->f(pic1):"img/menu/defualt.jpg"?>'"  border="0" alt="<?=$db->f(name_menu)?>" /></a></td>
<?php } ?>			  			  
<?php if($vj%7==2){ ?>				  
              <td width="145" height="26" align="center" valign="middle"  ><a href="<?=$url?>" target="<?=$target?>"><img src="<?=($db->f(pic1)!="")?"img/menu/".$db->f(pic1):"img/menu/defualt.jpg"?>"  onmouseover="this.src='<?=($db->f(pic2)!="")?"img/menu/".$db->f(pic2):"img/menu/defualt.jpg"?>'" onmouseout="this.src='<?=($db->f(pic1)!="")?"img/menu/".$db->f(pic1):"img/menu/defualt.jpg"?>'"  border="0" alt="<?=$db->f(name_menu)?>" /></a></td>
<?php } ?>			  			  
<?php if($vj%7==3){ ?>						  
              <td width="145" height="26" align="center" valign="middle"  ><a href="<?=$url?>" target="<?=$target?>"><img src="<?=($db->f(pic1)!="")?"img/menu/".$db->f(pic1):"img/menu/defualt.jpg"?>"  onmouseover="this.src='<?=($db->f(pic2)!="")?"img/menu/".$db->f(pic2):"img/menu/defualt.jpg"?>'" onmouseout="this.src='<?=($db->f(pic1)!="")?"img/menu/".$db->f(pic1):"img/menu/defualt.jpg"?>'"  border="0" alt="<?=$db->f(name_menu)?>" /></a></td>
<?php } ?>			  			  
<?php if($vj%7==4){ ?>						  
              <td width="145" height="26" align="center" valign="middle"  ><a href="<?=$url?>" target="<?=$target?>"><img src="<?=($db->f(pic1)!="")?"img/menu/".$db->f(pic1):"img/menu/defualt.jpg"?>"  onmouseover="this.src='<?=($db->f(pic2)!="")?"img/menu/".$db->f(pic2):"img/menu/defualt.jpg"?>'" onmouseout="this.src='<?=($db->f(pic1)!="")?"img/menu/".$db->f(pic1):"img/menu/defualt.jpg"?>'"  border="0" alt="<?=$db->f(name_menu)?>" /></a></td>
<?php } ?>			  			  
<?php if($vj%7==5){ ?>			  
              <td width="145" height="26" align="center" valign="middle"  ><a href="<?=$url?>" target="<?=$target?>"><img src="<?=($db->f(pic1)!="")?"img/menu/".$db->f(pic1):"img/menu/defualt.jpg"?>"  onmouseover="this.src='<?=($db->f(pic2)!="")?"img/menu/".$db->f(pic2):"img/menu/defualt.jpg"?>'" onmouseout="this.src='<?=($db->f(pic1)!="")?"img/menu/".$db->f(pic1):"img/menu/defualt.jpg"?>'"  border="0" alt="<?=$db->f(name_menu)?>" /></a></td>
<?php } ?>			  
<?php if($vj%7==6){ ?>			  
              <td width="145" height="26" align="center" valign="middle"  ><a href="<?=$url?>" target="<?=$target?>"><img src="<?=($db->f(pic1)!="")?"img/menu/".$db->f(pic1):"img/menu/defualt.jpg"?>"  onmouseover="this.src='<?=($db->f(pic2)!="")?"img/menu/".$db->f(pic2):"img/menu/defualt.jpg"?>'" onmouseout="this.src='<?=($db->f(pic1)!="")?"img/menu/".$db->f(pic1):"img/menu/defualt.jpg"?>'"  border="0" alt="<?=$db->f(name_menu)?>" /></a></td>
<?php } ?>	
<?php if($vj%7==0){ ?>			  
              <td width="145" height="26" align="center" valign="middle"  ><a href="<?=$url?>" target="<?=$target?>"><img src="<?=($db->f(pic1)!="")?"img/menu/".$db->f(pic1):"img/menu/defualt.jpg"?>"  onmouseover="this.src='<?=($db->f(pic2)!="")?"img/menu/".$db->f(pic2):"img/menu/defualt.jpg"?>'" onmouseout="this.src='<?=($db->f(pic1)!="")?"img/menu/".$db->f(pic1):"img/menu/defualt.jpg"?>'"  border="0" alt="<?=$db->f(name_menu)?>" /></a></td>
<?php } ?>					  
<?php $vj++; } ?>					  			
</tr>
				      </table></td>
				    </tr>
                   <?php } ?> 
				  <?php  if($sh_mooo==1 || $sh_mooo==3 ){ ?>
                  <tr>
				    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
				      <tr>
				       <?php 
$q="SELECT * FROM `menu` WHERE 1 ORDER BY menu_order LIMIT 0,7";
$db->query($q);
$vj=1;
while($db->next_record()){
?>		  			 
		<?
		
		if($db->f(menu_url)==''){
			$url="menu_detail.php?menu_id=".$db->f(id_menu);
			$tar=$db->f(target_menu);
			if($tar=='2'){
				$target="_blank";
			}else{
				$target="_parent";
			}
		}else{
			$url=$db->f(menu_url);
		}
		?> 
<?php if($vj%7==1){ ?>				
              <td width="145" height="36" align="center" id="<?=(basename($_SERVER['PHP_SELF'])==$db->f(url_menu))?"top_menu3":"top_menu4"?>" style="padding-right:5px"><a href="<?=$url?>" target="<?=$target?>"><?=$db->f(name_menu)?></a></td>
<?php } ?>			  			  
<?php if($vj%7==2){ ?>				  
              <td width="145" height="26" align="center" id="<?=(basename($_SERVER['PHP_SELF'])==$db->f(url_menu))?"top_menu3":"top_menu4"?>"style="padding-right:5px"><a href="<?=$url?>" target="<?=$target?>"> <?=$db->f(name_menu)?></a></td>
<?php } ?>			  			  
<?php if($vj%7==3){ ?>						  
              <td width="145" height="26" align="center" id="<?=(basename($_SERVER['PHP_SELF'])==$db->f(url_menu))?"top_menu3":"top_menu4"?>"style="padding-right:5px"><a href="<?=$url?>" target="<?=$target?>"><?=$db->f(name_menu)?></a></td>
<?php } ?>			  			  
<?php if($vj%7==4){ ?>						  
              <td width="145" height="26" align="center" id="<?=(basename($_SERVER['PHP_SELF'])==$db->f(url_menu))?"top_menu3":"top_menu4"?>"style="padding-right:5px"><a href="<?=$url?>" target="<?=$target?>"><?=$db->f(name_menu)?></a></td>
<?php } ?>			  			  
<?php if($vj%7==5){ ?>			  
              <td width="145" height="26" align="center" id="<?=(basename($_SERVER['PHP_SELF'])==$db->f(url_menu))?"top_menu3":"top_menu4"?>"style="padding-right:5px"><a href="<?=$url?>" target="<?=$target?>"><?=$db->f(name_menu)?></a></td>
<?php } ?>			  
<?php if($vj%7==6){ ?>			  
              <td width="145" height="26" align="center" id="<?=(basename($_SERVER['PHP_SELF'])==$db->f(url_menu))?"top_menu3":"top_menu4"?>"style="padding-right:5px"><a href="<?=$url?>" target="<?=$target?>"><?=$db->f(name_menu)?></a></td>
<?php } ?>	
<?php if($vj%7==0){ ?>			  
              <td width="145" height="26" align="center" id="<?=(basename($_SERVER['PHP_SELF'])==$db->f(url_menu))?"top_menu3":"top_menu4"?>"style="padding-right:5px"><a href="<?=$url?>" target="<?=$target?>"><?=$db->f(name_menu)?></a></td>
<?php } ?>					  
<?php $vj++; } ?>					 
				        </tr>
				      </table></td>
				    </tr>
                   <?php } ?> 
				  <?php  if($sh_mooo==2 || $sh_mooo==3 ){ ?>	
                  <tr>
				    <td id="top_menu2" height="33"><table width="100%" border="0" cellspacing="0" cellpadding="0">
				      <tr>
<?php 
$q="SELECT * FROM `menu` WHERE 1 ";
$db9999=new nDB();
$db9999->query($q);
$tototo=$db9999->num_rows();
?>
				        <?php 
$q="SELECT * FROM `menu` WHERE 1 ORDER BY menu_order LIMIT 7,7";
$db->query($q);
$vj=1;
while($db->next_record()){
?>		  			 
		<?
		
		if($db->f(menu_url)==''){
			$url="menu_detail.php?menu_id=".$db->f(id_menu);
			$tar=$db->f(target_menu);
			if($tar=='2'){
				$target="_blank";
			}else{
				$target="_parent";
			}
		}else{
			$url=$db->f(menu_url);
		}
		?> 
<?php if($vj2%7==1){ ?>						
                  <td  width="150" height="36" align="center" style="padding-top:8px;">
				  <a href="<?=$url?>" target="<?=$target?>"><?=$db->f(name_menu)?></a>				   </td>
				  <?php if($tototo<7){ ?>		
				  <?php } ?>  
<?php } ?>			  			  
<?php if($vj2%7==2){ ?>						  
                  <td width="150" align="center" style="padding-top:8px;"><a href="<?=$url?>" target="<?=$target?>"><?=$db->f(name_menu)?></a></td>
				  <?php if($tototo<8){ ?>		
				  <?php } ?>  				  
<?php } ?>			  			  
<?php if($vj2%7==3){ ?>						  
                  <td width="150" align="center" style="padding-top:8px;"><a href="<?=$url?>" target="<?=$target?>"><?=$db->f(name_menu)?></a></td>
				  <?php if($tototo<9){ ?>		
				  <?php } ?>  						  
<?php } ?>			  			  
<?php if($vj2%7==4){ ?>						  
                  <td width="150" align="center" style="padding-top:8px;"><a href="<?=$url?>" target="<?=$target?>"><?=$db->f(name_menu)?></a></td>
				  <?php if($tototo<10){ ?>		
				  <?php } ?>  						  
<?php } ?>			  			  
<?php if($vj2%7==5){ ?>						  
                  <td width="150" align="center" style="padding-top:8px;"><a href="<?=$url?>" target="<?=$target?>"><?=$db->f(name_menu)?></a></td>
				  <?php if($tototo<11){ ?>		
				  <?php } ?>  		
<?php } ?>			  			  
<?php if($vj2%7==6){ ?>							  
                  <td width="150" align="center" style="padding-top:8px;"><a href="<?=$url?>" target="<?=$target?>"> <?=$db->f(name_menu)?></a></td>
<?php } ?>	
<?php if($vj2%7==0){ ?>							  
                  <td width="150" align="center" style="padding-top:8px;"><a href="<?=$url?>" target="<?=$target?>"> <?=$db->f(name_menu)?></a></td>
<?php } ?>			  
<?php $vj2++; } ?>				  		 
				        </tr>
				      </table></td>
				    </tr>
                   <?php } ?>                    
					
				  </table></td>
				</tr>
<?php } ?>                
          </table>	  </td>
        </tr>
                   		<?php 
	$q="SELECT * FROM `mod_content` WHERE  1 ";
	$db66=new nDB();
	$db66->query($q);
	$db66->next_record();
?>	             
        <tr>
          <td valign="top" height="<?=$db66->f(height)?>" ><table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
<?php 
$q="SELECT * FROM `layout` WHERE active=1";
$db11=new nDB();
$db11->query($q);
$db11->next_record();
if($db11->f(id_layout)==1 || $db11->f(id_layout)==2 ){
?>	  
              <td width="162" align="left" valign="top"  bgcolor="<?=$_SESSION['block_color']?>" >
			  
<table width="100" border="0" align="right" cellpadding="0" cellspacing="0">
<?php 
	$q="SELECT * FROM `module` WHERE id_po=1 AND show_mod='1' AND active_mod=1 ORDER BY order_mod ";
	$db10=new nDB();
	$db10->query($q);
	while($db10->next_record()){
		$im=$db10->f(file_mod);
		include($im);
	}
?>															  						  					  						  					  
                    </table>			  </td>
<?php } ?>
<?php if($db11->f(id_layout)==4 && basename($_SERVER['PHP_SELF'])=="index.php"){ ?>
              <td width="162" align="left" valign="top"  bgcolor="<?=$_SESSION['block_color']?>" >
			  
<table width="100" border="0" align="right" cellpadding="0" cellspacing="0">
<?php 
	$q="SELECT * FROM `module` WHERE id_po=1 AND show_mod='1' AND active_mod=1 ORDER BY order_mod ";
	$db10=new nDB();
	$db10->query($q);
	while($db10->next_record()){
		$im=$db10->f(file_mod);
		include($im);
	}
?>															  						  					  						  					  
                    </table>			  </td>
<?php } ?>		
<?php if($db11->f(id_layout)==6 && basename($_SERVER['PHP_SELF'])!="index.php"){ ?>
              <td width="162" align="left" valign="top"  bgcolor="<?=$_SESSION['block_color']?>" >
			  
<table width="100" border="0" cellpadding="0" cellspacing="0">
<?php 
	$q="SELECT * FROM `module` WHERE id_po=1 AND show_mod='1' AND active_mod=1 ORDER BY order_mod ";
	$db10=new nDB();
	$db10->query($q);
	while($db10->next_record()){
		$im=$db10->f(file_mod);
		include($im);
	}
?>															  						  					  						  					  
                    </table>			  </td>
<?php } ?>			          	          
<?php 
$q="SELECT * FROM `layout` WHERE active=1";
$db789=new nDB();
$db789->query($q);
$db789->next_record();
?>	  
              <td align="left" valign="top" bgcolor="<?=$bgg_color?>">
			  <table width="100%" border="0" cellspacing="0" cellpadding="0">
   <tr>
                  <td  ><!-- InstanceBeginEditable name="bodey_detail" -->
                  <table width="100%" cellpadding="0" cellspacing="0" height="<?=$db66->f(height)?>">
                  <tr>
                  <td align="<?=$db66->f(align)?>"   valign="top" style="background:url(img/mod/<?=$db66->f(pic2)?>); padding-left:<?=$db66->f(padleft)?>px; padding-top:<?=$db66->f(padtop)?>px; padding-right:<?=$db66->f(padright)?>px; padding-bottom:<?=$db66->f(padbottom)?>px; -moz-box-sizing: border-box;" >
            
                  <table width="<?=$db66->f(width_mod)?>" border="0" cellspacing="0" cellpadding="0">
               <tr>
                  <td>
              
<div class="divbar" >     
				  <?php
				  if($_GET['menu_id']){
				  	$q="SELECT * FROM `menu` WHERE id_menu='".$_GET['menu_id']."'";
					$db->query($q);
					$db->next_record();
				  }
				  ?>
                  <table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
                    <tr>
                      <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td>&nbsp;</td>
                          </tr>
                          <tr>
                            <td><span id="za_mo2"><?=$db->f(menu_detail)?></span></td>
                          </tr>
                      </table></td>
                    </tr>
                    <tr>
                      <td align="right"><br />
                          <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
                            <tr>
                              <td align="right">&nbsp;</td>
                            </tr>
                        </table></td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                    </tr>
                  </table></div>
                  
                </td>
                  </tr>
                  </table>  </td></tr></table>
                  <!-- InstanceEndEditable --></td>
                  </tr>
              </table></td>  
                         
<?php 
$q="SELECT * FROM `layout` WHERE active=1";
$db22=new nDB();
$db22->query($q);
$db22->next_record();
if($db22->f(id_layout)==3){
?>	  
              <td width="162" align="left" valign="top"  bgcolor="<?=$_SESSION['block_color']?>" >
			  
<table width="100" border="0" align="right" cellpadding="0" cellspacing="0">
<?php 
	$q="SELECT * FROM `module` WHERE id_po=3 AND show_mod='1' AND active_mod=1 ORDER BY order_mod ";
	$db33=new nDB();
	$db33->query($q);
	while($db33->next_record()){
		$im2=$db33->f(file_mod);
		include($im2);
	}
?>															  						  					  						  					  
                    </table>			  </td>
<?php } ?>
<?php if($db22->f(id_layout)==2 && basename($_SERVER['PHP_SELF'])=="index.php"){ ?>
              <td width="162" align="left" valign="top"  bgcolor="<?=$_SESSION['block_color']?>" >
			  
<table width="100" border="0" align="right" cellpadding="0" cellspacing="0">
<?php 
	$q="SELECT * FROM `module` WHERE id_po=3 AND show_mod='1' AND active_mod=1 ORDER BY order_mod ";
	$db33=new nDB();
	$db33->query($q);
	while($db33->next_record()){
		$im2=$db33->f(file_mod);
		include($im2);
	}
?>															  						  					  						  					  
                    </table>			  </td>
<?php } ?>			  
            </tr>
          </table></td>
        </tr>
      </table></td>
    </tr>
  </tbody>
</table></td>
  </tr>
</table>
</div>
<div id="footer">
<div id="foot_wrap">
			  <?php
	$q="SELECT * FROM `footer` WHERE 1";
	$db->query($q);
	$db->next_record();
	$db->p(detail_footer);
			  ?>
</div>
</div>
<script type="text/javascript">
swfobject.registerObject("FlashID");
</script>
</body>
<!-- InstanceEnd --></html>
