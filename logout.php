<?php
session_start();

$mysqli = new mysqli("localhost", "root", "password", "yardsale");

if ($mysqli === false){
	die("ERROR: Could not connect. " . $mysqli->connect_error);
}
exit();

header('Location: http://128.163.141.189');
?>

