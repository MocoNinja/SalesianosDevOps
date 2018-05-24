<?php
class Match {
	public $day;
	public $hoursAvailable;
	public $hoursRequested;
	public $studentOffering;
	function __construct($day, $hoursAvailable, $hoursRequested, $studentOffering) {
		$this->day = $day;
		$this->hoursAvailable = $hoursAvailable;
		$this->hoursRequested = $hoursRequested;
		$this->studentOffering = $studentOffering;
	}
	public function toString() {
		$msg = "---MATCH---<br />DAY:" . $this->day . "<br />BY:" . $this->studentOffering . "<br />AVAILABLE:" . $this->hoursAvailable . "<br />REQUESTED" . $this->hoursRequested;
		return $msg;
	}
	public function hasPerfectMatch() {
		$listAvailable = explode ( ";", $this->hoursAvailable );
		$listRequested = explode ( ";", $this->hoursRequested );
		foreach ( $listRequested as $requested ) {
			foreach ( $listAvailable as $available ) {
				$timesAvailable = explode ( "-", $available );
				$timesRequested = explode ( "-", $requested );
				if ($this->parseHours($timesAvailable, $timesRequested)) return true;
			}
		}
		return false;
	}
	private function parseHours($timesAvailable, $timesRequested) {
		// Available
		$beginHourAvailable = explode ( ":", $timesAvailable [0] ) [0];
		$beginMinuteAvailable = explode ( ":", $timesAvailable [0] ) [1];
		$endHourAvailable = explode ( ":", $timesAvailable [1] ) [0];
		$endMinuteAvailable = explode ( ":", $timesAvailable [1] ) [1];
		// Requested
		$beginHourRequested = explode ( ":", $timesRequested [0] ) [0];
		$beginMinuteRequested = explode ( ":", $timesRequested [0] ) [1];
		$endHourRequested = explode ( ":", $timesRequested [1] ) [0];
		$endMinuteRequested = explode ( ":", $timesRequested [1] ) [1];
		
		$validHour = $beginHourRequested >= $beginHourAvailable && $beginHourRequested <= $endHourAvailable;
		$minuteInRange = $beginMinuteRequested >= $beginMinuteAvailable && $beginHourRequested <= $endMinuteAvailable;
		$validMinute = ((($beginHourRequested == $endHourAvailable) || ($endHourRequested == $endHourAvailable))
		    && $minuteInRange) || true;
		
		return $validHour && $validMinute;
	}
}