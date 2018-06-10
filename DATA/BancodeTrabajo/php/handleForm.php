<?php

include_once '../php/headers.php';

$string = "LUNES|" . $_POST ['lunes'] . "#MARTES|" . $_POST ['martes'] . "#MIERCOLES|" . $_POST ['miercoles'] . "#JUEVES|" . $_POST ['jueves'] . "#VIERNES|" . $_POST ['viernes'] . "#";
$horario = new Tutory($_SESSION ['idUser'], $string, $_POST ['actividad']);
$database = new Database ();
$redirect = "main.php";

if ($_POST ['modalidad'] == "OFERTA") {
    if ($database->insertTutoring($horario)) {
        $_SESSION ['addedTutoring'] = "TRUE";
    } else {
        $redirect = "static/errortutor.html";
    }
} else {
    $matches = $database->selectTutoringBySkill($_POST ['actividad'], $_SESSION['idUser']);
    $_SESSION ['matches'] = $matches;
    $_SESSION ['original'] = $horario;
    $redirect = "results.php";
}

unset($horario);
$database->endConnect();
header("location:/Salesianos/" . $redirect);
