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
	        <h4 class="modal-title">Successful Restocked</h4>
	      </div>
	      <div class="modal-body">
	        <p>You have successfully restocked the item!</p>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-primary modal-closer" data-dismiss="modal">Close</button>
	      </div>
	    </div>

	  </div>
	</div>

	<!-- Modal -->
	<div id="restockModal" class="modal fade" role="dialog">
	  <div class="modal-dialog">

	    <!-- Modal content-->
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal">&times;</button>
	        <h4 class="modal-title">Restock Product</h4>
	      </div>
	      <div class="modal-body">
	        <form class="form-horizontal">
	        	<div class="form-group">
				    <label class="control-label col-sm-3" for="product">Product:</label>
				    <div class="col-sm-9">
				      <input type="text" class="form-control" id="product" required disabled>
				    </div>
				</div>
				<div class="form-group">
				    <label class="control-label col-sm-3" for="cq">Current Quantity:</label>
				    <div class="col-sm-9">
				      <input type="text" class="form-control" id="cq" required disabled>
				    </div>
				</div>
				<div class="form-group">
				    <label class="control-label col-sm-3" for="qty">New Quantity:</label>
				    <div class="col-sm-9">
				      <input type="text" class="form-control" id="qty" required>
				    </div>
				</div>
	        </form>
	      </div>
	      <div class="modal-footer">
	      	<button type="button" class="btn btn-primary updateProduct">Update</button>
	        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
	      </div>
	    </div>

	  </div>
	</div>

	<!-- Content -->
	<div class="container" style="margin-top: 80px;">
		<div class="row">
			<ol class="breadcrumb">
			  <li class="breadcrumb-item"><a href="admin-dashboard.php">Dashboard</a></li>
			  <li class="breadcrumb-item"><a href="admin-dashboard-inventory.php">Inventory Management</a></li>
			  <li class="breadcrumb-item active"><span>Restock Product</span></li>
			</ol>
			<div style="margin-left: 15px; margin-right: 15px;">
				<!--<form class="form-horizontal">
		   	 		<div class="form-group">
					    <label class="control-label col-sm-2" for="product">Product:</label>
					    <div class="col-sm-10">
					      	<select class="form-control" required id="product">
							    <option disabled selected>Choose a product to restock</option>
							    <?php/*
									$con = mysqli_connect("localhost","root","","ci");	
									$result = mysqli_query($con,"SELECT * FROM inventory WHERE type='Inventory'");
										while($row = mysqli_fetch_array($result))
										{
											echo "<option data-id='".$row['id']."' data-product='" . $row['equipment_name'] . "' >" . $row['type_1'] .  ' - ' . $row['equipment_name'] .  "</option>";
										}
										echo "</table>";
										mysqli_close($con);
								*/?>
				  		 	</select>
					    </div>
					</div>
					<div class="form-group">
					    <label class="control-label col-sm-2" for="cq">Current Quantity:</label>
					    <div class="col-sm-10">
					      <input type="number" class="form-control" id="cq" disabled value="">
					    </div>
					</div>
					<div class="form-group">
					    <label class="control-label col-sm-2" for="quantity">Quantity:</label>
					    <div class="col-sm-10">
					      <input type="number" class="form-control" id="quantity" required placeholder="Enter the specified quantity of the said product to restock">
					    </div>
					</div>
		   	 	</form>
				<button type="button" class="btn btn-primary pull-right add">Restock Item in Inventory</button>
				-->
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<div class="row">
					<h2 class="col-xs-12 col-sm-12 col-md-4 col-lg-4">Restock Product</h2>
					<div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
						<form method="POST" action="admin-inventory-restock.php">
						    <div class="input-group add-on">
						      <input class="form-control" placeholder="Search" name="search" type="text">
						      <div class="input-group-btn">
						        <button class="btn btn-default" type="submit" name="searchBtn"><i class="glyphicon glyphicon-search"></i></button>
						      </div>
						    </div>
					    </form>
				    </div>
				</div><br>
				<div class="table-responsive">
					<table class="table table-striped">
						<tr>
							<th>#</th>
							<th>Product</th>
							<th>Current Quantity</th>
							<th>Action</th>
						</tr>
						<?php 
							$searched = '';
						    if (isset($_POST['search'])) { $searched = $_POST['search']; }
							$con = mysqli_connect("localhost","root","","ci");
							$result = mysqli_query($con, "SELECT * FROM inventory WHERE equipment_name LIKE '%".$searched."%' AND (status='Active' AND type='Inventory') ORDER BY type_1, equipment_name ASC");
							$i=0;
							foreach($result as $row)
							{
								$i++;
								echo '<tr>';
								echo '<td>'. $i .'</td>';
								echo '<td>'. $row['type_1'].' - '. $row['equipment_name'] .'</td>';
								echo '<td>'. $row['qty'] .' Items</td>';
								echo '<td><button class="btn btn-xs btn-primary updateQty" data-id="'.$row['id'].'" data-cq="'.$row['qty'].'" data-product="'.$row['equipment_name'].'">Update</button></td>';
								echo '</tr>';
							}
						?>
					</table>
				</div>
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
	$(document).on("click", ".updateQty", function() {
		var id = $(this).data('id');
		var cq = $(this).data('cq');
		var product = $(this).data('product');
		$('#restockModal').modal('show');
		$(".modal-body #product").val(product);
		$(".modal-body #cq").val(cq);

		$(document).on("click", ".updateProduct", function() {
			var qty = document.getElementById('qty').value;
			$.ajax({type:"POST",url:"ajax.php",
			data: {
				id:id,
				product:product,
				qty:qty,
				cq:cq,
				action:"rectock_item"
			},
		    }).then(function(data) { 
		    	//alert(data);
	    		$('#success').modal({
		        show: 'true'
			    });
		    });
		});
	});

	$(document).on("click", ".modal-closer", function() { 
		$('#success').modal({ show: 'false' }); 
		location.reload();
	});

	</script>
</body>
</html>