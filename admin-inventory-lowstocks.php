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
			   <li class="breadcrumb-item active"><span>Low Stocks</span></li>
			</ol>
			<div style="margin-left: 15px; margin-right: 15px;">
				<div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">	
					<div class="table-responsive">
						<table class="table table-hover">
					<tr>
						<th>#</th>
						<th><a data-toggle="tooltip" data-placement="bottom" title="Order by Equipment Name" href="admin-inventory-lowstocks.php?name=equipment_name ASC">Equipment Name</th>
						<th><a data-toggle="tooltip" data-placement="bottom" title="Order by Quantity" href="admin-inventory-lowstocks.php?name=qty DESC">Quantity</th>
						<th><a data-toggle="tooltip" data-placement="bottom" title="Order by Buying Price" href="admin-inventory-lowstocks.php?name=price DESC">Price</th>
						<th><a data-toggle="tooltip" data-placement="bottom" title="Order by Buying Price" href="admin-inventory-lowstocks.php?name=id DESC">Status</th>
					</tr>
					<?php
						$i = 0;
						$x = $_GET['name'];
					  	if($x=='') { $x='id DESC';}
						$con = mysqli_connect("localhost","root","","ci");
						$result = mysqli_query($con,"SELECT FORMAT(qty,0) as qty_1, FORMAT(price,2) as price_1,inventory.* FROM inventory WHERE type='Inventory' AND  qty < 5 ORDER BY ".mysqli_real_escape_string($con, $x)."");
							while($row = mysqli_fetch_array($result))
							{
								$i++;
								echo "<tr>";
								echo "<td>" . $i . ".</td>";
								echo "<td>" . $row['equipment_name'] . " </td>";
								echo "<td>" . $row['qty_1'] . " Left</td>";
								echo "<td>₱ " . $row['price_1'] . "</td>";
								echo "<td><button class='btn btn-sm btn-success restock' data-toggle='modal' data-target='#restock' data-id='".$row['equipment_name']."' data-cq='".$row['qty']."'>Restock</button></td>";
								echo "</tr>";
							}
							echo "</table>";
							mysqli_close($con);
					?>
						</table>
					</div>
				</div>
				<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
					<h4>Low Stocks</h4>
					<h5><small>Please take not that these are the items in the inventory with quantity of 5 and below. Please restock these items soon if you want to keep people buying or renting products from your shop.</small></h5>
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

	<div id="restock" class="modal fade" role="dialog">
	  <div class="modal-dialog">
	    <!-- Modal content-->
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal">&times;</button>
	        <h4 class="modal-title"><span class="glyphicon glyphicon-plus"></span> Restock Item</h4>
	      </div>
	      <div class="modal-body">
		        <form class="form-horizontal">
		        	<input type="hidden" id="cq">
		        	<div class="form-group">
						<label class="control-label col-sm-2" for="nameofproduct">Name:</label>
						<div class="col-sm-10"> 
							<input type="text" required class="form-control" id="nameofproduct" disabled value="">
						</div>
					</div>
			        <div class="form-group">
						<label class="control-label col-sm-2" for="restockqty">Qty:</label>
						<div class="col-sm-10"> 
							<input type="number" required class="form-control" id="restockqty" placeholder="Enter the amount you want to restock">
						</div>
					</div>
		        </form>
		      </div>
		      <div class="modal-footer">
		        <input type="button" id="restock_item" class="btn btn-default" value="Add"/>
	        </form>
	      </div>
	    </div>
	  </div>
	</div>

	<!-- Success Modal -->
	<div id="success" class="modal fade" role="dialog">
	  <div class="modal-dialog">
	    <!-- Modal content-->
	    <div class="modal-content">
	      	<div class="modal-header">
	        	<button type="button" class="close" data-dismiss="modal">&times;</button>
	        	<h4 class="modal-title"><span class="glyphicon glyphicon-ok"></span> Successful!</h4>
	        </div>
	        <div class="modal-body">
		       	<p>Successfully restocked the item</p>
		    </div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default pleaseclose" data-dismiss="modal">Close</button>
			</div>
	    </div>
	  </div>
	</div>

	<script type="text/javascript" src="js/jquery-3.1.1.min.js"></script>
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
	<script type="text/javascript">

		$(document).on("click", ".restock", function() { 
			var id = $(this).data('id');
			$(".modal-body #nameofproduct").val(id);
			var cq = $(this).data('cq');
			$(".modal-body #cq").val(cq);
		});

		$(document).on("click", "#restock_item", function() { 
			var product = document.getElementById('nameofproduct').value;
			var qty = document.getElementById('restockqty').value;
			var cq = document.getElementById('cq').value;
			$.ajax({type:"POST",url:"ajax.php",
			data: {
				product:product,
				qty:qty,
				cq:cq,
				action:"rectock_item"
			},
		    }).then(function(data) {
		    	$('#restock').modal('hide'); 
	    		$('#success').modal('show'); 
		    }); 
		});

		$(document).on("click", ".pleaseclose", function() { 
			location.reload();
		});

	</script>
</body>
</html>