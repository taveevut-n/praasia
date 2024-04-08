<?php
    if($_FILES['file']['name']!=""){
        list($old_x,$old_y,$img_type)=getimagesize($_FILES["file"]["tmp_name"]);    
        switch($img_type) {    
            case IMAGETYPE_JPEG:    
                $picType=".jpg";  
                break;    
            case IMAGETYPE_GIF:    
                $picType=".gif";  
                break;              
            case IMAGETYPE_PNG:    
                $picType=".png";  
                break;    
        }         
        $fileName=time().$picType;
        move_uploaded_file($_FILES["file"]["tmp_name"],"uploads/" . $fileName);  
        echo $fileName;
    }  
?> 