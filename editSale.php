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
				<h2>Edit Sale</h2>
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
						
						echo '<form action="editSaleAction.php" method="post">';
						
						echo '<label for="street">Street Address</label> 
						<input type="hidden" name="saleid" value="' . $row["id"] . '"/>
						<input type="hidden" name="uid" value="' . $row["uid"] . '"/>
						<input type="text" name="street" maxlength="40" value="' . $row["street"] . '"/><br>';
								
						echo '<label for="city">City</label>
						<input type="text" name="city" maxlength="20" value="' . $row["city"] . '"/><br>';
								
						echo '<label for="state">State</label>
						<input type="text" name="state" maxlength="2" value="' . $row["state"] . '"/><br>';
								
						echo '<label for="zip">Zip</label> 
						<input type="text" name="zip" maxlength="5" value="' . $row["zip"] . '"/><br>';

						echo '<label for="type2">Type</label>';
						echo '<select name="type2">';
						if ($row["type"] == 'c')
						{
							echo '<option id="community" name="type" value="c" selected="selected">Community Rummage Sale</option>
								<option id="single" name="type" value="s">Single Family Rummage Sale</option>
							<br>';
						} else {
							echo '<option id="community" name="type" value="c">Community Rummage Sale</option>
								<option id="single" name="type" value="s" selected="selected">Single Family Rummage Sale</option>';
						}
						echo '</select><br>';

						if (($row["promoted"] == 'y') && ($row["approved"] == 'y')){
							echo "<p>This item has already been promoted and approved.</p>";
						}
						if ($row['promoted'] == 'n'){
							echo '<br><input type="checkbox" id="promoted" name="promoted" value="y">
								<label for="promoted">Promoted</label><br><br>';
						}
						
						$date = str_replace(' ', 'T', $row["eventdate"]);
						echo '<label for="eventdate">Date/Time</label>
						<input type="datetime-local" name="eventdate" value="' . $date . '"/>';

						$sql2 = "SELECT * FROM item WHERE sid='$id'";
						$result2 = $mysqli->query($sql2);
						if ($result2->num_rows > 0){
							echo '<br><br><h3>Sale Items</h3>
							<div class="table-wrapper">
									<table class="alt">
										<thead>
											<tr>
												<th>Show</th>
												<th>Edit</th>
												<th>Delete</th>
												<th>Name</th>
												<th>Description</th>
												<th>Promoted</th>
												<th>Price</th>
											</tr>
										</thead>
										<tbody>';
							while($row2 = $result2->fetch_array()) {
								if ($row2['approved'] == 'y'){
									$approved = 'Yes';
								} else {
									$approved = 'No';
								}
				 				echo '<tr><td><a href="showItem.php?id=' . $row2['id'] . ' ">Show</a></td>';
				 				echo '<td><a href="editItem.php?id=' . $row2['id'] . ' ">Edit</a></td>';
							    echo '<td><a href="deleteItem.php?id=' . $row2['id'] . ' ">Delete</a>';
								echo '<td>' . $row2['name'] . "</td>";
								echo '<td>' . $row2['description'] . "</td>";
								echo '<td>' . $approved . '</td>';
								echo '<td>$' . number_format(round($row2["price"],2),2) . "</td>";
							}
							echo '		</tbody>
									</table>
								</div>';
						} else {
							echo "<br><br><p>There aren't any items attached to this sale.</p>";
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