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
				<h2>Order Details</h2>
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
					
					$sql = "SELECT * FROM orderitem WHERE orid='$orderid'";
					
					$result = $mysqli->query($sql);

					if ($result->num_rows > 0){
						echo '<div class="table-wrapper">';
							echo '<table class="alt">';
								echo '<thead>';
									echo '<tr>';

						$sql2 = "SELECT sum(amount) as total from price inner join orderitem on price.id = orderitem.pid and orid='$orderid'";
						$result2 = $mysqli->query($sql2);
						$row2 = $result2->fetch_array();
						while($row = $result->fetch_array()) {

							$pid = $row['pid'];
							$sql3 = "SELECT amount from price where id='$pid'";
							$result3 = $mysqli->query($sql3);
							if ($result3->num_rows > 0){
								$row3 = $result3->fetch_array();
								$amount = $row3['amount'];
								$sid = $row['sid'];
								$itemid = $row['itemid'];

								if ($pid == '1'){
									$sql4 = "SELECT * FROM item where id='$itemid'";
								} else {
									$sql4 = "SELECT * FROM yardsale where id='$sid'";
								}
								
								$result4 = $mysqli->query($sql4);
								if ($result4->num_rows){
									$row4 = $result4->fetch_array();
									if ($row4['approved'] == 'n'){
										$promoted = 'No';
									} else {
										$promoted = "Yes";
									}

									if ($pid == '1'){
										echo '<th>Name</th>';
										echo '<th>Description</th>';
										echo '<th>Amount</th>';
										echo '</tr>
											</thead>
										<tbody>';
										$amount = $row4['amount'];

										echo '<tr><td>' . $row4["name"] . '</td>';
									
										echo '<td>' . $row4["description"] . '</td>';
							
										echo '<td>$' . number_format(round($amount,2),2) . '</td></tr>';
									} else {
										echo '<th>Street</th>';
										echo '<th>City</th>';
										echo '<th>State</th>';
										echo '<th>Zip</th>';
										echo '<th>Event Date</th>';
										echo '<th>Type</th>';
										echo '</tr>
											</thead>
										<tbody>';
										echo '<tr><td>' . $row4["street"] . '</td>';
									
										echo '<td>' . $row4["city"] . '</td>';

										echo '<td>' . $row4["state"] . '</td>';

										echo '<td>' . $row4["zip"] . '</td>';
										
										echo '<td>' . $row4["eventdate"] . '</td>';
										
										echo '<td>' . $row4["type"] . '</td></tr>';
									}

								} else {
									echo "Something went wrong." . $mysqli->error;
								}
								
							} else {
								echo "Something went wrong." . $mysqli->error;
							}
						}
						echo '</tbody>
							  <tfoot>
						  	  	<tr>
									<td colspan="4"></td>';
									echo '<td>$' . number_format(round($row2["total"],2),2) . '</td>';
							  	echo '</tr>
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