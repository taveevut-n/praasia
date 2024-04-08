<?php
class HttpParams extends HttpParameter{}
class HttpParameter {

	/**
	 * Get Http POST Value
	 *
	 * @param string $_key
	 * @param string $if_null_return
	 */
	static function getPostParam($_key, $if_null_return = null) {
		$_v = $if_null_return;
		if (key_exists ( $_key, $_POST )) {
			$_v = ($_POST [$_key] != null || $_POST [$_key] != "") ? $_POST [$_key] : $if_null_return;
		}

		return $_v;
	}

	/**
	 * Get Http FILES Value
	 *
	 * @param string $_key
	 * @param string $if_null_return
	 */
	static function getFilesParam($_key, $if_null_return = null) {
		$_v = $if_null_return;
		if (key_exists ( $_key, $_FILES )) {
			$_v = ($_FILES [$_key] != null || $_FILES [$_key] != "") ? $_FILES [$_key] : $if_null_return;
		}

		return $_v;
	}

	/**
	 * Get Array Http POST Value
	 *
	 * @param string $_key
	 * @param string $index
	 * @param string $if_null_return
	 */
	static function getArrayPostParam($_key, $index, $if_null_return = null) {
		$_v = $if_null_return;
		if (key_exists ( $_key, $_POST )) {

			$_v = ($_POST [$_key] [$index] != null || $_POST [$_key] [$index] != "") ? $_POST [$_key] [$index] : $if_null_return;

		}

		return $_v;
	}

	/**
	 * Get Array Http FILES Value
	 *
	 * @param string $_key
	 * @param string $index
	 * @param string $if_null_return
	 */
	static function getArrayFilesParam($_key, $index, $if_null_return = null) {
		$_v = $if_null_return;
		if (key_exists ( $_key, $_FILES )) {

			$_v = ($_FILES [$_key] [$index] != null || $_FILES [$_key] [$index] != "") ? $_FILES [$_key] [$index] : $if_null_return;

		}

		return $_v;
	}

	/**
	 * Get Http GET Value
	 *
	 * @param string $_key
	 * @param string $if_null_return
	 */
	static function getGetParam($_key, $if_null_return = null) {
		$_v = $if_null_return;
		if (key_exists ( $_key, $_GET )) {
			$_v = ($_GET [$_key] != null || $_GET [$_key] != "") ? $_GET [$_key] : $if_null_return;
		}

		return $_v;
	}

	/**
	 *
	 * @param string $_key
	 * @param string $index
	 * @param string $if_null_return
	 */
	static function getArrayGetParam($_key, $index, $if_null_return = null) {
		$_v = $if_null_return;
		if (key_exists ( $_key, $_GET )) {
			$_v = ($_GET [$_key] [$index] != null || $_GET [$_key] [$index] != "") ? $_GET [$_key] [$index] : $if_null_return;
		}

		return $_v;
	}

/**
 * Return Length from array data
 * @param string $_reqType
 * @param string $_key
 * @return number
 */
	static function getArrayLength($_reqType, $_key)
	{
		$_v = 0;

		if ($_reqType == "GET") {
			$_v =count($_GET[$_key]);
		}

		if ($_reqType == "POST") {
			$_v =count($_POST[$_key]);
		}

		if ($_reqType == "REQUEST") {
			$_v =count($_REQUEST[$_key]);
		}

		if ($_reqType == "SESSION") {
			$_v =count($_SESSION[$_key]);
		}

		return $_v;

	}

	static function getRequestParam($_key, $if_null_return = null) {
		$_v = $if_null_return;
		if (key_exists ( $_key, $_REQUEST )) {
			$_v = ($_REQUEST [$_key] != null || $_REQUEST [$_key] != "") ? $_REQUEST [$_key] : $if_null_return;
		}

		return $_v;
	}

	static function getArrayRequestParam($_key, $index, $if_null_return = null) {
		$_v = $if_null_return;
		if (key_exists ( $_key, $_REQUEST )) {
			$_v = ($_REQUEST [$_key] [$index] != null || $_REQUEST [$_key] [$index] != "") ? $_REQUEST [$_key] [$index] : $if_null_return;
		}

		return $_v;
	}

	static function getCookieParam($_key, $if_null_return = null) {
		$_v = $if_null_return;
		if (key_exists ( $_key, $_COOKIE )) {
			$_v = ($_COOKIE [$_key] != null || $_COOKIE [$_key] != "") ? $_COOKIE [$_key] : $if_null_return;
		}

		return $_v;
	}

	static function getArrayCookieParam($_key, $index, $if_null_return = null) {
		$_v = $if_null_return;
		if (key_exists ( $_key, $_COOKIE )) {
			$_v = ($_COOKIE [$_key] [$index] != null || $_COOKIE [$_key] [$index] != "") ? $_COOKIE [$_key] [$index] : $if_null_return;
		}

		return $_v;
	}

	static function getSessionParam($_key, $if_null_return = null) {
		$_v = $if_null_return;
		if (key_exists ( $_key, $_SESSION )) {
			$_v = ($_SESSION [$_key] != null || $_SESSION [$_key] != "") ? $_SESSION [$_key] : $if_null_return;
		}

		return $_v;
	}

	static function getArraySessionParam($_key, $index, $if_null_return = null) {
		$_v = $if_null_return;
		if (key_exists ( $_key, $_SESSION )) {
			$_v = ($_SESSION [$_key] [$index] != null || $_SESSION [$_key] [$index] != "") ? $_SESSION [$_key] [$index] : $if_null_return;
		}

		return $_v;
	}

	/**
	 * Set Session value to parameter
	 * @param string $_key
	 * @param string $v
	 */
	static function setSessionParam($_key, $v = null) {
		$_SESSION [$_key] = $v;
	}

	/**
	 * Set Get value to parameter
	 * @param string $_key
	 * @param string $v
	 */
	static function setGetParam($_key, $v = null) {
		$_GET [$_key] = $v;
	}

	/**
	 * Set Post value to parameter
	 * @param string $_key
	 * @param string $v
	 */
	static function setPostParam($_key, $v = null) {
		$_POST [$_key] = $v;
	}

	/**
	 * Set Request value to parameter
	 * @param string $_key
	 * @param string $v
	 */
	static function setRequestParam($_key, $v = null) {
		$_REQUEST [$_key] = $v;
	}

	static function varPost($_key, $if_null_return = null) {
		return self::getPostParam ( $_key, $if_null_return );
	}

	static function varFiles($_key, $if_null_return = null) {
		return self::getFilesParam ( $_key, $if_null_return );
	}

	static function varGet($_key, $if_null_return = null) {
		return self::getGetParam ( $_key, $if_null_return );
	}

	static function varRequest($_key, $if_null_return = null) {
		return self::getRequestParam ( $_key, $if_null_return );
	}

	static function varCookie($_key, $if_null_return = null) {
		return self::getCookieParam ( $_key, $if_null_return );
	}

	static function varSession($_key, $if_null_return = null) {
		return self::getSessionParam ( $_key, $if_null_return );
	}

	static function varArrayFiles($_key, $index, $if_null_return = null) {
		return self::getArrayFilesParam ( $_key, $index, $if_null_return );
	}

	static function varArrayPost($_key, $index, $if_null_return = null) {
		return self::getArrayPostParam ( $_key, $index, $if_null_return );
	}

	static function varArrayPostLength($_key){
		return self::getArrayLength("POST",$_key);
	}

	static function varArrayGetLength($_key){
		return self::getArrayLength("GET",$_key);
	}

	static function varArraySessionLength($_key){
		return self::getArrayLength("SESSION",$_key);
	}

	static function varArrayRequestLength($_key){
		return self::getArrayLength("REQUEST",$_key);
	}

	static function varArrayGet($_key, $index, $if_null_return = null) {
		return self::getArrayGetParam ( $_key, $index, $if_null_return );
	}

	static function varArrayRequest($_key, $index, $if_null_return = null) {
		return self::getArrayRequestParam ( $_key, $index, $if_null_return );
	}

	static function varArrayCookie($_key, $index, $if_null_return = null) {
		return self::getArrayCookieParam ( $_key, $index, $if_null_return );
	}

	static function varArraySession($_key, $index, $if_null_return = null) {
		return self::getArraySessionParam ( $_key, $index, $if_null_return );
	}
}
?>