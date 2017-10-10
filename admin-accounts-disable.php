<?php 
 	error_reporting(0);
  	ini_set('display_errors', 0); 
  	
 	include('session.php');
  	include('config.php');

	if(!isset($_SESSION['login_user'])){
	  header("location:index.php");
	}
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
<body>

	<!-- The Navigation Bar -->
	<nav class="navbar navbar-inverse navbar-fixed-top"> 
	  <div class="container">
	    <div class="navbar-header">
	      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
	        <span class="sr-only">Toggle navigation</span>
	        <span class="icon-bar"></span>
	        <span class="icon-bar"></span>
	        <span class="icon-bar"></span>
	      </button>
	      <a class="navbar-brand" href="index.php"><img src="img/logo.png" height="20" style="display: inline-block;"> Copya Ilonggo</a>
	    </div>
	    <div id="navbar"  class="navbar-collapse collapse navbar-right">
	      	<ul class="nav navbar-nav">
		        <li class="dropdown">
		          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-user"></span> <?php echo "$login_fullname"?> <span class="caret"></span></a>
		          <ul class="dropdown-menu">
		            <li><a href="logout.php">Logout</a></li>
		          </ul>
		        </li>
	        </ul>
	    </div>
	  </div>
	</nav>

	<!-- Modal -->
	<div id="success" class="modal fade" role="dialog">
	  <div class="modal-dialog">

	    <!-- Modal content-->
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal">&times;</button>
	        <h4 class="modal-title">Successful Disabled Accounts</h4>
	      </div>
	      <div class="modal-body">
	        <p>You have successfully disabled this account!</p>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-primary modal-closer" data-dismiss="modal">Close</button>
	      </div>
	    </div>

	  </div>
	</div>

	<!-- Content -->
	<div class="container" style="margin-top: 80px;">
		<div class="row">
			<ol class="breadcrumb">
			  <li class="breadcrumb-item"><a href="admin-dashboard.php">Dashboard</a></li>
			   <li class="breadcrumb-item"><a href="admin-dashboard-accounts.php">Accounts List</a></li>
			   <li class="breadcrumb-item active"><span>Disable Accounts</span></li>
			</ol>
			<div style="margin-left: 15px; margin-right: 15px;">
			<h3>Disable Accounts</h3>
			<div class="table-responsive">
				<table class="table table-striped">
					<tr>
						<th>#</th>
						<th><a data-toggle="tooltip" data-placement="bottom" title="Order by First Name" href="admin-accounts-disable.php?name=firstname ASC">First Name</a></th>
						<th><a data-toggle="tooltip" data-placement="bottom" title="Order by Middle Name" href="admin-accounts-disable.php?name=middlename ASC">Middle Name</a></th>
						<th><a data-toggle="tooltip" data-placement="bottom" title="Order by Last Name" href="admin-accounts-disable.php?name=lastname ASC">Last Name</a></th>
						<th><a data-toggle="tooltip" data-placement="bottom" title="Order by Sex" href="admin-accounts-disable.php?name=sex ASC">Sex</a></th>
						<th>Status</th>
					</tr>
					<?php
						$i = 0;
						$x = $_GET['name'];
					  	if($x=='') { $x='id DESC';}
						$con = mysqli_connect("localhost","root","","ci");
						$result = mysqli_query($con,"SELECT * FROM accounts WHERE status='Active' AND type='User' ORDER BY ".mysqli_real_escape_string($con, $x)."");
							while($row = mysqli_fetch_array($result))
							{
								$i++;
								$status = $row['status'];
								if($status=="Active") { $status = "<button class='btn btn-sm btn-danger zero-radius'>Disable</button>"; }
								echo "<tr>";
								echo "<td>" . $i . ".</td>";
								echo "<td>" . $row['firstname'] . " </td>";
								echo "<td>" . $row['middlename'] . "</td>";
								echo "<td>" . $row['lastname'] . "</td>";
								echo "<td>" . $row['sex'] . "</td>";
								echo "<td class='update-status' data-id='".$row['id']."'>" . $status . "</td>";
								echo "</tr>";
							}
							echo "</table>";
							mysqli_close($con);
					?>
				</table>
			</div>
			</div>
		</div>
	</div>
	<footer style="margin-top: 40px;">
	    <div class="footer-bottom">
	        <div class="container">
	            <p class="text-center"> Copyright © Copya Ilonggo. All right reserved. </p>
	        </div>
	    </div>
	</footer>
	<script type="text/javascript" src="js/jquery-3.1.1.min.js"></script>
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
	<script type="text/javascript">
		$(document).on("click", ".update-status", function() { 
			var id = $(this).data('id');
			$.ajax({type:"POST",url:"ajax.php",
				data: {
					id:id,
					action:"update_status_disabled"
				},
			    }).then(function(data) {
			    	$('#success').modal({
			        show: 'true'
				    }); 
			    });
		});

		$(document).on("click", ".modal-closer", function() { 
			$('#success').modal({
	        show: 'false'
		    }); 
			location.reload();
		});
	</script>
</body>
</html>