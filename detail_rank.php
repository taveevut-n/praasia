<?php include("global.php"); 
include("global_counter.php");
?>
<?php set_page($s_page,$e_page=80); //นำส่วนนี้ิไว้ด้านบน ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>ศูนย์รวมพระเครื่องออนไลน์</title>
<META name=description content="ศนย์พระเครื่อง เปิดร้านพระออนไลน์" >
<meta name="keywords" content="ศูนย์พระเครื่องภาคใต้, ศูนย์พระเครื่องภาคเหนือ, ศูนย์พระเครื่องกรุงเทพ, ศูนย์พระเครื่องอีสาน"/>
<link rel="icon" href="/favicon.ico" type="image/x-icon" />
<?php include("index.css"); ?>
    <!--jquery ui Local-->
    <link rel="stylesheet" href="func/jquery-ui-1.10.3/themes/base/jquery-ui.css" />
    <script src="func/jquery-ui-1.10.3/jquery-1.9.1.js"></script>
    <script src="func/jquery-ui-1.10.3/ui/jquery-ui.js"></script>
    <script src="func/jquery-ui-1.10.3/jquery.transit.min.js"></script>
</head>

<body>
<table width="1000" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td><? include('head.php') ?></td>
  </tr>
	<tr>
		<td>
		<table width="100%" border="0" cellspacing="0" cellpadding="0">	
          <tr>
		    <td style="background:url(images/bg.jpg) repeat-y; ">
			  <table width="100%" cellpadding="0" cellspacing="0">
              	<tr>
                    <td width="1000" valign="top">
			  <table cellpadding="0" cellspacing="0" width="100%">
              <tr>
              	<td height="30" align="center" bgcolor="#4d1403" style="color:#FC0">
                คะแนน 分数</td>
              </tr>
                                        <?php 
									$q="SELECT * FROM `rank` WHERE 1 ";
									$dbnews= new nDB();
									$dbnews->query($q);
									$dbnews->next_record();
								  ?>
                          <tr bgcolor="#EFEFEF" style="padding:5px">
                            <td style="padding:5px"><?=$dbnews->f(detail)?></td>
                          </tr>
              <tr>
              	<td bgcolor="#EFEFEF" style="padding:5px">
                <table width="600" border="1" bordercolor="#000000" style="border-collapse:collapse" align="center" cellpadding="3" cellspacing="0">
              	  <tr>
                  </tr>
                  	<td colspan="2" align="center" style="font-weight:bold">ตารางคะแนนความน่าเชื่อถือร้านค้า 信用与服务态度分数表</td>
                  <tr>
              	    <td width="260">4-10 คะแนน 分</td>
              	    <td width="328"><img src="images/gif/heart.gif" alt="" width="20" height="16" /></td>
            	    </tr>
              	  <tr>
              	    <td>11-40 คะแนน 分</td>
              	    <td><img src="images/gif/heart.gif" alt="" width="20" height="16" /> <img src="images/gif/heart.gif" alt="" width="20" height="16" /></td>
            	    </tr>
              	  <tr>
              	    <td>41-90 คะแนน 分</td>
              	    <td><img src="images/gif/heart.gif" alt="" width="20" height="16" /> <img src="images/gif/heart.gif" alt="" width="20" height="16" /> <img src="images/gif/heart.gif" alt="" width="20" height="16" /></td>
            	    </tr>
              	  <tr>
              	    <td>91-150 คะแนน 分</td>
              	    <td><img src="images/gif/heart.gif" alt="" width="20" height="16" /> <img src="images/gif/heart.gif" alt="" width="20" height="16" /> <img src="images/gif/heart.gif" alt="" width="20" height="16" /> <img src="images/gif/heart.gif" alt="" width="20" height="16" /></td>
            	    </tr>
              	  <tr>
              	    <td>151-250 คะแนน 分</td>
              	    <td><img src="images/gif/heart.gif" alt="" width="20" height="16" /> <img src="images/gif/heart.gif" alt="" width="20" height="16" /> <img src="images/gif/heart.gif" alt="" width="20" height="16" /> <img src="images/gif/heart.gif" alt="" width="20" height="16" /> <img src="images/gif/heart.gif" alt="" width="20" height="16" /></td>
            	    </tr>
              	  <tr>
              	    <td> 251-500 คะแนน 分</td>
              	    <td><img src="images/gif/dimon.gif" alt="" width="20" height="16" /></td>
            	    </tr>
              	  <tr>
              	    <td>501-1000 คะแนน 分</td>
              	    <td><img src="images/gif/dimon.gif" alt="" width="20" height="16" /> <img src="images/gif/dimon.gif" alt="" width="20" height="16" /></td>
            	    </tr>
              	  <tr>
              	    <td>1001-2000 คะแนน 分</td>
              	    <td><img src="images/gif/dimon.gif" alt="" width="20" height="16" /> <img src="images/gif/dimon.gif" alt="" width="20" height="16" /> <img src="images/gif/dimon.gif" alt="" width="20" height="16" /></td>
            	    </tr>
              	  <tr>
              	    <td>2001-5000 คะแนน 分</td>
              	    <td><img src="images/gif/dimon.gif" alt="" width="20" height="16" /> <img src="images/gif/dimon.gif" alt="" width="20" height="16" /> <img src="images/gif/dimon.gif" alt="" width="20" height="16" /> <img src="images/gif/dimon.gif" alt="" width="20" height="16" /></td>
            	    </tr>
              	  <tr>
              	    <td>5001-10000 คะแนน 分</td>
              	    <td><img src="images/gif/dimon.gif" alt="" width="20" height="16" /> <img src="images/gif/dimon.gif" alt="" width="20" height="16" /> <img src="images/gif/dimon.gif" alt="" width="20" height="16" /> <img src="images/gif/dimon.gif" alt="" width="20" height="16" /> <img src="images/gif/dimon.gif" alt="" width="20" height="16" /></td>
            	    </tr>
              	  <tr>
              	    <td>10001-20000 คะแนน 分</td>
              	    <td><img src="images/rank-redcrown.gif" width="20" height="16" /></td>
            	    </tr>
              	  <tr>
              	    <td>20001-50000 คะแนน 分</td>
              	    <td><img src="images/rank-redcrown.gif" alt="" width="20" height="16" /> <img src="images/rank-redcrown.gif" alt="" width="20" height="16" /></td>
            	    </tr>
              	  <tr>
              	    <td>50001-100000 คะแนน 分</td>
              	    <td><img src="images/rank-redcrown.gif" alt="" width="20" height="16" /> <img src="images/rank-redcrown.gif" alt="" width="20" height="16" /> <img src="images/rank-redcrown.gif" alt="" width="20" height="16" /></td>
            	    </tr>
              	  <tr>
              	    <td>100001-200000 คะแนน 分</td>
              	    <td><img src="images/rank-redcrown.gif" alt="" width="20" height="16" /> <img src="images/rank-redcrown.gif" alt="" width="20" height="16" /> <img src="images/rank-redcrown.gif" alt="" width="20" height="16" /> <img src="images/rank-redcrown.gif" alt="" width="20" height="16" /></td>
            	    </tr>
              	  <tr>
              	    <td>200001-500000 คะแนน 分</td>
              	    <td><img src="images/rank-redcrown.gif" alt="" width="20" height="16" /> <img src="images/rank-redcrown.gif" alt="" width="20" height="16" /> <img src="images/rank-redcrown.gif" alt="" width="20" height="16" /> <img src="images/rank-redcrown.gif" alt="" width="20" height="16" /> <img src="images/rank-redcrown.gif" alt="" width="20" height="16" /></td>
            	    </tr>
              	  <tr>
              	    <td>500001-1000000 คะแนน 分</td>
              	    <td><img src="images/gif/crown.gif" width="20" height="16" /></td>
            	    </tr>
              	  <tr>
              	    <td>1000001-2000000 คะแนน 分</td>
              	    <td><img src="images/gif/crown.gif" alt="" width="20" height="16" /> <img src="images/gif/crown.gif" alt="" width="20" height="16" /></td>
            	    </tr>
              	  <tr>
              	    <td>2000001-5000000 คะแนน 分</td>
              	    <td><img src="images/gif/crown.gif" alt="" width="20" height="16" /> <img src="images/gif/crown.gif" alt="" width="20" height="16" /> <img src="images/gif/crown.gif" alt="" width="20" height="16" /></td>
            	    </tr>
              	  <tr>
              	    <td>5000001-10000000 คะแนน 分</td>
              	    <td><img src="images/gif/crown.gif" alt="" width="20" height="16" /> <img src="images/gif/crown.gif" alt="" width="20" height="16" /> <img src="images/gif/crown.gif" alt="" width="20" height="16" /> <img src="images/gif/crown.gif" alt="" width="20" height="16" /></td>
            	    </tr>
              	  <tr>
              	    <td>10000001 คะแนนขึ้นไป 分以上</td>
              	    <td><img src="images/gif/crown.gif" alt="" width="20" height="16" /> <img src="images/gif/crown.gif" alt="" width="20" height="16" /> <img src="images/gif/crown.gif" alt="" width="20" height="16" /> <img src="images/gif/crown.gif" alt="" width="20" height="16" /> <img src="images/gif/crown.gif" alt="" width="20" height="16" /></td>
            	    </tr>
            	  </table>
                
                </td>
              </tr>
            </table>
            </td>
                </tr>
              </table>
            </td>
	      </tr>               
	    </table>
        </td>
	</tr>
	<tr>
	  <td>
      <? include('footer.php');?>
    </td>
  </tr>   
</table>
</body>
</html>
