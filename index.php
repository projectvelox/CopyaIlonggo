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
	<style type="text/css">
		body { background-image: url(img/bg.jpg); background-size: cover; background-repeat: no-repeat; }
		.aboutus { padding: 25px;  background-color: #8c4f0e; color: white; }
		.carousel-inner>.item>a>img, .carousel-inner>.item>img, .img-responsive, .thumbnail a>img, .thumbnail>img { display: block; max-width: 100%; height: auto; width: 100%; }
		.navbar-inverse { border-color: #8c4f0e; }
		.footer-bottom { background-color: #8c4f0e; border-top: 1px solid #eee5e6; color: #ffffff; }
	</style>
	<div id="myModal" class="modal fade" role="dialog">
	  <div class="modal-dialog">

	    <!-- Modal content-->
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal">&times;</button>
	        <h4 class="modal-title"><span class="glyphicon glyphicon-log-in"></span> Login</h4>
	      </div>
	      <div class="modal-body">
	      	<form action="login.php" method="post">
		        <p style="color: #8c8c8c;"><small>Note: Only the admin can register, and reset the password of an account.</small></p>
		        <div class="input-group">
		          <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span> </span>
		          <input type="text" id="username" class="form-control" name="username" placeholder="Username" required />
		        </div><br>
		        <div class="input-group">
		          <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span> </span>
		          <input type="password" id="password" class="form-control" name="password" placeholder="Password" required />
		        </div>
		      </div>
		      <div class="modal-footer">
		        <input type="submit" id="login_form_submit_btn" name="submit" data-loading-text="Logging in..." class="btn btn-primary" value="Login"/>
	        </form>
	      </div>
	    </div>
	  </div>
	</div>

	<!-- Modal -->
	<div id="application" class="modal fade" role="dialog">
	  <div class="modal-dialog">

	    <!-- Modal content-->
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal">&times;</button>
	        <h4 class="modal-title">Feature Unavailable</h4>
	      </div>
	      <div class="modal-body">
	        <p>This feature has been temporarily disabled. Please see <a href="www.google.com">www.google.com</a> for more info</p>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
	      </div>
	    </div>

	  </div>
	</div>

	<!-- Modal -->
	<div id="loginNotice" class="modal fade" role="dialog">
	  <div class="modal-dialog">

	    <!-- Modal content-->
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal">&times;</button>
	        <h4 class="modal-title">Login Required</h4>
	      </div>
	      <div class="modal-body">
	        <p>In order for you to access this page's feauture, you must be logged in to an account. If you don't have an account please register first. If you have one already please login</p>
	      </div>
	      <div class="modal-footer">
		    <button type="button" class="btn btn-primary register">Register</button>
	        <button type="button" class="btn btn-primary login">Login</button>
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
	      <a class="navbar-brand" href="index.php"><img src="img/logo.png" height="20" style="display: inline-block;"> Copya Ilonggo</a>
	    </div>
	    <div id="navbar"  class="navbar-collapse collapse navbar-right">
	      	<ul class="nav navbar-nav">
		        <li><a href="registration.php"><span class="glyphicon glyphicon-user"></span> Registration</a></li>
		        <li><a href="#" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
	        </ul>
	    </div>
	  </div>
	</nav>
 
    <div id="myCarousel" class="carousel slide" data-ride="carousel">
 
      <!-- Wrapper for slides -->
      <div class="carousel-inner">
      
        <div class="item active">
          <img src="img/slider/2.jpg">
        </div><!-- End Item -->
 
        <div class="item">
          <img src="img/slider/1.jpg">
        </div><!-- End Item -->
                
      </div><!-- End Carousel Inner -->
	</div>
	<div class="aboutus">
		<div class="row" style="margin-top: -15px;">
			<div class="col-xs-12 col-md-6 col-lg-6">
				<h2>About Us</h2>
				<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
			</div>
			<div class="col-xs-12 col-md-6 col-lg-6">
				<h2>History</h2>
				<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
			</div>
		</div>
	</div>
	<div class="container cswd-container">
		<div class="row text-center" style="border: 1px solid #ddd; padding: 20px; margin-left: 0px; margin-right: 0px; margin-top: -30px; background-color: #fff">
			<h2 id="ci-header">Services</h2>
			<?php
				$con = mysqli_connect("localhost","root","","ci");
				$result = mysqli_query($con,"SELECT * FROM Inventory WHERE type='Services' AND status='Active' ORDER BY id DESC");
					while($row = mysqli_fetch_array($result))
					{
						echo "<div class='col-xs-12 col-sm-6 col-md-3 col-lg-3'>";
						echo "<div class='panel panel-default cswd-panel' id='ci-photocopier' style='height: 190px; padding-top: 10px;'>";
						echo "<div class='panel-body'>";
						echo "<img src='img/img-1.jpg' height='40'>";
						echo "<h4>" . $row['equipment_name'] . "</h4>";
						echo "<h5><small>Renting Price: " . $row['price'] . " Peso / Per Page</small></h5>";
						echo "<button class='btn btn-sm btn-primary' data-toggle='modal' data-target='#loginNotice'>Show More</button>";
						echo "</div>";
						echo "</div>";
						echo "</div>";
					}
					mysqli_close($con);
			?>
		</div>
	</div>
	<?php
  	    $con = mysqli_connect("localhost","root","","ci");
  	    $sql1 = "SELECT DISTINCT type_1 FROM inventory";
  	    $result = $con->query($sql1);
  		foreach ($result as $row)
		{
			$type_1 = $row['type_1'];
			$sql2 = "SELECT * FROM inventory WHERE type_1='$type_1' AND status='Active' AND type='Inventory'";
			$result1 = $con->query($sql2);
			if($type_1=='Brand New') { $type_1 = 'Items for Sale'; }
			if($type_1=='2nd Hand') { $type_1 = 'Items for Rent'; }
			echo '<div class="container" style="margin-top: 15px">';
			echo '<div class="row text-center" style="border: 1px solid #ddd; padding: 20px; margin-left: 0px; margin-right: 0px; margin-top: -30px; background-color: #fff"">';
			echo '<h2 id="ci-header">' . $type_1 . '</h2>';
			foreach ($result1 as $row)
			{
				echo '<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">';
				echo '<div class="panel panel-default cswd-panel" id="ci-photocopier" style="height: 200px; padding-top: 0px;">';
				echo '<div class="panel-body">';
				echo '<img src="img/products/'.$row['equipment_name'].'.jpg" height="40" onerror="src=\'img/icons/not-available.jpg\'">';
				echo '<h4>' . $row['equipment_name'] . '</h4>';
				if ($row['type_1'] == 'Brand New') { echo '<h5><small>Selling Price: ' . $row['price'] . ' Pesos / Item</small></h5>'; }
				if ($row['type_1'] == '2nd Hand') { echo '<h5><small>Renting Price: ' . $row['price'] . ' Pesos / Month</small></h5>'; }
				echo '<span class="label label-success">'; if($row['type_1'] == 'Brand New') { echo "Brand New"; } else { echo "Second Hand"; } echo '</span>';
				if ($row['type_1'] == 'Brand New') { echo '<hr style="margin: 10px 0px;"><button class="btn btn-primary btn-xs" data-toggle="modal" data-target="#loginNotice">Reserve to Purchase</button>&nbsp'; }
				if ($row['type_1'] == '2nd Hand') { echo '<hr style="margin: 10px 0px;"><button class="btn btn-primary btn-xs" data-toggle="modal" data-target="#loginNotice">Reserve to Rent</button>'; }

				echo '</div>';
				echo '</div>';
				echo '</div>';
			}	
			echo '</div>';
			echo '<div class="text-right" style="border: 1px solid #ddd; border-top: 0px; background-color: #eee; padding: 5px;">';
			echo '<button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#loginNotice">Show More</button>';
			echo '</div>';
			echo '</div><br><br>';
		}
	?><br><br>
	<footer>
	    <div class="footer-bottom">
	        <div class="container">
	        	<div class="row">
	        		<div class="col-xs-12 col-md-6 col-lg-6">
	        			<p class="text-center"> Copyright © Copya Ilonggo. All right reserved. </p>
	        		</div>
	        		<div class="col-xs-12 col-md-6 col-lg-6">
	        			<p><span class="glyphicon glyphicon-phone"></span> +63 929 688 7257 &nbsp <span class="glyphicon glyphicon-envelope"></span> <a href="mailto:<a href="mailto:copyailonggo@gmail.com?subject=Feedback" style="color: #fff;">copyailonggo@gmail.com</a></a> &nbsp <span class="glyphicon glyphicon-globe"></span> https://wwww.copyailonggo.com </p>
	        		</div>
	        	</div>
	        </div>
	    </div>
	</footer>
	<script src="js/jquery-3.1.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script type="text/javascript" src="js/carousel.js"></script>
	<script type="text/javascript">
		$(document).ready( function() {
		    $('#myCarousel').carousel({
		        interval:   2000
			});
		});

		$(document).on("click", ".login", function() { 
			$('#loginNotice').modal('hide');
			$('#myModal').modal('show');  
		});

		$(document).on("click", ".register", function() { 
			$('#loginNotice').modal('hide');
			window.location.assign('registration.php'); 
		});
	</script>
</body>
</html>