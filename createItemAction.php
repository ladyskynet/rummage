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

if ($promoted == 'y'){
	if (isset($_SESSION['orderArray'])){
		echo "yes";
		$orderDetailArray = array();
		$orderDetailArray[0] = $saleid;
		$orderDetailArray[1] = $_SESSION['id'];
		$orderDetailArray[2] = $name;
		$orderDetailArray[3] = $description;
		$orderDetailArray[4] = $price;
		$orderDetailArray[5] = $pid;
		$num = count($_SESSION['orderArray']);
		$_SESSION['orderArray'][$num] = $orderDetailArray;
	} else {
		echo "no";
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
echo $orderArray;
echo $orderDetailArray;
foreach ($_SESSION['orderArray'] as $value) {
	echo $value[0] . " " . $value[1];
}
$sql2 = "INSERT INTO item (name, description, price, pid, sid, promoted) VALUES ('$name', '$description', '$price', '1', '$saleid', 'n')"; 
if($mysqli->query($sql2) === true){
	$url = 'showSale.php?id=' . $saleid;
	#header('Location:' . $url );
	echo "Rummage sale item created.";
} else {
	echo "Something went wrong. " . $mysqli->error;
}
$mysqli->close();
?>
