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

$sql = "UPDATE yardsale set promoted='y', approved='y' WHERE id='$saleid'"; 

if ($mysqli->query($sql) === TRUE){
	
	$sql2 = "DELETE FROM temp WHERE sid='$saleid' and itemid is NULL"; 
	echo $sql2;
	if ($mysqli->query($sql2) === TRUE){
		echo "Sale updated.";
		#header('Location: showSale.php?id=' . $saleid);
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
