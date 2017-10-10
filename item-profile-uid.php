<?php
	include('session.php');
	if(!isset($_SESSION['login_user'])){
	  header("location:index.php");
	}

	$con = mysqli_connect("localhost","root","","ci");
	$id = $_REQUEST['id'];  /* Transformed */ $changed = str_replace("-","",$id);
	$serial = $_REQUEST['serial'];
	$itemid = $_REQUEST['itemid'];

	$ses_sql = mysqli_query($con,"SELECT * FROM inventory WHERE id = '$itemid'");
	$row = mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);
	$name = $row['equipment_name'];


	$query2 = mysqli_query($con,"SELECT * FROM inventory_uid WHERE id = '$changed'");
	$row_1 = mysqli_fetch_array($query2,MYSQLI_ASSOC);
	$status = $row_1['status'];
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
	        <h4 class="modal-title"><span class="glyphicon glyphicon-envelope"></span> Comment</h4>
	      </div>
	      <div class="modal-body">
	        <form class="form-horizontal">
	        	<div class="form-group">
	        		<label class="control-label col-sm-2" for="comment">Comment:</label>
				    <div class="col-sm-10">
				    	<input type="hidden" id="equipment_uid" value="<?php echo $id ?>"> 
				    	<input type="hidden" id="user" value="<?php echo $login_fullname ?>">
				        <textarea class="form-control" rows="5" id="comment" placeholder="Comment down the status of the borrowed item here. For Example: Defects, Broken Parts and Other Issues encountered during the time frame of it being borrowed."></textarea>
				    </div>
	        	</div>
	        	<div class="form-group">
	        		<label class="control-label col-sm-2" for="message">Borrowed:</label>
				    <div class="col-sm-10">
				    	<input type="date" id="borrowed" class="form-control"> 
				        <h4><small id="change">Note: This will be displayed throughout the site every time a user checks on the profile of this item.</small></h4>
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
		  <li class="breadcrumb-item"><a href="user-dashboard.php">Home</a></li>
		  <li class="breadcrumb-item"><a href="item-profile.php">Items For Rent</a></li>
		  <li class="breadcrumb-item active"><span> UID <?php echo $id; ?></span></li>
		</ol>
		<div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
			<div class="user-profile-pic">
				<img src="img/serial/<?php echo $id;?>.jpg" class="img-responsive" onerror="src='img/icons/not-available.jpg'" >
			</div>
			<div class="bordify data-profile-container" style="text-align: left; padding: 10px; border-radius: 0px; margin-top: 10px;">
				<h4>Basic Details:</h4>
				<span><strong>Item: </strong></span><span><?php echo $row['equipment_name']; ?></span><br>
				<span><strong>UID: </strong></span><span><?php echo $id ?></span><br>
				<span><strong>Serial: </strong></span><span><?php echo $serial ?></span><br>
				<span><strong>Price: </strong></span><span>₱ <?php echo $row['price']; ?></span><hr>
				<span><strong>Description: </strong></span><span><?php echo $row['description']; ?></span>
			</div>
			<div class="bordify data-profile-container" style="text-align: left; padding: 10px; border-radius: 0px; margin-top: 10px;">
				<h4>Legend:</h4>
				<span><strong><span class="label label-success">Fine Condition</span></strong></span><span><br>Very good condition and has not been repaired</span><hr style="margin-top: 5px; margin-bottom: 5px;">
				<span><strong><span class="label label-danger">Undergone Repair</span></strong></span><span><br>Good condition but has undergone repair</span><br>
			</div>
		</div>
		<div class="col-xs-12 col-sm-12 col-md-9 col-lg-9">
			<div class="row">
				<div class="col-md-8">
					<h3><?php echo $name . " <small> UID " . $id?><br>
						<?php 
							if($status == '1') { echo '<span class="label label-success" data-toggle="tooltip" data-placement="bottom" title="Very good condition and has not been repaired">Fine Condition</span>'; }
							else { echo '<span class="label label-danger" data-toggle="tooltip" data-placement="bottom" title="Good condition but has undergone repair">Undergone Repair</span>'; }
						?>
					</small></h3>
				</div>
				<div class="col-md-4" style="text-align: right;">
					<button class="btn btn-primary btn-sm" style="margin-top: 20px" data-toggle="modal" data-target="#servicerequest">Reserve</button>
					<button class="btn btn-success btn-sm" style="margin-top: 20px" data-toggle="modal" data-target="#servicerequest"><span class="glyphicon glyphicon-plus"></span> New Comment</button>
				</div>
			</div><hr>
			<h3>Comments</h3>
			<?php 
				$results = mysqli_query($con, "SELECT * FROM inventory_view WHERE uid = '$id'");
				foreach ($results as $row){
					$sent = date('F j, Y g:i A', strtotime($row['sent']));
					$borrowed = date('F j, Y', strtotime($row['borrowed']));
					echo '<div class="row">';
					echo '<div class="col-xs-12 col-sm-12 col-md-2 col-lg-2">';
					echo '<a href="#" class="thumbnail">';
					echo '<img src="img/uploads/'.$row['user'].'.jpg" class="img-responsive" onerror="src=\'img/icons/not-available.jpg\'">';
					echo '</a>';
					echo '</div>';
					echo '<div class="col-xs-12 col-sm-12 col-md-10 col-lg-10">';      
					echo '<h4>'.$row['user'].' <small>'.$sent.'</small></h4>';
					echo '<p>'.$row['comments'].'</p>';
					echo '<h5><strong>Date Borrowed: '.$borrowed.'</strong></h5>';
					echo '</div>';
					echo '</div><hr>';
				}
			?>
		</div>
	</div>
	<script src="js/jquery-3.1.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script>
		$(document).ready(function(){
		    $('[data-toggle="tooltip"]').tooltip(); 
		});
	</script>
	<script type="text/javascript">
		$(document).on("click", ".sendmessage", function() {
			var dude = document.getElementById('equipment_uid').value;
			var user = document.getElementById('user').value; 
			var comment = document.getElementById('comment').value;
			var borrowed = document.getElementById('borrowed').value;

			var equipment_uid = dude.replace(/-/g, "");
			
			alert(comment + " " + equipment_uid + " " + borrowed + " " + user);
			$.ajax({type:"POST",url:"ajax.php",
			data: {
				equipment_uid, equipment_uid,
				user:user,
				comment:comment,
				borrowed: borrowed,
				action:"comment"
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



