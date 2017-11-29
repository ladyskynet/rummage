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

$street = ucwords($mysqli->real_escape_string($_REQUEST['street']));
$city = ucwords($mysqli->real_escape_string($_REQUEST['city']));
$state = strtoupper($mysqli->real_escape_string($_REQUEST['state']));
$zip = $mysqli->real_escape_string($_REQUEST['zip']);
$type = $mysqli->real_escape_string($_REQUEST['type']);
$eventdate = $mysqli->real_escape_string($_REQUEST['eventdate']);
$enddate = $mysqli->real_escape_string($_REQUEST['enddate']);
$userid = $_SESSION['id'];
$promoted = $mysqli->real_escape_string($_REQUEST['promoted']);
$pid = 2;

if ($promoted == ""){
	$promoted = 'n';
}

$sql = "INSERT INTO yardsale (street, city, state, zip, type, uid, eventdate, enddate, promoted, pid, approved) VALUES ('$street', '$city', '$state', '$zip', '$type', '$userid', '$eventdate', '$enddate', 'y', '$pid', 'n')"; 

if ($mysqli->query($sql) === true) {
	
	$sql2 = "SELECT MAX(id) as newest from yardsale";
	$result2 = $mysqli->query($sql2);
	if ($result2->num_rows == 1){
		
		
		$row2 = $result2->fetch_array();
		$newsaleid = $row2['newest'];

		$sql3 = "SELECT * from yardsale where id='$newsaleid'";
		$result3 = $mysqli->query($sql3);

		if ($result3->num_rows == 1){

			$row3 = $result3->fetch_array();
			$approved = $row3['approved'];
			echo $approved . " " . $promoted;
			if (($promoted == 'y') and ($approved == 'n')){
				if ($type == 'c'){
					$type = "Community Rummage Sale Listing";
				} else {
					$type = "Single Family Rummage Sale Listing";
				}

				if (isset($_SESSION['orderArray'])){
				
					$orderDetailArray = array();
					$orderDetailArray[0] = $newsaleid;
					$orderDetailArray[1] = $userid;
					$orderDetailArray[2] = $type;
					$orderDetailArray[3] = $street . ", " . $city . ", " . $state . ", " . $zip;
					$orderDetailArray[4] = $eventdate;
					$orderDetailArray[5] = $pid;
					$orderDetailArray[6] = NULL;
					$orderDetailArray[7] = $enddate;
					$num = count($_SESSION['orderArray']);
					$_SESSION['orderArray'][$num] = $orderDetailArray;
				} else {
					$orderDetailArray = array();
					$orderDetailArray[0] = $newsaleid;
					$orderDetailArray[1] = $userid;
					$orderDetailArray[2] = $type;
					$orderDetailArray[3] = $street . ", " . $city . ", " . $state . ", " . $zip;
					$orderDetailArray[4] = $eventdate;
					$orderDetailArray[5] = $pid;
					$orderDetailArray[6] = NULL;
					$orderDetailArray[7] = $enddate;
					$orderArray = array();
					$orderArray[0] = $orderDetailArray;
					$_SESSION['orderArray'] = $orderArray;
				}
			}
			echo "Rummage sale created.";
			header('Location: sales.php');
		} else {
			echo "Something went wrong." . $mysqli->error;
		}
	} else {
		echo "Something went wrong." . $mysqli->error;
	}
} else {
	echo "Something went wrong." . $mysqli->error;
}

$mysqli->close();
?>