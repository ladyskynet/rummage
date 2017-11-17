<?php
session_start();

?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>Rummage</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="assets/css/main.css" />
		<!--[if lte IE 9]><link rel="stylesheet" href="assets/css/ie9.css" /><![endif]-->
		<noscript><link rel="stylesheet" href="assets/css/noscript.css" /></noscript>
  		<link rel="shortcut icon" type="image/x-icon" href="favicon.ico" />
	</head>
	<body>
		<!-- Wrapper -->
		<div id="wrapper">
			<!-- Header -->
			<header id="header">
				<div class="logo">
					<span class="icon fa-trash"></span>
				</div>
				<h2>Show</h2>
				<div class="content">
					<br>
					<?php
					$servername = "localhost";
					$username = "root";
					$password = "password";
					$dbname = "yardsale";

					$mysqli = new mysqli($servername, $username, $password, $dbname);

					if ($mysqli === false){
						die("Connection failed: " . $mysqli->connect_error());
					} 
					$saleid = $mysqli->real_escape_string($_REQUEST['id']);
					

					$sql2 = "SELECT * FROM yardsale WHERE id='$saleid'";
					
					$result2 = $mysqli->query($sql2);
					echo $saleid;
					if ($result2->num_rows == 1){
						echo "okay";

						$row2 = $result->fetch_assoc();

						/**echo '<ul><li>Street: ' . $row2["street"] . '</li>';
								
						echo '<li>City: ' . $row2["city"] . '</li>';
								
						echo '<li>State: ' . $row2["state"] . '</li>';
								
						echo '<li>Zip: ' . $row2["zip"] . '</li>' 

						if ($row2["type"] == 'c')
						{
							echo '<li>Type: Community Rummage Sale</li>';
						} else {
							echo '<li>Type: Single Family Rummage Sale</li>';
						}
						echo '<li>Date/Time: ' . $row2["eventdate"] . '</li><br/>';
						
						echo '<li><a href="create2.php#sales">Sales</a></li>';

						echo '<li><a href="editSale.php?id=' . $saleid . ' ">Edit</a></li></ul>';**/
					}

					$mysqli->close();
					?>
				
				</div>
				<nav>
					<ul>
						<li><a href="#profile">Profile</a></li>
						<li><a href="#create">Create</a></li>
						<li><a href="#explore">Explore</a></li>
						<!--<li><a href="#elements">Elements</a></li>-->
						<li><a href="#sales">Sales</a></li>
						<li><a href="logout.php">Logout</a></li>
					</ul>
				</nav>
			</header>

			<!-- Footer -->
			<footer id="footer">
				<p class="copyright">&copy; Rummage.</p>
			</footer>
		</div>

		<!-- BG -->
		<div id="bg"></div>

		<!-- Scripts -->
		<script src="assets/js/jquery.min.js"></script>
		<script src="assets/js/skel.min.js"></script>
		<script src="assets/js/util.js"></script>
		<script src="assets/js/main.js"></script>

	</body>
</html>