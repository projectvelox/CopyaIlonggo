<?php 
	$from = $_POST['from'];
	$to = $_POST['to'];
	date_default_timezone_set('Asia/Manila');
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
<body onload="start()">
<h3 class="text-center">Sales Logs</h3>
<h5><strong>From:</strong> <?php echo $from; ?></h5>
<h5><strong>To:</strong> <?php echo $to; ?></h5>
<div class="table-responsive"> 
	<table class="table table-hover">
		<tr>
			<th>#</th>
			<th>Customer</th>
			<th>Product Name</th>
			<th>Quantity</th>
			<th>Price</th>
			<th>Date of Purchase</th>
		</tr>
		<?php
			$i=0;
			$con = mysqli_connect("localhost","root","","ci");
			$result = mysqli_query($con,"SELECT FORMAT(qty, 0) AS qty_1, FORMAT(price, 2) AS price_1, user_cart.* FROM user_cart WHERE status='Claimed' AND (transaction_date BETWEEN '$from' AND '$to') ORDER BY YEAR(transaction_date), MONTHNAME(transaction_date)");
				while($row = mysqli_fetch_array($result))
				{
					$transaction_date = date('M j Y g:i A', strtotime($row['transaction_date']));
					$i++;
					echo "<tr>";
					echo "<td>" . $i . ".</td>";
					echo "<td>" . $row['user'] . "</td>";
					echo "<td>" . $row['equipment_name'] . " </td>";
					echo "<td>" . $row['qty_1'] . " Items</td>";
					echo "<td>₱ " . $row['price_1'] . "</td>";
					echo "<td>" . $transaction_date . "</td>";
					echo "</tr>";
				}
				echo "</table>";
				mysqli_close($con);
		?>
	</table>
</div>
<br><br><p class="text-center"><i>Sales logs on our system as of <?php echo $today = date("F j, Y - g:iA");  ?></i></p>
<script type="text/javascript">	function start() { 	window.print(); } </script>
</body>
</html>