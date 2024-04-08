<?php
/**
 * Class AObject is abstract of any object
 * @author Boonsit
 * @abstract
 * @filesource CoreFramewrok/AObject.class.php
 */
abstract class AObjects {
	abstract function __toString();
}

class HashTable {
	private $_arr = null;
	function __construct() {
		$this->_arr = array ();
	}

	function clear() {
		unset ( $this->_arr );
		$this->_arr = array ();
	}

	function contains($value, $bStrict = false) {
		return in_array ( $value, $this->_arr, $bStrict );
	}

	function containsKey($key) {
		return array_key_exists ( $key, $this->_arr );
	}

	function containsValue($value, $bStrict = false) {
		return $this->contains ( $value, $bStrict );
	}

	function get($key) {
		$value = null;

		if (array_key_exists ( $key, $this->_arr )) {
			$value = $this->_arr [$key];
		}

		return $value;
	}

	function isEmpty() {
		return ($this->size () <= 0);
	}

	function keys() {
		return array_keys ( $this->_arr );
	}

	function put($key, $value) {
		$this->_arr [$key] = $value;
	}

	function putAll($arr) {
		if ($arr !== null) {
			if (is_array ( $arr )) {
				$this->_arr = array_merge ( $this->_arr, $arr );
			} else if ($arr instanceof HashTable) {
				$this->_arr = array_merge ( $this->_arr, $arr->_arr );
			}
		}
	}

	function remove($key) {
		unset ( $this->_arr [$key] );
	}

	function size() {
		return count ( $this->_arr );
	}

	function toString() {
		return print_r ( $this->_arr, true );
	}

	function values() {
		return array_values ( $this->_arr );
	}
}

/**
 * Title: Single linked list
 * Description: Implementation of a single linked list in PHP
 * @author Sameer Borate | codediesel.com
 * @version 1.0.1 Updated: 16th August 2012
 */

class ListNode
{
	/* Data to hold */
	public $data;

	/* Link to next node */
	public $next;


	/* Node constructor */
	function __construct($data)
	{
		$this->data = $data;
		$this->next = NULL;
	}

	function readNode()
	{
		return $this->data;
	}
}


class LinkList
{
	/* Link to the first node in the list */
	private $firstNode;

	/* Link to the last node in the list */
	private $lastNode;

	/* Total nodes in the list */
	private $count;



	/* List constructor */
	function __construct()
	{
		$this->firstNode = NULL;
		$this->lastNode = NULL;
		$this->count = 0;
	}

	public function isEmpty()
	{
		return ($this->firstNode == NULL);
	}

	public function insertFirst($data)
	{
		$link = new ListNode($data);
		$link->next = $this->firstNode;
		$this->firstNode = &$link;

		/* If this is the first node inserted in the list
		 then set the lastNode pointer to it.
		*/
		if($this->lastNode == NULL)
			$this->lastNode = &$link;

		$this->count++;
	}

	public function insertLast($data)
	{
		if($this->firstNode != NULL)
		{
			$link = new ListNode($data);
			$this->lastNode->next = $link;
			$link->next = NULL;
			$this->lastNode = &$link;
			$this->count++;
		}
		else
		{
			$this->insertFirst($data);
		}
	}

	public function deleteFirstNode()
	{
		$temp = $this->firstNode;
		$this->firstNode = $this->firstNode->next;
		if($this->firstNode != NULL)
			$this->count--;

		return $temp;
	}

	public function deleteLastNode()
	{
		if($this->firstNode != NULL)
		{
			if($this->firstNode->next == NULL)
			{
				$this->firstNode = NULL;
				$this->count--;
			}
			else
			{
				$previousNode = $this->firstNode;
				$currentNode = $this->firstNode->next;

				while($currentNode->next != NULL)
				{
					$previousNode = $currentNode;
					$currentNode = $currentNode->next;
				}

				$previousNode->next = NULL;
				$this->count--;
			}
		}
	}

	public function deleteNode($key)
	{
		$current = $this->firstNode;
		$previous = $this->firstNode;

		while($current->data != $key)
		{
			if($current->next == NULL)
				return NULL;
			else
			{
				$previous = $current;
				$current = $current->next;
			}
		}

		if($current == $this->firstNode)
		{
			if($this->count == 1)
			{
				$this->lastNode = $this->firstNode;
			}
			$this->firstNode = $this->firstNode->next;
		}
		else
		{
			if($this->lastNode == $current)
			{
				$this->lastNode = $previous;
			}
			$previous->next = $current->next;
		}
		$this->count--;
	}

	public function find($key)
	{
		$current = $this->firstNode;
		while($current->data != $key)
		{
			if($current->next == NULL)
				return null;
			else
				$current = $current->next;
		}
		return $current;
	}

	public function readNode($nodePos)
	{
		if($nodePos <= $this->count)
		{
			$current = $this->firstNode;
			$pos = 1;
			while($pos != $nodePos)
			{
				if($current->next == NULL)
					return null;
				else
					$current = $current->next;

				$pos++;
			}
			return $current->data;
		}
		else
			return NULL;
	}

	public function totalNodes()
	{
		return $this->count;
	}

	public function readList()
	{
		$listData = array();
		$current = $this->firstNode;

		while($current != NULL)
		{
			array_push($listData, $current->readNode());
			$current = $current->next;
		}
		return $listData;
	}

	public function reverseList()
	{
		if($this->firstNode != NULL)
		{
			if($this->firstNode->next != NULL)
			{
				$current = $this->firstNode;
				$new = NULL;

				while ($current != NULL)
				{
					$temp = $current->next;
					$current->next = $new;
					$new = $current;
					$current = $temp;
				}
				$this->firstNode = $new;
			}
		}
	}
}
?>