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
	<style> #map-canvas { height: 300px; } </style>
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
	<div id="policy" class="modal fade" role="dialog">
	  <div class="modal-dialog" style="width: 80%;">

	    <!-- Modal content-->
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal">&times;</button>
	        <h4 class="modal-title">Terms and Condition</h4>
	      </div>
	      <div class="modal-body"><i>
	        <ol>
	        	<li>The Intellectual Property disclosure will inform users that the contents, logo and other visual media you created is your property and is protected by copyright laws.</li>
				<li>A Termination clause will inform that users’ accounts on your website and mobile app or users’ access to your website and mobile (if users can’t have an account with you) can be terminated in case of abuses or at your sole discretion.</li>
				<li>A Governing Law will inform users which laws govern the agreement. This should the country in which your company is headquartered or the country from which you operate your website and mobile app.</li>
				<li>A Links To Other Web Sites clause will inform users that you are not responsible for any third party websites that you link to. This kind of clause will generally inform users that they are responsible for reading and agreeing (or disagreeing) with the Terms and Conditions or Privacy Policies of these third parties.</li>
				<li>If your website or mobile app allows users to create content and make that content public to other users, a Content section will inform users that they own the rights to the content they have created.</li>
				<li>The “Content” clause usually mentions that users must give you (the website or mobile app developer) a license so that you can share this content on your website/mobile app and to make it available to other users.</li>
				<li>Because the content created by users is public to other users, a DMCA notice clause (or Copyright Infringement ) section is helpful to inform users and copyright authors that, if any content is found to be a copyright infringement, you will respond to any DMCA takedown notices received and you will take down the content.</li>
				<li>A Limit What Users Can Do clause can inform users that by agreeing to use your service, they’re also agreeing to not do certain things. This can be part of a very long and thorough list in your Terms and Conditions agreements so as to encompass the most amount of negative uses.</li>
			</ol></i>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-primary modal-closer" data-dismiss="modal">I Understood the Terms and Condition</button>
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

	<div class="container cswd-container">
		<div class="row">
			<div class="cswd-header">
				<h1>Registration Form</h1>
			</div>
			<div class="cswd-content-container">
				<form class="form-horizontal">
				<div class="col-md-6 col-xs-12">
					  <div class="form-group">
					    <label class="control-label col-sm-4" for="username">Username:</label>
					    <div class="col-sm-8">
					      <input type="text" class="form-control" id="usernames" required placeholder="Enter Desired Username">
					    </div>
					  </div>
					  <div class="form-group">
					    <label class="control-label col-sm-4" for="password">Password:</label>
					    <div class="col-sm-8">
					      <input type="password" class="form-control" id="passwords" required placeholder="Enter Desired Password">
					    </div>
					  </div>			
					  <div class="form-group">
					    <label class="control-label col-sm-4" for="lastname">Last Name:</label>
					    <div class="col-sm-8">
					      <input type="text" class="form-control" id="lastnames" required placeholder="Enter Family Name">
					    </div>
					  </div>
					  <div class="form-group">
					    <label class="control-label col-sm-4" for="firstname">First Name:</label>
					    <div class="col-sm-8"> 
					      <input type="text" class="form-control" id="firstname" required placeholder="Enter Given Name">
					    </div>
					  </div>
					  <div class="form-group">
					    <label class="control-label col-sm-4" for="middlename">Middle Name:</label>
					    <div class="col-sm-8"> 
					      <input type="text" class="form-control" id="middlename" placeholder="Enter Middle Name">
					    </div>
					  </div>
					  <div class="form-group">
						  <label class="control-label col-sm-4" for="sex">Sex:</label>
						  <div class="col-sm-8">
							  <select class="form-control" id="sex">
							    <option></option>
							    <option>Male</option>
							    <option>Female</option>						  
							  </select>
						  </div>
					  </div>
					  <div class="form-group">
					    <label class="control-label col-sm-4" for="age">Birthdate:</label>
					    <div class="col-sm-8"> 
					      <input type="date" class="form-control" id="age" required placeholder="Enter birthdate">
					    </div>
					  </div>
					  <div class="form-group">
					    <label class="control-label col-sm-4" for="contact">Contact Number:</label>
					    <div class="col-sm-8"> 
					      <input type="text" class="form-control" id="contact" required placeholder="Enter Telephone Number">
					    </div>
					  </div>
					  <div class="form-group">
					    <label class="control-label col-sm-4" for="mailing">Mailing Address:</label>
					    <div class="col-sm-8"> 
					      <input type="text" class="form-control" id="mailing" required placeholder="Enter Exact Mailing Address">
					    </div>
					  </div>
					  <div class="form-group">
					    <label class="control-label col-sm-4" for="lat">Latitude:</label>
					    <div class="col-sm-8"> 
					      <input type="text" class="form-control" id="lat" required disabled>
					    </div>
					  </div>
					  <div class="form-group">
					    <label class="control-label col-sm-4" for="lng">Longitude:</label>
					    <div class="col-sm-8"> 
					      <input type="text" class="form-control" id="lng" required disabled>
					    </div>
					  </div>
					  <div id="map-canvas"></div>
				</div>
				<div class="col-md-6 col-xs-12">
					<h4>Create your account</h4>
					<h5><small>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla vel sagittis lorem. Donec aliquet enim non ipsum malesuada, vel congue justo pellentesque. Aliquam quis nunc quam. Nulla facilisi. Phasellus condimentum odio et finibus consequat. Nullam volutpat placerat massa a pellentesque. Etiam efficitur consectetur purus quis fringilla. Aliquam luctus augue a facilisis posuere. Pellentesque rutrum vel erat nec gravida. Nam vitae ultricies diam, vitae cursus purus. Donec vulputate vehicula urna, bibendum dictum mi ullamcorper eu. Vestibulum sed erat cursus justo ultricies pellentesque.</small></h5>
					<hr>
					<button type="button" class="btn btn-primary pull-right application">Register</button>
				</div>
				</form>
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
            lat: 10.72015,
            lng: 122.562106
          },
          zoom: 15
        });

        var marker = new google.maps.Marker({
          position:{
            lat: 10.72015,
            lng: 122.562106
          },
          map: map,
          animation: google.maps.Animation.BOUNCE,
          title: 'Drag to specify your address',
          draggable: true
        });

        var searchBox = new google.maps.places.SearchBox(document.getElementById('mailing'));

        google.maps.event.addListener(searchBox, 'places_changed', function(){
          var places = searchBox.getPlaces();

          var bounds = new google.maps.LatLngBounds();
          var i, places;

          for(i = 0; place = places[i]; i++){
            console.log(place.geometry.location);

            bounds.extend(place.geometry.location);
            marker.setPosition(place.geometry.location);
          }

          map.fitBounds(bounds);
          map.setZoom(15);

        });


        google.maps.event.addListener(marker, 'dragend', function(){
          var lat = marker.getPosition().lat();
          var lng = marker.getPosition().lng();
          $('#lat').val(lat);
          $('#lng').val(lng);
        });
    }
    </script>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBhBuIWDfjqk26jnvuR95_-ZHXhFV7dcdA&libraries=places&callback=initMap"></script>
    
	<script src="js/jquery-3.1.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
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
			var lat = document.getElementById('lat').value;
			var lng = document.getElementById('lng').value;

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
						lat:lat,
						lng:lng,
						contact:contact,
						type:"User",
						action:"create_user"
					},
				    }).then(function(data) {
				    	if (data == '1') {
							$('#fail').modal({
					        show: 'true'
						    });
				    	}
				    	else {
				    		$('#policy').modal('show');
				    	}
				    });

		});

		$("#policy").on('hidden.bs.modal', function () {
            $('#success').modal('show'); 
	    });
		
		$(document).on("click", ".modal-closer", function() { 
			location.reload();
		});

	</script>
</body>
</html>