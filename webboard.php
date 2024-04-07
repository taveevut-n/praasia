<?php include("global.php"); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>คลินิคตี๋ซ่อมพระ บริการซ่อมพระ พระเครื่อง</title>
<style type="text/css">
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
	background-color: #000;
	background-image: url(images/bg.jpg);
	background-attachment:fixed;
	background-position:top center;
}
</style>
<script src="Scripts/swfobject.js" type="text/javascript"></script>
</head>

<body>
<table width="1000" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td><object id="FlashID" classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" width="1000" height="358">
      <param name="movie" value="images/tee.swf" />
      <param name="quality" value="high" />
      <param name="wmode" value="opaque" />
      <param name="swfversion" value="8.0.35.0" />
      <!-- This param tag prompts users with Flash Player 6.0 r65 and higher to download the latest version of Flash Player. Delete it if you don’t want users to see the prompt. -->
      <param name="expressinstall" value="Scripts/expressInstall.swf" />
      <!-- Next object tag is for non-IE browsers. So hide it from IE using IECC. -->
      <!--[if !IE]>-->
      <object type="application/x-shockwave-flash" data="images/tee.swf" width="1000" height="358">
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
    </object></td>
  </tr>
  <tr>
    <td><img src="images/menu.jpg" width="1000" height="48" border="0" usemap="#Map" /></td>
  </tr>
  <tr>
<td align="left" valign="top" bgcolor="#000000"><table width="1000" border="0" align="center" cellpadding="0" cellspacing="0">
                  <tr>
                    <td>
 <style type="text/css">   
.browse_page{   
    clear:both;   
    margin-left:12px;   
    height:35px;   
    margin-top:5px;   
    display:block;   
}   
.browse_page a,.browse_page a:hover{   
    display:block;   
    height:18px;   
    width:18px;   
    font-size:10px;   
    float:left;   
    margin-right:2px;   
    border:1px solid #CCCCCC;   
    background-color:#F4F4F4;   
    color:#333333;   
	text-indent:0;
    text-align:center;   
    line-height:18px;   
    font-weight:bold;   
    text-decoration:none;   
}   
.browse_page a:hover{   
    border:1px solid #000000;   
    background-color:#000000;   
    color:#FFFFFF;   
}   
.browse_page a.selectPage{   
    display:block;   
    height:18px;   
    width:18px;   
    font-size:10px;   
    float:left;   
    margin-right:2px;   
    border:1px solid #000000;   
    background-color:#000000;   
    color:#FFFFFF;   
    text-align:center;   
    line-height:18px;   
    font-weight:bold;   
}   
.browse_page a.SpaceC{   
    display:block;   
    height:18px;   
    width:18px;   
    font-size:10px;   
    float:left;   
    margin-right:2px;   
    border:0px dotted #000000;   
    font-size:11px;   
    background-color:#FFFFFF;   
    color:#333333;   
    text-align:center;   
    line-height:18px;   
    font-weight:bold;   
}   
.browse_page a.naviPN{   
    width:50px;   
    font-size:12px;   
    display:block;   
    height:18px;   
    float:left;   
    border:1px solid #000000;   
    background-color:#000000;   
    color:#FFFFFF;   
    text-align:center;   
	text-indent:0;
    line-height:18px;   
    font-weight:bold;      
}   
.browse_page a.naviPN:hover{   
    width:50px;   
    font-size:12px;   
    display:block;   
    height:18px;   
    float:left;   
    border:1px solid #000000;   
    background-color:#000000;   
    color:#FFFFFF;   
    text-align:center;   
    line-height:18px;   
    font-weight:bold;      
}   
</style>         
<?php      
if(isset($_GET['show_catID']) && $_GET['show_catID']!=0){
	$urlquery_str="&show_catID=".$_GET['show_catID'];
}
// สร้างฟังก์ชั่น สำหรับแสดงการแบ่งหน้า      
function page_navigator($before_p,$plus_p,$total,$total_p,$chk_page){      
    global $urlquery_str;   
    $pPrev=$chk_page-1;   
    $pPrev=($pPrev>=0)?$pPrev:0;   
    $pNext=$chk_page+1;   
    $pNext=($pNext>=$total_p)?$total_p-1:$pNext;        
    $lt_page=$total_p-4;   
    if($chk_page>0){     
        echo "<a  href='?s_page=$pPrev&urlquery_str=".$urlquery_str."' class='naviPN'>Prev</a>";   
    }   
    if($total_p>=11){   
        if($chk_page>=4){   
            echo "<a $nClass href='?s_page=0&urlquery_str=".$urlquery_str."'>1</a><a class='SpaceC'>. . .</a>";      
        }   
        if($chk_page<4){   
            for($i=0;$i<$total_p;$i++){     
                $nClass=($chk_page==$i)?"class='selectPage'":"";   
                if($i<=4){   
                echo "<a $nClass href='?s_page=$i&urlquery_str=".$urlquery_str."'>".intval($i+1)."</a> ";      
                }   
                if($i==$total_p-1 ){    
                echo "<a class='SpaceC'>. . .</a><a $nClass href='?s_page=$i&urlquery_str=".$urlquery_str."'>".intval($i+1)."</a> ";      
                }          
            }   
        }   
        if($chk_page>=4 && $chk_page<$lt_page){   
            $st_page=$chk_page-3;   
            for($i=1;$i<=5;$i++){   
                $nClass=($chk_page==($st_page+$i))?"class='selectPage'":"";   
                echo "<a $nClass href='?s_page=".intval($st_page+$i)."'>".intval($st_page+$i+1)."</a> ";       
            }   
            for($i=0;$i<$total_p;$i++){     
                if($i==$total_p-1 ){    
                $nClass=($chk_page==$i)?"class='selectPage'":"";   
                echo "<a class='SpaceC'>. . .</a><a $nClass href='?s_page=$i&urlquery_str=".$urlquery_str."'>".intval($i+1)."</a> ";      
                }          
            }                                      
        }      
        if($chk_page>=$lt_page){   
            for($i=0;$i<=4;$i++){   
                $nClass=($chk_page==($lt_page+$i-1))?"class='selectPage'":"";   
                echo "<a $nClass href='?s_page=".intval($lt_page+$i-1)."'>".intval($lt_page+$i)."</a> ";      
            }   
        }           
    }else{   
        for($i=0;$i<$total_p;$i++){     
            $nClass=($chk_page==$i)?"class='selectPage'":"";   
            echo "<a href='?s_page=$i&urlquery_str=".$urlquery_str."' $nClass  >".intval($i+1)."</a> ";      
        }          
    }      
    if($chk_page<$total_p-1){   
        echo "<a href='?s_page=$pNext&urlquery_str=".$urlquery_str."'  class='naviPN'>Next</a>";   
    }   
}      
?>   
        <script language="JavaScript" type="text/javascript">
        	function sh_id(obj){
				var obj_a=document.getElementById(obj);
				if(obj_a.style.display=='none'){
					obj_a.style.display='block';					
				}else{
					obj_a.style.display='none';
				}
			}
        </script>  				  
				  <table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
                    <tr>
                      <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td>
						
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
                            <tr>
                              <td>
        <script language="JavaScript" type="text/javascript">
      	function fl(){
			return false;
		}
      </script>        
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="1">
        <tr>
          <td colspan="5"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="35%"><img src="/images/post.gif" width="24" height="24" align="absmiddle" /><a href="webboard_add.php"><span style="color:#FFF; font-size:12px">ตั้งหัวข้อใหม่</span></a></td>
                <td width="65%" align="right">&nbsp; </td>
              </tr>
            </table></td>
          </tr>
        <tr>
          <td width="8%" height="30" align="center" bgcolor="#FFCC00" class="hd_topic2">#</td>
          <td width="45%" align="center" bgcolor="#FFCC00" class="hd_topic2">หัวข้อ</td>
          <td width="16%" align="center" bgcolor="#FFCC00" class="hd_topic2">โดย</td>
          <td width="13%" align="center" bgcolor="#FFCC00" class="hd_topic2">ตอบล่าสุด</td>
          <td width="10%" align="center" bgcolor="#FFCC00" class="hd_topic2">จำนวนผู้เข้าชม</td>
        </tr>                             
        <?php
	  $q="SELECT * FROM `webboard_que` WHERE 1   ";
	  if(isset($_GET['show_catID']) && $_GET['show_catID']!=0){
	   		$q.=" AND catID=".$_GET['show_catID']."";
	  }
	  if($_POST['keysearch']=='1'){ //search จาก ชื่อกระทู้
			$q.=" AND title_que like '%".$_POST['keyword']."%' ";
	  }elseif($_POST['keysearch']=='2'){ //search จาก ชื่อผู้ตั้งกระทุ้
			$q.="  AND name_que like '%".$_POST['keyword']."%'";
	  }
	  $q.="  ORDER BY stick DESC,id_que DESC  ";
	  $db->query($q);    
	  $v=1;
	  $total=$db->num_rows();
	  while($db->next_record()){
	  	    $st="";
	  $st1="";
	  if($db->f(cat_que)>=$day){
	  	$st="new";
	  }
	 if($db->f(vote_que)>=$day){
	  	$st1="update";
	  }
	  ?>
      <?php
	  $bgBoard=($v%2==1)?"#FAFAFA":"#EAEAEA";
	  ?>
        <tr bgcolor="<?=($db->f(stick)==1)?"#FFFFCC":$bgBoard?>">
          <td align="center" ><?=($db->f(stick)==1)?"ปักหมุด":($chk_page*$e_page)+$v?></td>
          <td><a href="webboard2.php?id_que=<?=$db->f(id_que)?>"><?=$db->f(title_que)?>
            </a>
			<? if($st=='new'){?>
				<img src="images/webboard/new.gif" alt=""  border="0" align="absmiddle" />
			<? }
			if($st1=='update'){ ?>
				<img src="images/webboard/update.gif" alt=""  border="0" align="absmiddle" />
			<? } ?>            </td>
          <td align="center"><a href="mailto:<?=$db->f(email_que)?>"><?=$db->f(name_que)?></a>
            <br />
            <span id="show_time"> <?=date("d-m-Y H:i:s",$db->f(date_que))?></span>		</td>
          <td align="center" style="font-size:10px;"><?
		  $q="SELECT * FROM `webboard_ans` WHERE id_que='".$db->f(id_que)."' order by id_ans DESC";
		  $db5=new nDB();
		  $db5->query($q);
		  $db5->next_record();
		  if($db5->num_rows()>0){
		  echo date("d-m-Y",$db5->f(date_ans));
		  }else{
		  echo "-";
		  }
		  ?></td>
          <td align="center"><?=$db->f(read_que)?></td>
        </tr>
        <?php
		$v++; 
/*		if($db->f(stick)!=1){
		 $v++; 
		 }*/
		 } ?>
		<tr>
		<td colspan="5" align="left">
<?php if($total>0){ ?>   
<div class="browse_page" style="clear:both;float:left;margin-top:10px;">   
 <?php      
 // เรียกใช้งานฟังก์ชั่น สำหรับแสดงการแบ่งหน้า      
  page_navigator($before_p,$plus_p,$total,$total_p,$chk_page);       
  ?>    
</div>   
<?php }else{ ?>      
<p align="center" style="color:#FF0000;">ไม่มีรายการกระทู้ </p>
<?php } ?>
  </td>
		</tr>
        </table>
<br />							  </td>
                            </tr>
</table>

								</td>
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
                  </table>
                  </td>
                  </tr>
    </table></td>
  </tr>
  <tr>
    <td bgcolor="#000000">&nbsp;</td>
  </tr>
  <tr>
    <td bgcolor="#000000">&nbsp;</td>
  </tr>
  <tr>
    <td bgcolor="#000000">&nbsp;</td>
  </tr>
</table>

<map name="Map" id="Map"><area shape="rect" coords="789,8,962,40" href="contactus.php" /><area shape="rect" coords="587,9,760,41" href="payment.php" /><area shape="rect" coords="386,9,559,41" href="order.php" /><area shape="rect" coords="196,9,369,41" href="about.php" />
  <area shape="rect" coords="16,9,189,41" href="index.php" />
</map>
<script type="text/javascript">
swfobject.registerObject("FlashID", "9.0.0", "expressInstall.swf");
</script>
</body>
</html>
