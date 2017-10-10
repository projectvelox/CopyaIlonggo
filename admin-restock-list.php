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
			   <li class="breadcrumb-item"><a href="admin-dashboard-inventory.php">Inventory List</a></li>
			   <li class="breadcrumb-item active"><span>Restock Logs</span></li>
			</ol>
			<div style="margin-left: 15px; margin-right: 15px;">
			<div class="row">
				<h3 class="col-xs-12 col-sm-12 col-md-4 col-lg-4">Restock Logs</h3> 
				<div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
					<form method="POST" action="admin-restock-list.php">
					    <div class="input-group add-on">
					      <input class="form-control" placeholder="Search" name="search" type="text">
					      <div class="input-group-btn">
					        <button class="btn btn-default" type="submit" name="searchBtn"><i class="glyphicon glyphicon-search"></i></button>
					      </div>
					    </div>
				    </form>
				</div>
			</div>
			<div class="table-responsive">
				<table class="table table-hover">
					<tr>
						<th>#</th>
						<th><a data-toggle="tooltip" data-placement="bottom" title="Order by Equipment Name" href="admin-restock-list.php?name=equipment_name ASC">Equipment Name</a></th>
						<th><a data-toggle="tooltip" data-placement="bottom" title="Order by Quantity Before New Stocks" href="admin-restock-list.php?name=cq DESC">Quantity Before New Stocks</a></th>
						<th><a data-toggle="tooltip" data-placement="bottom" title="Order by New Stocks" href="admin-restock-list.php?name=qty DESC">New Stocks</a></th>
						<th><a data-toggle="tooltip" data-placement="bottom" title="Order by New Stocks" href="admin-restock-list.php?name=qty DESC">Total Stocks</a></th>
						<th><a data-toggle="tooltip" data-placement="bottom" title="Order by Date Restocked" href="admin-restock-list.php?name=date_restocked DESC">Date Restocked</a></th>
					</tr>
					<?php
						$i = 0;
						$searched = '';
					    if (isset($_POST['search'])) { $searched = $_POST['search']; }
						$x = $_GET['name'];
					  	if($x=='') { $x='id DESC';}
						$con = mysqli_connect("localhost","root","","ci");
						$result = mysqli_query($con,"SELECT FORMAT(cq,0) AS cq_1, FORMAT(qty, 0) AS qty_1,restock_logs.* FROM restock_logs WHERE equipment_name LIKE '%".$searched."%' ORDER BY ".mysqli_real_escape_string($con, $x)."");
							while($row = mysqli_fetch_array($result))
							{
								$total = $row['cq_1']  + $row['qty_1'];
								$i++;
								$date_restocked = date('M j Y g:i A', strtotime($row['date_restocked']));
								echo "<tr>";
								echo "<td>" . $i . ".</td>";
								echo "<td>" . $row['equipment_name'] . " </td>";
								echo "<td>" . $row['cq_1'] . " Items</td>";
								echo "<td>" . $row['qty_1'] . " Items</td>";
								echo "<td>" . $total . " Items</td>";
								echo "<td>" . $date_restocked  . "</td>";
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