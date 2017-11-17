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
$street = $mysqli->real_escape_string($_REQUEST['street']);
$city = $mysqli->real_escape_string($_REQUEST['city']);
$state = $mysqli->real_escape_string($_REQUEST['state']);
$zip = $mysqli->real_escape_string($_REQUEST['zip']);
$type = $mysqli->real_escape_string($_REQUEST['type']);
$eventdate = $mysqli->real_escape_string($_REQUEST['eventdate']);
$userid = $_SESSION['id'];

$sql = "UPDATE yardsale (street, city, state, zip, type, uid, eventdate) VALUES ('$street', '$city', '$state', '$zip', '$type', '$userid', '$eventdate') WHERE id='$id'"; 

if ($mysqli->query($sql) === TRUE){
	echo "Yard sale updated.";
	header('Location: create2.php#show?id=' . $id);
} 
else {
	echo "Something went wrong.";
	#header('Location: create2.php#sales');
	echo $id;
	echo $street;
	echo $city;
	echo $zip;
	echo $type;
	echo $eventdate;
	echo $userid;
}

$mysqli->close();

?>
