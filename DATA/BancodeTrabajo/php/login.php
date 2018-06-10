<?php

include_once ('./Database.php');
include_once ('./User.php');
session_start();

$username = $_POST ['username'];
$password = $_POST ['password'];

$database = new Database ();
$real = $database->findPasswordFrom($username);

$page = "index.php";

if ($real == "" || $real != $password) {
    $_SESSION ['badLoginAttempt'] = "TRUE";
} else {
    // PHP no maneja bien la serialización de objetos de esta manera -> mejor evitarlo
    // $_SESSION['user'] = $database->assembleUserFromLogin($username, $password);
    $user = $database->assembleUserFromLogin($username, $password);
    if ($user != NULL) {
        $_SESSION ['idUser'] = $user->idAlumno;
        $_SESSION ['name'] = $user->nombre;
        $_SESSION ['lastname'] = $user->apellidos;
        $_SESSION ['email'] = $user->correo;
        $_SESSION ['username'] = $user->username;
        $page = "main.php";
    }
}
$database->endConnect();
header("location:/Salesianos/$page");
