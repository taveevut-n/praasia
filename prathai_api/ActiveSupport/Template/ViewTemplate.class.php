<?php
/**
 * @package ActiveSupport/ViewHelper
 */
final class ViewTemplate {

	/**
	 * File object
	 *
	 * @var File
	 */
	private $o_file;

	/**
	 * File Template.
	 * @string
	 */
	private $s_file_template;

	/**
	 * Parsed data on format web document.
	 *
	 * @var String
	 */
	private $s_parsed;

	/**
	 * Array list variable data on web document.
	 *
	 * @var Array
	 */
	private $a_assign_var;

	/**
	 * Array list value data on web document.
	 *
	 * @var Array
	 */
	private $a_assign_value;

	/**
	 * string data source file.
	 *
	 * @var string
	 */
	private $s_string_source;

	private $m_marker_start;
	private $m_marker_end;

	public function setMarkerPoint($_m) {
		$this->m_marker_start = $_m;

	}

	/**
	 * Constructor
	 * @param string $s_file_name
	 */

	function __construct($s_file_template = null) {
		$this->s_parsed = ( string ) "";
		$this->a_assign_value = ( array ) array ();
		$this->a_assign_var = ( array ) array ();
		$this->s_file_template = ( string ) $s_file_template;
	}

	public function setFileTemplate($s_file_template = 'noname.html') {
		$this->s_file_template = ( string ) $s_file_template;
	}

	private function loadTemplate() {
		$s_source = "";
		if (file_exists ( $this->s_file_template )) {
			$this->o_file = new File ( $this->s_file_template );
			$this->o_file->openFile ( "r" );
			$s_source = $this->o_file->readTxt ( $this->o_file->sizeFile () );
		} else {
			print __CLASS__ . " ERROR : " . $this->s_file_template . " file not exists!!!.";
			exit ();
		}
		return $s_source;
	}

	public function setStringSource($s_source = null) {
		$this->s_string_source = ( string ) $s_source;
	}

	/**
	 * Show syntag after parsed web document.
	 *
	 */
	public function render() {

		//print self::getParsed ();
		//var_dump(self::getParsed ());
	}

	/**
	 * Parsing syntag web document.
	 *
	 */
	private function getParsed() {
		if ($this->s_string_source != null)
			$s_source = $this->s_string_source;
		else
			$s_source = $this->loadTemplate ();

		self::assignValue ( "@.+", "" );
		return preg_replace ( $this->a_assign_var, $this->a_assign_value, $s_source );
	}

	/**
	 * Set value to mark point.
	 *
	 * @param string $s_maker
	 * @param string $s_value
	 */
	public function assignValue($s_marker, $s_value) {
		$s_marker = '/{' . $s_marker . '}/';
		$this->a_assign_var [] = $s_marker;
		$this->a_assign_value [] = $s_value;
	}

}
?>