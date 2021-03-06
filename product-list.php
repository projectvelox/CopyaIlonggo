<?php 
	include('session.php');
	if(!isset($_SESSION['login_user'])){
	  header("location:index.php");
	}

	$x = $_GET['name']; 
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
	<style type="text/css">.breadcrumb { margin-left: 0px; margin-right: 0px; } </style>
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

	<!-- Fail -->
	<div id="fail" class="modal fade" role="dialog">
	  <div class="modal-dialog">
	  	<div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal">&times;</button>
	        <h4 class="modal-title">Unsuccessful</h4>
	      </div>
	      <div class="modal-body">
	        <p>Please make sure that you filled up the purchase field and made sure its quantity is not more than the remaining stocks.</p>	      
	      </div>
	      <div class="modal-footer">
	      	<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	      </div>
	  	</div>
	  </div>
	</div>

	<!-- Modal -->
	<div id="addtocart" class="modal fade" role="dialog">
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
	        		<label class="control-label col-sm-2" for="qty">Stock:</label>
				    <div class="col-sm-10"> 
				      <input type="text" class="form-control" id="qty" disabled value="">
				    </div>
	        	</div>
	        	<div class="form-group">
	        		<label class="control-label col-sm-2" for="description">Description:</label>
				    <div class="col-sm-10"> 
				       <textarea class="form-control" rows="5" id="description" disabled></textarea>
				    </div>
	        	</div>
	        	<div class="form-group">
	        		<label class="control-label col-sm-2" for="purchase">Purchase:</label>
				    <div class="col-sm-10"> 
				      <input type="number" class="form-control" id="purchase" placeholder="Enter the quantity that you want to purchase">
				    </div>
	        	</div>
	        	<div class="form-group">
				      <input type="hidden" class="form-control" id="login">
	        	</div>
				<p class="text-center">Please make sure that you filled up the purchase field and made sure its quantity is not more than the remaining stocks.</p>	      
	        </form>
	      </div>
	      <div class="modal-footer">
		    <button type="button" class="btn btn-primary yes">Yes</button>
	        <button type="button" class="btn btn-primary no">No</button>
	      </div>
	    </div>

	  </div>
	</div>

	<!-- Modal -->
	<div id="readmore" class="modal fade" role="dialog">
	  <div class="modal-dialog">

	    <!-- Modal content-->
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal">&times;</button>
	        <h4 class="modal-title" id="item_name"></h4>
	      </div>
	      <div class="modal-body">
	        <form class="form-horizontal">
	        	<div class="form-group">
	        		<label class="control-label col-sm-2" for="products">Product:</label>
				    <div class="col-sm-10"> 
				      <input type="text" class="form-control" id="products" disabled value="">
				    </div>
	        	</div>
	        	<div class="form-group">
	        		<label class="control-label col-sm-2" for="prices">Price:</label>
				    <div class="col-sm-10"> 
				      <input type="text" class="form-control" id="prices" disabled value="">
				    </div>
	        	</div>
	        	<div class="form-group">
	        		<label class="control-label col-sm-2" for="qtys">Stock:</label>
				    <div class="col-sm-10"> 
				      <input type="text" class="form-control" id="qtys" disabled value="">
				    </div>
	        	</div>
	        	<div class="form-group">
	        		<label class="control-label col-sm-2" for="descriptions">Description:</label>
				    <div class="col-sm-10"> 
				       <textarea class="form-control" rows="5" id="descriptions" disabled></textarea>
				    </div>
	        	</div>   
	        </form>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-primary no">Close</button>
	      </div>
	    </div>

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
	        		<label class="control-label col-sm-2" for="product1">Product:</label>
				    <div class="col-sm-10"> 
				      <input type="text" class="form-control" id="product1" disabled value="">
				    </div>
	        	</div>
	        	<div class="form-group">
	        		<label class="control-label col-sm-2" for="price1">Price:</label>
				    <div class="col-sm-10"> 
				      <input type="text" class="form-control" id="price1" disabled value="">
				    </div>
	        	</div>
	        	<div class="form-group">
	        		<label class="control-label col-sm-2" for="qty1">Stock:</label>
				    <div class="col-sm-10"> 
				      <input type="text" class="form-control" id="qty1" disabled value="">
				    </div>
	        	</div>
	        	<div class="form-group">
	        		<label class="control-label col-sm-2" for="description1">Description:</label>
				    <div class="col-sm-10"> 
				       <textarea class="form-control" rows="5" id="description1" disabled></textarea>
				    </div>
	        	</div>
	        	<div class="form-group">
	        		<label class="control-label col-sm-2" for="purchase1">Purchase:</label>
				    <div class="col-sm-10"> 
				      <input type="number" class="form-control" id="purchase1" placeholder="Enter the quantity that you want to purchase">
				    </div>
	        	</div>
	        	<div class="form-group">
	        		<label class="control-label col-sm-2" for="datedue">Date Due:</label>
				    <div class="col-sm-10"> 
				      <input type="date" class="form-control" id="datedue">
				    </div>
	        	</div>
	        	<div class="form-group">
				      <input type="hidden" class="form-control" id="login1">
	        	</div>
	        
				<input type="hidden" class="form-control" id="address" value="<?php echo $address; ?>">
				<input type="hidden" class="form-control" id="sex" value="<?php echo $sex; ?>">
				<input type="hidden" class="form-control" id="contact" value="<?php echo $contact; ?>">
	        
				<p class="text-center">Please make sure that you filled up the purchase field and made sure its quantity is not more than the remaining stocks.</p>	      
	        </form>
	      </div>
	      <div class="modal-footer">
		    <button type="button" class="btn btn-primary save-rent">Yes</button>
	        <button type="button" class="btn btn-primary no">No</button>
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
	<div class="container cswd-container" style="margin-top: 50px !important;">
		<ol class="breadcrumb">
		  <li class="breadcrumb-item"><a href="user-dashboard.php">Home</a></li>
		  <li class="breadcrumb-item active"><span><?php 
				if($x == 'Brand New') { echo "Items for Sale";}
				if($x == '2nd Hand') { echo "Items for Rent";}
			?></span></li>
		</ol>

		<div class="row text-center" style="border: 1px solid #ddd; padding: 20px; margin-left: 0px; margin-right: 0px; margin-top: 0px;">
			<h2 id="ci-header">
				<?php 
					if($x == 'Brand New') { echo "Items for Sale";}
					if($x == '2nd Hand') { echo "Items for Rent";}
				?>
			</h2>
			<?php
			if($x == '2nd Hand'){
				$con = mysqli_connect("localhost","root","","ci");
				$result = mysqli_query($con,"SELECT * FROM Inventory WHERE type_1='$x' AND status='Active' AND type='Inventory' ORDER BY equipment_name AND qty!='0' ASC");
					while($row = mysqli_fetch_array($result))
					{
						echo "<div class='col-xs-12 col-sm-6 col-md-3 col-lg-3'>";
						echo "<div class='panel panel-default cswd-panel' id='ci-photocopier' style='height: 190px; padding-top: 10px;'>";
						echo "<div class='panel-body'>";
						echo "<img src='img/img-1.jpg' height='40'>";
						echo "<h4>" . $row['equipment_name'] . "</h4>";
						echo "<h5><small>Renting Price: " . $row['price'] . " Peso / Per Month</small></h5>";
						echo '<button class="btn btn-primary btn-sm rent" data-id="'.$row['equipment_name'].'"  data-price="'.$row['price'].'" data-qty="'.$row['qty'].'" data-description="'.$row['description'].'" data-login="'.$login_fullname.'"  data-toggle="modal" data-target="#addtorentcart">Reserve</button>&nbsp<button class="btn btn-primary btn-sm read" data-id="'.$row['equipment_name'].'"  data-price="'.$row['price'].'" data-qty="'.$row['qty'].'" data-description="'.$row['description'].'" data-login="'.$login_fullname.'"  data-toggle="modal" data-target="#readmore">Read More</button>';
						echo "</div>";
						echo "</div>";
						echo "</div>";
					}
			}
			if($x == 'Brand New'){
				$con = mysqli_connect("localhost","root","","ci");
				$result = mysqli_query($con,"SELECT * FROM Inventory WHERE type_1='$x' AND status='Active' AND type='Inventory' AND qty!='0' ORDER BY equipment_name ASC");
					while($row = mysqli_fetch_array($result))
					{
						echo "<div class='col-xs-12 col-sm-6 col-md-3 col-lg-3'>";
						echo "<div class='panel panel-default cswd-panel' id='ci-photocopier' style='height: 190px; padding-top: 10px;'>";
						echo "<div class='panel-body'>";
						echo "<img src='img/img-1.jpg' height='40'>";
						echo "<h4>" . $row['equipment_name'] . "</h4>";
						echo "<h5><small>Renting Price: " . $row['price'] . " Peso / Per Item</small></h5>";
						echo '<button class="btn btn-primary btn-sm sell" data-id="'.$row['equipment_name'].'"  data-price="'.$row['price'].'" data-qty="'.$row['qty'].'" data-description="'.$row['description'].'" data-login="'.$login_fullname.'"  data-toggle="modal" data-target="#addtocart">Reserve</button>&nbsp<button class="btn btn-primary btn-sm read" data-id="'.$row['equipment_name'].'"  data-price="'.$row['price'].'" data-qty="'.$row['qty'].'" data-description="'.$row['description'].'" data-login="'.$login_fullname.'"  data-toggle="modal" data-target="#readmore">Read More</button>';
						echo "</div>";
						echo "</div>";
						echo "</div>";
					}
			}
			?>	
		</div>
	</div>
	<footer>
	    <div class="footer-bottom">
	        <div class="container">
	        	<div class="row">
	        		<div class="col-xs-12 col-md-6 col-lg-6">
	        			<p class="text-center"> Copyright © Copya Ilonggo. All right reserved. </p>
	        		</div>
	        		<div class="col-xs-12 col-md-6 col-lg-6">
	        			<p><span class="glyphicon glyphicon-phone"></span> +63 929 688 7257 &nbsp <span class="glyphicon glyphicon-envelope"></span> <a href="mailto:copyailonggo@gmail.com?subject=Feedback">copyailonggo@gmail.com</a> &nbsp <span class="	glyphicon glyphicon-globe"></span> https://wwww.copyailonggo.com </p>
	        		</div>
	        	</div>
	        </div>
	    </div>
	</footer>
	<script src="js/jquery-3.1.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script type="text/javascript">
		$(document).ready( function() {
		    $('#myCarousel').carousel({
		        interval:   2000
			});
		});

		$(document).on("click", ".sell", function() { 
			var name = $(this).data('id');
			var price = $(this).data('price');
			var qty = $(this).data('qty');
			var login_fullname = $(this).data('login');
			var description = $(this).data('description');
			$(".modal-body #product").val(name);
			$(".modal-body #price").val("₱ " + price);
			$(".modal-body #qty").val(qty + " Items Left");
			$(".modal-body #login").val(login_fullname);
			$(".modal-body #description").val(description);
		});

		$(document).on("click", ".rent", function() { 
			var name = $(this).data('id');
			var price = $(this).data('price');
			var qty = $(this).data('qty');
			var login_fullname = $(this).data('login');
			var description = $(this).data('description');
			$(".modal-body #product1").val(name);
			$(".modal-body #price1").val("₱ " + price);
			$(".modal-body #qty1").val(qty + " Items Left");
			$(".modal-body #login1").val(login_fullname);
			$(".modal-body #description1").val(description);
		});

		$(document).on("click", ".read", function() { 
			var name = $(this).data('id');
			var price = $(this).data('price');
			var qty = $(this).data('qty');
			var login_fullname = $(this).data('login');
			var description = $(this).data('description');
			document.getElementById('item_name').innerHTML = "<span class='glyphicon glyphicon-star'></span> " + name;
			$(".modal-body #products").val(name);
			$(".modal-body #prices").val("₱ " + price);
			$(".modal-body #qtys").val(qty + " Items Left");
			$(".modal-body #logins").val(login_fullname);
			$(".modal-body #descriptions").val(description);
		});

		$(document).on("click", ".yes", function() { 
			var name = document.getElementById('product').value;
			var price = document.getElementById('price').value;
			var qty = document.getElementById('qty').value;
			var purchase = document.getElementById('purchase').value;
			var login_fullname = document.getElementById('login').value;
			var prices = price.replace(/[^0-9,.]/, '');
			var qtys = qty.replace(/\D+/g, '');
			
			$.ajax({type:"POST",url:"ajax.php",
			data: {
				name:name,
				prices:prices,
				qtys:qtys,
				purchase:purchase,
				login_fullname:login_fullname,
				action:"user_cart"
			},
		    }).then(function(data) {
		    	//alert(data);
	    		if(data == "1")	{ $('#addtocart').modal("hide"); $('#success').modal("show"); }
	    		else { $('#addtocart').modal("hide"); $('#fail').modal("show"); }
		    }); 
		});

		$(document).on("click", ".save-rent", function() { 
			var name = document.getElementById('product1').value;
			var prices = document.getElementById('price1').value;
			var qty = document.getElementById('qty1').value;
			var purchase = document.getElementById('purchase1').value;
			var datedue = document.getElementById('datedue').value;

			var sex = document.getElementById('sex').value;
			var contact = document.getElementById('contact').value;
			var address = document.getElementById('address').value;

			var login_fullname = document.getElementById('login1').value;
			var pricesx = prices.replace(/[^0-9,.]/, '');
			var qtysx = qty.replace(/\D+/g, '');
			
			$.ajax({type:"POST",url:"ajax.php",
			data: {
				name:name,
				pricesx:pricesx,
				qtysx:qtysx,
				purchase:purchase,
				datedue:datedue,
				sex:sex,
				contact:contact,
				address:address,
				login_fullname:login_fullname,
				action:"rental_cart"
			},
		    }).then(function(data) { 
		    	//alert(data);
	    		if(data == "1")	{ $('#addtorentcart').modal("hide"); $('#success').modal("show"); }
	    		else { $('#addtorentcart').modal("hide"); $('#fail').modal("show"); }
		    }); 
		});

		$(document).on("click", ".no", function() { $('#addtocart').modal("hide"); });
		$(document).on("click", ".dude", function() { location.reload(); });
	</script>
</body>
</html>