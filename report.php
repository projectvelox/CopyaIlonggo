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
		@media screen and (max-width: 767px) {
			.table-responsive {
			    width: 100%;
			    margin-bottom: 15px;
			    overflow-y: hidden;
			    -ms-overflow-style: -ms-autohiding-scrollbar;
			    border: 0px;
			}
		}
	</style>
	<?php 
		$x = $_GET['month'];
		$y = $_GET['report'];  
	?>
	<div class="container">
		<h2><?php echo $y ?> Report for <?php echo $x ?> </h2>
		<div class="table-responsive">
		<table class="table table-striped">
		<?php
			if($y == 'Sales') {
				echo '<tr>';
				echo '<th>#</th>';
				echo '<th>Customer Name</th>';
				echo '<th>Equipment Purchased</th>';
				echo '<th>Quantity</th>';
				echo '<th>Total</th>';
				echo '</tr>';		
				$i=0;
				$con = mysqli_connect("localhost","root","","ci");
				$result = mysqli_query($con,"SELECT FORMAT(price, 2) AS total_price, user_cart.* FROM user_cart WHERE DATE_FORMAT(transaction_date, '%M %Y') = '$x' AND status='Claimed'");
					while($row = mysqli_fetch_array($result))
					{	
						$i++;
						echo "<tr>";
						echo "<td>" . $i . "</td>";
						echo "<td>" . $row['user'] . "</td>";
						echo "<td>" . $row['equipment_name'] . "</td>";
						echo "<td>" . $row['qty'] . " Items</td>";
						echo "<td>₱ " . $row['total_price'] . "</td>";
						echo "</tr>";	
					}
			}
			if($y == 'Rental') {
				echo '<tr>';
				echo '<th>#</th>';
				echo '<th>Borrower Name</th>';
				echo '<th>Address</th>';
				echo '<th>Contact Number</th>';
				echo '<th>Equipment Borrowed</th>';
				echo '<th>Qty.</th>';
				echo '<th>Total</th>';
				echo '</tr>';		
				$i=0;
				$con = mysqli_connect("localhost","root","","ci");
				$result = mysqli_query($con,"SELECT FORMAT(total_price, 2) AS tp, borrower_cart.* FROM borrower_cart WHERE DATE_FORMAT(date_borrowed, '%M %Y') = '$x' AND (status='On Hand' OR status='Returned')");
					while($row = mysqli_fetch_array($result))
					{	
						$i++;
						echo "<tr>";
						echo "<td>" . $i . "</td>";
						echo "<td>" . $row['name'] . "</td>";
						echo "<td>" . $row['address'] . "</td>";
						echo "<td>" . $row['contact'] . "</td>";
						echo "<td>" . $row['equipment_name'] . "</td>";
						echo "<td>" . $row['qty'] . " Items</td>";
						echo "<td>₱ " . $row['tp'] . "</td>";
						echo "</tr>";	
					}
			}
		?>
		</table> 
		</div>
	</div>
</body>
</html>