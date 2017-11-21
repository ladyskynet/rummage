<?php
session_start();
if (isset($_SESSION['id'])){
	echo ""
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
				<div class="content">
					<div class="inner">
						<h1>Rummage</h1>
						<p>A site to peruse, create, and manage <br> rummage, yard, and garage sales.</p>
					</div>
				</div>
				<nav>
					<ul>
						<li><a href="#profile">Profile</a></li>
						<li><a href="#create">Create</a></li>
						<li><a href="search.php">Search</a></li>
						<!--<li><a href="#elements">Elements</a></li>-->
						<li><a href="sales.php">Sales</a></li>
						<li><a href="logoutAction.php">Logout</a></li>
					</ul>
				</nav>
			</header>

			<!-- Main -->
			<div id="main">
				<!-- Profile -->
				<article id="profile">
					<h2 class="major">Profile</h2>
					<!--<span class="image main"><img src="images/pic02.jpg" alt="" /></span>-->
					Username: <?php echo("{$_SESSION['username']}"."<br>"); ?><br>
					First Name: <?php echo("{$_SESSION['firstname']}"."<br>"); ?><br>
					Last Name: <?php echo("{$_SESSION['lastname']}"."<br>"); ?><br>
					Email: <?php echo("{$_SESSION['email']}"."<br>"); ?>
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
