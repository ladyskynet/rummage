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

$street = $mysqli->real_escape_string($_REQUEST['street']);
$city = $mysqli->real_escape_string($_REQUEST['city']);
$state = $mysqli->real_escape_string($_REQUEST['state']);
$zip = $mysqli->real_escape_string($_REQUEST['zip']);
$type = $mysqli->real_escape_string($_REQUEST['type']);
$eventdate = $mysqli->real_escape_string($_REQUEST['eventdate']);
$userid = $_SESSION['id'];
$pid = 2;

$sql = "INSERT INTO yardsale (street, city, state, zip, type, uid, eventdate, promoted, pid) VALUES ('$street', '$city', '$state', '$zip', '$type', '$userid', '$eventdate', 'n', '$pid')"; 

if ($mysqli->query($sql) === true) {
	if ($mysqli->real_escape_string($_REQUEST['promoted'])=='y'){

		$sql2 = "select MAX(id) as newest from yardsale";
		$result2 = $mysqli->query($sql2);
		$row2 = $result2->fetch_array();

		if (isset($_SESSION['orderArray'])){
			$orderDetailArray = array();
			$orderDetailArray[0] = $row2['newest'];
			$orderDetailArray[1] = $userid;
			$orderDetailArray[2] = $type;
			$orderDetailArray[3] = $street . "," . $city . "," . $state . "," . $zip;
			$orderDetailArray[4] = $eventdate;
			$orderDetailArray[5] = $pid;
			$num = count($_SESSION['orderArray']);
			$_SESSION['orderArray'][$num] = $orderDetailArray;
		} else {
			$orderDetailArray = array();
			$orderDetailArray[0] = $row2['newest'];
			$orderDetailArray[1] = $userid;
			$orderDetailArray[2] = $type;
			$orderDetailArray[3] = $street . "," . $city . "," . $state . "," . $zip;
			$orderDetailArray[4] = $eventdate;
			$orderDetailArray[5] = $pid;
			$orderArray = array();
			$orderArray[0] = $orderDetailArray;
			$_SESSION['orderArray'] = $orderArray;
		}
	} 
	header('Location: sales.php');
} else {
	header('Location: welcome.php#profile');
	echo "Something went wrong. " . $mysqli->error;
}
$mysqli->close();
?>