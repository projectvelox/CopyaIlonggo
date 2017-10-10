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
<h3 class="text-center">List of Equipments For Sale</h3>
<div class="table-responsive">
	<table class="table table-hover">
		<tr>
			<th>#</th>
			<th>Item</th>
			<th>Description</th>
			<th>Price Per Page</th>
		</tr>
		<?php
			$i=0;
			$con = mysqli_connect("localhost","root","","ci");
			$result = mysqli_query($con,"SELECT FORMAT(qty, 0) AS qty_1, FORMAT(price, 0) AS price_1, inventory.* FROM inventory WHERE type='Services' AND status='Active' ORDER BY equipment_name ASC");
				while($row = mysqli_fetch_array($result))
				{
					$i++;
					$status = $row['status'];
					
					echo "<tr>";
					echo "<td>" . $i . ".</td>";
					echo "<td>" . $row['equipment_name'] . " </td>";
					echo "<td style='width: 60%;'>" . $row['description'] . " </td>";
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