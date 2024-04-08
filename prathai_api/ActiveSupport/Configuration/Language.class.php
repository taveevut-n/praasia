<?php
/**
 * Language class from design.
 * @author Boonsit
 *
 */
class Language {

	/**
	 * Language file
	 * @var string[]
	 */
	private $_xml;

	/**
	 * __constructor, Entry xml file config name to this constructor.
	 * @param string $s
	 * @return void
	 */
	function __construct($s) {
		$_fp = new File ( "apps/languages/language-{$s}.xml" );
		$_fp->openFile ( 'r' );
		$this->_xml = new SimpleXMLElement ( $_fp->readTxt () );
	}

	/**
	 *
	 * @param string $s
	 * @return Ambigous <string, unknown>
	 */
	private function g($s) {
		$v = "";
		foreach ( $this->_xml->string as $_s ) {
			if ($_s ['name'] == $s) {
				$v = $_s ['value'];
				break;
			}
		}

		return $v;
	}

	/**
	 * Return value from lanuage config file.
	 * @param string $s
	 */
	public function get($s) {
		return $this->g ( $s );
	}
}

?>