<?php

session_start();
session_destroy();
header("location:/Salesianos/index.php");
die();
