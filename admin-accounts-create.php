<?php 
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
	        <h4 class="modal-title">Success</h4>
	      </div>
	      <div class="modal-body">
	        <p>You have successfully created an account! You can now now avail of our service or product after a successful log in!</p>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-primary modal-closer" data-dismiss="modal">Close</button>
	      </div>
	    </div>

	  </div>
	</div>

	<!-- Modal -->
	<div id="fail" class="modal fade" role="dialog">
	  <div class="modal-dialog">

	    <!-- Modal content-->
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal">&times;</button>
	        <h4 class="modal-title">Unsuccesful</h4>
	      </div>
	      <div class="modal-body">
	        <p>Registration was unsuccesful since you have failed to fill up all the unnecessary fields. Please fill up everything and try again.</p>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
	      </div>
	    </div>

	  </div>
	</div>
	<!-- Content -->
	<div class="container" style="margin-top: 80px;">
		<div class="row">
			<ol class="breadcrumb">
			  <li class="breadcrumb-item"><a href="admin-dashboard.php">Dashboard</a></li>
			  <li class="breadcrumb-item"><a href="admin-dashboard-accounts.php">Accounts Management</a></li>
			  <li class="breadcrumb-item active"><span>Create Admin</span></li>
			</ol>
			<div style="margin-left: 15px; margin-right: 15px;">
				<div class="form-horizontal">
					<div class="form-group">
					    <label class="control-label col-sm-2" for="username">Username:</label>
					    <div class="col-sm-10">
					      <input type="text" class="form-control" id="usernames" required placeholder="Enter Desired Username">
					    </div>
					  </div>
					  <div class="form-group">
					    <label class="control-label col-sm-2" for="password">Password:</label>
					    <div class="col-sm-10">
					      <input type="password" class="form-control" id="passwords" required placeholder="Enter Desired Password">
					    </div>
					  </div>			
					  <div class="form-group">
					    <label class="control-label col-sm-2" for="lastname">Last Name:</label>
					    <div class="col-sm-10">
					      <input type="text" class="form-control" id="lastnames" required placeholder="Enter Family Name">
					    </div>
					  </div>
					  <div class="form-group">
					    <label class="control-label col-sm-2" for="firstname">First Name:</label>
					    <div class="col-sm-10"> 
					      <input type="text" class="form-control" id="firstname" required placeholder="Enter Given Name">
					    </div>
					  </div>
					  <div class="form-group">
					    <label class="control-label col-sm-2" for="middlename">Middle Name:</label>
					    <div class="col-sm-10"> 
					      <input type="text" class="form-control" id="middlename" placeholder="Enter Middle Name">
					    </div>
					  </div>
					  <div class="form-group">
						  <label class="control-label col-sm-2" for="sex">Sex:</label>
						  <div class="col-sm-10">
							  <select class="form-control" id="sex">
							    <option></option>
							    <option>Male</option>
							    <option>Female</option>						  
							  </select>
						  </div>
					  </div>
					  <div class="form-group">
					    <label class="control-label col-sm-2" for="age">Birthdate:</label>
					    <div class="col-sm-10"> 
					      <input type="date" class="form-control" id="age" required placeholder="Enter Birthdate">
					    </div>
					  </div>
					  <div class="form-group">
					    <label class="control-label col-sm-2" for="mailing">Mailing Address:</label>
					    <div class="col-sm-10"> 
					      <input type="text" class="form-control" id="mailing" required placeholder="Enter Exact Mailing Address">
					    </div>
					  </div>
					  <div class="form-group">
					    <label class="control-label col-sm-2" for="contact">Contact Number:</label>
					    <div class="col-sm-10"> 
					      <input type="text" class="form-control" id="contact" required placeholder="Enter Telephone Number">
					    </div>
					  </div>
				</div>
				<button type="button" class="btn btn-primary pull-right application">Create Account</button>
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

		$(document).on("click", ".application", function() { 
			var username = document.getElementById('usernames').value;
			var password = document.getElementById('passwords').value;
			var firstname = document.getElementById('firstname').value;
			var middlename = document.getElementById('middlename').value;
			var lastname = document.getElementById('lastnames').value;
			var sex = document.getElementById('sex').value;
			var age = document.getElementById('age').value;
			var mailing = document.getElementById('mailing').value;
			var contact = document.getElementById('contact').value;

			$.ajax({type:"POST",url:"ajax.php",
					data: {
						username:username,
						password:password,
						firstname:firstname,
						middlename:middlename,
						lastname:lastname,
						sex:sex,
						age:age,
						mailing:mailing,
						contact:contact,
						type:"Admin",
						action:"create_admin"
					},
				    }).then(function(data) {
				    	if (data == '1') {
							$('#fail').modal({
					        show: 'true'
						    });
				    	}
				    	else {
				    		$('#success').modal({
					        show: 'true'
						    }); 
				    	}
				    });

		});

		$(document).on("click", ".modal-closer", function() { 
			location.reload();
		});

	</script>
</body>
</html>