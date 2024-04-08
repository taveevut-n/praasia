<?php
abstract class ABootstap {
	protected $mModuleClass = null;
	private $mQueryStrings = null;
	protected $mControl = null;
	protected $mAction = null;
	protected $mParams = array ();
	function __construct($q = "") {
            
		$_qTemp = explode ( "&", $q );
                
                
		foreach ( $_qTemp as $_k => $_v ) {
			$_qv = explode ( "=", $_v );
			$this->mQueryStrings [$_qv [0]] = $_qv [1];
                        
		}

		$this->mAction = (key_exists('action',$this->mQueryStrings) == true) ?$this->mQueryStrings['action'] : '';
		$this->mControl = $this->mQueryStrings ['control'];
	}
	abstract function registerModuleClass();

	/* luncher action function */
	abstract function lunchApplication();
	function loadClass($_) {
		new $_ ();
	}
}
?>