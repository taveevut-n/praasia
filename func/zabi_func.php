<?php
function upimg($img,$imglocate){
			global $file_up;
			if($img['name']!=''){
			$fileupload1=$img['tmp_name'];
			$g_img=explode(".",$img['name']);
			$file_up1=$img['name'];
				if($fileupload1){
					$array_last=explode(".",$file_up);
					$c=count($array_last)-1;
					$lastname=strtolower($array_last[$c]);
						@copy($fileupload1,$imglocate.$file_up);			
						
				}				
			}
}

function upimg2($img,$imglocate){
			global $file_up2;
			if($img['name']!=''){
			$fileupload1=$img['tmp_name'];
			$g_img=explode(".",$img['name']);
			$file_up2=time().".".$g_img[1];
				if($fileupload1){
					$array_last=explode(".",$file_up2);
					$c=count($array_last)-1;
					$lastname=strtolower($array_last[$c]);
					if($lastname=="gif" or $lastname=="jpg" or $lastname=="jpeg" or $lastname=="swf" or $lastname=="png" or $lastname=="bmp"){
						@copy($fileupload1,$imglocate.$file_up2);			
					}			
				}				
			}
}

function upfile($img,$imglocate){
			global $file_up3;
			if($img['name']!=''){
			$fileupload1=$img['tmp_name'];
			$g_img=explode(".",$img['name']);
			$file_up3=$g_img[0].".".$g_img[1];
				if($fileupload1){
					$array_last=explode(".",$file_up3);
					$c=count($array_last)-1;
					$lastname=strtolower($array_last[$c]);
/*					if($lastname=="gif" or $lastname=="jpg" or $lastname=="jpeg" or $lastname=="swf" or $lastname=="pdf" or $lastname=="doc" or $lastname=="xls" or $lastname=="ppt" or $lastname=="zip" or $lastname=="rar"){*/
						@copy($fileupload1,$imglocate.$file_up3);			
/*					}		*/	
				}				
			}
}

//ใช้กับไฟล์ที่ไม่แปลงชื่อเป็น time
function upimg1($img,$imglocate){
			global $file_up1;
			if($img['name']!=''){
			$fileupload2=$img['tmp_name'];
			//$g_img=explode(".",$img['name']);
			$file_up1=$img['name'];
				if($fileupload2){
					$array_last=explode(".",$file_up1);
					$c=count($array_last)-1;
					$lastname=strtolower($array_last[$c]);
					
						@copy($fileupload2,$imglocate.$file_up1);			
						
				}				
			}
}

	function f_each($f_each,$g_type,$s_key,$s_value){
		foreach($f_each as $key => $value){
			//echo $key;
			if($s_key==1){
			echo "$"."_".$g_type."['".$key."']";
			}
			if($s_value==1){
			echo "---".$value."<br>";
			}else{
			echo "<br>";
			}
		}
	}
	
	function in_sert($f_each,$g_type){
/*		echo '$q="INSERT INTO $g_table ("';
		$q="SELECT * FROM $g_table";
		
		$res=mysql_query($q);
		if($res){
			echo "sdfdsf";
		}
		//echo mysql_field_len($res);
		while(mysql_fetch_array($res)){
			echo "dfdsf";
		}*/

		foreach($f_each as $key => $value){
			echo "'";
			echo "\".$"."_".$g_type."['".$key."'].\"";
			echo "',";
			echo "<br>";

		}
	}
	function g_number($para_num){
		return number_format($para_num,2,'.',',');
	}
	function al($msg){
		echo "<script language=\"javascript\">alert('$msg')</script>";
	}
	function redi(){
		echo "<script language=\"javascript\">window.location='".$_SERVER['PHP_SELF']."'</script>";		
	}
	function redi2(){
		echo "<script language=\"javascript\">window.location='".basename($_SERVER['PHP_SELF'])."'</script>";		
	}	
	function redi3($url){
		echo "<script language=\"javascript\">window.location='".$url."'</script>";		
	}	
	function redi4($url){
		echo "<script language=\"javascript\">top.location='".$url."'</script>";		
	}		
	function redi5($url){
		echo "<script language=\"javascript\">parent.location='".$url."'</script>";		
	}		
	function mydate($mmm,$sss){
			list($yy,$mm,$dd)=explode("-",$mmm);
			echo $dd.$sss.$mm.$sss.$yy;
	}
	

	
// สำหรับแก้ไขรูปหลายๆ รูป
function uppic($img,$df,$imglocate,$unf){
			if($img['name']!=''){
			@unlink($imglocate.$unf);			
			$fileupload1=$img['tmp_name'];
			$g_img=explode(".",$img['name']);
			$fy=time()."_".$df.".".$g_img[1];
				if($fileupload1){
					$array_last=explode(".",$fy);
					$c=count($array_last)-1;
					$lastname=strtolower($array_last[$c]);

						@copy($fileupload1,$imglocate.$fy);			
		
				}				
			}
			return $fy;
}	


function uppic2($img,$df,$imglocate,$unf,$key){
			if($img['name'][$key]!=''){
			// @unlink($imglocate.$unf);
			$fileupload1=$img['tmp_name'][$key];
			$g_img=explode(".",$img['name'][$key]);
			$fy=time()."_".$df.".".$g_img[1];
				if($fileupload1){
					$array_last=explode(".",$fy);
					$c=count($array_last)-1;
					$lastname=strtolower($array_last[$c]);

						@copy($fileupload1,$imglocate.$fy);			
		
				}				
			}
			return $fy;
}	




/*
			for($mf=1;$mf<=5;$mf++){
			 $upf[$mf]=uppic($_FILES['file'.$mf],$mf,"../img/promote/",$_POST['h_pic'.$mf]); // Same folder
			 if($upf[$mf]!=''){
	     $q="UPDATE `pic_promote` SET `pic$mf` = '".$upf[$mf]."' WHERE `id_pic` =".$_POST['h_pic_id']." ";
				 $db->query($q);
			 }
			}	
			
			
*/		

	

?>