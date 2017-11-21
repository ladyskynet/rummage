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

$id = $mysqli->real_escape_string($_REQUEST['id']);
$type = $mysqli->real_escape_string($_REQUEST['type']);
$amount = $mysqli->real_escape_string($_REQUEST['amount']);

$sql = "UPDATE price set type='$type', amount='$amount' WHERE id='$id'"; 

if ($mysqli->query($sql) === TRUE){
	echo "Price updated.";
	header('Location: showPrice.php?id=' . $id);
} 
else {
	echo "Something went wrong." . $mysqli->error;
	#header('Location: welcome.php#profile');
}

$mysqli->close();

?>
