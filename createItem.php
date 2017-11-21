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
				<h2>Add Item</h2>
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
					
					echo '<form action="createItemAction.php" method="post" id="createitem">';
					echo '<input type="hidden" name="id" value="' . $id .'"/>';
					
					echo '<label for="name">Name</label>';
					echo'<input type="text" name="name" maxlength="40"/><br>';
							
					echo '<label for="description">Description</label>
						<textarea rows="4" cols="50" name="description" form="createitem"></textarea><br>';
						
					echo '<label for="price">Price</label>';
					echo '<input type="text" name="price"/>';
				
					echo '<ul class="actions">';
						echo '<li><input type="submit" class="button special" /></li>';
						echo '<li><input type="reset" value="Reset" /></li>';
					echo'</ul>
					</form>';
						$mysqli->close();
					?>
						
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