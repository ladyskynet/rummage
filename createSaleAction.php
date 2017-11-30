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

# If promoted was not selected, set it to n for no
if ($promoted == ""){
	$promoted = 'n';
}
# Otherwise, it's c for cart

$sql = "INSERT INTO yardsale (street, city, state, zip, type, uid, eventdate, enddate, promoted, pid, approved) VALUES ('$street', '$city', '$state', '$zip', '$type', '$userid', '$eventdate', '$enddate', '$promoted', '$pid', 'n')"; 

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

			if ($promoted == 'p' && $approved == 'n'){

				$sql4 = "UPDATE yardsale set promoted='c' where id='$saleid'";
				if ($mysqli->query($sql4) === true){
					echo "Rummage sale created";
					header('Location: sales.php');
				} else {
					echo "Something went wrong." . $mysqli->error;
				}
			} else {
				echo "Rummage sale created.";
				header('Location: sales.php');
			}
			
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