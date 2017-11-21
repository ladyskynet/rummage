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

$saleid = $mysqli->real_escape_string($_REQUEST['saleid']);
$street = $mysqli->real_escape_string($_REQUEST['street']);
$city = $mysqli->real_escape_string($_REQUEST['city']);
$state = $mysqli->real_escape_string($_REQUEST['state']);
$zip = $mysqli->real_escape_string($_REQUEST['zip']);
$type = $mysqli->real_escape_string($_REQUEST['type']);
$eventdate = $mysqli->real_escape_string($_REQUEST['eventdate']);
$userid = $_SESSION['id'];

if ($promoted == ""){
	$promoted = 'n';
}

$pid = 2;

$sql = "UPDATE yardsale set street='$street', city='$city', state='$state', zip='$zip', type='$type', eventdate='$eventdate' WHERE id='$saleid'";

if ($mysqli->query($sql) === TRUE){
	echo "Yard sale updated.";

	$sql2 = "SELECT * from yardsale where id='$saleid'";	
	$result2 = $mysqli->query($sql2);

	if ($result2->num_rows == 1){
		$row2 = $result2->fetch_array();
		$approved = $row2['approved'];

	} else {
		echo "Something went wrong.";
		header('Location: welcome.php#profile');
	}
	if ($promoted == 'y' && $approved == 'n'){
		if (isset($_SESSION['orderArray'])){
			$orderDetailArray = array();
			$orderDetailArray[0] = $saleid;
			$orderDetailArray[1] = $userid;
			$orderDetailArray[2] = $name;
			$orderDetailArray[3] = $description;
			$orderDetailArray[4] = $price;
			$orderDetailArray[5] = $pid;
			$num = count($_SESSION['orderArray']);
			$_SESSION['orderArray'][$num] = $orderDetailArray;
		} else {
			$orderDetailArray = array();
			$orderDetailArray[0] = $saleid;
			$orderDetailArray[1] = $_SESSION['id'];
			$orderDetailArray[2] = $name;
			$orderDetailArray[3] = $description;
			$orderDetailArray[4] = $price;
			$orderDetailArray[5] = $pid;
			$orderArray = array();
			$orderArray[0] = $orderDetailArray;
			$_SESSION['orderArray'] = $orderArray;
		}
	} 
	header('Location: showSale.php?id=' . $saleid);
} 
else {
	echo "Something went wrong." . $mysqli->error;
	#header('Location: welcome.php#sales');
}

$mysqli->close();

?>
