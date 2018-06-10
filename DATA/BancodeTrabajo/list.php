<?php

require_once './php/headers.php';
require_once './dynamic/userHeader.php';


$idAlumnoListing = $_SESSION ['idUser'];

$database = new Database();

$tutories = $database->selectTutoringByUser($idAlumnoListing);

echo "<table class='table table-hover'>";
echo "<thead>" . "<tr>";
echo "<th>" . "Asignatura en oferta" . "</th>";
echo "<th>" . "Horario actual" . "</th>";
echo "<th>" . "Opciones" . "</th>";
echo "</thead>" . "</tr>";
echo "<tbody>";
foreach ($tutories as $tutory) {
    echo $tutory->getTableRowForDisplay();
}
echo "<tbody>";
echo "</table>";
