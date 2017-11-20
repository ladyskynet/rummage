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
$type = $mysqli->real_escape_string($_REQUEST['item']);

$string1 = "";
$string2 = "";
$string3 = "";
$string4 = "";
$string5 = "";

if (isset($street)){
	$string1 = " AND (street='$street')";
}
if (isset($city)){
	$string2 = " AND (city='$city')";
}
if (isset($street)){
	$string3 = " AND (state='$state')";
}
if (isset($city)){
	$string4 = " AND (zip='$zip')";
}
if (isset($item)){
	$string5 = " AND (item in (select * from item where name='$item'))";
}

$sql = "select * from yardsale where 1=1" . $string1 . $string2 . $string3 . $string4 . $string5;
echo $sql;
$result = $mysqli->query($sql);

if ($result->num_rows > 0){
	while ($row = $result->fetch_array()){
		echo $row['id'] . $row['street'];
	}
	#header('Location: results.php');
	echo "Rummage sale created.";
} else {
	#header('Location: welcome.php#profile');
	echo "Something went wrong. " . $mysqli->error;
}
$mysqli->close();

?>
