<?php
abstract class APerson {

	private $m_SessionId;

	private $m_PersonId;

	private $m_Name;

	private $m_MiddleName;

	private $m_LastName;

	function setSessionId($s) {
		$this -> m_SessionId = $s;
	}

	function getSessionId() {
		return $this -> m_SessionId;
	}

	function setPersonId($s) {
		$this -> m_PersonId = $s;
	}

	function getPersonId() {
		return $this -> m_PersonId;
	}

	function setName($s) {
		$this -> m_Name = $s;
	}

	function getName() {
		return $this -> m_Name;
	}

	function setMiddleName($s) {
		$this -> m_MiddleName = $s;
	}

	function getMiddleName() {
		return $this -> m_MiddleName;
	}

	function setLastName($s) {
		$this -> m_LastName = $s;
	}

	function getLastName() {
		return $this -> m_LastName;
	}

}
?>