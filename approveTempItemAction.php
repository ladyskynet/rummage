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

$sql = "UPDATE item set promoted='y', approved='y' WHERE id='$id'"; 

if ($mysqli->query($sql) === TRUE){
	echo "Item updated.";
	$sql2 = "DELETE FROM temp WHERE itemid='$id'"; 
	if ($mysqli->query($sql2) === TRUE){
		echo "Item updated.";
		header('Location: showItem.php?id=' . $id);
	} else {
		echo "Something went wrong." . $mysqli->error;
	}
} 
else {
	echo "Something went wrong." . $mysqli->error;
	#header('Location: welcome.php#sales');
}

$mysqli->close();

?>
