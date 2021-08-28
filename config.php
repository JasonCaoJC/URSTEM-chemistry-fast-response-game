<?php

/*

function autoloader($class) {

	include 'class.' . $class . '.php';

}



spl_autoload_register('autoloader');

autoloader("User");

*/



//Start Session

session_start();



//Verify user is logged in

$current_url = basename($_SERVER['REQUEST_URI']);



if (!isset($_SESSION["userid"]) && $current_url != 'login.php') {

	header("Location: login.php");

}

elseif (isset($_SESSION["userid"])) {

	if ($_SESSION["consent"] == -1 && $current_url != 'consentpage.php')

	{

		header("Location: consentpage.php");

	}

	//$user = new User($_SESSION['userid'], $database);

}



?>