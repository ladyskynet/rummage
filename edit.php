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
$userid = $mysqli->real_escape_string($_REQUEST['uid']);

$sql = "UPDATE yardsale (id, street, city, state, zip, type, uid, eventdate) VALUES ('$saleid', '$street', '$city', '$state', '$zip', '$type', '$userid', '$eventdate') WHERE id='$saleid'"; 

if ($mysqli->query($sql) === TRUE){
	echo "Yard sale updated.";
	header('Location: create2.php#show?id=' . $id);
} 
else {
	echo "Something went wrong." . $mysqli->error();
	#header('Location: create2.php#sales');
	echo $id . "<br>";
	echo $street . "<br>";
	echo $city . "<br>";
	echo $zip . "<br>";
	echo $type . "<br>";
	echo $eventdate . "<br>";
	echo $userid . "<br>";
}

$mysqli->close();

?>
