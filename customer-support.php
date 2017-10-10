<?php
	include('session.php');
	if(!isset($_SESSION['login_user'])){
	  header("location:index.php");
	}

	$con = mysqli_connect("localhost","root","","ci");
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
	<link rel="stylesheet" type="text/css" href="css/carousel.css">
	<link rel="icon" href="img/logo.png" type="image/x-icon" />
</head>
<body>
	<style type="text/css"> .breadcrumb { margin-left: 0px; margin-right: 0px; } .bordify { margin-left: 0px; } </style>
	<nav class="navbar navbar-inverse navbar-fixed-top"> 
	  <div class="container">
	    <div class="navbar-header">
	      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
	        <span class="sr-only">Toggle navigation</span>
	        <span class="icon-bar"></span>
	        <span class="icon-bar"></span>
	        <span class="icon-bar"></span>
	      </button>
	      <a class="navbar-brand" href="user-dashboard.php">Copya Ilonggo</a>
	    </div>
	    <div id="navbar"  class="navbar-collapse collapse navbar-right">
	      	<ul class="nav navbar-nav">
		        <li><a href="user-cart.php"><span class="glyphicon glyphicon-shopping-cart"></span> My Cart</a></li>
		        <li class="dropdown">
		          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-user"></span> <?php echo "$login_fullname"?> <span class="caret"></span></a>
		          <ul class="dropdown-menu">
		            <li><a href="user-account-dashboard.php">Dashboard</a></li>
		            <li role="separator" class="divider"></li>
		            <li class="dropdown-header">Account</li>
		            <li><a href="user-account-settings.php">Settings</a></li>
		            <li><a href="logout.php">Logout</a></li>
		          </ul>
		        </li>
	        </ul>
	    </div>
	  </div>
	</nav>
	<div class="container" style="margin-top: 50px; margin-bottom: 20px;">
		<ol class="breadcrumb">
		  <li class="breadcrumb-item"><a href="admin-dashboard.php">Home</a></li>
		  <li class="breadcrumb-item active"><span>Customer Support</span></li>
		</ol>
		<div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
			<div class="user-profile-pic">
				<img src="img/uploads/<?php echo $login_fullname;?>.jpg" class="img-responsive" onerror="src='img/icons/not-available.jpg'" >
			</div>
			<div class="bordify data-profile-container" style="text-align: left; padding: 10px; border-radius: 0px; margin-top: 10px;">
				<h4>Account Details:</h4>
				<span><strong>Username: </strong></span><span><?php echo $login_session; ?></span><br><br>
				<h4>Basic Details:</h4>
				<span><strong>First Name: </strong></span><span><?php echo $first; ?></span><br>
				<span><strong>Middle Name: </strong></span><span><?php echo $middle; ?></span><br>
				<span><strong>Last Name: </strong></span><span><?php echo $last; ?></span><br><br>
				<span><strong>Sex: </strong></span><span><?php echo $sex; ?></span><br>
				<span><strong>Age: </strong></span><span><?php echo $converted; ?> Years Old</span><br><br>

				<h4>Contact Details:</h4>
				<span><strong>Contact Number: </strong></span><span><?php echo $contact; ?></span>
				
			</div>
		</div>
		<div class="col-xs-12 col-sm-12 col-md-9 col-lg-9">
			<h3>Messages</h3>
			<?php 
				echo '<div class="table-responsive">';
				echo '<table class="table table-striped">';
				echo '<tr>';
				echo '<th>Avatar</th>';
				echo '<th>Name</th>';
				echo '<th>Address</th>';
				echo '<th>Messages</th>';
				echo '<th>Action</th>';
				echo '</tr>';
				$results = mysqli_query($con, "SELECT servicerequest.user_id, servicerequest.user, accounts.mailing AS address, COUNT(servicerequest.message) AS message, servicerequest.sent FROM servicerequest INNER JOIN accounts ON accounts.id = servicerequest.user_id WHERE servicerequest.user != '$login_fullname' GROUP BY user ");
				foreach ($results as $row){
					$sent = date('M j Y g:i A', strtotime($row['sent']));
					echo '<tr>';
					echo '<td><img src="img/uploads/'.$row['user'].'.jpg" class="img-responsive" onerror="src=\'img/icons/not-available.jpg\'" style="height: 50px;"></td>';
					echo '<td>'.$row['user'].'</td>';
					echo '<td>'.$row['address'].'</td>';
					echo '<td>'.$row['message'].'</td>';
					echo '<td><a class="btn btn-primary btn-sm" href="customer-support-specific.php?id='.$row['user_id'].'">Check</a></td>';
					echo '</tr>';
				}
				echo '</table>';
				echo '</div>';
			?>
		</div>
	</div>
	<script src="js/jquery-3.1.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script type="text/javascript">
		$(document).on("click", ".sendmessage", function() {
			var user = document.getElementById('user').value;
			var user_id = document.getElementById('user_id').value; 
			var message = document.getElementById('message').value;
			
			//alert(message + " " + user + " " + user_id);
			$.ajax({type:"POST",url:"ajax.php",
			data: {
				user:user,
				user_id:user_id,
				message:message,
				action:"sendmessage"
			},
		    }).then(function(data) {
	    		if(data == "2")	{ $('#servicerequest').modal("hide"); $('#successmessage').modal("show"); }
	    		else { 
	    			document.getElementById('change').innerHTML = "Please don't leave this blank!" 
	    		}
		    }); 
		});

		// After message has been sent, reload the page
		$("#servicerequest").on("hidden.bs.modal", function () { location.reload(); });
	</script>
</body>
</html>



