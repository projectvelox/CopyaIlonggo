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
<h3 class="text-center">Restock Logs</h3>
<div class="table-responsive">
	<table class="table table-hover">
		<tr>
			<th>#</th>
			<th>Equipment Name</th>
			<th>Quantity Before New Stocks</th>
			<th>New Stocks</th>
			<th>Total Stocks</th>
			<th>Date Restocked</th>
		</tr>
		<?php
			$i = 0;
			$con = mysqli_connect("localhost","root","","ci");
			$result = mysqli_query($con,"SELECT FORMAT(cq,0) AS cq_1, FORMAT(qty, 0) AS qty_1,restock_logs.* FROM restock_logs ORDER BY YEAR(date_restocked),MONTHNAME(date_restocked),equipment_name DESC");
				while($row = mysqli_fetch_array($result))
				{
					$total = $row['cq_1']  + $row['qty_1'];
					$i++;
					$date_restocked = date('M j Y g:i A', strtotime($row['date_restocked']));
					echo "<tr>";
					echo "<td>" . $i . ".</td>";
					echo "<td>" . $row['equipment_name'] . " </td>";
					echo "<td>" . $row['cq_1'] . " Items</td>";
					echo "<td>" . $row['qty_1'] . " Items</td>";
					echo "<td>" . $total . " Items</td>";
					echo "<td>" . $date_restocked  . "</td>";
					echo "</tr>";
				}
				echo "</table>";
				mysqli_close($con);
		?>
</div>
<script type="text/javascript">	function start() { 	window.print(); } </script>
</body>
</html>