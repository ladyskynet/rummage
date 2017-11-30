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
$name = ucwords($mysqli->real_escape_string($_REQUEST['name']));
$description = ucwords($mysqli->real_escape_string($_REQUEST['description']));
$price = $mysqli->real_escape_string($_REQUEST['price']);
$promoted = $mysqli->real_escape_string($_REQUEST['promoted']);
$userid = $_SESSION['id'];

if ($promoted == ""){
	$promoted = 'n';
}

$pid = 1;

$sql = "UPDATE item set name='$name', description='$description', price='$price' WHERE id='$id'"; 

if ($mysqli->query($sql) === TRUE){

	$sql2 = "SELECT sid from item where id='$id'";
	$result2 = $mysqli->query($sql2);

	if ($result2->num_rows > 1){
		$row2 = $result2->fetch_array();
		$saleid = $row2['sid'];

		if (($promoted == 'p') && ($approved == 'n')){

			$sql3 = "UPDATE item set promoted='c' where id='$id'";
			
			if ($mysqli->query($sql3) === true){
				echo "Item updated. 4";
				#header('Location: showItem.php?id=' . $id);
			} else {
				echo "Something went wrong." . $mysqli->error;
			}
		} else {
			echo "Item updated. 7";
			#header('Location: showItem.php?id=' . $id);
		}

	} else {
		echo "Something went wrong." . $mysqli->error;
	}

} else {
	echo "Something went wrong." . $mysqli->error;
}

$mysqli->close();

?>