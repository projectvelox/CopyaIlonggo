<?php
	include('session.php');
	if(!isset($_SESSION['login_user'])){
	  header("location:index.php");
	}

	$con = mysqli_connect("localhost","root","","ci");
	$id = $_REQUEST['id'];

	$ses_sql = mysqli_query($con,"SELECT * FROM inventory where id = '$id'");

	$row = mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);
	$name = $row['equipment_name'];
	$price = $row['price'];
	$description = $row['description'];
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
	<link rel="stylesheet" type="text/css" href="css/carousel.css">
	<link rel="icon" href="img/logo.png" type="image/x-icon" />
</head>
<body>
	<style type="text/css"> .breadcrumb { margin-left: 0px; margin-right: 0px; } .bordify { margin-left: 0px; } </style>
	<!-- Success -->
	<div id="success" class="modal fade" role="dialog">
	  <div class="modal-dialog">
	  	<div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal">&times;</button>
	        <h4 class="modal-title">Success</h4>
	      </div>
	      <div class="modal-body">
	        <p class="text-center">Successfully added item to your cart! You can check your cart <a href="user-cart.php">here</a> or continue choosing items. If unsatisfied with whatever you chose, you can always remove them from your cart later.</p>	      
	      </div>
	      <div class="modal-footer">
	      	<button type="button" class="btn btn-default dude" data-dismiss="modal">Close</button>
	      </div>
	  	</div>
	  </div>
	</div>

	<!-- Success -->
	<div id="successmessage" class="modal fade" role="dialog">
	  <div class="modal-dialog">
	  	<div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal">&times;</button>
	        <h4 class="modal-title">Success</h4>
	      </div>
	      <div class="modal-body">
	        <p class="text-center">Successfully sent your message to Copya Ilonggo! You can check for their reply <a href="service-request.php">here</a></p>	      
	      </div>
	      <div class="modal-footer">
	      	<button type="button" class="btn btn-default dude" data-dismiss="modal">Close</button>
	      </div>
	  	</div>
	  </div>
	</div>

	<div id="servicerequest" class="modal fade" role="dialog">
	  <div class="modal-dialog">
	  	<div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal">&times;</button>
	        <h4 class="modal-title"><span class="glyphicon glyphicon-envelope"></span> Services Request</h4>
	      </div>
	      <div class="modal-body">
	        <form class="form-horizontal">
	        	<div class="form-group">
	        		<label class="control-label col-sm-2" for="message">Message:</label>
				    <div class="col-sm-10">
				    	<input type="hidden" id="user_id" value="<?php echo $user_id ?>"> 
				    	<input type="hidden" id="user" value="<?php echo $login_fullname ?>">
				        <textarea class="form-control" rows="5" id="message"></textarea>
				        <h4><small id="change">Note: This message will be forwarded to Copya Ilonggo. You can check their replies in your dashboard.</small></h4>
				    </div>
	        	</div>
	        </form>      
	      </div>
	      <div class="modal-footer">
	      	<button type="button" class="btn btn-primary sendmessage">Send</button>
	      	<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
	      </div>
	  	</div>
	  </div>
	</div>
	<nav class="navbar navbar-inverse navbar-fixed-top"> 
	  <div class="container">
	    <div class="navbar-header">
	      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
	        <span class="sr-only">Toggle navigation</span>
	        <span class="icon-bar"></span>
	        <span class="icon-bar"></span>
	        <span class="icon-bar"></span>
	      </button>
	      <a class="navbar-brand" href="user-dashboard.php">Copya Ilonggo</a>
	    </div>
	    <div id="navbar"  class="navbar-collapse collapse navbar-right">
	      	<ul class="nav navbar-nav">
		        <li><a href="user-cart.php"><span class="glyphicon glyphicon-shopping-cart"></span> My Cart</a></li>
		        <li class="dropdown">
		          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-user"></span> <?php echo "$login_fullname"?> <span class="caret"></span></a>
		          <ul class="dropdown-menu">
		            <li><a href="user-account-dashboard.php">Dashboard</a></li>
		            <li role="separator" class="divider"></li>
		            <li class="dropdown-header">Account</li>
		            <li><a href="user-account-settings.php">Settings</a></li>
		            <li><a href="logout.php">Logout</a></li>
		          </ul>
		        </li>
	        </ul>
	    </div>
	  </div>
	</nav>
	<div class="container" style="margin-top: 50px; margin-bottom: 20px;">
		<ol class="breadcrumb">
		  <li class="breadcrumb-item"><a href="user-dashboard.php">Home</a></li>
		  <li class="breadcrumb-item"><a href="item-profile.php">Items For Rent</a></li>
		  <li class="breadcrumb-item active"><span><?php echo $row['equipment_name']; ?></span></li>
		</ol>
		<div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
			<div class="user-profile-pic">
				<img src="img/products/<?php echo $row['equipment_name'];?>.jpg" class="img-responsive" onerror="src='img/icons/not-available.jpg'" >
			</div>
			<div class="bordify data-profile-container" style="text-align: left; padding: 10px; border-radius: 0px; margin-top: 10px;">
				<h4>Basic Details:</h4>
				<span><strong>Item: </strong></span><span><?php echo $row['equipment_name']; ?></span><br>
				<span><strong>Price: </strong></span><span>₱ <?php echo $row['price']; ?></span><br>
				<span><strong>Qty: </strong></span><span><?php echo $row['qty']; ?></span><hr>
				<span><strong>Description: </strong></span><span><?php echo $row['description']; ?></span>
				
			</div>
		</div>
		<div class="col-xs-12 col-sm-12 col-md-9 col-lg-9">
			
			<?php 
				$result = mysqli_query($con, "SELECT CONCAT_WS('-', MID(inventory_uid.id, 1,2), MID(inventory_uid.id, 3,4)) AS uid, inventory_uid.* FROM inventory_uid WHERE equipment_id='$id' AND is_avail!='2' AND is_avail!='3' ORDER BY is_avail ASC");
				echo '<h3>'.$name.'</h3>';
				echo '<div class="table-responsive">';
				echo '<table class="table table-striped">';
				echo '<tr>';
				echo '<th>Image</th>';
				echo '<th>Name</th>';
				echo '<th>UID</th>';
				echo '<th>Serial</th>';
				echo '<th>Actions</th>';
				echo '</tr>';
				foreach($result as $rows){
					$combined = $name . " Serial Number " . $rows['uid'];
					echo '<tr>';
					echo '<td><img src="img/serial/'.$rows['uid'].'.jpg" class="img-responsive" onerror="src=\'img/icons/not-available.jpg\'" style="height: 50px;"></td>';
					echo '<td>'.$name.'</td>';
					echo '<td>'.$rows['uid'].'</td>';
					echo '<td>'.$rows['serial'].'</td>';

					// Old Status Query
					// $testquery = mysqli_query($con, "SELECT inventory.id, CONCAT(inventory.equipment_name, ' Serial Number ', CONCAT_WS('-', MID(inventory_uid.id, 1,2), MID(inventory_uid.id, 3,4))) AS name, CONCAT_WS('-', MID(inventory_uid.id, 1,2), MID(inventory_uid.id, 3,4)) AS uid, borrower_cart.status FROM inventory_uid INNER JOIN inventory ON inventory.id = inventory_uid.equipment_id INNER JOIN borrower_cart ON CONCAT(inventory.equipment_name, ' Serial Number ', CONCAT_WS('-', MID(inventory_uid.id, 1,2), MID(inventory_uid.id, 3,4))) = borrower_cart.equipment_name WHERE borrower_cart.status != 'On Hand' AND borrower_cart.equipment_name = '$combined'");
					// $test = mysqli_fetch_assoc($testquery);
					if($rows['is_avail']=='5') {
						echo '<td><span class="label label-danger">Under Maintenance</span></td>';
					} 
					else {
						echo '<td>';
						echo '<a class="btn btn-primary btn-sm check" data-toggle="modal" data-target="#addtorentcart" data-id="'.$name.' UID '.$rows['uid'].'" data-price="'.$price.'" data-description="'.$description.'" data-login="'.$login_fullname.'">Reserve</a>&nbsp';
						echo '<a class="btn btn-primary btn-sm" href="item-profile-uid.php?id='.$rows['uid'].'&itemid='.$id.'&serial='.$rows['serial'].'">Check</a>';
						echo '</td>'; 
					}
					echo '</tr>';
				}
				echo '</table>';
				echo '</div>';
		?>
		</div>
	</div>
	
	<!-- Modal -->
	<div id="addtorentcart" class="modal fade" role="dialog">
	  <div class="modal-dialog">

	    <!-- Modal content-->
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal">&times;</button>
	        <h4 class="modal-title">Add to Cart</h4>
	      </div>
	      <div class="modal-body">
	        <form class="form-horizontal">
	        	<div class="form-group">
	        		<label class="control-label col-sm-2" for="product">Product:</label>
				    <div class="col-sm-10"> 
				      <input type="text" class="form-control" id="product" disabled value="">
				    </div>
	        	</div>
	        	<div class="form-group">
	        		<label class="control-label col-sm-2" for="price">Price:</label>
				    <div class="col-sm-10"> 
				      <input type="text" class="form-control" id="price" disabled value="">
				    </div>
	        	</div>
	        	<div class="form-group">
	        		<label class="control-label col-sm-2" for="description">Description:</label>
				    <div class="col-sm-10"> 
				       <textarea class="form-control" rows="5" id="description" disabled></textarea>
				    </div>
	        	</div>
	        	<div class="form-group">
	        		<label class="control-label col-sm-2" for="datedue">Date Due:</label>
				    <div class="col-sm-10"> 
				      <input type="date" class="form-control" id="datedue">
				      <h4><small id="changerent">This will show up on your cart after confirming.</small></h4>
				    </div>
	        	</div>
				<input type="hidden" class="form-control" id="login">
				<input type="hidden" class="form-control" id="inventory" value="<?php echo $name;?>">
				<input type="hidden" class="form-control" id="address" value="<?php echo $address; ?>">
				<input type="hidden" class="form-control" id="sex" value="<?php echo $sex; ?>">
				<input type="hidden" class="form-control" id="contact" value="<?php echo $contact; ?>">
	        
					
	        </form>
	      </div>
	      <div class="modal-footer">
		    <button type="button" class="btn btn-primary btn-sm save-rent">Add to Cart</button>
	        <button type="button" class="btn btn-danger btn-sm " data-dismiss="modal">Cancel</button>
	      </div>
	    </div>

	  </div>
	</div>

	<script src="js/jquery-3.1.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script type="text/javascript">

		/*function autoupdate(){
			var id = "<?= $id; ?>"; 
			$.ajax({type:"POST",url:"ajax.php",
			data: {
				id:id,
				action:"auto"
			},
		    }).then(function(data) { 
		    	if(data == "1") { location.reload(); } 
		    }); 
		}*/

		$(document).on("click", ".check", function() { 
			var name = $(this).data('id');
			var price = $(this).data('price');
			var login_fullname = $(this).data('login');
			var description = $(this).data('description');
			$(".modal-body #product").val(name);
			$(".modal-body #price").val("₱ " + price);
			$(".modal-body #login").val(login_fullname);
			$(".modal-body #description").val(description);
		});

		$(document).on("click", ".save-rent", function() { 
			var equipment_name = document.getElementById('inventory').value;
			var name = document.getElementById('product').value;
			var prices = document.getElementById('price').value;
			var datedue = document.getElementById('datedue').value;

			var sex = document.getElementById('sex').value;
			var contact = document.getElementById('contact').value;
			var address = document.getElementById('address').value;

			var login_fullname = document.getElementById('login').value;
			var pricesx = prices.replace(/[^0-9,.]/, '');
			
			$.ajax({type:"POST",url:"ajax.php",
			data: {
				equipment_name:equipment_name,
				name:name,
				pricesx:pricesx,
				datedue:datedue,
				sex:sex,
				contact:contact,
				address:address,
				login_fullname:login_fullname,
				action:"specific-rent"
			},
		    }).then(function(data) { 
	    		if(data == "1")	{ 
	    			$('#addtorentcart').modal("hide"); 
	    			$('#success').modal("show"); 
	    		}
	    		else { 
	    			document.getElementById('changerent').innerHTML = "Please don't leave this blank!" 
	    		}
		    }); 
		});


		$(document).on("click", ".sendmessage", function() {
			var user = document.getElementById('user').value;
			var user_id = document.getElementById('user_id').value; 
			var message = document.getElementById('message').value;
			
			//alert(message + " " + user + " " + user_id);
			$.ajax({type:"POST",url:"ajax.php",
			data: {
				user:user,
				user_id:user_id,
				message:message,
				action:"sendmessage"
			},
		    }).then(function(data) {
	    		if(data == "2")	{ $('#servicerequest').modal("hide"); $('#successmessage').modal("show"); }
	    		else { 
	    			document.getElementById('change').innerHTML = "Please don't leave this blank!" 
	    		}
		    }); 
		});

		// After message has been sent, reload the page
		$("#servicerequest").on("hidden.bs.modal", function () { location.reload(); });
	</script>
</body>
</html>



