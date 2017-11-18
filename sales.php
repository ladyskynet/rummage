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
				<h3 class="major">My Rummage Sales</h2>
					<?php
					$mysqli = new mysqli("localhost", "root", "password", "yardsale");

					if ($mysqli === false){
						die("ERROR: Could not connect. " . $mysqli->connect_error);
					}

					$userid = $_SESSION['id'];
					$sql2 = "SELECT * FROM yardsale WHERE uid='$userid'";
					$result2 = $mysqli->query($sql2);
					$salearray = array();
					$index = 0;

					if ($result2->num_rows > 0){

						echo '<div class="table-wrapper">
								<table class="alt">
									<thead>
										<tr>
											<th>ID</th>
											<th>Street</th>
											<th>City</th>
											<th>State</th>
											<th>Zip</th>
											<th>Type</th>
											<th>Event Date</th>
										</tr>
									</thead>
									<tbody>';
						while($row2 = $result2->fetch_array()) {

							if ($row2['type'] == 's'){
								$type = "Single Family Rummage Sale";
							} else {
								$type = "Community Rummage Sale";
							}
				 			echo '<tr><td><a href="showSale.php?id=' . $row['id'] . ' ">Show</a></td>';
							echo '<td>' . $row2['street'] . "</td>";
							echo '<td>' . $row2['city'] . "</td>";
							echo '<td>' . $row2['state'] . "</td>";
							echo '<td>' . $row2['zip'] . "</td>";
							echo '<td>' . $type . "</td>" ;
			 				echo '<td>' . $row2['eventdate'] . "</td></tr>";
						}
						echo '		</tbody>
								</table>
							</div>';
					} else {
						echo "<p>You don't currenntly have any rummage sales to display.</p>";
					}	
				 	
					?>
				<nav>
					<ul>
						<li><a href="welcome.php#profile">Profile</a></li>
						<li><a href="welcome.php#create">Create</a></li>
						<li><a href="welcome.php#explore">Explore</a></li>
						<!--<li><a href="#elements">Elements</a></li>-->
						<li><a href="sales.php">Sales</a></li>
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