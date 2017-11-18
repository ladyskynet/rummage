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

$street = $mysqli->real_escape_string($_REQUEST['street']);
$city = $mysqli->real_escape_string($_REQUEST['city']);
$state = $mysqli->real_escape_string($_REQUEST['state']);
$zip = $mysqli->real_escape_string($_REQUEST['zip']);
$type = $mysqli->real_escape_string($_REQUEST['type']);
echo $type;
$eventdate = $mysqli->real_escape_string($_REQUEST['eventdate']);
$userid = $_SESSION['id'];

$sql2 = "INSERT INTO yardsale (street, city, state, zip, type, uid, eventdate) VALUES ('$street', '$city', '$state', '$zip', '$type', '$userid', '$eventdate')"; 

if($mysqli->query($sql2) === true){
	header('Location: sales.php');
	echo "Rummage sale created.";
} else {
	header('Location: welcome.php#profile');
	echo "Something went wrong. " . $mysqli->error;
}
$mysqli->close();

?>
