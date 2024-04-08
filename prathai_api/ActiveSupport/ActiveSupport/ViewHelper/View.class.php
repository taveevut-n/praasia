<?php
/**
 * @package ActiveSupport/ViewHelper
 */
class View {
	private $message = array();

	private $error = array();

	private $warring = array();

	private $sourceViewPath = "../views/";

	/**
	 *
	 * Enter description here ...
	 * @param string $path
	 * @example $v = new View("../views/");
	 */
	function __construct($path = "") {
		if ($path != "")
			$this -> sourceViewPath = $path;
	}

	/**
	 * @return the $message
	 */
	public function getMessage($key) {
		return $this -> message[$key];
	}

	/**
	 * @return the $error
	 */
	public function getError($key) {
		return $this -> error[$key];
	}

	/**
	 * @return the $warring
	 */
	public function getWarring($key) {
		return $this -> warring[$key];
	}

	/**
	 * @param field_type $message
	 */
	public function setMessage($key, $message) {
		$this -> message[$key] = $message;
	}

	/**
	 * @param field_type $error
	 */
	public function setError($key, $error) {
		$this -> error[$key] = $error;
	}

	/**
	 * @param field_type $warring
	 */
	public function setWarring($key, $warring) {
		$this -> warring[$key] = $warring;
	}

	/**
	 * @return string
	 */
	public function getSourceViewPath() {
		return $this -> sourceViewPath;
	}

	/**
	 * @param string $path
	 */
	public function setSourceViewPath($path) {
		$this -> sourceViewPath = $path;
	}

	public function render($filepath) {
		include_once $this -> sourceViewPath . $filepath;
	}
}
?>