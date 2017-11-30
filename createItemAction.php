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
echo $sql2 . "<br>";

if($mysqli->query($sql2) === TRUE){
	$sql3 = "SELECT * FROM item where sid='$saleid' and name='$name' and description='$description' and price='$price'";
	$result3 = $mysqli->query($sql3);
	echo $sql3;

	if ($result3->num_rows > 0){

		$row3 = $result3->fetch_array();
		$itemid = $row3['id'];

		if ($promoted == 'p'){

			$sql4 = "UPDATE item set promoted='c' where id='$itemid'";
			
			if ($mysqli->query($sql4) === true){
				echo "Item created";
				$url = 'showSale.php?id=' . $saleid;
				header('Location:' . $url );
			} else {
				echo "Something went wrong4. " . $mysqli->error;
			}
		} else {
			echo "Item created";
			$url = 'showSale.php?id=' . $saleid;
			header('Location:' . $url );
		}

	} else {
		echo "Something went wrong5. " . $mysqli->error;
	}

} else {
	echo "Something went wrong6. " . $mysqli->error;
}
$mysqli->close();
?>