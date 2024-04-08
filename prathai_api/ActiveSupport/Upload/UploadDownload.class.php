<?php
class Upload {
	public static function uploadProcess($a_fupload, $s_path,$file_box_prefix="upload_") {
		$b_ = false;
		if (! is_dir ( $s_path )) {
			exit ( "$s_path not found!!!." );
		}
		
		if (is_array ( $a_fupload )) {
			$i_num = count ( $a_fupload );
			$i_c = 1;
			while ( $i_num < $i_c ) {
				if (is_uploaded_file ( $a_fupload [$file_box_prefix.$i_c] ['tmp_name'] )) {
					if (move_uploaded_file ( $a_fupload [$file_box_prefix.$i_c] ['tmp_name'], $s_path . '/' . $a_fupload [$file_box_prefix.$i_c] ['name'] ) === true) {
						$b_ = true;
					}
				}
				$i_c ++;
			}
		} else {
			if (is_uploaded_file ( $a_fupload [$file_box_prefix] ['tmp_name'] )) {
				if (move_uploaded_file ( $a_fupload [$file_box_prefix] ['tmp_name'], $s_path . '/' . $a_fupload [$file_box_prefix] ['name'] ) === true) {
					$b_ = true;
				}
			}
		
		}
		
		return $b_;
	}
	
	public static function getForm($i_num_file_field = 1, $s_execute_path = "#",$file_box_prefix="upload_", $b_file_field_only = false,$b_use_button = false) {
		$s_file_field = "";
		if ($b_file_field_only === false) {
			$s_file_field = "<form action=\"$s_execute_path\" method=\"post\" enctype=\"multipart/form-data\">\r\n";
		}
		
		if ($i_num_file_field > 10) {
			$i_num_file_field = 10;
		}
		
		for($i_loop = 0; $i_loop < $i_num_file_field; $i_loop ++) {
			$s_file_field .= "<input type=\"file\" name=\"".$file_box_prefix . ($i_loop + 1) . "\" id=\"".$file_box_prefix. ($i_loop + 1) . "\" /><br>\r\n";
		}
		
		if ($b_use_button === false) {
			$s_file_field .= "<input type=\"submit\" name=\"upload_submit\" id=\"upload_submit\" value=\"Upload\" />\r\n";		
		}
		
		if ($b_file_field_only === false) {
		
			$s_file_field .= "</form>\r\n";
		}
		
		return $s_file_field;
	}
}

class Download {
	/**
	 * 
	 * Return list file in folder or sub folder
	 * @param string $s_folder_path
	 * @return array
	 */
	public static function dumpFolder($s_folder_path) {
		$a_file_path = array ();
		$o_dir = dir ( $s_folder_path );
		while ( ($s_file = $o_dir->read ()) ) {
			if ($s_file == '.' || $s_file == '..' || substr ( $s_file, 0, 1 ) == '.') {
				continue;
			}
			$a_file_path [] = $s_folder_path . $s_file;
		}
		return $a_file_path;
	}
	
	public static function getFile($s_file_path) {
		Header ( 'Content-disposition: attachment; filename=' . $s_file_path );
		Header ( 'Content-Type: application/force-download' );
		$o_file = new File ();
		$o_file->s_file_name = $s_file_path;
		$o_file->openFile ( 'rb' );
		$o_file->fpassthru ();
	}
}
?>