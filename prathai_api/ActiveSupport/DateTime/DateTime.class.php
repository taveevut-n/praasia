<?php
/**
 * Date Time class easy to use and implement.
 * @author Boonsit.R
 *
 */
class Date {

	private $day = null;
	private $month = null;
	private $year = null;
	private $hour = null;
	private $minute = null;
	private $second = null;
	private $_time = null;

	/**
	 * Constructor
	 * need format siHYmd
	 */
	function __construct() {

		// $this->_time = mktime(date($format,$s));
		$this->_time = mktime ( date ( "H" ), date ( "i" ), date ( "s" ), date ( "m" ), date ( "d" ), date ( "Y" ) );
		$this->second = $this->parseDateTime ( "s" );
		$this->minute = $this->parseDateTime ( "i" );
		$this->hour = $this->parseDateTime ( "H" );
		$this->year = $this->parseDateTime ( "Y" );
		$this->month = $this->parseDateTime ( "m" );
		$this->day = $this->parseDateTime ( "d" );
	}

	/**
	 * set day
	 * @param integer $day
	 */
	public final function setDay($day) {
		$this->day = $day;
		$this->_time = $this->makeTime ();
	}

	/**
	 * set month
	 * @param integer $month
	 */
	public final function setMonth($month) {
		$this->month = $month;
		$this->_time = $this->makeTime ();
	}

	/**
	 * set year
	 * @param integer $year
	 */
	public final function setYear($year) {
		$this->year = $year;
		$this->_time = $this->makeTime ();
	}

	/**
	 * set hour
	 * @param integer $hour
	 */
	public final function setHour($hour) {
		$this->hour = $hour;
		$this->_time = $this->makeTime ();
	}

	/**
	 * set minute
	 * @param integer $minute
	 */
	public final function setMinute($minute) {
		$this->minute = $minute;
		$this->_time = $this->makeTime ();
	}

	/**
	 * set second
	 * @param integer $second
	 */
	public final function setSecond($second) {
		$this->second = $second;
		$this->_time = $this->makeTime ();
	}


	private final function makeTime() {
		return mktime ( $this->hour, $this->minute, $this->second, $this->month, $this->day, $this->year );
	}

	public final function getDay() {
		return $this->parseDateTime ( "d" );
	}

	public final function getMonth() {
		return $this->parseDateTime ( "m" );
	}

	public final function getYear() {
		return $this->parseDateTime ( "Y" );
	}

	public final function getMinute() {
		return $this->parseDateTime ( "i" );
	}

	public final function getSecond() {
		return $this->parseDateTime ( "s" );
	}

	public final function getHour() {
		return $this->parseDateTime ( "H" );
	}

	public final function getDate($format = "d-m-Y H:i:s") {
		return $this->parseDateTime ( $format );
	}

	/**
	 * add month
	 * @param integer $month
	 */
	public final function addMonth($month) {
		$this->month += $month;
		$this->_time = $this->makeTime ();
	}

	/**
	 * add year
	 * @param integer $year
	 */
	public final function addYear($year) {
		$this->year += $year;
		$this->_time = $this->makeTime ();
	}

	/**
	 * add day
	 * @param integer $day
	 */
	public final function addDay($day) {
		$this->day += $day;
		$this->_time = $this->makeTime ();
	}

	/**
	 * add hour
	 * @param integer $hour
	 */
	public final function addHour($hour) {
		$this->hour += $hour;
		$this->_time = $this->makeTime ();
	}

	/**
	 * add minute
	 * @param integer $minute
	 */
	public final function addMinute($minute) {
		$this->minute += $minute;
		$this->_time = $this->makeTime ();
	}

	/**
	 * add second
	 * @param integer $second
	 */
	public final function addSecond($second) {
		$this->second += $second;
		$this->_time = $this->makeTime ();
	}

	private final function parseDateTime($format = "d-m-Y H:i:s") {
		return date ( $format, $this->_time );
	}

	/**
	 * return difference of day
	 * @param DateTime $d
	 * @return number
	 */
	public final function dayDiff(DateTime $d) {
		return floor(((strtotime($d->getDate("Y-m-d")) + strtotime($d->getDate("H:i"))) - (strtotime($this->getDate("Y-m-d")) + strtotime($this->getDate("H:i")))) / (60*60*24));
	}

	/**
	 * return difference of hour
	 * @param DateTime $d
	 * @return number
	 */
	public final function hourDiff(DateTime $d){
		return floor($this->minuteDiff($d) / 60) . "." . $this->minuteDiff($d) % 60;
	}

	/**
	 * return difference of minute
	 * @param DateTime $d
	 * @return number
	 */
	public final function minuteDiff(DateTime $d){
		return (((strtotime($d->getDate("Y-m-d")) + strtotime($d->getDate("H:i"))) - (strtotime($this->getDate("Y-m-d")) + strtotime($this->getDate("H:i")))) / (60)) ;
	}

}

?>