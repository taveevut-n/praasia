<?php

if (! defined ( "S_CHARACTOR" ))
	define ( "S_CHARACTOR", 1001 );
if (! defined ( "S_CHARACTOR_NO_STRING" ))
	define ( "S_CHARACTOR_NO_STRING", 1011 );
if (! defined ( "S_NUMERIC" ))
	define ( "S_NUMERIC", 1002 );
if (! defined ( "S_BLOB" ))
	define ( "S_BLOB", 1003 );
if (! defined ( "S_DATETIME" ))
	define ( "S_DATETIME", 1004 );
if (! defined ( "S_BOOLEAN" ))
	define ( "S_BOOLEAN", 1005 );

/**
 * @package Databases
 */
class PreStatement {

	/**
	 * Field type charactor
	 * @var number
	 */
	public static  $CHARACTOR = 1001;
	/**
	 * Field type charactor but alpha is numeric
	 * @var number
	 */
	public static  $CHARACTOR_NO_STRING = 1011;
	/**
	 * Field type numeric
	 * @var number
	 */
	public static  $NUMERIC = 1002;
	/**
	 * Field Big long object
	 * @var number
	 */
	public static  $BLOB = 1003;
	/**
	 * Field type datetime
	 * @var number
	 */
	public static  $DATETIME = 1004;

	/**
	 * Field type boolean
	 * @var number
	 */
	public static  $BOOLEAN = 1005;

	/**
	 * array list variable parameter
	 *
	 * @var array
	 */
	private $a_assign_var;

	/**
	 * array list value for list parameter
	 *
	 * @var array
	 */
	private $a_assign_value;

	/**
	 * Source sql command before parsing sql command.
	 *
	 * @var string
	 */
	private $s_sql_source;

	/**
	 * Constructor
	 * $o_ new SQLCommand("select * from tbl1 where col1 = :c_1");
	 * $o_->setValue("c_1","name");
	 * print $o_->parseSQL();
	 *
	 * @param string $s_sql_source
	 */
	function __construct($s_sql_source = '') {
		$this->s_sql_source = $s_sql_source;
	}

	/**
	 * Assgin value on mark point from sql command.
	 *
	 * @param string $s_marker
	 * @param string $s_values
	 * @param number self::$CARACTOR|self::$CHARACTOR_NO_STRING|self::$DATETIME|self::$BOOLEAN|self::$BLOB|
	 */
	public function setValue($s_marker, $s_values, $s_col_type = S_CHARACTOR) {

		$this->a_assign_var [] = "/<" . $s_marker . ">/";

		if ($s_col_type == self::$CHARACTOR) {

			$this->a_assign_value [] = "'" . $s_values . "'";
		} else if ($s_col_type == self::$CHARACTOR_NO_STRING) {

			$this->a_assign_value [] = $s_values;
		} else if ($s_col_type == self::$DATETIME) {

			$this->a_assign_value [] = "'" . $s_values . "'";
		} else if ($s_col_type == self::$BOOLEAN) {

			if ($s_values == true) {

				$this->a_assign_value [] = true;
			} else {

				$this->a_assign_value [] = false;
			}

		} else if ($s_col_type == self::$NUMERIC) {

			$this->a_assign_value [] = (($s_values == "") || $s_values == null) ? 0 : $s_values;

		}else if ($s_col_type == self::$BLOB) {

			$this->a_assign_value [] = "'" . $s_values . "'";

		}
	}

	/**
	 * Set source Sql command.
	 *
	 * @param string $s_sql
	 */
	public function setSql($s_sql = '') {
		$this->s_sql_source = $s_sql;
		$this->a_assign_var = array ();
		$this->a_assign_value = array ();
	}

	/**
	 * Get source Sql command.
	 *
	 * @return string
	 */
	public function getSql() {
		return $this->s_sql_source;
	}

	/**
	 * Return parsing sql command.
	 *
	 * @return string
	 */
	public function parseSQL() {
		if (count ( $this->a_assign_var ) > 0 && count ( $this->a_assign_value ) > 0) {
			$s_sql = @preg_replace ( $this->a_assign_var, $this->a_assign_value, $this->s_sql_source, 1 );
		} else {
			$s_sql = $this->s_sql_source;
		}
		return $s_sql;
	}

	public function free() {
		$this->a_assign_var = array ();
		$this->a_assign_value = array ();
	}

}
?>
