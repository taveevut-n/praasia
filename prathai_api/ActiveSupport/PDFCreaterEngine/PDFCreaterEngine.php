<?php

/** 
 * @author Rewat Boonsit
 * 
 * 
 */
class PDFCreaterEngine {
/**
	 * Name of pdf file.
	 * @var string
	 */
	private $mPdfName;
	
	private $mPdfScale = "mm";
	
	/**
	 * __constructor, Entry xml file config name to this constructor.
	 * @param string $s 
	 * @return void
	 */
	function __construct($s) {		
		$oFP = new File ( $s );
		$oFP->openFile ( 'r' );
		$xml = new SimpleXMLElement ( $oFP->readTxt () );
		$config = $xml->database [0]; // get config form xml file.		
		$this->setDbServer ( $config ['server'] ); // set Database server.
		$this->setDbPassword ( $config ['password'] ); // set database password.
		$this->setDbUsername ( $config ['username'] ); // set database username.
		$this->setDbName ( $config ['database_name'] ); // set dataserver name or ip.
		$this->setDbType ( $config ['type'] ); //set type of database.
		$this->setDbVersion ( $config ['version'] ); // set database version.
	}
	
	
}

?>