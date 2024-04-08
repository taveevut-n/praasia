<?php
/**
 * Class File
 * PHP5+
 *
 */
define ( "FILE_EMPTY", (- 1), true );
define ( "FILE_OPENED", 1, true );
define ( "FILE_CLOSED", 0, true );

class File {
	public $s_file_name;
	public $r_file_handle;
	public $i_line;
	public $i_state;

	public function __construct($s = null) {
		$this->s_file_name = $s;
		$this->r_file_handle = null;
		$this->i_line = FILE_EMPTY;
		$this->i_state = FILE_CLOSED;
	}

	public function openFile($mod = 'r') {
		if ($this->i_state === FILE_CLOSED) {
			$fopen = @fopen ( $this->s_file_name, $mod );
			if ($fopen !== false) {
				$this->i_state = FILE_OPENED;
				$this->r_file_handle = $fopen;
			} else {
				$this->i_state = FILE_CLOSED;
				print "ERROR : " . $this->s_file_name . " file can't found./ fle can't open. !!!";
				exit ();
			}
		}
	}

	/**
	 * return date/time  of last modify
	 *
	 * @return string
	 */
	public function lastModifyDate() {
		return filemtime ( $this->s_file_name );
	}

	/**
	 * Write data to blank file at 1024 bytes per time.
	 *
	 * @param String $s_data
	 * @param Integer $i_byte
	 */
	public function writeTxt($s_data, $i_byte = 1024) {
		if ($this->i_state == FILE_OPENED) {
			fwrite ( $this->r_file_handle, $s_data, $i_byte );
		} else {
			$this->i_state = FILE_CLOSED;
			print "ERROR : " . $this->s_file_name . " file can't found./ fle can't open. !!!";
			exit ();
		}
	}

	/**
	 * return  size (byte) of file.
	 *
	 * @return integer
	 */
	public function sizeFile() {
		return filesize ( $this->s_file_name );
	}

	/**
	 * return last access date/time
	 *
	 * @return string
	 */
	public function lastAccress() {
		return fileatime ( $this->s_file_name );
	}

	/**
	 * return type of file (file or dir)
	 *
	 * @return string
	 */
	public function fileType() {
		return filetype ( $this->s_file_name );
	}

	/**
	 * return data from file
	 *
	 * @param Integer $i_byte
	 * @return FKString
	 */
	public function readTxt($i_byte = 1024) {
		$s_data = '';
		if ($this->i_state === FILE_OPENED) {
			while ( ! feof ( $this->r_file_handle ) ) {
				$s_data .= fgets ( $this->r_file_handle, $i_byte );
			}
			fseek ( $this->r_file_handle, 0 );
		} else {
			$this->i_state = FILE_CLOSED;
			print "ERROR : " . $this->s_file_name . " file can't found./ fle can't open. !!!";
			exit ();
		}
		return $s_data;
	}

	/**
	 * return number of line.
	 *
	 */
	public function countLine() {
		$i_line = 0;
		if ($this->i_state === FILE_OPENED) {
			while ( ! feof ( $this->r_file_handle ) ) {
				$i_line = $i_line + 1;
				fgets ( $this->r_file_handle, 1024 );
			}
			fseek ( $this->r_file_handle, 0 );
		} else {
			$this->i_state = FILE_CLOSED;
			print "ERROR : " . $this->s_file_name . " file can't found./ fle can't open. !!!";
			exit ();
		}
		return $i_line;
	}

	/**
	 * return data by in line number.
	 *
	 * @param integer $line
	 * @param integer $i_byte
	 * @return string
	 */
	public function readLine($line = 1, $i_byte = 1024) {
		$i_count_line = $this->countLine ();
		$s_at_Line = '';
		if ($this->i_state === FILE_OPENED) {
			if ($i_count_line >= $line) {
				for($i = 1; $i < $i_count_line; $i ++) {
					$s_at_Line = fgets ( $this->r_file_handle, $i_byte );
					if ($i == $line) {
						break;
					}
				}
				fseek ( $this->r_file_handle, 0 );
			}
		} else {
			$this->i_state = FILE_CLOSED;
			print "ERROR : " . $this->s_file_name . " file can't found./ fle can't open. !!!";
			exit ();
		}
		return $s_at_Line;
	}

	public function getStartCFGBlock($s_block) {
		$i = 1;
		$pattern = '/(^\[' . $s_block . '\])/i';
		while ( ! feof ( $this->r_file_handle ) ) {
			$s_data = fgets ( $this->r_file_handle, 1024 );
			if (preg_match ( $pattern, $s_data )) {
				print $i . " : " . $s_data;
			}
			$i ++;
		}
		fseek ( $this->r_file_handle, 0 );
		return $s_data;
	}

	/**
	 * return data from file for browser.
	 *
	 * @return string
	 */
	public function readHtmlBreakLine($i_byte = 1024) {
		$s_data = '';
		if ($this->i_state === FILE_OPENED) {
			while ( ! feof ( $this->r_file_handle ) ) {
				$s_data .= fgets ( $this->r_file_handle, $i_byte );
				$s_data .= '<br>';
			}
			fseek ( $this->r_file_handle, 0 );
		} else {
			$this->i_state = FILE_CLOSED;
			print "ERROR : " . $this->s_file_name . " file can't found./ fle can't open. !!!";
			exit ();
		}
		return $s_data;
	}

	/**
	 *
	 */
	public function fpassthru() {
		return fpassthru ( $this->r_file_handle );
	}

	/**
	 * close file connection.
	 *
	 */
	public function closeFile() {
		if (fclose ( $this->r_file_handle )) {
			$this->r_file_handle = null;
			$this->i_state = 0;
		}
	}
}

class FileManager {
	public $s_file_name;
	public $r_file_handle;
	public $i_line;
	public $i_state;
	/**
	 *
	 * @param String $s
	 */
	public function __construct(String $s = null) {
		$this->s_file_name = $s;
		$this->r_file_handle = null;
		$this->i_line = FILE_EMPTY;
		$this->i_state = FILE_CLOSED;
	}

	/**
	 * Delete file.
	 * @param String $s
	 */
	public static function deleteFile(String $s) {
		$b_ = false;
		if ($s != '') {
			$b_ = unlink ( $s );
			$b_ = true;
		} else {
			$b_ = false;
		}
		return $b_;
	}

	/**
	 * Rename file.
	 * @param String $s_name_old
	 * @param String $s_name_new
	 */
	public function renameFile(String $s_name_old, String $s_name_new) {
		$b_ = false;
		if ($s_name_new != '' && $s_name_old != '') {
			$b_ = rename ( $s_name_old, $s_name_new );
			$b_ = true;
		} else {
			$b_ = false;
		}
		return $b_;
	}

	public function __deconstruct() {
		if (fclose ( $this->r_file_handle )) {
			$this->r_file_handle = null;
		}
	}
}
?>