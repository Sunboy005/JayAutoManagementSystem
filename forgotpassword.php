<?php
session_start();
//add connection
include "includes/connections/dbconnect.php";

if((isset($_SESSION['user'])) && ($_SESSION['pass']!='temp')){
  header("Location: general/dashboard.php");
}
$purposeid=$_GET['id'];
//login process
if (isset($_POST['confirmuser'])) {      
  $email = mysqli_real_escape_string($conn, $_POST['email']);
  $phone = mysqli_real_escape_string($conn, $_POST['phone']);
  $query = "SELECT * FROM users WHERE email = '$email' AND phone = '$phone'";
  $result = mysqli_query($conn, $query);
  $count= mysqli_num_rows($result);
  $row = mysqli_fetch_array($result);
  $status_id=$row['status_id'];
  //check if login is successful
    if(($count >= 1 && ($status_id == 1))) {      
      $_SESSION['usernew'] = $row['email'];  
            header("Location: changepassword.php"); 
    }else if(($count >= 1 && ($status_id == 3))) {      
      $_SESSION['usernew'] = $row['email'];  
            header("Location: changepassword.php"); 
    }else {
      $_SESSION['alerticon']="danger";
      $_SESSION['alert']="No Employee with such email and phone number";
      header("location: index.php");
    }                               
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>JayAuto | Confirm Account</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <!-- /.login-logo -->
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a href="index.php" class="h1"><b>Jay</b>Autos</a>
    </div>
    <div class="card-body">
      <?php if($purposeid==1){ ?>
      <p class="login-box-msg">Forgot Password</p>
      <?php }else{ ?>
      <p class="login-box-msg">Confirm Account</p>
      <?php } ?>
      <form action="" method="post">
        <div class="input-group mb-3">
          <input type="email" name="email" class="form-control" placeholder="Email">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope  text-primary"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="phone" name="phone" class="form-control" placeholder="Phone Number">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-phone text-primary"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-2">
          </div>
          <!-- /.col -->
          <div class="col-8">
            <button type="submit" name="confirmuser" class="btn btn-primary btn-block">Confirm Account</button>
          </div>
          <!-- /.col -->
        </div>
      </form>
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>
<!-- /.login-box -->

<?php include 'includes/pages/general/footer-script.php'; ?>
</body>
</html>
