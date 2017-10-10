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

	<!-- Content -->
	<div class="container" style="margin-top: 80px;">
		<div class="row">
			<ol class="breadcrumb">
			  <li class="breadcrumb-item"><a href="admin-dashboard.php">Dashboard</a></li>
			  <li class="breadcrumb-item"><a href="admin-dashboard-inventory.php">Inventory Management</a></li>
			  <li class="breadcrumb-item active"><span>Restock Product</span></li>
			</ol>
			<div style="margin-left: 15px; margin-right: 15px;">
				<form class="form-horizontal">
		   	 		<div class="form-group">
					    <label class="control-label col-sm-2" for="product">Product:</label>
					    <div class="col-sm-10">
					      	<select class="form-control" required id="product">
							    <option disabled selected>Choose a product to restock</option>
							    <?php
									$con = mysqli_connect("localhost","root","","ci");	
									$result = mysqli_query($con,"SELECT * FROM inventory WHERE type='Inventory'");
										while($row = mysqli_fetch_array($result))
										{
											echo "<option data-id='".$row['id']."' data-product='" . $row['equipment_name'] . "' >" . $row['type_1'] .  ' - ' . $row['equipment_name'] .  "</option>";
										}
										echo "</table>";
										mysqli_close($con);
								?>
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
		$('#product').change(function(){
		   var product = $('select#product').find(':selected').data('product');
		   $.ajax({type:"POST",url:"ajax.php",
				data: {
					product:product,
					action: "get_current_quantity",
				},
			    }).then(function(data) {
			    	 $('#cq').val(data);
			    }); 
		});
	});

	$(document).on("click", ".add", function() {
		var id = $('select#product').find(':selected').data('id'); 
		var product = $('select#product').find(':selected').data('product');
		var qty = document.getElementById('quantity').value;
		var cq = document.getElementById('cq').value;
		$.ajax({type:"POST",url:"ajax.php",
			data: {
				id:id,
				product:product,
				qty:qty,
				cq:cq,
				action:"rectock_item"
			},
		    }).then(function(data) { 
		    	alert(data);
	    		/*$('#success').modal({
		        show: 'true'
			    }); */
		    }); 
	});

	$(document).on("click", ".modal-closer", function() { 
		$('#success').modal({ show: 'false' }); 
		location.reload();
	});

	</script>
</body>
</html>