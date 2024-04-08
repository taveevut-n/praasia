<?php
class ExportData {

	/**
	 * find data on table return data in format xml.
	 *
	 *
	 * @return MsSql
	 */
	static function dbConnection() {
		$o_db = new MsSql(STATE_PRODUCT);
		$o_db -> strDatabaseName = STR_DATABASE_NAME;
		$o_db -> strServerName = STR_NAME_SERVER;
		$o_db -> strUserName = STR_USER_NAME;
		$o_db -> strUserPassword = STR_PASSWORD;
		$o_db -> openConnection();

		if ($o_db -> intState == 1) {
			$o_db -> selectDatabase();
		} else {
			$o_db = null;
		}
		return $o_db;
	}

	/**
	 * insert update delete
	 *
	 * @param string $s_sql
	 */
	function update_command($s_sql = '') {
		$b_operate = false;
		$s_error_text = '';
		$o_db = self::dbConnection();
		if ($o_db != null) {
			$i_effect_rows = ( integer )$o_db -> executeUpdate($s_sql);
			if ($i_effect_rows > 0) {
				$b_operate = true;
			} else {
				$b_operate = false;
				$s_error_text = "\r\nERROR : MySql query failed\tUSER : " . $_SESSION['s_username'] . " \tDATE/TIME :" . date("d/m/y H:I:s") . "\r\n";
				$s_error_text .= "QUERY FAIL : " . $s_sql . "\r\n";
			}
		} else {
			$b_operate = false;
		}

		$o_db -> close();
		return $b_operate;
	}

}

class JsonBuilder extends ExportData {

	/**
	 *
	 * @param string $s_sql [optional]
	 * @param object $s_xml_schema [optional]
	 * @return array
	 */
	public static function export($s_sql = '', $s_schema = 'data') {
		$arr = array();
		$sJson = '{"totalItem":"0",' . $s_schema . ':{}}';
		$s_error_text = '';
		$o_db = self::dbConnection();
		if ($o_db != null) {
			$o_db -> executeQuery($s_sql);
			if ($o_db -> countRecord() > 0) {
				for ($i_index_row = 0; $i_index_row < $o_db -> countRecord(); $i_index_row++) {
					$a_ = array();
					for ($i_column = 0; $i_column < $o_db -> countField(); $i_column++) {
						$a_[$o_db -> fieldName($i_column)] = iconv("tis-620", "utf-8", $o_db -> indexGrid($i_index_row, $o_db -> fieldName($i_column)));
					}
					$a_results[] = $a_;
				}
				$total = count($a_results);
				$sJson = '{"totalItem":"' . $total . '",' . $s_schema . ':' . json_encode($a_results) . '}';
			}

		}

		if ($o_db != null)
			$o_db -> close();

		return $sJson;

	}

	/**
	 *
	 * @param string $s_sql [optional]
	 * @param object $s_xml_schema [optional]
	 * @return array
	 */
	public static function exportTaskToGroup($s_sql = '', $s_schema = 'data') {
		$arr = array();
		$sJson = '{"totalItem":"0",' . $s_schema . ':{}}';
		$s_error_text = '';
		$o_db = self::dbConnection();
		if ($o_db != null) {
			$o_db -> executeQuery($s_sql);
			if ($o_db -> countRecord() > 0) {
				for ($i_index_row = 0; $i_index_row < $o_db -> countRecord(); $i_index_row++) {
					$a_ = array();
					for ($i_column = 0; $i_column < $o_db -> countField(); $i_column++) {
						$a_[$o_db -> fieldName($i_column)] = iconv("tis-620", "utf-8", $o_db -> indexGrid($i_index_row, $o_db -> fieldName($i_column)));
					}
					$a_results[] = $a_;
				}
				$total = count($a_results);
				$sJson = '{' . $s_schema . ':' . json_encode($a_results) . '}';
			}

		}

		if ($o_db != null)
			$o_db -> close();

		return $sJson;

	}

}

class XmlBuilder extends ExportData {

	/**
	 * find data on table return data in format xml.
	 *
	 * @param string $s_sql
	 * @param string $s_xml_schema
	 *
	 * @return string
	 */
	public static function export($s_sql = '', $s_xml_schema = 'datatable') {
		$dataXML = "";
		$s_error_text = '';
		$o_db = self::dbConnection();
		if ($o_db != null) {
			$o_db -> selectDatabase();
			$o_db -> executeQuery($s_sql);
			$dataXML = "<?xml version=\"1.0\" encoding=\"utf-8\"?>\r\n";
			$dataXML .= '<' . $s_xml_schema . ' totalItems="' . $o_db -> countRecord() . '" itemsFound="' . $o_db -> countRecord() . '" >' . "\r\n";
			if ($o_db -> countRecord() > 0) {
				for ($i_index_row = 0; $o_db -> countRecord() > $i_index_row; $i_index_row++) {
					$dataXML .= '<record rec_id="' . ($o_db -> indexGrid($i_index_row, "id")) . '">' . "\r\n";
					for ($i_columns = 0; $i_columns < $o_db -> countField(); $i_columns++) {
						$dataXML .= "<" . $o_db -> fieldName($i_columns) . ">";
						if (trim($o_db -> indexGrid($i_index_row, $o_db -> fieldName($i_columns))) != "") {
							$dataXML .= $o_db -> indexGrid($i_index_row, $o_db -> fieldName($i_columns));
						} else {
							$dataXML .= "-";
						}

						$dataXML .= "</" . $o_db -> fieldName($i_columns) . ">" . "\r\n";
					}
					$dataXML .= '</record>' . "\r\n";
				}
			}
			$dataXML .= "</$s_xml_schema>\r\n";
		}
		$o_db -> close();
		return $dataXML;
	}

}
?>
