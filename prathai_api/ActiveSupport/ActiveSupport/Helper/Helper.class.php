<?php

class Helper {

	function __construct() {

	}



	/**
	 *
	 * Return data by Json structor
	 */
	static function dataModelToJson(DataModel $_dm, $_schema = "data", $_from_charset = NULL, $_to_charset = NULL) {
		$_json = '{"totalItem":"0",' . $_schema . ':{}}';

		if ($_dm -> countRecord() > 0) {
			$_dm -> moveNextRecord();
			for ($_i = 0; $_i < $_dm -> countRecord(); $_i++) {
				$a_ = array();
				for ($_j = 0; $_j < $_dm -> countColumn(); $_j++) {
					if ($_from_charset != $_to_charset && ($_from_charset != null || $_from_charset != "") && ($_to_charset != null || $_to_charset != "")) {
						$a_[$_dm -> getFieldName($_j)] = iconv($_from_charset, $_to_charset, $_dm -> getValue($_dm -> fieldName($_j)));
					} else {
						$a_[$_dm -> getFieldName($_j)] = $_dm -> getValue($_dm -> getFieldName($_j));
					}
				}
				$_results[] = $a_;
				$total = count($_results);
				$_json = '{"totalItem":"' . $total . '",' . $_schema . ':' . json_encode($_results) . '}';
			}
		}
		return $_json;
	}

}
?>