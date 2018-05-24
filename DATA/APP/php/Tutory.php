<?php
/**
 * Esta clase se encarga de reunir los datos de cada campo para poder 
 * hacer las comparaciones y matches de forma sencilla
 */
require_once ('./Match.php');
class Tutory {
	public $idAlumno;
	public $idHabilidad;
	public $horario;
	public $lunes;
	public $martes;
	public $miercoles;
	public $jueves;
	public $viernes;
	function __construct($idAlumno, $horario, $idHabilidad) {
		$this->setAlumno ( $idAlumno );
		$this->setAsignatura ( $idHabilidad );
		$this->setHorario ( $horario );
		$this->parse ();
	}
	private function setAlumno($idAlumno) {
		$this->idAlumno = $idAlumno;
	}
	private function setAsignatura($asignatura) {
		$this->idHabilidad = $asignatura;
	}
	private function setHorario($horario) {
		$this->horario = $horario;
	}
	public function toString() {
		$msg = "IdAlumno:" . $this->idAlumno . "|Asignatura:" . $this->idHabilidad . "|RawHorario:" . $this->horario;
		return $msg;
	}
	private function parse() {
		$dias = explode ( "#", $this->horario );
		// Genera un array de indices lunes, martes, ..., viernes.
		// Los valores de cada dia son otro vector con las distintas horas
		$this->lunes = explode ( "|", $dias [0] ) [1];
		$this->martes = explode ( "|", $dias [1] ) [1];
		$this->miercoles = explode ( "|", $dias [2] ) [1];
		$this->jueves = explode ( "|", $dias [3] ) [1];
		$this->viernes = explode ( "|", $dias [4] ) [1];
	}
	public function printDias() {
		echo "<p>Lunes:" . $this->lunes . "</p>";
		echo "<p>Martes:" . $this->martes . "</p>";
		echo "<p>Miercoles:" . $this->miercoles . "</p>";
		echo "<p>Jueves:" . $this->jueves . "</p>";
		echo "<p>Viernes:" . $this->viernes . "</p>";
	}
	public function getCommonDays($tutory) {
		$matches = array ();
		if ($this->lunes !== '' && $tutory->lunes !== '') {
			$matches [] = new Match ( "LUNES", $tutory->lunes, $this->lunes, $tutory->idAlumno );
		}
		if ($this->martes !== '' && $tutory->martes !== '') {
			$matches [] = new Match ( "MARTES", $tutory->lunes, $this->lunes, $tutory->idAlumno );
		}
		if ($this->miercoles !== '' && $tutory->miercoles !== '') {
			$matches [] = new Match ( "MIERCOLES", $tutory->lunes, $this->lunes, $tutory->idAlumno );
		}
		if ($this->jueves !== '' && $tutory->jueves !== '') {
			$matches [] = new Match ( "JUEVES", $tutory->lunes, $this->lunes, $tutory->idAlumno );
		}
		if ($this->viernes !== '' && $tutory->viernes !== '') {
			$matches [] = new Match ( "VIERNES", $tutory->lunes, $this->lunes, $tutory->idAlumno );
		}
		return $matches;
	}
	/*
	 * public function printLunes() {
	 * $horas = explode ( ";", $this->lunes );
	 * echo "<p>Horarios del lunes</p>";
	 * $this->readArray ( $horas );
	 * }
	 * public function printMartes() {
	 * $horas = explode ( ";", $this->martes );
	 * echo "<p>Horarios del martes</p>";
	 * $this->readArray ( $horas );
	 * }
	 * public function printMiercoles() {
	 * $horas = explode ( ";", $this->miercoles );
	 * echo "<p>Horarios del miercoles</p>";
	 * $this->readArray ( $horas );
	 * }
	 * public function printJueves() {
	 * $horas = explode ( ";", $this->jueves );
	 * echo "<p>Horarios del jueves</p>";
	 * $this->readArray ( $horas );
	 * }
	 * public function printViernes() {
	 * $horas = explode ( ";", $this->viernes );
	 * echo "<p>Horarios del viernes</p>";
	 * $this->readArray ( $horas );
	 * }
	 * public function readArray($horas) {
	 * foreach ( $horas as $hora ) {
	 * echo "<p>" . "Hora disponible: " . $hora . "</p>";
	 * }
	 * }
	 */
}