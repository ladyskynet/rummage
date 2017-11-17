<?php
session_start();
$mysqli = new mysqli("localhost", "root", "password", "yardsale");

if ($mysqli === false){
	die("ERROR: Could not connect. " . $mysqli->connect_error);
}

$username = $mysqli->real_escape_string($_REQUEST['username']);
$password = $mysqli->real_escape_string($_REQUEST['password']);

$sql = "SELECT * FROM user where username='$username' and password='$password'";

$result = $mysqli->query($sql);

if ($result->num_rows == 1){
	$row = $result->fetch_array();
	
	$userid = $row["id"];
	$email = $row["email"];
	$username2 = $row["username"];
	$firstname = $row["firstname"];
	$lastname = $row["lastname"];
	$email = $row["email"];
	$password2 = $row["password"];
	# echo $username2;
	
	$sql2 = "SELECT * FROM yardsale WHERE uid='$userid'";
	$result2 = $mysqli->query($sql2);
	$salearray = array();
	$index = 0;
	if ($result2->num_rows > 0){
		while($row2 = $result2->fetch_assoc()) {
			$salearray[$index][0] = $row2['id']; 
			$salearray[$index][1] = $row2['street']; 
			$salearray[$index][2] = $row2['city']; 
			$salearray[$index][3] = $row2['state']; 
			$salearray[$index][4] = $row2['zip']; 
			$salearray[$index][5] = $row2['eventdate']; 
			$salearray[$index][6] = $row2['uid']; 
			$salearray[$index][7] = $row2['type']; 
		}
		$_SESSION['index'] = $index;
	}	
	$_SESSION['id'] = $userid;
	$_SESSION['yardsales'] = $salearray;

	$_SESSION['username'] = $username2;
	$_SESSION['firstname'] = $firstname;
	$_SESSION['lastname'] = $lastname;
	$_SESSION['password'] = $password2;
	$_SESSION['email'] = $email;
	
	header('Location: http://128.163.141.189/create2.php#profile');
	echo "Welcome, $username.";
	echo"<br>";
	# echo $row["firstname"];
	# echo $_SESSION['firstname'];
}

else {
	header('Location: http://128.163.141.189');
	echo "That username or password is incorrect. Please try again.";
}
?>

