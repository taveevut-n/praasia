<?php include("global.php"); ?>
<?php set_page($s_page,$e_page=60); //นำส่วนนี้ิไว้ด้านบน ?>
<?php
 	if ($_GET['shop']) {
	$_SESSION['shop_id']=$_GET['shop'];	
	$shop_id = $_SESSION['shop_id'];
	}
	$q="UPDATE `member` SET `view_num` = `view_num`+3 WHERE `id` ='".$_SESSION['shop_id']."' ";
	$db->query($q);
	$q="SELECT * FROM `member` WHERE id='".$_SESSION['shop_id']."' ";
	$dbshop= new nDB();	
	$dbshop->query($q);
	$dbshop->next_record();
	$arrival = $dbshop->f(date_add);
	$q="SELECT * FROM `product` WHERE shop_id ='".$_SESSION['shop_id']."' ";
	$dbproduct= new nDB();	
	$dbproduct->query($q);
	$dbproduct->next_record();
	$num_rows = $dbproduct->num_rows();
?>  
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script language="javascript" type="text/javascript" src="swfobject.js" ></script>
<head>
<title>ร้าน
<?=$dbshop->f(shopname)?>
| ศูนย์รวพระเครื่องเมืองไทย  合艾佛牌网</title>
<link rel="shortcut icon" href="favicon.ico" />
<link rel="favicon" href="favicon.ico" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<!-- load jQuery -->
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.js"></script>

<!-- load Galleria -->
<script src="galleria/galleria-1.2.9.min.js"></script>
<?php include("index.css"); ?>
<style type="text/css">
body {
	background-color: #000;
	background-image: url(images/bg.jpg);
	background-position:top center;
	background-repeat:no-repeat;	
}
body,td,th {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 12px;
}
a:link {
	text-decoration: none;
}
a:visited {
	text-decoration: none;
	color: #000;
}
a:hover {
	text-decoration: none;
}
a:active {
	text-decoration: none;
	color: #000;
}
</style>
<style>

	/* Demo styles */
	html,body{;margin:0;}
	body{border-top:4px solid #000;}
	.content{color:#777;font:12px/1.4 "helvetica neue",arial,sans-serif;width:450px; background-color:#000}
	h1{font-size:12px;font-weight:normal;color:#ddd;margin:0;}
	a {color:#22BCB9;text-decoration:none;}
	.cred{font-size:11px;}

	/* This rule is read by Galleria to define the gallery height: */
	#galleria{height:355px}

</style>
<script src="Scripts/swfobject.js" type="text/javascript"></script>
</head>
<body bgcolor="#FFFFFF" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<!-- Save for Web Slices (???????.jpg) -->
<table width="1000" border="0" align="center" cellpadding="0" cellspacing="0" id="Table_01">
	<tr>
    <td><table width="1000" border="0" cellpadding="0" cellspacing="0">
    
              
							<?php $chk=substr($dbshop->f(head1),-3); ?>							
							<?php if($chk=="jpg" || $chk=="gif" or $chk=="png"){ ?><tr>
			  <td colspan="7" align="left" valign="top" height="255"><img src="img/head/<?=$dbshop->f(head1)?>" width="1000" height="350"></td>
              </tr>
			  				<?php } ?>
							<?php if($chk=="swf"){ 
							?>
                            <tr>
                            <td colspan="8" align="left" valign="top">
  <object id="FlashID" classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" width="1000" height="255">
    <param name="movie" value="img/head/<?=$dbshop->f(head1)?>" />
    <param name="quality" value="high" />
    <param name="wmode" value="opaque" />
    <param name="swfversion" value="8.0.35.0" />
    <!-- This param tag prompts users with Flash Player 6.0 r65 and higher to download the latest version of Flash Player. Delete it if you don't want users to see the prompt. -->
    <param name="expressinstall" value="../Scripts/expressInstall.swf" />
    <!-- Next object tag is for non-IE browsers. So hide it from IE using IECC. -->
    <!--[if !IE]>-->
    <object type="application/x-shockwave-flash" data="img/head/<?=$dbshop->f(head1)?>" width="1000" height="255">
      <!--<![endif]-->
      <param name="quality" value="high" />
      <param name="wmode" value="opaque" />
      <param name="swfversion" value="8.0.35.0" />
      <param name="expressinstall" value="../Scripts/expressInstall.swf" />
      <!-- The browser displays the following alternative content for users with Flash Player 6.0 and older. -->
      <div>
        <h4>Content on this page requires a newer version of Adobe Flash Player.</h4>
        <p><a href="http://www.adobe.com/go/getflashplayer"><img src="http://www.adobe.com/images/shared/download_buttons/get_flash_player.gif" alt="Get Adobe Flash player" width="112" height="33" /></a></p>
      </div>
      <!--[if !IE]>-->
    </object>
    <!--<![endif]-->
  </object> </td></tr>																
			  				<?php } ?>				  
          </table></td>
    </tr>
	<tr>
		<td height="45" style="background:url(images/menu.jpg) no-repeat"><table width="995" border="0" align="center" cellpadding="0" cellspacing="0">
		  <tr>
		    <td width="232" align="left"><a href="index.php"><span style="color:#000; font-weight:bold">หน้าแรกพระหาดใหญ่ / 首页合艾网</span></a></td>
		    <td width="224" align="center"><a href="shop_index.php?shop=<?=$dbshop->f(id)?>"><span style="color:#000; font-weight:bold">เข้าสู่ร้านค้า/进入商店</span></a></td>
		    <td width="158" align="center"><a href="show_product.php?shop=<?=$_SESSION['shop_id']?>"><span style="color:#000; font-weight:bold">สินค้าในร้าน / 本店产品</span></a></td>
		    <td width="381" align="right"><table width="380" border="0" cellspacing="0" cellpadding="3">
		      <form action="show_search.php" method="post" name="search" target="_parent" id="search">
		        <tr>
		          <td width="194" align="right"><span style="color:#000; font-weight:bold">ค้นหาพระเครื่อง / 搜索:</span></td>
		          <td width="105" align="center"><input name="q" id="q" size="13" /></td>
		          <td width="63" align="center"><input name="search" type="submit" id="search" value="search" /></td>
	            </tr>
	          </form>
		      </table></td>
	      </tr>
	    </table></td>
	</tr>
	<tr>
		<td><img src="images/bt-menu.jpg" width="1000" height="20"></td>
	</tr>
	<tr>
		<td valign="top" style="background:url(images/bg-product.jpg) no-repeat"><table width="100%" border="0" cellspacing="0" cellpadding="0">
		  <tr>
		    <td width="5%">&nbsp;</td>
		    <td width="41%" valign="top"><table width="400" height="386" border="0" cellspacing="0" cellpadding="0">
		      <tr>
		        <td valign="top" style="padding:5px; padding-top:25px; background:url(images/bg-welcome.png) repeat-y">
                	<table width="100%">
                    	<tr>
                        	<td>
                            <div  style="color:#900; font-weight:bold; word-break:break-all; width:390px">
                            รายละเอียดร้านค้า / 产店详容 :<span style="color:#391700"> <?=$dbshop->f(welcome)?></span>
                            </div>
                            </td>
                        </tr>
                        <tr>
                        	<td>
                            <table width="390px" border="0" cellspacing="0" cellpadding="3">
                            <tr>
                              <td align="center"><span style="color:#900; font-weight:bold">การรับประกัน / 如何保证产品 </span></td>
                            </tr>
                            <? if ($dbshop->f(warranty2)==1) { ?>
                            <tr>
                              <td>รับประกันพระแท้ภายในระยะเวลา / /保证真产品的期间内 <span style="font-weight:bold; color:#900; font-size:16px"><?=$dbshop->f(warrantydetail1)?></span> วัน/ 天 นับแต่ลูกค้าได้รับพระไป / /算当天开始领到产品</td>
                            </tr>
                            <? } ?>
                            <? if ($dbshop->f(warranty3)==1) { ?>
                            <tr>
                              <td>รับประกันความพอใจในระยะเวลา / 保证满意的定期时间 <span style="font-weight:bold; color:#900; font-size:16px"><?=$dbshop->f(warrantydetail2)?></span> วัน / 天 ไม่หักเปอร์เซ็นต์ / /不扣百分之 (เมื่อได้รับพระแล้วไม่ถูกใจ /意思是如领到后不满意) แต่หากเกินจำนวนวันหัก /但如超定期扣数目 <span style="font-weight:bold; color:#900; font-size:16px"><?=$dbshop->f(warrantydetail3)?></span> %</td>
                            </tr>
                            <? } ?>
                            <? if ($dbshop->f(warranty4)==1) { ?>                            
                            <tr>
                              <td>พระต้องอยู่ในสภาพเดิม ไม่ชำรุดหักบิ่น เสียสภาพ ล้างผิว /产品要保持原样 不残破 断 洗皮</td>
                            </tr>
                            <? } ?>
                            <? if ($dbshop->f(warranty5)==1) { ?>                            
                            <tr>
                              <td>ยินดีรับซื้อคืนในราคาตลาดขณะนั้น /卖家满意买回当时产品的买卖价钱</td>
                            </tr>
                            <? } ?>
                            <? if ($dbshop->f(warranty6)==1) { ?>                            
                            <tr>
                              <td>นำมาแลกเปลี่ยน กับองค์ใหม่ได้ หากท่านต้องการซื้อพระองค์อื่นโดยหัก /产品交换，可以换新的产品，如买家需要换别的产品，将要扣百分之 <span style="font-weight:bold; color:#900; font-size:16px"><?=$dbshop->f(warrantydetail4)?></span> %</td>
                            </tr>
                            <? } ?>
                          </table>
                            </td>
                        </tr>
                    	<tr>
                        	<td>
                            <div  style="color:#900; font-weight:bold; word-break:break-all; width:390px">
                            <span style="color:#391700"><?=$dbshop->f(warranty)?></span>
                            </div>
                            </td>
                        </tr>
                    </table>
                </td>
	          </tr>
		      <tr>
		        <td height="200" valign="top" style="padding-top:19px; background-color:#3d1002"><table width="98%" height="146" border="0" align="center" cellpadding="0" cellspacing="0">
		          <tr>
		            <td width="42%" height="22" align="right" class="topic" style="padding-right:10px" >ชื่อร้านค้า / <span style="padding-top:30px; padding-right:15px; font-weight:bold">店鋪</span>:</td>
		            <td width="58%"><span style="color:#FFFFFF"><?=$dbshop->f(shopname)?></span></td>
		            </tr>
		          <tr>
		            <td height="26" align="right" class="topic" style="padding-right:10px" >ชื่อเจ้าของร้าน / <span style="padding-top:20px; padding-right:15px; font-weight:bold">店主名稱 </span>:</td>
		            <td><span style="color:#FFFFFF"><?=$dbshop->f(name)?></span></td>
		            </tr>
		          <tr>
		            <td height="49" align="right" valign="top" class="topic" style="padding-right:10px" >ที่อยู่ / 地址 :</td>
		            <td valign="top"><span style="color:#FFFFFF"><?=$dbshop->f(address)?></span></td>
		            </tr>
		          <tr>
		            <td height="25" align="right" class="topic" style="padding-right:10px" >เบอร์โทรติดต่อ / 電話 :</td>
		            <td><span style="color:#FFFFFF"><?=$dbshop->f(mobile)?> &nbsp;&nbsp;<?=$dbshop->f(tel)?>
					</span></td>
		            </tr>
		          <tr>
		            <td height="24" align="right" class="topic" style="padding-right:10px" >E-mail :</td>
		            <td><span style="color:#FFFFFF"><?=$dbshop->f(email)?></span></td>
		            </tr>
	            </table></td>
	          </tr>
	        </table></td>
		    <td width="54%" valign="top" style="padding-left:5px; padding-top:5px">
<table width="400" border="0" cellpadding="3" cellspacing="0">
<tr>
<td style="backgound-color:#000">



<div class="content">
	<div id="galleria">
		<?php
			$q = "SELECT * FROM `product` WHERE shop_id = '".$dbshop->f(id)."' AND slide = '1' AND active = '2' ORDER BY RAND() ";
			$dbimg = new nDB();
			$dbimg->query($q);							
			while ($dbimg->next_record()) {
			if($dbimg->f(pic1)!=''){
		?>
		<a href="img/amulet/<?=$dbimg->f(pic1)?>">
			<img src="/resize/w45-h40/img/amulet/<?=$dbimg->f(pic1)?>" data-link="shop_product.php?product_id=<?=$dbimg->f(product_id)?>"/>
		</a>
		<?php
			}
			if($dbimg->f(pic2)!=''){
		?>
		<a href="img/amulet/<?=$dbimg->f(pic2)?>">
			<img src="/resize/w45-h40/img/amulet/<?=$dbimg->f(pic2)?>",data-big="/resize/w298-h285/img/amulet/<?=$dbimg->f(pic2)?>" data-link="shop_product.php?product_id=<?=$dbimg->f(product_id)?>"/>
		</a>
		<?php
			}
			if($dbimg->f(pic3)!=''){
		?>
		<a href="img/amulet/<?=$dbimg->f(pic3)?>">
			<img src="/resize/w45-h40/img/amulet/<?=$dbimg->f(pic3)?>",data-big="/resize/w298-h285/img/amulet/<?=$dbimg->f(pic3)?>" data-link="shop_product.php?product_id=<?=$dbimg->f(product_id)?>"/>
		</a>    
		<?php
			}
			if($dbimg->f(pic4)!=''){
		?>
		<a href="img/amulet/<?=$dbimg->f(pic4)?>">
			<img src="/resize/w45-h40/img/amulet/<?=$dbimg->f(pic4)?>",data-big="/resize/w298-h285/img/amulet/<?=$dbimg->f(pic4)?>" data-link="shop_product.php?product_id=<?=$dbimg->f(product_id)?>"/>
		</a>
		<?php
				}
			}
		?>
	</div>
</div>
<script>
	Galleria.loadTheme("/galleria/themes/classic/galleria.classic.min.js");
	Galleria.run("#galleria", {
		autoplay: 1000
	});
</script>


                </td>
              </tr>
              <tr>
                <td height="5"></td>
              </tr>
              
            </table>
            </td>
	      </tr>
		  <tr>
		    <td height="200" colspan="4" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
		      <tr>
		        <td width="30%" height="190" valign="middle" style="padding-top:35px"><table width="250" border="0" align="right" cellpadding="3" cellspacing="0">
		          <tr>
                  	<td colspan="2">
                    	<table width="180" align="center" cellpadding="0" cellspacing="0">
                        	<tr>
                            	<td><img src="<?=($dbshop->f(head2)!="")?'img/head/'.$dbshop->f(head2):"images/logodefualt.jpg"?>" width="180" height="180"></td>
                            </tr>
                        </table>
                    </td>
                  </tr> 
                        	<tr>
                        	  <td height="25" class="topic"><span style="color:#FC0">ID ร้านค้า / 店: <?=$dbshop->f(shop_id)?></span></td>
               	    </tr>                          
                  <tr>
		            <td width="46%" align="left" class="topic">วันเปิดร้าน / 开店日期 :
		              <?=date("d F Y",$arrival)?></td>
		            </tr>

		          <tr>
		            <td align="left" class="topic">มีสินค้าทั้งหมด / 总共商品 :
		              <?=$num_rows?>
ชิ้น 尊</td>
		            </tr>
		          <tr>
		            <td align="left" class="topic">ผู้เข้าชมทั้งหมด / 总共防客:
		              <?=$dbshop->f(view_num)?>
คน 位</td>
		            </tr>
                   <?
                              /*
                              Counter Information
                              
                              Website: http://www.free-php-counter.com/
                              Version: Text version
                              
                              Installation help:
                              
                              http://www.free-php-counter.com/text-counter.php
                              
                              
                              You like to remove the link on the counter? Click here and get an link free license:
                              
                              http://www.free-php-counter.com/adfree_counter.php
                              */
                              
                              
                              // edit counter settings here
                              
                              
                              // absolut path to the folder containing counter.php and counter.gif (????????? / ???????????)
                              // use $_SERVER['DOCUMENT_ROOT'] . "/" when the counter is in root dir
                              /* use <? echo dirname($_SERVER['SCRIPT_FILENAME']) . "/"; ?> to get absolute path */
                              $counter_path_absolut = dirname($_SERVER['SCRIPT_FILENAME'])."/";
                              
                              // http path to the folder containing counter.php and counter.gif (????????? / ???????????)
                              // set http://www.your-homepage.com/ when the counter is in root dir
                              $counter_path_http = "http://www.praasia.com/";
                              
                              // IP-lock in seconds
                              $counter_expire = 600;
                              
                              
                              // do not edit from here
                              
                              $counter_filename = $counter_path_absolut . "counter.txt";
                              
                              if (file_exists($counter_filename)) 
                              {
                                 $ignore = false;
                                 $current_agent = (isset($_SERVER['HTTP_USER_AGENT'])) ? addslashes(trim($_SERVER['HTTP_USER_AGENT'])) : "no agent";
                                 $current_time = time();
                                 $current_ip = $_SERVER['REMOTE_ADDR']; 
                                    
                                 // daten einlesen
                                 $c_file = array();
                                 $handle = fopen($counter_filename, "r");
                                 
                                 if ($handle)
                                 {
                                    while (!feof($handle)) 
                                    {
                                       $line = trim(fgets($handle, 4096)); 
                                       if ($line != "")
                                          $c_file[] = $line;		  
                                    }
                                    fclose ($handle);
                                 }
                                 else
                                    $ignore = true;
                                 
                                 // bots ignorieren   
                                 if (substr_count($current_agent, "bot") > 0)
                                    $ignore = true;
                                    
                                 
                                 // hat diese ip einen eintrag in den letzten expire sec gehabt, dann igornieren?
                                 for ($i = 1; $i < sizeof($c_file); $i++)
                                 {
                                    list($counter_ip, $counter_time) = explode("||", $c_file[$i]);
                                    $counter_time = trim($counter_time);
                                    
                                    if ($counter_ip == $current_ip && $current_time-$counter_expire < $counter_time)
                                    {
                                       // besucher wurde bereits gez?hlt, daher hier abbruch
                                       $ignore = true;
                                       break;
                                    }
                                 }
                                 
                                 // counter hochz?hlen
                                 if ($ignore == false)
                                 {
                                    if (sizeof($c_file) == 0)
                                    {
                                       // wenn counter leer, dann f?llen      
                                       $add_line1 = date("z") . ":1||" . (date("z")-1) . ":0||" . date("W") . ":1||" . date("n") . ":1||" . date("Y") . ":1||1||1||" . $current_time . "\n";
                                       $add_line2 = $current_ip . "||" . $current_time . "\n";
                                       
                                       // daten schreiben
                                       $fp = fopen($counter_filename,"w+");
                                       if ($fp)
                                       {
                                          flock($fp, LOCK_EX);
                                          fwrite($fp, $add_line1);
                                          fwrite($fp, $add_line2);
                                          flock($fp, LOCK_UN);
                                          fclose($fp);
                                       }
                                       
                                       // werte zur verf?gung stellen
                                       $day = $yesterday = $week = $month = $year = $all = $record = 1;
                                       $record_time = $current_time;
                                       $online = 1;
                                    }
                                    else
                                    {
                                       // counter hochz?hlen
                                       list($day_arr, $yesterday_arr, $week_arr, $month_arr, $year_arr, $all, $record, $record_time) = explode("||", $c_file[0]);
                                       
                                       $day_data = explode(":", $day_arr);
                                       $yesterday_data = explode(":", $yesterday_arr);
                                               
                                       // yesterday
                                       $yesterday = $yesterday_data[1];
                                       if ($day_data[0] == (date("z")-1)) 
                                       {
                                          $yesterday = $day_data[1]; 
                                       }
                                       else
                                       {
                                          if ($yesterday_data[0] != (date("z")-1))
                                          {
                                             $yesterday = 0; 
                                          }
                                       }
                                       
                                       // day
                                       $day = $day_data[1];
                                       if ($day_data[0] == date("z")) $day++; else $day = 1;
                                       
                                       // week
                                       $week_data = explode(":", $week_arr);
                                       $week = $week_data[1];
                                       if ($week_data[0] == date("W")) $week++; else $week = 1;
                                       
                                       // month
                                       $month_data = explode(":", $month_arr);
                                       $month = $month_data[1];
                                       if ($month_data[0] == date("n")) $month++; else $month = 1;
                                       
                                       // year
                                       $year_data = explode(":", $year_arr);
                                       $year = $year_data[1];
                                       if ($year_data[0] == date("Y")) $year++; else $year = 1;
                                        
                                       // all
                                       $all++;
                                       
                                       // neuer record?
                                       $record_time = trim($record_time);
                                       if ($day > $record)
                                       {
                                          $record = $day;
                                          $record_time = $current_time;
                                       }
                                       
                                       // speichern und aufr?umen und anzahl der online leute bestimmten
                                       
                                       $online = 1;
                                       
                                       // daten schreiben
                                       $fp = fopen($counter_filename,"w+");
                                       if ($fp)
                                       {
                                          flock($fp, LOCK_EX);
                                          $add_line1 = date("z") . ":" . $day . "||" . (date("z")-1) . ":" . $yesterday . "||" . date("W") . ":" . $week . "||" . date("n") . ":" . $month . "||" . date("Y") . ":" . $year . "||" . $all . "||" . $record . "||" . $record_time . "\n";		 
                                          fwrite($fp, $add_line1);
                                       
                                          for ($i = 1; $i < sizeof($c_file); $i++)
                                          {
                                             list($counter_ip, $counter_time) = explode("||", $c_file[$i]);
                                    
                                             // ?bernehmen
                                             if ($current_time-$counter_expire < $counter_time)
                                             {
                                                $counter_time = trim($counter_time);
                                                $add_line = $counter_ip . "||" . $counter_time . "\n";
                                                fwrite($fp, $add_line);
                                                $online++;
                                             }
                                          }
                                          $add_line = $current_ip . "||" . $current_time . "\n";
                                          fwrite($fp, $add_line);
                                          flock($fp, LOCK_UN);
                                          fclose($fp);
                                       }
                                    }
                                 }
                                 else
                                 {
                                    // nur zum anzeigen lesen
                                    if (sizeof($c_file) > 0)
                                       list($day_arr, $yesterday_arr, $week_arr, $month_arr, $year_arr, $all, $record, $record_time) = explode("||", $c_file[0]);
                                    else
                                       list($day_arr, $yesterday_arr, $week_arr, $month_arr, $year_arr, $all, $record, $record_time) = explode("||", date("z") . ":1||" . (date("z")-1) . ":0||" .  date("W") . ":1||" . date("n") . ":1||" . date("Y") . ":1||1||1||" . $current_time);
                                    
                                    // day
                                    $day_data = explode(":", $day_arr);
                                    $day = $day_data[1];
                                    
                                    // yesterday
                                    $yesterday_data = explode(":", $yesterday_arr);
                                    $yesterday = $yesterday_data[1];
                                    
                                    // week
                                    $week_data = explode(":", $week_arr);
                                    $week = $week_data[1];
                                  
                                    // month
                                    $month_data = explode(":", $month_arr);
                                    $month = $month_data[1];
                                    
                                    // year
                                    $year_data = explode(":", $year_arr);
                                    $year = $year_data[1];
                                    
                                    $record_time = trim($record_time);
                                    
                                    $online = sizeof($c_file) - 1;
                                 }
                              ?>  
		          <tr>
		            <td align="left" class="topic">ออนไลน์ขณะนี้ / 在线访客: <? echo ($online*2)+31; ?> คน 位</td>
		            </tr>
                    <? } ?>
	            </table>
	        </td>
		        <td width="70%" valign="top" style="padding-top:5px">
		        	<table width="100%" border="0" cellspacing="0" cellpadding="0">
		          <tr>
		            <td align="center"><img src="images/recommend.png" width="372" height="32"></td>
		            </tr>
		          <tr>
		            <td><table width="712" border="0" align="center" cellpadding="0" cellspacing="0">
                      <tr>
		                <td height="209" valign="top" style="padding-left:5px; padding-top:5px; border:3px solid #fc0;">
						<? 	$q="SELECT * FROM `product` WHERE shop_id ='".$_SESSION['shop_id']."' AND hot = '1' AND active = '2' ORDER BY RAND () LIMIT 0,8 ";
                        $dbhot= new nDB();
                        $dbhot->query($q);
                        while ($dbhot->next_record()) { ?>
                        <table width="148" border="0" align="center" cellpadding="0" cellspacing="0" style="float:left; margin:5px">
	<tr>
		<td align="center">
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td bgcolor="#000000">
						<a href="shop_product.php?product_id=<?=$db->f(product_id)?>">
							<img src="<?=($dbhot->f(pic1)!="")?'/resize/w155-h150/img/amulet/'.$dbhot->f(pic1):"images/clear.gif"?>" alt="" width="155" height="150" border="0" />
						</a>
					</td>
				</tr>
			</table>
		</td>
	</tr>
<tr>
<td height="60px" valign="top" bgcolor="#666666">
<table width="95%" border="0" align="center" cellpadding="3" cellspacing="0">
	<tr>
		<td>
			<div style="position:relative;">
				<div class="pravote_container" style="display:none; position:absolute; left:-200px; top:-250px;">
					<table style="width:400px; height:250px; color:#ffcc02; background-color:#311407; border:1px solid #ffcc02; border-collapse:collapse;" border="0" cellpadding="0" cellspacing="0">
						<tr>
							<td style="height:35px; text-align:center; font-weight:bold;">
								คะแนนความน่าเชื่อถือสินค้านี้
							</td>
						</tr>
						<tr>
							<td style="height:1px; text-align:center;">
								<?php
									if($db->f(score) < 0){
										$dbscore = 0;
									}else{
										$dbscore = $db->f(score);
									}
								?>
								<div class="pra_progressbar_container">
									<table style="position:absolute; width:350px; height:27px;" border="0" cellpadding="0" cellspacing="0">
										<tr>
											<td style="text-align:center; vertical-align:middle; color:#000000;">
												<?=$dbscore?>
												คะแนน / 分数
											</td>
										</tr>
									</table>
									<div class="pra_progressbar" style="width:<?=$dbscore?>%;"></div>
								</div>
							</td>
						</tr>
						<tr>
							<td style="padding-top:5px; vertical-align:top;">
								<table border="0" cellpadding="0" cellspacing="0">
									<tr>
										<td style="width:90px; height:35px; text-align:right; vertical-align:top;">
											เหตุผลที่เลือก
											<br/>
											选的意见
										</td>
										<td style="width:20px; text-align:center; vertical-align:top;">
											:
										</td>
										<td style="padding-right:5px; vertical-align:top;">
											<?php
												$showment = new nDB();
												$showment->query("SELECT * FROM `comment` WHERE `comment_product` = '".$dbhot->f(product_id)."' ORDER BY comment_id DESC ");
												$showment->next_record();
												if ($showment->f(vote1) != 0) {
											?>
											จากภาพพระเบลอ / 相片里佛牌模糊
											,
											<?php
												}
												if ($showment->f(vote2) != 0) {
											?>
											จากภาพพระเบลอมาก / 相片里佛牌很模糊
											,
											<?php
												}
												if ($showment->f(vote3) != 0) {
											?>
											จากภาพพิมพ์ตื้นไป / 相片里模表面很浅
											,
											<?php
												}
												if ($showment->f(vote4)) {
											?>
											จากภาพผิดพิมพ์ / 相片里佛牌模不对
											,
											<?php
												}
												if ($showment->f(vote5) != 0) {
											?>
											จากภาพผิดเนื้อ / 相片里佛牌料质不对
											,
											<?php
												}
												if ($showment->f(vote6) !=0) {
											?>
											จากภาพผิวรมใหม่ / 相片里佛牌是新皮
											,
											<?php
												}
												if ($showment->f(vote7) != 0) {
											?>
											จากภาพพระบวม / 相片里佛牌肿胀
											,
											<?php
												}
												if ($showment->f(vote8) != 0) {
											?>
											จากภาพพระดูยาก / 相片里佛牌辨认真假难
											,
											<?php
												}
												if ($showment->f(vote9) != 0) {
											?>
											จากภาพทีความคมชัดน้อย / 相片里的尖锐度很少
											,
											<?php
												}
												if ($showment->f(vote10) != 0) {
											?>
											จากภาพปลอมแปลงใบรับรอง / 假冒的验正书
											,
											<?php
												}
												if ($showment->f(vote11) != 0) {
											?>
											จากภาพประวัติไม่ชัดเจน / 来历不明显
											
											<?php
												}
											?>
										</td>
									</tr>
									<tr>
										<td style="height:35px; text-align:right; vertical-align:top;">
											เหตุผลเพิ่มเติม
										</td>
										<td style="width:20px; text-align:center; vertical-align:top;">
											:
										</td>
										<td style="padding-right:5px; vertical-align:top;">
											<?=$showment->f(comment_detail)?>
										</td>
									</tr>
									<tr>
										<td style="height:35px; text-align:right; vertical-align:top;">
											วันที่
										</td>
										<td style="width:20px; text-align:center; vertical-align:top;">
											:
										</td>
										<td style="padding-right:5px; vertical-align:top;">
											<?=date("d F Y",$showment->f(comment_date))?>
										</td>
									</tr>
								</table>
							</td>
						</tr>
					</table>
				</div>
			</div>
			<?php
				if ($dbhot->f(score) == "100") {
			?>
			<img onmouseover="$(this).parent().find('div:eq(1)').show();" onmouseout="$(this).parent().find('div:eq(1)').hide();" src="images/light-green.png" border="0" />
			<?php
				} else {
					if ($dbhot->f(score) < 31) {
			?>
			<img onmouseover="$(this).parent().find('div:eq(1)').show();" onmouseout="$(this).parent().find('div:eq(1)').hide();" src="images/flash-red.gif" border="0" />
			<?php
					}
					if ($dbhot->f(score) > 30 and $dbhot->f(score) < 70) {
			?>
			<img onmouseover="$(this).parent().find('div:eq(1)').show();" onmouseout="$(this).parent().find('div:eq(1)').hide();" src="images/flash-yellow.gif" border="0" />
			<?php
					}
					if ($dbhot->f(score) > 70) {
			?>
			<img onmouseover="$(this).parent().find('div:eq(1)').show();" onmouseout="$(this).parent().find('div:eq(1)').hide();" src="images/flash-green.gif" border="0" />
			<?php
					}
				}
			?>
			&nbsp;
			<span style="color:#0CF; font-weight:bold">
				ID : <?=$dbhot->f(product_id)?>
			</span>
		</td>
	</tr>
	<tr>
		<td height="25">
			<div style="width:133px; height:67px; overflow:hidden;">
				<div style="width:153px; height:65px; overflow-y:scroll; overflow-x:hidden;">
					<table width="129">
						<tr>
							<td>
								<a href="shop_product.php?product_id=<?=$dbhot->f(product_id)?>"  title="<?=$dbhot->f(name)?>" >
									<span style="color:#FFF">
										<?=$dbhot->f(name)?>
									</span>
								</a>
							</td>
						</tr>
					</table>
				</div>
			</div>
		</td>
	</tr>
</table>
</td>
</tr>
	<tr>
		<td height="25" align="center" bgcolor="#333333">
			<table width="100%" cellpadding="0" cellspacing="0">
				<tr>
					<td width="63%" align="center">
						<span style="color:#FFF">
							<?php
								if($dbhot->f(status) == 1){
							?>
							<span style="color:#09F">
								พระโชว์ / 展示
							</span>
							<?php
								}
								if($dbhot->f(status) == 2){
							?>
							<span style="color:#090">
								ให้เช่า / 出售
							</span>
							<?php
								}
								if($dbhot->f(status) == 3){
							?>
							<span style="color:#FF0">
								เปิดจอง / 预定
							</span>
							<?php
								}
								if($dbhot->f(status) == 4){
							?>
							<span style="color:#FC0">
								จองแล้ว / 已定
							</span>
							<?php
								}
								if($dbhot->f(status) == 5){
							?>
							<span style="color:#F00">
								ขายแล้ว / 已出售
							</span>
							<?php
								}
							?>
						</span>
					</td>
					<td width="37%">
						<table width="100%" border="0" cellspacing="0" cellpadding="3">
							<tr>
								<td width="20">
									<img src="images/view-icon.png" width="20" height="11" />
								</td>
								<td>
									<span style="color:#FFF">
										<?=$dbhot->f(view_num)?>
									</span>
								</td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
		</td>
	</tr>
</table>
						  <? } ?>
                          </td>
		                </tr>
		              </table>
                      </td>
		            </tr>
	            </table></td>
	          </tr>
	        </table></td>
	      </tr>
	    </table></td>
	</tr>
    <tr>
    	<td height="10">
        </td>
    </tr>
	<tr>
		<td><table width="100%" border="0" cellspacing="0" cellpadding="0">	
          <tr>
		    <td>
			  <?php
              $q="SELECT * FROM `product` WHERE shop_id='".$_SESSION['shop_id']."' AND active = '2'";
              $p_r=1;
              $db->query($q);							
              $total=$db->num_rows();							
              $q.=" ORDER BY product_id DESC LIMIT $s_page,$e_page";
              $db->query($q);
              while($db->next_record()){
              ?>
			  <table width="148" border="0" align="center" cellpadding="0" cellspacing="0" style="float:left; margin:5px">
	<tr>
		<td align="center">
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td bgcolor="#000000">
						<a href="shop_product.php?product_id=<?=$db->f(product_id)?>">
							<img src="<?=($db->f(pic1)!="")?'/resize/w155-h150/img/amulet/'.$db->f(pic1):"images/clear.gif"?>" alt="" width="155" height="150" border="0" />
						</a>
					</td>
				</tr>
			</table>
		</td>
	</tr>
<tr>
<td height="60px" valign="top" bgcolor="#666666">
<table width="95%" border="0" align="center" cellpadding="3" cellspacing="0">
	<tr>
		<td>
			<div style="position:relative;">
				<div class="pravote_container" style="display:none; position:absolute; left:-200px; top:-250px;">
					<table style="width:400px; height:250px; color:#ffcc02; background-color:#311407; border:1px solid #ffcc02; border-collapse:collapse;" border="0" cellpadding="0" cellspacing="0">
						<tr>
							<td style="height:35px; text-align:center; font-weight:bold;">
								คะแนนความน่าเชื่อถือสินค้านี้
							</td>
						</tr>
						<tr>
							<td style="height:1px; text-align:center;">
								<?php
									if($db->f(score) < 0){
										$dbscore = 0;
									}else{
										$dbscore = $db->f(score);
									}
								?>
								<div class="pra_progressbar_container">
									<table style="position:absolute; width:350px; height:27px;" border="0" cellpadding="0" cellspacing="0">
										<tr>
											<td style="text-align:center; vertical-align:middle; color:#000000;">
												<?=$dbscore?>
												คะแนน / 分数
											</td>
										</tr>
									</table>
									<div class="pra_progressbar" style="width:<?=$dbscore?>%;"></div>
								</div>
							</td>
						</tr>
						<tr>
							<td style="padding-top:5px; vertical-align:top;">
								<table border="0" cellpadding="0" cellspacing="0">
									<tr>
										<td style="width:90px; height:35px; text-align:right; vertical-align:top;">
											เหตุผลที่เลือก
											<br/>
											选的意见
										</td>
										<td style="width:20px; text-align:center; vertical-align:top;">
											:
										</td>
										<td style="padding-right:5px; vertical-align:top;">
											<?php
												$showment = new nDB();
												$showment->query("SELECT * FROM `comment` WHERE `comment_product` = '".$db->f(product_id)."' ORDER BY comment_id DESC ");
												$showment->next_record();
												if ($showment->f(vote1) != 0) {
											?>
											จากภาพพระเบลอ / 相片里佛牌模糊
											,
											<?php
												}
												if ($showment->f(vote2) != 0) {
											?>
											จากภาพพระเบลอมาก / 相片里佛牌很模糊
											,
											<?php
												}
												if ($showment->f(vote3) != 0) {
											?>
											จากภาพพิมพ์ตื้นไป / 相片里模表面很浅
											,
											<?php
												}
												if ($showment->f(vote4)) {
											?>
											จากภาพผิดพิมพ์ / 相片里佛牌模不对
											,
											<?php
												}
												if ($showment->f(vote5) != 0) {
											?>
											จากภาพผิดเนื้อ / 相片里佛牌料质不对
											,
											<?php
												}
												if ($showment->f(vote6) !=0) {
											?>
											จากภาพผิวรมใหม่ / 相片里佛牌是新皮
											,
											<?php
												}
												if ($showment->f(vote7) != 0) {
											?>
											จากภาพพระบวม / 相片里佛牌肿胀
											,
											<?php
												}
												if ($showment->f(vote8) != 0) {
											?>
											จากภาพพระดูยาก / 相片里佛牌辨认真假难
											,
											<?php
												}
												if ($showment->f(vote9) != 0) {
											?>
											จากภาพทีความคมชัดน้อย / 相片里的尖锐度很少
											,
											<?php
												}
												if ($showment->f(vote10) != 0) {
											?>
											จากภาพปลอมแปลงใบรับรอง / 假冒的验正书
											,
											<?php
												}
												if ($showment->f(vote11) != 0) {
											?>
											จากภาพประวัติไม่ชัดเจน / 来历不明显
											
											<?php
												}
											?>
										</td>
									</tr>
									<tr>
										<td style="height:35px; text-align:right; vertical-align:top;">
											เหตุผลเพิ่มเติม
										</td>
										<td style="width:20px; text-align:center; vertical-align:top;">
											:
										</td>
										<td style="padding-right:5px; vertical-align:top;">
											<?=$showment->f(comment_detail)?>
										</td>
									</tr>
									<tr>
										<td style="height:35px; text-align:right; vertical-align:top;">
											วันที่
										</td>
										<td style="width:20px; text-align:center; vertical-align:top;">
											:
										</td>
										<td style="padding-right:5px; vertical-align:top;">
											<?=date("d F Y",$showment->f(comment_date))?>
										</td>
									</tr>
								</table>
							</td>
						</tr>
					</table>
				</div>
			</div>
			<?php
				if ($db->f(score) == "100") {
			?>
			<img onmouseover="$(this).parent().find('div:eq(1)').show();" onmouseout="$(this).parent().find('div:eq(1)').hide();" src="images/light-green.png" border="0" />
			<?php
				} else {
					if ($db->f(score) < 31) {
			?>
			<img onmouseover="$(this).parent().find('div:eq(1)').show();" onmouseout="$(this).parent().find('div:eq(1)').hide();" src="images/flash-red.gif" border="0" />
			<?php
					}
					if ($db->f(score) > 30 and $db->f(score) < 70) {
			?>
			<img onmouseover="$(this).parent().find('div:eq(1)').show();" onmouseout="$(this).parent().find('div:eq(1)').hide();" src="images/flash-yellow.gif" border="0" />
			<?php
					}
					if ($db->f(score) > 70) {
			?>
			<img onmouseover="$(this).parent().find('div:eq(1)').show();" onmouseout="$(this).parent().find('div:eq(1)').hide();" src="images/flash-green.gif" border="0" />
			<?php
					}
				}
			?>
			&nbsp;
			<span style="color:#0CF; font-weight:bold">
				ID : <?=$db->f(product_id)?>
			</span>
		</td>
	</tr>
	<tr>
		<td height="25">
			<div style="width:133px; height:67px; overflow:hidden;">
				<div style="width:153px; height:65px; overflow-y:scroll; overflow-x:hidden;">
					<table width="129">
						<tr>
							<td>
								<a href="shop_product.php?product_id=<?=$db->f(product_id)?>"  title="<?=$db->f(name)?>" >
									<span style="color:#FFF">
										<?=$db->f(name)?>
									</span>
								</a>
							</td>
						</tr>
					</table>
				</div>
			</div>
		</td>
	</tr>
</table>
</td>
</tr>
	<tr>
		<td height="25" align="center" bgcolor="#333333">
			<table width="100%" cellpadding="0" cellspacing="0">
				<tr>
					<td width="63%" align="center">
						<span style="color:#FFF">
							<?php
								if($db->f(status) == 1){
							?>
							<span style="color:#09F">
								พระโชว์ / 展示
							</span>
							<?php
								}
								if($db->f(status) == 2){
							?>
							<span style="color:#090">
								ให้เช่า / 出售
							</span>
							<?php
								}
								if($db->f(status) == 3){
							?>
							<span style="color:#FF0">
								เปิดจอง / 预定
							</span>
							<?php
								}
								if($db->f(status) == 4){
							?>
							<span style="color:#FC0">
								จองแล้ว / 已定
							</span>
							<?php
								}
								if($db->f(status) == 5){
							?>
							<span style="color:#F00">
								ขายแล้ว / 已出售
							</span>
							<?php
								}
							?>
						</span>
					</td>
					<td width="37%">
						<table width="100%" border="0" cellspacing="0" cellpadding="3">
							<tr>
								<td width="20">
									<img src="images/view-icon.png" width="20" height="11" />
								</td>
								<td>
									<span style="color:#FFF">
										<?=$db->f(view_num)?>
									</span>
								</td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
		</td>
	</tr>
</table>			  <?php } ?> 
            </td>
	      </tr>
		  <tr>
           <td height="30" colspan="10" align="center"> <?php  sh_page($total,$s_page,$e_page,$chk_page,Previous,Next,"#333333","#F8F8F8"); // นำไปวางในตำแหน่งที่ต้องการแสดง ?></td>
	      </tr>                  
	    </table></td>
	</tr>                     
  <tr>
	  <td><img src="images/footer.jpg" width="1000" height="136"></td>
  </tr>
</table>
<!-- End Save for Web Slices --><script type="text/javascript">
swfobject.registerObject("FlashID", "9.0.0", "expressInstall.swf");
</script>
</body>
</html>
