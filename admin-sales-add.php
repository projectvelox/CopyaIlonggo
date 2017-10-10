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
			  <li class="breadcrumb-item"><a href="admin-dashboard-sales.php">Sales Management</a></li>
			  <li class="breadcrumb-item active"><span>Make a Transaction</span></li>
			</ol>
			<div style="margin-left: 15px; margin-right: 15px;">
				<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6" style="margin-bottom: 15px;">
					<form class="form-horizontal">
		   	 			<div class="form-group">
					    	<label class="control-label col-sm-2" for="name">Name:</label>
					    	<div class="col-sm-10">
					        	<input type="text" class="form-control" id="name" required placeholder="Enter Customer's Name">
					    	</div>
						</div>
						<div class="form-group">
						    <label class="control-label col-sm-2" for="product">Product:</label>
						    <div class="col-sm-10">
						      	<select class="form-control" required id="product">
								    <option disabled selected>Choose a product below</option>
								    <?php
										$con = mysqli_connect("localhost","root","","ci");	
										$result = mysqli_query($con,"SELECT * FROM inventory WHERE type='Inventory' AND type_1='Brand New' AND qty != '0' AND status='Active'");
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
						    <label class="control-label col-sm-2" for="ppi">Price:</label>
						    <div class="col-sm-10">
						      <input type="number" class="form-control" id="ppi" required disabled>
						    </div>
						</div>
						<div class="form-group">
						    <label class="control-label col-sm-2" for="cq">Current Qty:</label>
						    <div class="col-sm-10">
						      <input type="number" class="form-control" id="cq" required disabled>
						    </div>
						</div>
						<div class="form-group">
						    <label class="control-label col-sm-2" for="quantity">Purchase Qty.</label>
						    <div class="col-sm-10">
						      <input type="number" class="form-control" id="quantity" required placeholder="Enter the specified quantity that the customer wants to purchase">
						    </div>
						</div>
						<div class="form-group">
						    <label class="control-label col-sm-2" for="price">Total:</label>
						    <div class="col-sm-10">
						      <input type="varchar" class="form-control" id="price" disabled>
						    </div>
						</div>
		   	 		</form>
		   	 		<button type="button" class="btn btn-primary pull-right add-to" style="margin-left: 3px;">Add To Cart</button>
		   	 		<button type="button" class="btn btn-primary pull-right add">Confirm Cart</button>
		   	 	</div>
		   	 	<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
		   	 		<div id="table_1">
						<div class="table-responsive">
							<table class="table table-striped">
								<tr>
									<th>#</th>
									<th>Item</th>
									<th>Qty</th>
									<th>Price</th>
									<th>Status</th>
								</tr>
								<?php
								$i = 0;
								$con = mysqli_connect("localhost","root","","ci");
								$result = mysqli_query($con,"SELECT * FROM user_cart WHERE status='Unreserved' AND walkin='Yes'");
									while($row = mysqli_fetch_array($result))
									{
										$i++;
										echo "<tr>";
										echo "<td>" . $i . ".</td>";
										echo "<td>" . $row['equipment_name'] . "</td>";
										echo "<td>" . $row['qty'] . "</td>";
										echo "<td>" . $row['price'] . "</td>";
										echo "<td><button class='btn btn-danger btn-sm remove' data-id='".$row['id']."' data-name='".$row['equipment_name']."' data-qty='".$row['qty']."'>Remove</button></td>";
										echo "</tr>";
									}
									mysqli_close($con);
								?>
							</table>
						</div>
						<?php
							$con = mysqli_connect("localhost","root","","ci");
							$result = mysqli_query($con,"SELECT FORMAT(SUM(price), 2) AS price FROM user_cart WHERE status='Unreserved' AND walkin='Yes'");
								while($row = mysqli_fetch_array($result))
								{
									echo "<h4 class='text-right fuck'><strong>Total: ₱ <span class='summarized'>" . $row['price'] . "</span></strong></h4>";
								}
								mysqli_close($con);
							?>
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
		$('#quantity').change(function(){ 
		   var product = $('select#product').find(':selected').data('product');
		   var ppi = document.getElementById('ppi').value;
		   var quantity = document.getElementById('quantity').value;
		   $.ajax({type:"POST",url:"ajax.php",
				data: {
					product:product,
					ppi:ppi,
					quantity: quantity,
					action: "calculate_sales_price",
				},
			    }).then(function(data) {
			    	 $('#price').val(data);
			    });
		});
	});
	
	$(document).on("click", ".add-to", function() { 
		var name = document.getElementById('name').value;
		var product = $('select#product').find(':selected').data('product');
		var ppi = document.getElementById('ppi').value;
		var cq = document.getElementById('cq').value;		
		var quantity = document.getElementById('quantity').value;
		var price = document.getElementById('price').value; 		
		$.ajax({type:"POST",url:"ajax.php",
			data: {
				name:name,
				product:product,
				ppi:ppi,
				cq:cq,
				quantity:quantity,
				price:price,
				action:"add-to-cart"
			},
		    }).then(function(data) {
	    		if(data == "1")
	    		{
	    			$('#fail').modal({
		        	show: 'true'
			    	}); 
	    		}
	    		else {
	    			$("#table_1").load(location.href + " #table_1");
	    			$('#name').prop('disabled', true);
	    		}
		    });   
	});

	$(document).on("click", ".add", function() { 
		var name = document.getElementById('name').value;
		var product = $('select#product').find(':selected').data('product');
		var ppi = document.getElementById('ppi').value;
		var cq = document.getElementById('cq').value;		
		var quantity = document.getElementById('quantity').value;
		var price = document.getElementById('price').value; 
		$.ajax({type:"POST",url:"ajax.php",
			data: {
				name:name,
				product:product,
				ppi:ppi,
				quantity:quantity,
				price:price,
				cq:cq,
				action:"record_transaction"
			},
		    }).then(function(data) {
	    		if(data == "2") {
	    			$('#success').modal('show'); 
	    		}
		    }); 
	});

	$(document).on("click", ".modal-closer", function() { 
		$('#success').modal({ show: 'false' }); 
		location.reload();
	});

	$(document).on("click", ".remove", function() { 
			var id = $(this).data('id');
			var name = $(this).data('name');
			var qty = $(this).data('qty');

			//alert(id + " " + name + " " + qty);
			$.ajax({type:"POST",url:"ajax.php",
			data: {
				id:id,
				name, name,
				qty,qty,
				action:"remove_from_cart"
			},
		    }).then(function(data) {
		    	//alert(data);
		    	location.reload();
		    }); 
		});

	</script>
</body>
</html>