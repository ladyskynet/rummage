<?php
session_start();
if (isset($_SESSION['id'])){
	echo "";
} else {
	header('Location: resultsAnon.php');
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
				<h2>Results</h2>
				<div class="content">
					<br>
						<?php
						$mysqli = new mysqli("localhost", "root", "password", "yardsale");

						if ($mysqli === false){
							die("ERROR: Could not connect. " . $mysqli->connect_error);
						}

						$street = $mysqli->real_escape_string($_REQUEST['street']);
						$city = $mysqli->real_escape_string($_REQUEST['city']);
						$state = $mysqli->real_escape_string($_REQUEST['state']);
						$zip = $mysqli->real_escape_string($_REQUEST['zip']);
						$item = $mysqli->real_escape_string($_REQUEST['item']);

						$string1 = "";
						$string2 = "";
						$string3 = "";
						$string4 = "";
						$string5 = "";

						if ($street != ''){
							$string1 = " AND (street='$street')";
						}
						if ($city != ''){
							$string2 = " AND (city='$city')";
						}
						if ($state != ''){
							$string3 = " AND (state='$state')";
						}
						if ($zip != ''){
							$string4 = " AND (zip='$zip')";
						}
						if ($item != ''){
							$string5 = " AND (id in (select sid from item where name='$item'))";
						}

						$sql = "select * from yardsale where 1=1" . $string1 . $string2 . $string3 . $string4 . $string5;
					
						$result = $mysqli->query($sql);

						if ($result->num_rows > 0){

							echo '<div class="table-wrapper">
									<table class="alt">
										<thead>
											<tr>
												<th>Show</th>
												<th>Street</th>
												<th>City</th>
												<th>State</th>
												<th>Zip</th>
												<th>Type</th>
												<th>Event Date</th>
											</tr>
										</thead>
										<tbody>';
							while($row = $result->fetch_array()) {

								if ($row['type'] == 's'){
									$type = "Single Family Rummage Sale";
								} else {
									$type = "Community Rummage Sale";
								}
					 			echo '<tr><td><a href="showSale.php?id=' . $row['id'] . ' ">Show</a></td>';
								echo '<td>' . $row['street'] . "</td>";
								echo '<td>' . $row['city'] . "</td>";
								echo '<td>' . $row['state'] . "</td>";
								echo '<td>' . $row['zip'] . "</td>";
								echo '<td>' . $type . "</td>" ;
				 				echo '<td>' . $row['eventdate'] . "</td></tr>";
							}
							echo '		</tbody>
									</table>
								</div>';
						} else {
							echo "<p>No results matched your query. Click <a href='search.php'>here</a> to try again.</p>";
						}	
					 	
						?>
				</div>
				<nav>
					<ul>
						<li><a href="welcome.php#profile">Profile</a></li>
						<li><a href="welcome.php#create">Create</a></li>
						<li><a href="search.php">Search</a></li>
						<!--<li><a href="#elements">Elements</a></li>-->
						<li><a href="sales.php">Sales</a></li>
						<li><a href="logoutAction.php">Logout</a></li>
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