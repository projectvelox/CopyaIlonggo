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
	        <h4 class="modal-title">Successful Changed</h4>
	      </div>
	      <div class="modal-body">
	        <p>You have successfully changed the item's price!</p>
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
			  <li class="breadcrumb-item active"><span>Edit Product</span></li>
			</ol>
			<div style="margin-left: 15px; margin-right: 15px;">
				<form class="form-horizontal">
		   	 		<div class="form-group">
					    <label class="control-label col-sm-2" for="product">Product:</label>
					    <div class="col-sm-10">
					      	<select class="form-control" required id="product">
							    <option disabled selected>Choose a product</option>
							    <?php
									$con = mysqli_connect("localhost","root","","ci");	
									$result = mysqli_query($con,"SELECT * FROM inventory WHERE type='Inventory' AND status='Active'");
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
					    <label class="control-label col-sm-2" for="cq">Current Price:</label>
					    <div class="col-sm-10">
					      <input type="number" class="form-control" id="cq" disabled value="">
					    </div>
					</div>
					<div class="form-group">
					    <label class="control-label col-sm-2" for="price">New Price:</label>
					    <div class="col-sm-10">
					      <input type="number" class="form-control" id="price" required placeholder="Enter the new price for the selected product">
					    </div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-2" for="image">Image:</label>
						<div class="col-sm-10">
							<input id="file" type="file" name="file" style="margin-top: 7px;"/>
						</div>
					</div>
		   	 	</form>
				<button type="button" class="btn btn-primary pull-right add">Update</button>
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
	function uploadFile(){
	  var input = document.getElementById("file");
	  file = input.files[0];
	  if(file != undefined){
	    formData= new FormData();
	    if(!!file.type.match(/image.*/)){
	      var item = $('select#product').find(':selected').data('product');
	      formData.append("image", file, item + '.jpg');
	      $.ajax({
	        url: "uploads-inventory.php",
	        type: "POST",
	        data: formData,
	        processData: false,
	        contentType: false
	    	}).then(function(data) {
			    alert(data);
	      });
	    } else { alert('Not a valid image!'); }
	  	} else { alert('Input something!'); }
	}

	$(document).ready(function(){
		$('#product').change(function(){
		   var product = $('select#product').find(':selected').data('product');
		   $.ajax({type:"POST",url:"ajax.php",
				data: {
					product:product,
					action: "get_current_price",
				},
			    }).then(function(data) {
			    	 $('#cq').val(data);
			    }); 
		});
	});

	$(document).on("click", ".add", function() { 
		var product = $('select#product').find(':selected').data('product');
		var price = document.getElementById('price').value;
		var cq = document.getElementById('cq').value;
		$.ajax({type:"POST",url:"ajax.php",
			data: {
				product:product,
				price:price,
				cq:cq,
				action:"edit_price"
			},
		    }).then(function(data) {
		    	uploadFile();
	    		$('#success').modal({
		        show: 'true'
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