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

						while($row2 = $result2->fetch_array()) {
							
							$salearray[$index][0] = $row2['id']; 
							$salearray[$index][1] = $row2['street']; 
							$salearray[$index][2] = $row2['city']; 
							$salearray[$index][3] = $row2['state']; 
							$salearray[$index][4] = $row2['zip']; 
							$salearray[$index][5] = $row2['eventdate']; 
							$salearray[$index][6] = $row2['uid']; 
							if ($row2['type'] == 's'){
								$type = "Single Family Rummage Sale";
							} else {
								$type = "Community Rummage Sale";
							}
							$salearray[$index][7] = $row2['type']; 
							$index += 1;
						}

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
						$_SESSION['index'] = $index;
						foreach ($salearray as &$value){
				 			echo '<tr><td><a href="showSale.php?id=' . $value[0] . ' ">Show</a></td>';
							echo '<td>' . $value[1] . "</td>";
							echo '<td>' . $value[2] . "</td>";
							echo '<td>' . $value[3] . "</td>";
							echo '<td>' . $value[4] . "</td>";
							echo '<td>' . $type . "</td>" ;
			 				echo '<td>' . $value[5] . "</td></tr>";
						}
						echo '		</tbody>
								</table>
							</div>';
					} else {
						echo "<p>You don't currentnly have any rummage sales to display.</p>";
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