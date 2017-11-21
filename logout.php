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
				<h2>Logging out will discard this cart!</h2>
				<div class="content">
					<br>
						<?php
						$mysqli = new mysqli("localhost", "root", "password", "yardsale");

						if ($mysqli === false){
							die("ERROR: Could not connect. " . $mysqli->connect_error);
						}

						if (isset($_SESSION['orderArray'])){
							echo '<div class="table-wrapper">
								<table class="alt">
									<thead>
										<tr>
											<th>Sale ID</th>
											<th>User ID</th>
											<th>Name</th>
											<th>Description</th>
											<th>Set Price</th>
											<th>Listing Price</th>
										</tr>
									</thead>
									<tbody>';
							$total = 0;
							foreach ($_SESSION['orderArray'] as $value) {
								$total += $listingPrice;
								$sql = "SELECT amount FROM price where id='$value[5]'";
								$result = $mysqli->query($sql);
								$row = $result->fetch_array();
								$listingPrice = $row['amount'];
					 			echo '<tr><td>' . $value[0] . "</td>";
					 			echo '<td>' . $value[1] . "</td>";
					 			echo '<td>' . $value[2] . "</td>";
					 			echo '<td>' . $value[3] . "</td>";
					 			echo '<td>$' . number_format(round($value[4],2),2) . "</td>";
					 			echo '<td>$' . number_format(round($listingPrice,2),2) . "</td></tr>";
							}
							echo '	</tbody>
								  	<tfoot>
								  	  	<tr>
											<td colspan="5"></td>
											<td>$' . number_format(round($total,2),2) . '</td>
									  	</tr>
								  	</tfoot>
								</table>
							</div>';
					} else {
						echo "<p>Your cart is empty right now.</p>";
					} 
					?>
					<ul class="actions">
						<li><a href="logoutAction.php">Logout</a></li>
						<li><a href="cart.php">Cancel</a></li>
					</ul>
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