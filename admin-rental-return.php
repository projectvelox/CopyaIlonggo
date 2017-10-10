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

	<!-- Modal -->
	<div id="success" class="modal fade" role="dialog">
	  <div class="modal-dialog">

	    <!-- Modal content-->
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal">&times;</button>
	        <h4 class="modal-title">Successful Returned Equipments</h4>
	      </div>
	      <div class="modal-body">
	        <p>You have successfully retrieved the equipments!</p>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-primary modal-closer" data-dismiss="modal">Close</button>
	      </div>
	    </div>

	  </div>
	</div>

	<!-- Content -->
	<div class="container" style="margin-top: 80px;">
		<div class="row">
			<ol class="breadcrumb">
			  <li class="breadcrumb-item"><a href="admin-dashboard.php">Dashboard</a></li>
			  <li class="breadcrumb-item"><a href="admin-dashboard-rental.php">Rental Management</a></li>
			  <li class="breadcrumb-item active"><span>Return</span></li>
			</ol>
			<div style="margin-left: 15px; margin-right: 15px;">
			<div class="row">
				<h3 class="col-xs-12 col-sm-12 col-md-4 col-lg-4">Update Rental Status</h3> 
				<div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
					<form method="POST" action="admin-rental-return.php">
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
				<table class="table table-striped">
					<tr>
						<th>#</th>
						<th><a data-toggle="tooltip" data-placement="bottom" title="Order by Borrower's Name" href="admin-rental-return.php?name=name ASC">Borrower's Name</a></th>
						<th><a data-toggle="tooltip" data-placement="bottom" title="Order by Equipment Name" href="admin-rental-return.php?name=equipment_name ASC">Equipment Name</th>
						<th><a data-toggle="tooltip" data-placement="bottom" title="Order by Quantity" href="admin-rental-return.php?name=qty DESC">Quantity</th>
						<th><a data-toggle="tooltip" data-placement="bottom" title="Order by Address" href="admin-rental-return.php?name=address ASC">Address</th>
						<th><a data-toggle="tooltip" data-placement="bottom" title="Order by Contact Number" href="admin-rental-return.php?name=contact DESC">Contact Number</th>
						<th><a data-toggle="tooltip" data-placement="bottom" title="Order by Date Borrowed" href="admin-rental-return.php?name=date_borrowed DESC">Date Borrowed</th>
						<th><a data-toggle="tooltip" data-placement="bottom" title="Order by Date Due" href="admin-rental-return.php?name=date_due ASC">Date Due</th>
						<th>Action</th>
					</tr>
					<?php
						$i = 0;
						$searched = '';
					    if (isset($_POST['search'])) { $searched = $_POST['search']; }
						$x = $_GET['name'];
						if($x=='') { $x='id DESC';}
						$con = mysqli_connect("localhost","root","","ci");
						$result = mysqli_query($con,"SELECT * FROM borrower_cart WHERE (name LIKE '%".$searched."%' OR equipment_name LIKE '%".$searched."%' OR qty LIKE '%".$searched."%' OR address LIKE '%".$searched."%' OR contact LIKE '%".$searched."%') AND status='On Hand'  ORDER BY ".mysqli_real_escape_string($con, $x)."");
							while($row = mysqli_fetch_array($result))
							{
								$i++;
								$date_borrowed = date('M j Y', strtotime($row['date_borrowed']));
								$date_due = date('M j Y', strtotime($row['date_due']));
								$status = $row['status'];
								if($status=="On Hand") { $status = "<button class='btn btn-xs btn-success zero-radius'>Return</button>"; }
								echo "<tr>";
								echo "<td>" . $i . ".</td>";
								echo "<td>" . $row['name'] . "</td>";
								echo "<td>" . $row['equipment_name'] . "</td>";
								echo "<td>" . $row['qty'] . "</td>";
								echo "<td>" . $row['address'] . "</td>";
								echo "<td>" . $row['contact'] . "</td>";
								echo "<td>" . $date_borrowed . "</td>";
								echo "<td>" . $date_due . "</td>";
								echo "<td class='update-status' data-quantity='".$row['qty']."' data-name='".$row['equipment_name']."' data-id='".$row['id']."'>" . $status . "</td>";
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
	<script type="text/javascript">
		$(document).on("click", ".update-status", function() { 
			var name = $(this).data('name');
			var quantity = $(this).data('quantity');
			var id = $(this).data('id');

			 $.ajax({type:"POST",url:"ajax.php",
				data: {
					name:name,
					quantity:quantity,
					id:id,
					action:"return_rental"
				},
			    }).then(function(data) {
			    	//alert(data);
			    	$('#success').modal({
			        show: 'true'
				    });
			    }); 
		});

		$(document).on("click", ".modal-closer", function() { 
			$('#success').modal({
	        show: 'false'
		    }); 
			location.reload();
		});
	</script>
</body>
</html>