<?php
session_start();

$mysqli = new mysqli("localhost", "root", "password", "yardsale");

if ($mysqli === false){
	die("ERROR: Could not connect. " . $mysqli->connect_error);
}

$username = $mysqli->real_escape_string($_REQUEST['username']);
$password = $mysqli->real_escape_string($_REQUEST['password']);

$sql = "SELECT * FROM user where username='$username' and password='$password'";

$result = $mysqli->query($sql);

if ($result->num_rows == 1){
	$row = $result->fetch_array();

	$_SESSION['id'] = $row["id"];
	$_SESSION['username'] = $row["username"];
	$_SESSION['firstname'] = $row["firstname"];
	$_SESSION['lastname'] = $row["lastname"];
	$_SESSION['email'] = $row["email"];
	
	header('Location: welcome.php#profile');
	echo "Welcome, $username.";
	echo"<br>";
}

else {
	header('Location: index.html');
	echo "That username or password is incorrect. Please try again.";
}

$mysqli->close();
?>