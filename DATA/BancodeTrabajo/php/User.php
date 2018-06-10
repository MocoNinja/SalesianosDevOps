<?php

class User {

    /**
     * Database Fields
     */
    public $idAlumno;
    public $nombre;
    public $apellidos;
    public $correo;
    public $username;

    function __construct($idAlumno, $nombre, $apellidos, $correo, $username) {
        $this->idAlumno = $idAlumno;
        $this->nombre = $nombre;
        $this->apellidos = $apellidos;
        $this->correo = $correo;
        $this->username = $username;
    }
    
    public static function assembleUserFromSession($session) {
        return new User($session ['idUser'], $session ['name'], $session ['lastname'], $session ['email'], $session ['username']);
    }

    public function getFullName() {
        return $this->nombre . " " . $this->apellidos;
    }

}
