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
	$sql2 = "select id from payment where cardnumber='$cardnumber'";
	$result2 = $mysqli->query($sql2);
	$row2 = $result2->fetch_array();
	$orid = $row2['id'];

	foreach ($_SESSION['orderArray'] as $value) {
		$pid = $value[5];
		$saleid = $value[0];

		$sql3 = "INSERT into orderitem (orid, pid) values ('$orid', '$pid')";

		if ($pid == 1){
			$name = $value[2];
			$sql4 = "select id from item where sid='$saleid' and name='$name'";
			$result4 = $mysqli->query($sql4);
			$row4 = $result4->fetch_array();
			$itemid = $row4['id'];
			$sql4 = "INSERT into temp (orid, pid, sid, itemid) values ('$orid', '$pid', '$saleid', '$itemid')";
		} else {
			$sql4 = "INSERT into temp (orid, pid, sid) values ('$orid', '$pid', '$saleid')";
		}
		
		if ($mysqli->query($sql3)===true){
			$url = 'showOrder.php?id=' . $orid;
			header('Location:' . $url );
			echo "Order placed.";
		} else {
			echo "Something went wrong. " . $mysqli->error;
		}
	}
}

$mysqli->close();
?>