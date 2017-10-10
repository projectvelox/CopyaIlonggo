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
		  <li class="breadcrumb-item active"><span><?php echo $login_fullname; ?>'s On Hand Items</span></li>
		</ol>
		<div class="row text-center" style="border: 1px solid #ddd; padding: 20px 0px; margin-left: 0px; margin-right: 0px; margin-top: 0px; margin-bottom: 0px;">
			<h2 id="ci-header" style="margin-bottom: 0px; margin-left: 0px; margin-right: 0px;"><span class="glyphicon glyphicon-calendar"></span> <?php echo $login_fullname ?>'s On Hand Items</h2>
			<div class="responsive-table">
				<table class="table table-striped">
				<tr>
					<th>#</th>
					<th>Equipment Name</th>
					<th>Quantity to Rent</th>
					<th>Date Borrowed</th>
					<th>Date Due</th>
					<th>Price</th>
				</tr>
				<?php
					$i=0;
					$con = mysqli_connect("localhost","root","","ci");
					$result = mysqli_query($con,"SELECT DATE_FORMAT(date_borrowed, '%M %d, %Y') AS date_borrowed_1, DATE_FORMAT(date_due, '%M %d, %Y') AS date_due_1, FORMAT(total_price, 2) AS total_price,borrower_cart.* FROM borrower_cart WHERE name='$login_fullname' AND status='On hand'");
						while($row = mysqli_fetch_array($result))
						{
							$i++;
							echo '<tr class="text-left">';
							echo '<td>' . $i . '</td>';
							echo '<td>' . $row['equipment_name'].'</td>';
							echo '<td>' . $row['qty'].' Items</td>';
							echo '<td>‎' . $row['date_borrowed_1'].'</td>';
							echo '<td>' . $row['date_due_1'].'</td>';
							echo '<td>‎₱ ' . $row['total_price'].'</td>';
							echo '</tr>';
						}
						mysqli_close($con);
				?>
				</table>
			</div>
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
</body>
</html>