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
				<h2>Add Item</h2>
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
						
						echo '<form action="createItemAction.php" method="post" id="createitem">';
						echo '<input type="hidden" name="id" value="' . $id .'"/>';
						
						echo '<label for="name">Name</label>';
						echo'<input type="text" name="name" maxlength="40" required/><br>';
								
						echo '<label for="description">Description</label>
							<textarea rows="4" cols="50" name="description" form="createitem" maxlength="100"></textarea><br>';
							
						echo '<label for="price">Price</label>';
						echo '<input type="text" name="price"/><br>';
						echo '<div class="field half">
								<input type="checkbox" id="promoted" name="promoted" value="y">
								<label for="promoted">Promoted</label>
							</div>';
					
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