<?php
	include('session.php');
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
	<link rel="stylesheet" type="text/css" href="css/carousel.css">
	<link rel="icon" href="img/logo.png" type="image/x-icon" />
</head>
<body>
	<style type="text/css"> .breadcrumb { margin-left: 0px; margin-right: 0px; }  </style>
	<!-- Success -->
	<div id="success" class="modal fade" role="dialog">
	  <div class="modal-dialog">
	  	<div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal">&times;</button>
	        <h4 class="modal-title">Success</h4>
	      </div>
	      <div class="modal-body">
	        <p class="text-center">Successfully added item to your cart! You can check your cart <a href="user-cart.php">here</a> or continue choosing items. If unsatisfied with whatever you chose, you can always remove them from your cart later.</p>	      
	      </div>
	      <div class="modal-footer">
	      	<button type="button" class="btn btn-default dude" data-dismiss="modal">Close</button>
	      </div>
	  	</div>
	  </div>
	</div>

	<!-- Success -->
	<div id="successmessage" class="modal fade" role="dialog">
	  <div class="modal-dialog">
	  	<div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal">&times;</button>
	        <h4 class="modal-title">Success</h4>
	      </div>
	      <div class="modal-body">
	        <p class="text-center">Successfully sent your message to Copya Ilonggo! You can check for their reply <a href="service-request.php">here</a></p>	      
	      </div>
	      <div class="modal-footer">
	      	<button type="button" class="btn btn-default dude" data-dismiss="modal">Close</button>
	      </div>
	  	</div>
	  </div>
	</div>

	<div id="servicerequest" class="modal fade" role="dialog">
	  <div class="modal-dialog">
	  	<div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal">&times;</button>
	        <h4 class="modal-title"><span class="glyphicon glyphicon-envelope"></span> Services Request</h4>
	      </div>
	      <div class="modal-body">
	        <form class="form-horizontal">
	        	<div class="form-group">
	        		<label class="control-label col-sm-2" for="message">Message:</label>
				    <div class="col-sm-10">
				    	<input type="hidden" id="user_id" value="<?php echo $id ?>"> 
				    	<input type="hidden" id="user" value="<?php echo $login_fullname ?>">
				        <textarea class="form-control" rows="5" id="message"></textarea>
				        <h4><small id="change">Note: This message will be forwarded to Copya Ilonggo. You can check their replies in your dashboard.</small></h4>
				    </div>
	        	</div>
	        </form>      
	      </div>
	      <div class="modal-footer">
	      	<button type="button" class="btn btn-primary sendmessage">Send</button>
	      	<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
	      </div>
	  	</div>
	  </div>
	</div>

	<!-- Fail -->
	<div id="fail" class="modal fade" role="dialog">
	  <div class="modal-dialog">
	  	<div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal">&times;</button>
	        <h4 class="modal-title">Unsuccessful</h4>
	      </div>
	      <div class="modal-body">
	        <p>Please make sure that you filled up the purchase field and made sure its quantity is not more than the remaining stocks.</p>	      
	      </div>
	      <div class="modal-footer">
	      	<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	      </div>
	  	</div>
	  </div>
	</div>

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
	      		<li><a data-toggle='modal' data-target='#servicerequest'><span class="glyphicon glyphicon-envelope"></span> Service Request</a></li>
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
		  <li class="breadcrumb-item"><a href="user-dashboard.php">Home</a></li>
		  <li class="breadcrumb-item active"><span><?php echo $login_fullname; ?>'s Dashboard</span></li>
		</ol>
		<div class="dashboard-container">
			<div class="dashboard-icons">
				<a href="user-account-settings.php"><img src="img/icons/user.png" class="img-responsive">
				<h4 class="text-center"><small>User Profile</small></h4></a>
			</div>
			<div class="dashboard-icons">
				<a href="user-cart.php"><img src="img/icons/cart.png" class="img-responsive">
				<h4 class="text-center"><small>My Cart</small></h4></a>
			</div>		
			<div class="dashboard-icons">
				<a href="user-reserved.php"><img src="img/icons/reserve.png" class="img-responsive">
				<h4 class="text-center"><small>Reserved Items</small></h4></a>
			</div>
			<div class="dashboard-icons">
				<a href="user-onhand.php"><img src="img/icons/onhand.png" class="img-responsive">
				<h4 class="text-center"><small>On Hand Rental</small></h4></a>
			</div>
			<div class="dashboard-icons">
				<a href="service-request.php"><img src="img/icons/support.png" class="img-responsive">
				<h4 class="text-center"><small>Customer Support</small></h4></a>
			</div>
		</div>
	</div>
	
	<footer>
	    <div class="footer-bottom">
	        <div class="container">
	        	<div class="row">
	        		<div class="col-xs-12 col-md-6 col-lg-6">
	        			<p class="text-center"> Copyright © Copya Ilonggo. All right reserved. </p>
	        		</div>
	        		<div class="col-xs-12 col-md-6 col-lg-6">
	        			<p><span class="glyphicon glyphicon-phone"></span> +63 929 688 7257 &nbsp <span class="glyphicon glyphicon-envelope"></span> <a href="mailto:copyailonggo@gmail.com?subject=Feedback">copyailonggo@gmail.com</a> &nbsp <span class="	glyphicon glyphicon-globe"></span> https://wwww.copyailonggo.com </p>
	        		</div>
	        	</div>
	        </div>
	    </div>
	</footer>
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
	</script>
</body>
</html>