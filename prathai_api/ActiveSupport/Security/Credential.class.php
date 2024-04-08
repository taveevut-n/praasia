<?php
class Credential {
	
	private $m_info;
	
	/*
	 * @var Person $m_Person
	 * 
	 */
	private $m_Person;
	
	function __construct() {
		$this->m_Person = new Person();
	}

}

?>