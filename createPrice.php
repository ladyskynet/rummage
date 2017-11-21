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
				<h2>Add Price</h2>
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
			<div class="main">
				<article>
					<section>
						<br>
						<?php
						$servername = "localhost";
						$username = "root";
						$password = "password";
						$dbname = "yardsale";

						$mysqli = new mysqli($servername, $username, $password, $dbname);

						if ($mysqli === false){
							die("Connection failed: " . $mysqli->connect_error);
						}
						$id = $mysqli->real_escape_string($_REQUEST['id']);
						
						echo '<form action="createPriceAction.php" method="post" id="createitem">';
						
						echo '<label for="type">Type</label>';
						echo'<input type="text" name="type" maxlength="20"/><br>';
							
						echo '<label for="amount">Amount</label>';
						echo '<input type="text" name="amount"/><br>';
						echo '<br><ul class="actions">';
							echo '<li><input type="submit" class="button special" /></li>';
							echo '<li><input type="reset" value="Reset" /></li>';
						echo'</ul>
						</form>';
							$mysqli->close();
						?>
					</section>
				</article>
			</div>

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