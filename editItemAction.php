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
$name = $mysqli->real_escape_string($_REQUEST['name']);
$description = $mysqli->real_escape_string($_REQUEST['description']);
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

	if ($result2->num_rows == 1){
		$row2 = $result2->fetch_array();
		$saleid = $row2['sid'];

		if ($promoted == 'y'){
			if (isset($_SESSION['orderArray'])){
				$orderDetailArray = array();
				$orderDetailArray[0] = $saleid;
				$orderDetailArray[1] = $userid;
				$orderDetailArray[2] = $name . " Listing";
				$orderDetailArray[3] = $description;
				$orderDetailArray[4] = $price;
				$orderDetailArray[5] = $pid;
				$orderDetailArray[6] = $id;
				$num = count($_SESSION['orderArray']);
				$_SESSION['orderArray'][$num] = $orderDetailArray;
			} else {
				$orderDetailArray = array();
				$orderDetailArray[0] = $saleid;
				$orderDetailArray[1] = $_SESSION['id'];
				$orderDetailArray[2] = $name . " Listing";
				$orderDetailArray[3] = $description;
				$orderDetailArray[4] = $price;
				$orderDetailArray[5] = $pid;
				$orderDetailArray[6] = $id;
				$orderArray = array();
				$orderArray[0] = $orderDetailArray;
				$_SESSION['orderArray'] = $orderArray;
			}
		}

		echo "Item updated.";
		header('Location: showItem.php?id=' . $id);

	} else {
		echo "Something went wrong." . $mysqli->error;
		#header('Location: welcome.php#profile');
	}

} else {
	echo "Something went wrong." . $mysqli->error;
	#header('Location: welcome.php#profile');
}

$mysqli->close();

?>
