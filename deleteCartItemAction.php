<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "password";
$dbname = "yardsale";

$mysqli = new mysqli($servername, $username, $password, $dbname);

if ($mysqli === false){
	die("Connection failed: " . $mysqli->connect_error);
}

$itemid = $mysqli->real_escape_string($_REQUEST['id']);

$sql = "UPDATE item set promoted='n' where id='$itemid'";

if ($mysqli->query($sql) === true){
	echo "Item deleted from cart.";
	header('Location: sales.php');
	
} else {
	echo "Something went wrong." . $mysqli->error;
}

$mysqli->close();

?>