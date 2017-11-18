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

$saleid = $mysqli->real_escape_string($_REQUEST['id']);

$sql = "DELETE FROM yardsale WHERE id='$saleid'"; 

if ($mysqli->query($sql) === TRUE){
	echo "Yard sale deleted.";
	header('Location: welcome.php#sales');
	
} 
else {
	echo "Something went wrong.";
	header('Location: showSale.php?id=' . $saleid);
}

$mysqli->close();

?>