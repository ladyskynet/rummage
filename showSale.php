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
				<h2>Edit</h2>
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

					$sql = "SELECT * FROM yardsale WHERE id='$id'";

					$result = $mysqli->query($sql);
					
					if ($result->num_rows > 0){
						$row = $result->fetch_assoc();

						echo '<li>Street: ' . $row["street"] . '</li>';
								
						echo '<li>City: ' . $row["city"] . '</li>';
								
						echo '<li>State: ' . $row["state"] . '</li>';
								
						echo '<li>Zip: ' . $row["zip"] . '</li>' 

						if ($row["type"] == 'c')
						{
							echo '<li>Type: Community Rummage Sale</li>';
						} else {
							echo '<li>Type: Single Family Rummage Sale</li>';
						}
						echo '<li>Date/Time: ' . $date . '</li>';
					}
					$mysqli->close();
					?>
					<br>
						<a href="create2.php#sales">Sales</a>
						<?php echo '<a href="editSale.php?id=' . $id . ' ">Edit</a>';?>
					<!--<div class="inner">
						<h1>Rummage</h1>
						<p>A site to peruse, create, and manage <br> rummage, yard, and garage sales.</p>
					</div>-->
				</div>
				<nav>
					<ul>
						<li><a href="#profile">Profile</a></li>
						<li><a href="#create">Create</a></li>
						<li><a href="#explore">Explore</a></li>
						<!--<li><a href="#elements">Elements</a></li>-->
						<li><a href="#sales">Sales</a></li>
						<li><a href="logout.php">Logout</a></li>
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