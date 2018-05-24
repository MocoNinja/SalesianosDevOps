<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
</head>
<body>
    <?php
        session_start();
        if (isset($_SESSION['badLoginAttempt'])) {
            echo "<p>"."Credenciales incorrectas"."</p>";
            unset($_SESSION['badLoginAttempt']);
        }
    ?>
    <header>
    	<h1>Bienvenido al banco de trabajo Salesiano</h1>
    	<p>Introduce tus credenciales para continuar</p>
    </header>
    <form action="./php/login.php" method="post">
        <label for="username">Usuario: </label>
        <input type="text" name="username" placeholder="username" required />
        <br />
        <label for="username">Contraseña: </label>
        <input type="password" name="password" placeholder="password" required />
        <br />
        <input type="submit" value="Login" />
    </form>
</body>
</html>