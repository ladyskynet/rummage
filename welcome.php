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
					<div class="inner">
						<h1>Rummage</h1>
						<p>A site to peruse, create, and manage <br> rummage, yard, and garage sales.</p>
					</div>
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

				<!-- Create -->
				<article id="create">
					<h2 class="major">Create</h2>
					<!--<span class="image main"><img src="images/pic01.jpg" alt="" /></span>-->
					<form action="create.php" method="post">
						<label for="street">Street Address</label> 
						<input type="text" name="street" maxlength="40"><br>
						<label for="city">City</label>
						<input type="text" name="city" maxlength="20"><br>
						<label for="state">State</label>
						<input type="text" name="state" maxlength="2"><br>
						<label for="zip">Zip</label> 
						<input type="text" name="zip" maxlength="5"><br>
						<div class="field half first">
							<input type="radio" id="community" name="type" value="c">
							<label for="community">Community Rummage Sale</label>
						</div>
						<div class="field half first">
							<input type="radio" id="single" name="type" value="s">
							<label for="single">Single Family Rummage Sale</label>
						</div><br>
						<label for="eventdate">Date/Time</label> 
						<br> <input type="datetime-local" name="eventdate" style="font-color: black"><br><br>
						<input type="submit">
					</form>	
				</article>

				<!-- Profile -->
				<article id="profile">
					<h2 class="major">Profile</h2>
					<!--<span class="image main"><img src="images/pic02.jpg" alt="" /></span>-->
					Username: <?php echo("{$_SESSION['username']}"."<br>"); ?><br>
					First Name: <?php echo("{$_SESSION['firstname']}"."<br>"); ?><br>
					Last Name: <?php echo("{$_SESSION['lastname']}"."<br>"); ?><br>
					Email: <?php echo("{$_SESSION['email']}"."<br>"); ?>
				</article>

				<!-- Saless -->
				<article id="sales">
					<section>
						<h3 class="major">My Rummage Sales</h2>
						<div class="table-wrapper">
							<table class="alt">
								<thead>
									<tr>
										<th>ID</th>
										<th>Street</th>
										<th>City</th>
										<th>State</th>
										<th>Zip</th>
										<th>Type</th>
										<th>Event Date</th>
									</tr>
								</thead>
								<tbody>
									<?php
									$mysqli = new mysqli("localhost", "root", "password", "yardsale");

									if ($mysqli === false){
										die("ERROR: Could not connect. " . $mysqli->connect_error);
									}

									$userid = $_SESSION['id'];
							
									$sql2 = "SELECT * FROM yardsale WHERE uid='$userid'";
									$result2 = $mysqli->query($sql2);
									$salearray = array();
									$index = 0;

									if ($result2->num_rows > 0){

										while($row2 = $result2->fetch_assoc()) {
											
											$salearray[$index][0] = $row2['id']; 
											$salearray[$index][1] = $row2['street']; 
											$salearray[$index][2] = $row2['city']; 
											$salearray[$index][3] = $row2['state']; 
											$salearray[$index][4] = $row2['zip']; 
											$salearray[$index][5] = $row2['eventdate']; 
											$salearray[$index][6] = $row2['uid']; 
											$salearray[$index][7] = $row2['type']; 
											$index +=1;
										}
										$_SESSION['index'] = $index;
									}	
								 	foreach ($salearray as &$value){
								 		echo '<tr><td><a href="showSale.php?id=' . $value[0] . ' ">Show</a></td>';
										echo '<td>' . $value[1] . "</td>";
										echo '<td>' . $value[2] . "</td>";
										echo '<td>' . $value[3] . "</td>";
										echo '<td>' . $value[4] . "</td>";
										echo '<td>' . $value[7] . "</td>" ;
							 			echo '<td>' . $value[5] . "</td></tr>";
									}
									?>
								</tbody>
							</table>
						</div>
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
