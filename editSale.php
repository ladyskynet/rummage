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
				<div class="content">
					<h2 class="major">Edit</h2>
				<!--<span class="image main"><img src="images/pic01.jpg" alt="" /></span>-->

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
						
						echo '<form action="edit.php" method="post">';
						
						echo '<input type="text" name="street" maxlength="40" value="' . $row["street"] . '"><br>';
								
						echo '<input type="text" name"city" maxlength="20" value="' . $row["city"] . '"><br>';
								
						echo '<input type="text" name="state" maxlength="2" value="' . $row["state"] . '"><br>';
								
						echo '<input type="text" name="zip" maxlength="5" value="' . $row["zip"] . '"><br>';

						echo '<div class="field half first">';
						if ($row["type"] == 'c')
						{
							echo '<input type="radio" id="community" name="type" value="c" checked>
							</div>
							<div class="field half first">
								<input type="radio" id="single" name="type" value="s">
							</div><br>';
						} else {
							echo '<input type="radio" id="community" name="type" value="c">
							</div>
							<div class="field half first">
								<input type="radio" id="single" name="type" value="s" checked>
							</div><br>';
						}
						echo '<input type="datetime-local" name="eventdate" style="font-color: black"><br><br> value="' . $row["eventdate"] . '">';
					}
					$mysqli->close();
					?>
						<label for="street">Street Address</label> 
						<label for="city">City</label>
						<label for="state">State</label>
						<label for="zip">Zip</label> 
						<label for="community">Community Rummage Sale</label>
						<label for="single">Single Family Rummage Sale</label>
						<label for="eventdate">Date/Time</label><br>
						<input type="submit">
					</form>
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