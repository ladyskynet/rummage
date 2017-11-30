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
$street = ucwords($mysqli->real_escape_string($_REQUEST['street']));
$city = ucwords($mysqli->real_escape_string($_REQUEST['city']));
$state = strtoupper($mysqli->real_escape_string($_REQUEST['state']));
$zip = $mysqli->real_escape_string($_REQUEST['zip']);
$type = $mysqli->real_escape_string($_REQUEST['type2']);
$eventdate = $mysqli->real_escape_string($_REQUEST['eventdate']);
$enddate = $mysqli->real_escape_string($_REQUEST['enddate']);
$userid = $_SESSION['id'];
$promoted = $mysqli->real_escape_string($_REQUEST['promoted']);

if ($promoted == ""){
	$promoted = 'n';
}

$pid = 2;

$sql = "UPDATE yardsale set street='$street', city='$city', state='$state', zip='$zip', type='$type', eventdate='$eventdate', enddate='$enddate', promoted='c' WHERE id='$saleid'";

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

	if ($promoted == 'p' && $approved == 'n'){
		if ($type == 'c'){
			$type = "Community Rummage Sale Listing";
		} else {
			$type = "Single Family Rummage Sale Listing";
		}

		if (isset($_SESSION['orderArray'])){
			$orderDetailArray = array();
			$orderDetailArray[0] = $saleid; #sid
			$orderDetailArray[1] = $type; #name
			$orderDetailArray[2] = $street . ", " . $city . ", " . $state . ", " . $zip; #description
			$orderDetailArray[3] = 10.5; #cost of listing
			$orderDetailArray[4] = "N/A"; #itemid
			$num = count($_SESSION['orderArray']); 
			$_SESSION['orderArray'][$num] = $orderDetailArray;
		} else {
			$orderDetailArray = array();
			$orderDetailArray[0] = $saleid; #sid
			$orderDetailArray[1] = $type; #name
			$orderDetailArray[2] = $description; #description
			$orderDetailArray[3] = 10.5; #cost of listing
			$orderDetailArray[4] = "N/A"; #itemid
			$orderArray = array();
			$orderArray[0] = $orderDetailArray;
			$_SESSION['orderArray'] = $orderArray;
		}

		$sql3 = "UPDATE yardsale set promoted='c' where id='$saleid'";

		if ($mysqli->query($sql4) === true){
			echo "Rummage sale created";
			header('Location: showSale.php?id=' . $saleid);
		} else {
			echo "Something went wrong." . $mysqli->error;
		}
	} else {
		echo "Rummage sale created";
		header('Location: showSale.php?id=' . $saleid);
	}
	
} else {
	echo "Something went wrong." . $mysqli->error;
}

$mysqli->close();

?>