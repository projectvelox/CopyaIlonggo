<?php
   session_start();
   
   $user_check = $_SESSION['login_user'];
   $con = mysqli_connect("localhost","root","","ci");
   $ses_sql = mysqli_query($con,"select * from accounts where username = '$user_check' ");
   
   $row = mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);
   
   $login_session = $row['username'];
   $password = $row['password'];
   $login_fullname = $row['firstname'] . " " . $row['lastname'];
   $profile = $row['firstname'] . " " . $row['middlename'] . " " . $row['lastname'];
   $first = $row['firstname'];
   $middle = $row['middlename'];
   $last = $row['lastname'];
   $id = $row['id'];
   $age = $row['age'];
   $sex = $row['sex'];
   $lat = $row['lat'];
   $lng = $row['lng'];

   $conversion = mysqli_query($con,"SELECT TIMESTAMPDIFF(YEAR, age, CURDATE()) AS age FROM accounts WHERE username = '$user_check' ");
   $row1 = mysqli_fetch_array($conversion,MYSQLI_ASSOC);

   $converted = $row1['age'];

   $contact = $row['contact'];
   $address= $row['mailing'];
   $login_access_level = $row['type'];
   
   if(!isset($_SESSION['login_user'])){
      header("location:index.php");
   }
?>