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
<h3 class="text-center">List of Admin Accounts</h3>
<div class="table-responsive">
	<table class="table table-hover">
		<tr>
			<th>#</th>
			<th>First Name</th>
			<th>Middle Name</th>
			<th>Last Name/th>
			<th>Sex</th>
			<th>Age</th>
			<th>Mailing Address</th>
			<th>Contact Number</th>
		</tr>
		<?php
			$i = 0;
			$con = mysqli_connect("localhost","root","","ci");
			$result = mysqli_query($con,"SELECT TIMESTAMPDIFF(YEAR, age, CURDATE()) AS converted,accounts.* FROM accounts WHERE type='Admin' AND status='Active' ORDER BY lastname, firstname ASC");
				while($row = mysqli_fetch_array($result))
				{
					$i++;
					echo "<tr>";
					echo "<td>" . $i . ".</td>";
					echo "<td>" . $row['firstname'] . " </td>";
					echo "<td>" . $row['middlename'] . "</td>";
					echo "<td>" . $row['lastname'] . "</td>";
					echo "<td>" . $row['sex'] . "</td>";
					echo "<td>" . $row['converted'] . "</td>";
					echo "<td>" . $row['mailing'] . "</td>";
					echo "<td>" . $row['contact'] . "</td>";
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