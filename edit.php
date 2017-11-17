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

$saleid = $mysqli->real_escape_string($_REQUEST['saleid']);
$street = $mysqli->real_escape_string($_REQUEST['street']);
$city = $mysqli->real_escape_string($_REQUEST['city']);
$state = $mysqli->real_escape_string($_REQUEST['state']);
$zip = $mysqli->real_escape_string($_REQUEST['zip']);
$type = $mysqli->real_escape_string($_REQUEST['type']);
$eventdate = $mysqli->real_escape_string($_REQUEST['eventdate']);

$sql = "UPDATE yardsale set street='$street', city='$city', state='$state', zip='$zip', type='$type', eventdate='$eventdate' WHERE id='$saleid'"; 

if ($mysqli->query($sql) === TRUE){
	echo "Yard sale updated.";
	header("Location: showSale.php?id='" . $saleid . "'");
} 
else {
	echo "Something went wrong.";
	header('Location: create2.php#sales');
}

$mysqli->close();

?>
