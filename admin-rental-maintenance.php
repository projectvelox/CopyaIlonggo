<?php 
	error_reporting(0);
  	ini_set('display_errors', 0);

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
	        <h4 class="modal-title">Successful Maintenance</h4>
	      </div>
	      <div class="modal-body">
	        <p>You have successfully completed the maintenance phase!</p>
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
			  <li class="breadcrumb-item active"><span>Maintenance</span></li>
			</ol>
			<div style="margin-left: 15px; margin-right: 15px;">
			<div class="row">
				<h3 class="col-xs-12 col-sm-12 col-md-4 col-lg-4">Rental Maintenance</h3> 
				<div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
					<form method="POST" action="admin-rental-maintenance.php">
					    <div class="input-group add-on">
					      <input class="form-control" placeholder="Search" name="search" type="text">
					      <div class="input-group-btn">
					        <button class="btn btn-default" type="submit" name="searchBtn"><i class="glyphicon glyphicon-search"></i></button>
					      </div>
					    </div>
				    </form>
				</div>
			</div>
			<div class="table-responsive">
				<table class="table table-striped">
					<?php 
						$result = mysqli_query($con, "SELECT CONCAT_WS('-', MID(inventory_uid.id, 1,2), MID(inventory_uid.id, 3,4)) AS uid, inventory_uid.* FROM inventory_uid WHERE is_avail='5' ORDER BY is_avail ASC");
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
							$searchProduct=mysqli_query($con, "SELECT * FROM inventory WHERE id='".$rows['equipment_id']."'");
							$name=mysqli_fetch_assoc($searchProduct);
							$uid = $rows['uid'];    /* Conversion */	 $newuid = str_replace("-","",$uid);

							echo '<tr>';
							echo '<td><img src="img/serial/'.$rows['uid'].'.jpg" class="img-responsive" onerror="src=\'img/icons/not-available.jpg\'" style="height: 50px;"></td>';
							echo '<td>'.$name['equipment_name'].'</td>';
							echo '<td>'.$rows['uid'].'</td>';
							echo '<td>'.$rows['serial'].'</td>';
							echo '<td><button class="btn btn-primary btn-xs last" data-uid="'.$newuid.'">Complete Maintenance</button></td>';
							echo '</tr>';
						}
				?>
				</table>
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
		$(document).on("click", ".last", function() { 
			var uid = $(this).data('uid');

			 $.ajax({type:"POST",url:"ajax.php",
				data: {
					uid:uid,
					action:"update_last"
				},
			    }).then(function(data) {
			    	$('#success').modal({
			        show: 'true'
				    });
			    }); 
		});

		$("#success").on("hidden.bs.modal", function () { location.reload(); });
	</script>
</body>
</html>