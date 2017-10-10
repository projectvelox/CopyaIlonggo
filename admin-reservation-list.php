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
	.table { margin-bottom: 0px; }
</style>
<body>

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
 
	<div class="container cswd-container" style="margin-top: 40px !important;">
		<ol class="breadcrumb">
		   <li class="breadcrumb-item"><a href="admin-dashboard.php">Dashboard</a></li>
		   <li class="breadcrumb-item active"><span>Reservations</span></li>
		</ol>
		<form method="POST" action="admin-reservation-list.php">
		    <div class="input-group add-on">
		      <input class="form-control" placeholder="Search" name="search" type="text" style="height: 40px; font-size: 16px;">
		      <div class="input-group-btn">
		        <button class="btn btn-default" type="submit" name="searchBtn" style="height: 40px"><i class="glyphicon glyphicon-search"></i></button>
		      </div>
		    </div>
		</form>
		<br>
		<div class="row text-center" style="border: 1px solid #ddd; padding: 20px 0px; margin-left: 0px; margin-right: 0px; margin-top: 0px; margin-bottom: 0px;">
			<h2 id="ci-header" style="text-align: left; padding-left: 25px; margin-bottom: 0px; margin-left: 0px; margin-right: 0px;"><span class="glyphicon glyphicon-calendar"></span> Reservations for Sales</h2>
			<div class="responsive-table">
				<table class="table table-striped text-left">
				<tr>
					<th>#</th>
					<th>Customer Name</th>
					<th>Total Payment</th>
					<th>Status</th>
				</tr>
				<?php
					$searched = '';
					if (isset($_POST['search'])) { $searched = $_POST['search']; }
					$i=0;
					$con = mysqli_connect("localhost","root","","ci");
					$sql = "SELECT DISTINCT user as user FROM user_cart WHERE user LIKE '%".$searched."%' AND status='Reserved' ORDER BY user ASC";
			  	    $result = $con->query($sql);
			  		
			  		foreach ($result as $row)
					{
						$user = $row['user'];
						$i++;
						$sql1 = "SELECT FORMAT(SUM(price), 2) AS sum FROM user_cart WHERE user = '$user' AND status='Reserved' ORDER BY sum ASC";
				  	    $result = $con->query($sql1);
				  	    foreach ($result as $rows){
				  	    	echo "<tr>";
				  	    	echo "<td>" . $i . "</td>";
							echo "<td><a href='reservation-breakdown-sale.php?name=".urlencode($user)."' class='dynamic_modal' style='color: #23527c; font-weight: bold;' target='_blank'>" . $user . "</a></td>";
							echo "<td>₱ " . $rows['sum'] . "</a></td>";
							echo "<td><button data-namesales='".$user."' class='btn btn-sm btn-success claim-sales'>Claim Items</button></td>";	
							echo "</tr>";
				  	    }
					}
				?>
				</table>
			</div>

		</div><hr>
		<div class="row text-center" style="border: 1px solid #ddd; padding: 20px 0px; margin-left: 0px; margin-right: 0px; margin-top: 0px; margin-bottom: 0px;">
			<h2 id="ci-header" style="text-align: left; padding-left: 25px; margin-bottom: 0px; margin-left: 0px; margin-right: 0px;"><span class="glyphicon glyphicon-calendar"></span> Reservation for Rental</h2>
			<div class="responsive-table">
				<table class="table table-striped text-left">
				<tr>
					<th>#</th>
					<th>Customer Name</th>
					<th>Mailing Address</th>
					<th>Total Payment</th>
					<th>Status</th>
				</tr>
				<?php
					$searched = '';
					if (isset($_POST['search'])) { $searched = $_POST['search']; }
					$i=0;
					$con = mysqli_connect("localhost","root","","ci");
					$sql = "SELECT DISTINCT name as name FROM borrower_cart WHERE name LIKE '%".$searched."%' AND status='Reserved' ORDER BY name ASC";
			  	    $result = $con->query($sql);
			  		
			  		foreach ($result as $row)
					{
						$name = $row['name'];
						$i++;
						$sql1 = "SELECT FORMAT(SUM(total_price), 2) AS sum ,borrower_cart.* FROM borrower_cart WHERE name = '$name' AND status='Reserved' ORDER BY sum ASC";
				  	    $result = $con->query($sql1);
				  	    foreach ($result as $rows){
				  	    	echo "<tr>";
				  	    	echo "<td>" . $i . "</td>";
							echo "<td><a href=reservation-breakdown-rent.php?name=".urlencode($name)." class='dynamic_modal' style='color: #23527c; font-weight: bold;' target='_blank'>" . $name . "</a></td>";
							echo "<td>" . $rows['address'] . "</td>";
							echo "<td>₱ " . $rows['sum'] . "</td>";
							echo "<td><button data-namerental='".$name."' class='btn btn-sm btn-success claim-rental'>Claim Items</button></td>";	
							echo "</tr>";
				  	    }
					}
				?>
				</table>
			</div>

		</div>
		<br><p class="text-center">Please click the claim button so that the customer's reserved items will be given to them.</p>
	</div>
	<footer>
	    <div class="footer-bottom">
	        <div class="container">
	        	<div class="row">
	        		<div class="col-xs-12 col-md-6 col-lg-6">
	        			<p class="text-center"> Copyright © Copya Ilonggo. All right reserved. </p>
	        		</div>
	        		<div class="col-xs-12 col-md-6 col-lg-6">
	        			<p><span class="glyphicon glyphicon-phone"></span> +63 929 688 7257 &nbsp <span class="glyphicon glyphicon-envelope"></span> <a href="mailto:copyailonggo@gmail.com?subject=Feedback">copyailonggo@gmail.com</a> &nbsp <span class="glyphicon glyphicon-globe"></span> https://wwww.copyailonggo.com </p>
	        		</div>
	        	</div>
	        </div>
	    </div>
	</footer>
	<script src="js/jquery-3.1.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script type="text/javascript">
	$(document).on("click", ".claim-sales", function() { 
		var name = $(this).data('namesales');
		$.ajax({type:"POST",url:"ajax.php",
		data: {
			name, name,
			action:"claim_sales"
		},
	    }).then(function(data) {
	    	alert(data);
	    	//location.reload();
	    }); 
	});
	$(document).on("click", ".claim-rental", function() { 
		var name = $(this).data('namerental');
		$.ajax({type:"POST",url:"ajax.php",
		data: {
			name, name,
			action:"claim_rental"
		},
	    }).then(function(data) {
	    	location.reload();
	    }); 
	});
	</script>
</body>
</html>