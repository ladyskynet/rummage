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

						$sql = "select * from yardsale where id in (select sid from temp)";
						$sql2 = "select * from item where id in (select thing from temp)";
					
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
												<th>Event Date</th>
												<th>User ID</th>
											</tr>
										</thead>
										<tbody>';
							while($row = $result->fetch_array()) {
					 			echo '<tr><td><a href="approveTempSaleAction.php?id=' . $row['id'] . ' ">Approve Promotion</a></td>';
								echo '<td>' . $row['Street'] . "</td>";
								echo '<td>' . $row['City'] . "</td>";
								echo '<td>' . $row['State'] . "</td>";
								echo '<td>' . $row['Zip'] . "</td>";
								echo '<td>' . $row['Type'] . "</td>";
								echo '<td>' . $row['Event Date'] . "</td>";
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
					 			echo '<tr><td><a href="approveTempItemAction.php?id=' . $row2['id'] . ' ">Approve Promotion</a></td>';
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