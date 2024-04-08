<?php

class Upload {
	public function uploadProcess($a_fupload, $s_path) {
		$b_ = false;
		if (!is_dir($s_path)) {
			exit("$s_path not found!!!.");
		}

		if (is_uploaded_file($a_fupload['upload_1']['tmp_name'])) {
			if (move_uploaded_file($a_fupload['upload_1']['tmp_name'], $s_path . '/' . $a_fupload['upload_1']['name']) === true) {
				$b_ = true;
			}
		}

		if (is_uploaded_file($a_fupload['upload_2']['tmp_name'])) {
			if (move_uploaded_file($a_fupload['upload_2']['tmp_name'], $s_path . '/' . $a_fupload['upload_2']['name']) === true) {
				$b_ = true;
			}
		}

		if (is_uploaded_file($a_fupload['upload_3']['tmp_name'])) {
			if (move_uploaded_file($a_fupload['upload_3']['tmp_name'], $s_path . '/' . $a_fupload['upload_3']['name']) === true) {
				$b_ = true;
			}
		}

		if (is_uploaded_file($a_fupload['upload_4']['tmp_name'])) {
			if (move_uploaded_file($a_fupload['upload_4']['tmp_name'], $s_path . '/' . $a_fupload['upload_4']['name']) === true) {
				$b_ = true;
			}
		}

		if (is_uploaded_file($a_fupload['upload_5']['tmp_name'])) {
			if (move_uploaded_file($a_fupload['upload_5']['tmp_name'], $s_path . '/' . $a_fupload['upload_5']['name']) === true) {
				$b_ = true;
			}
		}
		return $b_;
	}

	public function getForm($i_num_file_field = 1, $s_execute_path = "", $b_path_other = false) {
		$s_file_field = "";
		if ($b_path_other === false) {
			$s_file_field = "<form action=\"$s_execute_path\" method=\"post\" enctype=\"multipart/form-data\">\r\n";
		}
		if ($i_num_file_field > 5) {
			$i_num_file_field = 5;
		}

		for ($i_loop = 0; $i_loop < $i_num_file_field; $i_loop++) {
			$s_file_field .= "<input type=\"file\" name=\"upload_" . ($i_loop + 1) . "\" /><br>\r\n";
		}
		if ($b_path_other === false) {
			$s_file_field .= "<input type=\"submit\" name=\"upload_submit\" id=\"upload_submit\" value=\"Upload\" />\r\n";
			$s_file_field .= "</form>\r\n";
		}

		return $s_file_field;
	}

}

class Download {
	public function dumpFolder($s_folder_path) {
		$a_file_path = array();
		$o_dir = dir($s_folder_path);
		while (($s_file = $o_dir -> read())) {
			if ($s_file == '.' || $s_file == '..' || substr($s_file, 0, 1) == '.') {
				continue;
			}
			$a_file_path[] = $s_folder_path . $s_file;
		}
		return $a_file_path;
	}

	public function getFile($s_file_path) {
		Header('Content-disposition: attachment; filename=' . $s_file_path);
		Header('Content-Type: application/force-download');
		$o_file = new File();
		$o_file -> s_file_name = $s_file_path;
		$o_file -> openFile('rb');
		$o_file -> fpassthru();
	}

}
?>