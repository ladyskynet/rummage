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
$promoted = $mysqli->real_escape_string($_REQUEST['promoted']);

if ($promoted == ""){
	$promoted = 'n';
}
$pid = 1;

$sql2 = "INSERT INTO item (name, description, price, pid, sid, promoted, approved) VALUES ('$name', '$description', '$price', '$pid', '$saleid', 'n', 'n')";

if($mysqli->query($sql2) === true){
	$sql3 = "SELECT * FROM item where sid='$saleid' and name='$name' and description='$description'";
	$result3 = $mysqli->query($sql3);

	if ($result3->num_rows == 1){
		echo "somewhere";
		$row3 = $result3->fetch_array();
		$approved = $row3['approved'];

		if (($promoted == 'y') && ($approved == 'n')){
			if (isset($_SESSION['orderArray'])){
				$orderDetailArray = array();
				$orderDetailArray[0] = $saleid;
				$orderDetailArray[1] = $_SESSION['id'];
				$orderDetailArray[2] = $name . "Listing";
				$orderDetailArray[3] = $description;
				$orderDetailArray[4] = $price;
				$orderDetailArray[5] = $pid;
				$num = count($_SESSION['orderArray']);
				$_SESSION['orderArray'][$num] = $orderDetailArray;
			} else {
				$orderDetailArray = array();
				$orderDetailArray[0] = $saleid;
				$orderDetailArray[1] = $_SESSION['id'];
				$orderDetailArray[2] = $name . "Listing";
				$orderDetailArray[3] = $description;
				$orderDetailArray[4] = $price;
				$orderDetailArray[5] = $pid;
				$orderArray = array();
				$orderArray[0] = $orderDetailArray;
				$_SESSION['orderArray'] = $orderArray;
			}
		}

		$url = 'showSale.php?id=' . $saleid;
		header('Location:' . $url );
		echo "Rummage sale item created.";

	} else {
		echo "Something went wrong. " . $mysqli->error;
	}

} else {
	echo "Something went wrong. " . $mysqli->error;
}
$mysqli->close();
?>