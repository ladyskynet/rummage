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

# Insert payment info to create order
$sql = "INSERT into payment (uid, cardnumber, datepurc, expcarddate, seccode) values ('$userid', '$cardnumber', '2017-11-20', '$exp', '$seccode')";

if ($mysqli->query($sql) === true){

	# Get newly generated ID from order
	$sql2 = "SELECT MAX(id) as newest from payment where cardnumber='$cardnumber'";
	$result2 = $mysqli->query($sql2);

	if ($result2->num_rows == 1){

		$row2 = $result2->fetch_array();
		$orid = $row2['newest'];

		# For each of the values in order array, make an orderitem
		foreach ($_SESSION['orderArray'] as $value) {

			$pid = $value[5];
			$saleid = $value[0];
			if ($pid == '2'){
				$sql3 = "INSERT into orderitem (orid, pid, sid) values ('$orid', '$pid', '$saleid')";
			} else {
				$itemid = $value[6];
				$sql3 = "INSERT into orderitem (orid, pid, sid, objid) values ('$orid', '$pid', '$saleid', '$itemid')";
			}
			

			if ($mysqli->query($sql3) === true){
				# If orderitem is for an ITEM 
				if ($pid == 1){
					$name = $value[2];
					$description = $value[3];
					$sql4 = "SELECT id from item where sid='$saleid' and name='$name' and description='$description'";
					$result4 = $mysqli->query($sql4);
					if ($result4->num_rows == 1){
						$row4 = $result4->fetch_array();
						$itemid = $row4['id'];
						$sql5 = "INSERT into temp (orid, sid, itemid) values ('$orid', '$saleid', '$itemid')";
					}
				# If orderitem is for a SALE
				} else {
					$sql5 = "INSERT into temp (orid, sid) values ('$orid', '$saleid')";
				}
				if ($mysqli->query($sql5) === true){
					$url = 'showOrder.php?id=' . $orid;
					echo "Order placed.";
					# Reset orderArray so cart will be empty
					$_SESSION['orderArray'] = array();
					header('Location:' . $url );

				} else {
					echo "1) Something went wrong." . $mysqli->error;
				}
			} else {
				echo "2) Something went wrong. " . $mysqli->error;
			}
		}
	} else {
		echo "3) Something went wrong. " . $mysqli->error;
	}
} else {
	echo "4) Something went wrong. " . $mysqli->error;
}

$mysqli->close();
?>