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

$priceid = $mysqli->real_escape_string($_REQUEST['id']);

$sql = "DELETE FROM price WHERE id='$priceid'"; 

if ($mysqli->query($sql) === TRUE){
	echo "Price deleted.";
	header('Location: prices.php');
} 
else {
	echo "Something went wrong." . $mysqli->error;
	#header('Location: showPrice.php?id=' . $priceid);
}

$mysqli->close();

?>