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
				<h2>Items to be Promoted</h2>
				<div class="content">
					<br>
						<?php
						$mysqli = new mysqli("localhost", "root", "password", "yardsale");

						if ($mysqli === false){
							die("ERROR: Could not connect. " . $mysqli->connect_error);
						}
						$sql = "select * from yardsale where promoted='a'";
						$sql2 = "select * from item where promoted='a'";

						$result = $mysqli->query($sql);
						$result2 = $mysqli->query($sql2);

						if ($result->num_rows > 0){

							echo '<div class="table-wrapper">
									<table class="alt">
										<thead>
											<tr>
												<th>Approve</th>
												<th>Street</th>
												<th>City</th>
												<th>State</th>
												<th>Zip</th>
												<th>Type</th>
												<th>Event Start Date</th>
												<th>Event End Date</th>
												<th>User ID</th>
											</tr>
										</thead>
										<tbody>';
							while($row = $result->fetch_array()) {
								$saleid = $row['id'];
					 			echo '<tr><td><a href="approveTempSaleAction.php?id=' . $saleid . '">Approve Promotion</a></td>';
								echo '<td>' . $row['street'] . "</td>";
								echo '<td>' . $row['city'] . "</td>";
								echo '<td>' . $row['state'] . "</td>";
								echo '<td>' . $row['zip'] . "</td>";
								echo '<td>' . $row['type'] . "</td>";
								echo '<td>' . $row['eventdate'] . "</td>";
								echo '<td>' . $row['enddate'] . "</td>";
								echo '<td>' . $row['uid'] . "</td></tr>";
							}
							echo '		</tbody>
									</table>
								</div>';
						} else {
							echo "<p>No sales to approve right now.</p>";
						}	

						if ($result2->num_rows > 0){

							echo '<br><br><div class="table-wrapper">
									<table class="alt">
										<thead>
											<tr>
												<th>Approve</th>
												<th>Name</th>
												<th>Description</th>
												<th>Price</th>
											</tr>
										</thead>
										<tbody>';
							while($row2 = $result2->fetch_array()) {
								$itemid = $row2['id'];
					 			echo '<tr><td><a href="approveTempItemAction.php?id=' . $itemid . ' ">Approve Promotion</a></td>';
								echo '<td>' . $row2['name'] . "</td>";
								echo '<td>' . $row2['description'] . "</td>";
				 				echo '<td>' . number_format(round($row2["price"],2),2) . "</td></tr>";
							}
							echo '		</tbody>
									</table>
								</div>';
						} else {
							echo "<p>No items to approve right now.</p>";
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