<? include('../global.php')?>
<?php if($_SESSION['adminid']=='' || !isset($_SESSION['adminid'])) {  
        redi4("login.php");
	
		} 

		if($_GET['certificate_id']) {
			$_SESSION['content_certificate_id'] = $_GET['certificate_id'];
		}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>ระบบจัดการเว็บไซต์</title>
        <link rel="stylesheet" href="colorbox.css" />
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
		<script src="jquery.colorbox.js"></script>
		<script>
			$(document).ready(function(){
				//Examples of how to assign the Colorbox event to elements
				$(".group1").colorbox({rel:'group1'});
				$(".group2").colorbox({rel:'group2', transition:"fade"});
				$(".group3").colorbox({rel:'group3', transition:"none", width:"75%", height:"75%"});
				$(".group4").colorbox({rel:'group4', slideshow:true});
				$(".ajax").colorbox();
				$(".youtube").colorbox({iframe:true, innerWidth:640, innerHeight:390});
				$(".vimeo").colorbox({iframe:true, innerWidth:500, innerHeight:409});
				$(".iframe").colorbox({iframe:true, width:"90%", height:"90%"});
				$(".inline").colorbox({inline:true, width:"50%"});
				$(".callbacks").colorbox({
					onOpen:function(){ alert('onOpen: colorbox is about to open'); },
					onLoad:function(){ alert('onLoad: colorbox has started to load the targeted content'); },
					onComplete:function(){ alert('onComplete: colorbox has displayed the loaded content'); },
					onCleanup:function(){ alert('onCleanup: colorbox has begun the close process'); },
					onClosed:function(){ alert('onClosed: colorbox has completely closed'); }
				});

				$('.non-retina').colorbox({rel:'group5', transition:'none'})
				$('.retina').colorbox({rel:'group5', transition:'none', retinaImage:true, retinaUrl:true});
				
				//Example of preserving a JavaScript event for inline calls.
				$("#click").click(function(){ 
					$('#click').css({"background-color":"#f00", "color":"#fff", "cursor":"inherit"}).text("Open this window again and this message will still be here.");
					return false;
				});
			});
		</script>
        <script src="/ieditor/ckeditor.js"></script>
	<script src="/ckfinder/ckfinder.js"></script> 
<style type="text/css">
body {
	background-color: #000;
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;	
}
.bh{
	color:#FC0;
	font-size:14px;
	height:30px;
}
#cboxWrapper{
	position: fixed;
	left: 5%;
	top: 5%;
}
.sidemenu{
	color:#FFF;
	font-size:12px;
	height:25px;
	border-bottom:1px solid #000;
	text-decoration:none;
}
.sidemenu:hover{
	text-decoration:none;
}
a:link {
	text-decoration: none;
}
a:visited {
	text-decoration: none;
}
a:hover {
	text-decoration: none;
}
a:active {
	text-decoration: none;
}
</style>
</head>

<body>
<table width="1000" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td><img src="/admin/images/head.jpg" width="1098" height="288" /></td>
  </tr>
    					  <tr>
                          	<td align="right">
																		<script language="javASCript">
																			function selec(){
																				var ab=document.getElementById('se');
																				location.href=ab.value;
																			}
																		</script>
																		<span style="color:#ffffff;">เลือกรายการจัดการ :</span> 
																		<select name="select" onchange="selec();" id="se" style="height: 21px;">
																		  <option value="">--------กรุณาเลือกรายการ--------</option>
																			<option value="catalog_cert.php">หมวดหม่พระที่ออกบัตร</option>
                                                                            <option value="datacertificate.php">เพิ่มข้อมูลพระที่ออกบัตร</option>
																			<option value="checkcertificate.php">ข้อมูลพระที่ออกบัตร เพิ่มที่ปรึกษา</option>	
                                                                            <option value="admin_checklist_certificate.php">ดูรายการทั้งหมด</option>											
																	  </select>                            
                            </td>
                          </tr>  
  <tr>
    <td bgcolor="#311407">
			    <table width="100%" border="0" cellspacing="0" cellpadding="3">
                  <tr>
                    <td align="center" style="color:#FC0">ข้อมูลจาก Admin</td>
                  </tr>
                  <?
					$q="SELECT * FROM datacert WHERE datacert_id=".$_SESSION['content_certificate_id']." ";
					$db5=new nDB();
					$db5->query($q);
					$db5->next_record();                  
					?>
                  <tr>
                    <td style="color:#FFF"><?=$db5->f(datacert_detail)?></td>
                  </tr>
                  <tr>
                    <td>
                    <? 
						  	$q="SELECT * FROM `content_certificate` WHERE amulet_id LIKE '%".",".$_SESSION['content_certificate_id'].","."%' ORDER BY content_id DESC";
							$db->query($q);
							static $v=1;
							while($db->next_record()){	
							
						  	$q="SELECT * FROM `member` WHERE id = '".$db->f(mem_id)."' ";
							$member=new nDB();
							$member->query($q);
							$member->next_record();								
					?>
                        <table width="100%" border="0" cellspacing="0" cellpadding="3">
                          <tr>
                            <td height="30" bgcolor="#000000" style="color:#FFF">ผู้เขียน <a href="../shop_index.php?shop=<?=$member->f(id)?>" target="_blank" style="color:#FC0"><?=$member->f(username)?></a> : <?=$db->f(name)?></td>
                          </tr>
                          <tr>
                            <td style="color:#FFF"><?=$db->f(detail)?></td>
                          </tr>
                          <tr>
                            <td><table width="95%" border="0" align="center" cellpadding="3" cellspacing="0">
                              <tr>
                                <td align="center" style="color:#FC0">รูปพระเครื่องที่สะสม</td>
                              </tr>
                              <tr>
                                <td>
                                	<style type="text/css">
                                		.pre_thumb{
                                			float: left;
                                			width: 120px;
                                			height: 120px;
                                			margin-right:5px;
                                		}
                                		.tbl_table tr td {
                                			color: #FC0;
                                			border:1px solid #f5f5f5;
                                		}
                                		.td_table{
                                			padding:5px;
                                			text-align: center;
                                			vertical-align: top;
                                			background-color: #6B2C11;
                                		}
                                	</style>
                                	<?php
                                                  $c_pic = 0;
                                                  $q_pic = mysql_query("SELECT * FROM collection WHERE content_id = '".$db->f(content_id)."' ORDER BY collection_order ASC ");
                                                  $n_pic = mysql_num_rows($q_pic);
                                                    if($n_pic > 0){
                                                      while ($pic = mysql_fetch_array($q_pic)) {
                                                        $c_pic = $c_pic + 1;
                                                    ?>
                                                        <a href="view_pic_content.php?pic=<?=$pic['collection_img']?>&f=referee_collect" target="_blank">
                                                         <img class="pre_thumb" src="../img/referee_collect/<?=$pic['collection_img']?>">
                                                        </a>
                                                    <?php
                                                       }
                                                    }
                                                  ?>
                                </td>
                              </tr>
                            </table></td>
                          </tr>
                          <tr>
                            <td>
							<table width="95%" border="0" align="center" cellpadding="3" cellspacing="0">
                              <tr>
                                <td align="center" style="color:#FC0">ตัวอย่างพระแท้ที่ดูง่าย</td>
                              </tr>
                              <tr>
                                <td>
									<table cellpadding="0" cellspacing="0" width="100%" class="tbl_table">
										<tr>
											<td width="25%" bgcolor="#000" height="30" align="center">
												รูปด้านหน้า / 前面图片
											</td>
											<td width="25%" bgcolor="#000" align="center">
												รูปด้านหลัง / 后面图片
											</td>
											<td width="25%" bgcolor="#000" align="center">
												รูปขอบข้าง / 后面图片
											</td>
											<td width="25%" bgcolor="#000" align="center">
												อื่น ๆ / 其它
											</td>
										</tr>
										<tr>
											<td class="td_table">
												 <?php
						                            $limit = 0;
						                            $file_arr = array();
						                            $filename_arr = array();
						                            $sizefile = 0;
						                           
						                             $file_arr = explode("|&", $db->f(name1));
						                             $filename_arr = explode("|&", $db->f(pic1));
						                            
						                            $sizefile = sizeof($file_arr);
						                            if($sizefile > 1){$limit = sizeof($file_arr)-1;}else{$limit=1;}
						                            for($i=0;$i<$limit;$i++){
						                           ?>

													<?php
				                                      if ($filename_arr[$i] != "") {
				                                    ?>
				                                       <a href="view_pic_content.php?pic=<?=$filename_arr[$i]?>&name=<?=$file_arr[$i]?>&f=content_certificate" target="_blank"> <img height="75px"  width="65px" style="margin-right:5px;margin-top:5px;" src="../img/content_certificate/<?=$filename_arr[$i]?>"></a>
				                                    <?php
				                                      }
				                                    ?>
						                         <?php
						                            }
						                        ?> 
											</td>
											<td class="td_table">
												<?php
						                            $limit = 0;
						                            $file_arr = array();
						                            $filename_arr = array();
						                            $sizefile = 0;
						                           
						                             $file_arr = explode("|&", $db->f(name2));
						                             $filename_arr = explode("|&", $db->f(pic2));
						                            
						                            $sizefile = sizeof($file_arr);
						                            if($sizefile > 1){$limit = sizeof($file_arr)-1;}else{$limit=1;}
						                            for($i=0;$i<$limit;$i++){
						                           ?>

													<?php
				                                      if ($filename_arr[$i] != "") {
				                                    ?>
				                                       <a href="view_pic_content.php?pic=<?=$filename_arr[$i]?>&name=<?=$file_arr[$i]?>&f=content_certificate" target="_blank"> <img height="75px"  width="65px" style="margin-right:5px;margin-top:5px;" src="../img/content_certificate/<?=$filename_arr[$i]?>"></a>
				                                    <?php
				                                      }
				                                    ?>
						                         <?php
						                            }
						                        ?> 
											</td>
											<td class="td_table">
												<?php
						                            $limit = 0;
						                            $file_arr = array();
						                            $filename_arr = array();
						                            $sizefile = 0;
						                           
						                             $file_arr = explode("|&", $db->f(name3));
						                             $filename_arr = explode("|&", $db->f(pic3));
						                            
						                            $sizefile = sizeof($file_arr);
						                            if($sizefile > 1){$limit = sizeof($file_arr)-1;}else{$limit=1;}
						                            for($i=0;$i<$limit;$i++){
						                           ?>

													<?php
				                                      if ($filename_arr[$i] != "") {
				                                    ?>
				                                       <a href="view_pic_content.php?pic=<?=$filename_arr[$i]?>&name=<?=$file_arr[$i]?>&f=content_certificate" target="_blank"> <img height="75px"  width="65px" style="margin-right:5px;margin-top:5px;" src="../img/content_certificate/<?=$filename_arr[$i]?>"></a>
				                                    <?php
				                                      }
				                                    ?>
						                         <?php
						                            }
						                        ?> 
											</td>
											<td class="td_table">
												<?php
						                            $limit = 0;
						                            $file_arr = array();
						                            $filename_arr = array();
						                            $sizefile = 0;
						                           
						                             $file_arr = explode("|&", $db->f(name4));
						                             $filename_arr = explode("|&", $db->f(pic4));
						                            
						                            $sizefile = sizeof($file_arr);
						                            if($sizefile > 1){$limit = sizeof($file_arr)-1;}else{$limit=1;}
						                            for($i=0;$i<$limit;$i++){
						                           ?>

													<?php
				                                      if ($filename_arr[$i] != "") {
				                                    ?>
				                                       <a href="view_pic_content.php?pic=<?=$filename_arr[$i]?>&name=<?=$file_arr[$i]?>&f=content_certificate" target="_blank"> <img height="75px"  width="65px" style="margin-right:5px;margin-top:5px;" src="../img/content_certificate/<?=$filename_arr[$i]?>"></a>
				                                    <?php
				                                      }
				                                    ?>
						                         <?php
						                            }
						                        ?> 
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
							<table width="95%" border="0" align="center" cellpadding="3" cellspacing="0">
                              <tr>
                                <td align="center" style="color:#FC0">ตัวอย่างพระเก๊ที่ดูง่าย</td>
                              </tr>
                              <tr>
                                <td>
									<table cellpadding="0" cellspacing="0" width="100%" class="tbl_table">
										<tr>
											<td width="25%" bgcolor="#000" height="30" align="center">
												รูปด้านหน้า / 前面图片
											</td>
											<td width="25%" bgcolor="#000" align="center">
												รูปด้านหลัง / 后面图片
											</td>
											<td width="25%" bgcolor="#000" align="center">
												รูปขอบข้าง / 后面图片
											</td>
											<td width="25%" bgcolor="#000" align="center">
												อื่น ๆ / 其它
											</td>
										</tr>
										<tr>
											<td class="td_table">
												 <?php
						                            $limit = 0;
						                            $file_arr = array();
						                            $filename_arr = array();
						                            $sizefile = 0;
						                           
						                             $file_arr = explode("|&", $db->f(name5));
						                             $filename_arr = explode("|&", $db->f(pic5));
						                            
						                            $sizefile = sizeof($file_arr);
						                            if($sizefile > 1){$limit = sizeof($file_arr)-1;}else{$limit=1;}
						                            for($i=0;$i<$limit;$i++){
						                           ?>

													<?php
				                                      if ($filename_arr[$i] != "") {
				                                    ?>
				                                       <a href="view_pic_content.php?pic=<?=$filename_arr[$i]?>&name=<?=$file_arr[$i]?>&f=content_certificate" target="_blank"> <img height="75px"  width="65px" style="margin-right:5px;margin-top:5px;" src="../img/content_certificate/<?=$filename_arr[$i]?>"></a>
				                                    <?php
				                                      }
				                                    ?>
						                         <?php
						                            }
						                        ?> 
											</td>
											<td class="td_table">
												<?php
						                            $limit = 0;
						                            $file_arr = array();
						                            $filename_arr = array();
						                            $sizefile = 0;
						                           
						                             $file_arr = explode("|&", $db->f(name6));
						                             $filename_arr = explode("|&", $db->f(pic6));
						                            
						                            $sizefile = sizeof($file_arr);
						                            if($sizefile > 1){$limit = sizeof($file_arr)-1;}else{$limit=1;}
						                            for($i=0;$i<$limit;$i++){
						                           ?>

													<?php
				                                      if ($filename_arr[$i] != "") {
				                                    ?>
				                                       <a href="view_pic_content.php?pic=<?=$filename_arr[$i]?>&name=<?=$file_arr[$i]?>&f=content_certificate" target="_blank"> <img height="75px"  width="65px" style="margin-right:5px;margin-top:5px;" src="../img/content_certificate/<?=$filename_arr[$i]?>"></a>
				                                    <?php
				                                      }
				                                    ?>
						                         <?php
						                            }
						                        ?> 
											</td>
											<td class="td_table">
												<?php
						                            $limit = 0;
						                            $file_arr = array();
						                            $filename_arr = array();
						                            $sizefile = 0;
						                           
						                             $file_arr = explode("|&", $db->f(name7));
						                             $filename_arr = explode("|&", $db->f(pic7));
						                            
						                            $sizefile = sizeof($file_arr);
						                            if($sizefile > 1){$limit = sizeof($file_arr)-1;}else{$limit=1;}
						                            for($i=0;$i<$limit;$i++){
						                           ?>

													<?php
				                                      if ($filename_arr[$i] != "") {
				                                    ?>
				                                       <a href="view_pic_content.php?pic=<?=$filename_arr[$i]?>&name=<?=$file_arr[$i]?>&f=content_certificate" target="_blank"> <img height="75px"  width="65px" style="margin-right:5px;margin-top:5px;" src="../img/content_certificate/<?=$filename_arr[$i]?>"></a>
				                                    <?php
				                                      }
				                                    ?>
						                         <?php
						                            }
						                        ?> 
											</td>
											<td class="td_table">
												<?php
						                            $limit = 0;
						                            $file_arr = array();
						                            $filename_arr = array();
						                            $sizefile = 0;
						                           
						                             $file_arr = explode("|&", $db->f(name8));
						                             $filename_arr = explode("|&", $db->f(pic8));
						                            
						                            $sizefile = sizeof($file_arr);
						                            if($sizefile > 1){$limit = sizeof($file_arr)-1;}else{$limit=1;}
						                            for($i=0;$i<$limit;$i++){
						                           ?>

													<?php
				                                      if ($filename_arr[$i] != "") {
				                                    ?>
				                                       <a href="view_pic_content.php?pic=<?=$filename_arr[$i]?>&name=<?=$file_arr[$i]?>&f=content_certificate" target="_blank"> <img height="75px"  width="65px" style="margin-right:5px;margin-top:5px;" src="../img/content_certificate/<?=$filename_arr[$i]?>"></a>
				                                    <?php
				                                      }
				                                    ?>
						                         <?php
						                            }
						                        ?> 
											</td>
										</tr>
									</table>
                                </td>
                              </tr>
                            </table>                             
                            </td>
                          </tr>
                          <tr>
                          	<td style="border-bottom:1px dashed #FC0">
                            </td>
                          </tr>
                        </table>
                     <? } ?>   
                    </td>
                  </tr>
                  
                  <tr>
                    <td><table width="95%" border="0" align="center" cellpadding="3" cellspacing="0">
                      <tr>
                        <td align="center" style="color:#FC0">ที่ปรึกษา</td>
                      </tr>
                      <tr>
                        <td>
						  <?php 
						  	$q="SELECT * FROM `referee` WHERE amulet_id = '".$_SESSION['content_certificate_id']."' ORDER BY referee_id DESC";
							$db->query($q);
							static $v=1;
							while($db->next_record()){ 
							
							$q="SELECT * FROM `member` WHERE username = '".$db->f(username)."' ";
							$dbmember=new nDB();
							$dbmember->query($q);
							$dbmember->next_record();
							?>
                            <table width="145" border="0" cellspacing="0" cellpadding="3" style="float:left; margin:5px">
                              <tr>
                                <td><a href="<? if ($db->f(username)=='') { ?><?=$db->f(url)?><? } else { ?>../shop_index.php?shop=<?=$dbmember->f(id)?><? } ?>" target="_blank"><img src="<?=($db->f(username)=='')?'../img/referee_pic/'.$db->f(pic1):'../img/head/'.$dbmember->f(head2)?>" width="145" height="145" /></a></td>
                              </tr>
                              <tr>
                                <td align="center" style="color:#FC0">
								<? if ($dbmember->f(username)=='') { ?>
                                <?=$db->f(name)?><br />Tel.<?=$db->f(tel)?>
                                <? } else {?>
                                <?=$dbmember->f(username)?>
                                <? } ?>								
                                </td>
                              </tr>
                              <tr>
                                <td align="center"><a href="view_referee.php?id=<?=$db->f(referee_id)?>" style="color:#FC0; font-size:12px" target="_blank">รายละเอียด</a></td>
                              </tr>
                            </table>
							<? } ?>
                        </td>
                      </tr>
                    </table></td>
                  </tr>
                </table>
    </td>
  </tr>
</table>
</body>
</html>