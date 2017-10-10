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
	<style type="text/css">
		hr {
		    margin-top: 20px;
		    margin-bottom: 20px;
		    border: 0;
		    border-top: 1px solid #c0b3a9;
		}
		.nav-tabs>li>a {
		    margin-right: 2px;
		    background-color: rgba(0, 0, 0, 0.65);
		    color: #fbfbfb;
		    line-height: 1.42857143;
		    border: 1px solid transparent;
		    border-radius: 4px 4px 0 0;
		}
		.nav-tabs>li.active>a, .nav-tabs>li.active>a:focus, .nav-tabs>li.active>a:hover {
		    color: #fff;
		    cursor: default;
		    background-color: #8c4f0e;
		    border: 1px solid #ddd;
		    border-bottom-color: transparent;
		}
		.nav>li>a:focus, .nav>li>a:hover {
		    text-decoration: none;
		    background-color: #535050;
		}
		
	</style>
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
			  <li class="breadcrumb-item active"><span>Rental Reports</span></li>
			</ol>
			<div style="margin-left: 30px; margin-right: 10px;">
			<form class="form-horizontal" action="searched-rental.php" method="POST" style="margin-bottom: 10px; margin-left: 15px; margin-right: 15px;">
				<div class="form-group">
				    <div class="col-sm-4">
				     	<div class="input-group ">
				     	  <span class="input-group-addon">From</span>
				     	  <input type="date" class="form-control input-group-addon" name="from" required style="background: #fff;">
					  	  <span class="input-group-addon">To</span>
						  <input type="date" class="form-control" name="to" required>
						  <span class="input-group-btn">
						    <button class="btn btn-primary" type="submit"><span class="glyphicon glyphicon-search"></span></button>
						  </span>
						</div>
				    </div>
				</div>
			</form>
			<?php 
				$con = mysqli_connect("localhost","root","","ci");
				$result = mysqli_query($con,"SELECT YEAR(date_borrowed) AS yearname FROM borrower_cart WHERE status='Returned' GROUP BY year(date_borrowed)");
				echo '<ul class="nav nav-tabs">';
				echo '<li><a data-toggle="tab" href="#others">Others</a></li>';
				foreach($result as $row) {
				  echo '<li><a data-toggle="tab" href="#'.$row['yearname'].'">'.$row['yearname'].'</a></li>';
				}
				echo '</ul>';
				echo '<div class="tab-content">';
				foreach ($result as $rows) {
					$yearname = $rows['yearname'];
					$i = 0;
					$month = mysqli_query($con,"SELECT CONCAT(MONTHNAME(date_borrowed), ' ', YEAR(date_borrowed)) AS converted FROM borrower_cart  WHERE YEAR(date_borrowed) = '$yearname' GROUP BY CONCAT(MONTHNAME(date_borrowed), ' ', YEAR(date_borrowed)) ORDER BY YEAR(date_borrowed),MONTHNAME(date_borrowed)");
					echo '<div id="'.$rows['yearname'].'" class="tab-pane fade">';
					echo '<div class="row" style="margin: 0px 20px">';
					foreach ($month as $months) {
						echo '<div class="col-xs-6 col-sm-4 col-md-2 col-lg-2" style="margin-top: 20px;">';
						echo '<a href="report-rental-list.php?name='."".$months['converted']."".'" target="_blank">';
						echo '<div class="bordify">';
						echo '<h3><span class="glyphicon glyphicon-list-alt"></span></h3>';
						echo '<h5>'.$months['converted'].' Logs</h5>';
						echo '</div></a>';
						echo '</div>';
					}
					echo '</div>';
					echo '</div>';
				}
				//OTHER TAB
				echo '<div id="others" class="tab-pane fade">';
				echo '<div class="row" style="margin: 0px 20px">';
				//returned-reports
				echo '<div class="col-xs-6 col-sm-4 col-md-2 col-lg-2" style="margin-top: 20px;">';
				echo '<a href="#" target="_blank">';
				echo '<div class="bordify">';
				echo '<h3><span class="glyphicon glyphicon-list-alt"></span></h3>';
				echo '<h5>Returned Reports</h5>';
				echo '</div></a>';
				echo '</div>';
				//rental-logs
				echo '<div class="col-xs-6 col-sm-4 col-md-2 col-lg-2" style="margin-top: 20px;">';
				echo '<a href="#" target="_blank">';
				echo '<div class="bordify">';
				echo '<h3><span class="glyphicon glyphicon-list-alt"></span></h3>';
				echo '<h5>Rental Logs</h5>';
				echo '</div></a>';
				echo '</div>';
				//unreturned-reports
				echo '<div class="col-xs-6 col-sm-4 col-md-2 col-lg-2" style="margin-top: 20px;">';
				echo '<a href="#" target="_blank">';
				echo '<div class="bordify">';
				echo '<h3><span class="glyphicon glyphicon-list-alt"></span></h3>';
				echo '<h5>Unreturned Reports</h5>';
				echo '</div></a>';
				echo '</div>';
				//due-this-month
				echo '<div class="col-xs-6 col-sm-4 col-md-2 col-lg-2" style="margin-top: 20px;">';
				echo '<a href="#" target="_blank">';
				echo '<div class="bordify">';
				echo '<h3><span class="glyphicon glyphicon-list-alt"></span></h3>';
				echo '<h5>Due this Month</h5>';
				echo '</div></a>';
				echo '</div>';


				echo '</div>';
				echo '</div>';
				//END OF OTHER TAB

				echo '</div>';
			?>
			</div>
		</div><hr>
		<div class="row">
			<ol class="breadcrumb">
			  <li class="breadcrumb-item"><a href="admin-dashboard.php">Dashboard</a></li>
			  <li class="breadcrumb-item active"><span>Sales Reports</span></li>
			</ol>
			<div style="margin-left: 30px; margin-right: 10px;">
			<form class="form-horizontal" action="searched-sales.php" method="POST" style="margin-bottom: 10px; margin-left: 15px; margin-right: 15px;">
			  	<div class="form-group">
				    <div class="col-sm-4">
				     	<div class="input-group ">
				     	  <span class="input-group-addon">From</span>
				     	  <input type="date" class="form-control input-group-addon" name="from" required style="background: #fff;">
					  	  <span class="input-group-addon">To</span>
						  <input type="date" class="form-control" name="to" required>
						  <span class="input-group-btn">
						    <button class="btn btn-primary" type="submit"><span class="glyphicon glyphicon-search"></span></button>
						  </span>
						</div>
				    </div>
				</div>
			</form>
				<?php 
					$con = mysqli_connect("localhost","root","","ci");
					$result = mysqli_query($con,"SELECT YEAR(transaction_date) AS yearname FROM user_cart WHERE status='Claimed' GROUP BY year(transaction_date)");
					echo '<ul class="nav nav-tabs">';
					foreach($result as $row) {
					  echo '<li><a data-toggle="tab" href="#'.$row['yearname'].'x">'.$row['yearname'].'</a></li>';
					}
					echo '</ul>';
					echo '<div class="tab-content">';
					foreach ($result as $rows) {
						$yearname = $rows['yearname'];
						$i = 0;
						$month = mysqli_query($con,"SELECT CONCAT(MONTHNAME(transaction_date), ' ', YEAR(transaction_date)) AS converted FROM user_cart WHERE status='Claimed' AND YEAR(transaction_date) = '$yearname' GROUP BY CONCAT(MONTHNAME(transaction_date), ' ', YEAR(transaction_date)) ORDER BY YEAR(transaction_date),MONTHNAME(transaction_date)");
						echo '<div id="'.$rows['yearname'].'x" class="tab-pane fade">';
						echo '<div class="row" style="margin: 0px 20px">';
						foreach ($month as $months) {
							echo '<div class="col-xs-6 col-sm-4 col-md-2 col-lg-2" style="margin-top: 20px;">';
							echo '<a href="report-sales-list.php?name='."".$months['converted']."".'" target="_blank">';
							echo '<div class="bordify">';
							echo '<h3><span class="glyphicon glyphicon-list-alt"></span></h3>';
							echo '<h5>'.$months['converted'].' Logs</h5>';
							echo '</div></a>';
							echo '</div>';
						}
						echo '</div>';
						echo '</div>';
					}
					echo '</div>';
				?>
			</div>
		</div><hr>
		<div class="row">
			<ol class="breadcrumb">
			  <li class="breadcrumb-item"><a href="admin-dashboard.php">Dashboard</a></li>
			  <li class="breadcrumb-item active"><span>Other Reports</span></li>
			</ol>
			<div style="margin-left: 30px; margin-right: 10px;">
				<ul class="nav nav-tabs">
				  <li><a data-toggle="tab" href="#home">Accounts</a></li>
				  <li><a data-toggle="tab" href="#menu1">Inventory</a></li>
				</ul>
				<div class="tab-content">
				  <div id="home" class="tab-pane fade">
						<div class="row" style="margin: 0px 20px; margin-top: 20px;">
							<div class="col-xs-6 col-sm-4 col-md-2 col-lg-2">
								<a href="report-account-active.php" target="_blank">
								<div class="bordify">
									<h3><span class="glyphicon glyphicon-list-alt"></span></h3>
									<h5>Active Accounts</h5>
								</div></a>
							</div>
							<div class="col-xs-6 col-sm-4 col-md-2 col-lg-2">
								<a href="report-account-active.php" target="_blank">
								<div class="bordify">
									<h3><span class="glyphicon glyphicon-list-alt"></span></h3>
									<h5>Disabled Accounts</h5>
								</div></a>
							</div>
							<div class="col-xs-6 col-sm-4 col-md-2 col-lg-2">
								<a href="report-account-admin.php" target="_blank">
								<div class="bordify">
									<h3><span class="glyphicon glyphicon-list-alt"></span></h3>
									<h5>Admin Accounts</h5>
								</div></a>
							</div>
						</div>
				  </div>
				  <div id="menu1" class="tab-pane fade">	
						<div class="row" style="margin: 0px 20px; margin-top: 20px;">
							<div class="col-xs-6 col-sm-4 col-md-2 col-lg-2">
								<a href="report-inventory-sale.php" target="_blank">
								<div class="bordify">
									<h3><span class="glyphicon glyphicon-list-alt"></span></h3>
									<h5>For Sale</h5>
								</div></a>
							</div>
							<div class="col-xs-6 col-sm-4 col-md-2 col-lg-2">
								<a href="report-inventory-rent.php" target="_blank">
								<div class="bordify">
									<h3><span class="glyphicon glyphicon-list-alt"></span></h3>
									<h5>For Rent</h5>
								</div></a>
							</div>
							<div class="col-xs-6 col-sm-4 col-md-2 col-lg-2">
								<a href="report-inventory-services.php" target="_blank">
								<div class="bordify">
									<h3><span class="glyphicon glyphicon-list-alt"></span></h3>
									<h5>Services</h5>
								</div></a>
							</div>
							<div class="col-xs-6 col-sm-4 col-md-2 col-lg-2">
								<a href="report-inventory-lowstock.php" target="_blank">
								<div class="bordify">
									<h3><span class="glyphicon glyphicon-list-alt"></span></h3>
									<h5>Low Stock</h5>
								</div></a>
							</div>
							<div class="col-xs-6 col-sm-4 col-md-2 col-lg-2">
								<a href="report-inventory-restock.php" target="_blank">
								<div class="bordify">
									<h3><span class="glyphicon glyphicon-list-alt"></span></h3>
									<h5>Restock Logs</h5>
								</div></a>
							</div>
							<div class="col-xs-6 col-sm-4 col-md-2 col-lg-2">
								<a href="report-inventory-price.php" target="_blank">
								<div class="bordify">
									<h3><span class="glyphicon glyphicon-list-alt"></span></h3>
									<h5>Price Logs</h5>
								</div></a>
							</div>
						</div>
				  </div>
				</div>
			</div>
		</div>
	</div><br><br><br><br>
	<footer>
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