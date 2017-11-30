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

		if (($promoted == 'p') && ($approved == 'n')){
			if (isset($_SESSION['orderArray'])){
				$orderDetailArray = array();
				$orderDetailArray[0] = $saleid; #sid
				$orderDetailArray[1] = $name . " Listing"; #name
				$orderDetailArray[2] = $description; #description
				$orderDetailArray[3] = 5.5; #cost of listing
				$orderDetailArray[4] = $id; #itemid
				$num = count($_SESSION['orderArray']); 
				$_SESSION['orderArray'][$num] = $orderDetailArray;
			} else {
				$orderDetailArray = array();
				$orderDetailArray[0] = $saleid; #sid
				$orderDetailArray[1] = $name . " Listing"; #name
				$orderDetailArray[2] = $description; #description
				$orderDetailArray[3] = 5.5; #cost of listing
				$orderDetailArray[4] = $id; #itemid
				$orderArray = array();
				$orderArray[0] = $orderDetailArray;
				$_SESSION['orderArray'] = $orderArray;
			}

			$sql3 = "UPDATE item set promoted='c' where id='$id'";
			
			if ($mysqli->query($sql4) === true){
				echo "Item updated.";
				header('Location: showItem.php?id=' . $id);
			} else {
				echo "Something went wrong." . $mysqli->error;
			}
		} else {
			echo "Item updated";
			header('Location: showItem.php?id=' . $id);
		}

	} else {
		echo "Something went wrong." . $mysqli->error;
	}

} else {
	echo "Something went wrong." . $mysqli->error;
}

$mysqli->close();

?>