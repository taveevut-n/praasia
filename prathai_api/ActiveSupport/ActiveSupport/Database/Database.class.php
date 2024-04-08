<?php
if (! defined ( "DB_DEBUG_MODE" )) {
	define ( "DB_DEBUG_MODE", 1, true );
}

if (! defined ( "DB_PRODUCT_MODE" )) {
	define ( "DB_PRODUCT_MODE", 2, true );
}

if (! defined ( "DB_MYSQL" )) {
	define ( "DB_MYSQL", "mysql", true );
}

if (! defined ( "DB_MSSQL" )) {
	define ( "DB_MSSQL", "mssql", true );
}

if (! defined ( "DB_ORACLE" )) {
	define ( "DB_ORACLE", "oracle", true );
}

if (! defined ( "DB_POSGRESS" )) {
	define ( "DB_POSGRESS", "posgress", true );
}

if (! defined ( "DB_ODBC" )) {
	define ( "DB_ODBC", "access", true );
}

class DBProvider {
	/**
	 *
	 * @var number
	 */
	public static $DB_DEBUG_MODE = 1;
	/**
	 *
	 * @var number
	 */
	public static $DB_PRODUCT_MODE = 2;
	/**
	 *
	 * @var string
	 */
	public static $DB_MYSQL = "mysql";
	/**
	 *
	 * @var string
	 */
	public static $DB_MSSQL = "mssql";
	/**
	 *
	 * @var string
	 */
	public static $DB_ORACLE = "oracle";
	/**
	 *
	 * @var string
	 */
	public static $DB_POSGRESS = "progress";
	/**
	 *
	 * @var string
	 */
	public static $DB_ODBC = "odbc";

	/**
	 *
	 * @param integer $s_db_type
	 * @return Database (MySql,MsSql,Oracle)
	 */
	static function newDbProvide($s_db_type) {
		$o_db = null;
		if (strtolower ( $s_db_type ) == strtolower ( "mysql" )) {
			$o_db = new MySql ( DB_DEBUG_MODE );
		} elseif (strtolower ( $s_db_type ) == strtolower ( "mssql" )) {
			$o_db = new MsSql ( DB_DEBUG_MODE );
		} elseif (strtolower ( $s_db_type ) == strtolower ( "oracle" )) {
			$o_db = new Oracle ();
		} elseif (strtolower ( $s_db_type ) == strtolower ( "prosgress" )) {
			$o_db = new Posgress ();
		} elseif (strtolower ( $s_db_type ) == strtolower ( "access" )) {
			$o_db = new Access ();
		}
		return $o_db;
	}

}

abstract class Database {
	/**
	 *
	 * @var integer
	 */
	private $intId;
	/**
	 *
	 * @var string
	 */
	private $strDatabaseServer;
	/**
	 *
	 * @var string
	 */
	private $strUsername;
	/**
	 *
	 * @var string
	 */
	private $strPassword;

	/**
	 *
	 * @param string $sId
	 */
	public function setId($sId) {
		$this->intId = $sId;
	}

	public function getId() {
		return $this->intId;
	}

	public function setDatabaseServer($sDatabaseServer) {
		$this->strDatabaseServer = $sDatabaseServer;
	}

	public function getDatabaseServer() {
		return $this->strDatabaseServer;
	}

	public static function escapeValue($_s) {
		return htmlspecialchars ( $_s);
	}

}

/**
 * Mysql class database server for PHP5+
 *
 * @package ActiveSupport/Database
 */
final class MySql extends Database {
	/**
	 *
	 * @access public
	 * @var string
	 */
	public $strServerName;
	/**
	 *
	 * @access public
	 * @var string
	 */
	public $strUserName;
	/**
	 *
	 * @access public
	 * @var string
	 */
	public $strUserPassword;
	/**
	 *
	 * @access public
	 * @var string
	 */
	public $strDatabaseName;
	/**
	 *
	 * @access private
	 * @var resource
	 */
	public $resConn;
	/**
	 *
	 * @access public
	 * @var resource
	 */
	public $resResult;

	/**
	 *
	 * @access public
	 * @var array
	 */
	public $fetch;

	/**
	 *
	 * @access public
	 * @var integer
	 */
	public $intState;

	/**
	 * use command begen transaction;
	 *
	 * @var boolean
	 */
	private $b_begin_transaction;

	/**
	 * Enter description here...
	 *
	 * @var boolean
	 */
	private $b_commit;

	/**
	 * rollback flag
	 * @var boolean
	 */
	private $b_rollback;

	/**
	 * Is debug flag
	 * @var boolean
	 */
	private $bDebug;

	/**
	 *
	 * @return Database
	 */
	function __construct($bDebug = DB_PRODUCT_MODE) {
		$this->strServerName = "";
		$this->strUserName = "";
		$this->strUserPassword = "";
		$this->strDatabaseName = "";
		$this->resConn = null;

		$this->resResult = null;
		$this->intNumRows = 0;
		$this->fetch = Array ();
		$this->intAffretedRows = 0;
		$this->intState = 0;
		$this->bDebug = $bDebug;
	}

	/**
	 *
	 * @access public
	 * @return void
	 */
	function openConnection() {
		if ($this->intState == 0) {
			$this->resConn = mysql_connect ( $this->strServerName, $this->strUserName, $this->strUserPassword );
			if ($this->resConn) {
				$this->intState = 1;
			}
		} else {
			if ($this->bDebug == DBProvider::$DB_DEBUG_MODE) {
				print "ERROR  : Can't open connection.";
			}
		}
	}

	/**
	 *
	 * @access public
	 * @return boolean
	 */
	public function selectDatabase($s_charset = 'utf8') {
		$b_ = false;
		if ($this->intState == 1) {
			if (mysql_select_db ( $this->strDatabaseName, $this->resConn ) === true) {

				$cs1 = "SET character_set_results=" . $s_charset;
				mysql_query ( $cs1 );
				$cs2 = "SET character_set_client =" . $s_charset;
				mysql_query ( $cs2 );
				$cs3 = "SET character_set_connection =" . $s_charset;
				mysql_query ( $cs3 );

				$b_ = true;
			} else {
				$b_ = false;
			}
		} else {
			$b_ = false;
		}
		return $b_;
	}

	/**
	 *
	 * @access public
	 * @return integer
	 */
	public function close() {
		if ($this->intState == 1) {
			mysql_close ( $this->resConn );
			$this->intState = 0;
			return $this->intState;
		} else {
			$this->intState = 1;
			return $this->intState;
		}
	}

	public static function escapeValue($_s) {
		return mysql_real_escape_string ( $_s );

	}

	/**
	 *
	 * @access public
	 * @param string $s_sql
	 * @return resource
	 */
	public function executeQuery($s_sql) {
		$this->resResult = mysql_query ( $s_sql, $this->resConn );


		if ($this->resResult) {
			if ($this->countRecord () > 0) {
				$this->fetchArray ();
			}
		} else {
			if ($this->bDebug == DBProvider::$DB_DEBUG_MODE) {
				print "SQL TEXT : " . $s_sql . "\n<br />" . " : SQL CASE : " . mysql_error ( $this->resConn );
				exit ();
			}
		}
	}

	public function executeUpdate($s_sql) {

		$i_affected = null;
		$this->resResult = mysql_query ( $s_sql, $this->resConn );

		if ($this->resResult != null) {
			$i_affected = $this->rowAffreated ();
		} else {
			if ($this->bDebug == DBProvider::$DB_DEBUG_MODE) {
				print "SQL TEXT : " . $s_sql . "\n<br />" . " : SQL CASE : " . mysql_error ( $this->resConn );
				exit ();
			}
		}
		return $i_affected;
	}

	/**
	 *
	 * @access private
	 * @return integer
	 */
	public function countRecord() {
		return (mysql_num_rows ( $this->resResult ) > 0) ? mysql_num_rows ( $this->resResult ) : 0;
	}

	/**
	 *
	 * @access public
	 * @return integer
	 */
	public function countField() {
		return @mysql_num_fields ( $this->resResult );
	}

	/**
	 *
	 * @access public
	 * @param integer $i_r
	 * @param integer $i_c
	 * @return string
	 */
	public function indexGrid($i_r, $i_c) {
		return mysql_result ( $this->resResult, $i_r, $i_c );
	}

	/**
	 *
	 * @access public
	 * @return array
	 */
	public function fetchArray() {
		return mysql_fetch_array ( $this->resResult );
	}

	/**
	 *
	 * @access public
	 * @return object
	 */
	public function fetchObject() {
		return mysql_fetch_object ( $this->resResult );
	}

	/**
	 *
	 * @access public
	 * @param integer $intIndexColumn
	 * @return string
	 */
	public function fieldName($i_c) {
		return mysql_field_name ( $this->resResult, $i_c );
	}

	public function fieldSize($intFieldOffset) {
		return mysql_field_len ( $this->resResult, $intFieldOffset );
	}

	public function fieldType($intFieldOffset) {
		return mysql_field_type ( $this->resResult, $intFieldOffset );
	}

	/**
	 * Return array offset set of flag on result.
	 */
	public function fieldFlag($intOffset) {
		return mysql_field_flags ( $this->resResult, $intOffset );
	}

	/**
	 * return effect of sql on commond insert update and delete
	 *
	 * @access public
	 * @return integer
	 */
	public function rowAffreated() {
		return mysql_affected_rows ( $this->resConn );
	}

}

final class Posgress extends Database {
}

/**
 * Microsoft SQL Server
 * design for PHP5
 */
final class MsSql extends Database {
	/**
	 *
	 * @access public
	 * @var string
	 */
	public $strServerName;

	/**
	 *
	 * @access public
	 * @var string
	 */
	public $strUserName;

	/**
	 *
	 * @access public
	 * @var string
	 */
	public $strUserPassword;

	/**
	 *
	 * @access public
	 * @var string
	 */
	public $strDatabaseName;

	/**
	 *
	 * @access private
	 * @var resource
	 */
	private $resConn;

	/**
	 *
	 * @access private
	 * @var resource
	 */
	private $resResult;

	/**
	 *
	 * @access public
	 * @var array
	 */
	public $fetch;

	/**
	 *
	 * @access public
	 * @var integer
	 */
	public $intState;

	/**
	 * use command begen transaction;
	 *
	 * @access private
	 * @var boolean
	 */
	private $b_begin_transaction;

	/**
	 * Commit
	 *
	 * @access private
	 * @var boolean
	 */
	private $b_commit;

	/**
	 * Rollback
	 *
	 * @access private
	 * @var boolean
	 */
	private $b_rollback;
	private $bDebug;

	/**
	 *
	 * @access public
	 * @return MsSql
	 */

	public function __construct($bDebug = DB_PRODUCT_MODE) {
		$this->strServerName = ( string ) '';
		$this->strUserName = ( string ) '';
		$this->strUserPassword = ( string ) '';
		$this->strDatabaseName = ( string ) '';
		$this->resConn = ( object ) null;
		$this->resResult = ( object ) null;
		$this->fetch = ( array ) array ();
		$this->intState = 0;
		$this->bDebug = $bDebug;
	}

	/**
	 *
	 * @access public
	 * @return void
	 */
	public function openConnection() {
		$this->resConn = mssql_connect ( $this->strServerName, $this->strUserName, $this->strUserPassword );
		if ($this->resConn) {
			$this->intState = 1;
		} else {
			if ($this->bDebug == DBProvider::$DB_DEBUG_MODE) {
				print "ERROR  : Can't open connection.";
			}
		}
	}

	/**
	 *
	 * @access public
	 * @return boolean
	 */
	public function selectDatabase() {

		if ($this->intState == 1) {
			if (mssql_select_db ( $this->strDatabaseName, $this->resConn ) == true) {
				return true;
			} else {
				if ($this->bDebug == DBProvider::$DB_DEBUG_MODE) {
					print "ERROR  : " . mssql_get_last_message ();
				}
				return false;
			}
		} else {
			return false;
		}
	}

	/**
	 *
	 * @access public
	 * @return integer
	 */
	public function countField() {
		return mssql_num_fields ( $this->resResult );
	}

	/**
	 *
	 * @access public
	 * @param string $strSql
	 * @return resource
	 */
	public function executeQuery($s_sql) {
		$this->resResult = mssql_query ( $s_sql, $this->resConn );
		if ($this->resResult == true) {
			if ($this->countRecord () > 0) {
				$this->fetchArray ();
			}
		} else {
			if ($this->bDebug == DBProvider::$DB_DEBUG_MODE) {
				print "ERROR SQL COMMAND : " . $s_sql . "\n<br />" . mssql_get_last_message ();
			}
		}
	}

	/**
	 *
	 * @access public
	 * @return integer Num of insert, update ,delete.
	 */
	public function executeUpdate($s_sql) {
		$intAffected = - 1;
		$this->resResult = mssql_query ( $s_sql, $this->resConn );
		if ($this->resResult == true) {
			$intAffected = $this->rowAffreated ();
		} else {
			if ($this->bDebug == DBProvider::$DB_DEBUG_MODE) {
				print "ERROR SQL COMMAND : " . $s_sql . "\n<br />" . mssql_get_last_message ();
			}
		}
		return $intAffected;
	}

	/**
	 *
	 * @access private
	 * @return integer
	 */
	public function countRecord() {
		return (mssql_num_rows ( $this->resResult ) > 0) ? mssql_num_rows ( $this->resResult ) : 0;
	}

	/**
	 *
	 * @access public
	 * @param integer $i_r
	 * @param integer $i_c
	 * @return string
	 */
	public function indexGrid($i_r, $i_c) {
		return trim ( @mssql_result ( $this->resResult, $i_r, $i_c ) );
	}

	/**
	 *
	 * @access private
	 */
	private function fetchArray() {
		$this->fetch = mssql_fetch_array ( $this->resResult );
	}

	/**
	 *
	 * @access public
	 * @return object
	 */
	public function fetchObject() {
		return mssql_fetch_object ( $this->resResult );
	}

	/**
	 *
	 * @access public
	 * @return integer
	 */
	public function rowAffreated() {
		return mssql_rows_affected ( $this->resConn );
	}

	/**
	 *
	 * @access public
	 * @param integer $i_c
	 * @return string
	 */
	public function fieldName($i_c) {
		return mssql_field_name ( $this->resResult, $i_c );
	}

	/**
	 * Return type of field on select result data.
	 *
	 * @return string
	 * @param $i_c integer
	 */
	public function fieldType($i_c) {
		return mssql_field_type ( $this->resResult, $i_c );
	}

	/**
	 * return size of field.
	 *
	 * @param string $i_c
	 */
	public function fieldSize($i_c) {
		return mssql_field_length ( $this->resResult, $i_c );
	}

	/**
	 * Return array offset set of flag on result.
	 */
	public function fieldFlag($i_c) {
		return "";
	}

	/**
	 * close database connection.
	 *
	 * @access public
	 * @return boolean
	 */
	public function close() {
		$b_ = false;
		if ($this->intState == 1) {
			@mssql_free_result ( $this->resResult );
			if (mssql_close ( $this->resConn )) {
				$this->intState = 0;
				$b_ = true;
			}
		}
		return $b_;
	}

}

/**
 * Oracle class database server for PHP5+
 */
final class Oracle {
	/**
	 *
	 * @access Public
	 * @var String
	 */
	public $strServerName;

	/**
	 *
	 * @access Public
	 * @var String
	 */
	public $strUserName;

	/**
	 *
	 * @access Public
	 * @var String
	 */
	public $strUserPassword;

	/**
	 *
	 * @access Public
	 * @var String
	 */
	public $strDatabaseName;

	/**
	 *
	 * @access Private
	 * @var Resource
	 */
	public $resConn;

	/**
	 *
	 * @access Public
	 * @var Resource
	 */
	public $resResult;

	/**
	 *
	 * @access Public
	 * @var Array
	 */
	public $fetch;

	/**
	 *
	 * @access Public
	 * @var integer
	 */
	public $i_state;

	/**
	 * number of row from data.
	 *
	 * @var integer
	 */
	private $i_num_rows;

	/**
	 * resource of statement from SQL command
	 *
	 * @var resource
	 */
	public $rs_statement;

	/**
	 *
	 * @access public
	 * @return MsSql
	 */
	public function __construct() {
		$this->strServerName = ( string ) '';
		$this->strUserName = ( string ) '';
		$this->strUserPassword = ( string ) '';
		$this->strDatabaseName = ( string ) '';
		$this->resConn = ( object ) null;
		$this->resResult = ( object ) null;
		$this->fetch = ( array ) array ();
		$this->i_state = 0;
	}

	/**
	 *
	 * @access Public
	 * @return boolean
	 */
	public function openConnection() {
		$this->resConn = oci_connect ( $this->strUserName, $this->strUserPassword, $this->strDatabaseName );
		if ($this->resConn) {
			$this->i_state = 1;
		}
		return $this->i_state;
	}

	/**
	 *
	 * @access Public
	 * @return Integer
	 */
	public function countField() {
		$i_num_field = oci_num_fields ( $this->rs_statement );
		return $i_num_field;
	}

	/**
	 *
	 * @access Public
	 * @param string $s_sql
	 * @return resource
	 */
	public function executeQuery($s_sql) {
		$this->rs_statement = oci_parse ( $this->resConn, $s_sql );
		$this->resResult = oci_execute ( $this->rs_statement, OCI_DEFAULT );
		if ($this->rs_statement && $this->resResult === true) {
			$this->fetchArray ();
		} else {
			print "SQL TEXT : " . $s_sql;
		}
	}

	/**
	 * return integer if can insert, update ,delete.
	 *
	 * @access public
	 * @param string $s_sql
	 * @return integer
	 */
	public function executeUpdate($s_sql) {
		$i_affected = null;
		$this->rs_statement = oci_parse ( $this->resConn, $s_sql );
		$this->resResult = oci_execute ( $this->rs_statement, OCI_DEFAULT );
		if ($this->rs_statement && $this->resResult === true) {
			$i_affected = $this->rowAffreated ();
		} else {
			print "SQL TEXT : " . $s_sql;
		}
		return $i_affected;
	}

	/**
	 * return true or false on commai command
	 *
	 * @return boolean
	 */
	public function commit_transaction() {
		return oci_commit ( $this->resConn );
	}

	/**
	 * return true or false on rollback command.
	 *
	 * @return boolean
	 */
	public function rollback_transaction() {
		return oci_rollback ( $this->resConn );
	}

	/**
	 * return integer from record set object.
	 *
	 * @access Private
	 * @return integer
	 */
	public function countRecord() {
		return ($this->i_num_rows > 0) ? $this->i_num_rows : 0;
	}

	/**
	 * Return value on row and column
	 *
	 * @access Public
	 * @param integer $i_r
	 * @param
	 *        	integer i_c
	 * @return string
	 */
	public function indexGrid($i_r, $i_c) {
		return trim ( $this->fetch [$this->fieldName ( i_c )] [$i_r] );
	}

	/**
	 *
	 * @access Public
	 */
	public function fetchArray() {
		$this->i_num_rows = oci_fetch_all ( $this->rs_statement, $this->fetch );
	}

	/**
	 *
	 * @access Public
	 * @return integer
	 */
	public function rowAffreated() {
		return oci_num_rows ( $this->rs_statement );
	}

	/**
	 *
	 * @access Public
	 * @param integer $i_c
	 * @return string
	 */
	public function fieldName($i_c) {
		return oci_field_name ( $this->rs_statement, $i_c );
	}

	/**
	 * Return type of field on select result data.
	 *
	 * @return
	 *
	 *
	 *
	 * @param integer $i_c
	 */
	public function fieldType($i_c) {
		return oci_field_type ( $this->rs_statement, $i_c );
	}

	/**
	 *
	 * @access Public
	 * @return Integer
	 */
	public function close() {
		@oci_free_statement ( $this->rs_statement );
		if ($this->i_state === 1) {
			oci_close ( $this->resConn );
		}
	}

}

/**
 * Microsoft Access
 * design for PHP5
 */
final class Access extends Database {
	/**
	 *
	 * @access public
	 * @var string
	 */
	public $strPathFileName;

	/**
	 *
	 * @access public
	 * @var string
	 */
	public $strUserName;

	/**
	 *
	 * @access public
	 * @var string
	 */
	public $strUserPassword;

	/**
	 *
	 * @access public
	 * @var string
	 */
	public $strDatabaseName;

	/**
	 *
	 * @access private
	 * @var resource
	 */
	private $resConn;

	/**
	 *
	 * @access private
	 * @var resource
	 */
	private $resResult;

	/**
	 *
	 * @access public
	 * @var array
	 */
	public $fetch;

	/**
	 *
	 * @access public
	 * @var integer $intState
	 */
	public $intState;

	/**
	 *
	 * @access private
	 * @var integer $intAffreatedRow
	 */
	private $intAffreatedRow;
	/**
	 * use command begen transaction;
	 *
	 * @access private
	 * @var boolean
	 */
	private $b_begin_transaction;

	/**
	 * Commit
	 *
	 * @access private
	 * @var boolean
	 */
	private $b_commit;

	/**
	 * Rollback
	 *
	 * @access private
	 * @var boolean
	 */
	private $b_rollback;
	private $bDebug;

	/**
	 *
	 * @access public
	 * @return Access
	 */

	public function __construct($bDebug = DB_PRODUCT_MODE) {
		$this->strPathFileName = ( string ) '';
		$this->strUserName = ( string ) '';
		$this->strUserPassword = ( string ) '';
		$this->strDatabaseName = ( string ) '';
		$this->resConn = ( object ) null;
		$this->resResult = ( object ) null;
		$this->fetch = ( array ) array ();
		$this->intState = 0;
		$this->bDebug = $bDebug;
	}

	/**
	 *
	 * @access public
	 * @return void
	 */
	public function openConnection() {
		$this->resConn = odbc_connect ( $this->strPathFileName, $this->strUserName, $this->strUserPassword );
		if ($this->resConn) {
			$this->intState = 1;
		} else {
			if ($this->bDebug == DBProvider::$DB_DEBUG_MODE) {
				print "ERROR  : Can't open connection.";
			}
		}
	}

	/**
	 *
	 * @access public
	 * @return integer
	 */
	public function countField() {
		return mssql_num_fields ( $this->resResult );
	}

	/**
	 *
	 * @access public
	 * @param string $strSql
	 * @return resource
	 */
	public function executeQuery($s_sql) {
		$this->resResult = odbc_exec ( $s_sql, $this->resConn );
		if ($this->resResult == true) {
			if ($this->countRecord () > 0) {
				$this->fetchArray ();
			}
		} else {
			if ($this->bDebug == DBProvider::$DB_DEBUG_MODE) {
				print "ERROR SQL COMMAND : " . $s_sql . "\n<br />" . odbc_errormsg ( $this->resConn );
			}
		}
	}

	/**
	 *
	 * @access public
	 * @return integer Num of insert, update ,delete.
	 */
	public function executeUpdate($s_sql) {
		$intAffected = - 1;
		$this->resResult = odbc_exec ( $s_sql, $this->resConn );
		if ($this->resResult != false) {
			$intAffected = $this->resResult;
		} else {
			if ($this->bDebug == DBProvider::$DB_DEBUG_MODE) {
				print "ERROR SQL COMMAND : " . $s_sql . "\n<br />" . odbc_errormsg ( $this->resConn );
			}
		}
		return $intAffected;
	}

	/**
	 *
	 * @access private
	 * @return integer
	 */
	public function countRecord() {
		return (odbc_num_rows ( $this->resResult ) > 0) ? odbc_num_rows ( $this->resResult ) : 0;
	}

	/**
	 *
	 * @access public
	 * @param integer $i_r
	 * @param integer $i_c
	 * @return string
	 */
	public function indexGrid($i_r, $i_c) {
		return trim ( @odbc_result ( $this->resResult, $i_r, $i_c ) );
	}

	/**
	 *
	 * @access private
	 */
	private function fetchArray() {
		$this->fetch = odbc_fetch_array ( $this->resResult );
	}

	/**
	 *
	 * @access public
	 * @return object
	 */
	public function fetchObject() {
		return odbc_fetch_object ( $this->resResult );
	}

	/**
	 *
	 * @access public
	 * @return integer
	 */
	public function rowAffreated() {

		return $this->intAffreatedRow;
	}

	/**
	 *
	 * @access public
	 * @param integer $i_c
	 * @return string
	 */
	public function fieldName($i_c) {
		return odbc_field_name ( $this->resResult, $i_c );
	}

	/**
	 * Return type of field on select result data.
	 *
	 * @return string
	 * @param $i_c integer
	 */
	public function fieldType($i_c) {
		return odbc_field_type ( $this->resResult, $i_c );
	}

	/**
	 * return size of field.
	 *
	 * @param string $i_c
	 */
	public function fieldSize($i_c) {
		return odbc_field_scale ( $this->resResult, $i_c );
	}

	/**
	 * Return array offset set of flag on result.
	 */
	public function fieldFlag($i_c) {
		return "";
	}

	/**
	 * close database connection.
	 *
	 * @access public
	 * @return boolean
	 */
	public function close() {
		$b_ = false;
		if ($this->intState == 1) {
			@odbc_free_result ( $this->resResult );
			if (mssql_close ( $this->resConn )) {
				$this->intState = 0;
				$b_ = true;
			}
		}
		return $b_;

	}

}
?>