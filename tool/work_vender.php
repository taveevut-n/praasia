<? include('../global.php');?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
	<? if ($_GET['id']) {
		$_SESSION['vender_id'] = $_GET['id']; 
	}
	?>
<?php 
	if($_POST['Submit']){
		
		if($_POST['h_data_id']==''){		
			
				$q="INSERT INTO `work_vender` ( `work_id` ,  `vender_id` , `note`, `price`, `status`, `date_add`) 	
				VALUES ('', '".$_SESSION['vender_id']."', '".$_POST['note']."', '".$_POST['price']."', '".$_POST['status']."' , '".date("Y-m-d H:i:s")."' ) ";
				$db->query($q);					
					for($mf=1;$mf<=5;$mf++){
							$upf[$mf] = uppic($_FILES['pic'.$mf],$mf,"../img/work_pic/",$_POST['h_pic'.$mf]); // Same folder
							if($upf[$mf]!=''){
								$q = "SELECT * FROM `work_vender` ORDER BY `work_id` DESC";
								$db->query($q);
								$db->next_record();	 
								$mem_id=$db->f(work_id);
								$q = "UPDATE `work_vender` SET `pic$mf` = '".$upf[$mf]."' WHERE `work_id` =".$mem_id." ";
								$db->query($q);
							}
					}
		al('Add Complete');
		redi4('view_vender.php');
		}else{
				$q="UPDATE `work_vender` SET `note` = '".$_POST['note']."' ,
					`price` = '".$_POST['price']."' ,
					`status` = '".$_POST['status']."'   WHERE `work_id` =".$_POST['h_data_id']." ";
					$db->query($q);
						for($mf=1;$mf<=5;$mf++){
							$upf[$mf] = uppic($_FILES['pic'.$mf],$mf,"../img/work_pic/",$_POST['h_pic'.$mf]); // Same folder
							if($upf[$mf]!=''){
								$q = "UPDATE `work_vender` SET `pic$mf` = '".$upf[$mf]."' WHERE `work_id` =".$_POST['h_data_id']." ";
								$db->query($q);
							}
						}
		al('Edit Complete');
		redi4('work_vender.php');									
		}			
	}
?>
<?php
	if($_GET['d_data_id']){
		$q="DELETE FROM `work_vender` WHERE `work_id` =".$_GET['d_data_id']." ";
		$db->query($q);				
	}
?>    
	<form method="post">
	<table width="100%" border="0" align="center" cellpadding="3" cellspacing="0">
        <tr>
            <td width="80%">
            บันทึกข้อความ <br />
            <textarea name="note" class="box_from3" id="note" style="height:100px; width:100%"><?=($_GET['e_data_id'])?$db5->f(note):""?></textarea>
            </td>
        </tr> 
        <tr>
            <td width="80%">
            สถานะการติดต่อ
            <select name="status">
            	<option value="1">ติดต่อแล้ว</option>
                <option value="2">ติดต่อไม่ได้</option>
            </select>
            </td>
        </tr>
        <tr>
            <td width="80%">
            ราคา <input name="price" type="text" class="box_from3" id="price" value="<?=($_GET['e_data_id'])?$db5->f(price):""?>" size="20" />
            </td>
        </tr>                 
      <tr>
        <td><input type="submit" name="Submit" value="ปรับปรุงข้อมูล" /></td>
      </tr>
    </table>
    </form>
    <br />
    <table width="100%" border="1" align="center" cellpadding="3" cellspacing="0" bordercolor="#DDDDDD" style="border-collapse:collapse">
    	<tr>
        	<td width="13%" align="center" bgcolor="#EFEFEF">วันที่
            	
            </td>
        	<td width="13%" align="center" bgcolor="#EFEFEF">สถานะ
            	
            </td>
        	<td width="43%" align="center" bgcolor="#EFEFEF">บันทึกข้อความ
            	
            </td>
        	<td width="11%" align="center" bgcolor="#EFEFEF">ราคา</td>
        	<td width="20%" align="center" bgcolor="#EFEFEF">&nbsp;</td>                        
        </tr>
		  <?php 
            $q="SELECT * FROM `work_vender` WHERE vender_id = '".$_SESSION['vender_id']."' ORDER BY work_id DESC";
            $db->query($q);
            static $v=1;
            while($db->next_record()){
			$date_work = strtotime($db->f(date_add))+25200;
          ?>        
    	<tr>
        	<td align="center">
            	<?=date("d-m-Y H:i:s",$date_work)?>
            </td>
        	<td align="center">
            	<? if ($db->f(status)=='1') { ?>
                <span style="color:#090">ติดต่อแล้ว</span>
                <? } ?>
            	<? if ($db->f(status)=='2') { ?>
                <span style="color:#F00">ติดต่อไม่ได้</span>
                <? } ?>                
            </td>
        	<td><?=$db->f(note)?>
            </td>
        	<td align="center"><?=$db->f(price)?></td>
        	<td>&nbsp;</td>                        
        </tr>
        <? } ?>
    </table>
</body>
</html>