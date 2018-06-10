<?php
        session_start();
        if (isset($_SESSION['badLoginAttempt'])) {
            echo "<p>" . "Credenciales incorrectas" . "</p>";
            unset($_SESSION['badLoginAttempt']);
        }
?>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Login</title>
    </head>
    <body class="container">
        <header>
            <h1>Bienvenido al banco de trabajo Salesiano</h1>
            <p>Introduce tus credenciales para continuar</p>
        </header>
        <form action="./php/login.php" method="post">
            <label for="username">Usuario: </label>
            <input type="text" name="username" placeholder=" Username" required />
            <br />
            <label for="username">Contraseña: </label>
            <input type="password" name="password" placeholder=" Password" required />
            <br />
            <input class='btn btn-primary' type="submit" value="Login" />
        </form>
    </body>
</html>
