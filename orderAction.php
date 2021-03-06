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

# Get payment info submitted by user
$cardnumber = $mysqli->real_escape_string($_REQUEST['cardnumber']);
$seccode = $mysqli->real_escape_string($_REQUEST['seccode']);
$exp = $mysqli->real_escape_string($_REQUEST['exp']);
$userid = $_SESSION["id"];
$today = date("Y-m-d H:i:s");  

# Insert payment info to create order
$sql = "INSERT into payment (uid, cardnumber, datepurc, expcarddate, seccode) values ('$userid', '$cardnumber', '$today', '$exp', '$seccode')";

if ($mysqli->query($sql) === true){

	# Get newly generated ID from order
	$sql2 = "SELECT MAX(id) as newest from payment where cardnumber='$cardnumber'";
	$result2 = $mysqli->query($sql2);

	if ($result2->num_rows == 1){

		$row2 = $result2->fetch_array();
		$orid = $row2['newest'];

		$sql3 = "SELECT * from yardsale where promoted='c' and uid='$userid'";
		$sql4 = "SELECT * from item where promoted='c' and uid='$userid'";

		$result3 = $mysqli->query($sql3);
		$result4 = $mysqli->query($sql4);

		if ($result3->num_rows > 0){
			# For each of the values in order array, make an orderitem
			while ($row3 = $result3->fetch_array()) {
				$saleid = $row3['id'];
				$pid = $row3['pid'];
				$sql10 = "SELECT amount from price where id='$pid'";
				$result10 = $mysqli->query($sql10);
				$amount = 0;
				if ($result10->num_rows > 0){
					$row10 = $result10->fetch_array();
					$amount = $row10['amount'];
				}

				$sql5 = "INSERT into orderitem (orid, pid, sid, cost) values ('$orid', '$pid', '$saleid', '$amount')";
				if ($mysqli->query($sql5) === true){
					$sql6 = "UPDATE yardsale set promoted='a' where id='$saleid'";
					if ($mysqli->query($sql6) === true){
						echo "It went okay.";
					} else {
						echo "Something went wrong." . $mysqli->error;
					}

				} else {
					echo "Something went wrong." . $mysqli->error;
				}
			}
		}
		if ($result4->num_rows > 0){
			# For each of the values in order array, make an orderitem
			while ($row4 = $result4->fetch_array()) {
				$itemid = $row4['id'];
				$saleid = $row4['sid'];
				$pid = $row4['pid'];
				$sql9 = "SELECT amount from price where id='$pid'";
				$result9 = $mysqli->query($sql9);
				$amount = 0;
				if ($result9->num_rows > 0){
					$row9 = $result9->fetch_array();
					$amount = $row9['amount'];
				}
				$sql7 =  "INSERT into orderitem (orid, pid, sid, itemid, cost) values ('$orid', '$pid', '$saleid', '$itemid', '$amount')";
				echo $sql7 . " <br>";
				if ($mysqli->query($sql7) === true){
					$sql8 = "UPDATE item set promoted='a' where id='$itemid'";
					echo $sql8;
					$result8 = $mysqli->query($sql8);
					if ($mysqli->query($sql8) === true){
						echo "It went okay.";
					} else {
						echo "Something went wrong." . $mysqli->error;
					}

				} else {
					echo "Something went wrong." . $mysqli->error;
				}
			}
		}
		$url = 'showOrder.php?id=' . $orid;
		echo "Order placed.";
		header('Location:' . $url );
	} else {
		echo "3) Something went wrong. " . $mysqli->error;
	}
} else {
	echo "4) Something went wrong. " . $mysqli->error;
}

$mysqli->close();
?>