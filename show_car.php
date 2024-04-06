<? include('head.php'); ?>
<body>
<!-- load jQuery -->
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.js"></script>
<!-- load Galleria -->
<script src="galleria/galleria-1.2.9.min.js"></script>
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
<?php
 	if ($_GET['car_id']) {
	$_SESSION['car_id']=$_GET['car_id'];
	}
	$q="SELECT * FROM `car` WHERE car_id= '".$_SESSION['car_id']."' ";
	$dbcar= new nDB();	
	$dbcar->query($q);
	$dbcar->next_record();
	$topic = $dbcar->f(topic);	
	
	$q="SELECT * FROM `member` WHERE mem_id= '".$dbcar->f(mem_id)."' ";
	$dbmember= new nDB();	
	$dbmember->query($q);
	$dbmember->next_record();
	$name = $dbmember->f(name);
	$surname = $dbmember->f(surname);
	$email = $dbmember->f(email);
	$address = $dbmember->f(address);	
	$province = $dbmember->f(province);		
	$tel = $dbmember->f(tel);
	$active = $dbmember->f(active);	
	$date_regis = date("Y-m-d H:i:s");	
?>  
<div id="header">
  <table width="980" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
      <td><? include('topmenu.php'); ?></td>
    </tr>
  </table>

</div>
<table width="100%" cellpadding="0" cellspacing="0"  style="height:60px; background:url(images/bg_search_page.jpg) no-repeat center; border-bottom:2px #F00 solid;">
	<tr>
    <td>
      <table width="900" border="0" align="center" cellpadding="0" cellspacing="0"  >
        <tr>
          	<td>
            
            	<table width="100%" border="0" cellspacing="0" cellpadding="3">
                  <tr>
                    <td>
                    	<select class="select_search1">
                        	<option>
                            	 รถทุกประเภท
                            </option>
                        </select>
                    	<select class="select_search2">
                        	<option>
                            	 ทุกยี่ห้อ
                          </option>
                      </select>
                    	<select class="select_search2">
                        	<option>
                            	 ทุกรุ่น
                            </option>
                        </select>
                    	<select class="select_search2">
                        	<option>
                            	 ทุกโฉม
                            </option>
                        </select>
                    	<select class="select_search2">
                        	<option>
                            	 ทุกปี
                            </option>
                        </select>
                    	<select class="select_search2">
                        	<option>
                            	 ทุกราคา
                            </option>
                        </select>  
                        <input type="submit" value="ค้นหา" class="but_searchbox" />                                                                                                                      
                    </td>
                  </tr>
                </table>
          	</td>
        </tr>
      </table>
	</td>
    </tr>
</table>
<div id="content">
<table width="980" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="1">
      <tr>
        <td>
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="210" valign="top" style="font-size:12px">&nbsp;</td>
            <td width="768" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td height="40" style="color:#e4262d; font-size:18px"><?=$topic?></td>
              </tr>
              <tr>
                <td height="383" bgcolor="#000000">
                <div class="content">
                <div id="galleria">
                    <?php
                        $q = "SELECT * FROM `car` WHERE car_id = '".$dbcar->f(car_id)."' ";
                        $dbimg = new nDB();
                        $dbimg->query($q);							
                        while ($dbimg->next_record()) {
                        if($dbimg->f(pic1)!=''){
                    ?>
                    <a href="img/car/<?=$dbimg->f(pic1)?>">
                        <img src="/resize/w45-h40/img/car/<?=$dbimg->f(pic1)?>",data-big="/resize/w710-h320/img/car/<?=$dbimg->f(pic2)?>"/>
                    </a>
                    <?php
                        }
                        if($dbimg->f(pic2)!=''){
                    ?>
                    <a href="img/car/<?=$dbimg->f(pic2)?>">
                        <img src="/resize/w45-h40/img/car/<?=$dbimg->f(pic2)?>",data-big="/resize/w298-h285/img/car/<?=$dbimg->f(pic2)?>"/>
                    </a>
                    <?php
                        }
                        if($dbimg->f(pic3)!=''){
                    ?>
                    <a href="img/car/<?=$dbimg->f(pic3)?>">
                        <img src="/resize/w45-h40/img/car/<?=$dbimg->f(pic3)?>",data-big="/resize/w298-h285/img/car/<?=$dbimg->f(pic3)?>" data-link="shop_product.php?product_id=<?=$dbimg->f(product_id)?>"/>
                    </a>    
                    <?php
                        }
                        if($dbimg->f(pic4)!=''){
                    ?>
                    <a href="img/car/<?=$dbimg->f(pic4)?>">
                        <img src="/resize/w45-h40/img/car/<?=$dbimg->f(pic4)?>",data-big="/resize/w298-h285/img/car/<?=$dbimg->f(pic4)?>" data-link="shop_product.php?product_id=<?=$dbimg->f(product_id)?>"/>
                    </a>
                    <?php
						}
						if($dbimg->f(pic5)!=''){
					?>
                    <a href="img/car/<?=$dbimg->f(pic5)?>">
                        <img src="/resize/w45-h40/img/car/<?=$dbimg->f(pic5)?>",data-big="/resize/w298-h285/img/car/<?=$dbimg->f(pic5)?>" data-link="shop_product.php?product_id=<?=$dbimg->f(product_id)?>"/>
                    </a>                    
                    <?php
						}
						if($dbimg->f(pic6)!=''){
					?>
                    <a href="img/car/<?=$dbimg->f(pic6)?>">
                        <img src="/resize/w45-h40/img/car/<?=$dbimg->f(pic6)?>",data-big="/resize/w298-h285/img/car/<?=$dbimg->f(pic6)?>" data-link="shop_product.php?product_id=<?=$dbimg->f(product_id)?>"/>
                    </a>                    
                    <?php
						}
						if($dbimg->f(pic7)!=''){
					?>
                    <a href="img/car/<?=$dbimg->f(pic7)?>">
                        <img src="/resize/w45-h40/img/car/<?=$dbimg->f(pic7)?>",data-big="/resize/w298-h285/img/car/<?=$dbimg->f(pic7)?>" data-link="shop_product.php?product_id=<?=$dbimg->f(product_id)?>"/>
                    </a>                    
                    <?php
						}
						if($dbimg->f(pic8)!=''){
					?>
                    <a href="img/car/<?=$dbimg->f(pic8)?>">
                        <img src="/resize/w45-h40/img/car/<?=$dbimg->f(pic8)?>",data-big="/resize/w298-h285/img/car/<?=$dbimg->f(pic8)?>" data-link="shop_product.php?product_id=<?=$dbimg->f(product_id)?>"/>
                    </a>                    
                    <?php
						}
						if($dbimg->f(pic9)!=''){
					?>
                    <a href="img/car/<?=$dbimg->f(pic9)?>">
                        <img src="/resize/w45-h40/img/car/<?=$dbimg->f(pic9)?>",data-big="/resize/w298-h285/img/car/<?=$dbimg->f(pic9)?>" data-link="shop_product.php?product_id=<?=$dbimg->f(product_id)?>"/>
                    </a>                    
                    <?php
						}
						if($dbimg->f(pic10)!=''){
					?>
                    <a href="img/car/<?=$dbimg->f(pic4)?>">
                        <img src="/resize/w45-h40/img/car/<?=$dbimg->f(pic10)?>",data-big="/resize/w298-h285/img/car/<?=$dbimg->f(pic10)?>" data-link="shop_product.php?product_id=<?=$dbimg->f(product_id)?>"/>
                    </a>                    
                    <?php
						}
						if($dbimg->f(pic11)!=''){
					?>
                    <a href="img/car/<?=$dbimg->f(pic11)?>">
                        <img src="/resize/w45-h40/img/car/<?=$dbimg->f(pic11)?>",data-big="/resize/w298-h285/img/car/<?=$dbimg->f(pic11)?>" data-link="shop_product.php?product_id=<?=$dbimg->f(product_id)?>"/>
                    </a>                    
                    <?php
						}
						if($dbimg->f(pic12)!=''){
					?>           
                    <a href="img/car/<?=$dbimg->f(pic12)?>">
                        <img src="/resize/w45-h40/img/car/<?=$dbimg->f(pic12)?>",data-big="/resize/w298-h285/img/car/<?=$dbimg->f(pic12)?>" data-link="shop_product.php?product_id=<?=$dbimg->f(product_id)?>"/>
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
                    autoplay: 3000
                });
            </script>
                </td>
              </tr>
              <tr>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td>&nbsp;</td>
              </tr>
            </table></td>
          </tr>
        </table>
        </td>
      </tr>
            <tr>
        <td height="30" valign="bottom" style="border-top:2px solid #F00"><table width="80%" border="0" align="center" cellpadding="3" cellspacing="0">
          <tr>
            <td>&nbsp;</td>
            </tr>          
        </table></td>
      </tr>
    </table></td>
  </tr>
</table>
</div>
<div id="footer">
	<div id="footwrap">
    d
    </div>
</div>
</body>
</html>
