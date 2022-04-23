<?php
include "dbconnect.php";
if(isset($_SESSION['user'])){
     //get the user details
     $user_id=$_SESSION['user'];
     $sql="SELECT * FROM users WHERE email='$user_id'";
     $result=mysqli_query($conn,$sql);
     $row=mysqli_fetch_array($result);
     $myname=$row['name'];
     $myid=$row['id'];
     $myemail=$row['email'];
     $myimage="avatar.png";
     $mypassword=$row['password'];
     $myposition_id=$row['position_id'];
     $datejoined=$row['date_created'];
}else{
   
     header("Location: ../index.php");
}