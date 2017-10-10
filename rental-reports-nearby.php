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
<h3>Rental Due this <?=date('F Y')?></h3>
<table class="table table-hover">
		<tr>
			<th>#</th>
			<th>Borrower</th>
			<th>Item</th>
			<th>Address</th>
			<th>Contact</th>
			<th>From</th>
			<th>To</th>
		</tr>
		<?php
			$i = 0;
			$con = mysqli_connect("localhost","root","","ci");
			$result = mysqli_query($con,"SELECT * FROM borrower_cart WHERE status='On Hand' AND MONTH(date_due) = MONTH(CURRENT_DATE()) AND YEAR(date_due) = YEAR(CURRENT_DATE())");
				while($row = mysqli_fetch_array($result))
				{
					$i++;
					$date_borrowed = date('M j Y g:i A', strtotime($row['date_borrowed']));
					$date_due = date('M j Y g:i A', strtotime($row['date_due']));
					echo "<tr>";
					echo "<td>" . $i . ".</td>";
					echo "<td>" . $row['name'] . "</td>";
					echo "<td>" . $row['equipment_name'] . "</td>";
					echo "<td>" . $row['address'] . "</td>";
					echo "<td>" . $row['contact'] . "</td>";
					echo "<td>" . $date_borrowed . "</td>";
					echo "<td>" . $date_due . "</td>";
					echo "</tr>";
				}
				echo "</table>";
				mysqli_close($con);
		?>
	</table>
<br><br><p class="text-center">Rental Due this <?=date('F Y')?> in our system as of <?php echo $today = date("F j, Y - g:iA");  ?></i></p>
<script type="text/javascript">	function start() { 	window.print(); } </script>
</body>
</html>