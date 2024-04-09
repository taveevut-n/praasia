<? include('global.php') ?>
<? 	$q="SELECT * FROM `jew_product` WHERE id = '".$_GET['id']."' ORDER BY id DESC LIMIT 0,20 ";
$dbproduct= new nDB();
$dbproduct->query($q);
$dbproduct->next_record() ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?=$dbproduct->f(name)?></title>
<META name=description content="บริการรับทำแหวนทอง แหวนเพชร แหวนฝังพลอย อัญมณี ทุกรูปแบบ ด้วยทีมงานมืออาชีพ ประสบการณ์กว่า 40 ปี" >
<META name=keywords content="ทำทอง,กรอบพระทอง,แหวนทอง, แหวนเพชร, แหวนอัญมณี, Jewelry," >
<!-- load jQuery -->
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.js"></script>

<!-- load Galleria -->
<script src="galleria/galleria-1.2.9.min.js"></script>
<style type="text/css">
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
	background-color: #dddddd;
	font-size:12px;	
}
	/* Demo styles */
	html,body{;margin:0;}
	body{border-top:4px solid #000;}
	.content{color:#777;font:12px/1.4 "helvetica neue",arial,sans-serif;width:500px; background-color:#000}
	h1{font-size:12px;font-weight:normal;color:#ddd;margin:0;}
	a {color:#22BCB9;text-decoration:none;}
	.cred{font-size:11px;}

	/* This rule is read by Galleria to define the gallery height: */
	#galleria{height:355px}
</style>
</head>

<body>
<table width="1000" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td><table width="1000" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><img src="head.jpg" width="1000" height="286"></td>
  </tr>
</table>
</td>
  </tr>
  <tr>
  	<td style="background:url(bg-chap.jpg) no-repeat" height="50"><table width="900" border="0" align="center" cellpadding="5" cellspacing="0">
  	  <tr>
  	    <td align="center"><a href="../index.php"><span style="color:#000">หน้าแรกร้านพระ / 首页佛牌店</span></a></td>
  	    <td align="center"><a href="index.php"><span style="color:#000">หน้าแรกจิวเวลรี่ / 首页MEILIANDJEWELRY</span></a></td>
  	    <td align="center"><a href="all_product.php?"><span style="color:#000">สินค้าทั้งหมด / 总共商品</span></a></td>
  	    <td align="center"><a href="contact.php"><span style="color:#000">ติดต่อเรา / 联系我们</span></a></td>
	    </tr>
    </table></td>
  </tr>
  <tr>
  	<td style="background:url(images/bg-product.jpg) no-repeat">
    	<table width="100%" cellpadding="0" cellspacing="0">
        	<tr>
            	<td width="10" height="300" valign="top" style="padding-top:50px">
                <table width="950" border="0" align="center" cellpadding="5" cellspacing="0">
                	<tr>
                    	<td align="center" bgcolor="#666666">
                        <span style="color:#CCC"><?=$dbproduct->f(name)?></span>
                        </td>
                    </tr>
                	<tr>
                	  <td><span style="color:#666666C"><?=$dbproduct->f(detail)?></span></td>
              	  </tr>
                  <tr>
                  	<td>
                    <table width="100%" border="0" cellspacing="0" cellpadding="5">
                      <tr>
                        <td align="center"><img src="<?=($dbproduct->f(pic1)!="")?"/slir/w900/jewelry/upimg/product/".$dbproduct->f(pic1):"images/clear.gif"?>" alt="<?=$dbproduct->f(name)?>" /></td>
                      </tr>
                      <tr>
                        <td align="center"><img src="<?=($dbproduct->f(pic2)!="")?"/slir/w900/jewelry/upimg/product/".$dbproduct->f(pic2):"images/clear.gif"?>" alt="<?=$dbproduct->f(name)?>" /></td>
                      </tr>
                      <tr>
                        <td align="center"><img src="<?=($dbproduct->f(pic3)!="")?"/slir/w900/jewelry/upimg/product/".$dbproduct->f(pic3):"images/clear.gif"?>" alt="<?=$dbproduct->f(name)?>" /></td>
                      </tr>
                      <tr>
                        <td align="center"><img src="<?=($dbproduct->f(pic4)!="")?"/slir/w900/jewelry/upimg/product/".$dbproduct->f(pic4):"images/clear.gif"?>" alt="<?=$dbproduct->f(name)?>" /></td>
                      </tr>
                    </table>
                    </td>
                  </tr>
                </table></td>
            </tr>
        </table>
    </td>
  </tr>
  <tr>
  <td bgcolor="#141111">
  <table width="900" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td>
		<? 	$q="SELECT * FROM `jew_product` WHERE status = '1' ORDER BY RAND() DESC LIMIT 0,20 ";
        $dbhot= new nDB();
        $dbhot->query($q);
        while ($dbhot->next_record()) { ?>        
        <table width="160" border="0" cellspacing="0" cellpadding="0" style="float:left; margin:10px">
          <tr>
            <td height="120" align="center" bgcolor="#333333" style="border:1px solid #666"><a href="detail_product.php?id=<?=$dbhot->f(id)?>"><img src="<?=($dbhot->f(pic1)!="")?'/slir/w150-h120/jewelry/upimg/product/'.$dbhot->f(pic1):"images/clear.gif"?>" alt=""  border="0" /></a></td>
          </tr>
        </table>
		<?php } ?>        
        </td>
      </tr>
    </table>
  </td>
  </tr>
  <tr>
  	<td><img src="images/footer.jpg" width="1000" height="114" />
    
    </td>
  </tr>
</table>
</body>
</html>