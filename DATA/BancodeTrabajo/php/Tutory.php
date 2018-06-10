<?php

/**
 * Esta clase se encarga de reunir los datos de cada campo para poder 
 * hacer las comparaciones y matches de forma sencilla
 */
class Tutory {

    public $idAlumno;
    public $idHabilidad;
    public $horario;
    public $lunes;
    public $martes;
    public $miercoles;
    public $jueves;
    public $viernes;
    public $correoContacto;

    function __construct($idAlumno, $horario, $idHabilidad) {
        $this->setAlumno($idAlumno);
        $this->setAsignatura($idHabilidad);
        $this->setHorario($horario);
        $this->parse();
        $this->correoContacto = $this->getEmail();
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
        $msg = "IdAlumno:" . $this->idAlumno . "|Correo:" . $this->correoContacto . "|Asignatura:" . $this->idHabilidad . "|RawHorario:" . $this->horario;
        return $msg;
    }

    private function parse() {
        $dias = explode("#", $this->horario);
        // Genera un array de indices lunes, martes, ..., viernes.
        // Los valores de cada dia son otro vector con las distintas horas
        $this->lunes = explode("|", $dias [0]) [1];
        $this->martes = explode("|", $dias [1]) [1];
        $this->miercoles = explode("|", $dias [2]) [1];
        $this->jueves = explode("|", $dias [3]) [1];
        $this->viernes = explode("|", $dias [4]) [1];
    }

    private function getDaysDisplay() {
        echo "<td>";
        if ($this->lunes != "") {
            echo "<p>Lunes: " . $this->lunes . "</p>";
        }

        if ($this->martes != "") {
            echo "<p>Martes: " . $this->martes . "</p>";
        }

        if ($this->miercoles != "") {
            echo "<p>Miercoles: " . $this->miercoles . "</p>";
        }

        if ($this->jueves != "") {
            echo "<p>Jueves: " . $this->jueves . "</p>";
        }

        if ($this->viernes != "") {
            echo "<p>Viernes: " . $this->viernes . "</p>";
        }
        echo "</td>";
    }

    private function getSkillDisplayName() {
        $db = new Database();
        $name = $db->getNameOfSkillById($this->idHabilidad);
        $db->endConnect();
        return $name;
    }

    private function getActionButtons() {
        echo "<td id=\"deleteButton\">" .
        "<form id=\"deleteForm$this->idAlumno$this->idHabilidad\"  method=\"POST\" action=\"./php/delete.php\">" .
        "<input type=\"text\" hidden=\"hidden\" name=\"tutor\" value=\"" . $this->idAlumno . "\" />" .
        "<input type=\"text\" hidden=\"hidden\" name=\"skill\" value=\"" . $this->idHabilidad . "\" />" .
        "<a href=\"#\" onclick=\"document.forms['deleteForm$this->idAlumno$this->idHabilidad'].submit();\">Borrar</a>" .
        "</form>" .
        "</td>";

        echo "<td id=\"updateButton\">" .
        "<form id=\"updateForm$this->idAlumno$this->idHabilidad\"  method=\"POST\" action=\"./php/update.php\">" .
        "<input type=\"text\" hidden=\"hidden\" name=\"tutor\" value=\"" . $this->idAlumno . "\" />" .
        "<input type=\"text\" hidden=\"hidden\" name=\"skill\" value=\"" . $this->idHabilidad . "\" />" .
        "<input type=\"text\" hidden=\"hidden\" name=\"horario\" value=\"" . $this->horario . "\">" .
        "<a href=\"#\" onclick=\"document.forms['updateForm$this->idAlumno$this->idHabilidad'].submit();\">Actualizar</a>" .
        "</form>" .
        "</td>";
    }

    public function getTableRowForDisplay() {
        echo "<tr>";
        echo "<td>" . $this->getSkillDisplayName() . "</td>";
        echo $this->getDaysDisplay();
        echo $this->getActionButtons();
        echo "</tr>";
    }

    private function getEmail() {
        $db = new Database();
        $email = $db->getEmailFromUser($this->idAlumno);
        $db->endConnect();
        return $email;
    }

    public function getDaysThatMatch($tutory) {
        $matches = array();
        if ($this->lunes !== '' && $tutory->lunes !== '') {
            $matches [] = new Match("LUNES", $tutory->lunes, $this->lunes, $tutory->idAlumno);
        }
        if ($this->martes !== '' && $tutory->martes !== '') {
            $matches [] = new Match("MARTES", $tutory->martes, $this->martes, $tutory->idAlumno);
        }
        if ($this->miercoles !== '' && $tutory->miercoles !== '') {
            $matches [] = new Match("MIERCOLES", $tutory->miercoles, $this->miercoles, $tutory->idAlumno);
        }
        if ($this->jueves !== '' && $tutory->jueves !== '') {
            $matches [] = new Match("JUEVES", $tutory->jueves, $this->jueves, $tutory->idAlumno);
        }
        if ($this->viernes !== '' && $tutory->viernes !== '') {
            $matches [] = new Match("VIERNES", $tutory->viernes, $this->viernes, $tutory->idAlumno);
        }
        return $matches;
    }
    
    public function getMatchInformation() {
        $db = new Database();
        $user = $db->assembleUserFromId($this->idAlumno);
        $fullName = $user->getFullName();
        echo "<hr />";
        echo "<div id=\"matchFrom$this->idAlumno\">";
        echo "<p>Alumno que oferta: " . $fullName . "</p>";
        echo "<p>Información de contacto: " . $this->correoContacto . "</p>";
        echo "<p>Disponibilidad horaria</p>";
        echo $this->getDaysDisplay();
        echo "<hr />";
        echo "</div>";
        $db->endConnect();
    }

    
}
