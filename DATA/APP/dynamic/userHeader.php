<?php
include_once ('./php/sessionhandler.php');
require_once ('./php/User.php');

$loggedInUser = User::assembleUserFromSession ( $_SESSION );

echo "<div>";
echo "Estás logueado como: " . $loggedInUser->getFullName () . ". Pulsa <a href=\"./php/logout.php\">aquí</a> para cerrar sesión.";
echo "</div>";
