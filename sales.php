<?php
session_start();
if (isset($_SESSION['id'])){
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
				<h2>My Rummage Sales</h2>
				<div class="content">
					<br>
						<?php
						$mysqli = new mysqli("localhost", "root", "password", "yardsale");

						if ($mysqli === false){
							die("ERROR: Could not connect. " . $mysqli->connect_error);
						}

						$userid = $_SESSION['id'];
						$sql = "SELECT * FROM yardsale WHERE uid='$userid'";
						$result = $mysqli->query($sql);

						if ($result->num_rows > 0){

							echo '<div class="table-wrapper">
									<table class="alt">
										<thead>
											<tr>
												<th>Show</th>
												<th>Edit</th>
												<th>Delete</th>
												<th>Add Item(s)</th>
												<th>Street</th>
												<th>City</th>
												<th>State</th>
												<th>Zip</th>
												<th>Type</th>
												<th>Event Start Date</th>
												<th>Event End Date</th>
												<th>Promoted</th>
											</tr>
										</thead>
										<tbody>';
							while($row = $result->fetch_array()) {
								if ($row['approved'] == 'n'){
									$approved = "No";
								} else {
									$approved = "Yes";
								}
								$id = $row['id'];
								#$sql2 = "SELECT SUM(price) as total FROM item WHERE sid='$id'";
								#$result2 = $mysqli->query($sql2);
								#$row2 = $result2->fetch_array();

								if ($row['type'] == 's'){
									$type = "Single Family Rummage Sale";
								} else {
									$type = "Community Rummage Sale";
								}
					 			echo '<tr><td><a href="showSale.php?id=' . $row['id'] . ' ">Show</a></td>';
					 			echo '<td><a href="editSale.php?id=' . $row['id'] . ' ">Edit</a></td>';
					 			echo '<td><a href="deleteSale.php?id=' . $row['id'] . ' ">Delete</a></td>';
							  	echo '<td><a href="createItem.php?id=' . $row['id'] . ' ">Add Item(s)</a></td>';
								echo '<td>' . $row['street'] . "</td>";
								echo '<td>' . $row['city'] . "</td>";
								echo '<td>' . $row['state'] . "</td>";
								echo '<td>' . $row['zip'] . "</td>";
								echo '<td>' . $type . "</td>" ;
				 				echo '<td>' . $row['eventdate'] . "</td>";
				 				echo '<td>' . $row['enddate'] . "</td>";
				 				echo '<td>' . $approved . "</td>";
				 				#echo '<td>$' . number_format(round($row2['total'],2), 2) . "</td></tr>";
							}
							echo '		</tbody>
									</table>
								</div>';
						} else {
							echo "<p>You don't currenntly have any rummage sales to display.</p>";
						}	
					 	
						?>
				</div>
				<nav>
					<ul>
						<?php
						if (isset($_SESSION['id'])){
							echo '<li><a href="welcome.php#profile">Profile</a></li>';
							
							if ($_SESSION['type'] == 'i'){
								echo '<li><a href="prices.php">Prices</a></li>';
								echo '<li><a href="approveTemp.php">Approve</a></li>';
								echo '<li><a href="manageSales.php">All Sales</a></li>';
								echo '<li><a href="stats.php">Statistics</a></li>';
							} else {
								echo '<li><a href="createSale.php">Create</a></li>';
								echo '<li><a href="cart.php">My Cart</a></li>';
							    echo '<li><a href="sales.php">My Sales</a></li>';
							    echo '<li><a href="orders.php">My Orders</a></li>';
							}
							echo '<li><a href="search.php">Search</a></li>';
							echo '<li><a href="logout.php">Logout</a></li>';

						} else {
							echo'<li><a href="index.html#join">Join</a></li>
								<li><a href="index.html#login">Login</a></li>
								<li><a href="search.php">Search</a></li>
								<li><a href="index.html#about">About</a></li>';
						}
						?>
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