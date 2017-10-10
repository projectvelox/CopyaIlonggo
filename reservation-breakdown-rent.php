<?php 
	date_default_timezone_set('Asia/Manila'); 
	$name = $_GET['name'];
	$con = mysqli_connect("localhost","root","","ci");
	include('session.php');
	if(!isset($_SESSION['login_user'])){
	  header("location:index.php");
	}

	$result = mysqli_query($con, "SELECT FORMAT(SUM(total_price),2) AS totalPrice FROM borrower_cart WHERE status='Reserved' AND name='$name'");
	$row = mysqli_fetch_assoc($result);
	$total = $row['totalPrice'];
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
	<link rel="stylesheet" type="text/css" href="css/carousel.css">
	<link rel="icon" href="img/logo.png" type="image/x-icon" />
	<style type="text/css">	
	.table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th { border-top: 0px; } 
	.breadcrumb { margin-left: 0px; margin-right: 0px; }  
</style>
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

	<div class="container cswd-container" style="margin-top: 40px !important;">
		<ol class="breadcrumb">
		   <li class="breadcrumb-item"><a href="admin-dashboard.php">Dashboard</a></li>
		   <li class="breadcrumb-item"><a href="admin-reservation-list.php">Reservations</a></li>
		   <li class="breadcrumb-item active"><span><?=$name?>'s Reservation</span></li>
		</ol>

		<h3><?=$name?>'s Reservation</h3>
		<div class="table-responsive"> 
			<table class="table table-striped">
				<tr>
					<th>#</th>
					<th>Equipment Name</th>
					<th>Date Borrowed</th>
					<th>Date Due</th>
					<th>Price</th>
				</tr>
				<?php
					$i = 0;
					$result = mysqli_query($con,"SELECT * FROM borrower_cart WHERE status='Reserved' AND name='$name'");
					while($row = mysqli_fetch_array($result))
					{
						$i++;
						$date_borrowed = date('M j Y g:i A', strtotime($row['date_borrowed']));
						$date_due = date('M j Y g:i A', strtotime($row['date_due']));
						echo "<tr>";
						echo "<td>" . $i . ".</td>";
						echo "<td>" . $row['equipment_name'] . "</td>";
						echo "<td>" . $date_borrowed . "</td>";
						echo "<td>" . $date_due . "</td>";
						echo "<td>₱" . $row['total_price']. "</td>";
						echo "</tr>";
					}
				?>
			</table>
		</div><br><br>
		<h5 style="text-align: right;"><strong>Total Price: ₱<?=$total?></strong></h5>
	</div>
</body>
</html>