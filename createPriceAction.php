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

$type = $mysqli->real_escape_string($_REQUEST['type']);
$amount = $mysqli->real_escape_string($_REQUEST['amount']);

$sql = "INSERT INTO price (type, amount VALUES ('$type', '$amount')"; 
if($mysqli->query($sql) === true){
	$sql2 = "select id from price where type='$type' and amount='$amount'";
	$result2 = $mysqli->query($sql2);
	$row2 = $result2->fetch_array();
	$id = $row2['id'];
	$url = 'showPrice.php?id=' . $id;
	header('Location:' . $url );
	echo "Price Category Created.";
} else {
	echo "Something went wrong. " . $mysqli->error;
}
$mysqli->close();
?>
