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

if ($mysqli->real_escape_string($_REQUEST['promoted'])=='y'){
	if (isset($_SESSION['orderArray'])){
		$orderDetailArray = array();
		$orderDetailArray[0] = $saleid;
		$orderDetailArray[1] = $userid;
		$orderDetailArray[2] = $street;
		$orderDetailArray[3] = $city;
		$orderDetailArray[4] = $state;
		$orderDetailArray[5] = $zip;
		$orderDetailArray[6] = $eventdate;
		$orderDetailArray[7] = $type;
		$num = count($_SESSION['orderArray']);
		$_SESSION['orderArray'][$num] = $orderDetailArray;
	} else {
		$orderDetailArray = array();
		$orderDetailArray[0] = $saleid;
		$orderDetailArray[1] = $userid;
		$orderDetailArray[2] = $street;
		$orderDetailArray[3] = $city;
		$orderDetailArray[4] = $state;
		$orderDetailArray[5] = $zip;
		$orderDetailArray[6] = $eventdate;
		$orderDetailArray[7] = $type;
		$orderArray = array();
		$orderArray[0] = $orderDetailArray;
		$_SESSION['orderArray'] = $orderArray;
	}
}

$sql = "INSERT INTO yardsale (street, city, state, zip, type, uid, eventdate, promoted, pid) VALUES ('$street', '$city', '$state', '$zip', '$type', '$userid', '$eventdate', '$promoted', '$pid')"; 

if($mysqli->query($sql) === true){
	header('Location: sales.php');
	echo "Rummage sale created.";
} else {
	header('Location: welcome.php#profile');
	echo "Something went wrong. " . $mysqli->error;
}
$mysqli->close();

?>
