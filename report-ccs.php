<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body onload="start()">
<h3 class="text-center"> Students Registered</h3>
<div class="table-responsive"> 
	<table class="table table-hover">
		<tr>
			<th>#</th>
			<th>Student Id</th>
			<th>Student Name</th>
			<th>Course</th>
			<th>Paid</th>
			<th>Registered</th>
		</tr>
		<?php
			$i=0;
			$con = mysqli_connect("localhost","root","","ci");
			$result = mysqli_query($con,"SELECT FORMAT(qty, 0) AS qty_1, FORMAT(price, 2) AS price_1, user_cart.* FROM user_cart ORDER BY YEAR(transaction_date), MONTHNAME(transaction_date)");
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
<script type="text/javascript">	function start() { 	window.print(); } </script>
</body>
</html>