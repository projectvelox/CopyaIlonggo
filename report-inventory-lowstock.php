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
<h3 class="text-center">List of Low Stocked Equipments</h3>
<div class="table-responsive">
	<table class="table table-hover">
		<tr>
			<th>#</th>
			<th>Equipment Name</th>
			<th>Quantity</th>
			<th>Price</th>
		</tr>
		<?php
			$i = 0;
			$con = mysqli_connect("localhost","root","","ci");
			$result = mysqli_query($con,"SELECT FORMAT(qty,0) as qty_1, FORMAT(price,2) as price_1,inventory.* FROM inventory WHERE type='Inventory' AND  qty < 5");
				while($row = mysqli_fetch_array($result))
				{
					$i++;
					echo "<tr>";
					echo "<td>" . $i . ".</td>";
					echo "<td>" . $row['equipment_name'] . " </td>";
					echo "<td>" . $row['qty_1'] . " Left</td>";
					echo "<td>₱ " . $row['price_1'] . "</td>";
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