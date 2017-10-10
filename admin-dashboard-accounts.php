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

	<div class="container">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="margin-top: 80px;">
			<div class="row">
				<ol class="breadcrumb">
				  <li class="breadcrumb-item"><a href="admin-dashboard.php">Dashboard</a></li>
				  <li class="breadcrumb-item active"><span>Accounts Management</span></li>
				</ol>
				<div style="margin-left: 30px; margin-right: 10px;">
					<div class="col-xs-6 col-sm-3 col-md-3 col-lg-3">
						<a href="admin-accounts-create.php">
						<div class="bordify">
							<h3><span class="glyphicon glyphicon-user"></span></h3>
							<h4>Create Admins</h4>
						</div></a>
					</div>
					<div class="col-xs-6 col-sm-3 col-md-3 col-lg-3">
						<a href="admin-accounts-disable.php">
						<div class="bordify">
							<h3><span class="glyphicon glyphicon-remove"></span></h3>
							<h4>Disable Accounts</h4>
						</div></a>
					</div>
					<div class="col-xs-6 col-sm-3 col-md-3 col-lg-3">
						<a href="admin-accounts-enable.php">
						<div class="bordify">
							<h3><span class="glyphicon glyphicon-ok"></span></h3>
							<h4>Enable Accounts</h4>
						</div></a>
					</div>
				</div>
			</div>

			<div class="row">
				<ol class="breadcrumb">
				  <li class="breadcrumb-item"><a href="admin-dashboard.php">Dashboard</a></li>
				   <li class="breadcrumb-item active"><span>Accounts List</span></li>
				</ol>
				<div style="margin-left: 30px; margin-right: 10px;">
					<div class="col-xs-6 col-sm-3 col-md-3 col-lg-3">
						<a href="admin-accounts-list.php">
						<div class="bordify">
							<h3><span class="glyphicon glyphicon-list"></span></h3>
							<h4>Active Users</h4>
						</div></a>
					</div>
					<div class="col-xs-6 col-sm-3 col-md-3 col-lg-3">
						<a href="admin-accounts-disabled.php">
						<div class="bordify">
							<h3><span class="glyphicon glyphicon-list"></span></h3>
							<h4>Disabled Users</h4>
						</div></a>
					</div>
					<div class="col-xs-6 col-sm-3 col-md-3 col-lg-3">
						<a href="admin-accounts-admins.php">
						<div class="bordify">
							<h3><span class="glyphicon glyphicon-list"></span></h3>
							<h4>Admins List</h4>
						</div></a>
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
</body>
</html>