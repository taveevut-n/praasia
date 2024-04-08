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
	/**
	 * @var string
	 */
	private $m_marker_start;
	/**
	 * @var string
	 */
	private $m_marker_end;

	/**
	 * @var Language $m_Language
	 */
	private $m_Language;

	/**
	 * var boolean $m_AutoLanguage
	 *
	 */
	private $m_AutoLanguage = false;

        
        private $runKey = 0;
        
	/**
	 * Constructor
	 * @param string $s_file_name
	 */
	function __construct($s_file_template = null) {
		$this->s_parsed = ( string ) "";
		$this->a_assign_value = ( array ) array ();
		$this->a_assign_var = ( array ) array ();
		$this->s_file_template = ( string ) $s_file_template;
		$this->setMarkerStart ( "/@{" );
		$this->setMarkerEnd ( "/}" );
	}

	/**
	 * @var string
	 */
	public function setMarkerStart($_s) {
		$this->m_marker_start = $_s;
	}

	/**
	 * @var string
	 */
	public function setMarkerEnd($_e) {
		$this->m_marker_end = $_e;
	}

	/**
	 * @return the $m_AutoLanguage
	 */
	public function getAutoLanguage() {
		return $this->m_AutoLanguage;
	}

	/**
	 * @param field_type $m_AutoLanguage
	 */
	public function setAutoLanguage($_AutoLanguage) {
		$this->m_AutoLanguage = ( bool ) $_AutoLanguage;
	}

	/**
	 * Assign templage file to object
	 */
	public function setFileTemplate($s_file_template = 'noname.html') {
		$this->s_file_template = ( string ) $s_file_template;
	}

	/**
	 * Load file template to control for display
	 */
	private function loadTemplate() {
		$s_source = "";
		if (file_exists ( $this->s_file_template )) {
			$this->o_file = new File ( $this->s_file_template );
			$this->o_file->openFile ( "r" );
			$s_source = $this->o_file->readTxt ( $this->o_file->sizeFile () );
		} else {
			print __CLASS__ . " : ". __METHOD__ ." ERROR : " . $this->s_file_template . " file not exists!!!.";
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
            
		print $this->build ();
	}

	/**
	 * Parsing syntag web document.
	 *
	 */
	public function build() {
		$s_source = "";
                $parsed = "";
		if ($this->s_string_source != null){
			$s_source = $this->s_string_source;
                }else{
			$s_source = $this->loadTemplate ();
                }
                
		return preg_replace ( $this->a_assign_var, $this->a_assign_value, $s_source );
                
	}

	/**
	 * Set value to mark point.
	 *
	 * @param string $s_maker
	 * @param string $s_value
	 */
	public function assignValue($s_marker, $s_value) {
		$_new_marker = '/@{' . $s_marker . '}/';
		$_key = $s_marker."_var";
		$_value = $s_marker."_val";

		$this->a_assign_var [$this->runKey] = $_new_marker;
		$this->a_assign_value [$this->runKey++] = $s_value;

	}

	/**
	 * Set value to mark point.
	 *
	 * @param string $s_maker
	 * @param string $s_value
	 */
	public function addViewPath($s_marker, ViewTemplate $vt) {
		$s_marker = '/@{' . $s_marker . '}/';
		$this->a_assign_var [] = $s_marker;
		$this->a_assign_value [] = $vt->build ();
	}

}
?>