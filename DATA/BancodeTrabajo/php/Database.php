<?php

class Database {

    private $dbhost = 'database:3306';
    private $dbuser = 'javier';
    private $dbpass = 'javier';
    private $dbname = 'bancodetrabajosalesiano';
    private $connection;

    /**
     * Database Functions
     */
    function __construct() {
        $this->initConnect();
    }

    private function initConnect() {
        $this->connection = mysqli_connect($this->dbhost, $this->dbuser, $this->dbpass, $this->dbname);
        if (!$this->connection) {
            die('Could not connect: ' . mysqli_error());
        }
    }

    public function endConnect() {
        mysqli_close($this->connection);
    }

    private function extractRow($result) {
        if ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
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
        $results = mysqli_query($this->connection, $query);
        while ($row = $this->extractRow($results)) {
            echo "<option value=\"" . $row ['idHabilidad'] . "\">" . $row ['habilidad'] . "</option>";
        }
    }
    
    public function getNameOfSkillById($idSkill) {
        $query = "SELECT habilidad FROM habilidades WHERE idHabilidad='$idSkill'" ;
        $result = mysqli_query($this->connection, $query);
        if ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            return $row ['habilidad'];
        }
        return NULL;
    }

    /**
     * Username Functions
     */
    public function findPasswordFrom($username) {
        $query = "SELECT password FROM alumno WHERE username = '$username'";
        $result = mysqli_query($this->connection, $query);
        if ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            return $row ['password'];
        } else {
            return "";
        }
    }

    public function assembleUserFromLogin($username, $password) {
        $query = "SELECT * FROM alumno WHERE username = '$username' AND password = '$password'";
        $result = mysqli_query($this->connection, $query);
        if ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            return new User($row ['idAlumno'], $row ['nombre'], $row ['apellidos'], $row ['correo'], $row ['username']);
        }
        return NULL;
    }
    
    public function getEmailFromUser($idAlumno) {
        $query = "SELECT correo FROM alumno WHERE idAlumno = $idAlumno";
        $result = mysqli_query($this->connection, $query);
        if ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            return $row ['correo'];
        }
        return NULL;
    }

    public function assembleUserFromId($id) {
        $query = "SELECT * FROM alumno WHERE idAlumno = $id";
        $result = mysqli_query($this->connection, $query);
        if ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            return new User($row ['idAlumno'], $row ['nombre'], $row ['apellidos'], $row ['correo'], $row ['username']);
        }
        return NULL;
    }
    
    /**
     * Tutoring functions
     */
    public function insertTutoring($tutory) {
        $query = "INSERT INTO tutoria (idAlumno, horario, idHabilidad) VALUES ($tutory->idAlumno, '$tutory->horario', $tutory->idHabilidad)";
        $success = mysqli_query($this->connection, $query);
        return $success;
    }

    public function selectTutoringBySkill($skill, $self) {
        $query = "SELECT * FROM tutoria WHERE idTutelado IS NULL AND idHabilidad = $skill AND idAlumno != '$self'";
        $matches = mysqli_query($this->connection, $query);
        $results = array();
        while ($row = $this->extractRow($matches)) {
            $existingDate = new Tutory($row ['idAlumno'], $row ['horario'], $row ['idHabilidad']);
            $results [] = $existingDate;
        }
        return $results;
    }

    public function selectTutoringByUser($iduser) {
        $query = "SELECT * FROM tutoria WHERE idTutelado IS NULL AND idAlumno = $iduser";
        $matches = mysqli_query($this->connection, $query);
        $results = array();
        while ($row = $this->extractRow($matches)) {
            $tutory = new Tutory($row ['idAlumno'], $row ['horario'], $row ['idHabilidad']);
            $results [] = $tutory;
        }
        return $results;
    }

    public function deleteTutoring($iduser, $idHabilidad) {
        $query = "DELETE FROM tutoria WHERE idHabilidad=$idHabilidad and idAlumno=$iduser";
        $success = mysqli_query($this->connection, $query);
        return $success;
    }
    public function updateTutoring($iduser, $idHabilidad, $horario) {
        $query = "UPDATE tutoria SET horario='$horario' WHERE idAlumno=$iduser and idHabilidad=$idHabilidad";
        $success = mysqli_query($this->connection, $query);
        echo $iduser, $idHabilidad, $horario;
        return $success;
    } 

}
