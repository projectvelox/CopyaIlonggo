<?php 
  date_default_timezone_set('Asia/Manila'); 
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
			   <li class="breadcrumb-item active"><span>Sales List</span></li>
			</ol>
			<ul class="nav nav-tabs">
			  <li class="active"><a data-toggle="tab" href="#home">Home</a></li>
			  <li><a data-toggle="tab" href="#menu1">Rentals</a></li>
			  <li><a data-toggle="tab" href="#menu2">Purchase</a></li>
			  <li><a data-toggle="tab" href="#menu4">Rental History</a></li>
			  <li><a data-toggle="tab" href="#menu3">Purchase History</a></li>
			</ul>
			<div class="tab-content">
			  <div id="home" class="tab-pane fade in active text-center" style="margin-bottom: 80px;">
			  	<h1 style="margin-top: 50px; margin-left: 15px; margin-right: 15px;">Summarized Reports for <?php echo date('F Y') ?></h1><hr>
			  	  <div class="row" style="margin-top: 20px; margin-left: 15px; margin-right: 15px;">	
					  <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
					  	<div class="panel panel-default">
					  		<div class="panel-header"></div>
					    	<div class="panel-body">
					    	<div style="margin-left: 15px; margin-right: 15px;">
					  		<?php
								$i = 0;
								$con = mysqli_connect("localhost","root","","ci");
								$result = mysqli_query($con,"SELECT SUM(total_price) AS total_rent FROM borrower_cart WHERE (status='On Hand' OR status='Returned') AND MONTH(date_borrowed) = MONTH(CURRENT_DATE())");
									while($row = mysqli_fetch_array($result))
									{
										echo "<h4>Profit from Rental:</h4>
											  <h2 id='rental' style='border-top: 1px solid #ddd; padding-top: 15px;'>" . $row['total_rent'] . "</h2>";
									}
									mysqli_close($con);
							?>
							</div> 
					    	</div>
					  	</div>
					  </div>
					   <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
					  	<div class="panel panel-default">
					  		<div class="panel-header"></div>
					    	<div class="panel-body">
					    	<div style="margin-left: 15px; margin-right: 15px;">
					  		<?php
								$i = 0;
								$con = mysqli_connect("localhost","root","","ci");
								$result = mysqli_query($con,"SELECT SUM(price) AS total_price FROM user_cart WHERE (status = 'Claimed') AND MONTH(transaction_date) = MONTH(CURRENT_DATE())");
									while($row = mysqli_fetch_array($result))
									{
										echo "<h4>Profit from Sales:</h4>
											  <h2 id='sales' style='border-top: 1px solid #ddd; padding-top: 15px;'>" . $row['total_price'] . "</h2>";
									}
									mysqli_close($con);
							?>
							</div> 
					    	</div>
					  	</div>
					  </div>
					   <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
					  	<div class="panel panel-default">
					  		<div class="panel-header"></div>
					    	<div class="panel-body">
					    		<div style="margin-left: 15px; margin-right: 15px;">
					    			<h4>Total Profit:</h4>
					    			<h2 style="border-top: 1px solid #ddd; padding-top: 15px;" id="total"></h2>
								</div> 
					    	</div>
					  	</div>
					  </div>
				</div>
			  </div>
			  <div id="menu1" class="tab-pane fade">
			    <div style="margin-left: 15px; margin-right: 15px;">
					<h3>Profit From Rentals This Month</h3>
					<div class="table-responsive">
						<table class="table table-hover">
						<tr>
							<th>#</th>
							<th>Borrower's Name</th>
							<th>Equipment Name</th>
							<th>Quantity</th>
							<th>Address</th>
							<th>Date Borrowed</th>
							<th>Date Due</th>
							<th>Total Price</th>
							<th>Status</th>
						</tr>
						<?php
							$i = 0;
							$con = mysqli_connect("localhost","root","","ci");
							$result = mysqli_query($con,"SELECT name, address, contact, equipment_name, FORMAT(price, 0) AS price, qty, date_borrowed, date_due, FORMAT(total_price, 2) AS total_price, status FROM borrower_cart WHERE DATE_FORMAT(date_borrowed, '%M %Y') = DATE_FORMAT(CURRENT_DATE(), '%M %Y') AND (status='On Hand' OR status='Returned') ORDER BY id DESC");
								while($row = mysqli_fetch_array($result))
								{
									$i++;
									$date_borrowed = date('M j, Y', strtotime($row['date_borrowed']));
									$date_due = date('M j, Y', strtotime($row['date_due']));
									echo "<tr>";
									echo "<td>" . $i . ".</td>";
									echo "<td>" . $row['name'] . "</td>";
									echo "<td>" . $row['equipment_name'] . "</td>";
									echo "<td>" . $row['qty'] . "</td>";
									echo "<td>" . $row['address'] . "</td>";
									echo "<td>" . $date_borrowed . "</td>";
									echo "<td>" . $date_due . "</td>";
									echo "<td>₱ " . $row['total_price'] . "</td>";
									echo "<td>" . $row['status'] . "</td>";
									echo "</tr>";
								}
								echo "</table>";
								mysqli_close($con);
						?>
						</table>
					</div>
					<?php
						$i = 0;
						$con = mysqli_connect("localhost","root","","ci");
						$result = mysqli_query($con,"SELECT FORMAT(SUM(total_price), 2) AS total_rent FROM borrower_cart WHERE DATE_FORMAT(date_borrowed, '%M %Y') = DATE_FORMAT(CURRENT_DATE(), '%M %Y') AND (status='On Hand' OR status='Returned')");
							while($row = mysqli_fetch_array($result))
							{
								echo "<h4 class='text-right'><strong>Summarized Reports for ".  date('F Y') .": ₱ <span class='summarized'>" . $row['total_rent'] . "</span></strong></h4>";
							}
							mysqli_close($con);
					?>
					
				</div>
			  </div>
			  <div id="menu2" class="tab-pane fade">
			    <div style="margin-left: 15px; margin-right: 15px;">
					<h3>Profit From Purchases This Month</h3>
					<div class="table-responsive">
					<table class="table table-hover">
						<tr>
							<th>#</th>
							<th>Customer</th>
							<th>Product Name</th>
							<th>Purchased Qty</th>
							<th>Price</th>
							<th>Date of Purchase</th>
							<th>Status</th>
						</tr>
						<?php
							$i=0;
							$con = mysqli_connect("localhost","root","","ci");
							$result = mysqli_query($con,"SELECT FORMAT(price, 2) AS total_price, user_cart.* FROM user_cart WHERE DATE_FORMAT(transaction_date, '%M %Y') = DATE_FORMAT(CURRENT_DATE(), '%M %Y') AND (status = 'Claimed') ORDER BY id DESC");
								while($row = mysqli_fetch_array($result))
								{
									$transaction_date = date('M j Y g:i A', strtotime($row['transaction_date']));
									$i++;
									echo "<tr>";
									echo "<td>" . $i . ".</td>";
									echo "<td>" . $row['user'] . "</td>";
									echo "<td>" . $row['equipment_name'] . " </td>";
									echo "<td>" . $row['qty'] . " Items</td>";
									echo "<td>₱ " . $row['total_price'] . "</td>";
									echo "<td>" . $transaction_date . "</td>";
									echo "<td>" . $row['status'] . "</td>";
									echo "</tr>";
								}
								mysqli_close($con);
						?>
					</table>
					</div>
					<?php
						$con = mysqli_connect("localhost","root","","ci");
						$result = mysqli_query($con,"SELECT FORMAT(SUM(price), 2) AS total_profit FROM user_cart WHERE DATE_FORMAT(transaction_date, '%M %Y') = DATE_FORMAT(CURRENT_DATE(), '%M %Y') AND (status = 'Claimed')");
							while($row = mysqli_fetch_array($result))
							{
								echo "<h4 class='text-right'><strong>Summarized Reports for ".  date('F Y') .": ₱ <span class='summarized'>" . $row['total_profit'] . "</span></strong></h4>";
							}
							mysqli_close($con);
					?>
				</div>
			  </div>

			  <div id="menu3" class="tab-pane fade">
			    <div style="margin-left: 15px; margin-right: 15px;">
					<h3 style="color: black">Purchase History</h3>			
					<div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
						<div class="table-responsive">
							<table class="table table-striped">
							<tr>
							<th>Year</th>
							<th>Month</th>
							<th>Total Profit</th>
							</tr>
							<?php
							$con = mysqli_connect("localhost","root","","ci");
							$sql = "SELECT DISTINCT DATE_FORMAT(transaction_date, '%M %Y') as transaction_date FROM user_cart ORDER BY YEAR(transaction_date), MONTH(transaction_date) ASC";
					  	    $result = $con->query($sql);
					  		
					  		foreach ($result as $row)
							{
								$month = $row['transaction_date'];
								$year = date("Y",strtotime($month));
								$months = date("M",strtotime($month));
								//$month = date("M",strtotime($row['transaction_date']));
								//$year = date("Y",strtotime($row['transaction_date']));
								$sql1 = "SELECT FORMAT(SUM(price), 2) AS sum FROM user_cart WHERE (status = 'Claimed') AND DATE_FORMAT(transaction_date, '%M %Y')='$month' ORDER BY YEAR(transaction_date), MONTH(transaction_date) ASC";
						  	    $result = $con->query($sql1);
						  	    foreach ($result as $rows){
						  	    	echo "<tr>";
									echo "<td>" . $year . "</td>";
									echo "<td><a href='report.php?month=".urlencode($month)."&report=Sales' class='dynamic_modal' style='color: #23527c; font-weight: bold;' target='_blank'>" . $months . "</a></td>";
									echo "<td>₱ " . $rows['sum'] . "</td>";	
									echo "</tr>";
						  	    }
							}
							?>
							</table>
						</div>
					</div>
					<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
						<canvas id="myChart" width="400" height="400"></canvas>
					</div>
				</div>
			  </div>

			  <div id="menu4" class="tab-pane fade">
			    <div style="margin-left: 15px; margin-right: 15px;">
					<h3 style="color: black">Rental History</h3>			
					<div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
						<div class="table-responsive">
							<table class="table table-striped">
							<tr>
							<th>Year</th>
							<th>Month</th>
							<th>Total Profit</th>
							</tr>
							<?php
							$con = mysqli_connect("localhost","root","","ci");
							$sql = "SELECT DISTINCT DATE_FORMAT(date_borrowed, '%M %Y') as date_borrowed FROM borrower_cart ORDER BY YEAR(date_borrowed), MONTH(date_borrowed) ASC";
					  	    $result = $con->query($sql);
					  		
					  		foreach ($result as $row)
							{
								$month = $row['date_borrowed'];
								$year = date("Y",strtotime($month));
								$months = date("M",strtotime($month));
								//$month = date("M",strtotime($row['transaction_date']));
								//$year = date("Y",strtotime($row['transaction_date']));
								$sql1 = "SELECT FORMAT(SUM(total_price), 2) AS sum FROM borrower_cart WHERE DATE_FORMAT(date_borrowed, '%M %Y')='$month' AND (status='Returned' OR status='On Hand') ORDER BY YEAR(date_borrowed), MONTH(date_borrowed) ASC";
						  	    $result = $con->query($sql1);
						  	    foreach ($result as $rows){
						  	    	echo "<tr>";
									echo "<td>" . $year . "</td>";
									echo "<td><a href='report.php?month=".urlencode($month)."&report=Rental' class='dynamic_modal' style='color: #23527c; font-weight: bold;' target='_blank'>" . $months . "</a></td>";
									echo "<td>₱ " . $rows['sum'] . "</td>";	
									echo "</tr>";
						  	    }
							}
							?>
							</table>
						</div>
					</div>
					<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
						<canvas id="myChart1" width="400" height="400"></canvas>
					</div>
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
	<script type="text/javascript" src="js/date.format.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			var sales = $("#sales").text();
			var rental = $("#rental").text();
			var total = (parseFloat(rental) + parseFloat(sales));

			var salesx = parseFloat(sales).toFixed(2);
			var rentalx = parseFloat(rental).toFixed(2);
			var totalx = parseFloat(total).toFixed(2);

			//alert (sales + " " + rental + " " + total);
			
			if(rental == '') {
				var total = (0 + parseInt(sales));
				document.getElementById("sales").innerHTML = "₱ " + salesx;
				document.getElementById("rental").innerHTML = "₱ 0";
				document.getElementById("total").innerHTML = "₱ " + totalx;
			}
			
			if(sales == '') {
				var total = (0 + parseInt(rental));
				document.getElementById("sales").innerHTML = "₱ 0"
				document.getElementById("rental").innerHTML = "₱ " + rentalx;
				document.getElementById("total").innerHTML = "₱ " + total;
			}

			if(sales == '' && rental == '')
			{
				document.getElementById("sales").innerHTML = "₱ 0";
				document.getElementById("rental").innerHTML = "₱ 0";
				document.getElementById("total").innerHTML = "₱ 0";
			}


			if(sales == $("#sales").text() && rental == $("#rental").text()) {
				document.getElementById("sales").innerHTML = "₱ " + salesx;
				document.getElementById("rental").innerHTML = "₱ " + rentalx;
				document.getElementById("total").innerHTML = "₱ " + totalx; 
			}
			
		});
	</script>
	<script src="js/Chart.bundle.min.js"></script>
	<script>
		var ctx = document.getElementById("myChart");
		var myChart = new Chart(ctx, {
		    type: 'line',
		    data: { 
		        labels: [<?php  
		        	$con = mysqli_connect("localhost","root","","ci");
					$sql = "SELECT DISTINCT DATE_FORMAT(transaction_date, '%Y') as transaction_date FROM user_cart ORDER BY transaction_date ASC";
			  	    $result = $con->query($sql);
			  		
			  		foreach ($result as $row)
					{
						$month = $row['transaction_date'];
						$sql1 = "SELECT FORMAT(SUM(price), 2) AS sum FROM user_cart WHERE DATE_FORMAT(transaction_date, '%Y')='$month' AND (status = 'Claimed')";
				  	    $result = $con->query($sql1);
				  	    foreach ($result as $rows){
				  	 		echo '"'.$month.'",';
				  	    }
					}
		        ?>],
		        datasets: [{
		            label: 'Statistical Purchase Report',
		            data: [<?php  
		        	$con = mysqli_connect("localhost","root","","ci");
					$sql = "SELECT DISTINCT DATE_FORMAT(transaction_date, '%Y') as transaction_date FROM user_cart ORDER BY transaction_date ASC";
			  	    $result = $con->query($sql);
			  		
			  		foreach ($result as $row)
					{
						$month = $row['transaction_date'];
						$sql1 = "SELECT SUM(price) AS sum FROM user_cart WHERE DATE_FORMAT(transaction_date, '%Y')='$month' AND (status = 'Claimed')";
				  	    $result = $con->query($sql1);
				  	    foreach ($result as $rows){
				  	 		echo '"'.$rows['sum'].'",';
				  	    }
					}
		        	?>],
		            backgroundColor: [
		                'rgba(255, 99, 132, 0.2)',
		                'rgba(54, 162, 235, 0.2)',
		                'rgba(255, 206, 86, 0.2)',
		                'rgba(75, 192, 192, 0.2)',
		                'rgba(153, 102, 255, 0.2)',
		                'rgba(255, 159, 64, 0.2)'
		            ],
		            borderColor: [
		                'rgba(255,99,132,1)',
		                'rgba(54, 162, 235, 1)',
		                'rgba(255, 206, 86, 1)',
		                'rgba(75, 192, 192, 1)',
		                'rgba(153, 102, 255, 1)',
		                'rgba(255, 159, 64, 1)'
		            ],
		            borderWidth: 1
		        }]
		    },
		    options: {
		        scales: {
		            yAxes: [{
		                ticks: {
		                    beginAtZero:true
		                }
		            }]
		        }
		    }
		});
	</script>
	<script>
		var chart2 = document.getElementById("myChart1");
		var myChart2 = new Chart(chart2, {
		    type: 'line',
		    data: { 
		        labels: [<?php  
		        	$con = mysqli_connect("localhost","root","","ci");
					$sql = "SELECT DISTINCT DATE_FORMAT(date_borrowed, '%Y') as date_borrowed FROM borrower_cart ORDER BY date_borrowed ASC";
			  	    $result = $con->query($sql);
			  		
			  		foreach ($result as $row)
					{
						$month = $row['date_borrowed'];
						$sql1 = "SELECT FORMAT(SUM(total_price), 2) AS sum FROM borrower_cart WHERE DATE_FORMAT(date_borrowed, '%Y')='$month' AND (status = 'On Hand' OR status='Returned')";
				  	    $result = $con->query($sql1);
				  	    foreach ($result as $rows){
				  	 		echo '"'.$month.'",';
				  	    }
					}
		        ?>],
		        datasets: [{
		            label: 'Statistical Rental Report',
		            data: [<?php  
		        	$con = mysqli_connect("localhost","root","","ci");
					$sql = "SELECT DISTINCT DATE_FORMAT(date_borrowed, '%Y') AS date_borrowed FROM borrower_cart ORDER BY date_borrowed ASC";
			  	    $result = $con->query($sql);
			  		
			  		foreach ($result as $row)
					{
						$month = $row['date_borrowed'];
						$sql1 = "SELECT SUM(total_price) AS sum FROM borrower_cart WHERE DATE_FORMAT(date_borrowed, '%Y')='$month' AND (status = 'On Hand' OR status='Returned')";
				  	    $result = $con->query($sql1);
				  	    foreach ($result as $rows){
				  	 		echo '"'.$rows['sum'].'",';
				  	    }
					}
		        	?>],
		            backgroundColor: [
		                'rgba(255, 99, 132, 0.2)',
		                'rgba(54, 162, 235, 0.2)',
		                'rgba(255, 206, 86, 0.2)',
		                'rgba(75, 192, 192, 0.2)',
		                'rgba(153, 102, 255, 0.2)',
		                'rgba(255, 159, 64, 0.2)'
		            ],
		            borderColor: [
		                'rgba(255,99,132,1)',
		                'rgba(54, 162, 235, 1)',
		                'rgba(255, 206, 86, 1)',
		                'rgba(75, 192, 192, 1)',
		                'rgba(153, 102, 255, 1)',
		                'rgba(255, 159, 64, 1)'
		            ],
		            borderWidth: 1
		        }]
		    },
		    options: {
		        scales: {
		            yAxes: [{
		                ticks: {
		                    beginAtZero:true
		                }
		            }]
		        }
		    }
		});

	</script>
</body>
</html>