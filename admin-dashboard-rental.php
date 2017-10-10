<?php 
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
	<!-- Modal -->
	<div id="success" class="modal fade" role="dialog">
	  <div class="modal-dialog">

	    <!-- Modal content-->
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal">&times;</button>
	        <h4 class="modal-title">System Notice</h4>
	      </div>
	      <div class="modal-body">
	      	<table class="table">
	        <?php
	        	$i = 0;
				$con = mysqli_connect("localhost","root","","ci");
				$result = mysqli_query($con,"SELECT * FROM borrower_cart WHERE status='On Hand' AND MONTH(date_due) = MONTH(CURRENT_DATE()) AND YEAR(date_due) = YEAR(CURRENT_DATE()) AND DAY(date_due) = DAY(CURRENT_DATE()) ORDER BY name ASC");
					while($row = mysqli_fetch_array($result))
					{
						$i++;
						echo "<tr>";
						echo "<td style='border-top: 0px;'><strong>" . $i . ".</strong></td>";
						echo "<td style='border-top: 0px;'><strong><u>" . $row['name'] . "</u></strong>'s rental is expiring today. Retrieve the " . $row['qty'] . ", " . $row['equipment_name'] . " at <u>" . $row['address'] ."</u></td>";
						echo "</tr>";
					}
					mysqli_close($con);
			?>
			</table>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-primary modal-closer" data-dismiss="modal">Close</button>
	      </div>
	    </div>

	  </div>
	</div>

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
			  <li class="breadcrumb-item active"><span>Rental Management</span></li>
			</ol>
			<div style="margin-left: 30px; margin-right: 10px;">
				<div class="col-xs-6 col-sm-4 col-md-2 col-lg-2">
					<a href="admin-rental-add.php">
					<div class="bordify">
						<h3><span class="glyphicon glyphicon-pencil"></span></h3>
						<h4>Rental</h4>
					</div></a>
				</div>
				<div class="col-xs-6 col-sm-4 col-md-2 col-lg-2">
					<a href="admin-rental-return.php">
					<div class="bordify">
						<h3><span class="glyphicon glyphicon-edit"></span></h3>
						<h4>Return</h4>
					</div></a>
				</div>
			</div>
		</div>
		<div class="row" style="margin-top: 10px;">
			<ol class="breadcrumb">
			  <li class="breadcrumb-item"><a href="admin-dashboard.php">Dashboard</a></li>
			   <li class="breadcrumb-item active"><span>Rental List</span></li>
			</ol>
			<div style="margin-left: 30px; margin-right: 10px;">
				<div class="col-xs-6 col-sm-4 col-md-2 col-lg-2">
					<a href="admin-rental-unreturned.php">
					<div class="bordify">
						<h3><span class="glyphicon glyphicon-list"></span></h3>
						<h4>Unreturned Items</h4>
					</div></a>
				</div>
				<div class="col-xs-6 col-sm-4 col-md-2 col-lg-2">
					<a href="admin-rental-nearby.php">
					<div class="bordify">
						<h3><span class="glyphicon glyphicon-list"></span></h3>
						<h4>Due this Month</h4>
					</div></a>
				</div>
				<div class="col-xs-6 col-sm-4 col-md-2 col-lg-2">
					<a href="admin-rental-list.php">
					<div class="bordify">
						<h3><span class="glyphicon glyphicon-list"></span></h3>
						<h4>Rental Logs</h4>
					</div></a>
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
	<script type="text/javascript">
		$(document).ready(function(){
			$.ajax({type:"POST",url:"ajax.php",
				data: {
					action: "due_date_reminder",
				},
			    }).then(function(data) {
			    	console.log(data);
			    	if (data == '1') { $('#success').modal({ show: 'true' }); }
				}); 
		});
	</script>
</body>
</html>