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
$name = $mysqli->real_escape_string($_REQUEST['name']);
$description = $mysqli->real_escape_string($_REQUEST['description']);
$price = $mysqli->real_escape_string($_REQUEST['price']);

$sql = "UPDATE price set type='$type', amount='$amount' WHERE id='$id'"; 

if ($mysqli->query($sql) === TRUE){
	echo "Price updated.";
	header('Location: showPrice.php?id=' . $id);
} 
else {
	echo "Something went wrong.";
	header('Location: welcome.php#sales');
}

$mysqli->close();

?>
