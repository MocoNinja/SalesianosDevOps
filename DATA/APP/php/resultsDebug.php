<?php
require_once ('./Tutory.php');
require_once ('./Database.php');
include_once ('./sessionhandler.php');
$matches = $_SESSION ['matches'];
$horario = $_SESSION ['original'];

$case = "";

if (count ( $matches ) == 0)
	$case = "NONE";

// unset($_SESSION ['matches']);
// unset($_SESSION['original']);

/*
 * Si lo borro, dará problemas si se refresca la pagina
 * Algo interesante sería poder añadir validaciones en plan: tu sesión ha expirado o algo asi
 */
/*
echo gettype($horario->lunes);
echo "<br />";
echo "lunes".$horario->lunes;
echo "<br />";
echo "EMPTY?".empty(($horario->lunes));
echo "<br />";
echo "==".($horario->lunes === '');
echo "<br />";
echo gettype($horario->martes);
echo "<br />";
echo "martes".$horario->martes;
echo "<br />";
echo "EMPTY?".empty(($horario->martes));
echo "<br />";
echo "==".($horario->martes=== '');
echo "<br />";

echo $horario->printDias();
foreach ($matches as $thisMatch) {
	echo "COMPARANDO MATCH:";
	echo "<br />";
	echo $thisMatch->printDias();
	$horario->getCommonDays($thisMatch);
}
*/
	
	$decentMatches = array();
	$perfectMatches = array();
	
	foreach ($matches as $thisMatch) {
		$foundMatches = $horario->getCommonDays($thisMatch);
		echo "FOUND".count($foundMatches)."MATCHES";
		echo "<br />";
		foreach ($foundMatches as $currentMatch){
			echo $currentMatch->toString();
			echo "<br />";
			if ($currentMatch->hasPerfectMatch()) {
			    echo "match perfecto";
			    echo "<br />";
			    $perfectMatches[] = $currentMatch;
			} else {
			    echo "Match no perfecto";
			    echo "<br />";
			    $decentMatches[] = $currentMatch;
			}
			echo "<br />";
		}
	}
	
	echo "<p>MatchesNormalillos</p><br />";
	foreach ($decentMatches as $currentMatch){
	    echo $currentMatch->toString();
	}
	echo "<p>MatchesPerfectos</p><br />";
	foreach ($decentMatches as $currentMatch){
	    echo $currentMatch->toString();
	}
	
	if ($case == "" && count($perfectMatches) == 0) {
	    $case = "DECENT";
	} else if ($case != "NONE"){
	    $case = "PERFECT";
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Resultados</title>
</head>
<body>
	<?php
	switch ($case) {
		case "NONE" :
			include '../static/empty.html';
			break;
		case "DECENT" :
		    include '../static/decent.html';
			break;
		case "PERFECT" :
		    include '../static/perfect.html';
		    break;
	}
	?>
</body>
</html>

