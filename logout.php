<?php
session_start();
$_SESSION = array();
$mysqli = new mysqli("localhost", "root", "password", "yardsale");

if ($mysqli === false){
	die("ERROR: Could not connect. " . $mysqli->connect_error);
}

if (ini_get("session.use_cookies")) {
	$params = session_get_cookie_params();
	setcookie(session_name(), '', time() - 42000,
	$params["path"], $params["domain"], $params["secure"],
	$params["httponly"]);
}
exit();

session_destroy();
header("Location:index.html);
echo "<h3>You have been successfully logged out.</h3>";
?>

