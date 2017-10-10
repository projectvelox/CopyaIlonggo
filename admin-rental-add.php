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
	        <h4 class="modal-title">Successful Record</h4>
	      </div>
	      <div class="modal-body">
	        <p>The transaction was successfully recorded</p>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-primary modal-closer" data-dismiss="modal">Close</button>
	      </div>
	    </div>

	  </div>
	</div>

	<!-- Modal -->
	<div id="fail" class="modal fade" role="dialog">
	  <div class="modal-dialog">

	    <!-- Modal content-->
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal">&times;</button>
	        <h4 class="modal-title">Unsuccesful Transaction</h4>
	      </div>
	      <div class="modal-body">
	        <p>You have missed filling up some fields or you incorrectly filled up a field. Please finish filling up the form</p>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
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
			  <li class="breadcrumb-item active"><span>Rental</span></li>
			</ol>
			<div style="margin-left: 15px; margin-right: 15px;">
				<form class="form-horizontal">
		   	 		<div class="form-group">
					    <label class="control-label col-sm-2" for="name">Customer Name:</label>
					    <div class="col-sm-10">
					      <input type="text" class="form-control" id="name" required placeholder="Enter Customer's Name">
					    </div>
					</div>
					<div class="form-group">
					    <label class="control-label col-sm-2" for="address">Address:</label>
					    <div class="col-sm-10">
					      <textarea class="form-control" id="address" placeholder="Enter Customer's Address" style="resize: none;"></textarea>
					    </div>
					</div>
					<div class="form-group">
					    <label class="control-label col-sm-2" for="contact">Contact Number:</label>
					    <div class="col-sm-10">
					      <input class="form-control" id="contact" placeholder="Enter Customer's Contact Number" required>
					    </div>
					</div>
					<div class="form-group">
					    <label class="control-label col-sm-2" for="product">Product:</label>
					    <div class="col-sm-10">
					      	<select class="form-control" required id="product">
							    <option disabled selected>Choose a product below</option>
							    <?php
									$con = mysqli_connect("localhost","root","","ci");	
									$result = mysqli_query($con,"SELECT * FROM inventory WHERE type='Inventory' AND type_1='2nd Hand' AND qty != '0' AND status='Active'");
										while($row = mysqli_fetch_array($result))
										{
											echo "<option data-product='" . $row['equipment_name'] . "' >" . $row['equipment_name'] .  "</option>";
										}
										echo "</table>";
										mysqli_close($con);
								?>
				  		 	</select>
					    </div>
					</div>
					<div class="form-group">
					    <label class="control-label col-sm-2" for="ppi">Price Per Item:</label>
					    <div class="col-sm-10">
					      <input type="number" class="form-control" id="ppi" required disabled>
					    </div>
					</div>
					<div class="form-group">
					    <label class="control-label col-sm-2" for="cq">Current Quantity:</label>
					    <div class="col-sm-10">
					      <input type="number" class="form-control" id="cq" required disabled>
					    </div>
					</div>
					<div class="form-group">
					    <label class="control-label col-sm-2" for="quantity">Quantity to Rent:</label>
					    <div class="col-sm-10">
					      <input type="number" class="form-control" id="quantity" required placeholder="Enter the specified quantity that the customer wants to rent">
					    </div>
					</div>
					<div class="form-group">
					    <label class="control-label col-sm-2" for="due">Date Due:</label>
					    <div class="col-sm-10">
					      <input type="date" class="form-control" id="due" required>
					    </div>
					</div>
					<div class="form-group">
					    <label class="control-label col-sm-2" for="price">Total Price:</label>
					    <div class="col-sm-10">
					      <input type="varchar" class="form-control" id="price" disabled>
					    </div>
					</div>
		   	 	</form>
				<button type="button" class="btn btn-primary pull-right add">Record Transaction</button>
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
					action: "equipment_price",
				},
			    }).then(function(data) {
			    	 $('#ppi').val(data);
			    });

			$.ajax({type:"POST",url:"ajax.php",
				data: {
					product:product,
					action: "get_current_quantity",
				},
			    }).then(function(data) {
			    	 $('#cq').val(data);
			    });
		});
		$('#due').change(function(){ 
		   var product = $('select#product').find(':selected').data('product');
		   var due = document.getElementById('due').value;
		   var ppi = document.getElementById('ppi').value;
		   var quantity = document.getElementById('quantity').value;
		   $.ajax({type:"POST",url:"ajax.php",
				data: {
					product:product,
					due:due,
					ppi:ppi,
					quantity: quantity,
					action: "calculate_price",
				},
			    }).then(function(data) {
			    	 $('#price').val(data);
			    });
		});
	});

	$(document).on("click", ".add", function() { 
		var name = document.getElementById('name').value;
		var address = document.getElementById('address').value;
		var contact = document.getElementById('contact').value;
		var product = $('select#product').find(':selected').data('product');
		var ppi = document.getElementById('ppi').value;
		var quantity = document.getElementById('quantity').value;
		var due = document.getElementById('due').value;
		var price = document.getElementById('price').value; 
		var cq = document.getElementById('cq').value;
		$.ajax({type:"POST",url:"ajax.php",
			data: {
				name:name,
				address:address,
				contact:contact,
				product:product,
				ppi:ppi,
				quantity:quantity,
				due:due,
				price:price,
				cq:cq,
				action:"add_rental"
			},
		    }).then(function(data) {
	    		if(data == "1")
	    		{
	    			$('#fail').modal({
		        	show: 'true'
			    	}); 
	    		}
	    		else {
	    			$('#success').modal({
		        	show: 'true'
			    	}); 
	    		}
		    });  
	});

	$(document).on("click", ".modal-closer", function() { 
		$('#success').modal({ show: 'false' }); 
		location.reload();
	});

	</script>
</body>
</html>