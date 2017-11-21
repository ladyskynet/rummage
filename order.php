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
				<h2>Place Order</h2>
				<div class="content"><br>
					<form action="orderAction.php">
						<label for="cardnumber">Card Number</label>
						<input type="text" name="cardnumber"/><br>
						<label for="exp">Expiration Date</label>
						<input type="text" name="exp"/><br>
						<label for="seccode">Security Code</label>
						<input type="text" name="seccode"/><br>
						<ul class="actions">
							<li><input type="submit" class="button special" /></li>
							<li><input type="reset" value="Reset" /></li>
						</ul>
					</form>
					<!--<div class="inner">
						<h1>Rummage</h1>
						<p>A site to peruse, create, and manage <br> rummage, yard, and garage sales.</p>
					</div>-->
				</div>
				<nav>
					<ul>
						<?php
						if (isset($_SESSION['id'])){
							echo '<li><a href="welcome.php#profile">Profile</a></li>
								<li><a href="createSale.php">Create</a></li>
								<li><a href="search.php">Search</a></li>
								<!--<li><a href="#elements">Elements</a></li>-->
								<li><a href="sales.php">Sales</a></li>
								<li><a href="logoutAction.php">Logout</a></li>';
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