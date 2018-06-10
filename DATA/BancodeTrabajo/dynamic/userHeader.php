<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<?php

include_once './php/headers.php';

$loggedInUser = User::assembleUserFromSession($_SESSION);

echo "<nav class='navbar navbar-inverse'style='padding:5px;'>
  		<div class='container-fluid'>";
echo "<div class='navbar-header'>
     	<a href='./main.php'><img src='workplace.png'></img></a>
      </div>";
echo "<ul class='nav navbar-nav'>
      	<li><a href=\"./formulario.php\">Solicitar / Ofrecer tutoría</a></li>
      	<li><a href=\"./list.php\">Mis tutorías</a></li>
      </ul>";
echo "<div class='text-success'>";
echo "Estás logueado como: " . $loggedInUser->getFullName() . ". Pulsa <a href=\"./php/logout.php\">aquí</a> para cerrar sesión.";
echo "</div></nav>";
