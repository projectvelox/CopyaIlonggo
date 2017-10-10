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
<h3 class="text-center">Rental Logs</h3>
<h5><strong>From:</strong> <?php echo $from; ?></h5>
<h5><strong>To:</strong> <?php echo $to; ?></h5>
<div class="table-responsive"> 
	<table class="table table-hover">
		<tr>
			<th>#</th>
			<th>Borrower's Name</th>
			<th>Equipment Name</th>
			<th>Quantity</th>
			<th>Address</th>
			<th>Contact Number</th>
			<th>Date Borrowed</th>
			<th>Date Due</th>
		</tr>
		<?php
			$i = 0;
			$con = mysqli_connect("localhost","root","","ci");
			$result = mysqli_query($con,"SELECT * FROM borrower_cart WHERE status='Returned' AND (date_borrowed BETWEEN '$from' AND '$to') ORDER BY YEAR(date_borrowed), MONTHNAME(date_borrowed)");
				while($row = mysqli_fetch_array($result))
				{
					$i++;
					$date_borrowed = date('M j Y g:i A', strtotime($row['date_borrowed']));
					$date_due = date('M j Y g:i A', strtotime($row['date_due']));
					echo "<tr>";
					echo "<td>" . $i . ".</td>";
					echo "<td>" . $row['name'] . "</td>";
					echo "<td>" . $row['equipment_name'] . "</td>";
					echo "<td>" . $row['qty'] . "</td>";
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
</div>
<br><br><p class="text-center"><i>Rental logs on our system as of <?php echo $today = date("F j, Y - g:iA");  ?></i></p>
<script type="text/javascript">	function start() { 	window.print(); } </script>
</body>
</html>