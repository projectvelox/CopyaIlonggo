<?php
	include('session.php');
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
	<link rel="stylesheet" type="text/css" href="css/carousel.css">
	<link rel="icon" href="img/logo.png" type="image/x-icon" />
</head>
<style type="text/css">	
	.table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th { border-top: 0px; } 
	.breadcrumb { margin-left: 0px; margin-right: 0px; }  
	.table tr th:first-child, .table tr td:first-child { padding-left: 20px; }
</style>
<body>
	<input type="hidden" id="user" value="<?php echo $login_fullname; ?>">

	<style type="text/css"> ::-webkit-scrollbar { display: none; }</style>
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
	      	<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
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
 
	<div class="container cswd-container" style="margin-top: 40px !important;">
		<ol class="breadcrumb">
		  <li class="breadcrumb-item"><a href="user-dashboard.php">Home</a></li>
		  <li class="breadcrumb-item"><a href="user-account-dashboard.php">Dashboard</a></li>
		  <li class="breadcrumb-item active"><span><?php echo $login_fullname; ?>'s Cart</span></li>
		</ol>
		

			<?php 
				$result = mysqli_query($con,"SELECT * FROM user_cart WHERE user='$login_fullname' AND status='Unreserved'");
				if(mysqli_num_rows($result)== 0){ } else { ?>
				
				<div class="row text-center" style="border: 1px solid #ddd; padding: 20px 0px; margin-left: 0px; margin-right: 0px; margin-top: 0px; margin-bottom: -20px;">

				<h2 id="ci-header" style="margin-bottom: 0px; margin-left: 0px; margin-right: 0px;"><span class="glyphicon glyphicon-shopping-cart"></span> <?php echo $login_fullname ?>'s Cart - For Sale</h2>
				<div class="responsive-table">
					<table class="table table-striped sell">
					<tr>
						<th>#</th>
						<th>Equipment Name</th>
						<th>Quantity</th>
						<th>Price</th>
						<th class="text-center">Status</th>
					</tr>
					<?php
						$i=0;
						$con = mysqli_connect("localhost","root","","ci");
						$result = mysqli_query($con,"SELECT * FROM user_cart WHERE user='$login_fullname' AND status='Unreserved'");
							while($row = mysqli_fetch_array($result))
							{
								$i++;
								echo '<tr class="text-left">';
								echo '<td>' . $i . '</td>';
								echo '<td>' . $row['equipment_name'].'</td>';
								/*echo '<td>
										<span class="columns_'.$row['id'].'">
											<img src="img/icons/1.png" id="minus1" width="20" height="20" class="minus" />
											<input id="qty_'.$row['id'].'" type="text" value="'. $row['qty'].'" class="qty" />
											<img id="add1" src="img/icons/2.png" width="20" height="20" class="add" />
											<button class="btn btn-sm btn-default plus" data-editid='.$row['id'].' data-editname="'.$row['equipment_name'].'" data-editqty='.$row['qty'].' data-pricenumber='.$row['price'].' style="padding: 0px 3px;"><span class="glyphicon glyphicon-check" style="padding: 0px 3px;"></span></button>

        								</span>
									 </td>'*/
								echo '<td>‎' . $row['qty'].'</td>';	 
								echo '<td id="price-'.$row['id'].'">‎₱ ' . $row['price'].'</td>';
								echo '<td class="text-center">‎
										<button class="btn btn-danger btn-sm remove" data-id='.$row['id'].' data-name="'.$row['equipment_name'].'" data-qty='.$row['qty'].' style="padding: 0px 3px;"><span class="glyphicon glyphicon-minus"></span></button>
										</button>
									  </td>';
								echo '</tr>';
							}
							mysqli_close($con);
					?>
					</table>
				</div>
				<h4 class='text-right' style="padding-right: 25px;"><strong>Total: <?php
					$con = mysqli_connect("localhost","root","","ci");
					$result = mysqli_query($con,"SELECT FORMAT(SUM(price),2) as price FROM user_cart WHERE user='$login_fullname' AND status='Unreserved'");
						while($row = mysqli_fetch_array($result))
						{
							echo '₱ ' . $row['price'];
						}
				?></strong></h4>
				</div>
				<div class="text-right" style="border: 1px solid #ddd; border-top: 0px; background-color: #eee; padding: 5px;">
					<button class="btn btn-primary btn-sm reserve">Reserve Items</button> 
				</div><hr>
		<?php } ?>

		<?php 
			$result = mysqli_query($con,"SELECT DATE_FORMAT(date_borrowed, '%M %d, %Y') AS date_borrowed_1, DATE_FORMAT(date_due, '%M %d, %Y') AS date_due_1, FORMAT(total_price, 2) AS total_price,borrower_cart.* FROM borrower_cart WHERE name='$login_fullname' AND status='Unreserved'");
			if(mysqli_num_rows($result)== 0){ } else { ?>

		<div class="row text-center" style="border: 1px solid #ddd; padding: 20px 0px; margin-left: 0px; margin-right: 0px; margin-top: 0px; margin-bottom: -20px;">
			<h2 id="ci-header" style="margin-bottom: 0px; margin-left: 0px; margin-right: 0px;"><span class="glyphicon glyphicon-shopping-cart"></span> <?php echo $login_fullname ?>'s Cart - For Rent</h2>
			<div class="responsive-table">
				<table class="table table-striped">
				<tr>
					<th>#</th>
					<th>Equipment Name</th>
					<th>Quantity</th>
					<th>Date Borrowed</th>
					<th>Date Due</th>
					<th>Price</th>
					<th class="text-center">Status</th>
				</tr>
				<?php
					$i=0;
					$con = mysqli_connect("localhost","root","","ci");
					$result = mysqli_query($con,"SELECT DATE_FORMAT(date_borrowed, '%M %d, %Y') AS date_borrowed_1, DATE_FORMAT(date_due, '%M %d, %Y') AS date_due_1, FORMAT(total_price, 2) AS total_price,borrower_cart.* FROM borrower_cart WHERE name='$login_fullname' AND status='Unreserved'");
						while($row = mysqli_fetch_array($result))
						{
							$i++;
							echo '<tr class="text-left">';
							echo '<td>' . $i . '</td>';
							echo '<td>' . $row['equipment_name'].'</td>';
							/*echo '<td>
										<span class="columns_'.$row['id'].'">
											<img src="img/icons/1.png" id="minus1" width="20" height="20" class="minus" />
											<input id="qty_'.$row['id'].'" type="text" value="'. $row['qty'].'" class="qty" />
											<img id="add1" src="img/icons/2.png" width="20" height="20" class="add" />
											<button class="btn btn-sm btn-default plus" data-editid='.$row['id'].' data-editname="'.$row['equipment_name'].'" data-editqty='.$row['qty'].' data-pricenumber='.$row['total_price'].' style="padding: 0px 3px;"><span class="glyphicon glyphicon-check" style="padding: 0px 3px;"></span></button>

        								</span>
									 </td>';*/
							echo '<td>' . $row['qty'].'</td>';	
							echo '<td>‎' . $row['date_borrowed_1'].'</td>';
							echo '<td>' . $row['date_due_1'].'</td>';
							echo '<td>‎₱ ' . $row['total_price'].'</td>';
							echo '<td class="text-center">‎
									<button class="btn btn-danger btn-sm remove-rent" data-id='.$row['id'].' data-name="'.$row['equipment_name'].'" data-qty='.$row['qty'].' style="padding: 0px 3px;"><span class="glyphicon glyphicon-minus"></span>
								  </td>';
							echo '</tr>';
						}
						mysqli_close($con);
				?>
				</table>
			</div>
			<h4 class='text-right' style="padding-right: 25px;"><strong>Total: <?php
					$con = mysqli_connect("localhost","root","","ci");
					$result = mysqli_query($con,"SELECT FORMAT(SUM(total_price),2) as total_price FROM borrower_cart WHERE name='$login_fullname' AND status='Unreserved'");
						while($row = mysqli_fetch_array($result))
						{
							echo '₱ ' . $row['total_price'];
						}
				?></strong></h4>
		</div>

		<div class="text-right" style="border: 1px solid #ddd; border-top: 0px; background-color: #eee; padding: 5px;">

				<button class="btn btn-primary btn-sm reserve-rent">Reserve Items</button> 

			<?php ?>
		</div>
		<?php } ?>

		<br><p class="text-center"> After reserving your items, proceed to Copya Ilonggo to claim your reserved item! Please take note that upon arrival at the Copya Ilonggo you will be required to present a <strong>Valid ID</strong> for proof that you are the one who reserved the said items.</p>
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

		$(document).on("click", ".remove-rent", function() { 
			var id = $(this).data('id');
			var name = $(this).data('name');
			var qty = $(this).data('qty');

			//alert(id + " " + name + " " + qty);
			$.ajax({type:"POST",url:"ajax.php",
			data: {
				id:id,
				name, name,
				qty,qty,
				action:"remove_from_rentcart"
			},
		    }).then(function(data) {
		    	//alert(data);
		    	location.reload();
		    }); 
		});

		$(document).on("click", ".reserve", function() { 
			var user = document.getElementById('user').value;

			$.ajax({type:"POST",url:"ajax.php",
			data: {
				user:user,
				action:"reserve"
			},
		    }).then(function(data) {
		    	location.reload();
		    	//alert(data);
		    }); 
		});

		$(document).on("click", ".reserve-rent", function() { 
			var users = document.getElementById('user').value;
			$.ajax({type:"POST",url:"ajax.php",
			data: {
				users:users,
				action:"reserve_rent"
			},
		    }).then(function(data) {
		        //alert(data);
		    	location.reload();
		    }); 
		});
 
		$(document).on("click", ".plus", function() { 
			var id = $(this).data('editid');
			var name = $(this).data('editname');
			var qty = $(this).data('editqty');
			var price = $(this).data('pricenumber');

			var variable = "qty_"+id;
			var newqty = document.getElementById(variable).value;

			total = (parseFloat(newqty) * parseFloat(price));

			$.ajax({type:"POST",url:"ajax.php",
			data: {
				name:name,
				action:"change_quantity"
			},
		    }).then(function(data) {
		    	//alert(data);
		    	document.getElementById('price'+id).innerHTML = data;
		    }); 
		});

	</script>
	<script type="text/javascript">
		$(function() {
		  $('.minus,.add').on('click', function() {
		    var $qty = $(this).closest('span').find('.qty'),
		      currentVal = parseInt($qty.val()),
		      isAdd = $(this).hasClass('add');
		    !isNaN(currentVal) && $qty.val(
		      isAdd ? ++currentVal : (currentVal > 0 ? --currentVal : currentVal)
		    );
		  });
		});
	</script>
</body>
</html>