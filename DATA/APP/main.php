<?php
    include_once('./php/sessionhandler.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Main</title>
</head>
<body>
    <?php
        include('./dynamic/userHeader.php');
        if (isset($_SESSION['addedTutoring'])) {
            echo "<p>"."Tutoría añadida exitosamente! Gracias por tu colaboración ☺";
            unset($_SESSION['addedTutoring']);
        }
    ?>
    <h1>Bienvenido!</h1>
    <a href="./formulario.php">Banco de trabajo Salesiano</a>
</body>
</html>