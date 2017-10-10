<?php 
  	include('session.php');
  	include('config.php');
	if(!isset($_SESSION['login_user'])){ header("location:index.php"); }
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
	<style type="text/css">
		.form-horizontal .form-group { margin-right: -15px; margin-left: 15px; margin-top: -15px; }
		.custom-button { background-color: #d9534f; color: #fff; padding: 2px 5px; border-radius: 3px; font-size: 11px; font-weight: bold; }
		.custom-button:hover { background-color: #5cb85c; color: #fff; }
	</style>
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
	        <h4 class="modal-title">Successful Changed</h4>
	      </div>
	      <div class="modal-body">
	        <p>You have successfully changed the item's price!</p>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-primary modal-closer" data-dismiss="modal">Close</button>
	      </div>
	    </div>

	  </div>
	</div>

<!-- Show More -->
	<div id="updateserial" class="modal fade" role="dialog">
	  <div class="modal-dialog">
	  	<div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal">&times;</button>
	        <h4 class="modal-title">Update Serial</h4>
	      </div>
	      <div class="modal-body">
	      	<br>
	        <form class="form-horizontal">
	        	<div class="form-group">
	        		<label class="control-label col-sm-2" for="machine">Machine:</label>
				    <div class="col-sm-10"> 
				      <input type="text" class="form-control" id="machine" disabled>
				      <input type="hidden" class="form-control" id="uid" disabled>
				    </div>
	        	</div>
	        	<div class="form-group" style="margin-top: 3px;">
	        		<label class="control-label col-sm-2" for="serial">Serial:</label>
				    <div class="col-sm-10"> 
				       <input type="text" class="form-control" id="serial">
				    </div>
	        	</div>
	        </form>      
	      </div>
	      <div class="modal-footer">
	      	<button type="button" class="btn btn-primary updatequery">Update</button>
	      	<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
	      </div>
	  	</div>
	  </div>
	</div>

	<!-- Content -->
	<div class="container" style="margin-top: 80px;">
		<div class="row">
			<ol class="breadcrumb">
			  <li class="breadcrumb-item"><a href="admin-dashboard.php">Dashboard</a></li>
			  <li class="breadcrumb-item"><a href="admin-dashboard-inventory.php">Inventory Management</a></li>
			  <li class="breadcrumb-item"><a href="item-management.php">Item Management</a></li>
			  <li class="breadcrumb-item active"><span><?=$_REQUEST['name']?></span></li>
			</ol>
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<div class="row">
					<h3 class="col-xs-12 col-sm-12 col-md-4 col-lg-4"><?=$_REQUEST['name']?></h3> 
					<div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
						<form method="POST" action="item-management-specific.php?id=<?=$_REQUEST['id']?>&name=<?=$_REQUEST['name']?>">
						    <div class="input-group add-on">
						      <input class="form-control" placeholder="Search" name="search" type="text">
						      <div class="input-group-btn">
						        <button class="btn btn-default" type="submit" name="searchBtn"><i class="glyphicon glyphicon-search"></i></button>
						      </div>
						    </div>
					    </form>
					</div>
				</div>
				<div class="table-responsive">
					<table class="table table-striped">
						
						<?php 
							$searched = $_REQUEST['name'];
							$uid='';
						    if (isset($_POST['search'])) { 
						    	$searched = $_REQUEST['name'];
						    	$uid = $_POST['search'];
						    }

							$con = mysqli_connect("localhost","root","","ci");
							$result = mysqli_query($con, "SELECT * FROM inventory WHERE equipment_name LIKE '%".$searched."%' AND (status='Active' AND type='Inventory')");
							$status = mysqli_fetch_assoc($result);

							$i=0;

							echo "<tr>";
							echo "<th>#</th>";
							echo "<th>Machines</th>";
							echo "<th>Serial Number</th>";
							if($status['type_1']=="2nd Hand") { echo "<th>Status</th>"; }
							echo "</tr>";

							foreach($result as $row)
							{
								$id = $row['id'];
								$results = mysqli_query($con, "SELECT CONCAT_WS('-', MID(inventory_uid.id, 1,2), MID(inventory_uid.id, 3,4)) AS uid, inventory_uid.* FROM inventory_uid WHERE (CONCAT_WS('-', MID(inventory_uid.id, 1,2), MID(inventory_uid.id, 3,4)) LIKE '%".$uid."%' OR serial LIKE '%".$uid."%') AND equipment_id='$id'AND is_avail!='5'");
								foreach ($results as $rows) {
									$i++;
									echo '<tr>';
									echo '<td>'. $i .'</td>';
									echo '<td>'. $row['equipment_name'] .' UID ' . $rows['uid'] . '</td>';
									if($rows['serial']==''){ echo '<td><a class="custom-button" data-uid="'.$rows['uid'].'" data-name="'.$row['equipment_name'].'" data-target="#updateserial" data-toggle="modal">Update Serial Number</a></td>'; } 
									else { echo '<td class="changeOnclick" id="changeOnclick-'.$rows['id'].'" data-id="'.$rows['id'].'" data-serial="'.$rows['serial'].'">'. $rows['serial'] .'</td>';  }
									if($row['type_1']=='2nd Hand'){
										if($rows['status']=='1') { echo '<td><span class="label label-success">Fine Condition</span> </td>'; }
										else { echo '<td><span class="label label-danger">Undergone Repair</span></td>'; }
									}
									echo '</tr>';
								}
							}
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
	
	function uploadFile(){
	  var input = document.getElementById("file");
	  file = input.files[0];
	  if(file != undefined){
	    formData= new FormData();
	    if(!!file.type.match(/image.*/)){
	      var item = $('select#model').find(':selected').data('uid');
	      formData.append("image", file, item + '.jpg');
	      $.ajax({
	        url: "uploads-serial.php",
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

	$('#product').change(function(){
	   	var id = $('select#product').find(':selected').data('id');
	   	var name = $('select#product').find(':selected').data('name');
	  	$.ajax({type:"POST",url:"ajax.php",
	   		data: {
	   			id:id,
	   			name:name,
	   			action: "get-list"
	   		},
		    }).then(function(data) {
		    	 $('#model').html(data);
		    }); 

	});	

	$(document).on("click", ".changeOnclick", function() {
		var id = $(this).data('id'); 
		var serial = $(this).data('serial'); 
		var converted = '<div class="input-group add-on"><input class="form-control" id="serial-'+id+'" placeholder="'+serial+'" type="text"><div class="input-group-btn"><button class="btn btn-success updateSerial" data-buttonid="'+id+'" id="updateSerial-'+id+'"><i class="glyphicon glyphicon-ok"></i></button></div><div class="input-group-btn"><button class="btn btn-danger cancelSerial" data-buttonid="'+id+'" data-serial="'+serial+'" id="cancelSerial-'+id+'"><i class="glyphicon glyphicon-remove"></i></button></div></div>';
		$('#changeOnclick-'+id).replaceWith('<td id="changeOnsave-'+id+'">' + converted + '</td>');
	});

	$(document).on("click", ".cancelSerial", function() {
		var id = $(this).data('buttonid');
		var serial = $(this).data('serial'); 
		$('#changeOnsave-'+id).replaceWith('<td class="changeOnclick" id="changeOnclick-'+id+'" data-id="'+id+'"  data-serial="'+serial+'">'+serial+ '</td>');
	});

	$(document).on("click", ".updateSerial", function() {
		var id = $(this).data('buttonid');
		var serial = document.getElementById('serial-'+id).value;
		$.ajax({type:"POST", url:"ajax.php",
		data: {
			id:id,
			serial:serial,
			action: "editSerial"
		},
		}).then(function(data) {
			$('#changeOnsave-'+id).replaceWith('<td class="changeOnclick" id="changeOnclick-'+id+'" data-id="'+id+'" data-serial="'+serial+'">'+serial+ '</td>');
		});
	});

	$(document).on("click", ".update", function() { 
		var id = $('select#product').find(':selected').data('id');
	   	var name = $('select#product').find(':selected').data('name');
	   	var uid = $('select#model').find(':selected').data('uid');
	   	var status = document.getElementById('status').value;
		$.ajax({type:"POST",url:"ajax.php",
		data: {
			id:id,
			name:name,
			uid:uid,
			status:status,
			action:"add-log"
		},
	    }).then(function(data) { 
	    	uploadFile();
	    	location.reload();
	    }); 
	});

	$(document).on("click", ".modal-closer", function() { 
		$('#success').modal({ show: 'false' }); 
		location.reload();
	});

	$(document).on("click", ".custom-button", function() {
		var name = $(this).data('name');
		var uid = $(this).data('uid');
		var combine = name + " UID " + uid;
		$(".modal-body #machine").val(combine);
		$(".modal-body #uid").val(uid);
	});

	$(document).on("click", ".updatequery", function() {
		var name = document.getElementById('machine').value;
		var uid = document.getElementById('uid').value;
		var serial = document.getElementById('serial').value;
		$.ajax({type:"POST",url:"ajax.php",
		data: {
			name:name,
			uid:uid,
			serial:serial,
			action:"update-serial"
		},
	    }).then(function(data) { 
	    	location.reload();
	    }); 
	});
	</script>
</body>
</html>