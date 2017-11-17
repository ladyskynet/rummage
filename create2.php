<?php
session_start();
?>
<!DOCTYPE HTML>
<!--
	Dimension by HTML5 UP
	html5up.net | @ajlkn
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
	<head>
		<title>Rummage</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="assets/css/main.css" />
		<!--[if lte IE 9]><link rel="stylesheet" href="assets/css/ie9.css" /><![endif]-->
		<noscript><link rel="stylesheet" href="assets/css/noscript.css" /></noscript>
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
							<li><a href="#logout">Logout</a></li>
						</ul>
					</nav>
				</header>

				<!-- Main -->
				<div id="main">

					<!-- Intro -->
					<article id="create">
						<h2 class="major">Create</h2>
						<!--<span class="image main"><img src="images/pic01.jpg" alt="" /></span>-->
						<form action="create.php" method="post">
							
							Street Address: <input type="text" name="street" maxlength="40"><br>
							City: <input type="text" name"city" maxlength="20"><br>
							State: <input type="text" name="state" maxlength="2"><br>
							Zip: <input type="text" name="zip" maxlength="5"><br>
							<div class="field half first">
                                                               		<input type="radio" id="community" name="type" value="c">
                                                                        <label for="community">Community Rummage Sale</label>
                                                                </div>
							<div class="field half first">
                                                                        <input type="radio" id="single" name="type" value="s">
                                                                        <label for="single">Single Family Rummage Sale</label>
                                                                      </div><br>


							Date/Time: <br> <input type="datetime-local" name="eventdate" style="font-color: black"><br><br>
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
						Password: <?php echo("{$_SESSION['password']}"."<br>"); ?><br>
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
									 	foreach ($_SESSION['salearray'] as &$value){
											echo '<tr><td>' . $value['street'] . "</td>";
											echo '<td>' . $value['city'] . "</td>";
											echo '<td>' . $value['state'] . "</td>";
											echo '<td>' . $value['zip'] . "</td>";
											echo '<td>' . $value['type'] . "</td>" ;
								 			echo '<td>' . $value['eventdate'] . "</td></tr>";
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
