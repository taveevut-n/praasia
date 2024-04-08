<?php
class ServerParameter {
	
	static function getServerParam($_key, $if_null_return = null) {
		$_v = $if_null_return;
		if (key_exists ( $_key, $_SERVER )) {
			$_v = ($_SERVER [$_key] != null || $_SERVER [$_key] != "") ? $_SERVER [$_key] : $if_null_return;
		}
		
		return $_v;
	}
	
	static function getEnvironmentParam($_key, $if_null_return = null) {
		$_v = $if_null_return;
		if (key_exists ( $_key, $_ENV )) {
			$_v = ($_ENV [$_key] != null || $_ENV [$_key] != "") ? $_ENV [$_key] : $if_null_return;
		}
		
		return $_v;
	}
	
	static function varServer($_key, $if_null_return = null) {
		return self::getServerParam ( $_key, $if_null_return );
	}
	
	static function varEnv($_key, $if_null_return = null) {
		return self::getEnvironmentParam ( $_key, $if_null_return );
	}
}
?>