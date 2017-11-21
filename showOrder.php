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
				<h2>Sale Details</h2>
				<div class="content">
					<br>
					<?php
					$servername = "localhost";
					$username = "root";
					$password = "password";
					$dbname = "yardsale";

					$mysqli = new mysqli($servername, $username, $password, $dbname);

					if ($mysqli === false){
						die("Connection failed: " . $mysqli->connect_error());
					} 

					$orderid = $mysqli->real_escape_string($_REQUEST['id']);
					
					$sql = "SELECT * FROM orderitem WHERE oid='$orderid'";
					
					$result = $mysqli->query($sql);
					if ($result->num_rows > 0){

						echo '<h3>Order Details</h3>
						<div class="table-wrapper">
							<table class="alt">
								<thead>
									<tr>
										<th>ID</th>
										<th>Order ID</th>
										<th>Listing Price</th>
									</tr>
								</thead>
								<tbody>';

						$sql2 = "select sum(amount) as total from price where id in (SELECT pid FROM orderitem WHERE oid='$orderid')";
						$result2 = $mysqli->query($sql2);
						$row2 = $result2->fetch_array();

						while($row = $result->fetch_array()){

							$sql3 = "select amount from price where id='$row["pid"]'";
							$result3 = $mysqli->query($sql3);
							$row3 = $result3->fetch_array();

							echo '<tr><td>' . $row["id"] . '</td>';
								
							echo '<td>' . $row["oid"] . '</td>';
								
							echo '<td>' . $row3["amount"] . '</td></tr>';
						}
						echo '</tbody>
							  <tfoot>
						  	  	<tr>
									<td colspan="5"></td>
									<td>$' . number_format(round($row2["total"],2),2) . '</td>
							  	</tr>
						  	</tfoot>
					     </table>
				 	 </div>';
					
					} else {
						echo "<p>Please select a valid order to display.</p>";
					}
					$mysqli->close();
					?>
				
				</div>
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