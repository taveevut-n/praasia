<?php
class HttpHeader {
	static public $TEXT_HTML_UTF8 = "Content-Type:text/html;charset=UTF-8";
	static public $TEXT_JSON_UTF8 = "Content-Type:text/json;charset=UTF-8";

	static public $TEXT_HTML_TIS620 = "Content-Type:text/html;charset=TIS-620";
	static public $TEXT_JSON_TIS620 = "Content-Type:text/json;charset=TIS-620";

	static public $TEXT_CVS_TIS620 = "Content-Type: application/octet-stream";
	static public $TEXT_CVS_UTF8 = "Content-Type: application/octet-stream";
	

	static public function CSVHeader($name) {
		header("Pragma: public");
		header("Expires: 0");
		header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
		header("Cache-Control: private", false);
		header("Content-Type: application/octet-stream");
		header("Content-Disposition: attachment; filename=\"$name.csv\";");
		header("Content-Transfer-Encoding: binary");
	}
}
?>