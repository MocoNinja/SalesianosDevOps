
<?php
require_once('Tutory.php');
include_once('./sessionhandler.php');
echo "<h1>"."Análisis del POST"."</h1>";

echo "<p>"."USUARIO: ".$_SESSION['idUser']."; ".$_SESSION['username']."|".$_SESSION['name']."   ".$_SESSION['lastname']."</p>";
echo <<<EOL
<table>
<thead>
<tr>
	<th>CLAVE</th>
	<th>VALOR</th>
<tr>
</thead>
<tbody>
EOL;
foreach($_POST as $key => $value){
	echo "<tr>";
	echo"<td>".$key."</td>";
	echo"<td>".$value."</td>";
	echo "</tr>";
}
echo <<<EOL
</tbody>
</table>
EOL;
$string = "LUNES|".$_POST['lunes']."#MARTES|".$_POST['martes']."#MIERCOLES|".$_POST['miercoles']."#JUEVES|".$_POST['jueves']."#VIERNES|".$_POST['viernes']."#";
echo "<p>"."El valor que se almacenará en la base de datos es: ".$string."</p>";

$horario = new Tutory("default", $_POST['actividad'], $string);
echo "<p>".$horario->toString()."</p>";

$horario->printLunes();
$horario->printMartes();
$horario->printMiercoles();
$horario->printJueves();
$horario->printViernes();


/*
$horarios = explode("#",$string);


foreach($horarios as $diaCompleto){
	echo "<h1>"."String a parsear"."</h1>"."<hr />";
	echo "<p>".$diaCompleto."</p>";
	$datosDia = explode("|", $diaCompleto);
	echo "<p>"."Día: ".$datosDia[0]."</p>";
	echo "<p>"."Horas: ".$datosDia[1]."</p>";
	$horas = explode(";",$datosDia[1]);
	foreach($horas as $hora){
		echo "<p>"."Hora disponible: ".$hora."</p>";
	}
	
}
*/