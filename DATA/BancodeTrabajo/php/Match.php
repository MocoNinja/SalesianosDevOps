<?php

class Match {

    public $day;
    public $hoursAvailable;
    public $hoursRequested;
    public $tutor;
    public $contactEmail;
    public $matchInterval;
    public $targetInterval;

    function __construct($day, $hoursAvailable, $hoursRequested, $tutorId) {
        $this->day = $day;
        $this->hoursAvailable = $hoursAvailable;
        $this->hoursRequested = $hoursRequested;
        $this->tutor = $tutorId;
        $this->contactEmail = $this->getEmail();
        $this->matchInterval = NULL;
        $this->targetInterval = NULL;
    }

    private function getEmail() {
        $db = new Database();
        $email = $db->getEmailFromUser($this->tutor);
        $db->endConnect();
        return $email;
    }

    public function toString() {
        $msg = "===== MATCH =====" .
                "EMAIL " . $this->contactEmail .
                "TUTOR " . $this->getTutorName() .
                "DIA " . $this->day .
                "HORAS DISPONIBLES " . $this->hoursAvailable .
                "HORAS PEDIDAS " . $this->hoursRequested
                . "<br />";
        echo $msg;
    }

    public function hasPerfectMatch() {
        $listAvailable = explode(";", $this->hoursAvailable);
        $listRequested = explode(";", $this->hoursRequested);
        foreach ($listRequested as $requested) {
            foreach ($listAvailable as $available) {
                $timesAvailable = explode("-", $available);
                $timesRequested = explode("-", $requested);
                if ($this->parseHours($timesAvailable, $timesRequested))
                    return true;
            }
        }
        return false;
    }

    private function getTutorName() {
        $db = new Database();
        $user = $db->assembleUserFromId($this->tutor);
        $fullName = $user->getFullName();
        $db->endConnect();
        return $fullName;
    }

    private function parseHours($timesAvailable, $timesRequested) {

        // Available
        $beginHourAvailable = explode(":", $timesAvailable [0]) [0];
        $beginMinuteAvailable = explode(":", $timesAvailable [0]) [1];
        $endHourAvailable = explode(":", $timesAvailable [1]) [0];
        $endMinuteAvailable = explode(":", $timesAvailable [1]) [1];
        // Requested
        $beginHourRequested = explode(":", $timesRequested [0]) [0];
        $beginMinuteRequested = explode(":", $timesRequested [0]) [1];
        $endHourRequested = explode(":", $timesRequested [1]) [0];
        $endMinuteRequested = explode(":", $timesRequested [1]) [1];
        /*
          echo "DEBUG HOURS";
          echo "AVAILABLE";
          echo $beginHourAvailable . ":" . $beginMinuteAvailable . "-" . $endHourAvailable . ":" . $endMinuteAvailable;
          echo "REQUESTED";
          echo $beginHourRequested . ":" . $beginMinuteRequested . "-" . $endHourRequested . ":" . $endMinuteRequested;
         */
        $validHour = $beginHourRequested >= $beginHourAvailable && $beginHourRequested <= $endHourAvailable;
        $minuteInRange = $beginMinuteRequested >= $beginMinuteAvailable && $beginMinuteRequested <= $endMinuteAvailable;
        $validMinute = ((($beginHourRequested == $endHourAvailable) || ($endHourRequested == $endHourAvailable)) && $minuteInRange) || true;

        $perfectMatch = $validHour && $validMinute;

        $this->matchInterval = $beginHourAvailable . ":" . $beginMinuteAvailable . "-" . $endHourAvailable . ":" . $endMinuteAvailable;
        $this->targetInterval = $beginHourRequested . ":" . $beginMinuteRequested . "-" . $endHourRequested . ":" . $endMinuteRequested;
        
        return $perfectMatch;
    }

    public function getMatchInformation() {
        echo "<div id=\"perfectMatchFrom$this->tutor\">";
        echo "<hr />";
        echo "<p>Alumno que oferta: " . $this->getTutorName() . "</p>";
        echo "<p>Información de contacto: " . $this->contactEmail . "</p>";
        echo "<p>Disponibilidad horaria</p>";
        echo "<p>Has pedido: " . $this->targetInterval . "</p>";
        echo "<p>El alumno oferta: " . $this->matchInterval . "</p>";
        echo "<hr />";
        echo "</div>";
    }

}
