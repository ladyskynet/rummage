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
$name = ucwords($mysqli->real_escape_string($_REQUEST['name']));
$description = ucwords($mysqli->real_escape_string($_REQUEST['description']));
$price = $mysqli->real_escape_string($_REQUEST['price']);
$promoted = $mysqli->real_escape_string($_REQUEST['promoted']);
$userid = $_SESSION['id'];

if ($promoted == ""){
	$promoted = 'n';
}

$pid = 1;

$sql2 = "INSERT INTO item (name, description, price, pid, sid, promoted, approved, uid) VALUES ('$name', '$description', '$price', '$pid', '$saleid', '$promoted', 'n', '$userid')";

if($mysqli->query($sql2) === true){
	$sql3 = "SELECT * FROM item where sid='$saleid' and name='$name' and description='$description'";
	$result3 = $mysqli->query($sql3);

	if ($result3->num_rows == 1){

		$row3 = $result3->fetch_array();
		$approved = $row3['approved'];

		if (($promoted == 'p') && ($approved == 'n')){

			$sql4 = "UPDATE item set promoted='c' where id='$id'";
			
			if ($mysqli->query($sql4) === true){
				echo "Item created";
				$url = 'showSale.php?id=' . $saleid;
				header('Location:' . $url );
			} else {
				echo "Something went wrong." . $mysqli->error;
			}
		} else {
			echo "Item created";
			$url = 'showSale.php?id=' . $saleid;
			header('Location:' . $url );
		}

	} else {
		echo "Something went wrong. " . $mysqli->error;
	}

} else {
	echo "Something went wrong. " . $mysqli->error;
}
$mysqli->close();
?>