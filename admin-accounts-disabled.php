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

	<!-- Content -->
	<div class="container" style="margin-top: 80px;">
		<div class="row">
			<ol class="breadcrumb">
			  <li class="breadcrumb-item"><a href="admin-dashboard.php">Dashboard</a></li>
			   <li class="breadcrumb-item"><a href="admin-dashboard-accounts.php">Accounts List</a></li>
			   <li class="breadcrumb-item active"><span>Disabled Users</span></li>
			</ol>
			<div style="margin-left: 15px; margin-right: 15px;">
			<div class="row">
				<h3 class="col-xs-12 col-sm-12 col-md-4 col-lg-4">List of Disabled Accounts</h3> 
				<div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
					<form method="POST" action="admin-accounts-disabled.php">
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
				<table class="table table-hover">
					<tr>
						<th>#</th>
						<th><a data-toggle="tooltip" data-placement="bottom" title="Order by First Name" href="admin-accounts-disabled.php?name=firstname ASC">First Name</a></th>
						<th><a data-toggle="tooltip" data-placement="bottom" title="Order by Middle Name" href="admin-accounts-disabled.php?name=middlename ASC">Middle Name</a></th>
						<th><a data-toggle="tooltip" data-placement="bottom" title="Order by Last Name" href="admin-accounts-disabled.php?name=lastname ASC">Last Name</a></th>
						<th><a data-toggle="tooltip" data-placement="bottom" title="Order by Sex" href="admin-accounts-disabled.php?name=sex ASC">Sex</a></th>
						<th><a data-toggle="tooltip" data-placement="bottom" title="Order by Age" href="admin-accounts-disabled.php?name=age DESC">Age</a></th>
						<th><a data-toggle="tooltip" data-placement="bottom" title="Order by Mailing Address" href="admin-accounts-disabled.php?name=mailing ASC">Mailing Address</a></th>
						<th><a data-toggle="tooltip" data-placement="bottom" title="Order by Contact Number" href="admin-accounts-disabled.php?name=contact DESC">Contact Number</a></th>
					</tr>
					<?php
						$i = 0;
						$searched = '';
					    if (isset($_POST['search'])) { $searched = $_POST['search']; }
						$x = $_GET['name'];
					  	if($x=='') { $x='id DESC';}
						$con = mysqli_connect("localhost","root","","ci");
						$result = mysqli_query($con,"SELECT TIMESTAMPDIFF(YEAR, age, CURDATE()) AS converted,accounts.* FROM accounts WHERE (firstname LIKE '%".$searched."%' OR middlename LIKE '%".$searched."%' OR lastname LIKE '%".$searched."%' OR sex LIKE '%".$searched."%' OR mailing LIKE '%".$searched."%' OR contact LIKE '%".$searched."%')AND (type='User' AND status='Disabled') ORDER BY ".mysqli_real_escape_string($con, $x)."");
							while($row = mysqli_fetch_array($result))
							{
								$i++;
								echo "<tr>";
								echo "<td>" . $i . ".</td>";
								echo "<td>" . $row['firstname'] . " </td>";
								echo "<td>" . $row['middlename'] . "</td>";
								echo "<td>" . $row['lastname'] . "</td>";
								echo "<td>" . $row['sex'] . "</td>";
								echo "<td>" . $row['converted'] . "</td>";
								echo "<td>" . $row['mailing'] . "</td>";
								echo "<td>" . $row['contact'] . "</td>";
								echo "</tr>";
							}
							echo "</table>";
							mysqli_close($con);
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
</body>
</html>