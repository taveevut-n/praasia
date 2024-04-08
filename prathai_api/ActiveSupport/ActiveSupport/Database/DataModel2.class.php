<?php
final class ColumnSetModel2 {
	/**
	 * Column set for contain Column model.
	 *
	 * @var array $columns
	 */
	private $columns = array ();
	private $_columns = array ();

	/**
	 * Add Column to column set
	 *
	 * @param ColumnModel $oCM
	 * @return void
	 */
	public function addColumn(ColumnModel $oCM) {
		$this->columns [$oCM->getFieldName ()] = clone $oCM;
		$this->_columns [] = clone $oCM;
		unset ( $oCM );
	}

	/**
	 * return number of column
	 *
	 * @return integer
	 */
	public function countColumn() {
		return count ( $this->columns );
	}

	/**
	 * return Column in current columnset model.
	 *
	 * @param string $k
	 * @return ColumnModel
	 */
	public function getColumn($k) {
		$o_ = null;

		if (array_key_exists ( $k, $this->columns )) {
			$o_ = $this->columns [$k];
		}
		return $o_;
	}

	/**
	 * return Column in current columnset model.
	 *
	 * @param string $k
	 * @return ColumnModel
	 */
	public function getColumnByIndex($i) {
		return $this->_columns [$i];
	}

	/**
	 * return all column set in current object
	 *
	 * @return array $this->columns
	 */
	public function getColumns() {
		return $this->columns;
	}

	/**
	 * create new column model for column set object.
	 *
	 * @param array $configs
	 * @return void
	 */
	public function newColumn($configs) {
		$this->records [] = new ColumnModel ();
		foreach ( $configs as $k => $v ) {
			switch (strtolower ( $k )) {
				case 'name' :
					$this->setFieldName ( $v );
					break;
				case 'type' :
					$this->setFieldType ( $v );
					break;
				case 'default' :
					$this->setDefault ( $v );
					break;
				case 'size' :
					$this->setFieldSize ( $v );
					break;
			}
		}
	}
}
final class ColumnModel2 {
	/**
	 * Name of Object.
	 *
	 * @var string $mName
	 */
	private $mName = null;
	/**
	 * Type of Object.
	 *
	 * @var string $mType
	 */
	private $mType = null;
	/**
	 * column is pirmary key of Object.
	 *
	 * @var boolean $mPK
	 */
	private $mPK = false;
	/**
	 * keyword of Object.
	 *
	 * @var array $mFlags
	 */
	private $mFlags = array ();
	/**
	 * Size column of Object.
	 *
	 * @var integer $mSize
	 */
	private $mSize = null;
	/**
	 * Name of Object.
	 *
	 * @var string $mName
	 */
	private $mDefault = null;
	/**
	 * value of Object.
	 *
	 * @var string $mValue
	 */
	private $mValue = "";
	/**
	 * default value of Object.
	 *
	 * @var string $mDefaultValue
	 */
	private $mDefaultValue = "";
	/**
	 * Object be Auto column.
	 *
	 * @var boolean $mIsAuto
	 */
	private $mIsAuto = false;

	/**
	 * column had change value.
	 *
	 * @var boolean $mChange
	 */
	private $mChanged = false;

	/**
	 *
	 * @param
	 *        	boolean
	 */
	public function setIsAuto($b) {
		$this->mIsAuto = ( bool ) $b;
	}

	/**
	 *
	 * @return Boolean
	 */
	private function getIsAuto() {
		return $this->mIsAuto;
	}
	public function isAuto() {
		return ( bool ) $this->mIsAuto;
	}

	/**
	 *
	 * @return Array
	 */
	public function getFieldFlag() {
		return $this->mFlags;
	}

	/**
	 * Return
	 *
	 * @return string
	 */
	public function getDefault() {
		return $this->mDefault;
	}

	/**
	 * Return field size or size of column
	 *
	 * @return Integer
	 */
	public function getFieldSize() {
		return $this->mSize;
	}

	/**
	 * Return field name
	 *
	 * @return string
	 */
	public function getFieldName() {
		return $this->mName;
	}

	/**
	 * Return type of field
	 *
	 * @return string
	 */
	public function getFieldType() {
		return $this->mType;
	}

	/**
	 * Return value of column
	 *
	 * @return string
	 */
	public function getFieldValue() {
		return $this->mValue;
	}

	/**
	 * Return flag to check column are changed.
	 *
	 * @return boolean
	 */
	public function getChanged() {
		return $this->mChanged;
	}

	/**
	 *
	 * @param boolean $b
	 */
	public function setChanged($b) {
		$this->mChanged = $b;
	}

	/**
	 *
	 * @param string $s
	 */
	public function setFieldValue($s) {
		$this->mValue = $s;
	}

	/**
	 *
	 * @param string $s
	 */
	public function setDefaultFieldValue($s) {
		$this->mDefaultValue = $s;
	}

	/**
	 *
	 * @return string
	 */
	public function getDefaultFieldValue() {
		return $this->mDefaultValue;
	}

	/**
	 *
	 * @return Boolean
	 */
	private function getPK() {
		return $this->mPK;
	}

	public function isPK() {
		return $this->getPK ();
	}

	/**
	 *
	 * @param Boolean $b
	 * @return void
	 */
	public function setPK($b) {
		$this->mPK = $b;
	}
	public function isAutoKey() {
		$b_ = false;
		foreach ( $this->mFlags as $k => $v ) {
			if ($v == 'auto_increment') {
				$b_ = true;
				break;
			}
		}

		return $b_;
	}

	/**
	 *
	 * @param string $strFlag
	 */
	public function setFieldFlag($f) {
		$this->mFlags = @explode ( " ", $f );
	}

	/**
	 * Return can be null on filed.
	 *
	 * @return boolean
	 */
	public function isNotNull() {
		$b_ = false;
		foreach ( $this->mFlags as $k => $v ) {
			if ($v == 'not_null') {
				$b_ = true;
				break;
			}
		}
		return $b_;
	}

	/**
	 *
	 * @param string $strDefault
	 */
	public function setDefault($s) {
		$this->mDefault = $s;
	}

	/**
	 *
	 * @param integer $intSize
	 * @return void
	 */
	public function setFieldSize($i) {
		$this->mSize = $i;
	}

	/**
	 *
	 * @param string $s
	 * @return void
	 */
	public function setFieldName($s) {
		$this->mName = $s;
	}

	/**
	 *
	 * @param string $s
	 * @return void
	 */
	public function setFieldType($s) {
		$this->mType = $s;
	}
}
final class RecordModel2{

	/**
	 *
	 * @var array
	 */
	private $mRecords = array ();

	/**
	 *
	 * @var ColumnSetModel
	 */
	private $mMetaRecord = array ();

	/**
	 * return numbe
	 *
	 * @return integer
	 */
	function countRecord() {
		return count ( $this->mRecords );
	}

	/**
	 * Add column set to record model.
	 *
	 * @param ColumnSetModel $oCSM
	 * @return void
	 */
	public function addRecord(ColumnSetModel $oCSM) {
		$this->mRecords [] = $oCSM;
	}

	/**
	 * return column set model.
	 *
	 * @return ColumnSetModel
	 */
	public function getColumns() {
		return $this->mRecords [0];
	}

	/**
	 * Get array of RecordSetModel.
	 *
	 * @return array
	 */
	public function getAllRecordSet() {
		return $this->mRecords;
	}

	/**
	 * Get RecordSetModel
	 *
	 * @param
	 *        	integer
	 * @return RecordSetModel
	 */
	public function getRecordSet($i) {
		return $this->mRecords [$i];
	}

	/**
	 *
	 * @param ColumnSetModel $oCol
	 */
	public function setMetaRecord(ColumnSetModel $oCol) {
		$this->metaRecord = $oCol;
	}
	public function cloneMetaRecord() {
		return $this->metaRecord;
	}

	/**
	 * return meta record model in current record set model for create new
	 * record model.
	 *
	 * @return RecordModel
	 */
	public function getMetaRecord() {
		return $this->metaRecord;
	}

	/**
	 * return all record model in current record set model.
	 *
	 * @return void
	 */
	public function getRecords() {
		return $this->mRecords;
	}

	/**
	 * return record model of record set model
	 *
	 * @param string $k
	 * @return RecordModel
	 */
	public function getRecord($k) {
		$o_ = null;
		if (array_key_exists ( $k, $this->mRecords )) {
			$o_ = $this->mRecords [$k];
		}
		return $o_;
	}

	/**
	 * Add new record to temp record set.
	 *
	 * @return void
	 */
	public function newRecord(ColumnSetModel $o_c) {
		$this->mRecords = array ();
		$this->mRecords [] = $o_c;
	}

	/**
	 * return memory to system.
	 *
	 * @return void
	 */
	public function freeRecords() {
		$this->mRecords = array ();
	}

	/**
	 * remove record on object record set.
	 *
	 * @return void
	 */
	public function removeRecord($key) {
		unset ( $this->mRecords [$key] );
	}
}

/**
 * DataModel Class
 */
abstract class DataModel2 {

	/**
	 * Object to get record model.
	 *
	 * @var RecordModel
	 */
	private $mRecordSet = null;

	/**
	 * Keep last query command
	 * @var string
	 */
	private $mQueryCommand = null;

	/**
	 * Number of column set.
	 *
	 * @var integer
	 */
	private $mCountColumn = 0;

	/**
	 * Index of record
	 *
	 * @var integer
	 */
	private $mCursor = - 1;

	/**
	 * Type of Database.
	 *
	 * @var string
	 */
	private $sDatabaseType = "";

	/**
	 * Name of table to create Datamodel
	 *
	 * @var string
	 */
	private $mTable = "";

	/**
	 * Name of Primary Key
	 *
	 * @var string $mPK
	 */
	private $mPK = "";

	/**
	 * option of field on table.
	 *
	 * @var array
	 */
	private $aPropertyType = array ();

	/**
	 * Uri path of database config
	 *
	 * @var string
	 */
	private $sDbConfigPath = "";

	/**
	 * Primary key is auto-increment field.
	 *
	 * @var boolean
	 */
	private $mPkIsAuto = false;

	/**
	 * Relative to other table on field.
	 *
	 * @var string
	 */
	private $mOnKey = null;

	/**
	 * Parent object
	 *
	 * @var DataModel
	 */
	private $mParent = null;

	/**
	 * This object is parrent.
	 *
	 * @var boolean
	 */
	private $mIsParrent = false;

	/**
	 * Is child node object
	 *
	 * @var boolean
	 */
	private $mIsChild = false;

	/**
	 * Is query command or store procedure
	 *
	 * @var boolean
	 */
	private $mIsView = false;

	/**
	 *
	 * @var array
	 */
	private $mChilds = array ();
	/**
	 * @return the $mQueryCommand
	 */
	public final function getQueryCommand() {
		return $this->mQueryCommand;
	}

	/**
	 * @param string $mQueryCommand
	 */
	public final function setQueryCommand($mQueryCommand) {
		$this->mQueryCommand = $mQueryCommand;
	}

	function __construct($sc, $sTable, $sPK, $isView = false) {
		$this->mRecordSet = new RecordModel ();
		$this->SetTable ( $sTable );
		$this->mPK = $sPK;
		$this->mIsView = $isView;
		$this->setDbConfigPath ( $sc );
		$this->getListProperty ();
	}
	protected function setDbConfigPath($sC) {
		$this->sDbConfigPath = $sC;
	}
	protected function getDbConfigPath() {
		return $this->sDbConfigPath;
	}

	/**
	 *
	 * @return Ambigous <Database, NULL, MySql, MsSql, Oracle, Posgress, Access>
	 */
	private function dbConnection() {
		/**
		 *
		 * @var DBConfig
		 */
		$configs = new DBConfig ( $this->getDbConfigPath () );

		/**
		 *
		 * @var DBProvider
		 */
		$o_db = DBProvider::newDbProvide ( $configs->getDbType () );

		/* this object are from database type (read from config file). */
		$this->sDatabaseType = $configs->getDbType ();

		/* assign value for database config need to connect to servier */
		$o_db->strDatabaseName = $configs->getDbName (); // database name
		$o_db->strServerName = $configs->getDbServer (); // server name
		$o_db->strUserName = $configs->getDbUsername (); // username
		$o_db->strUserPassword = $configs->getDbPassword (); // user password

		$o_db->openConnection ();

		return $o_db;
	}

	/**
	 * defind belong table on this object.
	 *
	 * @param array $k
	 * @example
	 *          [Object]->setBelong(array('table_name'=>'tbl_example','on'=>'pk_id'));
	 * @deprecated
	 *
	 *
	 */
	public function belong_to($k) {
		print $s_cn = "find" . strtoupper ( substr ( $k, 0, 1 ) ) . substr ( $k, 1, strlen ( $k ) - 1 );

		eval ( " function {$s_cn}(){
		\$b_ = false;
		\$this->mRecordSet->freeRecords ();\$this->freeCursor();
		\$strSql = \"SELECT * FROM {\$this->mTable} INNER JOIN {$k} on {\$this->mTable}.id={$k} WHERE {\$s} ;\";
		\$this->findQuery ( \$strSql );
		return \$b_;
		}" );
	}

	/**
	 * Defind relate table on this object.
	 *
	 * @param array $k
	 * @example
	 *          [Object]->relateTo(array('path_config'=>'configdb.xml','table_name'=>'tbl_example','pk'=>'id'));
	 */
	public function relateTo($k) {
		$s_cn = strtoupper ( substr ( $k ['table_name'], 0, 1 ) ) . substr ( $k ['table_name'], 1, strlen ( $k ['table_name'] ) - 1 );
		if (! class_exists ( $s_cn )) {
			eval ( "final class {$s_cn} extends DataModel { function __construct() { parent::__construct ( '{$k['path_config']}','{$k['table_name']}','{$k['pk']}' );  \$this->mIsChild = true; }} " );
		}

		$this->$k ['table_name'] = new $s_cn ();
		$this->$k ['table_name']->mParent = $this;
		$this->mIsParrent = true;
	}

	/**
	 * Defind relative DataModel object on this object.
	 *
	 * @param DataModel $dm
	 * @param string $s
	 * @example [Object]->relateTo(DataModel $dm [,"name_variable"]);
	 */
	public function addRelative(DataModel $dm, $s = null, $_OnKey = null) {
		if ($s == null) {
			$s = $dm->getTable ();
		}

		if ($_OnKey == null) {
			$_OnKey = $dm->getPkFieldName ();
		}

		$this->$s = $dm;
		$this->$s->mOnKey = $_OnKey;
		$this->$s->mParent = $this;
		$this->mIsParrent = true;
	}

	/**
	 * Defind relative DataModel object on this object.
	 *
	 * @param DataModel $dm
	 * @param string $s
	 * @example [Object]->hasOne(DataModel $dm [,"name_variable"]);
	 */
	public function hasOne(DataModel $dm, $s = null, $_OnKey = null) {
		if ($s == null) {
			$s = $dm->getTable ();
		}

		if ($_OnKey == null) {
			$_OnKey = $dm->getPkFieldName ();
		}

		$this->$s = $dm;
		$this->$s->mOnKey = $_OnKey;
		$this->$s->mParent = $this;

		$this->mIsParrent = true;
	}

	/**
	 * Defind relative DataModel object on this object.
	 *
	 * @param DataModel $dm
	 * @param string $s
	 * @example [Object]->hasMany(DataModel $dm [,"name_variable"]);
	 */
	public function hasMany(DataModel $dm, $s = null, $_OnKey = null) {
		if ($s == null) {
			$s = $dm->getTable ();
		}

		if ($_OnKey == null) {
			$_OnKey = $dm->getPkFieldName ();
		}
		$this->$s = $dm;
		$this->$s->mOnKey = $_OnKey;
		$this->$s->mParent = $this;

		$this->mIsParrent = true;
	}

	/**
	 * Return table name.
	 *
	 * @return string
	 */
	public function getTable() {
		return $this->mTable;
	}

	/**
	 * Assign table name to create Datamodel object.
	 *
	 * @param string $s
	 * @return void
	 */
	public function setTable($s) {
		$this->mTable = $s;
	}

	/**
	 * Return is view (true|false).
	 *
	 * @return boolean
	 */
	public function getIsView() {
		return $this->mIsView;
	}

	/**
	 * Assign is view flag to datamodel object for set sign to read only.
	 *
	 * @param boolean $s
	 * @return void
	 */
	public function setIsView($b) {
		$this->mIsView = ( boolean ) $b;
	}

	/**
	 * Enter description here .
	 *
	 * ..
	 *
	 * @param boolean $b
	 */
	public function pkIsAuto($b) {
		$this->mPkIsAuto = ( bool ) $b;
	}

	/**
	 * Return true or false if Primary key is auto .
	 *
	 * ..
	 *
	 * @return boolean
	 */
	public function getPkIsAuto() {
		return ( bool ) $this->mPkIsAuto;
	}

	/**
	 * Return boolean to check variable to is declared.
	 *
	 * @param string $k
	 * @return boolean
	 */
	public function __isset($k) {
		$b_ = false;
		if ($this->mRecordSet->getMetaRecord ()->getColumn ( $k ) != null) {
			$b_ = true;
		}
		return $b_;
	}

	/**
	 * Return boolean to check variable to is declared.
	 *
	 * @param string $k
	 * @return boolean
	 */
	public function __hadColumn($k) {
		return $this->__isset ( $k );
	}

	/**
	 * Return value of object by entry column name.
	 *
	 * @param string $k
	 * @return String
	 */
	public function getValue($k) {
		/**
		 *
		 * @var String
		 */
		$o_ = new String ();
		if (! ($this->getCursor () == - 1) || $this->countRecord () - 1 < $this->getCursor ()) {
			if ($this->__isset ( $k )) {
				$o_->setChar ( $this->mRecordSet->getRecord ( $this->getCursor () )->getColumn ( $k )->getFieldValue () );
			}
		}
		return $o_->getChar();
	}


	/**
	 * Return value of object by entry column name from findQuery method.
	 *
	 * @param string $k
	 * @return String
	 */
	public function getValueCustomQuery($k) {
		/**
		 *
		 * @var String
		 */
		$o_ = new String ();
		if (! ($this->getCursor () == - 1) || $this->countRecord () - 1 < $this->getCursor ()) {
			$o_->setChar ( $this->mRecordSet->getRecord ( $this->getCursor () )->getColumn ( $k )->getFieldValue () );
		}

		return $o_->getChar ();
	}

	/**
	 * Set value from developer define to column model object on record model.
	 *
	 * @param string $k
	 *        	Column name
	 * @param string $s
	 *        	Value to set on column
	 * @return void
	 */
	private function setAssignValue($k, $s = null) {
		if ($this->__isset ( $k )) {
			$this->mRecordSet->getRecord ( $this->getCursor () )->getColumn ( $k )->setFieldValue ( $s );
		}
	}

	/**
	 * Return recordModel on Datamodel object.
	 *
	 * @return RecordModel
	 */
	private function getRecord() {
		return $this->mRecordSet->getRecord ( $this->getCursor () );
	}

	/**
	 * Set index of list value on record set.
	 *
	 * @param integer $i
	 *        	index of record set
	 * @return void
	 */
	protected function setCursor($i) {
		$this->mCursor = $i;
	}

	/**
	 * Return cursor position on record set.
	 *
	 * @return integer
	 */
	protected function getCursor() {
		return $this->mCursor;
	}
	protected function freeCursor() {
		$this->mCursor = - 1;
	}

	/**
	 * Set cursor to object.
	 *
	 * @param integer $i_r
	 *        	index of record
	 */
	public function goToRecord($i_r) {
		$this->setCursor ( $i_r );
	}

	/**
	 * Set cursor to object.
	 *
	 * @param integer $i_r
	 *        	index of record
	 */
	public function goToFirstRecord() {
		$this->setCursor ( - 1 );
	}

	/**
	 * Move cursor next 1 position
	 *
	 * @return boolean
	 */
	public function moveNextRecord() {
		$b_ = false;
		if ($this->getCursor () < ($this->countRecord () - 1)) {
			$this->setCursor ( $this->getCursor () + 1 );
			$b_ = true;
		}
		return $b_;
	}

	/**
	 * Move cursor back 1 position
	 *
	 * @return boolean
	 */
	public function moveBackRecord() {
		$b_ = false;
		if ($this->getCursor () > (- 1)) {
			$this->setCursor ( $this->getCursor () - 1 );
			$b_ = true;
		}
		return $b_;
	}

	/**
	 * Cursor is on position start of record true or false
	 *
	 * @return boolean
	 */
	public function isBeginOfRecord() {
		$b_ = false;
		if ($this->getCursor () == 0) {
			$b_ = true;
		}
		return $b_;
	}

	/**
	 * Cursor is on position end of record true or false
	 *
	 * @return boolean
	 */
	public function isEndOfRecord() {
		$b_ = false;
		if ($this->getCursor () >= ($this->countRecord () - 1)) {
			$b_ = true;
		}
		return $b_;
	}

	/**
	 * Set value to view column
	 * @param string $k
	 * @param string $s
	 */
	public function setValue($k, $s) {
		if ($this->__isset ( $k )) {
			$this->goToRecord ( 0 );
			$this->mRecordSet->getRecord ( $this->getCursor () )->getColumn ( $k )->setFieldValue ( $s );
			$this->mRecordSet->getRecord ( $this->getCursor () )->getColumn ( $k )->setChanged ( true );
		}
	}

	/**
	 * กำหนดรายละเอียดของคอลัมน์ให้กับ วัตถุ
	 * return void
	 */
	private function getListProperty() {
		$configs = new DBConfig ( $this->getDbConfigPath () );
		$o_db = $this->dbConnection ();
		if ($o_db->intState == 1) {
			$o_db->selectDatabase ();

			switch (strtolower ( $configs->getDbType () )) {
				case DB_MYSQL :
					$o_db->executeQuery ( "select * from {$this->mTable} limit 0,1" );
					break;
				case DB_MSSQL :
					$o_db->executeQuery ( "select top 1 * from {$this->mTable}" );
					break;
				case DB_ODBC :
					$o_db->executeQuery ( "select top 1 * from {$this->mTable}" );
					break;
				case DB_POSGRESS :
					$o_db->executeQuery ( "select top 1 * from {$this->mTable}" );
					break;
				case DB_ORACLE :
					$o_db->executeQuery ( "select top 1 * from {$this->mTable}" );
					break;
			}

			$_csm = new ColumnSetModel ();
			$this->mCountColumn = $o_db->countField ();
			for($_i_cm = 0; $_i_cm < $o_db->countField (); $_i_cm ++) {
				$keyName = $o_db->fieldName ( $_i_cm );
				$_cm = new ColumnModel ();
				$_cm->setFieldFlag ( $o_db->fieldFlag ( $_i_cm ) );
				$_cm->setFieldName ( $o_db->fieldName ( $_i_cm ) );
				$_cm->setFieldType ( $o_db->fieldType ( $_i_cm ) );
				$_cm->setFieldSize ( $o_db->fieldSize ( $_i_cm ) );

				if ($this->mPK == $keyName) {
					$_cm->setPK ( true );
					$this->mPkIsAuto = $_cm->isAutoKey ();
				}

				$_cm->isAuto ();
				$_csm->addColumn ( $_cm );
			}
			$this->mRecordSet->setMetaRecord ( $_csm );
		}
		$o_db->close ();
	}

	final public function buildMethodName($s) {
		$fieldName = new String ( $s );
		$nName = null;
		$word = $fieldName->split ( '_' );

		for($i = 0; $i < count ( $word ); $i ++) {
			$tName = "";
			for($j = 0;$j < strlen($word[$i]); $j++){
				if($j==0){
					$tName .=  strtoupper($word[$i][$j]) ;
				}else{
//					$tName .=  strtolower($word[$i][$j]) ;
					$tName .=  $word[$i][$j] ;
				}
			}
			$nName .= $tName;
		}
		return $nName;
	}

	/**
	 * สร้างแถวข้อมูลใหม่
	 *
	 * @return void
	 * @throws Exception
	 */
	public function newRecord() {
		if ($this->mIsView == false) {
			$this->freeCursor ();
			$configs = new DBConfig ( $this->getDbConfigPath () );
			$o_db = $this->dbConnection ();
			if ($o_db->intState == 1) {
				$o_db->selectDatabase ();

				if ($configs->getDbType () == DB_MYSQL)
					$o_db->executeQuery ( "select * from {$this->mTable} limit 0,1" );

				if ($configs->getDbType () == DB_MSSQL)
					$o_db->executeQuery ( "select top 1 * from {$this->mTable}" );

				if ($configs->getDbType () == DB_ORACLE)
					$o_db->executeQuery ( "select top 1 * from {$this->mTable}" );

				$_csm = new ColumnSetModel ();
				for($_i_cm = 0; $_i_cm < $o_db->countField (); $_i_cm ++) {
					$keyName = $o_db->fieldName ( $_i_cm );
					$_cm = new ColumnModel ();
					$_cm->setFieldFlag ( $o_db->fieldFlag ( $_i_cm ) );
					$_cm->setFieldName ( $o_db->fieldName ( $_i_cm ) );
					$_cm->setFieldType ( $o_db->fieldType ( $_i_cm ) );
					$_cm->setFieldSize ( $o_db->fieldSize ( $_i_cm ) );
					if ($this->mPK == $keyName) {
						$_cm->setPK ( true );
					}

					$_csm->addColumn ( $_cm );
				}
				$this->mRecordSet->newRecord ( $_csm );
			}
			/* close database connection */
			$o_db->close ();
		} else {
			throw new Exception ( __CLASS__ . " can't to use " . __METHOD__ . " : because this is view datamodel.", 1050 );
		}
	}

	/**
	 * Find data on table return data in format xml.
	 *
	 * @param string $s_sql
	 * @return array
	 */
	private function query_command($s_sql) {
		$o_db = $this->dbConnection ();

		if ($o_db->intState == 1) {
			$o_db->selectDatabase ();
			$o_db->executeQuery ( $s_sql );
			$this->setQueryCommand($s_sql);
			if ($o_db->countRecord () > 0) {
				for($i_index_row = 0; $i_index_row < $o_db->countRecord (); $i_index_row ++) {
					$_csm = new ColumnSetModel ();
					for($_i_cm = 0; $_i_cm < $o_db->countField (); $_i_cm ++) {
						$_cm = new ColumnModel ();
						$_cm->setFieldFlag ( $o_db->fieldFlag ( $_i_cm ) );
						$_cm->setFieldName ( $o_db->fieldName ( $_i_cm ) );
						$_cm->setFieldType ( $o_db->fieldType ( $_i_cm ) );
						$_cm->setFieldSize ( $o_db->fieldSize ( $_i_cm ) );
						$_cm->setFieldValue ( $o_db->indexGrid ( $i_index_row, $o_db->fieldName ( $_i_cm ) ) );
						$_cm->setDefaultFieldValue ( $o_db->indexGrid ( $i_index_row, $o_db->fieldName ( $_i_cm ) ) );
						$_csm->addColumn ( $_cm );
					}
					$this->mRecordSet->addRecord ( $_csm );

				}

			}
		}

		$o_db->close ();
	}

	/**
	 * Call Store Procedure.
	 *
	 * @param string $s
	 * @return array
	 */
	private function storeProcedure($s) {
		$o_db = $this->dbConnection ();

		if ($o_db->intState == 1) {
			$o_db->selectDatabase ();
			$o_db->executeQuery ( "call " .$s );
			$this->setQueryCommand($s);
			if ($o_db->countRecord () > 0) {
				for($i_index_row = 0; $i_index_row < $o_db->countRecord (); $i_index_row ++) {
					$_csm = new ColumnSetModel ();
					for($_i_cm = 0; $_i_cm < $o_db->countField (); $_i_cm ++) {
						$_cm = new ColumnModel ();
						$_cm->setFieldFlag ( $o_db->fieldFlag ( $_i_cm ) );
						$_cm->setFieldName ( $o_db->fieldName ( $_i_cm ) );
						$_cm->setFieldType ( $o_db->fieldType ( $_i_cm ) );
						$_cm->setFieldSize ( $o_db->fieldSize ( $_i_cm ) );
						$_cm->setFieldValue ( $o_db->indexGrid ( $i_index_row, $o_db->fieldName ( $_i_cm ) ) );
						$_cm->setDefaultFieldValue ( $o_db->indexGrid ( $i_index_row, $o_db->fieldName ( $_i_cm ) ) );
						$_csm->addColumn ( $_cm );
					}

					$this->mRecordSet->addRecord ( $_csm );
				}
			}
		}

		$o_db->close ();
	}

	/**
	 * insert update delete
	 *
	 * @param string $s_sql
	 * @return boolean
	 */
	private function update_command($s_sql) {
		$b_operate = false;
		/**
		 *
		 * @var Database
		 */
		$o_db = $this->dbConnection ();

		if ($o_db->intState == 1) {
			$o_db->selectDatabase ();
			$i_effect_rows = ( integer ) $o_db->executeUpdate ( $s_sql );
			$this->setQueryCommand($s_sql);
			if ($i_effect_rows > 0) {
				$b_operate = true;
			}
		}
		$o_db->close ();
		return $b_operate;
	}

	/**
	 * Return String and added seperater
	 *
	 * @param array $arr
	 * @param string $seperate
	 * @param string $prefix
	 * @param string $subfix
	 *
	 * @return string
	 */
	private function joinInsert($arr, $seperate = ",", $prefix = "", $subfix = "") {
		$str = "";
		if (is_array ( $arr )) {
			$s_arr = "";
			$intLength = count ( $arr );
			$i = 0;
			foreach ( $arr as $key => $values ) {
				$i ++;

				if ($values->isAutoKey ()) {
					continue;
				}
				if ($i == $intLength) {
					$s_arr .= $prefix . $values->getFieldName () . $subfix;
				} else {
					$s_arr .= $prefix . $values->getFieldName () . $subfix . $seperate;
				}
			}

			$str .= $s_arr;
		}
		return $str;
	}

	/**
	 * Return string and added seperater
	 *
	 * @param array $arr
	 * @param string $seperate
	 * @param string $prefix
	 * @param string $subfix
	 *
	 * @return string
	 */
	private function joinUpdate($arr, $seperate = ",", $prefix = "", $subfix = "") {
		$str = "";
		if (is_array ( $arr )) {
			$s_arr = "";
			$intLength = count ( $arr );
			$i = 0;
			foreach ( $arr as $key => $values ) {
				$i ++;
				if ($values->isAutoKey ()) {
					continue;
				}
				if ($i == $intLength) {
					$s_arr .= $values->getFieldName () . "=" . $prefix . $values->getFieldName () . $subfix;
				} else {
					$s_arr .= $values->getFieldName () . "=" . $prefix . $values->getFieldName () . $subfix . $seperate;
				}
			}
			$str .= $s_arr;
		}
		return $str;
	}

	/**
	 * Save data to database.
	 *
	 * @return boolean
	 */
	public function saveRecord() {
		$_b = false;
		/* if this object is view throw exception */
		if ($this->mIsView == false) {

			$o_sql_cmd = new PreStatement ();
			$o_db = $this->dbConnection ();
			$_typeFiled = PreStatement::$CHARACTOR;
			$a = array ();

			foreach ( $this->mRecordSet->getRecord ( $this->getCursor () )->getColumns () as $kin => $v ) {
				if ($v->getDefaultFieldValue () != $v->getFieldValue ()) {
					$a [] = $v;
				}
			}

			$strSql = "INSERT INTO {$this->mTable}({$this->joinInsert ($a)}) values ({$this->joinInsert ( $a, ",", "<",">" )});";
			$o_sql_cmd->setSql ( $strSql );
			foreach ( $this->mRecordSet->getRecord ( $this->mRecordSet->countRecord () - 1 )->getColumns () as $key => $v ) {

				if ($this->mPK == $v->getFieldName ()) {
					if ($this->getPkIsAuto () == false) {
						if (($v->isNotNull () && $v->getFieldValue () == null)) {
							print __CLASS__ . ' ERROR : ' . $v->getFieldName () . ' IS NOT BE NULL.';
							exit ();
						}
					}
				} else {
					if (($v->isNotNull () && $v->getFieldValue () == null)) {
						print __CLASS__ . ' ERROR : ' . $v->getFieldName () . ' IS NOT BE NULL.';
						exit ();
					}
				}

				switch (strtolower ( $v->getFieldType () )) {
					case 'int' :
						$_typeFiled = PreStatement::$NUMERIC;
						break;
					case 'string' :
						$_typeFiled = PreStatement::$CHARACTOR;
						break;
					case 'datetime' :
						$_typeFiled = PreStatement::$DATETIME;
						break;
					default :
						$_typeFiled = PreStatement::$CHARACTOR;
				}

				$o_sql_cmd->setValue ( $v->getFieldName (), $o_db->escapeValue ( $v->getFieldValue () ), $_typeFiled );
			}

			$_b = $this->update_command ( $o_sql_cmd->parseSQL () );
		} else {
			throw new Exception ( __CLASS__ . " can't to use " . __METHOD__ . " : because this is view datamodel.", 1050 );
		}

		return $_b;
	}

	/**
	 * Save data to database.
	 *
	 * @param string $s
	 * @param boolen $_force_update
	 * @example [Object]->updateRecord("id=5"[,true]); or
	 *          [Object]->updateRecord("id=5"[,false]); or
	 *          [Object]->updateRecord("id=5"); or [Object]->updateRecord();
	 * @return boolean
	 */
	public function updateRecord($s = null) {
		$_b = false;

		/* if this object is view throw exception */
		if ($this->mIsView == false) {

			if ($s == "" || $s == null)
				$s = $this->mPK . " = <" . $this->mPK . ">";

			$o_sql_cmd = new PreStatement ();
			$o_db = $this->dbConnection ();
			$_typeFiled = PreStatement::$CHARACTOR;
			$a = array ();

			foreach ( $this->mRecordSet->getRecord ( $this->getCursor () )->getColumns () as $kin => $v ) {

				// if ($v->getDefaultFieldValue () != $v->getFieldValue ()) {
				if ($v->getChanged ()) {

					$a [] = $v;
				}
			}

			$strSql = "UPDATE {$this->mTable} SET {$this->joinUpdate ( $a,",", "<",">" )} where {$s};";

			$o_sql_cmd->setSql ( $strSql );

			foreach ( $this->mRecordSet->getRecord ( $this->getCursor () )->getColumns () as $kin => $v ) {
				if (($v->isNotNull () && $v->getFieldValue () == null)) {
					print __CLASS__ . ' ERROR : ' . $v->getFieldName () . ' IS NOT BE NULL.';
					exit ();
				}

				switch (strtolower ( $v->getFieldType () )) {
					case 'int' :
						$_typeFiled = PreStatement::$NUMERIC;
						break;
					case 'string' :
						$_typeFiled = PreStatement::$CHARACTOR;
						break;
					case 'datetime' :
						$_typeFiled = PreStatement::$DATETIME;
						break;
					default :
						$_typeFiled = PreStatement::$CHARACTOR;
				}

				$o_sql_cmd->setValue ( $v->getFieldName (), $o_db->escapeValue ( $v->getFieldValue () ), $_typeFiled );
			}

			$_b = $this->update_command ( $o_sql_cmd->parseSQL () );
		} else {
			throw new Exception ( __CLASS__ . " can't to use " . __METHOD__ . " : because this is view datamodel.", 1050 );
		}
		return $_b;
	}

	/**
	 * Delete Data on database.
	 *
	 * @param string $strColumn
	 * @return boolean
	 * @throws Exception
	 */
	public function deleteRecord($s) {
		$b_ = false;

		/* if this object is view throw exception */
		if ($this->mIsView == false) {
			if ($this->update_command ( "DELETE FROM {$this->mTable} where {$s} ;" ) === true) {
				$b_ = true;
			} else {
				$b_ = false;
			}
		} else {
			throw new Exception ( __CLASS__ . " can't to use " . __METHOD__ . " : because this is view datamodel.", 1050 );
		}
		return $b_;
	}

	/**
	 * Find data on table by column
	 *
	 * @param string $w
	 * @param array $order_by
	 * @param integer $_limit_start
	 * @param integer $_limit_record
	 *
	 * @return Datamodel
	 *
	 * @example [Object]->findBy("c_id=3"); or [Object]->findBy("c_id=3","c_id
	 *          desc");
	 */
	public function findBy($w, $order_by = array(), $_limit_start = null, $_limit_record = null) {
		$s = "";
		$i = count ( $order_by );
		$ic = 0;
		if ($i > 0) {
			$odr = "";
			foreach ( $order_by as $b => $c ) {
				if($b != ""){
					$odr .= $b . " " . $c;
					$odr .= (($ic + 1) != $i) ? "," : "";
					$ic++;
				}
			}

			if($odr != "")
				$s .= " ORDER BY {$odr} ";
		}

		if ($this->sDatabaseType == DBProvider::$DB_MYSQL) {
			if (is_numeric ( $_limit_start ) && is_numeric ( $_limit_record )) {
				$s .= " LIMIT {$_limit_start}, {$_limit_record} ";
			}
		}

		$this->mRecordSet->freeRecords ();
		$this->freeCursor ();
		$this->query_command ( "SELECT * FROM {$this->mTable} WHERE ({$w}) {$s};" );

		return $this;
	}

	/**
	 * Find data on table by column
	 *
	 * @param integer $start
	 *        	start of number record on table
	 * @param integer $limit
	 *        	limit record from script can query
	 * @param string $where_course
	 *
	 * @return Datamodel
	 *
	 * @example [Object]->findTop(0,10[,"c_id=3"][,"c_id desc, c_name = desc"]);
	 */
	public function findTop($start, $limit, $where_course = null, $order_by = null) {
		$this->mRecordSet->freeRecords ();
		$this->freeCursor ();

		$sql = "SELECT * FROM {$this->mTable}";

		if ($where_course != null) {
			$sql = " WHERE {$where_course}";
		}

		if ($order_by != null) {
			$sql .= " ORDER BY {$order_by}";
		}

		$sql .= " LIMIT {$start},{$limit};";

		$this->query_command ( $sql );

		return $this;
	}

	/**
	 * Delete Data on database.
	 *
	 * @param string $strColumn
	 * @return boolean
	 */
	public function deleteRelateParent($s) {
		$b_ = false;
		$sql = "DELETE FROM {$this->mTable} WHERE $this->mPK = '" . $this->mParent->getValue ( $this->mParent->mPK ) . "';";
		if ($this->mOnKey != null) {
			$sql = "DELETE FROM {$this->mTable} WHERE $this->mOnKey = '" . $this->mParent->getValue ( $this->mOnKey ) . "';";
		}

		if ($this->update_command ( $sql ) === true) {
			$b_ = true;
		} else {
			$b_ = false;
		}
		return $b_;
	}

	/**
	 * Delete Data on database.
	 *
	 * @param string $strColumn
	 * @return boolean
	 */
	public function deleteRelate($s) {
		$b_ = false;
		$sql = "DELETE FROM {$this->mTable} WHERE $this->mOnKey = '" . $this->mParent->getValue ( $this->mParent->mPK ) . "';";
		if ($this->mOnKey != null) {

			$sql = "DELETE FROM {$this->mTable} WHERE $this->mOnKey = '" . $this->mParent->getValue ( $this->mOnKey ) . "';";
		}

		if ($this->update_command ( $sql ) === true) {
			$b_ = true;
		} else {
			$b_ = false;
		}
		return $b_;
	}

	/**
	 * Find data on table by column
	 *
	 * @param string $s
	 * @return Datamodel
	 *
	 * @example [Object]->findRelateParrent();
	 */
	public function findRelateParent() {
		$this->mRecordSet->freeRecords ();
		$this->freeCursor ();
		$strSql = "SELECT * FROM {$this->mTable} WHERE $this->mPK = '" . $this->mParent->getValue ( $this->mParent->mPK ) . "';";
		if ($this->mOnKey != null) {
			$strSql = "SELECT * FROM {$this->mTable} WHERE $this->mPK = '" . $this->mParent->getValue ( $this->mOnKey ) . "';";
		}

		$this->query_command ( $strSql );
		return $this;
	}

	/**
	 * Find data on table by column
	 *
	 * @param string $s
	 * @return Datamodel
	 *
	 * @example [Object]->findRelateParrent();
	 */
	public function findRelate() {
		$this->mRecordSet->freeRecords ();
		$this->freeCursor ();

		$strSql = "SELECT * FROM {$this->mTable} WHERE $this->mPK = '" . $this->mParent->getValue ( $this->mParent->mPK ) . "';";
		if ($this->mOnKey != null) {
			$strSql = "SELECT * FROM {$this->mTable} WHERE $this->mPK = '" . $this->mParent->getValue ( $this->mOnKey ) . "';";
		}

		$this->query_command ( $strSql );
		return $this;
	}

	/**
	 * Find first record and return one record.
	 *
	 * @param string $w
	 * @param array $order_by
	 *
	 * @return Datamodel
	 *
	 * @example [Object]->findFirst(array("c_id")); or
	 *          [Object]->findFirst("c_id=3",array("c_id"));
	 */
	public function findFirst($w = null, $order_by = array()) {
		$i = count ( $order_by );
		$ic = 0;
		$odr = "";
		if ($i > 0) {
			foreach ( $order_by as $b => $c ) {
				$odr .= $b . " asc";
				$odr .= (($ic + 1) != $i) ? "," : "";
			}
		} else {
			$odr = $this->mPK . " asc";
		}

		$_w = '';
		if ($w != null || $w != "") {
			$_w = "WHERE " . $w;
		}

		$this->mRecordSet->freeRecords ();
		$this->freeCursor ();
		$sql = "";
		if (strtolower ( $this->sDatabaseType ) == DB_MYSQL)
			$sql = "select * from {$this->mTable} {$_w} ORDER BY {$odr}  limit 0,1;";
		elseif (strtolower ( $this->sDatabaseType ) == DB_MSSQL)
			$sql = "select top 1 * from {$this->mTable} {$_w} ORDER BY {$odr} ";
		elseif (strtolower ( $this->sDatabaseType ) == DB_ODBC)
			$sql = "select top 1 * from {$this->mTable} {$_w} ORDER BY {$odr} ";
		elseif (strtolower ( $this->sDatabaseType ) == DB_POSGRESS)
			$sql = "select top 1 * from {$this->mTable} {$_w} ORDER BY {$odr} ";
		elseif (strtolower ( $this->sDatabaseType ) == DB_ORACLE)
			$sql = "select top 1 * from {$this->mTable} {$_w} ORDER BY {$odr} ";

		$this->query_command ( $sql );
		return $this;
	}

	/**
	 * Find first record and return one record.
	 *
	 * @param string $s
	 * @return integer
	 */
	public function countAllRecord() {
		$i_r = 0;
		$o_db = $this->dbConnection ();
		if ($o_db->intState == 1) {
			$o_db->selectDatabase ();
			$s_sql = "select count(*) all_record from {$this->mTable};";
			$o_db->executeQuery ( $s_sql );
			$i_r = $o_db->indexGrid ( 0, 'all_record' );
		}
		$o_db->close ();

		return ( integer ) $i_r;
	}

	/**
	 * Find last record and return one record.
	 *
	 * @param string $w
	 * @param array $order_by
	 *
	 * @return Datamodel
	 *
	 * @example [Object]->findFirst(array("c_id")); or
	 *          [Object]->findFirst("c_id=3",array("c_id"));
	 */
	public function findLast($w = null, $order_by = array()) {
		$i = count ( $order_by );
		$ic = 0;
		$odr = "";
		if ($i > 0) {
			foreach ( $order_by as $b ) {
				$odr .= $b . " desc";
				$odr .= (($ic + 1) != $i) ? "," : "";
			}
		} else {
			$odr = $this->mPK . " desc";
		}

		$_w = '';
		if ($w != null || $w != "") {
			$_w = "WHERE " . $w;
		}

		$this->mRecordSet->freeRecords ();
		$this->freeCursor ();
		$sql = "";
		if (strtolower ( $this->sDatabaseType ) == "mysql")
			$sql = "select * from {$this->mTable} {$_w} ORDER BY {$odr}  limit 0,1;";
		elseif (strtolower ( $this->sDatabaseType ) == "mssql")
			$sql = "select top 1 * from {$this->mTable} {$_w} ORDER BY {$odr} ";
		elseif (strtolower ( $this->sDatabaseType ) == "oracle")
			$sql = "select top 1 * from {$this->mTable} {$_w} ORDER BY {$odr} ";

		$this->query_command ( $sql );
		return $this;
	}

	/**
	 * Find all record and return one record.
	 *
	 * @param array $order_by
	 * @param int $_limit_start
	 * @param int $_limit_record
	 * @example $order['column_name'=>'ASC','column_name2'=>'DESC']
	 * @return Datamodel
	 */
	public function findAll($order_by = array(), $_limit_start = null, $_limit_record = null) {
		$s = "";
		$i = count ( $order_by );
		$ic = 0;
	if ($i > 0) {
			$odr = "";
	foreach ( $order_by as $b => $c ) {
				if($b != ""){
					$odr .= $b . " " . $c;
					$odr .= (($ic + 1) != $i) ? "," : "";
					$ic++;
				}
			}

			if($odr != "")
				 $s .= " ORDER BY {$odr} ";
		}

		if ($this->sDatabaseType == DBProvider::$DB_MYSQL) {
			if (is_numeric ( $_limit_start ) && is_numeric ( $_limit_record )) {
				$s .= " LIMIT {$_limit_start}, {$_limit_record} ";
			}
		}



		$this->mRecordSet->freeRecords ();
		$this->freeCursor ();

		if ($this->sDatabaseType == DB_MYSQL) {
			$this->query_command ( "SELECT * FROM {$this->mTable} {$s};" );
		} elseif ($this->sDatabaseType == DB_MSSQL) {
			$this->query_command ( "SELECT * FROM {$this->mTable} {$s}" );
		} elseif ($this->sDatabaseType == DB_ODBC) {
			$this->query_command ( "SELECT * FROM {$this->mTable} {$s}" );
		} elseif ($this->sDatabaseType == DB_POSGRESS) {
			$this->query_command ( "SELECT * FROM {$this->mTable} {$s}" );
		} elseif ($this->sDatabaseType == DB_ORACLE) {
			$this->query_command ( "SELECT * FROM {$this->mTable} {$s}" );
		}


		return $this;
	}

	/**
	 * Find by sql command.
	 *
	 * @param string $s
	 * @return Datamodel
	 */
	public function findQuery($s) {
		$this->mRecordSet->freeRecords ();
		$this->freeCursor ();
		$this->query_command ( $s );
		return $this;
	}

	/**
	 * call Store Procedure.
	 *
	 * @param string $s
	 * @return Datamodel
	 */
	public function callStoreProcedure($s) {
		$this->mRecordSet->freeRecords ();
		$this->freeCursor ();
		$this->storeProcedure( $s );
		return $this;
	}

	/**
	 *
	 * @return DataModel
	 */
	public function truncateTable(){
		if(!$this->getIsView()){
			$this->mRecordSet->freeRecords ();
			$this->freeCursor ();
			$this->query_command ( "truncate table {$this->getTable()}" );
		}

		return $this;
	}

	/**
	 * return number of current record set.
	 *
	 * @return integer
	 */
	public function countRecord() {
		return $this->mRecordSet->countRecord ();
	}

	/**
	 * return number of current record column set.
	 *
	 * @return integer
	 */
	public function countColumn() {
		return $this->mRecordSet->getMetaRecord ()->countColumn ();
	}

	/**
	 * return field name of column.
	 *
	 * @return string
	 */
	public function getFieldName($k) {
		return $this->mRecordSet->getMetaRecord ()->getColumnByIndex ( $k )->getFieldName ();
	}

	/**
	 * return field type of column.
	 *
	 * @return string
	 */
	public function getFieldType($k) {
		return $this->mRecordSet->getMetaRecord ()->getColumnByIndex ( $k )->getFieldType ();
	}

	/**
	 * Find by sql command.
	 *
	 * @param string $s
	 * @example [Object]->checkIsHad("id=5");
	 * @return integer
	 */
	public function checkIsHad($s) {
		$this->findBy ( $s );
		return $this->countRecord ();
	}

	/**
	 * return field name of primary key
	 * @return the $mPM
	 */
	public function getPkFieldName() {
		return $this->mPK;
	}

	/**
	 * set value field name of primary key
	 * @param string $s
	 */
	public function setPkFieldName($s) {
		$this->mPK = $s;
	}
}

?>