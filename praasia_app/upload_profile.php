<?php
    include("../global.php");

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
        $fileName = time().$picType;
        move_uploaded_file($_FILES["file"]["tmp_name"],"../img_profile/_thumbnail/" . $fileName);

        $rs = mysql_fetch_array(mysql_query("select * from member where id = '".$_GET['m_id']."' "));
        $name = trim($rs['img_profile']);

        unlink("../img_profile/_thumbnail/". $name);
        $edit = mysql_query("update member set img_profile = '$fileName' where id = '".$_GET['m_id']."' ");
        if($edit){
          echo 1;
        }
    }

?>
