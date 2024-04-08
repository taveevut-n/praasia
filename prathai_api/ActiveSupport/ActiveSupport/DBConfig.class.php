<?php
class DBConfig extends Configuration {
}
class ProjectConfig extends DBConfig {

	/**
	 * Project name
	 *
	 * @var string
	 */
	private $mProjectName;

	/**
	 * Web root path
	 *
	 * @var string
	 */
	private $mWebRoot;

	/**
	 * Domain name etc.
	 * http://www.yourdomain.com
	 *
	 * @var string
	 */
	private $mDomainName;

	/**
	 * Owner project name
	 *
	 * @var string
	 */
	private $mProjectOnwerName;

	/**
	 * Owner project email
	 *
	 * @var string
	 */
	private $mProjectOnwerEmail;
	/**
	 *
	 * @var string
	 */
	private $mGoogleMapApi;
	/**
	 *
	 * @var string
	 */
	private $mSmtpHost;
	/**
	 *
	 * @var Integer
	 */
	private $mSmtpPort;
	/**
	 *
	 * @var string
	 */
	private $mSmtpPassword;
	/**
	 *
	 * @var string
	 */
	private $mSmtpUser;
	/**
	 *
	 * @var string
	 */
	private $mAdminName;
	/**
	 *
	 * @var string
	 */
	private $mAdminEmail;
	/**
	 *
	 * @var string
	 */
	private $mContactName;
	/**
	 *
	 * @var string
	 */
	private $mContactEmail;
	/**
	 *
	 * @var string
	 */
	private $mReplyName;
	/**
	 *
	 * @var string
	 */
	private $mReplyEmail;
	/**
	 *
	 * @var string
	 */
	private $mSupportName;
	/**
	 *
	 * @var string
	 */
	private $mSupportEmail;

	/**
	 * @return the $mAdminName
	 */
	public function getAdminName() {
		return $this->mAdminName;
	}

	/**
	 * @return the $mContactName
	 */
	public function getContactName() {
		return $this->mContactName;
	}

	/**
	 * @return the $mReplyName
	 */
	public function getReplyName() {
		return $this->mReplyName;
	}

	/**
	 * @return the $mSupportName
	 */
	public function getSupportName() {
		return $this->mSupportName;
	}

	/**
	 * @return the $mSupportEmail
	 */
	public function getSupportEmail() {
		return $this->mSupportEmail;
	}

	/**
	 * @param field_type $mAdminName
	 */
	public function setAdminName($mAdminName) {
		$this->mAdminName = $mAdminName;
	}

	/**
	 * @param field_type $mContactName
	 */
	public function setContactName($mContactName) {
		$this->mContactName = $mContactName;
	}

	/**
	 * @param field_type $mReplyName
	 */
	public function setReplyName($mReplyName) {
		$this->mReplyName = $mReplyName;
	}

	/**
	 * @param field_type $mSupportName
	 */
	public function setSupportName($mSupportName) {
		$this->mSupportName = $mSupportName;
	}

	/**
	 * @param field_type $mSupportEmail
	 */
	public function setSupportEmail($mSupportEmail) {
		$this->mSupportEmail = $mSupportEmail;
	}

	/**
	 *
	 * @return the $mAdminEmail
	 */
	public function getAdminEmail() {
		return $this->mAdminEmail;
	}

	/**
	 *
	 * @return the $mContactEmail
	 */
	public function getContactEmail() {
		return $this->mContactEmail;
	}

	/**
	 *
	 * @return the $mReplyEmail
	 */
	public function getReplyEmail() {
		return $this->mReplyEmail;
	}

	/**
	 *
	 * @param field_type $mAdminEmail
	 */
	public function setAdminEmail($mAdminEmail) {
		$this->mAdminEmail = $mAdminEmail;
	}

	/**
	 *
	 * @param field_type $mContactEmail
	 */
	public function setContactEmail($mContactEmail) {
		$this->mContactEmail = $mContactEmail;
	}

	/**
	 *
	 * @param field_type $mReplyEmail
	 */
	public function setReplyEmail($mReplyEmail) {
		$this->mReplyEmail = $mReplyEmail;
	}

	/**
	 *
	 * @return the $mSmtpPassword
	 */
	public function getSmtpPassword() {
		return $this->mSmtpPassword;
	}

	/**
	 *
	 * @return the $mSmtpUser
	 */
	public function getSmtpUser() {
		return $this->mSmtpUser;
	}

	/**
	 *
	 * @param string $mSmtpPassword
	 */
	public function setSmtpPassword($mSmtpPassword) {
		$this->mSmtpPassword = $mSmtpPassword;
	}

	/**
	 *
	 * @param string $mSmtpUser
	 */
	public function setSmtpUser($mSmtpUser) {
		$this->mSmtpUser = $mSmtpUser;
	}

	/**
	 *
	 * @return the $mSmtpHost
	 */
	public function getSmtpHost() {
		return $this->mSmtpHost;
	}

	/**
	 *
	 * @return the $mSmptPort
	 */
	public function getSmtpPort() {
		return (integer) $this->mSmtpPort;
	}

	/**
	 *
	 * @example ssl.hostname.com
	 * @param string $mSmtpHost
	 */
	public function setSmtpHost($mSmtpHost) {
		$this->mSmtpHost = $mSmtpHost;
	}

	/**
	 *
	 * @example 457
	 * @param string $mSmptPort
	 */
	public function setSmtpPort($mSmtpPort) {
		$this->mSmtpPort = (integer) $mSmtpPort;
	}

	/**
	 *
	 * @return string $mGoogleMapApi
	 */
	public function getGoogleMapApi() {
		return $this->mGoogleMapApi;
	}

	/**
	 *
	 * @param string $mGoogleMapApi
	 */
	public function setGoogleMapApi($mGoogleMapApi) {
		$this->mGoogleMapApi = $mGoogleMapApi;
	}

	/**
	 *
	 * @return the $mWebRoot
	 */
	public function getWebRoot() {
		return $this->mWebRoot;
	}

	/**
	 *
	 * @return the $mDomainName
	 */
	public function getDomainName() {
		return $this->mDomainName;
	}

	/**
	 *
	 * @param string $mWebRoot
	 */
	public function setWebRoot($mWebRoot) {
		$this->mWebRoot = $mWebRoot;
	}

	/**
	 *
	 * @param string $mDomainName
	 */
	public function setDomainName($mDomainName) {
		$this->mDomainName = $mDomainName;
	}

	/**
	 *
	 * @return the $mProjectName
	 */
	public function getProjectName() {
		return $this->mProjectName;
	}

	/**
	 *
	 * @return the $mProjectOnwerName
	 */
	public function getProjectOnwerName() {
		return $this->mProjectOnwerName;
	}

	/**
	 *
	 * @return the $mProjectOnwerEmail
	 */
	public function getProjectOnwerEmail() {
		return $this->mProjectOnwerEmail;
	}

	/**
	 *
	 * @param string $mProjectName
	 */
	public function setProjectName($mProjectName) {
		$this->mProjectName = $mProjectName;
	}

	/**
	 *
	 * @param string $mProjectOnwerName
	 */
	public function setProjectOnwerName($mProjectOnwerName) {
		$this->mProjectOnwerName = $mProjectOnwerName;
	}

	/**
	 *
	 * @param string $mProjectOnwerEmail
	 */
	public function setProjectOnwerEmail($mProjectOnwerEmail) {
		$this->mProjectOnwerEmail = $mProjectOnwerEmail;
	}
	function __construct($s) {
		parent::__construct ( $s );

		$oFP = new File ( $s );
		$oFP->openFile ( 'r' );
		$xml = new SimpleXMLElement ( $oFP->readTxt () );

		/* about project */
		$this->setProjectName ( $xml->project [0] ['name'] );
		$this->setDomainName ( $xml->domainname [0] ['name'] );
		$this->setWebRoot ( $xml->webroot [0] ['path'] );

		/* contact point */
		$this->setProjectOnwerName ( $xml->owner [0] ['name'] );
		$this->setProjectOnwerEmail ( $xml->owner [0] ['email'] );

		$this->setAdminName ( $xml->owner [0] ['admin_name'] );
		$this->setAdminEmail ( $xml->owner [0] ['admin_email'] );

		$this->setContactName ( $xml->owner [0] ['contact_name'] );
		$this->setContactEmail ( $xml->owner [0] ['contact_email'] );

		$this->setReplyName ( $xml->owner [0] ['reply_name'] );
		$this->setReplyEmail ( $xml->owner [0] ['reply_email'] );

		$this->setSupportName ( $xml->owner [0] ['support_name'] );
		$this->setSupportEmail ( $xml->owner [0] ['support_email'] );

		/* google api */
		$this->setGoogleMapApi ( $xml->google_map_api [0] ['key'] );

		/* smtp config */
		$this->setSmtpHost ( $xml->smtp [0] ['host'] );
		$this->setSmtpPort ( $xml->smtp [0] ['port'] );
		$this->setSmtpUser ( $xml->smtp [0] ['username'] );
		$this->setSmtpPassword ( $xml->smtp [0] ['password'] );
	}
}
abstract class Configuration {
	/**
	 * IP or Name of Database Server.
	 *
	 * @var string
	 */
	private $s_db_server;
	/**
	 * Username for connect Database Server.
	 *
	 * @var string
	 */
	private $s_db_username;
	/**
	 * password for connect Database Server.
	 *
	 * @var string
	 */
	private $s_db_password;
	/**
	 * Name of Database.
	 *
	 * @var string
	 */
	private $s_db_name;
	/**
	 * Type of Database.
	 *
	 * @var string
	 */
	private $s_db_type;
	/**
	 * Database Versoin.
	 *
	 * @var string
	 */
	private $s_db_version;

	/**
	 * __constructor, Entry xml file config name to this constructor.
	 *
	 * @param string $s
	 * @return void
	 */
	function __construct($s) {
		$oFP = new File ( $s );
		$oFP->openFile ( 'r' );
		$xml = new SimpleXMLElement ( $oFP->readTxt () );
		$config = $xml->database [0];
		// get config form xml file.
		$this->setDbServer ( $config ['server'] );
		// set Database server.
		$this->setDbPassword ( $config ['password'] );
		// set database password.
		$this->setDbUsername ( $config ['username'] );
		// set database username.
		$this->setDbName ( $config ['database_name'] );
		// set dataserver name or ip.
		$this->setDbType ( $config ['type'] );
		// set type of database.
		$this->setDbVersion ( $config ['version'] );
		// set database version.
	}

	/**
	 * Set Database server name to Object.
	 *
	 * @param string $s
	 * @return void
	 */
	public function setDbServer($s) {
		$this->s_db_server = $s;
	}

	/**
	 * Set database username to object.
	 *
	 * @param string $s
	 * @return void
	 */
	public function setDbUsername($s) {
		$this->s_db_username = $s;
	}

	/**
	 * Set database password to object.
	 *
	 * @param string $s
	 * @return void
	 */
	public function setDbPassword($s) {
		$this->s_db_password = $s;
	}

	/**
	 * Set database name to object.
	 *
	 * @param string $s
	 * @return void
	 */
	public function setDbName($s) {
		$this->s_db_name = $s;
	}

	/**
	 * Set database type to object.
	 *
	 * @param string $s
	 * @return void
	 */
	public function setDbType($s) {
		$this->s_db_type = $s;
	}

	/**
	 * Set database version to object.
	 *
	 * @param string $s
	 * @return void
	 */
	public function setDbVersion($s) {
		$this->s_db_version = $s;
	}

	/**
	 * Return database server name or ip
	 *
	 * @return string
	 */
	public function getDbServer() {
		return $this->s_db_server;
	}

	/**
	 * Return database username.
	 *
	 * @return string
	 */
	public function getDbUsername() {
		return $this->s_db_username;
	}

	/**
	 * Return database password.
	 *
	 * @return string
	 */
	public function getDbPassword() {
		return $this->s_db_password;
	}

	/**
	 * Return database name.
	 *
	 * @return string
	 */
	public function getDbName() {
		return $this->s_db_name;
	}

	/**
	 * Return database type.
	 *
	 * @return string
	 */
	public function getDbType() {
		return $this->s_db_type;
	}

	/**
	 * Return database version.
	 *
	 * @return string
	 */
	public function getDbVersion() {
		return $this->s_db_version;
	}
}
?>