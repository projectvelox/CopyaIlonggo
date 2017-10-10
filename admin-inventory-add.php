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
	        <h4 class="modal-title">Successful Creation</h4>
	      </div>
	      <div class="modal-body">
	        <p>You have successfully added the item to the inventory!</p>
	      </div>
	      <div class="modal-footer">
	        <button class="btn btn-primary modal-closer" data-dismiss="modal">Close</button>
	      </div>
	    </div>

	  </div>
	</div>


	<!-- Modal -->
	<div id="testList" class="modal fade" role="dialog">
	  <div class="modal-dialog">

	    <!-- Modal content-->
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal">&times;</button>
	        <h4 class="modal-title" id="header-name"></h4>
	      </div>
	      <div class="modal-body" style="height: auto; max-height: 300px; overflow-y: scroll; overflow-x: hidden;">
	        <form class="form-horizontal wrapper">
	        	
	        </form>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-sm btn-primary savenow">Save Now</button>
	        <a href="item-management.php" class="btn btn-sm btn-primary">View More</a>
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
	        <h4 class="modal-title">Unsuccesful Creation</h4>
	      </div>
	      <div class="modal-body">
	        <p>There is currently an item in the inventory with the same product name. Please try again.</p>
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
			  <li class="breadcrumb-item"><a href="admin-dashboard-inventory.php">Inventory Management</a></li>
			  <li class="breadcrumb-item active"><span>Add Inventory</span></li>
			</ol>
			<div style="margin-left: 15px; margin-right: 15px;">
				<form class="form-horizontal">
		   	 		<div class="form-group">
					    <label class="control-label col-sm-2" for="product">Item:</label>
					    <div class="col-sm-10">
					      <input type="text" class="form-control" id="product" required placeholder="Enter desired item name">
					    </div>
					</div>
					<div class="form-group">
					    <label class="control-label col-sm-2" for="description">Description:</label>
					    <div class="col-sm-10">
					      <textarea class="form-control" rows="3" id="description" placeholder="Enter item description"></textarea>
					    </div>
					</div>
					<div class="form-group">
					    <label class="control-label col-sm-2" for="quantity">Quantity:</label>
					    <div class="col-sm-10">
					      <input type="number" class="form-control" id="quantity" required placeholder="Enter the specified quantity of the said item">
					    </div>
					</div>
					<div class="form-group">
					    <label class="control-label col-sm-2" for="price">Price:</label>
					    <div class="col-sm-10">
					      <input type="number" class="form-control" id="price" required placeholder="Set the price of the item">
					    </div>
					</div>
					<div class="form-group">
					    <label class="control-label col-sm-2" for="type_1">Status:</label>
					    <div class="col-sm-10">
					      	<select class="form-control" required id="type_1">
							    <option disabled selected>Choose an option below</option>
							    <option>Brand New</option>
							    <option>2nd Hand</option>
				  		 	</select>
					    </div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-2" for="image">Image:</label>
						<div class="col-sm-10">
							<input id="file" type="file" name="file" style="margin-top: 7px;"/>
						</div>
					</div>
		   	 	</form>
				<button type="button" class="btn btn-primary pull-right add">Add Item in Inventory</button>
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
		      var item = document.getElementById('product').value;
		      formData.append("image", file, item + '.jpg');
		      $.ajax({
		        url: "uploads-inventory.php",
		        type: "POST",
		        data: formData,
		        processData: false,
		        contentType: false
		    	}).then(function(data) {
				    //alert(data);
		      });
		    } else { alert('Not a valid image!'); }
		  	} else { alert('Input something!'); }
		}

	$(document).on("click", ".add", function() { 
		var product = document.getElementById('product').value;
		var description = document.getElementById('description').value;
		var qty = document.getElementById('quantity').value;
		var price = document.getElementById('price').value;
		var type_1 = document.getElementById('type_1').value;
		$.ajax({type:"POST",url:"ajax.php",
			data: {
				product:product,
				description:description,
				qty:qty,
				price:price,
				type_1:type_1,
				action:"add_inventory_item"
			},
		    }).then(function(data) {
		    	if (data == '2') {
					$('#fail').modal({
			        show: 'true'
				    });
		    	}
		    	else {
		    		String.prototype.insert = function(what, index) { return index > 0 ? this.replace(new RegExp('.{' + index + '}'), '$&' + what) : what + this; };

			    	<?php 
				    	$con = mysqli_connect("localhost","root","","ci");	
						$sql = "SELECT id FROM inventory_uid ORDER BY id DESC LIMIT 1";
						$result = mysqli_query($con,$sql);
						$row=mysqli_fetch_assoc($result);
						$uid=$row['id'];
				    ?>
			    	var i=0;
			    	var uid = <?=$uid?>;
			    	$('#testList').modal({ show: 'true'})
			    	document.getElementById('header-name').innerHTML = "Product: " + product;
				    while(qty>i) {
				    	i++;
				    	uid++;
				    	var field = '<div class="form-group"><label class="control-label col-sm-4"> UID ' + uid.toString().insert("-", 2) +'</label><div class="col-sm-8"><input type="text" class="form-control" id="uid'+i+'" placeholder="Enter the serial number for this."></div></div>';
				    	$('.wrapper').append(field);
				    }

				    $(document).on("click", ".savenow", function() { 
				   		<?php 
					    	$con = mysqli_connect("localhost","root","","ci");	
							$sql = "SELECT id FROM inventory ORDER BY id DESC LIMIT 1";
							$result = mysqli_query($con,$sql);
							$row=mysqli_fetch_assoc($result);
							$id=$row['id'];
					    ?>
				   		var i=0;
				   		var equipment_id = <?=$id?> + 1;
				   		var uid = <?=$uid?>;
				   		while(qty > i) {
				   			i++;
				   			uid++;
				   			var serial = document.getElementById('uid'+i).value;
				   			
				   			$.ajax({type:"POST",url:"ajax.php",
							data: {
								uid:uid,
								serial:serial,
								equipment_id: equipment_id,
								action:"testMultipleSaves"
							},
						    }).then(function(data) {
						    	uploadFile();
						    	$('#testList').modal("hide"); 
					    		$('#success').modal("show"); 
						    }); 
				   		}
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