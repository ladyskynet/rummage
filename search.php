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
				<h2>Search Sales</h2>
				<div class="content"><br>
					<form action="searchAction.php">
						<label for="street">Street</label>
						<input type="text" name="street"/><br>
						<label for="city">City</label>
						<input type="text" name="city"/><br>
						<label for="state">State</label>
						<input type="text" name="state"/><br>
						<label for="zip">Zip</label>
						<input type="text" name="zip"/><br>
						<label for="item">Item</label>
						<input type="text" name="item"/><br>
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
						<li><a href="welcome.php#profile">Profile</a></li>
						<li><a href="wlecome.php#create">Create</a></li>
						<li><a href="search.php">Search</a></li>
						<!--<li><a href="#elements">Elements</a></li>-->
						<li><a href="sales.php">Sales</a></li>
						<li><a href="logoutAction.php">Logout</a></li>
					</ul>
				</nav>
			</header>

			<!-- Main -->
			<div id="main">

			<!-- Intro -->
				
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