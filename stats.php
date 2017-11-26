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
				<h2>Order Statistics</h2>
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
					#$itemid = $mysqli->real_escape_string($_REQUEST['id']);
					$curryear = date("Y");
					$currmonth = date("m");
					$l = date("d")-7;
					$lastweek = $curryear . "-" . $currmonth . "-" . $l;

					echo $lastweek;

					$lastmonth = date("m")-1;
					echo $lastmonth;

					$lastyear  = date("Y")-1;
					echo $lastyear;

					$sql = "select sum(cost) as total, payment.id as oid from orderitem inner join payment on orderitem.orid=payment.id where datepurc >= '$lastweek' group by payment.id";
					$sql2 = "select sum(cost) as total, payment.id as oid from orderitem inner join payment on orderitem.orid=payment.id where datepurc >= '$lastmonth' group by payment.id";
					$sql3 = "select sum(cost) as total, payment.id as oid from orderitem inner join payment on orderitem.orid=payment.id where datepurc >= '$lastyear' group by payment.id";

					echo $sql . '<br>';
					echo $sql2 . '<br>';
					echo $sql3 . '<br>';

					$result = $mysqli->query($sql);
					$result2 = $mysqli->query($sql2);
					$result3 = $mysqli->query($sql3);
					
					if ($result->num_rows > 1){
 
						echo '<div class="table-wrapper">';
							echo '<table class="alt">';
								echo '<thead>';
									echo '<tr>';
										echo '<th>Order ID</th>';
										echo '<th>Order Date</th>';
										echo '<th>Total</th>';
									echo '</tr>
									</thead>
								<tbody>';

						while($row = $result->fetch_array()){

							$oid = $row['oid'];

							$sql4 = "SELECT id, datepurc from payment where id='$oid'";

							$result4 = $mysqli->query($sql4);

							$row4 = $result4->fetch_array();
						
							echo '<tr><td>' . $row4["id"] . '</td>';
								
							echo '<td>' . $row4["datepurc"] . '</td>';
								
							echo '<td>$' . number_format(round($row["total"],2),2) . '</td></tr>';
						}

						echo '</tbody>
					    </table>
					</div>';

					} else {
						echo "<p>No orders for last week.</p>";
					}

					if ($result2->num_rows > 1){
 
						echo '<div class="table-wrapper">';
							echo '<table class="alt">';
								echo '<thead>';
									echo '<tr>';
										echo '<th>Order ID</th>';
										echo '<th>Order Date</th>';
										echo '<th>Total</th>';
									echo '</tr>
									</thead>
								<tbody>';

						while($row2 = $result2->fetch_array()){

							$oid = $row2['oid'];

							$sql5 = "SELECT id, datepurc from payment where id='$oid'";

							$result5 = $mysqli->query($sql5);

							$row5 = $result5->fetch_array();
						
							echo '<tr><td>' . $row5["id"] . '</td>';
								
							echo '<td>' . $row5["datepurc"] . '</td>';
								
							echo '<td>$' . number_format(round($row2["total"],2),2) . '</td></tr>';
						}

						echo '</tbody>
					    </table>
					</div>';

					} else {
						echo "<p>No orders for last month.</p>";
					}

					if ($result3->num_rows > 1){
 
						echo '<div class="table-wrapper">';
							echo '<table class="alt">';
								echo '<thead>';
									echo '<tr>';
										echo '<th>Order ID</th>';
										echo '<th>Order Date</th>';
										echo '<th>Total</th>';
									echo '</tr>
									</thead>
								<tbody>';

						while($row3 = $result3->fetch_array()){

							$oid = $row3['oid'];
							
							$sql6 = "SELECT id, datepurc from payment where id='$oid'";

							$result6 = $mysqli->query($sql6);

							$row6 = $result6->fetch_array();
						
							echo '<tr><td>' . $row6["id"] . '</td>';
								
							echo '<td>' . $row6["datepurc"] . '</td>';
								
							echo '<td>$' . number_format(round($row3["total"],2),2) . '</td></tr>';
						}

						echo '</tbody>
					    </table>
					</div>';

					} else {
						echo "<p>No orders for last year.</p>";
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