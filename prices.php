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
				<h2>Listing Prices</h2>
				<div class="content">
					<br>
						<?php
						$mysqli = new mysqli("localhost", "root", "password", "yardsale");

						if ($mysqli === false){
							die("ERROR: Could not connect. " . $mysqli->connect_error);
						}

						$sql = "select * from price";
					
						$result = $mysqli->query($sql);

						if ($result->num_rows > 0){

							echo '<div class="table-wrapper">
									<table class="alt">
										<thead>
											<tr>
												<th>Show</th>
												<th>Edit</th>
												<th>Delete</th>
												<th>Type</th>
												<th>Amount</th>
											</tr>
										</thead>
										<tbody>';
							while($row = $result->fetch_array()) {
					 			echo '<tr><td><a href="showPrice.php?id=' . $row['id'] . ' ">Show</a></td>';
					 			echo '<td><a href="editPrice.php?id=' . $row['id'] . ' ">Edit</a></td>';
					 			echo '<td><a href="deletePrice.php?id=' . $row['id'] . ' ">Delete</a></td>';
								echo '<td>' . $row['type'] . "</td>";
				 				echo '<td>$' . number_format(round($row["amount"],2),2) . "</td></tr>";
							}
							echo '		</tbody>
									</table>
								</div>';
						} else {
							echo "<p>No prices are currently in the system.</p>";
						}	
					 	
						?>
						<a href="createPrice.php">Add Price</a>
						<br><br><br>
				</div>
				<nav>
					<ul>
						<?php
						if (isset($_SESSION['id'])){
							echo '<li><a href="welcome.php#profile">Profile</a></li>
							<li><a href="createSale.php">Create</a></li>
							<li><a href="search.php">Search</a></li>
							<li><a href="cart.php">My Cart</a></li>
							<li><a href="sales.php">Sales</a></li>
							<li><a href="logout.php">Logout</a></li>';
							if ($_SESSION['type'] == 'i'){
								echo '<li><a href="prices.php">Prices</a></li>';
								echo '<li><a href="approveTemp.php">Approve</a></li>';
							}
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