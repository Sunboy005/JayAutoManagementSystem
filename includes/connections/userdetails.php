<?php
include "dbconnect.php";
if(isset($_SESSION['user'])){
     //get the user details
     $user_id=$_SESSION['user'];
     $sql="SELECT * FROM users WHERE email='$user_id'";
     $result=mysqli_query($conn,$sql);
     $row=mysqli_fetch_array($result);
     $myname=$row['name'];
     $myemail=$row['email'];
     $myimage=$row['image'];
     if($myimage==""){
          $myimage="avatar.png";
     }
     $mypassword=$row['password'];
     $myposition_id=$row['position_id'];
     $datejoined=$row['date_created'];
}else{
   
     header("Location: ../login.php");
}