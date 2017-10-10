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
			   <li class="breadcrumb-item active"><span>For Rent</span></li>
			</ol>
			<div style="margin-left: 15px; margin-right: 15px;">
			<div class="row">
				<h3 class="col-xs-12 col-sm-12 col-md-4 col-lg-4">Equipments For Rent</h3>
				<div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
					<form method="POST" action="admin-inventory-rent.php">
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
						<th><a data-toggle="tooltip" data-placement="bottom" title="Order by Item" href="admin-inventory-rent.php?name=equipment_name ASC">Item</th>
						<th><a data-toggle="tooltip" data-placement="bottom" title="Order by Description" href="admin-inventory-sale.php?name=description ASC">Description</th>
						<th><a data-toggle="tooltip" data-placement="bottom" title="Order by Quantity" href="admin-inventory-rent.php?name=qty DESC">Qty.</th>
						<th><a data-toggle="tooltip" data-placement="bottom" title="Order by Buying Price" href="admin-inventory-rent.php?name=price DESC">Price / Month</th>
						<th><a data-toggle="tooltip" data-placement="bottom" title="Order by Status" href="admin-inventory-rent.php?name=status DESC">Status</th>
					</tr>
					<?php
						$i=0;
						$searched = '';
					    if (isset($_POST['search'])) {
					        $searched = $_POST['search'];
					    } 
						$x = $_GET['name'];
					  	if($x=='') { $x='id DESC';}
						$con = mysqli_connect("localhost","root","","ci");
						$result = mysqli_query($con,"SELECT FORMAT(qty, 0) AS qty_1, FORMAT(price, 0) AS price_1, inventory.* FROM inventory WHERE equipment_name LIKE '%".$searched."%' AND (type='Inventory' AND type_1='2nd Hand') ORDER BY ".mysqli_real_escape_string($con, $x)."");
							while($row = mysqli_fetch_array($result))
							{
								$i++;
								$status = $row['status'];
								echo "<tr>";
								echo "<td>" . $i . ".</td>";
								echo "<td>" . $row['equipment_name'] . " </td>";
								echo "<td style='width: 60%;'>" . $row['description'] . " </td>";
								echo "<td>" . $row['qty_1'] . " Left</td>";
								echo "<td>₱ " . $row['price_1'] . "</td>";
								if($status=="Active") { $status = "<td><button class='disable btn btn-danger btn-sm zero-radius' data-id='".$row['id']."'>Disable</button></td>"; echo $status;}
								if($status=="Disabled") { $status = "<td><button class='enable btn btn-sm btn-success zero-radius' data-id='".$row['id']."'>Enable</button></td>"; echo $status;}
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

	<!-- Modal -->
	<div id="success" class="modal fade" role="dialog">
	  <div class="modal-dialog">

	    <!-- Modal content-->
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal">&times;</button>
	        <h4 class="modal-title">Successful</h4>
	      </div>
	      <div class="modal-body">
	        <p>You have successfully performed the operation</p>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-primary modal-closer" data-dismiss="modal">Close</button>
	      </div>
	    </div>

	  </div>
	</div>
	
	<script type="text/javascript" src="js/jquery-3.1.1.min.js"></script>
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
	<script type="text/javascript">
		$(document).on("click", ".enable", function() { 
			var id = $(this).data('id');
			$.ajax({type:"POST",url:"ajax.php",
				data: {
					id:id,
					action:"enable_sales_inventory"
				},
			    }).then(function(data) {
			    	$('#success').modal('show');  
			    });
		});

		$(document).on("click", ".disable", function() { 
			var id = $(this).data('id');
			$.ajax({type:"POST",url:"ajax.php",
				data: {
					id:id,
					action:"disable_sales_inventory"
				},
			    }).then(function(data) {
			    	$('#success').modal('show'); 
			    });
		});

		$(document).on("click", ".modal-closer", function() { 
			$('#success').modal('hide'); 
			location.reload();
		});
	</script>
</body>
</html>