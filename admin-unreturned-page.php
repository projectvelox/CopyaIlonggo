<?php 
	error_reporting(0);
  	ini_set('display_errors', 0); 

    include('session.php');
    include('config.php');

	if(!isset($_SESSION['login_user'])){
	  header("location:index.php");
	}
?>
<!DOCTYPE html>
<html>
<head>
		<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Copya Ilonggo Sales and Services</title>
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/style.css">
	<link rel="icon" href="img/logo.png" type="image/x-icon" />
</head>
<body>

	<!-- The Navigation Bar -->
	<nav class="navbar navbar-inverse navbar-fixed-top"> 
	  <div class="container">
	    <div class="navbar-header">
	      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
	        <span class="sr-only">Toggle navigation</span>
	        <span class="icon-bar"></span>
	        <span class="icon-bar"></span>
	        <span class="icon-bar"></span>
	      </button>
	      <a class="navbar-brand" href="index.php"><img src="img/logo.png" height="20" style="display: inline-block;"> Copya Ilonggo</a>
	    </div>
	    <div id="navbar"  class="navbar-collapse collapse navbar-right">
	      	<ul class="nav navbar-nav">
		        <li class="dropdown">
		          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-user"></span> <?php echo "$login_fullname"?> <span class="caret"></span></a>
		          <ul class="dropdown-menu">
		            <li><a href="logout.php">Logout</a></li>
		          </ul>
		        </li>
	        </ul>
	    </div>
	  </div>
	</nav>

	<!-- Content -->
	<div class="container" style="margin-top: 80px;">
		<div class="row">
			<ol class="breadcrumb">
			  <li class="breadcrumb-item"><a href="admin-dashboard.php">Dashboard</a></li>
			   <li class="breadcrumb-item"><a href="admin-dashboard-rental.php">Rental List</a></li>
			   <li class="breadcrumb-item"><a href='admin-rental-unreturned.php'>Unreturned Items</a></li>
			   <li class="breadcrumb-item active"><span><?php echo $_GET['name'] ?></span></li>
			</ol>
			<div style="margin-left: 15px; margin-right: 15px;">
			<h3>Unreturned Rental - <?php echo $_GET['name'] ?></h3>
			<div class="table-responsive">
				<table class="table table-hover">
					<tr>
						<th>#</th>
						<th>Borrower's Name</th>
						<th>Equipment Name</th>
						<th>Quantity</th>
						<th>Address</th>
						<th>Contact Number</th>
						<th>Date Borrowed</th>
						<th>Date Due</th>
					</tr>
					<?php
						$i = 0;
						$name = $_GET['name'];
						$con = mysqli_connect("localhost","root","","ci");
						$result = mysqli_query($con,"SELECT * FROM borrower_cart WHERE status='On Hand' AND name='$name'");
							while($row = mysqli_fetch_array($result))
							{
								$i++;
								$date_borrowed = date('M j Y g:i A', strtotime($row['date_borrowed']));
								$date_due = date('M j Y g:i A', strtotime($row['date_due']));
								echo "<tr>";
								echo "<td>" . $i . ".</td>";
								echo "<td>" . $row['name'] . "</td>";
								echo "<td>" . $row['equipment_name'] . "</td>";
								echo "<td>" . $row['qty'] . "</td>";
								echo "<td>" . $row['address'] . "</td>";
								echo "<td>" . $row['contact'] . "</td>";
								echo "<td>" . $date_borrowed . "</td>";
								echo "<td>" . $date_due . "</td>";
								echo "</tr>";
							}
							echo "</table>";
							mysqli_close($con);
					?>
				</table>
			</div>
			</div>
		</div>
	</div>
	<footer style="margin-top: 40px;">
	    <div class="footer-bottom">
	        <div class="container">
	            <p class="text-center"> Copyright © Copya Ilonggo. All right reserved. </p>
	        </div>
	    </div>
	</footer>
	<script type="text/javascript" src="js/jquery-3.1.1.min.js"></script>
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
</body>
</html>