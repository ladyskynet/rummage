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

$sql = "DELETE FROM item WHERE id='itemid'"; 

if ($mysqli->query($sql) === TRUE){
	echo "Item deleted.";
	#header('Location: sales.php');
} 
else {
	echo "Something went wrong.";
	#header('Location: showItem.php?id=' . $itemid);
}

$mysqli->close();

?>