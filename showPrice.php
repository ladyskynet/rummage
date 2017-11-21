<?php
session_start();
if (isset($_SESSION['id']) && $_SESSION['type'] == 'i'){
	echo "";
} else {
	header('Location: index.html');
}
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
				<h2>Sale Details</h2>
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

					$priceid = $mysqli->real_escape_string($_REQUEST['id']);
					
					$sql = "SELECT * FROM price WHERE id='$priceid'";
					
					$result = $mysqli->query($sql);
					if ($result->num_rows == 1){

						$row = $result->fetch_array();
 
						echo '<h3>Price Details</h3>
						<div class="table-wrapper">
							<table class="alt">
								<thead>
									<tr>
										<th>Street</th>
										<th>City</th>
										<th>State</th>
										<th>Zip</th>
										<th>Type</th>
										<th>Event Date/Time</th>
									</tr>
								</thead>
								<tbody>';
						
						echo '<tr><td>' . $row["id"] . '</td>';
								
						echo '<td>' . $row["type"] . '</td>';
								
						echo '	<td>' . number_format(round($row["amount"],2),2) . '</td></tr>
							</tbody>
					    </table>
					</div>';
						
					} else {
						echo "<p>Please select a valid sale to display.</p>";
					}
					$mysqli->close();
					?>
				
				</div>
				<nav>
					<ul>
						<li><a href="welcome.php#profile">Profile</a></li>
						<li><a href="createSale.php">Create</a></li>
						<li><a href="search.php">Search</a></li>
						<li><a href="cart.php">My Cart</a></li>
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