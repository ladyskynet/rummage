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
				<h2>Edit Item</h2>
				<div class="content">

				<!--<span class="image main"><img src="images/pic01.jpg" alt="" /></span>-->
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

					$sql = "SELECT * FROM item WHERE id='$id'";

					$result = $mysqli->query($sql);
					
					if ($result->num_rows > 0){
						$row = $result->fetch_assoc();
						
						echo '<form action="editItemAction.php" method="post" id="edititem">';
						
						echo '<label for="name">Name</label> 

						<input type="hidden" name="id" value="' . $id . '"/>

						<input type="text" name="name" maxlength="40" value="' . $row["name"] . '"/><br>';
								
						echo '<label for="description">Description</label>
						<textarea rows="4" cols="50" name="description" form="edititem" maxlength="100">' . $row["description"] . '</textarea><br>';
								
						echo '<label for="price">Price</label>
						<input type="text" name="price" value="' . number_format(round($row["price"],2),2) . '"/>';

						if (($row["promoted"] == 'f') && ($row["approved"] == 'y')){
							echo "<p>This item has already been promoted and approved.</p>";
						} elseif ($row['promoted'] == 'a' && $row["approved"] == 'n'){
							echo '<br><input type="checkbox" id="promoted" name="promoted" value="a" checked>
								<label for="promoted">Promoted</label><br><br>
								<p>This item is waiting for managerial approval.</p>';
						} elseif ($row['promoted'] == 'c' && $row["approved"] == 'n'){
							echo '<br><input type="checkbox" id="promoted" name="promoted" value="c" checked>
								<label for="promoted">Promoted</label><br><br>
								<p>This item is in your cart.</p>';
						} else {
							echo '<br><input type="checkbox" id="promoted" name="promoted" value="p">
								<label for="promoted">Promoted</label><br><br>';
						}
					}
					$mysqli->close();
					?>
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