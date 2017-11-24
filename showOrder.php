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
										echo '<th>ID</th>';
										echo '<th>Order ID</th>';
										echo '<th>Sale ID</th>';
										echo '<th>Item ID</th>';
										echo '<th>Order Date</th>';
										echo '<th>Listing Price</th>';
									echo '</tr>
								</thead>
								<tbody>';

						$sql2 = "SELECT sum(amount) as total from price inner join orderitem on price.id = orderitem.pid and orid='$orderid'";
						$result2 = $mysqli->query($sql2);
						$row2 = $result2->fetch_array();
						while($row = $result->fetch_array()) {

							if ($row['itemid'] == NULL){
								$item = "N/A";
							} else {
								$item = $row['itemid'];
							}
							$pid = $row['pid'];
							$sql3 = "SELECT amount from price where id='$pid'";
							$result3 = $mysqli->query($sql3);
							if ($result3->num_rows > 0){
								$row3 = $result3->fetch_array();

								$sql4 = "SELECT * from payment where id='$orderid'";
								$result4 = $mysqli->query($sql4);
								$row4 = $result4->fetch_array();

								$amount = $row3['amount'];

								echo '<tr><td>' . $row["id"] . '</td>';
									
								echo '<td>' . $row["orid"] . '</td>';

								echo '<td>' . $row["sid"] . '</td>';

								echo '<td>' . $item . '</td>';

								echo '<td>' . $row4['datepurc'] . '</td>';
						
								echo '<td>$' . number_format(round($amount,2),2) . '</td></tr>';
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
							echo '<li><a href="welcome.php#profile">Profile</a></li>';
							
							if ($_SESSION['type'] == 'i'){
								echo '<li><a href="prices.php">Prices</a></li>';
								echo '<li><a href="approveTemp.php">Approve</a></li>';
								echo '<li><a href="manageSales.php">All Sales</a></li>';
							} else {
								echo '<li><a href="createSale.php">Create</a></li>';
								echo '<li><a href="cart.php">My Cart</a></li>';
							    echo '<li><a href="sales.php">Sales</a></li>';
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