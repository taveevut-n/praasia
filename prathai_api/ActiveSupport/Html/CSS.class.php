<?php
final class CSS {
	/**
	 *
	 * Stirng
	 * @var string
	 */

	private $mCharset = "utf8";



	/**
	 * constructor
	 */
	public function __construct() {
		$this->s_title = ( string ) 'Untitled Document';
		$this->s_head = ( string ) "";
		$this->a_meta = ( array ) array ();
		$this->setMetaHttpEquiv ( "tis-620" );
		$this->setMetaDescription ( "Description." );
		$this->setMetaKeyWord ( "Keyword." );
		$this->s_body = ( string ) "";
		$this->a_css = ( array ) array ();
		$this->a_javascript = ( array ) array ();
	}

	/**
	 * Set include file javascript on web document.
	 *
	 * @param string $s_js
	 */
	public function setIncludeJavascript($s_js) {
		$this->a_javascript [] = "<script src=\"$s_js\" language=\"javascript\" type=\"text/javascript\"></script>\r\n";
	}

	/**
	 * Set javascript on web document.
	 *
	 * @param string $s_js
	 */
	public function setJavascript($s_js) {
		$this->a_javascript [] = "<script language=\"javascript\" type=\"text/javascript\">\r\n $s_js \r\n</script>\r\n";
	}

	/**
	 * Set Import file style sheet on web document.
	 *
	 * @param string $s_css
	 */
	public function setIncludeCSS($s_css) {
		$this->a_css [] = "<style type=\"text/css\"> @import url(\"$s_css\"); </style>\r\n";
	}

	/**
	 * Set style on web document.
	 *
	 * @param string $s_css
	 */
	public function setCSS($s_css) {
		$this->a_css [] = "<style>\r\n $s_css \r\n</style>\r\n";
	}

	/**
	 * Return javascript tag
	 *
	 * @param integer $i_index
	 * @return string
	 */
	private function getJavascript($i_index = null) {
		$s_js = '';
		if ($i_index != null) {
			$s_js = $this->a_javascript [$i_index] . "\r\n";
		} else {

			$i_loop = 0;
			while ( count ( $this->a_javascript ) > $i_loop ) {
				$s_js .= $this->a_javascript [$i_loop] . "\r\n";
				$i_loop ++;
			}
		}
		return $s_js;
	}

	/**
	 * Set meta tag
	 *
	 * @param string $s_meta
	 */
	private function setMeta($s_meta) {
		$this->a_meta [] = $s_meta;
	}

	/**
	 * Set meta http-equiv tag.
	 *
	 * @param string $s_meta
	 */
	public function setMetaHttpEquiv($s_meta = "tis-620") {
		$this->a_meta ['0'] = "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=$s_meta\" />";
	}

	/**
	 * Set meta description tag.
	 *
	 * @param string $s_meta
	 */
	public function setMetaDescription($s_meta = "description") {
		$this->a_meta ['1'] = "<meta name=\"description\" content=\"$s_meta\" />";
	}

	/**
	 * Set meta keyword tag.
	 *
	 * @param string $s_meta
	 */
	public function setMetaKeyWord($s_meta = "keyword") {
		$this->a_meta ['2'] = "<meta name=\"keywords\" content=\"$s_meta\" />";
	}

	/**
	 * return meta tag.
	 *
	 * @param integer $i_index
	 * @return integer
	 */
	public function getMeta($i_index = null) {
		$s_meta = '';
		if ($i_index != null) {
			$s_meta = $this->a_meta [$i_index] . "\r\n";
		} else {
			$i_loop = 0;
			while ( count ( $this->a_meta ) > $i_loop ) {
				$s_meta .= $this->a_meta [$i_loop] . "\r\n";
				$i_loop ++;
			}
		}
		return $s_meta;
	}

	/**
	 * Return css tag
	 *
	 * @param integer $i_index
	 * @return string
	 */
	public function getCSS($i_index = null) {
		$s_css = '';
		if ($i_index != null) {
			$s_css = $this->a_css [$i_index] . "\r\n";
		} else {
			$i_loop = 0;
			while ( count ( $this->a_css ) > $i_loop ) {
				$s_css .= $this->a_css [$i_loop] . "\r\n";
				$i_loop ++;
			}
		}
		return $s_css;
	}

	/**
	 * Set title tag.
	 *
	 * @param string $s_title
	 */
	public function setTitle($s_title) {
		$this->s_title = "<title>$s_title</title>" . "\r\n";
	}

	/**
	 * Return title tag
	 *
	 * @return string
	 */
	public function getTitle() {
		return $this->s_title;
	}

	/**
	 * Set PHP tag
	 *
	 * @param string $s_php
	 */
	public function setPHP($s_php) {
		$this->s_php = "<?php\r\n $s_php ?>\r\n";
	}

	/**
	 * Return PHP script
	 *
	 * @return string
	 */
	public function getPHP() {
		return $this->s_php;
	}

	/**
	 * return header document
	 *
	 * @return unknown
	 */
	public function getHeader() {
		$this->s_head = "<head>\r\n";
		$this->s_head .= $this->getTitle ();
		$this->s_head .= $this->getMeta ();
		$this->s_head .= $this->getCSS ();
		$this->s_head .= $this->getJavascript ();
		$this->s_head .= "</head>\r\n";
		return $this->s_head;
	}

	/**
	 * Set syntag web.
	 *
	 * @param string $s_body
	 */
	public function setBody($s_body) {
		$this->s_body = $s_body . "\r\n";
	}

	/**
	 * Return syntag web.
	 *
	 * @return string
	 */
	public function getBody() {
		return $this->s_body;
	}

	/**
	 * Return script web document on parsed tag.
	 *
	 * @return string
	 */
	private function render() {
		$s_tags = '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">' . "\r\n";
		$s_tags .= '<html>' . "\r\n";
		$s_tags .= $this->getHeader ();
		if ($this->b_use_yui === true){
			$s_tags .= '<body class="">' . "\r\n";
		}else{
			$s_tags .= '<body>' . "\r\n";
		}
		$s_tags .= $this->getBody ();
		$s_tags .= '</body>' . "\r\n";
		$s_tags .= '</html>';
		return $s_tags;
	}

	/**
	 * Show syntag after parsed web document.
	 *
	 */
	public function show() {
		print $this->render ();
	}

	public function __toString(){
		$this->show();
	}
}
?>