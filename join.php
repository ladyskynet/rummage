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

$firstname = $mysqli->real_escape_string($_REQUEST['firstname']);
$lastname = $mysqli->real_escape_string($_REQUEST['lastname']);
$username = $mysqli->real_escape_string($_REQUEST['username']);
$password = $mysqli->real_escape_string($_REQUEST['password']);
$email = $mysqli->real_escape_string($_REQUEST['email']);

$sql = "SELECT * FROM user WHERE username='$username'";
$result = $mysqli->query($sql);

if ($result->num_rows == 0){
	$sql2 = "INSERT INTO user (firstname, lastname, username, password, email, type) VALUES ('$firstname', '$lastname', '$username', '$password', '$email', 'x')"; 
	if($mysqli->query($sql2) === true){
		header('Location: http://128.163.141.189/create.html');
		echo "Welcome to Rummage, $username.";
		$_SESSION['firstname'] = $firstname;
		$_SESSION['username'] = $username;
		$_SESSION['password'] = $password;
		$_SESSION['email'] = $email;
		$_SESSION['lastname'] = $lastname;
	} 
	else {
		echo "Something went wrong. " . $mysqli->error;
	}
} 
else {
	echo "A user with the username $username already exists. Please choose another.";
}

$mysqli->close();

?>
