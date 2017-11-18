<?php
session_start();
$_SESSION = array();
$mysqli = new mysqli("localhost", "root", "password", "yardsale");

if ($mysqli === false){
	die("ERROR: Could not connect. " . $mysqli->connect_error);
}

exit();

session_destroy();

header("Location:index.html");

echo "<h3>You have been successfully logged out.</h3>";
?>

