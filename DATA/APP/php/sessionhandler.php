<?php
session_start ();

if (! isset ( $_SESSION ['username'] )) {
	header ( "location:/Salesianos/static/errorsesion.html" );
	die ();
}