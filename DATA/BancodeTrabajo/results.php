<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<?php
require_once ('./php/Tutory.php');
require_once './php/headers.php';

if (isset($_SESSION['matches']) && isset($_SESSION['original'])) {
    // Requestsed and found tutories
    $availableTutories = $_SESSION['matches'];
    $horario = $_SESSION['original'];
    // unset($_SESSION['original']);
    // unset($_SESSION['matches']);
} else {
    header("location:/Salesianos/main.php");
} 

$case = "";

if (count($availableTutories) == 0) {
    $case = "NONE";
} 

$decentMatches = array();
$perfectMatches = array();

foreach ($availableTutories as $tutory) {
    $foundMatches = $horario->getDaysThatMatch($tutory);
    if (count($foundMatches) == 0) {
        $decentMatches = $availableTutories;
    } else {
        foreach ($foundMatches as $currentMatch) {
            if ($currentMatch->hasPerfectMatch()) {
                $perfectMatches[] = $currentMatch;
            } else {
                $decentMatches[] = $currentMatch;
            }
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
    <body class="container">
        <br/>
        <?php
        switch ($case) {
            case "NONE":
                include './static/empty.html';
                break;
            case "DECENT":
                include './static/decent.html';
                break;
            case "PERFECT":
                include './static/perfect.html';
                break;
        }
        foreach ($foundMatches as $match) {
            echo $match->getMatchInformation();
        }
        ?>
    </body>
</html>
