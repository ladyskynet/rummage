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
				<h2>Create Sale</h2>
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
						<form action="createSaleAction.php" method="post">
							<label for="street">Street Address</label> 
							<input type="text" name="street" maxlength="40" required/><br>

							<label for="city">City</label>
							<input type="text" name="city" maxlength="20" required/><br>

							<label for="state">State</label>
							<input type="text" name="state" maxlength="2" required/><br>
							
							<label for="zip">Zip</label> 
							<input type="text" name="zip" maxlength="5" required/><br>
							<label for="type">Sale Type</label>
							<select name="type">
								<option value="c">Community Rummage Sale</option>
								<option value="s">Single Family Rummage Sale</option>
							</select>
							<br>
							<input type="checkbox" id="promoted" name="promoted" value="y">
							<label for="promoted">Promoted</label><br>
							<label for="eventdate">Date/Time</label> 
							<input type="datetime-local" name="eventdate" required/>
							<ul class="actions">
								<li><input type="submit" class="button special" /></li>
								<li><input type="reset" value="Reset" /></li>
							</ul>
						</form>	
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