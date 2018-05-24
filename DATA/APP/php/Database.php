<?php
include ("./User.php");
class Database {
	private $dbhost = 'database:3306';
	private $dbuser = 'root';
	private $dbpass = 'javier';
	private $dbname = 'bancodetrabajosalesiano';
	private $connection;
	
	/**
	 * Database Functions
	 */
	function __construct() {
		$this->initConnect ();
	}
	private function initConnect() {
		$this->connection = mysqli_connect ( $this->dbhost, $this->dbuser, $this->dbpass, $this->dbname );
		if (! $this->connection) {
			die ( 'Could not connect: ' . mysqli_error () );
		}
	}
	public function endConnect() {
		mysqli_close ( $this->connection );
	}
	private function extractRow($result) {
		if ($row = mysqli_fetch_array ( $result, MYSQLI_ASSOC )) {
			return $row;
		} else {
			return false;
		}
	}
	
	/**
	 * Skills Functions
	 */
	public function selectAllSkills() {
		$query = "SELECT * FROM habilidades";
		$results = mysqli_query ( $this->connection, $query );
		while ( $row = $this->extractRow ( $results ) ) {
			echo "<option value=\"" . $row ['idHabilidad'] . "\">" . $row ['habilidad'] . "</option>";
		}
	}
	
	/**
	 * Username Functions
	 */
	public function findPasswordFrom($username) {
		$query = "SELECT password FROM alumno WHERE username = '$username'";
		$result = mysqli_query ( $this->connection, $query );
		if ($row = mysqli_fetch_array ( $result, MYSQLI_ASSOC )) {
			return $row ['password'];
		} else {
			return "";
		}
	}
	public function assembleUserFromLogin($username, $password) {
		$query = "SELECT * FROM alumno WHERE username = '$username' AND password = '$password'";
		$result = mysqli_query ( $this->connection, $query );
		if ($row = mysqli_fetch_array ( $result, MYSQLI_ASSOC )) {
			return new User ( $row ['idAlumno'], $row ['nombre'], $row ['apellidos'], $row ['correo'], $row ['username'] );
		}
		return NULL;
	}
	
	/**
	 * Tutoring functions
	 */
	public function insertTutoring($tutory) {
		$query = "INSERT INTO tutoria (idAlumno, horario, idHabilidad) VALUES ($tutory->idAlumno, '$tutory->horario', $tutory->idHabilidad)";
		$success = mysqli_query ( $this->connection, $query );
		return $success;
	}
	public function selectTutoringBySkill($skill) {
		$query = "SELECT * FROM tutoria WHERE idTutelado IS NULL AND idHabilidad = $skill";
		$matches = mysqli_query ( $this->connection, $query );
		$results = array ();
		while ( $row = $this->extractRow ( $matches ) ) {
			$existingDate = new Tutory ( $row ['idAlumno'], $row ['horario'], $row ['idHabilidad'] );
			$results [] = $existingDate;
		}
		return $results;
	}
}