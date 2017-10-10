<?php 
	date_default_timezone_set('Asia/Manila');
	if($_POST['action']=="editSerial"){
		$id = $_REQUEST['id'];
		$serial = $_REQUEST['serial'];
		$con = mysqli_connect("localhost","root","","ci");
		$update = mysqli_query($con, "UPDATE inventory_uid SET serial='$serial' WHERE id='$id'");
	}

	if($_POST['action']=="testMultipleSaves"){
		$con = mysqli_connect("localhost","root","","ci");
		$uid = $_REQUEST['uid'];
		$serial = $_REQUEST['serial'];
		$equipment_id = $_REQUEST['equipment_id'];
		$insert = mysqli_query($con, "INSERT INTO inventory_uid(id, serial, equipment_id) VALUES('$uid','$serial', '$equipment_id')");
		echo $uid . " " . $serial;
	}
	if($_POST['action']=="update-serial"){
		$name = $_REQUEST['name'];
		$uid = $_REQUEST['uid']; /* Conversion */ $newuid = str_replace("-","",$uid);
		$serial = $_REQUEST['serial'];
		$con = mysqli_connect("localhost","root","","ci");
		$update = mysqli_query($con, "UPDATE inventory_uid SET serial='$serial' WHERE id='$newuid'");
	}

	if($_POST['action']=="auto"){
		$id = $_POST['id'];
		$con = mysqli_connect("localhost","root","","ci");
		$query_1 = mysqli_query($con,"SELECT COUNT(*) AS counted FROM inventory_uid WHERE equipment_id = '$id'");
		$condition_1=mysqli_fetch_assoc($query_1);

		$query_2 = mysqli_query($con,"SELECT COUNT(*) AS counted FROM inventory_uid WHERE is_avail != '1' AND  is_avail != '2' AND is_avail != '3' AND equipment_id = '$id'");
		$condition_2=mysqli_fetch_assoc($query_2);

		if($condition_1['counted'] == $condition_2['counted']) {
			$query_1 = mysqli_query($con,"UPDATE inventory_uid SET is_avail='1' WHERE equipment_id = '$id'");
			echo "1";		
		} else { echo "2";}
	}

	if($_POST['action']=="add-log"){
		$id = $_POST['id'];
		$name = $_POST['name'];
		$uid = $_POST['uid']; /* Transformed */ $transformed = str_replace("-","",$uid);
		$status = $_POST['status'];

		$con = mysqli_connect("localhost","root","","ci");
		//echo $id . " " . $name . " " . $uid . " " . $status;
		$results = mysqli_query($con,"UPDATE inventory_uid SET status = '$status' WHERE id='$transformed'");
	}

	if($_POST['action']=="get-list"){
		$id = $_POST['id'];
		$name = $_POST['name'];

		$con = mysqli_connect("localhost","root","","ci");
		$results = mysqli_query($con,"SELECT CONCAT_WS('-', MID(inventory_uid.id, 1,2), MID(inventory_uid.id, 3,4)) AS uid, inventory_uid.* FROM inventory_uid WHERE equipment_id='$id'");
		echo "<option disabled selected>Choose a specific model</option>";
		foreach($results as $row)
		{
			$combined = $name . " UID " . $row['uid'];
			echo "<option data-uid='" . $row['uid'] . "'>" . $combined .  "</option>";
		}
	}

	if($_POST["action"]=="specific-sale"){
		$name = $_POST['name'];
		$price = $_POST['price'];
		$login_fullname = $_POST['login_fullname'];
		$now = date('Y-m-d');
		
		$con = mysqli_connect("localhost","root","","ci");	

		$sql = "INSERT INTO user_cart(equipment_name, price, qty, user) VALUES ('$name','$price','1','$login_fullname')";
		$result = mysqli_query($con,$sql);
		echo $sql;
	}

	if($_POST["action"]=="specific-rent"){
		$equipment_name = $_POST['equipment_name'];
		$name = $_POST['name'];
		$price = $_POST['pricesx'];
		$date_due = $_POST['datedue'];
		$login_fullname = $_POST['login_fullname'];

		$sex = $_POST['sex'];
		$address = $_POST['address'];
		$contact = $_POST['contact'];
		$now = date('Y-m-d');

		//Conversion to get the month and year
		$due=strtotime($date_due); 	/* Borrowed and Due */ 	$borrowed=strtotime($now);
		$due_month=date("F",$due); 	/* Borrowed and Due */ 	$borrowed_month=date("F",$borrowed);
		$due_year=date("Y",$due); 	/* Borrowed and Due */ 	$borrowed_year=date("Y",$borrowed);

		$merged_due = $due_month . ' ' . $due_year;
		$merged_borrowed = $borrowed_month . ' ' . $borrowed_year;
		
		$con = mysqli_connect("localhost","root","","ci");	

		if($date_due == '' || $date_due <= $now || $merged_due == $merged_borrowed) {
			//echo $name . " " . $price . " " . $qty . " " . $purchase . " " . $total;
			echo "2";
			//echo $due_month . ' ' . $due_year . ' | ' . $borrowed_month . ' ' . $borrowed_year ;
		}
		else {

			$sqlx = "SELECT PERIOD_DIFF(EXTRACT(YEAR_MONTH FROM '$date_due'), EXTRACT(YEAR_MONTH FROM '$now')) AS conversion";
			$resultx = mysqli_query($con,$sqlx);
			$row=mysqli_fetch_assoc($resultx);
			$conversion = $row['conversion'];

			$total = ($conversion * $price) * 1;
			//$sql1 = "UPDATE inventory SET qty=(qty-1) WHERE equipment_name='$name'";
			//$result1 = mysqli_query($con,$sql1);
			$sql = "INSERT INTO borrower_cart(name, address, contact, equipment_name, price, qty, date_borrowed, date_due, total_price) VALUES ('$login_fullname', '$address', '$contact', '$name', '$price', '1' , '$now', '$date_due', '$total')";
			$result = mysqli_query($con,$sql);
			echo "1";
		}
	}

	if($_POST["action"]=="sendmessage"){
		$user_id = $_POST['user_id'];
		$user = $_POST['user'];
		$message = $_POST['message'];

		//echo $user_id . " " . $user . " " . $message;
		$con = mysqli_connect("localhost","root","","ci");
		if($message == "") { echo "1"; }	
		else {
			$result = mysqli_query($con, "INSERT INTO servicerequest(user_id, user, message) VALUES('$user_id', '$user', '$message')");
			echo "2";
		}
	}

	if($_POST["action"]=="comment"){
		$equipment_uid = $_POST['equipment_uid'];
		$user = $_POST['user'];
		$comment = $_POST['comment'];
		$borrowed = $_POST['borrowed'];

		//echo $user_id . " " . $user . " " . $message;
		$con = mysqli_connect("localhost","root","","ci");
		if($comment == "") { echo "1"; }	
		else {
			$result = mysqli_query($con, "INSERT INTO inventory_comments(equipment_uid, user, comments, borrowed) VALUES('$equipment_uid', '$user', '$comment', '$borrowed')");
			echo "2";
		}
	}

	if($_POST["action"]=="create_user"){
		$username = $_POST['username'];
		$password = $_POST['password'];
		$firstname = $_POST['firstname'];
		$middlename = $_POST['middlename'];
		$lastname = $_POST['lastname'];
		$sex = $_POST['sex'];
		$age = $_POST['age'];
		$mailing = $_POST['mailing'];
		$contact = $_POST['contact'];
		$type = $_POST['type'];
		$lat = $_POST['lat'];
		$lng = $_POST['lng'];
		$con = mysqli_connect("localhost","root","","ci");	
		if($lat == '' || $lng == '' || $username == '' || $password == '' || $firstname == '' || $lastname == '' || $sex == '' || $age == '' || $mailing == '' || $contact == '') {
			echo "1";
		}
		else {
			$sql = "INSERT INTO accounts(username, password, firstname, middlename, lastname, sex, age, mailing, lat, lng, contact, type, status)	VALUES ('$username', '$password', '$firstname', '$middlename', '$lastname', '$sex', '$age', '$mailing', '$lat', '$lng','$contact', '$type', 'Active')";
			$result = mysqli_query($con,$sql);
			echo "2";
		}
	}

	if($_POST["action"]=="create_admin"){
		$username = $_POST['username'];
		$password = $_POST['password'];
		$firstname = $_POST['firstname'];
		$middlename = $_POST['middlename'];
		$lastname = $_POST['lastname'];
		$sex = $_POST['sex'];
		$age = $_POST['age'];
		$mailing = $_POST['mailing'];
		$contact = $_POST['contact'];
		$type = $_POST['type'];
		$con = mysqli_connect("localhost","root","","ci");	
		if($username == '' || $password == '' || $firstname == '' || $lastname == '' || $sex == '' || $age == '' || $mailing == '' || $contact == '') {
			echo "1";
		}
		else {
			$sql = "INSERT INTO accounts(username, password, firstname, middlename, lastname, sex, age, mailing, contact, type, status)	VALUES ('$username', '$password', '$firstname', '$middlename', '$lastname', '$sex', '$age', '$mailing', '$contact', '$type', 'Active')";
			$result = mysqli_query($con,$sql);
			echo "2";
		}
	}

	if($_POST["action"]=="add_inventory_item"){
		$product = $_POST['product'];
		$description = $_POST['description'];
		$quantity = $_POST['qty'];
		$warning = $_POST['warning'];
		$price = $_POST['price'];
		$type_1 = $_POST['type_1'];
		$con = mysqli_connect("localhost","root","","ci");	
		$sql = "SELECT equipment_name FROM inventory WHERE equipment_name = '$product' AND type_1 = '$type_1'";
		$result = mysqli_query($con,$sql);
		$row=mysqli_fetch_assoc($result);
		if($row['equipment_name'] != $product){
			$sql = "INSERT INTO inventory(equipment_name, description, qty, warning, price, type, type_1, category) VALUES ('$product', '$description', '$quantity', '$warning' , '$price', 'Inventory', '$type_1', 'Machine')";
			$result = mysqli_query($con,$sql);
			
			//TEST TEST TEST TEST TEST
			$results = mysqli_query($con, "SELECT * FROM inventory WHERE equipment_name='$product'");
			$rowid=mysqli_fetch_assoc($results);
			$id = $rowid['id'];
			$i=0; 
			while ($i != $quantity ) {
				$i++;
				//$insert = mysqli_query($con, "INSERT INTO inventory_uid(equipment_id) VALUES('$id')");
			} echo "1";
			//TEST TEST TEST TEST TEST
		 
		} 
		else { echo "2"; }
	}

	if($_POST["action"]=="add_service_item"){
		$product = $_POST['product'];
		$price = $_POST['price'];
		$description = $_POST['description'];

		$con = mysqli_connect("localhost","root","","ci");	
		$sql = "SELECT equipment_name FROM inventory WHERE equipment_name = '$product'";
		$result = mysqli_query($con,$sql);
		$row=mysqli_fetch_assoc($result);
		if($row['equipment_name'] != $product){
			$sql = "INSERT INTO inventory(equipment_name, qty, description, price, type) VALUES ('$product', '0', '$description','$price', 'Services')";
			$result = mysqli_query($con,$sql);
			echo "1";
		}
		else { echo "2"; }
	}

	if($_POST["action"]=="add_rental"){
		$name = $_POST['name'];
		$address = $_POST['address'];
		$contact = $_POST['contact'];
		$product = $_POST['product'];
		$ppi = $_POST['ppi'];
		$quantity = $_POST['quantity'];
		$due = $_POST['due'];
		$price = $_POST['price'];
		$cq = $_POST['cq'];
		$con = mysqli_connect("localhost","root","","ci");	
		if($name == '' || $address == '' || $contact == '' || $product == '' || $ppi == '' || $quantity == '' || $due == '' || $price == '' || $quantity > $cq || $cq == '0') {
			echo "1";
		}
		else {
			$sql = "INSERT INTO borrower_cart(name, address, contact, equipment_name, price, qty, date_borrowed, date_due, total_price, status)	VALUES ('$name', '$address', '$contact', '$product', '$ppi', '$quantity', NOW(), '$due', '$price', 'On Hand')";
			$sql1 = "UPDATE inventory SET qty=(qty - '$quantity') WHERE equipment_name='$product'";
			$result = mysqli_query($con,$sql);
			$result1 = mysqli_query($con,$sql1); 
			echo "2";
		}
	}

	if($_POST["action"]=="add-to-cart"){
		$name = $_POST['name'];
		$product = $_POST['product'];
		$ppi = $_POST['ppi'];
		$quantity = $_POST['quantity'];
		$price = $_POST['price'];
		$cq = $_POST['cq'];
		$con = mysqli_connect("localhost","root","","ci");	

		if($name == '' ||  $product == '' || $quantity == '' || $price == '' || $quantity > $cq || $cq == '0') {
			echo "1";
		}
		else {
			$sql = "INSERT INTO user_cart(user, equipment_name, qty, price, transaction_date, walkin) VALUES ('$name', '$product', '$quantity', '$price', CURRENT_TIMESTAMP, 'Yes')";
			$result = mysqli_query($con,$sql);
			$sql1 = "UPDATE inventory SET qty=(qty - $quantity) WHERE equipment_name='$product'";
			$result1 = mysqli_query($con,$sql1);
			$sql2 = "SELECT DISTINCT name FROM user_cart WHERE name='$name'";
			$result2 = mysqli_query($con,$sql2);
			$row=mysqli_fetch_assoc($result2); 
			echo $row['name'];
		}
	}

	if($_POST["action"]=="record_transaction"){
		$name = $_POST['name'];
		$product = $_POST['product'];
		$ppi = $_POST['ppi'];
		$quantity = $_POST['quantity'];
		$price = $_POST['price'];
		$cq = $_POST['cq'];
		$con = mysqli_connect("localhost","root","","ci");	
		$sql = "UPDATE user_cart SET status='Claimed' WHERE walkin='Yes'";
		$result = mysqli_query($con,$sql);
		echo "2";
	}

	if($_POST["action"]=="archive"){
		//function test() {
			$total_profit = $_POST['t_profit'];
			$sales_profit = $_POST['r_profit'];
			$rental_profit = $_POST['s_profit'];
			$now = date('Y-m-d');
			$yearValue = date('Y');
			$con = mysqli_connect("localhost","root","","ci");	
			//$sql = "INSERT INTO sales_history(name, product_name, qty, total_price, transaction_date) SELECT name, product_name, qty, total_price, transaction_date FROM sales WHERE month(current_date) = month(transaction_date)";
			$sql1 = "INSERT INTO sale_digits(year, month, sales, rental, total_profit) VALUES('$yearValue', '$now', '$sales_profit', '$rental_profit', '$total_profit')";
			//$result = mysqli_query($con,$sql);
			$result1 = mysqli_query($con,$sql1); 
			echo $sql1;
		//}
	}

	if($_POST["action"]=="return_rental") {
		$quantity = $_POST['quantity'];
		$name = $_POST['name'];
		$id = $_POST['id'];
		$con = mysqli_connect("localhost","root","","ci");	

		$test = mysqli_query($con, "SELECT inventory.equipment_name AS inventory_equipment, borrower_cart.equipment_name AS eq, inventory.qty AS inventory_qty, borrower_cart.qty AS user_qty FROM inventory INNER JOIN borrower_cart ON inventory.equipment_name = SUBSTRING_INDEX(borrower_cart.equipment_name,'UID',1) WHERE borrower_cart.equipment_name = '$name'");
		$test1=mysqli_fetch_assoc($test);
		$new = $test1['inventory_equipment'];
		
		$sql = "UPDATE inventory SET qty=(qty + '$quantity') WHERE equipment_name='$new'";
		$sql1 = "UPDATE borrower_cart SET status='Returned' WHERE id='$id'";

		$dude = substr($name, strpos($name, "UID") + 4);    
		$uid = str_replace("-","",$dude);

		$sql2 = "UPDATE inventory_uid SET is_avail='4' WHERE id='$uid'";
		$result = mysqli_query($con,$sql);
		$results = mysqli_query($con,$sql1);
		$resultss = mysqli_query($con,$sql2);

		echo $sql;
	}

	if($_POST["action"]=="update_status_disabled") {
		$con = mysqli_connect("localhost","root","","ci");	
		$sql = "UPDATE accounts SET status='Disabled' WHERE id=".$_POST['id'];
		$result = mysqli_query($con,$sql);
	}

	if($_POST["action"]=="update_status_enabled") {
		$con = mysqli_connect("localhost","root","","ci");	
		$sql = "UPDATE accounts SET status='Active' WHERE id=".$_POST['id'];
		$result = mysqli_query($con,$sql);
	}

	if($_POST["action"]=="disable_sales_inventory") {
		$id= $_POST['id'];
		$con = mysqli_connect("localhost","root","","ci");	
		$sql = "UPDATE inventory SET status='Disabled' WHERE id='$id'";
		$result = mysqli_query($con,$sql);
	}

	if($_POST["action"]=="enable_sales_inventory") {
		$id= $_POST['id'];
		$con = mysqli_connect("localhost","root","","ci");	
		$sql = "UPDATE inventory SET status='Active' WHERE id='$id'";
		$result = mysqli_query($con,$sql);
	}

	if($_POST["action"]=="rectock_item") {
		$now = date('Y-m-d H:i:s'); 
		$qty = $_POST['qty'];
		$cq = $_POST['cq'];
		$product = $_POST['product'];
		$con = mysqli_connect("localhost","root","","ci");	
		$sql = "UPDATE inventory SET qty=(qty + '$qty') WHERE equipment_name='$product'";
		$sql1 = "INSERT INTO restock_logs(equipment_name, cq, qty, date_restocked) VALUES ('$product', '$cq', '$qty','$now')";

		$result = mysqli_query($con,$sql);
		$result1 = mysqli_query($con,$sql1);

		$sql3 = mysqli_query($con, "SELECT * FROM inventory WHERE equipment_name='$product'");
		$rowsql3=mysqli_fetch_assoc($sql3);
		$type_1 = $rowsql3['type_1'];


		$results = mysqli_query($con, "SELECT * FROM inventory WHERE equipment_name='$product'");
		$rowid=mysqli_fetch_assoc($results);
		$id = $rowid['id'];
		$i=0; 
		while ($i != $qty ) {
			$i++;
			$insert = mysqli_query($con, "INSERT INTO inventory_uid(equipment_id) VALUES('$id')");
		} 
	}

	if($_POST["action"]=="edit_price") {
		$now = date('Y-m-d H:i:s'); 
		$price = $_POST['price'];
		$cq = $_POST['cq'];
		$product = $_POST['product'];
		$con = mysqli_connect("localhost","root","","ci");	
		$sql = "UPDATE inventory SET price='$price' WHERE equipment_name='$product'";
		$sql1 = "INSERT INTO price_logs(equipment_name, cq, qty, date_pricechange) VALUES ('$product', '$cq', '$price','$now')";
		$result = mysqli_query($con,$sql);
		$result1 = mysqli_query($con,$sql1);
	}

	if($_POST["action"]=="get_current_quantity") {
		$product = $_POST['product'];
		$con = mysqli_connect("localhost","root","","ci");	
		$sql = "SELECT qty FROM inventory WHERE equipment_name = '$product'";
		$result = mysqli_query($con,$sql);
		$row=mysqli_fetch_assoc($result);
		echo $row['qty'];
	}

	if($_POST["action"]=="get_current_price") {
		$product = $_POST['product'];
		$con = mysqli_connect("localhost","root","","ci");	
		$sql = "SELECT price FROM inventory WHERE equipment_name = '$product'";
		$result = mysqli_query($con,$sql);
		$row=mysqli_fetch_assoc($result);
		echo $row['price'];
	}

	if($_POST["action"]=="equipment_price") {
		$product = $_POST['product'];
		$con = mysqli_connect("localhost","root","","ci");	
		$sql = "SELECT price FROM inventory WHERE equipment_name = '$product'";
		$result = mysqli_query($con,$sql);
		$row=mysqli_fetch_assoc($result);
		echo $row['price'];
	}

	if($_POST["action"]=="calculate_price") {
		$product = $_POST['product'];
		$date_due = $_POST['due'];
		$ppi = $_POST['ppi'];
		$quantity = $_POST['quantity'];
		$now = date('Y-m-d'); 
		$con = mysqli_connect("localhost","root","","ci");	
		$sql = "SELECT (PERIOD_DIFF(EXTRACT(YEAR_MONTH FROM '$date_due'), EXTRACT(YEAR_MONTH FROM '$now')) * '$ppi') * '$quantity' AS total";
		$result = mysqli_query($con,$sql);
		$row=mysqli_fetch_assoc($result);
		echo $row['total'];
	}

	if($_POST["action"]=="calculate_sales_price") {
		$product = $_POST['product'];
		$ppi = $_POST['ppi'];
		$quantity = $_POST['quantity'];
		$con = mysqli_connect("localhost","root","","ci");	
		$sql = "SELECT ('$ppi' * '$quantity') AS total";
		$result = mysqli_query($con,$sql);
		$row=mysqli_fetch_assoc($result);
		echo $row['total'];
	}

	if($_POST["action"]=="validate_stocks") {
		$con = mysqli_connect("localhost","root","","ci");	
		$sql = "SELECT COUNT(*) AS stocks FROM inventory WHERE type='Inventory' AND  qty < 3";
		$result = mysqli_query($con,$sql);
		$row=mysqli_fetch_assoc($result);
		if($row['stocks'] == 0)	{ echo "2"; }
		else { echo "1"; }
	}

	if($_POST["action"]=="due_date_reminder") {
		$con = mysqli_connect("localhost","root","","ci");	
		$sql = "SELECT COUNT(*) AS due FROM borrower_cart WHERE status='On Hand' AND MONTH(date_due) = MONTH(CURRENT_DATE()) AND YEAR(date_due) = YEAR(CURRENT_DATE()) AND DAY(date_due) = DAY(CURRENT_DATE()) ORDER BY id DESC";
		$result = mysqli_query($con,$sql);
		$row=mysqli_fetch_assoc($result);
		if($row['due'] == 0) { echo "2"; }
		else { echo "1"; }
	}

	if($_POST["action"]=="user_cart"){
		$name = $_POST['name'];
		$price = $_POST['prices'];
		$qty = $_POST['qtys'];
		$purchase = $_POST['purchase'];
		$login_fullname = $_POST['login_fullname'];

		$total = $purchase * $price;

		$con = mysqli_connect("localhost","root","","ci");	
		if($purchase == '' || $purchase > $qty) {
			//echo $name . " " . $price . " " . $qty . " " . $purchase . " " . $total;
			echo "2";
		}
		else {
			//$sql1 = "UPDATE inventory SET qty=(qty-$purchase) WHERE equipment_name='$name'";
			//$result1 = mysqli_query($con,$sql1);
			$sql = "INSERT INTO user_cart(equipment_name, qty, price, user)	VALUES ('$name', '$purchase', '$total', '$login_fullname')";
			$result = mysqli_query($con,$sql);
			echo "1";
		}
	}

	if($_POST["action"]=="rental_cart"){
		
		$name = $_POST['name'];
		$price = $_POST['pricesx'];
		$qty = $_POST['qtysx'];
		$purchase = $_POST['purchase'];
		$date_due = $_POST['datedue'];
		$login_fullname = $_POST['login_fullname'];

		$sex = $_POST['sex'];
		$address = $_POST['address'];
		$contact = $_POST['contact'];

		$now = date('Y-m-d');

		//Conversion to get the month and year
		$due=strtotime($date_due); 	/* Borrowed and Due */ 	$borrowed=strtotime($now);
		$due_month=date("F",$due); 	/* Borrowed and Due */ 	$borrowed_month=date("F",$borrowed);
		$due_year=date("Y",$due); 	/* Borrowed and Due */ 	$borrowed_year=date("Y",$borrowed);

		$merged_due = $due_month . ' ' . $due_year;
		$merged_borrowed = $borrowed_month . ' ' . $borrowed_year;
		
		$con = mysqli_connect("localhost","root","","ci");	

		if($purchase == '' || $date_due == '' || $date_due <= $now || $purchase > $qty || $merged_due == $merged_borrowed) {
			//echo $name . " " . $price . " " . $qty . " " . $purchase . " " . $total;
			echo "2";
			//echo $due_month . ' ' . $due_year . ' | ' . $borrowed_month . ' ' . $borrowed_year ;
		}
		else {
			$sqlx = "SELECT PERIOD_DIFF(EXTRACT(YEAR_MONTH FROM '$date_due'), EXTRACT(YEAR_MONTH FROM '$now')) AS conversion";
			$resultx = mysqli_query($con,$sqlx);
			$row=mysqli_fetch_assoc($resultx);
			$conversion = $row['conversion'];

			$total = ($conversion * $price) * $purchase;
			$sql1 = "UPDATE inventory SET qty=(qty-$purchase) WHERE equipment_name='$name'";
			$result1 = mysqli_query($con,$sql1);
			$sql = "INSERT INTO borrower_cart(name, address, contact, equipment_name, price, qty, date_borrowed, date_due, total_price) VALUES ('$login_fullname', '$address', '$contact', '$name', '$price', '$purchase', '$now', '$date_due', '$total')";
			$result = mysqli_query($con,$sql);
			echo "1";
		}
	}

	if($_POST["action"]=="remove_from_rentcart") {
		$id= $_POST['id'];
		$name = $_POST['name'];
		$qty = $_POST['qty'];
		$con = mysqli_connect("localhost","root","","ci");
		$sql1 = "UPDATE inventory SET qty=(qty+'$qty') WHERE equipment_name='$name'";	
		$sql = "DELETE FROM borrower_cart WHERE id='$id'";
		$result1 = mysqli_query($con,$sql1);
		$result = mysqli_query($con,$sql);
		echo $sql;
	}

	if($_POST["action"]=="remove_from_cart") {
		$id= $_POST['id'];
		$name = $_POST['name'];
		$qty = $_POST['qty'];
		$con = mysqli_connect("localhost","root","","ci");
		$sql1 = "UPDATE inventory SET qty=(qty+'$qty') WHERE equipment_name='$name'";	
		$sql = "DELETE FROM user_cart WHERE id='$id'";
		$result1 = mysqli_query($con,$sql1);
		$result = mysqli_query($con,$sql);
		echo $sql;
	}

	if($_POST["action"]=="reserve") {
		$user = $_POST['user'];
		$con = mysqli_connect("localhost","root","","ci");
		$result = mysqli_query($con,"SELECT 
		inventory.equipment_name AS inventory_equipment,
		user_cart.equipment_name AS user_equipment,
		inventory.qty AS inventory_qty,
		user_cart.qty AS user_qty
		FROM inventory
		INNER JOIN user_cart
		ON inventory.equipment_name = SUBSTRING_INDEX(user_cart.equipment_name,'UID',1)
		WHERE user_cart.deduct='No' AND user_cart.user='James Bond' AND user_cart.status != 'Claimed' AND user_cart.status!='Reserved'
		");

		$loopCount = 0;
		while($row = mysqli_fetch_array($result))
		{
			$loopCount++;
			$iproduct = $row['inventory_equipment'];
			$iqty = $row['inventory_qty'];
			$bproduct = $row['user_equipment'];
			$bqty = $row['user_qty'];

			$sql1 = "UPDATE inventory SET qty=('$iqty' - '$loopCount') WHERE equipment_name='$iproduct'";	
			$result1 = mysqli_query($con,$sql1);

			$sql = "UPDATE user_cart SET status='Reserved', deduct='Yes' WHERE user='$user' AND status='Unreserved'";	
			$resultss = mysqli_query($con,$sql);

			$test = mysqli_query($con,"SELECT SUBSTRING_INDEX(equipment_name,'UID',-1) AS uid FROM user_cart WHERE equipment_name='$bproduct'");

			$tested=mysqli_fetch_assoc($test);
			$uid = $tested['uid'];    /* Conversion */	 $newuid = str_replace("-","",$uid);
			
			$updatequery = "UPDATE inventory_uid SET is_avail='2' WHERE id='$newuid' AND is_avail != '4' AND is_avail != '3'";
			$resultsss = mysqli_query($con, $updatequery);
			
		}
	}

	if($_POST["action"]=="claim_sales") {
		$users = $_POST['name'];
		$con = mysqli_connect("localhost","root","","ci");
		$sql = "UPDATE user_cart SET status='Claimed' WHERE user='$users' AND status='Reserved'";	
		$result = mysqli_query($con,$sql);

		$test = mysqli_query($con,"SELECT SUBSTRING_INDEX(equipment_name,'UID',-1) AS uid FROM user_cart WHERE status='Claimed' AND user='$users'");

		$tested=mysqli_fetch_assoc($test);
		$uid = $tested['uid'];    /* Conversion */	 $newuid = str_replace("-","",$uid);
		
		$updatequery = "UPDATE inventory_uid SET is_avail='5' WHERE id='$newuid'";
		//$resultsss = mysqli_query($con, $updatequery);
	
		echo $updatequery;
	}

	if($_POST["action"]=="claim_rental") {
		$users = $_POST['name'];
		$con = mysqli_connect("localhost","root","","ci");
		$sql = "UPDATE borrower_cart SET status='On Hand' WHERE name='$users' AND status='Reserved'";	
		$result = mysqli_query($con,$sql);
		echo $sql;
	}

	if($_POST["action"]=="reserve_rent") {
		$users = $_POST['users'];

		$con = mysqli_connect("localhost","root","","ci");

		$result = mysqli_query($con,"SELECT 
		inventory.equipment_name AS inventory_equipment,
		borrower_cart.equipment_name AS user_equipment,
		inventory.qty AS inventory_qty,
		borrower_cart.qty AS user_qty
		FROM inventory
		INNER JOIN borrower_cart
		ON inventory.equipment_name = SUBSTRING_INDEX(borrower_cart.equipment_name,'UID',1)
		WHERE borrower_cart.deduct='No' AND borrower_cart.name='$users' AND borrower_cart.status != 'On Hand' AND borrower_cart.status != 'Returned' AND borrower_cart.status != 'Reserved'");

		$loopCount;
		while($row = mysqli_fetch_array($result))
		{
			$loopCount++;
			$iproduct = $row['inventory_equipment'];
			$iqty = $row['inventory_qty'];
			$bproduct = $row['user_equipment'];
			$bqty = $row['user_qty'];
			$sql1 = "UPDATE inventory SET qty=('$iqty' - '$loopCount') WHERE equipment_name='$iproduct'";	
			$result1 = mysqli_query($con,$sql1);
			
			$sql = "UPDATE borrower_cart SET status='Reserved' WHERE name='$users' AND status='Unreserved'";
			$resultss = mysqli_query($con,$sql);

			$test = mysqli_query($con,"SELECT SUBSTRING_INDEX(equipment_name,'UID',-1) AS uid FROM borrower_cart WHERE equipment_name='$bproduct'");

			$tested=mysqli_fetch_assoc($test);
			$uid = $tested['uid'];    /* Conversion */	 $newuid = str_replace("-","",$uid);
			
			$updatequery = "UPDATE inventory_uid SET is_avail='2' WHERE id='$newuid' AND is_avail != '4' AND is_avail != '3'";
			$resultsss = mysqli_query($con, $updatequery);

			echo $updatequery;
		}
	}

	if($_POST["action"]=="change_quantity") {
		$name = $_POST['name'];
		$con = mysqli_connect("localhost","root","","ci");
		$result = mysqli_query($con,"SELECT * FROM inventory WHERE equipment_name='$name'");
		$row=mysqli_fetch_assoc($result);

		echo $row['price'];
	}


?>