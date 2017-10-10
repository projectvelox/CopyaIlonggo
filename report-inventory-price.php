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
<h3 class="text-center">Price Change Logs</h3>
<div class="table-responsive">
	<table class="table table-hover">
		<tr>
			<th>#</th>
			<th>Equipment Name</th>
			<th>Price Before</th>
			<th>New Price</th>
			<th>Date That Price Was Changed</th>
		</tr>
		<?php
			$i = 0;
			$con = mysqli_connect("localhost","root","","ci");
			$result = mysqli_query($con,"SELECT FORMAT(cq,2) as price_1, FORMAT(qty, 2) as new_price_1, price_logs.* FROM price_logs ORDER BY YEAR(date_pricechange),MONTHNAME(date_pricechange),equipment_name");
				while($row = mysqli_fetch_array($result))
				{
					$i++;
					$date_pricechange = date('M j Y g:i A', strtotime($row['date_pricechange']));
					echo "<tr>";
					echo "<td>" . $i . ".</td>";
					echo "<td>" . $row['equipment_name'] . " </td>";
					echo "<td>₱ " . $row['price_1'] . "</td>";
					echo "<td>₱ " . $row['new_price_1'] . "</td>";
					echo "<td>" . $date_pricechange  . "</td>";
					echo "</tr>";
				}
				echo "</table>";
				mysqli_close($con);
		?>
</div>
<script type="text/javascript">	function start() { 	window.print(); } </script>
</body>
</html>