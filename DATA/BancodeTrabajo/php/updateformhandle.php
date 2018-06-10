<?php 

$string = "LUNES|" . $_POST ['lunes'] . "#MARTES|" . $_POST ['martes'] . "#MIERCOLES|" . $_POST ['miercoles'] . "#JUEVES|" . $_POST ['jueves'] . "#VIERNES|" . $_POST ['viernes'] . "#";
include_once('./Database.php');
$database = new Database ();
$database->updateTutoring($_POST['tutor'],$_POST['skill'],$string); 
echo "<script>location.href='../list.php';</script>";
?>
