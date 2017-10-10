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
	<style type="text/css"> .breadcrumb { margin-left: 0px; margin-right: 0px; } .bordify { margin-left: 0px; } </style>
	<!-- Success -->
	<div id="success" class="modal fade" role="dialog">
	  <div class="modal-dialog">
	  	<div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal">&times;</button>
	        <h4 class="modal-title">Success</h4>
	      </div>
	      <div class="modal-body">
	        <p>Successfully edit your profile.</p>	      
	      </div>
	      <div class="modal-footer">
	      	<button type="button" class="btn btn-default dude" data-dismiss="modal">Close</button>
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
		  <li class="breadcrumb-item"><a href="user-account-dashboard.php">Dashboard</a></li>
		  <li class="breadcrumb-item active"><span><?php echo $login_fullname; ?>'s Profile</span></li>
		</ol>
		<div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
			<div class="user-profile-pic">
				<img src="img/uploads/<?php echo $login_fullname;?>.jpg" class="img-responsive" onerror="src='img/icons/not-available.jpg'" >
			</div>
			<div class="input-group" style="margin-top: 5px;">
                <label class="input-group-btn">
                    <span class="btn btn-primary">
                        Browse… <input id="file" type="file" name="file" style="display: none;" />
                    </span>
                </label>
                <input type="text" class="form-control" readonly="">
            </div>
            <div class="bordify" style="text-align: center; padding: 10px; margin-top: 10px; border-radius: 0px;">
            	<h4 class="text-left">Address</h4>
            	<div id="map-canvas" style="height: 200px; margin-bottom: 10px;"></div>
            	<span><strong>Address: </strong></span><span><?php echo $address; ?></span><br>
            </div>
			<div class="bordify data-profile-container" style="text-align: left; padding: 10px; border-radius: 0px;">
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
			<div class="bordify edit-profile-container" style="text-align: left; padding: 10px; border-radius: 0px;">
				<h4>Account Details:</h4>
				<div class="form-group">
				  <label for="password">Password:</label>
				  <input type="password" class="form-control" id="password" value="<?php echo $password; ?>">
				</div>
				<h4>Basic Details:</h4>
				<input type="hidden" id="id" value="<?php echo $id; ?>">
				<div class="form-group">
				  <input type="text" class="form-control" id="sex" value="<?php echo $sex; ?>">
				</div>
				<div class="form-group">
				  <input type="date" class="form-control" id="age" value="<?php echo $age; ?>">
				</div>
				<h4>Contact Details:</h4>
				<div class="form-group">
				  <input type="text" class="form-control" id="contact" value="<?php echo $contact; ?>">
				</div>
			</div>

			<button class="btn btn-primary edit-profile"><span class="glyphicon glyphicon-pencil"></span> Edit Profile</button>
			<button class="btn btn-danger cancel-edit"><span class="glyphicon glyphicon-remove"></span> Cancel</button>
			<button class="btn btn-success save-edit"><span class="glyphicon glyphicon-ok"></span> Save</button>
			<hr>
		</div>
		<div class="col-xs-12 col-sm-12 col-md-9 col-lg-9">
		
			<!-- Boxes -->
			<div class="profile-summary-container">
				<h3>Summary</h3>
				<div class="row" style="margin-left: 0px; margin-right: 0px;">
				<div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
				<?php
					$con = mysqli_connect("localhost","root","","ci");
					$result = mysqli_query($con,"SELECT COUNT(equipment_name) AS reserved FROM user_cart WHERE user='$login_fullname' AND (status = 'Reserved' OR status ='Claimed')");
					$result1 = mysqli_query($con,"SELECT COUNT(equipment_name) AS reserved FROM borrower_cart WHERE name='$login_fullname' AND (status = 'Reserved' OR status ='On Hand' OR status='Returned')");
					$row=mysqli_fetch_assoc($result);
					$row1=mysqli_fetch_assoc($result1);

					$total = $row['reserved'] + $row1['reserved'];
					
					echo '<div class="bordify">';
					echo '<h5>Total Items Reserved</h5>';
					echo '<h4>'. $total .' Items</h4>';
					echo '</div>';
				?>
				</div>

				<div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
				<?php
					$con = mysqli_connect("localhost","root","","ci");
					$result = mysqli_query($con,"SELECT COUNT(equipment_name) AS reserved FROM user_cart WHERE user='$login_fullname' AND (status = 'Reserved')");
						while($row = mysqli_fetch_array($result))
						{
							echo '<div class="bordify">';
							echo '<h5>Reserved for Purchase</h5>';
							echo '<h4>' . $row['reserved'] . ' Items</h4>';
							echo '</div>';
						}
				?>
				</div>

				<div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
				<?php
					$con = mysqli_connect("localhost","root","","ci");
					$result = mysqli_query($con,"SELECT COUNT(equipment_name) AS reserved FROM borrower_cart WHERE name='$login_fullname' AND (status = 'Reserved')");
						while($row = mysqli_fetch_array($result))
						{
							echo '<div class="bordify">';
							echo '<h5>Reserved for Rent</h5>';
							echo '<h4>' . $row['reserved'] . ' Items</h4>';
							echo '</div>';
						}
				?>
				</div>

				<!-- FOR THE FUTURE PURPOSE WHERE YOU CAN RENT ITEM NA!!! -->
				<div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
				<?php
					$con = mysqli_connect("localhost","root","","ci");
					$result = mysqli_query($con,"SELECT COUNT(equipment_name) AS rented FROM borrower_cart WHERE name='$login_fullname' AND (status='On Hand' OR status='Returned')");
						while($row = mysqli_fetch_array($result))
						{
							echo '<div class="bordify">';
							echo '<h5>Total Rented</h5>';
							echo '<h4>' . $row['rented'] . ' Items</h4>';
							echo '</div>';
						}
				?>
				</div>

				<!-- FOR THE FUTURE PURPOSE WHERE YOU CAN RENT ITEM NA!!! -->
				<div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
				<?php
					$con = mysqli_connect("localhost","root","","ci");
					$result = mysqli_query($con,"SELECT COUNT(equipment_name) AS onhand FROM borrower_cart WHERE name='$login_fullname' AND status='On Hand'");
						while($row = mysqli_fetch_array($result))
						{
							echo '<div class="bordify">';
							echo '<h5>On hand Rental</h5>';
							echo '<h4>' . $row['onhand'] . ' Items</h4>';
							echo '</div>';
						}
				?>
				</div>
				<!-- FOR THE FUTURE PURPOSE WHERE YOU CAN RENT ITEM NA!!! -->
				<div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
				<?php
					$con = mysqli_connect("localhost","root","","ci");
					$result = mysqli_query($con,"SELECT SUM(price) AS price FROM user_cart WHERE user='$login_fullname' AND status='Claimed'");
					$result1 = mysqli_query($con,"SELECT SUM(total_price) AS total_price FROM borrower_cart WHERE name='$login_fullname'AND (status='Returned' OR status ='On Hand')");
					$row=mysqli_fetch_assoc($result);
					$row1=mysqli_fetch_assoc($result1);

					$total = $row['price'] + $row1['total_price'];
					
					echo '<div class="bordify">';
					echo '<h5>Spent on Purchase</h5>';
					echo '<h4>₱ '. number_format($row['price'], 2) .'</h4>';
					echo '</div>';
					
				?>
				</div>
				<!-- FOR THE FUTURE PURPOSE WHERE YOU CAN RENT ITEM NA!!! -->
				<div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
				<?php
					$con = mysqli_connect("localhost","root","","ci");
					$result = mysqli_query($con,"SELECT SUM(price) AS price FROM user_cart WHERE user='$login_fullname' AND status='Claimed'");
					$result1 = mysqli_query($con,"SELECT SUM(total_price) AS total_price FROM borrower_cart WHERE name='$login_fullname'AND (status='Returned' OR status ='On Hand')");
					$row=mysqli_fetch_assoc($result);
					$row1=mysqli_fetch_assoc($result1);

					$total = $row['price'] + $row1['total_price'];
					
					echo '<div class="bordify">';
					echo '<h5>Spent on Rent</h5>';
					echo '<h4>₱ '. number_format($row1['total_price'], 2) .'</h4>';
					echo '</div>';
					
				?>
				</div>
				<!-- FOR THE FUTURE PURPOSE WHERE YOU CAN RENT ITEM NA!!! -->
				<div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
				<?php
					$con = mysqli_connect("localhost","root","","ci");
					$result = mysqli_query($con,"SELECT SUM(price) AS price FROM user_cart WHERE user='$login_fullname' AND status='Claimed'");
					$result1 = mysqli_query($con,"SELECT SUM(total_price) AS total_price FROM borrower_cart WHERE name='$login_fullname'AND (status='Returned' OR status ='On Hand')");
					$row=mysqli_fetch_assoc($result);
					$row1=mysqli_fetch_assoc($result1);

					$total = $row['price'] + $row1['total_price'];
					
					echo '<div class="bordify">';
					echo '<h5>Accumulated Expense</h5>';
					echo '<h4>₱ '. number_format($total, 2) .'</h4>';
					echo '</div>';
					
				?>
				</div>

				</div>
			</div><hr>

			<!-- Statistic L:OLOLOLOLOL MANOL KO MO -->
			<div class="profile-statistic-container">
				<h3>Reports</h3>
				<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
					<canvas id="myChart1" width="400" height="400"></canvas>
				</div>
				<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
					<canvas id="myChart" width="400" height="400"></canvas>
				</div>
				
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
	<script type="text/javascript">
      function initMap(){
        var map = new google.maps.Map(document.getElementById('map-canvas'),{
          center:{
            lat: <?php echo $lat ?>,
            lng: <?php echo $lng ?>
          },
          zoom: 15
        });

        var marker = new google.maps.Marker({
          position:{
            lat: <?php echo $lat ?>,
            lng: <?php echo $lng ?>
          },
          map: map,
          animation: google.maps.Animation.BOUNCE,
          title: 'This is where you live'
        });
    }
    </script>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBhBuIWDfjqk26jnvuR95_-ZHXhFV7dcdA&libraries=places&callback=initMap"></script>
	<script src="js/jquery-3.1.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script type="text/javascript" src="js/carousel.js"></script>
	<script src="js/Chart.bundle.min.js"></script>

	<script type="text/javascript">
		function uploadFile(){
		  var input = document.getElementById("file");
		  file = input.files[0];
		  if(file != undefined){
		    formData= new FormData();
		    if(!!file.type.match(/image.*/)){
		      var name = '<?php echo $login_fullname;?>';
		      formData.append("image", file, name + '.jpg');
		      $.ajax({
		        url: "uploads.php",
		        type: "POST",
		        data: formData,
		        processData: false,
		        contentType: false
		    	}).then(function(data) {
				    alert(data);
		      });
		    } else { alert('Not a valid image!'); }
		  	} else { alert('Input something!'); }
		}

		$(document).ready(function(){
			$(".edit-profile-container").hide();
			$(".save-edit").hide();
			$(".cancel-edit").hide();
		});

		$(document).on("click", ".edit-profile", function() {
			$(".data-profile-container").hide();
			$(".edit-profile").hide();  
			$(".cancel-edit").show();
			$(".save-edit").show();
			$(".edit-profile-container").show();
		});

		$(document).on("click", ".cancel-edit", function() {
			$(".edit-profile-container").hide();
			$(".save-edit").hide();
			$(".cancel-edit").hide();
			$(".data-profile-container").show();
			$(".edit-profile").show();  
		});

		$(document).on("click", ".save-edit", function() {
			var id = document.getElementById('id').value;
			var password = document.getElementById('password').value;
			var sex = document.getElementById('sex').value;
			var age = document.getElementById('age').value;
			var contact = document.getElementById('contact').value;

			$.ajax({type:"POST",url:"ajax.php",
				data: {
					id:id,
					password:password,
					sex:sex,
					age:age,
					contact:contact,
					action: "edit_profile_save",
				},
			    }).then(function(data) {
			    	uploadFile();
			    	$('#success').modal('show');
			    });
		});

		$(document).on("click", ".dude", function() { location.reload() });
	</script>
	<script>
		var ctx = document.getElementById("myChart");
		var myChart = new Chart(ctx, {
		    type: 'line',
		    data: { 
		        labels: [<?php  
		        	$con = mysqli_connect("localhost","root","","ci");
					$sql = "SELECT DISTINCT DATE_FORMAT(date_borrowed, '%Y') as date_borrowed FROM borrower_cart WHERE name='$login_fullname' AND (status='On Hand' OR  status='Returned') ORDER BY date_borrowed ASC";
			  	    $result = $con->query($sql);
			  		
			  		foreach ($result as $row)
					{
						$month = $row['date_borrowed'];
						$sql1 = "SELECT FORMAT(SUM(total_price), 2) AS sum FROM borrower_cart WHERE name='$login_fullname' AND DATE_FORMAT(date_borrowed, '%Y')='$month' AND (status='On Hand' OR  status='Returned')";
				  	    $result = $con->query($sql1);
				  	    foreach ($result as $rows){
				  	 		echo '"'.$month.'",';
				  	    }
					}
		        ?>],
		        datasets: [{
		            label: 'Statistical Rental Report - Expense   ',
		            data: [<?php  
		        	$con = mysqli_connect("localhost","root","","ci");
					$sql = "SELECT DISTINCT DATE_FORMAT(date_borrowed, '%Y') as date_borrowed FROM borrower_cart WHERE name='$login_fullname' AND (status='On Hand' OR  status='Returned') ORDER BY date_borrowed ASC";
			  	    $result = $con->query($sql);
			  		
			  		foreach ($result as $row)
					{
						$month = $row['date_borrowed'];
						$sql1 = "SELECT SUM(total_price) AS sum FROM borrower_cart WHERE name='$login_fullname' AND DATE_FORMAT(date_borrowed, '%Y')='$month' AND (status='On Hand' OR  status='Returned')";
				  	    $result = $con->query($sql1);
				  	    foreach ($result as $rows){
				  	 		echo '"'.$rows['sum'].'",';
				  	    }
					}
		        	?>],
		            backgroundColor: [
		                'rgba(255, 99, 132, 0.2)',
		                'rgba(54, 162, 235, 0.2)',
		                'rgba(255, 206, 86, 0.2)',
		                'rgba(75, 192, 192, 0.2)',
		                'rgba(153, 102, 255, 0.2)',
		                'rgba(255, 159, 64, 0.2)'
		            ],
		            borderColor: [
		                'rgba(255,99,132,1)',
		                'rgba(54, 162, 235, 1)',
		                'rgba(255, 206, 86, 1)',
		                'rgba(75, 192, 192, 1)',
		                'rgba(153, 102, 255, 1)',
		                'rgba(255, 159, 64, 1)'
		            ],
		            borderWidth: 1
		        }]
		    },
		    options: {
		        scales: {
		            yAxes: [{
		                ticks: {
		                    beginAtZero:true
		                }
		            }]
		        }
		    }
		});
	</script>
	<script>
		var chart2 = document.getElementById("myChart1");
		var myChart2 = new Chart(chart2, {
		    type: 'line',
		    data: { 
		        labels: [<?php  
		        	$con = mysqli_connect("localhost","root","","ci");
					$sql = "SELECT DISTINCT DATE_FORMAT(transaction_date, '%Y') as transaction_date FROM user_cart WHERE user='$login_fullname' AND status='Claimed'  ORDER BY transaction_date ASC";
			  	    $result = $con->query($sql);
			  		
			  		foreach ($result as $row)
					{
						$month = $row['transaction_date'];
						$sql1 = "SELECT FORMAT(SUM(price), 2) AS sum FROM user_cart WHERE user='$login_fullname' AND DATE_FORMAT(transaction_date, '%Y')='$month' AND status='Claimed'";
				  	    $result = $con->query($sql1);
				  	    foreach ($result as $rows){
				  	 		echo '"'.$month.'",';
				  	    }
					}
		        ?>],
		        datasets: [{
		            label: 'Statistical Purchase Report - Expense',
		            data: [<?php  
		        	$con = mysqli_connect("localhost","root","","ci");
					$sql = "SELECT DISTINCT DATE_FORMAT(transaction_date, '%Y') AS transaction_date FROM user_cart WHERE user='$login_fullname' AND status='Claimed' ORDER BY transaction_date ASC";
			  	    $result = $con->query($sql);
			  		
			  		foreach ($result as $row)
					{
						$month = $row['transaction_date'];
						$sql1 = "SELECT SUM(price) AS sum FROM user_cart WHERE user='$login_fullname' AND DATE_FORMAT(transaction_date, '%Y')='$month' AND status='Claimed'";
				  	    $result = $con->query($sql1);
				  	    foreach ($result as $rows){
				  	 		echo '"'.$rows['sum'].'",';
				  	    }
					}
		        	?>],
		            backgroundColor: [
		                'rgba(255, 99, 132, 0.2)',
		                'rgba(54, 162, 235, 0.2)',
		                'rgba(255, 206, 86, 0.2)',
		                'rgba(75, 192, 192, 0.2)',
		                'rgba(153, 102, 255, 0.2)',
		                'rgba(255, 159, 64, 0.2)'
		            ],
		            borderColor: [
		                'rgba(255,99,132,1)',
		                'rgba(54, 162, 235, 1)',
		                'rgba(255, 206, 86, 1)',
		                'rgba(75, 192, 192, 1)',
		                'rgba(153, 102, 255, 1)',
		                'rgba(255, 159, 64, 1)'
		            ],
		            borderWidth: 1
		        }]
		    },
		    options: {
		        scales: {
		            yAxes: [{
		                ticks: {
		                    beginAtZero:true
		                }
		            }]
		        }
		    }
		});
		
	</script>
</body>
</html>