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

if ($promoted == 'y'){
	if (isset($_SESSION['orderArray'])){
		echo 'yes';
		/**$orderDetailArray = array();
		$orderDetailArray.array_push($saleid);
		$orderDetailArray.array_push($_SESSION['id']);
		$orderDetailArray.array_push($name);
		$orderDetailArray.array_push($description);
		$orderDetailArray.array_push($price);
		$orderDetailArray.array_push(1);
		$_SESSION['orderArray'].array_push($orderDetailArray);**/
	} else {
		echo 'no';
		$orderDetailArray = array();
		$orderDetailArray.array_push($saleid);
		$orderDetailArray.array_push($_SESSION['id']);
		$orderDetailArray.array_push($name);
		/**$orderDetailArray.array_push($description);
		$orderDetailArray.array_push($price);
		$orderDetailArray.array_push(1);
		$orderArray = array();
		$orderArray.array_push($orderDetailArray);
		$_SESSION['orderArray'] = $orderArray;**/
	}
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
