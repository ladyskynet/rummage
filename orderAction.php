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

$cardnumber = $mysqli->real_escape_string($_REQUEST['cardnumber']);
$seccode = $mysqli->real_escape_string($_REQUEST['seccode']);
$exp = $mysqli->real_escape_string($_REQUEST['exp']);
$userid = $_SESSION["id"];

$sql = "Insert into payment (uid, cardnumber, datepurc, expcarddate, seccode) values ('$userid', '$cardnumber', '2017-11-20', '$exp', '$seccode')";

if ($mysqli->query($sql) === true){
	echo 'yay';	
	$sql2 = "select id from payment where cardnumber='$cardnumber'";
	$result2 = $mysqli->query($sql2);
	$row2 = $result2->fetch_array();
	$orid = $row2['id'];
	echo $orid;
	foreach ($_SESSION['orderArray'] as $value) {
		echo "we get in...";
		$pid = $value[5];
		$sql3 = "INSERT into orderitem (orid, pid) values ('$orid', '$pid')";
		if ($mysqli->query($sql3)===true){
			$url = 'showOrder.php?id=' . $saleid;
			#header('Location:' . $url );
			echo "Order placed.";
		} else {
			echo "Something went wrong. " . $mysqli->error;
		}
	}
}

$mysqli->close();
?>