<?php
require_once ('./Tutory.php');
require_once ('./Database.php');
include_once ('./sessionhandler.php');
$matches = $_SESSION['matches'];
$horario = $_SESSION['original'];

$case = "";

if (count($matches) == 0)
    $case = "NONE";

$decentMatches = array();
$perfectMatches = array();

foreach ($matches as $thisMatch) {
    $foundMatches = $horario->getCommonDays($thisMatch);
    foreach ($foundMatches as $currentMatch) {
        if ($currentMatch->hasPerfectMatch()) {
            $perfectMatches[] = $currentMatch;
        } else {
            $decentMatches[] = $currentMatch;
        }
    }
}

unset($foundMatches);

if ($case == "" && count($perfectMatches) == 0) {
    $case = "DECENT";
    $foundMatches = $decentMatches;
} else if ($case != "NONE") {
    $case = "PERFECT";
    $foundMatches = $perfectMatches;
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
        case "NONE":
            include '../static/empty.html';
            break;
        case "DECENT":
            include '../static/decent.html';
            break;
        case "PERFECT":
            include '../static/perfect.html';
            break;
        }
        
        foreach ($foundMatches as $currentMatch) {
            echo $currentMatch->toString();
        }
?>
</body>
</html>

