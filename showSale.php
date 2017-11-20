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
					$saleid = $mysqli->real_escape_string($_REQUEST['id']);
					

					$sql = "SELECT * FROM yardsale WHERE id='$saleid'";
					
					$result = $mysqli->query($sql);
					if ($result->num_rows == 1){

						$row = $result->fetch_array();
 
						echo '<h3>Sale Details</h3>
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
										<th>Edit</th>
										<th>Delete</th>
										<th>Add Items</th>
									</tr>
								</thead>
								<tbody>';
						
						echo '<tr><td>' . $row["street"] . '</td>';
								
						echo '<td>' . $row["city"] . '</td>';
								
						echo '<td>' . $row["state"] . '</td>';
								
						echo '<td>' . $row["zip"] . '</td>'; 

						if ($row["type"] == 'c')
						{
							echo '<td>Community Rummage Sale</td>';
						} else {
							echo '<td>Type: Single Family Rummage Sale</td>';
						}
						echo '	<td>Date/Time: ' . $row["eventdate"] . '</td>
							  	<td><a href="editSale.php?id=' . $saleid . ' ">Edit</a></td>
							  	<td><a href="deleteSale.php?id=' . $saleid . ' ">Delete</a></td>
							  	<td><a href="createItem.php?id=' . $saleid . ' ">Add Item(s)</a></td>
							</tbody>
					    </table>
					</div>';
						$sql2 = "SELECT * FROM item WHERE sid='$saleid'";
						$result2 = $mysqli->query($sql2);
						if ($result2->num_rows > 0){
							echo '<h3>Sale Items</h3>
							<div class="table-wrapper">
									<table class="alt">
										<thead>
											<tr>
												<th>ID</th>
												<th>Name</th>
												<th>Description</th>
												<th>Price</th>
											</tr>
										</thead>
										<tbody>';
							while($row2 = $result2->fetch_array()) {
				 				echo '<tr><td><a href="showItem.php?id=' . $row2['id'] . ' ">Show</a></td>';
								echo '<td>' . $row2['name'] . "</td>";
								echo '<td>' . $row2['description'] . "</td>";
								echo '<td>$' . $row2['price'] . "</td>";
							}
							echo '		</tbody>
									</table>
								</div>';
						} else {
							echo "<p>There aren't any items attached to this sale.</p>";
						}
					} else {
						echo "<p>Please select a valid sale to display.</p>";
					}
					$mysqli->close();
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