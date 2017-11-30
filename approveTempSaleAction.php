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

$sql = "UPDATE yardsale set promoted='f', approved='y' WHERE id='$saleid'"; 

if ($mysqli->query($sql) === TRUE){
	echo "Sale updated.";
	header('Location: showSale.php?id=' . $saleid);
}  
else {
	echo "Something went wrong." . $mysqli->error;
}

$mysqli->close();

?>