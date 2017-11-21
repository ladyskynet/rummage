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

$sql = "SELECT * FROM item where id='$itemid'";
$result = $mysqli->query($sql);

if ($result->num_rows == 1){
	$row = $result->fetch_array();

	$sql2 = "DELETE FROM item WHERE id='$itemid'"; 

	if ($mysqli->query($sql2) === TRUE){

		echo "Item deleted.";

		if (isset($_SESSION['orderArray'])){
			$ctr = 0;
			$newOrder = array();
			foreach ($_SESSION['orderArray'] as $value){
				if (($value[0] != $saleid) && ($value[5] != '1') && ($value[2] != $row['name'])){
					$newOrder[ctr] = $value;
				}
				$ctr += 1;
			}

			$_SESSION['orderArray'] = $newOrder;
		}
		header('Location: sales.php');
	
	} else {
		echo "Something went wrong." . $mysqli->error;
		header('Location: showItem.php?id=' . $itemid);
	}
} else {
	echo "Something went wrong." . $mysqli->error;
	header('Location: showItem.php?id=' . $itemid);
}

$mysqli->close();

?>