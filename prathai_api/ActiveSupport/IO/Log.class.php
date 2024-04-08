<?php
if (! defined ( "FILE" )) {
	require_once ('File.class.php');
}

/**
 * @author Rewat Boonsit
 *
 *
 */
class Log extends File {
	private $mFileName = "";

	/**
	 *
	 * Constructor
	 * @param string $s file name of log
	 * @param string $sE string name error
	 * @example [object]("log.txt","has some error");
	 */
	public function __construct($s_file_name = null,$sError = null) {
		if ($s_file_name != null) {
			$this->mFileName = $s_file_name;
			parent::__construct ( $this->mFileName );
			$this->openFile ( "a" );

			if($sError != null || $sError != "")
				$this->writeLog($sError);
		}
	}

	/**
	 * Set path and name of log file.
	 * @param string $s
	 */
	public function setLogFile($s) {
		$this->mFileName = $s;
	}

	/**
	 * Return path and name of log file.
	 */
	public function getLogFile() {
		return $this->mFileName;
	}

	/**
	 * Write log text.
	 * @param string $s
	 * @return void
	 */
	public function writeLog($s) {
		$b_ = false;
		if ($this->r_file_handle == null) {
			$this->s_file_name = $this->getLogFile ();
			$this->openFile ( "a" );
		}
		$this->writeTxt ( $s, strlen ( $s ) );
	}

	/**
	 *
	 */
	function __destruct() {
		$this->mFileName = null;
	}
}

?>