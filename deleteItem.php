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
				<h2>Are you sure you want to delete this item?</h2>
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
					$itemid = $mysqli->real_escape_string($_REQUEST['id']);

					$sql = "SELECT * FROM item WHERE id='$itemid'";
					
					$result = $mysqli->query($sql);
					if ($result->num_rows == 1){

						$row = $result->fetch_array();
 
						echo '<div class="table-wrapper">
							<table class="alt">
								<thead>
									<tr>
										<th>Name</th>
										<th>Description</th>
										<th>Price</th>
										<th>Edit</th>
										<th>Delete</th>
									</tr>
								</thead>
								<tbody>';
						
						echo '<tr><td>' . $row["name"] . '</td>';
								
						echo '<td>' . $row["description"] . '</td>';
								
						echo '<td>$' . $row["price"] . '</td>';

						echo '<td><a href="showItem.php?id=' . $itemid . ' ">Cancel</a></td>
							  	<td><a href="deleteItemAction.php?id=' . $itemid . ' ">Delete</a>
							</tbody>
					    </table>
					</div>';
					} else {
						echo "<p>Please select a valid item to display.</p>";
					}
					$mysqli->close();
					?>
				
				</div>
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