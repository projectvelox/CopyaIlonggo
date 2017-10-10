<?php date_default_timezone_set('Asia/Manila');?>
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
<h3>Completed Sales Transaction Logs</h3>
<table class="table table-hover">
	<tr>
		<th>#</th>
		<th>Customer</th>
		<th>Item</th>
		<th>Price</th>
		<th>Transaction Date</th>
	</tr>
	<?php
		$i = 0;
		$con = mysqli_connect("localhost","root","","ci");
		$result = mysqli_query($con,"SELECT FORMAT(qty, 0) AS qty_1, FORMAT(price, 2) AS price_1, user_cart.* FROM user_cart WHERE status='Claimed'");
			while($row = mysqli_fetch_array($result))
			{
				$transaction_date = date('M j Y g:i A', strtotime($row['transaction_date']));
				$i++;
				echo "<tr>";
				echo "<td>" . $i . ".</td>";
				echo "<td>" . $row['user'] . "</td>";
				echo "<td>" . $row['equipment_name'] . " </td>";
				echo "<td>₱ " . $row['price_1'] . "</td>";
				echo "<td>" . $transaction_date . "</td>";
				echo "</tr>";
			}
			mysqli_close($con);
	?>
</table>
<br><br><p class="text-center">Completed sales transactions log in our system as of <?php echo $today = date("F j, Y - g:iA");  ?></i></p>
<script type="text/javascript">	function start() { 	window.print(); } </script>
</body>
</html>