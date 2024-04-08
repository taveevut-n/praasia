<?php

/**
 * Json Class for Manage Json string object.
 * @author Boonsit.R
 */
abstract class JSON {
	abstract function encode();
	abstract function add($k, $n);

}
class JSONObject extends JSON {
	/**
	 * Node value
	 *
	 * @var stdClass
	 */
	private $mNodes;

	/**
	 * Cosntructor
	 *
	 * @param array $n
	 */
	function __construct($s = null) {
		$this->decode ( $s );
	}
	function clear() {
		$this->mNodes = null;
	}

	/**
	 * Add element to json object.
	 *
	 * @param string $k
	 * @param JSON $v
	 */
// 	function addArray($k, JSON $v) {
// 		$this->mNodes->$k = $v;
// 	}

	/**
	 *
	 * @param string $k
	 * @param mix $v
	 */
	function add($k, $v) {
		$this->mNodes->$k = $v;
	}
// 	function addObject($k, JSONObject $v) {
// 		$this->mNodes->$k = $v;
// 	}

	/**
	 * Check json has node of interesting
	 *
	 * @param string $k
	 * @return boolean
	 */
	function isHas($k) {
		$_b = false;
		$_b = isset ( $this->mNodes->$k );
		return $_b;
	}

	/**
	 * Return Value is contain in json object.
	 *
	 * @param string $k
	 * @return multitype:
	 */
	function getValue($k) {
		$s = null;
		if ($this->isHas ( $k )) {
			$s = $this->mNodes->$k;
		}

		return $s;
	}

	/**
	 * Magic method for cast to string
	 *
	 * @return string
	 */
	function __toString() {
		return $this->encode ();
	}

	/**
	 * Decode Json string format to json oject.
	 *
	 * @param string $json_text
	 */
	function decode($json_text) {
		$this->mNodes = json_decode ( $json_text );
	}

	/**
	 * Decode Json Object to Json String
	 *
	 * @return string
	 */
	function encode() {
		$_json = "{";

		$i = 0;
		foreach ( $this->mNodes as $k => $v ) {
			if (is_a ( $v, "JSONArray" )) {
				$_json .= "\"{$k}\":{$v->encode()} ";
			} else {
				$_json .= "\"{$k}\":\"{$v}\"";
			}

			if ($i+1 != count ( $this->mNodes )) {
				$_json .= ', ';
			}
			$i++;
		}
		$_json .= '}';
		return $_json;

		// return json_encode ( $this->nodes );
	}
}
class JSONArray extends JSON {
	private $mKey = null;
	private $mNodesArray = array ();
	private $mIsNode = false;

	/**
	 * add json object for be node.
	 *
	 * @param string $k
	 * @param string $n
	 * @param boolean $i
	 */
	function add($k, $n) {
		$this->mKey = $k;
		$this->mNodesArray [] = $n;
		$n->mIsNode = true;
	}

	/**
	 * Return node object
	 * @param string $index
	 * @return JSONObject
	 */
	function get($index){
		return $this->mNodesArray[$index];
	}

	function encode() {
		$_json = "[";

		$i = 1;
		foreach ( $this->mNodesArray as $k =>$v ) {
			if (is_a ( $v, "JSONObject" )) {
				$_json .= "{$v->encode()}";
			} else {
				$_json .= "{$v}";
			}

			if ($i != count ( $this->mNodesArray )) {
				$_json .= ", ";
			}

			$i++;
		}
		$_json .= "]";
		return $_json;
	}
}
?>