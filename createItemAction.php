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
$name = $mysqli->real_escape_string($_REQUEST['name']);
$description = $mysqli->real_escape_string($_REQUEST['description']);
$price = $mysqli->real_escape_string($_REQUEST['price']);

$sql = "INSERT INTO item (name, description, price, pid, sid, promoted) VALUES ('$name', '$description', '$price', '1', '$saleid', 'n')"; 
echo $sql;
if($mysqli->query($sql) === true){
	$url = 'showSale.php?id=' . $saleid;
	#header('Location:' . $url );
	echo "Rummage sale item created.";
} else {
	#header('Location: welcome.php#profile');
	echo "Something went wrong. " . $mysqli->error;
}
$mysqli->close();

?>
